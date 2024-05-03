<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acessories_controller
 *
 * @author chandrajith.edsys
 */
class Acessories_controller extends MX_Controller {
   public function __construct() {
        parent::__construct();
        $this->load->model('Acessories_model', 'MAcessories');
    }
     public function get_acessories($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['accessorieName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.accessorieName LIKE '%" . $params['accessorieName'] . "%' ";
                } else {
                    $query_string = "c.sparePartName LIKE '%" . $params['accessorieName'] . "%' ";
                }
            }
            
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['accessorieName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.accessorieName = '" . $params['accessorieName'] . "' ";
                } else {
                    $query_string = "c.accessorieName = '" . $params['accessorieName'] . "' ";
                }
            }          
            
        }

        $sparepart_list = $this->MAcessories->get_acessories_details($apikey, $query_string);
        
        if (!empty($sparepart_list) && is_array($sparepart_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $sparepart_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_acessories($params = NULL) {
                  
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        
         if (isset($params['spareparts_data']) && !empty($params['spareparts_data'])) {
            $dbparams[1] = $params['spareparts_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare parts details are required', 'data' => FALSE);
        }
         if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        
        $spareparts_add_status = $this->MAcessories->add_new_spareparts($dbparams);
        if (!empty($spareparts_add_status) && is_array($spareparts_add_status) && $spareparts_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $spareparts_add_status['id']));
        } else {
            if (is_array($spareparts_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => v['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
}
