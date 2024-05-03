<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fuel_log_controller
 *
 * @author chandrajith.edsys
 */
class Fuel_log_controller extends MX_Controller
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
        $this->load->model('Fuel_log_model', 'MFuelLog');
    }

    public function load_vehicle()
    {

        $data['sub_title'] = 'Fuel Log';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $inst_id = $this->session->userdata('inst_id');

        $vehicle_data = $this->MFuelLog->get_all_vehicle_details($inst_id);
        //        dev_export($vehicle_data);die;
        if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
            $data['vehicle_data'] = $vehicle_data['data'];
        } else {
            $data['vehicle_data'] = NULL;
        }

        //         $this->load->view('vehicle_model_yr/show_modelyr', $data);

        $this->load->view('fuellog/vehicle_list', $data);
    }

    public function add_fuel_log()
    {


        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $vehicle_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $vehicleNum = filter_input(INPUT_POST, 'vehicleNum', FILTER_SANITIZE_STRING);
        $isActive = filter_input(INPUT_POST, 'isActive', FILTER_SANITIZE_STRING);
        $data['sub_title'] = 'Fuel Log - ' . $vehicleNum;
        $inst_id = $this->session->userdata('inst_id');

        $vehicle_data = $this->MFuelLog->get_fuel_details($vehicle_id, $inst_id);
        //dev_export($vehicle_data);
        //die;
        if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
            $data['fuellog_data'] = $vehicle_data['data'];
        } else {
            $data['fuellog_data'] = NULL;
        }
        $data['vehicle_id'] = $vehicle_id;
        $data['vehicleNum'] = $vehicleNum;
        $data['isActive'] = $isActive;

        //         $this->load->view('vehicle_model_yr/show_modelyr', $data);

        $this->load->view('fuellog/show_fuellog', $data);
    }

    public function fuel_log_entry($lang = '')
    {

        //        $this->lang->load('content', $lang == '' ? 'en' : $lang);
        //        $data['account_code'] = $this->lang->line('Account Code');
        //        $data['account_code'] =$this->lang->line('Account Code');
        //        $data['message']=$this->lang->line('message');
        //        dev_export($data['account_code']);
        //        $data['description'] = $this->lang->line('Description');
        //        $data['name']=$this->lang->line('name');


        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
        $vehicleNum = filter_input(INPUT_POST, 'vehicleNum', FILTER_SANITIZE_STRING);
        $inst_id = $this->session->userdata('inst_id');
        $data['title'] = 'NEW Fuel Log';

        $fuel_data = $this->MFuelLog->get_fueltype_details($vehicle_id, $inst_id);
        $fueltype = $fuel_data['data'][0]['fuelTypeName'];

        $data['fuel_type_id'] = $fuel_data['data'][0]['id'];
        $data['fuel_types'] = $fuel_data['data'][0]['fuelTypeName'];
        $data['sub_title'] = 'Add New Fuel Log - ' . $fueltype . ' Vehicle';
        if (isset($fuel_data['data']) && !empty($fuel_data['data'])) {
            $data['fuel_type'] = $fuel_data['data'];
        } else {
            $data['fuel_type'] = NULL;
        }
        $data['vehicle_id'] = $vehicle_id;
        $data['vehicleNum'] = $vehicleNum;
        $this->load->view('fuellog/add_fuellog', $data);
    }

    public function save_fuel_log_entry()
    {
        if ($this->input->is_ajax_request() == 1) {
            $fuellog_data_raw = filter_input(INPUT_POST, 'fuellogdata');

            $data['sub_title'] = 'VECHICLE INCIDENTS';
            $data['title'] = 'NEW VECHICLE INCIDENTS';

            if ($fuellog_data_raw) {
                $save_fuellog_data = $this->MFuelLog->save_vehicle_fuel_log($fuellog_data_raw);
                if (isset($save_fuellog_data['data_status']) && !empty($save_fuellog_data['data_status']) && $save_fuellog_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                }
            } else {
                $this->load->view(ERROR_500);
            }
        }
    }
}
