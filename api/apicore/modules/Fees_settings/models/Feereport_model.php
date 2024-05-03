<?php

/**
 * Description of Feereport_model
 *
 * @author Aju
 */
class Feereport_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_collection_voucher_wise_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $user_wise_report)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[fee_voucher_wise_collection_report] ?,?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $user_wise_report))->result_array();
        return $report_data;
    }
    public function get_regfee_collection_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_regfee_collection_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }
    public function get_base_fee_educore_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_base_fee_educore_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }

    public function get_online_collection_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_online_collection_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }
    public function get_fee_deallocated_list($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_fee_deallocated_list] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }



    public function get_received_non_demandable_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $user_wise_report)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[fee_received_non_demanded_report] ?,?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $user_wise_report))->result_array();
        return $report_data;
    }

    public function get_individual_collection_with_voucher_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $student_id, $include_transfer)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[fee_voucher_and_student_wise_collection_report] ?,?,?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $student_id, $include_transfer))->result_array();
        return $report_data;
    }
    public function get_individual_cheque_collection_with_voucher_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $student_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[fee_cheque_to_reconcile_data_of_a_student] ?,?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $student_id))->result_array();
        return $report_data;
    }

    public function get_collection_class_wise_summary_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[fee_collection_class_wise_summary_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }

    public function get_collection_class_wise_details_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[fee_collection_class_wise_detail_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }

    public function get_collection_user_wise_details_data($apikey, $inst_id, $acd_year_id, $from_date, $user_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[fee_collection_user_wise_detail_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $user_id))->result_array();
        return $report_data;
    }

    public function get_collection_user_wise_payment_modes_data($apikey)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[fee_collection_user_wise_payment_modes] ?", array($apikey))->result_array();
        return $report_data;
    }

    public function get_cheque_received_ledger_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[fee_cheque_received_ledger_data] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }

    public function get_vat_collection_details($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[vat_collection_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }

    public function get_voucher_cancellation_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[voucher_cancellation_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }

    public function get_wallet_deposit_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[wallet_deposit_details_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }
    public function get_wallet_withdraw_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[wallet_withdraw_details_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }

    public function get_wallet_statement_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[wallet_statement_details_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }

    public function get_dcb_report_with_student($apikey, $inst_id, $acd_year_id, $student_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[individual_dcb_report_for_student] ?,?,?,?", array($apikey, $inst_id, $acd_year_id, $student_id))->result_array();
        return $report_data;
    }
    public function get_students_with_batch_for_dcb_report($apikey, $inst_id, $acd_year_id, $batch_id, $class_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_student_list_from_batch_for_dcb_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $batch_id, $class_id))->result_array();
        return $report_data;
    }
    public function batch_wise_dcb_report($apikey, $inst_id, $acd_year_id, $batch_id, $class_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[batch_wise_dcb_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $batch_id, $class_id))->result_array();
        return $report_data;
    }

    public function get_student_data_for_report($apikey, $student_id, $inst_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[student_data_for_report] ?,?,?", array($apikey, $inst_id, $student_id))->result_array();
        return $report_data;
    }

    public function get_headwise_data_for_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $feecode_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_headwise_collection_report] ?,?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $feecode_id))->result_array();
        return $report_data;
    }

    public function get_all_feecodes_available($apikey, $inst_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_feecodes_for_report] ?,?", array($apikey, $inst_id))->result_array();
        return $report_data;
    }
    public function get_all_demandable_feecodes_available($apikey, $inst_id, $ftypes = '')
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_all_feecodes_demandable] ?,?,?", array($apikey, $inst_id, $ftypes))->result_array();
        return $report_data;
    }
    public function get_all_feecodes_non_demandable($apikey, $inst_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_all_feecodes_non_demandable] ?,?", array($apikey, $inst_id))->result_array();
        return $report_data;
    }
    public function get_summary_collection_data_for_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_summary_collection_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }

    public function get_online_pay_data_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[online_pay_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }
    public function get_payback_data_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_data_for_payback_summary] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }
    public function get_payback_data_report_pending_reject($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_payback_data_report_pending_reject] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }
    public function get_prospectus_data_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_prospectus_data_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }
    public function get_exemption_data_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_exemption_data_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }
    public function get_concession_students_report($apikey, $inst_id, $acd_year_id, $concession_type)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_concession_students_report] ?,?,?,?", array($apikey, $inst_id, $acd_year_id, $concession_type))->result_array();
        return $report_data;
    }
    public function get_fee_concession_details($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $concession_type)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_fee_concession_details] ?,?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $concession_type))->result_array();
        return $report_data;
    }
    public function get_voucher_collection_details($apikey, $inst_id, $acd_year_id, $from_date, $to_date)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_voucher_collection_details] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date))->result_array();
        return $report_data;
    }

    //TRNSPORT DUE LIST REPORT
    public function get_transport_due_list($apikey, $inst_id, $acd_year_id, $batch_id, $class_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[transport_due_list] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $batch_id, $class_id))->result_array();
        return $report_data;
    }

    //ARREAR REPORT
    public function get_report_data_for_arrear_list($apikey, $inst_id, $acd_year_id, $batch_id, $class_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_data_for_arrear_list_with_batch_report] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $batch_id, $class_id))->result_array();
        return $report_data;
    }
    public function get_long_absentee_arrear_list($apikey, $inst_id, $acd_year_id, $batch_id, $class_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_data_for_arrear_list_with_log_absentee_student] ?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $batch_id, $class_id))->result_array();
        return $report_data;
    }
    public function get_arrear_summary($apikey, $inst_id, $acd_year_id, $startdate, $backdate)
    {
        $this->db->flush_cache();
        if ($backdate == 1)
            $report_data = $this->db->query("[docme_fees].[get_back_date_arrear_summary] ?,?,?,?", array($apikey, $inst_id, $acd_year_id, $startdate))->result_array();
        else
            $report_data = $this->db->query("[docme_fees].[get_arrear_summary] ?,?,?,?", array($apikey, $inst_id, $acd_year_id, $startdate))->result_array();
        return $report_data;
    }
    public function get_head_wise_arrear($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $feecode_id)
    {
        $this->db->flush_cache();
        $report_data = $this->db->query("[docme_fees].[get_head_wise_arrear] ?,?,?,?,?,?", array($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $feecode_id))->result_array();
        return $report_data;
    }

    public function get_student_search_list_for_reports($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_fees].[get_student_search_list] ?,?,?", $dbparams)->result_array();
        // dev_export($studentdata);die;
        return $studentdata;
    }
    public function get_advancestudent_search_list_for_reports($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_fees].[get_advancestudent_search_list] ?,?,?,?,?,?,?,?", $dbparams)->result_array();
        //dev_export($studentdata);die;
        return $studentdata;
    }
}
