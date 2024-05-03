<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Allotment_management_controller
 *
 * @author saranya.kumar
 */
class Allotment_management_controller extends MX_Controller {

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
        $this->load->model('Allotment_management_model', 'MAllotment');
    }

    public function save_allotment() {

        $load = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $total_items = filter_input(INPUT_POST, 'total_items', FILTER_SANITIZE_NUMBER_INT);
        $net_value = filter_input(INPUT_POST, 'net_value', FILTER_SANITIZE_NUMBER_INT);
        $store_id = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_NUMBER_INT);
        $itemdata = filter_input(INPUT_POST, 'itemdata');
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $allotment_data = $this->MAllotment->save_allotment($itemdata, $store_id, $total_items, $net_value, base64_encode($description));
//             dev_export($allotment_data);die;
        if ($allotment_data['error_status'] == 0 && $allotment_data['data_status'] == 1) {
            echo json_encode(array('status' => 1, 'view' => '', TRUE));
            return true;
        } else {
            echo json_encode(array('status' => 2, 'view' => ''));
            return true;
        }
    }

    public function show_allotment() {
//        $data['template'] = 'category/show_category';
//        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $data['sub_title'] = 'STOCK ALLOTMENT ';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Bookstore Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Allotment Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $stockAllot_list = $this->MAllotment->get_all_stockAllotmnt_list();
//        dev_export($stockAllot_list);die;
        if ($stockAllot_list['error_status'] == 0 && $stockAllot_list['data_status'] == 1) {
            $data['stockAllot_data'] = $stockAllot_list['data'];
            $data['message'] = "";
        } else {
            $data['stockAllot_data'] = FALSE;
            $data['message'] = $stockAllot_list['message'];
        }
        $stockAllot_list_in = $this->MAllotment->get_all_stockAllotmnt_in_list();
//        dev_export($stockAllot_list_in);die;
        if ($stockAllot_list_in['error_status'] == 0 && $stockAllot_list_in['data_status'] == 1) {
            $data['stockAllot_data_in'] = $stockAllot_list_in['data'];
            $data['message'] = "";
        } else {
            $data['stockAllot_data_in'] = FALSE;
            $data['message'] = $stockAllot_list_in['message'];
        }


        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['category_data']) && !empty($data['category_data'])) {
                foreach ($data['category_data'] as $category) {
                    $category_status = "";
                    if ($category['isactive'] == 1) {
                        $category_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $category['cate_id'] . '\',\'' . $category['cate_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        //$category_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $category['country_id'] . '\',\'' . $category['country_name'] . '\');"/><span></span></label>';
                    } else {
                        $category_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $category['cate_id'] . '\',\'' . $category['cate_name'] . '\', this)" id="" class="js-switch"  /></a>';
                        //$category_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $category['country_id'] . '\',\'' . $category['country_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $category['cate_id'] . '\',\'' . $category['cate_name'] . '\',\'' . $category['cate_description'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $category['cate_name'] . '" data-original-title="Edit ' . $category['cate_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $category['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $category['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($category['cate_name'], $category['cate_description'], $category_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('allotment/show_allotment', $data);
        }
    }

    public function add_allotment() {
//        $data['template'] = 'category/show_category';
//        $data['title'] = 'ITEM TYPE MANAGEMENT';
        if ($this->input->is_ajax_request() == 1) {
            $store_name = filter_input(INPUT_POST, 'storename', FILTER_SANITIZE_STRING);
            $store_id = filter_input(INPUT_POST, 'storeid', FILTER_SANITIZE_NUMBER_INT);
            $data['sub_title'] = 'ADD ALLOTMENT ';
            $data['store_name'] = $store_name;
            $data['store_id'] = $store_id;
//Get source store from session once user are mapped with store also.

            $item_list = $this->MAllotment->get_all_item_list(MAIN_STORE_ID);
//        dev_export($item_list);die;
            if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
                $data['item_data'] = $item_list['data'];
                $data['message'] = "";
            } else {
                $data['item_data'] = FALSE;
                $data['message'] = $item_list['message'];
            }
            $this->load->view('allotment/add_allotment', $data);
        }
    }

    public function add_allotment_substore() {

        $data['sub_title'] = 'Substore Selection - STOCK ALLOTMENT';
        $data['user_name'] = $this->session->userdata('user_name');
        $substore_data = $this->MAllotment->get_all_substore_list();
        if ($substore_data['error_status'] == 0 && $substore_data['data_status'] == 1) {
            $data['substore_data'] = $substore_data['data'];
            $data['message'] = "";
        } else {
            $data['substore_data'] = FALSE;
            $data['message'] = $substore_data['message'];
        }


        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            if ($this->input->is_ajax_request() == 1) {
                $this->load->view('allotment/allotment_substore', $data);
            } else {
//                $data['item'] = strtoupper(filter_input(INPUT_POST, 'phn', FILTER_SANITIZE_STRING));
                echo json_encode(array('status' => 3, 'view' => $this->load->view('allotment/allotment_substore', $data, TRUE)));
                return;
            }
        } else {
            $this->load->view('allotment/allotment_substore', $data);
        }
    }

//    public function edit_allotment() {
////        $data['template'] = 'category/show_category';
////        $data['title'] = 'ITEM TYPE MANAGEMENT';
//        $data['sub_title'] = 'EDIT ALLOTMENT ';
//        $breadcrump = array(
//            '0' => array(
//                'link' => base_url('dashboard'),
//                'title' => 'Home'),
//            '1' => array(
//                'title' => 'Bookstore Settings',
//                'link' => base_url()),
//            '2' => array(
//                'title' => 'Allotment Management')
//        );
//        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
//        $data['user_name'] = $this->session->userdata('user_name');
//
//        $substore_data = $this->MAllotment->get_all_substore_list();
////        dev_export($substore_data);die;
//        if ($substore_data['error_status'] == 0 && $substore_data['data_status'] == 1) {
//            $data['substore_data'] = $substore_data['data'];
//            $data['message'] = "";
//        } else {
//            $data['substore_data'] = FALSE;
//            $data['message'] = $substore_data['message'];
//        }
//
//        $item_list = $this->MAllotment->get_all_item_lists();
////        dev_export($item_list);die;
//        if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
//            $data['item_data'] = $item_list['data'];
//            $data['message'] = "";
//        } else {
//            $data['item_data'] = FALSE;
//            $data['message'] = $item_list['message'];
//        }
//        $this->load->view('allotment/edit_allotment', $data);
//    }

    public function view_allotment() {
//        $data['template'] = 'category/show_category';
//        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Bookstore Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Allotment Management')
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
                echo json_encode(array('status' => 1, 'message' => 'Data loaded', 'view' => $this->load->view('allotment/view_allotment', $data, TRUE)));
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

    public function view_allotment_in() {
//        $data['template'] = 'category/show_category';
//        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Bookstore Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Allotment Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $allotment_id = filter_input(INPUT_POST, 'allotment_id', FILTER_SANITIZE_NUMBER_INT);
        $store_name = filter_input(INPUT_POST, 'store_name', FILTER_SANITIZE_STRING);

        if (isset($allotment_id) && !empty($allotment_id)) {
            $allot_data = $this->MAllotment->get_allotment_approval_details($allotment_id);
//                dev_export($allot_data);die;
            if (isset($allot_data['data_status']) && !empty($allot_data['data_status']) && $allot_data['data_status'] == 1) {
                $data['sub_title'] = 'INWORD ALLOTMENT VIEW FROM ' . $store_name . " ( ID :" . $allot_data['data']['master_data']['masterid'] . " Dtd : " . date('d-m-Y', strtotime($allot_data['data']['master_data']['date'])) . " ) ";
                $data['allot_data'] = $allot_data['data'];
                $data['allotment_id'] = $allotment_id;

//                    $data['sub_title'] = 'PURCHASE APPROVAL - ' . $allot_data['data']['master_data']['type_desc'] . " ( " . $allot_data['data']['master_data']['purchase_code'] . " Dtd : " . date('d-m-Y', strtotime($allot_data['data']['master_data']['purchase_order_date'])) . " ) ";
//                    $data['status'] = $allot_data['data']['master_data']['status_desc'];
                echo json_encode(array('status' => 1, 'message' => 'Data loaded', 'view' => $this->load->view('allotment/view_allotment_in', $data, TRUE)));
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

    public function approve_allotment() {
        if ($this->input->is_ajax_request() == 1) {
            $allotment_id = filter_input(INPUT_POST, 'allotment_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($allotment_id) && !empty($allotment_id)) {
                $allot_data = $this->MAllotment->get_allotment_approval_details($allotment_id);
//                dev_export($allot_data);die;
                if (isset($allot_data['data_status']) && !empty($allot_data['data_status']) && $allot_data['data_status'] == 1) {
                    $data['sub_title'] = 'STOCK ALLOTMENT APPROVAL - ' . $allot_data['data']['master_data']['store_name'] . " ( ID :" . $allot_data['data']['master_data']['masterid'] . " Dtd : " . date('d-m-Y', strtotime($allot_data['data']['master_data']['date'])) . " ) ";
                    $data['allot_data'] = $allot_data['data'];
                    $data['allotment_id'] = $allotment_id;
                    echo json_encode(array('status' => 1, 'message' => 'Data loaded', 'view' => $this->load->view('allotment/approval_allotment', $data, TRUE)));
                    return true;
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Allotment details of this purchse is not available.Please check order and try again later or contact administrator.'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Allotment data is requried. Please try again'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function ack_allotment() {
        if ($this->input->is_ajax_request() == 1) {
            $allotment_id = filter_input(INPUT_POST, 'allotment_id', FILTER_SANITIZE_NUMBER_INT);
            $store_name = filter_input(INPUT_POST, 'store_name', FILTER_SANITIZE_STRING);
            if (isset($allotment_id) && !empty($allotment_id)) {
                $allot_data = $this->MAllotment->get_allotment_approval_details($allotment_id);
//                dev_export($allot_data);die;
                if (isset($allot_data['data_status']) && !empty($allot_data['data_status']) && $allot_data['data_status'] == 1) {
                    $data['sub_title'] = 'ALLOTMENT ACKNOWLEDGEMENT - ' . $store_name . " ( ID :" . $allot_data['data']['master_data']['masterid'] . " Dtd : " . date('d-m-Y', strtotime($allot_data['data']['master_data']['date'])) . " ) ";
                    $data['allot_data'] = $allot_data['data'];
                    $data['allotment_id'] = $allotment_id;
                    echo json_encode(array('status' => 1, 'message' => 'Data loaded', 'view' => $this->load->view('allotment/ack_allotment', $data, TRUE)));
                    return true;
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Allotment details of this purchse is not available.Please check order and try again later or contact administrator.'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Allotment data is requried. Please try again'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function search_item_for_allotment() {
        if ($this->input->is_ajax_request() == 1) {
            $search_query = filter_input(INPUT_POST, 'search_query', FILTER_SANITIZE_STRING);
            $store_id = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_STRING);
            $data['action'] = 'search_item_stock_for_allotment';
            $data['count'] = 15;
            $data['mode'] = 'search';
            $data['name'] = $search_query;
            $data['code'] = $search_query;
            $data['barcode'] = $search_query;
            $data['store_id'] = MAIN_STORE_ID;

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

    public function allotment_delete() {
        if ($this->input->is_ajax_request() == 1) {
            $allotment_id = filter_input(INPUT_POST, 'allotment_id', FILTER_SANITIZE_STRING);
            if (isset($allotment_id) && !empty($allotment_id)) {
                $data_prep = array(
                    'action' => 'allotment_delete',
                    'allotment_id' => $allotment_id
                );
                $status = $this->MAllotment->delete_allotment($data_prep);
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

    public function save_allotmet_status() {
        if ($this->input->is_ajax_request() == 1) {
            $allotment_id = filter_input(INPUT_POST, 'allotment_id', FILTER_SANITIZE_NUMBER_INT);
            $comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
            if (!(isset($allotment_id) && !empty($allotment_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Allotment data is mandatory'));
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
            if ($allotment_id && $comments && $status) {
                $data_prep = array(
                    'allotment_id' => $allotment_id,
                    'approval_remarks' => $comments,
                    'status' => $status
                );
                $allotment_status = $this->MAllotment->save_allotment_approval($data_prep);
//                dev_export($allotment_status);die;
                if (isset($allotment_status) && !empty($allotment_status) && isset($allotment_status['data_status']) && !empty($allotment_status['data_status']) && $allotment_status['data_status'] == 1) {
                    echo json_encode(array('status' => 1));
                    return true;
                } else {
                    if (isset($allotment_status['data']['error_messages']) && !empty($allotment_status['data']['error_messages'])) {
                        echo json_encode(array('status' => 2, 'message' => $allotment_status['data']['error_messages']));
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

    public function edit_allotment_load() {
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

                $item_list = $this->MAllotment->get_all_item_list(MAIN_STORE_ID);
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
                echo json_encode(array('status' => 1, 'view' => $this->load->view('allotment/edit_allotment', $data, TRUE)));
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No Return data available. Please try another data / try again later'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function edit_allotment_save() {
        if ($this->input->is_ajax_request() == 1) {
            $allotment_id = filter_input(INPUT_POST, 'allotment_id', FILTER_SANITIZE_NUMBER_INT);
            $final_item_allot = filter_input(INPUT_POST, 'final_item_string');
            $total_qty = filter_input(INPUT_POST, 'total_qty', FILTER_SANITIZE_STRING);
            $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);
            $remarks = filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_STRING);


            if (isset($allotment_id) && !empty($allotment_id) && isset($final_item_allot) && !empty($final_item_allot)) {

                $data_prep = array(
                    'action' => 'save_edit_allotment',
                    'allotment_item_details' => $final_item_allot,
                    'allotment_id' => $allotment_id,
                    'total_qty' => $total_qty,
                    'total_value' => $sub_total,
                    'remarks' => $remarks
                );
//                dev_export($data_prep);die;

                $status = $this->MAllotment->save_allotment_edit($data_prep);
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

    public function save_allotmet_ack() {
        if ($this->input->is_ajax_request() == 1) {
            $allotment_id = filter_input(INPUT_POST, 'allotment_id', FILTER_SANITIZE_NUMBER_INT);
            $comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
            if (!(isset($allotment_id) && !empty($allotment_id))) {
                echo json_encode(array('status' => 2, 'message' => 'Allotment data is mandatory'));
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
            if ($allotment_id && $comments && $status) {
                $data_prep = array(
                    'allotment_id' => $allotment_id,
                    'approval_remarks' => $comments,
                    'status' => $status
                );
                $allotment_status = $this->MAllotment->save_allotment_ack($data_prep);
//                dev_export($allotment_status);die;
                if (isset($allotment_status) && !empty($allotment_status) && isset($allotment_status['data_status']) && !empty($allotment_status['data_status']) && $allotment_status['data_status'] == 1) {
                    echo json_encode(array('status' => 1));
                    return true;
                } else {
                    if (isset($allotment_status['data']['error_messages']) && !empty($allotment_status['data']['error_messages'])) {
                        echo json_encode(array('status' => 2, 'message' => $allotment_status['data']['error_messages']));
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

}
