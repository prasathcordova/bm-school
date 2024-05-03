<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_staff_controller
 *
 * @author Chandrajith
 */
class Passenger_staff_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Passenger_staff_model', 'Mpsm');
    }

    public function get_staff($params = NULL) {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
         if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }

        $staff_list = $this->Mpsm->get_staff_details($dbparams);
        if (!empty($staff_list) && is_array($staff_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $staff_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
     public function get_trippickuppoint_time_emp($params = NULL) {       
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

        $pickuppoint_list = $this->Mpsm->get_trip_route_pickuppoints_emp($dbparams);
        if (!empty($pickuppoint_list) && is_array($pickuppoint_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pickuppoint_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
     public function emp_allotment_save($param) {
        $emp_data_raw = NULL;
       
        $apikey = $param['API_KEY'];
        if (isset($param['employee_data']) && !empty($param['employee_data'])) {
            $emp_data_raw = $param['employee_data'];
        } else {
            return array('status' => 0, 'message' => 'Employee data  is requried.', 'data' => FALSE);
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

        $emp_data = json_decode($emp_data_raw, TRUE);
        $allotment_data = json_decode($allotment_data_raw, TRUE);
        if(!(isset($emp_data) && !empty($emp_data) && is_array($emp_data))) {
            return array('status' => 0, 'message' => 'Invalid Employee data. Please check the employee details and try again.');
        }
        if(!(isset($allotment_data) && !empty($allotment_data) && is_array($allotment_data))) {
            return array('status' => 0,'message' => 'Invalid allotment data. Please check the data. ');
        }
        $employee_allotment_data_final = array();
        
//        dev_export($allotment_data);die;
        foreach ($emp_data as $employee) {
            $employee_allotment_data_final[] = array(
                'employee_id' => $employee['empid'],
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
//        $returna= json_encode($employee_allotment_data_final);
//        return $returna; die;
        
//echo json_encode($student_allotment_data_final);die;
        $status = $this->Mpsm->save_employee_transport_allotment($apikey, json_encode($employee_allotment_data_final),$inst_id,$acd_id);
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
     public function emp_allotment_save_pick($param) {
        $emp_data_raw = NULL;
       
        $apikey = $param['API_KEY'];
        if (isset($param['employee_data']) && !empty($param['employee_data'])) {
            $emp_data_raw = $param['employee_data'];
        } else {
            return array('status' => 0, 'message' => 'Employee data  is requried.', 'data' => FALSE);
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

        $emp_data = json_decode($emp_data_raw, TRUE);
        $allotment_data = json_decode($allotment_data_raw, TRUE);
        if(!(isset($emp_data) && !empty($emp_data) && is_array($emp_data))) {
            return array('status' => 0, 'message' => 'Invalid Employee data. Please check the employee details and try again.');
        }
        if(!(isset($allotment_data) && !empty($allotment_data) && is_array($allotment_data))) {
            return array('status' => 0,'message' => 'Invalid allotment data. Please check the data. ');
        }
        $employee_allotment_data_final = array();
        
//        dev_export($allotment_data);die;
        foreach ($emp_data as $employee) {
            $employee_allotment_data_final[] = array(
                'employee_id' => $employee['empid'],
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
//        $returna= json_encode($employee_allotment_data_final);
//        return $returna; die;
        
//echo json_encode($student_allotment_data_final);die;
        $status = $this->Mpsm->save_employee_transport_allotment_pick($apikey, json_encode($employee_allotment_data_final),$inst_id,$acd_id);
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
     public function emp_allotment_save_drop($param) {
        $emp_data_raw = NULL;
       
        $apikey = $param['API_KEY'];
        if (isset($param['employee_data']) && !empty($param['employee_data'])) {
            $emp_data_raw = $param['employee_data'];
        } else {
            return array('status' => 0, 'message' => 'Employee data  is requried.', 'data' => FALSE);
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

        $emp_data = json_decode($emp_data_raw, TRUE);
        $allotment_data = json_decode($allotment_data_raw, TRUE);
        if(!(isset($emp_data) && !empty($emp_data) && is_array($emp_data))) {
            return array('status' => 0, 'message' => 'Invalid Employee data. Please check the employee details and try again.');
        }
        if(!(isset($allotment_data) && !empty($allotment_data) && is_array($allotment_data))) {
            return array('status' => 0,'message' => 'Invalid allotment data. Please check the data. ');
        }
        $employee_allotment_data_final = array();
        
//        dev_export($allotment_data);die;
        foreach ($emp_data as $employee) {
            $employee_allotment_data_final[] = array(
                'employee_id' => $employee['empid'],
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
//        $returna= json_encode($employee_allotment_data_final);
//        return $returna; die;
        
//echo json_encode($student_allotment_data_final);die;
        $status = $this->Mpsm->save_employee_transport_allotment_drop($apikey, json_encode($employee_allotment_data_final),$inst_id,$acd_id);
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

}
