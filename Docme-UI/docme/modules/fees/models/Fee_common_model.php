<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fee_common_model
 *
 * @author chandrajith.edsys
 */
class Fee_common_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function common_function_in_model($data_to_save)
    {
        $apikey = $this->session->userdata('API-Key');
        $link_status = transport_data_with_param_with_urlencode(
            $data_to_save,
            $apikey
        );
        if (is_array($link_status)) {
            return $link_status;
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $link_status,
                'data' => FALSE
            );
        }
        // if (isset($link_status['status']) && !empty($link_status['status']) && is_array($link_status) && $link_status['status'] == true) {
        //     return $link_status;//['data'];
        // } else {
        //     if (isset($link_status['message']) && !empty($link_status['message']) && is_array($link_status)) {
        //         return array(
        //             'status' => 0,
        //             'data_status' => 0,
        //             'error_status' => 1,
        //             'message' => $link_status['message'],
        //             'data' => FALSE
        //         );
        //     } else {
        //         return array(
        //             'status' => 0,
        //             'data_status' => 0,
        //             'error_status' => 1,
        //             'message' => $link_status,
        //             'data' => FALSE
        //         );
        //     }
        // }
    }
}
