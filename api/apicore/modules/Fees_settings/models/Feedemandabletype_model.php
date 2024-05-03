<?php

/**
 * Description of Fee demandable type_model
 *
 * @author aju.docme
 */
class Feedemandabletype_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_demand_type_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $fee_code = $this->db->query("[docme_fees].[demand_type_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $fee_code = $this->db->query("[docme_fees].[demand_type_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $fee_code;
    }
}
