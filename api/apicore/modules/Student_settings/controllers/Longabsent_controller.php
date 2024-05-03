<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Longabsent_controller
 *
 * @author Rahul.edsys
 */
class Longabsent_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Longabsent_model', 'MLongab');
    }




    public function get_longabsent($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "cl.isactive = " . $params['status'];
        }

        $longab_list = $this->MLongab->get_longabsent_details($apikey, $query_string);

        if (!empty($longab_list) && is_array($longab_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $longab_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_la_student_by_admission_no($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $searchdata = $params['searchdata'];
        $paramdata[0] =  $apikey;
        $paramdata[1] =  $params['inst_id'];
        $paramdata[2] =  $searchdata;

        $longab_list = $this->MLongab->get_la_student_by_admission_no($paramdata);
        if (!empty($longab_list) && is_array($longab_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $longab_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_longabsentee($param)
    {
        $student_data_raw = NULL;
        $apikey = $param['API_KEY'];

        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }


        $student_details_pre = json_decode($student_data_raw, TRUE);

        $acd_year = $student_details_pre['acd_year'];
        $last_date_attendance = $student_details_pre['last_date_attendance'];
        $absented_course = $student_details_pre['absented_course'];
        $fee_disablefrm = $student_details_pre['fee_disablefrm'];
        $admno = $student_details_pre['admno'];
        $student_id = $student_details_pre['student_id'];
        $description = 'Long Absentee';
        $statusflag = 'L';
        //          dev_export($student_details_pre);
        //        die;

        $status = $this->MLongab->save_longabsentee($apikey, $acd_year, $last_date_attendance, $absented_course, $fee_disablefrm, $admno, $student_id, $statusflag, $description);

        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student Assigned as Long Absentee.', 'studentid' => $status['student_id']);
        } else {
            if (isset($status['ErrorMessage']) && !empty($status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['ErrorMessage'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student Assigned as Long Absentee failed', 'studentid' => 0);
            }
        }
    }

    public function show_longabsentee($params = NULL)
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

        $details_list = $this->MLongab->get_student_longdetails($apikey, $acd_year, $batchid, $courseid);

        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //    public function release_longabsentee($param) {
    //
    //        $student_data_raw = NULL;
    //        $apikey = $param['API_KEY'];
    //        if (isset($param['$student_id']) && !empty($param['$student_id'])) {
    //            $student_id = $param['$student_id'];
    ////            dev_export($student_data_raw);die;
    //        } else {
    //            return array('status' => 0, 'message' => 'Student id  is requried.', 'data' => FALSE);
    //        }
    ////        $student_details = json_decode($student_data_raw, TRUE);
    ////        dev_export($student_details);die;
    //        $tc_status = $this->MLongab->longabsente_release($student_id, $apikey);
    //       
    //         if (!empty($tc_status) && is_array($tc_status) && $tc_status['ErrorStatus'] == 0) {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Longabsentee Released successfully', 'data' => array('Tc_app_id' => $tc_status['Tc_app_id']));
    //        } else {
    //            if (is_array($tc_status)) {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => $tc_status['ErrorMessage'], 'data' => FALSE);
    //            } else {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Longabsentee Release failed to process', 'data' => FALSE);
    //            }
    //        }
    //    }
    public function release_longabsentee($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[1] = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student Id is required', 'data' => FALSE);
        }
        if (isset($params['fee_enable_date']) && !empty($params['fee_enable_date'])) {
            $dbparams[2] = $params['fee_enable_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee Enable Date required', 'data' => FALSE);
        }

        $longabsent_release_status = $this->MLongab->longabsente_release($dbparams);
        if (!empty($longabsent_release_status) && is_array($longabsent_release_status) && $longabsent_release_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Longabsentee Released successfully', 'data' => array('student_id' => $longabsent_release_status['student_id']));
        } else {
            if (is_array($longabsent_release_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $longabsent_release_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
}
