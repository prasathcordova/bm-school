<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Currency_management_controller
 *
 * @author chandrajith.edsys
 */
class Currency_management_controller extends MX_Controller {

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
        $this->load->model('Currency_model', 'MCurrency');
    }

    public function show_currency() {
//        $data['template'] = 'currency/show_currency';
      //  $data['template'] = 'currency/show-currency';
        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'CURRENCY MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Currency Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $currency_data = $this->MCurrency->get_all_currency_list();
        if ($currency_data['error_status'] == 0 && $currency_data['data_status'] == 1) {
            $data['currency_data'] = $currency_data['data'];
            $data['message'] = "";
        } else {
            $data['currency_data'] = FALSE;
            $data['message'] = $currency_data['message'];
        }

        
        $this->session->set_userdata('current_page', 'currency');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['currency_data']) && !empty($data['currency_data'])) {
                foreach ($data['currency_data'] as $currency) {
                    $currency_status = "";
                    if ($currency['isactive'] == 1) {
                        // $currency_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $currency['currency_id'] . '\',\'' . $currency['currency_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        //$currency_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $currency['currency_id'] . '\',\'' . $currency['currency_name'] . '\');"/><span></span></label>';
                        $currency_status='<div class="switch">
                        <div class="onoffswitch">
                        <input type="checkbox" checked class="onoffswitch-checkbox pick_status" 
                            onchange="change_status(\'' . $currency['currency_id'] . '\', this)" id="">
                            <label class="onoffswitch-label" for="\''.$currency['currency_id'].'\'">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>';
                    } else {
                       // $currency_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $currency['currency_id'] . '\',\'' . $currency['currency_name'] . '\', this)" id="" class="js-switch"  /></a>';
                       // $currency_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $currency['currency_id'] . '\',\'' . $currency['currency_name'] . '\');"/><span></span></label>';
                       $currency_status='<div class="switch">
                       <div class="onoffswitch">
                       <input type="checkbox" class="onoffswitch-checkbox pick_status" 
                           onchange="change_status(\'' . $currency['currency_id'] . '\', this)" id="">
                           <label class="onoffswitch-label" for="\''.$currency['currency_id'].'\'">
                               <span class="onoffswitch-inner"></span>
                               <span class="onoffswitch-switch"></span>
                           </label>
                       </div>
                   </div>';
                    }
                    $task_html = '<a href="javascript:void(0);" class="btn btn-xs btn-info" onclick="edit_currency(\'' . $currency['currency_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $currency['currency_name'] . '" data-original-title="Edit ' . $currency['currency_name'] . '"  ><i class="fa fa-edit" ></i>Update</a>';
                    $formatted_data[] = array($currency['currency_name'], $currency['currency_abbr'], $currency_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('currency/show_currency', $data);
        }
    }

    public function add_currency() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Currency Management', 'status' => 0, 'link' => base_url('currency/show-currency')),
                2 => array('message' => 'Add New Currency', 'status' => 1)
            );

            $data['panel_sub_header'] = 'Add New Currency';
            $data['breadcrumb'] = $breadcrumb;
            $data['title'] = 'ADD NEW CURRENCY';
            $this->session->set_userdata('current_page', 'currency');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('currency/add_currency', $data);
            } else {
                 
                $this->form_validation->set_rules('currency_name', 'Currency Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('currency_abbr', 'Currency Abbreviation','trim|required|min_length[3]|max_length[15]');
                
                if ($this->form_validation->run() == TRUE) {
                    
                    $data_prep['currency_name'] = strtoupper(filter_input(INPUT_POST, 'currency_name', FILTER_SANITIZE_STRING));
                    $data_prep['currency_abbr'] = strtoupper(filter_input(INPUT_POST, 'currency_abbr', FILTER_SANITIZE_STRING));
                    
                    $status = $this->MCurrency->save_currency($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['currency_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['currency_name'] = filter_input(INPUT_POST, 'currency_name', FILTER_SANITIZE_STRING);
                        $data['currency_abbr'] = filter_input(INPUT_POST, 'currency_abbr', FILTER_SANITIZE_STRING);

                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('currency/add_currency', $data, TRUE),'message'=>$status['message']));
                        return;
                    }
                } else {
                    $data['currency_name'] = filter_input(INPUT_POST, 'currency_name', FILTER_SANITIZE_STRING);
                    $data['currency_abbr'] = filter_input(INPUT_POST, 'currency_abbr', FILTER_SANITIZE_STRING);

                    echo json_encode(array('status' => 3, 'view' => $this->load->view('currency/add_currency', $data, TRUE),'message'=>$status['message']));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_currency() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $currency_id = filter_input(INPUT_POST, 'currency_id', FILTER_SANITIZE_NUMBER_INT);
            $currency_name = filter_input(INPUT_POST, 'currency_name', FILTER_SANITIZE_STRING);
            $currency_abbr = filter_input(INPUT_POST, 'currency_abbr', FILTER_SANITIZE_STRING);
            if (isset($currency_id) && !empty($currency_id)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Currency Management', 'status' => 0, 'link' => base_url('currency/show-currency')),
                    2 => array('message' => 'Edit Currency', 'status' => 1)
                );

                
                //$data['panel_sub_header'] = 'Edit Currency - ';
                $data['breadcrumb'] = $breadcrumb;
                $data['currency_id'] = $currency_id;
//                $this->session->set_userdata('current_page', 'currency');
//                $this->session->set_userdata('current_parent', 'gen_sett');

                $currency_data_raw = $this->MCurrency->get_currency_details($currency_id);

                if (is_array($currency_data_raw) && isset($currency_data_raw['data_status']) && !empty($currency_data_raw['data_status']) && $currency_data_raw['data_status'] == 1) {
                    $data['currency_data'] = $currency_data_raw['data'][0];
                    $data['currency_id'] = $currency_data_raw['data'][0]['currency_id'];
                    $data['currency_name'] = $currency_data_raw['data'][0]['currency_name'];
                    $data['currency_abbr'] = $currency_data_raw['data'][0]['currency_abbr'];
                    $data['title'] = 'EDIT CURRENCY - ' . $data['currency_data']['currency_name'];
//                    dev_export($data);die;
                    $data['panel_sub_header'] = 'Edit Currency - ' . $data['currency_data']['currency_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Currency / No data associated with this currency', 'data' => ''));
                    return;
                }
                if ($onload == 1) {

                    $view = $this->load->view('currency/edit_currency', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('currency_name', 'Currency Name', 'trim|required|min_length[3]|max_length[30]');
                    $this->form_validation->set_rules('currency_abbr', 'Currency Abbreviation','trim|required|min_length[3]|max_length[15]');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['currency_id'] = filter_input(INPUT_POST, 'currency_id', FILTER_SANITIZE_STRING);
                        $data_prep['currency_name'] = strtoupper(filter_input(INPUT_POST, 'currency_name', FILTER_SANITIZE_STRING));
                        $data_prep['currency_abbr'] = strtoupper(filter_input(INPUT_POST, 'currency_abbr', FILTER_SANITIZE_STRING));
                        $status = $this->MCurrency->edit_save_currency($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['currency_name'] . "  Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => $this->load->view('currency/show_currency', $data, TRUE)));
                            return;
                        } else {
                            $data['currency_name'] = filter_input(INPUT_POST, 'currency_name', FILTER_SANITIZE_STRING);
                            $data['currency_abbr'] = filter_input(INPUT_POST, 'currency_abbr', FILTER_SANITIZE_STRING);
                            //$data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('currency/edit_currency', $data, TRUE),'message'=>$status['message']));
                            return;
                        }
                    } else {
                        $data['currency_name'] = filter_input(INPUT_POST, 'currency_name', FILTER_SANITIZE_STRING);
                        $data['currency_abbr'] = filter_input(INPUT_POST, 'currency_abbr', FILTER_SANITIZE_STRING);
                        //$data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('currency/edit_currency', $data, TRUE),'message'=>$status['message']));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Currency ID is provided / Invalid Currency', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status() {
        if ($this->input->is_ajax_request() == 1) {
            $currency_id = filter_input(INPUT_POST, 'currency_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($currency_id) && !empty($currency_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['currency_id'] = filter_input(INPUT_POST, 'currency_id', FILTER_SANITIZE_STRING);
                $status = $this->MCurrency->edit_status_currency($data_prep);

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