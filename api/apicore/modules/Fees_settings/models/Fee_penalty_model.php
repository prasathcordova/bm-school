<?php

/**
 * Fee_penalty_model
 *
 * @author aju.docme
 */
class Fee_penalty_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_fee_code_details($apikey, $query)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $fee_code = $this->db->query("[docme_fees].[fee_code_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $fee_code = $this->db->query("[docme_fees].[fee_code_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $fee_code;
    }
    public function get_all_penalty_data($dbparams)
    {
        $this->db->flush_cache();
        $penalty_details = $this->db->query("[docme_fees].[manage_penalty]  ?,?,?,?,?,?,?", $dbparams)->result_array();
        return $penalty_details;
    }
    public function get_penalty_data($dbparams)
    {
        $this->db->flush_cache();
        $penalty_details = $this->db->query("[docme_fees].[manage_penalty]  ?,?,?,?,?,?,?", $dbparams)->result_array();
        return $penalty_details;
    }
    public function get_feecodes_for_penalty($dbparams)
    {
        $this->db->flush_cache();
        $feecodes_for_penalty = $this->db->query("[docme_fees].[manage_penalty]  ?,?,?,?,?,?,?", $dbparams)->result_array();
        return $feecodes_for_penalty;
    }
    public function manage_penalty($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $feetype = $this->db->query("[docme_fees].[manage_penalty] ?,?,?,?,?,?,?", $dbparams)->result_array();
            return $feetype[0];
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Penalty not added. Please check the data and try again');
        }
    }
}
