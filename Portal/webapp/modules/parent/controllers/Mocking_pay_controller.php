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
class Mocking_pay_controller extends MX_Controller
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

    public function payment()
    {
        // $acd_year_id    = $this->session->userdata('acd_year');
        echo  $this->input->post('udf9');

            
       
    }

    public function payment_ack_success()
    {

        $data['title'] = 'Success';
        $data['type'] = 'success';
        $data['msg'] = "Payment processed succesfully. Your payment will refelected soon.Thank you";

        $data['template'] = 'student/payment_response_view';
        $this->load->view('template/parent_template', $data);
    }
    public function payment_ack_failed()
    {

        $data['title'] = 'Failed';
        $data['type'] = 'error';
        $data['msg'] = "Payment failed.Please try again later.Please contact school if amount is debited from account.";

        $data['template'] = 'student/payment_response_view';
        $this->load->view('template/parent_template', $data);
    }

    function get_support_email($inst_id)
    {
        switch ($inst_id) {
            case 5:
                $cc_email = SUPPORT_EMAIL_OXFTVM;
                break;
            case 8:
                $cc_email = SUPPORT_EMAIL_OXFKLM;
                break;
            case 20:
                $cc_email = SUPPORT_EMAIL_OXFCLT;
                break;
            default:
                $cc_email = SUPPORT_DEV_TEAM_EMAIL;
                break;
        }

        return SUPPORT_DEV_TEAM_EMAIL;
        //return $cc_email.','.SUPPORT_DEV_TEAM_EMAIL;
    }
}
