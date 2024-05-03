<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fee_deallocation_controller
 *
 * @author chandrajith.edsys
 */
class Fee_deallocation_controller extends MX_Controller
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
        $this->load->model('Fee_structure_model', 'MFee_structure');
        $this->load->model('Nondemandfee_model', 'MNondemand_fee');
        $this->load->model('Fees_collection_model', 'MFee_collection');
        $this->load->model('Fee_common_model', 'MFee_common');
        $this->load->model('student_settings/Registration_model', 'MRegistration');
    }

    public function load_fee_deallocation()
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

        $data['sub_title'] = 'Fee Enable / Disable';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Fees Management',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Fee Enable / Disable'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $this->load->view('fee_deallocation/student_filter', $data);
    }

    public function get_fees_demnaded_for_student()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_name = filter_input(INPUT_POST, 'studentname', FILTER_SANITIZE_STRING);
            $searchby = filter_input(INPUT_POST, 'searchby');
            $search_elements = json_decode(filter_input(INPUT_POST, 'search_elements'), true);

            $student_id = strtoupper(filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING));
            $feeid = strtoupper(filter_input(INPUT_POST, 'feeid', FILTER_SANITIZE_NUMBER_INT));
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $details_data = $this->MRegistration->get_profiles_student($student_id);
            if (isset($details_data['data'][0]) && !empty($details_data['data'][0])) {
                $data['student_data'] = $details_data['data'][0];

                $data['acd_year'] = $acd_year_id;
                $data['feeid_selected'] = $feeid;

                $data_to_save = array(
                    'action'                => 'get_fees_demnaded_for_student',
                    'controller_function'   => 'Fees_settings/Fee_collection_controller/get_fees_demnaded_for_student',
                    'inst_id'               => $inst_id,
                    'acd_year_id'           => $acd_year_id,
                    'student_id'            => $student_id
                );
                $allocation_data_for_student = $this->MFee_common->common_function_in_model($data_to_save);
                // dev_export($allocation_data_for_student);
                // die;
                if (isset($allocation_data_for_student['data']['data']) && !empty($allocation_data_for_student['data']['data'])) {
                    $data['fee_data'] = $allocation_data_for_student['data']['data'];
                } else {
                    $data['fee_data'] = 0;
                }

                $data['searchby'] = $searchby;
                $data['student_id'] = $student_id;

                $data['search_elements'] = $search_elements;
                $data['sub_title'] = 'Fee Enable / Disable : Fee demanded for student';


                $data['amount_distributed'] = 0;
                $data['reference_number']   = 0;
                echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_deallocation/fees_demnaded_for_student', $data, TRUE)));
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
    public function view_student_payment_plan()
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
            $feeid = strtoupper(filter_input(INPUT_POST, 'feeid', FILTER_SANITIZE_NUMBER_INT));
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $data['acd_year'] = $acd_year_id;
            $data['feeid_selected'] = $feeid;
            $data['student_name'] = $student_name;
            $data['student_id'] = $student_id;

            $data_to_save = array(
                'action'                => 'get_collection_data_by_student_for_payment_plan',
                'controller_function'   => 'Fees_settings/Fee_collection_controller/get_collection_data_by_student_for_payment_plan',
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id,
                'student_id'            => $student_id,
                'feeid'                 => $feeid
            );
            $allocation_data_for_student = $this->MFee_common->common_function_in_model($data_to_save);
            // dev_export($allocation_data_for_student);
            // die;
            if (isset($allocation_data_for_student['data']['data']) && !empty($allocation_data_for_student['data']['data'])) {
                $data['fee_data'] = $allocation_data_for_student['data']['data'];
            } else {
                $data['fee_data'] = 0;
            }

            $montharray = array();
            if (is_array($allocation_data_for_student['data']['data']) && !empty($allocation_data_for_student['data']['data']['0'])) {
                $array_count = count($allocation_data_for_student['data']['data']);
                if ($array_count == 1) {
                    $demdate = $allocation_data_for_student['data']['data']['0']['DEMAND_DATE'];
                    $startdate = date("Y-m-d", strtotime("+1 month", strtotime($demdate)));
                    $enddate = $this->session->userdata('acd_year_end');
                } else {
                    $startdate = $this->session->userdata('acd_year_start');
                    $enddate = $this->session->userdata('acd_year_end');
                }

                $start    = (new DateTime($startdate))->modify('first day of this month');
                $end      = (new DateTime($enddate))->modify('first day of next month');
                $interval = DateInterval::createFromDateString('1 month');
                $monthlist   = new DatePeriod($start, $interval, $end);
                foreach ($monthlist as $dt) {
                    $monthname = $dt->format("Y-m-d");
                    array_push($montharray, $monthname);
                }
                // foreach($allocation_data_for_student['data'] as $col_data){
                //     if(in_array($col_data['DEM_MONTH'],$montharray)){

                //     }
                // }
            }
            $data['month_list'] = $montharray;
            $data['feeid_sel'] = $feeid;
            $data['demandedfeecodes'] = $allocation_data_for_student['data']['demandedfeecodes'];
            $data['plan_data'] = $allocation_data_for_student['data']['plan_data'];

            if (isset($allocation_data_for_student['summary_data']) && !empty($allocation_data_for_student['summary_data'])) {
                $data['fee_summary'] = ($allocation_data_for_student['summary_data']['PENDING_PAYMENT']);
                $data['e_wallet'] = $allocation_data_for_student['summary_data']['E_WALLET'];
                $data['wallet_withdraw_request_amount'] = $allocation_data_for_student['summary_data']['WALLET_WITHDRAW_REQUEST_AMOUNT'];
            } else {
                $data['fee_summary'] = 0;
                $data['e_wallet'] = 0;
            }
            // }
            // else{
            //     
            // }
            $data['feeid_selected'] = $feeid;
            $data['searchby'] = $searchby;

            $data['search_elements'] = $search_elements;
            $data['sub_title'] = 'Payment Plan Details';


            $data['amount_distributed'] = 0;
            $data['reference_number']   = 0;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_deallocation/payment_plan', $data, TRUE)));
            return true;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function deallocate_fee_of_student()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_name       = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $fee_code_link_data = filter_input(INPUT_POST, 'fee_code_data');
            $demand_details     = json_decode(($fee_code_link_data), TRUE);
            $student_id         = filter_input(INPUT_POST, 'student_id');
            $dealloc_reason         = filter_input(INPUT_POST, 'dealloc_reason');
            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'Please check if valid student is selected.'
                ));
            }
            if (!(isset($dealloc_reason) && !empty($dealloc_reason))) {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'Please check if Deallocation reason entered.'
                ));
            }
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $data_to_save = array(
                'action'                => 'deallocate_fee_of_student',
                'controller_function'   => 'Fees_settings/Fee_structure_controller/deallocate_fee_of_student',
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id,
                'student_id'            => $student_id,
                'dealloc_reason'        => $dealloc_reason,
                'demand_details'        => $demand_details
            );
            $deallocate_fees_of_student = $this->MFee_common->common_function_in_model($data_to_save);
            // dev_export($deallocate_fees_of_student);
            // die;
            if (isset($deallocate_fees_of_student['data']['data_status']) && !empty($deallocate_fees_of_student['data']['data_status']) && $deallocate_fees_of_student['data']['data_status'] == 1) {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Data updated successfully'
                ));
                return true;
            } else {
                echo json_encode(array(
                    'status' => 4,
                    'message' => 'An error encountered. Please try again or contact administrator with the error code UITEMPASGFCOD002'
                ));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function view_templates_for_edit()
    {
        if ($this->input->is_ajax_request() == 1) {
            // $student_name = filter_input(INPUT_POST, 'studentname', FILTER_SANITIZE_STRING);
            // $student_id = strtoupper(filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING));
            $class_id = strtoupper(filter_input(INPUT_POST, 'class_id'));

            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            // $details_data = $this->MRegistration->get_profiles_student($student_id);
            // if (isset($details_data['data'][0]) && !empty($details_data['data'][0])) {
            // $data['student_data'] = $details_data['data'][0];

            $data_to_save = array(
                'action'                => 'get_templates_for_a_class',
                'controller_function'   => 'Fees_settings/Fee_structure_controller/get_templates_for_a_class',
                'class_id'              => $class_id,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id
            );
            $template_data = $this->MFee_structure->get_templates_for_a_class($data_to_save);
            if (isset($template_data['error_status']) && $template_data['error_status'] == 0) {
                if ($template_data['data_status'] == 1) {
                    $data['template_data'] = $template_data['data'];
                } else {
                    $data['template_data'] = FALSE;
                }
            } else {
                $data['template_data'] = FALSE;
            }

            $data['sub_title'] = 'Templates For Edit Fee Allocation';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'title' => 'Fees Management',
                    'link' => base_url()
                ),
                '2' => array(
                    'title' => 'Templates For Edit Fee Allocation'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array(
                'status' => 1,
                'view' => $this->load->view('fee_structure/template_list_of_student', $data, TRUE),
                'message' => 'Template data is loaded'
            ));
            // } else {
            //     $data['details_data'] = NULL;
            //     echo json_encode(array('status' => 2, 'message' => 'Student data is not available.'));
            //     return true;
            // }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
