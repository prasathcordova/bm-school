<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trip_controller
 *
 * @author chandrajith.edsys
 */
class Trip_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Trip_model', 'MVt');
    }

    public function get_trip($params = NULL)
    {

        $apikey = $params['API_KEY'];
        $query_string = "";
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
            if (isset($params['tripName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.tripName LIKE '%" . $params['tripName'] . "%' ";
                } else {
                    $query_string = "c.tripName LIKE '%" . $params['tripName'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict") == 0) {
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
            if (isset($params['tripName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.tripName = '" . $params['tripName'] . "' ";
                } else {
                    $query_string = "c.tripName = '" . $params['tripName'] . "' ";
                }
            }
        }
        // return $query_string;

        $vehicletrip_list = $this->MVt->get_vehicletrip($apikey, $query_string);

        if (!empty($vehicletrip_list) && is_array($vehicletrip_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicletrip_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_trip_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['tripId']) && !empty($params['tripId'])) {
            $dbparams[1] = $params['tripId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip ID is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $vehicletrip_list = $this->MVt->get_trip_all_details($dbparams);
        if (!empty($vehicletrip_list) && is_array($vehicletrip_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicletrip_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_trip_allotment($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['routeid']) && !empty($params['routeid'])) {
            $dbparams[1] = $params['routeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Name is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $vehicletrip_list = $this->MVt->get_vehicletrip_allotment($dbparams);
        if (!empty($vehicletrip_list) && is_array($vehicletrip_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicletrip_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_trip_pickuppoint_relation_data($params = NULL)
    {

        $dbparams = array();
        //return $params;
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['tripId']) && !empty($params['tripId'])) {
            $dbparams[1] = $params['tripId'];
        } else {
            $dbparams[1] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id Name is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointId']) && !empty($params['pickuppointId'])) {
            $dbparams[2] = $params['pickuppointId'];
        } else {
            $dbparams[2] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Id. details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        //return $dbparams;
        $pickuppoint_relation_data = $this->MVt->get_trip_pickuppoint_relation_data($dbparams);
        if (!empty($pickuppoint_relation_data) && is_array($pickuppoint_relation_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pickuppoint_relation_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_trip($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['tripName']) && !empty($params['tripName'])) {
            $dbparams[1] = $params['tripName'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Name is required', 'data' => FALSE);
        }
        if (isset($params['tripCode']) && !empty($params['tripCode'])) {
            $dbparams[2] = $params['tripCode'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Code is required', 'data' => FALSE);
        }

        if (isset($params['tripDescription']) && !empty($params['tripDescription'])) {
            $dbparams[3] = $params['tripDescription'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Description is required', 'data' => FALSE);
        }
        if (isset($params['pickStartTime']) && !empty($params['pickStartTime'])) {
            $dbparams[4] = $params['pickStartTime'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start time for Pickup is required', 'data' => FALSE);
        }
        if (isset($params['pickEndTime']) && !empty($params['pickEndTime'])) {
            $dbparams[5] = $params['pickEndTime'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End time for Pickup is required', 'data' => FALSE);
        }
        if (isset($params['dropStartTime']) && !empty($params['dropStartTime'])) {
            $dbparams[6] = $params['dropStartTime'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start time for Drop is required', 'data' => FALSE);
        }
        if (isset($params['dropEndTime']) && !empty($params['dropEndTime'])) {
            $dbparams[7] = $params['dropEndTime'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End time for Drop is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[8] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        //return $dbparams;
        $vehicletrip_add_status = $this->MVt->add_new_trip($dbparams);
        if (!empty($vehicletrip_add_status) && is_array($vehicletrip_add_status) && $vehicletrip_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $vehicletrip_add_status['id']));
        } else {
            if (is_array($vehicletrip_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $vehicletrip_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }


    public function save_trip_pickpoint_relation($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Name is required', 'data' => FALSE);
        }
        if (isset($params['tripId']) && !empty($params['tripId'])) {
            $dbparams[2] = $params['tripId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip ID is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointId']) && !empty($params['pickuppointId'])) {
            $dbparams[3] = $params['pickuppointId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start time for Pickup is required', 'data' => FALSE);
        }
        if (isset($params['droptime']) && !empty($params['droptime'])) {
            $dbparams[4] = $params['droptime'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End time for Pickup is required', 'data' => FALSE);
        }
        if (isset($params['pickuptime']) && !empty($params['pickuptime'])) {
            $dbparams[5] = $params['pickuptime'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start time for Drop is required', 'data' => FALSE);
        }
        if (isset($params['update_type']) && !empty($params['update_type'])) {
            $dbparams[6] = $params['update_type'];
        } else {
            $dbparams[6] = NULL;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start time for Drop is required', 'data' => FALSE);
        }

        //return $dbparams;
        $trip_pickup_rel_add_status = $this->MVt->add_new_trip_pickpoint_relation($dbparams);
        if (!empty($vehicletrip_add_status) && is_array($trip_pickup_rel_add_status) && $trip_pickup_rel_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $trip_pickup_rel_add_status['id']));
        } else {
            if (is_array($trip_pickup_rel_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $trip_pickup_rel_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function save_trip_edit($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['tripId']) && !empty($params['tripId'])) {
            $dbparams[1] = $params['tripId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ID is required', 'data' => FALSE);
        }
        if (isset($params['tripName']) && !empty($params['tripName'])) {
            $dbparams[2] = $params['tripName'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Name is required', 'data' => FALSE);
        }
        if (isset($params['tripCode']) && !empty($params['tripCode'])) {
            $dbparams[3] = $params['tripCode'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Code is required', 'data' => FALSE);
        }
        if (isset($params['tripDescription']) && !empty($params['tripDescription'])) {
            $dbparams[4] = $params['tripDescription'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Description is required', 'data' => FALSE);
        }
        if (isset($params['pickStartTime']) && !empty($params['pickStartTime'])) {
            $dbparams[5] = $params['pickStartTime'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'PickStarttime is required', 'data' => FALSE);
        }
        if (isset($params['pickEndTime']) && !empty($params['pickEndTime'])) {
            $dbparams[6] = $params['pickEndTime'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'PickEndtime is required', 'data' => FALSE);
        }
        if (isset($params['dropStartTime']) && !empty($params['dropStartTime'])) {
            $dbparams[7] = $params['dropStartTime'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Drop Startime is required', 'data' => FALSE);
        }
        if (isset($params['dropEndTime']) && !empty($params['dropEndTime'])) {
            $dbparams[8] = $params['dropEndTime'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Drop End time is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[9] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst ID is required', 'data' => FALSE);
        }

        $dbparams[10] = 1;  //flag;
        $dbparams[11] = 1;


        $trip_modify_status = $this->MVt->update_trip($dbparams);
        if (!empty($trip_modify_status['ErrorStatus']) && is_array($trip_modify_status) && $trip_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $trip_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $trip_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }

    public function modify_trip_status($params = NULL)
    {

        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['tripId']) && !empty($params['tripId'])) {
            $dbparams[1] = $params['tripId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = NULL;
        $dbparams[7] = NULL;
        $dbparams[8] = NULL;
        $dbparams[9] = NULL;
        $dbparams[10] = 0;
        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[11] = 0;
            } else {
                $dbparams[11] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Status is required', 'data' => FALSE);
        }

        $trip_modify_status = $this->MVt->update_trip($dbparams);
        if (!empty($trip_modify_status['ErrorStatus']) && is_array($trip_modify_status) && $trip_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $trip_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $trip_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }


    public function get_app_trip_default_vehicle($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isActive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['inst_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.instId = '" . $params['inst_id'] . "' ";
                } else {
                    $query_string = "c.instId = '" . $params['inst_id'] . "' ";
                }
            }
        }

        if (isset($params['default_trip']) && !empty($params['default_trip']) && $params['default_trip'] == 1) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . " tvm.vehicleId = '" . $params['vehicle_id'] . "' ";
            } else {
                $query_string = " tvm.vehicleId = '" . $params['vehicle_id'] . "' ";
            }
        }
        if (isset($params['page']) && !empty($params['page']) && isset($params['limit']) && !empty($params['limit'])) {
            $offset_value = (($params['page'] - 1) * $params['limit']);
            $limit = $params['limit'];
            $offset_string = " OFFSET $offset_value ROWS FETCH NEXT $limit ROWS ONLY";
        }
        $vehicletrip_list = $this->MVt->get_vehicletrip($apikey, $query_string, $offset_string);
        $i = 0;
        $updated_data_array = [];
        $current_time = strtotime(date("H:i"));
        foreach ($vehicletrip_list as $data) {

            $updated_data_array[$i] = $data;
            $pick_time = strtotime($data['pickStartTime']);
            $drop_time = strtotime($data['dropStartTime']);
            $pick_time_difference = round(abs($current_time - $pick_time) / 60, 2);
            $drop_time_difference = round(abs($current_time - $drop_time) / 60, 2);
            if ($pick_time_difference < 30) {
                //$pickpoint_data[$data['tripId']]['is_pick'] = 1;
                $updated_data_array[$i]['startingpointtime'] = date('g:i a', strtotime($data['pickStartTime']));
                $updated_data_array[$i]['endingpointtime'] = date('g:i a', strtotime($data['pickEndTime']));
            } else if ($drop_time_difference < 30) {
                //$pickpoint_data[$data['tripId']]['is_drop'] = 1;
                $updated_data_array[$i]['startingpointtime'] = date('g:i a', strtotime($data['dropStartTime']));
                $updated_data_array[$i]['endingpointtime'] = date('g:i a', strtotime($data['dropEndTime']));
            } else if ($drop_time_difference < $pick_time_difference) {
                //$pickpoint_data[$data['tripId']]['is_drop'] = 1;
                $updated_data_array[$i]['startingpointtime'] = date('g:i a', strtotime($data['dropStartTime']));
                $updated_data_array[$i]['endingpointtime'] = date('g:i a', strtotime($data['dropEndTime']));
            } else {
                $pickpoint_data[$data['tripId']]['is_pick'] = 1;
                $updated_data_array[$i]['startingpointtime'] = date('g:i a', strtotime($data['pickStartTime']));
                $updated_data_array[$i]['endingpointtime'] = date('g:i a', strtotime($data['pickEndTime']));
            }


            $updated_data_array[$i]['startingpoint'] = 'Starting Point';
            $updated_data_array[$i]['endingpoint'] = 'Ending Point';
            if ($data['vehicle_id'] == $params['vehicle_id']) {
                $updated_data_array[$i]['default_trip'] = 1;
            } else {
                $updated_data_array[$i]['default_trip'] = 0;
            }

            $i++;
        }
        $vehicletrip_list = $updated_data_array;
        array_multisort(array_column($vehicletrip_list, 'default_trip'), SORT_DESC, $vehicletrip_list);
        if (!empty($vehicletrip_list) && is_array($vehicletrip_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicletrip_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }


    public function get_all_student_transport_app_data($params)
    {
        $dbparams = array();
        //return $params;
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['tripId']) && !empty($params['tripId'])) {
            $dbparams[1] = $params['tripId'];
        } else {
            $dbparams[1] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id Name is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointId']) && !empty($params['pickuppointId'])) {
            $dbparams[2] = $params['pickuppointId'];
        } else {
            $dbparams[2] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Id. details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $this->load->model('Trip_model', 'MVt');
        $pickuppoint_relation_data = $this->MVt->get_trip_pickuppoint_relation_data($dbparams);
        $pickpoint_data = [];
        $current_time = strtotime(date("H:i"));
        foreach ($pickuppoint_relation_data as $pick_data) {
            $pick_time = strtotime($pick_data['pickStartTime']);
            $drop_time = strtotime($pick_data['dropStartTime']);
            $pick_time_difference = round(abs($current_time - $pick_time) / 60, 2);
            $drop_time_difference = round(abs($current_time - $drop_time) / 60, 2);
            if ($pick_time_difference < 30) {
                $pickpoint_data[$pick_data['tripId']]['is_pick'] = 1;
            } else if ($drop_time_difference < 30) {
                $pickpoint_data[$pick_data['tripId']]['is_drop'] = 1;
            } else if ($drop_time_difference < $pick_time_difference) {
                $pickpoint_data[$pick_data['tripId']]['is_drop'] = 1;
            } else {
                $pickpoint_data[$pick_data['tripId']]['is_pick'] = 1;
            }

            $pickpoint_data[$pick_data['tripId']]['pickStartTime'] = $pick_data['pickStartTime'];
            $pickpoint_data[$pick_data['tripId']]['pickEndTime'] = $pick_data['pickEndTime'];
            $pickpoint_data[$pick_data['tripId']]['dropStartTime'] = $pick_data['dropStartTime'];
            $pickpoint_data[$pick_data['tripId']]['dropEndTime'] = $pick_data['dropEndTime'];
            $pickpoint_data[$pick_data['tripId']][$pick_data['pickupPointId']]['pickuptime'] = $pick_data['pickuptime'];
            $pickpoint_data[$pick_data['tripId']][$pick_data['pickupPointId']]['droptime'] = $pick_data['droptime'];
        }

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $params['acd_year_id'] = -1;
        if (isset($params['acd_year_id']) && !empty($params['acd_year_id'])) {
            $dbparams[1] = $params['acd_year_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst is required', 'data' => FALSE);
        }
        if (isset($params['tripId']) && !empty($params['tripId'])) {
            $trip_id = $params['tripId'];
            $query = " and (pt.id=$trip_id OR dt.id=$trip_id)";
            $dbparams[3] = $query;
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id is required', 'data' => FALSE);
        }
        $this->load->model('Passenger_student_model', 'Mps');
        $data_list = $this->Mps->get_all_student_allocation_details($dbparams);
        //return $data_list;
        if (!empty($data_list)) {
            //$data['user_name'] = $this->session->userdata('user_name');
            foreach ($data_list as $rpt_data) {
                //$end_date_value = $rpt_data['transportEndDate'] == '' ? date('d/m/Y', strtotime($this->session->userdata('lock_end_date'))) : date('d/m/Y', strtotime($rpt_data['transportEndDate']));
                if ($rpt_data['pickTripId'] != 0 && ($rpt_data['pickTripId'] == $trip_id || $trip_id == "ALL")) {
                    $formatted_allocation_data[$rpt_data['pickTripId']]['trip_id'] = $rpt_data['pickTripId'];
                    $formatted_allocation_data[$rpt_data['pickTripId']]['trip_name'] = $rpt_data['pickup_tripName'];

                    if ($rpt_data['pickStopId'] != 0 && $pickpoint_data[$rpt_data['pickTripId']]['is_pick'] == 1) { //&& $pickpoint_data[$rpt_data['pickTripId']]['is_pick'] == 1
                        $formatted_allocation_data[$rpt_data['pickTripId']]['trip_details'][$rpt_data['pickStopId']]['pickpointid'] = $rpt_data['pickStopId'];
                        $formatted_allocation_data[$rpt_data['pickTripId']]['trip_details'][$rpt_data['pickStopId']]['pickpointName'] = $rpt_data['pickup_pickpointName'];
                        $formatted_allocation_data[$rpt_data['pickTripId']]['trip_details'][$rpt_data['pickStopId']]['time'] = date('g:i a', strtotime($pickpoint_data[$rpt_data['pickTripId']][$rpt_data['pickStopId']]['pickuptime']));
                        $formatted_allocation_data[$rpt_data['pickTripId']]['trip_details'][$rpt_data['pickStopId']]['details']['Pickup']['student_data'][$rpt_data['student_id']]['student_name'] = $rpt_data['student_name'];
                        $formatted_allocation_data[$rpt_data['pickTripId']]['trip_details'][$rpt_data['pickStopId']]['details']['Pickup']['student_data'][$rpt_data['student_id']]['Admn_No'] = $rpt_data['Admn_No'];
                        $formatted_allocation_data[$rpt_data['pickTripId']]['trip_details'][$rpt_data['pickStopId']]['details']['Pickup']['student_data'][$rpt_data['student_id']]['class_name'] = $rpt_data['class_name'];
                        $formatted_allocation_data[$rpt_data['pickTripId']]['trip_details'][$rpt_data['pickStopId']]['details']['Pickup']['student_data'][$rpt_data['student_id']]['student_id'] = $rpt_data['student_id'];
                        $formatted_allocation_data[$rpt_data['pickTripId']]['trip_details'][$rpt_data['pickStopId']]['details']['Pickup']['student_data'][$rpt_data['student_id']]['travel_status'] = $rpt_data['pickup_status'];
                        $formatted_allocation_data[$rpt_data['pickTripId']]['trip_details'][$rpt_data['pickStopId']]['details']['Pickup']['student_data'][$rpt_data['student_id']]['travel_date'] = $rpt_data['pickup_time'];
                        $formatted_allocation_data[$rpt_data['pickTripId']]['trip_details'][$rpt_data['pickStopId']]['details']['Pickup']['student_data'][$rpt_data['student_id']]['travel_type'] = 'P';
                        //$formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data'][$rpt_data['student_id']]['transport_dates'] = date('d/m/Y', strtotime($rpt_data['transportStartDate'])) . ' to ' . $end_date_value;
                        // $size_pick = sizeof($formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['student_data']);
                        // $size['stop_span'][$rpt_data['pickTripId']]['Pickup'][$rpt_data['pickStopId']] = $size_pick;
                        //$formatted_allocation_data[$rpt_data['pickTripId']]['travel_type']['Pickup'][$rpt_data['pickStopId']]['travel_type_span'] = $size_pick;
                    }
                }
                if ($rpt_data['dropTripId'] != 0 && ($rpt_data['dropTripId'] == $trip_id || $trip_id == "ALL")) {
                    $formatted_allocation_data[$rpt_data['dropTripId']]['trip_id'] = $rpt_data['dropTripId'];
                    $formatted_allocation_data[$rpt_data['dropTripId']]['trip_name'] = $rpt_data['drop_tripName'];
                    if ($rpt_data['dropStopId'] != 0 && $pickpoint_data[$rpt_data['pickTripId']]['is_drop'] == 1 &&  ($rpt_data['drop_status'] == 'PS' || $rpt_data['drop_status'] == 'D')) { //&& $pickpoint_data[$rpt_data['pickTripId']]['is_drop'] == 1
                        $formatted_allocation_data[$rpt_data['dropTripId']]['trip_details'][$rpt_data['dropStopId']]['pickpointid'] = $rpt_data['dropStopId'];
                        $formatted_allocation_data[$rpt_data['dropTripId']]['trip_details'][$rpt_data['dropStopId']]['pickpointName'] = $rpt_data['drop_pickupName'];
                        $formatted_allocation_data[$rpt_data['dropTripId']]['trip_details'][$rpt_data['dropStopId']]['time'] = date('g:i a', strtotime($pickpoint_data[$rpt_data['dropTripId']][$rpt_data['dropStopId']]['droptime']));
                        $formatted_allocation_data[$rpt_data['dropTripId']]['trip_details'][$rpt_data['dropStopId']]['details']['Drop']['student_data'][$rpt_data['student_id']]['student_name'] = $rpt_data['student_name'];
                        $formatted_allocation_data[$rpt_data['dropTripId']]['trip_details'][$rpt_data['dropStopId']]['details']['Drop']['student_data'][$rpt_data['student_id']]['Admn_No'] = $rpt_data['Admn_No'];
                        $formatted_allocation_data[$rpt_data['dropTripId']]['trip_details'][$rpt_data['dropStopId']]['details']['Drop']['student_data'][$rpt_data['student_id']]['class_name'] = $rpt_data['class_name'];
                        $formatted_allocation_data[$rpt_data['dropTripId']]['trip_details'][$rpt_data['dropStopId']]['details']['Drop']['student_data'][$rpt_data['student_id']]['student_id'] = $rpt_data['student_id'];
                        $formatted_allocation_data[$rpt_data['dropTripId']]['trip_details'][$rpt_data['dropStopId']]['details']['Drop']['student_data'][$rpt_data['student_id']]['travel_status'] = $rpt_data['drop_status'];
                        $formatted_allocation_data[$rpt_data['dropTripId']]['trip_details'][$rpt_data['dropStopId']]['details']['Drop']['student_data'][$rpt_data['student_id']]['travel_date'] = $rpt_data['drop_time'];
                        $formatted_allocation_data[$rpt_data['dropTripId']]['trip_details'][$rpt_data['dropStopId']]['details']['Drop']['student_data'][$rpt_data['student_id']]['travel_type'] = 'D';
                        // $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data'][$rpt_data['student_id']]['transport_dates'] = date('d/m/Y', strtotime($rpt_data['transportStartDate'])) . ' to ' . $end_date_value;
                        // $size_drop = sizeof($formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data']);
                        // $size['stop_span'][$rpt_data['dropTripId']]['Drop'][$rpt_data['dropStopId']] = $size_drop;
                        //$formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['travel_type_span'] = $size_drop;
                    }
                }
                //$total_row_count++;
            }
        }

        //Removing the Keys in Json Format Start

        foreach ($formatted_allocation_data as $data) {
            $allocation_data['trip_id'] =  $data['trip_id'];
            $allocation_data['trip_name'] =  $data['trip_name'];
            //$tallocation_data['trip_details'] =  array_values($data['trip_details']);
            $s_allocation_data = [];
            $part_data = [];
            $i = 0;
            foreach ($data['trip_details'] as $i_data) {
                $part_data = [];
                $s_allocation_data[$i]['pickpointid'] = $i_data['pickpointid'];
                $s_allocation_data[$i]['pickpointName'] = $i_data['pickpointName'];
                $s_allocation_data[$i]['time'] = $i_data['time'];
                foreach ($i_data as $s_data) {
                    $part_data_array_p = [];
                    $part_data_array_d = [];
                    if (!empty($s_data['Drop']['student_data']))
                        $part_data_array_p = array_values($s_data['Drop']['student_data']);
                    if (!empty($s_data['Pickup']['student_data']))
                        $part_data_array_d = array_values($s_data['Pickup']['student_data']);
                    $part_data = array_merge($part_data_array_p, $part_data_array_d);
                }
                if (sizeof($part_data) != 0)
                    $s_allocation_data[$i]['details'] = $part_data;
                $i++;
            }

            $allocation_data['trip_details'] = $s_allocation_data;
        }

        //Removing the Keys in Json Format END


        if (!empty($allocation_data) && is_array($allocation_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $allocation_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function update_student_trip_status($params = NULL)
    {
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['trip_id']) && !empty($params['trip_id'])) {
            $dbparams[1] = $params['trip_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id is required', 'data' => FALSE);
        }
        if (isset($params['pickuppoint_id']) && !empty($params['pickuppoint_id'])) {
            $dbparams[2] = $params['pickuppoint_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Id is required', 'data' => FALSE);
        }
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            if (is_array($params['student_id'])) {
                $dbparams[3] = json_encode($params['student_id']);
            } else {
                $dbparams[3] = json_encode([$params['student_id']]);
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student Id is required', 'data' => FALSE);
        }
        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[4] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id is required', 'data' => FALSE);
        }
        if (isset($params['trip_action']) && !empty($params['trip_action'])) {
            $dbparams[5] = $params['trip_action'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Travel Type is required', 'data' => FALSE);
        }
        if (isset($params['updated_time']) && !empty($params['updated_time'])) {
            $dbparams[6] = $params['updated_time'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Update time is required', 'data' => FALSE);
        }
        if (isset($params['latitude']) && !empty($params['latitude'])) {
            $dbparams[7] = $params['latitude'];
        } else {
            $dbparams[7] = NULL;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Latitude is required', 'data' => FALSE);
        }
        if (isset($params['longitude']) && !empty($params['longitude'])) {
            $dbparams[8] = $params['longitude'];
        } else {
            $dbparams[8] = NULL;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Longtitude is required', 'data' => FALSE);
        }
        // dev_export($dbparams);
        // die;
        $student_update_status = $this->MVt->update_student_status($dbparams);
        if (!empty($student_update_status['ErrorStatus']) && is_array($student_update_status) && $student_update_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $student_update_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $student_update_status['ErrorMessage'], 'data' => TRUE);
        }
    }

    public function get_trip_pickuppoints($params = NULL)
    {
        // return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['trip_id']) && !empty($params['trip_id'])) {
            $dbparams[1] = $params['trip_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'trip Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $pickup_list = $this->MVt->get_trip_pickups($dbparams);

        if (!empty($pickup_list['ErrorStatus']) && is_array($pickup_list) && $pickup_list['ErrorStatus'] == 1) {
            // if (!empty($pickup_list) && is_array($pickup_list)) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'No data available', 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pickup_list);
        }
    }

    public function get_picked_students_list($params = NULL)
    {
        // return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['tripId']) && !empty($params['tripId'])) {
            $dbparams[1] = $params['tripId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'trip Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $dbparams[3] = " and std.travel_type='P'";

        if (isset($params['travel_date']) && !empty($params['travel_date'])) {
            $dbparams[4] = "'" . $params['travel_date'] . "'";
        } else {
            $dbparams[4] = "'" . date('Y-m-d') . '"';
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Travel date  required', 'data' => FALSE);
        }

        $pickup_list = $this->MVt->get_picked_students_list($dbparams);
        // return $pickup_list;
        if (!empty($pickup_list) && is_array($pickup_list) && empty($pickup_list['ErrorStatus'])) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pickup_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function update_student_boarded_status($params)
    {
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['trip_id']) && !empty($params['trip_id'])) {
            $dbparams[1] = $params['trip_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id is required', 'data' => FALSE);
        }

        if (isset($params['student_id']) && !empty($params['student_id'])) {
            if (is_array($params['student_id'])) {
                $dbparams[2] = json_encode($params['student_id']);
            } else {
                $dbparams[2] = (int)$params['student_id'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student Id is required', 'data' => FALSE);
        }
        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[3] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id is required', 'data' => FALSE);
        }

        if (isset($params['updated_time']) && !empty($params['updated_time'])) {
            $dbparams[4] = $params['updated_time'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Update time is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[5] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $dbparams[6] = 'P'; //Pickup from Pickup point
        // dev_export($dbparams);
        // die;
        $student_update_status = $this->MVt->update_student_boarded_status($dbparams);
        if (!empty($student_update_status['ErrorStatus']) && is_array($student_update_status) && $student_update_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $student_update_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $student_update_status['ErrorMessage'], 'data' => TRUE);
        }
    }

    public function update_drop_student_boarded_status($params)
    {
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['trip_id']) && !empty($params['trip_id'])) {
            $dbparams[1] = $params['trip_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id is required', 'data' => FALSE);
        }

        if (isset($params['student_id']) && !empty($params['student_id'])) {
            if (is_array($params['student_id'])) {
                $dbparams[2] = json_encode($params['student_id']);
            } else {
                $dbparams[2] = (int)$params['student_id'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student Id is required', 'data' => FALSE);
        }
        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[3] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id is required', 'data' => FALSE);
        }

        if (isset($params['updated_time']) && !empty($params['updated_time'])) {
            $dbparams[4] = $params['updated_time'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Update time is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[5] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $dbparams[6] = 'PS'; //Pickup from School for Dropping


        // dev_export($dbparams);
        // die;
        $student_update_status = $this->MVt->update_student_boarded_status($dbparams);
        if (!empty($student_update_status['ErrorStatus']) && is_array($student_update_status) && $student_update_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $student_update_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $student_update_status['ErrorMessage'], 'data' => TRUE);
        }
    }
    public function get_all_students_report($params)
    {
        // return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['tripId']) && !empty($params['tripId'])) {
            $dbparams[1] = $params['tripId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'trip Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details required', 'data' => FALSE);
        }

        $dbparams[3] = " and std.travel_type IN ('P','D')";

        if (isset($params['travel_date']) && !empty($params['travel_date'])) {
            $dbparams[4] = "'" . $params['travel_date'] . "'";
        } else {
            $dbparams[4] = "'" . date('Y-m-d') . "'";
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Travel date  required', 'data' => FALSE);
        }

        $pickup_list = $this->MVt->get_picked_students_list($dbparams);

        $pickup_final_list = [];
        if (empty($pickup_list['ErrorStatus'])) {
            $i = 0;
            foreach ($pickup_list as $data) {
                $pickup_final_list[$i] = $data;
                $pickup_final_list[$i]['pickuptime'] = date('g:i a', strtotime($data['vehicle_boarded_datetime']));
                $pickup_final_list[$i]['droppedtime'] = date('g:i a', strtotime($data['vehicle_deboraded_datatime']));
                $i++;
            }
        }
        // return $pickup_list;
        if (!empty($pickup_final_list) && is_array($pickup_final_list) && empty($pickup_list['ErrorStatus'])) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pickup_final_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_student_by_admn_no($params)
    {
        // return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $dbparams[1] = $params['admn_no'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Admission No required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details required', 'data' => FALSE);
        }
        // if (isset($params['trip_id']) && !empty($params['trip_id'])) {
        //     $dbparams[3] = $params['inst_id'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details required', 'data' => FALSE);
        // }
        $this->load->model('Passenger_student_model', 'Mps');
        $student_list = $this->Mps->get_studentsearch($dbparams);
        foreach ($student_list as $data) {
            $pre_data['student_name'] = $data['student_name'];
            $pre_data['pickup_trip'] = $data['pickup_tripName'];
            $pre_data['drop_trip'] = $data['drop_tripName'];
            $pre_data['pickup_point'] = $data['pickup_pickpointName'];
            $pre_data['drop_point'] = $data['drop_pickupName'];
            $pre_data['student_id'] = $data['student_id'];
            $pre_data['Admn_No'] = $data['Admn_No'];
            $pre_student_list[] = $pre_data;
        }
        if (!empty($pre_student_list) && is_array($pre_student_list) && empty($pre_student_list['ErrorStatus'])) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pre_student_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    function get_travel_log($params)
    {
        // return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['tripId']) && !empty($params['tripId'])) {
            $dbparams[1] = $params['tripId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'trip Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details required', 'data' => FALSE);
        }

        $dbparams[3] = " and std.travel_type IN ('P','D')";

        if (isset($params['log_date']) && !empty($params['log_date'])) {
            $dbparams[4] = "'" . $params['log_date'] . "'";
        } else {
            $dbparams[4] = "'" . date('Y-m-d') . "'";
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Travel date  required', 'data' => FALSE);
        }
        $pickup_list = $this->MVt->get_picked_students_list($dbparams);
        // return $pickup_list;
        if (!empty($pickup_list) && is_array($pickup_list) && empty($pickup_list['ErrorStatus'])) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pickup_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_drop_student_transport_app_data($params)
    {
        $dbparams = array();
        //return $params;
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['tripId']) && !empty($params['tripId'])) {
            $dbparams[1] = $params['tripId'];
        } else {
            $dbparams[1] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id Name is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointId']) && !empty($params['pickuppointId'])) {
            $dbparams[2] = $params['pickuppointId'];
        } else {
            $dbparams[2] = 0;
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Id. details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $this->load->model('Trip_model', 'MVt');
        $pickuppoint_relation_data = $this->MVt->get_trip_pickuppoint_relation_data($dbparams);
        $pickpoint_data = [];
        $current_time = strtotime(date("H:i"));
        foreach ($pickuppoint_relation_data as $pick_data) {
            $pick_time = strtotime($pick_data['pickStartTime']);
            $drop_time = strtotime($pick_data['dropStartTime']);
            $pick_time_difference = round(abs($current_time - $pick_time) / 60, 2);
            $drop_time_difference = round(abs($current_time - $drop_time) / 60, 2);
            if ($pick_time_difference < 30) {
                $pickpoint_data[$pick_data['tripId']]['is_pick'] = 1;
            } else if ($drop_time_difference < 30) {
                $pickpoint_data[$pick_data['tripId']]['is_drop'] = 1;
            } else if ($drop_time_difference < $pick_time_difference) {
                $pickpoint_data[$pick_data['tripId']]['is_drop'] = 1;
            } else {
                $pickpoint_data[$pick_data['tripId']]['is_pick'] = 1;
            }
        }

        if ($pickpoint_data[$params['tripId']]['is_drop'] == 1) {
            $dbparams = array();
            $dbparams[0] = $params['API_KEY'];
            $params['acd_year_id'] = -1;
            if (isset($params['acd_year_id']) && !empty($params['acd_year_id'])) {
                $dbparams[1] = $params['acd_year_id'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year required', 'data' => FALSE);
            }
            if (isset($params['inst_id']) && !empty($params['inst_id'])) {
                $dbparams[2] = $params['inst_id'];
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst is required', 'data' => FALSE);
            }
            if (isset($params['tripId']) && !empty($params['tripId'])) {
                $trip_id = $params['tripId'];
                $query = " and (dt.id=$trip_id)";
                $dbparams[3] = $query;
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id is required', 'data' => FALSE);
            }
            $this->load->model('Passenger_student_model', 'Mps');
            $data_list = $this->Mps->get_all_student_allocation_details($dbparams);
            if (!empty($data_list)) {
                $formatted_allocation_data = [];
                //$data['user_name'] = $this->session->userdata('user_name');
                foreach ($data_list as $rpt_data) {
                    if ($rpt_data['dropTripId'] != 0 && ($rpt_data['dropTripId'] == $trip_id || $trip_id == "ALL")) {
                        if ($rpt_data['dropStopId'] != 0 && $pickpoint_data[$rpt_data['pickTripId']]['is_drop'] == 1) { //&& $pickpoint_data[$rpt_data['pickTripId']]['is_drop'] == 1
                            $formatted_allocation_data[$rpt_data['student_id']]['student_name'] = $rpt_data['student_name'];
                            $formatted_allocation_data[$rpt_data['student_id']]['Admn_No'] = $rpt_data['Admn_No'];
                            $formatted_allocation_data[$rpt_data['student_id']]['class_name'] = $rpt_data['class_name'];
                            $formatted_allocation_data[$rpt_data['student_id']]['student_id'] = $rpt_data['student_id'];
                            $formatted_allocation_data[$rpt_data['student_id']]['travel_status'] = $rpt_data['drop_status'];
                            $formatted_allocation_data[$rpt_data['student_id']]['travel_date'] = $rpt_data['drop_time'];
                            $formatted_allocation_data[$rpt_data['student_id']]['travel_type'] = 'D';
                            // $formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data'][$rpt_data['student_id']]['transport_dates'] = date('d/m/Y', strtotime($rpt_data['transportStartDate'])) . ' to ' . $end_date_value;
                            // $size_drop = sizeof($formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['student_data']);
                            // $size['stop_span'][$rpt_data['dropTripId']]['Drop'][$rpt_data['dropStopId']] = $size_drop;
                            //$formatted_allocation_data[$rpt_data['dropTripId']]['travel_type']['Drop'][$rpt_data['dropStopId']]['travel_type_span'] = $size_drop;
                        }
                    }
                    //$total_row_count++;
                }
                $allocation_data = array_values($formatted_allocation_data);
                if (!empty($allocation_data) && is_array($allocation_data)) {
                    return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $allocation_data);
                } else {
                    return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
                }
            }
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }


    function get_manager_contact($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details required', 'data' => FALSE);
        }

        $contact_details['mobile_no'] = '+91999999999';

        if (!empty($contact_details) && is_array($contact_details) && empty($contact_details['ErrorStatus'])) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $contact_details);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    function notify_alert($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details required', 'data' => FALSE);
        }
        //Notification Code Start

        //Notfication Code End

        if (!empty($dbparams) && is_array($dbparams)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => array('message' => 'Notification Sent'));
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
