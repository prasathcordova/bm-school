<?php

/**
 * Controls regarding fee structure creation
 * @package Fee-Management
 * @author Aju
 */
class Fee_structure_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Fee_structure_model', 'MFeeStructure');
    }

    public function fee_code_linked_with_template($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $dbparams[1] = $params['inst_id'];
        }

        if (!(isset($params['template_id']) && !empty($params['template_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        } else {
            $dbparams[2] = $params['template_id'];
        }
        $dbparams[3] = 1; //normal feecodes

        $fee_codes = $this->MFeeStructure->get_fee_code_for_template($dbparams);
        if (!empty($fee_codes) && is_array($fee_codes)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $fee_codes);
        } else {
            if (isset($fee_codes['ErrorMessage']) && !empty($fee_codes['ErrorMessage']) && is_array($fee_codes)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $fee_codes['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data load failed', 'data' => FALSE);
            }
        }
    }

    public function fee_code_not_linked_to_template($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $dbparams[1] = $params['inst_id'];
        }

        if (!(isset($params['template_id']) && !empty($params['template_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        } else {
            $dbparams[2] = $params['template_id'];
        }

        $fee_codes = $this->MFeeStructure->get_fee_code_not_in_template($dbparams);
        if (!empty($fee_codes) && is_array($fee_codes) && $fee_codes['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $fee_codes);
        } else {
            if (isset($fee_codes['ErrorMessage']) && !empty($fee_codes['ErrorMessage']) && is_array($fee_codes)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $fee_codes['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data load failed', 'data' => FALSE);
            }
        }
    }

    public function save_fee_code_to_template($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $dbparams[1] = $params['inst_id'];
        }

        if (!(isset($params['template_id']) && !empty($params['template_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template data is required', 'data' => FALSE);
        } else {
            $dbparams[2] = $params['template_id'];
        }
        if (!(isset($params['cur_acd_year_id']) && !empty($params['cur_acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Current academic year data is required', 'data' => FALSE);
        } else {
            $dbparams[3] = $params['cur_acd_year_id'];
        }
        $temp_data = $params['fee_code_link_data'];
        if (!(isset($params['fee_code_link_data']) && !empty($params['fee_code_link_data']) && !empty(json_decode($params['fee_code_link_data'], TRUE)) && count(json_decode($params['fee_code_link_data'], TRUE)) > 0)) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'valid Fee code link data is required', 'data' => FALSE);
        } else {
            $dbparams[4] = $params['fee_code_link_data'];
        }
        $link_status = $this->MFeeStructure->link_fee_codes_to_template($dbparams);

        if (!empty($link_status[0]) && is_array($link_status[0]) && $link_status[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => TRUE);
        } else {
            if (isset($link_status[0]['ErrorMessage']) && !empty($link_status[0]['ErrorMessage']) && is_array($link_status[0])) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $link_status[0]['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data load failed', 'data' => FALSE);
            }
        }
    }

    public function get_class_details_with_linked_template($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $dbparams[1] = $params['inst_id'];
        }

        if (!(isset($params['template_id']) && !empty($params['template_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template data is required', 'data' => FALSE);
        } else {
            $dbparams[2] = $params['template_id'];
        }

        $class_details = $this->MFeeStructure->get_class_details_with_template($dbparams);
        if (!empty($class_details) && is_array($class_details) && $class_details['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $class_details);
        } else {
            if (isset($class_details['ErrorMessage']) && !empty($class_details['ErrorMessage']) && is_array($class_details)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $class_details['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data load failed', 'data' => FALSE);
            }
        }
    }

    public function get_batch_details_with_linked_template($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $dbparams[1] = (int) $params['inst_id'];
        }

        if (!(isset($params['template_id']) && !empty($params['template_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template data is required', 'data' => FALSE);
        } else {
            $dbparams[2] = (int) $params['template_id'];
        }
        if (!(isset($params['acd_yr_id']) && !empty($params['acd_yr_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $dbparams[3] = (int) $params['acd_yr_id'];
        }

        $class_details = $this->MFeeStructure->get_batch_details_with_template($dbparams);
        if (!empty($class_details) && is_array($class_details) && $class_details['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $class_details);
        } else {
            if (isset($class_details['ErrorMessage']) && !empty($class_details['ErrorMessage']) && is_array($class_details)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $class_details['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data load failed', 'data' => FALSE);
            }
        }
    }

    public function get_students_for_fee_template_allocation($params = NULL)
    {

        $apikey = $params['API_KEY'];
        $query_string = "";
        $template_id = $params['template_id'];

        if (isset($params['class_id']) && !empty(isset($params['class_id'])) && $params['class_id'] != -1) {

            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " s.Cur_Class = '" . $params['class_id'] . "' ";
            } else {
                $query_string = " s.Cur_Class  = '" . $params['class_id'] . "'";
            }
        }
        if (isset($params['batch_id']) && !empty(isset($params['batch_id']))) {
            $batch_data_raw = $params['batch_id'];
            $batch_data = json_decode($batch_data_raw);
            $batch_ids = implode(",", $batch_data);
            if (isset($batch_ids) && !empty($batch_ids)) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " s.Cur_Batch  IN (  $batch_ids  ) ";
                } else {
                    $query_string = " s.Cur_Batch  IN (  $batch_ids  ) ";
                }
            }
        }
        if (isset($params['Session_ID']) && !empty($params['Session_ID'])) {
            //                echo strlen($params['Session_ID']);die;
            if (strlen($query_string) > 0) {


                $query_string = $query_string . " AND " . " bd.Session_ID = '" . $params['Session_ID'] . "' ";
            } else {
                $query_string = " bd.Session_ID  = '" . $params['Session_ID'] . "'";
            }
        }
        if (isset($params['Stream_ID']) && !empty($params['Stream_ID'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " s.Cur_Stream = '" . $params['Stream_ID'] . "' ";
            } else {
                $query_string = " s.Cur_Stream  = '" . $params['Stream_ID'] . "'";
            }
        }
        if (isset($params['Acd_Year']) && !empty($params['Acd_Year'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " s.Cur_AcadYr = '" . $params['Acd_Year'] . "' ";
            } else {
                $query_string = " s.Cur_AcadYr  = '" . $params['Acd_Year'] . "'";
            }
        }
        if (isset($params['gender']) && !empty($params['gender'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " s.Sex = '" . $params['gender'] . "' ";
            } else {
                $query_string = " s.Sex  = '" . $params['gender'] . "'";
            }
        }
        if (isset($params['religion']) && !empty($params['religion'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " s.Religion = '" . $params['religion'] . "' ";
            } else {
                $query_string = " s.Religion  = '" . $params['religion'] . "'";
            }
        }
        if (isset($params['adminno']) && !empty($params['adminno'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " s.Admn_no LIKE '%" . $params['adminno'] . "%' ";
            } else {
                $query_string = " s.Admn_no LIKE '%" . $params['adminno'] . "%' ";
            }
        }
        if (isset($params['nationality']) && !empty($params['nationality'])) {
            if (strlen($query_string) > 0) {
                if ($params['nationality'] == 1) {
                    $query_string = $query_string;
                } else if ($params['nationality'] == 2) {
                    $query_string = $query_string . " AND " . " s.Nationality = '" . $params['nationality'] . "' ";
                } else if ($params['nationality'] == 3) {
                    $query_string = $query_string . " AND " . " s.Nationality <> 2 ";
                }
            } else {
                if ($params['nationality'] == 1) {
                    $query_string = $query_string;
                } else if ($params['nationality'] == 2) {
                    $query_string = " s.Nationality = '" . $params['nationality'] . "' ";
                } else if ($params['nationality'] == 3) {
                    $query_string = " s.Nationality <> 2'";
                }
            }
        }
        $data = $this->MFeeStructure->get_student_details_for_template_alloc($query_string, $template_id, $apikey);
        if (!empty($data) && is_array($data)) {
            return array('status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $data);
        } else {
            return array('status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function check_other_fee_code_demanded($params = NULL)
    {

        $apikey         = $params['API_KEY'];
        $feecode_id     = $params['feecode_id'];
        $batch_id       = $params['batch_id'];
        $academic_year  = $params['academic_year'];
        $inst_id       = $params['inst_id'];

        $data = $this->MFeeStructure->check_other_fee_code_demanded($apikey, $feecode_id, $batch_id, $academic_year, $inst_id);
        if (!empty($data) && is_array($data)) {
            return array('status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $data);
        } else {
            return array('status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_bus_fee_demanded_details($params)
    {
        $api_key = $params['API_KEY'];
        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Current academic year data is required', 'data' => FALSE);
        } else {
            $academic_year = $params['acd_year_id'];
        }
        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        $data = $this->MFeeStructure->get_bus_fee_demanded_details($api_key, $inst_id, $academic_year, $student_id);
        if (!empty($data) && is_array($data)) {
            return array('status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $data);
        } else {
            return array('status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    //FEE ALLOCATION WITH TEMPLATE
    public function save_periodic_fee_allocation_with_students($params)
    {
        $api_key = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['cur_acd_year']) && !empty($params['cur_acd_year']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Current academic year data is required', 'data' => FALSE);
        } else {
            $cur_acd_year_id = $params['cur_acd_year'];
        }

        if (!(isset($params['template_id']) && !empty($params['template_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        } else {
            $template_id = $params['template_id'];
        }

        if (!(isset($params['student_data']) && !empty($params['student_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_data = $params['student_data'];
        }

        $student_data_raw = $params['student_data_one_time'];

        if (!(isset($params['activation_date']) && !empty($params['activation_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Activation date is required', 'data' => FALSE);
        } else {
            $activation_date = $params['activation_date'];
        }


        if (!(isset($params['amount_array']) && !empty($params['amount_array']))) {
            $amount_array = [];
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Activation date is required', 'data' => FALSE);
        } else {
            $amount_array = $params['amount_array'];
            // return $amount_array;
        }
        if (isset($amount_array['type']) && $amount_array['type'] == 'F002') {
            $template_data = $this->MFeeStructure->get_bus_template_id($api_key, $inst_id);
            $template_id = $template_data['id'];
        }

        $fee_allocaton_data = $this->code_all_fee_allocation_with_template($template_id, $student_data, $activation_date, $inst_id, $cur_acd_year_id, $api_key, $amount_array);
        // return $fee_allocaton_data;
        if (!(isset($fee_allocaton_data['data_status']) && !empty($fee_allocaton_data['data_status']) && $fee_allocaton_data['data_status'] == 1)) {
            if (isset($fee_allocaton_data['message']) && !empty($fee_allocaton_data['message'])) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $fee_allocaton_data['message'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'An error encountered while processing data. Please contact administrator for further assistance.', 'data' => FALSE);
            }
        }
        //Bus fee Deallocation
        if (isset($amount_array['status']) && $amount_array['status'] == 'disable') {
            $data_to_deallocate = array(
                $api_key,
                $inst_id,
                $cur_acd_year_id,
                $student_data,
                $activation_date,
                $template_id
            );

            //return $data_to_deallocate;
            $deallocation_status = $this->MFeeStructure->save_fee_deallocation_with_students($data_to_deallocate);
            if (isset($deallocation_status[0]) && !empty($deallocation_status) && is_array($deallocation_status) && $deallocation_status[0]['ErrorStatus'] == 0) {
                return array('deallocation_status' => 1, 'error_status' => 0, 'message' => 'Data Created / Updated successfully', 'data' => $deallocation_status);
            } else {
                if (isset($deallocation_status[0]['ErrorMessage']) && !empty($deallocation_status[0]['ErrorMessage']) && is_array($deallocation_status)) {
                    return array('deallocation_status' => 0, 'error_status' => 0, 'message' => $deallocation_status[0]['ErrorMessage'], 'data' => $deallocation_status[0]);
                } else {
                    return array('deallocation_status' => 0, 'error_status' => 0, 'message' => 'Data Creation / Update failed', 'data' => FALSE);
                }
            }
        }

        $data_to_save = array(
            $api_key,
            $inst_id,
            $cur_acd_year_id,
            json_encode($fee_allocaton_data['student_data']),
            $fee_allocaton_data['student_count'],
            $fee_allocaton_data['data'],
            $template_id,
            $fee_allocaton_data['allocation_summary_data']
        );

        // return $data_to_save;
        $data_status = $this->MFeeStructure->save_fee_allocation_with_students($data_to_save, $amount_array);

        //Code to One time Adjustment
        $payfee_one_time = [
            'API_KEY' => $api_key,
            'inst_id' => $inst_id,
            'acd_year_id' => $cur_acd_year_id,
            'student_data' => $student_data_raw
        ];
        //One time Adjustment Disabled by Request of School Mgmt
        // $one_time_status = Modules::run('Fees_settings/Fee_collection_controller/save_one_time_adjustment_with_wallet_to_pending_pay', $payfee_one_time);

        // return $one_time_status;
        if (isset($data_status[0]) && !empty($data_status) && is_array($data_status) && $data_status[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Created / Updated successfully', 'data' => $data_status);
        } else {
            if (isset($data_status[0]['ErrorMessage']) && !empty($data_status[0]['ErrorMessage']) && is_array($data_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $data_status[0]['ErrorMessage'], 'data' => $data_status[0]);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data Creation / Update failed', 'data' => FALSE);
            }
        }
    }
    private function code_all_fee_allocation_with_template($template_id, $student_data_raw, $activation_date, $inst_id, $cur_acd_year_id, $apikey, $amount_array = [])
    {
        //System parameter data
        $system_parameter_data = $this->MFeeStructure->get_system_data_for_processing($inst_id, $apikey);
        if (!(isset($system_parameter_data) && !empty($system_parameter_data) && count($system_parameter_data) > 0)) {
            return array('data_status' => 0, 'message' => 'Critical Error. Cannot get system parameters. Please contact administrator');
        }
        $acd_start_date = '';
        $acd_end_date = '';
        $arrear_day = '';
        $fee_demand_day = '';
        foreach ($system_parameter_data as $value) {
            if ($value['Code'] == 'ACD_START_DATE') {
                $acd_start_date = $value['Code_Value'];
            }
            if ($value['Code'] == 'ACD_END_DATE') {
                $acd_end_date = $value['Code_Value'];
            }
            if ($value['Code'] == 'ARREAR_DAY') {
                $arrear_day = $value['Code_Value'];
            }
            if ($value['Code'] == 'FEE_DEMAND_DATE_MONTHLY') {
                $fee_demand_day = $value['Code_Value'];
            }
            if ($value['Code'] == 'IS_VACATION_MONTH_ACTIVATED') {
                $is_vacation_month_activated = $value['Code_Value'];
            }

            if ($value['Code'] == 'LS_VECC1') {
                $LS_VECC1 = $value['Code_Value'];
            }
            if ($value['Code'] == 'LS_VECC2') {
                $LS_VECC2 = $value['Code_Value'];
            }
        }
        $vacation_month1 = date("m", mktime(0, 0, 0, $LS_VECC1, 10));
        $vacation_month2 = date("m", mktime(0, 0, 0, $LS_VECC2, 10));

        $acd_year_end_date_object = new DateTime($acd_end_date);
        $cur_acd_end_month = $acd_year_end_date_object->format('Y-m');
        $cur_acd_end_date = $acd_year_end_date_object->modify('last day of this month')->format('Y-m-d');
        $cur_acd_end_date_timestamp = strtotime($cur_acd_end_date);

        if (isset($amount_array['end_date'])) {
            $acd_year_end_date_object = new DateTime($amount_array['end_date']);
            $cur_acd_end_month = $acd_year_end_date_object->format('Y-m');
            $cur_acd_end_date = $acd_year_end_date_object->modify('last day of this month')->format('Y-m-d');
            $cur_acd_end_date_timestamp = strtotime($cur_acd_end_date);
        }

        // -- **
        // $activation_date_object = new DateTime($activation_date);
        // $activation_date_object->modify('first day of this month');
        // $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
        // $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);

        // $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
        // $nxt_month = date("Y-m-d", strtotime("+1 month", strtotime($activation_date_intial)));
        // $activation_date_object = new DateTime($nxt_month);
        // $activation_date_object->modify('first day of this month');
        // $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
        // $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
        // -- **

        //Fee code data
        $feetype = 1; //Normal Fee
        if (isset($amount_array['type']) && $amount_array['type'] == 'F002') {
            $feetype = 2; // BUS FEE
        }
        $dbparams = array();
        $dbparams[0] = $apikey;
        $dbparams[1] = $inst_id;
        $dbparams[2] = $template_id;
        $dbparams[3] = $feetype; //1 normal feecodes, 2 bus feecode
        $fee_codes_raw = $this->MFeeStructure->get_fee_code_for_template($dbparams);

        //return $fee_codes_raw;

        if (!(!empty($fee_codes_raw) && is_array($fee_codes_raw))) {
            if (isset($fee_codes_raw['ErrorMessage']) && !empty($fee_codes_raw['ErrorMessage']) && is_array($fee_codes_raw)) {
                return array('data_status' => 0, 'message' => $fee_codes_raw['ErrorMessage']);
            } else {
                return array('data_status' => 0, 'message' => 'Fee codes not available. Please link fee codes and try again later.');
            }
        }

        $student_id_check = array();
        $fee_allocation = array();
        $fee_term_data = array();
        $student_data = json_decode($student_data_raw, TRUE);
        $student_allocation_details = array();
        if (isset($amount_array['amount'])) {
            $type = $amount_array['type'];
            $fee_amount = $amount_array['amount'];
        } else {
            $fee_amount = 0;
            $type = '';
        }
        $activation_date_starting = $activation_date;
        foreach ($student_data as $students) {
            $student_id = $students['student_id'];
            $student_id_check[] = array('student_id' => $student_id);
            foreach ($fee_codes_raw as $fee_codes) {

                if ($type == 'F002') {
                    $fee_amount = $fee_amount;
                } else {
                    $fee_amount = $fee_codes['fee_amount'];
                }
                $student_allocation_details[] = array(
                    'student_id' => $student_id,
                    'allocation_start_month' => $activation_date,
                    'allocation_end_month' => $cur_acd_end_month,
                    'fee_code_id' => $fee_codes['fee_codes_id'],
                    'demand_type' => $fee_codes['demand_type_id'],
                    'amount' => $fee_amount
                );
                if ($fee_codes['is_recurring'] == 2) {

                    /** */
                    $dbtermitems = array();
                    $dbtermitems['API_KEY'] = $apikey;
                    $dbtermitems['inst_id'] = $inst_id;
                    $dbtermitems['acd_year_id'] = $cur_acd_year_id;
                    $dbtermitems['fee_codes_id'] = $fee_codes['fee_codes_id'];
                    $dbtermitems['checking_date'] = date('Y-m-01', strtotime($activation_date));
                    $dbtermitems['monthspan'] = $fee_codes['monthSpan'];
                    $dbtermitems['student_id'] = $student_id;

                    $demand_starting_date_detail = $this->get_demand_starting_date_for_updating_fee_amount($dbtermitems);
                    $activation_date = $demand_starting_date_detail['data'];
                    /** */

                    $activation_date_object = new DateTime($activation_date);
                    $activation_date_object->modify('first day of this month');
                    $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                    $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                    $demanded_month = $activation_date_object->format('Y-m');

                    $mnthonly = $activation_date_object->format('m');
                    // $mspan = $fee_codes['monthSpan'];
                    $vcarray = array();

                    $j = 0;
                    $i = 0;
                    while ($j == 0) {
                        $loon_cur_month = $activation_date_object->format('Y-m');
                        $loon_cur_month_timestamp = strtotime($activation_date_object->format('Y-m-d'));
                        if ($cur_acd_end_date_timestamp > $loon_cur_month_timestamp) {

                            if ($mnthonly == $vacation_month1 || $mnthonly == $vacation_month2) {
                                $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
                                $month_interval = "+1 month";
                                $nxt_month = date("Y-m-d", strtotime($month_interval, strtotime($activation_date_intial)));
                                //$monthName = date("m", strtotime('+1 month', mktime(0, 0, 0, $monthNum, 10)));
                                $activation_date_object = new DateTime($nxt_month);
                            } else {
                                $fee_allocation[] = array(
                                    'student_id' => $student_id,
                                    'demand_type' => $fee_codes['demand_type_id'],
                                    'fee_code_id' => $fee_codes['fee_codes_id'],
                                    'demand_amount' => $fee_amount,
                                    'demand_arrear_date' => $arrear_date,
                                    'demanded_date' => $demand_date,
                                    'demanded_month' => $demanded_month,
                                    'transaction_desc' => $fee_codes['description'] . ' demanded for the month of ' . strtolower($activation_date_object->format('F - Y')) . ' of the student',
                                );
                                $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
                                $month_interval = "+" . $fee_codes['monthSpan'] . " month";
                                $nxt_month = date("Y-m-d", strtotime($month_interval, strtotime($activation_date_intial)));
                                //$monthName = date("m", strtotime('+1 month', mktime(0, 0, 0, $monthNum, 10)));
                                $activation_date_object = new DateTime($nxt_month);
                            }


                            $vcarray[] = $activation_date_object;
                            $activation_date_object->modify('first day of this month');
                            $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                            $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                            $demanded_month = $activation_date_object->format('Y-m');
                            $mnthonly = $activation_date_object->format('m');
                        } else {
                            $j = 1;
                        }
                    }
                }
                //Salahudheen => OCT 11, 2019 : Demanding Term Fee - STARTS
                else if ($fee_codes['is_recurring'] == 3) {
                    // $activation_date = date('Y-m',strtotime($activation_date));
                    $activation_date1 = date('Y-m', strtotime($activation_date_starting));
                    //getting Term datails of FeeCode
                    $dbtermitems = array();
                    $dbtermitems['API_KEY'] = $apikey;
                    $dbtermitems['inst_id'] = $inst_id;
                    $dbtermitems['acd_year_id'] = $cur_acd_year_id;
                    $dbtermitems['fee_codes_id'] = $fee_codes['fee_codes_id'];

                    $fee_term_data = $this->get_term_details_for_feecode($dbtermitems);
                    //getting Term datails of FeeCode$fee_term_data
                    // return $fee_term_data;

                    //if (is_array($fee_term_data['data'])) {
                    foreach ($fee_term_data['data'] as $ftd) {
                        $mntarray = array();
                        $start    = (new DateTime($ftd['term_fromdate'])); //->modify('first day of this month');
                        $end      = (new DateTime($ftd['term_todate'])); //->modify('first day of next month');
                        $interval = DateInterval::createFromDateString('1 month');
                        $period   = new DatePeriod($start, $interval, $end);
                        foreach ($period as $dt) {
                            $mntarray[] = $dt->format("Y-m");
                        }
                        $arrlen = count($mntarray);
                        $activation_date_object1 = new DateTime($ftd['term_fromdate']);
                        $activation_date_object1->modify('first day of this month');
                        $demand_date = $activation_date_object1->format('Y-m-' . $fee_demand_day);
                        $arrear_date = $activation_date_object1->format('Y-m-' . $arrear_day);
                        $demanded_month = $activation_date_object1->format('Y-m');
                        //$activation_date1 = $activation_date_object1->format('Y-m');
                        if (in_array($activation_date1, $mntarray)) {
                            $fee_allocation[] = array(
                                'student_id' => $student_id,
                                'demand_type' => $fee_codes['demand_type_id'],
                                'fee_code_id' => $fee_codes['fee_codes_id'],
                                'demand_amount' => $fee_amount,
                                'demand_arrear_date' => $arrear_date,
                                'demanded_date' => $demand_date,
                                'demanded_month' => $demanded_month,
                                'transaction_desc' => $fee_codes['description'] . ' demanded as ' . $ftd['Term_Name'],
                            );
                            $activation_date_intial1 = $activation_date_object1->modify('first day of this month')->format('Y-m-d');
                            $month_interval1 = "+" . $arrlen . " month";
                            $activation_date1 = date("Y-m", strtotime($month_interval1, strtotime($activation_date_intial1)));
                        }
                        // return $fee_allocation;
                    }
                    //}
                    //$fee_allocation = array_merge($fee_allocation, $fee_allocation1);
                    //array_push($fee_allocation, $fee_allocation1);
                }
                //Salahudheen => OCT 11, 2019 : Demanding Term Fee - ENDS
                else if ($fee_codes['is_recurring'] == 1) {
                    $activation_date_object = new DateTime($activation_date);
                    $activation_date_object->modify('first day of this month');
                    $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                    $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                    $demanded_month = $activation_date_object->format('Y-m');
                    $fee_allocation[] = array(
                        'student_id' => $student_id,
                        'demand_type' => $fee_codes['demand_type_id'],
                        'fee_code_id' => $fee_codes['fee_codes_id'],
                        'demand_amount' => $fee_amount,
                        'demand_arrear_date' => $arrear_date,
                        'demanded_date' => $demand_date,
                        'demanded_month' => $demanded_month,
                        'transaction_desc' => $fee_codes['description'] . ' demanded for the month of ' . strtolower($activation_date_object->format('F - Y')) . ' of the student',
                    );
                }
            }
        }

        return array(
            'data_status' => 1,
            'message' => 'Data processed successfully',
            'data' => json_encode($fee_allocation), //'fc : ' . count($fee_codes_raw), 
            //'data' => $fee_allocation1,
            //'data' => json_encode($vcarray),
            'student_data' => $student_id_check,
            'student_count' => count($student_id_check),
            'allocation_summary_data' => json_encode($student_allocation_details)
        );
    }
    public function get_term_details_for_feecode($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = $params['inst_id'];
        $dbparams[2] = $params['acd_year_id'];
        $dbparams[3] = $params['fee_codes_id'];

        $fee_term_data = $this->MFeeStructure->get_term_details_for_feecode($dbparams);
        if (!empty($fee_term_data) && is_array($fee_term_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $fee_term_data);
        } else {
            if (isset($fee_term_data['ErrorMessage']) && !empty($fee_term_data['ErrorMessage']) && is_array($fee_term_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $fee_term_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data load failed', 'data' => FALSE);
            }
        }
    }
    public function get_demand_starting_date_for_updating_fee_amount($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = $params['inst_id'];
        $dbparams[2] = $params['acd_year_id'];
        $dbparams[3] = $params['fee_codes_id'];
        $dbparams[4] = $params['checking_date'];
        $dbparams[5] = $params['monthspan'];
        $dbparams[6] = $params['student_id'];
        $demand_starting_date = $this->MFeeStructure->get_demand_starting_date_for_updating_fee_amount($dbparams);
        if (!empty($demand_starting_date) && is_array($demand_starting_date)) {
            // return $demand_starting_date['demand_date'];
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $demand_starting_date['demand_date']);
        } else {
            if (isset($demand_starting_date['ErrorMessage']) && !empty($demand_starting_date['ErrorMessage']) && is_array($demand_starting_date)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $demand_starting_date['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data load failed', 'data' => FALSE);
            }
        }
    }
    public function get_student_list_with_fee_allocated($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $dbparams[1] = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $dbparams[2] = $params['acd_year_id'];
        }

        if (!(isset($params['template_id']) && !empty($params['template_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        } else {
            $dbparams[3] = $params['template_id'];
        }


        $fee_codes = $this->MFeeStructure->get_student_list_for_template($dbparams);
        if (!empty($fee_codes) && is_array($fee_codes)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $fee_codes);
        } else {
            if (isset($fee_codes['ErrorMessage']) && !empty($fee_codes['ErrorMessage']) && is_array($fee_codes)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $fee_codes['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data load failed', 'data' => FALSE);
            }
        }
    }

    public function save_de_allocation_of_students_from_template($params)
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

        if (!(isset($params['template_id']) && !empty($params['template_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        } else {
            $template_id = $params['template_id'];
        }
        if (!(isset($params['student_data']) && !empty($params['student_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_data = $params['student_data'];
        }

        $student_count = count(json_decode($student_data, TRUE));

        $data = array(
            $apikey, $inst_id, $acd_year_id, $student_data, $student_count, $template_id
        );
        $status = $this->MFeeStructure->de_allocate_students_from_template($data);

        if (isset($status[0]) && !empty($status[0]) && is_array($status[0])) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $status);
        } else {
            if (isset($status[0]['ErrorMessage']) && !empty($status[0]['ErrorMessage'])) { //&& $status($fee_codes[0])
                return array('data_status' => 0, 'error_status' => 0, 'message' => $status[0]['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data load failed', 'data' => FALSE);
            }
        }
    }

    //OTHER FEE ALLOCATION STUDENT WISE
    public function save_other_fee_allocation($params)
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
        if (!(isset($params['fee_code_data']) && !empty($params['fee_code_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee code data is required', 'data' => FALSE);
        } else {
            $fee_code_data = $params['fee_code_data'];
        }
        if (!(isset($params['activation_date']) && !empty($params['activation_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand Date required', 'data' => FALSE);
        } else {
            $activation_date = $params['activation_date'];
        }


        $fee_allocaton_data = $this->configure_fee_code_data_for_non_demandable_data($fee_code_data, $student_id, $inst_id, $apikey, $activation_date);
        //return $fee_allocaton_data;
        if (!(isset($fee_allocaton_data['data_status']) && !empty($fee_allocaton_data['data_status']) && $fee_allocaton_data['data_status'] == 1)) {
            if (isset($fee_allocaton_data['message']) && !empty($fee_allocaton_data['message'])) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $fee_allocaton_data['message'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'An error encountered while processing data. Please contact administrator for further assistance.', 'data' => FALSE);
            }
        }
        $data_to_save = array(
            $apikey, $inst_id, $acd_year_id, $student_id, $fee_allocaton_data['data']
        );

        $data_status = $this->MFeeStructure->save_non_demandable_fee_allocation_with_students($data_to_save);

        if (isset($data_status[0]) && !empty($data_status) && is_array($data_status) && $data_status[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Created / Updated successfully', 'data' => $data_status);
        } else {
            if (isset($data_status[0]['ErrorMessage']) && !empty($data_status[0]['ErrorMessage']) && is_array($data_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $data_status[0]['ErrorMessage'], 'data' => $data_status[0]);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data Creation / Update failed', 'data' => FALSE);
            }
        }
    }
    private function configure_fee_code_data_for_non_demandable_data($fee_code_data_string, $student_id, $inst_id, $apikey, $activation_date)
    {
        //activation_date
        //$activation_date = date('Y-m');
        $activation_date = date('Y-m-d', strtotime($activation_date));
        //System parameter data
        $system_parameter_data = $this->MFeeStructure->get_system_data_for_processing($inst_id, $apikey);
        if (!(isset($system_parameter_data) && !empty($system_parameter_data) && count($system_parameter_data) > 0)) {
            return array('data_status' => 0, 'message' => 'Critical Error. Cannot get system parameters. Please contact administrator');
        }
        $acd_start_date = '';
        $acd_end_date = '';
        $arrear_day = '';
        $fee_demand_day = '';
        $is_vacation_month_activated = 0;
        foreach ($system_parameter_data as $value) {
            if ($value['Code'] == 'ACD_START_DATE') {
                $acd_start_date = $value['Code_Value'];
            }
            if ($value['Code'] == 'ACD_END_DATE') {
                $acd_end_date = $value['Code_Value'];
            }
            if ($value['Code'] == 'ARREAR_DAY') {
                $arrear_day = $value['Code_Value'];
            }
            if ($value['Code'] == 'FEE_DEMAND_DATE_MONTHLY') {
                $fee_demand_day = $value['Code_Value'];
            }
            if ($value['Code'] == 'IS_VACATION_MONTH_ACTIVATED') {
                $is_vacation_month_activated = $value['Code_Value'];
            }
        }
        $vacation_month_data = NULL;
        if ($is_vacation_month_activated == 1) {
            $vacations = $this->MFeeStructure->get_vacation_month_details($inst_id, $apikey);
            if (isset($vacations['data']) && !empty($vacations['data'])) {
                $vacation_month_data = $vacations['data'];
            } else {
                $vacation_month_data = NULL;
            }
        }

        $acd_year_end_date_object = new DateTime($acd_end_date);
        $cur_acd_end_month = $acd_year_end_date_object->format('Y-m');

        //$activation_date_object = new DateTime($activation_date);
        // $activation_date_object->modify('first day of this month');
        // $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
        // $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);

        // $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
        // $nxt_month = date("Y-m-d", strtotime("+1 month", strtotime($activation_date_intial)));
        // $activation_date_object = new DateTime($nxt_month);
        // $activation_date_object->modify('first day of this month');
        // $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
        // $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);

        //        $va_date_object = new DateTime();
        //Fee code data
        $dbparams = array();
        $dbparams[0] = $apikey;
        $dbparams[1] = $inst_id;
        $dbparams[2] = $fee_code_data_string;
        $fee_codes_raw = $this->MFeeStructure->get_fee_code_for_non_demand_allocation($dbparams);

        if (!(!empty($fee_codes_raw) && is_array($fee_codes_raw))) {
            if (isset($fee_codes_raw['ErrorMessage']) && !empty($fee_codes_raw['ErrorMessage']) && is_array($fee_codes_raw)) {
                return array('data_status' => 0, 'message' => $fee_codes_raw['ErrorMessage']);
            } else {
                return array('data_status' => 0, 'message' => 'Fee codes not available. Please link fee codes and try again later.');
            }
        }
        $fee_code_data = json_decode($fee_code_data_string, TRUE);
        $fee_allocation = array();
        foreach ($fee_codes_raw as $fee_codes) {
            $key = array_search($fee_codes['fee_codes_id'], array_column($fee_code_data, 'fee_code_id'));
            $fee_code_value = $fee_code_data[$key]['value_for_fee'];

            if ($fee_codes['is_recurring'] == 2) {
                $activation_date_object = new DateTime($activation_date);
                $activation_date_object->modify('first day of this month');
                $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                $demanded_month = $activation_date_object->format('Y-m');
                $j = 0;
                while ($j == 0) {
                    $loon_cur_month = $activation_date_object->format('Y-m');
                    if ($cur_acd_end_month === $loon_cur_month) {
                        $j = 1;
                    }
                    $fee_allocation[] = array(
                        'fee_code_id' => $fee_codes['fee_codes_id'],
                        'demand_amount' => $fee_code_value,
                        'demand_arrear_date' => $arrear_date,
                        'demanded_date' => $demand_date,
                        'demanded_month' => $demanded_month,
                        'transaction_desc' => $fee_codes['description'] . ' demanded for the month of ' . strtolower($activation_date_object->format('F - Y')) . ' of the student',
                    );

                    $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
                    $month_interval = "+" . $fee_codes['monthSpan'] . " months";
                    $nxt_month = date("Y-m-d", strtotime($month_interval, strtotime($activation_date_intial)));

                    $activation_date_object = new DateTime($nxt_month);
                    $activation_date_object->modify('first day of this month');
                    $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                    $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                    $demanded_month = $activation_date_object->format('Y-m');
                }
            } else if ($fee_codes['is_recurring'] == 1) {
                // $activation_date_object = new DateTime($activation_date);
                // $activation_date_object->modify('first day of this month');
                // $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                // $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                // $demanded_month = $activation_date_object->format('Y-m');
                $fee_allocation[] = array(
                    'fee_code_id' => $fee_codes['fee_codes_id'],
                    'demand_amount' => $fee_code_value,
                    'demand_arrear_date' => $activation_date, //$arrear_date,
                    'demanded_date' => $activation_date, //$demand_date,
                    'demanded_month' => date('Y-m', strtotime($activation_date)), //$demanded_month,
                    //'transaction_desc' => $fee_codes['description'] . ' demanded for the month of ' . strtolower($activation_date_object->format('F - Y')) . ' of the student',
                    'transaction_desc' => $fee_codes['description'] . ' demanded for the month of ' . strtolower(date('F-Y', strtotime($activation_date))) . ' of the student',
                );
            }
        }
        return array(
            'data_status' => 1,
            'message' => 'Data processed successfully',
            'data' => json_encode($fee_allocation)
        );
    }

    //OTHER FEE ALLOCATION CLASSWISE
    public function save_other_fee_allocation_classwise($params)
    {
        $api_key = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['cur_acd_year']) && !empty($params['cur_acd_year']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Current academic year data is required', 'data' => FALSE);
        } else {
            $cur_acd_year_id = $params['cur_acd_year'];
        }

        if (!(isset($params['feecode_id']) && !empty($params['feecode_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Feecode is required', 'data' => FALSE);
        } else {
            $feecode_id = $params['feecode_id'];
        }
        if (!(isset($params['student_data']) && !empty($params['student_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_data = $params['student_data'];
        }

        if (!(isset($params['feeamount']) && !empty($params['feeamount']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee Amount is required', 'data' => FALSE);
        } else {
            $feeamount = $params['feeamount'];
        }

        if (!(isset($params['fee_code_data']) && !empty($params['fee_code_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee code data is required', 'data' => FALSE);
        } else {
            $fee_code_data = $params['fee_code_data'];
        }
        if (!(isset($params['activation_date']) && !empty($params['activation_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand Date required', 'data' => FALSE);
        } else {
            $activation_date = $params['activation_date'];
        }
        $fee_allocaton_data = $this->code_all_other_fee_allocation_classwise($fee_code_data, $feecode_id, $student_data, $feeamount, $inst_id, $cur_acd_year_id, $api_key, $activation_date);

        if (!(isset($fee_allocaton_data['data_status']) && !empty($fee_allocaton_data['data_status']) && $fee_allocaton_data['data_status'] == 1)) {
            if (isset($fee_allocaton_data['message']) && !empty($fee_allocaton_data['message'])) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $fee_allocaton_data['message'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'An error encountered while processing data. Please contact administrator for further assistance.', 'data' => FALSE);
            }
        }
        $data_to_save = array(
            $api_key, $inst_id, $cur_acd_year_id, json_encode($fee_allocaton_data['student_data']), $fee_allocaton_data['student_count'], $fee_allocaton_data['data'], $feecode_id, $fee_allocaton_data['allocation_summary_data']
        );

        $data_status = $this->MFeeStructure->save_other_fee_allocation_classwise($data_to_save);

        if (isset($data_status[0]) && !empty($data_status) && is_array($data_status) && $data_status[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Created / Updated successfully', 'data' => $data_status);
        } else {
            if (isset($data_status[0]['ErrorMessage']) && !empty($data_status[0]['ErrorMessage']) && is_array($data_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $data_status[0]['ErrorMessage'], 'data' => $data_status[0]);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data Creation / Update failed', 'data' => FALSE);
            }
        }
    }
    private function code_all_other_fee_allocation_classwise($fee_code_data_string, $feecode_id, $student_data_raw, $feeamount, $inst_id, $cur_acd_year_id, $apikey, $activation_date)
    {
        //activation_date
        //$activation_date = date('Y-m');
        $activation_date = date('Y-m-d', strtotime($activation_date));
        //System parameter data
        $system_parameter_data = $this->MFeeStructure->get_system_data_for_processing($inst_id, $apikey);
        if (!(isset($system_parameter_data) && !empty($system_parameter_data) && count($system_parameter_data) > 0)) {
            return array('data_status' => 0, 'message' => 'Critical Error. Cannot get system parameters. Please contact administrator');
        }
        $acd_start_date = '';
        $acd_end_date = '';
        $arrear_day = '';
        $fee_demand_day = '';
        $is_vacation_month_activated = 0;
        foreach ($system_parameter_data as $value) {
            if ($value['Code'] == 'ACD_START_DATE') {
                $acd_start_date = $value['Code_Value'];
            }
            if ($value['Code'] == 'ACD_END_DATE') {
                $acd_end_date = $value['Code_Value'];
            }
            if ($value['Code'] == 'ARREAR_DAY') {
                $arrear_day = $value['Code_Value'];
            }
            if ($value['Code'] == 'FEE_DEMAND_DATE_MONTHLY') {
                $fee_demand_day = $value['Code_Value'];
            }
            if ($value['Code'] == 'IS_VACATION_MONTH_ACTIVATED') {
                $is_vacation_month_activated = $value['Code_Value'];
            }
        }
        $vacation_month_data = NULL;
        if ($is_vacation_month_activated == 1) {
            $vacations = $this->MFeeStructure->get_vacation_month_details($inst_id, $apikey);
            if (isset($vacations['data']) && !empty($vacations['data'])) {
                $vacation_month_data = $vacations['data'];
            } else {
                $vacation_month_data = NULL;
            }
        }

        $acd_year_end_date_object = new DateTime($acd_end_date);
        $cur_acd_end_month = $acd_year_end_date_object->format('Y-m');
        //Copied From periodic fee Allocation function SALAH        
        $cur_acd_end_date = $acd_year_end_date_object->modify('last day of this month')->format('Y-m-d');
        $cur_acd_end_date_timestamp = strtotime($cur_acd_end_date);
        //Copied From periodic fee Allocation function SALAH

        // $activation_date_object = new DateTime($activation_date);
        // $activation_date_object->modify('first day of this month');
        // $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
        // $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);

        // $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
        // $nxt_month = date("Y-m-d", strtotime("+1 month", strtotime($activation_date_intial)));
        // $activation_date_object = new DateTime($nxt_month);
        // $activation_date_object->modify('first day of this month');
        // $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
        // $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);

        //        $va_date_object = new DateTime();
        //Fee code data
        $dbparams = array();
        $dbparams[0] = $apikey;
        $dbparams[1] = $inst_id;
        $dbparams[2] = $fee_code_data_string;
        $fee_codes_raw = $this->MFeeStructure->get_fee_code_for_non_demand_allocation($dbparams);

        if (!(!empty($fee_codes_raw) && is_array($fee_codes_raw))) {
            if (isset($fee_codes_raw['ErrorMessage']) && !empty($fee_codes_raw['ErrorMessage']) && is_array($fee_codes_raw)) {
                return array('data_status' => 0, 'message' => $fee_codes_raw['ErrorMessage']);
            } else {
                return array('data_status' => 0, 'message' => 'Fee codes not available. Please link fee codes and try again later.');
            }
        }
        $fee_code_data = json_decode($fee_code_data_string, TRUE);
        $student_id_check = array();
        $fee_allocation = array();
        $student_data = json_decode($student_data_raw, TRUE);
        $student_allocation_details = array();
        foreach ($student_data as $students) {
            $student_id = $students['student_id'];
            $student_id_check[] = array('student_id' => $student_id);

            foreach ($fee_codes_raw as $fee_codes) {

                $student_allocation_details[] = array(
                    'student_id' => $student_id,
                    'allocation_start_month' => $activation_date,
                    'allocation_end_month' => date('Y-m', strtotime($activation_date)), //$cur_acd_end_month,
                    'fee_code_id' => $fee_codes['fee_codes_id'],
                    'demand_type' => $fee_codes['demand_type_id'],
                    'amount' => $feeamount
                );
                if ($fee_codes['is_recurring'] == 2) {
                    $activation_date_object = new DateTime($activation_date);
                    $activation_date_object->modify('first day of this month');
                    $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                    $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                    $demanded_month = $activation_date_object->format('Y-m');

                    $j = 0;
                    $i = 0;
                    while ($j == 0) {
                        $loon_cur_month = $activation_date_object->format('Y-m');
                        $loon_cur_month_timestamp = strtotime($activation_date_object->format('Y-m-d'));
                        if ($cur_acd_end_date_timestamp > $loon_cur_month_timestamp) {
                            $fee_allocation[] = array(
                                'student_id' => $student_id,
                                'demand_type' => $fee_codes['demand_type_id'],
                                'fee_code_id' => $fee_codes['fee_codes_id'],
                                'demand_amount' => $feeamount,
                                'demand_arrear_date' => $arrear_date,
                                'demanded_date' => $demand_date,
                                'demanded_month' => $demanded_month,
                                'transaction_desc' => $fee_codes['description'] . ' demanded for the month of ' . strtolower($activation_date_object->format('F - Y')) . ' of the student',
                            );
                            $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
                            $month_interval = "+" . $fee_codes['monthSpan'] . " month";
                            $nxt_month = date("Y-m-d", strtotime($month_interval, strtotime($activation_date_intial)));

                            $activation_date_object = new DateTime($nxt_month);
                            $activation_date_object->modify('first day of this month');
                            $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                            $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                            $demanded_month = $activation_date_object->format('Y-m');
                        } else {
                            $j = 1;
                        }
                    }
                } else if ($fee_codes['is_recurring'] == 1) {
                    // $activation_date_object = new DateTime($activation_date);
                    // $activation_date_object->modify('first day of this month');
                    // $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                    // $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                    // $demanded_month = $activation_date_object->format('Y-m');
                    $fee_allocation[] = array(
                        'student_id' => $student_id,
                        'demand_type' => $fee_codes['demand_type_id'],
                        'fee_code_id' => $fee_codes['fee_codes_id'],
                        'demand_amount' => $feeamount,
                        'demand_arrear_date' => $activation_date,
                        'demanded_date' => $activation_date,
                        'demanded_month' => date('Y-m', strtotime($activation_date)),
                        //'transaction_desc' => $fee_codes['description'] . ' demanded for the month of ' . strtolower($activation_date_object->format('F - Y')) . ' of the student',
                        'transaction_desc' => $fee_codes['description'] . ' demanded for the month of ' . strtolower(date('F-Y', strtotime($activation_date))) . ' of the student',
                    );
                }
            }
        }

        return array(
            'data_status' => 1,
            'message' => 'Data processed successfully',
            'data' => json_encode($fee_allocation),
            'student_data' => $student_id_check,
            'student_count' => count($student_id_check),
            'allocation_summary_data' => json_encode($student_allocation_details)
        );
    }

    public function demand_bus_fee($params)
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


        if (!(isset($params['bus_fee']) && !empty($params['bus_fee']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Bus fee data is required', 'data' => FALSE);
        } else {
            $bus_fee = $params['bus_fee'];
        }

        if (!(isset($params['demand_start_date']) && !empty($params['demand_start_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand start date data is required', 'data' => FALSE);
        } else {
            $activation_date = $params['demand_start_date'];
        }

        if (!(isset($params['demand_end_date']) && !empty($params['demand_end_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand end date data is required', 'data' => FALSE);
        } else {
            $activation_end_date = $params['demand_end_date'];
        }


        $bus_fee_code_raw = $this->MFeeStructure->get_feecode_for_bus_fee($apikey, $inst_id);
        if (isset($bus_fee_code_raw) && !empty($bus_fee_code_raw)) {
            $bus_fee_code = $bus_fee_code_raw[0];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Bus fee code is not configured. Please contact administrator for further assistance');
        }



        $system_parameter_data = $this->MFeeStructure->get_system_data_for_processing($inst_id, $apikey);
        if (!(isset($system_parameter_data) && !empty($system_parameter_data) && count($system_parameter_data) > 0)) {
            return array('data_status' => 0, 'message' => 'Critical Error. Cannot get system parameters. Please contact administrator');
        }
        $is_vacation_month_activated = 0;
        foreach ($system_parameter_data as $value) {
            if ($value['Code'] == 'ACD_START_DATE') {
                $acd_start_date = $value['Code_Value'];
            }
            if ($value['Code'] == 'ACD_END_DATE') {
                $acd_end_date = $value['Code_Value'];
            }
            if ($value['Code'] == 'ARREAR_DAY') {
                $arrear_day = $value['Code_Value'];
            }
            if ($value['Code'] == 'FEE_DEMAND_DATE_MONTHLY') {
                $fee_demand_day = $value['Code_Value'];
            }
            if ($value['Code'] == 'IS_VACATION_MONTH_ACTIVATED') {
                $is_vacation_month_activated = $value['Code_Value'];
            }
        }

        $vacation_month_data = NULL;
        if ($is_vacation_month_activated == 1) {
            $vacations = $this->MFeeStructure->get_vacation_month_details($apikey, $inst_id);
            if (isset($vacations) && !empty($vacations)) {
                $vacation_month_data = $vacations;
            } else {
                $vacation_month_data = NULL;
            }
        }

        //        $acd_year_end_date_object = new DateTime($acd_end_date);
        //        $cur_acd_end_month = $acd_year_end_date_object->format('Y-m');

        $acd_year_end_date_object_check_final_date = new DateTime($acd_end_date);
        $cur_acd_end_month = $acd_year_end_date_object_check_final_date->format('Y-m');

        $end_date_of_activation_object = new DateTime($activation_end_date);

        if ($end_date_of_activation_object > $acd_year_end_date_object_check_final_date) {
            return array('status' => 0, 'message' => 'End date exceeds ACD end date');
        }

        $acd_year_end_date_object_check_final_date = new DateTime($activation_end_date);
        $cur_acd_end_month = $acd_year_end_date_object_check_final_date->format('Y-m');

        //check if the end date is exceeding the acd end date

        $activation_date_object = new DateTime($activation_date);
        $activation_date_object->modify('first day of this month');
        $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
        $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);

        $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
        $nxt_month = date("Y-m-d", strtotime("+1 month", strtotime($activation_date_intial)));
        $activation_date_object = new DateTime($nxt_month);
        $activation_date_object->modify('first day of this month');
        $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
        $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);

        $fee_code_value = $bus_fee;
        $fee_code_description = $bus_fee_code['description'];
        $fee_allocation = array();

        if ($bus_fee_code['is_recurring'] == 2) {
            $activation_date_object = new DateTime($activation_date);
            $activation_date_object->modify('first day of this month');
            $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
            $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
            $demanded_month = $activation_date_object->format('Y-m');
            $j = 0;
            while ($j == 0) {
                $loon_cur_month = $activation_date_object->format('Y-m');
                if ($cur_acd_end_month === $loon_cur_month) {
                    $j = 1;
                }
                if ($is_vacation_month_activated == 1) {
                    $flag_vac = 2;
                    foreach ($vacation_month_data as $vacs) {
                        if ($vacs['vacation_year_month'] == $loon_cur_month) {
                            $flag_vac = 1;
                            break;
                        } else if ($flag_vac == 2) {
                            $flag_vac = 2;
                        }
                    }
                    if ($flag_vac == 2) {
                        $fee_allocation[] = array(
                            'fee_code_id' => $bus_fee_code['fee_codes_id'],
                            'demand_amount' => $fee_code_value,
                            'demand_arrear_date' => $arrear_date,
                            'demanded_date' => $demand_date,
                            'demanded_month' => $demanded_month,
                            'transaction_desc' => $fee_code_description . ' demanded for the month of ' . strtolower($activation_date_object->format('F - Y')) . ' of the student',
                        );
                    }
                    $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
                    $nxt_month = date("Y-m-d", strtotime("+1 month", strtotime($activation_date_intial)));
                    $activation_date_object = new DateTime($nxt_month);
                    $activation_date_object->modify('first day of this month');
                    $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                    $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                    $demanded_month = $activation_date_object->format('Y-m');
                } else {
                    $fee_allocation[] = array(
                        'fee_code_id' => $bus_fee_code['fee_codes_id'],
                        'demand_amount' => $fee_code_value,
                        'demand_arrear_date' => $arrear_date,
                        'demanded_date' => $demand_date,
                        'demanded_month' => $demanded_month,
                        'transaction_desc' => $fee_code_description . ' demanded for the month of ' . strtolower($activation_date_object->format('F - Y')) . ' of the student',
                    );
                    $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
                    $nxt_month = date("Y-m-d", strtotime("+1 month", strtotime($activation_date_intial)));
                    $activation_date_object = new DateTime($nxt_month);
                    $activation_date_object->modify('first day of this month');
                    $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                    $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                    $demanded_month = $activation_date_object->format('Y-m');
                }
            }
        } else if ($bus_fee_code['is_recurring'] == 1) {
            $activation_date_object = new DateTime($activation_date);
            $activation_date_object->modify('first day of this month');
            $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
            $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
            $demanded_month = $activation_date_object->format('Y-m');
            $fee_allocation[] = array(
                'fee_code_id' => $bus_fee_code['fee_codes_id'],
                'demand_amount' => $fee_code_value,
                'demand_arrear_date' => $arrear_date,
                'demanded_date' => $demand_date,
                'demanded_month' => $demanded_month,
                'transaction_desc' => $fee_code_description . ' demanded for the month of ' . strtolower($activation_date_object->format('F - Y')) . ' of the student',
            );
        }
        if (!(isset($fee_allocation) && !empty($fee_allocation))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee data prepration failed. Pease contact administartator for further assistance');
        }
        $data_to_save = array(
            $apikey, $inst_id, $acd_year_id, $student_id, json_encode($fee_allocation)
        );

        $data_status = $this->MFeeStructure->save_bus_fee_allocation_with_students($data_to_save);
        if (isset($data_status[0]) && !empty($data_status) && is_array($data_status) && $data_status[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Created / Updated successfully', 'data' => $data_status);
        } else {
            if (isset($data_status[0]['ErrorMessage']) && !empty($data_status[0]['ErrorMessage']) && is_array($data_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $data_status[0]['ErrorMessage'], 'data' => $data_status[0]);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data Creation / Update failed', 'data' => FALSE);
            }
        }
    }
    public function save_demand_fee_allocation_individual($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }

        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Acaademic year is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }
        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        if (!(isset($params['fee_code_data']) && !empty($params['fee_code_data']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee code data is required', 'data' => FALSE);
        } else {
            $fee_code_data_raw = $params['fee_code_data'];
        }
        if (!(isset($params['activation_date']) && !empty($params['activation_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Activation date is required', 'data' => FALSE);
        } else {
            $activation_date = $params['activation_date'];
        }
        $fee_code_data = json_decode($fee_code_data_raw, TRUE);


        if (!(isset($params['remarks']) && !empty($params['remarks']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Remarks is required', 'data' => FALSE);
        } else {
            $remarks = $params['remarks'];
        }


        $system_parameter_data = $this->MFeeStructure->get_system_data_for_processing($inst_id, $apikey);
        if (!(isset($system_parameter_data) && !empty($system_parameter_data) && count($system_parameter_data) > 0)) {
            return array('data_status' => 0, 'message' => 'Critical Error. Cannot get system parameters. Please contact administrator');
        }
        $is_vacation_month_activated = 0;
        foreach ($system_parameter_data as $value) {
            if ($value['Code'] == 'ACD_START_DATE') {
                $acd_start_date = $value['Code_Value'];
            }
            if ($value['Code'] == 'ACD_END_DATE') {
                $acd_end_date = $value['Code_Value'];
            }
            if ($value['Code'] == 'ARREAR_DAY') {
                $arrear_day = $value['Code_Value'];
            }
            if ($value['Code'] == 'FEE_DEMAND_DATE_MONTHLY') {
                $fee_demand_day = $value['Code_Value'];
            }
            if ($value['Code'] == 'IS_VACATION_MONTH_ACTIVATED') {
                $is_vacation_month_activated = $value['Code_Value'];
            }
        }

        $vacation_month_data = NULL;
        if ($is_vacation_month_activated == 1) {
            $vacations = $this->MFeeStructure->get_vacation_month_details($apikey, $inst_id);
            if (isset($vacations) && !empty($vacations)) {
                $vacation_month_data = $vacations;
            } else {
                $vacation_month_data = NULL;
            }
        }

        $acd_year_end_date_object_check_final_date = new DateTime($acd_end_date);
        $cur_acd_end_month = $acd_year_end_date_object_check_final_date->format('Y-m');

        $end_date_of_activation_object = new DateTime($activation_date);

        if ($end_date_of_activation_object > $acd_year_end_date_object_check_final_date) {
            return array('status' => 0, 'message' => 'End date exceeds ACD end date');
        }

        $acd_year_start_date_object_check_final_date = new DateTime($acd_start_date);
        $cur_acd_start_month = $acd_year_start_date_object_check_final_date->format('Y-m');

        if ($end_date_of_activation_object < $acd_year_start_date_object_check_final_date) {
            return array('status' => 0, 'message' => 'Start date exceeds ACD start date');
        }


        $fee_allocation = array();
        foreach ($fee_code_data as $focodes_from_student) {

            $fee_code_data_from_db = array();
            $fee_code_data_from_db_raw = $this->MFeeStructure->get_fee_code_data_from_db($focodes_from_student['fee_code_id'], $apikey, $inst_id, $acd_year_id);

            if (isset($fee_code_data_from_db_raw) && !empty($fee_code_data_from_db_raw)) {
                $fee_code_data_from_db = $fee_code_data_from_db_raw[0];
            } else {
                return array('status' => 0, 'message' => 'Error in equating the fee codes selected. Please check if any fee codes are updated while alloting to student.');
            }

            $activation_date_object = new DateTime($activation_date);
            $activation_date_object->modify('first day of this month');
            $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
            $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);

            $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
            $nxt_month = date("Y-m-d", strtotime("+1 month", strtotime($activation_date_intial)));
            $activation_date_object = new DateTime($nxt_month);
            $activation_date_object->modify('first day of this month');
            $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
            $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);

            $fee_code_value = $focodes_from_student['value_for_fee'];
            $fee_code_description = $fee_code_data_from_db['description'];


            if ($fee_code_data_from_db['is_recurring'] == 2) {
                $activation_date_object = new DateTime($activation_date);
                $activation_date_object->modify('first day of this month');
                $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                $demanded_month = $activation_date_object->format('Y-m');
                $j = 0;
                while ($j == 0) {
                    $loon_cur_month = $activation_date_object->format('Y-m');
                    if ($cur_acd_end_month === $loon_cur_month) {
                        $j = 1;
                    }
                    if ($is_vacation_month_activated == 1) {
                        $flag_vac = 2;
                        foreach ($vacation_month_data as $vacs) {
                            if ($vacs['vacation_year_month'] == $loon_cur_month) {
                                $flag_vac = 1;
                                break;
                            } else if ($flag_vac == 2) {
                                $flag_vac = 2;
                            }
                        }
                        if ($flag_vac == 2) {
                            $fee_allocation[] = array(
                                'fee_code_id' => $fee_code_data_from_db['fee_codes_id'],
                                'demand_amount' => $fee_code_value,
                                'demand_arrear_date' => $arrear_date,
                                'demanded_date' => $demand_date,
                                'demanded_month' => $demanded_month,
                                'transaction_desc' => $fee_code_description . ' demanded for the month of ' . strtolower($activation_date_object->format('F - Y')) . ' of the student',
                            );
                        }
                        $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
                        $nxt_month = date("Y-m-d", strtotime("+1 month", strtotime($activation_date_intial)));
                        $activation_date_object = new DateTime($nxt_month);
                        $activation_date_object->modify('first day of this month');
                        $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                        $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                        $demanded_month = $activation_date_object->format('Y-m');
                    } else {
                        $fee_allocation[] = array(
                            'fee_code_id' => $fee_code_data_from_db['fee_codes_id'],
                            'demand_amount' => $fee_code_value,
                            'demand_arrear_date' => $arrear_date,
                            'demanded_date' => $demand_date,
                            'demanded_month' => $demanded_month,
                            'transaction_desc' => $fee_code_description . ' demanded for the month of ' . strtolower($activation_date_object->format('F - Y')) . ' of the student',
                        );
                        $activation_date_intial = $activation_date_object->modify('first day of this month')->format('Y-m-d');
                        $nxt_month = date("Y-m-d", strtotime("+1 month", strtotime($activation_date_intial)));
                        $activation_date_object = new DateTime($nxt_month);
                        $activation_date_object->modify('first day of this month');
                        $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                        $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                        $demanded_month = $activation_date_object->format('Y-m');
                    }
                }
            } else if ($fee_code_data_from_db['is_recurring'] == 1) {
                $activation_date_object = new DateTime($activation_date);
                $activation_date_object->modify('first day of this month');
                $demand_date = $activation_date_object->format('Y-m-' . $fee_demand_day);
                $arrear_date = $activation_date_object->format('Y-m-' . $arrear_day);
                $demanded_month = $activation_date_object->format('Y-m');
                $fee_allocation[] = array(
                    'fee_code_id' => $fee_code_data_from_db['fee_codes_id'],
                    'demand_amount' => $fee_code_value,
                    'demand_arrear_date' => $arrear_date,
                    'demanded_date' => $demand_date,
                    'demanded_month' => $demanded_month,
                    'transaction_desc' => $fee_code_description . ' demanded for the month of ' . strtolower($activation_date_object->format('F - Y')) . ' of the student',
                );
            }
        }

        if (!(isset($fee_allocation) && !empty($fee_allocation))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee data prepration failed. Pease contact administartator for further assistance');
        }

        $activation_date_object_start = new DateTime($activation_date);
        $activation_date_object_start->modify('first day of this month');
        $start_date = $activation_date_object->format('Y-m-' . $fee_demand_day);

        $acd_end_date_format = new DateTime($acd_end_date);
        $acd_end_date_format->modify('last day of this month');
        $end_day_acd = $acd_end_date_format->format('Y-m-d');



        $data_to_save = array(
            $apikey, $inst_id, $acd_year_id, $student_id, json_encode($fee_allocation), $remarks, $start_date, $end_day_acd, json_encode($fee_code_data)
        );


        $data_status = $this->MFeeStructure->save_fee_custom_allocation_with_students($data_to_save);



        if (isset($data_status[0]) && !empty($data_status) && is_array($data_status) && $data_status[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Created / Updated successfully', 'data' => $data_status);
        } else {
            if (isset($data_status[0]['ErrorMessage']) && !empty($data_status[0]['ErrorMessage']) && is_array($data_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $data_status[0]['ErrorMessage'], 'data' => $data_status[0]);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data Creation / Update failed', 'data' => FALSE);
            }
        }
    }

    
    //Fee Deallocation
    public function deallocate_fee_of_student($params)
    {
        $api_key = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Current academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        if (!(isset($params['demand_details']) && !empty($params['demand_details']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Plan details is required', 'data' => FALSE);
        } else {
            $demand_details = $params['demand_details'];
        }
        if (!(isset($params['dealloc_reason']) && !empty($params['dealloc_reason']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Deallocation reason is required', 'data' => FALSE);
        } else {
            $dealloc_reason = $params['dealloc_reason'];
        }
        
        $data_to_save = array(
            $api_key,
            $inst_id,
            $acd_year_id,
            json_encode($demand_details),
            $student_id,
            $dealloc_reason
        );

        // return $data_to_save;
        $data_status = $this->MFeeStructure->deallocate_fee_of_student($data_to_save);
        if (isset($data_status[0]) && !empty($data_status) && is_array($data_status) && $data_status[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Created / Updated successfully', 'data' => $data_status);
        } else {
            if (isset($data_status[0]['ErrorMessage']) && !empty($data_status[0]['ErrorMessage']) && is_array($data_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $data_status[0]['ErrorMessage'], 'data' => $data_status[0]);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data Creation / Update failed', 'data' => FALSE);
            }
        }
    }
}
