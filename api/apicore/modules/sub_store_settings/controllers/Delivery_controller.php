<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Delivery_controller
 *
 * @author saranya.kumar
 */
class Delivery_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Delivery_model', 'MSDelivery');
    }

    public function get_faculty_pack_delivery($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['emp_id']) && !empty($params['emp_id'])) {
            $dbparams[1] = $params['emp_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Employee ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $packdetails = $this->MSDelivery->get_faculty_delivery_data($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_student_pack_delivery($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $packdetails = $this->MSDelivery->get_student_delivery_data($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function packdetailed_delivery($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['pack_id']) && !empty($params['pack_id'])) {
            $dbparams[1] = $params['pack_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pack ID is required', 'data' => FALSE);
        }
        if (isset($params['flag']) && !empty($params['flag'])) {
            $dbparams[2] = $params['flag'];
        } else {
            $dbparams[2] = 0;
        }
        //        dev_export($dbparams);die;
        $packdetails = $this->MSDelivery->get_pack_data_delivery($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_delivery_note_print_data($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['pack_id']) && !empty($params['pack_id'])) {
            $dbparams[1] = $params['pack_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pack ID is required', 'data' => FALSE);
        }
        $packdetails = $this->MSDelivery->get_pack_data_delivery_note($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function replace_item_delivery($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['type_id']) && !empty($params['type_id'])) {
            $dbparams[1] = $params['type_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'price is required', 'data' => FALSE);
        }
        if (isset($params['price']) && !empty($params['price'])) {
            $dbparams[2] = $params['price'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Type ID is required', 'data' => FALSE);
        }
        if (isset($params['item_id']) && !empty($params['item_id'])) {
            $dbparams[3] = $params['item_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $packdetails = $this->MSDelivery->get_replace_data_delivery($dbparams);
        //        dev_export($packdetails);die;
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_delivery_student($params)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['delivery_masterid']) && !empty($params['delivery_masterid'])) {
            $dbparams[1] = $params['delivery_masterid'];
        } else {
            return array('status' => 0, 'message' => 'Delivery  id is requried.', 'data' => FALSE);
        }
        $status = $this->MSDelivery->save_student_dellivery($dbparams);
        //        dev_export($status);die;
        if (isset($status['STATUS']) && !empty($status['STATUS']) && $status['STATUS'] == 1) {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => $status['error_messages']);
            } else {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Delivery data updated');
            }
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'id' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Delivery insertion failed', 'id' => 0);
            }
        }
    }

    public function save_delivery_item_replace($params)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['pack_id']) && !empty($params['pack_id'])) {
            $dbparams[1] = $params['pack_id'];
        } else {
            return array('status' => 0, 'message' => 'Pack  id is requried.', 'data' => FALSE);
        }
        if (isset($params['re_item_id']) && !empty($params['re_item_id'])) {
            $dbparams[2] = $params['re_item_id'];
        } else {
            return array('status' => 0, 'message' => 'Replacing item id is requried.', 'data' => FALSE);
        }
        if (isset($params['item_id']) && !empty($params['item_id'])) {
            $dbparams[3] = $params['item_id'];
        } else {
            return array('status' => 0, 'message' => 'Item id is requried.', 'data' => FALSE);
        }
        if (isset($params['qty']) && !empty($params['qty'])) {
            $dbparams[4] = $params['qty'];
        } else {
            return array('status' => 0, 'message' => 'Quantity is requried.', 'data' => FALSE);
        }
        if (isset($params['price']) && !empty($params['price'])) {
            $dbparams[5] = $params['price'];
        } else {
            return array('status' => 0, 'message' => 'Price is requried.', 'data' => FALSE);
        }
        if (isset($params['del_detail_id']) && !empty($params['del_detail_id'])) {
            $dbparams[6] = $params['del_detail_id'];
        } else {
            return array('status' => 0, 'message' => 'Price is requried.', 'data' => FALSE);
        }
        $status = $this->MSDelivery->save_replace_item_dellivery($dbparams);
        //        dev_export($status);die;
        if (isset($status['STATUS']) && !empty($status['STATUS']) && $status['STATUS'] == 1) {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => $status['error_messages']);
            } else {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Delivery data updated');
            }
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'id' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Delivery replacement insertion failed', 'id' => 0);
            }
        }
    }

    //DELIVERY RETURN

    public function get_student_pack_deliveryReturn($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = $params['studentid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $packdetails = $this->MSDelivery->get_student_deliveryReturn_data($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_faculty_pack_deliveryReturn($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['emp_id']) && !empty($params['emp_id'])) {
            $dbparams[1] = $params['emp_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Employee ID is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $packdetails = $this->MSDelivery->get_faculty_pack_deliveryReturn($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_deliveryReturn_student($params)
    {
        //        dev_export();die;
        $dbparams = array();
        $apikey = $params['API_KEY'];
        if (isset($params['delivery_masterid']) && !empty($params['delivery_masterid'])) {
            $delivery_masterid = $params['delivery_masterid'];
        } else {
            return array('status' => 0, 'message' => 'Delivery  id is requried.', 'data' => FALSE);
        }
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $student_id = $params['student_id'];
        } else {
            return array('status' => 0, 'message' => 'Student id is requried.', 'data' => FALSE);
        }
        if (isset($params['subtotal']) && !empty($params['subtotal'])) {
            if ($params['subtotal'] == -1) {
                $subtotal = 0;
            } else {
                $subtotal = $params['subtotal'];
            }
        } else {
            return array('status' => 0, 'message' => 'Subtotal is requried.', 'data' => FALSE);
        }
        if (isset($params['tax']) && !empty($params['tax'])) {
            if ($params['tax'] == -1) {
                $tax = 0;
            } else {
                $tax = $params['tax'];
            }
        } else {
            return array('status' => 0, 'message' => 'Tax is requried.', 'data' => FALSE);
        }
        if (isset($params['final_amount']) && !empty($params['final_amount'])) {
            if ($params['final_amount'] == -1) {
                $final_amount = 0;
            } else {
                $final_amount = $params['final_amount'];
            }
        } else {
            return array('status' => 0, 'message' => 'Final amount is requried.', 'data' => FALSE);
        }
        if (isset($params['reason']) && !empty($params['reason'])) {
            $reason = $params['reason'];
        } else {
            return array('status' => 0, 'message' => 'Reason is requried.', 'data' => FALSE);
        }
        //        dev_export($reason);die;
        if (isset($params['delivery_data']) && !empty($params['delivery_data'])) {
            $delivery_data_raw = $params['delivery_data'];
        } else {
            return array('status' => 0, 'message' => 'Delivery data  is requried.', 'data' => FALSE);
        }
        if (isset($params['round_off']) && !empty($params['round_off'])) {
            $round_off = $params['round_off'];
        } else {
            $round_off = $params['round_off'];
        }
        if (isset($params['total_before_roundoff']) && !empty($params['total_before_roundoff'])) {
            $total_before_roundoff = $params['total_before_roundoff'];
        } else {
            return array('status' => 0, 'message' => 'Total before roundoff   is requried.', 'data' => FALSE);
        }
        if (isset($params['pay_back_amount']) && !empty($params['pay_back_amount'])) {
            $pay_back_amount = $params['pay_back_amount'];
        } else {
            $pay_back_amount = $final_amount;
        }

        $delivery_data_details = json_decode($delivery_data_raw, TRUE);
        $xml_data = xml_generator($delivery_data_details);
        //        dev_export($xml_data);die;


        $status = $this->MSDelivery->save_student_delliveryReturn($apikey, $delivery_masterid, $student_id, $subtotal, $tax, $final_amount, $reason, $xml_data, $round_off, $total_before_roundoff, $pay_back_amount);
        //        dev_export($status);die;
        if (isset($status['STATUS']) && !empty($status['STATUS']) && $status['STATUS'] == 1) {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => $status['error_messages']);
            } else {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Delivery data updated', 'del_ret' => $status['del_retno']);
            }
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'id' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Delivery Return insertion failed', 'id' => 0);
            }
        }
    }

    public function save_deliveryReturn_faculty($params)
    {
        //        dev_export();die;
        $dbparams = array();
        $apikey = $params['API_KEY'];
        if (isset($params['delivery_masterid']) && !empty($params['delivery_masterid'])) {
            $delivery_masterid = $params['delivery_masterid'];
        } else {
            return array('status' => 0, 'message' => 'Delivery  id is requried.', 'data' => FALSE);
        }
        if (isset($params['emp_id']) && !empty($params['emp_id'])) {
            $emp_id = $params['emp_id'];
        } else {
            return array('status' => 0, 'message' => 'Employee id is requried.', 'data' => FALSE);
        }
        if (isset($params['subtotal']) && !empty($params['subtotal'])) {
            if ($params['subtotal'] == -1) {
                $subtotal = 0;
            } else {
                $subtotal = $params['subtotal'];
            }
        } else {
            return array('status' => 0, 'message' => 'Subtotal is requried.', 'data' => FALSE);
        }
        if (isset($params['tax']) && !empty($params['tax'])) {
            if ($params['tax'] == -1) {
                $tax = 0;
            } else {
                $tax = $params['tax'];
            }
        } else {
            return array('status' => 0, 'message' => 'Tax is requried.', 'data' => FALSE);
        }
        if (isset($params['final_amount']) && !empty($params['final_amount'])) {
            if ($params['final_amount'] == -1) {
                $final_amount = 0;
            } else {
                $final_amount = $params['final_amount'];
            }
        } else {
            return array('status' => 0, 'message' => 'Final amount is requried.', 'data' => FALSE);
        }
        if (isset($params['reason']) && !empty($params['reason'])) {
            $reason = $params['reason'];
        } else {
            return array('status' => 0, 'message' => 'Reason is requried.', 'data' => FALSE);
        }
        //        dev_export($reason);die;
        if (isset($params['delivery_data']) && !empty($params['delivery_data'])) {
            $delivery_data_raw = $params['delivery_data'];
        } else {
            return array('status' => 0, 'message' => 'Delivery data  is requried.', 'data' => FALSE);
        }
        if (isset($params['round_off']) && !empty($params['round_off'])) {
            $round_off = $params['round_off'];
        } else {
            $round_off = $params['round_off'];
        }
        if (isset($params['total_before_roundoff']) && !empty($params['total_before_roundoff'])) {
            $total_before_roundoff = $params['total_before_roundoff'];
        } else {
            return array('status' => 0, 'message' => 'Total before roundoff  is requried.', 'data' => FALSE);
        }

        $delivery_data_details = json_decode($delivery_data_raw, TRUE);
        $xml_data = xml_generator($delivery_data_details);
        //        dev_export($xml_data);die;


        $status = $this->MSDelivery->save_faculty_delliveryReturn($apikey, $delivery_masterid, $emp_id, $subtotal, $tax, $final_amount, $reason, $xml_data, $round_off, $total_before_roundoff);
        //        dev_export($status);die;
        if (isset($status['STATUS']) && !empty($status['STATUS']) && $status['STATUS'] == 1) {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => $status['error_messages']);
            } else {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Delivery data updated', 'del_ret' => $status['del_retno']);
            }
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'id' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Delivery Return insertion failed', 'id' => 0);
            }
        }
    }

    public function sales_delivery_return_save_OH($params)
    {
        //        dev_export();die;
        $dbparams = array();
        $apikey = $params['API_KEY'];
        if (isset($params['delivery_masterid']) && !empty($params['delivery_masterid'])) {
            $delivery_masterid = $params['delivery_masterid'];
        } else {
            return array('status' => 0, 'message' => 'Delivery  id is requried.', 'data' => FALSE);
        }
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $student_id = $params['student_id'];
        } else {
            return array('status' => 0, 'message' => 'Student id is requried.', 'data' => FALSE);
        }
        if (isset($params['subtotal']) && !empty($params['subtotal'])) {
            if ($params['subtotal'] == -1) {
                $subtotal = 0;
            } else {
                $subtotal = $params['subtotal'];
            }
        } else {
            return array('status' => 0, 'message' => 'Subtotal is requried.', 'data' => FALSE);
        }
        if (isset($params['tax']) && !empty($params['tax'])) {
            if ($params['tax'] == -1) {
                $tax = 0;
            } else {
                $tax = $params['tax'];
            }
        } else {
            return array('status' => 0, 'message' => 'Tax is requried.', 'data' => FALSE);
        }
        if (isset($params['final_amount']) && !empty($params['final_amount'])) {
            if ($params['final_amount'] == -1) {
                $final_amount = 0;
            } else {
                $final_amount = $params['final_amount'];
            }
        } else {
            return array('status' => 0, 'message' => 'Final amount is requried.', 'data' => FALSE);
        }
        if (isset($params['reason']) && !empty($params['reason'])) {
            $reason = $params['reason'];
        } else {
            return array('status' => 0, 'message' => 'Reason is requried.', 'data' => FALSE);
        }
        if (isset($params['round_off']) && !empty($params['round_off'])) {
            $round_off = $params['round_off'];
        } else {
            $round_off = $params['round_off'];
        }
        if (isset($params['total_before_roundoff']) && !empty($params['total_before_roundoff'])) {
            $total_before_roundoff = $params['total_before_roundoff'];
        } else {
            return array('status' => 0, 'message' => 'total before roundoff is requried.', 'data' => FALSE);
        }

        if (isset($params['pay_back_amount']) && !empty($params['pay_back_amount'])) {
            $pay_back_amount = $params['pay_back_amount'];
        } else {
            $pay_back_amount = $final_amount;
        }
        //    



        $status = $this->MSDelivery->sales_delivery_return_save_OH($apikey, $delivery_masterid, $student_id, $subtotal, $tax, $final_amount, $reason, $round_off, $total_before_roundoff, $pay_back_amount);
        //        dev_export($status);die;
        if (isset($status['STATUS']) && !empty($status['STATUS']) && $status['STATUS'] == 1) {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => $status['error_messages']);
            } else {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Delivery data updated', 'del_ret' => $status['del_retno']);
            }
        } else {
            if (isset($status['MSG']) && !empty($status['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'id' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Delivery Return insertion failed', 'id' => 0);
            }
        }
    }

    public function get_student_voucher_search_delivery($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['key']) && !empty($params['key'])) {
            $dbparams[1] = $params['key'];
        } else {
            $dbparams[1] = NULL;
        }
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[2] = $params['student_id'];
        } else {
            $dbparams[2] = 0;
        }
        //        return $dbparams;
        //        dev_export($dbparams);die;
        $packdetails = $this->MSDelivery->get_student_delivery_voucher_search($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function voucher_search_faculty($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['key']) && !empty($params['key'])) {
            $dbparams[1] = $params['key'];
        } else {
            $dbparams[1] = NULL;
        }
        if (isset($params['emp_id']) && !empty($params['emp_id'])) {
            $dbparams[2] = $params['emp_id'];
        } else {
            return array('status' => 0, 'message' => 'Employee id is requried.', 'data' => FALSE);
        }
        if (isset($params['flag']) && !empty($params['flag'])) {
            $dbparams[3] = $params['flag'];
        } else {
            $dbparams[3] = 0;
        }
        //        return $dbparams;
        //        dev_export($dbparams);die;
        $packdetails = $this->MSDelivery->voucher_search_faculty($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_bookstore_online_order_delivery_details($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['pack_id']) && !empty($params['pack_id'])) {
            $dbparams[1] = $params['pack_id'];
        } else {
            return array('status' => 0, 'message' => 'Pack Id is requried.', 'data' => FALSE);
        }
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[2] = $params['student_id'];
        } else {
            return array('status' => 0, 'message' => 'Student Id is requried.', 'data' => FALSE);
        }
        if (isset($params['delivery_address']) && !empty($params['delivery_address'])) {
            $dbparams[3] = $params['delivery_address'];
        } else {
            return array('status' => 0, 'message' => 'Delivery Address is requried.', 'data' => FALSE);
        }
        if (isset($params['mobile_no']) && !empty($params['mobile_no'])) {
            $dbparams[4] = $params['mobile_no'];
        } else {
            return array('status' => 0, 'message' => 'Delivery Address is requried.', 'data' => FALSE);
        }
        if (isset($params['payment_type']) && !empty($params['payment_type'])) {
            $dbparams[5] = $params['payment_type'];
        } else {
            return array('status' => 0, 'message' => 'Payment_type is requried.', 'data' => FALSE);
        }
        if (isset($params['payment_status']) && !empty($params['payment_status'])) {
            $dbparams[6] = $params['payment_type'];
        } else {
            $dbparams[6] = 0;
        }
        if (isset($params['payment_details']) && !empty($params['payment_details'])) {
            $dbparams[7] = $params['payment_details'];
        } else {
            $dbparams[7] = '';
        }
        if (isset($params['payment_amount']) && !empty($params['payment_amount'])) {
            $dbparams[8] = $params['payment_amount'];
        } else {
            $dbparams[8] = 0;
        }
        if (isset($params['reference_no']) && !empty($params['reference_no'])) {
            $dbparams[9] = $params['reference_no'];
        } else {
            return array('status' => 0, 'message' => 'Reference No is requried.', 'data' => FALSE);
        }

        $packdetails = $this->MSDelivery->save_bookstore_online_order_delivery_details($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_bookstore_online_order($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['pack_id']) && !empty($params['pack_id'])) {
            $dbparams[1] = 'isactive=1 and pack_id=' . $params['pack_id'];
        } else {
            $dbparams[1] = '';
        }
        $packdetails = $this->MSDelivery->get_bookstore_online_order($dbparams);
        if (!empty($packdetails) && is_array($packdetails)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $packdetails);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
