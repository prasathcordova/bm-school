<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OH_packing_model
 *
 * @author docme
 */
class OH_packing_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	//change openhouse ---Rahul 3/2/2018

    public function remove_stud_data($template_config_id, $template_id, $formatted_student_data) {
        $apikey = $this->session->userdata('API-Key');
        $acd_data = transport_data_with_param_with_urlencode(array(
            'action' => 'remove_oh_student_assign',
            'template_config_id' => $template_config_id,
            'template_id' => $template_id,
            'student_data' => $formatted_student_data,
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

    public function get_student_openhouse($template_id, $openhouse_id) {
        $store_id = $this->session->userdata('store_id');;
        $apikey = $this->session->userdata('API-Key');
        $openhouse = transport_data_with_param_with_urlencode(array(
            'action' => 'get_student_openhouse',
            'template_id' => $template_id,
            'openhouse_id' => $openhouse_id,
            'store_id' => $store_id
                ), $apikey);
        if (is_array($openhouse)) {
            return $openhouse['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $openhouse,
                'data' => FALSE
            );
        }
    }
	//end change openhouse ---Rahul 3/2/2018

    public function search_template_byname($search_template) {
        $apikey = $this->session->userdata('API-Key');
        $acd_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_ohtemplate',
            'name' => $search_template
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

    public function save_stud_data($template_config_id, $template_id, $formatted_student_data) {
        $apikey = $this->session->userdata('API-Key');
        $acd_data = transport_data_with_param_with_urlencode(array(
            'action' => 'save_oh_student_assign',
            'template_config_id' => $template_config_id,
            'template_id' => $template_id,
            'student_data' => $formatted_student_data,
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

    public function get_all_acadyr() {
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

    public function get_all_stream() {
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

    public function get_all_session() {
        $apikey = $this->session->userdata('API-Key');
        $session_dta = transport_data_with_param_with_urlencode(array('action' => 'get_session'), $apikey);
        if (is_array($session_dta)) {
            return $session_dta['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $session_dta,
                'data' => FALSE
            );
        }
    }

    public function get_all_class() {
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

    public function get_all_batch($acd_year) {
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

    public function get_all_relegion() {
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

    public function get_batch_data($stream_id, $academic_year, $session_id, $class_id, $flag_status) {
//        return array($stream_id, $academic_year, $session_id, $class_id, $flag_status);
        $apikey = $this->session->userdata('API-Key');
        $batch = transport_data_with_param_with_urlencode(array('action' => 'get_batch', 'status' => 1, 'Acd_Year' => $academic_year, 'Stream_ID' => $stream_id,
            'Session_ID' => $session_id, 'Class_Det_ID' => $class_id, 'status_flag' => $flag_status), $apikey);
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

    public function get_student_data($admissionno, $stream_id, $academic_year, $session_id, $class_id, $batch_id, $gender, $religion) {
        $apikey = $this->session->userdata('API-Key');
        $data = transport_data_with_param_with_urlencode(array('action' => 'get_stud_for_ohassign', 'status' => 1, 'Acd_Year' => $academic_year, 'Stream_ID' => $stream_id,
            'Session_ID' => $session_id, 'class_id' => $class_id, 'batch_id' => $batch_id, 'gender' => $gender, 'religion' => $religion, 'adminno' => $admissionno), $apikey);
        if (is_array($data)) {
            return $data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $data,
                'data' => FALSE
            );
        }
    }

    public function get_items_for_oh_stud_assign($template_id,$openhouse_id) {
        $apikey = $this->session->userdata('API-Key');
//        dev_export($apikey);die;
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'select_item_oh_stud_assign', 'template_id' => $template_id, 'openhouse_id' => $openhouse_id), $apikey);
//        dev_export($oh_data);die;
        if (is_array($oh_data)) {
            return $oh_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $oh_data,
                'data' => FALSE
            );
        }
    }
    public function get_items_for_oh_stud_assign_for_item_assign_for_template($template_id) {
        $apikey = $this->session->userdata('API-Key');
//        dev_export($apikey);die;
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'select_item_oh_stud_assign', 'template_id' => $template_id), $apikey);
//        dev_export($oh_data);die;
        if (is_array($oh_data)) {
            return $oh_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $oh_data,
                'data' => FALSE
            );
        }
    }

    public function get_oh_stud_assign_data_search($openhouse) {
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'get_oh_stud_assign_data','openhouse_name' =>$openhouse ), $apikey);
        if (is_array($oh_data)) {
            return $oh_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $oh_data,
                'data' => FALSE
            );
        }
    }
    public function get_oh_stud_assign_data() {
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'get_oh_stud_assign_data'), $apikey);
        if (is_array($oh_data)) {
            return $oh_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $oh_data,
                'data' => FALSE
            );
        }
    }

    public function save_ohitem_assign($template_id, $total_qty, $sub_total, $vat, $discount, $final_item_string, $roundoff, $finaltotal, $discount_type) {
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'save_oh_item_assign', 'template_id' => $template_id, 'total_qty' => $total_qty,
            'sub_total' => $sub_total, 'vat' => $vat, 'discount' => $discount, 'final_itemdata' => $final_item_string, 'roundoff' => $roundoff, 'finaltotal' => $finaltotal, 'discount_type' => $discount_type), $apikey);
        if (is_array($oh_data)) {
            return $oh_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $oh_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_oh_list() {
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'get_ohtemplate', 'status ' => 1), $apikey);
        if (is_array($oh_data)) {
            return $oh_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $oh_data,
                'data' => FALSE
            );
        }
    }

    public function get_items_allitem($store_id) {
//        dev_export($store_id);die;
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'get_stock_for_packing_substore', 'store_id' => $store_id), $apikey);
        if (is_array($oh_data)) {
            return $oh_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $oh_data,
                'data' => FALSE
            );
        }
    }

    public function search_items_in_substore($store_id, $search) {
//        dev_export($store_id);die;
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'search_item_stock_for_substore', 'store_id' => $store_id, 'name' => $search, 'barcode' => $search, 'code' => $search), $apikey);
        if (is_array($oh_data)) {
            return $oh_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $oh_data,
                'data' => FALSE
            );
        }
    }

}
