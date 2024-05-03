<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of parentlogin_model
 *
 * @author chandrajith.edsys
 */
class Parentlogin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save_userregistration($data)
    {
        //        $apikey = $this->session->userdata('API-Key');
        $apikey = '525-777-777';
        $data['action'] = 'parent-user-registration';

        $parentreg_status = transport_data_with_param_with_urlencode($data, $apikey);

        if (is_array($parentreg_status) && $parentreg_status['status'] == 1) {
            if (is_array($parentreg_status['data']) && $parentreg_status['data']['error_status'] == 0) {
                if ($parentreg_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $parentreg_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $parentreg_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function check_parent_login($data)
    {
        $data['action'] = 'parent_login';
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

    public function get_parent_details($parent_id, $apikey)
    {
        $data = array(
            'action' => 'get_parent_details',
            'parent_id' => $parent_id,
            'mode' => 'strict'
        );
        $student = transport_data_with_param_with_urlencode($data, $apikey);

        if (isset($student) && !empty($student) && is_array($student) && $student['status'] == 1) {
            return $student['data'];
        } else if (isset($student) && !empty($student) && is_array($student) && $student['status'] != 1) {
            if (is_array($student['data'])) {
                return $student['data'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'General Error');
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Critical Error');
        }
    }

    public function check_parent_for_otp_request($data_prep)
    {
        $apikey = LOGIN_API_KEY;
        $student = transport_data_with_param_with_urlencode($data_prep, $apikey);
        // return $student;

        if (isset($student) && !empty($student) && is_array($student) && $student['status'] == 1) {
            return $student['data'];
        } else if (isset($student) && !empty($student) && is_array($student) && $student['status'] != 1) {
            if (is_array($student['data'])) {
                return $student['data'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'General Error');
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Critical Error');
        }
    }
    public function otp_verification_and_login($data_prep)
    {
        $apikey = LOGIN_API_KEY;
        //        dev_export($data_prep);die;
        $student = transport_data_with_param_with_urlencode($data_prep, $apikey);
        //        dev_export($student);die;
        if (isset($student) && !empty($student) && is_array($student) && $student['status'] == 1) {
            return $student['data'];
        } else if (isset($student) && !empty($student) && is_array($student) && $student['status'] != 1) {
            if (is_array($student['data'])) {
                return $student['data'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'General Error');
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Critical Error');
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
}
