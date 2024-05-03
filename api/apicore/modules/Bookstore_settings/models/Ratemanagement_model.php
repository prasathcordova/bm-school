<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ratemanagement_model
 *
 * @author chandrajith.edsys
 */
class Ratemanagement_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
     public function get_itemrate_details($apikey, $query) {
        $this->db->flush_cache();
        if(strlen($query) > 0) {
            $rate = $this->db->query("[docme_bookstore].[item_rate_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $rate = $this->db->query("[docme_bookstore].[item_rate_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $rate;
    }
    
    public function change_rate($apikey,$flag,$rate_item_details_xml) {
        $this->db->flush_cache();

            $rate = $this->db->query("[docme_bookstore].[rate_change] ?,?,?", array($apikey,$flag,$rate_item_details_xml))->result_array();
//            dev_export($rate);die;
            return $rate;

    }
    
    public function get_itemrate_details_for_substore($apikey) {
        $this->db->flush_cache();
       
            $rate = $this->db->query("[docme_bookstore].[item_rate_select_store] ?", array($apikey))->result_array();
            
//            dev_export($rate);die;
             
        return $rate;
    }
    
    
}
