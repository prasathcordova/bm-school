<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Custom_rpt_model
 *
 * @author Shamna
 */
class Custom_rpt_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function get_rpt_custom($dbparams)
    {

        $this->db->flush_cache();
        $custum_rpt = $this->db->query("[dbo].[Rpt_custom_report] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
        return $custum_rpt;
    }
    public function spread_sheet_query($inst_id, $type = 'DCB', $acd_year = 0)
    {

        $this->db->flush_cache();
        $custum_rpt = $this->db->query("[dbo].[spreadsheet_reports_trust] ?,?,?", array($inst_id, $type, $acd_year))->result_array();
        return $custum_rpt;
    }
}
