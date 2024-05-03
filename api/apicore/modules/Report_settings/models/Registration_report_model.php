<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registration_report_model
 *
 * @author Shamna
 */
class Registration_report_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //Student Strength Details Report

    public function get_rpt_studstrngth($dbparams)
    {

        $this->db->flush_cache();
        $strngh_rpt = $this->db->query("[dbo].[Rpt_stud_strength] ?,?,?,?", $dbparams)->result_array();
        return $strngh_rpt;
    }
    public function get_student_id_wise_report($dbparams)
    {
        $this->db->flush_cache();
        $strngh_rpt = $this->db->query("[dbo].[get_student_id_wise_report] ?,?,?", $dbparams)->result_array();
        return $strngh_rpt;
    }

    //familywise report create by vinoth @17-06-2019 11:49
    public function get_rp_familywise($dbparams)
    {
        $this->db->flush_cache();
        $s_rpt = $this->db->query("[dbo].[Rpt_Stud_familywise_data] ?,?,?", $dbparams)->result_array();
        return $s_rpt;
    }

    //Student Nationalitywise Report

    public function get_nationality_rpt($dbparams)
    {
        $this->db->flush_cache();
        $nation_rpt = $this->db->query("[dbo].[Rpt_nationality] ?,?,?,?,?", $dbparams)->result_array();
        return $nation_rpt;
    }

    //promotion
    public function get_promotion_rpt($dbparams)
    {
        $this->db->flush_cache();
        $nation_rpt = $this->db->query("[dbo].[Rpt_promotion] ?,?,?,?", $dbparams)->result_array();
        return $nation_rpt;
    }
    //detained
    public function get_detained_rpt($dbparams)
    {
        $this->db->flush_cache();
        $nation_rpt = $this->db->query("[dbo].[Rpt_detained] ?,?,?,?", $dbparams)->result_array();
        return $nation_rpt;
    }
    //TC summary
    public function get_summary_rpt_tc($dbparams)
    {
        $this->db->flush_cache();
        $nation_rpt = $this->db->query("[dbo].[Rpt_tc_summary] ?,?,?,?", $dbparams)->result_array();
        return $nation_rpt;
    }
    //TC app status
    public function get_app_status_rpt_tc($dbparams)
    {
        $this->db->flush_cache();
        $nation_rpt = $this->db->query("[dbo].[Rpt_tc_app_status] ?,?,?,?,?", $dbparams)->result_array();
        return $nation_rpt;
    }

    //Religionwise Report
    public function get_religion_rpt($dbparams)
    {
        $this->db->flush_cache();
        $religion_rpt = $this->db->query("[dbo].[Rpt_religionwise] ?,?,?,?,?", $dbparams)->result_array();
        return $religion_rpt;
    }
    //    //Religionwise Report
    //    public function get_profession_wise_rpt($dbparams) {
    //        $this->db->flush_cache();
    //        $religion_rpt = $this->db->query("[dbo].[Rpt_religionwise] ?,?,?", $dbparams)->result_array();
    //        return $religion_rpt;
    //    }
    //Professionwise Report
    public function get_profession_wise_rpt($dbparams)
    {
        $this->db->flush_cache();
        $profes_rpt = $this->db->query("[dbo].[Rpt_profesionwise] ?,?,?", $dbparams)->result_array();
        return $profes_rpt;
    }

    //Castewise Report
    public function get_caste_rpt($dbparams)
    {
        $this->db->flush_cache();
        $caste_rpt = $this->db->query("[dbo].[Rpt_castewise] ?,?,?,?", $dbparams)->result_array();
        return $caste_rpt;
    }

    //Class/Divisionwise Report
    public function get_classdivsn_rpt($dbparams)
    {
        $this->db->flush_cache();
        $classdivsn_rpt = $this->db->query("[dbo].[Rpt_class_divisnwise] ?,?,?,?,?,?", $dbparams)->result_array();
        return $classdivsn_rpt;
    }

    //Classwise strength Report
    public function get_classwisestrnth_rpt($dbparams)
    {
        $this->db->flush_cache();
        $classstrgnth_rpt = $this->db->query("[dbo].[Rpt_stud_strength_class] ?,?,?", $dbparams)->result_array();
        return $classstrgnth_rpt;
    }

    public function get_no_batchstud_rpt($dbparams)
    {
        $this->db->flush_cache();
        $classstrgnth_rpt = $this->db->query("[dbo].[Rpt_nobatch_stud] ?,?,?", $dbparams)->result_array();
        return $classstrgnth_rpt;
    }

    //Collected Document Report
    public function get_collected_rpt($dbparams)
    {
        $this->db->flush_cache();
        $colldocumnt_rpt = $this->db->query("[dbo].[Rpt_collected_documnt] ?,?,?", $dbparams)->result_array();
        return $colldocumnt_rpt;
    }

    //Genderwise Report
    public function get_genderwisestud_rpt($dbparams)
    {
        $this->db->flush_cache();
        $gender_rpt = $this->db->query("[dbo].[Rpt_genderwise] ?,?,?,?,?", $dbparams)->result_array();
        return $gender_rpt;
    }

    //Agewise Report
    public function get_agewise_rpt($dbparams)
    {
        $this->db->flush_cache();
        $agewise_rpt = $this->db->query(" [dbo].[Rpt_stud_agewise] ?,?,?,?,?,?", $dbparams)->result_array();
        return $agewise_rpt;
    }

    //Contactwise Report
    public function get_contactwise_rpt($dbparams)
    {
        $this->db->flush_cache();
        $contactwise_rpt = $this->db->query("[dbo].[Rpt_stud_contact] ?,?,?,?,?,?", $dbparams)->result_array();
        return $contactwise_rpt;
    }

    //Familywise Report
    public function get_familywisestud_rpt($dbparams)
    {
        $this->db->flush_cache();
        $familywise_rpt = $this->db->query("[dbo].[Rpt_Stud_familywise] ?,?,?", $dbparams)->result_array();
        return $familywise_rpt;
    }

    //longabsenteewise Report
    public function get_longabsntwise_rpt($dbparams)
    {
        $this->db->flush_cache();
        $longabsntwise_rpt = $this->db->query("[dbo].[Rpt_stud_longabsentee] ?,?,?,?,?", $dbparams)->result_array();
        return $longabsntwise_rpt;
    }

    //SexAgewise Report
    public function get_sexagewise_rpt($dbparams)
    {
        $this->db->flush_cache();
        $sexage_rpt = $this->db->query("[dbo].[Rpt_stud_sexagewise] ?,?,?,?,?", $dbparams)->result_array();
        return $sexage_rpt;
    }

    public function get_rpt_course_classwise($dbparams)
    {
        $this->db->flush_cache();
        $course_classwise_rpt = $this->db->query("[settings].[class_select] ?,?,?,?", $dbparams)->result_array();
        return $course_classwise_rpt;
    }
    
}
