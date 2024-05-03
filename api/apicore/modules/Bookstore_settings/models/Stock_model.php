<?php

/**
 * Description of Stock_model
 *
 * @author Aju
 */
class Stock_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_stock_list_for_allotment($apikey, $storeid) {
        $this->db->flush_cache();
        if ($storeid)
            $stock = $this->db->query("[docme_bookstore].[item_rate_select_store_with_stock] ?,?", array($apikey, $storeid))->result_array();
        else
            $stock = $this->db->query("[docme_bookstore].[item_rate_select_store_with_stock] ?", array($apikey))->result_array();
        return $stock;
    }
       public function get_stock_list_for_allotment_search($params) {
        $this->db->flush_cache();
        $stock = $this->db->query("[docme_bookstore].[search_item_rate_select_store_with_stock] ?,?,?,?,?,?", $params)->result_array();
        return $stock;
    }

    public function get_current_stock($apikey, $storeid) {
        $this->db->flush_cache();
        if ($storeid > 0) {
            $stock = $this->db->query("[docme_bookstore].[stock_select_report] ?,?,?", array(1, $apikey, $storeid))->result_array();
        } else {
            $stock = $this->db->query("[docme_bookstore].[stock_select_report] ?,?,?", array(0, $apikey, NULL))->result_array();
        }
        return $stock;
    }
    public function uniform_get_current_stock($apikey, $storeid) {
        $this->db->flush_cache();
        if ($storeid > 0) {
            $stock = $this->db->query("[docme_uniform_store].[stock_select_report] ?,?,?", array(1, $apikey, $storeid))->result_array();
        } else {
            $stock = $this->db->query("[docme_uniform_store].[stock_select_report] ?,?,?", array(0, $apikey, NULL))->result_array();
        }
        return $stock;
    }

    public function opening_stock_data($storeid, $from_date, $apikey) {
        $this->db->flush_cache();
        $stock = $this->db->query("[docme_bookstore].[stock_report_builder] ?,?,?,?", array($apikey, 2, $storeid, $from_date))->result_array();
        return $stock;
    }

    public function stock_data($storeid, $from_date, $todate, $apikey) {
        $this->db->flush_cache();
        $stock = $this->db->query("[docme_bookstore].[stock_report_builder] ?,?,?,?,?", array($apikey, 1, $storeid, $from_date, $todate))->result_array();
        return $stock;
    }

    public function get_report_lock_date($apikey) {
        $this->db->flush_cache();
        $lock_date = $this->db->query("[docme_bookstore].[stock_report_lock_date] ?", array($apikey))->result_array();
        return $lock_date;
    }

    public function get_stock_allotment_data($from_store, $to_store, $fromdate, $todate, $apikey) {
        $this->db->flush_cache();
        $allotment_data = $this->db->query('[docme_bookstore].[stock_report_builder_allotment_main] ?,?,?,?,?', array($apikey, $from_store, $to_store, $fromdate, $todate))->resul_array();
        return $allotment_data;
    }

}
