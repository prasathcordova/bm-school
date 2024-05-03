<?php

/**
 * Description of Report_management_controller
 *
 * @author Aju
 */
class Report_management_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Report_management_model', 'MReport');
        $this->load->model('Stock_model', 'MStock');
    }

    public function report_stock_all_pre_load() {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'STOCK REPORT ';
            $store = $this->MStock->get_store_details();
            if ($store['error_status'] == 0 && $store['data_status'] == 1) {
                $data['store_data'] = $store['data'];
                $data['message'] = "";
            } else {
                $data['store_data'] = FALSE;
                $data['message'] = $store['message'];
            }
            $report_date_lock = $this->MReport->report_lock_date();
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1)
                $data['report_lock_date'] = $report_date_lock['data'][0]['STORE_OPEN_LOCK_DATE'];
            else
                $data['report_lock_date'] = NULL;

            $this->load->view('report/preloader/stock_report_detail', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function report_stock_summary_pre_load() {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'STOCK REPORT ';
            $store = $this->MStock->get_store_details();
            if ($store['error_status'] == 0 && $store['data_status'] == 1) {
                $data['store_data'] = $store['data'];
                $data['message'] = "";
            } else {
                $data['store_data'] = FALSE;
                $data['message'] = $store['message'];
            }
            $report_date_lock = $this->MReport->report_lock_date();
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1)
                $data['report_lock_date'] = $report_date_lock['data'][0]['STORE_OPEN_LOCK_DATE'];
            else
                $data['report_lock_date'] = NULL;
            $this->load->view('report/preloader/stock_report_summary', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function report_stock_itemwise_pre_load() {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'STOCK REPORT ';
            $store = $this->MStock->get_store_details();
            if ($store['error_status'] == 0 && $store['data_status'] == 1) {
                $data['store_data'] = $store['data'];
                $data['message'] = "";
            } else {
                $data['store_data'] = FALSE;
                $data['message'] = $store['message'];
            }
            $report_date_lock = $this->MReport->report_lock_date();
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1)
                $data['report_lock_date'] = $report_date_lock['data'][0]['STORE_OPEN_LOCK_DATE'];
            else
                $data['report_lock_date'] = NULL;
            $this->load->view('report/preloader/stock_report_itemwise', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function report_stock_allotment_outward_pre_load() {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'STOCK REPORT ';
            $store = $this->MStock->get_store_details();
            if ($store['error_status'] == 0 && $store['data_status'] == 1) {
                $data['store_data'] = $store['data'];
                $data['message'] = "";
            } else {
                $data['store_data'] = FALSE;
                $data['message'] = $store['message'];
            }
//            dev_export($data);die;
            $report_date_lock = $this->MReport->report_lock_date();
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1)
                $data['report_lock_date'] = $report_date_lock['data'][0]['STORE_OPEN_LOCK_DATE'];
            else
                $data['report_lock_date'] = NULL;
            $this->load->view('report/preloader/stock_report_allotment_outward', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function report_stock_allotment_inward_pre_load() {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'STOCK REPORT ';
            $store = $this->MStock->get_store_details();
            if ($store['error_status'] == 0 && $store['data_status'] == 1) {
                $data['store_data'] = $store['data'];
                $data['message'] = "";
            } else {
                $data['store_data'] = FALSE;
                $data['message'] = $store['message'];
            }
//            dev_export($data);die;
            $report_date_lock = $this->MReport->report_lock_date();
            if (isset($report_date_lock['data_status']) && !empty($report_date_lock['data_status']) && $report_date_lock['data_status'] == 1)
                $data['report_lock_date'] = $report_date_lock['data'][0]['STORE_OPEN_LOCK_DATE'];
            else
                $data['report_lock_date'] = NULL;
            $this->load->view('report/preloader/stock_report_allotment_inward', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }

    //Report generation control
    public function report_gen_stock_report_all() {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $store_id = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_STRING);
            $storename = filter_input(INPUT_POST, 'storename', FILTER_SANITIZE_STRING);
            if (isset($startdate) && !empty($startdate) && isset($enddate) && !empty($enddate) && isset($store_id) && !empty($store_id)) {
                $report_data = $this->MReport->get_stock_report_all($startdate, $enddate, $store_id);
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) {
                    $data['startdate'] = $startdate;
                    $data['enddate'] = $enddate;
                    $data['store_name'] = $storename;
                    $data['title'] = "BOOKSTORE - STOCK REPORT (DETAIL) - " . $storename;
                    $data_header['title'] = "BOOKSTORE - STOCK REPORT (DETAIL) - " . $storename;
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['report_data'] = $report_data['data'];
                    $html = $this->load->view('report/report_view/stock_all_report', $data, true); // render the view into HTML                    
                    $header_data = $this->load->view('report/report_view/header', $data_header, TRUE);
                    $header = '|' . $header_data . '|';
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('m-d-Y h:i:s');
                    $footer = '<div style="font-size:10px;font-weight: normal;">' . 'Docme -> Main Store -> Reports -> Detailed Stock Report. <br/> Printed on : ' . $data['user_name'] . '|{PAGENO}|' . '<div style="font-size:10px;font-weight: normal;">Generated By : ' . $data['user_name'] . '</div></div>';
                    $reportlink = $this->generate_pdf_report_stock_all($html, $data['user_name'], $header, $footer);
                    if ($reportlink) {
                        echo json_encode(array('status' => 1, 'link' => base_url($reportlink)));
                        return true;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                        true;
                    }
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'All mandatory fields are required'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function report_gen_stock_report_summary() {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $store_id = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_STRING);
            $storename = filter_input(INPUT_POST, 'storename', FILTER_SANITIZE_STRING);
            if (isset($startdate) && !empty($startdate) && isset($enddate) && !empty($enddate) && isset($store_id) && !empty($store_id)) {
                $report_data = $this->MReport->get_stock_report_summary($startdate, $enddate, $store_id);
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']['formatted_data']) && !empty($report_data['data']['formatted_data']) && isset($report_data['data']['grand_total_data']) && !empty($report_data['data']['grand_total_data'])) {
                    $data['startdate'] = $startdate;
                    $data['enddate'] = $enddate;
                    $data['title'] = "BOOKSTORE - STOCK REPORT (SUMMARY) - " . $storename;
                    $data['store_name'] = $storename;
                    
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['report_data'] = $report_data['data']['formatted_data'];
                    $data['grand_total_data'] = $report_data['data']['grand_total_data'];
                    
                    $data_header['title'] = "BOOKSTORE - STOCK REPORT (SUMMARY) - " . $storename;
                    $header_data = $this->load->view('report/report_view/header', $data_header, TRUE);
                    $header = '|' . $header_data . '|';
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('m-d-Y h:i:s');
                    $footer = '<div style="font-size:10px;font-weight: normal;">' . 'Docme -> Main Store -> Reports -> Stock Summary Report. <br/> Printed on : ' . $data['user_name'] . '|{PAGENO}|' . '<div style="font-size:10px;font-weight: normal;">Generated By : ' . $data['user_name'] . '</div></div>';
                    
                    $html = $this->load->view('report/report_view/stock_summary_report', $data, true); // render the view into HTML
//                    echo $html;die;
                    $reportlink = $this->generate_pdf_report_stock_all($html, $data['user_name'],$header,$footer);
                    if ($reportlink) {
                        echo json_encode(array('status' => 1, 'link' => base_url($reportlink)));
                        return true;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                        true;
                    }
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Report generation failed. Please try again later'));
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'All mandatory fields are required'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function report_gen_stock_allotment_outward_report_summary() {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $from_store_id = filter_input(INPUT_POST, 'from_store_id', FILTER_SANITIZE_STRING);
            $to_store_id = filter_input(INPUT_POST, 'to_store_id', FILTER_SANITIZE_STRING);
            $storename = filter_input(INPUT_POST, 'storename', FILTER_SANITIZE_STRING);
            if (isset($startdate) && !empty($startdate) && isset($enddate) && !empty($enddate) && isset($store_id) && !empty($store_id)) {
                $report_data = $this->MReport->get_stock_report_summary($startdate, $enddate, $store_id);
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']['formatted_data']) && !empty($report_data['data']['formatted_data']) && isset($report_data['data']['grand_total_data']) && !empty($report_data['data']['grand_total_data'])) {
                    $data['startdate'] = $startdate;
                    $data['enddate'] = $enddate;
                    $data['title'] = "BOOKSTORE - STOCK ALLOTMENT REPORT - " . $storename;
                    $data['store_name'] = $storename;
                    
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['report_data'] = $report_data['data']['formatted_data'];
                    $data['grand_total_data'] = $report_data['data']['grand_total_data'];
                    
                    $data_header['title'] = "BOOKSTORE - STOCK ALLOTMENT REPORT - " . $storename;
                    $header_data = $this->load->view('report/report_view/header', $data_header, TRUE);
                    $header = '|' . $header_data . '|';
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('m-d-Y h:i:s');
                    $footer = '<div style="font-size:10px;font-weight: normal;">' . 'Docme -> Main Store -> Reports -> Stock allotment Report. <br/> Printed on : ' . $data['user_name'] . '|{PAGENO}|' . '<div style="font-size:10px;font-weight: normal;">Generated By : ' . $data['user_name'] . '</div></div>';
                    
                    $html = $this->load->view('report/report_view/stock_allotment_outward', $data, true); // render the view into HTML
//                    echo $html;die;
                    $reportlink = $this->generate_pdf_report_stock_all($html, $data['user_name'],$header,$footer);
                    if ($reportlink) {
                        echo json_encode(array('status' => 1, 'link' => base_url($reportlink)));
                        return true;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                        true;
                    }
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'No Data available for this report.'));
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'All mandatory fields are required'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    private function generate_pdf_report_stock_all($report_html, $username, $header = '', $footer = '') {
        $filename_report = "reports/report_" . time() . ".pdf";
        $pdfFilePath = FCPATH . $filename_report;
        if (file_exists($pdfFilePath) == FALSE) {
            ini_set('memory_limit', '256M'); // boost the memory limit if it's low ;)
            ini_set("pcre.backtrack_limit", "10000000");
            $this->load->library('pdf');
            $pdf = $this->pdf->load_wide();
            if (isset($header) && !empty($header)) {
                $pdf->setAutoTopMargin = 'stretch';
                $pdf->SetHeader($header);
            }
            if (isset($footer) && !empty($footer)) {
                $pdf->SetFooter($footer); // Add a footer for good measure ;)
            }
            $pdf->WriteHTML($report_html); // write the HTML into the PDF    
            $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file 
            return $filename_report;
        } else {
            return false;
        }
    }

}
