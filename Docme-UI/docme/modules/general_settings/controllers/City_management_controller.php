<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of City_management_controller
 *
 * @author chandrajith.edsys
 */
class City_management_controller extends MX_Controller
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
        $this->load->model('City_model', 'MCity');
    }

    public function show_cities()
    {
        //        $data['template'] = 'city/show_city';
        //        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'DISTRICT MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'District Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $city_data = $this->MCity->get_all_city_list();
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
                       // $city_status = '<a data-toggle="tooltip" data-placement="right" title="Slide for Enable/Disable" > <input type="checkbox" onchange="change_status(\'' . $city['city_id'] . '\', this)" checked id="" class="js-switch"  /></a>';
                       $city_status='<div class="switch">
                       <div class="onoffswitch">
                       <input type="checkbox" checked class="onoffswitch-checkbox pick_status" 
                           onchange="change_status(\'' . $city['city_id'] . '\', this)" id="">
                           <label class="onoffswitch-label" for="\''.$city['city_id'].'\'">
                               <span class="onoffswitch-inner"></span>
                               <span class="onoffswitch-switch"></span>
                           </label>
                       </div>
                   </div>';
                    } else {
                        //$city_status = '<a data-toggle="tooltip" data-placement="right" title="Slide for Enable/Disable" ><input type="checkbox" data-toggle="tooltip" data-placement="right" title="Slide for Enable/Disable" onchange="change_status(\'' . $city['city_id'] . '\', this)" id="" class="js-switch"  /></a>';
                        $city_status='<div class="switch">
                        <div class="onoffswitch">
                        <input type="checkbox" class="onoffswitch-checkbox pick_status" 
                            onchange="change_status(\'' . $city['city_id'] . '\', this)" id="">
                            <label class="onoffswitch-label" for="\''.$city['city_id'].'\'">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>';
                    }
                    $task_html = '<a href="javascript:void(0);" class="btn btn-xs btn-info" onclick="edit_city(\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\',\'' . $city['state_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $city['city_name'] . '" data-original-title="' . $city['city_name'] . '"  ><i class="fa fa-edit" ></i>Update</a>';
                    $formatted_data[] = array($city['city_name'], $city['city_abbr'], $city['state_name'], $city_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('city/show_city', $data);
        }
    }

    //    public function password_check($str) {
    //        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
    //            return TRUE;
    //        }
    //        return FALSE;
    //    }

    public function add_city()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'City Management', 'status' => 0, 'link' => base_url('city/show-city')),
                2 => array('message' => 'Add New District', 'status' => 1)
            );
            $country = $this->MCity->get_all_country();
            if (isset($country['error_status']) && $country['error_status'] == 0) {
                if ($country['data_status'] == 1) {
                    $data['country_data'] = $country['data'];
                } else {
                    $data['country_data'] = FALSE;
                }
            } else {
                $data['country_data'] = FALSE;
            }
            $data['country_data'] = $country['data'];
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
            $data['panel_sub_header'] = 'Add New District';
            $data['breadcrumb'] = $breadcrumb;
            $data['title'] = 'ADD NEW DISTRICT';
            $this->session->set_userdata('current_page', 'city');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('city/add_city', $data);
            } else {
                //                $this->form_validation->set_rules('city_name', 'City Name', 'trim|required|max_length[30]|min_length[3]');
                //                $this->form_validation->set_rules('city_abbr', 'City Abbreviation', 'trim|required|max_length[15]|min_length[3]');
                //                $this->form_validation->set_rules('state_select', 'State', 'trim|required');
                ////                $this->form_validation->set_rules('Country_select', 'Country', 'trim|required');
                //                if ($this->form_validation->run() == TRUE) {
                $data_prep['city_name'] = strtoupper(filter_input(INPUT_POST, 'city_name', FILTER_SANITIZE_STRING));
                $data_prep['city_abbr'] = strtoupper(filter_input(INPUT_POST, 'city_abbr', FILTER_SANITIZE_STRING));
                $data_prep['state_id'] = filter_input(INPUT_POST, 'state_select', FILTER_SANITIZE_STRING);
                //                    $data_prep['country_id'] = filter_input(INPUT_POST, 'country_select', FILTER_SANITIZE_STRING);
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
                    echo json_encode(array('status' => 2, 'view' => $this->load->view('city/add_city', $data, TRUE), 'message' => $status['message']));
                    return;
                }
                //                } else {
                //                    $data['city_name'] = filter_input(INPUT_POST, 'city_name', FILTER_SANITIZE_STRING);
                //                    $data['city_abbr'] = filter_input(INPUT_POST, 'city_abbr', FILTER_SANITIZE_STRING);
                //                    $data['state_select'] = filter_input(INPUT_POST, 'state_select', FILTER_SANITIZE_STRING);
                //                    echo json_encode(array('status' => 3, 'view' => $this->load->view('city/add_city', $data, TRUE),'message' => 'Validation Failed'));
                //                    return;
                //                }
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
            $city_name = strtoupper(filter_input(INPUT_POST, 'city_name', FILTER_SANITIZE_STRING));
            $city_abbr = filter_input(INPUT_POST, 'city_abbr', FILTER_SANITIZE_STRING);
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

                $data['title'] = 'EDIT DISTRICT - ' . $city_name;
                $data['state_data'] = $state['data'];
                $data['panel_sub_header'] = 'Edit District - ';
                $data['breadcrumb'] = $breadcrumb;
                $data['city_id'] = $city_id;
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
                        $data_prep['city_name'] = strtoupper(filter_input(INPUT_POST, 'city_name', FILTER_SANITIZE_STRING));
                        $data_prep['city_abbr'] = strtoupper(filter_input(INPUT_POST, 'city_abbr', FILTER_SANITIZE_STRING));
                        $data_prep['state_id'] = filter_input(INPUT_POST, 'state_select', FILTER_SANITIZE_STRING);
                        $status = $this->MCity->edit_save_city($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['city_name'] . " Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => $this->load->view('city/show_city', $data, TRUE)));
                            return;
                        } else {
                            $data['city_name'] = filter_input(INPUT_POST, 'city_name', FILTER_SANITIZE_STRING);
                            $data['city_abbr'] = filter_input(INPUT_POST, 'city_abbr', FILTER_SANITIZE_STRING);
                            $data['state_select'] = filter_input(INPUT_POST, 'state_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('city/edit_city', $data, TRUE), 'message' => $status['message']));
                            return;
                        }
                    } else {
                        $data['city_name'] = filter_input(INPUT_POST, 'city_name', FILTER_SANITIZE_STRING);
                        $data['city_abbr'] = filter_input(INPUT_POST, 'city_abbr', FILTER_SANITIZE_STRING);
                        $data['state_select'] = filter_input(INPUT_POST, 'state_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('city/edit_city', $data, TRUE), 'message' => $status['message']));
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
            $data['user_name'] = $this->session->userdata('user_name');
            if (isset($city_id) && !empty($city_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
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
}
