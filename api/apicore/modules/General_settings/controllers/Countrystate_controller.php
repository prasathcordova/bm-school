<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Countrystate_controller
 *
 * @author rahul.shibukumar
 */
class Countrystate_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Countrystate_model', 'MSCountry');
    }
 public function country_details($params=NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['country_id']) && !empty($params['country_id'])) {
            $dbparams[1] = $params['country_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country ID is required', 'data' => FALSE);
        }
      
        $country_details = $this->MSCountry->country_details_id($dbparams);
       if (!empty($country_details) && is_array($country_details)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $country_details);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
