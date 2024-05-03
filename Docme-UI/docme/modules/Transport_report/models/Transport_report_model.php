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
    public function get_all_vehicle_details($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_data = transport_data_with_param_with_urlencode(array('action' => 'get_vehiclereg', 'inst_id' => $inst_id, 'mode' => 'strict', 'status' => 1), $apikey);

        if (isset($vehicle_data) && !empty($vehicle_data) && is_array($vehicle_data)) {
            return $vehicle_data['data'];
        } else {
            if (isset($vehicle_data['message']) && !empty($vehicle_data['message']) && is_array($vehicle_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function report_lock_date()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $report_lock_date = transport_data_with_param_with_urlencode(array('action' => 'get_transportlockdate', 'inst_id' => $inst_id), $apikey);
        //        $route = transport_data_with_param_with_urlencode(array('action' => 'get_route', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
        if (is_array($report_lock_date) && isset($report_lock_date['status']) && !empty($report_lock_date['status']) && $report_lock_date['status'] == 1 && isset($report_lock_date['data'])) {
            return $report_lock_date['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_lock_date,
                'data' => FALSE
            );
        }
    }

    public function get_maintancelist($veh_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $route_maintancelist = transport_data_with_param_with_urlencode(array('action' => 'get_maintanance', 'vehicle_id' => $veh_id, 'inst_id' => $inst_id, 'mode' => 'strict', 'status' => 1), $apikey);
        if (isset($route_maintancelist) && !empty($route_maintancelist) && is_array($route_maintancelist)) {
            return $route_maintancelist['data'];
        } else {
            if (isset($route_maintancelist['message']) && !empty($route_maintancelist['message']) && is_array($route_maintancelist)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $route_maintancelist['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $route_maintancelist,
                    'data' => FALSE
                );
            }
        }
    }


    public function get_all_vehicle_route_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $route = transport_data_with_param_with_urlencode(array('action' => 'get_route', 'inst_id' => $inst_id, 'mode' => 'strict', 'status' => 1), $apikey);

        if (isset($route) && !empty($route) && is_array($route)) {
            return $route['data'];
        } else {
            if (isset($route['message']) && !empty($route['message']) && is_array($route)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $route['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $route,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_stream()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $stream_data = transport_data_with_param_with_urlencode(array('action' => 'get_stream', 'status' => 1, 'inst_id' => $inst_id), $apikey);
        if (is_array($stream_data)) {
            return $stream_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $stream_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_class()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $class_data = transport_data_with_param_with_urlencode(array('action' => 'get_class', 'status' => 1, 'inst_id' => $inst_id), $apikey);
        if (is_array($class_data)) {
            return $class_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $class_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_acadyr()
    {
        $apikey = $this->session->userdata('API-Key');
        $acd_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_acdyear',
            'status' => 1,
            'mode' => 'strict',
        ), $apikey);
        if (is_array($acd_data)) {
            return $acd_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acd_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_batch($acd_year)
    {
        $apikey = $this->session->userdata('API-Key');
        $batch = transport_data_with_param_with_urlencode(array('action' => 'get_batch', 'status' => 1, 'Acd_Year' => $acd_year), $apikey);
        if (is_array($batch)) {
            return $batch['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch,
                'data' => FALSE
            );
        }
    }


    public function get_maintain_report($inst_id, $vehicle_id, $maintain_date,$serviceType)
    {

        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'get_maintainrpt',
            'vehicle_id' => $vehicle_id,
            'maintain_date' => $maintain_date,
            'inst_id' => $inst_id,
            'serviceType' => $serviceType
        );

        $report_maintains = transport_data_with_param_with_urlencode($data_prep, $apikey);
        // dev_export($report_maintains);
        // return;
        if (is_array($report_maintains) && isset($report_maintains['status']) && !empty($report_maintains['status']) && $report_maintains['status'] == 1 && isset($report_maintains['data'])) {
            return $report_maintains['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_maintains,
                'data' => FALSE
            );
        }
    }

    public function get_incidents_report($startdate, $enddate, $inst_id, $vehicle_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'get_incidents_rpt',
            'startdate' => $startdate,
            'enddate' => $enddate,
            'vehicle_id' => $vehicle_id,
            'inst_id' => $inst_id
        );

        $report_incidents = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_incidents) && isset($report_incidents['status']) && !empty($report_incidents['status']) && $report_incidents['status'] == 1 && isset($report_incidents['data'])) {
            return $report_incidents['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_incidents,
                'data' => FALSE
            );
        }
    }

    public function get_cost_report($startdate, $enddate, $inst_id, $first_vehicle_id, $seconde_vehicle_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'get_costrpt',
            'startdate' => $startdate,
            'enddate' => $enddate,
            'first_vehicle_id' => $first_vehicle_id,
            'second_vehicle_id' => $seconde_vehicle_id,
            'inst_id' => $inst_id
        );

        $report_costwise = transport_data_with_param_with_urlencode($data_prep, $apikey);
        // dev_export($report_costwise);
        // return;
        if (is_array($report_costwise) && isset($report_costwise['status']) && !empty($report_costwise['status']) && $report_costwise['status'] == 1 && isset($report_costwise['data'])) {
            return $report_costwise['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_costwise,
                'data' => FALSE
            );
        }
    }

    public function get_vehicle_expenditure_report($inst_id, $vehicle_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'get_vehicle_expenditure',
            'vehicle_id' => $vehicle_id,
            'inst_id' => $inst_id
        );
        $report_vehexpenditure = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_vehexpenditure) && isset($report_vehexpenditure['status']) && !empty($report_vehexpenditure['status']) && $report_vehexpenditure['status'] == 1 && isset($report_vehexpenditure['data'])) {
            return $report_vehexpenditure['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_vehexpenditure,
                'data' => FALSE
            );
        }
    }

    public function get_vehicle_expendituresummary_report($inst_id, $vehicle_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'get_vehicle_expenditure_summary',
            'vehicle_id' => $vehicle_id,
            'inst_id' => $inst_id
        );
        $report_vehexpenditure_summary = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_vehexpenditure_summary) && isset($report_vehexpenditure_summary['status']) && !empty($report_vehexpenditure_summary['status']) && $report_vehexpenditure_summary['status'] == 1 && isset($report_vehexpenditure_summary['data'])) {
            return $report_vehexpenditure_summary['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_vehexpenditure_summary,
                'data' => FALSE
            );
        }
    }
    public function get_fuel_log_report($startdate, $enddate, $vehicle_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'get_fuellog',
            'vehicle_id' => $vehicle_id,
            'start_date' => $startdate,
            'end_date' => $enddate,
            'inst_id' => $inst_id
        );
        $report_lock_date = transport_data_with_param_with_urlencode($data_prep, $apikey);

        if (is_array($report_lock_date) && isset($report_lock_date['status']) && !empty($report_lock_date['status']) && $report_lock_date['status'] == 1 && isset($report_lock_date['data'])) {
            return $report_lock_date['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_lock_date,
                'data' => FALSE
            );
        }
    }

    public function get_fuel_consumption_report($startdate, $enddate, $inst_id)
    { // $vehicle_id,
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'get_fuelconsumption',
            //'vehicle_id' => $vehicle_id,
            'start_date' => $startdate,
            'end_date' => $enddate,
            'inst_id' => $inst_id
        );
        $report_lock_date = transport_data_with_param_with_urlencode($data_prep, $apikey);

        if (is_array($report_lock_date) && isset($report_lock_date['status']) && !empty($report_lock_date['status']) && $report_lock_date['status'] == 1 && isset($report_lock_date['data'])) {
            return $report_lock_date['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_lock_date,
                'data' => FALSE
            );
        }
    }

    public function get_rte_trip_wise_data($tripid, $inst_id)
    {

        $apikey = $this->session->userdata('API-Key');
        $studentdata = transport_data_with_param_with_urlencode(array('action' => 'get_tripwise_student_rpt', 'tripid' => $tripid, 'inst_id' => $inst_id), $apikey);

        if (isset($studentdata) && !empty($studentdata) && is_array($studentdata)) {
            return $studentdata['data'];
        } else {
            if (isset($studentdata['message']) && !empty($studentdata['message']) && is_array($studentdata)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $studentdata['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $studentdata,
                    'data' => FALSE
                );
            }
        }
    }

    //get trip name by vinoth @ 10-06-2019 11:35
    public function get_trip($vehicle_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $trip = transport_data_with_param_with_urlencode(array('action' => 'vehiclewise_tripname', 'vehicle_id' => $vehicle_id, 'inst_id' => $inst_id), $apikey);

        if (isset($trip) && !empty($trip) && is_array($trip)) {
            return $trip['data'];
        } else {
            if (isset($trip['message']) && !empty($trip['message']) && is_array($trip)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_stopsdetails($trip_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $trip = transport_data_with_param_with_urlencode(array('action' => 'routewise_trip_stops', 'tripid' => $trip_id, 'inst_id' => $inst_id), $apikey);
        if (isset($trip) && !empty($trip) && is_array($trip)) {
            return $trip['data'];
        } else {
            if (isset($trip['message']) && !empty($trip['message']) && is_array($trip)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_rte_trip_pickstop_data($tripid, $pickstopid, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $studentdata = transport_data_with_param_with_urlencode(array('action' => 'get_pickstopswise_student_rpt', 'tripid' => $tripid, "pickstopid" => $pickstopid, 'inst_id' => $inst_id), $apikey);

        if (isset($studentdata) && !empty($studentdata) && is_array($studentdata)) {
            return $studentdata['data'];
        } else {
            if (isset($studentdata['message']) && !empty($studentdata['message']) && is_array($studentdata)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $studentdata['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $studentdata,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_rte_trip_dropstop_data($tripid, $dropstopid, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $studentdata = transport_data_with_param_with_urlencode(array('action' => 'get_dropstopswise_student_rpt', 'tripid' => $tripid, "dropstopid" => $dropstopid, 'inst_id' => $inst_id), $apikey);

        if (isset($studentdata) && !empty($studentdata) && is_array($studentdata)) {
            return $studentdata['data'];
        } else {
            if (isset($studentdata['message']) && !empty($studentdata['message']) && is_array($studentdata)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $studentdata['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $studentdata,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_student_transport_data($data_prep)
    { // $vehicle_id,
        $apikey = $this->session->userdata('API-Key');
        $report_lock_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_lock_data) && isset($report_lock_data['status']) && !empty($report_lock_data['status']) && $report_lock_data['status'] == 1 && isset($report_lock_data['data'])) {
            return $report_lock_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_lock_data,
                'data' => FALSE
            );
        }
    }


    public function get_maintanance_summary_report($startdate, $enddate, $inst_id, $vehicle_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'get_maintain_summary_rpt',
            'startdate' => $startdate,
            'enddate' => $enddate,
            'vehicle_id' => $vehicle_id,
            'inst_id' => $inst_id
        );
        $report_costwise = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_costwise) && isset($report_costwise['status']) && !empty($report_costwise['status']) && $report_costwise['status'] == 1 && isset($report_costwise['data'])) {
            return $report_costwise['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_costwise,
                'data' => FALSE
            );
        }
    }
}
