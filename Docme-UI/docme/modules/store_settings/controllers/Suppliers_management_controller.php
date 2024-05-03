<?php

/**
 * Description of Suppliers_management_controller
 *
 * @author Saranya kumar G
 */
class Suppliers_management_controller extends MX_Controller {

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
        $this->load->model('Suppliers_model', 'MSuppliers');
    }

    public function show_suppliers() {
//        $data['template'] = 'suppliers/show_suppliers';
//        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'SUPPLIER MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Supplier Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $suppliers_data = $this->MSuppliers->get_all_suppliers_list();
        if ($suppliers_data['error_status'] == 0 && $suppliers_data['data_status'] == 1) {
            $data['suppliers_data'] = $suppliers_data['data'];
            $data['message'] = "";
        } else {
            $data['suppliers_data'] = FALSE;
            $data['message'] = $suppliers_data['message'];
        }


        $this->session->set_userdata('current_page', 'suppliers');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['suppliers_data']) && !empty($data['suppliers_data'])) {
                foreach ($data['suppliers_data'] as $suppliers) {
                    $suppliers_status = "";
                    if ($suppliers['isactive'] == 1) {
                        $suppliers_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $suppliers['id'] . '\',\'' . $suppliers['name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                    } else {
                        $suppliers_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $suppliers['id'] . '\',\'' . $suppliers['name'] . '\', this)" id="" class="js-switch"  /></a>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_suppliers(\'' . $suppliers['id'] . '\',\'' . $suppliers['name'] . '\',\'' . $suppliers['code'] . '\',\'' . $suppliers['address1'] . '\',\'' . $suppliers['address2'] . '\',\'' . $suppliers['address3'] . '\',\'' . $suppliers['contact'] . '\',\'' . $suppliers['emailid'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $suppliers['name'] . '" data-original-title="Edit ' . $suppliers['name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($suppliers['name'], $suppliers['code'],  $suppliers['contact'], $suppliers['emailid'], $suppliers_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('suppliers/show_suppliers', $data);
        }
    }

    public function add_suppliers() {

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Supplier Management', 'status' => 0, 'link' => base_url('suppliers/show-suppliers')),
                2 => array('message' => 'Add New Supplier', 'status' => 1)
            );
            $data['title'] = 'ADD NEW SUPPLIER';
            $data['panel_sub_header'] = 'Add New Suppliers';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'suppliers');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('suppliers/add_suppliers', $data);
            } else {

                $this->form_validation->set_rules('name', 'Supplier Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('code', 'Supplier Code', 'trim|required|min_length[3]|max_length[15]');
                $this->form_validation->set_rules('address1', 'Address1', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('address2', 'Address2', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('address3', 'Address3', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('contact', 'Contact', 'trim|required|min_length[3]|max_length[20]');
                $this->form_validation->set_rules('emailid', 'Email Id', 'trim|required|min_length[3]|max_length[30]');


                if ($this->form_validation->run() == TRUE) {
                    $data_prep['name'] = strtoupper(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
                    $data_prep['code'] = strtoupper(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
                    $data_prep['address1'] = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
                    $data_prep['address2'] = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
                    $data_prep['address3'] = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
                    $data_prep['contact'] = strtoupper(filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING));
                    $data_prep['emailid'] = strtoupper(filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_STRING));
//                     dev_export($data_prep);die;                  
                    $status = $this->MSuppliers->save_suppliers($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                        $data['code'] = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
                        $data['address1'] = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
                        $data['address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
                        $data['address3'] = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
                        $data['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                        $data['emailid'] = filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('suppliers/add_suppliers', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                    $data['code'] = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
                    $data['address1'] = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
                    $data['address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
                    $data['address3'] = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
                    $data['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                    $data['emailid'] = filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('suppliers/add_suppliers', $data, TRUE), 'message' => 'Error in saving data due to validation error'));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_suppliers() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $s_id = filter_input(INPUT_POST, 's_id', FILTER_SANITIZE_NUMBER_INT);
            $name = strtoupper(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
            $code = strtoupper(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
            $address1 = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
            $address2 = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
            $address3 = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
            $contact = strtoupper(filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING));
            $emailid = strtoupper(filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_STRING));
            
           

            if (isset($s_id) && !empty($s_id)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Supplier Management', 'status' => 0, 'link' => base_url('suppliers/show-suppliers')),
                    2 => array('message' => 'Edit Supplier', 'status' => 1)
                );
                $data['title'] = 'EDIT SUPPLIER - ' . $name;
                $data['panel_sub_header'] = 'Edit Supplier - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'suppliers');
                $this->session->set_userdata('current_parent', 'gen_sett');
//                dev_export($data);die;
                $suppliers_data_raw = $this->MSuppliers->get_suppliers_details($s_id);
//                dev_export($suppliers_data_raw);die;
                if (is_array($suppliers_data_raw) && isset($suppliers_data_raw['data_status']) && !empty($suppliers_data_raw['data_status']) && $suppliers_data_raw['data_status'] == 1) {
                    $data['suppliers_data'] = $suppliers_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Supplier - ' . $data['suppliers_data']['name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Supplier / No data associated with this supplier', 'data' => ''));
                    return;
                }
                if ($onload == 1) {

                    $view = $this->load->view('suppliers/edit_suppliers', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {   
           
                    
                    $this->form_validation->set_rules('code', 'Supplier Code', 'trim|required|min_length[3]|max_length[15]');
                    $this->form_validation->set_rules('name', 'Supplier Name', 'trim|required|min_length[3]|max_length[30]');
                    $this->form_validation->set_rules('address1', 'Address1 ', 'trim|required|min_length[3]|max_length[100]');
                    $this->form_validation->set_rules('address2', 'Address2 ', 'trim|required|min_length[3]|max_length[100]');
                    $this->form_validation->set_rules('address3', 'Address3 ', 'trim|required|min_length[3]|max_length[100]');
                    $this->form_validation->set_rules('contact', 'Contact ', 'trim|required|min_length[3]|max_length[20]');
                    $this->form_validation->set_rules('emailid', 'Email Id ', 'trim|required|min_length[3]|max_length[30]');
                    if ($this->form_validation->run() == TRUE) {
                      
                        $data_prep['s_id'] = filter_input(INPUT_POST, 's_id', FILTER_SANITIZE_NUMBER_INT);
                        $data_prep['name'] = strtoupper(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
                        $data_prep['code'] = strtoupper(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
                        $data_prep['address1'] = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
                        $data_prep['address2'] = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
                        $data_prep['address3'] = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
                        $data_prep['contact'] = strtoupper(filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING));
                        $data_prep['emailid'] = strtoupper(filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_STRING));
                       
                        $status = $this->MSuppliers->edit_save_suppliers($data_prep);
//                        dev_export($status);die;
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['name'] . " Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => ''));
                            return;
                        } else {
                            $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                            $data['code'] = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
                            $data['address1'] = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
                            $data['address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
                            $data['address3'] = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
                            $data['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                            $data['emailid'] = filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('suppliers/edit_suppliers', $data, TRUE), 'message' => $status['message']));
                            return;
                        }
                    } else {
                        $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                        $data['code'] = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
                        $data['address1'] = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
                        $data['address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
                        $data['address3'] = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
                        $data['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                        $data['emailid'] = filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('suppliers/edit_suppliers', $data, TRUE), 'message' => 'Validation Error'));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Supplier ID is provided / Invalid Supplier', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    
    
    
    
    
    
//     public function edit_publisher() {
//        $data['user_name'] = $this->session->userdata('user_name');
//        if ($this->input->is_ajax_request() == 1) {
//            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
//            $s_id = filter_input(INPUT_POST, 's_id', FILTER_SANITIZE_NUMBER_INT);
//            $name = strtoupper(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
//            $code = strtoupper(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
//            $address1 = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
//            $address2 = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
//            $address3 = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
//            $contact = strtoupper(filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING));
//            $email = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
//          
//            if (isset($pub_id) && !empty($pub_id)) {
//
//                $breadcrumb = array(
//                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
//                    1 => array('message' => 'Supplier Management', 'status' => 0, 'link' => base_url('suppliers/show-suppliers')),
//                    2 => array('message' => 'Edit Supplier', 'status' => 1)
//                );
//               
//                $data['title'] = 'EDIT SUPPLIER - ' . $name;
//                $data['panel_sub_header'] = 'Edit Supplier - ';
//                $data['breadcrumb'] = $breadcrumb;
//                $this->session->set_userdata('current_page', 'suppliers');
//                $this->session->set_userdata('current_parent', 'gen_sett');
//
//                $publisher_data_raw = $this->MPublisher->get_publisher_details($pub_id);
//                if (is_array($publisher_data_raw) && isset($publisher_data_raw['data_status']) && !empty($publisher_data_raw['data_status']) && $publisher_data_raw['data_status'] == 1) {
//                    $data['publisher_data'] = $publisher_data_raw['data'][0];
//                    $data['panel_sub_header'] = 'Edit Publisher - ' . $data['publisher_data']['name'];
//                } else {
//                    echo json_encode(array('status' => 0, 'message' => 'Invalid Publisher / No data associated with this Publisher', 'data' => ''));
//                    return;
//                }
//                if ($onload == 1) {
//
//                    $view = $this->load->view('publisher/edit_publisher', $data, TRUE);
//                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
//                } else {
//                    $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[30]');
//                    $this->form_validation->set_rules('code', 'Code', 'trim|required|min_length[3]|max_length[15]');
//                    $this->form_validation->set_rules('address1', 'Address1', 'trim|required|min_length[3]|max_length[15]');
//                    $this->form_validation->set_rules('address2', 'Address2', 'trim|required|min_length[3]|max_length[15]');
//                    $this->form_validation->set_rules('address3', 'Address3', 'trim|required|min_length[3]|max_length[15]');
//                    $this->form_validation->set_rules('contact', 'Contact', 'trim|required|min_length[3]|max_length[15]');
//                    $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[15]');
//                    if ($this->form_validation->run() == TRUE) {
//                        $data_prep['pub_id'] = filter_input(INPUT_POST, 'pub_id', FILTER_SANITIZE_NUMBER_INT);
//                        $data_prep['name'] = strtoupper(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
//                        $data_prep['code'] = strtoupper(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
//                        $data_prep['address1'] = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
//                        $data_prep['address2'] = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
//                        $data_prep['address3'] = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
//                        $data_prep['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
//                        $data_prep['email'] = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
//                        $status = $this->MPublisher->edit_save_publisher($data_prep);
////                        dev_export($status);die;
//                        if (is_array($status) && $status['status'] == 1) {
//                            $this->session->set_flashdata('success_message', $data_prep['name'] . " Edited Successfully");
//                            echo json_encode(array('status' => 1, 'view' => ''));
//                            return;
//                        } else {
//                            $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
//                            $data['code'] = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
//                            $data['address1'] = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
//                            $data['address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
//                            $data['address3'] = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
//                            $data['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
//                            $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
//                            $this->session->set_flashdata('error_message', $status['message']);
//                            echo json_encode(array('status' => 2, 'view' => $this->load->view('publisher/edit_publisher', $data, TRUE),'message'=> $status['message']));
//                            return;
//                        }
//                    } else {
//                        $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
//                        $data['code'] = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
//                        $data['address1'] = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
//                        $data['address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
//                        $data['address3'] = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
//                        $data['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
//                        $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
//                        echo json_encode(array('status' => 3, 'view' => $this->load->view('publisher/edit_publisher', $data, TRUE),'message'=> $status['message']));
//                        return;
//                    }
//                }
//            } else {
//                echo json_encode(array('status' => 0, 'message' => 'No Publisher ID is provided / Invalid Publisher', 'data' => ''));
//            }
//        } else {
//            $this->load->view(ERROR_500);
//        }
//    }


    public function update_status() {
        if ($this->input->is_ajax_request() == 1) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($id) && !empty($id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['id'] = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
                $status = $this->MSuppliers->edit_status_suppliers($data_prep);
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
