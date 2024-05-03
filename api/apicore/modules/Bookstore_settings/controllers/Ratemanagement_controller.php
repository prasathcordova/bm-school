<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ratemanagement_controller
 *
 * @author chandrajith.edsys
 */
class Ratemanagement_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ratemanagement_model', 'MRMaster');
    }

    public function get_item_rate($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
//        if (isset($params['store_id']) && !empty($params['store_id'])) {
//            $store_id = $params['store_id'];
//        } else {
//            return array('data_status' => 0, 'error_status' => 0, 'message' => 'store_id   is required');
//        }

        if (isset($params['status'])) {
            $query_string = "im.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "im.id LIKE '%" . $params['id'] . "%' ";
                } else {
                    $query_string = "im.id LIKE '%" . $params['id'] . "%' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "im.item_name LIKE '%" . $params['name'] . "%' ";
                } else {
                    $query_string = "im.item_name LIKE '%" . $params['name'] . "%' ";
                }
            }
            if (isset($params['description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "im.item_description LIKE '%" . $params['abbr'] . "%' ";
                } else {
                    $query_string = "im.item_description LIKE '%" . $params['description'] . "%' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "ct.name LIKE '%" . $params['name'] . "%' ";
                } else {
                    $query_string = "ct.name LIKE '%" . $params['name'] . "%'";
                }
            }
            if (isset($params['description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "ct.description LIKE '%" . $params['description'] . "%' ";
                } else {
                    $query_string = "ct.description LIKE '%" . $params['description'] . "%'";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "im.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "im.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "im.item_name = '" . $params['name'] . "' ";
                } else {
                    $query_string = "im.item_name = '" . $params['name'] . "' ";
                }
            }
            if (isset($params['description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "im.item_description = '" . $params['description'] . "' ";
                } else {
                    $query_string = "im.item_description = '" . $params['description'] . "' ";
                }
            }
            if (isset($params['currency_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "ct.name = '" . $params['name'] . "' ";
                } else {
                    $query_string = "ct.name = '" . $params['name'] . "'";
                }
            }
            if (isset($params['description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "ct.description = '" . $params['description'] . "' ";
                } else {
                    $query_string = "ct.description = '" . $params['description'] . "'";
                }
            }
        }


        $item_list = $this->MRMaster->get_itemrate_details($apikey, $query_string);
        if (!empty($item_list) && is_array($item_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $item_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function rate_change_item($params = NULL) {
        $dbparams = array();
        $apikey = $params['API_KEY'];
        $flag = 2;
        if (isset($params['rate_item_details']) && !empty($params['rate_item_details'])) {
            $rate_details_raw = $params['rate_item_details'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Rate item details is required');
        }
//        if (isset($params['store_id']) && !empty($params['store_id'])) {
//            $store_id = $params['store_id'];
//        } else {
//            return array('data_status' => 0, 'error_status' => 0, 'message' => 'store id is required');
//        }

        $rate_item_details = json_decode($rate_details_raw, TRUE);
        $rate_item_details_xml = xml_generator($rate_item_details);

//        dev_export($rate_item_details_xml);die;

        $rate_add_status = $this->MRMaster->change_rate($apikey, $flag, $rate_item_details_xml);
//        dev_export($rate_add_status);die;
        if (!empty($rate_add_status) && is_array($rate_add_status) && $rate_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully');
        } else {
            if (is_array($rate_add_status)) {
                return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'data' => $rate_add_status);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function rate_change_item_for_allsubstore($params = NULL) {
        $dbparams = array();
//        $data_prep_array = array();
        $apikey = $params['API_KEY'];
        $flag = 1;
        if (isset($params['rate_item_details']) && !empty($params['rate_item_details'])) {
            $rate_details_raw = $params['rate_item_details'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Rate item details is required');
        }


        $rate_item_details = json_decode($rate_details_raw, TRUE);
        $rate_item_details_xml = xml_generator($rate_item_details);

        $store_id = NULL;
//        dev_export($rate_item_details_xml);die;

        $rate_add_status = $this->MRMaster->change_rate($apikey, $flag, $rate_item_details_xml, $store_id);
//        dev_export($rate_add_status);die;
        if (!empty($rate_add_status) && is_array($rate_add_status) && $rate_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully');
        } else {
            if (is_array($rate_add_status)) {
                return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'data' => $rate_add_status);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function rate_display_item_for_allsubstore($params = NULL) {
        $dbparams = array();
//        $data_prep_array = array();
        $apikey = $params['API_KEY'];

//        if (isset($params['store_id']) && !empty($params['store_id'])) {
//            $store_id = $params['store_id'];
//        } else {
//            return array('data_status' => 0, 'error_status' => 0, 'message' => 'store id is required');
//        }



//        dev_export($rate_item_details_xml);die;

        $rate_add_status = $this->MRMaster->get_itemrate_details_for_substore($apikey);
//        dev_export($rate_add_status);die;
        if (!empty($rate_add_status) && is_array($rate_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $rate_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

}
