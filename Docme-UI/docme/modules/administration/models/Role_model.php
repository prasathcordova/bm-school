<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Role_management_model
 *
 * @author saranya.kumar
 */
class Role_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_user_activity($userid) {
        $apikey = $this->session->userdata('API-Key');
        $data = transport_data_with_param_with_urlencode(array('action' => 'get_user_activity', 'user_id' => $userid), $apikey);
        if (is_array($data) && isset($data['data']) && !empty($data['data'])) {
//            dev_export($data);die;
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

    public function get_all_role_list() {
        $apikey = $this->session->userdata('API-Key');
        $role_data = transport_data_with_param_with_urlencode(array('action' => 'get_role'), $apikey);
        if (is_array($role_data) && isset($role_data['data']) && !empty($role_data['data'])) {
//            dev_export($role_data);die;
            return $role_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $role_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_role_list_for_employee() {
        $apikey = $this->session->userdata('API-Key');
        $role_data = transport_data_with_param_with_urlencode(array('action' => 'get_role','status'=>1), $apikey);
        if (is_array($role_data) && isset($role_data['data']) && !empty($role_data['data'])) {
//            dev_export($role_data);die;
            return $role_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $role_data,
                'data' => FALSE
            );
        }
    }

    public function get_role_data($roleid) {
        $apikey = $this->session->userdata('API-Key');
        $role_data = transport_data_with_param_with_urlencode(array('action' => 'get_role', 'mode' => 'strict', 'id' => $roleid), $apikey);
        if (is_array($role_data) && isset($role_data['data']) && !empty($role_data['data'])) {
            return $role_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $role_data,
                'data' => FALSE
            );
        }
    }
    public function search_role_list($query_string) {
        $apikey = $this->session->userdata('API-Key');
        $role_data = transport_data_with_param_with_urlencode(array('action' => 'get_role','mode' => 'search','name' => $query_string), $apikey);
        if (is_array($role_data) && isset($role_data['data']) && !empty($role_data['data'])) {
            return $role_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $role_data,
                'data' => FALSE
            );
        }
    }
    public function get_rolepermissions_data($roleid) {
        $apikey = $this->session->userdata('API-Key');
        $role_data = transport_data_with_param_with_urlencode(array('action' => 'available_permissions', 'mode' => 'strict', 'roleid' => $roleid), $apikey);
        if (is_array($role_data) && isset($role_data['data']) && !empty($role_data['data'])) {
            return $role_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $role_data,
                'data' => FALSE
            );
        }
    }
     public function save_role($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_roles';
        $role_status = transport_data_with_param_with_urlencode($data, $apikey);
//        dev_export($role_status);die;
        if (is_array($role_status) && $role_status['status'] == 1) {
            if (is_array($role_status['data']) && $role_status['data']['error_status'] == 0) {
                if ($role_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved','id' => $role_status['data']['data']['id']);
                } else {
                    return array('status' => 0, 'message' => $role_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $role_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }
     public function update_role($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_roles';
        $role_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($role_status) && $role_status['status'] == 1) {
            if (is_array($role_status['data']) && $role_status['data']['error_status'] == 0) {
                if ($role_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved','id' => $role_status['data']['data']['id']);
                } else {
                    return array('status' => 0, 'message' => $role_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $role_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

}
