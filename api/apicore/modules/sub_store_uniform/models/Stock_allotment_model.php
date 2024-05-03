<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stock_allotment_model
 *
 * @author saranya.kumar
 */
class Stock_allotment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_stock_list_for_allotment($apikey, $storeid) {
        $this->db->flush_cache();
        if ($storeid)
            $stock = $this->db->query("[docme_uniform_store].[item_rate_select_substore] ?,?", array($apikey, $storeid))->result_array();
        else
            $stock = $this->db->query("[docme_uniform_store].[item_rate_select_substore] ?", array($apikey))->result_array();
        return $stock;
    }

    public function get_stock_list_for_substore_search($params) {
        $this->db->flush_cache();
        $stock = $this->db->query("[docme_uniform_store].[search_item_rate_select_substore] ?,?,?,?,?,?", $params)->result_array();
        return $stock;
    }
 
    public function get_stock_allotment_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $stock_allotment = $this->db->query("[docme_uniform_store].[stock_allotment_select_sub_store] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $stock_allotment = $this->db->query("[docme_uniform_store].[stock_allotment_select_sub_store] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $stock_allotment;
    }

    public function get_stock_allotment_details_out($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $stock_allotment = $this->db->query("[docme_uniform_store].[stock_allotment_select_sub_store_out] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $stock_allotment = $this->db->query("[docme_uniform_store].[stock_allotment_select_sub_store_out] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $stock_allotment;
    }

    public function save_allotment_sub_out($apikey, $allotment_stock_details_xml, $store_id, $total_qty, $total_value, $description) {
        $this->db->flush_cache();
        $stock_allotment = $this->db->query("[docme_uniform_store].[save_allotment_substore_out] ?,?,?,?,?,?", array($apikey, $allotment_stock_details_xml, $store_id, $total_qty, $total_value, $description))->result_array();
        if (!empty($stock_allotment) && is_array($stock_allotment)) {
            return $stock_allotment[0];
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Allotment not added. Please check the data and try again');
        }
    }

    public function edit_allotment_out_save($dbparams) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_uniform_store].[edit_save_stock_allotment_sub_out] ?,?,?,?,?,?", $dbparams)->result_array();
        return $data;
    }
    
      //ALLOTMENT MASTER DETAILS FOR APPROVAL
    public function get_allotment_master_data_for_approval_display($allotment_id, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_uniform_store].[get_allotment_master_data_for_approval] ?,?", array($apikey, $allotment_id))->result_array();
//        dev_export($data);die;
        return $data;
    }
       //ALLOTMENT DETAILS FOR APPROVAL
    public function get_allotment_detail_data_for_approval_display($allotment_id, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_uniform_store].[get_allotment_detail_data_for_approval] ?,?", array($apikey, $allotment_id))->result_array();
//        dev_export($data);die;
        return $data;
    }
    
      //GET Allotment  MASTER SARANYA
    public function get_allotment_comment_data_for_approval_display($allotment_id, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_uniform_store].[get_allotment_comment_data_for_approval] ?,?", array($apikey, $allotment_id))->result_array();
        return $data;
    }

}
