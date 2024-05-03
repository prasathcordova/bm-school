<?php

/**
 * Description of Online_registration_model
 *
 * @author FATHIMA SHAMNA
 */
class Online_registration_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
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
    public function get_all_acadyr()
    {
        $apikey = $this->session->userdata('API-Key');

        $acd_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_acdyear',
            'status' => 1,
            'mode' => 'temp_reg',
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

    public function get_all_prev_acadyr()
    {
        $apikey = $this->session->userdata('API-Key');

        $acd_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_acdyear',
            'status' => 1,
            'mode' => 'search',
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

    public function get_class_details_with_age($age, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = array(
            'action' => 'get-class-details-with-age-restrict',
            'age' => $age,
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

    public function get_temp_admn($admn)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_temp_reg_data';
        $data['admn'] = $admn;
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


    public function select_OTP($email, $OTP, $flag)
    { //$email  = $email or temp_regID
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_otp_data';
        $data['email'] = $email;
        $data['OTP'] = $OTP;
        $data['flag'] = $flag;
        $OTP_Details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($OTP_Details) && isset($OTP_Details['data'])) {
            return $OTP_Details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $OTP_Details,
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

    public function pickup_point($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'get_pickuppoint', 'inst_id' => $inst_id, 'status' => 1, 'mode' => 'strict'), $apikey);
        //        return $status_data;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in getting data',
                'data' => FALSE
            );
        }
    }

    public function select_reg_date_data($flag = 1)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'get_select_reg_date_data', 'inst_id' => $inst_id, 'flag' => $flag), $apikey);
        //        return $status_data;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in getting data',
                'data' => FALSE
            );
        }
    }

    public function get_all_api_keys($inst_id)
    {
        $apikey = LOGIN_API_KEY;
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'get_all_api_keys', 'inst_id' => $inst_id), $apikey);
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in getting data',
                'data' => FALSE
            );
        }
    }

    public function get_system_parameters()
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'primary_application_data'), $apikey);
        //        return $status_data;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in getting data',
                'data' => FALSE
            );
        }
    }

    public function get_entrance_date($class_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'get_entrance_date', 'class_id' => $class_id, 'inst_id' => $inst_id), $apikey);
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in getting data',
                'data' => FALSE
            );
        }
    }
    public function get_mandatory_subjects($class_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'get_mandatory_subjects', 'class_id' => $class_id, 'inst_id' => $inst_id), $apikey);
        // dev_export(json_decode($status_data['data']['0']['Mandatory_optional_subjects']));die;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data']['data'][0]['Mandatory_optional_subjects'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in getting data',
                'data' => FALSE
            );
        }
    }

    public function get_all_unsync_temp_admn()
    {
        $apikey = LOGIN_API_KEY;
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'get_all_unsync_temp_admn'), $apikey);
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in getting data',
                'data' => FALSE
            );
        }
    }
    public function save_rims_response_online_registration($save_data)
    {
        $apikey = LOGIN_API_KEY;
        $save_data['action'] = "save_rims_response_online_registration";
        $status_data = transport_data_with_param_with_urlencode($save_data, $apikey);
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in getting data',
                'data' => FALSE
            );
        }
    }
    public function get_parent_details($inst_id, $adtext, $flag, $addr_flag)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'get_parent_details_online_reg', 'inst_id' => $inst_id, 'adtext' => $adtext, 'flag' => $flag, 'addr_flag' => $addr_flag), $apikey);
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in getting data',
                'data' => FALSE
            );
        }
    }


    public function get_class_registration_fee()
    {
        $apikey = $this->session->userdata('API-Key');;
        $inst_id = $this->session->userdata('inst_id');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'get_class_registration_fee', 'inst_id' => $inst_id), $apikey);
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in getting data',
                'data' => FALSE
            );
        }
    }

    public function update_registration_fees($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data['action'] = 'update_registration_fees';
        $data['inst_id'] = $inst_id;
        $status_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in getting data',
                'data' => FALSE
            );
        }
    }
    public function get_all_temp_students_registration_fees($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data['action'] = 'get_all_temp_students_registration_fees';
        $data['inst_id'] = $inst_id;
        $state_data = transport_data_with_param_with_urlencode($data, $apikey);
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
    public function get_all_temp_students_registration_documents($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data['action'] = 'get_all_temp_students_registration_documents';
        $data['inst_id'] = $inst_id;
        $state_data = transport_data_with_param_with_urlencode($data, $apikey);
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
    public function update_payment_allocation($json_string, $flag = 1)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_registration_payment_allocation';
        $data['json_data'] = $json_string;
        $data['flag'] = $flag;
        $state_data = transport_data_with_param_with_urlencode($data, $apikey);
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

    public function save_registration_date($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_registration_date';
        $state_data = transport_data_with_param_with_urlencode($data, $apikey);
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
}
