<?php

/**
 * Description of Arrear_controller
 *
 * @author SALAHUDHEEN
 */
class Arrear_controller extends MX_Controller
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
        $this->load->model('Arrear_model', 'MArrear');
    }

    public function get_base_arrear_page_listing()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = "ARREAR MANAGEMENT";
            $this->load->view('arrear/listing_base', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_student_data_for_arrear()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $student_data = $this->MArrear->get_students_for_arrear_management($inst_id, $acd_year_id);
            // dev_export($student_data);
            // die;
            if (isset($student_data['data']) && !empty($student_data['data'])) {
                $data['student_data'] = $student_data['data'];
                $data['summary'] = json_encode($student_data['summary']);
                $data['arrear_saved_today'] = $student_data['arrear_saved_today'];
            } else {
                $data['student_data'] = NULL;
            }
            echo json_encode(array('status' => 1, 'view' => $this->load->view('arrear/student_listing', $data, TRUE)));
            return true;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_todays_arrear_summary()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');
            $arrear_summary_data = filter_input(INPUT_POST, 'arrear_summary_data');
            $student_id_raw = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $student_data = base64_decode($student_id_raw);
            $arrear_sum = 0;
            foreach (json_decode($arrear_summary_data, true) as $data) {
                $tarray[] = array_sum($data);
            }
            $arrear_sum = array_sum($tarray);
            $student_data_status = $this->MArrear->save_todays_arrear_summary($arrear_summary_data, $inst_id, $acd_year_id, $arrear_sum);
            // dev_export($student_data_status);
            // die;
            if (isset($student_data_status['status']) && !empty($student_data_status['status']) && $student_data_status['status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Data updation failed'));
            }

            return true;
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
