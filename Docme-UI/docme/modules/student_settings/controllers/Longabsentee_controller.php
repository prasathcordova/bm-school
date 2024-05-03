<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Longabsentee_controller
 *
 * @author chandrajith.edsys
 */
class Longabsentee_controller extends MX_Controller
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
        $this->load->model('Longabsentee_model', 'MLongabsentee');
        $this->load->model('Student_Model', 'MStudent');
    }

    // Long Absentee Home Page
    public function show_class_categorylongabsent()
    {
        $data['template'] = 'longabsentee/student_filter_for_long_absentee';
        $data['title'] = 'LONG ABSENTEE';
        $data['sub_title'] = 'STUDENT PROFILE';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'TC Management',
                'link' => base_url('school/home')
            ),
            '2' => array(
                'title' => 'Long Absentee'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $batch_data = $this->MLongabsentee->get_batch_details_for_filter($this->session->userdata('acd_year'));
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);
        $acdyear_id = filter_input(INPUT_POST, 'acdyear_id', FILTER_SANITIZE_NUMBER_INT);

        //CLASS DATA
        $class_data = $this->MStudent->get_all_class_list();
        if ($class_data['error_status'] == 0 && $class_data['data_status'] == 1) {
            $data['class_data'] = $class_data['data'];
            $data['message'] = "";
        } else {
            $data['class_data'] = FALSE;
            $data['message'] = $class_data['message'];
        }
        //PRELOADED BATCH DATA WITH CURRENT ACD YEAR 
        $batch = $this->MStudent->get_preload_batch_data();
        if ($batch['error_status'] == 0 && $batch['data_status'] == 1) {
            $data['batch_data'] = $batch['data'];
            $data['message'] = "";
        } else {
            $data['batch_data'] = FALSE;
            $data['message'] = $batch['message'];
        }
        //ACD YEAR DATA
        $acd_year = $this->MStudent->get_all_acd_year();
        if ($acd_year['error_status'] == 0 && $acd_year['data_status'] == 1) {
            $data['acdyear_data'] = $acd_year['data'];
            $data['message'] = "";
        } else {
            $data['acdyear_data'] = FALSE;
            $data['message'] = $acd_year['message'];
        }


        if ($onload == 1) {
            //BATCH DATA ON CHANGE
            $batch_data = $this->MStudent->get_all_batchdata($courseid, $acdyear_id);
            if (isset($batch_data['error_status']) && $batch_data['error_status'] == 0) {
                if ($batch_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $batch_data['data']));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }

        $this->load->view('template/home_template', $data);
    }
    //search by acdyear and batch
    public function show_student_longabsentlist()
    {
        if ($this->input->is_ajax_request() == 1) {
            //        $data['template'] = 'student_profile/profile';

            $data['title'] = 'LONG ABSENTEE';
            $data['sub_title'] = 'LONG ABSENTEE';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'title' => 'TC Management',
                    'link' => base_url('school/home')
                ),
                '2' => array(
                    'link' => base_url('longabsentee/show-class-for-students'),
                    'title' => 'Long Absentee'
                ),
                '3' => array(
                    'title' => 'Students'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);

            $details_data = $this->MLongabsentee->get_longabsentstudentdata($acd_year_id, $batchid, $courseid);

            //dev_export($details_data)  ;die; 
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['batchid'] = $batchid;
            $data['acd_yr'] = $acd_year_id;
            $data['courseid'] = $courseid;
            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('longabsentee/show_absentee', $data, TRUE)));
            return TRUE;
        }
    }

    //search by name or admission Number
    public function search_byname_for_profile()
    { //display students list on search
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['searchdata'] = trim(strtoupper(filter_input(INPUT_POST, 'searchdata', FILTER_SANITIZE_STRING)));
            $data_prep['flag'] = 6;
            $data_prep['inst_id'] = $this->session->userdata('inst_id');
            $details_data = $this->MLongabsentee->get_student_by_admission_no($data_prep);
            // dev_export($details_data);
            // die;
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            //$data['batchid'] = $batchid;
            $data['acdyr_id'] = $this->session->userdata('acd_year');

            if (isset($details_data['data']) && !empty($details_data['data'])) {

                $data['title'] = 'STUDENT PROFILE';
                $data['sub_title'] = 'STUDENT PROFILE';
                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'link' => base_url('school/home'),
                        'title' => 'TC Management',
                    ),
                    '2' => array(
                        'link' => base_url('longabsentee/show-class-for-students'),
                        'title' => 'Long Absent Management(Student Filter)',
                    ),
                    '3' => array(
                        'title' => 'Students'
                    )
                );
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);

                // longabsentee / show_absentee
                echo json_encode(array('status' => 1, 'view' => $this->load->view('longabsentee/show_absentee', $data, TRUE)));
                return TRUE;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data available'));
                return TRUE;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function show_absentee()
    {
        $data['template'] = 'longabsentee/show_absentee';
        $data['title'] = 'Long Absentee';
        $data['sub_title'] = 'Long Absentee';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'TC Management',
                'link' => base_url('school/home')
            ),
            '2' => array(
                'title' => 'Long Absentee'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $details_data = $this->MLongabsentee->get_longabsent_list();

        if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
            $data['details_data'] = $details_data['data'];
            $data['message'] = "";
        } else {
            $data['details_data'] = FALSE;
            $data['message'] = $details_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');


        $this->load->view('template/home_template', $data);
    }

    public function save_longabsentee()
    {
        if ($this->input->is_ajax_request() == 1) {


            $student_name = filter_input(INPUT_POST, 'studentname', FILTER_SANITIZE_STRING);
            //            dev_export($student_name);
            $student_data_raw = filter_input(INPUT_POST, 'studentdata');
            //            dev_export($student_data_raw);die;
            if ($student_data_raw) {

                //                dev_export($student_data_raw);die;
                $status = $this->MLongabsentee->save_stud_longabsent($student_data_raw);


                //                $student_details = json_decode($student_data_raw, TRUE);
                //                $prep_data = array($student_details['student_name']);
                //                $studentdata_name = $prep_data;

                if (is_array($status) && $status['data_status'] == 1) {

                    $this->session->set_flashdata('success_message', $student_name . " Status Changed as Long Absent Student");
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else if (isset($status['message']) && !empty($status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $status['message']));
                    return false;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }



    public function studentlongabsentrelease()
    {

        if ($this->input->is_ajax_request() == 1) {

            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
            $student_name = filter_input(INPUT_POST, 'studentname', FILTER_SANITIZE_STRING);
            $fee_enable_date = filter_input(INPUT_POST, 'fee_enable_date');
            if ($student_id) {
                $status = $this->MLongabsentee->save_longabsentrelease($student_id, $fee_enable_date);
                // dev_export($status);
                // die;
                if (is_array($status) && $status['data_status'] == 1) {

                    $this->session->set_flashdata('success_message', $student_name . " Released From Long Absent");
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;

                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $status['message']));
                        return false;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                        return false;
                    }
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }
}
