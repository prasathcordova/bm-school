<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Roles_model
 *
 * @author Docme.kumar
 */
class Roles_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_role_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $role = $this->db->query("[settings].[role_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $role = $this->db->query("[settings].[role_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $role;
    }

    public function add_new_role($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $role = $this->db->query("[settings].[role_save] ?,?", $dbparams)->result_array();
            if (!empty($role) && is_array($role)) {
                return $role[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role not added. Please check the data and try again');
        }
    }

    public function update_role_data($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $role = $this->db->query("[settings].[role_update] ?,?,?,?,?", $dbparams)->result_array();
//            dev_export($role);die;
            if (!empty($role) && is_array($role)) {
                return $role[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role not updated. Please check the data and try again');
        }
    }

    public function get_app_page_ops($apikey) {
        $this->db->flush_cache();
        if (!empty($apikey)) {
            $ops = $this->db->query("[Auth].[get_app_menus] ?", array($apikey))->result_array();
            return $ops;
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role not added. Please check the data and try again');
        }
    }

    public function get_app_module_ops($apikey) {
        $this->db->flush_cache();
        if (!empty($apikey)) {
            $ops = $this->db->query("[Auth].[get_app_module] ?", array($apikey))->result_array();
            return $ops;
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role not added. Please check the data and try again');
        }
    }

    public function get_privileges_for_role($apikey, $roleid) {
        $this->db->flush_cache();
        if (!empty($apikey)) {
            $ops = $this->db->query("[Auth].[get_permissions] ?,?", array($apikey, $roleid))->result_array();
            return $ops;
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Please check the data and try again');
        }
    }
    public function get_permissions($apikey, $roleid) {
        $this->db->flush_cache();
        if (!empty($apikey)) {
            $ops = $this->db->query("[Auth].[availablepermissions_select] ?,?", array($apikey, $roleid))->result_array();
            return $ops;
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Please check the data and try again');
        }
    }

    public function save_app_page_ops($apikey, $roleid, $formatteddata) {
        $this->db->flush_cache();
        if (!empty($apikey)) {
            $ops = $this->db->query("[Auth].[save_app_menus] ?,?,?", array($apikey, $roleid, $formatteddata))->result_array();
            return $ops;
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role not added. Please check the data and try again');
        }
    }

    public function get_role_for_user($apikey, $faculty_id) {
        $this->db->flush_cache();
        if (!empty($faculty_id)) {
            $ops = $this->db->query("[Auth].[get_role_map] ?,?", array($apikey, $faculty_id))->result_array();
            return $ops;
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role data cant be loaded. Please check the data and try again');
        }
    }

    public function set_role_for_user($apikey, $faculty_id, $roleid) {
        $this->db->flush_cache();
        if (!empty($faculty_id)) {
            $formatted_data = array();
            foreach ($roleid as $role) {
                $formatted_data[] = array(
                    'faculty_id' => $faculty_id,
                    'role_id' => $role
                );
            }
            $xmldata = xml_generator($formatted_data);

            $ops = $this->db->query("[Auth].[save_role_user_map] ?,?,?", array($apikey, $xmldata, $faculty_id))->result_array();
            return $ops;
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'User role data cant be loaded. Please check the data and try again');
        }
    }

    public function set_role_user($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $role = $this->db->query("[settings].[role_save]  ?,?,?,?", $dbparams)->result_array();
            if (!empty($role) && is_array($role)) {
                return $role[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role Data not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role Data not added. Please check the data and try again');
        }
    }

    public function set_role_update($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $role = $this->db->query("[settings].[role_update_role]  ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($role) && is_array($role)) {
                return $role[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role Data not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role Data not added. Please check the data and try again');
        }
    }
    
    public function get_role_permission_of_user($apikey) {
        $this->db->flush_cache();
        $user_data = $this->db->query("[Auth].[access_roles] ?", $apikey)->result_array();
        return $user_data;
    }

}
