<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stock_allotment_model
 *
 * @author Docme.kumar
 */
//21-11-2017 Docme
class Stock_allotment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_stock_allotment_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $stock_allotment = $this->db->query("[docme_bookstore].[stock_allotment_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $stock_allotment = $this->db->query("[docme_bookstore].[stock_allotment_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $stock_allotment;
    }

    public function save_allotment($apikey, $allotment_stock_details_xml, $store_id, $total_qty, $total_value, $description) {
        $this->db->flush_cache();
        $stock_allotment = $this->db->query("[docme_bookstore].[save_allotment] ?,?,?,?,?,?", array($apikey, $allotment_stock_details_xml, $store_id, $total_qty, $total_value, $description))->result_array();
//            dev_export($stock_allotment);die;
        if (!empty($stock_allotment) && is_array($stock_allotment)) {
            return $stock_allotment[0];
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Allotment not added. Please check the data and try again');
        }
    }

    public function approve_allotment($dbparams) {
//          dev_export($dbparams);die;
        $this->db->flush_cache();
        if (is_array($dbparams)) {
//            dev_export($dbparams);die;
            $stock_approval = $this->db->query("[docme_bookstore].[Approve_stock_allotment] ?,?,?,?", $dbparams)->result_array();
//            dev_export($stock_approval);die;
            if (!empty($stock_approval) && is_array($stock_approval)) {
                return $stock_approval[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'stock approval failed . Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'stock approval failed. Please check the data and try again');
        }
    }

    //21-11-2017 Docme end
     //ALLOTMENT DETAILS FOR APPROVAL
    public function get_allotment_detail_data_for_approval_display($allotment_id, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_allotment_detail_data_for_approval] ?,?", array($apikey, $allotment_id))->result_array();
//        dev_export($data);die;
        return $data;
    }
     //ALLOTMENT MASTER DETAILS FOR APPROVAL
    public function get_allotment_master_data_for_approval_display($allotment_id, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_allotment_master_data_for_approval] ?,?", array($apikey, $allotment_id))->result_array();
//        dev_export($data);die;
        return $data;
    }
    
     //GET Allotment  MASTER Docme
    public function get_allotment_comment_data_for_approval_display($allotment_id, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_allotment_comment_data_for_approval] ?,?", array($apikey, $allotment_id))->result_array();
        return $data;
    }
    
    // ALLOTMENT DELETE AUTHOR : Docme
    public function delete_allotment_order($allotment_id, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[delete_allotment] ?,?", array($apikey, $allotment_id))->result_array();
        return $data;
    }
    
    //EDIT ALLOTMENT DETAIL AUTHOR : Docme
     public function edit_allotment_save($dbparams) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[edit_save_stock_allotment] ?,?,?,?,?,?", $dbparams)->result_array();
        return $data;
    }
}
