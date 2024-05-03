<?php

/**
 * Class Name   : General_settings_controller
 * Description  : Manipulate supplier data section 
 * @author      : Docme
 * Created On   : 14-sept-2017
 * 
 */
class Suppliers_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Suppliers_model', 'MSuppliers');
    }

    public function get_suppliers($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "s.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.id LIKE '%" . $params['id'] . "%' ";
                } else {
                    $query_string = "s.id LIKE '%" . $params['id'] . "%' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.name LIKE '%" . $params['name'] . "%' ";
                } else {
                    $query_string = "s.name LIKE '%" . $params['name'] . "%' ";
                }
            }
            if (isset($params['code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.code LIKE '%" . $params['code'] . "%' ";
                } else {
                    $query_string = "s.code LIKE '%" . $params['code'] . "%' ";
                }
            }
            if (isset($params['address1'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.address1 LIKE '%" . $params['address1'] . "%' ";
                } else {
                    $query_string = "s.address1 LIKE '%" . $params['address1'] . "%' ";
                }
            }
            if (isset($params['address2'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.address2 LIKE '%" . $params['address2'] . "%' ";
                } else {
                    $query_string = "s.address2 LIKE '%" . $params['address2'] . "%' ";
                }
            }
            if (isset($params['address3'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.address3 LIKE '%" . $params['address3'] . "%' ";
                } else {
                    $query_string = "s.address3 LIKE '%" . $params['address3'] . "%' ";
                }
            }
            if (isset($params['contact'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.contact LIKE '%" . $params['contact'] . "%' ";
                } else {
                    $query_string = "s.contact LIKE '%" . $params['contact'] . "%' ";
                }
            }
            if (isset($params['emailid'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.emailid LIKE '%" . $params['emailid'] . "%' ";
                } else {
                    $query_string = "s.emailid LIKE '%" . $params['emailid'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "s.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.name = '" . $params['name'] . "' ";
                } else {
                    $query_string = "s.name = '" . $params['name'] . "' ";
                }
            }
            if (isset($params['code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.code = '" . $params['code'] . "' ";
                } else {
                    $query_string = "s.code = '" . $params['code'] . "' ";
                }
            }
            if (isset($params['address1'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.address1 = '" . $params['address1'] . "' ";
                } else {
                    $query_string = "s.address1 = '" . $params['address1'] . "' ";
                }
            }
            if (isset($params['address2'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.address2 = '" . $params['address2'] . "' ";
                } else {
                    $query_string = "s.address2 = '" . $params['address2'] . "' ";
                }
            }
            if (isset($params['address3'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.address3 = '" . $params['address3'] . "' ";
                } else {
                    $query_string = "s.address3 = '" . $params['address3'] . "' ";
                }
            }
            if (isset($params['contact'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.contact = '" . $params['contact'] . "' ";
                } else {
                    $query_string = "s.contact = '" . $params['contact'] . "' ";
                }
            }
            if (isset($params['emailid'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.emailid = '" . $params['emailid'] . "' ";
                } else {
                    $query_string = "s.emailid = '" . $params['emailid'] . "' ";
                }
            }
        }


        $suppliers_list = $this->MSuppliers->get_suppliers_details($apikey, $query_string);
        if (!empty($suppliers_list) && is_array($suppliers_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $suppliers_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_suppliers($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['name']) && !empty($params['name'])) {
            $dbparams[1] = $params['name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Supplier Name is required', 'data' => FALSE);
        }
        if (isset($params['code']) && !empty($params['code'])) {
            $dbparams[2] = $params['code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Supplier code is required', 'data' => FALSE);
        }
        if (isset($params['address1']) && !empty($params['address1'])) {
            $dbparams[3] = $params['address1'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address1  is required', 'data' => FALSE);
        }
        if (isset($params['address2']) && !empty($params['address2'])) {
            $dbparams[4] = $params['address2'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address2  is required', 'data' => FALSE);
        }
        if (isset($params['address3']) && !empty($params['address3'])) {
            $dbparams[5] = $params['address3'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address3  is required', 'data' => FALSE);
        }
        if (isset($params['contact']) && !empty($params['contact'])) {
            $dbparams[6] = $params['contact'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Contact details is required', 'data' => FALSE);
        }
        if (isset($params['emailid']) && !empty($params['emailid'])) {
            $dbparams[7] = $params['emailid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Email Id  is required', 'data' => FALSE);
        }
        $suppliers_add_status = $this->MSuppliers->add_new_suppliers($dbparams);
        if (!empty($suppliers_add_status) && is_array($suppliers_add_status) && $suppliers_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $suppliers_add_status['id']));
        } else {
            if (is_array($suppliers_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $suppliers_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_suppliers($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['s_id']) && !empty($params['s_id'])) {
            $dbparams[1] = $params['s_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Supplier ID is required', 'data' => FALSE);
        }
        if (isset($params['name']) && !empty($params['name'])) {
            $dbparams[2] = $params['name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Supplier Name is required', 'data' => FALSE);
        }
        if (isset($params['code']) && !empty($params['code'])) {
            $dbparams[3] = $params['code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Supplier Code is required', 'data' => FALSE);
        }
        if (isset($params['address1']) && !empty($params['address1'])) {
            $dbparams[4] = $params['address1'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address1 is required', 'data' => FALSE);
        }
        if (isset($params['address2']) && !empty($params['address2'])) {
            $dbparams[5] = $params['address2'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address2 is required', 'data' => FALSE);
        }
        if (isset($params['address3']) && !empty($params['address3'])) {
            $dbparams[6] = $params['address3'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address3 is required', 'data' => FALSE);
        }
        if (isset($params['contact']) && !empty($params['contact'])) {
            $dbparams[7] = $params['contact'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Contact details is required', 'data' => FALSE);
        }
        if (isset($params['emailid']) && !empty($params['emailid'])) {
            $dbparams[8] = $params['emailid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Email Id is required', 'data' => FALSE);
        }
        $dbparams[9] = 1;
        $dbparams[10] = 0;
        $suppliers_add_status = $this->MSuppliers->update_suppliers_data($dbparams);
        if (!empty($suppliers_add_status) && is_array($suppliers_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $suppliers_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }

    public function modify_suppliers_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Supplier ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = NULL;
        $dbparams[7] = NULL;
        $dbparams[8] = NULL;
        $dbparams[9] = 0;

        if (isset($params['status'])) {
            $dbparams[10] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Supplier Status is required', 'data' => FALSE);
        }

        $suppliers_add_status = $this->MSuppliers->update_suppliers_data($dbparams);
        if (!empty($suppliers_add_status) && is_array($suppliers_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $suppliers_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }

}
