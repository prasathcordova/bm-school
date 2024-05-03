<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Store_management_controller
 *
 * @author saranya.kumar
 */
class Store_management_controller extends MX_Controller {

    public function __construct() {
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
        $this->load->model('Store_model', 'MStore');
    }

    public function show_store() {

        $data['sub_title'] = 'STORE MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'store Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Store Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $store_data = $this->MStore->get_all_store_list();
        if ($store_data['error_status'] == 0 && $store_data['data_status'] == 1) {
            $data['store_data'] = $store_data['data'];
            $data['message'] = "";
        } else {
            $data['store_data'] = FALSE;
            $data['message'] = $store_data['message'];
        }


        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['store_data']) && !empty($data['store_data'])) {
                foreach ($data['store_data'] as $store) {
                    $store_level = "";
                    if ($store['ismain'] == 1) {
                        $store_level = '<span class = "label label-warning"> MAIN STORE</span>';
                    } else {

                        $store_level = '<span class = "label label-warning"> SUB STORE</span>';
                    }
                    $store_status = "";
                    if ($store['isactive'] == 1) {
                        $store_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $store['store_id'] . '\',\'' . $store['store_id'] . '\', this)" checked id="" class="js-switch"  /></a>';
                    } else {
                        $store_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $store['store_id'] . '\',\'' . $store['store_id'] . '\', this)" id="" class="js-switch"  /></a>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_store(\'' . $store['store_id'] . '\',\'' . $store['store_name'] . '\',\'' . $store['store_code'] . '\',\'' . $store['phone'] . '\',\'' . $store['email'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $store['store_name'] . '" data-original-title="' . $store['store_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($store['store_name'], $store['store_code'], $store['phone'], $store['email'], $store_level, $store_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return true;
        } else {
            $this->load->view('store/show_store', $data);
        }
    }

    public function add_store() {

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Store Management', 'status' => 0, 'link' => base_url('store/show-store')),
                2 => array('message' => 'Add New Store', 'status' => 1)
            );

            $data['title'] = 'ADD NEW STORE';
            $data['panel_sub_header'] = 'Add New Store';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'publisher');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('store/add_store', $data);
            } else {
                $this->form_validation->set_rules('name', 'Store Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('code', 'Store Code', 'trim|required|min_length[3]|max_length[15]');
                $this->form_validation->set_rules('address1', 'Address1', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('address2', 'Address2', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('address3', 'Address3', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('contact', 'Contact', 'trim|required|min_length[3]|max_length[20]');
                $this->form_validation->set_rules('email', 'E-mail', 'trim|required|min_length[3]|max_length[100]');

                if ($this->form_validation->run() == TRUE) {
                    $data_prep['store_name'] = strtoupper(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
                    $data_prep['store_code'] = strtoupper(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
                    $data_prep['address1'] = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
                    $data_prep['address2'] = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
                    $data_prep['address3'] = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
                    $data_prep['phone'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                    $data_prep['email'] = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
                    $data_prep['ismain'] = strtoupper(filter_input(INPUT_POST, 'radioInline', FILTER_SANITIZE_STRING));
                    $status = $this->MStore->save_store($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['store_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data_prep['store_name'] = strtoupper(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
                        $data_prep['store_code'] = strtoupper(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
                        $data_prep['address1'] = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
                        $data_prep['address2'] = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
                        $data_prep['address3'] = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
                        $data_prep['phone'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                        $data_prep['email'] = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
                        $data_prep['ismain'] = strtoupper(filter_input(INPUT_POST, 'radioInline', FILTER_SANITIZE_STRING));
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('store/add_store', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data_prep['store_name'] = strtoupper(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
                    $data_prep['store_code'] = strtoupper(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
                    $data_prep['address1'] = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
                    $data_prep['address2'] = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
                    $data_prep['address3'] = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
                    $data_prep['phone'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                    $data_prep['email'] = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
                    $data_prep['ismain'] = strtoupper(filter_input(INPUT_POST, 'radioInline', FILTER_SANITIZE_STRING));
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('store/add_store', $data, TRUE)));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_store() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $store_id = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_NUMBER_INT);
            $store_name = strtoupper(filter_input(INPUT_POST, 'store_name', FILTER_SANITIZE_STRING));
            $store_code = strtoupper(filter_input(INPUT_POST, 'store_code', FILTER_SANITIZE_STRING));
            $address1 = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
            $address2 = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
            $address3 = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
            $phone = strtoupper(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
            $email = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
            $ismain = strtoupper(filter_input(INPUT_POST, 'radio-inline', FILTER_SANITIZE_STRING));

            if (isset($store_id) && !empty($store_id)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Store Management', 'status' => 0, 'link' => base_url('store/show-store')),
                    2 => array('message' => 'Edit Store', 'status' => 1)
                );

                $data['title'] = 'EDIT STORE - ' . $store_name;
                $data['panel_sub_header'] = 'Edit Store - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'store');
                $this->session->set_userdata('current_parent', 'gen_sett');

                $store_data_raw = $this->MStore->get_store_details($store_id);
                if (is_array($store_data_raw) && isset($store_data_raw['data_status']) && !empty($store_data_raw['data_status']) && $store_data_raw['data_status'] == 1) {
                    $data['store_data'] = $store_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Store - ' . $data['store_data']['store_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Store / No data associated with this Store', 'data' => ''));
                    return;
                }
                if ($onload == 1) {

                    $view = $this->load->view('store/edit_store', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required|min_length[3]|max_length[30]');
                    $this->form_validation->set_rules('store_code', 'Store Code', 'trim|required|min_length[3]|max_length[15]');
                    $this->form_validation->set_rules('address1', 'Address1', 'trim|required|min_length[3]|max_length[15]');
                    $this->form_validation->set_rules('address2', 'Address2', 'trim|required|min_length[3]|max_length[15]');
                    $this->form_validation->set_rules('address3', 'Address3', 'trim|required|min_length[3]|max_length[15]');
                    $this->form_validation->set_rules('phone', 'Contact', 'trim|required|min_length[3]|max_length[20]');
                    $this->form_validation->set_rules('email', 'E-mail', 'trim|required|min_length[3]|max_length[15]');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['store_id'] = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_NUMBER_INT);
                        $data_prep['store_name'] = strtoupper(filter_input(INPUT_POST, 'store_name', FILTER_SANITIZE_STRING));
                        $data_prep['store_code'] = strtoupper(filter_input(INPUT_POST, 'store_code', FILTER_SANITIZE_STRING));
                        $data_prep['address1'] = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
                        $data_prep['address2'] = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
                        $data_prep['address3'] = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
                        $data_prep['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
                        $data_prep['email'] = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
                        $data_prep['ismain'] = strtoupper(filter_input(INPUT_POST, 'radioInline', FILTER_SANITIZE_STRING));
                        $status = $this->MStore->edit_save_store($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['store_name'] . " Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => ''));
                            return;
                        } else {
                            $data_prep['store_id'] = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_NUMBER_INT);
                            $data_prep['store_name'] = strtoupper(filter_input(INPUT_POST, 'store_name', FILTER_SANITIZE_STRING));
                            $data_prep['store_code'] = strtoupper(filter_input(INPUT_POST, 'store_code', FILTER_SANITIZE_STRING));
                            $data_prep['address1'] = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
                            $data_prep['address2'] = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
                            $data_prep['address3'] = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
                            $data_prep['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
                            $data_prep['email'] = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
                            $data_prep['ismain'] = strtoupper(filter_input(INPUT_POST, 'radioInline', FILTER_SANITIZE_STRING));
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('store/edit_store', $data, TRUE), 'message' => $status['message']));
                            return;
                        }
                    } else {
                        $data_prep['store_id'] = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_NUMBER_INT);
                        $data_prep['store_name'] = strtoupper(filter_input(INPUT_POST, 'store_name', FILTER_SANITIZE_STRING));
                        $data_prep['store_code'] = strtoupper(filter_input(INPUT_POST, 'store_code', FILTER_SANITIZE_STRING));
                        $data_prep['address1'] = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
                        $data_prep['address2'] = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
                        $data_prep['address3'] = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
                        $data_prep['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
                        $data_prep['email'] = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
                        $data_prep['ismain'] = strtoupper(filter_input(INPUT_POST, 'radioInline', FILTER_SANITIZE_STRING));
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('store/edit_store', $data, TRUE), 'message' => 'Validation Error'));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Publisher ID is provided / Invalid Publisher', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    
    
    
     public function update_status() {
        if ($this->input->is_ajax_request() == 1) {
            $store_id = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($store_id) && !empty($store_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                 $data_prep['store_id'] = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_STRING);
                $status = $this->MStore->edit_status_store($data_prep);
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

}
