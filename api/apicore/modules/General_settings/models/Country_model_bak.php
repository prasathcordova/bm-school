<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Country_model
 *
 * @author aju.docme
 */
class Country_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_country_details($apikey, $query) {
        $this->db->flush_cache();
        if(strlen($query) > 0) {
            $country = $this->db->query("[settings].[country_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $country = $this->db->query("[settings].[country_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $country;
    }
    
    public function add_new_country($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $country = $this->db->query("[settings].[country_save] ?,?,?,?",$dbparams )->result_array();            
            if(!empty($country) && is_array($country)) {
                return $country[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Country not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Country not added. Please check the data and try again');
        }
    }
    
    public function update_country_data($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $country = $this->db->query("[settings].[country_update] ?,?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($country) && is_array($country)) {
                return $country[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Country not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Country not updated. Please check the data and try again');
        }
    }
}
