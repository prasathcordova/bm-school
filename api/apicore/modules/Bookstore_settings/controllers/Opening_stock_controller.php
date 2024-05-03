<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Opening_stock_controller
 *
 * @author rahul.shibukumar
 */
class Opening_stock_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Opening_stock_model', 'MOP');
    }

    public function get_opening_stock_master($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }

        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "description LIKE '%" . $params['description'] . "%' ";
                } else {
                    $query_string = "description LIKE '%" . $params['description'] . "%' ";
                }
            }
            if (isset($params['status'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "status LIKE '%" . $params['status'] . "%' ";
                } else {
                    $query_string = "status LIKE '%" . $params['status'] . "%' ";
                }
            }
            if (isset($params['storeid'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "storeid = '" . $params['storeid'] . "' ";
                } else {
                    $query_string = "storeid = '" . $params['storeid'] . "' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "description LIKE '%" . $params['description'] . "%' ";
                } else {
                    $query_string = "description LIKE '%" . $params['description'] . "%' ";
                }
            }
            if (isset($params['status'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "status LIKE '%" . $params['status'] . "%' ";
                } else {
                    $query_string = "status LIKE '%" . $params['status'] . "%' ";
                }
            }
            if (isset($params['storeid'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "storeid = '" . $params['storeid'] . "' ";
                } else {
                    $query_string = "storeid = '" . $params['storeid'] . "' ";
                }
            }
        }

        $stock_list = $this->MOP->get_stockmaster_details($apikey, $query_string);
//         dev_export($publisher_list);die;
        if (!empty($stock_list) && is_array($stock_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stock_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    
    
    
    
    
    
    public function get_current_stock_list($params = NULL) {
        $apikey = $params['API_KEY'];
        if (isset($params['store_id'])) {
            $storeid = $params['store_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'store id is required', 'data' => FALSE);
        }

        $stock_list = $this->MOP->get_current_stock($apikey, $storeid);
         
        if (!empty($stock_list) && is_array($stock_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stock_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    
    public function save_opening_stock_new($params = NULL) {
        $apikey = $params['API_KEY'];
        if (isset($params['os_item_details']) && !empty($params['os_item_details'])) {
            $os_item_details_raw = $params['os_item_details'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Opening stock item details is required');
        }
        if (isset($params['purchase_status']) && !empty($params['purchase_status'])) {
            $purchase_status = $params['purchase_status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'purchase status is required', 'data' => FALSE);
        }
        $os_details = json_decode($os_item_details_raw, TRUE);
        $os_details_xml = xml_generator($os_details);
//dev_export($store_id);die;
        $stock_list = $this->MOP->save_opening_stock($apikey, $os_details_xml,$purchase_status);
         
        if (!empty($stock_list) && is_array($stock_list) && $stock_list['error_status'] == 0 ) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('os_id' => $stock_list['os_id']));
        } else {
            if (is_array($stock_list)) {
                return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'data' => $stock_list);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

}
