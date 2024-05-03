<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicle_Incidents_controller
 *
 * @author chandrajith.edsys
 */
class Vehicle_Incidents_controller extends MX_Controller
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
        $this->load->model('Vehicleincidents_model', 'MVehicleinc');
    }
    public function new_vehicleincidents()
    {


        $data['sub_title'] = 'NEW VEHICLE INCIDENT';
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
        $vehicles = $this->MVehicleinc->get_all_vehicles();

        if (isset($vehicles['error_status']) && $vehicles['error_status'] == 0) {
            if ($vehicles['data_status'] == 1) {
                $data['vehicles_data'] = $vehicles['data'];
            } else {
                $data['vehicles_data'] = NULL;
            }
        } else {
            $data['vehicles_data'] = NULL;
        }
        $vehicles_trip = $this->MVehicleinc->get_all_trip();
        // dev_export($vehicles_trip);
        // return;
        if (isset($vehicles_trip['error_status']) && $vehicles_trip['error_status'] == 0) {
            if ($vehicles_trip['data_status'] == 1) {
                $data['vehicles_trip_data'] = $vehicles_trip['data'];
            } else {
                $data['vehicles_trip_data'] = NULL;
            }
        } else {
            $data['vehicles_trip_data'] = NULL;
        }
        $vehicles_pickuppoints = $this->MVehicleinc->get_all_pickuppoint();
        if (isset($vehicles_pickuppoints['error_status']) && $vehicles_pickuppoints['error_status'] == 0) {
            if ($vehicles_pickuppoints['data_status'] == 1) {
                $data['pickuppoint_data'] = $vehicles_pickuppoints['data'];
            } else {
                $data['pickuppoint_data'] = NULL;
            }
        } else {
            $data['pickuppoint_data'] = NULL;
        }

        $this->load->view('vehicle_incidents/add_incidents', $data);
    }
    public function savenew_vehicleincidents()
    {
        if ($this->input->is_ajax_request() == 1) {
            $incident_data_raw = filter_input(INPUT_POST, 'incidentdata');
            $vehicle_type = filter_input(INPUT_POST, 'vehicleselect');
            $desc = filter_input(INPUT_POST, 'idesc', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'VECHICLE INCIDENTS';
            $data['title'] = 'NEW VECHICLE INCIDENTS';

            if ($incident_data_raw) {
                $save_incident_data = $this->MVehicleinc->save_vehicle_incidents($incident_data_raw);
                // dev_export($save_incident_data);
                // die;
                if (isset($save_incident_data['data_status']) && !empty($save_incident_data['data_status']) && $save_incident_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    $data['vehicletype_data'] = array(
                        'vehicle_type' => $vehicle_type,
                        'description' => $desc
                    );
                    if (isset($save_incident_data['message']) && !empty($save_incident_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_incidents/add_incidents', $data, TRUE), 'message' => $save_incident_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('vehicle_incidents/add_incidents', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['vehicletype_data'] = array(
                    'vehicle_type' => $vehicle_type,
                    'description' => $desc
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('vehicle_incidents/add_incidents', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function show_vehicleincidents()
    {
        $data['sub_title'] = 'Vehicle Incident';
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
        $vehicle_data = $this->MVehicleinc->get_all_incident_data($inst_id);
        // dev_export($vehicle_data);
        // die;
        if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
            $data['vehicle_data'] = $vehicle_data['data'];
        } else {
            $data['vehicle_data'] = NULL;
        }
        //        $this->load->view('account_code/show_account_code', $data);
        $this->load->view('vehicle_incidents/show_incidents', $data);
    }

    public function get_trip_pickuppoints()
    {
        if ($this->input->is_ajax_request() == 1) {
            $trip_id = filter_input(INPUT_POST, 'trip_id', FILTER_SANITIZE_NUMBER_INT);
            $inst_id = $this->session->userdata('inst_id');
            $pickup_data = $this->MVehicleinc->get_trip_pickuppoints($trip_id, $inst_id);
            if (isset($pickup_data['data']) && !empty($pickup_data['data'])) {
                $data['pickup_list'] = $pickup_data['data'];
            } else {
                $data['pickup_list'] = NULL;
            }
            echo json_encode($data);
        } else {
            $this->load->view('template/error-500');
        }
    }
}
