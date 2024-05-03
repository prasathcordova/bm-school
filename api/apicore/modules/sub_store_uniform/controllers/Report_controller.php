<?php

/**
 * Description of Report_controller
 *
 * @author aju.docme
 */
class Report_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Report_model', 'MReport');
    }

    public function Sales_Return_Report($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['storeid']) && !empty($params['storeid'])) {
            $storeid = $params['storeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store data is required', 'data' => FALSE);
        }
        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $start_date = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report start date is required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $end_date = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report end date is required', 'data' => FALSE);
        }
        if (isset($params['type']) && !empty($params['type'])) {
            $type = $params['type'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Type is required', 'data' => FALSE);
        }
        $sale_return_data_raw = $this->MReport->get_sale_return_raw_data($apikey, $storeid, $start_date, $end_date, $type);
        if (!empty($sale_return_data_raw)) {
            $formatted_data = $this->format_return_report($sale_return_data_raw);
            return array('data_status' => 1, 'error_status' => 0, 'data' => $formatted_data, 'message' => 'Report data loaded');
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'message' => 'No data available for the provided parameters');
        }
    }

    private function format_return_report($report_data)
    {
        $report_date = array();
        $formatted_data = array();

        if (isset($report_data) && !empty($report_data)) {
            foreach ($report_data as $data) {
                $report_date_avail = date('Y-m-d', strtotime($data['rtn_date']));
                if (in_array($report_date_avail, $report_date)) {
                    $formatted_data[$report_date_avail][] = $data;
                } else {
                    $report_data[] = $report_date_avail;
                    $formatted_data[$report_date_avail][] = $data;
                }
            }
        }
        return $formatted_data;
    }

    public function Sales_Voucher_wise_Report($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['storeid']) && !empty($params['storeid'])) {
            $storeid = $params['storeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store data is required', 'data' => FALSE);
        }
        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $start_date = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report start date is required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $end_date = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report end date is required', 'data' => FALSE);
        }

        $sale_data_raw = $this->MReport->get_sale_voucher_wise_raw_data($apikey, $storeid, $start_date, $end_date);
        if (!empty($sale_data_raw)) {
            $formatted_data = $this->format_sale_report($sale_data_raw);
            return array('data_status' => 1, 'error_status' => 0, 'data' => $formatted_data, 'message' => 'Report data loaded');
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'message' => 'No data available for the provided parameters');
        }
    }

    private function format_sale_report($report_data)
    {
        $report_date = array();
        $bill_data_id = 0;
        $bill_data = array();
        $formatted_data = array();
        if (isset($report_data) && !empty($report_data)) {
            foreach ($report_data as $data) {
                $report_date_avail = date('Y-m-d', strtotime($data['bill_date']));
                $bill_data_id = $data['billing_code'];

                if (in_array($report_date_avail, $report_date)) {
                    if (in_array($bill_data_id, $bill_data)) {
                        //$formatted_data[$report_date_avail][$bill_data_id][] = $data;
                        $formatted_data[$report_date_avail][$bill_data_id]['master_data']['billing_type'] = $data['billing_type'];
                        $formatted_data[$report_date_avail][$bill_data_id]['master_data']['bill_master_id'] = $data['billing_master_id'];;
                        $formatted_data[$report_date_avail][$bill_data_id]['item_data'][] = $data;
                    } else {
                        $report_data[] = $report_date_avail;
                        $bill_data[] = $bill_data_id;
                        $formatted_data[$report_date_avail][$bill_data_id]['master_data']['billing_type'] = $data['billing_type'];
                        $formatted_data[$report_date_avail][$bill_data_id]['master_data']['bill_master_id'] = $data['billing_master_id'];;
                        $formatted_data[$report_date_avail][$bill_data_id]['item_data'][] = $data;
                        // $formatted_data[$report_date_avail][$bill_data_id][] = $data;
                    }
                } else {
                    if (in_array($bill_data_id, $bill_data)) {
                        //$formatted_data[$report_date_avail][$bill_data_id][] = $data;
                        $formatted_data[$report_date_avail][$bill_data_id]['master_data']['billing_type'] = $data['billing_type'];
                        $formatted_data[$report_date_avail][$bill_data_id]['master_data']['bill_master_id'] = $data['billing_master_id'];;
                        $formatted_data[$report_date_avail][$bill_data_id]['item_data'][] = $data;
                    } else {
                        $report_data[] = $report_date_avail;
                        $bill_data[] = $bill_data_id;
                        //$formatted_data[$report_date_avail][$bill_data_id][] = $data;
                        $formatted_data[$report_date_avail][$bill_data_id]['master_data']['billing_type'] = $data['billing_type'];
                        $formatted_data[$report_date_avail][$bill_data_id]['master_data']['bill_master_id'] = $data['billing_master_id'];;
                        $formatted_data[$report_date_avail][$bill_data_id]['item_data'][] = $data;
                    }
                }
            }
        }
        return $formatted_data;
    }

    public function Sales_Item_wise_Report($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['storeid']) && !empty($params['storeid'])) {
            $storeid = $params['storeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store data is required', 'data' => FALSE);
        }
        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $start_date = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report start date is required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $end_date = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report end date is required', 'data' => FALSE);
        }
        if (isset($params['type']) && !empty($params['type'])) {
            $type = $params['type'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report sale type  is required', 'data' => FALSE);
        }

        $sale_data_raw = $this->MReport->get_sale_item_wise_raw_data($apikey, $storeid, $start_date, $end_date, $type);

        $itemid = array();
        $formatted_array = array();

        $total_qty = 0;
        $sub_total = 0;
        $vat = 0;
        $final_total = 0;
        //        dev_export($sale_data_raw);die;
        if ($type == 3) {
            foreach ($sale_data_raw as $value) {
                if (in_array($value['item_id'], $itemid)) {
                    $itemiddata = $value['item_id'];
                    $formatted_array[$itemiddata] = array(
                        'item_id' => $value['item_id'],
                        'item_name' => $value['item_name'],
                        'edition_name' => $value['edition_name'],
                        'qty' => $formatted_array[$itemiddata]['qty'] + $value['qty'],
                        'vat_amount' => $formatted_array[$itemiddata]['vat_amount'] + $value['vat_amount'],
                        'total_amount' => $formatted_array[$itemiddata]['total_amount'] + $value['total_amount'],
                        'final_amount' => $formatted_array[$itemiddata]['final_amount'] + $value['final_amount'],
                        'discounts' => $formatted_array[$itemiddata]['discounts'] + $value['discounts'],
                        'round_off' => $value['round_off'],
                        'total_discount' => $value['total_discount'],
                        'total_tax' => $value['total_tax'],
                        'total_bill_amount' => $value['total_bill_amount'],
                        'total_final_amount' => $value['total_final_amount'],
                        'report_type' => $value['report_type'],
                    );
                } else {
                    $itemid[] = $value['item_id'];
                    $formatted_array[$value['item_id']] = array(
                        'item_id' => $value['item_id'],
                        'item_name' => $value['item_name'],
                        'edition_name' => $value['edition_name'],
                        'qty' => $value['qty'],
                        'vat_amount' => $value['vat_amount'],
                        'total_amount' => $value['total_amount'],
                        'final_amount' => $value['final_amount'],
                        'discounts' => $value['discounts'],
                        'round_off' => $value['round_off'],
                        'total_discount' => $value['total_discount'],
                        'total_tax' => $value['total_tax'],
                        'total_bill_amount' => $value['total_bill_amount'],
                        'total_final_amount' => $value['total_final_amount'],
                        'report_type' => $value['report_type'],
                    );
                }
            }
        } else {
            foreach ($sale_data_raw as $value) {
                if (in_array($value['item_id'], $itemid)) {
                    $itemiddata = $value['item_id'];
                    $formatted_array[$itemiddata] = array(
                        'item_id' => $value['item_id'],
                        'item_name' => $value['item_name'],
                        'edition_name' => $value['edition_name'],
                        'qty' => $formatted_array[$itemiddata]['qty'] + $value['qty'],
                        'vat_amount' => $formatted_array[$itemiddata]['vat_amount'] + $value['vat_amount'],
                        'total_amount' => $formatted_array[$itemiddata]['total_amount'] + $value['total_amount'],
                        'final_amount' => $formatted_array[$itemiddata]['final_amount'] + $value['final_amount'],
                        'discounts' => $formatted_array[$itemiddata]['discounts'] + $value['discounts'],
                        'round_off' => $value['round_off'],
                        'report_type' => $value['report_type'],
                    );
                } else {
                    $itemid[] = $value['item_id'];
                    $formatted_array[$value['item_id']] = array(
                        'item_id' => $value['item_id'],
                        'item_name' => $value['item_name'],
                        'edition_name' => $value['edition_name'],
                        'qty' => $value['qty'],
                        'vat_amount' => $value['vat_amount'],
                        'total_amount' => $value['total_amount'],
                        'final_amount' => $value['final_amount'],
                        'discounts' => $value['discounts'],
                        'round_off' => $value['round_off'],
                        'report_type' => $value['report_type'],
                    );
                }
            }
        }


        if (!empty($formatted_array)) {
            return array('data_status' => 1, 'error_status' => 0, 'data' => $formatted_array, 'message' => 'Report data loaded');
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'message' => 'No data available for the provided parameters');
        }
    }

    public function Sales_Item_wise_summary_Report($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['storeid']) && !empty($params['storeid'])) {
            $storeid = $params['storeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store data is required', 'data' => FALSE);
        }
        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $start_date = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report start date is required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $end_date = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report end date is required', 'data' => FALSE);
        }
        if (isset($params['type']) && !empty($params['type'])) {
            $type = $params['type'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Sales type  is required', 'data' => FALSE);
        }

        $sale_return_data_raw = $this->MReport->get_sale_item_wise_summary_raw_data($apikey, $storeid, $start_date, $end_date, $type);
        if (!empty($sale_return_data_raw)) {
            $formatted_data = $this->format_item_wise_summary_report($sale_return_data_raw);
            return array('data_status' => 1, 'error_status' => 0, 'data' => $formatted_data, 'message' => 'Report data loaded');
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'message' => 'No data available for the provided parameters');
        }
    }

    private function format_item_wise_summary_report($report_data)
    {
        $report_date = array();
        $formatted_data = array();
        if (isset($report_data) && !empty($report_data)) {
            foreach ($report_data as $data) {
                $report_date_avail = $data['type_id'];
                if (in_array($report_date_avail, $report_date)) {
                    $formatted_data[$data['itemtype_name']][] = $data;
                } else {
                    $report_data[] = $report_date_avail;
                    $formatted_data[$data['itemtype_name']][] = $data;
                }
            }
        }
        return $formatted_data;
    }

    public function billed_but_not_delivered_Item_wise_summary_Report($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['storeid']) && !empty($params['storeid'])) {
            $storeid = $params['storeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store data is required', 'data' => FALSE);
        }
        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $start_date = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report start date is required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $end_date = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report end date is required', 'data' => FALSE);
        }

        $sale_return_data_raw = $this->MReport->get_billed_but_not_delivered_item_wise_summary_raw_data($apikey, $storeid, $start_date, $end_date);

        if (!empty($sale_return_data_raw)) {
            $formatted_data = $this->billed_but_not_delivered_format_item_wise_summary_report($sale_return_data_raw);
            return array('data_status' => 1, 'error_status' => 0, 'data' => $formatted_data, 'message' => 'Report data loaded');
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'message' => 'No data available for the provided parameters');
        }
    }

    private function billed_but_not_delivered_format_item_wise_summary_report($report_data)
    {
        $report_date = array();
        $formatted_data = array();
        if (isset($report_data) && !empty($report_data)) {
            foreach ($report_data as $data) {
                $report_date_avail = $data['type_id'];
                if (in_array($report_date_avail, $report_date)) {
                    $formatted_data[$data['itemtype_name']][] = $data;
                } else {
                    $report_data[] = $report_date_avail;
                    $formatted_data[$data['itemtype_name']][] = $data;
                }
            }
        }
        return $formatted_data;
    }


    //collection report
    public function collection_Report($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['storeid']) && !empty($params['storeid'])) {
            $storeid = $params['storeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store data is required', 'data' => FALSE);
        }
        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $start_date = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report start date is required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $end_date = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report end date is required', 'data' => FALSE);
        }
        if (isset($params['type']) && !empty($params['type'])) {
            $type = $params['type'];
        } else {
            $type = NULL;
        }

        $sale_data_raw = $this->MReport->get_collection_report_data($apikey, $storeid, $start_date, $end_date, $type);
        if (!empty($sale_data_raw)) {
            return array('data_status' => 1, 'error_status' => 0, 'data' => $sale_data_raw, 'message' => 'Report data loaded');
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'message' => 'No data available for the provided parameters');
        }
    }

    //collection report user wise
    public function collection_Report_User_wise($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['storeid']) && !empty($params['storeid'])) {
            $storeid = $params['storeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store data is required', 'data' => FALSE);
        }
        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $start_date = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report start date is required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $end_date = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report end date is required', 'data' => FALSE);
        }

        $sale_data_raw = $this->MReport->get_collection_report_user_wise_data($apikey, $storeid, $start_date, $end_date);
        if (!empty($sale_data_raw)) {
            $formatted_data = $this->format_collection_user_wise_report($sale_data_raw);
            return array('data_status' => 1, 'error_status' => 0, 'data' => $formatted_data, 'message' => 'Report data loaded');
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'message' => 'No data available for the provided parameters');
        }
    }
    //summary collection report userwise
    public function summary_collection_Report_User_wise($params)
    {

        $apikey = $params['API_KEY'];
        if (isset($params['storeid']) && !empty($params['storeid'])) {
            $storeid = $params['storeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Store data is required', 'data' => FALSE);
        }
        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $start_date = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report start date is required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $end_date = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Report end date is required', 'data' => FALSE);
        }

        $sale_data_raw = $this->MReport->get_summary_collection_report_user_wise_data($apikey, $storeid, $start_date, $end_date);
        if (!empty($sale_data_raw)) {
            $formatted_data = $this->format_summary_collection_user_wise_report($sale_data_raw);
            return array('data_status' => 1, 'error_status' => 0, 'data' => $formatted_data, 'message' => 'Report data loaded');
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => FALSE, 'message' => 'No data available for the provided parameters');
        }
    }

    private function format_collection_user_wise_report($report_data)
    {
        $report_emp = array();
        $formatted_data = array();
        $empid = 0;
        if (isset($report_data) && !empty($report_data)) {
            foreach ($report_data as $data) {
                $empid = $data['emp_id'];
                if (in_array($report_emp, $empid)) {
                    $formatted_data[$empid]['data'][] = $data;
                } else {
                    $report_emp[] = $empid;
                    $formatted_data[$empid]['data'][] = $data;
                    $formatted_data[$empid]['personal']['emp_id'] = $empid;
                    $formatted_data[$empid]['personal']['emp_name'] = $data['emp_name'];
                }
            }
        }
        return $formatted_data;
    }

    private function format_summary_collection_user_wise_report($report_data)
    {
        $report_emp = array();
        $formatted_data = array();
        $empid = 0;
        if (isset($report_data) && !empty($report_data)) {

            foreach ($report_data as $data) {
                $empid = $data['emp_id'];
                $formatted_data[$empid]['name'] = $data['emp_name'];
                $formatted_data[$empid][$data['code']] = $data['final_total'];
            }

            return $formatted_data;
        }
    }



    public function get_all_stock_report_data($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['store_id'])) {
            $storeid = $params['store_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'store id is required', 'data' => FALSE);
        }
        if (isset($params['from_date'])) {
            $from_date = $params['from_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date is required', 'data' => FALSE);
        }
        if (isset($params['to_date'])) {
            $to_date = $params['to_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date is required', 'data' => FALSE);
        }
        if (isset($params['type'])) {
            $type = $params['type'];
        } else {
            $type = 1;
        }

        //$query_string = " im.isactive = 1";
        $query_string = " im.isactive = 1 and im.item_id NOT IN(SELECT DISTINCT parent_item_id FROM docme_uniform_store.tbl_item_master WHERE isactive=1 and parent_item_id is not NULL)";
        $count = ITEM_SEARCH_DEFAULT_DISPLAY_COUNT;

        $opening_stock = $this->MReport->opening_stock_data($storeid, $from_date, $apikey);
        //        dev_export($opening_stock);die;
        $active_items = $this->MReport->get_item_details($apikey, $query_string, $count);
        $stock_data_current = $this->MReport->stock_data($storeid, $from_date, $to_date, $apikey);

        //Sale Data
        $sale_data = $this->MReport->get_sale_data($storeid, $from_date, $to_date, $apikey);
        //Specimen Issue data
        $specimen_issue_data = $this->MReport->get_specimen_issue_data($storeid, $from_date, $to_date, $apikey);
        //Specimen return data
        $specimen_return_data = $this->MReport->get_specimen_return_data($storeid, $from_date, $to_date, $apikey);
        //sale return
        $sale_return = $this->MReport->get_sale_return_data($storeid, $from_date, $to_date, $apikey);


        $formatted_data = $this->format_stock_report_all($opening_stock, $stock_data_current, $active_items, $sale_data, $sale_return, $specimen_issue_data, $specimen_return_data);

        $final_formatted_data = $this->calculate_stock($formatted_data);

        if ($type == 2) {
            $final_formatted_data = $this->format_for_summary_report($final_formatted_data);
        }

        if ($final_formatted_data) {
            return array('data_status' => 1, 'data' => $final_formatted_data, 'message' => 'Report generated');
        } else {
            return array('data_status' => 0, 'data' => FALSE, 'message' => 'No data available to process');
        }
    }

    private function format_for_summary_report($report_data)
    {
        if (isset($report_data) && !empty($report_data)) {
            $grand_total_data = array();
            $formatted_data = array();
            foreach ($report_data as $data) {
                $type = $data['item_data']['type_id'];
                if (isset($formatted_data[$type]) && !empty($formatted_data[$type])) {
                    $formatted_data[$type]['type_summary']['opening_balance'] = $formatted_data[$type]['type_summary']['opening_balance'] + $data['stock_data']['opening_balance'];
                    $formatted_data[$type]['type_summary']['purchase'] = $formatted_data[$type]['type_summary']['purchase'] + $data['stock_data']['purchase'];
                    $formatted_data[$type]['type_summary']['sale_return'] = $formatted_data[$type]['type_summary']['sale_return'] + $data['stock_data']['sale_return'];
                    $formatted_data[$type]['type_summary']['transfer_in'] = $formatted_data[$type]['type_summary']['transfer_in'] + $data['stock_data']['transfer_in'];
                    $formatted_data[$type]['type_summary']['spec_return'] = $formatted_data[$type]['type_summary']['spec_return'] + $data['stock_data']['spec_return'];
                    $formatted_data[$type]['type_summary']['purchase_return'] = $formatted_data[$type]['type_summary']['purchase_return'] + $data['stock_data']['purchase_return'];
                    $formatted_data[$type]['type_summary']['sale'] = $formatted_data[$type]['type_summary']['sale'] + $data['stock_data']['sale'];
                    $formatted_data[$type]['type_summary']['transfer_out'] = $formatted_data[$type]['type_summary']['transfer_out'] + $data['stock_data']['transfer_out'];
                    $formatted_data[$type]['type_summary']['spec_issue'] = $formatted_data[$type]['type_summary']['spec_issue'] + $data['stock_data']['spec_issue'];
                    $formatted_data[$type]['type_summary']['closing_stock'] = $formatted_data[$type]['type_summary']['closing_stock'] + $data['stock_data']['closing_stock'];
                    $count = count($formatted_data[$type]['items']);
                    $formatted_data[$type]['items'][$count]['item_data'] = $data['item_data'];
                    $formatted_data[$type]['items'][$count]['stock_data'] = $data['stock_data'];

                    if (isset($grand_total_data['opening_balance']) && !empty($grand_total_data['opening_balance'])) {
                        $grand_total_data['opening_balance'] = $grand_total_data['opening_balance'] + $data['stock_data']['opening_balance'];
                    } else {
                        $grand_total_data['opening_balance'] = $data['stock_data']['opening_balance'];
                    }
                    if (isset($grand_total_data['purchase']) && !empty($grand_total_data['purchase'])) {
                        $grand_total_data['purchase'] = $grand_total_data['purchase'] + $data['stock_data']['purchase'];
                    } else {
                        $grand_total_data['purchase'] = $data['stock_data']['purchase'];
                    }
                    if (isset($grand_total_data['sale_return']) && !empty($grand_total_data['sale_return'])) {
                        $grand_total_data['sale_return'] = $grand_total_data['sale_return'] + $data['stock_data']['sale_return'];
                    } else {
                        $grand_total_data['sale_return'] = $data['stock_data']['sale_return'];
                    }
                    if (isset($grand_total_data['transfer_in']) && !empty($grand_total_data['transfer_in'])) {
                        $grand_total_data['transfer_in'] = $grand_total_data['transfer_in'] + $data['stock_data']['transfer_in'];
                    } else {
                        $grand_total_data['transfer_in'] = $data['stock_data']['transfer_in'];
                    }
                    if (isset($grand_total_data['spec_return']) && !empty($grand_total_data['spec_return'])) {
                        $grand_total_data['spec_return'] = $grand_total_data['spec_return'] + $data['stock_data']['spec_return'];
                    } else {
                        $grand_total_data['spec_return'] = $data['stock_data']['spec_return'];
                    }
                    if (isset($grand_total_data['purchase_return']) && !empty($grand_total_data['purchase_return'])) {
                        $grand_total_data['purchase_return'] = $grand_total_data['purchase_return'] + $data['stock_data']['purchase_return'];
                    } else {
                        $grand_total_data['purchase_return'] = $data['stock_data']['purchase_return'];
                    }
                    if (isset($grand_total_data['sale']) && !empty($grand_total_data['sale'])) {
                        $grand_total_data['sale'] = $grand_total_data['sale'] + $data['stock_data']['sale'];
                    } else {
                        $grand_total_data['sale'] = $data['stock_data']['sale'];
                    }
                    if (isset($grand_total_data['transfer_out']) && !empty($grand_total_data['transfer_out'])) {
                        $grand_total_data['transfer_out'] = $grand_total_data['transfer_out'] + $data['stock_data']['transfer_out'];
                    } else {
                        $grand_total_data['transfer_out'] = $data['stock_data']['transfer_out'];
                    }
                    if (isset($grand_total_data['spec_issue']) && !empty($grand_total_data['spec_issue'])) {
                        $grand_total_data['spec_issue'] = $grand_total_data['spec_issue'] + $data['stock_data']['spec_issue'];
                    } else {
                        $grand_total_data['spec_issue'] = $data['stock_data']['spec_issue'];
                    }
                    if (isset($grand_total_data['closing_stock']) && !empty($grand_total_data['closing_stock'])) {
                        $grand_total_data['closing_stock'] = $grand_total_data['closing_stock'] + $data['stock_data']['closing_stock'];
                    } else {
                        $grand_total_data['closing_stock'] = $data['stock_data']['closing_stock'];
                    }
                } else {
                    $formatted_data[$type] = array(
                        'type_data' => array(
                            'type_id' => $data['item_data']['type_id'],
                            'type_name' => $data['item_data']['itemtype_name']
                        ),
                        'type_summary' => array(
                            'opening_balance' => $data['stock_data']['opening_balance'],
                            'purchase' => $data['stock_data']['purchase'],
                            'sale_return' => $data['stock_data']['sale_return'],
                            'transfer_in' => $data['stock_data']['transfer_in'],
                            'spec_return' => $data['stock_data']['spec_return'],
                            'purchase_return' => $data['stock_data']['purchase_return'],
                            'sale' => $data['stock_data']['sale'],
                            'transfer_out' => $data['stock_data']['transfer_out'],
                            'spec_issue' => $data['stock_data']['spec_issue'],
                            'closing_stock' => $data['stock_data']['closing_stock'],
                        )
                    );
                    $formatted_data[$type]['items'][] = array(
                        'item_data' => $data['item_data'],
                        'stock_data' => $data['stock_data']
                    );
                    if (isset($grand_total_data['opening_balance']) && !empty($grand_total_data['opening_balance'])) {
                        $grand_total_data['opening_balance'] = $grand_total_data['opening_balance'] + $data['stock_data']['opening_balance'];
                    } else {
                        $grand_total_data['opening_balance'] = $data['stock_data']['opening_balance'];
                    }
                    if (isset($grand_total_data['purchase']) && !empty($grand_total_data['purchase'])) {
                        $grand_total_data['purchase'] = $grand_total_data['purchase'] + $data['stock_data']['purchase'];
                    } else {
                        $grand_total_data['purchase'] = $data['stock_data']['purchase'];
                    }
                    if (isset($grand_total_data['sale_return']) && !empty($grand_total_data['sale_return'])) {
                        $grand_total_data['sale_return'] = $grand_total_data['sale_return'] + $data['stock_data']['sale_return'];
                    } else {
                        $grand_total_data['sale_return'] = $data['stock_data']['sale_return'];
                    }
                    if (isset($grand_total_data['transfer_in']) && !empty($grand_total_data['transfer_in'])) {
                        $grand_total_data['transfer_in'] = $grand_total_data['transfer_in'] + $data['stock_data']['transfer_in'];
                    } else {
                        $grand_total_data['transfer_in'] = $data['stock_data']['transfer_in'];
                    }
                    if (isset($grand_total_data['spec_return']) && !empty($grand_total_data['spec_return'])) {
                        $grand_total_data['spec_return'] = $grand_total_data['spec_return'] + $data['stock_data']['spec_return'];
                    } else {
                        $grand_total_data['spec_return'] = $data['stock_data']['spec_return'];
                    }
                    if (isset($grand_total_data['purchase_return']) && !empty($grand_total_data['purchase_return'])) {
                        $grand_total_data['purchase_return'] = $grand_total_data['purchase_return'] + $data['stock_data']['purchase_return'];
                    } else {
                        $grand_total_data['purchase_return'] = $data['stock_data']['purchase_return'];
                    }
                    if (isset($grand_total_data['sale']) && !empty($grand_total_data['sale'])) {
                        $grand_total_data['sale'] = $grand_total_data['sale'] + $data['stock_data']['sale'];
                    } else {
                        $grand_total_data['sale'] = $data['stock_data']['sale'];
                    }
                    if (isset($grand_total_data['transfer_out']) && !empty($grand_total_data['transfer_out'])) {
                        $grand_total_data['transfer_out'] = $grand_total_data['transfer_out'] + $data['stock_data']['transfer_out'];
                    } else {
                        $grand_total_data['transfer_out'] = $data['stock_data']['transfer_out'];
                    }
                    if (isset($grand_total_data['spec_issue']) && !empty($grand_total_data['spec_issue'])) {
                        $grand_total_data['spec_issue'] = $grand_total_data['spec_issue'] + $data['stock_data']['spec_issue'];
                    } else {
                        $grand_total_data['spec_issue'] = $data['stock_data']['spec_issue'];
                    }
                    if (isset($grand_total_data['closing_stock']) && !empty($grand_total_data['closing_stock'])) {
                        $grand_total_data['closing_stock'] = $grand_total_data['closing_stock'] + $data['stock_data']['closing_stock'];
                    } else {
                        $grand_total_data['closing_stock'] = $data['stock_data']['closing_stock'];
                    }
                }
            }
            $final_formatted = array(
                'formatted_data' => $formatted_data,
                'grand_total_data' => $grand_total_data
            );
            return $final_formatted;
        } else {
            return FALSE;
        }
    }

    private function format_stock_report_all($opening_stock, $stock_data, $item_list, $sale_data, $sale_return, $specimen_issue_data, $specimen_return_data)
    {
        $formatted_data = array();
        if (isset($item_list) && !empty($item_list)) {
            foreach ($item_list as $items) {
                $formatted_data[$items['item_id']]['item_data'] = $items;
                if (isset($opening_stock) && !empty($opening_stock)) {
                    $flag1 = 0;
                    foreach ($opening_stock as $ostock) {
                        if ($ostock['itemid'] == $items['item_id']) {
                            //                            dev_export($ostock);
                            if ($ostock['transaction_type_id'] == 1 || $ostock['transaction_type_id'] == 3 || $ostock['transaction_type_id'] == 4 || $ostock['transaction_type_id'] == 1007) {
                                if (isset($formatted_data[$items['item_id']]['stock_data']['opening_balance'])) {
                                    $formatted_data[$items['item_id']]['stock_data']['opening_balance'] = $formatted_data[$items['item_id']]['stock_data']['opening_balance'] + $ostock['stock'];
                                } else {
                                    $formatted_data[$items['item_id']]['stock_data']['opening_balance'] = $ostock['stock'];
                                }
                            } else if ($ostock['transaction_type_id'] == 2 || $ostock['transaction_type_id'] == 5 || $ostock['transaction_type_id'] == 6) {
                                if (isset($formatted_data[$items['item_id']]['stock_data']['opening_balance'])) {
                                    $formatted_data[$items['item_id']]['stock_data']['opening_balance'] = $formatted_data[$items['item_id']]['stock_data']['opening_balance'] - $ostock['stock'];
                                } else {
                                    $formatted_data[$items['item_id']]['stock_data']['opening_balance'] = 0 - $ostock['stock'];
                                }
                            }
                            $flag1 = 1;
                        }
                    }
                    if ($flag1 == 0) {
                        $formatted_data[$items['item_id']]['stock_data']['opening_balance'] = 0;
                    }
                } else {
                    $formatted_data[$items['item_id']]['stock_data']['opening_balance'] = 0;
                }

                //                dev_export($formatted_data);die;
                if (isset($stock_data) && !empty($stock_data)) {
                    if (isset($stock_data) && !empty($stock_data)) {
                        $flag1 = 0;
                        foreach ($stock_data as $stock) {
                            if ($stock['itemid'] == $items['item_id']) {
                                if ($stock['transaction_type_id'] == 4) {
                                    $formatted_data[$items['item_id']]['stock_data']['opening_balance'] = $stock['stock'];
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase'])))
                                        $formatted_data[$items['item_id']]['stock_data']['purchase'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['sale_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_in']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_in'])))
                                        $formatted_data[$items['item_id']]['stock_data']['transfer_in'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['spec_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['purchase_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale'])))
                                        $formatted_data[$items['item_id']]['stock_data']['sale'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_out']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_out'])))
                                        $formatted_data[$items['item_id']]['stock_data']['transfer_out'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_issue']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_issue'])))
                                        $formatted_data[$items['item_id']]['stock_data']['spec_issue'] = 0;
                                } else if ($stock['transaction_type_id'] == 1) {
                                    if (isset($formatted_data[$items['item_id']]['stock_data']['purchase']) && $formatted_data[$items['item_id']]['stock_data']['purchase'] > 0) {
                                        $formatted_data[$items['item_id']]['stock_data']['purchase'] = $formatted_data[$items['item_id']]['stock_data']['purchase'] + $stock['stock'];
                                    } else {
                                        $formatted_data[$items['item_id']]['stock_data']['purchase'] = $stock['stock'];
                                    }
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['sale_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_in']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_in'])))
                                        $formatted_data[$items['item_id']]['stock_data']['transfer_in'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['spec_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['purchase_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale'])))
                                        $formatted_data[$items['item_id']]['stock_data']['sale'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_out']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_out'])))
                                        $formatted_data[$items['item_id']]['stock_data']['transfer_out'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_issue']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_issue'])))
                                        $formatted_data[$items['item_id']]['stock_data']['spec_issue'] = 0;
                                } else if ($stock['transaction_type_id'] == 2) {
                                    if (isset($formatted_data[$items['item_id']]['stock_data']['purchase_return']) && $formatted_data[$items['item_id']]['stock_data']['purchase_return'] > 0) {
                                        $formatted_data[$items['item_id']]['stock_data']['purchase_return'] = $formatted_data[$items['item_id']]['stock_data']['purchase_return'] + $stock['stock'];
                                    } else {
                                        $formatted_data[$items['item_id']]['stock_data']['purchase_return'] = $stock['stock'];
                                    }
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase'])))
                                        $formatted_data[$items['item_id']]['stock_data']['purchase'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['sale_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_in']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_in'])))
                                        $formatted_data[$items['item_id']]['stock_data']['transfer_in'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['spec_return'] = 0;

                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale'])))
                                        $formatted_data[$items['item_id']]['stock_data']['sale'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_out']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_out'])))
                                        $formatted_data[$items['item_id']]['stock_data']['transfer_out'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_issue']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_issue'])))
                                        $formatted_data[$items['item_id']]['stock_data']['spec_issue'] = 0;
                                } else if ($stock['transaction_type_id'] == 3) {
                                    if (isset($formatted_data[$items['item_id']]['stock_data']['transfer_in']) && $formatted_data[$items['item_id']]['stock_data']['transfer_in'] > 0) {
                                        $formatted_data[$items['item_id']]['stock_data']['transfer_in'] = $formatted_data[$items['item_id']]['stock_data']['transfer_in'] + $stock['stock'];
                                    } else {
                                        $formatted_data[$items['item_id']]['stock_data']['transfer_in'] = $stock['stock'];
                                    }
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase'])))
                                        $formatted_data[$items['item_id']]['stock_data']['purchase'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['sale_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_out']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_out'])))
                                        $formatted_data[$items['item_id']]['stock_data']['transfer_out'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['spec_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['purchase_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale'])))
                                        $formatted_data[$items['item_id']]['stock_data']['sale'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_issue']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_issue'])))
                                        $formatted_data[$items['item_id']]['stock_data']['spec_issue'] = 0;
                                } else if ($stock['transaction_type_id'] == 5) {
                                    if (isset($formatted_data[$items['item_id']]['stock_data']['transfer_out']) && $formatted_data[$items['item_id']]['stock_data']['transfer_out'] > 0) {
                                        $formatted_data[$items['item_id']]['stock_data']['transfer_out'] = $formatted_data[$items['item_id']]['stock_data']['transfer_out'] + $stock['stock'];
                                    } else {
                                        $formatted_data[$items['item_id']]['stock_data']['transfer_out'] = $stock['stock'];
                                    }

                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase'])))
                                        $formatted_data[$items['item_id']]['stock_data']['purchase'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['sale_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_in']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_in'])))
                                        $formatted_data[$items['item_id']]['stock_data']['transfer_in'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['spec_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase_return'])))
                                        $formatted_data[$items['item_id']]['stock_data']['purchase_return'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale'])))
                                        $formatted_data[$items['item_id']]['stock_data']['sale'] = 0;
                                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_issue']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_issue'])))
                                        $formatted_data[$items['item_id']]['stock_data']['spec_issue'] = 0;
                                }
                                $flag1 = 1;
                            }
                        }
                        if ($flag1 == 0) {
                            if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase'])))
                                $formatted_data[$items['item_id']]['stock_data']['purchase'] = 0;
                            if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale_return'])))
                                $formatted_data[$items['item_id']]['stock_data']['sale_return'] = 0;
                            if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_in']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_in'])))
                                $formatted_data[$items['item_id']]['stock_data']['transfer_in'] = 0;
                            if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_return'])))
                                $formatted_data[$items['item_id']]['stock_data']['spec_return'] = 0;
                            if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase_return'])))
                                $formatted_data[$items['item_id']]['stock_data']['purchase_return'] = 0;
                            if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale'])))
                                $formatted_data[$items['item_id']]['stock_data']['sale'] = 0;
                            if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_out']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_out'])))
                                $formatted_data[$items['item_id']]['stock_data']['transfer_out'] = 0;
                            if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_issue']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_issue'])))
                                $formatted_data[$items['item_id']]['stock_data']['spec_issue'] = 0;
                        }
                    } else {
                        if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase'])))
                            $formatted_data[$items['item_id']]['stock_data']['purchase'] = 0;
                        if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale_return'])))
                            $formatted_data[$items['item_id']]['stock_data']['sale_return'] = 0;
                        if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_in']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_in'])))
                            $formatted_data[$items['item_id']]['stock_data']['transfer_in'] = 0;
                        if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_return'])))
                            $formatted_data[$items['item_id']]['stock_data']['spec_return'] = 0;
                        if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase_return'])))
                            $formatted_data[$items['item_id']]['stock_data']['purchase_return'] = 0;
                        if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale'])))
                            $formatted_data[$items['item_id']]['stock_data']['sale'] = 0;
                        if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_out']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_out'])))
                            $formatted_data[$items['item_id']]['stock_data']['transfer_out'] = 0;
                        if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_issue']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_issue'])))
                            $formatted_data[$items['item_id']]['stock_data']['spec_issue'] = 0;
                    }
                } else {
                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase'])))
                        $formatted_data[$items['item_id']]['stock_data']['purchase'] = 0;
                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale_return'])))
                        $formatted_data[$items['item_id']]['stock_data']['sale_return'] = 0;
                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_in']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_in'])))
                        $formatted_data[$items['item_id']]['stock_data']['transfer_in'] = 0;
                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_return'])))
                        $formatted_data[$items['item_id']]['stock_data']['spec_return'] = 0;
                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['purchase_return']) && !empty($formatted_data[$items['item_id']]['stock_data']['purchase_return'])))
                        $formatted_data[$items['item_id']]['stock_data']['purchase_return'] = 0;
                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['sale']) && !empty($formatted_data[$items['item_id']]['stock_data']['sale'])))
                        $formatted_data[$items['item_id']]['stock_data']['sale'] = 0;
                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['transfer_out']) && !empty($formatted_data[$items['item_id']]['stock_data']['transfer_out'])))
                        $formatted_data[$items['item_id']]['stock_data']['transfer_out'] = 0;
                    if (!(isset($formatted_data[$items['item_id']]['stock_data']['spec_issue']) && !empty($formatted_data[$items['item_id']]['stock_data']['spec_issue'])))
                        $formatted_data[$items['item_id']]['stock_data']['spec_issue'] = 0;
                }

                if (isset($sale_data) && !empty($sale_data)) {
                    foreach ($sale_data as $sale) {
                        if ($sale['item_id'] == $items['item_id']) {
                            $formatted_data[$items['item_id']]['stock_data']['sale'] = $sale['sale_qty'];
                        }
                    }
                }
                //                dev_export($sale_return);die;,$specimen_issue_data,$specimen_return_data
                //                dev_export($specimen_return_data);die;
                if (isset($sale_return) && !empty($sale_return)) {
                    foreach ($sale_return as $sale_rtn_data) {
                        if ($sale_rtn_data['itemid'] == $items['item_id']) {
                            $formatted_data[$items['item_id']]['stock_data']['sale_return'] = $sale_rtn_data['return_qty'];
                        }
                    }
                }
                if (isset($specimen_issue_data) && !empty($specimen_issue_data)) {
                    foreach ($specimen_issue_data as $spc_iss_data) {
                        if ($spc_iss_data['item_id'] == $items['item_id']) {
                            $formatted_data[$items['item_id']]['stock_data']['spec_issue'] = $spc_iss_data['sale_qty'];
                        }
                    }
                }
                if (isset($specimen_return_data) && !empty($specimen_return_data)) {
                    foreach ($specimen_return_data as $spc_rtn_data) {
                        if ($spc_rtn_data['itemid'] == $items['item_id']) {
                            $formatted_data[$items['item_id']]['stock_data']['spec_return'] = $spc_rtn_data['return_qty'];
                        }
                    }
                }
            }
        }
        //        dev_export($formatted_data);die;
        return $formatted_data;
    }

    private function calculate_stock($primary_data)
    {
        $formatted_data = array();
        $i = 0;
        foreach ($primary_data as $data) {
            $final_stock = 0;
            $stock_data = $data['stock_data'];
            $final_stock = $stock_data['opening_balance'] + $stock_data['purchase'] + $stock_data['sale_return'] + $stock_data['transfer_in'] + $stock_data['spec_return'] - $stock_data['purchase_return'] - $stock_data['sale'] - $stock_data['transfer_out'] - $stock_data['spec_issue'];
            $formatted_data[] = array(
                'item_data' => $data['item_data'],
                'stock_data' => $data['stock_data']
            );
            $formatted_data[$i]['stock_data']['closing_stock'] = $final_stock;
            $i++;
        }
        return $formatted_data;
    }
}
