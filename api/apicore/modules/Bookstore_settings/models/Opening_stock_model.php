<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Opening_stock_model
 *
 * @author rahul.shibukumar
 */
class Opening_stock_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_stockmaster_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $stock = $this->db->query("[docme_bookstore].[select_opening_stock_master] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $stock = $this->db->query("[docme_bookstore].[select_opening_stock_master] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $stock;
    }
    public function get_current_stock($apikey,$storeid) {
//        dev_export($storeid);die;
        $this->db->flush_cache();
        if ($storeid > 0) {
            $stock = $this->db->query("[docme_bookstore].[stock_select] ?,?,?", array(1, $apikey, $storeid))->result_array();
        } else {
            $stock = $this->db->query("[docme_bookstore].[stock_select] ?,?,?", array(0, $apikey, NULL))->result_array();
        }
        return $stock;
    }
    public function save_opening_stock($apikey, $os_details_xml,$purchase_status) {
//        dev_export($storeid);die;
        $this->db->flush_cache();
        
            $stock = $this->db->query("[docme_bookstore].[save_opening_stock] ?,?,?", array($apikey, $os_details_xml,$purchase_status))->result_array();
       
        return $stock;
    }

}
