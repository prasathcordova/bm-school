<?php

/**
 * Description of Tc_management_controller
 *
 * @author chandrajith.edsys
 */
class Tc_management_controller extends MX_Controller
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
        $this->load->model('Tc_model', 'MTC');
        $this->load->model('student_settings/Student_Model', 'MStudent');
        $this->load->model('fees/Fees_collection_model', 'MFee_collection');
    }

    public function show_class_categorytcprep()
    {
        //        $data['template'] = 'tc/student_filter';
        $data['template'] = 'tc/student_filter_for_profile';
        $data['title'] = 'TC';
        $data['sub_title'] = 'TC Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'TC Management'
            ),
            //add path by vinoth @28-05-2019 14:09
            '2' => array(
                'title' => 'TC'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);
        $acdyear_id = filter_input(INPUT_POST, 'acdyear_id', FILTER_SANITIZE_NUMBER_INT);

        //CLASS DATA
        $class_data = $this->MStudent->get_all_class_list();
        if ($class_data['error_status'] == 0 && $class_data['data_status'] == 1) {
            $data['class_data'] = $class_data['data'];
            $data['message'] = "";
        } else {
            $data['class_data'] = FALSE;
            $data['message'] = $class_data['message'];
        }
        //PRELOADED BATCH DATA WITH CURRENT ACD YEAR 
        $batch = $this->MStudent->get_preload_batch_data();
        if ($batch['error_status'] == 0 && $batch['data_status'] == 1) {
            $data['batch_data'] = $batch['data'];
            $data['message'] = "";
        } else {
            $data['batch_data'] = FALSE;
            $data['message'] = $batch['message'];
        }
        //ACD YEAR DATA
        $acd_year = $this->MStudent->get_all_acd_year();
        if ($acd_year['error_status'] == 0 && $acd_year['data_status'] == 1) {
            $data['acdyear_data'] = $acd_year['data'];
            $data['message'] = "";
        } else {
            $data['acdyear_data'] = FALSE;
            $data['message'] = $acd_year['message'];
        }

        if ($onload == 1) {
            //BATCH DATA ON CHANGE
            $batch_data = $this->MStudent->get_all_batchdata($courseid, $acdyear_id);
            if (isset($batch_data['error_status']) && $batch_data['error_status'] == 0) {
                if ($batch_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $batch_data['data']));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }


        $this->load->view('template/home_template', $data);
    }

    public function save_tc_application()
    {
        if ($this->input->is_ajax_request() == 1) {


            $student_data_raw = filter_input(INPUT_POST, 'studentdata');
            $student_id = filter_input(INPUT_POST, 'student_id');
            $batchid = filter_input(INPUT_POST, 'batchid');

            $inst_id = $this->session->userdata('inst_id');
            $acdyr_id = $this->session->userdata('acd_year');
            //            dev_export($student_data_raw);die;
            if ($student_data_raw) {

                //                dev_export($student_data_raw);die;
                $status = $this->MTC->save_tc_application($student_data_raw, $student_id, $inst_id, $acdyr_id);

                $student_details = json_decode($student_data_raw, TRUE);
                $prep_data = array($student_details['student_name']);
                $studentdata_name = $prep_data;

                if (is_array($status) && $status['data_status'] == 1) {
                    $fee_summary = 0;
                    $allocation_data_for_student = $this->MFee_collection->get_collection_data_by_student($student_id, $inst_id, $acdyr_id);
                    if (isset($allocation_data_for_student['summary_data']) && !empty($allocation_data_for_student['summary_data'])) {
                        $fee_summary = $allocation_data_for_student['summary_data']['PENDING_PAYMENT'];
                    } else {
                        $fee_summary = 0;
                    }

                    $this->session->set_flashdata('success_message', $studentdata_name[0] . " applied successfully");
                    echo json_encode(array('status' => 1, 'feesummary' => $fee_summary, 'view' => ''));
                    return;
                } else if (isset($status['message']) && !empty($status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $status['message']));
                    return false;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    public function tc_cancel()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_name = strtoupper(filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING));
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
            $acd_year_id = filter_input(INPUT_POST, 'cur_acdyear', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'cur_batchid', FILTER_SANITIZE_NUMBER_INT);
            $flag = filter_input(INPUT_POST, 'flag');
            if ($student_id) {

                if (isset($flag) && !empty($flag)) {
                    $status = $this->MTC->cancel_tc_application($student_id, $flag);
                } else {
                    $status = $this->MTC->cancel_tc_application($student_id);
                }
                //                dev_export($status);die;

                if (is_array($status) && $status['data_status'] == 1) {

                    $this->session->set_flashdata('success_message', $student_name . " cancelled successfully");

                    $params = array(
                        'acd_year' => $acd_year_id,
                        'batch_id' => $batchid
                    );

                    $loader_view_html = Modules::run('tc_settings/Tc_management_controller/show_student_preplist', 1, $params);
                    echo json_encode(array('status' => 1, 'view' => base64_encode($loader_view_html)));
                    return TRUE;

                    //                    $this->session->set_flashdata('success_message', $student_name . " cancelled successfully");
                    //                    echo json_encode(array('status' => 1, 'view' => ''));
                    //                    return;

                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $status['message']));
                        return false;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                        return false;
                    }
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    public function show_student_list()
    {
        if ($this->input->is_ajax_request() == 1) {
            //        $data['template'] = 'student_profile/profile';
            $data['title'] = 'TC';
            $data['sub_title'] = 'TC';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                //                '1' => array(
                //                    'link' => base_url('tc/show-class-for-students'),
                //                    'title' => 'TC Management'
                //                ),
                '2' => array(
                    'title' => 'TC Management'
                ),
                '2' => array(
                    'title' => 'TC' // 'Show TC Applied'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);

            $details_data = $this->MTC->get_all_studentdata($acd_year_id, $batchid);

            //        dev_export($details_data)  ;die; 
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['batchid'] = $batchid;
            $data['user_name'] = $this->session->userdata('user_name');

            //            echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/profile', $data, TRUE)));
            echo json_encode(array('status' => 1, 'view' => $this->load->view('tc/show_tc', $data, TRUE)));
            return TRUE;
        }
    }

    public function show_student_preplist($flag = 0, $params = NULL)
    {
        //        dev_export($flag);die;
        if ($this->input->is_ajax_request() == 1) {
            //        $data['template'] = 'student_profile/profile';
            $data['title'] = 'TC';
            $data['sub_title'] = 'TC';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    //'link' => base_url('tcprep/show-class-for-students'),
                    'title' => 'TC Management' //'TC Management'
                ),
                '2' => array(
                    'title' => 'TC' //'Show TC Applied'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            if ($flag == 0) {
                $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
                $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            } else if ($flag == 1) {
                $acd_year_id = $params['acd_year'];
                $batchid = $params['batch_id'];
            }

            $data['cur_acd_year'] = $acd_year_id;
            $data['cur_batch_id'] = $batchid;

            $inst_id = $this->session->userdata('inst_id');
            // $acd_year_id = $this->session->userdata('acd_year');

            $details_data = $this->MTC->get_all_studenttcprepdata($acd_year_id, $batchid);

            //            dev_export($details_data);die;
            $tc_app_details_data = $this->MTC->get_all_studentdata($acd_year_id, $batchid);
            if ($tc_app_details_data['error_status'] == 0 && $tc_app_details_data['data_status'] == 1) {
                $icc = 0;
                foreach ($tc_app_details_data['data'] as $tc_data) {
                    $allocation_data_for_student = $this->MFee_collection->get_collection_data_by_student($tc_data['student_id'], $inst_id, $acd_year_id);
                    $data['exm_pending'] = 0;
                    $data['recon_pending'] = 0;
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
                    // dev_export($penaltyarray);
                    // die;
                    /** */

                    $totalpenalty = 0;
                    $penalty_check_array = array();
                    foreach ($allocation_data_for_student['data'] as $demand) {
                        $penalty = 0;
                        if (!empty($demand['FEEID'])) {
                            if (!empty($penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']])) {
                                //added this condition for is there penalty details added for this feecode - NOV 06, 2019
                                if (isset($penaltyarray) && !empty($penaltyarray) && isset($penaltyarray[$demand['FEEID']])) {
                                    //dev_export($penaltyarray);
                                    $currentdate = date_create(date('d-m-Y'));
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
                                    }
                                } else {
                                    $penalty = 0;
                                }
                            }

                            $total_pending =  $demand['PENDING_PAYMENT'] - ($demand['TOTAL_PAID_AMOUNT'] + $demand['CONCESSION_AMOUNT'] + $demand['EXEMPTION_AMOUNT'] + $demand['EXEMPTION_PENDING_AMOUNT']);
                            $penalty = ($demand['PENDING_PAYMENT'] > 0 ? $penalty : 0);
                            $penalty = ($total_pending > $demand['EXEMPTION_PENDING_AMOUNT'] ? $penalty : 0);
                            $totalpenalty += $penalty;
                        }
                    }
                    $data['total_penalty'] = $totalpenalty;
                    /** */
                    //PENALTY MANAGE
                    if (isset($allocation_data_for_student['summary_data']) && !empty($allocation_data_for_student['summary_data'])) {
                        if (isset($allocation_data_for_student['summary_data']['EXEMPTION_PENDING_AMOUNT']) && $allocation_data_for_student['summary_data']['EXEMPTION_PENDING_AMOUNT'] > 0) {
                            $data['exm_pending'] = round($allocation_data_for_student['summary_data']['EXEMPTION_PENDING_AMOUNT'], 2); //rounded for displaying amount when tc apply
                            $data['recon_pending'] = round($allocation_data_for_student['summary_data']['TOTAL_NON_RECONCILED_AMOUNT'], 2); //rounded for displaying amount when tc apply
                            $data['wallet_pending'] = round($allocation_data_for_student['summary_data']['E_WALLET'], 2); //rounded for displaying amount when tc apply
                        }
                        $tc_app_details_data['data'][$icc]['fee_summary'] = ($allocation_data_for_student['summary_data']['PENDING_PAYMENT'] + $allocation_data_for_student['summary_data']['EXEMPTION_PENDING_AMOUNT'] + $allocation_data_for_student['summary_data']['TOTAL_NON_RECONCILED_AMOUNT'] + ($allocation_data_for_student['summary_data']['PENDING_PAYMENT'] > 0 ? $totalpenalty : 0));
                        $tc_app_details_data['data'][$icc]['fee_wallet'] = ($allocation_data_for_student['summary_data']['E_WALLET']);
                    } else {
                        $tc_app_details_data['data'][$icc]['fee_summary'] = 0;
                        $tc_app_details_data['data'][$icc]['fee_wallet'] = 0;
                    }
                    // if (isset($allocation_data_for_student['summary_data']) && !empty($allocation_data_for_student['summary_data'])) {
                    //     $tc_app_details_data['data'][$icc]['fee_summary'] = ($allocation_data_for_student['summary_data']['PENDING_PAYMENT'] + $allocation_data_for_student['summary_data']['TOTAL_NON_RECONCILED_AMOUNT']);
                    // } else {
                    //     $tc_app_details_data['data'][$icc]['fee_summary'] = 0;
                    // }
                    $icc++;
                }

                $data['app_details_data'] = $tc_app_details_data['data'];
                $data['message'] = "";
            } else {
                $data['app_details_data'] = FALSE;
                $data['message'] = $tc_app_details_data['message'];
            }
            // dev_export($tc_app_details_data['data']);
            // die;
            // dev_export($tc_app_details_data);
            // die;
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['batchid'] = $batchid;
            $data['user_name'] = $this->session->userdata('user_name');
            if ($flag == 1) {


                return $this->load->view('tc/show_tc_prep', $data, TRUE);
            } else {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('tc/show_tc_prep', $data, TRUE)));
            }
            //            echo json_encode(array('status' => 1, 'view' => $this->load->view('tc/show_tc_prep', $data, TRUE)));
            return TRUE;
        }
    }

    public function tc_preparation()
    {

        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $cur_acdyear = filter_input(INPUT_POST, 'cur_acdyear', FILTER_SANITIZE_STRING);
            $cur_batchid = filter_input(INPUT_POST, 'cur_batchid', FILTER_SANITIZE_STRING);
            $data['cur_acdyear'] = $cur_acdyear;
            $data['cur_batchid'] = $cur_batchid;
            $data['institution_id']     = $this->session->userdata('inst_id');

            if (isset($student_id) && !empty($student_id)) {
                $data['title'] = 'STUDENT PROFILE';
                $data['sub_title'] = 'Student Profile';
                $tcdetails = $this->MTC->get_student_tc_id($student_id);
                if ($tcdetails['error_status'] == 0 && $tcdetails['data_status'] == 1) {
                    $data['tcdetails'] = $tcdetails['data'];

                    $data['message'] = "";
                } else {
                    $data['tcdetails'] = FALSE;
                    $data['message'] = $tcdetails['message'];
                }
                $data['tcdetails'] = $tcdetails['data'];
                $inst_id = $this->session->userdata('inst_id');
                $tctypes = $this->MTC->get_tc_types($inst_id);
                if ($tctypes['error_status'] == 0 && $tctypes['data_status'] == 1) {
                    $data['tctypes'] = $tctypes['data'];

                    $data['message'] = "";
                } else {
                    $data['tctypes'] = FALSE;
                    $data['message'] = $tcdetails['message'];
                }
                //                $data['tcdetails'] = $tctypes['data'];

                $acc_year = $this->MTC->get_acd_year();

                if ($acc_year['error_status'] == 0 && $acc_year['data_status'] == 1) {
                    $data['acc_year'] = $acc_year['data'];

                    $data['message'] = "";
                } else {
                    $data['acc_year'] = FALSE;
                    $data['message'] = $acc_year['message'];
                }
                $stud_class = $this->MTC->get_class();
                if ($acc_year['error_status'] == 0 && $stud_class['data_status'] == 1) {
                    $data['stud_class'] = $stud_class['data'];

                    $data['message'] = "";
                } else {
                    $data['stud_class'] = FALSE;
                    $data['message'] = $stud_class['message'];
                }
                $this->load->view('tc/tc_preparation', $data);
            }
        }
    }

    public function save_tc_preparation()
    {
        //        die;

        if ($this->input->is_ajax_request() == 1) {


            $student_data_raw = filter_input(INPUT_POST, 'studentdata');
            $acd_year_id = filter_input(INPUT_POST, 'cur_acdyear', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'cur_batchid', FILTER_SANITIZE_NUMBER_INT);
            $data['cur_acd_year'] = $acd_year_id;
            $data['cur_batch_id'] = $batchid;
            if ($student_data_raw) {


                $status = $this->MTC->save_tc_preparation($student_data_raw);
                $student_details = json_decode($student_data_raw, TRUE);
                $prep_data = array($student_details['name']);
                $studentdata_name = $prep_data;

                if (is_array($status) && $status['data_status'] == 1) {
                    $this->session->set_flashdata('success_message', $studentdata_name[0] . " prepared successfully");
                    $params = array(
                        'acd_year' => $acd_year_id,
                        'batch_id' => $batchid
                    );
                    $loader_view_html = Modules::run('tc_settings/Tc_management_controller/show_student_preplist', 1, $params);
                    echo json_encode(array('status' => 1, 'view' => base64_encode($loader_view_html)));
                    return TRUE;

                    //                    $this->session->set_flashdata('success_message', $studentdata_name[0] . " prepared successfully");
                    //                    echo json_encode(array('status' => 1, 'view' => ''));
                    //                    return;

                    //                    if (isset($status['message']) && !empty($status['message'])) {
                    //                        echo json_encode(array('status' => 2, 'message' => $status['message']));
                    //                        return false;
                    //                    } else {
                    //                        echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    //                        return false;
                    //                    }
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    //TC VALIDATION
    public function validate_tc()
    {
        $admission_date = strtoupper(filter_input(INPUT_POST, 'admission_date', FILTER_SANITIZE_STRING));
        $todate = strtoupper(filter_input(INPUT_POST, 'todate', FILTER_SANITIZE_STRING));
        $admndate_raw = (explode(" ", $admission_date));
        $admndate_raww = (explode("-", $admndate_raw[0]));
        $admndate = $admndate_raw[0];
        $a = $admndate_raww[0];
        $b = $admndate_raww[1];
        $c = $admndate_raww[2];
        $admin_date = (implode("", $admndate_raww));
        $todate_raww = (explode("-", $todate));
        $d = $todate_raww[0];
        $e = $todate_raww[1];
        $f = $todate_raww[2];
        $to_date = (implode("", $todate_raww));
        $x = $to_date - $admin_date;
        if (($x > 0)) {
            echo json_encode(array('status' => 1, 'message' => 'Ok'));
            return true;
        } else {
            echo json_encode(array('status' => 2, 'message' => 'Error'));
            return true;
        }
    }

    public function tc_issue()
    {

        if ($this->input->is_ajax_request() == 1) {
            $studentid = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $rname = filter_input(INPUT_POST, 'tc_receved_by', FILTER_SANITIZE_STRING);
            $iname = filter_input(INPUT_POST, 'tc_issued_by', FILTER_SANITIZE_STRING);
            $acd_year_id = filter_input(INPUT_POST, 'cur_acdyear');
            $batchid = filter_input(INPUT_POST, 'cur_batchid');
            $print_type = filter_input(INPUT_POST, 'print_type'); //reprint

            if (isset($studentid) && !empty($studentid) && isset($studentid) && !empty($studentid)) {
                $inst_id = $this->session->userdata('inst_id');
                $tc_data = $this->MTC->get_tc_issue_data($studentid, $inst_id, $rname, $iname);
                $fee_summary = 0;
                $allocation_data_for_student = $this->MFee_collection->get_collection_data_by_student($studentid, $inst_id, $acd_year_id);
                if (isset($allocation_data_for_student['summary_data']) && !empty($allocation_data_for_student['summary_data'])) {
                    $fee_summary = $allocation_data_for_student['summary_data']['PENDING_PAYMENT'];
                } else {
                    $fee_summary = 0;
                }

                //                if ($tc_data['error_status'] == 0 && $tc_data['data_status'] == 1) {
                $data['details_data'] = $tc_data['data'];
                $data['fee_summary']  = $fee_summary;
                $data['message'] = "";
                $this->load->library('pdf');

                $data['user_name'] = $this->session->userdata('user_name');
                $file_name = "reports/tc_prep_" . time() . ".pdf";
                $pdfFilePath = FCPATH . $file_name;
                if (file_exists($pdfFilePath) == FALSE) {
                    ini_set('memory_limit', '320M'); // boost the memory limit if it's low ;)
                    $html = '';
                    switch ($inst_id) {
                        case '5':
                            if ($print_type == 'reprint') {
                                $html = $this->load->view('tc/tc_template/5_tcissuefinal_reprint', $data, true);
                                $pdf = $this->pdf->load_wide(array(
                                    'mode' => 'utf-8',
                                    'orientation' => 'P'
                                ));
                            } else {
                                $html = $this->load->view('tc/tc_template/5_tcissuefinal', $data, true); // render the view into HTML
                                $pdf = $this->pdf->load_wide(array(
                                    'mode' => 'utf-8',
                                    'format' => [310, 380],
                                    'orientation' => 'L'
                                ));
                            }
                            break;
                        case '8':
                            if ($print_type == 'reprint') {
                                $html = $this->load->view('tc/tc_template/8_tcissuefinal_reprint', $data, true);
                                $pdf = $this->pdf->load_wide(array(
                                    'mode' => 'utf-8',
                                    'orientation' => 'P'
                                ));
                            } else {
                                $html = $this->load->view('tc/tc_template/8_tcissuefinal', $data, true); // render the view into HTML
                                $pdf = $this->pdf->load_wide(array(
                                    'mode' => 'utf-8',
                                    'format' => [310, 380],
                                    'orientation' => 'L'
                                ));
                            }
                            break;
                        case '20':
                            if ($print_type == 'reprint') {
                                $html = $this->load->view('tc/tc_template/20_tcissuefinal_reprint', $data, true);
                                $pdf = $this->pdf->load_wide(array(
                                    'mode' => 'utf-8',
                                    'orientation' => 'P'
                                ));
                            } else {
                                $html = $this->load->view('tc/tc_template/20_tcissuefinal', $data, true); // render the view into HTML
                                $pdf = $this->pdf->load_wide(array(
                                    'mode' => 'utf-8',
                                    'format' => [310, 380],
                                    'orientation' => 'L'
                                ));
                            }
                            break;
                        default:
                            $pdf = $this->pdf->load_wide(array(
                                'mode' => 'utf-8',
                                'orientation' => 'P'
                            ));
                            break;
                    }
                    // $pdf->SetFooter($_SERVER['HTTP_HOST'] . $data['user_name'] . '|{PAGENO}|' . date(DATE_RFC822)); // Add a footer for good measure ;)

                    $pdf->WriteHTML($html); // write the HTML into the PDF
                    $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                }
                $params = array(
                    'acd_year' => $acd_year_id,
                    'batch_id' => $batchid
                );

                $loader_view_html = Modules::run('tc_settings/Tc_management_controller/show_student_preplist', 1, $params);
                echo json_encode(array('status' => 1, 'link' => base_url($file_name), 'view' => base64_encode($loader_view_html)));
                return true;
                //                } else {
                //                    $data['details_data'] = FALSE;
                //                    $data['message'] = $tc_data['message'];
                //                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Data not available'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }


    public function search_byname_for_profile()
    {                                               //display students list on search
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no_for_parent_search'] = trim(strtoupper(filter_input(INPUT_POST, 'searchdata', FILTER_SANITIZE_STRING)));
            $data_prep['flag'] = 4;
            $batchid = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['status_flag'] = 'A,TP,T';
            if ($batchid == -1) {
                $data_prep['batch_id'] = 0;
            } else {
                $data_prep['batch_id'] = $batchid;
            }
            $details_data = $this->MTC->get_student_by_admission_no($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['batchid'] = $batchid;
            $data['acdyr_id'] = $this->session->userdata('acd_year');


            if (isset($details_data['data']) && !empty($details_data['data'])) {

                $data['title'] = 'STUDENT PROFILE';
                $data['sub_title'] = 'STUDENT PROFILE';
                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'link' => base_url('school/home'),
                        'title' => 'TC Management',
                    ),
                    '2' => array(
                        'link' => base_url('longabsentee/show-class-for-students'),
                        'title' => 'Long Absent Management(Student Filter)',
                    ),
                    '3' => array(
                        'title' => 'Students'
                    )
                );
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);


                echo json_encode(array('status' => 1, 'view' => $this->load->view('longabsentee/long_ab_profile_search_result_admn_no', $data, TRUE)));
                return TRUE;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data available'));
                return TRUE;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    //This function written by Elavarasan S @ 16-05-2019 12:00
    function search_by_admno_for_profile()
    {
        if ($this->input->is_ajax_request() == 1) {
            $admn_no = filter_input(INPUT_POST, 'admn_no', FILTER_SANITIZE_STRING);
            $details_data = $this->MTC->get_studenttcprepdata_by_admnno($admn_no);
            $tc_app_details_data = $this->MTC->get_studentdata_by_admnno($admn_no);
            // dev_export($tc_app_details_data['data']);
            // die;
            if ($tc_app_details_data['error_status'] == 0 && $tc_app_details_data['data_status'] == 1) {
                $icc = 0;
                foreach ($tc_app_details_data['data'] as $tc_data) {
                    // $allocation_data_for_student = $this->MFee_collection->get_collection_data_by_student($tc_data['student_id'], $tc_data['inst_id'], $tc_data['acd_year']);
                    // if (isset($allocation_data_for_student['summary_data']) && !empty($allocation_data_for_student['summary_data'])) {
                    //     $tc_app_details_data['data'][$icc]['fee_summary'] = $allocation_data_for_student['summary_data']['PENDING_PAYMENT'];
                    // } else {
                    //     $tc_app_details_data['data'][$icc]['fee_summary'] = 0;
                    // }
                    $allocation_data_for_student = $this->MFee_collection->get_collection_data_by_student($tc_data['student_id'], $tc_data['inst_id'], $tc_data['acd_year']);
                    // dev_export($allocation_data_for_student['summary_data']);
                    // die;
                    $data['exm_pending'] = 0;
                    $data['recon_pending'] = 0;
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
                    // dev_export($penaltyarray);
                    // die;
                    /** */

                    $totalpenalty = 0;
                    $penalty_check_array = array();
                    if (isset($allocation_data_for_student['data']) && !empty($allocation_data_for_student['data'])) {
                        foreach ($allocation_data_for_student['data'] as $demand) {
                            $penalty = 0;
                            if (!empty($demand['FEEID'])) {
                                if (!empty($penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']])) {
                                    //added this condition for is there penalty details added for this feecode - NOV 06, 2019
                                    if (isset($penaltyarray) && !empty($penaltyarray) && isset($penaltyarray[$demand['FEEID']])) {
                                        //dev_export($penaltyarray);
                                        $currentdate = date_create(date('d-m-Y'));
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
                                        }
                                    } else {
                                        $penalty = 0;
                                    }
                                }

                                $total_pending =  $demand['PENDING_PAYMENT'] - ($demand['TOTAL_PAID_AMOUNT'] + $demand['CONCESSION_AMOUNT'] + $demand['EXEMPTION_AMOUNT'] + $demand['EXEMPTION_PENDING_AMOUNT']);
                                $penalty = ($demand['PENDING_PAYMENT'] > 0 ? $penalty : 0);
                                $penalty = ($total_pending > $demand['EXEMPTION_PENDING_AMOUNT'] ? $penalty : 0);
                                $totalpenalty += $penalty;
                            }
                        }
                    }
                    $data['total_penalty'] = $totalpenalty;
                    /** */
                    //PENALTY MANAGE
                    if (isset($allocation_data_for_student['summary_data']) && !empty($allocation_data_for_student['summary_data'])) {
                        $PENDING_PAYMENT = (isset($allocation_data_for_student['summary_data']['PENDING_PAYMENT']) ? $allocation_data_for_student['summary_data']['PENDING_PAYMENT'] : 0);
                        $EXEMPTION_PENDING_AMOUNT = (isset($allocation_data_for_student['summary_data']['EXEMPTION_PENDING_AMOUNT']) ? $allocation_data_for_student['summary_data']['EXEMPTION_PENDING_AMOUNT'] : 0);
                        $TOTAL_NON_RECONCILED_AMOUNT = (isset($allocation_data_for_student['summary_data']['TOTAL_NON_RECONCILED_AMOUNT']) ? $allocation_data_for_student['summary_data']['TOTAL_NON_RECONCILED_AMOUNT'] : 0);
                        $E_WALLET = (isset($allocation_data_for_student['summary_data']['E_WALLET']) ? $allocation_data_for_student['summary_data']['E_WALLET'] : 0);

                        if (isset($EXEMPTION_PENDING_AMOUNT) && $EXEMPTION_PENDING_AMOUNT > 0) {
                            $data['exm_pending'] = round($allocation_data_for_student['summary_data']['EXEMPTION_PENDING_AMOUNT'], 2); //rounded for displaying amount when tc apply
                        }
                        if (isset($TOTAL_NON_RECONCILED_AMOUNT) && $TOTAL_NON_RECONCILED_AMOUNT > 0) {
                            $data['recon_pending'] = round($allocation_data_for_student['summary_data']['TOTAL_NON_RECONCILED_AMOUNT'], 2); //rounded for displaying amount when tc apply
                        }
                        $tc_app_details_data['data'][$icc]['fee_summary'] = ($PENDING_PAYMENT + $EXEMPTION_PENDING_AMOUNT + $TOTAL_NON_RECONCILED_AMOUNT + ($PENDING_PAYMENT > 0 ? $totalpenalty : 0));
                        $tc_app_details_data['data'][$icc]['fee_wallet'] = $E_WALLET;
                    } else {
                        $tc_app_details_data['data'][$icc]['fee_summary'] = 0;
                        $tc_app_details_data['data'][$icc]['fee_wallet'] = 0;
                    }
                    $icc++;
                }
                $data['app_details_data'] = $tc_app_details_data['data'];
                $data['message'] = "";
            } else {
                $data['app_details_data'] = FALSE;
                $data['message'] = $tc_app_details_data['message'];
            }
            // dev_export($tc_app_details_data);
            // die();
            // if ($tc_app_details_data['error_status'] == 0 && $tc_app_details_data['data_status'] == 1) {
            //     $data['app_details_data'] = $tc_app_details_data['data'];
            //     $data['message'] = "";
            // } else {
            //     $data['app_details_data'] = FALSE;
            //     $data['message'] = $tc_app_details_data['message'];
            // }

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['title'] = 'TC'; //'TC Management';
            $data['sub_title'] = 'TC'; //'TC Management';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    //'link' => base_url('tcprep/show-class-for-students'),
                    'title' => 'TC Management' // 'TC Management',
                ),
                '2' => array(
                    'title' => 'TC' //'Show TC Details'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $data['user_name'] = $this->session->userdata('user_name');
            $data['searchdata'] = $admn_no;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('tc/show_tc_prep', $data, TRUE)));
        } else {
            $this->load->view(ERROR_500);
        }
    }

    //create function by vinoth @ 30-05-2019 12:40
    function search_name_for_profile()
    {
        if ($this->input->is_ajax_request() == 1) {
            $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
            $details_data = $this->MTC->get_studenttcprepdata_by_name($first_name);
            $tc_app_details_data = $this->MTC->get_studentdata_by_name($first_name);
            //            dev_export($tc_app_details_data);die();
            if ($tc_app_details_data['error_status'] == 0 && $tc_app_details_data['data_status'] == 1) {
                $data['app_details_data'] = $tc_app_details_data['data'];
                $data['message'] = "";
            } else {
                $data['app_details_data'] = FALSE;
                $data['message'] = $tc_app_details_data['message'];
            }

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['title'] = 'TC'; //'TC Management';
            $data['sub_title'] = 'TC'; //'TC Management';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    //'link' => base_url('tcprep/show-class-for-students'),
                    'title' => 'TC Management' //'TC Management',
                ),
                '2' => array(
                    'title' => 'TC' //'Show TC Details'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $data['user_name'] = $this->session->userdata('user_name');
            echo json_encode(array('status' => 1, 'view' => $this->load->view('tc/student_filter_for_tc_byadmno', $data, TRUE)));
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
