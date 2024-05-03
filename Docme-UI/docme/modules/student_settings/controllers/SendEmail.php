<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SendEmail
 *
 * @author docme28
 */
class SendEmail extends MX_Controller
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
        $this->load->model('Registration_model', 'MRegistration');
        $this->load->library('email'); // load the library
        $this->load->helper('mailgun');
    }
    //this mail function made by elavarasan S @ 31-05-2019 3:35
    public function sendEmail()
    {
        // require APPPATH . 'third_party/vendor/autoload.php';
        // $email = "mailalert@docme.cloud";
        // $password = "123abcAB";
        // $data['message_body'] = filter_input(INPUT_POST, 'email_body');
        // $data['student_name'] = filter_input(INPUT_POST, 'stud_name');
        // $data['Admn_No'] = filter_input(INPUT_POST, 'admn_no');
        // $data['batch'] = filter_input(INPUT_POST, 'batch');
        // $data['inst_id'] = $this->session->userdata('inst_id');
        // $message  = $this->load->view('student_profile/email_template', $data, true);
        // $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
        // $mail = new PHPMailer\PHPMailer\PHPMailer;
        // $mail->isSMTP();
        // $mail->Host = 'smtp.googlemail.com';
        // $mail->Port = 587;
        // $mail->SMTPSecure = 'tls';
        // $mail->SMTPAuth = true;
        // $mail->Username = $email;
        // $mail->Password = $password;
        // $mail->SetFrom($email, 'The Oxford School');

        // if (ENVIRONMENT == 'development') {
        //     $mail->addAddress('mailalert@docme.cloud');
        // } else {
        //     $mail->addAddress(filter_input(INPUT_POST, 'to_email', FILTER_SANITIZE_STRING));
        // }

        // //        $mail->addCC('elavarasan@docme.cloud','Elavarasan');
        // $mail->Subject = $subject;
        // $mail->msgHTML($message);
        // if (!$mail->send()) {
        //     //            echo $mail->ErrorInfo;
        //     echo json_encode(array('status' => 2, 'Mail sending failed'));
        //     return true;
        // } else {
        //     echo json_encode(array('status' => 1, 'message' => 'Mail sent successfully'));
        //     return true;
        // }



        $data['message_body'] = filter_input(INPUT_POST, 'email_body');
        $data['student_name'] = filter_input(INPUT_POST, 'stud_name');
        $data['Admn_No'] = filter_input(INPUT_POST, 'admn_no');
        $data['batch'] = filter_input(INPUT_POST, 'batch');
        $data['inst_id'] = $this->session->userdata('inst_id');
        $mailcontent = $this->load->view('student_profile/email_template', $data, true);
        $mailto = filter_input(INPUT_POST, 'to_email', FILTER_SANITIZE_STRING);
        $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
        $cc = '';

        $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

        if ($email_res) {
            echo json_encode(array('status' => 1, 'Mail sending failed'));
            return true;
        } else {
            echo json_encode(array('status' => 2, 'message' => 'Mail sent successfully'));
            return true;
        }
    }

    //    public function sendEmail() {
    //        // Email configuration
    //        $config = Array(
    //            'protocol' => 'smtp',
    //            'smtp_host' => 'ssl://smtp.googlemail.com',
    //            'smtp_port' => '465',
    //            'smtp_user' => 'docme.cloud.mailer@gmail.com', // change it to yours
    //            'smtp_pass' => 'news@123', // change it to yours
    //            'mailtype' => 'html',
    //            'starttls' => true,
    //            'newline' => "\r\n"
    //        );
    //
    //
    //
    ////        echo filter_input(INPUT_POST, 'to', FILTER_SANITIZE_STRING);
    ////        echo filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    //        $this->load->library('email', $config);
    //        $this->email->from('docme.cloud.mailer@gmail.com', "Admin Team");
    //        if(IS_EMAIL_TEST == 1) {
    //            $this->email->to('aju.docme@acetvm.com');
    //        } else {
    //            $this->email->to(filter_input(INPUT_POST, 'to_email', FILTER_SANITIZE_STRING));
    //        }
    //        
    //        $this->email->cc("aju.docme@acetvm.com");
    //        $this->email->subject(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING));
    //        $this->email->message(filter_input(INPUT_POST, 'email_body', FILTER_SANITIZE_STRING));
    //        if ($this->email->send()) {
    //            echo json_encode(array('status' => 1, 'message' => 'Mail sent successfully'));
    //            return true;
    //        } else {
    //            echo json_encode(array('status' => 2, 'Mail sending failed'));
    //            return true;
    //        }
    //    }

}
