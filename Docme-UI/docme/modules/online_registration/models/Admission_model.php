<?php

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
    public function get_all_document_list()
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "testkey";
        }

        $document_data = transport_data_with_param_with_urlencode(array('action' => 'get_needed_document', 'controller_function' => 'Student_settings/Admission_controller/get_needed_document'), $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_scheduled_interview_list()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $document_data = transport_data_with_param_with_urlencode(array('action' => 'get_all_scheduled_interview_list', 'controller_function' => 'Student_settings/Admission_controller/get_all_scheduled_interview_list', 'inst_id' => $inst_id), $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function get_admission_documents_for_user()
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "testkey";
        }

        $document_data = transport_data_with_param_with_urlencode(array('action' => 'get_admission_documents_for_user', 'controller_function' => 'Student_settings/Admission_controller/get_admission_documents_for_user'), $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function save_user_details($temp_id, $inst_id, $user_xml)
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "";
        }
        $data = [
            'action' => 'save_temp_user_details',
            'controller_function' => 'Student_settings/Admission_controller/save_temp_user_details',
            'temp_id' => $temp_id,
            'inst_id' => $inst_id,
            'students_image' => $user_xml
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function update_user_details($temp_id, $inst_id, $user_xml)
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "";
        }
        $data = [
            'action' => 'update_temp_user_details',
            'controller_function' => 'Student_settings/Admission_controller/update_temp_user_details',
            'temp_id' => $temp_id,
            'inst_id' => $inst_id,
            'students_image' => $user_xml
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function save_user_details_verified($temp_id, $inst_id, $user_xml)
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "";
        }
        $data = [
            'action' => 'save_user_details',
            'controller_function' => 'Student_settings/Admission_controller/save_user_details',
            'temp_id' => $temp_id,
            'inst_id' => $inst_id,
            'students_image' => $user_xml
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function update_user_details_verified($temp_id, $inst_id, $user_xml)
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "";
        }
        $data = [
            'action' => 'update_user_details',
            'controller_function' => 'Student_settings/Admission_controller/update_user_details',
            'temp_id' => $temp_id,
            'inst_id' => $inst_id,
            'students_image' => $user_xml
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function assign_staff_for_verification($temp_id, $inst_id, $user_xml)
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "";
        }
        $data = [
            'action' => 'assign_staff_for_verification',
            'controller_function' => 'Student_settings/Admission_controller/assign_staff_for_verification',
            'temp_id' => $temp_id,
            'inst_id' => $inst_id,
            'students_image' => $user_xml
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function get_temp_user_details($temp_id, $inst_id)
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "";
        }
        $data = [
            'action' => 'get_temp_user_details',
            'controller_function' => 'Student_settings/Admission_controller/get_temp_user_details',
            'temp_id' => $temp_id,
            'inst_id' => $inst_id
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function get_temp_timeline_details($temp_id)
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "";
        }
        $data = [
            'action' => 'get_temp_timeline_details',
            'controller_function' => 'Student_settings/Admission_controller/get_temp_timeline_details',
            'temp_id' => $temp_id
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function get_uploaded_documents($temp_id, $inst_id)
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "";
        }
        $data = [
            'action' => 'get_uploaded_documents',
            'controller_function' => 'Student_settings/Admission_controller/get_uploaded_documents',
            'temp_id' => $temp_id,
            'inst_id' => $inst_id
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function get_assigned_documents($emp_id, $inst_id)
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "";
        }
        $data = [
            'action' => 'get_assigned_documents',
            'controller_function' => 'Student_settings/Admission_controller/get_assigned_documents',
            'emp_id' => $emp_id,
            'inst_id' => $inst_id
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_staff_details($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = [
            'action' => 'get_all_staff_details',
            'controller_function' => 'Student_settings/Admission_controller/get_all_staff_details',
            'inst_id' => $inst_id
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function get_staff_details($emp_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = [
            'action' => 'get_staff_details',
            'controller_function' => 'Student_settings/Admission_controller/get_staff_details',
            'inst_id' => $inst_id,
            'emp_id' => $emp_id
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function get_documnet_details($doc_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = [
            'action' => 'get_documnet_details',
            'controller_function' => 'Student_settings/Admission_controller/update_documents',
            'inst_id' => $this->session->userdata('inst_id'),
            'document_id' => $doc_id
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function update_documents($temp_id, $inst_id, $document_id, $isverified)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = [
            'action' => 'get_uploaded_documents',
            'controller_function' => 'Student_settings/Admission_controller/update_documents',
            'temp_id' => $temp_id,
            'inst_id' => $inst_id,
            'document_id' => $document_id,
            'isverified' => $isverified,
            'user_id' => $this->session->userdata('userid'),
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function update_documents_bystaff($temp_id, $inst_id, $document_id, $isverified, $emp_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = [
            'action' => 'get_uploaded_documents',
            'controller_function' => 'Student_settings/Admission_controller/update_documents',
            'temp_id' => $temp_id,
            'inst_id' => $inst_id,
            'document_id' => $document_id,
            'isverified' => $isverified,
            'user_id' => $emp_id,
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function update_user_documents_verified($temp_id, $data_accept, $remarks)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = [
            'action' => 'update_user_documents_verified',
            'controller_function' => 'Student_settings/Admission_controller/update_user_documents_verified',
            'temp_id' => $temp_id,
            'isverified' => $data_accept,
            'remarks' => $remarks,
            'user_id' => $this->session->userdata('userid'),
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function update_user_documents_verified_bystaff($temp_id, $data_accept, $remarks, $emp_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = [
            'action' => 'update_user_documents_verified',
            'controller_function' => 'Student_settings/Admission_controller/update_user_documents_verified',
            'temp_id' => $temp_id,
            'isverified' => $data_accept,
            'remarks' => $remarks,
            'user_id' => $emp_id,
        ];

        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function add_documents($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function save_interview_schedule($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function update_interview_scheduled($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $document_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_data)) {
            return $document_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    public function document_change_status($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_document_status';
        $data['controller_function'] = 'Student_settings/Admission_controller/update_document_status';

        $document_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_status) && $document_status['status'] == 1) {
            return $document_status['data'];
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
    public function get_document_byid($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_needed_document_byid';
        $data['controller_function'] = 'Student_settings/Admission_controller/get_needed_document_byid';

        $document_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_status) && $document_status['status'] == 1) {
            return $document_status['data'];
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
    public function update_document_isrequired($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_document_status';
        $data['controller_function'] = 'Student_settings/Admission_controller/update_document_isrequired';

        $document_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($document_status) && $document_status['status'] == 1) {
            return $document_status['data'];
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
