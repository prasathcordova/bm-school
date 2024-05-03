<?php

/**
 * Description of Community_model
 *
 * @author aju.docme
 */
class Community_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_community_data($query, $apikey) {
       
        $this->db->flush_cache();
        if(strlen($query) > 0) {
            $community = $this->db->query("[settings].[community_select] ?,?,?", array(0,$apikey,$query))->result_array();
           
        } else {
            $community = $this->db->query("[settings].[community_select] ?,?,?", array(1,$apikey,NULL))->result_array();
//            
        }   
//         dev_export($community);die;
        return $community;
    }

    public function add_new_community($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $community = $this->db->query("[settings].[community_save] ?,?",$dbparams )->result_array();            
            if(!empty($community) && is_array($community)) {
                return $community[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Community not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Community not added. Please check the data and try again');
        }
    }
    
    public function update_community_data($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $community = $this->db->query("[settings].[community_update] ?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($community) && is_array($community)) {
                return $community[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Country not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Country not updated. Please check the data and try again');
        }
    }
}
