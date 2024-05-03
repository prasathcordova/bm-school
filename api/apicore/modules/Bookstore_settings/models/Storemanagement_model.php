<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Storemanagement_model
 *
 * @author chandrajith.edsys
 */
class Storemanagement_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_store_details($apikey, $query) {
        $this->db->flush_cache();
        if(strlen($query) > 0) {
            $store = $this->db->query("[docme_bookstore].[store_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $store = $this->db->query("[docme_bookstore].[store_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $store;
    }
    public function get_substore_details($apikey, $query) {
        $this->db->flush_cache();
        if(strlen($query) > 0) {
            $store = $this->db->query("[docme_bookstore].[substore_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $store = $this->db->query("[docme_bookstore].[substore_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $store;
    }
    public function get_stockAllotment_details($apikey, $query) {
        $this->db->flush_cache();
        if(strlen($query) > 0) {
            $store = $this->db->query("[docme_bookstore].[stock_allotment_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $store = $this->db->query("[docme_bookstore].[stock_allotment_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $store;
    }
    
    public function add_new_store($dbparams) {
        $this->db->flush_cache();
//        dev_export($dbparams);die;
        if(is_array($dbparams)) {
            $store = $this->db->query("[docme_bookstore].[store_save] ?,?,?,?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($store) && is_array($store)) {
                return $store[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Store Data not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Store Data not added. Please check the data and try again');
        }
        
    }
    
    public function store_update($dbparams) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $store = $this->db->query("[docme_bookstore].[update_store] ?,?,?,?,?,?,?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($store) && is_array($store)) {
                return $store[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Store Data not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Store Data not updated. Please check the data and try again');
        }
    }
    
   
}
