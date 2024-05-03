<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Insurance_model
 *
 * @author chandrajith.edsys
 */
class Insurance_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_insurance_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $insurance_details = $this->db->query("[docme_transport].[insurance_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $insurance_details = $this->db->query("[docme_transport].[insurance_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $insurance_details;
    }
    public function add_new_insurance($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $insurance_save= $this->db->query("[docme_transport].[insurance_save] ?,?,?", $dbparams)->result_array();
            if (!empty($insurance_save) && is_array($insurance_save)) {
                return $insurance_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Insurance Details not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Insurance Details  not added. Please check the data and try again');
        }
    }

    public function update_insurance($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $insuranceupdate = $this->db->query("[docme_transport].[insurance_update] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($insuranceupdate) && is_array($insuranceupdate)) {
                return $insuranceupdate[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Insurance details not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Insurance details not updated. Please check the data and try again');
        }
    }
}
