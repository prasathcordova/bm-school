<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of city_model
 *
 * @author chandrajith.edsys
 */
class Registration_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_sponsers()
    {
        $apikey = $this->session->userdata('API-Key');
        $currency_data = transport_data_with_param_with_urlencode(array('action' => 'get_sponsers'), $apikey);
        //        dev_export($currency_data);die;
        if (is_array($currency_data)) {
            return $currency_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $currency_data,
                'data' => FALSE
            );
        }
    }

    public function edit_save_sponser($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_sponser';
        $sponser_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($currency_status);die;
        if (is_array($sponser_status) && $sponser_status['status'] == 1) {
            if (is_array($sponser_status['data']) && $sponser_status['data']['error_status'] == 0) {
                if ($sponser_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $sponser_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => $sponser_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function get_sponsers_details($sponser_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $sponser_data = transport_data_with_param_with_urlencode(array('action' => 'get_one_sponsers', 'sponser_id' => $sponser_id, 'mode' => 'strict'), $apikey);
        //        dev_export($sponser_data);die;
        if (is_array($sponser_data)) {
            return $sponser_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $sponser_data,
                'data' => FALSE
            );
        }
    }

    //create function by vinoth for save sponser @ 30-06-2019
    public function save_sponser($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_sponser';
        $sponser_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($sponser_status);die;
        if (is_array($sponser_status) && $sponser_status['status'] == 1) {
            if (is_array($sponser_status['data']) && $sponser_status['data']['error_status'] == 0) {
                if ($sponser_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $sponser_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $sponser_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }


    public function get_email_validate($email, $sibling_id, $relation, $student_id)
    {

        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data_prep = array('action' => 'email_validation', 'email' => $email, 'sibling_id' => $sibling_id, 'relation' => $relation, 'inst_id' => $inst_id, 'student_id' => $student_id);
        //        dev_export($data_prep);die;
        $email = transport_data_with_param_with_urlencode($data_prep, $apikey);
        //        dev_export($mobile_nm);die;
        if (is_array($email)) {
            return $email['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $email,
                'data' => FALSE
            );
        }
    }

    public function get_registration_details($studentid)
    {
        $apikey = $this->session->userdata('API-Key');
        $profile_details = transport_data_with_param_with_urlencode(array('action' => 'stud_profile_edit', 'student_id' => $studentid), $apikey);
        if (is_array($profile_details)) {
            return $profile_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $profile_details,
                'data' => FALSE
            );
        }
    }

    public function get_unique_identity($unique_identity, $studentid, $flag)
    {
        $apikey = $this->session->userdata('API-Key');
        $unique_id = transport_data_with_param_with_urlencode(array('action' => 'adhar_validation', 'Adhar_No' => $unique_identity, 'student_id' => $studentid, 'flag' => $flag), $apikey);
        if (is_array($unique_id)) {
            return $unique_id['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $unique_id,
                'data' => FALSE
            );
        }
    }

    public function get_mob_validate($mobile, $sibling_id, $relation, $student_id)
    {
        //        dev_export($sibling_id);die;
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        //        dev_export($sibling_id);die;
        $data_prep = array('action' => 'mobile_validation', 'Phone3' => $mobile, 'sibling_id' => $sibling_id, 'relation' => $relation, 'inst_id' => $inst_id, 'student_id' => $student_id);
        $mobile_nm = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($mobile_nm)) {
            return $mobile_nm['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $mobile_nm,
                'data' => FALSE
            );
        }
    }

    public function get_all_studentdata($acd_year_id, $batchid, $status_f = NULL, $courseid = 0)
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array('action' => 'getdetails_student', 'acd_year' => $acd_year_id, 'batchid' => $batchid, 'status_flag' => $status_f, 'courseid' => $courseid), $apikey);
        if (is_array($student_data)) {
            return $student_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $student_data,
                'data' => FALSE
            );
        }
    }
    public function get_academic_history($data_ah)
    {
        $apikey = $this->session->userdata('API-Key');
        $academic_history = transport_data_with_param_with_urlencode($data_ah, $apikey);
        if (is_array($academic_history)) {
            return $academic_history['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $academic_history,
                'data' => FALSE
            );
        }
    }

    public function get_all_acadyr()
    {
        $apikey = $this->session->userdata('API-Key');
        $acd_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_acdyear',
            'status' => 1,
            'mode' => 'strict',
        ), $apikey);
        if (is_array($acd_data)) {
            return $acd_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acd_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_batch($acd_year)
    {
        $apikey = $this->session->userdata('API-Key');
        $batch = transport_data_with_param_with_urlencode(array('action' => 'get_batch', 'status' => 1, 'Acd_Year' => $acd_year), $apikey);
        if (is_array($batch)) {
            return $batch['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch,
                'data' => FALSE
            );
        }
    }

    public function get_batch_details_for_batch_allotment_from_student_id($studentid)
    {
        $apikey = $this->session->userdata('API-Key');
        $acd_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_batch_with_student_id',
            'studentid' => $studentid,
        ), $apikey);
        if (is_array($acd_data)) {
            return $acd_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acd_data,
                'data' => FALSE
            );
        }
    }

    public function save_batch_allocation_for_student($studentid, $batchid, $acdyr)
    {
        $apikey = $this->session->userdata('API-Key');
        //        dev_export($studentid);
        //        
        //        die;    
        $data = array(
            'action' => 'std_batch_change',
            'student_id' => $studentid,
            'batch_Id' => $batchid,
            'acd_Year' => $acdyr
        );
        //        dev_export($data);

        $acd_data = transport_data_with_param_with_formdata($data, $apikey);
        //        dev_export($acd_data);die;
        if (is_array($acd_data)) {
            return $acd_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acd_data,
                'data' => FALSE
            );
        }
    }

    //create edit_admission_no function by vinoth @ 24-05-2019 14:44
    public function edit_admission_no($studentid, $Admn_No, $acdyr)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = array(
            'action' => 'std_admn_no_change',
            'student_id' => $studentid,
            'admn_no' => $Admn_No,
            'acd_Year' => $acdyr
        );

        $acd_data = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($acd_data);die;
        if (is_array($acd_data)) {
            return $acd_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acd_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_stream()
    {
        $apikey = $this->session->userdata('API-Key');
        $stream_data = transport_data_with_param_with_urlencode(array('action' => 'get_stream', 'status' => 1), $apikey);
        if (is_array($stream_data)) {
            return $stream_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $stream_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_class()
    {
        $apikey = $this->session->userdata('API-Key');
        $class_data = transport_data_with_param_with_urlencode(array('action' => 'get_class', 'status' => 1), $apikey);
        if (is_array($class_data)) {
            return $class_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $class_data,
                'data' => FALSE
            );
        }
    }

    public function get_longabsentlist()
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array('action' => 'get_longabsentdetails_student'), $apikey);
        if (is_array($student_data)) {
            return $student_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $student_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_city_list()
    {
        $apikey = $this->session->userdata('API-Key');
        $city_data = transport_data_with_param_with_urlencode(array('action' => 'get_city'), $apikey);
        if (is_array($city_data)) {
            return $city_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $city_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_relegion()
    {
        $apikey = $this->session->userdata('API-Key');
        $religion = transport_data_with_param_with_urlencode(array('action' => 'get_religion', 'status' => 1), $apikey);
        if (is_array($religion)) {
            return $religion['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $religion,
                'data' => FALSE
            );
        }
    }

    public function get_all_community()
    {
        $apikey = $this->session->userdata('API-Key');
        $community = transport_data_with_param_with_urlencode(array('action' => 'get_community', 'status' => 1), $apikey);
        if (is_array($community)) {
            return $community['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $community,
                'data' => FALSE
            );
        }
    }

    public function get_all_caste_list()
    {
        $apikey = $this->session->userdata('API-Key');
        $caste_data = transport_data_with_param_with_urlencode(array('action' => 'get_caste', 'status' => 1), $apikey);
        if (is_array($caste_data)) {
            return $caste_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $caste_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_language_list()
    {
        $apikey = $this->session->userdata('API-Key');
        $language_data = transport_data_with_param_with_urlencode(array('action' => 'get_languages', 'status' => 1), $apikey);
        //dev_export($language_data);die;
        if (is_array($language_data)) {
            return $language_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $language_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_profession_list()
    {
        $apikey = $this->session->userdata('API-Key');
        $profession_data = transport_data_with_param_with_urlencode(array('action' => 'get_profession', 'status' => 1), $apikey);
        //        dev_export($profession_data);die;
        if (is_array($profession_data)) {
            return $profession_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $profession_data,
                'data' => FALSE
            );
        }
    }

    //create function by vinoth @30-06-2019
    public function get_profiles_student($studentid)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'getstudent_profiledetails';
        $data['studentid'] = $studentid;
        $student_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($student_details)) {
            return $student_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $student_details,
                'data' => FALSE
            );
        }
    }

    public function get_passport_student($studentid)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'getstudent_passportdetails';
        $data['studentid'] = $studentid;
        $passport_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($passport_details)) {
            return $passport_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $passport_details,
                'data' => FALSE
            );
        }
    }

    public function get_sibilings_student($studentid)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'getstudent_sibilingsdetails';
        $data['studentid'] = $studentid;
        $sibilings_details = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($sibilings_details);die;
        if (is_array($sibilings_details)) {
            return $sibilings_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $sibilings_details,
                'data' => FALSE
            );
        }
    }
    //    This function written by Vinoth K @ 20-05-2019 6:00
    function get_sibilings_student_byadmno($admno, $searchby)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'getstudent_sibilingsdetails_byadmno';
        $data['admn_no'] = $admno;
        $data['searchby'] = $searchby;
        $sibilings_details = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($sibilings_details);die;
        if (is_array($sibilings_details)) {
            return $sibilings_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $sibilings_details,
                'data' => FALSE
            );
        }
    }

    public function get_student_parentaddress($studentid)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_studentparent_details';
        $data['studentid'] = $studentid;
        $studentparent_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($studentparent_details)) {
            return $studentparent_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $studentparent_details,
                'data' => FALSE
            );
        }
    }

    public function get_parentaddress_details($studentid)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_studentparent_details';
        $data['studentid'] = $studentid;
        $studentparent_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($studentparent_details)) {
            return $studentparent_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $studentparent_details,
                'data' => FALSE
            );
        }
    }

    public function save_city($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_city';
        $city_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($city_status) && $city_status['status'] == 1) {
            if (is_array($city_status['data']) && $city_status['data']['error_status'] == 0) {
                if ($city_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $city_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $city_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function get_city_details($city_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $city_data = transport_data_with_param_with_urlencode(array('action' => 'get_city', 'city_id' => $city_id, 'mode' => 'strict'), $apikey);
        if (is_array($city_data)) {
            return $city_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $city_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_temp_students()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $state_data = transport_data_with_param_with_urlencode(array('action' => 'get_all_temp_students', 'inst_id' => $inst_id), $apikey);
        if (is_array($state_data)) {
            return $state_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $state_data,
                'data' => FALSE
            );
        }
    }

    public function search_temp_reg_student($val, $flag)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $s_data = transport_data_with_param_with_urlencode(array('action' => 'search_temp_reg_student', 'searchdata' => $val, 'flag' => $flag, 'inst_id' => $inst_id), $apikey);
        if (is_array($s_data)) {
            return $s_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $s_data,
                'data' => FALSE
            );
        }
    }

    public function get_tempreg_student($studentid)
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array('action' => 'get_temp_reg_student', 'student_id' => $studentid), $apikey);
        if (is_array($student_data)) {
            return $student_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $student_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_country()
    {
        $apikey = $this->session->userdata('API-Key');
        $state_data = transport_data_with_param_with_urlencode(array('action' => 'get_countries', 'status' => 1), $apikey);
        if (is_array($state_data)) {
            return $state_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $state_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_state()
    {
        $apikey = $this->session->userdata('API-Key');
        $city_data = transport_data_with_param_with_urlencode(array('action' => 'get_state', 'status' => 1), $apikey);
        if (is_array($city_data)) {
            return $city_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $city_data,
                'data' => FALSE
            );
        }
    }

    public function edit_save_city($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_city';
        $city_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($city_status) && $city_status['status'] == 1) {
            if (is_array($city_status['data']) && $city_status['data']['error_status'] == 0) {
                if ($city_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $city_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $city_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function edit_status_city($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_city_status';
        $city_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($city_status) && $city_status['status'] == 1) {
            if (is_array($city_status['data']) && $city_status['data']['error_status'] == 0) {
                if ($city_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $city_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $city_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function get_all_supplier_list()
    {
        $apikey = $this->session->userdata('API-Key');
        $country_data = transport_data_with_param_with_urlencode(array('action' => 'get_countries'), $apikey);
        if (is_array($country_data)) {
            //            dev_export($country_data);die;
            return $country_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $country_data,
                'data' => FALSE
            );
        }
    }
    //This function written by Elavarasan S @ 21-05-2019 2:30
    public function save_temp_registration($student_data)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_student_temp_reg', 'student_data' => $student_data), $apikey);
        //        dev_export($status_data);die;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }

    public function edit_temp_registration($student_id, $student_data, $flag)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'update_student_temp_reg', 'student_data' => $student_data, 'student_id' => $student_id, 'flag' => $flag), $apikey);
        //        return $status_data;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }

    public function save_personal_profile($student_data, $student_image, $known_languages, $temp_student_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_personal_profile_reg', 'student_data' => $student_data, 'student_image' => $student_image, 'known_languages' => $known_languages, 'temp_sid' => $temp_student_id), $apikey);
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }

    public function edit_personal_profile($student_id, $student_data, $student_image, $known_languages)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'edit_personal_profile_reg', 'student_id' => $student_id, 'student_data' => $student_data, 'student_image' => $student_image, 'known_languages' => $known_languages), $apikey);
        //        dev_export($status_data);die;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }

    public function save_academic_profile($student_data, $student_id, $temp_student_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_academic_profile_reg', 'student_data' => $student_data, 'student_id' => $student_id, 'temp_sid' => $temp_student_id), $apikey);
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }

    public function edit_academic_profile($student_data, $student_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'edit_academic_profile_reg', 'student_data' => $student_data, 'student_id' => $student_id), $apikey);
        //        dev_export($student_data);
        //        dev_export($student_id);die;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }

    //author Rahul Country State City Caste Religion 4/05/2017 

    public function get_country_statedetails($country_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_country_states';
        $data['country_id'] = $country_id;
        $country_state_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($country_state_details)) {
            return $country_state_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $country_state_details,
                'data' => FALSE
            );
        }
    }
    //GET Institution List
    public function get_institution_list()
    {
        $data_action = array(
            'action' => 'get_institution_list'
        );
        $apikey = $this->session->userdata('API-Key');
        $institution_data = transport_data_with_param_with_urlencode($data_action, $apikey);
        if (isset($institution_data['status']) && !empty($institution_data['status']) && is_array($institution_data) && $institution_data['status'] == 1) {
            return $institution_data['data'];
        } else {
            if (isset($institution_data['message']) && !empty($institution_data['message']) && is_array($institution_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $institution_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $institution_data,
                    'data' => FALSE
                );
            }
        }
    }
    //GET Employees From WFM
    public function get_employee_list_from_wfm($inst_id, $gender)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_employee_list_from_wfm';
        $data['inst_id'] = $inst_id;
        $data['gender'] = $gender;
        //$data['fname'] = $fname;
        //$data['mname'] = $mname;
        $country_state_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($country_state_details)) {
            return $country_state_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $country_state_details,
                'data' => FALSE
            );
        }
    }

    public function get_employee_details_from_wfm($inst_id, $emp_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_employee_details_from_wfm';
        $data['inst_id'] = $inst_id;
        $data['emp_id'] = $emp_id;
        $emp_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($emp_details)) {
            return $emp_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $emp_details,
                'data' => FALSE
            );
        }
    }
    public function get_country_citydetails($state_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_state_city';
        $data['state_id'] = $state_id;
        $city_state_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($city_state_details)) {
            return $city_state_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $city_state_details,
                'data' => FALSE
            );
        }
    }

    public function get_religion_castedetails($religion_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_religion_caste';
        $data['religion_id'] = $religion_id;
        $caste_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($caste_details)) {
            return $caste_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $caste_details,
                'data' => FALSE
            );
        }
    }

    //END Country State City Caste Religion 4/05/2017 

    public function get_batch_details_for_filter($acd_year_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_batch_details_for_filter';
        $data['acd_year_id'] = $acd_year_id;
        $batch_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($batch_details)) {
            return $batch_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch_details,
                'data' => FALSE
            );
        }
    }

    public function no_batch_count($acd_year_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'no_batch_counts';
        $data['acd_year'] = $acd_year_id;
        $data['active_student'] = 1;
        $batch_details_count = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($batch_details_count)) {
            return $batch_details_count['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch_details_count,
                'data' => FALSE
            );
        }
    }

    public function save_other_details($student_data, $student_id, $flag1, $flag2)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_otherdetails_reg', 'student_data' => $student_data, 'studentid' => $student_id, 'flag1' => $flag1, 'flag2' => $flag2), $apikey);
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }

    // history status starts
    public function get_profiles_student_status($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'status_history';
        $student_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($student_details)) {
            return $student_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $student_details,
                'data' => FALSE
            );
        }
    }

    //Author: Rahul
    //Purpose : save_Parent_profile
    //Date : 06/oct/2017
    public function save_parent_profile($student_data, $student_id, $sibling_student_id, $emp_id, $emp_inst_id, $who_worked)
    {
        $apikey = $this->session->userdata('API-Key');
        //        return $student_data;
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_parent_profile_reg', 'student_data' => $student_data, 'student_id' => $student_id, 'sibling_student_id' => $sibling_student_id, 'emp_id' => $emp_id, 'emp_inst_id' => $emp_inst_id, 'who_worked' => $who_worked), $apikey);
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }

    public function edit_parent_profile($student_data_raw, $student_id, $sibling_student_id, $father_id, $mother_id, $guardian_id, $emp_id, $emp_inst_id, $who_worked)
    {

        $apikey = $this->session->userdata('API-Key');
        $data_to_post = array(
            'action' => 'edit_parent_profile_reg',
            'student_data' => $student_data_raw,
            'student_id' => $student_id,
            'sibling_student_id' => $sibling_student_id,
            'father_id' => $father_id,
            'mother_id' => $mother_id,
            'guardian_id' => $guardian_id,
            'emp_id' => $emp_id,
            'emp_inst_id' => $emp_inst_id,
            'who_worked' => $who_worked
        );
        //                dev_export($data_to_post);die;
        $status_data = transport_data_with_param_with_urlencode($data_to_post, $apikey);
        //        dev_export($student_id);die;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }

    //END EDIT AND SAVE PARENT PROFILE

    public function save_facilities_details($student_data)
    {

        $apikey = $this->session->userdata('API-Key');
        $data = array(
            'action' => 'save_facilitydetails_reg',
            'student_data' => $student_data
        );
        $status_data = transport_data_with_param_with_formdata($data, $apikey);

        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }

    public function get_emailID($student_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $email_data = transport_data_with_param_with_urlencode(array('action' => 'Email_priority', 'student_id' => $student_id), $apikey);
        //dev_export($language_data);die;
        if (is_array($email_data)) {
            return $email_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $email_data,
                'data' => FALSE
            );
        }
    }

    public function get_uuid_data($uuid)
    {
        $apikey = $this->session->userdata('API-Key');
        $email_data = transport_data_with_param_with_urlencode(array('action' => 'get_uuid_student_data', 'uuid' => $uuid), $apikey);
        //dev_export($language_data);die;
        if (is_array($email_data)) {
            return $email_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $email_data,
                'data' => FALSE
            );
        }
    }

    public function get_f_uuid_data($uuid)
    {
        $apikey = $this->session->userdata('API-Key');
        $email_data = transport_data_with_param_with_urlencode(array('action' => 'get_f_uuid_parent_data', 'uuid' => $uuid), $apikey);
        //dev_export($language_data);die;
        if (is_array($email_data)) {
            return $email_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $email_data,
                'data' => FALSE
            );
        }
    }
    public function get_m_uuid_data($uuid)
    {
        $apikey = $this->session->userdata('API-Key');
        $email_data = transport_data_with_param_with_urlencode(array('action' => 'get_m_uuid_parent_data', 'uuid' => $uuid), $apikey);
        //dev_export($language_data);die;
        if (is_array($email_data)) {
            return $email_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $email_data,
                'data' => FALSE
            );
        }
    }
    public function get_g_uuid_data($uuid)
    {
        $apikey = $this->session->userdata('API-Key');
        $email_data = transport_data_with_param_with_urlencode(array('action' => 'get_g_uuid_parent_data', 'uuid' => $uuid), $apikey);
        //        dev_export($email_data);die;
        if (is_array($email_data)) {
            return $email_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $email_data,
                'data' => FALSE
            );
        }
    }

    public function get_student_by_admission_no($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_student_search_list';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($search_status)) {
            return $search_status['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $search_status,
                'data' => FALSE
            );
        }
    }
    public function get_student_by_name_or_admission($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_student_by_name_or_admission';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($search_status)) {
            return $search_status['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $search_status,
                'data' => FALSE
            );
        }
    }

    public function get_class_details_with_age($age, $inst_id, $flag)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = array(
            'action' => 'get-class-details-with-age-restrict',
            'age' => $age,
            'inst_id' => $inst_id,
            'flag' => $flag
        );
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($search_status)) {
            return $search_status['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $search_status,
                'data' => FALSE
            );
        }
    }

    public function get_staff_sibling_list($aadharno, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = array(
            'action' => 'get_staff_sibling_list',
            'aadharno' => $aadharno,
            'inst_id' => $inst_id
        );
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($search_status)) {
            return $search_status['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $search_status,
                'data' => FALSE
            );
        }
    }
}
