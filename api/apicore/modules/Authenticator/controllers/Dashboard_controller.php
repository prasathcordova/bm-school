<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboard_controller
 *
 * @author rahul.shibukumar
 */
class Dashboard_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model', 'MDashboard');
    }

    public function get_student_count($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $list = $this->MDashboard->get_stundent_details($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }

    public function get_stud_reg_count($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $list = $this->MDashboard->get_reg_count($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }
    public function get_school_dashboard_details($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $inst_id = $params['inst_id'];
        $list = $this->MDashboard->get_school_dashboard_details($apikey, $inst_id);
        return $list;
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }

    public function get_tc_applied_count($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $list = $this->MDashboard->get_tc_applied_count($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }

    public function get_tc_issue_count($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $list = $this->MDashboard->get_tc_issue_count($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }

    public function get_dashboard_details_count_substore($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $list = $this->MDashboard->get_dashboard_details($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }

    public function get_dashboard_details_graph_substore($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $a = 1;
        $m = 0;
        for ($a = 1; $a < 13; $a++) {
            $b[] = $this->MDashboard->get_dashboard_graph($apikey, $a);
            $student_details[$m] = array($b[$m]['final_total']);
            $m++;
        }
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_details);
    }

    public function dashboard_daily_sales($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $list = $this->MDashboard->get_dashboard_dailysales($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }
    public function dashboard_notBilled($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $list = $this->MDashboard->get_dashboard_notBilled($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }
    public function uniform_dashboard_notBilled($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $list = $this->MDashboard->uniform_dashboard_notBilled($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }
    public function dashboard_notdelivered($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $list = $this->MDashboard->get_dashboard_notdelivered($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }

    public function uniform_get_dashboard_details_count_substore($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $list = $this->MDashboard->uniform_get_dashboard_details($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }
    public function uniform_dashboard_daily_sales($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $list = $this->MDashboard->uniform_get_dashboard_dailysales($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }
    public function uniform_dashboard_notdelivered($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $list = $this->MDashboard->uniform_get_dashboard_notdelivered($apikey);
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }
    public function uniform_get_dashboard_details_graph_substore($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $a = 1;
        $m = 0;
        for ($a = 1; $a < 13; $a++) {
            $b[] = $this->MDashboard->uniform_get_dashboard_graph($apikey, $a);
            $student_details[$m] = array($b[$m]['final_total']);
            $m++;
        }
        return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_details);
    }
}
