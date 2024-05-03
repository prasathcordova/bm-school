<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admission_model
 *
 * @author Nizamudeen
 */
class Notification_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_notification_list($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $document_data = $this->db->query("[sms_module].[notification_list_proc] ?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($document_data) && is_array($document_data)) {
                return $document_data;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Notification not loaded. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Notification not loaded. Please check the data and try again');
        }
    }
    public function get_all_notification_single($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $document_data = $this->db->query("[sms_module].[notification_list_proc] ?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($document_data) && is_array($document_data)) {
                return $document_data[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Notification not loaded. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Notification not loaded. Please check the data and try again');
        }
    }
    public function save_user_messages($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $document_data = $this->db->query("[sms_module].[notification_alert_send_details_proc] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($document_data) && is_array($document_data)) {
                return $document_data;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Notification alert not stored. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Notification alert not stored. Please check the data and try again');
        }
    }
    public function arrear_list_notification($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $arrear_data = $this->db->query("[docme_fees].[get_student_list_for_arrear_reminder] ?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($arrear_data) && is_array($arrear_data)) {
                return $arrear_data;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Document not loaded. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Document not loaded. Please check the data and try again');
        }
    }
}
