<?php

/**
 * Description of Registration_controller
 * This controller is to deal with database operation for the registration purpose.
 * @author Aju S Aravind
 * Created Date : 01-Oct-2017
 */
class Registration_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Registration_model', 'MRegistration');
    }


    public function get_sponsers($params = NULL)
    {
        //         return $params;
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "s.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }
        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['currency_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_id LIKE '%" . $params['currency_id'] . "%' ";
                } else {
                    $query_string = "c.currency_id LIKE '%" . $params['currency_id'] . "%' ";
                }
            }
            if (isset($params['currency_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_name LIKE '%" . $params['currency_name'] . "%' ";
                } else {
                    $query_string = "c.currency_name LIKE '%" . $params['currency_name'] . "%' ";
                }
            }
            if (isset($params['currency_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_abbr LIKE '%" . $params['currency_abbr'] . "%' ";
                } else {
                    $query_string = "c.currency_abbr LIKE '%" . $params['currency_abbr'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['currency_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_id = '" . $params['currency_id'] . "' ";
                } else {
                    $query_string = "c.currency_id = '" . $params['currency_id'] . "' ";
                }
            }
            if (isset($params['currency_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_name = '" . $params['currency_name'] . "' ";
                } else {
                    $query_string = "c.currency_name = '" . $params['currency_name'] . "%' ";
                }
            }
            if (isset($params['currency_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_abbr = '" . $params['currency_abbr'] . "' ";
                } else {
                    $query_string = "c.currency_abbr = '" . $params['currency_abbr'] . "' ";
                }
            }
        }

        //        return $query_string;
        $currency_list = $this->MRegistration->get_sponsers_list($apikey, $query_string);
        //        return $currency_list;
        if (!empty($currency_list) && is_array($currency_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $currency_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function update_sponser($params = NULL)
    {
        //         return $params;
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['sponser_id']) && !empty($params['sponser_id'])) {
            $dbparams[1] = $params['sponser_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'sponser ID is required', 'data' => FALSE);
        }
        if (isset($params['sponser_name']) && !empty($params['sponser_name'])) {
            $dbparams[2] = $params['sponser_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Sponser Name is required', 'data' => FALSE);
        }
        if (isset($params['sponser_add']) && !empty($params['sponser_add'])) {
            $dbparams[3] = $params['sponser_add'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Sponser Address is required', 'data' => FALSE);
        }
        if (isset($params['sponser_email']) && !empty($params['sponser_email'])) {
            $dbparams[4] = $params['sponser_email'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Sponser Email is required', 'data' => FALSE);
        }
        if (isset($params['sponser_mobile']) && !empty($params['sponser_mobile'])) {
            $dbparams[5] = $params['sponser_mobile'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Sponser Mobile is required', 'data' => FALSE);
        }
        $dbparams[6] = 1;
        $dbparams[7] = 0;
        //        return $dbparams;
        $sponser_add_status = $this->MRegistration->update_sponser_data($dbparams);
        if (!empty($sponser_add_status) && is_array($sponser_add_status) && isset($sponser_add_status['ErrorStatus']) && $sponser_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $sponser_add_status);
        } else {
            if (isset($sponser_add_status['ErrorMessage']) && !empty($sponser_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $sponser_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function get_one_sponsers($params = NULL)
    {
        //         return $params;
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "s.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }
        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['sponser_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "S.id LIKE '%" . $params['sponser_id'] . "%' ";
                } else {
                    $query_string = "S.id LIKE '%" . $params['sponser_id'] . "%' ";
                }
            }
            if (isset($params['sname'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "S.Sponser_name LIKE '%" . $params['sname'] . "%' ";
                } else {
                    $query_string = "S.Sponser_name LIKE '%" . $params['sname'] . "%' ";
                }
            }
            if (isset($params['currency_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_abbr LIKE '%" . $params['currency_abbr'] . "%' ";
                } else {
                    $query_string = "c.currency_abbr LIKE '%" . $params['currency_abbr'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['sponser_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "S.s_id = '" . $params['sponser_id'] . "' ";
                } else {
                    $query_string = "S.s_id = '" . $params['sponser_id'] . "' ";
                }
            }
            if (isset($params['sname'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.Sponser_Name = '" . $params['sname'] . "' ";
                } else {
                    $query_string = "c.Sponser_Name = '" . $params['sname'] . "%' ";
                }
            }
            if (isset($params['currency_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_abbr = '" . $params['currency_abbr'] . "' ";
                } else {
                    $query_string = "c.currency_abbr = '" . $params['currency_abbr'] . "' ";
                }
            }
        }

        //        return strlen($query_string);
        $sponser_list = $this->MRegistration->get_sponsers_list($apikey, $query_string);
        //        return $currency_list;
        if (!empty($sponser_list) && is_array($sponser_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $sponser_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function email_validation($param)
    {

        $email = NULL;
        $sibling_id = NULL;
        $relation = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['email']) && !empty($param['email'])) {
            $email = $param['email'];
        } else {
            return array('status' => 0, 'message' => ' Mobile number  is requried.', 'data' => FALSE);
        }

        if (isset($param['sibling_id']) && !empty($param['sibling_id'])) {
            if ($param['sibling_id'] == -1) {
                $sibling_id = 0;
            } else {
                $sibling_id = $param['sibling_id'];
            }
        } else {
            return array('status' => 0, 'message' => ' Sibling ID  is requried.', 'data' => FALSE);
        }
        $sibling_id = $param['sibling_id'];
        if (isset($param['relation']) && !empty($param['relation'])) {
            $relation = $param['relation'];
        } else {
            return array('status' => 0, 'message' => 'Student Parent Relation  is requried.', 'data' => FALSE);
        }

        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('status' => 0, 'message' => 'Institution Id  is requried.', 'data' => FALSE);
        }
        $student_id = isset($param['student_id']) && !empty($param['student_id']) ? $param['student_id'] : 0;

        //        $status = $this->MRegistration->mobile_validation($mobile_number,$sibling_id,$relation, $apikey);
        $status = $this->MRegistration->email_validation($apikey, $email, $sibling_id, $relation, $inst_id, $student_id);

        if (isset($status) && !empty($status) && $status['ErrorStatus'] == 0) {
            return array('data_status' => $status['email_exist'], 'error_status' => 0, 'message' => $status['ErrorMessage']);
        } else {
            return array('data_status' => $status['email_exist'], 'error_status' => 1, 'message' => $status['ErrorMessage']);
        }
    }

    public function stud_profile_edit($param)
    {

        $apikey = $param['API_KEY'];
        if (isset($param['student_id']) && !empty($param['student_id'])) {
            $student_id = $param['student_id'];
        } else {
            return array('status' => 0, 'message' => ' Student ID  is requried.', 'data' => FALSE);
        }

        $status = $this->MRegistration->student_profile_edit($student_id, $apikey);
        $status['language_known'] = $this->MRegistration->student_language_view($student_id, $apikey);
        //       $a  = $this->MRegistration->student_language_view($student_id,$apikey);
        //        $language = 
        //        dev_export( $status['language_known']);die;
        if (isset($status) && !empty($status)) {
            return array('data_status' => 1, 'error_status' => 0, 'data' => $status,);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data Loading Error');
        }
    }

    public function adhar_validation($param)
    {

        $unique_id = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['Adhar_No']) && !empty($param['Adhar_No'])) {
            $unique_id = $param['Adhar_No'];
        } else {
            return array('status' => 0, 'message' => ' Aadhar Number  is requried.', 'data' => FALSE);
        }
        if (isset($param['student_id']) && !empty($param['student_id'])) {
            $student_id = $param['student_id'];
        } else {
            $student_id = 0;
        }
        if (isset($param['flag']) && !empty($param['flag'])) {
            $flag = $param['flag'];
        } else {
            $flag = 0;
        }
        //        $student_details = json_decode($student_data_raw, TRUE);
        $status = $this->MRegistration->adhar_validation($unique_id, $student_id, $flag, $apikey);
        //        dev_export($status);die;
        if (isset($status['ErrorStatus']) && !empty($status['ErrorStatus']) && $status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Aadhar Number Already Exists',);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Aadhar Number Does Not Exist');
        }
    }

    public function mobile_validation($param)
    {

        $mobile_number = NULL;
        $sibling_id = NULL;
        $relation = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['Phone3']) && !empty($param['Phone3'])) {
            $mobile_number = $param['Phone3'];
        } else {
            return array('status' => 0, 'message' => ' Mobile number  is requried.', 'data' => FALSE);
        }

        if (isset($param['sibling_id']) && !empty($param['sibling_id'])) {
            if ($param['sibling_id'] == -1) {
                $sibling_id = 0;
            } else {
                $sibling_id = $param['sibling_id'];
            }
        } else {
            return array('status' => 0, 'message' => ' Sibling ID  is requried.', 'data' => FALSE);
        }
        $sibling_id = $param['sibling_id'];
        if (isset($param['relation']) && !empty($param['relation'])) {
            $relation = $param['relation'];
        } else {
            return array('status' => 0, 'message' => 'Student Parent Relation  is requried.', 'data' => FALSE);
        }
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('status' => 0, 'message' => 'Institution Id  is requried.', 'data' => FALSE);
        }

        $student_id = isset($param['student_id']) && !empty($param['student_id']) ? $param['student_id'] : 0;

        //        $status = $this->MRegistration->mobile_validation($mobile_number,$sibling_id,$relation, $apikey);
        $status = $this->MRegistration->mobile_validation($apikey, $mobile_number, $sibling_id, $relation, $inst_id, $student_id);
        if (isset($status) && !empty($status) && $status['ErrorStatus'] == 0) {
            return array('data_status' => $status['mob_exist'], 'error_status' => 0, 'message' => $status['ErrorMessage']);
        } else {
            return array('data_status' => $status['mob_exist'], 'error_status' => 1, 'message' => $status['ErrorMessage']);
        }
    }

    public function save_facility_detail($param)
    {

        $student_data_raw = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        $student_details = json_decode($student_data_raw, TRUE);
        $status = $this->MRegistration->save_facility_details($student_details, $apikey);
        //        dev_export($status);die;
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data updated', 'student_id' => $status['student_id'], 'admn_no' => $status['admn_no']);
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'studentid' => 0, 'admn_no' => $status['admn_no']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed', 'studentid' => 0, 'admn_no' => '');
            }
        }
    }

    public function save_personal_profile_reg($param)
    {
        $student_data_raw = NULL;
        $language_data_raw = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['known_languages']) && !empty($param['known_languages'])) {
            $language_data_raw = $param['known_languages'];
        } else {
            return array('status' => 0, 'message' => 'Known Language  is requried.', 'data' => FALSE);
        }
        if (isset($param['student_image']) && !empty($param['student_image'])) {
            $student_image = $param['student_image'];
        } else {
            $student_image = '';
        }
        if (isset($param['temp_sid']) && !empty($param['temp_sid'])) {
            $student_temp_id = $param['temp_sid'];
        } else {
            $student_temp_id = '-1';
        }
        $language_data_raw2 = json_decode($language_data_raw, TRUE);
        $language_data = array();
        foreach ($language_data_raw2['language_select'] as $value) {
            $language_data[] = array('language_select' => $value);
        }
        $xml_language = xml_generator($language_data);
        $student_details[] = json_decode($student_data_raw, TRUE);
        $xml_data = xml_generator($student_details);
        $status = $this->MRegistration->save_personal_profile($xml_data, $apikey, $student_image, $xml_language, $student_temp_id);
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student created successfully.', 'studentid' => $status['student_id']);
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed', 'studentid' => 0);
            }
        }
    }

    public function edit_personal_profile_reg($param)
    {
        $student_data_raw = NULL;
        $language_data_raw = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['student_id']) && !empty($param['student_id'])) {
            $student_id = $param['student_id'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['known_languages']) && !empty($param['known_languages'])) {
            $language_data_raw = $param['known_languages'];
        } else {
            return array('status' => 0, 'message' => 'Known Language  is requried.', 'data' => FALSE);
        }
        if (isset($param['student_image']) && !empty($param['student_image'])) {
            $student_image = $param['student_image'];
        } else {
            $student_image = '';
        }
        $language_data_raw2 = json_decode($language_data_raw, TRUE);
        $language_data = array();
        foreach ($language_data_raw2['language_select'] as $value) {
            $language_data[] = array('language_select' => $value);
        }
        $xml_language = xml_generator($language_data);
        $student_details[] = json_decode($student_data_raw, TRUE);
        $xml_data = xml_generator($student_details);
        $status = $this->MRegistration->edit_personal_profile($xml_data, $apikey, $student_image, $xml_language, $student_id);
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student updated successfully.', 'studentid' => $status['student_id']);
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student updation failed', 'studentid' => 0);
            }
        }
    }

    public function save_academic_profile_reg($param)
    {
        $student_data_raw = NULL;
        $student_id = 0;
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['student_id']) && !empty($param['student_id'])) {
            $student_id = $param['student_id'];
        } else {
            $student_id = '';
        }
        if (isset($param['temp_sid']) && !empty($param['temp_sid'])) {
            $student_temp_id = $param['temp_sid'];
        } else {
            $student_temp_id = '-1';
        }

        $student_details[] = json_decode($student_data_raw, TRUE);
        $xml_data = xml_generator($student_details);
        //        dev_export($xml_data);die;
        $status = $this->MRegistration->save_academic_profile($xml_data, $apikey, $student_id, $student_temp_id);
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data updated', 'admission_no' => $status['Admn_no']);
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed', 'studentid' => 0);
            }
        }
    }

    public function edit_academic_profile_reg($param)
    {
        $student_data_raw = NULL;
        $student_id = 0;
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['student_id']) && !empty($param['student_id'])) {
            $student_id = $param['student_id'];
        } else {
            $student_id = '';
        }

        $student_details[] = json_decode($student_data_raw, TRUE);
        $xml_data = xml_generator($student_details);
        //        dev_export($xml_data);die;
        $status = $this->MRegistration->edit_academic_profile($xml_data, $apikey, $student_id);
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data updated', 'admission_no' => $status['Admn_no']);
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed', 'studentid' => 0);
            }
        }
    }

    //Author docMe
    //Date 06/OCT/2017
    //Purpose : Saving Student Parent Details -Registration
    public function save_parent_profile_reg($param)
    {
        $student_data_raw = NULL;
        $student_id = 0;
        $apikey = $param['API_KEY'];

        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['student_id']) && !empty($param['student_id'])) {
            $student_id = $param['student_id'];
        } else {
            $student_id = '';
        }
        if (isset($param['sibling_student_id']) && !empty($param['sibling_student_id'])) {
            if ($param['sibling_student_id'] == -1) {
                $sibling_student_id = 0;
            } else {
                $sibling_student_id = $param['sibling_student_id'];
            }
        } else {
            $sibling_student_id = 0;
        }

        if (isset($param['emp_id']) && !empty($param['emp_id'])) {
            if ($param['emp_id'] == -1) {
                $emp_id = 0;
            } else {
                $emp_id = $param['emp_id'];
            }
        } else {
            $emp_id = 0;
        }
        $who_worked = $param['who_worked'];

        if (isset($param['emp_inst_id']) && !empty($param['emp_inst_id'])) {
            if ($param['emp_inst_id'] == -1) {
                $emp_inst_id = 0;
            } else {
                $emp_inst_id = $param['emp_inst_id'];
            }
        } else {
            $emp_inst_id = 0;
        }

        $student_details_raw = json_decode($student_data_raw, TRUE);

        $student_details[0] = array(
            'typedata' => 1,
            'name' => $student_details_raw['fname'],
            'uuid' => $student_details_raw['f_uuid'],
            'profession' => $student_details_raw['fprofession_selected'],
            'relation' => 'F',
            'gender' => 'M',
            'cadd1' => $student_details_raw['fcadd1'],
            'cadd2' => $student_details_raw['fcadd2'],
            'cadd3' => $student_details_raw['fcadd3'],
            'czip' => $student_details_raw['fczip'],
            'cphone' => $student_details_raw['fcphone'],
            'cmobile' => $student_details_raw['fcmobile'],
            'cmail' => $student_details_raw['fcmail'],
            'oadd1' => $student_details_raw['foadd1'],
            'oadd2' => $student_details_raw['foadd2'],
            'oadd3' => $student_details_raw['foadd3'],
            'ozip' => $student_details_raw['fozip'],
            'ophone' => $student_details_raw['fophone'],
            'omobile' => $student_details_raw['fomobile'],
            'omail' => $student_details_raw['fomail'],
            'padd1' => $student_details_raw['fpadd1'],
            'padd2' => $student_details_raw['fpadd2'],
            'padd3' => $student_details_raw['fpadd3'],
            'pzip' => $student_details_raw['fpzip'],
            'pphone' => $student_details_raw['fpphone'],
            'pmobile' => $student_details_raw['fpmobile'],
            'pmail' => $student_details_raw['fpmail'],
        );

        if ($student_details_raw['mname']) {
            $student_details[1] = array(
                'typedata' => 1,
                'name' => $student_details_raw['mname'],
                'uuid' => $student_details_raw['m_uuid'],
                'profession' => $student_details_raw['mprofession_selected'],
                'relation' => 'M',
                'gender' => 'F',
                'cadd1' => $student_details_raw['mcadd1'],
                'cadd2' => $student_details_raw['mcadd2'],
                'cadd3' => $student_details_raw['mcadd3'],
                'czip' => $student_details_raw['mczip'],
                'cphone' => $student_details_raw['mcphone'],
                'cmobile' => $student_details_raw['mcmobile'],
                'cmail' => $student_details_raw['mcmail'],
                'oadd1' => $student_details_raw['moadd1'],
                'oadd2' => $student_details_raw['moadd2'],
                'oadd3' => $student_details_raw['moadd3'],
                'ozip' => $student_details_raw['mozip'],
                'ophone' => $student_details_raw['mophone'],
                'omobile' => $student_details_raw['momobile'],
                'omail' => $student_details_raw['momail'],
                'padd1' => $student_details_raw['mpadd1'],
                'padd2' => $student_details_raw['mpadd2'],
                'padd3' => $student_details_raw['mpadd3'],
                'pzip' => $student_details_raw['mpzip'],
                'pphone' => $student_details_raw['mpphone'],
                'pmobile' => $student_details_raw['mpmobile'],
                'pmail' => $student_details_raw['mpmail'],
            );
        }
        if ($student_details_raw['gname']) {
            $student_details[2] = array(
                'typedata' => 1,
                'name' => $student_details_raw['gname'],
                'uuid' => $student_details_raw['g_uuid'],
                'profession' => $student_details_raw['gprofession_selected'],
                'relation' => 'G',
                'gender' => $student_details_raw['ggender'],
                'cadd1' => $student_details_raw['gcadd1'],
                'cadd2' => $student_details_raw['gcadd2'],
                'cadd3' => $student_details_raw['gcadd3'],
                'czip' => $student_details_raw['gczip'],
                'cphone' => $student_details_raw['gcphone'],
                'cmobile' => $student_details_raw['gcmobile'],
                'cmail' => $student_details_raw['gcmail'],
                'oadd1' => $student_details_raw['goadd1'],
                'oadd2' => $student_details_raw['goadd2'],
                'oadd3' => $student_details_raw['goadd3'],
                'ozip' => $student_details_raw['gozip'],
                'ophone' => $student_details_raw['gophone'],
                'omobile' => $student_details_raw['gomobile'],
                'omail' => $student_details_raw['gomail'],
                'padd1' => $student_details_raw['gpadd1'],
                'padd2' => $student_details_raw['gpadd2'],
                'padd3' => $student_details_raw['gpadd3'],
                'pzip' => $student_details_raw['gpzip'],
                'pphone' => $student_details_raw['gpphone'],
                'pmobile' => $student_details_raw['gpmobile'],
                'pmail' => $student_details_raw['gpmail'],
            );
        }



        $xml_data = xml_generator($student_details);
        //        return $xml_data;
        //return $student_details;
        //        dev_export($xml_data);
        //        die;
        $status = $this->MRegistration->save_parent_profile($xml_data, $apikey, $student_id, $sibling_student_id, $emp_id, $emp_inst_id, $who_worked);
        //        dev_export($status);die;
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data saved', 'father_id' => $status['father_id'], 'mother_id' => $status['mother_id'], 'guardian_id' => $status['guardian_id']);
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed');
            }
        }
    }

    public function edit_parent_profile_reg($param)
    {
        $student_data_raw = NULL;
        $student_id = 0;
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['student_id']) && !empty($param['student_id'])) {
            $student_id = $param['student_id'];
        } else {
            return array('status' => 0, 'message' => 'Student ID  is requried.', 'data' => FALSE);
        }
        if (isset($param['sibling_student_id']) && !empty($param['sibling_student_id'])) {
            if ($param['sibling_student_id'] == -1) {
                $sibling_student_id = 0;
            } else {
                $sibling_student_id = $param['sibling_student_id'];
            }
        } else {
            $sibling_student_id = 0;
        }

        if (isset($param['father_id']) && !empty($param['father_id'])) {
            $father_id = $param['father_id'];
        } else {
            return array('status' => 0, 'message' => 'Father ID  is requried.', 'data' => FALSE);
        }
        if (isset($param['mother_id']) && !empty($param['mother_id'])) {
            $mother_id = $param['mother_id'];
        } else {
            return array('status' => 0, 'message' => 'Mother ID  is requried.', 'data' => FALSE);
        }
        if (isset($param['guardian_id']) && !empty($param['guardian_id'])) {
            $guardian_id = $param['guardian_id'];
        } else {
            $guardian_id = 0;
        }
        if (isset($param['emp_id']) && !empty($param['emp_id'])) {
            if ($param['emp_id'] == -1) {
                $emp_id = 0;
            } else {
                $emp_id = $param['emp_id'];
            }
        } else {
            $emp_id = 0;
        }
        $who_worked = $param['who_worked'];

        if (isset($param['emp_inst_id']) && !empty($param['emp_inst_id'])) {
            if ($param['emp_inst_id'] == -1) {
                $emp_inst_id = 0;
            } else {
                $emp_inst_id = $param['emp_inst_id'];
            }
        } else {
            $emp_inst_id = 0;
        }

        $student_details_raw = json_decode($student_data_raw, TRUE);
        //        dev_export($student_details_raw);die;
        $student_details[0] = array(
            'name' => $student_details_raw['fname'],
            'uuid' => $student_details_raw['f_uuid'],
            'profession' => $student_details_raw['fprofession_selected'],
            'relation' => 'F',
            'gender' => 'M',
            'cadd1' => $student_details_raw['fcadd1'],
            'cadd2' => $student_details_raw['fcadd2'],
            'cadd3' => $student_details_raw['fcadd3'],
            'czip' => $student_details_raw['fczip'],
            'cphone' => $student_details_raw['fcphone'],
            'cmobile' => $student_details_raw['fcmobile'],
            'cmail' => $student_details_raw['fcmail'],
            'oadd1' => $student_details_raw['foadd1'],
            'oadd2' => $student_details_raw['foadd2'],
            'oadd3' => $student_details_raw['foadd3'],
            'ozip' => $student_details_raw['fozip'],
            'ophone' => $student_details_raw['fophone'],
            'omobile' => $student_details_raw['fomobile'],
            'omail' => $student_details_raw['fomail'],
            'padd1' => $student_details_raw['fpadd1'],
            'padd2' => $student_details_raw['fpadd2'],
            'padd3' => $student_details_raw['fpadd3'],
            'pzip' => $student_details_raw['fpzip'],
            'pphone' => $student_details_raw['fpphone'],
            'pmobile' => $student_details_raw['fpmobile'],
            'pmail' => $student_details_raw['fpmail'],
        );

        if ($student_details_raw['mname']) {
            $student_details[1] = array(
                'name' => $student_details_raw['mname'],
                'uuid' => $student_details_raw['m_uuid'],
                'profession' => $student_details_raw['mprofession_selected'],
                'relation' => 'M',
                'gender' => 'F',
                'cadd1' => $student_details_raw['mcadd1'],
                'cadd2' => $student_details_raw['mcadd2'],
                'cadd3' => $student_details_raw['mcadd3'],
                'czip' => $student_details_raw['mczip'],
                'cphone' => $student_details_raw['mcphone'],
                'cmobile' => $student_details_raw['mcmobile'],
                'cmail' => $student_details_raw['mcmail'],
                'oadd1' => $student_details_raw['moadd1'],
                'oadd2' => $student_details_raw['moadd2'],
                'oadd3' => $student_details_raw['moadd3'],
                'ozip' => $student_details_raw['mozip'],
                'ophone' => $student_details_raw['mophone'],
                'omobile' => $student_details_raw['momobile'],
                'omail' => $student_details_raw['momail'],
                'padd1' => $student_details_raw['mpadd1'],
                'padd2' => $student_details_raw['mpadd2'],
                'padd3' => $student_details_raw['mpadd3'],
                'pzip' => $student_details_raw['mpzip'],
                'pphone' => $student_details_raw['mpphone'],
                'pmobile' => $student_details_raw['mpmobile'],
                'pmail' => $student_details_raw['mpmail'],
            );
        }
        if ($student_details_raw['gname']) {
            $student_details[2] = array(
                'name' => $student_details_raw['gname'],
                'uuid' => $student_details_raw['g_uuid'],
                'profession' => $student_details_raw['gprofession_selected'],
                'relation' => 'G',
                'gender' => $student_details_raw['ggender'],
                'cadd1' => $student_details_raw['gcadd1'],
                'cadd2' => $student_details_raw['gcadd2'],
                'cadd3' => $student_details_raw['gcadd3'],
                'czip' => $student_details_raw['gczip'],
                'cphone' => $student_details_raw['gcphone'],
                'cmobile' => $student_details_raw['gcmobile'],
                'cmail' => $student_details_raw['gcmail'],
                'oadd1' => $student_details_raw['goadd1'],
                'oadd2' => $student_details_raw['goadd2'],
                'oadd3' => $student_details_raw['goadd3'],
                'ozip' => $student_details_raw['gozip'],
                'ophone' => $student_details_raw['gophone'],
                'omobile' => $student_details_raw['gomobile'],
                'omail' => $student_details_raw['gomail'],
                'padd1' => $student_details_raw['gpadd1'],
                'padd2' => $student_details_raw['gpadd2'],
                'padd3' => $student_details_raw['gpadd3'],
                'pzip' => $student_details_raw['gpzip'],
                'pphone' => $student_details_raw['gpphone'],
                'pmobile' => $student_details_raw['gpmobile'],
                'pmail' => $student_details_raw['gpmail'],
            );
        }


        $xml_data = xml_generator($student_details);
        $status = $this->MRegistration->edit_parent_profile($xml_data, $apikey, $student_id, $sibling_student_id, $father_id, $mother_id, $guardian_id, $emp_id, $emp_inst_id, $who_worked);
        // return $status;
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data updated');
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed');
            }
        }
    }

    public function save_other_detail($param)
    {

        $student_data_raw = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['flag1']) && !empty($param['flag1'])) {
            $flag1 = $param['flag1'];
        } else {
            $flag1 = 0;
        }
        if (isset($param['flag2']) && !empty($param['flag2'])) {
            $flag2 = $param['flag2'];
        } else {
            $flag2 = 0;
        }

        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['studentid']) && !empty($param['studentid'])) {
            $studentid = $param['studentid'];
        } else {
            return array('status' => 0, 'message' => 'Student data id  is requried.', 'data' => FALSE);
        }
        $student_details = json_decode($student_data_raw, TRUE);

        if (isset($student_details['visanum']) && !empty($student_details['visanum'])) {
            if (isset($student_details['visissplace']) && !empty($student_details['visissplace'])) {
            } else {
                $status_array[] = 'Visa Issue Place  is requried.';
            }
            if (isset($student_details['visissudat']) && !empty($student_details['visissudat'])) {
            } else {
                $status_array[] = 'Visa Issue Date  is requried.';
            }
            if (isset($student_details['visexpdat']) && !empty($student_details['visexpdat'])) {
            } else {
                $status_array[] = 'Visa Expiry Date  is requried.';
            }
            if (isset($student_details['visdesc']) && !empty($student_details['visdesc'])) {
            } else {
                $status_array[] = 'Visa Description is requried.';
            }

            if (count($status_array) > 0) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => implode(',', $status_array));
            }
        }
        $status = $this->MRegistration->save_other_details($student_details, $apikey, $studentid, $flag1, $flag2);
        //        dev_export($status);die;
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data updated', 'admission_no' => $status['Admn_no']);
        } else {
            if (isset($status['ErrorMessage']) && !empty($status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['ErrorMessage'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed', 'studentid' => 0);
            }
        }
    }

    public function save_registration($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student d data  is requried.', 'data' => FALSE);
        }
        $student_details = json_decode($student_data_raw, TRUE);
        $xml_data = xml_generator($student_details);

        //        dev_export($xml_data);die;
        //        
        $status = $this->MRegistration->save_registration($xml_data, $apikey);
        //        dev_export($status);
        //        die;
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data updated', 'student_id' => $status['student_id']);
        } else {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed');
            }
        }
    }

    public function get_uuid_student_data($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['uuid']) && !empty($params['uuid'])) {
            $uuid = $params['uuid'];
        } else {
            return array('status' => 0, 'message' => 'UUID data is requried.', 'data' => FALSE);
        }

        $student_data = $this->MRegistration->get_uuid_student_data($apikey, $uuid);
        if (isset($student_data) && !empty($student_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data is loaded', 'student_data' => $student_data);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'There is no student available with the UUID.');
        }
    }
    public function get_g_uuid_parent_data($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['uuid']) && !empty($params['uuid'])) {
            $uuid = $params['uuid'];
        } else {
            return array('status' => 0, 'message' => 'UUID data is requried.', 'data' => FALSE);
        }

        $student_data = $this->MRegistration->get_g_uuid_parent_data($apikey, $uuid);
        if (isset($student_data) && !empty($student_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'parent data is loaded', 'student_data' => $student_data);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'There is no parent available with the UUID.');
        }
    }
    public function get_f_uuid_parent_data($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['uuid']) && !empty($params['uuid'])) {
            $uuid = $params['uuid'];
        } else {
            return array('status' => 0, 'message' => 'UUID data is requried.', 'data' => FALSE);
        }

        $student_data = $this->MRegistration->get_f_uuid_parent_data($apikey, $uuid);
        if (isset($student_data) && !empty($student_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data is loaded', 'student_data' => $student_data);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'There is no parent available with the UUID.');
        }
    }
    public function get_m_uuid_parent_data($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['uuid']) && !empty($params['uuid'])) {
            $uuid = $params['uuid'];
        } else {
            return array('status' => 0, 'message' => 'UUID data is requried.', 'data' => FALSE);
        }

        $student_data = $this->MRegistration->get_m_uuid_parent_data($apikey, $uuid);
        if (isset($student_data) && !empty($student_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data is loaded', 'student_data' => $student_data);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'There is no parent available with the UUID.');
        }
    }

    public function get_class_details_with_age_restriction($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $inst_id = $params['inst_id'];
        } else {
            return array('status' => 0, 'message' => 'Inst data is requried.', 'data' => FALSE);
        }
        if (isset($params['age']) && !empty($params['age'])) {
            $age = $params['age'];
        } else {
            return array('status' => 0, 'message' => 'Age data is requried.', 'data' => FALSE);
        }
        $flag = $params['flag'];

        $get_class_details = $this->MRegistration->get_class_details_for_age_restrict($apikey, $inst_id, $age, $flag);

        if (isset($get_class_details) && !empty($get_class_details)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data not available', 'data' => $get_class_details);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'There is no class available with the given age');
        }
    }


    public function save_student_temp_reg($param)
    {
        $student_data_raw = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data is requried.', 'data' => FALSE);
        }
        $student_details[] = json_decode($student_data_raw, TRUE);
        $xml_data = xml_generator($student_details);
        //        return html_escape($xml_data);
        $status = $this->MRegistration->save_temporary_reg($xml_data, $apikey);
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student created successfully.', 'studentid' => $status['student_id']);
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed', 'studentid' => 0);
            }
        }
    }

    public function update_student_temp_reg($param)
    {
        $student_data_raw = NULL;
        $student_id = NULL;
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data is requried.', 'data' => FALSE);
        }
        if (isset($param['student_id']) && !empty($param['student_id'])) {
            $student_id = $param['student_id'];
        } else {
            return array('status' => 0, 'message' => 'Student id is requried.', 'data' => FALSE);
        }
        $flag = $param['flag'];
        $student_details[] = json_decode($student_data_raw, TRUE);
        $xml_data = xml_generator($student_details);
        //        return html_escape($xml_data);
        $status = $this->MRegistration->update_temporary_reg($student_id, $xml_data, $flag, $apikey);
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student created successfully.', 'studentid' => $status['student_id']);
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed', 'studentid' => 0);
            }
        }
    }

    public function get_all_temp_students($param)
    {
        $apikey = $param['API_KEY'];
        $inst_id = $param['inst_id'];
        $student_list = $this->MRegistration->get_temp_students($apikey, $inst_id);
        if (!empty($student_list) && is_array($student_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_temp_reg_student($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['student_id']) && !empty($param['student_id'])) {
            $student_id = $param['student_id'];
        } else {
            return array('status' => 0, 'message' => 'Student id is requried.', 'data' => FALSE);
        }
        $student_list = $this->MRegistration->get_temp_student_for_update($apikey, $student_id);
        if (!empty($student_list) && is_array($student_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_temp_reg_data($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['admn']) && !empty($param['admn'])) {
            $admn = $param['admn'];
        } else {
            return array('status' => 0, 'message' => 'Admission no is requried.', 'data' => FALSE);
        }
        $student_list = $this->MRegistration->get_temp_reg_data($apikey, $admn);
        if (!empty($student_list) && is_array($student_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_otp_data($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['email']) && !empty($param['email'])) {
            $email = $param['email'];
        } else {
            return array('status' => 0, 'message' => 'email is requried.', 'data' => FALSE);
        }
        if (isset($param['OTP']) && !empty($param['OTP'])) {
            $OTP = $param['OTP'];
        } else {
            return array('status' => 0, 'message' => 'OTP is requried.', 'data' => FALSE);
        }
        if (isset($param['flag']) && !empty($param['flag'])) {
            $flag = $param['flag'];
        } else {
            return array('status' => 0, 'message' => 'flag is requried.', 'data' => FALSE);
        }
        $OTP_data = $this->MRegistration->get_otp_data($apikey, $email, $OTP, $flag);
        if (!empty($OTP_data) && is_array($OTP_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $OTP_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_select_reg_date_data($param)
    {
        $apikey = $param['API_KEY'];
        $inst_id = $param['inst_id'];
        $flag = $param['flag'];
        $student_list = $this->MRegistration->get_select_reg_date_data($apikey, $inst_id, $flag);
        if (!empty($student_list) && is_array($student_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function search_temp_reg_student($param)
    {
        $apikey = $param['API_KEY'];
        $inst_id = $param['inst_id'];
        $searchdata = $param['searchdata'];
        $flag = $param['flag'];
        $student_list = $this->MRegistration->search_temp_reg_student($apikey, $inst_id, $searchdata, $flag);
        if (!empty($student_list) && is_array($student_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_all_api_keys($param)
    {
        $apikey = $param['API_KEY'];
        $inst_id = $param['inst_id'];
        $student_list = $this->MRegistration->get_all_api_keys($apikey, $inst_id);
        if (!empty($student_list) && is_array($student_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_list[0]);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_entrance_date($param)
    {
        $apikey = $param['API_KEY'];
        $inst_id = $param['inst_id'];
        $class_id = $param['class_id'];
        $entrance_date = $this->MRegistration->get_entrance_date($apikey, $inst_id, $class_id);
        if (!empty($entrance_date) && is_array($entrance_date)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $entrance_date);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_mandatory_subjects($param)
    {
        $apikey = $param['API_KEY'];
        $inst_id = $param['inst_id'];
        $class_id = $param['class_id'];
        $mandatory_data = $this->MRegistration->get_mandatory_subjects($apikey, $inst_id, $class_id);
        if (!empty($mandatory_data) && is_array($mandatory_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $mandatory_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_all_unsync_temp_admn($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $data = $this->MRegistration->get_all_unsync_temp_admn();
        if (!empty($data) && is_array($data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_rims_response_online_registration($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = $params['response'];
        $dbparams[2] = $params['sync_status'];
        $dbparams[3] = $params['TempReg_ID'];
        $data = $this->MRegistration->save_rims_response_online_registration($dbparams);
        if (!empty($data) && is_array($data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_staff_sibling_list($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['aadharno']) && !empty($params['aadharno'])) {
            $dbparams[1] = $params['aadharno'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'aadharno is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst_id is required', 'data' => FALSE);
        }
        $data = $this->MRegistration->get_staff_sibling_list($dbparams);
        if (!empty($data) && is_array($data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_parent_details_online_reg($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['adtext']) && !empty($params['adtext'])) {
            $dbparams[1] = $params['adtext'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'adtext is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = '';
        }
        $dbparams[3] = $params['flag'];
        $dbparams[4] = $params['addr_flag'];
        $data = $this->MRegistration->get_parent_details_online_reg($dbparams);
        if (!empty($data) && is_array($data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_class_registration_fee($params = NULL)
    {
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('status' => 0, 'message' => 'Inst id is requried.', 'data' => FALSE);
        }
        $get_class_registration_fee = $this->MRegistration->get_class_registration_fee($dbparams);

        if (isset($get_class_registration_fee) && !empty($get_class_registration_fee)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data not available', 'data' => $get_class_registration_fee);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'There is no class available for institution');
        }
    }

    public function update_registration_fees($params = NULL)
    {
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('status' => 0, 'message' => 'Inst id is requried.', 'data' => FALSE);
        }
        if (isset($params['class_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['class_id'];
        } else {
            return array('status' => 0, 'message' => 'Class Id is requried.', 'data' => FALSE);
        }

        if ($params['flag'] == 1) {
            if (!empty($params['registration_fees'])) {
                $dbparams[3] = $params['registration_fees'];
            } else {
                $dbparams[3] = 0;
            }
            $dbparams[4] = 1;
            $dbparams[5] = $params['flag'];
            if (!empty($params['foreign_registration_fees'])) {
                $dbparams[6] = $params['foreign_registration_fees'];
            } else {
                $dbparams[6] = 0;
            }
        }
        if ($params['flag'] == 2) {

            if (!empty($params['registration_fees'])) {
                $dbparams[3] = $params['registration_fees'];
            } else {
                $dbparams[3] = 0;
            }
            if (isset($params['status']) && !empty($params['status'])) {
                $dbparams[4] = $params['status'];
            } else {
                return array('status' => 0, 'message' => 'status is requried.', 'data' => FALSE);
            }
            if (!empty($params['foreign_registration_fees'])) {
                $dbparams[6] = $params['foreign_registration_fees'];
            } else {
                $dbparams[6] = 0;
            }
            $dbparams[5] = $params['flag'];
        }


        $class_registration_fee_status = $this->MRegistration->update_class_registration_fee($dbparams);

        if (isset($class_registration_fee_status) && !empty($class_registration_fee_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data not available', 'data' => $class_registration_fee_status);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'There is no class available with the given age');
        }
    }

    public function get_all_temp_students_registration_fees($params)
    {
        $dbparams[0]  = $params['API_KEY'];
        $query_string = '';
        if (isset($params['acd_yr'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " t.Acd_Yr=" . $params['acd_yr'];
            } else {
                $query_string = " t.Acd_Yr=" . $params['acd_yr'];
            }
        }

        if (isset($params['inst_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " t.inst_id=" . $params['inst_id'];
            } else {
                $query_string = " t.inst_id=" . $params['inst_id'];
            }
        }

        if (isset($params['class_id'])) {
            if (strlen($query_string) > 0) {
                if ($params['class_id'] != 1000)
                    $query_string = $query_string . " AND " . " t.class=" . $params['class_id'];
            } else {
                if ($params['class_id'] != 1000)
                    $query_string = " t.class=" . $params['class_id'];
            }
        }

        if (isset($params['checked_temp_ids'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " t.TempReg_ID IN (" . $params['checked_temp_ids'] . ")";
            } else {
                $query_string = " t.TempReg_ID IN (" . $params['checked_temp_ids'] . ")";
            }
        }
        if (isset($params['payment_status'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " cdf.payment_status  IN (" . $params['payment_status'] . ")";
            } else {
                $query_string = " cdf.payment_status IN (" . $params['payment_status'] . ")";
            }
        }
        $dbparams[1] = $query_string;

        if (isset($params['flag'])) {
            $dbparams[2] = $params['flag'];
        } else {
            $dbparams[2] = 0;
        }
        $student_list = $this->MRegistration->get_all_temp_students_registration_fees($dbparams);
        if (!empty($student_list) && is_array($student_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_all_temp_students_registration_documents($params)
    {
        $dbparams[0]  = $params['API_KEY'];
        $query_string = '';
        if (isset($params['acd_yr'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " t.Acd_Yr=" . $params['acd_yr'];
            } else {
                $query_string = " t.Acd_Yr=" . $params['acd_yr'];
            }
        }

        if (isset($params['inst_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " t.inst_id=" . $params['inst_id'];
            } else {
                $query_string = " t.inst_id=" . $params['inst_id'];
            }
        }

        if (isset($params['class_id'])) {
            if (strlen($query_string) > 0) {
                if ($params['class_id'] != -2) {
                    $query_string = $query_string . " AND " . " t.class=" . $params['class_id'];
                } else {
                    $query_string = $query_string;
                }
            } else {
                if ($params['class_id'] != 1000)
                    $query_string = " t.class=" . $params['class_id'];
            }
        }

        /* if (isset($params['checked_temp_ids'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " t.TempReg_ID IN (" . $params['checked_temp_ids'] . ")";
            } else {
                $query_string = " t.TempReg_ID IN (" . $params['checked_temp_ids'] . ")";
            }
        } */
        if (isset($params['payment_status'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " cdf.payment_status  IN (" . $params['payment_status'] . ")";
            } else {
                $query_string = " cdf.payment_status IN (" . $params['payment_status'] . ")";
            }
        }
        $dbparams[1] = $query_string;

        /*  if (isset($params['flag'])) {
            $dbparams[2] = $params['flag'];
        } else {
            */
        $dbparams[2] = 0;
        //}
        $student_list = $this->MRegistration->get_all_temp_students_registration_documents($dbparams);
        if (!empty($student_list) && is_array($student_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function update_registration_payment_allocation($params)
    {
        $dbparams[0]  = $params['API_KEY'];
        $dbparams[1]  = $params['json_data'];
        if (isset($params['flag'])) {
            $dbparams[2]  = $params['flag']; //for updating data
        } else {
            $dbparams[2]  = 1; //For inserting data
        }

        $student_list = $this->MRegistration->update_registration_payment_allocation($dbparams);
        if (!empty($student_list) && is_array($student_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_registration_date($params)
    {
        $dbparams[0]  = $params['API_KEY'];
        if (isset($params['inst_id'])) {
            $dbparams[1]  = $params['inst_id'];
        } else {
            return array('status' => 0, 'message' => 'Inst id is requried.', 'data' => FALSE);
        }
        if (isset($params['class_id'])) {
            $dbparams[2]  = $params['class_id'];
        } else {
            return array('status' => 0, 'message' => 'Class Id is requried.', 'data' => FALSE);
        }
        if (isset($params['flag']) && $params['flag'] == 1) {
            if (isset($params['registration_open'])) {
                $dbparams[3]  = $params['registration_open'];
            } else {
                return array('status' => 0, 'message' => 'Registation Open date is requried.', 'data' => FALSE);
            }
            if (isset($params['registration_close'])) {
                $dbparams[4]  = $params['registration_close'];
            } else {
                return array('status' => 0, 'message' => 'Registation Close date is requried.', 'data' => FALSE);
            }
            $dbparams[5] = 1;
        } else {
            $dbparams[3] = date('Y-m-d');
            $dbparams[4] = date('Y-m-d');
            if (isset($params['status'])) {
                $dbparams[5]  = $params['status'];
            } else {
                return array('status' => 0, 'message' => 'Status is requried.', 'data' => FALSE);
            }
        }

        if (isset($params['flag'])) {
            $dbparams[6]  = $params['flag'];
        } else {
            return array('status' => 0, 'message' => 'Flag is requried.', 'data' => FALSE);
        }


        $registration_date_status = $this->MRegistration->save_registration_date($dbparams);
        if (!empty($registration_date_status) && is_array($registration_date_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $registration_date_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
