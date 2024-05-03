<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fees_transport_model
 *
 * @author chandrajith.edsys
 */
class Fees_transport_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
     public function add_fees_transport($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $pickuppointfees_save = $this->db->query("[docme_transport].[pickuppoint_fees_data_save] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($pickuppointfees_save) && is_array($pickuppointfees_save)) {
                return $pickuppointfees_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Fees not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Fees not added. Please check the data and try again');
        }
    }
}
