<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Currency_model
 *
 * @author chandrajith.edsys
 */
class Currency_model extends MX_Controller {
   public function __construct() {
        parent::__construct();
   }
    public function get_currency_list($apikey,$query ) {
        $this->db->flush_cache();
        if(strlen($query) > 0) {
            $currency = $this->db->query("[settings].[currency_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $currency = $this->db->query("[settings].[currency_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $currency; 
    }
    public function add_new_currency($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $currency = $this->db->query("[settings].[currency_save] ?,?,?",$dbparams )->result_array();            
            if(!empty($currency) && is_array($currency)) {
                return $currency[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Currency not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Currency not added. Please check the data and try again');
        }
        
    }
    public function update_currency_data($dbparams) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $currency = $this->db->query("[settings].[currency_update] ?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($currency) && is_array($currency)) {
                return $currency[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Currency not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Currency not updated. Please check the data and try again');
        }
    }
        
    
}
