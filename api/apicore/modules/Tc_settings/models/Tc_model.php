<?php

/**
 * Description of Tc_model
 *
 * @author Chandrajith.docme
 */
class Tc_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save_tc_data($student_details, $apikey)
    {
        $this->db->flush_cache();

        $prep_data = array(
            $apikey, $student_details['student_id'], $student_details['batchid'], $student_details['student_name'], $student_details['Admn_NO'], $student_details['Class_ID'], $student_details['Batch_Name'], $student_details['Cur_AcadYr'], $student_details['tc_reason'], $student_details['applytc_date']
        );
        if (is_array($prep_data)) {

            $tc_status = $this->db->query("[dbo].[student_tc_save] ?,?,?,?,?,?,?,?,?,?", $prep_data)->result_array();
            //            dev_export($tc_status);die;
            if (!empty($tc_status) && is_array($tc_status)) {
                return $tc_status[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Failed to apply TC. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Failed to apply TC. Please check the data and try again');
        }
    }
    public function check_tc_fee_demanded($student_id, $inst_id, $acdyr_id, $apikey)
    {
        $this->db->flush_cache();
        $tc = $this->db->query("[dbo].[check_tc_fee_demanded] ?,?,?,?", array($apikey, $inst_id, $acdyr_id, $student_id))->row_array();
        return $tc;
    }
    public function tc_cancel($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $tccancel = $this->db->query("[dbo].[student_tc_cancel] ?,?,?", $dbparams)->result_array();
            if (!empty($tccancel) && is_array($tccancel)) {
                return $tccancel[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'TC not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'TC not updated. Please check the data and try again');
        }
    }

    public function save_tcprepare_data($student_details, $apikey)
    {
        $this->db->flush_cache();
        //        dev_export($student_details);
        //        $prep_data = array(
        //            $apikey
        //            ,'app_id'
        //            , 'lastdateattend '
        //            , 'totalnumworkdays'
        //            , 'dayspresnt'
        //            , 'leavingclass'
        //            ,'leaving_year'
        //            , 'batchname'
        //            ,'acd_yr'
        //            , 'iseligiblefor'
        //            , 'promotedtoclass'
        //            ,'promotedtoacdyear'
        //            , 'characterconduct'
        //            ,'admn_no'
        //            ,'name'
        //        );
        $prep_data = array(
            $apikey,
            $student_details['batch_id'],
            $student_details['student_id'],
            $student_details['app_id'],
            $student_details['last_dateofattend'],
            $student_details['totalworkdays'],
            $student_details['totaldaysattend'],
            $student_details['leavingclass'],
            $student_details['acd_year'],
            $student_details['batch_name'],
            $student_details['eligible_forhigher'],
            $student_details['promotedclass'],
            $student_details['promoted_year'],
            $student_details['characonduct'],
            $student_details['leaving_year'],
            $student_details['name'],
            $student_details['admn_no'],
            $student_details['remark'],
            $student_details['resit_subject'],
            $student_details['tctype'],
            $student_details['games_extra_curricular'],
            $student_details['whether_ncc'],
            $student_details['subjects_studied'],
            $student_details['whether_failed']

        );

        if (is_array($prep_data)) {

            $tc_status = $this->db->query("[dbo].[tc_preparation_save] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?", $prep_data)->result_array();

            if (!empty($tc_status) && is_array($tc_status)) {
                return $tc_status[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Failed to prepare TC. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Failed to prepare TC. Please check the data and try again');
        }
    }

    public function get_tc_details($apikey)
    {
        $this->db->flush_cache();
        $tc = $this->db->query("[dbo].[Tc_appliedstudent_List] ?", array($apikey))->result_array();
        return $tc;
    }


    public function get_student_details($apikey, $acd_year, $batchid)
    {
        $this->db->flush_cache();
        if ($batchid == -1) {
            $studentdata = $this->db->query("[dbo].[Tc_student_List] ?,?,?", array($apikey, $acd_year, 0))->result_array();
        } else {
            $studentdata = $this->db->query("[dbo].[Tc_student_List] ?,?,?", array($apikey, $acd_year, $batchid))->result_array();
        }

        return $studentdata;
    }
    //this function written by ELavarasan S @ 16-05-2019 1:15
    public function get_student_details_byadmno($apikey, $admn_no)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[Tc_student_byAdmn_no] ?,?", array($apikey, $admn_no))->result_array();
        return $studentdata;
    }

    public function get_student_preparedlist($apikey, $acd_year, $batchid)
    {
        $this->db->flush_cache();
        if ($batchid == -1) {
            $studentdata = $this->db->query("[dbo].[Tc_preparedstudent_List] ?,?,?", array($apikey, $acd_year, 0))->result_array();
        } else {
            $studentdata = $this->db->query("[dbo].[Tc_preparedstudent_List] ?,?,?", array($apikey, $acd_year, $batchid))->result_array();
        }
        return $studentdata;
    }
    //this function written by ELavarasan S @ 16-05-2019 1:15
    public function get_student_preparedlist_by_admno($apikey, $admn_no)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[dbo].[Tc_preparedstudent_byAdmn_no] ?,?", array($apikey, $admn_no))->result_array();
        return $studentdata;
    }

    public function tc_details_id($dbparams)
    {
        $this->db->flush_cache();
        $tcdata = $this->db->query("[dbo].[studenttcprepare_select] ?,?", $dbparams)->result_array();
        return $tcdata;
    }

    public function tc_type_details($dbparams)
    {
        $this->db->flush_cache();
        $tcdata = $this->db->query("[dbo].[tctype_select] ?,?", $dbparams)->result_array();
        return $tcdata;
    }
    public function get_student_tcissuedata($dbparams)
    {
        $this->db->flush_cache();
        $tcdata = $this->db->query("[dbo].[studenttc_select_issue] ?,?,?,?,?", $dbparams)->result_array();

        return $tcdata;
    }
}
