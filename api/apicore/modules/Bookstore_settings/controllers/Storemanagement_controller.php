<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Storemanagement_controller
 *
 * @author Docme.kumar
 */
class Storemanagement_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Storemanagement_model', 'MSmaster');
    }

    public function get_stores($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "s.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['store_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "is.store_id LIKE '%" . $params['store_id'] . "%' ";
                } else {
                    $query_string = "s.store_id LIKE '%" . $params['store_id'] . "%' ";
                }
            }
            if (isset($params['store_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.store_name LIKE '%" . $params['store_name'] . "%' ";
                } else {
                    $query_string = "s.store_name LIKE '%" . $params['store_name'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['store_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.store_id = '" . $params['store_id'] . "' ";
                } else {
                    $query_string = "s.store_id = '" . $params['store_id'] . "' ";
                }
            }
            if (isset($params['store_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.store_name = '" . $params['store_name'] . "' ";
                } else {
                    $query_string = "s.store_name = '" . $params['store_name'] . "' ";
                }
            }
        }


        $item_list = $this->MSmaster->get_store_details($apikey, $query_string);
        if (!empty($item_list) && is_array($item_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $item_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_sub_stores($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "s.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['store_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "is.store_id LIKE '%" . $params['store_id'] . "%' ";
                } else {
                    $query_string = "s.store_id LIKE '%" . $params['store_id'] . "%' ";
                }
            }
            if (isset($params['store_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.store_name LIKE '%" . $params['store_name'] . "%' ";
                } else {
                    $query_string = "s.store_name LIKE '%" . $params['store_name'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['store_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.store_id = '" . $params['store_id'] . "' ";
                } else {
                    $query_string = "s.store_id = '" . $params['store_id'] . "' ";
                }
            }
            if (isset($params['store_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.store_name = '" . $params['store_name'] . "' ";
                } else {
                    $query_string = "s.store_name = '" . $params['store_name'] . "' ";
                }
            }
        }


        $store_list = $this->MSmaster->get_substore_details($apikey, $query_string);
        if (!empty($store_list) && is_array($store_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $store_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_stock_allotment($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "sa.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['stock_allotID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "sa.stock_allotID LIKE '%" . $params['stock_allotID'] . "%' ";
                } else {
                    $query_string = "sa.stock_allotID LIKE '%" . $params['stock_allotID'] . "%' ";
                }
            }
            if (isset($params['description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "sa.description LIKE '%" . $params['description'] . "%' ";
                } else {
                    $query_string = "sa.description LIKE '%" . $params['description'] . "%' ";
                }
            }
            if (isset($params['store_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "sm.store_name LIKE '%" . $params['store_name'] . "%' ";
                } else {
                    $query_string = "sm.store_name LIKE '%" . $params['store_name'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['stock_allotID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "sa.stock_allotID = '" . $params['stock_allotID'] . "' ";
                } else {
                    $query_string = "sa.stock_allotID = '" . $params['stock_allotID'] . "' ";
                }
            }
            if (isset($params['description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "sa.description = '" . $params['description'] . "' ";
                } else {
                    $query_string = "sa.description = '" . $params['description'] . "' ";
                }
            }
            if (isset($params['store_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "sm.store_name = '" . $params['store_name'] . "' ";
                } else {
                    $query_string = "sm.store_name = '" . $params['store_name'] . "' ";
                }
            }
        }


        $stockAllot_list = $this->MSmaster->get_stockAllotment_details($apikey, $query_string);
        if (!empty($stockAllot_list) && is_array($stockAllot_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stockAllot_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_store($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['store_name']) && !empty($params['store_name'])) {
            $dbparams[1] = $params['store_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store Name is required', 'data' => FALSE);
        }

        if (isset($params['store_code']) && !empty($params['store_code'])) {
            $dbparams[2] = $params['store_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store Code  is required', 'data' => FALSE);
        }
        if (isset($params['address1']) && !empty($params['address1'])) {
            $dbparams[3] = $params['address1'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address Line 1  is required', 'data' => FALSE);
        }
        if (isset($params['address2']) && !empty($params['address2'])) {
            $dbparams[4] = $params['address2'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address Line 2  is required', 'data' => FALSE);
        }
        if (isset($params['address3']) && !empty($params['address3'])) {
            $dbparams[5] = $params['address3'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Address Line 3  is required', 'data' => FALSE);
        }
        if (isset($params['phone']) && !empty($params['phone'])) {
            $dbparams[6] = $params['phone'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => '  Contact  is required', 'data' => FALSE);
        }
        if (isset($params['email']) && !empty($params['email'])) {
            $dbparams[7] = $params['email'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => '  Email  is required', 'data' => FALSE);
        }
        if (isset($params['ismain'])) {
            if (($params['ismain']) == 1) {
                $dbparams[8] = 1;
            } else {
                $dbparams[8] = 0;
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => '  ismain  is required', 'data' => FALSE);
        }
//        dev_export($dbparams);die;
        if (isset($params['ismain']) ) {
             if (($params['ismain']) == 2) {
                $dbparams[9] = 1;
            } else {
                $dbparams[9] = 0;
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => '  issub  is required', 'data' => FALSE);
        }
        
//                dev_export($dbparams);die;
        $store_add_status = $this->MSmaster->add_new_store($dbparams);
//        dev_export($store_add_status);die;
        if (!empty($store_add_status) && is_array($store_add_status) && $store_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $store_add_status['store_id']));
        } else {
            if (is_array($store_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $store_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_store($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['store_id']) && !empty($params['store_id'])) {
            $dbparams[1] = $params['store_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store Id is required', 'data' => FALSE);
        }
        if (isset($params['store_name']) && !empty($params['store_name'])) {
            $dbparams[2] = $params['store_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store Name is required', 'data' => FALSE);
        }

        if (isset($params['store_code']) && !empty($params['store_code'])) {
            $dbparams[3] = $params['store_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store Code  is required', 'data' => FALSE);
        }
        if (isset($params['address1']) && !empty($params['address1'])) {
            $dbparams[4] = $params['address1'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address Line 1  is required', 'data' => FALSE);
        }
        if (isset($params['address2']) && !empty($params['address2'])) {
            $dbparams[5] = $params['address2'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address Line 2  is required', 'data' => FALSE);
        }
        if (isset($params['address3']) && !empty($params['address3'])) {
            $dbparams[6] = $params['address3'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Address Line 3  is required', 'data' => FALSE);
        }
        if (isset($params['phone']) && !empty($params['phone'])) {
            $dbparams[7] = $params['phone'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => '  Contact  is required', 'data' => FALSE);
        }
        if (isset($params['email']) && !empty($params['email'])) {
            $dbparams[8] = $params['email'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => '  Email  is required', 'data' => FALSE);
        }
       if (isset($params['ismain'])) {
            if (($params['ismain']) == 1) {
                $dbparams[9] = 1;
            } else {
                $dbparams[9] = 0;
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => '  ismain  is required', 'data' => FALSE);
        }
//        dev_export($dbparams);die;
        if (isset($params['ismain']) ) {
             if (($params['ismain']) == 2) {
                $dbparams[10] = 1;
            } else {
                $dbparams[10] = 0;
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => '  issub  is required', 'data' => FALSE);
        }
        $dbparams[11] = 1;
        $dbparams[12] = 0;

        $store_update_status = $this->MSmaster->store_update($dbparams);
        if (!empty($store_update_status) && is_array($store_update_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $store_update_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }

    public function modify_store_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['store_id']) && !empty($params['store_id'])) {
            $dbparams[1] = $params['store_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store Id is required', 'data' => FALSE);
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
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store Status is required', 'data' => FALSE);
        }
        $store_update_status = $this->MSmaster->store_update($dbparams);
        if (!empty($store_update_status) && is_array($store_update_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $store_update_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }

}
