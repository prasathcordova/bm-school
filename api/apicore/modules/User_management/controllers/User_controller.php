<?php

/**
 * Description of User_controller
 *
 * @author aju.docme
 */
class User_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model', 'MUser');
    }

    public function get_user_details_by_verified_email_id($params) {
        $apikey = $params['API_KEY'];
        $emailid = "";
        if (isset($params['email_id'])) {
            $emailid = $params['email_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Email ID is required', 'data' => FALSE);
        }

        $local_status = $this->MUser->get_local_user_details($emailid, $apikey);
        if (is_array($local_status) && isset($local_status['status']) == 1) {
            $user_wfm_detail = $this->MUser->get_wfm_user_details($emailid);
            if (is_array($user_wfm_detail) && isset($user_wfm_detail['status']) == 1) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $user_wfm_detail['data']);
            } else {
                if (is_array($user_wfm_detail)) {
                    return array('data_status' => 0, 'error_status' => 0, 'message' => $user_wfm_detail['ErrorMessage'], 'data' => FALSE);
                } else {
                    return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
                }
            }
        } else {
            if (is_array($local_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $local_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    
    public function get_user_list_from_wfm($params) {
        $apikey = $params['API_KEY'];
        
    }

}
