<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category_controller
 *
 * @author docme2
 */
class Category_controller extends MX_Controller{
   public function __construct() {
        parent::__construct();
        $this->load->model('Category_model', 'MCategory');
    }
    
    public function get_category($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "cat.IsSpecialization = " . $params['status'];
        }
        if (isset($params['Course_Type_ID'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "cat.Course_Type_ID LIKE '%" . $params['Course_Type_ID'] . "%' ";
            } else {
                $query_string = "cat.Course_Type_ID LIKE '%" . $params['Course_Type_ID'] . "%' ";
            }
        }
        if (isset($params['Category'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "cat.Category LIKE '%" . $params['Category'] . "%' ";
            } else {
                $query_string = "cat.Category LIKE '%" . $params['Category'] . "%' ";
            }
        }
        $category_list = $this->MCategory->get_category_details($apikey, $query_string);
        if (!empty($category_list) && is_array($category_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $category_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

}
