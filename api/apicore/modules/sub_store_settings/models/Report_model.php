<?php

/**
 * Description of Report_model
 *
 * @author aju.docme
 */
class Report_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_sale_return_raw_data($apikey, $storeid, $start_date, $end_date, $type)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_sale_return_data_report] ?,?,?,?,?", array($apikey, $storeid, $start_date, $end_date, $type))->result_array();
        return $data;
    }

    public function get_sale_voucher_wise_raw_data($apikey, $storeid, $start_date, $end_date)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_sale_voucher_data_report] ?,?,?,?", array($apikey, $storeid, $start_date, $end_date))->result_array();
        return $data;
    }

    public function get_sale_item_wise_raw_data($apikey, $storeid, $start_date, $end_date, $type)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_sale_item_data_report] ?,?,?,?,?", array($apikey, $storeid, $start_date, $end_date, $type))->result_array();
        return $data;
    }

    public function get_sale_item_wise_summary_raw_data($apikey, $storeid, $start_date, $end_date, $type)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_sale_item_summary_data_report] ?,?,?,?,?", array($apikey, $storeid, $start_date, $end_date, $type))->result_array();
        return $data;
    }

    public function get_billed_but_not_delivered_item_wise_summary_raw_data($apikey, $storeid, $start_date, $end_date)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_item_wise_billed_but_not_delivered] ?,?,?,?", array($apikey, $storeid, $start_date, $end_date))->result_array();
        return $data;
    }

    public function get_collection_report_data($apikey, $storeid, $start_date, $end_date, $type = NULL)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_collection_report] ?,?,?,?,?", array($apikey, $storeid, $start_date, $end_date, $type))->result_array();
        return $data;
    }

    public function get_collection_report_user_wise_data($apikey, $storeid, $start_date, $end_date)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_collection_report_user_wise] ?,?,?,?", array($apikey, $storeid, $start_date, $end_date))->result_array();
        return $data;
    }

    public function get_summary_collection_report_user_wise_data($apikey, $storeid, $start_date, $end_date)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_bookstore].[get_summarycollection_report_user_wise] ?,?,?,?", array($apikey, $storeid, $start_date, $end_date))->result_array();
        return $data;
    }

    public function opening_stock_data($storeid, $from_date, $apikey)
    {
        $this->db->flush_cache();
        $stock = $this->db->query("[docme_bookstore].[stock_report_builder] ?,?,?,?", array($apikey, 2, $storeid, $from_date))->result_array();
        return $stock;
    }

    public function stock_data($storeid, $from_date, $todate, $apikey)
    {
        $this->db->flush_cache();
        $stock = $this->db->query("[docme_bookstore].[stock_report_builder] ?,?,?,?,?", array($apikey, 1, $storeid, $from_date, $todate))->result_array();
        return $stock;
    }

    public function get_sale_data($storeid, $from_date, $todate, $apikey)
    {
        $this->db->flush_cache();
        $stock = $this->db->query("[docme_bookstore].[sale_report_builder] ?,?,?,?,?", array($apikey, 1, $storeid, $from_date, $todate))->result_array();
        return $stock;
    }

    public function get_sale_return_data($storeid, $from_date, $todate, $apikey)
    {
        $this->db->flush_cache();
        $stock = $this->db->query("[docme_bookstore].[sale_return_report_builder] ?,?,?,?,?", array($apikey, 1, $storeid, $from_date, $todate))->result_array();
        return $stock;
    }

    public function get_specimen_issue_data($storeid, $from_date, $todate, $apikey)
    {
        $this->db->flush_cache();
        $stock = $this->db->query("[docme_bookstore].[specimen_issue_report_builder] ?,?,?,?,?", array($apikey, 1, $storeid, $from_date, $todate))->result_array();
        return $stock;
    }

    public function get_specimen_return_data($storeid, $from_date, $todate, $apikey)
    {
        $this->db->flush_cache();
        $stock = $this->db->query("[docme_bookstore].[specimen_return_report_builder] ?,?,?,?,?", array($apikey, 1, $storeid, $from_date, $todate))->result_array();
        return $stock;
    }

    public function get_item_details($apikey, $query, $count = -1)
    {
        if ($count == -1) {
            $count = ITEM_SEARCH_DEFAULT_DISPLAY_COUNT;
        }

        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $country = $this->db->query("[docme_bookstore].[items_select] ?,?,?,?", array(0, $apikey, $query, $count))->result_array();
        } else {
            $country = $this->db->query("[docme_bookstore].[items_select] ?,?,?,?", array(1, $apikey, NULL, $count))->result_array();
        }
        return $country;
    }
}
