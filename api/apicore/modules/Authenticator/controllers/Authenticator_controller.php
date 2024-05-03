<?php

/**
 * Description of Authenticator_controller
 *
 * @author aju.docme
 */
class Authenticator_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authenticator_model', 'MAuthenticator');
    }

    public function login_user($params)
    {
        $apikey = $params['API_KEY'];
        $user_credential = array();
        if (isset($params['user_email']) && !empty($params['user_email'])) {
            $user_credential['email'] = $params['user_email'];
        }
        if (isset($params['user_passcode']) && !empty($params['user_passcode'])) {
            $user_credential['passcode'] = $params['user_passcode'];
        }
        //        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
        //            $user_credential['inst_id'] = $params['inst_id'];
        //        }
        $user_credential['API_KEY'] = wordwrap(Keygenerator(79), 4, '-', true);
        $dbparams = array($user_credential['email'], $user_credential['passcode'], $user_credential['API_KEY'], 0);
        $user_data = $this->MAuthenticator->get_user_status($apikey, $dbparams);

        if (!empty($user_data) && is_array($user_data) && $user_data['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $user_data['data']);
        } else {
            if (is_array($user_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $user_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
            }
        }
    }

    public function verify_user_for_login($params)
    {
        $apikey = $params['API_KEY'];
        $user_credential = array();
        if (isset($params['user_phone_no']) && !empty($params['user_phone_no'])) {
            $user_credential['user_phone_no'] = $params['user_phone_no'];
        }
        if (isset($params['user_admnno']) && !empty($params['user_admnno'])) {
            $user_credential['user_admnno'] = $params['user_admnno'];
        }
        $user_credential['OTP'] = Keygenerator(6);
        $user_credential['API_KEY'] = wordwrap(Keygenerator(79), 4, '-', true);
        // return $params;
        $dbparams = array($apikey, $user_credential['user_phone_no'], $user_credential['user_admnno'], $user_credential['API_KEY'], $user_credential['OTP']);
        $user_data = $this->MAuthenticator->get_user_verify_for_otp($dbparams);
        // return $user_data;
        if (!empty($user_data) && is_array($user_data) && $user_data['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $user_data['data']);
        } else {
            if (is_array($user_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $user_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
            }
        }
    }

    public function get_user_list($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['emailid']) && !empty($params['emailid'])) {
            $query = "TLog.emailid = '" . $params['emailid'] . "'";
        } else {
            return array('status' => 0, 'Email ID is required');
        }
        $dbparams = array('0', $apikey, $query, 1);
        $user_data = $this->MAuthenticator->get_user_details($dbparams);
        if (!empty($user_data) && is_array($user_data) && $user_data['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $user_data['data']);
        } else {
            if (is_array($user_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $user_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
            }
        }
    }

    public function application_primary($params)
    {

        $apikey = $params['API_KEY'];

        $dbparams = array($apikey);

        $user_data = $this->MAuthenticator->get_primary_details($dbparams);
        if (!empty($user_data) && is_array($user_data) && $user_data['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $user_data['data']);
        } else {
            if (is_array($user_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $user_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
            }
        }
    }
    public function currency_details($params)
    {

        $apikey = $params['API_KEY'];
        $currencyid = $params['currencyid'];

        //$dbparams = array($apikey);

        $user_data = $this->MAuthenticator->get_currency_details($apikey, $currencyid);
        if (!empty($user_data) && is_array($user_data) && $user_data['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $user_data['data']);
        } else {
            if (is_array($user_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $user_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
            }
        }
    }
    public function parent_verify_and_login_with_otp_and_api($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['otp']) && !empty($params['otp'])) {
            $otp = $params['otp'];
        } else {
            return array('status' => 0, 'OTP KEY data is not available');
        }
        if (isset($params['API_KEY_VALIDATE']) && !empty($params['API_KEY_VALIDATE'])) {
            $api_key_validate = $params['API_KEY_VALIDATE'];
        } else {
            return array('status' => 0, 'OTP data is not available');
        }

        $user_data = $this->MAuthenticator->verify_to_authenticate_parent_with_otp($apikey, $api_key_validate, $otp);
        //        dev_export($user_data[0]);DIE;
        if (isset($user_data[0]) && !empty($user_data[0])  && $user_data[0]['USER_STATUS'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $user_data[0]);
        } else {
            if (is_array($user_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $user_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
            }
        }
    }

    public function app_login($params)
    {
        // $user_credential['api_key'] =  $params['API_KEY'];

        if (isset($params['username']) && !empty($params['username'])) {
            $user_credential['username'] = $params['username'];
        } else {
            return array('status' => 0, 'Username is required.');
        }
        if (isset($params['password']) && !empty($params['password'])) {
            $user_credential['password']  = $params['password'];
        } else {
            return array('status' => 0, 'Password is required,');
        }
        $user_credential['API_KEY'] = wordwrap(Keygenerator(79), 4, '-', true);
        //DB Part Start
        $user_data = $this->MAuthenticator->get_user_login($user_credential);
        if (!empty($user_data) && is_array($user_data) && $user_data['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $user_data['data']);
        } else {
            if (is_array($user_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $user_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Invalid User, Please check username and password.', 'data' => FALSE);
            }
        }
        // if ($username == '9998887776' && $password == '1234') {
        //     $user_data['name'] = "Docme";
        //     $user_data['api_key'] = '525-777-777';
        //     $user_data['success'] = 1;
        // } else {
        //     $user_data['ErrorMessage'] = "Invalid User, Please check username and password.";
        // }
        //DB Part End


    }
    public function mis_login_user($params)
    {
        //return $params;
        $user_credential = array();
        if (isset($params['user_email']) && !empty($params['user_email'])) {
            $user_credential['email'] = $params['user_email'];
        }
        if (isset($params['user_passcode']) && !empty($params['user_passcode'])) {
            $user_credential['passcode'] = $params['user_passcode'];
        }
        // if (isset($params['inst_id']) && !empty($params['inst_id'])) {
        //     $user_credential['inst_id'] = $params['inst_id'];
        // }
        $user_credential['status'] = 'login';
        $user_credential['cur_date'] = date('Y-m-d');
        $dbparams = array($user_credential['status'],$user_credential['email'], $user_credential['passcode'], $user_credential['cur_date']);
        $user_data = $this->MAuthenticator->get_mis_user($dbparams);

        if (!empty($user_data) && is_array($user_data) && $user_data['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $user_data['data']);
        } else {
            if (is_array($user_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $user_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
            }
        }
    }
    public function mis_get_inst_details($params)
    {
        // return $params;die;
        $user_credential = array();
        if (isset($params['Inst_Id']) && !empty($params['Inst_Id'])) {
            $user_credential['Inst_Id'] = $params['Inst_Id'];
        }
        $dbparams = array($user_credential['Inst_Id']);
        $inst_data = $this->MAuthenticator->get_mis_inst($dbparams);

        // if (!empty($inst_data) && is_array($inst_data) && $inst_data['ErrorStatus'] == 0) {
        //     return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $inst_data['data']);
        // } else {
        //     if (is_array($inst_data)) {
        //         return array('data_status' => 0, 'error_status' => 0, 'message' => $inst_data['ErrorMessage'], 'data' => FALSE);
        //     } else {
        //         return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        //     }
        // }
        if (!empty($inst_data) && is_array($inst_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $inst_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function update_password($params)
    {
        // return $params;die;
        $user_credential = array();
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $user_credential['user_id'] = $params['user_id'];
        }
        if (isset($params['password']) && !empty($params['password'])) {
            $user_credential['password'] = MD5($params['password']);
        }
        if (isset($params['emailid']) && !empty($params['emailid'])) {
            $user_credential['emailid'] = $params['emailid'];
        }
        if (isset($params['cur_pass']) && !empty($params['cur_pass'])) {
            $user_credential['cur_pass'] = MD5($params['cur_pass']);
        }
        $dbparams = array($user_credential['user_id'],$user_credential['cur_pass'],$user_credential['password'],$user_credential['emailid']);
        $result = $this->MAuthenticator->update_mis_pass($dbparams);
        // return $result;
        if (!empty($result) && is_array($result)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $result);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function acd_year_details($params)
    {
        // return $params;die;
        $user_credential = array();
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $user_credential['inst_id'] = $params['inst_id'];
        }
        
        $dbparams = array($user_credential['inst_id']);
        $result = $this->MAuthenticator->acd_year_details($dbparams);
        // return $result;
        if (!empty($result) && is_array($result)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $result);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
