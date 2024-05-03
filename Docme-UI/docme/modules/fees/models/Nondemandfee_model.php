<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Non demand fee_model
 *
 * @author chandrajith.edsys
 */
class Nondemandfee_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
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

    public function get_all_class()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $class_data = transport_data_with_param_with_urlencode(array('action' => 'get_class', 'status' => 1, 'inst_id' => $inst_id), $apikey);
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
        $data['action'] = 'get_student_search_list_for_modules';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        return $search_status['data'];
    }

    public function studentadvance_search($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_advancestudent_search_list_for_modules';
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
    public function check_other_fee_code_demanded($feecode_sel, $batch_id, $academic_year, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $batch = transport_data_with_param_with_urlencode(array(
            'action' => 'check_other_fee_code_demanded', 'inst_id' => $inst_id, 'academic_year' => $academic_year, 'batch_id' => $batch_id, 'feecode_id' => $feecode_sel
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

    public function get_other_fee_codes_for_linking()
    {
        $inst_id = $this->session->userdata('inst_id');
        $apikey = $this->session->userdata('API-Key');
        $data_resolved = transport_data_with_param_with_urlencode(
            array(
                'action' => 'get_fee_code',
                'inst_id' => $inst_id,
                'status' => 1,
                'mode' => 'strict',
                'demand_type' => 2
            ),
            $apikey
        );
        if (isset($data_resolved['status']) && !empty($data_resolved['status']) && is_array($data_resolved) && $data_resolved['status'] == true) {
            return $data_resolved['data'];
        } else {
            if (isset($data_resolved['message']) && !empty($data_resolved['message']) && is_array($data_resolved)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data_resolved['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data_resolved,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_other_fee_codes_linked($student_id)
    {
        $inst_id = $this->session->userdata('inst_id');
        $apikey = $this->session->userdata('API-Key');
        $data_resolved = transport_data_with_param_with_urlencode(
            array(
                'action' => 'get_linked_fee_code',
                'inst_id' => $inst_id,
                'student_id' => $student_id
            ),
            $apikey
        );
        if (isset($data_resolved['status']) && !empty($data_resolved['status']) && is_array($data_resolved) && $data_resolved['status'] == true) {
            return $data_resolved['data'];
        } else {
            if (isset($data_resolved['message']) && !empty($data_resolved['message']) && is_array($data_resolved)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data_resolved['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data_resolved,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_other_fee_codes_for_linking_periodic()
    {
        $inst_id = $this->session->userdata('inst_id');
        $apikey = $this->session->userdata('API-Key');
        $data_resolved = transport_data_with_param_with_urlencode(
            array(
                'action' => 'get_fee_code',
                'inst_id' => $inst_id,
                'status' => 1,
                'mode' => 'strict',
                'demand_type' => 1,
                //            'is_module_fee_require'
            ),
            $apikey
        );
        if (isset($data_resolved['status']) && !empty($data_resolved['status']) && is_array($data_resolved) && $data_resolved['status'] == true) {
            return $data_resolved['data'];
        } else {
            if (isset($data_resolved['message']) && !empty($data_resolved['message']) && is_array($data_resolved)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data_resolved['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data_resolved,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_other_fee_allocation_classwise($fee_code_data, $feecode_id, $student_data, $feeamount, $activation_date)
    {
        $inst_id = $this->session->userdata('inst_id');
        $cur_acd_year = $this->session->userdata('acd_year');
        $apikey = $this->session->userdata('API-Key');

        $data = transport_data_with_param_with_urlencode(array(
            'action' => 'save_other_fee_allocation_classwise', 'feecode_id' => $feecode_id, 'fee_code_data' => $fee_code_data, 'student_data' => $student_data, 'feeamount' => $feeamount, 'inst_id' => $inst_id, 'cur_acd_year' => $cur_acd_year, 'activation_date' => $activation_date
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

    public function allocate_non_demand_fee_for_student($data_to_dave)
    {
        //        dev_export($data_to_dave);die;
        $apikey = $this->session->userdata('API-Key');
        $data_resolved = transport_data_with_param_with_urlencode(
            $data_to_dave,
            $apikey
        );
        if (isset($data_resolved['status']) && !empty($data_resolved['status']) && is_array($data_resolved) && $data_resolved['status'] == true) {
            return $data_resolved['data'];
        } else {
            if (isset($data_resolved['message']) && !empty($data_resolved['message']) && is_array($data_resolved)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data_resolved['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data_resolved,
                    'data' => FALSE
                );
            }
        }
    }
    public function allocate_periodic_fee_for_student($data_to_dave)
    {
        //        dev_export($data_to_dave);die;
        $apikey = $this->session->userdata('API-Key');
        $data_resolved = transport_data_with_param_with_urlencode(
            $data_to_dave,
            $apikey
        );
        if (isset($data_resolved['status']) && !empty($data_resolved['status']) && is_array($data_resolved) && $data_resolved['status'] == true) {
            return $data_resolved['data'];
        } else {
            if (isset($data_resolved['message']) && !empty($data_resolved['message']) && is_array($data_resolved)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data_resolved['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data_resolved,
                    'data' => FALSE
                );
            }
        }
    }
}
