<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehiclemake_controller
 *
 * @author chandrajith.edsys
 */
class Vehiclemake_controller extends MX_Controller
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
        $this->load->model('Vehiclemake_model', 'MVehiclemake');
    }

    public function show_vehicle_make()
    {


        $data['sub_title'] = 'Vehicle Make';
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
        $vehicle_make_data = $this->MVehiclemake->get_all_vehicle_make_data();

        if (isset($vehicle_make_data['data']) && !empty($vehicle_make_data['data'])) {
            $data['vehicle_make_data'] = $vehicle_make_data['data'];
        } else {
            $data['vehicle_make_data'] = NULL;
        }

        $this->load->view('vehicle_make/make_vehicle', $data);
    }
    public function add_vehicle_make($lang = '')
    {

        //        $this->lang->load('content', $lang == '' ? 'en' : $lang);
        //        $data['account_code'] = $this->lang->line('Account Code');
        //        $data['account_code'] =$this->lang->line('Account Code');
        //        $data['message']=$this->lang->line('message');
        //        dev_export($data['account_code']);
        //        $data['description'] = $this->lang->line('Description');
        //        $data['name']=$this->lang->line('name');

        $data['sub_title'] = 'Vehicle Make';
        $data['title'] = 'NEW VEHICLE MAKE';
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

        $this->load->view('vehicle_make/add_make', $data);
    }
    public function save_new_vehicle_make()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_make = filter_input(INPUT_POST, 'vehiclemake', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'VECHICLE MAKE';
            $data['title'] = 'NEW VECHICLE MAKE';
            $this->form_validation->set_rules('vehiclemake', ' Vehicle Make', 'trim|required|min_length[3]|max_length[50]');
            if ($this->form_validation->run() == TRUE) {
                $save_vehicle_make_data = $this->MVehiclemake->save_vehicle_make_new($vehicle_make);
                //                dev_export($save_vehicle_make_data);die;
                if (isset($save_vehicle_make_data['data_status']) && !empty($save_vehicle_make_data['data_status']) && $save_vehicle_make_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['vehicletype_data'] = array(
                        'vehicle_type' => $vehicle_make
                    );
                    if (isset($save_vehicle_make_data['message']) && !empty($save_vehicle_make_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_make/add_make', $data, TRUE), 'message' => $save_vehicle_make_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('vehicle_make/add_make', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['vehiclemake_data'] = array(
                    'vehicle_make' => $vehicle_make
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('vehicle_make/add_make', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function edit_make()
    {

        $data['sub_title'] = 'Basic Settings';
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


        $this->load->view('vehicle_make/edit_make', $data);
    }

    public function edit_vehicle_make()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'VEHICLE MAKE';
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

            $vehicle_make_id = filter_input(INPUT_POST, 'vehicle_make_id', FILTER_SANITIZE_STRING);
            $make_name = filter_input(INPUT_POST, 'vehiclemakeName', FILTER_SANITIZE_STRING);
            if (isset($vehicle_make_id) && !empty($vehicle_make_id)) {
                $vehicle_make_data = $this->MVehiclemake->get_vehicle_make_data($vehicle_make_id);
                if (isset($vehicle_make_data['data_status']) && !empty($vehicle_make_data['data_status']) && $vehicle_make_data['data_status'] == 1 && isset($vehicle_make_data['data'][0])) {
                    $data['make_data'] = $vehicle_make_data['data'][0];
                    $data['title'] = 'Edit - ' . $make_name;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('vehicle_make/edit_make', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such Vehicle Make. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Vehicle Make is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function save_edit_vehicle_make()
    {
        if ($this->input->is_ajax_request() == 1) {
            $vehicle_make_id = filter_input(INPUT_POST, 'vehicle_make_id', FILTER_SANITIZE_NUMBER_INT);
            $vehicle_make = filter_input(INPUT_POST, 'vehicle_make', FILTER_SANITIZE_STRING);

            $data['sub_title'] = 'Vehicle Make';
            $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);

            $this->form_validation->set_rules('vehicle_make', ' Vehicle Make', 'trim|required|min_length[3]|max_length[50]');


            if ($this->form_validation->run() == TRUE) {
                $save_vehicle_make_data = $this->MVehiclemake->save_vehicle_make_edit($vehicle_make_id, $vehicle_make);

                if (isset($save_vehicle_make_data['data_status']) && !empty($save_vehicle_make_data['data_status']) && $save_vehicle_make_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['vehiclemake_data'] = array(
                        'vehicle_make' => $vehicle_make,
                        'vehicle_make_id' => $vehicle_make_id,
                        'id' => $vehicle_make_id,
                    );
                    //                    dev_export($data);die;
                    $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                    $data['sub_title'] = 'VEHICLE MAKE';
                    if (isset($save_vehicle_make_data['message']) && !empty($save_vehicle_make_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('vehicle_make/edit_make', $data, TRUE), 'message' => $save_vehicle_make_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('vehicle_make/edit_make', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['make_data'] = array(
                    'vehicle_type' => $vehicle_make,
                    'vehicle_make_id' => $vehicle_make_id,
                    'id' => $vehicle_make_id
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('vehicle_make/edit_make', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function change_status_of_vehicle_make()
    {

        if ($this->input->is_ajax_request() == 1) {
            $vehicle_make = filter_input(INPUT_POST, 'make_id', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);

            if (isset($vehicle_make) && !empty($vehicle_make)) {
                $status_report = $this->MVehiclemake->update_status_vehicle_make($vehicle_make, $status);

                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Vehicle Make status updated successfully'));
                    return true;
                } else {
                    if (isset($status_report['message']) && !empty($status_report['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status_report['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating status of Vehicle Make. Please try again later'));
                        return TRUE;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Vehicle Make  is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
