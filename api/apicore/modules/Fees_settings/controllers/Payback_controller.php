<?php

/**
 * Description of Pay back_controller
 *
 * @author Aju S Aravind
 */
class Payback_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Payback_model', 'MPayback');
        $this->load->model('Fee_collection_model', 'MFCollection');
    }

    public function get_payback_data($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        $payback_data = $this->MPayback->get_payback_data($inst_id, $acd_year_id, $apikey);

        return array('data_status' => 1, 'data' => $payback_data, 'message' => 'Data loaded');
    }

    public function get_vouchers_for_payback($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        $payback_data = $this->MPayback->get_payback_voucher_data($inst_id, $student_id, $apikey);

        return array('data_status' => 1, 'data' => $payback_data, 'message' => 'Data loaded');
    }

    public function get_vouchers_details_for_payback($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['payment_id']) && !empty($params['payment_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Payment data is required', 'data' => FALSE);
        } else {
            $payment_id = $params['payment_id'];
        }

        $payback_data = $this->MPayback->get_payback_voucher_detail_data($inst_id, $payment_id, $apikey);

        return array('data_status' => 1, 'data' => $payback_data, 'message' => 'Data loaded');
    }

    public function save_payback_request($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        if (!(isset($params['master_id']) && !empty($params['master_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Payment data is required', 'data' => FALSE);
        } else {
            $master_id = $params['master_id'];
        }
        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }
        if (!(isset($params['reason']) && !empty($params['reason']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Reason is required', 'data' => FALSE);
        } else {
            $reason = $params['reason'];
        }
        if (!(isset($params['payback_data']) && !empty($params['payback_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Payback detail data is required', 'data' => FALSE);
        } else {
            $payback_data = $params['payback_data'];
        }
        if (!(isset($params['total_payback_amount']) && !empty($params['total_payback_amount']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Payback detail data is required', 'data' => FALSE);
        } else {
            $total_payback_amount = $params['total_payback_amount'];
        }

        $payback_request_status = $this->MPayback->save_payback_data(array(
            $apikey, $student_id, $master_id, $inst_id, $acd_year_id, $reason, $payback_data, $total_payback_amount
        ));

        if (isset($payback_request_status[0]['DATA_STATUS']) && !empty($payback_request_status[0]['DATA_STATUS']) && $payback_request_status[0]['DATA_STATUS'] == 1) {
            return array('data_status' => 1, 'message' => 'Data updated successfully');
        } else {
            return array('data_status' => 1, 'data' => $payback_request_status);
        }
    }

    public function get_payback_data_for_approval($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['master_id']) && !empty($params['master_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master data is required', 'data' => FALSE);
        } else {
            $master_id = $params['master_id'];
        }

        $payback_data = $this->MPayback->get_payback_data_for_approval($inst_id, $master_id, $apikey);
        $payback_detail_data = $this->MPayback->get_payback_detail_data_for_approval($inst_id, $master_id, $apikey);
        //Bank Details
        $bank_data = $this->MFCollection->get_bank_details_for_processing($inst_id, $apikey);
        if (!(isset($bank_data) && !empty($bank_data) && count($bank_data) > 0)) {
            return array('data_status' => 0, 'message' => 'Critical Error. Cannot get bank details. Please contact administrator to input new bank details');
        }


        return array('data_status' => 1, 'data' => $payback_data, 'message' => 'Data loaded', 'detail_data' => $payback_detail_data, 'bank_details' => $bank_data);
    }

    public function get_payback_data_for_view($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['master_id']) && !empty($params['master_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master data is required', 'data' => FALSE);
        } else {
            $master_id = $params['master_id'];
        }

        $payback_data = $this->MPayback->get_payback_data_for_approval($inst_id, $master_id, $apikey);
        $payback_detail_data = $this->MPayback->get_payback_detail_data_for_approval($inst_id, $master_id, $apikey);

        return array('data_status' => 1, 'data' => $payback_data, 'message' => 'Data loaded', 'detail_data' => $payback_detail_data);
    }

    public function save_payback_approval($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Acd Year is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }
        if (!(isset($params['master_id']) && !empty($params['master_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master data is required', 'data' => FALSE);
        } else {
            $master_id = $params['master_id'];
        }
        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        if (!(isset($params['approve_status']) && !empty($params['approve_status']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Approve data is required', 'data' => FALSE);
        } else {
            $approve_status = $params['approve_status'];
        }
        if (!(isset($params['comments']) && !empty($params['comments']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'comments data is required', 'data' => FALSE);
        } else {
            $comments = $params['comments'];
        }
        $is_cheque = $params['is_cheque'];

        if (!(isset($params['cheque_number']) && !empty($params['cheque_number'])) && $is_cheque == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data is required', 'data' => FALSE);
        } else {
            $cheque_number = $params['cheque_number'];
        }

        if (!(isset($params['cheque_date']) && !empty($params['cheque_date'])) && $is_cheque == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data is required', 'data' => FALSE);
        } else {
            $cheque_date = $params['cheque_date'];
        }

        if (!(isset($params['issued_name']) && !empty($params['issued_name'])) && $is_cheque == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data is required', 'data' => FALSE);
        } else {
            $issued_name = $params['issued_name'];
        }

        if (!(isset($params['bank_id']) && !empty($params['bank_id'])) && $is_cheque == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data is required', 'data' => FALSE);
        } else {
            $bank_id = $params['bank_id'];
        }

        $data_to_approve_reject = array(
            $apikey, $inst_id, $acd_year_id, $student_id, $master_id, $comments
        );
        $data_to_encash = array(
            $apikey, $inst_id, $acd_year_id, $student_id, $master_id, $comments, $is_cheque, $cheque_number, $cheque_date, $issued_name, $bank_id
        );

        if ($approve_status == 'Approve') {
            $request_data_status = $this->MPayback->save_payback_for_approve($data_to_approve_reject);
        } else if ($approve_status == 'Encash') {
            $request_data_status = $this->MPayback->save_payback_for_encashment($data_to_encash);
        } else {
            $request_data_status = $this->MPayback->save_payback_for_reject($data_to_approve_reject);
        }


        if (isset($request_data_status[0]['DATA_STATUS']) && !empty($request_data_status[0]['DATA_STATUS']) && $request_data_status[0]['DATA_STATUS'] == 1) {
            return array('data_status' => 1, 'message' => 'Data updated successfully', 'data' => $request_data_status[0]);
        } else {
            if (isset($request_data_status[0]['ERROR_MESSAGES']) && !empty($request_data_status[0]['ERROR_MESSAGES'])) {
                return array('data_status' => 1, 'message' => $request_data_status[0]['ERROR_MESSAGES']);
            } else {
                return array('data_status' => 1, 'message' => 'An error encountered. Please try again later');
            }
        }
    }
}
