<?php

/**
 * Description of Itemtype_management_controller
 *
 * @author Rahul
 */
class Itemtype_management_controller extends MX_Controller {

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
        $this->load->model('Itemtype_model', 'MItemtype');
    }
 
      public function show_itemtype() {
//        $data['template'] = 'itemtype/show_item';
//        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $data['sub_title'] = 'ITEM TYPE MANAGEMENT';
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
        $itemtype_data = $this->MItemtype->get_all_itemtype_list();
//        dev_export($itemtype_data);die;
        if ($itemtype_data['error_status'] == 0 && $itemtype_data['data_status'] == 1) {
            $data['itemtype_data'] = $itemtype_data['data'];
            $data['message'] = "";
        } else {
            $data['itemtype_data'] = FALSE;
            $data['message'] = $itemtype_data['message'];
        }


        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['itemtype_data']) && !empty($data['itemtype_data'])) {
                foreach ($data['itemtype_data'] as $itemtype) {
                    $itemtype_status = "";
                    if ($itemtype['isactive'] == 1) {
                         $itemtype_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $itemtype['itemtype_id'] . '\',\'' . $itemtype['itemtype_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        //$itemtype_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $itemtype['country_id'] . '\',\'' . $itemtype['country_name'] . '\');"/><span></span></label>';
                    } else {
                        $itemtype_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $itemtype['itemtype_id'] . '\',\'' . $itemtype['itemtype_name'] . '\', this)" id="" class="js-switch"  /></a>';
                        //$itemtype_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $itemtype['country_id'] . '\',\'' . $itemtype['country_name'] . '\');"/><span></span></label>';
                    }
                     $task_html = '<a href="javascript:void(0);" onclick="edit_itemtype(\'' . $itemtype['itemtype_id'] . '\',\'' . $itemtype['itemtype_name'] . '\',\'' . $itemtype['itemtype_code'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $itemtype['itemtype_name'] . '" data-original-title="Edit ' . $itemtype['itemtype_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $itemtype['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($itemtype['itemtype_name'], $itemtype['itemtype_code'], $itemtype_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('itemtype/show_item', $data);
        }
    }
 public function update_status() {
        if ($this->input->is_ajax_request() == 1) {
            $itemtype_id = filter_input(INPUT_POST, 'itemtype_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($itemtype_id) && !empty($itemtype_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                 $data_prep['itemtype_id'] = filter_input(INPUT_POST, 'itemtype_id', FILTER_SANITIZE_STRING);
                $status = $this->MItemtype->edit_status_itemtype($data_prep);
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
     public function add_itemtype() {
                
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
            $data['title'] = 'ADD NEW ITEM TYPE';
//            $data['currency_data'] = $item['data'];
            $data['panel_sub_header'] = 'Add New Item Type';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'itemtype');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('itemtype/add_item', $data);
            } else {

                $this->form_validation->set_rules('itemtype_name', 'Item  Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('itemtype_code', 'Item Code', 'trim|required|min_length[3]|max_length[15]');
//                $this->form_validation->set_rules('currency_select', 'Currency', 'trim|required');
                 
                if ($this->form_validation->run() == TRUE) {
                    $data_prep['itemtype_name'] = strtoupper(filter_input(INPUT_POST, 'itemtype_name', FILTER_SANITIZE_STRING));
                    $data_prep['itemtype_code'] = strtoupper(filter_input(INPUT_POST, 'itemtype_code', FILTER_SANITIZE_STRING));
//                    $data_prep['currency_id'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
//                     dev_export($data_prep);die;                  
                    $status = $this->MItemtype->save_item($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['itemtype_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['itemtype_name'] = filter_input(INPUT_POST, 'itemtype_name', FILTER_SANITIZE_STRING);
                        $data['itemtype_code'] = filter_input(INPUT_POST, 'itemtype_code', FILTER_SANITIZE_STRING);
//                        $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('itemtype/add_item', $data, TRUE),'message'=> $status['message']));
                        return;
                    }
                } else {
                    $data['itemtype_name'] = filter_input(INPUT_POST, 'itemtype_name', FILTER_SANITIZE_STRING);
                    $data['itemtype_code'] = filter_input(INPUT_POST, 'itemtype_code', FILTER_SANITIZE_STRING);
//                    $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('itemtype/add_item', $data, TRUE),'message'=> $status['message']));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    
    
    public function edit_itemtype() {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $itemtype_id = filter_input(INPUT_POST, 'itemtype_id', FILTER_SANITIZE_NUMBER_INT);
            $itemtype_name = strtoupper(filter_input(INPUT_POST, 'itemtype_name', FILTER_SANITIZE_STRING));
            $itemtype_code = strtoupper(filter_input(INPUT_POST, 'itemtype_code', FILTER_SANITIZE_STRING));
           
            if (isset($itemtype_id) && !empty($itemtype_id)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Item Management', 'status' => 0, 'link' => base_url('itemtype/show-item')),
                    2 => array('message' => 'Edit Country', 'status' => 1)
                );
                $data['title'] = 'EDIT ITEM - ' .$itemtype_name;
//                $data['currency_data'] = $currency['data'];
                $data['panel_sub_header'] = 'Edit Item - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'itemtype');
                $this->session->set_userdata('current_parent', 'gen_sett');

                $itemtype_data_raw = $this->MItemtype->get_itemtype_details($itemtype_id);
                if (is_array($itemtype_data_raw) && isset($itemtype_data_raw['data_status']) && !empty($itemtype_data_raw['data_status']) && $itemtype_data_raw['data_status'] == 1) {
                    $data['itemtype_data'] = $itemtype_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Item - ' . $data['itemtype_data']['itemtype_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Item Name / No data associated with this country', 'data' => ''));
                    return;
                }
                if ($onload == 1) {
                    
                    $view = $this->load->view('itemtype/edit_itemtype', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('itemtype_name', 'Item Name', 'trim|required|min_length[3]|max_length[30]');
                    $this->form_validation->set_rules('itemtype_code', 'Item Code', 'trim|required|min_length[3]|max_length[15]');
//                    $this->form_validation->set_rules('currency_select', 'Currency', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['itemtype_id'] = filter_input(INPUT_POST, 'itemtype_id', FILTER_SANITIZE_STRING);
                        $data_prep['itemtype_name'] = strtoupper(filter_input(INPUT_POST, 'itemtype_name', FILTER_SANITIZE_STRING));
                        $data_prep['itemtype_code'] = strtoupper(filter_input(INPUT_POST, 'itemtype_code', FILTER_SANITIZE_STRING));
//                        $data_prep['currency_id'] = strtoupper(filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING));
//                      dev_export($data_prep);die;
                        $status = $this->MItemtype->edit_save_itemtype($data_prep);
                        
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['itemtype_name'] . " Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => ''));
                            return;
                        } else {
                            $data['itemtype_name'] = filter_input(INPUT_POST, 'itemtype_name', FILTER_SANITIZE_STRING);
                            $data['itemtype_code'] = filter_input(INPUT_POST, 'itemtype_code', FILTER_SANITIZE_STRING);
//                           $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('itemtype/edit_itemtype', $data, TRUE),'message'=> $status['message']));
                            return;
                        }
                    } else {
                        $data['itemtype_name'] = filter_input(INPUT_POST, 'itemtype_name', FILTER_SANITIZE_STRING);
                        $data['itemtype_code'] = filter_input(INPUT_POST, 'itemtype_code', FILTER_SANITIZE_STRING);
//                        $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('itemtype/edit_itemtype', $data, TRUE),'message'=> $status['message']));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Item ID is provided / Invalid Item', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    
    
    
}