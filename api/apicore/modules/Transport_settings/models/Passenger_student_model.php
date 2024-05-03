<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_student_model
 *
 * @author chandrajith.edsys
 */
class Passenger_student_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_trip_route_pickuppoints($dbparams)
    {
        $this->db->flush_cache();
        $this->db->flush_cache();
        if (is_array($dbparams)) {

            //            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[pickuppoint_select_allotment] ?,?,?", $dbparams)->result_array();
            return $map_details;
        }
    }

    public function get_trip_pickuppoints($dbparams)
    {
        $this->db->flush_cache();
        $this->db->flush_cache();
        if (is_array($dbparams)) {

            //            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[trip_select_passenger_allotment] ?,?,?", $dbparams)->result_array();
            return $map_details;
        }
    }
    public function get_vehicle_driver_cleaner_data($dbparams)
    {
        $this->db->flush_cache();
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $staff_details = $this->db->query("[docme_transport].[trip_vehicle_staff] ?,?,?,?", $dbparams)->result_array();
            return $staff_details;
        }
    }
    public function get_dropvehicle_driver_cleaner_data($dbparams)
    {
        $this->db->flush_cache();
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $staff_details = $this->db->query("[docme_transport].[trip_dropvehicle_staff] ?,?,?,?", $dbparams)->result_array();
            return $staff_details;
        }
    }
    public function get_studentsearch($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_transport].[studentfilter_select] ?,?,?", $dbparams)->result_array();
        //        dev_export($studentdata);die;
        return $studentdata;
    }

    public function get_student_travel_transport($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_transport].[get_student_travel_transport] ?,?,?", $dbparams)->result_array();
        //        dev_export($studentdata);die;
        return $studentdata;
    }
    public function get_all_student_allocation_details($dbparams)
    {
        $this->db->flush_cache();
        $params = procedure_param_string($dbparams);
        $studentdata = $this->db->query("[docme_transport].[get_all_students_allocation_data] $params", $dbparams)->result_array();
        //        dev_export($studentdata);die;
        return $studentdata;
    }

    public function studentadvance_search($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_transport].[advanced_student_search] ?,?,?,?,?,?,?", $dbparams)->result_array();
        //        dev_export($studentdata);die;
        return $studentdata;
    }

    public function save_student_transport_allotment($apikey, $student_allotment_data_final, $inst_id, $acd_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_transport].[passenger_student_allotment_save] ?,?,?,?", array($apikey, $student_allotment_data_final, $inst_id, $acd_id))->result_array();
        return $data;
    }
    public function save_student_transport_allotment_pick($apikey, $student_allotment_data_final, $inst_id, $acd_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_transport].[passenger_student_allotment_pickonly_save] ?,?,?,?", array($apikey, $student_allotment_data_final, $inst_id, $acd_id))->result_array();
        return $data;
    }
    public function save_student_transport_allotment_drop($apikey, $student_allotment_data_final, $inst_id, $acd_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_transport].[passenger_student_allotment__dropsave] ?,?,?,?", array($apikey, $student_allotment_data_final, $inst_id, $acd_id))->result_array();
        return $data;
    }
    public function save_rims_response($dbparams)
    {
        $this->db->flush_cache();
        $params = procedure_param_string($dbparams);
        $data = $this->db->query("[rims_integration].[save_rims_response] $params", $dbparams)->result_array();
        return $data;
    }

    public function get_student_travel_history($dbparams)
    {
        $this->db->flush_cache();
        $params = procedure_param_string($dbparams);
        $studentdata = $this->db->query("[docme_transport].[get_student_travel_transport_history] $params ", $dbparams)->result_array();
        return $studentdata;
    }
}
