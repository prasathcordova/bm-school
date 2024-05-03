<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_controller
 *
 * @author chandrajith.edsys
 */
class Items_controller extends MX_Controller {
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
        $this->load->model('Items_management_model', 'Mitems');
    }
  
     public function details() {

        $data['sub_title'] = 'ITEM MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Store Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Store Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $item_data = $this->Mitems->get_all_items_list();
        if ($item_data['error_status'] == 0 && $item_data['data_status'] == 1) {
            $data['item_data'] = $item_data['data'];
            $data['message'] = "";
        } else {
            $data['item_data'] = FALSE;
            $data['message'] = $item_data['message'];
        }


        $this->session->set_userdata('current_page', 'itemmgmt');
        $this->session->set_userdata('current_parent', 'store_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['item_data']) && !empty($data['item_data'])) {
                foreach ($data['item_data'] as $item) {
                    $item_status = "";
                    if ($item['isactive'] == 1) {
                         $item_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $item['item_id'] . '\',\'' . $item['item_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        
                    } else {
                        $item_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $item['item_id'] . '\',\'' . $item['item_name'] . '\', this)" id="" class="js-switch"  /></a>';
                       
                    }
                     $task_html = '<a href="javascript:void(0);" onclick="edit_item(\'' . $item['item_id'] . '\',\'' . $item['item_name'] . '\',\'' . $item['item_description'] . '\',\'' . $item['name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $item['item_name'] . '" data-original-title="Edit ' . $item['item_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    
                    $formatted_data[] = array($item['item_name'], $item['item_description'], $item['name'], $item_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('details/show_details', $data);
        }
    }
    public function add_item() {
       
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Item Management', 'status' => 0, 'link' => base_url('itemmaster/show-items')),
                2 => array('message' => 'Add New Item', 'status' => 1)
            );
            $category = $this->Mitems->get_all_category();

            if (isset($category['error_status']) && $category['error_status'] == 0) {
                if ($category['data_status'] == 1) {
                    $data['category_data'] = $category['data'];
                } else {
                    $data['category_data'] = FALSE;
                }
            } else {
                $data['category_data'] = FALSE;
            }
            $item_type = $this->Mitems->get_all_itemtype();

            if (isset($item_type['error_status']) && $item_type['error_status'] == 0) {
                if ($item_type['data_status'] == 1) {
                    $data['item_type_data'] = $item_type['data'];
                } else {
                    $data['item_type_data'] = FALSE;
                }
            } else {
                $data['item_type_data'] = FALSE;
            }
            $item_edition = $this->Mitems->get_all_itemedition();

            if (isset($item_edition['error_status']) && $item_edition['error_status'] == 0) {
                if ($item_type['data_status'] == 1) {
                    $data['item_edition'] = $item_edition['data'];
                } else {
                    $data['item_edition'] = FALSE;
                }
            } else {
                $data['item_edition'] = FALSE;
            }
            $publisher = $this->Mitems->get_all_publisher();

            if (isset($publisher['error_status']) && $publisher['error_status'] == 0) {
                if ($item_type['data_status'] == 1) {
                    $data['publisher'] = $publisher['data'];
                } else {
                    $data['publisher'] = FALSE;
                }
            } else {
                $data['publisher'] = FALSE;
            }
            $data['title'] = 'ADD NEW ITEM';
            $data['category_data'] = $category['data'];
            $data['panel_sub_header'] = 'Add New Item';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'item');
            $this->session->set_userdata('current_parent', 'store_sett');

            if ($onload == 1) {
                                
                $this->load->view('details/add_details', $data);
            } else {

                $this->form_validation->set_rules('item_name', 'Item Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('item_description', 'Item Description', 'trim|required|min_length[3]|max_length[15]');
//                $this->form_validation->set_rules('currency_select', 'Currency', 'trim|required');
                $this->form_validation->set_rules('category_select', 'Category', 'trim|required');
                 
                if ($this->form_validation->run() == TRUE) {
                    $data_prep['item_name'] = strtoupper(filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING));
                    $data_prep['item_code'] = strtoupper(filter_input(INPUT_POST, 'item_code', FILTER_SANITIZE_STRING));
                    $data_prep['item_description'] = strtoupper(filter_input(INPUT_POST, 'item_description', FILTER_SANITIZE_STRING));
                   
                    $data_prep['itemtype_id'] = filter_input(INPUT_POST, 'itemtype_select', FILTER_SANITIZE_STRING);
                    $data_prep['cate_id'] = filter_input(INPUT_POST, 'category_select', FILTER_SANITIZE_STRING);
                    $data_prep['id'] = filter_input(INPUT_POST, 'itemedition_select', FILTER_SANITIZE_STRING);
                    $data_prep['pub_id'] = filter_input(INPUT_POST, 'publisher_select', FILTER_SANITIZE_STRING);
//                    dev_export($data_prep) ;die;        
                    $status = $this->Mitems->save_item($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['item_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['item_name'] = filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING);
                        $data['item_code'] = filter_input(INPUT_POST, 'item_code', FILTER_SANITIZE_STRING);
                        $data['item_description'] = filter_input(INPUT_POST, 'item_description', FILTER_SANITIZE_STRING);
                        $data['itemtype_select'] = filter_input(INPUT_POST, 'itemtype_select', FILTER_SANITIZE_STRING);
                        $data['category_select'] = filter_input(INPUT_POST, 'category_select', FILTER_SANITIZE_STRING);
                        $data['itemedition_select'] = filter_input(INPUT_POST, 'itemedition_select', FILTER_SANITIZE_STRING);
                        $data['publisher_select'] = filter_input(INPUT_POST, 'publisher_select', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('details/add_details', $data, TRUE),'message'=> $status['message']));
                        return;
                    }
                } else {
                    $data['item_name'] = filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING);
                    $data['item_description'] = filter_input(INPUT_POST, 'item_description', FILTER_SANITIZE_STRING);
                    $data['category_select'] = filter_input(INPUT_POST, 'category_select', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('details/add_details', $data, TRUE),'message'=> $status['message']));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
     public function items_update_status() {
        if ($this->input->is_ajax_request() == 1) {
            $item_id = filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($item_id) && !empty($item_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                 $data_prep['item_id'] = filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_STRING);
                $status = $this->Mitems->edit_status_item($data_prep);
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
