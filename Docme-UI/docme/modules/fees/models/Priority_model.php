<?php

/**
 * Description of Priority_model
 *
 * @author Aju S Aravind
 */
class Priority_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_priority_data($inst_id, $acd_year_id)
    {
        $data_action = array(
            'action' => 'get_priority_information',
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id
        );
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode($data_action, $apikey);
        if (isset($collection_data['status']) && !empty($collection_data['status']) && is_array($collection_data) && $collection_data['status'] == true) {
            return $collection_data['data'];
        } else {
            if (isset($collection_data['message']) && !empty($collection_data['message']) && is_array($collection_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_priority_students($data_action)
    {
        $apikey = $this->session->userdata('API-Key');
        $result_data = transport_data_with_param_with_urlencode($data_action, $apikey);
        if (isset($result_data['status']) && !empty($result_data['status']) && is_array($result_data) && $result_data['status'] == 1) {
            return $result_data['data'];
        } else {
            if (isset($result_data['message']) && !empty($result_data['message']) && is_array($result_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $result_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $result_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function apply_student_concession($data_action)
    {
        $apikey = $this->session->userdata('API-Key');
        $result_data = transport_data_with_param_with_urlencode($data_action, $apikey);
        if (isset($result_data['status']) && !empty($result_data['status']) && is_array($result_data) && $result_data['status'] == 1) {
            return $result_data['data'];
        } else {
            if (isset($result_data['message']) && !empty($result_data['message']) && is_array($result_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $result_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $result_data,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_feecode_data($priority_number, $inst_id, $acd_year_id)
    {
        $data_action = array(
            'action' => 'get_priority_information_fee_code_manage',
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'priority_number' => $priority_number
        );
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode($data_action, $apikey);
        if (isset($collection_data['status']) && !empty($collection_data['status']) && is_array($collection_data) && $collection_data['status'] == true) {
            return $collection_data['data'];
        } else {
            if (isset($collection_data['message']) && !empty($collection_data['message']) && is_array($collection_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_feecode_for_priority($data_to_save)
    {
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode($data_to_save, $apikey);
        if (isset($collection_data['status']) && !empty($collection_data['status']) && is_array($collection_data) && $collection_data['status'] == true) {
            return $collection_data['data'];
        } else {
            if (isset($collection_data['message']) && !empty($collection_data['message']) && is_array($collection_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_priority_data_for_staff($inst_id, $acd_year_id)
    {
        $data_action = array(
            'action' => 'get_priority_information_for_staff',
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id
        );
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode($data_action, $apikey);
        if (isset($collection_data['status']) && !empty($collection_data['status']) && is_array($collection_data) && $collection_data['status'] == true) {
            return $collection_data['data'];
        } else {
            if (isset($collection_data['message']) && !empty($collection_data['message']) && is_array($collection_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_feecode_data_for_staff($priority_number, $inst_id, $acd_year_id)
    {
        $data_action = array(
            'action' => 'get_priority_information_fee_code_manage_for_staff',
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'priority_number' => $priority_number
        );
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode($data_action, $apikey);
        if (isset($collection_data['status']) && !empty($collection_data['status']) && is_array($collection_data) && $collection_data['status'] == true) {
            return $collection_data['data'];
        } else {
            if (isset($collection_data['message']) && !empty($collection_data['message']) && is_array($collection_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_feecode_for_priority_for_staff($data_to_save)
    {
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode($data_to_save, $apikey);
        if (isset($collection_data['status']) && !empty($collection_data['status']) && is_array($collection_data) && $collection_data['status'] == true) {
            return $collection_data['data'];
        } else {
            if (isset($collection_data['message']) && !empty($collection_data['message']) && is_array($collection_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data,
                    'data' => FALSE
                );
            }
        }
    }
}
