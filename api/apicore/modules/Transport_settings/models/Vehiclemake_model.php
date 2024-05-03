<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vehiclemake_model
 *
 * @author chandrajith.edsys
 */
class Vehiclemake_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_vehiclemake_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $vehicle_type = $this->db->query("[docme_transport].[make_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $vehicle_type = $this->db->query("[docme_transport].[make_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $vehicle_type;
    }
    public function add_new_vehiclemake($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_type_save = $this->db->query("[docme_transport].[make_save] ?,?", $dbparams)->result_array();
            if (!empty($vehicle_type_save) && is_array($vehicle_type_save)) {
                return $vehicle_type_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Make not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Make  not added. Please check the data and try again');
        }
    }

    public function update_vehiclemake($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_make_update = $this->db->query("[docme_transport].[vehiclemake_update] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_make_update) && is_array($vehicle_make_update)) {
                return $vehicle_make_update[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Make not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Make not updated. Please check the data and try again');
        }
    }

}
