<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OH_management_model
 *
 * @author Rahul
 */
class OH_management_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_openhouse_isdiscount() {

        $apikey = $this->session->userdata('API-Key');
        $discount = transport_data_with_param_with_urlencode(array('action' => 'uniform_get_openhouse_discount'), $apikey);

        if (is_array($discount)) {
            return $discount['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $discount,
                'data' => FALSE
            );
        }
    }

    public function add_new_template_openhouse($master_id, $formatted_template_id) {

        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_add_new_temp_openhouse',
            'master_id' => $master_id, 'template_data' => $formatted_template_id), $apikey);

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

    public function uniform_delete_openhouse($id) {
//        dev_export($formatted_template_id);die;
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_delete_openhouse', 'master_id' => $id), $apikey);
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

    public function uniform_edit_openhouse($master_id, $start_date, $end_date, $no_temp_st, $description, $formatted_template_id,$discount) {
//        dev_export($formatted_template_id);die;
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_edit_openhouse',
            'master_id' => $master_id, 'start_date' => $start_date, 'end_date' => $end_date, 
            'no_temp_st' => $no_temp_st, 'description' => $description, 
            'template_data' => $formatted_template_id, 'is_discount' => $discount), $apikey);
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

    public function uniform_save_openhouse($start_date, $end_date, $no_temp_st, $description, $formatted_template_id, $discount) {

//        dev_export($formatted_template_id);die;
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_save_openhouse', 'start_date' => $start_date, 'end_date' => $end_date, 'no_temp_st' => $no_temp_st, 'description' => $description, 'template_data' => $formatted_template_id, 'is_discount' => $discount), $apikey);
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

    public function edit_ohtemplate($id, $oh_name, $oh_description) {
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_edit_oh_template', 'id' => $id, 'oh_name' => $oh_name, 'oh_description' => $oh_description), $apikey);
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

    public function save_ohtemplate($oh_name, $oh_description) {
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_save_oh_template', 'oh_name' => $oh_name, 'oh_description' => $oh_description), $apikey);
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
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_get_ohtemplate', 'status' => 1), $apikey);
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

    public function uniform_get_openhouse_master($id) {
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_get_openhouse_master', 'id' => $id), $apikey);
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

    public function uniform_get_openhouse_detail($id) {
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_get_openhouse_detail', 'master_id' => $id), $apikey);
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

    public function get_all_openhouse_list() {
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_get_openhouse_master'), $apikey);
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

    public function get_oh_list_edit($id) {
        $apikey = $this->session->userdata('API-Key');
        $oh_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_get_ohtemplate', 'id' => $id), $apikey);
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
