<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reports_controller
 *
 * @author chandrajith.edsys
 */
class Reports_controller extends MX_Controller
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

        $this->load->model('Reports_model', 'MReports');
        $this->load->model('student_settings/Registration_model', 'MRegistration');
        $this->load->model('student_settings/Student_Model', 'MStudent');
    }

    public function show_class_category()
    {

        //        $data['template'] = 'familywise/student_filter_for_profile';

        $data['title'] = 'FAMILY REPORT INDIVIDUAL';
        $data['sub_title'] = 'FAMILY REPORT INDIVIDUAL';
        //        $breadcrump = array(
        //            '0' => array(
        //'link' => base_url('dashboard'),
        //'title' => 'Home'),
        //            '1' => array(
        //'title' => 'Student Management')
        //        );
        //        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        //        $data['user_name'] = $this->session->userdata('user_name');
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
        echo json_encode(array(
            'status' => 1,
            'data' =>  $this->load->view('familywise/student_filter_for_profile', $data, TRUE)
        ));

        //        $acdyr = $this->MReports->get_all_acadyr();
        //        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
        //            if ($acdyr['data_status'] == 1) {
        //$data['acdyr_data'] = $acdyr['data'];
        //            } else {
        //$data['acdyr_data'] = FALSE;
        //            }
        //        } else {
        //            $data['acdyr_data'] = FALSE;
        //        }
        //        $data['acdyr_data'] = $acdyr['data'];
        //
        //        $batch_data = $this->MReports->get_batch_details_for_filter($this->session->userdata('acd_year'));
        //
        //        if (isset($batch_data['data']) && !empty($batch_data['data'])) {
        //            $data['batch_data'] = $batch_data['data'];
        //        } else {
        //            $data['batch_data'] = NULL;
        //        }
        //        $batch_count = $this->MReports->no_batch_count($this->session->userdata('acd_year'));
        //
        //        if (isset($batch_count['data']) && !empty($batch_count['data'])) {
        //            $data['batch_count_no_batch'] = $batch_count['data'][0]['counts'];
        //        } else {
        //            $data['batch_count_no_batch'] = 0;
        //        }
        //        $this->load->view('familywise/student_filter', $data);
    }
    public function advanced_filter_search()
    {
        $data['sub_title'] = 'Search';
        //        $data['user_name'] = $this->session->userdata('user_name');
        //        $this->session->set_userdata('current_page', 'itemtype');
        //        $this->session->set_userdata('current_parent', 'gen_sett');

        //        STREAM DATA
        $stream = $this->MRegistration->get_all_stream();
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
        $class = $this->MRegistration->get_all_class();
        //        dev_export($class);die;
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
        $acdyr = $this->MRegistration->get_all_acadyr();
        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
            if ($acdyr['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $batch = $this->MRegistration->get_all_batch($this->session->userdata('acd_year'));
        //        dev_export($class);die;
        if (isset($batch['error_status']) && $batch['error_status'] == 0) {
            if ($batch['data_status'] == 1) {
                $data['batch_data'] = $batch['data'];
            } else {
                $data['batch_data'] = FALSE;
            }
        } else {
            $data['batch_data'] = FALSE;
        }
        //

        $this->load->view('familywise/student_advanced_search', $data);
    }

    public function show_student_profile()
    {
        if ($this->input->is_ajax_request() == 1) {
            //        $data['template'] = 'student_profile/profile';
            $data['title'] = 'FAMILY REPORT INDIVIDUAL';
            $data['sub_title'] = 'FAMILY REPORT INDIVIDUAL';
            //            $breadcrump = array(
            //'0' => array(
            //    'link' => base_url('dashboard'),
            //    'title' => 'Home'),
            //'1' => array(
            //    'link' => base_url('profile/show-class-for-students'),
            //    'title' => 'Student Management'
            //),
            //'2' => array(
            //    'title' => 'Batch'
            //)
            //            );
            //            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            // course_id added by vinoth
            $course_id = filter_input(INPUT_POST, 'course_id', FILTER_SANITIZE_NUMBER_INT);
            $status_f = '';
            if ($batchid == -1) {
                $status_f = 5;
            } else {
                $status_f = 1;
            }
            $details_data = $this->MRegistration->get_all_studentdata($acd_year_id, $batchid, $status_f, $course_id);

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
            $data['acdyr_id'] = $acd_year_id;
            $data['batch_id'] = $batchid;


            echo json_encode(array('status' => 1, 'view' => $this->load->view('familywise/profile', $data, TRUE)));
            return TRUE;
        }
    }

    public function search_byname_for_profile()
    {                                               //display students list on search
        //        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchdata', FILTER_SANITIZE_STRING));
            //firstname and acy_yr added by vinoth
            $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'searchdata', FILTER_SANITIZE_STRING));
            $data_prep['acy_yr'] = NULL ;//$this->session->userdata('acd_year')
            $data_prep['flag'] = 5;
            $batchid = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);

            if ($batchid == -1) {
                $data_prep['batch_id'] = 0;
            } else {
                $data_prep['batch_id'] = $batchid;
            }
            $details_data = $this->MRegistration->get_student_by_admission_no($data_prep);
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

                //$data['title'] = 'STUDENT PROFILE';
                //$data['sub_title'] = 'STUDENT PROFILE';
                //$breadcrump = array(
                //    '0' => array(
                //        'link' => base_url('dashboard'),
                //        'title' => 'Home'
                //    ),
                //    '1' => array(
                //        'title' => 'Student Management',
                //        'link' => base_url('profile/show-class-for-students'),
                //    ),
                //    '2' => array(
                //        'title' => 'Students'
                //    )
                //);
                //$data['bread_crump_data'] = bread_crump_maker($breadcrump);


                echo json_encode(array('status' => 1, 'view' => $this->load->view('familywise/profile_search_result_admn_no', $data, TRUE)));
                return TRUE;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data available'));
                return TRUE;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }


    public function search_byname()
    {                                               //display students list on search
        //        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['acy_yr'] = filter_input(INPUT_POST, 'acdyr_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            //admn_no added by vinoth
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            $data_prep['flag'] = 6;
            //$data_prep['flag'] = 5;
            $batchid = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);

            if ($batchid == -1) {
                $data_prep['batch_id'] = 0;
            } else {
                $data_prep['batch_id'] = $batchid;
            }
            $details_data = $this->MStudent->parent_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
                $data['batchid'] = $batchid;
                $data['acdyr_id'] = $data_prep['acy_yr'];
                $data['batch_id'] = $data_prep['batch_id'];
                $data['user_name'] = $this->session->userdata('user_name');

                echo json_encode(array('status' => 1, 'view' => $this->load->view('familywise/profile_search_by_name', $data, TRUE)));
                return TRUE;
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
                echo json_encode(array('status' => 0));
                return TRUE;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }


    //    public function show_student_profile() {
    //
    //        if ($this->input->is_ajax_request() == 1) {
    ////        $data['template'] = 'student_profile/profile';
    //
    //            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
    //            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
    //            $details_data = $this->MReports->get_all_studentdata($acd_year_id, $batchid);
    //            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
    //$data['details_data'] = $details_data['data'];
    //$data['message'] = "";
    //            } else {
    //$data['details_data'] = FALSE;
    //$data['message'] = $details_data['message'];
    //            }
    //            $data['batchid'] = $batchid;
    //            $data['user_name'] = $this->session->userdata('user_name');
    //            $data['acdyr_id'] = $acd_year_id;
    //            $data['batch_id'] = $batchid;
    //            $this->load->view('familywise/profile', $data);
    ////            echo json_encode(array('status' => 1, 'view' => $this->load->view('familywise/profile', $data, TRUE)));
    ////            return TRUE;
    //        }
    //    }

    public function family_individualreport()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            if (isset($student_id) && !empty($student_id)) {
                //$data['template'] = '';

                $data['user_name'] = $this->session->userdata('user_name');
                $parent_address = $this->MReports->get_student_parentaddress($student_id);
                //dev_export($parent_address);die;
                if ($parent_address['error_status'] == 0 && $parent_address['data_status'] == 1) {
                    $data['parent_address'] = $parent_address['data'];
                    //    echo  $data['parent_address']['Father'];
                    //                        dev_export($data['parent_address']);die;
                    $data['message'] = "";
                } else {
                    $data['parent_address'] = FALSE;
                    $data['message'] = $parent_address['message'];
                }
                $data['parent_address'] = $parent_address['data'];
                //            dev_export( $data['parent_address']);die;

                $student_data = $this->MReports->get_profiles_student($student_id);
                //dev_export($student_data);die;

                if ($student_data['error_status'] == 0 && $student_data['data_status'] == 1) {
                    $data['student_data'] = $student_data['data'][0];
                    $data['batch_select'] = $student_data['data'][0]['Cur_Batch'];
                    $student_cur_year = $student_data['data'][0]['Cur_AcadYr'];
                    $data['student_cur_year'] = $student_data['data'][0]['Cur_AcadYr'];
                    $data['message'] = "";
                } else {
                    $data['student_data'] = FALSE;
                    $data['message'] = $student_data['message'];
                }

                $sibilings_data = $this->MReports->get_sibilings_student($student_id);
                //                dev_export($sibilings_data);die;
                if ($sibilings_data['error_status'] == 0 && $sibilings_data['data_status'] == 1) {
                    $data['sibilings_data'] = $sibilings_data['data'];
                    $data['message'] = "";
                } else {
                    $data['sibilings_data'] = FALSE;
                    $data['message'] = $sibilings_data['message'];
                }
                $data_prep = array(
                    'student_id' => $student_id
                );
                $data['studentid'] = $student_id;
                $student_data1 = $this->MReports->get_profiles_student_status($data_prep);
                //dev_export($student_data1);die;
                // if ($student_data1['error_status'] == 0 && $student_data1['data_status'] == 1) {
                //     $data['student_data1'] = $student_data1['data'];
                //     $data['message'] = "";
                // } else {
                //     $data['student_data1'] = FALSE;
                //     $data['message'] = $student_data1['message'];
                // }
                $parent_email = $this->MReports->get_emailID($student_id);
                //dev_export($parent_email);die;
                if ($parent_email['error_status'] == 0 && $parent_email['data_status'] == 1) {
                    $data['parent_email'] = $parent_email['data'];
                    //    echo  $data['parent_address']['Father'];
                    //                        dev_export($data['parent_address']);die;
                    $data['message'] = "";
                } else {
                    $data['parent_email'] = FALSE;
                    $data['message'] = $parent_email['message'];
                }
                if ($student_data1['error_status'] == 0 && $student_data1['data_status'] == 1) {
                    // dev_export($result_array);
                    // die;
                    $data['student_data1'] = $student_data1['data'];
                    $data['user_name'] = $this->session->userdata('user_name');
                    $inst_id = $this->session->userdata('inst_id');
                    $user_id = $this->session->userdata('userid');
                    $data['title'] = 'Family Report Individual';
                    $data['bread_crumps'] = 'Student Management > Reports > Family Report Individual';
                    $data['filename_report'] = "reports/family_report_individual" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'familywise/family_rp_pdf';
                    $data['collection_date'] =  date('d/M/Y');
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                }



                //dev_export($data);die;
                //if(!(isset($batchid) && !empty($batchid))) {
                //    if(isset($student_data['data'][0]['Cur_Batch']) && !empty($student_data['data'][0]['Cur_Batch'])) {
                //        $batchid = $student_data['data'][0]['Cur_Batch'];
                //    }                    
                //}


                // $filename_report = "reports/report_" . time() . ".pdf";
                // $pdfFilePath = FCPATH . $filename_report;
                // if (file_exists($pdfFilePath) == FALSE) {
                //     ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)

                //     $html = $this->load->view('familywise/family_rp_pdf', $data, true); // render the view into HTML
                //     //        echo $html;die;
                //     $this->load->library('pdf');

                //     $pdf = $this->pdf->load();
                //     //change title name by vinoth @27-05-2019 20:16
                //     $header = $this->load->view('report/header', ['title' => 'Student Management - Family Wise Student Report'], true);;
                //     $pdf->setAutoTopMargin = 'stretch';
                //     $pdf->setAutoBottomMargin = 'stretch';
                //     $pdf->SetHeader('|' . $header . '|');
                //     date_default_timezone_set('Asia/Kolkata');
                //     $pdf->SetFooter('Print by: ' . $data['user_name'] .
                //         ' <br/><h5 style="color: #888;overflow:visible;">Student Management > Report > Family Report individual</h5>|{PAGENO}|' .
                //         date('d-m-Y -  h:i:s')); // Add a footer for good measure ;)

                //     $pdf->WriteHTML($html); // write the HTML into the PDF

                //     $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                // }
                // echo base_url($filename_report);
                // return true;
            }
        }
    }

    //FORMATING PDF REPORT - COMMON FUNCTION()
    private function get_pdf_report($data, $orntn = 'P')
    {
        $pdfFilePath = FCPATH . $data['filename_report'];
        //if (file_exists($pdfFilePath) == FALSE) {
        ini_set('max_execution_time', 1200);
        ini_set('memory_limit', '32000M'); // boost the memory limit if it's low 
        ini_set("pcre.backtrack_limit", "5000000");

        $this->load->library('pdf'); //Load PDF Library
        if ($orntn == 'L')
            $pdf = $this->pdf->load_wide(array('mode' => 'utf-8', 'format' => [310, 380], 'orientation' => 'L'));
        else $pdf = $this->pdf->load(); //Set Orientation
        date_default_timezone_set('Asia/Kolkata'); //timezone need to change according to country                    
        // render the view into HTML
        $html = $this->load->view($data['viewname'], $data, true);
        //return $html;
        $pdf->WriteHTML($html); // write the HTML into the PDF
        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file 
        //}
        return base_url($data['filename_report']);
    }
}
