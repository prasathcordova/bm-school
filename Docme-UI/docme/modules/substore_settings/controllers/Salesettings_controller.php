<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Salesettings_controller
 *
 * @author chandrajith.edsys
 */
class Salesettings_controller extends MX_Controller {

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
        $this->load->model('Saleissue_model', 'MSaleissue');
    }

    public function sale_issue() {
//        $data['template'] = 'itemtype/show_item';
//        $data['title'] = 'Specimen Issue';
        $data['sub_title'] = 'SALES ISSUE - STUDENTS';
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
        $itemtype_data = $this->MSaleissue->get_all_publisher_list();
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
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['itemtype_id'] . '\',\'' . $itemtype['itemtype_name'] . '\',\'' . $itemtype['itemtype_code'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $itemtype['itemtype_name'] . '" data-original-title="Edit ' . $itemtype['itemtype_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $itemtype['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($itemtype['itemtype_name'], $itemtype['itemtype_code'], $itemtype_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('sale/show_saleissue', $data);
        }
    }

    public function specimen_issue_bak2() {
//        $data['template'] = 'itemtype/show_item';
//        $data['title'] = 'Specimen Issue';
        $data['sub_title'] = 'SPECIMEN ISSUE';
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
        $itemtype_data = $this->MSaleissue->get_all_publisher_list();
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
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['itemtype_id'] . '\',\'' . $itemtype['itemtype_name'] . '\',\'' . $itemtype['itemtype_code'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $itemtype['itemtype_name'] . '" data-original-title="Edit ' . $itemtype['itemtype_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $itemtype['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($itemtype['itemtype_name'], $itemtype['itemtype_code'], $itemtype_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('sale/specimen_issue', $data);
        }
    }
      public function specimen_issue() {
//        $data['template'] = 'sale/profile_staff';
        $data['title'] = 'Specimen Issue';
        $data['sub_title'] = 'Staff Profile';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '2' => array(
                'title' => 'specimen Issue')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);

       
        $user_data = $this->MSaleissue->get_all_user_list();
//        dev_export($user_data);die;
        if ($user_data['error_status'] == 0 && $user_data['data_status'] == 1) {
            $data['user_data'] = $user_data['data'];
            $data['message'] = "";
        } else {
            $data['user_data'] = FALSE;
            $data['message'] = $user_data['message'];
        }
        $data['user_data'] = $user_data['data'];
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {

        } else {
            $this->load->view('sale/profile_staff', $data);
        }
    }
    public function specimen_issue_bill() {
//        $data['template'] = 'itemtype/show_item';
//        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $data['sub_title'] = 'SPECIMEN ISSUE';
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
        $itemtype_data = $this->MSaleissue->get_all_publisher_list();
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
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['itemtype_id'] . '\',\'' . $itemtype['itemtype_name'] . '\',\'' . $itemtype['itemtype_code'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $itemtype['itemtype_name'] . '" data-original-title="Edit ' . $itemtype['itemtype_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $itemtype['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($itemtype['itemtype_name'], $itemtype['itemtype_code'], $itemtype_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('sale/specimen_item_purchase', $data);
        }
    }

    public function show_item() {
//        $data['template'] = 'itemtype/show_item';
//        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $data['sub_title'] = 'ITEMS LIST';
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
        $itemtype_data = $this->MSaleissue->get_all_publisher_list();
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
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['itemtype_id'] . '\',\'' . $itemtype['itemtype_name'] . '\',\'' . $itemtype['itemtype_code'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $itemtype['itemtype_name'] . '" data-original-title="Edit ' . $itemtype['itemtype_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $itemtype['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($itemtype['itemtype_name'], $itemtype['itemtype_code'], $itemtype_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('sale/items_list', $data);
        }
    }

    public function add_item() {
//        $data['template'] = 'itemtype/show_item';
//        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $data['sub_title'] = 'ITEMS ';
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
        $itemtype_data = $this->MSaleissue->get_all_publisher_list();
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
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['itemtype_id'] . '\',\'' . $itemtype['itemtype_name'] . '\',\'' . $itemtype['itemtype_code'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $itemtype['itemtype_name'] . '" data-original-title="Edit ' . $itemtype['itemtype_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $itemtype['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($itemtype['itemtype_name'], $itemtype['itemtype_code'], $itemtype_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('stock/items_add', $data);
        }
    }

    /* Author chandrajith */

    public function load_studentfilter() {
//        $data['template'] = 'sale/student_filter';
        $data['title'] = 'STUDENT PROFILE';
        $data['sub_title'] = 'STUDENT PROFILE';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Student Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');


//        ACD YEAR DATA
        $acdyr = $this->MSaleissue->get_all_acadyr();
        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
            if ($acdyr['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $data['acdyr_data'] = $acdyr['data'];

        $batch_data = $this->MSaleissue->get_batch_details_for_filter($this->session->userdata('acd_year'));
//        dev_export($batch_data);die;
        if (isset($batch_data['data']) && !empty($batch_data['data'])) {
            $data['batch_data'] = $batch_data['data'];
        } else {
            $data['batch_data'] = NULL;
        }
        $batch_count = $this->MSaleissue->no_batch_count($this->session->userdata('acd_year'));
//        dev_export($batch_count);die;
        if (isset($batch_count['data']) && !empty($batch_count['data'])) {
            $data['batch_count_no_batch'] = $batch_count['data'][0]['counts'];
        } else {
            $data['batch_count_no_batch'] = 0;
        }


//        dev_export($batch_data);
//        die;



        $this->load->view('sale/student_filter', $data);
    }

    public function show_student_profile() {
        if ($this->input->is_ajax_request() == 1) {
//        $data['template'] = 'student_profile/profile';
            $data['title'] = 'STUDENT PROFILE [KG1/A/CBS/FN/ENG/2017-18]';
            $data['sub_title'] = 'Student Profile';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'),
                '1' => array(
                    'link' => base_url('profile/show-class-for-students'),
                    'title' => 'Batch'
                ),
                '2' => array(
                    'title' => 'Student Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            $details_data = $this->MSaleissue->get_all_studentdata($acd_year_id, $batchid);

//        dev_export($details_data)  ;die; 
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['batchid'] = $batchid;
            $data['user_name'] = $this->session->userdata('user_name');
            $data['acdyr_id'] = $acd_year_id;
            $data['batch_id'] = $batchid;
//            $this->load->view('sale/profile', $data);
            echo json_encode(array('status' => 1, 'view' => $this->load->view('sale/profile', $data, TRUE)));
            return TRUE;
        }
    }
    public function oh_billing() {
        
//        $data['template'] = 'itemtype/show_item';
//        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $data['sub_title'] = 'SALES ISSUE - STUDENTS';
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
        $itemtype_data = $this->MSaleissue->get_all_publisher_list();
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
                     $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['itemtype_id'] . '\',\'' . $itemtype['itemtype_name'] . '\',\'' . $itemtype['itemtype_code'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $itemtype['itemtype_name'] . '" data-original-title="Edit ' . $itemtype['itemtype_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $itemtype['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($itemtype['itemtype_name'], $itemtype['itemtype_code'], $itemtype_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('sale/show_saleissue', $data);
        }
    }
    
    public function oth_billing() {
        
//        $data['template'] = 'itemtype/show_item';
//        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $data['sub_title'] = 'SALES ISSUE - STUDENTS';
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
        $itemtype_data = $this->MSaleissue->get_all_publisher_list();
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
                     $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['itemtype_id'] . '\',\'' . $itemtype['itemtype_name'] . '\',\'' . $itemtype['itemtype_code'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $itemtype['itemtype_name'] . '" data-original-title="Edit ' . $itemtype['itemtype_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $itemtype['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $itemtype['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($itemtype['itemtype_name'], $itemtype['itemtype_code'], $itemtype_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('sale/show_otherbill', $data);
        }
    }
    
    /* Author : Rahul
     * Purpose : Search teachers by name 
     */

    public function search_teachername() {
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $data['title'] = 'Specimen Issue';
        $data['sub_title'] = 'Staff Profile';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '2' => array(
                'title' => 'specimen Issue')
        );

        $teacher_name = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);


        $user_data = $this->MSaleissue->get_all_user_list_byname($teacher_name);
//        dev_export($user_data);die;
        if ($user_data['error_status'] == 0 && $user_data['data_status'] == 1) {
            $data['user_data'] = $user_data['data'];
            $data['message'] = "";
        } else {
            $data['user_data'] = FALSE;
            $data['message'] = $user_data['message'];
}

        $data['user_data'] = $user_data['data'];
        $data['user_name'] = $this->session->userdata('user_name');
        echo json_encode(array('status' => 1, 'view' => $this->load->view('sale/search_techr_name', $data, TRUE)));
        return TRUE;
    }
   public function save_emp_specimen_issue() {
        
        if ($this->input->is_ajax_request() == 1) {
            $emp_id = filter_input(INPUT_POST, 'emp_id', FILTER_SANITIZE_NUMBER_INT);
            $final_item_string = filter_input(INPUT_POST, 'final_item_string');
            $total_qty = filter_input(INPUT_POST, 'total_qty', FILTER_SANITIZE_STRING);
            $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);
            $final_order_value = filter_input(INPUT_POST, 'net_value', FILTER_SANITIZE_STRING);
            $roundoff = filter_input(INPUT_POST, 'roundoff');
            $tax_price = filter_input(INPUT_POST, 'tax_price');
//            dev_export($roundoff);die;
            if($roundoff == 0){
               $roundoff = -1;
            }
            if($tax_price == 0){
               $tax_price = -1;
            }
            


            if (isset($emp_id) && !empty($emp_id) && isset($final_item_string) && !empty($final_item_string)) {

                $data_prep = array(
                    'action' => 'save_packing_faculty',
                    'final_format_data' => $final_item_string,
                    'emply_id' => $emp_id,
                    'total_qty' => $total_qty,
                    'sub_total' => $sub_total,
                    'final_order_value' => $final_order_value,
                    'roundoff' => $roundoff,
                    'tax_price' => $tax_price
                    
                );

                $status = $this->MSaleissue->save_emp_specimen_issue($data_prep);
//                dev_export($status);die;
                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully', 'bill_no' => $status['bill_no']));
                    return true;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 3, 'message' => $status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'message' => 'An error encountered. Please try again or contact administrator with error code : EPS1001'));
                        return true;
                    }
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Supplier data / Item data is required.'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }
    
    
    public function search_item() {
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $store_id = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_NUMBER_INT);
        
        $search_item = strtoupper(filter_input(INPUT_POST, 'search_item', FILTER_SANITIZE_STRING));
       
       

        $user_data = $this->MSaleissue->get_all_item_with_search($search_item,$store_id);
//        dev_export($user_data);die;
        if ($user_data['error_status'] == 0 && $user_data['data_status'] == 1) {
            $data['user_data'] = $user_data['data'];
            $data['message'] = "";
        } else {
            $data['user_data'] = FALSE;
            $data['message'] = $user_data['message'];
        }

        $data['user_data'] = $user_data['data'];
        $data['user_name'] = $this->session->userdata('user_name');
//        dev_export($data['user_data']);die;
        echo json_encode(array('status' => 1, 'view' => $this->load->view('packing/search_item', $data, TRUE)));
            return TRUE;
    }

    public function save_student_item_issue() {
        
        if ($this->input->is_ajax_request() == 1) {
            $std_id = filter_input(INPUT_POST, 'std_id', FILTER_SANITIZE_NUMBER_INT);
            $final_item_string = filter_input(INPUT_POST, 'final_item_string');
            $total_qty = filter_input(INPUT_POST, 'total_qty', FILTER_SANITIZE_STRING);
            $sub_total = filter_input(INPUT_POST, 'sub_total', FILTER_SANITIZE_STRING);
            $final_order_value = filter_input(INPUT_POST, 'net_value', FILTER_SANITIZE_STRING);
            $reminder = filter_input(INPUT_POST, 'reminder');
            $tax_price = filter_input(INPUT_POST, 'tax_price');
            
//            dev_export($reminder);
//            dev_export($tax_price);die;

            if (isset($std_id) && !empty($std_id) && isset($final_item_string) && !empty($final_item_string)) {

                $data_prep = array(
                    'action' => 'save_packing_student',
                    'final_format_data' => $final_item_string,
                    'student_id' => $std_id,
                    'total_qty' => $total_qty,
                    'sub_total' => $sub_total,
                    'final_order_value' => $final_order_value,
                    'roundoff' => $reminder,
                    'tax_price' => $tax_price
                );

                $status = $this->MSaleissue->save_student_item_issue($data_prep);
                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully', 'packing_code' => $status['packing_code']));
                    return true;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 3, 'message' => $status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'message' => 'An error encountered. Please try again or contact administrator with error code : EPS1001'));
                        return true;
                    }
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'student data / Item data is required.'));
                return true;
            }
        } else {
            $this->load->view('template/error-500');
        }
    }

}
