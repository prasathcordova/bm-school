<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicletrip_controller
 *
 * @author chandrajith.edsys
 */
class Vehicletrip_controller extends MX_Controller {
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
        $this->load->model('Vehiceltrip_model', 'MVehicletrip');
    }
    public function show_vehicle_trip() {


        $data['sub_title'] = 'Transport Settings';
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
        $vehicle_trip_data = $this->MVehicletrip->get_all_vehicle_trip_data($inst_id);
        
        if (isset($vehicle_trip_data['data']) && !empty($vehicle_trip_data['data'])) {
            $data['vehicle_trip_data'] = $vehicle_trip_data['data'];
        } else {
            $data['vehicle_trip_data'] = NULL;
        }

        $this->load->view('vehicle_trip/show_trip', $data);
    }
      public function add_trip($lang = '') {

//        $this->lang->load('content', $lang == '' ? 'en' : $lang);
//        $data['account_code'] = $this->lang->line('Account Code');
//        $data['account_code'] =$this->lang->line('Account Code');
//        $data['message']=$this->lang->line('message');
//        dev_export($data['account_code']);
//        $data['description'] = $this->lang->line('Description');
//        $data['name']=$this->lang->line('name');

        $data['sub_title'] = 'Vehicle Trip';
           $data['title'] = 'NEW TRIP';
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
//        dev_export($data);die;

        $this->load->view('vehicle_trip/add_trip', $data);
    }
    public function save_new_trip() {
        if ($this->input->is_ajax_request() == 1) {
            $trip = filter_input(INPUT_POST, 'trip', FILTER_SANITIZE_STRING);
            $desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'TRIP';
            $data['title'] = 'NEW TRIP';            
            $this->form_validation->set_rules('trip', 'trip', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('description', ' Description', 'trim|required|min_length[3]|max_length[100]');
            if ($this->form_validation->run() == TRUE) {
                $save_trip_data = $this->MVehicletrip->save_trip_new($trip, $desc);
//                dev_export($save_trip_data);die;
                if (isset($save_trip_data['data_status']) && !empty($save_trip_data['data_status']) && $save_trip_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    $data['trip_data'] = array(
                        'trip' => $trip,
                        'description' => $desc  
                    );
                    if (isset($save_trip_data['message']) && !empty($save_trip_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_trip/add_trip', $data, TRUE), 'message' => $save_trip_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('vehicle_trip/add_trip', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['trip_data'] = array(
                    'trip' => $trip,
                    'description' => $desc                  
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('vehicle_trip/add_trip', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function edit_trip() {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'TRIP';
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

            $trip_id = filter_input(INPUT_POST, 'trip_id', FILTER_SANITIZE_STRING);
            $tripName = filter_input(INPUT_POST, 'tripName', FILTER_SANITIZE_STRING);
//            dev_export($type_name);die;
            if (isset($trip_id) && !empty($trip_id)) {
                $trip_data = $this->MVehicletrip->get_trip_data($trip_id);
                if (isset($trip_data['data_status']) && !empty($trip_data['data_status']) && $trip_data['data_status'] == 1 && isset($trip_data['data'][0])) {
                    $data['trip_data'] = $trip_data['data'][0];
                    $data['title'] = 'Edit - ' . $tripName;
                    
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('vehicle_trip/edit_trip', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such Trip. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Trip is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function save_edit_trip() {
        if ($this->input->is_ajax_request() == 1) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $trip = filter_input(INPUT_POST, 'trip', FILTER_SANITIZE_STRING);
            $desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            
            $data['sub_title'] = 'Trip';
            $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);

            $this->form_validation->set_rules('trip', ' Trip', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('description', ' Description', 'trim|required|min_length[3]|max_length[100]');

            if ($this->form_validation->run() == TRUE) {                               
                $save_trip_data = $this->MVehicletrip->save_trip_edit($id,$trip,$desc);
                if (isset($save_trip_data['data_status']) && !empty($save_trip_data['data_status']) && $save_trip_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['trip_data'] = array(
                        'trip' => $trip,
                        'Description' => $desc,
                        'id' => $id,                                                 
                    );
//                    dev_export($data);die;
                    $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                    $data['sub_title'] = 'VEHICLE TYPE';
                    if (isset($save_trip_data['message']) && !empty($save_trip_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_trip/edit_trip', $data, TRUE), 'message' => $save_trip_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('vehicle_trip/edit_trip', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['trip_data'] = array(
                    'trip' => $trip,
                    'Description' => $desc,
                    'id' => $id,
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('vehicle_trip/edit_trip', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function change_status_of_trip() {
                
        if ($this->input->is_ajax_request() == 1) {
            $trip_id = filter_input(INPUT_POST, 'trip_id', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            if (isset($trip_id) && !empty($trip_id)) {
                $status_report = $this->MVehicletrip->update_status_trip($trip_id, $status);

                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Trip status updated successfully'));
                    return true;
                } else {
                    if (isset($status_report['message']) && !empty($status_report['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status_report['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating status of Trip. Please try again later'));
                        return TRUE;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Trip  is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
