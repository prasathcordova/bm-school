<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Service_type_model
 *
 * @author chandrajith.edsys
 */
class Service_type_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function get_vehicleservice_types($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_servicetypes = $this->db->query("[docme_transport].[servicetype_select] ?,?", $dbparams)->result_array();
        
        return $vehicle_servicetypes;
    }
    }
     public function update_servicetype_data($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $veh_status = $this->db->query("[docme_transport].[servicetype_update] ?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($veh_status) && is_array($veh_status)) {
                return $veh_status[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Service type not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Service type not updated. Please check the data and try again');
        }
    }
     public function get_servicetype_particular($dbparams) {         
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[servicetypeparticular_select] ?,?", $dbparams)->result_array();
            
        return $map_details;
    }
    }
}
