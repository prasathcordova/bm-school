<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vendor_model
 *
 * @author Chandrajith
 */
class Vendor_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
     public function get_vendor_data($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $details = $this->db->query("[docme_transport].[vendor_select] ?,?", $dbparams)->result_array();
        return $details;
    }
    }
     public function add_new_vendor($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vendor_save = $this->db->query("[docme_transport].[vendor_save] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($vendor_save) && is_array($vendor_save)) {
                return $vendor_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vendor not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vendor not added. Please check the data and try again');
        }
    }
    public function update_vendor_data($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $veh_status = $this->db->query("[docme_transport].[vendor_update] ?,?,?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($veh_status) && is_array($veh_status)) {
                return $veh_status[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle not updated. Please check the data and try again');
        }
    }
     public function get_vendor_particular($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[vendorparticular_select] ?,?", $dbparams)->result_array();
        return $map_details;
    }
    }
}
