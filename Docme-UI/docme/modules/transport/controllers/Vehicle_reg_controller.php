<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicle_reg_controller
 *
 * @author chandrajith.edsys
 */
class Vehicle_reg_controller extends MX_Controller{
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
        $this->load->model('Vehicle_reg_model', 'MVreg');
    }
    public function save_new_vehicle() {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_num = filter_input(INPUT_POST, 'vehicleNum', FILTER_SANITIZE_STRING);
            $regnum = filter_input(INPUT_POST, 'regnum', FILTER_SANITIZE_STRING);
            $chasisnum = filter_input(INPUT_POST, 'chasisnum', FILTER_SANITIZE_STRING);
            $engine_num = filter_input(INPUT_POST, 'engine_num', FILTER_SANITIZE_STRING);
            $vehicleModelId = filter_input(INPUT_POST, 'vehicleModelId', FILTER_SANITIZE_NUMBER_INT);
            $vehicleMake = filter_input(INPUT_POST, 'vehicleMake', FILTER_SANITIZE_STRING);
            $seatCapacity = filter_input(INPUT_POST, 'seatCapacity', FILTER_SANITIZE_NUMBER_INT);
            $companyId = filter_input(INPUT_POST, 'companyId', FILTER_SANITIZE_NUMBER_INT);
            $fuelTypeId = filter_input(INPUT_POST, 'fuelTypeId', FILTER_SANITIZE_NUMBER_INT);
            $InsuranceCompanyId = filter_input(INPUT_POST, 'InsuranceCompanyId', FILTER_SANITIZE_NUMBER_INT);
            $insuranceDate = filter_input(INPUT_POST, 'insuranceDate', FILTER_SANITIZE_STRING);
            $insuranceExpiryDate = filter_input(INPUT_POST, 'insuranceExpiryDate', FILTER_SANITIZE_STRING);
            $taxDate = filter_input(INPUT_POST, 'taxDate', FILTER_SANITIZE_STRING);           
            $taxExpiryDate = filter_input(INPUT_POST, 'taxExpiryDate', FILTER_SANITIZE_STRING);
            $permitDate = filter_input(INPUT_POST, 'permitDate', FILTER_SANITIZE_STRING);
            $permitExpiryDate = filter_input(INPUT_POST, 'permitExpiryDate', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'VECHICLE ';
            $data['title'] = 'NEW VECHICLE ';            
            $this->form_validation->set_rules('vehicletype', ' Vehicle Type', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('description', ' Description', 'trim|required|min_length[3]|max_length[100]');
            if ($this->form_validation->run() == TRUE) {
                $save_vehicle_reg_data = $this->Mvtype->save_vehicle_type_new($vehicle_type, $desc);
//                dev_export($save_vehicle_type_data);die;
                if (isset($save_vehicle_reg_data['data_status']) && !empty($save_vehicle_reg_data['data_status']) && $save_vehicle_reg_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['vehiclereg_data'] = array(
                        'vehicle_regnum' => $regnum,
                        'chasisnum' => $chasisnum  
                    );
                    if (isset($save_vehicle_reg_data['message']) && !empty($save_vehicle_reg_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_type/add_vehicle_type', $data, TRUE), 'message' => $save_vehicle_reg_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('vehicle_type/add_vehicle_type', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['vehiclereg_data'] = array(
                    'vehicle_regnum' => $regnum,
                    'chasisnum' => $chasisnum                  
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('vehicle_registration/new_registration', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
