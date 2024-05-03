<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Details_management_controller
 *
 * @author chandrajith.edsys
 */
class Itemdetails_management_controller extends MX_Controller
{

    public function __construct()
    {
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
        $this->load->model('Itemdetails_management_model', 'MItem');
    }

    public function show_details()
    {
        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'ITEM MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Bookstore Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Publisher Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $item_list = $this->MItem->get_all_item_list();

        if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
            $data['item_data'] = $item_list['data'];
            $data['message'] = "";
        } else {
            $data['item_data'] = FALSE;
            $data['message'] = $item_list['message'];
        }




        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['item_data']) && !empty($data['item_data'])) {
                foreach ($data['item_data'] as $item) {
                    $item_status = "";
                    if ($item['isactive'] == 1) {
                        $item_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $item['item_id'] . '\',\'' . $item['item_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        //$country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    } else {
                        $item_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $item['item_id'] . '\',\'' . $item['item_name'] . '\', this)" id="" class="js-switch"  /></a>';
                        //$country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_item_details(\'' . $item['item_id'] . '\',\'' . $item['item_name'] . '\',\'' . $item['item_code'] . '\',\'' . $item['item_description'] . '\',\'' . $item['purchase_price'] . '\',\'' . $item['selling_price'] . '\',\'' . $item['cate_name'] . '\',\'' . $item['itemtype_name'] . '\',\'' . $item['edition_name'] . '\',\'' . $item['pub_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $item['item_name'] . '" data-original-title="Edit ' . $item['item_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($item['itemtype_name'], $item['item_name'], $item['item_code'], $item['pub_name'], $item['cate_name'], $item['edition_name'], $item_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        }




        $this->load->view('details/show_details', $data);
    }

    public function add_new_item()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'GENERAL SETTINGS';
            $data['sub_title'] = 'ITEM MANAGEMENT';

            //Basic Data loading

            $publisher = $this->MItem->get_publishers();
            $item_type = $this->MItem->get_item_type();
            $item_edition = $this->MItem->get_item_edition();
            $stock_category = $this->MItem->get_stock_category();

            //verify basic data availability
            if (isset($publisher['data']) && !empty($publisher['data'])) {
                $data['publisher'] = $publisher['data'];
            } else {
                $data['publisher'] = NULL;
            }
            if (isset($item_type['data']) && !empty($item_type['data'])) {
                $data['itemtype'] = $item_type['data'];
            } else {
                $data['itemtype'] = NULL;
            }
            if (isset($item_edition['data']) && !empty($item_edition['data'])) {
                $data['item_edition'] = $item_edition['data'];
            } else {
                $data['item_edition'] = NULL;
            }
            if (isset($stock_category['data']) && !empty($stock_category['data'])) {
                $data['stock_category'] = $stock_category['data'];
            } else {
                $data['stock_category'] = NULL;
            }

            //            $view = $this->load->view('details/items_add', $data);
            //            echo json_encode(array('data'=>$data,'view' => $view));
            $this->load->view('details/items_add', $data);
            //            echo json_encode(array('view' => $this->load->view('details/items_add', $data), 'message' => $status['message']));
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function add_item()
    {
        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'ITEM MANAGEMENT';

        $item_list = $this->MItem->get_all_item_list();

        if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
            $data['item_data'] = $item_list['data'];
            $data['message'] = "";
        } else {
            $data['item_data'] = FALSE;
            $data['message'] = $item_list['message'];
        }

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {

            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            if ($onload == 1) {
                $this->load->view('details/items_add', $data);
            } else {

                $this->form_validation->set_rules('item_name', 'Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('item_code', 'Item Code', 'trim|required|min_length[3]|max_length[10]');
                $this->form_validation->set_rules('item_description', 'Description', 'trim|required|min_length[3]');
                $this->form_validation->set_rules('stock_category', 'Stock Category', 'trim|required');
                $this->form_validation->set_rules('itemtype', 'Item Type', 'trim|required');
                $this->form_validation->set_rules('itemedition', 'Item Edition', 'trim|required');
                $this->form_validation->set_rules('publisher', 'Publisher', 'trim|required');
                $this->form_validation->set_rules('purchase_price', 'Purchase Price', 'trim|required');
                $this->form_validation->set_rules('selling_price', 'Selling Price', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data_prep['item_name'] = strtoupper(filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING));
                    $data_prep['item_code'] = strtoupper(filter_input(INPUT_POST, 'item_code', FILTER_SANITIZE_STRING));
                    $data_prep['item_description'] = strtoupper(filter_input(INPUT_POST, 'item_description', FILTER_SANITIZE_STRING));
                    $data_prep['category_id'] = filter_input(INPUT_POST, 'stock_category', FILTER_SANITIZE_STRING);
                    $data_prep['item_typeid'] = filter_input(INPUT_POST, 'itemtype', FILTER_SANITIZE_STRING);
                    $data_prep['editionid'] = filter_input(INPUT_POST, 'itemedition', FILTER_SANITIZE_STRING);
                    $data_prep['publi_id'] = filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING);
                    $data_prep['purchase_price'] = filter_input(INPUT_POST, 'purchase_price', FILTER_SANITIZE_STRING);
                    $data_prep['selling_price'] = filter_input(INPUT_POST, 'selling_price', FILTER_SANITIZE_STRING);
                    //                     dev_export($data_prep);die;                  
                    $status = $this->MItem->save_item($data_prep);
                    //                    dev_export($status);die;


                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['item_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => $this->load->view('details/show_details', $data, TRUE), 'message' => $status['message']));
                        return;
                    } else {
                        $data_prep['item_name'] = strtoupper(filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING));
                        $data_prep['item_code'] = strtoupper(filter_input(INPUT_POST, 'item_code', FILTER_SANITIZE_STRING));
                        $data_prep['item_description'] = strtoupper(filter_input(INPUT_POST, 'item_description', FILTER_SANITIZE_STRING));
                        $data_prep['category_id'] = filter_input(INPUT_POST, 'stock_category', FILTER_SANITIZE_STRING);
                        $data_prep['item_typeid'] = filter_input(INPUT_POST, 'itemtype', FILTER_SANITIZE_STRING);
                        $data_prep['editionid'] = filter_input(INPUT_POST, 'itemedition', FILTER_SANITIZE_STRING);
                        $data_prep['publi_id'] = filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING);
                        $data_prep['purchase_price'] = filter_input(INPUT_POST, 'purchase_price', FILTER_SANITIZE_STRING);
                        $data_prep['selling_price'] = filter_input(INPUT_POST, 'selling_price', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => '', 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data_prep['item_name'] = strtoupper(filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING));
                    $data_prep['item_code'] = strtoupper(filter_input(INPUT_POST, 'item_code', FILTER_SANITIZE_STRING));
                    $data_prep['item_description'] = strtoupper(filter_input(INPUT_POST, 'item_description', FILTER_SANITIZE_STRING));
                    $data_prep['category_id'] = filter_input(INPUT_POST, 'stock_category', FILTER_SANITIZE_STRING);
                    $data_prep['item_typeid'] = filter_input(INPUT_POST, 'itemtype', FILTER_SANITIZE_STRING);
                    $data_prep['editionid'] = filter_input(INPUT_POST, 'itemedition', FILTER_SANITIZE_STRING);
                    $data_prep['publi_id'] = filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING);
                    $data_prep['purchase_price'] = filter_input(INPUT_POST, 'purchase_price', FILTER_SANITIZE_STRING);
                    $data_prep['selling_price'] = filter_input(INPUT_POST, 'selling_price', FILTER_SANITIZE_STRING);
                    //                        $this->session->set_flashdata('error_message', $status['message']);
                    echo json_encode(array('status' => 3, 'view' => '', 'message' => 'Validation Error'));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_item()
    {

        if ($this->input->is_ajax_request() == 1) {
            $item_id = strtoupper(filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_STRING));
            //            dev_export($item_id);die;  
            $data['title'] = 'GENERAL SETTINGS';
            $data['sub_title'] = 'ITEM MANAGEMENT';

            //Basic Data loading

            $publisher = $this->MItem->get_publishers();
            $item_type = $this->MItem->get_item_type();
            $item_edition = $this->MItem->get_item_edition();
            $stock_category = $this->MItem->get_stock_category();
            $item_list = $this->MItem->get_item_details($item_id);
            //            dev_export($item_list);die;     
            //verify basic data availability
            if (isset($publisher['data']) && !empty($publisher['data'])) {
                $data['publisher'] = $publisher['data'];
            } else {
                $data['publisher'] = NULL;
            }
            if (isset($item_type['data']) && !empty($item_type['data'])) {
                $data['itemtype'] = $item_type['data'];
            } else {
                $data['itemtype'] = NULL;
            }
            if (isset($item_edition['data']) && !empty($item_edition['data'])) {
                $data['item_edition'] = $item_edition['data'];
            } else {
                $data['item_edition'] = NULL;
            }
            if (isset($stock_category['data']) && !empty($stock_category['data'])) {
                $data['stock_category'] = $stock_category['data'];
            } else {
                $data['stock_category'] = NULL;
            }
            if (isset($item_list['data']) && !empty($item_list['data'])) {
                $data['item_list'] = $stock_category['data'];
            } else {
                $data['item_list'] = NULL;
            }
            $barcode = $item_list['data'][0]['barcode'];
            $data['barcode'] = $barcode;
            $item_description = $item_list['data'][0]['item_description'];
            $data['item_description'] = $item_description;
            $pub_id = $item_list['data'][0]['pub_id'];
            $data['pub_id'] = $pub_id;
            $cat_id = $item_list['data'][0]['cat_id'];
            $data['cat_id'] = $cat_id;
            $edition_id = $item_list['data'][0]['edition_id'];
            $data['edition_id'] = $edition_id;
            $type_id = $item_list['data'][0]['type_id'];
            $data['type_id'] = $type_id;

            //            dev_export($type_id);die;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('details/items_edit', $data, TRUE), 'barcode' => $barcode));
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function item_edit()
    {

        $data['user_name'] = $this->session->userdata('user_name');
        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'ITEM MANAGEMENT';

        $item_list = $this->MItem->get_all_item_list();

        if ($item_list['error_status'] == 0 && $item_list['data_status'] == 1) {
            $data['item_data'] = $item_list['data'];
            $data['message'] = "";
        } else {
            $data['item_data'] = FALSE;
            $data['message'] = $item_list['message'];
        }
        if ($this->input->is_ajax_request() == 1) {
            //            echo"123";die;
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['item_id'] = strtoupper(filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_STRING));
            $data_prep['item_name'] = strtoupper(filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING));
            $data_prep['item_code'] = strtoupper(filter_input(INPUT_POST, 'item_code', FILTER_SANITIZE_STRING));
            $data_prep['item_description'] = strtoupper(filter_input(INPUT_POST, 'item_description', FILTER_SANITIZE_STRING));
            $data_prep['cat_id'] = filter_input(INPUT_POST, 'stock_category', FILTER_SANITIZE_STRING);
            $data_prep['type_id'] = filter_input(INPUT_POST, 'itemtype', FILTER_SANITIZE_STRING);
            $data_prep['edition_id'] = filter_input(INPUT_POST, 'itemedition', FILTER_SANITIZE_STRING);
            $data_prep['pub_id'] = filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING);
            $data_prep['purchase_price'] = filter_input(INPUT_POST, 'purchase_price', FILTER_SANITIZE_STRING);
            $data_prep['selling_price'] = filter_input(INPUT_POST, 'selling_price', FILTER_SANITIZE_STRING);
            //                     dev_export($data_prep);die;                  
            $status = $this->MItem->edit_save_item($data_prep);
            //                    dev_export($status);die;


            if (is_array($status) && $status['status'] == 1) {
                $this->session->set_flashdata('success_message', $data_prep['item_name'] . " Updated Successfully");
                echo json_encode(array('status' => 1, 'view' => $this->load->view('details/show_details', $data, TRUE), 'message' => $status['message']));
                return;
            } else {
                $data_prep['item_name'] = strtoupper(filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING));
                $data_prep['item_code'] = strtoupper(filter_input(INPUT_POST, 'item_code', FILTER_SANITIZE_STRING));
                $data_prep['item_description'] = strtoupper(filter_input(INPUT_POST, 'item_description', FILTER_SANITIZE_STRING));
                $data_prep['cat_id'] = filter_input(INPUT_POST, 'stock_category', FILTER_SANITIZE_STRING);
                $data_prep['type_id'] = filter_input(INPUT_POST, 'itemtype', FILTER_SANITIZE_STRING);
                $data_prep['edition_id'] = filter_input(INPUT_POST, 'itemedition', FILTER_SANITIZE_STRING);
                $data_prep['pub_id'] = filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING);
                $data_prep['purchase_price'] = filter_input(INPUT_POST, 'purchase_price', FILTER_SANITIZE_STRING);
                $data_prep['selling_price'] = filter_input(INPUT_POST, 'selling_price', FILTER_SANITIZE_STRING);
                $this->session->set_flashdata('error_message', $status['message']);
                echo json_encode(array('status' => 2, 'view' => '', 'message' => $status['message']));
                return;
            }
            //          
        } else {
            $this->load->view(ERROR_500);
        }
    }



    public function update_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $item_id = filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($country_id);die;
            if (isset($item_id) && !empty($item_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['item_id'] = filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_STRING);
                $status = $this->MItem->edit_status_item($data_prep);
                if (isset($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status['message'], 'data' => ''));
                        return;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                        return;
                    }
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
