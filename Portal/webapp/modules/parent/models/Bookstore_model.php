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
class Bookstore_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //Bookstore

    public function studentpack_bill_select_oh($student_id, $pack_id = 0)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'studentpack_bill_select_oh';
        $data['controller_function']   = 'sub_store_settings/Billing_controller/studentpack_bill_select_oh';
        $data['studentid'] = $student_id;
        $data['pack_id'] = $pack_id;
        $stud_packdetails = transport_data_with_param_with_urlencode($data, $apikey);
        return $stud_packdetails;
        if (is_array($stud_packdetails)) {
            return $stud_packdetails['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $stud_packdetails,
                'data' => FALSE
            );
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

    public function get_bill_pack_details($pack_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_student_packdetailed';
        $data['pack_id'] = $pack_id;
        $packdetails = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($packdetails)) {
            return $packdetails['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $packdetails,
                'data' => FALSE
            );
        }
    }
    public function get_bookstore_online_order($pack_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_bookstore_online_order';
        $data['pack_id'] = $pack_id;
        $packdetails = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($packdetails)) {
            return $packdetails['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $packdetails,
                'data' => FALSE
            );
        }
    }
    public function save_bookstore_online_order_delivery_details($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_bookstore_online_order_delivery_details';
        $save_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($save_data)) {
            return $save_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $save_data,
                'data' => FALSE
            );
        }
    }


    public function save_storecashbill($studentid, $pack_id, $cashbill_data_raw, $item_data_raw)
    {
        $apikey = $this->session->userdata('API-Key');

        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_storecashbill', 'cashbill_data' => $cashbill_data_raw, 'student_id' => $studentid, 'packing_id' => $pack_id, 'item_data' => $item_data_raw), $apikey);

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

    public function get_bill_details_for_print($billcode)
    {
        $apikey = $this->session->userdata('API-Key');

        $user_data = transport_data_with_param_with_urlencode(array('action' => 'bill_print_data', 'bill_code' => $billcode), $apikey);
        //        dev_export($user_data);die;
        if (is_array($user_data) && isset($user_data['data']) && !empty($user_data['data'])) {
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
}
