<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fees_collection_controller
 *
 * @author chandrajith.edsys
 */
class Fees_collection_controller extends MX_Controller
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
        $this->load->model('Fees_collection_model', 'MFee_collection');
        $this->load->model('Nondemandfee_model', 'MNondemand_fee');
        $this->load->model('student_settings/Registration_model', 'MRegistration');
        $this->load->model('online_registration/Online_registration_model', 'ONRegistration');
    }

    public function show_fees_student_exemption()
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

        $data['sub_title'] = 'Fee Exemption'; //Management
        $this->load->view('fee_exemption/student_filter', $data);
    }

    public function student_exemption()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_name = filter_input(INPUT_POST, 'studentname', FILTER_SANITIZE_STRING);
            $student_id = strtoupper(filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING));
            $feeid = strtoupper(filter_input(INPUT_POST, 'feeid', FILTER_SANITIZE_NUMBER_INT));

            $details_data = $this->MRegistration->get_profiles_student($student_id);
            if (isset($details_data['data'][0]) && !empty($details_data['data'][0])) {
                $data['student_data'] = $details_data['data'][0];

                //Get fee collection data for payment.
                $inst_id = $this->session->userdata('inst_id');
                $acd_year_id = $this->session->userdata('acd_year');

                $data_to_save = array(
                    'action'                => 'get_exemption_data_of_student',
                    'controller_function'   => 'Fees_settings/Fee_collection_controller/get_exemption_data_of_student',
                    'student_id'            => $student_id,
                    'inst_id'               => $inst_id,
                    'acd_year_id'           => $acd_year_id
                );

                $allocation_data_for_student = $this->MFee_collection->get_exemption_data_of_student($data_to_save);
                if (isset($allocation_data_for_student['data']) && !empty($allocation_data_for_student['data'])) {
                    $data['fee_data'] = $allocation_data_for_student['data'];
                    $data['transaction_ID'] = $allocation_data_for_student['data'][0]['transaction_ID'];
                } else {
                    $data['fee_data'] = 0;
                    $data['transaction_ID'] = 0;
                }
                // if (isset($allocation_data_for_student['term_as_month_data']) && !empty($allocation_data_for_student['term_as_month_data'])) {
                //     $data['term_as_month_data'] = $allocation_data_for_student['term_as_month_data'];
                //     foreach ($data['term_as_month_data'] as $tmd) {
                //         array_push($data['fee_data'], $tmd);
                //     }
                // } else {
                //     $data['term_as_month_data'] = 0;
                // }
                // asort($data['fee_data']);
                // dev_export($data['fee_data']);
                // die;
                //FEE TERM DATA MANAGE
                // if (isset($allocation_data_for_student['term_details']) && !empty($allocation_data_for_student['term_details'])) {
                //     $termarray = array();
                //     foreach ($allocation_data_for_student['term_details'] as $tdls) {

                //         $start    = (new DateTime($tdls['term_fromdate']))->modify('first day of this month');
                //         $end      = (new DateTime($tdls['term_todate']))->modify('first day of next month');
                //         $interval = DateInterval::createFromDateString('1 month');
                //         $period   = new DatePeriod($start, $interval, $end);

                //         $termarray[$tdls['Acd_Year']][$tdls['fee_id']][$tdls['term_id']]['term_name'] = $tdls['Term_Name'];
                //         foreach ($period as $dt) {
                //             // echo $dt->format("Y-m-d") . "<br>\n";
                //             $termarray[$tdls['Acd_Year']][$tdls['fee_id']][$tdls['term_id']]['terms'][] = $dt->format("Y-m-d");
                //         }
                //         // $termarray[$tdls['Acd_Year']][$tdls['fee_id']][$tdls['term_id']][] = $tdls;
                //     }
                //     $data['term_details'] = $termarray;
                // } else {
                //     $data['term_details'] = NULL;
                // }

                $feecodes_available = $this->MFee_collection->get_all_feecodes_available($inst_id);
                if (isset($feecodes_available['data']) && !empty($feecodes_available['data'])) {
                    $data['feecodes_available'] = $feecodes_available['data'];
                } else {
                    $data['feecodes_available'] = 0;
                }

                if (isset($allocation_data_for_student['is_black_list_data']) && !empty($allocation_data_for_student['is_black_list_data']) && $allocation_data_for_student['is_black_list_data'] == 1) {
                    $data['black_list_data'] = $allocation_data_for_student['black_list_data'];
                } else {
                    $data['black_list_data'] = 0;
                }

                if (isset($allocation_data_for_student['summary_data']) && !empty($allocation_data_for_student['summary_data'])) {
                    $data['fee_summary'] = $allocation_data_for_student['summary_data']['PENDING_PAYMENT'];
                    $data['e_wallet'] = $allocation_data_for_student['summary_data']['E_WALLET'];
                    $data['pending_vat'] = $allocation_data_for_student['summary_data']['PENDING_VAT'];
                } else {
                    $data['fee_summary'] = 0;
                    $data['e_wallet'] = 0;
                    $data['pending_vat'] = 0;
                }

                if (isset($allocation_data_for_student['card_service_charge']) && !empty($allocation_data_for_student['card_service_charge'])) {
                    $data['card_service_charge'] = $allocation_data_for_student['card_service_charge'];
                } else {
                    $data['card_service_charge'] = 0;
                }

                if (isset($allocation_data_for_student['bank_details']) && !empty($allocation_data_for_student['bank_details'])) {
                    $data['bank_details'] = $allocation_data_for_student['bank_details'];
                } else {
                    $data['bank_details'] = NULL;
                }
                $data['feeid_sel'] = $feeid;
                $data['demandedfeecodes'] = $allocation_data_for_student['demandedfeecodes'];
                $data['sub_title'] = 'Fees Exemption Management';
                echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_exemption/student_exemption', $data, TRUE)));
                return true;
            } else {

                $data['details_data'] = NULL;
                echo json_encode(array('status' => 2, 'message' => 'Student data is not available.'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_exemption_for_approval()
    {

        if ($this->input->is_ajax_request() == 1) {
            $student_id     = filter_input(INPUT_POST, 'studentid');
            $amount_paid    = filter_input(INPUT_POST, 'amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $exemption_data = filter_input(INPUT_POST, 'exemption_data');
            $reason_exempt  = filter_input(INPUT_POST, 'reason_exempt', FILTER_SANITIZE_STRING);
            $inst_id        = $this->session->userdata('inst_id');
            $acd_year_id    = $this->session->userdata('acd_year');
            $transaction_ID = filter_input(INPUT_POST, 'transaction_ID');

            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Student data is required.'));
                return TRUE;
            }

            if (!(isset($exemption_data) && !empty($exemption_data) && strlen($exemption_data) > 2 && is_array(json_decode($exemption_data, TRUE)))) { //&& $excess_amt < 0
                echo json_encode(array('status' => 2, 'message' => 'Amount allocation is incomplete. Please contact administrator for further assistance.'));
                return TRUE;
            }

            if (!(isset($amount_paid) && !empty($amount_paid))) {
                echo json_encode(array('status' => 2, 'message' => 'Amount paid is required.'));
                return TRUE;
            }
            if (!(isset($reason_exempt) && !empty($reason_exempt))) {
                echo json_encode(array('status' => 2, 'message' => 'Reason required'));
                return TRUE;
            }
            $total_voucher_amount = filter_input(INPUT_POST, 'total_voucher_amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if (!(isset($total_voucher_amount) && !empty($total_voucher_amount))) {
                echo json_encode(array('status' => 2, 'message' => 'Total amount is required.'));
                return TRUE;
            }
            $total_vat_amount_paid = filter_input(INPUT_POST, 'total_vat_amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            $flag = 1;
            $data_to_save = array(
                'action'                => 'save_exemption_for_approval',
                'controller_function'   => 'Fees_settings/Fee_collection_controller/save_exemption_for_approval',
                'student_id'            => $student_id,
                'amount_paid'           => $amount_paid,
                'exemption_data'        => $exemption_data,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id,
                'total_voucher_amount'  => $total_voucher_amount,
                'total_vat_amount_paid' => $total_vat_amount_paid,
                'reason_exempt'         => $reason_exempt,
                'transaction_ID'        => $transaction_ID
            );
            $pay_status = $this->MFee_collection->save_exemption_for_approval($data_to_save);

            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {
                //**SAVE EXEMPTION DATA TO WFM MIS FROM DOCME WITHOUT API */

                // $data_to_mis = $pay_status['data']['mis_data'];
                // if (isset($pay_status['data']['mis_data']) && !empty($pay_status['data']['mis_data'])) {
                //     $studarray = array(
                //         'Inst_ID' => $pay_status['data']['mis_data'][0]['Inst_ID'],
                //         'Applied_Date' => $pay_status['data']['mis_data'][0]['Applied_Date'],
                //         'admn_no' => $pay_status['data']['mis_data'][0]['admn_no'],
                //         'StudentName' => $pay_status['data']['mis_data'][0]['StudentName'],
                //         'Batch_Name' => $pay_status['data']['mis_data'][0]['Batch_Name'],
                //         'Class' => $pay_status['data']['mis_data'][0]['Class'],
                //         'EntryBy' => $pay_status['data']['mis_data'][0]['EntryBy']
                //     );
                //     $master_id = $pay_status['data']['mis_data'][0]['Exm_apl_id'];

                //     $data_to_save_WFM = array(
                //         'action'                => 'save_exemption_wfm_for_md_approval',
                //         'controller_function'   => 'Fees_settings/Fee_collection_controller/save_exemption_wfm_for_md_approval',
                //         'student_id'            => $student_id,
                //         'amount_paid'           => $amount_paid,
                //         'exemption_data'        => json_encode($data_to_mis),
                //         'studarray'             => json_encode($studarray),
                //         'inst_id'               => $inst_id,
                //         'acd_year_id'           => $acd_year_id,
                //         'reason_exempt'         => $reason_exempt,
                //         'master_id'             => $master_id
                //     );
                //     $pay_status = $this->MFee_collection->save_exemption_wfm_for_md_approval($data_to_save_WFM);
                // }

                //**SAVE EXEMPTION DATA TO WFM MIS FROM DOCME WITHOUT API  */

                //** *///API START     
                // $data_to_mis = $pay_status['data']['mis_data'];
                // $apikey = base64_encode('DOCME-FEE-EXEMPTION-' . date('Ymd'));
                // $raw_data_to_mis = json_encode($data_to_mis);
                // $response = transport_data_to_mis($raw_data_to_mis, $apikey);

                // //SAve MIS Response
                // $response_data = array(
                //     'action'                => 'save_mis_response',
                //     'controller_function'   => 'Fees_settings/Fee_collection_controller/save_mis_response',
                //     'inst_id'               => $inst_id,
                //     'acd_year_id'           => $acd_year_id,
                //     'transaction_type'      => 'FEE EXEMPTION',
                //     'student_id'            => $student_id,
                //     'response'              => json_encode($response),
                //     'data_to_mis'           => $raw_data_to_mis
                // );
                // $save_respone = $this->MFee_collection->save_mis_response($response_data);
                // if (isset($response) && $save_respone == 1) echo json_encode(array('status' => 1));
                // else echo json_encode(array('status' => 1));
                //** *///API END   
                echo json_encode(array('status' => 1));
                return true;
            } else {
                if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 5) {
                    echo json_encode(array('status' => 5, 'message' => 'There is a change in fee data.Please initiate the transaction once again after verifing the fee details.'));
                    return true;
                } else {
                    if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                        return true;
                    }
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function show_exemption_approvals()
    {
        $inst_id = $this->session->userdata('inst_id');
        $acd_year_id = $this->session->userdata('acd_year');

        $data_array = array(
            'action'                => 'get_exemption_requests',
            'controller_function'   => 'Fees_settings/Fee_collection_controller/get_exemption_requests',
            'inst_id'               => $inst_id,
            'acd_year_id'           => $acd_year_id
        );

        $exemptions_requests = $this->MFee_collection->get_exemption_requests($data_array);
        // dev_export($exemptions_requests);
        // die;
        if (isset($exemptions_requests['data']) && !empty($exemptions_requests['data'])) {
            $data['exemptions_requests'] = $exemptions_requests['data'];
        } else {
            $data['exemptions_requests'] = 0;
        }

        $data['sub_title'] = 'Fee Exemption - Approvals';
        $this->load->view('fee_exemption/show_exemption_approvals', $data);
    }

    public function view_exemption_details()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        $inst_id = $this->session->userdata('inst_id');
        $acd_year_id = $this->session->userdata('acd_year');
        if ($this->input->is_ajax_request() == 1) {
            $exmp_id = filter_input(INPUT_POST, 'exmp_id', FILTER_SANITIZE_NUMBER_INT);
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status');
            $studdata = filter_input(INPUT_POST, 'studdata');
            $data_array = array(
                'action'                => 'get_exemption_details',
                'controller_function'   => 'Fees_settings/Fee_collection_controller/get_exemption_details',
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id,
                'exemp_id'              => $exmp_id
            );
            $data['student_id'] = $student_id;
            $data['master_id']  = $exmp_id;
            $data['status'] = $status;
            $data['studdata'] = $studdata;
            $details_data = $this->MFee_collection->get_exemption_details($data_array);
            //dev_export($details_data);die;
            if ($details_data['status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['user_name'] = $this->session->userdata('user_name');
            echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_exemption/view_exemption_details', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function approve_exemption()
    {
        if ($this->input->is_ajax_request() == 1) {
            $master_id     = filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_NUMBER_INT);
            $pay_data     = filter_input(INPUT_POST, 'pay_data');
            $md_comment  = filter_input(INPUT_POST, 'md_comment', FILTER_SANITIZE_STRING);
            $approve     = filter_input(INPUT_POST, 'approve', FILTER_SANITIZE_NUMBER_INT);
            $student_id     = filter_input(INPUT_POST, 'student_id');
            $inst_id        = $this->session->userdata('inst_id');
            $acd_year_id    = $this->session->userdata('acd_year');

            $data_to_db = array(
                'action'                => 'approve_exemption',
                'controller_function'   => 'Fees_settings/Fee_collection_controller/approve_exemption',
                'student_id'            => $student_id,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id,
                'master_id'             => $master_id,
                'pay_data'              => $pay_data,
                'md_comment'            => $md_comment,
                'approve'               => $approve
            );

            $pay_status = $this->MFee_collection->approve_exemption($data_to_db);
            // dev_export($pay_status);
            // die;
            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'voucher_no' => $pay_status['data']['VOUCHER_NO'], 'voucher_id' => $pay_status['data']['VOUCHER_ID']));
                return true;
            } else {
                if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function reject_exemption()
    {
        if ($this->input->is_ajax_request() == 1) {
            $master_id      = filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_NUMBER_INT);
            $remarks        = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);
            $student_id     = filter_input(INPUT_POST, 'studentid');
            $inst_id        = $this->session->userdata('inst_id');
            $acd_year_id    = $this->session->userdata('acd_year');

            $data_to_db = array(
                'action'                => 'reject_exemption',
                'controller_function'   => 'Fees_settings/Fee_collection_controller/reject_exemption',
                'student_id'            => $student_id,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id,
                'master_id'             => $master_id,
                'remarks'               => $remarks
            );
            $pay_status = $this->MFee_collection->approve_exemption($data_to_db);
            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {
                echo json_encode(array('status' => 1));
                return true;
            } else {
                if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    /*
     * Fee collection functionality is starting fromm here. Remove the codes above once functionality is finished
     */

    /*
     * Getting student filter for the student fee collection
     * @Auther : Aju S Aravind
     */

    public function get_student_filter_for_collection()
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

        $data['sub_title'] = 'Fee Collection'; //Management
        $this->load->view('fee_collection/student_filter', $data);
    }

    public function search_byname()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            $from = filter_input(INPUT_POST, 'from', FILTER_SANITIZE_STRING);

            //View selection
            if ($from == 'fee_exemption') {
                $viewfolder = 'fee_exemption';
            } else if ($from == 'fee_deallocation') {
                $viewfolder = 'fee_deallocation';
            } else {
                $viewfolder = 'fee_collection';
            }

            $details_data = $this->MNondemand_fee->student_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['user_name'] = $this->session->userdata('user_name');
            $data['searchby'] = 'search_name';
            $data['search_elements'] = array('admn_no' => $data_prep['admn_no']);
            echo json_encode(array('status' => 1, 'view' => $this->load->view($viewfolder . '/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function advancesearch_byname()
    {                                               //display students list on search
        $data['title'] = 'STUDENTS LIST';
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $data_prep['batch_id'] = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['stream_id'] = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['class_id'] = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['curent_acdyr'] = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['searchname'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));

            $from = filter_input(INPUT_POST, 'from', FILTER_SANITIZE_STRING);
            //View selection
            if ($from == 'fee_exemption') {
                $viewfolder = 'fee_exemption';
            } else if ($from == 'fee_deallocation') {
                $viewfolder = 'fee_deallocation';
            } else {
                $viewfolder = 'fee_collection';
            }

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
            $data['searchby'] = 'searchadvance_filtername';
            $data['search_elements'] = array('stream_id' => $data_prep['stream_id'], 'batch_id' => $data_prep['batch_id'], 'class_id' => $data_prep['class_id'], 'curent_acdyr' => $data_prep['curent_acdyr'], 'searchname' => $data_prep['searchname']);
            echo json_encode(array('status' => 1, 'view' => $this->load->view($viewfolder . '/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function batchlist()
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

    public function show_fee_student_collection()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_name = filter_input(INPUT_POST, 'studentname', FILTER_SANITIZE_STRING);
            $searchby = filter_input(INPUT_POST, 'searchby');
            $search_elements = json_decode(filter_input(INPUT_POST, 'search_elements'), true);

            $pay_type = filter_input(INPUT_POST, 'pay_type');
            $reference_date = filter_input(INPUT_POST, 'reference_date');
            $reference_number = filter_input(INPUT_POST, 'reference_number');
            $amount_distributed = filter_input(INPUT_POST, 'amount_distributed');
            $transaction_ID = filter_input(INPUT_POST, 'transaction_ID');

            $penalty_date = date('Y-m-d');
            if ($pay_type == 'dbt') $penalty_date = $reference_date;

            $student_id = strtoupper(filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING));

            $details_data = $this->MRegistration->get_profiles_student($student_id);
            if (isset($details_data['data'][0]) && !empty($details_data['data'][0])) {

                $sibilings_data = $this->MRegistration->get_sibilings_student($student_id);
                if ($sibilings_data['error_status'] == 0 && $sibilings_data['data_status'] == 1) {
                    $data['sibilings_data'] = $sibilings_data['data'];
                    $data['message'] = "";
                } else {
                    $data['sibilings_data'] = FALSE;
                    $data['message'] = $sibilings_data['message'];
                }
                // dev_export($sibilings_data);
                // die;

                $data['student_data'] = $details_data['data'][0];

                //Get fee collection data for payment.
                $inst_id = $this->session->userdata('inst_id');
                $acd_year_id = $this->session->userdata('acd_year');
                $data['acd_year'] = $acd_year_id;

                $allocation_data_for_student = $this->MFee_collection->get_collection_data_by_student($student_id, $inst_id, $acd_year_id, $penalty_date);
                // dev_export($allocation_data_for_student);
                // die;
                if (isset($allocation_data_for_student['data']) && !empty($allocation_data_for_student['data'])) {
                    $data['fee_data'] = $allocation_data_for_student['data'];
                    $data['transaction_ID'] = $allocation_data_for_student['data'][0]['transaction_ID'];
                    // $data['CUR_TRANS_ID'] = $allocation_data_for_student['data'][0]['CUR_TRANS_ID'];
                    // $data['STUDENT_OPEN'] = $allocation_data_for_student['data'][0]['STUDENT_OPEN'];
                } else {
                    $data['fee_data'] = 0;
                    $data['transaction_ID'] = 0;
                }

                //FEE TERM DATA MANAGE
                if (isset($allocation_data_for_student['term_details']) && !empty($allocation_data_for_student['term_details'])) {
                    $termarray = array();
                    foreach ($allocation_data_for_student['term_details'] as $tdls) {

                        $start    = (new DateTime($tdls['term_fromdate']))->modify('first day of this month');
                        $end      = (new DateTime($tdls['term_todate']))->modify('first day of next month');
                        $interval = DateInterval::createFromDateString('1 month');
                        $period   = new DatePeriod($start, $interval, $end);

                        $termarray[$tdls['Acd_Year']][$tdls['fee_id']][$tdls['term_id']]['term_name'] = $tdls['Term_Name'];
                        foreach ($period as $dt) {
                            // echo $dt->format("Y-m-d") . "<br>\n";
                            $termarray[$tdls['Acd_Year']][$tdls['fee_id']][$tdls['term_id']]['terms'][] = $dt->format("Y-m-d");
                        }
                        // $termarray[$tdls['Acd_Year']][$tdls['fee_id']][$tdls['term_id']][] = $tdls;
                    }
                    $data['term_details'] = $termarray;
                } else {
                    $data['term_details'] = NULL;
                }
                // dev_export($termarray);
                // die;

                //PENALTY MANAGE
                if (isset($allocation_data_for_student['penalty_details']) && !empty($allocation_data_for_student['penalty_details'])) {
                    $data['penalty_details'] = $allocation_data_for_student['penalty_details'];
                    // dev_export($allocation_data_for_student['penalty_details']);
                    // die;
                    $penaltyarray = array();
                    foreach ($allocation_data_for_student['penalty_details'] as $pdls) {
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
                // dev_export($allocation_data_for_student['data']);
                // die;
                /** */

                $totalpenalty = 0;
                $penalty_check_array = array();
                foreach ($allocation_data_for_student['data'] as $demand) {
                    $penalty = 0;
                    if (!isset($penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']])) {
                        //added this condition for is there penalty details added for this feecode - NOV 06, 2019
                        if (isset($penaltyarray) && !empty($penaltyarray) && isset($penaltyarray[$demand['FEEID']])) {
                            //dev_export($penaltyarray);
                            $currentdate = date_create(date('d-m-Y'));
                            if ($pay_type == 'dbt') $currentdate = date_create(date('d-m-Y', strtotime($reference_date)));

                            $demanddate = date_create(date('d-m-Y', strtotime($demand['ARREAR_DATE'])));
                            $effect_date = date_create(date('d-m-Y', strtotime($penaltyarray[$demand['FEEID']]['effectdate'])));
                            $interval = date_diff($currentdate, $demanddate);
                            $days = $interval->format('%R%a');
                            //echo $days;
                            $days_difference = abs($days); //FEEID
                            $symbol = substr($days, 0, 1);
                            if ($symbol == '+' && $days_difference != 0) {
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
                                // $penalty = (($penalty - $demand['NON_RECONCILED_PENALTY']) > 0 ? ($penalty - $demand['NON_RECONCILED_PENALTY']) : 0);
                                $penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']] = $demand['FEEID'];
                                if (($demand['TRANSACTION_AMOUNT'] - $demand['EXEMPTION_PENDING_AMOUNT']) <= 0) {
                                    $penalty = 0;
                                }
                            }
                        } else {
                            $penalty = 0;
                        }
                    }
                    $total_pending =  $demand['TRANSACTION_AMOUNT'] - ($demand['TOTAL_PAID_AMOUNT'] + $demand['CONCESSION_AMOUNT'] + $demand['EXEMPTION_AMOUNT'] + $demand['EXEMPTION_PENDING_AMOUNT']);
                    // $total_pending =  $demand['PENDING_PAYMENT'] - ($demand['TOTAL_PAID_AMOUNT'] + $demand['CONCESSION_AMOUNT'] + $demand['EXEMPTION_AMOUNT'] + $demand['EXEMPTION_PENDING_AMOUNT']);
                    // $penalty = ($demand['PENDING_PAYMENT'] > 0 ? $penalty : 0);
                    $penalty = ($total_pending > 0 ? $penalty : 0);
                    // $penalty = ($total_pending > $demand['EXEMPTION_PENDING_AMOUNT'] ? $penalty : 0);
                    $totalpenalty += $penalty;
                    // dev_export($total_pending);
                    // die;
                }
                $data['total_penalty'] = $totalpenalty;
                // dev_export($total_pending);
                // die;
                /** */
                //PENALTY MANAGE

                if (isset($allocation_data_for_student['is_black_list_data']) && !empty($allocation_data_for_student['is_black_list_data']) && $allocation_data_for_student['is_black_list_data'] == 1) {
                    $data['black_list_data'] = $allocation_data_for_student['black_list_data'];
                } else {
                    $data['black_list_data'] = 0;
                }

                if (isset($allocation_data_for_student['summary_data']) && !empty($allocation_data_for_student['summary_data'])) {
                    $data['fee_summary'] = ($allocation_data_for_student['summary_data']['PENDING_PAYMENT'] + $totalpenalty);
                    $data['e_wallet'] = $allocation_data_for_student['summary_data']['E_WALLET'];
                    $data['wallet_withdraw_request_amount'] = $allocation_data_for_student['summary_data']['WALLET_WITHDRAW_REQUEST_AMOUNT'];
                } else {
                    $data['fee_summary'] = 0;
                    $data['e_wallet'] = 0;
                }

                if (isset($allocation_data_for_student['card_service_charge']) && !empty($allocation_data_for_student['card_service_charge'])) {
                    $data['card_service_charge'] = $allocation_data_for_student['card_service_charge'];
                } else {
                    $data['card_service_charge'] = 0;
                }

                if (isset($allocation_data_for_student['bank_details']) && !empty($allocation_data_for_student['bank_details'])) {
                    $data['bank_details'] = $allocation_data_for_student['bank_details'];
                } else {
                    $data['bank_details'] = NULL;
                }

                // dev_export($transaction_ID);
                // die;
                $data['searchby'] = $searchby;

                $data['search_elements'] = $search_elements;
                $data['sub_title'] = 'Fees Collection Management';

                //amount_distributed reference_number
                // if ($transaction_ID == $data['CUR_TRANS_ID']) {
                //     if ($pay_type == 'dbt') {
                //         $data['amount_distributed'] = $amount_distributed;
                //         $data['reference_number']   = $reference_number;
                //         $data['reference_date']     = $reference_date;
                //         echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_collection/dbt_collection', $data, TRUE)));
                //     } else {
                //         $data['amount_distributed'] = 0;
                //         $data['reference_number']   = 0;
                //         echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_collection/student_collection', $data, TRUE)));
                //     }
                // } else if ($data['STUDENT_OPEN'] == 0) {
                //     $data['details_data'] = NULL;
                //     echo json_encode(array('status' => 2, 'message' => 'Similar action has been performed for this student in another machine. Access Denied'));
                //     return true;
                // }
                // if ($transaction_ID > 0) {
                //     $data['details_data'] = NULL;
                //     echo json_encode(array('status' => 2, 'message' => 'Similar action has been performed for this student in another machine. Access Denied'));
                //     return true;
                // }
                if ($pay_type == 'dbt') {
                    $data['amount_distributed'] = $amount_distributed;
                    $data['reference_number']   = $reference_number;
                    $data['reference_date']     = $reference_date;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_collection/dbt_collection', $data, TRUE)));
                } else {
                    $data['amount_distributed'] = 0;
                    $data['reference_number']   = 0;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_collection/student_collection', $data, TRUE)));
                }
                return true;
            } else {

                $data['details_data'] = NULL;
                echo json_encode(array('status' => 2, 'message' => 'Student data is not available.'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    //MOCKING PAYMENT FROM ONLINE FAILED
    public function show_collection_failed_payment()
    {
        if ($this->input->is_ajax_request() == 1) {
            //Get fee collection data for payment.
            $inst_id = $this->session->userdata('inst_id');
            $data['sub_title'] = 'Collect Online Failed Payments';
            $this->load->view('fee_collection/collection_failed_payment', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function make_failed_payment()
    {
        $json_string    = filter_input(INPUT_POST, 'json_string');
        $acd_year_id    = $this->session->userdata('acd_year');
        $inst_id        = $this->session->userdata('inst_id');

        $jsonarray = json_decode($json_string, TRUE);
        $student_id = $jsonarray['udf9'];
        $student_personal_details = $this->Mstudent->get_ind_student_details($student_id);

        $customer_name = $jsonarray['udf1'];
        $customer_email = $jsonarray['udf2'];
        $customer_mobnum = $jsonarray['udf3'];
        $transaction_date = date('Y-m-d H:i:s', strtotime($jsonarray['date']));
        $fee_id = $jsonarray['udf4'];
        $student_id = $jsonarray['udf9'];
        $admission_no = $jsonarray['udf6'];
        $merchantdata = $jsonarray['udf5'];
        $Transaction_status = $jsonarray['f_code'];
        $Transaction_amount = $jsonarray['amt'];
        $Transaction_surcharge = $jsonarray['surcharge'];
        $atom_transaction_id = $jsonarray['mmp_txn'];
        $merchant_transaction_id = $jsonarray['mer_txn'];
        $merchantid = $jsonarray['merchant_id'];
        $bank_name = $jsonarray['bank_name'];
        $bank_transactionid = $jsonarray['bank_txn'];
        $payment_channel = $jsonarray['discriminator'];
        $cardnumber = $jsonarray['CardNumber'];
        $product = $jsonarray['prod'];
        $clientcode = $jsonarray['clientcode'];
        $signature = $jsonarray['signature'];
        $surcharge = $jsonarray['surcharge'];

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

            $data['transaction_details_data'] = $atom_return_details;
            $data['student_data'] = (isset($student_personal_details['data'][0]) && !empty($student_personal_details['data'][0])) ? $student_personal_details['data'][0] : NULL;
            $mesg = $this->load->view('parent_login/payment_status_notification_atom_view', $data, true);
            if ($Transaction_status == 'Ok') {
                $subject = 'Fee Payment Successful : ' . $data['transaction_details_data']['customer_name'] . '-' . $data['transaction_details_data']['admissionNumber'];
                //$email_res = sendgrid_mailer($subject, $mailto, $mesg, $cc = '');
                $email_res = send_smtp_mailer($subject, $mailto, $mesg, $cc = '');
                $email_message = "Payment received in fees ,Details are as follows<br/><br/>";
                $email_message .= "Payment Amount : " . $Transaction_amount . " <br/>";
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

                $email_message = "Payment failed in fees ,Details are as follows<br/><br/>";
                $email_message .= "Payment Amount : " . $Transaction_amount . " <br/>";
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
            $email_message = "Payment processing failed in fees ,Details are as follows<br/><br/>";
            $email_message .= "JSON DATA : " . json_encode($_POST) . " <br/>";

            $subject = "Payment processing failed in fees";
            $mailto_sp = $this->get_support_email($inst_id);
            $mailcontent = $email_message;
            $cc = '';
            $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc);
            redirect(base_url() . 'fee/payment-failed');
            return;
        }
    }
    //REGISTRATION / PROSPECTUS FEE
    public function registration_fee()
    {
        if ($this->input->is_ajax_request() == 1) {
            //Get fee collection data for payment.
            $inst_id = $this->session->userdata('inst_id');
            $data_to_get = array(
                'action'                => 'get_systemparameter_data',
                'controller_function'   => 'Fees_settings/Fee_collection_controller/get_systemparameter_data',
                'inst_id'               => $inst_id
            );

            $system_parameter_data = $this->MFee_collection->get_systemparameter_data($data_to_get);
            //dev_export($system_parameter_data['data']);
            $is_card_service_charge = 0;
            $card_service_charge = 0;
            foreach ($system_parameter_data['data'] as $value) {
                if ($value['Code'] == 'IS_CARD_SERVICE_CHARGE') {
                    $is_card_service_charge = $value['Code_Value'];
                }
                if ($value['Code'] == 'CARD_SERVICE_CHARGE') {
                    $card_service_charge = $value['Code_Value'];
                }
            }
            if ($is_card_service_charge == 0) {
                $card_service_charge = 0;
            }
            $data['card_service_charge'] = $card_service_charge;
            $data['sub_title'] = 'Prospectus Fee';
            $this->load->view('fee_collection/registration_fee', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function pay_registration_fee()
    {

        if ($this->input->is_ajax_request() == 1) {
            $amount_paid    = filter_input(INPUT_POST, 'amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $service_charge    = filter_input(INPUT_POST, 'service_charge', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $student_name   = filter_input(INPUT_POST, 'student_name');
            $parent_name   = filter_input(INPUT_POST, 'parent_name');
            $address   = filter_input(INPUT_POST, 'address');
            $phone_number   = filter_input(INPUT_POST, 'phone_number');
            $trantype   = filter_input(INPUT_POST, 'trantype');
            //$fee_id   = filter_input(INPUT_POST, 'fee_id');
            $card_number   = filter_input(INPUT_POST, 'card_number');
            $card_name   = filter_input(INPUT_POST, 'card_name');

            $inst_id        = $this->session->userdata('inst_id');
            $acd_year_id    = $this->session->userdata('acd_year');

            if (!(isset($student_name) && !empty($student_name))) {
                echo json_encode(array('status' => 2, 'message' => 'Student Name required'));
                return TRUE;
            }
            if (!(isset($parent_name) && !empty($parent_name))) {
                echo json_encode(array('status' => 2, 'message' => 'Parent Name required'));
                return TRUE;
            }
            if (!(isset($phone_number) && !empty($phone_number))) {
                echo json_encode(array('status' => 2, 'message' => 'Phone Number required'));
                return TRUE;
            }

            if (!(isset($amount_paid) && !empty($amount_paid))) {
                echo json_encode(array('status' => 2, 'message' => 'Amount paid is required.'));
                return TRUE;
            }
            $flag = 1;
            $data_to_save = array(
                'action'                => 'pay_registration_fee',
                'controller_function'   => 'Fees_settings/Fee_collection_controller/pay_registration_fee',
                'amount_paid'           => $amount_paid,
                'service_charge'        => $service_charge,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id,
                'mode_of_payment'       => $trantype,
                'student_name'          => $student_name,
                'parent_name'           => $parent_name,
                'address'               => $address,
                'phone_number'          => $phone_number,
                //'fee_id'                => $fee_id,
                'card_number'           => $card_number,
                'card_name'             => $card_name
            );

            $pay_status = $this->MFee_collection->pay_registration_fee($data_to_save);
            $flag = 2;

            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'voucher_no' => $pay_status['data']['VOUCHER_NO'], 'voucher_id' => $pay_status['data']['VOUCHER_ID']));
                return true;
            } else {
                if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 5) {
                    echo json_encode(array('status' => 5, 'message' => 'There is a change in fee data.Please initiate the transaction once again after verifing the fee details.'));
                    return true;
                } else {
                    if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                        return true;
                    }
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    //Temp Registration Fee

    public function temp_registration_fee()
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


            $data['sub_title'] = 'Registration Fee';
            $this->load->view('fee_collection/temp_registration_fee', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function temp_reg_fee_payment_methods()
    {
        if ($this->input->is_ajax_request() == 1) {
            //Get fee collection data for payment.
            $inst_id = $this->session->userdata('inst_id');
            $temp_reg_id = filter_input(INPUT_POST, 'temp_reg_id');
            $temp_student_name = filter_input(INPUT_POST, 'temp_student_name');
            $temp_parent_name = filter_input(INPUT_POST, 'temp_parent_name');
            $temp_reg_fee = filter_input(INPUT_POST, 'temp_reg_fee');
            $class_id = filter_input(INPUT_POST, 'class_id');
            $data_to_get = array(
                'action'                => 'get_systemparameter_data',
                'controller_function'   => 'Fees_settings/Fee_collection_controller/get_systemparameter_data',
                'inst_id'               => $inst_id
            );

            $system_parameter_data = $this->MFee_collection->get_systemparameter_data($data_to_get);
            //dev_export($system_parameter_data['data']);
            $is_card_service_charge = 0;
            $card_service_charge = 0;
            foreach ($system_parameter_data['data'] as $value) {
                if ($value['Code'] == 'IS_CARD_SERVICE_CHARGE') {
                    $is_card_service_charge = $value['Code_Value'];
                }
                if ($value['Code'] == 'CARD_SERVICE_CHARGE') {
                    $card_service_charge = $value['Code_Value'];
                }
            }
            if ($is_card_service_charge == 0) {
                $card_service_charge = 0;
            }
            $data['temp_reg_id'] = $temp_reg_id;
            $data['temp_student_name'] = $temp_student_name;
            $data['temp_parent_name'] = $temp_parent_name;
            $data['temp_reg_fee'] = $temp_reg_fee;
            $data['class_id'] = $class_id;
            $data['card_service_charge'] = $card_service_charge;
            $data['sub_title'] = 'Pay Registration Fee';
            echo json_encode(array('status' => 1, 'message' => 'Loaded Successfully', 'view' => $this->load->view('fee_collection/temp_reg_fee_payment_methods', $data, true)));
            return true;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function get_temp_payment_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $academic_year = filter_input(INPUT_POST, 'acd_yr', FILTER_SANITIZE_NUMBER_INT);
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);

            $data['class_id'] = $class_id;
            $data['acd_yr'] = $academic_year;
            $data['flag'] = $flag;
            $data['payment_status'] = '0,2';
            $status = $this->ONRegistration->get_all_temp_students_registration_fees($data);
            $data['class_id'] = $class_id;

            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                $data['class_fee_data'] = $status['data'];
                echo json_encode(array('status' => 1, 'message' => 'Loaded Successfully', 'view' => $this->load->view('fee_collection/partial_payment_status_view', $data, true)));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    $data['class_fee_data'] = [];
                    echo json_encode(array('status' => 1, 'message' => $status['message'], 'view' => $this->load->view('fee_collection/partial_payment_status_view', $data, true)));
                    return false;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            }
        }
    }
    public function pay_temp_registration_fee()
    {

        if ($this->input->is_ajax_request() == 1) {
            $amount_paid    = filter_input(INPUT_POST, 'amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $service_charge    = filter_input(INPUT_POST, 'service_charge', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $temp_reg_id   = filter_input(INPUT_POST, 'temp_reg_id');
            $trantype   = filter_input(INPUT_POST, 'trantype');
            //$fee_id   = filter_input(INPUT_POST, 'fee_id');
            $card_number   = filter_input(INPUT_POST, 'card_number');
            $card_name   = filter_input(INPUT_POST, 'card_name');

            $inst_id        = $this->session->userdata('inst_id');
            $acd_year_id    = $this->session->userdata('acd_year');

            $referenceDate = filter_input(INPUT_POST, 'referenceDate', FILTER_SANITIZE_STRING);
            if (!(isset($referenceDate) && !empty($referenceDate)) && $trantype == 'D') {
                echo json_encode(array('status' => 2, 'message' => 'Payment Date is required.'));
                return TRUE;
            }
            $reference_number = filter_input(INPUT_POST, 'reference_number', FILTER_SANITIZE_STRING);
            if (!(isset($reference_number) && !empty($reference_number)) && $trantype == 'D') {
                echo json_encode(array('status' => 2, 'message' => 'Reference No. is required.'));
                return TRUE;
            }

            // if (!(isset($student_name) && !empty($student_name))) {
            //     echo json_encode(array('status' => 2, 'message' => 'Student Name required'));
            //     return TRUE;
            // }
            // if (!(isset($parent_name) && !empty($parent_name))) {
            //     echo json_encode(array('status' => 2, 'message' => 'Parent Name required'));
            //     return TRUE;
            // }
            // if (!(isset($phone_number) && !empty($phone_number))) {
            //     echo json_encode(array('status' => 2, 'message' => 'Phone Number required'));
            //     return TRUE;
            // }

            if (!(isset($amount_paid) && !empty($amount_paid))) {
                echo json_encode(array('status' => 2, 'message' => 'Amount paid is required.'));
                return TRUE;
            }
            $flag = 1;
            $data_to_save = array(
                'action'                => 'pay_temp_registration_fee',
                'controller_function'   => 'Fees_settings/Fee_collection_controller/pay_temp_registration_fee',
                'amount_paid'           => $amount_paid,
                'service_charge'        => $service_charge,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id,
                'mode_of_payment'       => $trantype,
                'temp_reg_id'           => $temp_reg_id,
                //'fee_id'                => $fee_id,
                'card_number'           => $card_number,
                'card_name'             => $card_name,
                'referenceDate'         => $referenceDate,
                'reference_number'      => $reference_number
            );

            $pay_status = $this->MFee_collection->pay_temp_registration_fee($data_to_save);
            $flag = 2;

            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'voucher_no' => $pay_status['data']['VOUCHER_NO'], 'voucher_id' => $pay_status['data']['VOUCHER_ID']));
                return true;
            } else {
                if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 5) {
                    echo json_encode(array('status' => 5, 'message' => 'There is a change in fee data.Please initiate the transaction once again after verifing the fee details.'));
                    return true;
                } else {
                    if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'There is an error occured11. Please try again later'));
                        return true;
                    }
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    //FEE PAYMENT METHODS
    public function save_cash_payment_for_fee()
    {

        if ($this->input->is_ajax_request() == 1) {
            $student_id     = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $amount_paid    = filter_input(INPUT_POST, 'amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $payment_data   = filter_input(INPUT_POST, 'pay_data');
            $round_off    = filter_input(INPUT_POST, 'round_off', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $total_penalty    = filter_input(INPUT_POST, 'total_penalty', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $inst_id        = $this->session->userdata('inst_id');
            $acd_year_id    = $this->session->userdata('acd_year');
            $transaction_ID   = filter_input(INPUT_POST, 'transaction_ID');

            $excess_amt = filter_input(INPUT_POST, 'excess_amt', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if ($excess_amt == 0) {
                $excess_amt = -1;
            }

            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Student data is required.'));
                return TRUE;
            }

            if (!(isset($amount_paid) && !empty($amount_paid))) {
                echo json_encode(array('status' => 2, 'message' => 'Amount paid is required.'));
                return TRUE;
            }

            if (!(isset($payment_data) && !empty($payment_data) && strlen($payment_data) > 2 && is_array(json_decode($payment_data, TRUE))) && $excess_amt < 0) {
                echo json_encode(array('status' => 2, 'message' => 'Amount allocation is incomplete. Please contact administrator for further assistance.'));
                return TRUE;
            }

            $total_voucher_amount = filter_input(INPUT_POST, 'total_voucher_amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if (!(isset($total_voucher_amount) && !empty($total_voucher_amount)) && $excess_amt < 0) {
                echo json_encode(array('status' => 2, 'message' => 'Total amount is required.'));
                return TRUE;
            }

            $total_vat_amount_paid = filter_input(INPUT_POST, 'total_vat_amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $is_excess = filter_input(INPUT_POST, 'is_excess', FILTER_SANITIZE_NUMBER_INT);
            if ($is_excess == 2) {
                $is_excess = -1;
            }
            $flag = 1;
            if ($excess_amt > 0 && (is_array(json_decode($payment_data, TRUE))) && count(json_decode($payment_data, TRUE)) == 0) {
                $data_to_save = array(
                    'action'        => 'save_wallet_amount_for_student',
                    'inst_id'       => $inst_id,
                    'acd_year_id'   => $acd_year_id,
                    'student_id'    => $student_id,
                    'excess_amt'    => $excess_amt,
                    'excess_type'   => 2
                );
                $pay_status = $this->MFee_collection->save_ewallet_credit_transaction($data_to_save);
                $flag = 3;
            } else {
                $data_to_save = array(
                    'action'                => 'save_fee_payment_for_student',
                    'student_id'            => $student_id,
                    'amount_paid'           => $amount_paid,
                    'round_off'             => $round_off,
                    'total_penalty'         => $total_penalty,
                    'payment_data'          => $payment_data,
                    'inst_id'               => $inst_id,
                    'acd_year_id'           => $acd_year_id,
                    'mode_of_payment'       => 'C',
                    'service_charge'        => -1,
                    'total_voucher_amount'  => $total_voucher_amount,
                    'total_vat_amount_paid' => $total_vat_amount_paid,
                    'is_excess'             => $is_excess,
                    'excess_amt'            => $excess_amt,
                    'transaction_ID'        => $transaction_ID
                );
                // dev_export($data_to_save);
                // die;
                $pay_status = $this->MFee_collection->save_transaction_for_fee_payment($data_to_save);
                $flag = 2;
            }
            // dev_export($pay_status);
            // die;

            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {
                if ($flag == 3) {
                    echo json_encode(array('status' => 111, 'wallet_voucher' => $pay_status['data']['VOUCHER_NO']));
                    return true;
                } else {
                    if ($is_excess == 1) {
                        echo json_encode(array('status' => 11, 'voucher_no' => $pay_status['data']['VOUCHER_NO'], 'voucher_id' => $pay_status['data']['VOUCHER_ID'], 'wallet_voucher' => $pay_status['data']['EWALLET_VOUCHER_NUMBER']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 1, 'voucher_no' => $pay_status['data']['VOUCHER_NO'], 'voucher_id' => $pay_status['data']['VOUCHER_ID']));
                        return true;
                    }
                }
            } else {
                if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 5) {
                    echo json_encode(array('status' => 5, 'message' => 'There is a change in fee data.Please initiate the transaction once again after verifing the fee details.'));
                    return true;
                } else {
                    if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                        return true;
                    }
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_cheque_payment_for_fee()
    {

        if ($this->input->is_ajax_request() == 1) {
            $student_id     = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $amount_paid    = filter_input(INPUT_POST, 'amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $round_off    = filter_input(INPUT_POST, 'round_off', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $total_penalty    = filter_input(INPUT_POST, 'total_penalty', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $payment_data   = filter_input(INPUT_POST, 'pay_data');
            $inst_id        = $this->session->userdata('inst_id');
            $acd_year_id    = $this->session->userdata('acd_year');
            $ChequeNumber   = filter_input(INPUT_POST, 'ChequeNumber', FILTER_SANITIZE_STRING);
            $ChequeDate     = filter_input(INPUT_POST, 'ChequeDate', FILTER_SANITIZE_STRING);
            $NameofDrawer   = filter_input(INPUT_POST, 'NameofDrawer', FILTER_SANITIZE_STRING);
            $DrawerAddress  = filter_input(INPUT_POST, 'DrawerAddress', FILTER_SANITIZE_STRING);
            $NameofBank     = filter_input(INPUT_POST, 'NameofBank', FILTER_SANITIZE_STRING);
            $BranchBank     = filter_input(INPUT_POST, 'BranchBank', FILTER_SANITIZE_STRING);
            $transaction_ID   = filter_input(INPUT_POST, 'transaction_ID');

            $excess_amt     = filter_input(INPUT_POST, 'excess_amt', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if ($excess_amt == 0) {
                $excess_amt = -1;
            }

            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Student data is required.'));
                return TRUE;
            }

            if (!(isset($amount_paid) && !empty($amount_paid))) {
                echo json_encode(array('status' => 2, 'message' => 'Amount paid is required.'));
                return TRUE;
            }

            if (!(isset($payment_data) && !empty($payment_data) && strlen($payment_data) > 2 && is_array(json_decode($payment_data, TRUE))) && $excess_amt < 0) {
                echo json_encode(array('status' => 2, 'message' => 'Amount allocation is incomplete. Please contact administrator for further assistance.'));
                return TRUE;
            }

            $total_voucher_amount = filter_input(INPUT_POST, 'total_voucher_amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if (!(isset($total_voucher_amount) && !empty($total_voucher_amount)) && $excess_amt < 0) {
                echo json_encode(array('status' => 2, 'message' => 'Total amount is required.'));
                return TRUE;
            }

            $total_vat_amount_paid = filter_input(INPUT_POST, 'total_vat_amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $is_excess = filter_input(INPUT_POST, 'is_excess', FILTER_SANITIZE_NUMBER_INT);
            if ($is_excess == 2) {
                $is_excess = -1;
            }
            $flag = 1;
            if ($excess_amt > 0 && (is_array(json_decode($payment_data, TRUE))) && count(json_decode($payment_data, TRUE)) == 0) {
                $data_to_save = array(
                    'action'        => 'save_wallet_amount_for_student',
                    'inst_id'       => $inst_id,
                    'acd_year_id'   => $acd_year_id,
                    'student_id'    => $student_id,
                    'excess_amt'    => $excess_amt,
                    'excess_type'   => 2
                );
                $pay_status = $this->MFee_collection->save_ewallet_credit_transaction($data_to_save);
                $flag = 3;
            } else {
                $data_to_save = array(
                    'action'                => 'save_fee_payment_for_student',
                    'student_id'            => $student_id,
                    'amount_paid'           => $amount_paid,
                    'round_off'             => $round_off,
                    'total_penalty'         => $total_penalty,
                    'payment_data'          => $payment_data,
                    'inst_id'               => $inst_id,
                    'acd_year_id'           => $acd_year_id,
                    'mode_of_payment'       => 'Q',
                    'service_charge'        => -1,
                    'total_voucher_amount'  => $total_voucher_amount,
                    'total_vat_amount_paid' => $total_vat_amount_paid,
                    'is_excess'             => $is_excess,
                    'excess_amt'            => $excess_amt,
                    'ChequeNumber'          => $ChequeNumber,
                    'ChequeDate'            => $ChequeDate,
                    'NameofDrawer'          => $NameofDrawer,
                    'DrawerAddress'         => $DrawerAddress,
                    'NameofBank'            => $NameofBank,
                    'BranchBank'            => $BranchBank,
                    'transaction_ID'        => $transaction_ID
                );
                $pay_status = $this->MFee_collection->save_cheque_transaction_for_fee_payment($data_to_save);
                $flag = 2;
            }

            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {
                if ($flag == 3) {
                    echo json_encode(array('status' => 111, 'wallet_voucher' => $pay_status['data']['VOUCHER_NO']));
                    return true;
                } else {
                    if ($is_excess == 1) {
                        echo json_encode(array('status' => 11, 'voucher_no' => $pay_status['data']['VOUCHER_NO'], 'voucher_id' => $pay_status['data']['VOUCHER_ID'], 'wallet_voucher' => $pay_status['data']['EWALLET_VOUCHER_NUMBER']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 1, 'voucher_no' => $pay_status['data']['VOUCHER_NO'], 'voucher_id' => $pay_status['data']['VOUCHER_ID']));
                        return true;
                    }
                }
            } else {
                if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 5) {
                    echo json_encode(array('status' => 5, 'message' => 'There is a change in fee data.Please initiate the transaction once again after verifing the fee details.'));
                    return true;
                } else {
                    if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                        return true;
                    }
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function save_dbt_payment_for_fee()
    {

        if ($this->input->is_ajax_request() == 1) {
            $student_id     = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $amount_paid    = filter_input(INPUT_POST, 'amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $round_off    = filter_input(INPUT_POST, 'round_off', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $total_penalty    = filter_input(INPUT_POST, 'total_penalty', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $payment_data   = filter_input(INPUT_POST, 'pay_data');
            $inst_id        = $this->session->userdata('inst_id');
            $acd_year_id    = $this->session->userdata('acd_year');
            $reference_number   = filter_input(INPUT_POST, 'reference_number', FILTER_SANITIZE_STRING);
            $referenceDate     = filter_input(INPUT_POST, 'referenceDate', FILTER_SANITIZE_STRING);
            $transaction_ID   = filter_input(INPUT_POST, 'transaction_ID');

            $excess_amt     = filter_input(INPUT_POST, 'excess_amt', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if ($excess_amt == 0) {
                $excess_amt = -1;
            }

            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Student data is required.'));
                return TRUE;
            }

            if (!(isset($amount_paid) && !empty($amount_paid))) {
                echo json_encode(array('status' => 2, 'message' => 'Amount paid is required.'));
                return TRUE;
            }

            if (!(isset($payment_data) && !empty($payment_data) && strlen($payment_data) > 2 && is_array(json_decode($payment_data, TRUE))) && $excess_amt < 0) {
                echo json_encode(array('status' => 2, 'message' => 'Amount allocation is incomplete. Please contact administrator for further assistance.'));
                return TRUE;
            }

            $total_voucher_amount = filter_input(INPUT_POST, 'total_voucher_amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if (!(isset($total_voucher_amount) && !empty($total_voucher_amount)) && $excess_amt < 0) {
                echo json_encode(array('status' => 2, 'message' => 'Total amount is required.'));
                return TRUE;
            }

            $total_vat_amount_paid = filter_input(INPUT_POST, 'total_vat_amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $is_excess = filter_input(INPUT_POST, 'is_excess', FILTER_SANITIZE_NUMBER_INT);
            if ($is_excess == 2) {
                $is_excess = -1;
            }

            $flag = 1;
            if ($excess_amt > 0 && (is_array(json_decode($payment_data, TRUE))) && count(json_decode($payment_data, TRUE)) == 0) {
                $data_to_save = array(
                    'action'        => 'save_wallet_amount_for_student',
                    'inst_id'       => $inst_id,
                    'acd_year_id'   => $acd_year_id,
                    'student_id'    => $student_id,
                    'excess_amt'    => $excess_amt,
                    'excess_type'   => 2
                );
                $pay_status = $this->MFee_collection->save_ewallet_credit_transaction($data_to_save);
                $flag = 3;
            } else {
                $data_to_save = array(
                    'action'                => 'save_fee_payment_for_student',
                    'student_id'            => $student_id,
                    'amount_paid'           => $amount_paid,
                    'round_off'             => $round_off,
                    'total_penalty'         => $total_penalty,
                    'payment_data'          => $payment_data,
                    'inst_id'               => $inst_id,
                    'acd_year_id'           => $acd_year_id,
                    'mode_of_payment'       => 'D',
                    'service_charge'        => -1,
                    'total_voucher_amount'  => $total_voucher_amount,
                    'total_vat_amount_paid' => $total_vat_amount_paid,
                    'is_excess'             => $is_excess,
                    'excess_amt'            => $excess_amt,
                    'reference_number'      => $reference_number,
                    'referenceDate'         => $referenceDate,
                    'transaction_ID' => $transaction_ID
                );
                $pay_status = $this->MFee_collection->save_transaction_for_fee_payment($data_to_save);
                $flag = 2;
            }

            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {
                if ($flag == 3) {
                    echo json_encode(array('status' => 111, 'wallet_voucher' => $pay_status['data']['VOUCHER_NO']));
                    return true;
                } else {
                    if ($is_excess == 1) {
                        echo json_encode(array('status' => 11, 'voucher_no' => $pay_status['data']['VOUCHER_NO'], 'voucher_id' => $pay_status['data']['VOUCHER_ID'], 'wallet_voucher' => $pay_status['data']['EWALLET_VOUCHER_NUMBER']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 1, 'voucher_no' => $pay_status['data']['VOUCHER_NO'], 'voucher_id' => $pay_status['data']['VOUCHER_ID']));
                        return true;
                    }
                }
            } else {
                if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 5) {
                    echo json_encode(array('status' => 5, 'message' => 'There is a change in fee data.Please initiate the transaction once again after verifing the fee details.'));
                    return true;
                } else {
                    if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                        return true;
                    }
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * Save the payment of students through wallet
     * @Auther : Aju S Aravind
     */

    public function save_wallet_payment_for_fee()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $amount_paid = filter_input(INPUT_POST, 'amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $round_off    = filter_input(INPUT_POST, 'round_off', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $total_penalty    = filter_input(INPUT_POST, 'total_penalty', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $payment_data = filter_input(INPUT_POST, 'pay_data');
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $transaction_ID   = filter_input(INPUT_POST, 'transaction_ID');

            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Student data is required.'));
                return TRUE;
            }

            if (!(isset($amount_paid) && !empty($amount_paid))) {
                echo json_encode(array('status' => 2, 'message' => 'Amount paid is required.'));
                return TRUE;
            }

            if (!(isset($payment_data) && !empty($payment_data) && strlen($payment_data) > 2 && is_array(json_decode($payment_data, TRUE)))) { //&& $excess_amt < 0
                echo json_encode(array('status' => 2, 'message' => 'Amount allocation is incomplete. Please contact administrator for further assistance.'));
                return TRUE;
            }

            $total_voucher_amount = filter_input(INPUT_POST, 'total_voucher_amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if (!(isset($total_voucher_amount) && !empty($total_voucher_amount))) { //&& $excess_amt < 0
                echo json_encode(array('status' => 2, 'message' => 'Total amount is required.'));
                return TRUE;
            }

            $total_vat_amount_paid = filter_input(INPUT_POST, 'total_vat_amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $is_excess = filter_input(INPUT_POST, 'is_excess', FILTER_SANITIZE_NUMBER_INT);
            if ($is_excess == 2) {
                $is_excess = -1;
            }

            $data_to_save = array(
                'action'                => 'save_fee_payment_for_student',
                'student_id'            => $student_id,
                'amount_paid'           => $amount_paid,
                'round_off'             => $round_off,
                'total_penalty'         => $total_penalty,
                'payment_data'          => $payment_data,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id,
                'mode_of_payment'       => 'T',
                'service_charge'        => -1,
                'total_voucher_amount'  => $total_voucher_amount,
                'total_vat_amount_paid' => $total_vat_amount_paid,
                'is_excess'             => -1,
                'excess_amt'            => -1,
                'transaction_ID' => $transaction_ID
            );

            $pay_status = $this->MFee_collection->save_transaction_for_fee_payment($data_to_save);

            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'voucher_no' => $pay_status['data']['VOUCHER_NO'], 'voucher_id' => $pay_status['data']['VOUCHER_ID']));
                return true;
            } else {
                if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 5) {
                    echo json_encode(array('status' => 5, 'message' => 'There is a change in fee data.Please initiate the transaction once again after verifing the fee details.'));
                    return true;
                } else {
                    if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                        return true;
                    }
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * Save the payment of students through card
     * @Auther : Aju S Aravind
     */

    public function save_card_payment_for_fee()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $amount_paid = filter_input(INPUT_POST, 'amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $round_off    = filter_input(INPUT_POST, 'round_off', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $total_penalty    = filter_input(INPUT_POST, 'total_penalty', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $payment_data = filter_input(INPUT_POST, 'pay_data');
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $service_charge = filter_input(INPUT_POST, 'service_charge', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $surcharge_for_excess_amount = filter_input(INPUT_POST, 'surcharge_for_excess_amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            $name_on_card = filter_input(INPUT_POST, 'name_on_card', FILTER_SANITIZE_STRING);
            $card_number = filter_input(INPUT_POST, 'card_number', FILTER_SANITIZE_STRING);
            $transaction_ID   = filter_input(INPUT_POST, 'transaction_ID');

            if ($service_charge == 0) {
                $service_charge = -1;
            }

            $excess_amt = filter_input(INPUT_POST, 'excess_amt', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if ($excess_amt == 0) {
                $excess_amt = -1;
            }

            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Student data is required.'));
                return TRUE;
            }

            if (!(isset($amount_paid) && !empty($amount_paid))) {
                echo json_encode(array('status' => 2, 'message' => 'Amount paid is required.'));
                return TRUE;
            }

            if (!(isset($payment_data) && !empty($payment_data) && strlen($payment_data) > 2 && is_array(json_decode($payment_data, TRUE))) && $excess_amt < 0) {
                echo json_encode(array('status' => 2, 'message' => 'Amount allocation is incomplete. Please contact administrator for further assistance.'));
                return TRUE;
            }

            $total_voucher_amount = filter_input(INPUT_POST, 'total_voucher_amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if (!(isset($total_voucher_amount) && !empty($total_voucher_amount)) && $excess_amt < 0) {
                echo json_encode(array('status' => 2, 'message' => 'Total amount is required.'));
                return TRUE;
            }

            $total_vat_amount_paid = filter_input(INPUT_POST, 'total_vat_amount_paid', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $is_excess = filter_input(INPUT_POST, 'is_excess', FILTER_SANITIZE_NUMBER_INT);
            if ($is_excess == 2) {
                $is_excess = -1;
            }
            $flag = 1;
            if ($excess_amt > 0 && (is_array(json_decode($payment_data, TRUE))) && count(json_decode($payment_data, TRUE)) == 0) {
                $data_to_save = array(
                    'action' => 'save_wallet_amount_for_student',
                    'inst_id' => $inst_id,
                    'acd_year_id' => $acd_year_id,
                    'student_id' => $student_id,
                    'excess_amt' => $excess_amt,
                    'excess_type' => 2
                );
                $pay_status = $this->MFee_collection->save_ewallet_credit_transaction($data_to_save);
                $flag = 3;
            } else {
                $data_to_save = array(
                    'action' => 'save_fee_payment_for_student',
                    'student_id' => $student_id,
                    'amount_paid' => $amount_paid,
                    'round_off'   => $round_off,
                    'total_penalty'         => $total_penalty,
                    'payment_data' => $payment_data,
                    'inst_id' => $inst_id,
                    'acd_year_id' => $acd_year_id,
                    'mode_of_payment' => 'R',
                    'service_charge' => $service_charge,
                    'surcharge_for_excess_amount' => $surcharge_for_excess_amount,
                    'total_voucher_amount' => $total_voucher_amount,
                    'total_vat_amount_paid' => $total_vat_amount_paid,
                    'is_excess' => $is_excess,
                    'excess_amt' => $excess_amt,
                    'NameOfCard' => $name_on_card,
                    'CardNumber' => $card_number,
                    'transaction_ID' => $transaction_ID
                );
                // dev_export($data_to_save);
                // die;
                $pay_status = $this->MFee_collection->save_transaction_for_fee_payment($data_to_save);

                $flag = 2;
            }

            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {
                if ($flag == 3) {
                    echo json_encode(array('status' => 111, 'wallet_voucher' => $pay_status['data']['VOUCHER_NO']));
                    return true;
                } else {
                    if ($is_excess == 1) {
                        echo json_encode(array('status' => 11, 'voucher_no' => $pay_status['data']['VOUCHER_NO'], 'voucher_id' => $pay_status['data']['VOUCHER_ID'], 'wallet_voucher' => $pay_status['data']['EWALLET_VOUCHER_NUMBER']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 1, 'voucher_no' => $pay_status['data']['VOUCHER_NO'], 'voucher_id' => $pay_status['data']['VOUCHER_ID']));
                        return true;
                    }
                }
            } else {
                if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 5) {
                    echo json_encode(array('status' => 5, 'message' => 'There is a change in fee data.Please initiate the transaction once again after verifing the fee details.'));
                    return true;
                } else {
                    if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                        return true;
                    }
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * Getting student filter for the student walet collection
     * @Auther : Aju S Aravind
     */

    public function get_student_filter_for_wallet()
    {
        //$show = strtoupper(filter_input(INPUT_POST, 'show', FILTER_SANITIZE_STRING));
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
        $this->load->view('wallet/student_filter', $data);
    }

    public function search_byname_wallet()
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
            echo json_encode(array('status' => 1, 'view' => $this->load->view('wallet/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function advancesearch_byname_wallet()
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
            echo json_encode(array('status' => 1, 'view' => $this->load->view('wallet/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function batchlist_wallet()
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

    public function show_fee_student_wallet()
    {
        if ($this->input->is_ajax_request() == 1) {
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);

            $student_name = filter_input(INPUT_POST, 'studentname', FILTER_SANITIZE_STRING);
            $student_id = strtoupper(filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING));
            $details_data = $this->MRegistration->get_profiles_student($student_id);
            if (isset($details_data['data'][0]) && !empty($details_data['data'][0])) {
                $data['student_data'] = $details_data['data'][0];

                //Get fee collection data for payment.
                $inst_id = $this->session->userdata('inst_id');
                $acd_year_id = $this->session->userdata('acd_year');

                $allocation_data_for_student = $this->MFee_collection->get_wallet_data_by_student($student_id, $inst_id, $acd_year_id);

                if (isset($allocation_data_for_student['summary_data']) && !empty($allocation_data_for_student['summary_data'])) {
                    $data['fee_summary'] = $allocation_data_for_student['summary_data']['PENDING_PAYMENT'];
                    $data['e_wallet'] = $allocation_data_for_student['summary_data']['E_WALLET'];
                    $data['min_wallet'] = $allocation_data_for_student['summary_data']['MIN_WALLET_AMOUNT_TO_PAY'];
                } else {
                    $data['fee_summary'] = 0;
                    $data['e_wallet'] = 0;
                    $data['min_wallet'] = 1;
                }

                if ($type == 'statement') {
                    $wallet_statement_for_student = $this->MFee_collection->get_wallet_data_by_student($student_id, $inst_id, $acd_year_id, 'statement');
                    if (isset($wallet_statement_for_student['summary_data']) && !empty($wallet_statement_for_student['summary_data'])) {
                        $data['wallet_statement'] = $wallet_statement_for_student['summary_data'];
                    } else {
                        $data['wallet_statement'] = 0;
                    }

                    $data['sub_title'] = 'Docme Wallet Statement';
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('wallet/show_wallet_statement_students', $data, TRUE)));
                    return true;
                } else {

                    if (isset($allocation_data_for_student['card_service_charge']) && !empty($allocation_data_for_student['card_service_charge'])) {
                        $data['card_service_charge'] = $allocation_data_for_student['card_service_charge'];
                    } else {
                        $data['card_service_charge'] = 0;
                    }

                    if (isset($allocation_data_for_student['bank_details']) && !empty($allocation_data_for_student['bank_details'])) {
                        $data['bank_details'] = $allocation_data_for_student['bank_details'];
                    } else {
                        $data['bank_details'] = NULL;
                    }
                    if (isset($allocation_data_for_student['is_black_list_data']) && !empty($allocation_data_for_student['is_black_list_data']) && $allocation_data_for_student['is_black_list_data'] == 1) {
                        $data['black_list_data'] = $allocation_data_for_student['black_list_data'];
                    } else {
                        $data['black_list_data'] = 0;
                    }
                    $data['sub_title'] = 'Docme Wallet Collection';
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('wallet/student_wallet_collection', $data, TRUE)));
                    return true;
                }
            } else {

                $data['details_data'] = NULL;
                echo json_encode(array('status' => 2, 'message' => 'Student data is not available.'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_cash_payment_for_wallet()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $excess_amt = filter_input(INPUT_POST, 'excess_amt', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if ($excess_amt == 0) {
                $excess_amt = -1;
            }

            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Student data is required.'));
                return TRUE;
            }

            $is_excess = filter_input(INPUT_POST, 'is_excess', FILTER_SANITIZE_NUMBER_INT);
            if ($is_excess == 2) {
                $is_excess = -1;
            }
            $data_to_save = array(
                'action' => 'save_wallet_amount_for_student_bycash',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'student_id' => $student_id,
                'excess_amt' => $excess_amt,
                'excess_type' => 2
            );
            $pay_status = $this->MFee_collection->save_ewallet_credit_transaction($data_to_save);

            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {

                echo json_encode(array('status' => 1, 'wallet_voucher' => $pay_status['data']['VOUCHER_NO'], 'wallet_voucher_id' => $pay_status['data']['VOUCHER_ID']));
                return true;
            } else {
                if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 5) {
                    echo json_encode(array('status' => 5, 'message' => 'There is a change in fee data.Please initiate the transaction once again after verifing the fee details.'));
                    return true;
                } else {
                    if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                        return true;
                    }
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_cheque_payment_for_wallet()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $excess_amt = filter_input(INPUT_POST, 'excess_amt', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if ($excess_amt == 0) {
                $excess_amt = -1;
            }

            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Student data is required.'));
                return TRUE;
            }

            $is_excess = filter_input(INPUT_POST, 'is_excess', FILTER_SANITIZE_NUMBER_INT);
            if ($is_excess == 2) {
                $is_excess = -1;
            }

            $ch_number = filter_input(INPUT_POST, 'ch_number', FILTER_SANITIZE_STRING);
            if (!(isset($ch_number) && !empty($ch_number))) {
                echo json_encode(array('status' => 2, 'message' => 'Cheque number is required.'));
                return TRUE;
            }

            $ch_date = filter_input(INPUT_POST, 'ch_date', FILTER_SANITIZE_STRING);
            if (!(isset($ch_date) && !empty($ch_date))) {
                echo json_encode(array('status' => 2, 'message' => 'Cheque date is required.'));
                return TRUE;
            }

            $ch_account_holder_name = filter_input(INPUT_POST, 'ch_account_holder_name', FILTER_SANITIZE_STRING);
            if (!(isset($ch_account_holder_name) && !empty($ch_account_holder_name))) {
                echo json_encode(array('status' => 2, 'message' => 'Account holder name is required.'));
                return TRUE;
            }

            $ch_address = filter_input(INPUT_POST, 'ch_address', FILTER_SANITIZE_STRING);
            if (!(isset($ch_address) && !empty($ch_address))) {
                echo json_encode(array('status' => 2, 'message' => 'Address is required.'));
                return TRUE;
            }

            $ch_bank_id = filter_input(INPUT_POST, 'ch_bank_id', FILTER_SANITIZE_STRING);
            if (!(isset($ch_bank_id) && !empty($ch_bank_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Bank data is required.'));
                return TRUE;
            }

            $branch_name = filter_input(INPUT_POST, 'branch_name', FILTER_SANITIZE_STRING);
            if (!(isset($branch_name) && !empty($branch_name))) {
                echo json_encode(array('status' => 2, 'message' => 'Bank branch name is required.'));
                return TRUE;
            }

            $data_to_save = array(
                'action' => 'save_wallet_amount_for_student_bycheque',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'student_id' => $student_id,
                'excess_amt' => $excess_amt,
                'excess_type' => 2,
                'ch_number' => $ch_number,
                'ch_date' => $ch_date,
                'ch_account_holder_name' => $ch_account_holder_name,
                'ch_address' => $ch_address,
                'ch_bank_id' => $ch_bank_id,
                'branch_name' => $branch_name
            );
            $pay_status = $this->MFee_collection->save_ewallet_credit_transaction($data_to_save);

            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {

                echo json_encode(array('status' => 1, 'wallet_voucher' => $pay_status['data']['VOUCHER_NO'], 'wallet_voucher_id' => $pay_status['data']['VOUCHER_ID']));
                return true;
            } else {
                if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 5) {
                    echo json_encode(array('status' => 5, 'message' => 'There is a change in fee data.Please initiate the transaction once again after verifing the fee details.'));
                    return true;
                } else {
                    if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                        return true;
                    }
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_card_payment_for_wallet()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $excess_amt = filter_input(INPUT_POST, 'excess_amt', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if ($excess_amt == 0) {
                $excess_amt = -1;
            }

            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Student data is required.'));
                return TRUE;
            }

            $is_excess = filter_input(INPUT_POST, 'is_excess', FILTER_SANITIZE_NUMBER_INT);
            if ($is_excess == 2) {
                $is_excess = -1;
            }

            $service_charge = filter_input(INPUT_POST, 'service_charge', FILTER_SANITIZE_STRING);
            // dev_export($service_charge);
            // die;
            // if (!(isset($service_charge) && !empty($service_charge))) {
            //     echo json_encode(array('status' => 2, 'message' => 'Service charge is required.'));
            //     return TRUE;
            // }

            $card_number = filter_input(INPUT_POST, 'card_number', FILTER_SANITIZE_STRING);
            if (!(isset($card_number) && !empty($card_number))) {
                echo json_encode(array('status' => 2, 'message' => 'Card number is required.'));
                return TRUE;
            }
            $name_on_card = filter_input(INPUT_POST, 'name_on_card', FILTER_SANITIZE_STRING);
            if (!(isset($name_on_card) && !empty($name_on_card))) {
                echo json_encode(array('status' => 2, 'message' => 'Name as on card is required.'));
                return TRUE;
            }
            $data_to_save = array(
                'action' => 'save_wallet_amount_for_student_bycard',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'student_id' => $student_id,
                'excess_amt' => $excess_amt,
                'excess_type' => 2,
                'service_charge' => $service_charge,
                'card_number' => $card_number,
                'name_on_card' => $name_on_card
            );
            $pay_status = $this->MFee_collection->save_ewallet_credit_transaction($data_to_save);

            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {

                echo json_encode(array('status' => 1, 'wallet_voucher' => $pay_status['data']['VOUCHER_NO'], 'wallet_voucher_id' => $pay_status['data']['VOUCHER_ID']));
                return true;
            } else {
                if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 5) {
                    echo json_encode(array('status' => 5, 'message' => 'There is a change in fee data.Please initiate the transaction once again after verifing the fee details.'));
                    return true;
                } else {
                    if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                        return true;
                    }
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function save_dbt_payment_for_wallet()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $excess_amt = filter_input(INPUT_POST, 'excess_amt', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if ($excess_amt == 0) {
                $excess_amt = -1;
            }

            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Student data is required.'));
                return TRUE;
            }

            $is_excess = filter_input(INPUT_POST, 'is_excess', FILTER_SANITIZE_NUMBER_INT);
            if ($is_excess == 2) {
                $is_excess = -1;
            }

            $referenceDate = filter_input(INPUT_POST, 'referenceDate', FILTER_SANITIZE_STRING);
            if (!(isset($referenceDate) && !empty($referenceDate))) {
                echo json_encode(array('status' => 2, 'message' => 'Payment Date is required.'));
                return TRUE;
            }
            $reference_number = filter_input(INPUT_POST, 'reference_number', FILTER_SANITIZE_STRING);
            if (!(isset($reference_number) && !empty($reference_number))) {
                echo json_encode(array('status' => 2, 'message' => 'Reference No. is required.'));
                return TRUE;
            }
            $data_to_save = array(
                'action' => 'save_wallet_amount_for_student_bydbt',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'student_id' => $student_id,
                'excess_amt' => $excess_amt,
                'excess_type' => 2,
                'referenceDate' => $referenceDate,
                'reference_number' => $reference_number
            );
            $pay_status = $this->MFee_collection->save_ewallet_credit_transaction($data_to_save);

            if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 1) {

                echo json_encode(array('status' => 1, 'wallet_voucher' => $pay_status['data']['VOUCHER_NO'], 'wallet_voucher_id' => $pay_status['data']['VOUCHER_ID']));
                return true;
            } else {
                if (isset($pay_status['data_status']) && !empty($pay_status['data_status']) && $pay_status['data_status'] == 5) {
                    echo json_encode(array('status' => 5, 'message' => 'There is a change in fee data.Please initiate the transaction once again after verifing the fee details.'));
                    return true;
                } else {
                    if (isset($pay_status['message']) && !empty($pay_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $pay_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'There is an error occured. Please try again later'));
                        return true;
                    }
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * TO reconcile the payment made through cheques
     * @Author : Aju S Aravind
     */

    public function show_cheque_reconciliation()
    {
        if ($this->input->is_ajax_request() == 1) {
            //To get intial data
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $basic_data = $this->MFee_collection->get_base_data_for_cheque_reconcile($inst_id, $acd_year_id);
            // dev_export($basic_data);
            // die;
            if (isset($basic_data['data_status']) && !empty($basic_data['data_status'])) {
                if ($basic_data['data_count'] > 0) {
                    $data['cheque_data'] = json_decode($basic_data['data'][0]['CHQ_DATA'], TRUE);
                } else {
                    $data['cheque_data'] = NULL;
                }
            } else {
                $this->load->view(ERROR_500_NEW);
                return;
            }
            $this->load->view('fee_collection/show_cheque_reconcile', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * TO reconcile the payment made through cheques
     * @Author : Aju S Aravind
     */

    public function search_cheque_reconciliation()
    {
        if ($this->input->is_ajax_request() == 1) {
            //To get intial data
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $start_date = filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING);
            $end_date = filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING);

            if ((!(isset($start_date) && !empty($start_date))) && strlen($start_date) < 5 && strlen($end_date) < 5) {
                echo json_encode(array('data_status' => 2, 'view' => ''));
                return true;
            }

            $basic_data = $this->MFee_collection->get_base_data_for_cheque_reconcile_search($inst_id, $acd_year_id, $start_date, $end_date);
            if (isset($basic_data['data_status']) && !empty($basic_data['data_status'])) {
                if ($basic_data['data_count'] > 0) {
                    $data['cheque_data'] = json_decode($basic_data['data'][0]['CHQ_DATA'], TRUE);
                } else {
                    $data['cheque_data'] = NULL;
                }
            } else {
                echo json_encode(array('status' => 3, 'view' => $this->load->view(ERROR_500_NEW, NULL, TRUE)));
                return true;
            }
            echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_collection/search_show_cheque_reconcile', $data, TRUE)));
            return true;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * To reconciled marking of cheque
     * @Author : Aju S Aravind
     */

    public function cheque_reconcile()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $master_id = filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_STRING);
            $ops = 1;
            $remarks = 'Cheque reconciled successfully and credit to student account';
            if (!(isset($master_id) && !empty($master_id))) {
                echo json_encode(array('data_status' => 2, 'view' => '', 'message' => 'Master ID is not available. Please try again later'));
                return true;
            }
            $recon_status = $this->MFee_collection->perform_cheque_reconciliation($inst_id, $acd_year_id, $master_id, $ops, $remarks);
            if (isset($recon_status['data_status']) && !empty($recon_status['data_status']) && $recon_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Reconciled successfully.', 'recon_voucher' => $recon_status['recon_voucher'], 'recon_wallet_voucher' => $recon_status['recon_wallet_voucher']));
                return true;
            } else {
                if (isset($recon_status['message']) && !empty($recon_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $recon_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Cheque reconcilation failed. For further assistance please contact administrator.'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * To bounce the marked cheque
     * @Author : Aju S Aravind
     */

    public function cheque_bounce()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $master_id = filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_STRING);
            $remarks = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);
            $ops = 2;
            if (!(isset($master_id) && !empty($master_id))) {
                echo json_encode(array('data_status' => 2, 'view' => '', 'message' => 'Master ID is not available. Please try again later'));
                return true;
            }
            $recon_status = $this->MFee_collection->perform_cheque_reconciliation($inst_id, $acd_year_id, $master_id, $ops, $remarks);
            if (isset($recon_status['data_status']) && !empty($recon_status['data_status']) && $recon_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Reconciled successfully.'));
                return true;
            } else {
                if (isset($recon_status['message']) && !empty($recon_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $recon_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Cheque reconcilation failed. For further assistance please contact administrator.'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function cheque_cancel()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $master_id = filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_STRING);
            $remarks = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);
            $ops = 3;
            if (!(isset($master_id) && !empty($master_id))) {
                echo json_encode(array('data_status' => 2, 'view' => '', 'message' => 'Master ID is not available. Please try again later'));
                return true;
            }
            $recon_status = $this->MFee_collection->perform_cheque_reconciliation($inst_id, $acd_year_id, $master_id, $ops, $remarks);
            if (isset($recon_status['data_status']) && !empty($recon_status['data_status']) && $recon_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Reconciled successfully.'));
                return true;
            } else {
                if (isset($recon_status['message']) && !empty($recon_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $recon_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Cheque reconcilation failed. For further assistance please contact administrator.'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * To get blacklisted students list
     * @Author : Aju S Aravind
     */

    public function black_listed_students_list()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $blacklist_students_list = $this->MFee_collection->get_black_listed_students($inst_id, $acd_year_id);

            if (isset($blacklist_students_list['data_status']) && !empty($blacklist_students_list['data_status']) && $blacklist_students_list['data_status'] == 1) {
                if (isset($blacklist_students_list['data']) && !empty($blacklist_students_list['data'])) {
                    $data['black_listed_students'] = json_decode($blacklist_students_list['data'][0]['BL_DATA'], TRUE);
                } else {
                    $data['black_listed_students'] = NULL;
                }
            } else {
                $data['black_listed_students'] = NULL;
            }
            $data['sub_title'] = 'Blacklist Release';
            echo json_encode(array('data_status' => 1, 'view' => $this->load->view('fee_collection/show_blacklisted_students', $data, TRUE)));
            return;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * To relase the blacklisted student.
     * @Author : Aju S Aravind
     */

    public function release_blacklist_students()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $remarks = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);
            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array('data_status' => 2, 'view' => '', 'message' => 'Student data is not available. Please try again later'));
                return true;
            }
            $release_status = $this->MFee_collection->release_blacklisted_students($inst_id, $acd_year_id, $student_id, $remarks);
            if (isset($release_status['data_status']) && !empty($release_status['data_status']) && $release_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Released successfully.'));
                return true;
            } else {
                if (isset($release_status['message']) && !empty($release_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $release_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Student blacklist release failed. For further assistance please contact administrator.'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * TO add new request withdrawal of amount from docme wallet
     * @Author : Aju S Aravind
     */

    public function show_fee_student_wallet_to_withdraw_request()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'studentname', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $details_data = $this->MRegistration->get_profiles_student($student_id);

            if (isset($details_data['data'][0]) && !empty($details_data['data'][0])) {
                $data['student_data'] = $details_data['data'][0];
                // Added by SALAHUDHEEN May 29, 2019 : START
                $withdraw_data_for_student = $this->MFee_collection->get_wallet_data_by_student($student_id, $inst_id, $acd_year_id);
                if (isset($withdraw_data_for_student['summary_data']) && !empty($withdraw_data_for_student['summary_data'])) {
                    $data['e_wallet'] = $withdraw_data_for_student['summary_data']['E_WALLET'];
                } else {
                    $data['e_wallet'] = 0;
                }
                // Added by SALAHUDHEEN May 29, 2019 : END
            } else {
                $data['student_data'] = NULL;
            }

            $data['sub_title'] = 'WITHDRAW FROM DOCME WALLET - ' . $student_name;
            $data['student_id'] = $student_id;
            $data['student_name'] = $student_name;
            $withdraw_request_data = $this->MFee_collection->get_withdraw_data_summary($student_id, $inst_id, $acd_year_id);
            if (isset($withdraw_request_data['data']) && !empty($withdraw_request_data['data'])) {
                $data['withdraw_request_data'] = $withdraw_request_data['data'];
            } else {
                $data['withdraw_request_data'] = NULL;
            }
            echo json_encode(array(
                'status' => 1,
                'view' => $this->load->view('wallet/request_list', $data, TRUE)
            ));
            return true;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * TO add new request withdrawal of amount from docme wallet
     * @Author : Aju S Aravind
     */

    public function request_to_withdraw_from_wallet()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $details_data = $this->MRegistration->get_profiles_student($student_id);
            if (isset($details_data['data'][0]) && !empty($details_data['data'][0])) {
                $data['student_data'] = $details_data['data'][0];
                $withdraw_data_for_student = $this->MFee_collection->get_wallet_data_by_student($student_id, $inst_id, $acd_year_id);
                if (isset($withdraw_data_for_student['summary_data']) && !empty($withdraw_data_for_student['summary_data'])) {
                    $data['e_wallet'] = $withdraw_data_for_student['summary_data']['E_WALLET'];
                } else {
                    $data['e_wallet'] = 0;
                }

                $data['sub_title'] = 'Docme Wallet Withdraw Request';
                echo json_encode(array('status' => 1, 'view' => $this->load->view('wallet/student_wallet_withdraw_request', $data, TRUE)));
                return true;
            } else {

                $data['details_data'] = NULL;
                echo json_encode(array('status' => 2, 'message' => 'Student data is not available.'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * TO save new request withdrawal of amount from docme wallet
     * @Author : Aju S Aravind
     */

    public function save_wallet_withdraw_request()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $data['student_id'] = $student_id;
            $data['student_name'] = $student_name;
            $amount_to_withdraw = filter_input(INPUT_POST, 'transaction_amount', FILTER_SANITIZE_STRING);
            $reason = filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING);

            $data_status = $this->MFee_collection->save_withdraw_request($student_id, $inst_id, $acd_year_id, $amount_to_withdraw, $reason);
            // dev_export($data_status);
            // die;
            if (isset($data_status['data_status']) && !empty($data_status['data_status']) && $data_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Request placed successfully.'));
                return true;
            } else {
                if (isset($data_status['message']) && !empty($data_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $data_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. For further assistance please contact administrator'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * TO show approve request withdrawal of amount from docme wallet
     * @Author : Aju S Aravind
     */

    public function show_approve_wallet_withdraw()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $master_id = filter_input(INPUT_POST, 'masterid', FILTER_SANITIZE_STRING);

            $data['student_id'] = $student_id;
            $data['student_name'] = $student_name;
            $data['master_id'] = $master_id;
            $data['sub_title'] = 'DOCME WALLET WITHDRAWL - ' . $student_name;

            $details_data = $this->MRegistration->get_profiles_student($student_id);
            if (isset($details_data['data'][0]) && !empty($details_data['data'][0])) {
                $data['student_data'] = $details_data['data'][0];
            } else {
                echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please contact administrator'));
                return TRUE;
            }

            $approve_data = $this->MFee_collection->get_approval_data($master_id, $student_id, $inst_id, $acd_year_id);
            $encash_data = $this->MFee_collection->get_encashment_data($master_id, $student_id, $inst_id, $acd_year_id);

            if (isset($approve_data['data'][0]) && !empty($approve_data['data'][0])) {
                $data['approve_data'] = $approve_data['data'][0];
                $data['e_wallet'] = $approve_data['docme_wallet'];
                $data['bank_details'] = $encash_data['bank_details'];
            } else {
                $data['approve_data'] = NULL;
                $data['e_wallet'] = 0;
            }

            // if (isset($approve_data['data'][0]) && !empty($approve_data['data'][0])) {
            //     $data['approve_data'] = $approve_data['data'][0];
            //     $data['e_wallet'] = $approve_data['docme_wallet'];
            // } else {
            //     $data['approve_data'] = NULL;
            //     $data['e_wallet'] = 0;
            // }

            echo json_encode(array('status' => 1, 'view' => $this->load->view('wallet/student_wallet_withdraw_approve', $data, true)));
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * TO save approve request withdrawal of amount from docme wallet
     * @Author : Aju S Aravind
     */

    public function save_approve_withdraw_request()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $master_id = filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_STRING);
            $approve_type = filter_input(INPUT_POST, 'approve_type', FILTER_SANITIZE_STRING);
            $comments = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);
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
                'action' => 'save_withdraw_approval',
                'student_id' => $student_id,
                'master_id' => $master_id,
                'approve_type' => $approve_type,
                'comments' => base64_decode($comments),
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'is_cheque' => $is_cheque,
                'cheque_number' => $cheque_number,
                'cheque_date' => $cheque_date,
                'issued_name' => $issued_name,
                'bank_id' => $bank_id
            );

            $data_status = $this->MFee_collection->save_withdrawal_request_for_wallet($data_to_save);
            if (isset($data_status['data_status']) && !empty($data_status['data_status']) && $data_status['data_status'] == 1) {
                if ($approve_type == 'Reject') {
                    echo json_encode(array('status' => 1, 'message' => 'Request ' . $approve_type . 'ed successfully.'));
                    return true;
                } else {
                    echo json_encode(array('status' => 1, 'voucher_no' => $data_status['data']['VOUCHER_NO'], 'voucher_id' => $data_status['data']['VOUCHER_ID'], 'message' => 'Withdrawl completed successfully.'));
                    return true;
                }
            } else {
                if (isset($data_status['message']) && !empty($data_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $data_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. For further assistance please contact administrator'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * TO show encashment of withdrawal request of amount from docme wallet
     * @Author : Aju S Aravind
     */

    public function show_encashment_withdraw_request()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $master_id = filter_input(INPUT_POST, 'masterid', FILTER_SANITIZE_STRING);

            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $data['student_id'] = $student_id;
            $data['student_name'] = $student_name;
            $data['master_id'] = $master_id;
            $data['sub_title'] = 'DOCME WALLET WITHDRAWL - ' . $student_name;

            $details_data = $this->MRegistration->get_profiles_student($student_id);
            if (isset($details_data['data'][0]) && !empty($details_data['data'][0])) {
                $data['student_data'] = $details_data['data'][0];
            } else {
                echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please contact administrator'));
                return TRUE;
            }

            $approve_data = $this->MFee_collection->get_encashment_data($master_id, $student_id, $inst_id, $acd_year_id);

            if (isset($approve_data['data'][0]) && !empty($approve_data['data'][0])) {
                $data['approve_data'] = $approve_data['data'][0];
                $data['e_wallet'] = $approve_data['docme_wallet'];
                $data['bank_details'] = $approve_data['bank_details'];
            } else {
                $data['approve_data'] = NULL;
                $data['e_wallet'] = 0;
            }

            echo json_encode(array('status' => 1, 'view' => $this->load->view('wallet/student_wallet_withdraw_encashment', $data, true)));
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * TO save encashment of withdrawal request of amount from docme wallet by cash
     * @Author : Aju S Aravind
     */

    public function save_encashment_withdraw_wallet_by_cash()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $master_id = filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $data['student_id'] = $student_id;
            $data['student_name'] = $student_name;

            $data_to_save = array(
                'action' => 'save_withdrawal_encashment_bycash',
                'student_id' => $student_id,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'master_id' => $master_id
            );
            $data_status = $this->MFee_collection->save_withdrawal_encashment_bycash($data_to_save);
            if (isset($data_status['data_status']) && !empty($data_status['data_status']) && $data_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'voucher_no' => $data_status['data']['VOUCHER_NO'], 'voucher_id' => $data_status['data']['VOUCHER_ID'], 'message' => 'Withdrawl completed successfully.'));
                return true;
            } else {
                if (isset($data_status['message']) && !empty($data_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $data_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. For further assistance please contact administrator'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * TO save encashment of withdrawal request of amount from docme wallet by cheque
     * @Author : Aju S Aravind
     */

    public function save_encashment_withdraw_wallet_by_cheque()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $master_id = filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_STRING);
            $cheque_number = filter_input(INPUT_POST, 'cheque_number', FILTER_SANITIZE_STRING);
            $cheque_date = filter_input(INPUT_POST, 'cheque_date', FILTER_SANITIZE_STRING);
            $issued_name = filter_input(INPUT_POST, 'issued_name', FILTER_SANITIZE_STRING);
            $bank_id = filter_input(INPUT_POST, 'bank_id', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $data['student_id'] = $student_id;
            $data['student_name'] = $student_name;

            $data_to_save = array(
                'action' => 'save_withdrawal_encashment_bycheque',
                'student_id' => $student_id,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'master_id' => $master_id,
                'cheque_number' => $cheque_number,
                'cheque_date' => $cheque_date,
                'issued_name' => $issued_name,
                'bank_id' => $bank_id
            );
            $data_status = $this->MFee_collection->save_withdrawal_encashment_bycheque($data_to_save);
            if (isset($data_status['data_status']) && !empty($data_status['data_status']) && $data_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Withdrawl completed successfully.'));
                return true;
            } else {
                if (isset($data_status['message']) && !empty($data_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $data_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. For further assistance please contact administrator'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    /*
     * TO show approve request withdrawal of amount from docme wallet
     * @Author : Aju S Aravind
     */

    public function view_wallet_withdraw_request()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $master_id = filter_input(INPUT_POST, 'masterid', FILTER_SANITIZE_STRING);

            $data['student_id'] = $student_id;
            $data['student_name'] = $student_name;
            $data['master_id'] = $master_id;
            $data['sub_title'] = 'DOCME WALLET WITHDRAWL - ' . $student_name;

            $details_data = $this->MRegistration->get_profiles_student($student_id);
            if (isset($details_data['data'][0]) && !empty($details_data['data'][0])) {
                $data['student_data'] = $details_data['data'][0];
            } else {
                echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please contact administrator'));
                return TRUE;
            }

            $approve_data = $this->MFee_collection->get_view_data($master_id, $student_id, $inst_id, $acd_year_id);

            if (isset($approve_data['data'][0]) && !empty($approve_data['data'][0])) {
                $data['approve_data'] = $approve_data['data'][0];
                $data['e_wallet'] = $approve_data['docme_wallet'];
            } else {
                $data['approve_data'] = NULL;
                $data['e_wallet'] = 0;
            }

            echo json_encode(array('status' => 1, 'view' => $this->load->view('wallet/student_wallet_withdraw_view', $data, true)));
        } else {
            $this->load->view(ERROR_500);
        }
    }
    /*
     * Functionalities for voucher Reprint
     */

    public function show_voucher_reprint()
    {
        //STREAM DATA
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

        //CLASS DATA
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
        //ACD YEAR DATA
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

        //BATCH DATA
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

        //GET VOUCHER TYPES
        $voucher_types = $this->MFee_collection->get_all_voucher_types();
        //dev_export($voucher_types); die;
        //if (isset($voucher_types['error_status']) && $voucher_types['error_status'] == 0) {
        if ($voucher_types['data_status'] == 1) {
            $data['voucher_types_data'] = $voucher_types['data'];
        } else {
            $data['voucher_types_data'] = FALSE;
        }
        //        } else {
        //            $data['voucher_types_data'] = FALSE;
        //        }
        $this->load->view('voucher_reprint/voucher_reprint', $data);
    }
    public function print_voucher_reprint()
    {
        $data['title'] = 'Voucher Reprint';
        $data['sub_title'] = 'Voucher Reprint';

        if ($this->input->is_ajax_request() == 1) {
            $voucher_id = filter_input(INPUT_POST, 'voucher_id', FILTER_SANITIZE_STRING);
            $voucher_code = filter_input(INPUT_POST, 'voucher_code', FILTER_SANITIZE_STRING);
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $issue = filter_input(INPUT_POST, 'issue', FILTER_SANITIZE_STRING);
            $ptype = filter_input(INPUT_POST, 'ptype', FILTER_SANITIZE_STRING);

            $voucher_details = $this->MFee_collection->get_voucher_details($voucher_id, $inst_id, $acd_year_id, 'get_voucher_data_by_id_for_reprint', $ptype);
            // dev_export($voucher_details);
            // die;
            if (isset($voucher_details['data']) && !empty($voucher_details['data'])) {
                $voucher_data = (isset($voucher_details['data'][0]['VOUCHER_DATA']) && !empty($voucher_details['data'][0]['VOUCHER_DATA'])) ? json_decode($voucher_details['data'][0]['VOUCHER_DATA'], TRUE) : NULL;
                $pay_data = (isset($voucher_details['data'][0]['PAY_DATA']) && !empty($voucher_details['data'][0]['PAY_DATA'])) ? json_decode($voucher_details['data'][0]['PAY_DATA'], TRUE) : NULL;
                $student_data = (isset($voucher_details['data'][0]['STUDENT_TRANS_INFO']) && !empty($voucher_details['data'][0]['STUDENT_TRANS_INFO'])) ? json_decode($voucher_details['data'][0]['STUDENT_TRANS_INFO'], TRUE) : NULL;
                $wallet_data = (isset($voucher_details['data'][0]['WALLET_DATA']) && !empty($voucher_details['data'][0]['WALLET_DATA'])) ? json_decode($voucher_details['data'][0]['WALLET_DATA'], TRUE) : NULL;
                $master_data = (isset($voucher_details['data'][0]['MASTER_DATA']) && !empty($voucher_details['data'][0]['MASTER_DATA'])) ? json_decode($voucher_details['data'][0]['MASTER_DATA'], TRUE) : NULL;
                $transaction_type = $voucher_details['data'][0]['TRANS_TYPE'];
            } else {
                $voucher_data = NULL;
                $pay_data = NULL;
                $student_data = NULL;
                $wallet_data = NULL;
                $master_data = NULL;
                $transaction_type = 0;
            }
            $vcode = substr($voucher_code, 0, 3);
            if ($issue == 'reprint' && $vcode == 'FRV' && isset($voucher_details['data'][0]['STUDENT_TRANS_INFO']) && !empty($voucher_details['data'][0]['STUDENT_TRANS_INFO'])) {
                $wallet_data = NULL;
            }
            if (isset($student_data[0]['roundoff']) && $student_data[0]['roundoff'] != 0) {
                $roundoffarray = array(
                    'transaction_desc' => 'Round Off',
                    'transaction_amount' => $student_data[0]['roundoff'],
                    'vat_percent' => 0,
                    'vat_amount' => 0,
                    'is_service_charge' => 0
                );
                array_push($student_data, $roundoffarray);
            }
            $sarr = array();
            if (!empty($student_data)) {
                foreach ($student_data as $sd) {
                    $sarr[] = $sd;
                    if (isset($sd['vtype'])) $vtype = $sd['vtype'];
                    else $vtype = 0;
                    if (isset($sd['penalty_amt']) && $sd['penalty_amt'] != 0  && ($vtype == 2 && $sd['penalty_only'] == 0)) {
                        $roundoffarray = array(
                            'transaction_desc' => 'Penalty ' . $sd['transaction_desc'],
                            'transaction_amount' => $sd['penalty_amt'],
                            'vat_percent' => 0,
                            'vat_amount' => 0,
                            'is_service_charge' => 0,
                            'demandmonth' => $sd['demandmonth']
                        );
                        $sarr[] = $roundoffarray;
                        // array_push($student_data, $roundoffarray);
                    }
                }
            }
            if (!empty($sarr)) $student_data = $sarr;
            /** */
            // dev_export($pay_data);
            // die;
            // if (isset($student_data[0]['penalty_amt']) && $student_data[0]['penalty_amt'] != 0) {
            //     $roundoffarray = array(
            //         'transaction_desc' => 'Round Off',
            //         'transaction_amount' => $student_data[0]['roundoff'],
            //         'vat_percent' => 0,
            //         'vat_amount' => 0
            //     );
            //     array_push($student_data, $roundoffarray);
            // }
            if ($ptype != 'regfee' && $ptype != 'temp_regfee') {
                $st_details_data = $this->MRegistration->get_profiles_student($student_id);
                if (isset($st_details_data['data'][0]) && !empty($st_details_data['data'][0])) {
                    $student_master_data = $st_details_data['data'][0];
                } else {
                    $student_master_data = NULL;
                }
            } else {
                $student_master_data = NULL;
            }

            $trantype = '';
            if ($master_data != NULL) {
                if ($master_data[0]['is_cash'] == 1) {
                    $trantype = 'By Cash';
                } else if ($master_data[0]['is_cheque'] == 1) {
                    $trantype = 'By Cheque No.';
                } else if ($master_data[0]['is_card'] == 1) {
                    $trantype = 'By Card No.';
                } else if ($master_data[0]['is_online'] == 1) {
                    $trantype = 'By Online Txn Id';
                } else if ($master_data[0]['is_wallet'] == 1) {
                    $trantype = 'By Wallet';
                } else if ($master_data[0]['is_dbt'] == 1) {
                    $trantype = 'By DBT Ref. No.';
                } else if ($master_data[0]['is_withdraw'] == 1 && $master_data[0]['is_payback'] == 1) {
                    $trantype = 'Fee Payback';
                } else if ($master_data[0]['is_withdraw'] == 1 && $master_data[0]['is_payback'] == 0) {
                    $trantype = 'Wallet Withdrawal';
                } else {
                    $trantype = 'By Concession / Exemption';
                }
            }
            // dev_export($master_data);
            // die;

            $data = array(
                'voucher_id' => $voucher_id,
                'voucher_code' => $voucher_code,
                'voucher_data' => $voucher_data,
                'pay_data' => $pay_data,
                'student_account' => $student_data, //,$sarr
                'student_details' => $student_master_data,
                'wallet_account' => $wallet_data,
                'master_data' => $master_data,
                'transaction_type' => $transaction_type,
                'ptype' => $ptype,
                'trantype' => $trantype
            );
            // dev_export($vcode);
            // die;
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            $data['vouchertype'] = $ptype;
            //            echo json_encode(array(
            //                'status' => 1,
            //                'view' => $this->load->view('voucher_reprint/voucher_printing', $data, TRUE),
            //                'message' => 'Data loaded successfully.'
            //            ));

            if ($ptype == 'regfee') {
                if ($issue == 'sendmail') {
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'FEE EMAIL VOUCHER';
                    echo json_encode(array(
                        'status' => 1,
                        'view' => $this->load->view('voucher_reprint/' . $inst_id . '/app_voucher_view_email', $data, TRUE),
                        'message' => 'Data loaded successfully.'
                    ));
                } else if ($issue == 'confirmmail') { // Send VOucher via Email
                    $mailtosend = filter_input(INPUT_POST, 'mailtosend');
                    $this->load->helper('mailgun');
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'FEE EMAIL VOUCHER';
                    $email_message = $this->load->view('voucher_reprint/' . $inst_id . '/app_voucher_send_mail', $data, true);
                    $subject = "FEE EMAIL VOUCHER";
                    $mailto = $mailtosend;
                    $mailcontent = $email_message;
                    $inst_name = 'The Oxford School';
                    $cc = '';
                    //$cc = "aneeshkhalid@team-sqa.com,ashref@team-sqa.com";
                    send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

                    echo json_encode(array(
                        'status' => 3,
                        'message' => 'Mail Sent.'
                    ));
                } else {
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'APPLICATION FEE VOUCHER' . ($issue == 'reprint' ? ' - Duplicate' : '');
                    echo json_encode(array(
                        'status' => 1,
                        'view' => $this->load->view('voucher_reprint/' . $inst_id . '/application_voucher_printing', $data, TRUE),
                        'message' => 'Data loaded successfully.'
                    ));
                }
            } else if ($ptype == 'temp_regfee') {
                if ($issue == 'sendmail') {
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'FEE EMAIL VOUCHER';
                    echo json_encode(array(
                        'status' => 1,
                        'view' => $this->load->view('voucher_reprint/' . $inst_id . '/app_voucher_view_email', $data, TRUE),
                        'message' => 'Data loaded successfully.'
                    ));
                } else if ($issue == 'confirmmail') { // Send VOucher via Email
                    $mailtosend = filter_input(INPUT_POST, 'mailtosend');
                    $this->load->helper('mailgun');
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'FEE EMAIL VOUCHER';
                    $email_message = $this->load->view('voucher_reprint/' . $inst_id . '/app_voucher_send_mail', $data, true);
                    $subject = "FEE EMAIL VOUCHER";
                    $mailto = $mailtosend;
                    $mailcontent = $email_message;
                    $inst_name = 'The Oxford School';
                    $cc = '';
                    //$cc = "aneeshkhalid@team-sqa.com,ashref@team-sqa.com";
                    send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

                    echo json_encode(array(
                        'status' => 3,
                        'message' => 'Mail Sent.'
                    ));
                } else {
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'REGISTRATION FEE VOUCHER' . ($issue == 'reprint' ? ' - Duplicate' : '');
                    echo json_encode(array(
                        'status' => 1,
                        'view' => $this->load->view('voucher_reprint/' . $inst_id . '/application_voucher_printing', $data, TRUE),
                        'message' => 'Data loaded successfully.'
                    ));
                }
            } else {
                if ($issue == 'reprint') {
                    //$data['user_name'] = $this->session->userdata('user_name');
                    //$data['title'] = 'RECEIPT - Duplicate';
                    //$data['bread_crumps'] = 'Fees Management > RECEIPT Re-printing';
                    //$data['filename_report'] = "assets/vouchers/voucher_".$voucher_code."_".$inst_id.".pdf";
                    //$data['viewname'] = 'voucher_reprint/voucher_printing';
                    //$filename = $this->get_pdf_report($data);
                    //echo $filename;    
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'FEE VOUCHER - Duplicate';
                    echo json_encode(array(
                        'status' => 1,
                        'view' => $this->load->view('voucher_reprint/' . $inst_id . '/voucher_fresh_printing', $data, TRUE),
                        'message' => 'Data loaded successfully.'
                    ));
                } else if ($issue == 'sendmail') {
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'FEE EMAIL VOUCHER';
                    echo json_encode(array(
                        'status' => 1,
                        'view' => $this->load->view('voucher_reprint/' . $inst_id . '/voucher_view_email', $data, TRUE),
                        'message' => 'Data loaded successfully.'
                    ));
                } else if ($issue == 'confirmmail') { // Send VOucher via Email
                    $mailtosend = filter_input(INPUT_POST, 'mailtosend');
                    $this->load->helper('mailgun');
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'FEE EMAIL VOUCHER';
                    $email_message = $this->load->view('voucher_reprint/' . $inst_id . '/voucher_send_mail', $data, true);
                    $subject = "FEE EMAIL VOUCHER";
                    $mailto = $mailtosend;
                    $mailcontent = $email_message;
                    $cc = '';
                    //$cc = "aneeshkhalid@team-sqa.com,ashref@team-sqa.com";
                    send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

                    echo json_encode(array(
                        'status' => 3,
                        'message' => 'Mail Sent.'
                    ));
                } else {
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'FEE VOUCHER';
                    echo json_encode(array(
                        'status' => 1,
                        'view' => $this->load->view('voucher_reprint/' . $inst_id . '/voucher_fresh_printing', $data, TRUE),
                        'message' => 'Data loaded successfully.'
                    ));
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function search_studentname_for_voucher_reprint()
    { //display students list on search
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
            $data['view_type'] = 'profile_search_result';
            $data['user_name'] = $this->session->userdata('user_name');
            echo json_encode(array('status' => 1, 'view' => $this->load->view('voucher_reprint/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function search_voucher_number()
    {
        if ($this->input->is_ajax_request() == 1) {
            $voucher_type = filter_input(INPUT_POST, 'voucher_type', FILTER_SANITIZE_STRING);
            $voucherno = filter_input(INPUT_POST, 'voucherno', FILTER_SANITIZE_NUMBER_INT);
            $search_type = filter_input(INPUT_POST, 'search_type');
            $details_data = $this->MFee_collection->voucher_search($voucher_type, $voucherno);
            // dev_export($details_data);
            // die;
            if ($details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['view_type'] = 'voucher_search_result';
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['view_type'] = 'voucher_search_result';
                $data['message'] = $details_data['message'];
            }
            if ($search_type == 'cancel') {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('voucher_cancel/profile_search_result', $data, TRUE)));
            } else {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('voucher_reprint/profile_search_result', $data, TRUE)));
            }
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function advancesearch_studentname_for_voucher_reprint()
    { //display students list on search
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
                $data['view_type'] = 'profile_search_result';
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
                $data['view_type'] = 'profile_search_result';
            }
            //dev_export($data); die;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('voucher_reprint/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    //Voucher Summary - Reprint
    public function show_fee_voucher_for_reprint()
    {

        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);

            $voucher_id_from_search = filter_input(INPUT_POST, 'voucher_id');
            $voucher_code_from_search = filter_input(INPUT_POST, 'voucher_code');
            $voucher_type = filter_input(INPUT_POST, 'voucher_type');
            $admn_no = filter_input(INPUT_POST, 'admn_no');
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            // dev_export($voucher_id_from_search);
            // die;
            if ($voucher_type == 'REGFEE') {
                $voucher_details = $this->MFee_collection->get_voucher_data_for_reprint($student_id, $inst_id, $acd_year_id, $voucher_type);
            } else {
                $voucher_details = $this->MFee_collection->get_voucher_data_for_reprint($student_id, $inst_id, $acd_year_id, '');
            }
            // dev_export($voucher_details);
            // die;
            if (isset($voucher_details['data']) && !empty($voucher_details['data'])) {
                $voucher_data = $voucher_details['data'];
            } else {
                $voucher_data = NULL;
            }
            if ($voucher_type == 'APR') {
                $student_data = array(
                    "student_name" => $student_name,
                    "Admn_No" => $admn_no,
                    "voucher_type" => $voucher_type
                );
            } else if ($voucher_type == 'REGFEE') {
                $student_data = array(
                    "student_name" => $student_name,
                    "Admn_No" => $admn_no,
                    "voucher_type" => $voucher_type
                );
            } else {
                $details_data = $this->MRegistration->get_profiles_student($student_id);
                if (isset($details_data['data'][0]) && !empty($details_data['data'][0])) {
                    $student_data = $details_data['data'][0];
                } else {
                    $student_data = NULL;
                }
            }

            // dev_export($student_data);
            // die;
            $data = array(
                'sub_title' => 'VOUCHER REPRINT',
                'student_id' => $student_id,
                'student_name' => $student_name,
                'voucher_data' => $voucher_data,
                'student' => $student_data,
                'voucher_id_from_search' => $voucher_id_from_search,
                'voucher_code_from_search' => $voucher_code_from_search,
                'voucher_type' => $voucher_type
            );

            echo json_encode(array(
                'status' => 1,
                'view' => $this->load->view('voucher_reprint/voucher_summary', $data, TRUE),
                'message' => 'Data loaded successfully.'
            ));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    //Voucher Details View - reprint
    public function show_fee_voucher_details_for_reprint()
    {

        if ($this->input->is_ajax_request() == 1) {
            $voucher_id = filter_input(INPUT_POST, 'voucher_id', FILTER_SANITIZE_STRING);
            $voucher_code = filter_input(INPUT_POST, 'voucher_code', FILTER_SANITIZE_STRING);
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $vtype = filter_input(INPUT_POST, 'vtype');
            $vvtype = $vtype;
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $voucher_details = $this->MFee_collection->get_voucher_details($voucher_id, $inst_id, $acd_year_id, 'get_voucher_data_by_id_for_reprint', $vtype);
            // dev_export($voucher_details);
            // die;
            if (isset($voucher_details['data']) && !empty($voucher_details['data'])) {
                $voucher_data = (isset($voucher_details['data'][0]['VOUCHER_DATA']) && !empty($voucher_details['data'][0]['VOUCHER_DATA'])) ? json_decode($voucher_details['data'][0]['VOUCHER_DATA'], TRUE) : NULL;
                $pay_data = (isset($voucher_details['data'][0]['PAY_DATA']) && !empty($voucher_details['data'][0]['PAY_DATA'])) ? json_decode($voucher_details['data'][0]['PAY_DATA'], TRUE) : NULL;
                $student_data = (isset($voucher_details['data'][0]['STUDENT_TRANS_INFO']) && !empty($voucher_details['data'][0]['STUDENT_TRANS_INFO'])) ? json_decode($voucher_details['data'][0]['STUDENT_TRANS_INFO'], TRUE) : NULL;
                $wallet_data = (isset($voucher_details['data'][0]['WALLET_DATA']) && !empty($voucher_details['data'][0]['WALLET_DATA'])) ? json_decode($voucher_details['data'][0]['WALLET_DATA'], TRUE) : NULL;
                $master_data = (isset($voucher_details['data'][0]['MASTER_DATA']) && !empty($voucher_details['data'][0]['MASTER_DATA'])) ? json_decode($voucher_details['data'][0]['MASTER_DATA'], TRUE) : NULL;
                $transaction_type = $voucher_details['data'][0]['TRANS_TYPE'];
                $TERM_DATA = (isset($voucher_details['data'][0]['TERM_DATA']) && !empty($voucher_details['data'][0]['TERM_DATA'])) ? json_decode($voucher_details['data'][0]['TERM_DATA'], TRUE) : NULL;
            } else {
                $voucher_data = NULL;
                $pay_data = NULL;
                $student_data = NULL;
                $wallet_data = NULL;
                $master_data = NULL;
                $transaction_type = 0;
                $TERM_DATA = NULL;
            }
            $term_details = array();
            if ($TERM_DATA != NULL) {
                $termarray = array();
                foreach ($TERM_DATA as $tdls) {

                    $start    = (new DateTime($tdls['term_fromdate']))->modify('first day of this month');
                    $end      = (new DateTime($tdls['term_todate']))->modify('first day of next month');
                    $interval = DateInterval::createFromDateString('1 month');
                    $period   = new DatePeriod($start, $interval, $end);

                    $termarray[$tdls['term_id']]['term_name'] = $tdls['Term_Name'];
                    // foreach ($period as $dt) {
                    //     $termarray[$tdls['term_id']]['terms'][] = $dt->format("Y-m-d");
                    // }
                }
                $term_details = $termarray;
            }

            $st_details_data = $this->MRegistration->get_profiles_student($student_id);
            if (isset($st_details_data['data'][0]) && !empty($st_details_data['data'][0])) {
                $student_master_data = $st_details_data['data'][0];
            } else {
                $student_master_data = NULL;
            }
            // dev_export($student_data);
            // die;
            if (isset($student_data[0]['roundoff']) && $student_data[0]['roundoff'] != 0) {
                $roundoffarray = array(
                    'transaction_desc' => 'Round Off',
                    'transaction_amount' => $student_data[0]['roundoff'],
                    'vat_percent' => 0,
                    'vat_amount' => 0,
                    'is_service_charge' => 0,
                );
                array_push($student_data, $roundoffarray);
            }
            $sarr = array();
            if (!empty($student_data)) {
                foreach ($student_data as $sd) {
                    $sarr[] = $sd;
                    if (isset($sd['vtype'])) $vtype = $sd['vtype'];
                    else $vtype = 0;
                    if (isset($sd['penalty_amt']) && $sd['penalty_amt'] != 0 && ($vtype == 2 && $sd['penalty_only'] == 0)) {
                        $roundoffarray = array(
                            'transaction_desc' => 'Penalty ' . $sd['transaction_desc'],
                            'transaction_amount' => $sd['penalty_amt'],
                            'vat_percent' => 0,
                            'vat_amount' => 0,
                            'is_service_charge' => 0,
                            'demandmonth' => $sd['demandmonth']
                        );
                        // array_push($student_data, $roundoffarray);
                        $sarr[] = $roundoffarray;
                    }
                }
            }
            if (!empty($sarr)) $student_data = $sarr;
            $data = array(
                'voucher_id' => $voucher_id,
                'voucher_code' => $voucher_code,
                'voucher_data' => $voucher_data,
                'pay_data' => $pay_data,
                'student_account' => $student_data, //$sarr,
                'student_details' => $student_master_data,
                'wallet_account' => $wallet_data,
                'master_data' => $master_data,
                'transaction_type' => $transaction_type,
                'TERM_DATA' => $term_details,
                'vvtype' => $vvtype
            );
            echo json_encode(array(
                'status' => 1,
                'view' => $this->load->view('voucher_reprint/voucher_details_view', $data, TRUE),
                'message' => 'Data loaded successfully.'
            ));
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function array_insert(&$array, $position, $insert)
    {
        if (is_int($position)) {
            array_splice($array, $position, 0, $insert);
        } else {
            $pos   = array_search($position, array_keys($array));
            $array = array_merge(
                array_slice($array, 0, $pos),
                $insert,
                array_slice($array, $pos)
            );
        }
    }

    //Set Wallet min amount
    public function set_min_wallet_amount()
    {
        if ($this->input->is_ajax_request() == 1) {
            $to_email = filter_input(INPUT_POST, 'to_email');
            $amount_limit = filter_input(INPUT_POST, 'amount_limit');
            $student_id = filter_input(INPUT_POST, 'student_id');
            $student_name = filter_input(INPUT_POST, 'stud_name');
            $Admn_No = filter_input(INPUT_POST, 'admn_no');
            $batch = filter_input(INPUT_POST, 'batch');
            $update_email = filter_input(INPUT_POST, 'update_email');
            $father_id = filter_input(INPUT_POST, 'father_id');
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $data_to_save = array(
                'action'                => 'set_min_wallet_amount',
                'controller_function'   => 'Fees_settings/Fee_collection_controller/set_min_wallet_amount',
                'student_id'            => $student_id,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id,
                'amount_limit'          => $amount_limit,
                'update_email'          => $update_email,
                'to_email'              => $to_email,
                'father_id'             => $father_id
            );

            $setwallet_amount = $this->MFee_collection->set_min_wallet_amount($data_to_save);
            // dev_export($setwallet_amount);
            // die;
            if (isset($setwallet_amount['data_status']) && !empty($setwallet_amount['data_status']) && $setwallet_amount['data_status'] == 1) {

                //** */
                $this->load->helper('mailgun');
                $data['user_name'] = $this->session->userdata('user_name');

                $institution_name = $this->get_institution_name($inst_id);
                // $email_message = $this->load->view('voucher_reprint/' . $inst_id . '/voucher_send_mail', $data, true);
                $portal_url = str_replace('Docme-UI', 'Portal', base_url());
                $email_message = 'Dear Parent,<br/>';
                $email_message = 'Please pay the minimum fee amount of ' . $amount_limit . ' as per the special sanction by principal from the below link.<br/>';
                $email_message .= 'Institution Name :' . $institution_name . '<br/>';
                $email_message .= 'Payment Link : ' . $portal_url . 'payment-wallet/' . base64_encode($Admn_No) . '/' . $inst_id;
                $subject = "Minimum Fee Payment:$Admn_No-$student_name";
                $mailto = $to_email;
                $mailcontent = $email_message;
                $cc = '';
                send_smtp_mailer($subject, $mailto, $mailcontent, $cc);



                $email_message = "Minimum Fee Amount sanctioned by Principal the details are as follows<br/><br/>";
                $email_message .= "Payment Amount : " . $amount_limit . " <br/>";
                $email_message .= "Institution Name : " . $institution_name . " <br/>";
                $email_message .= "Student Admission No : " . $Admn_No .  " <br/>";
                $email_message .= "Student Name : " . $student_name . " <br/>";

                $subject = "Principal Sanction for Min Fee Payment : $Admn_No-$student_name";
                $mailto_sp = $this->get_support_email($inst_id);
                $mailcontent = $email_message;
                $email_res = send_smtp_mailer($subject, $mailto_sp, $mailcontent, $cc = '');

                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Mail Sent.'
                ));
                //** */
                // echo json_encode(array('status' => 1, 'message' => 'Success'));
                return true;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Failed'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    //FORMATING PDF REPORT
    private function get_pdf_report($data)
    {
        $pdfFilePath = FCPATH . $data['filename_report'];
        if (file_exists($pdfFilePath) == FALSE) {
            ini_set('memory_limit', '320M'); // boost the memory limit if it's low 

            $this->load->library('pdf'); //Load PDF Library
            $pdf = $this->pdf->load(); //Set Orientation
            date_default_timezone_set('Asia/Kolkata'); //timezone need to change according to country                    
            // render the view into HTML
            $html = $this->load->view($data['viewname'], $data, true);
            $pdf->WriteHTML($html); // write the HTML into the PDF
            $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file 
        }
        return base_url($data['filename_report']);
    }

    /*
     * Functionalities for voucher cancel
     */

    public function get_voucher_details()
    {

        if ($this->input->is_ajax_request() == 1) {
            $voucher_id = filter_input(INPUT_POST, 'voucher_id', FILTER_SANITIZE_STRING);
            $voucher_code = filter_input(INPUT_POST, 'voucher_code', FILTER_SANITIZE_STRING);
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $voucher_details = $this->MFee_collection->get_voucher_details_for_cancellation($voucher_id, $inst_id, $acd_year_id);

            if (isset($voucher_details['data']) && !empty($voucher_details['data'])) {
                $voucher_data = (isset($voucher_details['data'][0]['VOUCHER_DATA']) && !empty($voucher_details['data'][0]['VOUCHER_DATA'])) ? json_decode($voucher_details['data'][0]['VOUCHER_DATA'], TRUE) : NULL;
                $pay_data = (isset($voucher_details['data'][0]['PAY_DATA']) && !empty($voucher_details['data'][0]['PAY_DATA'])) ? json_decode($voucher_details['data'][0]['PAY_DATA'], TRUE) : NULL;
                $student_data = (isset($voucher_details['data'][0]['STUDENT_TRANS_INFO']) && !empty($voucher_details['data'][0]['STUDENT_TRANS_INFO'])) ? json_decode($voucher_details['data'][0]['STUDENT_TRANS_INFO'], TRUE) : NULL;
                $wallet_data = (isset($voucher_details['data'][0]['WALLET_DATA']) && !empty($voucher_details['data'][0]['WALLET_DATA'])) ? json_decode($voucher_details['data'][0]['WALLET_DATA'], TRUE) : NULL;
                $master_data = (isset($voucher_details['data'][0]['MASTER_DATA']) && !empty($voucher_details['data'][0]['MASTER_DATA'])) ? json_decode($voucher_details['data'][0]['MASTER_DATA'], TRUE) : NULL;
                $transaction_type = $voucher_details['data'][0]['TRANS_TYPE'];
            } else {
                $voucher_data = NULL;
                $pay_data = NULL;
                $student_data = NULL;
                $wallet_data = NULL;
                $master_data = NULL;
                $transaction_type = 0;
            }
            // dev_export($voucher_details);
            // die;
            if (isset($student_data[0]['roundoff']) && $student_data[0]['roundoff'] != 0) {
                $roundoffarray = array(
                    'transaction_desc' => 'Round Off',
                    'transaction_amount' => $student_data[0]['roundoff'],
                    'vat_percent' => 0,
                    'vat_amount' => 0,
                    'is_service_charge' => 0,
                );
                array_push($student_data, $roundoffarray);
            }
            $i = 0;
            $sarr = array();
            if (!empty($student_data)) {
                foreach ($student_data as $sd) {
                    $sarr[] = $sd;

                    // if (isset($sd['penalty_amt']) && $sd['penalty_amt'] != 0) {
                    if (isset($sd['penalty_amt']) && $sd['penalty_amt'] != 0  && ($sd['vtype'] == 2 && $sd['penalty_only'] == 0)) {
                        $roundoffarray = array(
                            'transaction_desc' => 'Penalty ' . $sd['transaction_desc'],
                            'transaction_amount' => $sd['penalty_amt'],
                            'vat_percent' => 0,
                            'vat_amount' => 0,
                            'is_service_charge' => 0,
                            'demandmonth' => $sd['demandmonth']
                        );
                        $sarr[] = $roundoffarray;
                        // array_unshift($sd, $roundoffarray);
                        // array_splice($student_data, ($i + 1), 0, $roundoffarray);
                        //$student_data[$i] = $roundoffarray;
                        // $this->array_insert($student_data, $i, $roundoffarray);
                        // break;
                        // array_push($student_data, $roundoffarray);
                        // array_push($resarray[0], $roundoffarray);

                        // $array1 = array();
                        // $array2 = array();
                        // $array1 = array_slice($student_data, 0, ($i + 1));
                        // $array2 = array_slice($student_data, ($i + 1));
                        // array_push($array1, $roundoffarray);
                        // $student_data = array_merge($array1, $array2);
                    }
                    $i++;
                }
            }
            // dev_export($sarr);
            // die;
            if (!empty($sarr)) $student_data = $sarr;
            $data = array(
                'voucher_id' => $voucher_id,
                'voucher_code' => $voucher_code,
                'voucher_data' => $voucher_data,
                'pay_data' => $pay_data,
                'student_account' => $student_data, //,$sarr
                'wallet_account' => $wallet_data,
                'master_data' => $master_data,
                'transaction_type' => $transaction_type
            );
            echo json_encode(array(
                'status' => 1,
                'view' => $this->load->view('voucher_cancel/voucher_details_view', $data, TRUE),
                'message' => 'Data loaded successfully.'
            ));
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function get_student_filter_for_voucher_cancel()
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


        $this->load->view('voucher_cancel/student_filter', $data);
    }

    public function search_byname_voucher_cancel()
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
            echo json_encode(array('status' => 1, 'view' => $this->load->view('voucher_cancel/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function advancesearch_byname_voucher_cancel()
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
            echo json_encode(array('status' => 1, 'view' => $this->load->view('voucher_cancel/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function batchlist_voucher_cancel()
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

    public function show_fee_student_voucher_cancel()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $voucher_id = filter_input(INPUT_POST, 'voucher_id');
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $voucher_details = $this->MFee_collection->get_voucher_data_for_cancel($student_id, $inst_id, $acd_year_id);

            if (isset($voucher_details['data']) && !empty($voucher_details['data'])) {
                $voucher_data = $voucher_details['data'];
            } else {
                $voucher_data = NULL;
            }

            $details_data = $this->MRegistration->get_profiles_student($student_id);
            if (isset($details_data['data'][0]) && !empty($details_data['data'][0])) {
                $student_data = $details_data['data'][0];
            } else {
                $student_data = NULL;
            }
            $data = array(
                'sub_title' => 'VOUCHER CANCELLATION',
                'student_id' => $student_id,
                'student_name' => $student_name,
                'voucher_data' => $voucher_data,
                'student' => $student_data,
                'voucher_id_selected' => $voucher_id
            );

            echo json_encode(array(
                'status' => 1,
                'view' => $this->load->view('voucher_cancel/voucher_summary', $data, TRUE),
                'message' => 'Data loaded successfully.'
            ));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function save_voucher_cancel()
    {
        if ($this->input->is_ajax_request() == 1) {
            $voucher_id = filter_input(INPUT_POST, 'voucher_id', FILTER_SANITIZE_STRING);
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $reason = filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING);
            if (strlen($reason) < 5) {
                echo json_encode(array('status' => 2, 'message' => 'Reason is mandatory and should have 5 characters'));
                return;
            }

            $cancel_status = $this->MFee_collection->save_voucher_cancellation_by_voucher_id($voucher_id, $inst_id, $acd_year_id, $student_id, $reason);

            if (isset($cancel_status[0]['voucher_cancel_status']) && !empty($cancel_status[0]['voucher_cancel_status']) && $cancel_status[0]['voucher_cancel_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Voucher cancelled successfully'));
                return;
            } else {
                if (isset($cancel_status[0]['ErrorMessage']) && !empty($cancel_status[0]['ErrorMessage'])) {
                    echo json_encode(array('status' => 2, 'message' => $cancel_status[0]['ErrorMessage']));
                    return;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please contact administrator or try again later'));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }



    public function show_counter_collection()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $user_id = $this->session->userdata('userid');
            $transact = array(
                'CASH' => array(
                    'dr' => 0,
                    'cr' => 0
                ),
                'CHEQUE' => array(
                    'dr' => 0,
                    'cr' => 0
                ),
                'CARD' => array(
                    'dr' => 0,
                    'cr' => 0
                ),
                'TRANSFER' => array(
                    'dr' => 0,
                    'cr' => 0
                ),
                'ONLINE' => array(
                    'dr' => 0,
                    'cr' => 0
                ),
                'CARD_SERVICE_CHARGE' => array(
                    'dr' => 0,
                    'cr' => 0
                ),
                'EXEMPTION' => array(
                    'dr' => 0,
                    'cr' => 0
                ),
                'CONCESSION' => array(
                    'dr' => 0,
                    'cr' => 0
                )
            );
            $collection_data = $this->MFee_collection->get_fee_counter_collection($inst_id, $acd_year_id, $user_id);
            // dev_export($collection_data);
            // die;
            if (isset($collection_data) && !empty($collection_data)) {
                $transact['CONCESSION']['cr'] = $collection_data[0]['CONC_COLLECTED'];
                $transact['EXEMPTION']['cr'] = $collection_data[0]['EXPN_COLLECTED'];
                foreach ($collection_data as $collector) {
                    if ($collector['payment_type_name'] == 'CASH') {
                        if ($collector['transaction_type'] == 1) {
                            $transact['CASH']['dr'] = $collector['TRANSACTION_AMT'];
                        } else if ($collector['transaction_type'] == 0) {
                            $transact['CASH']['cr'] = $collector['TRANSACTION_AMT'];
                        }
                    }
                    if ($collector['payment_type_name'] == 'CARD') {
                        if ($collector['transaction_type'] == 1) {
                            $transact['CARD']['dr'] = $collector['TRANSACTION_AMT'];
                            $transact['CARD_SERVICE_CHARGE']['dr'] = $collector['SERVICE_CHARGE_COLLECTED'];
                        } else if ($collector['transaction_type'] == 0) {
                            $transact['CARD']['cr'] = $collector['TRANSACTION_AMT'];
                            $transact['CARD_SERVICE_CHARGE']['cr'] = $collector['SERVICE_CHARGE_COLLECTED'];
                        }
                    }
                    if ($collector['payment_type_name'] == 'CHEQUE') {
                        if ($collector['transaction_type'] == 1) {
                            $transact['CHEQUE']['dr'] = $collector['TRANSACTION_AMT'];
                        } else if ($collector['transaction_type'] == 0) {
                            // Here reduce not recon cheque amt from cheque collected to avoid doubling the amount
                            // in cheque received box and non recon box
                            $transact['CHEQUE']['cr'] += $collector['TRANSACTION_AMT']; // - $collector['NOT_RECON_AMOUNT'];
                        }
                    }
                    if ($collector['payment_type_name'] == 'ONLINE') {
                        if ($collector['transaction_type'] == 1) {
                            $transact['ONLINE']['dr'] = $collector['TRANSACTION_AMT'];
                        } else if ($collector['transaction_type'] == 0) {
                            $transact['ONLINE']['cr'] = $collector['TRANSACTION_AMT'];
                        }
                    }
                    if ($collector['payment_type_name'] == 'DIRECT BANK') {
                        if ($collector['transaction_type'] == 1) {
                            $transact['DBT']['dr'] = $collector['TRANSACTION_AMT'];
                        } else if ($collector['transaction_type'] == 0) {
                            $transact['DBT']['cr'] = $collector['TRANSACTION_AMT'];
                        }
                    }
                    if ($collector['payment_type_name'] == 'TRANSFER') {
                        if ($collector['transaction_type'] == 1) {
                            $transact['TRANSFER']['dr'] = $collector['TRANSACTION_AMT'];
                        } else if ($collector['transaction_type'] == 0) {
                            $transact['TRANSFER']['cr'] = $collector['TRANSACTION_AMT'];
                        }
                        // else if ($collector['transaction_type'] == 2) {
                        //     $transact['EXEMPTION']['cr'] = $collector['TRANSACTION_AMT'];
                        // }
                        // else if ($collector['transaction_type'] == 3) {
                        //     $transact['CONCESSION']['cr'] = $collector['TRANSACTION_AMT'];
                        // }
                    }
                    $transact['CHEQUE_TO_RECONCILE']['cr'] = $collector['NOT_RECON_AMOUNT'];
                }
            }



            $data['transactions'] = $transact;
            $data['sub_title'] = 'Counter Collection'; // Data
            echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_collection/counter_collection', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_student_filter_for_collection_one_time()
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


        $this->load->view('fee_one_time_pay/student_filter', $data);
    }

    public function batchlist_one_time_pay()
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

    public function advancesearch_byname_for_one_time()
    {                                               //display students list on search
        $data['title'] = 'STUDENTS LIST';

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $data_prep['batch_id'] = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['stream_id'] = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['class_id'] = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['curent_acdyr'] = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['searchname'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));

            $data['batch_id'] = $data_prep['batch_id'];
            $data['stream_id'] = $data_prep['stream_id'];
            $data['class_id'] = $data_prep['class_id'];
            $data['academic_year'] = $data_prep['curent_acdyr'];


            if ($data_prep['stream_id'] == -1) {
                $data_prep['stream_id'] = '';
            }
            if ($data_prep['curent_acdyr'] == -1) {
                $data_prep['curent_acdyr'] = '';
            }
            if ($data_prep['class_id'] == -1) {
                $data_prep['class_id'] = '';
            }
            $details_data = $this->MFee_collection->studentadvance_search_for_one_time_pay($data_prep);

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $batch_name = filter_input(INPUT_POST, 'batch_name', FILTER_SANITIZE_STRING);
            $data['batch_name'] = $batch_name;
            $data['sub_title'] = 'STUDENTS FOR THE BATCH ' . $batch_name;

            echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_one_time_pay/show_one_time_pay_students', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_one_time_payment_by_wallet()
    {
        //if ($this->input->is_ajax_request() == 1) {
        $batch_id = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
        $student_data_raw = filter_input(INPUT_POST, 'student_data');

        $inst_id = $this->session->userdata('inst_id');
        $acd_year_id = $this->session->userdata('acd_year');


        $data_prep = array(
            'action' => 'save_one_time_adjustment_with_wallet_to_pending_pay',
            'student_data' => $student_data_raw,
            'batch_id' => $batch_id,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id
        );
        //dev_export($data_prep); die;
        $pay_status = $this->MFee_collection->save_pay_for_one_time_by_wallet($data_prep);

        if (isset($pay_status['status']) && !empty($pay_status['status']) && $pay_status['status'] == 1) {
            echo json_encode(array('status' => 1, 'message' => 'Voucher cancelled successfully', 'failed_data' => $pay_status['failed_students']));
            return;
        } else {

            if (isset($pay_status['status']) && !empty($pay_status['status']) && $pay_status['status'] == 3) {
                $failed_student = $pay_status['failed_students'];
                $student_name = array();
                if (count($failed_student) > 0) {
                    foreach ($failed_student as $fstudent) {
                        $student_name[] = $fstudent['student_name'] . "(" . $fstudent['message'] . " )";
                    }
                }

                echo json_encode(array('status' => 2, 'message' => 'Some students accounts cannot be made to pay. The details are as follows, ' . implode(", ", $student_name)));
                return;
            } else {
                if (isset($pay_status[0]['ErrorMessage']) && !empty($pay_status[0]['ErrorMessage'])) {
                    echo json_encode(array('status' => 2, 'message' => $pay_status[0]['ErrorMessage']));
                    return;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please contact administrator or try again later'));
                    return;
                }
            }
        }
        //        } else {
        //            $this->load->view(ERROR_500);
        //        }
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
}
