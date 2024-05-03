<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transport_report_model
 *
 * @author chandrajith.edsys
 */
class Transport_report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_fuellog_details($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_fuel_log = $this->db->query("[docme_transport].[fuellogvehiclewise_report] ?,?,?,?,?", $dbparams)->result_array();
            return $vehicle_fuel_log;
        }
    }

    public function get_maintanance($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_maintainlist = $this->db->query("[docme_transport].[get_maintanance_list] ?,?,?", $dbparams)->result_array();
            return $vehicle_maintainlist;
        }
    }

    public function get_maintains_report($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_maintainrpt = $this->db->query("[docme_transport].[get_maintanance_report] ?,?,?,?,?", $dbparams)->result_array();
            return $vehicle_maintainrpt;
        }
    }

    public function get_incidents_report($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_incidentsreport = $this->db->query("[docme_transport].[get_incidents_report] ?,?,?,?,?", $dbparams)->result_array();
            return $vehicle_incidentsreport;
        }
    }

    public function get_costwise_report($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_costreport = $this->db->query("[docme_transport].[get_costwise_report] ?,?,?,?,?,?", $dbparams)->result_array();
            return $vehicle_costreport;
        }
    }

    public function get_vehexpenditur_report($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_expditurrpt = $this->db->query("[docme_transport].[get_vehexpenditur_report] ?,?,?", $dbparams)->result_array();
            return $vehicle_expditurrpt;
        }
    }

    public function get_vehexpenditur_summary_report($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_expditur_summary_rpt = $this->db->query("[docme_transport].[get_vehexpenditur_summary_report] ?,?,?", $dbparams)->result_array();
            return $vehicle_expditur_summary_rpt;
        }
    }

    public function get_incidentvehicle_details($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_fuel_log = $this->db->query("[docme_transport].[vehicleincidentrpt_select] ?,?,?,?,?", $dbparams)->result_array();
            return $vehicle_fuel_log;
        }
    }
    public function get_fuelconsumption_details($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_fuel_log = $this->db->query("[docme_transport].[fuelconsumptionrpt_select] ?,?,?,?", $dbparams)->result_array();
            return $vehicle_fuel_log;
        }
    }
    public function get_maintenancevehicle_details($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_fuel_log = $this->db->query("[docme_transport].[servicemaintenancerpt_select] ?,?,?", $dbparams)->result_array();
            return $vehicle_fuel_log;
        }
    }
    public function get_report_lock_date($dbparams)
    {
        $this->db->flush_cache();
        $lock_date = $this->db->query("[docme_transport].[transport_report_lock_date] ?,?", $dbparams)->result_array();
        return $lock_date;
    }
    public function get_report_sparepart($dbparams)
    {
        $this->db->flush_cache();
        $lock_date = $this->db->query("[docme_transport].[vehiclewisesparepartsreport_select] ?,?,?", $dbparams)->result_array();
        return $lock_date;
    }
    public function get_report_trip_stops($dbparams)
    {
        $this->db->flush_cache();
        $rpt_data = $this->db->query("[docme_transport].[tripPickuppoint_rpt] ?,?", $dbparams)->result_array();
        return $rpt_data;
    }
    public function get_report_trip_pickstops($dbparams)
    {
        $this->db->flush_cache();
        $rpt_data = $this->db->query("[docme_transport].[tripPickupstoppoint_rpt] ?,?,?", $dbparams)->result_array();
        return $rpt_data;
    }
    public function get_report_route_trip_pickstops($dbparams)
    {
        $this->db->flush_cache();
        $rpt_data = $this->db->query("[docme_transport].[triproutePickupstoppoint_rpt] ?,?,?", $dbparams)->result_array();
        return $rpt_data;
    }
    public function get_rpt_vehicleroute_trip_pickstops($dbparams)
    {
        $this->db->flush_cache();
        $rpt_data = $this->db->query("[docme_transport].[vehicle_routetrip_stops_rpt] ?,?,?", $dbparams)->result_array();
        return $rpt_data;
    }
    public function get_stopwise_stu_rpt($dbparams)
    {
        $this->db->flush_cache();
        $rpt_data = $this->db->query("[docme_transport].[pickuppointwise_student_rpt] ?,?,?,?", $dbparams)->result_array();
        return $rpt_data;
    }
    public function get_dropstopwise_stu_rpt($dbparams)
    {
        $this->db->flush_cache();
        $rpt_data = $this->db->query("[docme_transport].[droppointwise_student_rpt] ?,?,?,?", $dbparams)->result_array();
        return $rpt_data;
    }
    public function get_tripwise_stu_rpt($dbparams)
    {
        $this->db->flush_cache();
        $rpt_data = $this->db->query("[docme_transport].[tripwise_student_rpt] ?,?,?", $dbparams)->result_array();
        return $rpt_data;
    }
    public function get_routewise_stu_rpt($dbparams)
    {
        $this->db->flush_cache();
        $rpt_data = $this->db->query("[docme_transport].[routewise_student_rpt] ?,?,?", $dbparams)->result_array();
        return $rpt_data;
    }
    public function get_all_student_transport_data($dbparams)
    {
        $this->db->flush_cache();
        $param_string = procedure_param_string($dbparams);
        $rpt_data = $this->db->query("[docme_transport].[get_all_students_allocation_data] $param_string", $dbparams)->result_array();
        return $rpt_data;
    }

    public function get_maintain_summary_report($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_costreport = $this->db->query("[docme_transport].[get_maintain_summary_report] ?,?,?,?,?", $dbparams)->result_array();
            return $vehicle_costreport;
        }
    }
}
