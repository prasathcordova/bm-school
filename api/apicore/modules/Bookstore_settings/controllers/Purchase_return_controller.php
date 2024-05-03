<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Purchase_return_controller
 *
 * @author Docme.kumar
 */
//21-11-2017 Docme

class Purchase_return_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Purchase_return_model', 'MPurchase_return');
    }

    public function get_purchase_return($params = NULL) {
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
                    $query_string = $query_string . " AND " . "prt.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "prt.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['purchase_return_code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "prt.purchase_return_code LIKE '%" . $params['purchase_return_code'] . "%' ";
                } else {
                    $query_string = "prt.purchase_return_code LIKE '%" . $params['purchase_return_code'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "prt.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "prt.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['purchase_return_code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "prt.purchase_return_code = '" . $params['purchase_return_code'] . "' ";
                } else {
                    $query_string = "prt.purchase_return_code = '" . $params['purchase_return_code'] . "' ";
                }
            }
        }


        $purchase_return_list = $this->MPurchase_return->get_purchase_return_details($apikey, $query_string);
        if (!empty($purchase_return_list) && is_array($purchase_return_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $purchase_return_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_purchase_return($params = NULL) {
        $dbparams = array();
        $apikey = $params['API_KEY'];
        if (isset($params['return_item_details']) && !empty($params['return_item_details'])) {
            $return_details_raw = $params['return_item_details'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Rate item details is required');
        }
        if (isset($params['purchase_return_date']) && !empty($params['purchase_return_date'])) {
            $purchase_return_date = $params['purchase_return_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Date  is required', 'data' => FALSE);
        }


        if (isset($params['supplier_code']) && !empty($params['supplier_code'])) {
            $supplier_code = $params['supplier_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'supplier code is required', 'data' => FALSE);
        }
        if (isset($params['total_qty']) && !empty($params['total_qty'])) {
            $total_qty = $params['total_qty'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Net Quantity is required', 'data' => FALSE);
        }
        if (isset($params['item_count']) && !empty($params['item_count'])) {
            $item_count = $params['item_count'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Net Quantity is required', 'data' => FALSE);
        }
        if (isset($params['total_value']) && !empty($params['total_value'])) {
            $total_value = $params['total_value'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Net price is required', 'data' => FALSE);
        }

        if (isset($params['description']) && !empty($params['description'])) {
            $description = $params['description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Description is required', 'data' => FALSE);
        }

        $return_details = json_decode($return_details_raw, TRUE);
        $return_details_xml = xml_generator($return_details);

        $return_add_status = $this->MPurchase_return->save_purchase_return($apikey, $return_details_xml, $purchase_return_date, $supplier_code, $total_qty, $item_count, $total_value, $description);
//        dev_export($return_add_status);die;
        if (!empty($return_add_status) && is_array($return_add_status) && $return_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('return_id' => $return_add_status['purchase_code']));
        } else {
            if (is_array($return_add_status)) {
                return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'data' => $return_add_status);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function approve_purchase_return($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['return_id']) && !empty($params['return_id'])) {
            $dbparams[1] = $params['return_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'id is required', 'data' => FALSE);
        }
        if (isset($params['comments']) && !empty($params['comments'])) {
            $dbparams[2] = $params['comments'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Approval Remarks  is required', 'data' => FALSE);
        }
        if (isset($params['status']) && !empty($params['status'])) {
            $dbparams[3] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Approval Remarks  is required', 'data' => FALSE);
        }

//        dev_export($dbparams);die;
        $approval_add_status = $this->MPurchase_return->approve_purchase_return($dbparams);
//        dev_export($approval_add_status);die;
        if (!empty($approval_add_status) && is_array($approval_add_status) && isset($approval_add_status['error_status']) && $approval_add_status['error_status'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $approval_add_status);
        } else {
            if (isset($approval_add_status['error_messages']) && !empty($approval_add_status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $approval_add_status['error_messages'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

//21-11-2017 Docme end
//Author  : Aju S Aravind
//Purpose : To get purchase return data by return id
    public function get_purchase_return_byid($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['return_id']) && !empty($params['return_id'])) {
            $returnid = $params['return_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Return id is required', 'data' => FALSE);
        }

        $return_master_data = $this->MPurchase_return->get_return_master_data_by_id($returnid, $apikey);
        $return_detail_data = $this->MPurchase_return->get_return_detail_data_by_id($returnid, $apikey);
        $return_comment_data = $this->MPurchase_return->get_return_comment_data_by_id($returnid, $apikey);        
        $formatted_data = $this->format_data_for_return($return_master_data, $return_detail_data, $return_comment_data);        
        if (isset($formatted_data) && !empty($formatted_data)) {
            return array('data_status' => 1, 'data' => $formatted_data);
        } else {
            return array('data_status' => 0, 'data' => FALSE, 'message' => 'Return data not available');
        }
    }

    public function format_data_for_return($return_master, $return_details, $return_comments) {        
        if (isset($return_master) && !empty($return_master) && isset($return_details) && !empty($return_details)) {
            $formatted_data = array(
                'master_data' => $return_master[0],
                'detail_data' => $return_details,
            );
            if (isset($return_comments) && !empty($return_comments)) {
                $formatted_data['comment_data'] = $return_comments;
            } else {
                $formatted_data['comment_data'] = NULL;
            }
            return $formatted_data;
        } else {
            return false;
        }
    }

    public function purchase_return_delete($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['returnid']) && !empty($params['returnid'])) {
            $returnid = $params['returnid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase return data is required');
        }
        $status = $this->MPurchase_return->delete_purchase_return($returnid, $apikey);
        if (isset($status[0]['status']) && !empty($status[0]['status']) && $status[0]['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Purchase Return removed successfully');
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase Return failed to remove');
        }
    }
    
    
    
    
    public function save_edit_purchase_return($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['return_id']) && !empty($params['return_id'])) {
            $return_id = $params['return_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase return data is required');
        }

        if (isset($params['purchase_return_date']) && !empty($params['purchase_return_date'])) {
            $purchase_return_date = $params['purchase_return_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'purchase return date is required');
        }
        if (isset($params['supplier_code']) && !empty($params['supplier_code'])) {
            $supplier_code = $params['supplier_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'supplier code is required');
        }

        if (isset($params['total_qty']) && !empty($params['total_qty'])) {
            $total_qty = $params['total_qty'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'total qty  is required');
        }
        if (isset($params['return_item_details']) && !empty($params['return_item_details'])) {
            $return_item_details_raw = $params['return_item_details'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Purchase item details is required');
        }
        if (isset($params['item_count']) && !empty($params['item_count'])) {
            $item_count = $params['item_count'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => ' item count details is required');
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

        $purchase_return_item_details = json_decode($return_item_details_raw, TRUE);
        $purchase_return_item_details_xml = xml_generator($purchase_return_item_details);
        $data_prep_array = array(
            $apikey,
            $return_id,
            $purchase_return_item_details_xml,
            $purchase_return_date,
            $supplier_code,
            $total_qty,
            $item_count,
            $total_value,
            $remarks
        );
//save_edit_purchase
        $purchase_save = $this->MPurchase_return->edit_purchase_return($data_prep_array);
//        dev_export($purchase_save);die;
        if (isset($purchase_save[0]['status']) && !empty($purchase_save[0]['status']) && $purchase_save[0]['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Purchase editted successfully');
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase failed to save');
        }
    }
    
}
