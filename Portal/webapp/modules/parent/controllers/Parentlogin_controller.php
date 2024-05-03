<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Parent login_controller
 *
 * @author chandrajith.edsys
 */
class Parentlogin_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('parentlogin_model', 'MPlogin');
    }

    public function login_view()
    {
        if (isLoggedin()) {
            redirect(base_url());
            return;
        }
        $this->session->set_userdata('API-Key', '');
        $this->session->unset_userdata('API-Key', '');
        $this->session->unset_userdata('isgoogle_login_failed');
        $this->session->unset_userdata('isgoogle_no_access_rights');
        $this->session->set_userdata('isloggedin', '0');
        $this->session->unset_userdata('isloggedin', '0');
        $this->session->set_userdata('isloggedin', '0');
        $this->session->unset_userdata('isloggedin', '0');
        $this->session->set_userdata('userid', '');
        $this->session->unset_userdata('userid', '');
        $this->session->unset_userdata('authurl');
        $this->session->unset_userdata('token');
        $this->session->set_userdata('apppage', '');
        $this->session->set_userdata('apppage');
        $this->session->set_userdata('operationid', '');
        $this->session->set_userdata('operationid');
        $this->session->set_userdata('min_pay_amt', '0');
        $this->session->sess_destroy();
        $data['template'] = 'parent_login/login_homeparent';
        $this->load->view('template/parent_login_template', $data);
    }

    public function parent_login()
    {
        if ($this->input->is_ajax_request() == 1) {
            if (null !== filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)) {
                $user_email = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
            if (null !== filter_input(INPUT_POST, 'passcode', FILTER_SANITIZE_EMAIL)) {
                $user_password = filter_input(INPUT_POST, 'passcode', FILTER_SANITIZE_EMAIL);
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }

            $data_prep = array(
                'user_email' => $user_email,
                'user_passcode' => $user_password
            );

            $status = $this->MPlogin->check_parent_login($data_prep);

            if (is_array($status) && $status['data_status'] == 1 && $status['data']['status'] == 1) {
                $this->session->set_userdata('API-Key', $status['data']['apikey']);
                $this->session->set_userdata('isloggedin', '1');
                $this->session->set_userdata('parent_id', $status['data']['userid']);
                $parent_id = $status['data']['userid'];
                $min_pay_amt = isset($status['data']['min_pay_amt']) ? $status['data']['min_pay_amt'] : 0;
                $this->session->set_userdata(array(
                    'isLoggedIn' => 1,
                    'isgoogle_login' => 0,
                    'mobile' => $user_email,
                    'inst_id' => 13,
                    'API-Key' => $status['data']['apikey'],
                    'parent_id' => $parent_id,
                    'user_image' => '',
                    'is_parent' => 1,
                    'min_pay_amt' => $min_pay_amt
                ));
                echo json_encode(array('status' => 1, 'redirect_url' => base_url()));
            } else {
                echo json_encode(array('status' => "0"));
            }
        }
    }

    public function parent_login_otp_request()
    {
        if ($this->input->is_ajax_request() == 1) {
            if (null !== filter_input(INPUT_POST, 'user_phone_no', FILTER_SANITIZE_STRING)) {
                $user_phone_no = filter_input(INPUT_POST, 'user_phone_no', FILTER_SANITIZE_STRING);
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
            if (null !== filter_input(INPUT_POST, 'admn_no', FILTER_SANITIZE_EMAIL)) {
                $admn_no = filter_input(INPUT_POST, 'admn_no', FILTER_SANITIZE_STRING);
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }

            $data_prep = array(
                'user_phone_no' => $user_phone_no,
                'user_admnno' => $admn_no,
                'action' => 'verify_user_for_login'
            );

            $status = $this->MPlogin->check_parent_for_otp_request($data_prep);
            // dev_export($status);
            // die;
            if (is_array($status) && $status['data_status'] == 1 && $status['data']['USER_STATUS'] == 1) {
                //                $formatted_period = array();
                //                $message_body = sprintf(SMS_TEMPLATE_FOR_ATTENDANCE_APPROVAL, 'Test', $admn_no, $status['data']['OTP'], implode(',', $formatted_period));
                $message_body = sprintf(SMS_TEMPLATE_FOR_ATTENDANCE_APPROVAL,  $admn_no, $status['data']['OTP']);
                $data = array(
                    SMS_USERNAME_PARAM => SMS_USERNAME_VALUE,
                    SMS_PASSWORD_PARAM => SMS_PASSWORD_VALUE,
                    SMS_SENDER_ID_PARAM => SMS_SENDER_ID_VALUE,
                    SMS_MESSAGE_PARAM => $message_body,
                    SMS_ROUTE_PARAM => SMS_ROUTE_VALUE
                );
                if (ENVIRONMENT == 'development') {
                    $data[SMS_TO_PARAM] = SMS_DEFAULT_TO_VALUE;
                    $data['sms'] = $message_body;
                    $data['otp'] = $status['data']['OTP'];
                } else {
                    $data[SMS_TO_PARAM] = $user_phone_no;
                    $stat = transport_sms_data($data);
                    if (empty($stat)) {
                        echo json_encode(array('status' => "0"));
                        return;
                    }
                    $data = array();
                }

                $this->session->set_userdata('API-Key', $status['data']['API_KEY']);
                $this->session->set_userdata('isloggedin', '0');
                $this->session->set_userdata(array(
                    'isLoggedIn' => 0,
                    'isgoogle_login' => 0,
                    'mobile' => $user_phone_no,
                    'OTP-KEY' => $status['data']['API_KEY'],
                    'user_image' => '',
                    'is_parent' => 1,
                ));

                echo json_encode(array('status' => 1, 'view' => $this->load->view('parent_login/otp_verification', $data, TRUE)));
            } else {
                echo json_encode(array('status' => "0"));
            }
        }
    }

    public function parent_otp_verification_and_login()
    {
        if ($this->input->is_ajax_request() == 1) {
            $otp = filter_input(INPUT_POST, 'otp_data', FILTER_SANITIZE_STRING);
            $data_prep = array(
                'action' => 'parent_verify_and_login_with_otp_and_api',
                'otp' => $otp,
                'API_KEY_VALIDATE' => $this->session->userdata('OTP-KEY')
            );
            $status = $this->MPlogin->otp_verification_and_login($data_prep);

            //            dev_export($status);die;
            if (is_array($status) && $status['data_status'] == 1 && $status['data']['USER_STATUS'] == 1) {

                if ($this->session->userdata('API-Key') == '' || $status['data']['INST_ID'] != $this->session->userdata('inst_id')) {
                    $apiKEYS = $this->MPlogin->get_all_api_keys($status['data']['INST_ID']);
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

                //$this->session->set_userdata('API-Key', $status['data']['API_KEY']);
                $this->session->set_userdata('isloggedin', '1');
                $this->session->set_userdata('parent_id', $status['data']['PARENT_ID']);
                $parent_id = $status['data']['PARENT_ID'];
                $min_pay_amt = isset($status['data']['min_pay_amt']) ? $status['data']['min_pay_amt'] : 0;
                $this->session->set_userdata(array(
                    'isLoggedIn' => 1,
                    'isgoogle_login' => 0,
                    'mobile' => isset($status['data']['PARENT_EMAIL']) ? $status['data']['PARENT_EMAIL'] : 0,
                    'inst_id' => isset($status['data']['INST_ID']) ? $status['data']['INST_ID'] : 0,
                    //'API-Key' => isset($status['data']['API_KEY']) ? $status['data']['API_KEY'] : 0,
                    'parent_id' => $parent_id,
                    'user_image' => '',
                    'is_parent' => 1,
                    'min_pay_amt' => $min_pay_amt,
                    'inst_name' => isset($status['data']['INST_NAME']) ? $status['data']['INST_NAME'] : 0,
                    'inst_place' => isset($status['data']['INST_NAME']) ? $status['data']['INST_PLACE'] : 0,
                    'inst_address' => isset($status['data']['INST_ADDRESS']) ? isset($status['data']['INST_PLACE']) ? implode("<br>", array($status['data']['INST_PLACE'], $status['data']['INST_ADDRESS'])) : $status['data']['INST_ADDRESS'] : isset($status['data']['INST_PLACE']) ? $status['data']['INST_PLACE'] : 0,
                    'inst_phone' => isset($status['data']['INST_PHONE']) ? $status['data']['INST_PHONE'] : 0
                ));
                echo json_encode(array('status' => 1, 'redirect_url' => base_url()));
            } else {
                echo json_encode(array('status' => "0"));
            }
        } else {
            echo json_encode(array('status' => "0"));
        }
    }

    public function logout()
    {
        $this->session->set_userdata('API-Key', '');
        $this->session->unset_userdata('API-Key', '');
        $this->session->unset_userdata('isgoogle_login_failed');
        $this->session->unset_userdata('isgoogle_no_access_rights');
        $this->session->set_userdata('isloggedin', '0');
        $this->session->unset_userdata('isloggedin', '0');
        $this->session->set_userdata('isloggedin', '0');
        $this->session->unset_userdata('isloggedin', '0');
        $this->session->set_userdata('userid', '');
        $this->session->unset_userdata('userid', '');
        $this->session->unset_userdata('authurl');
        $this->session->unset_userdata('token');
        $this->session->set_userdata('apppage', '');
        $this->session->set_userdata('apppage');
        $this->session->set_userdata('operationid', '');
        $this->session->set_userdata('operationid');
        $this->session->set_userdata('min_pay_amt', '0');
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
