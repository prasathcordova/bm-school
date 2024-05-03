<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student_model
 *
 * @author chandrajith.edsys
 */
class Student_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add_new_sponser($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $currency = $this->db->query("[settings].[add_sponser] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($currency) && is_array($currency)) {
                return $currency[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Please check the data and try again');
        }
    }

    public function get_sponsers_list($apikey, $query)
    {
        $this->db->flush_cache();
        return strlen($query);
        if (strlen($query) > 0) {
            $currency = $this->db->query("[settings].[sponsers_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $currency = $this->db->query("[settings].[sponsers_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $currency;
    }

    public function save_course_completed($xml_data, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[dbo].[save_course_complete] ?,?", array($apikey, $xml_data))->result_array();
        return $data[0];
    }

    public function save_promotion($xml_data, $classid, $batchid, $acd_year, $status_flag, $cur_class, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[dbo].[save_promotion] ?,?,?,?,?,?,?", array($apikey, $xml_data, $batchid, $classid, $acd_year, $status_flag, $cur_class))->result_array();
        return $data[0];
    }

    public function get_promoted_class($apikey, $class)
    {
        $this->db->flush_cache();
        $class = $this->db->query("[dbo].[get_promoted_class] ?,?", array($apikey, $class))->result_array();
        return $class;
    }

    public function get_promoted_class_count($apikey, $class)
    {
        $this->db->flush_cache();
        $count = $this->db->query("[dbo].[get_promoted_class_count] ?,?", array($apikey, $class))->result_array();
        $class_count = (isset($count[0]) ? $count['0'] : $count);
        return $class_count;
    }

    public function get_promoted_year($apikey, $ACD_ID)
    {
        $this->db->flush_cache();
        $year = $this->db->query("[dbo].[promotion_acd_select] ?,?", array($apikey, $ACD_ID))->result_array();
        return $year;
    }

    public function get_promotion_student_list($apikey, $batchid)
    {
        $this->db->flush_cache();
        if ($batchid == -1) {
            $studentdata = $this->db->query("[settings].[student_select_promotion] ?,?", array($apikey, 0))->result_array();
        } else {
            $studentdata = $this->db->query("[settings].[student_select_promotion] ?,?", array($apikey, $batchid))->result_array();
        }
        return $studentdata;
    }

    public function get_student_details($apikey, $acd_year, $batchid, $status_flag = 1, $courseid = 0)
    {
        $this->db->flush_cache();
        if ($batchid == -1) {
            $studentdata = $this->db->query("[dbo].[student_select] ?,?,?,?,?", array($apikey, $acd_year, 0, $status_flag, $courseid))->result_array();
        } else {
            $studentdata = $this->db->query("[dbo].[student_select] ?,?,?,?,?", array($apikey, $acd_year, $batchid, $status_flag, $courseid))->result_array();
        }


        return $studentdata;
    }

    public function get_longabsentstudent_details($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[student_selectlongabsentee] ?", $dbparams)->result_array();

        return $studentdata;
    }
    public function get_student_by_name_or_admission($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[get_student_by_name_or_admission] ?,?,?,?,?", $dbparams)->result_array();
        return $studentdata;
    }
    public function get_academic_history($apikey, $inst_id, $student_id)
    {
        $this->db->flush_cache();
        $academic_history = $this->db->query("[dbo].[get_academic_history] ?,?,?", array($apikey, $inst_id, $student_id))->result_array();
        return $academic_history;
    }

    public function getprofiledetails($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[studentprofile_select] ?,?", $dbparams)->result_array();

        return $studentdata;
    }
    public function get_students_by_admn_nos($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[get_students_by_admn_nos] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function getprofiledetails_search($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[substore_student_search] ?,?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_parentdata_list($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[settings].[Studentparentdetails_select_profile] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_passportvisa_list($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[passport_visa_dtls] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_sibilings_list($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[student_sibilings_select] ?,?", $dbparams)->result_array();

        return $studentdata;
    }
    //This function written by Vinoth k @ 20-05-2019 6:23
    public function get_sibilings_list_byadmno($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[student_sibilings_select_admno] ?,?", $dbparams)->result_array();
        return $studentdata;
    }

    public function get_sibilings_list_byname($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[student_sibilings_list_byname] ?,?", $dbparams)->result_array();
        return $studentdata;
    }
    public function get_sibilings_list_for_details($apikey, $student_id)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[student_sibilings_select] ?,?", array($apikey, $student_id))->result_array();

        return $studentdata;
    }

    public function get_studentdata_list($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[settings].[Studentdetails_select] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_student_profile_data_list($dbparams)
    {
        $this->db->flush_cache();
        $studentprofiledata = $this->db->query("[settings].[studentprofile_select] ?,?", $dbparams)->result_array();

        return $studentprofiledata;
    }

    public function get_student_allprofile_data_list($dbparams)
    {
        $this->db->flush_cache();
        $studentprofiledata = $this->db->query("[settings].[studentallprofile_select] ?", $dbparams)->result_array();

        return $studentprofiledata;
    }

    //@author Docme

    public function get_studentsearch_list($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[settings].[parentstudent_select] ?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
        //        dev_export($studentdata);die;
        return $studentdata;
    }
    public function get_student_data_for_parent_search($apikey, $query)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[settings].[parent_search_for_registration] ?,?", array($apikey, $query))->result_array();
        return $studentdata;
    }

    public function get_studentsearch_data($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[settings].[parentdetails_select] ?,?", $dbparams)->result_array();
        return $studentdata;
    }

    // end Docme

    /*
     * Auth:  Aju S Aravind
     * Description : For getting batch details to show as a filter page for the student listing page
     */
    public function get_batch_details_for_filter($acd_year_id, $apikey)
    {
        $this->db->flush_cache();
        $batchdata = $this->db->query("[settings].[batch_select_for_student_filter] ?,?", array($apikey, $acd_year_id))->result_array();
        return $batchdata;
    }

    // author Docme // status history
    public function status_history($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[settings].[status_history] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    // batch change // Docme
    public function std_change_batch($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[settings].[batch_change] ?,?,?,?", $dbparams)->result_array();
        //        return $studentdata;
        return isset($studentdata[0]) ? $studentdata[0] : $studentdata;
    }

    //create edit _admission_no function by vinoth @ 24-05-2019 14:54
    public function std_admn_no_change($dbparams)
    {
        $this->db->flush_cache();
        //            echo json_encode($dbparams);
        $studentdata = $this->db->query("[settings].[admission_no_change] ?,?,?,?", $dbparams)->result_array();
        return isset($studentdata[0]) ? $studentdata[0] : $studentdata;
    }

    /*
     * Auth: Docme
     * Description : priotiry setting for selection of emailID
     */

    public function email_priority($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[settings].[email_select_student] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    /*
     * Auth: Docme
     * Description : count no batch alloted students
     */

    public function no_batch_count($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[nobatch_student_select_count] ?,?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_nobatch_students($apikey, $first_name, $acd_year)
    {
        $this->db->flush_cache();
        $data = $this->db->query(" [settings].[student_search_nobatch] ?,?,?", array($apikey, $first_name, $acd_year))->result_array();
        return $data;
    }

    public function get_billstudentsearch($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[settings].[studentfilter_select] ?,?", $dbparams)->result_array();
        //        dev_export($studentdata);die;
        return $studentdata;
    }

    public function studentadvance_search($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[settings].[advanced_student_search] ?,?,?,?,?,?,?", $dbparams)->result_array();
        //        dev_export($studentdata);die;
        return $studentdata;
    }

    public function studentadvancebatch_search($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[billingbatch_student_search] ?,?", $dbparams)->result_array();
        //        dev_export($studentdata);die;
        return $studentdata;
    }

    //     public function get_student_profile_bill_data($apikey, $studentid) {
    //        $this->db->flush_cache();
    //        $studentdata = $this->db->query("[docme_bookstore].[studentprofile_bill_select] ?,?", array($apikey, $studentid))->result_array();
    //
    //        return $studentdata;
    //    }

    public function get_student_profile_bill_data($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_bookstore].[studentprofile_bill_select] ?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_student_details_for_portal($apikey, $parent_id, $inst_id)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[student_portalselect] ?,?,?", array($apikey, $parent_id, $inst_id))->result_array();
        return $studentdata;
    }
    public function get_student_details_by_id_for_portal($apikey, $student_id, $inst_id)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[student_portalselect_byid] ?,?,?", array($apikey, $student_id, $inst_id))->result_array();
        return $studentdata;
    }

    public function get_student_profile_by_admission_number($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[get_student_profile_by_admission_number] ?,?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function get_student_images($inst_id)
    {
        //$this->db->flush_cache();
        $studentdata = $this->db->query("[docme_registration].[get_STUD_REG_IMAGES] ?", array($inst_id))->result_array();
        return $studentdata;
    }
}
