<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pickup_point_controller
 *
 * @author chandrajith.edsys
 */
class Pickup_point_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pickup_point_model', 'MPickPoint');
    }
    public function get_pickuppoint($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        $fee_condition = 0;
        if (isset($params['status'])) {
            $query_string = "c.isActive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['pickpointName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.pickpointName LIKE '%" . $params['pickpointName'] . "%' ";
                } else {
                    $query_string = "c.pickpointName LIKE '%" . $params['pickpointName'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0) || strcasecmp($mode, "fee") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['inst_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.instId = '" . $params['inst_id'] . "' ";
                } else {
                    $query_string = "c.instId = '" . $params['inst_id'] . "' ";
                }
            }
            if (isset($params['pickpointName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.pickpointName = '" . $params['pickpointName'] . "' ";
                } else {
                    $query_string = "c.pickpointName = '" . $params['pickpointName'] . "' ";
                }
            }
            if (isset($params['acdYearId'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "f.acdYearId = '" . $params['acdYearId'] . "' ";
                } else {
                    $query_string = "f.acdYearId = '" . $params['acdYearId'] . "' ";
                }
            }
            if ($mode == "fee")
                $fee_condition = 1;
        }

        $pickuppoint_list = $this->MPickPoint->get_pickuppoint_details($apikey, $query_string, $fee_condition);

        if (!empty($pickuppoint_list) && is_array($pickuppoint_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pickuppoint_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_pickpoint_feez($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['route_id']) && !empty($params['route_id'])) {
            $dbparams[1] = $params['route_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Id is required', 'data' => FALSE);
        }
        if (isset($params['fee_set']) && !empty($params['fee_set'])) {
            $dbparams[2] = $params['fee_set'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fees Entity Id is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }
        if (isset($params['acdyr']) && !empty($params['acdyr'])) {
            $dbparams[4] = $params['acdyr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year Id is required', 'data' => FALSE);
        }

        $staff_list = $this->MPickPoint->get_pickfee_details($dbparams);
        if (!empty($staff_list) && is_array($staff_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $staff_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_pickuppoint($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['pickpointName']) && !empty($params['pickpointName'])) {
            $dbparams[2] = $params['pickpointName'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Name is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointDescription']) && !empty($params['pickuppointDescription'])) {
            $dbparams[3] = $params['pickuppointDescription'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Description is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointLocation']) && !empty($params['pickuppointLocation'])) {
            $dbparams[4] = $params['pickuppointLocation'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Description is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointLatitude']) && !empty($params['pickuppointLatitude'])) {
            $dbparams[5] = $params['pickuppointLatitude'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Description is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointLongitude']) && !empty($params['pickuppointLongitude'])) {
            $dbparams[6] = $params['pickuppointLongitude'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Description is required', 'data' => FALSE);
        }



        $pickuppoint_add_status = $this->MPickPoint->add_new_pickup_point($dbparams);
        if (!empty($pickuppoint_add_status) && is_array($pickuppoint_add_status) && $pickuppoint_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $pickuppoint_add_status['id']));
        } else {
            if (is_array($pickuppoint_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $pickuppoint_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function update_pickuppoint($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = intval($params['id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Id is required', 'data' => FALSE);
        }
        if (isset($params['pickpointName']) && !empty($params['pickpointName'])) {
            $dbparams[2] = $params['pickpointName'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Name is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointDescription']) && !empty($params['pickuppointDescription'])) {
            $dbparams[3] = $params['pickuppointDescription'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Description is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointLocation']) && !empty($params['pickuppointLocation'])) {
            $dbparams[4] = $params['pickuppointLocation'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Location is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointLatitude']) && !empty($params['pickuppointLatitude'])) {
            $dbparams[5] = $params['pickuppointLatitude'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Latitude is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointLongitude']) && !empty($params['pickuppointLongitude'])) {
            $dbparams[6] = $params['pickuppointLongitude'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Logitude is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[7] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }



        $dbparams[8] = 1;
        $dbparams[9] = 0;
        $pickuppoint_update_status = $this->MPickPoint->update_pickuppoint($dbparams);

        if (!empty($pickuppoint_update_status) && is_array($pickuppoint_update_status) && isset($pickuppoint_update_status['ErrorStatus']) && $pickuppoint_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $pickuppoint_update_status);
        } else {
            if (isset($pickuppoint_update_status['ErrorMessage']) && !empty($pickuppoint_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $pickuppoint_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
    public function modify_pickuppoint_status($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = NULL;
        $dbparams[7] = NULL;
        $dbparams[8] = 0;
        //         dev_export($params['status']);
        //         dev_export($dbparams);die;
        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[9] = 0;
            } else {
                $dbparams[9] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle  code Status is required', 'data' => FALSE);
        }
        $pickuppoint_modify_status = $this->MPickPoint->update_pickuppoint($dbparams);
        if (!empty($pickuppoint_modify_status['ErrorStatus']) && is_array($pickuppoint_modify_status) && $pickuppoint_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $pickuppoint_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $pickuppoint_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
}
