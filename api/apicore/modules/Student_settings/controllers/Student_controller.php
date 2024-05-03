<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student_controller
 *
 * @author chandrajith.edsys
 */
class Student_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Student_model', 'MStudent');
    }

    public function save_sponser($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['sponser_name']) && !empty($params['sponser_name'])) {
            $dbparams[1] = $params['sponser_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Sponser Name is required', 'data' => FALSE);
        }
        if (isset($params['sponser_add']) && !empty($params['sponser_add'])) {
            $dbparams[2] = $params['sponser_add'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Sponser Address is required', 'data' => FALSE);
        }
        if (isset($params['sponser_email']) && !empty($params['sponser_email'])) {
            $dbparams[3] = $params['sponser_email'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Sponser Email is required', 'data' => FALSE);
        }
        if (isset($params['sponser_mobile']) && !empty($params['sponser_mobile'])) {
            $dbparams[4] = $params['sponser_mobile'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Sponser mobile number is required', 'data' => FALSE);
        }
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[5] = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student id is required', 'data' => FALSE);
        }
        $sponser_add_status = $this->MStudent->add_new_sponser($dbparams);
        if (!empty($sponser_add_status) && is_array($sponser_add_status) && $sponser_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $sponser_add_status['id']));
        } else {
            if (is_array($currency_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $currency_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function get_sponsers($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }
        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['currency_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_id LIKE '%" . $params['currency_id'] . "%' ";
                } else {
                    $query_string = "c.currency_id LIKE '%" . $params['currency_id'] . "%' ";
                }
            }
            if (isset($params['currency_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_name LIKE '%" . $params['currency_name'] . "%' ";
                } else {
                    $query_string = "c.currency_name LIKE '%" . $params['currency_name'] . "%' ";
                }
            }
            if (isset($params['currency_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_abbr LIKE '%" . $params['currency_abbr'] . "%' ";
                } else {
                    $query_string = "c.currency_abbr LIKE '%" . $params['currency_abbr'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['currency_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_id = '" . $params['currency_id'] . "' ";
                } else {
                    $query_string = "c.currency_id = '" . $params['currency_id'] . "' ";
                }
            }
            if (isset($params['currency_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_name = '" . $params['currency_name'] . "' ";
                } else {
                    $query_string = "c.currency_name = '" . $params['currency_name'] . "%' ";
                }
            }
            if (isset($params['currency_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_abbr = '" . $params['currency_abbr'] . "' ";
                } else {
                    $query_string = "c.currency_abbr = '" . $params['currency_abbr'] . "' ";
                }
            }
        }


        //        dev_export($query_string);die;
        $currency_list = $this->MStudent->get_sponsers_list($apikey, $query_string);
        //        return $currency_list;
        if (!empty($currency_list) && is_array($currency_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $currency_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_promotion($param)
    {
        $status_flag = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['promotion_data']) && !empty($param['promotion_data'])) {
            $promo_data_raw = $param['promotion_data'];
        } else {
            return array('status' => 0, 'message' => 'Promotion data  is requried.', 'data' => FALSE);
        }

        if (isset($param['batchid']) && !empty($param['batchid'])) {
            $batchid = $param['batchid'];
        } else {
            return array('status' => 0, 'message' => 'Batch is requried.', 'data' => FALSE);
        }
        if (isset($param['acd_year']) && !empty($param['acd_year'])) {
            $acd_year = $param['acd_year'];
        } else {
            return array('status' => 0, 'message' => 'Academic Year is requried.', 'data' => FALSE);
        }
        if (isset($param['classid']) && !empty($param['classid'])) {
            $classid = $param['classid'];
        } else {
            return array('status' => 0, 'message' => 'Class is requried.', 'data' => FALSE);
        }
        if (isset($param['type']) && !empty($param['type'])) {
            $type = $param['type'];
        } else {
            return array('status' => 0, 'message' => 'Type ID is requried.', 'data' => FALSE);
        }
        if (isset($param['cur_class']) && !empty($param['cur_class'])) {
            $cur_class = $param['cur_class'];
        } else {
            return array('status' => 0, 'message' => 'Curent class is requried.', 'data' => FALSE);
        }

        $formatted_array = array();
        $promotion_data_raw = json_decode($promo_data_raw, TRUE);

        foreach ($promotion_data_raw as $value) {
            $formatted_array[]['student_id'] = $value;
        }

        $xml_data = xml_generator($formatted_array);

        if (isset($type) && !empty($type) && $type == 1) {
            //promotion
            $status_flag = 'P';
            $status = $this->MStudent->save_promotion($xml_data, $classid, $batchid, $acd_year, $status_flag, $cur_class, $apikey);
        }
        if (isset($type) && !empty($type) && $type == 2) {
            //Detained
            $status_flag = 'D';
            $status = $this->MStudent->save_promotion($xml_data, $classid, $batchid, $acd_year, $status_flag, $cur_class, $apikey);
        }
        if (isset($type) && !empty($type) && $type == 3) {
            //Course_completed
            $status = $this->MStudent->save_course_completed($xml_data, $apikey);
        }
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data saved', 'data' => $status);
        } else {

            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed');
        }
    }

    public function get_promoted_class($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $class_count = NULL;
        if (isset($params['class']) && !empty($params['class'])) {
            $class = $params['class'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Current Class is required', 'data' => FALSE);
        }
        $promoted_class = $this->MStudent->get_promoted_class($apikey, $class);

        $class_count = $this->MStudent->get_promoted_class_count($apikey, $class);
        //        dev_export($class_count);die;
        if (!empty($promoted_class) && is_array($promoted_class)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $promoted_class, 'class_count' => $class_count['class_count'], 'is_course_complete' => $class_count['is_course_complete']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_promoted_year($params = NULL)
    {
        $apikey = $params['API_KEY'];

        if (isset($params['ACD_ID']) && !empty($params['ACD_ID'])) {
            $ACD_ID = $params['ACD_ID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ACADEMIC YEAR is required', 'data' => FALSE);
        }
        $acd_year = $this->MStudent->get_promoted_year($apikey, $ACD_ID);
        if (!empty($acd_year) && is_array($acd_year)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $acd_year);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_promotion_student($params = NULL)
    {
        $apikey = $params['API_KEY'];

        if (isset($params['BatchID']) && !empty($params['BatchID'])) {
            $BatchID = $params['BatchID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch ID  is required', 'data' => FALSE);
        }
        $student_details = $this->MStudent->get_promotion_student_list($apikey, $BatchID);
        if (!empty($student_details) && is_array($student_details)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_details);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_student_parentaddress($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'StudentID is required', 'data' => FALSE);
        }

        $parent_data_list = $this->MStudent->get_parentdata_list($dbparams);
        if (!empty($parent_data_list) && is_array($parent_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $parent_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_student_passportvisa($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'StudentID is required', 'data' => FALSE);
        }

        $passport_data_list = $this->MStudent->get_passportvisa_list($dbparams);
        if (!empty($passport_data_list) && is_array($passport_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $passport_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_student_sibilings($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'StudentID is required', 'data' => FALSE);
        }

        $sibilings_data_list = $this->MStudent->get_sibilings_list($dbparams);

        if (!empty($sibilings_data_list) && is_array($sibilings_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $sibilings_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    //thsi function written by Vinoth k @ 20-05-2019 6:15
    public function get_student_sibilings_byadmno($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $dbparams[1] = $params['admn_no'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Admission Number is required', 'data' => FALSE);
        }
        $searchby = $params['searchby'];
        if ($searchby == 'search_current_student') $sibilings_data_list = $this->MStudent->get_sibilings_list_byname($dbparams);
        else $sibilings_data_list = $this->MStudent->get_sibilings_list_byadmno($dbparams);

        if (!empty($sibilings_data_list) && is_array($sibilings_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $sibilings_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_student_details($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'StudentID is required', 'data' => FALSE);
        }

        $student_data_list = $this->MStudent->get_studentdata_list($dbparams);
        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_profile_student_details($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'StudentID is required', 'data' => FALSE);
        }

        $studentprofiledata = $this->MStudent->get_student_profile_data_list($dbparams);
        if (!empty($studentprofiledata) && is_array($studentprofiledata)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $studentprofiledata);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_details_student($params = NULL)
    {
        $apikey = $params['API_KEY'];

        if (isset($params['acd_year']) && !empty($params['acd_year'])) {
            $acd_year = $params['acd_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        }

        if (isset($params['batchid']) && !empty($params['batchid'])) {
            $batchid = $params['batchid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch data is required', 'data' => FALSE);
        }

        if (isset($params['courseid']) && !empty($params['courseid'])) {
            $courseid = $params['courseid'];
        } else {
            $courseid = 0;
        }


        if (isset($params['status_flag']) && !empty($params['status_flag'])) {
            $status_flag = 5;
        } else {
            $status_flag = 1;
        }

        $details_list = $this->MStudent->get_student_details($apikey, $acd_year, $batchid, $status_flag, $courseid);

        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_longabsentdetails_student($params = NULL)
    {
        $apikey = $params['API_KEY'];

        $details_list = $this->MStudent->get_longabsentstudent_details($apikey);
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_academic_history($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $inst_id = $params['inst_id'];

        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $student_id = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID required', 'data' => FALSE);
        }

        $academic_history = $this->MStudent->get_academic_history($apikey, $inst_id, $student_id);
        if (!empty($academic_history) && is_array($academic_history)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $academic_history);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_profile_all_student_details($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        $studentprofiledata = $this->MStudent->get_student_allprofile_data_list($dbparams);
        if (!empty($studentprofiledata) && is_array($studentprofiledata)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $studentprofiledata);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function getstudent_profiledetails($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $profiledetails = $this->MStudent->getprofiledetails($dbparams);
        if (!empty($profiledetails) && is_array($profiledetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $profiledetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_students_by_admn_nos($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['admission_number']) && !empty($params['admission_number'])) {
            $dbparams[1] = $params['admission_number'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $profiledetails = $this->MStudent->get_students_by_admn_nos($dbparams);
        if (!empty($profiledetails) && is_array($profiledetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $profiledetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_student_profile_by_admission_number($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['admission_number']) && !empty($params['admission_number'])) {
            $dbparams[1] = $params['admission_number'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $profiledetails = $this->MStudent->get_student_profile_by_admission_number($dbparams);
        if (!empty($profiledetails) && is_array($profiledetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $profiledetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //@author Docme
    //26-12-2017 Docme 
    public function getstudent_profiledetails_search($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['key']) && !empty($params['key'])) {
            $dbparams[1] = $params['key'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Search data is required', 'data' => FALSE);
        }
        if (isset($params['acdyr']) && !empty($params['acdyr'])) {
            $dbparams[2] = $params['acdyr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ACDYR data is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $profiledetails = $this->MStudent->getprofiledetails_search($dbparams);
        if (!empty($profiledetails) && is_array($profiledetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $profiledetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //@author Docme
    public function get_student_search_list($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['phn']) && !empty($params['phn'])) {
            $dbparams[1] = $params['phn'];
        } else {
            $dbparams[1] = NULL;
        }

        if (isset($params['email']) && !empty($params['email'])) {
            $dbparams[2] = $params['email'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['first_name']) && !empty($params['first_name'])) {
            $dbparams[3] = $params['first_name'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['pname']) && !empty($params['pname'])) {
            $dbparams[4] = $params['pname'];
        } else {
            $dbparams[4] = NULL;
        }
        if (isset($params['flag']) && !empty($params['flag'])) {
            $dbparams[5] = $params['flag'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Flag is required', 'data' => FALSE);
        }
        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $dbparams[6] = $params['admn_no'];
        } else {
            $dbparams[6] = NULL;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[7] = $params['class_id'];
        } else {
            $dbparams[7] = NULL;
        }
        if (isset($params['acy_yr']) && !empty($params['acy_yr'])) {
            $dbparams[8] = $params['acy_yr'];
        } else {
            $dbparams[8] = NULL;
        }
        if (isset($params['batch_id']) && !empty($params['batch_id'])) {
            $dbparams[9] = $params['batch_id'];
        } else {
            $dbparams[9] = NULL;
        }

        if (isset($params['batch_id']) && ($params['batch_id'] == 0 || empty($params['batch_id']))) {
            $apikey = $params['API_KEY'];
            $first_name = $params['first_name'];
            $acd_year = $params['acy_yr'];
            $student_data_list = $this->MStudent->get_nobatch_students($apikey, $first_name, $acd_year);
        } else {
            $student_data_list = $this->MStudent->get_studentsearch_list($dbparams);
        }

        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_student_by_name_or_admission($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            $dbparams[1] = NULL;
        }
        if (isset($params['searchdata']) && !empty($params['searchdata'])) {
            $dbparams[2] = $params['searchdata'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['acdyr_id']) && !empty($params['acdyr_id'])) {
            $dbparams[3] = $params['acdyr_id'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['batch_id']) && !empty($params['batch_id'])) {
            $dbparams[4] = $params['batch_id'];
        } else {
            $dbparams[4] = NULL;
        }

        $student_data_list = $this->MStudent->get_student_by_name_or_admission($dbparams);
        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function parent_search_for_registration($params)
    {
        $apikey = $params['API_KEY'];
        $final_add = '';
        if (isset($params['flag']) && !empty($params['flag'])) {
            $flag = $params['flag'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Flag is required', 'data' => FALSE);
        }

        $qry_data = array();

        if (isset($params['status_flag']) && !empty($params['status_flag'])) {
            $qry_data[] = "A.StatusFlag IN ('" . $params['status_flag'] . "') ";
        } else {
            $qry_data[] = "A.StatusFlag IN ('L','D','P','R','O','U') ";
        }





        if (isset($params['phn']) && !empty($params['phn'])) {
            $phone_no = $params['phn'];
            if ($flag == 1) {
                $qry_data[] = "B.Phone1 LIKE '" . $phone_no . "%'" . " OR B.Phone3 LIKE '" . $phone_no . "%'";
            } else if ($flag == 2) {
                $qry_data[] = "B.Phone1 LIKE '%" . $phone_no . "'" . " OR B.Phone3 LIKE '%" . $phone_no . "'";
            } else if ($flag == 3) {
                $qry_data[] = "B.Phone1 LIKE '%" . $phone_no . "%'" . " OR B.Phone3 LIKE '%" . $phone_no . "%'";
            } else if ($flag == 4) {
                $qry_data[] = "B.Phone1 = '" . $phone_no . "'" . " OR B.Phone3 = '" . $phone_no . "'";
            }
        }

        if (isset($params['email']) && !empty($params['email'])) {
            $email = $params['email'];
            if ($flag == 1) {
                $qry_data[] = "B.EMAIL LIKE '" . $email . "%'";
            } else if ($flag == 2) {
                $qry_data[] = "B.EMAIL LIKE '%" . $email . "'";
            } else if ($flag == 3) {
                $qry_data[] = "B.EMAIL LIKE '%" . $email . "%'";
            } else if ($flag == 4) {
                $qry_data[] = "B.EMAIL = '" . $email . "'";
            }
        }
        if (isset($params['first_name']) && !empty($params['first_name'])) {
            $student_name = $params['first_name'];
            if ($flag == 1) {
                $qry_data[] = "A.First_Name LIKE '" . $student_name . "%'";
            } else if ($flag == 2) {
                $qry_data[] = "A.First_Name LIKE '%" . $student_name . "'";
            } else if ($flag == 3) {
                $qry_data[] = "A.First_Name LIKE '%" . $student_name . "%'";
            } else if ($flag == 4) {
                $qry_data[] = "A.First_Name = '" . $student_name . "'";
            } else if ($flag == 5) {
                $final_add = "(A.First_Name LIKE '%" . $student_name . "%' OR A.middle_Name LIKE '%" . $student_name . "%' OR A.Last_Name LIKE '%" . $student_name . "%')";
            }
            //            if ($flag == 1) {
            //                $qry_data[] = "A.First_Name LIKE '" . $student_name . "%' OR A.middle_Name LIKE '" . $student_name . "%' OR A.Last_Name LIKE '" . $student_name . "%'";
            //            } else if ($flag == 2) {
            //                $qry_data[] = "A.First_Name LIKE '%" . $student_name . "' OR A.middle_Name LIKE '%" . $student_name . "' OR A.Last_Name LIKE '%" . $student_name . "'";
            //            } else if ($flag == 3) {
            //                $qry_data[] = "A.First_Name LIKE '%" . $student_name . "%' OR A.middle_Name LIKE '%" . $student_name . "%' OR A.Last_Name LIKE '%" . $student_name . "%'";
            //            } else if ($flag == 4) {
            //                $qry_data[] = "A.First_Name = '" . $student_name . "' OR A.middle_Name = '" . $student_name . "' OR A.Last_Name = '" . $student_name . "'";
            //            }
        }
        if (isset($params['pname']) && !empty($params['pname'])) {
            $parent_name = $params['pname'];
            if ($flag == 1) {
                $qry_data[] = "D.Parent_Name LIKE '" . $parent_name . "%'";
            } else if ($flag == 2) {
                $qry_data[] = "D.Parent_Name LIKE '%" . $parent_name . "'";
            } else if ($flag == 3) {
                $qry_data[] = "D.Parent_Name LIKE '%" . $parent_name . "%'";
            } else if ($flag == 4) {
                $qry_data[] = "D.Parent_Name = '" . $parent_name . "'";
            }
        }

        if (isset($params['admn_no_for_parent_search']) && !empty($params['admn_no_for_parent_search'])) {
            $admn_no = $params['admn_no_for_parent_search'];
            $parent_name = $params['pname'];
            if ($flag == 1) {
                $qry_data[] = "A.Admn_No LIKE '" . $admn_no . "%'";
            } else if ($flag == 2) {
                $qry_data[] = "A.Admn_No LIKE '%" . $admn_no . "'";
            } else if ($flag == 3) {
                $qry_data[] = "A.Admn_No LIKE '%" . $admn_no . "%'";
            } else if ($flag == 4) {
                $qry_data[] = "A.Admn_No = '" . $admn_no . "'";
            } else if ($flag == 5) {
                $final_add = $final_add . " OR A.Admn_No LIKE '%" . $admn_no . "%'";
            }
        }

        if (count($qry_data) > 0) {
            $final_query = implode(" AND ", $qry_data);
            //            echo dev_export($final_query);
            if ($flag == 5) {
                $final_query = $final_query . ' AND (' . $final_add . ')';
            }
            if ($flag == 6) {
                $final_query = "A.StatusFlag IN ('L')  AND
		   ((A.First_Name LIKE '%$admn_no%' OR A.middle_Name LIKE '%$admn_no%' OR A.Last_Name LIKE '%$admn_no%') OR A.Admn_No LIKE '%$admn_no%')";
            }
            //        return $final_query;
            $parent_data = $this->MStudent->get_student_data_for_parent_search($apikey, $final_query);


            if (!empty($parent_data) && is_array($parent_data)) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $parent_data);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
            }
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function student_search($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['phn']) && !empty($params['phn'])) {
            $dbparams[1] = $params['phn'];
        } else {
            $dbparams[1] = NULL;
        }
        if (isset($params['email']) && !empty($params['email'])) {
            $dbparams[2] = $params['email'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['first_name']) && !empty($params['first_name'])) {
            $dbparams[3] = $params['first_name'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['pname']) && !empty($params['pname'])) {
            $dbparams[4] = $params['pname'];
        } else {
            $dbparams[4] = NULL;
        }
        //        if (isset($params['flag']) && !empty($params['flag'])) {
        //            $dbparams[5] = $params['flag'];
        //        }
        //        else {
        //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Flag is required', 'data' => FALSE);
        //        }
        $dbparams[5] = 5;
        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $dbparams[6] = $params['admn_no'];
        } else {
            $dbparams[6] = NULL;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[7] = $params['class_id'];
        } else {
            $dbparams[7] = NULL;
        }
        if (isset($params['acy_yr']) && !empty($params['acy_yr'])) {
            $dbparams[8] = $params['acy_yr'];
        } else {
            $dbparams[8] = NULL;
        }
        if (isset($params['batch_id']) && !empty($params['batch_id'])) {
            $dbparams[9] = $params['batch_id'];
        } else {
            $dbparams[9] = NULL;
        }
        //        dev_export($dbparams);die;
        $student_data_list = $this->MStudent->get_studentsearch_list($dbparams);
        //        dev_export($student_data_list);die;
        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function search_student_details($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'StudentID is required', 'data' => FALSE);
        }

        $student_data_list = $this->MStudent->get_studentsearch_data($dbparams);
        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //end Docme 
    //Api for TC Application saving
    public function save_tc($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = $params['inst_id'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[2] = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student Id is required', 'data' => FALSE);
        }
        if (isset($params['student_name']) && !empty($params['student_name'])) {
            $dbparams[3] = $params['student_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student Name is required', 'data' => FALSE);
        }
        if (isset($params['admission_num']) && !empty($params['admission_num'])) {
            $dbparams[4] = $params['admission_num'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Admission Number is required', 'data' => FALSE);
        }
        if (isset($params['reason']) && !empty($params['reason'])) {
            $dbparams[5] = $params['reason'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Reason is required', 'data' => FALSE);
        }
        if (isset($params['leaving_date']) && !empty($params['leaving_date'])) {
            $dbparams[6] = $params['leaving_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Leaving Date is required', 'data' => FALSE);
        }
        $tcapp_add_status = $this->MStudent->add_new_tcapp($dbparams);
        if (!empty($tcapp_add_status) && is_array($tcapp_add_status) && $tcapp_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('Tc_app_id' => $tcapp_add_status['Tc_app_id']));
        } else {
            if (is_array($tcapp_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $tcapp_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function get_batch_for_filter($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['acd_year_id']) && !empty($params['acd_year_id'])) {
            $acd_year_id = $params['acd_year_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Acd year data is required', 'data' => FALSE);
        }
        $batch_details_raw = $this->MStudent->get_batch_details_for_filter($acd_year_id, $apikey);
        $formated_data = array();
        $class_det_id = array();
        foreach ($batch_details_raw as $batchdata) {
            if (in_array($batchdata['class_det_id'], $class_det_id)) {
                $counter = count($formated_data[$batchdata['class_det_id']]['batch_details']);
                $formated_data[$batchdata['class_det_id']]['batch_details'][$counter] = array(
                    'batchid' => $batchdata['BatchID'],
                    'batch_name' => $batchdata['Batch_Name'],
                    'division' => $batchdata['Division'],
                    'boys' => $batchdata['Boys'],
                    'girls' => $batchdata['Girls'],
                    'total_strength' => $batchdata['limit'],
                    'std_count' => $batchdata['student_count'],
                    'TC_COUNT' => $batchdata['TC_COUNT'],
                    'Long_ab_count' => $batchdata['Long_ab_count'],
                    'packing_std_count' => $batchdata['student_count_for_packing']
                );
            } else {
                $formated_data[$batchdata['class_det_id']]['class_details'] = array(
                    'class_id' => $batchdata['class_det_id'],
                    'class_code' => $batchdata['course_det_code'],
                    'description' => $batchdata['Description']
                );
                $formated_data[$batchdata['class_det_id']]['batch_details'][] = array(
                    'batchid' => $batchdata['BatchID'],
                    'batch_name' => $batchdata['Batch_Name'],
                    'division' => $batchdata['Division'],
                    'boys' => $batchdata['Boys'],
                    'girls' => $batchdata['Girls'],
                    'total_strength' => $batchdata['limit'],
                    'std_count' => $batchdata['student_count'],
                    'TC_COUNT' => $batchdata['TC_COUNT'],
                    'Long_ab_count' => $batchdata['Long_ab_count'],
                    'packing_std_count' => $batchdata['student_count_for_packing']
                );
                $class_det_id[] = $batchdata['class_det_id'];
            }
        }

        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data retrieved successfully', 'data' => $formated_data);
    }

    // author Docme // status history
    public function status_history($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[1] = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Admission No is required', 'data' => FALSE);
        }
        $student_data_list = $this->MStudent->status_history($dbparams);
        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    // end status history
    // 
    // 
    // batch change // Docme
    public function std_batch_change($params = NULL)
    {
        //    return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['batch_Id']) && !empty($params['batch_Id'])) {
            $dbparams[1] = $params['batch_Id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'batch data is required', 'data' => FALSE);
        }
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[2] = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'student id is required', 'data' => $params);
        }
        if (isset($params['acd_Year']) && !empty($params['acd_Year'])) {
            $dbparams[3] = $params['acd_Year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year is required', 'data' => FALSE);
        }
        $student_batch_data = $this->MStudent->std_change_batch($dbparams);
        if (!empty($student_batch_data) && is_array($student_batch_data) && $student_batch_data['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('batch_Id' => $params['batch_Id']));
        } else {
            if (is_array($student_batch_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $student_batch_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    //cretae function by vinoth @ 24-05-2019 14:50
    public function std_admn_no_change($params = NULL)
    {
        //    return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $dbparams[1] = $params['admn_no'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Admn_no is required', 'data' => FALSE);
        }
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[2] = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'student id is required', 'data' => $params);
        }
        if (isset($params['acd_Year']) && !empty($params['acd_Year'])) {
            $dbparams[3] = $params['acd_Year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year is required', 'data' => FALSE);
        }

        $student_batch_data = $this->MStudent->std_admn_no_change($dbparams);
        //        return $student_batch_data;
        if (!empty($student_batch_data) && is_array($student_batch_data) && $student_batch_data['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => $student_batch_data);
        } else {
            if (is_array($student_batch_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $student_batch_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    /*
     * Auth: Docme
     * Description : priotiry setting for selection of emailID
     */

    public function Email_priority($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[1] = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'student ID is required', 'data' => FALSE);
        }
        $student_data_list = $this->MStudent->email_priority($dbparams);
        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    /*
     * Auth: Docme
     * Description : count of students no batch allocated
     */

    public function no_batch_counts($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acd_year']) && !empty($params['acd_year'])) {
            $dbparams[1] = $params['acd_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Acdyr is required', 'data' => FALSE);
        }
        if (isset($params['active_student']) && !empty($params['active_student'])) {
            $dbparams[2] = 2;
        } else {
            $dbparams[2] = 1;
        }
        $student_data_list = $this->MStudent->no_batch_count($dbparams);
        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_billstudent_search($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];



        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $dbparams[1] = $params['admn_no'];
        } else {
            $dbparams[1] = NULL;
        }



        $student_data_list = $this->MStudent->get_billstudentsearch($dbparams);


        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_billadvancestudent_search($params = NULL)
    {
        //         dev_export($data);die;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['batch_id']) && !empty($params['batch_id'])) {
            $dbparams[1] = $params['batch_id'];
        } else {
            $dbparams[1] = NULL;
        }
        if (isset($params['stream_id']) && !empty($params['stream_id'])) {
            $dbparams[2] = $params['stream_id'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[3] = $params['class_id'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['curent_acdyr']) && !empty($params['curent_acdyr'])) {
            $dbparams[4] = $params['curent_acdyr'];
        } else {
            $dbparams[4] = NULL;
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[5] = $params['inst_id'];
        } else {
            $dbparams[5] = NULL;
        }
        if (isset($params['searchname']) && !empty($params['searchname'])) {
            $dbparams[6] = $params['searchname'];
        } else {
            $dbparams[6] = NULL;
        }
        //        dev_export($dbparams);die;
        $student_data_list = $this->MStudent->studentadvance_search($dbparams);


        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_advancestudent_search($params = NULL)
    {
        //         dev_export($data);die;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['batch_id']) && !empty($params['batch_id'])) {
            $dbparams[1] = $params['batch_id'];
        } else {
            $dbparams[1] = NULL;
        }
        if (isset($params['stream_id']) && !empty($params['stream_id'])) {
            $dbparams[2] = $params['stream_id'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[3] = $params['class_id'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['curent_acdyr']) && !empty($params['curent_acdyr'])) {
            $dbparams[4] = $params['curent_acdyr'];
        } else {
            $dbparams[4] = NULL;
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[5] = $params['inst_id'];
        } else {
            $dbparams[5] = NULL;
        }
        if (isset($params['searchname']) && !empty($params['searchname'])) {
            $dbparams[6] = $params['searchname'];
        } else {
            $dbparams[6] = NULL;
        }
        //        dev_export($dbparams);die;
        $student_data_list = $this->MStudent->studentadvance_search($dbparams);


        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_billbatch_search($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[1] = $params['class_id'];
        } else {
            $dbparams[1] = NULL;
        }

        $student_data_list = $this->MStudent->studentadvancebatch_search($dbparams);


        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function getstudent_profilebill_search($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $profiledetails = $this->MStudent->get_student_profile_bill_data($dbparams);
        if (!empty($profiledetails) && is_array($profiledetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $profiledetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function getdetails_student_for_online_pay($params)
    {

        $apikey = $params['API_KEY'];
        if (isset($params['parent_id']) && !empty($params['parent_id'])) {
            $parent_id = $params['parent_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Parent data is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $inst_id = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst ID is required', 'data' => FALSE);
        }

        $details_list = $this->MStudent->get_student_details_for_portal($apikey, $parent_id, $inst_id);
        //        dev_export($details_list);die;
        $formatted_fees = array();
        $formatted_payment_history = array();
        if (isset($details_list) && is_array($details_list) && !empty($details_list)) {
            foreach ($details_list as $students) {
                $admin_no = $students['Reg_No'];
                $inst_id = $inst_id;
                //                $fees_state = 'G';
                //                $student_fees = $this->MStudent->get_studentfees($inst_id, $admin_no, $fees_state);
                $formatted_fees[$students['student_id']] = NULL;
                //                $payment_history = $this->MStudent->get_payment_history($apikey, $students['student_id']);
                $formatted_payment_history[$students['student_id']] = NULL;
            }
        }
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list, 'data-fees' => $formatted_fees, 'data-payments' => $formatted_payment_history);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function getdetails_student_by_id_for_online_pay($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $student_id = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $inst_id = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst ID is required', 'data' => FALSE);
        }
        $details_list = $this->MStudent->get_student_details_by_id_for_portal($apikey, $student_id, $inst_id);
        //        dev_export($details_list);die;
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_student_images($params)
    {
        $inst_id = $params['inst_id'];

        $details_list = $this->MStudent->get_student_images($inst_id);
        return $details_list;
        //        dev_export($details_list);die;
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
