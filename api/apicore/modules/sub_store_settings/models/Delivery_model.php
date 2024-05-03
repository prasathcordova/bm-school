<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Delivery_model
 *
 * @author saranya.kumar
 */
class Delivery_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_faculty_delivery_data($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[facultypack_delivery_select] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_student_delivery_data($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[studentpack_delivery_select] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_pack_data_delivery($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[studentpackdetails_delivery_select] ?,?,?", $dbparams)->result_array();

        return $studentdata;
    }
    public function get_pack_data_delivery_note($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[delivery_note_print] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_replace_data_delivery($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[item_replace_delivery] ?,?,?,?", $dbparams)->result_array();
        //        dev_export($studentdata);die;
        return $studentdata;
    }

    public function save_student_dellivery($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[sales_delivery_save] ?,?", $dbparams)->result_array();
        //        dev_export($data);die;
        if (isset($data[0])) {
            return $data[0];
        } else {
            return FALSE;
        }
    }

    public function save_replace_item_dellivery($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[sales_delivery_replacement_save] ?,?,?,?,?,?,?", $dbparams)->result_array();
        //        dev_export($data);die;
        if (isset($data[0])) {
            return $data[0];
        } else {
            return FALSE;
        }
    }

    //DELIVERY RETURN

    public function get_faculty_pack_deliveryReturn($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[facultypack_deliveryReturn_select] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_student_deliveryReturn_data($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[studentpack_deliveryReturn_select] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function save_student_delliveryReturn($apikey, $delivery_masterid, $student_id, $subtotal, $tax, $final_amount, $reason, $xml_data, $round_off, $total_before_roundoff, $pay_back_amount)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[sales_delivery_return_save] ?,?,?,?,?,?,?,?,?,?,?", array($apikey, $delivery_masterid, $student_id, $subtotal, $tax, $final_amount, $reason, $xml_data, $round_off, $total_before_roundoff, $pay_back_amount))->result_array();
        //        dev_export($data);die;
        if (isset($data[0])) {
            return $data[0];
        } else {
            return FALSE;
        }
    }

    public function save_faculty_delliveryReturn($apikey, $delivery_masterid, $emp_id, $subtotal, $tax, $final_amount, $reason, $xml_data, $round_off, $total_before_roundoff)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[sales_delivery_return_faculty_save] ?,?,?,?,?,?,?,?,?,?", array($apikey, $delivery_masterid, $emp_id, $subtotal, $tax, $final_amount, $reason, $xml_data, $round_off, $total_before_roundoff))->result_array();
        //        dev_export($data);die;
        if (isset($data[0])) {
            return $data[0];
        } else {
            return FALSE;
        }
    }

    public function sales_delivery_return_save_OH($apikey, $delivery_masterid, $student_id, $subtotal, $tax, $final_amount, $reason, $round_off, $total_before_roundoff, $pay_back_amount)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[sales_delivery_return_save_OH] ?,?,?,?,?,?,?,?,?,?", array($apikey, $delivery_masterid, $student_id, $subtotal, $tax, $final_amount, $reason, $round_off, $total_before_roundoff, $pay_back_amount))->result_array();
        //        dev_export($data);die;
        if (isset($data[0])) {
            return $data[0];
        } else {
            return FALSE;
        }
    }

    public function get_student_delivery_voucher_search($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[voucher_search] ?,?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function voucher_search_faculty($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[voucher_search_faculty] ?,?,?,?", $dbparams)->result_array();

        return $studentdata;
    }
    public function save_bookstore_online_order_delivery_details($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[save_bookstore_online_order] $param_string", $dbparams)->result_array();
        return $studentdata;
    }
    public function get_bookstore_online_order($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[online_order_select] $param_string", $dbparams)->result_array();
        return $studentdata;
    }
}
