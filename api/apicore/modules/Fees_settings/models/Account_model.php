<?php

/**
 * Data functionality for account related operation
 *
 * @author Aju S Aravind
 */
class Account_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_student_account_data($student_id,$inst_id,$acd_year_id,$apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_student_account_statement]  ?,?,?,?,?", array($apikey,1,$student_id,$inst_id,$acd_year_id))->result_array();
        return $data;
    }
    public function get_student_account_summary_data($student_id,$inst_id,$acd_year_id,$apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_student_account_statement]  ?,?,?,?,?", array($apikey,2,$student_id,$inst_id,$acd_year_id))->result_array();
        return $data;
    }
}
