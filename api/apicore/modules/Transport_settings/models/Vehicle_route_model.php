<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicle_route_model
 *
 * @author chandrajith.edsys
 */
class Vehicle_route_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_route_details($apikey, $query)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $route = $this->db->query("[docme_transport].[trip_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $route = $this->db->query("[docme_transport].[trip_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $route;
    }
    public function add_new_route($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            //            dev_export($dbparams);
            $route_save = $this->db->query("[docme_transport].[route_save] ?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($route_save) && is_array($route_save)) {
                return $route_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Route not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Route not added. Please check the data and try again');
        }
    }
    public function update_route($dbparams)
    {
        $this->db->flush_cache();
        //        dev_export($dbparams);die;
        if (is_array($dbparams)) {
            $route_update = $this->db->query("[docme_transport].[route_update] ?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($route_update) && is_array($route_update)) {
                return $route_update[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Route not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Route not updated. Please check the data and try again');
        }
    }
}
