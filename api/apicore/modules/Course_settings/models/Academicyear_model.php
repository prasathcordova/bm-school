<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Academicyear_model
 *
 * @author docme
 */
class Academicyear_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_Acdyear_details($apikey, $query)
    {
        $this->db->flush_cache();
        if ($query == 10) {
            $batch = $this->db->query("[settings].[Acd_year_select] ?,?,?", array(10, $apikey, $query))->result_array();
        } else if (strlen($query) > 0) {
            $batch = $this->db->query("[settings].[Acd_year_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $batch = $this->db->query("[settings].[Acd_year_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $batch;
    }
}
