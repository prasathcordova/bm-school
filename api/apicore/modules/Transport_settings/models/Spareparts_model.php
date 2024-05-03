<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Spareparts_model
 *
 * @author chandrajith.edsys
 */
class Spareparts_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_parts_data($dbparams)
    {
        $this->db->flush_cache();
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $details = $this->db->query("[docme_transport].[parts_spare_select] ?,?", $dbparams)->result_array();
            return $details;
        }
    }

    public function add_new_spareparts($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $spareparts_save = $this->db->query("[docme_transport].[spares_save] ?,?,?,?", $dbparams)->result_array();
            if (!empty($spareparts_save) && is_array($spareparts_save)) {
                return $spareparts_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Fuel Log Details not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Fuel Log Details not added. Please check the data and try again');
        }
    }
    public function add_new_sparepart($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $spareparts_save = $this->db->query("[docme_transport].[spareparts_save] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($spareparts_save) && is_array($spareparts_save)) {
                return $spareparts_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Spart Part Details not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Spart Part Details not added. Please check the data and try again');
        }
    }
    public function update_sparepart_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $sparepart = $this->db->query("[docme_transport].[spareparts_update] ?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($sparepart) && is_array($sparepart)) {
                return $sparepart[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Sparepart not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Sparepart not updated. Please check the data and try again');
        }
    }
    public function add_new_sparepart_vehi($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $spareparts_save = $this->db->query("[docme_transport].[spareparts_vehicle_data_save] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($spareparts_save) && is_array($spareparts_save)) {
                return $spareparts_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Spart Part Details not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Spart Part Details not added. Please check the data and try again');
        }
    }
    public function get_parts_data_vehiclealloted($dbparams)
    {
        $this->db->flush_cache();
        $this->db->flush_cache();
        if (is_array($dbparams)) {

            //            dev_export($dbparams);die;
            $details = $this->db->query("[docme_transport].[vehicle_allotedparts_select] ?,?,?", $dbparams)->result_array();
            return $details;
        }
    }

    public function update_parts_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $veh_status = $this->db->query("[docme_transport].[spares_update] ?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($veh_status) && is_array($veh_status)) {
                return $veh_status[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle not updated. Please check the data and try again');
        }
    }

    public function get_parts_particular($dbparams)
    {
        $this->db->flush_cache();
        $map_details = $this->db->query("[docme_transport].[sparesparticular_select] ?,?", $dbparams)->result_array();
        return isset($map_details[0]) ? $map_details[0] : $map_details;
    }
}
