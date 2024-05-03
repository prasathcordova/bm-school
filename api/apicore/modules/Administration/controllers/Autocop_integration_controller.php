<?php


/**
 * Description of Autocop_integration_controller
 *
 * @author Aju S Aravind
 * 
 */
class Autocop_integration_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Autocop_model','MAutocop');
    }
    
    public function data_push_for_auto_cop_integration($param) {
        $apikey = $param['API_KEY'];
        if($apikey == '5999-XBT55-8844-0V43') {
            $new_api_key = '777-888-EVM-RNL-KWD';
        }
        if (isset($param['data']) && !empty($param['data'])) {
            $data = $param['data'];
        } else {
            return array('status' => 0, 'message' => 'Push data  is requried.', 'data' => FALSE);
        }
        
        $status = $this->MAutocop->update_data_from_autocop($new_api_key, $data);
        
        if (isset($status[0]['data_status']) && !empty($status[0]['data_status']) && $status[0]['data_status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Autocop data updated');
        } else {
            if (isset($status[0]['MSG']) && !empty($status[0]['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status[0]['MSG']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed');
            }
        }
    }
}

