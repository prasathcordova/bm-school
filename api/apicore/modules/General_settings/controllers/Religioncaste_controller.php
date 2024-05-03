<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Religioncaste_controller
 *
 * @author rahul.shibukumar
 */
class Religioncaste_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Religioncaste_model', 'MRCaste');
    }
      public function caste_details($params=NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['religion_id']) && !empty($params['religion_id'])) {
            $dbparams[1] = $params['religion_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Religion ID is required', 'data' => FALSE);
        }
      
        $caste_details = $this->MRCaste->caste_details_id($dbparams);
       if (!empty($caste_details) && is_array($caste_details)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $caste_details);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

}
