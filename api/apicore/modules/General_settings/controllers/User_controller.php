<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_controller
 *
 * @author Docme.kumar
 */
class User_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'MUser');
    }

    public function get_users($params = NULL)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['pageNum'])) {
            $pageNum = $params['pageNum'];
        } else {
            $pageNum = 1;
        }
        //         $pageNum = 1;
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "usp.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.emp_id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "emp.emp_id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.emp_name LIKE \"%" . $params['name'] . "%\" ";
                } else {
                    $query_string = "emp.emp_name LIKE '%" . $params['name'] . "%' ";
                }
            }

            if (isset($params['emailid'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.email LIKE '%" . $params['emailid'] . "%' ";
                } else {
                    $query_string = "emp.email LIKE '%" . $params['emailid'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.emp_id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "emp.emp_id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.emp_name  '" . $params['name'] . "' ";
                } else {
                    $query_string = "emp.emp_name  '" . $params['name'] . "' ";
                }
            }

            if (isset($params['emailid'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.email  '" . $params['emailid'] . "' ";
                } else {
                    $query_string = "emp.email  '" . $params['emailid'] . "' ";
                }
            }
        }


        $user_list = $this->MUser->get_user_details($apikey, $query_string, $pageNum);
        //        dev_export($user_list);die;
        if (!empty($user_list) && is_array($user_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $user_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_role_for_user($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['id'])) {
            $empid = $params['id'];
        } else {
            return array('status' => 1, 'message' => 'Employee data is required');
        }

        $role_data = $this->MUser->get_role_for_user($empid, $apikey);

        if (!empty($role_data) && is_array($role_data)) {
            return array('data_statue' => 1, 'error_status' => 0, 'message' => 'Data available', 'data' => $role_data);
        } else {
            return array('data_statue' => 0, 'error_status' => 1, 'message' => 'Roles not available', 'data' => FALSE);
        }
    }

    public function save_users($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['display_name']) && !empty($params['display_name'])) {
            $dbparams[1] = $params['display_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Name is required', 'data' => FALSE);
        }
        if (isset($params['add1']) && !empty($params['add1'])) {
            $dbparams[2] = $params['add1'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Address 1 is required', 'data' => FALSE);
        }
        if (isset($params['add2']) && !empty($params['add2'])) {
            $dbparams[3] = $params['add2'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Address 2 is required', 'data' => FALSE);
        }
        if (isset($params['city_id']) && !empty($params['city_id'])) {
            $dbparams[4] = $params['city_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' City id  is required', 'data' => FALSE);
        }
        if (isset($params['stateid']) && !empty($params['stateid'])) {
            $dbparams[5] = $params['stateid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' State id  is required', 'data' => FALSE);
        }
        if (isset($params['roleid']) && !empty($params['roleid'])) {
            $dbparams[6] = $params['roleid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Role id  is required', 'data' => FALSE);
        }
        if (isset($params['cntryid']) && !empty($params['cntryid'])) {
            $dbparams[7] = $params['cntryid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Country id  is required', 'data' => FALSE);
        }
        if (isset($params['contactno']) && !empty($params['contactno'])) {
            $dbparams[8] = $params['contactno'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Contact number  is required', 'data' => FALSE);
        }
        if (isset($params['emailid']) && !empty($params['emailid'])) {
            $dbparams[9] = $params['emailid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Email ID  is required', 'data' => FALSE);
        }
        if (isset($params['password']) && !empty($params['password'])) {
            $dbparams[10] = $params['password'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Password  is required', 'data' => FALSE);
        }
        if (isset($params['verificationcode']) && !empty($params['verificationcode'])) {
            $dbparams[11] = $params['verificationcode'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Verification code  is required', 'data' => FALSE);
        }

        $user_add_status = $this->MUser->add_new_user($dbparams);
        if (!empty($user_add_status) && is_array($user_add_status) && $user_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('user_id' => $user_add_status['user_id'], 'user_name' => $user_add_status['user_name']));
        } else {
            if (is_array($user_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $user_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_users($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['userprofileid']) && !empty($params['userprofileid'])) {
            $dbparams[1] = $params['userprofileid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User profile ID is required', 'data' => FALSE);
        }
        if (isset($params['displayname']) && !empty($params['displayname'])) {
            $dbparams[2] = $params['displayname'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Display Name is required', 'data' => FALSE);
        }
        if (isset($params['add1']) && !empty($params['add1'])) {
            $dbparams[3] = $params['add1'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address 1 is required', 'data' => FALSE);
        }
        if (isset($params['add2']) && !empty($params['add2'])) {
            $dbparams[4] = $params['add2'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address 2 is required', 'data' => FALSE);
        }
        if (isset($params['cityid']) && !empty($params['cityid'])) {
            $dbparams[5] = $params['cityid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'City ID is required', 'data' => FALSE);
        }
        if (isset($params['stateid']) && !empty($params['stateid'])) {
            $dbparams[6] = $params['stateid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State ID is required', 'data' => FALSE);
        }
        if (isset($params['countryid']) && !empty($params['countryid'])) {
            $dbparams[7] = $params['countryid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country ID is required', 'data' => FALSE);
        }
        if (isset($params['contactno']) && !empty($params['contactno'])) {
            $dbparams[8] = $params['contactno'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Contact number is required', 'data' => FALSE);
        }
        $dbparams[9] = 1;
        $dbparams[10] = NULL;
        $dbparams[11] = NULL;
        $dbparams[12] = NULL;
        $dbparams[13] = NULL;
        $dbparams[14] = NULL;
        $user_add_status = $this->MUser->update_user_data($dbparams);
        if (!empty($user_add_status) && is_array($user_add_status) && isset($user_add_status['ErrorStatus']) && $user_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $user_add_status);
        } else {
            if (isset($user_add_status['ErrorMessage']) && !empty($user_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $user_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_users_status($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['userprofileid']) && !empty($params['userprofileid'])) {
            $dbparams[1] = $params['userprofileid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User profile ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = NULL;
        $dbparams[7] = NULL;
        $dbparams[8] = NULL;
        $dbparams[9] = 4;
        if (isset($params['status'])) {
            $dbparams[10] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User Status is required', 'data' => FALSE);
        }
        $dbparams[11] = NULL;
        $dbparams[12] = NULL;
        $dbparams[13] = NULL;
        $dbparams[14] = NULL;
        $user_add_status = $this->MUser->update_user_data($dbparams);
        if (!empty($user_add_status['ErrorStatus']) && is_array($user_add_status) && $user_add_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $user_add_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $user_add_status['ErrorMessage'], 'data' => TRUE);
        }
    }

    public function user_email_update($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['userprofileid']) && !empty($params['userprofileid'])) {
            $dbparams[1] = $params['userprofileid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User profile ID is required', 'data' => FALSE);
        }

        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = NULL;
        $dbparams[7] = NULL;
        $dbparams[8] = NULL;
        $dbparams[9] = 2;
        $dbparams[10] = NULL;
        if (isset($params['emailid']) && !empty($params['emailid'])) {
            $dbparams[11] = $params['emailid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User profile ID is required', 'data' => FALSE);
        }
        if (isset($params['password']) && !empty($params['password'])) {
            $dbparams[12] = $params['password'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User profile ID is required', 'data' => FALSE);
        }
        if (isset($params['verificationcode']) && !empty($params['verificationcode'])) {
            $dbparams[13] = $params['verificationcode'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User profile ID is required', 'data' => FALSE);
        }
        $dbparams[14] = NULL;

        $user_add_status = $this->MUser->update_user_data($dbparams);
        //        dev_export($role_add_status); die;
        if (!empty($user_add_status['ErrorStatus']) && is_array($user_add_status) && $user_add_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $user_add_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $user_add_status['ErrorMessage'], 'data' => TRUE);
        }
    }

    public function user_role_update($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['userprofileid']) && !empty($params['userprofileid'])) {
            $dbparams[1] = $params['userprofileid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User profile ID is required', 'data' => FALSE);
        }

        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = NULL;
        $dbparams[7] = NULL;
        $dbparams[8] = NULL;
        $dbparams[9] = 3;
        $dbparams[10] = NULL;
        $dbparams[11] = NULL;
        $dbparams[12] = NULL;
        $dbparams[13] = NULL;
        if (isset($params['roleid']) && !empty($params['roleid'])) {
            $dbparams[14] = $params['roleid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User profile ID is required', 'data' => FALSE);
        }
        $user_add_status = $this->MUser->update_user_data($dbparams);
        //        dev_export($role_add_status); die;
        if (!empty($user_add_status['ErrorStatus']) && is_array($user_add_status) && $user_add_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $user_add_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $user_add_status['ErrorMessage'], 'data' => TRUE);
        }
    }

    public function getteacher_users($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "usp.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }
        $length = 100;


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.emp_id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "emp.emp_id = '" . str_replace(" ", "%", $params['id']) . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.emp_name LIKE \"%" . $params['name'] . "%\" ";
                } else {
                    $query_string = "emp.emp_name LIKE '%" . str_replace(" ", "%", $params['name']) . "%' ";
                }
            }

            if (isset($params['emailid'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.email LIKE '%" . $params['emailid'] . "%' ";
                } else {
                    $query_string = "emp.email LIKE '%" . str_replace(" ", "%", $params['emailid']) . "%' ";
                }
            }
            if (null !== $params['length']) {

                $length = $params['length'];
            } else {
                $length = 100;
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.emp_id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "emp.emp_id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.emp_name  '" . $params['name'] . "' ";
                } else {
                    $query_string = "emp.emp_name  '" . $params['name'] . "' ";
                }
            }

            if (isset($params['emailid'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.email  '" . $params['emailid'] . "' ";
                } else {
                    $query_string = "emp.email  '" . $params['emailid'] . "' ";
                }
            }
            if (null !== ($params['length'])) {
                $length = $params['length'];
            } else {
                $length = 100;
            }
        }

        $user_list = $this->MUser->get_tuser_details($apikey, $query_string, $length);

        if (!empty($user_list) && is_array($user_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $user_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_teacher($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "usp.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.emp_id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "emp.emp_id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.emp_name LIKE \"%" . $params['name'] . "%\" ";
                } else {
                    $query_string = "emp.emp_name LIKE '%" . $params['name'] . "%' ";
                }
            }

            if (isset($params['emailid'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.email LIKE '%" . $params['emailid'] . "%' ";
                } else {
                    $query_string = "emp.email LIKE '%" . $params['emailid'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.emp_id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "emp.emp_id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.emp_name  '" . $params['name'] . "' ";
                } else {
                    $query_string = "emp.emp_name  '" . $params['name'] . "' ";
                }
            }

            if (isset($params['emailid'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "emp.email  '" . $params['emailid'] . "' ";
                } else {
                    $query_string = "emp.email  '" . $params['emailid'] . "' ";
                }
            }
        }


        $user_list = $this->MUser->get_teacher_details($apikey, $query_string);
        //        dev_export($user_list);die;
        if (!empty($user_list) && is_array($user_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $user_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function getteacher_profiledetails($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['empid']) && !empty($params['empid'])) {
            $dbparams[1] = $params['empid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Employee ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $profiledetails = $this->MUser->getempprofiledetails($dbparams);
        if (!empty($profiledetails) && is_array($profiledetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $profiledetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function change_user_password($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['empid']) && !empty($params['empid'])) {
            $dbparams[1] = $params['empid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Employee ID is required', 'data' => FALSE);
        }
        if (isset($params['email']) && !empty($params['email'])) {
            $dbparams[2] = $params['email'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Email  ID is required', 'data' => FALSE);
        }
        if (isset($params['password']) && !empty($params['password'])) {
            $dbparams[3] = $params['password'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Password is required', 'data' => FALSE);
        }
        if (isset($params['old_password']) && !empty($params['old_password'])) {
            $dbparams[4] = $params['old_password'];
        } else {
            $dbparams[4] = NULL;
        }


        $profiledetails = $this->MUser->userpasscode_change($dbparams);
        if (!empty($profiledetails) && is_array($profiledetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $profiledetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_user_activity($params = NULL)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $user_id = $params['user_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'USER ID is required', 'data' => FALSE);
        }

        $role_list = $this->MUser->get_activities($apikey, $user_id);
        if (!empty($role_list) && is_array($role_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $role_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
