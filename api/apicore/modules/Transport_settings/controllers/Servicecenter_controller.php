<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicecenter_controller
 *
 * @author chandrajith.edsys
 */
class Servicecenter_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Servicecenter_model', 'Msm');
    }
    public function get_service_center($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isactive = " . $params['status'];
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
            if (isset($params['servicecentername'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.serviceCenterName LIKE '%" . $params['servicecentername'] . "%' ";
                } else {
                    $query_string = "c.serviceCenterName LIKE '%" . $params['servicecentername'] . "%' ";
                }
            }
            if (isset($params['location'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.location LIKE '%" . $params['location'] . "%' ";
                } else {
                    $query_string = "c.location LIKE '%" . $params['location'] . "%' ";
                }
            }
            if (isset($params['contactNo'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.contactNo LIKE '%" . $params['contactNo'] . "%' ";
                } else {
                    $query_string = "c.contactNo LIKE '%" . $params['contactNo'] . "%' ";
                }
            }
            if (isset($params['emailId'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.emailId LIKE '%" . $params['emailId'] . "%' ";
                } else {
                    $query_string = "c.emailId LIKE '%" . $params['emailId'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['serviceCenterName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.serviceCenterName = '" . $params['serviceCenterName'] . "' ";
                } else {
                    $query_string = "c.serviceCenterName = '" . $params['serviceCenterName'] . "' ";
                }
            }
            if (isset($params['location'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.location = '" . $params['location'] . "' ";
                } else {
                    $query_string = "c.location = '" . $params['location'] . "' ";
                }
            }
            if (isset($params['contactNo'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.contactNo = '" . $params['contactNo'] . "' ";
                } else {
                    $query_string = "c.contactNo = '" . $params['contactNo'] . "' ";
                }
            }
            if (isset($params['emailId'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.emailId = '" . $params['emailId'] . "' ";
                } else {
                    $query_string = "c.emailId = '" . $params['emailId'] . "' ";
                }
            }
            if (isset($params['inst_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.inst_id = '" . $params['inst_id'] . "' ";
                } else {
                    $query_string = "c.inst_id = '" . $params['inst_id'] . "' ";
                }
            }
        }


        $servicecenter_list = $this->Msm->get_servicecenter_details($apikey, $query_string);
        if (!empty($servicecenter_list) && is_array($servicecenter_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $servicecenter_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_servicecenter($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }
        if (isset($params['serviceentername']) && !empty($params['serviceentername'])) {
            $dbparams[2] = $params['serviceentername'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service center Name is required', 'data' => FALSE);
        }
        if (isset($params['location']) && !empty($params['location'])) {
            $dbparams[3] = $params['location'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service center location is required', 'data' => FALSE);
        }
        if (isset($params['contactno']) && !empty($params['contactno'])) {
            $dbparams[4] = $params['contactno'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service center contact Number is required', 'data' => FALSE);
        }
        if (isset($params['email']) && !empty($params['email'])) {
            $dbparams[5] = $params['email'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service center email is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $servicecenter_add_status = $this->Msm->add_new_servicecenter($dbparams);
        //        return $servicecenter_add_status;
        //        dev_export($servicecenter_add_status);die;
        if (!empty($servicecenter_add_status) && is_array($servicecenter_add_status) && $servicecenter_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $servicecenter_add_status['id']));
        } else {
            if (is_array($servicecenter_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $servicecenter_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_servicecenter($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = intval($params['id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service center Id is required', 'data' => FALSE);
        }

        if (isset($params['serviceCenterName']) && !empty($params['serviceCenterName'])) {
            $dbparams[2] = $params['serviceCenterName'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'service center name is required', 'data' => FALSE);
        }
        if (isset($params['slocation']) && !empty($params['slocation'])) {
            $dbparams[3] = $params['slocation'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service center Location is required', 'data' => FALSE);
        }
        if (isset($params['contactNo']) && !empty($params['contactNo'])) {
            $dbparams[4] = $params['contactNo'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service center Contact number is required', 'data' => FALSE);
        }
        if (isset($params['emailId']) && !empty($params['emailId'])) {
            $dbparams[5] = $params['emailId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service center Email is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[6] = intval($params['inst_id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }



        $dbparams[7] = 1;
        $dbparams[8] = 0;
        //        return $dbparams;
        $servicecenter_update_status = $this->Msm->update_servicecenter($dbparams);

        if (!empty($servicecenter_update_status) && is_array($servicecenter_update_status) && isset($servicecenter_update_status['ErrorStatus']) && $servicecenter_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $servicecenter_update_status);
        } else {
            if (isset($servicecenter_update_status['ErrorMessage']) && !empty($servicecenter_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $servicecenter_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    //    public function modify_servicecenter_status($params = NULL) {
    //        $apikey = $params['API_KEY'];
    //        $dbparams = array();
    //        $dbparams[0] = $params['API_KEY'];
    //        if (isset($params['id']) && !empty($params['id'])) {
    //            $dbparams[1] = $params['id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ID is required', 'data' => FALSE);
    //        }
    //        $dbparams[2] = NULL;
    //        $dbparams[3] = NULL;
    //       
    //        $dbparams[4] = NULL;
    //        $dbparams[5] = NULL;
    //        $dbparams[6] = NULL;
    //        $dbparams[7] = 0;
    //        if (isset($params['status'])) {
    //            if ($params['status'] == -1) {
    //                $dbparams[8] = 0;
    //            } else {
    //                $dbparams[8] = $params['status'];
    //            }
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service center details Status is required', 'data' => FALSE);
    //        }
    //
    //        $servicecenter_modify_status = $this->Msm->update_servicecenter($dbparams);
    //        if (!empty($servicecenter_modify_status['ErrorStatus']) && is_array($servicecenter_modify_status) && $servicecenter_modify_status['ErrorStatus'] == 1) {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => $servicecenter_modify_status['ErrorMessage'], 'data' => FALSE);
    //        } else {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => $servicecenter_modify_status['ErrorMessage'], 'data' => TRUE);
    //        }
    //    }

    public function modify_servicecenter_status($params = NULL)
    {

        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'SERVICE CENTER ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[6] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $dbparams[7] = 0;
        if (isset($params['status'])) {
            $dbparams[8] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service Center Status is required', 'data' => FALSE);
        }

        $ven_status = $this->Msm->update_servicecenter($dbparams);

        if (!empty($ven_status) && is_array($ven_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $ven_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }
    public function get_particularservicecenter($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['servicecenterid']) && !empty($params['servicecenterid'])) {
            $dbparams[1] = $params['servicecenterid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service Center Id is required', 'data' => FALSE);
        }

        $servicetypedata = $this->Msm->get_servicecenter_particular($dbparams);
        if (!empty($servicetypedata) && is_array($servicetypedata)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $servicetypedata);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    //    public function update_servicecenter($params = NULL) {
    //         $apikey = $params['API_KEY'];
    //        $dbparams = array();
    //        $dbparams[0] = $params['API_KEY'];
    ////        $dbparams[1] = 1;
    //        if (isset($params['id']) && !empty($params['id'])) {
    //            $dbparams[1] = $params['id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service Type Id is required', 'data' => FALSE);
    //        }
    //        if (isset($params['servicetype']) && !empty($params['servicetype'])) {
    //            $dbparams[2] = $params['servicetype'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service Type Name is required', 'data' => FALSE);
    //        }
    //        
    //        
    //        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
    //            $dbparams[3] = $params['inst_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
    //        }
    //        $dbparams[4] = 1;
    //        $dbparams[5] = 0;
    //        
    //        $servicetype_update_status = $this->MStype->update_servicetype_data($dbparams);
    //        if (!empty($servicetype_update_status) && is_array($servicetype_update_status) && isset($servicetype_update_status['ErrorStatus']) && $servicetype_update_status['ErrorStatus'] == 0) {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $servicetype_update_status);
    //        } else {
    //             if(isset($servicetype_update_status['ErrorMessage']) && !empty($servicetype_update_status['ErrorMessage'])) {
    //                return array('data_status' => 0, 'error_status' => 1, 'message' => $servicetype_update_status['ErrorMessage'], 'data' => FALSE);
    //            } else {
    //                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
    //            }
    //        }
    //    }
}
