<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stock_allotment_controller
 *
 * @author Docme.kumar
 */

//21-11-2017 Docme
class Stock_allotment_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stock_allotment_model', 'MSAllotment');
    }
    
    
     public function get_stock_allotment_list($params = NULL) {
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
            if (isset($params['description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "sa.description LIKE '%" . $params['purchase_return_code'] . "%' ";
                } else {
                    $query_string = "sa.description LIKE '%" . $params['purchase_return_code'] . "%' ";
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
            if (isset($params['description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "sa.description = '" . $params['description'] . "' ";
                } else {
                    $query_string = "sa.description = '" . $params['description'] . "' ";
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
    
    
    public function save_Stock_allotment($params = NULL) {
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
        
        
//        dev_export($dbparams);die;
        $stock_allotment_add_status = $this->MSAllotment->save_allotment($apikey,$allotment_stock_details_xml,$store_id,$total_qty,$total_value,$description);
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
    
    public function approve_allotment($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['allotment_id']) && !empty($params['allotment_id'])) {
            $dbparams[1] = $params['allotment_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'id is required', 'data' => FALSE);
        }
        if (isset($params['approval_remarks']) && !empty($params['approval_remarks'])) {
            $dbparams[2] = $params['approval_remarks'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Approval Remarks  is required', 'data' => FALSE);
        }
        if (isset($params['status']) && !empty($params['status'])) {
            $dbparams[3] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Status  is required', 'data' => FALSE);
        }
        
//        dev_export($dbparams);die;
        $approval_add_status = $this->MSAllotment->approve_allotment($dbparams);
//        dev_export($item_add_status);die;
        if (!empty($approval_add_status) && is_array($approval_add_status) && isset($approval_add_status['error_status']) && $approval_add_status['error_status'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $approval_add_status);
        } else {
            if (isset($approval_add_status['error_messages']) && !empty($approval_add_status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $approval_add_status['ErrorMessage'], 'data' => $approval_add_status);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
    //21-11-2017 Docme end

    
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
    
    public function format_allotment_approval_display_data($allotment_master, $allotment_detail,$allotment_comment_data) {
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
    
    // ALLOTMENT DELETE AUTHOR : Docme
    public function allotment_delete($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['allotment_id']) && !empty($params['allotment_id'])) {
            $allotment_id = $params['allotment_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Allotment data is required');
        }
        $status = $this->MSAllotment->delete_allotment_order($allotment_id, $apikey);
        if (isset($status[0]['status']) && !empty($status[0]['status']) && $status[0]['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Allotment removed successfully');
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Allotment failed to remove');
        }
    }
    
    
    public function save_edit_allotment($params) {
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
        $purchase_save = $this->MSAllotment->edit_allotment_save($data_prep_array);
//        dev_export($purchase_save);die;
        if (isset($purchase_save[0]['status']) && !empty($purchase_save[0]['status']) && $purchase_save[0]['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Allotment editted successfully');
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Allotment failed to save');
        }
    }
    
}
