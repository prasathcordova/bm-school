<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Direct_purchase_model
 *
 * @author Chandrajith
 */
class Direct_purchase_model extends CI_Model {
     public function __construct() {
        parent::__construct();
    }
     public function get_purchse_data($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $details = $this->db->query("[docme_transport].[purchase_select] ?,?,?", $dbparams)->result_array();
        return $details;
    }
    }
     public function add_new_directpurchase($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $directpurchase_save = $this->db->query("[docme_transport].[sparepartspurchase_save] ?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($directpurchase_save) && is_array($directpurchase_save)) {
                return $directpurchase_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vendor not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vendor not added. Please check the data and try again');
        }
    }
    
    public function update_purchase_data($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $veh_status = $this->db->query("[docme_transport].[directpurchase_disable] ?,?,?,?,?,?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($veh_status) && is_array($veh_status)) {
                return $veh_status[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle not updated. Please check the data and try again');
        }
    }
}
