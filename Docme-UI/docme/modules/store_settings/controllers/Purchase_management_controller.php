<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Purchase_management_controller
 *
 * @author chandrajith.edsys
 */
class Purchase_management_controller extends MX_Controller {

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
        $this->load->model('Purchase_model', 'MPurchase');
    }

    public function show_purchase() {

//       $data['template'] = 'language/show_language';
        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'PURCHASE MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Bookstore Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Publisher Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $purchase_data = $this->MPurchase->get_all_purchase_list();
//         dev_export($purchase_data);die;
        if ($purchase_data['error_status'] == 0 && $purchase_data['data_status'] == 1) {
            $data['purchase_data'] = $purchase_data['data'];
        } else {
            $data['purchase_data'] = FALSE;
            $data['message'] = $purchase_data['message'];
        }


        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['purchase_data']) && !empty($data['purchase_data'])) {
                foreach ($data['purchase_data'] as $publisher) {
                    $publisher_status = "";
                    if ($publisher['isactive'] == 1) {
                        $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['id'] . '\',\'' . $publisher['id'] . '\', this)" checked id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" checked id="" class="js-switch"  />';
                    } else {
                        $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['id'] . '\',\'' . $publisher['id'] . '\', this)" id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" id="" class="js-switch"  />';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_publisher(\'' . $publisher['id'] . '\',\'' . $publisher['language_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $language['language_name'] . '" data-original-title="' . $publisher['name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($publisher['name'], $publisher_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('purchase/show_purchase', $data);
        }
    }

    public function purchaseorder_recieve() {
        $data['title'] = 'STOCK MANAGEMENT';
        $data['sub_title'] = 'PURCHASE ORDER RECEIVE';
        $data['user_name'] = $this->session->userdata('user_name');
        $purchase_id = filter_input(INPUT_POST, 'purchase_id', FILTER_SANITIZE_NUMBER_INT);
        $purchase_details = $this->MPurchase->get_purchase_details($purchase_id);
        if (isset($purchase_details['data_status']) && !empty($purchase_details['data_status']) && $purchase_details['data_status'] == 1) {
            $data['purchase_data'] = $purchase_details['data'];
            $data['purchase_id'] = $purchase_id;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('purchase/purchaseorder_receive', $data, TRUE)));
            return true;
        } else {
            $data['purchase_data'] = NULL;
            echo json_encode(array('status' => 2, 'message' => 'Purchase data is not available'));
            return true;
        }
    }

    public function purchaseorder_recieve_save() {
        if ($this->input->is_ajax_request() == 1) {
            $invoice_no = filter_input(INPUT_POST, 'invoice_no', FILTER_SANITIZE_STRING);
            $purchase_id = filter_input(INPUT_POST, 'purchase_id', FILTER_SANITIZE_STRING);
            $invoice_date = filter_input(INPUT_POST, 'invoice_dt', FILTER_SANITIZE_STRING);
            $delivery_note = filter_input(INPUT_POST, 'del_note_no', FILTER_SANITIZE_STRING);
            $close_order = filter_input(INPUT_POST, 'close_order', FILTER_SANITIZE_STRING);
            $item_data = filter_input(INPUT_POST, 'item_data');

            if (strlen($delivery_note) == 0) {
                echo json_encode(array('status' => 2, 'message' => 'Delivery note is required to receive items'));
                return true;
            }

            if (strlen($item_data) == 0) {
                echo json_encode(array('status' => 2, 'message' => 'Item data is requiredAtleast one item is to be received'));
                return true;
            }

            $data_prep = array(
                'action' => 'purchase_item_receive',
                'purchase_id' => $purchase_id,
                'invoice_no' => $invoice_no,
                'invoice_date' => $invoice_date,
                'delivery_no' => $delivery_note,
                'close_order' => $close_order,
                'item_data' => $item_data
            );

            $receive_status = $this->MPurchase->save_purchse_receive($data_prep);
//            dev_export($data_prep);die;
            if (isset($receive_status) && !empty($receive_status) && isset($receive_status['data_status']) && $receive_status['data_status'] == 1) {
                echo json_encode(array('status' => 1));
                return true;
            } else {
                if (isset($receive_status['message']) && !empty($receive_status['message'])) {
                    echo json_encode(array('status' => 3, 'message' => $receive_status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'An error encountered. Please try again later or contact administrator with error code : PRT1000UI001'));
                    return true;
                }
            }
        } else {
            
        }
    }

    public function purchase_returnrequest() {
        if ($this->input->is_ajax_request() == 1) {
            $supplier_id = filter_input(INPUT_POST, 'supplierid', FILTER_SANITIZE_NUMBER_INT);
            $supplier_name = filter_input(INPUT_POST, 'suppliername', FILTER_SANITIZE_STRING);
            $data['supplier_name'] = $supplier_name;
            $data['supplier_id'] = $supplier_id;

            $data['title'] = 'GENERAL SETTINGS';
            $data['sub_title'] = 'PURCHASE RETURN - ' . $supplier_name;
            $item_list = $this->MPurchase->get_all_item_list();
            if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
                $data['item_data'] = $item_list['data'];
                $data['message'] = "";
            } else {
                $data['item_data'] = FALSE;
                $data['message'] = $item_list['message'];
            }
            $this->load->view('purchase/purchasereturn_request', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function direct_purchase() {
        if ($this->input->is_ajax_request() == 1) {
            $supplier_id = filter_input(INPUT_POST, 'supplierid', FILTER_SANITIZE_NUMBER_INT);
            $supplier_name = filter_input(INPUT_POST, 'suppliername', FILTER_SANITIZE_STRING);
            $data['title'] = 'GENERAL SETTINGS';
            $data['sub_title'] = 'DIRECT PURCHASE ';
            $data['supplier_name'] = $supplier_name;
            $data['supplier_id'] = $supplier_id;

            $item_list = $this->MPurchase->get_all_item_list();
            if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
                $data['item_data'] = $item_list['data'];
                $data['message'] = "";
            } else {
                $data['item_data'] = FALSE;
                $data['message'] = $item_list['message'];
            }
            $this->load->view('purchase/direct_purchase', $data);
        }
    }

    public function search_item_for_direct_purchase() {
        if ($this->input->is_ajax_request() == 1) {
            $search_query = filter_input(INPUT_POST, 'search_query', FILTER_SANITIZE_STRING);
            $data['action'] = 'show_items_master';
            $data['count'] = 15;
            $data['mode'] = 'search';
            $data['name'] = $search_query;
            $data['code'] = $search_query;
            $data['barcode'] = $search_query;

            $item_list = $this->MPurchase->get_all_item_list_search($data);
            if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
                $data['item_data'] = $item_list['data'];
                $data['message'] = "";
            } else {
                $data['item_data'] = FALSE;
                $data['message'] = $item_list['message'];
            }
            echo $this->load->view('purchase/purchase_item_search', $data, TRUE);

            return TRUE;
        }
    }

    public function purchase_return_save() {
        if ($this->input->is_ajax_request() == 1) {
            $supplier_id = filter_input(INPUT_POST, 'supplier_id', FILTER_SANITIZE_NUMBER_INT);
            $purchase_return_date = filter_input(INPUT_POST, 'purchase_return_date', FILTER_SANITIZE_STRING);
            $final_item_purchased = filter_input(INPUT_POST, 'final_item_string');
            $item_count = filter_input(INPUT_POST, 'data_counter', FILTER_SANITIZE_STRING);
            $total_qty = filter_input(INPUT_POST, 'total_qty', FILTER_SANITIZE_STRING);
            $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);
            $remarks = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);
            if (isset($supplier_id) && !empty($supplier_id) && isset($final_item_purchased) && !empty($final_item_purchased)) {
                $data_prep = array(
                    'action' => 'save_purchase_return',
                    'return_item_details' => $final_item_purchased,
                    'purchase_return_date' => $purchase_return_date,
                    'supplier_code' => $supplier_id,
                    'total_qty' => $total_qty,
                    'item_count' => $item_count,
                    'total_value' => $sub_total,
                    'description' => $remarks
                );
                $status = $this->MPurchase->save_direct_purchase($data_prep);
//                dev_export($status['data']['return_id']);die;
                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'return_id' => $status['data']['return_id']));
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

    public function direct_purchase_save() {
        if ($this->input->is_ajax_request() == 1) {
            $supplier_id = filter_input(INPUT_POST, 'supplier_id', FILTER_SANITIZE_NUMBER_INT);
            $final_item_purchased = filter_input(INPUT_POST, 'final_item_string');
            $item_count = filter_input(INPUT_POST, 'data_counter', FILTER_SANITIZE_STRING);
            $total_qty = filter_input(INPUT_POST, 'total_qty', FILTER_SANITIZE_STRING);
            $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);
            $final_order_value = filter_input(INPUT_POST, 'final_order_value', FILTER_SANITIZE_STRING);
            $remarks = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);


            if (isset($supplier_id) && !empty($supplier_id) && isset($final_item_purchased) && !empty($final_item_purchased)) {

                $data_prep = array(
                    'action' => 'save_direct_purchase_order',
                    'final_format_data' => $final_item_purchased,
                    'type_id' => 1,
                    'supplier_code' => $supplier_id,
                    'total_qty' => $total_qty,
                    'item_count' => $item_count,
                    'sub_total' => $sub_total,
                    'final_order_value' => $final_order_value,
                    'remarks' => $remarks
                );

                $status = $this->MPurchase->save_direct_purchase($data_prep);
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

    public function purchase_order_save() {
        if ($this->input->is_ajax_request() == 1) {
            $supplier_id = filter_input(INPUT_POST, 'supplier_id', FILTER_SANITIZE_NUMBER_INT);
            $final_item_purchased = filter_input(INPUT_POST, 'final_item_string');
            $item_count = filter_input(INPUT_POST, 'data_counter', FILTER_SANITIZE_STRING);
            $total_qty = filter_input(INPUT_POST, 'total_qty', FILTER_SANITIZE_STRING);
            $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);
            $final_order_value = filter_input(INPUT_POST, 'final_order_value', FILTER_SANITIZE_STRING);
            $remarks = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);


            if (isset($supplier_id) && !empty($supplier_id) && isset($final_item_purchased) && !empty($final_item_purchased)) {

                $data_prep = array(
                    'action' => 'save_purchase_order',
                    'final_format_data' => $final_item_purchased,
                    'type_id' => 2,
                    'supplier_code' => $supplier_id,
                    'total_qty' => $total_qty,
                    'item_count' => $item_count,
                    'sub_total' => $sub_total,
                    'final_order_value' => $final_order_value,
                    'remarks' => $remarks
                );

                $status = $this->MPurchase->save_purchase_order($data_prep);
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

    public function new_purchase_order() {
        if ($this->input->is_ajax_request() == 1) {
            $supplier_id = filter_input(INPUT_POST, 'supplierid', FILTER_SANITIZE_NUMBER_INT);
            $supplier_name = filter_input(INPUT_POST, 'suppliername', FILTER_SANITIZE_STRING);
            $data['title'] = 'GENERAL SETTINGS';
            $data['sub_title'] = 'NEW PURCHASE ORDER';
            $data['supplier_name'] = $supplier_name;
            $data['supplier_id'] = $supplier_id;
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'),
                '1' => array(
                    'title' => 'Bookstore Settings',
                    'link' => base_url()),
                '2' => array(
                    'title' => 'Direct Purchase')
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $data['user_name'] = $this->session->userdata('user_name');
            $item_list = $this->MPurchase->get_all_item_list();


            if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
                $data['item_data'] = $item_list['data'];
                $data['message'] = "";
            } else {
                $data['item_data'] = FALSE;
                $data['message'] = $item_list['message'];
            }
            $this->load->view('purchase/new_purchase_order', $data);
        }
    }

    public function direct_purchase_supplier() {

        $data['sub_title'] = 'Supplier Selection ';
        $data['user_name'] = $this->session->userdata('user_name');
        $suppliers_data = $this->MPurchase->get_all_suppliers_list();
//        dev_export($suppliers_data);die;
        if ($suppliers_data['error_status'] == 0 && $suppliers_data['data_status'] == 1) {
            $data['suppliers_data'] = $suppliers_data['data'];
            $data['message'] = "";
        } else {
            $data['suppliers_data'] = FALSE;
            $data['message'] = $suppliers_data['message'];
        }
        $this->session->set_userdata('current_page', 'publisher');
        $this->session->set_userdata('current_parent', 'store_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            if ($this->input->is_ajax_request() == 1) {
                $this->load->view('purchase/show_suppliers_purchase', $data);
            } else {
                $data['item'] = strtoupper(filter_input(INPUT_POST, 'phn', FILTER_SANITIZE_STRING));
                echo json_encode(array('status' => 3, 'view' => $this->load->view('purchase/show_suppliers_purchase', $data, TRUE)));
                return;
            }
        } else {
            $this->load->view('purchase/show_suppliers_purchase', $data);
        }
    }

    public function purchase_order_supplier() {

        $data['sub_title'] = 'Supplier Selection ';
        $data['user_name'] = $this->session->userdata('user_name');
        $suppliers_data = $this->MPurchase->get_all_suppliers_list();
        if ($suppliers_data['error_status'] == 0 && $suppliers_data['data_status'] == 1) {
            $data['suppliers_data'] = $suppliers_data['data'];
            $data['message'] = "";
        } else {
            $data['suppliers_data'] = FALSE;
            $data['message'] = $suppliers_data['message'];
        }
        $this->session->set_userdata('current_page', 'publisher');
        $this->session->set_userdata('current_parent', 'store_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            if ($this->input->is_ajax_request() == 1) {
                $this->load->view('purchase/show_suppliers_direct_purchase', $data);
            } else {
                $data['item'] = strtoupper(filter_input(INPUT_POST, 'phn', FILTER_SANITIZE_STRING));
                echo json_encode(array('status' => 3, 'view' => $this->load->view('purchase/show_suppliers_direct_purchase', $data, TRUE)));
                return;
            }
        } else {
            $this->load->view('purchase/show_suppliers_direct_purchase', $data);
        }
    }

    public function purchase_order_creation() {
        if ($this->input->is_ajax_request() == 1) {

//       $data['template'] = 'language/show_language';
            $supplier_id = filter_input(INPUT_POST, 'supplierid', FILTER_SANITIZE_NUMBER_INT);
            $supplier_name = filter_input(INPUT_POST, 'suppliername', FILTER_SANITIZE_STRING);
            $data['supplier_name'] = $supplier_name;
            $data['supplier_id'] = $supplier_id;
//        dev_export($supplier_id);die;
            $data['title'] = 'GENERAL SETTINGS';
            $data['sub_title'] = 'NEW PURCHASE ORDER';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'),
                '1' => array(
                    'title' => 'Bookstore Settings',
                    'link' => base_url()),
                '2' => array(
                    'title' => 'Direct Purchase')
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $data['user_name'] = $this->session->userdata('user_name');

//         $publisher_data = $this->MPurchase->get_all_publisher_list();
//        $publisher_data = null;
//        // dev_export($publisher_data);die;
//        if ($publisher_data['error_status'] == 0 && $publisher_data['data_status'] == 1) {
//            $data['publisher_data'] = $publisher_data['data'];
//            $data['message'] = "";
//        } else {
//            $data['publisher_data'] = FALSE;
//            $data['message'] = $publisher_data['message'];
//        }
            $item_list = $this->MPurchase->get_all_item_list();
//        dev_export($item_list);die;
            if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
                $data['item_data'] = $item_list['data'];
                $data['message'] = "";
            } else {
                $data['item_data'] = FALSE;
                $data['message'] = $item_list['message'];
            }

            $suppliers_data = $this->MPurchase->get_all_suppliers_list();
//        dev_export($suppliers_data);die;
            if ($suppliers_data['error_status'] == 0 && $suppliers_data['data_status'] == 1) {
                $data['suppliers_data'] = $suppliers_data['data'];
                $data['message'] = "";
            } else {
                $data['suppliers_data'] = FALSE;
                $data['message'] = $suppliers_data['message'];
            }


            $this->session->set_userdata('current_page', 'publisher');
            $this->session->set_userdata('current_parent', 'store_sett');

            if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
                $formatted_data = array();
                if (isset($data['publisher_data']) && !empty($data['publisher_data'])) {
                    foreach ($data['publisher_data'] as $publisher) {
                        $publisher_status = "";
                        if ($publisher['isactive'] == 1) {
                            $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['id'] . '\',\'' . $publisher['id'] . '\', this)" checked id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" checked id="" class="js-switch"  />';
                        } else {
                            $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['id'] . '\',\'' . $publisher['id'] . '\', this)" id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" id="" class="js-switch"  />';
                        }
                        $task_html = '<a href="javascript:void(0);" onclick="edit_publisher(\'' . $publisher['id'] . '\',\'' . $publisher['language_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $language['language_name'] . '" data-original-title="' . $publisher['name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                        $formatted_data[] = array($publisher['name'], $publisher_status, $task_html);
                    }
                }
                echo json_encode($formatted_data);
                return;
            } else {
                $this->load->view('purchase/direct_purchase', $data);
            }
        }
    }

    public function purchase_returnapproval() {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'PURCHASE RETURN APPROVAL';
            $return_id = filter_input(INPUT_POST, 'return_id', FILTER_SANITIZE_STRING);
            if (isset($return_id) && !empty($return_id)) {
                $return_data = $this->MPurchase->get_return_data_view($return_id);
                if (isset($return_data['data_status']) && !empty($return_data['data_status']) && $return_data['data_status'] == 1) {
                    $data['master_data'] = $return_data['data']['master_data'];
                    $data['detail_data'] = $return_data['data']['detail_data'];
                    $data['comment_data'] = $return_data['data']['comment_data'];
                    $data['return_id'] = $return_id;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('purchase/purchase_returnapproval', $data, TRUE)));
                    return;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Purchase return data is not available. Please try again'));
                    return;
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Return data is not available'));
                return;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function purchase_returnapproval_save() {
        if ($this->input->is_ajax_request() == 1) {
            $return_id = filter_input(INPUT_POST, 'return_id', FILTER_SANITIZE_STRING);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
            $comments = filter_input(INPUT_POST, 'comments');
            if (isset($return_id) && !empty($return_id) && isset($status) && !empty($status) && isset($comments) && !empty($status)) {
                $status = $this->MPurchase->approve_purchase_return($return_id, $status, $comments);
//                dev_export($status);die;
                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1));
                    return true;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 3, 'message' => $status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 3));
                        return true;
                    }
                }
            } else {
                echo json_encode(array('status' => 2, 'status' => 'All mandatory data is required.'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function item_parent() {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'),
                '1' => array(
                    'title' => 'Bookstore Settings',
                    'link' => base_url()),
                '2' => array(
                    'title' => 'Direct Purchase')
            );


            $data['title'] = 'GENERAL SETTINGS';
            $data['sub_title'] = 'DIRECT PURCHASE';
//            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'publisher');
            $this->session->set_userdata('current_parent', 'store_sett');

            if ($onload == 1) {
                $this->load->view('registration/parent_search', $data);
            } else {




                $data_prep['item'] = strtoupper(filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING));

//                dev_export($data_prep);
//                die;
                $search_status = $this->MPurchase->item_search($data_prep);
                dev_export($search_status);
                die;
                if ($search_status['error_status'] == 0 && $search_status['data_status'] == 1) {
                    $data['search_status'] = $search_status['data'];
                    $data['message'] = "";
                } else {
                    $data['search_status'] = FALSE;
                    $data['message'] = $search_status['message'];
                }
                $this->load->view('purchase/direct_purchase', $data);
//                      dev_export($search_status);die;  
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

//Saranyacode 14-11-2017 starts

    public function direct_purchase_approve() {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'PURCHASE APPROVAL ';
            $data['user_name'] = $this->session->userdata('user_name');
            $purchase_id = filter_input(INPUT_POST, 'purchase_id', FILTER_SANITIZE_NUMBER_INT);

            if (isset($purchase_id) && !empty($purchase_id)) {
                $purchase_data = $this->MPurchase->get_direct_purchase_approve_list_data($purchase_id);
                if (isset($purchase_data['data_status']) && !empty($purchase_data['data_status']) && $purchase_data['data_status'] == 1) {
                    $data['purchase_data'] = $purchase_data['data'];
                    $data['purchase_id'] = $purchase_id;
                    $data['sub_title'] = 'PURCHASE APPROVAL - ' . $purchase_data['data']['master_data']['type_desc'] . " ( " . $purchase_data['data']['master_data']['purchase_code'] . " Dtd : " . date('d-m-Y', strtotime($purchase_data['data']['master_data']['purchase_order_date'])) . " ) ";
                    $data['status'] = $purchase_data['data']['master_data']['status_desc'];
                    $data['purchase_type_id'] = $purchase_data['data']['master_data']['purchase_type_id'];
                    $data['purchase_order'] = $purchase_data['data']['master_data']['purchase_code'];
                    echo json_encode(array('status' => 1, 'message' => 'Data loaded', 'view' => $this->load->view('purchase/purchase_approval', $data, TRUE)));
                    return true;
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Purchase details of this purchse is not available.Please check order and try again later or contact administrator.'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Purchase data is requried. Please try again'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function save_purchase_status() {
        if ($this->input->is_ajax_request() == 1) {
            $purchase_id = filter_input(INPUT_POST, 'purchase_id', FILTER_SANITIZE_NUMBER_INT);
            $comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
            $purchase_type_id = filter_input(INPUT_POST, 'purchase_type_id', FILTER_SANITIZE_NUMBER_INT);
            if (!(isset($purchase_id) && !empty($purchase_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Purchase data is mandatory'));
                return true;
            }

            if (!(isset($comments) && !empty($comments))) {
                echo json_encode(array('status' => 2, 'message' => 'Comment is mandatory'));
                return true;
            }
            if (!(isset($status) && !empty($status))) {
                echo json_encode(array('status' => 2, 'message' => 'Status is mandatory'));
                return true;
            }
            if ($purchase_id && $comments && $status) {
                $data_prep = array(
                    'purchase_id' => $purchase_id,
                    'approval_remarks' => $comments,
                    'status' => $status
                );
                $purchase_status = $this->MPurchase->save_purchase_approval($data_prep, $purchase_type_id);
//                dev_export($purchase_status);die;
                if (isset($purchase_status) && !empty($purchase_status) && isset($purchase_status['data_status']) && !empty($purchase_status['data_status']) && $purchase_status['data_status'] == 1) {
                    echo json_encode(array('status' => 1));
                    return true;
                } else {
                    if (isset($purchase_status['message']) && !empty($purchase_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $purchase_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please try again or contact administrator with error code : PAPRCNTR1001'));
                        return true;
                    }

                    return true;
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'All Mandatory fields should be entered with valid values.'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function purchase_view() {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'PURCHASE APPROVAL ';
            $data['user_name'] = $this->session->userdata('user_name');
            $purchase_id = filter_input(INPUT_POST, 'purchase_id', FILTER_SANITIZE_NUMBER_INT);

            if (isset($purchase_id) && !empty($purchase_id)) {
                $purchase_data = $this->MPurchase->get_direct_purchase_approve_list_data($purchase_id);
//                dev_export($purchase_data);die;
                if (isset($purchase_data['data_status']) && !empty($purchase_data['data_status']) && $purchase_data['data_status'] == 1) {
                    $data['purchase_data'] = $purchase_data['data'];
                    $data['purchase_id'] = $purchase_id;
                    $data['sub_title'] = 'PURCHASE VIEW - ' . $purchase_data['data']['master_data']['type_desc'] . " ( " . $purchase_data['data']['master_data']['purchase_code'] . " Dtd : " . date('d-m-Y', strtotime($purchase_data['data']['master_data']['purchase_order_date'])) . " ) ";
                    $data['status'] = $purchase_data['data']['master_data']['status_desc'];
                    $data['purchase_type_id'] = $purchase_data['data']['master_data']['purchase_type_id'];
                    $data['purchase_order'] = $purchase_data['data']['master_data']['purchase_code'];
                    echo json_encode(array('status' => 1, 'message' => 'Data loaded', 'view' => $this->load->view('purchase/purchase_view', $data, TRUE)));
                    return true;
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Purchase details of this purchse is not available.Please check order and try again later or contact administrator.'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Purchase data is requried. Please try again'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function show_purchase_return() {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'PURCHASE RETURN ';
            $purchase_return_list = $this->MPurchase->get_purchase_return_list();
            if (isset($purchase_return_list['data_status']) && !empty($purchase_return_list['data_status']) && $purchase_return_list['data_status'] == 1) {
                $data['purchase_return'] = $purchase_return_list['data'];
            } else {
                $data['purchase_return'] = NULL;
            }
            $this->load->view('purchase/purchase_return_show', $data);
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function purchase_returnview() {

        
       if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'PURCHASE RETURN VIEW';            
            $return_id = filter_input(INPUT_POST, 'return_id', FILTER_SANITIZE_STRING);
            if (isset($return_id) && !empty($return_id)) {
                $return_data = $this->MPurchase->get_return_data_view($return_id);
                if (isset($return_data['data_status']) && !empty($return_data['data_status']) && $return_data['data_status'] == 1) {
                    $data['master_data'] = $return_data['data']['master_data'];
                    $data['detail_data'] = $return_data['data']['detail_data'];
                    $data['comment_data'] = $return_data['data']['comment_data'];
                    $data['return_id'] = $return_id;
                    
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('purchase/return_approval_view', $data, TRUE)));
                    return;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Purchase return data is not available. Please try again'));
                    return;
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Return data is not available'));
                return;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function purchase_return_sup() {
        $data['sub_title'] = 'Supplier Selection ';
        $suppliers_data = $this->MPurchase->get_all_suppliers_list();
        if ($suppliers_data['error_status'] == 0 && $suppliers_data['data_status'] == 1) {
            $data['suppliers_data'] = $suppliers_data['data'];
            $data['message'] = "";
        } else {
            $data['suppliers_data'] = FALSE;
            $data['message'] = $suppliers_data['message'];
        }
        $this->load->view('purchase/show_supplier_return', $data);
    }

    public function edit_purchase_load() {
        if ($this->input->is_ajax_request() == 1) {
            $purchase_id = filter_input(INPUT_POST, 'purchase_id', FILTER_SANITIZE_STRING);
            if (isset($purchase_id) && !empty($purchase_id)) {
                $purchase_details = $this->MPurchase->get_purchase_details($purchase_id);
                if (isset($purchase_details['data_status']) && !empty($purchase_details['data_status']) && $purchase_details['data_status'] == 1) {
                    $data['purchase_data'] = $purchase_details['data'];
                    $data['purchase_id'] = $purchase_id;
                } else {
                    $data['purchase_data'] = NULL;
                    echo json_encode(array('status' => 2, 'message' => 'Purchase data is not available'));
                    return true;
                }
                $item_list = $this->MPurchase->get_all_item_list();
                if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
                    $data['item_data'] = $item_list['data'];
                    $data['message'] = "";
                } else {
                    $data['item_data'] = FALSE;
                    $data['message'] = $item_list['message'];
                }
                $data['sub_title'] = 'EDIT - ' . $purchase_details['data']['master_data']['purchase_code'] . ' ( ' . $purchase_details['data']['master_data']['supplier_name'] . ' )';
                $data['suppier_id'] = $purchase_details['data']['master_data']['supplier_code'];
//                dev_export($data);die;
                echo json_encode(array('status' => 1, 'view' => $this->load->view('purchase/edit_purchase', $data, TRUE)));
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No purchase data available. Please try another data / try again later'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function edit_purchase_save() {
        if ($this->input->is_ajax_request() == 1) {
            $purchase_id = filter_input(INPUT_POST, 'purchase_id', FILTER_SANITIZE_NUMBER_INT);
            $final_item_purchased = filter_input(INPUT_POST, 'final_item_string');
            $item_count = filter_input(INPUT_POST, 'data_counter', FILTER_SANITIZE_STRING);
            $total_qty = filter_input(INPUT_POST, 'total_qty', FILTER_SANITIZE_STRING);
            $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);
            $final_order_value = filter_input(INPUT_POST, 'final_order_value', FILTER_SANITIZE_STRING);
            $remarks = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);


            if (isset($purchase_id) && !empty($purchase_id) && isset($final_item_purchased) && !empty($final_item_purchased)) {

                $data_prep = array(
                    'action' => 'save_edit_purchase_order',
                    'purchase_item_details' => $final_item_purchased,
                    'type_id' => 1,
                    'purchase_id' => $purchase_id,
                    'total_qty' => $total_qty,
                    'item_count' => $item_count,
                    'sub_total' => $sub_total,
                    'final_order_value' => $final_order_value,
                    'remarks' => $remarks
                );

                $status = $this->MPurchase->save_purchase_edit($data_prep);
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

    public function delete_purchase() {
        if ($this->input->is_ajax_request() == 1) {
            $purchase_id = filter_input(INPUT_POST, 'purchase_id', FILTER_SANITIZE_STRING);
            if (isset($purchase_id) && !empty($purchase_id)) {
                $data_prep = array(
                    'action' => 'purchase_delete',
                    'purchase_id' => $purchase_id
                );
                $status = $this->MPurchase->delete_purchase($data_prep);
                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1));
                    return true;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 3, 'message' => $status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'message' => 'An error encountered. Please try again or contact administrator with error code : PD1001'));
                        return true;
                    }
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Purchase data is required.'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }
    public function purchase_returndelete() {
        if ($this->input->is_ajax_request() == 1) {
            $returnid = filter_input(INPUT_POST, 'returnid', FILTER_SANITIZE_STRING);
            if (isset($returnid) && !empty($returnid)) {
                $data_prep = array(
                    'action' => 'purchase_return_delete',
                    'returnid' => $returnid
                );
                $status = $this->MPurchase->delete_returnpurchase($data_prep);
                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1));
                    return true;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 3, 'message' => $status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'message' => 'An error encountered. Please try again or contact administrator with error code : PD1001'));
                        return true;
                    }
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Purchase data is required.'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function purchase_return_edit() {
        if ($this->input->is_ajax_request() == 1) {
            $purchase_return_id = filter_input(INPUT_POST, 'return_id', FILTER_SANITIZE_STRING);
            if (isset($purchase_return_id) && !empty($purchase_return_id)) {
                $return_data = $this->MPurchase->get_purchase_return_data_to_edit($purchase_return_id);
                if (isset($return_data['data_status']) && !empty($return_data['data_status']) && $return_data['data_status'] == 1) {
                    
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Return data is not available'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Return ID is requried'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

}
