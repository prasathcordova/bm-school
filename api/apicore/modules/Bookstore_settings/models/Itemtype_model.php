<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Caste_model
 *
 * @author Rahul.docme
 */
class Itemtype_model extends CI_Model {
 public function __construct() {
        parent::__construct();
    }
    public function get_itemtype_details($apikey, $query) {
     $this->db->flush_cache();
        if(strlen($query) > 0) {
            $itemtype = $this->db->query("[docme_bookstore].[itemtype_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $itemtype = $this->db->query("[docme_bookstore].[itemtype_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }               
        return $itemtype;   
    }
    public function add_new_itemtype($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $itemtype = $this->db->query("[docme_bookstore].[itemtype_save] ?,?,?",$dbparams )->result_array();            
            if(!empty($itemtype) && is_array($itemtype)) {
                return $itemtype[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item Type Data not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item Type Data not added. Please check the data and try again');
        }
        
    }
    public function itemtype_update_data($dbparams) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $itemtype = $this->db->query("[docme_bookstore].[itemtype_update] ?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($itemtype) && is_array($itemtype)) {
                return $itemtype[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item Type Data not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item Type Data not updated. Please check the data and try again');
        }
    }
//     public function update_itemtype_data($dbparams) {
//        $this->db->flush_cache();
//        if(is_array($dbparams)) {
//            $itemtype = $this->db->query("[docme_bookstore].[itemtype_update] ?,?,?,?,?,?,?",$dbparams )->result_array();            
//            if(!empty($itemtype) && is_array($itemtype)) {
//                return $itemtype[0];
//            } else {
//                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item Type not updated. Please check the data and try again');
//            }
//        } else {
//            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item Type not updated. Please check the data and try again');
//        }
//    }
    
}
