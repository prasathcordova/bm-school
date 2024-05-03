<?php

/**
 * Description of Fee_template_model
 *
 * @author aju.docme
 */
class Fee_template_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_template_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $template = $this->db->query("[docme_fees].[fee_template_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $template = $this->db->query("[docme_fees].[fee_template_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $template;
    }

    public function add_new_fee_template($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $template_data = $this->db->query("[docme_fees].[fee_template_Save] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($template_data) && is_array($template_data) && isset($template_data[0]['id']) && $template_data[0]['id'] > 0) {
                return $template_data[0];
            } else {
                if (isset($template_data[0]['ErrorMessage']) && !empty($template_data[0]['ErrorMessage'])) {
                    return array('ErrorStatus' => 1, 'ErrorMessage' => $template_data[0]['ErrorMessage']);
                } else {
                    return array('ErrorStatus' => 1, 'ErrorMessage' => 'Fee Template. Please check the data and try again');
                }
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Fee template is not added. Please check the data and try again');
        }
    }

    public function edit_fee_template($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $template_data = $this->db->query("[docme_fees].[fee_template_update] ?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($template_data) && is_array($template_data) && isset($template_data[0]['id']) && $template_data[0]['id'] > 0) {
                return $template_data[0];
            } else {
                if (isset($template_data[0]['ErrorMessage']) && !empty($template_data[0]['ErrorMessage'])) {
                    return array('ErrorStatus' => 1, 'ErrorMessage' => $template_data[0]['ErrorMessage']);
                } else {
                    return array('ErrorStatus' => 1, 'ErrorMessage' => 'Fee Template. Please check the data and try again');
                }
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Fee template is not modified. Please check the data and try again');
        }
    }

    public function delete_fee_template($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $template_data = $this->db->query("[docme_fees].[fee_template_delete] ?,?,?", $dbparams)->result_array();
            if (!empty($template_data) && is_array($template_data) && isset($template_data[0]['id']) && $template_data[0]['id'] > 0) {
                return $template_data[0];
            } else {
                if (isset($template_data[0]['ErrorMessage']) && !empty($template_data[0]['ErrorMessage'])) {
                    return array('ErrorStatus' => 1, 'ErrorMessage' => $template_data[0]['ErrorMessage']);
                } else {
                    return array('ErrorStatus' => 1, 'ErrorMessage' => 'Fee Template. Please check the data and try again');
                }
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Fee template is not modified. Please check the data and try again');
        }
    }

}
