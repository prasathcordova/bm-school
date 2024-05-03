<?php

/**
 * Description of Stock_controller
 *
 * @author Aju
 */
class Stock_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Stock_model', 'MStock');
        $this->load->model('Itemmaster_model', 'MIMaster');
    }
 public function get_stock_for_allotment($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['store_id'])) {
            if (empty($params['store_id'])) {
                $storeid = '';
            } else {
                $storeid = $params['store_id'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'store id is required', 'data' => FALSE);
        }

        $stock_list = $this->MStock->get_stock_list_for_allotment($apikey, $storeid);

        if (!empty($stock_list) && is_array($stock_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stock_list);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'No stock data available', 'data' => FALSE);
        }
    }
     public function search_item_stock_for_allotment($params) {
//         echo'hi';die;
        $apikey = $params['API_KEY'];
        if (isset($params['store_id'])) {
            if (empty($params['store_id'])) {
                $storeid = '';
            } else {
                $storeid = $params['store_id'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'store id is required', 'data' => FALSE);
        }
        if (isset($params['count'])) {
            $count = $params['count'];
        } else {
            $count = ITEM_SEARCH_DEFAULT_DISPLAY_COUNT;
        }
        if (isset($params['name'])) {
            $name = $params['name'];
        } else {
            $name = '';
        }
        if (isset($params['code'])) {
            $code = $params['code'];
        } else {
            $code = '';
        }
        if (isset($params['barcode'])) {
            $barcode = $params['barcode'];
        } else {
            $barcode = '';
        }

        $dbparams = array(
            $apikey,
            $storeid,
            $count,
            $name,
            $code,
            $barcode
        );

        $stock_list = $this->MStock->get_stock_list_for_allotment_search($dbparams);

        if (!empty($stock_list) && is_array($stock_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stock_list);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'No stock data available', 'data' => FALSE);
        }
    }
    public function get_current_stock_list($params = NULL) {
        $apikey = $params['API_KEY'];
        if (isset($params['store_id'])) {
            $storeid = $params['store_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'store id is required', 'data' => FALSE);
        }

        $stock_list = $this->MStock->get_current_stock($apikey, $storeid);

        if (!empty($stock_list) && is_array($stock_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stock_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function uniform_get_current_stock_list($params = NULL) {
        $apikey = $params['API_KEY'];
        if (isset($params['store_id'])) {
            $storeid = $params['store_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'store id is required', 'data' => FALSE);
        }

        $stock_list = $this->MStock->uniform_get_current_stock($apikey, $storeid);

        if (!empty($stock_list) && is_array($stock_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stock_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_all_stock_report_data($params) {
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

        $query_string = " im.isactive = 1";
        $count = ITEM_SEARCH_DEFAULT_DISPLAY_COUNT;

        $opening_stock = $this->MStock->opening_stock_data($storeid, $from_date, $apikey);
        $active_items = $this->MIMaster->get_item_details($apikey, $query_string, $count);
        $stock_data_current = $this->MStock->stock_data($storeid, $from_date, $to_date, $apikey);
        $formatted_data = $this->format_stock_report_all($opening_stock, $stock_data_current, $active_items);

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

    private function format_for_summary_report($report_data) {
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

    private function format_stock_report_all($opening_stock, $stock_data, $item_list) {
        $formatted_data = array();
        if (isset($item_list) && !empty($item_list)) {
            foreach ($item_list as $items) {
                $formatted_data[$items['item_id']]['item_data'] = $items;
                if (isset($opening_stock) && !empty($opening_stock)) {
                    $flag1 = 0;
                    foreach ($opening_stock as $ostock) {
                        if ($ostock['itemid'] == $items['item_id']) {
                            if ($ostock['transaction_type_id'] == 1 || $ostock['transaction_type_id'] == 3 || $ostock['transaction_type_id'] == 4) {
                                if (isset($formatted_data[$items['item_id']]['stock_data']['opening_balance'])) {
                                    $formatted_data[$items['item_id']]['stock_data']['opening_balance'] = $formatted_data[$items['item_id']]['stock_data']['opening_balance'] + $ostock['stock'];
                                } else {
                                    $formatted_data[$items['item_id']]['stock_data']['opening_balance'] = $ostock['stock'];
                                }
                            } else if ($ostock['transaction_type_id'] == 2 || $ostock['transaction_type_id'] == 5) {
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
            }
        }
        return $formatted_data;
    }

    private function calculate_stock($primary_data) {
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

    public function report_lock_date($params) {
        $apikey = $params['API_KEY'];
        $lock_data = $this->MStock->get_report_lock_date($apikey);
        if (isset($lock_data) && !empty($lock_data) && is_array($lock_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $lock_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_report_for_stock_allotment($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['from_store_id'])) {
            $from_storeid = $params['from_store_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Source store data is required', 'data' => FALSE);
        }
        if (isset($params['to_store_id'])) {
            $to_storeid = $params['to_store_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Destination store data is required', 'data' => FALSE);
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

        $allotment_data = $this->MStock->get_stock_allotment_data($from_storeid, $to_storeid, $from_date, $to_date, $apikey);
        dev_export($allotment_data);die;
    }

    private function format_allotment_data($allotment_data) {
        
    }

    private function final_format_allotment($allotment_data) {
        
    }

}
