<?php


/**
 * Description of Profession_model
 *
 * @author chandrajith.edsys
 */
class Profession_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_profession_list($apikey, $query)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $profession = $this->db->query("[settings].[profession_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $profession = $this->db->query("[settings].[profession_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $profession;
    }
    public function add_new_profession($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $language = $this->db->query("[settings].[profession_save] ?,?,?", $dbparams)->result_array();
            if (!empty($language) && is_array($language)) {
                return $language[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Profession not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Profession not added. Please check the data and try again');
        }
    }
    public function update_profession_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $profession = $this->db->query("[settings].[profession_update] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($profession) && is_array($profession)) {
                return $profession[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Profession not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Profession not updated. Please check the data and try again');
        }
    }
}
