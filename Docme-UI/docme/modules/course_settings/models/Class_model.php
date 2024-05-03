<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Class_model
 *
 * @author Saranya kumar G
 */
class Class_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_class_list() {
        $apikey = $this->session->userdata('API-Key');
        $class_data = transport_data_with_param_with_urlencode(array('action' => 'get_classes'), $apikey);
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

    public function get_all_class() {
        $apikey = $this->session->userdata('API-Key');
        $class_datas = transport_data_with_param_with_urlencode(array('action' => 'get_class_course'), $apikey);
        if (is_array($class_datas)) {
            return $class_datas['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $class_datas,
                'data' => FALSE
            );
        }
    }

    public function get_all_coursename() {
        $apikey = $this->session->userdata('API-Key');
        $course_data = transport_data_with_param_with_urlencode(array('action' => 'get_course_type'), $apikey);
        if (is_array($course_data)) {
            return $course_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $course_data,
                'data' => FALSE
            );
        }
    }

    public function save_class($data) {
        $apikey = $this->session->userdata('API-Key');
        $instid = $this->session->userdata('inst_id');
        $data['action'] = 'save_classes';
        $data['instid'] = $instid;
        $class_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($class_status) && $class_status['status'] == 1) {
            if (is_array($class_status['data']) && $class_status['data']['error_status'] == 0) {
                if ($class_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $class_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $class_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function edit_status_class($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_class_status';
        $class_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($class_status) && $class_status['status'] == 1) {
            if (is_array($class_status['data']) && $class_status['data']['error_status'] == 0) {
                if ($class_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $class_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $class_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function edit_save_class($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_classes';
        $class_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($class_status) && $class_status['status'] == 1) {
            if (is_array($class_status['data']) && $class_status['data']['error_status'] == 0) {
                if ($class_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $class_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => $class_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function get_class_details($course_det_id) {
//        dev_export($course_det_id);die;
        $apikey = $this->session->userdata('API-Key');
        $class_data = transport_data_with_param_with_urlencode(array('action' => 'get_class_course', 'Course_Det_ID' => $course_det_id), $apikey);

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

}
