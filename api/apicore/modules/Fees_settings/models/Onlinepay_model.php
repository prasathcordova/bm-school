<?php


/**
 * Description of Onlinepay_model
 *
 * @author Aju
 */
class Onlinepay_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function save_collection_data_of_student_by_online_payment($data_to_save)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_save);
        $data = $this->db->query("[docme_fees].[save_fee_collection_by_online] $length", $data_to_save)->result_array();
        return $data;
    }
    public function get_online_pay_details($student_id, $inst_id, $acd_year_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_online_payment_history]  ?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id))->result_array();
        return $data;
    }
    public function get_student_data_by_admn_number($admn_no, $inst_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_student_data_by_admn_number]  ?,?,?", array($apikey, $inst_id, $admn_no))->result_array();
        return $data;
    }
    public function save_online_payment_data_failed_status($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_atom_failed_transaction]  ?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function get_all_api_keys($apikey, $inst_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_all_api_keys] ?,?", array($apikey, $inst_id))->result_array();
        return $data;
    }


    public function save_ewallet_amount_data_of_student_byonline($data_to_save)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_save);
        $data = $this->db->query("[docme_fees].[save_e_wallet_on_web_app_by_online] $length", $data_to_save)->result_array();
        return $data;
    }
}
