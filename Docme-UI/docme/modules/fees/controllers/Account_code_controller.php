<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Account_code_controller
 *
 * @author chandrajith.edsys
 */
class Account_code_controller extends MX_Controller {

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
        $this->load->model('Account_code_model', 'MAccountCode');
    }

    public function show_account_code() {
        $data['sub_title'] = 'Account Code';
       
        $inst_id = $this->session->userdata('inst_id');
        $account_code_data = $this->MAccountCode->get_all_account_code_data($inst_id);
//        dev_export($account_code_data);die;
        if (isset($account_code_data['data']) && !empty($account_code_data['data'])) {
            $data['account_code_data'] = $account_code_data['data'];
        } else {
            $data['account_code_data'] = NULL;
        }
        $this->load->view('account_code/show_account_code', $data);
    }

    public function change_status_of_account_code() {
        if ($this->input->is_ajax_request() == 1) {
            $account_code = filter_input(INPUT_POST, 'account_id', FILTER_SANITIZE_NUMBER_INT); 
            $inst_id = $this->session->userdata('inst_id');
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            if (isset($account_code) && !empty($account_code)) {
                $status_report = $this->MAccountCode->update_status_account_code($account_code, $status, $inst_id);

                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Account status updated successfully'));
                    return true;
                } else {
                    if (isset($status_report['message']) && !empty($status_report['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status_report['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating status of account code. Please try again later'));
                        return TRUE;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Account code is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function add_account_code($lang = '') {

//        $this->lang->load('content', $lang == '' ? 'en' : $lang);
//        $this->lang->load('content', 'ar');
//        dev_export($this->lang->line('Account Code'));
//        $data['account_code'] = $this->lang->line('Account Code');
//        $data['account_code'] =$this->lang->line('Account Code');
//        $data['message']=$this->lang->line('message');
//        dev_export($data['account_code']);die;
//        $data['description'] = $this->lang->line('Description');
//        $data['name']=$this->lang->line('name');

        $data['sub_title'] = 'ACCOUNT CODE';
        $data['title'] = 'NEW ACCOUNT CODE';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Fees Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Fees Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');


        $this->load->view('account_code/add_account_code', $data);
    }

    public function edit_account_code() {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'ACCOUNT CODE';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'),
                '1' => array(
                    'title' => 'Fees Settings',
                    'link' => base_url()),
                '2' => array(
                    'title' => 'Fees Management')
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $data['user_name'] = $this->session->userdata('user_name');

            $account_code_id = filter_input(INPUT_POST, 'account_code_id', FILTER_SANITIZE_STRING);
            $code_name = filter_input(INPUT_POST, 'code_name', FILTER_SANITIZE_STRING);

            if (isset($account_code_id) && !empty($account_code_id)) {
                $account_code_data = $this->MAccountCode->get_account_code_data($account_code_id);
                if (isset($account_code_data['data_status']) && !empty($account_code_data['data_status']) && $account_code_data['data_status'] == 1 && isset($account_code_data['data'][0])) {
                    $data['account_data'] = $account_code_data['data'][0];
                    $data['title'] = 'Edit - ' . $code_name;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('account_code/edit_account_code', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such account code. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Account code is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_new_account_code() {
        if ($this->input->is_ajax_request() == 1) {
            $code = filter_input(INPUT_POST, 'account_code1', FILTER_SANITIZE_STRING);
            $desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'ACCOUNT CODE';
            $data['title'] = 'NEW ACCOUNT CODE';

            $this->form_validation->set_rules('account_code1', ' Account Code', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('description', ' Description', 'trim|required|min_length[3]|max_length[100]');
            if ($this->form_validation->run() == TRUE) {
                $save_account_code_data = $this->MAccountCode->save_account_code_new($code, $desc);
                if (isset($save_account_code_data['data_status']) && !empty($save_account_code_data['data_status']) && $save_account_code_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['account_data'] = array(
                        'account_code1' => $code,
                        'description' => $desc  
                    );
                    if (isset($save_account_code_data['message']) && !empty($save_account_code_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('account_code/add_account_code', $data, TRUE), 'message' => $save_account_code_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('account_code/add_account_code', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['account_data'] = array(
                    'account_code1' => $code,
                    'description' => $desc                  
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('account_code/add_account_code', $data, TRUE), 'message' => 'Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_edit_account_code() {
        if ($this->input->is_ajax_request() == 1) {
            $account_code_id = filter_input(INPUT_POST, 'account_code_id', FILTER_SANITIZE_NUMBER_INT);
            $code = filter_input(INPUT_POST, 'account_code', FILTER_SANITIZE_STRING);
            $desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $data['sub_title'] = 'Account Code';
            $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);

            $this->form_validation->set_rules('account_code', ' Account Code', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('description', ' Description', 'trim|required|min_length[3]|max_length[100]');

            if ($this->form_validation->run() == TRUE) {
                $save_account_code_data = $this->MAccountCode->save_account_code_edit($account_code_id, $code, $desc);
                if (isset($save_account_code_data['data_status']) && !empty($save_account_code_data['data_status']) && $save_account_code_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['account_data'] = array(
                        'accountCode' => $code,
                        'accountDescription' => $desc,
                        'account_code_id' => $account_code_id,
                        'id' => $account_code_id,                         
                    );
//                    dev_export($data);die;
                    $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                    $data['sub_title'] = 'ACCOUNT CODE';
                    if (isset($save_account_code_data['message']) && !empty($save_account_code_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('account_code/edit_account_code', $data, TRUE), 'message' => $save_account_code_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('account_code/edit_account_code', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['account_data'] = array(
                    'account_code' => $code,
                    'description' => $desc,
                    'account_code_id' => $account_code_id,
                    'id' => $account_code_id
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('account_code/edit_account_code', $data, TRUE), 'message' => 'Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

}
