<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trip_controller
 *
 * @author Chandrajith
 */
class Trip_controller extends MX_Controller
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
        $this->load->model('Trip_model', 'MTrip');
    }

    public function show_trip()
    {

        $data['sub_title'] = 'TRIP';
        $inst_id = $this->session->userdata('inst_id');
        $trip_data = $this->MTrip->get_all_trip_data($inst_id);
        if (isset($trip_data['data']) && !empty($trip_data['data'])) {
            $data['trip_data'] = $trip_data['data'];
        } else {
            $data['trip_data'] = NULL;
        }

        $this->load->view('trip/show_trip', $data);
    }

    public function add_trip($lang = '')
    {
        $data['sub_title'] = 'NEW TRIP';
        $data['title'] = 'New Trip';

        $inst_id = $this->session->userdata('inst_id');
        $data['all_pickpoints'] = $this->MTrip->get_active_pickuppoints($inst_id);
        $this->load->view('trip/add_trip', $data);
    }

    public function trip_save()
    {
        if ($this->input->is_ajax_request() == 1) {
            $save_data = [
                'tripName' => filter_input(INPUT_POST, 'tripName', FILTER_SANITIZE_STRING),
                'tripCode' => filter_input(INPUT_POST, 'tripCode', FILTER_SANITIZE_STRING),
                'tripDescription' => filter_input(INPUT_POST, 'tripDescription', FILTER_SANITIZE_STRING),
                'pickStartTime' => filter_input(INPUT_POST, 'pickStartTime', FILTER_SANITIZE_STRING),
                'pickEndTime' => filter_input(INPUT_POST, 'pickEndTime', FILTER_SANITIZE_STRING),
                'dropStartTime' => filter_input(INPUT_POST, 'dropStartTime', FILTER_SANITIZE_STRING),
                'dropEndTime' => filter_input(INPUT_POST, 'dropEndTime', FILTER_SANITIZE_STRING),
            ];
            $form_data = filter_input(INPUT_POST, 'formData', FILTER_SANITIZE_STRING);
            $form_params = [];
            parse_str($form_data, $form_params);
            // dev_export($_POST);
            // die;
            $data['sub_title'] = 'TRIP';
            $data['title'] = 'NEW TRIP';

            $this->form_validation->set_rules('tripName', 'Trip Name', 'trim|required|min_length[2]|max_length[250]');
            $this->form_validation->set_rules('tripCode', 'Trip Code', 'trim|required|min_Length[5]|max_Length[5]');
            $this->form_validation->set_rules('tripDescription', ' Description', 'trim|required|min_length[2]|max_length[250]');
            if ($this->form_validation->run() == TRUE) {
                $save_trip = $this->MTrip->save_trip($save_data);
                if (isset($save_trip['data_status']) && !empty($save_trip['data_status']) && $save_trip['data_status'] == 1) {
                    $trip_pickup_times = isset($form_params['trip_pickup_time']) ? $form_params['trip_pickup_time'] : [];
                    $trip_drop_times = isset($form_params['trip_drop_time']) ? $form_params['trip_drop_time'] : [];;
                    $trip_id = $save_trip['data']['id'];
                    $error = 0;
                    if (!empty($trip_pickup_times)) {
                        foreach ($trip_pickup_times as $pickuppoint_id => $pickup_time) {
                            if ($trip_pickup_times[$pickuppoint_id] != '' &&  $trip_drop_times[$pickuppoint_id] != '') {
                                $save_trip_relation_data = [
                                    'tripId' => $trip_id,
                                    'pickuppointId' => $pickuppoint_id,
                                    'pickuptime' => $trip_pickup_times[$pickuppoint_id],
                                    'droptime' => $trip_drop_times[$pickuppoint_id]
                                ];
                                $save_trip_relation = $this->MTrip->save_trip_pickpoint_relation($save_trip_relation_data);
                                if (isset($save_trip_relation['data_status']) && !empty($save_trip_relation['data_status']) && $save_trip_relation['data_status'] == 1) {
                                    $x = $error;
                                } else {
                                    $error++;
                                }
                            }
                        }
                    }
                    if ($error == 0) {
                        echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully,Mapping Failed'));
                        return TRUE;
                    }
                } else {
                    if (isset($save_trip['message']) && !empty($save_trip['message'])) {
                        echo json_encode(array('status' => 2, 'view' => '', 'message' => $save_trip['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => '', 'message' => 'Connection Error , Please Contact Support'));
                        return true;
                    }
                }
            } else {
                echo json_encode(array('status' => 3, 'view' => '', 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function change_status_trip()
    {
        if ($this->input->is_ajax_request() == 1) {
            $tripid = filter_input(INPUT_POST, 'tripid', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            if (isset($tripid) && !empty($tripid)) {
                $status_report = $this->MTrip->update_status_trip($tripid, $status);
                // dev_export($status_report);
                // return;

                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Trip status updated successfully'));
                    return true;
                } else {
                    if (isset($status_report['message']) && !empty($status_report['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status_report['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating status of Pickup Point. Please try again later'));
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

    function edit_trip()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'TRIP';
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

            $tripId = filter_input(INPUT_POST, 'tripId', FILTER_SANITIZE_STRING);
            $tripName = filter_input(INPUT_POST, 'tripName', FILTER_SANITIZE_STRING);
            //            dev_export($type_name);die;
            if (isset($tripId) && !empty($tripId)) {
                $trip_data = $this->MTrip->get_trip_data($tripId);

                $trippickuppoint_relation_data = $this->MTrip->get_trippickuppoint_relation_data(0, $tripId);
                // dev_export($trippickuppoint_relation_data);
                // die;
                if (isset($trip_data['data_status']) && !empty($trip_data['data_status']) && $trip_data['data_status'] == 1 && isset($trip_data['data'][0])) {
                    $inst_id = $this->session->userdata('inst_id');
                    $data['all_pickpoints'] = $this->MTrip->get_active_pickuppoints($inst_id);
                    $data['trip_data'] = $trip_data['data'][0];
                    $data['title'] = 'Edit - ' . $tripName;
                    $data['trip_pickpoint_relation_data'] = $trippickuppoint_relation_data['data'];

                    echo json_encode(array('status' => 1, 'view' => $this->load->view('trip/edit_trip', $data, TRUE)));
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

    function save_edit_trip()
    {
        if ($this->input->is_ajax_request() == 1) {
            $save_data = [
                'tripId' => filter_input(INPUT_POST, 'tripId', FILTER_SANITIZE_STRING),
                'tripName' => filter_input(INPUT_POST, 'tripName', FILTER_SANITIZE_STRING),
                'tripCode' => filter_input(INPUT_POST, 'tripCode', FILTER_SANITIZE_STRING),
                'tripDescription' => filter_input(INPUT_POST, 'tripDescription', FILTER_SANITIZE_STRING),
                'pickStartTime' => filter_input(INPUT_POST, 'pickStartTime', FILTER_SANITIZE_STRING),
                'pickEndTime' => filter_input(INPUT_POST, 'pickEndTime', FILTER_SANITIZE_STRING),
                'dropStartTime' => filter_input(INPUT_POST, 'dropStartTime', FILTER_SANITIZE_STRING),
                'dropEndTime' => filter_input(INPUT_POST, 'dropEndTime', FILTER_SANITIZE_STRING),
            ];

            $trip_id = $save_data['tripId'];
            $data['sub_title'] = 'Trip';
            $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $data['all_pickpoints'] = $this->MTrip->get_active_pickuppoints($inst_id);
            $trippickuppoint_relation_data = $this->MTrip->get_trippickuppoint_relation_data(0, $save_data['tripId']);
            $data['trip_pickpoint_relation_data'] = $trippickuppoint_relation_data['data'];
            $this->form_validation->set_rules('tripName', ' Trip', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('tripCode', ' Trip Code', 'trim|required|min_length[5]|max_length[5]');
            $this->form_validation->set_rules('tripDescription', ' Description', 'trim|required|min_length[3]|max_length[100]');

            if ($this->form_validation->run() == TRUE) {
                $save_trip_data = $this->MTrip->save_trip_edit($save_data);
                // dev_export($save_trip_data);
                // die;
                if (isset($save_trip_data['data_status']) && !empty($save_trip_data['data_status']) && $save_trip_data['data_status'] == 1) {
                    $trip_pickup_times = $this->input->post('trip_pickup_time');
                    $trip_drop_times = $this->input->post('trip_drop_time');
                    $error = 0;
                    $save_trip_relation_data = [
                        'tripId' => $trip_id,
                        'pickuppointId' => 999,
                        'pickuptime' => 999,
                        'droptime' => 999,
                        'update_type' => 'trip_update'
                    ];
                    $save_trip_relation = $this->MTrip->save_trip_pickpoint_relation($save_trip_relation_data);
                    if (!empty($trip_pickup_times)) {
                        foreach ($trip_pickup_times as $pickuppoint_id => $pickup_time) {
                            if ($trip_pickup_times[$pickuppoint_id] != '' &&  $trip_drop_times[$pickuppoint_id] != '') {
                                $save_trip_relation_data = [
                                    'tripId' => $trip_id,
                                    'pickuppointId' => $pickuppoint_id,
                                    'pickuptime' => $trip_pickup_times[$pickuppoint_id],
                                    'droptime' => $trip_drop_times[$pickuppoint_id],
                                    'update_type' => 'NULL'
                                ];

                                $save_trip_relation = $this->MTrip->save_trip_pickpoint_relation($save_trip_relation_data);
                                if (isset($save_trip_relation['data_status']) && !empty($save_trip_relation['data_status']) && $save_trip_relation['data_status'] == 1) {
                                    $x = $error;
                                } else {
                                    $error++;
                                }
                            }
                        }
                    }
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['trip_data'] = $save_data;
                    //dev_export($data);die;
                    $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                    $data['sub_title'] = 'Trip';
                    if (isset($save_trip_data['message']) && !empty($save_trip_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('trip/edit_trip', $data, TRUE), 'message' => $save_trip_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('trip/edit_trip', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['trip_data'] = $save_data;
                echo json_encode(array('status' => 3, 'view' => $this->load->view('trip/edit_trip', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
