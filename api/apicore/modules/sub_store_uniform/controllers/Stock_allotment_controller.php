<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stock_allotment_controller
 *
 * @author saranya.kumar
 */
class Stock_allotment_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stock_allotment_model', 'MSAllotment');
    }

    public function get_stock_for_packing_substore($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['store_id'])) {
            if (empty($params['store_id'])) {
                $storeid = '';
            } else {
                $storeid = $params['store_id'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'store id is required', 'data' => FALSE);
        }

        $stock_list = $this->MSAllotment->get_stock_list_for_allotment($apikey, $storeid);

        if (!empty($stock_list) && is_array($stock_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stock_list);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'No stock data available', 'data' => FALSE);
        }
    }

    public function search_item_stock_for_substore($params) {
//         echo'hi';die;
        $apikey = $params['API_KEY'];
        if (isset($params['store_id'])) {
            if (empty($params['store_id'])) {
                $storeid = '';
            } else {
                $storeid = $params['store_id'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'store id is required', 'data' => FALSE);
        }
        if (isset($params['count'])) {
            $count = $params['count'];
        } else {
            $count = ITEM_SEARCH_DEFAULT_DISPLAY_COUNT;
        }
        if (isset($params['name'])) {
            $name = $params['name'];
        } else {
            $name = '';
        }
        if (isset($params['code'])) {
            $code = $params['code'];
        } else {
            $code = '';
        }
        if (isset($params['barcode'])) {
            $barcode = $params['barcode'];
        } else {
            $barcode = '';
        }

        $dbparams = array(
            $apikey,
            $storeid,
            $count,
            $name,
            $code,
            $barcode
        );

        $stock_list = $this->MSAllotment->get_stock_list_for_substore_search($dbparams);

        if (!empty($stock_list) && is_array($stock_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stock_list);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'No stock data available', 'data' => FALSE);
        }
    }

    public function get_stock_allotment_list_substore($params = NULL) {
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
                    $query_string = $query_string . " AND " . "sa.masterid = '" . $params['id'] . "' ";
                } else {
                    $query_string = "sa.masterid = '" . $params['id'] . "' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "sa.masterid = '" . $params['id'] . "' ";
                } else {
                    $query_string = "sa.masterid = '" . $params['id'] . "' ";
                }
            }
        }

        $stock_allotment_list = $this->MSAllotment->get_stock_allotment_details($apikey, $query_string);

        if (!empty($stock_allotment_list) && is_array($stock_allotment_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stock_allotment_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_stock_allotment_list_substore_out($params = NULL) {
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
                    $query_string = $query_string . " AND " . "sa.masterid = '" . $params['id'] . "' ";
                } else {
                    $query_string = "sa.masterid = '" . $params['id'] . "' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "sa.masterid = '" . $params['id'] . "' ";
                } else {
                    $query_string = "sa.masterid = '" . $params['id'] . "' ";
                }
            }
        }

        $stock_allotment_list = $this->MSAllotment->get_stock_allotment_details_out($apikey, $query_string);

        if (!empty($stock_allotment_list) && is_array($stock_allotment_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stock_allotment_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_Stock_allotment_sub_out($params = NULL) {
        $dbparams = array();
        $apikey = $params['API_KEY'];
        if (isset($params['allotment_item_details']) && !empty($params['allotment_item_details'])) {
            $allotment_details_raw = $params['allotment_item_details'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Rate item details is required');
        }

        if (isset($params['store_id']) && !empty($params['store_id'])) {
            $store_id = $params['store_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'store id is required', 'data' => FALSE);
        }
        if (isset($params['total_qty']) && !empty($params['total_qty'])) {
            $total_qty = $params['total_qty'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Net Quantity is required', 'data' => FALSE);
        }
        if (isset($params['total_value']) && !empty($params['total_value'])) {
            $total_value = $params['total_value'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Net Value is required', 'data' => FALSE);
        }

        if (isset($params['description']) && !empty($params['description'])) {
            $description = $params['description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Description is required', 'data' => FALSE);
        }

        $Stock_allotment_details = json_decode($allotment_details_raw, TRUE);
        $allotment_stock_details_xml = xml_generator($Stock_allotment_details);


//        dev_export($allotment_stock_details_xml);die;
        $stock_allotment_add_status = $this->MSAllotment->save_allotment_sub_out($apikey, $allotment_stock_details_xml, $store_id, $total_qty, $total_value, $description);
//        dev_export($item_add_status);die;
        if (!empty($stock_allotment_add_status) && is_array($stock_allotment_add_status) && $stock_allotment_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('allotment_id' => $stock_allotment_add_status['allotmentid']));
        } else {
            if (is_array($stock_allotment_add_status)) {
                return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'data' => $item_add_status);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function save_edit_allotment_out($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['allotment_id']) && !empty($params['allotment_id'])) {
            $allotment_id = $params['allotment_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'allotment_id data is required');
        }
        if (isset($params['total_qty']) && !empty($params['total_qty'])) {
            $total_qty = $params['total_qty'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'total qty  is required');
        }
        if (isset($params['allotment_item_details']) && !empty($params['allotment_item_details'])) {
            $allotment_item_details = $params['allotment_item_details'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Purchase item details is required');
        }
        if (isset($params['total_value']) && !empty($params['total_value'])) {
            $total_value = $params['total_value'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'total value is required');
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $remarks = $params['remarks'];
        } else {
            $remarks = '';
        }

        $allotment_return_item_details = json_decode($allotment_item_details, TRUE);
        $allotment_item_details_xml = xml_generator($allotment_return_item_details);
        $data_prep_array = array(
            $apikey,
            $allotment_id,
            $allotment_item_details_xml,
            $total_qty,
            $total_value,
            $remarks
        );
//save_edit_purchase
        $purchase_save = $this->MSAllotment->edit_allotment_out_save($data_prep_array);
//        dev_export($purchase_save);die;
        if (isset($purchase_save[0]['status']) && !empty($purchase_save[0]['status']) && $purchase_save[0]['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Allotment editted successfully');
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Allotment failed to save');
        }
    }

    public function get_allotment_approval_data($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['allotment_id']) && !empty($params['allotment_id'])) {
            $allotment_id = $params['allotment_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Allotment data is required', 'data' => FALSE);
        }

        $allotment_master_data = $this->MSAllotment->get_allotment_master_data_for_approval_display($allotment_id, $apikey);
        if ($allotment_master_data) {
            $allotment_detail_data = $this->MSAllotment->get_allotment_detail_data_for_approval_display($allotment_id, $apikey);
            $allotment_comment_data = $this->MSAllotment->get_allotment_comment_data_for_approval_display($allotment_id, $apikey);
            if ($allotment_detail_data) {
                $formatted_data = $this->format_allotment_approval_display_data($allotment_master_data, $allotment_detail_data, $allotment_comment_data);
                return array('data_status' => 1, 'error_status' => 0, 'data' => $formatted_data);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'No Allotment data available', 'data' => FALSE);
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'No Allotment data available', 'data' => FALSE);
        }
    }

    public function format_allotment_approval_display_data($allotment_master, $allotment_detail, $allotment_comment_data) {
        $formatted_data = array();
        if (isset($allotment_master) && !empty($allotment_master)) {
            $formatted_data = array(
                'master_data' => $allotment_master[0],
                'item_data' => $allotment_detail
            );
            if (isset($allotment_comment_data) && !empty($allotment_comment_data)) {
                $formatted_data['comment_data'] = $allotment_comment_data;
            } else {
                $formatted_data['comment_data'] = NULL;
            }
        } else {
            $formatted_data = array(
                'master_data' => NULL,
                'item_data' => NULL,
                'comment_data' => NULL
            );
        }
        return $formatted_data;
    }

}
