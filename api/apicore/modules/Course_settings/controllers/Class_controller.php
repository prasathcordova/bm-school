<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Class_controller
 *
 * @author rahul.shibukumar
 */
class Class_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Class_model', 'MClass');
    }

    public function get_classes($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "cd.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['Course_Det_ID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "Course_Det_ID LIKE '" . $params['Course_Det_ID'] . "' ";
                } else {
                    $query_string = "Course_Det_ID = '" . $params['Course_Det_ID'] . "' ";
                }
            }
            if (isset($params['Course_Name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cm.Course_Name LIKE '%" . $params['Course_Name'] . "%' ";
                } else {
                    $query_string = "cm.Course_Name LIKE '%" . $params['Course_Name'] . "%' ";
                }
            }
            if (isset($params['Course_det_code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cd.Course_det_code LIKE '%" . $params['Course_det_code'] . "%' ";
                } else {
                    $query_string = "cd.Course_det_code LIKE '%" . $params['Course_det_code'] . "%' ";
                }
            }
            if (isset($params['Description '])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cd.Description  LIKE '%" . $params['Description'] . "%' ";
                } else {
                    $query_string = "cd.Description  LIKE '%" . $params['Description'] . "%'";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['Course_Det_ID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cm.Course_Det_ID LIKE '%" . $params['Course_Det_ID'] . "%' ";
                } else {
                    $query_string = "cm.Course_Det_ID LIKE '%" . $params['id'] . "%' ";
                }
            }
            if (isset($params['Course_Name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cm.Course_Name LIKE '%" . $params['name'] . "%' ";
                } else {
                    $query_string = "cm.Course_Name LIKE '%" . $params['Course_Name'] . "%' ";
                }
            }
            if (isset($params['Course_det_code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cd.Course_det_code LIKE '%" . $params['Course_det_code'] . "%' ";
                } else {
                    $query_string = "cd.Course_det_code LIKE '%" . $params['Course_det_code'] . "%' ";
                }
            }
            if (isset($params['Description '])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cd.Description  LIKE '%" . $params['Description'] . "%' ";
                } else {
                    $query_string = "cd.Description  LIKE '%" . $params['Description'] . "%'";
                }
            }
        }

        $class_list = $this->MClass->get_class_details($apikey, $query_string, 0);
        // return $class_list;

        if (!empty($class_list) && is_array($class_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $class_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }


    public function get_class($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "cd.isactive = " . $params['status'];
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
                    $query_string = "cm.Course_Det_ID LIKE '%" . $params['Course_Det_ID'] . "%' ";
                }
            }
            if (isset($params['Course_Name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cm.Course_Name LIKE '%" . $params['Course_Name'] . "%' ";
                } else {
                    $query_string = "cm.Course_Name LIKE '%" . $params['Course_Name'] . "%' ";
                }
            }
            if (isset($params['Course_det_code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cd.Course_det_code LIKE '%" . $params['Course_det_code'] . "%' ";
                } else {
                    $query_string = "cd.Course_det_code LIKE '%" . $params['Course_det_code'] . "%' ";
                }
            }
            if (isset($params['Description '])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cd.Description  LIKE '%" . $params['Description'] . "%' ";
                } else {
                    $query_string = "cd.Description  LIKE '%" . $params['Description'] . "%'";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['Course_Det_ID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cm.Course_Det_ID LIKE '%" . $params['Course_Det_ID'] . "%' ";
                } else {
                    $query_string = "cm.Course_Det_ID LIKE '%" . $params['id'] . "%' ";
                }
            }
            if (isset($params['Course_Name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cm.Course_Name LIKE '%" . $params['name'] . "%' ";
                } else {
                    $query_string = "cm.Course_Name LIKE '%" . $params['Course_Name'] . "%' ";
                }
            }
            if (isset($params['Course_det_code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cd.Course_det_code LIKE '%" . $params['Course_det_code'] . "%' ";
                } else {
                    $query_string = "cd.Course_det_code LIKE '%" . $params['Course_det_code'] . "%' ";
                }
            }
            if (isset($params['Description '])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cd.Description  LIKE '%" . $params['Description'] . "%' ";
                } else {
                    $query_string = "cd.Description  LIKE '%" . $params['Description'] . "%'";
                }
            }
        }


        $class_list = $this->MClass->get_class_details($apikey, $query_string, $params['inst_id']);
        if (!empty($class_list) && is_array($class_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $class_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_classes($params = NULL)
    {
        $dbparams = array();

        $dbparams[0] = $params['API_KEY'];

        if (isset($params['Course_Master_ID']) && !empty($params['Course_Master_ID'])) {
            $dbparams[1] = $params['Course_Master_ID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Course_Master_ID is required', 'data' => FALSE);
        }
        if (isset($params['code']) && !empty($params['code'])) {
            $dbparams[2] = $params['code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' code is required', 'data' => FALSE);
        }
        if (isset($params['Description']) && !empty($params['Description'])) {
            $dbparams[3] = $params['Description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Description is required', 'data' => FALSE);
        }
        $class_add_status = $this->MClass->add_new_class($dbparams);
        if (!empty($class_add_status) && is_array($class_add_status) && $class_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('Course_Master_ID' => $class_add_status['class_id'], 'Class_Name' => $class_add_status['Class_Name']));
        } else {
            if (is_array($class_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $class_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_classes($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = '5';

        if (isset($params['course_det_id']) && !empty($params['course_det_id'])) {
            $dbparams[2] = $params['course_det_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Course_Det_ID is required', 'data' => FALSE);
        }
        if (isset($params['Course_Master_ID']) && !empty($params['Course_Master_ID'])) {
            $dbparams[3] = $params['Course_Master_ID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Course_Master_ID is required', 'data' => FALSE);
        }
        if (isset($params['Course_det_code']) && !empty($params['Course_det_code'])) {
            $dbparams[4] = $params['Course_det_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Course_det_code is required', 'data' => FALSE);
        }
        if (isset($params['Description']) && !empty($params['Description'])) {
            $dbparams[5] = $params['Description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Description is required', 'data' => FALSE);
        }
        $dbparams[6] = 1;
        $dbparams[7] = 0;
        $class_add_status = $this->MClass->update_class_data($dbparams);
        if (!empty($class_add_status) && is_array($class_add_status) && isset($class_add_status['ErrorStatus']) && $class_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $class_add_status);
        } else {
            if (isset($class_add_status['ErrorMessage']) && !empty($class_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $class_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_class_status($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = NULL;
        if (isset($params['course_det_id']) && !empty($params['course_det_id'])) {
            $dbparams[2] = $params['course_det_id'];
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

        $course_add_status = $this->MClass->update_class_data($dbparams);
        if (!empty($course_add_status) && is_array($course_add_status) && isset($course_add_status['ErrorStatus']) && $course_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $course_add_status);
        } else {
            if (isset($course_add_status['ErrorMessage']) && !empty($course_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $course_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
}
