<?php

/**
 * Description of authenticator_controller
 *
 * @author aju.docme
 */
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');
class Cron_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model', 'MAuthenticator');
    }
    public function dcb_report()
    {

        $result_dcb_oxf_tvm = $this->MAuthenticator->spread_sheet_query(5, 'DCB', 209);
        $result['DCB_OXF_TVM_2020-21'] = $result_dcb_oxf_tvm['data'];

        $result_dcb_oxf_klm = $this->MAuthenticator->spread_sheet_query(8, 'DCB', 238);
        $result['DCB_OXF_KLM_2020-21'] = $result_dcb_oxf_klm['data'];

        $result_dcb_oxf_clt = $this->MAuthenticator->spread_sheet_query(20, 'DCB', 270);
        $result['DCB_OXF_CLT_2020-21'] = $result_dcb_oxf_clt['data'];

        $result_dcb_oxf_tvm = $this->MAuthenticator->spread_sheet_query(5, 'DCB_LA', 209);
        $result['DCB_LA_OXF_TVM_2020-21'] = $result_dcb_oxf_tvm['data'];

        $result_dcb_oxf_klm = $this->MAuthenticator->spread_sheet_query(8, 'DCB_LA', 238);
        $result['DCB_LA_OXF_KLM_2020-21'] = $result_dcb_oxf_klm['data'];

        $result_dcb_oxf_clt = $this->MAuthenticator->spread_sheet_query(20, 'DCB_LA', 270);
        $result['DCB_LA_OXF_CLT_2020-21'] = $result_dcb_oxf_clt['data'];

        $result_dcb_oxf_tvm = $this->MAuthenticator->spread_sheet_query(5, 'DCB');
        $result['DCB_OXF_TVM_2021-22'] = $result_dcb_oxf_tvm['data'];

        $result_dcb_oxf_klm = $this->MAuthenticator->spread_sheet_query(8, 'DCB');
        $result['DCB_OXF_KLM_2021-22'] = $result_dcb_oxf_klm['data'];

        $result_dcb_oxf_clt = $this->MAuthenticator->spread_sheet_query(20, 'DCB');
        $result['DCB_OXF_CLT_2021-22'] = $result_dcb_oxf_clt['data'];

        $result_dcb_oxf_tvm = $this->MAuthenticator->spread_sheet_query(5, 'DCB_LA');
        $result['DCB_LA_OXF_TVM_2021-22'] = $result_dcb_oxf_tvm['data'];

        $result_dcb_oxf_klm = $this->MAuthenticator->spread_sheet_query(8, 'DCB_LA');
        $result['DCB_LA_OXF_KLM_2021-22'] = $result_dcb_oxf_klm['data'];

        $result_dcb_oxf_clt = $this->MAuthenticator->spread_sheet_query(20, 'DCB_LA');
        $result['DCB_LA_OXF_CLT_2021-22'] = $result_dcb_oxf_clt['data'];

        $result_arrear_oxf_tvm = $this->MAuthenticator->spread_sheet_query(5, 'ARREAR');
        $result['ARREAR_OXF_TVM'] = $result_arrear_oxf_tvm['data'];

        $result_arrear_oxf_klm = $this->MAuthenticator->spread_sheet_query(8, 'ARREAR');
        $result['ARREAR_OXF_KLM'] = $result_arrear_oxf_klm['data'];

        $result_arrear_oxf_clt = $this->MAuthenticator->spread_sheet_query(20, 'ARREAR');
        $result['ARREAR_OXF_CLT'] = $result_arrear_oxf_clt['data'];

        $result_arrear_oxf_tvm = $this->MAuthenticator->spread_sheet_query(5, 'ARREAR_LA');
        $result['ARREAR_LA_OXF_TVM'] = $result_arrear_oxf_tvm['data'];

        $result_arrear_oxf_klm = $this->MAuthenticator->spread_sheet_query(8, 'ARREAR_LA');
        $result['ARREAR_LA_OXF_KLM'] = $result_arrear_oxf_klm['data'];

        $result_arrear_oxf_clt = $this->MAuthenticator->spread_sheet_query(20, 'ARREAR_LA');
        $result['ARREAR_LA_OXF_CLT'] = $result_arrear_oxf_clt['data'];

        // $result_monthly_dcb_oxf_tvm = $this->MAuthenticator->spread_sheet_query(5, 'MONTHLY_DCB');
        // $result['MONTHLY_DCB_OXF_TVM'] = $result_monthly_dcb_oxf_tvm['data'];

        // $result_monthly_dcb_oxf_klm = $this->MAuthenticator->spread_sheet_query(8, 'MONTHLY_DCB');
        // $result['MONTHLY_DCB_OXF_KLM'] = $result_monthly_dcb_oxf_klm['data'];

        // $result_monthly_dcb_oxf_clt = $this->MAuthenticator->spread_sheet_query(20, 'MONTHLY_DCB');
        // $result['MONTHLY_DCB_OXF_CLT'] = $result_monthly_dcb_oxf_clt['data'];

        $result_collection_oxf_tvm = $this->MAuthenticator->spread_sheet_query(5, 'COLLECTION');
        $result['COLLECTION_OXF_TVM'] = $result_collection_oxf_tvm['data'];

        $result_collection_oxf_klm = $this->MAuthenticator->spread_sheet_query(8, 'COLLECTION');
        $result['COLLECTION_OXF_KLM'] = $result_collection_oxf_klm['data'];

        $result_collection_oxf_clt = $this->MAuthenticator->spread_sheet_query(20, 'COLLECTION');
        $result['COLLECTION_OXF_CLT'] = $result_collection_oxf_clt['data'];

        // $result_exmp_req_oxf_tvm = $this->MAuthenticator->spread_sheet_query(5, 'EXEMPTION_REQUESTS');
        // $result['EXMP_REQ_OXF_TVM'] = $result_exmp_req_oxf_tvm['data'];

        // $result_exmp_req_oxf_klm = $this->MAuthenticator->spread_sheet_query(8, 'EXEMPTION_REQUESTS');
        // $result['EXMP_REQ_OXF_KLM'] = $result_exmp_req_oxf_klm['data'];

        // $result_exmp_req_oxf_clt = $this->MAuthenticator->spread_sheet_query(20, 'EXEMPTION_REQUESTS');
        // $result['EXMP_REQ_OXF_CLT'] = $result_exmp_req_oxf_clt['data'];


        $this->load->helper('sheet');
        $filename_report = multi_sheet_report($result, 'STUDENT_DCB_OXF');

        if ($this->input->get('email') == 1) {

            $email_message = "This is an auto generated email from " . APP_TITLE . "<br/><br/>";
            $email_message .= "This email contains attachment for DCB Report<br/>";

            $subject = "DCB Report Indian Schools-" . date('d M Y');
            $this->load->helper('mailgun');
            if ($filename_report) {
                $attachment_data['filename'] = $filename_report;
                $attachment_data['filepath'] = 'reports/sheets/';
            } else {
                $attachment_data = [];
            }
            $mailto_sp = SUPPORT_DEV_TEAM_EMAIL . ',' . MH_TRUST_EMAIL;
            $mailcontent = $email_message;
            $cc = '';
            $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc, $attachment_data);
            echo 'Email sent to ' . SUPPORT_DEV_TEAM_EMAIL . ',' . MH_TRUST_EMAIL;
        } else {
            redirect(base_url() . 'reports/sheets/' . $filename_report . '?' . time());
        }
    }

    public function dcb_monthwise_report()
    {
        $result_dcb_oxf_tvm = $this->MAuthenticator->spread_sheet_query(5, 'DCB_MONTHWISE');
        $result['OXF_TVM'] = $result_dcb_oxf_tvm['data'];

        $result_dcb_oxf_klm = $this->MAuthenticator->spread_sheet_query(8, 'DCB_MONTHWISE');
        $result['OXF_KLM'] = $result_dcb_oxf_klm['data'];

        $result_dcb_oxf_clt = $this->MAuthenticator->spread_sheet_query(20, 'DCB_MONTHWISE');
        $result['OXF_CLT'] = $result_dcb_oxf_clt['data'];

        $result_dcb_oxf_summary = $this->MAuthenticator->spread_sheet_query(1000, 'DCB_MONTHWISE_SUMMARY');
        $result['SUMMARY'] = $result_dcb_oxf_summary['data'];

        $this->load->helper('sheet');
        //$filename_report = multi_sheet_report($result, 'MONTHWISE_DCB_OXF');
        $filename_report = multi_sheet_template_report($result, 'MONTHWISE_DCB_OXF', 'MONTH_WISE_DCB_TEMPLATE');

        if ($this->input->get('email') == 1) {

            $email_message = "This is an auto generated email from " . APP_TITLE . "<br/><br/>";
            $email_message .= "This email contains attachment for DCB Monthwise Report<br/>";

            $subject = "DCB Monthwise Report Indian Schools-" . date('d M Y');
            $this->load->helper('mailgun');
            if ($filename_report) {
                $attachment_data['filename'] = $filename_report;
                $attachment_data['filepath'] = 'reports/sheets/';
            } else {
                $attachment_data = [];
            }
            $mailto_sp = SUPPORT_DEV_TEAM_EMAIL . ',' . MH_TRUST_EMAIL;
            $mailcontent = $email_message;
            $cc = '';
            $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc, $attachment_data);
            echo 'Email sent to ' . SUPPORT_DEV_TEAM_EMAIL . ',' . MH_TRUST_EMAIL;
        } else {
            redirect(base_url() . 'reports/sheets/' . $filename_report . '?' . time());
        }
    }

    public function wallet_balance_report()
    {
        $result_wallet_balance_tvm = $this->MAuthenticator->spread_sheet_query(5, 'WALLET_BALANCE');
        $result['WALLET_BALANCE_OXF_TVM'] = empty($result_wallet_balance_tvm['data']) ? [] : $result_wallet_balance_tvm['data'];

        $result_wallet_balance_klm = $this->MAuthenticator->spread_sheet_query(8, 'WALLET_BALANCE');
        $result['WALLET_BALANCE_OXF_KLM'] = empty($result_wallet_balance_klm['data']) ? [] : $result_wallet_balance_klm['data'];

        $result_wallet_balance_clt = $this->MAuthenticator->spread_sheet_query(20, 'WALLET_BALANCE');
        $result['WALLET_BALANCE_OXF_CLT'] = empty($result_wallet_balance_clt['data']) ? [] : $result_wallet_balance_clt['data'];

        $result_consolidated_array = $this->MAuthenticator->spread_sheet_query(1000, 'WALLET_SUMMARY');
        $result_consolidated_data = empty($result_consolidated_array['data']) ? [] : $result_consolidated_array['data'];


        $this->load->helper('sheet');
        if (sizeof($result['WALLET_BALANCE_OXF_CLT']) > 0 || sizeof($result['WALLET_BALANCE_OXF_KLM']) > 0 || sizeof($result['WALLET_BALANCE_OXF_TVM']) > 0) {
            $filename_report = multi_sheet_report($result, 'DOCME_WALLET_BALANCE_OXF');
            if ($this->input->get('email') == 1) {

                $email_message = "This is an auto generated email from " . APP_TITLE . "<br/><br/>";
                $email_message .= "This email contains attachment for Docme Wallet Balance Report<br/><br/>";
                $email_message .= "The consolidated data for  Docme Wallet Balance is listed below<br/>";
                $email_message .= '<table style="border-collapse: collapse;font-size: 12px;">';
                $email_message .= '<tr >';
                $email_message .= '<th style="border: 1px solid #000;padding: 5px">Institution Name</th>';
                $email_message .= '<th style="border: 1px solid #000;padding: 5px">No of Students</th>';
                $email_message .= '<th style="border: 1px solid #000;padding: 5px">Total Amount</th>';
                $email_message .= '</tr>';
                foreach ($result_consolidated_data as $data) {
                    $email_message .= '<tr>';
                    $email_message .= '<td style="border: 1px solid #000;padding: 5px">' . $data['inst_name'] . '</td>';
                    $email_message .= '<td style="border: 1px solid #000;padding: 5px">' . $data['total_count'] . '</td>';
                    $email_message .= '<td style="border: 1px solid #000;padding: 5px">' . my_money_format($data['total_balance']) . '</td>';
                    $email_message .= '</tr>';
                }
                $email_message .= '</table>';

                $subject = "Docme Wallet Balance Indian Schools-" . date('d M Y');
                $this->load->helper('mailgun');
                if ($filename_report) {
                    $attachment_data['filename'] = $filename_report;
                    $attachment_data['filepath'] = 'reports/sheets/';
                } else {
                    $attachment_data = [];
                }
                $mailto_sp = SUPPORT_DEV_TEAM_EMAIL . ',' . MH_TRUST_EMAIL;
                $mailcontent = $email_message;
                $cc = '';
                $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc, $attachment_data);
                echo 'Email sent to ' . SUPPORT_DEV_TEAM_EMAIL . ',' . MH_TRUST_EMAIL;
            } else {
                redirect(base_url() . 'reports/sheets/' . $filename_report . '?' . time());
            }
        } else {
            echo 'No Data Found';
        }
    }
    public function saved_dcb_monthwise_report()
    {
        $yday = date('dmY', strtotime("-1 days"));
        $filename_report = 'MONTHWISE_DCB_OXF_' . $yday . '.xlsx';
        redirect(base_url() . 'reports/sheets/' . $filename_report . '?' . time());
    }
    public function saved_dcb_report()
    {
        $yday = date('dmY', strtotime("-1 days"));
        $filename_report = 'STUDENT_DCB_OXF_' . $yday . '.xlsx';
        redirect(base_url() . 'reports/sheets/' . $filename_report . '?' . time());
    }
}
