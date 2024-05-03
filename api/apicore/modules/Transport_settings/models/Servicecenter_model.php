<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicecenter_model
 *
 * @author chandrajith.edsys
 */
class Servicecenter_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function get_servicecenter_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $servicecenter_details = $this->db->query("[docme_transport].[service_center_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $servicecenter_details = $this->db->query("[docme_transport].[service_center_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $servicecenter_details;
    }
    public function add_new_servicecenter($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $servicecenter_save= $this->db->query("[docme_transport].[service_center_save] ?,?,?,?,?,? ", $dbparams)->result_array();
//            dev_export($servicecenter_save);die;
            if (!empty($servicecenter_save) && is_array($servicecenter_save)) {
                return $servicecenter_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Service center Details not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'service center Details  not added. Please check the data and try again');
        }
    }

    public function update_servicecenter($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $servicecenterupdate = $this->db->query("[docme_transport].[servicecenter_update] ?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($servicecenterupdate) && is_array($servicecenterupdate)) {
                return $servicecenterupdate[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Service center details not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Service center details not updated. Please check the data and try again');
        }
    }
     public function get_servicecenter_particular($dbparams) {         
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[servicecenterparticular_select] ?,?", $dbparams)->result_array();
            
        return $map_details;
    }
    }
}
