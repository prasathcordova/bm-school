<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category_model
 *
 * @author Rahul
 */
class Category_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
     public function get_all_category_list() {
        $apikey = $this->session->userdata('API-Key');
        $category_data = transport_data_with_param_with_urlencode(array('action' => 'get_category'), $apikey);
        if (is_array($category_data)) {
//            dev_export($category_data);die;
            return $category_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $category_data,
                'data' => FALSE
            );
        }
    }
    
       public function edit_status_category($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_category_status';
        $category_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($category_status) && $category_status['status'] == 1) {
            if (is_array($category_status['data']) && $category_status['data']['error_status'] == 0) {
                if ($category_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $category_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $category_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
    
       public function get_category_details($cate_id) {
        $apikey = $this->session->userdata('API-Key');
        $category_data = transport_data_with_param_with_urlencode(array('action' => 'get_category', 'id' => $cate_id, 'mode' => 'strict'), $apikey);
        if (is_array($category_data)) {
            return $category_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $category_data,
                'data' => FALSE
            );
        }
    }
           public function edit_save_category($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_category';
        $category_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($category_status) && $category_status['status'] == 1) {
            if (is_array($category_status['data']) && $category_status['data']['error_status'] == 0) {
                if ($category_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $category_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => $category_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
           public function save_category($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_category';
        $category_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($category_status) && $category_status['status'] == 1) {
            if (is_array($category_status['data']) && $category_status['data']['error_status'] == 0) {
                if ($category_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $category_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $category_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }
}
