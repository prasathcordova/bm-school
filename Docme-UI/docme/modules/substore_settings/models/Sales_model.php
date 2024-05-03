<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales_model
 *
 * @author chandrajith.edsys
 */
class Sales_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_publisher_list()
    {
        $apikey = $this->session->userdata('API-Key');
        $publisher_data = transport_data_with_param_with_urlencode(array('action' => 'get_publisher'), $apikey);
        if (is_array($publisher_data)) {
            //            dev_export($publisher_data);die;
            return $publisher_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $publisher_data,
                'data' => FALSE
            );
        }
    }

    public function get_student_search_list($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $publisher_data = transport_data_with_param_with_urlencode(array('action' => 'getstudent_profiledetails_search'), $apikey, $data);
        if (is_array($publisher_data)) {
            //            dev_export($publisher_data);die;
            return $publisher_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $publisher_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_user_list($params = Null)
    {
        $apikey = $this->session->userdata('API-Key');
        $user_data = transport_data_with_param_with_urlencode(array('action' => 'get_tusers'), $apikey);
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

    //     public function get_sibilings_list_for_details($apikey, get_empid) {
    //        $this->db->flush_cache();
    //        $studentdata = $this->db->query("[dbo].[student_sibilings_select] ?,?", array($apikey, $student_id))->result_array();
    //
    //        return $studentdata;
    //    }
    public function get_empid($empid)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_teacher';
        $data['empid'] = $empid;
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

    public function search($data)
    {                                         //display students list on search
        //            dev_export($data);die;
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'getstudent_profiledetails_search';
        $data['key'] = $data['first_name'];
        $data['acdyr'] = $data['acy_yr'];
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($search_status);die;
        return $search_status['data'];
    }

    public function get_all_items($store_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_stock_for_packing_substore';
        $data['store_id'] = $store_id;
        $item_data = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($item_data);die;
        if (is_array($item_data)) {
            return $item_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $item_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_item_list($store_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode(array('action' => 'get_stock_for_allotment', 'store_id' => $store_id), $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['message'])) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $item_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $item_data,
                    'data' => FALSE
                );
            }
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

    public function student_search($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_billstudent_search_list';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($search_status);die;
        return $search_status['data'];
    }

    public function studentadvance_search($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_billadvancestudent_search_list';
        //                dev_export($data);die;
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($search_status);die;
        return $search_status['data'];
    }

    public function studentbillbatch_search($classid)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_bill_batch_list';
        $data['class_id'] = $classid;
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($search_status);die;
        return $search_status['data'];
    }

    public function get_billstudent_name($student_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_student_name_bill';
        $data['studentid'] = $student_id;
        $stud_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($stud_details)) {
            return $stud_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $stud_details,
                'data' => FALSE
            );
        }
    }
    public function get_all_pack_list($student_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_student_pack';
        $data['studentid'] = $student_id;
        $stud_packdetails = transport_data_with_param_with_urlencode($data, $apikey);
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
    public function get_student_pack($student_id, $pack_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_student_pack';
        $data['studentid'] = $student_id;
        $data['pack_id'] = $pack_id;
        $stud_packdetails = transport_data_with_param_with_urlencode($data, $apikey);
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
    public function get_bill_details($billcode)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'bill_print_data';
        $data['bill_code'] = $billcode;
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
    public function update_online_delivery_details($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_online_delivery_details';
        $data['controller_function']   = 'sub_store_settings/Billing_controller/update_online_delivery_details';
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

    public function get_payment_details($pack_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_payment_details';
        $data['pack_id'] = $pack_id;
        $stud_packdetails = transport_data_with_param_with_urlencode($data, $apikey);
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
}
