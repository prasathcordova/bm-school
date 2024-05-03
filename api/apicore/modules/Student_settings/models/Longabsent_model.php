<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Longabsent_model
 *
 * @author rahul.shibukumar
 */
class Longabsent_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_longabsent_details($apikey, $query)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $class = $this->db->query("[settings].[longabsent_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $class = $this->db->query("[settings].[longabsent_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $class;
    }
    public function get_la_student_by_admission_no($params)
    {
        $this->db->flush_cache();
        $class = $this->db->query("[settings].[get_la_student_by_admission_no] ?,?,?", $params)->result_array();
        return $class;
    }
    public function save_longabsentee($apikey, $acd_year, $last_date_attendance, $absented_course, $fee_disablefrm, $admno, $student_id, $statusflag, $description)
    {
        //         dev_export($params);
        //         dev_export($apikey);die;
        $this->db->flush_cache();
        $data = $this->db->query("[dbo].[studentlongabsentee_save] ?,?,?,?,?,?,?,?,?", array($apikey, $acd_year, $last_date_attendance, $absented_course, $fee_disablefrm, $admno, $student_id, $statusflag, $description))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }
    //     public function save_longabsentee($params, $apikey) {
    //         dev_export($params);
    //         dev_export($apikey);die;
    //        $this->db->flush_cache();
    //        $data = $this->db->query("[dbo].[studentlongabsentee_save] ?,?", array($apikey, $params))->result_array();
    //
    //        return isset($data[0]) ? $data['0'] : $data;
    //    }
    public function get_student_longdetails($apikey, $acd_year, $batchid, $courseid = 0)
    {
        $this->db->flush_cache();
        if ($batchid == -1) {
            $studentdata = $this->db->query("[dbo].[student_selectlongabsentee] ?,?,?,?", array($apikey, $acd_year, 0, $courseid))->result_array();
        } else {
            $studentdata = $this->db->query("[dbo].[student_selectlongabsentee] ?,?,?,?", array($apikey, $acd_year, $batchid, $courseid))->result_array();
        }

        return $studentdata;
    }
    public function longabsente_release($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $release_student = $this->db->query("[dbo].[student_longabsentrelease] ?,?,?", $dbparams)->result_array();
            if (!empty($release_student) && is_array($release_student)) {
                return $release_student[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Long absentee Not Released. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Long absentee Not Released. Please check the data and try again');
        }
    }
}
