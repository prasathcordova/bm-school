<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OH_issue_controller
 *
 * @author Aju S Aravind
 */
class OH_issue_controller extends MX_Controller{
    
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
        $this->load->model('OH_issue_model', 'Omodel');
        
    }
    
    
    
     public function OH_issue() {
//        $data['template'] = 'OH/OH_issue';
//        $data['title'] = 'STORE SETTINGS';
        $data['sub_title'] = ' OH ISSUE';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Stock Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'issue Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $country_data = $this->Omodel->oh_issue();
        $data['user_name'] = $this->session->userdata('user_name');
        if ($country_data['error_status'] == 0 && $country_data['data_status'] == 1) {
            $data['country_data'] = $country_data['data'];
            $data['message'] = "";
        } else {
            $data['country_data'] = FALSE;
            $data['message'] = $country_data['message'];
        }


        $this->session->set_userdata('current_page', 'transfer');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['country_data']) && !empty($data['country_data'])) {
                foreach ($data['country_data'] as $country) {
                    $country_status = "";
                    if ($country['isactive'] == 1) {
                        $country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    } else {
                        $country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($country['country_name'], $country['country_abbr'], $country['currency_name'], $country_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('ohtemplate/OH_kit_issue', $data);
        }
    }
     public function OH_group_issue() {
//        $data['template'] = 'OH/OH_group_issue';
//        $data['title'] = 'STORE SETTINGS';
        $data['sub_title'] = ' OH GROUP ISSUE';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Stock Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'issue Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $country_data = $this->Omodel->oh_group_issue();
        $data['user_name'] = $this->session->userdata('user_name');
        if ($country_data['error_status'] == 0 && $country_data['data_status'] == 1) {
            $data['country_data'] = $country_data['data'];
            $data['message'] = "";
        } else {
            $data['country_data'] = FALSE;
            $data['message'] = $country_data['message'];
        }


        $this->session->set_userdata('current_page', 'transfer');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['country_data']) && !empty($data['country_data'])) {
                foreach ($data['country_data'] as $country) {
                    $country_status = "";
                    if ($country['isactive'] == 1) {
                        $country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    } else {
                        $country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($country['country_name'], $country['country_abbr'], $country['currency_name'], $country_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('ohtemplate/OH_group_issue', $data);
        }
    }
     public function Item_delivery() {
//        $data['template'] = 'OH/OH_group_issue';
//        $data['title'] = 'STORE SETTINGS';
        $data['sub_title'] = 'SALE DELIVERY - OH / OTHER';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Stock Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'item delivery')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $country_data = $this->Omodel->oh_group_issue();
        $data['user_name'] = $this->session->userdata('user_name');
        if ($country_data['error_status'] == 0 && $country_data['data_status'] == 1) {
            $data['country_data'] = $country_data['data'];
            $data['message'] = "";
        } else {
            $data['country_data'] = FALSE;
            $data['message'] = $country_data['message'];
        }


        $this->session->set_userdata('current_page', 'transfer');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['country_data']) && !empty($data['country_data'])) {
                foreach ($data['country_data'] as $country) {
                    $country_status = "";
                    if ($country['isactive'] == 1) {
                        $country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    } else {
                        $country_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $country['country_id'] . '\',\'' . $country['country_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $country['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $country['country_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($country['country_name'], $country['country_abbr'], $country['currency_name'], $country_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('ohtemplate/item_delivery', $data);
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
        $acdyr = $this->Omodel->get_all_acadyr();
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

        $batch_data = $this->Omodel->get_batch_details_for_filter($this->session->userdata('acd_year'));
//        dev_export($batch_data);die;
        if (isset($batch_data['data']) && !empty($batch_data['data'])) {
            $data['batch_data'] = $batch_data['data'];
        } else {
            $data['batch_data'] = NULL;
        }
        $batch_count = $this->Omodel->no_batch_count($this->session->userdata('acd_year'));
//        dev_export($batch_count);die;
        if (isset($batch_count['data']) && !empty($batch_count['data'])) {
            $data['batch_count_no_batch'] = $batch_count['data'][0]['counts'];
        } else {
            $data['batch_count_no_batch'] = 0;
        }


//        dev_export($batch_data);
//        die;



        $this->load->view('ohtemplate/student_filter', $data);
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
            $details_data = $this->Omodel->get_all_studentdata($acd_year_id, $batchid);

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
            echo json_encode(array('status' => 1, 'view' => $this->load->view('ohtemplate/profile', $data, TRUE)));
            return TRUE;
        }
    }
     public function items_adding() {
//        $data['sub_title'] = 'STOCK MANAGEMENT';
       
        $data['user_name'] = $this->session->userdata('user_name');
       

        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');

        
            $this->load->view('stock/Ohpack_itemadd',$data);
            
        
    }
}