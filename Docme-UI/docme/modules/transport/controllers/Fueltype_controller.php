<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fueltype_controller
 *
 * @author chandrajith.edsys
 */
class Fueltype_controller extends MX_Controller {
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
        $this->load->model('FuelType_model', 'MFueltype');
    }
    public function show_fueltype() {


        $data['sub_title'] = 'Fuel Settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Transport Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_fueltype_data = $this->MFueltype->get_all_fueltypes();
        
        if (isset($vehicle_fueltype_data['data']) && !empty($vehicle_fueltype_data['data'])) {
            $data['vehicle_fueltype_data'] = $vehicle_fueltype_data['data'];
        } else {
            $data['vehicle_fueltype_data'] = NULL;
        }

         $this->load->view('fueltype/show_fueltypes', $data);
    }
}
