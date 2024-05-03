<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sparestock_controller
 *
 * @author Chandrajith
 */
class Sparestock_controller extends MX_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Sparepartsstock_model', 'MSpart');
    }     
        public function get_parts_stockdata($params = NULL) {       
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
                
          if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }           
         
        $vendor_data = $this->MSpart->get_parts_stockdata($dbparams);
        if (!empty($vendor_data) && is_array($vendor_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vendor_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
