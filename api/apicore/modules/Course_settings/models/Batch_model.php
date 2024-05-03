<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Batch_model
 *
 * @author rahul.shibukumar
 */
class Batch_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save_batch_allocate($xml_data, $batchid, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[save_batch_studuncategorized] ?,?,?", array($apikey, $xml_data, $batchid))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    public function get_batch_details($apikey, $query)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $batch = $this->db->query("[settings].[batch_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $batch = $this->db->query("[settings].[batch_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $batch;
    }

    public function get_batch_details_for_student_id($apikey, $studentid)
    {
        $this->db->flush_cache();
        $batch = $this->db->query("[settings].[batch_select_for_student] ?,?", array($apikey, $studentid))->result_array();

        return $batch;
    }

    public function add_new_batch($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $batch = $this->db->query("[settings].[batch_save] ?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($batch) && is_array($batch)) {
                return $batch[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Batch not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Batch not added. Please check the data and try again');
        }
    }

    public function update_batch_data($dbparams)
    {
        //        dev_export($dbparams);die;
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $batch = $this->db->query("[settings].[batch_update] ?,?,?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            //            dev_export($batch);die;
            if (!empty($batch) && is_array($batch)) {
                return $batch[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Batch not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Batch not updated. Please check the data and try again');
        }
    }
}
