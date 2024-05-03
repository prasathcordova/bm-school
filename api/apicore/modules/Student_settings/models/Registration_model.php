<?php

/**
 * Description of Registration_model
 * This controller is to deal with database operation for the registration purpose.
 * @author Aju S Aravind
 * Created Date : 01-Oct-2017
 */
class Registration_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_sponsers_list($apikey, $query)
    {
        $this->db->flush_cache();
        //        return strlen($query);
        if (strlen($query) > 0) {
            $sponser = $this->db->query("[settings].[sponsers_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $sponser = $this->db->query("[settings].[sponsers_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $sponser;
    }

    public function add_new_sponser($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $currency = $this->db->query("[settings].[add_sponser] ?,?,?", $dbparams)->result_array();
            if (!empty($currency) && is_array($currency)) {
                return $currency[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Currency not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Currency not added. Please check the data and try again');
        }
    }

    public function update_sponser_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $sponser = $this->db->query("[settings].[update_sponser] ?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($sponser) && is_array($sponser)) {
                return $sponser[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Currency not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Currency not updated. Please check the data and try again');
        }
    }

    public function email_validation($apikey, $email, $sibling_id, $relation, $inst_id = 0, $student_id = 0)
    {
        $this->db->flush_cache();

        $data = $this->db->query("[dbo].[email_validation] ?,?,?,?,?,?", array($apikey, $email, $sibling_id, $relation, $inst_id, $student_id))->result_array();
        //          dev_export($data);die;
        return isset($data[0]) ? $data['0'] : $data;
    }

    public function student_profile_edit($student_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_student_profile_details] ?,?", array($apikey, $student_id))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    public function student_language_view($student_id, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_student_known_languages] ?,?", array($apikey, $student_id))->result_array();

        return $data;
    }

    public function adhar_validation($params, $student_id, $flag, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[dbo].[adhar_validation] ?,?,?,?", array($apikey, $params, $student_id, $flag))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    public function mobile_validation($apikey, $mobile_number, $sibling_id, $relation, $inst_id = 0, $student_id = 0)
    {
        $this->db->flush_cache();

        $data = $this->db->query("[dbo].[mobile_validation] ?,?,?,?,?,?", array($apikey, $mobile_number, $sibling_id, $relation, $inst_id, $student_id))->result_array();
        //          dev_export($data);die;
        return isset($data[0]) ? $data['0'] : $data;
    }

    public function save_facility_details($student_details, $apikey)
    {
        $this->db->flush_cache();

        $prep_data = array(
            $apikey, $student_details['studentid'], $student_details['istransport'], $student_details['ismess'], $student_details['ishostel'], $student_details['iso_service']
        );

        $data = $this->db->query("[docme_registration].[save_facilities_details] ?,?,?,?,?,?", $prep_data)->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }





    public function save_personal_profile($params, $apikey, $student_image, $xml_language, $student_temp_id)
    {
        $this->db->flush_cache();
        //        return $xml_language ;
        $data = $this->db->query("[docme_registration].[save_personal_profile_registration] ?,?,?,?,?", array($apikey, $params, $student_image, $xml_language, $student_temp_id))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    public function edit_personal_profile($params, $apikey, $student_image, $xml_language, $student_id)
    {
        $this->db->flush_cache();
        //        return $xml_language ;
        $data = $this->db->query("[docme_registration].[edit_personal_profile_registration] ?,?,?,?,?", array($apikey, $params, $student_image, $xml_language, $student_id))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    public function save_academic_profile($params, $apikey, $studentid, $student_temp_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[save_academic_profile_registration] ?,?,?,?", array($apikey, $params, $studentid, $student_temp_id))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    public function edit_academic_profile($params, $apikey, $studentid)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[edit_academic_profile_registration] ?,?,?", array($apikey, $params, $studentid))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    public function save_other_details($student_details, $apikey, $studentid, $flag1, $flag2)
    {
        $this->db->flush_cache();

        $prep_data = array(
            $apikey, $studentid, $student_details['admission_no'], $student_details['passportnum'], $student_details['pasissue_place'], $student_details['pasissue_dat'], $student_details['pasexpi_dat'], $student_details['pasdesc'], $student_details['visanum'], $student_details['visissplace'], $student_details['visissudat'], $student_details['visexpdat'], $student_details['visdesc'], $flag1, $flag2
        );
        //                dev_export($prep_data);die;

        $data = $this->db->query("[docme_registration].[save_other_details]  ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?", $prep_data)->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    //Author Rahul
    //Date 06/OCT/2017
    //Purpose : Saving Student Parent Details -Registration
    public function save_parent_profile($family_details, $apikey, $studentid, $sibling_student_id, $emp_id, $emp_inst_id, $who_worked)
    {
        $update = 0;
        if ($sibling_student_id > 0) {
            $update = 2;
        } else {
            $update = 1;
        }
        $this->db->flush_cache();
        //return array($apikey, $studentid, $family_details, $update, $sibling_student_id);

        $data = $this->db->query("[docme_registration].[save_parent_details] ?,?,?,?,?,?,?,?", array($apikey, $studentid, $family_details, $update, $sibling_student_id, $emp_id, $emp_inst_id, $who_worked))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    public function edit_parent_profile($family_details, $apikey, $student_id, $sibling_student_id, $father_id, $mother_id, $guardian_id, $emp_id, $emp_inst_id, $who_worked)
    {
        $update = 0;
        if ($sibling_student_id > 0) {
            $update = 2;
        } else {
            $update = 1;
        }
        //return array($apikey, $student_id, $family_details, $update, $sibling_student_id, $father_id, $mother_id, $guardian_id);
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[edit_parent_details] ?,?,?,?,?,?,?,?,?,?,?", array($apikey, $student_id, $family_details, $update, $sibling_student_id, $father_id, $mother_id, $guardian_id, $emp_id, $emp_inst_id, $who_worked))->result_array();

        return isset($data[0]) ? $data['0'] : $data;
    }

    //END Rahul
    public function save_registration($xml_data, $apikey)
    {
        //         dev_export($xml_data);die;
        $this->db->flush_cache();

        $data = $this->db->query("[docme_registration].[save_docme_registration] ?,?", array($apikey, $xml_data))->result_array();
        //        dev_export($data);
        //        die;
        return $data;
    }
    public function get_uuid_student_data($apikey, $uuid)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_student_details_from_uuid] ?,?", array($apikey, $uuid))->result_array();
        return $data;
    }
    public function get_f_uuid_parent_data($apikey, $uuid)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_parent_details_from_uuid] ?,?", array($apikey, $uuid))->result_array();
        return $data;
    }


    public function save_temporary_reg($xml_data, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[save_temporary_registration] ?,?", array($apikey, $xml_data))->result_array();
        return isset($data[0]) ? $data['0'] : $data;
    }

    public function update_temporary_reg($student_id, $xml_data, $flag, $apikey)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[update_temporary_registration] ?,?,?,?", array($apikey, $student_id, $xml_data, $flag))->result_array();
        return isset($data[0]) ? $data['0'] : $data;
    }

    public function get_temp_students($apikey, $inst)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_all_temp_students] ?,?", array($apikey, $inst))->result_array();
        return $data;
    }
    public function get_m_uuid_parent_data($apikey, $uuid)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_parent_details_from_uuid] ?,?", array($apikey, $uuid))->result_array();
        return $data;
    }
    public function get_g_uuid_parent_data($apikey, $uuid)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_guardian_details_from_uuid] ?,?", array($apikey, $uuid))->result_array();
        return $data;
    }
    public function get_class_details_for_age_restrict($apikey, $inst_id, $age, $flag)
    {
        $this->db->flush_cache();
        if ($flag == 1) { //for normal student registration
            $data = $this->db->query("[docme_registration].[get_class_for_registration_with_age] ?,?,?", array($apikey, $inst_id, $age))->result_array();
        } else {
            $data = $this->db->query("[docme_registration].[get_class_for_reg_with_age] ?,?,?", array($apikey, $inst_id, $age))->result_array();
        }
        return $data;
    }

    public function get_temp_student_for_update($apikey, $student_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_temp_student_for_update] ?,?", array($apikey, $student_id))->result_array();
        return $data;
    }

    public function get_temp_reg_data($apikey, $admn)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_temp_reg_data] ?,?", array($apikey, $admn))->result_array();
        return isset($data[0]) ? $data['0'] : $data;
    }

    public function search_temp_reg_student($apikey, $inst_id, $searchdata, $flag)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_temp_students_bysearch] ?,?,?,?", array($apikey, $inst_id, $searchdata, $flag))->result_array();
        return $data;
    }

    public function get_otp_data($apikey, $email, $OTP, $flag)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_temp_otp_data] ?,?,?,?", array($apikey, $email, $OTP, $flag))->result_array();
        return $data;
    }

    public function get_select_reg_date_data($apikey, $inst_id, $flag = 1)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_select_reg_date_data] ?,?,?", array($apikey, $inst_id, $flag))->result_array();
        return $data;
    }

    public function get_all_api_keys($apikey, $inst_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_all_api_keys] ?,?", array($apikey, $inst_id))->result_array();
        return $data;
    }

    public function get_entrance_date($apikey, $inst_id, $class_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[dbo].[get_entrance_date] ?,?,?", array($apikey, $inst_id, $class_id))->result_array();
        return $data;
    }
    public function get_mandatory_subjects($apikey, $inst_id, $class_id)
    {
        $this->db->flush_cache();
        $data = $this->db->query("[dbo].[get_mandatory_optional_subjects] ?,?,?", array($apikey, $inst_id, $class_id))->result_array();
        return $data;
    }
    public function get_all_unsync_temp_admn()
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_registration].[get_all_unsync_temp_admn]")->result_array();
        return $studentdata;
    }
    public function save_rims_response_online_registration($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_registration].[save_rims_response_online_registration] $param_string", $dbparams)->result_array();
        return $studentdata;
    }
    public function get_staff_sibling_list($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_registration].[get_staff_sibling_list] ?,?,?", $dbparams)->result_array();
        return $studentdata;
    }
    public function get_parent_details_online_reg($dbparams)
    {
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_registration].[get_parent_details_online_reg] ?,?,?,?,?", $dbparams)->result_array();
        return $studentdata;
    }

    public function get_class_registration_fee($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_registration].[get_class_registration_fee] $param_string", $dbparams)->result_array();
        return $studentdata;
    }
    public function update_class_registration_fee($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        $studentdata = $this->db->query("[docme_registration].[update_class_registration_fee] $param_string", $dbparams)->result_array();
        return $studentdata;
    }

    public function get_all_temp_students_registration_fees($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_all_temp_students_registration_fee] $param_string", $dbparams)->result_array();
        return $data;
    }
    public function get_all_temp_students_registration_documents($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[get_all_temp_students_registration_documents] $param_string", $dbparams)->result_array();
        return $data;
    }

    public function update_registration_payment_allocation($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[update_registration_payment_allocation] $param_string", $dbparams)->result_array();
        return $data;
    }

    public function save_registration_date($dbparams)
    {
        $param_string = procedure_param_string($dbparams);
        $this->db->flush_cache();
        $data = $this->db->query("[docme_registration].[update_registration_dates] $param_string", $dbparams)->result_array();
        return $data;
    }
}
