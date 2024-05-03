<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transport_fees_controller
 *
 * @author chandrajith.edsys
 */
class Transport_fees_controller extends MX_Controller {

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
        $this->load->model('Transport_fees_model', 'Mroutefees');
    }

    public function show_route() {


        $data['sub_title'] = 'Fees - Route';
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
        $vehicle_route_data = $this->Mroutefees->get_all_vehicle_route_data($inst_id);
//        dev_export($vehicle_route_data);die;
        if (isset($vehicle_route_data['data']) && !empty($vehicle_route_data['data'])) {
            $data['vehicle_route_data'] = $vehicle_route_data['data'];
        } else {
            $data['vehicle_route_data'] = NULL;
        }

//         $vehicle_pickup_data = $this->Mroutefees->get_pickup_data($inst_id,$routeid);
//        dev_export($vehicle_pickup_data);die;
//        if (isset($vehicle_pickup_data['data']) && !empty($vehicle_pickup_data['data'])) {
//            $data['vehicle_pickup_data'] = $vehicle_pickup_data['data'];
//        } else {
//            $data['vehicle_pickup_data'] = NULL;
//        }

        $this->load->view('transport_fees/show_route_fees', $data);
    }

    public function show_pickuppoints() {



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
        $routeid = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $routeName = filter_input(INPUT_POST, 'routeName', FILTER_SANITIZE_STRING);
        $fee_set = filter_input(INPUT_POST, 'feesset', FILTER_SANITIZE_NUMBER_INT);
        if ($fee_set == 1) {
            $data['sub_title'] = 'Pick Up Points - Fees - Students';
        } elseif ($fee_set == 2) {
            $data['sub_title'] = 'Pick Up Points - Fees - Employee';
        } elseif ($fee_set == 3) {
            $data['sub_title'] = 'Pick Up Points - Fees - Guest';
        } else {
            $data['sub_title'] = 'Pick Up Points - Fees - Others';
        }
        $data['feessetdata'] = $fee_set;
        $data['routeid'] = $routeid;
        $data['routeName'] = $routeName;
        $vehicle_pickup_data = $this->Mroutefees->get_pickup_data($inst_id,$routeid,$fee_set);
//        dev_export($vehicle_pickup_data);
//        die;
        if (isset($vehicle_pickup_data['data']) && !empty($vehicle_pickup_data['data'])) {
            $data['vehicle_pickuppoints_data'] = $vehicle_pickup_data['data'];
        } else {
            $data['vehicle_pickuppoints_data'] = NULL;
        }

        $this->load->view('transport_fees/show_pickuppoints_fees', $data);
    }

    public function save_fees_pickuppoints() {
        if ($this->input->is_ajax_request() == 1) {
            $routeid = filter_input(INPUT_POST, 'routeid', FILTER_SANITIZE_NUMBER_INT);           
            $pick_fee_data = filter_input(INPUT_POST, 'pick_fee_data');
            $fees_entity = filter_input(INPUT_POST, 'fees_entity', FILTER_SANITIZE_NUMBER_INT);
            

            $this->form_validation->set_rules('fees_entity', 'fees_entity', 'trim|required|min_length[1]|max_length[30]');

            if ($this->form_validation->run() == TRUE) {

                $save_fees_data = $this->Mroutefees->save_fees_pickuppoint($routeid,$pick_fee_data,$fees_entity);
//                dev_export($save_fees_data);die;
                if (isset($save_fees_data['data_status']) && !empty($save_fees_data['data_status']) && $save_fees_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    $data['trip_data'] = array(
                        'trip' => $trip,
                        'description' => $desc
                    );
                    if (isset($save_fees_data['message']) && !empty($save_fees_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_trip/add_trip', $data, TRUE), 'message' => $save_fees_data['message']));
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

}
