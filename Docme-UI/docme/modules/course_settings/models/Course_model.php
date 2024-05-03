<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Course_model
 *
 * @author chandrajith.edsys
 */
class Course_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save_batch_allocate($batchid, $batch_data)
    {

        $apikey = $this->session->userdata('API-Key');
        $data = array(
            'action' => 'save_batch_allocate',
            'batch_data' => $batch_data,
            'batchid' => $batchid
        );
        $status_data = transport_data_with_param_with_formdata($data, $apikey);
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }


    public function get_all_course_list()
    {
        $apikey = $this->session->userdata('API-Key');

        $course_data = transport_data_with_param_with_urlencode(array('action' => 'get_course'), $apikey);

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
    //batch allcoation
    public function get_all_class_list()
    {
        $apikey = $this->session->userdata('API-Key');

        $class_data = transport_data_with_param_with_urlencode(array('action' => 'get_class'), $apikey);

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
    public function get_all_acd_year()
    {
        $apikey = $this->session->userdata('API-Key');

        $acdyear_data = transport_data_with_param_with_urlencode(array('action' => 'get_acdyear', 'status' => 1), $apikey);

        if (is_array($acdyear_data)) {
            return $acdyear_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acdyear_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_streamdata()
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

    public function get_all_sessiondata()
    {
        $apikey = $this->session->userdata('API-Key');

        $session_data = transport_data_with_param_with_urlencode(array('action' => 'get_session'), $apikey);

        if (is_array($session_data)) {
            return $session_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $session_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_studentdata($acd_year_id, $batchid, $courseid = 0)
    {
        //        dev_export($batchid);die;
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array('action' => 'getdetails_student', 'acd_year' => $acd_year_id, 'batchid' => $batchid, 'status_flag' => 5, 'courseid' => $courseid), $apikey);
        //        dev_export($student_data);die;
        if (is_array($student_data)) {
            return $student_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $student_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_batchdata($courseid, $sessionid, $streamid, $acd_year_id)
    {
        //        dev_export($batchid);die;
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array('action' => 'get_batch', 'Class_Det_ID' => $courseid, 'Session_ID' => $sessionid, 'Stream_ID' => $streamid, 'Acd_Year' => $acd_year_id), $apikey);
        //        dev_export($student_data);die;
        if (is_array($student_data)) {
            return $student_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $student_data,
                'data' => FALSE
            );
        }
    }



    //batch allocation end
    public function get_course_details($Course_Master_ID)
    {
        $apikey = $this->session->userdata('API-Key');
        $course_data = transport_data_with_param_with_urlencode(array('action' => 'get_course', 'id' => $Course_Master_ID), $apikey); 
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

    public function get_course($Course_Master_ID)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $course_data = transport_data_with_param_with_urlencode(array('action' => 'get_classes', 'Course_Det_ID' => $Course_Master_ID), $apikey); 
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

    public function edit_save_course($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_course';
        $country_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($country_status) && $country_status['status'] == 1) {
            if (is_array($country_status['data']) && $country_status['data']['error_status'] == 0) {
                if ($country_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $country_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => $country_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function get_all_category_list()
    {
        $apikey = $this->session->userdata('API-Key');

        $category_data = transport_data_with_param_with_urlencode(array('action' => 'get_course_category'), $apikey);

        if (is_array($category_data)) {
            return $category_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $category_data,
                'data' => FALSE
            );
        }
    }

    public function save_course($data)
    {
        $apikey = $this->session->userdata('API-Key');


        $data['action'] = 'save_course';
        $course_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($course_status) && $course_status['status'] == 1) {
            if (is_array($course_status['data']) && $course_status['data']['error_status'] == 0) {
                if ($course_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $course_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $course_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function edit_status_course($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_course_status';
        $course_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($course_status) && $course_status['status'] == 1) {
            if (is_array($course_status['data']) && $course_status['data']['error_status'] == 0) {
                if ($course_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $course_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed  ");
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    // active count
    public function get_active_count()
    {
        $apikey = $this->session->userdata('API-Key');

        $count_data = transport_data_with_param_with_urlencode(array('action' => 'get_active'), $apikey);

        if (is_array($count_data)) {
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }
}
