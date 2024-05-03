<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category_model
 *
 * @author rahul.shibukumar
 */
class Category_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
       public function get_category_details($apikey, $query) {
     $this->db->flush_cache();
        if(strlen($query) > 0) {
            $category = $this->db->query("[docme_bookstore].[category_data] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $category = $this->db->query("[docme_bookstore].[category_data] ?,?,?", array(1,$apikey,NULL))->result_array();
        }               
        return $category;   
    }
        public function add_new_category($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $category = $this->db->query("[docme_bookstore].[category_save] ?,?,?",$dbparams )->result_array();            
            if(!empty($category) && is_array($category)) {
                return $category[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Category Data not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Category Data not added. Please check the data and try again');
        }  
    }
    
       public function category_update_data($dbparams) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $category = $this->db->query("[docme_bookstore].[category_update] ?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($category) && is_array($category)) {
                return $category[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item Type Data not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Item Type Data not updated. Please check the data and try again');
        }
    }
}
