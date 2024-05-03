<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_student_model
 *
 * @author AHB
 */
class Pickuppoint_fees_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_pickuppoint_fees($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $all_pickuppoint_fees_details = $this->db->query("[docme_transport].[get_all_pickuppoint_fees] $param_string", $dbparams)->result_array();
            return $all_pickuppoint_fees_details;
        }
    }

    public function get_pickuppoint_all_fees_details($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $pickuppoint_all_fees__details = $this->db->query("[docme_transport].[get_pickuppoint_all_fees_details] $param_string", $dbparams)->result_array();
            return $pickuppoint_all_fees__details;
        }
    }

    public function save_pickuppoint_fees_data($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $pickuppoint_all_fees__details = $this->db->query("[docme_transport].[save_pickuppoint_fees_data] $param_string", $dbparams)->result_array();
            return $pickuppoint_all_fees__details;
        }
    }

    public function get_pickuppoint_student_details($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $pickuppoint_student_details = $this->db->query("[docme_transport].[get_pickuppoint_student_details] $param_string", $dbparams)->result_array();
            return $pickuppoint_student_details;
        }
    }
}
