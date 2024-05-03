<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Item edition_controller
 *
 * @author docme2
 */
class Itemedition_controller extends MX_Controller{
     public function __construct() {
        parent::__construct();
        $this->load->model('Itemedition_model', 'MItem');
    }
    
     public function get_itemedition($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "e.isactive = " . $params['status'];
        }
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "e.id LIKE '%" . $params['id'] . "%' ";
                } else {
                    $query_string = "e.id LIKE '%" . $params['id'] . "%' ";
                }
            }
            if (isset($params['edition_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "e.edition_name LIKE '%" . $params['edition_name'] . "%' ";
                } else {
                    $query_string = "e.edition_name LIKE '%" . $params['edition_name'] . "%' ";
                }
           
            }
            $item_edition = $this->MItem->get_itemedition_details($apikey, $query_string);
            if (!empty($item_edition) && is_array($item_edition)) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $item_edition);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
            }
    }
    
    
    public function save_itemedition($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['edition_name']) && !empty($params['edition_name'])) {
            $dbparams[1] = $params['edition_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Edition Name is required', 'data' => FALSE);
        }
        $itemedition_status = $this->MItem->add_new_itemedtion($dbparams);
        if (!empty($itemedition_status) && is_array($itemedition_status) && $itemedition_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $itemedition_status['id']));
        } else {
            if (is_array($itemedition_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $itemedition_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    
    public function update_itemedition($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 1;
        if (isset($params['edition_id']) && !empty($params['edition_id'])) {
            $dbparams[2] = $params['edition_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Edition ID is required', 'data' => FALSE);
        }
        if (isset($params['edition_name']) && !empty($params['edition_name'])) {
            $dbparams[3] = $params['edition_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Edition Name is required', 'data' => FALSE);
        }
        $dbparams[4] = 0;
        $itemedition_add_status = $this->MItem->update_itemedition_data($dbparams);
        if (!empty($itemedition_add_status) && is_array($itemedition_add_status) && isset($itemedition_add_status['ErrorStatus']) && $itemedition_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $itemedition_add_status);
        } else {
             if(isset($itemedition_add_status['ErrorMessage']) && !empty($itemedition_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $itemedition_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
    
    public function modify_itemedition_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 0;
        if (isset($params['edition_id']) && !empty($params['edition_id'])) {
            $dbparams[2] = $params['edition_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Edition ID is required', 'data' => FALSE);
        }
        $dbparams[3] = NULL;

        if (isset($params['status'])) {
            $dbparams[4] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country Status is required', 'data' => FALSE);
        }

        $itemedition_add_status = $this->MItem->update_itemedition_data($dbparams);
        if (!empty($itemedition_add_status) && is_array($itemedition_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $itemedition_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }

}
