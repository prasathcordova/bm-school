<?php

/**
 * Description of Pay back_model
 *
 * @author Aju S Aravind
 */
class Payback_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_active_payback_data($inst_id, $acd_year_id) {
        $apikey = $this->session->userdata('API-Key');
        $api_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_payback_data',
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id), $apikey);
        if (isset($api_data) && !empty($api_data) && is_array($api_data)) {
            return $api_data['data'];
        } else {
            if (isset($api_data['message']) && !empty($api_data['message']) && is_array($api_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_voucher_data_for_payback($inst_id, $student_id) {
        $apikey = $this->session->userdata('API-Key');
        $api_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_vouchers_for_payback',
            'inst_id' => $inst_id,
            'student_id' => $student_id), $apikey);
        if (isset($api_data) && !empty($api_data) && is_array($api_data)) {
            return $api_data['data'];
        } else {
            if (isset($api_data['message']) && !empty($api_data['message']) && is_array($api_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_voucher_detail_data_for_payback($inst_id, $payment_id) {
        $apikey = $this->session->userdata('API-Key');
        $api_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_vouchers_details_for_payback',
            'inst_id' => $inst_id,
            'payment_id' => $payment_id), $apikey);
        if (isset($api_data) && !empty($api_data) && is_array($api_data)) {
            return $api_data['data'];
        } else {
            if (isset($api_data['message']) && !empty($api_data['message']) && is_array($api_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_payback_request_data($data_to_save) {
        $apikey = $this->session->userdata('API-Key');
        $api_data = transport_data_with_param_with_urlencode($data_to_save, $apikey);
        if (isset($api_data) && !empty($api_data) && is_array($api_data)) {
            return $api_data['data'];
        } else {
            if (isset($api_data['message']) && !empty($api_data['message']) && is_array($api_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data,
                    'data' => FALSE
                );
            }
        }
    }
    
    public function get_payback_data($inst_id, $master_id) {
        $apikey = $this->session->userdata('API-Key');
        $api_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_payback_data_for_approval',
            'inst_id' => $inst_id,
            'master_id' => $master_id), $apikey);
        if (isset($api_data) && !empty($api_data) && is_array($api_data)) {
            return $api_data['data'];
        } else {
            if (isset($api_data['message']) && !empty($api_data['message']) && is_array($api_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data,
                    'data' => FALSE
                );
            }
        }
    }
    
    public function save_approval_for_payback($data_to_save) {
        $apikey = $this->session->userdata('API-Key');
        $api_data = transport_data_with_param_with_urlencode($data_to_save, $apikey);
//        dev_export($data_to_save);die;
        if (isset($api_data) && !empty($api_data) && is_array($api_data)) {
            return $api_data['data'];
        } else {
            if (isset($api_data['message']) && !empty($api_data['message']) && is_array($api_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data,
                    'data' => FALSE
                );
            }
        }
    }
    
    public function get_payback_data_for_view($inst_id, $master_id) {
        $apikey = $this->session->userdata('API-Key');
        $api_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_payback_data_for_view',
            'inst_id' => $inst_id,
            'master_id' => $master_id), $apikey);
        if (isset($api_data) && !empty($api_data) && is_array($api_data)) {
            return $api_data['data'];
        } else {
            if (isset($api_data['message']) && !empty($api_data['message']) && is_array($api_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $api_data,
                    'data' => FALSE
                );
            }
        }
    }

}
