<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fee_structure_model
 *
 * @author chandrajith.edsys
 */
class Fee_structure_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_active_available_template($inst_id, $cur_acd_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $templates = transport_data_with_param_with_urlencode(
            array(
                'action' => 'get_fee_template',
                'status' => 1,
                'inst_id' => $inst_id,
                'mode' => 'strict',
                'acd_year_id' => $cur_acd_id
            ),
            $apikey
        );
        if (isset($templates['status']) && !empty($templates['status']) && is_array($templates) && $templates['status'] == true) {
            return $templates['data'];
        } else {
            if (isset($templates['message']) && !empty($templates['message']) && is_array($templates)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $templates['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $templates,
                    'data' => FALSE
                );
            }
        }
    }

    public function search_template_byname($template_name)
    {
        $inst_id = $this->session->userdata('inst_id');
        $cur_acd_year = $this->session->userdata('acd_year');
        $apikey = $this->session->userdata('API-Key');
        $templates = transport_data_with_param_with_urlencode(
            array(
                'action' => 'get_fee_template',
                'inst_id' => $inst_id,
                'mode' => 'search',
                'status' => 1,
                'template_name' => $template_name,
                'acd_year_id' => $cur_acd_year
            ),
            $apikey
        );
        if (isset($templates['status']) && !empty($templates['status']) && is_array($templates) && $templates['status'] == true) {
            return $templates['data'];
        } else {
            if (isset($templates['message']) && !empty($templates['message']) && is_array($templates)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $templates['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $templates,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_fee_codes_linked($template_id)
    {
        $inst_id = $this->session->userdata('inst_id');
        $apikey = $this->session->userdata('API-Key');
        $templates = transport_data_with_param_with_urlencode(
            array(
                'action' => 'fee_code_linked_with_template',
                'inst_id' => $inst_id,
                'template_id' => $template_id
            ),
            $apikey
        );
        if (isset($templates['status']) && !empty($templates['status']) && is_array($templates) && $templates['status'] == true) {
            return $templates['data'];
        } else {
            if (isset($templates['message']) && !empty($templates['message']) && is_array($templates)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $templates['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $templates,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_fee_codes_for_linking($template_id)
    {
        $inst_id = $this->session->userdata('inst_id');
        $apikey = $this->session->userdata('API-Key');
        $templates = transport_data_with_param_with_urlencode(
            array(
                'action' => 'fee_code_not_linked_to_template',
                'inst_id' => $inst_id,
                'template_id' => $template_id
            ),
            $apikey
        );
        if (isset($templates['status']) && !empty($templates['status']) && is_array($templates) && $templates['status'] == true) {
            return $templates['data'];
        } else {
            if (isset($templates['message']) && !empty($templates['message']) && is_array($templates)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $templates['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $templates,
                    'data' => FALSE
                );
            }
        }
    }

    public function link_fee_code_to_template($data_to_save)
    {
        $apikey = $this->session->userdata('API-Key');
        $link_status = transport_data_with_param_with_urlencode(
            $data_to_save,
            $apikey
        );
        if (isset($link_status['status']) && !empty($link_status['status']) && is_array($link_status) && $link_status['status'] == true) {
            return $link_status['data'];
        } else {
            if (isset($link_status['message']) && !empty($link_status['message']) && is_array($link_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $link_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $link_status,
                    'data' => FALSE
                );
            }
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

    public function get_all_session()
    {
        $apikey = $this->session->userdata('API-Key');
        $session_dta = transport_data_with_param_with_urlencode(array('action' => 'get_session'), $apikey);
        if (is_array($session_dta)) {
            return $session_dta['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $session_dta,
                'data' => FALSE
            );
        }
    }

    public function get_template_allocatted_class($template_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $class_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_class_details_with_linked_template', 'inst_id' => $this->session->userdata('inst_id'), 'template_id' => $template_id
        ), $apikey);

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

    public function get_all_batch_template_allocated($acd_year, $template_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $batch = transport_data_with_param_with_urlencode(array(
            'action' => 'get_batch_details_with_linked_template', 'inst_id' => $this->session->userdata('inst_id'), 'template_id' => $template_id, 'acd_yr_id' => $acd_year
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

    public function get_all_relegion()
    {
        $apikey = $this->session->userdata('API-Key');
        $religion = transport_data_with_param_with_urlencode(array('action' => 'get_religion', 'status' => 1), $apikey);
        if (is_array($religion)) {
            return $religion['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $religion,
                'data' => FALSE
            );
        }
    }

    public function get_batch_data_for_template_allocation($stream_id, $academic_year, $session_id, $class_id, $flag_status)
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

    public function get_student_data($admissionno, $stream_id, $academic_year, $session_id, $class_id, $batch_id, $gender, $religion, $template_id, $nationality)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_students_for_fee_template_allocation', 'status' => 1, 'Acd_Year' => $academic_year, 'Stream_ID' => $stream_id,
            'Session_ID' => $session_id, 'class_id' => $class_id, 'batch_id' => $batch_id, 'gender' => $gender, 'religion' => $religion, 'template_id' => $template_id, 'adminno' => $admissionno, 'nationality' => $nationality
        ), $apikey);

        if (is_array($data)) {
            return $data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $data,
                'data' => FALSE
            );
        }
    }

    public function allocate_students_to_fee_template($template_id, $student_data, $activation_date, $student_data_one_time, $amount_array = [])
    {
        $inst_id = $this->session->userdata('inst_id');
        $cur_acd_year = $this->session->userdata('acd_year');
        $apikey = $this->session->userdata('API-Key');

        $data = transport_data_with_param_with_urlencode(array(
            'action' => 'save_periodic_fee_allocation_with_students', 'template_id' => $template_id, 'student_data' => $student_data, 'student_data_one_time' => $student_data_one_time, 'activation_date' => $activation_date, 'inst_id' => $inst_id, 'cur_acd_year' => $cur_acd_year, 'amount_array' => $amount_array
        ), $apikey);
        // return $data;
        if (is_array($data)) {
            return $data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $data,
                'data' => FALSE
            );
        }
    }

    public function get_bus_fee_demanded_details($student_id, $inst_id, $cur_acd_year)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_bus_fee_demanded_details', 'student_id' => $student_id, 'inst_id' => $inst_id, 'acd_year_id' => $cur_acd_year
        ), $apikey);

        if (is_array($data)) {
            return $data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $data,
                'data' => FALSE
            );
        }
    }

    public function get_student_list($template_id)
    {
        $inst_id = $this->session->userdata('inst_id');
        $cur_acd_year = $this->session->userdata('acd_year');
        $apikey = $this->session->userdata('API-Key');
        $data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_student_list_with_fee_allocated', 'template_id' => $template_id, 'inst_id' => $inst_id, 'acd_year_id' => $cur_acd_year
        ), $apikey);

        if (is_array($data)) {
            return $data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $data,
                'data' => FALSE
            );
        }
    }

    public function de_allocate_students($template_id, $student_data)
    {
        $inst_id = $this->session->userdata('inst_id');
        $cur_acd_year = $this->session->userdata('acd_year');
        $apikey = $this->session->userdata('API-Key');
        //        dev_export($student_data);die;
        $data = transport_data_with_param_with_urlencode(array(
            'action' => 'save_de_allocation_of_students_from_template', 'template_id' => $template_id, 'inst_id' => $inst_id, 'acd_year_id' => $cur_acd_year, 'student_data' => $student_data
        ), $apikey);

        if (is_array($data)) {
            return $data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $data,
                'data' => FALSE
            );
        }
    }
}
