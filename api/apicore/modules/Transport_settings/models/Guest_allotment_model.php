<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Guest_allotment_model
 *
 * @author chandrajith.edsys
 */
class Guest_allotment_model extends CI_Model {
     public function __construct() {
        parent::__construct();
    }
    public function save_guest_transport_allotment($apikey,$allotment_data_raw ,$inst_id) {
        $this->db->flush_cache();
//        return $xml_language ;
        $data = $this->db->query("[docme_transport].[guest_allotment_save] ?,?,?", array($apikey,$allotment_data_raw ,$inst_id))->result_array();
//        dev_export($data);die;
        return $data;
//        return isset($data[0]) ? $data['0'] : $data;
    }
}
