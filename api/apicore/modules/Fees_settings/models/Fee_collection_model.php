<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fee_collection_model
 *
 * @author aju.docme
 */
class Fee_collection_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_collection_data_of_student($student_id, $inst_id, $acd_year_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_fee_details_for_collection_only_on_web_app]  ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id, 1))->result_array();
        return $data;
    }

    public function get_collection_data_of_student_sum($student_id, $inst_id, $acd_year_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_fee_details_for_collection_only_on_web_app]  ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id, 2))->result_array();
        return $data;
    }
    public function get_collection_data_of_student_paid($student_id, $inst_id, $acd_year_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_fee_details_for_collection_only_on_web_app]  ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id, 4))->result_array();
        return $data;
    }
    public function get_wallet_statement_of_student($student_id, $inst_id, $acd_year_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_wallet_statement_of_student]  ?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id))->result_array();
        return $data;
    }
    public function one_time_pay_status_of_student($student_id, $inst_id, $acd_year_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[one_time_pay_status_of_student]  ?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id))->result_array();
        return $data;
    }

    public function get_blacklist_data_of_student($student_id, $inst_id, $acd_year_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_fee_details_for_collection_only_on_web_app]  ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id, 3))->result_array();
        return $data;
    }

    public function get_bank_details_for_processing($inst_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[bank_details_selector]  ?,?", array($apikey, $inst_id))->result_array();
        return $data;
    }
    public function get_penalty_details($inst_id, $apikey, $penalty_date)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_penalty_details]  ?,?,?", array($apikey, $inst_id, $penalty_date))->result_array();
        return $data;
    }
    public function get_term_details($apikey, $inst_id, $acd_year_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_term_details]  ?,?,?", array($apikey, $inst_id, $acd_year_id))->result_array();
        return $data;
    }

    public function save_collection_data_of_student($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_fee_details_for_collection_only_on_web_app]  ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function save_ewallet_amount_data_of_student_bycash($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_e_wallet_on_web_app_by_cash]  ?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function save_ewallet_amount_data_of_student_bycard($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_e_wallet_on_web_app_by_card]  ?,?,?,?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }
    public function save_ewallet_amount_data_of_student_bydbt($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_e_wallet_on_web_app_by_dbt]  ?,?,?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function save_ewallet_amount_data_of_student_bycheque($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_e_wallet_on_web_app_by_cheque]  ?,?,?,?,?,?,?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function save_collection_data_of_student_by_cash($data_to_save)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_save); // procedure_param_string() defined in Common_helper.php in Helper in api
        $data = $this->db->query("[docme_fees].[save_fee_collection_by_cash]  $length", $data_to_save)->result_array();
        return $data;
    }

    public function save_collection_data_of_student_by_cheque($data_to_save)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_save);
        $data = $this->db->query("[docme_fees].[save_fee_collection_by_cheque]   $length", $data_to_save)->result_array();
        return $data;
    }

    public function save_collection_data_of_student_by_card($data_to_save)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_save);
        $data = $this->db->query("[docme_fees].[save_fee_collection_by_card]  $length", $data_to_save)->result_array();
        return $data;
    }
    public function save_collection_data_of_student_by_dbt($data_to_save)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_save);
        $data = $this->db->query("[docme_fees].[save_fee_collection_by_dbt]  $length", $data_to_save)->result_array();
        return $data;
    }

    public function save_collection_data_of_student_by_wallet($data_to_save)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_save);
        $data = $this->db->query("[docme_fees].[save_fee_collection_by_wallet]  $length", $data_to_save)->result_array();
        return $data;
    }

    public function get_base_data_for_cheque_reconcile($apikey, $inst_id, $acd_year_id, $start_date, $end_date)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_base_data_for_reconcile]  ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $start_date, $end_date))->result_array();
        return $data;
    }

    public function recon_cheque_data($apikey, $inst_id, $acd_year_id, $master_id, $ops, $remarks)
    {
        $this->db->flush_cache();
        if ($ops == 1) {
            $data = $this->db->query("[docme_fees].[recon_cheque_data]  ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $master_id, $remarks))->result_array();
        } else if ($ops == 2) {
            $data = $this->db->query("[docme_fees].[recon_bounce_cheque_data]  ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $master_id, $remarks))->result_array();
        } else if ($ops == 3) {
            $data = $this->db->query("[docme_fees].[recon_cancel_cheque_data]  ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $master_id, $remarks))->result_array();
        }
        return $data;
    }

    public function get_blacklisted_students_data($apikey, $inst_id, $acd_year_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_base_data_for_blacklist_students]  ?,?,?", array($apikey, $inst_id, $acd_year_id))->result_array();
        return $data;
    }

    public function release_blacklist_students($apikey, $inst_id, $acd_year_id, $student_id, $remarks)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[release_blacklisted_students]  ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id, $remarks))->result_array();
        return $data;
    }

    public function get_request_list_data($apikey, $inst_id, $acd_year_id, $student_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_withdraw_request_list]  ?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id))->result_array();
        return $data;
    }

    public function save_request_for_withdraw($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_e_wallet_withdraw_request]  ?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function get_approve_data_for_withdraw_data($apikey, $inst_id, $acd_year_id, $student_id, $master_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_approval_data_for_withdrawal]  ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id, $master_id))->result_array();
        return $data;
    }

    public function save_request_for_withdraw_approve($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_e_wallet_withdraw_request_approve]  ?,?,?,?,?,?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function save_request_for_withdraw_reject($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_e_wallet_withdraw_request_reject]  ?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function get_encashment_data_for_withdraw_data($apikey, $inst_id, $acd_year_id, $student_id, $master_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_encashment_data_for_withdrawal]  ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id, $master_id))->result_array();
        return $data;
    }

    public function save_withdrawal_encashment_bycash($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_withdrawal_encashment_bycash]  ?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function save_withdrawal_encashment_bycheque($data_to_save)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_withdrawal_encashment_bycheque]  ?,?,?,?,?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function get_view_for_withdraw_data($apikey, $inst_id, $acd_year_id, $student_id, $master_id)
    {
        $data_to_save = array(
            $apikey,
            $inst_id,
            $acd_year_id,
            $student_id,
            $master_id
        );
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_view_for_withdraw_data]  ?,?,?,?,?", $data_to_save)->result_array();
        return $data;
    }

    public function get_voucher_data_for_cancellation($apikey, $student_id, $acd_year_id, $inst_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_voucher_data_to_cancel]  ?,?,?,?", array($apikey, $student_id, $acd_year_id, $inst_id))->result_array();
        return $data;
    }

    public function get_data_for_voucher_reprint($apikey, $student_id, $acd_year_id, $inst_id, $voucher_type)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_data_for_voucher_reprint]  ?,?,?,?,?", array($apikey, $student_id, $acd_year_id, $inst_id, $voucher_type))->result_array();
        return $data;
    }

    public function get_voucher_search_result($apikey, $inst_id, $voucher_type, $voucherno)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_voucher_search_result]  ?,?,?,?", array($apikey, $inst_id, $voucher_type, $voucherno))->result_array();
        return $data;
    }

    public function get_voucher_types($apikey, $inst_id, $type)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_voucher_types]  ?,?", array($apikey, $inst_id))->result_array();
        return $data;
    }
    public function get_voucher_data_for_cancellation_by_id($apikey, $voucher_id, $acd_year_id, $inst_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_voucher_data_to_cancel_by_voucher_id]  ?,?,?,?", array($apikey, $voucher_id, $acd_year_id, $inst_id))->result_array();
        return $data;
    }

    public function get_voucher_data_by_id_for_reprint($apikey, $voucher_id, $acd_year_id, $inst_id, $ptype = "")
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_voucher_data_by_id_for_reprint]  ?,?,?,?,?", array($apikey, $voucher_id, $acd_year_id, $inst_id, $ptype))->result_array();
        return $data;
    }
    public function save_voucher_cancel($apikey, $voucher_id, $acd_year_id, $inst_id, $student_id, $reason)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_voucher_cancel]  ?,?,?,?,?,?", array($apikey, $voucher_id, $acd_year_id, $inst_id, $student_id, $reason))->result_array();
        return $data;
    }
    public function save_wallet_voucher_cancel($apikey, $voucher_id, $acd_year_id, $inst_id, $student_id, $reason)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[save_wallet_voucher_cancel]  ?,?,?,?,?,?", array($apikey, $voucher_id, $acd_year_id, $inst_id, $student_id, $reason))->result_array();
        return $data;
    }

    public function get_counter_collectio_user_wise_data($apikey,  $inst_id, $acd_year_id, $user_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_counter_collection_data_user_wise_summary]  ?,?,?,?", array($apikey, $inst_id, $acd_year_id, $user_id))->result_array();
        return $data;
    }

    public function studentadvance_search_for_one_time($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_fees].[advanced_student_search_for_one_time_pay] ?,?,?,?,?,?,?", $dbparams)->result_array();
        return $studentdata;
    }

    public function save_collection_data_of_student_by_wallet_for_one_time($data_to_save)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_save);
        $data = $this->db->query("[docme_fees].[save_fee_collection_by_wallet_one_time]  $length", $data_to_save)->result_array();
        return $data;
    }

    public function get_term_as_monthly_data_of_student($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[get_term_as_monthly_data_of_student] $length", $data_to_db)->result_array();
        return $data;
    }

    //FEE EXEMPTION

    public function get_exemption_data_of_student($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[get_exemption_data_of_student] $length", $data_to_db)->result_array();
        return $data;
    }

    public function get_all_feecodes_available($apikey, $inst_id)
    {
        $this->db->flush_cache();
        //$length = procedure_param_string($data_to_db);
        $feecodes_available = $this->db->query("[docme_fees].[get_all_feecodes_available] ?,?", array($apikey, $inst_id))->result_array();
        return $feecodes_available;
    }
    public function get_exemption_requests($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $result_data = $this->db->query("[docme_fees].[get_exemptions_requests] $length", $data_to_db)->result_array();
        return $result_data;
    }
    public function get_exemption_details($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $result_data = $this->db->query("[docme_fees].[get_exemption_details] $length", $data_to_db)->result_array();
        return $result_data;
    }
    public function save_exemption_for_approval($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[save_exemption_for_approval]  $length", $data_to_db)->result_array();
        return $data;
    }
    public function save_exemption_wfm_for_md_approval($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[save_exemption_wfm_for_md_approval]  $length", $data_to_db)->result_array();
        return $data;
    }
    public function get_exemption_data_for_mis($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[get_exemption_data_for_mis]  $length", $data_to_db)->result_array();
        return $data;
    }
    public function get_exemption_demanding_details($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[get_exemption_demanding_details]  $length", $data_to_db)->result_array();
        return $data;
    }
    public function approve_exemption($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[approve_exemption]  $length", $data_to_db)->result_array();
        return $data;
    }
    public function reject_exemption($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[reject_exemption]  $length", $data_to_db)->result_array();
        return $data;
    }

    //MIS RESPONSE SAVE
    public function save_mis_response($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[save_mis_response] $length", $data_to_db)->result_array();
        return $data;
    }

    //Pay Prospectus Fee
    public function pay_registration_fee($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[pay_registration_fee]  $length", $data_to_db)->result_array();
        return $data;
    }
    //Pay Temp Registration Fee
    public function pay_temp_registration_fee($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[pay_temp_registration_fee]  $length", $data_to_db)->result_array();
        return $data;
    }
    //set_min_wallet_amount
    public function set_min_wallet_amount($data_to_db)
    {
        $this->db->flush_cache();
        $length = procedure_param_string($data_to_db);
        $data = $this->db->query("[docme_fees].[set_min_wallet_amount]  $length", $data_to_db)->result_array();
        return $data;
    }
    public function get_fees_demnaded_for_student($student_id, $inst_id, $acd_year_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_fees].[get_fees_demnaded_for_student]  ?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id))->result_array();
        return $data;
    }
}
