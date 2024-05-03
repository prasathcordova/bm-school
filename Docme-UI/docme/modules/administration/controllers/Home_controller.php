<?php

/**
 * Description of home
 *
 * @author aju.docme
 */
class Home_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!(isLoggedin() == 1)) {
            if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
                header("HTTP/1.1 401 UNauthorized");
                die();
            } else {
                $path = base_url('login');
                redirect($path);
            }
        }
        $this->load->model('Authenticator_model', 'MAuthenticator');
        $this->load->model('Home_model', 'MHome');
    }

    public function dashboard()
    {


        if ($this->session->userdata('store_user_status') == 1) {
            header("Location: " . base_url('dashboard')); /* Redirect browser */
            exit();
        }


        $breadcrumb = array(
            0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
            1 => array('message' => 'Dashboard', 'status' => 1)
        );

        $data['user_name'] = $this->session->userdata('user_name');
        $data['template'] = 'home/dashboard';
        $data['breadcrumb'] = $breadcrumb;

        $stud_reg_count = $this->MHome->get_stud_reg_count();
        //        dev_export($student_count);die;
        if ($stud_reg_count['error_status'] == 0 && $stud_reg_count['data_status'] == 1) {
            $data['stud_reg_count'] = $stud_reg_count['data'];
            $data['message'] = "";
        } else {
            $data['stud_reg_count'] = FALSE;
            //            dev_export($data['student_count']);die;
            $data['message'] = $stud_reg_count['message'];
        }

        $student_count = $this->MHome->get_students_count();
        //        dev_export($student_count);die;
        if ($student_count['error_status'] == 0 && $student_count['data_status'] == 1) {
            $data['student_count'] = $student_count['data'];
            $data['message'] = "";
        } else {
            $data['student_count'] = FALSE;
            //            dev_export($data['student_count']);die;
            $data['message'] = $student_count['message'];
        }
        $tcapplied_count = $this->MHome->get_tcapplied_count();
        //        dev_export($student_count);die;
        if ($tcapplied_count['error_status'] == 0 && $tcapplied_count['data_status'] == 1) {
            $data['tcapplied_count'] = $tcapplied_count['data'];
            $data['message'] = "";
        } else {
            $data['tcapplied_count'] = FALSE;
            //            dev_export($data['student_count']);die;
            $data['message'] = $tcapplied_count['message'];
        }

        $tcissue_count = $this->MHome->get_issue_count();
        //        dev_export($student_count);die;
        if ($tcissue_count['error_status'] == 0 && $tcissue_count['data_status'] == 1) {
            $data['tcissue_count'] = $tcissue_count['data'];
            $data['message'] = "";
        } else {
            $data['tcissue_count'] = FALSE;
            //            dev_export($data['student_count']);die;
            $data['message'] = $tcissue_count['message'];
        }
        $count = $this->MHome->get_count();

        if ($count['error_status'] == 0 && $count['data_status'] == 1) {
            $data['count'] = $count['data'];
            $data['message'] = "";
        } else {
            $data['count'] = FALSE;
            //            dev_export($data['student_count']);die;
            $data['message'] = $count['message'];
        }
        $sales_count = $this->MHome->get_daily_sales();
        //        dev_export($sales_count);die;
        if ($sales_count['error_status'] == 0 && $sales_count['data_status'] == 1) {
            $data['sales'] = $sales_count['data'];
            $data['message'] = "";
        } else {
            $data['sales'] = FALSE;
            //            dev_export($data['student_count']);die;
            $data['message'] = $sales_count['message'];
        }

        $notbilled_count = $this->MHome->get_not_billed();
        //        dev_export($notbilled_count);die;
        if ($notbilled_count['error_status'] == 0 && $notbilled_count['data_status'] == 1) {
            $data['not_billed'] = $notbilled_count['data'];
            $data['message'] = "";
        } else {
            $data['not_billed'] = FALSE;
            $data['message'] = $notbilled_count['message'];
        }

        $notdelivered_count = $this->MHome->get_not_delivered();
        if ($notdelivered_count['error_status'] == 0 && $notdelivered_count['data_status'] == 1) {
            $data['not_delivered'] = $notdelivered_count['data'];
            $data['message'] = "";
        } else {
            $data['not_delivered'] = FALSE;
            $data['message'] = $notdelivered_count['message'];
        }

        $graph_details = $this->MHome->get_graph();
        //        dev_export($graph_details);die;
        if ($graph_details['error_status'] == 0 && $graph_details['data_status'] == 1) {
            $data['graph_details'] = $graph_details['data'];
            $data['message'] = "";
        } else {
            $data['graph_details'] = FALSE;
            //            dev_export($data['student_count']);die;
            $data['message'] = $graph_details['message'];
        }


        $this->load->view('template/dashboard_template', $data);
    }

    //    public function show_dashboard() {
    //        $breadcrumb = array(
    //            0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
    //            1 => array('message' => 'Dashboard', 'status' => 1)
    //        );
    //        
    //        $data['user_name'] = $this->session->userdata('user_name');        
    ////        $data['template'] = 'home/dashboard';
    //        $data['template'] = '';
    //        $data['breadcrumb'] = $breadcrumb;
    //        $this->session->set_userdata('current_page', 'dashboard');
    //        $this->session->set_userdata('current_parent', 'dashboard');
    //        $this->load->view('template/home_template', $data);
    //    }

    public function show_book_dashboard()
    {
        $data['template'] = 'home/dashboard';
        // dev_export($_SESSION);die;
        $count = $this->MHome->get_count();

        if ($count['error_status'] == 0 && $count['data_status'] == 1) {
            $data['count'] = $count['data'];
            $data['message'] = "";
        } else {
            $data['count'] = FALSE;
            $data['message'] = $count['message'];
        }

        $sales_count = $this->MHome->get_daily_sales();
        if ($sales_count['error_status'] == 0 && $sales_count['data_status'] == 1) {
            $data['sales'] = $sales_count['data'];
            $data['message'] = "";
        } else {
            $data['sales'] = FALSE;
            $data['message'] = $sales_count['message'];
        }
        $notbilled_count = $this->MHome->get_not_billed();
        //        dev_export($notbilled_count);die;
        if ($notbilled_count['error_status'] == 0 && $notbilled_count['data_status'] == 1) {
            $data['not_billed'] = $notbilled_count['data'];
            $data['message'] = "";
        } else {
            $data['not_billed'] = FALSE;
            $data['message'] = $notbilled_count['message'];
        }

        $notdelivered_count = $this->MHome->get_not_delivered();
        if ($notdelivered_count['error_status'] == 0 && $notdelivered_count['data_status'] == 1) {
            $data['not_delivered'] = $notdelivered_count['data'];
            $data['message'] = "";
        } else {
            $data['not_delivered'] = FALSE;
            $data['message'] = $notdelivered_count['message'];
        }

        $graph_details = $this->MHome->get_graph();
        if ($graph_details['error_status'] == 0 && $graph_details['data_status'] == 1) {
            $data['graph_details'] = $graph_details['data'];
            $data['message'] = "";
        } else {
            $data['graph_details'] = FALSE;
            $data['message'] = $graph_details['message'];
        }

        $this->load->view('template/dashboard_template', $data);
    }

    public function show_uniform_dashboard()
    {
        $data['template'] = 'home/uniform_dashboard';
        $uniform_count = $this->MHome->uniform_get_count();
        if ($uniform_count['error_status'] == 0 && $uniform_count['data_status'] == 1) {
            $data['uniform_count'] = $uniform_count['data'];
            $data['message'] = "";
        } else {
            $data['uniform_count'] = FALSE;
            $data['message'] = $uniform_count['message'];
        }
        //        dev_export($uniform_count);die;
        $uniform_sales_count = $this->MHome->uniform_get_daily_sales();

        if ($uniform_sales_count['error_status'] == 0 && $uniform_sales_count['data_status'] == 1) {
            $data['uniform_sales'] = $uniform_sales_count['data'];
            $data['message'] = "";
        } else {
            $data['uniform_sales'] = FALSE;
            $data['message'] = $uniform_sales_count['message'];
        }

        $uniform_notbilled_count = $this->MHome->uniform_get_not_billed();
        //       
        if ($uniform_notbilled_count['error_status'] == 0 && $uniform_notbilled_count['data_status'] == 1) {
            $data['uniform_not_billed'] = $uniform_notbilled_count['data'];
            $data['message'] = "";
        } else {
            $data['uniform_not_billed'] = FALSE;
            $data['message'] = $uniform_notbilled_count['message'];
        }

        $uniform_notdelivered_count = $this->MHome->uniform_get_not_delivered();

        if ($uniform_notdelivered_count['error_status'] == 0 && $uniform_notdelivered_count['data_status'] == 1) {
            $data['uniform_not_delivered'] = $uniform_notdelivered_count['data'];
            $data['message'] = "";
        } else {
            $data['uniform_not_delivered'] = FALSE;
            $data['message'] = $uniform_notdelivered_count['message'];
        }

        $uniform_graph_details = $this->MHome->uniform_get_graph();

        if ($uniform_graph_details['error_status'] == 0 && $uniform_graph_details['data_status'] == 1) {
            $data['uniform_graph_details'] = $uniform_graph_details['data'];
            $data['message'] = "";
        } else {
            $data['uniform_graph_details'] = FALSE;
            $data['message'] = $uniform_graph_details['message'];
        }

        $this->load->view('template/dashboard_template', $data);
    }

    public function show_school_dashboard()
    {
        $data['template'] = 'home/dashboard_school';
        $data['title'] = 'CUSTOM REPORT';
        $data['sub_title'] = 'Report';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Custom Report',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $inst_id = $this->session->userdata('inst_id');
        // dev_export($this->session->userdata());
        // die;
        $data_prep = array(
            'action'                => 'get_school_dashboard_details',
            'controller_function'   => 'Authenticator/Dashboard_controller/get_school_dashboard_details',
            'inst_id'               => $inst_id
        );
        $dashboard_details = $this->MHome->get_school_dashboard_details($data_prep);
        // dev_export($dashboard_details);
        // die;
        $batch_not_allocated_students_format_array = [];
        $class_wise_strength_details_formatted = [];
        $partial_registered_students = [];
        if (is_array($dashboard_details) && !empty($dashboard_details)) {
            $class_wise_strength_details = json_decode($dashboard_details[0]['CLASS_WISE_STRENGTH'], TRUE);
            $i = 0;
            foreach ($class_wise_strength_details as $array_data) {
                $class_wise_strength_format_array[$i]['c'] = $array_data['Class_Name'];
                $class_wise_strength_format_array[$i]['a'] = $array_data['act'][0]['strength_active'];
                $class_wise_strength_format_array[$i]['l'] = $array_data['act'][0]['strength_lab'];
                $i++;
            }
            $class_wise_strength_details_formatted = json_encode($class_wise_strength_format_array);

            $i = 0;
            $batch_not_allocated_students = json_decode($dashboard_details[0]['BATCH_NOT_ALLOTED_STUDENTS'], TRUE);
            if (!empty($batch_not_allocated_students) > 0) {
                foreach ($batch_not_allocated_students as $json_data) {
                    $batch_not_allocated_students_format_array[$i]['Admn_No'] = $json_data['Admn_No'];
                    $batch_not_allocated_students_format_array[$i]['student_name'] = $json_data['student_name'];
                    $batch_not_allocated_students_format_array[$i]['student_id'] = $json_data['student_id'];
                    $batch_not_allocated_students_format_array[$i]['Class_Name'] = $json_data['cd'][0]['Class_Name'];
                    $i++;
                }
            }
            if (!empty($dashboard_details[0]['PART_REG_STUDENTS']))
                $partial_registered_students = json_decode($dashboard_details[0]['PART_REG_STUDENTS'], TRUE);

            //     $la_details = json_decode($dashboard_details[0]['LA_DETAILS'], TRUE);
            //     $tc_details = json_decode($dashboard_details[0]['TC_DETAILS'], TRUE);
            //     $ex_details = json_decode($dashboard_details[0]['EXEMPTION_DETAILS'], TRUE);
            //     $cn_details = json_decode($dashboard_details[0]['CONCESSION_DETAILS'], TRUE);
            //     $nd_details = json_decode($dashboard_details[0]['NDMD_STUD_DETAILS'], TRUE);
            //     $chp_details = json_decode($dashboard_details[0]['CHQ_PENDING_DETAILS'], TRUE);
            //     $chq_details = json_decode($dashboard_details[0]['CHQ_BOUNCED_DETAILS'], TRUE);
        }
        $data['acd_year_desc'] = $dashboard_details[0]['ACD_YEAR_DETAILS'];
        $data['course_count'] = $dashboard_details[0]['COURSE_COUNT'];
        $data['batch_count'] = $dashboard_details[0]['BATCH_COUNT'];
        $data['online_reg_count'] = $dashboard_details[0]['ONLINR_REG_COUNT'];
        $data['partial_registered_students'] = $partial_registered_students;
        $data['batch_not_allocated_students_count'] = sizeof($batch_not_allocated_students_format_array);
        $data['batch_not_allocated_students'] = $batch_not_allocated_students_format_array;
        $data['class_wise_strength_json'] = $class_wise_strength_details_formatted;
        $data['class_wise_fee_demand_details'] = empty($dashboard_details[0]['CLASS_WISE_DEMAND_DETAILS']) ? [] : $dashboard_details[0]['CLASS_WISE_DEMAND_DETAILS'];
        // $data['chq_pending'] = $chp_details[0]['mis_count'];
        // $data['chq_bounced'] = $chq_details[0]['mis_count'];
        // $tot_concession_amt = 0;
        // $tot_exemption_amt = 0;
        // if (is_array($cn_details) && !empty($cn_details)) {
        //     foreach ($cn_details as $cn) {
        //         $tot_concession_amt += $cn['mis_amount'];
        //     }
        // }
        // $data['tot_concession_amt'] = $tot_concession_amt;
        // if (is_array($ex_details) && !empty($ex_details)) {
        //     foreach ($ex_details as $ex) {
        //         $tot_exemption_amt += $cn['mis_amount'];
        //     }
        // }
        // $data['tot_exemption_amt'] = $tot_exemption_amt;
        // // dev_export($chq_details[0]['mis_count']);
        // // die;

        $stud_reg_count = $this->MHome->get_stud_reg_count();
        //        dev_export($student_count);die;
        if ($stud_reg_count['error_status'] == 0 && $stud_reg_count['data_status'] == 1) {
            $data['stud_reg_count'] = $stud_reg_count['data'];
            $data['message'] = "";
        } else {
            $data['stud_reg_count'] = FALSE;
            //            dev_export($data['student_count']);die;
            $data['message'] = $stud_reg_count['message'];
        }
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $student_count = $this->MHome->get_students_count();
        //        dev_export($student_count);die;
        if ($student_count['error_status'] == 0 && $student_count['data_status'] == 1) {
            $data['student_count'] = $student_count['data'];
            $data['message'] = "";
        } else {
            $data['student_count'] = FALSE;
            //            dev_export($data['student_count']);die;
            $data['message'] = $student_count['message'];
        }
        $tcapplied_count = $this->MHome->get_tcapplied_count();
        //        dev_export($student_count);die;
        if ($tcapplied_count['error_status'] == 0 && $tcapplied_count['data_status'] == 1) {
            $data['tcapplied_count'] = $tcapplied_count['data'];
            $data['message'] = "";
        } else {
            $data['tcapplied_count'] = FALSE;
            //            dev_export($data['student_count']);die;
            $data['message'] = $tcapplied_count['message'];
        }

        $tcissue_count = $this->MHome->get_issue_count();
        //        dev_export($student_count);die;
        if ($tcissue_count['error_status'] == 0 && $tcissue_count['data_status'] == 1) {
            $data['tcissue_count'] = $tcissue_count['data'];
            $data['message'] = "";
        } else {
            $data['tcissue_count'] = FALSE;
            //            dev_export($data['student_count']);die;
            $data['message'] = $tcissue_count['message'];
        }


        $this->load->view('template/dashboard_template', $data);
    }

    public function change_password()
    {
        // $data['template'] = 'activity/show_activity';
        $data['template'] = 'activity/change_password';
        $data['title'] = 'USER SETTINGS';
        $data['sub_title'] = 'Change Password';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Change Password',
                'link' => base_url('change-password')
            ),

        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['emailid'] = $this->session->userdata('emailid');
        $data['userid'] = $this->session->userdata('userid');
        $this->load->view('template/home_template', $data);
    }
}
