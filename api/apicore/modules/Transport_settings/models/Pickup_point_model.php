<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pickup_point_model
 *
 * @author chandrajith.edsys
 */
class Pickup_point_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_pickuppoint_details($apikey, $query, $fee_condition = 0)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            if ($fee_condition == 0)
                $route = $this->db->query("[docme_transport].[pickuppoint_select] ?,?,?", array(0, $apikey, $query))->result_array();
            else
                $route = $this->db->query("[docme_transport].[pickuppoint_select] ?,?,?", array(2, $apikey, $query))->result_array();
        } else {
            $route = $this->db->query("[docme_transport].[pickuppoint_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $route;
    }
    public function get_pickfee_details($dbparams)
    {
        $this->db->flush_cache();
        $this->db->flush_cache();
        if (is_array($dbparams)) {

            //            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[pickuppoint_fees_select] ?,?,?,?,?", $dbparams)->result_array();
            return $map_details;
        }
    }
    public function add_new_pickup_point($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $pickuppoint_save = $this->db->query("[docme_transport].[pickup_point_save] ?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($pickuppoint_save) && is_array($pickuppoint_save)) {
                return $pickuppoint_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Pickup Point not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Pickup Point not added. Please check the data and try again');
        }
    }
    public function update_pickuppoint($dbparams)
    {
        $this->db->flush_cache();
        //        dev_export($dbparams);die;
        if (is_array($dbparams)) {
            $pickuppoint_update = $this->db->query("[docme_transport].[pickuppoint_update] ?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            //            dev_export($pickuppoint_update);die;
            if (!empty($pickuppoint_update) && is_array($pickuppoint_update)) {
                return $pickuppoint_update[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Pickup Point not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Pickup Point not updated. Please check the data and try again');
        }
    }
}
