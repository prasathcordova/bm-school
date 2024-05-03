<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student_model
 *
 * @author chandrajith.edsys
 */
class Student_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_studentdata($parent_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array(
            'action' => 'getdetails_student_for_online_pay',
            'parent_id' => $parent_id,
            'inst_id' => $inst_id
        ), $apikey);
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
    public function get_ind_student_details($student_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array(
            'action' => 'getdetails_student_by_id_for_online_pay',
            'student_id' => $student_id,
            'inst_id' => $this->session->userdata('inst_id'),
            'is_fees' => 0
        ), $apikey);

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
    public function get_ind_student_details_for_home($student_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array(
            'action' => 'getdetails_student_by_id_for_online_pay',
            'student_id' => $student_id,
            'inst_id' => $inst_id,
            'is_fees' => 1
        ), $apikey);
        //        dev_export($student_data);die;
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
    public function get_fee_information($student_id, $inst_id, $cur_acd_year_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_fee_details_for_student_online_pay_display',
            'student_id' => $student_id,
            'inst_id' => $inst_id,
            'acd_year_id' => $cur_acd_year_id,
            'is_fees' => 1
        ), $apikey);
        // return $student_data;
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

    public function save_payment_details($data, $atom_data)
    {
        // return $data;
        $data['action'] = 'save_atompay_details';
        $data['atom_pay_data'] = $atom_data;
        $apikey = $this->session->userdata('API-Key');
        $payment_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($payment_data) && !empty($payment_data) && is_array($payment_data) && $payment_data['status'] == 1) {
            return $payment_data['data'];
        } else if (isset($payment_data) && !empty($payment_data) && is_array($payment_data) && $payment_data['status'] != 1) {
            if (is_array($payment_data['data'])) {
                return $payment_data['data'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'General Error');
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Critical Error');
        }
    }
    public function deposit_wallet_amount($data, $atom_data)
    {
        // return $data;
        $data['action'] = 'deposit_wallet_atom';
        $data['atom_pay_data'] = $atom_data;
        $apikey = $this->session->userdata('API-Key');
        $payment_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($payment_data) && !empty($payment_data) && is_array($payment_data) && $payment_data['status'] == 1) {
            return $payment_data['data'];
        } else if (isset($payment_data) && !empty($payment_data) && is_array($payment_data) && $payment_data['status'] != 1) {
            if (is_array($payment_data['data'])) {
                return $payment_data['data'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'General Error');
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Critical Error');
        }
    }

    public function get_student_profile_by_admission_number($admission_number, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_student_profile_by_admission_number';
        $data['controller_function']   = 'Student_settings/Student_controller/get_student_profile_by_admission_number';
        $data['admission_number'] = $admission_number;
        $data['inst_id'] = $inst_id;
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
    public function get_wallet_data_by_student($student_id, $inst_id, $acd_year_id, $type = "")
    {
        $data_action = array(
            'action' => 'get_student_wallet_data_for_summary',
            'student_id' => $student_id,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'type' => $type
        );
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode($data_action, $apikey);
        if (isset($collection_data['status']) && !empty($collection_data['status']) && is_array($collection_data) && $collection_data['status'] == true) {
            return $collection_data['data'];
        } else {
            if (isset($collection_data['message']) && !empty($collection_data['message']) && is_array($collection_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data,
                    'data' => FALSE
                );
            }
        }
    }
}
