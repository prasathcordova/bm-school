<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Class_controller
 *
 * @author Saranya kumar G
 */
class Class_controller extends MX_Controller
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
        $this->load->model('Class_model', 'MClass');
    }

    public function show_class()
    {

        $data['sub_title'] = 'Class Settings';
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
                'title' => 'Class Settings'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $class_data = $this->MClass->get_all_class_list();
        // dev_export($class_data);
        // die;
        if ($class_data['error_status'] == 0 && $class_data['data_status'] == 1) {
            $data['class_data'] = $class_data['data'];
            $data['message'] = "";
        } else {
            $data['class_data'] = FALSE;
            $data['message'] = $class_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'class');
        $this->session->set_userdata('current_parent', 'course_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['class_data']) && !empty($data['class_data'])) {
                foreach ($data['class_data'] as $class) {

                    $batch_status = "";
                    if ($class['isactive'] == 1) {
                        $batch_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $class['Course_Det_ID'] . '\',\'' . $class['Course_det_code'] . '\', this)" checked id="" class="js-switch"  /></a>';
                    } else {
                        $batch_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $class['Course_Det_ID'] . '\',\'' . $class['Course_det_code'] . '\', this)" id="" class="js-switch"  /></a>';
                    }

                    $task_html = '<a href="javascript:void(0);" onclick="edit_class(\'' . $class['Course_Det_ID'] . '\',\'' . $class['Course_det_code'] . '\',\'' . $class['Description'] . '\',\'' . $class['Course_Name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $class['Course_det_code'] . '" data-original-title="Edit ' . $class['Course_det_code'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';



                    $formatted_data[] = array($class['Course_Name'], $class['Course_det_code'], $class['Description'], $batch_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('class/show_class', $data);
        }
    }

    public function add_class()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Class Management', 'status' => 0, 'link' => base_url('course/show-class')),
                2 => array('message' => 'Add New Class', 'status' => 1)
            );
            $class_course = $this->MClass->get_all_coursename();
            //            dev_export($class_course);die;
            if (isset($class_course['error_status']) && $class_course['error_status'] == 0) {
                if ($class_course['data_status'] == 1) {
                    $data['class_course'] = $class_course['data'];
                } else {
                    $data['class_course'] = FALSE;
                }
            } else {
                $data['class_course'] = FALSE;
            }
            $data['panel_sub_header'] = 'Add New Class';
            $data['breadcrumb'] = $breadcrumb;
            $data['title'] = 'ADD NEW CLASS';
            $this->session->set_userdata('current_page', 'class');
            $this->session->set_userdata('current_parent', 'course_sett');

            if ($onload == 1) {
                $this->load->view('class/add_class', $data);
            } else {
                $this->form_validation->set_rules('course_select', 'Course Name', 'trim|required');

                $this->form_validation->set_rules('class_code', 'Class Code', 'trim|required');
                $this->form_validation->set_rules('class_description', 'Class Description', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data_prep['Course_Master_ID'] = filter_input(INPUT_POST, 'course_select', FILTER_SANITIZE_STRING);

                    $data_prep['code'] = strtoupper(filter_input(INPUT_POST, 'class_code', FILTER_SANITIZE_STRING));
                    $data_prep['Description'] = strtoupper(filter_input(INPUT_POST, 'class_description', FILTER_SANITIZE_STRING));

                    $status = $this->MClass->save_class($data_prep);

                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['code'] . " Added successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['class_code'] = filter_input(INPUT_POST, 'class_code', FILTER_SANITIZE_STRING);
                        $data['Description'] = filter_input(INPUT_POST, 'class_description', FILTER_SANITIZE_STRING);
                        $data['course_select'] = filter_input(INPUT_POST, 'course_select', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('class/add_class', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data['class_code'] = filter_input(INPUT_POST, 'class_code', FILTER_SANITIZE_STRING);
                    $data['description'] = filter_input(INPUT_POST, 'class_description', FILTER_SANITIZE_STRING);
                    $data['course_select'] = filter_input(INPUT_POST, 'course_select', FILTER_SANITIZE_STRING);

                    echo json_encode(array('status' => 3, 'view' => $this->load->view('class/add_class', $data, TRUE), 'message' => $status['message']));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_class()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $course_det_id = filter_input(INPUT_POST, 'course_det_id', FILTER_SANITIZE_NUMBER_INT);
            $Course_det_code = strtoupper(filter_input(INPUT_POST, 'Course_det_code', FILTER_SANITIZE_STRING));
            $Description = strtoupper(filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING));
            //            dev_export($onload);
            //            dev_export($course_det_id);
            //            dev_export($Course_det_code);
            //            dev_export($Description);die;

            if (isset($course_det_id) && !empty($course_det_id)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Class Management', 'status' => 0, 'link' => base_url('course/show-class')),
                    2 => array('message' => 'Edit Class', 'status' => 1)
                );
                $course = $this->MClass->get_all_coursename();
                if (isset($course['error_status']) && $course['error_status'] == 0) {
                    if ($course['data_status'] == 1) {
                        $data['course_data'] = $course['data'];
                    } else {
                        $data['course_data'] = FALSE;
                    }
                } else {
                    $data['course_data'] = FALSE;
                }
                $data['title'] = 'EDIT CLASS - ' . $Course_det_code;
                $data['course_data'] = $course['data'];
                $data['panel_sub_header'] = 'Edit Class - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'class');
                $this->session->set_userdata('current_parent', 'course_sett');

                $class_data_raw = $this->MClass->get_class_details($course_det_id);
                //                dev_export($class_data_raw);die; 

                if (is_array($class_data_raw) && isset($class_data_raw['data_status']) && !empty($class_data_raw['data_status']) && $class_data_raw['data_status'] == 1) {
                    $data['class_data'] = $class_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Class - ' . $data['class_data']['Course_det_code'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Class / No data associated with this class', 'data' => ''));
                    return;
                }
                if ($onload == 1) {

                    $view = $this->load->view('class/edit_class', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('Course_det_code', 'Class Code', 'trim|required');
                    $this->form_validation->set_rules('Description', 'Class Description', 'trim|required');
                    $this->form_validation->set_rules('course_select', 'Course', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['course_det_id'] = filter_input(INPUT_POST, 'course_det_id', FILTER_SANITIZE_STRING);
                        $data_prep['Course_det_code'] = strtoupper(filter_input(INPUT_POST, 'Course_det_code', FILTER_SANITIZE_STRING));
                        $data_prep['Description'] = strtoupper(filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING));
                        $data_prep['Course_Master_ID'] = strtoupper(filter_input(INPUT_POST, 'course_select', FILTER_SANITIZE_STRING));
                        $status = $this->MClass->edit_save_class($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['Course_det_code'] . " Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => ''));
                            return;
                        } else {
                            $data['Course_det_code'] = filter_input(INPUT_POST, 'Course_det_code', FILTER_SANITIZE_STRING);
                            $data['Description'] = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
                            $data['course_select'] = filter_input(INPUT_POST, 'course_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('class/edit_class', $data, TRUE), 'message' => $status['message']));
                            return;
                        }
                    } else {
                        $data['Course_det_code'] = filter_input(INPUT_POST, 'Course_det_code', FILTER_SANITIZE_STRING);
                        $data['Description'] = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
                        $data['course_select'] = filter_input(INPUT_POST, 'course_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('class/edit_class', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Country ID is provided / Invalid Country', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $course_det_id = filter_input(INPUT_POST, 'course_det_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($course_det_id) && !empty($course_det_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['course_det_id'] = filter_input(INPUT_POST, 'course_det_id', FILTER_SANITIZE_STRING);
                $status = $this->MClass->edit_status_class($data_prep);
                if (is_array($status) && $status['status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    echo json_encode(array('status' => 2, 'message' => $status['message'], 'data' => ''));
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
