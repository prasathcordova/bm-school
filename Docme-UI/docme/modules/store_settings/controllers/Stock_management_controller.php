<?php

/**
 * Description of Stock_management_controller
 *
 * @author aju.docme
 */
class Stock_management_controller extends MX_Controller {

    public function __construct() {
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
        $this->load->model('Stock_model', 'MStock');
    }

    public function store_selection() {
        $data['sub_title'] = 'Store Selection - Rates';

        $store = $this->MStock->get_store_details();
        if ($store['error_status'] == 0 && $store['data_status'] == 1) {
            $data['store_data'] = $store['data'];
            $data['message'] = "";
        } else {
            $data['store_data'] = FALSE;
            $data['message'] = $store['message'];
        }

        $this->load->view('stock/store_select', $data);
    }

    public function get_stock_of_items() {
        if ($this->input->is_ajax_request() == 1) {
            $storeid = filter_input(INPUT_POST, 'storeid', FILTER_SANITIZE_STRING);
            $store_name = filter_input(INPUT_POST, 'storename', FILTER_SANITIZE_STRING);
            if (isset($storeid) && !empty($storeid)) {
                $stock_data = $this->MStock->get_stock_data_for_store($storeid);
//                dev_export($stock_data);die;
                $data['sub_title'] = 'STOCK REPORT - ' . $store_name;
                if (isset($stock_data['data_status']) && !empty($stock_data['data_status']) && $stock_data['data_status'] == 1) {
                    $data['stock_data'] = $stock_data['data'];
                } else {
                    $data['stock_data'] = NULL;
                }
                echo json_encode(array('status' => 1, 'view' => $this->load->view('stock/stock_data', $data, TRUE)));
                return true;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Store data is mandaatory'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

}
