<?php

/**
 * Description of Priority_controller
 *
 * @author aju.docme
 */
class Priority_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Priority_model', 'MPriority');
    }

    public function get_priority_information($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        $priority_numbers = $this->MPriority->get_priority_numbers($apikey, $inst_id, $acd_year_id);
        if (isset($priority_numbers) && !empty($priority_numbers)) {
            return array('data_status' => 1, 'message' => 'Data loaded', 'data' => $priority_numbers);
        } else {
            return array('data_status' => 1, 'message' => 'There is no data available', 'data' => NULL);
        }
    }

    public function get_priority_information_fee_code_manage($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }
        if (!(isset($params['priority_number']) && !empty($params['priority_number']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Priority data is required', 'data' => FALSE);
        } else {
            $priority_number = $params['priority_number'];
        }
        $dbparams = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $priority_number
        );
        $new_feecodes = $this->MPriority->get_all_fee_codes_except_allotted($dbparams);

        $existing_feecodes = $this->MPriority->get_all_existing_fee_codes($dbparams);

        return array('data_status' => 1, 'data' => $new_feecodes, 'data_existing' => $existing_feecodes, 'message' => 'Data loaded');
    }

    public function save_feecodes_for_student_priority_management($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }
        if (!(isset($params['priority_number']) && !empty($params['priority_number']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Priority data is required', 'data' => FALSE);
        } else {
            $priority_number = $params['priority_number'];
        }

        if (!(isset($params['fee_code_data']) && !empty($params['fee_code_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Feecode data is required', 'data' => FALSE);
        } else {
            $fee_code_data = $params['fee_code_data'];
        }
        $dbparams = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $priority_number,
            $fee_code_data
        );
        $data = $this->MPriority->save_feecode_to_priority($dbparams);
        if (isset($data[0]['DATA_STATUS']) && !empty($data[0]['DATA_STATUS']) && $data[0]['DATA_STATUS'] == 1) {
            return array('data_status' => 1, 'message' => 'Data updated');
        } else {
            if (isset($data[0]['MESSAGES']) && !empty($data[0]['MESSAGES'])) {
                return array('data_status' => 2, 'message' => $data[0]['MESSAGES']);
            } else {
                return array('data_status' => 2);
            }
        }
    }

    public function get_priority_information_for_staff($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        $priority_numbers = $this->MPriority->get_priority_numbers_for_staff($apikey, $inst_id, $acd_year_id);
        if (isset($priority_numbers) && !empty($priority_numbers)) {
            return array('data_status' => 1, 'message' => 'Data loaded', 'data' => $priority_numbers);
        } else {
            return array('data_status' => 1, 'message' => 'There is no data available', 'data' => NULL);
        }
    }

    public function get_priority_information_fee_code_manage_for_staff($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }
        if (!(isset($params['priority_number']) && !empty($params['priority_number']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Priority data is required', 'data' => FALSE);
        } else {
            $priority_number = $params['priority_number'];
        }
        $dbparams = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $priority_number
        );
        $new_feecodes = $this->MPriority->get_all_fee_codes_for_staff($dbparams);

        $existing_feecodes = $this->MPriority->get_all_existing_fee_codes_for_staff($dbparams);

        return array('data_status' => 1, 'data' => $new_feecodes, 'data_existing' => $existing_feecodes, 'message' => 'Data loaded');
    }

    public function save_feecodes_for_staff_priority_management($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }
        if (!(isset($params['priority_number']) && !empty($params['priority_number']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Priority data is required', 'data' => FALSE);
        } else {
            $priority_number = $params['priority_number'];
        }

        if (!(isset($params['fee_code_data']) && !empty($params['fee_code_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Feecode data is required', 'data' => FALSE);
        } else {
            $fee_code_data = $params['fee_code_data'];
        }
        $dbparams = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $priority_number,
            $fee_code_data
        );
        $data = $this->MPriority->save_feecode_to_priority_for_staff($dbparams);
        if (isset($data[0]['DATA_STATUS']) && !empty($data[0]['DATA_STATUS']) && $data[0]['DATA_STATUS'] == 1) {
            return array('data_status' => 1, 'message' => 'Data updated');
        } else {
            if (isset($data[0]['MESSAGES']) && !empty($data[0]['MESSAGES'])) {
                return array('data_status' => 2, 'message' => $data[0]['MESSAGES']);
            } else {
                return array('data_status' => 2);
            }
        }
    }
    //SALAHUDHEEN AUG 3

    public function get_priority_students($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['priority_number']) && !empty($params['priority_number']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Priority Number required', 'data' => FALSE);
        } else {
            $priority_number = $params['priority_number'];
        }
        $concession_type = $params['concession_type'];

        $data_to_save = array(
            'api_key' => $apikey,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id,
            'priority_number' => $priority_number,
            'concession_type' => $concession_type
        );
        $result_data = $this->MPriority->get_priority_students($data_to_save);
        if (isset($result_data) && !empty($result_data)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Students Loaded successfully',
                'data' => $result_data
            );
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Failed or no data available');
        }
    }
    public function apply_student_concession($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        $data_to_save = array(
            'api_key' => $apikey,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id
        );
        $result_data = $this->MPriority->apply_student_concession($data_to_save);
        if (isset($result_data) && !empty($result_data)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'message' => 'Concession Applied successfully',
                'data' => $result_data
            );
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Failed or no data available');
        }
    }

    //ARREAR MANAGEMENT - DEC 03, 2019 - SALAH
    public function get_students_for_arrear_listing($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        $student_data = $this->MPriority->get_student_data_for_arrear($apikey, $inst_id, $acd_year_id);
        if (isset($student_data) && !empty($student_data) && count($student_data) > 0) {

            //Arrear Summary Calculation
            $arrear_array = array();
            $arrear_saved_today = 0;
            if (is_array($student_data) && !empty($student_data)) {
                if (!empty($student_data[0]))
                    $arrear_saved_today = ($student_data[0]['arrear_saved_today'] > 0 ? 1 : 0);
                foreach ($student_data as $stdata) {
                    $demanddate = date('m-Y', strtotime($stdata['DEMAND_DATE']));
                    if (isset($arrear_array[$demanddate][$stdata['FEE_CODE']])) {
                        $arrear_array[$demanddate][$stdata['FEE_CODE']] += $stdata['PENDING_PAYMENT'];
                    } else {
                        $arrear_array[$demanddate][$stdata['FEE_CODE']] = $stdata['PENDING_PAYMENT'];
                    }
                }
            }

            return array('data_status' => 1, 'data' => $student_data, 'summary' => $arrear_array, 'arrear_saved_today' => $arrear_saved_today);
        } else {
            return array('data_status' => 0, 'data' => NULL, 'message' => 'No students available');
        }
    }
    public function get_current_academic_year_of_institution($params)
    {
        $apikey = $params['API_KEY'];
        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        $dbparams = array(
            $apikey,
            $inst_id
        );
        $data = $this->MPriority->get_current_academic_year_of_institution($dbparams);
        return $data;
    }
    public function save_todays_arrear_summary($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }
        if (!(isset($params['arrear_summary_data']) && !empty($params['arrear_summary_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Arrear Summary data required', 'data' => FALSE);
        } else {
            $arrear_summary_data = $params['arrear_summary_data'];
        }
        $arrear_sum = $params['arrear_sum'];
        $dbparams = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $arrear_summary_data,
            $arrear_sum
        );
        $data = $this->MPriority->save_todays_arrear_summary($dbparams);
        //return $data;
        if (isset($data[0]['DATA_STATUS']) && !empty($data[0]['DATA_STATUS']) && $data[0]['DATA_STATUS'] == 1) {
            return array('status' => 1, 'message' => 'Data updated');
        } else {
            if (isset($data[0]['MESSAGES']) && !empty($data[0]['MESSAGES'])) {
                return array('status' => 2, 'message' => $data[0]['MESSAGES']);
            } else {
                return array('status' => 2);
            }
        }
    }
}
