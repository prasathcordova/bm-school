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
class Spareparts_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_spares_details($inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $spareparts_data = transport_data_with_param_with_urlencode(array('action' => 'get_spareparts','inst_id' => $inst_id), $apikey);
      
        if (isset($spareparts_data) && !empty($spareparts_data) && is_array($spareparts_data)) {
            return $spareparts_data['data'];
        } else {
            if (isset($spareparts_data['message']) && !empty($spareparts_data['message']) && is_array($spareparts_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $spareparts_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $spareparts_data,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_part_new($partname, $description, $partnumber) {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        
        $spareparts_status = transport_data_with_param_with_urlencode(array('action' => 'save_parts_spare',
            'partname'=> $partname,
            'description'=> $description,
            'partnumber'=> $partnumber
           ), $apikey);
        if (isset($spareparts_status) && !empty($spareparts_status) && is_array($spareparts_status)) {
            return $spareparts_status['data'];
        } else {
            if (isset($spareparts_status['message']) && !empty($spareparts_status['message']) && is_array($spareparts_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => $spareparts_status['error_status'],
                    'message' => $spareparts_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $spareparts_status,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_sparepart($partname,$desc,$partnumber) {
        $apikey = $this->session->userdata('API-Key');
         $inst_id = $this->session->userdata('inst_id');     
//          dev_export($incidents_data);die;
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_spare_part', 'partName' => $partname,'partdesc' => $desc,'partnum' => $partnumber,'inst_id'=>$inst_id), $apikey);        
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
public function edit_status_parts($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_parts_status';
        $parts_status = transport_data_with_param_with_urlencode($data, $apikey);        
        if (is_array($parts_status) && $parts_status['status'] == 1) {
            if (is_array($parts_status['data']) && $parts_status['data']['error_status'] == 0) {
                if ($parts_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $parts_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $parts_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
    public function select_part_spare($partid){
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data = array('action' => 'select_parts_for_edit',
                      'partid' => $partid);
        $parts_edit_status = transport_data_with_param_with_urlencode($data, $apikey);        
        if (isset($parts_edit_status) && !empty($parts_edit_status) && is_array($parts_edit_status)) {
            return $parts_edit_status['data'];
        } else {
            if (isset($parts_edit_status['message']) && !empty($parts_edit_status['message']) && is_array($parts_edit_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $parts_edit_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $parts_edit_status,
                    'data' => FALSE
                );
            }
            
        }
    }
    public function save_edit_part_new($partname,$desc,$partnumber,$id) {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');     
        $status_data = transport_data_with_param_with_urlencode(
                                array('action'      => 'update_spareparts',
                                        'id'        => $id,
                                      'name'    => $partname,
                                      'desc'    => $desc,
                                      'num'     => $partnumber), $apikey);        
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
            
}
