<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vehicleservicebooking_model
 *
 * @author chandrajith.edsys
 */
class Vehicleservicebooking_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_vehicleservice_booking($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_servicebooking = $this->db->query("[docme_transport].[vehicleservicebook__select] ?,?", $dbparams)->result_array();

            return $vehicle_servicebooking;
        }
    }
    public function get_vehicleservice_invoice($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_servicebooking = $this->db->query("[docme_transport].[vehicleInvoice__select] ?,?", $dbparams)->result_array();

            return $vehicle_servicebooking;
        }
    }
    public function get_vehicleservice_booked_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_servicebooking = $this->db->query("[docme_transport].[particularvehicleservice__select] ?,?,?", $dbparams)->result_array();

            return $vehicle_servicebooking;
        }
    }
    public function is_vehicle_service($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $is_vehicle_in_service = $this->db->query("[docme_transport].[vehiclechk_isservice_select] ?,?,?", $dbparams)->result_array();
            //            dev_export($is_vehicle_in_service);die;
            return $is_vehicle_in_service;
        }
    }
    public function get_vehicleservicedata_invoice($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_servicebooking = $this->db->query("[docme_transport].[particularvehicleInvoice__select] ?,?,?", $dbparams)->result_array();

            return $vehicle_servicebooking;
        }
    }
    public function get_vehicle_invoice_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_servicebooking = $this->db->query("[docme_transport].[particularvehicleInvoicehistory_select] ?,?,?", $dbparams)->result_array();

            return $vehicle_servicebooking;
        }
    }
    public function get_vehicle_service_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_servicebooking = $this->db->query("[docme_transport].[particularvehicleservicehistory_select] ?,?,?", $dbparams)->result_array();

            return $vehicle_servicebooking;
        }
    }
    public function add_servicebooking_details($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            //            dev_export($dbparams);die;
            $servicebooking_save = $this->db->query("[docme_transport].[vehicleservicedetails_Save] ?,?,?", $dbparams)->result_array();
            if (!empty($servicebooking_save) && is_array($servicebooking_save)) {
                return $servicebooking_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Service Booking not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Service Booking not added. Please check the data and try again');
        }
    }
    public function add_serviceinvoice_details($dbparams)
    {

        $this->db->flush_cache();
        if (is_array($dbparams)) {
            // return $dbparams;
            $servicebooking_save = $this->db->query("[docme_transport].[vehicleserviceinvoicedetails_Save] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($servicebooking_save) && is_array($servicebooking_save)) {
                return $servicebooking_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Service Invoice not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Service Invoice not added. Please check the data and try again');
        }
    }

    public function update_vehicleservice_booking($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_servicebooking_update = $this->db->query("[docme_transport].[vehicletype_update] ?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_servicebooking_update) && is_array($vehicle_servicebooking_update)) {
                return $vehicle_servicebooking_update[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle servicebooking not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle servicebooking not updated. Please check the data and try again');
        }
    }
}
