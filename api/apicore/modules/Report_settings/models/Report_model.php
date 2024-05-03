<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registration_report_model
 *
 * @author Remya SR
 */
class Report_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function get_strength($dbparams) {
        //return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $strength_list = $this->db->query("[MIS].[get_strength_data] ?,?,?", $dbparams)->row_array();
        } else {
            $strength_list = $this->db->query("[MIS].[get_strength_data] ?,?,?", array(NULL))->result_array();
        }        
        return $strength_list;
    }
    public function get_long_absentee_details($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $strength_list = $this->db->query("[MIS].[MIS_ATTENDANCE_DETAILS] ?,?,?,?,?", $dbparams)->result_array();
        } else {
            $strength_list = $this->db->query("[MIS].[MIS_ATTENDANCE_DETAILS] ?,?,?,?,?", array(NULL))->result_array();
        }        
        return $strength_list;
    }
    public function long_abstee_count($dbparams) {
        // return $dbparams;die;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_DASHBOARD_DETAILS] ?,?,?,?,?", $dbparams)->row_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_DASHBOARD_DETAILS] ?,?,?,?,?", array(NULL))->result_array();
        }        
        return $details_list;
    }
    public function get_tc_details($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_ATTENDANCE_DETAILS] ?,?,?,?,?", $dbparams)->result_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_ATTENDANCE_DETAILS] ?,?,?,?,?", array(NULL))->result_array();
        }        
        return $details_list;
    }
    public function get_not_demand_details($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_DASHBOARD_DETAILS] ?,?,?,?,?", $dbparams)->result_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_DASHBOARD_DETAILS] ?,?,?,?,?", array(NULL))->result_array();
        }        
        return $details_list;
    }
    public function get_fee_cons_details($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_DASHBOARD_DETAILS] ?,?,?,?,?", $dbparams)->result_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_DASHBOARD_DETAILS] ?,?,?,?,?", array(NULL))->result_array();
        }        
        return $details_list;
    }
    public function get_fee_exemption_details($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_DASHBOARD_DETAILS] ?,?,?,?,?", $dbparams)->result_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_DASHBOARD_DETAILS] ?,?,?,?,?", array(NULL))->result_array();
        }        
        return $details_list;
    }
    public function get_graph_details($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_DASHBOARD_DETAILS] ?,?,?,?,?", $dbparams)->result_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_DASHBOARD_DETAILS] ?,?,?,?,?", array(NULL))->result_array();
        }        
        return $details_list;
    }
    public function get_exemption($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_ATTENDANCE_DETAILS] ?,?,?,?,?", $dbparams)->result_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_ATTENDANCE_DETAILS] ?,?,?,?,?", array(NULL))->result_array();
        }        
        return $details_list;
    }
    public function get_exemption_list($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_EXEMPTION_DETAILS] ?,?,?,?,?,?,?,?", $dbparams)->result_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_EXEMPTION_DETAILS] ?,?,?,?,?,?,?,?", array(NULL))->result_array();
        }        
        return $details_list;
    }
    public function approve_exemption_group($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_APPROVE_EXEMPTION_GROUP] ?,?,?,?,?,?", $dbparams)->result_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_APPROVE_EXEMPTION_GROUP] ?,?,?,?,?,?", array(NULL))->result_array();
        }        
        return $details_list;
    }
    public function exemption_group_sorting($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_EXEMPTION_DETAILS_BY_SORTING] ?,?,?,?,?", $dbparams)->result_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_EXEMPTION_DETAILS_BY_SORTING] ?,?,?,?,?", array(NULL))->result_array();
        }        
        return $details_list;
    }
    public function exemption_count($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_EXEMPTION_DETAILS] ?,?,?,?,?,?,?,?", $dbparams)->row_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_EXEMPTION_DETAILS] ?,?,?,?,?,?,?,?", array(NULL))->row_array();
        }        
        return $details_list;
    }
    public function get_mail_details($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_MAIL_DETAILS] ?,?,?", $dbparams)->row_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_MAIL_DETAILS] ?,?,?", array(NULL))->row_array();
        }        
        return $details_list;
    }
    public function get_arrear_details($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[get_arrear_comparison] ?,?", $dbparams)->row_array();
        } else {
            $details_list = $this->db->query("[MIS].[get_arrear_comparison] ?,?", array(NULL))->row_array();
        }        
        return $details_list;
    }

    public function get_statistical_details($dbparams) {
        // return $dbparams;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $details_list = $this->db->query("[MIS].[MIS_STATISTICAL_REPORT] ?,?,?,?,?", $dbparams)->result_array();
        } else {
            $details_list = $this->db->query("[MIS].[MIS_STATISTICAL_REPORT] ?,?,?,?,?", array(NULL))->result_array();
        }        
        return $details_list;
    }
    
}
