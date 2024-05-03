<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transport_report_controller
 *
 * @author chandrajith.edsys
 */
class Transport_report_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transport_report_model', 'MTreport');
    }
    public function get_fuellog($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];


        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $dbparams[1] = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $dbparams[2] = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End Date required', 'data' => FALSE);
        }
        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[3] = $params['vehicle_id'];
        } else {
            $dbparams[3] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $fuellog_list = $this->MTreport->get_fuellog_details($dbparams);

        if (!empty($fuellog_list) && is_array($fuellog_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $fuellog_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_maintanance($params = NULL)
    {
        // return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $maintanance_list = $this->MTreport->get_maintanance($dbparams);
        if (!empty($maintanance_list) && is_array($maintanance_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $maintanance_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_maintainrpt($params = NULL)
    {
        // return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            $dbparams[1] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }
        if (isset($params['maintain_date']) && !empty($params['maintain_date'])) {
            $dbparams[2] = $params['maintain_date'];
        } else {
            $dbparams[2] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['serviceType']) && !empty($params['serviceType'])) {
            $dbparams[4] = $params['serviceType'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service Type is required', 'data' => FALSE);
        }


        $maintains_rpt_data = $this->MTreport->get_maintains_report($dbparams);
        if (!empty($maintains_rpt_data) && is_array($maintains_rpt_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $maintains_rpt_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_incidentsrpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['startdate']) && !empty($params['startdate'])) {
            $dbparams[1] = $params['startdate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date required', 'data' => FALSE);
        }
        if (isset($params['enddate']) && !empty($params['enddate'])) {
            $dbparams[2] = $params['enddate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End Date required', 'data' => FALSE);
        }
        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[3] = $params['vehicle_id'];
        } else {
            $dbparams[3] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $incidents_rpt_data = $this->MTreport->get_incidents_report($dbparams);
        if (!empty($incidents_rpt_data) && is_array($incidents_rpt_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $incidents_rpt_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_costreport($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['startdate']) && !empty($params['startdate'])) {
            $dbparams[1] = $params['startdate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date required', 'data' => FALSE);
        }
        if (isset($params['enddate']) && !empty($params['enddate'])) {
            $dbparams[2] = $params['enddate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End Date required', 'data' => FALSE);
        }

        if (isset($params['first_vehicle_id']) && !empty($params['first_vehicle_id'])) {
            $dbparams[3] = $params['first_vehicle_id'];
        } else {
            $dbparams[3] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }
        if (isset($params['second_vehicle_id']) && !empty($params['second_vehicle_id'])) {
            $dbparams[4] = $params['second_vehicle_id'];
        } else {
            $dbparams[4] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[5] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        // return $dbparams;

        $costwise_rpt_data = $this->MTreport->get_costwise_report($dbparams);
        if (!empty($costwise_rpt_data) && is_array($costwise_rpt_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $costwise_rpt_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_vehicle_expenditurerpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            $dbparams[1] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $vehrexpendtur_rpt_data = $this->MTreport->get_vehexpenditur_report($dbparams);
        if (!empty($vehrexpendtur_rpt_data) && is_array($vehrexpendtur_rpt_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehrexpendtur_rpt_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_vehicle_expenditure_summaryrpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            $dbparams[1] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $vehrexpendtur_summary_rpt_data = $this->MTreport->get_vehexpenditur_summary_report($dbparams);
        if (!empty($vehrexpendtur_summary_rpt_data) && is_array($vehrexpendtur_summary_rpt_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehrexpendtur_summary_rpt_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_fuelconsumption($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];


        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $dbparams[1] = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $dbparams[2] = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End Date required', 'data' => FALSE);
        }
        // if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
        //     $dbparams[3] = $params['vehicle_id'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        // }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        //return $dbparams;
        $fuellog_list = $this->MTreport->get_fuelconsumption_details($dbparams);

        if (!empty($fuellog_list) && is_array($fuellog_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $fuellog_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_vhicleincidentrpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];


        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $dbparams[1] = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $dbparams[2] = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End Date required', 'data' => FALSE);
        }
        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[3] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $fuellog_list = $this->MTreport->get_incidentvehicle_details($dbparams);

        if (!empty($fuellog_list) && is_array($fuellog_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $fuellog_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_maintenance_report($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];


        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $fuellog_list = $this->MTreport->get_maintenancevehicle_details($dbparams);

        if (!empty($fuellog_list) && is_array($fuellog_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $fuellog_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function report_lock_date($params)
    {
        //        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];


        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date required', 'data' => FALSE);
        }
        $lock_data = $this->MTreport->get_report_lock_date($dbparams);
        if (isset($lock_data) && !empty($lock_data) && is_array($lock_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $lock_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_spares_report($params)
    {
        //        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];


        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date required', 'data' => FALSE);
        }
        $spares_data = $this->MTreport->get_report_sparepart($dbparams);
        if (isset($spares_data) && !empty($spares_data) && is_array($spares_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $spares_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_trip_pick_rpt($params)
    {
        //        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];


        //         if (isset($params['acdyr']) && !empty($params['acdyr'])) {
        //            $dbparams[1] = $params['acdyr'];
        //        } else {
        //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year required', 'data' => FALSE);
        //        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution required', 'data' => FALSE);
        }
        $trip_stops_data = $this->MTreport->get_report_trip_stops($dbparams);
        if (isset($trip_stops_data) && !empty($trip_stops_data) && is_array($trip_stops_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $trip_stops_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_trip_stops_rpt($params)
    {
        //        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['tripid']) && !empty($params['tripid'])) {
            $dbparams[1] = $params['tripid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution required', 'data' => FALSE);
        }
        $trip_stops_data = $this->MTreport->get_report_trip_pickstops($dbparams);
        if (isset($trip_stops_data) && !empty($trip_stops_data) && is_array($trip_stops_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $trip_stops_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_route_trip_stops_rpt($params)
    {
        //        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['routeid']) && !empty($params['routeid'])) {
            $dbparams[1] = $params['routeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution required', 'data' => FALSE);
        }
        $trip_stops_data = $this->MTreport->get_report_route_trip_pickstops($dbparams);
        if (isset($trip_stops_data) && !empty($trip_stops_data) && is_array($trip_stops_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $trip_stops_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function getvehicle_route_trip_stops_rpt($params)
    {
        //        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicleid']) && !empty($params['vehicleid'])) {
            $dbparams[1] = $params['vehicleid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution required', 'data' => FALSE);
        }
        $trip_stops_data = $this->MTreport->get_rpt_vehicleroute_trip_pickstops($dbparams);
        if (isset($trip_stops_data) && !empty($trip_stops_data) && is_array($trip_stops_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $trip_stops_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_pickstopswise_student_rpt($params)
    {
        //        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        //         if (isset($params['routeid']) && !empty($params['routeid'])) {
        //            $dbparams[1] = $params['routeid'];
        //        } else {
        //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route required', 'data' => FALSE);
        //        }
        if (isset($params['tripid']) && !empty($params['tripid'])) {
            $dbparams[1] = $params['tripid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip required', 'data' => FALSE);
        }
        if (isset($params['pickstopid']) && !empty($params['pickstopid'])) {
            $dbparams[2] = $params['pickstopid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Stop required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution required', 'data' => FALSE);
        }
        $trip_stops_data = $this->MTreport->get_stopwise_stu_rpt($dbparams);
        if (isset($trip_stops_data) && !empty($trip_stops_data) && is_array($trip_stops_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $trip_stops_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_dropstopswise_student_rpt($params)
    {
        //        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        //         if (isset($params['routeid']) && !empty($params['routeid'])) {
        //            $dbparams[1] = $params['routeid'];
        //        } else {
        //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route required', 'data' => FALSE);
        //        }
        if (isset($params['tripid']) && !empty($params['tripid'])) {
            $dbparams[1] = $params['tripid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip required', 'data' => FALSE);
        }
        if (isset($params['dropstopid']) && !empty($params['dropstopid'])) {
            $dbparams[2] = $params['dropstopid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Stop required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution required', 'data' => FALSE);
        }
        $trip_stops_data = $this->MTreport->get_dropstopwise_stu_rpt($dbparams);
        if (isset($trip_stops_data) && !empty($trip_stops_data) && is_array($trip_stops_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $trip_stops_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_tripwise_student_rpt($params)
    {
        //        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        //         if (isset($params['routeid']) && !empty($params['routeid'])) {
        //            $dbparams[1] = $params['routeid'];
        //        } else {
        //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route required', 'data' => FALSE);
        //        }
        if (isset($params['tripid']) && !empty($params['tripid'])) {
            $dbparams[1] = $params['tripid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution required', 'data' => FALSE);
        }
        $trip_stops_data = $this->MTreport->get_tripwise_stu_rpt($dbparams);
        if (isset($trip_stops_data) && !empty($trip_stops_data) && is_array($trip_stops_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $trip_stops_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_routewise_student_rpt($params)
    {
        //        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['routeid']) && !empty($params['routeid'])) {
            $dbparams[1] = $params['routeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution required', 'data' => FALSE);
        }
        $trip_stops_data = $this->MTreport->get_routewise_stu_rpt($dbparams);
        if (isset($trip_stops_data) && !empty($trip_stops_data) && is_array($trip_stops_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $trip_stops_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_all_student_transport_data($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acd_year_id']) && !empty($params['acd_year_id'])) {
            $dbparams[1] = $params['acd_year_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst is required', 'data' => FALSE);
        }
        if (isset($params['query']) && !empty($params['query'])) {
            $dbparams[3] = $params['query'];
        } else {
            $dbparams[3] = '';
        }

        $data_list = $this->MTreport->get_all_student_transport_data($dbparams);

        if (!empty($data_list) && is_array($data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_maintain_summary_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['startdate']) && !empty($params['startdate'])) {
            $dbparams[1] = $params['startdate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date required', 'data' => FALSE);
        }
        if (isset($params['enddate']) && !empty($params['enddate'])) {
            $dbparams[2] = $params['enddate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End Date required', 'data' => FALSE);
        }

        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[3] = $params['vehicle_id'];
        } else {
            $dbparams[3] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $costwise_rpt_data = $this->MTreport->get_maintain_summary_report($dbparams);
        if (!empty($costwise_rpt_data) && is_array($costwise_rpt_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $costwise_rpt_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
