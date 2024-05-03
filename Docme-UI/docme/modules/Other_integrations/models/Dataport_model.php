<?php

/**
 * Description of Dataport_model
 *
 * @author Fathima
 */
class Dataport_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function get_all_data_port_data($inst_id){

        $apikey = $this->session->userdata('API-Key');
        $data_port_tables = transport_data_with_param_with_urlencode(array('action' => 'get_data_port_data', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
        if (isset($data_port_tables) && !empty($data_port_tables) && is_array($data_port_tables)) {
            return $data_port_tables['data'];
        } else {
            if (isset($data_port_tables['message']) && !empty($data_port_tables['message']) && is_array($data_port_tables)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data_port_tables['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data_port_tables,
                    'data' => FALSE
                );
            }
        }
    }
}
