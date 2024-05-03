<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of city_model
 *
 * @author chandrajith.edsys
 */
class Documents_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_profiles_student($studentid)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'getstudent_profiledetails';
        $data['studentid'] = $studentid;
        $student_details = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($student_details);die;
        if (is_array($student_details)) {
            return $student_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $student_details,
                'data' => FALSE
            );
        }
    }

    public function get_document_count($student_data, $inst_id)
    {

        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_doc_count';
        $data['student_id'] = $student_data;
        $data['inst_id'] = $inst_id;
        //        dev_export($data);die;
        $doc_details = transport_data_with_param_with_urlencode($data, $apikey);

        if (is_array($doc_details)) {
            return $doc_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $doc_details,
                'data' => FALSE
            );
        }
    }

    public function get_document_list($student_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_doc_list';
        $data['student_id'] = $student_id;
        $data['inst_id'] = $inst_id;
        $doc_details = transport_data_with_param_with_urlencode($data, $apikey);

        if (isset($doc_details['data']) && !empty($doc_details['data'])) {
            return $doc_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $doc_details,
                'data' => FALSE
            );
        }
    }

    public function get_document_type_title()
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_document_types';
        $doc_title_details = transport_data_with_param_with_urlencode($data, $apikey);

        if (isset($doc_title_details['data']) && !empty($doc_title_details['data'])) {
            return $doc_title_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $doc_title_details,
                'data' => FALSE
            );
        }
    }

    public function save_document_student($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_student_document';
        $doc_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($doc_details['data']) && !empty($doc_details['data'])) {
            return $doc_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $doc_details,
                'data' => FALSE
            );
        }
    }
    public function get_file_details_for_view($file_id, $doc_id, $file_name, $student_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = array(
            'action' => 'get_file_info_to_download',
            'file_id' => $file_id,
            'doc_id' => $doc_id,
            'file_name' => $file_name,
            'student_id' => $student_id,
            'inst_id' => $inst_id
        );

        $doc_details = transport_data_with_param_with_urlencode($data, $apikey);

        if (isset($doc_details['data']) && !empty($doc_details['data'])) {
            return $doc_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $doc_details,
                'data' => FALSE
            );
        }
    }
    public function remove_document($doc_id, $student_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = array(
            'action' => 'remove_document',
            'doc_id' => $doc_id,
            'student_id' => $student_id,
            'inst_id' => $inst_id
        );

        $doc_details = transport_data_with_param_with_urlencode($data, $apikey);

        if (isset($doc_details['data']) && !empty($doc_details['data'])) {
            return $doc_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $doc_details,
                'data' => FALSE
            );
        }
    }
}
