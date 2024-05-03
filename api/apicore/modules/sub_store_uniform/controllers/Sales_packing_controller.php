<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales_packing_controller
 *
 * @author saranya.kumar
 */
class Sales_packing_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sales_packing_model', 'MSPacking');
    }

    public function save_packing_student($params) {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['final_format_data']) && !empty($params['final_format_data'])) {
            $final_format_data = xml_generator(json_decode($params['final_format_data'], TRUE));
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Packing details is required', 'data' => FALSE);
        }
        $dbparams[1] = $final_format_data;
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[2] = $params['student_id'];
        } else {
            return array('status' => 0, 'message' => 'Student  id is requried.', 'data' => FALSE);
        }
        if (isset($params['total_qty']) && !empty($params['total_qty'])) {
            $dbparams[3] = $params['total_qty'];
        } else {
            return array('status' => 0, 'message' => 'Total quantity is requried.', 'data' => FALSE);
        }
        if (isset($params['sub_total']) && !empty($params['sub_total'])) {
            $dbparams[4] = $params['sub_total'];
        } else {
            return array('status' => 0, 'message' => 'Sub total quantity is requried.', 'data' => FALSE);
        }

        if (isset($params['final_order_value']) && !empty($params['final_order_value'])) {
            $dbparams[5] = $params['final_order_value'];
        } else {
            return array('status' => 0, 'message' => 'Final order value is requried.', 'data' => FALSE);
        }
        if (isset($params['roundoff'])) {
            $dbparams[6] = $params['roundoff'];
        } else {
            return array('status' => 0, 'message' => 'Round off value is requried.', 'data' => FALSE);
        }
        if (isset($params['tax_price'])) {
            $dbparams[7] = $params['tax_price'];
        } else {
            return array('status' => 0, 'message' => 'Tax Amount is requried.', 'data' => FALSE);
        }
        $status = $this->MSPacking->save_student_packing($dbparams);
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => $status['error_messages'], 'purchase_code' => 0);
            } else {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Packing data updated', 'packing_code' => $status['packing_code']);
            }
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'id' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'packing insertion failed', 'id' => 0);
            }
        }
    }

    public function save_packing_faculty($params) {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['final_format_data']) && !empty($params['final_format_data'])) {
            $final_format_data = xml_generator(json_decode($params['final_format_data'], TRUE));
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Packing details is required', 'data' => FALSE);
        }
        $dbparams[1] = $final_format_data;
        if (isset($params['emply_id']) && !empty($params['emply_id'])) {
            $dbparams[2] = $params['emply_id'];
        } else {
            return array('status' => 0, 'message' => 'Employee  id is requried.', 'data' => FALSE);
        }
        if (isset($params['total_qty']) && !empty($params['total_qty'])) {
            $dbparams[3] = $params['total_qty'];
        } else {
            return array('status' => 0, 'message' => 'Total quantity is requried.', 'data' => FALSE);
        }
        if (isset($params['sub_total']) && !empty($params['sub_total'])) {
            $dbparams[4] = $params['sub_total'];
        } else {
            return array('status' => 0, 'message' => 'Sub total quantity is requried.', 'data' => FALSE);
        }

        if (isset($params['final_order_value']) && !empty($params['final_order_value'])) {
            $dbparams[5] = $params['final_order_value'];
        } else {
            return array('status' => 0, 'message' => 'Final order value is requried.', 'data' => FALSE);
        }
        if (isset($params['roundoff']) && !empty($params['roundoff'])) {
            if ($params['roundoff'] == -1) {
                $dbparams[6] = 0;
            } else {
            $dbparams[6] = $params['roundoff'];
            }
        } else {
            return array('status' => 0, 'message' => 'Round off value is requried.', 'data' => FALSE);
        }
        if (isset($params['tax_price']) && !empty($params['tax_price'])) {
             if ($params['roundoff'] == -1) {
                $dbparams[7] = 0;
            } else {
            $dbparams[7] = $params['tax_price'];
            }
            
        } else {
            return array('status' => 0, 'message' => 'Tax Amount is requried.', 'data' => FALSE);
        }
//        return $dbparams;
        $status = $this->MSPacking->save_faculty_packing($dbparams);
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => $status['error_messages'], 'purchase_code' => 0);
            } else {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Packing data updated', 'packing_code' => $status['packing_code'],'bill_no' => $status['Bill_code']);
            }
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'id' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'packing insertion failed', 'id' => 0);
            }
        }
    }

}
