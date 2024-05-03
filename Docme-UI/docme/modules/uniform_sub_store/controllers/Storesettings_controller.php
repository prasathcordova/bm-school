<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Storesettings_controller
 *
 * @author chandrajith.edsys
 */
class Storesettings_controller extends MX_Controller {

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
        $this->load->model('Storesettings_model', 'MSettings');
        $this->load->model('Supplier_model', 'MSupplier');
    }

    public function bookstore() {
        $data['template'] = 'settings/show_settings';
        $data['title'] = 'UNIFORM STORE SETTINGS';
        $data['sub_title'] = 'UNIFORM SETTINGS';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('uniform_dashboard/show-dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Uniform Store'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);

        $this->session->set_userdata('current_page', 'store_sett');
        $this->session->set_userdata('current_parent', 'store_sett');


        $this->load->view('template/store_template', $data);
//        }
    }

    public function storechart() {

//        $data['template'] = 'settings/show_graph';
//        $data['title'] = 'STORE SETTINGS';
        $data['sub_title'] = 'Advance Settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Advance Settings')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
//        $city_data = $this->MSettings->get_all_city_list();
        $country_data = $this->MSettings->get_all_country_list();
        if ($country_data['error_status'] == 0 && $country_data['data_status'] == 1) {
            $data['country_data'] = $country_data['data'];
            $data['message'] = "";
        } else {
            $data['country_data'] = FALSE;
            $data['message'] = $country_data['message'];
        }


        $this->session->set_userdata('current_page', 'country');
        $this->session->set_userdata('current_parent', 'gen_sett');

        $count = $this->MSettings->get_settings_graph_details();
//        dev_export($count);die;
        if ($count['error_status'] == 0 && $count['data_status'] == 1) {
            $data['count'] = $count['data'];
            $data['message'] = "";
        } else {
            $data['count'] = FALSE;
//            dev_export($data['student_count']);die;
            $data['message'] = $count['message'];
        }
        $this->load->view('settings/show_graph', $data);
//        }
    }

    public function stock() {
        $data['template'] = 'stock/stock_manager';
        $data['title'] = 'STOCK MANAGEMENT';
        $data['sub_title'] = 'Stock Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Advance Settings')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
//        $city_data = $this->MSettings->get_all_city_list();
        $country_data = $this->MSettings->get_all_country_list();
        if ($country_data['error_status'] == 0 && $country_data['data_status'] == 1) {
            $data['country_data'] = $country_data['data'];
            $data['message'] = "";
        } else {
            $data['country_data'] = FALSE;
            $data['message'] = $country_data['message'];
        }


        $this->session->set_userdata('current_page', 'country');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['country_data']) && !empty($data['country_data'])) {
                foreach ($data['country_data'] as $country) {
                    $country_status = "";
                    if ($country['isactive'] == 1) {
                        $country_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        //$country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    } else {
                        $country_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\', this)" id="" class="js-switch"  /></a>';
                        //$country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\',\'' . $country['country_abbr'] . '\',\'' . $country['currency_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $country['country_name'] . '" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($country['country_name'], $country['country_abbr'], $country['currency_name'], $country_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('template/home_template', $data);
        }
    }

    public function storegraph2() {
//        $data['template'] = 'settings/show_graph';
//        $data['title'] = 'COURSE SETTINGS';
        $data['sub_title'] = 'store settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Course Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Course Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $city_data = $this->MSettings->get_all_city_list();
        if ($city_data['error_status'] == 0 && $city_data['data_status'] == 1) {
            $data['city_data'] = $city_data['data'];
            $data['message'] = "";
        } else {
            $data['city_data'] = FALSE;
            $data['message'] = $city_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['city_data']) && !empty($data['city_data'])) {
                foreach ($data['city_data'] as $city) {
                    $city_status = "";
                    if ($city['isactive'] == 1) {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    } else {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_city(\'' . $city['city_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $city['city_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>';
                    $formatted_data[] = array($city['city_name'], $city['city_abbr'], $city['state_name'], $city_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('settings/show_graph', $data);
        }
    }

}
