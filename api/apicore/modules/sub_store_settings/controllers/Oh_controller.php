<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Oh_controller
 *
 * @author docme
 */
class Oh_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Oh_model', 'Ohmodel');
    }

    public function add_new_temp_openhouse($params = NULL) {
//         $dbparams = array();
        $apikey = $params['API_KEY'];

        if (isset($params['master_id']) && !empty($params['master_id'])) {
            $master_id = $params['master_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master ID is required', 'data' => FALSE);
        }

        if (isset($params['template_data']) && !empty($params['template_data'])) {
            $template_data_raw = $params['template_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'OH Template data is required', 'data' => FALSE);
        }
        $template_data = json_decode($template_data_raw);


        $xml_data = xml_generator($template_data);
        $oh_data = $this->Ohmodel->add_new_template_for_openhouse($apikey, $master_id, $xml_data);

        if (!empty($oh_data) && is_array($oh_data) && $oh_data[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data added successfully');
        } else {
            if (is_array($oh_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $oh_data[0]['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function remove_oh_student_assign($params = NULL) {

        $apikey = $params['API_KEY'];


        if (isset($params['template_config_id']) && !empty($params['template_config_id'])) {
            $template_config_id = $params['template_config_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template Config ID is required', 'data' => FALSE);
        }
        if (isset($params['template_id']) && !empty($params['template_id'])) {
            $template_id = $params['template_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        }
        if (isset($params['student_data']) && !empty($params['student_data'])) {
            $student_data_raw = $params['student_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        }
        $student_data = json_decode($student_data_raw);

        $xml_data = xml_generator($student_data);
//        dev_export($xml_data);die;

        $item_data = $this->Ohmodel->remove_oh_student_assign($apikey, $template_config_id, $template_id, $xml_data);


        if (!empty($item_data) && is_array($item_data) && isset($item_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data deleted successfully', 'data' => $item_data);
        } else {
            if (is_array($item_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $item_data['message'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data loaded', 'data' => FALSE);
            }
        }
    }

    public function get_ohtemplate($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "t.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }

        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "t.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "t.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "name LIKE '%" . $params['name'] . "%' ";
                } else {
                    $query_string = "name LIKE '%" . $params['name'] . "%' ";
                }
            }
        } else {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "t.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "t.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "name LIKE '%" . $params['name'] . "%' ";
                } else {
                    $query_string = "name LIKE '%" . $params['name'] . "%' ";
                }
            }
        }

        $oh_data = $this->Ohmodel->get_oh_data($query_string, $apikey);
        if (!empty($oh_data) && is_array($oh_data)) {
            return array('status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $oh_data);
        } else {
            return array('status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_student_openhouse($params = NULL) {

        $apikey = $params['API_KEY'];
        if (isset($params['template_id']) && !empty($params['template_id'])) {
            $template_id = $params['template_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        }
        if (isset($params['openhouse_id']) && !empty($params['openhouse_id'])) {
            $openhouse_id = $params['openhouse_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Openhouse ID is required', 'data' => FALSE);
        }

        $item_data = $this->Ohmodel->get_student_openhouse($apikey, $template_id, $openhouse_id);


        if (!empty($item_data) && is_array($item_data) && isset($item_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $item_data);
        } else {
            if (is_array($item_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $item_data['message'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data loaded', 'data' => FALSE);
            }
        }
    }

    public function save_ohtemplate($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['oh_name']) && !empty($params['oh_name'])) {
            $dbparams[1] = $params['oh_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'OH Template Name is required', 'data' => FALSE);
        }
        if (isset($params['oh_description']) && !empty($params['oh_description'])) {
            $dbparams[2] = $params['oh_description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }
        $oh_data = $this->Ohmodel->save_oh_details($dbparams);
//                dev_export($oh_data[0]);die;
        if (!empty($oh_data) && is_array($oh_data) && $oh_data[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully');
        } else {
            if (is_array($oh_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $oh_data[0]['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function edit_ohtemplate($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        }
        if (isset($params['oh_name']) && !empty($params['oh_name'])) {
            $dbparams[2] = $params['oh_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'OH Template Name is required', 'data' => FALSE);
        }
        if (isset($params['oh_description']) && !empty($params['oh_description'])) {
            $dbparams[3] = $params['oh_description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }
        $oh_data = $this->Ohmodel->edit_oh_details($dbparams);
//                dev_export($oh_data[0]);die;
        if (!empty($oh_data) && is_array($oh_data) && $oh_data[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully');
        } else {
            if (is_array($oh_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $oh_data[0]['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function save_openhouse($params = NULL) {
//         $dbparams = array();
        $apikey = $params['API_KEY'];

        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $start_date = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date is required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $end_date = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date and end date is required', 'data' => FALSE);
        }
        if (isset($params['no_temp_st']) && !empty($params['no_temp_st'])) {
            $no_temp_st = $params['no_temp_st'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Kit per student is required', 'data' => FALSE);
        }
        if (isset($params['description']) && !empty($params['description'])) {
            $description = $params['description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }
        if (isset($params['template_data']) && !empty($params['template_data'])) {
            $template_data_raw = $params['template_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'OH Template data is required', 'data' => FALSE);
        }
        if (isset($params['is_discount']) && !empty($params['is_discount'])) {
            if ($params['is_discount'] == 1) {
                $is_discount = $params['is_discount'];
            } else {
                $is_discount = 0;
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Discount is required', 'data' => FALSE);
        }

        $template_data = json_decode($template_data_raw);
        $xml_data = xml_generator($template_data);

        $oh_data = $this->Ohmodel->save_openhouse_details($apikey, $start_date, $end_date, $no_temp_st, $description, $xml_data, $is_discount);
//                dev_export($oh_data[0]);die;
        if (!empty($oh_data) && is_array($oh_data) && $oh_data[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully');
        } else if (!empty($oh_data) && is_array($oh_data) && $oh_data[0]['ErrorStatus'] == 2) {
            return array('data_status' => 2, 'error_status' => 0, 'message' => $oh_data[0]['ErrorMessage']);
        } else {
            if (is_array($oh_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $oh_data[0]['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function get_openhouse_master($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }

        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "m.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "m.id = '" . $params['id'] . "' ";
                }
            }
        } else {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "m.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "m.id = '" . $params['id'] . "' ";
                }
            }
        }

        $opnh_data = $this->Ohmodel->get_openhouse_master_data($query_string, $apikey);
        if (!empty($opnh_data) && is_array($opnh_data)) {
            return array('status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $opnh_data);
        } else {
            return array('status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_openhouse_detail($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }

        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['master_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "master_id = '" . $params['master_id'] . "' ";
                } else {
                    $query_string = "master_id = '" . $params['master_id'] . "' ";
                }
            }
        } else {
            if (isset($params['master_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "master_id = '" . $params['master_id'] . "' ";
                } else {
                    $query_string = "master_id = '" . $params['master_id'] . "' ";
                }
            }
        }

        $opnh_data = $this->Ohmodel->get_openhouse_detail_data($query_string, $apikey);
        if (!empty($opnh_data) && is_array($opnh_data)) {
            return array('status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $opnh_data);
        } else {
            return array('status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

//    public function get_openhouse_detail_test($params = NULL) {
//        $apikey = $params['API_KEY'];
//        if (isset($params['master_id']) && !empty($params['master_id'])) {
//            $master_id = $params['master_id'];
//        } else {
//            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master ID is required', 'data' => FALSE);
//        }
//
//        $opnh_data = $this->Ohmodel->get_openhouse_detail_data($master_id, $apikey);
//        if (!empty($opnh_data) && is_array($opnh_data)) {
//            return array('status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $opnh_data);
//        } else {
//            return array('status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
//        }
//    }

    public function edit_openhouse($params = NULL) {
//         $dbparams = array();
        $apikey = $params['API_KEY'];

        if (isset($params['master_id']) && !empty($params['master_id'])) {
            $master_id = $params['master_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master ID is required', 'data' => FALSE);
        }
        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $start_date = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date is required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $end_date = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End date is required', 'data' => FALSE);
        }
        if (isset($params['no_temp_st']) && !empty($params['no_temp_st'])) {
            $no_temp_st = $params['no_temp_st'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Kit per student is required', 'data' => FALSE);
        }
        if (isset($params['description']) && !empty($params['description'])) {
            $description = $params['description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }
        if (isset($params['template_data']) && !empty($params['template_data'])) {
            $template_data_raw = $params['template_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'OH Template data is required', 'data' => FALSE);
        }
        if (isset($params['is_discount']) && !empty($params['is_discount'])) {
            $is_discount = $params['is_discount'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Discount is required', 'data' => FALSE);
        }
//return $template_data_raw;
        $template_data = json_decode($template_data_raw);

//        $xml_data = xml_generator($template_data);
        $xml_data = xml_generator($template_data);
//        dev_export($xml_data);die;
//        return $xml_data;
        $oh_data = $this->Ohmodel->edit_openhouse_details($apikey, $master_id, $start_date, $end_date, $no_temp_st, $description, $xml_data, $is_discount);
//                dev_export($oh_data[0]);die;
        if (!empty($oh_data) && is_array($oh_data) && $oh_data[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data edited successfully');
        } else if (!empty($oh_data) && is_array($oh_data) && $oh_data[0]['ErrorStatus'] == 2) {
            return array('data_status' => 2, 'error_status' => 0, 'message' => $oh_data[0]['ErrorMessage']);
        } else {
            if (is_array($oh_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $oh_data[0]['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function delete_openhouse($params = NULL) {
//         $dbparams = array();
        $apikey = $params['API_KEY'];

        if (isset($params['master_id']) && !empty($params['master_id'])) {
            $master_id = $params['master_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Master ID is required', 'data' => FALSE);
        }

        $oh_data = $this->Ohmodel->delete_openhouse_details($apikey, $master_id);
//                dev_export($oh_data[0]);die;
        if (!empty($oh_data) && is_array($oh_data) && $oh_data[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data deleted successfully');
        } else {
            if (is_array($oh_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $oh_data[0]['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function save_oh_item_assign($params = NULL) {
//         $dbparams = array();
        $apikey = $params['API_KEY'];

        if (isset($params['template_id']) && !empty($params['template_id'])) {
            $template_id = $params['template_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        }
        if (isset($params['total_qty']) && !empty($params['total_qty'])) {
            $total_qty = $params['total_qty'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Total quantity is required', 'data' => FALSE);
        }
        if (isset($params['sub_total']) && !empty($params['sub_total'])) {
            $sub_total = $params['sub_total'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Sub total is required', 'data' => FALSE);
        }
        if (isset($params['vat']) && !empty($params['vat'])) {

            if ($params['vat'] == -1) {
                $vat = 0;
            } else {
                $vat = $params['vat'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vat is required', 'data' => FALSE);
        }
        if (isset($params['discount']) && !empty($params['discount'])) {

            if ($params['discount'] == -1) {
                $discount = 0;
            } else {
                $discount = $params['discount'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Discount is required', 'data' => FALSE);
        }
        if (isset($params['final_itemdata']) && !empty($params['final_itemdata'])) {
            $final_itemdata_raw = $params['final_itemdata'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Final item data is required', 'data' => FALSE);
        }
        if (isset($params['finaltotal']) && !empty($params['finaltotal'])) {
            $finaltotal = $params['finaltotal'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Final total is required', 'data' => FALSE);
        }
        if (isset($params['discount_type']) && !empty($params['discount_type'])) {
            $discount_type = $params['discount_type'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Discount type is required', 'data' => FALSE);
        }
        if (isset($params['roundoff']) && !empty($params['roundoff'])) {
            if ($params['roundoff'] == -1) {
                $roundoff = 0;
            } else {
                $roundoff = $params['roundoff'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'RoundOff data is required', 'data' => FALSE);
        }

        $finaldata = json_decode($final_itemdata_raw);

        $xml_data = xml_generator($finaldata);
//        return $xml_data;
//        dev_export($xml_data);
//        die;
        $oh_data = $this->Ohmodel->save_oh_items_assigned($apikey, $template_id, $total_qty, $sub_total, $vat, $discount, $xml_data, $roundoff, $finaltotal, $discount_type);
//        dev_export($oh_data);die;

        if (!empty($oh_data) && is_array($oh_data) && $oh_data[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully');
        } else if (!empty($oh_data) && is_array($oh_data) && $oh_data[0]['ErrorStatus'] == 2) {
            return array('data_status' => 2, 'error_status' => 0, 'message' => $oh_data[0]['ErrorMessage']);
        } else {
            if (is_array($oh_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $oh_data[0]['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function get_oh_stud_assign_data($params = NULL) {
        $query_string = '';
        $apikey = $params['API_KEY'];
        $oh_data = array();
        $formatted_data = array();

        if (isset($params['openhouse_name']) && !empty($params['openhouse_name'])) {
            $query_string = " m.description LIKE '%" . $params['openhouse_name'] . "%' ";
        } else {
            $query_string = '';
        }

        $template_data = $this->Ohmodel->select_openhouse_detail_with_template($apikey);

        $oh_details = $this->Ohmodel->get_openhouse_master_data($query_string, $apikey);

        foreach ($oh_details as $oh) {
            foreach ($template_data as $templates) {
                if ($templates['master_id'] == $oh['id']) {
                    if (in_array($oh['id'], $oh_data)) {
                        $formatted_data[$oh['id']]['template_data'][] = $templates;
                    } else {
                        $formatted_data[$oh['id']]['oh_data'] = $oh;
                        $oh_data[] = $oh['id'];
                        $formatted_data[$oh['id']]['template_data'][] = $templates;
                    }
                }
            }
        }


        if (!empty($formatted_data) && is_array($formatted_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $formatted_data);
        } else {
            if (is_array($oh_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function select_item_oh_stud_assign($params = NULL) {

        $apikey = $params['API_KEY'];
        $master_data = array();
        $formatted_data = array();

        if (isset($params['template_id']) && !empty($params['template_id'])) {
            $template_id = $params['template_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        }
        if (isset($params['openhouse_id']) && !empty($params['openhouse_id'])) {
            $openhouse_id = $params['openhouse_id'];
        } else {
            $openhouse_id = 0;
        }

        $item_data = $this->Ohmodel->get_items_for_ohstud_assign($apikey, $template_id, $openhouse_id);
//        dev_export($item_data[0]['ErrorStatus']);die;
        $master_details = $this->Ohmodel->get_item_mapmaster($apikey, $template_id);


        if ($item_data[0]['ErrorStatus'] == 0) {
            foreach ($master_details as $master) {
                foreach ($item_data as $item) {
                    if ($item['item_map_master_id'] == $master['id']) {
                        if (in_array($master['id'], $master_data)) {
                            $formatted_data[$master['id']]['items_data'][] = $item;
                        } else {
                            $formatted_data[$master['id']]['master_data'] = $master;
                            $master_data[] = $master['id'];
                            $formatted_data[$master['id']]['items_data'][] = $item;
                        }
                    }
                }
            }
        }
// dev_export($item_data['ErrorMessage']);die;



        if (!empty($formatted_data) && is_array($formatted_data) && isset($formatted_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $formatted_data);
        } else {
            if (is_array($item_data)) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $item_data[0]['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data loaded', 'data' => FALSE);
            }
        }
    }

    public function get_stud_for_ohassign($params = NULL) {

        $apikey = $params['API_KEY'];
        $query_string = "";

        if (isset($params['class_id']) && !empty(isset($params['class_id'])) && $params['class_id'] != -1) {

            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " s.Cur_Class = '" . $params['class_id'] . "' ";
            } else {
                $query_string = " s.Cur_Class  = '" . $params['class_id'] . "'";
            }
        }
        if (isset($params['batch_id']) && !empty(isset($params['batch_id']))) {
            $batch_data_raw = $params['batch_id'];
            $batch_data = json_decode($batch_data_raw);
            $batch_ids = implode(",", $batch_data);
            if (isset($batch_ids) && !empty($batch_ids)) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " s.Cur_Batch  IN (  $batch_ids  ) ";
                } else {
                    $query_string = " s.Cur_Batch  IN (  $batch_ids  ) ";
                }
            }
        }

        if (isset($params['Session_ID']) && !empty($params['Session_ID'])) {
//                echo strlen($params['Session_ID']);die;
            if (strlen($query_string) > 0) {


                $query_string = $query_string . " AND " . " bd.Session_ID = '" . $params['Session_ID'] . "' ";
            } else {
                $query_string = " bd.Session_ID  = '" . $params['Session_ID'] . "'";
            }
        }
        if (isset($params['Stream_ID']) && !empty($params['Stream_ID'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " s.Cur_Stream = '" . $params['Stream_ID'] . "' ";
            } else {
                $query_string = " s.Cur_Stream  = '" . $params['Stream_ID'] . "'";
            }
        }
        if (isset($params['Acd_Year']) && !empty($params['Acd_Year'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " s.Cur_AcadYr = '" . $params['Acd_Year'] . "' ";
            } else {
                $query_string = " s.Cur_AcadYr  = '" . $params['Acd_Year'] . "'";
            }
        }
        if (isset($params['gender']) && !empty($params['gender'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " s.Sex = '" . $params['gender'] . "' ";
            } else {
                $query_string = " s.Sex  = '" . $params['gender'] . "'";
            }
        }
        if (isset($params['religion']) && !empty($params['religion'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " s.Religion = '" . $params['religion'] . "' ";
            } else {
                $query_string = " s.Religion  = '" . $params['religion'] . "'";
            }
        }
        if (isset($params['adminno']) && !empty($params['adminno'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " s.Admn_no LIKE '%" . $params['adminno'] . "%' ";
            } else {
                $query_string = " s.Admn_no LIKE '%" . $params['adminno'] . "%' ";
            }
        }



        $data = $this->Ohmodel->get_student_details($query_string, $apikey);
        if (!empty($data) && is_array($data)) {
            return array('status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $data);
        } else {
            return array('status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_oh_student_assign($params = NULL) {

        $apikey = $params['API_KEY'];


        if (isset($params['template_config_id']) && !empty($params['template_config_id'])) {
            $template_config_id = $params['template_config_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template Config ID is required', 'data' => FALSE);
        }
        if (isset($params['template_id']) && !empty($params['template_id'])) {
            $template_id = $params['template_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        }
        if (isset($params['student_data']) && !empty($params['student_data'])) {
            $student_data_raw = $params['student_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        }
        $student_data = json_decode($student_data_raw);

        $xml_data = xml_generator($student_data);
//        dev_export($xml_data);die;

        $item_data = $this->Ohmodel->save_oh_student_assign($apikey, $template_config_id, $template_id, $xml_data);


        if (!empty($item_data) && is_array($item_data) && isset($item_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $item_data);
        } else {
            if (is_array($item_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $item_data['message'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data loaded', 'data' => FALSE);
            }
        }
    }

    public function get_openhouse_discount($params = NULL) {

        $apikey = $params['API_KEY'];
        $data = $this->Ohmodel->is_openhouse_discount($apikey, $template_config_id, $template_id, $xml_data);


        if (!empty($data) && is_array($data) && isset($data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded successfully', 'data' => $data);
        } else {
            if (is_array($data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $data['message'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data loaded', 'data' => FALSE);
            }
        }
    }

}
