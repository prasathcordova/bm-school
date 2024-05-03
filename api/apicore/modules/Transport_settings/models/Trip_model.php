<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trip_model
 *
 * @author chandrajith.edsys
 */
class Trip_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_vehicletrip($apikey, $query, $offset_string = NULL)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $vehicle_trip = $this->db->query("[docme_transport].[trip_select] ?,?,?,?", array(0, $apikey, $query, $offset_string))->result_array();
        } else {
            $vehicle_trip = $this->db->query("[docme_transport].[trip_select] ?,?,?,?", array(1, $apikey, NULL, $offset_string))->result_array();
        }
        return $vehicle_trip;
    }

    public function get_trip_all_details($dbparams)
    {
        $this->db->flush_cache();
        $tripdata = $this->db->query("[docme_transport].[trip_select_all_byid] ?,?,?", $dbparams)->result_array();
        return $tripdata;
    }

    public function get_vehicletrip_allotment($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_tripdata = $this->db->query("[docme_transport].[trip_select_allotment] ?,?,?", $dbparams)->result_array();
            return $vehicle_tripdata;
        }
    }
    public function add_new_trip($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $trip_save = $this->db->query("[docme_transport].[trip_Save] ?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($trip_save) && is_array($trip_save)) {
                return $trip_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Trip not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Trip not added. Please check the data and try again');
        }
    }

    public function add_new_trip_pickpoint_relation($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $trip_pickup_relation_save = $this->db->query("[docme_transport].[trip_pickpoint_relation_save] ?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($trip_pickup_relation_save) && is_array($trip_pickup_relation_save)) {
                return $trip_pickup_relation_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Trip not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Trip not added. Please check the data and try again');
        }
    }

    public function update_trip($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $trip_update_data = $this->db->query("[docme_transport].[trip_update] ?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($trip_update_data) && is_array($trip_update_data)) {
                return $trip_update_data[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Trip Status not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Trip Status not updated. Please check the data and try again');
        }
    }

    public function get_trip_pickuppoint_relation_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $trip_pickuppoint_relation_data = $this->db->query("[docme_transport].[Trip_pickuppoint_relation_get] ?,?,?,?", $dbparams)->result_array();

            if (!empty($trip_pickuppoint_relation_data) && is_array($trip_pickuppoint_relation_data)) {
                return $trip_pickuppoint_relation_data;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'No Relations Found. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'No Relations Found. Please check the data and try again');
        }
    }

    public function update_student_status($dbparams)
    {

        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $student_update_data = $this->db->query("[docme_transport].[update_student_daily_status] ?,?,?,?,?,?,?,?,?", $dbparams)->result_array();

            if (!empty($student_update_data) && is_array($student_update_data)) {
                return $student_update_data;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'No Relations Found. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'No Relations Found. Please check the data and try again');
        }
    }

    public function get_trip_pickups($dbparams)
    {
        // return $dbparams;
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $get_trip_pickuppoint = $this->db->query("[docme_transport].[get_trip_pickuppoints] ?,?,?", $dbparams)->result_array();

            if (!empty($get_trip_pickuppoint) && is_array($get_trip_pickuppoint)) {
                return $get_trip_pickuppoint;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'No Relations Found. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'No Relations Found. Please check the data and try again');
        }
    }

    public function get_picked_students_list($dbparams)
    {

        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $params = procedure_param_string($dbparams);
            $picked_students_list = $this->db->query("[docme_transport].[get_picked_students_list] $params", $dbparams)->result_array();

            if (!empty($picked_students_list) && is_array($picked_students_list)) {
                return $picked_students_list;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'No Relations Found. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'No Relations Found. Please check the data and try again');
        }
    }

    public function update_student_boarded_status($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $params = procedure_param_string($dbparams);
            $updated_students_list = $this->db->query("[docme_transport].[update_student_boarded_status] $params", $dbparams)->result_array();

            if (!empty($updated_students_list) && is_array($updated_students_list)) {
                return $updated_students_list;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'No Relations Found. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'No Relations Found. Please check the data and try again');
        }
    }
}
