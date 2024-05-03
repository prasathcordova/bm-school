<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Itemmaster_controller
 *
 * @author chandrajith.edsys
 */
class Itemmaster_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Itemmaster_model', 'MIMaster');
    }

    public function get_items($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "im.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }
        if(isset($params['count']) && !empty($params['count'])) {
            $count = $params['count'];
        } else {
            $count = ITEM_SEARCH_DEFAULT_DISPLAY_COUNT;
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['item_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " OR " . "item_id = '" . $params['item_id'] . "' ";
                } else {
                    $query_string = "item_id = '" . $params['item_id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " OR " . "im.item_name LIKE '%" . $params['name'] . "%' ";
                } else {
                    $query_string = "im.item_name LIKE '%" . $params['name'] . "%' ";
                }
            }
             if (isset($params['code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " OR " . "im.item_code LIKE '%" . $params['code'] . "%' ";
                } else {
                    $query_string = "im.item_code LIKE '%" . $params['code'] . "%' ";
                }
            }
             if (isset($params['barcode'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " OR " . "im.barcode LIKE '%" . $params['barcode'] . "%' ";
                } else {
                    $query_string = "im.barcode LIKE '%" . $params['barcode'] . "%' ";
                }
            }
          
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['item_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "item_id = '" . $params['item_id'] . "' ";
                } else {
                    $query_string = "item_id = '" . $params['item_id'] . "' ";
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
        $item_list = $this->MIMaster->get_item_details($apikey, $query_string, $count);        
        if (!empty($item_list) && is_array($item_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $item_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
     public function save_items($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['item_name']) && !empty($params['item_name'])) {
            $dbparams[1] = $params['item_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Name is required', 'data' => FALSE);
        }
        if (isset($params['item_code']) && !empty($params['item_code'])) {
            $dbparams[2] = $params['item_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Code is required', 'data' => FALSE);
        }
        if (isset($params['item_description']) && !empty($params['item_description'])) {
            $dbparams[3] = $params['item_description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Description is required', 'data' => FALSE);
        }
        if (isset($params['category_id']) && !empty($params['category_id'])) {
            $dbparams[4] = $params['category_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Category Type is required', 'data' => FALSE);
        }
        if (isset($params['item_typeid']) && !empty($params['item_typeid'])) {
            $dbparams[5] = $params['item_typeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item type is required', 'data' => FALSE);
        }
        if (isset($params['editionid']) && !empty($params['editionid'])) {
            $dbparams[6] = $params['editionid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Edition is required', 'data' => FALSE);
        }
        if (isset($params['publi_id']) && !empty($params['publi_id'])) {
            $dbparams[7] = $params['publi_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Publisher is required', 'data' => FALSE);
        }
        if (isset($params['purchase_price']) && !empty($params['purchase_price'])) {
            $dbparams[8] = $params['purchase_price'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase price is required', 'data' => FALSE);
        }
        if (isset($params['selling_price']) && !empty($params['selling_price'])) {
            $dbparams[9] = $params['selling_price'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Selling price is required', 'data' => FALSE);
        }
//        dev_export($dbparams);die;
        $item_add_status = $this->MIMaster->add_new_item($dbparams);
//        dev_export($item_add_status);die;
        if (!empty($item_add_status) && is_array($item_add_status) && $item_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('item_id' => $item_add_status['item_id']));
        } else {
            if (is_array($item_add_status)) {
                return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'data' => $item_add_status);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
     public function update_items($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['item_id']) && !empty($params['item_id'])) {
            $dbparams[1] = $params['item_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item ID is required', 'data' => FALSE);
        }
        if (isset($params['item_name']) && !empty($params['item_name'])) {
            $dbparams[2] = $params['item_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Name is required', 'data' => FALSE);
        }
        if (isset($params['item_code']) && !empty($params['item_code'])) {
            $dbparams[3] = $params['item_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Code is required', 'data' => FALSE);
        }
        if (isset($params['item_description']) && !empty($params['item_description'])) {
            $dbparams[4] = $params['item_description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Description is required', 'data' => FALSE);
        }
          if (isset($params['cat_id']) && !empty($params['cat_id'])) {
            $dbparams[5] = $params['cat_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Category details is required', 'data' => FALSE);
        }
        if (isset($params['type_id']) && !empty($params['type_id'])) {
            $dbparams[6] = $params['type_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Type details is required', 'data' => FALSE);
        }
      
        if (isset($params['edition_id']) && !empty($params['edition_id'])) {
            $dbparams[7] = $params['edition_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Edition details is required', 'data' => FALSE);
        }
        if (isset($params['pub_id']) && !empty($params['pub_id'])) {
            $dbparams[8] = $params['pub_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Publisher details is required', 'data' => FALSE);
        }
        if (isset($params['purchase_price']) && !empty($params['purchase_price'])) {
            $dbparams[9] = $params['purchase_price'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase price is required', 'data' => FALSE);
        }
        if (isset($params['selling_price']) && !empty($params['selling_price'])) {
            $dbparams[10] = $params['selling_price'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Selling price is required', 'data' => FALSE);
        }
        $dbparams[11] = 1;
        $dbparams[12] = NULL;
        $item_add_status = $this->MIMaster->update_item_data($dbparams);
//        dev_export($item_add_status);die;
        if (!empty($item_add_status) && is_array($item_add_status)  && $item_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $item_add_status);
        } else {
             if(isset($item_add_status['ErrorMessage']) && !empty($item_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $item_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_item_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['item_id']) && !empty($params['item_id'])) {
            $dbparams[1] = $params['item_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = NULL;
        $dbparams[7] = NULL;
        $dbparams[8] = NULL;
        $dbparams[9] = NULL;
        $dbparams[10] = NULL;
        $dbparams[11] = 0;

        if (isset($params['status'])) {
            $dbparams[12] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Status is required', 'data' => FALSE);
        }

        $item_add_status = $this->MIMaster->update_item_data($dbparams);
        if (!empty($item_add_status) && is_array($item_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $item_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }


}
