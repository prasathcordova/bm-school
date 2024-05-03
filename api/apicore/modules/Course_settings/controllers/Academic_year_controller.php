<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Academic_year_controller
 *
 * @author rahul.shibukumar
 */
class Academic_year_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Academicyear_model', 'MAyear');
    }
    public function get_acdyear($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            if ($params['status'] == 1) {
                $query_string = "acd.isactive = 'Y'";
            }
            
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['Acd_ID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "acd.Acd_ID LIKE '%" . $params['BatchID'] . "%' ";
                } else {
                    $query_string = "acd.Acd_ID LIKE '%" . $params['Acd_ID'] . "%' ";
                }
            }
            if (isset($params['Description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " acd.Description LIKE '%" . $params['Description'] . "%' ";
                } else {
                    $query_string = " acd.Description LIKE '%" . $params['Description'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict") == 0) {
            if (isset($params['Acd_ID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "acd.Acd_ID LIKE '%" . $params['BatchID'] . "%' ";
                } else {
                    $query_string = "acd.Acd_ID LIKE '%" . $params['Acd_ID'] . "%' ";
                }
            }
            if (isset($params['Description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " acd.Description LIKE '%" . $params['Description'] . "%' ";
                } else {
                    $query_string = " acd.Description LIKE '%" . $params['Description'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "temp_reg" == 0)) {

            if (strlen($query_string) > 0) {
                $query_string = 10;
            } else {
                $query_string = 10;
            }
        }


        $acdyear_list = $this->MAyear->get_Acdyear_details($apikey, $query_string);
        if (!empty($acdyear_list) && is_array($acdyear_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $acdyear_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
