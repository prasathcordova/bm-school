<?php

/**
 * Description of Stock_model
 *
 * @author Aju
 */
class Stock_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_store_details() {
        $apikey = $this->session->userdata('API-Key');
        $store_data = transport_data_with_param_with_urlencode(array('action' => 'store_show'), $apikey);
        if (is_array($store_data)) {
            return $store_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $store_data,
                'data' => FALSE
            );
        }
    }

    public function get_stock_data_for_store($storeid) {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'get_current_stock_list_report',
            'store_id' => $storeid
            );
        $stock_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        return $stock_data['data'];
    }

}
