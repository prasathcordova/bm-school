<?php

/**
 * Description of Country_management_controller
 *
 * @author aju.docme
 */
class Country_management_controller extends MX_Controller {

    public function __construct() {
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
        $this->load->model('Country_model', 'MCountry');
    }

    public function show_countries() {        
        $data['sub_title'] = 'COUNTRY MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Country Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $country_data = $this->MCountry->get_all_country_list();
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
                        $country_status='<div class="switch">
                        <div class="onoffswitch">
                        <input type="checkbox" checked class="onoffswitch-checkbox pick_status" 
                            onchange="change_status(\'' . $country['country_id'] . '\', this)" id="">
                            <label class="onoffswitch-label" for="\''.$country['country_id'].'\'">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>';
                       // $country_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $country['country_id'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        //$country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    } else {
                        $country_status='<div class="switch">
                        <div class="onoffswitch">
                        <input type="checkbox" class="onoffswitch-checkbox pick_status" 
                            onchange="change_status(\'' . $country['country_id'] . '\', this)" id="">
                            <label class="onoffswitch-label" for="\''.$country['country_id'].'\'">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>';
                       // $country_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $country['country_id'] . '\', this)" id="" class="js-switch"  /></a>';
                        //$country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" class="btn btn-xs btn-info" onclick="edit_country(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\',\'' . $country['country_abbr'] . '\',\'' . $country['country_nation'] . '\',\'' . $country['currency_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $country['country_name'] . '" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-edit" ></i>Update</a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($country['country_name'], $country['country_abbr'], $country['country_nation'], $country['currency_name'], $country_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('country/show_country', $data);
        }
    }

    public function add_country() {

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Country Management', 'status' => 0, 'link' => base_url('country/show-country')),
                2 => array('message' => 'Add New Country', 'status' => 1)
            );
            $currency = $this->MCountry->get_all_currency();
            if (isset($currency['error_status']) && $currency['error_status'] == 0) {
                if ($currency['data_status'] == 1) {
                    $data['currency_data'] = $currency['data'];
                } else {
                    $data['currency_data'] = FALSE;
                }
            } else {
                $data['currency_data'] = FALSE;
            }
            $data['title'] = 'ADD NEW COUNTRY';
            $data['currency_data'] = $currency['data'];
            $data['panel_sub_header'] = 'Add New Country';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'country');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('country/add_country', $data);
            } else {

//                $this->form_validation->set_rules('country_name', 'Country Name', 'trim|required|min_length[3]|max_length[30]');
//                $this->form_validation->set_rules('country_abbr', 'Country Abbreviation', 'trim|required|min_length[3]|max_length[15]');
//                $this->form_validation->set_rules('country_nation', 'Country Nation', 'trim|required|min_length[3]|max_length[30]');
//                $this->form_validation->set_rules('currency_select', 'Currency', 'trim|required');
//
//                if ($this->form_validation->run() == TRUE) {
                    $data_prep['country_name'] = strtoupper(filter_input(INPUT_POST, 'country_name', FILTER_SANITIZE_STRING));
                    $data_prep['country_abbr'] = strtoupper(filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING));
                    $data_prep['country_nation'] = strtoupper(filter_input(INPUT_POST, 'country_nation', FILTER_SANITIZE_STRING));
                    $data_prep['currency_id'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
//                     dev_export($data_prep);die;                  
                    $status = $this->MCountry->save_country($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['country_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['country_name'] = filter_input(INPUT_POST, 'country_name', FILTER_SANITIZE_STRING);
                        $data['country_abbr'] = filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING);
                        $data['country_nation'] = filter_input(INPUT_POST, 'country_nation', FILTER_SANITIZE_STRING);
                        $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('country/add_country', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
//                } else {
//                    $data['country_name'] = filter_input(INPUT_POST, 'country_name', FILTER_SANITIZE_STRING);
//                    $data['country_abbr'] = filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING);
//                    $data['country_nation'] = filter_input(INPUT_POST, 'country_nation', FILTER_SANITIZE_STRING);
//                    $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
//                    echo json_encode(array('status' => 3, 'view' => $this->load->view('country/add_country', $data, TRUE), 'message' => $status['message']));
//                    return;
//                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_country() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $country_id = filter_input(INPUT_POST, 'country_id', FILTER_SANITIZE_NUMBER_INT);
            $country_name = strtoupper(filter_input(INPUT_POST, 'country_name', FILTER_SANITIZE_STRING));
            $country_abbr = strtoupper(filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING));
            $country_nation = strtoupper(filter_input(INPUT_POST, 'country_nation', FILTER_SANITIZE_STRING));
//            dev_export($country_nation);die;

            if (isset($country_id) && !empty($country_id)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Country Management', 'status' => 0, 'link' => base_url('country/show-country')),
                    2 => array('message' => 'Edit Country', 'status' => 1)
                );
                $currency = $this->MCountry->get_all_currency();
                if (isset($currency['error_status']) && $currency['error_status'] == 0) {
                    if ($currency['data_status'] == 1) {
                        $data['currency_data'] = $currency['data'];
                    } else {
                        $data['currency_data'] = FALSE;
                    }
                } else {
                    $data['currency_data'] = FALSE;
                }
                $data['title'] = 'EDIT COUNTRY - ' . $country_name;
                $data['currency_data'] = $currency['data'];
                $data['panel_sub_header'] = 'Edit Country - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'country');
                $this->session->set_userdata('current_parent', 'gen_sett');

                $country_data_raw = $this->MCountry->get_country_details($country_id);
                if (is_array($country_data_raw) && isset($country_data_raw['data_status']) && !empty($country_data_raw['data_status']) && $country_data_raw['data_status'] == 1) {
                    $data['country_data'] = $country_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Country - ' . $data['country_data']['country_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Country / No data associated with this country', 'data' => ''));
                    return;
                }
                if ($onload == 1) {
                    $data['country_id'] = $country_id;
                    $data['country_abbr'] = $country_abbr;
                    $data['country_nation'] = $country_nation;
                    $data['country_name'] = $country_name;
                    $view = $this->load->view('country/edit_country', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
//                    $this->form_validation->set_rules('country_name', 'Country Name', 'trim|required|min_length[3]|max_length[30]');
//                    $this->form_validation->set_rules('country_abbr', 'Country Abbreviation', 'trim|required|min_length[3]|max_length[15]');
//                    $this->form_validation->set_rules('country_nation', 'Country Nation', 'trim|required|min_length[3]|max_length[35]');
//                    $this->form_validation->set_rules('currency_select', 'Currency', 'trim|required');
//                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['country_id'] = filter_input(INPUT_POST, 'country_id', FILTER_SANITIZE_STRING);
                        $data_prep['country_name'] = strtoupper(filter_input(INPUT_POST, 'country_name', FILTER_SANITIZE_STRING));
                        $data_prep['country_abbr'] = strtoupper(filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING));
                        $data_prep['country_nation'] = strtoupper(filter_input(INPUT_POST, 'country_nation', FILTER_SANITIZE_STRING));
                        $data_prep['currency_id'] = strtoupper(filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING));
//                        dev_export($data_prep);die;
                        $status = $this->MCountry->edit_save_country($data_prep);
                        
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['country_name'] . " Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => $this->load->view('country/show_country', $data, TRUE)));
                            return;
                        } else {
                            $data['country_name'] = filter_input(INPUT_POST, 'country_name', FILTER_SANITIZE_STRING);
                            $data['country_abbr'] = filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING);
                            $data['country_nation'] = filter_input(INPUT_POST, 'country_nation', FILTER_SANITIZE_STRING);
                            $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('country/edit_country', $data, TRUE), 'message' => $status['message']));
                            return;
                        }
//                    } else {
//                        $data['country_name'] = filter_input(INPUT_POST, 'country_name', FILTER_SANITIZE_STRING);
//                        $data['country_abbr'] = filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING);
//                        $data['country_nation'] = filter_input(INPUT_POST, 'country_nation', FILTER_SANITIZE_STRING);
//                        $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
//                        echo json_encode(array('status' => 3, 'view' => $this->load->view('country/edit_country', $data, TRUE), 'message' => 'Error in saving details / Validation failed'));
//                        return;
//                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Country ID is provided / Invalid Country', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status() {
        if ($this->input->is_ajax_request() == 1) {
            $country_id = filter_input(INPUT_POST, 'country_id', FILTER_SANITIZE_NUMBER_INT);
//            dev_export($country_id);die;
            if (isset($country_id) && !empty($country_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['country_id'] = filter_input(INPUT_POST, 'country_id', FILTER_SANITIZE_STRING);
                $status = $this->MCountry->edit_status_country($data_prep);
                if (isset($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    if(isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status['message'], 'data' => ''));
                        return;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                        return;
                    }  
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
