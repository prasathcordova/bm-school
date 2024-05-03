<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales_packing_model
 *
 * @author saranya.kumar
 */
class Sales_packing_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function save_student_packing($dbparams) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[sales_packing_save_student] ?,?,?,?,?,?,?,?", $dbparams)->result_array();        
        if(isset($data[0])) {
            return $data[0];
        } else {
            return FALSE;
        }
    }
    public function save_faculty_packing($dbparams) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[sales_packing_save_employee] ?,?,?,?,?,?,?,?", $dbparams)->result_array();        
        if(isset($data[0])) {
            return $data[0];
        } else {
            return FALSE;
        }
    }
}
