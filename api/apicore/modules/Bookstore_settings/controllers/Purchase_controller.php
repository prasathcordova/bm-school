<?php

/**
 * Description of Purchase_controller
 *
 * @author aju.docme
 */
class Purchase_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Purchase_model', 'MPurchase');
    }

    public function get_all_purchase_details($params) {
        $apikey = $params['API_KEY'];
        $purchase_list = $this->MPurchase->get_all_purchase_list($apikey);
        if ($purchase_list) {
            return array('data_status' => 1, 'error_status' => 0, 'data' => $purchase_list, 'message' => '');
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'There is no data available');
        }
    }

//    public function direct_purchase_order_save($params) {
//        $apikey = $params['API_KEY'];
//        if (isset($params['supplier_id']) && !empty($params['supplier_id'])) {
//            $supplier_id = $params['supplier_id'];
//        } else {
//            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Supplier data is required');
//        }
//
//        if (isset($params['total_items']) && !empty($params['total_items'])) {
//            $total_items = $params['total_item'];
//        } else {
//            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Total items count is required');
//        }
//
//        if (isset($params['sub_total']) && !empty($params['sub_total'])) {
//            $sub_total = $params['sub_total'];
//        } else {
//            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Sub Total is required');
//        }
//        if (isset($params['purchase_item_details']) && !empty($params['purchase_item_details'])) {
//            $purchase_item_details_raw = $params['purchase_item_details'];
//        } else {
//            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Purchase item details is required');
//        }
//        if (isset($params['discount']) && !empty($params['discount'])) {
//            $discount = $params['discount'];
//        } else {
//            $discount = 0;
//        }
//        if (isset($params['tax_amount']) && !empty($params['tax_amount'])) {
//            $tax_amount = $params['tax_amount'];
//        } else {
//            $tax_amount = 0;
//        }
//        if (isset($params['remarks']) && !empty($params['remarks'])) {
//            $remarks = $params['remarks'];
//        } else {
//            $remarks = '';
//        }
//
//        $data_prep_array = array(
//            'supplier_id' => $supplier_id,
//            'total_items' => $total_items,
//            'sub_total' => $sub_total,
//            'discount' => $discount,
//            'tax_amount' => $tax_amount,
//            'remarks' => $remarks
//        );
//
//        $purchase_item_details = json_decode($purchase_item_details_raw, TRUE);
//        $purchase_item_details_xml = xml_generator($purchase_item_details);
//
//        $direct_purchase_save = $this->MPurchase->save_direct_purchase($apikey, $data_prep_array, $purchase_item_details_xml);
//
//        if (isset($direct_purchase_save['status']) && !empty($direct_purchase_save['status']) && $direct_purchase_save['status'] == 1) {
//            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Direct purchase saved successfully');
//        } else {
//            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Direct purchase failed to save');
//        }
//    }

    /*
     * @Author      :  Docme 
     * Purpose      :  Save purchase details
     * Created Date :  19-Oct-2017
     */

    public function save_direct_purchase_order($params) {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['final_format_data']) && !empty($params['final_format_data'])) {
            $final_format_data = xml_generator(json_decode($params['final_format_data'], TRUE));
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'purchase order details is required', 'data' => FALSE);
        }
        $dbparams[1] = $final_format_data;
        //purchase date & time in GMT / UTC
        $dbparams[2] = date("Y-m-d H:i:s", time() - date("Z"));
        if (isset($params['type_id']) && !empty($params['type_id'])) {
            $dbparams[3] = $params['type_id'];
        } else {
            return array('status' => 0, 'message' => 'Purchase type is requried.', 'data' => FALSE);
        }
        if (isset($params['supplier_code']) && !empty($params['supplier_code'])) {
            $dbparams[4] = $params['supplier_code'];
        } else {
            return array('status' => 0, 'message' => 'Purchase supplier code is requried.', 'data' => FALSE);
        }
        if (isset($params['total_qty']) && !empty($params['total_qty'])) {
            $dbparams[5] = $params['total_qty'];
        } else {
            return array('status' => 0, 'message' => 'Purchase total quantity is requried.', 'data' => FALSE);
        }

        if (isset($params['item_count']) && !empty($params['item_count'])) {
            $dbparams[6] = $params['item_count'];
        } else {
            return array('status' => 0, 'message' => 'Item count is requried.', 'data' => FALSE);
        }
        if (isset($params['sub_total']) && !empty($params['sub_total'])) {
            $dbparams[7] = $params['sub_total'];
        } else {
            return array('status' => 0, 'message' => 'Sub Total value is requried.', 'data' => FALSE);
        }

        if (isset($params['final_order_value']) && !empty($params['final_order_value'])) {
            $dbparams[8] = $params['final_order_value'];
        } else {
            return array('status' => 0, 'message' => 'Final order value is requried.', 'data' => FALSE);
        }

        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[9] = $params['remarks'];
        } else {
            return array('status' => 0, 'message' => 'Remarks details is requried.', 'data' => FALSE);
        }

        $purchase_status = $this->MPurchase->save_direct_purchase_order($dbparams);

        if (isset($purchase_status[0]['status']) && !empty($purchase_status[0]['status']) && $purchase_status[0]['status'] == 1) {
            if (isset($purchase_status[0]['error_messages']) && !empty($purchase_status[0]['error_messages'])) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => $purchase_status[0]['error_messages'], 'purchase_code' => 0);
            } else {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Purchase data updated', 'purchase_code' => $purchase_status[0]['purchase_code']);
            }
        } else {
            if (isset($purchase_status[0]['MSG']) && !empty($purchase_status[0]['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'id' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase insertion failed', 'id' => 0);
            }
        }
    }

//END Docme

    public function save_purchase_order($params) {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['final_format_data']) && !empty($params['final_format_data'])) {
            $final_format_data = xml_generator(json_decode($params['final_format_data'], TRUE));
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'purchase order details is required', 'data' => FALSE);
        }
        $dbparams[1] = $final_format_data;
        //purchase date & time in GMT / UTC
        $dbparams[2] = date("Y-m-d H:i:s", time() - date("Z"));
        if (isset($params['type_id']) && !empty($params['type_id'])) {
            $dbparams[3] = $params['type_id'];
        } else {
            return array('status' => 0, 'message' => 'Purchase type is requried.', 'data' => FALSE);
        }
        if (isset($params['supplier_code']) && !empty($params['supplier_code'])) {
            $dbparams[4] = $params['supplier_code'];
        } else {
            return array('status' => 0, 'message' => 'Purchase supplier code is requried.', 'data' => FALSE);
        }
        if (isset($params['total_qty']) && !empty($params['total_qty'])) {
            $dbparams[5] = $params['total_qty'];
        } else {
            return array('status' => 0, 'message' => 'Purchase total quantity is requried.', 'data' => FALSE);
        }

        if (isset($params['item_count']) && !empty($params['item_count'])) {
            $dbparams[6] = $params['item_count'];
        } else {
            return array('status' => 0, 'message' => 'Item count is requried.', 'data' => FALSE);
        }
        if (isset($params['sub_total']) && !empty($params['sub_total'])) {
            $dbparams[7] = $params['sub_total'];
        } else {
            return array('status' => 0, 'message' => 'Sub Total value is requried.', 'data' => FALSE);
        }

        if (isset($params['final_order_value']) && !empty($params['final_order_value'])) {
            $dbparams[8] = $params['final_order_value'];
        } else {
            return array('status' => 0, 'message' => 'Final order value is requried.', 'data' => FALSE);
        }

        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[9] = $params['remarks'];
        } else {
            return array('status' => 0, 'message' => 'Remarks details is requried.', 'data' => FALSE);
        }

        $purchase_status = $this->MPurchase->save_purchase_order($dbparams);

        if (isset($purchase_status[0]['status']) && !empty($purchase_status[0]['status']) && $purchase_status[0]['status'] == 1) {
            if (isset($purchase_status[0]['error_messages']) && !empty($purchase_status[0]['error_messages'])) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => $purchase_status[0]['error_messages'], 'purchase_code' => 0);
            } else {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Purchase data updated', 'purchase_code' => $purchase_status[0]['purchase_code']);
            }
        } else {
            if (isset($purchase_status[0]['MSG']) && !empty($purchase_status[0]['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG'], 'id' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase insertion failed', 'id' => 0);
            }
        }
    }

    public function edit_purchase($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['purchase_id']) && !empty($params['purchase_id'])) {
            $purchase_id = $params['purchase_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'purchase_id data is required',);
        }
        $item_list = $this->MPurchase->get_purchase_details($apikey, $purchase_id);
        if (isset($item_list) && !empty($item_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded', 'data' => $item_list);
        } else {

            return array('data_status' => 0, 'error_status' => 1, 'message' => 'no data');
        }
    }

    public function update_purchase($params) {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['purchase_id']) && !empty($params['purchase_id'])) {
            $dbparams[1] = $params['purchase_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'purchase order details is required', 'data' => FALSE);
        }

        if (isset($params['purchase_code']) && !empty($params['purchase_code'])) {
            $dbparams[2] = $params['purchase_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'purchase order details is required', 'data' => FALSE);
        }

        if (isset($params['final_format_data']) && !empty($params['final_format_data'])) {
            $final_format_data = xml_generator(json_decode($params['final_format_data'], TRUE));
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'purchase order details is required', 'data' => FALSE);
        }

        $dbparams[3] = $final_format_data;

        if (isset($params['purchase_order_date']) && !empty($params['purchase_order_date'])) {
            $dbparams[4] = $params['purchase_order_date'];
        } else {
            return array('status' => 0, 'message' => 'Order date is requried.', 'data' => FALSE);
        }
        if (isset($params['type_id']) && !empty($params['type_id'])) {
            $dbparams[5] = $params['type_id'];
        } else {
            return array('status' => 0, 'message' => 'Purchase type is requried.', 'data' => FALSE);
        }
        if (isset($params['store_id']) && !empty($params['store_id'])) {
            $dbparams[6] = $params['store_id'];
        } else {
            return array('status' => 0, 'message' => 'Purchase store id is requried.', 'data' => FALSE);
        }
        if (isset($params['supplier_code']) && !empty($params['supplier_code'])) {
            $dbparams[7] = $params['supplier_code'];
        } else {
            return array('status' => 0, 'message' => 'Purchase supplier code is requried.', 'data' => FALSE);
        }
        if (isset($params['total_qty']) && !empty($params['total_qty'])) {
            $dbparams[8] = $params['total_qty'];
        } else {
            return array('status' => 0, 'message' => 'Purchase total quantity is requried.', 'data' => FALSE);
        }

        if (isset($params['item_count']) && !empty($params['item_count'])) {
            $dbparams[9] = $params['item_count'];
        } else {
            return array('status' => 0, 'message' => 'Item count is requried.', 'data' => FALSE);
        }
        if (isset($params['total_value']) && !empty($params['total_value'])) {
            $dbparams[10] = $params['total_value'];
        } else {
            return array('status' => 0, 'message' => 'Total value is requried.', 'data' => FALSE);
        }

        if (isset($params['final_order_value']) && !empty($params['final_order_value'])) {
            $dbparams[11] = $params['final_order_value'];
        } else {
            return array('status' => 0, 'message' => 'Final order value is requried.', 'data' => FALSE);
        }

        if (isset($params['status_id']) && !empty($params['status_id'])) {
            $dbparams[12] = $params['status_id'];
        } else {
            return array('status' => 0, 'message' => 'Status details is requried.', 'data' => FALSE);
        }

        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[13] = $params['remarks'];
        } else {
            return array('status' => 0, 'message' => 'Remarks details is requried.', 'data' => FALSE);
        }

        $purchase_status = $this->MPurchase->Update_purchase_order($dbparams);

        if (isset($purchase_status[0]['status']) && !empty($purchase_status[0]['status']) && $purchase_status[0]['status'] == 1) {

            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Purchase data updated', 'purchase_code' => $purchase_status[0]['purchase_code']);
        } else {
            if (isset($purchase_status[0]['MSG']) && !empty($purchase_status[0]['MSG'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $purchase_status[0]['MSG'], 'id' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase insertion failed', 'id' => 0);
            }
        }
    }

    public function item_search_list($params = NULL) {
        $apikey = $params['API_KEY'];
        if (isset($params['item']) && !empty($params['item'])) {
            $item = $params['item'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item data is required',);
        }
        $item_list = $this->MPurchase->get_item_search($apikey, $item);
        if (isset($item_list) && !empty($item_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded', 'data' => $item_list);
        } else {

            return array('data_status' => 0, 'error_status' => 1, 'message' => 'no data');
        }
    }

    public function approve_purchase($params = NULL) {
        $apikey = $params['API_KEY'];
        if (isset($params['purchase_id']) && !empty($params['purchase_id'])) {
            $purchase_id = $params['purchase_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'purchase_id data is required',);
        }
        if (isset($params['approval_remarks']) && !empty($params['approval_remarks'])) {
            $approval_remark = $params['approval_remarks'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Approval remarks data is required',);
        }
        if (isset($params['status']) && !empty($params['status'])) {
            $status_id = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'status_id data is required',);
        }
        $approve_status = $this->MPurchase->approve_purchase($apikey, $purchase_id, $approval_remark, $status_id);

        if (isset($approve_status[0]['status']) && !empty($approve_status[0]['status']) && $approve_status[0]['status'] = 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'approved purchase', 'purchase_code' => $approve_status[0]['purchase_code']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'updation failed');
        }
    }

    //21-11-2017 Docme


    public function Approve_direct_purchase($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['purchase_id']) && !empty($params['purchase_id'])) {
            $dbparams[1] = $params['purchase_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase data is required', 'data' => FALSE);
        }
        if (isset($params['approval_remarks']) && !empty($params['approval_remarks'])) {
            $dbparams[2] = $params['approval_remarks'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Approval remarks is required', 'data' => FALSE);
        }
        if (isset($params['status']) && !empty($params['status'])) {
            $dbparams[3] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Approval status is required', 'data' => FALSE);
        }
        $aproval_add_status = $this->MPurchase->Approve_purchase_data($dbparams);
        if (!empty($aproval_add_status) && is_array($aproval_add_status) && isset($aproval_add_status['error_status']) && $aproval_add_status['error_status'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $aproval_add_status);
        } else {
            if (isset($aproval_add_status['ErrorMessage']) && !empty($aproval_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $aproval_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    //21-11-2017 Docme  end

    /*
     * 
     * Author : Aju S Aravind
     * Purpose : To get direct purchase data for display on UI for confirmation
     * Date :  22-Nov-2017
     * 
     */

    public function get_purchase_approval_data($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['purchase_id']) && !empty($params['purchase_id'])) {
            $purchase_id = $params['purchase_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'purchase data is required', 'data' => FALSE);
        }

        $purchase_master_data = $this->MPurchase->get_purchase_master_data_for_approval_display($purchase_id, $apikey);
        if ($purchase_master_data) {
            $purchase_detail_data = $this->MPurchase->get_purchase_detail_data_for_approval_display($purchase_id, $apikey);
            $purchase_comment_data = $this->MPurchase->get_purchase_comment_data_for_approval_display($purchase_id, $apikey);
            if ($purchase_detail_data) {
                $formatted_data = $this->format_purchase_approval_display_data($purchase_master_data, $purchase_detail_data, $purchase_comment_data);
                return array('data_status' => 1, 'error_status' => 0, 'data' => $formatted_data);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'No purchase data available', 'data' => FALSE);
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'No purchase data available', 'data' => FALSE);
        }
    }

    public function format_purchase_approval_display_data($purchase_master, $purchase_detail, $purchase_comment_data) {
        $formatted_data = array();
        if (isset($purchase_master) && !empty($purchase_master)) {
            $formatted_data = array(
                'master_data' => $purchase_master[0],
                'item_data' => $purchase_detail
            );
            if (isset($purchase_comment_data) && !empty($purchase_comment_data)) {
                $formatted_data['comment_data'] = $purchase_comment_data;
            } else {
                $formatted_data['comment_data'] = NULL;
            }
        } else {
            $formatted_data = array(
                'master_data' => NULL,
                'item_data' => NULL,
                'comment_data' => NULL
            );
        }
        return $formatted_data;
    }

    /*
     * 
     * Author : Aju S Aravind
     * Purpose : To get purchase details for purchase receive .
     * Date :  22-Nov-2017
     * 
     */

    public function get_purchase_details_for_receive($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['purchase_id']) && !empty($params['purchase_id'])) {
            $purchase_id = $params['purchase_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'purchase data is required', 'data' => FALSE);
        }

        $purchase_master_data = $this->MPurchase->get_purchase_master_data_for_approval_display($purchase_id, $apikey);
        if ($purchase_master_data) {
            $purchase_detail_data = $this->MPurchase->get_purchase_detail_data_for_approval_display($purchase_id, $apikey);

            $purchase_received_items = $this->MPurchase->get_received_items_for_display($purchase_id, $apikey);
            if ($purchase_detail_data) {
                $formatted_data = $this->format_purchase_receive_display_data($purchase_master_data, $purchase_detail_data, $purchase_received_items);
                return array('data_status' => 1, 'error_status' => 0, 'data' => $formatted_data);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'No purchase data available', 'data' => FALSE);
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'No purchase data available', 'data' => FALSE);
        }
    }

    public function format_purchase_receive_display_data($purchase_master, $purchase_detail, $purchase_received_items) {
        $formatted_data = array();
        if (isset($purchase_master) && !empty($purchase_master)) {
            $formatted_data = array(
                'master_data' => $purchase_master[0],
                'item_data' => $purchase_detail
            );
            if (isset($purchase_received_items) && !empty($purchase_received_items)) {
                $formatted_data['received_data'] = $purchase_received_items;
            } else {
                $formatted_data['received_data'] = NULL;
            }
        } else {
            $formatted_data = array(
                'master_data' => NULL,
                'item_data' => NULL,
                'received_data' => NULL
            );
        }
        return $formatted_data;
    }

    /*
     * 
     * Author : Aju S Aravind
     * Purpose : To save purchase receive data
     * Date :  30-Nov-2017
     * 
     */

    public function purchase_item_receive($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['purchase_id']) && !empty($params['purchase_id'])) {
            $purchase_id = $params['purchase_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'purchase data is required', 'data' => FALSE);
        }
        if (isset($params['invoice_no']) && !empty($params['invoice_no'])) {
            $invoice_no = $params['invoice_no'];
        } else {
            $invoice_no = '';
        }
        if (isset($params['invoice_date']) && !empty($params['invoice_date'])) {
            $invoice_date = $params['invoice_date'];
        } else {
            $invoice_date = '';
        }
        if (isset($params['delivery_no']) && !empty($params['delivery_no'])) {
            $delivery_no = $params['delivery_no'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase delivery note is required', 'data' => FALSE);
        }
        if (isset($params['close_order']) && !empty($params['close_order'])) {

            $close_order = 1;
        } else {
            $close_order = 0;
        }
        if (isset($params['item_data']) && !empty($params['item_data'])) {
            $item_data_raw = $params['item_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Item data is required', 'data' => FALSE);
        }

        $item_data = json_decode($item_data_raw);
        if (!empty($item_data)) {
            $item_data_xml = xml_generator($item_data);
        } else {
            if ($close_order == 0) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Atleast one item is requried for receiving', 'data' => FALSE);
            } else {
                $item_data_xml = '';
            }
        }

        $dbparms = array(
            $apikey,
            $purchase_id,
            $invoice_no,
            $invoice_date,
            $delivery_no,
            $close_order,
            $item_data_xml
        );

        $receive_status = $this->MPurchase->save_purchase_receive($dbparms);
//        dev_export($receive_status);die;
        if (isset($receive_status['status']) && !empty($receive_status['status']) && $receive_status['status'] == 1) {
            return array('data_status' => 1);
        } else {
            if (isset($receive_status['message']) && !empty($receive_status['message'])) {
                return array('data_status' => 2, 'message' => $receive_status['message']);
            } else {
                return array('data_status' => 2, 'message' => 'An error ocured. Please try again or contact administrator with error code : PRT100AP001');
            }
        }
    }

    public function save_edit_purchase_order($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['purchase_id']) && !empty($params['purchase_id'])) {
            $purchase_id = $params['purchase_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase data is required');
        }

        if (isset($params['item_count']) && !empty($params['item_count'])) {
            $total_items = $params['item_count'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Total items count is required');
        }
        if (isset($params['total_qty']) && !empty($params['total_qty'])) {
            $total_qty = $params['total_qty'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Total quantity count is required');
        }

        if (isset($params['sub_total']) && !empty($params['sub_total'])) {
            $sub_total = $params['sub_total'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Sub Total is required');
        }
        if (isset($params['purchase_item_details']) && !empty($params['purchase_item_details'])) {
            $purchase_item_details_raw = $params['purchase_item_details'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Purchase item details is required');
        }
        if (isset($params['discount']) && !empty($params['discount'])) {
            $discount = $params['discount'];
        } else {
            $discount = 0;
        }
        if (isset($params['tax_amount']) && !empty($params['tax_amount'])) {
            $tax_amount = $params['tax_amount'];
        } else {
            $tax_amount = 0;
        }
        if (isset($params['tax_id']) && !empty($params['tax_id'])) {
            $tax_id = $params['tax_id'];
        } else {
            $tax_id = 0;
        }
        if (isset($params['final_order_value']) && !empty($params['final_order_value'])) {
            $final_total = $params['final_order_value'];
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Purchase item details is required');
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $remarks = $params['remarks'];
        } else {
            $remarks = '';
        }

        $purchase_item_details = json_decode($purchase_item_details_raw, TRUE);
        $purchase_item_details_xml = xml_generator($purchase_item_details);
        $data_prep_array = array(
            $apikey,
            $purchase_id,
            $purchase_item_details_xml,
            $total_qty,
            $total_items,
            $sub_total,
            $discount,
            $tax_id,
            $tax_amount,
            $final_total,
            $remarks
        );
//save_edit_purchase
        $purchase_save = $this->MPurchase->save_edit_purchase($data_prep_array);
//        dev_export($purchase_save);die;
        if (isset($purchase_save[0]['status']) && !empty($purchase_save[0]['status']) && $purchase_save[0]['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Purchase editted successfully');
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase failed to save');
        }
    }

    public function purchase_delete($params) {
        $apikey = $params['API_KEY'];
        if (isset($params['purchase_id']) && !empty($params['purchase_id'])) {
            $purchase_id = $params['purchase_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase data is required');
        }
        $status = $this->MPurchase->delete_purchase_order($purchase_id, $apikey);
        if (isset($status[0]['status']) && !empty($status[0]['status']) && $status[0]['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Purchase removed successfully');
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Purchase failed to remove');
        }
    }

}
