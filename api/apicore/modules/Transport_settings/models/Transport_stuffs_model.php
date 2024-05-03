<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transport_stuffs_model
 *
 * @author Chandrajith
 */
class Transport_stuffs_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_trip_details($dbparams) {
        $this->db->flush_cache();
        $rpt_data = $this->db->query("[docme_transport].[routewise_trip_select] ?,?,?", $dbparams)->result_array();
        return $rpt_data;
    }
    public function get_stops_details($dbparams) {
        $this->db->flush_cache();
        $rpt_data = $this->db->query("[docme_transport].[route_trip_stop_stuf] ?,?,?", $dbparams)->result_array();
        return $rpt_data;
    }
    
    //get tripname by vinoth @10-06-2019 11:34
     public function get_vehtrip_details($dbparams) {
        $this->db->flush_cache();
        $rpt_data = $this->db->query("[docme_transport].[vehicle_tripname] ?,?,?", $dbparams)->result_array();
        return $rpt_data;
    }
}
