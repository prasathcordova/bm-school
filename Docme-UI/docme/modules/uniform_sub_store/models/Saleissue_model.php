<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Saleissue_model
 *
 * @author chandrajith.edsys
 */
class Saleissue_model extends CI_Model
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
    public function get_all_studentdata($acd_year_id, $batchid)
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array('action' => 'getdetails_student', 'acd_year' => $acd_year_id, 'batchid' => $batchid), $apikey);
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
    /* Author : Rahul
     * Purpose : Search teachers by name 
     */
    public function get_all_user_list_byname($teacher_name)
    {
        $apikey = $this->session->userdata('API-Key');
        $user_data = transport_data_with_param_with_urlencode(array('action' => 'get_tusers', 'name' => $teacher_name), $apikey);
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
    public function save_emp_specimen_issue($data_prep)
    {
        //          dev_export($data_prep);die;
        $apikey = $this->session->userdata('API-Key');
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
    public function save_student_item_issue($data_prep)
    {
        //          dev_export($data_prep);die;
        $apikey = $this->session->userdata('API-Key');
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

    public function get_all_item_with_search($search_item, $store_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $user_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_search_item_stock_for_substore', 'store_id' => $store_id, 'name' => $search_item, 'code' => $search_item, 'barcode' => $search_item), $apikey);
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
}
