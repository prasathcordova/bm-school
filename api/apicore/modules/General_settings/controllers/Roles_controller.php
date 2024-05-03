<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Roles_controller
 *
 * @author Docme.kumar
 */
class Roles_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Roles_model', 'MRoles');
    }
    public function get_role($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "r.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "r.role_id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "r.role_id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "r.role_name LIKE '%" . $params['name'] . "%' ";
                } else {
                    $query_string = "r.role_name LIKE '%" . $params['name'] . "%' ";
                }
            }
            
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "r.role_id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "r.role_id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "r.role_name = '" . $params['name'] . "' ";
                } else {
                    $query_string = "r.role_name = '" . $params['name'] . "' ";
                }
            }
            
        }


        $role_list = $this->MRoles->get_role_details($apikey, $query_string);
        if (!empty($role_list) && is_array($role_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $role_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_role($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['role_name']) && !empty($params['role_name'])) {
            $dbparams[1] = $params['role_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role Name is required', 'data' => FALSE);
        }

        $role_add_status = $this->MRoles->add_new_role($dbparams);
        if (!empty($role_add_status) && is_array($role_add_status) && $role_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('role_id' => $role_add_status['role_id'], 'role_name' => $role_add_status['role_name']));
        } else {
            if (is_array($role_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $role_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function update_role($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['roleid']) && !empty($params['roleid'])) {
            $dbparams[1] = $params['roleid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role ID is required', 'data' => FALSE);
        }
        if (isset($params['rolename']) && !empty($params['rolename'])) {
            $dbparams[2] = $params['rolename'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role Name is required', 'data' => FALSE);
        }
        $dbparams[3] = 1;
        $dbparams[4] = NULL;
        $role_add_status = $this->MRoles->update_role_data($dbparams);
        if (!empty($role_add_status) && is_array($role_add_status) && isset($role_add_status['ErrorStatus']) && $role_add_status['ErrorStatus'] == 0) {
//            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $role_add_status);
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => array('role_id' => $role_add_status['role_id'],'role_name' => $role_add_status['role_name']));
        } else {
            if (isset($role_add_status['ErrorMessage']) && !empty($role_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $role_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
    public function modify_role_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['roleid']) && !empty($params['roleid'])) {
            $dbparams[1] = $params['roleid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role ID is required', 'data' => FALSE);
        }

        $dbparams[2] = NULL;
        $dbparams[3] = 0;

        if (isset($params['status'])) {
            $dbparams[4] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role Status is required', 'data' => FALSE);
        }

        $role_add_status = $this->MRoles->update_role_data($dbparams);

        if (!empty($role_add_status['ErrorStatus']) && is_array($role_add_status) && $role_add_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $role_add_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $role_add_status['ErrorMessage'], 'data' => TRUE);
        }
    }

    public function permission_app_menus($params) {
        $apikey = $params['API_KEY'];
        $apppages = $this->MRoles->get_app_page_ops($apikey);
        if (!empty($apppages) && is_array($apppages)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $apppages);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
        }
    }

    public function permission_app_modules($params) {
        $apikey = $params['API_KEY'];
        $apppages = $this->MRoles->get_app_module_ops($apikey);
        if (!empty($apppages) && is_array($apppages)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $apppages);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
        }
    }

    public function get_role_privileges($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['roleid']) && !empty($params['roleid'])) {
            $roleid = $params['roleid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role is required', 'data' => FALSE);
        }
        $permissions = $this->MRoles->get_privileges_for_role($apikey, $roleid);
        if (!empty($permissions) && is_array($permissions)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $permissions);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
        }
    }
    public function available_permissions($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['roleid']) && !empty($params['roleid'])) {
            $roleid = $params['roleid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role is required', 'data' => FALSE);
        }
        $permissions = $this->MRoles->get_permissions($apikey, $roleid);
        if (!empty($permissions) && is_array($permissions)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $permissions);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
        }
    }

    public function save_role_permission($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['pre_data']) && !empty($params['pre_data'])) {
            $permission_raw_data = $params['pre_data'];
        } else {
            $permission_raw_data = NUll;
        }
        if (isset($params['roleid']) && !empty($params['roleid'])) {
            $roleid = $params['roleid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }
        $formatted_data = xml_generator(json_decode($permission_raw_data));

        $status = $this->MRoles->save_app_page_ops($apikey, $roleid, $formatted_data);

        if (!empty($status) && is_array($status) && isset($status[0]['error_status']) && $status[0]['error_status'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => TRUE);
        } else {
            if (is_array($status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function get_user_role($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['facultyid']) && !empty($params['facultyid'])) {
            $facultyid = $params['facultyid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Faculty ID is required', 'data' => FALSE);
        }
        $roles = $this->MRoles->get_role_for_user($apikey, $facultyid);
        if (!empty($roles) && is_array($roles)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => $roles);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
        }
    }

    public function save_user_role($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['facultyid']) && !empty($params['facultyid'])) {
            $facultyid = $params['facultyid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Faculty ID is required', 'data' => FALSE);
        }
        if (isset($params['roleid']) && !empty($params['roleid'])) {
            $roleid = json_decode($params['roleid']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role ID is required', 'data' => FALSE);
        }
        $roles = $this->MRoles->set_role_for_user($apikey, $facultyid, $roleid);
        if (!empty($roles) && is_array($roles)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $roles);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
        }
    }

    public function saveroles($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['role_name']) && !empty($params['role_name'])) {
            $dbparams[1] = $params['role_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role  Name is required', 'data' => FALSE);
        }

        if (isset($params['description']) && !empty($params['description'])) {
            $dbparams[2] = $params['description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role Description  is required', 'data' => FALSE);
        }

        if (isset($params['isinrole']) && !empty($params['isinrole'])) {
            $dbparams[3] = $params['isinrole'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role Status  is required', 'data' => FALSE);
        }

        $role_add_status = $this->MRoles->set_role_user($dbparams);
        if (!empty($role_add_status) && is_array($role_add_status) && $role_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $role_add_status['role_id']));
        } else {
            if (is_array($role_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $role_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_roles($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['role_name']) && !empty($params['role_name'])) {
            $dbparams[1] = $params['role_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role  Name is required', 'data' => FALSE);
        }

        if (isset($params['description']) && !empty($params['description'])) {
            $dbparams[2] = $params['description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role Description  is required', 'data' => FALSE);
        }

        if (isset($params['isinrole']) && !empty($params['isinrole'])) {

            $dbparams[3] = $params['isinrole'];
        } else {

            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role Status  is required', 'data' => FALSE);
        }
        if (isset($params['role_id']) && !empty($params['role_id'])) {
            $dbparams[4] = $params['role_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Role Id  is required', 'data' => FALSE);
        }

        $role_update_status = $this->MRoles->set_role_update($dbparams);
        if (!empty($role_update_status) && is_array($role_update_status) && $role_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Updated successfully', 'data' => array('id' => $role_update_status['role_id']));
        } else {
            if (is_array($role_update_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $role_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function get_role_permission_of_user($params = NULL) {
        $apikey = $params['API_KEY'];
        $user_permission = $this->MRoles->get_role_permission_of_user($apikey);
        if (isset($user_permission) && !empty($user_permission)) {
            return array('status' => 1, 'data' => $user_permission);
        } else {
            return array('status' => 0, 'data' => FALSE);
        }
    }

}
