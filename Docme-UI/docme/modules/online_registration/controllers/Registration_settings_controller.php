<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registration_settings_controller
 *
 * @author AHB
 */
class Registration_settings_controller extends MX_Controller
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
        $this->load->model('Online_registration_model', 'ONRegistration');
    }

    public function show_settings()
    {
        $data['template'] = 'settings/show_settings';
        $data['title'] = 'REGISTRATION SETTINGS';
        $data['sub_title'] = 'Registration Settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Admission Management',
                'link' => base_url('registration/show-settings')
            ),
            '2' => array(
                'title' => 'Registration Settings',
                'link' => base_url('registration/show-settings')
            )
        );
        //          $breadcrmp = strtoupper(filter_input(INPUT_POST, 'breadcrmp', FILTER_SANITIZE_STRING));
        ////        dev_export($breadcrmp);die;
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);

        $this->load->view('template/home_template', $data);
    }

    public function show_amount_settings()
    {
        $data['sub_title'] = 'Amount Settings';
        $data['user_name'] = $this->session->userdata('user_name');
        $class_fee_data = $this->ONRegistration->get_class_registration_fee();
        // dev_export($class_fee_data);
        // die;
        if (isset($class_fee_data['data']) && !empty($class_fee_data['data'])) {
            $data['class_fee_data'] = $class_fee_data['data'];
        } else {
            $data['class_fee_data'] = NULL;
        }

        $this->load->view('settings/show_amount_settings', $data);
    }
    public function save_registration_fees()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $registration_fees = filter_input(INPUT_POST, 'registration_fees', FILTER_SANITIZE_STRING);
            $foreign_registration_fees = filter_input(INPUT_POST, 'foreign_registration_fees', FILTER_SANITIZE_STRING);
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);

            $data['class_id'] = $class_id;
            $data['registration_fees'] = $registration_fees;
            $data['foreign_registration_fees'] = $foreign_registration_fees;
            $data['flag'] = $flag;

            $status = $this->ONRegistration->update_registration_fees($data);
            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Updated Successfully'));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $status['message']));
                    return false;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            }
        }
    }

    public function show_payment_allocation()
    {
        if ($this->input->is_ajax_request() == 1) {

            $data['sub_title'] = 'Payment Allocation';
            $data['user_name'] = $this->session->userdata('user_name');
            //        CLASS DATA
            $class = $this->ONRegistration->get_all_class();
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
            $acdyr = $this->ONRegistration->get_all_acadyr();
            if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
                if ($acdyr['data_status'] == 1) {
                    $data['acdyr_data'] = $acdyr['data'];
                } else {
                    $data['acdyr_data'] = FALSE;
                }
            } else {
                $data['acdyr_data'] = FALSE;
            }

            $this->load->view('settings/show_payment_allocation', $data);
        }
    }

    public function get_temporary_regisration_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $registration_fees = filter_input(INPUT_POST, 'acd_yr', FILTER_SANITIZE_NUMBER_INT);
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);

            $data['class_id'] = $class_id;
            $data['acd_yr'] = $registration_fees;

            $status = $this->ONRegistration->get_all_temp_students_registration_fees($data);
            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                $data['class_fee_data'] = $status['data'];
                echo json_encode(array('status' => 1, 'message' => 'Loaded Successfully', 'view' => $this->load->view('settings/partial_view_registration_list', $data, true)));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    $data['class_fee_data'] = [];
                    echo json_encode(array('status' => 1, 'message' => $status['message'], 'view' => $this->load->view('settings/partial_view_registration_list', $data, true)));
                    return false;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            }
        }
    }

    public function allocate_registration_payments()
    {
        if ($this->input->is_ajax_request() == 1) {
            $checked_temp_ids = filter_input(INPUT_POST, 'checked_temp_ids', FILTER_SANITIZE_STRING);
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_STRING);
            $this->load->helper('mailgun');
            $data_prep['checked_temp_ids'] = $checked_temp_ids;
            if ($flag != '') {
                $data_prep['flag'] = $flag; //For getting the failed payment details flag=3
            } else {
                $data_prep['flag'] = 0;
            }

            $status = $this->ONRegistration->get_all_temp_students_registration_fees($data_prep);

            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                $selected_class_fee_data = $status['data'];
                $payment_data = [];
                foreach ($selected_class_fee_data as $data) {
                    $email_message = $this->load->view('settings/email_template_registration_payment', $data, true);
                    if ($flag == 3) {
                        $subject = "Payment for Registration No. " . $data['TempAdmn_No'] . " against Failed Payment ";
                    } else {
                        $subject = "Payment for Registration No. " . $data['TempAdmn_No'];
                    }

                    $mailto = $data['L_mail'];
                    $mailcontent = $email_message;
                    //$cc = $this->get_cc_email($data['inst_id']);
                    $cc = '';
                    $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);
                    if ($email_res) {
                        $payment_data[] = $data;
                    }
                }
                if (sizeof($payment_data) > 0) {
                    if ($flag != '') {
                        $update_payment_data['TempReg_ID'] = $checked_temp_ids;
                        $update_payment_data['payment_amount'] = 0;
                        $update_payment_data['payment_status'] = 0;
                        $update_payment_data['payment_reference'] = '';
                        $update_payment_data['payment_data'] = '';
                        $json_string = json_encode($update_payment_data);
                        $this->ONRegistration->update_payment_allocation($json_string, 2); //For updating the Failed Payment
                    } else {
                        $json_string = json_encode($payment_data);
                        $this->ONRegistration->update_payment_allocation($json_string);
                    }
                }
                echo json_encode(array('status' => 1, 'message' => 'Loaded Successfully'));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $status['message']));
                    return false;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            }
        }
    }

    function show_payment_status()
    {
        if ($this->input->is_ajax_request() == 1) {

            $data['sub_title'] = 'Payment Status';
            $data['user_name'] = $this->session->userdata('user_name');
            //        CLASS DATA
            $class = $this->ONRegistration->get_all_class();
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
            $acdyr = $this->ONRegistration->get_all_acadyr();
            if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
                if ($acdyr['data_status'] == 1) {
                    $data['acdyr_data'] = $acdyr['data'];
                } else {
                    $data['acdyr_data'] = FALSE;
                }
            } else {
                $data['acdyr_data'] = FALSE;
            }

            $this->load->view('settings/show_payment_status', $data);
        }
    }

    public function get_payment_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $academic_year = filter_input(INPUT_POST, 'acd_yr', FILTER_SANITIZE_NUMBER_INT);
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);

            $data['class_id'] = $class_id;
            $data['acd_yr'] = $academic_year;
            $data['flag'] = $flag;
            $status = $this->ONRegistration->get_all_temp_students_registration_fees($data);

            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                $data['class_fee_data'] = $status['data'];
                echo json_encode(array('status' => 1, 'message' => 'Loaded Successfully', 'view' => $this->load->view('settings/partial_payment_status_view', $data, true)));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    $data['class_fee_data'] = [];
                    echo json_encode(array('status' => 1, 'message' => $status['message'], 'view' => $this->load->view('settings/partial_payment_status_view', $data, true)));
                    return false;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            }
        }
    }

    public function show_registration_dates()
    {
        $data['sub_title'] = 'Registration Dates';
        $data['user_name'] = $this->session->userdata('user_name');
        $reg_date_data = $this->ONRegistration->select_reg_date_data(2);

        if (isset($reg_date_data['error_status']) && $reg_date_data['error_status'] == 0) {
            if ($reg_date_data['data_status'] == 1) {
                $data['reg_date_data'] = $reg_date_data['data'];
            } else {
                $data['reg_date_data'] = [];
            }
        } else {
            $data['reg_date_data'] = [];
        }

        $this->load->view('settings/show_registration_dates', $data);
    }

    public function save_registration_date()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $registration_open = filter_input(INPUT_POST, 'registration_open', FILTER_SANITIZE_STRING);
            $registration_close = filter_input(INPUT_POST, 'registration_close', FILTER_SANITIZE_STRING);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);

            $data['inst_id'] = $this->session->userdata('inst_id');;
            $data['class_id'] = $class_id;
            $data['registration_open'] = $registration_open;
            $data['registration_close'] = $registration_close;
            $data['status'] = $status;
            $data['flag'] = $flag;
            $status_data = $this->ONRegistration->save_registration_date($data);

            if (isset($status_data['data_status']) && !empty($status_data['data_status']) && $status_data['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Loaded Successfully', 'view' => ''));
                return true;
            } else {
                if (isset($status_data['message']) && !empty($status_data['message'])) {
                    echo json_encode(array('status' => 0, 'message' => $status_data['message'], 'view' => ''));
                    return false;
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            }
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
    public function show_admission_settings()
    {
        $data['template']  = 'settings/show_admission_settings';
        $data['title']     = 'Admission Settings';
        $data['sub_title'] = 'Admission Settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Admission Management',
                'link' => base_url('registration/show-admission-settings')
            ),
            '2' => array(
                'title' => 'Admission Settings',
                'link' => base_url('registration/show-admission-settings')
            )
        );
        //          $breadcrmp = strtoupper(filter_input(INPUT_POST, 'breadcrmp', FILTER_SANITIZE_STRING));
        ////        dev_export($breadcrmp);die;
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);

        $this->load->view('template/home_template', $data);
    }
}
