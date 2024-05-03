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
class Conductor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_conductor_data($dbparams)
    {
        $this->db->flush_cache();
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $details = $this->db->query("[docme_transport].[conductor_data_select] ?,?", $dbparams)->result_array();
            return $details;
        }
    }

    public function add_new_conductor($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $conductor_save = $this->db->query("[docme_transport].[conductor_save] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($conductor_save) && is_array($conductor_save)) {
                return $conductor_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Conductor Not Addedd');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Conductor Not Addedd');
        }
    }


    public function get_conductor_particular($dbparams)
    {
        $this->db->flush_cache();
        $map_details = $this->db->query("[docme_transport].[conductorparticular_select] ?,?", $dbparams)->result_array();
        return isset($map_details[0]) ? $map_details[0] : $map_details;
    }


    public function update_conductor_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $update_status = $this->db->query("[docme_transport].[conductor_update] ?,?,?,?,?,?,?", $dbparams)->result_array();
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
            $details = $this->db->query("[docme_transport].[select_empdata] ?,?", $dbparams)->result_array();
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
}
