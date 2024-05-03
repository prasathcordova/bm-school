<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicetype_controller
 *
 * @author Chandrajith
 */
class Servicetype_controller extends MX_Controller
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
        $this->load->model('Servicetype_model', 'Mservicetype');
    }
    public function show_vehicle_servicetype()
    {


        $data['sub_title'] = 'Service Type';
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
        $vehicle_servicetype_data = $this->Mservicetype->get_all_vehicle_servicetype($inst_id);
        // dev_export($vehicle_servicetype_data);
        // return;
        if (isset($vehicle_servicetype_data['data']) && !empty($vehicle_servicetype_data['data'])) {
            $data['vehicle_servicetype_data'] = $vehicle_servicetype_data['data'];
        } else {
            $data['vehicle_servicetype_data'] = NULL;
        }

        $this->load->view('service_type/show_service_type', $data);
    }
    public function add_servicetype($lang = '')
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

        $data['sub_title'] = 'SERVICE TYPE';
        $data['title'] = 'NEW SERVICE TYPE';
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


        $this->load->view('service_type/add_service_type', $data);
    }
    public function save_new_servicetype()
    {
        if ($this->input->is_ajax_request() == 1) {
            $service_type = filter_input(INPUT_POST, 'service_type', FILTER_SANITIZE_STRING);

            $data['sub_title'] = 'SERVICE TYPE';
            $data['title'] = 'NEW SERVICE TYPE';
            $this->form_validation->set_rules('service_type', ' service type', 'trim|required|min_length[3]|max_length[50]');

            if ($this->form_validation->run() == TRUE) {
                //                dev_export($service_type);die;
                $save_servicecenter_data = $this->Mservicetype->save_servicetype_new($service_type);

                if (isset($save_servicecenter_data['data_status']) && !empty($save_servicecenter_data['data_status']) && $save_servicecenter_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data Created successfully'));
                    return TRUE;
                } else {
                    $data['save_servicetype_data'] = array(
                        'servicetype' => $service_type
                    );
                    if (isset($save_servicecenter_data['message']) && !empty($save_servicecenter_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('service_type/add_service_type', $data, TRUE), 'message' => $save_servicecenter_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('service_type/add_service_type', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['save_servicetype_data'] = array(
                    'servicetype' => $service_type
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('service_type/add_service_type', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_servicetype()
    {
        if ($this->input->is_ajax_request() == 1) {
            $type_id = filter_input(INPUT_POST, 'service_type_id', FILTER_SANITIZE_NUMBER_INT);
            $type_name =  filter_input(INPUT_POST, 'type_name', FILTER_SANITIZE_STRING);

            if (isset($type_id) && !empty($type_id)) {
                $select_sparepart_data = $this->Mservicetype->select_service_type($type_id);
                // dev_export($select_sparepart_data);
                // return;
                if (isset($select_sparepart_data['data_status']) && !empty($select_sparepart_data['data_status']) && $select_sparepart_data['data_status'] == 1) {
                    $data['edit_data'] = $select_sparepart_data['data'];
                    $data['title'] = 'Edit - ' . $type_name;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('service_type/edit_service_type', $data, TRUE)));
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

    public function edit_save_servicetype()
    {
        if ($this->input->is_ajax_request() == 1) {
            $typeid = filter_input(INPUT_POST, 'service_type_id', FILTER_SANITIZE_NUMBER_INT);
            $typename = filter_input(INPUT_POST, 'service_type', FILTER_SANITIZE_STRING);
            // dev_export($typeid);
            // return;
            if (isset($typeid) && !empty($typeid)) {
                $sdata = $this->Mservicetype->save_edit_service_type($typeid, $typename);
                if (isset($sdata['data_status']) && $sdata['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Update successfully .'));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Update Failed'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Invalid spart id given'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function changestatus_servicetype()
    {
        if ($this->input->is_ajax_request() == 1) {
            $typeid = filter_input(INPUT_POST, 'type_id', FILTER_SANITIZE_NUMBER_INT);
            $status =  filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            // dev_export($centerid);
            // return;
            if (isset($typeid) && !empty($typeid)) {
                $data['id'] = $typeid;
                $data['status'] = $status;
                $data['inst_id'] = $this->session->userdata('inst_id');
                $data['flag'] = 0;
                $sdata = $this->Mservicetype->edit_status_type($data);
                if (isset($sdata['status']) && $sdata['status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Update successfully .'));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Update Failed'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Invalid Service type id given'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
