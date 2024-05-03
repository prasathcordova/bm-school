<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OH_management_controller
 *
 * @author chandrajith
 */
class Oh_management_controller extends MX_Controller {

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
        $this->load->model('OH_management_model', 'Ohmodel');
    }

    public function add_temp_openhouse() {


        $data['sub_title'] = 'OPEN HOUSE - ADD NEW TEMPLATE';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Student Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'purchase return')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);


        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        if ($onload == 1) {
            $oh_data = $this->Ohmodel->get_all_oh_list();

            if ($oh_data['error_status'] == 0 && $oh_data['status'] == 1) {
                $data['oh_data'] = $oh_data['data'];
                $data['message'] = "";
            } else {
                $data['oh_data'] = FALSE;
                $data['message'] = $oh_data['message'];
            }

            $open_house_master = $this->Ohmodel->get_openhouse_master($id);
            if ($open_house_master['error_status'] == 0 && $open_house_master['status'] == 1) {
                $data['master_data'] = $open_house_master['data'][0];
                $data['message'] = "";
            } else {
                $data['master_data'] = FALSE;
                $data['message'] = $open_house_master['message'];
            }

            $open_house_detail = $this->Ohmodel->get_openhouse_detail($id);

            if ($open_house_detail['error_status'] == 0 && $open_house_detail['status'] == 1) {
                $data['detail_data'] = $open_house_detail['data'];
                $data['message'] = "";
            } else {
                $data['detail_data'] = FALSE;
                $data['message'] = $open_house_detail['message'];
            }

            $this->load->view('ohtemplate/add_new_temp_openhouse', $data);
        } else {

            $master_id = strtoupper(filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_NUMBER_INT));
            $formatted_template_id = (filter_input(INPUT_POST, 'formatted_template_id'));
            $status = $this->Ohmodel->add_new_template_openhouse($master_id, $formatted_template_id);

            if (is_array($status) && $status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'view' => ''));
                return;
            } else {
                echo json_encode(array('status' => 2, 'view' => $this->load->view('ohtemplate/list_openhouse'), 'message' => $status['message']));
                return;
            }
        }
    }

    public function list_openhouse() {

//        $data['template'] = 'ohtemplate/oh_template';
//        $data['title'] = 'OH TEMPLATE';
        $data['sub_title'] = 'OPEN HOUSE';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Student Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'purchase return')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $openh_data = $this->Ohmodel->get_all_openhouse_list();
//        dev_export($oh_data);die;
        if ($openh_data['error_status'] == 0 && $openh_data['status'] == 1) {
            $data['oh_data'] = $openh_data['data'];
            $data['message'] = "";
        } else {
            $data['oh_data'] = FALSE;
            $data['message'] = $openh_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        $this->load->view('ohtemplate/list_openhouse', $data);
    }

    public function show_openhouse() {

//        $data['template'] = 'ohtemplate/oh_template';
//        $data['title'] = 'OH TEMPLATE';
        $data['sub_title'] = 'OPEN HOUSE';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Student Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'purchase return')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $oh_data = $this->Ohmodel->get_all_oh_list();
//        dev_export($oh_data);die;
        if ($oh_data['error_status'] == 0 && $oh_data['status'] == 1) {
            $data['oh_data'] = $oh_data['data'];
            $data['message'] = "";
        } else {
            $data['oh_data'] = FALSE;
            $data['message'] = $oh_data['message'];
        }
        $isdiscount = $this->Ohmodel->get_openhouse_isdiscount();
        if ($isdiscount['error_status'] == 0 && $isdiscount['data_status'] == 1) {
            $data['is_discount'] = $isdiscount['data'][0]['Code_Value'];
            $data['message'] = "";
        } else {
            $data['is_discount'] = FALSE;
            $data['message'] = $isdiscount['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        $this->load->view('ohtemplate/openhouse', $data);
    }

    public function edit_openhouse() {

//        $data['title'] = 'OH TEMPLATE';
        $data['sub_title'] = 'OPEN HOUSE EDIT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Student Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'purchase return')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);


        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
//        dev_export($onload);die;
        if ($onload == 1) {
            $oh_data = $this->Ohmodel->get_all_oh_list();

            if ($oh_data['error_status'] == 0 && $oh_data['status'] == 1) {
                $data['oh_data'] = $oh_data['data'];
                $data['message'] = "";
            } else {
                $data['oh_data'] = FALSE;
                $data['message'] = $oh_data['message'];
            }
            $isdiscount = $this->Ohmodel->get_openhouse_isdiscount();
            if ($isdiscount['error_status'] == 0 && $isdiscount['data_status'] == 1) {
                $data['is_discount'] = $isdiscount['data'][0]['Code_Value'];
                $data['message'] = "";
            } else {
                $data['is_discount'] = FALSE;
                $data['message'] = $isdiscount['message'];
            }

            $open_house_master = $this->Ohmodel->get_openhouse_master($id);
            if ($open_house_master['error_status'] == 0 && $open_house_master['status'] == 1) {
                $data['master_data'] = $open_house_master['data'][0];
                $data['message'] = "";
            } else {
                $data['master_data'] = FALSE;
                $data['message'] = $open_house_master['message'];
            }

            $open_house_detail = $this->Ohmodel->get_openhouse_detail($id);
//            dev_export($id);die;
//            dev_export($open_house_detail);die;
            if ($open_house_detail['error_status'] == 0 && $open_house_detail['status'] == 1) {
                $data['detail_data'] = $open_house_detail['data'];
                $data['message'] = "";
            } else {
                $data['detail_data'] = FALSE;
                $data['message'] = $open_house_detail['message'];
            }

            $this->load->view('ohtemplate/edit_openhouse', $data);
        } else {

            $this->form_validation->set_rules('no_temp_st', 'no_temp_st', 'trim|required|min_length[1]|max_length[3]');
            if ($this->form_validation->run() == TRUE) {
                $master_id = strtoupper(filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_NUMBER_INT));
                $discount = strtoupper(filter_input(INPUT_POST, 'discount', FILTER_SANITIZE_NUMBER_INT));
                $no_temp_st = strtoupper(filter_input(INPUT_POST, 'no_temp_st', FILTER_SANITIZE_NUMBER_INT));
                $description = strtoupper(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
                $formatted_template_id = (filter_input(INPUT_POST, 'formatted_template_id'));
                $start_date = strtoupper(filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING));
                $end_date = strtoupper(filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING));



                $status = $this->Ohmodel->edit_openhouse($master_id, $start_date, $end_date, $no_temp_st, $description, $formatted_template_id, $discount);

                if (is_array($status) && $status['data_status'] == 1) {

                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else if (is_array($status) && $status['data_status'] == 2) {
                    echo json_encode(array('status' => 2, 'message' => $status['message']));
                    return;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error occurred while saving please try again later or contact administrator with error code : OHPRD0001'));
                    return;
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'An error occurred in validation .Please check and try again..!!'));
                return;
            }
        }
    }

    public function view_openhouse() {

//        $data['title'] = 'OH TEMPLATE';
        $data['sub_title'] = 'OPEN HOUSE VIEW';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Student Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'purchase return')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);


        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
//        dev_export($onload);die;
        if ($onload == 1) {
            $oh_data = $this->Ohmodel->get_all_oh_list();

            if ($oh_data['error_status'] == 0 && $oh_data['status'] == 1) {
                $data['oh_data'] = $oh_data['data'];
                $data['message'] = "";
            } else {
                $data['oh_data'] = FALSE;
                $data['message'] = $oh_data['message'];
            }

            $open_house_master = $this->Ohmodel->get_openhouse_master($id);
            if ($open_house_master['error_status'] == 0 && $open_house_master['status'] == 1) {
                $data['master_data'] = $open_house_master['data'][0];
                $data['message'] = "";
            } else {
                $data['master_data'] = FALSE;
                $data['message'] = $open_house_master['message'];
            }

            $open_house_detail = $this->Ohmodel->get_openhouse_detail($id);
//            dev_export($id);die;
//            dev_export($open_house_detail);die;
            if ($open_house_detail['error_status'] == 0 && $open_house_detail['status'] == 1) {
                $data['detail_data'] = $open_house_detail['data'];
                $data['message'] = "";
            } else {
                $data['detail_data'] = FALSE;
                $data['message'] = $open_house_detail['message'];
            }

            $this->load->view('ohtemplate/view_openhouse', $data);
        } else {

            $this->form_validation->set_rules('no_temp_st', 'no_temp_st', 'trim|required|min_length[1]|max_length[3]');
            if ($this->form_validation->run() == TRUE) {
                $master_id = strtoupper(filter_input(INPUT_POST, 'master_id', FILTER_SANITIZE_NUMBER_INT));
                $no_temp_st = strtoupper(filter_input(INPUT_POST, 'no_temp_st', FILTER_SANITIZE_NUMBER_INT));
                $description = strtoupper(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
                $formatted_template_id = (filter_input(INPUT_POST, 'formatted_template_id'));
                $start_date = strtoupper(filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING));
                $end_date = strtoupper(filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING));



                $status = $this->Ohmodel->edit_openhouse($master_id, $start_date, $end_date, $no_temp_st, $description, $formatted_template_id);
//                                dev_export($status);die;
                if (is_array($status) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    echo json_encode(array('status' => 2, 'view' => $this->load->view('ohtemplate/list_openhouse'), 'message' => $status['message']));
                    return;
                }
            } else {
                echo json_encode(array('status' => 2, 'view' => $this->load->view('ohtemplate/list_openhouse'), 'message' => 'Validation Error '));
                return;
            }
        }
    }

    public function delete_openhouse() {
//        dev_export("hi");die;
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $status = $this->Ohmodel->delete_openhouse($id);
//        dev_export($status['message']);die;
        if (is_array($status) && $status['data_status'] == 1) {
            echo json_encode(array('status' => 1, 'view' => ''));
            return;
        } else {
//            dev_export('123');die;
            echo json_encode(array('status' => 2, 'view' => $this->load->view('ohtemplate/list_openhouse'), 'message' => $status['message']));
            return;
        }
    }

    public function save_openhouse() {

        $this->form_validation->set_rules('no_temp_st', 'no_temp_st', 'trim|required|min_length[1]|max_length[3]');
        if ($this->form_validation->run() == TRUE) {
            $no_temp_st = strtoupper(filter_input(INPUT_POST, 'no_temp_st', FILTER_SANITIZE_NUMBER_INT));
            $discount = strtoupper(filter_input(INPUT_POST, 'discount', FILTER_SANITIZE_NUMBER_INT));
            $description = strtoupper(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
            $formatted_template_id = (filter_input(INPUT_POST, 'formatted_template_id'));
            $start_date = strtoupper(filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING));
            $end_date = strtoupper(filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING));

            $status = $this->Ohmodel->save_openhouse($start_date, $end_date, $no_temp_st, $description, $formatted_template_id, $discount);

            if (is_array($status) && $status['data_status'] == 1) {

                echo json_encode(array('status' => 1, 'view' => ''));
                return;
            } else if (is_array($status) && $status['data_status'] == 2) {

                echo json_encode(array('status' => 2, 'message' => $status['message']));
                return;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'An error occurred while saving please try again later or contact administrator with error code : OHPRD0001'));
                return;
            }
        } else {
            echo json_encode(array('status' => 2, 'message' => 'An error occurred in validation .Please check and try again..!!'));
            return;
        }
    }

    public function oh_template() {

//        $data['template'] = 'ohtemplate/oh_template';
//        $data['title'] = 'OH TEMPLATE';
        $data['sub_title'] = 'OH TEMPLATE';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Student Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'purchase return')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $oh_data = $this->Ohmodel->get_all_oh_list();
//        dev_export($oh_data);die;
        if ($oh_data['error_status'] == 0 && $oh_data['status'] == 1) {
            $data['oh_data'] = $oh_data['data'];
            $data['message'] = "";
        } else {
            $data['oh_data'] = FALSE;
            $data['message'] = $oh_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        $this->load->view('ohtemplate/oh_template', $data);
    }

    //end Rahul

    /* Author Rahul */
    public function add_ohtemplate() {

        $data['title'] = 'CREATE NEW TEMPLATE';
        $data['sub_title'] = 'OH Template ';
        $data['user_name'] = $this->session->userdata('user_name');
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $oh_name = strtoupper(filter_input(INPUT_POST, 'oh_name', FILTER_SANITIZE_STRING));
        $oh_description = strtoupper(filter_input(INPUT_POST, 'oh_description', FILTER_SANITIZE_STRING));

        $this->session->set_userdata('current_page', 'publisher');
        $this->session->set_userdata('current_parent', 'store_sett');

        if ($onload == 1) {
            $this->load->view('ohtemplate/oh-templateadd', $data);
        } else {
            $status = $this->Ohmodel->save_ohtemplate($oh_name, $oh_description);
//            dev_export($status);die;
            if (is_array($status) && $status['data_status'] == 1) {
//                $this->session->set_flashdata('success_message', "Oh Template". $oh_name . " saved successfully");
                echo json_encode(array('status' => 1, 'view' => ''));
                return;
            } else {
//                $this->session->set_flashdata('error_message', $status['message']);
                echo json_encode(array('status' => 2, 'view' => $this->load->view('ohtemplate/oh-templateadd', $data, TRUE), 'message' => $status['message']));
                return;
            }
        }
    }

    public function edit_ohtemplate() {

//        dev_export('fgsd');die;
        $data['user_name'] = $this->session->userdata('user_name');
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $oh_name = strtoupper(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
        $oh_description = strtoupper(filter_input(INPUT_POST, 'oh_description', FILTER_SANITIZE_STRING));

//        dev_export($onload);die;
        $data['title'] = 'EDIT OH TEMPLATE - ' . $oh_name;
        $data['sub_title'] = 'OH Template ';
        $this->session->set_userdata('current_page', 'publisher');
        $this->session->set_userdata('current_parent', 'store_sett');

        if ($onload == 1) {
            $oh_data = $this->Ohmodel->get_oh_list_edit($id);
//        dev_export($oh_data);die;
            if ($oh_data['error_status'] == 0 && $oh_data['status'] == 1) {
                $data['oh_data'] = $oh_data['data'][0];
                $data['message'] = "";
            } else {
                $data['oh_data'] = FALSE;
                $data['message'] = $oh_data['message'];
            }
//        dev_export($data);die;

            $this->load->view('ohtemplate/oh-templateedit', $data);
        } else {
            $status = $this->Ohmodel->edit_ohtemplate($id, $oh_name, $oh_description);

            if (is_array($status) && $status['data_status'] == 1) {

                echo json_encode(array('status' => 1, 'view' => ''));
                return;
            } else {
                echo json_encode(array('status' => 2, 'view' => $this->load->view('ohtemplate/oh-templateadd', $data, TRUE), 'message' => $status['message']));
                return;
            }
        }
    }

    public function list_ohtemplate() {
        $data['sub_title'] = 'Open House';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('ohtemplate/newohtemplate', $data);
    }

    public function create_ohtemplate() {
        $data['sub_title'] = 'Open House';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('ohtemplate/addnewohtemplate', $data);
    }

}
