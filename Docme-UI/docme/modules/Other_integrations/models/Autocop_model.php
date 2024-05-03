<?php

/**
 * Description of Autocop_model
 *
 * @author Aju
 */
class Autocop_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_authorization_code($key) {
        $apikey = '525-777-777';
        $data_prep = array('action' => 'get_authorization_code_for_auto_cop_integration', 'key' => $key);
        $result = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($result)) {
            return $result['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $result,
                'data' => FALSE
            );
        }
    }

    public function push_data_to_api($data, $apikey) {

        $data_prep = array('action' => 'data_push_for_auto_cop_integration',  'data' => $data);
        $result = transport_data_with_param_with_urlencode($data_prep, $apikey);
        
        if (is_array($result)) {
            return $result['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $result,
                'data' => FALSE
            );
        }
    }

}
