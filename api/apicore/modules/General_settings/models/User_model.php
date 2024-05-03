<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_model
 *
 * @author Docme.kumar
 */
class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_activities($apikey, $user_id)
    {
        $this->db->flush_cache();

        $data = $this->db->query("[docme_bookstore].[get_user_activity] ?,?", array($apikey, $user_id))->result_array();

        return $data;
    }

    public function get_user_details($apikey, $query, $pageNum)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $user = $this->db->query("[settings].[userprofile_select] ?,?,?,?", array(0, $apikey, $query, $pageNum))->result_array();
        } else {
            $user = $this->db->query("[settings].[userprofile_select] ?,?,?,?", array(1, $apikey, NULL, $pageNum))->result_array();
        }
        //        dev_export($user);die();
        return $user;
    }

    public function add_new_user($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $user = $this->db->query("[settings].[userprofile_save] ?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($user) && is_array($user)) {
                return $user[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'User not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'User not added. Please check the data and try again');
        }
    }

    public function update_user_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $user = $this->db->query("[settings].[userprofile_update] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            //            dev_export($user);die;
            if (!empty($user) && is_array($user)) {
                return $user[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'User not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'User not updated. Please check the data and try again');
        }
    }

    public function get_role_for_user($empid, $apikey)
    {
        $this->db->flush_cache();
        $roles = $this->db->query("[Auth].[userprofile_role_select] ?,?", array($apikey, $empid))->result_array();
        return $roles;
    }

    public function get_tuser_details($apikey, $query, $length)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $user = $this->db->query("[settings].[userprofile_teacherselect] ?,?,?,?", array(0, $apikey, $query, $length))->result_array();
        } else {
            $user = $this->db->query("[settings].[userprofile_teacherselect] ?,?,?,?", array(1, $apikey, NULL, $length))->result_array();
        }
        //        dev_export($user);die();
        return $user;
    }

    public function get_teacher_details($apikey, $query)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $user = $this->db->query("[settings].[teacher_profileemp] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $user = $this->db->query("[settings].[teacher_profileemp] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        //        dev_export($user);die();
        return $user;
    }

    public function getempprofiledetails($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[settings].[teacher_profileemp] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function userpasscode_change($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[substore_change_userpasscode] ?,?,?,?,?", $dbparams)->row_array();

        return $studentdata;
    }
}
