<?php

/**
 * Description of Religion_model
 *
 * @author aju.docme
 */
class Religion_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_religion($query, $apikey) { 
        $this->db->flush_cache();        
        if(strlen($query) > 0) {
            $religion = $this->db->query("[settings].[religion_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {            
            $religion = $this->db->query("[settings].[religion_select] ?,?,?", array(1,$apikey,NULL))->result_array();            
        }        
        return $religion;
    }
    
    public function save_religion_data($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $community = $this->db->query("[settings].[religion_save] ?,?",$dbparams )->result_array();            
            if(!empty($community) && is_array($community)) {
                return $community[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Religion not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Religion not added. Please check the data and try again');
        }
    }
    
    public function update_religion_data($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $religion = $this->db->query("[settings].[religion_update] ?,?,?,?,?",$dbparams )->result_array();            
//            dev_export($religion);die;
            if(!empty($religion) && is_array($religion)) {
                return $religion[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Religion not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Religion not updated. Please check the data and try again');
        }
    }
}
