<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pickuppoint_controller
 *
 * @author chandrajith.edsys
 */
class Pickuppoint_controller extends MX_Controller
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
        $this->load->model('Pickuppoint_model', 'MPickpoints');
        $this->load->model('Trip_model', 'MTrip');
    }
    public function show_pickuppoints()
    {


        $data['sub_title'] = 'Pickup Point';
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
        $vehicle_pickuppoints_data = $this->MPickpoints->get_all_pickuppoints($inst_id);
        // dev_export($vehicle_pickuppoints_data);
        // die;
        if (isset($vehicle_pickuppoints_data['data']) && !empty($vehicle_pickuppoints_data['data'])) {
            $data['vehicle_pickuppoints_data'] = $vehicle_pickuppoints_data['data'];
        } else {
            $data['vehicle_pickuppoints_data'] = NULL;
        }

        $this->load->view('pickup_points/show_pickuppoints', $data);
    }
    public function add_pickuppoint($lang = '')
    {

        //        $this->lang->load('content', $lang == '' ? 'en' : $lang);
        //        $this->lang->load('content', 'ar');
        //        dev_export($this->lang->line('Account Code'));
        //        $data['account_code'] = $this->lang->line('Account Code');
        //        $data['account_code'] =$this->lang->line('Account Code');
        //        $data['message']=$this->lang->line('message');
        //        dev_export($data['account_code']);die;
        //        $data['description'] = $this->lang->line('Description');
        //        $data['name']=$this->lang->line('name');

        $data['sub_title'] = 'PICKUP POINT';
        $data['title'] = 'NEW PICKUP POINT';
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
        $data['all_trips'] = $this->MPickpoints->get_all_trip_data($inst_id);
        $this->load->view('pickup_points/add_pickuppoint', $data);
    }
    public function save_new_pickuppoint()
    {
        if ($this->input->is_ajax_request() == 1) {

            $save_data = [
                'pickpointName' => filter_input(INPUT_POST, 'pickpointName', FILTER_SANITIZE_STRING),
                'pickuppointDescription' => filter_input(INPUT_POST, 'pickuppointDescription', FILTER_SANITIZE_STRING),
                'pickuppointLocation' => filter_input(INPUT_POST, 'pickuppointLocation', FILTER_SANITIZE_STRING),
                'pickuppointLatitude' => filter_input(INPUT_POST, 'pickuppointLatitude', FILTER_SANITIZE_STRING),
                'pickuppointLongitude' => filter_input(INPUT_POST, 'pickuppointLongitude', FILTER_SANITIZE_STRING),
            ];
            // $form_data = filter_input(INPUT_POST, 'formData', FILTER_SANITIZE_STRING);
            // $form_params = [];
            // parse_str($form_data, $form_params);


            $data['sub_title'] = 'PICKUP POINT';
            $data['title'] = 'NEW PICKUP POINT';
            $this->form_validation->set_rules('pickpointName', ' Pickup Point', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('pickuppointDescription', ' Description', 'trim|required|min_length[3]|max_length[80]');
            $this->form_validation->set_rules('pickuppointLocation', ' Pickup Point', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('pickuppointLatitude', ' Latitude', 'trim|required|min_length[3]|max_length[80]');
            $this->form_validation->set_rules('pickuppointLongitude', ' Longitude', 'trim|required|min_length[3]|max_length[80]');
            if ($this->form_validation->run() == TRUE) {
                $save_pickuppoint_data = $this->MPickpoints->save_pickuppoint_new($save_data);
                //dev_export($save_pickuppoint_data);die;
                if (isset($save_pickuppoint_data['data_status']) && !empty($save_pickuppoint_data['data_status']) && $save_pickuppoint_data['data_status'] == 1) {

                    $trip_pickup_times = $this->input->post('trip_pickup_time');
                    $trip_drop_times = $this->input->post('trip_drop_time');
                    $pickuppoint_id = $save_pickuppoint_data['data']['id'];
                    $error = 0;
                    if (!empty($trip_pickup_times)) {
                        foreach ($trip_pickup_times as $trip_id => $pickup_time) {
                            if ($trip_pickup_times[$trip_id] != '' &&  $trip_drop_times[$trip_id] != '') {
                                $save_trip_relation_data = [
                                    'tripId' => $trip_id,
                                    'pickuppointId' => $pickuppoint_id,
                                    'pickuptime' => $trip_pickup_times[$trip_id],
                                    'droptime' => $trip_drop_times[$trip_id]
                                ];
                                $this->load->model('Trip_model', 'MTrip');
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



                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    $data['pickuppoint_data'] = $save_data;
                    if (isset($save_pickuppoint_data['message']) && !empty($save_pickuppoint_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('pickup_points/add_pickuppoint', $data, TRUE), 'message' => $save_pickuppoint_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('pickup_points/add_pickuppoint', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['pickuppoint_data'] = $save_data;
                echo json_encode(array('status' => 3, 'view' => $this->load->view('pickup_points/add_pickuppoint', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function edit_pickuppoint()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'PICKUP POINT';
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

            $pickuppoint_id = filter_input(INPUT_POST, 'pickuppoint_id', FILTER_SANITIZE_STRING);
            $pickuppoint_name = filter_input(INPUT_POST, 'pickuppoint_name', FILTER_SANITIZE_STRING);
            //            dev_export($type_name);die;
            if (isset($pickuppoint_id) && !empty($pickuppoint_id)) {
                $pickuppoint_data = $this->MPickpoints->get_pickuppoint_data($pickuppoint_id);
                $trippickuppoint_relation_data = $this->MTrip->get_trippickuppoint_relation_data($pickuppoint_id, 0);

                if (isset($pickuppoint_data['data_status']) && !empty($pickuppoint_data['data_status']) && $pickuppoint_data['data_status'] == 1 && isset($pickuppoint_data['data'][0])) {
                    $inst_id = $this->session->userdata('inst_id');
                    $data['all_trips'] = $this->MPickpoints->get_all_trip_data($inst_id);
                    $data['pickuppoint_data'] = $pickuppoint_data['data'][0];
                    $data['title'] = 'Edit - ' . $pickuppoint_name;
                    $data['trip_pickpoint_relation_data'] = $trippickuppoint_relation_data['data'];

                    echo json_encode(array('status' => 1, 'view' => $this->load->view('pickup_points/edit_pickuppoint', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such PickPoint. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Pickup Point is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function save_edit_pickuppoint()
    {
        if ($this->input->is_ajax_request() == 1) {
            $save_data = [
                'id' => filter_input(INPUT_POST, 'pickuppoint_id', FILTER_SANITIZE_NUMBER_INT),
                'pickpointName' => filter_input(INPUT_POST, 'pickpointName', FILTER_SANITIZE_STRING),
                'pickuppointDescription' => filter_input(INPUT_POST, 'pickuppointDescription', FILTER_SANITIZE_STRING),
                'pickuppointLocation' => filter_input(INPUT_POST, 'pickuppointLocation', FILTER_SANITIZE_STRING),
                'pickuppointLatitude' => filter_input(INPUT_POST, 'pickuppointLatitude', FILTER_SANITIZE_STRING),
                'pickuppointLongitude' => filter_input(INPUT_POST, 'pickuppointLongitude', FILTER_SANITIZE_STRING),
            ];


            $data['sub_title'] = 'Pickup Point';
            $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $data['all_trips'] = $this->MPickpoints->get_all_trip_data($inst_id);
            $trippickuppoint_relation_data = $this->MTrip->get_trippickuppoint_relation_data($save_data['id'], 0);
            $data['trip_pickpoint_relation_data'] = $trippickuppoint_relation_data['data'];
            $this->form_validation->set_rules('pickpointName', ' Pickuppoint', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('pickuppointDescription', ' Description', 'trim|required|min_length[3]|max_length[100]');

            if ($this->form_validation->run() == TRUE) {
                $save_pickuppoint_data = $this->MPickpoints->save_pickuppoint_edit($save_data);
                if (isset($save_pickuppoint_data['data_status']) && !empty($save_pickuppoint_data['data_status']) && $save_pickuppoint_data['data_status'] == 1) {
                    $trip_pickup_times = $this->input->post('trip_pickup_time');
                    $trip_drop_times = $this->input->post('trip_drop_time');
                    $pickuppoint_id = $save_pickuppoint_data['data']['id'];
                    $error = 0;
                    $save_trip_relation_data = [
                        'tripId' => 999,
                        'pickuppointId' => $pickuppoint_id,
                        'pickuptime' => 999,
                        'droptime' => 999,
                        'update_type' => 'pick_update'
                    ];

                    $save_trip_relation = $this->MTrip->save_trip_pickpoint_relation($save_trip_relation_data);
                    if (!empty($trip_pickup_times)) {
                        foreach ($trip_pickup_times as $trip_id => $pickup_time) {
                            if ($trip_pickup_times[$trip_id] != '' &&  $trip_drop_times[$trip_id] != '') {
                                $save_trip_relation_data = [
                                    'tripId' => $trip_id,
                                    'pickuppointId' => $pickuppoint_id,
                                    'pickuptime' => $trip_pickup_times[$trip_id],
                                    'droptime' => $trip_drop_times[$trip_id],
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
                    $data['pickuppoint_data'] = $save_data;
                    //dev_export($data);die;
                    $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                    $data['sub_title'] = 'Pickup Point';
                    if (isset($save_pickuppoint_data['message']) && !empty($save_pickuppoint_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('pickup_points/edit_pickuppoint', $data, TRUE), 'message' => $save_pickuppoint_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('pickup_points/edit_pickuppoint', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['pickuppoint_data'] = $save_data;
                echo json_encode(array('status' => 3, 'view' => $this->load->view('pickup_points/edit_pickuppoint', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function change_status_of_pickuppoint()
    {

        if ($this->input->is_ajax_request() == 1) {
            $pickid = filter_input(INPUT_POST, 'pickid', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            if (isset($pickid) && !empty($pickid)) {
                $status_report = $this->MPickpoints->update_status_pickuppoint($pickid, $status);
                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Pickup Point status updated successfully'));
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
                echo json_encode(array('status' => 0, 'message' => 'Pickup Point  is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
