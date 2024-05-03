<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'Mailgun/autoload.php';
require APPPATH . 'third_party/vendor/autoload.php';

use Mailgun\Mailgun;

function sendgrid_mailer($subject = '', $mailto = '', $mailcontent = '', $cc = '', $attachmentdata = array())
{
    $CI = get_instance();
    if ($CI->session->userdata('Institution_Name') != '') {
        $inst_name = $CI->session->userdata('Institution_Name');
    } else {
        $inst_name = 'THE OXFORD SCHOOL';
    }
    try { # Instantiate the client.
        //$mgClient = new Mailgun('206afdf25f560a13b399142fa4d34309-3939b93a-886fd141');
        //$domain = "mail.nimsuae.com";
        //$mailto = 'fathima@docme.cloud';
        if (ENVIRONMENT == 'development') {
            $mailto = 'mailalert@docme.cloud';
        }
        $mgClient = new Mailgun('key-2f3a8aececbc140ffb04a1bf9b935f06');
        $domain = "mg.docme.online";

        $mail_array = array(
            'from'    => $inst_name . '<postmaster@mg.docme.online>',
            'to'      => $mailto,
            'subject' => $subject,
            'text'    => '',
            'html'    => $mailcontent
        );
        # Make the call to the client. 
        if (!empty($attachmentdata)) {
            $filePath = FCPATH . $attachmentdata['filepath'] . $attachmentdata['filename'];
            $result = $mgClient->sendMessage(
                $domain,
                $mail_array,
                array(
                    'attachment' => array($filePath)
                )
            );
        } else {
            $result = $mgClient->sendMessage($domain, $mail_array);
        }
        if ($cc != '') {
            send_smtp_mailer($subject, $cc, $mailcontent, '', $attachmentdata);
        }
        $res = $result->http_response_code;
        return $res;
    } catch (Exception $e) {
        $res = $e->getCode() . PHP_EOL;
        return $res;
    }
}

function send_smtp_mailer($subject = '', $mailto = '', $mailcontent = '', $cc = '', $attachmentdata = array())
{
    $CI = get_instance();
    if ($CI->session->userdata('Institution_Name') != '') {
        $inst_name = $CI->session->userdata('Institution_Name');
    } else {
        $inst_name = 'THE OXFORD SCHOOL';
    }
    try {

        $email = "mailalert@docme.cloud";
        $password = "123abcAB";
        if (ENVIRONMENT == 'development') {
            $mailto = 'mailalert@docme.cloud';
        }
        $mail = new PHPMailer\PHPMailer\PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.googlemail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $email;
        $mail->Password = $password;
        $mail->SetFrom($email, $inst_name);
        $addresses = explode(',', $mailto);

        foreach ($addresses as $address) {
            $mail->addAddress(trim($address));
        }

        $mail->Subject = $subject;
        $mail->msgHTML($mailcontent);
        # Make the call to the client. 
        if ($cc != '') {
            $mail->AddCC($cc);
        }
        if (!empty($attachmentdata)) {
            $filePath = FCPATH . $attachmentdata['filepath'] . $attachmentdata['filename'];
            $mail->addAttachment($filePath);
        }
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        $res = false;
        return $res;
    }
}
