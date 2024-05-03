<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Document_model
 *
 * @author rahul.shibukumar
 */
class Document_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_document_count($dbparams) {
        $this->db->flush_cache();
        $document_count = $this->db->query("[docme_document].[get_document_count] ?,?,?", $dbparams)->result_array();
        return $document_count;
    }

    public function get_document_list($dbparams) {
        $this->db->flush_cache();
        $document_count = $this->db->query("[docme_document].[list_document] ?,?,?", $dbparams)->result_array();
        return $document_count;
    }

    public function get_title_types($dbparams) {
        $this->db->flush_cache();
        $title_data = $this->db->query("docme_document.get_document_type_master ?", $dbparams)->result_array();
        return $title_data;
    }

    public function save_document_details($DBparams) {
        $this->db->flush_cache();
        $title_data = $this->db->query("docme_document.document_save ?,?,?,?,?,?,?,?,?,?,?,?,?", $DBparams)->result_array();
        return $title_data;
    }

    public function get_file_info($api_key,$student_id,$inst_id,$doc_id,$file_id) {
        $this->db->flush_cache();
        $title_data = $this->db->query("docme_document.get_file_info_for_downlad ?,?,?,?,?", array(
            $api_key,
            $student_id,
            $inst_id,
            $doc_id,
            $file_id
        ))->result_array();
        return $title_data;
    }
    public function get_file_detais($api_key, $doc_id, $student_id, $inst_id) {
        $this->db->flush_cache();
        $title_data = $this->db->query("docme_document.get_file_info_for_remove ?,?,?,?", array(
            $api_key,
            $student_id,
            $inst_id,
            $doc_id           
        ))->result_array();
        return $title_data;
    }
    public function remove_document($api_key, $doc_id, $student_id, $inst_id) {
        $this->db->flush_cache();
        $title_data = $this->db->query("docme_document.remove_document ?,?,?,?", array(
            $api_key,
            $student_id,
            $inst_id,
            $doc_id           
        ))->result_array();
        return $title_data;
    }

}
