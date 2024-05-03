<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student_controller
 *
 * @author chandrajith.edsys
 */
class Student_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Student_model', 'Mstudent');
        $this->load->model('Parentlogin_model', 'MPlogin');
        $this->load->helper('mailgun');
        if (!isLoggedin()) {
            // if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
            //     header("HTTP/1.1 401 UNauthorized");
            //     die();
            // } else {
            //     redirect(base_url('portal/parent-login'));
            // }
        }
    }

    public function show_student()
    {
        if (!isLoggedin()) {
            if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
                header("HTTP/1.1 401 UNauthorized");
                die();
            } else {
                redirect(base_url('portal/parent-login'));
            }
        }
        //        dev_export($_SESSION);die;
        $parent_id = $this->session->userdata('parent_id');
        $inst_id = $this->session->userdata('inst_id');
        $details_data = $this->Mstudent->get_all_studentdata($parent_id, $inst_id);
        //        dev_export($details_data);die;
        if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
            $data['sdetails_data'] = $details_data['data'];
            $data['details_data'] = $details_data['data-fees'];
            $data['payment_data'] = $details_data['data-payments'];
            $data['message'] = "";
        } else {
            $data['details_data'] = FALSE;
            $data['message'] = $details_data['message'];
        }
        //        dev_export($data);die;
        $data['template'] = 'student/student_list_details';
        $this->load->view('template/parent_template', $data);
    }


    public function show_fee_details($admission_number, $inst_id)
    {
        $this->clearCache();
        $this->session->set_userdata('admn_no_enc', $admission_number);
        $admission_number = base64_decode($admission_number);
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);

        if ($this->session->userdata('API-Key') == '' || $inst_id != $this->session->userdata('inst_id')) {
            $this->session->set_userdata('inst_id', $inst_id);
            $apiKEYS = $this->MPlogin->get_all_api_keys($inst_id);
            if (isset($apiKEYS['error_status']) && $apiKEYS['error_status'] == 0) {
                if ($apiKEYS['data_status'] == 1) {
                    $api_key_data = $apiKEYS['data'];
                } else {
                    $api_key_data = FALSE;
                }
            } else {
                $api_key_data = FALSE;
            }
            $api_key = $api_key_data['api_key'];
            $this->session->set_userdata('API-Key', $api_key); //
        }
        $details_data = $this->Mstudent->get_student_profile_by_admission_number($admission_number, $inst_id);
        if (isset($details_data['data']) && !empty($details_data['data'])) {
            $data['student_id'] = $details_data['data'][0]['student_id'];
            $data['template'] = 'student/online_payment_fees';
            $this->load->view('template/parent_template', $data);
        }
    }

    public function show_wallet_details($admission_number, $inst_id)
    {
        $this->clearCache();
        $this->session->set_userdata('admn_no_enc', $admission_number);
        $admission_number = base64_decode($admission_number);
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);

        if ($this->session->userdata('API-Key') == '' || $inst_id != $this->session->userdata('inst_id')) {
            $this->session->set_userdata('inst_id', $inst_id);
            $apiKEYS = $this->MPlogin->get_all_api_keys($inst_id);
            if (isset($apiKEYS['error_status']) && $apiKEYS['error_status'] == 0) {
                if ($apiKEYS['data_status'] == 1) {
                    $api_key_data = $apiKEYS['data'];
                } else {
                    $api_key_data = FALSE;
                }
            } else {
                $api_key_data = FALSE;
            }
            $api_key = $api_key_data['api_key'];
            $this->session->set_userdata('API-Key', $api_key); //
        }
        $details_data = $this->Mstudent->get_student_profile_by_admission_number($admission_number, $inst_id);
        if (isset($details_data['data']) && !empty($details_data['data'])) {
            $data['student_id'] = $details_data['data'][0]['student_id'];
            $data['template'] = 'student/online_payment_wallet';
            $this->load->view('template/parent_template', $data);
        }
    }

    public function show_ind_student()
    {
        // if (!isLoggedin()) {
        //     if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
        //         header("HTTP/1.1 401 UNauthorized");
        //         die();
        //     } else {
        //         redirect(base_url('portal/parent-login'));
        //     }
        // }
        //        dev_export($_SESSION);die;
        $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
        $inst_id = $this->session->userdata('inst_id');

        $details_data = $this->Mstudent->get_ind_student_details_for_home($student_id, $inst_id);

        $fee_details = NULL;
        $penalty_date = date('Y-m-d');
        if ($details_data['data_status'] == 1) {
            $cur_acd_year_id = $details_data['data'][0]['acd_year_id'];
            $fee_details = $this->Mstudent->get_fee_information($student_id, $inst_id, $cur_acd_year_id);
            if (!empty($fee_details['data'])) {
                // echo json_encode(array('status' => 2, 'message' => "No Fee details found."));
                // return true;
                //}

                // dev_export($fee_details['penalty_details']);
                // die;
                //PENALTY MANAGE
                if (isset($fee_details['penalty_details']) && !empty($fee_details['penalty_details'])) {
                    $data['penalty_details'] = $fee_details['penalty_details'];
                    // dev_export($fee_details['penalty_details']);
                    // die;
                    $penaltyarray = array();
                    foreach ($fee_details['penalty_details'] as $pdls) {
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
                }

                $totalpenalty = 0;
                $penalty_check_array = array();
                foreach ($fee_details['data'] as $demand) {
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
                                $penalty = (($penalty - $demand['PENALTY_PAID']) > 0 ? ($penalty - $demand['PENALTY_PAID']) : 0);
                                $penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']] = $demand['FEEID'];
                            }
                        } else {
                            $penalty = 0;
                        }
                    }
                    $penalty = ($demand['PENDING_PAYMENT'] > 0 ? $penalty : 0);
                    $totalpenalty += $penalty;
                }
                // dev_export($penaltyarray);
                // die;
                $data['total_penalty'] = $totalpenalty;


                //            $data['details_data'] = $details_data['data']['fees'];
                $data['details_data'] = isset($fee_details['data']) && !empty($fee_details['data']) ? $fee_details['data'] : NULL;
                $feedata_array = array();
                if (isset($fee_details['data']) && !empty($fee_details['data'])) {
                    foreach ($fee_details['data'] as $det_data) {
                        $dem_month = date('M-Y', strtotime($det_data['DEMAND_DATE']));
                        //if (in_array($dem_month, $feedata_array)) {
                        $feedata_array[$dem_month][] = $det_data;
                        //}
                    }
                }
            }
            // dev_export($feedata_array);
            // die;
            $data['sdetails_data'][0] = $details_data['data'][0];
            $data['details_data'] = isset($feedata_array) && !empty($feedata_array) ? $feedata_array : NULL;
            $data['payment_data'] = isset($fee_details['payment_history_data']) && !empty($fee_details['payment_history_data']) ? $fee_details['payment_history_data'] : NULL;
            //            $data['payment_data'] = NULL;
            $data['message'] = "";
            $total_payable_amount = isset($fee_details['summary_data']['PENDING_PAYMENT']) && !empty($fee_details['summary_data']['PENDING_PAYMENT']) ? ($fee_details['summary_data']['PENDING_PAYMENT'] + ($fee_details['summary_data']['PENDING_PAYMENT'] > 0 ? $totalpenalty : 0)) : 0;

            //dev_export($fee_details['summary_data']['PENDING_PAYMENT']);die;
            $data['sdetails_data'][0]['total_payable_fees'] = round($total_payable_amount, 2, PHP_ROUND_HALF_UP);
            $data['sdetails_data'][0]['total_payable_fees_value'] = round($total_payable_amount, 2, PHP_ROUND_HALF_UP);
            //            dev_export($data);die;
            $data['inst_id'] = $inst_id;
            $data['cur_acd_year_id'] = $cur_acd_year_id;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('student/student_list', $data, TRUE)));
            return true;
        } else {
            $data['details_data'] = FALSE;
            $data['message'] = $details_data['message'];
            if (isset($data['message']) && !empty($data['message'])) {
                echo json_encode(array('status' => 2, 'message' => $data['message']));
                return true;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'An error occured while fetching data. Please try again later'));
                return true;
            }
        }
    }
    public function show_student_wallet()
    {
        $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
        $inst_id = $this->session->userdata('inst_id');

        $details_data = $this->Mstudent->get_ind_student_details_for_home($student_id, $inst_id);

        $fee_details = NULL;
        $penalty_date = date('Y-m-d');
        if ($details_data['data_status'] == 1) {
            $cur_acd_year_id = $details_data['data'][0]['acd_year_id'];
            $allocation_data_for_student = $this->Mstudent->get_wallet_data_by_student($student_id, $inst_id, $cur_acd_year_id);
            if (isset($allocation_data_for_student['summary_data']) && !empty($allocation_data_for_student['summary_data'])) {
                $data['fee_summary'] = $allocation_data_for_student['summary_data']['PENDING_PAYMENT'];
                $data['e_wallet'] = $allocation_data_for_student['summary_data']['E_WALLET'];
                $data['min_wallet'] = $allocation_data_for_student['summary_data']['MIN_WALLET_AMOUNT_TO_PAY'];
                $data['FIST_TERM_FEE'] = $allocation_data_for_student['summary_data']['FIST_TERM_FEE'];
                $data['PAID_OR_NOT'] = $allocation_data_for_student['summary_data']['PAID_OR_NOT'];
            } else {
                $data['fee_summary'] = 0;
                $data['e_wallet'] = 0;
                $data['min_wallet'] = 1;
                $data['FIST_TERM_FEE'] = 0;
                $data['PAID_OR_NOT'] = 0;
            }
            $data['sdetails_data'][0] = $details_data['data'][0];
            $data['inst_id'] = $inst_id;
            $data['cur_acd_year_id'] = $cur_acd_year_id;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('student/wallet_page', $data, TRUE)));
            return true;
        } else {
            $data['details_data'] = FALSE;
            $data['message'] = $details_data['message'];
            if (isset($data['message']) && !empty($data['message'])) {
                echo json_encode(array('status' => 2, 'message' => $data['message']));
                return true;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'An error occured while fetching data. Please try again later'));
                return true;
            }
        }
    }

    function send_atom_data()
    { // function to send atom values
        $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
        $max_amount = filter_input(INPUT_POST, 'max_amount', FILTER_SANITIZE_NUMBER_FLOAT);
        $amount = filter_input(INPUT_POST, 'paid_amt', FILTER_SANITIZE_NUMBER_FLOAT);
        $cur_acd_year_id    = filter_input(INPUT_POST, 'cur_acd_year_id');
        $inst_id = $this->session->userdata('inst_id');
        $min_amount = $this->session->userdata('min_pay_amt');
        if (!($amount >= $min_amount)) {
            //            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Fee amount should be greater than minimum pay amount (' . money_format('%i', $min_amount, 1) . ')'));
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Fee amount should be greater than minimum pay amount (' . $min_amount . ')'));
            return;
        }
        if (!($amount <= $max_amount)) {
            //            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Fee amount should be less than maximum payable amount (' . money_format('%i', $max_amount, 1) . ')'));
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Fee amount should be less than maximum payable amount (' . $max_amount . ')'));
            return;
        }
        $fee_data = 'NA';
        if (!(isset($student_id) && !empty($student_id))) {
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Student data is not available. Please try again later or contact administrator'));
            return;
        }

        $student_personal_details = $this->Mstudent->get_ind_student_details($student_id);

        $student_data = array();
        if (isset($student_personal_details['data'][0]) && !empty($student_personal_details['data'][0])) {
            $student_data = $student_personal_details['data'][0];
        } else {
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Student data is not available. Please try again later or contact administrator'));
        }

        $address = isset($student_data['Address1']) ? $student_data['Address1'] : 'NA';
        //        dev_export(isset($student_data['F_C_address2']) ? $student_data['F_C_address2'] : '');die;
        $address = $address . (isset($student_data['Address2']) ? $student_data['Address2'] : '');
        $address = $address . (isset($student_data['Address3']) ? $student_data['Address3'] : '');
        $phone =  $student_data['PHONE_NO_FATHER'];
        $email = $student_data['FATHER_EMAIL'];
        $name = $student_data['Student_Name'];
        $admission_no = $student_data['Reg_No'] . "__" . $inst_id; //Admission no combined with inst_id


        if ($email == '' || $phone == '') {
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Email Id & Mobile No is mandatory for online payment.Please contact school authorities for updating the email/Mobile in school records.'));
            return;
        }


        $ru = base_url('fees/data-return-from-payment-gateway');
        //        $ru = 'https://paynetzuat.atomtech.in/paynetzclient/ResponseParam.jsp';
        if (ENVIRONMENT == 'development') {
            $product = "NSE";
        } else {
            switch ($inst_id) {
                case 5:
                    $product = 'OXFORD';
                    break;
                case 8:
                    $product = 'OXFORD_SCHOOL_KOLLAM';
                    break;
                case 20:
                    $product = 'OXFORD_SCHOOL_CALICUT';
                    break;
            }
        }
        date_default_timezone_set('Asia/Calcutta');
        $datenow = date("d/m/Y h:m:s");
        $transactionDate = str_replace(" ", "%20", $datenow);
        $transactionId = rand(1, 100000070);
        //        dev_export($client_code);die;
        if ($email != '' || $phone != '') {
            $this->load->library('TransactionRequest');
            $transactionRequest = new TransactionRequest();
            if (ENVIRONMENT == 'development') {
                $transactionRequest->setMode("test");
                $transactionRequest->setLogin(197);
                $transactionRequest->setPassword("Test@123");
                $transactionRequest->setReqHashKey("KEY123657234");
                $transactionRequest->setRespHashKey("KEYRESP123657234");
                $transactionRequest->setClientCode('123');
                $transactionRequest->setCustomerAccount('639827');
            } else {
                $transactionRequest->setMode("live");
                $transactionRequest->setLogin(PG_LOGIN);
                $transactionRequest->setPassword(PG_PASSWORD);
                $transactionRequest->setReqHashKey(REQHASHCODE);
                $transactionRequest->setRespHashKey(RESPHASHCODE);
                $transactionRequest->setClientCode(CLIENT_CODE);
                $transactionRequest->setCustomerAccount(ACCOUNT_NUMBER);
            }
            $transactionRequest->setProductId($product);
            $transactionRequest->setAmount($amount);
            $transactionRequest->setTransactionCurrency("INR");
            $transactionRequest->setTransactionAmount($amount);
            $transactionRequest->setReturnUrl($ru);
            $transactionRequest->setTransactionId($transactionId);
            $transactionRequest->setTransactionDate($transactionDate);
            $transactionRequest->setCustomerName($name);
            $transactionRequest->setCustomerEmailId($email);
            $transactionRequest->setCustomerMobile($phone);
            $transactionRequest->setCustomerBillingAddress($address);
            $transactionRequest->setCustomerStudentId($student_id);
            $transactionRequest->setCustomerAdmissionNumber($admission_no);
            $transactionRequest->setStudentFeeData($fee_data);
            $url = $transactionRequest->getPGUrl();

            if ($url) {
                echo json_encode(array('status' => 1, 'link' => $url));
            } else {
                echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Payment link is down. Please contact administrator or try again later'));
            }
            exit();
        } else {
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Email Id & Mobile No is mandatory for online payment.Please contact school authorities for updating the email/Mobile in school records.'));
        }
    }

    //Deposit to wallet
    function pay_wallet_atom()
    { // function to send atom values
        $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
        $amount = filter_input(INPUT_POST, 'paid_amt', FILTER_SANITIZE_NUMBER_FLOAT);
        $matdiw = filter_input(INPUT_POST, 'matdiw');
        $cur_acd_year_id    = filter_input(INPUT_POST, 'cur_acd_year_id');
        $inst_id = $this->session->userdata('inst_id');
        $min_amount = $this->session->userdata('min_pay_amt');

        if (($amount < $matdiw)) {
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Minimum Amount you should pay :' . round($matdiw, 2)));
            return;
        }
        if (!($amount >= $min_amount)) {
            //            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Fee amount should be greater than minimum pay amount (' . money_format('%i', $min_amount, 1) . ')'));
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Fee amount should be greater than minimum pay amount (' . $min_amount . ')'));
            return;
        }
        $fee_data = 'NA';
        if (!(isset($student_id) && !empty($student_id))) {
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Student data is not available. Please try again later or contact administrator'));
            return;
        }

        $student_personal_details = $this->Mstudent->get_ind_student_details($student_id);
        //        dev_export($student_personal_details);die;
        $student_data = array();
        if (isset($student_personal_details['data'][0]) && !empty($student_personal_details['data'][0])) {
            $student_data = $student_personal_details['data'][0];
        } else {
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Student data is not available. Please try again later or contact administrator'));
        }
        $address = isset($student_data['Address1']) ? $student_data['Address1'] : 'NA';
        $address = $address . (isset($student_data['Address2']) ? $student_data['Address2'] : '');
        $address = $address . (isset($student_data['Address3']) ? $student_data['Address3'] : '');
        $phone =  $student_data['PHONE_NO_FATHER'];
        $email = $student_data['FATHER_EMAIL'];
        $name = $student_data['Student_Name'];
        $admission_no = $student_data['Reg_No'] . "__" . $inst_id;
        if ($email == '' || $phone == '') {
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Email Id is mandatory for online payment.Please contact school authorities for updating the email in school records.'));
            return;
        }

        $ru = base_url('fees/data-return-from-payment-gateway-wallet');
        if (ENVIRONMENT == 'development') {
            $product = "NSE";
        } else {
            switch ($inst_id) {
                case 5:
                    $product = 'OXFORD';
                    break;
                case 8:
                    $product = 'OXFORD_SCHOOL_KOLLAM';
                    break;
                case 20:
                    $product = 'OXFORD_SCHOOL_CALICUT';
                    break;
            }
        }
        date_default_timezone_set('Asia/Calcutta');
        $datenow = date("d/m/Y h:m:s");
        $transactionDate = str_replace(" ", "%20", $datenow);
        $transactionId = rand(1, 100000070);
        //        dev_export($client_code);die;
        $this->load->library('TransactionRequest');
        $transactionRequest = new TransactionRequest();
        if (ENVIRONMENT == 'development') {
            $transactionRequest->setMode("test");
            $transactionRequest->setLogin(197);
            $transactionRequest->setPassword("Test@123");
            $transactionRequest->setReqHashKey("KEY123657234");
            $transactionRequest->setRespHashKey("KEYRESP123657234");
            $transactionRequest->setClientCode('123');
            $transactionRequest->setCustomerAccount('639827');
        } else {
            $transactionRequest->setMode("live");
            $transactionRequest->setLogin(PG_LOGIN);
            $transactionRequest->setPassword(PG_PASSWORD);
            $transactionRequest->setReqHashKey(REQHASHCODE);
            $transactionRequest->setRespHashKey(RESPHASHCODE);
            $transactionRequest->setClientCode(CLIENT_CODE);
            $transactionRequest->setCustomerAccount(ACCOUNT_NUMBER);
        }
        $transactionRequest->setProductId($product);
        $transactionRequest->setAmount($amount);
        $transactionRequest->setTransactionCurrency("INR");
        $transactionRequest->setTransactionAmount($amount);
        $transactionRequest->setReturnUrl($ru);
        $transactionRequest->setTransactionId($transactionId);
        $transactionRequest->setTransactionDate($transactionDate);
        $transactionRequest->setCustomerName($name);
        $transactionRequest->setCustomerEmailId($email);
        $transactionRequest->setCustomerMobile($phone);
        $transactionRequest->setCustomerBillingAddress($address);
        $transactionRequest->setCustomerStudentId($student_id);
        $transactionRequest->setCustomerAdmissionNumber($admission_no);
        $transactionRequest->setStudentFeeData($fee_data);
        $url = $transactionRequest->getPGUrl();


        if ($url) {
            echo json_encode(array('status' => 1, 'link' => $url));
        } else {
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Payment link is down. Please contact administrator or try again later'));
        }
        exit();
    }


    public function atom_data_rcvd()
    {
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        $this->load->library('TransactionResponse');
        $transactionResponse = new TransactionResponse();
        //Resetting Session Starts
        $failed = 0;
        if (!empty($_POST)) {
            $admission_no_inst_id = $_POST['udf6'];
            $exp_array = explode('__', $admission_no_inst_id);
            if (is_array($exp_array)) {
                $inst_id =  $exp_array[1];
                //$this->session->set_userdata('API-Key', $api_key); //
                $this->session->set_userdata('inst_id', $inst_id);
                $apiKEYS = $this->MPlogin->get_all_api_keys($inst_id);
                if (isset($apiKEYS['error_status']) && $apiKEYS['error_status'] == 0) {
                    if ($apiKEYS['data_status'] == 1) {
                        $api_key_data = $apiKEYS['data'];
                    } else {
                        $api_key_data = FALSE;
                    }
                } else {
                    $api_key_data = FALSE;
                }
                $api_key = $api_key_data['api_key'];

                $this->session->set_userdata('API-Key', $api_key); //
                //All apikeys
            } else {
                $failed = 1;
            }
        } else {
            $failed = 1;
        }
        if ($failed == 1) {
            $email_message = "Payment failed in Fees due to insufficent data received from payment gateway";
            $subject = "Payment Failed for Fees -Insufficent Data from Payment Gateway";

            //$mailto_sp = $this->get_support_email($inst_id);
            $cc = '';
            $mailto_sp = SUPPORT_DEV_TEAM_EMAIL;
            $mailcontent = $email_message;
            $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc);
            redirect(base_url() . 'payment-expired');
        }
        //Resetting Session Ends

        if (ENVIRONMENT == 'development') {
            $transactionResponse->setRespHashKey("KEYRESP123657234");
        } else {
            $transactionResponse->setRespHashKey(RESPHASHCODE);
        }
        $acd_year_id    = $this->session->userdata('acd_year');
        if ($transactionResponse->validateResponse($_POST)) {
            $student_id = $_POST['udf9'];
            $student_personal_details = $this->Mstudent->get_ind_student_details($student_id);
            $acd_year_id = $student_personal_details['data'][0]['acd_Year'];
            // dev_export($student_personal_details['data'][0]['acd_Year']);
            // die;
            //            dev_export($student_personal_details);die;
            if ($_POST['f_code'] == 'C') {
                $customer_name = isset($student_personal_details['data'][0]['Student_Name']) ? $student_personal_details['data'][0]['Student_Name'] : 'NA';
                $customer_email = isset($student_personal_details['data'][0]['FATHER_EMAIL']) ? $student_personal_details['data'][0]['FATHER_EMAIL'] : 'NA';
                $customer_email2 = isset($student_personal_details['data'][0]['MOTHER_EMAIL']) ? $student_personal_details['data'][0]['MOTHER_EMAIL'] : 'NA';
                $customer_mobnum = isset($student_personal_details['data'][0]['PHONE_NO_FATHER']) ? $student_personal_details['data'][0]['PHONE_NO_FATHER'] : 'NA';
                $customer_mobnum2 = isset($student_personal_details['data'][0]['PHONE_NO_MOTHER']) ? $student_personal_details['data'][0]['PHONE_NO_MOTHER'] : 'NA';
                $transaction_date = date('Y-m-d H:i:s', strtotime($_POST['date']));
                $fee_id = 'NA';
                $admission_no = isset($student_personal_details['data'][0]['Reg_No']) ? $student_personal_details['data'][0]['Reg_No'] : 'NA';
                $merchantdata = $_POST['desc'];
                $Transaction_status = $_POST['f_code'];
                $Transaction_amount = $_POST['amt'];
                $Transaction_surcharge = 0;
                $atom_transaction_id = $_POST['mmp_txn'];
                $merchant_transaction_id = $_POST['mer_txn'];
                $merchantid = $_POST['merchant_id'];
                $bank_name = $_POST['bank_name'];
                $bank_transactionid = $_POST['bank_txn'];
                $payment_channel = $_POST['discriminator'];
                $cardnumber = $_POST['CardNumber'];
                $product = $_POST['prod'];
                $clientcode = $_POST['clientcode'];
                $signature = $_POST['signature'];
                $surcharge = $_POST['surcharge'];
            } else {
                $customer_name = $_POST['udf1'];
                $customer_email = $_POST['udf2'];
                $customer_mobnum = $_POST['udf3'];
                $transaction_date = date('Y-m-d H:i:s', strtotime($_POST['date']));
                $fee_id = $_POST['udf4'];
                $student_id = $_POST['udf9'];
                $admission_no = isset($student_personal_details['data'][0]['Reg_No']) ? $student_personal_details['data'][0]['Reg_No'] : 'NA';
                //$admission_no = $_POST['udf6'];
                $merchantdata = $_POST['udf5'];
                $Transaction_status = $_POST['f_code'];
                $Transaction_amount = $_POST['amt'];
                $Transaction_surcharge = $_POST['surcharge'];
                $atom_transaction_id = $_POST['mmp_txn'];
                $merchant_transaction_id = $_POST['mer_txn'];
                $merchantid = $_POST['merchant_id'];
                $bank_name = $_POST['bank_name'];
                $bank_transactionid = $_POST['bank_txn'];
                $payment_channel = $_POST['discriminator'];
                $cardnumber = $_POST['CardNumber'];
                $product = $_POST['prod'];
                $clientcode = $_POST['clientcode'];
                $signature = $_POST['signature'];
                $surcharge = $_POST['surcharge'];
            }
            $inst_id = $this->session->userdata('inst_id');
            $atom_return_details = (array(
                'inst_id' => $inst_id,
                'admissionNumber' => $admission_no,
                'studentId' => $student_id,
                'cardnumber' => $cardnumber,
                'product' => $product,
                'clientCode' => $clientcode,
                'atom_transaction_id' => $atom_transaction_id,
                'transaction_date' => $transaction_date,
                'atomSignature' => $signature,
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'customer_mob' => $customer_mobnum,
                'billing_address' => '',
                'merchantdata' => $merchantdata,
                'merchant_id' => $merchantid,
                'feeId' => $fee_id,
                'Transaction_amount' => $Transaction_amount,
                'Transaction_surcharge' => $Transaction_surcharge,
                'merchant_transaction_id' => $merchant_transaction_id,
                'Transaction_status' => $Transaction_status,
                'payment_channel' => $payment_channel,
                'bankTransactionId' => $bank_transactionid,
                'bank_name' => $bank_name,
                'acd_year_id' => $acd_year_id,
                'student_name' => ''
            ));
            //            dev_export($atom_return_details);DIE;
            $father_name = (isset($student_personal_details['data'][0]['FATHER_NAME']) && !empty($student_personal_details['data'][0]['FATHER_NAME'])) ? $student_personal_details['data'][0]['FATHER_NAME'] : 'Parent';
            header('Cache-Control: no-cache');
            header('Pragma: no-cache');

            //Atom data formatting

            $formatted_atom_data = array(
                'inst_id' => $inst_id,
                'admissionNumber' => $admission_no,
                'studentId' => $student_id,
                'cardNumber' => $cardnumber,
                'product' => $product,
                'clientCode' => $clientcode,
                'atomTransactionId' => $atom_transaction_id,
                'transaction_date' => $transaction_date,
                'atomSignature' => $signature,
                'customerName' => $customer_name,
                'customerEmailId' => $customer_email,
                'customerMobNum' => $customer_mobnum,
                'billingAddress' => 'NA',
                'merchantData' => $merchantdata,
                'merchantId' => $merchantid,
                'feeId' => $fee_id,
                'feeAmount' => $Transaction_amount,
                'sur_charge' => $surcharge,
                'merchantTransactionId' => $merchant_transaction_id,
                'paymentStatus' => $Transaction_status,
                'paymentChannel' => $payment_channel,
                'bankTransactionId' => $bank_transactionid,
                'bankName' => $bank_name
            );

            $atom_data_posting = array(
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'student_id' => $student_id,
                'Transaction_status' => $Transaction_status,
                'Transaction_amount' => $Transaction_amount,
                'customer_name' => $customer_name,
                'atom_transaction_id' => $atom_transaction_id
            );

            // dev_export(json_encode($atom_data_posting));
            // die;

            $status = $this->Mstudent->save_payment_details($atom_data_posting, json_encode($formatted_atom_data));
            if (is_array($status) && $status['status'] == 1) {

                $mailto = $customer_email;

                $institution_name = $this->get_institution_name($inst_id);
                $data['transaction_details_data'] = $atom_return_details;
                $data['institution_name'] = $institution_name;
                $data['student_data'] = (isset($student_personal_details['data'][0]) && !empty($student_personal_details['data'][0])) ? $student_personal_details['data'][0] : NULL;
                $mesg = $this->load->view('parent_login/payment_status_notification_atom_view', $data, true);
                if ($Transaction_status == 'Ok') {
                    $subject = 'Fee Payment Successful : ' . $data['transaction_details_data']['customer_name'] . '-' . $data['transaction_details_data']['admissionNumber'];
                    $email_res = send_smtp_mailer($subject, $mailto, $mesg, $cc = '');

                    $institution_name = $this->get_institution_name($inst_id);

                    $email_message = "Payment received in fees ,Details are as follows<br/><br/>";
                    $email_message .= "Payment Amount : " . $Transaction_amount . " <br/>";
                    $email_message .= "Institution Name : " . $institution_name . " <br/>";
                    $email_message .= "Student Admission No : " . $data['transaction_details_data']['admissionNumber'] . " <br/>";
                    $email_message .= "Student Name : " . $data['transaction_details_data']['customer_name'] . " <br/>";

                    $subject = "Payment received towards fees : " . $data['transaction_details_data']['customer_name'] . '-' . $data['transaction_details_data']['admissionNumber'];
                    $mailto_sp = $this->get_support_email($inst_id);
                    $mailcontent = $email_message;
                    $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc = '');
                    redirect(base_url() . 'fee/payment-success');
                } else {
                    $subject = 'Fee Payment Failed';
                    $email_res = send_smtp_mailer($subject, $mailto, $mesg, $cc = '');

                    $institution_name = $this->get_institution_name($inst_id);

                    $email_message = "Payment failed in fees ,Details are as follows<br/><br/>";
                    $email_message .= "Payment Amount : " . $Transaction_amount . " <br/>";
                    $email_message .= "Institution Name : " . $institution_name . " <br/>";
                    $email_message .= "Student Admission No : " . $data['transaction_details_data']['admissionNumber'] . " <br/>";
                    $email_message .= "Student Name : " . $data['transaction_details_data']['customer_name'] . " <br/>";

                    $subject = "Payment failed towards fees : " . $data['transaction_details_data']['customer_name'] . '-' . $data['transaction_details_data']['admissionNumber'];
                    $mailto_sp = $this->get_support_email($inst_id);
                    $mailcontent = $email_message;
                    $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc = '');
                    redirect(base_url() . 'fee/payment-failed');
                }
                return;
            } else {
                $institution_name = $this->get_institution_name($inst_id);

                $email_message = "Payment processing failed in fees ,Details are as follows<br/><br/>";
                $email_message .= "Institution Name : " . $institution_name . " <br/>";
                $email_message .= "JSON DATA : " . json_encode($_POST) . " <br/>";

                $subject = "Payment processing failed in fees";
                $mailto_sp = SUPPORT_DEV_TEAM_EMAIL;
                $mailcontent = $email_message;
                $cc = '';
                $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc);
                redirect(base_url() . 'fee/payment-failed');
                return;
            }
        } else {
            redirect(base_url() . 'fee/payment-failed');
        }
    }

    public function atom_data_rcvd_wallet()
    {
        header("Cache-Control: private, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        $this->load->library('TransactionResponse');
        $transactionResponse = new TransactionResponse();
        //Resetting Session Starts
        $failed = 0;
        if (!empty($_POST)) {
            $admission_no_inst_id = $_POST['udf6'];
            $exp_array = explode('__', $admission_no_inst_id);
            if (is_array($exp_array)) {
                $inst_id =  $exp_array[1];
                //$this->session->set_userdata('API-Key', $api_key); //
                $this->session->set_userdata('inst_id', $inst_id);
                $apiKEYS = $this->MPlogin->get_all_api_keys($inst_id);
                if (isset($apiKEYS['error_status']) && $apiKEYS['error_status'] == 0) {
                    if ($apiKEYS['data_status'] == 1) {
                        $api_key_data = $apiKEYS['data'];
                    } else {
                        $api_key_data = FALSE;
                    }
                } else {
                    $api_key_data = FALSE;
                }
                $api_key = $api_key_data['api_key'];

                $this->session->set_userdata('API-Key', $api_key); //
                //All apikeys
            } else {
                $failed = 1;
            }
        } else {
            $failed = 1;
        }
        if ($failed == 1) {
            $email_message = "Payment failed in Fees due to insufficent data received from payment gateway";
            $subject = "Payment Failed for Fees -Insufficent Data from Payment Gateway";

            //$mailto_sp = $this->get_support_email($inst_id);
            $cc = '';
            $mailto_sp = SUPPORT_DEV_TEAM_EMAIL;
            $mailcontent = $email_message;
            $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc);
            redirect(base_url() . 'payment-expired');
        }
        //Resetting Session Ends
        if (ENVIRONMENT == 'development') {
            $transactionResponse->setRespHashKey("KEYRESP123657234");
        } else {
            $transactionResponse->setRespHashKey(RESPHASHCODE);
        }
        $acd_year_id    = $this->session->userdata('acd_year');
        if ($transactionResponse->validateResponse($_POST)) {
            $student_id = $_POST['udf9'];
            $student_personal_details = $this->Mstudent->get_ind_student_details($student_id);
            $acd_year_id = $student_personal_details['data'][0]['acd_Year'];
            // dev_export($student_personal_details['data'][0]['acd_Year']);
            // die;
            //            dev_export($student_personal_details);die;
            if ($_POST['f_code'] == 'C') {
                $customer_name = isset($student_personal_details['data'][0]['Student_Name']) ? $student_personal_details['data'][0]['Student_Name'] : 'NA';
                $customer_email = isset($student_personal_details['data'][0]['FATHER_EMAIL']) ? $student_personal_details['data'][0]['FATHER_EMAIL'] : 'NA';
                $customer_email2 = isset($student_personal_details['data'][0]['MOTHER_EMAIL']) ? $student_personal_details['data'][0]['MOTHER_EMAIL'] : 'NA';
                $customer_mobnum = isset($student_personal_details['data'][0]['PHONE_NO_FATHER']) ? $student_personal_details['data'][0]['PHONE_NO_FATHER'] : 'NA';
                $customer_mobnum2 = isset($student_personal_details['data'][0]['PHONE_NO_MOTHER']) ? $student_personal_details['data'][0]['PHONE_NO_MOTHER'] : 'NA';
                $transaction_date = date('Y-m-d H:i:s', strtotime($_POST['date']));
                $fee_id = 'NA';
                $admission_no = isset($student_personal_details['data'][0]['Reg_No']) ? $student_personal_details['data']['Reg_No'] : 'NA';
                $merchantdata = $_POST['desc'];
                $Transaction_status = $_POST['f_code'];
                $Transaction_amount = $_POST['amt'];
                $Transaction_surcharge = 0;
                $atom_transaction_id = $_POST['mmp_txn'];
                $merchant_transaction_id = $_POST['mer_txn'];
                $merchantid = $_POST['merchant_id'];
                $bank_name = $_POST['bank_name'];
                $bank_transactionid = $_POST['bank_txn'];
                $payment_channel = $_POST['discriminator'];
                $cardnumber = $_POST['CardNumber'];
                $product = $_POST['prod'];
                $clientcode = $_POST['clientcode'];
                $signature = $_POST['signature'];
                $surcharge = $_POST['surcharge'];
            } else {
                $customer_name = $_POST['udf1'];
                $customer_email = $_POST['udf2'];
                $customer_mobnum = $_POST['udf3'];
                $transaction_date = date('Y-m-d H:i:s', strtotime($_POST['date']));
                $fee_id = $_POST['udf4'];
                $student_id = $_POST['udf9'];
                $admission_no = isset($student_personal_details['data'][0]['Reg_No']) ? $student_personal_details['data'][0]['Reg_No'] : 'NA';
                //$admission_no = $_POST['udf6'];
                $merchantdata = $_POST['udf5'];
                $Transaction_status = $_POST['f_code'];
                $Transaction_amount = $_POST['amt'];
                $Transaction_surcharge = $_POST['surcharge'];
                $atom_transaction_id = $_POST['mmp_txn'];
                $merchant_transaction_id = $_POST['mer_txn'];
                $merchantid = $_POST['merchant_id'];
                $bank_name = $_POST['bank_name'];
                $bank_transactionid = $_POST['bank_txn'];
                $payment_channel = $_POST['discriminator'];
                $cardnumber = $_POST['CardNumber'];
                $product = $_POST['prod'];
                $clientcode = $_POST['clientcode'];
                $signature = $_POST['signature'];
                $surcharge = $_POST['surcharge'];
            }
            $inst_id = $this->session->userdata('inst_id');
            $atom_return_details = (array(
                'inst_id' => $inst_id,
                'admissionNumber' => $admission_no,
                'studentId' => $student_id,
                'cardnumber' => $cardnumber,
                'product' => $product,
                'clientCode' => $clientcode,
                'atom_transaction_id' => $atom_transaction_id,
                'transaction_date' => $transaction_date,
                'atomSignature' => $signature,
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'customer_mob' => $customer_mobnum,
                'billing_address' => '',
                'merchantdata' => $merchantdata,
                'merchant_id' => $merchantid,
                'feeId' => $fee_id,
                'Transaction_amount' => $Transaction_amount,
                'Transaction_surcharge' => $Transaction_surcharge,
                'merchant_transaction_id' => $merchant_transaction_id,
                'Transaction_status' => $Transaction_status,
                'payment_channel' => $payment_channel,
                'bankTransactionId' => $bank_transactionid,
                'bank_name' => $bank_name,
                'acd_year_id' => $acd_year_id,
                'student_name' => ''
            ));
            //            dev_export($atom_return_details);DIE;
            $father_name = (isset($student_personal_details['data'][0]['FATHER_NAME']) && !empty($student_personal_details['data'][0]['FATHER_NAME'])) ? $student_personal_details['data'][0]['FATHER_NAME'] : 'Parent';
            header('Cache-Control: no-cache');
            header('Pragma: no-cache');

            //Atom data formatting

            $formatted_atom_data = array(
                'inst_id' => $inst_id,
                'admissionNumber' => $admission_no,
                'studentId' => $student_id,
                'cardNumber' => $cardnumber,
                'product' => $product,
                'clientCode' => $clientcode,
                'atomTransactionId' => $atom_transaction_id,
                'transaction_date' => $transaction_date,
                'atomSignature' => $signature,
                'customerName' => $customer_name,
                'customerEmailId' => $customer_email,
                'customerMobNum' => $customer_mobnum,
                'billingAddress' => 'NA',
                'merchantData' => $merchantdata,
                'merchantId' => $merchantid,
                'feeId' => $fee_id,
                'feeAmount' => $Transaction_amount,
                'sur_charge' => $surcharge,
                'merchantTransactionId' => $merchant_transaction_id,
                'paymentStatus' => $Transaction_status,
                'paymentChannel' => $payment_channel,
                'bankTransactionId' => $bank_transactionid,
                'bankName' => $bank_name
            );

            $atom_data_posting = array(
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'student_id' => $student_id,
                'Transaction_status' => $Transaction_status,
                'Transaction_amount' => $Transaction_amount,
                'customer_name' => $customer_name,
                'atom_transaction_id' => $atom_transaction_id
            );

            $status = $this->Mstudent->deposit_wallet_amount($atom_data_posting, json_encode($formatted_atom_data));
            if (is_array($status) && $status['status'] == 1) {
                $mailto = $customer_email;
                $data['transaction_details_data'] = $atom_return_details;
                $data['student_data'] = (isset($student_personal_details['data'][0]) && !empty($student_personal_details['data'][0])) ? $student_personal_details['data'][0] : NULL;
                $mesg = $this->load->view('parent_login/payment_status_notification_atom_view_wallet', $data, true);

                if ($Transaction_status == 'Ok') {
                    $subject = 'Wallet Deposit Successful : ' . $data['transaction_details_data']['customer_name'] . '-' . $data['transaction_details_data']['admissionNumber'];
                    $email_res = send_smtp_mailer($subject, $mailto, $mesg, $cc = '');

                    $institution_name = $this->get_institution_name($inst_id);

                    $email_message = "Payment received in Docme Wallet ,Details are as follows<br/><br/>";
                    $email_message .= "Payment Amount : " . $Transaction_amount . " <br/>";
                    $email_message .= "Institution Name : " . $institution_name . " <br/>";
                    $email_message .= "Student Admission No : " . $data['transaction_details_data']['admissionNumber'] . " <br/>";
                    $email_message .= "Student Name : " . $data['transaction_details_data']['customer_name'] . " <br/>";

                    $subject = "Payment received towards Docme Wallet : " . $data['transaction_details_data']['customer_name'] . '-' . $data['transaction_details_data']['admissionNumber'];
                    $mailto_sp = $this->get_support_email($inst_id);
                    $mailcontent = $email_message;
                    $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc = '');
                    redirect(base_url() . 'fee/wallet-payment-success');
                } else {
                    $subject = 'Wallet Deposit Failed';
                    $email_res = send_smtp_mailer($subject, $mailto, $mesg, $cc = '');

                    $institution_name = $this->get_institution_name($inst_id);

                    $email_message = "Wallet Deposit Failed in fees ,Details are as follows<br/><br/>";
                    $email_message .= "Payment Amount : " . $Transaction_amount . " <br/>";
                    $email_message .= "Institution Name : " . $institution_name . " <br/>";
                    $email_message .= "Student Admission No : " . $data['transaction_details_data']['admissionNumber'] . " <br/>";
                    $email_message .= "Student Name : " . $data['transaction_details_data']['customer_name'] . " <br/>";

                    $subject = "Payment failed towards Wallet Deposit  : " . $data['transaction_details_data']['customer_name'] . '-' . $data['transaction_details_data']['admissionNumber'];
                    $mailto_sp = $this->get_support_email($inst_id);
                    $mailcontent = $email_message;
                    $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc = '');
                    redirect(base_url() . 'fee/wallet-payment-failed');
                }
                return;
            } else {
                $institution_name = $this->get_institution_name($inst_id);

                $email_message = "Payment processing failed in Wallet Deposit ,Details are as follows<br/><br/>";
                $email_message .= "Institution Name : " . $institution_name . " <br/><br/>";
                $email_message .= "JSON DATA : " . json_encode($_POST) . " <br/>";

                $subject = "Payment processing failed Wallet Deposit";

                $mailto_sp = SUPPORT_DEV_TEAM_EMAIL;
                $mailcontent = $email_message;
                $cc = '';
                $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc);
                redirect(base_url() . 'fee/wallet-payment-failed');
                return;
            }
        } else {
            redirect(base_url() . 'fee/wallet-payment-failed');
        }
    }

    public function payment_ack_success()
    {
        $this->clearCache();
        $data['title'] = 'Success';
        $data['type'] = 'success';
        $data['msg'] = "Payment processed succesfully. Your payment will get reflected soon.Thank you";
        $data['redirect_link'] = base_url() . 'payment-fees/' . $this->session->userdata('admn_no_enc') . '/' . $this->session->userdata('inst_id');
        $data['template'] = 'student/payment_response_view';
        $this->load->view('template/parent_template', $data);
    }
    public function payment_ack_failed()
    {
        $this->clearCache();
        $data['title'] = 'Failed';
        $data['type'] = 'error';
        $data['msg'] = "Payment failed.Please try again later.Please contact school if amount is debited from account.";
        $data['redirect_link'] = base_url() . 'payment-fees/' . $this->session->userdata('admn_no_enc') . '/' . $this->session->userdata('inst_id');
        $data['template'] = 'student/payment_response_view';
        $this->load->view('template/parent_template', $data);
    }
    public function payment_ack_success_wallet()
    {
        $this->clearCache();
        $data['title'] = 'Success';
        $data['type'] = 'success';
        $data['msg'] = "Payment processed succesfully. Your payment will get reflected soon.Thank you";
        $data['redirect_link'] = base_url() . 'payment-wallet/' . $this->session->userdata('admn_no_enc') . '/' . $this->session->userdata('inst_id');
        $data['template'] = 'student/payment_response_view';
        $this->load->view('template/parent_template', $data);
    }
    public function payment_ack_failed_wallet()
    {
        $this->clearCache();
        $data['title'] = 'Failed';
        $data['type'] = 'error';
        $data['msg'] = "Payment failed.Please try again later.Please contact school if amount is debited from account.";
        $data['redirect_link'] = base_url() . 'payment-wallet/' . $this->session->userdata('admn_no_enc') . '/' . $this->session->userdata('inst_id');
        $data['template'] = 'student/payment_response_view';
        $this->load->view('template/parent_template', $data);
    }

    function get_support_email($inst_id)
    {
        switch ($inst_id) {
            case 5:
                $cc_email = ACCOUNTS_EMAIL_OXFTVM;
                break;
            case 8:
                $cc_email = ACCOUNTS_EMAIL_OXFKLM;
                break;
            case 20:
                $cc_email = ACCOUNTS_EMAIL_OXFCLT;
                break;
            default:
                $cc_email = SUPPORT_DEV_TEAM_EMAIL;
                break;
        }

        //return SUPPORT_DEV_TEAM_EMAIL;
        return $cc_email . ',' . SUPPORT_DEV_TEAM_EMAIL;
    }

    function get_institution_name($inst_id)
    {
        switch ($inst_id) {
            case 5:
                $inst_name = INST_NAME_TVM;
                break;
            case 8:
                $inst_name = INST_NAME_KLM;
                break;
            case 20:
                $inst_name = INST_NAME_CLT;
                break;
            default:
                $inst_name = APP_TITLE;
                break;
        }
        return $inst_name;
    }

    protected function clearCache()
    {
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
}
