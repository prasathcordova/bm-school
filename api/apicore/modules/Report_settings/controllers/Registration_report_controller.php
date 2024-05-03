<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registration_report
 *
 * @author Shamna
 */
class Registration_report_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Registration_report_model', 'MRegRpt');
    }

    //Student Strength Details Report

    public function get_strength_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[2] = $params['class_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        $dbparams[3] = $params['new_admission'];
        //        return $dbparams;
        $strngth_rpt_add_status = $this->MRegRpt->get_rpt_studstrngth($dbparams);
        if (!empty($strngth_rpt_add_status) && is_array($strngth_rpt_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $strngth_rpt_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_student_id_wise_report($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acd_year_id']) && !empty($params['acd_year_id'])) {
            $dbparams[1] = $params['acd_year_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        // if (isset($params['class_id']) && !empty($params['class_id'])) {
        //     $dbparams[2] = $params['class_id'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class is required', 'data' => FALSE);
        // }
        if (isset($params['batch_id']) && !empty($params['batch_id'])) {
            $dbparams[2] = $params['batch_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class is required', 'data' => FALSE);
        }
        //        return $dbparams;
        $strngth_rpt_add_status = $this->MRegRpt->get_student_id_wise_report($dbparams);
        if (!empty($strngth_rpt_add_status) && is_array($strngth_rpt_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $strngth_rpt_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Create familywise report by vinoth @17-06-2019 11:55
    public function get_familywise_data_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['classid']) && !empty($params['classid'])) {
            $dbparams[2] = $params['classid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class is required', 'data' => FALSE);
        }
        $familywise_rpt = $this->MRegRpt->get_rp_familywise($dbparams);
        if (!empty($familywise_rpt) && is_array($familywise_rpt)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $familywise_rpt);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Student Nationalitywise Report


    public function get_nationality_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['nation']) && !empty($params['nation'])) {
            $dbparams[2] = $params['nation'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Nationality is required', 'data' => FALSE);
        }
        if (isset($params['FromDt']) && !empty($params['FromDt'])) {
            $dbparams[3] = $params['FromDt'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['ToDt']) && !empty($params['ToDt'])) {
            $dbparams[4] = $params['ToDt'];
        } else {
            $dbparams[4] = NULL;
        }
        //        dev_export($dbparams);die;
        $nation_rpt_add_status = $this->MRegRpt->get_nationality_rpt($dbparams);
        //        dev_export($nation_rpt_add_status);die;
        if (!empty($nation_rpt_add_status) && is_array($nation_rpt_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $nation_rpt_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //PROMOTION REPORT
    public function get_promotion_report($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst data  is required', 'data' => FALSE);
        }
        if (isset($params['acdyr']) && !empty($params['acdyr'])) {
            $dbparams[2] = $params['acdyr'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['class']) && !empty($params['class'])) {
            $dbparams[3] = $params['class'];
        } else {
            $dbparams[3] = NULL;
        }
        // if (isset($params['from_date']) && !empty($params['from_date'])) {
        //     $dbparams[2] = $params['from_date'];
        // } else {
        //     $dbparams[2] = NULL;
        // }
        // if (isset($params['to_date']) && !empty($params['to_date'])) {
        //     $dbparams[3] = $params['to_date'];
        // } else {
        //     $dbparams[3] = NULL;
        // }
        //        dev_export($dbparams);die;
        $nation_rpt_add_status = $this->MRegRpt->get_promotion_rpt($dbparams);
        //        dev_export($nation_rpt_add_status);die;
        if (!empty($nation_rpt_add_status) && is_array($nation_rpt_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $nation_rpt_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //PROMOTION REPORT
    public function get_detained_report($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst data is required', 'data' => FALSE);
        }
        if (isset($params['acdyr']) && !empty($params['acdyr'])) {
            $dbparams[2] = $params['acdyr'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['class']) && !empty($params['class'])) {
            $dbparams[3] = $params['class'];
        } else {
            $dbparams[3] = NULL;
        }
        // if (isset($params['from_date']) && !empty($params['from_date'])) {
        //     $dbparams[2] = $params['from_date'];
        // } else {
        //     $dbparams[2] = NULL;
        // }
        // if (isset($params['to_date']) && !empty($params['to_date'])) {
        //     $dbparams[3] = $params['to_date'];
        // } else {
        //     $dbparams[3] = NULL;
        // }
        //        dev_export($dbparams);die;
        $nation_rpt_add_status = $this->MRegRpt->get_detained_rpt($dbparams);
        //        dev_export($nation_rpt_add_status);die;
        if (!empty($nation_rpt_add_status) && is_array($nation_rpt_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $nation_rpt_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Religionwise Report

    public function get_religion_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['religion']) && !empty($params['religion'])) {
            $dbparams[2] = $params['religion'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Religion is required', 'data' => FALSE);
        }
        if (isset($params['FromDt']) && !empty($params['FromDt'])) {
            $dbparams[3] = $params['FromDt'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['ToDt']) && !empty($params['ToDt'])) {
            $dbparams[4] = $params['ToDt'];
        } else {
            $dbparams[4] = NULL;
        }

        $religion_rpt_add_status = $this->MRegRpt->get_religion_rpt($dbparams);
        if (!empty($religion_rpt_add_status) && is_array($religion_rpt_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $religion_rpt_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Castewise Report

    public function get_caste_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['cls']) && !empty($params['cls'])) {
            $dbparams[2] = $params['cls'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class is required', 'data' => FALSE);
        }
        if (isset($params['caste']) && !empty($params['caste'])) {
            $dbparams[3] = $params['caste'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Caste is required', 'data' => FALSE);
        }


        $caste_rpt_add_status = $this->MRegRpt->get_caste_rpt($dbparams);
        if (!empty($caste_rpt_add_status) && is_array($caste_rpt_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $caste_rpt_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Class/Divisionwise Report

    public function get_classdivision_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['classs']) && !empty($params['classs'])) {
            $dbparams[2] = $params['classs'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class is required', 'data' => FALSE);
        }
        if (isset($params['division']) && !empty($params['division'])) {
            $dbparams[3] = $params['division'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class is required', 'data' => FALSE);
        }
        if (isset($params['Dt']) && !empty($params['Dt'])) {
            $dbparams[4] = $params['Dt'];
        } else {
            $dbparams[4] = NULL;
        }
        if (isset($params['Td']) && !empty($params['Td'])) {
            $dbparams[5] = $params['Td'];
        } else {
            $dbparams[5] = NULL;
        }
        //        return $dbparams;

        $classdivin_rpt_add_status = $this->MRegRpt->get_classdivsn_rpt($dbparams);
        if (!empty($classdivin_rpt_add_status) && is_array($classdivin_rpt_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $classdivin_rpt_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Class wise strngth Report

    public function get_classwisestrgth_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['class']) && !empty($params['class'])) {
            $dbparams[2] = $params['class'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class is required', 'data' => FALSE);
        }
        //return $dbparams;
        $classdivin_rpt_add_status = $this->MRegRpt->get_classwisestrnth_rpt($dbparams);
        if (!empty($classdivin_rpt_add_status) && is_array($classdivin_rpt_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $classdivin_rpt_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_no_batchstud_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['class']) && !empty($params['class'])) {
            $dbparams[2] = $params['class'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class is required', 'data' => FALSE);
        }
        //return $dbparams;
        $classdivin_rpt_add_status = $this->MRegRpt->get_no_batchstud_rpt($dbparams);
        if (!empty($classdivin_rpt_add_status) && is_array($classdivin_rpt_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $classdivin_rpt_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Collected Document Report

    public function get_collecteddoc_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['batch']) && !empty($params['batch'])) {
            $dbparams[2] = $params['batch'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch is required', 'data' => FALSE);
        }

        $collectdoc_rpt = $this->MRegRpt->get_collected_rpt($dbparams);
        if (!empty($collectdoc_rpt) && is_array($collectdoc_rpt)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $collectdoc_rpt);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Agewise Report

    public function get_studagewise_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['stream']) && !empty($params['stream'])) {
            $dbparams[2] = $params['stream'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Stream is required', 'data' => FALSE);
        }
        if (isset($params['cls']) && !empty($params['cls'])) {
            $dbparams[3] = $params['cls'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class is required', 'data' => FALSE);
        }
        if (isset($params['batch']) && !empty($params['batch'])) {
            $dbparams[4] = $params['batch'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch is required', 'data' => FALSE);
        }
        if (isset($params['age']) && !empty($params['age'])) {
            $dbparams[5] = $params['age'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Age is required', 'data' => FALSE);
        }

        $agewise_rpt = $this->MRegRpt->get_agewise_rpt($dbparams);
        if (!empty($agewise_rpt) && is_array($agewise_rpt)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $agewise_rpt);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Contactwise Report

    public function get_studcontact_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['relation']) && !empty($params['relation'])) {
            $dbparams[1] = $params['relation'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Relation is required', 'data' => FALSE);
        }
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[2] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['stream']) && !empty($params['stream'])) {
            $dbparams[3] = $params['stream'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Stream is required', 'data' => FALSE);
        }
        if (isset($params['cls']) && !empty($params['cls'])) {
            $dbparams[4] = $params['cls'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class is required', 'data' => FALSE);
        }
        if (isset($params['batch']) && !empty($params['batch'])) {
            $dbparams[5] = $params['batch'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch is required', 'data' => FALSE);
        }



        $contact_rpt = $this->MRegRpt->get_contactwise_rpt($dbparams);
        if (!empty($contact_rpt) && is_array($contact_rpt)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $contact_rpt);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Familywise Report

    public function get_familywise_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['frmDt']) && !empty($params['frmDt'])) {
            $dbparams[2] = $params['frmDt'];
        } else {
            $dbparams[2] = NULL;
        }
        //       dev_export($dbparams);die;
        $family_rpt = $this->MRegRpt->get_familywisestud_rpt($dbparams);

        if (!empty($family_rpt) && is_array($family_rpt)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $family_rpt);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Lonabsentee wise Report

    public function get_longabsnt_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['batchid']) && !empty($params['batchid'])) {
            $dbparams[2] = $params['batchid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch is required', 'data' => FALSE);
        }
        if (isset($params['FromDt']) && !empty($params['FromDt']) || empty($params['FromDt']) == -1) {
            $dbparams[3] = $params['FromDt'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['ToDt']) && !empty($params['ToDt']) || empty($params['ToDt']) == -1) {
            $dbparams[4] = $params['ToDt'];
        } else {
            $dbparams[4] = NULL;
        }

        //       dev_export($dbparams);die;
        $longabsnt_rpt = $this->MRegRpt->get_longabsntwise_rpt($dbparams);
        //        dev_export($longabsnt_rpt);die;
        if (!empty($longabsnt_rpt) && is_array($longabsnt_rpt)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $longabsnt_rpt);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //SexAgewise Report

    public function get_studsexagewise_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[2] = $params['class_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class is required', 'data' => FALSE);
        }
        if (isset($params['Fromdt']) && !empty($params['Fromdt'])) {
            $dbparams[3] = $params['Fromdt'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['Todt']) && !empty($params['Todt'])) {
            $dbparams[4] = $params['Todt'];
        } else {
            $dbparams[4] = NULL;
        }
        //return $dbparams;
        $sexage_rpt = $this->MRegRpt->get_sexagewise_rpt($dbparams);
        if (!empty($sexage_rpt) && is_array($sexage_rpt)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $sexage_rpt);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Genderwise Report

    public function get_genderwise_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['gender']) && !empty($params['gender'])) {
            $dbparams[2] = $params['gender'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Gender is required', 'data' => FALSE);
        }
        if (isset($params['FromDt']) && !empty($params['FromDt'])) {
            $dbparams[3] = $params['FromDt'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['ToDt']) && !empty($params['ToDt'])) {
            $dbparams[4] = $params['ToDt'];
        } else {
            $dbparams[4] = NULL;
        }

        $gender_rpt = $this->MRegRpt->get_genderwisestud_rpt($dbparams);
        if (!empty($gender_rpt) && is_array($gender_rpt)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $gender_rpt);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //Professionnwise Report

    public function get_profesion_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[1] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }
        if (isset($params['profession']) && !empty($params['profession'])) {
            $dbparams[2] = $params['profession'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'profession is required', 'data' => FALSE);
        }


        $profession_rpt = $this->MRegRpt->get_profession_wise_rpt($dbparams);
        if (!empty($profession_rpt) && is_array($profession_rpt)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $profession_rpt);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_tc_summary_report($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst data is required', 'data' => FALSE);
        }
        if (isset($params['acdyr']) && !empty($params['acdyr'])) {
            $dbparams[2] = $params['acdyr'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['class']) && !empty($params['class'])) {
            $dbparams[3] = $params['class'];
        } else {
            $dbparams[3] = NULL;
        }
        // if (isset($params['from_date']) && !empty($params['from_date'])) {
        //     $dbparams[2] = $params['from_date'];
        // } else {
        //     $dbparams[2] = NULL;
        // }
        // if (isset($params['to_date']) && !empty($params['to_date'])) {
        //     $dbparams[3] = $params['to_date'];
        // } else {
        //     $dbparams[3] = NULL;
        // }
        //        dev_export($dbparams);die;
        $rpt_data = $this->MRegRpt->get_summary_rpt_tc($dbparams);
        //        dev_export($nation_rpt_add_status);die;
        if (!empty($rpt_data) && is_array($rpt_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $rpt_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_tc_app_status_report($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst data is required', 'data' => FALSE);
        }
        if (isset($params['acd_year']) && !empty($params['acd_year'])) {
            $dbparams[2] = $params['acd_year'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[3] = $params['class_id'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['rpt_type']) && !empty($params['rpt_type'])) {
            $dbparams[4] = $params['rpt_type'];
        } else {
            $dbparams[4] = 1;
        }
        $rpt_data = $this->MRegRpt->get_app_status_rpt_tc($dbparams);

        if (!empty($rpt_data) && is_array($rpt_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $rpt_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_course_classwise_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = 1;
        $dbparams[1] = $params['API_KEY'];
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[2] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }      
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst data is required', 'data' => FALSE);
        }  
      
        //        return $dbparams;
        $course_classwise_rpt_status = $this->MRegRpt->get_rpt_course_classwise($dbparams);
        if (!empty($course_classwise_rpt_status) && is_array($course_classwise_rpt_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $course_classwise_rpt_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_course_batchwise_rpt($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = 1;
        $dbparams[1] = $params['API_KEY'];
        $dbparams[2] = '';
        if (isset($params['acdyear']) && !empty($params['acdyear'])) {
            $dbparams[3] = $params['acdyear'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year  is required', 'data' => FALSE);
        }   
        if (isset($params['classid']) && !empty($params['classid'])) {
            $dbparams[4] = $params['classid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class data is required', 'data' => FALSE);
        }   
        //        return $dbparams;
        $course_batchwise_rpt_status = $this->MRegRpt->get_rpt_course_batchwise($dbparams);
        if (!empty($course_batchwise_rpt_status) && is_array($course_batchwise_rpt_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $course_batchwise_rpt_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    
}
