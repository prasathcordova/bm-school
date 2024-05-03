<?php

/**
 * Description of Fee_code_model
 *
 * @author aju.docme
 */
class Fee_code_model extends CI_Model
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
    public function get_term_details_for_feecode($data_action)
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
    public function get_all_demand_type_data()
    {
        $apikey = $this->session->userdata('API-Key');
        $demand_type = transport_data_with_param_with_urlencode(array('action' => 'get_demand_type', 'mode' => 'strict', 'status' => 1), $apikey);
        if (isset($demand_type) && !empty($demand_type) && is_array($demand_type)) {
            return $demand_type['data'];
        } else {
            if (isset($demand_type['message']) && !empty($demand_type['message']) && is_array($demand_type)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $demand_type['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $demand_type,
                    'data' => FALSE
                );
            }
        }
    }

    public function update_fee_code_type($fee_code_id, $status)
    {
        $apikey = $this->session->userdata('API-Key');
        $fee_codes = transport_data_with_param_with_urlencode(array('action' => 'modify_fee_code_status', 'fee_code_id' => $fee_code_id, 'status' => $status), $apikey);

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

    public function save_fee_code_edit($fee_code_data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $fee_codes = transport_data_with_param_with_urlencode(array(
            'action' => 'update_fee_code',
            'fee_code_id' => $fee_code_data['id'],
            'inst_id' => $inst_id,
            'acd_year_id' => $fee_code_data['acd_year_id'],
            'fee_code' => $fee_code_data['fees_code'],
            'desc' => $fee_code_data['description'],
            'fee_shortcode' => $fee_code_data['fee_shortcode'],
            'feeTypeId' => $fee_code_data['feetype_select'],
            'demandFrequencyId' => $fee_code_data['demand_frequency'],
            'accountCodeId' => $fee_code_data['account_code_data'],
            'dueDate' => date('Y-m-d'),
            'demandType' => $fee_code_data['demand_type'],
            'is_vat' => $fee_code_data['is_vat'],
            'vat' => $fee_code_data['vat_percent']
        ), $apikey);
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

    public function save_fee_code_new($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $fee_codes = transport_data_with_param_with_urlencode(
            array(
                'action' => 'save_fee_code',
                'inst_id' => $inst_id,
                'fee_code' => $data['fees_code'],
                'desc' => $data['description'],
                'fee_shortcode' => $data['fee_shortcode'],
                'feeTypeId' => $data['feetype_select'],
                'demandFrequencyId' => $data['demand_frequency'],
                'accountCodeId' => $data['account_code_data'],
                'dueDate' => date('Y-m-d'),
                'demandType' => $data['demand_type'],
                'is_vat' => $data['is_vat'],
                'vat' => $data['vat_percent']
            ),
            $apikey
        );
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

    // Building blocks starts*******

    public function get_all_account_code_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $account_code = transport_data_with_param_with_urlencode(array('action' => 'get_accountcode', 'inst_id' => $inst_id, 'mode' => 'strict', 'status' => 1), $apikey);
        if (isset($account_code) && !empty($account_code) && is_array($account_code)) {
            return $account_code['data'];
        } else {
            if (isset($account_code['message']) && !empty($account_code['message']) && is_array($account_code)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $account_code['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $account_code,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_demand_frequency_data($inst_id, $nondemand = "1")
    {
        $apikey = $this->session->userdata('API-Key');
        $demand_frequency = transport_data_with_param_with_urlencode(array('action' => 'get_demand_frequency', 'inst_id' => $inst_id, 'mode' => 'strict', 'status' => 1, 'nondemand' => $nondemand), $apikey);
        if (isset($demand_frequency) && !empty($demand_frequency) && is_array($demand_frequency)) {
            return $demand_frequency['data'];
        } else {
            if (isset($demand_frequency['message']) && !empty($demand_frequency['message']) && is_array($demand_frequency)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $demand_frequency['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $demand_frequency,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_fee_type_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $account_code = transport_data_with_param_with_urlencode(array('action' => 'get_feetype', 'inst_id' => $inst_id, 'mode' => 'strict', 'status' => 1), $apikey);
        if (isset($account_code) && !empty($account_code) && is_array($account_code)) {
            return $account_code['data'];
        } else {
            if (isset($account_code['message']) && !empty($account_code['message']) && is_array($account_code)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $account_code['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $account_code,
                    'data' => FALSE
                );
            }
        }
    }

    //  Building blocks Ends*******

}
