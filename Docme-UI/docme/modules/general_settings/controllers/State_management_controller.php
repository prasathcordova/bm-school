<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of State_management_controller
 *
 * @author chandrajith.edsys
 */
class State_management_controller extends MX_Controller {

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
        $this->load->model('State_model', 'MState');
    }

   
    public function show_states() {
//        $data['template'] = 'state/show_state';
//        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'STATE MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'State Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $state_data = $this->MState->get_all_state_list();
        if ($state_data['error_status'] == 0 && $state_data['data_status'] == 1) {
            $data['state_data'] = $state_data['data'];
            $data['message'] = "";
        } else {
            $data['state_data'] = FALSE;
            $data['message'] = $state_data['message'];
        }

        
        $this->session->set_userdata('current_page', 'state');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['state_data']) && !empty($data['state_data'])) {
                foreach ($data['state_data'] as $state) {
                    $state_status = "";
                    if ($state['isactive'] == 1) {
                        // $state_status = '<a data-toggle="tooltip" data-placement="right" title="Slide for Enable/Disable" > <input type="checkbox" onchange="change_status(\'' . $state['state_id'] . '\',\'' . $state['state_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                  
                         $state_status='<div class="switch" data-toggle="tooltip" title="Slide for Enable/Disable"><div class="onoffswitch"><input type="checkbox" checked class="onoffswitch-checkbox" onchange="change_status(\'' . $state['state_id'] . '\',\'' . $state['state_name'] . '\', this)" id=""><label class="onoffswitch-label" for="\''.$state['state_id'].'\'"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div></div>';
                    } else {
                        //$state_status = '<a data-toggle="tooltip" data-placement="right" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' .  $state['state_id'] . '\',\'' . $state['state_name'] . '\', this)" id="" class="js-switch"  /></a>';
                        $state_status='<div class="switch" data-toggle="tooltip" title="Slide for Enable/Disable"><div class="onoffswitch"><input type="checkbox" class="onoffswitch-checkbox" onchange="change_status(\'' . $state['state_id'] . '\',\'' . $state['state_name'] . '\', this)" id=""><label class="onoffswitch-label" for="\''.$state['state_id'].'\'"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div></div>';
                    }
                    $task_html = '<a href="javascript:void(0);" class="btn btn-xs btn-info" onclick="edit_state(\'' . $state['state_id']  . '\',\'' . $state['state_name']. '\',\'' . $state['state_abbr'] . '\',\'' . $state['country_name']. '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $state['state_name'] . '" data-original-title="' . $state['state_name'] . '"  ><i class="fa fa-edit" ></i> Update</a>';
                    $formatted_data[] = array($state['state_name'], $state['state_abbr'], $state['country_name'],$state_status, $task_html);
                   
                }
            }

            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('state/show_state', $data);
        }
    }

    public function add_state() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'State Management', 'status' => 0, 'link' => base_url('state/show-state')),
                2 => array('message' => 'Add New State', 'status' => 1)
            );
            $country = $this->MState->get_all_country();
            if (isset($country['error_status']) && $country['error_status'] == 0) {
                if ($country['data_status'] == 1) {
                    $data['country_data'] = $country['data'];
                } else {
                    $data['country_data'] = FALSE;
                }
            } else {
                $data['country_data'] = FALSE;
            }
            $data['panel_sub_header'] = 'Add New State';
            $data['breadcrumb'] = $breadcrumb;
            $data['title'] = 'ADD NEW STATE';
            if ($onload == 1) {
                $this->load->view('state/add_state', $data);
            } else {
            //change validation in state abbrivation
                $this->form_validation->set_rules('state_name', 'State Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('state_abbr', 'State Abbreviation', 'trim|required|min_length[2]|max_length[15]');
                $this->form_validation->set_rules('country_select', 'Country', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data_prep['state_name'] = strtoupper(filter_input(INPUT_POST, 'state_name', FILTER_SANITIZE_STRING));
                    $data_prep['state_abbr'] = strtoupper(filter_input(INPUT_POST, 'state_abbr', FILTER_SANITIZE_STRING));
                    $data_prep['country_id'] = filter_input(INPUT_POST, 'country_select', FILTER_SANITIZE_STRING);
                    $status = $this->MState->save_state($data_prep);   
                    
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['state_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['state_name'] = filter_input(INPUT_POST, 'state_name', FILTER_SANITIZE_STRING);
                        $data['state_abbr'] = filter_input(INPUT_POST, 'state_abbr', FILTER_SANITIZE_STRING);
                        $data['country_select'] = filter_input(INPUT_POST, 'country_select', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('state/add_state', $data, TRUE),'message'=> $status['message']));
                        return;
                    }
                } else {
                    $data['state_name'] = filter_input(INPUT_POST, 'state_name', FILTER_SANITIZE_STRING);
                    $data['state_abbr'] = filter_input(INPUT_POST, 'state_abbr', FILTER_SANITIZE_STRING);
                    $data['country_select'] = filter_input(INPUT_POST, 'country_select', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('state/add_state', $data, TRUE),'message'=> 'Validation failed. Please check if the input are all valid. '));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_state() {
        $data['user_name'] = $this->session->userdata('user_name');
        //dev_export( $data['user_name']);die;

        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $state_id = filter_input(INPUT_POST, 'state_id', FILTER_SANITIZE_NUMBER_INT);
            $country_id = filter_input(INPUT_POST, 'country_id', FILTER_SANITIZE_NUMBER_INT);
            $state_name = strtoupper(filter_input(INPUT_POST, 'state_name', FILTER_SANITIZE_STRING));
            $state_abbr = filter_input(INPUT_POST, 'state_abbr', FILTER_SANITIZE_STRING);
            $data['country_select']=$country_id;
//            dev_export($data);die;
            if (isset($state_id) && !empty($state_id)) {
                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'State Management', 'status' => 0, 'link' => base_url('state/show-state')),
                    2 => array('message' => 'Edit State', 'status' => 1)
                );
               
                $country = $this->MState->get_all_country();

                if (isset($country['error_status']) && $country['error_status'] == 0) {
                    if ($country['data_status'] == 1) {
                        $data['country_data'] = $country['data'];
                    } else {
                        $data['country_data'] = FALSE;
                    }
                } else {
                    $data['country_data'] = FALSE;
                }
               
                $data['title'] = 'EDIT STATE - ' . $state_name;
                $data['country_data'] = $country['data'];
                $data['panel_sub_header'] = 'Edit State - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'state');
                $this->session->set_userdata('current_parent', 'gen_sett');
                $state_data_raw = $this->MState->get_state_details($state_id);
                
                if (is_array($state_data_raw) && isset($state_data_raw['data_status']) && !empty($state_data_raw['data_status']) && $state_data_raw['data_status'] == 1) {
                    $data['state_data'] = $state_data_raw['data'][0];
                    
                    $data['panel_sub_header'] = 'Edit State - ' . $data['state_data']['state_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid State / No data associated with this state', 'data' => ''));
                    return;
                } 
//                dev_export($data);die;
                if ($onload == 1) {
//                    dev_export($data);die;
                    $view = $this->load->view('state/edit_state', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('state_name', 'State Name', 'trim|required|min_length[3]|max_length[30]');
                    $this->form_validation->set_rules('state_abbr', 'State Abbreviation', 'trim|required|min_length[3]|max_length[15]');
                    $this->form_validation->set_rules('country_select', 'Country Name', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['state_id'] = filter_input(INPUT_POST, 'state_id', FILTER_SANITIZE_STRING);
                        $data_prep['state_name'] = strtoupper(filter_input(INPUT_POST, 'state_name', FILTER_SANITIZE_STRING));
                        $data_prep['state_abbr'] = strtoupper(filter_input(INPUT_POST, 'state_abbr', FILTER_SANITIZE_STRING));
                        $data_prep['country_id'] = filter_input(INPUT_POST, 'country_select', FILTER_SANITIZE_STRING);
                        $status = $this->MState->edit_save_state($data_prep);
                        
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['state_name'] . "  Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => $this->load->view('state/show_state', $data, TRUE)));
                            return;
                        } else {
                            $data['state_name'] = filter_input(INPUT_POST, 'state_name', FILTER_SANITIZE_STRING);
                            $data['state_abbr'] = filter_input(INPUT_POST, 'state_abbr', FILTER_SANITIZE_STRING);
                            $data['country_select'] = filter_input(INPUT_POST, 'country_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('state/edit_state', $data, TRUE), 'message' =>$status['message']));
                            return;
                        }
                    } else {
                        $data['state_name'] = filter_input(INPUT_POST, 'state_name', FILTER_SANITIZE_STRING);
                        $data['state_abbr'] = filter_input(INPUT_POST, 'state_abbr', FILTER_SANITIZE_STRING);
                        $data['country_select'] = filter_input(INPUT_POST, 'country_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('state/edit_state', $data, TRUE), 'message' =>$status['message']));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No State ID is provided / Invalid State', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status() {
        if ($this->input->is_ajax_request() == 1) {
            $state_id = filter_input(INPUT_POST, 'state_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($state_id) && !empty($state_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['state_id'] = filter_input(INPUT_POST, 'state_id', FILTER_SANITIZE_STRING);
                $status = $this->MState->edit_status_state($data_prep);
//                dev_export($status);die;
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
