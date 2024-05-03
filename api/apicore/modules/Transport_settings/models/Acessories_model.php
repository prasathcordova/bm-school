<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acessories_model
 *
 * @author chandrajith.edsys
 */
class Acessories_model extends CI_Model {
      public function __construct() {
        parent::__construct();
    }
     public function get_acessories_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $vehicle_type = $this->db->query("[docme_transport].[acessories_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $vehicle_type = $this->db->query("[docme_transport].[acessories_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $vehicle_type;
    }
    public function add_new_spareparts($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $spareparts_save = $this->db->query("[docme_transport].[sparepartsdetails_Save] ?,?,?", $dbparams)->result_array();
            if (!empty($spareparts_save) && is_array($spareparts_save)) {
                return $spareparts_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Fuel Log Details not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Fuel Log Details not added. Please check the data and try again');
        }
    }
}
