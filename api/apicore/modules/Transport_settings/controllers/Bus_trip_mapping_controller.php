<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bus_trip_mapping_controller
 *
 * @author chandrajith.edsys
 */
class Bus_trip_mapping_controller extends MX_Controller{
    public function __construct() {
        parent::__construct();
         $this->load->model('Bus_trip_mapping_model', 'Mbt');
    }
    public function save_bustrip_map ($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        
        if (isset($params['bus_id']) && !empty($params['bus_id'])) {
            $dbparams[1] = $params['bus_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Bus Id is required', 'data' => FALSE);
        }
       
        if (isset($params['template_data']) && !empty($params['template_data'])) {
            $dbparams[2] = $params['template_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Data is required', 'data' => FALSE);
        }  
         if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
//        return $dbparams;
        $bus_trip_map_add_status = $this->Mbt->add_new_bus_trip_map($dbparams);
//        dev_export($bus_trip_map_add_status);die;
        if (!empty($bus_trip_map_add_status) && is_array($bus_trip_map_add_status) && $bus_trip_map_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $bus_trip_map_add_status['id']));
        } else {
            if (is_array($bus_trip_map_add_status)) {
                return array('data_status' => 0, 'error_status' => 0,'tripname'=>$bus_trip_map_add_status['tripname'], 'message' => $bus_trip_map_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
}
