<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Store_settings_controller
 *
 * @author saranya.kumar
 */
class Store_settings_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Store_settings_model', 'MSSettings');
    }

    public function get_graph_substore_settings($params = NULL) {
        $apikey = $params['API_KEY'];
        $list = $this->MSSettings->get_storeSettings_details($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }

    public function get_current_stock_list($params = NULL) {
        $apikey = $params['API_KEY'];
        if (isset($params['store_id'])) {
            $storeid = $params['store_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'store id is required', 'data' => FALSE);
        }

        $stock_list = $this->MSSettings->get_current_stock($apikey, $storeid);

        if (!empty($stock_list) && is_array($stock_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stock_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

}
