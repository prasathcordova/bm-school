<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Course_model
 *
 * @author rahul.shibukumar
 */
class Course_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
      public function get_course_type_details($apikey) {
        $this->db->flush_cache();
            $course = $this->db->query("[settings].[course_type_select] ?", array($apikey))->result_array();
        return $course;
    }
      public function get_course_details($apikey, $query) {
        $this->db->flush_cache();
        if(strlen($query) > 0) {
            $course_ = $this->db->query("[settings].[course_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $course_ = $this->db->query("[settings].[course_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $course_;
    }
    
     
    public function add_new_course($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $course = $this->db->query("[settings].[course_save] ?,?,?,?",$dbparams )->result_array();            
            if(!empty($course) && is_array($course)) {
                return $course[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Course not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Course not added. Please check the data and try again');
        }
    }
    
    public function update_course_data($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $course = $this->db->query("[settings].[course_update] ?,?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($course) && is_array($course)) {
                return $course[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Course not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Course not updated. Please check the data and try again');
        }
    }
      
   
    
    
    
}
