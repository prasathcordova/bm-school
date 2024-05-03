<?php

/**
 * Description of Fee_collection_controller
 *
 * @author aju.docme
 */
class Fee_collection_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::__construct();
        $this->load->model('Fee_collection_model', 'MFCollection');
        $this->load->model('Fee_structure_model', 'MFeeStructure');
    }
    public function get_systemparameter_data($params)
    {
        $apikey = $params['API_KEY'];
        $inst_id = $params['inst_id'];
        $system_parameter_data = $this->MFeeStructure->get_system_data_for_processing($inst_id, $apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loading success', 'data' => $system_parameter_data);
    }
    public function get_student_fee_data_for_collection($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        if (!(isset($params['penalty_date']) && !empty($params['penalty_date']))) {
            $penalty_date = date('Y-m-d');
        } else {
            $penalty_date = $params['penalty_date'];
        }
        //System parameter data
        $system_parameter_data = $this->MFeeStructure->get_system_data_for_processing($inst_id, $apikey);
        if (!(isset($system_parameter_data) && !empty($system_parameter_data) && count($system_parameter_data) > 0)) {
            return array('data_status' => 0, 'message' => 'Critical Error. Cannot get system parameters. Please contact administrator');
        }
        $is_card_service_charge = 0;
        $card_service_charge = 0;
        foreach ($system_parameter_data as $value) {
            if ($value['Code'] == 'IS_CARD_SERVICE_CHARGE') {
                $is_card_service_charge = $value['Code_Value'];
            }
            if ($value['Code'] == 'CARD_SERVICE_CHARGE') {
                $card_service_charge = $value['Code_Value'];
            }
        }
        if ($is_card_service_charge == 0) {
            $card_service_charge = 0;
        }
        //Bank Details
        $bank_data = $this->MFCollection->get_bank_details_for_processing($inst_id, $apikey);
        if (!(isset($bank_data) && !empty($bank_data) && count($bank_data) > 0)) {
            return array('data_status' => 0, 'message' => 'Critical Error. Cannot get bank details. Please contact administrator to input new bank details');
        }
        //Penalty Details
        $penalty_data = $this->MFCollection->get_penalty_details($inst_id, $apikey, $penalty_date);
        $term_data = $this->MFCollection->get_term_details($apikey, $inst_id, $acd_year_id);
        // return $penalty_data;
        // if (!(isset($penalty_data) && !empty($penalty_data) && count($penalty_data) > 0)) {
        //     return array('data_status' => 0, 'message' => 'Critical Error. Cannot get Penalty details. Please contact administrator to add penalty Details');
        // }
        $collection_data = $this->MFCollection->get_collection_data_of_student($student_id, $inst_id, $acd_year_id, $apikey);
        if (isset($collection_data) && !empty($collection_data) && is_array($collection_data)) {
            $demandedfeecodes = array();
            foreach ($collection_data as $cdata) {
                if (!in_array($cdata['FEECODE'], $demandedfeecodes)) {
                    //array_push($demandedfeecodes, $cdata['FEECODE']);
                    $demandedfeecodes[] = $cdata['FEECODE'];
                }
            }
        }
        $total_amt_data = $this->MFCollection->get_collection_data_of_student_sum($student_id, $inst_id, $acd_year_id, $apikey);
        $black_list_data_raw = $this->MFCollection->get_blacklist_data_of_student($student_id, $inst_id, $acd_year_id, $apikey);
        $is_blacklist_data = 0;
        if (isset($black_list_data_raw[0]['DATA_STATUS']) && !empty($black_list_data_raw[0]['DATA_STATUS'])) {
            $black_list_data = $black_list_data_raw[0]['BLACK_LIST_DATA'];
            $is_blacklist_data = 1;
        } else {
            $black_list_data = 0;
        }
        if (isset($total_amt_data) && !empty($total_amt_data) && is_array($total_amt_data)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Data loaded successfully',
                'data' => $collection_data,
                'is_black_list_data' => $is_blacklist_data,
                'black_list_data' => $black_list_data,
                'summary_data' => $total_amt_data[0],
                'card_service_charge' => $card_service_charge,
                'bank_details' => $bank_data,
                'penalty_details' => $penalty_data,
                'term_details' => $term_data,
                'demandedfeecodes' => $demandedfeecodes
            );
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loading failed or no data available', 'data' => $collection_data);
        }
    }

    public function save_fee_payment_for_student($params)
    {
        $apikey = $params['API_KEY'];

        $ch_number = '';
        $ch_date = '';
        $name_of_drawee = '';
        $address_of_drawee = '';
        $name_of_bank = '';
        $bank_branch_name = '';

        $card_number = '';
        $name_on_card = '';

        $reference_number = '';
        $reference_date = '';

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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        if (!(isset($params['amount_paid']) && !empty($params['amount_paid']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Amount data is required', 'data' => FALSE);
        } else {
            $amount_paid = $params['amount_paid'];
        }

        $round_off = $params['round_off'];
        $total_penalty = $params['total_penalty'];

        if (!(isset($params['payment_data']) && !empty($params['payment_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Payment data is required', 'data' => FALSE);
        } else {
            $payment_data = $params['payment_data'];
        }
        if (!(isset($params['mode_of_payment']) && !empty($params['mode_of_payment']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Mode of payment data is required', 'data' => FALSE);
        } else {
            $mode_of_payment = $params['mode_of_payment'];
        }
        // if (!(isset($params['service_charge']) && !empty($params['service_charge']))) {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service charge data is required', 'data' => FALSE);
        // } else {
        //     if ($params['service_charge'] == -1) {
        //         $service_charge = 0;
        //     } else {
        //         $service_charge = $params['service_charge'];
        //     }
        // }
        if ($params['service_charge'] == -1) {
            $service_charge = 0;
        } else {
            $service_charge = $params['service_charge'];
        }
        $surcharge_for_excess_amount = $params['surcharge_for_excess_amount'];
        if (!(isset($params['total_voucher_amount']) && !empty($params['total_voucher_amount']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Voucher amount data is required', 'data' => FALSE);
        } else {
            if ($params['total_voucher_amount'] == -1) {
                $total_voucher_amount = 0;
            } else {
                $total_voucher_amount = $params['total_voucher_amount'];
            }
        }
        if (!(isset($params['total_vat_amount_paid']) && !empty($params['total_vat_amount_paid']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Voucher vat amount data is required', 'data' => FALSE);
        } else {
            if ($params['total_vat_amount_paid'] == -1) {
                $total_vat_amount_paid = 0;
            } else {
                $total_vat_amount_paid = $params['total_vat_amount_paid'];
            }
        }
        if (!(isset($params['is_excess']) && !empty($params['is_excess']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Excess amount data is required', 'data' => FALSE);
        } else {
            if ($params['is_excess'] == -1) {
                $is_excess = 0;
            } else {
                $is_excess = $params['is_excess'];
            }
        }
        if (!(isset($params['excess_amt']) && !empty($params['excess_amt']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Excess amount data is required', 'data' => FALSE);
        } else {
            if ($params['excess_amt'] == -1) {
                $excess_amt = 0;
            } else {
                $excess_amt = $params['excess_amt'];
            }
        }

        if ($mode_of_payment == 'Q') {
            if (!(isset($params['ChequeNumber']) && !empty($params['ChequeNumber']))) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data(number) is required', 'data' => FALSE);
            } else {
                $ch_number = $params['ChequeNumber'];
            }
            if (!(isset($params['ChequeDate']) && !empty($params['ChequeDate']))) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data(date) is required', 'data' => FALSE);
            } else {
                $ch_date = $params['ChequeDate'];
            }
            if (!(isset($params['NameofDrawer']) && !empty($params['NameofDrawer']))) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data(Name) is required', 'data' => FALSE);
            } else {
                $name_of_drawee = $params['NameofDrawer'];
            }
            if (!(isset($params['DrawerAddress']) && !empty($params['DrawerAddress']))) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data(Address) is required', 'data' => FALSE);
            } else {
                $address_of_drawee = $params['DrawerAddress'];
            }
            if (!(isset($params['NameofBank']) && !empty($params['NameofBank']))) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data(Name of Bank) is required', 'data' => FALSE);
            } else {
                $name_of_bank = $params['NameofBank'];
            }
            if (!(isset($params['BranchBank']) && !empty($params['BranchBank']))) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data(Bank Branch) is required', 'data' => FALSE);
            } else {
                $bank_branch_name = $params['BranchBank'];
            }
        }
        if ($mode_of_payment == 'D') {
            if (!(isset($params['reference_number']) && !empty($params['reference_number']))) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Reference Number required', 'data' => FALSE);
            } else {
                $reference_number = $params['reference_number'];
            }
            if (!(isset($params['referenceDate']) && !empty($params['referenceDate']))) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Reference Date is required', 'data' => FALSE);
            } else {
                $reference_date = $params['referenceDate'];
            }
        }

        if ($mode_of_payment == 'R') {
            if (!(isset($params['NameOfCard']) && !empty($params['NameOfCard']))) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Name as on card is required', 'data' => FALSE);
            } else {
                $name_on_card = $params['NameOfCard'];
            }
            if (!(isset($params['CardNumber']) && !empty($params['CardNumber']))) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Card Number is required', 'data' => FALSE);
            } else {
                $card_number = $params['CardNumber'];
            }
        }
        if (!(isset($params['transaction_ID']) && !empty($params['transaction_ID']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Transaction ID required', 'data' => FALSE);
        } else {
            $transaction_ID = $params['transaction_ID'];
        }

        $data_to_save = array(
            'api_key' => $apikey,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'student_id' => $student_id,
            'amount_paid' => $amount_paid,
            'round_off' => $round_off,
            'total_penalty' => $total_penalty,
            'payment_data' => $payment_data,
            'mode_of_payment' => $mode_of_payment,
            'service_charge' => $service_charge,
            'surcharge_for_excess_amount' => $surcharge_for_excess_amount,
            'count_of_feecode' => count(json_decode($payment_data, TRUE)),
            'total_voucher_amount' => $total_voucher_amount,
            'total_vat_amount' => $total_vat_amount_paid,
            'is_excess' => $is_excess,
            'excess_amount' => $excess_amt,
            'ch_number' => $ch_number,
            'ch_date' => $ch_date,
            'account_holder_name' => $name_of_drawee,
            'address' => $address_of_drawee,
            'name_of_bank' => $name_of_bank,
            'bank_branch' => $bank_branch_name,
            'name_on_card' => $name_on_card,
            'card_number' => $card_number,
            'reference_number' => $reference_number,
            'reference_date' => $reference_date,
            'transaction_ID' => $transaction_ID
        );

        $collection_data = $this->save_fee_payment($data_to_save);
        // return $collection_data;

        if (isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Data created/modified successfully',
                'data' => $collection_data[0],
            );
        } else {
            if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $collection_data[0]['message']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data creation / updation failed or no data available');
            }
        }
    }

    private function save_fee_payment($data_to_save)
    {
        if ($data_to_save['mode_of_payment'] == 'C') {
            $data = array(
                $data_to_save['api_key'],
                $data_to_save['inst_id'],
                $data_to_save['acd_year_id'],
                $data_to_save['student_id'],
                $data_to_save['amount_paid'],
                $data_to_save['round_off'],
                $data_to_save['total_penalty'],
                $data_to_save['payment_data'],
                $data_to_save['service_charge'],
                $data_to_save['count_of_feecode'],
                $data_to_save['total_voucher_amount'],
                $data_to_save['total_vat_amount'],
                $data_to_save['is_excess'],
                $data_to_save['excess_amount'],
                $data_to_save['transaction_ID']
            );
            $collection_data = $this->MFCollection->save_collection_data_of_student_by_cash($data);
            return $collection_data;
        } else if ($data_to_save['mode_of_payment'] == 'Q') {
            $data = array(
                $data_to_save['api_key'],
                $data_to_save['inst_id'],
                $data_to_save['acd_year_id'],
                $data_to_save['student_id'],
                $data_to_save['amount_paid'],
                $data_to_save['round_off'],
                $data_to_save['total_penalty'],
                $data_to_save['payment_data'],
                $data_to_save['service_charge'],
                $data_to_save['count_of_feecode'],
                $data_to_save['total_voucher_amount'],
                $data_to_save['total_vat_amount'],
                $data_to_save['is_excess'],
                $data_to_save['excess_amount'],
                $data_to_save['ch_number'],
                $data_to_save['ch_date'],
                $data_to_save['account_holder_name'],
                $data_to_save['address'],
                $data_to_save['name_of_bank'],
                $data_to_save['bank_branch'],
                $data_to_save['transaction_ID']
            );
            $collection_data = $this->MFCollection->save_collection_data_of_student_by_cheque($data);
            return $collection_data;
        } else if ($data_to_save['mode_of_payment'] == 'D') {
            $data = array(
                $data_to_save['api_key'],
                $data_to_save['inst_id'],
                $data_to_save['acd_year_id'],
                $data_to_save['student_id'],
                $data_to_save['amount_paid'],
                $data_to_save['round_off'],
                $data_to_save['total_penalty'],
                $data_to_save['payment_data'],
                $data_to_save['service_charge'],
                $data_to_save['count_of_feecode'],
                $data_to_save['total_voucher_amount'],
                $data_to_save['total_vat_amount'],
                $data_to_save['is_excess'],
                $data_to_save['excess_amount'],
                $data_to_save['reference_number'],
                $data_to_save['reference_date'],
                $data_to_save['transaction_ID']
            );
            $collection_data = $this->MFCollection->save_collection_data_of_student_by_dbt($data);
            return $collection_data;
        } else if ($data_to_save['mode_of_payment'] == 'R') {
            $data = array(
                $data_to_save['api_key'],
                $data_to_save['inst_id'],
                $data_to_save['acd_year_id'],
                $data_to_save['student_id'],
                $data_to_save['amount_paid'],
                $data_to_save['round_off'],
                $data_to_save['total_penalty'],
                $data_to_save['payment_data'],
                $data_to_save['service_charge'],
                $data_to_save['surcharge_for_excess_amount'],
                $data_to_save['count_of_feecode'],
                $data_to_save['total_voucher_amount'],
                $data_to_save['total_vat_amount'],
                $data_to_save['is_excess'],
                $data_to_save['excess_amount'],
                $data_to_save['card_number'],
                $data_to_save['transaction_ID']
            );
            $collection_data = $this->MFCollection->save_collection_data_of_student_by_card($data);
            return $collection_data;
        } else if ($data_to_save['mode_of_payment'] == 'T') {
            $data = array(
                $data_to_save['api_key'],
                $data_to_save['inst_id'],
                $data_to_save['acd_year_id'],
                $data_to_save['student_id'],
                $data_to_save['amount_paid'],
                $data_to_save['round_off'],
                $data_to_save['total_penalty'],
                $data_to_save['payment_data'],
                $data_to_save['service_charge'],
                $data_to_save['count_of_feecode'],
                $data_to_save['total_voucher_amount'],
                $data_to_save['total_vat_amount'],
                $data_to_save['transaction_ID']
            );
            $collection_data = $this->MFCollection->save_collection_data_of_student_by_wallet($data);
            return $collection_data;
        }
    }

    public function save_wallet_amount_for_student_bycash($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        if (!(isset($params['excess_type']) && !empty($params['excess_type']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Excess Type data is required', 'data' => FALSE);
        } else {
            $excess_type = $params['excess_type'];
        }
        if (!(isset($params['excess_amt']) && !empty($params['excess_amt']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Excess amount data is required', 'data' => FALSE);
        } else {
            if ($params['excess_amt'] == -1) {
                $excess_amt = 0;
            } else {
                $excess_amt = $params['excess_amt'];
            }
        }
        $data_to_save = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $student_id,
            $excess_amt,
            $excess_type
        );
        $collection_data = $this->MFCollection->save_ewallet_amount_data_of_student_bycash($data_to_save);

        if (isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Data created/modified successfully',
                'data' => $collection_data[0],
            );
        } else {
            if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $collection_data[0]['message']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data creation / updation failed or no data available');
            }
        }
    }

    public function save_wallet_amount_for_student_bycheque($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        if (!(isset($params['excess_type']) && !empty($params['excess_type']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Excess Type data is required', 'data' => FALSE);
        } else {
            $excess_type = $params['excess_type'];
        }
        if (!(isset($params['excess_amt']) && !empty($params['excess_amt']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Excess amount data is required', 'data' => FALSE);
        } else {
            if ($params['excess_amt'] == -1) {
                $excess_amt = 0;
            } else {
                $excess_amt = $params['excess_amt'];
            }
        }

        if (!(isset($params['ch_number']) && !empty($params['ch_number']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque number is required', 'data' => FALSE);
        } else {
            $ch_number = $params['ch_number'];
        }
        if (!(isset($params['ch_date']) && !empty($params['ch_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque date is required', 'data' => FALSE);
        } else {
            $ch_date = $params['ch_date'];
        }
        if (!(isset($params['ch_account_holder_name']) && !empty($params['ch_account_holder_name']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Account holder name is required', 'data' => FALSE);
        } else {
            $ch_account_holder_name = $params['ch_account_holder_name'];
        }
        if (!(isset($params['ch_address']) && !empty($params['ch_address']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque address is required', 'data' => FALSE);
        } else {
            $ch_address = $params['ch_address'];
        }
        if (!(isset($params['ch_bank_id']) && !empty($params['ch_bank_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque bank ID is required', 'data' => FALSE);
        } else {
            $ch_bank_id = $params['ch_bank_id'];
        }
        if (!(isset($params['branch_name']) && !empty($params['branch_name']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Bank branch name is required', 'data' => FALSE);
        } else {
            $ch_branch_name = $params['branch_name'];
        }

        $data_to_save = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $student_id,
            $excess_amt,
            $excess_type,
            $ch_number,
            $ch_date,
            $ch_account_holder_name,
            $ch_address,
            $ch_bank_id,
            $ch_branch_name
        );
        $collection_data = $this->MFCollection->save_ewallet_amount_data_of_student_bycheque($data_to_save);

        if (isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Data created/modified successfully',
                'data' => $collection_data[0],
            );
        } else {
            if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $collection_data[0]['message']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data creation / updation failed or no data available');
            }
        }
    }

    public function save_wallet_amount_for_student_bycard($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        if (!(isset($params['excess_type']) && !empty($params['excess_type']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Excess Type data is required', 'data' => FALSE);
        } else {
            $excess_type = $params['excess_type'];
        }
        if (!(isset($params['excess_amt']) && !empty($params['excess_amt']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Excess amount data is required', 'data' => FALSE);
        } else {
            if ($params['excess_amt'] == -1) {
                $excess_amt = 0;
            } else {
                $excess_amt = $params['excess_amt'];
            }
        }
        // if (!(isset($params['service_charge']) && !empty($params['service_charge']))) {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service charge data is required', 'data' => FALSE);
        // } else {
        $service_charge = $params['service_charge'];
        // }
        if (!(isset($params['card_number']) && !empty($params['card_number']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Card number is required', 'data' => FALSE);
        } else {
            $card_number = $params['card_number'];
        }
        if (!(isset($params['name_on_card']) && !empty($params['name_on_card']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Name as on card is required', 'data' => FALSE);
        } else {
            $name_on_card = $params['name_on_card'];
        }


        $data_to_save = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $student_id,
            $excess_amt,
            $excess_type,
            $service_charge,
            $card_number,
            $name_on_card
        );
        $collection_data = $this->MFCollection->save_ewallet_amount_data_of_student_bycard($data_to_save);

        if (isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Data created/modified successfully',
                'data' => $collection_data[0],
            );
        } else {
            if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $collection_data[0]['message']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data creation / updation failed or no data available');
            }
        }
    }
    public function save_wallet_amount_for_student_bydbt($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        if (!(isset($params['excess_type']) && !empty($params['excess_type']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Excess Type data is required', 'data' => FALSE);
        } else {
            $excess_type = $params['excess_type'];
        }
        if (!(isset($params['excess_amt']) && !empty($params['excess_amt']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Excess amount data is required', 'data' => FALSE);
        } else {
            if ($params['excess_amt'] == -1) {
                $excess_amt = 0;
            } else {
                $excess_amt = $params['excess_amt'];
            }
        }
        if (!(isset($params['referenceDate']) && !empty($params['referenceDate']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Payment Date is required', 'data' => FALSE);
        } else {
            $referenceDate = $params['referenceDate'];
        }
        if (!(isset($params['reference_number']) && !empty($params['reference_number']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Reference No. is required', 'data' => FALSE);
        } else {
            $reference_number = $params['reference_number'];
        }


        $data_to_save = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $student_id,
            $excess_amt,
            $excess_type,
            $reference_number,
            $referenceDate
        );
        $collection_data = $this->MFCollection->save_ewallet_amount_data_of_student_bydbt($data_to_save);

        if (isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Data created/modified successfully',
                'data' => $collection_data[0],
            );
        } else {
            if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $collection_data[0]['message']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data creation / updation failed or no data available');
            }
        }
    }

    public function get_base_data_for_cheque_reconcile($params)
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
        if ((isset($params['start_date']) && !empty($params['start_date']))) {
            $start_date = $params['start_date'];
        } else {
            $start_date = '';
        }
        if ((isset($params['end_date']) && !empty($params['end_date']))) {
            $end_date = $params['end_date'];
        } else {
            $end_date = '';
        }
        $collection_data = $this->MFCollection->get_base_data_for_cheque_reconcile($apikey, $inst_id, $acd_year_id, $start_date, $end_date);

        if (isset($collection_data[0]['CHQ_DATA']) && !empty($collection_data[0]['CHQ_DATA'])) {
            return array('data_status' => 1, 'error_status' => 0, 'data' => $collection_data, 'data_count' => count(json_decode($collection_data[0]['CHQ_DATA'], TRUE)) > 0);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => NULL, 'data_count' => 0);
        }
    }

    public function save_recon_status_of_cheque($params)
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
        if ((isset($params['master_id']) && !empty($params['master_id']))) {
            $master_id = $params['master_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master ID is required', 'data' => FALSE);
        }
        if ((isset($params['ops']) && !empty($params['ops']))) {
            $ops = $params['ops'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'OPS is required', 'data' => FALSE);
        }
        if ((isset($params['remarks']) && !empty($params['remarks']))) {
            $remarks = $params['remarks'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Remarks is required', 'data' => FALSE);
        }
        $recon_status = $this->MFCollection->recon_cheque_data($apikey, $inst_id, $acd_year_id, $master_id, $ops, $remarks);
        if (isset($recon_status[0]['DATA_STATUS']) && !empty($recon_status[0]['DATA_STATUS']) && $recon_status[0]['DATA_STATUS'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'data' => $recon_status, 'message' => $recon_status[0]['ErrorMessage'], 'recon_voucher' => $recon_status[0]['RECON_VOUCHER'], 'recon_wallet_voucher' => $recon_status[0]['EWALLET_VOUCHER_NUMBER']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'data' => NULL, 'message' => 'Cheque reconcilation failed. For further assistance, please contact administrator');
        }
    }

    public function get_black_listed_students($params)
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

        $collection_data = $this->MFCollection->get_blacklisted_students_data($apikey, $inst_id, $acd_year_id);

        if (isset($collection_data[0]['BL_DATA']) && !empty($collection_data[0]['BL_DATA'])) {
            return array('data_status' => 1, 'error_status' => 0, 'data' => $collection_data, 'data_count' => count(json_decode($collection_data[0]['BL_DATA'], TRUE)) > 0);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => NULL, 'data_count' => 0);
        }
    }

    public function save_blacklist_release($params)
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
        if ((isset($params['student_id']) && !empty($params['student_id']))) {
            $student_id = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        }
        if ((isset($params['remarks']) && !empty($params['remarks']))) {
            $remarks = $params['remarks'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Remarks is required', 'data' => FALSE);
        }
        $release_status = $this->MFCollection->release_blacklist_students($apikey, $inst_id, $acd_year_id, $student_id, $remarks);
        if (isset($release_status[0]['DATA_STATUS']) && !empty($release_status[0]['DATA_STATUS']) && $release_status[0]['DATA_STATUS'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'data' => $release_status, 'message' => $release_status[0]['ErrorMessage']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'data' => NULL, 'message' => 'Student release from blacklist failed. For further assistance, please contact administrator');
        }
    }

    public function get_student_wallet_data_for_summary($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        $type = $params['type']; // Wallet Statement or Deposit
        if ($type == 'statement') {
            $wallet_statement_data = $this->MFCollection->get_wallet_statement_of_student($student_id, $inst_id, $acd_year_id, $apikey);
            if (isset($wallet_statement_data) && !empty($wallet_statement_data) && is_array($wallet_statement_data)) {
                return array(
                    'data_status' => 1,
                    'error_status' => 0,
                    'message' => 'Data loaded successfully',
                    'summary_data' => $wallet_statement_data
                );
            } else {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loading failed or no data available', 'data' => $wallet_statement_data);
            }
        } else {
            //System parameter data
            $system_parameter_data = $this->MFeeStructure->get_system_data_for_processing($inst_id, $apikey);
            if (!(isset($system_parameter_data) && !empty($system_parameter_data) && count($system_parameter_data) > 0)) {
                return array('data_status' => 0, 'message' => 'Critical Error. Cannot get system parameters. Please contact administrator');
            }
            $is_card_service_charge = 0;
            $card_service_charge = 0;
            foreach ($system_parameter_data as $value) {
                if ($value['Code'] == 'IS_CARD_SERVICE_CHARGE') {
                    $is_card_service_charge = $value['Code_Value'];
                }
                if ($value['Code'] == 'CARD_SERVICE_CHARGE') {
                    $card_service_charge = $value['Code_Value'];
                }
            }
            if ($is_card_service_charge == 0) {
                $card_service_charge = 0;
            }
            //Bank Details
            $bank_data = $this->MFCollection->get_bank_details_for_processing($inst_id, $apikey);
            if (!(isset($bank_data) && !empty($bank_data) && count($bank_data) > 0)) {
                return array('data_status' => 0, 'message' => 'Critical Error. Cannot get bank details. Please contact administrator to input new bank details');
            }

            $total_amt_data = $this->MFCollection->get_collection_data_of_student_sum($student_id, $inst_id, $acd_year_id, $apikey);
            $black_list_data_raw = $this->MFCollection->get_blacklist_data_of_student($student_id, $inst_id, $acd_year_id, $apikey);
            $is_blacklist_data = 0;
            if (isset($black_list_data_raw[0]['DATA_STATUS']) && !empty($black_list_data_raw[0]['DATA_STATUS'])) {
                $black_list_data = $black_list_data_raw[0]['BLACK_LIST_DATA'];
                $is_blacklist_data = 1;
            } else {
                $black_list_data = 0;
            }
            if (isset($total_amt_data) && !empty($total_amt_data) && is_array($total_amt_data)) {
                return array(
                    'data_status' => 1,
                    'error_status' => 0,
                    'message' => 'Data loaded successfully',
                    'is_black_list_data' => $is_blacklist_data,
                    'black_list_data' => $black_list_data,
                    'summary_data' => $total_amt_data[0],
                    'card_service_charge' => $card_service_charge,
                    'bank_details' => $bank_data
                );
            } else {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loading failed or no data available', 'data' => $bank_data);
            }
        }
    }

    public function get_withdraw_request_summary($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        $request_data = $this->MFCollection->get_request_list_data($apikey, $inst_id, $acd_year_id, $student_id);

        return array('data_status' => 1, 'data' => $request_data, 'message' => 'Data loaded');
    }

    public function save_withdraw_request($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        if (!(isset($params['transaction_amount']) && !empty($params['transaction_amount']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Amount is required', 'data' => FALSE);
        } else {
            $transaction_amount = $params['transaction_amount'];
        }
        if (!(isset($params['reason']) && !empty($params['reason']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Reason is required', 'data' => FALSE);
        } else {
            $reason = $params['reason'];
        }

        $data_to_save = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $student_id,
            $transaction_amount,
            $reason
        );

        $request_data_status = $this->MFCollection->save_request_for_withdraw($data_to_save);
        //return $request_data_status;
        if (isset($request_data_status[0]['DATA_STATUS']) && !empty($request_data_status[0]['DATA_STATUS']) && $request_data_status[0]['DATA_STATUS'] == 1) {
            return array('data_status' => 1, 'message' => 'Data updated successfully');
        } else {
            if (isset($request_data_status[0]['ERROR_MESSAGES']) && !empty($request_data_status[0]['ERROR_MESSAGES'])) {
                return array('data_status' => 2, 'message' => $request_data_status[0]['ERROR_MESSAGES']);
            } else {
                return array('data_status' => 2, 'message' => 'An error encountered. Please try again later');
            }
        }
    }

    public function get_approve_data_for_wallet_withdraw($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        if (!(isset($params['master_id']) && !empty($params['master_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master data is required', 'data' => FALSE);
        } else {
            $master_id = $params['master_id'];
        }

        $total_amt_data = $this->MFCollection->get_collection_data_of_student_sum($student_id, $inst_id, $acd_year_id, $apikey);
        //        echo $total_amt_data[0]['E_WALLET'];die;
        if (isset($total_amt_data[0]['E_WALLET']) && !empty($total_amt_data[0]['E_WALLET'])) {
            $wallet = $total_amt_data[0]['E_WALLET'];
        } else {
            $wallet = 0;
        }

        $request_data = $this->MFCollection->get_approve_data_for_withdraw_data($apikey, $inst_id, $acd_year_id, $student_id, $master_id);

        return array('data_status' => 1, 'data' => $request_data, 'message' => 'Data loaded', 'docme_wallet' => $wallet);
    }

    public function save_withdraw_approval($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        if (!(isset($params['master_id']) && !empty($params['master_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master data is required', 'data' => FALSE);
        } else {
            $master_id = $params['master_id'];
        }


        if (!(isset($params['approve_type']) && !empty($params['approve_type']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Mode of approval is required', 'data' => FALSE);
        } else {
            $approve_type = $params['approve_type'];
        }
        if (!(isset($params['comments']) && !empty($params['comments']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Comments is required', 'data' => FALSE);
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



        if ($approve_type == 'Approve') {
            $data_to_save = array(
                $apikey,
                $inst_id,
                $acd_year_id,
                $student_id,
                $master_id,
                $comments,
                $is_cheque,
                $cheque_number,
                $cheque_date,
                $issued_name,
                $bank_id
            );
            $request_data_status = $this->MFCollection->save_request_for_withdraw_approve($data_to_save);
        } else {
            $data_to_save = array(
                $apikey,
                $inst_id,
                $acd_year_id,
                $student_id,
                $master_id,
                $comments
            );
            $request_data_status = $this->MFCollection->save_request_for_withdraw_reject($data_to_save);
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

    public function get_encashment_data_for_wallet_withdraw($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        if (!(isset($params['master_id']) && !empty($params['master_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master data is required', 'data' => FALSE);
        } else {
            $master_id = $params['master_id'];
        }

        $total_amt_data = $this->MFCollection->get_collection_data_of_student_sum($student_id, $inst_id, $acd_year_id, $apikey);
        //        echo $total_amt_data[0]['E_WALLET'];die;
        if (isset($total_amt_data[0]['E_WALLET']) && !empty($total_amt_data[0]['E_WALLET'])) {
            $wallet = $total_amt_data[0]['E_WALLET'];
        } else {
            $wallet = 0;
        }

        //Bank Details
        $bank_data = $this->MFCollection->get_bank_details_for_processing($inst_id, $apikey);
        if (!(isset($bank_data) && !empty($bank_data) && count($bank_data) > 0)) {
            return array('data_status' => 0, 'message' => 'Critical Error. Cannot get bank details. Please contact administrator to input new bank details');
        }

        $request_data = $this->MFCollection->get_encashment_data_for_withdraw_data($apikey, $inst_id, $acd_year_id, $student_id, $master_id);

        return array('data_status' => 1, 'data' => $request_data, 'message' => 'Data loaded', 'docme_wallet' => $wallet, 'bank_details' => $bank_data);
    }

    public function save_withdrawal_encashment_bycash($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        if (!(isset($params['master_id']) && !empty($params['master_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master data is required', 'data' => FALSE);
        } else {
            $master_id = $params['master_id'];
        }

        $data_to_save = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $student_id,
            $master_id
        );
        $request_data_status = $this->MFCollection->save_withdrawal_encashment_bycash($data_to_save);

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

    public function save_withdrawal_encashment_bycheque($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        if (!(isset($params['master_id']) && !empty($params['master_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master data is required', 'data' => FALSE);
        } else {
            $master_id = $params['master_id'];
        }

        if (!(isset($params['cheque_number']) && !empty($params['cheque_number']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data is required', 'data' => FALSE);
        } else {
            $cheque_number = $params['cheque_number'];
        }

        if (!(isset($params['cheque_date']) && !empty($params['cheque_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data is required', 'data' => FALSE);
        } else {
            $cheque_date = $params['cheque_date'];
        }

        if (!(isset($params['issued_name']) && !empty($params['issued_name']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data is required', 'data' => FALSE);
        } else {
            $issued_name = $params['issued_name'];
        }

        if (!(isset($params['bank_id']) && !empty($params['bank_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cheque data is required', 'data' => FALSE);
        } else {
            $bank_id = $params['bank_id'];
        }



        $data_to_save = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $student_id,
            $master_id,
            $cheque_number,
            $cheque_date,
            $issued_name,
            $bank_id
        );
        $request_data_status = $this->MFCollection->save_withdrawal_encashment_bycheque($data_to_save);

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

    public function get_view_data_for_wallet_withdrawal($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        if (!(isset($params['master_id']) && !empty($params['master_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master data is required', 'data' => FALSE);
        } else {
            $master_id = $params['master_id'];
        }

        $total_amt_data = $this->MFCollection->get_collection_data_of_student_sum($student_id, $inst_id, $acd_year_id, $apikey);

        if (isset($total_amt_data[0]['E_WALLET']) && !empty($total_amt_data[0]['E_WALLET'])) {
            $wallet = $total_amt_data[0]['E_WALLET'];
        } else {
            $wallet = 0;
        }


        $request_data = $this->MFCollection->get_view_for_withdraw_data($apikey, $inst_id, $acd_year_id, $student_id, $master_id);

        return array('data_status' => 1, 'data' => $request_data, 'message' => 'Data loaded', 'docme_wallet' => $wallet);
    }

    public function get_data_for_voucher_cancellation($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        $voucher_data = $this->MFCollection->get_voucher_data_for_cancellation($apikey, $student_id, $acd_year_id, $inst_id);

        return array('data_status' => 1, 'message' => 'Data loaded', 'data' => $voucher_data);
    }

    public function get_data_for_voucher_reprint($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        $voucher_type = $params['voucher_type'];
        $voucher_data = $this->MFCollection->get_data_for_voucher_reprint($apikey, $student_id, $acd_year_id, $inst_id, $voucher_type);

        return array('data_status' => 1, 'message' => 'Data loaded', 'data' => $voucher_data);
    }
    public function get_voucher_search($params)
    {
        $apikey = $params['API_KEY'];
        $inst_id = $params['inst_id'];
        $voucher_type = $params['voucher_type'];
        $voucherno = $params['voucherno'];
        $voucher_data = $this->MFCollection->get_voucher_search_result($apikey, $inst_id, $voucher_type, $voucherno);

        return array('data_status' => 1, 'message' => 'Data loaded', 'data' => $voucher_data);
    }
    public function get_voucher_types($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        $voucher_data = $this->MFCollection->get_voucher_types($apikey, $inst_id, $type = "");

        return array('data_status' => 1, 'message' => 'Data loaded', 'data' => $voucher_data);
    }
    public function get_data_for_voucher_cancellation_data_by_voucher_id($params)
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

        if (!(isset($params['voucher_id']) && !empty($params['voucher_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Voucher data is required', 'data' => FALSE);
        } else {
            $voucher_id = $params['voucher_id'];
        }

        $voucher_data = $this->MFCollection->get_voucher_data_for_cancellation_by_id($apikey, $voucher_id, $acd_year_id, $inst_id);

        return array('data_status' => 1, 'message' => 'Data loaded', 'data' => $voucher_data);
    }

    public function get_voucher_data_by_id_for_reprint($params)
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

        if (!(isset($params['voucher_id']) && !empty($params['voucher_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Voucher data is required', 'data' => FALSE);
        } else {
            $voucher_id = $params['voucher_id'];
        }

        $ptype = $params['ptype'];
        // return $params;

        $voucher_data = $this->MFCollection->get_voucher_data_by_id_for_reprint($apikey, $voucher_id, $acd_year_id, $inst_id, $ptype);

        return array('data_status' => 1, 'message' => 'Data loaded', 'data' => $voucher_data);
    }
    public function save_voucher_cancellation($params)
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

        if (!(isset($params['voucher_id']) && !empty($params['voucher_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Voucher data is required', 'data' => FALSE);
        } else {
            $voucher_id = $params['voucher_id'];
        }
        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        if (!(isset($params['reason']) && !empty($params['reason']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Voucher cancel reason is required', 'data' => FALSE);
        } else {
            $reason = $params['reason'];
        }

        $voucher_cancel_status = $this->MFCollection->save_voucher_cancel($apikey, $voucher_id, $acd_year_id, $inst_id, $student_id, $reason);
        if (isset($voucher_cancel_status[0]['connected_voucher']) && $voucher_cancel_status[0]['connected_voucher'] > 0) {

            $related_voucher_cancel_status = $this->MFCollection->save_wallet_voucher_cancel($apikey, $voucher_cancel_status[0]['connected_voucher'], $acd_year_id, $inst_id, $student_id, $reason);
        }
        return $voucher_cancel_status;
    }

    public function get_counter_collection_data($params)
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

        if (!(isset($params['user_id']) && !empty($params['user_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User data is required', 'data' => FALSE);
        } else {
            $user_id = $params['user_id'];
        }

        $collection_data = $this->MFCollection->get_counter_collectio_user_wise_data($apikey, $inst_id, $acd_year_id, $user_id);

        return $collection_data;
    }

    public function get_advancestudent_search_list_for_one_time_pay($params = NULL)
    {
        //         dev_export($data);die;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['batch_id']) && !empty($params['batch_id'])) {
            $dbparams[1] = $params['batch_id'];
        } else {
            $dbparams[1] = NULL;
        }
        if (isset($params['stream_id']) && !empty($params['stream_id'])) {
            $dbparams[2] = $params['stream_id'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[3] = $params['class_id'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['curent_acdyr']) && !empty($params['curent_acdyr'])) {
            $dbparams[4] = $params['curent_acdyr'];
        } else {
            $dbparams[4] = NULL;
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[5] = $params['inst_id'];
        } else {
            $dbparams[5] = NULL;
        }
        if (isset($params['searchname']) && !empty($params['searchname'])) {
            $dbparams[6] = $params['searchname'];
        } else {
            $dbparams[6] = NULL;
        }
        //        dev_export($dbparams);die;
        $student_data_list = $this->MFCollection->studentadvance_search_for_one_time($dbparams);


        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_one_time_adjustment_with_wallet_to_pending_pay($params)
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
        //
        //        if (!(isset($params['batch_id']) && !empty($params['batch_id']))) {
        //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch data is required', 'data' => FALSE);
        //        } else {
        //            $batch_id = $params['batch_id'];
        //        }

        if (!(isset($params['student_data']) && !empty($params['student_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_data_raw = $params['student_data'];
        }

        $penalty_date = date('Y-m-d');
        $penalty_details = $this->MFCollection->get_penalty_details($inst_id, $apikey, $penalty_date);
        if (isset($penalty_details) && !empty($penalty_details)) {
            $penaltyarray = array();
            foreach ($penalty_details as $pdls) {
                $effectdate = date('d-m-Y', strtotime($pdls['effectdate']));
                $penaltyarray[$pdls['fee_id']]['effectdate'] = $effectdate;
                $penaltyarray[$pdls['fee_id']]['penalty_type'] = $pdls['penalty_type'];
                $penaltyarray[$pdls['fee_id']]['details'][] = array(
                    'FromDays' => $pdls['FromDays'],
                    'Todays' => $pdls['Todays'],
                    'amount' => $pdls['amount']
                );
            }
        }
        $total_penalty = 0;

        $student_data = json_decode($student_data_raw, TRUE);
        $error_student_data = array();
        //        dev_export($student_data);die;
        foreach ($student_data as $students) {
            $one_time_pay_status_of_student = 0; //$this->MFCollection->one_time_pay_status_of_student($students['student_id'], $inst_id, $acd_year_id, $apikey);
            if ($one_time_pay_status_of_student == 0) {
                $pay_data_student = array();
                $student_id = $students['student_id'];
                $student_name = $students['student_name'];
                $wallet_amt = $students['wallet_amt'];
                $total_vat_amount_paid = 0;
                $amount_paid = 0;
                $pay_flag = 1;
                $penalty_check_array = array();
                $collection_data = $this->MFCollection->get_collection_data_of_student($student_id, $inst_id, $acd_year_id, $apikey);
                foreach ($collection_data as $col_data) {
                    $penalty = 0;
                    /** */
                    if (!isset($penalty_check_array[$col_data['FEEID'] . '_' . $col_data['DEM_MONTH']])) {
                        //added this condition for is there penalty details added for this feecode - NOV 06, 2019
                        if (isset($penaltyarray) && !empty($penaltyarray) && isset($penaltyarray[$col_data['FEEID']])) {
                            //dev_export($penaltyarray);
                            $currentdate = date_create(date('d-m-Y'));
                            $demanddate = date_create(date('d-m-Y', strtotime($col_data['ARREAR_DATE'])));
                            $effect_date = date_create(date('d-m-Y', strtotime($penaltyarray[$col_data['FEEID']]['effectdate'])));
                            $interval = date_diff($currentdate, $demanddate);
                            $days = $interval->format('%R%a');
                            //echo $days;
                            $days_difference = abs($days); //FEEID
                            $symbol = substr($days, 0, 1);
                            if ($symbol == '+') {
                                $penalty = 0;
                            } else {
                                foreach ($penaltyarray[$col_data['FEEID']]['details'] as $pda) {
                                    if ($days_difference >= $pda['FromDays']) {
                                        $penalty = $pda['amount'];
                                        break;
                                    } else {
                                        $penalty = 0;
                                        continue;
                                    }
                                }
                                $penalty = (($penalty - $col_data['PENALTY_PAID']) > 0 ? ($penalty - $col_data['PENALTY_PAID']) : 0);
                                $penalty = (($penalty - $col_data['NON_RECONCILED_PENALTY']) > 0 ? ($penalty - $col_data['NON_RECONCILED_PENALTY']) : 0);
                                $penalty_check_array[$col_data['FEEID'] . '_' . $col_data['DEM_MONTH']] = $col_data['FEEID'];
                            }
                        } else {
                            $penalty = 0;
                        }
                    }
                    $total_pending =  $col_data['TRANSACTION_AMOUNT'] - ($col_data['TOTAL_PAID_AMOUNT'] + $col_data['CONCESSION_AMOUNT'] + $col_data['EXEMPTION_AMOUNT'] + $col_data['TOTAL_NON_RECONCILED_AMOUNT']);
                    // return $col_data['TOTAL_NON_RECONCILED_AMOUNT'];
                    // $penalty = ($col_data['PENDING_PAYMENT'] > 0 ? $penalty : 0);
                    // $penalty = ($total_pending > $col_data['EXEMPTION_PENDING_AMOUNT'] ? $penalty : 0);
                    /** */
                    $trans_amt = $total_pending; //($col_data['TRANSACTION_AMOUNT'] - $col_data['CONCESSION_AMOUNT']);
                    if ($trans_amt > 0) {
                        $vat_amt = $col_data['IS_VAT'] == 1 ? $trans_amt * $col_data['VAT'] / 100 : 0;
                        $total_remain_amt = $trans_amt + $vat_amt + $penalty;
                        if ($wallet_amt > 0 && $pay_flag == 1) {
                            if (($wallet_amt - $total_remain_amt) >= 0) {
                                $total_vat_amount_paid = $total_vat_amount_paid + $vat_amt;
                                $amount_paid = $amount_paid + $total_remain_amt;
                                $pay_data_student[] = array(
                                    'transaction_id' => $col_data['ID'],
                                    'demanddate' => $col_data['DEMAND_DATE'],
                                    'transactionamount' => $col_data['TRANSACTION_AMOUNT'],
                                    'transactionvatpercent' => $col_data['VAT'],
                                    'transactionvatamt' => $vat_amt,
                                    'transactionamtwithvat' => $total_remain_amt,
                                    'is_paid_full' => 1,
                                    'is_partial_paid' => 0,
                                    'paidamount' => $total_remain_amt,
                                    'paid_amt_without_tax' => $trans_amt,
                                    'paidtax' => $vat_amt,
                                    'penalty' => $penalty,
                                    'description' => $col_data['TRANSACTION_DESC'] . ' ' . date('M-Y', strtotime($col_data['DEMAND_DATE'])),
                                    'penalty_only' => 0 //1-penalty only, 0-fee+penalty 
                                );
                                $total_penalty = $total_penalty + $penalty;
                                $wallet_amt = $wallet_amt - $total_remain_amt;
                            } else {
                                //
                                $fee_vat_percent = $col_data['VAT'];
                                $fee_paid = ((100 * ($wallet_amt - $penalty)) / (100 + $fee_vat_percent));
                                $vat_paid = ($fee_paid * $fee_vat_percent / 100);
                                $voucher_amt = ($fee_paid * 1) + ($vat_paid * 1) + ($penalty * 1);
                                //
                                $total_vat_amount_paid = $total_vat_amount_paid + $vat_paid;
                                $amount_paid = $amount_paid + $wallet_amt;
                                $pay_data_student[] = array(
                                    'transaction_id' => $col_data['ID'],
                                    'demanddate' => $col_data['DEMAND_DATE'],
                                    'transactionamount' => $wallet_amt,
                                    'transactionvatpercent' => $col_data['VAT'],
                                    'transactionvatamt' => $vat_amt,
                                    'transactionamtwithvat' => $wallet_amt,
                                    'is_paid_full' => 0,
                                    'is_partial_paid' => 1,
                                    'paidamount' => $voucher_amt,
                                    'paid_amt_without_tax' => ROUND(($voucher_amt <= $penalty ? 0 : $fee_paid), 2), // - $penalty
                                    'paidtax' => ROUND(($voucher_amt <= $penalty ? 0 : $vat_paid), 2), //$vat_paid,
                                    'penalty' => ROUND(($voucher_amt <= $penalty ? $voucher_amt : $penalty), 2),
                                    'description' => ($voucher_amt <= $penalty ? $col_data['TRANSACTION_DESC'] : 'Partial Payment - ' . $col_data['TRANSACTION_DESC'] . ' ' . date('M-Y', strtotime($col_data['DEMAND_DATE']))),
                                    'penalty_only' => ($voucher_amt <= $penalty ? 1 : 0) //1-penalty only, 0-fee+penalty 
                                );
                                $total_penalty = $total_penalty + ($voucher_amt <= $penalty ? $voucher_amt : $penalty);

                                $pay_flag = 0;
                                break;
                            }
                        }
                    }
                }
                // return $pay_data_student;

                $data_to_save = array(
                    'api_key' => $apikey,
                    'inst_id' => $inst_id,
                    'acd_year_id' => $acd_year_id,
                    'student_id' => $student_id,
                    'amount_paid' => $amount_paid,
                    'total_penalty' => $total_penalty,
                    'payment_data' => json_encode($pay_data_student),
                    'mode_of_payment' => 'T',
                    'service_charge' => 0,
                    'count_of_feecode' => count($pay_data_student),
                    'total_voucher_amount' => $amount_paid,
                    'total_vat_amount' => $total_vat_amount_paid,
                    'is_excess' => 0,
                    'excess_amount' => 0,
                    'ch_number' => '',
                    'ch_date' => '',
                    'account_holder_name' => '',
                    'address' => '',
                    'name_of_bank' => '',
                    'bank_branch' => '',
                    'name_on_card' => '',
                    'card_number' => ''
                );
                //            dev_export($data_to_save);
                //            die;
                if (isset($pay_data_student) && !empty($pay_data_student) && count($pay_data_student) > 0) {
                    $collection_data = $this->save_fee_payment_for_one_time($data_to_save);
                    if (!(isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1))) {
                        if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                            $error_student_data[$student_id] = array('student_name' => $student_name, 'message' => $collection_data[0]['message']);
                        } else {
                            $error_student_data[$student_id] = array('student_name' => $student_name, 'message' => 'Data creation / updation failed or no data available');
                        }
                    }
                } else {
                    $error_student_data[$student_id] = array('student_name' => $student_name, 'message' => 'The data balance is not enough to make a full payment');
                }
            }
        }
        if (count($error_student_data) == 0) {
            return array('status' => 1, 'message' => 'Completed successfully', 'failed_students' => $error_student_data);
        } else {
            return array('status' => 3, 'message' => 'Completed with errors successfully', 'failed_students' => $error_student_data);
        }
        //        die;
    }

    private function save_fee_payment_for_one_time($data_to_save)
    {
        if ($data_to_save['mode_of_payment'] == 'T') {
            $data = array(
                $data_to_save['api_key'],
                $data_to_save['inst_id'],
                $data_to_save['acd_year_id'],
                $data_to_save['student_id'],
                $data_to_save['amount_paid'],
                $data_to_save['total_penalty'],
                $data_to_save['payment_data'],
                $data_to_save['service_charge'],
                $data_to_save['count_of_feecode'],
                $data_to_save['total_voucher_amount'],
                $data_to_save['total_vat_amount']
            );
            $collection_data = $this->MFCollection->save_collection_data_of_student_by_wallet_for_one_time($data);
            return $collection_data;
        }
    }

    //FEE EXEMPTION

    public function get_exemption_data_of_student($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        $expn_from_db = array(
            'api_key' => $apikey,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'student_id' => $student_id,
            'flag'       => 1
        );
        //System parameter data
        $system_parameter_data = $this->MFeeStructure->get_system_data_for_processing($inst_id, $apikey);
        if (!(isset($system_parameter_data) && !empty($system_parameter_data) && count($system_parameter_data) > 0)) {
            return array('data_status' => 0, 'message' => 'Critical Error. Cannot get system parameters. Please contact administrator');
        }
        $collection_data = $this->MFCollection->get_exemption_data_of_student($expn_from_db);
        // $term_as_month_data = $this->MFCollection->get_term_as_monthly_data_of_student($expn_from_db);
        if (isset($collection_data) && !empty($collection_data) && is_array($collection_data)) {
            $demandedfeecodes = array();
            foreach ($collection_data as $cdata) {
                if (!in_array($cdata['FEECODE'], $demandedfeecodes)) {
                    //array_push($demandedfeecodes, $cdata['FEECODE']);
                    $demandedfeecodes[] = $cdata['FEECODE'];
                }
            }
        }
        $expn_from_db_sum = array(
            'api_key' => $apikey,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'student_id' => $student_id,
            'flag'       => 2
        );
        $total_amt_data = $this->MFCollection->get_exemption_data_of_student($expn_from_db_sum);
        if (isset($total_amt_data) && !empty($total_amt_data) && is_array($total_amt_data)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Data loaded successfully',
                'data' => $collection_data,
                'summary_data' => $total_amt_data[0],
                // 'term_as_month_data' => $term_as_month_data,
                'demandedfeecodes' => $demandedfeecodes
            );
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loading failed or no data available', 'data' => $collection_data);
        }
    }
    public function get_all_feecodes_available($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        };
        $feecodes_available = $this->MFCollection->get_all_feecodes_available($apikey, $inst_id);
        return array('status' => 1, 'message' => 'Data loaded', 'data' => $feecodes_available);
    }

    public function get_exemption_requests($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }

        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }
        $data_to_db = array(
            'api_key' => $apikey,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id
        );

        $result_data = $this->MFCollection->get_exemption_requests($data_to_db);
        // return $result_data;
        return array('status' => 1, 'message' => 'Data loaded', 'data' => $result_data);
    }

    public function get_exemption_details($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }

        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ACADEMIC YEAR REQUIRED', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }
        if (!(isset($params['exemp_id']) && !empty($params['exemp_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Exemption ID required', 'data' => FALSE);
        } else {
            $exemp_id = $params['exemp_id'];
        }
        $data_to_db = array(
            'api_key' => $apikey,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'exemp_id' => $exemp_id
        );

        $result_data = $this->MFCollection->get_exemption_details($data_to_db);
        return array('status' => 1, 'message' => 'Data loaded', 'data' => $result_data);
    }
    public function save_exemption_for_approval($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        if (!(isset($params['exemption_data']) && !empty($params['exemption_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Payment data is required', 'data' => FALSE);
        } else {
            $exemption_data = $params['exemption_data'];
        }

        if (!(isset($params['amount_paid']) && !empty($params['amount_paid']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Amount data is required', 'data' => FALSE);
        } else {
            $amount_paid = $params['amount_paid'];
        }
        if (!(isset($params['reason_exempt']) && !empty($params['reason_exempt']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Reason required', 'data' => FALSE);
        } else {
            $reason_exempt = $params['reason_exempt'];
        }

        if (!(isset($params['total_voucher_amount']) && !empty($params['total_voucher_amount']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Voucher amount data is required', 'data' => FALSE);
        } else {
            if ($params['total_voucher_amount'] == -1) {
                $total_voucher_amount = 0;
            } else {
                $total_voucher_amount = $params['total_voucher_amount'];
            }
        }
        if (!(isset($params['total_vat_amount_paid']) && !empty($params['total_vat_amount_paid']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Voucher vat amount data is required', 'data' => FALSE);
        } else {
            if ($params['total_vat_amount_paid'] == -1) {
                $total_vat_amount_paid = 0;
            } else {
                $total_vat_amount_paid = $params['total_vat_amount_paid'];
            }
        }
        $transaction_ID = $params['transaction_ID'];

        $data_to_save = array(
            'api_key'               => $apikey,
            'inst_id'               => $inst_id,
            'acd_year_id'           => $acd_year_id,
            'student_id'            => $student_id,
            'amount_paid'           => $amount_paid,
            'exemption_data'        => $exemption_data,
            'count_of_feecode'      => count(json_decode($exemption_data, TRUE)),
            'total_voucher_amount'  => $total_voucher_amount,
            'total_vat_amount'      => $total_vat_amount_paid,
            'reason_exempt'         => $reason_exempt,
            'transaction_ID'        => $transaction_ID
        );

        $collection_data = $this->MFCollection->save_exemption_for_approval($data_to_save);
        if (isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1)) {
            $exm_master_id = $collection_data[0]['VOUCHER_NO'];
            $data_to_mis = array(
                'api_key'       => $apikey,
                'inst_id'       => $inst_id,
                'acd_year_id'   => $acd_year_id,
                'student_id'    => $student_id,
                'master_id'    =>  $exm_master_id
            );
            $mis_data = $this->MFCollection->get_exemption_data_for_mis($data_to_mis);

            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Data created/modified successfully',
                'data' => array('collection' => $collection_data[0], 'mis_data' => $mis_data)
            );
        } else {
            if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $collection_data[0]['message']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data creation / updation failed or no data available');
            }
        }
    }
    public function save_exemption_wfm_for_md_approval($params)
    {
        $apikey             = $params['API_KEY'];
        $inst_id            = $params['inst_id'];
        $acd_year_id        = $params['acd_year_id'];
        $student_id         = $params['student_id'];
        $exemption_data     = $params['exemption_data'];
        $studarray          = $params['studarray'];
        $amount_paid        = $params['amount_paid'];
        $reason_exempt      = $params['reason_exempt'];
        $master_id          = $params['master_id'];

        $data_to_save = array(
            'api_key'               => $apikey,
            'inst_id'               => $inst_id,
            'acd_year_id'           => $acd_year_id,
            'student_id'            => $student_id,
            'amount_paid'           => $amount_paid,
            'exemption_data'        => $exemption_data,
            'studarray'             => $studarray,
            'reason_exempt'         => $reason_exempt,
            'master_id'             => $master_id
        );
        $collection_data = $this->MFCollection->save_exemption_wfm_for_md_approval($data_to_save);
        if (isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Data created/modified successfully',
                'data' => array('collection' => $collection_data[0])
            );
        } else {
            if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $collection_data[0]['message']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data creation / updation failed or no data available');
            }
        }
    }

    public function approve_exemption($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        if (!(isset($params['master_id']) && !empty($params['master_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Exemption ID required', 'data' => FALSE);
        } else {
            $master_id = $params['master_id'];
        }
        if (!(isset($params['pay_data']) && !empty($params['pay_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Exemption Details required', 'data' => FALSE);
        } else {
            $pay_data = $params['pay_data'];
        }
        if (!(isset($params['md_comment']) && !empty($params['md_comment']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Comment required', 'data' => FALSE);
        } else {
            $md_comment = $params['md_comment'];
        }

        $data_to_get = array(
            'api_key'       => $apikey,
            'inst_id'       => $inst_id,
            'acd_year_id'   => $acd_year_id,
            'student_id'    => $student_id,
            'master_id'     => $master_id
        );
        $exemption_data = $this->MFCollection->get_exemption_demanding_details($data_to_get);
        $exp_array = json_decode($exemption_data[0]['exemption_details'], true);

        $exarray = array();
        $payarray = json_decode($pay_data, true);
        $testarray = array();
        if (!empty($payarray)) {
            for ($i = 0; $i < sizeof($payarray); $i++) {
                $testarray[$payarray[$i]['account_id']] = $payarray[$i];
            }
        }
        if (!empty($exp_array)) {
            for ($i = 0; $i < sizeof($exp_array); $i++) {
                $exarray[$exp_array[$i]['transaction_id']] = $exp_array[$i];
            }
        }
        //$exarray[$exp_array[$i]['transaction_id']] = $exp_array[$i];

        //return json_decode($exemption_data[0]['exemption_details'], true);
        //$abcd = json_encode($pay_data);
        //return $exarray;
        //return $testarray;
        $amount_paid = 0;
        $vat_paid = 0;
        foreach ($testarray as $key => $val) {
            //$exarray[$key]['transactionamtwithvat'] = $val['amount_approved'];
            //$vat_amount = ($val['amount_approved'] * $exarray[$key]['transactionvatpercent']) / 100;
            $dist_amount = ($val['amount_approved'] * 100) / ($exarray[$key]['transactionvatpercent'] + 100); // calculate pay amount from total amount
            $vat_amount = ($dist_amount * $exarray[$key]['transactionvatpercent']) / 100;
            //$exarray[$key]['transactionamtwithvat'] = $vat_amount + $val['amount_approved'];
            $exarray[$key]['paidamount'] = $val['amount_approved']; //$vat_amount + 
            //$exarray[$key]['paid_amt_without_tax'] = ($val['amount_approved'] - $vat_amount);
            //$exarray[$key]['paidtax'] = $vat_amount;
            // if ($exarray[$key]['transactionamount'] - ($val['amount_approved']) <= 0) { //$vat_amount + 
            //     $exarray[$key]['is_paid_full'] = 1;
            //     $exarray[$key]['is_partial_paid'] = 0;
            // } else if ($exarray[$key]['transactionamount'] == ($exarray[$key]['transactionamount'] - ($val['amount_approved']))) { //$vat_amount + 
            //     $exarray[$key]['is_paid_full'] = 0;
            //     $exarray[$key]['is_partial_paid'] = 0;
            // } else {
            //     $exarray[$key]['is_paid_full'] = 0;
            //     $exarray[$key]['is_partial_paid'] = 1;
            // }
            //return $val['amount_approved'];
            $amount_paid += $val['amount_approved'];
            $vat_paid += $vat_amount;
        }

        //remove Key from array
        foreach ($exarray as $key => $val) {
            $exarray1[] = $val;
        }
        //return $exarray;
        $data_to_save = array(
            'api_key'       => $apikey,
            'inst_id'       => $inst_id,
            'acd_year_id'   => $acd_year_id,
            'student_id'    => $student_id,
            'master_id'     => $master_id,
            'pay_data'      => json_encode($exarray1),
            'md_comment'    => $md_comment,
            'approve'       => 1,
            'amount_paid'   => $amount_paid,
            'vat_paid'      => $vat_paid
        );
        //return json_encode($exarray1);
        $collection_data = $this->MFCollection->approve_exemption($data_to_save);
        if (isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Exemption Approved successfully. Voucher No.: ' . $collection_data[0]['VOUCHER_NO'],
                'data' => $collection_data[0]
            );
        } else {
            if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $collection_data[0]['message']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Failed or no data available');
            }
        }
    }
    public function reject_exemption($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        if (!(isset($params['master_id']) && !empty($params['master_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Exemption ID required', 'data' => FALSE);
        } else {
            $master_id = $params['master_id'];
        }

        if (!(isset($params['remarks']) && !empty($params['remarks']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Reason for Rejection required', 'data' => FALSE);
        } else {
            $remarks = $params['remarks'];
        }
        $data_to_save = array(
            'api_key'       => $apikey,
            'inst_id'       => $inst_id,
            'acd_year_id'   => $acd_year_id,
            'student_id'    => $student_id,
            'master_id'     => $master_id,
            'remarks'       => $remarks
        );
        $collection_data = $this->MFCollection->reject_exemption($data_to_save);
        if (isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Exemption Rejected successfully',
                'data' => $collection_data[0]
            );
        } else {
            if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $collection_data[0]['message']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Failed or no data available');
            }
        }
    }

    //MIS RESPONSE SAVE
    public function save_mis_response($params)
    {
        $apikey = $params['API_KEY'];
        $inst_id = $params['inst_id'];
        $acd_year_id = $params['acd_year_id'];
        $student_id = $params['student_id'];
        $response = $params['response'];
        $transaction_type = $params['transaction_type'];
        $data_to_mis = $params['data_to_mis'];

        $data_to_save = array(
            'api_key'           => $apikey,
            'inst_id'           => $inst_id,
            'acd_year_id'       => $acd_year_id,
            'transaction_type'  => $transaction_type,
            'student_id'        => $student_id,
            'response'          => json_encode($response),
            'data_to_mis'       => $data_to_mis
        );
        $save_status = $this->MFCollection->save_mis_response($data_to_save);
        return $save_status;
    }

    //PAY PROSPECTUS FEE
    public function pay_registration_fee($params)
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
        $amount_paid        = $params['amount_paid'];
        $service_charge     = $params['service_charge'];
        $mode_of_payment    = $params['mode_of_payment'];
        $student_name       = $params['student_name'];
        $parent_name        = $params['parent_name'];
        $address            = $params['address'];
        $phone_number       = $params['phone_number'];
        $card_number        = $params['card_number'];
        $card_name          = $params['card_name'];
        //$fee_id             = $params['fee_id'];

        $data_to_save = array(
            'api_key'           => $apikey,
            'inst_id'           => $inst_id,
            'acd_year_id'       => $acd_year_id,
            'amount_paid'       => $amount_paid,
            'service_charge'    => $service_charge,
            'student_name'      => $student_name,
            'parent_name'       => $parent_name,
            'address'           => $address,
            'phone_number'      => $phone_number,
            'mode_of_payment'   => $mode_of_payment,
            //'fee_id'            => $fee_id,
            'card_number'       => $card_number,
            'card_name'         => $card_name
        );
        //return json_encode($exarray1);
        $collection_data = $this->MFCollection->pay_registration_fee($data_to_save);
        if (isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Exemption Approved successfully. Voucher No.: ' . $collection_data[0]['VOUCHER_NO'],
                'data' => $collection_data[0]
            );
        } else {
            if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $collection_data[0]['message']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Failed or no data available');
            }
        }
    }
    //PAY TEMP REGISTRATION
    public function pay_temp_registration_fee($params)
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
        $amount_paid        = $params['amount_paid'];
        $service_charge     = $params['service_charge'];
        $mode_of_payment    = $params['mode_of_payment'];
        $temp_reg_id       = $params['temp_reg_id'];
        $card_number        = $params['card_number'];
        $card_name          = $params['card_name'];
        $referenceDate      = $params['referenceDate'];
        $reference_number   = $params['reference_number'];

        $data_to_save = array(
            'api_key'           => $apikey,
            'inst_id'           => $inst_id,
            'acd_year_id'       => $acd_year_id,
            'amount_paid'       => $amount_paid,
            'service_charge'    => $service_charge,
            'temp_reg_id'       => $temp_reg_id,
            'mode_of_payment'   => $mode_of_payment,
            'card_number'       => $card_number,
            'card_name'         => $card_name,
            'referenceDate'     => $referenceDate,
            'reference_number'  => $reference_number
        );
        //return json_encode($exarray1);
        $collection_data = $this->MFCollection->pay_temp_registration_fee($data_to_save);
        if (isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Exemption Approved successfully. Voucher No.: ' . $collection_data[0]['VOUCHER_NO'],
                'data' => $collection_data[0]
            );
        } else {
            if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $collection_data[0]['message']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Failed or no data available');
            }
        }
    }
    //set_min_wallet_amount
    public function set_min_wallet_amount($params)
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
        $student_id         = $params['student_id'];
        $amount_limit       = $params['amount_limit'];
        $update_email       = $params['update_email'];
        $to_email           = $params['to_email'];
        $father_id          = $params['father_id'];

        $data_to_save = array(
            'api_key'           => $apikey,
            'inst_id'           => $inst_id,
            'acd_year_id'       => $acd_year_id,
            'amount_limit'      => $amount_limit,
            'student_id'        => $student_id,
            'update_email'      => $update_email,
            'to_email'          => $to_email,
            'father_id'         => $father_id
        );
        //return json_encode($exarray1);
        $collection_data = $this->MFCollection->set_min_wallet_amount($data_to_save);
        if (isset($collection_data[0]['DATA_SUCCESS']) && !empty($collection_data[0]['DATA_SUCCESS']) && ($collection_data[0]['DATA_SUCCESS'] == 1)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'set wallet limit successfully.',
                'data' => $collection_data[0]
            );
        } else {
            if (isset($collection_data[0]['message']) && !empty($collection_data[0]['message'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $collection_data[0]['message']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Failed or no data available');
            }
        }
    }

    //Fee Deallocation
    public function get_fees_demnaded_for_student($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        $collection_data = $this->MFCollection->get_fees_demnaded_for_student($student_id, $inst_id, $acd_year_id, $apikey);
        if (isset($collection_data) && !empty($collection_data) && is_array($collection_data)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Data loaded successfully',
                'data' => $collection_data,
                // 'plan_data' => $plan_data,
                // 'summary_data' => $total_amt_data[0],
                // 'demandedfeecodes' => $demandedfeecodes
            );
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loading failed or no data available', 'data' => $collection_data);
        }
    }
}
