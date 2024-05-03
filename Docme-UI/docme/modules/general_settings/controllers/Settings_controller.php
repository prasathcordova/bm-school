<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Settings_controller
 *
 * @author chandrajith.edsys
 */
class Settings_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!(isLoggedin() == 1)) {
            if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
                header("HTTP/1.1 401 UNauthorized");
                die();
            } else {
                $path = base_url();
                redirect($path);
            }
        }
        $this->load->model('Settings_model', 'MSettings');
        $this->load->model('Country_model', 'MCountry');
        $this->load->model('State_model', 'MState');
        $this->load->model('City_model', 'MCity');
        $this->load->model('Community_model', 'MCommunity');
        $this->load->model('Caste_model', 'MCaste');
        $this->load->model('Currency_model', 'MCurrency');
        $this->load->model('Language_model', 'MLanguage');
        $this->load->model('Profession_model', 'MProfession');
        $this->load->model('Religion_model', 'MReligion');
    }

    //    this function written by Elavarasan S @ 18-05-2019 11:10

    public function get_report_general_settings()
    {
        if ($this->input->is_ajax_request() == 1) {
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
            switch ($type) {
                case 'country':
                    $report_data = $this->MCountry->get_all_country_list();
                    if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {
                        $data['rdata'] = $report_data['data'];
                        $data['header'] = array('Country Name', 'Country Abbreviation', 'Nationality', 'Currency Name');
                        $data['keys'] = array('country_name', 'country_abbr', 'country_nation', 'currency_name');
                        $data['message'] = "";
                    }
                    break;
                case 'state':
                    $report_data = $this->MState->get_all_state_list();
                    if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {
                        $data['rdata'] = $report_data['data'];
                        $data['header'] = array('State Name', 'State Abbreviation', 'Country Name');
                        $data['keys'] = array('state_name', 'state_abbr', 'country_name');
                        $data['message'] = "";
                    }
                    break;
                case 'district':
                    $report_data = $this->MCity->get_all_city_list();
                    if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {
                        $data['rdata'] = $report_data['data'];
                        $data['header'] = array('District Name', 'District Code', 'State Name');
                        $data['keys'] = array('city_name', 'city_abbr', 'state_name');
                        $data['message'] = "";
                    }
                    break;
                case 'religion':
                    $report_data = $this->MReligion->get_all_religion();
                    // dev_export($report_data);
                    // return;
                    if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {
                        $data['rdata'] = $report_data['data'];
                        $data['header'] = array('Religion Name');
                        $data['keys'] = array('religion_name');
                        $data['message'] = "";
                    }
                    break;
                case 'caste':
                    $report_data = $this->MCaste->get_all_caste_list();
                    if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {
                        $data['rdata'] = $report_data['data'];
                        $data['header'] = array('Caste Name', 'Religion Name', 'Community Name');
                        $data['keys'] = array('caste_name', 'religion_name', 'community_name');
                        $data['message'] = "";
                    }
                    break;
                case 'community':
                    $report_data = $this->MCommunity->get_all_community_list();
                    if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {
                        $data['rdata'] = $report_data['data'];
                        $data['header'] = array('Community Name');
                        $data['keys'] = array('community_name');
                        $data['message'] = "";
                    }
                    break;
                case 'language':
                    $report_data = $this->MLanguage->get_all_language_list();
                    if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {
                        $data['rdata'] = $report_data['data'];
                        $data['header'] = array('Language Name');
                        $data['keys'] = array('language_name');
                        $data['message'] = "";
                    }
                    break;
                case 'profession':
                    $report_data = $this->MProfession->get_all_profession_list();
                    if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {
                        $data['rdata'] = $report_data['data'];
                        $data['header'] = array('Profession', 'Profession Code');
                        $data['keys'] = array('profession_name', 'profession_code');
                        $data['message'] = "";
                    }
                    break;
                case 'currency':
                    $report_data = $this->MCurrency->get_all_currency_list();
                    if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {
                        $data['rdata'] = $report_data['data'];
                        $data['header'] = array('Currency Name', 'Currency Abbreviation');
                        $data['keys'] = array('currency_name', 'currency_abbr');
                        $data['message'] = "";
                    }
                    break;
                default:
                    $data['rdata'] = FALSE;
                    $data['header'] = '';
                    $data['keys'] = '';
                    $data['message'] = 'No data Available';
                    break;
            }
            $data['user_name'] = $this->session->userdata('user_name');
            $filename_report = "reports/report_" . time() . ".pdf";
            $pdfFilePath = FCPATH . $filename_report;
            if (file_exists($pdfFilePath) == FALSE) {
                ini_set('memory_limit', '320M'); // boost the memory limit if it's low ;)
                $data['title'] = 'General Settings - ' . ucfirst($type) . ' List Report';
                $data['bread_crumps'] = 'General Settings > REPORTS > ' . ucfirst($type) . ' List';
                $html = $this->load->view('settings/reports', $data, true); // render the view into HTML
                $this->load->library('pdf');
                $pdf = $this->pdf->load();
                $header = $this->load->view('report_settings/report/header', ['title' => 'General Settings - ' . ucfirst($type) . ' List Report'], true);
                $pdf->setAutoTopMargin = 'stretch';
                $pdf->setAutoBottomMargin = 'stretch';
                $pdf->SetHeader('|' . $header . '|');
                date_default_timezone_set('Asia/Kolkata');
                $pdf->WriteHTML($html); // write the HTML into the PDF
                $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
            }
            echo base_url($filename_report);
        } else {
            echo $this->load->view(ERROR_500);
            return;
        }
    }

    public function show_settings()
    {
        $data['template'] = 'settings/show_settings';
        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'General Settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url('settings/show-settings')
            )
        );
        //          $breadcrmp = strtoupper(filter_input(INPUT_POST, 'breadcrmp', FILTER_SANITIZE_STRING));
        ////        dev_export($breadcrmp);die;
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        //        $city_data = $this->MSettings->get_all_city_list();
        $count_data = $this->MSettings->get_all_count();
        //            dev_export($count_data);die;
        if ($count_data['error_status'] == 0 && $count_data['data_status'] == 1) {
            $data['count_data'] = $count_data['data'];
            $data['message'] = "";
        } else {
            $data['count_data'] = FALSE;
            $data['message'] = $count_data['message'];
        }

        $country_data = $this->MSettings->get_all_country_list();
        if ($country_data['error_status'] == 0 && $country_data['data_status'] == 1) {
            $data['country_data'] = $country_data['data'];
            $data['message'] = "";
        } else {
            $data['country_data'] = FALSE;
            $data['message'] = $country_data['message'];
        }

        $this->session->set_userdata('current_page', 'country');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['country_data']) && !empty($data['country_data'])) {
                foreach ($data['country_data'] as $country) {
                    $country_status = "";
                    if ($country['isactive'] == 1) {
                        $country_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        //$country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    } else {
                        $country_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\', this)" id="" class="js-switch"  /></a>';
                        //$country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\',\'' . $country['country_abbr'] . '\',\'' . $country['currency_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $country['country_name'] . '" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($country['country_name'], $country['country_abbr'], $country['currency_name'], $country_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('template/home_template', $data);
        }
    }

    public function show_count()
    {
        if ($this->input->is_ajax_request() == 1) {
            $count_data = $this->MSettings->get_all_count();
            //                dev_export($count_data);die;
            if (isset($count_data['error_status']) && $count_data['error_status'] == 0) {
                if ($count_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $count_data['data']));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    public function add_batch()
    {
        $data['template'] = 'course/add_batch';
        $data['title'] = 'BATCH SETTINGS';
        $data['sub_title'] = 'Add Batch';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Batch Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Batch Settings'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $city_data = $this->MSettings->get_all_city_list();
        if ($city_data['error_status'] == 0 && $city_data['data_status'] == 1) {
            $data['city_data'] = $city_data['data'];
            $data['message'] = "";
        } else {
            $data['city_data'] = FALSE;
            $data['message'] = $city_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['city_data']) && !empty($data['city_data'])) {
                foreach ($data['city_data'] as $city) {
                    $city_status = "";
                    if ($city['isactive'] == 1) {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    } else {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_city(\'' . $city['city_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $city['city_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>';
                    $formatted_data[] = array($city['city_name'], $city['city_abbr'], $city['state_name'], $city_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('template/home_template', $data);
        }
    }

    public function show_class()
    {
        $data['template'] = 'course/show_class';
        $data['title'] = 'COURSE SETTINGS';
        $data['sub_title'] = 'Course Settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Class Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Class Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $city_data = $this->MSettings->get_all_city_list();
        if ($city_data['error_status'] == 0 && $city_data['data_status'] == 1) {
            $data['city_data'] = $city_data['data'];
            $data['message'] = "";
        } else {
            $data['city_data'] = FALSE;
            $data['message'] = $city_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['city_data']) && !empty($data['city_data'])) {
                foreach ($data['city_data'] as $city) {
                    $city_status = "";
                    if ($city['isactive'] == 1) {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    } else {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_city(\'' . $city['city_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $city['city_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>';
                    $formatted_data[] = array($city['city_name'], $city['city_abbr'], $city['state_name'], $city_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('template/home_template', $data);
        }
    }

    public function show_course()
    {
        $data['template'] = 'course/show_course';
        $data['title'] = 'COURSE SETTINGS';
        $data['sub_title'] = 'course settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Course Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Course Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $city_data = $this->MSettings->get_all_city_list();
        if ($city_data['error_status'] == 0 && $city_data['data_status'] == 1) {
            $data['city_data'] = $city_data['data'];
            $data['message'] = "";
        } else {
            $data['city_data'] = FALSE;
            $data['message'] = $city_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['city_data']) && !empty($data['city_data'])) {
                foreach ($data['city_data'] as $city) {
                    $city_status = "";
                    if ($city['isactive'] == 1) {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    } else {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_city(\'' . $city['city_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $city['city_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>';
                    $formatted_data[] = array($city['city_name'], $city['city_abbr'], $city['state_name'], $city_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('template/home_template', $data);
        }
    }

    public function batch_allocate()
    {
        $data['template'] = 'course/batch_allocation';
        $data['title'] = 'BATCH ALLOCATION';
        $data['sub_title'] = 'course settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Course Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Course Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $city_data = $this->MSettings->get_all_city_list();
        if ($city_data['error_status'] == 0 && $city_data['data_status'] == 1) {
            $data['city_data'] = $city_data['data'];
            $data['message'] = "";
        } else {
            $data['city_data'] = FALSE;
            $data['message'] = $city_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['city_data']) && !empty($data['city_data'])) {
                foreach ($data['city_data'] as $city) {
                    $city_status = "";
                    if ($city['isactive'] == 1) {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    } else {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_city(\'' . $city['city_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $city['city_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>';
                    $formatted_data[] = array($city['city_name'], $city['city_abbr'], $city['state_name'], $city_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('template/home_template', $data);
        }
    }

    public function password_check($str)
    {
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
            return TRUE;
        }
        return FALSE;
    }

    public function add_city()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'City Management', 'status' => 0, 'link' => base_url('city/show-city')),
                2 => array('message' => 'Add New City', 'status' => 1)
            );
            $state = $this->MCity->get_all_state();
            if (isset($state['error_status']) && $state['error_status'] == 0) {
                if ($state['data_status'] == 1) {
                    $data['state_data'] = $state['data'];
                } else {
                    $data['state_data'] = FALSE;
                }
            } else {
                $data['state_data'] = FALSE;
            }
            $data['state_data'] = $state['data'];
            $data['panel_sub_header'] = 'Add New City';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'city');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('city/add_city', $data);
            } else {
                $this->form_validation->set_rules('city_name', 'City Name', 'trim|required');
                $this->form_validation->set_rules('city_abbr', 'City Abbreviation', 'trim|required');
                $this->form_validation->set_rules('state_select', 'Currency', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data_prep['city_name'] = filter_input(INPUT_POST, 'city_name', FILTER_SANITIZE_STRING);
                    $data_prep['city_abbr'] = filter_input(INPUT_POST, 'city_abbr', FILTER_SANITIZE_STRING);
                    $data_prep['state_id'] = filter_input(INPUT_POST, 'state_select', FILTER_SANITIZE_STRING);
                    $status = $this->MCity->save_city($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['city_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['city_name'] = filter_input(INPUT_POST, 'city_name', FILTER_SANITIZE_STRING);
                        $data['city_abbr'] = filter_input(INPUT_POST, 'city_abbr', FILTER_SANITIZE_STRING);
                        $data['state_select'] = filter_input(INPUT_POST, 'state_select', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('city/add_city', $data, TRUE)));
                        return;
                    }
                } else {
                    $data['city_name'] = filter_input(INPUT_POST, 'city_name', FILTER_SANITIZE_STRING);
                    $data['city_abbr'] = filter_input(INPUT_POST, 'city_abbr', FILTER_SANITIZE_STRING);
                    $data['state_select'] = filter_input(INPUT_POST, 'state_select', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 2, 'view' => $this->load->view('city/add_city', $data, TRUE)));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_city()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $city_id = filter_input(INPUT_POST, 'city_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($city_id) && !empty($city_id)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'City Management', 'status' => 0, 'link' => base_url('city/show-city')),
                    2 => array('message' => 'Edit City', 'status' => 1)
                );
                $state = $this->MCity->get_all_state();
                if (isset($state['error_status']) && $state['error_status'] == 0) {
                    if ($state['data_status'] == 1) {
                        $data['state_data'] = $state['data'];
                    } else {
                        $data['state_data'] = FALSE;
                    }
                } else {
                    $data['state_data'] = FALSE;
                }
                $data['state_data'] = $state['data'];
                $data['panel_sub_header'] = 'Edit City - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'city');
                $this->session->set_userdata('current_parent', 'gen_sett');

                $city_data_raw = $this->MCity->get_city_details($city_id);

                if (is_array($city_data_raw) && isset($city_data_raw['data_status']) && !empty($city_data_raw['data_status']) && $city_data_raw['data_status'] == 1) {
                    $data['city_data'] = $city_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit City - ' . $data['city_data']['city_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid City / No data associated with this city', 'data' => ''));
                    return;
                }
                if ($onload == 1) {

                    $view = $this->load->view('city/edit_city', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('city_name', 'City Name', 'trim|required');
                    $this->form_validation->set_rules('city_abbr', 'City Abbreviation', 'trim|required');
                    $this->form_validation->set_rules('state_select', 'Currency', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['city_id'] = filter_input(INPUT_POST, 'city_id', FILTER_SANITIZE_STRING);
                        $data_prep['city_name'] = filter_input(INPUT_POST, 'city_name', FILTER_SANITIZE_STRING);
                        $data_prep['city_abbr'] = filter_input(INPUT_POST, 'city_abbr', FILTER_SANITIZE_STRING);
                        $data_prep['state_id'] = filter_input(INPUT_POST, 'state_select', FILTER_SANITIZE_STRING);
                        $status = $this->MCity->edit_save_city($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['city_name'] . " Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => ''));
                            return;
                        } else {
                            $data['city_name'] = filter_input(INPUT_POST, 'city_name', FILTER_SANITIZE_STRING);
                            $data['city_abbr'] = filter_input(INPUT_POST, 'city_abbr', FILTER_SANITIZE_STRING);
                            $data['state_select'] = filter_input(INPUT_POST, 'state_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('city/edit_city', $data, TRUE)));
                            return;
                        }
                    } else {
                        $data['city_name'] = filter_input(INPUT_POST, 'city_name', FILTER_SANITIZE_STRING);
                        $data['city_abbr'] = filter_input(INPUT_POST, 'city_abbr', FILTER_SANITIZE_STRING);
                        $data['state_select'] = filter_input(INPUT_POST, 'state_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('city/edit_city', $data, TRUE)));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No City ID is provided / Invalid City', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $city_id = filter_input(INPUT_POST, 'city_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($city_id) && !empty($city_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                $data_prep['city_id'] = filter_input(INPUT_POST, 'city_id', FILTER_SANITIZE_STRING);
                $status = $this->MCity->edit_status_city($data_prep);
                if (is_array($status) && $status['status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                    return;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                return;
            }
        } else {
            echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
            return;
        }
    }

    public function show_system_parameters()
    {
        $data['sub_title'] = 'System Parameters';
        $data['user_name'] = $this->session->userdata('user_name');
        $sys_parameter = $this->MSettings->get_system_parameters();
        if (isset($sys_parameter['data']) && !empty($sys_parameter['data'])) {
            $data['sys_parameters'] = $sys_parameter['data'];
        } else {
            $data['sys_parameters'] = NULL;
        }

        $this->load->view('settings/show_system_parameters', $data);
    }

    public function save_system_parameters()
    {
        if ($this->input->is_ajax_request() == 1) {
            $system_parameter_id = filter_input(INPUT_POST, 'system_parameter_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($system_parameter_id) && !empty($system_parameter_id)) {
                $data_prep['code_value'] = filter_input(INPUT_POST, 'code_value', FILTER_SANITIZE_STRING);
                $data_prep['system_parameter_id'] = $system_parameter_id;
                $status = $this->MSettings->save_system_parameters($data_prep);
                if (is_array($status) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                    return;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                return;
            }
        } else {
            echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
            return;
        }
    }
}
