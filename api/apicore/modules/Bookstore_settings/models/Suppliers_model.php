<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Suppliers_model
 *
 * @author Docme
 */
class Suppliers_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_suppliers_details($apikey, $query) {
        $this->db->flush_cache();
        if(strlen($query) > 0) {
            $suppliers = $this->db->query("[docme_bookstore].[supplier_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $suppliers = $this->db->query("[docme_bookstore].[supplier_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $suppliers;
    }
    
    public function add_new_suppliers($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $suppliers = $this->db->query("[docme_bookstore].[supplier_save] ?,?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($suppliers) && is_array($suppliers)) {
                return $suppliers[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Supplier not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Supplier not added. Please check the data and try again');
        }
    }
    
    public function update_suppliers_data($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $suppliers = $this->db->query("[docme_bookstore].[supplier_update] ?,?,?,?,?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($suppliers) && is_array($suppliers)) {
                return $suppliers[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Supplier not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Supplier not updated. Please check the data and try again');
        }
    }
}
