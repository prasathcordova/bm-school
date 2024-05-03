<?php

/**
 * Description of Roles_controller
 *
 * @author chandrajith.edsys
 */
class Roles_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
    $this->load->model('Roles_model','MRole');
    }
    public function get_role($params=NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "r.isactive = " . $params['status'];
        }
        if (isset($params['role_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "r.role_id LIKE '%" . $params['role_id'] . "%' ";
            } else {
                $query_string = "r.role_id LIKE '%" . $params['role_id'] . "%' ";
            }
        }
        if (isset($params['role_name'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "r.role_name LIKE '%" . $params['role_name'] . "%' ";
            } else {
                $query_string = "r.role_name LIKE '%" . $params['role_name'] . "%' ";
            }
        }
        $role_list = $this->MRole->get_role_list($apikey, $query_string);
        if (!empty($role_list) && is_array($role_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $role_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        } 
        
    }
    public function save_role($params=NULL) {
          $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['role_name']) && !empty($params['role_name'])) {
            $dbparams[1] = $params['role_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role Name is required', 'data' => FALSE);
        }
         if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        $role_add_status = $this->MRole->add_new_role($dbparams);
        if (!empty($role_add_status) && is_array($role_add_status) && $role_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('role_id' => $role_add_status['role_id']));
        } else {
            if (is_array($role_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $role_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function update_role($params=NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['role_id']) && !empty($params['role_id'])) {
            $dbparams[1] = $params['role_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role ID is required', 'data' => FALSE);
        }
        if (isset($params['role_name']) && !empty($params['role_name'])) {
            $dbparams[2] = $params['role_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role Name is required', 'data' => FALSE);
        }
       
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['role_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID is required', 'data' => FALSE);
        }
        $dbparams[4] = 1;
        $dbparams[5] = 0;
        $role_add_status = $this->MRole->update_role_data($dbparams);
        if (!empty($role_add_status) && is_array($role_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $role_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
        
    }
     public function modify_role_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['role_id']) && !empty($params['role_id'])) {
            $dbparams[1] = $params['role_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = 0;
        
        if (isset($params['status']) )  {
            $dbparams[5] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role Status is required', 'data' => FALSE);
        }
        
        $role_add_status = $this->MRole->update_role_data($dbparams);
        if (!empty($role_add_status) && is_array($role_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $role_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }
}
