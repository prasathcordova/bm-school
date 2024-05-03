<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Purchase_model
 *
 * @author chandrajith.edsys
 */
class Purchase_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_purchase_list() {
        $apikey = $this->session->userdata('API-Key');
        $purchase_data = transport_data_with_param_with_urlencode(array('action' => 'get_all_purchase_list'), $apikey);
        if (is_array($purchase_data)) {
            return $purchase_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $purchase_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_item_list() {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode(array('action' => 'show_items_master', 'status' => 1), $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['message'])) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $item_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $item_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_purchase_details($purchaseid) {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'get_purchase_details_for_receive',
            'purchase_id' => $purchaseid
        );
        $purchase_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($purchase_data) && isset($purchase_data['status']) && $purchase_data['status'] == 1) {
            return $purchase_data['data'];
        } else {
            if (isset($purchase_data['message'])) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $purchase_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $purchase_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_item_list_search($data) {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['message'])) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $item_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $item_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_direct_purchase($data_prep) {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }

    public function save_purchase_order($data_prep) {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }

    public function get_direct_purchase_approve_list_data($purchase_id) {
        $apikey = $this->session->userdata('API-Key');
        $data = array(
            'action' => 'get_purchase_approval_data',
            'purchase_id' => $purchase_id
        );
        $item_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }

    public function save_purchase_approval($data_prep, $purchase_type_id) {       
        $apikey = $this->session->userdata('API-Key');
        if ($purchase_type_id == 1) {
            $data_prep['action'] = 'Approve_direct_purchase';
        } else {
            $data_prep['action'] = 'approve_purchase';
        }
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }
    public function approve_purchase_return($return_id, $status, $comments) {       
        $apikey = $this->session->userdata('API-Key');
        $data_prep =array(
            'return_id' => $return_id,
            'status' => $status,
            'comments' => $comments,
            'action' => 'approve_purchase_return'
        );
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
//        dev_export($item_data);die;
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data);
            }
        }
    }
    public function delete_purchase($data_prep) {
        $apikey = $this->session->userdata('API-Key');       
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }
    public function delete_returnpurchase($data_prep) {
        $apikey = $this->session->userdata('API-Key');       
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }

    public function get_all_suppliers_list() {
        $apikey = $this->session->userdata('API-Key');
        $suppliers_data = transport_data_with_param_with_urlencode(array('action' => 'get_suppliers'), $apikey);
        if (is_array($suppliers_data)) {
//            dev_export($suppliers_data);die;
            return $suppliers_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $suppliers_data,
                'data' => FALSE
            );
        }
    }

    public function save_purchse_receive($data) {
        $apikey = $this->session->userdata('API-Key');
        $purchase_receive = transport_data_with_param_with_urlencode($data, $apikey);
//        dev_export($purchase_receive);die;
        if (isset($purchase_receive) && !empty($purchase_receive) && isset($purchase_receive['status']) && $purchase_receive['status'] == 1) {
            return $purchase_receive['data'];
        } else {
            if (isset($purchase_receive['message']) && !empty($purchase_receive['message'])) {
                return array('data_status' => 0, 'message' => $purchase_receive['message']);
            } else {
                return array('data_status' => 0);
            }
        }
    }

    public function save_purchase_edit($data) {
        $apikey = $this->session->userdata('API-Key');
        $purchase_receive = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($purchase_receive) && !empty($purchase_receive) && isset($purchase_receive['status']) && $purchase_receive['status'] == 1) {
            return $purchase_receive['data'];
        } else {
            if (isset($purchase_receive['message']) && !empty($purchase_receive['message'])) {
                return array('data_status' => 0, 'message' => $purchase_receive['message']);
            } else {
                return array('data_status' => 0);
            }
        }
    }
    public function get_purchase_return_list() {
        $apikey = $this->session->userdata('API-Key');
        $data = array(
            'action' => 'get_purchase_return'            
        );
        $purchase_return = transport_data_with_param_with_urlencode($data, $apikey);       
        if (isset($purchase_return) && !empty($purchase_return) && isset($purchase_return['status']) && $purchase_return['status'] == 1) {            
            return $purchase_return['data'];
        } else {
            if (isset($purchase_receive['message']) && !empty($purchase_receive['message'])) {
                return array('data_status' => 0, 'message' => $purchase_receive['message']);
            } else {
                return array('data_status' => 0);
            }
        }
    }
    public function get_return_data_view($return_id) {
        $apikey = $this->session->userdata('API-Key');
        $data = array(
            'action' => 'get_purchase_return_byid',
            'return_id' => $return_id            
        );
        $purchase_return = transport_data_with_param_with_urlencode($data, $apikey);       
        if (isset($purchase_return) && !empty($purchase_return) && isset($purchase_return['status']) && $purchase_return['status'] == 1) {            
            return $purchase_return['data'];
        } else {
            if (isset($purchase_receive['message']) && !empty($purchase_receive['message'])) {
                return array('data_status' => 0, 'message' => $purchase_receive['message']);
            } else {
                return array('data_status' => 0);
            }
        }
    }
}
