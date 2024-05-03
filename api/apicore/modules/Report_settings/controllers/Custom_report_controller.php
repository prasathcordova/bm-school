<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Custom_report_controller
 *
 * @author Shamna
 */
class Custom_report_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_rpt_model', 'MCusRpt');
    }


    public function get_custom_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['admisndt1']) && !empty($params['admisndt1'])) {
            $dbparams[1] = $params['admisndt1'];
        } else {
            $dbparams[1] = NULL;
        }
        if (isset($params['admisndt2']) && !empty($params['admisndt2'])) {
            $dbparams[2] = $params['admisndt2'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['admisndt3']) && !empty($params['admisndt3'])) {
            $dbparams[3] = $params['admisndt3'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['f_name']) && !empty($params['f_name'])) {
            $dbparams[4] = $params['f_name'];
        } else {
            $dbparams[4] = NULL;
        }
        if (isset($params['m_name']) && !empty($params['m_name'])) {
            $dbparams[5] = $params['m_name'];
        } else {
            $dbparams[5] = NULL;
        }
        if (isset($params['l_name']) && !empty($params['l_name'])) {
            $dbparams[6] = $params['l_name'];
        } else {
            $dbparams[6] = NULL;
        }
        if (isset($params['admnno']) && !empty($params['admnno'])) {
            $dbparams[7] = $params['admnno'];
        } else {
            $dbparams[7] = NULL;
        }
        if (isset($params['gender']) && !empty($params['gender'])) {
            $dbparams[8] = $params['gender'];
        } else {
            $dbparams[8] = NULL;
        }
        if (isset($params['bdgp']) && !empty($params['bdgp'])) {
            $dbparams[9] = $params['bdgp'];
        } else {
            $dbparams[9] = NULL;
        }
        if (isset($params['language']) && !empty($params['language'])) {
            $dbparams[10] = $params['language'];
        } else {
            $dbparams[10] = NULL;
        }
        if (isset($params['religion']) && !empty($params['religion'])) {
            $dbparams[11] = $params['religion'];
        } else {
            $dbparams[11] = NULL;
        }
        if (isset($params['city']) && !empty($params['city'])) {
            $dbparams[12] = $params['city'];
        } else {
            $dbparams[12] = NULL;
        }
        if (isset($params['state']) && !empty($params['state'])) {
            $dbparams[13] = $params['state'];
        } else {
            $dbparams[13] = NULL;
        }
        if (isset($params['pincode']) && !empty($params['pincode'])) {
            $dbparams[14] = $params['pincode'];
        } else {
            $dbparams[14] = NULL;
        }
        if (isset($params['birthplace']) && !empty($params['birthplace'])) {
            $dbparams[15] = $params['birthplace'];
        } else {
            $dbparams[15] = NULL;
        }
        if (isset($params['phnno']) && !empty($params['phnno'])) {
            $dbparams[16] = $params['phnno'];
        } else {
            $dbparams[16] = NULL;
        }
        if (isset($params['mobile']) && !empty($params['mobile'])) {
            $dbparams[17] = $params['mobile'];
        } else {
            $dbparams[17] = NULL;
        }
        if (isset($params['country']) && !empty($params['country'])) {
            $dbparams[18] = $params['country'];
        } else {
            $dbparams[18] = NULL;
        }
        if (isset($params['nation']) && !empty($params['nation'])) {
            $dbparams[19] = $params['nation'];
        } else {
            $dbparams[19] = NULL;
        }
        if (isset($params['batch']) && !empty($params['batch'])) {
            $dbparams[20] = $params['batch'];
        } else {
            $dbparams[20] = NULL;
        }
        if (isset($params['immediate_cnt']) && !empty($params['immediate_cnt'])) {
            $dbparams[21] = $params['immediate_cnt'];
        } else {
            $dbparams[21] = NULL;
        }
        if (isset($params['stud_catgry']) && !empty($params['stud_catgry'])) {
            $dbparams[22] = $params['stud_catgry'];
        } else {
            $dbparams[22] = NULL;
        }

        $custum_rpt = $this->MCusRpt->get_rpt_custom($dbparams);
        if (!empty($custum_rpt) && is_array($custum_rpt)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $custum_rpt);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function spread_sheet_query($params)
    {
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $custum_rpt = $this->MCusRpt->spread_sheet_query($params['inst_id'], $params['type'], $params['acd_year']);
        } else {
            $custum_rpt = NULL;
        }

        if (!empty($custum_rpt) && is_array($custum_rpt)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $custum_rpt);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
