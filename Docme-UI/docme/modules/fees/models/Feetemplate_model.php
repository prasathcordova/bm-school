<?php

/**
 * Description of Fee template_model
 *
 * @author chandrajith.edsys
 */
class Feetemplate_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_available_template($inst_id, $cur_acd_id) {
        $apikey = $this->session->userdata('API-Key');
        $templates = transport_data_with_param_with_urlencode(
                array(
            'action' => 'get_fee_template',
            'inst_id' => $inst_id,
            'mode' => 'strict',
            'acd_year_id' => $cur_acd_id
                ), $apikey
        );
        if (isset($templates['status']) && !empty($templates['status']) && is_array($templates) && $templates['status'] == true) {
            return $templates['data'];
        } else {
            if (isset($templates['message']) && !empty($templates['message']) && is_array($templates)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $templates['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $templates,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_class() {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $class_data = transport_data_with_param_with_urlencode(array('action' => 'get_class', 'status' => 1,'inst_id' => $inst_id), $apikey);
        if (is_array($class_data)) {
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

    public function save_fee_template($data) {
        $apikey = $this->session->userdata('API-Key');
        $template = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($template) && !empty($template) && is_array($template)) {
            return $template['data'];
        } else {
            if (isset($template['message']) && !empty($template['message']) && is_array($template)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $template['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $template,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_template_for_edit($template_id, $inst_id, $acd_year_id) {
        $apikey = $this->session->userdata('API-Key');
        $templates = transport_data_with_param_with_urlencode(
                array(
            'action' => 'get_fee_template',
            'id' => $template_id,
            'inst_id' => $inst_id,
            'mode' => 'strict',
            'acd_year_id' => $acd_year_id
                ), $apikey
        );

        if (isset($templates['status']) && !empty($templates['status']) && is_array($templates) && $templates['status'] == true) {
            return $templates['data'];
        } else {
            if (isset($templates['message']) && !empty($templates['message']) && is_array($templates)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $templates['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $templates,
                    'data' => FALSE
                );
            }
        }
    }

    public function delete_template($template_id) {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $template = transport_data_with_param_with_urlencode(array(
            'action' => 'delete_fee_template',
            'template_id' => $template_id,
            'inst_id' => $inst_id
                ), $apikey);
        if (isset($template) && !empty($template) && is_array($template)) {            
            if ($template['status'] === 'Invalid action name.') {                
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => 'An error encountered with server. Please contact administrator for further assistance',
                    'data' => FALSE
                );
            } else {
                return $template['data'];
            }
        } else {
            if (isset($template['message']) && !empty($template['message']) && is_array($template)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $template['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $template,
                    'data' => FALSE
                );
            }
        }
    }

}
