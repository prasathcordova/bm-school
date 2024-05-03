<?php

/**
 * Description of Pay back_controller
 *
 * @author Aju S Aravind
 */
class Payback_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Payback_model', 'MPayback');
        $this->load->model('student_settings/Registration_model', 'MRegistration');
        $this->load->model('Nondemandfee_model', 'MNondemand_fee');
    }

    public function show_payback_list()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $payback_data = $this->MPayback->get_all_active_payback_data($inst_id, $acd_year_id);
            //            dev_export($payback_data);die;
            if (isset($payback_data['data']) && !empty($payback_data['data'])) {
                $data['payback_data'] = $payback_data['data'];
            } else {
                $data['payback_data'] = NULL;
            }
            $data['sub_title'] = 'PAYBACK MANAGEMENT';
            $this->load->view('payback/show_all_payback', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_student_filter_for_payback()
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


        $this->load->view('payback/student_filter', $data);
    }

    public function search_byname_for_payback()
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
            echo json_encode(array('status' => 1, 'view' => $this->load->view('payback/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function advancesearch_byname_for_payback()
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
            echo json_encode(array('status' => 1, 'view' => $this->load->view('payback/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function batchlist_for_payback()
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

    public function show_add_new_payback_request()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');

            $data['student_name'] = $student_name;
            $data['student_id'] = $student_id;
            $fee_voucher_data = $this->MPayback->get_voucher_data_for_payback($inst_id, $student_id);
            //            dev_export($fee_voucher_data);
            if (isset($fee_voucher_data['data']) && !empty($fee_voucher_data['data'])) {
                $data['fee_voucher_data'] = $fee_voucher_data['data'];
            } else {
                $data['fee_voucher_data'] = NULL;
            }
            //            dev_export($data);die;
            $data['sub_title'] = 'PAYBACK REQUEST - ( ' . $student_name . ' )';
            echo json_encode(array(
                'status' => 1,
                'view' => $this->load->view('payback/show_payback_request', $data, TRUE)
            ));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_fee_data_for_voucher_for_payback()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $fee_payment_id = filter_input(INPUT_POST, 'fee_payment_id', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $voucher_code = filter_input(INPUT_POST, 'voucher_code', FILTER_SANITIZE_STRING);
            $data['voucher_no'] = $voucher_code;
            $data['master_id'] = $fee_payment_id;
            $data['student_id'] = $student_id;

            $fee_data = $this->MPayback->get_voucher_detail_data_for_payback($inst_id, $fee_payment_id);
            // dev_export($fee_data);
            // die;
            if (isset($fee_data['data']) && !empty($fee_data['data'])) {
                $data['fee_data'] = $fee_data['data'];
                echo json_encode(array('status' => 1, 'view' => $this->load->view('payback/fee_data_view', $data, TRUE)));
            } else {
                $data['fee_data'] = NULL;
                echo json_encode(array('status' => 2, 'view' => FALSE));
            }
            return true;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_payback_request()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $master_id = filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $payback_data = filter_input(INPUT_POST, 'payback_data');
            $reason = filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING);
            $total_payback_amount = filter_input(INPUT_POST, 'total_payback_amount', FILTER_SANITIZE_STRING);

            $payback_request_status = $this->MPayback->save_payback_request_data(
                array(
                    'action' => 'save_payback_request',
                    'student_id' => $student_id,
                    'master_id' => $master_id,
                    'inst_id' => $inst_id,
                    'acd_year_id' => $acd_year_id,
                    'reason' => $reason,
                    'payback_data' => $payback_data,
                    'total_payback_amount' => $total_payback_amount
                )
            );
            if (isset($payback_request_status['data_status']) && !empty($payback_request_status['data_status']) && $payback_request_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Payback Requested Successfully'));
                return true;
            } else {
                if (isset($payback_request_status['message']) && !empty($payback_request_status['message'])) {
                    echo json_encode(array('data_status' => 2, 'message' => $payback_request_status['message']));
                    return true;
                } else {
                    echo json_encode(array('data_status' => 2, 'message' => 'An error encountered while placing payback request. For further assistance please contact administrator'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function show_payback_approval()
    {
        if ($this->input->is_ajax_request() == 1) {
            $master_id = filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $get_payback_data = $this->MPayback->get_payback_data($inst_id, $master_id);
            $data['master_id'] = $master_id;
            //dev_export($get_payback_data);
            //die;
            if (isset($get_payback_data['data'][0]) && !empty($get_payback_data['data'][0])) {
                $data['payback_data'] = $get_payback_data['data'][0];

                $data['payback_detail_data'] = $get_payback_data['detail_data'];
                $data['bank_details'] = $get_payback_data['bank_details'];
            } else {
                $data['payback_data'] = NULL;
            }
            //            dev_export($data);die;
            $data['sub_title'] = "PAYBACK APPROVAL";
            echo json_encode(array('status' => 1, 'view' => $this->load->view('payback/payback_approve', $data, TRUE)));
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_payback_approval()
    {
        if ($this->input->is_ajax_request() == 1) {
            $master_id = filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_STRING);
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $remarks = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);
            $approve_type = filter_input(INPUT_POST, 'approve_type', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $is_cheque = filter_input(INPUT_POST, 'is_cheque');
            if ($is_cheque == 1) {
                $cheque_number = filter_input(INPUT_POST, 'cheque_number', FILTER_SANITIZE_STRING);
                $cheque_date = filter_input(INPUT_POST, 'cheque_date', FILTER_SANITIZE_STRING);
                $issued_name = filter_input(INPUT_POST, 'issued_name', FILTER_SANITIZE_STRING);
                $bank_id = filter_input(INPUT_POST, 'bank_id');
            } else {
                $cheque_number = "";
                $cheque_date = "";
                $issued_name = "";
                $bank_id = "";
                $is_cheque = 0;
            }


            $data['student_id'] = $student_id;
            $data['student_name'] = $student_name;

            $data_to_save = array(
                'action' => 'save_payback_approval',
                'master_id' => $master_id,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'student_id' => $student_id,
                'approve_status' => $approve_type,
                'comments' => base64_decode($remarks),
                'is_cheque' => $is_cheque,
                'cheque_number' => $cheque_number,
                'cheque_date' => $cheque_date,
                'issued_name' => $issued_name,
                'bank_id' => $bank_id
            );

            $payback_status = $this->MPayback->save_approval_for_payback($data_to_save);
            // dev_export($payback_status);
            // die;

            if (isset($payback_status['data_status']) && !empty($payback_status['data_status']) && $payback_status['data_status'] == 1) {
                //echo json_encode(array('status' => 1, 'message' => 'Payback Approved / Rejected Successfully', 'wallet_voucher' => $payback_status['data']['VOUCHER_NUMBER'], 'wallet_voucher_id' => $payback_status['data']['VOUCHER_ID']));
                echo json_encode(array('status' => 1, 'message' => 'Payback Approved / Rejected Successfully', 'wallet_voucher' => $payback_status['data']['VOUCHER_NO'], 'wallet_voucher_id' => $payback_status['data']['VOUCHER_ID']));
                return true;
            } else {
                if (isset($payback_status['message']) && !empty($payback_status['message'])) {
                    echo json_encode(array('data_status' => 2, 'message' => $payback_status['message']));
                    return true;
                } else {
                    echo json_encode(array('data_status' => 2, 'message' => 'An error encountered while placing payback request. For further assistance please contact administrator'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function view_payback_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $master_id = filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $get_payback_data = $this->MPayback->get_payback_data_for_view($inst_id, $master_id);
            //dev_export($get_payback_data);die;
            $data['master_id'] = $master_id;
            if (isset($get_payback_data['data'][0]) && !empty($get_payback_data['data'][0])) {
                $data['payback_data'] = $get_payback_data['data'][0];

                $data['payback_detail_data'] = $get_payback_data['detail_data'];
            } else {
                $data['payback_data'] = NULL;
            }
            $data['sub_title'] = "PAYBACK VIEW";
            echo json_encode(array('status' => 1, 'view' => $this->load->view('payback/payback_view', $data, TRUE)));
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
