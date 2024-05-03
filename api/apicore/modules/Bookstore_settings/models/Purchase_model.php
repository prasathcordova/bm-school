<?php

/**
 * Description of Purchase_model
 *
 * @author aju.docme
 */
class Purchase_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_purchase_list($apikey) {
        $this->db->flush_cache();
        $purchase_data = $this->db->query("[docme_bookstore].[show_purchase_list] ?", array($apikey))->result_array();
        return $purchase_data;
    }

//    public function save_direct_purchase($apikey, $data_prep, $purchased_items_xml) {
//        $this->db->flush_cache();
//        $purchase_data = $this->db->query("[docme_bookstore].[direct_purchase_save] ?", array($apikey))->result_array();
//        return $purchase_data;
//    }
    public function save_edit_purchase($data_prep_array) {
        $this->db->flush_cache();
        $purchase_data = $this->db->query("[docme_bookstore].[edit_save_purchase] ?,?,?,?,?,?,?,?,?,?,?", $data_prep_array)->result_array();
        return $purchase_data;
    }

    //SAVE PURCHASE //Docme
    public function save_direct_purchase_order($dbparams) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[save_direct_purchase] ?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
        return $data;
    }

    //GET PURCHASE DETAIL AUTHOR : AJU
    public function get_purchase_detail_data_for_approval_display($purchase_id, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_purchase_detail_data_for_approval] ?,?", array($apikey, $purchase_id))->result_array();
        return $data;
    }
    //GET PURCHASE DETAIL AUTHOR : AJU
    public function delete_purchase_order($purchase_id, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[delete_purchase_order] ?,?", array($apikey, $purchase_id))->result_array();
        return $data;
    }

    //GET PURCHASE DETAIL AUTHOR : AJU
    public function get_received_items_for_display($purchase_id, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_purchase_receive_data] ?,?", array($apikey, $purchase_id))->result_array();
        return $data;
    }

    //GET PURCHASE MASTER AJU
    public function get_purchase_master_data_for_approval_display($purchase_id, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_purchase_master_data_for_approval] ?,?", array($apikey, $purchase_id))->result_array();
        return $data;
    }

    //GET PURCHASE MASTER AJU
    public function get_purchase_comment_data_for_approval_display($purchase_id, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_purchase_comment_data_for_approval] ?,?", array($apikey, $purchase_id))->result_array();
        return $data;
    }

    //SAVE PURCHASE RECEIVE AJU
    public function save_purchase_receive($dbparams) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[save_purchase_recieve] ?,?,?,?,?,?,?", $dbparams)->result_array();        
        if(isset($data[0])) {
            return $data[0];
        } else {
            return FALSE;
        }
        
    }

    //END Docme
    public function save_purchase_order($dbparams) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[purchase_save] ?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
        return $data;
    }

    public function Update_purchase_order($dbparams) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[Update_purchase_order] ?,?,?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
        return $data;
    }

    public function get_purchase_details($apikey, $purchase_id) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[Edit_purchase_order] ?,?", array($apikey, $purchase_id))->result_array();
        return $data;
    }

    public function get_item_search($apikey, $item) {
        $this->db->flush_cache();
        $items = $this->db->query("[docme_bookstore].[show_item_list] ?,?", array($apikey, $item))->result_array();
        return $items;
    }

    public function approve_purchase($apikey, $purchase_id, $approval_remark, $status_id) {
        $this->db->flush_cache();
        $items = $this->db->query("[docme_bookstore].[Approve_purchase_order] ?,?,?,?", array($apikey, $purchase_id, $approval_remark, $status_id))->result_array();
        return $items;
    }

    //21-11-2017 Docme 
    public function Approve_purchase_data($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
//                        dev_export($dbparams);die;
            $stock_approval = $this->db->query("[docme_bookstore].[Approve_direct_purchase_order] ?,?,?,?", $dbparams)->result_array();
//            dev_export($stock_approval);die;
            if (!empty($stock_approval) && is_array($stock_approval)) {
                return $stock_approval[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Country not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Country not updated. Please check the data and try again');
        }
    }

//21-11-2017 Docme end
}
