<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Modeldate_controller
 *
 * @author chandrajith.edsys
 */
class Modeldate_controller extends MX_Controller
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
        $this->load->model('Modeldate_model', 'Myr');
    }

    public function show_modelyr()
    {


        $data['sub_title'] = 'Model Year';
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
        $vehicle_modelyr_data = $this->Myr->get_all_model_yr();
        //        dev_export($vehicle_modelyr_data);die;
        if (isset($vehicle_modelyr_data['data']) && !empty($vehicle_modelyr_data['data'])) {
            $data['vehicle_modelyr_data'] = $vehicle_modelyr_data['data'];
        } else {
            $data['vehicle_modelyr_data'] = NULL;
        }

        $this->load->view('vehicle_model_yr/show_modelyr', $data);
    }

    public function add_vehicle_modelyr($lang = '')
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
        $data['sub_title'] = 'VEHICLE MODEL YEAR';
        $data['title'] = 'NEW VEHICLE MODEL YEAR';
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
        $this->load->view('vehicle_model_yr/add_modelyr', $data);
    }

    public function save_new_vehicle_modelyear()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehiclemodelyr = filter_input(INPUT_POST, 'vehiclemodelyr', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'VECHICLE MODEL YEAR';
            $data['title'] = 'NEW VECHICLE MODEL YEAR';
            $this->form_validation->set_rules('vehiclemodelyr', ' Vehicle Model Year', 'trim|required|min_length[2]|max_length[30]');
            if ($this->form_validation->run() == TRUE) {
                $save_vehicle_modelyr_data = $this->Myr->save_vehicle_modelyr_new($vehiclemodelyr);
                //                dev_export($save_vehicle_modelyr_data);die;
                if (isset($save_vehicle_modelyr_data['data_status']) && !empty($save_vehicle_modelyr_data['data_status']) && $save_vehicle_modelyr_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    $data['vehiclemodelyr_data'] = array(
                        'vehicle_modelyr' => $vehiclemodelyr
                    );
                    if (isset($save_vehicle_modelyr_data['message']) && !empty($save_vehicle_modelyr_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_model_yr/add_modelyr', $data, TRUE), 'message' => $save_vehicle_modelyr_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('vehicle_model_yr/add_modelyr', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['vehiclemodelyr_data'] = array(
                    'vehicle_modelyr' => $vehiclemodelyr
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('vehicle_model_yr/add_modelyr', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function change_status_of_vehicle_modelyr()
    {

        if ($this->input->is_ajax_request() == 1) {
            $vehicle_modelyr = filter_input(INPUT_POST, 'vehmodel_modelId', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            if (isset($vehicle_modelyr) && !empty($vehicle_modelyr)) {
                $status_report = $this->Myr->update_status_vehicle_modelyr($vehicle_modelyr, $status);
                //                dev_export($status_report);die;
                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Vehicle Model Year status updated successfully'));
                    return true;
                } else {
                    if (isset($status_report['message']) && !empty($status_report['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status_report['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating status of Vehicle Model Year. Please try again later'));
                        return TRUE;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Vehicle Model Year is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_vehicle_model_yr()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'VEHICLE MODEL YEAR';

            $modelyr_id = filter_input(INPUT_POST, 'modelyr_id', FILTER_SANITIZE_STRING);
            $modelyrname = filter_input(INPUT_POST, 'modelyrname', FILTER_SANITIZE_STRING);
            if (isset($modelyr_id) && !empty($modelyr_id)) {
                $vehicle_modelyear_data = $this->Myr->get_modelyear_data($modelyr_id);

                if (isset($vehicle_modelyear_data['data_status']) && !empty($vehicle_modelyear_data['data_status']) && $vehicle_modelyear_data['data_status'] == 1 && isset($vehicle_modelyear_data['data'][0])) {
                    $data['model_data'] = $vehicle_modelyear_data['data'][0];
                    $data['title'] = 'Edit - ' . $modelyrname;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('vehicle_model_yr/edit_model_yr', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such Model Year. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Vehicle Model Year is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_edit_model_year()
    {
        if ($this->input->is_ajax_request() == 1) {
            $model_year_id = filter_input(INPUT_POST, 'vehicle_model_id', FILTER_SANITIZE_NUMBER_INT);
            $model_year = filter_input(INPUT_POST, 'vehicle_model_yr', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'Model Year';
            $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);

            $this->form_validation->set_rules('vehicle_model_yr', ' vehicle_model_yr', 'trim|required|min_length[3]|max_length[30]');


            if ($this->form_validation->run() == TRUE) {
                $save_model_year_data = $this->Myr->save_model_year_edit($model_year_id, $model_year);
                if (isset($save_model_year_data['data_status']) && !empty($save_model_year_data['data_status']) && $save_model_year_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['model_data'] = array(
                        'vModel' => $model_year,
                        'modelyear_id' => $model_year_id,
                        'id' => $model_year_id
                    );

                    $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                    $data['sub_title'] = 'MODEL YEAR';

                    if (isset($save_model_year_data['message']) && !empty($save_model_year_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_model_yr/edit_model_yr', $data, TRUE), 'message' => $save_model_year_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('vehicle_model_yr/edit_model_yr', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['model_data'] = array(
                    'vModel' => $model_year,
                    'modelyear_id' => $model_year_id,
                    'id' => $model_year_id
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('vehicle_model_yr/edit_model_yr', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
