<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicleinsurance_controller
 *
 * @author chandrajith.edsys
 */
class Vehicleinsurance_controller extends MX_Controller
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
        $this->load->model('Vehicleinsurance_model', 'MVehicleinsurance');
    }

    public function show_vehicle_insurance()
    {


        $data['sub_title'] = 'Vehicle Insurance';
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
        $vehicle_insurance_data = $this->MVehicleinsurance->get_all_vehicle_insurance_data();

        if (isset($vehicle_insurance_data['data']) && !empty($vehicle_insurance_data['data'])) {
            $data['vehicle_insurance_data'] = $vehicle_insurance_data['data'];
        } else {
            $data['vehicle_insurance_data'] = NULL;
        }

        $this->load->view('insurace/show_insurance', $data);
    }
    public function add_vehicle_insurance($lang = '')
    {

        //        $this->lang->load('content', $lang == '' ? 'en' : $lang);
        //        $data['account_code'] = $this->lang->line('Account Code');
        //        $data['account_code'] =$this->lang->line('Account Code');
        //        $data['message']=$this->lang->line('message');
        //        dev_export($data['account_code']);
        //        $data['description'] = $this->lang->line('Description');
        //        $data['name']=$this->lang->line('name');

        $data['sub_title'] = 'Insurance Details';
        $data['title'] = 'NEW INSURANCE';
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

        $this->load->view('insurace/add_insurance', $data);
    }

    public function save_new_insurance()
    {
        if ($this->input->is_ajax_request() == 1) {
            $insurance_cmpny = filter_input(INPUT_POST, 'insurance_cmpny', FILTER_SANITIZE_STRING);
            $desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $data['sub_title'] = 'INSURANCE COMAPNY NAME';
            $data['title'] = 'NEW INSURANCE COMPANY NAME';
            $this->form_validation->set_rules('insurance_cmpny', 'insurance_cmpny', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('description', ' Description', 'trim|required|min_length[3]|max_length[100]');
            if ($this->form_validation->run() == TRUE) {
                $save_insurance_data = $this->MVehicleinsurance->save_vehicle_insurance($insurance_cmpny, $desc);
                //                dev_export($save_vehicle_type_data);die;
                if (isset($save_insurance_data['data_status']) && !empty($save_insurance_data['data_status']) && $save_insurance_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['insurance_data'] = array(
                        'insurance_cmpny' => $insurance_cmpny,
                        'description' => $desc
                    );
                    if (isset($save_insurance_data['message']) && !empty($save_insurance_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('insurace/add_insurance', $data, TRUE), 'message' => $save_insurance_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('insurace/add_insurance', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['insurance_data'] = array(
                    'insurance_cmpny' => $insurance_cmpny,
                    'description' => $desc
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('insurace/add_insurance', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_insurance()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'INSURANCE';
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

            $insurance_id = filter_input(INPUT_POST, 'insurance_id', FILTER_SANITIZE_STRING);
            $insurance_name = filter_input(INPUT_POST, 'insuranceName', FILTER_SANITIZE_STRING);

            if (isset($insurance_id) && !empty($insurance_id)) {
                $insurance_data = $this->MVehicleinsurance->get_vehicle_insurance_data($insurance_id);

                if (isset($insurance_data['data_status']) && !empty($insurance_data['data_status']) && $insurance_data['data_status'] == 1 && isset($insurance_data['data'][0])) {
                    $data['insurance_data'] = $insurance_data['data'][0];
                    $data['title'] = 'Edit - ' . $insurance_name;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('insurace/edit_insurance', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such Insurance Company. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Insurance Company is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function change_status_of_insurance()
    {

        if ($this->input->is_ajax_request() == 1) {
            $insurance = filter_input(INPUT_POST, 'insurance_id', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            if (isset($insurance) && !empty($insurance)) {
                $status_report = $this->MVehicleinsurance->update_status_insurance($insurance, $status);

                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Insurance status updated successfully'));
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
                echo json_encode(array('status' => 0, 'message' => 'Insurance  is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_edit_insurance()
    {
        if ($this->input->is_ajax_request() == 1) {
            $insurance_id = filter_input(INPUT_POST, 'insurance_id', FILTER_SANITIZE_NUMBER_INT);
            $insurnace_name = filter_input(INPUT_POST, 'insurance', FILTER_SANITIZE_STRING);
            $desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $data['sub_title'] = 'Insurance';
            $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);

            $this->form_validation->set_rules('insurance', ' Insurance', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('description', ' Description', 'trim|required|min_length[3]|max_length[100]');

            if ($this->form_validation->run() == TRUE) {
                $save_insurance_data = $this->MVehicleinsurance->save_insurance_edit($insurance_id, $insurnace_name, $desc);
                //                dev_export($save_insurance_data);die;
                if (isset($save_insurance_data['data_status']) && !empty($save_insurance_data['data_status']) && $save_insurance_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['insurance_data'] = array(
                        'insurance_name' => $insurnace_name,
                        'Description' => $desc,
                        'insurance_id' => $insurance_id,
                        'id' => $insurance_id,
                    );
                    //                    dev_export($data);die;
                    $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                    $data['sub_title'] = 'INSURANCE';
                    if (isset($save_insurance_data['message']) && !empty($save_insurance_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('insurace/edit_insurance', $data, TRUE), 'message' => $save_insurance_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('insurace/edit_insurance', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['insurance_data'] = array(
                    'vehicle_type' => $insurnace_name,
                    'Description' => $desc,
                    'insurance_id' => $insurance_id,
                    'id' => $insurance_id
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('insurace/edit_insurance', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
