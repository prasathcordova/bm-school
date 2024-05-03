<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fees_transport_controller
 *
 * @author chandrajith.edsys
 */
class Fees_transport_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Fees_transport_model', 'MFt');
    }
      public function save_pickuppoint_fees($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        
         
         if (isset($params['routeid']) && !empty($params['routeid'])) {
            $dbparams[1] = $params['routeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Id required', 'data' => FALSE);
        }
         
        if (isset($params['pick_fee_data']) && !empty($params['pick_fee_data'])) {
            $dbparams[2] = $params['pick_fee_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'pick_fee_data details are required', 'data' => FALSE);
        }
         if (isset($params['fees_entity']) && !empty($params['fees_entity'])) {
            $dbparams[3] = $params['fees_entity'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fees Entity details are required', 'data' => FALSE);
        }
         if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
         if (isset($params['acd_year']) && !empty($params['acd_year'])) {
            $dbparams[5] = $params['acd_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year required', 'data' => FALSE);
        }
        
        $fees_add_status = $this->MFt->add_fees_transport($dbparams);
//        dev_export($fees_add_status);die;
        if (!empty($fees_add_status) && is_array($fees_add_status) && $fees_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $fees_add_status['id']));
        } else {
            if (is_array($fees_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $fees_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
}
