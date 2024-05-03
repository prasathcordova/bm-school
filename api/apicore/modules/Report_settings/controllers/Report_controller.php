<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registration_report
 *
 * @author Remya SR
 */
class Report_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Report_model', 'MAttRpt');
    }
    public function get_strength_details($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['API_KEY'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[2] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }
        $strength_list = $this->MAttRpt->get_strength($dbparams);
        if (!empty($strength_list) && is_array($strength_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $strength_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_long_absantee_details($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[2] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }
        $dbparams[3] = $params['date_from'];
        $dbparams[4] = $params['date_to'];
        $strength_list = $this->MAttRpt->get_long_absentee_details($dbparams);
        if (!empty($strength_list) && is_array($strength_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $strength_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_long_abstee_count($params = NULL)
    {
    //    return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[2] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }
        $dbparams[3] = $params['date_from'];
        $dbparams[4] = $params['date_to'];
        // return $dbparams;
        $details_list = $this->MAttRpt->long_abstee_count($dbparams);
        // return $details_list;
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_tc_details($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[2] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }
        $dbparams[3] = $params['date_from'];
        $dbparams[4] = $params['date_to'];
        $details_list = $this->MAttRpt->get_tc_details($dbparams);
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_not_demand($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[2] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }
        $dbparams[3] = $params['date_from'];
        $dbparams[4] = $params['date_to'];
        $details_list = $this->MAttRpt->get_not_demand_details($dbparams);
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_fee_cons($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[2] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }
        $dbparams[3] = $params['date_from'];
        $dbparams[4] = $params['date_to'];
        $details_list = $this->MAttRpt->get_fee_cons_details($dbparams);
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_fee_exemption($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[2] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }
        $dbparams[3] = $params['date_from'];
        $dbparams[4] = $params['date_to'];
        $details_list = $this->MAttRpt->get_fee_exemption_details($dbparams);
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_exemption($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[2] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }
        $dbparams[3] = $params['date_from'];
        $dbparams[4] = $params['date_to'];
        $details_list = $this->MAttRpt->get_exemption($dbparams);
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_exemption_list($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['userid']) && !empty($params['userid'])) {
            $dbparams[2] = $params['userid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[3] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }
        $dbparams[4] = '';
        $dbparams[5] = '';
        $dbparams[6] = '';
        $dbparams[7] = '';
        $details_list = $this->MAttRpt->get_exemption_list($dbparams);
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_exemption($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['userid']) && !empty($params['userid'])) {
            $dbparams[2] = $params['userid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[3] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }
        $dbparams[4] = $params['ExApp_Id'];;
        $dbparams[5] = $params['ExApp_Type'];;
        $dbparams[6] = $params['ExAmt_all'];;
        $dbparams[7] = $params['Comments'];;
        $details_list = $this->MAttRpt->get_exemption_list($dbparams);
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_graph_details($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[2] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }
        $dbparams[3] = $params['date_from'];
        $dbparams[4] = $params['date_to'];
        $details_list = $this->MAttRpt->get_graph_details($dbparams);
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function approve_exemption_group($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['userid']) && !empty($params['userid'])) {
            $dbparams[2] = $params['userid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User ID is required', 'data' => FALSE);
        }
        
        $dbparams[3] = $params['Approved_id'];
        $dbparams[4] = $params['Rejected_id'];
        $dbparams[5] = $params['Comments'];
        $details_list = $this->MAttRpt->approve_exemption_group($dbparams);
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function exemption_group_sorting($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['userid']) && !empty($params['userid'])) {
            $dbparams[2] = $params['userid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[3] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }        
        if (isset($params['order_by']) && !empty($params['order_by'])) {
            $dbparams[4] = $params['order_by'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Order By is required', 'data' => FALSE);
        }
        
        $details_list = $this->MAttRpt->exemption_group_sorting($dbparams);
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function exemption_count($params = NULL)
    {
       // return $params;
       $dbparams = array();
       $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        if (isset($params['userid']) && !empty($params['userid'])) {
            $dbparams[2] = $params['userid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User ID is required', 'data' => FALSE);
        }
        if (isset($params['academic_year']) && !empty($params['academic_year'])) {
            $dbparams[3] = $params['academic_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }        
        
        $dbparams[4] = '';
        $dbparams[5] = '';
        $dbparams[6] = '';
        $dbparams[7] = '';
        $details_list = $this->MAttRpt->exemption_count($dbparams);
        if (!empty($details_list) && is_array($details_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_mail_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['action'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID  is required', 'data' => FALSE);
        }   
        if (isset($params['userid']) && !empty($params['userid'])) {
            $dbparams[2] = $params['userid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User ID is required', 'data' => FALSE);
        }  
            //    return $dbparams;
        $mail_details = $this->MAttRpt->get_mail_details($dbparams);
        if (!empty($mail_details) && is_array($mail_details)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $mail_details);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_arrear_details($params = NULL)
    {
        // return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID  is required', 'data' => FALSE);
        }   
          
               // return $dbparams;
        $details = $this->MAttRpt->get_arrear_details($dbparams);
        if (!empty($details) && is_array($details)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_statistical_details($params = NULL)
    {
        // return $params;
        $dbparams = array();
        $dbparams[0] = $params['action'];
        
        if (isset($params['month']) && !empty($params['month'])) {
            $dbparams[1] = $params['month'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Month  is required', 'data' => FALSE);
        } 
        if (isset($params['year']) && !empty($params['year'])) {
            $dbparams[2] = $params['year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        } 
        if (isset($params['institutes']) && !empty($params['institutes'])) {
            $dbparams[3] = $params['institutes'];
        } 
        if (isset($params['fee_code']) && !empty($params['fee_code'])) {
            $dbparams[4] = $params['fee_code'];
        }  
          
               // return $dbparams;
        $details = $this->MAttRpt->get_statistical_details($dbparams);
        if (!empty($details) && is_array($details)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $details);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
