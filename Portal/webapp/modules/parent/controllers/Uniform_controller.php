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
class Uniform_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Uniform_model', 'MUniform');
        $this->load->model('parentlogin_model', 'MPlogin');
        $this->load->model('Student_model', 'MStudent');
        // if (!isLoggedin()) {
        //     if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
        //         header("HTTP/1.1 401 UNauthorized");
        //         die();
        //     } else {
        //         redirect(base_url('portal/parent-login'));
        //     }
        // }
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
        $details_data = $this->MUniform->get_all_studentdata($parent_id, $inst_id);
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

    public function show_uniform_payment($admission_number, $inst_id)
    {
        $this->clearCache();
        $this->session->set_userdata('admn_no_enc', $admission_number);
        $admission_number = base64_decode($admission_number);
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $data['title'] = 'Student Bill';
        $data['sub_title'] = 'Student Bill';
        $data['inst_id'] = $inst_id;
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

        // $student_id = strtoupper(filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING));

        $details_data = $this->MUniform->get_student_profile_by_admission_number($admission_number, $inst_id);

        if (isset($details_data['data']) && !empty($details_data['data'])) {
            $data['details_data'] = $details_data['data'];
            $student_id = $details_data['data'][0]['student_id'];
            $pack_list = $this->MUniform->studentpack_bill_select_oh($student_id);
            // dev_export($pack_list);
            // die;
            if (isset($pack_list['data']) && !empty($pack_list['data'])) {
                $data['pack_list'] = $pack_list['data']['data'];
            } else {
                $data['pack_list'] = NULL;
            }
            // $data['template'] = 'student/studentbill';
            // $this->load->view('template/parent_template', $data);
        } else {
            $data['details_data'] = NULL;
        }
        $data['template'] = 'student/uniform_studentbill';
        $this->load->view('template/parent_template', $data);
    }

    public function pack_details()
    {
        $data['title'] = 'Student Bill';
        $data['sub_title'] = 'Student Bill';

        if ($this->input->is_ajax_request() == 1) {
            $pack_id = strtoupper(filter_input(INPUT_POST, 'packid', FILTER_SANITIZE_STRING));
            $student_id = strtoupper(filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING));
            $barcode = strtoupper(filter_input(INPUT_POST, 'barcode', FILTER_SANITIZE_STRING));

            $student_details = $this->MStudent->get_ind_student_details($student_id);

            if (isset($student_details['data']) && !empty($student_details['data'])) {


                $details_data = $this->MUniform->get_bill_pack_details($pack_id);

                $pack_list_data = $this->MUniform->studentpack_bill_select_oh($student_id, $pack_id);

                if (isset($details_data['data']) && !empty($details_data['data'])) {
                    $data['details_data'] = $details_data['data'];
                } else {
                    $data['details_data'] = NULL;
                }
                if (isset($pack_list_data['data']) && !empty($pack_list_data['data'])) {
                    $data['pack_data'] = $pack_list_data['data']['data'][0];
                } else {
                    $data['pack_data'] = NULL;
                }
                $data['student_details'] = $student_details['data'][0];
                $data['std_id'] = $student_id;
                $data['pack_id'] = $pack_id;
                $data['barcode'] = $barcode;
                echo json_encode(array('status' => 1, 'view' => $this->load->view('student/uniform_pack_details_view', $data, TRUE)));
                return TRUE;
            } else {
                $this->load->view(ERROR_500);
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function place_order()
    {
        if ($this->input->is_ajax_request() == 1) {
            $this->load->helper('mailgun');
            $pack_id = filter_input(INPUT_POST, 'pack_id', FILTER_SANITIZE_NUMBER_INT);
            $online_deilery_data = $this->MUniform->get_uniform_online_order($pack_id);
            if (!empty($online_deilery_data['data'])) {
                echo json_encode(array('status' => 2, 'message' => 'Something has gone wrong.'));
                exit();
            }
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
            $delivery_address = strtoupper(filter_input(INPUT_POST, 'delivery_address', FILTER_SANITIZE_STRING));
            $mobile_no = strtoupper(filter_input(INPUT_POST, 'mobile_no', FILTER_SANITIZE_STRING));
            $payment_type = filter_input(INPUT_POST, 'payment_type', FILTER_SANITIZE_NUMBER_INT);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            if ($payment_type == 1) {
                $data_prep['pack_id'] = $pack_id;
                $data_prep['student_id'] = $student_id;
                $data_prep['delivery_address'] = $delivery_address;
                $data_prep['payment_type'] = $payment_type;
                $data_prep['mobile_no'] = $mobile_no;
                $data_prep['reference_no'] = 'UCD' . date('dmyhis') . $pack_id;
                $status = $this->MUniform->save_uniform_online_order_delivery_details($data_prep);

                $student_personal_details = $this->MUniform->get_ind_student_details($student_id);
                $student_data = $student_personal_details['data'][0];
                $pack_list_data = $this->MUniform->studentpack_bill_select_oh($student_id, $pack_id);
                $pack_data = $pack_list_data['data']['data'][0];

                $inst_id = $this->session->userdata('inst_id');
                $data_get['student_data'] = $student_data;
                $data_get['inst_id'] =  $inst_id;
                $data_get['transaction_details_data']['f_code'] = 'COD';
                $data_get['transaction_details_data']['cod'] = 1;
                $data_get['pack_data'] = $pack_data;
                $email_message = $this->load->view('student/email_template_payment', $data_get, true);
                $subject = "Cash on Delivery Order Placed- Uniform Store Order No. " . $pack_data['barcode'];
                $mailto = $email;
                $mailcontent = $email_message;
                //$cc = $this->get_cc_email($data['inst_id']);
                $cc = '';
                $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

                $email_message = "Cash on Delivery Order received for Uniform Store Order ,Details are as follows<br/><br/>";
                $email_message .= "Order No : " . $pack_data['barcode'] . " <br/>";
                $email_message .= "Payment Amount : " . $pack_data['final_total'] . " <br/>";
                $email_message .= "Student Admission No : " . $student_data['Reg_No'] . " <br/>";
                $email_message .= "Student Name : " . $student_data['Student_Name'] . " <br/>";

                $subject = "Cash on Delivery order received for Uniform Store Order No. " . $pack_data['barcode'];
                $mailto_sp = $this->get_support_email($inst_id);
                $mailcontent = $email_message;
                $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc);

                if (!empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Something has gone wrong.'));
                }
            } else {
                $pack_list_data = $this->MUniform->studentpack_bill_select_oh($student_id, $pack_id);
                if (isset($pack_list_data['data']) && !empty($pack_list_data['data'])) {
                    $amount = $pack_list_data['data']['data'][0]['final_total'];
                    //Prepare the URL for Online Payment
                    $return_data = $this->send_atom_data($student_id, $pack_id, $amount, $delivery_address, $mobile_no, $email);
                    if ($return_data['status'] == 1 && $return_data['link'] != '') {
                        echo json_encode(array('status' => 1, 'link' => $return_data['link']));
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'Error in Payment Gateway'));
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Something has gone wrong.'));
                }
                //Prepare the URL for Online Payment
            }
        }
    }


    function send_atom_data($student_id, $pack_id, $amount, $delivery_address, $mobile_no, $email)
    { // function to send atom values

        $student_personal_details = $this->MUniform->get_ind_student_details($student_id);
        //        dev_export($student_personal_details);die;
        $student_data = array();
        if (isset($student_personal_details['data'][0]) && !empty($student_personal_details['data'][0])) {
            $student_data = $student_personal_details['data'][0];
        } else {
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Student data is not available. Please try again later or contact administrator'));
        }
        //        dev_export($student_data);die;
        $inst_id = $this->session->userdata('inst_id');
        if (strlen($delivery_address) > 35) {
            $pg_delivery_address = wordwrap($delivery_address, 35);
        } else {
            $pg_delivery_address = $delivery_address;
        }
        $address = $pg_delivery_address;
        // $phone = IS_EMAIL_TEST == 0 ? $student_data['F_C_Ph1'] : SMS_TEST_NUMBER;
        $phone = $mobile_no;
        // $email = IS_EMAIL_TEST == 0 ? ((isset($student_data['parent_email']) && !empty($student_data['parent_email'])) ? $student_data['parent_email'] : '') : TEST_EMAIL;
        $name = $student_data['Student_Name'];
        $admission_no = $student_data['Reg_No'];


        $json_data['pack_id'] = $pack_id;
        $json_data['student_id'] = $student_id;
        $json_data['amount'] = $amount;
        $student_order_data = json_encode($json_data);

        $json_data['pack_id'] = $pack_id;
        $json_data['delivery_address'] = $delivery_address;
        $json_data['mobile_no'] = $mobile_no;
        $json_data['student_id'] = $student_id;
        $json_data['amount'] = $amount;
        $json_data['email'] = $email;
        $pack_session_data[$pack_id] = $json_data;

        $this->session->set_userdata('pack_session_data', $pack_session_data);

        $ru = base_url('uniform/process-return-payment-data');
        //$ru = 'https://paynetzuat.atomtech.in/paynetzclient/ResponseParam.jsp';

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
        $transactionRequest->setCustomerBillingAddress('test');
        $transactionRequest->setCustomerStudentId($pack_id); // pack_id instead of student id
        $transactionRequest->setCustomerAdmissionNumber($admission_no);
        $transactionRequest->setStudentFeeData($student_order_data);



        $url = $transactionRequest->getPGUrl();


        if ($url) {
            return array('status' => 1, 'link' => $url);
        } else {
            return array('status' => 2, 'link' => '', 'message' => 'Payment link is down. Please contact administrator or try again later');
        }
        exit();
    }

    public function process_payment()
    {
        $this->load->helper('mailgun');
        $this->load->library('TransactionResponse');
        $transactionResponse = new TransactionResponse();
        if (ENVIRONMENT == 'development') {
            $transactionResponse->setRespHashKey("KEYRESP123657234");
        } else {
            $transactionResponse->setRespHashKey(RESPHASHCODE);
        }
        if ($transactionResponse->validateResponse($_POST)) {
            $pack_id = $_POST['udf9'];
            $student_order_json_data = $_POST['udf4'];
            //$student_order_data = json_decode($student_order_json_data, true);

            $pack_session_data = $this->session->userdata('pack_session_data');
            $student_order_data = $pack_session_data[$pack_id];

            $student_id = $student_order_data['student_id'];
            $parent_email = $student_order_data['email'];
            $inst_id = $this->session->userdata('inst_id');


            $details_data = $this->MUniform->get_bill_pack_details($pack_id);
            $pack_list_data = $this->MUniform->studentpack_bill_select_oh($student_id, $student_order_data['pack_id']);
            $pack_data = $pack_list_data['data']['data'][0];
            $pack_item_data = $details_data['data'];
            $student_personal_details = $this->MUniform->get_ind_student_details($student_id);
            $student_data = $student_personal_details['data'][0];
            $data_get['student_data'] = $student_data;
            $data_get['inst_id'] =  $inst_id;
            $data_get['transaction_details_data'] = $_POST;
            $data_get['pack_data'] = $pack_data;
            if ($_POST['f_code'] == 'Ok' && !empty($pack_session_data[$pack_id])) {
                $data_prep['pack_id'] = $student_order_data['pack_id'];
                $data_prep['student_id'] = $student_id;
                $data_prep['delivery_address'] = $student_order_data['delivery_address'];
                $data_prep['payment_type'] = 2;
                $data_prep['mobile_no'] =  $student_order_data['mobile_no'];
                $data_prep['reference_no'] = 'UOP' . date('dmyhis') . $student_order_data['pack_id'];
                $data_prep['payment_details'] =  json_encode($_POST);
                $data_prep['payment_amount'] =  $_POST['amt'];
                $data_prep['payment_status'] =  1;
                $status = $this->MUniform->save_uniform_online_order_delivery_details($data_prep);

                if (!empty($status['data'])) {
                    foreach ($pack_item_data as $item_data) {

                        $discount = ((isset($item_data['oh_discount']) ? $item_data['oh_discount'] : (isset($item_data['discount']) ? $item_data['discount'] : 0)) * $item_data['sub_total']) / 100;
                        $discount = ROUND($discount, 2);
                        if ($item_data['tax_type'] == 'P') {
                            $vat_amt = round(($item_data['sub_total'] - $discount) * $item_data['tax_percent'] / 100, 2, PHP_ROUND_HALF_UP);
                        } else {
                            $vat_amt = round($item_data['tax_percent'] * $item_data['qty'], 2, PHP_ROUND_HALF_UP);
                        }
                        $online_payment_item_data = [
                            "itemid" => $item_data['item_id'],
                            "quantity" => $item_data['qty'],
                            "rate" => $item_data['Rate'],
                            "sub_total" => $item_data['sub_total'],
                            "discount_type" => $item_data['discount_type'],
                            "discount_value" => $discount,
                            "discount_amt" => $discount,
                            "sub_total_after_discount" => $item_data['sub_total'] - $item_data['discount_amount'],
                            "vat_type" => 'P',
                            "vat_percent" => $item_data['tax_percent'],
                            "vat_after_discount" => $vat_amt,
                            "final_total" => $item_data['sub_total'] - $item_data['discount_amount'] + $vat_amt,
                        ];

                        $online_payment_item_details_data[] = $online_payment_item_data;
                    }

                    $online_payment_data['payment_mode_id'] = 6;
                    $online_payment_data['sub_total'] = $pack_data['sub_total'];
                    $online_payment_data['is_discount'] = $pack_data['discount'] == 0 ? 0 : 1;
                    $online_payment_data['discount_percent'] = $pack_data['discount_percent'];
                    $online_payment_data['discount_amount'] = $pack_data['discount'];
                    $online_payment_data['is_tax'] = 0;
                    $online_payment_data['tax_amount'] = $pack_data['vat_amount'];
                    $online_payment_data['total_amount'] = $pack_data['sub_total'] - $pack_data['discount'] + $pack_data['vat_amount'];
                    $online_payment_data['round_off'] = $pack_data['roundoff'];
                    $online_payment_data['final_amount'] = $pack_data['final_total'];
                    $online_payment_data['is_ecash'] = 0;
                    $online_payment_data['ecash_id'] = 0;
                    $online_payment_data['ecash_amount'] = 0;
                    $online_payment_data['final_payment_amount'] = $pack_data['final_total'];
                    $online_payment_data['is_payment_done'] = 1;
                    $online_payment_data['cheque_number'] = $_POST['mmp_txn'];
                    $online_payment_data['card_number'] = $_POST['bank_txn'];
                    $json_online_data = json_encode($online_payment_data);


                    $json_online_item_data = json_encode($online_payment_item_details_data);

                    $status = $this->MUniform->save_storecashbill($student_id, $student_order_data['pack_id'], $json_online_data, $json_online_item_data);

                    $billcode = $status['billno'];
                    $file_name = $this->create_bill_print_link($billcode);
                    if ($file_name) {
                        $attachment_data['filename'] = $file_name;
                        $attachment_data['filepath'] = '';
                    } else {
                        $attachment_data = [];
                    }


                    $data_get['type'] = 1;
                    $email_message = $this->load->view('student/email_template_payment', $data_get, true);
                    $subject = "Payment Success for Uniform Store Order No. " . $pack_data['barcode'];
                    $mailto = $parent_email;
                    $mailcontent = $email_message;
                    //$cc = $this->get_cc_email($data['inst_id']);
                    $cc = '';
                    $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc, $attachment_data);

                    $email_message = "Payment received for Uniform Store Order ,Details are as follows<br/><br/>";
                    $email_message .= "Order No : " . $pack_data['barcode'] . " <br/>";
                    $email_message .= "Payment Amount : " . $pack_data['final_total'] . " <br/>";
                    $email_message .= "Student Admission No : " . $student_data['Reg_No'] . " <br/>";
                    $email_message .= "Student Name : " . $student_data['Student_Name'] . " <br/>";

                    $subject = "Payment received for Uniform Store Order No. " . $pack_data['barcode'];
                    $mailto_sp = $this->get_support_email($inst_id);
                    $mailcontent = $email_message;
                    $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc, $attachment_data);
                    $this->session->unset_userdata('pack_session_data');
                    redirect(base_url() . 'uniform/payment-success');
                } else {
                    $data_get['type'] = 2;
                    $email_message = $this->load->view('student/email_template_payment', $data_get, true);
                    $subject = "Payment Failed for Uniform Store Order";
                    $mailto = $parent_email;
                    $mailcontent = $email_message;
                    $cc = '';
                    $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

                    $email_message = "Processing failed for the Payment received towards Uniform Store Order ,Details are as follows<br/><br/>";
                    $email_message .= "Order No : " . $pack_data['barcode'] . " <br/>";
                    $email_message .= "Payment Amount : Rs." . $pack_data['final_total'] . " <br/>";
                    $email_message .= "Student Admission No : " . $student_data['Reg_No'] . " <br/>";
                    $email_message .= "Student Name : " . $student_data['Student_Name'] . " <br/>";

                    $subject = "Processing failed -Payment received for Uniform Store Order No. " . $pack_data['barcode'];
                    $mailto_sp = SUPPORT_DEV_TEAM_EMAIL;
                    $mailcontent = $email_message;
                    $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc);

                    $this->session->unset_userdata('pack_session_data');
                    redirect(base_url() . 'uniform/payment-failed');
                }
            } else {

                $data_get['type'] = 2;
                $email_message = $this->load->view('student/email_template_payment', $data_get, true);
                $subject = "Payment Failed for Uniform Store Order";
                //$mailto = $student_data['FATHER_EMAIL'];
                $mailto = $parent_email;
                $mailcontent = $email_message;
                $cc = '';
                $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

                $email_message = "Payment failed for Uniform Store Order ,Details are as follows<br/><br/>";
                $email_message .= "Order No : " . $pack_data['barcode'] . " <br/>";
                $email_message .= "Payment Amount : " . $pack_data['final_total'] . " <br/>";
                $email_message .= "Student Admission No : " . $student_data['Reg_No'] . " <br/>";
                $email_message .= "Student Name : " . $student_data['Student_Name'] . " <br/>";

                $subject = "Payment failed for Uniform Store Order No. " . $pack_data['barcode'];
                $mailto_sp = $this->get_support_email($inst_id);
                $mailcontent = $email_message;
                $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc);
                $this->session->unset_userdata('pack_session_data');
                redirect(base_url() . 'uniform/payment-failed');
            }
        } else {
            $this->session->unset_userdata('pack_session_data');
            redirect(base_url() . 'uniform/payment-failed');
        }
    }

    public function create_bill_print_link($billcode)
    {
        $data['title'] = 'Student Bill';
        $data['sub_title'] = 'Student Bill';
        //        $details_data = $this->MSales->get_bill_pack_details($pack_id);
        $bill_details = $this->MUniform->get_bill_details_for_print($billcode);
        //        dev_export($bill_details);die;

        if (isset($bill_details['data']) && !empty($bill_details['data'])) {
            $data['details_data'] = $bill_details['data'];
        } else {
            $data['details_data'] = NULL;
        }

        $username = 'Online Payment';
        $billhtml = $this->load->view('student/pdf/oh_bill_template', $data, TRUE);

        $data_header['title'] = "UNIFORM STORE - BILL ";
        $header_data = $this->load->view('student/pdf/header', $data_header, TRUE);
        $header = '|' . $header_data . '|';
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y h:i:s');
        $footer = '<div style="font-size:10px;font-weight: normal;">' . 'Docme -> Store -> Bill <br/> Printed on : ' . $date . '|{PAGENO}|' . '<div style="font-size:10px;font-weight: normal;">Generated By : ' . $username . '</div></div>';

        //        echo $billhtml;
        //        die;
        $filename_report = $this->generate_pdf_all_link($billhtml, $username, $header, $footer, $billcode);
        return $filename_report;
    }


    private function generate_pdf_all_link($report_html, $username, $header = '', $footer = '', $billcode)
    {
        if (!is_dir(FCPATH . 'bill')) {
            mkdir(FCPATH . 'bill');
        }
        if (!is_dir(FCPATH . 'bill/online-payment')) {
            mkdir(FCPATH . 'bill/online-payment');
        }
        $file_name = $billcode . ".pdf";
        $filename_report = "bill/online-payment/" . $file_name;
        $pdfFilePath = FCPATH . $filename_report;
        if (file_exists($pdfFilePath) == FALSE) {
            ini_set('memory_limit', '256M'); // boost the memory limit if it's low ;)
            ini_set("pcre.backtrack_limit", "10000000");
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            if (isset($header) && !empty($header)) {
                $pdf->setAutoTopMargin = 'stretch';
                $pdf->SetHeader($header);
            }
            if (isset($footer) && !empty($footer)) {
                $pdf->SetFooter($footer); // Add a footer for good measure ;)
            }
            $stylesheet = file_get_contents(base_url('/assets/theme/css/bootstrap.css'));
            //            $stylesheet = file_get_contents(base_url('/assets/theme/css/style.css'));
            $pdf->WriteHTML($stylesheet, 1);
            $pdf->WriteHTML($report_html); // write the HTML into the PDF    
            $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file 
            return $filename_report;
        } else {
            return false;
        }
    }

    public function payment_ack_success()
    {
        $this->clearCache();
        $data['title'] = 'Success';
        $data['type'] = 'success';
        $data['msg'] = "Payment processed succesfully. Your order will be delivered soon.Thank you";
        $data['redirect_link'] = base_url() . 'payment-uniform/' . $this->session->userdata('admn_no_enc') . '/' . $this->session->userdata('inst_id');
        $data['template'] = 'student/payment_response_view';
        $this->load->view('template/parent_template', $data);
    }
    public function payment_ack_failed()
    {
        $this->clearCache();
        $data['title'] = 'Failed';
        $data['type'] = 'error';
        $data['msg'] = "Payment failed.Please try again later.Please contact school if amount is debited from account.";
        $data['redirect_link'] = base_url() . 'payment-uniform/' . $this->session->userdata('admn_no_enc') . '/' . $this->session->userdata('inst_id');
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
