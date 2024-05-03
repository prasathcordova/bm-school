<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Statecity_controller
 *
 * @author rahul.shibukumar
 */
class Statecity_controller extends MX_Controller{
    public function __construct() {
        parent::__construct();
                $this->load->model('Statecity_model', 'MCState');

    }
     public function state_details($params=NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['state_id']) && !empty($params['state_id'])) {
            $dbparams[1] = $params['state_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country ID is required', 'data' => FALSE);
        }
      
        $state_details = $this->MCState->state_details_id($dbparams);
       if (!empty($state_details) && is_array($state_details)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $state_details);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
