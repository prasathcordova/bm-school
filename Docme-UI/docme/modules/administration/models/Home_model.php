<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home_model
 *
 * @author rahul.shibukumar
 */
class Home_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_students_count()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'get_student_count'), $apikey);
        if (is_array($count_data)) {
            //            dev_export($count_data);die;
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function get_stud_reg_count()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'get_stud_reg_count'), $apikey);
        if (is_array($count_data)) {
            //            dev_export($count_data);die;
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function get_school_dashboard_details($data_prep)
    {
        $apikey = $this->session->userdata('API-Key');
        $dashboard_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($dashboard_data)) {
            return $dashboard_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $dashboard_data,
                'data' => FALSE
            );
        }
    }

    public function get_tcapplied_count()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'get_tc_applied_count'), $apikey);
        if (is_array($count_data)) {
            //            dev_export($count_data);die;
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function get_issue_count()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'get_tc_issue_count'), $apikey);
        if (is_array($count_data)) {
            //            dev_export($count_data);die;
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function get_count()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'get_dashboard_details_count_substore'), $apikey);
        //        dev_export($count_data);die;
        if (is_array($count_data)) {
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function get_graph()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'get_dashboard_details_graph_substore'), $apikey);
        //        dev_export($count_data);die;
        if (is_array($count_data)) {
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function get_daily_sales()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'dashboard_daily_sales'), $apikey);
        //        dev_export($count_data);die;
        if (is_array($count_data)) {
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function get_not_billed()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'dashboard_notBilled'), $apikey);
        //        dev_export($count_data);die;
        if (is_array($count_data)) {
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function get_not_delivered()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'dashboard_notdelivered'), $apikey);
        //        dev_export($count_data);die;
        if (is_array($count_data)) {
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function uniform_get_daily_sales()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_dashboard_daily_sales'), $apikey);
        //        dev_export($count_data);die;
        if (is_array($count_data)) {
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function uniform_get_not_delivered()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_dashboard_notdelivered'), $apikey);
        //        dev_export($count_data);die;
        if (is_array($count_data)) {
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function uniform_get_count()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_get_dashboard_details_count_substore'), $apikey);
        //        dev_export($count_data);die;
        if (is_array($count_data)) {
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function uniform_get_not_billed()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_dashboard_notBilled'), $apikey);
        //        dev_export($count_data);die;
        if (is_array($count_data)) {
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function uniform_get_graph()
    {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_get_dashboard_details_graph_substore'), $apikey);
        //        dev_export($count_data);die;
        if (is_array($count_data)) {
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

    public function spread_sheet_query($inst_id, $type, $acd_year = 0)
    {
        $apikey = LOGIN_API_KEY;
        $data['action'] = 'spread_sheet_query';
        $data['controller_function']   = 'Report_settings/Custom_report_controller/spread_sheet_query';
        $data['inst_id'] = $inst_id;
        $data['type'] = $type;
        $data['acd_year'] = $acd_year;
        $count_data = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($count_data);die;
        if (is_array($count_data)) {
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }
}
