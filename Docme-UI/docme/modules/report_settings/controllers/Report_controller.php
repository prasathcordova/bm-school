<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report_controller
 *
 * @author docme2
 */
class Report_controller extends MX_Controller
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
        $this->load->model('Report_model', 'MReport');
    }

    public function show_report_settings()
    {
        $data['template'] = 'settings/show_settings';
        $data['title'] = 'REPORTS';
        $data['sub_title'] = 'Reports';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Registration Management',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Reports'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $this->load->view('template/home_template', $data);
    }

    public function show_report_settings_promotion()
    {
        $data['template'] = 'settings/show_settings_promotion';
        $data['title'] = 'REPORTS';
        $data['sub_title'] = 'Reports';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Promotion Management',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Reports'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $this->load->view('template/home_template', $data);
    }

    public function show_report_settings_tc()
    {
        $data['template'] = 'settings/show_settings_tc';
        $data['title'] = 'REPORTS';
        $data['sub_title'] = 'Reports';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'TC Management',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Reports'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $this->load->view('template/home_template', $data);
    }

    public function show_reportdata()
    {
        $data['sub_title'] = 'Custom Report';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Custom Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $this->load->view('report/show_report', $data);
    }

    public function show_report_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Batch'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $new_admission = filter_input(INPUT_POST, 'new_admission', FILTER_SANITIZE_NUMBER_INT);
            if ($new_admission == -1) {
                $title = 'Student Strength Details Report';
                $fname = '';
            } else {
                $title = 'Student Strength Details Report - New Admission';
                $fname = '_new_admitted';
            }
            //            $frmdt = filter_input(INPUT_POST, 'frmdt');
            //            $todt = filter_input(INPUT_POST, 'todt');

            $details_data = $this->MReport->get_studentstrng_rpt($acd_year_id, $class_id, $new_admission);

            $data['user_name'] = $this->session->userdata('user_name');
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                //$data['acd_year_id'] = $result_array[$rdata['Profession']][$rdata['Class']][0]['Description'];
                $data['user_name'] = $this->session->userdata('user_name');
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = $title;
                $data['bread_crumps'] = 'Registration Management > Reports > Student Strength Details Report';
                $data['filename_report'] = "reports/student" . $fname . "_strength_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'report/pdf_report';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    public function get_student_id_wise_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Batch'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            //$class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $batch_id = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $data_siwr = array(
                'action'  => 'get_student_id_wise_report',
                //'controller_function'   => 'Report_settings/Registration_report_controller/get_student_id_wise_report',
                'acd_year_id' => $acd_year_id,
                //'class_id' => $class_id,
                'batch_id' => $batch_id,
            );
            $details_data = $this->MReport->get_student_id_wise_report($data_siwr);
            // dev_export($details_data);
            // die;
            if ($rpt_type == 1) {
                $data['user_name'] = $this->session->userdata('user_name');
                if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                    $result_array = array();
                    foreach ($details_data['data'] as $det_data) {
                        // $result_array[$det_data['Class']][$det_data['Batch']] = array(
                        //     'Admn_no' => $det_data['Admn_No'],
                        //     'Batch' => $det_data['Batch']
                        // );
                        $result_array[$det_data['Class']][$det_data['Batch']][] = array(
                            'Admn_no' => $det_data['Admn_No'],
                            'Batch' => $det_data['Batch'],
                            'student_name' => $det_data['student_name'],
                            'acd_year' => $det_data['Description'],
                            'Parent_Name' => $det_data['Parent_Name'],
                            'Address' => $det_data['Address'],
                            'Phone' => $det_data['Phone'],
                            'Blood_Group' => $det_data['BloodGroup'],
                            'pickpoint' => $det_data['pickup_pickpointName'],
                            'tripNumber' => $det_data['tripNumber'],
                            'busNumber' => $det_data['BusNumber'],
                            'droppoint' => $det_data['droppointName'],
                            'drop_tripNumber' => $det_data['drop_tripNumber'],
                            'drop_busNumber' => $det_data['drop_BusNumber']
                        );
                    }
                    // dev_export($result_array);
                    // die;
                    $data['details_data'] = $result_array;
                    $data['acd_year_id'] = $result_array[$det_data['Class']][$det_data['Batch']][0]['acd_year'];
                    $data['user_name'] = $this->session->userdata('user_name');
                    $inst_id = $this->session->userdata('inst_id');
                    $user_id = $this->session->userdata('userid');
                    $data['title'] = 'Student ID Wise Details Report';
                    $data['bread_crumps'] = 'Registration Management > Reports > Student ID Wise Details Report';
                    $data['filename_report'] = "reports/student_id_wise_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/student_idwise_report_pdf';
                    $data['collection_date'] =  date('d/M/Y');
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                }
            } else {

                if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                    $result_array = array();
                    $collection_date =  date('d/m/Y');
                    foreach ($details_data['data'] as $det_data) {
                        $result_array[] = array(
                            'Admission_No.' => $det_data['Admn_No'],
                            'Student_name' => $det_data['student_name'],
                            'Batch' => $det_data['Batch'],
                            'Academic_Year' => $det_data['Description'],
                            'Parent_Name' => $det_data['Parent_Name'],
                            'Address' => $det_data['Address'],
                            'Contact_No.' => $det_data['Phone'],
                            'Blood_Group' => $det_data['BloodGroup'],
                            'Pickup_Point' => $det_data['pickup_pickpointName'],
                            'Pickup_Trip' => $det_data['tripNumber'],
                            'Pickup_Bus_No.' => $det_data['BusNumber'],
                            'DropPoint' => $det_data['droppointName'],
                            'Drop_Trip' => $det_data['drop_tripNumber'],
                            'Drop_Bus_No.' => $det_data['drop_BusNumber']
                        );
                    }
                    //print_r($result_array);exit;
                    $this->load->helper('sheet');
                    $filename_report = get_excel_report($result_array, 'student_id_wise_details_report', $collection_date);
                    echo json_encode(array('status' => 1, 'message' => base_url() . '/reports/sheets/' . $filename_report));
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                }
            }
        }
    }

    public function show_familywiserpt_data()
    {
        $data['sub_title'] = 'Familywise Details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $data['acdyr_data'] = $acdyr_data['data'];
        $this->load->view('familywise/familywise_rpt', $data);
    }

    public function show_familywise_data()
    {
        $data['sub_title'] = 'Family Wise Report';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('familywise/familywise_data_rpt.php', $data);
    }

    //report generate for familywise data by vinoth @ 17-06-2019 11:31
    public function show_familywise_report_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Family Wise Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Batch'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_NUMBER_INT);
            //            $frmdt = filter_input(INPUT_POST, 'frmdt');
            //            $todt = filter_input(INPUT_POST, 'todt');

            $details_data = $this->MReport->get_studentsfamilywise_rpt($acd_year_id, $class_id);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {

                $data['details_data'] = $details_data['data'];
                $data['user_name'] = $this->session->userdata('user_name');
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Family Wise Report';
                $data['bread_crumps'] = 'Registration Management > Reports > Family Wise Report';
                $data['filename_report'] = "reports/family_wise_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'report/pdf_report_familywise';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }


    //Familywise Report views
    public function familywiserpt_pdf()
    {
        if ($this->input->is_ajax_request() == 1) {

            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $frmdt = filter_input(INPUT_POST, 'frmdt');

            $details_data = $this->MReport->get_studentfamilywise_rpt($acd_year_id, $frmdt);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['user_name'] = $this->session->userdata('user_name');
            //            $data['page_title'] = 'Hello world'; 
            $pdfFilePath = FCPATH . "reports/filename.pdf";
            if (file_exists($pdfFilePath) == FALSE) {
                ini_set('memory_limit', '100M'); // boost the memory limit if it's low ;)

                $html = $this->load->view('familywise/family_rp_pdf', $data, true); // render the view into HTML
                $this->load->library('pdf');

                $pdf = $this->pdf->load();

                $header = $this->load->view('report/header', ['title' => 'Registration Management - Family Wise Student Report'], true);;
                $pdf->setAutoTopMargin = 'stretch';
                $pdf->setAutoBottomMargin = 'stretch';
                $pdf->SetHeader('|' . $header . '|');
                $pdf->SetFooter('Print by: ' . $data['user_name'] . '|{PAGENO}|' . date(DATE_RFC822)); // Add a footer for good measure ;)

                $pdf->WriteHTML($html); // write the HTML into the PDF

                $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
            }
            echo base_url('reports/filename.pdf');
            return true;
        }
    }

    public function strngthreportPDF()
    {
        $data['sub_title'] = 'Student Strength Details Report';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Custom Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        //            dev_export($acdyr_data);die;
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $data['acdyr_data'] = $acdyr_data['data'];
        $this->load->view('report/strength_rpt', $data);
    }

    public function student_id_wise_report()
    {
        $data['sub_title'] = 'Student ID Wise Details report';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Custom Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        //            dev_export($acdyr_data);die;
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
        $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
        // $batch = $this->MReport->get_batch_details_data($acd_year_id, $class_id);
        /* if (isset($batch['error_status']) && $batch['error_status'] == 0) {
            if ($batch['data_status'] == 1) {
                $data['batch_data'] = $batch['data'];
            } else {
                $data['batch_data'] = FALSE;
            }
        } else {
            $data['batch_data'] = FALSE;
        }

        $data['batch_data'] = $batch['data'];*/
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $data['acdyr_data'] = $acdyr_data['data'];
        $this->load->view('report/student_id_wise_report', $data);
    }

    //Nationalitywise view
    public function show_nationwiserpt_data()
    {
        $data['sub_title'] = 'Nationality Wise Details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $country_data = $this->MReport->get_all_country_list();
        if ($country_data['error_status'] == 0 && $country_data['data_status'] == 1) {
            $data['country_data'] = $country_data['data'];
            $data['message'] = "";
        } else {
            $data['country_data'] = FALSE;
            $data['message'] = $country_data['message'];
        }
        $data['country_data'] = $country_data['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('nationwise/nationwise_rpt', $data);
    }

    public function nationwiserpt_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Nationalitywise Details';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $nation = filter_input(INPUT_POST, 'country_select', FILTER_SANITIZE_STRING);
            $frmdt = filter_input(INPUT_POST, 'frmdt');
            $todt = filter_input(INPUT_POST, 'todt');

            $details_data = $this->MReport->get_studentnationwise_rpt($acd_year_id, $nation, $frmdt, $todt);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                // dev_export($result_array);
                // die;
                $data['details_data'] = $details_data['data'];
                $data['user_name'] = $this->session->userdata('user_name');
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Nationality Wise Details Report';
                $data['bread_crumps'] = 'Registration Management > Reports > Nationality Wise Details';
                $data['filename_report'] = "reports/nationality_wise_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'nationwise/nationrpt_pdf';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    //Religionwise Report
    public function show_religionwiserpt_data()
    {
        $data['sub_title'] = 'Religion Wise Details ';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $profession = $this->MReport->get_all_relegion();
        if (isset($profession['error_status']) && $profession['error_status'] == 0) {
            if ($profession['data_status'] == 1) {
                $data['relegion_data'] = $profession['data'];
            } else {
                $data['relegion_data'] = FALSE;
            }
        } else {
            $data['relegion_data'] = FALSE;
        }
        $data['relegion_data'] = $profession['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('religionwise/religionwise_rpt', $data);
    }

    public function religionwiserpt_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $religion = filter_input(INPUT_POST, 'religion_select', FILTER_SANITIZE_STRING);
            $frmdt = filter_input(INPUT_POST, 'frmdt');
            $todt = filter_input(INPUT_POST, 'todt');


            $details_data = $this->MReport->get_studentreligionwise_rpt($acd_year_id, $religion, $frmdt, $todt);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                // dev_export($result_array);
                // die;
                $data['details_data'] = $details_data['data'];
                $data['user_name'] = $this->session->userdata('user_name');
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Religion Wise Details Report';
                $data['bread_crumps'] = 'Registration Management > Reports > Religion Wise Details';
                $data['filename_report'] = "reports/religion_wise_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'religionwise/religionrpt_pdf';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    //Class/Divisionwise Report
    public function show_classdivsnwiserpt_data()
    {
        $data['sub_title'] = 'Class/Division Wise Details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('classdivisnwise/classdivisnwise_rpt', $data);
    }

    public function classdivsnwiserpt_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $class = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_STRING);
            $division = filter_input(INPUT_POST, 'div_id', FILTER_SANITIZE_STRING);
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $frmdt = filter_input(INPUT_POST, 'startdate');
            $todt = filter_input(INPUT_POST, 'enddate');

            $details_data = $this->MReport->get_studentclassdivisnwise_rpt($acd_year_id, $class, $frmdt, $todt, $division);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $details_data['data'];
                    $data['Sd'] = $frmdt;
                    $data['Ed'] = $todt;
                    $data['user_name'] = $this->session->userdata('user_name');
                    $inst_id = $this->session->userdata('inst_id');
                    $user_id = $this->session->userdata('userid');
                    $data['title'] = 'Class/Division Wise Details Report';
                    $data['bread_crumps'] = 'Registration Management > Reports > Class/Division Wise Details';
                    $data['filename_report'] = "reports/class_division_wise_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'classdivisnwise/classdivisionrpt_pdf';
                    $data['collection_date'] =  date('d/M/Y');
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                }
                if ($rpt_type == 2) {
                    $result_array = [];
                    if ($frmdt) {
                        $collection_date = 'Report Date : ' . date('d-m-Y', strtotime($frmdt)) . '  To  ' . date('d-m-Y', strtotime($todt));
                    } else {
                        $collection_date = 'Report Date : ' . date('d-m-Y');
                    }
                    foreach ($details_data['data'] as $sheet_data) {
                        $result_array[] = [
                            'Academic_Year' => $sheet_data['Description'],
                            'Class' => $sheet_data['Class'],
                            'Division' => $sheet_data['division'],
                            'Admission_No.' => $sheet_data['Admn_No'],
                            'Student_Name' => $sheet_data['student_name'],
                        ];
                    }
                    $this->load->helper('sheet');
                    $filename_report = get_excel_report($result_array, 'CLASS_DIVISION_WISE_DETAILS_REPORT', $collection_date);
                    echo json_encode(array('status' => 1, 'message' => base_url() . '/reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    //Genderwise Report

    public function show_genderwiserpt_data()
    {
        $data['sub_title'] = 'Gender Wise Details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('genderwise/genderwise_rpt', $data);
    }

    public function genderwiserpt_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
            $frmdt = filter_input(INPUT_POST, 'frmdt');
            $todt = filter_input(INPUT_POST, 'todt');

            $details_data = $this->MReport->get_genderwise_rpt($acd_year_id, $gender, $frmdt, $todt);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                // dev_export($result_array);
                // die;
                $data['details_data'] = $details_data['data'];
                $data['user_name'] = $this->session->userdata('user_name');
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Gender Wise Details Report';
                $data['bread_crumps'] = 'Registration Management > Reports > Gender Wise Details';
                $data['filename_report'] = "reports/gender_wise_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'genderwise/genderrpt_pdf';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    //Collected Document Report
    public function show_documentrpt_data()
    {
        $data['sub_title'] = 'Collected Document Details';

        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );

        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];

        $stream = $this->MReport->get_all_stream();
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

        $medium = $this->MReport->get_all_medium_list();
        if (isset($medium['error_status']) && $medium['error_status'] == 0) {
            if ($medium['data_status'] == 1) {
                $data['medium_data'] = $medium['data'];
            } else {
                $data['medium_data'] = FALSE;
            }
        } else {
            $data['medium_data'] = FALSE;
        }

        $data['medium_data'] = $medium['data'];

        $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
        $stream_id = filter_input(INPUT_POST, 'stream_select', FILTER_SANITIZE_NUMBER_INT);
        $class_id = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_NUMBER_INT);
        $medium_id = filter_input(INPUT_POST, 'medium_select', FILTER_SANITIZE_NUMBER_INT);
        //        dev_export(array($acd_year_id, $stream_id, $class_id, $medium_id));die;
        //                dev_export($acd_year_id);die;
        $batch = $this->MReport->get_batch_details($acd_year_id, $stream_id, $class_id, $medium_id);
        if (isset($batch['error_status']) && $batch['error_status'] == 0) {
            if ($batch['data_status'] == 1) {
                $data['batch_data'] = $batch['data'];
            } else {
                $data['batch_data'] = FALSE;
            }
        } else {
            $data['batch_data'] = FALSE;
        }

        $data['batch_data'] = $batch['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('document/document_rpt', $data);
    }

    public function documentrpt_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $batch = filter_input(INPUT_POST, 'batch_select', FILTER_SANITIZE_NUMBER_INT);

            $details_data = $this->MReport->get_document_rpt($acd_year_id, $batch);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                // dev_export($result_array);
                // die;
                $data['details_data'] = $details_data['data'];
                $data['user_name'] = $this->session->userdata('user_name');
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Collected Document Details Report';
                $data['bread_crumps'] = 'Registration Management > Reports > Collected Document Details';
                $data['filename_report'] = "reports/collected_document_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'document/documentrpt_pdf';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    public function get_batch_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_NUMBER_INT);
            $med_id = filter_input(INPUT_POST, 'medium_select', FILTER_SANITIZE_NUMBER_INT);
            $stream_id = filter_input(INPUT_POST, 'stream_select', FILTER_SANITIZE_NUMBER_INT);
            $state = $this->MReport->get_batch_details($acd_year_id, $class_id, $med_id, $stream_id);
            //                ($state);die;
            if (isset($state['error_status']) && $state['error_status'] == 0) {
                if ($state['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $state['data']));
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
    }

    public function get_division_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $acd_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_NUMBER_INT);
            $state = $this->MReport->get_division_details($acd_id, $class_id);
            //            dev_export($state);
            if (isset($state['error_status']) && $state['error_status'] == 0) {
                if ($state['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $state['data']));
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
    }

    //Longabsentee Report

    public function show_longabsenteerpt_data()
    {
        $data['sub_title'] = 'Long Absentee Details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];

        $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
        $class_id = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_NUMBER_INT);
        /* $batch = $this->MReport->get_batch_details_data($acd_year_id, $class_id);
        if (isset($batch['error_status']) && $batch['error_status'] == 0) {
            if ($batch['data_status'] == 1) {
                $data['batch_data'] = $batch['data'];
            } else {
                $data['batch_data'] = FALSE;
            }
        } else {
            $data['batch_data'] = FALSE;
        }*/

        $data['batch_data'] = null;
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('longabsentee/longabsentee_rpt', $data);
    }

    public function longabsenteerpt_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'TC Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $batch_id = filter_input(INPUT_POST, 'batch_select', FILTER_SANITIZE_NUMBER_INT);
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            if (isset($_POST['frmdt']) && isset($_POST['todt'])) {
                $frmdt = filter_input(INPUT_POST, 'frmdt');
                $todt = filter_input(INPUT_POST, 'todt');
                $details_data = $this->MReport->get_lonabsentee_rpt($acd_year_id, $batch_id, $frmdt, $todt);
            } else {
                $details_data = $this->MReport->get_lonabsentee_rpt($acd_year_id, $batch_id);
            }

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                // dev_export($details_data);
                // die;
                if ($rpt_type == 1) {
                    $data['details_data'] = $details_data['data'];
                    $data['user_name'] = $this->session->userdata('user_name');
                    $inst_id = $this->session->userdata('inst_id');
                    $user_id = $this->session->userdata('userid');
                    $data['title'] = 'Long Absentee Details';
                    $data['bread_crumps'] = 'TC Management > Reports > Long Absentee Details';
                    $data['filename_report'] = "reports/long_absentee_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'longabsentee/longabsenteerpt_pdf';
                    $data['collection_date'] =  date('d/M/Y');
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                }
                if ($rpt_type == 2) {
                    $result_array = [];
                    $collection_date =  date('d/M/Y');
                    foreach ($details_data['data'] as $sheet_data) {
                        $result_array[] = [
                            'Academic_Year' => $sheet_data['Description'],
                            'Class' => $sheet_data['Class'],
                            'Batch' => $sheet_data['Batch'],
                            'Admission_No.' => $sheet_data['admn_no'],
                            'Student_Name' => $sheet_data['student_name'],
                            'Last_Date_of_Attendance' => date('d-m-Y', strtotime($sheet_data['last_date_of_attendance'])),
                            'Issue_Date' => date('d-m-Y', strtotime($sheet_data['date_of_issued']))

                        ];
                    }
                    $this->load->helper('sheet');
                    $filename_report = get_excel_report($result_array, 'LONG_ABSENTEE_DETAILS', $collection_date);
                    echo json_encode(array('status' => 1, 'message' => base_url() . '/reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    //Contactwise Report

    public function show_contactwiserpt_data()
    {
        $data['sub_title'] = 'Contact Details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];

        $stream = $this->MReport->get_all_stream();
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

        $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
        $stream_id = filter_input(INPUT_POST, 'stream_select', FILTER_SANITIZE_NUMBER_INT);
        $class_id = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_NUMBER_INT);
        //                dev_export($acd_year_id);die;
        $batch = $this->MReport->get_batch_detailss($acd_year_id, $stream_id, $class_id);
        if (isset($batch['error_status']) && $batch['error_status'] == 0) {
            if ($batch['data_status'] == 1) {
                $data['batch_data'] = $batch['data'];
            } else {
                $data['batch_data'] = FALSE;
            }
        } else {
            $data['batch_data'] = FALSE;
        }

        $data['batch_data'] = $batch['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('contactwise/contactwise_rpt', $data);
    }

    public function contactwiserpt_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_NUMBER_INT);
            $stream_id = filter_input(INPUT_POST, 'stream_select', FILTER_SANITIZE_NUMBER_INT);
            $batch_id = filter_input(INPUT_POST, 'batch_select', FILTER_SANITIZE_NUMBER_INT);
            $relation_id = filter_input(INPUT_POST, 'relation_select', FILTER_SANITIZE_STRING);

            $inst_id = $this->session->userdata('inst_id');
            if ($inst_id == 4) {
                $data['uuid_name'] = 'Emirates ID';
            } else {
                $data['uuid_name'] = 'Aadhar Number';
            }
            $data['user_name'] = $this->session->userdata('user_name');
            $data['relation'] = filter_input(INPUT_POST, 'relation_select', FILTER_SANITIZE_STRING);

            $details_data = $this->MReport->get_contact_rpt($acd_year_id, $class_id, $stream_id, $batch_id, $relation_id);
            // dev_export($details_data);
            // return;
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                // dev_export($result_array);
                // die;
                $data['details_data'] = $details_data['data'];
                $data['batch_id'] = $batch_id;
                $data['class_id'] = $class_id;
                $data['user_name'] = $this->session->userdata('user_name');
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Contact Details Report';
                $data['bread_crumps'] = 'Registration Management > Reports > Contact Details';
                $data['filename_report'] = "reports/contact_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'contactwise/contactwiserpt_pdf';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    //Agewise Report

    public function show_agewiserpt_data()
    {
        $data['sub_title'] = 'Age Wise details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];

        $stream = $this->MReport->get_all_stream();
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

        $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
        $stream_id = filter_input(INPUT_POST, 'stream_select', FILTER_SANITIZE_NUMBER_INT);
        $class_id = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_NUMBER_INT);
        //                dev_export(array($acd_year_id,$stream_id,$class_id));die;
        $batch = $this->MReport->get_batch_detailss($acd_year_id, $stream_id, $class_id);
        if (isset($batch['error_status']) && $batch['error_status'] == 0) {
            if ($batch['data_status'] == 1) {
                $data['batch_data'] = $batch['data'];
            } else {
                $data['batch_data'] = FALSE;
            }
        } else {
            $data['batch_data'] = FALSE;
        }

        $data['batch_data'] = $batch['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('agewise/agewise_rpt', $data);
    }

    public function agewiserpt_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_NUMBER_INT);
            $stream_id = filter_input(INPUT_POST, 'stream_select', FILTER_SANITIZE_NUMBER_INT);
            $batch_id = filter_input(INPUT_POST, 'batch_select', FILTER_SANITIZE_NUMBER_INT);
            $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
            $details_data = $this->MReport->get_agewise_rpt($acd_year_id, $class_id, $stream_id, $batch_id, $age);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                // dev_export($result_array);
                // die;
                $data['details_data'] = $details_data['data'];
                $data['user_name'] = $this->session->userdata('user_name');
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Age Wise Details Report';
                $data['bread_crumps'] = 'Registration Management > Reports > Age Wise Details';
                $data['filename_report'] = "reports/age_wise_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'agewise/agewiserpt_pdf';
                $data['collection_date'] =  date('d/M/Y');
                $data['cls'] = $class_id;
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    //castewise Report

    public function show_castewiserpt_data()
    {
        $data['sub_title'] = 'Caste Wise details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];

        $caste_data = $this->MReport->get_all_caste_list();
        if ($caste_data['error_status'] == 0 && $caste_data['data_status'] == 1) {
            $data['caste_data'] = $caste_data['data'];
            $data['message'] = "";
        } else {
            $data['caste_data'] = FALSE;
            $data['message'] = $caste_data['message'];
        }
        $data['caste_data'] = $caste_data['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('castewise/castewise_rpt', $data);
    }

    public function castewiserpt_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_NUMBER_INT);
            $caste = filter_input(INPUT_POST, 'caste_select', FILTER_SANITIZE_NUMBER_INT);

            $details_data = $this->MReport->get_castewise_rpt($acd_year_id, $class_id, $caste);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                // dev_export($result_array);
                // die;
                $data['details_data'] = $details_data['data'];
                $data['user_name'] = $this->session->userdata('user_name');
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Caste Wise Details Report';
                $data['bread_crumps'] = 'Registration Management > Reports > Caste Wise Details';
                $data['filename_report'] = "reports/caste_wise_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'castewise/castewiserpt_pdf';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    //Sex/Agewise Report

    public function show_agesexwiserpt_data()
    {
        $data['sub_title'] = 'Gender/Age Wise details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];
        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('sexagewise/sexagewise_rpt', $data);
    }

    public function agesexwiserpt_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $frmdt = filter_input(INPUT_POST, 'frmdt');
            $todt = filter_input(INPUT_POST, 'todt');

            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');

            $details_data = $this->MReport->get_sexagewise_rpt($acd_year_id, $class_id, $frmdt, $todt);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $result_array = array();
                foreach ($details_data['data'] as $ddata) {
                    $result_array[$ddata['Class']][] = array(
                        'Age' => $ddata['Age'],
                        'male' => $ddata['male'],
                        'female' => $ddata['female'],
                        'Description' => $ddata['Description']
                    );
                }
            }

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $result_array; //$details_data['data'];
                $data['acd_year_id'] = $result_array[$ddata['Class']][0]['Description'];
                $data['message'] = "";

                $data['user_name'] = $this->session->userdata('user_name');
                $data['title'] = 'Gender/Age Wise Details Report';
                $data['bread_crumps'] = 'Registration Management > Reports > Gender/Age Wise Details';
                $data['filename_report'] = "reports/gender_agewise_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'sexagewise/sexagewiserpt_pdf';
                $data['collection_date'] =  date('d/M/Y', strtotime($frmdt));
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    //Class wise Strength Report
    public function show_classwisesrngthrpt_data()
    {
        $data['sub_title'] = 'Class Wise Strength Details Report';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('classwisestrgth/classwise_rpt', $data);
    }

    //batch not alloted student list
    public function show_nobatchallotedstudrpt_data()
    {
        $data['sub_title'] = 'Batch Not Allotted Students List';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('no_batch_stud/no_batchstud_rpt', $data);
    }

    //create by vinoth @ 17-06-2019 10:34 family wise Report

    public function classwiserpt_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $class = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_NUMBER_INT);
            $details_data = $this->MReport->get_studentclasswisestrngth_rpt($acd_year_id, $class);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {

                $data['details_data'] = $details_data['data'];
                $data['user_name'] = $this->session->userdata('user_name');
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Class Wise Strength Details Report';
                $data['bread_crumps'] = 'Registration Management > Reports > Class Wise Strength Details Report';
                $data['filename_report'] = "reports/class_wise_strength_details_report_" . time() . ".pdf";
                $data['viewname'] = 'classwisestrgth/classwiserpt_pdf';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    //no batch student data get function
    public function no_batchstud_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Student Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $class = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_NUMBER_INT);

            $details_data = $this->MReport->get_no_batchstud_rpt($acd_year_id, $class);

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $result_array = array();
                foreach ($details_data['data'] as $ddata) {
                    $result_array[$ddata['Description']][] = array(
                        'Admn_No' => $ddata['Admn_No'],
                        'student_name' => $ddata['student_name'],
                        'year' => $ddata['year']
                    );
                }
                $data['details_data'] = $result_array;
                $data['acd_year_id'] = $result_array[$ddata['Description']][0]['year'];
                $data['user_name'] = $this->session->userdata('user_name');
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Batch Not Allotted Students Report';
                $data['bread_crumps'] = 'Registration Management > Reports > Batch Not Allotted Students Details';
                $data['filename_report'] = "reports/batch_not_allotted_students_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'no_batch_stud/no_batchstudrpt_pdf';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }


    //Professionwise Report
    public function show_professionwiserpt_data()
    {
        $data['sub_title'] = 'Profession Wise Details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $profession = $this->MReport->get_all_profession_list();
        //        dev_export($profession);die;
        if (isset($profession['error_status']) && $profession['error_status'] == 0) {
            if ($profession['data_status'] == 1) {
                $data['profession_data'] = $profession['data'];
            } else {
                $data['profession_data'] = FALSE;
            }
        } else {
            $data['profession_data'] = FALSE;
        }
        $data['profession_data'] = $profession['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('professionwise/professionwise_rpt', $data);
    }

    public function professsionwiserpt_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'REPORT';
            $data['sub_title'] = 'Profession Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Report'
                ),
                '2' => array(
                    'title' => 'Registration Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $profession = filter_input(INPUT_POST, 'profession_select', FILTER_SANITIZE_NUMBER_INT);

            $details_data = $this->MReport->get_professionwise_rpt($acd_year_id, $profession);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $result_array = array();
                foreach ($details_data['data'] as $rdata) {
                    $result_array[$rdata['Profession']][$rdata['Class']][] = array(
                        'Batch' => $rdata['Batch'],
                        'Strength' => $rdata['Strength'],
                        'Description' => $rdata['Description']
                    );
                }

                $data['details_data'] = $result_array;
                $data['acd_year_id'] = $result_array[$rdata['Profession']][$rdata['Class']][0]['Description'];
                $data['user_name'] = $this->session->userdata('user_name');
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Profession Wise Details Report';
                $data['bread_crumps'] = 'Registration Management > Reports > Profession Wise Details';
                $data['filename_report'] = "reports/profession_wise_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'professionwise/professionwise_pdf';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    //Promotion view
    public function show_preloader_promotion_report()
    {
        $data['sub_title'] = 'Promotion Details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        //            dev_export($acdyr_data);die;
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $data['acdyr_data'] = $acdyr_data['data'];
        $this->load->view('promotion/promotion_preloader', $data);
    }

    public function get_promotion_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year = filter_input(INPUT_POST, 'acd_year');
            $class_id = filter_input(INPUT_POST, 'class_id');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type');

            $report_data = $this->MReport->get_promotion_report_data($inst_id, $acd_year, $class_id);

            if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {

                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['user_name'] = $this->session->userdata('user_name');
                    $inst_id = $this->session->userdata('inst_id');
                    $user_id = $this->session->userdata('userid');
                    $data['title'] = 'Promotion Details Report';
                    $data['bread_crumps'] = 'Promotion Management > Reports > Promotion Details';
                    $data['filename_report'] = "reports/promotion_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'promotion/promotion_pdf';
                    $data['collection_date'] =  date('d/M/Y');
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                }
                if ($rpt_type == 2) {
                    $result_array = [];
                    $collection_date =  date('d/M/Y');
                    foreach ($report_data['data'] as $sheet_data) {
                        $result_array[] = [
                            'Admission_No.' => $sheet_data['Admn_No'],
                            'Student_Name' => $sheet_data['student_name'],
                            'Academic_Year' => $sheet_data['Description'],
                            'Batch' => $sheet_data['FROM_BATCH'],
                            'Promoted_Batch' => $sheet_data['TO_BATCH'],
                        ];
                    }
                    $this->load->helper('sheet');
                    $filename_report = get_excel_report($result_array, 'PROMOTION_DETAILS', $collection_date);
                    echo json_encode(array('status' => 1, 'message' => base_url() . '/reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            echo $this->load->view(ERROR_500);
            return;
        }
    }

    //Promotion view
    public function show_preloader_detained_report()
    {
        $data['sub_title'] = 'Detained Details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        //            dev_export($acdyr_data);die;
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $data['acdyr_data'] = $acdyr_data['data'];
        $this->load->view('promotion/detained_preloader', $data);
    }

    public function get_detained_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year = filter_input(INPUT_POST, 'acd_year');
            $class_id = filter_input(INPUT_POST, 'class_id');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type');

            $report_data = $this->MReport->get_detained_report_data($inst_id, $acd_year, $class_id);
            if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {
                // dev_export($result_array);
                // die;
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['user_name'] = $this->session->userdata('user_name');
                    $inst_id = $this->session->userdata('inst_id');
                    $user_id = $this->session->userdata('userid');
                    $data['title'] = 'Detained Details Report';
                    $data['bread_crumps'] = 'Promotion Management > Reports > Detained Details';
                    $data['filename_report'] = "reports/detained_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'promotion/detained_pdf';
                    $data['collection_date'] =  date('d/M/Y');
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                }
                if ($rpt_type == 2) {
                    $result_array = [];
                    foreach ($report_data['data'] as $sheet_data) {
                        $result_array[] = [
                            'Admn_No' => $sheet_data['Admn_No'],
                            'Student_Name' => $sheet_data['student_name'],
                            'Academic_Year' => $sheet_data['Description'],
                            'Batch' => $sheet_data['FROM_BATCH'],
                            'Detained_Batch' => $sheet_data['TO_BATCH'],
                        ];
                    }
                    $this->load->helper('sheet');
                    $filename_report = get_excel_report($result_array, 'DETAINED_DETAILS');
                    echo json_encode(array('status' => 1, 'message' => base_url() . '/reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            echo $this->load->view(ERROR_500);
            return;
        }
    }

    //TC summary view
    public function show_preloader_tc_summary_report()
    {
        $data['sub_title'] = 'TC Summary Details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        //            dev_export($acdyr_data);die;
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $data['acdyr_data'] = $acdyr_data['data'];
        $this->load->view('tc_reports/summary_preloader', $data);
    }

    public function get_tc_summary_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year = filter_input(INPUT_POST, 'acd_year');
            $class_id = filter_input(INPUT_POST, 'class_id');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type');

            $report_data = $this->MReport->get_tc_summary_report_data($inst_id, $acd_year, $class_id);

            if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['user_name'] = $this->session->userdata('user_name');
                    $inst_id = $this->session->userdata('inst_id');
                    $user_id = $this->session->userdata('userid');
                    $data['title'] = 'TC Summary Details Report';
                    $data['bread_crumps'] = 'TC Management > Reports > TC Summary Details';
                    $data['filename_report'] = "reports/tc_summary_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'tc_reports/tc_summary_pdf';
                    $data['collection_date'] =  date('d/M/Y');
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                }
                if ($rpt_type == 2) {
                    $result_array = [];
                    $collection_date =  date('d/M/Y');
                    foreach ($report_data['data'] as $sheet_data) {
                        $result_array[] = [
                            'Class' => $sheet_data['class_name'],
                            'Batch' => $sheet_data['batch_name'],
                            'Admission_No.' => $sheet_data['Admn_No'],
                            'Student_Name' => $sheet_data['student_name'],
                            'Applied_Date' => date('d-m-Y', strtotime($sheet_data['applied_date'])),
                            'Reason_For_Leaving' => $sheet_data['reason_for_leaveving'],
                            'Status' => $sheet_data['app_status']
                        ];
                    }
                    $this->load->helper('sheet');
                    $filename_report = get_excel_report($result_array, 'TC_SUMMARY_DETAILS', $collection_date);
                    echo json_encode(array('status' => 1, 'message' => base_url() . '/reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            echo $this->load->view(ERROR_500);
            return;
        }
    }

    //TC applied view
    public function show_preloader_tc_applied_report()
    {
        $data['sub_title'] = 'TC Applied Details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('tc_reports/tc_applied_preloader', $data);
    }
    public function get_tc_applied_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year = filter_input(INPUT_POST, 'acd_year');
            $class_id = filter_input(INPUT_POST, 'class_select');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type');

            $report_data = $this->MReport->get_tc_app_status_report_data_applied($inst_id, $acd_year, $class_id);
            if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['user_name'] = $this->session->userdata('user_name');
                    $inst_id = $this->session->userdata('inst_id');
                    $user_id = $this->session->userdata('userid');
                    $data['title'] = 'TC Applied Details Report';
                    $data['bread_crumps'] = 'TC Management > Reports > TC Applied Details';
                    $data['filename_report'] = "reports/tc_applied_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'tc_reports/tc_applied_pdf';
                    $data['collection_date'] =  date('d/M/Y');
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                }
                if ($rpt_type == 2) {
                    $result_array = [];
                    $collection_date =  date('d/M/Y');
                    foreach ($report_data['data'] as $sheet_data) {
                        $result_array[] = [
                            'Class' => $sheet_data['class_name'],
                            'Batch' => $sheet_data['batch_name'],
                            'Admission_No.' => $sheet_data['Admn_No'],
                            'Student_Name' => $sheet_data['student_name'],
                            'Applied_Date' => date('d-m-Y', strtotime($sheet_data['applied_date'])),
                            'Reason_For_Leaving' => $sheet_data['reason_for_leaveving'],
                            'Status' => $sheet_data['app_status']
                        ];
                    }
                    $this->load->helper('sheet');
                    $filename_report = get_excel_report($result_array, 'TC_APPLIED_DETAILS', $collection_date);
                    echo json_encode(array('status' => 1, 'message' => base_url() . '/reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            echo $this->load->view(ERROR_500);
            return;
        }
    }

    //TC prepared view
    public function show_preloader_tc_issue_report()
    {
        $data['sub_title'] = 'TC Issued Details';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        $data['acdyr_data'] = $acdyr_data['data'];

        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $this->load->view('tc_reports/tc_prepared_preloader', $data);
    }
    public function get_tc_prepared_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year = filter_input(INPUT_POST, 'acd_year');
            $class_id = filter_input(INPUT_POST, 'class_select');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type');

            $report_data = $this->MReport->get_tc_app_status_report_data_prepared($inst_id, $acd_year, $class_id);
            if ($report_data['error_status'] == 0 && $report_data['data_status'] == 1) {

                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['user_name'] = $this->session->userdata('user_name');
                    $inst_id = $this->session->userdata('inst_id');
                    $user_id = $this->session->userdata('userid');
                    $data['title'] = 'TC Issued Details';
                    $data['bread_crumps'] = 'TC Management > Reports > TC Issued Details';
                    $data['filename_report'] = "reports/tc_issued_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'tc_reports/tc_prepared_pdf';
                    $data['collection_date'] =  date('d/M/Y');
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                }
                if ($rpt_type == 2) {
                    $result_array = [];
                    $collection_date =  date('d/M/Y');
                    foreach ($report_data['data'] as $sheet_data) {
                        $result_array[] = [
                            'Class' => $sheet_data['class_name'],
                            'Batch' => $sheet_data['batch_name'],
                            'Admission_No.' => $sheet_data['Admn_No'],
                            'Student_Name' => $sheet_data['student_name'],
                            'Applied_Date' => date('d/m/Y', strtotime($sheet_data['applied_date'])),
                            'Reason_for_leaving ' => (string)$sheet_data['reason_for_leaveving'],
                            'Status' => $sheet_data['app_status'],
                        ];
                    }
                    $this->load->helper('sheet');
                    $filename_report = get_excel_report($result_array, 'TC_ISSUED_DETAILS', $collection_date);
                    echo json_encode(array('status' => 1, 'message' => base_url() . '/reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            echo $this->load->view(ERROR_500);
            return;
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
        $pdf->WriteHTML($html); // write the HTML into the PDF
        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file 
        //}
        return base_url($data['filename_report']);
    }

    public function Course_Classwise_reportPDF()
    {
        $data['sub_title'] = 'Class Wise Report';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Custom Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        //            dev_export($acdyr_data);die;
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $data['acdyr_data'] = $acdyr_data['data'];
        $this->load->view('CourseRpt/classwise', $data);
    }

    public function course_class_reportdata()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'CLASS WISE REPORT';
            $data['sub_title'] = 'Class Wise Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Class'
                ),
                '2' => array(
                    'title' => 'Course Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);

            $details_data = $this->MReport->get_course_classwise_rpt($acd_year);
            $data['user_name'] = $this->session->userdata('user_name');
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['acd_year'] = $acd_year;
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Class Wise Report';
                $data['bread_crumps'] = 'Course Management > Reports > Class Wise Report';
                $data['filename_report'] = "reports/class_wise_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'CourseRpt/pdf_report_classwise';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    public function Course_Batchwise_reportdata()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'BATCH WISE REPORT';
            $data['sub_title'] = 'Batch Wise Report';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('report/show-reportdata'),
                    'title' => 'Batch'
                ),
                '2' => array(
                    'title' => 'Course Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);

            $details_data = $this->MReport->get_course_batchwise_rpt($acd_year_id, $class_id);
            $data['user_name'] = $this->session->userdata('user_name');
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $inst_id = $this->session->userdata('inst_id');
                $user_id = $this->session->userdata('userid');
                $data['title'] = 'Batch Wise Report';
                $data['bread_crumps'] = 'Course Management > Reports > Batch Wise Report';
                $data['filename_report'] = "reports/batch_wise_report_" . $inst_id . "_" . $user_id . ".pdf";
                $data['viewname'] = 'CourseRpt/pdf_report_batchwise';
                $data['collection_date'] =  date('d/M/Y');
                $filename = $this->get_pdf_report($data);
                //echo $filename;
                echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        }
    }

    public function course_batch_reportPDF()
    {
        $data['sub_title'] = 'Batch Wise Report';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Custom Report',
                'link' => base_url('report/show-reportdata')
            ),
            '2' => array(
                'title' => 'Generate'
            )
        );
        $acdyr_data = $this->MReport->get_all_acadyr();
        //            dev_export($acdyr_data);die;
        if (isset($acdyr_data['error_status']) && $acdyr_data['error_status'] == 0) {
            if ($acdyr_data['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr_data['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $class = $this->MReport->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        $data['class_data'] = $class['data'];
        $data['acdyr_selected'] = $this->session->userdata('acd_year');
        $data['acdyr_data'] = $acdyr_data['data'];
        $this->load->view('CourseRpt/batchwise', $data);
    }
}
