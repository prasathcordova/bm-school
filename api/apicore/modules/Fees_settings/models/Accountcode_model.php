<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accountcode_model
 *
 * @author chandrajith.edsys
 */
class Accountcode_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_accountcode_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $account_code = $this->db->query("[docme_fees].[accountcode_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $account_code = $this->db->query("[docme_fees].[accountcode_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $account_code;
    }

    public function add_new_accountcode($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $accountcode = $this->db->query("[docme_fees].[accountCodeSave] ?,?,?,?", $dbparams)->result_array();
            if (!empty($accountcode) && is_array($accountcode)) {
                return $accountcode[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Account Code not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Account Code not added. Please check the data and try again');
        }
    }

    public function update_accountcode_data($dbparams) {
        $this->db->flush_cache();

        if (is_array($dbparams)) {
            $accountcode = $this->db->query("[docme_fees].[accountcode_update] ?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($accountcode) && is_array($accountcode)) {
                return $accountcode[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Account Code not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Account Code not updated. Please check the data and try again');
        }
    }

}
