<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fee_structure_controller
 *
 * @author chandrajith.edsys
 */
class Fee_structure_controller extends MX_Controller
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
        $this->load->model('Fee_structure_model', 'MFee_structure');
    }

    public function show_templates_to_link_fees_code()
    {
        $data['sub_title'] = 'Template - Fee Assignment';
        $inst_id = $this->session->userdata('inst_id');
        $cur_acd_year = $this->session->userdata('acd_year');
        $template_list = $this->MFee_structure->get_all_active_available_template($inst_id, $cur_acd_year);

        if (isset($template_list['data']) && !empty($template_list['data'])) {
            $data['template_data'] = $template_list['data'];
        } else {
            $data['template_data'] = NULL;
        }
        $this->load->view('fee_structure/show_templates_for_feecode_linking', $data);
    }

    public function search_template_fee_code()
    {
        if ($this->input->is_ajax_request() == 1) {
            $search_template = filter_input(INPUT_POST, 'search_template', FILTER_SANITIZE_STRING);
            $template_list = $this->MFee_structure->search_template_byname($search_template);

            if (isset($template_list['data']) && !empty($template_list['data'])) {
                $data['template_data'] = $template_list['data'];
                $data['message'] = "";
            } else {
                $data['template_data'] = FALSE;
                $data['message'] = $template_list['message'];
            }
            echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_structure/show_templates_for_feecode_linking_search', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function link_fee_code()
    {
        if ($this->input->is_ajax_request() == 1) {
            $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
            $data = array(
                'sub_title' => 'Template - Fee code Linking ( ' . $template_name . ')'
            );
            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            if ($template_id) {
                $fee_codes_already_linked = $this->MFee_structure->get_fee_codes_linked($template_id);
                $fee_codes_to_link = $this->MFee_structure->get_fee_codes_for_linking($template_id);
                if (isset($fee_codes_already_linked['data']) && !empty($fee_codes_already_linked['data'])) {
                    $data['fee_codes_already_linked'] = $fee_codes_already_linked['data'];
                } else {
                    $data['fee_codes_already_linked'] = NULL;
                }
                if (isset($fee_codes_to_link['data']) && !empty($fee_codes_to_link['data'])) {
                    $data['fee_codes_to_link'] = $fee_codes_to_link['data'];
                } else {
                    $data['fee_codes_to_link'] = NULL;
                }
                $data['template_name'] = $template_name;
                $data['template_id'] = $template_id;
                echo json_encode(array(
                    'status' => 1,
                    'view' => $this->load->view('fee_structure/fee_code_linking', $data, TRUE),
                    'message' => 'Template data is loaded'
                ));
            } else {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'There was no data associated with the template'
                ));
            }
            return true;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_linked_fee_code()
    {
        if ($this->input->is_ajax_request() == 1) {
            $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            $fee_code_link_data = filter_input(INPUT_POST, 'fee_code_data');
            $fee_code_link_data_array = json_decode($fee_code_link_data, TRUE);
            if (isset($fee_code_link_data_array) && !empty($fee_code_link_data_array) && is_array($fee_code_link_data_array) && count($fee_code_link_data_array) > 0) {
                $inst_id = $this->session->userdata('inst_id');
                $cur_acd_year = $this->session->userdata('acd_year');
                $data_to_save = array(
                    'action' => 'save_fee_code_to_template',
                    'fee_code_link_data' => $fee_code_link_data,
                    'template_id' => $template_id,
                    'inst_id' => $inst_id,
                    'cur_acd_year_id' => $cur_acd_year
                );
                $link_status = $this->MFee_structure->link_fee_code_to_template($data_to_save);
                //                dev_export($link_status);die;
                if (isset($link_status['data_status']) && !empty($link_status['data_status']) && $link_status['data_status'] == 1) {
                    echo json_encode(array(
                        'status' => 1,
                        'message' => 'Data updated successfully'
                    ));
                    return true;
                } else {
                    if (isset($link_status['message']) && !empty($link_status['message'])) {
                        echo json_encode(array(
                            'status' => 3,
                            'message' => $link_status['message']
                        ));
                        return true;
                    } else {
                        echo json_encode(array(
                            'status' => 3,
                            'message' => 'An error encountered. Please try again or contact administrator with the error code UITEMPASGFCOD001'
                        ));
                        return true;
                    }
                }
            } else {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'Select atleast one Fee Code.'
                    //Please check the fee codes and the fee input done for linking with the template
                ));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function view_linked_fee_code()
    {
        if ($this->input->is_ajax_request() == 1) {
            $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
            $data = array(
                'sub_title' => 'Template - Fee code Linking ( ' . $template_name . ')'
            );
            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            $backsection = filter_input(INPUT_POST, 'backsection', FILTER_SANITIZE_STRING);
            if ($template_id) {
                $fee_codes_already_linked = $this->MFee_structure->get_fee_codes_linked($template_id);
                if (isset($fee_codes_already_linked['data']) && !empty($fee_codes_already_linked['data'])) {
                    $data['fee_codes_already_linked'] = $fee_codes_already_linked['data'];
                    $data['backsection'] = $backsection;
                } else {
                    echo json_encode(array(
                        'status' => 2,
                        'message' => 'No fee codes are linked with template.'
                    ));
                    return true;
                }
                echo json_encode(array(
                    'status' => 1,
                    'view' => $this->load->view('fee_structure/linked_fee_code_view', $data, TRUE),
                    'message' => 'Template data is loaded'
                ));
            } else {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'There was no data associated with the template'
                ));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function show_templates_to_link_students()
    {
        $data['sub_title'] = 'Template - Student Assignment'; //Periodic Fee
        $inst_id = $this->session->userdata('inst_id');
        $cur_acd_year = $this->session->userdata('acd_year');
        $template_list = $this->MFee_structure->get_all_active_available_template($inst_id, $cur_acd_year);

        if (isset($template_list['data']) && !empty($template_list['data'])) {
            $data['template_data'] = $template_list['data'];
        } else {
            $data['template_data'] = NULL;
        }
        $this->load->view('fee_structure/show_templates_for_student_linking', $data);
    }

    public function search_show_templates_to_link_students()
    {
        if ($this->input->is_ajax_request() == 1) {
            $search_template = filter_input(INPUT_POST, 'search_template', FILTER_SANITIZE_STRING);
            $template_list = $this->MFee_structure->search_template_byname($search_template);

            if (isset($template_list['data']) && !empty($template_list['data'])) {
                $data['template_data'] = $template_list['data'];
                $data['message'] = "";
            } else {
                $data['template_data'] = FALSE;
                $data['message'] = $template_list['message'];
            }
            echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_structure/show_templates_for_student_linking_search', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function show_student_filter_for_fee_allocation()
    {
        if ($this->input->is_ajax_request() == 1) {
            $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
            $data = array(
                'sub_title' => 'Template - Student Assignment ( ' . $template_name . ')'
            );
            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            if ($template_id) {
                $fee_codes_already_linked = $this->MFee_structure->get_fee_codes_linked($template_id);
                if (isset($fee_codes_already_linked['data']) && !empty($fee_codes_already_linked['data'])) {
                    $data['fee_codes_already_linked'] = $fee_codes_already_linked['data'];
                } else {
                    echo json_encode(array(
                        'status' => 2,
                        'message' => 'No fee codes are linked with template.'
                    ));
                    return true;
                }
                $data['template_name'] = $template_name;
                $data['template_id'] = $template_id;
                //        ACD YEAR DATA
                $acdyr = $this->MFee_structure->get_all_acadyr();
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
                $stream = $this->MFee_structure->get_all_stream();
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
                $stream = $this->MFee_structure->get_all_session();
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
                $class = $this->MFee_structure->get_template_allocatted_class($template_id);

                if (isset($class['error_status']) && $class['error_status'] == 0) {
                    if ($class['data_status'] == 1) {
                        $data['class_data'] = $class['data'];
                    } else {
                        $data['class_data'] = FALSE;
                    }
                } else {
                    $data['class_data'] = FALSE;
                }
                //        BATCH DATA
                $batch = $this->MFee_structure->get_all_batch_template_allocated($this->session->userdata('acd_year'), $template_id);
                // dev_export($batch);
                // die;
                if (isset($batch['error_status']) && $batch['error_status'] == 0) {
                    if ($batch['data_status'] == 1) {
                        $data['batch_data'] = $batch['data'];
                    } else {
                        $data['batch_data'] = FALSE;
                    }
                } else {
                    $data['batch_data'] = FALSE;
                }
                //      Religion DATA
                $relegion = $this->MFee_structure->get_all_relegion();
                if (isset($relegion['error_status']) && $relegion['error_status'] == 0) {
                    if ($relegion['data_status'] == 1) {

                        $data['religion'] = $relegion['data'];
                    } else {
                        $data['religion'] = FALSE;
                    }
                } else {
                    $data['religion'] = FALSE;
                }
                // dev_export($data);
                // die;
                echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_structure/student_filter_for_fee_allocation', $data, TRUE)));
                return true;
            } else {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'There was no data associated with the template'
                ));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_batch_data_for_fee_template()
    {
        if ($this->input->is_ajax_request() == 1) {
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
            $data = $this->MFee_structure->get_batch_data_for_template_allocation($stream_id, $academic_year, $session_id, $class_id, $flag_status);
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
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_student_for_fee_allocation()
    {
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $admissionno = filter_input(INPUT_POST, 'admissionno', FILTER_SANITIZE_STRING);
            $stream_id = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $academic_year = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $session_id = filter_input(INPUT_POST, 'session_id', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_data');
            $batch_id = filter_input(INPUT_POST, 'batch_data');
            $gender = filter_input(INPUT_POST, 'gender');
            $religion = filter_input(INPUT_POST, 'religion', FILTER_SANITIZE_NUMBER_INT);
            $nationality = filter_input(INPUT_POST, 'nationality');
            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_NUMBER_INT);
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

            $student = $this->MFee_structure->get_student_data($admissionno, $stream_id, $academic_year, $session_id, $class_id, $batch_id, $gender, $religion, $template_id, $nationality);

            if (isset($student['error_status']) && $student['error_status'] == 0) {
                if ($student['status'] == 1) {

                    $data['student_data'] = $student['data'];
                } else {
                    $data['student_data'] = FALSE;
                }
            } else {
                $data['student_data'] = FALSE;
            }

            echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_structure/student_for_fee_allocation', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function allocate_fees_for_student_from_template()
    {
        if ($this->input->is_ajax_request() == 1) {
            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
            $student_data = filter_input(INPUT_POST, 'student_allocation_data');
            $student_data_one_time = filter_input(INPUT_POST, 'student_data_one_time');
            $activation_date = filter_input(INPUT_POST, 'activation_date', FILTER_SANITIZE_STRING);
            if (!(isset($template_id) && !empty($template_id))) {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'Please check if valid template is selected.'
                ));
            }
            if (!(isset($template_name) && !empty($template_name))) {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'Please check if valid template is selected.'
                ));
            }
            if (!(isset($student_data) && !empty($student_data))) {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'Please check if students are selected for the fee allocation.'
                ));
            }
            if (!(isset($activation_date) && !empty($activation_date))) {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'Please check if the activation date is valid'
                ));
            }

            $allocation_status = $this->MFee_structure->allocate_students_to_fee_template($template_id, $student_data, $activation_date, $student_data_one_time);
            // dev_export($allocation_status);
            // die;
            if (isset($allocation_status['data_status']) && !empty($allocation_status['data_status']) && $allocation_status['data_status'] == 1) {

                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Data updated successfully'
                ));
                return true;
            } else {
                if (isset($allocation_status['message']) && !empty($allocation_status['message'])) {
                    if (isset($allocation_status['data']['ErrorStatus']) && !empty($allocation_status['data']['ErrorStatus']) && $allocation_status['data']['ErrorStatus'] == 5) {
                        $student_list = array();
                        foreach (json_decode($allocation_status['data']['students_not_available'], TRUE) as $value) {
                            $student_list[] = $value['first_name'];
                        }

                        echo json_encode(array(
                            'status' => 3,
                            'message' => $allocation_status['message'],
                            'student_data' => implode(",", $student_list)
                        ));
                    } else {
                        echo json_encode(array(
                            'status' => 4,
                            'message' => $allocation_status['message']
                        ));
                    }

                    return true;
                } else {
                    echo json_encode(array(
                        'status' => 4,
                        'message' => 'An error encountered. Please try again or contact administrator with the error code UITEMPASGFCOD002'
                    ));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function fee_student_allotment_list()
    {

        $data['sub_title'] = 'Student Allocation List';
        $inst_id = $this->session->userdata('inst_id');
        $cur_acd_year = $this->session->userdata('acd_year');
        $template_list = $this->MFee_structure->get_all_active_available_template($inst_id, $cur_acd_year);

        if (isset($template_list['data']) && !empty($template_list['data'])) {
            $data['template_data'] = $template_list['data'];
        } else {
            $data['template_data'] = NULL;
        }
        $this->load->view('fee_structure/templates_for_student_listing', $data);
    }

    public function search_fee_student_allotment_list()
    {
        if ($this->input->is_ajax_request() == 1) {
            $search_template = filter_input(INPUT_POST, 'search_template', FILTER_SANITIZE_STRING);
            $template_list = $this->MFee_structure->search_template_byname($search_template);

            if (isset($template_list['data']) && !empty($template_list['data'])) {
                $data['template_data'] = $template_list['data'];
                $data['message'] = "";
            } else {
                $data['template_data'] = FALSE;
                $data['message'] = $template_list['message'];
            }
            echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_structure/templates_for_student_listing_search', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function student_listing_for_template_allocated()
    {
        if ($this->input->is_ajax_request() == 1) {

            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'Fees Alloted Student List - ' . $template_name;
            $data['template_name'] = $template_name;
            $student_list_fee_allocated = $this->MFee_structure->get_student_list($template_id);
            if (isset($student_list_fee_allocated['data']) && !empty($student_list_fee_allocated['data'])) {
                $data['student_data'] = $student_list_fee_allocated['data'];
            } else {
                echo json_encode(array('status' => 2, 'message' => 'There are no students linked with this template.'));
                return TRUE;
            }
            echo json_encode(array(
                'status' => 1,
                'view' => $this->load->view('fee_structure/periodic_fee_student_list', $data, TRUE),
            ));
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function view_linked_fee_code_for_student_list()
    {
        if ($this->input->is_ajax_request() == 1) {
            $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
            $data = array(
                'sub_title' => 'Template - Fee code Linking ( ' . $template_name . ')'
            );
            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            if ($template_id) {
                $fee_codes_already_linked = $this->MFee_structure->get_fee_codes_linked($template_id);
                if (isset($fee_codes_already_linked['data']) && !empty($fee_codes_already_linked['data'])) {
                    $data['fee_codes_already_linked'] = $fee_codes_already_linked['data'];
                } else {
                    echo json_encode(array(
                        'status' => 2,
                        'message' => 'No fee codes are linked with template.'
                    ));
                    return true;
                }
                echo json_encode(array(
                    'status' => 1,
                    'view' => $this->load->view('fee_structure/linked_fee_code_view_for_students', $data, TRUE),
                    'message' => 'Template data is loaded'
                ));
            } else {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'There was no data associated with the template'
                ));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function fee_student_deallocation_show_template()
    {

        $data['sub_title'] = 'Student Deallocation List';
        $inst_id = $this->session->userdata('inst_id');
        $cur_acd_year = $this->session->userdata('acd_year');
        $template_list = $this->MFee_structure->get_all_active_available_template($inst_id, $cur_acd_year);

        if (isset($template_list['data']) && !empty($template_list['data'])) {
            $data['template_data'] = $template_list['data'];
        } else {
            $data['template_data'] = NULL;
        }
        $this->load->view('fee_structure/template_for_deallocation_listing', $data);
    }

    public function search_fee_student_deallocation_show_template()
    {
        if ($this->input->is_ajax_request() == 1) {
            $search_template = filter_input(INPUT_POST, 'search_template', FILTER_SANITIZE_STRING);
            $template_list = $this->MFee_structure->search_template_byname($search_template);

            if (isset($template_list['data']) && !empty($template_list['data'])) {
                $data['template_data'] = $template_list['data'];
                $data['message'] = "";
            } else {
                $data['template_data'] = FALSE;
                $data['message'] = $template_list['message'];
            }
            echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_structure/template_for_deallocation_listing_search', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function deallocation_student_listing_for_template_allocated()
    {
        if ($this->input->is_ajax_request() == 1) {

            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'Fees Alloted Student List - ' . $template_name;
            $data['template_name'] = $template_name;
            $data['template_id'] = $template_id;
            $student_list_fee_allocated = $this->MFee_structure->get_student_list($template_id);
            if (isset($student_list_fee_allocated['data']) && !empty($student_list_fee_allocated['data'])) {
                $data['student_data'] = $student_list_fee_allocated['data'];
            } else {
                echo json_encode(array('status' => 2, 'message' => 'There are no students linked with this template.'));
                return TRUE;
            }
            echo json_encode(array(
                'status' => 1,
                'view' => $this->load->view('fee_structure/periodic_fee_student_for_dealloction', $data, TRUE),
            ));
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function view_linked_fee_code_for_student_deallocation()
    {
        if ($this->input->is_ajax_request() == 1) {
            $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
            $data = array(
                'sub_title' => 'Template - Fee code Linking ( ' . $template_name . ')'
            );
            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            if ($template_id) {
                $fee_codes_already_linked = $this->MFee_structure->get_fee_codes_linked($template_id);
                if (isset($fee_codes_already_linked['data']) && !empty($fee_codes_already_linked['data'])) {
                    $data['fee_codes_already_linked'] = $fee_codes_already_linked['data'];
                } else {
                    echo json_encode(array(
                        'status' => 2,
                        'message' => 'No fee codes are linked with template.'
                    ));
                    return true;
                }
                echo json_encode(array(
                    'status' => 1,
                    'view' => $this->load->view('fee_structure/linked_fee_code_view_for_students_for_deallocation', $data, TRUE),
                    'message' => 'Template data is loaded'
                ));
            } else {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'There was no data associated with the template'
                ));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function de_allocate_students_from_fee_template()
    {
        if ($this->input->is_ajax_request() == 1) {
            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            $student_data_raw = filter_input(INPUT_POST, 'student_data');
            $student_data = json_decode($student_data_raw, TRUE);
            //            dev_export($student_data_raw);die;
            if (isset($template_id) && !empty($template_id) && is_array($student_data) && !empty($student_data)) {
                $de_allocation_status = $this->MFee_structure->de_allocate_students($template_id, $student_data_raw);
                //                dev_export($de_allocation_status);
                //                die;
                if (isset($de_allocation_status['data_status']) && !empty($de_allocation_status['data_status']) && $de_allocation_status['data_status'] == 1) {
                    if (isset($de_allocation_status['data'][0]['ErrorStatus']) && $de_allocation_status['data'][0]['ErrorStatus'] > 0) {
                        if ($de_allocation_status['data'][0]['ErrorStatus'] == 1) {
                            echo json_encode(array(
                                'status' => 2,
                                'message' => $de_allocation_status['data'][0]['ErrorMessage']
                            ));
                        } else {
                            $student_name_raw = array();
                            if (isset($de_allocation_status['data'][0]['students_not_available'])) {

                                foreach (json_decode($de_allocation_status['data'][0]['students_not_available'], TRUE) as $value) {
                                    $student_name_raw[] = $value['first_name'];
                                }
                            }

                            $student_name = implode(", ", $student_name_raw);

                            echo json_encode(array(
                                'status' => 2, //Students:
                                'message' => $de_allocation_status['data'][0]['ErrorMessage'] . " \n " . $student_name
                            ));
                        }
                    } else {
                        echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                        return TRUE;
                    }
                } else {
                    if (isset($de_allocation_status['message']) && !empty($de_allocation_status['message'])) {
                        echo json_encode(array('status' => 3, 'message' => $de_allocation_status['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 3, 'message' => 'An error encountered. Please try again later'));
                        return TRUE;
                    }
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Select atleast one student for de allocation'));
                return TRUE;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
