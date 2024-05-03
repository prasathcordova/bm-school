<?php

/**
 * Description of Language_model
 *
 * @author chandrajith.edsys
 */
class Language_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_language_list($apikey,$query ) {
        $this->db->flush_cache();   
        if(strlen($query) > 0) {
            $language = $this->db->query("[settings].[language_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $language = $this->db->query("[settings].[language_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $language; 
    }
    public function add_new_language($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $language = $this->db->query("[settings].[language_save] ?,?",$dbparams )->result_array();            
            if(!empty($language) && is_array($language)) {
                return $language[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Language not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Language not added. Please check the data and try again');
        }
    }
    public function update_language_data($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $language = $this->db->query("[settings].[language_update] ?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($language) && is_array($language)) {
                return $language[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Language not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Language not updated. Please check the data and try again');
        }
    }
    
}
