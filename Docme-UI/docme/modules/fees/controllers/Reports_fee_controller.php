<?php

/**
 * Description of Reports_fee_controller
 *
 * @author Aju
 */
require_once APPPATH . '/third_party/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Reports_fee_controller extends MX_Controller
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
        $this->load->model('Fees_reports_model', 'MReport');
        $this->load->model('student_settings/Registration_model', 'MRegistration');
        $this->load->model('Fees_collection_model', 'MFee_collection');
        $this->load->model('Nondemandfee_model', 'MNondemand_fee');
    }

    public function show_fee_report_settings()
    {
        $data['template'] = 'fees_settings/show_report_settings';
        $data['title'] = 'REPORTS';
        $data['sub_title'] = 'Report';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('school/home'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Fee management',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Reports'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $this->load->view('template/home_template', $data);
    }

    //Daily collection report preloader
    public function show_daily_collection_preload()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Daily Collection Report';
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
            $this->load->view('report/daily_collection_voucher_wise', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    //Daily collection report generator
    public function get_daily_collection_voucher_wise_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate          = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate            = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $user_wise_report   = filter_input(INPUT_POST, 'user_wise_report');
            $rpt_type           = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $type               = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $inst_id            = $this->session->userdata('inst_id');
            $user_id            = $this->session->userdata('userid');
            $acd_year_id        = $this->session->userdata('acd_year');
            $logged_user        = $this->session->userdata('userid');

            $data_prep = array(
                'action' => 'get-voucher-wise-collection-report',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'user_wise_report' => $user_wise_report,
                'logged_user' => $logged_user
            );
            $report_data = $this->MReport->get_daily_collection_voucher_wise_report_data($data_prep);
            // dev_export($report_data);
            // die;
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if ($rpt_type == 1) {
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) { //&& isset($report_data['data']) && !empty($report_data['data'])
                    //$data['details_data'] = $report_data['data']; 
                    $data['details_data'] = $details_data = $report_data['formatted_data'];
                    if (isset($details_data) && !empty($details_data)) {

                        $data['feesummary_data'] = $feesummary_data = $report_data['feesummary'];
                        $data['minisummary_data'] = $report_data['minisummary'];
                        $data['totalsummary_data'] = $report_data['totalsummary'];
                        $data['otherdetails_data'] = $report_data['otherdetails'];
                        $data['feecodesavailable'] = $report_data['feecodesavailable'];
                        $data['ndmd_feedetails'] = $report_data['ndmd_feedetails'];
                        $data['non_demandable_feecodes'] = $report_data['non_demandable_feecodes'];
                        $data['fee_date'] = $startdate;
                        $data['message'] = "";

                        $data['user_name'] = $this->session->userdata('user_name');
                        $data['title'] = 'Daily Collection Report';
                        $data['bread_crumps'] = 'Fees Management > Reports > Daily Collection Report';
                        $data['filename_report'] = "reports/daily_collection_report_" . $inst_id . "_" . $user_id . ".pdf";
                        $data['viewname'] = 'report/pdf/daily_collection_voucher_wise_pdf';
                        // $data['collection_date'] = 'Collection On : ' . date('d/M/Y', strtotime($startdate));
                        $data['collection_date'] = $collection_date = 'Collection From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                        $filename = $this->get_pdf_report($data, 'L');
                        //echo $filename;
                        echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                }
            } else {
                $result_array = array();

                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) { //&& isset($report_data['data']) && !empty($report_data['data'])
                    //$data['details_data'] = $report_data['data']; 

                    $data['details_data'] = $details_data = $report_data['formatted_data'];
                    if (isset($details_data) && !empty($details_data)) {
                        $data['feesummary_data'] = $feesummary_data = $report_data['feesummary'];
                        $data['minisummary_data'] = $minisummary_data = $report_data['minisummary'];
                        $data['totalsummary_data'] = $totalsummary_data = $report_data['totalsummary'];
                        $data['otherdetails_data'] = $otherdetails_data = $report_data['otherdetails'];
                        $data['feecodesavailable'] = $feecodesavailable = $report_data['feecodesavailable'];
                        $data['ndmd_feedetails'] = $ndmd_feedetails = $report_data['ndmd_feedetails'];
                        $data['non_demandable_feecodes'] = $non_demandable_feecodes = $report_data['non_demandable_feecodes'];
                        $data['collection_date'] = $collection_date = 'Collection From :' . date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));

                        $result_array_1 = [];
                        $result_array_2 = [];
                        $result_array_3 = [];
                        $result_array_4 = [];
                        $result_array_5 = [];
                        $result_array_6 = [];
                        $result_array_7 = [];
                        $result_array_8 = [];

                        foreach ($report_data['formatted_data'] as $vouchercode => $rpt_data) {
                            $dataforexcel["Admission No."] = $rpt_data['student_details']['Admn_No'];
                            $dataforexcel["Student Name"] = $rpt_data['student_details']['First_Name'];
                            $dataforexcel["Voucher"] = $rpt_data['student_details']['voucher_code'];
                            $row_total_amt = 0;
                            foreach ($report_data['feecodesavailable'] as $fcodes_hearder) {
                                $cash = (isset($rpt_data['fee_details'][$fcodes_hearder['feeCode']]['amt_paid']) ? $rpt_data['fee_details'][$fcodes_hearder['feeCode']]['amt_paid'] : 0);
                                $ret_val = my_money_format_for_excel($cash);
                                $dataforexcel[$fcodes_hearder['fee_shortcode']] = $ret_val;
                                $row_total_amt = $row_total_amt + $cash;
                            }
                            $tot_amt = my_money_format_for_excel($row_total_amt);
                            $dataforexcel["Amount"] = $tot_amt;
                            $dataforexcel["Type"] = $rpt_data['student_details']['trans_type'];
                            $result_array_1[] = $dataforexcel;
                        }

                        foreach ($feesummary_data['TRANSTYPES'] as $key => $value) {

                            $dataforexcel_2[""]  = $value;

                            foreach ($feecodesavailable as $fcodes_hearder) {
                                if ($value == 'Round Off') $amt_display = '';
                                else $amt_display = my_money_format_for_excel((isset($feesummary_data[$fcodes_hearder['feeCode']][$key]) ? $feesummary_data[$fcodes_hearder['feeCode']][$key] : 0));
                                $dataforexcel_2[$fcodes_hearder['fee_shortcode']]  = $amt_display;
                            }
                            $dataforexcel_2["Total"]  = my_money_format_for_excel((isset($feesummary_data['TOTAL'][$key]) ? $feesummary_data['TOTAL'][$key] : 0));

                            $result_array_2[]                = $dataforexcel_2;
                        }

                        $i = 1;
                        $totcolamt = 0;
                        if (isset($ndmd_feedetails) && !empty($ndmd_feedetails)) {
                            foreach ($ndmd_feedetails as $ddate => $rpt_data) {
                                // foreach ($rpt_data as $pay_type => $rpt_lvl2) {
                                $dataforexcel_3["Admission No."]  = $rpt_data['student_details']['Admn_No'];
                                $dataforexcel_3["Student Name"]   = $rpt_data['student_details']['First_Name'];
                                $dataforexcel_3["Voucher"]        = $rpt_data['student_details']['voucher_code'];
                                $row_total_amt = 0;
                                $widthremain = 76;
                                $ignore_array = ['F023', 'F101', 'F025'];
                                foreach ($non_demandable_feecodes as $nd_fcodes2) {
                                    if (!in_array($nd_fcodes2['feeCode'], $ignore_array)) {
                                        $cash = (isset($rpt_data['fee_details'][$nd_fcodes2['feeCode']]['amt_paid']) ? $rpt_data['fee_details'][$nd_fcodes2['feeCode']]['amt_paid'] : 0);
                                        $dataforexcel_3[$nd_fcodes2['fee_shortcode']] = my_money_format_for_excel($cash);
                                        $row_total_amt = $row_total_amt + $cash;
                                    }
                                }
                                $dataforexcel_3["Amount"]  = my_money_format_for_excel($row_total_amt);
                                $dataforexcel_3["Type"]    = $rpt_data['student_details']['trans_type'];
                                $totcolamt = $totcolamt + $row_total_amt;
                                $result_array_3[]                = $dataforexcel_3;
                                // }
                            }
                        }
                        // }
                        $ft = 1;
                        foreach ($feecodesavailable as $fcodes_hearder1) {
                            $dataforexcel_4["Sl No."]  = $ft;
                            $dataforexcel_4["Code"]  = $fcodes_hearder1['fee_shortcode'];
                            $dataforexcel_4["Description"]  = $fcodes_hearder1['description'];
                            $result_array_4[]  = $dataforexcel_4;
                            $ft++;
                        }
                        $ot = 1;
                        foreach ($non_demandable_feecodes as $nd_fcodes1) {
                            if (($nd_fcodes1['feeCode'] != 'F023' && $nd_fcodes1['feeCode'] != 'F101') && $nd_fcodes1['editable'] == 1) {
                                $dataforexcel_5["Sl No."]  = $ot;
                                $dataforexcel_5["Code"] = $nd_fcodes1['fee_shortcode'];
                                $dataforexcel_5["Description"] = $nd_fcodes1['description'];
                            }
                            $result_array_5[]                = $dataforexcel_5;
                            $ot++;
                        }
                        $tax = $this->print_tax_vat_excel($inst_id);
                        foreach ($totalsummary_data as $key => $value) {
                            if ($key == 'Total') {
                                $st = 'style=font-weight:bold';
                            } else $st = '';
                            $dataforexcel_6[""]  = $key . ":";
                            $dataforexcel_6["Cash / Cheque / Card / DBT (A)"]  = my_money_format_for_excel($value['amount']);
                            $dataforexcel_6["Transfer (with " . $tax . ")"]  = my_money_format_for_excel($value['transfer']);
                            $dataforexcel_6[$tax . " (C)"]  = my_money_format_for_excel($value['vat']);
                            $dataforexcel_6["Total (A + C)"]  = my_money_format_for_excel($value['total']);
                            $result_array_6[]                = $dataforexcel_6;
                        }
                        $dataforexcel_7["Cash"]  = my_money_format_for_excel($minisummary_data['cash']);
                        $dataforexcel_7["Cheque"]  = my_money_format_for_excel($minisummary_data['cheque']);
                        $dataforexcel_7["Card"]  = my_money_format_for_excel($minisummary_data['card']);
                        $dataforexcel_7["DBT"]  = my_money_format_for_excel($minisummary_data['dbt']);
                        $dataforexcel_7["Online"]  = my_money_format_for_excel($minisummary_data['online']);
                        $dataforexcel_7["Transfer"]  = my_money_format_for_excel($minisummary_data['transfer']);
                        $dataforexcel_7["Prospectus Fee (with service charge(if any))"]  = my_money_format_for_excel($minisummary_data['prospectus']);
                        $dataforexcel_7["Registration Fee(with service charge(if any))"]  = my_money_format_for_excel($minisummary_data['regfee']);
                        $dataforexcel_7["Gross Amount"]  = my_money_format_for_excel($minisummary_data['grossamount']);
                        $head_n = "Transfer (-) With " . $tax;
                        $dataforexcel_7["Round Off (+)"]  = my_money_format_for_excel($minisummary_data['round_off']);
                        $dataforexcel_7[$head_n]  = my_money_format_for_excel($minisummary_data['transferless']);
                        $dataforexcel_7["Payback (-)"]  = my_money_format_for_excel($minisummary_data['paybackless']);
                        $dataforexcel_7["Net Amount"]  = my_money_format_for_excel($minisummary_data['netamount']);
                        $result_array_7[]                = $dataforexcel_7;
                        foreach ($otherdetails_data as $key => $odd) {
                            $dataforexcel_8[$key] = my_money_format_for_excel($odd);
                        }
                        $result_array_8[]                = $dataforexcel_8;


                        $result_datas["Reports"] = $result_array_1;
                        $result_datas["Daily Total as follows"] = $result_array_2;
                        $result_datas["summary1"] = $result_array_6;
                        $result_datas["summary2"] = $result_array_7;
                        $result_datas["summary3"] = $result_array_8;
                        $result_datas["Others"] = $result_array_3;
                        $result_datas["Fee Code Descriptions"] = $result_array_4;
                        $result_datas["OTHER FEE CODE DESCRIPTIONS"] = $result_array_5;





                        $this->load->helper('sheet');
                        $file_rand_name = "DAILY_COLLECTION_REPORT_";
                        $filename_report = get_excel_report_dynamic($result_datas, $file_rand_name, $collection_date);
                        echo json_encode(array('status' => 1, 'message' => base_url() . '/reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                }
            }
        } else {
            echo $this->load->view(ERROR_500);
            return;
        }
    }

    //Regfee collection report preloader
    public function show_regfee_collection_preload()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Registration Fee Collection Report';
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
            $this->load->view('report/regfee_collection', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    //show_base_fee_educore_preload
    public function show_base_fee_educore_preload()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Base fee for Educore Access Report';
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
            $this->load->view('report/base_fee_educore', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    //Daily collection report generator
    public function get_base_fee_educore_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $logged_user = $this->session->userdata('userid');

            $data_prep = array(
                'action'                => 'get_base_fee_educore_report',
                'controller_function'   => 'Fees_settings/Fee_report_controller/get_base_fee_educore_report',
                'from_date'             => $startdate,
                'to_date'               => $enddate,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id
            );
            $report_data = $this->MReport->report_function_in_model($data_prep);
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Base fee for Educore Access Report';
                    $data['bread_crumps'] = 'Fees Management > Reports > Base fee for Educore Access Report';
                    $data['filename_report'] = "reports/base_fee_educore_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/base_fee_educore_report_pdf';
                    $data['collection_date'] = 'From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $data['details_data'] = $details_data = $report_data['data'];
                    $collection_date = 'Report Date : ' . date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));
                    $totcolamt = 0;
                    $result_array = [];

                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data as $rptdata) {
                            $dataforexcel["Student Name"]  = $rptdata['student_name'];
                            $dataforexcel["Admission No."]  = $rptdata['Admn_No'];
                            $dataforexcel["Class"]         = $rptdata['class'];
                            // $dataforexcel["Set Date"]      = $rptdata['voucher_number'] ;
                            $dataforexcel["Set Date"]  = date('d-m-Y', strtotime($rptdata['set_date']));
                            $dataforexcel["Set Amount"]    = my_money_format_for_excel($rptdata['amount_limit']);
                            $dataforexcel["Paid Amount"]   = my_money_format_for_excel($rptdata['paid_amount']);
                            $result_array[]                = $dataforexcel;
                            $totcolamt = $totcolamt + $rptdata['paid_amount'];
                        }
                        $total_array["Total Amount"] = $totcolamt;
                        $this->load->helper('sheet');
                        $file_rand_name = "base_fee_educore_report_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            echo $this->load->view(ERROR_500);
            return;
        }
    }

    //Daily collection report generator
    public function get_regfee_collection_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate  = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate    = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $rpt_type           = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $logged_user = $this->session->userdata('userid');

            $data_prep = array(
                'action'                => 'get_regfee_collection_report',
                'controller_function'   => 'Fees_settings/Fee_report_controller/get_regfee_collection_report',
                'from_date'             => $startdate,
                'to_date'               => $enddate,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id
            );
            $report_data = $this->MReport->report_function_in_model($data_prep);
            if ($rpt_type == 1) {
                $data['inst_currency'] = $this->session->userdata('Currency_abbr');
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Registration Fee Collection Report';
                    $data['bread_crumps'] = 'Fees Management > Reports > Registration Fee Collection Report';
                    $data['filename_report'] = "reports/regfee_collection_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/regfee_collection_report_pdf';
                    $data['collection_date'] = 'Collection From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                }
            } else {
                $data['inst_currency'] = $this->session->userdata('Currency_abbr');
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                    $data['details_data'] = $details_data = $report_data['data'];
                    $collection_date = 'Collection From : ' . date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));

                    $i = 1;
                    $totcolamt = 0;
                    $totbch = 0;
                    $result_array = [];

                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data as $rptdata) {
                            $dataforexcel["Admission No."]       = $rptdata['admn_no'];
                            $dataforexcel["Student Name"]  = $rptdata['student_name'];
                            $dataforexcel["Class"]         = $rptdata['class'];
                            $dataforexcel["Voucher Date"]  = date('d-m-Y', strtotime($rptdata['voucher_date']));
                            $dataforexcel["Voucher Code"]  = $rptdata['voucher_code'];
                            $dataforexcel["Trans. Type"]   = $rptdata['trans_type'];
                            $dataforexcel["Trans. Type"]   = $rptdata['trans_type'];
                            $dataforexcel["Online Txn Date"]   = $rptdata['trans_type'] == 'O' ? date('d-m-Y', strtotime($rptdata['online_transaction_date'])) : '';
                            $dataforexcel["Online Txn Id"]   = $rptdata['trans_type'] == 'O' ? $rptdata['online_transaction_id'] : '';
                            $dataforexcel["Amount"]        =  my_money_format_for_excel($rptdata['amount'] - $rptdata['service_charge']);
                            $totcolamt  = $totcolamt + $rptdata['amount'];
                            $totbch     = $totbch + $rptdata['service_charge'];
                            $result_array[]                = $dataforexcel;
                        }
                        $total_array["Total Amount"]           = my_money_format_for_excel($totcolamt);
                        $total_array["Service Charge"]         = my_money_format_for_excel($totbch);
                        $total_array["Grand Total"]           = my_money_format_for_excel(($totcolamt + $totbch));

                        $this->load->helper('sheet');
                        $file_rand_name = "registration_fee_collection_report_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                }
            }
        } else {
            echo $this->load->view(ERROR_500);
            return;
        }
    }

    //SUMMARY COLLECTION REPORT
    public function show_preload_summary_collection_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Summary Collection Report';
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
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $feecodes_available = $this->MFee_collection->get_all_feecodes_available($inst_id);
            if (isset($feecodes_available['data']) && !empty($feecodes_available['data'])) {
                $data['feecodes_available'] = $feecodes_available['data'];
            } else {
                $data['feecodes_available'] = 0;
            }
            $data['acdyr_data'] = $acdyr_data['data'];
            $this->load->view('report/summary_collection', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_summary_collection_report_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $data_prep = array(
                'action' => 'get-summary-collection-details',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            $report_data = $this->MReport->get_headwise_collection_report_data($data_prep);
            // dev_export($report_data);
            // die;

            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) { //&& isset($report_data['data']) && !empty($report_data['data'])
                if ($rpt_type == 1) {
                    $data['details_data'] = $details_data = $report_data['data'];
                    if (isset($details_data) && !empty($details_data)) {
                        $data['message'] = "";
                        $data['feesummary_data'] = $report_data['feesummary'];
                        $data['minisummary_data'] = $report_data['minisummary'];
                        $data['totalsummary_data'] = $report_data['totalsummary'];
                        $data['otherdetails_data'] = $report_data['otherdetails'];
                        $data['fee_date'] = $startdate;
                        $data['feecodes_data'] = $report_data['feecodes'];
                        $data['ndmd_feedetails'] = $report_data['ndmd_feedetails'];
                        $data['non_demandable_feecodes'] = $report_data['non_demandable_feecodes'];
                        $data['sercharge_for_payments'] = $report_data['sercharge_for_payments'];
                        $data['roundoff_for_payments'] = $report_data['roundoff_for_payments'];
                        $data['user_name'] = $this->session->userdata('user_name');
                        $data['title'] = 'Summary Collection report';
                        $data['bread_crumps'] = 'Fees Management > Reports > Summary Collection report';
                        $data['filename_report'] = "reports/summary_collection_report_" . $inst_id . "_" . $user_id . ".pdf";
                        $data['viewname'] = 'report/pdf/summary_collection_report_pdf';
                        $data['collection_date'] = 'Summary Collection From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                        $filename = $this->get_pdf_report($data, 'L');
                        echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                } else {
                    $data['details_data'] = $details_data = $report_data['data'];
                    if (isset($details_data) && !empty($details_data)) {
                        $data['message'] = "";
                        $data['feesummary_data'] = $feesummary_data = $report_data['feesummary'];
                        $data['minisummary_data'] = $minisummary_data = $report_data['minisummary'];
                        $data['totalsummary_data'] = $totalsummary_data = $report_data['totalsummary'];
                        $data['otherdetails_data'] = $otherdetails_data = $report_data['otherdetails'];
                        $data['fee_date'] = $fee_date = $startdate;
                        $data['feecodes_data'] = $feecodes_data = $report_data['feecodes'];
                        $data['ndmd_feedetails'] = $ndmd_feedetails = $report_data['ndmd_feedetails'];
                        $data['non_demandable_feecodes'] = $non_demandable_feecodes = $report_data['non_demandable_feecodes'];
                        $sercharge_for_payments = $report_data['sercharge_for_payments'];
                        $roundoff_for_payments = $report_data['roundoff_for_payments'];
                        $data['collection_date'] = $collection_date = date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));

                        $totcolamt = 0;
                        $result_array_1 = [];
                        $result_array_2 = [];
                        $result_array_3 = [];
                        $result_array_4 = [];
                        $result_array_5 = [];
                        $result_array_6 = [];
                        $result_array_7 = [];
                        $result_array_8 = [];
                        foreach ($details_data as $ddate => $rpt_data) {
                            foreach ($rpt_data as $pay_type => $rpt_lvl2) {
                                $row_total_amt = 0;
                                $dataforexcel["Month"]       = date('M-Y', strtotime($ddate));
                                foreach ($feecodes_data as $fcodes_hearder) {
                                    if ($fcodes_hearder['fee_shortcode'] != 'BCH') {
                                        $cash = (isset($rpt_data[$pay_type][$fcodes_hearder['feeCode']]['amt_paid']) ? $rpt_data[$pay_type][$fcodes_hearder['feeCode']]['amt_paid'] : 0);
                                        $dataforexcel[$fcodes_hearder['fee_shortcode']] = my_money_format_for_excel($cash);
                                        $row_total_amt = $row_total_amt + $cash;
                                    }

                                    // $dataforexcel["Month"]       =($fcodes_hearder['fee_shortcode'] == 'BCH') ? $fcodes_hearder['fee_shortcode'] :"";
                                }
                                $totcolamt = $totcolamt + $row_total_amt;
                                $dataforexcel["Total"]       = my_money_format_for_excel($row_total_amt);
                                $dataforexcel["Pay Type"]       = $pay_type;
                                $result_array_1[]                = $dataforexcel;
                            }
                        }
                        $total_array["Report"]["Service Charge"] = my_money_format_for_excel($sercharge_for_payments);
                        $total_array["Report"]["Round Off"] = my_money_format_for_excel($roundoff_for_payments);
                        $total_array["Report"]["Total"] = my_money_format_for_excel($totcolamt + $sercharge_for_payments + $roundoff_for_payments);

                        foreach ($feesummary_data['TRANSTYPES'] as $key => $value) {

                            $dataforexcel_2[""]  = $value;

                            foreach ($feecodes_data as $fcodes_hearder) {
                                if ($value == 'Round Off') $amt_display = '';
                                else $amt_display = my_money_format_for_excel((isset($feesummary_data[$fcodes_hearder['feeCode']][$key]) ? $feesummary_data[$fcodes_hearder['feeCode']][$key] : 0));
                                $dataforexcel_2[$fcodes_hearder['fee_shortcode']]  = $amt_display;
                            }
                            $dataforexcel_2["Total"]  = my_money_format((isset($feesummary_data['TOTAL'][$key]) ? $feesummary_data['TOTAL'][$key] : 0));

                            $result_array_2[]                = $dataforexcel_2;
                        }
                        $result_datas["Report"] = $result_array_1;
                        $result_datas["Details"] = $result_array_2;


                        $i = 1;
                        $totcolamt = 0;
                        if (isset($ndmd_feedetails) && !empty($ndmd_feedetails)) {
                            foreach ($ndmd_feedetails as $ddate => $rpt_data) {
                                foreach ($rpt_data as $pay_type => $rpt_lvl2) {
                                    $dataforexcel_3["Month"]  = date('M-Y', strtotime($ddate));
                                    $row_total_amt = 0;
                                    $widthremain = 76;
                                    $ignore_array = ['F023', 'F101'];
                                    foreach ($non_demandable_feecodes as $nd_fcodes2) {
                                        if (!in_array($nd_fcodes2['feeCode'], $ignore_array)) {
                                            $cash = (isset($rpt_data[$pay_type][$nd_fcodes2['feeCode']]['amt_paid']) ? $rpt_data[$pay_type][$nd_fcodes2['feeCode']]['amt_paid'] : 0);
                                            $dataforexcel_3[$nd_fcodes2['fee_shortcode']] = my_money_format_for_excel($cash);
                                            $row_total_amt = $row_total_amt + $cash;
                                        }
                                    }
                                    $dataforexcel_3["Total"]  = my_money_format_for_excel($row_total_amt);
                                    $dataforexcel_3["Pay Type"]  = $pay_type;
                                    $totcolamt = $totcolamt + $row_total_amt;
                                    $result_array_3[]                = $dataforexcel_3;
                                }
                            }
                            $result_datas["Others"] = $result_array_3;
                            $total_array["Others"]["Total"] = my_money_format_for_excel($totcolamt);
                        }
                        $ft = 1;
                        foreach ($feecodes_data as $fcodes_hearder1) {
                            $dataforexcel_4["Sl No."]  = $ft;
                            $dataforexcel_4["Code"]  = $fcodes_hearder1['fee_shortcode'];
                            $dataforexcel_4["Description"]  = $fcodes_hearder1['description'];
                            $result_array_4[]  = $dataforexcel_4;
                            $ft++;
                        }
                        $ot = 1;
                        foreach ($non_demandable_feecodes as $nd_fcodes1) {
                            if (($nd_fcodes1['feeCode'] != 'F023' && $nd_fcodes1['feeCode'] != 'F101') && $nd_fcodes1['editable'] == 1) {
                                $dataforexcel_5["Sl No."]  = $ot;
                                $dataforexcel_5["Code"] = $nd_fcodes1['fee_shortcode'];
                                $dataforexcel_5["Description"] = $nd_fcodes1['description'];
                            }
                            $result_array_5[]                = $dataforexcel_5;
                            $ot++;
                        }
                        $tax = $this->print_tax_vat_excel($inst_id);
                        foreach ($totalsummary_data as $key => $value) {
                            $dataforexcel_6[""]  = $key . ":";
                            $dataforexcel_6["Cash / Cheque / Card / DBT (A)"]  = my_money_format_for_excel($value['amount']);
                            $dataforexcel_6["Transfer (with " . $tax . ")"]  = my_money_format_for_excel($value['transfer']);
                            $dataforexcel_6[$tax . " (C)"]  = my_money_format_for_excel($value['vat']);
                            $dataforexcel_6["Total (A + C)"]  = my_money_format_for_excel($value['total']);
                            $result_array_6[]                = $dataforexcel_6;
                        }

                        $dataforexcel_7["Cash"]  = my_money_format_for_excel($minisummary_data['cash']);
                        $dataforexcel_7["Cheque"]  = my_money_format_for_excel($minisummary_data['cheque']);
                        $dataforexcel_7["Card"]  = my_money_format_for_excel($minisummary_data['card']);
                        $dataforexcel_7["DBT"]  = my_money_format_for_excel($minisummary_data['dbt']);
                        $dataforexcel_7["Online"]  = my_money_format_for_excel($minisummary_data['online']);
                        $dataforexcel_7["Transfer"]  = my_money_format_for_excel($minisummary_data['transfer']);
                        $dataforexcel_7["Prospectus Fee (with service charge(if any))"]  = my_money_format_for_excel($minisummary_data['prospectus']);
                        $dataforexcel_7["Registration Fee(with service charge(if any))"]  = my_money_format_for_excel($minisummary_data['regfee']);
                        $dataforexcel_7["Gross Amount"]  = my_money_format_for_excel($minisummary_data['grossamount']);
                        $head_n = "Transfer (-) With " . $tax;
                        $dataforexcel_7["Round Off (+)"]  = my_money_format_for_excel($minisummary_data['round_off']);
                        $dataforexcel_7[$head_n]  = my_money_format_for_excel($minisummary_data['transferless']);
                        $dataforexcel_7["Payback (-)"]  = my_money_format_for_excel($minisummary_data['paybackless']);
                        $dataforexcel_7["Net Amount"]  = my_money_format_for_excel($minisummary_data['netamount']);
                        $result_array_7[]                = $dataforexcel_7;

                        foreach ($otherdetails_data as $key => $odd) {
                            $dataforexcel_8[$key] = my_money_format_for_excel($odd);
                        }
                        $result_array_8[]                = $dataforexcel_8;


                        $result_datas["Summary1"] = $result_array_6;
                        $result_datas["Summary2"] = $result_array_7;
                        $result_datas["Summary3"] = $result_array_8;
                        $result_datas["Fee Code Descriptions"] = $result_array_4;
                        $result_datas["OTHER FEE CODE DESCRIPTIONS"] = $result_array_5;

                        $this->load->helper('sheet');
                        $file_rand_name = "summary_collection_report_";
                        $filename_report = get_excel_report_dynamic($result_datas, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }
    //Voucher Cancellation Report
    public function show_voucher_cancellation_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'VOUCHER CANCELLATION REPORT';
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
            $this->load->view('report/voucher_cancellation_report', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_voucher_cancellation_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            $data_prep = array(
                'action' => 'get_voucher_cancellation_report',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            $report_data = $this->MReport->get_voucher_cancellation_report($data_prep);
            //dev_export($report_data);
            //die;
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Voucher Cancellation Details';
                    $data['bread_crumps'] = 'Fees Management > Reports > Voucher Cancellation Details';
                    $data['filename_report'] = "reports/voucher_cancellation_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/voucher_cancellation_report_pdf';
                    $data['collection_date'] = 'From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $data['details_data'] = $details_data = $report_data['data'];
                    $collection_date = date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));

                    $totcolamt = 0;
                    $result_array = [];

                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data as $rptdata) {
                            $dataforexcel["Admission No."]       = $rptdata['ADM_NO'];
                            $dataforexcel["Student Name"]  = $rptdata['STUDENT_NAME'];
                            $dataforexcel["Voucher Date"]  = date('d-m-Y', strtotime($rptdata['VOUCHER_DATE']));
                            $dataforexcel["Voucher Code"]  = $rptdata['VOUCHER_CODE'];
                            $dataforexcel["Cancel Reason"] = $rptdata['CANCEL_REASON'];
                            $dataforexcel["Amount"]        =  my_money_format_for_excel($rptdata['AMOUNT']);
                            $totcolamt                     = $totcolamt + $rptdata['AMOUNT'];
                            $result_array[]                = $dataforexcel;
                        }
                        $this->load->helper('sheet');
                        $file_rand_name = "voucher_cancellation_report_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //VAT/TAX Report
    public function show_vat_collection_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = $this->session->userdata('TAXNAME') . ' Collection Report';
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
            $this->load->view('report/vat_collection_report', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_vat_collection_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            $data_prep = array(
                'action' => 'get_vat_collection_details',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            $report_data = $this->MReport->get_vat_collection_details($data_prep);
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {

                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = $this->session->userdata('TAXNAME') . ' Collection Details';
                    $data['bread_crumps'] = 'Fees Management > Reports > ' . $this->session->userdata('TAXNAME') . 'Collection Details';
                    $data['filename_report'] = "reports/" . $this->session->userdata('TAXNAME') . "_collection_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/vat_collection_report_pdf';
                    $data['collection_date'] = 'From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $data['details_data'] = $details_data = $report_data['data'];
                    $collection_date = date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));

                    $i = 1;
                    $totcolamt = 0;
                    $totbch = 0;
                    $totcolamt = 0;
                    $result_array = [];

                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data as $rptdata) {
                            $dataforexcel["Voucher Code"]  = $rptdata['voucher_code'];
                            $dataforexcel["Voucher Date"]  = date('d-m-Y', strtotime($rptdata['voucher_date']));
                            $dataforexcel["Amount"]        =  my_money_format_for_excel($rptdata['amount']);
                            $totcolamt = $totcolamt + $rptdata['amount'];
                            $result_array[]                = $dataforexcel;
                        }
                        $total_array["Total"] = $totcolamt;
                        $this->load->helper('sheet');
                        $file_rand_name = $this->session->userdata('TAXNAME') . "_collection_report_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //EXEMPTION Report
    public function show_exemption_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Fee Exemption Report';
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
            $this->load->view('report/show_exemption_details', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_exemption_details_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $data_prep = array(
                'action'                => 'get_exemption_data_report',
                'controller_function'   => 'Fees_settings/Fee_report_controller/get_exemption_data_report',
                'from_date'             => $startdate,
                'to_date'               => $enddate,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id
            );
            $report_data = $this->MReport->get_exemption_data_report($data_prep);
            // dev_export($report_data);
            // die;
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {

                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Fee Exemption Details';
                    $data['bread_crumps'] = 'Fees Management > Reports > Exemption Deatils';
                    $data['filename_report'] = "reports/exemption_deatils_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/exemption_deatils_report_pdf';
                    $data['collection_date'] = 'Exemption Request Date From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data, 'L');
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $data['details_data'] = $details_data = $report_data['data'];
                    $collection_date = 'Exemption Request Date From : ' . date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));
                    if (isset($details_data) && !empty($details_data)) {
                        $i = 1;
                        $totcolamt = 0;
                        $totcolamt1 = 0;
                        $result_array = [];

                        foreach ($details_data as $key1 => $feedata) {
                            $dataforexcel["Student Name"] = $feedata['studentdetails']['First_Name'];
                            $dataforexcel["Admission No."] = $feedata['studentdetails']['Admn_No'];
                            $dataforexcel["Batch"]        = $feedata['studentdetails']['Batch_Name'];
                            foreach ($feedata['exemptions'] as $rptdata) {
                                $ex_pending = 0;
                                $exm_users = explode("*", $rptdata['ex_users']);
                                if (!is_array($exm_users)) $exm_users = array($exm_users);
                                $exm_status = explode("*", $rptdata['ex_status']);
                                if (!is_array($exm_status)) $exm_status = array($exm_status);

                                if ($exm_status[0] == 'N') $pending_from = 'PRINCIPAL';
                                else if ($exm_users[1] == '3' && $exm_status[1] == 'N') $pending_from = 'FD';
                                else if ($exm_users[2] == '2' && $exm_status[2] == 'N') $pending_from = 'MD';

                                if ($exm_status[0] == 'N' || $exm_status[1] == 'N' || $exm_status[2] == 'N') {
                                    $ex_pending = 1;
                                }
                                $dataforexcel["Fee Name"]        = $rptdata['fee_code_description'];
                                $dataforexcel["Month"]           = date('M-Y', strtotime($rptdata['demanded_date']));
                                $dataforexcel["Req. Date"]           = date('M-Y', strtotime($rptdata['requested_date']));
                                $dataforexcel["Req. Amount"]           = my_money_format_for_excel($rptdata['amount_applied']);
                                if ($rptdata['is_approved'] == 1) {
                                    $statuscom = 'APPROVED';
                                } elseif ($rptdata['is_rejected'] == 1) {
                                    $statuscom = 'REJECTED';
                                } else {
                                    $statuscom = 'PENDING';
                                }
                                if ($ex_pending == 1) {
                                    $statuscom1 =  '(' . $pending_from . ')';
                                }
                                $dataforexcel["Status"]           = $statuscom . $statuscom1;
                                $dataforexcel["Appr./Rej. Date"]           = (isset($rptdata['app_rej_date']) ? date('d-m-Y', strtotime($rptdata['app_rej_date'])) : '-');
                                $dataforexcel["Appr. Amount"]           = my_money_format_for_excel($rptdata['amount_approved']);
                                $i++;
                                $totcolamt = $totcolamt + $rptdata['amount_applied'];
                                $totcolamt1 = $totcolamt1 + $rptdata['amount_approved'];
                                $result_array[]               = $dataforexcel;
                            }
                        }
                        $total_array["Total Applied"] = $totcolamt;
                        $total_array["Total Approved"] = $totcolamt1;
                        $this->load->helper('sheet');
                        $file_rand_name = "fee_exemption_report_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //CONCESSION ENJOYING STUDENTS
    public function show_concession_students()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Concession Enjoying Students';
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
            $this->load->view('report/show_concession_students', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_concession_students_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $concession_type = filter_input(INPUT_POST, 'concession_type', FILTER_SANITIZE_NUMBER_INT);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            $data_prep = array(
                'action'                => 'get_concession_students_report',
                'controller_function'   => 'Fees_settings/Fee_report_controller/get_concession_students_report',
                'concession_type'       => $concession_type,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id
            );
            $report_data = $this->MReport->get_concession_students_report($data_prep);
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {

                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    if ($concession_type == 1) $title = 'Family Concession Enjoying Students';
                    else if ($concession_type == 2) $title = 'Staff Concession Enjoying Students';
                    $data['title'] = $title;
                    $data['bread_crumps'] = 'Fees Management > Reports > ' . $title;
                    $data['filename_report'] = "reports/concession_students_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/concession_students_report_pdf';
                    $data['collection_date'] =  date('d/M/Y');
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $details_data = $report_data['data'];
                    if ($concession_type == 1) $title = 'Family_concession_enjoying_students_';
                    else if ($concession_type == 2) $title = 'Staff_concession_enjoying_students_';
                    $collection_date =  date('d/M/Y');
                    $i = 1;
                    $totcolamt = 0;
                    $totcolamt1 = 0;
                    $result_array = [];

                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data as $rptdata) {
                            $dataforexcel["Admission No."] = $rptdata['Admn_No'];
                            $dataforexcel["Student Name"] = $rptdata['student_name'];
                            $dataforexcel["Class"]        = $rptdata['class_name'];
                            $dataforexcel["Batch"]        = $rptdata['Batch_Name'];
                            $dataforexcel["Priority"]     = $rptdata['Priority'];
                            $result_array[]               = $dataforexcel;
                        }
                        $this->load->helper('sheet');
                        $file_rand_name = $title;
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function show_concession_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Fee Concession Report';
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
            $this->load->view('report/show_concession_details', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_fee_concession_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $concession_type = filter_input(INPUT_POST, 'concession_type', FILTER_SANITIZE_NUMBER_INT);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            $data_prep = array(
                'action'                => 'get_fee_concession_details',
                'controller_function'   => 'Fees_settings/Fee_report_controller/get_fee_concession_details',
                'from_date'             => $startdate,
                'to_date'               => $enddate,
                'concession_type'       => $concession_type,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id
            );
            $report_data = $this->MReport->get_fee_concession_details($data_prep);
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {

                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data']['report'];
                    $data['feecode_array'] = $report_data['data']['feecode'];
                    $data['message'] = "";

                    $data['user_name'] = $this->session->userdata('user_name');
                    if ($concession_type == 1) $title = 'Family Concession Details Report';
                    else if ($concession_type == 2) $title = 'Staff Concession Details Report';
                    $data['title'] = $title;
                    $data['bread_crumps'] = 'Fees Management > Reports > ' . $title;
                    $data['filename_report'] = "reports/fee_concession_details_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/fee_concession_details_pdf';
                    $data['collection_date'] = 'From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $details_data = $report_data['data']['report'];
                    $feecode_array = $report_data['data']['feecode'];
                    $collection_date = date('d/M/Y', strtotime($startdate)) . '  To ' . date('d/M/Y', strtotime($enddate));
                    $grand_total_amount = 0;
                    // $grand_total_amount = 0;

                    $result_array_1 = [];
                    $result_array_2 = [];

                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data as $key1 => $feedata) {
                            $batch_total_amount = 0;
                            foreach ($feedata as $key2 => $classdata) {
                                $dataforexcel["Student Name"] = $classdata['student_details']['student_name'];
                                $dataforexcel["Admission No."] = $classdata['student_details']['Admn_No'];
                                $dataforexcel["Batch"]        = $key1;
                                $dataforexcel["Voucher"]      = $classdata['student_details']['voucher_code'];
                                $dataforexcel["Date"]         = date('d-m-Y', strtotime($classdata['student_details']['voucher_date']));
                                $student_total = 0;
                                foreach ($classdata['fee_details'] as $dem_date => $rpt_data) {
                                    $dataforexcel["Month"]        = date('M-Y', strtotime($dem_date));
                                    $row_total_amt = 0;
                                    foreach ($feecode_array as $kkey => $vvalue) {
                                        if (isset($rpt_data[$kkey])) $cash = $rpt_data[$kkey];
                                        else $cash = 0;
                                        $row_total_amt = $row_total_amt + $cash;
                                        $dataforexcel[$vvalue['shortcode']]         = my_money_format_for_excel($cash);

                                        $batch_total_amount += $row_total_amt;
                                        $student_total += $row_total_amt;
                                    }

                                    $dataforexcel["Total"]         = my_money_format_for_excel($student_total);
                                    $grand_total_amount += $row_total_amt;
                                    $result_array_1[]               = $dataforexcel;
                                }
                            }
                        }
                        $total_array["Report"]["Grand Total"] = my_money_format_for_excel($grand_total_amount);
                        $ot = 1;
                        foreach ($feecode_array as $key => $value) {
                            $dataforexcel_2["Sl No."]  = $ot;
                            $dataforexcel_2["Code"] = $value['shortcode'];
                            $dataforexcel_2["Description"] = $value['description'];

                            $result_array_2[]                = $dataforexcel_2;
                            $ot++;
                        }

                        $result_datas["Report"] = $result_array_1;
                        $result_datas["Fee Code Descriptions"] = $result_array_2;
                        $this->load->helper('sheet');
                        if ($concession_type == 1) $title = 'Family_concession_details_report_';
                        else if ($concession_type == 2) $title = 'Staff_concession_details_report_';
                        $file_rand_name = $title;
                        $filename_report = get_excel_report_dynamic($result_datas, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //Received non demanded fees report preloader
    public function show_non_demandables_received()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Received Non Demandable Report';
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
            $this->load->view('report/received_non_demandable', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    //Received non demanded fees report generator
    public function get_received_non_demandables_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT);
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT); //Excel (2) or Pdf (1)
            $data_prep = array(
                'action' => 'get-received-non-demandable-report',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            $report_data = $this->MReport->get_received_non_demandable_report_data($data_prep);
            //dev_export($report_data); die;

            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Received Non Demandable Fee';
                    $data['bread_crumps'] = 'Fees Management > Reports > Received Non Demandable Fee';
                    $data['filename_report'] = "reports/received_no_demandable_fee_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/received_non_demandable_pdf';
                    $data['collection_date'] = 'From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $result_array = array();
                    $data['details_data'] = $details_data = $report_data['data'];
                    $data['collection_date'] = $collection_date = date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));
                    $i = 1;
                    $totcolamt = 0;
                    $totvatamt = 0;
                    $tax = $this->print_tax_vat_excel($inst_id);
                    foreach ($details_data as $rpt_data) {
                        $dataforexcel["Admission No."] = $rpt_data['Admn_No'];
                        $dataforexcel["Student Name"]  = $rpt_data['First_Name'];
                        $dataforexcel["Voucher Code"]  = $rpt_data['voucher_code'];
                        $dataforexcel["Voucher Date"]  = date('d-m-Y', strtotime($rpt_data['voucher_date']));
                        $dataforexcel["Description"]   = $rpt_data['feeCode'];
                        $dataforexcel["Amount"]        = my_money_format_for_excel($rpt_data['amt_paid']);
                        $dataforexcel[$tax]            = ($rpt_data['vat_amt'] > 0) ? my_money_format_for_excel($rpt_data['vat_amt']) : my_money_format_for_excel(0);
                        $totcolamt += $rpt_data['amt_paid'];
                        $totvatamt += $rpt_data['vat_amt'];
                        $result_array[] = $dataforexcel;
                    }
                    $head = "Fee Total without " . $tax;
                    $total_array[$head] = my_money_format_for_excel($totcolamt);
                    $total_array["TAX Collected"]         = my_money_format_for_excel($totvatamt);
                    $total_array["Grand Total"]           = my_money_format_for_excel(($totcolamt + $totvatamt));
                    $this->load->helper('sheet');
                    $file_rand_name = "RECEIVED_NON_DEMANDABLE_REPORT_";
                    $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                    echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    function print_tax_vat_excel($inst_id = "")
    {
        // $CI = get_instance();
        // echo $CI->session->userdata('TAXNAME');
        $indian_array = ['5', '8', '20'];
        if (in_array($inst_id, $indian_array)) return 'Tax';
        else return 'Vat';
    }

    //INDIVIDUAL COLLECTION REPORT
    public function show_individual_collection_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Individual collection report';

            //STREAM DATA
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

            //CLASS DATA
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
            //ACD YEAR DATA
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

            //BATCH DATA
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
            $this->load->view('report/individual_collection/individual_collection_report', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function search_byname_individual_collection()
    {   //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            $data_prep['searchtype'] = filter_input(INPUT_POST, 'searchtype', FILTER_SANITIZE_NUMBER_INT);
            $details_data = $this->MReport->student_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['user_name'] = $this->session->userdata('user_name');
            echo json_encode(array('status' => 1, 'view' => $this->load->view('report/individual_collection/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function advancesearch_byname_individual_collection()
    {  //display students list on search
        $data['title'] = 'STUDENTS LIST';
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $data_prep['searchtype'] = filter_input(INPUT_POST, 'searchtype', FILTER_SANITIZE_NUMBER_INT);
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
            $details_data = $this->MReport->studentadvance_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            echo json_encode(array('status' => 1, 'view' => $this->load->view('report/individual_collection/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function batchlist_individual_collection()
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
    //Individual collection pdf report generator
    public function get_individual_collection_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $include_transfer = filter_input(INPUT_POST, 'include_transfer');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            $data_prep = array(
                'action' => 'get-individual-collectio-voucher-wise-report',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'student_id' => $student_id,
                'include_transfer' => $include_transfer
            );
            $report_data = $this->MReport->get_individual_collection_report_data($data_prep);
            // dev_export($report_data);
            // die;
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (!empty($report_data['data']) || !empty($report_data['ncr_data'])) {
                if ($rpt_type == 1) {
                    if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) {
                        $data['details_data'] = $report_data['data'];
                        $data['details_ncr_data'] = $report_data['ncr_data'];
                        $data['ncr_chq_amount'] = $report_data['ncr_chq'];
                        $data['transfer_amount'] = $report_data['transfer_amount'];
                        $data['wallet_deposit_tr'] = $report_data['wallet_deposit_tr'];
                        $data['servicecharge'] = $report_data['servicecharge'];
                        $data['roundoff'] = $report_data['roundoff'];
                        $data['message'] = "";
                        $data['user_name'] = $this->session->userdata('user_name');
                        $data['title'] = 'Individual Collection Report';
                        $data['bread_crumps'] = 'Fees Management > Reports > Individual Collection Report';
                        if ($include_transfer == 1)
                            $data['filename_report'] = "reports/individual_collection_report_with_transfer_" . $inst_id . "_" . $user_id . ".pdf";
                        else
                            $data['filename_report'] = "reports/individual_collection_report_" . $inst_id . "_" . $user_id . ".pdf";
                        $data['viewname'] = 'report/pdf/individual_collection_report_pdf';
                        $data['collection_date'] = 'Collection From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                        $filename = $this->get_pdf_report($data);
                        //dev_export($data);
                        //die;
                        //echo $filename;
                        echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                } else {
                    if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1) {
                        $data['details_data'] = $details_data = $report_data['data'];
                        $data['collection_date'] = $collection_date = date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));
                        $details_ncr_data = $report_data['ncr_data'];
                        $ncr_chq_amount = $report_data['ncr_chq'];
                        $transfer_amount = $report_data['transfer_amount'];
                        $wallet_deposit_tr = $report_data['wallet_deposit_tr'];
                        $servicecharge = $report_data['servicecharge'];
                        $roundoff = $report_data['roundoff'];
                        $totcolamt = 0;
                        $paidback_amt = 0;
                        $sconcession_amt = 0;
                        $fconcession_amt = 0;
                        $exemption_amt = 0;
                        $scholarship_amt = 0;
                        $totcolamt2 = 0;

                        $result_array_1 = [];
                        $result_array_2 = [];
                        foreach ($details_data as $vdate => $rptdata_a) {
                            //$totcolamt = 0;
                            foreach ($rptdata_a as $rpt_data) {
                                if (($rpt_data['display'] == 1)) {
                                    if ($rpt_data['payment_mode_id'] == 5 && $rpt_data['is_others'] == 1 && $rpt_data['specify_others'] == 'FC') {
                                        $conc_str = 'Family Concession - ';
                                        $fconcession_amt += $rpt_data['voucher_amount'];
                                    } else if ($rpt_data['payment_mode_id'] == 5 && $rpt_data['is_others'] == 1 && $rpt_data['specify_others'] == 'SC') {
                                        $conc_str = 'Staff Concession - ';
                                        $sconcession_amt += $rpt_data['voucher_amount'];
                                    } else if ($rpt_data['payment_mode_id'] == 5 && $rpt_data['is_others'] == 1 && $rpt_data['specify_others'] == '') {
                                        $conc_str = 'Exemption - ';
                                        $exemption_amt += $rpt_data['voucher_amount'];
                                    } else $conc_str = '';
                                    $dataforexcel["Admission No."] = $rpt_data['Admn_No'];
                                    $dataforexcel["Student Name"]  = $rpt_data['First_Name'];
                                    $dataforexcel["Batch Name"]    = $rpt_data['Batch_Name'];
                                    $dataforexcel["Voucher Code"]  = $rpt_data['voucher_code'];
                                    $dataforexcel["Voucher Date"]  = date('d-m-Y', strtotime($vdate));
                                    $dataforexcel["Demand Date"]   = date('M/Y', strtotime($rpt_data['demand_date']));
                                    $dataforexcel["Description"]   = $conc_str . $rpt_data['description'];
                                    $dataforexcel["Type"]          = $rpt_data['tran_type'];
                                    $dataforexcel["Collection"]    = ($rpt_data['is_wallet_withdrawal'] != 1) ? my_money_format_for_excel($rpt_data['voucher_amount']) : my_money_format_for_excel(0);
                                    $dataforexcel["payback"]       = ($rpt_data['is_wallet_withdrawal'] == 1) ? my_money_format_for_excel($rpt_data['voucher_amount']) : my_money_format_for_excel(0);
                                    $result_array_1[]                = $dataforexcel;
                                    if ($rpt_data['is_wallet_withdrawal'] != 1)
                                        $totcolamt = $totcolamt + $rpt_data['voucher_amount'];
                                }
                                if ($rpt_data['is_wallet_withdrawal'] == 1 && $rpt_data['is_payback_credit'] == 1) { // pay back
                                    $paidback_amt += $rpt_data['voucher_amount'];
                                }
                                if ($rpt_data['is_wallet_withdrawal'] == 1 && $rpt_data['is_payback_credit'] == 0) { // Wallet withdrawal
                                    $paidback_amt += $rpt_data['voucher_amount'];
                                }
                            }
                        }
                        $gross_amount = $totcolamt;
                        $less_transfer = $transfer_amount;
                        $result_datas["Report"] = $result_array_1;

                        $total_array["Report"]["Gross Collection Amount"] = my_money_format_for_excel($gross_amount);
                        $total_array["Report"]["Service Charge"] = my_money_format_for_excel($servicecharge);
                        $total_array["Report"]["Round Off"] = my_money_format_for_excel($roundoff);
                        $total_array["Report"]["Transfer Amount (-)"] = my_money_format_for_excel($less_transfer);
                        $total_array["Report"]["Concession / Exemption (-)"] = my_money_format_for_excel($con_exm_amt = $fconcession_amt + $sconcession_amt + $exemption_amt);
                        $schval = "Scholarship Collected : ";
                        $nraval = "Not Reconciled Amount : ";
                        $total_array["Report"][$schval] = my_money_format_for_excel($scholarship_amt);
                        $total_array["Report"][$nraval] = my_money_format_for_excel($ncr_chq_amount);
                        $total_array["Report"]["Paidback Amount(-)"] = my_money_format_for_excel($paidback_amt);
                        $total_array["Report"]["Net Total Amount"] = my_money_format_for_excel(($gross_amount + $servicecharge + $roundoff) - $paidback_amt - $less_transfer - $con_exm_amt);


                        if (isset($details_ncr_data)) {
                            foreach ($details_ncr_data as $vdate => $rptdata_a_ncr) {
                                $totcolamt2 = 0;
                                foreach ($rptdata_a_ncr as $rptdata_ncr) {
                                    if (($rpt_data['display'] == 1)) {
                                        $dataforexcel1["Voucher Date"]  = date('d-m-Y', strtotime($vdate));
                                        $dataforexcel1["Voucher Code"]  = $rptdata_ncr['voucher_code'];
                                        $dataforexcel1["Demand Date"]   = date('M/Y', strtotime($rptdata_ncr['demand_date']));
                                        $dataforexcel1["Description"]   = $rptdata_ncr['description'];
                                        $dataforexcel1["Collection"]    = my_money_format_for_excel($rptdata_ncr['voucher_amount']);
                                        $result_array_2[]              = $dataforexcel1;
                                        $totcolamt2                    = $totcolamt2 + $rptdata_ncr['voucher_amount'];
                                    }
                                }
                            }
                        }
                        $result_datas["NRC"] = $result_array_2;
                        $total_array["NRC"]["Total"] = my_money_format_for_excel($totcolamt2);




                        $this->load->helper('sheet');
                        if ($include_transfer == 1)
                            $file_rand_name = "individual_collection_report_with_transfer_";
                        else
                            $file_rand_name = "individual_collection_report_";

                        //  $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        $filename_report = get_excel_report_dynamic($result_datas, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //COLLECTION CLASSWISE SUMMARY REPORT
    public function show_collection_class_wise_summary()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Collection class wise summary';
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
            $this->load->view('report/collection_class_wise_report', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_collection_class_wise_summary()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $include_transfer = filter_input(INPUT_POST, 'include_transfer');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            $data_prep = array(
                'action' => 'get-collection-class-wise-summary-report-data',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'include_transfer' => $include_transfer
            );
            $report_data = $this->MReport->get_collection_class_wise_report_data($data_prep);
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['fee_code_data'] = $report_data['fee_code_data'];
                    $data['nd_details_data'] = $report_data['nd_data'];
                    $data['nd_fee_code_data'] = $report_data['nd_fee_code_data'];
                    $data['common_data'] = $report_data['common_data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Collection Class Wise Summary Report';
                    $data['bread_crumps'] = 'Fees Management > Reports > Collection Class Wise Summary Report';
                    if ($include_transfer == 1)
                        $data['filename_report'] = "reports/collection_class_wise_report_include_transfer_" . $inst_id . "_" . $user_id . ".pdf";
                    else
                        $data['filename_report'] = "reports/collection_class_wise_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/collection_class_wise_report_pdf';
                    $data['include_transfer'] = $include_transfer;
                    $data['collection_date'] = 'Collection From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data, 'L');
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $data['details_data']       = $details_data =  $report_data['data'];
                    $data['fee_code_data']      = $feecodedata =  $report_data['fee_code_data'];
                    $data['nd_details_data']    = $nd_details_data = $report_data['nd_data'];
                    $data['nd_fee_code_data']   = $nd_fee_code_data = $report_data['nd_fee_code_data'];
                    $data['common_data']        = $common_data = $report_data['common_data'];
                    $data['collection_date']    = $collection_date = 'Collection From : ' . date('d/M/Y', strtotime($startdate)) . '  To ' . date('d/M/Y', strtotime($enddate));

                    $result_array_1 = [];
                    $result_array_3 = [];
                    $result_array_4 = [];
                    $result_array_5 = [];

                    if (isset($details_data) && !empty($details_data)) {
                        $grand_class_total = 0;
                        foreach ($details_data as $classname => $report_class) {
                            $class_total = 0;
                            foreach ($report_class as $batch_key => $report_batch) {
                                $batch_total_amount = 0;
                                foreach ($report_batch as $batch_date_key => $report_date) {
                                    $dataforexcel["Class"]    = $classname;
                                    $dataforexcel["Batch"]     = $batch_key;
                                    $total_row_amount = 0;
                                    foreach ($feecodedata as $fcodes) {
                                        if (isset($report_date[$fcodes['feeCode']])) {
                                            $amt = $report_date[$fcodes['feeCode']];
                                        } else {
                                            $amt = 0;
                                        }
                                        $total_row_amount += $amt;
                                        $dataforexcel[$fcodes['fee_shortcode']]    = my_money_format_for_excel($amt);
                                    }
                                    $dataforexcel["Total"]     = $total_row_amount;
                                    $result_array_1[] = $dataforexcel;
                                    $batch_total_amount += $total_row_amount;
                                }
                                $class_total += $batch_total_amount;
                            }
                            $grand_class_total += $class_total;
                        }
                    }

                    $result_datas["Report"] = $result_array_1;
                    /* FOR Total Amount For Excel */
                    if ($include_transfer == 1) $transfer_total_amount = $common_data['transfer_total'];
                    else $transfer_total_amount = 0;
                    $total_array["Report"]["All Class Total"]        = $grand_class_total;
                    $total_array["Report"]["Transfer Amount (-)"]    = $transfer_total_amount;
                    $total_array["Report"]["Service Charge"]         = my_money_format_for_excel(($common_data['service_charge']));
                    $total_array["Report"]["Round off"]              = my_money_format_for_excel(($common_data['round_off']));
                    $total_array["Report"]["Paid Back (-)"]          = my_money_format_for_excel(($common_data['payback_amount']));
                    $total_array["Report"]["Grand Total"]            = my_money_format_for_excel(($grand_class_total - $transfer_total_amount) + ($common_data['service_charge'] + $common_data['round_off']) - ($common_data['payback_amount']));


                    $nd_feecodedata = $nd_fee_code_data;
                    $i = 1;
                    $totcolamt = 0;
                    $grand_class_total = 0;
                    $transfer_total_amount = 0;
                    $total_row_amount = 0;
                    if (isset($nd_details_data) && !empty($nd_details_data)) {
                        foreach ($nd_details_data as $classname => $report_class) {
                            $class_total = 0;
                            $dataforexcel_3["Class Name"]    = $classname;
                            foreach ($report_class as $batch_key => $report_batch) {
                                $batch_total_amount = 0;
                                foreach ($report_batch as $batch_date_key => $report_date) {
                                    $dataforexcel_3["Batch"]     = $batch_key;
                                    $dataforexcel_3["DATE"]          = date('d-m-Y', strtotime($batch_date_key));

                                    foreach ($nd_feecodedata as $fcodes) {
                                        if (($fcodes['feeCode'] != 'F023' && $fcodes['feeCode'] != 'F101')) {
                                            if (isset($report_date[$fcodes['feeCode']])) {
                                                $amt = $report_date[$fcodes['feeCode']];
                                            } else {
                                                $amt = 0;
                                            }
                                            $total_row_amount += $amt;
                                            $dataforexcel_3[$fcodes['fee_shortcode']] = my_money_format_for_excel($amt);
                                        }
                                    }
                                    $result_array_3[]                = $dataforexcel_3;
                                }
                            }
                        }
                        $result_datas["Others"] = $result_array_3;
                        $total_array["Others"]["Grand Total"]            = my_money_format_for_excel($total_row_amount);
                    }


                    $ft = 1;
                    foreach ($feecodedata as $fcodes_hearder1) {
                        $dataforexcel_4["Sl No."]  = $ft;
                        $dataforexcel_4["Code"]  = $fcodes_hearder1['fee_shortcode'];
                        $dataforexcel_4["Description"]  = $fcodes_hearder1['description'];
                        $result_array_4[]  = $dataforexcel_4;
                        $ft++;
                    }
                    $ot = 1;
                    foreach ($nd_feecodedata as $fcodes) {
                        if (($fcodes['feeCode'] != 'F023' && $fcodes['feeCode'] != 'F101') && $fcodes['editable'] == 1) {
                            $dataforexcel_5["Sl No."]  = $ot;
                            $dataforexcel_5["Code"] = $fcodes['fee_shortcode'];
                            $dataforexcel_5["Description"] = $fcodes['description'];
                        }
                        $result_array_5[]                = $dataforexcel_5;
                        $ot++;
                    }


                    //  $result_datas["Details"]=$result_array_2; 

                    $result_datas["Fee Code Descriptions"] = $result_array_4;
                    $result_datas["OTHER FEE CODE DESCRIPTIONS"] = $result_array_5;
                    $this->load->helper('sheet');
                    if ($include_transfer == 1)
                        $file_rand_name = "collection_class_wise_summary_report_include_transfer_";
                    else
                        $file_rand_name = "collection_class_wise_summary_report_";
                    //  print_r($result_array);exit;
                    $filename_report = get_excel_report_dynamic($result_datas, $file_rand_name, $collection_date, $total_array);
                    echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //COLLECTION CLASSWISE DETAILS REPORT
    public function show_collection_class_wise_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Collection Batch wise details';
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
            $this->load->view('report/collection_class_wise_report_details', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_collection_class_wise_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $data_prep = array(
                'action' => 'get-collection-class-wise-details-report-data',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            $report_data = $this->MReport->get_collection_class_wise_report_data_details($data_prep);
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {

                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['fee_code_data'] = $report_data['fee_code_data'];
                    $data['nd_details_data'] = $report_data['nd_data'];
                    $data['nd_fee_code_data'] = $report_data['nd_fee_code_data'];
                    $data['common_data'] = $report_data['common_data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Collection Batch Wise Details';
                    $data['bread_crumps'] = 'Fees Management > Reports > Collection Batch Wise Details Report';
                    $data['filename_report'] = "reports/collection_batch_wise_details_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/collection_batch_wise_details_pdf';
                    $data['collection_date'] = 'Collection From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data, 'L');
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $data['details_data'] = $details_data = $report_data['data'];
                    $data['fee_code_data'] = $feecodedata = $report_data['fee_code_data'];
                    $data['nd_details_data'] = $nd_details_data = $report_data['nd_data'];
                    $data['nd_fee_code_data'] = $nd_fee_code_data = $report_data['nd_fee_code_data'];
                    $data['common_data'] = $common_data = $report_data['common_data'];
                    $data['collection_date'] = $collection_date =  date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));
                    $classtotal = 0;

                    $result_array_1 = [];
                    $result_array_2 = [];
                    $result_array_4 = [];
                    $result_array_5 = [];

                    foreach ($details_data as $batch_key => $report_batch) {
                        $batch_total = 0;
                        $dataforexcel["Batch"]         = $batch_key;
                        foreach ($report_batch as $admn_key => $report_student) {
                            $dataforexcel["Admission No."] = $report_student['student_data']['Admn_no'];
                            $dataforexcel["Student Name"]  = $report_student['student_data']['Student_name'];
                            $stud_total = 0;
                            foreach ($report_student['voucher_details'] as $rpt_demdate) {
                                foreach ($rpt_demdate as $rpt_voucher) {
                                    $dataforexcel["MONTH"]         = date('M-Y', strtotime($rpt_voucher['demand_date']));
                                    $dataforexcel["DATE"]          = date('d-m-Y', strtotime($rpt_voucher['voucher_date']));
                                    $dataforexcel["VOUCHER"]       = $rpt_voucher['voucher_code'];
                                    $dm_date_fcode_total = 0;
                                    foreach ($feecodedata as $fcodes) {
                                        if ($fcodes['fee_shortcode'] != 'BCH' && $fcodes['fee_shortcode'] != 'RND') {
                                            if (isset($rpt_voucher['fee_details'][$fcodes['feeCode']])) {
                                                $amt = $rpt_voucher['fee_details'][$fcodes['feeCode']];
                                            } else {
                                                $amt = 0;
                                            }
                                            if ($fcodes['feeCode'] == 'F103' && (isset($rpt_voucher['vat_paid']) && $rpt_voucher['vat_paid'] > 0)) {
                                                $amt += $rpt_voucher['vat_paid'];
                                            }
                                            if ($fcodes['feeCode'] == 'F104' && (isset($rpt_voucher['penalty_paid']) && $rpt_voucher['penalty_paid'] > 0)) {
                                                $amt += $rpt_voucher['penalty_paid'];
                                            }
                                            $dataforexcel[$fcodes['fee_shortcode']] = my_money_format_for_excel($amt);
                                            $dm_date_fcode_total = $dm_date_fcode_total + $amt;
                                        }
                                    }
                                    $stud_total                 += $dm_date_fcode_total;
                                    $dataforexcel["TOTAL"]       = my_money_format_for_excel($dm_date_fcode_total);
                                    $result_array_1[]              = $dataforexcel;
                                }
                            }
                            $batch_total += $stud_total;
                        }
                        $classtotal += $batch_total;
                    }
                    $result_datas["Report"] = $result_array_1;
                    //  $total_array["Report"]["Batch Total"]            = my_money_format_for_excel($batch_total);
                    $total_array["Report"]["Service Charge"]         = my_money_format_for_excel(($common_data['service_charge']));
                    $total_array["Report"]["Round off"]              = my_money_format_for_excel(($common_data['round_off']));
                    $total_array["Report"]["Net Amount"]             = my_money_format_for_excel($classtotal + ($common_data['service_charge'] + $common_data['round_off']));
                    $total_array["Report"]["Transfer Amount (-)"]    = my_money_format_for_excel($common_data['transfer_amount']);
                    $total_array["Report"]["Paid Back (-)"]          = my_money_format_for_excel(($common_data['payback_amount']));
                    $total_array["Report"]["Grand Total"]            = my_money_format_for_excel(($classtotal + ($common_data['service_charge'] + $common_data['round_off']) - $common_data['transfer_amount'])  - ($common_data['payback_amount']));

                    $nd_feecodedata = $nd_fee_code_data;
                    $i = 1;
                    $totcolamt = 0;
                    $transfer_amount = 0;
                    $classtotal = 0;
                    if (isset($nd_details_data) && !empty($nd_details_data)) {
                        foreach ($nd_details_data as $batch_key => $report_batch) {
                            $batch_total = 0;
                            foreach ($report_batch as $admn_key => $report_student) {
                                $stud_total = 0;
                                foreach ($report_student['voucher_details'] as $rpt_demdate) {
                                    foreach ($rpt_demdate as $rpt_voucher) {
                                        $dataforexcel_2["Batch"] = $batch_key;
                                        $dataforexcel_2["Admission No."] = $report_student['student_data']['Admn_no'];
                                        $dataforexcel_2["Student Name"] = $report_student['student_data']['Student_name'];
                                        $voucher_code = $rpt_voucher['voucher_code'];
                                        $voucher_date = $rpt_voucher['voucher_date'];
                                        $dm_date_fcode_total = 0;

                                        $dataforexcel_2["MONTH"] = date('M-Y', strtotime($rpt_voucher['demand_date']));
                                        $dataforexcel_2["DATE"] =  $voucher_date;
                                        $dataforexcel_2["VOUCHER"] = $voucher_code;
                                        foreach ($nd_feecodedata as $fcodes) {
                                            if (($fcodes['feeCode'] != 'F023' && $fcodes['feeCode'] != 'F101')) {
                                                if (isset($rpt_voucher['fee_details'][$fcodes['feeCode']])) {
                                                    $amt = $rpt_voucher['fee_details'][$fcodes['feeCode']];
                                                    $dm_date_fcode_total = $dm_date_fcode_total + $amt;
                                                } else {
                                                    $amt = 0;
                                                }
                                                $dataforexcel_2[$fcodes['fee_shortcode']] =     my_money_format_for_excel($amt);
                                            }
                                        }
                                        $dataforexcel_2["Total"] =  my_money_format_for_excel($dm_date_fcode_total);
                                        $result_array_2[] = $dataforexcel_2;
                                        $stud_total += $dm_date_fcode_total;
                                    }
                                }
                                $batch_total += $stud_total;
                            }
                            $classtotal += $batch_total;
                        }
                        $result_datas["Others"] = $result_array_2;


                        // $total_array["Others"]["Batch Total"]            = my_money_format_for_excel($batch_total);
                        $total_array["Others"]["GRAND TOTAL"]            = my_money_format_for_excel($classtotal);
                    }
                    $ft = 1;
                    foreach ($feecodedata as $fcodes_hearder1) {
                        $dataforexcel_4["Sl No."]  = $ft;
                        $dataforexcel_4["Code"]  = $fcodes_hearder1['fee_shortcode'];
                        $dataforexcel_4["Description"]  = $fcodes_hearder1['description'];
                        $result_array_4[]  = $dataforexcel_4;
                        $ft++;
                    }
                    $ot = 1;
                    foreach ($nd_feecodedata as $fcodes) {
                        if (($fcodes['feeCode'] != 'F023' && $fcodes['feeCode'] != 'F101') && $fcodes['editable'] == 1) {
                            $dataforexcel_5["Sl No."]  = $ot;
                            $dataforexcel_5["Code"] = $fcodes['fee_shortcode'];
                            $dataforexcel_5["Description"] = $fcodes['description'];
                        }
                        $result_array_5[]                = $dataforexcel_5;
                        $ot++;
                    }

                    //$result_datas["Details"]=$result_array_2; 

                    $result_datas["Fee Code Descriptions"] = $result_array_4;
                    $result_datas["OTHER FEE CODE DESCRIPTIONS"] = $result_array_5;
                    $this->load->helper('sheet');
                    $file_rand_name = "Collection_Batch_Wise_Details_";
                    $filename_report = get_excel_report_dynamic($result_datas, $file_rand_name, $collection_date, $total_array);
                    echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //COLLECTION USERWISE DETAILS REPORT
    public function show_user_collection_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'User collection report';
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
            $this->load->view('report/user_wise_collection_details', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_user_collection_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);

            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $user_id = $this->session->userdata('userid');
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $data_prep = array(
                'action' => 'get-collection-user-wise-details-report-data',
                'from_date' => $startdate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'user_id' => $user_id
            );
            $report_data = $this->MReport->get_collection_user_wise_report_data_details($data_prep);
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['pay_modes'] =  $report_data['pay_modes'];
                    $data['startdate'] =  $startdate;
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'User Collection report';
                    $data['bread_crumps'] = 'Fees Management > Reports > User Collection report';
                    $data['filename_report'] = "reports/user_collection_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/user_wise_collection_details_pdf';
                    $data['collection_date'] = 'Collection on : ' . date('d/M/Y', strtotime($startdate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $result_array = array();
                    $data['details_data'] = $details_data = $report_data['data'];
                    $data['message'] = "";
                    $data['pay_modes'] = $pay_modes = $report_data['pay_modes'];
                    $data['startdate'] =  $startdate;
                    $collection_date = 'Collection on : ' . date('d/M/Y', strtotime($startdate));
                    $totcolamt = 0;
                    $surcharge = 0;
                    $round_off_amount = 0;
                    if (isset($details_data) && !empty($details_data) && !empty($details_data['collection'])) {
                        foreach ($details_data['collection'] as $emp_name => $rpt_data) {
                            $total = 0;
                            $dataforexcel["Employee"]       = $emp_name;
                            $i = 0;
                            foreach ($rpt_data as $type_key => $trans_amt) {
                                $dataforexcel[$pay_modes[$i]["payment_type_name"]] =  my_money_format_for_excel($trans_amt['transaction_amt']);
                                $total = $total + $trans_amt['transaction_amt'];
                                $surcharge = $surcharge + $trans_amt['service_charge'];
                                $round_off_amount = $round_off_amount + $trans_amt['round_off_amount'];
                                $i++;
                            }
                            $dataforexcel["Total"]       = my_money_format_for_excel(($total));
                            $totcolamt = $totcolamt + $total;
                            $result_array[]                = $dataforexcel;
                        }
                        //    print_r($result_array);exit;
                        // }
                        $not_recon_amount = $details_data['common']['not_recon_amount'];
                        $transfer_amount = $details_data['common']['transfer_amount'];
                        $payback_amount = $details_data['common']['payback_amount'];

                        $total_array["Total"] = my_money_format_for_excel($totcolamt);
                        $total_array["Service Charge"] = my_money_format_for_excel($surcharge);
                        $total_array["Round Off"] = my_money_format_for_excel($round_off_amount);
                        $total_array["Transfer Amount (-)"] = my_money_format_for_excel($transfer_amount);
                        $total_array["Payback Amount (-)"] = my_money_format_for_excel($payback_amount);
                        $total_array["Amount Subjected For Realization"] = my_money_format_for_excel($not_recon_amount);
                        $total_array["Grand Total"] = my_money_format_for_excel((($surcharge + $round_off_amount + ($totcolamt  - $transfer_amount - $payback_amount))));
                        $this->load->helper('sheet');
                        $file_rand_name = "user_collection_report_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //CHEQUE RECEIVED LEDGER
    public function show_cheque_received_ledger()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Cheque Received Ledger';
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
            $this->load->view('report/cheque_received_ledger', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_cheque_received_ledger()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $data_prep = array(
                'action' => 'get-cheque-ledger-details',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            $report_data = $this->MReport->get_collection_class_wise_report_data_details($data_prep);
            // dev_export($report_data);
            // die;
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {

                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Cheque Received Ledger';
                    $data['bread_crumps'] = 'Fees Management > Reports > Cheque Received Ledger';
                    $data['filename_report'] = "reports/cheque_received_ledger_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/cheque_received_ledger_pdf';
                    $data['collection_date'] = 'Cheque Received Date From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {

                    $data['details_data'] = $details_data = $report_data['data'];
                    $collection_date = 'Cheque Received Date From : ' . date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));
                    $i = 1;
                    $totcolamt = 0;
                    $recon_amount = 0;
                    $not_recon_amount = 0;
                    $bounce_amount = 0;
                    $cancelled_amount = 0;
                    $result_array = [];

                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data as $ch_date => $chqdetails) {
                            $dataforexcel["Cheque Received Date"]       = date('d-m-Y', strtotime($ch_date));
                            foreach ($chqdetails as $classname => $classdetails) {
                                foreach ($classdetails as $division => $report_details) {
                                    foreach ($report_details as $rpt_data) {
                                        if ($rpt_data['CHQ_STATUS'] == 'R') {
                                            $recon_amount += $rpt_data['voucher_total'];
                                        }
                                        if ($rpt_data['CHQ_STATUS'] == 'B') {
                                            $bounce_amount += $rpt_data['voucher_total'];
                                        }
                                        if ($rpt_data['CHQ_STATUS'] == 'NR') {
                                            $not_recon_amount += $rpt_data['voucher_total'];
                                        }
                                        if ($rpt_data['CHQ_STATUS'] == 'X') {
                                            $cancelled_amount += $rpt_data['voucher_total'];
                                        }
                                        $dataforexcel["Class"]       =  $classname . ' ' . $division;
                                        $dataforexcel["Admission No."]       = $rpt_data['Admn_No'];
                                        $dataforexcel["Student Name"]  = $rpt_data['First_Name'];
                                        $dataforexcel["Voucher"]  = $rpt_data['voucher_code'];
                                        $dataforexcel["Cheque No."]  = $rpt_data['ch_number'];
                                        $dataforexcel["Status"]  = $rpt_data['CHQ_STATUS'];
                                        $dataforexcel["Remarks"]  = $rpt_data['CHQ_REMARKS'];
                                        $dataforexcel["Amount"]        = my_money_format_for_excel($rpt_data['voucher_total']);
                                        $totcolamt = $totcolamt + $rpt_data['voucher_total'];
                                        $result_array[]                = $dataforexcel;
                                    }
                                }
                            }
                        }
                        $total_array["Reconciled Amount (R)"] = my_money_format_for_excel($recon_amount);
                        $total_array["Not Reconciled Amount (NR)"] = my_money_format_for_excel($not_recon_amount);
                        $total_array["Bounced Amount (B)"] = my_money_format_for_excel($bounce_amount);
                        $total_array["Cancelled Amount (X)"] = my_money_format_for_excel($cancelled_amount);
                        $this->load->helper('sheet');
                        $file_rand_name = "cheque_received_ledger_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //WALLET DEPOSIT REPORT
    public function show_wallet_deposit_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Docme Wallet Deposit Details';
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
            $this->load->view('report/wallet_deposit_details', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_wallet_deposit_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            $data_prep = array(
                'action' => 'get-wallet-deposit-details',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            $report_data = $this->MReport->get_wallet_deposit_details($data_prep);
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            //SALAHUDHEEN
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                $detail_array = array();
                $i = 0;
                foreach ($report_data['data'] as $rdata) {
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['Admn_No'] = $rdata['Admn_No'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['First_Name'] = $rdata['First_Name'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['voucher_number'] = $rdata['voucher_number'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['TRANSACTION_DATE'] = $rdata['TRANSACTION_DATE'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['transaction_amount'] = $rdata['transaction_amount'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['SERVICE_CHARGE'] = $rdata['SERVICE_CHARGE'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['NON_RELSD_AMT'] = $rdata['NON_RELSD_AMT'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['TOTAL_TRANSACTION_AMT'] = $rdata['TOTAL_TRANSACTION_AMT'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['trans_type'] = $rdata['trans_type'];
                }



                if ($rpt_type == 1) {
                    $data['details_data'] = $detail_array;
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Wallet Deposit Details';
                    $data['bread_crumps'] = 'Fees Management > Reports > Wallet Deposit Details';
                    $data['filename_report'] = "reports/wallet_deposit_details_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/wallet_deposit_details_pdf';
                    $data['collection_date'] = 'From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $data['details_data'] = $details_data = $detail_array;
                    $collection_date = date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));

                    $i = 1;
                    $totcolamt = 0;
                    $service_charge = 0;
                    $result_array = [];

                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data  as $classname => $rptdata) {
                            foreach ($rptdata as $batchname => $studentdata) {
                                foreach ($studentdata as $stdata) {
                                    foreach ($stdata['voucher'] as $vocherid => $vchr) {
                                        $dataforexcel["Class"]        = $classname;
                                        $dataforexcel["Batch"]        = $batchname;
                                        $dataforexcel["Student Name"] = $stdata['First_Name'];
                                        $dataforexcel["Admission No."] = $stdata['Admn_No'];
                                        $dataforexcel["Voucher"]      = $vchr['voucher_number'];
                                        $dataforexcel["Voucher Date"] = date('d-m-Y', strtotime($vchr['TRANSACTION_DATE']));
                                        $dataforexcel["Amount"]       = my_money_format_for_excel($vchr['transaction_amount']);
                                        $result_array[]               = $dataforexcel;
                                        $service_charge += $vchr['SERVICE_CHARGE'];
                                        $totcolamt = $totcolamt + $vchr['transaction_amount'];
                                    }
                                }
                            }
                        }
                        $total_array["Total"] = $totcolamt;
                        $total_array["Service Charge Collected"] = $service_charge;
                        $this->load->helper('sheet');
                        $file_rand_name = "wallet_deposit_details_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
            //SALAHUDHEEN P A           

        } else {
            $this->load->view('template/error-500');
        }
    }

    //WALLET WITHDRAW REPORT
    public function show_wallet_withdraw_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Docme Wallet withdraw details';
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
            $this->load->view('report/wallet_withdraw_report', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_wallet_withdraw_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $data_prep = array(
                'action' => 'get-wallet-withdraw-details',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            $report_data = $this->MReport->get_wallet_withdraw_details($data_prep);
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');


            //SALAHUDHEEN
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Wallet Withdraw Details';
                    $data['bread_crumps'] = 'Fees Management > Reports > Wallet Withdraw Details';
                    $data['filename_report'] = "reports/wallet_withdraw_details_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/wallet_withdraw_details_pdf';
                    $data['collection_date'] = 'From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $data['details_data'] = $details_data = $report_data['data'];
                    $collection_date = date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));
                    $totcolamt = 0;
                    $result_array = [];

                    if (isset($details_data) && !empty($details_data)) {
                        if (isset($details_data) && !empty($details_data)) {
                            foreach ($details_data as $rptdata) {
                                $dataforexcel["Student Name"] = $rptdata['First_Name'];
                                $dataforexcel["Admission No."] = $rptdata['Admn_No'];
                                $dataforexcel["Voucher"]      = $rptdata['voucher_number'];
                                $dataforexcel["Voucher Date"] = date('d-m-Y', strtotime($rptdata['TRANSACTION_DATE']));
                                $dataforexcel["Amount"]       = my_money_format_for_excel($rptdata['transaction_amount']);
                                $result_array[]               = $dataforexcel;
                                $totcolamt = $totcolamt + $rptdata['transaction_amount'];
                            }
                        }
                        $total_array["Total"] = $totcolamt;
                        $this->load->helper('sheet');
                        $file_rand_name = "wallet_withdraw_details_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //WALLET STATEMENT REPORT
    public function show_wallet_statement_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Wallet Account Statement';
            $this->load->view('report/wallet_statement_report', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_wallet_statement_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');

            $data_prep = array(
                'action' => 'get-wallet-statement-details',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            $report_data = $this->MReport->get_wallet_statement_details($data_prep);
            // dev_export($report_data);
            // die;
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            //SALAHUDHEEN
            $w_rqst_placed = 0;
            $w_rqst_rejected = 0;
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                $detail_array = array();
                $i = 0;
                foreach ($report_data['data'] as $rdata) {
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['Admn_No'] = $rdata['Admn_No'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['First_Name'] = $rdata['First_Name'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['voucher_number'] = $rdata['voucher_number'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['TRANSACTION_DATE'] = $rdata['TRANSACTION_DATE'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['transaction_amount'] = $rdata['transaction_amount'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['SERVICE_CHARGE'] = $rdata['SERVICE_CHARGE'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['TOTAL_TRANSACTION_AMT'] = $rdata['TOTAL_TRANSACTION_AMT'];
                    $detail_array[$rdata['CUR_CLASS']][$rdata['CUR_BATCH']][$rdata['Admn_No']]['voucher'][$rdata['voucher_number']]['trans_type'] = $rdata['TRANSACT_TYPE'];
                }
                $w_rqst_placed = $report_data['data'][0]['PENDING'];
                $w_rqst_rejected = $report_data['data'][0]['REJECTED'];
                $data['w_rqst_placed'] = $w_rqst_placed;
                $data['w_rqst_rejected'] = $w_rqst_rejected;
                if ($rpt_type == 1) {
                    $data['details_data'] = $detail_array;
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Wallet statement';
                    $data['bread_crumps'] = 'Fees Management > Reports > Wallet statement';
                    $data['filename_report'] = "reports/wallet_statement_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/wallet_statement_pdf';
                    $data['collection_date'] = 'From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $details_data = $data['details_data'] = $detail_array;
                    $collection_date = date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));
                    $totcolamt = 0;
                    $service_charge = 0;
                    $wallet_deposit = 0;
                    $wallet_transfer = 0;
                    $wallet_withdrawal = 0;
                    $result_array = [];

                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data  as $classname => $rptdata) {
                            foreach ($rptdata as $batchname => $studentdata) {
                                foreach ($studentdata as $stdata) {
                                    foreach ($stdata['voucher'] as $vocherid => $vchr) {
                                        $dataforexcel["Class"]        = $classname;
                                        $dataforexcel["Batch"]        = $batchname;
                                        $dataforexcel["Student Name"] = $stdata['First_Name'];
                                        $dataforexcel["Admission No."] = $stdata['Admn_No'];
                                        $dataforexcel["Voucher"]      = $vchr['voucher_number'];
                                        $dataforexcel["Voucher Date"] = date('d-m-Y', strtotime($vchr['TRANSACTION_DATE']));
                                        $txn_type = '';
                                        if (substr($vchr['voucher_number'], 0, 3) == 'FAD') $txn_type = 'WALLET DEPOSIT';
                                        if (substr($vchr['voucher_number'], 0, 3) == 'FAP') $txn_type = 'WALLET PAYBACK';
                                        if (substr($vchr['voucher_number'], 0, 3) == 'ADJ') $txn_type = 'WALLET TRANSFER TO FEES';
                                        $dataforexcel["Transaction"] =  $txn_type;
                                        $dataforexcel["Amount"]       = my_money_format_for_excel($vchr['transaction_amount']);
                                        $result_array[]               = $dataforexcel;

                                        if ($vchr['trans_type'] == 'WALLET AMOUNT CREDIT' || $vchr['trans_type'] == 'WALLET PAYBACK CREDIT') {
                                            $wallet_deposit += ($vchr['transaction_amount']); // + $vchr['SERVICE_CHARGE']);
                                        }
                                        if ($vchr['trans_type'] == 'WALLET AMOUNT DEBIT') {
                                            $wallet_transfer += $vchr['transaction_amount'];
                                        }
                                        if ($vchr['trans_type'] == 'WALLET AMOUNT WITHDRAWAL AUTHORIZED') {
                                            $wallet_withdrawal += $vchr['transaction_amount'];
                                        }
                                        $service_charge += $vchr['SERVICE_CHARGE'];
                                    }
                                }
                            }
                        }
                        $wallet_balance = $wallet_deposit - ($wallet_transfer + $wallet_withdrawal);
                        $total_array["Wallet Deposit"] = my_money_format_for_excel($wallet_deposit);
                        $total_array["Transfer Amount"] = my_money_format_for_excel($wallet_transfer);
                        $total_array["Amount Pending"] = my_money_format_for_excel($w_rqst_placed);
                        $total_array["Wallet Payback"] = my_money_format_for_excel($wallet_withdrawal);
                        $total_array["Amount Rejected"] = my_money_format_for_excel($w_rqst_rejected);
                        $total_array["Service Charge"] = my_money_format_for_excel($service_charge);
                        $this->load->helper('sheet');
                        $file_rand_name = "wallet_statement_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //INDIVIDUAL DCB REPORT
    public function show_individual_dcb_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Individual DCB report';

            //STREAM DATA
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

            //CLASS DATA
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
            //ACD YEAR DATA
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

            //BATCH DATA
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
            $this->load->view('report/dcb/individual_dcb_report', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function search_byname_individual_dcb()
    {   //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            $data_prep['searchtype'] = filter_input(INPUT_POST, 'searchtype', FILTER_SANITIZE_NUMBER_INT);
            $details_data = $this->MReport->student_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['user_name'] = $this->session->userdata('user_name');
            echo json_encode(array('status' => 1, 'view' => $this->load->view('report/dcb/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function advancesearch_byname_individual_dcb()
    {
        $data['title'] = 'STUDENTS LIST';
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $data_prep['searchtype']    = filter_input(INPUT_POST, 'searchtype', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['batch_id']      = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['stream_id']     = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['class_id']      = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['curent_acdyr']  = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['searchname']    = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            if ($data_prep['stream_id'] == -1) {
                $data_prep['stream_id'] = '';
            }
            if ($data_prep['curent_acdyr'] == -1) {
                $data_prep['curent_acdyr'] = '';
            }
            if ($data_prep['class_id'] == -1) {
                $data_prep['class_id'] = '';
            }
            $details_data = $this->MReport->studentadvance_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            echo json_encode(array('status' => 1, 'view' => $this->load->view('report/dcb/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function batchlist_individual_dcb()
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
    public function get_individual_dcb_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $data_prep = array(
                'action' => 'get-dcb-report-student-wise',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'student_id' => $student_id
            );
            $report_data = $this->MReport->get_individual_dcb_report_data($data_prep);
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {

                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Individual DCB Report';
                    $data['bread_crumps'] = 'Fees Management > Reports > Individual DCB Report';
                    $data['filename_report'] = "reports/individual_dcb_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/individual_dcb_report_pdf';
                    $data['collection_date'] = '';
                    $filename = $this->get_pdf_report($data, 'L');
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $data['details_data'] = $details_data = $report_data['data'];
                    $data['message'] = "";
                    $collection_date = '';
                    $result_array = [];

                    foreach ($details_data['report_data'] as $month => $report_lvl1) {
                        $student_status = '';
                        if (trim($details_data['student_data']['StatusFlag']) == 'L') $student_status = 'Long Absentee';
                        elseif (trim($details_data['student_data']['StatusFlag']) == 'O') $student_status = 'Official';
                        elseif (trim($details_data['student_data']['StatusFlag']) == 'T') $student_status = 'TC Issued';
                        foreach ($report_lvl1['feecode'] as $fdata) {
                            $dataforexcel["Student Name"]           =   $details_data['student_data']['student_name'];
                            $dataforexcel["Student Status"]         =   $student_status;
                            $dataforexcel["Admission Number"]       =   $details_data['student_data']['Admn_No'];
                            $dataforexcel["Batch"]                  =   $details_data['student_data']['batch_name'];
                            $dataforexcel["Date"]                   =   date("d-m-Y");
                            $dataforexcel["Month"]                  =   date('M Y', strtotime($month));
                            $dataforexcel["Fee Details"]            =   $fdata['feecode_desc'];
                            $dataforexcel["Demanded Fees"]          =   my_money_format_for_excel($fdata['demand']);
                            $dataforexcel["Adjustments-Concession"] =   my_money_format_for_excel($fdata['concession']);
                            $dataforexcel["Adjustments-Exemption"]  =   my_money_format_for_excel($fdata['excemption']);
                            $dataforexcel["Net Due"]                =   my_money_format_for_excel($fdata['net_due']);
                            $dataforexcel["Receipts-Advance"]       =   my_money_format_for_excel($fdata['advance']);
                            $dataforexcel["Receipts-Regular"]       =   my_money_format_for_excel($fdata['regular']);
                            $dataforexcel["Balance"]                =   my_money_format_for_excel($fdata['balance']);
                            $dataforexcel["Arrear"]                 =   my_money_format_for_excel($fdata['arrear']);
                            $dataforexcel["Remarks"]                =   "";
                            $result_array[] = $dataforexcel;
                        }
                    }
                    $total_array["Demanded Fees Grand Total"]          =   my_money_format_for_excel($details_data['summary']['total_demand']);
                    $total_array["Adjustments-Concession Grand Total"] =   my_money_format_for_excel($details_data['summary']['total_concession']);
                    $total_array["Adjustments-Exemption Grand Total"]  =   my_money_format_for_excel($details_data['summary']['total_excemption']);
                    $total_array["Net Due Grand Total"]                =   my_money_format_for_excel($details_data['summary']['total_net_due']);
                    $total_array["Receipts-Advance Grand Total"]       =   my_money_format_for_excel($details_data['summary']['total_advance']);
                    $total_array["Receipts-Regular Grand Total"]       =   my_money_format_for_excel($details_data['summary']['total_regular']);
                    $total_array["Balance Grand Total"]                =   my_money_format_for_excel($details_data['summary']['total_balance']);
                    $total_array["Arrear Grand Total"]                 =   my_money_format_for_excel($details_data['summary']['total_arrear']);


                    $this->load->helper('sheet');
                    $file_rand_name = "individual_dcb_report_";
                    $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                    echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data available for this report.'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //HEADWISE COLEECTION REPORT   
    public function show_preload_headwise_collection_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Head wise Collection Report';
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
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $feecodes_available = $this->MFee_collection->get_all_feecodes_available($inst_id);
            if (isset($feecodes_available['data']) && !empty($feecodes_available['data'])) {
                $data['feecodes_available'] = $feecodes_available['data'];
            } else {
                $data['feecodes_available'] = 0;
            }
            //dev_export($data);
            //die;
            $this->load->view('report/headwise_collection', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_headwise_collection_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate      = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate        = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $feecode_id     = filter_input(INPUT_POST, 'feecode_id');
            $inst_id        = $this->session->userdata('inst_id');
            $user_id        = $this->session->userdata('userid');
            $acd_year_id    = $this->session->userdata('acd_year');
            $rpt_type       = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            $data_prep = array(
                'action'        => 'get-head-wise-collection-details',
                'from_date'     => $startdate,
                'to_date'       => $enddate,
                'feecode_id'    => $feecode_id,
                'inst_id'       => $inst_id,
                'acd_year_id'   => $acd_year_id
            );
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            $report_data = $this->MReport->get_headwise_collection_report_data($data_prep);
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['common_data'] = $report_data['common_data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Head wise Collection Report';
                    $data['bread_crumps'] = 'Fees Management > Reports > Head wise Collection Report';
                    $data['filename_report'] = "reports/headwise_collection_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/headwise_collection_report_pdf';
                    $data['collection_date'] = 'Report From : ' . date('d/M/Y', strtotime($startdate)) . ' To : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $data['details_data'] = $details_data = $report_data['data'];
                    $data['common_data'] = $common_data = $report_data['common_data'];
                    $data['collection_date'] = $collection_date = date('d/M/Y', strtotime($startdate)) . ' To ' . date('d/M/Y', strtotime($enddate));

                    $totcolamt = 0;
                    $totvatamt = 0;
                    $result_array = [];

                    foreach ($details_data as $key1 => $feedata) {
                        foreach ($feedata as $key2 => $classdata) {
                            foreach ($classdata as $key3 => $collectiondata) {
                                if (is_array($collectiondata) && !empty($collectiondata)) {
                                    foreach ($collectiondata as $rptdata) {
                                        $dataforexcel["FEE HEAD"]         =  $key1;
                                        $dataforexcel["Class"]            =  $key2;
                                        $dataforexcel["BATCH"]            =  $key3;
                                        $dataforexcel["Admission No."]    =  $rptdata['Admn_No'];
                                        $dataforexcel["Student Name"]     =  $rptdata['First_Name'];
                                        $dataforexcel["For Month"]        =  date('M Y', strtotime($rptdata['demand_date']));
                                        $dataforexcel["Received Date"]    =  date('d-m-Y', strtotime($rptdata['voucher_date']));
                                        $dataforexcel["Amount"]           =  ($rptdata['is_penalty'] == 1) ? '(Penalty) ' : my_money_format_for_excel($rptdata['amt_paid']);
                                        $totcolamt                        = $totcolamt + $rptdata['amt_paid'];
                                        $result_array[] = $dataforexcel;
                                    }
                                }
                            }
                        }
                    }
                    $netamount = $totcolamt - $common_data['transfer_amount'] - $common_data['withdrawal_amount'];
                    $total_array["Concession Amount"]         = my_money_format_for_excel($common_data['concession_amount']);
                    $total_array["Exemption Amount"]           = my_money_format_for_excel($common_data['exemption_amount']);
                    $total_array["Total Amount"]           = my_money_format_for_excel($totcolamt);
                    $total_array["Service Charge"]           = my_money_format_for_excel($common_data['service_charge']);
                    $total_array["Round Off"]           = my_money_format_for_excel($common_data['round_off']);
                    $total_array["Transfer Amount (-)"]           = my_money_format_for_excel($common_data['transfer_amount']);
                    $total_array["Paidback Amount (-)"]           = my_money_format_for_excel($common_data['withdrawal_amount']);
                    $total_array["Net Amount"]           = my_money_format_for_excel($netamount + $common_data['service_charge'] + $common_data['round_off']);



                    $this->load->helper('sheet');
                    $file_rand_name = "headwise_collection_report_";

                    $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                    echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //BATCHWISE DCB REPORT
    public function show_preload_dcb_classwise_summary_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            // $data['sub_title'] = 'DCB Batch Wise Summary';
            $data['sub_title'] = 'Batch Wise DCB Report';

            //STREAM DATA
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

            //CLASS DATA
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
            //ACD YEAR DATA
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

            //BATCH DATA
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
            $this->load->view('report/batch_individual_dcb_report', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_dcb_classwise_summary_report_details()
    {
        if ($this->input->is_ajax_request() == 1) {

            $inst_id    = $this->session->userdata('inst_id');
            $user_id        = $this->session->userdata('userid');
            $acd_year_id    = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_STRING);
            $batch_id       = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            $class_id       = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $type           = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $rpt_type       = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $data_prep = array(
                'action' => 'get-batch-wise-dcb-report',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'batch_id' => $batch_id,
                'class_id' => $class_id
            );
            $report_data = $this->MReport->get_batch_wise_dcb_report($data_prep);
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Batch Wise DCB Report';
                    $data['bread_crumps'] = 'Fees Management > Reports > Batch Wise DCB Report';
                    $data['filename_report'] = "reports/batchwise_dcb_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/batchwise_dcb_report_pdf';
                    $data['collection_date'] = '';
                    if ($batch_id == -1 && $class_id == -1) {
                        $html = $this->load->view('report/pdf/allclass_batchwise_dcb_report_pdf', $data, true);
                        echo json_encode(array('status' => 1, 'message' => $html));
                    } else {
                        $filename = $this->get_pdf_report($data, 'L');
                        echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                    }
                } else {
                    $data['details_data'] = $details_data = $report_data['data'];
                    $data['message'] = "";
                    $collection_date = '';

                    $i = 1;
                    $g_total_demand = 0;
                    $g_total_concession = 0;
                    $g_total_excemption = 0;
                    $g_total_scholarship = 0;
                    $g_total_net_due = 0;
                    $g_total_advance = 0;
                    $g_total_regular = 0;
                    $g_total_balance = 0;
                    $g_total_arrear = 0;
                    $result_array = [];

                    foreach ($details_data as $report_data) {
                        foreach ($report_data['report_data'] as $month => $report_lvl1) {
                            $student_status = '';
                            if (trim($report_data['student_data']['StatusFlag']) == 'L') $student_status = 'Long Absentee';
                            elseif (trim($report_data['student_data']['StatusFlag']) == 'O') $student_status = 'Official';
                            foreach ($report_lvl1['feecode'] as $fdata) {
                                $dataforexcel["Student Name"]           =   $report_data['student_data']['student_name'];
                                $dataforexcel["Student Status"]         =   $student_status;
                                $dataforexcel["Admission Number"]       =   $report_data['student_data']['Admn_No'];
                                $dataforexcel["Batch"]                  =   $report_data['student_data']['batch_name'];
                                $dataforexcel["Date"]                   =   date("d-m-Y");
                                $dataforexcel["Month"]                  =   date('M Y', strtotime($month));
                                $dataforexcel["Fee Details"]            =   $fdata['feecode_desc'];
                                $dataforexcel["Demanded Fees"]          =   my_money_format_for_excel($fdata['demand']);
                                $dataforexcel["Adjustments-Concession"] =   my_money_format_for_excel($fdata['concession']);
                                $dataforexcel["Adjustments-Exemption"]  =   my_money_format_for_excel($fdata['excemption']);
                                //  $dataforexcel["Adjustments-Scholarship"]  =   my_money_format_for_excel($fdata['scholarship']);
                                $dataforexcel["Net Due"]                =   my_money_format_for_excel($fdata['net_due']);
                                $dataforexcel["Receipts-Advance"]       =   my_money_format_for_excel($fdata['advance']);
                                $dataforexcel["Receipts-Regular"]       =   my_money_format_for_excel($fdata['regular']);
                                $dataforexcel["Balance"]                =   my_money_format_for_excel($fdata['balance']);
                                $dataforexcel["Arrear"]                 =   my_money_format_for_excel($fdata['arrear']);
                                $dataforexcel["Remarks"]                =   "";
                                $g_total_demand += $fdata['demand'];
                                $g_total_concession += $fdata['concession'];
                                $g_total_excemption += $fdata['excemption'];
                                //  $g_total_scholarship += $report_data['summary']['total_scholarship'];
                                $g_total_net_due += $fdata['net_due'];
                                $g_total_advance += $fdata['advance'];
                                $g_total_regular += $fdata['regular'];
                                $g_total_balance += $fdata['balance'];
                                $g_total_arrear += $fdata['arrear'];
                                $result_array[] = $dataforexcel;
                            }
                        }
                    }
                    $total_array["Demanded Fees Grand Total"]          =   my_money_format_for_excel($g_total_demand);
                    $total_array["Adjustments-Concession Grand Total"] =   my_money_format_for_excel($g_total_concession);
                    $total_array["Adjustments-Exemption Grand Total"]  =   my_money_format_for_excel($g_total_excemption);
                    $total_array["Adjustments-Scholarship Grand Total"] =   my_money_format_for_excel($g_total_scholarship);
                    $total_array["Net Due Grand Total"]                =   my_money_format_for_excel($g_total_net_due);
                    $total_array["Receipts-Advance Grand Total"]       =   my_money_format_for_excel($g_total_advance);
                    $total_array["Receipts-Regular Grand Total"]       =   my_money_format_for_excel($g_total_regular);
                    $total_array["Balance Grand Total"]                =   my_money_format_for_excel($g_total_balance);
                    $total_array["Arrear Grand Total"]                 =   my_money_format_for_excel($g_total_arrear);


                    $this->load->helper('sheet');
                    $file_rand_name = "batchwise_dcb_report_";
                    $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                    echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //ONLINE PAY REPORT
    public function show_online_pay_report_preloader()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Online Collection Report';
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
            $this->load->view('report/online_collection', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_online_pay_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $data_prep = array(
                'action' => 'get-online-pay-report',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            $report_data = $this->MReport->get_online_pay_details($data_prep);
            // dev_export($report_data);
            // die;
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {

                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Online Collection Report';
                    $data['bread_crumps'] = 'Fees Management > Reports > Online Collection Report';
                    $data['filename_report'] = "reports/online_collection_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/online_collection_report_pdf';
                    $data['collection_date'] = 'Collection From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $data['details_data'] = $details_data = $report_data['data'];
                    $collection_date = 'Collection From : ' . date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));

                    $i = 1;
                    $totcolamt = 0;
                    $result_array = [];

                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data as $rptdata) {
                            $dataforexcel["Admission No."]       = $rptdata['Admn_No'];
                            $dataforexcel["Student Name"]  = $rptdata['student_name'];
                            $dataforexcel["Class"]         = $rptdata['CLASS_NAME'];
                            $dataforexcel["Batch"]         = $rptdata['Batch_Name'];
                            $dataforexcel["Voucher Date"]  = date('d-m-Y', strtotime($rptdata['voucher_date']));
                            $dataforexcel["Voucher Code"]  = $rptdata['voucher_code'];
                            $dataforexcel["Online Txn Date"]  = date('d-m-Y', strtotime($rptdata['transaction_date']));
                            $dataforexcel["Online Txn Id"]  = $rptdata['online_transaction_id'];
                            $dataforexcel["Amount"]        =  my_money_format_for_excel($rptdata['amt_paid']);
                            $totcolamt                     = $totcolamt + $rptdata['amt_paid'];
                            $result_array[]                = $dataforexcel;
                        }
                        $total_array["Total Amount"] = $totcolamt;
                        $this->load->helper('sheet');
                        $file_rand_name = "online_collection_report_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            echo $this->load->view(ERROR_500);
            return;
        }
        //     if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {

        //         $reportdata = $report_data['data'];
        //         //$payment_modes = $report_data['pay_modes'];

        //         ini_set('memory_limit', '256M'); //boost the memory limit if it's low ;)
        //         ini_set("pcre.backtrack_limit", "10000000");
        //         $spreadsheet = new Spreadsheet();


        //         $spreadsheet->getProperties()->setCreator('Docme')
        //             ->setLastModifiedBy('Docme')
        //             ->setTitle($this->session->userdata('Institution_Name'))
        //             ->setSubject('Fee Management - Online Pay Report ')
        //             ->setDescription('Fees Management - Online Pay Report')
        //             ->setKeywords('Fees Management - Online Pay Report')
        //             ->setCategory('Fee Management');

        //         $spreadsheet = $this->format_report_data_to_xlsx_online_pay_report($reportdata, $spreadsheet);

        //         //Set active sheet index to the first sheet, so Excel opens this as the first sheet
        //         $spreadsheet->setActiveSheetIndex(0);

        //         //Redirect output to a client’s web browser (Xlsx)
        //         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //         header('Content-Disposition: attachment;filename="01simple.xlsx"');
        //         header('Cache-Control: max-age=0');
        //         //If you're serving to IE 9, then the following may be needed
        //         header('Cache-Control: max-age=1');

        //         //If you're serving to IE over SSL, then the following may be needed
        //         header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); //Date in the past
        //         header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); //always modified
        //         header('Cache-Control: cache, must-revalidate'); //HTTP/1.1
        //         header('Pragma: public'); //HTTP/1.0

        //         $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        //         ob_start();
        //         $writer->save('php://output');
        //         $xlsData = ob_get_contents();
        //         ob_end_clean();
        //         $response = array(
        //             'status' => 1,
        //             'link' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData)
        //         );

        //         echo json_encode($response);
        //         return;
        //     } else {
        //         echo json_encode(array('status' => 3, 'message' => 'No Data available for this report.'));
        //     }
        // } else {
        //     $this->load->view('template/error-500');
        // }
    }
    private function format_report_data_to_xlsx_online_pay_report($report_data, $spreadsheet)
    {
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setTitle('Online Pay report');
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle('I1')->getAlignment()->setWrapText(true);

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(35);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        //$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        //$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Admission No.');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B1', 'Name');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C1', 'Class');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D1', 'Batch');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('E1', 'Transaction Type');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('F1', 'Transaction Date');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('G1', 'Voucher');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('H1', 'Total Amount');
        //$spreadsheet->setActiveSheetIndex(0)
        //->setCellValue('J1', 'Service charge(If any)');
        //$spreadsheet->setActiveSheetIndex(0)
        //->setCellValue('I1', 'TOTAL  AMOUNT');

        $data_row = 1;
        $data_col = 'A';


        foreach ($report_data as $rpt_data) {
            $data_row++;
            $data_col = 'A';
            $cell_name = $data_col . $data_row;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($cell_name, $rpt_data['Admn_No']);
            $data_col++;
            $cell_name = $data_col . $data_row;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($cell_name, $rpt_data['First_Name']);
            $data_col++;
            $cell_name = $data_col . $data_row;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($cell_name, $rpt_data['CLASS_NAME']);
            $data_col++;
            $cell_name = $data_col . $data_row;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($cell_name, $rpt_data['Batch_Name']);
            $data_col++;
            $cell_name = $data_col . $data_row;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($cell_name, $rpt_data['payment_type_name']);
            $data_col++;
            $cell_name = $data_col . $data_row;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($cell_name, date('d-m-Y', strtotime($rpt_data['voucher_date'])));
            $data_col++;
            $cell_name = $data_col . $data_row;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($cell_name, $rpt_data['voucher_code']);
            $data_col++;
            $cell_name = $data_col . $data_row;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($cell_name, round($rpt_data['voucher_amount'], 2, PHP_ROUND_HALF_UP));
            //$data_col++;
            //$cell_name = $data_col . $data_row;
            //$spreadsheet->setActiveSheetIndex(0)
            //->setCellValue($cell_name, round($rpt_data['SERVICE_CHARGE'], 2, PHP_ROUND_HALF_UP));
            //$data_col++;
            //$cell_name = $data_col . $data_row;
            //$spreadsheet->setActiveSheetIndex(0)
            //->setCellValue($cell_name, round($rpt_data['TOTAL_TRANSACTION_AMT'], 2, PHP_ROUND_HALF_UP));
        }

        return $spreadsheet;
    }

    //PAYBACK REPORT
    public function show_payback_summary_preloaders()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Payback Summary Report';
            $this->load->view('report/payback_summary', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function get_payback_summary_report()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            $data_prep = array(
                'action' => 'get-payback-summary-report',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            $report_data = $this->MReport->get_payback_summary_details($data_prep);
            // dev_export($report_data);
            // die;
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            //SALAHUDHEEN
            if (isset($report_data['data']) || isset($report_data['other_data'])) {
                $rq_placed = 0;
                $rq_rejected = 0;
                $detail_array = array();
                $i = 0;
                $rq_approved = 0;
                $rq_encashed = 0;
                $direct_payback = 0;
                $wallet_payback = 0;
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {

                    /** */
                    // // $payback_details = json_decode($report_data['data'], true);
                    // $payback_details = json_decode($report_data['data'][0]['PAYBACK_DETAILS'], true);
                    // $rq_placed = json_decode($report_data['data'][0]['PENDING'], true);//$report_data['data']['0']['PENDING'];
                    // $rq_rejected = json_decode($report_data['data'][0]['REJECTED'], true);//$report_data['data']['0']['REJECTED'];


                    // $payback_details = json_decode($report_data['data'][0]['PAYBACK_DETAILS'], true);


                    // if(isset($payback_details) && !empty($payback_details) ){
                    // dev_export($payback_details);
                    // die;
                    foreach ($report_data['data'] as $rdata) {
                        $detail_array[$rdata['CLASS_NAME']][$rdata['Batch_Name']][$rdata['Admn_No']]['Admn_No'] = $rdata['Admn_No'];
                        $detail_array[$rdata['CLASS_NAME']][$rdata['Batch_Name']][$rdata['Admn_No']]['First_Name'] = $rdata['First_Name'];
                        $detail_array[$rdata['CLASS_NAME']][$rdata['Batch_Name']][$rdata['Admn_No']]['voucher'][$i]['status_name'] = $rdata['status_name'];
                        $detail_array[$rdata['CLASS_NAME']][$rdata['Batch_Name']][$rdata['Admn_No']]['voucher'][$i]['payback_request_date'] = $rdata['payback_request_date'];
                        $detail_array[$rdata['CLASS_NAME']][$rdata['Batch_Name']][$rdata['Admn_No']]['voucher'][$i]['approved_on'] = $rdata['approved_on'];
                        $detail_array[$rdata['CLASS_NAME']][$rdata['Batch_Name']][$rdata['Admn_No']]['voucher'][$i]['PAYBACK_AMT'] = $rdata['PAYBACK_AMT'];
                        //$detail_array[$rdata['CLASS_NAME']][$rdata['Batch_Name']][$rdata['Admn_No']]['NON_RELSD_AMT'] = $rdata['NON_RELSD_AMT'];
                        $detail_array[$rdata['CLASS_NAME']][$rdata['Batch_Name']][$rdata['Admn_No']]['voucher'][$i]['approve_comments'] = $rdata['approve_comments'];
                        $i++;
                        //if ($rdata['status_id'] == 1) {
                        //$rq_placed += $rdata['PAYBACK_AMT'];
                        //}
                        if ($rdata['status_id'] == 2) {
                            $rq_approved += $rdata['PAYBACK_AMT'];
                        }
                        // if ($rdata['status_id'] == 3) {
                        //     $rq_rejected += $rdata['PAYBACK_AMT'];
                        // }
                        if ($rdata['status_id'] == 4 || $rdata['status_id'] == 5) {
                            $rq_encashed += $rdata['PAYBACK_AMT'];
                        }
                        if ($rdata['is_payback'] == 1) {
                            $direct_payback += $rdata['PAYBACK_AMT'];
                        }
                        if ($rdata['is_payback'] == 0) {
                            $wallet_payback += $rdata['PAYBACK_AMT'];
                        }
                    }
                }
                if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['other_data']) && !empty($report_data['other_data'])) {
                    $rq_placed = $report_data['other_data']['0']['PENDING'];
                    $rq_rejected = $report_data['other_data']['0']['REJECTED'];
                }
                /** */
                // foreach ($report_data['data'] as $rdata) {
                //     $detail_array[$rdata['Admn_No']]['Admn_No'] = $rdata['Admn_No'];
                //     $detail_array[$rdata['Admn_No']]['First_Name'] = $rdata['First_Name'];
                //     $detail_array[$rdata['Admn_No']]['CUR_CLASS'] = $rdata['CLASS_NAME'];
                //     $detail_array[$rdata['Admn_No']]['CUR_BATCH'] = $rdata['Batch_Name'];

                //     $detail_array[$rdata['Admn_No']]['voucher'][$i]['status_name'] = $rdata['status_name'];
                //     $detail_array[$rdata['Admn_No']]['voucher'][$i]['payback_request_date'] = $rdata['payback_request_date'];
                //     $detail_array[$rdata['Admn_No']]['voucher'][$i]['approved_on'] = $rdata['approved_on'];
                //     $detail_array[$rdata['Admn_No']]['voucher'][$i]['PAYBACK_AMT'] = $rdata['PAYBACK_AMT'];
                //     $detail_array[$rdata['Admn_No']]['voucher'][$i]['approve_comments'] = $rdata['approve_comments'];
                //     $i++;
                //     if ($rdata['status_id'] == 1) {
                //         $rq_placed += $rdata['PAYBACK_AMT'];
                //     }
                //     if ($rdata['status_id'] == 3) {
                //         $rq_approved += $rdata['PAYBACK_AMT'];
                //     }
                //     if ($rdata['status_id'] == 4) {
                //         $rq_rejected += $rdata['PAYBACK_AMT'];
                //     }
                //     if ($rdata['status_id'] == 5 || $rdata['status_id'] == 6) {
                //         $rq_encashed += $rdata['PAYBACK_AMT'];
                //     }
                // }
                $data['request_placed'] = $rq_placed; //[0]['total_transaction_amount'];
                $data['request_approved'] = $rq_approved;
                $data['request_rejected'] = $rq_rejected; //[0]['total_transaction_amount'];
                $data['request_encashed'] = $rq_encashed;
                $data['direct_payback'] = $direct_payback;
                $data['wallet_payback'] = $wallet_payback;
                // dev_export($detail_array);
                // die;


                if ($rpt_type == 1) {
                    $data['details_data'] = $detail_array;
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Payback Summary';
                    $data['bread_crumps'] = 'Fees Management > Reports > Payback Summary';
                    $data['filename_report'] = "reports/payback_summary_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/payback_summary_pdf';
                    $data['collection_date'] = 'From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $data['details_data'] = $details_data = $detail_array;
                    $collection_date = date('d/M/Y', strtotime($startdate)) . '  To  ' . date('d/M/Y', strtotime($enddate));
                    $totcolamt = 0;
                    $totcolamt = 0;
                    $result_array = [];

                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data  as $classname => $rptdata) {
                            foreach ($rptdata as $batchname => $studentdata) {
                                foreach ($studentdata as $stdata) {
                                    foreach ($stdata['voucher'] as $vocherid => $vchr) {
                                        $dataforexcel["Classs"]       = $classname;
                                        $dataforexcel["Batch"]        = $batchname;
                                        $dataforexcel["Student Name"] = $stdata['First_Name'];
                                        $dataforexcel["Admission No."] = $stdata['Admn_No'];
                                        $dataforexcel["Payback Status"] = $vchr['status_name'];
                                        $dataforexcel["Requested Date"]  = date('d-m-Y', strtotime($vchr['payback_request_date']));
                                        $dataforexcel["Approved Date"] = ($vchr['approved_on'] <> 0 ? date('d-m-Y', strtotime($vchr['approved_on'])) : '-');
                                        $dataforexcel["Comments"]       = $vchr['approve_comments'];
                                        $dataforexcel["Amount"]       = my_money_format_for_excel($vchr['PAYBACK_AMT']);
                                        $result_array[]               = $dataforexcel;
                                        $totcolamt                    = $totcolamt + $vchr['PAYBACK_AMT'];
                                    }
                                }
                            }
                        }

                        $total_array["Direct Payback"] = my_money_format_for_excel($direct_payback);
                        $total_array["Pending Amount"] = my_money_format_for_excel($rq_placed);
                        $total_array["Wallet Payback"] = my_money_format_for_excel($wallet_payback);
                        $total_array["Amount Rejected"] = my_money_format_for_excel($rq_rejected);
                        $total_array["Amount Encashed"] = my_money_format_for_excel($rq_encashed);
                        $this->load->helper('sheet');
                        $file_rand_name = "payback_summary_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //ARREAR LIST BATCHWISE REPORT
    public function show_report_preload_arrear_list_batch_wise()
    {

        //STREAM DATA
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

        //CLASS DATA
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
        //ACD YEAR DATA
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

        //BATCH DATA
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


        $data['sub_title'] = 'ARREAR LIST';
        $this->load->view('report/arrear_list/student_filter', $data);
    }
    public function batchlist_arrear_list_batch_wise()
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
    public function get_report_for_arrear_with_batch()
    {
        if ($this->input->is_ajax_request() == 1) {
            $batch_id = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_STRING);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $batch_name = filter_input(INPUT_POST, 'batch_name', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            // $acd_year_id = $this->session->userdata('acd_year');
            $acd_year_id = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            $data_prep = array(
                'action' => 'get-arrear-list-report-as-on-date-for-batch',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'batch_id' => $batch_id,
                'class_id' => $class_id
            );
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            $report_data = $this->MReport->get_arrear_list_batch_wise_as_on_date($data_prep);
            // dev_export($report_data);
            // die;

            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data']['report_data'])) {

                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Arrear List';
                    $data['bread_crumps'] = 'Fees Management > Reports > Arrear List';
                    $data['filename_report'] = "reports/arrear_list_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/arrear_list_report_pdf';
                    $data['collection_date'] = 'Arrears as on : ' . date('d/M/Y');
                    $filename = $this->get_pdf_report($data, 'L');
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $totcolamt = 0;
                    $data['details_data'] = $details_data = $report_data['data'];

                    $fee_code_base_data = $details_data['fee_code_data'];
                    $fee_code_base_data_nd = $details_data['non_demandable_feecodes'];
                    $report_student_data = $details_data['report_data'];
                    $report_student_data_nd = $details_data['report_data_nd'];
                    $collection_date = 'Arrears as on : ' . date('d/M/Y');

                    $grand_arrear_total = 0;
                    $i = 1;
                    $totcolamt = 0;
                    $totvatamt = 0;
                    $batch_total = 0;
                    $total_array = array();
                    $result_array_1 = [];
                    $result_array_3 = [];
                    $result_array_4 = [];
                    $result_array_5 = [];
                    if (is_array($report_student_data) && !empty($report_student_data)) {
                        foreach ($report_student_data as $acd_year => $acd_year_base_data) {
                            $row_total_amtt = 0;
                            foreach ($acd_year_base_data as $batch => $rpt_data) {
                                foreach ($rpt_data as $admn_no => $rpt_lvl1_data) {
                                    $student_data = $rpt_lvl1_data['student_data'];
                                    foreach ($rpt_lvl1_data['arrear'] as $key_month => $rpt_arrear_data) {
                                        $dataforexcel["Academic Year"] = $acd_year;
                                        $dataforexcel["Batch"] = $batch;
                                        $dataforexcel["Student Name"] = $student_data['student_name'];
                                        $dataforexcel["Admission No."] = $student_data['admn_no'];
                                        $dataforexcel["Month"]        = date('M Y', strtotime($key_month));
                                        $fee_code_total = 0;
                                        foreach ($fee_code_base_data as $fcodes_temp) {
                                            if ($fcodes_temp['editable'] == 1) {
                                                $flag = 1;
                                                foreach ($rpt_arrear_data['fee_data'] as $key => $value) {
                                                    if ($key == $fcodes_temp['feeCode']) {
                                                        $flag = 2;
                                                        $dataforexcel[$fcodes_temp['fee_shortcode']] = my_money_format_for_excel($value['amount']);
                                                        $fee_code_total = $fee_code_total + $value['amount'];
                                                        $batch_total = $batch_total + $value['amount'];
                                                        if (!isset($total_array[$acd_year][$fcodes_temp['feeCode']]['total']))
                                                            $total_array[$acd_year][$fcodes_temp['feeCode']]['total'] =  $value['amount'];
                                                        else
                                                            $total_array[$acd_year][$fcodes_temp['feeCode']]['total'] +=  $value['amount'];
                                                    }
                                                }
                                                if ($flag == 1) {
                                                    $dataforexcel[$fcodes_temp['fee_shortcode']] = my_money_format_for_excel(0);
                                                }
                                            }
                                        }
                                        $dataforexcel["Total"]        = my_money_format_for_excel($fee_code_total);
                                        $result_array_1[]               = $dataforexcel;
                                    }
                                }
                            }
                        }
                        $result_datas["Reports"] = $result_array_1;
                        foreach ($report_student_data as $acd_year => $acd_year_base_data) {
                            $acd_yr_arrear = 0;
                            foreach ($fee_code_base_data as $fcodes_header4) {
                                $row_total_amtt = 0;
                                if ($fcodes_header4['editable'] == 1) {
                                    $cash_t = (isset($total_array[$acd_year][$fcodes_header4['feeCode']]['total']) ? $total_array[$acd_year][$fcodes_header4['feeCode']]['total'] : 0);
                                    $row_total_amtt = $row_total_amtt + $cash_t;
                                    $total_cal["Reports"][$fcodes_header4['fee_shortcode'] . " Total " . $acd_year] = $row_total_amtt;
                                }
                                $grand_arrear_total += $row_total_amtt;
                                $acd_yr_arrear += $row_total_amtt;
                            }
                            $total_cal["Reports"][" Total Arrear " . $acd_year] = $acd_yr_arrear;
                        }

                        $total_cal["Reports"][" Total Arrear (Current + Prev. Year(s))"] = $grand_arrear_total;
                        $i = 1;
                        $totcolamt = 0;
                        $totvatamt = 0;
                        $batch_total = 0;
                        $total_array = array();

                        if (is_array($report_student_data_nd) && !empty($report_student_data_nd)) {

                            foreach ($report_student_data_nd as $acd_year => $acd_year_base_data_nd) {
                                $class_total = 0;
                                $dataforexcel_3["Academic Year"]    = $acd_year;
                                foreach ($acd_year_base_data_nd as $batch => $rpt_data_ar) {
                                    $dataforexcel_3["Batch"] = $batch;
                                    $batch_total_amount = 0;
                                    $widthremain = 65;
                                    $tdcount = 5;
                                    foreach ($rpt_data_ar as $admn_no => $rpt_lvl1_data_ar) {
                                        $student_data = $rpt_lvl1_data_ar['student_data'];
                                        $dataforexcel_3["Student Name"] = $student_data['student_name'];
                                        $dataforexcel_3["Admission No."] = $student_data['admn_no'];
                                        $dataforexcel_3["Month"]        = date('M Y', strtotime($key_month));
                                        foreach ($rpt_lvl1_data_ar['arrear'] as $key_month => $rpt_arrear_data) {
                                            $fee_code_total = 0;
                                            foreach ($fee_code_base_data_nd as $fcodes_temp) {
                                                if ($fcodes_temp['editable'] == 1) {
                                                    $flag = 1;
                                                    foreach ($rpt_arrear_data['fee_data'] as $key => $value) {
                                                        if ($key == $fcodes_temp['feeCode']) {
                                                            $flag = 2;

                                                            $dataforexcel_3[$fcodes_temp['fee_shortcode']] = my_money_format_for_excel($value['amount']);
                                                            $fee_code_total = $fee_code_total + $value['amount'];
                                                            $batch_total = $batch_total + $value['amount'];
                                                            if (!isset($total_array[$fcodes_temp['feeCode']]['total']))
                                                                $total_array[$fcodes_temp['feeCode']]['total'] =  $value['amount'];
                                                            else
                                                                $total_array[$fcodes_temp['feeCode']]['total'] +=  $value['amount'];
                                                        }
                                                    }
                                                    if ($flag == 1) {
                                                        $dataforexcel_3[$fcodes_temp['fee_shortcode']] = my_money_format_for_excel(0);
                                                    }
                                                }
                                            }
                                            $dataforexcel_3["Total"] = my_money_format_for_excel($fee_code_total);
                                            $result_array_3[]                = $dataforexcel_3;
                                        }
                                    }
                                }
                            }

                            foreach ($fee_code_base_data_nd as $fcodes_header4) {
                                $row_total_amttt = 0;
                                if ($fcodes_header4['editable'] == 1) {
                                    $cash_t = (isset($total_array[$fcodes_header4['feeCode']]['total']) ? $total_array[$fcodes_header4['feeCode']]['total'] : 0);
                                    $row_total_amttt = $row_total_amttt + $cash_t;
                                }
                                $grand_arrear_total += $row_total_amttt;
                                $total_cal["Others"][$fcodes_header4['fee_shortcode'] . " Total"] = $row_total_amttt;
                            }

                            $result_datas["Others"] = $result_array_3;
                        }


                        $ft = 1;
                        foreach ($fee_code_base_data as $fcodes_header) {
                            if ($fcodes_header['editable'] == 1) {
                                $dataforexcel_4["Sl No."]  = $ft;
                                $dataforexcel_4["Code"]  = $fcodes_header['fee_shortcode'];
                                $dataforexcel_4["Description"]  = $fcodes_header['description'];
                                $result_array_4[]  = $dataforexcel_4;
                                $ft++;
                            }
                        }
                        $ot = 1;
                        foreach ($fee_code_base_data_nd as $fcodes_header3) {
                            if ($fcodes_header3['editable'] == 1) {
                                $dataforexcel_5["Sl No."]  = $ot;
                                $dataforexcel_5["Code"] = $fcodes_header3['fee_shortcode'];
                                $dataforexcel_5["Description"] = $fcodes_header3['description'];
                            }
                            $result_array_5[]                = $dataforexcel_5;
                            $ot++;
                        }

                        // $result_datas["Daily Total as follows"]=$result_array_2; 
                        //   $result_datas["Others"]=$result_array_3; 
                        $result_datas["Fee Code Descriptions"] = $result_array_4;
                        $result_datas["OTHER FEE CODE DESCRIPTIONS"] = $result_array_5;

                        $this->load->helper('sheet');
                        $file_rand_name = "arrear_list_report_";
                        $filename_report = get_excel_report_dynamic($result_datas, $file_rand_name, $collection_date, $total_cal);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data available for this report.'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //LONG ABSENTEE - ARREAR
    public function show_report_preload_arrear_list_long_ab_batch_wise()
    {
        //STREAM DATA
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

        //CLASS DATA
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
        //ACD YEAR DATA
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
        //BATCH DATA
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
        $data['sub_title'] = 'LONG ABSENTEE ARREAR LIST';
        $this->load->view('report/arrear_list/student_filter_longab', $data);
    }
    public function batchlist_arrear_list_long_ab_batch_wise()
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
    public function get_report_for_arrear_longab_with_batch()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $batch_id = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_STRING);
            $batch_name = filter_input(INPUT_POST, 'batch_name', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            // $acd_year_id = $this->session->userdata('acd_year');
            $acd_year_id = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);


            $data_prep = array(
                'action' => 'get-arrear-list-longab-report-as-on-date-for-batch',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'batch_id' => $batch_id,
                'class_id' => $class_id
            );
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            $report_data = $this->MReport->get_arrear_list_longab_batch_wise_as_on_date($data_prep);

            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data']['report_data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";

                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Long Absentee Arrear List';
                    $data['bread_crumps'] = 'Fees Management > Reports > Long Absentee Arrear List';
                    $data['filename_report'] = "reports/long_absentee_arrear_list_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/arrear_list_long_absentee_report_pdf';
                    $data['collection_date'] = 'Arrears as on : ' . date('d/M/Y');
                    $filename = $this->get_pdf_report($data, 'L');
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $totcolamt = 0;
                    $data['details_data'] = $details_data = $report_data['data'];
                    $fee_code_base_data = $details_data['fee_code_data'];
                    $fee_code_base_data_nd = $details_data['non_demandable_feecodes'];
                    $report_student_data = $details_data['report_data'];
                    $report_student_data_nd = $details_data['report_data_nd'];
                    $collection_date = 'Arrears as on : ' . date('d/M/Y');

                    $grand_arrear_total = 0;
                    $i = 1;
                    $totcolamt = 0;
                    $totvatamt = 0;
                    $batch_total = 0;
                    $total_array = array();

                    $result_array_1 = [];
                    $result_array_3 = [];
                    $result_array_4 = [];
                    $result_array_5 = [];
                    if (is_array($report_student_data) && !empty($report_student_data)) {
                        foreach ($report_student_data as $acd_year => $acd_year_base_data) {
                            $row_total_amtt = 0;
                            foreach ($acd_year_base_data as $batch => $rpt_data) {
                                foreach ($rpt_data as $admn_no => $rpt_lvl1_data) {
                                    $student_data = $rpt_lvl1_data['student_data'];
                                    foreach ($rpt_lvl1_data['arrear'] as $key_month => $rpt_arrear_data) {
                                        $dataforexcel["Academic Year"] = $acd_year;
                                        $dataforexcel["Batch"] = $batch;
                                        $dataforexcel["Student Name"] = $student_data['student_name'];
                                        $dataforexcel["Admission No."] = $student_data['admn_no'];
                                        $dataforexcel["Month"]        = date('M Y', strtotime($key_month));
                                        $fee_code_total = 0;
                                        foreach ($fee_code_base_data as $fcodes_temp) {
                                            if ($fcodes_temp['editable'] == 1) {
                                                $flag = 1;
                                                foreach ($rpt_arrear_data['fee_data'] as $key => $value) {
                                                    if ($key == $fcodes_temp['feeCode']) {
                                                        $flag = 2;
                                                        $dataforexcel[$fcodes_temp['fee_shortcode']] = my_money_format_for_excel($value['amount']);
                                                        $fee_code_total = $fee_code_total + $value['amount'];
                                                        $batch_total = $batch_total + $value['amount'];
                                                        if (!isset($total_array[$acd_year][$fcodes_temp['feeCode']]['total']))
                                                            $total_array[$acd_year][$fcodes_temp['feeCode']]['total'] =  $value['amount'];
                                                        else
                                                            $total_array[$acd_year][$fcodes_temp['feeCode']]['total'] +=  $value['amount'];
                                                    }
                                                }
                                                if ($flag == 1) {
                                                    $dataforexcel[$fcodes_temp['fee_shortcode']] = my_money_format_for_excel(0);
                                                }
                                            }
                                        }
                                        $totcolamt += $fee_code_total;
                                        $dataforexcel["Total"]        = my_money_format_for_excel($fee_code_total);
                                        $result_array_1[]               = $dataforexcel;
                                    }
                                }
                            }
                        }
                        $result_datas["Reports"] = $result_array_1;
                        /* foreach ($fee_code_base_data as $fcodes_header4) {
                            if ($fcodes_header4['editable'] == 1) {
                                $cash_t = (isset($total_array[$fcodes_header4['feeCode']]['total']) ? $total_array[$fcodes_header4['feeCode']]['total'] : 0);
                                $total_cal["Reports"][$fcodes_header4['fee_shortcode']]= $cash_t;
                                $row_total_amtt = $row_total_amtt + $cash_t;
                            }
                        } */
                        $total_cal["Reports"]["Total Arrear (Current + Prev. Year(s))"] = $totcolamt;
                        $i = 1;
                        $totcolamt = 0;
                        $totvatamt = 0;
                        $batch_total = 0;
                        $total_array = array();

                        if (is_array($report_student_data_nd) && !empty($report_student_data_nd)) {

                            foreach ($report_student_data_nd as $acd_year => $acd_year_base_data_nd) {
                                $class_total = 0;
                                $dataforexcel_3["Academic Year"]    = $acd_year;
                                foreach ($acd_year_base_data_nd as $batch => $rpt_data_ar) {
                                    $dataforexcel_3["Batch"] = $batch;
                                    $batch_total_amount = 0;
                                    $widthremain = 65;
                                    $tdcount = 5;
                                    foreach ($rpt_data_ar as $admn_no => $rpt_lvl1_data_ar) {
                                        $student_data = $rpt_lvl1_data_ar['student_data'];
                                        $dataforexcel_3["Student Name"] = $student_data['student_name'];
                                        $dataforexcel_3["Admission No."] = $student_data['admn_no'];
                                        $dataforexcel_3["Month"]        = date('M Y', strtotime($key_month));
                                        foreach ($rpt_lvl1_data_ar['arrear'] as $key_month => $rpt_arrear_data) {
                                            $fee_code_total = 0;
                                            foreach ($fee_code_base_data_nd as $fcodes_temp) {
                                                if ($fcodes_temp['editable'] == 1) {
                                                    $flag = 1;
                                                    foreach ($rpt_arrear_data['fee_data'] as $key => $value) {
                                                        if ($key == $fcodes_temp['feeCode']) {
                                                            $flag = 2;

                                                            $dataforexcel_3[$fcodes_temp['fee_shortcode']] = my_money_format_for_excel($value['amount']);
                                                            $fee_code_total = $fee_code_total + $value['amount'];
                                                            $batch_total = $batch_total + $value['amount'];
                                                            if (!isset($total_array[$fcodes_temp['feeCode']]['total']))
                                                                $total_array[$fcodes_temp['feeCode']]['total'] =  $value['amount'];
                                                            else
                                                                $total_array[$fcodes_temp['feeCode']]['total'] +=  $value['amount'];
                                                        }
                                                    }
                                                    if ($flag == 1) {
                                                        $dataforexcel_3[$fcodes_temp['fee_shortcode']] = my_money_format_for_excel(0);
                                                    }
                                                }
                                            }
                                            $dataforexcel_3["Total"] = my_money_format_for_excel($fee_code_total);
                                            $result_array_3[]                = $dataforexcel_3;
                                        }
                                    }
                                }
                            }
                            $result_datas["Others"] = $result_array_3;
                        }


                        $ft = 1;
                        foreach ($fee_code_base_data as $fcodes_header) {
                            if ($fcodes_header['editable'] == 1) {
                                $dataforexcel_4["Sl No."]  = $ft;
                                $dataforexcel_4["Code"]  = $fcodes_header['fee_shortcode'];
                                $dataforexcel_4["Description"]  = $fcodes_header['description'];
                                $result_array_4[]  = $dataforexcel_4;
                                $ft++;
                            }
                        }
                        $ot = 1;
                        foreach ($fee_code_base_data_nd as $fcodes_header3) {
                            if ($fcodes_header3['editable'] == 1) {
                                $dataforexcel_5["Sl No."]  = $ot;
                                $dataforexcel_5["Code"] = $fcodes_header3['fee_shortcode'];
                                $dataforexcel_5["Description"] = $fcodes_header3['description'];
                            }
                            $result_array_5[]                = $dataforexcel_5;
                            $ot++;
                        }

                        $result_datas["Fee Code Descriptions"] = $result_array_4;
                        $result_datas["OTHER FEE CODE DESCRIPTIONS"] = $result_array_5;

                        $this->load->helper('sheet');
                        $file_rand_name = "long_absentee_arrear_list_report_";
                        $filename_report = get_excel_report_dynamic($result_datas, $file_rand_name, $collection_date, $total_cal);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data available for this report.'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }
    //TRANSPORT DUE LIST
    public function show_transport_due_list()
    {

        //STREAM DATA
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

        //CLASS DATA
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
        //ACD YEAR DATA
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

        //BATCH DATA
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


        $data['sub_title'] = 'TRANSPORT DUE LIST';
        $this->load->view('report/arrear_list/show_transport_due_list', $data);
    }
    // public function show_transport_due_list()
    // {
    //     $backdate = filter_input(INPUT_POST, 'backdate', FILTER_SANITIZE_NUMBER_INT); //Backdate (1) or Current (2)
    //     if ($this->input->is_ajax_request() == 1) {
    //         $data['sub_title'] = 'TRANSPORT DUE LIST';
    //         $this->load->view('report/arrear_list/show_transport_due_list', $data);
    //     } else {
    //         $this->load->view('template/error-500');
    //     }
    // } //

    public function get_transport_due_list()
    {
        if ($this->input->is_ajax_request() == 1) {
            $batch_id = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_STRING);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $batch_name = filter_input(INPUT_POST, 'batch_name', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid'); //4
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            // $acd_year_id = $this->session->userdata('acd_year');
            $acd_year_id = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_STRING);

            $data_prep = array(
                'action'                => 'get_transport_due_list',
                'controller_function'   => 'Fees_settings/Fee_report_controller/get_transport_due_list',
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id,
                'batch_id' => $batch_id,
                'class_id' => $class_id
            );

            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            $report_data = $this->MReport->get_transport_due_list($data_prep);
            // dev_export($report_data);
            // die;

            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data']['report_data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";

                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Transport Due List';
                    $data['bread_crumps'] = 'Fees Management > Reports > Transport Due List';
                    $data['filename_report'] = "reports/transport_due_list_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/transport_due_list_report_pdf';
                    $data['collection_date'] = 'Due as on : ' . date('d/M/Y');
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $details_data   = $report_data['data'];
                    $fee_code_base_data     = $details_data['fee_code_data'];
                    $fee_code_base_data_nd  = $details_data['non_demandable_feecodes'];
                    $report_student_data    = $details_data['report_data'];
                    $report_student_data_nd = $details_data['report_data_nd'];
                    $collection_date        = 'Due as on : ' . date('d/M/Y');
                    $totcolamt = 0;
                    $totvatamt = 0;
                    $batch_total = 0;
                    $total_array = array();
                    $row_total_amtt = 0;
                    $result_array = [];
                    if (is_array($report_student_data) && !empty($report_student_data)) {
                        foreach ($report_student_data as $acd_year => $acd_year_base_data) {
                            $row_total_amtt = 0;
                            $dataforexcel["Academic Year"] = $acd_year;
                            foreach ($acd_year_base_data as $batch => $rpt_data) {
                                $i = 1;
                                $dataforexcel["Batch"] = $batch;
                                foreach ($rpt_data as $admn_no => $rpt_lvl1_data) {
                                    $student_total = 0;
                                    $student_data = $rpt_lvl1_data['student_data'];
                                    $dataforexcel["Student Name"] = $student_data['student_name'];
                                    $dataforexcel["Admission No."] = $student_data['admn_no'];

                                    foreach ($rpt_lvl1_data['arrear'] as $key_month => $rpt_arrear_data) {
                                        $fee_code_total = 0;
                                        $flag = 1;
                                        $dataforexcel["Month"] = date('M Y', strtotime($key_month));
                                        foreach ($rpt_arrear_data['fee_data'] as $key => $value) {
                                            $flag = 2;
                                            $dataforexcel["Fee Amount"] = my_money_format_for_excel($value['amount']);
                                            $fee_code_total = $fee_code_total + $value['amount'];
                                            $row_total_amtt = $row_total_amtt + $fee_code_total;
                                            $student_total += $value['amount'];
                                        }
                                        $result_array[]               = $dataforexcel;
                                    }
                                }
                            }
                        }
                        $total_array["Total Amount"] = $row_total_amtt;

                        $this->load->helper('sheet');
                        $file_rand_name = "transport_due_list_report_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data available for this report.'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data available for this report.'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //FEE DEALLOCATION LIST
    public function show_fee_deallocated_list()
    {

        //STREAM DATA
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

        //CLASS DATA
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
        //ACD YEAR DATA
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

        //BATCH DATA
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


        $data['sub_title'] = 'FEE ENABLE / DISABLE DETAILS';
        $this->load->view('report/show_fee_deallocated_list', $data);
    }

    public function get_fee_deallocated_list()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);

            $data_prep = array(
                'action'                => 'get_fee_deallocated_list',
                'controller_function'   => 'Fees_settings/Fee_report_controller/get_fee_deallocated_list',
                'from_date' => $startdate,
                'to_date' => $enddate,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            $report_data = $this->MReport->report_function_in_model($data_prep);
            // dev_export($report_data);
            // die;
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            //SALAHUDHEEN
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['message'] = "";

                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Fee Enable/ Disable Details';
                    $data['bread_crumps'] = 'Fees Management > Reports > Fee Enable/ Disable Details';
                    $data['filename_report'] = "reports/fee_enable_disable_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/fee_deallocated_report_pdf';
                    $data['collection_date'] = 'From : ' . date('d/M/Y', strtotime($startdate)) . '  To  : ' . date('d/M/Y', strtotime($enddate));
                    $filename = $this->get_pdf_report($data);
                    //echo $filename;
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $details_data   = $report_data['data'];
                    $fee_code_base_data     = $details_data['fee_code_data'];
                    $fee_code_base_data_nd  = $details_data['non_demandable_feecodes'];
                    $report_student_data    = $details_data['report_data'];
                    $report_student_data_nd = $details_data['report_data_nd'];
                    $collection_date        = 'Due as on : ' . date('d/M/Y');
                    $totcolamt = 0;
                    $totvatamt = 0;
                    $batch_total = 0;
                    $total_array = array();
                    $row_total_amtt = 0;
                    $result_array = [];
                    if (is_array($report_student_data) && !empty($report_student_data)) {
                        foreach ($report_student_data as $acd_year => $acd_year_base_data) {
                            $row_total_amtt = 0;
                            $dataforexcel["Academic Year"] = $acd_year;
                            foreach ($acd_year_base_data as $batch => $rpt_data) {
                                $i = 1;
                                $dataforexcel["Batch"] = $batch;
                                foreach ($rpt_data as $admn_no => $rpt_lvl1_data) {
                                    $student_total = 0;
                                    $student_data = $rpt_lvl1_data['student_data'];
                                    $dataforexcel["Student Name"] = $student_data['student_name'];
                                    $dataforexcel["Admission No."] = $student_data['admn_no'];

                                    foreach ($rpt_lvl1_data['arrear'] as $key_month => $rpt_arrear_data) {
                                        $fee_code_total = 0;
                                        $flag = 1;
                                        $dataforexcel["Month"] = date('M Y', strtotime($key_month));
                                        foreach ($rpt_arrear_data['fee_data'] as $key => $value) {
                                            $flag = 2;
                                            $dataforexcel["Fee Amount"] = my_money_format_for_excel($value['amount']);
                                            $fee_code_total = $fee_code_total + $value['amount'];
                                            $row_total_amtt = $row_total_amtt + $fee_code_total;
                                            $student_total += $value['amount'];
                                        }
                                        $result_array[]               = $dataforexcel;
                                    }
                                }
                            }
                        }
                        $total_array["Total Amount"] = $row_total_amtt;

                        $this->load->helper('sheet');
                        $file_rand_name = "fee_deallocated_report_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data available for this report.'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data available for this report.'));
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    //ARREAR SUMMARY
    public function show_arrear_summary()
    {
        $backdate = filter_input(INPUT_POST, 'backdate', FILTER_SANITIZE_NUMBER_INT); //Backdate (1) or Current (2)
        if ($this->input->is_ajax_request() == 1) {
            if ($backdate == 1) {
                $data['sub_title'] = 'Backdate ARREAR SUMMARY';
                $this->load->view('report/arrear_list/arrear_summary_backdate', $data);
            } else {
                $data['sub_title'] = 'ARREAR SUMMARY';
                $this->load->view('report/arrear_list/arrear_summary', $data);
            }
        } else {
            $this->load->view('template/error-500');
        }
    } //
    public function get_arrear_summary()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $backdate = filter_input(INPUT_POST, 'backdate', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            if (!isset($backdate)) $backdate = 0;

            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $logged_user = $this->session->userdata('userid');
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $data_prep = array(
                'action'                => 'get_arrear_summary',
                'controller_function'   => 'Fees_settings/Fee_report_controller/get_arrear_summary',
                'startdate'             => $startdate,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id,
                'backdate'              => $backdate
            );
            $report_data = $this->MReport->get_arrear_summary($data_prep);
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data']['report'];
                    $data['feecode_data'] = $report_data['data']['feecode_data'];
                    $data['nd_report'] = $report_data['data']['nd_report'];
                    $data['non_demandable_feecodes'] = $report_data['data']['non_demandable_feecodes'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = ($backdate == 1 ? 'Backdate Arrear Summary' : 'Arrear Summary');
                    $data['bread_crumps'] = 'Fees Management > Reports > ' . ($backdate == 1 ? 'Backdate Arrear Summary' : 'Arrear Summary');
                    if ($backdate == 1) $data['filename_report'] = "reports/backdate_arrear_summary_report_" . $inst_id . "_" . $user_id . ".pdf";
                    else $data['filename_report'] = "reports/arrear_summary_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/arrear_summary_report_pdf';
                    $data['collection_date'] =  'Summary Arrears as on : ' . date('d/M/Y', strtotime($startdate));
                    $filename = $this->get_pdf_report($data, 'L');
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $details_data = $data['details_data'] = $report_data['data']['report'];
                    $feecode_data = $report_data['data']['feecode_data'];
                    $nd_report = $report_data['data']['nd_report'];
                    $non_demandable_feecodes = $report_data['data']['non_demandable_feecodes'];
                    $collection_date =  'Summary Arrears as on : ' . date('d/M/Y', strtotime($startdate));

                    $i = 1;
                    $totcolamt = 0;
                    $grant_total_amt = 0;
                    $total_array = array();

                    $result_array_1 = [];
                    $result_array_3 = [];
                    $result_array_4 = [];
                    $result_array_5 = [];
                    // test data
                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data as $ddate => $rpt_data) {
                            $dataforexcel["Month"] = date('M/Y', strtotime('01-' . $ddate));
                            $row_total_amt = 0;
                            $row_total_amtt = 0;
                            foreach ($feecode_data as $fcodes_header) {
                                if ($fcodes_header['editable'] == 1) {
                                    $cash = (isset($rpt_data[$fcodes_header['feeCode']]) ? $rpt_data[$fcodes_header['feeCode']] : 0);
                                    $dataforexcel[$fcodes_header['fee_shortcode']] = my_money_format_for_excel($cash);
                                    $row_total_amt = $row_total_amt + $cash;
                                    if (!isset($total_array[$fcodes_header['feeCode']]['total']))
                                        $total_array[$fcodes_header['feeCode']]['total'] =  $cash;
                                    else
                                        $total_array[$fcodes_header['feeCode']]['total'] +=  $cash;
                                }
                            }
                            $dataforexcel["Total"] = my_money_format_for_excel($row_total_amt);
                            $grant_total_amt += $row_total_amt;
                            $result_array_1[]  = $dataforexcel;
                        }

                        $total_result["Reports"]["Total"] = $grant_total_amt;
                        $result_datas["Reports"] = $result_array_1;
                        $i = 1;
                        $totcolamt = 0;
                        $grant_total_amt = 0;
                        $total_array = array();
                        if (isset($nd_report) && !empty($nd_report)) {
                            foreach ($nd_report as $ddate => $rpt_data) {
                                $dataforexcel_3["Month"] = date('M/Y', strtotime('01-' . $ddate));
                                $row_total_amt = 0;
                                $row_total_amtt = 0;
                                foreach ($non_demandable_feecodes as $fcodes_header2) {
                                    if ($fcodes_header2['editable'] == 1) {
                                        $cash = (isset($rpt_data[$fcodes_header2['feeCode']]) ? $rpt_data[$fcodes_header2['feeCode']] : 0);

                                        $dataforexcel_3[$fcodes_header2['fee_shortcode']] = my_money_format_for_excel($cash);
                                        $row_total_amt = $row_total_amt + $cash;
                                        if (!isset($total_array[$fcodes_header2['feeCode']]['total']))
                                            $total_array[$fcodes_header2['feeCode']]['total'] =  $cash;
                                        else
                                            $total_array[$fcodes_header2['feeCode']]['total'] +=  $cash;
                                    }
                                    //   $dataforexcel_3["Total"] = my_money_format_for_excel($row_total_amt);
                                }
                                $dataforexcel_3["Total"] = my_money_format_for_excel($row_total_amt);
                                $grant_total_amt += $row_total_amt;
                                $result_array_3[]  = $dataforexcel_3;
                            }
                            $total_result["Others"]["Total"] = $grant_total_amt;

                            $result_datas["Others"] = $result_array_3;
                        }
                        $ft = 1;
                        foreach ($feecode_data as $fcodes_header) {
                            if ($fcodes_header['editable'] == 1) {
                                $dataforexcel_4["Sl No."]  = $ft;
                                $dataforexcel_4["Code"]  = $fcodes_header['fee_shortcode'];
                                $dataforexcel_4["Description"]  = $fcodes_header['description'];
                                $result_array_4[]  = $dataforexcel_4;
                                $ft++;
                            }
                        }
                        $ot = 1;
                        foreach ($non_demandable_feecodes as $fcodes_header3) {
                            if ($fcodes_header3['editable'] == 1) {
                                $dataforexcel_5["Sl No."]  = $ot;
                                $dataforexcel_5["Code"] = $fcodes_header3['fee_shortcode'];
                                $dataforexcel_5["Description"] = $fcodes_header3['description'];
                            }
                            $result_array_5[]                = $dataforexcel_5;
                            $ot++;
                        }

                        $result_datas["Fee Code Descriptions"] = $result_array_4;
                        $result_datas["OTHER FEE CODE DESCRIPTIONS"] = $result_array_5;
                        $this->load->helper('sheet');
                        if ($backdate == 1) {
                            $file_rand_name = "backdate_arrear_summary_report_";
                        } else {
                            $file_rand_name = "arrear_summary_report_";
                        }

                        $filename_report = get_excel_report_dynamic($result_datas, $file_rand_name, $collection_date, $total_result);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
            }
        } else {
            echo $this->load->view(ERROR_500);
            return;
        }
    }

    //HEADWISE ARREAR REPORT   
    public function show_head_wise_arrear()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'Head wise Arrear';
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
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $feecodes_available = $this->MFee_collection->get_all_feecodes_available($inst_id);
            if (isset($feecodes_available['data']) && !empty($feecodes_available['data'])) {
                $data['feecodes_available'] = $feecodes_available['data'];
            } else {
                $data['feecodes_available'] = 0;
            }
            //dev_export($data);
            //die;
            $this->load->view('report/arrear_list/headwise_arrear', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function get_head_wise_arrear()
    {
        if ($this->input->is_ajax_request() == 1) {
            $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
            $feecode_id = filter_input(INPUT_POST, 'feecode_id');
            $inst_id = $this->session->userdata('inst_id');
            $user_id = $this->session->userdata('userid');
            $acd_year_id = $this->session->userdata('acd_year');
            $logged_user = $this->session->userdata('userid');
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT); //Excel (1) or Pdf (2)
            $rpt_type = filter_input(INPUT_POST, 'rpt_type', FILTER_SANITIZE_NUMBER_INT);
            $data_prep = array(
                'action'                => 'get_head_wise_arrear',
                'controller_function'   => 'Fees_settings/Fee_report_controller/get_head_wise_arrear',
                'from_date'             => $startdate,
                'to_date'               => $enddate,
                'feecode_id'            => $feecode_id,
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id
            );
            $report_data = $this->MReport->report_function_in_model($data_prep);
            $data['inst_currency'] = $this->session->userdata('Currency_abbr');
            if (isset($report_data['data_status']) && !empty($report_data['data_status']) && $report_data['data_status'] == 1 && isset($report_data['data']) && !empty($report_data['data'])) {
                if ($rpt_type == 1) {
                    $data['details_data'] = $report_data['data'];
                    $data['feecode_data'] = $report_data['feecodes'];
                    $data['message'] = "";
                    $data['user_name'] = $this->session->userdata('user_name');
                    $data['title'] = 'Headwise Arrear Summary';
                    $data['bread_crumps'] = 'Fees Management > Reports > Headwise Arrear Summary';
                    $data['filename_report'] = "reports/head_wise_arrear_report_" . $inst_id . "_" . $user_id . ".pdf";
                    $data['viewname'] = 'report/pdf/head_wise_arrear_report_pdf';
                    $data['collection_date'] =  'Headwise Arrears on : ' . date('d/M/Y', strtotime($startdate));
                    $filename = $this->get_pdf_report($data);
                    echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
                } else {
                    $details_data = $report_data['data'];
                    $feecode_data = $report_data['feecodes'];
                    $collection_date =  'Headwise Arrears on : ' . date('d/M/Y', strtotime($startdate));
                    $totcolamt = 0;
                    $totvatamt = 0;
                    $netamount = 0;
                    $result_array = [];

                    if (isset($details_data) && !empty($details_data)) {
                        foreach ($details_data as $key1 => $feedata) {
                            foreach ($feedata as $key2 => $classdata) {
                                $classtotal = 0;
                                foreach ($classdata as $key3 => $collectiondata) {
                                    $ic = 0;
                                    if (isset($collectiondata) && !empty($collectiondata)) {
                                        foreach ($collectiondata as $rptdata) {
                                            $batchtotal = 0;
                                            $dataforexcel["FEE HEAD"]    =  $key1;
                                            $dataforexcel["CLASS"]       = $key2;
                                            $dataforexcel["BATCH"]       = $key3;
                                            $dataforexcel["Admission No."]       = $rptdata['Admn_No'];
                                            $dataforexcel["Student Name"]       = $rptdata['First_Name'];
                                            $dataforexcel["For Month"] = date('M Y', strtotime($rptdata['demand_date'] . '-01'));
                                            $dataforexcel["Amount"]       =  my_money_format_for_excel($rptdata['amt_paid']);
                                            $result_array[]               = $dataforexcel;
                                            $batchtotal += $rptdata['amt_paid'];
                                            $netamount   += $rptdata['amt_paid'];
                                        }
                                    }
                                    $classtotal += $batchtotal;
                                    // $netamount += $classtotal;
                                }
                            }
                        }
                        $total_array["Net Amount"] = $netamount;
                        $this->load->helper('sheet');
                        $file_rand_name = "head_wise_arrear_report_";
                        $filename_report = get_excel_report($result_array, $file_rand_name, $collection_date, $total_array);
                        echo json_encode(array('status' => 1, 'message' => base_url() . 'reports/sheets/' . $filename_report));
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'No Data Available'));
                    }
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
        ini_set('memory_limit', '32000M'); //boost the memory limit if it's low 
        ini_set("pcre.backtrack_limit", "5000000");

        $this->load->library('pdf'); //Load PDF Library
        $this->pdf->use_kwt = false;
        if ($orntn == 'L')
            $pdf = $this->pdf->load_wide(array('mode' => 'utf-8', 'format' => [310, 380], 'orientation' => 'L'));
        else $pdf = $this->pdf->load(); //Set Orientation
        date_default_timezone_set('Asia/Kolkata'); //timezone need to change according to country                    
        //render the view into HTML
        $html = $this->load->view($data['viewname'], $data, true);
        // return $html;
        $pdf->WriteHTML($html); //write the HTML into the PDF
        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); //save to file 
        //}
        return base_url($data['filename_report']);
    }
}
