<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Billing_controller
 *
 * @author chandrajith.edsys
 */
class Billing_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Billing_model', 'MBilling');
    }

    public function get_student_pack_billing($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $query = '';
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $query = $query . ' and pm.student_id=' . $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pack ID is required', 'data' => FALSE);
        }
        if (isset($params['pack_id']) && !empty($params['pack_id'])) {
            $query = $query . ' and pm.id=' . $params['pack_id'];
        }
        $dbparams[1] = $query;
        //        dev_export($dbparams);die;
        $packdetails = $this->MBilling->get_student_bill_data($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function studentpack_bill_select_oh($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $query = '';
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $query = $query . ' and pm.student_id=' . $params['studentid'];
        }
        if (isset($params['pack_id']) && !empty($params['pack_id'])) {
            $query = $query . ' and pm.id=' . $params['pack_id'];
        }
        $dbparams[1] = $query;
        //        dev_export($dbparams);die;
        $packdetails = $this->MBilling->studentpack_bill_select_oh($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function packdetailed($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['pack_id']) && !empty($params['pack_id'])) {
            $dbparams[1] = $params['pack_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pack ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $packdetails = $this->MBilling->get_pack_data($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //    public function bill_store() {
    //
    //        $data['template'] = 'bill/show_settings';
    //        $data['title'] = 'STORE SETTINGS';
    //        $data['sub_title'] = 'Advance Settings';
    //        $breadcrump = array(
    //            '0' => array(
    //                'link' => base_url('dashboard'),
    //                'title' => 'Home'),
    //            '1' => array(
    //                'title' => 'Settings',
    //                'link' => base_url()),
    //            '2' => array(
    //                'title' => 'Advance Settings')
    //        );
    //        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
    //
    //        $this->session->set_userdata('current_page', 'country');
    //        $this->session->set_userdata('current_parent', 'gen_sett');
    //
    //        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
    //            $formatted_data = array();
    //            if (isset($data['country_data']) && !empty($data['country_data'])) {
    //                foreach ($data['country_data'] as $country) {
    //                    $country_status = "";
    //                    if ($country['isactive'] == 1) {
    //                        $country_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
    //                        //$country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
    //                    } else {
    //                        $country_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\', this)" id="" class="js-switch"  /></a>';
    //                        //$country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
    //                    }
    //                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\',\'' . $country['country_abbr'] . '\',\'' . $country['currency_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $country['country_name'] . '" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
    //                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
    //                    $formatted_data[] = array($country['country_name'], $country['country_abbr'], $country['currency_name'], $country_status, $task_html);
    //                }
    //            }
    //
    //
    //            echo json_encode($formatted_data);
    //            return;
    //        } else {
    //            $this->load->view('template/home_template', $data);
    //        }
    //    }

    public function save_cashbill($param)
    {

        $student_data_raw = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['student_id']) && !empty($param['student_id'])) {
            $student_id = $param['student_id'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['packing_id']) && !empty($param['packing_id'])) {
            $packing_id = $param['packing_id'];
        } else {
            return array('status' => 0, 'message' => 'Pack ID data  is requried.', 'data' => FALSE);
        }
        if (isset($param['cashbill_data']) && !empty($param['cashbill_data'])) {
            $cashbill_data_raw = $param['cashbill_data'];
        } else {
            return array('status' => 0, 'message' => 'Cash bill data  is requried.', 'data' => FALSE);
        }

        if (isset($param['item_data']) && !empty($param['item_data'])) {
            $item_data_raw = $param['item_data'];
        } else {
            return array('status' => 0, 'message' => 'Item bill data  is requried.', 'data' => FALSE);
        }



        $cash_pay_details[] = json_decode($cashbill_data_raw, TRUE);
        $xml_data = xml_generator($cash_pay_details);

        $item_data_details = json_decode($item_data_raw, TRUE);
        $xml_item_data = xml_generator($item_data_details);

        //        dev_export($xml_item_data);die;
        $status = $this->MBilling->save_cashpay_details($student_id, $packing_id, $xml_data, $apikey, $xml_item_data);

        if (isset($status['STATUS']) && !empty($status['STATUS']) && $status['STATUS'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Cash data updated', 'billno' => $status['billno']);
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Cash Payment failed', 'studentid' => 0);
            }
        }
    }

    public function search_student_pack_billing($params = NULL)
    {
        $dbparams = array();
        //        return 1;
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['pack_data']) && !empty($params['pack_data'])) {
            $dbparams[1] = $params['pack_data'];
        } else {
            $dbparams[1] = NULL;
        }
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[2] = $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $packdetails = $this->MBilling->search_student_bill_data($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function bill_print_data($params = NULL)
    {
        $dbparams = array();


        $dbparams[0] = $params['API_KEY'];
        if (isset($params['bill_code']) && !empty($params['bill_code'])) {
            $dbparams[1] = $params['bill_code'];
        } else {
            $dbparams[1] = NULL;
        }

        $billdetails = $this->MBilling->get_bill_data($dbparams);


        $formatted_data = array();
        $ismaster = 0;
        $isstudent = 0;
        $isemp = 0;

        if ($billdetails) {
            $formatted_data['master_data']['sales_pack_id'] = $billdetails[0]['sales_pack_id'];
            $formatted_data['master_data']['billing_code'] = $billdetails[0]['payment_billing_code'];
            $formatted_data['master_data']['billing_date'] = $billdetails[0]['bill_date'];
            $formatted_data['master_data']['sub_total'] = $billdetails[0]['bill_sub_total'];
            $formatted_data['master_data']['discount_amount'] = $billdetails[0]['bill_discount'];
            $formatted_data['master_data']['tax_amount'] = $billdetails[0]['vat'];
            $formatted_data['master_data']['total_amount'] = $billdetails[0]['amt_before_round_off'];
            $formatted_data['master_data']['round_off'] = $billdetails[0]['bill_round_off'];
            $formatted_data['master_data']['final_total'] = $billdetails[0]['grand_total'];
            $formatted_data['master_data']['kit_name'] = $billdetails[0]['kit_name'];
            $formatted_data['master_data']['payment_mode_id'] = $billdetails[0]['payment_mode_id'];
            $formatted_data['master_data']['payment_mode'] = $billdetails[0]['payment_mode'];
            $formatted_data['master_data']['paid_amount'] = $billdetails[0]['paid_amount'];
            $formatted_data['master_data']['balance_amount_to_pay'] = $billdetails[0]['grand_total'] - $billdetails[0]['total_paid_amount'];

            $formatted_data['student_data']['Admn_No'] = $billdetails[0]['Admn_No'];
            $formatted_data['student_data']['Student_Name'] = $billdetails[0]['Student_Name'];
            $formatted_data['student_data']['Class'] = $billdetails[0]['class_name'];
            $formatted_data['student_data']['Division'] = $billdetails[0]['division'];
            $formatted_data['student_data']['Acdyear'] = $billdetails[0]['acd_year'];

            $formatted_data['employyee_data']['Emp_id'] = $billdetails[0]['Emp_id'];
            $formatted_data['employyee_data']['Emp_code'] = $billdetails[0]['Emp_code'];
            $formatted_data['employyee_data']['Emp_Name'] = $billdetails[0]['Emp_Name'];

            foreach ($billdetails as $bills) {
                $formatted_data['data'][] = array(
                    'bill_detail_id' => $bills['id'],
                    'item_id' => $bills['item_id'],
                    'item_name' => $bills['item_name'],
                    'qty' => $bills['qty'],
                    'price' => $bills['price'],
                    'sub_total' => $bills['sub_total'],
                    'discount_type' => $bills['discount_type'],
                    'discount_value' => $bills['discount_value'],
                    'discount_amount' => $bills['discount_amount'],
                    'sub_total_after_discount' => $bills['sub_total_after_discount'],
                    'tax_type' => $bills['tax_type'],
                    'tax_percent' => $bills['tax_percent'],
                    'tax_amount' => $bills['tax_amount'],
                    'final_total' => $bills['final_total']
                );
            }
        }

        if (!empty($billdetails) && is_array($billdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $formatted_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function bill_cancel($param)
    {

        $apikey = $param['API_KEY'];
        if (isset($param['bill_masterid']) && !empty($param['bill_masterid'])) {
            $bill_masterid = $param['bill_masterid'];
        } else {
            return array('status' => 0, 'message' => 'BILL ID  is requried.', 'data' => FALSE);
        }
        if (isset($param['reason']) && !empty($param['reason'])) {
            $reason = $param['reason'];
        } else {
            return array('status' => 0, 'message' => 'Reason is requried.', 'data' => FALSE);
        }

        $status = $this->MBilling->bill_cancel($apikey, $bill_masterid, $reason);
        //        dev_export($status);
        //        die;
        if (isset($status['STATUS']) && !empty($status['STATUS']) && $status['STATUS'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Bill Cancel updated', 'billcode' => $status['billcode']);
        } else {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['error_messages']);
            } else {
                if (isset($status['MSG']) && !empty($status['MSG'])) {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
                } else {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => 'Bill Cancel failed');
                }
            }
        }
    }


    public function voucher_cancel($param)
    {

        $apikey = $param['API_KEY'];

        if (isset($param['payment_id']) && !empty($param['payment_id'])) {
            $payment_id = $param['payment_id'];
        } else {
            return array('status' => 0, 'message' => 'BILL ID  is requried.', 'data' => FALSE);
        }
        if (isset($param['bill_masterid']) && !empty($param['bill_masterid'])) {
            $bill_masterid = $param['bill_masterid'];
        } else {
            return array('status' => 0, 'message' => 'BILL ID  is requried.', 'data' => FALSE);
        }
        if (isset($param['reason']) && !empty($param['reason'])) {
            $reason = $param['reason'];
        } else {
            return array('status' => 0, 'message' => 'Reason is requried.', 'data' => FALSE);
        }

        $status = $this->MBilling->voucher_cancel($apikey, $payment_id, $bill_masterid, $reason);
        //        dev_export($status);
        //        die;
        if (isset($status['STATUS']) && !empty($status['STATUS']) && $status['STATUS'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Bill Cancel updated', 'billcode' => $status['billcode']);
        } else {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['error_messages']);
            } else {
                if (isset($status['MSG']) && !empty($status['MSG'])) {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
                } else {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => 'Bill Cancel failed');
                }
            }
        }
    }

    public function update_online_delivery_details($param)
    {

        $dbparams[0] = $param['API_KEY'];
        if (isset($param['pack_id']) && !empty($param['pack_id'])) {
            $dbparams[1] = $param['pack_id'];
        } else {
            return array('status' => 0, 'message' => 'PACK ID  is requried.', 'data' => FALSE);
        }
        if (isset($param['payment_status']) && !empty($param['payment_status'])) {
            $dbparams[2] = $param['payment_status'];
        } else {
            return array('status' => 0, 'message' => 'Payment Status is requried.', 'data' => FALSE);
        }
        if (isset($param['payment_details']) && !empty($param['payment_details'])) {
            $dbparams[3] = $param['payment_details'];
        } else {
            return array('status' => 0, 'message' => 'Payment Details is requried.', 'data' => FALSE);
        }
        if (isset($param['payment_amount']) && !empty($param['payment_amount'])) {
            $dbparams[4] = $param['payment_amount'];
        } else {
            return array('status' => 0, 'message' => 'Payment Amount is requried.', 'data' => FALSE);
        }


        $status = $this->MBilling->update_online_delivery_details($dbparams);
        //        dev_export($status);
        //        die;
        if (isset($status['STATUS']) && !empty($status['STATUS']) && $status['STATUS'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Updated online delivery');
        } else {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['error_messages']);
            } else {
                if (isset($status['MSG']) && !empty($status['MSG'])) {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
                } else {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => 'Update online delivery');
                }
            }
        }
    }

    public function get_payment_details($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['pack_id']) && !empty($params['pack_id'])) {
            $dbparams[1] =  $params['pack_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pack ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $packdetails = $this->MBilling->get_payment_details($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
