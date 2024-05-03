<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Place_model
 *
 * @author chandrajith.edsys
 */
class City_model extends CI_Model{
      public function __construct() {
        parent::__construct();
    }
    public function get_city_details($apikey, $query) {
        $this->db->flush_cache();
        if(strlen($query) > 0) {
            $place = $this->db->query("[settings].[city_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $place = $this->db->query("[settings].[city_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $place;
    }
    public function add_new_city($dbparams) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $city = $this->db->query("[settings].[city_save] ?,?,?,?",$dbparams )->result_array();            
            if(!empty($city) && is_array($city)) {
                return $city[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'City not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'City not added. Please check the data and try again');
        }
    }
    public function update_city_data($dbparams ) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $city = $this->db->query("[settings].[city_update] ?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($city) && is_array($city)) {
                return $city[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'City not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'City not updated. Please check the data and try again');
        }
    }
        
    
}
