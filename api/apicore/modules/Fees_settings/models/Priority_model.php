<?php

/**
 * Description of Priority_model
 *
 * @author Aju S Aravind
 */
class Priority_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_priority_numbers($apikey, $inst_id, $acd_year_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_priority_count] ?,?,?", array($apikey, $inst_id, $acd_year_id))->result_array();
        return $data;
    }

    public function get_all_fee_codes_except_allotted($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_priority_feecode_pending_allocation] ?,?,?,?", $dbparams)->result_array();
        return $data;
    }

    public function get_all_existing_fee_codes($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_priority_feecode_allocated] ?,?,?,?", $dbparams)->result_array();
        return $data;
    }

    public function save_feecode_to_priority($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_priority_feecode_discount_map] ?,?,?,?,?", $dbparams)->result_array();
        return $data;
    }

    public function get_priority_numbers_for_staff($apikey, $inst_id, $acd_year_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_priority_count_for_staff] ?,?,?", array($apikey, $inst_id, $acd_year_id))->result_array();
        return $data;
    }

    public function get_all_fee_codes_for_staff($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_priority_feecode_for_staff] ?,?,?,?", $dbparams)->result_array();
        return $data;
    }

    public function get_all_existing_fee_codes_for_staff($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_priority_feecode_allocated_for_staff] ?,?,?,?", $dbparams)->result_array();
        return $data;
    }

    public function save_feecode_to_priority_for_staff($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_priority_feecode_discount_map_for_staff] ?,?,?,?,?", $dbparams)->result_array();
        return $data;
    }

    //SALAHUDHEEN AUG 3

    public function get_priority_students($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[get_priority_students]  $length", $data_to_db)->result_array();
        return $data;
    }

    public function apply_student_concession($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[apply_fee_concession]  $length", $data_to_db)->result_array();
        return $data;
    }

    //ARREAR MANAGEMENT
    public function get_student_data_for_arrear($apikey, $inst_id, $acd_year_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_student_list_for_arrear_management] ?,?,?", array($apikey, $inst_id, $acd_year_id))->result_array();
        return $data;
    }
    public function save_todays_arrear_summary($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[save_todays_arrear_summary] $length", $data_to_db)->result_array();
        return $data;
    }
    public function get_current_academic_year_of_institution($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[get_current_academic_year_of_institution] $length", $data_to_db)->result_array();
        return $data;
    }
}
