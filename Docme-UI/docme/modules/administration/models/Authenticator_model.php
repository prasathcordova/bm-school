<?php

/**
 * Description of Authenticator_model
 *
 * @author aju.docme
 */
class Authenticator_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function check_login($data)
    {
        $data['action'] = 'login_user';
        $login_status = transport_data_with_param_with_urlencode($data, LOGIN_API_KEY);
        if (is_array($login_status) && $login_status['status'] == TRUE) {
            return $login_status['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $login_status,
                'data' => FALSE
            );
        }
    }
    public function get_user_details($emailid)
    {
        $data['action'] = 'user_data';
        $data['emailid'] = $emailid;
        $apikey = $this->session->userdata('API-Key');
        $user_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($user_data) && $user_data['status'] == TRUE) {
            return $user_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $user_data,
                'data' => FALSE
            );
        }
    }
    public function get_user_inst_details()
    {
        $data['action'] = 'primary_application_data';
        $apikey = $this->session->userdata('API-Key');
        $general_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($general_details) && $general_details['status'] == TRUE) {
            return $general_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $general_details,
                'data' => FALSE
            );
        }
    }
    public function get_inst_currency_details($currencyid)
    {
        $data['action'] = 'currency_data';
        $data['currencyid'] = $currencyid;
        $apikey = $this->session->userdata('API-Key');
        $general_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($general_details) && $general_details['status'] == TRUE) {
            return $general_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $general_details,
                'data' => FALSE
            );
        }
    }

    public function get_role_access_info($apikey)
    {
        $data = array(
            'action' => 'get_role_permission_of_user'
        );
        $employee = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($employee) && !empty($employee) && is_array($employee) && isset($employee['status']) && $employee['status'] == 1) {
            return $employee['data'];
        } else if (isset($employee) && !empty($employee) && is_array($employee) && isset($employee['data_status']) && $employee['data_status'] != 1) {
            if (is_array($employee['data'])) {
                return $employee['data'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'General Error');
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Critical Error');
        }
    }
}
