<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stock_controller
 *
 * @author chandrajith.edsys
 */
class Stock_controller extends MX_Controller
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
        $this->load->model('Stock_model', 'MStock');
        $this->load->model('store_settings/Allotment_management_model', 'MAllotment');
        $this->load->model('Sales_model', 'MSales');
    }

    public function live_stock()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'STOCK MANAGEMENT';
            $storeid = $this->session->userdata('store_id');;
            $store_name = $this->session->userdata('Institution_Name');;
            if (isset($storeid) && !empty($storeid)) {
                $stock_data = $this->MStock->get_stock_data_for_store($storeid);
                $data['sub_title'] = 'STOCK REPORT - ' . $store_name;
                if (isset($stock_data['data_status']) && !empty($stock_data['data_status']) && $stock_data['data_status'] == 1) {
                    $data['stock_data'] = $stock_data['data'];
                } else {
                    $data['stock_data'] = NULL;
                }
                echo json_encode(array('status' => 1, 'view' => $this->load->view('stock/livestock', $data, TRUE)));
                return true;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Store data is mandaatory'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function stock_allotment_list()
    {

        //       $data['template'] = 'language/show_language';
        $data['title'] = 'GENERAL SETTINGS';

        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Bookstore Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Publisher Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $stockAllot_list = $this->MStock->get_all_stockAllotmnt_list();

        if ($stockAllot_list['error_status'] == 0 && $stockAllot_list['data_status'] == 1) {
            $data['stockAllot_data'] = $stockAllot_list['data'];
            $data['message'] = "";
        } else {
            $data['stockAllot_data'] = FALSE;
            $data['message'] = $stockAllot_list['message'];
        }
        $data['sub_title'] = 'STOCK ALLOTMENT LIST '; //: ' . $stockAllot_list['data'][0]['store_name'];

        $this->session->set_userdata('current_page', 'publisher');
        $this->session->set_userdata('current_parent', 'store_sett');

        $this->load->view('stock/show_allotment_list', $data);
    }

    public function stock_allotment_view()
    {
        //        $data['template'] = 'category/show_category';
        //        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Bookstore Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Allotment Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $allotment_id = filter_input(INPUT_POST, 'allotment_id', FILTER_SANITIZE_NUMBER_INT);

        if (isset($allotment_id) && !empty($allotment_id)) {
            $allot_data = $this->MAllotment->get_allotment_approval_details($allotment_id);
            //                dev_export($allot_data);die;
            if (isset($allot_data['data_status']) && !empty($allot_data['data_status']) && $allot_data['data_status'] == 1) {
                $data['sub_title'] = 'ALLOTMENT VIEW - ' . $allot_data['data']['master_data']['store_name'] . " ( ID :" . $allot_data['data']['master_data']['masterid'] . " Dtd : " . date('d-m-Y', strtotime($allot_data['data']['master_data']['date'])) . " ) ";
                $data['allot_data'] = $allot_data['data'];
                $data['allotment_id'] = $allotment_id;
                echo json_encode(array('status' => 1, 'message' => 'Data loaded', 'view' => $this->load->view('stock/allotment_details_view', $data, TRUE)));
                return true;
            } else {
                echo json_encode(array('status' => 3, 'message' => 'Allotment details of this purchse is not available.Please check order and try again later or contact administrator.'));
                return true;
            }
        } else {
            echo json_encode(array('status' => 2, 'message' => 'Allotment data is requried. Please try again'));
            return true;
        }
        $this->load->view('template/error-500', $data);
    }

    public function show_allotment_out()
    {

        //       $data['template'] = 'language/show_language';
        $data['title'] = 'GENERAL SETTINGS';

        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Bookstore Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Publisher Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $stockAllot_list = $this->MStock->get_all_stockAllotmnt_list_out();
        //               dev_export($stockAllot_list);die;
        if ($stockAllot_list['error_status'] == 0 && $stockAllot_list['data_status'] == 1) {
            $data['stockAllot_data'] = $stockAllot_list['data'];
            $data['message'] = "";
        } else {
            $data['stockAllot_data'] = FALSE;
            $data['message'] = $stockAllot_list['message'];
        }
        $data['sub_title'] = 'STOCK ALLOTMENT OUTWARD'; // : ' . $stockAllot_list['data'][0]['store_name'];

        $this->session->set_userdata('current_page', 'publisher');
        $this->session->set_userdata('current_parent', 'store_sett');

        $this->load->view('allotment/show_allotment_out_list', $data);
    }

    public function add_allotment_sub_out()
    {

        if ($this->input->is_ajax_request() == 1) {

            $data['sub_title'] = 'ADD ALLOTMENT ';

            $store_id = $this->session->userdata('store_id');;
            $data['store_id'] = $store_id;
            $item_list = $this->MSales->get_all_items($store_id);
            if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
                $data['item_data'] = $item_list['data'];
                $data['message'] = "";
            } else {
                $data['item_data'] = FALSE;
                $data['message'] = $item_list['message'];
            }
            $this->load->view('allotment/add_allotment_sub_out', $data);
        }
    }

    public function save_allotment_sub_out()
    {

        $load = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $total_items = filter_input(INPUT_POST, 'total_items', FILTER_SANITIZE_STRING);
        $net_value = filter_input(INPUT_POST, 'net_value', FILTER_SANITIZE_STRING);
        $store_id = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_NUMBER_INT);
        $itemdata = filter_input(INPUT_POST, 'itemdata');
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        //        dev_export($store_id);die;
        $allotment_data = $this->MStock->save_allotment($itemdata, $store_id, $total_items, $net_value, base64_encode($description));

        if ($allotment_data['error_status'] == 0 && $allotment_data['data_status'] == 1) {
            echo json_encode(array('status' => 1, 'view' => '', TRUE));
            return true;
        } else {
            echo json_encode(array('status' => 2, 'view' => ''));
            return true;
        }
    }

    public function edit_allotment_load_out()
    {
        if ($this->input->is_ajax_request() == 1) {
            $allotment_id = filter_input(INPUT_POST, 'allotment_id', FILTER_SANITIZE_STRING);
            if (isset($allotment_id) && !empty($allotment_id)) {
                $return_details = $this->MAllotment->get_allotment_approval_details($allotment_id);
                //                dev_export($return_details);die;
                if (isset($return_details['data_status']) && !empty($return_details['data_status']) && $return_details['data_status'] == 1) {
                    $data['allotment_data'] = $return_details['data'];
                    $data['allotment_id'] = $allotment_id;
                } else {
                    $data['allotment_data'] = NULL;
                    echo json_encode(array('status' => 2, 'message' => 'return data is not available'));
                    return true;
                }
                //                dev_export($return_details['data']['master_data']['store_id']);die;
                $store_id = $this->session->userdata('store_id');;
                $data['store_id'] = $store_id;
                $item_list = $this->MSales->get_all_items($store_id);
                //                dev_export($item_list);die;
                if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
                    $data['item_data'] = $item_list['data'];
                    $data['message'] = "";
                } else {
                    $data['item_data'] = FALSE;
                    $data['message'] = $item_list['message'];
                }
                $data['sub_title'] = 'EDIT ALLOTMENT - ID : ' . $return_details['data']['master_data']['masterid'] . ' ( ' . $return_details['data']['master_data']['store_name'] . ' )';
                $data['store_id'] = $return_details['data']['master_data']['store_id'];
                //                dev_export($data['suppier_id']);die;
                echo json_encode(array('status' => 1, 'view' => $this->load->view('allotment/edit_allotment_out', $data, TRUE)));
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No Return data available. Please try another data / try again later'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function edit_allotment_out_save()
    {
        if ($this->input->is_ajax_request() == 1) {
            $allotment_id = filter_input(INPUT_POST, 'allotment_id', FILTER_SANITIZE_NUMBER_INT);
            $final_item_allot = filter_input(INPUT_POST, 'final_item_string');
            $total_qty = filter_input(INPUT_POST, 'total_qty', FILTER_SANITIZE_STRING);
            $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);
            $remarks = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);


            if (isset($allotment_id) && !empty($allotment_id) && isset($final_item_allot) && !empty($final_item_allot)) {

                $data_prep = array(
                    'action' => 'save_edit_allotment_out',
                    'allotment_item_details' => $final_item_allot,
                    'allotment_id' => $allotment_id,
                    'total_qty' => $total_qty,
                    'total_value' => $sub_total,
                    'remarks' => $remarks
                );
                //                dev_export($data_prep);die;

                $status = $this->MStock->save_allotment_edit($data_prep);
                //                dev_export($status);die;
                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1));
                    return true;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 3, 'message' => $status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'message' => 'An error encountered. Please try again or contact administrator with error code : EPS1001'));
                        return true;
                    }
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Supplier data / Item data is required.'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function view_allotment_out()
    {
        //        $data['template'] = 'category/show_category';
        //        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Bookstore Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Allotment Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $allotment_id = filter_input(INPUT_POST, 'allotment_id', FILTER_SANITIZE_NUMBER_INT);

        if (isset($allotment_id) && !empty($allotment_id)) {
            $allot_data = $this->MAllotment->get_allotment_approval_details($allotment_id);
            //                dev_export($allot_data);die;
            if (isset($allot_data['data_status']) && !empty($allot_data['data_status']) && $allot_data['data_status'] == 1) {
                $data['sub_title'] = 'ALLOTMENT VIEW - ' . $allot_data['data']['master_data']['store_name'] . " ( ID :" . $allot_data['data']['master_data']['masterid'] . " Dtd : " . date('d-m-Y', strtotime($allot_data['data']['master_data']['date'])) . " ) ";
                $data['allot_data'] = $allot_data['data'];
                $data['allotment_id'] = $allotment_id;

                //                    $data['sub_title'] = 'PURCHASE APPROVAL - ' . $allot_data['data']['master_data']['type_desc'] . " ( " . $allot_data['data']['master_data']['purchase_code'] . " Dtd : " . date('d-m-Y', strtotime($allot_data['data']['master_data']['purchase_order_date'])) . " ) ";
                //                    $data['status'] = $allot_data['data']['master_data']['status_desc'];
                echo json_encode(array('status' => 1, 'message' => 'Data loaded', 'view' => $this->load->view('allotment/veiw_allotment_sub_out', $data, TRUE)));
                return true;
            } else {
                echo json_encode(array('status' => 3, 'message' => 'Allotment details of this purchase is not available.Please check order and try again later or contact administrator.'));
                return true;
            }
        } else {
            echo json_encode(array('status' => 2, 'message' => 'Allotment data is requried. Please try again'));
            return true;
        }
        $this->load->view('template/error-500', $data);
    }

    public function search_item_for_allotment()
    {
        if ($this->input->is_ajax_request() == 1) {
            $search_query = filter_input(INPUT_POST, 'search_query', FILTER_SANITIZE_STRING);
            $store_id = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_STRING);
            $data['action'] = 'search_item_stock_for_substore';
            $data['count'] = 15;
            $data['mode'] = 'search';
            $data['name'] = $search_query;
            $data['code'] = $search_query;
            $data['barcode'] = $search_query;
            $data['store_id'] = $store_id;

            $item_list = $this->MAllotment->get_all_item_list_search($data);
            //            dev_export($item_list);die;
            if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
                $data['item_data'] = $item_list['data'];
                $data['message'] = "";
            } else {
                $data['item_data'] = FALSE;
                $data['message'] = $item_list['message'];
            }
            echo $this->load->view('allotment/allotment_item_search', $data, TRUE);

            return TRUE;
        }
    }
}
