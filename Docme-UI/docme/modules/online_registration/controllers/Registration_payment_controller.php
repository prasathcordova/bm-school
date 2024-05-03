<?php

/**
 * Description of Registration_payment_controller
 *
 * @author AHB
 * On 29-March-2020
 * For Registration Payment Online
 */
class Registration_payment_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Online_registration_model', 'ONRegistration');
    }

    public function process_payment()
    {
        $inst_id = base64_decode($this->input->get('c2Nob29sX2lk'));  //school_id
        if (!in_array($inst_id, array(1, 2, 3, 4, 5, 8, 9, 20))) {
            redirect('payment-expired');
            exit();
        }
        //$this->session->set_userdata('API-Key', $api_key); //
        if ($this->session->userdata('API-Key') == '' || $inst_id != $this->session->userdata('inst_id')) {
            $this->session->set_userdata('inst_id', $inst_id);
            $apiKEYS = $this->ONRegistration->get_all_api_keys($inst_id);
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
        }

        $temp_reg_id = base64_decode($this->input->get('dGVtcF9yZWdfaWQ'));  //temp
        $data['checked_temp_ids'] = $temp_reg_id;
        $data['flag'] = 1;

        $enc_retry = base64_encode('Y');
        $retry = base64_decode($this->input->get('cmV0cnk'));
        if ($retry == 'Y') {
            $data_prep['checked_temp_ids'] = $temp_reg_id;
            $data_prep['flag'] = 3; //For getting the failed payment details flag=3
            $status = $this->ONRegistration->get_all_temp_students_registration_fees($data_prep);
            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                $update_payment_data['TempReg_ID'] =  $temp_reg_id;
                $update_payment_data['payment_amount'] = 0;
                $update_payment_data['payment_status'] = 0;
                $update_payment_data['payment_reference'] = '';
                $update_payment_data['payment_data'] = '';
                $json_string = json_encode($update_payment_data);
                $this->ONRegistration->update_payment_allocation($json_string, 2); //For updating the Failed Payment
            }
        }



        $status = $this->ONRegistration->get_all_temp_students_registration_fees($data);
        if ($status['data_status'] == 1 && !empty($status['data'][0])) {
            $data['detail'] = $status['data'][0];
            $data['template'] = 'registration/show_registration_payment';
            $this->load->view('template/online_reg_template', $data);
        } else {
            redirect(base_url() . 'payment-expired');
        }
    }

    public function proceed_to_payment()
    {
        $temp_reg_id = filter_input(INPUT_POST, 'temp_reg_id', FILTER_SANITIZE_NUMBER_INT);
        $data['checked_temp_ids'] = $temp_reg_id;
        $data['flag'] = 1;
        $inst_id = $this->session->userdata('inst_id');
        $temporary_reg_details = $this->ONRegistration->get_all_temp_students_registration_fees($data);
        // dev_export($temporary_reg_details);
        // die;
        $temporary_reg_data = [];
        if (isset($temporary_reg_details['data'][0]) && !empty($temporary_reg_details['data'][0])) {
            $temporary_reg_data = $temporary_reg_details['data'][0];
        } else {
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Temporary Registration data is not available. Please try again later or contact administrator'));
        }

        $address = isset($temporary_reg_data['F_C_address1']) ? $temporary_reg_data['F_C_address1'] : 'NA';
        $address = $address . (isset($temporary_reg_data['F_C_address2']) ? $temporary_reg_data['F_C_address2'] : '');
        $address = $address . (isset($temporary_reg_data['F_C_address3']) ? $temporary_reg_data['F_C_address3'] : '');
        $phone = $temporary_reg_data['L_mobile'];
        $email = $temporary_reg_data['L_mail'];
        $name = $temporary_reg_data['fname'];
        $temp_admission_no = $temporary_reg_data['TempAdmn_No'] . '__' . $inst_id;
        $amount = $temporary_reg_data['registration_fees'];



        $ru = base_url('registration/online-payment-response');
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
        $transactionRequest->setCustomerTempRegId($temp_reg_id);
        $transactionRequest->setCustomerTempAdmNumber($temp_admission_no);
        $transactionRequest->setRegFeeData($amount);
        $url = $transactionRequest->getPGUrl();


        if ($url) {
            echo json_encode(array('status' => 1, 'link' => $url));
        } else {
            echo json_encode(array('status' => 2, 'link' => '', 'message' => 'Payment link is down. Please contact administrator or try again later'));
        }
        exit();
    }

    public function process_online_payment()
    {

        $this->load->helper('mailgun');
        $this->load->library('TransactionResponse');
        $transactionResponse = new TransactionResponse();
        //Resetting Session Starts
        $failed = 0;
        if (!empty($_POST)) {
            $temp_admission_no_inst_id = $_POST['udf6'];
            $exp_array = explode('__', $temp_admission_no_inst_id);
            if (is_array($exp_array)) {
                $inst_id =  $exp_array[1];
                //$this->session->set_userdata('API-Key', $api_key); //
                $this->session->set_userdata('inst_id', $inst_id);
                $apiKEYS = $this->ONRegistration->get_all_api_keys($inst_id);
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
            $email_message = "Payment failed in Online Registration due to insufficent data received from payment gateway";
            $subject = "Payment Failed for Online Registration-Insufficent Data from Payment Gateway";

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
        if (!empty($_POST) && $transactionResponse->validateResponse($_POST)) {
            $temp_reg_id = $_POST['udf9'];
            if ($_POST['f_code'] == 'Ok') {
                $data['TempReg_ID'] = $temp_reg_id;
                $data['payment_data'] = json_encode($_POST);
                $data['payment_reference'] = $_POST['mmp_txn'];
                $data['payment_amount'] = $_POST['amt'];
                $data['payment_status'] = 1;
            } else {
                $data['TempReg_ID'] = $temp_reg_id;
                $data['payment_data'] = json_encode($_POST);
                $data['payment_reference'] = $_POST['mmp_txn'];
                $data['payment_amount'] = $_POST['amt'];
                $data['payment_status'] = 2;
            }

            $data_get['checked_temp_ids'] = $temp_reg_id;
            $data_get['flag'] = 1;
            $temporary_reg_details = $this->ONRegistration->get_all_temp_students_registration_fees($data_get);
            $data_get['detail'] = $temporary_reg_details['data'][0];


            $json_string = json_encode($data);
            $status = $this->ONRegistration->update_payment_allocation($json_string, 2);
            $inst_id = $this->session->userdata('inst_id');
            $institution_name = $this->get_institution_name($inst_id);
            if ($_POST['f_code'] == 'Ok') {
                $data_get['transaction_details_data'] = $_POST;
                $data_get['type'] = 1;
                $data_get['inst_id'] = $this->session->userdata('inst_id');
                $email_message = $this->load->view('settings/email_template_complete_payment', $data_get, true);
                $subject = "Payment Success for Registration No. " . $data_get['detail']['TempAdmn_No'];
                $mailto = $data_get['detail']['L_mail'];
                //$mailto = 'mailalert@docme.cloud';
                $mailcontent = $email_message;
                //$cc = $this->get_cc_email($data['inst_id']);
                $cc = '';
                $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);
                $this->session->set_userdata('txn_ref', $_POST['mmp_txn']);

                $email_message = "Payment received towards Online Registration ,Details are as follows<br/><br/>";
                $email_message .= "Payment Amount : Rs." . $data['payment_amount'] . " <br/>";
                $email_message .= "Token No : " . $data_get['detail']['TempAdmn_No'] . " <br/>";
                $email_message .= "Student Name : " . $data_get['detail']['fname'] . ' ' . $data_get['detail']['mname'] . ' ' . $data_get['detail']['lname']  . " <br/>";
                $email_message .= "Institution Name : " . $institution_name . " <br/>";

                $subject = "Payment received for Online Registration. " . $data_get['detail']['TempAdmn_No'];

                $mailto_sp = $this->get_support_email($inst_id);
                $mailcontent = $email_message;
                $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc);
                redirect(base_url() . 'registration/thank-you');
            } else {
                $data_get['transaction_details_data'] = $_POST;
                $data_get['type'] = 2;
                $data_get['inst_id'] = $this->session->userdata('inst_id');
                $data_get['payment_link'] = base_url() . 'registration/online-payment?' . base64_encode('temp_reg_id') . '=' . base64_encode($temp_reg_id) . '&' . base64_encode('school_id') . '=' . base64_encode($data_get['inst_id']) . '&' . base64_encode('retry') . '=' . base64_encode('Y');
                $email_message = $this->load->view('settings/email_template_complete_payment', $data_get, true);
                $subject = "Payment Failed for Registration No. " . $data_get['detail']['TempAdmn_No'];
                $mailto = $data_get['detail']['L_mail'];
                //$mailto = 'mailalert@docme.cloud';
                $mailcontent = $email_message;
                //$cc = $this->get_cc_email($data['inst_id']);
                $cc = '';
                $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

                $email_message = "Payment failed towards Online Registration ,Details are as follows<br/><br/>";
                $email_message .= "Payment Amount : Rs." . $data['payment_amount'] . " <br/>";
                $email_message .= "Token No : " . $data_get['detail']['TempAdmn_No'] . " <br/>";
                $email_message .= "Student Name : " . $data_get['detail']['fname'] . ' ' . $data_get['detail']['mname'] . ' ' . $data_get['detail']['lname']  . " <br/>";
                $email_message .= "Institution Name : " . $institution_name . " <br/>";

                $subject = "Payment Failed for Online Registration. " . $data_get['detail']['TempAdmn_No'];

                $mailto_sp = $this->get_support_email($inst_id);
                $mailcontent = $email_message;
                $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc);

                redirect(base_url() . 'registration/failed');
            }
        } else {
            redirect(base_url() . 'payment-expired');
        }
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

    public function load_thankyou()
    {
        if ($this->session->userdata('inst_id') != '') {
            $data['msg'] = 'Payment received successfully.<br/>Reference No.: ' . $this->session->userdata('txn_ref') . '<br/> Have a good day. Thank you.';

            $data['template'] = 'registration/show_thankyou_page';
            $this->load->view('template/online_reg_template', $data);
        } else {
            redirect(base_url() . 'payment-expired');
        }
    }
    public function load_failed()
    {
        if ($this->session->userdata('inst_id') != '') {
            $data['msg'] = 'Payment failed , Please check your email for further details.';

            $data['template'] = 'registration/show_thankyou_page';
            $this->load->view('template/online_reg_template', $data);
        } else {
            redirect(base_url() . 'payment-expired');
        }
    }
    public function payment_expired()
    {
        $this->load->view('template/payment_expired');
    }
}
