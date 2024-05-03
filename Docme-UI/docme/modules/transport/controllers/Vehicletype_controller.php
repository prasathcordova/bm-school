<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicletype_controller
 *
 * @author chandrajith.edsys
 */
class Vehicletype_controller extends MX_Controller
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
        $this->load->model('Vehicletype_model', 'Mvtype');
    }

    public function show_vehicle_type()
    {
        $data['sub_title'] = 'Vehicle Type';
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
        $vehicle_type_data = $this->Mvtype->get_all_vehicle_type_data($inst_id);
        if (isset($vehicle_type_data['data']) && !empty($vehicle_type_data['data'])) {
            $data['vehicle_type_data'] = $vehicle_type_data['data'];
        } else {
            $data['vehicle_type_data'] = NULL;
        }
        //        $this->load->view('account_code/show_account_code', $data);
        $this->load->view('vehicle_type/type_vehicle', $data);
    }

    public function add_vehicle_type($lang = '')
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

        $data['sub_title'] = 'VEHICLE TYPE';
        $data['title'] = 'NEW VEHICLE TYPE';
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


        $this->load->view('vehicle_type/add_vehicle_type', $data);
    }

    public function edit_vehicle_type()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'VEHICLE TYPE';
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

            $vehicle_type_id = filter_input(INPUT_POST, 'vehicle_type_id', FILTER_SANITIZE_STRING);
            $type_name = filter_input(INPUT_POST, 'vehicleTypeName', FILTER_SANITIZE_STRING);

            if (isset($vehicle_type_id) && !empty($vehicle_type_id)) {
                $vehicle_type_data = $this->Mvtype->get_vehicle_type_data($vehicle_type_id);
                //dev_export($vehicle_type_data);die;
                if (isset($vehicle_type_data['data_status']) && !empty($vehicle_type_data['data_status']) && $vehicle_type_data['data_status'] == 1 && isset($vehicle_type_data['data'][0])) {
                    $data['type_data'] = $vehicle_type_data['data'][0];
                    $data['title'] = 'Edit - ' . $type_name;

                    echo json_encode(array('status' => 1, 'view' => $this->load->view('vehicle_type/edit_vehicle_type', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such Vehicle Type. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Vehicle Type is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function save_new_vehicle_type()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_type = filter_input(INPUT_POST, 'vehicletype', FILTER_SANITIZE_STRING);
            $desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'VECHICLE TYPE';
            $data['title'] = 'NEW VECHICLE TYPE';
            $this->form_validation->set_rules('vehicletype', ' Vehicle Type', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('description', ' Description', 'trim|required|min_length[3]|max_length[100]');
            if ($this->form_validation->run() == TRUE) {
                $save_vehicle_type_data = $this->Mvtype->save_vehicle_type_new($vehicle_type, $desc);
                //                dev_export($save_vehicle_type_data);die;
                if (isset($save_vehicle_type_data['data_status']) && !empty($save_vehicle_type_data['data_status']) && $save_vehicle_type_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    $data['vehicletype_data'] = array(
                        'vehicle_type' => $vehicle_type,
                        'description' => $desc
                    );
                    if (isset($save_vehicle_type_data['message']) && !empty($save_vehicle_type_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_type/add_vehicle_type', $data, TRUE), 'message' => $save_vehicle_type_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('vehicle_type/add_vehicle_type', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['vehicletype_data'] = array(
                    'vehicle_type' => $vehicle_type,
                    'description' => $desc
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('vehicle_type/add_vehicle_type', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function save_edit_vehicle_type()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_type_id = filter_input(INPUT_POST, 'vehicle_type_id', FILTER_SANITIZE_NUMBER_INT);
            $vehicle_type = filter_input(INPUT_POST, 'vehicle_type', FILTER_SANITIZE_STRING);
            $desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $data['sub_title'] = 'Vehicle Type';
            $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);

            $this->form_validation->set_rules('vehicle_type', ' Vehicle Type', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('description', ' Description', 'trim|required|min_length[3]|max_length[100]');

            if ($this->form_validation->run() == TRUE) {
                $save_vehicle_type_data = $this->Mvtype->save_vehicle_type_edit($vehicle_type_id, $vehicle_type, $desc);
                if (isset($save_vehicle_type_data['data_status']) && !empty($save_vehicle_type_data['data_status']) && $save_vehicle_type_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['type_data'] = array(
                        'vehicle_type' => $vehicle_type,
                        'Description' => $desc,
                        'vehicle_type_id' => $vehicle_type_id,
                        'id' => $vehicle_type_id,
                    );
                    //                    dev_export($data);die;
                    $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                    $data['sub_title'] = 'VEHICLE TYPE';
                    if (isset($save_vehicle_type_data['message']) && !empty($save_vehicle_type_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_type/edit_vehicle_type', $data, TRUE), 'message' => $save_vehicle_type_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('vehicle_type/edit_vehicle_type', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['type_data'] = array(
                    'vehicle_type' => $vehicle_type,
                    'Description' => $desc,
                    'vehicle_type_id' => $vehicle_type_id,
                    'id' => $vehicle_type_id
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('vehicle_type/edit_vehicle_type', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function change_status_of_vehicle_type()
    {

        if ($this->input->is_ajax_request() == 1) {
            $vehicle_type = filter_input(INPUT_POST, 'type_id', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            if (isset($vehicle_type) && !empty($vehicle_type)) {
                $status_report = $this->Mvtype->update_status_vehicle_type($vehicle_type, $status);

                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Vehicle Type status updated successfully'));
                    return true;
                } else {
                    if (isset($status_report['message']) && !empty($status_report['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status_report['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating status of Vehicle Type. Please try again later'));
                        return TRUE;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Vehicle Type  is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
