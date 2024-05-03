<?php

/**
 * Description of Notification_model
 *
 * @author Nizamudeen
 */
class Notification_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_notification_list()
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "testkey";
        }

        $document_data = transport_data_with_param_with_urlencode(array('action' => 'get_all_notification_list', 'controller_function' => 'Notification_settings/Notification_controller/get_all_notification_list', 'notification_status' => 'get_notification_list', 'inst_id' => $this->session->userdata('inst_id')), $apikey);
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
    public function get_notification_list_fordropdown()
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "testkey";
        }

        $document_data = transport_data_with_param_with_urlencode(array('action' => 'get_all_notification_list', 'controller_function' => 'Notification_settings/Notification_controller/get_all_notification_list', 'notification_status' => 'get_notification_list_fordropdown', 'inst_id' => $this->session->userdata('inst_id')), $apikey);
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
    public function get_all_arrear_list()
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "testkey";
        }

        $document_data = transport_data_with_param_with_urlencode(array('action' => 'arrear_list_notification', 'notification_status' => 'get_notification_sms_list', 'month_year' => date('m/Y'), 'controller_function' => 'Notification_settings/Notification_controller/arrear_list_notification', 'inst_id' => $this->session->userdata('inst_id')), $apikey);
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
    public function get_all_arrear_list_byuser_id($checked_temp_ids)
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "testkey";
        }

        $data = [
            'action' => 'arrear_list_notification',
            'controller_function' => 'Notification_settings/Notification_controller/arrear_list_notification',
            'notification_status' => 'get_notification_sms_list_byid',
            'month_year' => date('m/Y'),
            'inst_id' => $this->session->userdata('inst_id'),
            'searchname' => $checked_temp_ids
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
    public function get_all_arrear_list_by_user()
    {
        if ($this->session->userdata('API-Key')) {
            $apikey = $this->session->userdata('API-Key');
        } else {
            $apikey = "testkey";
        }

        $document_data = transport_data_with_param_with_urlencode(array('action' => 'arrear_list_notification', 'notification_status' => 'get_notification_sms_list_user', 'month_year' => date('m/Y'), 'controller_function' => 'Notification_settings/Notification_controller/arrear_list_notification', 'inst_id' => $this->session->userdata('inst_id')), $apikey);
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
    public function add_notification($data)
    {
        $apikey = $this->session->userdata('API-Key');
        //$this->session->userdata('userid')
        $notification_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($notification_data)) {
            return $notification_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $notification_data,
                'data' => FALSE
            );
        }
    }
    public function get_notification_sms_by_id($data)
    {
        $apikey = $this->session->userdata('API-Key');
        //$this->session->userdata('userid')
        $notification_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($notification_data)) {
            return $notification_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $notification_data,
                'data' => FALSE
            );
        }
    }
    public function save_user_messages($data)
    {
        $apikey = $this->session->userdata('API-Key');
        //$this->session->userdata('userid')
        $notification_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($notification_data)) {
            return $notification_data;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $notification_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_stream()
    {
        $apikey = $this->session->userdata('API-Key');
        $stream_data = transport_data_with_param_with_urlencode(array('action' => 'get_stream', 'status' => 1), $apikey);
        if (is_array($stream_data)) {
            return $stream_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $stream_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_class($stream_id = NULL)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $class_data = transport_data_with_param_with_urlencode(array('action' => 'get_class', 'status' => 1, 'inst_id' => $inst_id, 'stream_id' => $stream_id), $apikey);
        if (is_array($class_data)) {
            return $class_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $class_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_acadyr()
    {
        $apikey = $this->session->userdata('API-Key');
        $acd_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_acdyear',
            'status' => 1,
            'mode' => 'strict',
        ), $apikey);
        if (is_array($acd_data)) {
            return $acd_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acd_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_batch($acd_year)
    {
        $apikey = $this->session->userdata('API-Key');
        $batch = transport_data_with_param_with_urlencode(array('action' => 'get_batch', 'status' => 1, 'Acd_Year' => $acd_year), $apikey);
        if (is_array($batch)) {
            return $batch['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch,
                'data' => FALSE
            );
        }
    }
    public function student_search($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['inst_id']               =  $this->session->userdata('inst_id');
        $data['user_id']               =  $this->session->userdata('userid');
        $data['action']                = 'get_student_search_list_for_notification';
        $data['controller_function']   =  'Notification_settings/Notification_controller/arrear_list_notification_filter';
        $data['notification_status']   =  'get_notification_sms_list_user';
        $search_status                 = transport_data_with_param_with_urlencode($data, $apikey);
        return $search_status['data'];
    }

    public function studentadvance_search($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['inst_id']               =  $this->session->userdata('inst_id');
        $data['user_id']               =  $this->session->userdata('userid');
        $data['action']                = 'get_student_search_list_for_notification';
        $data['controller_function']   =  'Notification_settings/Notification_controller/arrear_list_notification_advanced_filter';
        $data['notification_status']   =  'get_notification_sms_list_user_advanced';
        //$data['action'] = 'get_advancestudent_search_list_for_modules';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        return $search_status['data'];
    }
    public function get_batch_data($stream_id, $academic_year, $session_id, $class_id, $flag_status)
    {
        $apikey = $this->session->userdata('API-Key');
        $batch = transport_data_with_param_with_urlencode(array(
            'action' => 'get_batch', 'status' => 1, 'Acd_Year' => $academic_year, 'Stream_ID' => $stream_id,
            'Session_ID' => $session_id, 'Class_Det_ID' => $class_id, 'status_flag' => $flag_status
        ), $apikey);
        if (is_array($batch)) {
            return $batch['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch,
                'data' => FALSE
            );
        }
    }
}
