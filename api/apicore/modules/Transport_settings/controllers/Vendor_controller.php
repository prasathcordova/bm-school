<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vendor_controller
 *
 * @author Chandrajith
 */
class Vendor_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Vendor_model', 'MVendor');
    }

    public function get_vendor($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }

        $vendor_data = $this->MVendor->get_vendor_data($dbparams);
        if (!empty($vendor_data) && is_array($vendor_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vendor_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_vendor($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['vendor']) && !empty($params['vendor'])) {
            $dbparams[1] = $params['vendor'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor Name required', 'data' => FALSE);
        }
        if (isset($params['address']) && !empty($params['address'])) {
            $dbparams[2] = $params['address'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor address required', 'data' => FALSE);
        }
        if (isset($params['email']) && !empty($params['email'])) {
            $dbparams[3] = $params['email'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor email required', 'data' => FALSE);
        }
        if (isset($params['contactnumber']) && !empty($params['contactnumber'])) {
            $dbparams[4] = $params['contactnumber'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor mobile required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[5] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

//return $dbparams;

        $vendor = $this->MVendor->add_new_vendor($dbparams);
        if (!empty($vendor) && is_array($vendor) && $vendor['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $vendor['id']));
        } else {
            if (is_array($vendor)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $vendor['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function modify_vendor_status($params = NULL) {

        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[6] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $dbparams[7] = 0;
        if (isset($params['status'])) {
            $dbparams[8] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor Status is required', 'data' => FALSE);
        }

        $ven_status = $this->MVendor->update_vendor_data($dbparams);

        if (!empty($ven_status) && is_array($ven_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $ven_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }
  public function get_particularvendor($params = NULL) {       
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
          if (isset($params['vendorid']) && !empty($params['vendorid'])) {
            $dbparams[1] = $params['vendorid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor Id is required', 'data' => FALSE);
        }           
        
        $venodr_data = $this->MVendor->get_vendor_particular($dbparams);
        if (!empty($venodr_data) && is_array($venodr_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $venodr_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
     public function update_vendor($params = NULL) {
         $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
//        $dbparams[1] = 1;
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor Id is required', 'data' => FALSE);
        }
        if (isset($params['vendorname']) && !empty($params['vendorname'])) {
            $dbparams[2] = $params['vendorname'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor Name is required', 'data' => FALSE);
        }
        if (isset($params['address']) && !empty($params['address'])) {
            $dbparams[3] = $params['address'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor Address is required', 'data' => FALSE);
        }
        if (isset($params['contactnum']) && !empty($params['contactnum'])) {
            $dbparams[4] = $params['contactnum'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor contact number is required', 'data' => FALSE);
        }
        if (isset($params['vendoremail']) && !empty($params['vendoremail'])) {
            $dbparams[5] = $params['vendoremail'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vendor Email is required', 'data' => FALSE);
        }
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[6] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $dbparams[7] = 1;
        $dbparams[8] = 0;
        
        $spareparts_update_status = $this->MVendor->update_vendor_data($dbparams);
        if (!empty($spareparts_update_status) && is_array($spareparts_update_status) && isset($spareparts_update_status['ErrorStatus']) && $spareparts_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $spareparts_update_status);
        } else {
             if(isset($spareparts_update_status['ErrorMessage']) && !empty($spareparts_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $spareparts_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
}
