<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Class_model
 *
 * @author docme2
 */
class Class_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_class_details($apikey, $query) {
     $this->db->flush_cache();
        if(strlen($query) > 0) {
            $class = $this->db->query("[settings].[Class_select] ?,?,?,?", array(0,$apikey,$query,NULL))->result_array();
        } else {
            $class = $this->db->query("[settings].[Class_select] ?,?,?,?", array(1,$apikey,NULL,NULL))->result_array();
        }               
        return $class;   
    }
    
    public function add_new_class($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $class = $this->db->query("[settings].[Class_save] ?,?,?",$dbparams )->result_array();            
            if(!empty($class) && is_array($class)) {
//                dev_export($class);die;
                return $class[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Class not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Class not added. Please check the data and try again');
        }
        
    }
    
    public function update_class_data($dbparams) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $class = $this->db->query("[settings].[Class_update] ?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($class) && is_array($class)) {
                return $class[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Class not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Class not updated. Please check the data and try again');
        }
    }
}
