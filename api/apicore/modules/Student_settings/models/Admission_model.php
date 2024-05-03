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
class Admission_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_needed_document($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $document_data = $this->db->query("[docme_registration].[admission_documents_proc] ?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($document_data) && is_array($document_data)) {
                if($document_data[0]['ErrorStatus'] == 2){
                    return array('ErrorStatus' => 1, 'ErrorMessage' => $document_data[0]['ErrorMessage']);
                }else{
                    return $document_data;
                }
                
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Document not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Document not added. Please check the data and try again');
        }
    }
    public function get_uploaded_documents($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $document_data = $this->db->query("[docme_registration].[user_documents_proc] ?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($document_data) && is_array($document_data)) {
                return $document_data;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Document not loaded. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Document not loaded. Please check the data and try again');
        }
    }
    public function update_documents($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $document_data = $this->db->query("[docme_registration].[user_documents_proc] ?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($document_data) && is_array($document_data)) {
                return $document_data[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Document not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Document not updated. Please check the data and try again');
        }
    }
    public function save_temp_user_details($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $document_data = $this->db->query("[docme_registration].[user_documents_proc] ?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($document_data) && is_array($document_data)) {
                return $document_data[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Images Are not Submitted. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Images Are not Submitted. Please check the data and try again');
        }
    }
    public function get_temp_user_details($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $document_data = $this->db->query("[docme_registration].[user_documents_proc] ?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($document_data) && is_array($document_data)) {
                return $document_data;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Document not Loaded. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Document not Loaded. Please check the data and try again');
        }
    }
    public function get_temp_timeline_details($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $document_data = $this->db->query("[docme_registration].[user_documents_proc] ?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($document_data) && is_array($document_data)) {
                return $document_data;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Document not Loaded. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Document not Loaded. Please check the data and try again');
        }
    }
    public function get_all_staff_details($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $document_data = $this->db->query("[docme_registration].[get_all_staff_details] ?,?,?,?", $dbparams)->result_array();
            if (!empty($document_data) && is_array($document_data)) {
                return $document_data;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Staff Details not Loaded. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Staff Details not Loaded. Please check the data and try again');
        }
    }
    public function get_all_scheduled_interview_list($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $document_data = $this->db->query("[docme_registration].[interview_scheduled_proc] ?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($document_data) && is_array($document_data)) {
                return $document_data;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Interview list not Loaded. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Interview list not Loaded. Please check the data and try again');
        }
    }
    public function save_interview_schedule($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $document_data = $this->db->query("[docme_registration].[interview_scheduled_proc] ?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($document_data) && is_array($document_data)) {
                return $document_data;
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Interview schedule not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Interview schedule not added. Please check the data and try again');
        }
    }

}
