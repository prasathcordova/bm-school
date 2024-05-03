<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rates_controller
 *
 * @author chandrajith.edsys
 */
class Rates_controller extends MX_Controller {

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
        $this->load->model('Rates_model', 'MRates');
    }

    public function update_rates() {
        $storeid = filter_input(INPUT_POST, 'storeid', FILTER_SANITIZE_NUMBER_INT);
        $ratesetdata = filter_input(INPUT_POST, 'ratesetdata');
        $data['user_name'] = $this->session->userdata('user_name');

        $store = $this->MRates->update_store_details($storeid, $ratesetdata);
//        dev_export($store);die;
        if ($store['error_status'] == 0 && $store['data_status'] == 1) {
            echo json_encode(array('status' => 1, 'view' => '', TRUE));
            return true;
        } else {
            echo json_encode(array('status' => 2, 'view' => '','message'=>'An error ens'));
            return true;
        }
    }

    public function store_selection() {

        $data['sub_title'] = 'Store Selection - Rates';
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
        $store = $this->MRates->get_store_details();
        if ($store['error_status'] == 0 && $store['data_status'] == 1) {
            $data['store_data'] = $store['data'];
            $data['message'] = "";
        } else {
            $data['store_data'] = FALSE;
            $data['message'] = $store['message'];
        }


        $this->session->set_userdata('current_page', 'supplier');
        $this->session->set_userdata('current_parent', 'gen_sett');


        $this->load->view('rate/store_select', $data);
    }

    public function show_rates() {
        if ($this->input->is_ajax_request() == 1) {
            $storeid = filter_input(INPUT_POST, 'storeid', FILTER_SANITIZE_NUMBER_INT);
//            dev_export($storeid);die;
            $storename = filter_input(INPUT_POST, 'storename', FILTER_SANITIZE_STRING);
            $data['storename'] = $storename;
            $data['storeid'] = $storeid;
            $data['sub_title'] = 'RATE MANAGEMENT';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'),
                '1' => array(
                    'title' => 'Store Settings',
                    'link' => base_url()),
                '2' => array(
                    'title' => 'Store Management')
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $data['user_name'] = $this->session->userdata('user_name');
            // 18-11-2017 $item_data = $this->MRates->get_all_rates_list();
            $store_id = strtoupper(filter_input(INPUT_POST, 'storeid', FILTER_SANITIZE_STRING));
//            dev_export($data_prep);die;
            $item_data = $this->MRates->get_all_rates_list_substore();
//            dev_export($item_data); die;
            if ($item_data['error_status'] == 0 && $item_data['data_status'] == 1) {
                $data['item_data'] = $item_data['data'];
                $data['message'] = "";
            } else {
                $data['item_data'] = FALSE;
                $data['message'] = $item_data['message'];
            }



            $this->session->set_userdata('current_page', 'itemmgmt');
            $this->session->set_userdata('current_parent', 'store_sett');

            if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
                $formatted_data = array();
                if (isset($data['item_data']) && !empty($data['item_data'])) {
                    foreach ($data['item_data'] as $item) {
                        $item_status = "";
                        if ($item['isactive'] == 1) {
                            $item_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $item['item_id'] . '\',\'' . $item['item_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        } else {
                            $item_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $item['item_id'] . '\',\'' . $item['item_name'] . '\', this)" id="" class="js-switch"  /></a>';
                        }
                        $task_html = '<a href="javascript:void(0);" onclick="edit_item(\'' . $item['item_id'] . '\',\'' . $item['item_name'] . '\',\'' . $item['item_description'] . '\',\'' . $item['name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $item['item_name'] . '" data-original-title="Edit ' . $item['item_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';

                        $formatted_data[] = array($item['item_name'], $item['item_description'], $item['name'], $item_status, $task_html);
                    }
                }


                echo json_encode($formatted_data);
                return;
            } else {
                $this->load->view('rate/show_rate', $data);
            }
        }
    }

}
