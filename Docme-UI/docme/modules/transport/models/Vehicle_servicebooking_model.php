<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicle_servicebooking_model
 *
 * @author chandrajith.edsys
 */
class Vehicle_servicebooking_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_vehicle_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle = transport_data_with_param_with_urlencode(array('action' => 'get_vehiclereg', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
        //        dev_export($vehicle);die;
        if (isset($vehicle) && !empty($vehicle) && is_array($vehicle)) {
            return $vehicle['data'];
        } else {
            if (isset($vehicle['message']) && !empty($vehicle['message']) && is_array($vehicle)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_service_vehicle_list($vehicle_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle = transport_data_with_param_with_urlencode(array('action' => 'get_servicebooked_vehicle', 'vehicle_id' => $vehicle_id, 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);

        if (isset($vehicle) && !empty($vehicle) && is_array($vehicle)) {
            return $vehicle['data'];
        } else {
            if (isset($vehicle['message']) && !empty($vehicle['message']) && is_array($vehicle)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle,
                    'data' => FALSE
                );
            }
        }
    }

    public function chk_isvehicle_service($vehicle_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle = transport_data_with_param_with_urlencode(array('action' => 'checking_servicebooked_vehicle', 'vehicle_id' => $vehicle_id, 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);

        if (isset($vehicle) && !empty($vehicle) && is_array($vehicle)) {
            return $vehicle['data'];
        } else {
            if (isset($vehicle['message']) && !empty($vehicle['message']) && is_array($vehicle)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_servicebook_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $servicebook_details = transport_data_with_param_with_urlencode(array('action' => 'get_vehicleservicebooking_details', 'inst_id' => $inst_id), $apikey);
        if (isset($servicebook_details) && !empty($servicebook_details) && is_array($servicebook_details)) {
            return $servicebook_details['data'];
        } else {
            if (isset($servicebook_details['message']) && !empty($servicebook_details['message']) && is_array($servicebook_details)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $servicebook_details['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $servicebook_details,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_invoice_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $servicebook_details = transport_data_with_param_with_urlencode(array('action' => 'get_vehicle_invoice_details', 'inst_id' => $inst_id), $apikey);
        if (isset($servicebook_details) && !empty($servicebook_details) && is_array($servicebook_details)) {
            return $servicebook_details['data'];
        } else {
            if (isset($servicebook_details['message']) && !empty($servicebook_details['message']) && is_array($servicebook_details)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $servicebook_details['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $servicebook_details,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_vehicle_invoice_data($vehicle_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $servicebook_details = transport_data_with_param_with_urlencode(array('action' => 'get_particular_vehicle_invoice_details', 'vehicle_id' => $vehicle_id, 'inst_id' => $inst_id), $apikey);
        if (isset($servicebook_details) && !empty($servicebook_details) && is_array($servicebook_details)) {
            return $servicebook_details['data'];
        } else {
            if (isset($servicebook_details['message']) && !empty($servicebook_details['message']) && is_array($servicebook_details)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $servicebook_details['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $servicebook_details,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_vehicles()
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_details = transport_data_with_param_with_urlencode(array('action' => 'get_vehiclereg', 'mode' => 'strict'), $apikey);
        if (isset($vehicle_details) && !empty($vehicle_details) && is_array($vehicle_details)) {
            return $vehicle_details['data'];
        } else {
            if (isset($vehicle_details['message']) && !empty($vehicle_details['message']) && is_array($vehicle_details)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_details['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_details,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_vehicle_servicecenter($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_servicecenter = transport_data_with_param_with_urlencode(array('action' => 'get_servicecenter', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);

        if (isset($vehicle_servicecenter) && !empty($vehicle_servicecenter) && is_array($vehicle_servicecenter)) {
            return $vehicle_servicecenter['data'];
        } else {
            if (isset($vehicle_servicecenter['message']) && !empty($vehicle_servicecenter['message']) && is_array($vehicle_servicecenter)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_servicecenter['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_servicecenter,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_vehicle_servicetypes($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_servicetypes = transport_data_with_param_with_urlencode(array('action' => 'get_service_type', 'inst_id' => $inst_id), $apikey);

        if (isset($vehicle_servicetypes) && !empty($vehicle_servicetypes) && is_array($vehicle_servicetypes)) {
            return $vehicle_servicetypes['data'];
        } else {
            if (isset($vehicle_servicetypes['message']) && !empty($vehicle_servicetypes['message']) && is_array($vehicle_servicetypes)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_servicetypes['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_servicetypes,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_service_booking($booking_data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        //          dev_export($booking_data);die;
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_service_booking', 'servicebooking_data' => $booking_data, 'inst_id' => $inst_id), $apikey);

        //        dev_export($status_data);die;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }
    public function save_service_invoice($invoice_data, $spar_data, $acessorie_data, $miscellaneous_data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        //          dev_export($booking_data);die;
        $status_data = transport_data_with_param_with_urlencode(array(
            'action' => 'save_service_invoice',
            'serviceinvoice_data' => $invoice_data,
            'spare_data' => $spar_data,
            'acessorie_data' => $acessorie_data,
            'miscellaneous_data' => $miscellaneous_data,
            // 'invoice_date' => $invoice_date, 
            // 'delivery_date' => $delivery_date, 
            // 'service_date' => $service_date, 
            'inst_id' => $inst_id
        ), $apikey);
        // dev_export($status_data);
        // return;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }
    public function get_vehicle_invoice($vehicle_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle = transport_data_with_param_with_urlencode(array('action' => 'get_vehicle_invoice_history', 'vehicle_id' => $vehicle_id, 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);

        if (isset($vehicle) && !empty($vehicle) && is_array($vehicle)) {
            return $vehicle['data'];
        } else {
            if (isset($vehicle['message']) && !empty($vehicle['message']) && is_array($vehicle)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_vehicle_service($vehicle_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle = transport_data_with_param_with_urlencode(array('action' => 'get_vehicle_service_history', 'vehicle_id' => $vehicle_id, 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);

        if (isset($vehicle) && !empty($vehicle) && is_array($vehicle)) {
            return $vehicle['data'];
        } else {
            if (isset($vehicle['message']) && !empty($vehicle['message']) && is_array($vehicle)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle,
                    'data' => FALSE
                );
            }
        }
    }
}
