<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Delivery_model
 *
 * @author Chandrajith
 */
class Delivery_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
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

    public function get_all_user_list_id($id)
    {
        $apikey = $this->session->userdata('API-Key');
        $user_data = transport_data_with_param_with_urlencode(array('action' => 'get_tusers', 'id' => $id), $apikey);
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

    public function get_bill_pack_details($pack_id, $flag = 0)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'uniform_packdetailed_delivery';
        $data['pack_id'] = $pack_id;
        $data['flag'] = $flag;
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
    public function delivery_note_data($pack_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'uniform_get_delivery_note_print_data';
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

    public function get_all_pack_list($student_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'uniform_get_student_pack_delivery';
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

    public function get_all_pack_list_faculty($emp_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'uniform_get_faculty_pack_delivery';
        $data['emp_id'] = $emp_id;
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

    public function get_items_replace($price, $type_id, $item_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'uniform_replace_item_delivery';
        $data['type_id'] = $type_id;
        $data['price'] = $price;
        $data['item_id'] = $item_id;
        $stud_packdetails = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($stud_packdetails);die;
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

    public function student_search($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_billstudent_search_list';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($search_status);die;
        return $search_status['data'];
    }

    public function delivery_save($delivery_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'delivery_masterid' => $delivery_id,
            'action' => 'uniform_save_delivery_student'
        );
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }

    public function deliveryReturn_save($delivery_id, $student_id, $sub_total, $tax, $net_value, $reason, $delivery_data, $return_roundoff, $total_before_roundoff, $pay_back_amount)
    {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'delivery_masterid' => $delivery_id,
            'student_id' => $student_id,
            'subtotal' => $sub_total,
            'tax' => $tax,
            'final_amount' => $net_value,
            'pay_back_amount' => $pay_back_amount,
            'reason' => $reason,
            'delivery_data' => $delivery_data,
            'round_off' => $return_roundoff,
            'total_before_roundoff' => $total_before_roundoff,
            'action' => 'uniform_save_deliveryReturn_student'
        );
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }

    public function faculty_deliveryReturn_save($delivery_id, $emp_id, $sub_total, $tax, $net_value, $reason, $delivery_data, $return_roundoff, $total_before_roundoff)
    {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'delivery_masterid' => $delivery_id,
            'emp_id' => $emp_id,
            'subtotal' => $sub_total,
            'tax' => $tax,
            'final_amount' => $net_value,
            'reason' => $reason,
            'delivery_data' => $delivery_data,
            'round_off' => $return_roundoff,
            'total_before_roundoff' => $total_before_roundoff,
            'action' => 'uniform_save_deliveryReturn_faculty'
        );
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }

    public function delivery_itemReplace_save($pack_id, $re_item_id, $item_id, $price, $qty, $del_detail_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'pack_id' => $pack_id,
            're_item_id' => $re_item_id,
            'item_id' => $item_id,
            'qty' => $qty,
            'price' => $price,
            'del_detail_id' => $del_detail_id,
            'action' => 'uniform_save_delivery_item_replace'
        );
        //        dev_export($data_prep);die;
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        //        dev_export($item_data);die;
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }

    public function get_all_deliveryReturn_list($student_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'uniform_get_student_pack_deliveryReturn';
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

    public function get_all_deliveryReturn_faculty_list($emp_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'uniform_get_faculty_pack_deliveryReturn';
        $data['emp_id'] = $emp_id;
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

    public function deliveryOHReturn_save($delivery_id, $student_id, $sub_total, $tax, $net_value, $reason, $return_roundoff, $total_before_roundoff, $pay_back_amount)
    {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'delivery_masterid' => $delivery_id,
            'student_id' => $student_id,
            'subtotal' => $sub_total,
            'tax' => $tax,
            'final_amount' => $net_value,
            'pay_back_amount' => $pay_back_amount,
            'reason' => $reason,
            'round_off' => $return_roundoff,
            'total_before_roundoff' => $total_before_roundoff,
            'action' => 'uniform_sales_delivery_return_save_OH'
        );
        //        dev_export($data_prep);die;
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }

    public function voucher_search($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'uniform_get_student_voucher_search_delivery';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($search_status);die;
        return $search_status['data'];
    }

    public function uniform_voucher_search_faculty($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'uniform_voucher_search_faculty';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($search_status);die;
        return $search_status['data'];
    }

    public function get_all_online_order()
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_uniform_online_order';
        $item_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }
}
