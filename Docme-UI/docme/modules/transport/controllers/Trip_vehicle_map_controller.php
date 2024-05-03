<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trip_vehicle_map_controller
 *
 * @author Chandrajith
 */
class Trip_vehicle_map_controller extends MX_Controller
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
        $this->load->model('Trip_vehicle_map_model', 'MTripvmap');
    }

    public function show_trip()
    {

        $data['sub_title'] = 'TRIP VEHICLE MAPPING';
        $inst_id = $this->session->userdata('inst_id');
        $trip_data = $this->MTripvmap->get_all_trip_data($inst_id);

        if (isset($trip_data['data']) && !empty($trip_data['data'])) {
            $data['trip_data'] = $trip_data['data'];
        } else {
            $data['trip_data'] = NULL;
        }

        $this->load->view('trip_vehicle_map/show_trip_map', $data);
    }

    public function show_vehicles()
    {


        $inst_id = $this->session->userdata('inst_id');
        $trip_id = filter_input(INPUT_POST, 'id');

        $vehicle_data = $this->MTripvmap->get_all_vehicle_data($inst_id, $trip_id);
        //        dev_export($vehicle_data);die;
        $trip_data = $this->MTripvmap->get_trip_data($inst_id, $trip_id);
        $tripvehiclelink_data = $this->MTripvmap->get_trip_vehiclelinkdata($inst_id, $trip_id);
        //        dev_export($tripvehiclelink_data);die;
        if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
            $data['vehicle_data'] = $vehicle_data['data'];
        } else {
            $data['vehicle_data'] = NULL;
        }

        $data['vechiclelinkid'] = $tripvehiclelink_data['data'][0]['vehicleId'];
        $data['trip_id'] = $trip_data['data'][0]['id'];
        $data['trip_name'] = $trip_data['data'][0]['tripName'];
        $data['trip_pickstarttime'] = $trip_data['data'][0]['pickStartTime'];
        $data['trip_pickendtime'] = $trip_data['data'][0]['pickEndTime'];
        $data['trip_dropstarttime'] = $trip_data['data'][0]['pickStartTime'];
        $data['trip_dropendtime'] = $trip_data['data'][0]['pickEndTime'];
        $data['sub_title'] = 'TRIP NAME - ' . $data['trip_name'];

        $this->load->view('trip_vehicle_map/vehicles_all', $data);
    }

    public function vehicle_linking_trip()
    {
        if ($this->input->is_ajax_request() == 1) {
            $trip_id = filter_input(INPUT_POST, 'trip_id', FILTER_SANITIZE_STRING);
            $trip_name = filter_input(INPUT_POST, 'trip_name', FILTER_SANITIZE_STRING);
            $trip_start_time = filter_input(INPUT_POST, 'trip_starttime', FILTER_SANITIZE_STRING);
            $trip_end_time = filter_input(INPUT_POST, 'trip_endtime', FILTER_SANITIZE_STRING);
            $vehilceid = filter_input(INPUT_POST, 'vehilce_id', FILTER_SANITIZE_STRING);
            $vehiclenum = filter_input(INPUT_POST, 'vehicle_num', FILTER_SANITIZE_STRING);

            $data['sub_title'] = 'TRIP';
            $data['title'] = 'NEW TRIP';
            $this->form_validation->set_rules('trip_name', 'Trip Name', 'trim|required|min_length[2]|max_length[250]');
            $this->form_validation->set_rules('vehicle_num', ' Description', 'trim|required|min_length[2]|max_length[250]');
            if ($this->form_validation->run() == TRUE) {
                $save_trip_vehicle = $this->MTripvmap->save_vehicle_trip_mapping($trip_id, $trip_name, $trip_start_time, $trip_end_time, $vehilceid, $vehiclenum);
                //                dev_export($save_trip_vehicle);die;
                if (isset($save_trip_vehicle['data_status']) && !empty($save_trip_vehicle['data_status']) && $save_trip_vehicle['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    $data['trip_data'] = array(
                        'tripname' => $trip_name
                    );
                    if (isset($save_trip_vehicle['message']) && !empty($save_trip_vehicle['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('trip/add_trip', $data, TRUE), 'message' => $save_trip_vehicle['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('trip/add_trip', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['trip_data'] = array(
                    'tripname' => $trip_name
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('trip/add_trip', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function vehicle_show_details()
    {

        $data['sub_title'] = 'VEHICLE - DETAILS';
        $bus_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

        $inst_id = $this->session->userdata('inst_id');
        $vehicle_data = $this->MTripvmap->get_vehicledetails_data($bus_id, $inst_id);
        if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
            $data['vehicle_data'] = $vehicle_data['data'];
        } else {
            $data['vehicle_data'] = NULL;
        }
        $data['tripid'] = filter_input(INPUT_POST, 'trip_id');

        $this->load->view('trip_vehicle_map/show_vehicle_details', $data);
    }

    public function show_trip_details()
    {
        $data['sub_title'] = 'TRIP - DETAILS';
        $trip_id = filter_input(INPUT_POST, 'id');

        $inst_id = $this->session->userdata('inst_id');
        $trip_data = $this->MTripvmap->get_trip_all_details($inst_id, $trip_id);
        if (isset($trip_data['data']) && !empty($trip_data['data'])) {
            $data['vehicle_data'] = $trip_data['data'];
        } else {
            $data['vehicle_data'] = NULL;
        }

        $this->load->view('trip_vehicle_map/show_trip_details', $data);
    }
}
