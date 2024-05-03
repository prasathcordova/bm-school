<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Spareparts_stock_model
 *
 * @author Chandrajith
 */
class Spareparts_stock_model extends CI_model {
      public function __construct() {
        parent::__construct();
    }
     public function get_spares_stock_details($inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $spareparts_data = transport_data_with_param_with_urlencode(array('action' => 'get_spareparts_stock','inst_id' => $inst_id), $apikey);
       
        if (isset($spareparts_data) && !empty($spareparts_data) && is_array($spareparts_data)) {
            return $spareparts_data['data'];
        } else {
            if (isset($spareparts_data['message']) && !empty($spareparts_data['message']) && is_array($spareparts_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $spareparts_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $spareparts_data,
                    'data' => FALSE
                );
            }
        }
    }
}
