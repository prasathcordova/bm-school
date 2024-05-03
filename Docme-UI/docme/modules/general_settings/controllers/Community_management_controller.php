<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Community_management_controller
 *
 * @author chandrajith.edsys
 */
class Community_management_controller extends MX_Controller {

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
        $this->load->model('Community_model', 'MCommunity');
    }

    public function show_community() {
//         $data['template'] = 'community/show_community';
//        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'COMMUNITY MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Community Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $community_data = $this->MCommunity->get_all_community_list();
        if ($community_data['error_status'] == 0 && $community_data['data_status'] == 1) {
            $data['community_data'] = $community_data['data'];
            $data['message'] = "";
        } else {
            $data['community_data'] = FALSE;
            $data['message'] = $community_data['message'];
        }

        $breadcrumb = array(
            0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
            1 => array('message' => 'Show All Community', 'status' => 1)
        );
        $data['template'] = 'community/show_community';
        $data['panel_header'] = 'Community Management';
        $data['breadcrumb'] = $breadcrumb;
        $this->session->set_userdata('current_page', 'community');
        $this->session->set_userdata('current_parent', 'gen_sett');   
        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['community_data']) && !empty($data['community_data'])) {
                foreach ($data['community_data'] as $community) {
                    $community_status = "";
                    if ($community['isactive'] == 1) {
                      //  $community_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $community['community_id'] . '\', this)" checked id="" class="js-switch"  />';
                      $community_status='<div class="switch">
                      <div class="onoffswitch">
                      <input type="checkbox" checked class="onoffswitch-checkbox pick_status" 
                          onchange="change_status(\'' . $community['community_id'] . '\', this)" id="">
                          <label class="onoffswitch-label" for="\''.$community['community_id'].'\'">
                              <span class="onoffswitch-inner"></span>
                              <span class="onoffswitch-switch"></span>
                          </label>
                      </div>
                  </div>';
                    } else {
                    //    $community_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $community['community_id'] . '\', this)" id="" class="js-switch"  />';
                    $community_status='<div class="switch">
                    <div class="onoffswitch">
                    <input type="checkbox" class="onoffswitch-checkbox pick_status" 
                        onchange="change_status(\'' . $community['community_id'] . '\', this)" id="">
                        <label class="onoffswitch-label" for="\''.$community['community_id'].'\'">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>';
                }
                    $task_html = '<a href="javascript:void(0);" class="btn btn-xs btn-info" onclick="edit_community(\'' . $community['community_id'] . '\',\'' . $community['community_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $community['community_name'] . '" data-original-title="' . $community['community_name']. '"  ><i class="fa fa-edit" ></i>Update</a>';
                    $formatted_data[] = array($community['community_name'], $community_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('community/show_community', $data);
        }
    }

    public function add_community() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Community Management', 'status' => 0, 'link' => base_url('community/show-community')),
                2 => array('message' => 'Add New Community', 'status' => 1)
            );

            $data['panel_sub_header'] = 'Add New Community';
            $data['breadcrumb'] = $breadcrumb;
            $data['title'] = 'ADD NEW COMMUNITY';
            $this->session->set_userdata('current_page', 'community');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('community/add_community', $data);
            } else {

                $this->form_validation->set_rules('community_name', 'Community Name', 'trim|required|max_length[30]|min_length[2]');

                if ($this->form_validation->run() == TRUE) {
                    $data_prep['name'] = strtoupper(filter_input(INPUT_POST, 'community_name', FILTER_SANITIZE_STRING));

                    $status = $this->MCommunity->save_community($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['community_name'] = (filter_input(INPUT_POST, 'community_name', FILTER_SANITIZE_STRING));

                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('community/add_community', $data, TRUE)));
                        return;
                    }
                } else {
                    $data['community_name'] = filter_input(INPUT_POST, 'community_name', FILTER_SANITIZE_STRING);

                    echo json_encode(array('status' => 2, 'view' => $this->load->view('community/add_community', $data, TRUE)));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_community() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $community_id = filter_input(INPUT_POST, 'community_id', FILTER_SANITIZE_NUMBER_INT);
            $community_name = strtoupper(filter_input(INPUT_POST, 'community_name', FILTER_SANITIZE_STRING));
            if (isset($community_id) && !empty($community_id)) {
                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Community Management', 'status' => 0, 'link' => base_url('community/show-community')),
                    2 => array('message' => 'Edit Community', 'status' => 1)
                );
                $data['title'] = 'EDIT COMMUNITY - ' . $community_name;
                $data['panel_sub_header'] = 'Edit Community - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'community');
                $this->session->set_userdata('current_parent', 'gen_sett');
                $data['community_id'] = $community_id;
                $community_data_raw = $this->MCommunity->get_community_details($community_id);
          
                if (is_array($community_data_raw) && isset($community_data_raw['data_status']) && !empty($community_data_raw['data_status']) && $community_data_raw['data_status'] == 1) {
                    $data['community_data'] = $community_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Community - ' . $data['community_data']['community_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Community / No data associated with this community', 'data' => ''));
                    return;
                }
                if ($onload == 1) {
                    $view = $this->load->view('community/edit_community', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('community_name', 'Community Name', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['id'] = filter_input(INPUT_POST, 'community_id', FILTER_SANITIZE_STRING);
                        $data_prep['name'] = strtoupper(filter_input(INPUT_POST, 'community_name', FILTER_SANITIZE_STRING));
                        //$data_prep['community_id'] = filter_input(INPUT_POST, 'community_select', FILTER_SANITIZE_STRING);
                        $status = $this->MCommunity->edit_save_community($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['name'] . "  Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => $this->load->view('community/show_community', $data, TRUE)));
                            return;
                        } else {
                            $data['community_name'] = strtoupper(filter_input(INPUT_POST, 'community_name', FILTER_SANITIZE_STRING));
                            //$data['community_select'] = filter_input(INPUT_POST, 'community_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('community/edit_community', $data, TRUE)));
                            return;
                        }
                    } else {
                        $data['community_name'] = filter_input(INPUT_POST, 'community_name', FILTER_SANITIZE_STRING);
                        //$data['community_select'] = filter_input(INPUT_POST, 'community_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('community/edit_community', $data, TRUE)));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Community ID is provided / Invalid Community', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status() {
        if ($this->input->is_ajax_request() == 1) {
            $community_id = filter_input(INPUT_POST, 'community_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($community_id) && !empty($community_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['id'] = filter_input(INPUT_POST, 'community_id', FILTER_SANITIZE_STRING);
                $status = $this->MCommunity->edit_status_community($data_prep);
                //dev_export($status);die;
                if (is_array($status) && $status['status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    echo json_encode(array('status' => 2, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                    return;
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                return;
            }
        } else {
            echo json_encode(array('status' => 4, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
            return;
        }
    }

}