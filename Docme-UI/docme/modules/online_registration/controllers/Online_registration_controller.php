<?php

/**
 * Description of Online_registration_controller
 *
 * @author Fathima Shamna
 * On 26.10.2019
 * For Online Registration
 */
class Online_registration_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Online_registration_model', 'ONRegistration');
        $this->load->model('student_settings/Registration_model', 'MRegistration');
        $this->load->model('general_settings/City_model', 'MCity');
    }

    public function online_reg()
    {

        $data['template'] = 'registration/show_temp_registration';


        // dev_export($this->session->userdata());exit;
        //      Student data
        $inst_id = base64_decode($this->input->get('c2Nob29sX2lk'));  //school_id
        if (!in_array($inst_id, array(1, 2, 3, 4, 5, 8, 9, 20))) {
            redirect('not-found');
            exit();
        }

        if ($this->session->userdata('API-Key') == '' || $inst_id != $this->session->userdata('inst_id')) {
            //$this->session->set_userdata('API-Key', $api_key); //
            $this->session->set_userdata('inst_id', $inst_id);
            $apiKEYS = $this->ONRegistration->get_all_api_keys($inst_id);
            if (isset($apiKEYS['error_status']) && $apiKEYS['error_status'] == 0) {
                if ($apiKEYS['data_status'] == 1) {
                    $api_key_data = $apiKEYS['data'];
                } else {
                    $api_key_data = FALSE;
                }
            } else {
                $api_key_data = FALSE;
            }
            $api_key = $api_key_data['api_key'];

            $this->session->set_userdata('API-Key', $api_key); //
            //All apikeys
        }

        //COUNTRY DATA
        $country = $this->ONRegistration->get_all_country();
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
        $relegion = $this->ONRegistration->get_all_relegion();
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
        $community = $this->ONRegistration->get_all_community();
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
        $language = $this->ONRegistration->get_all_language_list();
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
        $profession = $this->ONRegistration->get_all_profession_list();

        if (isset($profession['error_status']) && $profession['error_status'] == 0) {
            if ($profession['data_status'] == 1) {
                $data['profession_data'] = $profession['data'];
                $data['mprofession_data'] = $profession['data'];
                $data['gprofession_data'] = $profession['data'];
            } else {
                $data['profession_data'] = FALSE;
                $data['mprofession_data'] = FALSE;
                $data['gprofession_data'] = FALSE;
            }
        } else {
            $data['profession_data'] = FALSE;
            $data['mprofession_data'] = FALSE;
            $data['gprofession_data'] = FALSE;
        }
        //ACD YEAR DATA
        $acdyr = $this->ONRegistration->get_all_acadyr();
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

        //PrevACyear data
        $prev_acdyr = $this->ONRegistration->get_all_prev_acadyr();
        if (isset($prev_acdyr['error_status']) && $prev_acdyr['error_status'] == 0) {
            if ($prev_acdyr['data_status'] == 1) {
                $data['prev_acdyr_data'] = $acdyr['data'];
            } else {
                $data['prev_acdyr_data'] = FALSE;
            }
        } else {
            $data['prev_acdyr_data'] = FALSE;
        }
        $data['prev_acdyr_data'] = $prev_acdyr['data'];

        //STREAM DATA
        $stream = $this->ONRegistration->get_all_stream();
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
        $class = $this->ONRegistration->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data_for_registration'] = $class['data'];
            } else {
                $data['class_data_for_registration'] = FALSE;
            }
        } else {
            $data['class_data_for_registration'] = FALSE;
        }
        //PICKUP POINTS DATA
        $pickup_point = $this->ONRegistration->pickup_point($inst_id);
        if (isset($pickup_point['error_status']) && $pickup_point['error_status'] == 0) {
            if ($pickup_point['data_status'] == 1) {
                $data['pickup_point'] = $pickup_point['data'];
            } else {
                $data['pickup_point'] = FALSE;
            }
        } else {
            $data['pickup_point'] = FALSE;
        }

        //REG DATE DATA
        $reg_date_data = $this->ONRegistration->select_reg_date_data();
        if (isset($reg_date_data['error_status']) && $reg_date_data['error_status'] == 0) {
            if ($reg_date_data['data_status'] == 1) {
                $data['reg_date_data'] = $reg_date_data['data'];
            } else {
                $data['reg_date_data'] = [];
            }
        } else {
            $data['reg_date_data'] = [];
        }
        $institution_list = $this->MRegistration->get_institution_list();
        if (isset($institution_list['error_status']) && $institution_list['error_status'] == 0) {
            if ($institution_list['data_status'] == 1) {
                $data['institution_list_data'] = $institution_list['data'];
            } else {
                $data['institution_list_data'] = FALSE;
            }
        } else {
            $data['institution_list_data'] = FALSE;
        }

        $inst_id = $this->session->userdata('inst_id');

        if ($inst_id == 2) {
            $data['shj_display'] = "";
        } else {
            $data['shj_display'] = "display:none";
        }

        if ($inst_id == 1 || $inst_id == 2 || $inst_id == 3 || $inst_id == 4 || $inst_id == 9) {
            $data['uuid_unit_limit'] = 15;
        } else {
            $data['uuid_unit_limit'] = 12;
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $sys_parameter = $this->ONRegistration->get_system_parameters();
        $data['sys_parameters'] = $sys_parameter['data'];

        $this->load->view('template/online_reg_template', $data);
    }

    public function save_temp_registration()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'studentid', FILTER_SANITIZE_NUMBER_INT);
            $update_profile = filter_input(INPUT_POST, 'update_profile', FILTER_SANITIZE_NUMBER_INT);
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);
            $student_data_raw = filter_input(INPUT_POST, 'studentdata');
            // dev_export($student_data_raw);
            // die;
            if ($student_data_raw) {
                if ($update_profile == 1) {
                    $status = $this->ONRegistration->edit_temp_registration($student_id, $student_data_raw, $flag);
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
                    $status = $this->ONRegistration->save_temp_registration($student_data_raw);
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

    public function get_class_details_with_age_restriction()
    {
        if ($this->input->is_ajax_request() == 1) {
            $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            if ($age > 0) {
                $class_details = $this->ONRegistration->get_class_details_with_age($age, $inst_id);
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


    public function error_handler_400()
    {
        $this->load->view('template/error-404');
    }

    public function error_handler_500()
    {
        $this->load->view('template/error-500');
    }

    public function error_handler_500_script()
    {
        $this->session->set_userdata('API-Key', '');
        $this->session->set_userdata('isloggedin', '0');
        $this->session->set_userdata('userid', '');
        $this->session->sess_destroy();
        $this->load->view('template/error-500_script');
    }

    public function get_state_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $country_id = filter_input(INPUT_POST, 'country_id', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($country_id);die;
            if (isset($country_id) && !empty($country_id)) {
                //                $data['user_name'] = $this->session->userdata('user_name');

                $state = $this->ONRegistration->get_country_statedetails($country_id);
                //                dev_export($state);die;
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
    public function get_city_details()
    {
        if ($this->input->is_ajax_request() == 1) {
            $state_id = filter_input(INPUT_POST, 'state_id', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($country_id);die;
            if (isset($state_id) && !empty($state_id)) {
                //                $data['user_name'] = $this->session->userdata('user_name');

                $city = $this->ONRegistration->get_country_citydetails($state_id);
                //                dev_export($state);die;
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
            //            dev_export($country_id);die;
            if (isset($religion_id) && !empty($religion_id)) {
                //                $data['user_name'] = $this->session->userdata('user_name');

                $caste = $this->ONRegistration->get_religion_castedetails($religion_id);
                //                dev_export($state);die;
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

    public function select_temp_registration()
    {
        if ($this->input->is_ajax_request() == 1) {

            $admn = filter_input(INPUT_POST, 'admn', FILTER_SANITIZE_STRING);
            if (isset($admn) && !empty($admn)) {
                $admn_details = $this->ONRegistration->get_temp_admn($admn);
                //dev_export($admn_details);die;
                if (isset($admn_details['error_status']) && $admn_details['error_status'] == 0) {
                    if ($admn_details['data_status'] == 1) {
                        $siblingdetails = $this->get_siblings($admn_details['data']);
                        $formatted_address = $this->format_address($admn_details['data']);
                        if ($admn_details['data']['mand_optional_subjects'] != '')
                            $admn_details['data']['mand_optional_subjects'] = json_decode($admn_details['data']['mand_optional_subjects']);
                        else
                            $admn_details['data']['mand_optional_subjects'] = [];
                        $admn_details['data']['formatted_address'] = $formatted_address;
                        $admn_details['data']['siblings_details'] = $siblingdetails['data'];
                        echo json_encode(array('status' => 1, 'data' => $admn_details['data']));
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

    public function send_email()
    {
        if ($this->input->is_ajax_request() == 1) {
            $commun_mail = filter_input(INPUT_POST, 'commun_mail', FILTER_SANITIZE_STRING);
            $TempregId = filter_input(INPUT_POST, 'TempregId', FILTER_SANITIZE_NUMBER_INT);
            if (isset($commun_mail) && !empty($commun_mail)) {
                $this->load->helper('mailgun');
                $otp = rand(100000, 999999);
                $flag = 1; //for save OTP
                $data['otp'] = $otp;
                $data['inst_id'] = $this->session->userdata('inst_id');
                $otp_details_save = $this->ONRegistration->select_OTP($TempregId, $otp, $flag);
                if (isset($otp_details_save['error_status']) && $otp_details_save['error_status'] == 0) {
                    if ($otp_details_save['data_status'] == 1) {
                        $email_message = $this->load->view('registration/email-template', $data, true);
                        $subject = "Online Registration OTP Verification : " . date('d-m-Y');
                        $mailto = $commun_mail;
                        $mailcontent = $email_message;
                        $cc = "";
                        $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);
                        if ($email_res) {
                            echo $email_res;
                        } else {
                            echo 0;
                        }
                    }
                }
            } else {
                echo 0;
            }
        }
    }
    public function select_OTP()
    {
        if ($this->input->is_ajax_request() == 1) {

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $OTP = filter_input(INPUT_POST, 'OTP', FILTER_SANITIZE_NUMBER_INT);
            $flag = 2; //for select OTP
            if (isset($email) && !empty($email) && isset($OTP) && !empty($OTP)) {
                $otp_details = $this->ONRegistration->select_OTP($email, $OTP, $flag);
                if (isset($otp_details['error_status']) && $otp_details['error_status'] == 0) {
                    if ($otp_details['data_status'] == 1) {
                        $datares = $otp_details['data'];
                        echo json_encode(array('status' => 1, 'data' =>  $datares[0]));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'data' =>  'Please Try Again'));
                        return true;
                    }
                } else {
                    echo json_encode(array('status' => 0, 'data' =>  'Please Try Again'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'data' => 'OTP Validation Failed'));
                return true;
            }
        }
    }

    public function logout()
    {
        $this->session->set_userdata('API-Key', '');
        $this->session->set_userdata('isloggedin', '0');
        $this->session->set_userdata('userid', '');
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function generatePdf($institution_id, $data)
    {
        ini_set('memory_limit', -1); // boost the memory limit if it's low ;)
        $data['inst_id'] = $institution_id;

        $html = $this->load->view('pdf-templates/temp-registration-form_' . $institution_id, $data, true); // render the view into HTML 
        // echo $html;
        // exit;
        if (!is_dir(FCPATH . 'reports/online-registration')) {
            mkdir(FCPATH . 'reports/online-registration');
        }
        if (!is_dir(FCPATH . 'reports/online-registration/' . $institution_id)) {
            mkdir(FCPATH . 'reports/online-registration/' . $institution_id);
        }
        $filename_report = 'reports/online-registration/' . $institution_id . '/ONLINE-REG-FORM-' . $data['temp_data']['TempReg_ID'] . '.pdf';
        $pdfFilePath = FCPATH . $filename_report;

        $this->load->library('pdf');

        $pdf = $this->pdf->load();
        $pdf->shrink_tables_to_fit = 1;
        $pdf->WriteHTML($html); // write the HTML into the PDF
        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
        if ($filename_report) {
            return ['status' => 1, 'filename' => $filename_report];
        } else {
            return ['status' => 3, 'message' => 'Report file generation failed. Please try again later'];
        }
    }
    public function dropdown_valitdation()
    {
        $dropdown = strtoupper(filter_input(INPUT_POST, 'dropdown', FILTER_SANITIZE_STRING));
        if (($dropdown == -1)) {
            echo json_encode(array('Select any field.'));
            return true;
        } else {
            echo json_encode('true');
            return true;
        }
    }
    public function sentEmailTempData()
    {

        if ($this->input->is_ajax_request() == 1) {
            $tempregdata = $_REQUEST['tempregdata'];
            $CommuEmail = filter_input(INPUT_POST, 'CommuEmail', FILTER_SANITIZE_STRING);
            $age_calc_date = filter_input(INPUT_POST, 'agelimit', FILTER_SANITIZE_STRING);
            $age_string = filter_input(INPUT_POST, 'agestr', FILTER_SANITIZE_STRING);
            $lastsubmissiondate = filter_input(INPUT_POST, 'lastsubmissiondate', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            //$inst_id = 5;
            if (isset($tempregdata) && !empty($tempregdata)) {
                $this->load->helper('mailgun');
                $data['temp_data'] = $tempregdata;
                $data['age_calc_date'] = $age_calc_date;
                $data['age_string'] = $age_string;
                $data['lastsubmissiondate'] = $lastsubmissiondate;
                // for document upload link
                $enc_temp_id = encrypt_data_for_url($data['temp_data']['TempReg_ID']);
                $enc_inst_id = encrypt_data_for_url($inst_id);
                $data['upload_link_url'] = base_url() . "online-registration/document-upload/" . $enc_inst_id . "/" . $enc_temp_id;

                $formatted_address = $this->format_address($data['temp_data']);
                $data['formatted_address'] = $formatted_address;

                $return_data = $this->allocate_registration_payments($data['temp_data']['TempReg_ID'], $inst_id);
                if (isset($return_data['status'])) {
                    $subject = "Online Registration Details : " . date('d-m-Y');
                    $mailto = $CommuEmail;
                    $cc = $this->get_cc_email($inst_id);
                    if ($return_data['status'] == 1)
                        $data['payment_link'] = $return_data['payment_link'];
                    else
                        $data['payment_link'] = '';
                    $email_message = $this->load->view('registration/' . $inst_id . '_email-template-reg-data', $data, true);
                    $mailcontent = $email_message;
                    $attachment = $this->generatePdf($inst_id, $data);
                    if (isset($attachment['filename'])) {
                        $attachment_data['filename'] = $attachment['filename'];
                        $attachment_data['filepath'] = '';
                    } else {
                        $attachment_data = [];
                    }
                    $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, '', $attachment_data);
                    //CC Email seperated
                    send_smtp_mailer($subject, $cc, $mailcontent, '', $attachment_data);
                    if ($email_res) {
                        if ($return_data['status'] == 1)
                            echo json_encode(array('status' => 1, 'message' => 'Email Sent', 'payment_link' => $return_data['payment_link']));
                        else
                            echo json_encode(array('status' => 1, 'message' => 'Email Sent', 'payment_link' => ''));
                    } else {
                        echo 0;
                    }
                }
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }

    function get_entrance_date()
    {
        if ($this->input->is_ajax_request() == 1) {

            $inst_id = filter_input(INPUT_POST, 'inst_id', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($class_id) && !empty($class_id) && isset($inst_id) && !empty($inst_id)) {
                $entrance_date_details = $this->ONRegistration->get_entrance_date($class_id, $inst_id);
                if (isset($entrance_date_details['error_status']) && $entrance_date_details['error_status'] == 0) {
                    if ($entrance_date_details['data_status'] == 1) {
                        $datares = $entrance_date_details['data'];
                        echo json_encode(array('status' => 1, 'data' =>  $datares));
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
    function get_mandatory_subjects()
    {
        if ($this->input->is_ajax_request() == 1) {

            $inst_id = filter_input(INPUT_POST, 'inst_id', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($class_id) && !empty($class_id) && isset($inst_id) && !empty($inst_id)) {
                $mandatory_subjects = $this->ONRegistration->get_mandatory_subjects($class_id, $inst_id);

                $datares = json_decode($mandatory_subjects);

                echo json_encode(array('status' => 1, 'data' =>  $datares));
                return TRUE;
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
        }
    }
    public function return_view()
    {
        $data['template'] = 'registration/show_temp_registration_finish';
        $data['user_name'] = $this->session->userdata('user_name');
        $data['inst_id'] =  $this->session->userdata('inst_id');
        $this->load->view('template/online_reg_template', $data);
    }
    public function rims_data_api()
    {
        // ini_set('max_execution_time', 300);
        // $unsync_data = $this->ONRegistration->get_all_unsync_temp_admn();
        // // dev_export($unsync_data);
        // // die;
        // $email_data = [];

        // if (!empty($unsync_data['data'])) {
        //     $file_data = '\n----------' . date('Ymd h:i:s') . '-------------';
        //     if (!is_dir(FCPATH . 'reports/online-registration/logs')) {
        //         mkdir(FCPATH . 'reports/online-registration/logs');
        //     }
        //     $filepath = FCPATH . 'reports/online-registration/logs/';
        //     $my_file = $filepath . date('Ymd') . '.log';
        //     $handle = fopen($my_file, 'a') or die('Cannot open file:  ' . $my_file);
        //     foreach ($unsync_data['data'] as $data) {
        //         $formatted_address = $this->format_address($data);
        //         $inst_id = $data['inst_id'];
        //         $json_arr['InstId'] = $data['inst_id'];
        //         $json_arr['AcdYear'] = $data['acdyr'];
        //         $json_arr['FirstName'] = $data['fname'];
        //         $json_arr['MiddleName'] = $data['mname'];
        //         $json_arr['LastName'] = $data['lname'];
        //         $json_arr['Gender'] = $data['gender'];
        //         $json_arr['Syllabus'] = $data['stream_code'];
        //         $json_arr['Class'] = $data['class'];
        //         $json_arr['DateofApplication'] = $data['applicationDate'];
        //         $json_arr['DOB'] = $data['dob'];
        //         $json_arr['DOBinWords'] = ''; //
        //         $json_arr['BCountry'] = $data['birthCountry'];
        //         $json_arr['BState'] = $data['birth_state']; //
        //         $json_arr['BDistrict'] = $data['birth_district']; //
        //         $json_arr['BPlace'] = $data['birthPlace']; //
        //         $json_arr['NationalityCountry'] = $data['nationality'];
        //         $json_arr['State'] = $data['state_name'];
        //         $json_arr['District'] = $data['city_name']; //
        //         $json_arr['Religion'] = $data['religion_name'];
        //         $json_arr['Caste'] = $data['caste_name'];
        //         $json_arr['BloodGroup'] = $data['blood_group'];
        //         $json_arr['MotherTongue'] = $data['mothertongue'];
        //         $json_arr['ThirdLanguage'] = $data['optionallanguage'];
        //         $json_arr['ParentName'] = $data['parentName'];
        //         $json_arr['Profession'] = $data['profession_name'];
        //         $json_arr['OAddress'] = $formatted_address['office_address_string']; //$data['O_Address1'] . ',' . $data['O_Address2'] . ',' . $data['O_Address3'];
        //         $json_arr['OEmirate'] = $data['city_name']; //
        //         $json_arr['OPOBNo'] = $data['O_zip'];
        //         $json_arr['OPhone_No'] = $data['O_phone'];
        //         $json_arr['OMoblieNo'] = $data['O_mobile'];
        //         $json_arr['OEmail'] = $data['O_mail'];
        //         $json_arr['LAddress'] = $formatted_address['communication_address_string']; //$data['L_Address1'] . ',' . $data['L_Address2'] . ',' . $data['L_Address3'];
        //         $json_arr['LEmirate'] = $data['city_name']; //
        //         $json_arr['LPOBNo'] = $data['L_zip'];
        //         $json_arr['LPhone_No'] = $data['L_phone'];
        //         $json_arr['LMoblieNo'] = $data['L_mobile'];
        //         $json_arr['LEmail'] = $data['L_mail'];
        //         $json_arr['PickUpPoint'] = $data['pickpointName'];
        //         $json_arr['AdmissionType'] = $data['admn_type'];
        //         $json_arr['AdmissionReference'] = $data['type_data'];
        //         $json_arr['Remarks'] = ''; //
        //         $json_arr['TemAdmnNo'] = $data['TempAdmn_No'];
        //         $json_arr['EntranceDate'] = $data['entrance_date'];

        //         $apikey = base64_encode('DOCME-ONLINE-REG-' . date('Ymd'));

        //         if ($data['inst_id'] == 2) {

        //             $json_arr['INationality'] = $data['nationality'];
        //             $json_arr['IEmiratesid'] = $data['emirate_Id'];
        //             $json_arr['IPassport'] = $data['stud_passport'];
        //             $json_arr['Landmark'] = ''; //$data[''];
        //             $json_arr['Sibling_detail'] = $data['siblings_details'];
        //             $json_arr['IPlaceOfIssue'] = $data['stud_placeofissue'];
        //             $json_arr['PNationality'] = $data['f_nationality'];
        //             $json_arr['PEmirateId'] = $data['f_emirate_id'];
        //             $json_arr['PPassport'] = $data['f_passport'];
        //             $json_arr['FlatNo'] = ''; //$data[''];
        //             $json_arr['NoOfDaughters'] = $data['daughter_count'];
        //             $json_arr['NoOfSons'] = $data['son_count'];
        //             $json_arr['NoOfDaughtersSons'] = $data['sibling_count'];
        //             $json_arr['Haddress'] = $formatted_address['permanent_address_string']; //$data['O_Address1'] . ',' . $data['O_Address2'] . ',' . $data['O_Address3'];
        //             $json_arr['HPOBNO'] = $data['O_zip'];
        //             $json_arr['HPhone_No'] = $data['O_phone'];
        //             $json_arr['HMobileNo'] = $data['O_mobile'];
        //             $json_arr['HEmirates'] = $data['state_name'];
        //             $json_arr['Fqualification'] = $data['f_qualification'];
        //             $json_arr['Mname'] = $data['m_name'];
        //             $json_arr['Mqualification'] = $data['m_qualification'];
        //             $json_arr['Mprofession'] = $data['mother_profession'];
        //             $json_arr['Pschool'] = $data['prev_school'];
        //             $json_arr['Pclass'] = $data['prev_class'];
        //             $json_arr['Pacademicyear'] = $data['prev_acdyr'];
        //             $json_arr['Pcurriculam'] = $data['prev_curriculum'];
        //             $json_arr['Pmediumofinstruction'] = $data['prev_moi'];


        //             $func = 'OnlineRegistraction/PostOnlineRegistraction_Sharjah';
        //         } else {
        //             $func = 'OnlineRegistraction/PostOnlineRegistraction';
        //         }
        //         $raw_data_to_rims = json_encode($json_arr);

        //         $response = transport_data_to_rims($raw_data_to_rims, $apikey, $func, $inst_id);
        //         // dev_export($response);
        //         // die;
        //         // $response = json_decode($response);
        //         if (!empty($response[0]['status']) && $response[0]['status'] == 200) {
        //             $save_data['response'] = json_encode($response);
        //             $save_data['sync_status'] = 'S';
        //             $save_data['TempReg_ID'] = $data['TempReg_ID'];
        //         } else {
        //             $save_data['response'] = json_encode($response);
        //             $save_data['sync_status'] = 'F';
        //             $save_data['TempReg_ID'] = $data['TempReg_ID'];

        //             $email_data[$data['inst_id']]['email_data'][$data['TempReg_ID']]['TempAdmn_No'] = $data['TempAdmn_No'];
        //             $email_data[$data['inst_id']]['email_data'][$data['TempReg_ID']]['stud_name'] = $data['fname'] . ' ' . $data['lname'];
        //             $email_data[$data['inst_id']]['email_data'][$data['TempReg_ID']]['issue_remark'] = $save_data['response'];
        //             $email_data[$data['inst_id']]['email_data'][$data['TempReg_ID']]['applied_date'] = $data['applicationDate'];
        //         }

        //         $save_respone = $this->ONRegistration->save_rims_response_online_registration($save_data);
        //         if ($save_respone) {
        //             //echo '<pre>' . $raw_data_to_rims . '</pre>';
        //             $file_data .= "\nRequest=>" . $raw_data_to_rims . " Respose=>" . $save_data['response'];
        //             echo $data['TempAdmn_No'] . "--Inst ID:" . $data['inst_id'] . " ,Sync status : " . $save_data['sync_status'] . ", Response--" . $save_data['response'] . "<br/>";
        //         }
        //     }
        //     fwrite($handle, $file_data);
        //     fclose($handle);
        // }

        // if (sizeof($email_data) != 0 && $this->input->get('cron') == 1) {
        //     $this->sendserviceemail($email_data);
        // }
    }
    function recreate_reg_form()
    {
        $temp_admin_no = $this->input->post('temp_admin_no');
        $inst_id = $this->input->post('inst_id');
    }

    function get_siblings($data)
    {
        $admisn_type = $data['admn_type'];
        if ($admisn_type == 'Sibling') {
            $admission_no = $data['type_data'];
            $searchby = '';
            $sibilings_data = $this->MRegistration->get_sibilings_student_byadmno($admission_no, $searchby);
            return $sibilings_data;
        }
    }

    function format_address($data)
    {
        $office_address[] = $data['Of_Address1'] == '-'   ? FALSE : $data['Of_Address1'];
        $office_address[] = $data['Of_Address2'] == '-'   ? FALSE : $data['Of_Address2'];
        $office_address[] = $data['Of_Address3'] == '-'  ? FALSE : $data['Of_Address3'];

        $permanent_address[] = $data['O_Address1'] == '-' ? FALSE : $data['O_Address1'];
        $permanent_address[] = $data['O_Address2'] == '-'   ? FALSE : $data['O_Address2'];
        $permanent_address[] = $data['O_Address3'] == '-'   ? FALSE : $data['O_Address3'];

        $communication_address[] = $data['L_Address1'] == '-'   ? FALSE : $data['L_Address1'];
        $communication_address[] = $data['L_Address2'] == '-'  ? FALSE : $data['L_Address2'];
        $communication_address[] = $data['L_Address3'] == '-'  ? FALSE : $data['L_Address3'];

        $office_address_string = implode(" , ", array_filter($office_address));
        $permanent_address_string = implode(" , ", array_filter($permanent_address));
        $communication_address_string = implode(" , ", array_filter($communication_address));

        return [
            'office_address_string' => strlen($office_address_string) == 0 ? '-' : $office_address_string,
            'permanent_address_string' => strlen($permanent_address_string) == 0 ? '-' : $permanent_address_string,
            'communication_address_string' => strlen($communication_address_string) == 0 ? '-' : $communication_address_string
        ];
    }

    function get_cc_email($inst_id)
    {
        switch ($inst_id) {
            case 5:
                $cc_email = SUPPORT_EMAIL_OXFTVM;
                break;
            case 8:
                $cc_email = SUPPORT_EMAIL_OXFKLM;
                break;
            case 20:
                $cc_email = SUPPORT_EMAIL_OXFCLT;
                break;
            default:
                $cc_email = SUPPORT_DEV_TEAM_EMAIL;
                break;
        }

        return $cc_email;
    }

    function sendserviceemail($service_emails = [])
    {
        $this->load->helper('mailgun');
        if (sizeof($service_emails) != 0) {
            foreach ($service_emails as $school_id => $email_data) {
                switch ($school_id) {
                    case 5:
                        $support_email = SUPPORT_EMAIL_OXFTVM;
                        $data['school_name'] = 'The Oxford School,Trivandrum';
                        break;
                    case 8:
                        $support_email = SUPPORT_EMAIL_OXFKLM;
                        $data['school_name'] = 'The Oxford School,Kollam';
                        break;
                    case 20:
                        $support_email = SUPPORT_EMAIL_OXFCLT;
                        $data['school_name'] = 'The Oxford School,Calicut';
                        break;
                    default:
                        $support_email = SUPPORT_DEV_TEAM_EMAIL;
                        $data['school_name'] = 'The Oxford Kids';
                        break;
                }
                $data['email_content'] = $email_data['email_data'];
                $subject = 'Unsync Data Online Registration-' . $data['school_name'] . ',' . date('d-m-Y');
                $mailcontent = $this->load->view('registration/service_email_template', $data, true);
                $mailto = SUPPORT_DEV_TEAM_EMAIL;
                $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $support_email);
            }
        }
    }
    public function select_parent_details_andOTP()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = filter_input(INPUT_POST, 'inst_id', FILTER_SANITIZE_NUMBER_INT);
            $adtext = filter_input(INPUT_POST, 'adtext', FILTER_SANITIZE_STRING);
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);
            $addr_flag = filter_input(INPUT_POST, 'addrflag', FILTER_SANITIZE_NUMBER_INT);
            if (isset($adtext) && !empty($adtext) && isset($inst_id) && !empty($inst_id)) {
                $parent_details = $this->ONRegistration->get_parent_details($inst_id, $adtext, $flag, $addr_flag);
                if (isset($parent_details['error_status']) && $parent_details['error_status'] == 0) {
                    if ($parent_details['data_status'] == 1) {
                        $datares = $parent_details['data'];
                        echo json_encode(array('status' => 1, 'data' =>  $datares));
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

    public function send_OTP_Parent()
    {
        if ($this->input->is_ajax_request() == 1) {
            $commun_mail = filter_input(INPUT_POST, 'communEmail', FILTER_SANITIZE_STRING);
            $admn_type = filter_input(INPUT_POST, 'admn_type', FILTER_SANITIZE_STRING);

            if (isset($commun_mail) && !empty($commun_mail) && isset($admn_type) && !empty($admn_type)) {
                $this->load->helper('mailgun');
                $otp = rand(100000, 999999);
                $flag = 1; //for save OTP
                $data['otp'] = $otp;
                $data['inst_id'] = $this->session->userdata('inst_id');
                $data['admn_type'] =  $admn_type;
                $this->session->set_userdata("otp", $otp);
                if ($this->session->userdata('otp') != 0) {
                    $email_message = $this->load->view('registration/otp_parent_email_template', $data, true);
                    $subject = "Online Registration OTP Verification : " . date('d-m-Y h:i:s');
                    $mailto = $commun_mail;
                    $mailcontent = $email_message;
                    $cc = "";
                    $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);
                    if ($email_res) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }
            } else {
                echo 0;
            }
        }
    }
    public function check_otp_session()
    {
        if ($this->input->is_ajax_request() == 1) {
            $parentotp = filter_input(INPUT_POST, 'parentotp', FILTER_SANITIZE_NUMBER_INT);
            $session_otp = $this->session->userdata('otp');
            if ($parentotp == $session_otp) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function allocate_registration_payments($temp_reg_id, $inst_id)
    {
        $this->load->helper('mailgun');
        $data_prep['checked_temp_ids'] = $temp_reg_id;
        $data_prep['flag'] = 0;

        $status = $this->ONRegistration->get_all_temp_students_registration_fees($data_prep);

        if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
            $selected_class_fee_data = $status['data'];
            $payment_data = [];
            foreach ($selected_class_fee_data as $data) {
                // $email_message = $this->load->view('settings/email_template_registration_payment', $data, true);
                // if ($flag == 3) {
                //     $subject = "Payment for Registration No. " . $data['TempAdmn_No'] . " against Failed Payment ";
                // } else {
                //     $subject = "Payment for Registration No. " . $data['TempAdmn_No'];
                // }

                // //$mailto = $data['L_mail'];
                // $mailto = 'mailalert@docme.cloud';
                // $mailcontent = $email_message;
                // //$cc = $this->get_cc_email($data['inst_id']);
                // $cc = '';
                // $email_res = sendgrid_mailer($subject, $mailto, $mailcontent, $cc);
                $payment_data[] = $data;
            }
            if (sizeof($payment_data) > 0) {

                $json_string = json_encode($payment_data);
                $this->ONRegistration->update_payment_allocation($json_string);
                $payment_link = base_url() . 'registration/online-payment?' . base64_encode('temp_reg_id') . '=' . base64_encode($temp_reg_id) . '&' . base64_encode('school_id') . '=' . base64_encode($inst_id);
            }
            return array('status' => 1, 'message' => 'Allocated Successfully', 'payment_link' => $payment_link);
        } else {
            return array('status' => 2, 'message' => 'Registration Fees Not set');
        }
    }
}
