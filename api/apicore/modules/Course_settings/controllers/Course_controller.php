<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Course_controller
 *
 * @author rahul.shibukumar
 */
class Course_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
 $this->load->model('Course_model', 'MCourse');

    }
    public function get_course_type($params = NULL) {
        $apikey = $params['API_KEY'];
        $course_list = $this->MCourse->get_course_type_details($apikey);
        if (!empty($course_list) && is_array($course_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $course_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_course($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "cm.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['Course_Det_ID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cm.Course_Det_ID LIKE '%" . $params['Course_Det_ID'] . "%' ";
                } else {
                    $query_string = "cm.Course_Det_ID LIKE '%" . $params['id'] . "%' ";
                }
            }
            if (isset($params['Description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cm.Description LIKE '%" . $params['Description'] . "%' ";
                } else {
                    $query_string = "cm.Description LIKE '%" . $params['Description'] . "%' ";
                }
            }
            if (isset($params['Category'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "ct.Category LIKE '%" . $params['Category'] . "%' ";
                } else {
                    $query_string = "ct.Category LIKE '%" . $params['Category'] . "%' ";
                }
            }
            if (isset($params['Duration'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cm.Duration LIKE '%" . $params['Duration'] . "%' ";
                } else {
                    $query_string = "cm.Duration LIKE '%" . $params['Duration'] . "%'";
                }
            }
          
        } else if (strcasecmp($mode, "strict" == 0)) {
            
            if (isset($params['Course_Det_ID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cm.Course_Det_ID LIKE '%" . $params['Course_Det_ID'] . "%' ";
                } else {
                    $query_string = "cm.Course_Det_ID LIKE '%" . $params['Course_Det_ID'] . "%' ";
                }
            }
            if (isset($params['Description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cm.Description LIKE '%" . $params['Description'] . "%' ";
                } else {
                    $query_string = "cm.Description LIKE '%" . $params['Description'] . "%' ";
                }
            }
            if (isset($params['Category'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "ct.Category LIKE '%" . $params['Category'] . "%' ";
                } else {
                    $query_string = "ct.Category LIKE '%" . $params['Category'] . "%' ";
                }
            }
            if (isset($params['Duration'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cm.Duration LIKE '%" . $params['Duration'] . "%' ";
                } else {
                    $query_string = "cm.Duration LIKE '%" . $params['Duration'] . "%'";
                }
            }
          
        
        }
        $course_list = $this->MCourse->get_course_details($apikey, $query_string);
        if (!empty($course_list) && is_array($course_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $course_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
      public function save_course($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['Description']) && !empty($params['Description'])) {
            $dbparams[1] = $params['Description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Course  Name is required', 'data' => FALSE);
        }
        if (isset($params['Course_Type_ID']) && !empty($params['Course_Type_ID'])) {
            $dbparams[2] = $params['Course_Type_ID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Course Type ID   is required', 'data' => FALSE);
        }
        if (isset($params['Duration']) && !empty($params['Duration'])) {
            $dbparams[3] = $params['Duration'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Duration details is required', 'data' => FALSE);
        }
//        dev_export($dbparams);die;
        $course_add_status = $this->MCourse->add_new_course($dbparams);
        if (!empty($course_add_status) && is_array($course_add_status) && $course_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('Course_Master_ID' => $course_add_status['Course_Master_ID']));
        } else {
            if (is_array($course_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $course_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
   public function update_course($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1]='5';

        if (isset($params['Course_Det_ID']) && !empty($params['Course_Det_ID'])) {
            $dbparams[2] = $params['Course_Det_ID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Course ID is required', 'data' => FALSE);
        }
        if (isset($params['Description']) && !empty($params['Description'])) {
            $dbparams[3] = $params['Description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Course Name is required', 'data' => FALSE);
        }
        if (isset($params['Course_Type_ID']) && !empty($params['Course_Type_ID'])) {
            $dbparams[4] = $params['Course_Type_ID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Course Catogeory is required', 'data' => FALSE);
        }
        if (isset($params['Duration']) && !empty($params['Duration'])) {
            $dbparams[5] = $params['Duration'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Duration  is required', 'data' => FALSE);
        }
        $dbparams[6] = 1;
        $dbparams[7] = 0;
        $course_add_status = $this->MCourse->update_course_data($dbparams);
        if (!empty($course_add_status) && is_array($course_add_status) && isset($course_add_status['ErrorStatus']) && $course_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $course_add_status);
        } else {
             if(isset($course_add_status['ErrorMessage']) && !empty($course_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $course_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
    
    public function modify_course_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
         $dbparams[1] = NULL;
        if (isset($params['Course_Det_ID']) && !empty($params['Course_Det_ID'])) {
            $dbparams[2] = $params['Course_Det_ID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Course ID is required', 'data' => FALSE);
        }
       
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = 0;

        if (isset($params['status'])) {
            $dbparams[7] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Status is required', 'data' => FALSE);
        }

        $course_add_status = $this->MCourse->update_course_data($dbparams);
        if (!empty($course_add_status) && is_array($course_add_status) && isset($course_add_status['ErrorStatus']) && $course_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $course_add_status);
        } else {
             if(isset($course_add_status['ErrorMessage']) && !empty($course_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $course_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    

}
