<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Openingstock_controller
 *
 * @author chandrajith.edsys
 */
class Openingstock_controller extends MX_Controller {

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
        $this->load->model('Openingstock_model', 'MOpeningstock');
    }

    public function opening_stock() {
        $storeid = filter_input(INPUT_POST, 'storeid', FILTER_SANITIZE_NUMBER_INT);
//           $storename = filter_input(INPUT_POST, 'storename', FILTER_SANITIZE_STRING);
//         $data['storename'] = $storename;

        $data['sub_title'] = 'OPENING STOCK';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Supplier Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
//                dev_export($data['user_name']);die;
        $item = $this->MOpeningstock->get_all_item_list();
//        dev_export($item);die;
        if ($item['error_status'] == 0 && $item['data_status'] == 1) {
            $data['item_list'] = $item['data'];
            $data['message'] = "";
        } else {
            $data['item_list'] = FALSE;
            $data['message'] = $item['message'];
        }

        $purchase_data = $this->MOpeningstock->get_all_purchase_list();
//         dev_export($purchase_data);die;
        if ($purchase_data['error_status'] == 0 && $purchase_data['data_status'] == 1) {
            $data['purchase_data'] = $purchase_data['data'];
        } else {
            $data['purchase_data'] = FALSE;
            $data['message'] = $purchase_data['message'];
        }

        $stockAllot_list = $this->MOpeningstock->get_all_stockAllotmnt_list();
//        dev_export($stockAllot_list);die;
        if ($stockAllot_list['error_status'] == 0 && $stockAllot_list['data_status'] == 1) {
            $data['stockAllot_data'] = $stockAllot_list['data'];
            $data['message'] = "";
        } else {
            $data['stockAllot_data'] = FALSE;
            $data['message'] = $stockAllot_list['message'];
        }

        $store_data = $this->MOpeningstock->get_all_store_list();
//                dev_export($store_data);die;

        if ($store_data['error_status'] == 0 && $store_data['data_status'] == 1) {
            $data['store_data'] = $store_data['data'];
            $data['message'] = "";
        } else {
            $data['store_data'] = FALSE;
            $data['message'] = $store_data['message'];
        }


        $this->load->view('stock/opening_stock', $data);
//            dev_export($storeid);die;
    }

    public function stock_list() {

        $data['sub_title'] = 'Store Select - OPENING STOCK';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Supplier Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
//                dev_export($data['user_name']);die;
        $store = $this->MOpeningstock->get_store_details();
        if ($store['error_status'] == 0 && $store['data_status'] == 1) {
            $data['store_data'] = $store['data'];
            $data['message'] = "";
        } else {
            $data['store_data'] = FALSE;
            $data['message'] = $store['message'];
        }


        $this->session->set_userdata('current_page', 'supplier');
        $this->session->set_userdata('current_parent', 'gen_sett');


        $this->load->view('stock/stock_list', $data);
    }

    public function open_stock_details() {

        $data['sub_title'] = 'OPENING STOCK';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Supplier Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
//                dev_export($data['user_name']);die;
        $store = $this->MOpeningstock->get_openingstock_master();
//        dev_export($store);die;
        if ($store['error_status'] == 0 && $store['data_status'] == 1) {
            $data['store_data'] = $store['data'];
            $data['message'] = "";
        } else {
            $data['store_data'] = FALSE;
            $data['message'] = $store['message'];
        }


        $this->session->set_userdata('current_page', 'supplier');
        $this->session->set_userdata('current_parent', 'gen_sett');


        $this->load->view('stock/stock_details', $data);
    }

    public function current_stock_list() {
        $storeid = filter_input(INPUT_POST, 'value', FILTER_SANITIZE_NUMBER_INT);


        $data['sub_title'] = 'OPENING STOCK';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Supplier Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
//                dev_export($storeid);die;
        $stock_data = $this->MOpeningstock->get_current_stock_list($storeid);
//                dev_export($stock_data);die;

        if ($stock_data['error_status'] == 0 && $stock_data['data_status'] == 1) {
            $data['stock_data'] = $stock_data['data'];
            $data['message'] = "";
        } else {
            $data['stock_data'] = FALSE;
            $data['message'] = $stock_data['message'];
        }

//                dev_export($stock_data['message']);die;

        $this->session->set_userdata('current_page', 'supplier');
        $this->session->set_userdata('current_parent', 'gen_sett');


        $this->load->view('stock/current_stock_list', $data);
    }

    public function save_openingStock() {
        $stockdata = filter_input(INPUT_POST, 'stockdata');
        $purchase_status = filter_input(INPUT_POST, 'purchase_status', FILTER_SANITIZE_NUMBER_INT);
//         dev_export($stockdata);die;

        $data['sub_title'] = 'OPENING STOCK';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Supplier Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $stock_data = $this->MOpeningstock->save_openingstock_details($stockdata, $purchase_status);
//                dev_export($stock_data);die;

        if ($stock_data['error_status'] == 0 && $stock_data['data_status'] == 1) {
            $data['stock_data'] = $stock_data['data'];
            $data['message'] = "";
        } else {
            $data['stock_data'] = FALSE;
            $data['message'] = $stock_data['message'];
        }
        if ($stock_data['error_status'] == 0 && $stock_data['data_status'] == 1) {
            echo json_encode(array('status' => 1, 'view' => '', TRUE));
            return true;
        }
        else {
            echo json_encode(array('status' => 2, 'view' => '','message'=>' '));
            return true;
        }

//                dev_export($stock_data['message']);die;

        $this->session->set_userdata('current_page', 'supplier');
        $this->session->set_userdata('current_parent', 'gen_sett');


        $this->load->view('stock/current_stock_list', $data);
    }

}
