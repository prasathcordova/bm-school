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
class Publisher_model extends CI_Model {
 public function __construct() {
        parent::__construct();
    }
    public function get_publisher_details($apikey, $query) {
     $this->db->flush_cache();
        if(strlen($query) > 0) {
            $publisher = $this->db->query("[docme_bookstore].[publisher_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $publisher = $this->db->query("[docme_bookstore].[publisher_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }               
        return $publisher;   
    }
    public function add_new_publisher($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $publisher = $this->db->query("[docme_bookstore].[publisher_save] ?,?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($publisher) && is_array($publisher)) {
                return $publisher[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Publisher Data not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Publisher Data not added. Please check the data and try again');
        }
        
    }
    public function publisher_update_date($dbparams) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $publisher = $this->db->query("[docme_bookstore].[publisher_update] ?,?,?,?,?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($publisher) && is_array($publisher)) {
                return $publisher[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Publisher Data not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Publisher Data not updated. Please check the data and try again');
        }
    }
    
}