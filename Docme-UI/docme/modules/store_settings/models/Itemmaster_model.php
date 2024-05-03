<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Itemmaster_model
 *
 * @author chandrajith.edsys
 */
class Itemmaster_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function get_item_details($apikey, $query) {
        $this->db->flush_cache();
        if(strlen($query) > 0) {
            $country = $this->db->query("[docme_bookstore].[items_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $country = $this->db->query("[docme_bookstore].[items_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $country;
    }
    public function add_new_item($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $item = $this->db->query("[docme_bookstore].[items_save] ?,?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($item) && is_array($item)) {
                return $item[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item not added. Please check the data and try again');
        }
    }
    public function update_item_data($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $item = $this->db->query("[docme_bookstore].[items_update] ?,?,?,?,?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($item) && is_array($item)) {
                return $item[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item not updated. Please check the data and try again');
        }
    }
    
}
