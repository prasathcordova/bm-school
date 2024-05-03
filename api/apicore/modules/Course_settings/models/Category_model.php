<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category_model
 *
 * @author docme2
 */
class Category_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_category_details($apikey, $query) {
     $this->db->flush_cache();
        if(strlen($query) > 0) {
            $category = $this->db->query("[dbo].[Category_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $category = $this->db->query("[dbo].[Category_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }               
        return $category;   
    }
    
}
