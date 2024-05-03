<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales_controller
 *
 * @author chandrajith.edsys
 */
class Sales_controller extends MX_Controller
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
        $this->load->model('Sales_model', 'MSales');
        $this->load->model('student_settings/Registration_model', 'MRegistration');
        $this->load->model('student_settings/Student_model', 'MStudent');
        $this->load->model('store_settings/Itemdetails_management_model', 'MItem');
        $this->load->model('OH_packing_model', 'OHPModel');
        $this->load->model('course_settings/Batch_model', 'Batch_model');
        //        $this->load->model('Bookstore_settings/Stock_model', 'MStock');
    }

    public function sales()
    {
        //        $data['template'] = 'itemtype/show_item';
        //        $data['title'] = 'ITEM TYPE MANAGEMENT';
        $data['sub_title'] = 'ITEM TYPE MANAGEMENT';
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
                'title' => 'Item Type Management'
            )
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

    public function show_student_sale()
    {
        $data['sub_title'] = 'STUDENT SALE';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('sale/student_sale', $data);
    }

    public function show_employee_sale()
    {
        $data['sub_title'] = 'Employee SALE';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('sale/employee_sale', $data);
    }

    public function invoice_generation()
    {
        $data['sub_title'] = 'Token';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('sale/employee_invoice', $data);
    }

    public function items_packing()
    {
        $data['title'] = 'Item Packing';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('sale/item_packing', $data);
    }

    public function items_individualpacking()
    {
        $data['title'] = 'Item Packing';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('sale/item_individualpack', $data);
    }

    public function items_stpacking_search()
    {
        $data['title'] = 'Student Search';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('sale/item_student_search', $data);
    }

    public function items_studpacking()
    {
        $data['title'] = 'Student Search';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('sale/student_sale', $data);
    }

    public function items_emppacking_search()
    {
        $data['title'] = 'Employee Search';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('sale/item_employee_search', $data);
    }

    public function items_emp_search()
    {
        $data['sub_title'] = 'Employee Search';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $this->load->view('sale/item_empl_search', $data);
    }

    public function class_loosepacking()
    {

        $data['sub_title'] = 'Loose Packing';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Item Packing',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Class wise Packing'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $batch_data = $this->MRegistration->get_batch_details_for_filter($this->session->userdata('acd_year'));
        //        dev_export($batch_data);die;
        if (isset($batch_data['data']) && !empty($batch_data['data'])) {
            $data['batch_data'] = $batch_data['data'];
        } else {
            $data['batch_data'] = NULL;
        }
        $batch_count = $this->MRegistration->no_batch_count($this->session->userdata('acd_year'));
        //        dev_export($batch_count);die;
        if (isset($batch_count['data']) && !empty($batch_count['data'])) {
            $data['batch_count_no_batch'] = $batch_count['data'][0]['counts'];
        } else {
            $data['batch_count_no_batch'] = 0;
        }
        $acdyr = $this->MRegistration->get_all_acadyr();
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
        $this->load->view('packing/item_classpacking', $data);
    }

    public function batch_loosepacking()
    {

        $data['sub_title'] = 'Loose Packing';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Item Packing',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Batch wise Packing'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $batch_data = $this->MRegistration->get_batch_details_for_filter($this->session->userdata('acd_year'));
        //        dev_export($batch_data);die;
        if (isset($batch_data['data']) && !empty($batch_data['data'])) {
            $data['batch_data'] = $batch_data['data'];
        } else {
            $data['batch_data'] = NULL;
        }
        $batch_count = $this->MRegistration->no_batch_count($this->session->userdata('acd_year'));
        //        dev_export($batch_count);die;
        if (isset($batch_count['data']) && !empty($batch_count['data'])) {
            $data['batch_count_no_batch'] = $batch_count['data'][0]['counts'];
        } else {
            $data['batch_count_no_batch'] = 0;
        }
        $this->load->view('packing/item_batchpacking', $data);
    }

    public function batch_list()
    {

        $data['sub_title'] = 'Loose Packing';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Item Packing',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Batch wise Packing'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $courseid = filter_input(INPUT_POST, 'classid', FILTER_SANITIZE_NUMBER_INT);


        $batch_data = $this->MStudent->get_all_batchdata($courseid, $this->session->userdata('acd_year'));
        //         dev_export($batch_data);die;
        if (isset($batch_data['data']) && !empty($batch_data['data'])) {
            $data['batch_data'] = $batch_data['data'];
        } else {
            $data['batch_data'] = NULL;
        }



        $this->load->view('packing/packing_batchlistview', $data);
    }

    //student batch list saranya 24/12/2017
    public function show_student_profile_substore()
    {
        if ($this->input->is_ajax_request() == 1) {
            //        $data['template'] = 'student_profile/profile';

            $data['sub_title'] = 'Student Profile';
            //            $breadcrump = array(
            //                '0' => array(
            //                    'link' => base_url('dashboard'),
            //                    'title' => 'Home'),
            //                '1' => array(
            //                    'link' => base_url('profile/show-class-for-students'),
            //                    'title' => 'Batch'
            //                ),
            //                '2' => array(
            //                    'title' => 'Student Management'
            //                )
            //            );
            //            $data['bread_crump_data'] = bread_crump_maker($breadcrump);


            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($batchid)  ;die; 
            $details_data = $this->MRegistration->get_all_studentdata($acd_year_id, $batchid);
            $batch = $this->Batch_model->get_batch_details($batchid);
            //        dev_export($batch)  ;die; 
            $data['title'] = 'STUDENTS - ' . $batch['data'][0]['Batch_Name'];
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

            echo json_encode(array('status' => 1, 'view' => $this->load->view('packing/profile', $data, TRUE)));
            return TRUE;
        }
    }

    public function class_list()
    {

        $data['sub_title'] = 'Loose Packing';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Item Packing',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Class wise Packing'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $courseid = filter_input(INPUT_POST, 'classid', FILTER_SANITIZE_NUMBER_INT);

        $batch_data = $this->MStudent->get_all_batchdata($courseid, $this->session->userdata('acd_year'));
        //         dev_export($batch_data);die;
        if (isset($batch_data['data']) && !empty($batch_data['data'])) {
            $data['batch_data'] = $batch_data['data'];
        } else {
            $data['batch_data'] = NULL;
        }



        $this->load->view('packing/packing_classview', $data);
    }

    public function specimen_issue()
    {
        //        $data['template'] = 'sale/profile_staff';
        $data['title'] = 'Specimen Issue';
        $data['sub_title'] = 'Staff Profile';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '2' => array(
                'title' => 'specimen Issue'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);


        $user_data = $this->MSales->get_all_user_list();
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

    public function specimen_packing()
    {

        $data['sub_title'] = 'Loose Packing';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Item Packing',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Batch wise Packing'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $empid = filter_input(INPUT_POST, 'Empid', FILTER_SANITIZE_NUMBER_INT);

        $emp_data = $this->MSales->get_empid($empid);
        //         dev_export($empid);die;
        if (isset($emp_data['data']) && !empty($emp_data['data'])) {
            $data['emp'] = $emp_data['data'][0];
        } else {
            $data['emp'] = NULL;
        }
        $store_id = $this->session->userdata('store_id');;
        //        dev_export($store_id);die;
        $item_data = $this->MSales->get_all_items($store_id);
        //         dev_export($item_data);die;
        if (isset($item_data['data']) && !empty($item_data['data'])) {
            $data['item_data'] = $item_data['data'];
        } else {
            $data['item_data'] = NULL;
        }

        $data['store_idd'] = $store_id;

        $this->load->view('packing/item_specimenpacking', $data);
    }

    public function loose_packing_student()
    {

        $data['sub_title'] = 'Loose Packing';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Item Packing',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Batch wise Packing'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $std_id = filter_input(INPUT_POST, 'std_id', FILTER_SANITIZE_NUMBER_INT);

        $student_data = $this->MRegistration->get_profiles_student($std_id);
        //                dev_export($student_data);die;

        if ($student_data['error_status'] == 0 && $student_data['data_status'] == 1) {
            $data['student_data'] = $student_data['data'][0];
            $data['batch_select'] = $student_data['data'][0]['Cur_Batch'];
            $student_cur_year = $student_data['data'][0]['Cur_AcadYr'];
            $data['student_cur_year'] = $student_data['data'][0]['Cur_AcadYr'];
            $data['message'] = "";
        } else {
            $data['student_data'] = FALSE;
            $data['message'] = $student_data['message'];
        }
        $store_id = $this->session->userdata('store_id');;

        $item_data = $this->MSales->get_all_items($store_id);
        //        print_r($item_data);die;
        if (isset($item_data['data']) && !empty($item_data['data'])) {
            $data['item_data'] = $item_data['data'];
        } else {
            $data['item_data'] = NULL;
        }

        $data['store_idd'] = $store_id;
        if ($item_data['error_status'] == 0 && $item_data['data_status'] == 1) {
            $data['item_data'] = $item_data['data'];
            $data['message'] = "";
        } else {
            $data['item_data'] = FALSE;
            $data['message'] = $item_data['message'];
        }



        $this->load->view('packing/item_loosepacking', $data);
    }

    public function search_student()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['acy_yr'] = filter_input(INPUT_POST, 'acdyr_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            //            dev_export($data_prep);die;
            //            $data_prep['flag'] = 5;
            //            $batchid = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            //            if ($batchid == -1) {
            //                $data_prep['batch_id'] = 0;
            //            } else {
            //                $data_prep['batch_id'] = $batchid;
            //            }
            //             dev_export($data_prep);die;
            $details_data = $this->MSales->search($data_prep);
            //           dev_export($details_data);die;
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            //            $data['batchid'] = $batchid;
            $data['acdyr_id'] = $data_prep['acy_yr'];
            //            $data['batch_id'] = $data_prep['batch_id'];
            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('packing/search_student', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function bill_test()
    {
        $data['sub_title'] = 'Employee Search';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');

        //        STREAM DATA
        $stream = $this->MRegistration->get_all_stream();
        if (isset($stream['error_status']) && $stream['error_status'] == 0) {
            if ($stream['data_status'] == 1) {
                $data['stream_data'] = $stream['data'];
            } else {
                $data['stream_data'] = FALSE;
            }
        } else {
            $data['stream_data'] = FALSE;
        }
        $data['stream_data'] = $stream['data'];

        //        CLASS DATA
        $class = $this->MRegistration->get_all_class();
        //        dev_export($class);die;
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data_for_registration'] = $class['data'];
            } else {
                $data['class_data_for_registration'] = FALSE;
            }
        } else {
            $data['class_data_for_registration'] = FALSE;
        }
        //        ACD YEAR DATA
        $acdyr = $this->OHPModel->get_all_acadyr();
        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
            if ($acdyr['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $batch = $this->OHPModel->get_all_batch($this->session->userdata('acd_year'));
        //        dev_export($class);die;
        if (isset($batch['error_status']) && $batch['error_status'] == 0) {
            if ($batch['data_status'] == 1) {
                $data['batch_data'] = $batch['data'];
            } else {
                $data['batch_data'] = FALSE;
            }
        } else {
            $data['batch_data'] = FALSE;
        }


        $this->load->view('bill/billtest', $data);
    }

    public function search_byname()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            //            $data_prep['acy_yr'] = filter_input(INPUT_POST, 'acdyr_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            //            $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_NUMBER_INT));
            //            $data_prep['first_name'] = filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($data_prep['first_name']);die;
            //            dev_export($data_prep);die;
            $details_data = $this->MSales->student_search($data_prep);
            //            dev_export($details_data);die;
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('bill/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function advancesearch_byname()
    {                                               //display students list on search
        $data['title'] = 'STUDENTS LIST';
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {

            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            //            $data_prep['batch_id'] = 46;
            //            $data_prep['stream_id'] = 1;
            //            $data_prep['class_id'] = 1;
            ////            $data_prep['curent_acdyr'] = filter_input(INPUT_POST, 'curent_acdyr', FILTER_SANITIZE_NUMBER_INT);
            ////            $data_prep['inst_id'] = filter_input(INPUT_POST, 'inst_id', FILTER_SANITIZE_NUMBER_INT);
            //            $data_prep['curent_acdyr'] = 21;
            //            $data_prep['inst_id'] = 5;
            //            ;
            //            $data_prep['searchname'] = 'm';

            /* need to use this code the above is for testing */
            $data_prep['batch_id'] = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['stream_id'] = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['class_id'] = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['curent_acdyr'] = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);

            $data_prep['searchname'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            if ($data_prep['stream_id'] == -1) {
                $data_prep['stream_id'] = '';
            }
            if ($data_prep['curent_acdyr'] == -1) {
                $data_prep['curent_acdyr'] = '';
            }
            if ($data_prep['class_id'] == -1) {
                $data_prep['class_id'] = '';
            }

            $details_data = $this->MSales->studentadvance_search($data_prep);
            //            dev_export($details_data);
            //            die;
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('bill/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function batchlist_bak()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);

            $stream_id = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $academic_year = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);

            if ($stream_id == -1) {
                $stream_id = '';
            }
            if ($academic_year == -1) {
                $academic_year = '';
            }
            if ($class_id == -1) {
                $class_id = '';
            }


            $details_data = $this->OHPModel->get_batch_data($stream_id, $academic_year, $session_id, $class_id, $flag_status);
            //            $details_data = $this->MSales->studentbillbatch_search($data_prep);
            //            dev_export($details_data);die;
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('bill/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function batchlist()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($class_id);die;
            $stream_id = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $academic_year = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $session_id = NULL;
            $flag_status = NULL;
            if ($stream_id == -1) {
                $stream_id = NULL;
            }
            if ($academic_year == -1) {
                $academic_year = NULL;
            }
            if ($class_id == -1) {
                $class_id = NULL;
            }
            //            dev_export(array($stream_id, $academic_year, $session_id, $class_id, $flag_status));

            $details_data = $this->OHPModel->get_batch_data($stream_id, $academic_year, $session_id, $class_id, $flag_status);

            if (isset($details_data['error_status']) && $details_data['error_status'] == 0) {
                if ($details_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $details_data['data']));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    public function search_studentname()
    {
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $data['title'] = 'Student Bill';
        $data['sub_title'] = 'Student Bill';

        $student_id = strtoupper(filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_STRING));

        $details_data = $this->MRegistration->get_profiles_student($student_id);
        if (isset($details_data['data']) && !empty($details_data['data'])) {
            $data['details_data'] = $details_data['data'];
        } else {
            $data['details_data'] = NULL;
        }

        $pack_list = $this->MSales->get_all_pack_list($student_id);

        if (isset($pack_list['data']) && !empty($pack_list['data'])) {
            $data['pack_list'] = $pack_list['data'];
        } else {
            $data['pack_list'] = NULL;
        }
        $this->load->view('bill/studentbill', $data);
    }

    public function search_packdetails()
    {

        $data['title'] = 'Student Bill';
        $data['sub_title'] = 'Student Bill';

        if ($this->input->is_ajax_request() == 1) {
            $pack_id = strtoupper(filter_input(INPUT_POST, 'packid', FILTER_SANITIZE_STRING));
            $std_id = strtoupper(filter_input(INPUT_POST, 'std_id', FILTER_SANITIZE_STRING));
            $barcode = strtoupper(filter_input(INPUT_POST, 'barcode', FILTER_SANITIZE_STRING));
            $del_payment_type = strtoupper(filter_input(INPUT_POST, 'del_payment_type', FILTER_SANITIZE_STRING));

            $pack_data = $this->MSales->get_student_pack($std_id, $pack_id);

            if (!empty($pack_data['data'])) {
                $data['pack_data'] = $pack_data['data'][0];
            } else {
                $data['pack_data'] = NULL;
            }

            $payment_data = $this->MSales->get_payment_details($pack_id);

            if (!empty($payment_data['data'])) {
                $data['payment_data'] = $payment_data['data'];
            } else {
                $data['payment_data'] = NULL;
            }

            $details_data = $this->MSales->get_bill_pack_details($pack_id);
            // dev_export($pack_data);
            // die;
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['details_data'] = $details_data['data'];
            } else {
                $data['details_data'] = NULL;
            }
            //            dev_export($details_data);die;
            $data['std_id'] = $std_id;
            $data['pack_id'] = $pack_id;
            $data['barcode'] = $barcode;
            $data['del_payment_type'] = $del_payment_type;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('bill/pack_details_view', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function search_billdetails()
    {

        $data['title'] = 'Student Bill';
        $data['sub_title'] = 'Student Bill';

        if ($this->input->is_ajax_request() == 1) {
            $billid = strtoupper(filter_input(INPUT_POST, 'billid', FILTER_SANITIZE_STRING));
            $std_id = strtoupper(filter_input(INPUT_POST, 'std_id', FILTER_SANITIZE_STRING));
            $billcode = strtoupper(filter_input(INPUT_POST, 'billcode', FILTER_SANITIZE_STRING));
            $details_data = $this->MSales->get_bill_details($billcode);
            if (isset($details_data['data']) && !empty($details_data['data'])) {
                $data['details_data'] = $details_data['data'];
                $payment_data = $this->MSales->get_payment_details($data['details_data']['master_data']['sales_pack_id']);
                if (!empty($payment_data['data'])) {
                    $data['payment_data'] = $payment_data['data'];
                } else {
                    $data['payment_data'] = NULL;
                }
            } else {
                $data['details_data'] = NULL;
            }


            $data['std_id'] = $std_id;
            $data['billid'] = $billid;
            $data['billcode'] = $billcode;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('bill/bill_view_details', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function search_byname_packing()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['acy_yr'] = filter_input(INPUT_POST, 'acdyr_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            $data_prep['flag'] = 5;
            $batchid = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);

            if ($batchid == -1) {
                $data_prep['batch_id'] = 0;
            } else {
                $data_prep['batch_id'] = $batchid;
            }
            $details_data = $this->MStudent->parent_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['batchid'] = $batchid;
            $data['acdyr_id'] = $data_prep['acy_yr'];
            $data['batch_id'] = $data_prep['batch_id'];
            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('packing/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function search_stud_byname()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['batch_id'] = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['stream_id'] = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['class_id'] = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['curent_acdyr'] = filter_input(INPUT_POST, 'acdyr_id', FILTER_SANITIZE_NUMBER_INT);

            $data_prep['searchname'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            if ($data_prep['stream_id'] == -1) {
                $data_prep['stream_id'] = '';
            }
            if ($data_prep['curent_acdyr'] == -1) {
                $data_prep['curent_acdyr'] = '';
            }
            if ($data_prep['class_id'] == -1) {
                $data_prep['class_id'] = '';
            }

            $details_data = $this->MSales->studentadvance_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['batchid'] = $data_prep['batch_id'];
            $data['acdyr_id'] = $data_prep['curent_acdyr'];
            $data['batch_id'] = $data_prep['batch_id'];
            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('packing/profile_search', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
