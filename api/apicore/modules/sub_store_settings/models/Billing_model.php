<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Billing_model
 *
 * @author chandrajith.edsys
 */
class Billing_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_student_bill_data($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[studentpack_bill_select] ?,?", $dbparams)->result_array();

        return $studentdata;
    }
    public function studentpack_bill_select_oh($dbparams)
    { //for online payment portal
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[studentpack_bill_select_oh] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_pack_data($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[studentpackdetails_bill_select] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function save_cashpay_details($student_id, $packing_id, $xml_data, $apikey, $xml_item_data)
    {
        $this->db->flush_cache();
        //        return $xml_language ;
        $data = $this->db->query("[docme_bookstore].[sales_billing_save] ?,?,?,?,?", array($apikey, $student_id, $packing_id, $xml_data, $xml_item_data))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    public function search_student_bill_data($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[bill_packfilter_select] ?,?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_bill_data($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[get_bill_details] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function bill_cancel($apikey, $bill_masterid, $reason)
    {
        $this->db->flush_cache();
        //        return $xml_language ;
        $data = $this->db->query("[docme_bookstore].[bill_cancel] ?,?,?", array($apikey, $bill_masterid, $reason))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    public function voucher_cancel($apikey, $payment_id, $bill_masterid, $reason)
    {
        $this->db->flush_cache();
        //        return $xml_language ;
        $data = $this->db->query("[docme_bookstore].[bill_voucher_cancel] ?,?,?,?", array($apikey, $payment_id, $bill_masterid, $reason))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }
    public function update_online_delivery_details($dbparams)
    {
        $this->db->flush_cache();
        //        return $xml_language ;
        $data = $this->db->query("[docme_bookstore].[update_bookstore_online_order] ?,?,?,?,?", $dbparams)->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    public function get_payment_details($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[get_payment_details] ?,?", $dbparams)->result_array();
        return $studentdata;
    }
}
