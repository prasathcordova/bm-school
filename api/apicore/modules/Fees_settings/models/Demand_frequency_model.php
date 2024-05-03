<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Feetype_model
 *
 * @author chandrajith.edsys
 */
class Demand_frequency_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_demand_freq_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $feetype = $this->db->query("[docme_fees].[demand_frequency_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $feetype = $this->db->query("[docme_fees].[demand_frequency_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $feetype;
    }

    public function add_new_demand_freq($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $feetype = $this->db->query("[docme_fees].[demand_frequency_Save] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($feetype) && is_array($feetype)) {
                return $feetype[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Demand frequency not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Demand frequency not added. Please check the data and try again');
        }
    }

    public function update_demand_frequency_data($dbparams) {
        $this->db->flush_cache();

        if (is_array($dbparams)) {
            $feeetype = $this->db->query("[docme_fees].[demand_frequency_update] ?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($feeetype) && is_array($feeetype)) {
                return $feeetype[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Demand frequency not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Demand frequency not updated. Please check the data and try again');
        }
    }

}