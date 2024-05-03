<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profession_management_controller
 *
 * @author chandrajith.edsys
 */
class Profession_mangement_controller extends MX_Controller
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
        $this->load->model('Profession_model', 'MProfession');
    }

    public function show_profession()
    {
        //        $data['template'] = 'profession/show_profession';
        //        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'PROFESSION MANAGEMENT';
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
                'title' => 'Profession Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $profession_data = $this->MProfession->get_all_profession_list();
        if ($profession_data['error_status'] == 0 && $profession_data['data_status'] == 1) {
            $data['profession_data'] = $profession_data['data'];
            $data['message'] = "";
        } else {
            $data['profession_data'] = FALSE;
            $data['message'] = $profession_data['message'];
        }


        $this->session->set_userdata('current_page', 'profession');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['profession_data']) && !empty($data['profession_data'])) {
                foreach ($data['profession_data'] as $profession) {
                    $profession_status = "";
                    if ($profession['isactive'] == 1) {
                       // $profession_status = '<a data-toggle="tooltip" data-placement="right" title="Slide for Enable/Disable" > <input type="checkbox" onchange="change_status(\'' . $profession['profession_id'] . '\', this)" checked id="" class="js-switch"  /></a>';
                       $profession_status='<div class="switch">
                       <div class="onoffswitch">
                       <input type="checkbox" checked class="onoffswitch-checkbox pick_status" 
                           onchange="change_status(\'' . $profession['profession_id'] . '\', this)" id="">
                           <label class="onoffswitch-label" for="\''.$profession['profession_id'].'\'">
                               <span class="onoffswitch-inner"></span>
                               <span class="onoffswitch-switch"></span>
                           </label>
                       </div>
                   </div>';
                    } else {
                       // $profession_status = '<a data-toggle="tooltip" data-placement="right" title="Slide for Enable/Disable" ><input type="checkbox" data-toggle="tooltip" data-placement="right" title="Slide for Enable/Disable" onchange="change_status(\'' . $profession['profession_id'] . '\', this)" id="" class="js-switch"  /></a>';
                       $profession_status='<div class="switch">
                       <div class="onoffswitch">
                       <input type="checkbox" class="onoffswitch-checkbox pick_status" 
                           onchange="change_status(\'' . $profession['profession_id'] . '\', this)" id="">
                           <label class="onoffswitch-label" for="\''.$profession['profession_id'].'\'">
                               <span class="onoffswitch-inner"></span>
                               <span class="onoffswitch-switch"></span>
                           </label>
                       </div>
                   </div>';
                    }
                    $task_html = '<a href="javascript:void(0);" class="btn btn-xs btn-info" onclick="edit_profession(\'' . $profession['profession_id'] . '\',\'' . $profession['profession_name'] . '\',\'' . $profession['profession_code'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $profession['profession_name'] . '" data-original-title="' . $profession['profession_name'] . '"  ><i class="fa fa-edit" ></i>Update</a>';
                    $formatted_data[] = array($profession['profession_name'], $profession['profession_code'], $profession_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('profession/show_profession', $data);
        }
    }

    public function add_profession()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('title' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('title' => 'Profession Management', 'status' => 0, 'link' => base_url('profession/show-profession')),
                2 => array('title' => 'Add New Profession', 'status' => 1)
            );
            $data['panel_sub_header'] = 'Add New Profession';
            $data['breadcrumb'] = $breadcrumb;
            $data['title'] = 'ADD NEW PROFESSION';
            if ($onload == 1) {
                $this->load->view('profession/add_profession', $data);
            } else {
                $this->form_validation->set_rules('profession_name', 'Profession Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('profession_code', 'Profession Description', 'trim|required|min_length[3]|max_length[15]');

                if ($this->form_validation->run() == TRUE) {
                    $data_prep['profession_name'] = strtoupper(filter_input(INPUT_POST, 'profession_name', FILTER_SANITIZE_STRING));
                    $data_prep['profession_code'] = strtoupper(filter_input(INPUT_POST, 'profession_code', FILTER_SANITIZE_STRING));
                    $status = $this->MProfession->save_profession($data_prep);
                    //dev_export($status);die;
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['profession_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['profession_name'] = filter_input(INPUT_POST, 'profession_name', FILTER_SANITIZE_STRING);
                        $data['profession_code'] = filter_input(INPUT_POST, 'profession_code', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('profession/add_profession', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data['profession_name'] = filter_input(INPUT_POST, 'profession_name', FILTER_SANITIZE_STRING);
                    $data['profession_code'] = filter_input(INPUT_POST, 'profession_code', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('profession/add_profession', $data, TRUE), 'message' => $status['message']));
                    return;
                }
            }
        } else {
        }
    }

    public function edit_profession()
    {

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $profession_id = filter_input(INPUT_POST, 'profession_id', FILTER_SANITIZE_NUMBER_INT);
            $profession_name = strtoupper(filter_input(INPUT_POST, 'profession_name', FILTER_SANITIZE_STRING));
            $profession_code = strtoupper(filter_input(INPUT_POST, 'profession_code', FILTER_SANITIZE_STRING));

            if (isset($profession_id) && !empty($profession_id)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Profession Management', 'status' => 0, 'link' => base_url('profession/show-profession')),
                    2 => array('message' => 'Edit Profession', 'status' => 1)
                );

                $data['title'] = 'EDIT PROFESSION - ' . $profession_name;
                $data['breadcrumb'] = $breadcrumb;
                $data['profession_id'] = $profession_id;
                $profession_data_raw = $this->MProfession->get_profession_details($profession_id);

                if (is_array($profession_data_raw) && isset($profession_data_raw['data_status']) && !empty($profession_data_raw['data_status']) && $profession_data_raw['data_status'] == 1) {
                    $data['profession_data'] = $profession_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Profession - ' . $data['profession_data']['profession_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Profession / No data associated with this profession', 'data' => ''));
                    return;
                }
                if ($onload == 1) {

                    $view = $this->load->view('profession/edit_profession', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('profession_name', 'Profession Name', 'trim|required');
                    $this->form_validation->set_rules('profession_code', 'Profession Code', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['profession_id'] = filter_input(INPUT_POST, 'profession_id', FILTER_SANITIZE_STRING);
                        $data_prep['profession_name'] = strtoupper(filter_input(INPUT_POST, 'profession_name', FILTER_SANITIZE_STRING));
                        $data_prep['profession_code'] = strtoupper(filter_input(INPUT_POST, 'profession_code', FILTER_SANITIZE_STRING));
                        $status = $this->MProfession->edit_save_profession($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['profession_name'] . "  Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => $this->load->view('profession/show_profession', $data, TRUE)));
                            return;
                        } else {
                            $data['profession_name'] = filter_input(INPUT_POST, 'profession_name', FILTER_SANITIZE_STRING);
                            $data['profession_code'] = filter_input(INPUT_POST, 'profession_code', FILTER_SANITIZE_STRING);
                            //$data['profession_select'] = filter_input(INPUT_POST, 'profession_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('profession/edit_profession', $data, TRUE), 'message' => $status['message']));
                            return;
                        }
                    } else {
                        $data['profession_name'] = filter_input(INPUT_POST, 'profession_name', FILTER_SANITIZE_STRING);
                        $data['profession_code'] = filter_input(INPUT_POST, 'profession_code', FILTER_SANITIZE_STRING);
                        //$data['profession_select'] = filter_input(INPUT_POST, 'profession_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('profession/edit_profession', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Profession ID is provided / Invalid Profession', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $profession_id = filter_input(INPUT_POST, 'profession_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($profession_id) && !empty($profession_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['profession_id'] = filter_input(INPUT_POST, 'profession_id', FILTER_SANITIZE_STRING);
                $status = $this->MProfession->edit_status_profession($data_prep);

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
