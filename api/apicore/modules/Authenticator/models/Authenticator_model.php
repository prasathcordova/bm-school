<?php

/**
 * Description of Authenticator_model
 *
 * @author aju.docme
 */
class Authenticator_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_status($apikey, $dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $user_data = $this->db->query("[Auth].[check_login] ?,?,?,?", $dbparams)->result_array();
            if (!empty($user_data) && is_array($user_data)) {
                return array('ErrorStatus' => 0, 'ErrorMessage' => '', 'data' => $user_data[0]);
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid credentials / API Key Error');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid API Key error');
        }
    }

    public function get_user_verify_for_otp($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $user_data = $this->db->query("[Auth].[check_user_for_otp_request] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($user_data) && is_array($user_data)) {
                return array('ErrorStatus' => 0, 'ErrorMessage' => '', 'data' => $user_data[0]);
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid credentials / API Key Error');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid API Key error');
        }
    }

    public function get_user_details($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $user_data = $this->db->query("[settings].[userprofile_select] ?,?,?,?", $dbparams)->result_array();
            if (!empty($user_data) && is_array($user_data)) {
                return array('ErrorStatus' => 0, 'ErrorMessage' => '', 'data' => $user_data[0]);
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid credentials / API Key Error');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid API Key error');
        }
    }

    public function get_user_inst_details($appikey)
    {
        $this->db->flush_cache();
        if (is_array($appikey)) {
            $user_data = $this->db->query("[settings].[applicationcredentials_select] ?", $appikey)->result_array();
            if (!empty($user_data) && is_array($user_data)) {
                return array('ErrorStatus' => 0, 'ErrorMessage' => '', 'data' => $user_data[0]);
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid credentials / API Key Error');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid API Key error');
        }
    }

    public function get_primary_details($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $user_data = $this->db->query("[settings].[applicationcredentials_select] ?", $dbparams)->result_array();
            if (!empty($user_data) && is_array($user_data)) {
                return array('ErrorStatus' => 0, 'ErrorMessage' => '', 'data' => $user_data[0]);
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid credentials / API Key Error');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid API Key error');
        }
    }
    //SALAHUDHEEN
    public function get_currency_details($apikey, $currencyid)
    {
        $this->db->flush_cache();
        //if (is_array($dbparams)) {
        $user_data = $this->db->query("[settings].[institution_currency_select] ?,?", array($apikey, $currencyid))->result_array();
        if (!empty($user_data) && is_array($user_data)) {
            return array('ErrorStatus' => 0, 'ErrorMessage' => '', 'data' => $user_data[0]);
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid credentials / API Key Error');
        }
        //        } else {
        //            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid API Key error');
        //        }
    }
    public function verify_to_authenticate_parent_with_otp($apikey, $api_key_validate, $otp)
    {
        $this->db->flush_cache();
        $user_data = $this->db->query("[Auth].[verify_and_login_with_otp_parent] ?,?,?", array($apikey, $api_key_validate, $otp))->result_array();
        return $user_data;
    }

    public function get_user_login($dbparams)
    {
        // return $dbparams;
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $user_data = $this->db->query("[Auth].[App_login] ?,?,?", $dbparams)->result_array();
            if (!empty($user_data) && is_array($user_data)) {
                return array('ErrorStatus' => 0, 'ErrorMessage' => '', 'data' => $user_data[0]);
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid credentials / API Key Error');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid API Key error');
        }
    }
    public function get_mis_user($dbparams)
    {
        // return $dbparams;die;
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $user_data = $this->db->query("[MIS].[MIS_LOGIN] ?,?,?,?", $dbparams)->result_array();
            if (!empty($user_data) && is_array($user_data)) {
                return array('ErrorStatus' => 0, 'ErrorMessage' => '', 'data' => $user_data[0]);
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid credential');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid credentials');
        }
    }
    public function get_mis_inst($dbparams)
    {
        // return $dbparams;die;
        $this->db->flush_cache();
        // if (is_array($dbparams)) {
        //     $user_data = $this->db->query("[MIS].[MIS_INST_DETAILS] ?", $dbparams)->row_array();
        //     if (!empty($user_data) && is_array($user_data)) {
        //         return array('ErrorStatus' => 0, 'ErrorMessage' => '', 'data' => $user_data[0]);
        //     } else {
        //         return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid credentials');
        //     }
        // } else {
        //     return array('ErrorStatus' => 1, 'ErrorMessage' => 'Invalid credentials');
        // }
        if(is_array($dbparams)) {
            $strength_list = $this->db->query("[MIS].[MIS_INST_DETAILS] ?", $dbparams)->row_array();
        } else {
            $strength_list = $this->db->query("[MIS].[MIS_INST_DETAILS] ?", array(NULL))->row_array();
        }        
        return $strength_list;
    }
    public function update_mis_pass($dbparams)
    {
        // return $dbparams;die;
        $this->db->flush_cache();
        $result_list = $this->db->query("[MIS].[MIS_UpdatePassword] ?,?,?,?", $dbparams)->result_array();
        // return $this->db->affected_rows();
        // if(is_array($dbparams)) {
        //     $result_list = $this->db->query("[MIS].[MIS_UpdatePassword] ?,?,?", $dbparams)->row_array();
        // }//else {
        //     $result_list = $this->db->query("[MIS].[MIS_UpdatePassword] ?,?,?", array(NULL))->row_array();
        // }        
        return $result_list;
    }
    public function acd_year_details($dbparams)
    {
        // return $dbparams;die;
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $result_list = $this->db->query("[MIS].[MIS_ACD_YEAR_DETAILS] ?", $dbparams)->row_array();
        } else {
            $result_list = $this->db->query("[MIS].[MIS_ACD_YEAR_DETAILS] ?", array(NULL))->row_array();
        }        
        return $result_list;
    }
}