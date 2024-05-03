<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Class_controller
 *
 * @author docme2
 */
class Class_controller extends MX_Controller{
     public function __construct() {
        parent::__construct();
        $this->load->model('Class_model', 'MClass');
    }
    
    public function get_class($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "cl.isactive = " . $params['status'];
        }
        if (isset($params['class_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "cl.class_id LIKE '%" . $params['class_id'] . "%' ";
            } else {
                $query_string = "cl.class_id LIKE '%" . $params['class_id'] . "%' ";
            }
        }
        if (isset($params['class_code'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "cl.class_code LIKE '%" . $params['class_code'] . "%' ";
            } else {
                $query_string = "cl.class_code LIKE '%" . $params['class_code'] . "%' ";
            }
        }

        if (isset($params['description'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "cl.description LIKE '%" . $params['description'] . "%' ";
            } else {
                $query_string = "cl.description LIKE '%" . $params['description'] . "%'";
            }
        }

        $class_list = $this->MClass->get_class_details($apikey, $query_string);
//        dev_export($academic_list);die;
        if (!empty($class_list) && is_array($class_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $class_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    
    public function save_class($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['class_code']) && !empty($params['class_code'])) {
            $dbparams[1] = $params['class_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class Code is required', 'data' => FALSE);
        }
        if (isset($params['description']) && !empty($params['description'])) {
            $dbparams[2] = $params['description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }
        
        $class_add_status = $this->MClass->add_new_class($dbparams);
        if (!empty($class_add_status) && is_array($class_add_status) && $class_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('class_id' => $class_add_status['class_id']));
        } else {
            if (is_array($class_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $class_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    
    
    public function update_class($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[1] = $params['class_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class ID is required', 'data' => FALSE);
        }
        if (isset($params['class_code']) && !empty($params['class_code'])) {
            $dbparams[2] = $params['class_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class Code is required', 'data' => FALSE);
        }
        if (isset($params['descriptn']) && !empty($params['descriptn'])) {
            $dbparams[3] = $params['descriptn'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }
        $dbparams[4] = 1;
        $dbparams[5] = 0;
        $class_add_status = $this->MClass->update_class_data($dbparams);
        if (!empty($class_add_status) && is_array($class_add_status) && isset($class_add_status['ErrorStatus']) && $class_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $class_add_status);
        } else {
             if(isset($class_add_status['ErrorMessage']) && !empty($class_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $class_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
}
