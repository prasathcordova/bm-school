<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Oh_model
 *
 * @author docme
 */
class Oh_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function is_openhouse_discount($apikey) {
        $this->db->flush_cache();
        $oh_data = $this->db->query("[docme_bookstore].[openhouse_discount] ?", array($apikey))->result_array();
        return $oh_data;
    }
    public function add_new_template_for_openhouse($apikey, $master_id, $xml_data) {
        $this->db->flush_cache();
        $oh_data = $this->db->query("[docme_bookstore].[openhouse_add_new_template] ?,?,?", array($apikey, $master_id, $xml_data))->result_array();

        return $oh_data;
    }

    public function remove_oh_student_assign($apikey, $template_config_id, $template_id, $xml_data) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[delete_oh_student_assign] ?,?,?,?", array($apikey, $template_config_id, $template_id, $xml_data))->result_array();

        return $data;
    }

    public function get_student_openhouse($apikey, $template_id, $openhouse_id) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_stud_assigned_openhouse] ?,?,?", array($apikey, $template_id, $openhouse_id))->result_array();
        return $data;
    }

    public function save_oh_student_assign($apikey, $template_config_id, $template_id, $xml_data) {
        $this->db->flush_cache();
//                dev_export($xml_data);die;
        $data = $this->db->query("[docme_bookstore].[save_oh_student_assign] ?,?,?,?", array($apikey, $template_config_id, $template_id, $xml_data))->result_array();

        return $data;
    }

    public function get_student_details($query, $apikey) {
        $this->db->flush_cache();
//                dev_export($apikey);die;
        $data = $this->db->query("[docme_bookstore].[oh_assign_student_search] ?,?", array($apikey, $query))->result_array();

        return $data;
    }

    public function get_item_mapmaster($apikey, $template_id) {
        $this->db->flush_cache();
        $oh_data = $this->db->query("[docme_bookstore].[select_item_map_master] ?,?", array($apikey, $template_id))->result_array();
//        dev_export($oh_data);die;
        return $oh_data;
    }

    public function get_items_for_ohstud_assign($apikey, $template_id, $openhouse_id) {
        $this->db->flush_cache();
        $oh_data = $this->db->query("[docme_bookstore].[select_items_for_oh_stud_assign] ?,?,?", array($apikey, $template_id, $openhouse_id))->result_array();
//        dev_export($oh_data);die;
        return $oh_data;
    }

    public function save_oh_items_assigned($apikey, $template_id, $total_qty, $sub_total, $vat, $discount, $xml_data, $roundoff, $finaltotal, $discount_type) {
        $this->db->flush_cache();
        $oh_data = $this->db->query("[docme_bookstore].[save_oh_item_assigned] ?,?,?,?,?,?,?,?,?,?", array($apikey, $template_id, $total_qty, $sub_total, $vat, $discount, $discount_type, $roundoff, $finaltotal, $xml_data))->result_array();

        return $oh_data;
    }

    public function edit_openhouse_details($apikey, $master_id, $start_date, $end_date, $no_temp_st, $description, $xml_data,$is_discount) {
        $this->db->flush_cache();
        $oh_data = $this->db->query("[docme_bookstore].[edit_openhouse] ?,?,?,?,?,?,?,?", array($apikey, $master_id, $start_date, $end_date, $no_temp_st, $description, $xml_data,$is_discount))->result_array();

        return $oh_data;
    }

    public function delete_openhouse_details($apikey, $master_id) {
        $this->db->flush_cache();
        $oh_data = $this->db->query("[docme_bookstore].[delete_openhouse] ?,?", array($apikey, $master_id))->result_array();

        return $oh_data;
    }

    public function save_openhouse_details($apikey, $start_date, $end_date, $no_temp_st, $description, $xml_data,$is_discount) {
        $this->db->flush_cache();
        $oh_data = $this->db->query("[docme_bookstore].[save_openhouse] ?,?,?,?,?,?,?", array($apikey, $start_date, $end_date, $no_temp_st, $description, $xml_data,$is_discount))->result_array();

        return $oh_data;
    }

    public function get_openhouse_master_data($query, $apikey) {

        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $oph_data = $this->db->query("[docme_bookstore].[select_openhouse_master] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $oph_data = $this->db->query("[docme_bookstore].[select_openhouse_master] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $oph_data;
    }

    public function get_openhouse_detail_data($query, $apikey) {

        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $oph_data = $this->db->query("[docme_bookstore].[select_openhouse_detail] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $oph_data = $this->db->query("[docme_bookstore].[select_openhouse_detail] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $oph_data;
    }

    public function get_oh_data($query, $apikey) {
//        dev_export($query);die;
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $oh_data = $this->db->query("[docme_bookstore].[select_ohtemplate] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $oh_data = $this->db->query("[docme_bookstore].[select_ohtemplate] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $oh_data;
    }

    public function save_oh_details($dbparams) {
        $this->db->flush_cache();
        $oh_data = $this->db->query("[docme_bookstore].[save_ohtemplate] ?,?,?", $dbparams)->result_array();

        return $oh_data;
    }

    public function edit_oh_details($dbparams) {
        $this->db->flush_cache();
        $oh_data = $this->db->query("[docme_bookstore].[edit_ohtemplate] ?,?,?,?", $dbparams)->result_array();

        return $oh_data;
    }

    public function select_openhouse_detail_with_template($params) {
        $this->db->flush_cache();
        $oh_data = $this->db->query("[docme_bookstore].[select_openhouse_detail_with_template] ?", $params)->result_array();

        return $oh_data;
    }

}
