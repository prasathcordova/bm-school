<?php

/**
 * Description of Role permission_model
 *
 * @author Aju
 */
class Rolepermission_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_active_roles() {
        $data = array(
            'action' => 'get_role',
            'status' => 1,
            'mode' => 'strict'
        );
        $apikey = $this->session->userdata('API-Key');
        $roles = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($roles['status']) && !empty($roles['status']) && is_array($roles) && $roles['status'] == 1) {
            return $roles['data'];
        } else if (isset($roles['status']) && !empty($roles['status']) && is_array($roles) && $roles['status'] != 1) {
            if (is_array($roles['data'])) {
                return $roles['data'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'General Error');
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Critical Error');
        }
    }

    public function get_roles_privileges($roleid) {
        $data = array(
            'action' => 'get_role_privileges',
            'roleid' => $roleid
        );
        $apikey = $this->session->userdata('API-Key');
        $roles = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($roles['status']) && !empty($roles['status']) && is_array($roles) && $roles['status'] == 1) {
            return $roles['data'];
        } else if (isset($roles['status']) && !empty($roles['status']) && is_array($roles) && $roles['status'] != 1) {
            if (is_array($roles['data'])) {
                return $roles['data'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'General Error');
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Critical Error');
        }
    }

    public function get_appmenus() {
        $data = array(
            'action' => 'permission_app_menus'
        );
        $apikey = $this->session->userdata('API-Key');
        $roles = transport_data_with_param_with_urlencode($data, $apikey);

        if (isset($roles['status']) && !empty($roles['status']) && is_array($roles) && $roles['status'] == 1) {
            return $roles['data'];
        } else if (isset($roles['status']) && !empty($roles['status']) && is_array($roles) && $roles['status'] != 1) {
            if (is_array($roles['data'])) {
                return $roles['data'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'General Error');
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Critical Error');
        }
    }
    public function get_appmodules() {
        $data = array(
            'action' => 'permission_app_module'
        );
        $apikey = $this->session->userdata('API-Key');
        $roles = transport_data_with_param_with_urlencode($data, $apikey);

        if (isset($roles['status']) && !empty($roles['status']) && is_array($roles) && $roles['status'] == 1) {
            return $roles['data'];
        } else if (isset($roles['status']) && !empty($roles['status']) && is_array($roles) && $roles['status'] != 1) {
            if (is_array($roles['data'])) {
                return $roles['data'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'General Error');
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Critical Error');
        }
    }

    public function add_rolesprivileges($pre_data, $roleid) {
        $data['action'] = 'save_role_permission';
        $data['pre_data'] = json_encode($pre_data);
        $data['roleid'] = $roleid;

        $apikey = $this->session->userdata('API-Key');
//        dev_export($apikey);
//        dev_export($data);die;
        $roles = transport_data_with_param_with_urlencode($data, $apikey);
//        dev_export($roles);die;
        if (isset($roles['status']) && !empty($roles['status']) && is_array($roles) && $roles['status'] == 1) {
            return $roles['data'];
        } else if (isset($roles['status']) && !empty($roles['status']) && is_array($roles) && $roles['status'] != 1) {
            if (is_array($roles['data'])) {
                return $roles['data'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'General Error');
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Critical Error');
        }
    }

}
