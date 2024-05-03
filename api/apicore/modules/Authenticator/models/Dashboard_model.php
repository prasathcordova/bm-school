<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboard_model
 *
 * @author rahul.shibukumar
 */
class Dashboard_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_stundent_details($apikey)
    {
        $this->db->flush_cache();
        $caste = $this->db->query("[settings].[count_students] ?", $apikey)->result_array();
        return $caste;
    }

    public function get_reg_count($apikey)
    {
        $this->db->flush_cache();
        $caste = $this->db->query("[docme_registration].[count_reg_status] ?", $apikey)->result_array();
        return $caste;
    }
    public function get_school_dashboard_details($apikey, $inst_id)
    {
        $this->db->flush_cache();
        $school_dboard = $this->db->query("[dbo].[get_school_dashboard_details] ?,?", array($apikey, $inst_id))->result_array();
        return $school_dboard;
    }

    public function get_tc_applied_count($apikey)
    {
        $this->db->flush_cache();
        $caste = $this->db->query("[dbo].[count_tcapplied_status] ?", $apikey)->result_array();
        return $caste;
    }

    public function get_tc_issue_count($apikey)
    {
        $this->db->flush_cache();
        $caste = $this->db->query("[dbo].[count_tcissue_status] ?", $apikey)->result_array();
        return $caste;
    }

    public function get_dashboard_details($apikey)
    {
        $this->db->flush_cache();
        $count = $this->db->query("[docme_bookstore].[count_dashboard_substore] ?", $apikey)->result_array();
        return $count;
    }

    public function get_dashboard_graph($apikey, $a)
    {
        $this->db->flush_cache();
        $count = $this->db->query("[docme_bookstore].[graph_dashboard_substore] ?,?", array($apikey, $a))->result_array();
        return $count[0];
    }

    public function get_dashboard_dailysales($apikey)
    {
        $this->db->flush_cache();
        $count = $this->db->query("[docme_bookstore].[dashboard_billing_substore] ?", $apikey)->result_array();
        return $count;
    }

    public function get_dashboard_notBilled($apikey)
    {
        $this->db->flush_cache();
        $count = $this->db->query("[docme_bookstore].[dashboard_not_billed_substore] ?", $apikey)->result_array();
        return $count;
    }
    public function uniform_dashboard_notBilled($apikey)
    {
        $this->db->flush_cache();
        $count = $this->db->query("[docme_uniform_store].[dashboard_not_billed_substore] ?", $apikey)->result_array();
        return $count;
    }

    public function get_dashboard_notdelivered($apikey)
    {
        $this->db->flush_cache();
        $count = $this->db->query("[docme_bookstore].[dashboard_not_delivered_substore]  ?", $apikey)->result_array();
        return $count;
    }

    public function uniform_get_dashboard_details($apikey)
    {
        $this->db->flush_cache();
        $count = $this->db->query("[docme_uniform_store].[count_dashboard_substore] ?", $apikey)->result_array();
        return $count;
    }

    public function uniform_get_dashboard_dailysales($apikey)
    {
        $this->db->flush_cache();
        $count = $this->db->query("[docme_uniform_store].[dashboard_billing_substore] ?", $apikey)->result_array();
        return $count;
    }

    public function uniform_get_dashboard_notdelivered($apikey)
    {
        $this->db->flush_cache();
        $count = $this->db->query("[docme_uniform_store].[dashboard_not_delivered_substore]  ?", $apikey)->result_array();
        return $count;
    }

    public function uniform_get_dashboard_graph($apikey, $a)
    {
        $this->db->flush_cache();
        $count = $this->db->query("[docme_uniform_store].[graph_dashboard_substore] ?,?", array($apikey, $a))->result_array();
        return $count[0];
    }
}
