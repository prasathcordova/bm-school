<?php

/**
 * Description of Caste_controller
 *
 * @author Rahul.docme
 */
class Itemtype_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Itemtype_model', 'MItemtype');
    }

    public function get_itemtype($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "t.isactive = " . $params['status'];
        }
        
         if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }

       if (strcasecmp($mode, "search") == 0) {
        if (isset($params['itemtype_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "t.itemtype_id LIKE '%" . $params['itemtype_id'] . "%' ";
            } else {
                $query_string = "t.itemtype_id LIKE '%" . $params['itemtype_id'] . "%' ";
            }
        }
        if (isset($params['itemtype_name'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "t.itemtype_name LIKE '%" . $params['itemtype_name'] . "%' ";
            } else {
                $query_string = "t.name LIKE '%" . $params['name'] . "%' ";
            }
        }
        if (isset($params['itemtype_code'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "t.itemtype_code LIKE '%" . $params['itemtype_code'] . "%' ";
            } else {
                $query_string = "t.itemtype_code LIKE '%" . $params['itemtype_code'] . "%' ";
            }
        }    
        
      }else if (strcasecmp($mode, "strict" == 0)) {
          
        if (isset($params['itemtype_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "t.itemtype_id LIKE '%" . $params['itemtype_id'] . "%' ";
            } else {
                $query_string = "t.itemtype_id LIKE '%" . $params['itemtype_id'] . "%' ";
            }
        }
        if (isset($params['itemtype_name'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "t.itemtype_name LIKE '%" . $params['itemtype_name'] . "%' ";
            } else {
                $query_string = "t.name LIKE '%" . $params['name'] . "%' ";
            }
        }
        if (isset($params['itemtype_code'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "t.itemtype_code LIKE '%" . $params['itemtype_code'] . "%' ";
            } else {
                $query_string = "t.itemtype_code LIKE '%" . $params['itemtype_code'] . "%' ";
            }
        }
      }
      
         $itemtype_list = $this->MItemtype->get_itemtype_details($apikey, $query_string);
//         dev_export($publisher_list);die;
        if (!empty($itemtype_list) && is_array($itemtype_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $itemtype_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_itemtype($params = NULL) { 
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['itemtype_name']) && !empty($params['itemtype_name'])) {
            $dbparams[1] = $params['itemtype_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Name is required', 'data' => FALSE);
        }
       
        if (isset($params['itemtype_code']) && !empty($params['itemtype_code'])) {
            $dbparams[2] = $params['itemtype_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Code  is required', 'data' => FALSE);
        }
         
        $itemtype_add_status = $this->MItemtype->add_new_itemtype($dbparams);
        if (!empty($itemtype_add_status) && is_array($itemtype_add_status) && $itemtype_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $itemtype_add_status['Country_id']));
        } else {
            if (is_array($itemtype_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $itemtype_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_itemtype($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
         $dbparams[1] = 1;
        if (isset($params['itemtype_id']) && !empty($params['itemtype_id'])) {
            $dbparams[2] = $params['itemtype_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Type ID is required', 'data' => FALSE);
        }
        if (isset($params['itemtype_name']) && !empty($params['itemtype_name'])) {
            $dbparams[3] = $params['itemtype_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Type Name is required', 'data' => FALSE);
        }
        if (isset($params['itemtype_code']) && !empty($params['itemtype_code'])) {
            $dbparams[4] = $params['itemtype_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Type Code is required', 'data' => FALSE);
        }
        $dbparams[5] = 0;
        $itemtype_update_status = $this->MItemtype->itemtype_update_data($dbparams);
        if (!empty($itemtype_update_status) && is_array($itemtype_update_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $itemtype_update_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }

    
    

    public function modify_itemtype_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
           $dbparams[1] = 0;
        if (isset($params['itemtype_id']) && !empty($params['itemtype_id'])) {
            $dbparams[2] = $params['itemtype_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Type ID is required', 'data' => FALSE);
        }
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
      ;
     

        if (isset($params['status'])) {
            $dbparams[5] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item Type  Status is required', 'data' => FALSE);
        }

        $itemtype_add_status = $this->MItemtype->itemtype_update_data($dbparams);
        if (!empty($itemtype_add_status) && is_array($itemtype_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $itemtype_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }
}
