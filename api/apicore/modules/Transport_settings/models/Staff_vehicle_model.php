<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Staff_vehicle_model
 *
 * @author chandrajith.edsys
 */
class Staff_vehicle_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
     public function get_drivers($dbparams) {
        $this->db->flush_cache();
       $deiver_staff = $this->db->query("[docme_transport].[vehicledriverstaff_select] ?,?", $dbparams)->result_array();       
        return $deiver_staff;
    }
     public function get_cleaners($dbparams) {
        $this->db->flush_cache();
       $deiver_staff = $this->db->query("[docme_transport].[vehiclestaff_select] ?,?", $dbparams)->result_array();       
        return $deiver_staff;
    }
     public function get_data_staff_vehicle($dbparams) {
        $this->db->flush_cache();
       $deiver_staff = $this->db->query("[docme_transport].[vehicle_staffs_select] ?,?,?,?", $dbparams)->result_array();       
        return $deiver_staff;
    }
    public function add_new_staff($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_inc_save = $this->db->query("[docme_transport].[vehiclestaffdetails_Save] ?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_inc_save) && is_array($vehicle_inc_save)) {
                return $vehicle_inc_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Incidents not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Incidents not added. Please check the data and try again');
        }
    }
     public function update_veh_staffdata($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $veh_status = $this->db->query("[docme_transport].[vehiclestaff_disable] ?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($veh_status) && is_array($veh_status)) {
                return $veh_status[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle staff not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle staff not updated. Please check the data and try again');
        }
    }
}
