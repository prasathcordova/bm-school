<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transport_report_controller
 *
 * @author chandrajith.edsys
 */
class Transport_report_controller extends MX_Controller
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
        ini_set('memory_limit', '-1');
        $this->load->model('Transport_report_model', 'MTReport');
    }

    public function show_report_settings()
    {
        $data['template'] = 'settings/show_settings';
        $data['title'] = 'TRANSPORT REPORTS';
        $data['sub_title'] = 'Reports';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('report/show-transportreportdata'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Docme Transport ',
                'link' => base_url('report/show-transportreportdata')
            ),
            '2' => array(
                'title' => 'Transport Reports'
            )
        );
        $transport_date_lock = $this->MTReport->report_lock_date();
        //            dev_export($report_date_lock);die;
        if (isset($transport_date_lock['data_status']) && !empty($transport_date_lock['data_status']) && $transport_date_lock['data_status'] == 1) {
            $this->session->set_userdata('lock_start_date', date('d-m-Y', strtotime($transport_date_lock['data'][0]['Academic_year_startdate'])));
            $this->session->set_userdata('lock_end_date', date('d-m-Y', strtotime($transport_date_lock['data'][0]['Academicyear_enddate'])));
        } else {
            $this->session->set_userdata('lock_start_date', date('d-m-Y'));
            $this->session->set_userdata('lock_end_date', date('d-m-Y', strtotime('+1 year')));
        }

        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $this->load->view('template/transport_template', $data);
    }

    //Pre loaders

    public function get_preload_transport_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'FUEL LOG REPORT';
            $inst_id = $this->session->userdata('inst_id');
            $vehicle_data = $this->MTReport->get_all_vehicle_details($inst_id);
            //        dev_export($vehicle_data);die;
            if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
                $data['vehicle_data'] = $vehicle_data['data'];
            } else {
                $data['vehicle_data'] = NULL;
            }
            $report_date_lock = $this->MTReport->report_lock_date();
            //            dev_export($report_date_lock);die;
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1) {
                $data['report_lock_start_date'] = $report_date_lock['data'][0]['Academic_year_startdate'];
                $data['report_lock_end_date'] = $report_date_lock['data'][0]['Academicyear_enddate'];
            } else
                $data['report_lock_date'] = NULL;
            $this->load->view('reports/preloaders/transport_report', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function get_preload_vehicle_incidents_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Vehicle Incident Report';
            $inst_id = $this->session->userdata('inst_id');
            $vehicle_data = $this->MTReport->get_all_vehicle_details($inst_id);
            //        dev_export($vehicle_data);die;
            if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
                $data['vehicle_data'] = $vehicle_data['data'];
            } else {
                $data['vehicle_data'] = NULL;
            }
            $report_date_lock = $this->MTReport->report_lock_date();
            //            dev_export($report_date_lock);die;
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1) {
                $data['report_lock_start_date'] = $report_date_lock['data'][0]['Academic_year_startdate'];
                $data['report_lock_end_date'] = $report_date_lock['data'][0]['Academicyear_enddate'];
            } else
                $data['report_lock_date'] = NULL;
            $this->load->view('reports/preloaders/vehicle_incidents_report', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_preload_vehicle_costwise_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Vehicle Costwise Report';
            $inst_id = $this->session->userdata('inst_id');
            $vehicle_data = $this->MTReport->get_all_vehicle_details($inst_id);
            //        dev_export($vehicle_data);die;
            if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
                $data['vehicle_data'] = $vehicle_data['data'];
            } else {
                $data['vehicle_data'] = NULL;
            }
            $report_date_lock = $this->MTReport->report_lock_date();
            //            dev_export($report_date_lock);die;
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1) {
                $data['report_lock_start_date'] = $report_date_lock['data'][0]['Academic_year_startdate'];
                $data['report_lock_end_date'] = $report_date_lock['data'][0]['Academicyear_enddate'];
            } else
                $data['report_lock_date'] = NULL;
            $this->load->view('reports/preloaders/vehicle_costwise_report', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_preload_vehicle_expenditure_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Vehicle Expenditure Report';
            $inst_id = $this->session->userdata('inst_id');
            $vehicle_data = $this->MTReport->get_all_vehicle_details($inst_id);
            //        dev_export($vehicle_data);die;
            if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
                $data['vehicle_data'] = $vehicle_data['data'];
            } else {
                $data['vehicle_data'] = NULL;
            }
            $report_date_lock = $this->MTReport->report_lock_date();
            //            dev_export($report_date_lock);die;
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1) {
                $data['report_lock_start_date'] = $report_date_lock['data'][0]['Academic_year_startdate'];
                $data['report_lock_end_date'] = $report_date_lock['data'][0]['Academicyear_enddate'];
            } else
                $data['report_lock_date'] = NULL;
            $this->load->view('reports/preloaders/vehicle_expenditure_report', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_preload_vehicle_expenditure_summary_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Vehicle Expenditure Summary Report';
            $inst_id = $this->session->userdata('inst_id');
            $vehicle_data = $this->MTReport->get_all_vehicle_details($inst_id);
            //        dev_export($vehicle_data);die;
            if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
                $data['vehicle_data'] = $vehicle_data['data'];
            } else {
                $data['vehicle_data'] = NULL;
            }
            $report_date_lock = $this->MTReport->report_lock_date();
            //            dev_export($report_date_lock);die;
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1) {
                $data['report_lock_start_date'] = $report_date_lock['data'][0]['Academic_year_startdate'];
                $data['report_lock_end_date'] = $report_date_lock['data'][0]['Academicyear_enddate'];
            } else
                $data['report_lock_date'] = NULL;
            $this->load->view('reports/preloaders/vehicle_expenditure_summary_report', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_preload_vehicle_maintanance_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Vehicle Maintenance Report';
            $inst_id = $this->session->userdata('inst_id');
            $vehicle_data = $this->MTReport->get_all_vehicle_details($inst_id);
            if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
                $data['vehicle_data'] = $vehicle_data['data'];
            } else {
                $data['vehicle_data'] = NULL;
            }
            $report_date_lock = $this->MTReport->report_lock_date();
            //            dev_export($report_date_lock);die;
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1) {
                $data['report_lock_start_date'] = $report_date_lock['data'][0]['Academic_year_startdate'];
                $data['report_lock_end_date'] = $report_date_lock['data'][0]['Academicyear_enddate'];
            } else
                $data['report_lock_date'] = NULL;
            $this->load->view('reports/preloaders/vehicle_maintanance_report', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_preload_vehicle_maintanance_summary_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Vehicle Maintenance Summary Report';
            $inst_id = $this->session->userdata('inst_id');
            $vehicle_data = $this->MTReport->get_all_vehicle_details($inst_id);
            //        dev_export($vehicle_data);die;
            if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
                $data['vehicle_data'] = $vehicle_data['data'];
            } else {
                $data['vehicle_data'] = NULL;
            }
            $report_date_lock = $this->MTReport->report_lock_date();
            //            dev_export($report_date_lock);die;
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1) {
                $data['report_lock_start_date'] = $report_date_lock['data'][0]['Academic_year_startdate'];
                $data['report_lock_end_date'] = $report_date_lock['data'][0]['Academicyear_enddate'];
            } else
                $data['report_lock_date'] = NULL;
            $this->load->view('reports/preloaders/vehicle_maintanance_summary_report', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }


    public function get_preload_transport_fuelconsumption()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'FUEL CONSUMPTION REPORT';
            $inst_id = $this->session->userdata('inst_id');
            $vehicle_data = $this->MTReport->get_all_vehicle_details($inst_id);
            //        dev_export($vehicle_data);die;
            if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
                $data['vehicle_data'] = $vehicle_data['data'];
            } else {
                $data['vehicle_data'] = NULL;
            }
            $report_date_lock = $this->MTReport->report_lock_date();
            //            dev_export($report_date_lock);die;
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1) {
                $data['report_lock_start_date'] = $report_date_lock['data'][0]['Academic_year_startdate'];
                $data['report_lock_end_date'] = $report_date_lock['data'][0]['Academicyear_enddate'];
            } else
                $data['report_lock_date'] = NULL;
            $this->load->view('reports/preloaders/transport_fuel_consumption', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function gen_route_trip_preloads()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'TRIP REPORT';
            $inst_id = $this->session->userdata('inst_id');
            $route_data = $this->MTReport->get_all_vehicle_route_data($inst_id);
            if (isset($route_data['data']) && !empty($route_data['data'])) {
                $data['route_data'] = $route_data['data'];
            } else {
                $data['route_data'] = NULL;
            }

            $this->load->view('reports/preloaders/transport_tripwisepre', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function gen_route_trip_pick_preloads()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'TRIP-PICKUP POINT REPORT';
            $inst_id = $this->session->userdata('inst_id');
            $route_data = $this->MTReport->get_all_vehicle_route_data($inst_id);
            $inst_id = $this->session->userdata('inst_id');
            if (isset($route_data['data']) && !empty($route_data['data'])) {
                $data['route_data'] = $route_data['data'];
            } else {
                $data['route_data'] = NULL;
            }
            $stops_data = $this->MTReport->get_stopsdetails("ALL", $inst_id);
            if (isset($stops_data['data']) && !empty($stops_data['data'])) {
                $data['stops_data'] = $stops_data['data'];
            } else {
                $data['stops_data'] = NULL;
            }

            $this->load->view('reports/preloaders/transport_pickwisepre', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function gen_pick_fees_preloads()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'PICKUP POINT-FEES REPORT';
            $inst_id = $this->session->userdata('inst_id');
            $trips_data = $this->MTReport->get_all_vehicle_route_data($inst_id);
            if (isset($trips_data['data']) && !empty($trips_data['data'])) {
                $data['trips_data'] = $trips_data['data'];
            } else {
                $data['trips_data'] = NULL;
            }

            $this->load->view('reports/preloaders/transport_pick_feespre', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    function get_preload_studclasswise()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'CLASS-TRANSPORT REPORT';
            $inst_id = $this->session->userdata('inst_id');
            //        STREAM DATA
            $stream = $this->MTReport->get_all_stream();
            // dev_export($stream);
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
            $class = $this->MTReport->get_all_class();
            // dev_export($class);
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
            $acdyr = $this->MTReport->get_all_acadyr();
            // dev_export($acdyr);
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
            $batch = $this->MTReport->get_all_batch($this->session->userdata('acd_year'));
            // dev_export($batch);
            // return;
            if (isset($batch['error_status']) && $batch['error_status'] == 0) {
                if ($batch['data_status'] == 1) {
                    $data['batch_data'] = $batch['data'];
                } else {
                    $data['batch_data'] = FALSE;
                }
            } else {
                $data['batch_data'] = FALSE;
            }
            $this->load->view('reports/preloaders/student_classwise_report', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }
    function get_preload_studtripwise()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'TRIP-STUDENT REPORT';
            $inst_id = $this->session->userdata('inst_id');
            $route_data = $this->MTReport->get_all_vehicle_route_data($inst_id);

            if (isset($route_data['data']) && !empty($route_data['data'])) {
                $data['route_data'] = $route_data['data'];
            } else {
                $data['route_data'] = NULL;
            }
            $this->load->view('reports/preloaders/student_tripwise_report', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }
    function get_preload_studpickupwise()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'PICKUP/DROP POINT-STUDENT REPORT';
            $inst_id = $this->session->userdata('inst_id');
            $route_data = $this->MTReport->get_all_vehicle_route_data($inst_id);

            if (isset($route_data['data']) && !empty($route_data['data'])) {
                $data['route_data'] = $route_data['data'];
            } else {
                $data['route_data'] = NULL;
            }

            $stops_data = $this->MTReport->get_stopsdetails("ALL", $inst_id);
            if (isset($stops_data['data']) && !empty($stops_data['data'])) {
                $data['stops_data'] = $stops_data['data'];
            } else {
                $data['stops_data'] = NULL;
            }
            $this->load->view('reports/preloaders/student_pickupwise_report', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_preload_vehicle_trip()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'VEHICLE-TRIP REPORT';
            $inst_id = $this->session->userdata('inst_id');
            $route_data = $this->MTReport->get_all_vehicle_route_data($inst_id);

            if (isset($route_data['data']) && !empty($route_data['data'])) {
                $data['route_data'] = $route_data['data'];
            } else {
                $data['route_data'] = NULL;
            }
            $vehicle_data = $this->MTReport->get_all_vehicle_details($inst_id);
            //        dev_export($vehicle_data);die;
            if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
                $data['vehicle_data'] = $vehicle_data['data'];
            } else {
                $data['vehicle_data'] = NULL;
            }
            $this->load->view('reports/preloaders/vehicle_trip_report', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    //get trip name by vinoth @ 10-06-2019 11:34
    public function get_trip()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($vehicle_id) && !empty($vehicle_id)) {
                $inst_id = $this->session->userdata('inst_id');
                $stops_data = $this->MTReport->get_trip($vehicle_id, $inst_id);

                if (isset($stops_data['error_status']) && $stops_data['error_status'] == 0) {
                    if ($stops_data['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'data' => $stops_data['data']));
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
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    public function get_stops()
    {
        if ($this->input->is_ajax_request() == 1) {
            //$route_id = filter_input(INPUT_POST, 'routeid', FILTER_SANITIZE_NUMBER_INT);
            $trip_id = filter_input(INPUT_POST, 'tripid', FILTER_SANITIZE_NUMBER_INT);
            if (isset($trip_id) && !empty($trip_id)) {
                $inst_id = $this->session->userdata('inst_id');
                $stops_data = $this->MTReport->get_stopsdetails($trip_id, $inst_id);
                if (isset($stops_data['error_status']) && $stops_data['error_status'] == 0) {
                    if ($stops_data['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'data' => $stops_data['data']));
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
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    //////Pre Loaders End
    //Data loaders
    public function report_gen_fuel_log()
    {

        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($startdate) && !empty($startdate) && isset($enddate) && !empty($enddate)) {
                $inst_id = $this->session->userdata('inst_id');
                $report_data = $this->MTReport->get_fuel_log_report($startdate, $enddate, $vehicle_id, $inst_id);

                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) {
                    $data['startdate'] = $startdate;
                    $data['enddate'] = $enddate;
                    date_default_timezone_set('Asia/Kolkata');
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['report_data'] = $report_data['data'];
                    $data['title'] = 'FUEL LOG REPORT';
                    $data['bread_crumps'] = 'Docme Transport >> Transport Reports >> Fuel Log Report';
                    $filename_report = "reports/fuel-log-report_" . time() . ".pdf";
                    $pdfFilePath = FCPATH . $filename_report;
                    if (file_exists($pdfFilePath) == FALSE) {
                        //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                        $html = $this->load->view('reports/report_view/vehiclefuellog_report', $data, true); // render the view into HTML                        
                        $this->load->library('pdf');
                        $pdf = $this->pdf->load();
                        $pdf->WriteHTML($html); // write the HTML into the PDF
                        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                        if ($html) {
                            echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                            // echo base_url($filename_report);
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                            true;
                        }
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                    }
                } else {
                    echo json_encode(array('status' => 4, 'message' => 'There is no data found between these dates'));
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'All mandatory fields are required'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }


    public function get_maintancelist()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            $inst_id = $this->session->userdata('inst_id');
            $report_data = $this->MTReport->get_maintancelist($vehicle_id, $inst_id);
            if (isset($report_data['data']) && !empty($report_data['data'])) {
                $data['maintain_list'] = $report_data['data'];
            } else {
                $data['maintain_list'] = NULL;
            }
            echo json_encode($data);
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function maintains_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            $maintain_date = filter_input(INPUT_POST, 'maintain_date');
            $serviceType = filter_input(INPUT_POST, 'serviceType', FILTER_SANITIZE_NUMBER_INT);
            if (isset($vehicle_id) && !empty($vehicle_id) && isset($maintain_date) && !empty($maintain_date)) {
                $inst_id = $this->session->userdata('inst_id');
                $report_data = $this->MTReport->get_maintain_report($inst_id, $vehicle_id, $maintain_date, $serviceType); //$vehicle_id,
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) {


                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['report_data'] = $report_data['data'];
                    // dev_export($data['report_data']);
                    // die;
                    $data['title'] = 'Vehicle Maintenance Report';
                    $data['bread_crumps'] = 'Docme Transport >> Transport Reports >> Vehicle Maintenance Report';
                    $filename_report = "reports/maintenance_report/vehicle-maintenance-report_" . time() . ".pdf";
                    $pdfFilePath = FCPATH . $filename_report;

                    if (!is_dir(FCPATH . 'reports/maintenance_report')) {
                        mkdir(FCPATH . 'reports/maintenance_report');
                    }

                    if (file_exists($pdfFilePath) == FALSE) {
                        //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                        $html = $this->load->view('reports/report_view/vehiclemaintain_report', $data, true); // render the view into HTML                        
                        $this->load->library('pdf');
                        $pdf = $this->pdf->load();
                        $pdf->WriteHTML($html); // write the HTML into the PDF
                        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                        if ($html) {
                            echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                            // echo base_url($filename_report);
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                            true;
                        }
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'No data found.'));
                    return true;
                }
            } else {
                $this->load->view('template/error-500');
            }
        }
    }
    public function uplode_invoice_file()
    {
        if ($this->input->is_ajax_request() == 1) {
            //upload file
            $config['upload_path'] = 'uploads/invoice_doc_files/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = false;
            $config['max_size'] = '2048'; //2 MB
            $config['file_name'] = time() . '_' . $_FILES['file']['name'];
            if (isset($_FILES['file']['name'])) {
                if ($_FILES['file']['size'] == 0) {
                    echo $_FILES['file']['error'];
                } else if (0 < $_FILES['file']['error']) {
                    echo 'Error during file upload' . $_FILES['file']['error'];
                } else {
                    if (file_exists('uploads/invoice_doc_files/' . $_FILES['file']['name'])) {
                        echo 'File already exists : uploads/invoice_doc_files/' . $_FILES['file']['name'];
                    } else {
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('file')) {
                            echo $this->upload->display_errors();
                        } else {
                            // echo 'File successfully uploaded : uploads/invoice_doc_files/' . $config['file_name'];
                            echo $config['file_name'];
                        }
                    }
                }
            }
        }
    }

    public function vehicle_incidents_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            // dev_export($vehicle_id);
            // return;
            if (isset($startdate) && !empty($startdate) && isset($enddate) && !empty($enddate)) {
                $inst_id = $this->session->userdata('inst_id');
                $report_data = $this->MTReport->get_incidents_report($startdate, $enddate, $inst_id, $vehicle_id); //$vehicle_id,
                // dev_export($report_data);
                // return;
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) {
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['report_data'] = $report_data['data'];
                    $data['startdate'] = $startdate;
                    $data['enddate'] = $enddate;
                    // dev_export($data['report_data']);
                    // die;
                    $data['title'] = 'Vehicle Incident Report';
                    $data['bread_crumps'] = 'Docme Transport >> Transport Reports >> Vehicle Incident Report';
                    $filename_report = "reports/maintenance_report/vehicle-incident-report_" . time() . ".pdf";
                    $pdfFilePath = FCPATH . $filename_report;

                    if (!is_dir(FCPATH . 'reports/maintenance_report')) {
                        mkdir(FCPATH . 'reports/maintenance_report');
                    }
                    if (file_exists($pdfFilePath) == FALSE) {
                        //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                        $html = $this->load->view('reports/report_view/vehicleincidents_report', $data, true); // render the view into HTML                        
                        $this->load->library('pdf');
                        $pdf = $this->pdf->load();
                        $pdf->WriteHTML($html); // write the HTML into the PDF
                        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                        if ($html) {
                            echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                            // echo base_url($filename_report);
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                            true;
                        }
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'No data found'));
                    return true;
                }
            } else {
                $this->load->view('template/error-500');
            }
        }
    }

    public function vehicle_cost_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $first_vehicle_id = filter_input(INPUT_POST, 'first_vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            $second_vehicle_id = filter_input(INPUT_POST, 'seconde_vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($startdate) && !empty($startdate) && isset($enddate) && !empty($enddate)) {
                $inst_id = $this->session->userdata('inst_id');
                $report_data = $this->MTReport->get_cost_report($startdate, $enddate, $inst_id, $first_vehicle_id, $second_vehicle_id); //$vehicle_id,
                // return;
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) {
                    $vehicle_data = $report_data['data'];
                    $vehicl_array_data = [];
                    $veh_id = '';
                    $i = 0;
                    foreach ($vehicle_data as $veh_data) {
                        if ($veh_data['vehicleId']) {
                            $vehicl_array_data[$veh_data['vehicleId']]['veh_id'] = $veh_data['vehicleId'];
                            $vehicl_array_data[$veh_data['vehicleId']]['vehicleNum'] = $veh_data['vehicleNum'];
                            $vehicl_array_data[$veh_data['vehicleId']]['ServiceCenter'] = $veh_data['ServiceCenter'];
                            $vehicl_array_data[$veh_data['vehicleId']]['invoiceNum'] = $veh_data['invoiceNum'];
                            $vehicl_array_data[$veh_data['vehicleId']]['INVOICE_DATE'] = $veh_data['INVOICE_DATE'];
                            $vehicl_array_data[$veh_data['vehicleId']]['DELIVERY_DATE'] = $veh_data['DELIVERY_DATE'];
                            $vehicl_array_data[$veh_data['vehicleId']]['fuelTypeName'] = $veh_data['fuelTypeName'];
                            $vehicl_array_data[$veh_data['vehicleId']]['kmreading'] = $veh_data['kmreading'];
                            $vehicl_array_data[$veh_data['vehicleId']]['labourCharge'][$i] = $veh_data['labourCharge'];
                            $vehicl_array_data[$veh_data['vehicleId']]['otherDetails'][$i] = $veh_data['otherDetails'];
                            $vehicl_array_data[$veh_data['vehicleId']]['amountTotal'][$i] = $veh_data['amountTotal'];
                            if ($veh_data['sparparts_details'] != '' && sizeof(json_decode($veh_data['sparparts_details'])) != 0)
                                $vehicl_array_data[$veh_data['vehicleId']]['sparparts_details'][$i] = $veh_data['sparparts_details'];
                            if ($veh_data['acesories_details'] != '' && sizeof(json_decode($veh_data['acesories_details'])) != 0)
                                $vehicl_array_data[$veh_data['vehicleId']]['acesories_details'][$i] = $veh_data['acesories_details'];
                            if ($veh_data['miscellaneous_details'] != '' && sizeof(json_decode($veh_data['miscellaneous_details'])) != 0)
                                $vehicl_array_data[$veh_data['vehicleId']]['miscellaneous_details'][$i] = $veh_data['miscellaneous_details'];
                            // $vehicl_array_data[$veh_data['vehicleId']]['labourCharge'] = $veh_data['labourCharge'];
                            // $vehicl_array_data[$veh_data['vehicleId']]['otherDetails'] = $veh_data['otherDetails'];
                            // $vehicl_array_data[$veh_data['vehicleId']]['amountTotal'] = $veh_data['amountTotal'];
                            // $vehicl_array_data[$veh_data['vehicleId']]['sparparts_details'] = $veh_data['sparparts_details'];
                            // $vehicl_array_data[$veh_data['vehicleId']]['acesories_details'] = $veh_data['acesories_details'];
                            // $vehicl_array_data[$veh_data['vehicleId']]['miscellaneous_details'] = $veh_data['miscellaneous_details'];
                        }
                        $i++;
                    }


                    // dev_export($vehicl_array_data);
                    // return;

                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['first_veh'] = $first_vehicle_id;
                    $data['second_veh'] = $second_vehicle_id;
                    $data['report_data'] = $vehicl_array_data;
                    $data['startdate'] = $startdate;
                    $data['enddate'] = $enddate;
                    // dev_export($data['report_data']);
                    // die;
                    $data['title'] = 'Vehicle Costwise Report';
                    $data['bread_crumps'] = 'Docme Transport >> Transport Reports >> Vehicle Costwise Report';
                    $filename_report = "reports/maintenance_report/vehicle-costwise-report_" . time() . ".pdf";
                    $pdfFilePath = FCPATH . $filename_report;
                    if (!is_dir(FCPATH . 'reports/maintenance_report')) {
                        mkdir(FCPATH . 'reports/maintenance_report');
                    }
                    if (file_exists($pdfFilePath) == FALSE) {
                        //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                        $html = $this->load->view('reports/report_view/vehiclecostwise_report', $data, true); // render the view into HTML                        
                        // echo $html;
                        // exit;
                        $this->load->library('pdf');
                        $pdf = $this->pdf->load();
                        $pdf->WriteHTML($html); // write the HTML into the PDF
                        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                        if ($html) {
                            echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                            // echo base_url($filename_report);
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                            true;
                        }
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'No data found between these dates'));
                    return true;
                }
            } else {
                $this->load->view('template/error-500');
            }
        }
    }
    public function vehicle_expenditure_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($vehicle_id) && !empty($vehicle_id)) {
                $inst_id = $this->session->userdata('inst_id');
                $report_data = $this->MTReport->get_vehicle_expenditure_report($inst_id, $vehicle_id); //$vehicle_id,
                // dev_export($report_data);
                // die;
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) {


                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['report_data'] = $report_data['data'];
                    // dev_export($data['report_data']);
                    // die;
                    $data['title'] = 'Vehicle Expenditure Report';
                    $data['bread_crumps'] = 'Docme Transport >> Transport Reports >> Vehicle Expenditure Report';
                    $filename_report = "reports/maintenance_report/vehicle-expenditure-report_" . time() . ".pdf";
                    $pdfFilePath = FCPATH . $filename_report;
                    if (!is_dir(FCPATH . 'reports/maintenance_report')) {
                        mkdir(FCPATH . 'reports/maintenance_report');
                    }
                    if (file_exists($pdfFilePath) == FALSE) {
                        //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                        $html = $this->load->view('reports/report_view/vehicleexpenditure_report', $data, true); // render the view into HTML                        
                        $this->load->library('pdf');
                        $pdf = $this->pdf->load();
                        $pdf->WriteHTML($html); // write the HTML into the PDF
                        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                        if ($html) {
                            echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                            // echo base_url($filename_report);
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                            true;
                        }
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'No data found.'));
                    return true;
                }
            } else {
                $this->load->view('template/error-500');
            }
        }
    }

    public function expendituresummary_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($vehicle_id) && !empty($vehicle_id)) {
                $inst_id = $this->session->userdata('inst_id');
                $report_data = $this->MTReport->get_vehicle_expendituresummary_report($inst_id, $vehicle_id); //$vehicle_id,
                // dev_export($report_data);
                // die;
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) {


                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['report_data'] = $report_data['data'];
                    // dev_export($data['report_data']);
                    // die;
                    $data['title'] = 'Vehicle Expenditure Summary Report';
                    $data['bread_crumps'] = 'Docme Transport >> Transport Reports >> Vehicle Expenditure Summary Repor';
                    $filename_report = "reports/maintenance_report/vehicle-expenditure-report_" . time() . ".pdf";
                    $pdfFilePath = FCPATH . $filename_report;
                    if (!is_dir(FCPATH . 'reports/maintenance_report')) {
                        mkdir(FCPATH . 'reports/maintenance_report');
                    }
                    if (file_exists($pdfFilePath) == FALSE) {
                        //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                        $html = $this->load->view('reports/report_view/vehicleexpenditure_summary_report', $data, true); // render the view into HTML                        
                        $this->load->library('pdf');
                        $pdf = $this->pdf->load();
                        $pdf->WriteHTML($html); // write the HTML into the PDF
                        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                        if ($html) {
                            echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                            // echo base_url($filename_report);
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                            true;
                        }
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'No data found.'));
                    return true;
                }
            } else {
                $this->load->view('template/error-500');
            }
        }
    }
    //Data loaders
    public function report_gen_fuel_consumption()
    {

        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            //$vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($vehicle_id);die;
            if (isset($startdate) && !empty($startdate) && isset($enddate) && !empty($enddate)) {
                $inst_id = $this->session->userdata('inst_id');
                $report_data = $this->MTReport->get_fuel_consumption_report($startdate, $enddate, $inst_id); //$vehicle_id,

                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) {

                    $data['startdate'] = $startdate;
                    $data['enddate'] = $enddate;
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['report_data'] = $report_data['data'];
                    // dev_export($data['report_data']);die;
                    $data['title'] = 'FUEL CONSUMPTION REPORT';
                    $data['bread_crumps'] = 'Docme Transport >> Transport Reports >> Fuel Consumption Report';
                    $filename_report = "reports/fuel-consumption-report_" . time() . ".pdf";
                    $pdfFilePath = FCPATH . $filename_report;
                    if (file_exists($pdfFilePath) == FALSE) {
                        //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                        $html = $this->load->view('reports/report_view/vehiclefuelconsumption_report', $data, true); // render the view into HTML                        
                        $this->load->library('pdf');
                        $pdf = $this->pdf->load();
                        $pdf->WriteHTML($html); // write the HTML into the PDF
                        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                        if ($html) {
                            echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                            // echo base_url($filename_report);
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                            true;
                        }
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'No data found between these dates'));
                    return true;
                }
            } else {
                $this->load->view('template/error-500');
            }
        }
    }

    public function gen_routestripwise_studrpt()
    {

        if ($this->input->is_ajax_request() == 1) {

            $data['sub_title'] = 'ROUTE-TRIPWISE STUDENTS REPORT';
            //$route_id = filter_input(INPUT_POST, 'route_id', FILTER_SANITIZE_NUMBER_INT);
            //$routedata = filter_input(INPUT_POST, 'routedata', FILTER_SANITIZE_STRING);
            $tripid = filter_input(INPUT_POST, 'tripid', FILTER_SANITIZE_STRING);
            $tripdata = filter_input(INPUT_POST, 'tripdata', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $report_data = $this->MTReport->get_rte_trip_wise_data($tripid, $inst_id);
            //dev_export($report_data);die;
            if (!empty($report_data['data']) && $report_data['data_status'] == 1) {
                $data['report_data'] = $report_data['data'];
            } else {
                $data['report_data'] = FALSE;
            }
            if ($data['report_data']) {
                $filename_report = "reports/trip-report_" . time() . ".pdf";
                $data['title'] = 'TRIP REPORT';
                $data['bread_crumps'] = 'Docme Transport >> Transport Reports >> Trip Report';
                $data['user_name'] = $this->session->userdata('user_name');
                $pdfFilePath = FCPATH . $filename_report;
                if (file_exists($pdfFilePath) == FALSE) {
                    //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)

                    $html = $this->load->view('reports/report_view/vehicletripwise_report', $data, true); // render the view into HTML
                    $this->load->library('pdf');

                    $pdf = $this->pdf->load();
                    date_default_timezone_set('Asia/Kolkata');
                    //$pdf->autoPageBreak = false;
                    $pdf->WriteHTML($html); // write the HTML into the PDF
                    $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                    // echo base_url($filename_report);
                    // return true;
                    if ($html) {
                        echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                        return true;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                        true;
                    }
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data found'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }




    public function gen_trip_pickstops_rpt()
    {

        if ($this->input->is_ajax_request() == 1) {

            //$route_id = filter_input(INPUT_POST, 'route_id', FILTER_SANITIZE_NUMBER_INT);
            //$routedata = filter_input(INPUT_POST, 'routedata', FILTER_SANITIZE_STRING);
            $tripid = filter_input(INPUT_POST, 'tripid', FILTER_SANITIZE_STRING);
            $tripdata = filter_input(INPUT_POST, 'tripdata', FILTER_SANITIZE_STRING);
            $pickstopid = filter_input(INPUT_POST, 'pickstopid', FILTER_SANITIZE_STRING);
            $pickstopdata = filter_input(INPUT_POST, 'pickstopdata', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $report_data = $this->MTReport->get_rte_trip_pickstop_data($tripid, $pickstopid, $inst_id);
            if (!empty($report_data['data']) && $report_data['data_status'] == 1) {
                $pickuppoint_data = $report_data['data'];
                $pickupdata = [];
                $i = 0;
                foreach ($pickuppoint_data as $pickup) {
                    $pickupdata[$pickup['id']]['tripName'] = $pickup['tripName'];
                    $pickupdata[$pickup['id']]['tripStart'] = $pickup['pickStartTime'];
                    $pickupdata[$pickup['id']]['tripEnd'] = $pickup['pickEndTime'];
                    $pickupdata[$pickup['id']]['pickpointName'][$i]['pickpointName'] = $pickup['pickpointName'];
                    //$pickupdata[$pickup['id']]['pickpointName'][$i]['pickStartTime']=$pickup['pickStartTime'];
                    $pickupdata[$pickup['id']]['pickpointName'][$i]['droptime'] = $pickup['droptime'];
                    $pickupdata[$pickup['id']]['pickpointName'][$i]['pickuptime'] = $pickup['pickuptime'];
                    $i++;
                }
                $data['pickuppoint_data'] = $pickupdata;
                //dev_export($pickupdata);die;
            } else {
                $data['pickuppoint_data'] = FALSE;
            }
            if ($data['pickuppoint_data']) {
                $filename_report = "reports/trip-pickup-point-report_" . time() . ".pdf";
                $data['title'] = 'TRIP-PICKUP POINT REPORT';
                $data['bread_crumps'] = 'Docme Transport >> Transport Reports >> Trip-Pickup Point Report';
                $data['user_name'] = $this->session->userdata('user_name');
                $pdfFilePath = FCPATH . $filename_report;
                if (file_exists($pdfFilePath) == FALSE) {
                    //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)

                    $html = $this->load->view('reports/report_view/vehiclepickuppointwise_report', $data, true); // render the view into HTML
                    //echo $html;
                    $this->load->library('pdf');

                    $pdf = $this->pdf->load();
                    date_default_timezone_set('Asia/Kolkata');
                    $pdf->WriteHTML($html); // write the HTML into the PDF
                    $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                    // echo base_url($filename_report);
                    // return true;
                    if ($html) {
                        echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                        return true;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                        true;
                    }
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data found'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }



    public function gen_pickpoint_fees_rpt()
    {

        if ($this->input->is_ajax_request() == 1) {
            //$route_id = filter_input(INPUT_POST, 'route_id', FILTER_SANITIZE_NUMBER_INT);
            //$routedata = filter_input(INPUT_POST, 'routedata', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year = $this->session->userdata('acd_year');
            $this->load->model('transport/Pickuppoint_fees_model', 'MPFees');
            $report_data = $this->MPFees->get_all_pickuppoint_fees($inst_id, $acd_year);
            // dev_export($report_data);
            // return;
            if (!empty($report_data['data']) && $report_data['data_status'] == 1) {
                $data['report_data'] = $report_data['data'];
            } else {
                $data['report_data'] = FALSE;
            }
            if ($data['report_data']) {
                $filename_report = "reports/pickup-point-fees-report_" . time() . ".pdf";
                $data['title'] = 'PICKUP POINT-FEES REPORT';
                $data['bread_crumps'] = 'Docme Transport >> Transport Reports >> Pickup Point-Fees Report';
                $data['user_name'] = $this->session->userdata('user_name');
                $pdfFilePath = FCPATH . $filename_report;
                if (file_exists($pdfFilePath) == FALSE) {
                    //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)

                    $html = $this->load->view('reports/report_view/pickpoint_fees_report', $data, true); // render the view into HTML
                    $this->load->library('pdf');

                    $pdf = $this->pdf->load();
                    date_default_timezone_set('Asia/Kolkata');
                    $pdf->WriteHTML($html); // write the HTML into the PDF
                    $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                    // echo base_url($filename_report);
                    // return true;
                    if ($html) {
                        echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                        return true;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                        true;
                    }
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data found'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function stud_classwise_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_STRING);
            $stream_id = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_STRING);
            if ($stream_id == "ALL") {
                $query = " ";
            } else {
                $query = " and b.Stream_ID=$stream_id";
            }
            if ($class_id == "ALL") {
                $query .= " ";
            } else {
                $query .= " and c.Course_Det_ID=$class_id";
            }
            $data_prep = array(
                'action' => 'get-all-student-transport-data',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'query' => $query,
            );
            $report_data = $this->MTReport->get_all_student_transport_data($data_prep);
            // dev_export($report_data);
            // die;
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                $data['user_name'] = $this->session->userdata('user_name');
                $class_stud_data = $report_data['data'];
                foreach ($class_stud_data as $rpt_data) {
                    $end_date_value = $rpt_data['transportEndDate'] == '' ? date('d/m/Y', strtotime($this->session->userdata('lock_end_date'))) : date('d/m/Y', strtotime($rpt_data['transportEndDate']));
                    $formatted_report_data[$rpt_data['Course_Det_ID']]['class_name'] = $rpt_data['class_name'];
                    $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['Batch_Name'] = $rpt_data['Batch_Name'];
                    $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_alloc_id']]['Admn_No'] = $rpt_data['Admn_No'];
                    $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_alloc_id']]['student_name'] = $rpt_data['student_name'];
                    //$rpt_data['pickStopId']
                    //$rpt_data['dropTripId']
                    $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_alloc_id']]['pickup_tripName'] = $rpt_data['pickup_tripName'];
                    $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_alloc_id']]['drop_tripName'] = $rpt_data['drop_tripName'];
                    $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_alloc_id']]['pickup_pickpointName'] = $rpt_data['pickup_pickpointName'];
                    $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_alloc_id']]['drop_pickupName'] = $rpt_data['drop_pickupName'];
                    $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_alloc_id']]['transport_dates'] = date('d/m/Y', strtotime($rpt_data['transportStartDate'])) . ' to ' . $end_date_value;
                    $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_alloc_id']]['phone'] = $rpt_data['Phone1'];


                    // $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_id']]['allocs'][$rpt_data['student_alloc_id']]['pickup_tripName'] = $rpt_data['pickup_tripName'];
                    // $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_id']]['allocs'][$rpt_data['student_alloc_id']]['drop_tripName'] = $rpt_data['drop_tripName'];
                    // $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_id']]['allocs'][$rpt_data['student_alloc_id']]['pickup_pickpointName'] = $rpt_data['pickup_pickpointName'];
                    // $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_id']]['allocs'][$rpt_data['student_alloc_id']]['drop_pickupName'] = $rpt_data['drop_pickupName'];
                    // $formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_id']]['allocs'][$rpt_data['student_alloc_id']]['phone'] = $rpt_data['Phone1'];
                    $size_batch_students = sizeof($formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data']);
                    //$size_students_allocs = sizeof($formatted_report_data[$rpt_data['Course_Det_ID']]['batch_details'][$rpt_data['BatchID']]['student_data'][$rpt_data['student_id']]['allocs']);
                    $size['batch_span'][$rpt_data['Course_Det_ID']]['batch_span'][$rpt_data['BatchID']] = $size_batch_students;
                    //$size['student_span'][$rpt_data['student_id']] = $size_students_allocs;
                }
                foreach ($size['batch_span'] as $key => $value) {
                    $size['total_span'][$key] = (isset($value['batch_span']) ? array_sum($value['batch_span']) : 0);
                }
                // foreach ($size['student_span'] as $key => $value) {
                //     $size['total_alloc_span'][$key] = $value;
                // }

                if (!empty($formatted_report_data)) {
                    $data['report_data'] = $formatted_report_data;
                    $data['span_size'] = $size;
                    $data['title'] = 'CLASS-TRANSPORT REPORT';
                    $data['bread_crumps'] = 'Docme Transport >> Transport Reports >>  Class-Transport Report';
                    $filename_report = "reports/class-transport-report_" . time() . ".pdf";
                    $pdfFilePath = FCPATH . $filename_report;
                    if (file_exists($pdfFilePath) == FALSE) {
                        //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                        $html = $this->load->view('reports/report_view/student_classwise_transport_report', $data, true); // render the view into HTML                        
                        // echo $html;
                        // exit;

                        $this->load->library('pdf');
                        $pdf = $this->pdf->load();
                        // $pdf->autoPageBreak = false;
                        // $pdf->AddPage();
                        $pdf->WriteHTML($html); // write the HTML into the PDF
                        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                        if ($html) {
                            echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                            true;
                        }
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'No data found'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data found'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function stud_pickupwise_report()
    {
        if ($this->input->is_ajax_request() == 1) {

            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $trip_id = filter_input(INPUT_POST, 'trip_id', FILTER_SANITIZE_STRING);
            $pickstopid = filter_input(INPUT_POST, 'pickstopid', FILTER_SANITIZE_STRING);
            if ($pickstopid == "ALL") {
                $query = " ";
            } else {
                $query = " and (pp.id=$pickstopid OR dp.id=$pickstopid)";
            }
            $data_prep = array(
                'action' => 'get-all-student-transport-data',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'query' => $query
            );
            $report_data = $this->MTReport->get_all_student_transport_data($data_prep);
            // $this->load->model('Transport/Passenger_student_model', 'MSP');
            // $report_data = $this->MSP->get_all_student_allocation_details();
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                $data['user_name'] = $this->session->userdata('user_name');
                $class_stud_data = $report_data['data'];
                foreach ($class_stud_data as $rpt_data) {
                    $end_date_value = $rpt_data['transportEndDate'] == '' ? date('d/m/Y', strtotime($this->session->userdata('lock_end_date'))) : date('d/m/Y', strtotime($rpt_data['transportEndDate']));
                    //if ($pickstopid == "ALL" || ($rpt_data['pickStopId'] == $pickstopid || $rpt_data['dropStopId'] == $pickstopid)) {
                    if ($rpt_data['pickStopId'] != 0 && ($rpt_data['pickStopId'] == $pickstopid || $pickstopid == "ALL")) {
                        $formatted_allocation_data[$rpt_data['pickStopId']]['stop_name'] = $rpt_data['pickup_pickpointName'];
                        if ($rpt_data['pickTripId'] != 0) {
                            $formatted_allocation_data[$rpt_data['pickStopId']]['travel_type']['Pickup'][$rpt_data['pickTripId']]['pick_trip_name'] = $rpt_data['pickup_tripName'];
                            $formatted_allocation_data[$rpt_data['pickStopId']]['travel_type']['Pickup'][$rpt_data['pickTripId']]['student_data'][$rpt_data['student_id']]['student_name'] = $rpt_data['student_name'];
                            $formatted_allocation_data[$rpt_data['pickStopId']]['travel_type']['Pickup'][$rpt_data['pickTripId']]['student_data'][$rpt_data['student_id']]['Admn_No'] = $rpt_data['Admn_No'];
                            $formatted_allocation_data[$rpt_data['pickStopId']]['travel_type']['Pickup'][$rpt_data['pickTripId']]['student_data'][$rpt_data['student_id']]['class_name'] = $rpt_data['class_name'];
                            $formatted_allocation_data[$rpt_data['pickStopId']]['travel_type']['Pickup'][$rpt_data['pickTripId']]['student_data'][$rpt_data['student_id']]['student_id'] = $rpt_data['student_id'];
                            $formatted_allocation_data[$rpt_data['pickStopId']]['travel_type']['Pickup'][$rpt_data['pickTripId']]['student_data'][$rpt_data['student_id']]['transport_dates'] = date('d/m/Y', strtotime($rpt_data['transportStartDate'])) . ' to ' . $end_date_value;
                            $size_pick = sizeof($formatted_allocation_data[$rpt_data['pickStopId']]['travel_type']['Pickup'][$rpt_data['pickTripId']]['student_data']);
                            $size['trip_span'][$rpt_data['pickStopId']]['Pickup'][$rpt_data['pickTripId']] = $size_pick;
                        }
                    }
                    if ($rpt_data['dropStopId'] != 0 && ($rpt_data['dropStopId'] == $pickstopid || $pickstopid == "ALL")) {
                        $formatted_allocation_data[$rpt_data['dropStopId']]['stop_name'] = $rpt_data['drop_pickupName'];
                        if ($rpt_data['dropTripId'] != 0) {
                            $formatted_allocation_data[$rpt_data['dropStopId']]['travel_type']['Drop'][$rpt_data['dropTripId']]['drop_trip_name'] = $rpt_data['drop_tripName'];
                            $formatted_allocation_data[$rpt_data['dropStopId']]['travel_type']['Drop'][$rpt_data['dropTripId']]['student_data'][$rpt_data['student_id']]['student_name'] = $rpt_data['student_name'];
                            $formatted_allocation_data[$rpt_data['dropStopId']]['travel_type']['Drop'][$rpt_data['dropTripId']]['student_data'][$rpt_data['student_id']]['Admn_No'] = $rpt_data['Admn_No'];
                            $formatted_allocation_data[$rpt_data['dropStopId']]['travel_type']['Drop'][$rpt_data['dropTripId']]['student_data'][$rpt_data['student_id']]['class_name'] = $rpt_data['class_name'];
                            $formatted_allocation_data[$rpt_data['dropStopId']]['travel_type']['Drop'][$rpt_data['dropTripId']]['student_data'][$rpt_data['student_id']]['student_id'] = $rpt_data['student_id'];
                            $formatted_allocation_data[$rpt_data['dropStopId']]['travel_type']['Drop'][$rpt_data['dropTripId']]['student_data'][$rpt_data['student_id']]['transport_dates'] = date('d/m/Y', strtotime($rpt_data['transportStartDate'])) . ' to ' . $end_date_value;
                            $size_drop = sizeof($formatted_allocation_data[$rpt_data['dropStopId']]['travel_type']['Drop'][$rpt_data['dropTripId']]['student_data']);
                            $size['trip_span'][$rpt_data['dropStopId']]['Drop'][$rpt_data['dropTripId']] = $size_drop;
                        }
                    }
                    //}
                    //$total_row_count++;
                }

                foreach ($size['trip_span'] as $key => $value) {
                    // $size['total_span'][$key] = array_sum($value['Pickup']) + array_sum($value['Drop']);
                    // $size['travel_type_span']['Pickup'][$key] = array_sum($value['Pickup']);
                    // $size['travel_type_span']['Drop'][$key] = array_sum($value['Drop']);
                    $size['total_span'][$key] = (isset($value['Pickup']) ? array_sum($value['Pickup']) : 0) + (isset($value['Drop']) ? array_sum($value['Drop']) : 0);
                    $size['travel_type_span']['Pickup'][$key] = isset($value['Pickup']) ? array_sum($value['Pickup']) : 0;
                    $size['travel_type_span']['Drop'][$key] = isset($value['Drop']) ? array_sum($value['Drop']) : 0;
                }
                if (!empty($formatted_allocation_data)) {
                    $data['report_data'] = $formatted_allocation_data;
                    $data['span_size'] = $size;
                    $data['title'] = 'PICKUP/DROP POINT-STUDENT REPORT';
                    $data['bread_crumps'] = 'Docme Transport >> Transport Reports >>  Pickup/Drop Point-Student Report';
                    $filename_report = "reports/pickup-drop-point-student-report_" . time() . ".pdf";
                    $pdfFilePath = FCPATH . $filename_report;
                    if (file_exists($pdfFilePath) == FALSE) {
                        //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                        $html = $this->load->view('reports/report_view/student_pickupwise_transport_report', $data, true); // render the view into HTML                        

                        $this->load->library('pdf');
                        $pdf = $this->pdf->load();
                        $pdf->WriteHTML($html); // write the HTML into the PDF
                        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                        if ($html) {
                            echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                            true;
                        }
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'No data found'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data found'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function stud_tripwise_report()
    {
        if ($this->input->is_ajax_request() == 1) {

            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $trip_id = filter_input(INPUT_POST, 'trip_id', FILTER_SANITIZE_STRING);
            $pickstopid = filter_input(INPUT_POST, 'pickstopid', FILTER_SANITIZE_STRING);
            if ($trip_id == "ALL") {
                $query = " ";
            } else {
                $query = " and (pt.id=$trip_id OR dt.id=$trip_id)";
            }
            $data_prep = array(
                'action' => 'get-all-student-transport-data',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'query' => $query
            );

            $report_data = $this->MTReport->get_all_student_transport_data($data_prep);
            // $this->load->model('Transport/Passenger_student_model', 'MSP');
            // $report_data = $this->MSP->get_all_student_allocation_details();
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                $data['user_name'] = $this->session->userdata('user_name');
                $class_stud_data = $report_data['data'];
                foreach ($class_stud_data as $rpt_data) {
                    $end_date_value = $rpt_data['transportEndDate'] == '' ? date('d/m/Y', strtotime($this->session->userdata('lock_end_date'))) : date('d/m/Y', strtotime($rpt_data['transportEndDate']));
                    if ($rpt_data['pickTripId'] != 0 && ($rpt_data['pickTripId'] == $trip_id || $trip_id == "ALL")) {
                        $formatted_allocation_data[$rpt_data['pickTripId']]['trip_name'] = $rpt_data['pickup_tripName'];

                        if ($rpt_data['pickStopId'] != 0) {
                            $formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['pickup_name'] = $rpt_data['pickup_pickpointName'];
                            $formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data'][$rpt_data['student_id']]['student_name'] = $rpt_data['student_name'];
                            $formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data'][$rpt_data['student_id']]['Admn_No'] = $rpt_data['Admn_No'];
                            $formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data'][$rpt_data['student_id']]['class_name'] = $rpt_data['class_name'];
                            $formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data'][$rpt_data['student_id']]['student_id'] = $rpt_data['student_id'];
                            $formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data'][$rpt_data['student_id']]['transport_dates'] = date('d/m/Y', strtotime($rpt_data['transportStartDate'])) . ' to ' . $end_date_value;
                            $size_pick = sizeof($formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data']);
                            $size['stop_span'][$rpt_data['pickTripId']]['Pickup'][$rpt_data['pickStopId']] = $size_pick;
                            //$formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['travel_type_span'] = $size_pick;
                        }
                    }
                    if ($rpt_data['dropTripId'] != 0 && ($rpt_data['dropTripId'] == $trip_id || $trip_id == "ALL")) {
                        $formatted_allocation_data[$rpt_data['dropTripId']]['trip_name'] = $rpt_data['drop_tripName'];
                        if ($rpt_data['dropStopId'] != 0) {
                            $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['drop_pickupName'] = $rpt_data['drop_pickupName'];
                            $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data'][$rpt_data['student_id']]['student_name'] = $rpt_data['student_name'];
                            $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data'][$rpt_data['student_id']]['Admn_No'] = $rpt_data['Admn_No'];
                            $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data'][$rpt_data['student_id']]['class_name'] = $rpt_data['class_name'];
                            $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data'][$rpt_data['student_id']]['student_id'] = $rpt_data['student_id'];
                            $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data'][$rpt_data['student_id']]['transport_dates'] = date('d/m/Y', strtotime($rpt_data['transportStartDate'])) . ' to ' . $end_date_value;
                            $size_drop = sizeof($formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data']);
                            $size['stop_span'][$rpt_data['dropTripId']]['Drop'][$rpt_data['dropStopId']] = $size_drop;
                            //$formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['travel_type_span'] = $size_drop;
                        }
                    }
                    //$total_row_count++;
                }
                foreach ($size['stop_span'] as $key => $value) {
                    $size['total_span'][$key] = (isset($value['Pickup']) ? array_sum($value['Pickup']) : 0) + (isset($value['Drop']) ? array_sum($value['Drop']) : 0);
                    $size['travel_type_span']['Pickup'][$key] = isset($value['Pickup']) ? array_sum($value['Pickup']) : 0;
                    $size['travel_type_span']['Drop'][$key] = isset($value['Drop']) ? array_sum($value['Drop']) : 0;
                }
                if (!empty($formatted_allocation_data)) {
                    $data['report_data'] = $formatted_allocation_data;
                    $data['span_size'] = $size;
                    $data['title'] = 'TRIP-STUDENT REPORT';
                    $data['bread_crumps'] = 'Docme Transport >> Transport Reports >>  Trip-Student Report';
                    $filename_report = "reports/trip-student-report_" . time() . ".pdf";
                    $pdfFilePath = FCPATH . $filename_report;
                    if (file_exists($pdfFilePath) == FALSE) {
                        //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                        $html = $this->load->view('reports/report_view/student_tripwise_transport_report', $data, true); // render the view into HTML                        

                        $this->load->library('pdf');
                        $pdf = $this->pdf->load();
                        $pdf->WriteHTML($html); // write the HTML into the PDF
                        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                        if ($html) {
                            echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                            true;
                        }
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'No data found'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data found'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function vehicle_trip_report()
    {
        if ($this->input->is_ajax_request() == 1) {

            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_STRING);

            if ($vehicle_id == "ALL") {
                $query = " ";
            } else {
                $query = " and (tvp.id=$vehicle_id OR tvd.id=$vehicle_id)";
            }
            $data_prep = array(
                'action' => 'get-all-student-transport-data',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'query' => $query
            );

            $report_data = $this->MTReport->get_all_student_transport_data($data_prep);
            // $this->load->model('Transport/Passenger_student_model', 'MSP');
            // $report_data = $this->MSP->get_all_student_allocation_details();
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                $data['user_name'] = $this->session->userdata('user_name');
                $class_stud_data = $report_data['data'];
                foreach ($class_stud_data as $rpt_data) {
                    $end_date_value = $rpt_data['transportEndDate'] == '' ? date('d/m/Y', strtotime($this->session->userdata('lock_end_date'))) : date('d/m/Y', strtotime($rpt_data['transportEndDate']));
                    if ($rpt_data['pickTripId'] != 0 && ($rpt_data['pickVehicleId'] == $vehicle_id || $vehicle_id == "ALL")) {
                        $formatted_allocation_data[$rpt_data['pickTripId']]['trip_name'] = $rpt_data['pickup_tripName'];
                        $formatted_allocation_data[$rpt_data['pickTripId']]['pick_vehicle_reg'] = $rpt_data['Pick_vehicle_reg'] == '' ? 'NOT MAPPED' : $rpt_data['Pick_vehicle_reg'];

                        if ($rpt_data['pickStopId'] != 0) {
                            $formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['pickup_name'] = $rpt_data['pickup_pickpointName'];
                            $formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data'][$rpt_data['student_id']]['student_name'] = $rpt_data['student_name'];
                            $formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data'][$rpt_data['student_id']]['Admn_No'] = $rpt_data['Admn_No'];
                            $formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data'][$rpt_data['student_id']]['class_name'] = $rpt_data['class_name'];
                            $formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data'][$rpt_data['student_id']]['student_id'] = $rpt_data['student_id'];
                            $formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data'][$rpt_data['student_id']]['transport_dates'] = date('d/m/Y', strtotime($rpt_data['transportStartDate'])) . ' to ' . $end_date_value;
                            $size_pick = sizeof($formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data']);
                            $size['stop_span'][$rpt_data['pickTripId']]['Pickup'][$rpt_data['pickStopId']] = $size_pick;
                            //$formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['travel_type_span'] = $size_pick;
                        }
                    }
                    if ($rpt_data['dropTripId'] != 0 && ($rpt_data['dropVehicleId'] == $vehicle_id || $vehicle_id == "ALL")) {
                        $formatted_allocation_data[$rpt_data['dropTripId']]['trip_name'] = $rpt_data['drop_tripName'];
                        $formatted_allocation_data[$rpt_data['dropTripId']]['drop_vehicle_reg'] = $rpt_data['Drop_vehicle_reg'] == '' ? 'NOT MAPPED' : $rpt_data['Drop_vehicle_reg'];
                        if ($rpt_data['dropStopId'] != 0) {
                            $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['drop_pickupName'] = $rpt_data['drop_pickupName'];
                            $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data'][$rpt_data['student_id']]['student_name'] = $rpt_data['student_name'];
                            $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data'][$rpt_data['student_id']]['Admn_No'] = $rpt_data['Admn_No'];
                            $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data'][$rpt_data['student_id']]['class_name'] = $rpt_data['class_name'];
                            $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data'][$rpt_data['student_id']]['student_id'] = $rpt_data['student_id'];
                            $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data'][$rpt_data['student_id']]['transport_dates'] = date('d/m/Y', strtotime($rpt_data['transportStartDate'])) . ' to ' . $end_date_value;
                            $size_drop = sizeof($formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data']);
                            $size['stop_span'][$rpt_data['dropTripId']]['Drop'][$rpt_data['dropStopId']] = $size_drop;
                            //$formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['travel_type_span'] = $size_drop;
                        }
                    }
                    //$total_row_count++;
                }
                foreach ($size['stop_span'] as $key => $value) {
                    $size['total_span'][$key] = (isset($value['Pickup']) ? array_sum($value['Pickup']) : 0) + (isset($value['Drop']) ? array_sum($value['Drop']) : 0);
                    $size['travel_type_span']['Pickup'][$key] = isset($value['Pickup']) ? array_sum($value['Pickup']) : 0;
                    $size['travel_type_span']['Drop'][$key] = isset($value['Drop']) ? array_sum($value['Drop']) : 0;
                }
                $data['report_data'] = $formatted_allocation_data;
                $data['span_size'] = $size;
                $data['title'] = 'VEHICLE-TRIP REPORT';
                $data['bread_crumps'] = 'Docme Transport >> Transport Reports >>  Vehicle-Trip Report';
                $filename_report = "reports/vehicle-trip-report_" . time() . ".pdf";
                $pdfFilePath = FCPATH . $filename_report;
                if (file_exists($pdfFilePath) == FALSE) {
                    //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                    $html = $this->load->view('reports/report_view/vehicle_trip_transport_report', $data, true); // render the view into HTML                        

                    $this->load->library('pdf');
                    $pdf = $this->pdf->load();
                    $pdf->WriteHTML($html); // write the HTML into the PDF
                    $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                    if ($html) {
                        echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                        return true;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                        true;
                    }
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data found'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }


    public function maintains_summary_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($startdate) && !empty($startdate) && isset($enddate) && !empty($enddate)) {
                $inst_id = $this->session->userdata('inst_id');
                $report_data = $this->MTReport->get_maintanance_summary_report($startdate, $enddate, $inst_id, $vehicle_id); //$vehicle_id,
                // dev_export($report_data);
                // die;
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) {


                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['report_data'] = $report_data['data'];
                    $data['startdate'] = $startdate;
                    $data['enddate'] = $enddate;
                    // dev_export($data['report_data']);
                    // die;
                    $data['title'] = 'Vehicle Maintenance Summary Report';
                    $data['bread_crumps'] = 'Docme Transport >> Transport Reports >> Vehicle Maintenance Summary Report';
                    $filename_report = "reports/maintenance_report/vehicle-maintenance-summary-report_" . time() . ".pdf";
                    $pdfFilePath = FCPATH . $filename_report;
                    if (file_exists($pdfFilePath) == FALSE) {
                        //ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                        $html = $this->load->view('reports/report_view/maintanance_summary_report', $data, true); // render the view into HTML                        
                        $this->load->library('pdf');
                        $pdf = $this->pdf->load();
                        $pdf->WriteHTML($html); // write the HTML into the PDF
                        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
                        if ($html) {
                            echo json_encode(array('status' => 1, 'link' => base_url($filename_report)));
                            // echo base_url($filename_report);
                            return true;
                        } else {
                            echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                            true;
                        }
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                    }
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'No data found between these dates'));
                    return true;
                }
            } else {
                $this->load->view('template/error-500');
            }
        }
    }
}
