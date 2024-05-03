<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_student_controller
 *
 * @author chandrajith.edsys
 */
class Passenger_student_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Passenger_student_model', 'Mps');
    }
    public function get_trippickuppoint_time($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['route_id']) && !empty($params['route_id'])) {
            $dbparams[1] = $params['route_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Id is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }

        $pickuppoint_list = $this->Mps->get_trip_route_pickuppoints($dbparams);
        if (!empty($pickuppoint_list) && is_array($pickuppoint_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pickuppoint_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_vehicle_trip_driver_cleaner_data($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['picktrip_id']) && !empty($params['picktrip_id'])) {
            $dbparams[1] = $params['picktrip_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pick Trip Id is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }
        if (isset($params['acdyr']) && !empty($params['acdyr'])) {
            $dbparams[3] = $params['acdyr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year Id is required', 'data' => FALSE);
        }

        $vehicledata_list = $this->Mps->get_vehicle_driver_cleaner_data($dbparams);
        if (!empty($vehicledata_list) && is_array($vehicledata_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicledata_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_dropvehicle_trip_driver_cleaner_data($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['droptrip_id']) && !empty($params['droptrip_id'])) {
            $dbparams[1] = $params['droptrip_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Drop Trip Id is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }
        if (isset($params['acdyr']) && !empty($params['acdyr'])) {
            $dbparams[3] = $params['acdyr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year Id is required', 'data' => FALSE);
        }

        $vehicledata_list = $this->Mps->get_dropvehicle_driver_cleaner_data($dbparams);
        if (!empty($vehicledata_list) && is_array($vehicledata_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicledata_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_trips_stops_mapped($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['pickupoint_id']) && !empty($params['pickupoint_id'])) {
            $dbparams[1] = $params['pickupoint_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickuppoint Id is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }

        $pickuppoint_list = $this->Mps->get_trip_pickuppoints($dbparams);
        if (!empty($pickuppoint_list) && is_array($pickuppoint_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pickuppoint_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_student_search($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];



        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $dbparams[1] = $params['admn_no'];
        } else {
            $dbparams[1] = NULL;
        }
        if (isset($params['querystring']) && !empty($params['querystring'])) {
            $dbparams[2] = $params['querystring'];
        } else {
            $dbparams[2] = 1;
        }


        $student_data_list = $this->Mps->get_studentsearch($dbparams);


        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_student_advancesearch($params = NULL)
    {
        //         dev_export($data);die;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['batch_id']) && !empty($params['batch_id'])) {
            $dbparams[1] = $params['batch_id'];
        } else {
            $dbparams[1] = NULL;
        }
        if (isset($params['stream_id']) && !empty($params['stream_id'])) {
            $dbparams[2] = $params['stream_id'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[3] = $params['class_id'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['curent_acdyr']) && !empty($params['curent_acdyr'])) {
            $dbparams[4] = $params['curent_acdyr'];
        } else {
            $dbparams[4] = NULL;
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[5] = $params['inst_id'];
        } else {
            $dbparams[5] = NULL;
        }
        if (isset($params['searchname']) && !empty($params['searchname'])) {
            $dbparams[6] = $params['searchname'];
        } else {
            $dbparams[6] = NULL;
        }
        //        dev_export($dbparams);die;
        $student_data_list = $this->Mps->studentadvance_search($dbparams);


        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function student_allotment_save($param)
    {
        $student_data_raw = NULL;

        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['allotment_data']) && !empty($param['allotment_data'])) {
            $allotment_data_raw = $param['allotment_data'];
        } else {
            return array('status' => 0, 'message' => 'Allotment data  is requried.', 'data' => FALSE);
        }
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('status' => 0, 'message' => 'Institution details is requried.', 'data' => FALSE);
        }
        if (isset($param['acdyr']) && !empty($param['acdyr'])) {
            $acd_id = $param['acdyr'];
        } else {
            return array('status' => 0, 'message' => 'Acdemic year details is requried.', 'data' => FALSE);
        }

        $student_data = json_decode($student_data_raw, TRUE);
        $allotment_data = json_decode($allotment_data_raw, TRUE);
        if (!(isset($student_data) && !empty($student_data) && is_array($student_data))) {
            return array('status' => 0, 'message' => 'Invalid student data. Please check the student details and try again.');
        }
        if (!(isset($allotment_data) && !empty($allotment_data) && is_array($allotment_data))) {
            return array('status' => 0, 'message' => 'Invalid allotment data. Please check the data. ');
        }
        $student_allotment_data_final = array();

        //        dev_export($allotment_data);die;
        foreach ($student_data as $student) {
            $student_allotment_data_final[] = array(
                'studentId' => $student['studentId'],
                'pickStopId' => $allotment_data['pickStopId'],
                'dropStopId' => $allotment_data['dropStopId'],
                'pickTripId' => $allotment_data['pickTripId'],
                'dropTripId' => $allotment_data['dropTripId'],
                'isPick' => $allotment_data['isPick'],
                'isDrop' => $allotment_data['isDrop'],
                'transportstartdate' => $allotment_data['transportstartdate'],
                'effectiveFrom' => $allotment_data['effectiveFrom'],
            );
        }


        //echo json_encode($student_allotment_data_final);die;
        $status = $this->Mps->save_student_transport_allotment($apikey, json_encode($student_allotment_data_final), $inst_id, $acd_id);
        //return $status;
        //        dev_export($status);die;

        if (!empty($status) && is_array($status) && $status[0]['ErrorStatus'] == 0) {
            //        if (isset($status['id']) && !empty($status['id']) && $status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student allotment created successfully.', 'allotmentid' => $status[0]['id']);
        } else {
            if (isset($status[0]['ErrorMessage']) && !empty($status[0]['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status[0]['ErrorMessage'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student allotment failed', 'studentid' => 0);
            }
        }
    }

    public function get_student_travel_transport($params)
    {

        $dbparams[0] = $params['API_KEY'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[1] = $params['student_id'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($params['acd_year_id']) && !empty($params['acd_year_id'])) {
            $dbparams[2] = $params['acd_year_id'];
        } else {
            return array('status' => 0, 'message' => 'Academic Year  is requried.', 'data' => FALSE);
        }

        $student_data_list = $this->Mps->get_student_travel_transport($dbparams);

        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_all_student_allocation_details($params)
    {

        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyr']) && !empty($params['acdyr'])) {
            $dbparams[1] = $params['acdyr'];
        } else {
            return array('status' => 0, 'message' => 'Academic Year  is requried.', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('status' => 0, 'message' => 'Institution Id is requried.', 'data' => FALSE);
        }
        if (isset($params['query']) && !empty($params['query'])) {
            $dbparams[3] = $params['query'];
        } else {
            $dbparams[3] = '';
        }

        $student_data_list = $this->Mps->get_all_student_allocation_details($dbparams);

        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function student_allotment_save_pick($param)
    {
        $student_data_raw = NULL;

        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['allotment_data']) && !empty($param['allotment_data'])) {
            $allotment_data_raw = $param['allotment_data'];
        } else {
            return array('status' => 0, 'message' => 'Allotment data  is requried.', 'data' => FALSE);
        }
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('status' => 0, 'message' => 'Institution details is requried.', 'data' => FALSE);
        }
        if (isset($param['acdyr']) && !empty($param['acdyr'])) {
            $acd_id = $param['acdyr'];
        } else {
            return array('status' => 0, 'message' => 'Acdemic year details is requried.', 'data' => FALSE);
        }

        $student_data = json_decode($student_data_raw, TRUE);
        $allotment_data = json_decode($allotment_data_raw, TRUE);
        if (!(isset($student_data) && !empty($student_data) && is_array($student_data))) {
            return array('status' => 0, 'message' => 'Invalid student data. Please check the student details and try again.');
        }
        if (!(isset($allotment_data) && !empty($allotment_data) && is_array($allotment_data))) {
            return array('status' => 0, 'message' => 'Invalid allotment data. Please check the data. ');
        }
        $student_allotment_data_final = array();

        //        dev_export($allotment_data);die;
        foreach ($student_data as $student) {
            $student_allotment_data_final[] = array(
                'student_id' => $student['studentid'],
                'pickrouteid' => $allotment_data['routeid'],
                'droprouteid' => $allotment_data['routeid'],
                'pickstopid' => $allotment_data['pickid'],
                'dropstopid' => $allotment_data['dropid'],
                'pickpointtripid' => $allotment_data['pickpointtripid'],
                'droppointtripid' => $allotment_data['droppointtripid'],
                'transportstartdate' => $allotment_data['fromdate'],
                'transportenddate' => $allotment_data['todate'],
                'pickStoptime' => $allotment_data['pick_stop_time'],
                'dropStoptime' => $allotment_data['drop_stop_time'],
                'pickfee' => $allotment_data['pickfee'],
                'dropfee' => $allotment_data['dropfee']

            );
        }
        $returna = json_encode($student_allotment_data_final);

        //echo json_encode($student_allotment_data_final);die;
        $status = $this->Mps->save_student_transport_allotment_pick($apikey, json_encode($student_allotment_data_final), $inst_id, $acd_id);
        return $status;
        //        dev_export($status);die;

        if (!empty($status) && is_array($status) && $status[0]['ErrorStatus'] == 0) {
            //        if (isset($status['id']) && !empty($status['id']) && $status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student allotment created successfully.', 'allotmentid' => $status[0]['id']);
        } else {
            if (isset($status[0]['ErrorMessage']) && !empty($status[0]['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status[0]['ErrorMessage'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student allotment failed', 'studentid' => 0);
            }
        }
    }
    public function student_allotment_save_drop($param)
    {
        $student_data_raw = NULL;

        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['allotment_data']) && !empty($param['allotment_data'])) {
            $allotment_data_raw = $param['allotment_data'];
        } else {
            return array('status' => 0, 'message' => 'Allotment data  is requried.', 'data' => FALSE);
        }
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('status' => 0, 'message' => 'Institution details is requried.', 'data' => FALSE);
        }
        if (isset($param['acdyr']) && !empty($param['acdyr'])) {
            $acd_id = $param['acdyr'];
        } else {
            return array('status' => 0, 'message' => 'Acdemic year details is requried.', 'data' => FALSE);
        }

        $student_data = json_decode($student_data_raw, TRUE);
        $allotment_data = json_decode($allotment_data_raw, TRUE);
        if (!(isset($student_data) && !empty($student_data) && is_array($student_data))) {
            return array('status' => 0, 'message' => 'Invalid student data. Please check the student details and try again.');
        }
        if (!(isset($allotment_data) && !empty($allotment_data) && is_array($allotment_data))) {
            return array('status' => 0, 'message' => 'Invalid allotment data. Please check the data. ');
        }
        $student_allotment_data_final = array();

        //        dev_export($allotment_data);die;
        foreach ($student_data as $student) {
            $student_allotment_data_final[] = array(
                'student_id' => $student['studentid'],
                'pickrouteid' => $allotment_data['routeid'],
                'droprouteid' => $allotment_data['routeid'],
                'pickstopid' => $allotment_data['pickid'],
                'dropstopid' => $allotment_data['dropid'],
                'pickpointtripid' => $allotment_data['pickpointtripid'],
                'droppointtripid' => $allotment_data['droppointtripid'],
                'transportstartdate' => $allotment_data['fromdate'],
                'transportenddate' => $allotment_data['todate'],
                'pickStoptime' => $allotment_data['pick_stop_time'],
                'dropStoptime' => $allotment_data['drop_stop_time'],
                'pickfee' => $allotment_data['pickfee'],
                'dropfee' => $allotment_data['dropfee']

            );
        }
        $returna = json_encode($student_allotment_data_final);

        //echo json_encode($student_allotment_data_final);die;
        $status = $this->Mps->save_student_transport_allotment_drop($apikey, json_encode($student_allotment_data_final), $inst_id, $acd_id);
        return $status;
        //        dev_export($status);die;

        if (!empty($status) && is_array($status) && $status[0]['ErrorStatus'] == 0) {
            //        if (isset($status['id']) && !empty($status['id']) && $status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student allotment created successfully.', 'allotmentid' => $status[0]['id']);
        } else {
            if (isset($status[0]['ErrorMessage']) && !empty($status[0]['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status[0]['ErrorMessage'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student allotment failed', 'studentid' => 0);
            }
        }
    }

    public function save_rims_response($params)
    {

        $dbparams[0] = $params['API_KEY'];
        if (isset($params['response']) && !empty($params['response'])) {
            $dbparams[1] = $params['response'];
        }
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[2] = $params['student_id'];
        }

        if (isset($params['module']) && !empty($params['module'])) {
            $dbparams[3] = $params['module'];
        }

        $data = $this->Mps->save_rims_response($dbparams);

        if (!empty($data) && is_array($data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_student_travel_history($params)
    {

        $dbparams[0] = $params['API_KEY'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[1] = $params['student_id'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($params['acd_year_id']) && !empty($params['acd_year_id'])) {
            $dbparams[2] = $params['acd_year_id'];
        } else {
            return array('status' => 0, 'message' => 'Academic Year  is requried.', 'data' => FALSE);
        }

        $student_data_list = $this->Mps->get_student_travel_history($dbparams);

        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
