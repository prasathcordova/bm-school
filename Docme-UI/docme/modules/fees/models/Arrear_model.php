<?php

/**
 * Description of Arrear_model
 *
 * @author SALAHUDHEEN
 */
class Arrear_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_students_for_arrear_management($inst_id, $acd_year_id, $api_key = "")
    {
        if ($api_key == "") $apikey = $this->session->userdata('API-Key');
        else $apikey = $api_key;
        $collection_data = transport_data_with_param_with_urlencode(array('action' => 'get_students_for_arrear_listing', 'inst_id' => $inst_id, 'acd_year_id' => $acd_year_id), $apikey);
        if (isset($collection_data['status']) && !empty($collection_data['status']) && is_array($collection_data) && $collection_data['status'] == true) {
            return $collection_data['data'];
        } else {
            if (isset($collection_data['message']) && !empty($collection_data['message']) && is_array($collection_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_current_academic_year_of_institution($inst_id, $api_key = "")
    {
        if ($api_key == "") $apikey = $this->session->userdata('API-Key');
        else $apikey = $api_key;
        $acd_year_data = transport_data_with_param_with_urlencode(array('action' => 'get_current_academic_year_of_institution', 'controller_function'   => 'Fees_settings/Priority_controller/get_current_academic_year_of_institution', 'inst_id' => $inst_id), $apikey);
        if (isset($acd_year_data['status']) && !empty($acd_year_data['status']) && is_array($acd_year_data) && $acd_year_data['status'] == true) {
            return $acd_year_data['data'];
            // if (!empty($acd_year_data['data'])) {
            //     if (isset($acd_year_data['data'][0]['codevalue']))
            //         return $acd_year_data['data'][0]['codevalue'];
            //     else return 0;
            // } else {
            //     return 0;
            // }
        }
    }

    public function save_todays_arrear_summary($arrear_summary_data, $inst_id, $acd_year_id, $arrear_sum, $api_key = "")
    {
        if ($api_key == "") $apikey = $this->session->userdata('API-Key');
        else $apikey = $api_key;

        $collection_data = transport_data_with_param_with_urlencode(array('action' => 'save_arrear_data', 'arrear_summary_data' => $arrear_summary_data, 'inst_id' => $inst_id, 'acd_year_id' => $acd_year_id, 'arrear_sum' => $arrear_sum), $apikey);
        if (isset($collection_data['status']) && !empty($collection_data['status']) && is_array($collection_data) && $collection_data['status'] == 1) {
            return $collection_data;
        } else {
            if (isset($collection_data['message']) && !empty($collection_data['message']) && is_array($collection_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $collection_data,
                    'data' => FALSE
                );
            }
        }
    }
}
