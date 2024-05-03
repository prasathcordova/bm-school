<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Course__controller
 *
 * @author chandrajith.edsys
 */
class Course_controller extends MX_Controller
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
        $this->load->model('Course_model', 'MCourse');
    }

    public function show_chart()
    {

        //        $data['template'] = 'settings/show_graph';
        //        $data['title'] = 'STORE SETTINGS';
        $data['sub_title'] = 'Advance Settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Advance Settings'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);

        $this->load->view('settings/show_graph', $data);
    }

    public function show_course()
    {

        $data['sub_title'] = 'COURSE MANAGEMENT';
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
        $data['user_name'] = $this->session->userdata('user_name');
        $course_data = $this->MCourse->get_all_course_list();

        if ($course_data['error_status'] == 0 && $course_data['data_status'] == 1) {
            $data['course_data'] = $course_data['data'];
            $data['message'] = "";
        } else {
            $data['course_data'] = FALSE;
            $data['message'] = $course_data['message'];
        }



        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['course_data']) && !empty($data['course_data'])) {
                foreach ($data['course_data'] as $course) {
                    $course_status = "";
                    if ($course['isactive'] == 1) {
                        $course_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $course['Course_Det_ID'] . '\',\'' . $course['Description'] . '\', this)" checked id="" class="js-switch"  /></a>';
                    } else {
                        $course_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $course['Course_Det_ID'] . '\',\'' . $course['Description'] . '\', this)" id="" class="js-switch"  /></a>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_course(\'' . $course['Course_Det_ID'] . '\',\'' . $course['Description'] . '\',\'' . $course['Category'] . '\',\'' . $course['Duration'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $course['Description'] . '" data-original-title="Edit ' . $course['Description'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';

                    $formatted_data[] = array($course['Description'], $course['Category'], $course['Duration'], $course_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('course/show_course', $data);
        }
    }

    public function add_course()
    {

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Course Management', 'status' => 0, 'link' => base_url('course/show-course')),
                2 => array('message' => 'Add New Course', 'status' => 1)
            );
            $category = $this->MCourse->get_all_category_list();
            if (isset($category['error_status']) && $category['error_status'] == 0) {
                if ($category['data_status'] == 1) {
                    $data['category_data'] = $category['data'];
                } else {
                    $data['category_data'] = FALSE;
                }
            } else {
                $data['category_data'] = FALSE;
            }
            $data['title'] = 'ADD NEW COURSE';
            $data['category_data'] = $category['data'];
            $data['panel_sub_header'] = 'Add New Course';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'course');
            $this->session->set_userdata('current_parent', 'course_sett');

            if ($onload == 1) {
                $this->load->view('course/add_course', $data);
            } else {

                $this->form_validation->set_rules('Description', 'Course Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('category_select', 'Category', 'trim|required');
                $this->form_validation->set_rules('Duration', 'Duration', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data_prep['Description'] = strtoupper(filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING));
                    $data_prep['Course_Type_ID'] = strtoupper(filter_input(INPUT_POST, 'category_select', FILTER_SANITIZE_STRING));
                    $data_prep['Duration'] = filter_input(INPUT_POST, 'Duration', FILTER_SANITIZE_NUMBER_INT);

                    $status = $this->MCourse->save_course($data_prep);
                    //                    dev_export($status);die;
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['Description'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['Description'] = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
                        $data['Course_Type_ID'] = filter_input(INPUT_POST, 'category_select', FILTER_SANITIZE_STRING);
                        $data['Duration'] = filter_input(INPUT_POST, 'Duration', FILTER_SANITIZE_NUMBER_INT);

                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('course/add_course', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data['Description'] = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
                    $data['Course_Type_ID'] = filter_input(INPUT_POST, 'category_select', FILTER_SANITIZE_STRING);
                    $data['Duration'] = filter_input(INPUT_POST, 'Duration', FILTER_SANITIZE_NUMBER_INT);

                    echo json_encode(array('status' => 3, 'view' => $this->load->view('course/add_course', $data, TRUE)));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function password_check($str)
    {
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
            return TRUE;
        }
        return FALSE;
    }

    public function show_course_settings()
    {
        $data['template'] = 'settings/show_settings';
        $data['title'] = 'COURSE SETTINGS';
        $data['sub_title'] = 'course settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Course Management',
                'link' => base_url('course/show-course')
            ),
            '2' => array(
                'title' => 'Course Settings'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $course_data = $this->MCourse->get_all_course_list();
        if ($course_data['error_status'] == 0 && $course_data['data_status'] == 1) {
            $data['$course_data'] = $course_data['data'];
            $data['message'] = "";
        } else {
            $data['$course_data'] = FALSE;
            $data['message'] = $course_data['message'];
        }
        $active_data = $this->MCourse->get_active_count();
        //        dev_export($active_data);die;
        if ($active_data['error_status'] == 0 && $active_data['data_status'] == 1) {
            $data['active_data'] = $active_data['data'];
            $data['message'] = "";
        } else {
            $data['active_data'] = FALSE;
            $data['message'] = $active_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['course_data']) && !empty($data['course_data'])) {
                foreach ($data['course_data'] as $course) {
                    $course_status = "";
                    if ($course['isactive'] == 1) {
                        $course_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $course['Course_Det_ID'] . '\',\'' . $course['Description'] . '\');"/><span></span></label>';
                    } else {
                        $course_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $course['Course_Det_ID'] . '\',\'' . $course['Description'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_course(\'' . $course['Course_Det_ID'] . '\',\'' . $course['Description'] . '\',\'' . $course['Category'] . '\',\'' . $course['Duration'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $course['Description'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>';
                    $formatted_data[] = array($course['Description'], $course['Category'], $course['Duration'], $course_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('template/home_template', $data);
        }
    }

    public function edit_course()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $Course_Det_ID = filter_input(INPUT_POST, 'Course_Det_ID', FILTER_SANITIZE_NUMBER_INT);
            $Description = strtoupper(filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING));
            $Duration = filter_input(INPUT_POST, 'Duration', FILTER_SANITIZE_NUMBER_INT);

            if (isset($Course_Det_ID) && !empty($Course_Det_ID)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Course Management', 'status' => 0, 'link' => base_url('course/show-course')),
                    2 => array('message' => 'Edit Course', 'status' => 1)
                );
                $category = $this->MCourse->get_all_category_list();
                if (isset($category['error_status']) && $category['error_status'] == 0) {
                    if ($category['data_status'] == 1) {
                        $data['category_data'] = $category['data'];
                    } else {
                        $data['category_data'] = FALSE;
                    }
                } else {
                    $data['category_data'] = FALSE;
                }
                $data['title'] = 'EDIT COURSE - ' . $Description;
                $data['category_data'] = $category['data'];
                $data['panel_sub_header'] = 'Edit Course - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'course');
                $this->session->set_userdata('current_parent', 'gen_sett');

                $course_data_raw = $this->MCourse->get_course_details($Course_Det_ID);
                //                dev_export($course_data_raw);die;
                if (is_array($course_data_raw) && isset($course_data_raw['data_status']) && !empty($course_data_raw['data_status']) && $course_data_raw['data_status'] == 1) {
                    $data['course_data'] = $course_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Course - ' . $data['course_data']['Description'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Course / No data associated with this course', 'data' => ''));
                    return;
                }
                if ($onload == 1) {

                    $view = $this->load->view('course/edit_course', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('Description', 'Course Name', 'trim|required|min_length[3]|max_length[30]');
                    $this->form_validation->set_rules('category_select', 'Category', 'trim|required');
                    $this->form_validation->set_rules('Duration', 'Duration', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['Course_Det_ID'] = filter_input(INPUT_POST, 'Course_Det_ID', FILTER_SANITIZE_STRING);
                        $data_prep['Description'] = strtoupper(filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING));
                        $data_prep['Course_Type_ID'] = filter_input(INPUT_POST, 'category_select', FILTER_SANITIZE_STRING);
                        $data_prep['Duration'] = filter_input(INPUT_POST, 'Duration', FILTER_SANITIZE_NUMBER_INT);
                        $status = $this->MCourse->edit_save_course($data_prep);
                        //                        dev_export($status);die;
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['Description'] . " Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => ''));
                            return;
                        } else {
                            $data['Description'] = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
                            $data['Course_Type_ID'] = filter_input(INPUT_POST, 'category_select', FILTER_SANITIZE_STRING);
                            $data['Duration'] = filter_input(INPUT_POST, 'Duration', FILTER_SANITIZE_NUMBER_INT);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('course/edit_course', $data, TRUE), 'message' => $status['message']));
                            return;
                        }
                    } else {
                        $data['Description'] = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
                        $data['Course_Type_ID'] = filter_input(INPUT_POST, 'category_select', FILTER_SANITIZE_STRING);
                        $data['Duration'] = filter_input(INPUT_POST, 'Duration', FILTER_SANITIZE_NUMBER_INT);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('course/edit_course', $data, TRUE)));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Course ID is provided / Invalid Course', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $Course_Det_ID = filter_input(INPUT_POST, 'Course_Det_ID', FILTER_SANITIZE_NUMBER_INT);
            if (isset($Course_Det_ID) && !empty($Course_Det_ID)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['Course_Det_ID'] = filter_input(INPUT_POST, 'Course_Det_ID', FILTER_SANITIZE_STRING);
                $status = $this->MCourse->edit_status_course($data_prep);
                if (is_array($status) && $status['status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    echo json_encode(array('status' => 0, 'message' => $status['message'], 'data' => ''));
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

    public function batch_allocate()
    {

        $data['sub_title'] = 'BATCH ALLOCATION - GROUP';
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
        $data['user_name'] = $this->session->userdata('user_name');
        $class_data = $this->MCourse->get_all_class_list();

        if ($class_data['error_status'] == 0 && $class_data['data_status'] == 1) {
            $data['class_data'] = $class_data['data'];
            $data['message'] = "";
        } else {
            $data['class_data'] = FALSE;
            $data['message'] = $class_data['message'];
        }
        $acd_year = $this->MCourse->get_all_acd_year();
        if ($acd_year['error_status'] == 0 && $acd_year['data_status'] == 1) {
            $data['acdyear_data'] = $acd_year['data'];
            $data['message'] = "";
        } else {
            $data['acdyear_data'] = FALSE;
            $data['message'] = $acd_year['message'];
        }
        $stream = $this->MCourse->get_all_streamdata();
        if ($stream['error_status'] == 0 && $stream['data_status'] == 1) {
            $data['stream_data'] = $stream['data'];
            $data['message'] = "";
        } else {
            $data['stream_data'] = FALSE;
            $data['message'] = $stream['message'];
        }

        $session = $this->MCourse->get_all_sessiondata();
        if ($session['error_status'] == 0 && $session['data_status'] == 1) {
            $data['session_data'] = $session['data'];
            $data['message'] = "";
        } else {
            $data['session_data'] = FALSE;
            $data['message'] = $session['message'];
        }


        $this->load->view('batch/show_allocate', $data);
    }

    public function batch_allocateselect($flag = 0, $params = NULL)
    {

        //        $data['template'] = 'student_profile/profile';
        $data['title'] = 'BATCH ALLOCATION - GROUP';
        $data['sub_title'] = 'BATCH ALLOCATION - GROUP';

        if ($flag == 0) {
            $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);
            $acd_year_id = filter_input(INPUT_POST, 'acdyear', FILTER_SANITIZE_NUMBER_INT);
            $streamid = filter_input(INPUT_POST, 'stream', FILTER_SANITIZE_NUMBER_INT);
            $sessionid = filter_input(INPUT_POST, 'session', FILTER_SANITIZE_NUMBER_INT);
        } else if ($flag == 1) {
            $courseid = $params['courseid'];
            $acd_year_id = $params['acdyear'];
            $streamid = $params['stream'];
            $sessionid = $params['session'];
        }

        $data['cur_course'] = $courseid;
        $data['cur_acd'] = $acd_year_id;
        $data['cur_stream'] = $streamid;
        $data['cur_session'] = $sessionid;


        $batchid = '-1'; // For student whose batch are not allotted            

        $details_data = $this->MCourse->get_all_studentdata($acd_year_id, $batchid, $courseid);
        //            dev_export($details_data);die;
        if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
            $data['details_data'] = $details_data['data'];
            $data['message'] = "";
        } else {
            $data['details_data'] = FALSE;
            $data['message'] = $details_data['message'];
        }
        $batch_data = $this->MCourse->get_all_batchdata($courseid, $sessionid, $streamid, $acd_year_id);
        //            dev_export($batch_data);die;
        if ($batch_data['error_status'] == 0 && $batch_data['data_status'] == 1) {
            $data['batch_data'] = $batch_data['data'];
            $data['message'] = "";
        } else {
            $data['batch_data'] = FALSE;
            $data['message'] = $batch_data['message'];
        }
        //            dev_export($details_data);die;

        $data['user_name'] = $this->session->userdata('user_name');

        if ($flag == 1) {
            //            dev_export($data);die;

            return $this->load->view('batch/show_allocateselect', $data, TRUE);
        } else {
            echo json_encode(array('status' => 1, 'view' => $this->load->view('batch/show_allocateselect', $data, TRUE)));
        }


        return TRUE;
    }

    public function save_batch_allocate()
    {
        $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
        $batch_data = filter_input(INPUT_POST, 'batch_data');


        $courseid = filter_input(INPUT_POST, 'cur_course', FILTER_SANITIZE_NUMBER_INT);
        $acd_year_id = filter_input(INPUT_POST, 'cur_acd', FILTER_SANITIZE_NUMBER_INT);
        $streamid = filter_input(INPUT_POST, 'cur_stream', FILTER_SANITIZE_NUMBER_INT);
        $sessionid = filter_input(INPUT_POST, 'cur_session', FILTER_SANITIZE_NUMBER_INT);
        $data['title'] = 'BATCH ALLOCATION - GROUP';
        $data['sub_title'] = 'BATCH ALLOCATION - GROUP';

        $batch_data = $this->MCourse->save_batch_allocate($batchid, $batch_data);
        if ($batch_data['error_status'] == 0 && $batch_data['data_status'] == 1) {
            //            echo'hoi';die;
            $params = array(
                'courseid' => $courseid,
                'acdyear' => $acd_year_id,
                'stream' => $streamid,
                'session' => $sessionid
            );
            $loader_view_html = Modules::run('course_settings/Course_controller/batch_allocateselect', 1, $params);
            echo json_encode(array('status' => 1, 'data' => $batch_data, 'view' => $loader_view_html));
            return TRUE;
        } else {
            $params = array(
                'courseid' => $courseid,
                'acdyear' => $acd_year_id,
                'stream' => $streamid,
                'session' => $sessionid
            );
            $loader_view_html = Modules::run('course_settings/Course_controller/batch_allocateselect', 1, $params);
            echo json_encode(array('status' => 0, 'data' => $batch_data['message'],'view' => $loader_view_html));
        }
    }

    Public function get_class_priority(){
        $courseid = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
        $course_data_raw = $this->MCourse->get_course($courseid);
        if (is_array($course_data_raw) && isset($course_data_raw['data_status']) && !empty($course_data_raw['data_status']) && $course_data_raw['data_status'] == 1) {
            echo json_encode(array('status' => 1,'priority'=> $course_data_raw['data'][0]['Priority'] ));
        } else {
            echo json_encode(array('status' => 0, 'message' => 'Invalid Course / No data associated with this course', 'data' => ''));
            return;
        }
    }
}
