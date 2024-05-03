<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_student_model
 *
 * @author chandrajith
 */
class Passenger_student_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_vehicle_route_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $route = transport_data_with_param_with_urlencode(array('action' => 'get_route', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);

        if (isset($route) && !empty($route) && is_array($route)) {
            return $route['data'];
        } else {
            if (isset($route['message']) && !empty($route['message']) && is_array($route)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $route['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $route,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_pickuppoints($routeid, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $pickuppoints = transport_data_with_param_with_urlencode(array('action' => 'get_trip_routemappickuppoint', 'route_id' => $routeid, 'inst_id' => $inst_id), $apikey);

        if (isset($pickuppoints) && !empty($pickuppoints) && is_array($pickuppoints)) {
            return $pickuppoints['data'];
        } else {
            if (isset($pickuppoints['message']) && !empty($pickuppoints['message']) && is_array($pickuppoints)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_picktripdata($pickupointid, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $trips = transport_data_with_param_with_urlencode(array('action' => 'get_trip_passengerallotment', 'pickupoint_id' => $pickupointid, 'inst_id' => $inst_id), $apikey);

        if (isset($trips) && !empty($trips) && is_array($trips)) {
            return $trips['data'];
        } else {
            if (isset($trips['message']) && !empty($trips['message']) && is_array($trips)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trips['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trips,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_droptripdata($droppointid, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $trips = transport_data_with_param_with_urlencode(array('action' => 'get_trip_passengerallotment', 'pickupoint_id' => $droppointid, 'inst_id' => $inst_id), $apikey);

        if (isset($trips) && !empty($trips) && is_array($trips)) {
            return $trips['data'];
        } else {
            if (isset($trips['message']) && !empty($trips['message']) && is_array($trips)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trips['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trips,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_vhicle_details($picktrip_id, $inst_id, $acdyr)
    {
        $apikey = $this->session->userdata('API-Key');
        $trips_staff = transport_data_with_param_with_urlencode(array('action' => 'get_vehicle_trip_driver_cleaner_data', 'picktrip_id' => $picktrip_id, 'inst_id' => $inst_id, 'acdyr' => $acdyr), $apikey);

        if (isset($trips_staff) && !empty($trips_staff) && is_array($trips_staff)) {
            return $trips_staff['data'];
        } else {
            if (isset($trips_staff['message']) && !empty($trips_staff['message']) && is_array($trips_staff)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trips_staff['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trips_staff,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_dropvhicle_details($droppoint_tripid, $inst_id, $acdyr)
    {
        $apikey = $this->session->userdata('API-Key');
        $trips_staff = transport_data_with_param_with_urlencode(array('action' => 'get_dropvehicle_trip_driver_cleaner_data', 'droptrip_id' => $droppoint_tripid, 'inst_id' => $inst_id, 'acdyr' => $acdyr), $apikey);

        if (isset($trips_staff) && !empty($trips_staff) && is_array($trips_staff)) {
            return $trips_staff['data'];
        } else {
            if (isset($trips_staff['message']) && !empty($trips_staff['message']) && is_array($trips_staff)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trips_staff['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trips_staff,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_acadyr()
    {
        $apikey = $this->session->userdata('API-Key');
        $acd_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_acdyear',
            'status' => 1,
            'mode' => 'strict',
        ), $apikey);
        if (is_array($acd_data)) {
            return $acd_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acd_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_stream($inst_id = 0)
    {
        $apikey = $this->session->userdata('API-Key');
        $stream_data = transport_data_with_param_with_urlencode(array('action' => 'get_stream', 'status' => 1, 'inst_id' => $inst_id), $apikey);
        if (is_array($stream_data)) {
            return $stream_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $stream_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_session()
    {
        $apikey = $this->session->userdata('API-Key');
        $session_dta = transport_data_with_param_with_urlencode(array('action' => 'get_session'), $apikey);
        if (is_array($session_dta)) {
            return $session_dta['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $session_dta,
                'data' => FALSE
            );
        }
    }

    public function get_all_class()
    {
        $apikey = $this->session->userdata('API-Key');
        $class_data = transport_data_with_param_with_urlencode(array('action' => 'get_class', 'status' => 1), $apikey);
        if (is_array($class_data)) {
            return $class_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $class_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_batch($acd_year)
    {
        $apikey = $this->session->userdata('API-Key');
        $batch = transport_data_with_param_with_urlencode(array('action' => 'get_batch', 'status' => 1, 'Acd_Year' => $acd_year), $apikey);
        if (is_array($batch)) {
            return $batch['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch,
                'data' => FALSE
            );
        }
    }

    public function student_search($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_student_search_list_for_transport';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($search_status)) {
            return $search_status['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $search_status,
                'data' => FALSE
            );
        }
    }

    public function studentadvance_search($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_advancestudent_search_list_for_transport';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($search_status)) {
            return $search_status['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $search_status,
                'data' => FALSE
            );
        }
    }

    public function student_travel_data($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_student_travel_transport';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($search_status)) {
            return $search_status['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $search_status,
                'data' => FALSE
            );
        }
    }

    public function get_batch_data($stream_id, $academic_year, $session_id, $class_id, $flag_status)
    {
        $apikey = $this->session->userdata('API-Key');
        $batch = transport_data_with_param_with_urlencode(array(
            'action' => 'get_batch', 'status' => 1, 'Acd_Year' => $academic_year, 'Stream_ID' => $stream_id,
            'Session_ID' => $session_id, 'Class_Det_ID' => $class_id, 'status_flag' => $flag_status
        ), $apikey);
        if (is_array($batch)) {
            return $batch['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch,
                'data' => FALSE
            );
        }
    }
    public function get_active_pickuppoints($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $acd_year_id = $this->session->userdata('acd_year');
        $pickuppoints = transport_data_with_param_with_urlencode(array('action' => 'get_pickuppoint', 'inst_id' => $inst_id, 'acdYearId' => $acd_year_id, 'mode' => 'fee', 'status' => 1), $apikey);

        if (isset($pickuppoints) && !empty($pickuppoints) && is_array($pickuppoints)) {
            return $pickuppoints['data'];
        } else {
            if (isset($pickuppoints['message']) && !empty($pickuppoints['message']) && is_array($pickuppoints)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_allotment_student($student_allotment_data_raw, $allotmentdata_raw, $inst_id, $acdyr)
    {
        //         dev_export($student_allotment_data_raw);
        //         dev_export($allotmentdata_raw);die;
        $apikey = $this->session->userdata('API-Key');
        $data = [
            'action' => 'savestudent_passengerallotment',
            'student_data' => $student_allotment_data_raw,
            'allotment_data' => $allotmentdata_raw,
            'inst_id' => $inst_id,
            'acdyr' => $acdyr
        ];
        // dev_export($data);
        // die;
        $status_data = transport_data_with_param_with_urlencode($data, $apikey);

        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }

    public function get_all_student_allocation_details()
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_all_student_allocation_details';
        $data['inst_id'] = $this->session->userdata('inst_id');
        $data['acdyr'] = $this->session->userdata('acd_year');
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($search_status)) {
            return $search_status['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $search_status,
                'data' => FALSE
            );
        }
    }

    public function student_travel_history($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_student_travel_history';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($search_status)) {
            return $search_status['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $search_status,
                'data' => FALSE
            );
        }
    }

    public function save_rims_response_fee_transport($response, $student_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_rims_response';
        $data['response'] = $response;
        $data['student_id'] = $student_id;
        $data['module'] = 'TRANSPORT-FEE';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($search_status)) {
            return $search_status['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $search_status,
                'data' => FALSE
            );
        }
    }

    public function get_fee_demand_details($admn_no, $inst_id)
    {
        $apikey = base64_encode('DOCME-TRANSPORT-' . date('Ymd'));
        $data['admn_no'] = $admn_no;
        $data['inst_id'] = $inst_id;
        $json_data = json_encode($data);
        $func = 'Transport/getRIMSTransportStudents_BusFeeDemandDetails';
        $dem_fee_details = transport_data_to_rims($json_data, $apikey, $func, $inst_id);
        if (is_array($dem_fee_details)) {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 0,
                'message' => "",
                'data' => $dem_fee_details
            );
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => "No Data fetched",
                'data' => FALSE
            );
        }
    }
}
