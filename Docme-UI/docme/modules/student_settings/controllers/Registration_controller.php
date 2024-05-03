<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registration_controller
 *
 * @author chandrajith.edsys
 */
class Registration_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!(isLoggedin() == 1)) {
            if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
                header("HTTP/1.1 401 UNauthorized");
                die();
            } else {
                $path = base_url();
                redirect($path);
            }
        }
        $this->load->model('Registration_model', 'MRegistration');
        $this->load->model('Student_Model', 'MStudent');
        $this->load->model('fees/Student_account_model', 'MAccount');
        $this->load->model('fees/Fees_collection_model', 'MFee_collection');
    }

    public function edit_student_profile()
    {
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $studentid = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);



        $profile_details = $this->MRegistration->get_registration_details($studentid);

        if (isset($profile_details['data_status']) && !empty($profile_details['data_status'])) {

            //Data to be loaded

            $course_id = $profile_details['data']['Cur_Class'];
            $batch_id = $profile_details['data']['Cur_Batch'];
            $acd_year_id = $profile_details['data']['Cur_AcadYr'];

            $data['title'] = 'Registration';
            $data['sub_title'] = 'Student Registration';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('profile/show-class-for-students'),
                    'title' => 'Registration Management'
                ),
                '2' => array(
                    'function' => "load_students_after_filter_on_breadcrumb('" . $batch_id . "','" . $acd_year_id . "','" . $course_id . "')",
                    'title' => 'Batch'
                ),
                '3' => array(
                    'title' => 'Update Profile'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);

            $country_id = $profile_details['data']['Nationality'];

            //STATE DATA

            $state = $this->MRegistration->get_country_statedetails($country_id);
            if (isset($state['error_status']) && $state['error_status'] == 0) {
                if ($state['data_status'] == 1) {
                    $data['state_data'] = $state['data'];
                } else {
                    $data['state_data'] = NULL;
                }
            } else {
                $data['state_data'] = NULL;
            }

            //DISTRICT DATA
            $state_id = $profile_details['data']['state'];

            $city = $this->MRegistration->get_country_citydetails($state_id);
            if (isset($city['error_status']) && $city['error_status'] == 0) {
                if ($state['data_status'] == 1) {
                    $data['city_data'] = $city['data'];
                } else {
                    $city['city_data'] = NULL;
                }
            } else {
                $city['city_data'] = NULL;
            }

            //COUNTRY DATA
            $country = $this->MRegistration->get_all_country();
            if (isset($country['error_status']) && $country['error_status'] == 0) {
                if ($country['data_status'] == 1) {
                    $data['country_data'] = $country['data'];
                } else {
                    $data['country_data'] = FALSE;
                }
            } else {
                $data['country_data'] = FALSE;
            }
            $data['country_data'] = $country['data'];

            //RELIGION DATA
            $relegion = $this->MRegistration->get_all_relegion();
            if (isset($relegion['error_status']) && $relegion['error_status'] == 0) {
                if ($relegion['data_status'] == 1) {

                    $data['relegion'] = $relegion['data'];
                } else {
                    $data['relegion_data'] = FALSE;
                }
            } else {
                $data['relegion_data'] = FALSE;
            }
            $data['relegion_data'] = $relegion['data'];

            //CASTE DATA
            $religion_id = $profile_details['data']['Religion'];
            $caste = $this->MRegistration->get_religion_castedetails($religion_id);
            if (isset($caste['error_status']) && $caste['error_status'] == 0) {
                if ($caste['data_status'] == 1) {
                    $data['caste_data'] = $caste['data'];
                } else {
                    $data['caste_data'] = NULL;
                }
            } else {
                $data['caste_data'] = NULL;
            }

            //COMMUNITY DATA
            $community = $this->MRegistration->get_all_community();
            if (isset($community['error_status']) && $relegion['error_status'] == 0) {
                if ($community['data_status'] == 1) {

                    $community['community_data'] = $relegion['data'];
                } else {
                    $data['community_data'] = FALSE;
                }
            } else {
                $data['community_data'] = FALSE;
            }
            $data['community_data'] = $community['data'];

            //INSTITUTION LIST
            $institution_list = $this->MRegistration->get_institution_list();
            //dev_export($institution_list);
            if (isset($institution_list['error_status']) && $institution_list['error_status'] == 0) {
                if ($institution_list['data_status'] == 1) {
                    $data['institution_list_data'] = $institution_list['data'];
                } else {
                    $data['institution_list_data'] = FALSE;
                }
            } else {
                $data['institution_list_data'] = FALSE;
            }
            $data['institution_list_data'] = $institution_list['data'];

            //LANGUAGE DATA
            $language = $this->MRegistration->get_all_language_list();
            if (isset($language['error_status']) && $language['error_status'] == 0) {
                if ($language['data_status'] == 1) {
                    $data['language_data'] = $language['data'];
                } else {
                    $data['language_data'] = FALSE;
                }
            } else {
                $data['language_data'] = FALSE;
            }
            $data['language_data'] = $language['data'];

            //PROFESSION DATA
            $profession = $this->MRegistration->get_all_profession_list();
            if (isset($profession['error_status']) && $profession['error_status'] == 0) {
                if ($profession['data_status'] == 1) {
                    $data['profession_data'] = $profession['data'];
                } else {
                    $data['profession_data'] = FALSE;
                }
            } else {
                $data['profession_data'] = FALSE;
            }
            $data['profession_data'] = $profession['data'];
            //    dev_export($profession['data']); die;
            //PROFESSION DATA MOTHER
            $mprofession = $this->MRegistration->get_all_profession_list();
            if (isset($mprofession['error_status']) && $mprofession['error_status'] == 0) {
                if ($mprofession['data_status'] == 1) {
                    $data['mprofession_data'] = $mprofession['data'];
                } else {
                    $data['mprofession_data'] = FALSE;
                }
            } else {
                $data['mprofession_data'] = FALSE;
            }
            $data['mprofession_data'] = $mprofession['data'];
            //PROFESSION DATA GUARDIAN
            $gprofession = $this->MRegistration->get_all_profession_list();
            if (isset($gprofession['error_status']) && $gprofession['error_status'] == 0) {
                if ($gprofession['data_status'] == 1) {
                    $data['gprofession_data'] = $gprofession['data'];
                } else {
                    $data['gprofession_data'] = FALSE;
                }
            } else {
                $data['gprofession_data'] = FALSE;
            }
            $data['gprofession_data'] = $gprofession['data'];

            //ACD YEAR DATA
            $acdyr = $this->MRegistration->get_all_acadyr();
            if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
                if ($acdyr['data_status'] == 1) {
                    $data['acdyr_data'] = $acdyr['data'];
                } else {
                    $data['acdyr_data'] = FALSE;
                }
            } else {
                $data['acdyr_data'] = FALSE;
            }
            $data['acdyr_data'] = $acdyr['data'];

            //STREAM DATA
            $stream = $this->MRegistration->get_all_stream();
            if (isset($stream['error_status']) && $stream['error_status'] == 0) {
                if ($stream['data_status'] == 1) {
                    $data['stream_data'] = $stream['data'];
                } else {
                    $data['stream_data'] = FALSE;
                }
            } else {
                $data['stream_data'] = FALSE;
            }
            $data['stream_data'] = $stream['data'];

            //CLASS DATA
            $class = $this->MRegistration->get_all_class();
            // dev_export($class);
            // die;
            if (isset($class['error_status']) && $class['error_status'] == 0) {
                if ($class['data_status'] == 1) {
                    $data['class_data_for_registration'] = $class['data'];
                } else {
                    $data['class_data_for_registration'] = FALSE;
                }
            } else {
                $data['class_data_for_registration'] = FALSE;
            }
            //$data['class_data'] = $class['data'];


            $data['user_name'] = $this->session->userdata('user_name');


            $klanguage = $profile_details['data']['language_known'];

            $formatted_language = array();

            foreach ($klanguage as $value) {
                $formatted_language[] = $value['language_id'];
            }

            $data['formatted_language'] = $formatted_language;
            $inst_id = $this->session->userdata('inst_id');
            if ($inst_id == 1 || $inst_id == 2 || $inst_id == 3 || $inst_id == 4 || $inst_id == 9) {
                $data['uuid_unit_limit'] = 15;
            } else {
                $data['uuid_unit_limit'] = 12;
            }

            $data['profile_details'] = $profile_details['data'];
            echo json_encode(array('status' => 1, 'view' => $this->load->view('registration/show_registration', $data, TRUE)));
            // echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/profile_edit', $data, TRUE)));
            return true;
        } else {

            echo json_encode(array('Data Loading Error.'));
            return true;
        }
    }

    public function adhar_validation()
    {

        $unique_identity = filter_input(INPUT_POST, 'unique_identity', FILTER_SANITIZE_STRING);
        $s_unique_identity = filter_input(INPUT_POST, 's_unique_identity', FILTER_SANITIZE_STRING);
        $f_unique_identity = filter_input(INPUT_POST, 'f_unique_identity', FILTER_SANITIZE_STRING);
        $m_unique_identity = filter_input(INPUT_POST, 'm_unique_identity', FILTER_SANITIZE_STRING);
        $g_unique_identity = filter_input(INPUT_POST, 'g_unique_identity', FILTER_SANITIZE_STRING);
        $studentid = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
        $sibling_student_id = filter_input(INPUT_POST, 'sibling_student_id', FILTER_SANITIZE_NUMBER_INT);
        $uuid_name = filter_input(INPUT_POST, 'unique_limit_name', FILTER_SANITIZE_STRING);

        if ($uuid_name == '') {
            $uuid_name = 'Unique identity';
        }

        if ($sibling_student_id != 0 && $sibling_student_id != '') {
            $studentid = $sibling_student_id; //validating the adhar details for parents wheb adding siblings;
        }
        $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);
        $uuid_array = [];
        if ($s_unique_identity != '')
            $uuid_array[] = $s_unique_identity;
        if ($f_unique_identity != '')
            $uuid_array[] = $f_unique_identity;
        if ($m_unique_identity != '')
            $uuid_array[] = $m_unique_identity;
        if ($g_unique_identity != '')
            $uuid_array[] = $g_unique_identity;


        $uuid_array_size = sizeof($uuid_array);
        if ($uuid_array_size == sizeof(array_unique($uuid_array))) {
            if (!isset($flag) && empty($flag)) {
                $flag = 1;
                if ($studentid == 0) {
                    $flag = 0;
                }
            } else {
                if ($studentid == 0) {
                    $flag = 0;
                }
            }
            $status = $this->MRegistration->get_unique_identity($unique_identity, $studentid, $flag);
            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                echo json_encode('true');
                //return true;
                //echo 'true';
            } else {
                echo json_encode(array($uuid_name . ' already exists.'));
                //return false;
                ///echo 'false';
            }
        } else {
            $inst_id = $this->session->userdata('inst_id');
            echo json_encode(array($uuid_name . ' should be unique.'));
            //echo 'false';
        }
    }

    public function email_validation()
    {
        //echo json_encode('true');
        //            return true;
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $sibling_id = filter_input(INPUT_POST, 'sibling_student_id', FILTER_SANITIZE_NUMBER_INT);
        $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
        if (!(isset($sibling_id) && !empty($sibling_id)) || $sibling_id == 0) {
            $sibling_id = -1;
        }
        if (!(isset($student_id) && !empty($student_id)) || $student_id == 0) {
            $student_id = 0;
        }
        $relation = strtoupper(filter_input(INPUT_POST, 'relation', FILTER_SANITIZE_STRING));

        $status = $this->MRegistration->get_email_validate($email, $sibling_id, $relation, $student_id);
        if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
            //echo json_encode('true');
            echo 'true';
        } else {

            //echo json_encode(array('Email ID already exist.'));
            echo 'false';
        }
    }

    public function mob_validation()
    {

        $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_NUMBER_INT);
        $sibling_id = filter_input(INPUT_POST, 'sibling_student_id', FILTER_SANITIZE_NUMBER_INT);
        $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
        if (!(isset($sibling_id) && !empty($sibling_id)) || $sibling_id == 0) {
            $sibling_id = -1;
        }
        if (!(isset($student_id) && !empty($student_id)) || $student_id == 0) {
            $student_id = 0;
        }
        $relation = strtoupper(filter_input(INPUT_POST, 'relation', FILTER_SANITIZE_STRING));

        $status = $this->MRegistration->get_mob_validate($mobile, $sibling_id, $relation, $student_id);
        if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function save_facilities_details()
    {
        if ($this->input->is_ajax_request() == 1) {

            $update_other = filter_input(INPUT_POST, 'update_other', FILTER_SANITIZE_NUMBER_INT);
            $studentid = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            $student_data_raw = filter_input(INPUT_POST, 'studentdata');


            if ($student_data_raw) {
                if ($update_other == 1) {
                    $status = $this->MRegistration->edit_facilities_details($studentid, $student_data_raw);
                } else {

                    $status = $this->MRegistration->save_facilities_details($student_data_raw);
                    //            dev_export($status);die;
                    if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'message' => 'Data saved successfully', 'admn_no' => $status['admn_no']));
                        return true;
                    } else {
                        if (isset($status['message']) && !empty($status['message'])) {
                            echo json_encode(array('status' => 2, 'message' => $status['message']));
                            return false;
                        } else {
                            echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                            return false;
                        }
                    }
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    public function save_other_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            $update_other = filter_input(INPUT_POST, 'update_other', FILTER_SANITIZE_NUMBER_INT);
            $student_data_raw = filter_input(INPUT_POST, 'studentdata');
            $flag1 = filter_input(INPUT_POST, 'flag1', FILTER_SANITIZE_NUMBER_INT);
            $flag2 = filter_input(INPUT_POST, 'flag2', FILTER_SANITIZE_NUMBER_INT);
            //    dev_export($student_data_raw);die;
            if ($student_data_raw) {
                if ($update_other == 1) {
                    $status = $this->MRegistration->edit_other_details($student_id, $student_data_raw);
                } else {
                    $status = $this->MRegistration->save_other_details($student_data_raw, $student_id, $flag1, $flag2);
                    //            dev_export($status);die;
                    if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {

                        echo json_encode(array('status' => 1, 'message' => 'Data saved successfully'));
                        return true;
                    } else {
                        if (isset($status['message']) && !empty($status['message'])) {
                            echo json_encode(array('status' => 2, 'message' => $status['message']));
                            return false;
                        } else {
                            echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                            return false;
                        }
                    }
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    //Author Rahul save student_parent_profile
    public function save_parent_profile_reg()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            $who_worked = filter_input(INPUT_POST, 'who_worked', FILTER_SANITIZE_STRING);
            $emp_id = filter_input(INPUT_POST, 'emp_id', FILTER_SANITIZE_NUMBER_INT);
            $emp_inst_id = filter_input(INPUT_POST, 'emp_inst_id', FILTER_SANITIZE_NUMBER_INT);
            $sibling_student_id_raw = filter_input(INPUT_POST, 'sibling_student_id', FILTER_SANITIZE_NUMBER_INT);
            $sibling_student_id = isset($sibling_student_id_raw) && !empty($sibling_student_id_raw) ? $sibling_student_id_raw : -1;
            //    $update_profile = filter_input(INPUT_POST, 'update_profile', FILTER_SANITIZE_NUMBER_INT);
            $student_data_raw = filter_input(INPUT_POST, 'studentdata');
            //    dev_export($student_data_raw);die;
            if ($student_data_raw) {
                //        if ($update_profile == 1) {
                //            $status = $this->MRegistration->edit_parent_profile($student_id, $student_data_raw, $sibling_student_id);
                //        } else {
                $status = $this->MRegistration->save_parent_profile($student_data_raw, $student_id, $sibling_student_id, $emp_id, $emp_inst_id, $who_worked);
                //        dev_export($status);die;

                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data saved successfully', 'father_id' => $status['father_id'], 'mother_id' => $status['mother_id'], 'guardian_id' => $status['guardian_id']));
                    return true;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $status['message']));
                        return false;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                        return false;
                    }
                }
                //        }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    public function edit_parent_profile_reg()
    {
        if ($this->input->is_ajax_request() == 1) {

            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            $who_worked = filter_input(INPUT_POST, 'who_worked', FILTER_SANITIZE_STRING);
            $emp_id = filter_input(INPUT_POST, 'emp_id', FILTER_SANITIZE_NUMBER_INT);
            $emp_inst_id = filter_input(INPUT_POST, 'emp_inst_id', FILTER_SANITIZE_NUMBER_INT);

            $sibling_student_id = filter_input(INPUT_POST, 'sibling_student_id', FILTER_SANITIZE_NUMBER_INT);
            $father_id = filter_input(INPUT_POST, 'father_id', FILTER_SANITIZE_NUMBER_INT);
            $mother_id = filter_input(INPUT_POST, 'mother_id', FILTER_SANITIZE_NUMBER_INT);
            $guardian_id = filter_input(INPUT_POST, 'guardian_id', FILTER_SANITIZE_NUMBER_INT);
            $sibling_student_id = isset($sibling_student_id) && !empty($sibling_student_id) ? $sibling_student_id : -1;
            //    $update_profile = filter_input(INPUT_POST, 'update_profile', FILTER_SANITIZE_NUMBER_INT);
            $student_data_raw = filter_input(INPUT_POST, 'studentdata');
            //    dev_export($student_id);
            //    dev_export($sibling_student_id);
            //    dev_export($father_id);
            //    dev_export($mother_id);
            //    dev_export($guardian_id);
            //    dev_export($sibling_student_id);
            //    dev_export($student_data_raw);die;
            if ($student_data_raw) {
                //        if ($update_profile == 1) {
                //            $status = $this->MRegistration->edit_parent_profile($student_id, $student_data_raw, $sibling_student_id);
                //        } else {
                $status = $this->MRegistration->edit_parent_profile($student_data_raw, $student_id, $sibling_student_id, $father_id, $mother_id, $guardian_id, $emp_id, $emp_inst_id, $who_worked);

                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return true;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $status['message']));
                        return false;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                        return false;
                    }
                }
                //        }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    //end save_student_parent_profile
    //This function written by Elavarasan S @ 21-05-2019 2:20
    public function save_temp_registration()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            $update_profile = filter_input(INPUT_POST, 'update_profile', FILTER_SANITIZE_NUMBER_INT);
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);
            $student_data_raw = filter_input(INPUT_POST, 'studentdata');
            if ($student_data_raw) {
                if ($update_profile == 1) {
                    $status = $this->MRegistration->edit_temp_registration($student_id, $student_data_raw, $flag);
                    //            dev_export($status);die;
                    if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1 && isset($status['studentid']) && !empty($status['studentid'])) {
                        $studentid = $status['studentid'];
                        echo json_encode(array('status' => 1, 'message' => 'Temporary Registration Updated Successfully', 'studentid' => $studentid));
                        return true;
                    } else {
                        if (isset($status['message']) && !empty($status['message'])) {
                            echo json_encode(array('status' => 2, 'message' => $status['message']));
                            return false;
                        } else {
                            echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                            return false;
                        }
                    }
                } else {
                    $status = $this->MRegistration->save_temp_registration($student_data_raw);
                    //            dev_export($status);die;
                    if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1 && isset($status['studentid']) && !empty($status['studentid'])) {
                        $studentid = $status['studentid'];
                        echo json_encode(array('status' => 1, 'message' => 'Temporary Registration created successfully', 'studentid' => $studentid));
                        return true;
                    } else {
                        if (isset($status['message']) && !empty($status['message'])) {
                            echo json_encode(array('status' => 2, 'message' => $status['message']));
                            return false;
                        } else {
                            echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                            return false;
                        }
                    }
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    public function save_student_personal_profile()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            $update_profile = filter_input(INPUT_POST, 'update_profile', FILTER_SANITIZE_NUMBER_INT);
            $student_data_raw = filter_input(INPUT_POST, 'studentdata');
            $known_languages = filter_input(INPUT_POST, 'language_data');
            $student_image = filter_input(INPUT_POST, 'student_image');
            $temp_student_id = filter_input(INPUT_POST, 'temp_stud_id');
            if ($student_data_raw) {
                if ($update_profile == 1) {
                    $status = $this->MRegistration->edit_personal_profile($student_id, $student_data_raw, $student_image, $known_languages);
                    if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1 && isset($status['studentid']) && !empty($status['studentid'])) {
                        $studentid = $status['studentid'];
                        if (isset($student_image) && !empty($student_image)) {
                            $inst_id = $this->session->userdata('inst_id');
                            $user_name = $this->session->userdata('user_name');
                            save_student_image($student_image, $studentid, $inst_id, $user_name);
                        }
                        echo json_encode(array('status' => 1, 'message' => 'Data saved successfully', 'studentid' => $studentid));
                        return true;
                    } else {
                        if (isset($status['message']) && !empty($status['message'])) {
                            echo json_encode(array('status' => 2, 'message' => $status['message']));
                            return false;
                        } else {
                            echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                            return false;
                        }
                    }
                } else {
                    // dev_export($student_data_raw);
                    // return;
                    $status = $this->MRegistration->save_personal_profile($student_data_raw, $student_image, $known_languages, $temp_student_id);
                    if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1 && isset($status['studentid']) && !empty($status['studentid'])) {
                        $studentid = $status['studentid'];
                        if (isset($student_image) && !empty($student_image)) {
                            $inst_id = $this->session->userdata('inst_id');
                            $user_name = $this->session->userdata('user_name');
                            save_student_image($student_image, $studentid, $inst_id, $user_name);
                        }
                        echo json_encode(array('status' => 1, 'message' => 'Data saved successfully', 'studentid' => $studentid));
                        return true;
                    } else {
                        if (isset($status['message']) && !empty($status['message'])) {
                            echo json_encode(array('status' => 2, 'message' => $status['message']));
                            return false;
                        } else {
                            echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                            return false;
                        }
                    }
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    public function save_student_academic_profile()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            $update_profile = filter_input(INPUT_POST, 'update_profile', FILTER_SANITIZE_NUMBER_INT);
            $student_data_raw = filter_input(INPUT_POST, 'studentdata');
            $temp_student_id = filter_input(INPUT_POST, 'temp_stud_id');

            if ($student_data_raw) {
                if ($update_profile == 1) {
                    $status = $this->MRegistration->edit_academic_profile($student_data_raw, $student_id);
                    if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1 && isset($status['admission_no']) && !empty($status['admission_no'])) {
                        $admnno = $status['admission_no'];
                        echo json_encode(array('status' => 1, 'message' => 'Data Updated successfully', 'admission_no' => $admnno));
                        return true;
                    } else {
                        if (isset($status['message']) && !empty($status['message'])) {
                            echo json_encode(array('status' => 2, 'message' => $status['message']));
                            return false;
                        } else {
                            echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                            return false;
                        }
                    }
                } else {

                    $status = $this->MRegistration->save_academic_profile($student_data_raw, $student_id, $temp_student_id);

                    if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1 && isset($status['admission_no']) && !empty($status['admission_no'])) {
                        $admnno = $status['admission_no'];
                        echo json_encode(array('status' => 1, 'message' => 'Data saved successfully', 'admission_no' => $admnno));
                        return true;
                    } else {
                        if (isset($status['message']) && !empty($status['message'])) {
                            echo json_encode(array('status' => 2, 'message' => $status['message']));
                            return false;
                        } else {
                            echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                            return false;
                        }
                    }
                }
            } else {
                echo json_encode(array('status' => -1, 'message' => 'Data error. Please contact administrator'));
                return true;
            }
        }
    }

    public function get_class_details_with_age_restriction()
    {
        if ($this->input->is_ajax_request() == 1) {
            $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_STRING);
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);
            $inst_id = $this->session->userdata('inst_id');
            if ($age > 0) {
                $class_details = $this->MRegistration->get_class_details_with_age($age, $inst_id, $flag);
                if (isset($class_details['data']) && !empty($class_details['data'])) {
                    echo json_encode(array('status' => 1, 'data' => $class_details['data']));
                    return true;
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'No class details available'));
                    return;
                }
            } else {
                echo json_encode(array('status' => 2, 'messagee' => 'Age is required to load class details'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
            return false;
        }
    }

    public function show_registration($stud_data = NULL)
    {
        if (check_permission(501, 1092, 102)) {
            $data['template'] = 'registration/show_registration';
            $data['title'] = 'REGISTRATION';
            $data['sub_title'] = 'Student Registration';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'title' => 'Registration Management',
                    'link' => base_url('school/home')
                ),
                '2' => array(
                    'title' => 'Registration'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);

            //COUNTRY DATA
            $country = $this->MRegistration->get_all_country();
            if (isset($country['error_status']) && $country['error_status'] == 0) {
                if ($country['data_status'] == 1) {
                    $data['country_data'] = $country['data'];
                } else {
                    $data['country_data'] = FALSE;
                }
            } else {
                $data['country_data'] = FALSE;
            }
            $data['country_data'] = $country['data'];

            //RELIGION DATA
            $relegion = $this->MRegistration->get_all_relegion();
            if (isset($relegion['error_status']) && $relegion['error_status'] == 0) {
                if ($relegion['data_status'] == 1) {

                    $data['relegion'] = $relegion['data'];
                } else {
                    $data['relegion_data'] = FALSE;
                }
            } else {
                $data['relegion_data'] = FALSE;
            }
            $data['relegion_data'] = $relegion['data'];
            //COMMUNITY DATA
            $community = $this->MRegistration->get_all_community();
            if (isset($community['error_status']) && $relegion['error_status'] == 0) {
                if ($community['data_status'] == 1) {

                    $community['community_data'] = $relegion['data'];
                } else {
                    $data['community_data'] = FALSE;
                }
            } else {
                $data['community_data'] = FALSE;
            }
            $data['community_data'] = $community['data'];

            //INSTITUTION LIST
            // $institution_list = $this->MRegistration->get_institution_list();
            // if (isset($institution_list['data']) && !empty($institution_list['data'])) {
            //     $data['institution_list_data'] = $institution_list['data'];
            // } else {
            //     $data['institution_list_data'] = 0;
            // }

            $institution_list = $this->MRegistration->get_institution_list();
            //dev_export($institution_list);
            if (isset($institution_list['error_status']) && $institution_list['error_status'] == 0) {
                if ($institution_list['data_status'] == 1) {
                    $data['institution_list_data'] = $institution_list['data'];
                } else {
                    $data['institution_list_data'] = FALSE;
                }
            } else {
                $data['institution_list_data'] = FALSE;
            }
            $data['institution_list_data'] = $institution_list['data'];

            //LANGUAGE DATA
            $language = $this->MRegistration->get_all_language_list();
            if (isset($language['error_status']) && $language['error_status'] == 0) {
                if ($language['data_status'] == 1) {
                    $data['language_data'] = $language['data'];
                } else {
                    $data['language_data'] = FALSE;
                }
            } else {
                $data['language_data'] = FALSE;
            }
            $data['language_data'] = $language['data'];

            //PROFESSION DATA
            $profession = $this->MRegistration->get_all_profession_list();
            if (isset($profession['error_status']) && $profession['error_status'] == 0) {
                if ($profession['data_status'] == 1) {
                    $data['profession_data'] = $profession['data'];
                } else {
                    $data['profession_data'] = FALSE;
                }
            } else {
                $data['profession_data'] = FALSE;
            }
            $data['profession_data'] = $profession['data'];

            //PROFESSION DATA MOTHER
            $mprofession = $this->MRegistration->get_all_profession_list();
            if (isset($mprofession['error_status']) && $mprofession['error_status'] == 0) {
                if ($mprofession['data_status'] == 1) {
                    $data['mprofession_data'] = $mprofession['data'];
                } else {
                    $data['mprofession_data'] = FALSE;
                }
            } else {
                $data['mprofession_data'] = FALSE;
            }
            $data['mprofession_data'] = $mprofession['data'];
            //PROFESSION DATA GUARDIAN
            $gprofession = $this->MRegistration->get_all_profession_list();
            if (isset($gprofession['error_status']) && $gprofession['error_status'] == 0) {
                if ($gprofession['data_status'] == 1) {
                    $data['gprofession_data'] = $gprofession['data'];
                } else {
                    $data['gprofession_data'] = FALSE;
                }
            } else {
                $data['gprofession_data'] = FALSE;
            }
            $data['gprofession_data'] = $gprofession['data'];

            //ACD YEAR DATA
            $acdyr = $this->MRegistration->get_all_acadyr();
            if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
                if ($acdyr['data_status'] == 1) {
                    $data['acdyr_data'] = $acdyr['data'];
                } else {
                    $data['acdyr_data'] = FALSE;
                }
            } else {
                $data['acdyr_data'] = FALSE;
            }
            $data['acdyr_data'] = $acdyr['data'];

            //STREAM DATA
            $stream = $this->MRegistration->get_all_stream();
            if (isset($stream['error_status']) && $stream['error_status'] == 0) {
                if ($stream['data_status'] == 1) {
                    $data['stream_data'] = $stream['data'];
                } else {
                    $data['stream_data'] = FALSE;
                }
            } else {
                $data['stream_data'] = FALSE;
            }
            $data['stream_data'] = $stream['data'];

            //CLASS DATA
            $class = $this->MRegistration->get_all_class();
            //dev_export($class);die;
            if (isset($class['error_status']) && $class['error_status'] == 0) {
                if ($class['data_status'] == 1) {
                    $data['class_data_for_registration'] = $class['data'];
                } else {
                    $data['class_data_for_registration'] = FALSE;
                }
            } else {
                $data['class_data_for_registration'] = FALSE;
            }
            //$data['class_data'] = $class['data'];


            $inst_id = $this->session->userdata('inst_id');
            if ($inst_id == 4) {
                $data['uuid_unit_limit'] = 15;
            } else {
                $data['uuid_unit_limit'] = 12;
            }
            $data['user_name'] = $this->session->userdata('user_name');

            if (isset($stud_data) && !empty($stud_data)) {
                $data['temp_stud_data'] = $stud_data;
            } else {
                $data['temp_stud_data'] = FALSE;
            }

            $this->load->view('template/home_template', $data);
        }
    }
    //this function written by Elavarasan S @ 21-05-2019 12:20
    public function show_temp_registration()
    {
        $data['template'] = 'registration/show_temp_registration';
        $data['title'] = 'TEMPORARY REGISTRATION';
        $data['sub_title'] = 'Student Temporary Registration';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Admission Management'
            ),
            '2' => array(
                'title' => 'Temporary Registration'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        //      Student data
        $sprofile = $this->MRegistration->get_all_temp_students();
        if (isset($sprofile['error_status']) && $sprofile['error_status'] == 0) {
            if ($sprofile['data_status'] == 1) {
                $data['student_data'] = $sprofile['data'];
            } else {
                $data['student_data'] = FALSE;
            }
        } else {
            $data['student_data'] = FALSE;
        }
        $data['student_data'] = $sprofile['data'];

        $this->load->view('template/home_template', $data);
    }

    public function filter_temp_reg_student()
    {
        if ($this->input->is_ajax_request() == 1) {
            $search_str = filter_input(INPUT_POST, 'searchdata', FILTER_SANITIZE_STRING);
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);

            if (isset($search_str) && !empty($search_str)) {
                $student_data = $this->MRegistration->search_temp_reg_student($search_str, $flag);
                if (isset($student_data['error_status']) && $student_data['error_status'] == 0) {
                    if ($student_data['data_status'] == 1) {
                        $data['student_data'] = $student_data['data'];
                        echo json_encode(array('status' => 1, 'view' => $this->load->view('registration/temp_student_search_result', $data, true)));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0));
                        return true;
                    }
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    public function get_temp_reg_student()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);

            if (isset($student_id) && !empty($student_id)) {
                $student_data = $this->MRegistration->get_tempreg_student($student_id);
                if (isset($student_data['error_status']) && $student_data['error_status'] == 0) {
                    if ($student_data['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'data' => $student_data['data']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0));
                        return true;
                    }
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    public function temp_to_permanent()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);

            if (isset($student_id) && !empty($student_id)) {
                $student_data = $this->MRegistration->get_tempreg_student($student_id);
                if (isset($student_data['error_status']) && $student_data['error_status'] == 0) {
                    if ($student_data['data_status'] == 1) {
                        $data['title'] = 'Registration';
                        $data['sub_title'] = 'Student Temporary Registration';
                        $breadcrump = array(
                            '0' => array(
                                'link' => base_url('dashboard'),
                                'title' => 'Home'
                            ),
                            '1' => array(
                                'title' => 'Registration Management'
                            ),
                            '2' => array(
                                'title' => 'Registration'
                            )
                        );
                        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
                        //COUNTRY DATA
                        $country = $this->MRegistration->get_all_country();
                        if (isset($country['error_status']) && $country['error_status'] == 0) {
                            if ($country['data_status'] == 1) {
                                $data['country_data'] = $country['data'];
                            } else {
                                $data['country_data'] = FALSE;
                            }
                        } else {
                            $data['country_data'] = FALSE;
                        }
                        $data['country_data'] = $country['data'];

                        //RELIGION DATA
                        $relegion = $this->MRegistration->get_all_relegion();
                        if (isset($relegion['error_status']) && $relegion['error_status'] == 0) {
                            if ($relegion['data_status'] == 1) {

                                $data['relegion'] = $relegion['data'];
                            } else {
                                $data['relegion_data'] = FALSE;
                            }
                        } else {
                            $data['relegion_data'] = FALSE;
                        }
                        $data['relegion_data'] = $relegion['data'];
                        //COMMUNITY DATA
                        $community = $this->MRegistration->get_all_community();
                        if (isset($community['error_status']) && $relegion['error_status'] == 0) {
                            if ($community['data_status'] == 1) {

                                $community['community_data'] = $relegion['data'];
                            } else {
                                $data['community_data'] = FALSE;
                            }
                        } else {
                            $data['community_data'] = FALSE;
                        }
                        $data['community_data'] = $community['data'];

                        //LANGUAGE DATA
                        $language = $this->MRegistration->get_all_language_list();
                        if (isset($language['error_status']) && $language['error_status'] == 0) {
                            if ($language['data_status'] == 1) {
                                $data['language_data'] = $language['data'];
                            } else {
                                $data['language_data'] = FALSE;
                            }
                        } else {
                            $data['language_data'] = FALSE;
                        }
                        $data['language_data'] = $language['data'];

                        //PROFESSION DATA
                        $profession = $this->MRegistration->get_all_profession_list();
                        if (isset($profession['error_status']) && $profession['error_status'] == 0) {
                            if ($profession['data_status'] == 1) {
                                $data['profession_data'] = $profession['data'];
                            } else {
                                $data['profession_data'] = FALSE;
                            }
                        } else {
                            $data['profession_data'] = FALSE;
                        }
                        $data['profession_data'] = $profession['data'];

                        //PROFESSION DATA MOTHER
                        $mprofession = $this->MRegistration->get_all_profession_list();
                        if (isset($mprofession['error_status']) && $mprofession['error_status'] == 0) {
                            if ($mprofession['data_status'] == 1) {
                                $data['mprofession_data'] = $mprofession['data'];
                            } else {
                                $data['mprofession_data'] = FALSE;
                            }
                        } else {
                            $data['mprofession_data'] = FALSE;
                        }
                        $data['mprofession_data'] = $mprofession['data'];
                        //PROFESSION DATA GUARDIAN
                        $gprofession = $this->MRegistration->get_all_profession_list();
                        if (isset($gprofession['error_status']) && $gprofession['error_status'] == 0) {
                            if ($gprofession['data_status'] == 1) {
                                $data['gprofession_data'] = $gprofession['data'];
                            } else {
                                $data['gprofession_data'] = FALSE;
                            }
                        } else {
                            $data['gprofession_data'] = FALSE;
                        }
                        $data['gprofession_data'] = $gprofession['data'];

                        //ACD YEAR DATA
                        $acdyr = $this->MRegistration->get_all_acadyr();
                        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
                            if ($acdyr['data_status'] == 1) {
                                $data['acdyr_data'] = $acdyr['data'];
                            } else {
                                $data['acdyr_data'] = FALSE;
                            }
                        } else {
                            $data['acdyr_data'] = FALSE;
                        }
                        $data['acdyr_data'] = $acdyr['data'];

                        //STREAM DATA
                        $stream = $this->MRegistration->get_all_stream();
                        if (isset($stream['error_status']) && $stream['error_status'] == 0) {
                            if ($stream['data_status'] == 1) {
                                $data['stream_data'] = $stream['data'];
                            } else {
                                $data['stream_data'] = FALSE;
                            }
                        } else {
                            $data['stream_data'] = FALSE;
                        }
                        $data['stream_data'] = $stream['data'];

                        //CLASS DATA
                        $class = $this->MRegistration->get_all_class();
                        //dev_export($class);die;
                        if (isset($class['error_status']) && $class['error_status'] == 0) {
                            if ($class['data_status'] == 1) {
                                $data['class_data_for_registration'] = $class['data'];
                            } else {
                                $data['class_data_for_registration'] = FALSE;
                            }
                        } else {
                            $data['class_data_for_registration'] = FALSE;
                        }
                        //$data['class_data'] = $class['data'];


                        $inst_id = $this->session->userdata('inst_id');
                        if ($inst_id == 4) {
                            $data['uuid_unit_limit'] = 15;
                        } else {
                            $data['uuid_unit_limit'] = 12;
                        }
                        $data['user_name'] = $this->session->userdata('user_name');
                        if (isset($student_data['data']) && !empty($student_data['data'])) {
                            $newsiblingArr = array();
                            foreach ($student_data['data'] as $row) {
                                if ($row['admn_type'] == 'Sibling') {
                                    $sibling_admn_no = $row['type_data'];
                                    $data_prep['admn_no_for_parent_search'] = strtoupper($sibling_admn_no);
                                    $data_prep['flag'] = 1;
                                    $sibling_data = $this->MStudent->parent_search_new($data_prep);
                                    $sib_student_id = $sibling_data['data'][0]['Student_id'];
                                    $parent_address = $this->MRegistration->get_parentaddress_details($sib_student_id);
                                    $p_data = $parent_address['data'][0];
                                    if ($p_data['F_O_address1'] <> '') {
                                        $offAddr1 = $p_data['F_O_address1'];
                                    } else {
                                        $offAddr1 = $row['Of_Address1'];
                                    }
                                    if ($p_data['F_O_address2'] <> '') {
                                        $offAddr2 = $p_data['F_O_address2'];
                                    } else {
                                        $offAddr2 = $row['Of_Address2'];
                                    }
                                    if ($p_data['F_O_address3'] <> '') {
                                        $offAddr3 = $p_data['F_O_address3'];
                                    } else {
                                        $offAddr3 = $row['Of_Address3'];
                                    }
                                    if ($p_data['F_O_ZIP_CODE'] <> '') {
                                        $offzip = $p_data['F_O_ZIP_CODE'];
                                    } else {
                                        $offzip = $row['Of_zip'];
                                    }
                                    if ($p_data['F_O_Phone1'] <> '') {
                                        $offphone = $p_data['F_O_Phone1'];
                                    } else {
                                        $offphone = $row['Of_phone'];
                                    }
                                    if ($p_data['OEmail'] <> '') {
                                        $offemail = $p_data['OEmail'];
                                    } else {
                                        $offemail = $row['Of_mail'];
                                    }
                                    if ($p_data['F_O_Phone3'] <> '') {
                                        $offmob = $p_data['F_O_Phone3'];
                                    } else {
                                        $offmob = $row['Of_mobile'];
                                    }

                                    $newsiblingArr[] = array(
                                        'fname' => $row['fname'],
                                        'mname' => $row['mname'],
                                        'lname' => $row['lname'],
                                        'gender' => $row['gender'],
                                        'country' => $row['country'],
                                        'Nationality' => $row['Nationality'],
                                        'state' => $row['state'],
                                        'district' => $row['district'],
                                        'dob' => $row['dob'],
                                        'religion' => $row['religion'],
                                        'caste' => $row['caste'],
                                        'community' => $row['community'],
                                        'motherTongue' => $row['motherTongue'],
                                        'knownLang' => $row['knownLang'],
                                        'emirate_Id' => $row['emirate_Id'],
                                        'TempReg_ID' => $row['TempReg_ID'],
                                        'applicationDate' => $row['applicationDate'],
                                        'Acd_Yr' => $row['Acd_Yr'],
                                        'stream' => $row['stream'],
                                        'class' => $row['class'],
                                        'birthCountry' => $row['birthCountry'],
                                        'birthPlace' => $row['birthPlace'],
                                        'emirate_Id' => $row['emirate_Id'],
                                        'TempReg_ID' => $row['TempReg_ID'],
                                        'applicationDate' => $row['applicationDate'],
                                        'Acd_Yr' => $row['Acd_Yr'],
                                        'stream' => $row['stream'],
                                        'class' => $row['class'],
                                        'birthCountry' => $row['birthCountry'],

                                        'Father' => $p_data['Father'],
                                        'Father_Id' => $p_data['father_id'],
                                        'f_adhar' => $p_data['f_adhar'],
                                        'F_C_address1' => $p_data['F_C_address1'],
                                        'F_C_address2' => $p_data['F_C_address2'],
                                        'F_C_address3' => $p_data['F_C_address3'],
                                        'F_C_ZIP_CODE' => $p_data['F_C_ZIP_CODE'],
                                        'F_C_Phone1' => $p_data['F_C_Phone1'],
                                        'Email' => $p_data['Email'],
                                        'F_C_Phone3' => $p_data['F_C_Phone3'],
                                        'F_O_address1' => $offAddr1,
                                        'F_O_address2' => $offAddr2,
                                        'F_O_address3' => $offAddr3,
                                        'F_O_ZIP_CODE' => $offzip,
                                        'F_O_Phone1' => $offphone,
                                        'OEmail' => $offemail,
                                        'F_O_Phone3' => $offmob,
                                        'F_H_address1' => $p_data['F_H_address1'],
                                        'F_H_address2' => $p_data['F_H_address2'],
                                        'F_H_address3' => $p_data['F_H_address3'],
                                        'F_H_ZIP_CODE' => $p_data['F_H_ZIP_CODE'],
                                        'F_H_Phone1' => $p_data['F_H_Phone1'],
                                        'HEmail' => $p_data['HEmail'],
                                        'F_H_Phone3' => $p_data['F_H_Phone3'],
                                        'F_profession' => $p_data['F_profession'],
                                        'F_profession_id' => $p_data['F_profession_id'],
                                        'Mother_Id' => $p_data['mother_id'],
                                        'Mother' => $p_data['Mother'],
                                        'm_adhar' => $p_data['m_adhar'],
                                        'M_C_address1' => $p_data['M_C_address1'],
                                        'M_C_address2' => $p_data['M_C_address2'],
                                        'M_C_address3' => $p_data['M_C_address3'],
                                        'M_C_ZIP_CODE' => $p_data['M_C_ZIP_CODE'],
                                        'M_C_Phone1' => $p_data['M_C_Phone1'],
                                        'M_C_Email' => $p_data['M_C_Email'],
                                        'M_C_Phone3' => $p_data['M_C_Phone3'],
                                        'M_O_address1' => $p_data['M_O_address1'],
                                        'M_O_address2' => $p_data['M_O_address2'],
                                        'M_O_address3' => $p_data['M_O_address3'],
                                        'M_O_ZIP_CODE' => $p_data['M_O_ZIP_CODE'],
                                        'M_O_Phone1' => $p_data['M_O_Phone1'],
                                        'M_O_Email' => $p_data['M_O_Email'],
                                        'M_O_Phone3' => $p_data['M_O_Phone3'],
                                        'M_H_address1' => $p_data['M_H_address1'],
                                        'M_H_address2' => $p_data['M_H_address2'],
                                        'M_H_address3' => $p_data['M_H_address3'],
                                        'M_H_ZIP_CODE' => $p_data['M_H_ZIP_CODE'],
                                        'M_H_Phone1' => $p_data['M_H_Phone1'],
                                        'M_H_Email' => $p_data['M_H_Email'],
                                        'M_H_Phone3' => $p_data['M_H_Phone3'],
                                        'M_profession' => $p_data['M_profession'],
                                        'M_profession_id' => $p_data['M_profession_id'],
                                        'guardian_id' => $p_data['guardian_id'],
                                        'Guardian' => $p_data['Guardian'],
                                        'Gender' => $p_data['Gender'],
                                        'g_adhar' => $p_data['g_adhar'],
                                        'G_profession' => $p_data['G_profession'],
                                        'G_profession_id' => $p_data['G_profession_id'],
                                        'G_C_address1' => $p_data['G_C_address1'],
                                        'G_C_address2' => $p_data['G_C_address2'],
                                        'G_C_address3' => $p_data['G_C_address3'],
                                        'G_C_ZIP_CODE' => $p_data['G_C_ZIP_CODE'],
                                        'G_C_Phone1' => $p_data['G_C_Phone1'],
                                        'G_C_Email' => $p_data['G_C_Email'],
                                        'G_C_Phone3' => $p_data['G_C_Phone3'],
                                        'G_O_address1' => $p_data['G_O_address1'],
                                        'G_O_address2' => $p_data['G_O_address2'],
                                        'G_O_address3' => $p_data['G_O_address3'],
                                        'G_O_ZIP_CODE' => $p_data['G_O_ZIP_CODE'],
                                        'G_O_Phone1' => $p_data['G_O_Phone1'],
                                        'G_O_Email' => $p_data['G_O_Email'],
                                        'G_O_Phone3' => $p_data['G_O_Phone3'],
                                        'G_H_address1' => $p_data['G_H_address1'],
                                        'G_H_address2' => $p_data['G_H_address2'],
                                        'G_H_address3' => $p_data['G_H_address3'],
                                        'G_H_ZIP_CODE' => $p_data['G_H_ZIP_CODE'],
                                        'G_H_Phone1' => $p_data['G_H_Phone1'],
                                        'G_H_Email' => $p_data['G_H_Email'],
                                        'G_H_Phone3' => $p_data['G_H_Phone3'],


                                        'admn_type' => $row['admn_type'],
                                        'blood_group' => $row['blood_group'],
                                        'sib_student_id' => $sib_student_id
                                    );
                                } else if ($row['admn_type'] == 'Staff') {
                                    if ($row['Father_Id'] == '' && $row['Mother_Id'] == '') { //only staff
                                        $newsiblingArr[] = array(
                                            'fname' => $row['fname'],
                                            'mname' => $row['mname'],
                                            'lname' => $row['lname'],
                                            'gender' => $row['gender'],
                                            'country' => $row['country'],
                                            'Nationality' => $row['Nationality'],
                                            'state' => $row['state'],
                                            'district' => $row['district'],
                                            'dob' => $row['dob'],
                                            'religion' => $row['religion'],
                                            'caste' => $row['caste'],
                                            'community' => $row['community'],
                                            'motherTongue' => $row['motherTongue'],
                                            'knownLang' => $row['knownLang'],
                                            'emirate_Id' => $row['emirate_Id'],
                                            'TempReg_ID' => $row['TempReg_ID'],
                                            'applicationDate' => $row['applicationDate'],
                                            'Acd_Yr' => $row['Acd_Yr'],
                                            'stream' => $row['stream'],
                                            'class' => $row['class'],
                                            'birthCountry' => $row['birthCountry'],
                                            'birthPlace' => $row['birthPlace'],
                                            'emirate_Id' => $row['emirate_Id'],
                                            'TempReg_ID' => $row['TempReg_ID'],
                                            'applicationDate' => $row['applicationDate'],
                                            'Acd_Yr' => $row['Acd_Yr'],
                                            'stream' => $row['stream'],
                                            'class' => $row['class'],
                                            'birthCountry' => $row['birthCountry'],
                                            'Parent_Name2' => '',
                                            'parentRelation' => $row['parentRelation'],
                                            'Address_Type' => $row['Address_Type'],
                                            'L_Address1' => str_replace("'", '', $row['L_Address1']),
                                            'L_Address2' => $row['L_Address2'],
                                            'L_Address3' => $row['L_Address3'],
                                            'L_zip' => $row['L_zip'],
                                            'L_phone' => $row['L_phone'],
                                            'L_mobile' => $row['L_mobile'],
                                            'L_mail' => $row['L_mail'],
                                            'O_Address1' => str_replace("'", '', $row['O_Address1']),
                                            'O_Address2' => $row['O_Address2'],
                                            'O_Address3' => $row['O_Address3'],
                                            'O_zip' => $row['O_zip'],
                                            'O_phone' => $row['O_phone'],
                                            'O_mobile' => $row['O_mobile'],
                                            'O_mail' => $row['O_mail'],
                                            'Profession2' => '',
                                            'aadhar2' => '',
                                            'Parent_Name1' => $row['parentName'],
                                            'Profession1' => $row['profession'],
                                            'aadhar1' => $row['empaadhar'],
                                            'Father_Id' => '',
                                            'Mother_Id' => '',
                                            'F_Address1' => '',
                                            'F_Address2' => '',
                                            'F_Address3' => '',
                                            'F_PO_No' => '',
                                            'F_Phone1' => '',
                                            'F_EMAIL' => '',
                                            'F_Phone3' => '',
                                            'Address_Type' => $row['Address_Type'],
                                            'Emp_id' => $row['Emp_id'],
                                            'admn_type' => $row['admn_type'],
                                            'emp_inst_id' => $row['emp_inst_id'],
                                            'Empgender' => $row['Empgender'],
                                            'blood_group' => $row['blood_group']

                                        );
                                    } else { //staff with
                                        if ($row['Empgender'] == 'F') {
                                            $newsiblingArr[] = array(
                                                'fname' => $row['fname'],
                                                'mname' => $row['mname'],
                                                'lname' => $row['lname'],
                                                'gender' => $row['gender'],
                                                'country' => $row['country'],
                                                'Nationality' => $row['Nationality'],
                                                'state' => $row['state'],
                                                'district' => $row['district'],
                                                'dob' => $row['dob'],
                                                'religion' => $row['religion'],
                                                'caste' => $row['caste'],
                                                'community' => $row['community'],
                                                'motherTongue' => $row['motherTongue'],
                                                'knownLang' => $row['knownLang'],
                                                'emirate_Id' => $row['emirate_Id'],
                                                'TempReg_ID' => $row['TempReg_ID'],
                                                'applicationDate' => $row['applicationDate'],
                                                'Acd_Yr' => $row['Acd_Yr'],
                                                'stream' => $row['stream'],
                                                'class' => $row['class'],
                                                'birthCountry' => $row['birthCountry'],
                                                'birthPlace' => $row['birthPlace'],
                                                'emirate_Id' => $row['emirate_Id'],
                                                'TempReg_ID' => $row['TempReg_ID'],
                                                'applicationDate' => $row['applicationDate'],
                                                'Acd_Yr' => $row['Acd_Yr'],
                                                'stream' => $row['stream'],
                                                'class' => $row['class'],
                                                'birthCountry' => $row['birthCountry'],
                                                'Parent_Name2' => $row['parentName'],
                                                'parentRelation' => $row['parentRelation'],
                                                'Address_Type' => $row['Address_Type'],
                                                'L_Address1' => str_replace("'", '', $row['L_Address1']),
                                                'L_Address2' => $row['L_Address2'],
                                                'L_Address3' => $row['L_Address3'],
                                                'L_zip' => $row['L_zip'],
                                                'L_phone' => $row['L_phone'],
                                                'L_mobile' => $row['L_mobile'],
                                                'L_mail' => $row['L_mail'],
                                                'O_Address1' => str_replace("'", '', $row['O_Address1']),
                                                'O_Address2' => $row['O_Address2'],
                                                'O_Address3' => $row['O_Address3'],
                                                'O_zip' => $row['O_zip'],
                                                'O_phone' => $row['O_phone'],
                                                'O_mobile' => $row['O_mobile'],
                                                'O_mail' => $row['O_mail'],
                                                'Profession2' => $row['profession'],
                                                'aadhar2' => $row['empaadhar'],
                                                'Parent_Name1' => $row['Parent_Name'],
                                                'Profession1' => $row['parent_profe'],
                                                'aadhar1' => $row['parent_aadhar'],
                                                'Father_Id' => $row['Father_Id'],
                                                'Mother_Id' => $row['Mother_Id'],
                                                'F_Address1' => $row['Address1'],
                                                'F_Address2' => $row['Address2'],
                                                'F_Address3' => $row['Address3'],
                                                'F_PO_No' => $row['PO_No'],
                                                'F_Phone1' => $row['Phone1'],
                                                'F_EMAIL' => $row['EMAIL'],
                                                'F_Phone3' => $row['Phone3'],
                                                'Address_Type' => $row['Address_Type'],
                                                'Emp_id' => $row['Emp_id'],
                                                'admn_type' => $row['admn_type'],
                                                'emp_inst_id' => $row['emp_inst_id'],
                                                'Empgender' => $row['Empgender'],
                                                'blood_group' => $row['blood_group']

                                            );
                                        } else {
                                            $newsiblingArr[] = array(
                                                'fname' => $row['fname'],
                                                'mname' => $row['mname'],
                                                'lname' => $row['lname'],
                                                'gender' => $row['gender'],
                                                'country' => $row['country'],
                                                'Nationality' => $row['Nationality'],
                                                'state' => $row['state'],
                                                'district' => $row['district'],
                                                'dob' => $row['dob'],
                                                'religion' => $row['religion'],
                                                'caste' => $row['caste'],
                                                'community' => $row['community'],
                                                'motherTongue' => $row['motherTongue'],
                                                'knownLang' => $row['knownLang'],
                                                'emirate_Id' => $row['emirate_Id'],
                                                'TempReg_ID' => $row['TempReg_ID'],
                                                'applicationDate' => $row['applicationDate'],
                                                'Acd_Yr' => $row['Acd_Yr'],
                                                'stream' => $row['stream'],
                                                'class' => $row['class'],
                                                'birthCountry' => $row['birthCountry'],
                                                'birthPlace' => $row['birthPlace'],
                                                'emirate_Id' => $row['emirate_Id'],
                                                'TempReg_ID' => $row['TempReg_ID'],
                                                'applicationDate' => $row['applicationDate'],
                                                'Acd_Yr' => $row['Acd_Yr'],
                                                'stream' => $row['stream'],
                                                'class' => $row['class'],
                                                'birthCountry' => $row['birthCountry'],
                                                'Parent_Name1' => $row['parentName'],
                                                'parentRelation' => $row['parentRelation'],
                                                'Address_Type' => $row['Address_Type'],
                                                'L_Address1' => str_replace("'", '', $row['L_Address1']),
                                                'L_Address2' => $row['L_Address2'],
                                                'L_Address3' => $row['L_Address3'],
                                                'L_zip' => $row['L_zip'],
                                                'L_phone' => $row['L_phone'],
                                                'L_mobile' => $row['L_mobile'],
                                                'L_mail' => $row['L_mail'],
                                                'O_Address1' => str_replace("'", '', $row['O_Address1']),
                                                'O_Address2' => $row['O_Address2'],
                                                'O_Address3' => $row['O_Address3'],
                                                'O_zip' => $row['O_zip'],
                                                'O_phone' => $row['O_phone'],
                                                'O_mobile' => $row['O_mobile'],
                                                'O_mail' => $row['O_mail'],
                                                'Profession1' => $row['profession'],
                                                'aadhar1' => $row['empaadhar'],
                                                'Parent_Name2' => $row['Parent_Name'],
                                                'Profession2' => $row['parent_profe'],
                                                'aadhar2' => $row['parent_aadhar'],
                                                'Father_Id' => $row['Father_Id'],
                                                'Mother_Id' => $row['Mother_Id'],
                                                'M_Address1' => $row['Address1'],
                                                'M_Address2' => $row['Address2'],
                                                'M_Address3' => $row['Address3'],
                                                'M_PO_No' => $row['PO_No'],
                                                'M_Phone1' => $row['Phone1'],
                                                'M_EMAIL' => $row['EMAIL'],
                                                'Phone3' => $row['Phone3'],
                                                'Address_Type' => $row['Address_Type'],
                                                'Emp_id' => $row['Emp_id'],
                                                'admn_type' => $row['admn_type'],
                                                'emp_inst_id' => $row['emp_inst_id'],
                                                'Empgender' => $row['Empgender'],
                                                'blood_group' => $row['blood_group']

                                            );
                                        }
                                    }
                                } else {
                                    $newsiblingArr[] = array(
                                        'fname' => $row['fname'],
                                        'mname' => $row['mname'],
                                        'lname' => $row['lname'],
                                        'gender' => $row['gender'],
                                        'country' => $row['country'],
                                        'Nationality' => $row['Nationality'],
                                        'state' => $row['state'],
                                        'district' => $row['district'],
                                        'dob' => $row['dob'],
                                        'religion' => $row['religion'],
                                        'caste' => $row['caste'],
                                        'community' => $row['community'],
                                        'motherTongue' => $row['motherTongue'],
                                        'knownLang' => $row['knownLang'],
                                        'emirate_Id' => $row['emirate_Id'],
                                        'TempReg_ID' => $row['TempReg_ID'],
                                        'applicationDate' => $row['applicationDate'],
                                        'Acd_Yr' => $row['Acd_Yr'],
                                        'stream' => $row['stream'],
                                        'class' => $row['class'],
                                        'birthCountry' => $row['birthCountry'],
                                        'birthPlace' => $row['birthPlace'],
                                        'emirate_Id' => $row['emirate_Id'],
                                        'TempReg_ID' => $row['TempReg_ID'],
                                        'applicationDate' => $row['applicationDate'],
                                        'Acd_Yr' => $row['Acd_Yr'],
                                        'stream' => $row['stream'],
                                        'class' => $row['class'],
                                        'birthCountry' => $row['birthCountry'],
                                        'Parent_Name1' => $row['parentName'],
                                        'parentRelation' => $row['parentRelation'],
                                        //'Address_Type' => $row['Address_Type'],
                                        'L_Address1' => str_replace("'", '', $row['L_Address1']),
                                        'L_Address2' => $row['L_Address2'],
                                        'L_Address3' => $row['L_Address3'],
                                        'L_zip' => $row['L_zip'],
                                        'L_phone' => $row['L_phone'],
                                        'L_mobile' => $row['L_mobile'],
                                        'L_mail' => $row['L_mail'],
                                        'O_Address1' =>  str_replace("'", '', $row['O_Address1']),
                                        'O_Address2' => $row['O_Address2'],
                                        'O_Address3' => $row['O_Address3'],
                                        'O_zip' => $row['O_zip'],
                                        'O_phone' => $row['O_phone'],
                                        'O_mobile' => $row['O_mobile'],
                                        'O_mail' => $row['O_mail'],
                                        'Of_Address1' => $row['Of_Address1'],
                                        'Of_Address2' => $row['Of_Address2'],
                                        'Of_Address3' => $row['Of_Address3'],
                                        'Of_zip' => $row['Of_zip'],
                                        'Of_phone' => $row['Of_phone'],
                                        'Of_mobile' => $row['Of_mobile'],
                                        'Of_mail' => $row['Of_mail'],
                                        'Profession' => $row['profession'],
                                        'admn_type' => $row['admn_type'],
                                        'blood_group' => $row['blood_group']

                                    );
                                }
                            }

                            $data['temp_stud_data'] = array_map("unserialize", array_unique(array_map("serialize", $newsiblingArr)));
                        } else {
                            $data['temp_stud_data'] = FALSE;
                        }
                        echo json_encode(array('status' => 1, 'view' => $this->load->view('registration/show_registration', $data, TRUE)));
                        return true;
                    } else {
                        echo json_encode(array('status' => 0));
                        return true;
                    }
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    public function get_state_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $country_id = filter_input(INPUT_POST, 'country_id', FILTER_SANITIZE_NUMBER_INT);
            //    dev_export($country_id);die;
            if (isset($country_id) && !empty($country_id)) {
                //        $data['user_name'] = $this->session->userdata('user_name');

                $state = $this->MRegistration->get_country_statedetails($country_id);
                //        dev_export($state);die;
                if (isset($state['error_status']) && $state['error_status'] == 0) {
                    if ($state['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'data' => $state['data']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0));
                        return true;
                    }
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }
    public function get_employee_list_from_wfm()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = filter_input(INPUT_POST, 'inst_id', FILTER_SANITIZE_NUMBER_INT);
            $gender = filter_input(INPUT_POST, 'gender');
            //$fname = filter_input(INPUT_POST, 'fname');
            //$mname = filter_input(INPUT_POST, 'mname');
            if (isset($inst_id) && !empty($inst_id)) {
                $employee_list = $this->MRegistration->get_employee_list_from_wfm($inst_id, $gender);
                //dev_export($employee_list);
                // die;
                if (isset($employee_list['error_status']) && $employee_list['error_status'] == 0) {
                    if ($employee_list['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'data' => $employee_list['data']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0));
                        return true;
                    }
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    public function get_employee_details_from_wfm()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = filter_input(INPUT_POST, 'inst_id', FILTER_SANITIZE_NUMBER_INT);
            $emp_id = filter_input(INPUT_POST, 'emp_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($inst_id) && !empty($inst_id)) {
                $employee_list = $this->MRegistration->get_employee_details_from_wfm($inst_id, $emp_id);
                if (isset($employee_list['error_status']) && $employee_list['error_status'] == 0) {
                    if ($employee_list['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'data' => $employee_list['data']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0));
                        return true;
                    }
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    public function get_city_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $state_id = filter_input(INPUT_POST, 'state_id', FILTER_SANITIZE_NUMBER_INT);
            //    dev_export($country_id);die;
            if (isset($state_id) && !empty($state_id)) {
                //        $data['user_name'] = $this->session->userdata('user_name');

                $city = $this->MRegistration->get_country_citydetails($state_id);
                if (isset($city['error_status']) && $city['error_status'] == 0) {
                    if ($city['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'data' => $city['data']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0));
                        return true;
                    }
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    public function get_caste_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $religion_id = filter_input(INPUT_POST, 'religion_id', FILTER_SANITIZE_NUMBER_INT);
            //    dev_export($country_id);die;
            if (isset($religion_id) && !empty($religion_id)) {
                //        $data['user_name'] = $this->session->userdata('user_name');

                $caste = $this->MRegistration->get_religion_castedetails($religion_id);
                //        dev_export($state);die;
                if (isset($caste['error_status']) && $caste['error_status'] == 0) {
                    if ($caste['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'data' => $caste['data']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0));
                        return true;
                    }
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    public function show_student_profile()
    {
        if ($this->input->is_ajax_request() == 1) {
            //$data['template'] = 'student_profile/profile';
            $data['title'] = 'STUDENT PROFILE';
            $data['sub_title'] = 'Student Profile';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('profile/show-class-for-students'),
                    'title' => 'Registration Management'
                ),
                '2' => array(
                    'title' => 'Batch'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);

            if ((null === $batchid) || strlen(trim($batchid)) == 0) {
                $batchid = -1;
            }

            $status_f = '';
            if ($batchid == -1) {
                $status_f = 5;
            } else {
                $status_f = 1;
            }
            //    dev_export($batchid);die


            $details_data = $this->MRegistration->get_all_studentdata($acd_year_id, $batchid, $status_f, $courseid);

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['batchid'] = $batchid;
            $data['user_name'] = $this->session->userdata('user_name');
            $data['acdyr_id'] = $acd_year_id;
            $data['batch_id'] = $batchid;


            echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/profile', $data, TRUE)));
            return TRUE;
        }
    }

    //create function by vinoth @26-06-2019 @ 14:36
    public function show_student_profile_for_sponsered_stud()
    {
        if ($this->input->is_ajax_request() == 1) {
            //$data['template'] = 'student_profile/profile';
            $data['title'] = 'SPONSORED STUDENTS';
            $data['sub_title'] = 'SPONSORED STUDENTS';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'link' => base_url('profile/show-class-for-students'),
                    'title' => 'Registration Management'
                ),
                '2' => array(
                    'title' => 'Sponsored Students'
                ),
                '3' => array(
                    'title' => 'Batch'
                ),
                '4' => array(
                    'title' => 'Students'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $acd_year_id = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);

            if ((null === $batchid) || strlen(trim($batchid)) == 0) {
                $batchid = -1;
            }

            $status_f = '';
            if ($batchid == -1) {
                $status_f = 5;
            } else {
                $status_f = 1;
            }
            //    dev_export($batchid);die


            $details_data = $this->MRegistration->get_all_studentdata($acd_year_id, $batchid, $status_f, $courseid);

            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['batchid'] = $batchid;
            $data['user_name'] = $this->session->userdata('user_name');
            $data['acdyr_id'] = $acd_year_id;
            $data['batch_id'] = $batchid;


            echo json_encode(array('status' => 1, 'view' => $this->load->view('sponserd_stud/sponsered_stud_profile', $data, TRUE)));
            return TRUE;
        }
    }

    public function email_compose()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            $acd_yrid = filter_input(INPUT_POST, 'acd_id', FILTER_SANITIZE_NUMBER_INT);
            $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);
            $student_name = filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $batch_name = filter_input(INPUT_POST, 'batch_name', FILTER_SANITIZE_STRING);
            $admn_no = filter_input(INPUT_POST, 'admn_no', FILTER_SANITIZE_STRING);

            //    $data['template'] = 'student_profile/compose_email';
            $data['title'] = 'Compose Email';
            $data['sub_title'] = 'Student Profile';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'title' => 'Registration Management',
                    'link' => base_url('school/home')
                ),
                '2' => array(
                    'link' => base_url('profile/show-class-for-students'),
                    'title' => 'Batch Search'
                ),
                '3' => array(
                    'title' => 'Student Search',
                    'function' => "load_students_after_filter_on_breadcrumb('" . $batchid . "','" . $this->session->userdata('acd_year') . "','" . $courseid . "')"
                ),
                '4' => array(
                    'title' => 'Compose Email'
                )
            );
            $data['batchid'] = $batchid;
            $data['acd_yrid'] = $acd_yrid;
            $data['courseid'] = $courseid;
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $data['user_name'] = $this->session->userdata('user_name');
            $parent_email = $this->MRegistration->get_emailID($student_id);
            $data['student_name'] = $student_name;
            $data['batch_name'] = $batch_name;
            $data['admn_no'] = $admn_no;
            if ($parent_email['error_status'] == 0 && $parent_email['data_status'] == 1) {
                $data['parent_email'] = $parent_email['data'];
                //            echo  $data['parent_address']['Father'];
                //                                dev_export($data['parent_address']);die;
                $data['message'] = "";
                echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/compose_email', $data, TRUE)));
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Mail id is not available', 'view' => $this->load->view('student_profile/compose_email', $data, TRUE), $data, TRUE));
                return;
                $data['parent_email'] = FALSE;
                $data['message'] = $parent_email['message'];
            }
            //        $data['parent_email'] = $parent_email['data'];
            //    echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/compose_email', $data, TRUE)));
            return TRUE;
        }
    }

    public function show_profile()
    {
        //dev_export($_POST);die;
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);

            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            $cur_acd_year = 0;
            if (isset($student_id) && !empty($student_id)) {
                $data['user_name'] = $this->session->userdata('user_name');
                $parent_address = $this->MRegistration->get_student_parentaddress($student_id);
                if ($parent_address['error_status'] == 0 && $parent_address['data_status'] == 1) {
                    $data['parent_address'] = $parent_address['data'];
                    $data['message'] = "";
                } else {
                    $data['parent_address'] = FALSE;
                    $data['message'] = $parent_address['message'];
                }
                $data['parent_address'] = $parent_address['data'];
                $student_data = $this->MRegistration->get_profiles_student($student_id);
                //        dev_export($student_data);die();
                //        dev_export($student_id);die;
                if ($student_data['error_status'] == 0 && $student_data['data_status'] == 1) {
                    $data['student_data'] = $student_data['data'][0];
                    $data['batch_select'] = $student_data['data'][0]['Cur_Batch'];
                    $student_cur_year = $student_data['data'][0]['Cur_AcadYr'];
                    $data['student_cur_year'] = $student_data['data'][0]['Cur_AcadYr'];
                    $cur_acd_year = $student_data['data'][0]['Cur_AcadYr'];
                    $course_id = $student_data['data'][0]['Class_ID'];
                    $data['message'] = "";
                } else {
                    $data['student_data'] = FALSE;
                    $data['message'] = $student_data['message'];
                }
                $passport_data = $this->MRegistration->get_passport_student($student_id);
                //        dev_export($passport_data);die;
                if ($passport_data['error_status'] == 0 && $passport_data['data_status'] == 1) {
                    $data['passport_data'] = $passport_data['data'][0];
                    $data['message'] = "";
                } else {
                    $data['passport_data'] = FALSE;
                    $data['message'] = $passport_data['message'];
                }
                $sibilings_data = $this->MRegistration->get_sibilings_student($student_id);
                if ($sibilings_data['error_status'] == 0 && $sibilings_data['data_status'] == 1) {
                    $data['sibilings_data'] = $sibilings_data['data'];
                    $data['message'] = "";
                } else {
                    $data['sibilings_data'] = FALSE;
                    $data['message'] = $sibilings_data['message'];
                }
                $data_prep = array(
                    'student_id' => $student_id
                );
                $data['studentid'] = $student_id;
                $student_data1 = $this->MRegistration->get_profiles_student_status($data_prep);
                if ($student_data1['error_status'] == 0 && $student_data1['data_status'] == 1) {
                    $data['student_data1'] = $student_data1['data'];
                    $data['message'] = "";
                    $data['tcstatus'] = $student_data1['data'][0]['tcstatus'];
                } else {
                    $data['student_data1'] = FALSE;
                    $data['message'] = $student_data1['message'];
                    $data['tcstatus'] = "";
                }

                $batch_data = $this->MRegistration->get_batch_details_for_batch_allotment_from_student_id($student_id);
                if (isset($batch_data['data']) && !empty($batch_data['data'])) {
                    $data['batch_data'] = $batch_data['data'];
                } else {
                    $data['batch_data'] = NULL;
                }
                $parent_email = $this->MRegistration->get_emailID($student_id);
                if ($parent_email['error_status'] == 0 && $parent_email['data_status'] == 1) {
                    $data['parent_email'] = $parent_email['data'];
                    $data['message'] = "";
                } else {
                    $data['parent_email'] = FALSE;
                    $data['message'] = $parent_email['message'];
                }
                if (!(isset($batchid) && !empty($batchid))) {
                    if (isset($student_data['data'][0]['Cur_Batch']) && !empty($student_data['data'][0]['Cur_Batch'])) {
                        $batchid = $student_data['data'][0]['Cur_Batch'];
                    }
                }
                $inst_id = $this->session->userdata('inst_id');
                $acd_year_id = $this->session->userdata('acd_year');
                $allocation_data_for_student = $this->MFee_collection->get_collection_data_by_student($student_id, $inst_id, $acd_year_id);
                $data['exm_pending'] = 0;
                $data['recon_pending'] = 0;
                //PENALTY MANAGE
                if (isset($allocation_data_for_student['penalty_details']) && !empty($allocation_data_for_student['penalty_details'])) {
                    $data['penalty_details'] = $allocation_data_for_student['penalty_details'];
                    // dev_export($allocation_data_for_student['penalty_details']);
                    // die;
                    $penaltyarray = array();
                    foreach ($allocation_data_for_student['penalty_details'] as $pdls) {
                        $effectdate = date('d-m-Y', strtotime($pdls['effectdate']));
                        $penaltyarray[$pdls['fee_id']]['effectdate'] = $effectdate;
                        $penaltyarray[$pdls['fee_id']]['penalty_type'] = $pdls['penalty_type'];
                        $penaltyarray[$pdls['fee_id']]['details'][] = array(
                            'FromDays' => $pdls['FromDays'],
                            'Todays' => $pdls['Todays'],
                            'amount' => $pdls['amount']
                        );
                        $data['penalty_details'] = $penaltyarray; //[$pdls['Todays']] = $pdls['amount'];
                    }
                } else {
                    $data['penalty_details'] = NULL;
                }
                // dev_export($penaltyarray);
                // die;
                /** */

                $totalpenalty = 0;
                $penalty_check_array = array();
                if (isset($allocation_data_for_student['data'])) {
                    foreach ($allocation_data_for_student['data'] as $demand) {
                        $penalty = 0;
                        if (!isset($penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']])) {
                            //added this condition for is there penalty details added for this feecode - NOV 06, 2019
                            if (isset($penaltyarray) && !empty($penaltyarray) && isset($penaltyarray[$demand['FEEID']])) {
                                //dev_export($penaltyarray);
                                $currentdate = date_create(date('d-m-Y'));
                                $demanddate = date_create(date('d-m-Y', strtotime($demand['ARREAR_DATE'])));
                                $effect_date = date_create(date('d-m-Y', strtotime($penaltyarray[$demand['FEEID']]['effectdate'])));
                                $interval = date_diff($currentdate, $demanddate);
                                $days = $interval->format('%R%a');
                                //echo $days;
                                $days_difference = abs($days); //FEEID
                                $symbol = substr($days, 0, 1);
                                if ($symbol == '+' && $days_difference != 0) {
                                    $penalty = 0;
                                } else {
                                    // if ($demanddate <= $effect_date) {
                                    //if ($penaltyarray[$demand['FEEID']]['penalty_type'] == 'S') { //for slab penalty calculation
                                    foreach ($penaltyarray[$demand['FEEID']]['details'] as $pda) {
                                        if ($days_difference >= $pda['FromDays']) {
                                            $penalty = $pda['amount'];
                                            break;
                                        } else {
                                            $penalty = 0;
                                            continue;
                                        }
                                    }
                                    //} else { //for fixed penalty calculation
                                    //$penalty = $penaltyarray[$demand['FEEID']]['details'][0]['amount'];
                                    //}
                                    //}
                                    $penalty = (($penalty - $demand['PENALTY_PAID']) > 0 ? ($penalty - $demand['PENALTY_PAID']) : 0);
                                    $penalty = (($penalty - $demand['NON_RECONCILED_PENALTY']) > 0 ? ($penalty - $demand['NON_RECONCILED_PENALTY']) : 0);
                                    $penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']] = $demand['FEEID'];
                                    if (($demand['TRANSACTION_AMOUNT'] - $demand['EXEMPTION_PENDING_AMOUNT']) <= 0) {
                                        $penalty = 0;
                                    }
                                }
                            } else {
                                $penalty = 0;
                            }
                        }
                        // $total_pending =  $demand['PENDING_PAYMENT'] - ($demand['TOTAL_PAID_AMOUNT'] + $demand['CONCESSION_AMOUNT'] + $demand['EXEMPTION_AMOUNT'] + $demand['EXEMPTION_PENDING_AMOUNT']);
                        $total_pending =  $demand['TRANSACTION_AMOUNT'] - ($demand['TOTAL_PAID_AMOUNT'] + $demand['CONCESSION_AMOUNT'] + $demand['EXEMPTION_AMOUNT'] + $demand['EXEMPTION_PENDING_AMOUNT']);
                        // $penalty = ($demand['PENDING_PAYMENT'] > 0 ? $penalty : 0);
                        $penalty = ($total_pending > 0 ? $penalty : 0);
                        // $penalty = ($total_pending > $demand['EXEMPTION_PENDING_AMOUNT'] ? $penalty : 0);
                        $totalpenalty += $penalty;
                    }
                }
                $data['total_penalty'] = $totalpenalty;
                /** */
                //PENALTY MANAGE
                if (isset($allocation_data_for_student['summary_data']) && !empty($allocation_data_for_student['summary_data'])) {
                    if (isset($allocation_data_for_student['summary_data']['EXEMPTION_PENDING_AMOUNT']) && $allocation_data_for_student['summary_data']['EXEMPTION_PENDING_AMOUNT'] > 0) {
                        $data['exm_pending'] = round($allocation_data_for_student['summary_data']['EXEMPTION_PENDING_AMOUNT'], 2); //rounded for displaying amount when tc apply
                        $data['recon_pending'] = round($allocation_data_for_student['summary_data']['TOTAL_NON_RECONCILED_AMOUNT'], 2); //rounded for displaying amount when tc apply
                    }
                    $data['fee_summary'] = ($allocation_data_for_student['summary_data']['PENDING_PAYMENT'] + $allocation_data_for_student['summary_data']['EXEMPTION_PENDING_AMOUNT'] + $allocation_data_for_student['summary_data']['TOTAL_NON_RECONCILED_AMOUNT'] + ($allocation_data_for_student['summary_data']['PENDING_PAYMENT'] > 0 ? $totalpenalty : 0));
                    $data['min_wallet'] = $allocation_data_for_student['summary_data']['MIN_WALLET_AMOUNT_TO_PAY'];
                    $data['FIST_TERM_FEE'] = $allocation_data_for_student['summary_data']['FIST_TERM_FEE'];
                    $data['PREV_ARREAR'] = $allocation_data_for_student['summary_data']['PREV_ARREAR'];
                    $data['PAID_OR_NOT'] = $allocation_data_for_student['summary_data']['PAID_OR_NOT'];
                    $data['E_WALLET'] = $allocation_data_for_student['summary_data']['E_WALLET'];
                    $data['DEMANDED_OR_NOT'] = $allocation_data_for_student['summary_data']['DEMANDED_OR_NOT'];
                } else {
                    $data['fee_summary'] = 0;
                    $data['min_wallet'] = 0;
                    $data['FIST_TERM_FEE'] = 0;
                    $data['PREV_ARREAR'] = 0;
                    $data['PAID_OR_NOT'] = 0;
                    $data['E_WALLET'] = 0;
                    $data['DEMANDED_OR_NOT'] = 0;
                }
                //Academic History
                $data_ah = array(
                    'action'                => 'get_academic_history',
                    'controller_function'   => 'Student_settings/Student_controller/get_academic_history',
                    'inst_id' => $inst_id,
                    'student_id' => $student_id
                );
                $academic_history = $this->MRegistration->get_academic_history($data_ah);
                if ($academic_history['error_status'] == 0 && $academic_history['data_status'] == 1) {
                    $data['academic_history'] = $academic_history['data'];
                    $data['message'] = "";
                } else {
                    $data['academic_history'] = FALSE;
                    $data['message'] = $academic_history['message'];
                }

                $data['title'] = 'STUDENT PROFILE';
                $data['sub_title'] = 'Student Profile';
                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'link' => base_url('profile/show-class-for-students'),
                        'title' => 'Registration Management'
                    ),
                    '2' => array(
                        //this link added by vinoth @ 14-05-2019 4:00
                        //link' => base_url('profile/show-class-for-students'),
                        'title' => 'Batch',
                        'function' => "load_students_after_filter_on_breadcrumb('" . $batchid . "','" . $cur_acd_year . "','" . $course_id . "')"
                    ),
                    '3' => array(
                        'title' => 'Student Profile'
                    )
                );

                $data['batchid'] = $batchid;
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);
                //        dev_export($data);die;
                $this->load->view('student_profile/profile_details', $data);
            }
        }
    }


    public function show_sponser()
    {
        //$data['template'] = 'currency/show_currency';
        //  $data['template'] = 'currency/show-currency';
        $data['title'] = 'Registration Management';
        $data['sub_title'] = 'Registration Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Registration Management',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Sponsored Student'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $sponsers_data = $this->MRegistration->get_all_sponsers();
        //dev_export($currency_data);die;
        if ($sponsers_data['error_status'] == 0 && $sponsers_data['data_status'] == 1) {
            $data['sponsers_data'] = $sponsers_data['data'];
            $data['message'] = "";
        } else {
            $data['sponsers_data'] = FALSE;
            $data['message'] = $sponsers_data['message'];
        }
        $data['student_id'] = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
        $this->session->set_userdata('current_page', 'currency');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['sponsers_data']) && !empty($data['sponsers_data'])) {
                foreach ($data['sponsers_data'] as $sponser) {
                    //                       dev_export($currency);
                    $sponsers_status = "";
                    //            if ($currency['isactive'] == 1) {
                    //                $currency_status = '<a href="javascript:void(0);" onclick="edit_currency(\'' . $currency['id'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $currency['Sponser_name'] . '" data-original-title="Edit ' . $currency['Sponser_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //                 //$currency_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $currency['id'] . '\',\'' . $currency['Sponser_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                    //                //$currency_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $currency['currency_id'] . '\',\'' . $currency['currency_name'] . '\');"/><span></span></label>';
                    //            } else {
                    //                $currency_status = '<a href="javascript:void(0);" onclick="edit_currency(\'' . $currency['id'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $currency['Sponser_name'] . '" data-original-title="Edit ' . $currency['Sponser_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //                //$currency_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $currency['id'] . '\',\'' . $currency['Sponser_name'] . '\', this)" id="" class="js-switch"  /></a>';
                    //               // $currency_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $currency['currency_id'] . '\',\'' . $currency['currency_name'] . '\');"/><span></span></label>';
                    //            }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_sponsers(\'' . $sponser['id'] . '\',\'' . $sponser['Sponser_name'] . '\',\'' . $sponser['Sponser_address'] . '\',\'' . $sponser['s_email'] . '\',\'' . $sponser['s_mobile'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $sponser['Sponser_name'] . '" data-original-title="Edit ' . $sponser['Sponser_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($sponser['Sponser_name'], $sponser['Sponser_address'], $sponser['s_email'], $sponser['s_mobile'], $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('sponserd_stud/sponsered_student_profile_details', $data);
        }
    }


    //create profile detaile for sponsered students by vinoth @ 26-06-2019 15:44
    public function show_profile_for_sponsered_student()
    {
        //dev_export($_POST);die;
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);

            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            $cur_acd_year = 0;
            if (isset($student_id) && !empty($student_id)) {
                $data['user_name'] = $this->session->userdata('user_name');
                $student_data = $this->MRegistration->get_profiles_student($student_id);
                if ($student_data['error_status'] == 0 && $student_data['data_status'] == 1) {
                    $data['student_data'] = $student_data['data'][0];
                    $data['batch_select'] = $student_data['data'][0]['Cur_Batch'];
                    $student_cur_year = $student_data['data'][0]['Cur_AcadYr'];
                    $data['student_cur_year'] = $student_data['data'][0]['Cur_AcadYr'];
                    $cur_acd_year = $student_data['data'][0]['Cur_AcadYr'];
                    $course_id = $student_data['data'][0]['Class_ID'];
                    $data['message'] = "";
                } else {
                    $data['student_data'] = FALSE;
                    $data['message'] = $student_data['message'];
                }
                $sponsers_data = $this->MRegistration->get_all_sponsers();
                //         dev_export($sponsers_data);die;
                if ($sponsers_data['error_status'] == 0 && $sponsers_data['data_status'] == 1) {
                    $data['sponsers_data'] = $sponsers_data['data'];
                    $data['message'] = "";
                } else {
                    $data['sponsers_data'] = FALSE;
                    $data['message'] = $sponsers_data['message'];
                }
                $data['title'] = 'SPONSORED STUDENTS';
                $data['sub_title'] = 'SPONSORED STUDENTS';
                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'link' => base_url('profile/show-class-for-students'),
                        'title' => 'Registration Management'
                    ),
                    '2' => array(
                        //this link added by vinoth @ 14-05-2019 4:00
                        'link' => base_url('profile/show-class-for-students'),
                        'title' => 'Batch',
                        'function' => "load_students_after_filter_on_breadcrumb('" . $batchid . "','" . $cur_acd_year . "','" . $course_id . "')"
                    ),
                    '3' => array(
                        'title' => 'Student Profile'
                    )
                );

                $data['batchid'] = $batchid;
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);
                $this->load->view('sponserd_stud/sponsered_student_profile_details', $data);
            }
        }
    }





    //create function for add sponser form by vinoth @ 26-06-2019 16:59
    public function add_sponser()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $studentID = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
            // echo $studentID;exit;
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Currency Management', 'status' => 0, 'link' => base_url('currency/show-currency')),
                2 => array('message' => 'Add New Currency', 'status' => 1)
            );

            $data['panel_sub_header'] = 'Add New Sponsors';
            $data['breadcrumb'] = $breadcrumb;
            $data['title'] = 'ADD NEW SPONSORS';
            $data['studentID'] = $studentID;
            $this->session->set_userdata('current_page', 'currency');
            $this->session->set_userdata('current_parent', 'gen_sett');
            if ($onload == 1) {
                $this->load->view('sponserd_stud/add_sponser', $data);
            } else {

                $this->form_validation->set_rules('sponser_name', 'Sponser Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('sponser_add', 'Sponser Address', 'trim|required|min_length[3]|max_length[15]');

                if ($this->form_validation->run() == TRUE) {

                    $data_prep['sponser_name'] = strtoupper(filter_input(INPUT_POST, 'sponser_name', FILTER_SANITIZE_STRING));
                    $data_prep['sponser_add'] = strtoupper(filter_input(INPUT_POST, 'sponser_add', FILTER_SANITIZE_STRING));
                    $data_prep['sponser_email'] = strtoupper(filter_input(INPUT_POST, 'sponser_email', FILTER_SANITIZE_STRING));
                    $data_prep['sponser_mobile'] = strtoupper(filter_input(INPUT_POST, 'sponser_mobile', FILTER_SANITIZE_NUMBER_INT));
                    $data_prep['student_id'] = strtoupper(filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT));

                    $status = $this->MRegistration->save_sponser($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['sponser_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['sponser_name'] = filter_input(INPUT_POST, 'sponser_name', FILTER_SANITIZE_STRING);
                        $data['sponser_add'] = filter_input(INPUT_POST, 'sponser_name', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('sponserd_stud/sponsered_student_profile_details', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data['sponser_name'] = filter_input(INPUT_POST, 'sponser_name', FILTER_SANITIZE_STRING);
                    $data['sponser_add'] = filter_input(INPUT_POST, 'sponser_add', FILTER_SANITIZE_STRING);

                    echo json_encode(array('status' => 3, 'view' => $this->load->view('sponserd_stud/sponsered_student_profile_details', $data, TRUE), 'message' => ''));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    //edit sponsers create by vinoth @ 27-06-2019
    public function edit_sponsers()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $sponser_id = filter_input(INPUT_POST, 'sponser_id', FILTER_SANITIZE_NUMBER_INT);
            $sponser_name = filter_input(INPUT_POST, 'sponser_name', FILTER_SANITIZE_STRING);
            $sponser_add = filter_input(INPUT_POST, 'sponser_add', FILTER_SANITIZE_STRING);
            if (isset($sponser_id) && !empty($sponser_id)) {

                //        $breadcrumb = array(
                //            0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                //            1 => array('message' => 'Currency Management', 'status' => 0, 'link' => base_url('currency/show-currency')),
                //            2 => array('message' => 'Edit Currency', 'status' => 1)
                //        );


                //$data['panel_sub_header'] = 'Edit Currency - ';
                //        $data['breadcrumb'] = $breadcrumb;
                $data['sponser_id'] = $sponser_id;
                //        $this->session->set_userdata('current_page', 'currency');
                //        $this->session->set_userdata('current_parent', 'gen_sett');

                $sponser_data_raw = $this->MRegistration->get_sponsers_details($sponser_id);
                //        dev_export($currency_data_raw);die;
                if (is_array($sponser_data_raw) && isset($sponser_data_raw['data_status']) && !empty($sponser_data_raw['data_status']) && $sponser_data_raw['data_status'] == 1) {
                    $data['currency_data'] = $sponser_data_raw['data'][0];
                    $data['sponser_id'] = $sponser_data_raw['data'][0]['s_id'];
                    $data['sponser_name'] = $sponser_data_raw['data'][0]['Sponser_Name'];
                    $data['sponser_add'] = $sponser_data_raw['data'][0]['Sponser_Address'];
                    $data['sponser_email'] = $sponser_data_raw['data'][0]['Sponser_Email'];
                    $data['sponser_mobile'] = $sponser_data_raw['data'][0]['Sponser_Mobile'];
                    $data['title'] = 'EDIT SPONSOR - ' . $sponser_data_raw['data'][0]['Sponser_Name'];;
                    //            dev_export($data);die;
                    $data['panel_sub_header'] = 'Edit Sponsors - ' . $sponser_data_raw['data'][0]['Sponser_Name'];;
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Currency / No data associated with this currency', 'data' => ''));
                    return;
                }
                if ($onload == 1) {
                    $view = $this->load->view('sponserd_stud/edit_sponser', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('sponser_name', 'Sponser Name', 'trim|required|min_length[3]|max_length[30]');
                    $this->form_validation->set_rules('sponser_add', 'Sponser Address', 'trim|required|min_length[3]|max_length[15]');
                    $this->form_validation->set_rules('sponser_email', 'Sponser Email', 'trim|required');
                    $this->form_validation->set_rules('sponser_mobile', 'Sponser Mobile Number', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['sponser_id'] = filter_input(INPUT_POST, 'sponser_id', FILTER_SANITIZE_STRING);
                        $data_prep['sponser_name'] = strtoupper(filter_input(INPUT_POST, 'sponser_name', FILTER_SANITIZE_STRING));
                        $data_prep['sponser_add'] = strtoupper(filter_input(INPUT_POST, 'sponser_add', FILTER_SANITIZE_STRING));
                        $data_prep['sponser_email'] = strtoupper(filter_input(INPUT_POST, 'sponser_email', FILTER_SANITIZE_STRING));
                        $data_prep['sponser_mobile'] = strtoupper(filter_input(INPUT_POST, 'sponser_mobile', FILTER_SANITIZE_NUMBER_INT));
                        $status = $this->MRegistration->edit_save_sponser($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['sponser_name'] . "  Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => ''));
                            return;
                        } else {
                            $data['sponser_name'] = filter_input(INPUT_POST, 'sponser_name', FILTER_SANITIZE_STRING);
                            $data['sponser_add'] = filter_input(INPUT_POST, 'sponser_add', FILTER_SANITIZE_STRING);
                            //$data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('sponserd_stud/edit_sponser', $data, TRUE), 'message' => $status['message']));
                            return;
                        }
                    } else {
                        $data['sponser_name'] = filter_input(INPUT_POST, 'sponser_name', FILTER_SANITIZE_STRING);
                        $data['sponser_add'] = filter_input(INPUT_POST, 'sponser_add', FILTER_SANITIZE_STRING);
                        //$data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('sponserd_stud/edit_sponser', $data, TRUE), 'message' => ''));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Currency ID is provided / Invalid Currency', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_batch_allocation_for_student()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
            $BatchID = filter_input(INPUT_POST, 'BatchID', FILTER_SANITIZE_NUMBER_INT);
            $Cur_AcadYr = filter_input(INPUT_POST, 'Cur_AcadYr', FILTER_SANITIZE_NUMBER_INT);
            if (!(isset($Cur_AcadYr) && !empty($Cur_AcadYr))) {
                $Cur_AcadYr = -1;
            }
            if (isset($BatchID) && !empty($BatchID) && $BatchID > 0) {
                $status = $this->MRegistration->save_batch_allocation_for_student($student_id, $BatchID, $Cur_AcadYr);
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Batch data is required.'));
                return true;
            }

            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Successfully Updated'));
                return true;
            } else {
                if (isset($status['message'])) {
                    echo json_encode(array('status' => 0, 'message' => $status['message']));
                    return true;
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'An error encountered. Please check the data and try again later'));
                    return true;
                }
            }
        }
    }

    //    create controll by vinoth @ 24-05-2019 14:34
    public function edit_admission_no()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
            $Admn_No = filter_input(INPUT_POST, 'admn_no', FILTER_SANITIZE_STRING);
            $Cur_AcadYr = filter_input(INPUT_POST, 'Cur_AcadYr', FILTER_SANITIZE_NUMBER_INT);
            if (!(isset($Cur_AcadYr) && !empty($Cur_AcadYr))) {
                $Cur_AcadYr = -1;
            }
            if (isset($Admn_No) && !empty($Admn_No)) {
                $status = $this->MRegistration->edit_admission_no($student_id, $Admn_No, $Cur_AcadYr);
                if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Admission Number Successfully Updated'));
                    return true;
                } else {
                    echo json_encode(array('status' => 0, 'message' => $status['message']));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Admission No. data is required.'));
                return true;
            }
        }
    }

    public function show_fees()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);
            if (isset($student_id) && !empty($student_id)) {
                //        $data['template'] = '';
                $data['title'] = 'STUDENT PROFILE';
                $data['sub_title'] = 'Student Profile';
                $student_data = $this->MRegistration->get_profiles_student($student_id);

                $courseid = $student_data['data'][0]['Class_ID'];
                $batchid = $student_data['data'][0]['Cur_Batch'];
                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'link' => base_url('profile/show-class-for-students'),
                        'title' => 'Registration Management'
                    ),
                    '2' => array(
                        'title' => 'Batch',
                        'function' => "load_students_after_filter_on_breadcrumb('" . $batchid . "','" . $this->session->userdata('acd_year') . "','" . $courseid . "')"
                    ),
                    '3' => array(
                        'title' => 'Fees details'
                    )
                );
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);
                $inst_id = $this->session->userdata('inst_id');
                $acd_year_id = $this->session->userdata('acd_year');

                $details_data = $this->MAccount->get_student_account_data($student_id, $inst_id, $acd_year_id);

                //Account details
                if (isset($details_data['data_detail']) && !empty($details_data['data_detail']) && isset($details_data['data_summary']) && !empty($details_data['data_summary']) && $student_data['error_status'] == 0 && $student_data['data_status'] == 1) {

                    //Demand statement
                    if (isset($details_data['data_detail'][0]['DEMAND_STATEMENT'])) {
                        $demand_statement_raw = $details_data['data_detail'][0]['DEMAND_STATEMENT'];
                        $demand_statement = json_decode($demand_statement_raw, true);
                    } else {
                        $demand_statement = NULL;
                    }
                    //Demand statement Previous Year
                    if (isset($details_data['data_detail'][0]['DEMAND_STATEMENT_PREV_YR'])) {
                        $demand_statement_raw_prev = $details_data['data_detail'][0]['DEMAND_STATEMENT_PREV_YR'];
                        $demand_statement_prev = json_decode($demand_statement_raw_prev, true);
                    } else {
                        $demand_statement_prev = NULL;
                    }
                    //Payment data
                    if (isset($details_data['data_detail'][0]['PAYMENT_STATEMENT'])) {
                        $payment_statement_raw = $details_data['data_detail'][0]['PAYMENT_STATEMENT'];
                        $payment_statement = json_decode($payment_statement_raw, true);
                    } else {
                        $payment_statement = NULL;
                    }
                    // dev_export($payment_statement);
                    // die;
                    //Docme Wallet data
                    if (isset($details_data['data_detail'][0]['WALLET_STATEMENT'])) {
                        $wallet_statement_raw = $details_data['data_detail'][0]['WALLET_STATEMENT'];
                        $wallet_statement = json_decode($wallet_statement_raw, true);
                    } else {
                        $wallet_statement = NULL;
                    }

                    $data['demand_statement'] = $demand_statement;
                    $data['demand_statement_prev'] = $demand_statement_prev;
                    $data['payment_statement'] = $payment_statement;
                    $data['wallet_statement'] = $wallet_statement;
                    // dev_export($details_data);
                    // die;
                    $total_demanded_amount = 0;
                    $demand_type_amount = 0;
                    $nondemandable_type_amount = 0;
                    $demand_with_vat = 0;
                    $demand_paid = 0;
                    $non_demand_with_vat = 0;
                    $non_demand_paid = 0;

                    $pending_arrear_amount = 0;
                    $VAT_amount = 0;

                    $wallet_final_balance = 0;
                    $wallet_unclear_amount = 0;

                    $total_cheque_non_reconciled_transaction = 0;

                    $total_paid_amount = 0;
                    $total_surcharge = 0;
                    $total_cash_transaction = 0;
                    $total_card_transaction = 0;
                    $total_cheque_transaction = 0;
                    $total_cheque_non_realized_amt = 0;
                    $total_cheque_realized_amount = 0;
                    $total_wallet_payment = 0;
                    $total_online_payment = 0;
                    $total_dbt_payment = 0;

                    $total_demand_paid_amount = 0;

                    $total_pending_amount_incl_vat = 0;

                    $total_realized_chq_amt = 0;
                    $total_other_realized = 0;
                    $total_non_realized = 0;
                    $total_realized_amt = 0;

                    //Summary Data
                    //Demand Amount                
                    $summary_demand_data_raw = json_decode($details_data['data_summary'][0]['DEMAND_DATA'], TRUE);
                    $total_concession_amount = 0;
                    $total_exemption_amount = 0;
                    $total_demanded_amount_minus_concn_exmn = 0;
                    if (isset($summary_demand_data_raw) && !empty($summary_demand_data_raw)) {
                        foreach ($summary_demand_data_raw as $demand_summary) {
                            if ($demand_summary['fee_demand_type'] == 'Demandable Fee') {
                                $total_demanded_amount = $total_demanded_amount + $demand_summary['TRANSACTION_AMOUNT_WITH_VAT'];
                                $total_demanded_amount_minus_concn_exmn = $total_demanded_amount_minus_concn_exmn + $demand_summary['TRANSACTION_AMOUNT_WITH_VAT_MINUS_EXMN_CONCN'];
                                $demand_paid = $demand_summary['TOTAL_PAID_AMOUNT'];
                                $demand_with_vat = $demand_summary['TRANSACTION_AMOUNT_WITH_VAT'];
                                $demand_type_amount = ($demand_summary['AMOUNT_WITHOUT_VAT']); // - $demand_summary['CONCESSION_AMOUNT'] - $demand_summary['EXEMPTION_AMOUNT']);
                                $total_demand_paid_amount = $total_demand_paid_amount + $demand_summary['TOTAL_PAID_AMOUNT']; // + $demand_summary['CONCESSION_AMOUNT'] + $demand_summary['EXEMPTION_AMOUNT'];
                                $total_concession_amount += $demand_summary['CONCESSION_AMOUNT'];
                                $total_exemption_amount += $demand_summary['EXEMPTION_AMOUNT'];
                            }
                            if ($demand_summary['fee_demand_type'] == 'Non Demandable Fee') {
                                $total_demanded_amount = $total_demanded_amount + $demand_summary['TRANSACTION_AMOUNT_WITH_VAT'];
                                $total_demanded_amount_minus_concn_exmn = $total_demanded_amount_minus_concn_exmn + $demand_summary['TRANSACTION_AMOUNT_WITH_VAT_MINUS_EXMN_CONCN'];
                                $non_demand_paid = $demand_summary['TOTAL_PAID_AMOUNT'];
                                $non_demand_with_vat = $demand_summary['TRANSACTION_AMOUNT_WITH_VAT'];
                                $nondemandable_type_amount = $demand_summary['AMOUNT_WITHOUT_VAT'];
                                $total_demand_paid_amount = $total_demand_paid_amount + $demand_summary['TOTAL_PAID_AMOUNT']; // + $demand_summary['CONCESSION_AMOUNT'] + $demand_summary['EXEMPTION_AMOUNT'];
                                $total_concession_amount += $demand_summary['CONCESSION_AMOUNT'];
                                $total_exemption_amount += $demand_summary['EXEMPTION_AMOUNT'];
                            }
                        }
                    }
                    //Penalty Data
                    $summary_penalty_data_raw = json_decode($details_data['data_summary'][0]['PENALTY_DATA'], TRUE);
                    if (isset($summary_penalty_data_raw) && !empty($summary_penalty_data_raw) && isset($summary_penalty_data_raw[0]['PENALTY_AMOUNT']) && !empty($summary_penalty_data_raw[0]['PENALTY_AMOUNT'])) {
                        $penalty_amount = $summary_penalty_data_raw[0]['PENALTY_AMOUNT'];
                    } else {
                        $penalty_amount = 0;
                    }
                    //Penalty Data
                    $PAID_DATA_raw = json_decode($details_data['data_summary'][0]['PAID_DATA'], TRUE);
                    if (isset($PAID_DATA_raw) && !empty($PAID_DATA_raw) && isset($PAID_DATA_raw[0]['TOTAL_PAID_AMOUNT']) && !empty($PAID_DATA_raw[0]['TOTAL_PAID_AMOUNT'])) {
                        $PAID_DATA = $PAID_DATA_raw[0]['TOTAL_PAID_AMOUNT'];
                    } else {
                        $PAID_DATA = 0;
                    }
                    $data['PAID_DATA'] = $PAID_DATA;
                    $tot_exp_conc_amount = $total_concession_amount + $total_exemption_amount;
                    $data['total_demand_amt'] = $total_demanded_amount;
                    $data['total_demand_amt_after_conc_exmp'] = $demand_type_amount - $tot_exp_conc_amount;
                    $data['demandable_without_vat'] = $demand_type_amount;
                    $data['demandable_with_vat'] = $demand_with_vat;
                    $data['demandable_paid_amount'] = $demand_paid;

                    $data['non_demandable_without_vat'] = $nondemandable_type_amount;
                    $data['non_demandable_with_vat'] = $non_demand_with_vat;
                    $data['non_demandable_paid_amount'] = $non_demand_paid;
                    $data['total_demand_paid_amount'] = ($total_demand_paid_amount); // - $penalty_amount
                    $total_payable_amount = $total_demanded_amount_minus_concn_exmn - ($total_demand_paid_amount); //- $penalty_amount
                    $data['total_payable_amount'] = $total_payable_amount;
                    $data['display_percent'] = ($total_demanded_amount_minus_concn_exmn > 0 ? (($total_demand_paid_amount) / $total_demanded_amount_minus_concn_exmn * 100) : 0); //- $penalty_amount //, 2, PHP_ROUND_HALF_UP

                    //Payment Data
                    $summary_payment_data_raw = json_decode($details_data['data_summary'][0]['PAYMENT_DATA'], TRUE);
                    if (isset($summary_payment_data_raw) && !empty($summary_payment_data_raw)) {
                        $total_cheque_non_reconciled_transaction = $summary_payment_data_raw[0]['TOTAL_NON_RECON_AMT'];
                        $total_pending_amount_incl_vat = $summary_payment_data_raw[0]['PENDING_PAYMENT_INCL_VAT'];
                    }

                    $data['total_pending_payment'] = $total_pending_amount_incl_vat;
                    $data['total_non_reconciled_cheque_amount'] = $total_cheque_non_reconciled_transaction;

                    //Collection Realized grouping
                    $summary_payment_realize_data_raw = json_decode($details_data['data_summary'][0]['CHEQUE_STATUS_DATA'], TRUE);
                    if (isset($summary_payment_realize_data_raw) && !empty($summary_payment_realize_data_raw)) {
                        foreach ($summary_payment_realize_data_raw as $summary_data) {
                            if ($summary_data['cheque_status'] == 'OTHER REALIZED') {
                                $total_other_realized = $total_other_realized + $summary_data['total_sum'];
                            }
                            if ($summary_data['cheque_status'] == 'REALIZED') {
                                $total_realized_chq_amt = $total_realized_amt + $summary_data['total_sum'];
                            }
                            if ($summary_data['cheque_status'] == 'NON REALIZED') {
                                $total_non_realized = $total_non_realized + $summary_data['total_sum'];
                            }
                        }
                    }

                    $total_realized_amt = $total_other_realized + $total_realized_chq_amt;
                    $data['total_realized_amt'] = $total_realized_amt;
                    $data['total_non_realized_amt'] = $total_non_realized;


                    //Payment mode wise data
                    $summary_payment_mode_wise_raw = json_decode($details_data['data_summary'][0]['PAYMENT_MODE_WISE'], TRUE);
                    if (isset($summary_payment_mode_wise_raw) && !empty($summary_payment_mode_wise_raw)) {
                        // dev_export($summary_payment_mode_wise_raw);
                        // die;
                        foreach ($summary_payment_mode_wise_raw as $summary_data) {
                            if ($summary_data['MODE_OF_PAYMENT'] == 'WALLET') { //&& $summary_data['MODE_OF_PAYMENT'] == 1
                                $total_wallet_payment = $summary_data['total_sum']; // - $tot_exp_conc_amount; //$summary_data['concession_amount']; //
                                $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                            }
                            if ($summary_data['MODE_OF_PAYMENT'] == 'ONLINE') {
                                $total_online_payment = $summary_data['total_sum'];
                                $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                            }
                            if ($summary_data['MODE_OF_PAYMENT'] == 'DBT') {
                                $total_dbt_payment = $summary_data['total_sum'];
                                $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                            }
                            if ($summary_data['MODE_OF_PAYMENT'] == 'CASH') {
                                $total_cash_transaction = $summary_data['total_sum'];
                                $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                            }
                            if ($summary_data['MODE_OF_PAYMENT'] == 'CARD') {
                                $total_card_transaction = $summary_data['total_sum'];
                                $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];

                                $total_surcharge = $summary_data['total_surcharge'];
                            }
                            if ($summary_data['MODE_OF_PAYMENT'] == 'CHEQUE') {
                                if ($summary_data['cheque_status'] == 'CHQ RECONCILED') {
                                    $total_cheque_realized_amount = $total_cheque_realized_amount + $summary_data['total_sum'];
                                    $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                                    $total_cheque_transaction = $total_cheque_transaction + $summary_data['total_sum'];
                                }
                                if ($summary_data['cheque_status'] == 'CHQ NON RECONCILED') {
                                    $total_cheque_non_realized_amt = $total_cheque_non_realized_amt + $summary_data['total_sum'];
                                    $total_cheque_transaction = $total_cheque_transaction + $summary_data['total_sum'];
                                }
                            }
                        }
                    }
                    $data['cash_transaction']   = $total_cash_transaction;
                    $data['card_transaction']   = $total_card_transaction;
                    $data['card_surcharge']     = $total_surcharge;
                    $data['wallet_transaction'] = $total_wallet_payment;
                    $data['cheque_total_transaction'] = $total_cheque_transaction;
                    $data['cheque_reconcile_transaction'] = $total_cheque_realized_amount;
                    $data['cheque_non_reconcile_transaction'] = $total_cheque_non_realized_amt;
                    $data['online_transaction'] = $total_online_payment;
                    $data['dbt_transaction'] = $total_dbt_payment;
                    $data['total_paid_amount'] = $total_paid_amount;

                    //Arrear Data
                    $summary_arrear_data_raw = json_decode($details_data['data_summary'][0]['ARREAR_DATA'], TRUE);
                    if (isset($summary_arrear_data_raw) && !empty($summary_arrear_data_raw)) {
                        foreach ($summary_arrear_data_raw as $arrear_summary_data) {
                            $pending_arrear_amount += $arrear_summary_data['TOTALPENDING_ARREAR_AMOUNT'];
                        }
                    }
                    $data['total_arrear_amount'] = $pending_arrear_amount;

                    //Arrear Data Previous Year
                    $pending_arrear_amount_prev = 0;
                    $summary_arrear_data_raw_prev = json_decode($details_data['data_summary'][0]['ARREAR_DATA_PREV'], TRUE);
                    if (isset($summary_arrear_data_raw_prev) && !empty($summary_arrear_data_raw_prev)) {
                        foreach ($summary_arrear_data_raw_prev as $arrear_summary_data_prev) {
                            $pending_arrear_amount_prev += $arrear_summary_data_prev['TOTALPENDING_ARREAR_AMOUNT'];
                        }
                    }
                    $data['total_arrear_amount_prev'] = $pending_arrear_amount_prev;

                    //VAT/TAX Data
                    $summary_VAT_data_raw = json_decode($details_data['data_summary'][0]['VAT_DATA'], TRUE);
                    if (isset($summary_VAT_data_raw) && !empty($summary_VAT_data_raw)) {
                        foreach ($summary_VAT_data_raw as $VAT_summary_data) {
                            $VAT_amount += $VAT_summary_data['VAT_AMOUNT'];
                        }
                    }
                    $data['total_vat_amount'] = $VAT_amount;

                    //Wallet Data
                    $summary_wallet_data_raw = json_decode($details_data['data_summary'][0]['DOCME_WALLET_DATA'], TRUE);
                    if (isset($summary_wallet_data_raw) && !empty($summary_wallet_data_raw)) {
                        $wallet_final_balance = $summary_wallet_data_raw[0]['ACCOUNT_BALANCE'];
                        $wallet_unclear_amount = $summary_wallet_data_raw[0]['UNCLEAR_ACCOUNT_BALANCE'];
                    }
                    $data['wallet_clear_balance'] = $wallet_final_balance;
                    $data['wallet_unclear_balance'] = $wallet_unclear_amount;

                    //Payback Data
                    $summary_payback_data_raw = json_decode($details_data['data_summary'][0]['PAY_BACK_DATA'], TRUE);
                    if (isset($summary_payback_data_raw) && !empty($summary_payback_data_raw) && isset($summary_payback_data_raw[0]['PAYBACK_AMOUNT']) && !empty($summary_payback_data_raw[0]['PAYBACK_AMOUNT'])) {
                        $payback_amount = $summary_payback_data_raw[0]['PAYBACK_AMOUNT'];
                    } else {
                        $payback_amount = 0;
                    }
                    //Round OFF Data
                    $summary_roundoff_data_raw = json_decode($details_data['data_summary'][0]['ROUNDOFF_DATA'], TRUE);
                    if (isset($summary_roundoff_data_raw) && !empty($summary_roundoff_data_raw) && isset($summary_roundoff_data_raw[0]['ROUNDOFF_AMOUNT']) && !empty($summary_roundoff_data_raw[0]['ROUNDOFF_AMOUNT'])) {
                        $roundoff_amount = $summary_roundoff_data_raw[0]['ROUNDOFF_AMOUNT'];
                    } else {
                        $roundoff_amount = 0;
                    }

                    $data['payback_amount']     = $payback_amount;
                    $data['penalty_amount']     = $penalty_amount;
                    $data['roundoff_amount']    = $roundoff_amount;
                    $data['concession_amount']  = $total_concession_amount;
                    $data['exemption_amount']   = $total_exemption_amount;
                    $data['tot_exp_conc_amount']   = $tot_exp_conc_amount;


                    if (isset($details_data['penalty_details']) && !empty($details_data['penalty_details'])) {
                        $data['penalty_details'] = $details_data['penalty_details'];
                        $penaltyarray = array();
                        foreach ($details_data['penalty_details'] as $pdls) {
                            $effectdate = date('d-m-Y', strtotime($pdls['effectdate']));
                            $penaltyarray[$pdls['fee_id']]['effectdate'] = $effectdate;
                            $penaltyarray[$pdls['fee_id']]['penalty_type'] = $pdls['penalty_type'];
                            $penaltyarray[$pdls['fee_id']]['details'][] = array(
                                'FromDays' => $pdls['FromDays'],
                                'Todays' => $pdls['Todays'],
                                'amount' => $pdls['amount']
                            );
                            $data['penalty_details'] = $penaltyarray; //[$pdls['Todays']] = $pdls['amount'];
                        }
                    } else {
                        $data['penalty_details'] = NULL;
                    } //$data['demand_statement']
                    $totalpenalty = 0;
                    $penalty_check_array = array();
                    if (isset($demand_statement) && !empty($demand_statement)) {
                        foreach ($demand_statement as $demand) {
                            $penalty = 0;

                            if (!isset($penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']])) {
                                //added this condition for is there penalty details added for this feecode - NOV 06, 2019
                                if (isset($penaltyarray) && !empty($penaltyarray) && isset($penaltyarray[$demand['FEEID']])) {
                                    //dev_export($penaltyarray);
                                    $currentdate = date_create(date('d-m-Y'));
                                    $demanddate = date_create(date('d-m-Y', strtotime($demand['ARREAR_DATE'])));
                                    $effect_date = date_create(date('d-m-Y', strtotime($penaltyarray[$demand['FEEID']]['effectdate'])));
                                    $interval = date_diff($currentdate, $demanddate);
                                    $days = $interval->format('%R%a');
                                    //echo $days;
                                    $days_difference = abs($days); //FEEID
                                    $symbol = substr($days, 0, 1);
                                    if ($symbol == '+' && $days_difference != 0) {
                                        $penalty = 0;
                                    } else {
                                        // if ($demanddate <= $effect_date) {
                                        //if ($penaltyarray[$demand['FEEID']]['penalty_type'] == 'S') { //for slab penalty calculation
                                        foreach ($penaltyarray[$demand['FEEID']]['details'] as $pda) {
                                            if ($days_difference >= $pda['FromDays']) {
                                                $penalty = $pda['amount'];
                                                break;
                                            } else {
                                                $penalty = 0;
                                                continue;
                                            }
                                        }
                                        //} else { //for fixed penalty calculation
                                        //$penalty = $penaltyarray[$demand['FEEID']]['details'][0]['amount'];
                                        //}
                                        //}
                                        // $penalty = (($penalty - ($demand['PENALTY_PAID'] + $demand['NRC_PENALTY_PAID'])) > 0 ? ($penalty - ($demand['PENALTY_PAID'] + $demand['NRC_PENALTY_PAID'])) : 0);
                                        $penalty = (($penalty - $demand['PENALTY_PAID']) > 0 ? ($penalty - $demand['PENALTY_PAID']) : 0);
                                        $penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']] = $demand['FEEID'];
                                        if (($demand['TRANSACTION_AMOUNT'] - $demand['EXEMPTION_PENDING_AMOUNT']) == 0) {
                                            $penalty = 0;
                                        }
                                        if (($demand['PENDING_PAYMENT'] - $demand['NON_RECONCILED_AMOUNT']) == 0) {
                                            $penalty = 0;
                                        }
                                    }
                                } else {
                                    $penalty = 0;
                                }
                            }
                            $penalty = ($demand['PENDING_PAYMENT'] > 0 ? $penalty : 0);
                            $totalpenalty += $penalty;
                        }
                    }
                    $data['total_penalty'] = $totalpenalty;

                    /** Pevious Year */
                    $totalpenalty_prev = 0;
                    $penalty_check_array = array();
                    if (isset($demand_statement_prev) && !empty($demand_statement_prev)) {
                        foreach ($demand_statement_prev as $demand) {
                            $penalty = 0;

                            if (!isset($penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']])) {
                                //added this condition for is there penalty details added for this feecode - NOV 06, 2019
                                if (isset($penaltyarray) && !empty($penaltyarray) && isset($penaltyarray[$demand['FEEID']])) {
                                    //dev_export($penaltyarray);
                                    $currentdate = date_create(date('d-m-Y'));
                                    $demanddate = date_create(date('d-m-Y', strtotime($demand['ARREAR_DATE'])));
                                    $effect_date = date_create(date('d-m-Y', strtotime($penaltyarray[$demand['FEEID']]['effectdate'])));
                                    $interval = date_diff($currentdate, $demanddate);
                                    $days = $interval->format('%R%a');
                                    //echo $days;
                                    $days_difference = abs($days); //FEEID
                                    $symbol = substr($days, 0, 1);
                                    if ($symbol == '+' && $days_difference != 0) {
                                        $penalty = 0;
                                    } else {
                                        foreach ($penaltyarray[$demand['FEEID']]['details'] as $pda) {
                                            if ($days_difference >= $pda['FromDays']) {
                                                $penalty = $pda['amount'];
                                                break;
                                            } else {
                                                $penalty = 0;
                                                continue;
                                            }
                                        }
                                        // $penalty = (($penalty - ($demand['PENALTY_PAID'] + $demand['NRC_PENALTY_PAID'])) > 0 ? ($penalty - ($demand['PENALTY_PAID'] + $demand['NRC_PENALTY_PAID'])) : 0);
                                        $penalty = (($penalty - $demand['PENALTY_PAID']) > 0 ? ($penalty - $demand['PENALTY_PAID']) : 0);
                                        $penalty_check_array[$demand['FEEID'] . '_' . $demand['DEM_MONTH']] = $demand['FEEID'];
                                        if (($demand['TRANSACTION_AMOUNT'] - $demand['EXEMPTION_PENDING_AMOUNT']) == 0) {
                                            $penalty = 0;
                                        }
                                    }
                                } else {
                                    $penalty = 0;
                                }
                            }
                            $penalty = ($demand['PENDING_PAYMENT'] > 0 ? $penalty : 0);
                            $totalpenalty_prev += $penalty;
                        }
                    }
                    $data['totalpenalty_prev'] = $totalpenalty_prev;
                    /** Pevious Year */

                    //Wallet withdraw Data
                    $summary_wallet_withdraw_data_raw = json_decode($details_data['data_summary'][0]['WALLET_WITHDRAW_DATA'], TRUE);
                    $wallet_withdraw_not_encash_data = 0;
                    $wallet_withdraw_encash_data = 0;
                    $wallet_withdraw_total = 0;

                    if (isset($summary_wallet_withdraw_data_raw) && is_array($summary_wallet_withdraw_data_raw)) {
                        foreach ($summary_wallet_withdraw_data_raw as $wdata) {
                            if (isset($wdata['ENCASH_STATUS']) && $wdata['ENCASH_STATUS'] == 1) {
                                $wallet_withdraw_encash_data = $wdata['AMOUNT'];
                                $wallet_withdraw_total = $wallet_withdraw_total + $wallet_withdraw_encash_data;
                            } else if (isset($wdata['ENCASH_STATUS']) && $wdata['ENCASH_STATUS'] == 0) {
                                $wallet_withdraw_not_encash_data = $wdata['AMOUNT'];
                                $wallet_withdraw_total = $wallet_withdraw_total + $wallet_withdraw_not_encash_data;
                            }
                        }
                    } else {
                        $wallet_withdraw_not_encash_data = 0;
                        $wallet_withdraw_encash_data = 0;
                        $wallet_withdraw_total = 0;
                    }
                    $data['wallet_encash_data'] = $wallet_withdraw_encash_data;
                    $data['wallet_not_encash_data'] = $wallet_withdraw_not_encash_data;
                    $data['wallet_total_encash_data'] = $wallet_withdraw_total;



                    $data['student_data'] = $student_data['data'][0];
                    $data['message'] = "";

                    $data['sub_title'] = 'Student Account Management';


                    $this->load->view('student_account/student_account', $data);
                } else {
                    $this->load->view(ERROR_500);
                    return true;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    // $this->load->view('student_account/student_account', $data);
    //             } else {
    //                 $this->load->view(ERROR_500);
    //                 return true;
    //             }
    //         }
    //     } else {
    //         $this->load->view(ERROR_500);
    //     }
    public function student_account_reload()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_NUMBER_INT);
            if (isset($student_id) && !empty($student_id)) {
                //        $data['template'] = '';
                $data['title'] = 'STUDENT PROFILE';
                $data['sub_title'] = 'Student Profile';

                $student_data = $this->MRegistration->get_profiles_student($student_id);
                $courseid = $student_data['data'][0]['Class_ID'];

                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'link' => base_url('profile/show-class-for-students'),
                        'title' => 'Registration Management'
                    ),
                    '2' => array(
                        'title' => 'Batch',
                        'function' => "load_students_after_filter_on_breadcrumb('" . $batchid . "','" . $this->session->userdata('acd_year') . "','" . $courseid . "')"
                    ),
                    '3' => array(
                        'title' => 'Fees details'
                    )
                );
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);
                $inst_id = $this->session->userdata('inst_id');
                $acd_year_id = $this->session->userdata('acd_year');

                $details_data = $this->MAccount->get_student_account_data($student_id, $inst_id, $acd_year_id);
                //$student_data = $this->MRegistration->get_profiles_student($student_id);

                //Account details

                if (isset($details_data['data_detail']) && !empty($details_data['data_detail']) && isset($details_data['data_summary']) && !empty($details_data['data_summary']) && $student_data['error_status'] == 0 && $student_data['data_status'] == 1) {

                    //Demand statement
                    if (isset($details_data['data_detail'][0]['DEMAND_STATEMENT'])) {
                        $demand_statement_raw = $details_data['data_detail'][0]['DEMAND_STATEMENT'];
                        $demand_statement = json_decode($demand_statement_raw, true);
                    } else {
                        $demand_statement = NULL;
                    }
                    //Payment data
                    if (isset($details_data['data_detail'][0]['PAYMENT_STATEMENT'])) {
                        $payment_statement_raw = $details_data['data_detail'][0]['PAYMENT_STATEMENT'];
                        $payment_statement = json_decode($payment_statement_raw, true);
                    } else {
                        $payment_statement = NULL;
                    }
                    //Docme Wallet data
                    if (isset($details_data['data_detail'][0]['WALLET_STATEMENT'])) {
                        $wallet_statement_raw = $details_data['data_detail'][0]['WALLET_STATEMENT'];
                        $wallet_statement = json_decode($wallet_statement_raw, true);
                    } else {
                        $wallet_statement = NULL;
                    }

                    $data['demand_statement'] = $demand_statement;
                    $data['payment_statement'] = $payment_statement;
                    $data['wallet_statement'] = $wallet_statement;
                    //        dev_export($data);die;
                    $total_demanded_amount = 0;
                    $demand_type_amount = 0;
                    $nondemandable_type_amount = 0;
                    $demand_with_vat = 0;
                    $demand_paid = 0;
                    $non_demand_with_vat = 0;
                    $non_demand_paid = 0;

                    $pending_arrear_amount = 0;

                    $wallet_final_balance = 0;
                    $wallet_unclear_amount = 0;

                    $total_cheque_non_reconciled_transaction = 0;

                    $total_paid_amount = 0;
                    $total_cash_transaction = 0;
                    $total_card_transaction = 0;
                    $total_cheque_transaction = 0;
                    $total_cheque_non_realized_amt = 0;
                    $total_cheque_realized_amount = 0;
                    $total_wallet_payment = 0;
                    $total_online_payment = 0;

                    $total_demand_paid_amount = 0;

                    $total_pending_amount_incl_vat = 0;

                    $total_realized_chq_amt = 0;
                    $total_other_realized = 0;
                    $total_non_realized = 0;
                    $total_realized_amt = 0;

                    //Summary Data
                    //Demand Amount                
                    $summary_demand_data_raw = json_decode($details_data['data_summary'][0]['DEMAND_DATA'], TRUE);
                    if (isset($summary_demand_data_raw) && !empty($summary_demand_data_raw)) {
                        foreach ($summary_demand_data_raw as $demand_summary) {
                            if ($demand_summary['fee_demand_type'] == 'Demandable Fee') {
                                $total_demanded_amount = $total_demanded_amount + $demand_summary['TRANSACTION_AMOUNT_WITH_VAT'];
                                $demand_paid = $demand_summary['TOTAL_PAID_AMOUNT'];
                                $demand_with_vat = $demand_summary['TRANSACTION_AMOUNT_WITH_VAT'];
                                $demand_type_amount = $demand_summary['AMOUNT_WITHOUT_VAT'];
                                $total_demand_paid_amount = $total_demand_paid_amount + $demand_summary['TOTAL_PAID_AMOUNT'];
                            }
                            if ($demand_summary['fee_demand_type'] == 'Non Demandable Fee') {
                                $total_demanded_amount = $total_demanded_amount + $demand_summary['TRANSACTION_AMOUNT_WITH_VAT'];
                                $non_demand_paid = $demand_summary['TOTAL_PAID_AMOUNT'];
                                $non_demand_with_vat = $demand_summary['TRANSACTION_AMOUNT_WITH_VAT'];
                                $nondemandable_type_amount = $demand_summary['AMOUNT_WITHOUT_VAT'];
                                $total_demand_paid_amount = $total_demand_paid_amount + $demand_summary['TOTAL_PAID_AMOUNT'];
                            }
                        }
                    }
                    $data['total_demand_amt'] = $total_demanded_amount;
                    $data['demandable_without_vat'] = $demand_type_amount;
                    $data['demandable_with_vat'] = $demand_with_vat;
                    $data['demandable_paid_amount'] = $demand_paid;

                    $data['non_demandable_without_vat'] = $nondemandable_type_amount;
                    $data['non_demandable_with_vat'] = $non_demand_with_vat;
                    $data['non_demandable_paid_amount'] = $non_demand_paid;
                    $data['total_demand_paid_amount'] = $total_demand_paid_amount;
                    $data['display_percent'] = round($total_demanded_amount > 0 ? ($total_demand_paid_amount / $total_demanded_amount * 100) : 0, 2, PHP_ROUND_HALF_UP);

                    //Payment Data
                    $summary_payment_data_raw = json_decode($details_data['data_summary'][0]['PAYMENT_DATA'], TRUE);
                    if (isset($summary_payment_data_raw) && !empty($summary_payment_data_raw)) {
                        $total_cheque_non_reconciled_transaction = $summary_payment_data_raw[0]['TOTAL_NON_RECON_AMT'];
                        $total_pending_amount_incl_vat = $summary_payment_data_raw[0]['PENDING_PAYMENT_INCL_VAT'];
                    }
                    $data['total_pending_payment'] = $total_pending_amount_incl_vat;
                    $data['total_non_reconciled_cheque_amount'] = $total_cheque_non_reconciled_transaction;

                    //Collection Realized grouping
                    $summary_payment_realize_data_raw = json_decode($details_data['data_summary'][0]['CHEQUE_STATUS_DATA'], TRUE);
                    if (isset($summary_payment_realize_data_raw) && !empty($summary_payment_realize_data_raw)) {
                        foreach ($summary_payment_realize_data_raw as $summary_data) {
                            if ($summary_data['cheque_status'] == 'OTHER REALIZED') {
                                $total_other_realized = $total_other_realized + $summary_data['total_sum'];
                            }
                            if ($summary_data['cheque_status'] == 'REALIZED') {
                                $total_realized_chq_amt = $total_realized_amt + $summary_data['total_sum'];
                            }
                            if ($summary_data['cheque_status'] == 'NON REALIZED') {
                                $total_non_realized = $total_non_realized + $summary_data['total_sum'];
                            }
                        }
                    }

                    $total_realized_amt = $total_other_realized + $total_realized_chq_amt;
                    $data['total_realized_amt'] = $total_realized_amt;
                    $data['total_non_realized_amt'] = $total_non_realized;


                    //Payment mode wise data
                    $summary_payment_mode_wise_raw = json_decode($details_data['data_summary'][0]['PAYMENT_MODE_WISE'], TRUE);
                    if (isset($summary_payment_mode_wise_raw) && !empty($summary_payment_mode_wise_raw)) {
                        //            dev_export($summary_payment_mode_wise_raw);die;
                        foreach ($summary_payment_mode_wise_raw as $summary_data) {
                            if ($summary_data['MODE_OF_PAYMENT'] == 'WALLET') {
                                $total_wallet_payment = $summary_data['total_sum'];
                                $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                            }
                            if ($summary_data['MODE_OF_PAYMENT'] == 'ONLINE') {
                                $total_online_payment = $summary_data['total_sum'];
                                $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                            }
                            if ($summary_data['MODE_OF_PAYMENT'] == 'CASH') {
                                $total_cash_transaction = $summary_data['total_sum'];
                                $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                            }
                            if ($summary_data['MODE_OF_PAYMENT'] == 'CARD') {
                                $total_card_transaction = $summary_data['total_sum'];
                                $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                            }
                            if ($summary_data['MODE_OF_PAYMENT'] == 'CHEQUE') {
                                if ($summary_data['cheque_status'] == 'CHQ RECONCILED') {
                                    $total_cheque_realized_amount = $summary_data['total_sum'];
                                    $total_paid_amount = $total_paid_amount + $summary_data['total_sum'];
                                    $total_cheque_transaction = $total_cheque_transaction + $summary_data['total_sum'];
                                }
                                if ($summary_data['cheque_status'] == 'CHQ NON RECONCILED') {
                                    $total_cheque_non_realized_amt = $summary_data['total_sum'];
                                    $total_cheque_transaction = $total_cheque_transaction + $summary_data['total_sum'];
                                }
                            }
                        }
                    }
                    $data['cash_transaction'] = $total_cash_transaction;
                    $data['card_transaction'] = $total_card_transaction;
                    $data['wallet_transaction'] = $total_wallet_payment;
                    $data['cheque_total_transaction'] = $total_cheque_transaction;
                    $data['cheque_reconcile_transaction'] = $total_cheque_realized_amount;
                    $data['cheque_non_reconcile_transaction'] = $total_cheque_non_realized_amt;
                    $data['online_transaction'] = $total_online_payment;
                    $data['total_paid_amount'] = $total_paid_amount;
                    $data['batch_id'] = $batchid;
                    //Arrear Data
                    $summary_arrear_data_raw = json_decode($details_data['data_summary'][0]['ARREAR_DATA'], TRUE);
                    if (isset($summary_arrear_data_raw) && !empty($summary_arrear_data_raw)) {
                        foreach ($summary_arrear_data_raw as $arrear_summary_data) {
                            $pending_arrear_amount = $arrear_summary_data['TOTALPENDING_ARREAR_AMOUNT'];
                        }
                    }
                    $data['total_arrear_amount'] = $pending_arrear_amount;

                    //Wallet Data
                    $summary_wallet_data_raw = json_decode($details_data['data_summary'][0]['DOCME_WALLET_DATA'], TRUE);
                    if (isset($summary_wallet_data_raw) && !empty($summary_wallet_data_raw)) {
                        $wallet_final_balance = $summary_wallet_data_raw[0]['ACCOUNT_BALANCE'];
                        $wallet_unclear_amount = $summary_wallet_data_raw[0]['UNCLEAR_ACCOUNT_BALANCE'];
                    }
                    $data['wallet_clear_balance'] = $wallet_final_balance;
                    $data['wallet_unclear_balance'] = $wallet_unclear_amount;


                    //Payback Data
                    $summary_payback_data_raw = json_decode($details_data['data_summary'][0]['PAY_BACK_DATA'], TRUE);
                    if (isset($summary_payback_data_raw) && !empty($summary_payback_data_raw) && isset($summary_payback_data_raw[0]['PAYBACK_AMOUNT']) && !empty($summary_payback_data_raw[0]['PAYBACK_AMOUNT'])) {
                        $payback_amount = $summary_payback_data_raw[0]['PAYBACK_AMOUNT'];
                    } else {
                        $payback_amount = 0;
                    }
                    $data['payback_amount'] = $payback_amount;


                    //Wallet withdraw Data
                    $summary_wallet_withdraw_data_raw = json_decode($details_data['data_summary'][0]['WALLET_WITHDRAW_DATA'], TRUE);
                    $wallet_withdraw_not_encash_data = 0;
                    $wallet_withdraw_encash_data = 0;
                    $wallet_withdraw_total = 0;

                    if (isset($summary_wallet_withdraw_data_raw) && is_array($summary_wallet_withdraw_data_raw)) {
                        foreach ($summary_wallet_withdraw_data_raw as $wdata) {
                            if (isset($wdata['ENCASH_STATUS']) && $wdata['ENCASH_STATUS'] == 1) {
                                $wallet_withdraw_encash_data = $wdata['AMOUNT'];
                                $wallet_withdraw_total = $wallet_withdraw_total + $wallet_withdraw_encash_data;
                            } else if (isset($wdata['ENCASH_STATUS']) && $wdata['ENCASH_STATUS'] == 0) {
                                $wallet_withdraw_not_encash_data = $wdata['AMOUNT'];
                                $wallet_withdraw_total = $wallet_withdraw_total + $wallet_withdraw_not_encash_data;
                            }
                        }
                    } else {
                        $wallet_withdraw_not_encash_data = 0;
                        $wallet_withdraw_encash_data = 0;
                        $wallet_withdraw_total = 0;
                    }
                    $data['wallet_encash_data'] = $wallet_withdraw_encash_data;
                    $data['wallet_not_encash_data'] = $wallet_withdraw_not_encash_data;
                    $data['wallet_total_encash_data'] = $wallet_withdraw_total;



                    $data['student_data'] = $student_data['data'][0];
                    $data['message'] = "";

                    $data['sub_title'] = 'Student Account Management';
                    //        dev_export($data);die;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('student_account/student_account', $data, TRUE)));
                    return true;
                } else {
                    //            $data['details_data'] = NULL;
                    //            echo json_encode(array('status' => 2, 'message' => 'Student data is not available.'));
                    //            return true;

                    $this->load->view(ERROR_500);
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function show_fees_release()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            if (isset($student_id) && !empty($student_id)) {
                //        $data['template'] = '';
                $data['title'] = 'STUDENT PROFILE';
                $data['sub_title'] = 'Student Profile';
                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'title' => 'Registration Management',
                        'link' => base_url('profile/show-profile')
                    ),
                    '2' => array(
                        'title' => 'Student Profile'
                    )
                );
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);
                $data['user_name'] = $this->session->userdata('user_name');
                $student_data = $this->MRegistration->get_profiles_student($student_id);
                if ($student_data['error_status'] == 0 && $student_data['data_status'] == 1) {
                    $data['student_data'] = $student_data['data'][0];
                    $data['message'] = "";
                } else {
                    $data['student_data'] = FALSE;
                    $data['message'] = $student_data['message'];
                }
                $this->load->view('longabsentee/release_longabsentee', $data);
            }
        }
    }

    public function show_absentee()
    {
        $data['template'] = 'longabsentee/show_absentee';
        $data['title'] = 'Long Absentee';
        $data['sub_title'] = 'Long Absentee';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Student Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Long Absentee'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $details_data = $this->MRegistration->get_longabsentlist();

        if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
            $data['details_data'] = $details_data['data'];
            $data['message'] = "";
        } else {
            $data['details_data'] = FALSE;
            $data['message'] = $details_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['city_data']) && !empty($data['city_data'])) {
                foreach ($data['city_data'] as $city) {
                    $city_status = "";
                    if ($city['isactive'] == 1) {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    } else {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_city(\'' . $city['city_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $city['city_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>';
                    $formatted_data[] = array($city['city_name'], $city['city_abbr'], $city['state_name'], $city_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('template/home_template', $data);
        }
    }

    public function search_filter()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Language Management', 'status' => 0, 'link' => base_url('language/show-language')),
                2 => array('message' => 'Add New Language', 'status' => 1)
            );

            $data['panel_sub_header'] = 'Student Data Filter/Search';
            $data['breadcrumb'] = $breadcrumb;
            $data['title'] = 'Student Data Filter/Search';
            $this->session->set_userdata('current_page', 'registration');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('tc/search_filter', $data);
            } else {

                $this->form_validation->set_rules('language_name', 'Language Name', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data_prep['language_name'] = filter_input(INPUT_POST, 'language_name', FILTER_SANITIZE_STRING);
                    $data_prep['language_name'] = strtoupper($data_prep['language_name']);
                    $status = $this->MLanguage->save_language($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['language_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['language_name'] = filter_input(INPUT_POST, 'language_name', FILTER_SANITIZE_STRING);

                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('tc/search_filter', $data, TRUE)));
                        return;
                    }
                } else {
                    $data['language_name'] = filter_input(INPUT_POST, 'language_name', FILTER_SANITIZE_STRING);

                    echo json_encode(array('status' => 2, 'view' => $this->load->view('tc/search_filter', $data, TRUE)));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    //**Rahul file Ends**//
    public function password_check($str)
    {
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
            return TRUE;
        }
        return FALSE;
    }

    public function promotion()
    {
        $data['template'] = 'registration/promotion';
        $data['title'] = 'Promotion';
        $data['sub_title'] = 'TC Issue';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Student Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => ' Promotion'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $city_data = $this->MRegistration->get_all_city_list();
        if ($city_data['error_status'] == 0 && $city_data['data_status'] == 1) {
            $data['city_data'] = $city_data['data'];
            $data['message'] = "";
        } else {
            $data['city_data'] = FALSE;
            $data['message'] = $city_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['city_data']) && !empty($data['city_data'])) {
                foreach ($data['city_data'] as $city) {
                    $city_status = "";
                    if ($city['isactive'] == 1) {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    } else {
                        $city_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $city['city_id'] . '\',\'' . $city['city_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_city(\'' . $city['city_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $city['city_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>';
                    $formatted_data[] = array($city['city_name'], $city['city_abbr'], $city['state_name'], $city_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('template/home_template', $data);
        }
    }

    //    public function search_byname() {                                               //display students list on search
    //$data['user_name'] = $this->session->userdata('user_name');
    //if ($this->input->is_ajax_request() == 1) {
    //    $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
    //    $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
    //    $details_data = $this->MSales->student_search($data_prep);
    //    if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
    //        $data['details_data'] = $details_data['data'];
    //        $data['message'] = "";
    //    } else {
    //        $data['details_data'] = FALSE;
    //        $data['message'] = $details_data['message'];
    //    }
    //    $data['user_name'] = $this->session->userdata('user_name');
    //    echo json_encode(array('status' => 1, 'view' => $this->load->view('bill/profile_search_result', $data, TRUE)));
    //    return TRUE;
    //} else {
    //    $this->load->view(ERROR_500);
    //}
    //    }

    public function show_class_category()
    {
        $data['template'] = 'registration/student_filter_for_profile';
        //$data['template'] = 'registration/student_filter';
        $data['title'] = 'STUDENT PROFILE';
        $data['sub_title'] = 'STUDENT PROFILE';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Registration Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);
        $acdyear_id = filter_input(INPUT_POST, 'acdyear_id', FILTER_SANITIZE_NUMBER_INT);

        //CLASS DATA
        $class_data = $this->MStudent->get_all_class_list();
        if ($class_data['error_status'] == 0 && $class_data['data_status'] == 1) {
            $data['class_data'] = $class_data['data'];
            $data['message'] = "";
        } else {
            $data['class_data'] = FALSE;
            $data['message'] = $class_data['message'];
        }
        //PRELOADED BATCH DATA WITH CURRENT ACD YEAR 
        $batch = $this->MStudent->get_preload_batch_data();
        if ($batch['error_status'] == 0 && $batch['data_status'] == 1) {
            $data['batch_data'] = $batch['data'];
            $data['message'] = "";
        } else {
            $data['batch_data'] = FALSE;
            $data['message'] = $batch['message'];
        }
        //ACD YEAR DATA
        $acd_year = $this->MStudent->get_all_acd_year();
        if ($acd_year['error_status'] == 0 && $acd_year['data_status'] == 1) {
            $data['acdyear_data'] = $acd_year['data'];
            $data['message'] = "";
        } else {
            $data['acdyear_data'] = FALSE;
            $data['message'] = $acd_year['message'];
        }

        if ($onload == 1) {
            //BATCH DATA ON CHANGE
            $batch_data = $this->MStudent->get_all_batchdata($courseid, $acdyear_id);
            if (isset($batch_data['error_status']) && $batch_data['error_status'] == 0) {
                if ($batch_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $batch_data['data']));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
        $this->load->view('template/home_template', $data);


        //
        //ACD YEAR DATA
        //$acdyr = $this->MRegistration->get_all_acadyr();
        //
        //if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
        //    if ($acdyr['data_status'] == 1) {
        //        $data['acdyr_data'] = $acdyr['data'];
        //    } else {
        //        $data['acdyr_data'] = FALSE;
        //    }
        //} else {
        //    $data['acdyr_data'] = FALSE;
        //}
        //$data['acdyr_data'] = $acdyr['data'];
        //
        //$batch_data = $this->MRegistration->get_batch_details_for_filter($this->session->userdata('acd_year'));
        //
        //if (isset($batch_data['data']) && !empty($batch_data['data'])) {
        //    $data['batch_data'] = $batch_data['data'];
        //} else {
        //    $data['batch_data'] = NULL;
        //}
        //$batch_count = $this->MRegistration->no_batch_count($this->session->userdata('acd_year'));
        //if (isset($batch_count['data']) && !empty($batch_count['data'])) {
        //    $data['batch_count_no_batch'] = $batch_count['data'][0]['counts'];
        //} else {
        //    $data['batch_count_no_batch'] = 0;
        //}
        //dev_export($batch_data);
        //die;
        //$this->load->view('template/home_template', $data);
    }

    //create function for sponsered_students by vinoth @ 26-06-2019 12:46

    public function show_class_category_for_sponserd_stud()
    {
        $data['template'] = 'sponserd_stud/stud_filter_for_sponsered_profile';
        //$data['template'] = 'registration/student_filter';
        $data['title'] = 'SPONSORED STUDENTS';
        $data['sub_title'] = 'SPONSORED STUDENTS';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Registration Management',
                'link' => base_url('school/home')
            ),
            '2' => array(
                'title' => 'Sponsored Students'
            ),
            '3' => array(
                'title' => 'Batch'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);
        $acdyear_id = filter_input(INPUT_POST, 'acdyear_id', FILTER_SANITIZE_NUMBER_INT);

        //CLASS DATA
        $class_data = $this->MStudent->get_all_class_list();
        if ($class_data['error_status'] == 0 && $class_data['data_status'] == 1) {
            $data['class_data'] = $class_data['data'];
            $data['message'] = "";
        } else {
            $data['class_data'] = FALSE;
            $data['message'] = $class_data['message'];
        }
        //PRELOADED BATCH DATA WITH CURRENT ACD YEAR 
        $batch = $this->MStudent->get_preload_batch_data();
        if ($batch['error_status'] == 0 && $batch['data_status'] == 1) {
            $data['batch_data'] = $batch['data'];
            $data['message'] = "";
        } else {
            $data['batch_data'] = FALSE;
            $data['message'] = $batch['message'];
        }
        //ACD YEAR DATA
        $acd_year = $this->MStudent->get_all_acd_year();
        if ($acd_year['error_status'] == 0 && $acd_year['data_status'] == 1) {
            $data['acdyear_data'] = $acd_year['data'];
            $data['message'] = "";
        } else {
            $data['acdyear_data'] = FALSE;
            $data['message'] = $acd_year['message'];
        }

        if ($onload == 1) {
            //BATCH DATA ON CHANGE
            $batch_data = $this->MStudent->get_all_batchdata($courseid, $acdyear_id);
            if (isset($batch_data['error_status']) && $batch_data['error_status'] == 0) {
                if ($batch_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $batch_data['data']));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
        $this->load->view('template/home_template', $data);
    }

    public function advanced_filter_search()
    {
        $data['sub_title'] = 'Employee Search';
        $data['user_name'] = $this->session->userdata('user_name');
        $this->session->set_userdata('current_page', 'itemtype');
        $this->session->set_userdata('current_parent', 'gen_sett');

        //STREAM DATA
        $stream = $this->MRegistration->get_all_stream();
        if (isset($stream['error_status']) && $stream['error_status'] == 0) {
            if ($stream['data_status'] == 1) {
                $data['stream_data'] = $stream['data'];
            } else {
                $data['stream_data'] = FALSE;
            }
        } else {
            $data['stream_data'] = FALSE;
        }
        $data['stream_data'] = $stream['data'];

        //CLASS DATA
        $class = $this->MRegistration->get_all_class();
        //dev_export($class);die;
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data_for_registration'] = $class['data'];
            } else {
                $data['class_data_for_registration'] = FALSE;
            }
        } else {
            $data['class_data_for_registration'] = FALSE;
        }
        //ACD YEAR DATA
        $acdyr = $this->MRegistration->get_all_acadyr();
        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
            if ($acdyr['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }
        $batch = $this->MRegistration->get_all_batch($this->session->userdata('acd_year'));
        //dev_export($class);die;
        if (isset($batch['error_status']) && $batch['error_status'] == 0) {
            if ($batch['data_status'] == 1) {
                $data['batch_data'] = $batch['data'];
            } else {
                $data['batch_data'] = FALSE;
            }
        } else {
            $data['batch_data'] = FALSE;
        }
        //
        $this->load->view('student_profile/student_advanced_search', $data);
    }

    public function search_parent()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Registration Management', 'status' => 0, 'link' => base_url('registration/add-registration')),
                2 => array('message' => ' Search student', 'status' => 1)
            );
            $data['title'] = 'STUDENT SEARCH ';
            $data['panel_sub_header'] = 'Student Search';
            $data['breadcrumb'] = $breadcrumb;

            if ($onload == 1) {
                $this->load->view('registration/parent_search', $data);
            } else {
                $this->form_validation->set_rules('phn', 'Mobile No', 'trim');
                $this->form_validation->set_rules('email', 'E-mail ', 'trim');
                $this->form_validation->set_rules('first_name', 'Student Name', 'trim');
                $this->form_validation->set_rules('admn_no_for_parent_search', 'Admission Number', 'trim');
                $this->form_validation->set_rules('pname', 'Parent Name', 'trim');
                $this->form_validation->set_rules('flag', 'Match', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data_prep['phn'] = strtoupper(filter_input(INPUT_POST, 'phn', FILTER_SANITIZE_STRING));
                    $data_prep['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                    $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
                    $data_prep['admn_no_for_parent_search'] = strtoupper(filter_input(INPUT_POST, 'admn_no_for_parent_search', FILTER_SANITIZE_STRING));
                    $data_prep['pname'] = strtoupper(filter_input(INPUT_POST, 'pname', FILTER_SANITIZE_STRING));
                    $data_prep['flag'] = strtoupper(filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_STRING));
                    $search_status = $this->MStudent->parent_search_new($data_prep);
                    //            dev_export($search_status);die;
                    if ($search_status['error_status'] == 0 && $search_status['data_status'] == 1) {
                        $data['search_status'] = $search_status['data'];
                        $data['message'] = "";
                    } else {
                        $data['search_status'] = FALSE;
                        $data['message'] = $search_status['message'];
                    }
                    $data['phn'] = $data_prep['phn'];
                    $data['email'] = $data_prep['email'];
                    $data['first_name'] = $data_prep['first_name'];
                    $data['admn_no_for_parent_search'] = $data_prep['admn_no_for_parent_search'];
                    $data['pname'] = $data_prep['pname'];
                    $data['flag'] = $data_prep['flag'];
                    $this->load->view('registration/parent_search', $data);
                    //              dev_export($search_status);die;  
                } else {
                    $data['phn'] = strtoupper(filter_input(INPUT_POST, 'phn', FILTER_SANITIZE_STRING));
                    $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                    $data['first_name'] = strtoupper(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
                    $data['admn_no_for_parent_search'] = strtoupper(filter_input(INPUT_POST, 'admn_no_for_parent_search', FILTER_SANITIZE_STRING));
                    $data['pname'] = strtoupper(filter_input(INPUT_POST, 'pname', FILTER_SANITIZE_STRING));
                    $data['flag'] = strtoupper(filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_STRING));
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('registration/parent_search', $data, TRUE)));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function pass_stdid()
    {                                                          //to get parent details from students id
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            //    $Student_id = filter_input(INPUT_POST, 'Student_id', FILTER_SANITIZE_NUMBER_INT);
            $student_id = filter_input(INPUT_POST, 'Student_id', FILTER_SANITIZE_NUMBER_INT);
            //    dev_export($student_id);  die;

            if (isset($student_id) && !empty($student_id)) {
                $parent_address = $this->MRegistration->get_parentaddress_details($student_id);
                //        dev_export($parent_address['data'][0]);die;
                if (isset($parent_address['error_status']) && $parent_address['error_status'] == 0) {
                    if ($parent_address['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'parent_data' => $parent_address['data'][0]));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0));
                        return true;
                    }
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    //    public function admindate_valitdation() {
    //$admission_date = strtoupper(filter_input(INPUT_POST, 'admission_date', FILTER_SANITIZE_STRING));
    //$toyear = strtoupper(filter_input(INPUT_POST, 'toyear', FILTER_SANITIZE_STRING));
    //$fromyear = strtoupper(filter_input(INPUT_POST, 'fromyear', FILTER_SANITIZE_STRING));
    //$admndate_raw = (explode("-", $admission_date));
    //$admndate = $admndate_raw[2];
    //$admn_month = $admndate_raw[1];
    //$a = $toyear - $admndate;
    //$b = $fromyear - $admndate;
    //if (($a == 1 || $a == 0) && ($b == 0 || $b == -1)) {
    //    if ($a == 0 && $b == -1) {
    //        if ($admn_month <= 3) {
    //            echo json_encode('true');
    //            return true;
    //        } else {
    //            echo json_encode(array('Please choose a date between the given academic year.'));
    //            return true;
    //        }
    //    } else {
    //        echo json_encode('true');
    //        return true;
    //    }
    //} else {
    //    echo json_encode(array('Please choose a date between the given academic year.'));
    //    return true;
    //}
    //    }

    public function admindate_valitdation_custom()
    {
        $admission_date = strtoupper(filter_input(INPUT_POST, 'admission_date', FILTER_SANITIZE_STRING));
        $toyear = strtoupper(filter_input(INPUT_POST, 'toyear', FILTER_SANITIZE_STRING));
        $fromyear = strtoupper(filter_input(INPUT_POST, 'fromyear', FILTER_SANITIZE_STRING));
        $admndate_raw = (explode("-", $admission_date));
        $admndate = $admndate_raw[2];
        $admn_month = $admndate_raw[1];
        $a = $toyear - $admndate;
        $b = $fromyear - $admndate;
        if (($a == 1 || $a == 0) && ($b == 0 || $b == -1)) {
            if ($a == 0 && $b == -1) {
                if ($admn_month <= 3) {
                    echo json_encode(array('status' => 1));
                    return true;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Please choose a date between the given academic year.'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 1));
                return true;
            }
        } else {
            echo json_encode(array('status' => 2, 'message' => 'Please choose a date between the given academic year.'));
            return true;
        }
    }

    public function dropdown_valitdation()
    {
        $dropdown = strtoupper(filter_input(INPUT_POST, 'dropdown', FILTER_SANITIZE_STRING));
        //dev_export($dropdown);die;
        if (($dropdown == -1)) {
            echo json_encode(array('Select any option.'));
        } else {
            echo json_encode('true');
        }
    }

    public function student_filter()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');


        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);

        $data['acd_year'] = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
        $data_prep['acy_yr'] = filter_input(INPUT_POST, 'acd_year', FILTER_SANITIZE_NUMBER_INT);
        $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'studentname', FILTER_SANITIZE_STRING));
        $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'adminno', FILTER_SANITIZE_STRING));
        $data_prep['pname'] = strtoupper(filter_input(INPUT_POST, 'parent_name', FILTER_SANITIZE_STRING));
        $data_prep['phn'] = strtoupper(filter_input(INPUT_POST, 'mobileno', FILTER_SANITIZE_STRING));
        $data_prep['email'] = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
        $data_prep['class_id'] = strtoupper(filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_STRING));
        $data_prep['flag'] = 5;

        $breadcrumb = array(
            0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
            1 => array('message' => 'Registration Management', 'status' => 0, 'link' => base_url('')),
            2 => array('message' => ' Search student', 'status' => 1)
        );


        $data['title'] = 'STUDENT SEARCH ';

        $data['panel_sub_header'] = 'Student Search';
        $data['breadcrumb'] = $breadcrumb;
        $this->session->set_userdata('current_page', 'registration');
        $this->session->set_userdata('current_parent', 'student_settings');

        $class = $this->MRegistration->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
        } else {
            $data['class_data'] = FALSE;
        }
        if ($onload == 1) {
            $this->load->view('student_profile/search_filter', $data);
        } else {
            $details_data = $this->MStudent->parent_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['user_name'] = $this->session->userdata('user_name');

            echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/profile_search_result', $data, TRUE)));
            return TRUE;
        }
    }

    public function search_byname()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['acy_yr'] = filter_input(INPUT_POST, 'acdyr_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            $data_prep['flag'] = 5;
            $batchid = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);

            if ($batchid == -1) {
                $data_prep['batch_id'] = 0;
            } else {
                $data_prep['batch_id'] = $batchid;
            }
            $details_data = $this->MStudent->parent_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
                //Condition change by Vinoth kumar K @ 09-05-2019 11:30
                $data['batchid'] = $batchid;
                $data['acdyr_id'] = $data_prep['acy_yr'];
                $data['batch_id'] = $data_prep['batch_id'];
                $data['user_name'] = $this->session->userdata('user_name');

                echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/profile_search_result', $data, TRUE)));
                return TRUE;
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
                echo json_encode(array('status' => 0));
                return TRUE;
            }
            //    $data['batchid'] = $batchid;
            //    $data['acdyr_id'] = $data_prep['acy_yr'];
            //    $data['batch_id'] = $data_prep['batch_id'];
            //    $data['user_name'] = $this->session->userdata('user_name');
            //
            //    echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/profile_search_result', $data, TRUE)));
            //    return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_student_by_name_or_admission()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['searchdata'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            $data_prep['flag'] = 5;
            $batchid = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);

            if ($batchid == -1) {
                $data_prep['batch_id'] = 0;
            } else {
                $data_prep['batch_id'] = $batchid;
            }
            $data_prep['acdyr_id'] = $this->session->userdata('acd_year');
            $data_prep['inst_id'] = $this->session->userdata('inst_id');
            $details_data = $this->MRegistration->get_student_by_name_or_admission($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['batchid'] = $batchid;
            $data['batch_id'] = $batchid;
            $data['acdyr_id'] = $this->session->userdata('acd_year');

            if (isset($details_data['data']) && !empty($details_data['data'])) {

                $data['title'] = 'STUDENT PROFILE';
                $data['sub_title'] = 'STUDENT PROFILE';
                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'title' => 'Registration Management',
                        'link' => base_url('profile/show-class-for-students'),
                    ),
                    '2' => array(
                        'title' => 'Students'
                    )
                );
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);


                echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/profile_search_result', $data, TRUE)));
                return TRUE;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data available'));
                return TRUE;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function search_byname_for_profile()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchdata', FILTER_SANITIZE_STRING));
            $data_prep['flag'] = 5;
            $batchid = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);

            if ($batchid == -1) {
                $data_prep['batch_id'] = 0;
            } else {
                $data_prep['batch_id'] = $batchid;
            }
            $details_data = $this->MRegistration->get_student_by_admission_no($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['batchid'] = $batchid;
            $data['acdyr_id'] = $this->session->userdata('acd_year');

            if (isset($details_data['data']) && !empty($details_data['data'])) {

                $data['title'] = 'STUDENT PROFILE';
                $data['sub_title'] = 'STUDENT PROFILE';
                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'title' => 'Registration Management',
                        'link' => base_url('profile/show-class-for-students'),
                    ),
                    '2' => array(
                        'title' => 'Students'
                    )
                );
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);


                echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/profile_search_result_admn_no', $data, TRUE)));
                return TRUE;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data available'));
                return TRUE;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    //create search_byadmnno_for_sponsered_stud function by vinoth @30-05-2019 11:53
    public function search_byadmnno_for_sponsered_stud()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchdata', FILTER_SANITIZE_STRING));
            $data_prep['flag'] = 5;
            $batchid = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);

            if ($batchid == -1) {
                $data_prep['batch_id'] = 0;
            } else {
                $data_prep['batch_id'] = $batchid;
            }
            $details_data = $this->MRegistration->get_student_by_admission_no($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['batchid'] = $batchid;
            $data['acdyr_id'] = $this->session->userdata('acd_year');

            if (isset($details_data['data']) && !empty($details_data['data'])) {

                $data['title'] = 'SPONSORED STUDENTS';
                $data['sub_title'] = 'SPONSORED STUDENTS';
                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'title' => 'Sponsored Students',
                        'link' => base_url('profile/show-class-for-students'),
                    ),
                    '2' => array(
                        'title' => 'Students'
                    )
                );
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);


                echo json_encode(array('status' => 1, 'view' => $this->load->view('sponserd_stud/sponsered_stud_search_admn_no', $data, TRUE)));
                return TRUE;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data available'));
                return TRUE;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    //create function by vinoth @30-05-2019 11:53
    public function search_byname_withoutbatch()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'searchdata', FILTER_SANITIZE_STRING));
            $data_prep['flag'] = 5;
            $batchid = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);

            if ($batchid == -1) {
                $data_prep['batch_id'] = 0;
            } else {
                $data_prep['batch_id'] = $batchid;
            }
            $details_data = $this->MStudent->parent_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['batchid'] = $batchid;
            $data['acdyr_id'] = $this->session->userdata('acd_year');

            if (isset($details_data['data']) && !empty($details_data['data'])) {

                $data['title'] = 'STUDENT PROFILE';
                $data['sub_title'] = 'STUDENT PROFILE';
                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'title' => 'Registration Management',
                        'link' => base_url('profile/show-class-for-students'),
                    ),
                    '2' => array(
                        'title' => 'Students'
                    )
                );
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);


                echo json_encode(array('status' => 1, 'view' => $this->load->view('student_profile/profile_search_result_admn_no', $data, TRUE)));
                return TRUE;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data available'));
                return TRUE;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }


    //create search_byname_for_sponsered_stud function by vinoth @26-06-2019 14:23
    public function search_byname_for_sponsered_stud()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['first_name'] = strtoupper(filter_input(INPUT_POST, 'searchdata', FILTER_SANITIZE_STRING));
            $data_prep['flag'] = 5;
            $batchid = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);

            if ($batchid == -1) {
                $data_prep['batch_id'] = 0;
            } else {
                $data_prep['batch_id'] = $batchid;
            }
            $details_data = $this->MStudent->parent_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }

            $data['batchid'] = $batchid;
            $data['acdyr_id'] = $this->session->userdata('acd_year');

            if (isset($details_data['data']) && !empty($details_data['data'])) {

                $data['title'] = 'SPONSORED STUDENTS';
                $data['sub_title'] = 'SPONSORED STUDENTS';
                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'title' => 'Registration Management',
                        'link' => base_url('profile/show-class-for-students'),
                    ),
                    '2' => array(
                        'title' => 'Students'
                    )
                );
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);


                echo json_encode(array('status' => 1, 'view' => $this->load->view('sponserd_stud/sponsered_stud_search_admn_no', $data, TRUE)));
                return TRUE;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'No data available'));
                return TRUE;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    //    create function by vinoth k @20-05-2019 17:45

    public function search_siblings_admno()
    {
        if ($this->input->is_ajax_request() == 1) {
            $searchdata = filter_input(INPUT_POST, 'searchdata', FILTER_SANITIZE_STRING);
            $searchby = filter_input(INPUT_POST, 'searchby', FILTER_SANITIZE_STRING);
            $flag  = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);
            $data['title'] = 'FAMILY MEMBERS';
            $data['sub_title'] = 'FAMILY MEMBERS';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'title' => 'Registration Management'
                ),
                '2' => array(
                    'title' => 'Family Members'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            if (isset($searchdata) && !empty($searchdata)) {
                $data['user_name'] = $this->session->userdata('user_name');
                $sibilings_data = $this->MRegistration->get_sibilings_student_byadmno($searchdata, $searchby);
                if ($sibilings_data['error_status'] == 0 && $sibilings_data['data_status'] == 1) {
                    $data['sibilings_data'] = $sibilings_data['data'];
                    $data['searchdata'] = $searchdata;
                    $data['message'] = "";
                    $data['flag'] = $flag;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('siblings/show_siblings', $data, TRUE)));
                } else {
                    $data['sibilings_data'] = FALSE;
                    $data['message'] = $sibilings_data['message'];
                    echo json_encode(array('status' => 0));
                }
                //        $data_prep = array(
                //            'student_id' => $student_id
                //        );
            }
        }
    }

    public function search_uuid_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $uuid = filter_input(INPUT_POST, 'uuid', FILTER_SANITIZE_STRING);
            $uuid_name = filter_input(INPUT_POST, 'uuid_limit_name', FILTER_SANITIZE_STRING);
            if (strlen($uuid) < 3) {
                echo json_encode(array('status' => 2, 'message' => 'Atleaset 3 characters are required for a search'));
                return true;
            }
            $inst_id = $this->session->userdata('inst_id');
            if ($inst_id == 1 || $inst_id == 2 || $inst_id == 3 || $inst_id == 4 || $inst_id == 9) {
                $data['uuid_name'] =  'Emirates ID';
            } else {
                $data['uuid_name'] = $uuid_name;
            }
            $uuid_status_with_data = $this->MRegistration->get_uuid_data($uuid);
            if (isset($uuid_status_with_data['student_data']) && !empty($uuid_status_with_data['student_data'])) {
                $data['uuid_data'] = $uuid_status_with_data['student_data'];
                $data['uuid'] = $uuid;
                $already_taken_inst = 0;
                $already_taken_oth = 0;

                foreach ($uuid_status_with_data['student_data'] as $uuid_details) {
                    if (!empty($uuid_details['Inst_ID'])) {
                        if ($this->session->userdata('inst_id') == $uuid_details['Inst_ID'] && $uuid == $uuid_details['UUID_NO']  && $uuid_details['is_student'] == 1) {
                            $already_taken_inst = 1;
                        }
                        if ($this->session->userdata('inst_id') != $uuid_details['Inst_ID'] && $uuid == $uuid_details['UUID_NO']) {
                            $already_taken_oth = 1;
                        }
                        if ($this->session->userdata('inst_id') == $uuid_details['Inst_ID'] && $uuid == $uuid_details['UUID_NO'] && $uuid_details['is_student'] == 0) {
                            $already_taken_oth = 2;
                        }
                    }
                }

                if ($already_taken_inst == 1)
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('registration/uuid_data_ui', $data, TRUE)));
                else if ($already_taken_oth == 1)
                    echo json_encode(array('status' => 3, 'message' => 'This unique identity is already active in other institution.'));
                else if ($already_taken_oth == 2)
                    echo json_encode(array('status' => 4, 'message' => 'This unique identity is already taken for parents.'));
                else
                    echo json_encode(array('status' => 2, 'message' => 'There is no data associated with this ' . $data['uuid_name'] . '.'));
                return true;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'There is no data associated with this ' . $data['uuid_name'] . '.'));
                return true;
            }
            return true;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function search_f_uuid_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $uuid = filter_input(INPUT_POST, 'uuid', FILTER_SANITIZE_STRING);
            if (strlen($uuid) < 3) {
                echo json_encode(array('status' => 2, 'message' => 'Atleaset 5 characters are required for a search'));
                return true;
            }
            $uuid_status_with_data = $this->MRegistration->get_f_uuid_data($uuid);
            $inst_id = $this->session->userdata('inst_id');
            if ($inst_id == 1 || $inst_id == 2 || $inst_id == 3 || $inst_id == 4 || $inst_id == 9) {
                $data['uuid_name'] =  'Emirates ID';
            } else {
                $data['uuid_name'] = 'Aadhar Number';
            }
            //    dev_export($uuid_status_with_data);die;
            if (isset($uuid_status_with_data['student_data']) && !empty($uuid_status_with_data['student_data'])) {
                $data['uuid_data'] = $uuid_status_with_data['student_data'];
                $data['uuid'] = $uuid;
                echo json_encode(array('status' => 1, 'view' => $this->load->view('registration/uuid_data_ui', $data, TRUE)));
                return true;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'There is no data associated with this ' . $data['uuid_name'] . '.'));
                return true;
            }
            return true;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function search_m_uuid_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $uuid = filter_input(INPUT_POST, 'uuid', FILTER_SANITIZE_STRING);
            if (strlen($uuid) < 3) {
                echo json_encode(array('status' => 2, 'message' => 'Atleaset 5 characters are required for a search'));
                return true;
            }
            $uuid_status_with_data = $this->MRegistration->get_m_uuid_data($uuid);
            $inst_id = $this->session->userdata('inst_id');
            if ($inst_id == 1 || $inst_id == 2 || $inst_id == 3 || $inst_id == 4 || $inst_id == 9) {
                $data['uuid_name'] =  'Emirates ID';
            } else {
                $data['uuid_name'] = 'Aadhar Number';
            }
            //    dev_export($uuid_status_with_data);die;
            if (isset($uuid_status_with_data['student_data']) && !empty($uuid_status_with_data['student_data'])) {
                $data['uuid_data'] = $uuid_status_with_data['student_data'];
                $data['uuid'] = $uuid;
                echo json_encode(array('status' => 1, 'view' => $this->load->view('registration/uuid_data_ui', $data, TRUE)));
                return true;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'There is no data associated with this ' . $data['uuid_name'] . '.'));
                return true;
            }
            return true;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function search_g_uuid_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $uuid = filter_input(INPUT_POST, 'uuid', FILTER_SANITIZE_STRING);
            if (strlen($uuid) < 3) {
                echo json_encode(array('status' => 2, 'message' => 'Atleaset 5 characters are required for a search'));
                return true;
            }
            $uuid_status_with_data = $this->MRegistration->get_g_uuid_data($uuid);
            $inst_id = $this->session->userdata('inst_id');
            if ($inst_id == 1 || $inst_id == 2 || $inst_id == 3 || $inst_id == 4 || $inst_id == 9) {
                $data['uuid_name'] =  'Emirates ID';
            } else {
                $data['uuid_name'] = 'Aadhar Number';
            }
            //    dev_export($uuid_status_with_data);die;
            if (isset($uuid_status_with_data['student_data']) && !empty($uuid_status_with_data['student_data'])) {
                $data['uuid_data'] = $uuid_status_with_data['student_data'];
                $data['uuid'] = $uuid;
                echo json_encode(array('status' => 1, 'view' => $this->load->view('registration/uuid_data_ui', $data, TRUE)));
                return true;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'There is no data associated with this UUID.'));
                return true;
            }
            return true;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function show_siblings()
    {
        $data['template'] = 'siblings/show_siblings';
        $data['title'] = 'FAMILY MEMBERS';
        $data['sub_title'] = 'FAMILY MEMBERS';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Registration Management'
            ),
            '2' => array(
                'title' => 'Family Members'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $this->load->view('template/home_template', $data);
    }

    public function fill_new_details()
    {
        $studentid = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
        $profile_details = $this->MRegistration->get_registration_details($studentid);
        //        dev_export($profile_details);die;
        if (isset($profile_details['data_status']) && !empty($profile_details['data_status'])) {
            //Data to be loaded
            $kl_data_array = [];
            $data['profile_details'] = $profile_details['data'];
            foreach ($data['profile_details']['language_known'] as $kl_data) {
                $kl_data_array[] = $kl_data['language_id'];
            }
            $data['profile_details']['language_known'] = $kl_data_array;
            echo json_encode($data);
            return true;
        } else {
            echo json_encode(array('Data Loading Error.'));
            return true;
        }
    }
    public function load_staff_conc()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['Empgender'] = filter_input(INPUT_POST, 'Empgender', FILTER_SANITIZE_STRING);
            $data['emp_id'] = filter_input(INPUT_POST, 'emp_id', FILTER_SANITIZE_NUMBER_INT);
            $data['emp_inst_id'] = filter_input(INPUT_POST, 'emp_inst_id', FILTER_SANITIZE_NUMBER_INT);
        }
        $institution_list = $this->MRegistration->get_institution_list();
        //dev_export($institution_list);
        if (isset($institution_list['error_status']) && $institution_list['error_status'] == 0) {
            if ($institution_list['data_status'] == 1) {
                $data['institution_list_data'] = $institution_list['data'];
            } else {
                $data['institution_list_data'] = FALSE;
            }
        } else {
            $data['institution_list_data'] = FALSE;
        }
        $data['institution_list_data'] = $institution_list['data'];
        $this->load->view('registration/reg_partial_staff_conc_details', $data);
    }
    public function load_staff_conc_sibling()
    {
        $aadharno = filter_input(INPUT_POST, 'aadharno', FILTER_SANITIZE_NUMBER_INT);
        $inst_id = filter_input(INPUT_POST, 'inst_id', FILTER_SANITIZE_NUMBER_INT);
        $sibling_list = $this->MRegistration->get_staff_sibling_list($aadharno, $inst_id);
        if (isset($sibling_list['error_status']) && $sibling_list['error_status'] == 0) {
            if ($sibling_list['data_status'] == 1) {
                $data['sibilings_data'] = $sibling_list['data'];
                $data['raw_data'] = $sibling_list['data'];
            } else {
                $data['sibilings_data'] = FALSE;
                $data['raw_data'] = $sibling_list['data'];
            }
        } else {
            $data['sibilings_data'] = FALSE;
            $data['raw_data'] = $sibling_list['data'];
        }

        $newsiblingArr = array();
        $sibl_stud_id = '';
        foreach ($data['raw_data'] as $row) {
            $sibl_stud_id = $row['Student_id'];
        }
        foreach ($data['raw_data'] as $row) {
            $newsiblingArr[] = array(
                'Gender' => $row['Gender'],
                'Address_Type' => $row['Address_Type'],
                'Address1' => $row['Address1'],
                'Address2' => $row['Address2'],
                'Address3' => $row['Address3'],
                'Email' => $row['Email'],
                'PO_No' => $row['PO_No'],
                'Phone1' => $row['Phone1'],
                'Phone3' => $row['Phone3'],
                'Profession' => $row['Profession'],
                'Parent_Name' => $row['Parent_Name'],
                'Adhar_No' => $row['Adhar_No'],
                'Father_Id' => $row['Father_Id'],
                'Mother_Id' => $row['Mother_Id'],
                'sibling_stud_id' => $sibl_stud_id
            );
        }

        $sibilings_data = array_map("unserialize", array_unique(array_map("serialize", $newsiblingArr)));
        echo json_encode(array('status' => 1, 'raw_data' => $sibilings_data, 'view' => $this->load->view('registration/staff_siblings_view', $data, TRUE)));
    }

    public function get_batch_by_academic_year()
    {
        $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
        $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_NUMBER_INT);
        $acdyear_id = filter_input(INPUT_POST, 'acdyear_id', FILTER_SANITIZE_NUMBER_INT);
        if ($onload == 1) {
            //BATCH DATA ON CHANGE
            $batch_data = $this->MStudent->get_all_batchdata($courseid, $acdyear_id);
            if (isset($batch_data['error_status']) && $batch_data['error_status'] == 0) {
                if ($batch_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $batch_data['data']));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }


    // public function f_adhar_validation()
    // {

    //     $unique_identity = filter_input(INPUT_POST, 'f_unique_identity', FILTER_SANITIZE_NUMBER_INT);
    //     $studentid = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
    //     $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);
    //     if (!isset($flag) && empty($flag)) {
    //         $flag = 1;
    //         if ($studentid == 0) {
    //             $flag = 0;
    //         }
    //     }
    //     //dev_export($unique_identity);
    //     //dev_export($studentid);
    //     //dev_export($flag);die;
    //     $status = $this->MRegistration->get_unique_identity($unique_identity, $studentid, $flag);

    //     if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
    //         echo json_encode('true');
    //         return true;
    //     } else {
    //         $inst_id = $this->session->userdata('inst_id');
    //         if ($inst_id == 4) {
    //             $uuid_name = 'Emirates ID';
    //         } else {
    //             $uuid_name = 'Aadhar Number';
    //         }
    //         echo json_encode(array($uuid_name . ' already exist.'));
    //         return true;
    //     }
    // }
    // public function m_adhar_validation()
    // {

    //     $unique_identity = filter_input(INPUT_POST, 'm_unique_identity', FILTER_SANITIZE_NUMBER_INT);
    //     $studentid = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
    //     $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);
    //     if (!isset($flag) && empty($flag)) {
    //         $flag = 1;
    //         if ($studentid == 0) {
    //             $flag = 0;
    //         }
    //     }
    //     // dev_export($unique_identity);
    //     //dev_export($studentid);
    //     //dev_export($flag);die;
    //     $status = $this->MRegistration->get_unique_identity($unique_identity, $studentid, $flag);

    //     if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
    //         echo json_encode('true');
    //         return true;
    //     } else {
    //         $inst_id = $this->session->userdata('inst_id');
    //         if ($inst_id == 4) {
    //             $uuid_name = 'Emirates ID';
    //         } else {
    //             $uuid_name = 'Aadhar Number';
    //         }
    //         echo json_encode(array($uuid_name . ' already exist.'));
    //         return true;
    //     }
    // }

    // public function g_adhar_validation()
    // {

    //     $unique_identity = filter_input(INPUT_POST, 'g_unique_identity', FILTER_SANITIZE_NUMBER_INT);
    //     $studentid = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
    //     $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);
    //     if (!isset($flag) && empty($flag)) {
    //         $flag = 1;
    //         if ($studentid == 0) {
    //             $flag = 0;
    //         }
    //     }
    //     // dev_export($unique_identity);
    //     //dev_export($studentid);
    //     //dev_export($flag);die;
    //     $status = $this->MRegistration->get_unique_identity($unique_identity, $studentid, $flag);

    //     if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
    //         echo json_encode('true');
    //         return true;
    //     } else {
    //         $inst_id = $this->session->userdata('inst_id');
    //         if ($inst_id == 4) {
    //             $uuid_name = 'Emirates ID';
    //         } else {
    //             $uuid_name = 'Aadhar Number';
    //         }
    //         echo json_encode(array($uuid_name . ' already exist.'));
    //         return true;
    //     }
    // }
}
