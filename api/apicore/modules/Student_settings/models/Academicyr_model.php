<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Academicyr_model
 *
 * @author docme2
 */
class Academicyr_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_acdyr_details($apikey, $query) {
     $this->db->flush_cache();
        if(strlen($query) > 0) {
            $acdyr = $this->db->query("[settings].[Acdyear_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $acdyr = $this->db->query("[settings].[Acdyear_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }               
        return $acdyr;   
    }
    
     public function add_new_academicyr($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $acdyr = $this->db->query("[settings].[Acdyear_save] ?,?,?,?",$dbparams )->result_array();            
            if(!empty($acdyr) && is_array($acdyr)) {
                return $acdyr[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Academic Year not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Academic Year not added. Please check the data and try again');
        }
        
    }
    
    
    public function update_acdyr_data($dbparams) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $acdyr = $this->db->query("[settings].[Acdyear_update] ?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($acdyr) && is_array($acdyr)) {
                return $acdyr[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Academic Year not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Academic Year not updated. Please check the data and try again');
        }
    }
}
