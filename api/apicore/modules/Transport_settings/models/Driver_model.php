<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Spareparts_model
 *
 * @author chandrajith.edsys
 */
class Driver_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_driver_data($dbparams)
    {
        $this->db->flush_cache();
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $details = $this->db->query("[docme_transport].[driver_data_select] ?,?", $dbparams)->result_array();
            return $details;
        }
    }

    public function add_new_driver($dbparams)
    {
        // return $dbparams;
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $driver_save = $this->db->query("[docme_transport].[driver_save] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($driver_save) && is_array($driver_save)) {
                return $driver_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Driver Not Addedd');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Driver Not Addedd');
        }
    }


    public function get_driver_particular($dbparams)
    {
        $this->db->flush_cache();
        $map_details = $this->db->query("[docme_transport].[driverparticular_select] ?,?", $dbparams)->result_array();
        return isset($map_details[0]) ? $map_details[0] : $map_details;
    }


    public function update_driver_data($dbparams)
    {
        // return $dbparams;
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $update_status = $this->db->query("[docme_transport].[driver_update] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($update_status) && is_array($update_status)) {
                return $update_status[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Conductor not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Conductor not updated. Please check the data and try again');
        }
    }

    public function get_employee_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $details = $this->db->query("[docme_transport].[select_empdata_for_driver] ?,?", $dbparams)->result_array();
            return $details;
        }
    }

    public function get_select_employee($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_maintainlist = $this->db->query("[docme_transport].[get_select_emp_data] ?,?,?", $dbparams)->result_array();
            return $vehicle_maintainlist;
        }
    }

    public function get_vehicle_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_date = $this->db->query("[docme_transport].[get_vehicle_data] ?,?", $dbparams)->result_array();
            return $vehicle_date;
        }
    }
}
