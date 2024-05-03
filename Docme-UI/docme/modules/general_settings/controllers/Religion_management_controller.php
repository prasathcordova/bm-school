<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Religion_management_controller
 *
 * @author chandrajith.edsys
 */
class Religion_management_controller extends MX_Controller
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
        $this->load->model('Religion_model', 'MReligion');
    }


    public function show_religion()
    {
        //        $data['template'] = 'religion/show_religion';
        //        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'RELIGION MANAGEMENT';
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
                'title' => 'Religion Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $religion_data = $this->MReligion->get_all_religion();
        //dev_export($religion_data);die;
        if ($religion_data['error_status'] == 0 && $religion_data['data_status'] == 1) {
            $data['religion_data'] = $religion_data['data'];
            $data['message'] = "";
        } else {
            $data['religion_data'] = FALSE;
            $data['message'] = $religion_data['message'];
        }

        $this->session->set_userdata('current_page', 'religion');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['religion_data']) && !empty($data['religion_data'])) {
                foreach ($data['religion_data'] as $religion) {
                    $religion_status = "";
                    if ($religion['isactive'] == 1) {
                        $religion_status='<div class="switch">
                        <div class="onoffswitch">
                        <input type="checkbox" checked class="onoffswitch-checkbox pick_status" 
                            onchange="change_status(\'' . $religion['religion_id'] . '\', this)" id="">
                            <label class="onoffswitch-label" for="\''.$religion['religion_id'].'\'">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>';
                      //  $religion_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $religion['religion_id'] . '\', this)" checked id="" class="js-switch"  />';
                    } else {
                        $religion_status='<div class="switch">
                        <div class="onoffswitch">
                        <input type="checkbox"  class="onoffswitch-checkbox pick_status" 
                            onchange="change_status(\'' . $religion['religion_id'] . '\', this)" id="">
                            <label class="onoffswitch-label" for="\''.$religion['religion_id'].'\'">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>';
                      //  $religion_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $religion['religion_id'] . '\', this)" id="" class="js-switch"  />';
                    }
                    $task_html = '<a href="javascript:void(0);" class="btn btn-xs btn-info" onclick="edit_religion(\'' . $religion['religion_id'] . '\',\'' . $religion['religion_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $religion['religion_name'] . '" data-original-title="' . $religion['religion_name'] . '"  ><i class="fa fa-edit" ></i>Update</a>';
                    $formatted_data[] = array($religion['religion_name'], $religion_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('religion/show_religion', $data);
        }
    }

    public function add_religion()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Religion Management', 'status' => 0, 'link' => base_url('religion/show-religion')),
                2 => array('message' => 'Add New Religion', 'status' => 1)
            );

            $data['panel_sub_header'] = 'Add New Religion';
            $data['breadcrumb'] = $breadcrumb;
            $data['title'] = 'ADD NEW RELIGION';
            $this->session->set_userdata('current_page', 'religion');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('religion/add_religion', $data);
            } else {

                $this->form_validation->set_rules('religion_name', 'Religion Name', 'trim|required|min_length[3]|max_length[30]');

                if ($this->form_validation->run() == TRUE) {
                    $data_prep['name'] = strtoupper(filter_input(INPUT_POST, 'religion_name', FILTER_SANITIZE_STRING));
                    //$data_prep['name'] = filter_input(INPUT_POST, 'religion_name', FILTER_SANITIZE_STRING);

                    $status = $this->MReligion->save_religion($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['religion_name'] = filter_input(INPUT_POST, 'religion_name', FILTER_SANITIZE_STRING);

                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('religion/add_religion', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data['religion_name'] = filter_input(INPUT_POST, 'religion_name', FILTER_SANITIZE_STRING);

                    echo json_encode(array('status' => 3, 'view' => $this->load->view('religion/add_religion', $data, TRUE), 'message' => $status['message']));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_religion()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $religion_id = filter_input(INPUT_POST, 'religion_id', FILTER_SANITIZE_NUMBER_INT);
            $religion_name = strtoupper(filter_input(INPUT_POST, 'religion_name', FILTER_SANITIZE_STRING));
            if (isset($religion_id) && !empty($religion_id)) {
                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Religion Management', 'status' => 0, 'link' => base_url('religion/show-religion')),
                    2 => array('message' => 'Edit Religion', 'status' => 1)
                );
                $data['title'] = 'EDIT RELIGION - ' . $religion_name;
                $data['panel_sub_header'] = 'Edit Religion - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'religion');
                $this->session->set_userdata('current_parent', 'gen_sett');
                $data['religion_id'] = $religion_id;
                $religion_data_raw = $this->MReligion->get_religion_details($religion_id);

                if (is_array($religion_data_raw) && isset($religion_data_raw['data_status']) && !empty($religion_data_raw['data_status']) && $religion_data_raw['data_status'] == 1) {
                    $data['religion_data'] = $religion_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Religion - ' . $data['religion_data']['religion_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Religion / No data associated with this religion', 'data' => ''));
                    return;
                }
                if ($onload == 1) {
                    $view = $this->load->view('religion/edit_religion', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('religion_name', 'Religion Name', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['id'] = filter_input(INPUT_POST, 'religion_id', FILTER_SANITIZE_STRING);
                        $data_prep['name'] = strtoupper(filter_input(INPUT_POST, 'religion_name', FILTER_SANITIZE_STRING));
                        $status = $this->MReligion->edit_save_religion($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['name'] . "  Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => $this->load->view('religion/show_religion', $data, TRUE)));
                            return;
                        } else {
                            $data['religion_name'] = filter_input(INPUT_POST, 'religion_name', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('religion/edit_religion', $data, TRUE), 'message' => $status['message']));
                            return;
                        }
                    } else {
                        $data['religion_name'] = filter_input(INPUT_POST, 'religion_name', FILTER_SANITIZE_STRING);
                        //$data['religion_select'] = filter_input(INPUT_POST, 'religion_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('religion/edit_religion', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Religion ID is provided / Invalid Religion', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $religion_id = filter_input(INPUT_POST, 'religion_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($religion_id) && !empty($religion_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['id'] = filter_input(INPUT_POST, 'religion_id', FILTER_SANITIZE_STRING);
                //dev_export($data_prep);die;
                $status = $this->MReligion->edit_status_religion($data_prep);

                if (isset($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status['message'], 'data' => ''));
                        return;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                        return;
                    }
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
