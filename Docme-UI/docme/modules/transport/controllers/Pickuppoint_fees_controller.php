<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pickuppoint_fees_controller
 *
 * @author AHB
 */
class Pickuppoint_fees_controller extends MX_Controller
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
        $this->load->model('Pickuppoint_fees_model', 'MPFees');
        $this->load->model('Passenger_student_model', 'MSP');
        $this->load->model('fees/Fee_structure_model', 'MFS');
    }
    public function show_pickupoint_fees()
    {
        $data['sub_title'] = 'Pickup Point-Fees';
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
        $acd_year = $this->session->userdata('acd_year');
        $pickup_point_fees_data = $this->MPFees->get_all_pickuppoint_fees($inst_id, $acd_year);

        if (isset($pickup_point_fees_data['data']) && !empty($pickup_point_fees_data['data'])) {
            $data['pickup_point_fees_data'] = $pickup_point_fees_data['data'];
        } else {
            $data['pickup_point_fees_data'] = NULL;
        }

        $this->load->view('pickuppoint_fees/show_pickuppoints_fees', $data);
    }

    public function update_pickupoint_fees()
    {
        if ($this->input->is_ajax_request() == 1) {
            $pickpointName = filter_input(INPUT_POST, 'pickpointName', FILTER_SANITIZE_STRING);
            $data['title'] = "Update Fees -" . $pickpointName;
            $pickpoint_id = filter_input(INPUT_POST, 'pickpoint_id', FILTER_SANITIZE_STRING);
            $pickup_point_fees_data = $this->MPFees->get_pickuppoint_all_fees_details($pickpoint_id);
            $pickup_student_details = $this->MPFees->get_pickuppoint_student_details($pickpoint_id);
            if (isset($pickup_point_fees_data) && !empty($pickup_point_fees_data)) {
                if (isset($pickup_point_fees_data['data'][0]) && !empty($pickup_point_fees_data['data'][0])) {
                    $data['pickup_point_fees_data'] = $pickup_point_fees_data['data'][0];
                } else {
                    $data['pickup_point_fees_data']['pickuppointId'] = $pickpoint_id;
                }
                if (isset($pickup_student_details) && !empty($pickup_point_fees_data)) {
                    $data['pickup_student_details'] = $pickup_student_details['data'];
                }
                echo json_encode(array('status' => 1, 'view' => $this->load->view('pickuppoint_fees/edit_pickuppoints_fees', $data, true)));
                return TRUE;
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Pickup Point is not available. Please check again later'));
                return true;
            }
        }
    }
    public function save_update_pickuppoint_fees()
    {
        if ($this->input->is_ajax_request() == 1) {
            $save_data = [
                'pickuppointId' => filter_input(INPUT_POST, 'pickuppointId', FILTER_SANITIZE_NUMBER_INT),
                'amtPay' => filter_input(INPUT_POST, 'fee_amt', FILTER_SANITIZE_STRING),
                'amtPay_2' => filter_input(INPUT_POST, 'fee_amt_2', FILTER_SANITIZE_STRING),
                'StartDate' => date('Y-m-d', strtotime(filter_input(INPUT_POST, 'StartDate', FILTER_SANITIZE_STRING)))
            ];
            $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
            $this->form_validation->set_rules('pickuppointId', ' Pickuppoint', 'trim|required');
            $this->form_validation->set_rules('fee_amt', ' One Side Fee', 'trim|required');
            $this->form_validation->set_rules('fee_amt_2', ' Two Side Fee', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $save_pickuppoint_data = $this->MPFees->save_pickuppoint_fees_data($save_data);
                if (isset($save_pickuppoint_data['data_status']) && !empty($save_pickuppoint_data['data_status']) && $save_pickuppoint_data['data_status'] == 1) {
                    $pickup_student_details = $this->MPFees->get_pickuppoint_student_details($save_data['pickuppointId']);
                    if (isset($pickup_student_details) && !empty($pickup_student_details)) {
                        $inst_id = $this->session->userdata('inst_id');
                        $acd_year_id = $this->session->userdata('acd_year');
                        $pickup_student_data = $pickup_student_details['data'];
                        if (!empty($pickup_student_data)) {
                            foreach ($pickup_student_data as $sdata) {
                                $end_date = $sdata['transportEndDate'] == '' ? $this->session->userdata('lock_end_date') : $sdata['transportEndDate'];
                                //BUS Fee Demanding $details_data with fees and effective dates **ALSO USED IN PICKPOINT**
                                $student_fee_data = [];
                                $student_fee_data[] = ['student_id' => $sdata['student_id']];
                                $activation_date = date('Y-m-01', strtotime($save_data['StartDate'])); //date('Y-m-01');
                                $template_id = 1;
                                $amount_array = [
                                    'type' => 'F002',
                                    'amount' => $sdata['demanded_fee'],
                                    'status' => 'Enable',
                                    'end_date' => $end_date
                                ];

                                $fee_allotment = $this->MFS->allocate_students_to_fee_template($template_id, json_encode($student_fee_data), $activation_date, '', $amount_array);
                                //Bus Fee demanding End
                                // $data_prep['student_id'] = $sdata['student_id'];
                                // $data_prep['acd_year_id'] = $acd_year_id;
                                // $details_data = $this->MSP->student_travel_data($data_prep);
                                // $data['travel_data'] = $details_data['data'][0];
                                //Call the api here with data in $details_data with  fees and effective dates **ALSO USED IN STUDENT ALLOCATION**  
                                // $data_to_rims = [
                                //     "inst_id" => $inst_id,
                                //     "admn_no" => $sdata['Admn_No'],
                                //     "flag" => 'Enable',
                                //     "dem_from_date" =>  date('Y-m-01'),
                                //     "dem_end_date" =>  date('Y-m-d', strtotime($end_date)),
                                //     "fee_amount" => $sdata['demanded_fee'], //$data['travel_data']['demanded_fee]
                                //     "username" => $this->session->userdata('emailid')
                                // ];
                                // $apikey = base64_encode('DOCME-TRANSPORT-' . date('Ymd'));
                                // $raw_data_to_rims = json_encode($data_to_rims);
                                // $func = 'Transport/postRIMSTransportStudents';
                                // //$response = transport_data_to_rims($raw_data_to_rims, $apikey, $func, $inst_id);
                                // $response = array('status' => 'Unsync', 'data' => $data_to_rims);
                                // $save_respone = $this->MSP->save_rims_response_fee_transport(json_encode($response), $sdata['student_id']);
                                //API END
                                //echo json_encode(array('status' => 1, 'view' => $this->load->view('passenger_student/show_student_trip_details', $data, TRUE)));
                                //return TRUE;
                            }
                        }
                    }

                    echo json_encode(array('status' => 1, 'message' => 'Pickup Point Fees updated successfully'));
                    return true;
                } else {
                    if (isset($save_pickuppoint_data['message']) && !empty($save_pickuppoint_data['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $save_pickuppoint_data['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'An error encountered while updating status of Pickup Point. Please try again later'));
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
