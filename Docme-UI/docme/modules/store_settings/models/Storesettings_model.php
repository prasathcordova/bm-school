<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Storesettings_model
 *
 * @author chandrajith.edsys
 */
class Storesettings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_country_list() {
        $apikey = $this->session->userdata('API-Key');
        $country_data = transport_data_with_param_with_urlencode(array('action' => 'get_countries'), $apikey);
        if (is_array($country_data)) {
//            dev_export($country_data);die;
            return $country_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $country_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_city_list() {
        $apikey = $this->session->userdata('API-Key');
        $city_data = transport_data_with_param_with_urlencode(array('action' => 'get_city'), $apikey);
        if (is_array($city_data)) {
            return $city_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $city_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_active_count() {
        $apikey = $this->session->userdata('API-Key');
        $count_data = transport_data_with_param_with_urlencode(array('action' => 'get_count'), $apikey);
        if (is_array($count_data)) {
//            dev_export($count_data);die;
            return $count_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $count_data,
                'data' => FALSE
            );
        }
    }

}
