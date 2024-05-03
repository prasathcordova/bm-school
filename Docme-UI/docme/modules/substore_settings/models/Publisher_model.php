<?php

/**
 * Description of country_model
 *
 * @author aju.docme
 */
class Publisher_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_country_list() {
        $apikey = $this->session->userdata('API-Key');
        $publisher_data = transport_data_with_param_with_urlencode(array('action' => 'get_countries'), $apikey);
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
    public function get_all_publisher_list() {
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
    
    public function get_all_currency() {
        $apikey = $this->session->userdata('API-Key');
        $currency = transport_data_with_param_with_urlencode(array('action' => 'get_currency', 'status' => 1), $apikey);        
        if (is_array($currency)) {
            return $currency['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $currency,
                'data' => FALSE
            );
        }
    }

    public function save_publisher($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_publisher';
        $publisher_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($publisher_status) && $publisher_status['status'] == 1) {
            if (is_array($publisher_status['data']) && $publisher_status['data']['error_status'] == 0) {
                if ($publisher_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $publisher_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $publisher_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function get_country_details($country_id) {
        $apikey = $this->session->userdata('API-Key');
        $publisher_data = transport_data_with_param_with_urlencode(array('action' => 'get_countries', 'id' => $country_id, 'mode' => 'strict'), $apikey);
        if (is_array($publisher_data)) {
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

    public function edit_save_country($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_country';
        $country_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($country_status) && $country_status['status'] == 1) {
            if (is_array($country_status['data']) && $country_status['data']['error_status'] == 0) {
                if ($country_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $country_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $country_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function edit_status_country($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_country_status';
        $country_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($country_status) && $country_status['status'] == 1) {
            if (is_array($country_status['data']) && $country_status['data']['error_status'] == 0) {
                if ($country_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $country_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $country_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

}
