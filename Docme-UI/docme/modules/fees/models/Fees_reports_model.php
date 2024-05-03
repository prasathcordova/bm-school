<?php

/**
 * Description of Fees_reports_model
 *
 * @author Aju
 */
class Fees_reports_model extends CI_Model
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
    //Common Function for manage function call from controller
    public function report_function_in_model($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function student_search($data)
    { //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_student_search_list_for_reports';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        return $search_status['data'];
    }

    public function studentadvance_search($data)
    { //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_advancestudent_search_list_for_reports';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        return $search_status['data'];
    }
    public function get_daily_collection_voucher_wise_report_data($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_received_non_demandable_report_data($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_individual_collection_report_data($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_collection_class_wise_report_data($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_collection_class_wise_report_data_details($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_collection_user_wise_report_data_details($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_wallet_deposit_details($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_wallet_withdraw_details($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_vat_collection_details($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }

    public function get_voucher_cancellation_report($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }

    public function get_transport_due_list($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        // return $report_data;
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }

    public function get_arrear_list_batch_wise_as_on_date($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_arrear_list_longab_batch_wise_as_on_date($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_individual_dcb_report_data($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }

    public function get_headwise_collection_report_data($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_batch_wise_dcb_report($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        // return $report_data;
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_wallet_statement_details($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_online_pay_details($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_payback_summary_details($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }

    public function get_exemption_data_report($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_concession_students_report($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_fee_concession_details($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
    public function get_arrear_summary($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_data)) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }
}
