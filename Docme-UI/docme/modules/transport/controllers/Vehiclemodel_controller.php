<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehiclemodel_controller
 *
 * @author chandrajith.edsys
 */
class Vehiclemodel_controller extends MX_Controller
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
        $this->load->model('Vehiclemodel_model', 'MVehiclemodel');
    }

    public function show_vehicle_model()
    {


        $data['sub_title'] = 'Vehicle Model';
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
        $vehicle_model_data = $this->MVehiclemodel->get_all_vehicle_model_data();

        if (isset($vehicle_model_data['data']) && !empty($vehicle_model_data['data'])) {
            $data['vehicle_model_data'] = $vehicle_model_data['data'];
        } else {
            $data['vehicle_model_data'] = NULL;
        }

        $this->load->view('vehicle_model/model_vehicle', $data);
    }

    public function add_vehicle_model($lang = '')
    {

        //        $this->lang->load('content', $lang == '' ? 'en' : $lang);
        //        $data['account_code'] = $this->lang->line('Account Code');
        //        $data['account_code'] =$this->lang->line('Account Code');
        //        $data['message']=$this->lang->line('message');
        //        dev_export($data['account_code']);
        //        $data['description'] = $this->lang->line('Description');
        //        $data['name']=$this->lang->line('name');

        $data['sub_title'] = 'Vehicle Model';
        $data['title'] = 'NEW VEHICLE MODEL';
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
        //        dev_export($data);die;

        $this->load->view('vehicle_model/add_model', $data);
    }

    public function save_new_vehicle_model()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_model = filter_input(INPUT_POST, 'vehiclemodel', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'VECHICLE MODEL';
            $data['title'] = 'NEW VECHICLE MODEL';
            $this->form_validation->set_rules('vehiclemodel', ' Vehicle Model', 'trim|required|min_length[3]|max_length[25]');
            if ($this->form_validation->run() == TRUE) {
                $save_vehicle_model_data = $this->MVehiclemodel->save_vehicle_model_new($vehicle_model);

                if (isset($save_vehicle_model_data['data_status']) && !empty($save_vehicle_model_data['data_status']) && $save_vehicle_model_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data Inserted successfully'));
                    return TRUE;
                } else {
                    $data['vehiclemodel_data'] = array(
                        'vehicle_model' => $vehicle_model
                    );
                    if (isset($save_vehicle_model_data['message']) && !empty($save_vehicle_model_data['message'])) {
                        //                        dev_export($save_vehicle_model_data);die;
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_model/add_model', $data, TRUE), 'message' => $save_vehicle_model_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('vehicle_model/add_model', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['vehiclemodel_data'] = array(
                    'vehicle_model' => $vehicle_model
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('vehicle_model/add_model', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function change_status_of_vehicle_model()
    {

        if ($this->input->is_ajax_request() == 1) {
            $vehicle_model = filter_input(INPUT_POST, 'vehmodel_id', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            if (isset($vehicle_model) && !empty($vehicle_model)) {
                $status_report = $this->MVehiclemodel->update_status_vehicle_model($vehicle_model, $status);

                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Vehicle Model status updated successfully'));
                    return true;
                } else {
                    if (isset($status_report['message']) && !empty($status_report['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status_report['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating status of Vehicle Model. Please try again later'));
                        return TRUE;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Vehicle Model  is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_vehicle_model()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'VEHICLE MODEL';
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

            $vehicle_model_id = filter_input(INPUT_POST, 'vehicle_model_id', FILTER_SANITIZE_STRING);
            $model_name = filter_input(INPUT_POST, 'vehicle_model_name', FILTER_SANITIZE_STRING);

            if (isset($vehicle_model_id) && !empty($vehicle_model_id)) {
                $vehicle_model_data = $this->MVehiclemodel->get_vehicle_model_data($vehicle_model_id);

                if (isset($vehicle_model_data['data_status']) && !empty($vehicle_model_data['data_status']) && $vehicle_model_data['data_status'] == 1 && isset($vehicle_model_data['data'][0])) {
                    $data['model_data'] = $vehicle_model_data['data'][0];
                    $data['title'] = 'Edit - ' . $model_name;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('vehicle_model/edit_model', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such Vehicle Model. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Vehicle Model is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_edit_vehicle_model()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_model_id = filter_input(INPUT_POST, 'vehicle_model_id', FILTER_SANITIZE_NUMBER_INT);
            $vehicle_model = filter_input(INPUT_POST, 'vehicle_model', FILTER_SANITIZE_STRING);

            $data['sub_title'] = 'Vehicle Model';
            $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);

            $this->form_validation->set_rules('vehicle_model', ' Vehicle Model', 'trim|required|min_length[3]|max_length[30]');


            if ($this->form_validation->run() == TRUE) {
                $save_vehicle_model_data = $this->MVehiclemodel->save_vehicle_model_edit($vehicle_model_id, $vehicle_model);
                //                dev_export($save_vehicle_model_data);die;
                if (isset($save_vehicle_model_data['data_status']) && !empty($save_vehicle_model_data['data_status']) && $save_vehicle_model_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['model_data'] = array(
                        'vehicle_model' => $vehicle_model,
                        'vehicle_model_id' => $vehicle_model_id,
                        'id' => $vehicle_model_id,
                    );
                    //                    dev_export($data);die;
                    $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                    $data['sub_title'] = 'VEHICLE MODEL';
                    if (isset($save_vehicle_model_data['message']) && !empty($save_vehicle_model_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_model/edit_model', $data, TRUE), 'message' => $save_vehicle_model_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('vehicle_model/edit_model', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['model_data'] = array(
                    'vehicle_model' => $vehicle_model,
                    'vehicle_model_id' => $vehicle_model_id,
                    'id' => $vehicle_model_id
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('vehicle_model/edit_model', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
