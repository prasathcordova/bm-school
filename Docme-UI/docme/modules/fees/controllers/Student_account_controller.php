<?php

/**
 * Description of Student_account_controller
 *
 * @author Aju S Aravind
 * For operations regarding Student Accounts handling
 */
class Student_account_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!(isLoggedin() == 1)) {
            if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
                header("HTTP/1.1 401 UNauthorized");
                die();
            } else {
                $path = base_url();
                redirect($path);
            }
        }
        $this->load->model('student_settings/Registration_model', 'MRegistration');
        $this->load->model('Nondemandfee_model', 'MNondemand_fee');
        $this->load->model('Student_account_model', 'MAccount');
    }

    public function get_student_filter_for_account()
    {

        //        STREAM DATA
        $stream = $this->MNondemand_fee->get_all_stream();
        if (isset($stream['error_status']) && $stream['error_status'] == 0) {
            if ($stream['data_status'] == 1) {
                $data['stream_data'] = $stream['data'];
            } else {
                $data['stream_data'] = FALSE;
            }
        } else {
            $data['stream_data'] = FALSE;
        }
        $data['stream_data'] = $stream['data'];

        //        CLASS DATA
        $class = $this->MNondemand_fee->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data_for_registration'] = $class['data'];
            } else {
                $data['class_data_for_registration'] = FALSE;
            }
        } else {
            $data['class_data_for_registration'] = FALSE;
        }
        //        ACD YEAR DATA
        $acdyr = $this->MNondemand_fee->get_all_acadyr();
        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
            if ($acdyr['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        //        BATCH DATA
        $batch = $this->MNondemand_fee->get_all_batch($this->session->userdata('acd_year'));
        if (isset($batch['error_status']) && $batch['error_status'] == 0) {
            if ($batch['data_status'] == 1) {
                $data['batch_data'] = $batch['data'];
            } else {
                $data['batch_data'] = FALSE;
            }
        } else {
            $data['batch_data'] = FALSE;
        }


        $this->load->view('account/student_filter', $data);
    }

    public function search_byname_for_account()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            $details_data = $this->MNondemand_fee->student_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['user_name'] = $this->session->userdata('user_name');
            echo json_encode(array('status' => 1, 'view' => $this->load->view('account/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function advancesearch_byname_for_account()
    {                                               //display students list on search
        $data['title'] = 'STUDENTS LIST';
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $data_prep['batch_id'] = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['stream_id'] = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['class_id'] = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['curent_acdyr'] = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['searchname'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            if ($data_prep['stream_id'] == -1) {
                $data_prep['stream_id'] = '';
            }
            if ($data_prep['curent_acdyr'] == -1) {
                $data_prep['curent_acdyr'] = '';
            }
            if ($data_prep['class_id'] == -1) {
                $data_prep['class_id'] = '';
            }
            $details_data = $this->MNondemand_fee->studentadvance_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            echo json_encode(array('status' => 1, 'view' => $this->load->view('account/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function batchlist_for_account()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $stream_id = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $academic_year = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $session_id = NULL;
            $flag_status = NULL;
            if ($stream_id == -1) {
                $stream_id = NULL;
            }
            if ($academic_year == -1) {
                $academic_year = NULL;
            }
            if ($class_id == -1) {
                $class_id = NULL;
            }
            $details_data = $this->MNondemand_fee->get_batch_data($stream_id, $academic_year, $session_id, $class_id, $flag_status);
            if (isset($details_data['error_status']) && $details_data['error_status'] == 0) {
                if ($details_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $details_data['data']));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function show_account_details_of_student()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_name = filter_input(INPUT_POST, 'studentname', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $student_id = strtoupper(filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING));
            $details_data = $this->MAccount->get_student_account_data($student_id, $inst_id, $acd_year_id);
            $student_data = $this->MRegistration->get_profiles_student($student_id);
            // dev_export($details_data);
            // die;
            if (isset($details_data['data_detail']) && !empty($details_data['data_detail']) && isset($details_data['data_summary']) && !empty($details_data['data_summary']) && $student_data['error_status'] == 0 && $student_data['data_status'] == 1) {

                //Demand statement
                if (isset($details_data['data_detail'][0]['DEMAND_STATEMENT'])) {
                    $demand_statement_raw = $details_data['data_detail'][0]['DEMAND_STATEMENT'];
                    $demand_statement = json_decode($demand_statement_raw, true);
                } else {
                    $demand_statement = NULL;
                }
                //Demand statement Previous Year
                if (isset($details_data['data_detail'][0]['DEMAND_STATEMENT_PREV_YR'])) {
                    $demand_statement_raw_prev = $details_data['data_detail'][0]['DEMAND_STATEMENT_PREV_YR'];
                    $demand_statement_prev = json_decode($demand_statement_raw_prev, true);
                } else {
                    $demand_statement_prev = NULL;
                }
                //Payment data
                if (isset($details_data['data_detail'][0]['PAYMENT_STATEMENT'])) {
                    $payment_statement_raw = $details_data['data_detail'][0]['PAYMENT_STATEMENT'];
                    $payment_statement = json_decode($payment_statement_raw, true);
                } else {
                    $payment_statement = NULL;
                }
                // dev_export($payment_statement);
                // die;
                //Docme Wallet data
                if (isset($details_data['data_detail'][0]['WALLET_STATEMENT'])) {
                    $wallet_statement_raw = $details_data['data_detail'][0]['WALLET_STATEMENT'];
                    $wallet_statement = json_decode($wallet_statement_raw, true);
                } else {
                    $wallet_statement = NULL;
                }

                $data['demand_statement'] = $demand_statement;
                $data['demand_statement_prev'] = $demand_statement_prev;
                $data['payment_statement'] = $payment_statement;
                $data['wallet_statement'] = $wallet_statement;
                // dev_export($details_data);
                // die;
                $total_demanded_amount = 0;
                $demand_type_amount = 0;
                $nondemandable_type_amount = 0;
                $demand_with_vat = 0;
                $demand_paid = 0;
                $non_demand_with_vat = 0;
                $non_demand_paid = 0;

                $pending_arrear_amount = 0;
                $VAT_amount = 0;

                $wallet_final_balance = 0;
                $wallet_unclear_amount = 0;

                $total_cheque_non_reconciled_transaction = 0;

                $total_paid_amount = 0;
                $total_surcharge = 0;
                $total_cash_transaction = 0;
                $total_card_transaction = 0;
                $total_cheque_transaction = 0;
                $total_cheque_non_realized_amt = 0;
                $total_cheque_realized_amount = 0;
                $total_wallet_payment = 0;
                $total_online_payment = 0;
                $total_dbt_payment = 0;

                $total_demand_paid_amount = 0;

                $total_pending_amount_incl_vat = 0;

                $total_realized_chq_amt = 0;
                $total_other_realized = 0;
                $total_non_realized = 0;
                $total_realized_amt = 0;

                //Summary Data
                //Demand Amount                
                $summary_demand_data_raw = json_decode($details_data['data_summary'][0]['DEMAND_DATA'], TRUE);
                $total_concession_amount = 0;
                $total_exemption_amount = 0;
                $total_demanded_amount_minus_concn_exmn = 0;
                if (isset($summary_demand_data_raw) && !empty($summary_demand_data_raw)) {
                    foreach ($summary_demand_data_raw as $demand_summary) {
                        if ($demand_summary['fee_demand_type'] == 'Demandable Fee') {
                            $total_demanded_amount = $total_demanded_amount + $demand_summary['TRANSACTION_AMOUNT_WITH_VAT'];
                            $total_demanded_amount_minus_concn_exmn = $total_demanded_amount_minus_concn_exmn + $demand_summary['TRANSACTION_AMOUNT_WITH_VAT_MINUS_EXMN_CONCN'];
                            $demand_paid = $demand_summary['TOTAL_PAID_AMOUNT'];
                            $demand_with_vat = $demand_summary['TRANSACTION_AMOUNT_WITH_VAT'];
                            $demand_type_amount = ($demand_summary['AMOUNT_WITHOUT_VAT']); // - $demand_summary['CONCESSION_AMOUNT'] - $demand_summary['EXEMPTION_AMOUNT']);
                            $total_demand_paid_amount = $total_demand_paid_amount + $demand_summary['TOTAL_PAID_AMOUNT']; // + $demand_summary['CONCESSION_AMOUNT'] + $demand_summary['EXEMPTION_AMOUNT'];
                            $total_concession_amount += $demand_summary['CONCESSION_AMOUNT'];
                            $total_exemption_amount += $demand_summary['EXEMPTION_AMOUNT'];
                        }
                        if ($demand_summary['fee_demand_type'] == 'Non Demandable Fee') {
                            $total_demanded_amount = $total_demanded_amount + $demand_summary['TRANSACTION_AMOUNT_WITH_VAT'];
                            $total_demanded_amount_minus_concn_exmn = $total_demanded_amount_minus_concn_exmn + $demand_summary['TRANSACTION_AMOUNT_WITH_VAT_MINUS_EXMN_CONCN'];
                            $non_demand_paid = $demand_summary['TOTAL_PAID_AMOUNT'];
                            $non_demand_with_vat = $demand_summary['TRANSACTION_AMOUNT_WITH_VAT'];
                            $nondemandable_type_amount = $demand_summary['AMOUNT_WITHOUT_VAT'];
                            $total_demand_paid_amount = $total_demand_paid_amount + $demand_summary['TOTAL_PAID_AMOUNT']; // + $demand_summary['CONCESSION_AMOUNT'] + $demand_summary['EXEMPTION_AMOUNT'];
                            $total_concession_amount += $demand_summary['CONCESSION_AMOUNT'];
                            $total_exemption_amount += $demand_summary['EXEMPTION_AMOUNT'];
                        }
                    }
                }
                //Penalty Data
                $summary_penalty_data_raw = json_decode($details_data['data_summary'][0]['PENALTY_DATA'], TRUE);
                if (isset($summary_penalty_data_raw) && !empty($summary_penalty_data_raw) && isset($summary_penalty_data_raw[0]['PENALTY_AMOUNT']) && !empty($summary_penalty_data_raw[0]['PENALTY_AMOUNT'])) {
                    $penalty_amount = $summary_penalty_data_raw[0]['PENALTY_AMOUNT'];
                } else {
                    $penalty_amount = 0;
                }
                //Penalty Data
                $PAID_DATA_raw = json_decode($details_data['data_summary'][0]['PAID_DATA'], TRUE);
                if (isset($PAID_DATA_raw) && !empty($PAID_DATA_raw) && isset($PAID_DATA_raw[0]['TOTAL_PAID_AMOUNT']) && !empty($PAID_DATA_raw[0]['TOTAL_PAID_AMOUNT'])) {
                    $PAID_DATA = $PAID_DATA_raw[0]['TOTAL_PAID_AMOUNT'];
                } else {
                    $PAID_DATA = 0;
                }
                $data['PAID_DATA'] = $PAID_DATA;
                $tot_exp_conc_amount = $total_concession_amount + $total_exemption_amount;
                $data['total_demand_amt'] = $total_demanded_amount;
                $data['total_demand_amt_after_conc_exmp'] = $demand_type_amount - $tot_exp_conc_amount;
                $data['demandable_without_vat'] = $demand_type_amount;
                $data['demandable_with_vat'] = $demand_with_vat;
                $data['demandable_paid_amount'] = $demand_paid;

                $data['non_demandable_without_vat'] = $nondemandable_type_amount;
                $data['non_demandable_with_vat'] = $non_demand_with_vat;
                $data['non_demandable_paid_amount'] = $non_demand_paid;
                $data['total_demand_paid_amount'] = ($total_demand_paid_amount); // - $penalty_amount
                $total_payable_amount = $total_demanded_amount_minus_concn_exmn - ($total_demand_paid_amount); //- $penalty_amount
                $data['total_payable_amount'] = $total_payable_amount;
                $data['display_percent'] = ($total_demanded_amount_minus_concn_exmn > 0 ? (($total_demand_paid_amount) / $total_demanded_amount_minus_concn_exmn * 100) : 0); //- $penalty_amount //, 2, PHP_ROUND_HALF_UP

                //Payment Data
                $summary_payment_data_raw = json_decode($details_data['data_summary'][0]['PAYMENT_DATA'], TRUE);
                if (isset($summary_payment_data_raw) && !empty($summary_payment_data_raw)) {
                    $total_cheque_non_reconciled_transaction = $summary_payment_data_raw[0]['TOTAL_NON_RECON_AMT'];
                    $total_pending_amount_incl_vat = $summary_payment_data_raw[0]['PENDING_PAYMENT_INCL_VAT'];
                }

                $data['total_pending_payment'] = $total_pending_amount_incl_vat;
                $data['total_non_reconciled_cheque_amount'] = $total_cheque_non_reconciled_transaction;

                //Collection Realized grouping
                $summary_payment_realize_data_raw = json_decode($details_data['data_summary'][0]['CHEQUE_STATUS_DATA'], TRUE);
                if (isset($summary_payment_realize_data_raw) && !empty($summary_payment_realize_data_raw)) {
                    foreach ($summary_payment_realize_data_raw as $summary_data) {
                        if ($summary_data['cheque_status'] == 'OTHER REALIZED') {
                            $total_other_realized = $total_other_realized + $summary_data['total_sum'];
                        }
                        if ($summary_data['cheque_status'] == 'REALIZED') {
                            $total_realized_chq_amt = $total_realized_amt + $summary_data['total_sum'];
                        }
                        if ($summary_data['cheque_status'] == 'NON REALIZED') {
                            $total_non_realized = $total_non_realized + $summary_data['total_sum'];
                        }
                    }
                }

                $total_realized_amt = $total_other_realized + $total_realized_chq_amt;
                $data['total_realized_amt'] = $total_realized_amt;
                $data['total_non_realized_amt'] = $total_non_realized;


                //Payment mode wise data
                $summary_payment_mode_wise_raw = json_decode($details_data['data_summary'][0]['PAYMENT_MODE_WISE'], TRUE);
                if (isset($summary_payment_mode_wise_raw) && !empty($summary_payment_mode_wise_raw)) {
                    // dev_export($summary_payment_mode_wise_raw);
                    // die;
                    foreach ($summary_payment_mode_wise_raw as $summary_data) {
                        if ($summary_data['MODE_OF_PAYMENT'] == 'WALLET') { //&& $summary_data['MODE_OF_PAYMENT'] == 1
                            $total_wallet_payment = $summary_data['total_sum']; // - $tot_exp_conc_amount; //$summary_data['concession_amount']; //
                            $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                        }
                        if ($summary_data['MODE_OF_PAYMENT'] == 'ONLINE') {
                            $total_online_payment = $summary_data['total_sum'];
                            $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                        }
                        if ($summary_data['MODE_OF_PAYMENT'] == 'DBT') {
                            $total_dbt_payment = $summary_data['total_sum'];
                            $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                        }
                        if ($summary_data['MODE_OF_PAYMENT'] == 'CASH') {
                            $total_cash_transaction = $summary_data['total_sum'];
                            $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                        }
                        if ($summary_data['MODE_OF_PAYMENT'] == 'CARD') {
                            $total_card_transaction = $summary_data['total_sum'];
                            $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];

                            $total_surcharge = $summary_data['total_surcharge'];
                        }
                        if ($summary_data['MODE_OF_PAYMENT'] == 'CHEQUE') {
                            if ($summary_data['cheque_status'] == 'CHQ RECONCILED') {
                                $total_cheque_realized_amount = $total_cheque_realized_amount + $summary_data['total_sum'];
                                $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                                $total_cheque_transaction = $total_cheque_transaction + $summary_data['total_sum'];
                            }
                            if ($summary_data['cheque_status'] == 'CHQ NON RECONCILED') {
                                $total_cheque_non_realized_amt = $total_cheque_non_realized_amt + $summary_data['total_sum'];
                                $total_cheque_transaction = $total_cheque_transaction + $summary_data['total_sum'];
                            }
                        }
                    }
                }
                // dev_export($summary_data);
                // die;
                $data['cash_transaction']   = $total_cash_transaction;
                $data['card_transaction']   = $total_card_transaction;
                $data['card_surcharge']     = $total_surcharge;
                $data['wallet_transaction'] = $total_wallet_payment;
                $data['cheque_total_transaction'] = $total_cheque_transaction;
                $data['cheque_reconcile_transaction'] = $total_realized_chq_amt;//$total_cheque_realized_amount;
                $data['cheque_non_reconcile_transaction'] = $total_cheque_non_realized_amt;
                $data['online_transaction'] = $total_online_payment;
                $data['dbt_transaction'] = $total_dbt_payment;
                $data['total_paid_amount'] = $total_paid_amount;

                //Arrear Data
                $summary_arrear_data_raw = json_decode($details_data['data_summary'][0]['ARREAR_DATA'], TRUE);
                if (isset($summary_arrear_data_raw) && !empty($summary_arrear_data_raw)) {
                    foreach ($summary_arrear_data_raw as $arrear_summary_data) {
                        $pending_arrear_amount += $arrear_summary_data['TOTALPENDING_ARREAR_AMOUNT'];
                    }
                }
                $data['total_arrear_amount'] = $pending_arrear_amount;

                //Arrear Data Previous Year
                $pending_arrear_amount_prev = 0;
                $summary_arrear_data_raw_prev = json_decode($details_data['data_summary'][0]['ARREAR_DATA_PREV'], TRUE);
                if (isset($summary_arrear_data_raw_prev) && !empty($summary_arrear_data_raw_prev)) {
                    foreach ($summary_arrear_data_raw_prev as $arrear_summary_data_prev) {
                        $pending_arrear_amount_prev += $arrear_summary_data_prev['TOTALPENDING_ARREAR_AMOUNT'];
                    }
                }
                $data['total_arrear_amount_prev'] = $pending_arrear_amount_prev;

                //VAT/TAX Data
                $summary_VAT_data_raw = json_decode($details_data['data_summary'][0]['VAT_DATA'], TRUE);
                if (isset($summary_VAT_data_raw) && !empty($summary_VAT_data_raw)) {
                    foreach ($summary_VAT_data_raw as $VAT_summary_data) {
                        $VAT_amount += $VAT_summary_data['VAT_AMOUNT'];
                    }
                }
                $data['total_vat_amount'] = $VAT_amount;

                //Wallet Data
                $summary_wallet_data_raw = json_decode($details_data['data_summary'][0]['DOCME_WALLET_DATA'], TRUE);
                if (isset($summary_wallet_data_raw) && !empty($summary_wallet_data_raw)) {
                    $wallet_final_balance = $summary_wallet_data_raw[0]['ACCOUNT_BALANCE'];
                    $wallet_unclear_amount = $summary_wallet_data_raw[0]['UNCLEAR_ACCOUNT_BALANCE'];
                }
                $data['wallet_clear_balance'] = $wallet_final_balance;
                $data['wallet_unclear_balance'] = $wallet_unclear_amount;

                //Payback Data
                $summary_payback_data_raw = json_decode($details_data['data_summary'][0]['PAY_BACK_DATA'], TRUE);
                if (isset($summary_payback_data_raw) && !empty($summary_payback_data_raw) && isset($summary_payback_data_raw[0]['PAYBACK_AMOUNT']) && !empty($summary_payback_data_raw[0]['PAYBACK_AMOUNT'])) {
                    $payback_amount = $summary_payback_data_raw[0]['PAYBACK_AMOUNT'];
                } else {
                    $payback_amount = 0;
                }
                //Round OFF Data
                $summary_roundoff_data_raw = json_decode($details_data['data_summary'][0]['ROUNDOFF_DATA'], TRUE);
                if (isset($summary_roundoff_data_raw) && !empty($summary_roundoff_data_raw) && isset($summary_roundoff_data_raw[0]['ROUNDOFF_AMOUNT']) && !empty($summary_roundoff_data_raw[0]['ROUNDOFF_AMOUNT'])) {
                    $roundoff_amount = $summary_roundoff_data_raw[0]['ROUNDOFF_AMOUNT'];
                } else {
                    $roundoff_amount = 0;
                }

                $data['payback_amount']     = $payback_amount;
                $data['penalty_amount']     = $penalty_amount;
                $data['roundoff_amount']    = $roundoff_amount;
                $data['concession_amount']  = $total_concession_amount;
                $data['exemption_amount']   = $total_exemption_amount;
                $data['tot_exp_conc_amount']   = $tot_exp_conc_amount;


                if (isset($details_data['penalty_details']) && !empty($details_data['penalty_details'])) {
                    $data['penalty_details'] = $details_data['penalty_details'];
                    $penaltyarray = array();
                    foreach ($details_data['penalty_details'] as $pdls) {
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
                    $data['penalty_details'] = NULL;
                } //$data['demand_statement']
                $totalpenalty = 0;
                $penalty_check_array = array();
                if (isset($demand_statement) && !empty($demand_statement)) {
                    foreach ($demand_statement as $demand) {
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
                                if ($symbol == '+' && $days_difference != 0) {
                                    $penalty = 0;
                                } else {
                                    // if ($demanddate <= $effect_date) {
                                    //if ($penaltyarray[$demand['FEEID']]['penalty_type'] == 'S') { //for slab penalty calculation
                                    foreach ($penaltyarray[$demand['FEEID']]['details'] as $pda) {
                                        if ($days_difference >= $pda['FromDays']) {
                                            $penalty = $pda['amount'];
                                            break;
                                        } else {
                                            $penalty = 0;
                                            continue;
                                        }
                                    }
                                    //} else { //for fixed penalty calculation
                                    //$penalty = $penaltyarray[$demand['FEEID']]['details'][0]['amount'];
                                    //}
                                    //}
                                    // $penalty = (($penalty - ($demand['PENALTY_PAID'] + $demand['NRC_PENALTY_PAID'])) > 0 ? ($penalty - ($demand['PENALTY_PAID'] + $demand['NRC_PENALTY_PAID'])) : 0);
                                    $penalty = (($penalty - $demand['PENALTY_PAID']) > 0 ? ($penalty - $demand['PENALTY_PAID']) : 0);
                                    $penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']] = $demand['FEEID'];
                                    if (($demand['TRANSACTION_AMOUNT'] - $demand['EXEMPTION_PENDING_AMOUNT']) == 0) {
                                        $penalty = 0;
                                    }
                                    if (($demand['PENDING_PAYMENT'] - $demand['NON_RECONCILED_AMOUNT']) == 0) {
                                        $penalty = 0;
                                    }
                                }
                            } else {
                                $penalty = 0;
                            }
                        }
                        $penalty = ($demand['PENDING_PAYMENT'] > 0 ? $penalty : 0);
                        $totalpenalty += $penalty;
                    }
                }
                $data['total_penalty'] = $totalpenalty;

                /** Pevious Year */
                $totalpenalty_prev = 0;
                $penalty_check_array = array();
                if (isset($demand_statement_prev) && !empty($demand_statement_prev)) {
                    foreach ($demand_statement_prev as $demand) {
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
                                if ($symbol == '+' && $days_difference != 0) {
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
                                    // $penalty = (($penalty - ($demand['PENALTY_PAID'] + $demand['NRC_PENALTY_PAID'])) > 0 ? ($penalty - ($demand['PENALTY_PAID'] + $demand['NRC_PENALTY_PAID'])) : 0);
                                    $penalty = (($penalty - $demand['PENALTY_PAID']) > 0 ? ($penalty - $demand['PENALTY_PAID']) : 0);
                                    $penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']] = $demand['FEEID'];
                                    if (($demand['TRANSACTION_AMOUNT'] - $demand['EXEMPTION_PENDING_AMOUNT']) == 0) {
                                        $penalty = 0;
                                    }
                                }
                            } else {
                                $penalty = 0;
                            }
                        }
                        $penalty = ($demand['PENDING_PAYMENT'] > 0 ? $penalty : 0);
                        $totalpenalty_prev += $penalty;
                    }
                }
                $data['totalpenalty_prev'] = $totalpenalty_prev;
                /** Pevious Year */

                //Wallet withdraw Data
                $summary_wallet_withdraw_data_raw = json_decode($details_data['data_summary'][0]['WALLET_WITHDRAW_DATA'], TRUE);
                $wallet_withdraw_not_encash_data = 0;
                $wallet_withdraw_encash_data = 0;
                $wallet_withdraw_total = 0;

                if (isset($summary_wallet_withdraw_data_raw) && is_array($summary_wallet_withdraw_data_raw)) {
                    foreach ($summary_wallet_withdraw_data_raw as $wdata) {
                        if (isset($wdata['ENCASH_STATUS']) && $wdata['ENCASH_STATUS'] == 1) {
                            $wallet_withdraw_encash_data = $wdata['AMOUNT'];
                            $wallet_withdraw_total = $wallet_withdraw_total + $wallet_withdraw_encash_data;
                        } else if (isset($wdata['ENCASH_STATUS']) && $wdata['ENCASH_STATUS'] == 0) {
                            $wallet_withdraw_not_encash_data = $wdata['AMOUNT'];
                            $wallet_withdraw_total = $wallet_withdraw_total + $wallet_withdraw_not_encash_data;
                        }
                    }
                } else {
                    $wallet_withdraw_not_encash_data = 0;
                    $wallet_withdraw_encash_data = 0;
                    $wallet_withdraw_total = 0;
                }
                $data['wallet_encash_data'] = $wallet_withdraw_encash_data;
                $data['wallet_not_encash_data'] = $wallet_withdraw_not_encash_data;
                $data['wallet_total_encash_data'] = $wallet_withdraw_total;



                $data['student_data'] = $student_data['data'][0];
                $data['message'] = "";

                $data['sub_title'] = 'Student Account Management';


                echo json_encode(array('status' => 1, 'view' => $this->load->view('account/student_account', $data, TRUE)));
                return true;
            } else {
                $data['details_data'] = NULL;
                echo json_encode(array('status' => 2, 'message' => 'Student data is not available.'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
