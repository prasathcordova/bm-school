<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bill_controller
 *
 * @author Chandrajith
 */
class Bill_controller extends MX_Controller
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
        $this->load->model('Bill_model', 'MBill');
        $this->load->model('Sales_model', 'MSales');
    }

    public function student_bill()
    {
        $data['sub_title'] = 'Invoice';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('bill/student_bill', $data);
    }

    public function employee_bill()
    {
        $data['sub_title'] = 'Invoice';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('bill/employee_bill', $data);
    }

    public function bill_history()
    {
        $data['sub_title'] = 'Bill History';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('bill/bill_history', $data);
    }

    public function view_bill_history()
    {
        $data['sub_title'] = 'Bill History';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('bill/bill_view', $data);
    }

    public function bill_store()
    {

        $data['template'] = 'bill/show_settings';
        $data['title'] = 'STORE BILLING';
        $data['sub_title'] = 'Advance Settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Store',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Billing'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);

        $this->session->set_userdata('current_page', 'country');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['country_data']) && !empty($data['country_data'])) {
                foreach ($data['country_data'] as $country) {
                    $country_status = "";
                    if ($country['isactive'] == 1) {
                        $country_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        //$country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    } else {
                        $country_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\', this)" id="" class="js-switch"  /></a>';
                        //$country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\',\'' . $country['country_abbr'] . '\',\'' . $country['currency_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $country['country_name'] . '" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($country['country_name'], $country['country_abbr'], $country['currency_name'], $country_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('template/home_template', $data);
        }
    }

    public function cash_bill_pay()
    {
        if ($this->input->is_ajax_request() == 1) {

            $pack_id = filter_input(INPUT_POST, 'pack_id', FILTER_SANITIZE_NUMBER_INT);
            $studentid = filter_input(INPUT_POST, 'std_id', FILTER_SANITIZE_NUMBER_INT);
            $cashbill_data_raw = filter_input(INPUT_POST, 'cashbilldata');
            $item_data_raw = filter_input(INPUT_POST, 'item_data');

            if ($cashbill_data_raw) {
                $status = $this->MBill->save_cashbilldata($studentid, $pack_id, $cashbill_data_raw, $item_data_raw);
                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    //                    $bill_lin = $this->create_bill_print($status['billno']);
                    echo json_encode(array('status' => 1, 'message' => 'Billing details saved successfully with Bill No: ' . $status['billno'], 'billno' => $status['billno'], 'bill_link' => 'bill_lin', 'bill_code' => $status['billno']));

                    return true;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $status['message']));
                        return false;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Data error. Please contact administrator'));
                        return false;
                    }
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    public function cheque_bill_pay()
    {
        if ($this->input->is_ajax_request() == 1) {

            $pack_id = filter_input(INPUT_POST, 'pack_id', FILTER_SANITIZE_NUMBER_INT);
            $studentid = filter_input(INPUT_POST, 'std_id', FILTER_SANITIZE_NUMBER_INT);
            $cashbill_data_raw = filter_input(INPUT_POST, 'cashbilldata');
            $item_data_raw = filter_input(INPUT_POST, 'item_data');
            if ($cashbill_data_raw) {

                $status = $this->MBill->save_chequebilldata($studentid, $pack_id, $cashbill_data_raw, $item_data_raw);

                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    //                    $bill_lin = $this->create_bill_print($status['billno']);
                    echo json_encode(array('status' => 1, 'message' => 'Billing details saved successfully with Bill No: ' . $status['billno'], 'billno' => $status['billno'], 'bill_link' => '$bill_lin', 'bill_code' => $status['billno']));
                    return true;
                } else {
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

    public function search_pack()
    {
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $std_id = filter_input(INPUT_POST, 'std_id', FILTER_SANITIZE_NUMBER_INT);

        $searchpack = strtoupper(filter_input(INPUT_POST, 'searchpack', FILTER_SANITIZE_STRING));



        $user_data = $this->MBill->get_all_pack_with_search($searchpack, $std_id);
        //        dev_export($user_data);die;
        if ($user_data['error_status'] == 0 && $user_data['data_status'] == 1) {
            $data['pack_list'] = $user_data['data'];
            $data['message'] = "";
        } else {
            $data['pack_list'] = FALSE;
            $data['message'] = $user_data['message'];
        }

        $data['std_id'] = $std_id;

        $data['user_data'] = $user_data['data'];
        $data['user_name'] = $this->session->userdata('user_name');
        //        dev_export($data['user_data']);die;
        echo json_encode(array('status' => 1, 'view' => $this->load->view('bill/search_pack', $data, TRUE)));
        return TRUE;
    }

    public function create_bill_print($billcode)
    {
        $data['title'] = 'Student Bill';
        $data['sub_title'] = 'Student Bill';
        //        $details_data = $this->MSales->get_bill_pack_details($pack_id);
        $bill_details = $this->MBill->get_bill_details_for_print($billcode);
        //        dev_export($bill_details);die;

        if (isset($bill_details['data']) && !empty($bill_details['data'])) {
            $data['details_data'] = $bill_details['data'];
        } else {
            $data['details_data'] = NULL;
        }

        $username = $this->session->userdata('user_name');
        $billhtml = $this->load->view('bill/bill_print', $data, TRUE);

        $data_header['title'] = "BOOKSTORE - BILL (Duplicate Bill)";
        $header_data = $this->load->view('report/report_view/header', $data_header, TRUE);
        $header = '|' . $header_data . '|';
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y h:i:s');
        $footer = '<div style="font-size:10px;font-weight: normal;">' . 'Docme -> Store -> Bill <br/> Printed on : ' . $date . '|{PAGENO}|' . '<div style="font-size:10px;font-weight: normal;">Generated By : ' . $username . '</div></div>';

        //        echo $billhtml;
        //        die;
        $report = $this->generate_pdf_all($billhtml, $username, $header, $footer);
        //                     echo $report;die;                                                                            
        $reportlink = base_url("download/" . $report);
        return $reportlink;
    }

    public function create_bill_print_link($billcode)
    {
        $data['title'] = 'Student Bill';
        $data['sub_title'] = 'Student Bill';
        //        $details_data = $this->MSales->get_bill_pack_details($pack_id);
        $bill_details = $this->MBill->get_bill_details_for_print($billcode);
        //        dev_export($bill_details);die;

        if (isset($bill_details['data']) && !empty($bill_details['data'])) {
            $data['details_data'] = $bill_details['data'];
        } else {
            $data['details_data'] = NULL;
        }

        $username = $this->session->userdata('user_name');
        $billhtml = $this->load->view('bill/bill_print', $data, TRUE);

        $data_header['title'] = "BOOKSTORE - BILL (Duplicate Bill)";
        $header_data = $this->load->view('report/report_view/header', $data_header, TRUE);
        $header = '|' . $header_data . '|';
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y h:i:s');
        $footer = '<div style="font-size:10px;font-weight: normal;">' . 'Docme -> Store -> Bill <br/> Printed on : ' . $date . '|{PAGENO}|' . '<div style="font-size:10px;font-weight: normal;">Generated By : ' . $username . '</div></div>';

        //        echo $billhtml;
        //        die;
        $report = $this->generate_pdf_all_link($billhtml, $username, $header, $footer);
        //                     echo $report;die;                                                                            
        //        $reportlink = base_url("download/" . $report);
        $file = BILL_FOLDER_PATH . $report;

        //        echo $file;die;
        if (file_exists($file)) {
            $this->load->helper('download');
            $data = file_get_contents($file);
            force_download($report, $data);
        }
        //        return $reportlink;
    }
    public function create_bill_print_link_other($billcode)
    {
        $data['title'] = 'Student Bill';
        $data['sub_title'] = 'Student Bill';
        $bill_details = $this->MBill->get_bill_details_for_print($billcode);
        $inst_id = $this->session->userdata('inst_id');
        $bill_type = $this->session->userdata('BILLTYPE');
        if (isset($bill_details['data']) && !empty($bill_details['data'])) {
            $data['details_data'] = $bill_details['data'];
        } else {
            $data['details_data'] = NULL;
        }

        $username = $this->session->userdata('user_name');
        if ($bill_type == 'L') {
            $billhtml = $this->load->view('bill/bill_laser_print_dot_matrix', $data, TRUE);
        } else {
            $billhtml = $this->load->view('bill/bill_print_dot_matrix', $data, TRUE);
        }
        $data_header['title'] = "BOOKSTORE - BILL";
        //        $header_data = $this->load->view('report/report_view/header', $data_header, TRUE);
        //        $header = '|' . $header_data . '|';
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y h:i:s');
        $footer = '<div style="font-size:10px;font-weight: normal;">' . 'Docme -> Store -> Bill <br/> Printed on : ' . $date . '|{PAGENO}|' . '<div style="font-size:10px;font-weight: normal;">Generated By : ' . $username . '</div></div>';

        echo $billhtml;
        return;
        //        die;
        //        $report = $this->generate_pdf_all_link($billhtml, $username, $header, $footer);
        ////                     echo $report;die;                                                                            
        ////        $reportlink = base_url("download/" . $report);
        //        $file = BILL_FOLDER_PATH . $report;
        //
        ////        echo $file;die;
        //        if (file_exists($file)) {
        //            $this->load->helper('download');
        //            $data = file_get_contents($file);
        //            force_download($report, $data);
        //        }
        //        return $reportlink;
    }


    public function create_bill_print_link_duplicate($billcode)
    {
        $data['title'] = 'Student Bill';
        $data['sub_title'] = 'Student Bill';
        $bill_details = $this->MBill->get_bill_details_for_print($billcode);
        $inst_id = $this->session->userdata('inst_id');
        $bill_type = $this->session->userdata('BILLTYPE');
        $data['duplicate_label'] = '-Duplicate';
        if (isset($bill_details['data']) && !empty($bill_details['data'])) {
            $data['details_data'] = $bill_details['data'];
        } else {
            $data['details_data'] = NULL;
        }

        $username = $this->session->userdata('user_name');
        if ($bill_type == 'L') {
            $billhtml = $this->load->view('bill/bill_laser_print_dot_matrix', $data, TRUE);
        } else {
            $billhtml = $this->load->view('bill/bill_print_dot_matrix', $data, TRUE);
        }
        $data_header['title'] = "BOOKSTORE - BILL";
        //        $header_data = $this->load->view('report/report_view/header', $data_header, TRUE);
        //        $header = '|' . $header_data . '|';
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-Y h:i:s');
        $footer = '<div style="font-size:10px;font-weight: normal;">' . 'Docme -> Store -> Bill <br/> Printed on : ' . $date . '|{PAGENO}|' . '<div style="font-size:10px;font-weight: normal;">Generated By : ' . $username . '</div></div>';

        echo $billhtml;
        return;
    }

    private function generate_pdf_all_link($report_html, $username, $header = '', $footer = '')
    {
        $file_name = "bill_" . time() . ".pdf";
        $filename_report = "bill/" . $file_name;
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
            return $file_name;
        } else {
            return false;
        }
    }

    private function generate_pdf_all($report_html, $username, $header = '', $footer = '')
    {
        $filename_report = "bill/bill_" . time() . ".pdf";
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

    public function download($file_data = NULL)
    {
        $this->load->helper('download');
        if ($file_data) {
            $file = BILL_FOLDER_PATH . $file_data;
            if (file_exists($file)) {
                $data = file_get_contents($file);
                force_download($file_data, $data);
            } else {
                redirect(base_url());
            }
        }
    }

    public function Bill_cancell()
    {
        if ($this->input->is_ajax_request() == 1) {

            $bill_masterid = filter_input(INPUT_POST, 'billid', FILTER_SANITIZE_NUMBER_INT);
            $reason = filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING);
            if ($bill_masterid) {
                $status = $this->MBill->cancel_bill($bill_masterid, $reason);
                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Bill No: ' . $status['billcode'] . ' cancelled successfully.'));

                    return true;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $status['message']));
                        return false;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Data error. Please contact administrator'));
                        return false;
                    }
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    public function voucher_cancel()
    {
        if ($this->input->is_ajax_request() == 1) {
            $payment_id = filter_input(INPUT_POST, 'payment_id', FILTER_SANITIZE_NUMBER_INT);
            $bill_masterid = filter_input(INPUT_POST, 'billid', FILTER_SANITIZE_NUMBER_INT);
            $reason = filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING);
            if ($bill_masterid && $payment_id) {
                $status = $this->MBill->cancel_voucher($payment_id, $bill_masterid, $reason);
                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Voucher No: ' . $status['billcode'] . ' cancelled successfully.'));

                    return true;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $status['message']));
                        return false;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'Data error. Please contact administrator'));
                        return false;
                    }
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    public function process_cash_on_delivery()
    {
        $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
        $pack_id = filter_input(INPUT_POST, 'pack_id', FILTER_SANITIZE_NUMBER_INT);
        $details_data = $this->MSales->get_bill_pack_details($pack_id);

        $pack_list_data = $this->MSales->studentpack_bill_select_oh($student_id, $pack_id);
        $pack_data = $pack_list_data['data']['data'][0];



        $pack_item_data = $details_data['data'];

        foreach ($pack_item_data as $item_data) {

            $discount = ((isset($item_data['oh_discount']) ? $item_data['oh_discount'] : (isset($item_data['discount']) ? $item_data['discount'] : 0)) * $item_data['sub_total']) / 100;
            $discount = ROUND($discount, 2);
            if ($item_data['tax_type'] == 'P') {
                $vat_amt = round(($item_data['sub_total'] - $discount) * $item_data['tax_percent'] / 100, 2, PHP_ROUND_HALF_UP);
            } else {
                $vat_amt = round($item_data['tax_percent'] * $item_data['qty'], 2, PHP_ROUND_HALF_UP);
            }
            $online_payment_item_data = [
                "itemid" => $item_data['item_id'],
                "quantity" => $item_data['qty'],
                "rate" => $item_data['Rate'],
                "sub_total" => $item_data['sub_total'],
                "discount_type" => $item_data['discount_type'],
                "discount_value" => $discount,
                "discount_amt" => $discount,
                "sub_total_after_discount" => $item_data['sub_total'],
                "vat_type" => 'P',
                "vat_percent" => $item_data['tax_percent'],
                "vat_after_discount" => $vat_amt,
                "final_total" => $item_data['sub_total'],
            ];

            $online_payment_item_details_data[] = $online_payment_item_data;
        }
        $online_payment_data['payment_mode_id'] = 1;
        $online_payment_data['sub_total'] = $pack_data['sub_total'];
        $online_payment_data['is_discount'] = $pack_data['discount'] == 0 ? 0 : 1;
        $online_payment_data['discount_percent'] = $pack_data['discount_percent'];
        $online_payment_data['discount_amount'] = $pack_data['discount'];
        $online_payment_data['is_tax'] = 0;
        $online_payment_data['tax_amount'] = $pack_data['vat_amount'];
        $online_payment_data['total_amount'] = $pack_data['final_total'];
        $online_payment_data['round_off'] = $pack_data['roundoff'];
        $online_payment_data['final_amount'] = $pack_data['final_total'];
        $online_payment_data['is_ecash'] = 0;
        $online_payment_data['ecash_id'] = 0;
        $online_payment_data['ecash_amount'] = 0;
        $online_payment_data['final_payment_amount'] = $pack_data['final_total'];
        $online_payment_data['is_payment_done'] = 1;
        $json_online_data = json_encode($online_payment_data);


        $json_online_item_data = json_encode($online_payment_item_details_data);

        $status = $this->MBill->save_cashbilldata($student_id, $pack_id, $json_online_data, $json_online_item_data);
        $billcode = $status['billno'];
        $json_data['billcode'] = $billcode;

        $data_prep['pack_id'] = $pack_id;
        $data_prep['payment_status'] = 1;
        $data_prep['payment_details'] = $billcode;
        $data_prep['payment_amount'] = $pack_data['final_total'];

        $result_data = $this->MSales->update_online_delivery_details($data_prep);


        echo json_encode($json_data);
    }
}
