<?php

/**
 * Description of Fee_type_controller
 *
 * @author chandrajith.edsys
 * @modified by Aju S Aravind
 */
class Fee_type_controller extends MX_Controller {

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
        $this->load->model('Fee_type_model', 'MFeetype');
    }

    public function show_fee_type() {
        $data['sub_title'] = 'FEE TYPE';       
        $inst_id = $this->session->userdata('inst_id');
        $fee_type_data = $this->MFeetype->get_all_fee_type_data($inst_id);

        if (isset($fee_type_data['data']) && !empty($fee_type_data['data'])) {
            $data['fee_type_data'] = $fee_type_data['data'];
        } else {
            $data['fee_type_data'] = NULL;
        }

        $this->load->view('fee_type/show_fee_type', $data);
    }

    public function add_fee_type() {


        $data['sub_title'] = 'FEE TYPE';
        $data['title'] = 'ADD NEW FEE TYPE';
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


        $this->load->view('fee_type/add_fee_type', $data);
    }

    public function edit_fee_type() {

        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'FEE TYPE';
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

            $fee_type_id = filter_input(INPUT_POST, 'fee_type_id', FILTER_SANITIZE_STRING);
            $type_name = filter_input(INPUT_POST, 'type_name', FILTER_SANITIZE_STRING);

            if (isset($fee_type_id) && !empty($fee_type_id)) {
                $fee_type_data = $this->MFeetype->get_fee_type_data($fee_type_id);
                if (isset($fee_type_data['data_status']) && !empty($fee_type_data['data_status']) && $fee_type_data['data_status'] == 1 && isset($fee_type_data['data'][0])) {
                    $data['feeTypeName'] = $fee_type_data['data'][0]['feeTypeName'];
                    $data['title'] = 'Edit - ' . $type_name;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_type/edit_fee_type', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such fee type. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Fee type not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function change_status_of_fee_type() {
        if ($this->input->is_ajax_request() == 1) {
            $fee_type_id = filter_input(INPUT_POST, 'fee_type_id', FILTER_SANITIZE_NUMBER_INT);
            $inst_id = $this->session->userdata('inst_id');
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            if (isset($fee_type_id) && !empty($fee_type_id)) {
                $status_report = $this->MFeetype->update_status_fee_type($fee_type_id, $inst_id, $status);

                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Fee type status updated successfully'));
                    return true;
                } else {
                    if (isset($status_report['message']) && !empty($status_report['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status_report['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating status of fee type. Please try again later'));
                        return TRUE;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Fee type is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_new_fee_type() {
        if ($this->input->is_ajax_request() == 1) {
            $code = filter_input(INPUT_POST, 'fee_type_name', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'FEE TYPE';
            $data['title'] = 'ADD NEW FEE TYPE';

            $this->form_validation->set_rules('fee_type_name', 'Fee Type Name', 'trim|required|min_length[2]|max_length[20]');

            if ($this->form_validation->run() == TRUE) {
                $save_fee_type_data = $this->MFeetype->save_fee_type_new($code);
                if (isset($save_fee_type_data['data_status']) && !empty($save_fee_type_data['data_status']) && $save_fee_type_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['fee_type_name'] = $code;
                    if (isset($save_fee_type_data['message']) && !empty($save_fee_type_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('fee_type/add_fee_type', $data, TRUE), 'message' => $save_fee_type_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('fee_type/add_fee_type', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['fee_type_name'] = $code;
                echo json_encode(array('status' => 3, 'view' => $this->load->view('fee_type/add_fee_type', $data, TRUE), 'message' => 'Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_edit_fee_type() {
        if ($this->input->is_ajax_request() == 1) {
            $fee_type_id = filter_input(INPUT_POST, 'fee_type_id', FILTER_SANITIZE_NUMBER_INT);
            $feeTypeName = filter_input(INPUT_POST, 'feeTypeName', FILTER_SANITIZE_STRING);

            $data['sub_title'] = 'FEE TYPE';
            $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);

            $this->form_validation->set_rules('feeTypeName', ' Fee Type', 'trim|required|min_length[2]|max_length[20]');
            $this->form_validation->set_rules('fee_type_id', ' Fee type ID', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $save_fee_type_data = $this->MFeetype->save_fee_type_edit($fee_type_id, $feeTypeName);
                if (isset($save_fee_type_data['data_status']) && !empty($save_fee_type_data['data_status']) && $save_fee_type_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['feeTypeName'] = $feeTypeName;
                    $data['fee_type_id'] = $fee_type_id;

                    $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                    $data['sub_title'] = 'FEE TYPE';
                    if (isset($save_fee_type_data['message']) && !empty($save_fee_type_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('fee_type/edit_fee_type', $data, TRUE), 'message' => $save_fee_type_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('fee_type/edit_fee_type', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['feeTypeName'] = $feeTypeName;
                $data['fee_type_id'] = $fee_type_id;

                $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                $data['sub_title'] = 'FEE TYPE';
                echo json_encode(array('status' => 3, 'view' => $this->load->view('fee_type/edit_fee_type', $data, TRUE), 'message' => 'Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

}
