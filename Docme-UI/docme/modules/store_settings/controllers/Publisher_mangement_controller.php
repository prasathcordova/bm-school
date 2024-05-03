<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publisher_mangement_controller
 *
 * @author docme2
 */
class Publisher_mangement_controller extends MX_Controller{
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
        $this->load->model('Publisher_model', 'MPublisher');
    }
    
    public function show_publisher() {
        
//        $data['template'] = 'publisher/show_publisher';
//        $data['title'] = 'BOOKSTORE SETTINGS';
        $data['sub_title'] = 'PUBLISHER MANAGEMENT';
       $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Bookstore Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Publisher Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
               
         $publisher_data = $this->MPublisher->get_all_publisher_list();
//         dev_export($publisher_data);die;
        if ($publisher_data['error_status'] == 0 && $publisher_data['data_status'] == 1) {
            $data['publisher_data'] = $publisher_data['data'];
            $data['message'] = "";
        } else {
         
            $data['publisher_data'] = FALSE;
            $data['message'] = $publisher_data['message'];
        }


        $this->session->set_userdata('current_page', 'publisher');
        $this->session->set_userdata('current_parent', 'store_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
//            dev_export($data['publisher_data']);die;
            if (isset($data['publisher_data']) && !empty($data['publisher_data'])) {
                foreach ($data['publisher_data'] as $publisher) {
                    $publisher_status = "";
                    if ($publisher['isactive'] == 1) {
                        $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['pub_id'] . '\',\'' . $publisher['pub_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" checked id="" class="js-switch"  />';
                    } else {
                        $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['pub_id'] . '\',\'' . $publisher['pub_name'] . '\', this)" id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" id="" class="js-switch"  />';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_publisher(\'' . $publisher['pub_id'] . '\',\'' . $publisher['pub_name'] . '\',\'' . $publisher['pub_address1'] . '\',\'' . $publisher['pub_address2'] . '\',\'' . $publisher['pub_address3'] . '\',,\'' . $publisher['pub_contact'] . '\',,\'' . $publisher['pub_email'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $publisher['pub_name'] . '" data-original-title="' . $publisher['pub_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($publisher['pub_name'],$publisher['pub_code'],$publisher['pub_contact'],$publisher['pub_email'], $publisher_status, $task_html);
                }
            }
//            dev_export($formatted_data);die;
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('publisher/show_publisher', $data);
        }
    }
    
    public function add_publisher() {
                
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
//            dev_export($onload);die;
//            echo 'asdas';die;
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Publisher Management', 'status' => 0, 'link' => base_url('publisher/show-publisher')),
                2 => array('message' => 'Add New Publisher', 'status' => 1)
            );
          
            $data['title'] = 'ADD NEW PUBLISHER';
            $data['panel_sub_header'] = 'Add New Publisher';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'publisher');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('publisher/add_publisher', $data);
            } else {
//echo'sdasd';die;
                $this->form_validation->set_rules('name', 'Publisher Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('code', 'Code', 'trim|required|min_length[3]|max_length[15]');
                $this->form_validation->set_rules('address1', 'Address1', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('address2', 'Address', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('address3', 'Address3', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('contact', 'Contact', 'trim|required|min_length[3]|max_length[20]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[100]');
                 
                if ($this->form_validation->run() == TRUE) {
//                    echo 'safasdfa';die;
                    $data_prep['pub_name'] = strtoupper(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
                    $data_prep['pub_code'] = strtoupper(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
                    $data_prep['pub_address1'] = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
                    $data_prep['pub_address2'] = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
                    $data_prep['pub_address3'] = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
                    $data_prep['pub_contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                    $data_prep['pub_email'] = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
//                    dev_export($data_prep);die;
                    $status = $this->MPublisher->save_publisher($data_prep);
//                    dev_export($status);die;
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['pub_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['pub_name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                        $data['pub_code'] = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
                        $data['pub_address1'] = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
                        $data['pub_address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
                        $data['pub_address3'] = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
                        $data['pub_contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                        $data['pub_email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('publisher/add_publisher', $data, TRUE),'message'=> $status['message']));
                        return;
                    }
                } else {
                    $data['pub_name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                    $data['pub_code'] = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
                    $data['pub_address1'] = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
                    $data['pub_address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
                    $data['pub_contact'] = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
                    $data['pub_contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                    $data['pub_email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('publisher/add_publisher', $data, TRUE)));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    
     public function edit_publisher() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $pub_id = filter_input(INPUT_POST, 'pub_id', FILTER_SANITIZE_NUMBER_INT);
            $pub_name = strtoupper(filter_input(INPUT_POST, 'pub_name', FILTER_SANITIZE_STRING));
            $pub_code = strtoupper(filter_input(INPUT_POST, 'pub_code', FILTER_SANITIZE_STRING));
            $pub_address1 = strtoupper(filter_input(INPUT_POST, 'pub_address1', FILTER_SANITIZE_STRING));
            $pub_address2 = strtoupper(filter_input(INPUT_POST, 'pub_address2', FILTER_SANITIZE_STRING));
            $pub_address3 = strtoupper(filter_input(INPUT_POST, 'pub_address3', FILTER_SANITIZE_STRING));
            $pub_contact = strtoupper(filter_input(INPUT_POST, 'pub_contact', FILTER_SANITIZE_STRING));
            $pub_email = strtoupper(filter_input(INPUT_POST, 'pub_email', FILTER_SANITIZE_STRING));
           
            if (isset($pub_id) && !empty($pub_id)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Publisher Management', 'status' => 0, 'link' => base_url('publisher/show-publisher')),
                    2 => array('message' => 'Edit Publisher', 'status' => 1)
                );
                
                $data['title'] = 'EDIT PUBLISHER - ' . $pub_name;
                $data['panel_sub_header'] = 'Edit Publisher - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'publisher');
                $this->session->set_userdata('current_parent', 'gen_sett');

                $publisher_data_raw = $this->MPublisher->get_publisher_details($pub_id);
                if (is_array($publisher_data_raw) && isset($publisher_data_raw['data_status']) && !empty($publisher_data_raw['data_status']) && $publisher_data_raw['data_status'] == 1) {
                    $data['publisher_data'] = $publisher_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Publisher - ' . $data['publisher_data']['pub_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Publisher / No data associated with this Publisher', 'data' => ''));
                    return;
                }
                if ($onload == 1) {

                    $view = $this->load->view('publisher/edit_publisher', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('pub_name', 'Name', 'trim|required|min_length[3]|max_length[30]');
                    $this->form_validation->set_rules('pub_code', 'Code', 'trim|required|min_length[3]|max_length[15]');
                    $this->form_validation->set_rules('pub_address1', 'Address1', 'trim|required|min_length[3]|max_length[15]');
                    $this->form_validation->set_rules('pub_address2', 'Address2', 'trim|required|min_length[3]|max_length[15]');
                    $this->form_validation->set_rules('pub_address3', 'Address3', 'trim|required|min_length[3]|max_length[15]');
                    $this->form_validation->set_rules('pub_contact', 'Contact', 'trim|required|min_length[3]|max_length[20]');
                    $this->form_validation->set_rules('pub_email', 'Email', 'trim|required|min_length[3]|max_length[15]');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['pub_id'] = filter_input(INPUT_POST, 'pub_id', FILTER_SANITIZE_NUMBER_INT);
                        $data_prep['pub_name'] = strtoupper(filter_input(INPUT_POST, 'pub_name', FILTER_SANITIZE_STRING));
                        $data_prep['pub_code'] = strtoupper(filter_input(INPUT_POST, 'pub_code', FILTER_SANITIZE_STRING));
                        $data_prep['pub_address1'] = strtoupper(filter_input(INPUT_POST, 'pub_address1', FILTER_SANITIZE_STRING));
                        $data_prep['pub_address2'] = strtoupper(filter_input(INPUT_POST, 'pub_address2', FILTER_SANITIZE_STRING));
                        $data_prep['pub_address3'] = strtoupper(filter_input(INPUT_POST, 'pub_address3', FILTER_SANITIZE_STRING));
                        $data_prep['pub_contact'] = filter_input(INPUT_POST, 'pub_contact', FILTER_SANITIZE_STRING);
                        $data_prep['pub_email'] = strtoupper(filter_input(INPUT_POST, 'pub_email', FILTER_SANITIZE_STRING));
                        $status = $this->MPublisher->edit_save_publisher($data_prep);
//                        dev_export($status);die;
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['pub_name'] . " Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => ''));
                            return;
                        } else {
                            $data['pub_name'] = filter_input(INPUT_POST, 'pub_name', FILTER_SANITIZE_STRING);
                            $data['pub_code'] = filter_input(INPUT_POST, 'pub_code', FILTER_SANITIZE_STRING);
                            $data['pub_address1'] = filter_input(INPUT_POST, 'pub_address1', FILTER_SANITIZE_STRING);
                            $data['pub_address2'] = filter_input(INPUT_POST, 'pub_address2', FILTER_SANITIZE_STRING);
                            $data['pub_address3'] = filter_input(INPUT_POST, 'pub_address3', FILTER_SANITIZE_STRING);
                            $data['pub_contact'] = filter_input(INPUT_POST, 'pub_contact', FILTER_SANITIZE_STRING);
                            $data['pub_email'] = filter_input(INPUT_POST, 'pub_email', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('publisher/edit_publisher', $data, TRUE),'message'=> $status['message']));
                            return;
                        }
                    } else {
                        $data['pub_name'] = filter_input(INPUT_POST, 'pub_name', FILTER_SANITIZE_STRING);
                        $data['pub_code'] = filter_input(INPUT_POST, 'pub_code', FILTER_SANITIZE_STRING);
                        $data['pub_address1'] = filter_input(INPUT_POST, 'pub_address1', FILTER_SANITIZE_STRING);
                        $data['pub_address2'] = filter_input(INPUT_POST, 'pub_address2', FILTER_SANITIZE_STRING);
                        $data['pub_address3'] = filter_input(INPUT_POST, 'pub_address3', FILTER_SANITIZE_STRING);
                        $data['pub_contact'] = filter_input(INPUT_POST, 'pub_contact', FILTER_SANITIZE_STRING);
                        $data['pub_email'] = filter_input(INPUT_POST, 'pub_email', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('publisher/edit_publisher', $data, TRUE),'message'=> 'Validation Error'));
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
            $pub_id = filter_input(INPUT_POST, 'pub_id', FILTER_SANITIZE_NUMBER_INT);
//            dev_export($pub_id);die;
//          
            if (isset($pub_id) && !empty($pub_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
//                dev_export($data_prep);die;
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                 $data_prep['pub_id'] = filter_input(INPUT_POST, 'pub_id', FILTER_SANITIZE_STRING);
//                 dev_export($data_prep);die;
                $status = $this->MPublisher->edit_status_publisher($data_prep);
//                dev_export($status);die;
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
