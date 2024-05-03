<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Caste_model
 *
 * @author chandrajith.edsys
 */
class Caste_model extends CI_Model {
 public function __construct() {
        parent::__construct();
    }
    public function get_caste_details($apikey, $query) {
     $this->db->flush_cache();
        if(strlen($query) > 0) {
            $caste = $this->db->query("[settings].[caste_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $caste = $this->db->query("[settings].[caste_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }               
        return $caste;   
    }
    public function add_new_caste($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $caste = $this->db->query("[settings].[caste_save] ?,?,?,?",$dbparams )->result_array();            
            if(!empty($caste) && is_array($caste)) {
                return $caste[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Caste not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Caste not added. Please check the data and try again');
        }
        
    }
    public function update_caste_data($dbparams) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $caste = $this->db->query("[settings].[caste_update] ?,?,?,?,?,?,?",$dbparams )->result_array();        
//            dev_export($caste);die;
            if(!empty($caste) && is_array($caste)) {
                return $caste[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Caste not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Caste not updated. Please check the data and try again');
        }
    }
    
}
