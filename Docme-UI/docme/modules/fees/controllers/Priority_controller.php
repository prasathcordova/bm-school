<?php

/**
 * Description of Priority_controller
 *
 * @author chandrajith.edsys
 */
class Priority_controller extends MX_Controller
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
        $this->load->model('Priority_model', 'MPriority');
    }

    public function show_priority()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $priority_data = $this->MPriority->get_priority_data($inst_id, $acd_year_id);
            if (isset($priority_data['data']) && !empty($priority_data['data'])) {
                $data['priority_data'] = $priority_data['data'];
                $data['is_applied_this_month'] = $priority_data['data'][0]['applied_this_month'];
            } else {
                $data['priority_data'] = NULL;
                $data['is_applied_this_month'] = NULL;
            }

            // $data['sub_title'] = 'STUDENT CONCESSION SLAB MANAGEMENT';
            $data['sub_title'] = 'CONCESSION SLABS';
            $this->load->view('fees_priority/show_priority', $data);
            //            $this->load->view('fees_priority/fee_code_link', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function manage_priority()
    {
        if ($this->input->is_ajax_request() == 1) {
            $priority_number_id = filter_input(INPUT_POST, 'priority_id', FILTER_SANITIZE_STRING);
            $priority_number = filter_input(INPUT_POST, 'priority_number', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $feecode_data = $this->MPriority->get_feecode_data($priority_number, $inst_id, $acd_year_id);

            if (isset($feecode_data['data_status']) && !empty($feecode_data['data_status']) && $feecode_data['data_status'] == 1) {
                $data['new_feecode'] = $feecode_data['data'];
                $data['existing_feecode'] = $feecode_data['data_existing'];
                $data['priority_number'] = $priority_number;
                $data['sub_title'] = 'PRIORITY CONFIGURATION - ' . $priority_number;
                $data['priority_number_id'] = $priority_number_id;
                echo json_encode(array('status' => 1, 'view' => $this->load->view('fees_priority/manage_feecodes', $data, TRUE)));
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Feecodes not available.'));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_manage_priority()
    {
        if ($this->input->is_ajax_request() == 1) {
            $fee_code_data = filter_input(INPUT_POST, 'fee_code_data');
            $priority_number = filter_input(INPUT_POST, 'priority_number', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $data_to_save = array(
                'action' => 'save_feecodes_for_student_priority_management',
                'fee_code_data' => $fee_code_data,
                'priority_number' => $priority_number,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );

            $status = $this->MPriority->save_feecode_for_priority($data_to_save);
            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please contact administrator for further assistance'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function show_staff_priority()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $priority_data = $this->MPriority->get_priority_data_for_staff($inst_id, $acd_year_id);
            //            dev_export($priority_data);die;
            if (isset($priority_data['data']) && !empty($priority_data['data'])) {
                $data['priority_data'] = $priority_data['data'];
            } else {
                $data['priority_data'] = NULL;
            }

            $data['sub_title'] = 'STAFF CONCESSION SLAB MANAGEMENT';
            $this->load->view('fees_priority/show_priority_staff', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function manage_staff_priority()
    {
        if ($this->input->is_ajax_request() == 1) {
            $priority_number_id = filter_input(INPUT_POST, 'priority_id', FILTER_SANITIZE_STRING);
            $priority_number = filter_input(INPUT_POST, 'priority_number', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $feecode_data = $this->MPriority->get_feecode_data_for_staff($priority_number, $inst_id, $acd_year_id);
            //            dev_export($feecode_data);die;
            if (isset($feecode_data['data_status']) && !empty($feecode_data['data_status']) && $feecode_data['data_status'] == 1) {
                $data['new_feecode'] = $feecode_data['data'];
                $data['existing_feecode'] = $feecode_data['data_existing'];
                $data['priority_number'] = $priority_number;
                $data['sub_title'] = 'PRIORITY CONFIGURATION - ' . $priority_number;
                $data['priority_number_id'] = $priority_number_id;
                echo json_encode(array('status' => 1, 'view' => $this->load->view('fees_priority/manage_feecodes_staff', $data, TRUE)));
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Feecodes not available.'));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_manage_staff_priority()
    {
        if ($this->input->is_ajax_request() == 1) {
            $fee_code_data = filter_input(INPUT_POST, 'fee_code_data');
            $priority_number = filter_input(INPUT_POST, 'priority_number', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $data_to_save = array(
                'action' => 'save_feecodes_for_staff_priority_management',
                'fee_code_data' => $fee_code_data,
                'priority_number' => $priority_number,
                'inst_id' => $inst_id,
                'acd_year_id' => $acd_year_id
            );
            //            dev_export($data_to_save);die;
            $status = $this->MPriority->save_feecode_for_priority_for_staff($data_to_save);
            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    echo json_encode(array('status' => 2, 'message' => $status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please contact administrator for further assistance'));
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function student_priority_concession()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $priority_data = $this->MPriority->get_priority_data($inst_id, $acd_year_id);
            if (isset($priority_data['data']) && !empty($priority_data['data'])) {
                $data['priority_data'] = $priority_data['data'];
            } else {
                $data['priority_data'] = NULL;
            }
            // $data['sub_title'] = "STUDENT CONCESSION LIST";
            $data['sub_title'] = "CONCESSION LIST";
            $this->load->view('fees_priority/student_priority_concession', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_priority_students()
    {
        if ($this->input->is_ajax_request() == 1) {
            $priority_number = filter_input(INPUT_POST, 'priority_number', FILTER_SANITIZE_NUMBER_INT);
            $concession_type = filter_input(INPUT_POST, 'concession_type', FILTER_SANITIZE_NUMBER_INT);
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $data_to_db = array(
                'action'                => 'get_priority_students',
                'controller_function'   => 'Fees_settings/Priority_controller/get_priority_students',
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id,
                'priority_number'       => $priority_number,
                'concession_type'       => $concession_type
            );

            $result_data = $this->MPriority->get_priority_students($data_to_db);
            //dev_export($result_data['data']);
            if (isset($result_data['data']) && !empty($result_data['data'])) {
                $data['priority_students'] = $result_data['data'];
            } else {
                $data['priority_students'] = NULL;
            }

            $priority_data = $this->MPriority->get_priority_data($inst_id, $acd_year_id);
            if (isset($priority_data['data']) && !empty($priority_data['data'])) {
                $data['priority_data'] = $priority_data['data'];
            } else {
                $data['priority_data'] = NULL;
            }
            $data['priority_number'] = $priority_number;
            $data['concession_type'] = $concession_type;
            $data['sub_title'] = "STUDENTS WITH PRIORITY - $priority_number";
            $this->load->view('fees_priority/view_priority_students', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function apply_student_concession()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $data_to_db = array(
                'action'                => 'apply_student_concession',
                'controller_function'   => 'Fees_settings/Priority_controller/apply_student_concession',
                'inst_id'               => $inst_id,
                'acd_year_id'           => $acd_year_id
            );

            $result_data = $this->MPriority->apply_student_concession($data_to_db);

            if (isset($result_data) && !empty($result_data) && $result_data['data'][0]['id'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Concession Applied successfully'));
                return true;
            } else {
                if (isset($result_data['data'][0]['ErrorMessage']) && !empty($result_data['data'][0]['ErrorMessage'])) {
                    echo json_encode(array('status' => 2, 'message' => $result_data['data'][0]['ErrorMessage']));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'An error encountered. Please contact administrator for further assistance'));
                    return true;
                }
            }
        }
    }

    public function show_students_for_fee_concession_application()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = "STUDENT CONCESSION APPLICATION";
            $this->load->view('fees_priority/preload_concession_application');
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
