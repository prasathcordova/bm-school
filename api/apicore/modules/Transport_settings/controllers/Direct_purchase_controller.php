<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Direct_purchase_controller
 *
 * @author Chandrajith
 */
class Direct_purchase_controller extends MX_Controller{
     public function __construct() {
        parent::__construct();
        $this->load->model('Direct_purchase_model', 'MPurchase');
    }
    public function get_directpurchase($params = NULL) {       
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
                
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }           
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[2] = $params['id'];
        } else {
            $dbparams[2] = NULL;
        }
         
        $purchse_data = $this->MPurchase->get_purchse_data($dbparams);
        if (!empty($purchse_data) && is_array($purchse_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $purchse_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_spare_directpurchase($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['partnum']) && !empty($params['partnum'])) {
            $dbparams[1] = $params['partnum'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Part Number required', 'data' => FALSE);
        }
        if (isset($params['quantity']) && !empty($params['quantity'])) {
            $dbparams[2] = $params['quantity'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Quantity required', 'data' => FALSE);
        }
        if (isset($params['vendor']) && !empty($params['vendor'])) {
            $dbparams[3] = $params['vendor'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor  required', 'data' => FALSE);
        }
        if (isset($params['purchasedate']) && !empty($params['purchasedate'])) {
            $dbparams[4] = $params['purchasedate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase Date required', 'data' => FALSE);
        }
        if (isset($params['unitprice']) && !empty($params['unitprice'])) {
            $dbparams[5] = $params['unitprice'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase Date required', 'data' => FALSE);
        }
        if (isset($params['totalamt']) && !empty($params['totalamt'])) {
            $dbparams[6] = $params['totalamt'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Total amount required', 'data' => FALSE);
        }
        if (isset($params['warranty']) && !empty($params['warranty'])) {
            $dbparams[7] = $params['warranty'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Warranty required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[8] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }     

//return $dbparams;

        $directpurchase_status = $this->MPurchase->add_new_directpurchase($dbparams);
        if (!empty($directpurchase_status) && is_array($directpurchase_status) && $directpurchase_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $directpurchase_status['id']));
        } else {
            if (is_array($directpurchase_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $directpurchase_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function modify_dp_status($params = NULL) {

        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'PURCHASE ID is required', 'data' => FALSE);
        }
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
       
        if (isset($params['status'])) {
            $dbparams[3] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase Status is required', 'data' => FALSE);
        }
        $dbparams[4] = $params['update_flag'];
        if (isset($params['partnum']) && !empty($params['partnum'])) {
            $dbparams[5] = $params['partnum'];
        } else {
            $dbparams[5] = NULL;
        }
        if (isset($params['quantity']) && !empty($params['quantity'])) {
            $dbparams[6] = $params['quantity'];
        } else {
            $dbparams[6] = NULL;
        }
        if (isset($params['vendor']) && !empty($params['vendor'])) {
            $dbparams[7] = $params['vendor'];
        } else {
            $dbparams[7] = NULL;
        }
        if (isset($params['purchasedate']) && !empty($params['purchasedate'])) {
            $dbparams[8] = $params['purchasedate'];
        } else {
            $dbparams[8] = NULL;
        }
        if (isset($params['unitprice']) && !empty($params['unitprice'])) {
            $dbparams[9] = $params['unitprice'];
        } else {
            $dbparams[9] = NULL;
        }
        if (isset($params['totalamt']) && !empty($params['totalamt'])) {
            $dbparams[10] = $params['totalamt'];
        } else {
            $dbparams[10] = NULL;
        }
        if (isset($params['warranty']) && !empty($params['warranty'])) {
            $dbparams[11] = $params['warranty'];
        } else {
            $dbparams[11] = NULL;
        }

        $ven_status = $this->MPurchase->update_purchase_data($dbparams);

        if (!empty($ven_status) && is_array($ven_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $ven_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }
}
