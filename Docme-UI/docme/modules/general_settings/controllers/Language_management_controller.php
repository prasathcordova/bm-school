<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Language_management_controller
 *
 * @author chandrajith.edsys
 */
class Language_management_controller extends MX_Controller {

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
        $this->load->model('Language_model', 'MLanguage');
    }

    public function show_language() {
//        $data['template'] = 'language/show_language';
//        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'LANGUAGE MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Language Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $language_data = $this->MLanguage->get_all_language_list();
        if ($language_data['error_status'] == 0 && $language_data['data_status'] == 1) {
            $data['language_data'] = $language_data['data'];
            $data['message'] = "";
        } else {
            $data['language_data'] = FALSE;
            $data['message'] = $language_data['message'];
        }


        $this->session->set_userdata('current_page', 'language');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['language_data']) && !empty($data['language_data'])) {
                foreach ($data['language_data'] as $language) {
                    $language_status = "";
                    if ($language['isactive'] == 1) {
                        //$language_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $language['language_id'] . '\',\'' . $language['language_id'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        // $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" checked id="" class="js-switch"  />';
                        $language_status='<div class="switch">
                        <div class="onoffswitch">
                        <input type="checkbox" checked class="onoffswitch-checkbox pick_status" 
                            onchange="change_status(\'' . $language['language_id'] . '\', this)" id="">
                            <label class="onoffswitch-label" for="\''.$language['language_id'].'\'">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>';
                    } else {
                       // $language_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $language['language_id'] . '\',\'' . $language['language_id'] . '\', this)" id="" class="js-switch"  /></a>';
                       // $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" id="" class="js-switch"  />';
                       $language_status='<div class="switch">
                       <div class="onoffswitch">
                       <input type="checkbox" class="onoffswitch-checkbox pick_status" 
                           onchange="change_status(\'' . $language['language_id'] . '\', this)" id="">
                           <label class="onoffswitch-label" for="\''.$language['language_id'].'\'">
                               <span class="onoffswitch-inner"></span>
                               <span class="onoffswitch-switch"></span>
                           </label>
                       </div>
                   </div>';
                    }
                    $task_html = '<a href="javascript:void(0);" class="btn btn-xs btn-info" onclick="edit_language(\'' . $language['language_id'] . '\',\'' . $language['language_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $language['language_name'] . '" data-original-title="' . $language['language_name'] . '"  ><i class="fa fa-edit" ></i>Update</a>';
                    $formatted_data[] = array($language['language_name'], $language_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('language/show_language', $data);
        }
    }

    public function add_language() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Language Management', 'status' => 0, 'link' => base_url('language/show-language')),
                2 => array('message' => 'Add New Language', 'status' => 1)
            );

            $data['panel_sub_header'] = 'Add New Language';
            $data['breadcrumb'] = $breadcrumb;
            $data['title'] = 'ADD NEW LANGUAGE';
            $this->session->set_userdata('current_page', 'language');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('language/add_language', $data);
            } else {

                $this->form_validation->set_rules('language_name', 'Language Name', 'trim|required|min_length[3]|max_length[30]');

                if ($this->form_validation->run() == TRUE) {
                    $data_prep['language_name'] = strtoupper(filter_input(INPUT_POST, 'language_name', FILTER_SANITIZE_STRING));

                    $status = $this->MLanguage->save_language($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['language_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['language_name'] = strtoupper(filter_input(INPUT_POST, 'language_name', FILTER_SANITIZE_STRING));

                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('language/add_language', $data, TRUE),'message'=>$status['message']));
                        return;
                    }
                } else {
                    $data['language_name'] = strtoupper(filter_input(INPUT_POST, 'language_name', FILTER_SANITIZE_STRING));

                    echo json_encode(array('status' => 3, 'view' => $this->load->view('language/add_language', $data, TRUE),'message'=>$status['message']));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_language() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $language_id = filter_input(INPUT_POST, 'language_id', FILTER_SANITIZE_NUMBER_INT);
            $language_name = strtoupper(filter_input(INPUT_POST, 'language_name', FILTER_SANITIZE_STRING));
            if (isset($language_id) && !empty($language_id)) {
                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Language Management', 'status' => 0, 'link' => base_url('language/show-language')),
                    2 => array('message' => 'Edit Language', 'status' => 1)
                );
                $data['title'] = 'EDIT LANGUAGE - ' . $language_name;
                $data['breadcrumb'] = $breadcrumb;
                $data['language_id'] = $language_id;
                $language_data_raw = $this->MLanguage->get_language_details($language_id);

                if (is_array($language_data_raw) && isset($language_data_raw['data_status']) && !empty($language_data_raw['data_status']) && $language_data_raw['data_status'] == 1) {
                    $data['language_data'] = $language_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Language - ' . $data['language_data']['language_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Language / No data associated with this language', 'data' => ''));
                    return;
                }
                if ($onload == 1) {
                    $view = $this->load->view('language/edit_language', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('language_name', 'Language Name', 'trim|required|min_length[3]|max_length[30]');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['id'] = filter_input(INPUT_POST, 'language_id', FILTER_SANITIZE_STRING);
                        $data_prep['name'] = strtoupper(filter_input(INPUT_POST, 'language_name', FILTER_SANITIZE_STRING));
                        //$data_prep['language_id'] = filter_input(INPUT_POST, 'language_select', FILTER_SANITIZE_STRING);
                        $status = $this->MLanguage->edit_save_language($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['name'] . "  Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => $this->load->view('language/show_language', $data, TRUE)));
                            return;
                        } else {
                            $data['language_name'] = strtoupper(filter_input(INPUT_POST, 'language_name', FILTER_SANITIZE_STRING));
                            //$data['language_select'] = filter_input(INPUT_POST, 'language_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('language/edit_language', $data, TRUE),'message'=>$status['message']));
                            return;
                        }
                    } else {
                        $data['language_name'] = strtoupper(filter_input(INPUT_POST, 'language_name', FILTER_SANITIZE_STRING));
                        //$data['language_select'] = filter_input(INPUT_POST, 'language_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('language/edit_language', $data, TRUE),'message'=>$status['message']));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Language ID is provided / Invalid Language', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status() {
        if ($this->input->is_ajax_request() == 1) {
            $language_id = filter_input(INPUT_POST, 'language_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($language_id) && !empty($language_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['id'] = filter_input(INPUT_POST, 'language_id', FILTER_SANITIZE_STRING);
                //dev_export($data_prep);die;
                $status = $this->MLanguage->edit_status_language($data_prep);

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