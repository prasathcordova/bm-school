<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Batch_controller
 *
 * @author rahul.shibukumar
 */
class Batch_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Batch_model', 'MBatch');
    }

    public function get_batch($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "bd.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }
        if (isset($params['status_flag']) && !empty($params['status_flag'])) {
            $status_flag = 1;
        } else {
            $status_flag = 0;
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['BatchID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.BatchID LIKE '%" . $params['BatchID'] . "%' ";
                } else {
                    $query_string = "bd.BatchID LIKE '%" . $params['BatchID'] . "%' ";
                }
            }
            if (isset($params['academic_year'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " academic_year LIKE '%" . $params[' academic_year'] . "%' ";
                } else {
                    $query_string = " academic_year LIKE '%" . $params['academic_year'] . "%' ";
                }
            }
            if (isset($params['class'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " class LIKE '%" . $params['class'] . "%' ";
                } else {
                    $query_string = "class LIKE '%" . $params['class'] . "%' ";
                }
            }
            if (isset($params['Class'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " cd.Description LIKE '%" . $params['Class'] . "%' ";
                } else {
                    $query_string = "cd.Description LIKE '%" . $params['Class'] . "%' ";
                }
            }
            if (isset($params['Batch_Name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.Batch_Name LIKE '%" . $params['Batch_Name'] . "%' ";
                } else {
                    $query_string = "bd.Batch_Name  LIKE '%" . $params['Batch_Name'] . "%'";
                }
            }
            if (isset($params['Boys'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.Boys LIKE '%" . $params['Boys'] . "%' ";
                } else {
                    $query_string = "bd.Boys  LIKE '%" . $params['Boys'] . "%'";
                }
            }

            if (isset($params['Girls'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.Girls LIKE '% " . $params['Girls'] . "%' ";
                } else {
                    $query_string = "bd.Girls  LIKE '%" . $params['Girls'] . "%'";
                }
            }

            if (isset($params['limit'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.limit LIKE '%" . $params['limit'] . "%' ";
                } else {
                    $query_string = " bd.limit  LIKE '%" . $params['limit'] . "%'";
                }
            }
            if (isset($params['Class_Det_ID']) && !empty(isset($params['Class_Det_ID']))) {
                if ($status_flag == 1) {
                    $class_data_raw = $params['Class_Det_ID'];
                    $class_data = json_decode($class_data_raw);
                    $class_ids = implode(",", $class_data);
                    if (isset($class_ids) && !empty($class_ids)) {
                        if (strlen($query_string) > 0) {
                            $query_string = $query_string . " AND " . " bd.Class_Det_ID  IN (" . $class_ids . ") ";
                        } else {
                            $query_string = " bd.Class_Det_ID  IN ('" . $class_ids . "') ";
                        }
                    }
                } else {
                    if (strlen($query_string) > 0) {
                        $query_string = $query_string . " AND " . " bd.Class_Det_ID = '" . $params['Class_Det_ID'] . "' ";
                    } else {
                        $query_string = " bd.Class_Det_ID  = '" . $params['Class_Det_ID'] . "'";
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
                    $query_string = $query_string . " AND " . " bd.Stream_ID LIKE '%" . $params['Stream_ID'] . "%' ";
                } else {
                    $query_string = " bd.Stream_ID  LIKE '%" . $params['Stream_ID'] . "%'";
                }
            }

            if (isset($params['Acd_Year']) && !empty($params['Acd_Year'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.Acd_Year = '" . $params['Acd_Year'] . "' ";
                } else {
                    $query_string = " bd.Acd_Year  = '" . $params['Acd_Year'] . "'";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['BatchID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.BatchID LIKE '%" . $params['BatchID'] . "%' ";
                } else {
                    $query_string = "bd.BatchID LIKE '%" . $params['BatchID'] . "%' ";
                }
            }
            if (isset($params['academic_year'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " academic_year LIKE'%" . $params[' academic_year'] . "%' ";
                } else {
                    $query_string = " academic_year LIKE '%" . $params['academic_year'] . "%' ";
                }
            }
            if (isset($params['class'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " class LIKE '%" . $params['class'] . "%' ";
                } else {
                    $query_string = "class LIKE '%" . $params['class'] . "%' ";
                }
            }
            if (isset($params['Class'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " Class LIKE '%" . $params['Class'] . "%' ";
                } else {
                    $query_string = "Class LIKE '%" . $params['Class'] . "%' ";
                }
            }
            if (isset($params['Batch_Name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.Batch_Name LIKE '%" . $params['Batch_Name'] . "%' ";
                } else {
                    $query_string = "bd.Batch_Name  LIKE '%" . $params['Batch_Name'] . "%'";
                }
            }
            if (isset($params['Boys'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.Boys LIKE '%" . $params['Boys'] . "%' ";
                } else {
                    $query_string = "bd.Boys  LIKE '%" . $params['Boys'] . "%'";
                }
            }

            if (isset($params['Girls'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.Girls LIKE '% " . $params['Girls'] . "%' ";
                } else {
                    $query_string = "bd.Girls  LIKE '%" . $params['Girls'] . "%'";
                }
            }

            if (isset($params['limit'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.limit LIKE '%" . $params['limit'] . "%' ";
                } else {
                    $query_string = " bd.limit  LIKE '%" . $params['limit'] . "%'";
                }
            }
            if (isset($params['Class_Det_ID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.Class_Det_ID LIKE '%" . $params['Class_Det_ID'] . "%' ";
                } else {
                    $query_string = " bd.Class_Det_ID  LIKE '%" . $params['Class_Det_ID'] . "%'";
                }
            }

            if (isset($params['Session_ID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.Session_ID LIKE '%" . $params['Session_ID'] . "%' ";
                } else {
                    $query_string = " bd.Session_ID  LIKE '%" . $params['Session_ID'] . "%'";
                }
            }
            if (isset($params['Stream_ID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.Stream_ID LIKE '%" . $params['Stream_ID'] . "%' ";
                } else {
                    $query_string = " bd.Stream_ID  LIKE '%" . $params['Stream_ID'] . "%'";
                }
            }
            if (isset($params['Acd_Year'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " bd.Acd_Year ='" . $params['Acd_Year'] . "' ";
                } else {
                    $query_string = " bd.Acd_Year  = '" . $params['Acd_Year'] . "'";
                }
            }
        }

        $batch_list = $this->MBatch->get_batch_details($apikey, $query_string);
        if (!empty($batch_list) && is_array($batch_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $batch_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_batch_with_student_id($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['studentid'])) {
            $studentid = $params['studentid'];
        } else {
            return array('status' => 0, 'message' => 'Student ID is requried');
        }
        $batch_list = $this->MBatch->get_batch_details_for_student_id($apikey, $studentid);
        if (!empty($batch_list) && is_array($batch_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $batch_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_batch($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['Acd_Year']) && !empty($params['Acd_Year'])) {
            $dbparams[1] = $params['Acd_Year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year is required', 'data' => FALSE);
        }
        if (isset($params['Class_Det_ID']) && !empty($params['Class_Det_ID'])) {
            $dbparams[2] = $params['Class_Det_ID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class  is required', 'data' => FALSE);
        }
        if (isset($params['stream_id']) && !empty($params['stream_id'])) {
            $dbparams[3] = $params['stream_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Stream  is required', 'data' => FALSE);
        }
        if (isset($params['medium_id']) && !empty($params['medium_id'])) {
            $dbparams[4] = $params['medium_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Medium  is required', 'data' => FALSE);
        }
        //        $dbparams[5] = 'KG/BB';

        if (isset($params['Boys']) && (!empty($params['Boys']) || $params['Boys'] == 0)) {
            $dbparams[5] = $params['Boys'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Boys is required', 'data' => FALSE);
        }
        if (isset($params['Girls']) && (!empty($params['Girls']) || $params['Girls'] == 0)) {
            $dbparams[6] = $params['Girls'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Girls is required', 'data' => FALSE);
        }
        if (isset($params['limit']) && !empty($params['limit'])) {
            $dbparams[7] = $params['limit'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Strength is required', 'data' => FALSE);
        }
        if (isset($params['Session_ID']) && !empty($params['Session_ID'])) {
            $dbparams[8] = $params['Session_ID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Session is required', 'data' => FALSE);
        }
        if (isset($params['Division']) && !empty($params['Division'])) {
            $dbparams[9] = $params['Division'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Division is required', 'data' => FALSE);
        }
        if (isset($params['batch_code']) && !empty($params['batch_code'])) {
            $dbparams[10] = $params['batch_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Batch Code required', 'data' => FALSE);
        }

        $batch_add_status = $this->MBatch->add_new_batch($dbparams);
        //        return $batch_add_status;
        if (!empty($batch_add_status) && is_array($batch_add_status) && $batch_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('BatchID' => $batch_add_status['BatchID'], 'Batch_Name' => $batch_add_status['Batch_Name']));
        } else {
            if (is_array($batch_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $batch_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_batch($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['BatchID']) && !empty($params['BatchID'])) {
            $dbparams[1] = $params['BatchID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch ID is required', 'data' => FALSE);
        }
        if (isset($params['Acd_Year']) && !empty($params['Acd_Year'])) {
            $dbparams[2] = $params['Acd_Year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Acd_Year is required', 'data' => FALSE);
        }
        if (isset($params['Class_Det_ID']) && !empty($params['Class_Det_ID'])) {
            $dbparams[3] = $params['Class_Det_ID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class Det _ID is required', 'data' => FALSE);
        }
        if (isset($params['stream_id']) && !empty($params['stream_id'])) {
            $dbparams[4] = $params['stream_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Stream ID is required', 'data' => FALSE);
        }
        if (isset($params['medium_id']) && !empty($params['medium_id'])) {
            $dbparams[5] = $params['medium_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Medium is required', 'data' => FALSE);
        }
        if (isset($params['Boys']) && !empty($params['Boys'])) {
            $dbparams[6] = $params['Boys'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Boys is required', 'data' => FALSE);
        }
        if (isset($params['Girls']) && !empty($params['Girls'])) {
            $dbparams[7] = $params['Girls'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Girls is required', 'data' => FALSE);
        }
        if (isset($params['limit']) && !empty($params['limit'])) {
            $dbparams[8] = $params['limit'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Strength is required', 'data' => FALSE);
        }
        if (isset($params['Session_ID']) && !empty($params['Session_ID'])) {
            $dbparams[9] = $params['Session_ID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Session ID is required', 'data' => FALSE);
        }
        if (isset($params['Division']) && !empty($params['Division'])) {
            $dbparams[10] = $params['Division'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Division  is required', 'data' => FALSE);
        }
        if (isset($params['batch_code']) && !empty($params['batch_code'])) {
            $dbparams[11] = $params['batch_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Batch Code  is required', 'data' => FALSE);
        }
        $dbparams[12] = 1;
        $dbparams[13] = 0;

        $batch_add_status = $this->MBatch->update_batch_data($dbparams);
        //        dev_export($batch_add_status);die;
        if (!empty($batch_add_status) && is_array($batch_add_status) && isset($batch_add_status['ErrorStatus']) && $batch_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $batch_add_status);
        } else {
            if (isset($batch_add_status['ErrorMessage']) && !empty($batch_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $batch_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_batch_status($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['BatchID']) && !empty($params['BatchID'])) {
            $dbparams[1] = $params['BatchID'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch ID is required', 'data' => FALSE);
        }

        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = NULL;
        $dbparams[7] = NULL;
        $dbparams[8] = NULL;
        $dbparams[9] = NULL;
        $dbparams[10] = NULL;
        $dbparams[11] = NULL;
        $dbparams[12] = 0;

        if (isset($params['status'])) {
            $dbparams[13] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Status is required', 'data' => FALSE);
        }

        $batch_add_status = $this->MBatch->update_batch_data($dbparams);
        if (!empty($batch_add_status) && is_array($batch_add_status) && isset($batch_add_status['ErrorStatus']) && $batch_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $batch_add_status);
        } else {
            if (isset($batch_add_status['ErrorMessage']) && !empty($batch_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $batch_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function save_batch_allocate($param)
    {

        $student_data_raw = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['batch_data']) && !empty($param['batch_data'])) {
            $batch_data_raw = $param['batch_data'];
        } else {
            return array('status' => 0, 'message' => 'Batch data  is requried.', 'data' => FALSE);
        }
        if (isset($param['batchid']) && !empty($param['batchid'])) {
            $batchid = $param['batchid'];
        } else {
            return array('status' => 0, 'message' => ' Batch ID  is requried.', 'data' => FALSE);
        }
        //        dev_export($batch_data_raw);die;
        $formatted_array = array();


        $batch_data = json_decode($batch_data_raw, TRUE);
        //        dev_export($batch_data);die;
        foreach ($batch_data as $value) {
            $formatted_array[]['student_id'] = $value;
        }
        //        dev_export($formatted_array);die;
        $xml_data = xml_generator($formatted_array);
        //        dev_export($xml_data);
        //        die;
        $status = $this->MBatch->save_batch_allocate($xml_data, $batchid, $apikey);
        //      
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data updated');
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student  Batch Allocation failed', 'studentid' => 0);
            }
        }
    }
}
