<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transport_controller
 *
 * @author chandrajith.edsys
 */
class Transport_controller extends MX_Controller
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
        $this->load->model('Transport_model', 'MTransport');
    }

    public function transport_loading()
    {
        $data['template'] = 'settings/show_settings';
        $data['title'] = 'TRANSPORT';
        $data['sub_title'] = 'Transport';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard/show-dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Docme Transport',
                'link' => base_url('transport/load-transport')
            ),
            '2' => array(
                'title' => 'Transport',
                'link' => ''
            )
        );
        $transport_date_lock = $this->MTransport->transport_lock_date();
        //            dev_export($report_date_lock);die;
        if (isset($transport_date_lock['data_status']) && !empty($transport_date_lock['data_status']) && $transport_date_lock['data_status'] == 1) {
            $this->session->set_userdata('lock_start_date', date('d-m-Y', strtotime($transport_date_lock['data'][0]['Academic_year_startdate'])));
            $this->session->set_userdata('lock_end_date', date('d-m-Y', strtotime($transport_date_lock['data'][0]['Academicyear_enddate'])));
        } else {
            $this->session->set_userdata('lock_start_date', date('d-m-Y'));
            $this->session->set_userdata('lock_end_date', date('d-m-Y', strtotime('+1 year')));
        }
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);


        $this->load->view('template/transport_template', $data);
    }

    public function show_basic_settings()
    {
        $data['sub_title'] = 'Basic Settings';

        $this->load->view('settings/show_veh_basic', $data);
    }


    public function show_conductor()
    {
        $data['sub_title'] = 'Conductor';
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
        $conductor_data = $this->MTransport->get_conductor_details($inst_id);
        // dev_export($conductor_data);
        // die;
        if (isset($conductor_data['data']) && !empty($conductor_data['data'])) {
            $data['conductor_data'] = $conductor_data['data'];
        } else {
            $data['conductor_data'] = NULL;
        }
        $this->load->view('Conductor/show_conductor', $data);
    }

    public function show_driver()
    {
        $data['sub_title'] = 'Driver';
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
        $driver_data = $this->MTransport->get_driver_details($inst_id);
        // dev_export($driver_data);
        // die;
        if (isset($driver_data['data']) && !empty($driver_data['data'])) {
            $data['driver_data'] = $driver_data['data'];
        } else {
            $data['driver_data'] = NULL;
        }
        $this->load->view('Driver/show_driver', $data);
    }

    public function add_conductor()
    {
        $data['sub_title'] = 'ADD NEW CONDUCTOR';
        $data['title'] = 'NEW CONDUCTOR';
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
        $emp_data = $this->MTransport->get_all_employee();
        // dev_export($emp_data);
        // return;
        if (isset($emp_data['error_status']) && $emp_data['error_status'] == 0) {
            if ($emp_data['data_status'] == 1) {
                $data['emp_data'] = $emp_data['data'];
            } else {
                $data['emp_data'] = NULL;
            }
        } else {
            $data['emp_data'] = NULL;
        }


        $this->load->view('Conductor/add_conductor', $data);
    }

    public function add_driver()
    {
        $data['sub_title'] = 'ADD NEW DRIVER';
        $data['title'] = 'NEW DRIVER';
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
        $emp_data = $this->MTransport->get_all_employee_for_driver();
        // dev_export($emp_data);
        // return;
        if (isset($emp_data['error_status']) && $emp_data['error_status'] == 0) {
            if ($emp_data['data_status'] == 1) {
                $data['emp_data'] = $emp_data['data'];
            } else {
                $data['emp_data'] = NULL;
            }
        } else {
            $data['emp_data'] = NULL;
        }
        $vehicles = $this->MTransport->get_all_vehicles_for_driver();
        // dev_export($vehicles);
        // return;
        if (isset($vehicles['error_status']) && $vehicles['error_status'] == 0) {
            if ($vehicles['data_status'] == 1) {
                $data['vehicles_data'] = $vehicles['data'];
            } else {
                $data['vehicles_data'] = NULL;
            }
        } else {
            $data['vehicles_data'] = NULL;
        }


        $this->load->view('Driver/add_driver', $data);
    }



    public function save_conductor()
    {
        if ($this->input->is_ajax_request() == 1) {
            $condname = filter_input(INPUT_POST, 'conductor_name', FILTER_SANITIZE_NUMBER_INT);
            $mobile_no = filter_input(INPUT_POST, 'mobile_no', FILTER_SANITIZE_NUMBER_INT);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'Conductor';
            $data['title'] = 'NEW CONDUCTOR';
            $this->form_validation->set_rules('conductor_name', 'Conductor Name', 'trim|required');
            $this->form_validation->set_rules('mobile_no', ' Mobile No', 'trim|required|min_length[10]|max_length[10]');
            if ($this->form_validation->run() == TRUE) {
                $save_conductor_data = $this->MTransport->save_conductor_new($condname, $mobile_no, $password);
                // dev_export($save_conductor_data);
                // return;
                if (isset($save_conductor_data['data_status']) && !empty($save_conductor_data['data_status']) && $save_conductor_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    // $data['spares_data'] = array(
                    //     'sparepartname' => $partname,
                    //     'description' => $description,
                    //     'partnumber' => $partnumber
                    // );
                    if (isset($save_conductor_data['message']) && !empty($save_conductor_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('Conductor/add_conductor', $data, TRUE), 'message' => $save_conductor_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('Conductor/add_conductor', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                // $data['spares_data'] = array(
                //     'sparepartname' => $partname,
                //     'description' => $description,
                //     'partnumber' => $partnumber
                // );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('Conductor/add_conductor', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }


    public function save_driver()
    {
        if ($this->input->is_ajax_request() == 1) {
            $drivername = filter_input(INPUT_POST, 'driver_name', FILTER_SANITIZE_NUMBER_INT);
            $vehicle_no = filter_input(INPUT_POST, 'vehicle_no', FILTER_SANITIZE_NUMBER_INT);
            $startdate = filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING);
            $enddate = filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'Driver';
            $data['title'] = 'NEW Driver';
            // dev_export($startdate);
            // return;
            $this->form_validation->set_rules('driver_name', 'Driver Name', 'trim|required');
            $this->form_validation->set_rules('vehicle_no', ' Vehicle No', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $save_driver_data = $this->MTransport->save_driver_new($drivername, $vehicle_no, $startdate, $enddate);
                if (isset($save_driver_data['data_status']) && !empty($save_driver_data['data_status']) && $save_driver_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {

                    if (isset($save_driver_data['message']) && !empty($save_driver_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('Driver/add_driver', $data, TRUE), 'message' => $save_driver_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('Driver/add_driver', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                // $data['spares_data'] = array(
                //     'sparepartname' => $partname,
                //     'description' => $description,
                //     'partnumber' => $partnumber
                // );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('Driver/add_driver', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }


    public function edit_conductor()
    {
        if ($this->input->is_ajax_request() == 1) {
            $cid = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $c_name =  filter_input(INPUT_POST, 'c_name', FILTER_SANITIZE_STRING);
            if (isset($cid) && !empty($cid)) {
                $select_conductor_data = $this->MTransport->select_conductor($cid);
                $emp_data = $this->MTransport->get_all_employee();

                // dev_export($select_conductor_data);
                // return;
                if (isset($select_conductor_data['data_status']) && !empty($select_conductor_data['data_status']) && $select_conductor_data['data_status'] == 1) {
                    $data['edit_data'] = $select_conductor_data['data'];
                    $data['emp_data'] = $emp_data['data'];

                    $data['title'] = 'Edit - ' . $c_name;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('Conductor/edit_conductor', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such conductor found. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Conductor is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_driver()
    {
        if ($this->input->is_ajax_request() == 1) {
            $did = filter_input(INPUT_POST, 'veh_id', FILTER_SANITIZE_NUMBER_INT);
            $emp_name = filter_input(INPUT_POST, 'emp_name', FILTER_SANITIZE_STRING);
            $veh_num = filter_input(INPUT_POST, 'veh_num', FILTER_SANITIZE_STRING);
            if (isset($did) && !empty($did)) {
                $select_driver_data = $this->MTransport->select_driver($did);
                $emp_data = $this->MTransport->get_all_employee_for_driver();
                //$vehicles = $this->MTransport->get_all_vehicles_for_driver();

                // dev_export($select_driver_data);
                // return;
                if (isset($select_driver_data['data_status']) && !empty($select_driver_data['data_status']) && $select_driver_data['data_status'] == 1) {
                    $data['edit_data'] = $select_driver_data['data'];
                    $data['emp_data'] = $emp_data['data'];
                    //$data['vehicles_data'] = $vehicles['data'];
                    $data['title'] = 'Assigned Driver For Vehicle - ' . $veh_num;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('Driver/edit_driver', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such conductor found. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Driver is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_save_conductor()
    {
        if ($this->input->is_ajax_request() == 1) {
            $cid = filter_input(INPUT_POST, 'pid', FILTER_SANITIZE_NUMBER_INT);
            $condname = filter_input(INPUT_POST, 'conductor_name', FILTER_SANITIZE_NUMBER_INT);
            $mobile_no = filter_input(INPUT_POST, 'mobile_no', FILTER_SANITIZE_NUMBER_INT);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            if (isset($cid) && !empty($cid)) {
                $sdata = $this->MTransport->save_edit_conductor($cid, $condname, $mobile_no, $password);
                if (isset($sdata['data_status']) && $sdata['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Update successfully .'));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Update Failed'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Invalid conductor id given'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_save_driver()
    {
        if ($this->input->is_ajax_request() == 1) {
            // $driver_id = filter_input(INPUT_POST, 'map_id', FILTER_SANITIZE_NUMBER_INT);
            $drivername = filter_input(INPUT_POST, 'driver_name', FILTER_SANITIZE_NUMBER_INT);
            $vehicle_no = filter_input(INPUT_POST, 'vehicle_no', FILTER_SANITIZE_NUMBER_INT);
            // $startdate = filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING);
            // $enddate = filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING);
            if (isset($vehicle_no) && !empty($vehicle_no)) {
                $sdata = $this->MTransport->save_edit_driver($drivername, $vehicle_no);
                if (isset($sdata['data_status']) && $sdata['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Update successfully .'));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Update Failed'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Invalid Driver id given'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function change_status_conductor()
    {
        if ($this->input->is_ajax_request() == 1) {
            $condid = filter_input(INPUT_POST, 'conductor_id', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            $data['CId'] = $condid;
            $data['status'] = $status;
            $data['inst_id'] = $this->session->userdata('inst_id');
            $data['flag'] = 0;
            if (isset($condid) && !empty($condid)) {
                $status_report = $this->MTransport->update_status_conductor($data);
                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Conductor status updated successfully'));
                    return true;
                } else {
                    if (isset($status_report['message']) && !empty($status_report['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status_report['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating status of Conductor. Please try again later'));
                        return TRUE;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Conductor  is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function change_status_driver()
    {
        if ($this->input->is_ajax_request() == 1) {
            $driverid = filter_input(INPUT_POST, 'driver_map_id', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            $data['drivId'] = $driverid;
            $data['status'] = $status;
            $data['inst_id'] = $this->session->userdata('inst_id');
            $data['flag'] = 0;
            if (isset($driverid) && !empty($driverid)) {
                $status_report = $this->MTransport->update_status_driver($data);
                // dev_export($status_report);
                // return;
                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Driver status updated successfully'));
                    return true;
                } else {
                    if (isset($status_report['message']) && !empty($status_report['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status_report['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating status of Driver. Please try again later'));
                        return TRUE;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Driver  is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_select_emp_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $C_id = filter_input(INPUT_POST, 'cid', FILTER_SANITIZE_NUMBER_INT);
            $inst_id = $this->session->userdata('inst_id');
            $emp_data = $this->MTransport->get_select_emp_data($C_id, $inst_id);
            if (isset($emp_data['data']) && !empty($emp_data['data'])) {
                $data['emp_data'] = $emp_data['data'];
            } else {
                $data['emp_data'] = NULL;
            }
            echo json_encode($data);
        } else {
            $this->load->view('template/error-500');
        }
    }

    public function daily_travel_log_view()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'DAILY TRAVEL LOG';
            $inst_id = $this->session->userdata('inst_id');
            $route_data = $this->MTransport->get_all_vehicle_route_data($inst_id);
            if (isset($route_data['data']) && !empty($route_data['data'])) {
                $data['route_data'] = $route_data['data'];
            } else {
                $data['route_data'] = NULL;
            }
            $this->load->view('trip/daily_travel_log', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_daily_travel_log()
    {
        if ($this->input->is_ajax_request() == 1) {
            $tripid = filter_input(INPUT_POST, 'tripid', FILTER_SANITIZE_NUMBER_INT);
            $log_date = filter_input(INPUT_POST, 'log_date', FILTER_SANITIZE_STRING);

            $data['tripId'] = $tripid;
            $data['log_date'] = $log_date;

            $status = $this->MTransport->get_daily_travel_log($data);
            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                $data['log_data'] = $status['data'];
                echo json_encode(array('status' => 1, 'message' => 'Loaded Successfully', 'view' => $this->load->view('trip/partial_travel_data', $data, true)));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    $data['log_data'] = [];
                    echo json_encode(array('status' => 2, 'message' => $status['message'], 'view' => ''));
                    return false;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            }
        }
    }
}
