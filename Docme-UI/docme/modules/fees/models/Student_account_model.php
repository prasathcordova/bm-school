<?php

/**
 * Description of Student_account_model
 *
 * @author Aju S Aravind
 */
class Student_account_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_student_account_data($student_id,$inst_id,$acd_year_id) {
        $data_action = array(
            'action' => 'get_student_account_data',
            'student_id' => $student_id,
            'inst_id' => $inst_id,
            'acd_year_id' => $acd_year_id
        );
        $apikey = $this->session->userdata('API-Key');
        $collection_data = transport_data_with_param_with_urlencode($data_action, $apikey);
        if (isset($collection_data['status']) && !empty($collection_data['status']) && is_array($collection_data) && $collection_data['status'] == true) {
            return $collection_data['data'];
        } else {
            if (isset($collection_data['message']) && !empty($collection_data['message']) && is_array($collection_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data,
                    'data' => FALSE
                );
            }
        }
    }
    
    
}
