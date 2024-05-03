<?php

/**
 * Description of Pay back_model
 *
 * @author Aju S Aravind
 */
class Payback_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_payback_data($inst_id, $acd_year_id, $api_key)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_payback_data] ?,?,?", array($api_key, $inst_id, $acd_year_id))->result_array();
        return $data;
    }

    public function get_payback_voucher_data($inst_id, $student_id, $api_key)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_payback_fee_voucher_data] ?,?,?", array($api_key, $inst_id, $student_id))->result_array();
        return $data;
    }

    public function get_payback_voucher_detail_data($inst_id, $payment_id, $api_key)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_payback_fee_codes_for_voucher] ?,?,?", array($api_key, $inst_id, $payment_id))->result_array();
        return $data;
    }

    public function save_payback_data($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_payback_request] ?,?,?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function get_payback_data_for_approval($inst_id, $master_id, $api_key)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_payback_data_for_approval] ?,?,?", array($api_key, $inst_id, $master_id))->result_array();
        return $data;
    }

    public function get_payback_detail_data_for_approval($inst_id, $master_id, $api_key)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_payback_detail_data_for_approval] ?,?,?", array($api_key, $inst_id, $master_id))->result_array();
        return $data;
    }

    public function save_payback_for_approve($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_payback_for_approval] ?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }
    public function save_payback_for_encashment($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_payback_for_encashment] ?,?,?,?,?,?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function save_payback_for_reject($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_payback_for_reject] ?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }
}
