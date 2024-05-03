<?php

/**
 * Description of data port integration
 * Date : 13/05/2019
 * @author FATHIMA
 */
class Dataport_integration_controller extends MX_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Dataport_model', 'MDataport');
    }
    public function get_auth_data_equator($params = NULL){
      
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst_id ID is required', 'data' => FALSE);
        }
        $data_list = $this->MDataport->get_auth_data_equator_data($dbparams);
        if (!empty($data_list) && is_array($data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }


    }
}