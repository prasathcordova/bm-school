<?php

/**
 * Description of Caste_controller
 *
 * @author Rahul.docme
 */
class Publisher_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Publisher_model', 'MPublisher');
    }

    public function get_publisher($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "p.isactive = " . $params['status'];
        }
        
         if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }

       if (strcasecmp($mode, "search") == 0) {
        if (isset($params['pub_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_id LIKE '%" . $params['id'] . "%' ";
            } else {
                $query_string = "p.pub_id LIKE '%" . $params['pub_id'] . "%' ";
            }
        }
        if (isset($params['pub_name'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_name LIKE '%" . $params['pub_name'] . "%' ";
            } else {
                $query_string = "p.pub_name LIKE '%" . $params['pub_name'] . "%' ";
            }
        }
        if (isset($params['pub_code'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_code LIKE '%" . $params['pub_code'] . "%' ";
            } else {
                $query_string = "p.pub_code LIKE '%" . $params['pub_code'] . "%' ";
            }
        }

        if (isset($params['pub_address1'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_address1 LIKE '%" . $params['pub_address1'] . "%' ";
            } else {
                $query_string = "p.pub_address1 LIKE '%" . $params['pub_address1'] . "%'";
            }
        }
        if (isset($params['pub_address2'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_address2 LIKE '%" . $params['pub_address2'] . "%' ";
            } else {
                $query_string = "p.pub_address2 LIKE '%" . $params['pub_address2'] . "%'";
            }
        }
        if (isset($params['pub_address2'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_address2 LIKE '%" . $params['pub_address2'] . "%' ";
            } else {
                $query_string = "p.pub_address2 LIKE '%" . $params['pub_address2'] . "%'";
            }
        }
        if (isset($params['pub_contact'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_contact LIKE '%" . $params['pub_contact'] . "%' ";
            } else {
                $query_string = "p.pub_contact LIKE '%" . $params['pub_contact'] . "%'";
            }
        }
        if (isset($params['pub_email'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_email LIKE '%" . $params['pub_email'] . "%' ";
            } else {
                $query_string = "p.pub_email LIKE '%" . $params['pub_email'] . "%'";
            }
        }
      }else if (strcasecmp($mode, "strict" == 0)) {
        if (isset($params['pub_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_id LIKE '%" . $params['id'] . "%' ";
            } else {
                $query_string = "p.pub_id LIKE '%" . $params['pub_id'] . "%' ";
            }
        }
        if (isset($params['pub_name'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_name LIKE '%" . $params['pub_name'] . "%' ";
            } else {
                $query_string = "p.pub_name LIKE '%" . $params['pub_name'] . "%' ";
            }
        }
        if (isset($params['pub_code'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_code LIKE '%" . $params['pub_code'] . "%' ";
            } else {
                $query_string = "p.pub_code LIKE '%" . $params['pub_code'] . "%' ";
            }
        }

        if (isset($params['pub_address1'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_address1 LIKE '%" . $params['pub_address1'] . "%' ";
            } else {
                $query_string = "p.pub_address1 LIKE '%" . $params['pub_address1'] . "%'";
            }
        }
        if (isset($params['pub_address2'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_address2 LIKE '%" . $params['pub_address2'] . "%' ";
            } else {
                $query_string = "p.pub_address2 LIKE '%" . $params['pub_address2'] . "%'";
            }
        }
        if (isset($params['pub_address2'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_address2 LIKE '%" . $params['pub_address2'] . "%' ";
            } else {
                $query_string = "p.pub_address2 LIKE '%" . $params['pub_address2'] . "%'";
            }
        }
        if (isset($params['pub_contact'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_contact LIKE '%" . $params['pub_contact'] . "%' ";
            } else {
                $query_string = "p.pub_contact LIKE '%" . $params['pub_contact'] . "%'";
            }
        }
        if (isset($params['pub_email'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "p.pub_email LIKE '%" . $params['pub_email'] . "%' ";
            } else {
                $query_string = "p.pub_email LIKE '%" . $params['pub_email'] . "%'";
            }
        }
       }
      
         $publisher_list = $this->MPublisher->get_publisher_details($apikey, $query_string);
//         dev_export($publisher_list);die;
        if (!empty($publisher_list) && is_array($publisher_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $publisher_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_publisher($params = NULL) { 
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['pub_name']) && !empty($params['pub_name'])) {
            $dbparams[1] = $params['pub_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Publisher Name is required', 'data' => FALSE);
        }
       
        if (isset($params['pub_code']) && !empty($params['pub_code'])) {
            $dbparams[2] = $params['pub_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Publisher Code  is required', 'data' => FALSE);
        }
         if (isset($params['pub_address1']) && !empty($params['pub_address1'])) {
            $dbparams[3] = $params['pub_address1'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address Line 1  is required', 'data' => FALSE);
        }
         if (isset($params['pub_address2']) && !empty($params['pub_address2'])) {
            $dbparams[4] = $params['pub_address2'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address Line 2  is required', 'data' => FALSE);
        }
         if (isset($params['pub_address3']) && !empty($params['pub_address3'])) {
            $dbparams[5] = $params['pub_address3'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Address Line 3  is required', 'data' => FALSE);
        }
         if (isset($params['pub_contact']) && !empty($params['pub_contact'])) {
            $dbparams[6] = $params['pub_contact'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Publisher Contact  is required', 'data' => FALSE);
        }
         if (isset($params['pub_email']) && !empty($params['pub_email'])) {
            $dbparams[7] = $params['pub_email'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Publisher  Email  is required', 'data' => FALSE);
        }
        $publisher_add_status = $this->MPublisher->add_new_publisher($dbparams);
        if (!empty($publisher_add_status) && is_array($publisher_add_status) && $publisher_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $publisher_add_status['pub_id']));
        } else {
            if (is_array($publisher_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $publisher_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_publisher($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['pub_id']) && !empty($params['pub_id'])) {
            $dbparams[1] = $params['pub_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Publisher ID is required', 'data' => FALSE);
        }
        if (isset($params['pub_name']) && !empty($params['pub_name'])) {
            $dbparams[2] = $params['pub_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Publisher Code is required', 'data' => FALSE);
        }
        if (isset($params['pub_code']) && !empty($params['pub_code'])) {
            $dbparams[3] = $params['pub_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Publisher Code is required', 'data' => FALSE);
        }
        if (isset($params['pub_address1']) && !empty($params['pub_address1'])) {
            $dbparams[4] = $params['pub_address1'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address Line 1 is required', 'data' => FALSE);
        }
        if (isset($params['pub_address2']) && !empty($params['pub_address2'])) {
            $dbparams[5] = $params['pub_address2'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address Line 2 is required', 'data' => FALSE);
        }
        if (isset($params['pub_address3']) && !empty($params['pub_address3'])) {
            $dbparams[6] = $params['pub_address3'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Address Line 3 is required', 'data' => FALSE);
        }
        if (isset($params['pub_contact']) && !empty($params['pub_contact'])) {
            $dbparams[7] = $params['pub_contact'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Contact required', 'data' => FALSE);
        }
        if (isset($params['pub_email']) && !empty($params['pub_email'])) {
            $dbparams[8] = $params['pub_email'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Email required', 'data' => FALSE);
        }
        $dbparams[9] = 1;
        $dbparams[10] = 0;
        
        $publisher_update_status = $this->MPublisher->publisher_update_date($dbparams);
        if (!empty($publisher_update_status) && is_array($publisher_update_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $publisher_update_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }
    
      public function modify_publisher_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['pub_id']) && !empty($params['pub_id'])) {
            $dbparams[1] = $params['pub_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Publisher ID is required', 'data' => FALSE);
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
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Publisher Status is required', 'data' => FALSE);
        }
        $publisher_update_status = $this->MPublisher->publisher_update_date($dbparams);
        if (!empty($publisher_update_status) && is_array($publisher_update_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $publisher_update_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }



}