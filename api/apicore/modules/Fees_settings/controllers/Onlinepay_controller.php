<?php

/**
 * Description of Onlinepay_controller
 *
 * @author Aju
 */
class Onlinepay_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Fee_collection_model', 'MFCollection');
        $this->load->model('Fee_structure_model', 'MFeeStructure'); //Registration_controller.php
        $this->load->model('Onlinepay_model', 'MOnlinepay');
    }
    public function getFeeData($params)
    { //Response to Cordova with fee details
        $apikey = $params['API_KEY'];

        if (!(isset($params['token']) && !empty($params['token']))) {
            return array('code' => 200, 'message' => 'Token Required');
        } else {
            $token = $params['token'];
        }
        if (!(isset($params['admn_no']) && !empty($params['admn_no']))) {
            return array('code' => 200, 'message' => 'Admn No. Required');
        } else {
            $admn_no = $params['admn_no'];
        }

        if ($token == md5('DocMeCloud@Oxfordtrivandrum5')) $inst_id = 5;
        else if ($token == md5('DocMeCloud@Oxfordkollam8')) $inst_id = 8;
        else if ($token == md5('DocMeCloud@Oxfordcalicut20')) $inst_id = 20;
        else {
            return array('code' => 404, 'message' => 'Invalid Token');
        }

        $apidetails = $this->MOnlinepay->get_all_api_keys('', $inst_id);
        //Penalty Details
        $penalty_date = date('Y-m-d');
        $apikey = $apidetails[0]['api_key'];
        $penalty_data = $this->MFCollection->get_penalty_details($inst_id, $apikey, $penalty_date);
        $student_details = $this->MOnlinepay->get_student_data_by_admn_number($admn_no, $inst_id, $apikey);

        if (isset($student_details) && !empty($student_details)) {
            $studentid = $student_details[0]['student_id'];
            $acdyearid = $student_details[0]['Cur_AcadYr'];
        } else {
            return array('code' => 200, 'message' => 'Admission number not found'); //No fee detail found
        }
        $collection_data = $this->MFCollection->get_collection_data_of_student($studentid, $inst_id, $acdyearid, $apikey);
        $total_amt_data = $this->MFCollection->get_collection_data_of_student_sum($studentid, $inst_id, $acdyearid, $apikey);
        $total_paid_data = $this->MFCollection->get_collection_data_of_student_paid($studentid, $inst_id, $acdyearid, $apikey);

        $studarray = array();
        if (isset($collection_data) && !empty($collection_data)) {
            if (isset($penalty_data) && !empty($penalty_data)) {
                $penalty_details = $penalty_data;
                // dev_export($penalty_data);
                // die;
                $penaltyarray = array();
                foreach ($penalty_data as $pdls) {
                    $effectdate = date('d-m-Y', strtotime($pdls['effectdate']));
                    $penaltyarray[$pdls['fee_id']]['effectdate'] = $effectdate;
                    $penaltyarray[$pdls['fee_id']]['penalty_type'] = $pdls['penalty_type'];
                    $penaltyarray[$pdls['fee_id']]['details'][] = array(
                        'FromDays' => $pdls['FromDays'],
                        'Todays' => $pdls['Todays'],
                        'amount' => $pdls['amount']
                    );
                    $data['penalty_details'] = $penaltyarray; //[$pdls['Todays']] = $pdls['amount'];
                }
            } else {
                $penalty_details = NULL;
            }
            $totalpenalty = 0;
            $penalty_check_array = array();
            foreach ($collection_data as $demand) {
                $penalty = 0;
                if (!isset($penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']])) {
                    //added this condition for is there penalty details added for this feecode - NOV 06, 2019
                    if (isset($penaltyarray) && !empty($penaltyarray) && isset($penaltyarray[$demand['FEEID']])) {
                        //dev_export($penaltyarray);
                        $currentdate = date_create(date('d-m-Y'));
                        $demanddate = date_create(date('d-m-Y', strtotime($demand['ARREAR_DATE'])));
                        $effect_date = date_create(date('d-m-Y', strtotime($penaltyarray[$demand['FEEID']]['effectdate'])));
                        $interval = date_diff($currentdate, $demanddate);
                        $days = $interval->format('%R%a');
                        //echo $days;
                        $days_difference = abs($days); //FEEID
                        $symbol = substr($days, 0, 1);
                        if ($symbol == '+') {
                            $penalty = 0;
                        } else {
                            foreach ($penaltyarray[$demand['FEEID']]['details'] as $pda) {
                                if ($days_difference >= $pda['FromDays']) {
                                    $penalty = $pda['amount'];
                                    break;
                                } else {
                                    $penalty = 0;
                                    continue;
                                }
                            }
                            $penalty = (($penalty - $demand['PENALTY_PAID']) > 0 ? ($penalty - $demand['PENALTY_PAID']) : 0);
                            $penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']] = $demand['FEEID'];
                        }
                    } else {
                        $penalty = 0;
                    }
                }
                $penalty = ($demand['PENDING_PAYMENT'] > 0 ? $penalty : 0);
                $totalpenalty += $penalty;

                $studarray[$demand['DEM_MONTH']]['fee_month'] = date('F', strtotime($demand['DEMAND_DATE']));
                $studarray[$demand['DEM_MONTH']]['fee_last_date'] = date('Y-m-d', strtotime($demand['DEMAND_DATE']));
                $studarray[$demand['DEM_MONTH']]['fee_status'] = 'Pending';
                $studarray[$demand['DEM_MONTH']]['fee_paid_on'] = '';
                $studarray[$demand['DEM_MONTH']]['details']['total'] += ($demand['PENDING_PAYMENT']);
                $studarray[$demand['DEM_MONTH']]['details'][$demand['TRANSACTION_DESC']] = round($demand['PENDING_PAYMENT'], 2);
                $studarray[$demand['DEM_MONTH']]['details']['late_fee'] = $totalpenalty;
            }
            $data['total_penalty'] = $totalpenalty;
        }
        $newarray = array();
        if (!empty($studarray)) {
            foreach ($studarray as $std) {
                $newarray[] = $std;
            }
        }

        if (isset($total_amt_data) && !empty($total_amt_data) && is_array($total_amt_data)) {//(($total_amt_data[0]['PENDING_PAYMENT']) + $totalpenalty)
            return array(
                'status' => array('code' => 200, 'message' => 'success'),
                'data' => $newarray,
                'total_paid' => $total_paid_data
            );
        } else {
            return array('code' => 200, 'message' => 'No data found');
        }
    }
    public function Online_response($params)
    {
        // return $params;
        $apikey = $params['API_KEY'];
        if (!(isset($params['token']) && !empty($params['token']))) {
            return array('code' => 200, 'message' => 'Token Required');
        } else {
            $token = $params['token'];
        }
        if ($token == md5('DocMeCloud@Oxfordtrivandrum5')) $inst_id = 5;
        else if ($token == md5('DocMeCloud@Oxfordkollam8')) $inst_id = 8;
        else if ($token == md5('DocMeCloud@Oxfordcalicut20')) $inst_id = 20;
        else {
            return array('code' => 404, 'message' => 'Invalid Token');
        }

        if (!(isset($params['admn_no']) && !empty($params['admn_no']))) {
            return array('code' => 200, 'message' => 'Admn No. Required');
        } else {
            $admn_no = $params['admn_no'];
        }

        $apidetails = $this->MOnlinepay->get_all_api_keys('', $inst_id);
        //Penalty Details
        $penalty_date = date('Y-m-d');
        $apikey = $apidetails[0]['api_key'];
        // $penalty_data = $this->MFCollection->get_penalty_details($inst_id, $apikey, $penalty_date);
        $student_details = $this->MOnlinepay->get_student_data_by_admn_number($admn_no, $inst_id, $apikey);

        if (isset($student_details) && !empty($student_details)) {
            $studentid = $student_details[0]['student_id'];
            $acdyearid = $student_details[0]['Cur_AcadYr'];
        } else {
            return array('code' => 200, 'message' => 'Admission number not found'); //No fee detail found
        }
        $mmp_txn        = $params['mmp_txn'];
        $mer_txn        = $params["mer_txn"];
        $pay_amount     = $params['amt'];
        $Trans_date     = $params['date'];
        $fcode          = $params['f_code'];
        $bank_name      = $params['bank_name'];
        $descriminator  = $params['discriminator'];
        $card_number    = $params['CardNumber'];
        $customername   = $params['udf1'];
        $fee_details    = $params['paid_fee_details'];

        if (!(isset($pay_amount) && !empty($pay_amount))) {
            return array('code' => 200, 'message' => 'Amount Required');
        }
        $atom_transaction_id = $mmp_txn;

        $online_pay_details = $this->MOnlinepay->get_online_pay_details($studentid, $inst_id, $acdyearid, $apikey);
        $trcount = 0;
        if (isset($online_pay_details) && !empty($online_pay_details)) {
            foreach ($online_pay_details as $opd) {
                if ($opd['atomTransactionId'] == $atom_transaction_id) {
                    $trcount = $trcount + 1;
                }
            }
            if ($trcount > 0) {
                return array('code' => 200, 'message' => 'Transaction id already exists');
            }
        }
        // return array('code' => 200, 'message' => $online_pay_details);
        // $atom_pay_data = array(
        $atom_pay_data['inst_id'] = $inst_id;
        $atom_pay_data['admissionNumber'] = stripslashes($admn_no);
        $atom_pay_data['studentId'] = $studentid;
        $atom_pay_data['cardNumber'] = $card_number;
        $atom_pay_data['product'] = '';
        $atom_pay_data['clientCode'] = '';
        $atom_pay_data['atomTransactionId'] = $atom_transaction_id;
        $atom_pay_data['transaction_date'] = $Trans_date;
        $atom_pay_data['atomSignature'] = '';
        $atom_pay_data['customerName'] = $customername;
        $atom_pay_data['customerEmailId'] = '';
        $atom_pay_data['customerMobNum'] = '';
        $atom_pay_data['billingAddress'] = '';
        $atom_pay_data['merchantData'] = '';
        $atom_pay_data['merchantId'] = $mer_txn;
        $atom_pay_data['feeId'] = '0';
        $atom_pay_data['feeAmount'] = $pay_amount;
        $atom_pay_data['sur_charge'] = '0';
        $atom_pay_data['merchantTransactionId'] = $mer_txn;
        $atom_pay_data['paymentStatus'] = $fcode;
        $atom_pay_data['paymentChannel'] = $descriminator;
        $atom_pay_data['bankTransactionId'] = '0';
        $atom_pay_data['bankName'] = $bank_name;
        // );

        // if (!(isset($params['atom_transaction_id']) && !empty($params['atom_transaction_id']))) {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Transactional ID data is required', 'data' => FALSE);
        // } else {
        //     $atom_transaction_id = $params['atom_transaction_id'];
        // }
        // if (!(isset($params['atom_pay_data']) && !empty($params['atom_pay_data']))) {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'ATOM Transaction data is required', 'data' => FALSE);
        // } else {
        //     $atom_pay_data = $params['atom_pay_data'];
        // }

        if ($fcode == 'Ok') {
            $error_student_data = array();
            $pay_data_student = array();
            $wallet_amt = $pay_amount;
            $total_vat_amount_paid = 0;
            $amount_paid = 0;
            $pay_flag = 1;

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

            $collection_data = $this->MFCollection->get_collection_data_of_student($studentid, $inst_id, $acdyearid, $apikey);
            // return $penalty_details;
            $penalty_check_array = array();
            $new_collection_data = array();
            foreach ($collection_data as $col_data1) {
                $new_collection_data[$col_data1['DEM_MONTH']][] = $col_data1;
            }
            foreach ($new_collection_data as $demmonth => $values) {
                foreach ($values as $col_data) {
                    $penalty = 0;
                    /** */
                    if (!isset($penalty_check_array[$col_data['FEEID'] . '_' . $col_data['DEM_MONTH']])) {
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
                                $penalty_check_array[$col_data['FEEID'] . '_' . $col_data['DEM_MONTH']] = $col_data['FEEID'];
                            }
                        } else {
                            $penalty = 0;
                        }
                    }
                    /** */

                    $trans_amt = ($col_data['TRANSACTION_AMOUNT'] - ($col_data['TOTAL_PAID_AMOUNT'] + $col_data['CONCESSION_AMOUNT'] + $col_data['EXEMPTION_AMOUNT'] + $col_data['TOTAL_NON_RECONCILED_AMOUNT'])); // + $col_data['NON_RECONCILED_PENALTY']
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
                                'description' => $col_data['TRANSACTION_DESC'], //. ' ' . date('M-Y', strtotime($col_data['DEMAND_DATE'])),
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
                                'transactionamount' => $col_data['TRANSACTION_AMOUNT'],
                                'transactionvatpercent' => $col_data['VAT'],
                                'transactionvatamt' => $vat_amt,
                                'transactionamtwithvat' => $wallet_amt,
                                'is_paid_full' => 0,
                                'is_partial_paid' => 1,
                                'paidamount' => $voucher_amt,
                                'paid_amt_without_tax' => ROUND(($voucher_amt <= $penalty ? 0 : $fee_paid), 2), // - $penalty
                                'paidtax' => ROUND(($voucher_amt <= $penalty ? 0 : $vat_paid), 2), //$vat_paid,
                                'penalty' => ROUND(($voucher_amt <= $penalty ? $voucher_amt : $penalty), 2),
                                'description' => ($voucher_amt <= $penalty ? $col_data['TRANSACTION_DESC'] : 'Partial Payment - ' . $col_data['TRANSACTION_DESC'] ),//. ' ' . date('M-Y', strtotime($col_data['DEMAND_DATE']))
                                'penalty_only' => ($voucher_amt <= $penalty ? 1 : 0) //1-penalty only, 0-fee+penalty 
                            );
                            $total_penalty = $total_penalty + ($voucher_amt <= $penalty ? $voucher_amt : $penalty);

                            $pay_flag = 0;
                            break;
                        }
                    }
                }
            }

            // return array(
            //     'status' => array('code' => 200,'message'=>'success'),
            //     'data' => $pay_data_student
            // );

            $data_to_save = array(
                'api_key' => $apikey,
                'inst_id' => $inst_id,
                'acd_year_id' => $acdyearid,
                'student_id' => $studentid,
                'amount_paid' => $amount_paid,
                'total_penalty' => $total_penalty,
                'payment_data' => json_encode($pay_data_student),
                'mode_of_payment' => 'O',
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
            // return array("code"=>200,"data"=>$pay_data_student);
            if (isset($pay_data_student) && !empty($pay_data_student) && count($pay_data_student) > 0) {

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
                    $data_to_save['total_vat_amount'],
                    $wallet_amt > 0 ? 1 : 0,
                    $wallet_amt > 0 ? $wallet_amt : 0,
                    $atom_transaction_id,
                    json_encode($atom_pay_data)
                );
                // return array("code"=>200,"data"=>$data);
                // return $pay_data_student;
                
                $payment_data_online = $this->MOnlinepay->save_collection_data_of_student_by_online_payment($data);
                //                dev_export($payment_data_online);die;
                if (!(isset($payment_data_online[0]['DATA_SUCCESS']) && !empty($payment_data_online[0]['DATA_SUCCESS']) && ($payment_data_online[0]['DATA_SUCCESS'] == 1))) {
                    if (isset($payment_data_online[0]['message']) && !empty($payment_data_online[0]['message'])) {
                        return array('status' => 0, 'message' => $payment_data_online[0]['message']);
                    } else {
                        return array("code" => 200, "message" => $payment_data_online);
                    }
                } else {
                    return array("code" => 200, "message" => "Payment recorded successfully");
                }
            } else {
                return array("code" => 200, "message" => "Payment failed");
            }
        }
        // else {
        //     $data_to_save = array(
        //         $apikey,
        //         $inst_id,
        //         $acdyearid,
        //         $studentid,
        //         $atom_pay_data
        //     );
        //     $payment_data_online_failed_status = $this->MOnlinepay->save_online_payment_data_failed_status($data_to_save);
        //     if (isset($payment_data_online_failed_status) && !empty($payment_data_online_failed_status)) {
        //         return array('status' => 1, 'message' => 'Payment updated the failed status successfully');
        //     } else {
        //         return array('status' => 0, 'message' => 'There was an error in saving payment data. Please try again later');
        //     }
        // }
    }
    public function get_fee_details_for_student_online_pay_display($params)
    {
        // return $params;
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

        //Penalty Details
        $penalty_date = date('Y-m-d');
        $penalty_data = $this->MFCollection->get_penalty_details($inst_id, $apikey, $penalty_date);
        $collection_data = $this->MFCollection->get_collection_data_of_student($student_id, $inst_id, $acd_year_id, $apikey);
        $online_pay_details = $this->MOnlinepay->get_online_pay_details($student_id, $inst_id, $acd_year_id, $apikey);

        $total_amt_data = $this->MFCollection->get_collection_data_of_student_sum($student_id, $inst_id, $acd_year_id, $apikey);

        if (isset($total_amt_data) && !empty($total_amt_data) && is_array($total_amt_data)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Data loaded successfully',
                'data' => $collection_data,
                'summary_data' => $total_amt_data[0],
                'card_service_charge' => $card_service_charge,
                'payment_history_data' => $online_pay_details,
                'penalty_details' => $penalty_data,
            );
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loading failed or no data available', 'data' => $collection_data);
        }
    }
    public function save_atompay_details($params)
    {
        // return $params;
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
        if (!(isset($params['customer_name']) && !empty($params['customer_name']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_name = $params['customer_name'];
        }
        if (!(isset($params['Transaction_amount']) && !empty($params['Transaction_amount']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pay data is required', 'data' => FALSE);
        } else {
            $pay_amount = $params['Transaction_amount'];
        }
        if (!(isset($params['Transaction_status']) && !empty($params['Transaction_status']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Transactional status data is required', 'data' => FALSE);
        } else {
            $Transaction_status = $params['Transaction_status'];
        }
        if (!(isset($params['atom_transaction_id']) && !empty($params['atom_transaction_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Transactional ID data is required', 'data' => FALSE);
        } else {
            $atom_transaction_id = $params['atom_transaction_id'];
        }
        if (!(isset($params['atom_pay_data']) && !empty($params['atom_pay_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ATOM Transaction data is required', 'data' => FALSE);
        } else {
            $atom_pay_data = $params['atom_pay_data'];
        }

        if ($Transaction_status == 'Ok') {
            $error_student_data = array();
            $pay_data_student = array();
            $wallet_amt = $pay_amount;
            $total_vat_amount_paid = 0;
            $amount_paid = 0;
            $pay_flag = 1;

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

            $collection_data = $this->MFCollection->get_collection_data_of_student($student_id, $inst_id, $acd_year_id, $apikey);
            // return $penalty_details;
            $penalty_check_array = array();
            foreach ($collection_data as $col_data) {
                $penalty = 0;
                /** */
                if (!isset($penalty_check_array[$col_data['FEEID'] . '_' . $col_data['DEM_MONTH']])) {
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
                            $penalty_check_array[$col_data['FEEID'] . '_' . $col_data['DEM_MONTH']] = $col_data['FEEID'];
                        }
                    } else {
                        $penalty = 0;
                    }
                }
                /** */
                $trans_amt = ($col_data['TRANSACTION_AMOUNT'] - ($col_data['TOTAL_PAID_AMOUNT'] + $col_data['CONCESSION_AMOUNT'] + $col_data['EXEMPTION_AMOUNT'] + $col_data['TOTAL_NON_RECONCILED_AMOUNT'])); // + $col_data['NON_RECONCILED_PENALTY']
                // $trans_amt = ($col_data['TRANSACTION_AMOUNT'] - ($col_data['CONCESSION_AMOUNT'] + $col_data['EXEMPTION_AMOUNT'] + $col_data['TOTAL_NON_RECONCILED_AMOUNT'] + $col_data['NON_RECONCILED_PENALTY']));
                $vat_amt = $col_data['IS_VAT'] == 1 ? $trans_amt * $col_data['VAT'] / 100 : 0;
                $total_remain_amt = $trans_amt + $vat_amt + $penalty;
                if ($wallet_amt > 0 && $pay_flag == 1) {
                    if (($wallet_amt - $total_remain_amt) >= 0) {
                        $total_vat_amount_paid = $total_vat_amount_paid + $vat_amt;
                        $amount_paid = $amount_paid + $total_remain_amt;
                        // $pay_data_student[] = array(
                        //     'transaction_id' => $col_data['ID'],
                        //     'demanddate' => $col_data['DEMAND_DATE'],
                        //     'transactionamount' => $col_data['TRANSACTION_AMOUNT'],
                        //     'transactionvatpercent' => $col_data['VAT'],
                        //     'transactionvatamt' => $vat_amt,
                        //     'transactionamtwithvat' => $total_remain_amt,
                        //     'is_paid_full' => 1,
                        //     'is_partial_paid' => 0,
                        //     'paidamount' => $total_remain_amt,
                        //     'paid_amt_without_tax' => $col_data['TRANSACTION_AMOUNT'],
                        //     'paidtax' => $vat_amt,
                        //     'description' => $col_data['TRANSACTION_DESC']
                        // );
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
                            'description' => $col_data['TRANSACTION_DESC'],// . ' ' . date('M-Y', strtotime($col_data['DEMAND_DATE'])),
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
                            'description' => ($voucher_amt <= $penalty ? $col_data['TRANSACTION_DESC'] : 'Partial Payment - ' . $col_data['TRANSACTION_DESC']), //. ' ' . date('M-Y', strtotime($col_data['DEMAND_DATE']))
                            'penalty_only' => ($voucher_amt <= $penalty ? 1 : 0) //1-penalty only, 0-fee+penalty 
                        );
                        $total_penalty = $total_penalty + ($voucher_amt <= $penalty ? $voucher_amt : $penalty);

                        $pay_flag = 0;
                        break;
                    }
                    // else {

                    //     if ($wallet_amt > 0) {

                    //         $vat_percent = $col_data['IS_VAT'] == 1 ? $col_data['VAT'] : 0;

                    //         $fee_paid = round(((100 * $wallet_amt) / (100 + $vat_percent)), 2, PHP_ROUND_HALF_UP);
                    //         $vat_paid = round(($fee_paid * $vat_percent / 100), 2, PHP_ROUND_HALF_UP);


                    //         //                            dev_export( $col_data['TRANSACTION_DESC']);DIE;
                    //         $total_remain_amt = $fee_paid + $vat_paid;
                    //         $total_vat_amount_paid = $total_vat_amount_paid + $vat_paid;
                    //         $amount_paid = $amount_paid + $total_remain_amt;
                    //         $pay_data_student[] = array(
                    //             'transaction_id' => $col_data['ID'],
                    //             'demanddate' => $col_data['DEMAND_DATE'],
                    //             'transactionamount' => $fee_paid,
                    //             'transactionvatpercent' => $col_data['VAT'],
                    //             'transactionvatamt' => $vat_paid,
                    //             'transactionamtwithvat' => $total_remain_amt,
                    //             'is_paid_full' => 0,
                    //             'is_partial_paid' => 1,
                    //             'paidamount' => $total_remain_amt,
                    //             'paid_amt_without_tax' => $fee_paid,
                    //             'paidtax' => $vat_paid,
                    //             'description' => "Partial payment on " . $col_data['TRANSACTION_DESC']
                    //         );
                    //         $wallet_amt = 0;

                    //         $pay_flag = 0;
                    //         break;
                    //     } else {
                    //         $pay_flag = 0;
                    //         break;
                    //     }
                    // }
                }
            }

            //            dev_export($pay_data_student);
            //            die;
            $data_to_save = array(
                'api_key' => $apikey,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'student_id' => $student_id,
                'amount_paid' => $amount_paid,
                'total_penalty' => $total_penalty,
                'payment_data' => json_encode($pay_data_student),
                'mode_of_payment' => 'O',
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

            //            dev_export(json_decode($atom_pay_data));
            //            die;
            if (isset($pay_data_student) && !empty($pay_data_student) && count($pay_data_student) > 0) {

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
                    $data_to_save['total_vat_amount'],
                    $wallet_amt > 0 ? 1 : 0,
                    $wallet_amt > 0 ? $wallet_amt : 0,
                    $atom_transaction_id,
                    $atom_pay_data
                );

                $payment_data_online = $this->MOnlinepay->save_collection_data_of_student_by_online_payment($data);
                //                dev_export($payment_data_online);die;
                if (!(isset($payment_data_online[0]['DATA_SUCCESS']) && !empty($payment_data_online[0]['DATA_SUCCESS']) && ($payment_data_online[0]['DATA_SUCCESS'] == 1))) {
                    if (isset($payment_data_online[0]['message']) && !empty($payment_data_online[0]['message'])) {
                        return array('status' => 0, 'message' => $payment_data_online[0]['message']);
                    } else {
                        return array('status' => 0, 'message' => 'Data creation / updation failed or no data available');
                    }
                } else {
                    return array('status' => 1, 'message' => 'Payment updated successfully', 'data' => $payment_data_online);
                }
            } else {
                return array('status' => 0, 'message' => 'The data balance is not enough to make a full payment');
            }
        } else {
            $data_to_save = array(
                $apikey,
                $inst_id,
                $acd_year_id,
                $student_id,
                $atom_pay_data
            );
            $payment_data_online_failed_status = $this->MOnlinepay->save_online_payment_data_failed_status($data_to_save);
            if (isset($payment_data_online_failed_status) && !empty($payment_data_online_failed_status)) {
                return array('status' => 1, 'message' => 'Payment updated the failed status successfully');
            } else {
                return array('status' => 0, 'message' => 'There was an error in saving payment data. Please try again later');
            }
        }
    }
    public function deposit_wallet_atom($params)
    {
        // return $params;
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
        if (!(isset($params['customer_name']) && !empty($params['customer_name']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_name = $params['customer_name'];
        }
        if (!(isset($params['Transaction_amount']) && !empty($params['Transaction_amount']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pay data is required', 'data' => FALSE);
        } else {
            $pay_amount = $params['Transaction_amount'];
        }
        if (!(isset($params['Transaction_status']) && !empty($params['Transaction_status']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Transactional status data is required', 'data' => FALSE);
        } else {
            $Transaction_status = $params['Transaction_status'];
        }
        if (!(isset($params['atom_transaction_id']) && !empty($params['atom_transaction_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Transactional ID data is required', 'data' => FALSE);
        } else {
            $atom_transaction_id = $params['atom_transaction_id'];
        }
        if (!(isset($params['atom_pay_data']) && !empty($params['atom_pay_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ATOM Transaction data is required', 'data' => FALSE);
        } else {
            $atom_pay_data = $params['atom_pay_data'];
        }

        if ($Transaction_status == 'Ok') {
            $error_student_data = array();
            $pay_data_student = array();

            $data_to_save = array(
                $apikey,
                $inst_id,
                $acd_year_id,
                $student_id,
                $pay_amount,
                $atom_transaction_id,
                $atom_pay_data
            );
            $payment_data_online = $this->MOnlinepay->save_ewallet_amount_data_of_student_byonline($data_to_save);
            //                dev_export($payment_data_online);die;
            if (!(isset($payment_data_online[0]['DATA_SUCCESS']) && !empty($payment_data_online[0]['DATA_SUCCESS']) && ($payment_data_online[0]['DATA_SUCCESS'] == 1))) {
                if (isset($payment_data_online[0]['message']) && !empty($payment_data_online[0]['message'])) {
                    return array('status' => 0, 'message' => $payment_data_online[0]['message']);
                } else {
                    return array('status' => 0, 'message' => 'Data creation / updation failed or no data available');
                }
            } else {
                return array('status' => 1, 'message' => 'Payment updated successfully', 'data' => $payment_data_online);
            }
        } else {
            $data_to_save = array(
                $apikey,
                $inst_id,
                $acd_year_id,
                $student_id,
                $atom_pay_data
            );
            $payment_data_online_failed_status = $this->MOnlinepay->save_online_payment_data_failed_status($data_to_save);
            if (isset($payment_data_online_failed_status) && !empty($payment_data_online_failed_status)) {
                return array('status' => 1, 'message' => 'Payment updated the failed status successfully');
            } else {
                return array('status' => 0, 'message' => 'There was an error in saving payment data. Please try again later');
            }
        }
    }
}
