<?php

/**
 * Description of Fee_structure_model
 *
 * @author Aju
 */
class Fee_structure_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_fee_code_for_template($dbparams)
    {
        $this->db->flush_cache();
        $fee_code_template = $this->db->query("[docme_fees].[fee_code_for_template_select] ?,?,?,?", $dbparams)->result_array();
        return $fee_code_template;
    }
    public function get_term_details_for_feecode($dbparams)
    {
        $this->db->flush_cache();
        $fee_term_details = $this->db->query("[docme_fees].[get_term_details_for_feecode] ?,?,?,?", $dbparams)->result_array();
        return $fee_term_details;
    }

    public function get_demand_starting_date_for_updating_fee_amount($dbparams)
    {
        $this->db->flush_cache();
        $demand_starting_date = $this->db->query("[docme_fees].[get_demand_starting_date_for_updating_fee_amount] ?,?,?,?,?,?,?", $dbparams)->row_array();
        return $demand_starting_date;
    }
    public function get_fee_code_not_in_template($dbparams)
    {
        $this->db->flush_cache();
        $fee_code_template = $this->db->query("[docme_fees].[fee_code_not_in_template_select] ?,?,?", $dbparams)->result_array();
        return $fee_code_template;
    }

    public function link_fee_codes_to_template($dbparams)
    {
        $this->db->flush_cache();
        $fee_code_template = $this->db->query("[docme_fees].[link_fee_codes_to_template] ?,?,?,?,?", $dbparams)->result_array();
        return $fee_code_template;
    }

    public function get_class_details_with_template($dbparams)
    {
        $this->db->flush_cache();
        $fee_code_template = $this->db->query("[docme_fees].[get_class_attached_with_fee_template] ?,?,?", $dbparams)->result_array();
        return $fee_code_template;
    }

    public function get_batch_details_with_template($dbparams)
    {
        $this->db->flush_cache();
        $fee_code_template = $this->db->query("[docme_fees].[template_assigned_class_batch_select] ?,?,?,?", $dbparams)->result_array();
        return $fee_code_template;
    }
    public function check_other_fee_code_demanded($apikey, $feecode_id, $batch_id, $academic_year, $inst_id)
    {
        // return array($apikey, $feecode_id, $batch_id, $academic_year, $inst_id);
        $this->db->flush_cache();
        $fee_code_template = $this->db->query("[docme_fees].[check_other_fee_code_demanded] ?,?,?,?,?", array($apikey, $inst_id, $academic_year, $batch_id, $feecode_id))->row_array();
        // $fee_code_template = $this->db->query("[docme_fees].[student_search_for_template_allocation] ?,?,?", array($apikey, $feecode_id, ''))->result_array();
        //return $this->db->last_query();
        return $fee_code_template;
    }

    public function get_student_details_for_template_alloc($query, $template_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[student_search_for_template_allocation] ?,?,?", array($apikey, $template_id, $query))->result_array();
        return $data;
    }

    public function get_system_data_for_processing($inst_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_system_data_for_processing] ?,?,?", array($apikey, $inst_id, 1))->result_array();
        return $data;
    }
    public function save_fee_deallocation_with_students($data_to_deallocate)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_fee_deallocation_with_students] ?,?,?,?,?,?", $data_to_deallocate)->result_array();
        return $data;
    }
    public function get_bus_fee_demanded_details($apikey, $inst_id, $academic_year, $student_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_bus_fee_demanded_details] ?,?,?,?", array($apikey, $inst_id, $academic_year, $student_id))->result_array();
        return $data;
    }

    public function save_fee_allocation_with_students($data_to_save, $amount_array = [])
    {
        $this->db->flush_cache();
        //$data = $this->db->query("[docme_fees].[fee_template_student_mapping] ?,?,?,?,?,?,?,?", $data_to_save)->result_array();
        if (isset($amount_array['type']) && $amount_array['type'] == 'F002') {
            // $data = $this->db->query("[docme_fees].[fee_template_student_mapping_update] ?,?,?,?,?,?,?,?", $data_to_save)->result_array();
            $data = $this->db->query("[docme_fees].[bus_fee_template_student_mapping] ?,?,?,?,?,?,?,?", $data_to_save)->result_array();
        } else {
            $data = $this->db->query("[docme_fees].[fee_template_student_mapping] ?,?,?,?,?,?,?,?", $data_to_save)->result_array();
        }
        return $data;
    }

    public function get_student_list_for_template($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[fee_template_student_map_listing] ?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function de_allocate_students_from_template($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[fee_template_student_deallocation] ?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function get_fee_code_for_non_demand_allocation($dbparams)
    {
        $this->db->flush_cache();
        $fee_code_template = $this->db->query("[docme_fees].[fee_code_for_non_demand] ?,?,?", $dbparams)->result_array();
        return $fee_code_template;
    }

    public function save_non_demandable_fee_allocation_with_students($dbparams)
    {
        $this->db->flush_cache();
        $fee_code_template = $this->db->query("[docme_fees].[non_demandable_fee_allocation_to_student] ?,?,?,?,?", $dbparams)->result_array();
        return $fee_code_template;
    }

    public function save_other_fee_allocation_classwise($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[non_demandable_fee_allocation_to_class] ?,?,?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function get_feecode_for_bus_fee($apikey, $inst_id)
    {
        $this->db->flush_cache();
        $fee_code_data = $this->db->query("[docme_fees].[get_fee_code_details_of_bus_fee] ?,?", array($apikey, $inst_id))->result_array();
        return $fee_code_data;
    }
    public function get_bus_template_id($api_key, $inst_id)
    {
        $this->db->flush_cache();
        $template_id = $this->db->query("[docme_fees].[get_bus_template_id] ?,?", array($api_key, $inst_id))->row_array();
        return $template_id;
    }

    public function get_vacation_month_details($apikey, $inst_id)
    {
        $this->db->flush_cache();
        $fee_code_data = $this->db->query("[docme_fees].[get_vacation_month_details] ?,?", array($apikey, $inst_id))->result_array();
        return $fee_code_data;
    }

    public function save_bus_fee_allocation_with_students($dbparams)
    {
        $this->db->flush_cache();
        $fee_code_template = $this->db->query("[docme_fees].[fee_allocation_to_student_bus_fee] ?,?,?,?,?", $dbparams)->result_array();
        return $fee_code_template;
    }

    public function get_fee_code_data_from_db($feecode_id, $apikey, $inst_id, $acd_year_id)
    {
        $this->db->flush_cache();
        $fee_code_template = $this->db->query("[docme_fees].[get_fee_code_data_for_individual_f_allocation] ?,?,?,?", array(
            $apikey,
            $feecode_id,
            $inst_id,
            $acd_year_id
        ))->result_array();
        return $fee_code_template;
    }

    public function save_fee_custom_allocation_with_students($dbparams)
    {
        $this->db->flush_cache();
        $fee_code_template = $this->db->query("[docme_fees].[fee_allocation_to_student_by_other_fee_demand] ?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
        return $fee_code_template;
    }
    
    //deallocate_fee_of_student
    public function deallocate_fee_of_student($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[deallocate_fee_of_student] ?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }
}
