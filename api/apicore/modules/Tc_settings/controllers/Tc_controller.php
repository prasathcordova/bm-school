<?php

/**
 * Description of Tc_controller
 *
 * @author chandrajith.docme
 */
class Tc_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tc_model', 'MTc');
    }

    public function save_tc($param)
    {

        $student_data_raw = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        $student_id = $param['student_id'];
        $inst_id = $param['inst_id'];
        $acdyr_id = $param['acdyr_id'];
        $check_tc_fee_demanded = $this->MTc->check_tc_fee_demanded($student_id, $inst_id, $acdyr_id, $apikey);
        $TC_FEE_ID = $check_tc_fee_demanded['TC_FEE_ID'];
        $TC_FEE_AMOUNT = $check_tc_fee_demanded['TC_FEE_AMOUNT'];
        $DEMANDED = $check_tc_fee_demanded['DEMANDED'];

        if ($TC_FEE_ID == 0) {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No TC Fee Code Created for this Institution', 'data' => FALSE);
        } else {
            if($TC_FEE_AMOUNT > 0){
                if ($DEMANDED == 0) {
                    $fee_code_id = $TC_FEE_ID;
                    $feecode_data = array(
                        array(
                            'fee_code_id' => $fee_code_id,
                            'fee_code' => 'F007',
                            'value_for_fee' => $TC_FEE_AMOUNT
                        )
                    );
                    // //Demand TC Fees to Student
                    $payfee_tc = [
                        'API_KEY' => $apikey,
                        'inst_id' => $inst_id,
                        'acd_year_id' => $acdyr_id,
                        'student_id' => $student_id,
                        'fee_code_data' => json_encode($feecode_data),
                        'activation_date' => date('Y-m-d')
                    ];
    
                    $demand_tcfee_status = Modules::run('Fees_settings/Fee_structure_controller/save_other_fee_allocation', $payfee_tc);
                }
            }
        }

        $student_details = json_decode($student_data_raw, TRUE);
        //        dev_export($student_details);die;
        $tc_status = $this->MTc->save_tc_data($student_details, $apikey);

        if (!empty($tc_status) && is_array($tc_status) && $tc_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'TC applied successfully', 'data' => array('Tc_app_id' => $tc_status['Tc_app_id']));
        } else {
            if (is_array($tc_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $tc_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'TC application failed to process', 'data' => FALSE);
            }
        }
    }


    public function cancel_tc_preparation($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['student_data']) && !empty($params['student_data'])) {
            $dbparams[1] = $params['student_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        $dbparams[2] = $params['flag'];
        //        dev_export($dbparams);die;
        $tc_cancel_status = $this->MTc->tc_cancel($dbparams);
        if (!empty($tc_cancel_status) && is_array($tc_cancel_status) && $tc_cancel_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => array('student_id' => $tc_cancel_status['student_id']));
        } else {
            if (is_array($tc_cancel_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $tc_cancel_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }


    public function save_tc_preparation($param)
    {

        $student_data_raw = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
            //            dev_export($student_data_raw);die;
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        $student_details = json_decode($student_data_raw, TRUE);
        //        dev_export($student_details);die;
        $tc_status = $this->MTc->save_tcprepare_data($student_details, $apikey);

        if (!empty($tc_status) && is_array($tc_status) && $tc_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'TC Prepared successfully', 'data' => array('Tc_app_id' => $tc_status['Tc_app_id']));
        } else {
            if (is_array($tc_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $tc_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'TC Preparation failed to process', 'data' => FALSE);
            }
        }
    }

    public function get_tc_applied_stud($params = NULL)
    {
        $apikey = $params['API_KEY'];

        if (isset($params['acd_year']) && !empty($params['acd_year'])) {
            $acd_year = $params['acd_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        }

        if (isset($params['batchid']) && !empty($params['batchid'])) {
            $batchid = $params['batchid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch data is required', 'data' => FALSE);
        }

        $details_list = $this->MTc->get_student_details($apikey, $acd_year, $batchid);

        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_tc_prepared_stud($params = NULL)
    {
        $apikey = $params['API_KEY'];

        if (isset($params['acd_year']) && !empty($params['acd_year'])) {
            $acd_year = $params['acd_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        }

        if (isset($params['batchid']) && !empty($params['batchid'])) {
            $batchid = $params['batchid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch data is required', 'data' => FALSE);
        }

        $details_list = $this->MTc->get_student_preparedlist($apikey, $acd_year, $batchid);

        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    //this function written by Elavarasan S @ 16-05-2019 1:10
    public function get_tc_prepared_stud_by_admno($params = NULL)
    {
        $apikey = $params['API_KEY'];

        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $admn_no = $params['admn_no'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Admission Number is required', 'data' => FALSE);
        }

        $details_list = $this->MTc->get_student_preparedlist_by_admno($apikey, $admn_no);

        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function tcissue_data($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['tc_recieved']) && !empty($params['tc_recieved'])) {
            $dbparams[3] = $params['tc_recieved'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'TC recieved person name is required', 'data' => FALSE);
        }
        if (isset($params['tc_issued']) && !empty($params['tc_issued'])) {
            $dbparams[4] = $params['tc_issued'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'TC issued person name is required', 'data' => FALSE);
        }

        $issuedata = $this->MTc->get_student_tcissuedata($dbparams);
        if (!empty($issuedata) && is_array($issuedata)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $issuedata);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }




    public function student_tcdetails_id($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[1] = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }

        $tc_id_details = $this->MTc->tc_details_id($dbparams);
        if (!empty($tc_id_details) && is_array($tc_id_details)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $tc_id_details);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_tc_type($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['instid']) && !empty($params['instid'])) {
            $dbparams[1] = $params['instid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institute ID is required', 'data' => FALSE);
        }

        $tc_type_details = $this->MTc->tc_type_details($dbparams);
        if (!empty($tc_type_details) && is_array($tc_type_details)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $tc_type_details);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    // this function written by ELavarasan S @ 16-05-2019 1:00
    public function get_tc_applied_stud_by_admno($params = NULL)
    {

        $apikey = $params['API_KEY'];

        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $admn_no = $params['admn_no'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Admission Number is required', 'data' => FALSE);
        }

        $details_list = $this->MTc->get_student_details_byadmno($apikey, $admn_no);
        // return $details_list;

        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
