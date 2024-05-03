<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bill_model
 *
 * @author chandrajith.edsys
 */
class Bill_model extends CI_model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save_cashbilldata($studentid, $pack_id, $cashbill_data_raw, $item_data_raw)
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

    public function save_chequebilldata($studentid, $pack_id, $cashbill_data_raw, $item_data_raw)
    {
        //        dev_export($cashbill_data_raw);die;
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_storecashbill', 'cashbill_data' => $cashbill_data_raw, 'student_id' => $studentid, 'packing_id' => $pack_id, 'item_data' => $item_data_raw), $apikey);
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

    public function get_all_pack_with_search($searchpack, $std_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $user_data = transport_data_with_param_with_urlencode(array('action' => 'search_student_pack_billing', 'studentid' => $std_id, 'pack_data' => $searchpack), $apikey);
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

    public function cancel_bill($bill_masterid, $reason)
    {
        $apikey = $this->session->userdata('API-Key');

        $status_data = transport_data_with_param_with_urlencode(array('action' => 'bill_cancel', 'bill_masterid' => $bill_masterid, 'reason' => $reason), $apikey);

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

    public function cancel_voucher($payment_id, $bill_masterid, $reason)
    {
        $apikey = $this->session->userdata('API-Key');

        $status_data = transport_data_with_param_with_urlencode(array('action' => 'bookstore_voucher_cancel', 'payment_id' => $payment_id, 'bill_masterid' => $bill_masterid, 'reason' => $reason), $apikey);

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
}
