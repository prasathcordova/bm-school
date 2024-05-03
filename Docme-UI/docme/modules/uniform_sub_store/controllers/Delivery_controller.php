<?php

/**
 * Description of Delivery_controller
 *
 * @author chandrajith.docme
 * Handles delivery process
 */
class Delivery_controller extends MX_Controller
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
        $this->load->model('Delivery_model', 'MDelivery');
        $this->load->model('student_settings/Registration_model', 'MRegistration');
        $this->load->model('student_settings/Student_Model', 'MStudent');
        $this->load->model('store_settings/Itemdetails_management_model', 'MItem');
        $this->load->model('Saleissue_model', 'MSaleissue');
        $this->load->model('OH_packing_model', 'OHPModel');
        $this->load->model('Sales_model', 'MSales');
    }

    public function search_specimen_return_data()
    {
        $data['sub_title'] = 'Student Search';
        $data['user_name'] = $this->session->userdata('user_name');


        //        $data['template'] = 'sale/profile_staff';
        $data['title'] = 'Faculty Specimen Return';
        $data['sub_title'] = 'Staff Profile';



        $user_data = $this->MDelivery->get_all_user_list();
        //        dev_export($user_data);die;
        if ($user_data['error_status'] == 0 && $user_data['data_status'] == 1) {
            $data['user_data'] = $user_data['data'];
            $data['message'] = "";
        } else {
            $data['user_data'] = FALSE;
            $data['message'] = $user_data['message'];
        }
        $data['user_data'] = $user_data['data'];
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
        } else {
            $this->load->view('delivery_return/deliveryReturn_faculty_search', $data);
        }
    }

    public function show_faculty_delivery()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Student Bill';
            $data['sub_title'] = 'Student Bill';
            $Empid = strtoupper(filter_input(INPUT_POST, 'Empid', FILTER_SANITIZE_STRING));
            $details_data = $this->MDelivery->get_all_user_list_id($Empid);
            //            dev_export($details_data);;die;
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['faculty'] = $details_data['data'][0];
            } else {
                $data['faculty'] = NULL;
            }
            $pack_list = $this->MDelivery->get_all_pack_list_faculty($Empid);
            //            dev_export($pack_list);die;
            if (isset($pack_list['data']) && !empty($pack_list['data'])) {
                $data['pack_list'] = $pack_list['data'];
            } else {
                $data['pack_list'] = NULL;
            }

            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery/faculty_delivery', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function search_teachername()
    {
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        //        $data['title'] = 'Specimen Issue';
        $data['sub_title'] = 'Staff Profile';

        $teacher_name = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));


        $user_data = $this->MSaleissue->get_all_user_list_byname($teacher_name);
        //        dev_export($user_data);die;
        if ($user_data['error_status'] == 0 && $user_data['data_status'] == 1) {
            $data['user_data'] = $user_data['data'];
            $data['message'] = "";
        } else {
            $data['user_data'] = FALSE;
            $data['message'] = $user_data['message'];
        }

        $data['user_data'] = $user_data['data'];
        $data['user_name'] = $this->session->userdata('user_name');
        echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery/search_techr_name', $data, TRUE)));
        return TRUE;
    }

    public function search_teachername_delivery_return()
    {
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        //        $data['title'] = 'Specimen Issue';
        $data['sub_title'] = 'Staff Profile';

        $teacher_name = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));


        $user_data = $this->MSaleissue->get_all_user_list_byname($teacher_name);
        //        dev_export($user_data);die;
        if ($user_data['error_status'] == 0 && $user_data['data_status'] == 1) {
            $data['user_data'] = $user_data['data'];
            $data['message'] = "";
        } else {
            $data['user_data'] = FALSE;
            $data['message'] = $user_data['message'];
        }

        $data['user_data'] = $user_data['data'];
        $data['user_name'] = $this->session->userdata('user_name');
        echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery_return/search_techr_name', $data, TRUE)));
        return TRUE;
    }

    public function show_filter_faculty()
    {
        $data['sub_title'] = 'Student Search';
        $data['user_name'] = $this->session->userdata('user_name');


        //        $data['template'] = 'sale/profile_staff';
        $data['title'] = 'Faculty Items Delivery';
        $data['sub_title'] = 'Staff Profile';



        $user_data = $this->MDelivery->get_all_user_list();
        //        dev_export($user_data);die;
        if ($user_data['error_status'] == 0 && $user_data['data_status'] == 1) {
            $data['user_data'] = $user_data['data'];
            $data['message'] = "";
        } else {
            $data['user_data'] = FALSE;
            $data['message'] = $user_data['message'];
        }
        $data['user_data'] = $user_data['data'];
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
        } else {
            $this->load->view('delivery/delivery_faculty_search', $data);
        }



        //        $this->load->view('delivery/delivery_faculty_search', $data);
    }

    public function show_filter_student()
    {
        $data['sub_title'] = 'Student Search';
        $data['user_name'] = $this->session->userdata('user_name');


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
        $acdyr = $this->OHPModel->get_all_acadyr();
        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
            if ($acdyr['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $batch = $this->OHPModel->get_all_batch($this->session->userdata('acd_year'));
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
        //        $data['class_data'] = $class['data'];


        $this->load->view('delivery/delivery_student_search', $data);
    }

    public function advancesearch_byname()
    {                                               //display students list on search
        $data['title'] = 'STUDENTS LIST';
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {

            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            //            $data_prep['batch_id'] = 46;
            //            $data_prep['stream_id'] = 1;
            //            $data_prep['class_id'] = 1;
            ////            $data_prep['curent_acdyr'] = filter_input(INPUT_POST, 'curent_acdyr', FILTER_SANITIZE_NUMBER_INT);
            ////            $data_prep['inst_id'] = filter_input(INPUT_POST, 'inst_id', FILTER_SANITIZE_NUMBER_INT);
            //            $data_prep['curent_acdyr'] = 21;
            //            $data_prep['inst_id'] = 5;
            //            ;
            //            $data_prep['searchname'] = 'm';

            /* need to use this code the above is for testing */
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

            $details_data = $this->MSales->studentadvance_search($data_prep);
            //            dev_export($details_data);
            //            die;
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function delivery_rtn_advancesearch_byname()
    {                                               //display students list on search
        $data['title'] = 'STUDENTS LIST';
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {

            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            //            $data_prep['batch_id'] = 46;
            //            $data_prep['stream_id'] = 1;
            //            $data_prep['class_id'] = 1;
            ////            $data_prep['curent_acdyr'] = filter_input(INPUT_POST, 'curent_acdyr', FILTER_SANITIZE_NUMBER_INT);
            ////            $data_prep['inst_id'] = filter_input(INPUT_POST, 'inst_id', FILTER_SANITIZE_NUMBER_INT);
            //            $data_prep['curent_acdyr'] = 21;
            //            $data_prep['inst_id'] = 5;
            //            ;
            //            $data_prep['searchname'] = 'm';

            /* need to use this code the above is for testing */
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

            $details_data = $this->MSales->studentadvance_search($data_prep);
            //            dev_export($details_data);
            //            die;
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery_return/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function search_byname()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            //            $data_prep['acy_yr'] = filter_input(INPUT_POST, 'acdyr_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            //            $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_NUMBER_INT));
            //            $data_prep['first_name'] = filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($data_prep['first_name']);die;
            //            dev_export($data_prep);die;
            $details_data = $this->MDelivery->student_search($data_prep);
            //            dev_export($details_data);die;
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function search_byname_returnDelivery()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            //            $data_prep['acy_yr'] = filter_input(INPUT_POST, 'acdyr_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            //            $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_NUMBER_INT));
            //            $data_prep['first_name'] = filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($data_prep['first_name']);die;
            //            dev_export($data_prep);die;
            $details_data = $this->MDelivery->student_search($data_prep);
            //            dev_export($details_data);die;
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery_return/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function search_studentname()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Student Bill';
            $data['sub_title'] = 'Student Bill';
            $student_id = strtoupper(filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING));
            $details_data = $this->MRegistration->get_profiles_student($student_id);
            //            dev_export($details_data);;die;
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['student'] = $details_data['data'][0];
            } else {
                $data['student'] = NULL;
            }
            $pack_list = $this->MDelivery->get_all_pack_list($student_id);
            //            dev_export($pack_list);die;
            if (isset($pack_list['data']) && !empty($pack_list['data'])) {
                $data['pack_list'] = $pack_list['data'];
            } else {
                $data['pack_list'] = NULL;
            }

            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery/student_delivery', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function show_deliveryreturn()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Student Bill';
            $data['sub_title'] = 'Student Bill';
            $student_id = strtoupper(filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING));
            $details_data = $this->MRegistration->get_profiles_student($student_id);
            //            dev_export($details_data);;die;
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['student'] = $details_data['data'][0];
            } else {
                $data['student'] = NULL;
            }
            $pack_list = $this->MDelivery->get_all_deliveryReturn_list($student_id);
            //            dev_export($pack_list);die;
            if (isset($pack_list['data']) && !empty($pack_list['data'])) {
                $data['pack_list'] = $pack_list['data'];
            } else {
                $data['pack_list'] = NULL;
            }
            $data['student_id'] = $student_id;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery_return/student_deliveryReturn', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function show_faculty_deliveryreturn()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Student Bill';
            $data['sub_title'] = 'Student Bill';
            $Empid = strtoupper(filter_input(INPUT_POST, 'Empid', FILTER_SANITIZE_STRING));
            $details_data = $this->MDelivery->get_all_user_list_id($Empid);
            //            $details_data = $this->MDelivery->get_billstudent_name($Empid);
            //            dev_export($details_data);;die;
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['faculty'] = $details_data['data'][0];
            } else {
                $data['faculty'] = NULL;
            }
            $pack_list = $this->MDelivery->get_all_deliveryReturn_faculty_list($Empid);
            //            dev_export($pack_list);die;
            if (isset($pack_list['data']) && !empty($pack_list['data'])) {
                $data['pack_list'] = $pack_list['data'];
            } else {
                $data['pack_list'] = NULL;
            }
            $data['emp_id'] = $Empid;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery_return/faculty_deliveryReturn', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function generate_print_delivery_note()
    {
        $delivery_id = filter_input(INPUT_POST, 'delivery_id', FILTER_SANITIZE_NUMBER_INT);
        if (!(isset($delivery_id) && !empty($delivery_id))) {
            echo json_encode(array('status' => 2, 'message' => 'Delivery data is mandatory'));
            return true;
        } else {
            $delv_print_link = $this->create_delivery_print($delivery_id);
            echo json_encode(array('status' => 1, 'delv_print_link' => $delv_print_link));
            return true;
        }
    }

    public function save_delivery()
    {
        if ($this->input->is_ajax_request() == 1) {
            $delivery_id = filter_input(INPUT_POST, 'delivery_id', FILTER_SANITIZE_NUMBER_INT);
            if (!(isset($delivery_id) && !empty($delivery_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Delivery data is mandatory'));
                return true;
            }

            $delivery_status = $this->MDelivery->delivery_save($delivery_id);

            if (isset($delivery_status) && !empty($delivery_status) && isset($delivery_status['data_status']) && !empty($delivery_status['data_status']) && $delivery_status['data_status'] == 1) {
                $delv_print_link = $this->create_delivery_print($delivery_id);
                echo json_encode(array('status' => 1, 'delv_print_link' => $delv_print_link));
                return true;
            } else {
                if (isset($delivery_status['message']) && !empty($delivery_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $delivery_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please try again or contact administrator with error code : PAPRCNTR1001'));
                    return true;
                }

                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function create_delivery_print($delivery_id)
    {
        $details_data = $this->MDelivery->delivery_note_data($delivery_id);
        if (isset($details_data['data']) && !empty($details_data['data'])) {
            $data['details_data'] = $details_data['data'];
        } else {
            $data['details_data'] = NULL;
        }

        $username = $this->session->userdata('user_name');
        $deliveryhtml = $this->load->view('delivery/delivery_print', $data, TRUE);

        $data_header['title'] = "UNIFORM STORE - DELIVERY NOTE";
        $header_data = $this->load->view('report/report_view/header', $data_header, TRUE);
        $header = '|' . $header_data . '|';
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y h:i:s');
        $footer = '<div style="font-size:10px;font-weight: normal;">' . 'Docme -> Store -> Delivery Note Print <br/> Printed on : ' . $date . '|{PAGENO}|' . '<div style="font-size:10px;font-weight: normal;">Generated By : ' . $username . '</div></div>';
        $report = $this->generate_pdf_all($deliveryhtml, $username, $header, $footer);
        $reportlink = base_url("download/" . $report);
        return $reportlink;
    }

    private function generate_pdf_all($report_html, $username, $header = '', $footer = '')
    {
        $filename_report = "bill/delivert_note_" . time() . ".pdf";
        $pdfFilePath = FCPATH . $filename_report;
        if (file_exists($pdfFilePath) == FALSE) {
            ini_set('memory_limit', '256M'); // boost the memory limit if it's low ;)
            ini_set("pcre.backtrack_limit", "10000000");
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            if (isset($header) && !empty($header)) {
                $pdf->setAutoTopMargin = 'stretch';
                $pdf->SetHeader($header);
            }
            if (isset($footer) && !empty($footer)) {
                $pdf->SetFooter($footer); // Add a footer for good measure ;)
            }
            $stylesheet = file_get_contents(base_url('/assets/theme/css/bootstrap.css'));
            //            $stylesheet = file_get_contents(base_url('/assets/theme/css/style.css'));
            $pdf->WriteHTML($stylesheet, 1);
            $pdf->WriteHTML($report_html); // write the HTML into the PDF    
            $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file 
            return $filename_report;
        } else {
            return false;
        }
    }

    public function replace_item()
    {
        if ($this->input->is_ajax_request() == 1) {
            $pack_id = filter_input(INPUT_POST, 'pack_id', FILTER_SANITIZE_NUMBER_INT);
            $re_item_id = filter_input(INPUT_POST, 're_item_id', FILTER_SANITIZE_NUMBER_INT);
            $item_id = filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);
            $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
            $qty = filter_input(INPUT_POST, 'qty', FILTER_SANITIZE_STRING);
            $del_detail_id = filter_input(INPUT_POST, 'del_detail_id', FILTER_SANITIZE_NUMBER_INT);
            if (!(isset($pack_id) && !empty($pack_id))) {
                echo json_encode(array('status' => 2, 'message' => 'pack data is mandatory'));
                return true;
            }
            $delivery_status = $this->MDelivery->delivery_itemReplace_save($pack_id, $re_item_id, $item_id, $price, $qty, $del_detail_id);
            //                dev_export($purchase_status);die;
            if (isset($delivery_status) && !empty($delivery_status) && isset($delivery_status['data_status']) && !empty($delivery_status['data_status']) && $delivery_status['data_status'] == 1) {
                echo json_encode(array('status' => 1));
                return true;
            } else {
                if (isset($delivery_status['message']) && !empty($delivery_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $delivery_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please try again or contact administrator with error code : PAPRCNTR1001'));
                    return true;
                }

                return true;
            }
            //            } else {
            //                echo json_encode(array('status' => 2, 'message' => 'All Mandatory fields should be entered with valid values.'));
            //                return true;
            //            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function student_deliveryreturn()
    {
        $data['sub_title'] = 'Delivery Return';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('delivery/delivery_return', $data);
    }

    public function search_st_delivery()
    {
        $data['title'] = 'Student Search';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('delivery/delivery_st_search', $data);
    }

    public function search_emp_delivery()
    {
        $data['title'] = 'Employee Search';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('delivery/delivery_emp_search', $data);
    }

    public function search_emp_data()
    {
        $data['title'] = 'Employee Search';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('delivery/delivery_emp_datasearch', $data);
    }

    public function search_st_data()
    {
        $data['title'] = 'Employee Search';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('delivery/delivery_st_datasearch', $data);
    }

    public function search_return_data()
    {
        //        $data['title'] = 'Delivery Return';
        //        $data['user_name'] = $this->session->userdata('user_name');
        //        $this->session->set_userdata('current_page', 'itemtype');
        //        $this->session->set_userdata('current_parent', 'gen_sett');
        //        $this->load->view('delivery/delivery_rtrnsearch', $data);
        $data['sub_title'] = 'Student Search';
        $data['user_name'] = $this->session->userdata('user_name');


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
        $acdyr = $this->OHPModel->get_all_acadyr();
        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
            if ($acdyr['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $batch = $this->OHPModel->get_all_batch($this->session->userdata('acd_year'));
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
        //        $data['class_data'] = $class['data'];


        $this->load->view('delivery_return/deliveryReturn_student_search', $data);
    }

    public function search_st_deliveryrtn()
    {
        $data['title'] = 'Delivery Return';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('delivery/delivery_rtrn_stsearch', $data);
    }

    public function search_emp_deliveryrtn()
    {
        $data['title'] = 'Delivery Return';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('delivery/delivery_rtrn_empsearch', $data);
    }

    public function voucher_st_rtndata()
    {
        $data['title'] = 'Delivery Return';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('delivery/delivery_return', $data);
    }

    public function voucher_emp_rtndata()
    {
        $data['title'] = 'Delivery Return';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('delivery/delivery_returnemp', $data);
    }

    public function search_packdetails()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Student Bill';
            $data['sub_title'] = 'Student Bill';
            $pack_id = strtoupper(filter_input(INPUT_POST, 'packid', FILTER_SANITIZE_STRING));
            $student_id = strtoupper(filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING));
            $flag = strtoupper(filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_STRING));
            $emp_id = strtoupper(filter_input(INPUT_POST, 'emp_id', FILTER_SANITIZE_STRING));
            if ($flag == 1)
                $details_data = $this->MDelivery->get_bill_pack_details($pack_id, 1);
            else
                $details_data = $this->MDelivery->get_bill_pack_details($pack_id);
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['details_data'] = $details_data['data'];
            } else {
                $data['details_data'] = NULL;
            }
            $data['delivery_id'] = $pack_id;
            $data['student_id'] = $student_id;
            $data['emp_id'] = $emp_id;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery/dlivery_pack_items', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function delivery_item_replace()
    {


        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Item Replacement (Item Replaced with same item type and price)';
            $data['sub_title'] = 'Item Replacement (Item Replaced with same item type and price)';
            $item_id = strtoupper(filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_STRING));
            $del_detail_id = strtoupper(filter_input(INPUT_POST, 'del_detail_id', FILTER_SANITIZE_STRING));
            $price = strtoupper(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING));
            $type_id = strtoupper(filter_input(INPUT_POST, 'type_id', FILTER_SANITIZE_STRING));
            $pack_id = strtoupper(filter_input(INPUT_POST, 'pack_id', FILTER_SANITIZE_STRING));
            $qty = strtoupper(filter_input(INPUT_POST, 'qty', FILTER_SANITIZE_STRING));
            $delivery_id = strtoupper(filter_input(INPUT_POST, 'delivery_id', FILTER_SANITIZE_STRING));
            $details_data = $this->MDelivery->get_items_replace($price, $type_id, $item_id);
            //            dev_export($details_data);die;
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['details_data'] = $details_data['data'];
            } else {
                $data['details_data'] = NULL;
            }
            //            dev_export($details_data);die;
            $data['pack_id'] = $pack_id;
            $data['item_id'] = $item_id;
            $data['price'] = $price;
            $data['qty'] = $qty;
            $data['delivery_id'] = $delivery_id;
            $data['del_detail_id'] = $del_detail_id;

            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery/dlivery_replace_items', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function deliveryReturn_pack_details()
    {


        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Student Bill';
            $data['sub_title'] = 'Student Bill';
            $pack_id = strtoupper(filter_input(INPUT_POST, 'packid', FILTER_SANITIZE_STRING));
            $student_id = strtoupper(filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING));
            $details_data = $this->MDelivery->get_bill_pack_details($pack_id);
            //            dev_export($details_data);die;
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['details_data'] = $details_data['data'];
            } else {
                $data['details_data'] = NULL;
            }
            //            dev_export($details_data);die;
            //            $pack_list = $this->MDelivery->get_all_pack_list($pack_id);
            //            if (isset($pack_list['data']) && !empty($pack_list['data'])) {
            //                $data['pack_list'] = $pack_list['data'];
            //            } else {
            //                $data['pack_list'] = NULL;
            //            }
            $data['delivery_id'] = $pack_id;
            $data['student_id'] = $student_id;

            if ($details_data['data'][0]['type'] == 3) {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery_return/delivery_pack_items_OH', $data, TRUE)));
                return TRUE;
            } else {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery_return/dlivery_pack_items', $data, TRUE)));
                return TRUE;
            }

            //            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery_return/delivery_pack_items_OH', $data, TRUE)));
            //            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function faculty_deliveryReturn_pack_details()
    {


        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Student Bill';
            $data['sub_title'] = 'Student Bill';
            $pack_id = strtoupper(filter_input(INPUT_POST, 'packid', FILTER_SANITIZE_STRING));
            $emp_id = strtoupper(filter_input(INPUT_POST, 'emp_id', FILTER_SANITIZE_STRING));
            $details_data = $this->MDelivery->get_bill_pack_details($pack_id);
            //            dev_export($details_data);die;
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['details_data'] = $details_data['data'];
            } else {
                $data['details_data'] = NULL;
            }
            //            dev_export($details_data);die;
            //            $pack_list = $this->MDelivery->get_all_pack_list($pack_id);
            //            if (isset($pack_list['data']) && !empty($pack_list['data'])) {
            //                $data['pack_list'] = $pack_list['data'];
            //            } else {
            //                $data['pack_list'] = NULL;
            //            }
            $data['delivery_id'] = $pack_id;
            $data['emp_id'] = $emp_id;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery_return/faculty_dlivery_pack_items', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function deliveryReturn_save()
    {
        if ($this->input->is_ajax_request() == 1) {
            $delivery_id = filter_input(INPUT_POST, 'delivery_id', FILTER_SANITIZE_NUMBER_INT);
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
            $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);
            $tax = filter_input(INPUT_POST, 'tax', FILTER_SANITIZE_STRING);
            $pay_back_amount = filter_input(INPUT_POST, 'pay_back_amount', FILTER_SANITIZE_STRING);
            $net_value = filter_input(INPUT_POST, 'net_value', FILTER_SANITIZE_STRING);
            $reason = filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING);
            $delivery_data = filter_input(INPUT_POST, 'delivery_data');
            $return_roundoff = filter_input(INPUT_POST, 'return_roundoff', FILTER_SANITIZE_STRING);
            $total_before_roundoff = filter_input(INPUT_POST, 'total_before_roundoff', FILTER_SANITIZE_STRING);
            //            dev_export($reason);die;
            if ($sub_total == 0) {
                $sub_total = -1;
            }
            if ($tax == 0) {
                $tax = -1;
            }
            if ($net_value == 0) {
                $net_value = -1;
            }

            if ($pay_back_amount == 0) {
                $pay_back_amount = $net_value;
            }

            if (!(isset($delivery_id) && !empty($delivery_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Delivery data is mandatory'));
                return true;
            }

            $delivery_status = $this->MDelivery->deliveryReturn_save($delivery_id, $student_id, $sub_total, $tax, $net_value, $reason, $delivery_data, $return_roundoff, $total_before_roundoff, $pay_back_amount);
            //                dev_export($delivery_status);die;
            if (isset($delivery_status) && !empty($delivery_status) && isset($delivery_status['data_status']) && !empty($delivery_status['data_status']) && $delivery_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Delivery return,' . $delivery_status['del_ret'] . ' saved successfully : ', 'del_retno' => $delivery_status['del_ret']));
                return true;
            } else {
                if (isset($delivery_status['message']) && !empty($delivery_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $delivery_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please try again or contact administrator with error code : PAPRCNTR1001'));
                    return true;
                }

                return true;
            }
            //            } else {
            //                echo json_encode(array('status' => 2, 'message' => 'All Mandatory fields should be entered with valid values.'));
            //                return true;
            //            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function faculty_deliveryReturn_save()
    {
        if ($this->input->is_ajax_request() == 1) {
            $delivery_id = filter_input(INPUT_POST, 'delivery_id', FILTER_SANITIZE_NUMBER_INT);
            $emp_id = filter_input(INPUT_POST, 'emp_id', FILTER_SANITIZE_NUMBER_INT);
            $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);
            $tax = filter_input(INPUT_POST, 'tax', FILTER_SANITIZE_STRING);
            $net_value = filter_input(INPUT_POST, 'net_value', FILTER_SANITIZE_STRING);
            $reason = filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING);
            $delivery_data = filter_input(INPUT_POST, 'delivery_data');
            $return_roundoff = filter_input(INPUT_POST, 'return_roundoff', FILTER_SANITIZE_STRING);
            $total_before_roundoff = filter_input(INPUT_POST, 'total_before_roundoff', FILTER_SANITIZE_STRING);

            if ($sub_total == 0) {
                $sub_total = -1;
            }
            if ($net_value == 0) {
                $net_value = -1;
            }
            if ($tax == 0) {
                $tax = -1;
            }


            //            dev_export($reason);die;

            if (!(isset($delivery_id) && !empty($delivery_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Delivery data is mandatory'));
                return true;
            }

            $delivery_status = $this->MDelivery->faculty_deliveryReturn_save($delivery_id, $emp_id, $sub_total, $tax, $net_value, $reason, $delivery_data, $return_roundoff, $total_before_roundoff);
            //                dev_export($delivery_status);die;
            if (isset($delivery_status) && !empty($delivery_status) && isset($delivery_status['data_status']) && !empty($delivery_status['data_status']) && $delivery_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Delivery return,' . $delivery_status['del_ret'] . ' saved successfully : ', 'del_retno' => $delivery_status['del_ret']));
                return true;
            } else {
                if (isset($delivery_status['message']) && !empty($delivery_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $delivery_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please try again or contact administrator with error code : PAPRCNTR1001'));
                    return true;
                }

                return true;
            }
            //            } else {
            //                echo json_encode(array('status' => 2, 'message' => 'All Mandatory fields should be entered with valid values.'));
            //                return true;
            //            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function search_byvoucher()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['key'] = strtoupper(filter_input(INPUT_POST, 'searchvoucher', FILTER_SANITIZE_STRING));
            $data_prep['student_id'] = strtoupper(filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING));
            //            dev_export($data_prep);die;
            $details_data = $this->MDelivery->voucher_search($data_prep);

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');
            $data['search_parameter'] = $data_prep['key'];

            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery/delivery_onvoucher_search', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function search_bystudvoucher()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['key'] = strtoupper(filter_input(INPUT_POST, 'searchvoucher', FILTER_SANITIZE_STRING));
            $data_prep['student_id'] = strtoupper(filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING));
            //        
            $details_data = $this->MDelivery->voucher_search($data_prep);
            //                dev_export($details_data);die;

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['pack_list'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['pack_list'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');
            $data['search_parameter'] = $data_prep['key'];

            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery/student_delivery_onvoucher_search', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function search_by_emp_voucher()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['key'] = strtoupper(filter_input(INPUT_POST, 'searchvoucher', FILTER_SANITIZE_STRING));
            $data_prep['flag'] = 1;
            $data_prep['emp_id'] = strtoupper(filter_input(INPUT_POST, 'emp_id', FILTER_SANITIZE_STRING));

            $details_data = $this->MDelivery->uniform_voucher_search_faculty($data_prep);
            //            dev_export($details_data);die;


            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['pack_list'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['pack_list'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');
            $data['search_parameter'] = $data_prep['key'];

            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery/faculty_voucher_search', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function search_bystudvoucher_rtn()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['key'] = strtoupper(filter_input(INPUT_POST, 'searchvoucher', FILTER_SANITIZE_STRING));
            $data_prep['student_id'] = strtoupper(filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING));
            //        
            $details_data = $this->MDelivery->voucher_search($data_prep);
            //                dev_export($details_data);die;

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['pack_list'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['pack_list'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');
            $data['search_parameter'] = $data_prep['key'];

            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery_return/student_deliveryReturn_search', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function search_by_emp_voucher_rtn()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['key'] = strtoupper(filter_input(INPUT_POST, 'searchvoucher', FILTER_SANITIZE_STRING));
            $data_prep['flag'] = 0;
            $data_prep['emp_id'] = strtoupper(filter_input(INPUT_POST, 'emp_id', FILTER_SANITIZE_STRING));
            //        
            $details_data = $this->MDelivery->uniform_voucher_search_faculty($data_prep);
            //                dev_export($details_data);die;

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['pack_list'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['pack_list'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');
            $data['search_parameter'] = $data_prep['key'];

            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery_return/faculty_voucher_search', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function search_Returnbyvoucher()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['key'] = strtoupper(filter_input(INPUT_POST, 'searchvoucher', FILTER_SANITIZE_STRING));
            //            dev_export($data_prep);die;
            $details_data = $this->MDelivery->voucher_search($data_prep);

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');
            //            dev_export($this->load->view('delivery_return/student_deliveryReturn_onvoucher_search', $data, TRUE));die;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery_return/student_deliveryReturn_onvoucher_search', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function deliveryOHReturn_save()
    {
        if ($this->input->is_ajax_request() == 1) {
            $delivery_id = filter_input(INPUT_POST, 'delivery_id', FILTER_SANITIZE_NUMBER_INT);
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
            $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);
            $tax = filter_input(INPUT_POST, 'tax', FILTER_SANITIZE_STRING);
            $pay_back_amount = filter_input(INPUT_POST, 'pay_back_amount', FILTER_SANITIZE_STRING);
            $net_value = filter_input(INPUT_POST, 'net_value', FILTER_SANITIZE_STRING);
            $reason = filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING);
            $return_roundoff = filter_input(INPUT_POST, 'return_roundoff', FILTER_SANITIZE_STRING);
            $total_before_roundoff = filter_input(INPUT_POST, 'total_before_roundoff', FILTER_SANITIZE_STRING);
            //            dev_export($reason);die;
            if ($sub_total == 0) {
                $sub_total = -1;
            }
            if ($tax == 0) {
                $tax = -1;
            }
            if ($net_value == 0) {
                $net_value = -1;
            }

            if ($pay_back_amount == 0) {
                $pay_back_amount = $net_value;
            }


            if (!(isset($delivery_id) && !empty($delivery_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Delivery data is mandatory'));
                return true;
            }

            $delivery_status = $this->MDelivery->deliveryOHReturn_save($delivery_id, $student_id, $sub_total, $tax, $net_value, $reason, $return_roundoff, $total_before_roundoff, $pay_back_amount);
            //                dev_export($purchase_status);die;
            if (isset($delivery_status) && !empty($delivery_status) && isset($delivery_status['data_status']) && !empty($delivery_status['data_status']) && $delivery_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => ' OH Delivery return,' . $delivery_status['del_ret'] . ' saved successfully : ', 'del_retno' => $delivery_status['del_ret']));
                return true;
            } else {
                if (isset($delivery_status['message']) && !empty($delivery_status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $delivery_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please try again or contact administrator with error code : PAPRCNTR1001'));
                    return true;
                }

                return true;
            }
            //            } else {
            //                echo json_encode(array('status' => 2, 'message' => 'All Mandatory fields should be entered with valid values.'));
            //                return true;
            //            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function online_billed_list()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Online Billed Order';
            $data['sub_title'] = 'Online Billed Order';
            $details_data = $this->MDelivery->get_all_online_order();
            // dev_export($details_data);;
            // die;
            if (!empty($details_data['data'])) {
                $data['online_order_data'] = $details_data['data'];
            } else {
                $data['online_order_data'] = [];
            }
            echo $this->load->view('delivery/online_order_list', $data, true);
            // echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery/online_order_list', $data, TRUE)));
            // return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function search_packdetails_online_delivery()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Student Bill';
            $data['sub_title'] = 'Student Bill';
            $student_id = strtoupper(filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING));
            $pack_id = strtoupper(filter_input(INPUT_POST, 'packid', FILTER_SANITIZE_STRING));
            $details_data = $this->MRegistration->get_profiles_student($student_id);
            //            dev_export($details_data);;die;
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['student'] = $details_data['data'][0];
            } else {
                $data['student'] = NULL;
            }
            $pack_list = $this->MDelivery->get_all_pack_list($student_id);
            //            dev_export($pack_list);die;
            if (isset($pack_list['data']) && !empty($pack_list['data'])) {
                $data['pack_list'] = $pack_list['data'];
            } else {
                $data['pack_list'] = NULL;
            }
            $data['pack_id'] = $pack_id;
            $data['student_id'] = $student_id;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('delivery/student_delivery', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
