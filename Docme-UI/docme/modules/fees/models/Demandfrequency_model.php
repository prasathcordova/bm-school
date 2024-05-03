<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Demandfrequency_model
 *
 * @author chandrajith.edsys
 */
class Demandfrequency_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_demand_frequency_data($inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $demand_frequency = transport_data_with_param_with_urlencode(array('action' => 'get_demand_frequency', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
        if (isset($demand_frequency) && !empty($demand_frequency) && is_array($demand_frequency)) {
            return $demand_frequency['data'];
        } else {
            if (isset($demand_frequency['message']) && !empty($demand_frequency['message']) && is_array($demand_frequency)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $demand_frequency['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $demand_frequency,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_demand_frequency_data($demand_freq_id) {
        $apikey = $this->session->userdata('API-Key');
        $demand_frequency = transport_data_with_param_with_urlencode(array('action' => 'get_demand_frequency', 'id' => $demand_freq_id, 'mode' => 'strict'), $apikey);
        if (isset($demand_frequency) && !empty($demand_frequency) && is_array($demand_frequency)) {
            return $demand_frequency['data'];
        } else {
            if (isset($demand_frequency['message']) && !empty($demand_frequency['message']) && is_array($demand_frequency)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $demand_frequency['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_type,
                    'data' => FALSE
                );
            }
        }
    }

    public function update_demand_frequency_type($demand_freq_id, $inst_id, $status) {
        $apikey = $this->session->userdata('API-Key');
        $demand_frequency = transport_data_with_param_with_urlencode(array('action' => 'modify_demand_frequency_status', 'id' => $demand_freq_id, 'inst_id' => $inst_id, 'status' => $status), $apikey);

        if (isset($demand_frequency) && !empty($demand_frequency) && is_array($demand_frequency)) {
            return $demand_frequency['data'];
        } else {
            if (isset($demand_frequency['message']) && !empty($demand_frequency['message']) && is_array($demand_frequency)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $demand_frequency['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $demand_frequency,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_demand_frequency_edit($demand_freq_id, $freq_name,$span_month,$is_recurring,$inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $demand_frequency = transport_data_with_param_with_urlencode(array(
            'action' => 'update_demand_frequency', 
            'id' => $demand_freq_id, 
            'frequencyName' => $freq_name, 
            'monthSpan' => $span_month,
            'inst_id' => $inst_id,
            'is_recurring' => $is_recurring
                ), $apikey);
        if (isset($demand_frequency) && !empty($demand_frequency) && is_array($demand_frequency)) {
            return $demand_frequency['data'];
        } else {
            if (isset($demand_frequency['message']) && !empty($demand_frequency['message']) && is_array($demand_frequency)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $demand_frequency['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $demand_frequency,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_demand_frequency_new($name,$type,$month_span) {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
       
        $freq_data = transport_data_with_param_with_urlencode(
                array(
                    'action' => 'save_demand_frequency', 
                    'frequency_name' => $name, 
                    'monthSpan' => $month_span,
                    'is_recurring' => $type,
                    'inst_id' => $inst_id
                ), $apikey);
      
        if (isset($freq_data) && !empty($freq_data) && is_array($freq_data)) {
            return $freq_data['data'];
        } else {
            if (isset($freq_data['message']) && !empty($freq_data['message']) && is_array($freq_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $freq_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $freq_data,
                    'data' => FALSE
                );
            }
        }
    }

}
