<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student_Management_controller
 *
 * @author docme
 */
class Student_Management_controller extends MX_Controller
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
        $this->load->model('Student_Model', 'MStudent');
    }

    public function save_promotion()
    {
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT);
        $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
        $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
        $acd_year = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
        $promotion_data = filter_input(INPUT_POST, 'promotion_data');
        $cur_class = filter_input(INPUT_POST, 'cur_class', FILTER_SANITIZE_NUMBER_INT);
        $cur_batch = filter_input(INPUT_POST, 'cur_batch', FILTER_SANITIZE_NUMBER_INT);
        $cur_acdyear = filter_input(INPUT_POST, 'cur_acdyear', FILTER_SANITIZE_NUMBER_INT);
        $cur_batchname = filter_input(INPUT_POST, 'cur_batchname', FILTER_SANITIZE_STRING);
        $promotion = $this->MStudent->save_promotion($promotion_data, $batchid, $class_id, $acd_year, $type, $cur_class);
        if (isset($promotion['error_status']) && $promotion['error_status'] == 0) {
            if ($promotion['data_status'] == 1) {
                $params = array(
                    'batch_id' => $cur_batch,
                    'acd_id' => $cur_acdyear,
                    'class_id' => $cur_class,
                    'batchname' => $cur_batchname
                );
                //                dev_export($params);
                //                die;
                $loader_view_html = Modules::run('student_settings/Student_Management_controller/student_promotion', 1, $params);
                echo json_encode(array('status' => 1, 'data' => $promotion['data'], 'view' => $loader_view_html));
                //                echo json_encode(array('status' => 2));
                return TRUE;
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        } else {
            echo json_encode(array('status' => 0, 'message' => 'Student Updation Failed'));
            return TRUE;
        }
    }

    public function promoted_batch()
    {
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $courseid = filter_input(INPUT_POST, 'classid', FILTER_SANITIZE_NUMBER_INT);
        $acdyear_id = filter_input(INPUT_POST, 'acdid', FILTER_SANITIZE_NUMBER_INT);
        // GET PROMOTED YEAR/DETAINED YEAR
        $acd_year = $this->MStudent->get_promoted_year($acdyear_id);

        if ($acd_year['error_status'] == 0 && $acd_year['data_status'] == 1) {
            $data['acd_year'] = $acd_year['data'];
            $data['message'] = "";
        } else {
            $data['acd_year'] = FALSE;
            $data['message'] = $acd_year['message'];
        }
        //PROMOTED CLASS FOR CLASS COUNT = 1
        $p_year_id = $acd_year['data'][0]['Acd_ID'];
        $promoted_batch = $this->MStudent->get_promoted_batch_data($courseid, $p_year_id);
        if ($promoted_batch['error_status'] == 0 && $promoted_batch['data_status'] == 1) {
            $data['promoted_batch'] = $promoted_batch['data'];
            $data['message'] = "";
        } else {
            $data['promoted_batch'] = FALSE;
            $data['message'] = $promoted_batch['message'];
        }

        echo json_encode(array(
            'status' => 1,
            'batch_data' => $data['promoted_batch']
        ));
        return;
    }

    public function show_promotion()
    {
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);
        $acdyear_id = filter_input(INPUT_POST, 'acdyear_id', FILTER_SANITIZE_NUMBER_INT);

        //        dev_export($acdyear_id);
        //        dev_export($courseid);
        //        die;
        //        if (!(isset($acdyear_id) && !empty($acdyear_id) && $acdyear_id > 0)) {
        //            echo json_encode(array('status' => 0, 'data' => NULL));
        //            return TRUE;
        //        }
        //
        //        if (!(isset($courseid) && !empty($courseid) && $courseid > 0)) {
        //            echo json_encode(array('status' => 0, 'data' => NULL));
        //            return TRUE;
        //        }

        $data['template'] = 'registration/promotion_list';
        $data['title'] = 'PROMOTION/DETAINING';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Promotion Management',
                'link' => base_url('school/home')
            ),
            '2' => array(
                'title' => 'Promotion/Detaining'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
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

        if ($onload == 2) {
            //BATCH DATA ON CHANGE
            $batch_data = $this->MStudent->get_all_batchdata($courseid, $acdyear_id);
            if (isset($batch_data['error_status']) && $batch_data['error_status'] == 0) {
                if ($batch_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'batch_data' => $batch_data['data']));
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

        if ($onload == 2) {
            echo json_encode(array(
                'status' => 1,
                'batch_data' => $batch_data
            ));
            return;
        } else {
            $this->load->view('template/home_template', $data);
        }

        //        $data['user_name'] = $this->session->userdata('user_name');
    }

    public function student_promotion($flag = 0, $params = NULL)
    {

        if ($flag == 0) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            $acd_id = filter_input(INPUT_POST, 'acdyear', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);
            $batchname = filter_input(INPUT_POST, 'batchname', FILTER_SANITIZE_STRING);
        } else if ($flag == 1) {
            $batchid = $params['batch_id'];
            $acd_id = $params['acd_id'];
            $class_id = $params['class_id'];
            //            dev_export($params);die;
            $batchname = $params['batchname'];
        }
        //        dev_export($batchname);die;
        $data['cur_batch'] = $batchid;
        $data['cur_acd_id'] = $acd_id;
        $data['cur_class'] = $class_id;
        $data['cur_batchname'] = $batchname;



        //STUDENT DATA
        $stud_details = $this->MStudent->get_promotion_stud($batchid);
        //        dev_export($stud_details);die;
        if ($stud_details['error_status'] == 0 && $stud_details['data_status'] == 1) {
            $data['details_data'] = $stud_details['data'];
            $data['message'] = "";
        } else {
            $data['details_data'] = FALSE;
            $data['message'] = $stud_details['message'];
        }

        // GET PROMOTED YEAR/DETAINED YEAR
        $acd_year = $this->MStudent->get_promoted_year($acd_id);

        //        dev_export($acd_year['data'][0]['Acd_ID']);die;
        if ($acd_year['error_status'] == 0 && $acd_year['data_status'] == 1) {
            $data['acd_year'] = $acd_year['data'];
            $data['message'] = "";
        } else {
            $data['acd_year'] = FALSE;
            $data['message'] = $acd_year['message'];
        }

        //------------------------PROMOTION----------------------

        $promoted_class = $this->MStudent->get_promoted_class($class_id);
        //        dev_export($promoted_class);die;
        if ($promoted_class['error_status'] == 0 && $promoted_class['data_status'] == 1) {
            $data['promoted_class'] = $promoted_class['data'];
            $data['class_count'] = $promoted_class['class_count'];
            $data['is_course_complete'] = $promoted_class['is_course_complete'];
            $data['message'] = "";
        } else {
            $data['promoted_class'] = FALSE;
            $data['class_count'] = 0;
            $data['is_course_complete'] = 0;
            $data['message'] = $promoted_class['message'];
        }
        //PROMOTED CLASS FOR CLASS COUNT = 1
        $p_year_id = $acd_year['data'][0]['Acd_ID'];
        $p_class_id = $promoted_class['data'][0]['Course_Det_ID'];
        //        dev_export($p_year_id);        dev_export($p_class_id);die;
        $promoted_batch = $this->MStudent->get_promoted_batch_data($p_class_id, $p_year_id);
        if ($promoted_batch['error_status'] == 0 && $promoted_batch['data_status'] == 1) {
            $data['promoted_batch'] = $promoted_batch['data'];
            $data['message'] = "";
        } else {
            $data['promoted_batch'] = FALSE;
            $data['message'] = $promoted_batch['message'];
        }

        //-------------------PROMOTION------------------------ //
        //-----------------DETAINED-----------------------------//
        //CLASS DATA
        $class_data = $this->MStudent->get_all_class_list();
        $data['detained_class'] = $class_id;
        if ($class_data['error_status'] == 0 && $class_data['data_status'] == 1) {
            $data['class_data'] = $class_data['data'];
            $data['message'] = "";
        } else {
            $data['class_data'] = FALSE;
            $data['message'] = $class_data['message'];
        }
        //BATCH DATA
        $batch = $this->MStudent->get_all_batchdata($class_id, $p_year_id);
        //        dev_export($batch);die;
        if ($batch['error_status'] == 0 && $batch['data_status'] == 1) {
            $data['batch_data'] = $batch['data'];
            $data['message'] = "";
        } else {
            $data['batch_data'] = FALSE;
            $data['message'] = $batch['message'];
        }

        //-----------------DETAINED------------------//

        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Student Management',
                'link' => base_url('school/home')
            ),
            '2' => array(
                'title' => 'Promotion-Detaining',
                'link' => base_url('registration/show-promotion')
            ),
            '3' => array(
                'title' => 'Promotion-Detaining - Students',
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['title'] = 'PROMOTION';

        if ($flag == 0) {
            echo json_encode(array('status' => 1, 'view' => $this->load->view('registration/promotion_loader', $data, TRUE)));
            return true;
        } else if ($flag == 1) {
            return $this->load->view('registration/promotion_loader', $data, TRUE);
        }
    }

    public function search_parent()
    {

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Student Management', 'status' => 0, 'link' => base_url('registration/add-registration')),
                2 => array('message' => ' Search student', 'status' => 1)
            );


            $data['title'] = 'STUDENT SEARCH ';

            $data['panel_sub_header'] = 'Student Search';
            $data['breadcrumb'] = $breadcrumb;


            if ($onload == 1) {
                $this->load->view('registration/parent_search', $data);
            } else {

                $this->form_validation->set_rules('phn', 'Mobile No', 'trim');
                $this->form_validation->set_rules('email', 'E-mail ', 'trim');
                $this->form_validation->set_rules('first_name', 'Student Name', 'trim');
                $this->form_validation->set_rules('admn_no_for_parent_search', 'Admission Number', 'trim');
                $this->form_validation->set_rules('pname', 'Parent Name', 'trim');
                $this->form_validation->set_rules('flag', 'Match', 'trim|required');


                if ($this->form_validation->run() == TRUE) {
                    $data_prep['phn'] = strtoupper(filter_input(INPUT_POST, 'phn', FILTER_SANITIZE_STRING));
                    $data_prep['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                    $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
                    $data_prep['admn_no_for_parent_search'] = strtoupper(filter_input(INPUT_POST, 'admn_no_for_parent_search', FILTER_SANITIZE_STRING));
                    $data_prep['pname'] = strtoupper(filter_input(INPUT_POST, 'pname', FILTER_SANITIZE_STRING));
                    $data_prep['flag'] = strtoupper(filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_STRING));
                    //                     dev_export($data_prep);die;                  
                    $search_status = $this->MStudent->parent_search_new($data_prep);
                    // dev_export($search_status);die; 
                    if ($search_status['error_status'] == 0 && $search_status['data_status'] == 1) {
                        $data['search_status'] = $search_status['data'];
                        $data['message'] = "";
                    } else {
                        $data['search_status'] = NULL;
                        $data['message'] = $search_status['message'];
                    }

                    $data['phn'] = $data_prep['phn'];
                    $data['email'] = $data_prep['email'];
                    $data['first_name'] = $data_prep['first_name'];
                    $data['admn_no_for_parent_search'] = $data_prep['admn_no_for_parent_search'];
                    $data['pname'] = $data_prep['pname'];
                    $data['flag'] = $data_prep['flag'];
                    $this->load->view('registration/parent_search', $data);
                } else {
                    $data['phn'] = strtoupper(filter_input(INPUT_POST, 'phn', FILTER_SANITIZE_STRING));
                    $data['email'] = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
                    $data['first_name'] = strtoupper(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
                    $data['pname'] = strtoupper(filter_input(INPUT_POST, 'pname', FILTER_SANITIZE_STRING));
                    $data['flag'] = strtoupper(filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_STRING));
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('registration/parent_search', $data, TRUE)));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function advancesearch_byname()
    {                                               //display students list on search
        $data['title'] = 'STUDENTS LIST';
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['batch_id'] = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['stream_id'] = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['class_id'] = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['curent_acdyr'] = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);

            $data_prep['searchname'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            if ($data_prep['stream_id'] == -1) {
                $data_prep['stream_id'] = '';
            }
            if ($data_prep['curent_acdyr'] == -1) {
                $data_prep['curent_acdyr'] = '';
            }
            if ($data_prep['class_id'] == -1) {
                $data_prep['class_id'] = '';
            }

            $details_data = $this->MStudent->studentadvance_search($data_prep);
            //            dev_export($details_data);
            //            die;
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function advancesearch_byadmn_no()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'admission_no', FILTER_SANITIZE_STRING));
            $details_data = $this->MStudent->student_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            //            dev_export($details_data);die;
            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/profile_search_result_admn_search', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function create_image_files()
    {
        $details_data = $this->MStudent->student_images();
        dev_export($details_data);
        die;
        $i = 1;
        foreach ($details_data as $data) {
            save_student_image('data:image/jpeg;base64,' . $data['image_data'], $data['student_id'], $data['inst_ID'], 1);
            echo $i . '---' . $data['student_id'] . '<br/>';
        }
    }
}
