<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicecenter_controller
 *
 * @author chandrajith.edsys
 */
class Servicecenter_controller extends MX_Controller
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
        $this->load->model('Servicecenter_model', 'Mservice');
    }
    public function show_vehicle_servicecenters()
    {


        $data['sub_title'] = 'Service Center';
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
        $vehicle_servicecenter_data = $this->Mservice->get_all_vehicle_servicecenter($inst_id);
        // dev_export($vehicle_servicecenter_data);
        // return;
        if (isset($vehicle_servicecenter_data['data']) && !empty($vehicle_servicecenter_data['data'])) {
            $data['vehicle_servicecenter_data'] = $vehicle_servicecenter_data['data'];
        } else {
            $data['vehicle_servicecenter_data'] = NULL;
        }

        $this->load->view('service_center/show_service_center', $data);
    }
    public function add_servicecenter($lang = '')
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

        $data['sub_title'] = 'SERVICE CENTER';
        $data['title'] = 'NEW SERVICE CENTER';
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


        $this->load->view('service_center/add_service_center', $data);
    }
    public function save_new_servicecenter()
    {
        if ($this->input->is_ajax_request() == 1) {
            $service_center_name = filter_input(INPUT_POST, 'service_center_name', FILTER_SANITIZE_STRING);
            $service_cen_location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
            $serv_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $contact_number = filter_input(INPUT_POST, 'cnum', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'SERVICE CENTER';
            $data['title'] = 'NEW SERVICE CENTER';
            $this->form_validation->set_rules('service_center_name', ' service center name', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('location', 'Location', 'trim|required|min_length[3]|max_length[50]');
            if ($this->form_validation->run() == TRUE) {
                $save_servicecenter_data = $this->Mservice->save_servicecenter_new($service_center_name, $service_cen_location, $serv_email, $contact_number);
                //                dev_export($save_servicecenter_data);die;
                if (isset($save_servicecenter_data['data_status']) && !empty($save_servicecenter_data['data_status']) && $save_servicecenter_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data Created successfully'));
                    return TRUE;
                } else {
                    $data['save_servicecenter_data'] = array(
                        'servicecenter_name' => $service_center_name,
                        'servicecenter_location' => $service_cen_location,
                        'email' => $serv_email,
                        'contact_num' => $contact_number
                    );
                    if (isset($save_servicecenter_data['message']) && !empty($save_servicecenter_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('service_center/add_service_center', $data, TRUE), 'message' => $save_servicecenter_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('service_center/add_service_center', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['save_servicecenter_data'] = array(
                    'servicecenter_name' => $service_center_name,
                    'servicecenter_location' => $service_cen_location,
                    'email' => $serv_email,
                    'contact_num' => $contact_number
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('service_center/add_service_center', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_servicecenter()
    {
        if ($this->input->is_ajax_request() == 1) {
            $center_id = filter_input(INPUT_POST, 'center_id', FILTER_SANITIZE_NUMBER_INT);
            $center_name =  filter_input(INPUT_POST, 'center_name', FILTER_SANITIZE_STRING);

            if (isset($center_id) && !empty($center_id)) {
                $service_center_data = $this->Mservice->select_service_center($center_id);
                // dev_export($service_center_data);
                // return;
                if (isset($service_center_data['data_status']) && !empty($service_center_data['data_status']) && $service_center_data['data_status'] == 1) {
                    $data['edit_data'] = $service_center_data['data'];
                    $data['title'] = 'Edit - ' . $center_name;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('service_center/edit_service_center', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such spareparts found. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Sparepart is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function updatesave_servicecenter()
    {
        if ($this->input->is_ajax_request() == 1) {
            $centerid = filter_input(INPUT_POST, 'service_center_id', FILTER_SANITIZE_NUMBER_INT);
            $centername = filter_input(INPUT_POST, 'service_center_name', FILTER_SANITIZE_STRING);
            $centerlocation = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
            $centeremail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $contactno = filter_input(INPUT_POST, 'cnum', FILTER_SANITIZE_STRING);
            if (isset($centerid) && !empty($centerid)) {
                $sdata = $this->Mservice->save_edit_service_center($centerid, $centername, $centerlocation, $centeremail, $contactno);
                // dev_export($sdata);
                // return;
                if (isset($sdata['data_status']) && $sdata['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Update successfully .'));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Update Failed'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Invalid service center id given'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function changestatus_servicecenter()
    {
        if ($this->input->is_ajax_request() == 1) {
            $centerid = filter_input(INPUT_POST, 'center_id', FILTER_SANITIZE_NUMBER_INT);
            $status =  filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            // dev_export($centerid);
            // return;
            if (isset($centerid) && !empty($centerid)) {
                $data['id'] = $centerid;
                $data['status'] = $status;
                $data['inst_id'] = $this->session->userdata('inst_id');
                $data['flag'] = 0;
                $sdata = $this->Mservice->edit_status_center($data);
                if (isset($sdata['status']) && $sdata['status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Update successfully .'));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Update Failed'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Invalid center id given'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
