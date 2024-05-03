<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category_controller
 *
 * @author rahul.shibukumar
 */
class Category_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Category_model', 'MCategory');
    }
    
     public function get_category($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isactive = " . $params['status'];
        }
        
         if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }

       if (strcasecmp($mode, "search") == 0) {
        if (isset($params['cate_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "c.cate_id LIKE '%" . $params['cate_id'] . "%' ";
            } else {
                $query_string = "c.cate_id LIKE '%" . $params['cate_id'] . "%' ";
            }
        }
        if (isset($params['cate_name'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "c.cate_name LIKE '%" . $params['cate_name'] . "%' ";
            } else {
                $query_string = "c.cate_name LIKE '%" . $params['cate_name'] . "%' ";
            }
        }
        if (isset($params['cate_description'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "c.cate_description LIKE '%" . $params['cate_description'] . "%' ";
            } else {
                $query_string = "c.cate_description LIKE '%" . $params['cate_description'] . "%' ";
            }
        }    
        
      }else if (strcasecmp($mode, "strict" == 0)) {
        if (isset($params['cate_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "c.cate_id LIKE '%" . $params['cate_id'] . "%' ";
            } else {
                $query_string = "c.cate_id LIKE '%" . $params['cate_id'] . "%' ";
            }
        }
        if (isset($params['cate_name'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "c.cate_name LIKE '%" . $params['cate_name'] . "%' ";
            } else {
                $query_string = "c.cate_name LIKE '%" . $params['cate_name'] . "%' ";
            }
        }
        if (isset($params['cate_description'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "c.cate_description LIKE '%" . $params['cate_description'] . "%' ";
            } else {
                $query_string = "c.cate_description LIKE '%" . $params['cate_description'] . "%' ";
            }
        }    
        
      }
      
         $category_list = $this->MCategory->get_category_details($apikey, $query_string);
//         dev_export($publisher_list);die;
        if (!empty($category_list) && is_array($category_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $category_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_category($params = NULL) { 
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['cate_name']) && !empty($params['cate_name'])) {
            $dbparams[1] = $params['cate_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Category  Name is required', 'data' => FALSE);
        }
       
        if (isset($params['cate_description']) && !empty($params['cate_description'])) {
            $dbparams[2] = $params['cate_description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Category Description  is required', 'data' => FALSE);
        }
         
        $category_add_status = $this->MCategory->add_new_category($dbparams);
        if (!empty($category_add_status) && is_array($category_add_status) && $category_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $category_add_status['Country_id']));
        } else {
            if (is_array($category_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $category_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

        public function update_category($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
         $dbparams[1] = 1;
        if (isset($params['cate_id']) && !empty($params['cate_id'])) {
            $dbparams[2] = $params['cate_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Category ID is required', 'data' => FALSE);
        }
        if (isset($params['cate_name']) && !empty($params['cate_name'])) {
            $dbparams[3] = $params['cate_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Category Name is required', 'data' => FALSE);
        }
        if (isset($params['cate_description']) && !empty($params['cate_description'])) {
            $dbparams[4] = $params['cate_description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Category Description is required', 'data' => FALSE);
        }
        $dbparams[5] = 0;
        $category_update_status = $this->MCategory->category_update_data($dbparams);
        if (!empty($category_update_status) && is_array($category_update_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $category_update_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }

    
    

    public function modify_category_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
           $dbparams[1] = 0;
        if (isset($params['cate_id']) && !empty($params['cate_id'])) {
            $dbparams[2] = $params['cate_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Catogery ID is required', 'data' => FALSE);
        }
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
      ;
     

        if (isset($params['status'])) {
            $dbparams[5] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Type  Status is required', 'data' => FALSE);
        }

        $category_add_status = $this->MCategory->category_update_data($dbparams);
        if (!empty($category_add_status) && is_array($category_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $category_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }
}


