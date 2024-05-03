<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicle_registration_controller
 *
 * @author chandrajith.edsys
 */
class Vehicle_registration_controller extends MX_Controller
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
        $this->load->model('Vehicle_registration_model', 'MVehiclereg');
    }
    public function new_vehicleregistration()
    {


        $data['sub_title'] = 'NEW VEHICLE REGISTRATION';
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
        $vehtype = $this->MVehiclereg->get_all_vehicletypes();
        if (isset($vehtype['error_status']) && $vehtype['error_status'] == 0) {
            if ($vehtype['data_status'] == 1) {
                $data['vehicletype_data'] = $vehtype['data'];
            } else {
                $data['vehicletype_data'] = NULL;
            }
        } else {
            $data['vehicletype_data'] = NULL;
        }
        $fueltype = $this->MVehiclereg->get_all_fueltypes();
        if (isset($fueltype['error_status']) && $fueltype['error_status'] == 0) {
            if ($fueltype['data_status'] == 1) {
                $data['fueltype_data'] = $fueltype['data'];
            } else {
                $data['fueltype_data'] = NULL;
            }
        } else {
            $data['fueltype_data'] = NULL;
        }
        $inscompany = $this->MVehiclereg->get_all_vehicle_insurance_data();
        if (isset($inscompany['error_status']) && $inscompany['error_status'] == 0) {
            if ($inscompany['data_status'] == 1) {
                $data['inscompanyname_data'] = $inscompany['data'];
            } else {
                $data['inscompanyname_data'] = NULL;
            }
        } else {
            $data['inscompanyname_data'] = NULL;
        }
        $make = $this->MVehiclereg->get_all_vehicle_make_data();
        if (isset($make['error_status']) && $make['error_status'] == 0) {
            if ($make['data_status'] == 1) {
                $data['make_data'] = $make['data'];
            } else {
                $data['make_data'] = NULL;
            }
        } else {
            $data['make_data'] = NULL;
        }
        $modelyr = $this->MVehiclereg->get_all_model_yr();
        //          dev_export($model);die;
        if (isset($modelyr['error_status']) && $modelyr['error_status'] == 0) {
            if ($modelyr['data_status'] == 1) {
                $data['modelyr_data'] = $modelyr['data'];
            } else {
                $data['modelyr_data'] = NULL;
            }
        } else {
            $data['modelyr_data'] = NULL;
        }
        $model = $this->MVehiclereg->get_all_vehicle_model_data();
        //          dev_export($model);die;
        if (isset($model['error_status']) && $model['error_status'] == 0) {
            if ($model['data_status'] == 1) {
                $data['model_data'] = $model['data'];
            } else {
                $data['model_data'] = NULL;
            }
        } else {
            $data['model_data'] = NULL;
        }


        $this->load->view('vehicle_registration/new_registration', $data);
    }
    public function save_vehicleregistration()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_data_raw = filter_input(INPUT_POST, 'vehicledata');
            //              dev_export($vehicle_data_raw);die;
            $data['sub_title'] = 'VECHICLE';
            $data['title'] = 'NEW VECHICLE';

            if ($vehicle_data_raw) {
                $save_vehicle_type_data = $this->MVehiclereg->save_vehicle_profile($vehicle_data_raw);
                //                dev_export($save_vehicle_type_data);die;
                if (isset($save_vehicle_type_data['data_status']) && !empty($save_vehicle_type_data['data_status']) && $save_vehicle_type_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'message' => $save_vehicle_type_data['message']));
                    return TRUE;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Something went wrong'));
                return TRUE;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function show_vehicleregistration()
    {
        $data['sub_title'] = 'Vehicle Registration';
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
        $vehicle_data = $this->MVehiclereg->get_vehicle_data($inst_id);
        if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
            $data['vehicle_data'] = $vehicle_data['data'];
        } else {
            $data['vehicle_data'] = NULL;
        }
        //        $this->load->view('account_code/show_account_code', $data);
        $this->load->view('vehicle_registration/show_registration', $data);
    }

    public function edit_vehicle_registration()
    {
        if ($this->input->is_ajax_request() == 1) {

            $data['sub_title'] = 'EDIT VEHICLE REGISTRATION';
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
            $vehtype = $this->MVehiclereg->get_all_vehicletypes();
            if (isset($vehtype['error_status']) && $vehtype['error_status'] == 0) {
                if ($vehtype['data_status'] == 1) {
                    $data['vehicletype_data'] = $vehtype['data'];
                } else {
                    $data['vehicletype_data'] = NULL;
                }
            } else {
                $data['vehicletype_data'] = NULL;
            }
            $fueltype = $this->MVehiclereg->get_all_fueltypes();
            if (isset($fueltype['error_status']) && $fueltype['error_status'] == 0) {
                if ($fueltype['data_status'] == 1) {
                    $data['fueltype_data'] = $fueltype['data'];
                } else {
                    $data['fueltype_data'] = NULL;
                }
            } else {
                $data['fueltype_data'] = NULL;
            }
            $inscompany = $this->MVehiclereg->get_all_vehicle_insurance_data();
            if (isset($inscompany['error_status']) && $inscompany['error_status'] == 0) {
                if ($inscompany['data_status'] == 1) {
                    $data['inscompanyname_data'] = $inscompany['data'];
                } else {
                    $data['inscompanyname_data'] = NULL;
                }
            } else {
                $data['inscompanyname_data'] = NULL;
            }
            $make = $this->MVehiclereg->get_all_vehicle_make_data();
            if (isset($make['error_status']) && $make['error_status'] == 0) {
                if ($make['data_status'] == 1) {
                    $data['make_data'] = $make['data'];
                } else {
                    $data['make_data'] = NULL;
                }
            } else {
                $data['make_data'] = NULL;
            }
            $modelyr = $this->MVehiclereg->get_all_model_yr();
            //          dev_export($model);die;
            if (isset($modelyr['error_status']) && $modelyr['error_status'] == 0) {
                if ($modelyr['data_status'] == 1) {
                    $data['modelyr_data'] = $modelyr['data'];
                } else {
                    $data['modelyr_data'] = NULL;
                }
            } else {
                $data['modelyr_data'] = NULL;
            }
            $model = $this->MVehiclereg->get_all_vehicle_model_data();
            //          dev_export($model);die;
            if (isset($model['error_status']) && $model['error_status'] == 0) {
                if ($model['data_status'] == 1) {
                    $data['model_data'] = $model['data'];
                } else {
                    $data['model_data'] = NULL;
                }
            } else {
                $data['model_data'] = NULL;
            }
            $vehicle_id = filter_input(INPUT_POST, 'vehicleId', FILTER_SANITIZE_NUMBER_INT);
            $vehicle_num = filter_input(INPUT_POST, 'vehicleNum', FILTER_SANITIZE_STRING);

            //$this->load->view('vehicle_registration/edit_registration', $data);
            if (isset($vehicle_id) && !empty($vehicle_id)) {
                $inst_id = $this->session->userdata('inst_id');
                $vehicle_data['id'] = $vehicle_id;
                $vehicle_data['vehicleNum'] = $vehicle_num;
                $vehicle_data = $this->MVehiclereg->get_vehicle_data($inst_id, $vehicle_data);
                $this->load->model('Fuel_log_model', 'MFuelLog');
                $fuel_data = $this->MFuelLog->get_fuel_details($vehicle_id, $inst_id);
                if (!empty($fuel_data['data'])) {
                    $data['is_fuel_log'] = 1;
                } else {
                    $data['is_fuel_log'] = 0;
                }
                if (isset($vehicle_data['data_status']) && !empty($vehicle_data['data_status']) && $vehicle_data['data_status'] == 1 && isset($vehicle_data['data'][0])) {

                    $data['vehicle_data'] = $vehicle_data['data'][0];
                    $data['title'] = 'Edit - ' . $vehicle_num;

                    echo json_encode(array('status' => 1, 'view' => $this->load->view('vehicle_registration/edit_registration', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no Vehicle . Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Vehicle is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function update_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicleid = filter_input(INPUT_POST, 'vehicleid', FILTER_SANITIZE_NUMBER_INT);
            if (isset($vehicleid) && !empty($vehicleid)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['id'] = filter_input(INPUT_POST, 'vehicleid', FILTER_SANITIZE_STRING);
                $status = $this->MVehiclereg->edit_status_vehicle($data_prep);

                if (is_array($status) && $status['status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                    return;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                return;
            }
        } else {
            echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
            return;
        }
    }

    public function save_update_vehicle_registration()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            //$vehicle_data = filter_input(INPUT_POST, 'vehicledata', FILTER_SANITIZE_STRING);
            $vehicle_data = $this->input->post('vehicledata');
            if (isset($vehicle_id) && !empty($vehicle_id)) {
                $update_status = $this->MVehiclereg->update_vehicle_registration($vehicle_id, $vehicle_data);

                if (isset($update_status['data_status']) && !empty($update_status['data_status']) && $update_status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Vehicle Details updated successfully'));
                    return true;
                } else {
                    if (isset($update_status['message']) && !empty($update_status['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $update_status['message']));
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
}
