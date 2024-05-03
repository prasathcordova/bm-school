<?php

/**
 * Description of suppliers_model
 *
 * @author Saranya kumar G
 */
class Suppliers_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_suppliers_list() {
        $apikey = $this->session->userdata('API-Key');
        $suppliers_data = transport_data_with_param_with_urlencode(array('action' => 'get_suppliers'), $apikey);
        if (is_array($suppliers_data)) {
//            dev_export($suppliers_data);die;
            return $suppliers_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $suppliers_data,
                'data' => FALSE
            );
        }
    }

    public function save_suppliers($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_suppliers';
        $suppliers_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($suppliers_status) && $suppliers_status['status'] == 1) {
            if (is_array($suppliers_status['data']) && $suppliers_status['data']['error_status'] == 0) {
                if ($suppliers_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $suppliers_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $suppliers_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function get_suppliers_details($id) {
        $apikey = $this->session->userdata('API-Key');
        $suppliers_data = transport_data_with_param_with_urlencode(array('action' => 'get_suppliers', 'id' => $id, 'mode' => 'strict'), $apikey);
        if (is_array($suppliers_data)) {
//            dev_export($suppliers_data);
//            die;
            return $suppliers_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $suppliers_data,
                'data' => FALSE
            );
        }
    }

    public function edit_save_suppliers($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_suppliers';
        $suppliers_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($suppliers_status) && $suppliers_status['status'] == 1) {
            if (is_array($suppliers_status['data']) && $suppliers_status['data']['error_status'] == 0) {
                if ($suppliers_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $suppliers_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => $suppliers_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function edit_status_suppliers($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_suppliers_status';
        $suppliers_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($suppliers_status) && $suppliers_status['status'] == 1) {
            if (is_array($suppliers_status['data']) && $suppliers_status['data']['error_status'] == 0) {
                if ($suppliers_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $suppliers_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $suppliers_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

}
