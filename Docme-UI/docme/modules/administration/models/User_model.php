<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_model
 *
 * @author chandrajith.edsys
 */
class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function set_roles($facultyid, $roleid)
    {
        $apikey = $this->session->userdata('API-Key');

        $user_data = transport_data_with_param_with_urlencode(array('action' => 'save_user_role', 'facultyid' => $facultyid, 'roleid' => $roleid), $apikey);

        if (is_array($user_data) && isset($user_data['data']) && !empty($user_data['data'])) {
            return $user_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $user_data,
                'data' => FALSE
            );
        }
    }

    public function change_userpasscode($Emp_id, $email, $user_password, $old_password)
    {
        $apikey = $this->session->userdata('API-Key');

        $user_data = transport_data_with_param_with_urlencode(array('action' => 'change_user_password', 'empid' => $Emp_id, 'email' => $email, 'password' => $user_password, 'old_password' => $old_password), $apikey);
        if (is_array($user_data) && isset($user_data['data']) && !empty($user_data['data'])) {
            return $user_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $user_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_user_list($page)
    {
        $apikey = $this->session->userdata('API-Key');
        $user_data = transport_data_with_param_with_urlencode(array('action' => 'get_users', 'pageNum' => $page), $apikey);
        //        dev_export( transport_data_with_param_with_urlencode(array('action' => 'get_users','pageNum' => $page), $apikey));die;
        if (is_array($user_data) && isset($user_data['data']) && !empty($user_data['data'])) {
            return $user_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $user_data,
                'data' => FALSE
            );
        }
    }

    public function get_user_data($userid)
    {
        $apikey = $this->session->userdata('API-Key');
        $paramenter = array(
            'action' => 'get_users',
            'mode' => 'strict',
            'id' => $userid
        );
        $user_data = transport_data_with_param_with_urlencode($paramenter, $apikey);
        if (is_array($user_data)) {
            return $user_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $user_data,
                'data' => FALSE
            );
        }
    }
    public function get_role_data($userid)
    {
        $apikey = $this->session->userdata('API-Key');
        $paramenter = array(
            'action' => 'get_role_for_user',
            'id' => $userid
        );
        $user_data = transport_data_with_param_with_urlencode($paramenter, $apikey);
        if (is_array($user_data)) {
            return $user_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $user_data,
                'data' => FALSE
            );
        }
    }

    public function search_user_list($query_string)
    {
        $apikey = $this->session->userdata('API-Key');
        $user_data = transport_data_with_param_with_urlencode(array('action' => 'get_users', 'mode' => 'search', 'name' => $query_string), $apikey);
        if (is_array($user_data) && isset($user_data['data']) && !empty($user_data['data'])) {
            return $user_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $user_data,
                'data' => FALSE
            );
        }
    }
}
