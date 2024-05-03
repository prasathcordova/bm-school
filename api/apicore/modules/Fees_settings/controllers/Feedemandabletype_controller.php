<?php

/**
 * Description of Fee demandable type_controller
 *
 * @author aju.docme
 */
class Feedemandabletype_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Feedemandabletype_model', 'MFeedemandtype');
    }
    public function get_demand_type($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "isActive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "id = '" . $params['id'] . "' ";
                }
            }         
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "type_name LIKE '%" . $params['name'] . "%' ";
                } else {
                    $query_string = "type_name LIKE '%" . $params['name'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "id = '" . $params['id'] . "' ";
                }
            }
            
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "type_name = '" . $params['name'] . "' ";
                } else {
                    $query_string = "type_name = '" . $params['name'] . "' ";
                }
            }            
        }

        $demand_type = $this->MFeedemandtype->get_demand_type_details($apikey, $query_string);
        if (!empty($demand_type) && is_array($demand_type)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $demand_type);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
