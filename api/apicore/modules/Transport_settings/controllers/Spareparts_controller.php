<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Spareparts_controller
 *
 * @author chandrajith.edsys
 */
class Spareparts_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Spareparts_model', 'MSpart');
    }
    public function get_spareparts($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }

        $vendor_data = $this->MSpart->get_parts_data($dbparams);
        if (!empty($vendor_data) && is_array($vendor_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vendor_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_spareparts($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['partname']) && !empty($params['partname'])) {
            $dbparams[1] = $params['partname'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare parts name required', 'data' => FALSE);
        }
        if (isset($params['description']) && !empty($params['description'])) {
            $dbparams[2] = $params['description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description required', 'data' => FALSE);
        }
        if (isset($params['partnumber']) && !empty($params['partnumber'])) {
            $dbparams[3] = $params['partnumber'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Part Number are required', 'data' => FALSE);
        }
        //        return $dbparams;
        $spareparts_add_status = $this->MSpart->add_new_spareparts($dbparams);
        if (!empty($spareparts_add_status) && is_array($spareparts_add_status) && $spareparts_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $spareparts_add_status['id']));
        } else {
            if (is_array($spareparts_add_status)) {
                return array('data_status' => 0, 'error_status' => $spareparts_add_status['ErrorStatus'], 'message' => $spareparts_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function save_sparepart($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['partName']) && !empty($params['partName'])) {
            $dbparams[1] = $params['partName'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare part Name required', 'data' => FALSE);
        }
        if (isset($params['partdesc']) && !empty($params['partdesc'])) {
            $dbparams[2] = $params['partdesc'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare part Description required', 'data' => FALSE);
        }
        if (isset($params['partnum']) && !empty($params['partnum'])) {
            $dbparams[3] = $params['partnum'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare part Number required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $spareparts_add_status = $this->MSpart->add_new_sparepart($dbparams);
        if (!empty($spareparts_add_status) && is_array($spareparts_add_status) && $spareparts_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $spareparts_add_status['id']));
        } else {
            if (is_array($spareparts_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $spareparts_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function saveparts_vehicle_data($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicleid']) && !empty($params['vehicleid'])) {
            $dbparams[1] = $params['vehicleid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle required', 'data' => FALSE);
        }
        if (isset($params['partid']) && !empty($params['partid'])) {
            $dbparams[2] = $params['partid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare part required', 'data' => FALSE);
        }
        if (isset($params['$qty']) && !empty($params['$qty'])) {
            $dbparams[3] = $params['$qty'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare part quantity required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }


        $spareparts_add_status = $this->MSpart->add_new_sparepart_vehi($dbparams);
        if (!empty($spareparts_add_status) && is_array($spareparts_add_status) && $spareparts_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $spareparts_add_status['id']));
        } else {
            if (is_array($spareparts_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $spareparts_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function modify_parts_status($params = NULL)
    {

        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Sparepart ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        //        $dbparams[4] = NULL;
        $dbparams[4] = NULL;


        $dbparams[5] = $params['flag'];

        if (isset($params['status'])) {
            $dbparams[6] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'SparePart Status is required', 'data' => FALSE);
        }

        //        $sparepart_status = $this->MSpart->update_sparepart_data($dbparams);
        $sparepart_status = $this->MSpart->update_parts_data($dbparams);

        if (!empty($sparepart_status) && is_array($sparepart_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $sparepart_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }
    public function get_spareparts_vehicle_alloted($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicleid']) && !empty($params['vehicleid'])) {
            $dbparams[1] = $params['vehicleid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }
        //         return $dbparams;
        $vendor_data = $this->MSpart->get_parts_data_vehiclealloted($dbparams);
        if (!empty($vendor_data) && is_array($vendor_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vendor_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }



    public function disable_spare_part($params = NULL)
    {

        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'PARTS ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = 0;
        if (isset($params['status'])) {
            $dbparams[6] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Parts Status is required', 'data' => FALSE);
        }

        $ven_status = $this->MSpart->update_parts_data($dbparams);

        if (!empty($ven_status) && is_array($ven_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $ven_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }

    public function get_particularpart($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['partid']) && !empty($params['partid'])) {
            $dbparams[1] = $params['partid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare part Id is required', 'data' => FALSE);
        }

        $sparepart_list = $this->MSpart->get_parts_particular($dbparams);
        if (!empty($sparepart_list) && is_array($sparepart_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $sparepart_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function update_spareparts($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        //        $dbparams[1] = 1;
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare Parts ID is required', 'data' => FALSE);
        }
        if (isset($params['num']) && !empty($params['num'])) {
            $dbparams[2] = $params['num'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare Parts Number is required', 'data' => FALSE);
        }
        if (isset($params['name']) && !empty($params['name'])) {
            $dbparams[3] = $params['name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare Parts Name is required', 'data' => FALSE);
        }
        if (isset($params['desc']) && !empty($params['desc'])) {
            $dbparams[4] = $params['desc'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare Parts Description is required', 'data' => FALSE);
        }
        $dbparams[5] = 1;
        $dbparams[6] = 0;
        $spareparts_update_status = $this->MSpart->update_parts_data($dbparams);
        if (!empty($spareparts_update_status) && is_array($spareparts_update_status) && isset($spareparts_update_status['ErrorStatus']) && $spareparts_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $spareparts_update_status);
        } else {
            if (isset($spareparts_update_status['ErrorMessage']) && !empty($spareparts_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $spareparts_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
}
