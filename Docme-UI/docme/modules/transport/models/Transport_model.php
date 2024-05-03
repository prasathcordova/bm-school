<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transport_model
 *
 * @author chandrajith.edsys
 */
class Transport_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function transport_lock_date()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $report_lock_date = transport_data_with_param_with_urlencode(array('action' => 'get_transportlockdate', 'inst_id' => $inst_id), $apikey);
        //        $route = transport_data_with_param_with_urlencode(array('action' => 'get_route', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
        if (is_array($report_lock_date) && isset($report_lock_date['status']) && !empty($report_lock_date['status']) && $report_lock_date['status'] == 1 && isset($report_lock_date['data'])) {
            return $report_lock_date['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_lock_date,
                'data' => FALSE
            );
        }
    }

    public function get_conductor_details($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $conductors_data = transport_data_with_param_with_urlencode(array('action' => 'get_conductors', 'inst_id' => $inst_id), $apikey);
        if (isset($conductors_data) && !empty($conductors_data) && is_array($conductors_data)) {
            return $conductors_data['data'];
        } else {
            if (isset($conductors_data['message']) && !empty($conductors_data['message']) && is_array($conductors_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $conductors_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $conductors_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_driver_details($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $driver_data = transport_data_with_param_with_urlencode(array('action' => 'get_driver', 'inst_id' => $inst_id), $apikey);
        // dev_export($driver_data);
        // return;
        if (isset($driver_data) && !empty($driver_data) && is_array($driver_data)) {
            return $driver_data['data'];
        } else {
            if (isset($driver_data['message']) && !empty($driver_data['message']) && is_array($driver_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $driver_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $driver_data,
                    'data' => FALSE
                );
            }
        }
    }




    public function save_conductor_new($conduname, $mob_no, $paswd)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');

        $conductor_status = transport_data_with_param_with_urlencode(array(
            'action' => 'save_conductor',
            'name' => $conduname,
            'mobile' => $mob_no,
            'password' => $paswd,
            'Inst_id' => $inst_id
        ), $apikey);
        //        dev_export($vendor);die;
        if (isset($conductor_status) && !empty($conductor_status) && is_array($conductor_status)) {
            return $conductor_status['data'];
        } else {
            if (isset($conductor_status['message']) && !empty($conductor_status['message']) && is_array($conductor_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $conductor_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $conductor_status,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_driver_new($drivername, $veh_no, $start_date, $end_date)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');

        $driver_status = transport_data_with_param_with_urlencode(array(
            'action' => 'save_driver',
            'name' => $drivername,
            'veh_no' => $veh_no,
            'startdate' => $start_date,
            'enddate' => $end_date,
            'Inst_id' => $inst_id
        ), $apikey);
        // dev_export($driver_status);
        // die;
        if (isset($driver_status) && !empty($driver_status) && is_array($driver_status)) {
            return $driver_status['data'];
        } else {
            if (isset($driver_status['message']) && !empty($driver_status['message']) && is_array($driver_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $driver_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $driver_status,
                    'data' => FALSE
                );
            }
        }
    }


    public function select_conductor($cid)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data = array(
            'action' => 'select_conductor_for_edit',
            'cid' => $cid
        );
        $conductor_edit_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($conductor_edit_status) && !empty($conductor_edit_status) && is_array($conductor_edit_status)) {
            return $conductor_edit_status['data'];
        } else {
            if (isset($conductor_edit_status['message']) && !empty($conductor_edit_status['message']) && is_array($conductor_edit_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $conductor_edit_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $conductor_edit_status,
                    'data' => FALSE
                );
            }
        }
    }


    public function select_driver($did)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data = array(
            'action' => 'select_driver_for_edit',
            'did' => $did
        );
        $driver_edit_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($driver_edit_status) && !empty($driver_edit_status) && is_array($driver_edit_status)) {
            return $driver_edit_status['data'];
        } else {
            if (isset($driver_edit_status['message']) && !empty($driver_edit_status['message']) && is_array($driver_edit_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $driver_edit_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $driver_edit_status,
                    'data' => FALSE
                );
            }
        }
    }


    public function save_edit_conductor($cid, $conduname, $mob_no, $paswd)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $status_data = transport_data_with_param_with_urlencode(
            array(
                'action'      => 'update_conductor',
                'id'        => $cid,
                'name'    => $conduname,
                'mobile'    => $mob_no,
                'paswd'     => $paswd
            ),
            $apikey
        );
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

    public function save_edit_driver($driveremp_id, $veh_no)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $status_data = transport_data_with_param_with_urlencode(
            array(
                'action'      => 'update_driver',
                // 'id'        => $did,
                'driver_name'    => $driveremp_id,
                'vehicle_no' => $veh_no
                // 'start_date'    => $start_date,
                // 'enddate'     => $end_date
            ),
            $apikey
        );
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

    public function update_status_conductor($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'status_modify_conductor';
        $conductor_status = transport_data_with_param_with_urlencode($data, $apikey);
        // dev_export($conductor_data);
        // return;
        if (isset($conductor_status) && !empty($conductor_status) && is_array($conductor_status)) {
            return $conductor_status['data'];
        } else {
            if (isset($conductor_status['message']) && !empty($conductor_status['message']) && is_array($conductor_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $conductor_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $conductor_status,
                    'data' => FALSE
                );
            }
        }
    }


    public function update_status_driver($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'status_modify_driver';
        $driver_status = transport_data_with_param_with_urlencode($data, $apikey);
        // dev_export($conductor_data);
        // return;
        if (isset($driver_status) && !empty($driver_status) && is_array($driver_status)) {
            return $driver_status['data'];
        } else {
            if (isset($driver_status['message']) && !empty($driver_status['message']) && is_array($driver_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $driver_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $driver_status,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_employee()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $employee_data = transport_data_with_param_with_urlencode(array('action' => 'get_employee', 'inst_id' => $inst_id), $apikey);
        if (isset($employee_data) && !empty($employee_data) && is_array($employee_data)) {
            return $employee_data['data'];
        } else {
            if (isset($employee_data['message']) && !empty($employee_data['message']) && is_array($employee_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $employee_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => '',
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_employee_for_driver()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $employee_data = transport_data_with_param_with_urlencode(array('action' => 'get_employeefor_driver', 'inst_id' => $inst_id), $apikey);
        if (isset($employee_data) && !empty($employee_data) && is_array($employee_data)) {
            return $employee_data['data'];
        } else {
            if (isset($employee_data['message']) && !empty($employee_data['message']) && is_array($employee_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $employee_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => '',
                    'data' => FALSE
                );
            }
        }
    }
    public function get_select_emp_data($C_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $emp_data = transport_data_with_param_with_urlencode(array('action' => 'get_select_emp_data', 'C_id' => $C_id, 'inst_id' => $inst_id, 'mode' => 'strict', 'status' => 1), $apikey);
        if (isset($emp_data) && !empty($emp_data) && is_array($emp_data)) {
            return $emp_data['data'];
        } else {
            if (isset($emp_data['message']) && !empty($emp_data['message']) && is_array($emp_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $emp_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $emp_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_vehicles_for_driver()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_details = transport_data_with_param_with_urlencode(array('action' => 'get_vehiclereg_for_driver', 'Inst_Id' => $inst_id, 'mode' => 'strict'), $apikey);
        if (isset($vehicle_details) && !empty($vehicle_details) && is_array($vehicle_details)) {
            return $vehicle_details['data'];
        } else {
            if (isset($vehicle_details['message']) && !empty($vehicle_details['message']) && is_array($vehicle_details)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_details['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_details,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_vehicle_route_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $route = transport_data_with_param_with_urlencode(array('action' => 'get_route', 'inst_id' => $inst_id, 'mode' => 'strict', 'status' => 1), $apikey);

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

    public function get_daily_travel_log($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data['action'] = 'get_travel_log';
        $data['inst_id'] = $inst_id;
        $log_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($log_data) && !empty($log_data) && is_array($log_data)) {
            return $log_data['data'];
        } else {
            if (isset($log_data['message']) && !empty($log_data['message']) && is_array($log_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $log_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $log_data,
                    'data' => FALSE
                );
            }
        }
    }
}
