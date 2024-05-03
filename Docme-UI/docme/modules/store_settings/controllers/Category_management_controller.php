<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category_management_controller
 *
 * @author Rahul 
 */
class Category_management_controller extends MX_Controller {
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
        $this->load->model('Category_model', 'Mcategory');
    }
    
     public function show_category() {
//        $data['template'] = 'category/show_category';
//        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $data['sub_title'] = 'STOCK CATEGORY ';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Bookstore Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Item Type Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $category_data = $this->Mcategory->get_all_category_list();
//        dev_export($category_data);die;
        if ($category_data['error_status'] == 0 && $category_data['data_status'] == 1) {
            $data['category_data'] = $category_data['data'];
            $data['message'] = "";
        } else {
            $data['category_data'] = FALSE;
            $data['message'] = $category_data['message'];
        }


        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['category_data']) && !empty($data['category_data'])) {
                foreach ($data['category_data'] as $category) {
                    $category_status = "";
                    if ($category['isactive'] == 1) {
                         $category_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $category['cate_id'] . '\',\'' . $category['cate_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        //$category_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $category['country_id'] . '\',\'' . $category['country_name'] . '\');"/><span></span></label>';
                    } else {
                        $category_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $category['cate_id'] . '\',\'' . $category['cate_name'] . '\', this)" id="" class="js-switch"  /></a>';
                        //$category_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $category['country_id'] . '\',\'' . $category['country_name'] . '\');"/><span></span></label>';
                    }
                     $task_html = '<a href="javascript:void(0);" onclick="edit_category(\'' . $category['cate_id'] . '\',\'' . $category['cate_name'] . '\',\'' . $category['cate_description'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $category['cate_name'] . '" data-original-title="Edit ' . $category['cate_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $category['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $category['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($category['cate_name'], $category['cate_description'], $category_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('category/show_category', $data);
        }
    }
    
     public function update_status() {
        if ($this->input->is_ajax_request() == 1) {
            $cate_id = filter_input(INPUT_POST, 'cate_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($cate_id) && !empty($cate_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                 $data_prep['cate_id'] = filter_input(INPUT_POST, 'cate_id', FILTER_SANITIZE_STRING);
                $status = $this->Mcategory->edit_status_category($data_prep);
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
    
     public function edit_category() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $cate_id = filter_input(INPUT_POST, 'cate_id', FILTER_SANITIZE_NUMBER_INT);
            $cate_name= strtoupper(filter_input(INPUT_POST, 'cate_name', FILTER_SANITIZE_STRING));
            $cate_description = strtoupper(filter_input(INPUT_POST, 'cate_description', FILTER_SANITIZE_STRING));
           
            if (isset($cate_id) && !empty($cate_id)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Item Management', 'status' => 0, 'link' => base_url('itemtype/show-item')),
                    2 => array('message' => 'Edit Country', 'status' => 1)
                );
                $data['title'] = 'EDIT CATEGORY - ' .$cate_name;
//                $data['currency_data'] = $currency['data'];
                $data['panel_sub_header'] = 'Edit Category - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'category');
                $this->session->set_userdata('current_parent', 'gen_sett');

                $category_data_raw = $this->Mcategory->get_category_details($cate_id);
                if (is_array($category_data_raw) && isset($category_data_raw['data_status']) && !empty($category_data_raw['data_status']) && $category_data_raw['data_status'] == 1) {
                    $data['category_data'] = $category_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Category - ' . $data['category_data']['cate_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Item Name / No data associated with this Category', 'data' => ''));
                    return;
                }
                if ($onload == 1) {
                    
                    $view = $this->load->view('category/edit_category', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('cate_name', ' Name', 'trim|required|min_length[3]|max_length[30]');
                    $this->form_validation->set_rules('cate_description', ' Description', 'trim|required|min_length[3]|max_length[100]');
//                    $this->form_validation->set_rules('currency_select', 'Currency', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['cate_id'] = filter_input(INPUT_POST, 'cate_id', FILTER_SANITIZE_STRING);
                        $data_prep['cate_name'] = strtoupper(filter_input(INPUT_POST, 'cate_name', FILTER_SANITIZE_STRING));
                        $data_prep['cate_description'] = strtoupper(filter_input(INPUT_POST, 'cate_description', FILTER_SANITIZE_STRING));
//                        $data_prep['currency_id'] = strtoupper(filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING));
//                      dev_export($data_prep);die;
                        $status = $this->Mcategory->edit_save_category($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['cate_name'] . " Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => ''));
                            return;
                        } else {
                            $data['cate_name'] = filter_input(INPUT_POST, 'cate_name', FILTER_SANITIZE_STRING);
                            $data['cate_description'] = filter_input(INPUT_POST, 'cate_description', FILTER_SANITIZE_STRING);
//                           $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('category/edit_category', $data, TRUE),'message'=> $status['message']));
                            return;
                        }
                    } else {
                        $data['cate_name'] = filter_input(INPUT_POST, 'cate_name', FILTER_SANITIZE_STRING);
                        $data['cate_description'] = filter_input(INPUT_POST, 'cate_description', FILTER_SANITIZE_STRING);
//                        $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('category/edit_category', $data, TRUE),'message'=> $status['message']));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Category ID is provided / Invalid Category', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
     public function add_category() {
                
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Item Management', 'status' => 0, 'link' => base_url('itemtype/show-item')),
                2 => array('message' => 'Add New Item', 'status' => 1)
            );
//            $item = $this->MItemtype->get_all_item();
//            if (isset($item['error_status']) && $item['error_status'] == 0) {
//                if ($item['data_status'] == 1) {
//                    $data['currency_data'] = $item['data'];
//                } else {
//                    $data['currency_data'] = FALSE;
//                }
//            } else {
//                $data['currency_data'] = FALSE;
//            }
            $data['title'] = 'ADD NEW CATEGORY';
//            $data['currency_data'] = $item['data'];
            $data['panel_sub_header'] = 'Add New Category';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'itemtype');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('category/add_category', $data);
            } else {

                $this->form_validation->set_rules('cate_name', '  Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('cate_description', 'Description', 'trim|required|min_length[3]|max_length[50]');
//                $this->form_validation->set_rules('currency_select', 'Currency', 'trim|required');
                 
                if ($this->form_validation->run() == TRUE) {
                    $data_prep['cate_name'] = strtoupper(filter_input(INPUT_POST, 'cate_name', FILTER_SANITIZE_STRING));
                    $data_prep['cate_description'] = strtoupper(filter_input(INPUT_POST, 'cate_description', FILTER_SANITIZE_STRING));
//                    $data_prep['currency_id'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
//                     dev_export($data_prep);die;                  
                    $status = $this->Mcategory->save_category($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['cate_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['cate_name'] = filter_input(INPUT_POST, 'cate_name', FILTER_SANITIZE_STRING);
                        $data['cate_description'] = filter_input(INPUT_POST, 'cate_description', FILTER_SANITIZE_STRING);
//                        $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('category/add_category', $data, TRUE),'message'=> $status['message']));
                        return;
                    }
                } else {
                    $data['cate_name'] = filter_input(INPUT_POST, 'cate_name', FILTER_SANITIZE_STRING);
                    $data['cate_description'] = filter_input(INPUT_POST, 'cate_description', FILTER_SANITIZE_STRING);
//                    $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('category/add_category', $data, TRUE),'message'=> $status['message']));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    
    
}
