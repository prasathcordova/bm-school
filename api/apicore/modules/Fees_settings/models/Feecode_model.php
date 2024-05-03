<?php

/**
 * Description of fee code data manipulation
 *
 * @author aju.docme
 */
class Feecode_model extends CI_Model
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

    public function get_linked_fee_code_details($apikey, $inst_id, $student_id)
    {
        $this->db->flush_cache();
        $fee_code = $this->db->query("[docme_fees].[fee_linked_code_select] ?,?,?", array($apikey, $inst_id, $student_id))->result_array();
        return $fee_code;
    }
    public function add_new_fee_code($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $feetype = $this->db->query("[docme_fees].[fee_code_Save] ?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();

            return $feetype[0];
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Demand frequency not added. Please check the data and try again');
        }
    }

    public function update_fee_code_data($dbparams)
    {
        $this->db->flush_cache();

        if (is_array($dbparams)) {
            $feeetype = $this->db->query("[docme_fees].[fee_code_update] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($feeetype) && is_array($feeetype)) {
                return $feeetype[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Demand frequency not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Demand frequency not updated. Please check the data and try again');
        }
    }
}
