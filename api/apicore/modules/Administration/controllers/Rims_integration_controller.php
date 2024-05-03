<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rims_integration_controller
 *
 * @author saranya.kumar
 */
class Rims_integration_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rims_integration_model', 'MRIMSIntegration');
    }

    public function save_registration_RIMS($param)
    {
        //        dev_export($param);die;
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }

        if (is_array($param['student_data'])) {
            $student_details = $param['student_data'];
        } else {
            $student_details = json_decode($student_data_raw, TRUE);
        }


        $xml_data = xml_generator($student_details);
        $status = $this->MRIMSIntegration->save_registration($xml_data, $inst_id, $apikey);
        //        dev_export($status);
        //        die;
        if (isset($status[0]['status']) && !empty($status[0]['status']) && $status[0]['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student data updated', 'student_id' => $status[0]['student_id']);
        } else {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed');
            }
        }
    }

    public function std_batch_change_RIMS($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['batch_Id']) && !empty($params['batch_Id'])) {
            $dbparams[1] = $params['batch_Id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'batch data is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }
        if (isset($params['Admn_no']) && !empty($params['Admn_no'])) {
            $dbparams[3] = $params['Admn_no'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Admn no is required', 'data' => FALSE);
        }
        $student_batch_data = $this->MRIMSIntegration->std_change_batch($dbparams);
        if (!empty($student_batch_data[0]) && is_array($student_batch_data[0]) && $student_batch_data[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully');
        } else {
            if (is_array($student_batch_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $student_batch_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function std_status_change_RIMS($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['status']) && !empty($params['status'])) {
            $dbparams[1] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'status data is required', 'data' => FALSE);
        }
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[2] = $params['student_id'];
        } else {
            $dbparams[2] = $params['student_id'];
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst_id is required', 'data' => FALSE);
        }
        if (isset($params['admnno']) && !empty($params['admnno'])) {
            $dbparams[4] = $params['admnno'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Admission No is required', 'data' => FALSE);
        }
        $student_batch_data = $this->MRIMSIntegration->std_change_status($dbparams);
        if (!empty($student_batch_data) && is_array($student_batch_data) && $student_batch_data['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('batch_Id' => $params['batch_Id']));
        } else {
            if (is_array($student_batch_data)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $student_batch_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    //    public function save_country_RIMS($params = NULL) {
    //        $dbparams = array();
    //        $dbparams[0] = $params['API_KEY'];
    //        if (isset($params['country_name']) && !empty($params['country_name'])) {
    //            $dbparams[1] = $params['country_name'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country Name is required', 'data' => FALSE);
    //        }
    //        if (isset($params['country_abbr']) && !empty($params['country_abbr'])) {
    //            $dbparams[2] = $params['country_abbr'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country Abbrivation is required', 'data' => FALSE);
    //        }
    //        if (isset($params['country_nation']) && !empty($params['country_nation'])) {
    //            $dbparams[3] = $params['country_nation'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country Nation is required', 'data' => FALSE);
    //        }
    //        if (isset($params['currency_id']) && !empty($params['currency_id'])) {
    //            $dbparams[4] = $params['currency_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Currency details is required', 'data' => FALSE);
    //        }
    //        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
    //            $dbparams[5] = $params['inst_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
    //        }
    //        $country_add_status = $this->MRIMSIntegration->add_new_country($dbparams);
    //        if (!empty($country_add_status) && is_array($country_add_status) && $country_add_status['ErrorStatus'] == 0) {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('country_id' => $country_add_status['Country_id']));
    //        } else {
    //            if (is_array($country_add_status)) {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => $country_add_status['ErrorMessage'], 'data' => FALSE);
    //            } else {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
    //            }
    //        }
    //    }
    //
    //    public function save_state_RIMS($params = NULL) {
    //        $dbparams = array();
    //        $dbparams[0] = $params['API_KEY'];
    //        if (isset($params['state_name']) && !empty($params['state_name'])) {
    //            $dbparams[1] = $params['state_name'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State Name is required', 'data' => FALSE);
    //        }
    //        if (isset($params['state_abbr']) && !empty($params['state_abbr'])) {
    //            $dbparams[2] = $params['state_abbr'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State Abbrivation is required', 'data' => FALSE);
    //        }
    //        if (isset($params['country_id']) && !empty($params['country_id'])) {
    //            $dbparams[3] = $params['country_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country details is required', 'data' => FALSE);
    //        }
    //        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
    //            $dbparams[4] = $params['inst_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
    //        }
    //        $state_add_status = $this->MRIMSIntegration->add_new_state($dbparams);
    //
    //        if (!empty($state_add_status) && is_array($state_add_status) && $state_add_status['ErrorStatus'] == 0) {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('state_id' => $state_add_status['State_id']));
    //        } else {
    //            if (is_array($state_add_status)) {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => $state_add_status['ErrorMessage'], 'data' => FALSE);
    //            } else {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
    //            }
    //        }
    //    }
    //
    //    public function save_religion_RIMS($params = NULL) {
    //        $dbparams = array();
    //        $dbparams[0] = $params['API_KEY'];
    //        if (isset($params['name']) && !empty($params['name'])) {
    //            $dbparams[1] = $params['name'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Religion Name is required', 'data' => FALSE);
    //        }
    //        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
    //            $dbparams[2] = $params['inst_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
    //        }
    //        $religion_add_status = $this->MRIMSIntegration->save_religion_data($dbparams);
    //        if (!empty($religion_add_status) && is_array($religion_add_status) && $religion_add_status['ErrorStatus'] == 0) {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('religion_id' => $religion_add_status['religion_id']));
    //        } else {
    //            if (is_array($religion_add_status)) {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => $religion_add_status['ErrorMessage'], 'data' => FALSE);
    //            } else {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
    //            }
    //        }
    //    }
    //
    //    public function save_caste_RIMS($params = NULL) {
    //        $dbparams = array();
    //        $dbparams[0] = $params['API_KEY'];
    //        if (isset($params['caste_name']) && !empty($params['caste_name'])) {
    //            $dbparams[1] = $params['caste_name'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Caste Name is required', 'data' => FALSE);
    //        }
    //        if (isset($params['religion_id']) && !empty($params['religion_id'])) {
    //            $dbparams[2] = $params['religion_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Religion ID is required', 'data' => FALSE);
    //        }
    //        if (isset($params['community_id']) && !empty($params['community_id'])) {
    //            $dbparams[3] = $params['community_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Community details is required', 'data' => FALSE);
    //        }
    //        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
    //            $dbparams[4] = $params['inst_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
    //        }
    //        $country_add_status = $this->MRIMSIntegration->add_new_caste($dbparams);
    //        if (!empty($country_add_status) && is_array($country_add_status) && $country_add_status['ErrorStatus'] == 0) {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('country_id' => $country_add_status['Country_id']));
    //        } else {
    //            if (is_array($country_add_status)) {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => $country_add_status['ErrorMessage'], 'data' => FALSE);
    //            } else {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
    //            }
    //        }
    //    }
    //
    //    public function save_community_RIMS($params = NULL) {
    //        $dbparams = array();
    //        $dbparams[0] = $params['API_KEY'];
    //        if (isset($params['name']) && !empty($params['name'])) {
    //            $dbparams[1] = $params['name'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Community Name is required', 'data' => FALSE);
    //        }
    //        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
    //            $dbparams[2] = $params['inst_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
    //        }
    //        $community_add_status = $this->MRIMSIntegration->add_new_community($dbparams);
    //        if (!empty($community_add_status) && is_array($community_add_status) && $community_add_status['ErrorStatus'] == 0) {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('country_id' => $community_add_status['community_id']));
    //        } else {
    //            if (is_array($community_add_status)) {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => $community_add_status['ErrorMessage'], 'data' => FALSE);
    //            } else {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
    //            }
    //        }
    //    }
    //
    //    public function save_currency_RIMS($params = NULL) {
    //        $dbparams = array();
    //        $dbparams[0] = $params['API_KEY'];
    //        if (isset($params['currency_name']) && !empty($params['currency_name'])) {
    //            $dbparams[1] = $params['currency_name'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Currency Name is required', 'data' => FALSE);
    //        }
    //        if (isset($params['currency_abbr']) && !empty($params['currency_abbr'])) {
    //            $dbparams[2] = $params['currency_abbr'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Currency Abbrevation is required', 'data' => FALSE);
    //        }
    //        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
    //            $dbparams[3] = $params['inst_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
    //        }
    //        $currency_add_status = $this->MRIMSIntegration->add_new_currency($dbparams);
    //        if (!empty($currency_add_status) && is_array($currency_add_status) && $currency_add_status['ErrorStatus'] == 0) {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('currency_id' => $currency_add_status['currency_id']));
    //        } else {
    //            if (is_array($currency_add_status)) {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => $currency_add_status['ErrorMessage'], 'data' => FALSE);
    //            } else {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
    //            }
    //        }
    //    }
    //
    //    public function save_profession_RIMS($params = NULL) {
    //        $dbparams = array();
    //        $dbparams[0] = $params['API_KEY'];
    //        if (isset($params['profession_name']) && !empty($params['profession_name'])) {
    //            $dbparams[1] = $params['profession_name'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Profession Name is required', 'data' => FALSE);
    //        }
    //        if (isset($params['profession_code']) && !empty($params['profession_code'])) {
    //            $dbparams[2] = $params['profession_code'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Profession Code is required', 'data' => FALSE);
    //        }
    //        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
    //            $dbparams[3] = $params['inst_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
    //        }
    //        $profession_add_status = $this->MRIMSIntegration->add_new_profession($dbparams);
    //        if (!empty($profession_add_status) && is_array($profession_add_status) && $profession_add_status['ErrorStatus'] == 0) {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('profession_id' => $profession_add_status['profession_id']));
    //        } else {
    //            if (is_array($profession_add_status)) {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => $profession_add_status['ErrorMessage'], 'data' => FALSE);
    //            } else {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
    //            }
    //        }
    //    }
    //
    //    public function save_language_RIMS($params = NULL) {
    //        $dbparams = array();
    //        $dbparams[0] = $params['API_KEY'];
    //        if (isset($params['language_name']) && !empty($params['language_name'])) {
    //            $dbparams[1] = $params['language_name'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Language Name is required', 'data' => FALSE);
    //        }
    //        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
    //            $dbparams[2] = $params['inst_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
    //        }
    //        $language_add_status = $this->MRIMSIntegration->add_new_language($dbparams);
    //        if (!empty($language_add_status) && is_array($language_add_status) && $language_add_status['ErrorStatus'] == 0) {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('language_id' => $language_add_status['language_id']));
    //        } else {
    //            if (is_array($language_add_status)) {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => $language_add_status['ErrorMessage'], 'data' => FALSE);
    //            } else {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
    //            }
    //        }
    //    }
    //
    //    public function save_city_RIMS($params = NULL) {
    //        $dbparams = array();
    //        $dbparams[0] = $params['API_KEY'];
    //        if (isset($params['city_name']) && !empty($params['city_name'])) {
    //            $dbparams[1] = $params['city_name'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'City Name is required', 'data' => FALSE);
    //        }
    //        if (isset($params['city_abbr']) && !empty($params['city_abbr'])) {
    //            $dbparams[2] = $params['city_abbr'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'City Abbrivation is required', 'data' => FALSE);
    //        }
    //        if (isset($params['state_id']) && !empty($params['state_id'])) {
    //            $dbparams[3] = $params['state_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State ID is required', 'data' => FALSE);
    //        }
    //        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
    //            $dbparams[4] = $params['inst_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
    //        }
    //        $city_add_status = $this->MRIMSIntegration->add_new_city($dbparams);
    //        if (!empty($city_add_status) && is_array($city_add_status) && $city_add_status['ErrorStatus'] == 0) {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('city_id' => $city_add_status['city_id']));
    //        } else {
    //            if (is_array($city_add_status)) {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => $city_add_status['ErrorMessage'], 'data' => FALSE);
    //            } else {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
    //            }
    //        }
    //    }

    public function act_transaction_download_RIMS($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['start_date']) && !empty($params['start_date'])) {
            $dbparams[1] = $params['start_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start date is required', 'data' => FALSE);
        }
        if (isset($params['end_date']) && !empty($params['end_date'])) {
            $dbparams[2] = $params['end_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End date is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst IDs is required', 'data' => FALSE);
        }

        $act_add_status = $this->MRIMSIntegration->download_act_transactions($dbparams);
        //        dev_export($act_add_status);die;
        if (!empty($act_add_status) && is_array($act_add_status) && $act_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data loaded', 'data' => $act_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'No data avilable', 'data' => NULL);
        }
    }

    public function act_transaction_download_update_RIMS($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['id_data']) && !empty($param['id_data'])) {
            $id_data_raw = $param['id_data'];
        } else {
            return array('status' => 0, 'message' => 'ID data  is requried.', 'data' => FALSE);
        }
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }
        $id_details = json_decode($id_data_raw, TRUE);
        $id_data = implode(',', $id_details);
        $query_string = " trans_id IN (" . $id_data . ") ";
        $status = $this->MRIMSIntegration->download_update_act_transactions($id_data, $query_string, $inst_id, $apikey);
        if (isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => ' data updated');
        } else {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Update creation failed');
            }
        }
    }

    public function RIMS_update_settings($params)
    {
        $apikey = $params['API_KEY'];
        if (isset($params['table_name']) && !empty($params['table_name'])) {
            $table_name = $params['table_name'];
        } else {
            return array('status' => 0, 'message' => 'Table name requried.', 'data' => FALSE);
        }
        if (isset($params['table_data']) && !empty($params['table_data'])) {
            $table_data = $params['table_data'];
        } else {
            return array('status' => 0, 'message' => 'Table data  is requried.', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $inst_id = $params['inst_id'];
        } else {
            return array('status' => 0, 'message' => 'Inst. ID is requried.', 'data' => FALSE);
        }
        $data_result = array();
        switch ($table_name) {
            case 'acd':
                $acd_temp = json_decode($table_data, TRUE);
                $acdid = $acd_temp['Acd_id'];
                $from_year = $acd_temp['From_year'];
                $to_year = $acd_temp['To_Year'];
                $description = $acd_temp['Description'];

                $dbparams = array(
                    $apikey,
                    $acdid,
                    $from_year,
                    $to_year,
                    $description,
                    $inst_id
                );

                $result = $this->MRIMSIntegration->update_acdmaster($dbparams);
                if (isset($result[0]) && !empty($result[0])) {
                    $data_result = $result[0];
                } else {
                    $data_result = array('data_status' => 0, 'docme_id' => 0, 'MSG' => 'An error encountered.  Please  try again later or contact administrator');
                }
                break;
            case 'course':
                $course_temp = json_decode($table_data, TRUE);

                $dbparams = array(
                    $apikey,
                    $course_temp['Course_Det_ID'],
                    $course_temp['Course_Master_ID'],
                    $course_temp['Course_det_code'],
                    $course_temp['Description'],
                    $course_temp['Priority'],
                    $inst_id
                );

                $result = $this->MRIMSIntegration->update_course_details($dbparams);
                if (isset($result[0]) && !empty($result[0])) {
                    $data_result = $result[0];
                } else {
                    $data_result = array('data_status' => 0, 'docme_id' => 0, 'MSG' => 'An error encountered.  Please  try again later or contact administrator');
                }
                break;
            case 'batch':
                $batch_temp = json_decode($table_data, TRUE);
                if ($batch_temp['Active'] == 'N') {
                    $active = 0;
                } else {
                    $active = 1;
                }

                $dbparams = array(
                    $apikey,
                    $batch_temp['BatchID'],
                    $batch_temp['Class_Det_ID'],
                    $batch_temp['Stream_ID'],
                    $batch_temp['Session_ID'],
                    $batch_temp['Medium_ID'],
                    $batch_temp['Division'],
                    $batch_temp['Acd_Year'],
                    $batch_temp['Boys'],
                    $batch_temp['Girls'],
                    $batch_temp['limit'],
                    $batch_temp['Batch_Name'],
                    $inst_id,
                    $active

                );

                $result = $this->MRIMSIntegration->update_batch_details($dbparams);
                if (isset($result[0]) && !empty($result[0])) {
                    $data_result = $result[0];
                } else {
                    $data_result = array('data_status' => 0, 'docme_id' => 0, 'MSG' => 'An error encountered.  Please  try again later or contact administrator');
                }
                break;
            default:
                break;
        }

        return $data_result;
    }

    public function RIMS_student_registration($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }



        if (is_array($param['student_data'])) {
            $student_details = $param['student_data'];
        } else {
            $student_details = json_decode($student_data_raw, TRUE);
        }

        $xml_data = xml_generator($student_details);
        $status = $this->MRIMSIntegration->save_registration_RIMS($xml_data, $inst_id, $apikey);
        //dev_export($status);exit;
        if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
            return array('datastatus' => 1, 'error_status' => 0, 'message' => 'Student data updated', 'student_id' => $status[0]['student_id']);
        } else {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed');
            }
        }
    }
    public function RIMS_Longab_student_registration($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }
        if (is_array($param['student_data'])) {
            $student_details = $param['student_data'];
        } else {
            $student_details = json_decode($student_data_raw, TRUE);
        }

        $xml_data = xml_generator($student_details);
        $status = $this->MRIMSIntegration->save_Longabs_registration_RIMS($xml_data, $inst_id, $apikey);
        //dev_export($status);exit;
        if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
            return array('datastatus' => 1, 'error_status' => 0, 'message' => 'Student data updated', 'student_id' => $status[0]['student_id']);
        } else {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student creation failed');
            }
        }
    }


    public function RIMS_student_update_sync($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
        }
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }



        if (is_array($param['student_data'])) {
            $student_details = $param['student_data'];
        } else {
            $student_details = json_decode($student_data_raw, TRUE);
        }

        $xml_data = xml_generator($student_details);
        $status = $this->MRIMSIntegration->update_registration_RIMS($xml_data, $inst_id, $apikey);
        //dev_export($status);exit;
        if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
            return array('datastatus' => 1, 'error_status' => 0, 'message' => 'Student data update finished', 'student_id' => $status[0]['student_id']);
        } else {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student update failed');
            }
        }
    }

    public function RIMS_parent_registration($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['parent_data']) && !empty($param['parent_data'])) {
            $parent_data_raw = $param['parent_data'];
        } else {
            return array('status' => 0, 'message' => 'Parent data  is requried.', 'data' => FALSE);
        }
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }
        if (is_array($param['parent_data'])) {
            $parent_details = $param['parent_data'];
        } else {
            $parent_details = json_decode($parent_data_raw, TRUE);
        }

        $xml_data = xml_generator($parent_details);
        $status = $this->MRIMSIntegration->save_parent_registration_RIMS($xml_data, $inst_id, $apikey);
        if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
            return array('datastatus' => 1, 'error_status' => 0, 'message' => 'Parent data updated', 'parent_id' => $status[0]['parent_id']);
        } else {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'parent creation failed');
            }
        }
    }
    public function RIMS_address_registration($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['addr_data']) && !empty($param['addr_data'])) {
            $addr_data_raw = $param['addr_data'];
        } else {
            return array('status' => 0, 'message' => 'Address data  is requried.', 'data' => FALSE);
        }
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }
        if (is_array($param['addr_data'])) {
            $addr_details = $param['addr_data'];
        } else {
            $addr_details = json_decode($addr_data_raw, TRUE);
        }

        $xml_data = xml_generator($addr_details);
        $status = $this->MRIMSIntegration->save_parent_address_registration_RIMS($xml_data, $inst_id, $apikey);
        //return $status;
        if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
            return array('datastatus' => 1, 'error_status' => 0, 'message' => 'Parent address data updated', 'address_id' => $status[0]['address_id']);
        } else {
            if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'parent address creation failed');
            }
        }
    }
    public function RIMS_emp_designation($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }
        if (isset($param['designation_data']) && !empty($param['designation_data'])) {
            $designation_data_raw = $param['designation_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Designation data is required', 'data' => FALSE);
        }
        $designation_data = json_decode($designation_data_raw, TRUE);
        //        dev_export($designation_data);
        //        die;
        if (count($designation_data) > 0) {
            $desig_status = array();
            $final_desig_status = array();
            //            dev_export($designation_data);die;
            foreach ($designation_data as $desigs) {
                //                dev_export($desigs);die;
                $desig_status = $this->MRIMSIntegration->save_designation_status(
                    $apikey,
                    $inst_id,
                    $desigs['Desg_Id'],
                    $desigs['Desig_Name'],
                    $desigs['Desig_Code'],
                    $desigs['Descript'],
                    $desigs['InstDesig_Id'],
                    $desigs['Desig_Active']
                );
                //                dev_export($desig_status);die;
                if (isset($desig_status[0]['data_status']) && !empty($desig_status[0]['data_status']) && $desig_status[0]['data_status'] == 1) {
                    $final_desig_status[] = array(
                        'Desg_Id' => $desigs['Desg_Id'],
                        'status' => 1,
                        'docme_id' => $desig_status[0]['docme_id']
                    );
                } else {
                    $final_desig_status[] = array(
                        'Desg_Id' => $desigs['Desg_Id'],
                        'status' => 0,
                        'docme_id' => 0
                    );
                }
            }

            if (count($final_desig_status) > 0) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Designation status updated successfully.', 'data' => $final_desig_status);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'No status data is available', 'data' => FALSE);
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'There are no designation data to update', 'data' => FALSE);
        }
    }

    public function RIMS_emp_department($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }
        if (isset($param['department_data']) && !empty($param['department_data'])) {
            $department_data_raw = $param['department_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Department data is required', 'data' => FALSE);
        }
        $department_data = json_decode($department_data_raw, TRUE);
        //        dev_export($department_data);
        //        die;
        if (count($department_data) > 0) {
            $depart_status = array();
            $final_depart_status = array();
            //            dev_export($designation_data);die;
            foreach ($department_data as $desigs) {
                //                dev_export($desigs);die;
                $depart_status = $this->MRIMSIntegration->save_department_status(
                    $apikey,
                    $inst_id,
                    $desigs['Dep_Id'],
                    $desigs['Dep_Code'],
                    $desigs['Dep_Name'],
                    $desigs['Dep_Desc']
                );
                //                dev_export($depart_status);die;
                if (isset($depart_status[0]['data_status']) && !empty($depart_status[0]['data_status']) && $depart_status[0]['data_status'] == 1) {
                    $final_depart_status[] = array(
                        'Dep_Id' => $desigs['Dep_Id'],
                        'status' => 1,
                        'docme_id' => $depart_status[0]['docme_id']
                    );
                } else {
                    $final_depart_status[] = array(
                        'Dep_Id' => $desigs['Dep_Id'],
                        'status' => 0,
                        'docme_id' => 0
                    );
                }
            }

            if (count($final_depart_status) > 0) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Department status updated successfully.', 'data' => $final_depart_status);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'No status data is available', 'data' => FALSE);
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'There are no department data to update', 'data' => FALSE);
        }
    }

    public function RIMS_emp_master($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }
        if (isset($param['emp_data']) && !empty($param['emp_data'])) {
            $emp_data_raw = $param['emp_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Employee data is required', 'data' => FALSE);
        }
        $emp_data = json_decode($emp_data_raw, TRUE);
        //        dev_export($emp_data);
        //        die;
        $final_emp_status = array();
        if (count($emp_data) > 0) {
            $emp_status = array();

            //            dev_export($designation_data);die;
            foreach ($emp_data as $desigs) {
                //                dev_export($desigs);
                //                die;
                $emp_status = $this->MRIMSIntegration->save_emp_status(
                    $apikey,
                    $inst_id,
                    json_encode($desigs),
                    $desigs['Emp_code'],
                    $desigs['Emp_id']
                );
                //                dev_export($emp_status);die;
                if (isset($emp_status[0]['data_status']) && !empty($emp_status[0]['data_status']) && $emp_status[0]['data_status'] == 1) {
                    $final_emp_status[] = array(
                        'Emp_id' => $desigs['Emp_id'],
                        'Emp_code' => $desigs['Emp_code'],
                        'status' => 1,
                        'docme_id' => $emp_status[0]['docme_id']
                    );
                } else {
                    $final_emp_status[] = array(
                        'Emp_id' => $desigs['Emp_id'],
                        'Emp_code' => $desigs['Emp_code'],
                        'status' => 0,
                        'docme_id' => 0
                    );
                }
                //                dev_export($final_emp_status);die;
            }
            //            dev_export($final_emp_status);die;
            if (count($final_emp_status) > 0) {
                return array('data_status' => 1, 'error_status' => 0, 'message' => 'Employee status updated successfully.', 'data' => $final_emp_status);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'No status data is available', 'data' => FALSE);
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'There are no employee data to update', 'data' => FALSE);
        }
    }
    public function RIMS_transport_dataporting($param)
    {

        $apikey = $param['API_KEY'];
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }
        if (isset($param['transport_data']) && !empty($param['transport_data'])) {
            $transport_data_raw = $param['transport_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Transport data is required', 'data' => FALSE);
        }
        if (is_array($param['transport_data'])) {
            $transport_data = $param['transport_data'];
        } else {
            $transport_data = json_decode($transport_data_raw, TRUE);
        }

        $xml_data = xml_generator($transport_data);
        $flag = $param['flag'];
        $status = $this->MRIMSIntegration->save_transport_status($xml_data, $inst_id, $apikey, $flag);
        if ($flag  == 1) {
            // $status = $this->MRIMSIntegration->save_transport_status($xml_data, $inst_id, $apikey);
            if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
                return array('datastatus' => 1, 'error_status' => 0, 'message' => 'Vehicle type data updated', 'vehicle_type_id' => $status[0]['vehicle_type_id']);
            } else {
                if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
                } else {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => 'vehicle type creation failed');
                }
            }
        } else if ($flag  == 2) {
            //  $status = $this->MRIMSIntegration->save_transport_reg_details($xml_data, $inst_id, $apikey);
            if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
                return array('datastatus' => 1, 'error_status' => 0, 'message' => 'Vehicle registration data updated', 'vehicle_reg_id' => $status[0]['vehicle_reg_id']);
            } else {
                if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
                } else {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => 'vehicle registration failed');
                }
            }
        } else if ($flag == 3) {
            //  $status = $this->MRIMSIntegration->save_transport_fuelprice_details($xml_data, $inst_id, $apikey);
            if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
                return array('datastatus' => 1, 'error_status' => 0, 'message' => 'Vehicle fuel price data updated', 'vehicle_fuelprice_id' => $status[0]['fuel_price_id']);
            } else {
                if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
                } else {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => 'vehicle fuel price update failed');
                }
            }
        } else if ($flag == 4) {
            //  $status = $this->MRIMSIntegration->save_transport_fuellogbook_details($xml_data, $inst_id, $apikey);
            if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
                return array('datastatus' => 1, 'error_status' => 0, 'message' => 'Vehicle fuel logbook data updated', 'fuel_logbook_id' => $status[0]['fuel_logbook_id']);
            } else {
                if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
                } else {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => 'vehicle fuellogbook update failed');
                }
            }
        } else if ($flag == 5) {
            //  $status = $this->MRIMSIntegration->save_transport_trip_details($xml_data, $inst_id, $apikey);
            if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
                return array('datastatus' => 1, 'error_status' => 0, 'message' => 'transport trip data updated', 'trip_id' => $status[0]['trip_id']);
            } else {
                if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
                } else {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => 'transport trip data update failed');
                }
            }
        } else if ($flag == 6) {
            //  $status = $this->MRIMSIntegration->save_transport_pickup_point_details($xml_data, $inst_id, $apikey);
            if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
                return array('datastatus' => 1, 'error_status' => 0, 'message' => 'transport pickup point data updated', 'pickup_point_id' => $status[0]['pickup_point_id']);
            } else {
                if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
                } else {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => 'transport pickup point data update failed');
                }
            }
        } else if ($flag == 7) {
            //  $status = $this->MRIMSIntegration->save_transport_pickup_point_details($xml_data, $inst_id, $apikey);
            if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
                return array('datastatus' => 1, 'error_status' => 0, 'message' => 'transport trip pickup point relation data updated', 'trip_pick_id' => $status[0]['trip_pick_id']);
            } else {
                if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
                } else {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => 'transport trip pickup point relation data update failed');
                }
            }
        } else if ($flag == 8) {
            //  $status = $this->MRIMSIntegration->save_transport_pickup_point_details($xml_data, $inst_id, $apikey);
            if (isset($status[0]['datastatus']) && !empty($status[0]['datastatus']) && $status[0]['datastatus'] == 1) {
                return array('datastatus' => 1, 'error_status' => 0, 'message' => 'student allocation data updated', 'stud_allot_id' => $status[0]['stud_allot_id']);
            } else {
                if (isset($status['error_messages']) && !empty($status['error_messages'])) {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => $status['MSG']);
                } else {
                    return array('data_status' => 0, 'error_status' => 1, 'message' => 'student allocation data update failed');
                }
            }
        }
    }

    public function RIMS_get_priority_data($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }

        $status = $this->MRIMSIntegration->get_priority_student_data($inst_id, $apikey);
    }

    public function ACT_transactions_get_data($param)
    {
        $apikey = $param['API_KEY'];
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }

        $status = $this->MRIMSIntegration->get_act_transactions_data($inst_id, $apikey);
        if (isset($status[0]['ErrorStatus']) && !empty($status[0]['ErrorStatus']) && $status[0]['ErrorStatus'] == 1) {
            return array('datastatus' => 0, 'error_status' => 1, 'message' => $status[0]['ErrorMessage']);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => $status, 'message' => '');
        }
    }

    public function ACT_transactions_update_data($param)
    {
        $apikey = $param['API_KEY'];

        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'inst id is required', 'data' => FALSE);
        }
        $act_update_array_data = [];
        if (isset($param['act_update_data']) && !empty($param['act_update_data'])) {
            foreach ($param['act_update_data'] as $insert_id) {
                if ($insert_id['tran_insert_id'] != 0) {
                    $act_update_array_data[] = $insert_id['tran_id'];
                }
            }
            $act_update_data = $act_update_array_data;
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Update data is required', 'data' => FALSE);
        }


        $status = $this->MRIMSIntegration->update_act_transactions_data($inst_id, $apikey, $act_update_data);
        if (isset($status[0]['ErrorStatus']) && !empty($status[0]['ErrorStatus']) && $status[0]['ErrorStatus'] == 1) {
            return array('datastatus' => 0, 'error_status' => 1, 'message' => $status[0]['ErrorMessage']);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'data' => $status, 'message' => '');
        }
    }
}
