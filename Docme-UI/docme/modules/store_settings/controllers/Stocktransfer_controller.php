<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stocktransfer_controller
 *
 * @author chandrajith.edsys
 */
class Stocktransfer_controller extends MX_Controller{
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
        $this->load->model('Stocktransfer_model', 'Mstocktransfer');
    }
    public function stocktransfer_intend() {
     
//       $data['template'] = 'language/show_language';
        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'STOCK TRANSFER INTEND';
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
               
         $publisher_data = $this->Mstocktransfer->get_all_publisher_list();
        // dev_export($publisher_data);die;
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
            if (isset($data['publisher_data']) && !empty($data['publisher_data'])) {
                foreach ($data['publisher_data'] as $publisher) {
                    $publisher_status = "";
                    if ($publisher['isactive'] == 1) {
                        $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['id'] . '\',\'' . $publisher['id'] . '\', this)" checked id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" checked id="" class="js-switch"  />';
                    } else {
                        $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['id'] . '\',\'' . $publisher['id'] . '\', this)" id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" id="" class="js-switch"  />';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_publisher(\'' . $publisher['id'] . '\',\'' . $publisher['language_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $language['language_name'] . '" data-original-title="' . $publisher['name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($publisher['name'], $publisher_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('stocktransfer/stock_transferintend', $data);
        }
    }
    public function sub_stocktransfer_intend() {
     
//       $data['template'] = 'language/show_language';
        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'STOCK TRANSFER INTEND';
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
               
         $publisher_data = $this->Mstocktransfer->get_all_publisher_list();
        // dev_export($publisher_data);die;
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
            if (isset($data['publisher_data']) && !empty($data['publisher_data'])) {
                foreach ($data['publisher_data'] as $publisher) {
                    $publisher_status = "";
                    if ($publisher['isactive'] == 1) {
                        $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['id'] . '\',\'' . $publisher['id'] . '\', this)" checked id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" checked id="" class="js-switch"  />';
                    } else {
                        $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['id'] . '\',\'' . $publisher['id'] . '\', this)" id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" id="" class="js-switch"  />';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_publisher(\'' . $publisher['id'] . '\',\'' . $publisher['language_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $language['language_name'] . '" data-original-title="' . $publisher['name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($publisher['name'], $publisher_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('stocktransfer/stock_transferintend_sub', $data);
        }
    }
    public function stocktransfer_recieve() {
     
//       $data['template'] = 'language/show_language';
        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'STOCK TRANSFER INTEND';
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
               
         $publisher_data = $this->Mstocktransfer->get_all_publisher_list();
        // dev_export($publisher_data);die;
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
            if (isset($data['publisher_data']) && !empty($data['publisher_data'])) {
                foreach ($data['publisher_data'] as $publisher) {
                    $publisher_status = "";
                    if ($publisher['isactive'] == 1) {
                        $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['id'] . '\',\'' . $publisher['id'] . '\', this)" checked id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" checked id="" class="js-switch"  />';
                    } else {
                        $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['id'] . '\',\'' . $publisher['id'] . '\', this)" id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" id="" class="js-switch"  />';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_publisher(\'' . $publisher['id'] . '\',\'' . $publisher['language_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $language['language_name'] . '" data-original-title="' . $publisher['name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($publisher['name'], $publisher_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('stocktransfer/show_transferreceive', $data);
        }
    }
    public function stocktransfer_issue() {
     
//       $data['template'] = 'language/show_language';
        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'STOCK TRANSFER ISSUE';
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
               
         $publisher_data = $this->Mstocktransfer->get_all_publisher_list();
        // dev_export($publisher_data);die;
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
            if (isset($data['publisher_data']) && !empty($data['publisher_data'])) {
                foreach ($data['publisher_data'] as $publisher) {
                    $publisher_status = "";
                    if ($publisher['isactive'] == 1) {
                        $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['id'] . '\',\'' . $publisher['id'] . '\', this)" checked id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" checked id="" class="js-switch"  />';
                    } else {
                        $publisher_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $publisher['id'] . '\',\'' . $publisher['id'] . '\', this)" id="" class="js-switch"  /></a>';
//                        $language_status = '<input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status(\'' . $language['language_id'] . '\', this)" id="" class="js-switch"  />';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_publisher(\'' . $publisher['id'] . '\',\'' . $publisher['language_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $language['language_name'] . '" data-original-title="' . $publisher['name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($publisher['name'], $publisher_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('stocktransfer/show_transferissue', $data);
        }
    }
}
