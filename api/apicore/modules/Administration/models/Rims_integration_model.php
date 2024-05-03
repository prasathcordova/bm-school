<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rims_integration_model
 *
 * @author docme
 */
class Rims_integration_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save_registration($xml_data, $inst_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[rims_integration].[save_docme_registration] ?,?,?", array($apikey, $xml_data, $inst_id))->result_array();
        //        dev_export($data);
        //        die;
        return $data;
    }

    public function std_change_batch($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[rims_integration].[batch_change] ?,?,?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function std_change_status($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[rims_integration].[status_change] ?,?,?,?,?", $dbparams)->result_array();

        return $studentdata;
    }

    public function add_new_country($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $country = $this->db->query("[rims_integration].[country_save] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($country) && is_array($country)) {
                return $country[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Country not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Country not added. Please check the data and try again');
        }
    }

    public function add_new_state($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $state = $this->db->query("[rims_integration].[state_save] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($state) && is_array($state)) {
                return $state[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'State not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'State not added. Please check the data and try again');
        }
    }

    public function save_religion_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $community = $this->db->query("[rims_integration].[religion_save] ?,?,?", $dbparams)->result_array();
            if (!empty($community) && is_array($community)) {
                return $community[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Religion not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Religion not added. Please check the data and try again');
        }
    }

    public function add_new_caste($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $caste = $this->db->query("[rims_integration].[caste_save] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($caste) && is_array($caste)) {
                return $caste[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Caste not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Caste not added. Please check the data and try again');
        }
    }

    public function add_new_community($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $community = $this->db->query("[rims_integration].[community_save] ?,?,?", $dbparams)->result_array();
            if (!empty($community) && is_array($community)) {
                return $community[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Community not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Community not added. Please check the data and try again');
        }
    }

    public function add_new_currency($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $currency = $this->db->query("[rims_integration].[currency_save] ?,?,?,?", $dbparams)->result_array();
            if (!empty($currency) && is_array($currency)) {
                return $currency[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Currency not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Currency not added. Please check the data and try again');
        }
    }

    public function add_new_profession($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $language = $this->db->query("[rims_integration].[profession_save] ?,?,?,?", $dbparams)->result_array();
            if (!empty($language) && is_array($language)) {
                return $language[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Profession not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Profession not added. Please check the data and try again');
        }
    }

    public function add_new_language($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $language = $this->db->query("[rims_integration].[language_save] ?,?,?", $dbparams)->result_array();
            if (!empty($language) && is_array($language)) {
                return $language[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Language not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Language not added. Please check the data and try again');
        }
    }

    public function add_new_city($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $city = $this->db->query("[rims_integration].[city_save] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($city) && is_array($city)) {
                return $city[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'City not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'City not added. Please check the data and try again');
        }
    }

    public function download_act_transactions($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[rims_integration].[ACT_TRANSACTION_DOWNLOAD] ?,?,?,?", $dbparams)->result_array();

        return $data;
    }

    public function update_acdmaster($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("rims_integration.acd_year_master_save ?,?,?,?,?,?", $dbparams)->result_array();

        return $data;
    }

    public function update_course_details($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("rims_integration.course_details_save ?,?,?,?,?,?,?", $dbparams)->result_array();

        return $data;
    }

    public function update_batch_details($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[rims_integration].[batch_details_save] ?,?,?,?,?,?,?,?,?,?,?,?,?,?", $dbparams)->result_array();

        return $data;
    }

    public function download_update_act_transactions($id_data, $query_string, $inst_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[rims_integration].[download_update_act_transactions] ?,?,?,?", array($apikey, $query_string, $id_data, $inst_id))->result_array();

        if (!empty($data) && is_array($data)) {
            return $data[0];
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Update failed . Please check the data and try again');
        }
    }
    public function save_registration_RIMS($xml_data, $inst_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[rims_integration].[save_docme_registration_RIMS] ?,?,?", array($apikey, $xml_data, $inst_id))->result_array();
        return $data;
    }
    public function save_Longabs_registration_RIMS($xml_data, $inst_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[rims_integration].[save_Longabs_registration_RIMS] ?,?,?", array($apikey, $xml_data, $inst_id))->result_array();
        return $data;
    }
    public function update_registration_RIMS($xml_data, $inst_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[rims_integration].[update_docme_registration_RIMS] ?,?,?", array($apikey, $xml_data, $inst_id))->result_array();
        return $data;
    }
    public function save_parent_registration_RIMS($xml_data, $inst_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[rims_integration].[save_docme_parent_registration_RIMS] ?,?,?", array($apikey, $xml_data, $inst_id))->result_array();
        return $data;
    }
    public function save_parent_address_registration_RIMS($xml_data, $inst_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[rims_integration].[save_docme_parent_address_registration_RIMS] ?,?,?", array($apikey, $xml_data, $inst_id))->result_array();
        return $data;
    }
    public function save_designation_status($apikey, $inst_id, $desig_id, $desig_name, $desig_code, $description, $inst_desig_id, $desig_active)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[rims_integration].[update_designation_master] ?,?,?,?,?,?,?,?", array($apikey, $inst_id, $desig_id, $desig_name, $desig_code, $description, $inst_desig_id, $desig_active))->result_array();
        return $data;
    }
    public function save_department_status($apikey, $inst_id, $depart_id, $depart_code, $depart_name, $depart_desc)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[rims_integration].[update_department_master] ?,?,?,?,?,?", array($apikey, $inst_id, $depart_id, $depart_code, $depart_name, $depart_desc))->result_array();
        return $data;
    }
    public function save_emp_status($apikey, $inst_id, $emp_data, $emp_code, $emp_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[rims_integration].[update_emp_master] ?,?,?,?,?", array($apikey, $inst_id, $emp_data, $emp_code, $emp_id))->result_array();
        return $data;
    }
    public function save_transport_status($xml_data, $inst_id, $apikey, $flag)
    {
        $this->db->flush_cache();
        if ($flag == 1) {
            $procedure = "[rims_integration].[save_vehicle_type_data] ?,?,?";
        } else if ($flag == 2) {
            $procedure = "[rims_integration].[save_vehicle_registration_data] ?,?,?";
        } else if ($flag == 3) {
            $procedure = "[rims_integration].[save_vehicle_fuelprice_data] ?,?,?";
        } else if ($flag == 4) {
            $procedure = "[rims_integration].[save_vehicle_fuellogbook_data] ?,?,?";
        } else if ($flag == 5) {
            $procedure = "[rims_integration].[save_vehicle_trip_data] ?,?,?";
        } else if ($flag == 6) {
            $procedure = "[rims_integration].[save_vehicle_pickup_point_data] ?,?,?";
        } else if ($flag == 7) {
            $procedure = "[rims_integration].[save_vehicle_trip_pickup_data] ?,?,?";
        } else if ($flag == 8) {
            $procedure = "[rims_integration].[save_student_allotment_data] ?,?,?";
        }
        $data = $this->db->query($procedure, array($apikey, $xml_data, $inst_id))->result_array();
        return $data;
    }
    public function get_act_transactions_data($inst_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[dbo].[TALLY_ACT_transaction_data] ?,?,?,?", array($apikey, $inst_id, 'GET', NULL))->result_array();
        return $data;
    }
    public function update_act_transactions_data($inst_id, $apikey, $act_update_data)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[dbo].[TALLY_ACT_transaction_data] ?,?,?,?", array($apikey, $inst_id, 'UPDATE', json_encode($act_update_data)))->result_array();
        return $data;
    }
}
