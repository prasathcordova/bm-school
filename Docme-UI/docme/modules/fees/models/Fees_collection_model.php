<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fees_collection_model
 *
 * @author chandrajith.edsys
 */
class Fees_collection_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_collection_data_by_student($student_id, $inst_id, $acd_year_id, $penalty_date = '')
    {
        if ($penalty_date == '') {
            $penalty_date = date('Y-m-d');
        }
        $data_action = array(
            'action' => 'get_student_fee_data_for_collection',
            'student_id' => $student_id,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'penalty_date' => $penalty_date
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
    //Registration FEE

    public function get_systemparameter_data($data_action)
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

    public function pay_registration_fee($data_action)
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
    public function pay_temp_registration_fee($data_action)
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

    //FEE EXEMPTION

    public function get_exemption_data_of_student($data_action)
    {
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
    public function get_all_feecodes_available($inst_id)
    {
        $data_action = array(
            'action' => 'get_all_feecodes_available',
            'inst_id' => $inst_id
        );
        $apikey = $this->session->userdata('API-Key');
        $feecodes_available = transport_data_with_param_with_urlencode($data_action, $apikey);
        if (isset($feecodes_available['status']) && !empty($feecodes_available['status']) && is_array($feecodes_available) && $feecodes_available['status'] == 1) {
            return $feecodes_available['data'];
        } else {
            if (isset($feecodes_available['message']) && !empty($feecodes_available['message']) && is_array($feecodes_available)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $feecodes_available['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $feecodes_available,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_exemption_requests($data_action)
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
    public function save_exemption_for_approval($data_to_save)
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
    public function save_exemption_wfm_for_md_approval($data_to_save)
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

    public function get_exemption_details($data_action)
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
    public function approve_exemption($data_action)
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

    public function save_transaction_for_fee_payment($data_to_save)
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
    public function save_cheque_transaction_for_fee_payment($data_to_save)
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

    public function save_ewallet_credit_transaction($data_to_save)
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

    public function get_base_data_for_cheque_reconcile($inst_id, $acd_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_base_data_for_cheque_reconcile',
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_id
        ), $apikey);
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

    public function get_base_data_for_cheque_reconcile_search($inst_id, $acd_id, $start_date, $end_date)
    {
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_base_data_for_cheque_reconcile',
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_id,
            'start_date' => $start_date,
            'end_date' => $end_date
        ), $apikey);
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

    public function perform_cheque_reconciliation($inst_id, $acd_id, $master_id, $ops, $remarks)
    {
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode(array(
            'action' => 'save_recon_status_of_cheque',
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_id,
            'master_id' => $master_id,
            'ops' => $ops,
            'remarks' => $remarks
        ), $apikey);
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

    public function get_black_listed_students($inst_id, $acd_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_black_listed_students',
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_id
        ), $apikey);
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

    public function release_blacklisted_students($inst_id, $acd_id, $student_id, $remarks)
    {
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode(array(
            'action' => 'save_blacklist_release',
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_id,
            'student_id' => $student_id,
            'remarks' => $remarks
        ), $apikey);
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

    public function get_wallet_data_by_student($student_id, $inst_id, $acd_year_id, $type = "")
    {
        $data_action = array(
            'action' => 'get_student_wallet_data_for_summary',
            'student_id' => $student_id,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'type' => $type
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

    public function get_withdraw_data_summary($student_id, $inst_id, $acd_year_id)
    {
        $data_action = array(
            'action' => 'get_withdraw_request_list_data_summary',
            'student_id' => $student_id,
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

    public function save_withdraw_request($student_id, $inst_id, $acd_year_id, $amount_to_withdraw, $reason)
    {
        $apikey = $this->session->userdata('API-Key');
        $data_to_save = array(
            'action' => 'save_withdraw_request',
            'student_id' => $student_id,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'transaction_amount' => $amount_to_withdraw,
            'reason' => $reason
        );
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

    public function get_approval_data($master_id, $student_id, $inst_id, $acd_year_id)
    {
        $data_action = array(
            'action' => 'get_approve_data_for_wallet_withdraw',
            'master_id' => $master_id,
            'student_id' => $student_id,
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

    public function save_withdrawal_request_for_wallet($data_to_save)
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

    public function get_encashment_data($master_id, $student_id, $inst_id, $acd_year_id)
    {
        $data_action = array(
            'action' => 'get_encashment_data_for_wallet_withdraw',
            'master_id' => $master_id,
            'student_id' => $student_id,
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

    public function save_withdrawal_encashment_bycash($data_to_save)
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

    public function save_withdrawal_encashment_bycheque($data_to_save)
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

    public function get_view_data($master_id, $student_id, $inst_id, $acd_year_id)
    {
        $data_action = array(
            'action' => 'get_view_data_for_wallet_withdrawal',
            'master_id' => $master_id,
            'student_id' => $student_id,
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

    public function get_voucher_data_for_cancel($student_id, $inst_id, $acd_year_id)
    {
        $data_action = array(
            'action' => 'get_data_for_voucher_cancellation',
            'student_id' => $student_id,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id
        );
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode($data_action, $apikey);
        //        dev_export($collection_data);die;
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

    public function get_voucher_data_for_reprint($student_id, $inst_id, $acd_year_id,$voucher_type='')
    {
        $data_action = array(
            'action' => 'get_data_for_voucher_reprint',
            'student_id' => $student_id,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'voucher_type' => $voucher_type
        );
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode($data_action, $apikey);
        //        dev_export($collection_data);die;
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
    //SALAHUDHEEN JULY 12
    public function get_voucher_details($voucher_id, $inst_id, $acd_year_id, $action, $ptype = "")
    {
        $data_action = array(
            'action'        => $action,
            'voucher_id'    => $voucher_id,
            'inst_id'       => $inst_id,
            'acd_year_id'   => $acd_year_id,
            'ptype'         => $ptype
        );
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode($data_action, $apikey);
        // return $collection_data;
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
    public function get_voucher_details_for_cancellation($voucher_id, $inst_id, $acd_year_id)
    {
        $data_action = array(
            'action' => 'get_data_for_voucher_cancellation_data_by_voucher_id',
            'voucher_id' => $voucher_id,
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

    public function save_voucher_cancellation_by_voucher_id($voucher_id, $inst_id, $acd_year_id, $student_id, $reason)
    {
        $data_action = array(
            'action' => 'save_voucher_cancel',
            'voucher_id' => $voucher_id,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'student_id' => $student_id,
            'reason' => $reason
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

    public function get_fee_counter_collection($inst_id, $acd_year_id, $user_id)
    {
        $data_action = array(
            'action' => 'get_counter_collection_data',
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'user_id' => $user_id
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

    public function studentadvance_search_for_one_time_pay($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_advancestudent_search_list_for_one_time_pay';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        return $search_status['data'];
    }

    public function save_pay_for_one_time_by_wallet($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
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


    public function get_all_voucher_types()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $voucher_data = transport_data_with_param_with_urlencode(array('action' => 'get_voucher_types', 'status' => 1, 'inst_id' => $inst_id), $apikey);
        if (is_array($voucher_data)) {
            return $voucher_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $voucher_data,
                'data' => FALSE
            );
        }
    }

    public function voucher_search($voucher_type, $voucherno)
    {    //display Voucher list on search
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $search_status = transport_data_with_param_with_urlencode(array('action' => 'get_voucher_search', 'voucher_type' => $voucher_type, 'voucherno' => $voucherno, 'inst_id' => $inst_id), $apikey);
        return $search_status['data'];
    }

    //MIS RESPONSE SAVE
    public function save_mis_response($data_to_save)
    {
        $apikey = $this->session->userdata('API-Key');
        $save_status = transport_data_with_param_with_urlencode($data_to_save, $apikey);
        return $save_status;
    }
    public function get_ind_student_details($student_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array(
            'action' => 'getdetails_student_by_id_for_online_pay',
            'student_id' => $student_id,
            'inst_id' => $this->session->userdata('inst_id'),
            'is_fees' => 0
        ), $apikey);

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
    public function set_min_wallet_amount($data_to_save)
    {
        $apikey = $this->session->userdata('API-Key');
        $voucher_data = transport_data_with_param_with_urlencode($data_to_save, $apikey);
        if (is_array($voucher_data)) {
            return $voucher_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $voucher_data,
                'data' => FALSE
            );
        }
    }
}
