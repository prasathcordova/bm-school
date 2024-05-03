<?php


/**
 * Description of Profession_model
 *
 * @author Salahudheen DocMe
 */
class Institution_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_institution_list($apikey)
    {
        $this->db->flush_cache();
        $institution_list = $this->db->query("[docme_fees].[get_institution_list] ?", array($apikey))->result_array();
        return $institution_list;
    }
    public function get_employee_list_from_wfm($dbparams)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[settings].[get_employee_list_from_wfm] ?,?,?,?", $dbparams)->result_array();

        return $data;
    }

    public function system_parameters_operation($dbparams)
    {
        $this->db->flush_cache();
        $params = procedure_param_string($dbparams);
        $data = $this->db->query("[settings].[system_parameters_operation] $params", $dbparams)->result_array();
        //$data = $this->db->query("SELECT * FROM SYSTEM_PARAMETERS where inst_id=" . $dbparams[1] . "order by Code Asc")->result_array();
        return $data;
    }
}
