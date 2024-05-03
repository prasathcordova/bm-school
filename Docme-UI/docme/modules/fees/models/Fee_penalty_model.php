<?php

/**
 * Description of Fee_penalty_model
 *
 * @author aju.docme
 */
class Fee_penalty_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function get_all_fee_code_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $fee_codes = transport_data_with_param_with_urlencode(array('action' => 'get_fee_code', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
        if (isset($fee_codes) && !empty($fee_codes) && is_array($fee_codes)) {
            return $fee_codes['data'];
        } else {
            if (isset($fee_codes['message']) && !empty($fee_codes['message']) && is_array($fee_codes)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_feecodes_for_penalty($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $fee_codes = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($fee_codes) && !empty($fee_codes) && is_array($fee_codes)) {
            return $fee_codes['data'];
        } else {
            if (isset($fee_codes['message']) && !empty($fee_codes['message']) && is_array($fee_codes)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_penalty_data($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $fee_codes = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($fee_codes) && !empty($fee_codes) && is_array($fee_codes)) {
            return $fee_codes['data'];
        } else {
            if (isset($fee_codes['message']) && !empty($fee_codes['message']) && is_array($fee_codes)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_penalty_data($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $fee_codes = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($fee_codes) && !empty($fee_codes) && is_array($fee_codes)) {
            return $fee_codes['data'];
        } else {
            if (isset($fee_codes['message']) && !empty($fee_codes['message']) && is_array($fee_codes)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_fee_code_data($fee_code_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $fee_codes = transport_data_with_param_with_urlencode(array('action' => 'get_fee_code', 'id' => $fee_code_id, 'mode' => 'strict', 'inst_id' => $inst_id), $apikey);
        if (isset($fee_codes) && !empty($fee_codes) && is_array($fee_codes)) {
            return $fee_codes['data'];
        } else {
            if (isset($fee_codes['message']) && !empty($fee_codes['message']) && is_array($fee_codes)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_penalty($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $fee_codes = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($fee_codes);die;
        if (isset($fee_codes) && !empty($fee_codes) && is_array($fee_codes)) {
            return $fee_codes['data'];
        } else {
            if (isset($fee_codes['message']) && !empty($fee_codes['message']) && is_array($fee_codes)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes,
                    'data' => FALSE
                );
            }
        }
    }
    public function update_penalty($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $fee_codes = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($fee_codes);die;
        if (isset($fee_codes) && !empty($fee_codes) && is_array($fee_codes)) {
            return $fee_codes['data'];
        } else {
            if (isset($fee_codes['message']) && !empty($fee_codes['message']) && is_array($fee_codes)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes,
                    'data' => FALSE
                );
            }
        }
    }
    public function change_penalty_status($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $fee_codes = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($fee_codes);die;
        if (isset($fee_codes) && !empty($fee_codes) && is_array($fee_codes)) {
            return $fee_codes['data'];
        } else {
            if (isset($fee_codes['message']) && !empty($fee_codes['message']) && is_array($fee_codes)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_codes,
                    'data' => FALSE
                );
            }
        }
    }
}
