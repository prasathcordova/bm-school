<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Nondemandfee_controller
 *
 * @author chandrajith.edsys
 */
class Nondemandfee_controller extends MX_Controller
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
        $this->load->model('Nondemandfee_model', 'MNondemand_fee');
        $this->load->model('student_settings/Registration_model', 'MRegistration');
    }

    public function student_filter()
    {
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
        $feecode = filter_input(INPUT_POST, 'feecode', FILTER_SANITIZE_NUMBER_INT);
        $feename = filter_input(INPUT_POST, 'feename', FILTER_SANITIZE_STRING);
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

        $fee_codes_to_link = $this->MNondemand_fee->get_other_fee_codes_for_linking();
        if (isset($fee_codes_to_link['data']) && !empty($fee_codes_to_link['data'])) {
            $data['fee_codes_to_link'] = $fee_codes_to_link['data'];
        } else {
            $data['fee_codes_to_link'] = NULL;
        }
        $data['feecode'] = $feecode;
        $data['feename'] = $feename;

        if ($type == 'class_demand') {
            $feedata = filter_input(INPUT_POST, 'feedata');
            $data['feedata'] = $feedata;
            $this->load->view('nondemand_fee/student_filter_only', $data);
        } else {
            $this->load->view('nondemand_fee/student_filter', $data);
        }
    }

    public function search_byname()
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
            echo json_encode(array('status' => 1, 'view' => $this->load->view('nondemand_fee/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function advancesearch_byname()
    {                                               //display students list on search
        $data['title'] = 'STUDENTS LIST';
        $data['user_name'] = $this->session->userdata('user_name');
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
        if ($this->input->is_ajax_request() == 1) {
            $feecode_sel = filter_input(INPUT_POST, 'feecode_sel');

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
            $inst_id = $this->session->userdata('inst_id');

            if (isset($feecode_sel) && $feecode_sel > 0) {
                $check_other_fee_code_demanded = $this->MNondemand_fee->check_other_fee_code_demanded($feecode_sel, $data_prep['batch_id'], $data_prep['curent_acdyr'], $inst_id);
            } else {
                $check_other_fee_code_demanded = NULL;
            }
            // dev_export($check_other_fee_code_demanded);
            // die;
            $data['already_in_list'] = $check_other_fee_code_demanded['data']['student_list'];
            $details_data = $this->MNondemand_fee->studentadvance_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            if ($type == 'class_demand') {
                $feedata = filter_input(INPUT_POST, 'feedata');
                $data['feedata'] = $feedata;
                echo json_encode(array('status' => 1, 'view' => $this->load->view('nondemand_fee/student_list_in_class', $data, TRUE)));
            } else {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('nondemand_fee/profile_search_result', $data, TRUE)));
            }
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

    public function show_nonperiodicfee_details()
    {
        if ($this->input->is_ajax_request() == 1) {

            $student_name = filter_input(INPUT_POST, 'studentname', FILTER_SANITIZE_STRING);
            $student_id = strtoupper(filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING));
            $details_data = $this->MRegistration->get_profiles_student($student_id);
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['details_data'] = $details_data['data'];
            } else {
                $data['details_data'] = NULL;
            }
            $feecodes_linked = $this->MNondemand_fee->get_other_fee_codes_linked($student_id);
            $aid = array();
            if (isset($feecodes_linked['data']) && !empty($feecodes_linked['data'])) {
                foreach ($feecodes_linked['data'] as $fc) {
                    $aid[] = $fc['fee_code_id'];
                }
                $data['feecodes_linked'] = $aid;
            } else {
                $data['feecodes_linked'] = NULL;
            }
            //dev_export($data['feecodes_linked']);die;

            $fee_codes_to_link = $this->MNondemand_fee->get_other_fee_codes_for_linking();
            if (isset($fee_codes_to_link['data']) && !empty($fee_codes_to_link['data'])) {
                $data['fee_codes_to_link'] = $fee_codes_to_link['data'];
            } else {
                $data['fee_codes_to_link'] = NULL;
            }
            $data['sub_title'] = "OTHER FEE ALLOCATION FOR - " . $student_name;
            $this->load->view('nondemand_fee/non_demanding_fee_structure', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function show_periodicfee_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_name = filter_input(INPUT_POST, 'studentname', FILTER_SANITIZE_STRING);
            $student_id = strtoupper(filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING));
            $details_data = $this->MRegistration->get_profiles_student($student_id);
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['details_data'] = $details_data['data'];
            } else {
                $data['details_data'] = NULL;
            }
            $fee_codes_to_link = $this->MNondemand_fee->get_other_fee_codes_for_linking_periodic();
            //            dev_export($fee_codes_to_link);die;
            if (isset($fee_codes_to_link['data']) && !empty($fee_codes_to_link['data'])) {
                $data['fee_codes_to_link'] = $fee_codes_to_link['data'];
            } else {
                $data['fee_codes_to_link'] = NULL;
            }
            $data['sub_title'] = "OTHER FEE ALLOCATION FOR - " . $student_name;
            $this->load->view('nondemand_fee/demanding_fee_structure', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_other_fee_allocation()
    {
        if ($this->input->is_ajax_request() == 1) {
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
            if ($type == 'class_demand') {
                $fee_code_data = filter_input(INPUT_POST, 'fee_code_data');
                $feecode_id = filter_input(INPUT_POST, 'feecode_id', FILTER_SANITIZE_STRING);
                $feeamount = filter_input(INPUT_POST, 'feeamount', FILTER_SANITIZE_STRING);
                $student_data = filter_input(INPUT_POST, 'student_allocation_data');
                $activation_date = filter_input(INPUT_POST, 'activation_date');
                if (null !== (json_decode($fee_code_data, TRUE)) && !empty(json_decode($fee_code_data, TRUE)) && count(json_decode($fee_code_data, TRUE)) > 0) {
                    $allocation_status = $this->MNondemand_fee->save_other_fee_allocation_classwise($fee_code_data, $feecode_id, $student_data, $feeamount, $activation_date);

                    if (isset($allocation_status['data_status']) && !empty($allocation_status['data_status']) && $allocation_status['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'message' => 'Data successfully updated'));
                        return true;
                    } else {
                        if (isset($allocation_status['message']) && !empty($allocation_status['message'])) {
                            echo json_encode(array('status' => 3, 'message' => $allocation_status['message']));
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'An error encountered. Please contact administrator for assistance.'));
                            return true;
                        }
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Atleast one Fee Code must be added to allocate fee'));
                    return true;
                }
            } else {
                $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
                $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
                $activation_date = filter_input(INPUT_POST, 'activation_date');
                $fee_code_data = filter_input(INPUT_POST, 'fee_code_data');
                if (null !== ($student_id) && !empty($student_id) && null !== (json_decode($fee_code_data, TRUE)) && !empty(json_decode($fee_code_data, TRUE)) && count(json_decode($fee_code_data, TRUE)) > 0) {
                    $data_to_save = array(
                        'action' => 'save_other_fee_allocation',
                        'student_id' => $student_id,
                        'fee_code_data' => $fee_code_data,
                        'inst_id' => $this->session->userdata('inst_id'),
                        'acd_year_id' => $this->session->userdata('acd_year'),
                        'activation_date' => $activation_date
                    );
                    $allocation_status = $this->MNondemand_fee->allocate_non_demand_fee_for_student($data_to_save);
                    // dev_export($allocation_status);
                    // die;
                    if (isset($allocation_status['data_status']) && !empty($allocation_status['data_status']) && $allocation_status['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'message' => 'Data successfully updated'));
                        return true;
                    } else {
                        if (isset($allocation_status['message']) && !empty($allocation_status['message'])) {
                            echo json_encode(array('status' => 3, 'message' => $allocation_status['message']));
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'An error encountered. Please contact administrator for assistance.'));
                            return true;
                        }
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Atleast one Fee Code must be added to allocate fee'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function save_periodic_fee_allocation()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $activation_date = filter_input(INPUT_POST, 'activation_date', FILTER_SANITIZE_STRING);
            $remarks = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);
            $fee_code_data = filter_input(INPUT_POST, 'fee_code_data');
            if (null !== ($student_id) && !empty($student_id) && null !== (json_decode($fee_code_data, TRUE)) && !empty(json_decode($fee_code_data, TRUE)) && count(json_decode($fee_code_data, TRUE)) > 0) {
                $data_to_save = array(
                    'action' => 'save_demand_fee_allocation_individual',
                    'student_id' => $student_id,
                    'fee_code_data' => $fee_code_data,
                    'inst_id' => $this->session->userdata('inst_id'),
                    'acd_year_id' => $this->session->userdata('acd_year'),
                    'activation_date' => $activation_date,
                    'remarks' => $remarks
                );

                $allocation_status = $this->MNondemand_fee->allocate_periodic_fee_for_student($data_to_save);
                //                dev_export($data_to_save);die;
                if (isset($allocation_status['data_status']) && !empty($allocation_status['data_status']) && $allocation_status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data successfully updated'));
                    return true;
                } else {
                    if (isset($allocation_status['message']) && !empty($allocation_status['message'])) {
                        echo json_encode(array('status' => 3, 'message' => $allocation_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'An error encountered. Please contact administrator for assistance.'));
                        return true;
                    }
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Atleast one Fee Code must be added to allocate fee'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
