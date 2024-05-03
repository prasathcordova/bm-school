<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Itemedition_model
 *
 * @author docme2
 */
class Itemedition_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_itemedition_details($apikey, $query) {
     $this->db->flush_cache();
        if(strlen($query) > 0) {
            $item_edition = $this->db->query("[docme_bookstore].[itemedition_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $item_edition = $this->db->query("[docme_bookstore].[itemedition_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }               
        return $item_edition;   
    }
    public function add_new_itemedtion($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $item_edition = $this->db->query(" [docme_bookstore].[itemedition_save] ?,?",$dbparams )->result_array();            
            if(!empty($item_edition) && is_array($item_edition)) {
                return $item_edition[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item Edition not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item Edition not added. Please check the data and try again');
        }
        
    }
    public function update_itemedition_data($dbparams) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $item_edition = $this->db->query("[docme_bookstore].[edition_update] ?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($item_edition) && is_array($item_edition)) {
                return $item_edition[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item Edition not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item Edition not updated. Please check the data and try again');
        }
    }
}
