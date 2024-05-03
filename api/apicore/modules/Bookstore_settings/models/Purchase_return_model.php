<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Purchase_return_model
 *
 * @author Docme.kumar
 */
//21-11-2017 Docme
class Purchase_return_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_purchase_return_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $purchase_return = $this->db->query("[docme_bookstore].[purchase_return_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $purchase_return = $this->db->query("[docme_bookstore].[purchase_return_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $purchase_return;
    }

    public function save_purchase_return($apikey, $return_details_xml, $purchase_return_date, $supplier_code, $total_qty, $item_count, $total_value, $description) {
        $this->db->flush_cache();
        $purchase_return = $this->db->query("[docme_bookstore].[save_purchase-return] ?,?,?,?,?,?,?,?", array($apikey, $return_details_xml, $purchase_return_date, $supplier_code, $total_qty, $item_count, $total_value, $description))->result_array();
//            dev_export($item);die;
        if (!empty($purchase_return) && is_array($purchase_return)) {
            return $purchase_return[0];
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'purchase return not added. Please check the data and try again');
        }
    }

    public function approve_purchase_return($dbparams) {
//          dev_export($dbparams);die;
        $this->db->flush_cache();
        if (is_array($dbparams)) {
//            dev_export($dbparams);die;
            $return_approval = $this->db->query("[docme_bookstore].[Approve_purchase_return] ?,?,?,?", $dbparams)->result_array();
//            dev_export($return_approval);die;
            if (!empty($return_approval) && is_array($return_approval)) {
                return $return_approval[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Return approval failed . Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Return approval failed. Please check the data and try again');
        }
    }

    //21-11-2017 Docme end
    public function get_return_master_data_by_id($returnid,$apikey) {
        $this->db->flush_cache();
        $return_master_data = $this->db->query("[docme_bookstore].[get_return_master_data_for_approval] ?,?", array($apikey,$returnid))->result_array();
        return $return_master_data;
    }

    //21-11-2017 Docme end
   public function get_return_detail_data_by_id($returnid,$apikey) {
        $this->db->flush_cache();
        $return_detail_data = $this->db->query("[docme_bookstore].[get_return_detail_data_for_approval] ?,?", array($apikey,$returnid))->result_array();
        return $return_detail_data;
    }

    //21-11-2017 Docme end
    public function get_return_comment_data_by_id($returnid,$apikey) {
        $this->db->flush_cache();
        $return_comment_data = $this->db->query("[docme_bookstore].[get_return_comment_data_for_approval] ?,?", array($apikey,$returnid))->result_array();
        return $return_comment_data;
    }
    
    //GET PURCHASE DETAIL AUTHOR : Docme
    public function delete_purchase_return($returnid, $apikey) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[delete_purchase_return] ?,?", array($apikey, $returnid))->result_array();
        return $data;
    }
    //EDIT PURCHASE RETURN DETAIL AUTHOR : Docme
     public function edit_purchase_return($dbparams) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[edit_save_purchase_return] ?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
        return $data;
    }
}
