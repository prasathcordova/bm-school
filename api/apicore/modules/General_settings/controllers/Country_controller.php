<?php

/**
 * Class Name   : General_settings_controller
 * Description  : Manipulate country data section in general settings
 * @author      : Aju S Aravind
 * Created On   : 23-May-2017
 * 
 */
class Country_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Country_model', 'MCountry');
    }

    public function get_countries($params = NULL)
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
                    $query_string = $query_string . " AND " . "c.country_id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.country_id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.country_name LIKE '%" . $params['name'] . "%' ";
                } else {
                    $query_string = "c.country_name LIKE '%" . $params['name'] . "%' ";
                }
            }
            if (isset($params['abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.country_abbr LIKE '%" . $params['abbr'] . "%' ";
                } else {
                    $query_string = "c.country_abbr LIKE '%" . $params['abbr'] . "%' ";
                }
            }
            if (isset($params['currency_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cr.currency_name LIKE '%" . $params['currency_name'] . "%' ";
                } else {
                    $query_string = "cr.currency_name LIKE '%" . $params['currency_name'] . "%'";
                }
            }
            if (isset($params['currency_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cr.currency_abbr LIKE '%" . $params['currency_abbr'] . "%' ";
                } else {
                    $query_string = "cr.currency_abbr LIKE '%" . $params['currency_abbr'] . "%'";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.country_id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.country_id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.country_name = '" . $params['name'] . "' ";
                } else {
                    $query_string = "c.country_name = '" . $params['name'] . "' ";
                }
            }
            if (isset($params['abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.country_abbr = '" . $params['abbr'] . "' ";
                } else {
                    $query_string = "c.country_abbr = '" . $params['abbr'] . "' ";
                }
            }
            if (isset($params['currency_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cr.currency_name = '" . $params['currency_name'] . "' ";
                } else {
                    $query_string = "cr.currency_name = '" . $params['currency_name'] . "'";
                }
            }
            if (isset($params['currency_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "cr.currency_abbr = '" . $params['currency_abbr'] . "' ";
                } else {
                    $query_string = "cr.currency_abbr = '" . $params['currency_abbr'] . "'";
                }
            }
        }


        $country_list = $this->MCountry->get_country_details($apikey, $query_string);
        if (!empty($country_list) && is_array($country_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $country_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_country($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['country_name']) && !empty($params['country_name'])) {
            $dbparams[1] = $params['country_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country Name is required', 'data' => FALSE);
        }
        if (isset($params['country_abbr']) && !empty($params['country_abbr'])) {
            $dbparams[2] = $params['country_abbr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country Abbrivation is required', 'data' => FALSE);
        }
        if (isset($params['country_nation']) && !empty($params['country_nation'])) {
            $dbparams[3] = $params['country_nation'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country Nation is required', 'data' => FALSE);
        }
        if (isset($params['currency_id']) && !empty($params['currency_id'])) {
            $dbparams[4] = $params['currency_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Currency details is required', 'data' => FALSE);
        }
        $country_add_status = $this->MCountry->add_new_country($dbparams);
        if (!empty($country_add_status) && is_array($country_add_status) && $country_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('country_id' => $country_add_status['Country_id']));
        } else {
            if (is_array($country_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $country_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_country($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['country_id']) && !empty($params['country_id'])) {
            $dbparams[1] = $params['country_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country ID is required', 'data' => FALSE);
        }
        if (isset($params['country_name']) && !empty($params['country_name'])) {
            $dbparams[2] = $params['country_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country Name is required', 'data' => FALSE);
        }
        if (isset($params['country_nation']) && !empty($params['country_nation'])) {
            $dbparams[3] = $params['country_nation'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country Nation is required', 'data' => FALSE);
        }
        if (isset($params['country_abbr']) && !empty($params['country_abbr'])) {
            $dbparams[4] = $params['country_abbr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country Abbrivation is required', 'data' => FALSE);
        }
        if (isset($params['country_nation']) && !empty($params['country_nation'])) {
            $dbparams[4] = $params['country_nation'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country Nation is required', 'data' => FALSE);
        }
        if (isset($params['currency_id']) && !empty($params['currency_id'])) {
            $dbparams[5] = $params['currency_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Currency details is required', 'data' => FALSE);
        }
        $dbparams[6] = 1;
        $dbparams[7] = 0;
        $country_add_status = $this->MCountry->update_country_data($dbparams);
        if (!empty($country_add_status) && is_array($country_add_status) && isset($country_add_status['ErrorStatus']) && $country_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $country_add_status);
        } else {
            if (isset($country_add_status['ErrorMessage']) && !empty($country_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $country_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_country_status($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['country_id']) && !empty($params['country_id'])) {
            $dbparams[1] = $params['country_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = 0;

        if (isset($params['status'])) {
            $dbparams[7] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country Status is required', 'data' => FALSE);
        }

        $country_add_status = $this->MCountry->update_country_data($dbparams);
        //        dev_export($country_add_status); die;
        if (!empty($country_add_status['ErrorStatus']) && is_array($country_add_status) && $country_add_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $country_add_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $country_add_status['ErrorMessage'], 'data' => TRUE);
        }
    }
}
