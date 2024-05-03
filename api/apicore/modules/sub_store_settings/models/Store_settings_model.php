<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Store_settings_model
 *
 * @author saranya.kumar
 */
class Store_settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_storeSettings_details($apikey) {
        $this->db->flush_cache();
        $count = $this->db->query("[docme_bookstore].[store_settings_substore] ?", $apikey)->result_array();
        return $count;
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

}
