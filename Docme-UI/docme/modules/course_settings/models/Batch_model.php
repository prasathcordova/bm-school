<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Batch_model
 *
 * @author chandrajith.edsys
 */
class Batch_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_batch_list()
    {
        $apikey = $this->session->userdata('API-Key');
        $batch_data = transport_data_with_param_with_urlencode(array('action' => 'get_batch'), $apikey);
        if (is_array($batch_data)) {
            return $batch_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_medium_list()
    {
        $apikey = $this->session->userdata('API-Key');
        $medium_data = transport_data_with_param_with_urlencode(array('action' => 'get_medium'), $apikey);
        if (is_array($medium_data)) {
            return $medium_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $medium_data,
                'data' => FALSE
            );
        }
    }


    public function get_all_acadyr()
    {
        $apikey = $this->session->userdata('API-Key');
        $acd_data = transport_data_with_param_with_urlencode(array('action' => 'get_acdyear', 'status' => 1), $apikey);
        if (is_array($acd_data)) {
            //            dev_export($acd_data);die;
            return $acd_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acd_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_stream()
    {
        $apikey = $this->session->userdata('API-Key');
        $stream_data = transport_data_with_param_with_urlencode(array('action' => 'get_stream', 'status' => 1), $apikey);
        if (is_array($stream_data)) {
            //            dev_export($acd_data);die;
            return $stream_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $stream_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_class()
    {
        $apikey = $this->session->userdata('API-Key');
        $class_data = transport_data_with_param_with_urlencode(array('action' => 'get_class'), $apikey);
        if (is_array($class_data)) {
            //            dev_export($acd_data);die;
            return $class_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $class_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_session()
    {
        $apikey = $this->session->userdata('API-Key');
        $session_data = transport_data_with_param_with_urlencode(array('action' => 'get_session'), $apikey);
        if (is_array($session_data)) {
            //            dev_export($acd_data);die;
            return $session_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $session_data,
                'data' => FALSE
            );
        }
    }

    public function get_batch_details($BatchID)
    {
        $apikey = $this->session->userdata('API-Key');
        $batch_data = transport_data_with_param_with_urlencode(array('action' => 'get_batch', 'BatchID' => $BatchID), $apikey);
        if (is_array($batch_data)) {
            return $batch_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch_data,
                'data' => FALSE
            );
        }
    }

    public function save_batch($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_batch';
        $batch_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($batch_status) ;die;
        if (is_array($batch_status) && $batch_status['status'] == 1) {
            if (is_array($batch_status['data']) && $batch_status['data']['error_status'] == 0) {
                if ($batch_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved', 'Batch_name' => $batch_status['data']['data']['Batch_Name']);
                } else {
                    return array('status' => 0, 'message' => $batch_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $batch_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function edit_status_batch($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_batch_status';
        //        dev_export($data);die;
        $batch_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($batch_status);die;
        if (is_array($batch_status) && $batch_status['status'] == 1) {
            if (is_array($batch_status['data']) && $batch_status['data']['error_status'] == 0) {
                if ($batch_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $batch_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' =>  $batch_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function edit_save_batch($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_batch';
        $batch_status = transport_data_with_param_with_urlencode($data, $apikey);
                
        if (is_array($batch_status) && $batch_status['status'] == 1) {
            if (is_array($batch_status['data']) && $batch_status['data']['error_status'] == 0) {
                if ($batch_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved', 'Batch_name' => $batch_status['data']['data']['batch_name']);
                } else {
                    return array('status' => 0, 'message' => $batch_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => $batch_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
