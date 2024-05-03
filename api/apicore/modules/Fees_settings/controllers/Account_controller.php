<?php

/**
 * For the functionalities regarding student account
 *
 * @author Aju S Aravid
 */
class Account_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Fee_collection_model', 'MFCollection');
        $this->load->model('account_model', 'MAccount');
    }

    public function get_student_account_data($params)
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

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        //Penalty Details
        $penalty_date = date('Y-m-d');
        $penalty_data = $this->MFCollection->get_penalty_details($inst_id, $apikey, $penalty_date);

        $student_account_data_detail = $this->MAccount->get_student_account_data($student_id, $inst_id, $acd_year_id, $apikey);
        $student_account_data_summary = $this->MAccount->get_student_account_summary_data($student_id, $inst_id, $acd_year_id, $apikey);
        if (isset($student_account_data_detail) && !empty($student_account_data_detail) && isset($student_account_data_summary) && !empty($student_account_data_summary)) {
            return array(
                'data_status' => 1,
                'error_status' => 0,
                'data_detail' => $student_account_data_detail,
                'data_summary' => $student_account_data_summary,
                'penalty_details' => $penalty_data
            );
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => NULL, 'data_count' => 0);
        }
    }
}
