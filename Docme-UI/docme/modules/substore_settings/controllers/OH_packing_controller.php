<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OH_packing_controller
 *
 * @author Rahul.Shibukumar
 */
class OH_packing_controller extends MX_Controller {

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
        $this->load->model('OH_packing_model', 'OHPModel');
    }

    public function search_openhouse_stud_view() {
        $data['sub_title'] = 'Open House';
        $data['user_name'] = $this->session->userdata('user_name');

        $openhouse = filter_input(INPUT_POST, 'openhouse', FILTER_SANITIZE_STRING);
        $oh_data = $this->OHPModel->get_oh_stud_assign_data_search($openhouse);


        if ($oh_data['error_status'] == 0 && $oh_data['data_status'] == 1) {
            $data['oh_master'] = $oh_data['data'];
            $data['message'] = "";
        } else {
            $data['oh_master'] = FALSE;
            $data['message'] = $oh_data['message'];
        }
        echo json_encode(array('status' => 1, 'view' => $this->load->view('ohtemplate/search_openhouse_stud_view', $data, TRUE)));
        return TRUE;
    }

    //Rahul Open house studennt list 13-2-2018
    public function openhouse_view() {
        $data['sub_title'] = 'OH Student List';
        $data['user_name'] = $this->session->userdata('user_name');
        $oh_data = $this->OHPModel->get_oh_stud_assign_data();


        if ($oh_data['error_status'] == 0 && $oh_data['data_status'] == 1) {
            $data['oh_master'] = $oh_data['data'];
            $data['message'] = "";
        } else {
            $data['oh_master'] = FALSE;
            $data['message'] = $oh_data['message'];
        }

        $this->load->view('ohtemplate/openhouse_view', $data);
    }

    public function openhouse_stud_list_view() {

        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $openhouse_id = filter_input(INPUT_POST, 'openhouse_id', FILTER_SANITIZE_NUMBER_INT);
        $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_NUMBER_INT);

        $data['template_config_id'] = $openhouse_id;
        $data['template_id'] = $template_id;

        $data['sub_title'] = ' OPEN HOUSE STUDENT LIST';


        $oh_data = $this->OHPModel->get_student_openhouse($template_id, $openhouse_id);


        if ($oh_data['error_status'] == 0 && $oh_data['data_status'] == 1) {
            $data['details_data'] = $oh_data['data'];
            $data['message'] = "";

            echo json_encode(array('status' => 1, 'view' => $this->load->view('ohtemplate/openhouse_stud_view', $data, TRUE)));
            return TRUE;
        } else {
            $data['details_data'] = FALSE;
            $data['message'] = $oh_data['message'];
            echo json_encode(array('status' => 2, 'message' => $oh_data['message']));
            return TRUE;
        }
    }

    //Rahul Open house studennt list 13-2-2018
    //change openhouse -- Rahul 3/2/2018

    public function remove_stud_data() {

        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $template_config_id = filter_input(INPUT_POST, 'template_config_id', FILTER_SANITIZE_STRING);
        $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_NUMBER_INT);

        $formatted_student_data = filter_input(INPUT_POST, 'formatted_student_data');

        $student = $this->OHPModel->remove_stud_data($template_config_id, $template_id, $formatted_student_data);
        if (isset($student['error_status']) && $student['error_status'] == 0) {
            if ($student['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'data' => $student['data']));
                return TRUE;
            } else {
                echo json_encode(array('status' => 2, 'message' => $student['message']));
                return true;
            }
        } else {
            echo json_encode(array('status' => 0));
            return true;
        }
    }

    public function openhouse_stud_list() {

        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $openhouse_id = filter_input(INPUT_POST, 'openhouse_id', FILTER_SANITIZE_NUMBER_INT);
        $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_NUMBER_INT);

        $data['template_config_id'] = $openhouse_id;
        $data['template_id'] = $template_id;

        $data['sub_title'] = ' OPEN HOUSE STUDENT LIST';


        $oh_data = $this->OHPModel->get_student_openhouse($template_id, $openhouse_id);


        if ($oh_data['error_status'] == 0 && $oh_data['data_status'] == 1) {
            $data['details_data'] = $oh_data['data'];
            $data['message'] = "";

            echo json_encode(array('status' => 1, 'view' => $this->load->view('ohtemplate/openhouse_stud_list', $data, TRUE)));
            return TRUE;
        } else {
            $data['details_data'] = FALSE;
            $data['message'] = $oh_data['message'];
            echo json_encode(array('status' => 2, 'message' => $oh_data['message']));
            return TRUE;
        }
    }

    public function openhouse_change() {
        $data['sub_title'] = 'OH Student De-Allocation';
        $data['user_name'] = $this->session->userdata('user_name');
        $oh_data = $this->OHPModel->get_oh_stud_assign_data();


        if ($oh_data['error_status'] == 0 && $oh_data['data_status'] == 1) {
            $data['oh_master'] = $oh_data['data'];
            $data['message'] = "";
        } else {
            $data['oh_master'] = FALSE;
            $data['message'] = $oh_data['message'];
        }

        $this->load->view('ohtemplate/openhouse_change', $data);
    }

    //end --change openhouse -- Rahul 3/2/2018

    public function oh_item_assign() {
//        $data['template'] = 'OH/OH_packing';
//        $data['title'] = 'STORE SETTINGS';
        $data['sub_title'] = 'OH ITEM ASSIGNING';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Stock Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Packing Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $oh_data = $this->OHPModel->get_all_oh_list();
//        dev_export($oh_data);die;
        if ($oh_data['error_status'] == 0 && $oh_data['status'] == 1) {
            $data['oh_data'] = $oh_data['data'];
            $data['message'] = "";
        } else {
            $data['oh_data'] = FALSE;
            $data['message'] = $oh_data['message'];
        }
        $this->session->set_userdata('current_page', 'transfer');
        $this->session->set_userdata('current_parent', 'gen_sett');


        $this->load->view('ohtemplate/OH_packing', $data);
    }

    public function oh_item_adding() {
//        $data['sub_title'] = 'STOCK MANAGEMENT';
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);


        $data['sub_title'] = 'OH ITEM ADDING TO ' . $name;
        $data['template_id'] = $id;

        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $store_id = $this->session->userdata('store_id');;
        $data['store_id'] = $store_id;
        $item_data = $this->OHPModel->get_items_allitem($store_id);
//        dev_export($item_data);die;
        if ($item_data['error_status'] == 0 && $item_data['data_status'] == 1) {
            $data['item_data'] = $item_data['data'];
            $data['message'] = "";
        } else {
            $data['item_data'] = FALSE;
            $data['message'] = $item_data['message'];
        }
        $oh_data = $this->OHPModel->get_items_for_oh_stud_assign_for_item_assign_for_template($id);
//        dev_export($oh_data['data']); die;

        if ($oh_data['error_status'] == 0 && $oh_data['data_status'] == 1) {
            $data['oh_data'] = $oh_data['data'];
            $data['message'] = "";
        } else {
            $data['oh_data'] = FALSE;
            $data['message'] = $oh_data['message'];
        }

        if ($oh_data['error_status'] == 0 && $oh_data['data_status'] == 1) {
            $this->load->view('ohtemplate/Ohpack_itemadd_readd', $data);
        } else {
            $this->load->view('ohtemplate/Ohpack_itemadd', $data);
        }
    }

    public function save_ohitem_assign() {
//        $data['sub_title'] = 'STOCK MANAGEMENT';
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_NUMBER_INT);
        $total_qty = filter_input(INPUT_POST, 'total_qty', FILTER_SANITIZE_STRING);
        $sub_total = filter_input(INPUT_POST, 'sub_total');
        $vat = filter_input(INPUT_POST, 'vat');
        $discount = filter_input(INPUT_POST, 'discount');
        $roundoff = filter_input(INPUT_POST, 'roundoff');
        $finaltotal = filter_input(INPUT_POST, 'finaltotal', FILTER_SANITIZE_NUMBER_INT);
        $discount_type = filter_input(INPUT_POST, 'discount_type', FILTER_SANITIZE_STRING);
        $final_item_string = filter_input(INPUT_POST, 'final_item_string');
        if ($roundoff == 0) {
            $roundoff = -1;
        }
        if ($vat == 0) {
            $vat = -1;
        }
//        if ($vat == 0) {
//            $vat = 'zero';
//        }
        if ($discount == 0) {
            $discount = -1;
        }

        $item_data = $this->OHPModel->save_ohitem_assign($template_id, $total_qty, $sub_total, $vat, $discount, $final_item_string, $roundoff, $finaltotal, $discount_type);
//        dev_export($item_data);die;
        if ($item_data['error_status'] == 0 && $item_data['data_status'] == 1) {
            echo json_encode(array('status' => 1, 'message' => $item_data['message']));
            return TRUE;
        } else if ($item_data['error_status'] == 0 && $item_data['data_status'] == 2) {
            echo json_encode(array('status' => 2, 'message' => $item_data['message']));
            return TRUE;
        } else {
            echo json_encode(array('status' => 2, 'message' => 'An error occurred while adding items to template. Please try again later or contact administrator with error code : OHPRDIT0001'));
            return TRUE;
        }
    }

    public function search_ohstoredata() {
//        $data['sub_title'] = 'STOCK MANAGEMENT';
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $store_id = filter_input(INPUT_POST, 'store_id', FILTER_SANITIZE_NUMBER_INT);
        $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);


        $item_data = $this->OHPModel->search_items_in_substore($store_id, str_replace(" ", '%', $search));
        if ($item_data['error_status'] == 0 && $item_data['data_status'] == 1) {
            $data['item_data'] = $item_data['data'];
            $data['message'] = "";
        } else {
            $data['item_data'] = FALSE;
            $data['message'] = $item_data['message'];
        }

        $data['store_id'] = $store_id;
        $data['user_data'] = $item_data['data'];
        $data['user_name'] = $this->session->userdata('user_name');
//        dev_export($data['user_data']);die;
        echo json_encode(array('status' => 1, 'view' => $this->load->view('ohtemplate/search_ohitem', $data, TRUE)));
        return TRUE;
    }

    //packing

    public function search_openhouse_byname() {
        $data['sub_title'] = 'Open House';
        $data['user_name'] = $this->session->userdata('user_name');

        $openhouse = filter_input(INPUT_POST, 'openhouse', FILTER_SANITIZE_STRING);
        $oh_data = $this->OHPModel->get_oh_stud_assign_data_search($openhouse);

//         dev_export($oh_data);die;
        if ($oh_data['error_status'] == 0 && $oh_data['data_status'] == 1) {
            $data['oh_master'] = $oh_data['data'];
            $data['message'] = "";
        } else {
            $data['oh_master'] = FALSE;
            $data['message'] = $oh_data['message'];
        }
        echo json_encode(array('status' => 1, 'view' => $this->load->view('ohtemplate/search_openhouse', $data, TRUE)));
        return TRUE;
    }

    public function oh_packitems() {
//        $data['sub_title'] = 'Open House';
        $data['user_name'] = $this->session->userdata('user_name');
        $data['sub_title'] = 'Open House Student Assigning';
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $oh_data = $this->OHPModel->get_oh_stud_assign_data();

//         dev_export($oh_data);die;
        if ($oh_data['error_status'] == 0 && $oh_data['data_status'] == 1) {
            $data['oh_master'] = $oh_data['data'];
            $data['message'] = "";
        } else {
            $data['oh_master'] = FALSE;
            $data['message'] = $oh_data['message'];
        }
        $this->load->view('ohtemplate/OH_item', $data);
    }

    public function oh_stud_attachment() {

        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $openhouse_id = filter_input(INPUT_POST, 'openhouse_id', FILTER_SANITIZE_NUMBER_INT);
        $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_NUMBER_INT);

        $data['template_config_id'] = $openhouse_id;
        $data['template_id'] = $template_id;

        $data['sub_title'] = ' OH STUDENT ASSIGN';
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
        $this->session->set_userdata('current_page', 'transfer');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $oh_data = $this->OHPModel->get_items_for_oh_stud_assign($template_id, $openhouse_id);
//        dev_export($oh_data);die;
        if ($oh_data['error_status'] == 0 && $oh_data['data_status'] == 1) {
            if ($oh_data['error_status'] == 0 && $oh_data['data_status'] == 1) {
            $data['item_data'] = $oh_data['data'];
            $data['message'] = "";
        } else {
            $data['item_data'] = FALSE;
            $data['message'] = $oh_data['message'];
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



//        STREAM DATA
        $stream = $this->OHPModel->get_all_stream();
        if (isset($stream['error_status']) && $stream['error_status'] == 0) {
            if ($stream['data_status'] == 1) {
                $data['stream_data'] = $stream['data'];
            } else {
                $data['stream_data'] = FALSE;
            }
        } else {
            $data['stream_data'] = FALSE;
        }
//        SESSION DATA
        $stream = $this->OHPModel->get_all_session();
        if (isset($stream['error_status']) && $stream['error_status'] == 0) {
            if ($stream['data_status'] == 1) {
                $data['session_data'] = $stream['data'];
            } else {
                $data['session_data'] = FALSE;
            }
        } else {
            $data['session_data'] = FALSE;
        }

        //        CLASS DATA
        $class = $this->OHPModel->get_all_class();
//        dev_export($class);die;
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        //  
        //        batch DATA
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
        //  Religion
        $relegion = $this->OHPModel->get_all_relegion();
        if (isset($relegion['error_status']) && $relegion['error_status'] == 0) {
            if ($relegion['data_status'] == 1) {

                $data['religion'] = $relegion['data'];
            } else {
                $data['religion'] = FALSE;
            }
        } else {
            $data['religion'] = FALSE;
        }



            echo json_encode(array('status' => 1, 'view' => $this->load->view('ohtemplate/oh_stud_assign', $data, TRUE)));
            return true;
        } else {
            if (isset($oh_data['message']) && !empty($oh_data['message'])) {
                echo json_encode(array('status' => 2, 'message' => $oh_data['message']));
                return true;
    }
        }
    }

    public function load_batch_data() {

        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $stream_id = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
        $academic_year = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
        $session_id = filter_input(INPUT_POST, 'session_id', FILTER_SANITIZE_NUMBER_INT);
        $class_id = filter_input(INPUT_POST, 'class_data');
        $flag_status = 0;

        if ($stream_id == -1) {
            $stream_id = '';
        }
        if ($academic_year == -1) {
            $academic_year = '';
        }
        if ($session_id == -1) {
            $session_id = '';
        }

//               dev_export($data);die;


        $data = $this->OHPModel->get_batch_data($stream_id, $academic_year, $session_id, $class_id, $flag_status);
//        dev_export($data);die;
        if (isset($data['error_status']) && $data['error_status'] == 0) {
            if ($data['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'data' => $data['data']));
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

    public function load_search_stud_data() {

        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $admissionno = filter_input(INPUT_POST, 'admissionno', FILTER_SANITIZE_STRING);
        $stream_id = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
        $academic_year = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
        $session_id = filter_input(INPUT_POST, 'session_id', FILTER_SANITIZE_NUMBER_INT);
        $class_id = filter_input(INPUT_POST, 'class_data');
        $batch_id = filter_input(INPUT_POST, 'batch_data');
        $gender = filter_input(INPUT_POST, 'gender');
        $religion = filter_input(INPUT_POST, 'religion', FILTER_SANITIZE_NUMBER_INT);

        $flag_status = 1;

        if ($stream_id == -1) {
            $stream_id = '';
        }
        if ($academic_year == -1) {
            $academic_year = '';
        }
        if ($session_id == -1) {
            $session_id = '';
        }
        if ($gender == -1) {
            $gender = '';
        }
        if ($religion == -1) {
            $religion = '';
        }

//               dev_export($data);die;


        $student = $this->OHPModel->get_student_data($admissionno, $stream_id, $academic_year, $session_id, $class_id, $batch_id, $gender, $religion);


        if (isset($student['error_status']) && $student['error_status'] == 0) {
            if ($student['status'] == 1) {

                $data['student_data'] = $student['data'];
            } else {
                $data['student_data'] = FALSE;
            }
        } else {
            $data['student_data'] = FALSE;
        }

        echo json_encode(array('status' => 1, 'view' => $this->load->view('ohtemplate/oh_stud_assign_tbl', $data, TRUE)));
        return TRUE;
    }

    public function save_stud_data() {

        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $template_config_id = filter_input(INPUT_POST, 'template_config_id', FILTER_SANITIZE_STRING);
        $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_NUMBER_INT);

        $formatted_student_data = filter_input(INPUT_POST, 'formatted_student_data');

        $student = $this->OHPModel->save_stud_data($template_config_id, $template_id, $formatted_student_data);
//        dev_export($this->session->userdata());die;

        if (isset($student['error_status']) && $student['error_status'] == 0) {
            if ($student['data_status'] == 1) {
//                dev_export();die;
//                if(isset($student['data']))
                if (isset($student['data'][0]['Failed_assignment']) && !empty($student['data'][0]['Failed_assignment'])) {
                    $failed_students_raw = $student['data'][0]['Failed_assignment'];
                    $failed_restrucure = array();
                    $failed_students_format = explode('//~~//', $student['data'][0]['Failed_assignment']);
                    foreach ($failed_students_format as $failed) {
                        $failed_restrucure[] = "<li class='li'>" . $failed . '</li>';
                    }
                    $new_formatted = '<div class="scroll_content">' . implode(', ', $failed_restrucure) . '</div>';
                    echo json_encode(array('status' => 3, 'student_data' => $new_formatted, 'message' => 'Student assignment to OH completed successfully with warnings'));
                    return TRUE;
                }
                echo json_encode(array('status' => 1, 'data' => $student['data']));
                return TRUE;
            } else {
                echo json_encode(array('status' => 2, 'message' => $student['message']));
                return true;
            }
        } else {
            echo json_encode(array('status' => 0));
            return true;
        }
    }

    public function search_template_byname() {
//        $data['sub_title'] = 'STOCK MANAGEMENT';
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $search_template = filter_input(INPUT_POST, 'search_template', FILTER_SANITIZE_STRING);
//        $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);


        $oh_data = $this->OHPModel->search_template_byname($search_template);
//        dev_export($oh_data);die;

        if ($oh_data['error_status'] == 0 && $oh_data['status'] == 1) {
            $data['oh_data'] = $oh_data['data'];
            $data['message'] = "";
        } else {
            $data['oh_data'] = FALSE;
            $data['message'] = $oh_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');
//        dev_export($data['user_data']);die;
        echo json_encode(array('status' => 1, 'view' => $this->load->view('ohtemplate/template_search', $data, TRUE)));
        return TRUE;
    }

    public function search_openhouse_change() {
        $data['sub_title'] = 'Open House';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');
        $openhouse = filter_input(INPUT_POST, 'openhouse', FILTER_SANITIZE_STRING);
        $oh_data = $this->OHPModel->get_oh_stud_assign_data_search($openhouse);

        if ($oh_data['error_status'] == 0 && $oh_data['data_status'] == 1) {
            $data['oh_master'] = $oh_data['data'];
            $data['message'] = "";
        } else {
            $data['oh_master'] = FALSE;
            $data['message'] = $oh_data['message'];
        }
        echo json_encode(array('status' => 1, 'view' => $this->load->view('ohtemplate/search_openhouse_change', $data, TRUE)));
        return TRUE;
    }

}
