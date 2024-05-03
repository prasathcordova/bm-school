<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicetype_model
 *
 * @author Chandrajith
 */
class Servicetype_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getservice_types($dbparams)
    {
        $this->db->flush_cache();
        $this->db->flush_cache();
        if (is_array($dbparams)) {

            //            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[service_type_select] ?,?", $dbparams)->result_array();
            return $map_details;
        }
    }
    public function add_new_servicetype($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $servicecenter_save = $this->db->query("[docme_transport].[service_type_save] ?,?,? ", $dbparams)->result_array();
            if (!empty($servicecenter_save) && is_array($servicecenter_save)) {
                return $servicecenter_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Service Type Details not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'service Type Details  not added. Please check the data and try again');
        }
    }

    public function get_servicetype_particular($dbparams)
    {
        $this->db->flush_cache();
        $map_details = $this->db->query("[docme_transport].[servicetype_select] ?,?", $dbparams)->result_array();
        return isset($map_details[0]) ? $map_details[0] : $map_details;
    }
}
