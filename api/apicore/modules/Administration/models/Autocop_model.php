<?php

/**
 * Description of Autocop_model
 *
 * @author Aju
 */
class Autocop_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function update_data_from_autocop($apikey, $data) {
        $this->db->flush_cache();
        $data = $this->db->query("[autocop_integration].[push_autocop_data] ?,?", array($apikey, $data))->result_array();
        return $data;
    }

}
