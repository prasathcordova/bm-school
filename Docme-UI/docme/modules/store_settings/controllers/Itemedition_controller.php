<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Itemedition_controller
 *
 * @author Shamna
 */
class Itemedition_controller extends MX_Controller{
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
        $this->load->model('Itemedition_model', 'MItem');
    }
    
    public function show_itemedition() {
        $data['template'] = 'itemedition/show_itemediton';
//        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'ITEM EDITON MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Item Edition Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $itemedition_data = $this->MItem->get_all_itemedition();
//       dev_export($itemedition_data);die;
        if ($itemedition_data['error_status'] == 0 && $itemedition_data['data_status'] == 1) {
            $data['itemedition_data'] = $itemedition_data['data'];
            $data['message'] = "";
        } else {
            $data['itemedition_data'] = FALSE;
            $data['message'] = $itemedition_data['message'];
        }

        $this->session->set_userdata('current_page', 'itemediton');
        $this->session->set_userdata('current_parent', 'gen_sett');

          if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['itemedition_data']) && !empty($data['itemedition_data'])) {
                foreach ($data['itemedition_data'] as $itemedition) {
                    $edition_status = "";
                    if ($itemedition['isactive'] == 1) {
                        $edition_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $itemedition['id'] . '\', this)" checked id="" class="js-switch"  />';
                    } else {
                        $edition_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $itemedition['id'] . '\', this)" id="" class="js-switch"  />';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_itemedition(\'' . $itemedition['id'] . '\',\'' . $itemedition['edition_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $itemedition['edition_name']  . '" data-original-title="' . $itemedition['edition_name']  . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($itemedition['edition_name'], $edition_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('itemedition/show_itemedition', $data);
        }
      }
      
       public function add_itemedition() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Item Edition Management', 'status' => 0, 'link' => base_url('itemedition/show-itemedition')),
                2 => array('message' => 'Add New Edition', 'status' => 1)
            );

            $data['panel_sub_header'] = 'Add New Edition';
            $data['breadcrumb'] = $breadcrumb;
            $data['title'] = 'ADD NEW EDITION';
            $this->session->set_userdata('current_page', 'itemedition');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('itemedition/add_itemedition', $data);
            } else {

                $this->form_validation->set_rules('edition_name', 'Edition Name', 'trim|required|min_length[3]|max_length[30]');

                if ($this->form_validation->run() == TRUE) {
                      $data_prep['edition_name'] = strtoupper(filter_input(INPUT_POST, 'edition_name', FILTER_SANITIZE_STRING));
                    //$data_prep['name'] = filter_input(INPUT_POST, 'religion_name', FILTER_SANITIZE_STRING);

                    $status = $this->MItem->save_itemedition($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['edition_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['edition_name'] = filter_input(INPUT_POST, 'edition_name', FILTER_SANITIZE_STRING);

                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('itemedition/add_itemedition', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data['edition_name'] = filter_input(INPUT_POST, 'edition_name', FILTER_SANITIZE_STRING);

                    echo json_encode(array('status' => 3, 'view' => $this->load->view('itemedition/add_itemedition', $data, TRUE),'message' => $status['message']));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    
     public function edit_itemedition() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $edition_name = strtoupper(filter_input(INPUT_POST, 'edition_name', FILTER_SANITIZE_STRING));
            if (isset($id) && !empty($id)) {
                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Item Edition Management', 'status' => 0, 'link' => base_url('itemedition/show-itemedition')),
                    2 => array('message' => 'Edit Item Edition', 'status' => 1)
                );
                $data['title'] = 'EDIT ITEM EDITION - ' . $edition_name;
                $data['panel_sub_header'] = 'Edit Item Edition - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'edition');
                $this->session->set_userdata('current_parent', 'gen_sett');
//                $data['id'] = $id;
                $edition_data_raw = $this->MItem->get_itemedition_details($id);

                if (is_array($edition_data_raw) && isset($edition_data_raw['data_status']) && !empty($edition_data_raw['data_status']) && $edition_data_raw['data_status'] == 1) {
                    $data['edition_data'] = $edition_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Item Edition - ' . $data['edition_data']['edition_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Item Edition / No data associated with this Edition', 'data' => ''));
                    return;
                }
                if ($onload == 1) {
                    $view = $this->load->view('itemedition/edit_itemedition', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('edition_name', 'Edition Name', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['edition_id'] = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
                        $data_prep['edition_name'] = strtoupper(filter_input(INPUT_POST, 'edition_name', FILTER_SANITIZE_STRING));
                        $status = $this->MItem->edit_save_itemedition($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['edition_name'] . "  Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => ''));
                            return;
                        } else {
                            $data['edition_name'] = filter_input(INPUT_POST, 'edition_name', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('itemedition/edit_itemedition', $data, TRUE),'message' => $status['message']));
                            return;
                        }
                    } else {
                        $data['edition_name'] = filter_input(INPUT_POST, 'edition_name', FILTER_SANITIZE_STRING);
                        //$data['religion_select'] = filter_input(INPUT_POST, 'religion_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('itemedition/edit_itemedition', $data, TRUE),'message' => $status['message']));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Religion ID is provided / Invalid Religion', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

     public function update_status() {
        if ($this->input->is_ajax_request() == 1) {
            $id= filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($id) && !empty($id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['edition_id'] = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
                //dev_export($data_prep);die;
                $status = $this->MItem->edit_status_itemediton($data_prep);

                if (is_array($status) && $status['status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    echo json_encode(array('status' => 2, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                    return;
                }
            } else {
                echo json_encode(array('status' => 3, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                return;
            }
        } else {
            echo json_encode(array('status' => 4, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
            return;
        }
    }
}
