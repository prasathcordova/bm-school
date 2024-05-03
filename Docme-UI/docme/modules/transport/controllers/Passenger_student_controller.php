<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_student_controller
 *
 * @author Chandrajith
 */
class Passenger_student_controller extends MX_Controller
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
        $this->load->model('Passenger_student_model', 'MSP');
        $this->load->model('Trip_model', 'MTrip');
        $this->load->model('student_settings/Registration_model', 'MRegistration');
        $this->load->model('fees/Fee_structure_model', 'MFS');
    }

    public function load_starter()
    {

        $data['sub_title'] = 'STUDENT Transport Details';
        $inst_id = $this->session->userdata('inst_id');
        $this->load->view('passenger_student/show_starter', $data);
    }

    public function show_vehicle_route()
    {
        $data['sub_title'] = 'STUDENT Transport Details';
        $inst_id = $this->session->userdata('inst_id');
        $route_linked_points_data = $this->MSP->get_all_vehicle_route_data($inst_id);
        if (isset($route_linked_points_data['data']) && !empty($route_linked_points_data['data'])) {
            $data['vehicle_route_data'] = $route_linked_points_data['data'];
        } else {
            $data['vehicle_route_data'] = NULL;
        }
        $this->load->view('passenger_student/show_route', $data);
    }

    public function show_points()
    {
        $routeid = filter_input(INPUT_POST, 'route_id');
        $routename = filter_input(INPUT_POST, 'route_name');
        $routesrc = filter_input(INPUT_POST, 'route_source');
        $routedest = filter_input(INPUT_POST, 'route_destination');

        $data['sub_title'] = 'STUDENT - ALLOTMENT';
        $inst_id = $this->session->userdata('inst_id');
        $route_linked_points_data = $this->MSP->get_all_pickuppoints($routeid, $inst_id);
        //        dev_export($route_linked_points_data);die;
        if (isset($route_linked_points_data['data']) && !empty($route_linked_points_data['data'])) {
            $data['route_linked_points_data'] = $route_linked_points_data['data'];
        } else {
            $data['route_linked_points_data'] = NULL;
        }
        $data['route_id'] = $routeid;
        $data['route_name'] = $routename;
        $data['route_src'] = $routesrc;
        $data['route_dest'] = $routedest;
        $this->load->view('passenger_student/show_points', $data);
    }

    public function show_trips()
    {
        $routeid = filter_input(INPUT_POST, 'route_id');
        $routename = filter_input(INPUT_POST, 'route_name');
        $routesrc = filter_input(INPUT_POST, 'route_source');
        $routedest = filter_input(INPUT_POST, 'route_dest');
        $pickupointid = filter_input(INPUT_POST, 'pickupoint_id');
        $pickupointname = filter_input(INPUT_POST, 'pickupoint_name');
        $droppointid = filter_input(INPUT_POST, 'droppoint_id');
        $droppointname = filter_input(INPUT_POST, 'droppoint_name');
        $pickupointfees = filter_input(INPUT_POST, 'pickupointfees');
        $droppointfees = filter_input(INPUT_POST, 'droppointfees');

        $data['sub_title'] = 'STUDENT - ALLOTMENT';
        $inst_id = $this->session->userdata('inst_id');
        $pickuppoints_linked_trip_data = $this->MSP->get_all_picktripdata($pickupointid, $inst_id);
        if (isset($pickuppoints_linked_trip_data['data']) && !empty($pickuppoints_linked_trip_data['data'])) {
            $data['pickuppoints_linked_trip_data'] = $pickuppoints_linked_trip_data['data'];
        } else {
            $data['pickuppoints_linked_trip_data'] = NULL;
        }
        $droppoints_linked_trip_data = $this->MSP->get_all_droptripdata($droppointid, $inst_id);
        if (isset($droppoints_linked_trip_data['data']) && !empty($droppoints_linked_trip_data['data'])) {
            $data['droppoints_linked_trip_data'] = $droppoints_linked_trip_data['data'];
        } else {
            $data['droppoints_linked_trip_data'] = NULL;
        }
        $data['route_id'] = $routeid;
        $data['route_name'] = $routename;
        $data['route_src'] = $routesrc;
        $data['route_dest'] = $routedest;

        $data['pickupointid'] = $pickupointid;
        $data['pickupointname'] = $pickupointname;
        $data['droppointid'] = $droppointid;
        $data['droppointname'] = $droppointname;
        $data['pickupointfees'] = $pickupointfees;
        $data['droppointfees'] = $droppointfees;
        $this->load->view('passenger_student/show_trips', $data);
    }

    public function show_student_filter()
    {

        $inst_id = $this->session->userdata('inst_id');
        $acdyr = $this->session->userdata('acd_year');


        $data['sub_title'] = 'STUDENT - ALLOTMENT';

        //        STREAM DATA
        $stream = $this->MSP->get_all_stream($inst_id);
        if (isset($stream['error_status']) && $stream['error_status'] == 0) {
            if ($stream['data_status'] == 1) {
                $data['stream_data'] = $stream['data'];
            } else {
                $data['stream_data'] = FALSE;
            }
        } else {
            $data['stream_data'] = FALSE;
        }
        $data['stream_data'] = $stream['data'];

        //        CLASS DATA
        $class = $this->MSP->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data_for_registration'] = $class['data'];
            } else {
                $data['class_data_for_registration'] = FALSE;
            }
        } else {
            $data['class_data_for_registration'] = FALSE;
        }
        //        ACD YEAR DATA
        $acdyr = $this->MSP->get_all_acadyr();
        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
            if ($acdyr['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        //        BATCH DATA
        $batch = $this->MSP->get_all_batch($this->session->userdata('acd_year'));
        //        dev_export($batch);die;
        if (isset($batch['error_status']) && $batch['error_status'] == 0) {
            if ($batch['data_status'] == 1) {
                $data['batch_data'] = $batch['data'];
            } else {
                $data['batch_data'] = FALSE;
            }
        } else {
            $data['batch_data'] = FALSE;
        }

        //        dev_export( $data['pickupointfees']);
        //        dev_export( $data['droppointfees']);die;
        $this->load->view('passenger_student/student_filter', $data);
    }

    public function search_student_admission()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            $details_data = $this->MSP->student_search($data_prep);

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['user_name'] = $this->session->userdata('user_name');
            echo json_encode(array('status' => 1, 'view' => $this->load->view('passenger_student/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function advance_search_student()
    {                                               //display students list on search
        $data['title'] = 'STUDENTS LIST';
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $data_prep['batch_id'] = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['stream_id'] = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['class_id'] = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['curent_acdyr'] = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['searchname'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            if ($data_prep['stream_id'] == -1) {
                $data_prep['stream_id'] = '';
            }
            if ($data_prep['curent_acdyr'] == -1) {
                $data_prep['curent_acdyr'] = '';
            }
            if ($data_prep['class_id'] == -1) {
                $data_prep['class_id'] = '';
            }
            $details_data = $this->MSP->studentadvance_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            echo json_encode(array('status' => 1, 'view' => $this->load->view('passenger_student/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function show_student_transport_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $admn_no = filter_input(INPUT_POST, 'admn_no', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $student_id = strtoupper(filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING));
            $data_prep['student_id'] = $student_id;
            $data_prep['acd_year_id'] = $acd_year_id;
            $details_data = $this->MSP->student_travel_data($data_prep);
            $data['travel_data'] = $details_data['data'][0];

            $history_data = $this->MSP->student_travel_history($data_prep);
            $data['travel_history'] = $history_data['data'];

            $fee_details = $this->MFS->get_bus_fee_demanded_details($student_id, $inst_id, $acd_year_id);
            $data['fee_details'] = $fee_details['data'];

            $student_data  = $this->MRegistration->get_profiles_student($student_id);
            $data['student_data'] = $student_data['data'][0];
            $all_pickpoints_data = $this->MSP->get_active_pickuppoints($inst_id);

            if ($all_pickpoints_data['error_status'] == 0 && $all_pickpoints_data['data_status'] == 1) {
                $data['all_pickpoints'] = $all_pickpoints_data['data'];
            } else {
                $data['all_pickpoints'] = [];
            }

            $data['sub_title'] = 'Student Trip Management';

            echo json_encode(array('status' => 1, 'view' => $this->load->view('passenger_student/show_student_trip_details', $data, TRUE)));
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_pickpoint_trips()
    {
        if ($this->input->is_ajax_request() == 1) {
            $pick_point_id = filter_input(INPUT_POST, 'pick_point_id', FILTER_SANITIZE_NUMBER_INT);
            $trippickuppoint_relation_data = $this->MTrip->get_trippickuppoint_relation_data($pick_point_id, 0);
            if (isset($trippickuppoint_relation_data['error_status']) && $trippickuppoint_relation_data['error_status'] == 0) {
                if ($trippickuppoint_relation_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $trippickuppoint_relation_data['data']));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    public function save_trip_allotment()
    {
        if ($this->input->is_ajax_request() == 1) {

            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $student_id = strtoupper(filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING));

            $student_data_array  = $this->MRegistration->get_profiles_student($student_id);
            $data['student_data'] = $student_data_array['data'][0];


            $all_pickpoints_data = $this->MSP->get_active_pickuppoints($inst_id);

            if ($all_pickpoints_data['error_status'] == 0 && $all_pickpoints_data['data_status'] == 1) {
                $data['all_pickpoints'] = $all_pickpoints_data['data'];
            } else {
                $data['all_pickpoints'] = [];
            }

            $data['sub_title'] = 'Student Trip Management';


            $travel_type = filter_input(INPUT_POST, 'transport_type', FILTER_SANITIZE_STRING);
            $student_data[] = [
                'studentId' => $student_id,
                'Admn_No' => $data['student_data']['Admn_No']
            ];
            $transport_start_date = filter_input(INPUT_POST, 'transport_start_date');
            $transport_start_date = date('Y-m-d', strtotime($transport_start_date));
            $effective_date = date('Y-m-01', strtotime($transport_start_date));
            $this->form_validation->set_rules('transport_type', ' Travel Type', 'trim|required');
            switch ($travel_type) {
                case 1: //only Pickup
                    $allotment_data = [
                        'pickStopId' => filter_input(INPUT_POST, 'pickStopId', FILTER_SANITIZE_STRING),
                        'pickTripId' => filter_input(INPUT_POST, 'pickTripId', FILTER_SANITIZE_STRING),
                        'dropStopId' => 0,
                        'dropTripId' => 0,
                        'isPick' => 1,
                        'isDrop' => 0,
                        'transportstartdate' => $transport_start_date,
                        'effectiveFrom' => $effective_date,
                        'status' => filter_input(INPUT_POST, 'transaction_type', FILTER_SANITIZE_STRING),
                    ];
                    $this->form_validation->set_rules('pickStopId', ' Pick Point', 'trim|required');
                    $this->form_validation->set_rules('pickTripId', ' Trip', 'trim|required');
                    break;
                case 2: //only Drop
                    $allotment_data = [
                        'pickStopId' => 0,
                        'pickTripId' => 0,
                        'dropStopId' => filter_input(INPUT_POST, 'dropStopId', FILTER_SANITIZE_STRING),
                        'dropTripId' => filter_input(INPUT_POST, 'dropTripId', FILTER_SANITIZE_STRING),
                        'isPick' => 0,
                        'isDrop' => 1,
                        'transportstartdate' => $transport_start_date,
                        'effectiveFrom' => $effective_date,
                        'status' => filter_input(INPUT_POST, 'transaction_type', FILTER_SANITIZE_STRING),
                    ];
                    $this->form_validation->set_rules('dropStopId', ' Pick Point', 'trim|required');
                    $this->form_validation->set_rules('dropTripId', ' Trip', 'trim|required');
                    break;
                case 3: //Pickup &  Drop
                    $allotment_data = [
                        'pickStopId' => filter_input(INPUT_POST, 'pickStopId', FILTER_SANITIZE_STRING),
                        'pickTripId' => filter_input(INPUT_POST, 'pickTripId', FILTER_SANITIZE_STRING),
                        'dropStopId' => filter_input(INPUT_POST, 'dropStopId', FILTER_SANITIZE_STRING),
                        'dropTripId' => filter_input(INPUT_POST, 'dropTripId', FILTER_SANITIZE_STRING),
                        'isPick' => 1,
                        'isDrop' => 1,
                        'transportstartdate' => $transport_start_date,
                        'effectiveFrom' => $effective_date,
                        'status' => filter_input(INPUT_POST, 'transaction_type', FILTER_SANITIZE_STRING),
                    ];
                    $this->form_validation->set_rules('pickStopId', ' Pick Point', 'trim|required');
                    $this->form_validation->set_rules('pickTripId', ' Trip', 'trim|required');
                    $this->form_validation->set_rules('dropStopId', ' Pick Point', 'trim|required');
                    $this->form_validation->set_rules('dropTripId', ' Trip', 'trim|required');
                    break;
                case 4: //Same Pickup &  Drop
                    $allotment_data = [
                        'pickStopId' => filter_input(INPUT_POST, 'pickdropStopId', FILTER_SANITIZE_STRING),
                        'pickTripId' => filter_input(INPUT_POST, 'pickdropTripId', FILTER_SANITIZE_STRING),
                        'dropStopId' => filter_input(INPUT_POST, 'pickdropStopId', FILTER_SANITIZE_STRING),
                        'dropTripId' => filter_input(INPUT_POST, 'pickdropTripId', FILTER_SANITIZE_STRING),
                        'isPick' => 1,
                        'isDrop' => 1,
                        'transportstartdate' => $transport_start_date,
                        'effectiveFrom' => $effective_date,
                        'status' => filter_input(INPUT_POST, 'transaction_type', FILTER_SANITIZE_STRING),
                    ];

                    $this->form_validation->set_rules('pickdropStopId', ' Pick Point', 'trim|required');
                    $this->form_validation->set_rules('pickdropTripId', ' Trip', 'trim|required');
                    break;
                case 5: //Marking as Inactive
                    $selected_month_arrear_date = date("Y-m-10", strtotime($transport_start_date));
                    if (strtotime($selected_month_arrear_date) > strtotime($transport_start_date)) {
                        $deallocate_from = date("Y-m-01", strtotime($transport_start_date));
                    } else {
                        $deallocate_from = date("Y-m-01", strtotime("30 DAYS", strtotime($transport_start_date)));
                    }

                    $allotment_data = [
                        'pickStopId' => 0,
                        'pickTripId' => 0,
                        'dropStopId' => 0,
                        'dropTripId' => 0,
                        'isPick' => 0,
                        'isDrop' => 0,
                        'transportstartdate' => $transport_start_date,
                        'effectiveFrom' => $deallocate_from,
                        'status' => 'disable'
                    ];
                    // dev_export($allotment_data);
                    // die;
                    break;
            }

            if ($this->form_validation->run() == TRUE) {

                $student_allotment_data = $this->MSP->save_allotment_student(json_encode($student_data), json_encode($allotment_data), $inst_id, $acd_year_id);
                $data_prep['student_id'] = $student_id;
                $data_prep['acd_year_id'] = $acd_year_id;
                $details_data = $this->MSP->student_travel_data($data_prep);
                $data['travel_data'] = $details_data['data'][0];

                if (isset($student_allotment_data['data_status']) && !empty($student_allotment_data['data_status']) && $student_allotment_data['data_status'] == 1) {

                    //BUS Fee Demanding $details_data with  fees and effective dates **ALSO USED IN PICKPOINT** 
                    $student_fee_data[] = ['student_id' => $student_id];
                    $activation_date = $allotment_data['effectiveFrom'];
                    $template_id = 1;
                    $amount_array = [
                        'type' => 'F002',
                        'amount' => $data['travel_data']['demanded_fee'],
                        'status' => $allotment_data['status']
                    ];

                    $fee_allotment = $this->MFS->allocate_students_to_fee_template($template_id, json_encode($student_fee_data), $activation_date, '', $amount_array);
                    //Bus Fee demanding End

                    //Call the api here with data in $details_data with  fees and effective dates **ALSO USED IN PICKPOINT** 
                    // $data_to_rims = [
                    //     "inst_id" => $inst_id,
                    //     "admn_no" => $student_data[0]['Admn_No'],
                    //     "flag" => $allotment_data['status'],
                    //     "dem_from_date" =>  $allotment_data['effectiveFrom'],
                    //     "dem_end_date" => NULL,
                    //     "fee_amount" => $data['travel_data']['demanded_fee'],
                    //     "username" => $this->session->userdata('emailid')
                    // ];

                    // dev_export($fee_allotment);
                    // die;
                    // $apikey = base64_encode('DOCME-TRANSPORT-' . date('Ymd'));
                    // $raw_data_to_rims = json_encode($data_to_rims);
                    // $func = 'Transport/postRIMSTransportStudents';
                    // //$response = transport_data_to_rims($raw_data_to_rims, $apikey, $func, $inst_id);
                    // $response = array('status' => 'Unsync', 'data' => $data_to_rims);
                    // $save_respone = $this->MSP->save_rims_response_fee_transport(json_encode($response), $student_id);
                    //API END

                    $history_data = $this->MSP->student_travel_history($data_prep);
                    $data['travel_history'] = $history_data['data'];

                    $fee_details = $this->MFS->get_bus_fee_demanded_details($student_id, $inst_id, $acd_year_id);
                    $data['fee_details'] = $fee_details['data'];

                    echo json_encode(array('status' => 1, 'view' => $this->load->view('passenger_student/show_student_trip_details', $data, TRUE)));
                    return TRUE;
                } else {
                    if (isset($student_allotment_data['message']) && !empty($student_allotment_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('passenger_student/show_student_trip_details', $data, TRUE), 'message' => $student_allotment_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('passenger_student/show_student_trip_details', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                //$data['trip_data'] = $student_allotment_data;
                echo json_encode(array('status' => 3, 'view' => $this->load->view('passenger_student/show_student_trip_details', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }


    public function batchlist()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $stream_id = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $academic_year = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $session_id = NULL;
            $flag_status = NULL;
            if ($stream_id == -1) {
                $stream_id = NULL;
            }
            if ($academic_year == -1) {
                $academic_year = NULL;
            }
            if ($class_id == -1) {
                $class_id = NULL;
            }
            $details_data = $this->MSP->get_batch_data($stream_id, $academic_year, $session_id, $class_id, $flag_status);
            if (isset($details_data['error_status']) && $details_data['error_status'] == 0) {
                if ($details_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $details_data['data']));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function show_student_allocation_list()
    {
        if ($this->input->is_ajax_request() == 1) {
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT);
            $inst_id = $this->session->userdata('inst_id');

            $attr = filter_input(INPUT_POST, 'attr', FILTER_SANITIZE_NUMBER_INT);


            $trip_data = $this->MSP->get_all_vehicle_route_data($inst_id);
            $trip_details = $trip_data['data'];

            $pickuppoint_data = $this->MSP->get_active_pickuppoints($inst_id);
            $pickuppoint_details = $pickuppoint_data['data'];

            $data_view['trip_details'] = $trip_details;
            $data_view['pickuppoint_details'] = $pickuppoint_details;

            if ($type == 1) {
                if ($attr != 0) {
                    $trip_id = $attr;
                    $query = "and (pt.id=$trip_id OR dt.id=$trip_id)";
                } else {
                    $trip_id = $trip_details[0]['id'];
                    $query = "and (pt.id=" . $trip_details[0]['id'] . " OR dt.id=" . $trip_details[0]['id'] . ")";
                }
                $data_view['selected_trip'] = $trip_id;
            } else {
                if ($attr != 0) {
                    $pick_point_id = $attr;
                    $query = "and (pp.id=$pick_point_id OR dp.id=$pick_point_id)";
                } else {
                    $pick_point_id = $pickuppoint_details[0]['id'];
                    $query = "and (pp.id=" . $pickuppoint_details[0]['id'] . " OR dp.id=" . $pickuppoint_details[0]['id'] . ")";
                }
                $data_view['selected_pickuppoint'] = $pick_point_id;
            }
            $student_allocation_data = $this->MSP->get_all_student_allocation_details($query);

            $allocattion_data = isset($student_allocation_data['data']) ? $student_allocation_data['data'] : [];

            $formatted_allocation_data = [];
            $size = [];
            $size['stop_span'] = [];
            $size['trip_span'] = [];
            if ($type == 1) {
                $data_view['sub_title'] = 'Student Allocation -Trip';
                $view = 'show_student_trip_allocation';
                if (!empty($allocattion_data)) {
                    foreach ($allocattion_data as $data) {
                        $end_date_value = '<br/>';
                        $end_date_value .=   $data['transportEndDate'] == '' ? date('d/m/Y', strtotime($this->session->userdata('lock_end_date'))) : date('d/m/Y', strtotime($data['transportEndDate']));
                        if ($data['transportEndDate'] == '')
                            $is_update = 1;
                        else
                            $is_update = 0;
                        if ($data['pickTripId'] != 0 && $data['pickTripId'] == $trip_id) {
                            $formatted_allocation_data[$data['pickTripId']]['trip_name'] = $data['pickup_tripName'];

                            if ($data['pickStopId'] != 0) {
                                $formatted_allocation_data[$data['pickTripId']]['travel_type']['Pickup'][$data['pickStopId']]['pickup_name'] = $data['pickup_pickpointName'];
                                $formatted_allocation_data[$data['pickTripId']]['travel_type']['Pickup'][$data['pickStopId']]['student_data'][$data['student_id']]['student_name'] = $data['student_name'];
                                $formatted_allocation_data[$data['pickTripId']]['travel_type']['Pickup'][$data['pickStopId']]['student_data'][$data['student_id']]['batch_name'] = $data['Batch_Name'];
                                $formatted_allocation_data[$data['pickTripId']]['travel_type']['Pickup'][$data['pickStopId']]['student_data'][$data['student_id']]['Admn_No'] = $data['Admn_No'];
                                $formatted_allocation_data[$data['pickTripId']]['travel_type']['Pickup'][$data['pickStopId']]['student_data'][$data['student_id']]['class_name'] = $data['class_name'];
                                if (!isset($formatted_allocation_data[$data['pickTripId']]['travel_type']['Pickup'][$data['pickStopId']]['student_data'][$data['student_id']]['effect_from']))
                                    $formatted_allocation_data[$data['pickTripId']]['travel_type']['Pickup'][$data['pickStopId']]['student_data'][$data['student_id']]['effect_from'] = date('d/m/Y', strtotime($data['transportStartDate'])) . ' to ' . $end_date_value;
                                else
                                    $formatted_allocation_data[$data['pickTripId']]['travel_type']['Pickup'][$data['pickStopId']]['student_data'][$data['student_id']]['effect_from'] .= '<br/><br/>' . date('d/m/Y', strtotime($data['transportStartDate'])) . ' to ' . $end_date_value;
                                $formatted_allocation_data[$data['pickTripId']]['travel_type']['Pickup'][$data['pickStopId']]['student_data'][$data['student_id']]['student_id'] = $data['student_id'];
                                $formatted_allocation_data[$data['pickTripId']]['travel_type']['Pickup'][$data['pickStopId']]['student_data'][$data['student_id']]['is_update'] = $is_update;
                                $size_pick = sizeof($formatted_allocation_data[$data['pickTripId']]['travel_type']['Pickup'][$data['pickStopId']]['student_data']);
                                $size['stop_span'][$data['pickTripId']]['Pickup'][$data['pickStopId']] = $size_pick;
                                //$formatted_allocation_data[$data['pickTripId']]['travel_type']['Pickup'][$data['pickStopId']]['travel_type_span'] = $size_pick;
                            }
                        }
                        if ($data['dropTripId'] != 0 && $data['dropTripId'] == $trip_id) {
                            $formatted_allocation_data[$data['dropTripId']]['trip_name'] = $data['drop_tripName'];
                            if ($data['dropStopId'] != 0) {
                                $formatted_allocation_data[$data['dropTripId']]['travel_type']['Drop'][$data['dropStopId']]['drop_pickupName'] = $data['drop_pickupName'];
                                $formatted_allocation_data[$data['dropTripId']]['travel_type']['Drop'][$data['dropStopId']]['student_data'][$data['student_id']]['student_name'] = $data['student_name'];
                                $formatted_allocation_data[$data['dropTripId']]['travel_type']['Drop'][$data['dropStopId']]['student_data'][$data['student_id']]['batch_name'] = $data['Batch_Name'];
                                $formatted_allocation_data[$data['dropTripId']]['travel_type']['Drop'][$data['dropStopId']]['student_data'][$data['student_id']]['Admn_No'] = $data['Admn_No'];
                                $formatted_allocation_data[$data['dropTripId']]['travel_type']['Drop'][$data['dropStopId']]['student_data'][$data['student_id']]['class_name'] = $data['class_name'];
                                if (!isset($formatted_allocation_data[$data['dropTripId']]['travel_type']['Drop'][$data['dropStopId']]['student_data'][$data['student_id']]['effect_from']))
                                    $formatted_allocation_data[$data['dropTripId']]['travel_type']['Drop'][$data['dropStopId']]['student_data'][$data['student_id']]['effect_from'] = date('d/m/Y', strtotime($data['transportStartDate'])) . ' to ' . $end_date_value;
                                else
                                    $formatted_allocation_data[$data['dropTripId']]['travel_type']['Drop'][$data['dropStopId']]['student_data'][$data['student_id']]['effect_from'] .= '<br/><br/>' . date('d/m/Y', strtotime($data['transportStartDate'])) . ' to ' . $end_date_value;
                                $formatted_allocation_data[$data['dropTripId']]['travel_type']['Drop'][$data['dropStopId']]['student_data'][$data['student_id']]['student_id'] = $data['student_id'];
                                $formatted_allocation_data[$data['dropTripId']]['travel_type']['Drop'][$data['dropStopId']]['student_data'][$data['student_id']]['is_update'] = $is_update;
                                $size_drop = sizeof($formatted_allocation_data[$data['dropTripId']]['travel_type']['Drop'][$data['dropStopId']]['student_data']);
                                $size['stop_span'][$data['dropTripId']]['Drop'][$data['dropStopId']] = $size_drop;
                                //$formatted_allocation_data[$data['dropTripId']]['travel_type']['Drop'][$data['dropStopId']]['travel_type_span'] = $size_drop;
                            }
                        }
                        //$total_row_count++;
                    }
                    foreach ($size['stop_span'] as $key => $value) {
                        $size['total_span'][$key] = (isset($value['Pickup']) ? array_sum($value['Pickup']) : 0) + (isset($value['Drop']) ? array_sum($value['Drop']) : 0);
                        $size['travel_type_span']['Pickup'][$key] = isset($value['Pickup']) ? array_sum($value['Pickup']) : 0;
                        $size['travel_type_span']['Drop'][$key] = isset($value['Drop']) ? array_sum($value['Drop']) : 0;
                    }
                }

                // dev_export($formatted_allocation_data);
                // die;
            } else {
                $data_view['sub_title'] = 'Student Allocation -Pickup Point';
                $view = 'show_student_pickuppoint_allocation';
                if (!empty($allocattion_data)) {
                    foreach ($allocattion_data as $data) {
                        $end_date_value = '<br/>';
                        $end_date_value .=  $data['transportEndDate'] == '' ? date('d/m/Y', strtotime($this->session->userdata('lock_end_date'))) : date('d/m/Y', strtotime($data['transportEndDate']));
                        if ($data['transportEndDate'] == '')
                            $is_update = 1;
                        else
                            $is_update = 0;
                        if ($data['pickStopId'] != 0 && $data['pickStopId'] == $pick_point_id) {
                            $formatted_allocation_data[$data['pickStopId']]['stop_name'] = $data['pickup_pickpointName'];
                            if ($data['pickTripId'] != 0) {
                                $formatted_allocation_data[$data['pickStopId']]['travel_type']['Pickup'][$data['pickTripId']]['pick_trip_name'] = $data['pickup_tripName'];
                                $formatted_allocation_data[$data['pickStopId']]['travel_type']['Pickup'][$data['pickTripId']]['student_data'][$data['student_id']]['student_name'] = $data['student_name'];
                                $formatted_allocation_data[$data['pickStopId']]['travel_type']['Pickup'][$data['pickTripId']]['student_data'][$data['student_id']]['batch_name'] = $data['Batch_Name'];
                                $formatted_allocation_data[$data['pickStopId']]['travel_type']['Pickup'][$data['pickTripId']]['student_data'][$data['student_id']]['Admn_No'] = $data['Admn_No'];
                                $formatted_allocation_data[$data['pickStopId']]['travel_type']['Pickup'][$data['pickTripId']]['student_data'][$data['student_id']]['class_name'] = $data['class_name'];
                                if (!isset($formatted_allocation_data[$data['pickStopId']]['travel_type']['Pickup'][$data['pickTripId']]['student_data'][$data['student_id']]['effect_from']))
                                    $formatted_allocation_data[$data['pickStopId']]['travel_type']['Pickup'][$data['pickTripId']]['student_data'][$data['student_id']]['effect_from'] = date('d/m/Y', strtotime($data['transportStartDate'])) . ' to ' . $end_date_value;
                                else
                                    $formatted_allocation_data[$data['pickStopId']]['travel_type']['Pickup'][$data['pickTripId']]['student_data'][$data['student_id']]['effect_from'] .= '<br/><br/>' . date('d/m/Y', strtotime($data['transportStartDate'])) . ' to ' . $end_date_value;
                                $formatted_allocation_data[$data['pickStopId']]['travel_type']['Pickup'][$data['pickTripId']]['student_data'][$data['student_id']]['student_id'] = $data['student_id'];
                                $formatted_allocation_data[$data['pickStopId']]['travel_type']['Pickup'][$data['pickTripId']]['student_data'][$data['student_id']]['is_update'] = $is_update;
                                $size_pick = sizeof($formatted_allocation_data[$data['pickStopId']]['travel_type']['Pickup'][$data['pickTripId']]['student_data']);
                                $size['trip_span'][$data['pickStopId']]['Pickup'][$data['pickTripId']] = $size_pick;
                            }
                        }
                        if ($data['dropStopId'] != 0 && $data['dropStopId'] == $pick_point_id) {
                            $formatted_allocation_data[$data['dropStopId']]['stop_name'] = $data['drop_pickupName'];
                            if ($data['dropTripId'] != 0) {
                                $formatted_allocation_data[$data['dropStopId']]['travel_type']['Drop'][$data['dropTripId']]['drop_trip_name'] = $data['drop_tripName'];
                                $formatted_allocation_data[$data['dropStopId']]['travel_type']['Drop'][$data['dropTripId']]['student_data'][$data['student_id']]['student_name'] = $data['student_name'];
                                $formatted_allocation_data[$data['dropStopId']]['travel_type']['Drop'][$data['dropTripId']]['student_data'][$data['student_id']]['batch_name'] = $data['Batch_Name'];
                                $formatted_allocation_data[$data['dropStopId']]['travel_type']['Drop'][$data['dropTripId']]['student_data'][$data['student_id']]['Admn_No'] = $data['Admn_No'];
                                $formatted_allocation_data[$data['dropStopId']]['travel_type']['Drop'][$data['dropTripId']]['student_data'][$data['student_id']]['class_name'] = $data['class_name'];
                                if (!isset($formatted_allocation_data[$data['dropStopId']]['travel_type']['Drop'][$data['dropTripId']]['student_data'][$data['student_id']]['effect_from']))
                                    $formatted_allocation_data[$data['dropStopId']]['travel_type']['Drop'][$data['dropTripId']]['student_data'][$data['student_id']]['effect_from'] = date('d/m/Y', strtotime($data['transportStartDate'])) . ' to ' . $end_date_value;
                                else
                                    $formatted_allocation_data[$data['dropStopId']]['travel_type']['Drop'][$data['dropTripId']]['student_data'][$data['student_id']]['effect_from'] = '<br/><br/>' . date('d/m/Y', strtotime($data['transportStartDate'])) . ' to ' . $end_date_value;
                                $formatted_allocation_data[$data['dropStopId']]['travel_type']['Drop'][$data['dropTripId']]['student_data'][$data['student_id']]['student_id'] = $data['student_id'];
                                $formatted_allocation_data[$data['dropStopId']]['travel_type']['Drop'][$data['dropTripId']]['student_data'][$data['student_id']]['is_update'] = $is_update;
                                $size_drop = sizeof($formatted_allocation_data[$data['dropStopId']]['travel_type']['Drop'][$data['dropTripId']]['student_data']);
                                $size['trip_span'][$data['dropStopId']]['Drop'][$data['dropTripId']] = $size_drop;
                            }
                        }
                        //$total_row_count++;
                    }

                    foreach ($size['trip_span'] as $key => $value) {
                        // $size['total_span'][$key] = array_sum($value['Pickup']) + array_sum($value['Drop']);
                        // $size['travel_type_span']['Pickup'][$key] = array_sum($value['Pickup']);
                        // $size['travel_type_span']['Drop'][$key] = array_sum($value['Drop']);
                        $size['total_span'][$key] = (isset($value['Pickup']) ? array_sum($value['Pickup']) : 0) + (isset($value['Drop']) ? array_sum($value['Drop']) : 0);
                        $size['travel_type_span']['Pickup'][$key] = isset($value['Pickup']) ? array_sum($value['Pickup']) : 0;
                        $size['travel_type_span']['Drop'][$key] = isset($value['Drop']) ? array_sum($value['Drop']) : 0;
                    }
                }
            }
            // dev_export($size);
            // die;
            $data_view['span_size'] = $size;
            $data_view['trip_student_data'] = $formatted_allocation_data;

            if (isset($student_allocation_data['data_status']) && !empty($student_allocation_data['data_status']) && $student_allocation_data['data_status'] == 1) {
                echo $this->load->view('passenger_student/' . $view, $data_view);
                // $data['student_allocation_data'] = $student_allocation_data['data'];
                // echo json_encode(array('status' => 1, 'view' => $this->load->view('passenger_student/' . $view, $data, TRUE)));
                // return TRUE;
            } else {
                if (isset($student_allocation_data['message']) && !empty($student_allocation_data['message'])) {
                    echo $this->load->view('passenger_student/' . $view, $data_view);
                    //echo json_encode(array('status' => 2, 'view' => $this->load->view('passenger_student/' . $view, $data_view, TRUE), 'message' => $student_allocation_data['message']));
                    return true;
                } else {
                    echo $this->load->view('passenger_student/' . $view, $data_view);
                    //echo json_encode(array('status' => 4, 'view' => $this->load->view('passenger_student/' . $view, $data_view, TRUE), 'message' => 'Please check if the values are valid'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
