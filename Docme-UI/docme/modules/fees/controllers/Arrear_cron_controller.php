<?php

/**
 * Description of Arrear_url_controller
 *
 * @author SALAHUDHEEN
 */
class Arrear_cron_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Arrear_model', 'MArrear');
    }

    public function save_arrear_for_institutions()
    {
        // $inst_id_array = [5, 8, 20]; //Get Institution ID from this array
        $inst_id_array = explode(',', INST_IDS); //Get Institution ID from this array
        foreach ($inst_id_array as $inst_id) {
            $arrear_summary_data = array();
            $current_acd_year = $this->MArrear->get_current_academic_year_of_institution($inst_id, LOGIN_API_KEY);

            if (!empty($current_acd_year)) $acd_year_id = $current_acd_year[0]['Code_Value'];
            else $acd_year_id = 0;

            $student_data = $this->MArrear->get_students_for_arrear_management($inst_id, $acd_year_id, LOGIN_API_KEY);
            // print_r($student_data);
            if (isset($student_data['data']) && !empty($student_data['data'])) {
                $arrear_summary_data = $student_data['summary'];
                $arrear_saved_today = $student_data['arrear_saved_today'];
            }
            // print_r($student_data['summary']);
            if (!empty($arrear_summary_data) && is_array($arrear_summary_data)) {
                $arrear_sum = 0;
                foreach ($arrear_summary_data as $data) {
                    $tarray[] = array_sum($data);
                }
                $arrear_sum = array_sum($tarray);
                $student_data_status = $this->MArrear->save_todays_arrear_summary(json_encode($arrear_summary_data), $inst_id, $acd_year_id, $arrear_sum, LOGIN_API_KEY);
                // print_r($student_data_status);
                if (isset($student_data_status['status']) && !empty($student_data_status['status']) && $student_data_status['status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data updation failed'));
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No Data Found for' . $inst_id));
            }
        }
    }
    public function save_arrear_for_institution($instid = '')
    {
        $inst_id_array = [$instid]; //Get Institution ID from this array
        foreach ($inst_id_array as $inst_id) {
            $arrear_summary_data = array();
            $current_acd_year = $this->MArrear->get_current_academic_year_of_institution($inst_id, LOGIN_API_KEY);
            if (!empty($current_acd_year)) $acd_year_id = $current_acd_year[0]['Code_Value'];
            else $acd_year_id = 0;

            $student_data = $this->MArrear->get_students_for_arrear_management($inst_id, $acd_year_id, LOGIN_API_KEY);
            //print_r($student_data);
            if (isset($student_data['data']) && !empty($student_data['data'])) {
                $arrear_summary_data = $student_data['summary'];
                $arrear_saved_today = $student_data['arrear_saved_today'];
            }
            if (!empty($arrear_summary_data) && is_array($arrear_summary_data)) {
                $arrear_sum = 0;
                // foreach (json_decode($arrear_summary_data, true) as $data) {
                //     $tarray[] = array_sum($data);
                // }
                foreach ($arrear_summary_data as $data) {
                    $tarray[] = array_sum($data);
                }
                $arrear_sum = array_sum($tarray);
                $student_data_status = $this->MArrear->save_todays_arrear_summary(json_encode($arrear_summary_data), $inst_id, $acd_year_id, $arrear_sum, LOGIN_API_KEY);
                if (isset($student_data_status['status']) && !empty($student_data_status['status']) && $student_data_status['status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data updation failed'));
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No Data Found for' . $inst_id));
            }
        }
    }
}
