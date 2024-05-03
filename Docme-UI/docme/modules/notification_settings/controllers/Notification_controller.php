<?php

/**
 * Description of Notification_controller
 *
 * @author Nizamudeen
 * On 18.09.2020
 * For Notification Management
 */
class Notification_controller extends MX_Controller
{

    public function __construct()
    {
        if (!(isLoggedin() == 1)) {
            if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
                header("HTTP/1.1 401 UNauthorized");
                die();
            } else {
                $path = base_url();
                redirect($path);
            }
        }
        parent::__construct();
        $this->load->model('Notification_model', 'NModel');
    }
    public function show_notification_settings()
    {
        $data['template']  = 'settings/show_settings';
        $data['title']     = 'Notification Management';
        $data['sub_title'] = 'Notification Settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Notification Management',
                'link' => base_url('notification/show-notification-settings')
            ),
            '2' => array(
                'title' => 'Notification Settings',
                'link' => base_url('notification/show-notification-settings')
            )
        );
        //          $breadcrmp = strtoupper(filter_input(INPUT_POST, 'breadcrmp', FILTER_SANITIZE_STRING));
        ////        dev_export($breadcrmp);die;
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);

        $this->load->view('template/home_template', $data);
    }

    public function get_all_notification_list()
    {
        $data['title'] = 'Notification Management';
        $data['sub_title'] = 'Notification Settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Notification Management',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Notification Settings'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $notification_data = $this->NModel->get_all_notification_list();
        $data['notification_data'] = $notification_data['data'];

        //   print_r($documents_data);
        $this->load->view('notification/notifications_lists', $data);
    }
    public function arrear_list_notification()
    {
        $data['title'] = 'Student Arrear List';
        $data['sub_title'] = 'Student Arrear List';
        $notification_data = $this->NModel->get_notification_list_fordropdown();
        $data['notification_data'] = $notification_data['data'];
        $arrear_data = $this->NModel->get_all_arrear_list();
        $data['arrear_data'] = $arrear_data['data'];
        $this->load->view('alert/arrear_list', $data);
    }

    public function add_notification()
    {
        if ($this->input->is_ajax_request() == 1) {
            $onload = $this->input->post('load');
            $data['title'] = 'Notification Management';
            $data['sub_title'] = 'CREATE NOTIFICATION TEMPLATE';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'title' => 'Notification Management',
                    'link' => base_url()
                ),
                '2' => array(
                    'title' => 'Create Notification'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            if ($onload == 1) {
                $this->load->view('notification/add_notification', $data);
            } else {
                $data_prep['inst_id'] = $this->session->userdata('inst_id');
                $data_prep['notification_name'] = strtoupper(filter_input(INPUT_POST, 'notification_name', FILTER_SANITIZE_STRING));

                if ($this->input->post('email_status')) {
                    $email_status                  = filter_input(INPUT_POST, 'email_status', FILTER_SANITIZE_STRING);
                    if ($email_status == "email_message") {
                        $data_prep['sms_status']   = 0;
                        $data_prep['email_status'] = 1;
                        $data_prep['email_message']     = filter_input(INPUT_POST, 'email_message', FILTER_SANITIZE_STRING);
                        $data_prep['sms_message']       = "";
                    } else if ($email_status == "sms_message") {
                        $data_prep['sms_status']  = 1;
                        $data_prep['email_status'] = 0;
                        $data_prep['sms_message']       = filter_input(INPUT_POST, 'sms_message', FILTER_SANITIZE_STRING);
                        $data_prep['email_message']     = "";
                    }
                }

                $data_prep['action'] = 'add_notification';
                $data_prep['notification_status'] = 'save_notification';
                $data_prep['controller_function'] = 'Notification_settings/Notification_controller/get_all_notification_list';
                $data_prep['user_id'] = $this->session->userdata('userid');

                $this->form_validation->set_rules('notification_name', 'notification_name', 'trim|required');
                if ($data_prep['sms_status'] == 1) {
                    $this->form_validation->set_rules('sms_message', 'sms_message', 'trim|required');
                }
                if ($data_prep['email_status'] == 1) {
                    $this->form_validation->set_rules('email_message', 'email_message', 'trim|required');
                }


                if ($this->form_validation->run() == TRUE) {
                    // 
                    $documents_data = $this->NModel->add_notification($data_prep);
                    if (is_array($documents_data) && $documents_data['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else if (is_array($documents_data) && $documents_data['data_status'] == 0 &&  $documents_data['error_status'] == 1) {
                        echo json_encode(array('status' => 2, 'message' => $documents_data['message'], 'view' => ''));
                        return;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'Error in saving data.', 'view' => ''));
                        return;
                    }
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Enter required feilds.', 'view' => ''));
                    return;
                }
            }
        }
    }
    public function edit_notification()
    {
        if ($this->input->is_ajax_request() == 1) {
            $onload = $this->input->post('load');
            $notification_id = $this->input->post('notification_id');
            $data['title'] = 'Notification Management';
            $data['sub_title'] = 'Update Notification';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'title' => 'Notification Management',
                    'link' => base_url()
                ),
                '2' => array(
                    'title' => 'Update Notification'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            if ($onload == 1) {
                $data_prep['notification_id']      = $this->input->post('notification_id');
                $data_prep['inst_id']   = $this->session->userdata('inst_id');
                $data_prep['action']    = 'get_notification_sms_list';
                $data_prep['notification_status'] = 'get_notification_edit_byid';
                $data_prep['controller_function'] = 'Notification_settings/Notification_controller/get_notification_sms_by_id';
                $data_prep['user_id'] = $this->session->userdata('userid');
                $message_data = $this->NModel->get_notification_sms_by_id($data_prep);
                $data['sub_title'] = 'EDIT - ' . strtoupper($message_data['data']['data']['name']);
                $data['edit_nitification_data'] = $message_data['data']['data'];
                $this->load->view('notification/edit_notification', $data);
            } else {
                $data_prep['inst_id'] = $this->session->userdata('inst_id');
                $data_prep['notification_name'] = strtoupper(filter_input(INPUT_POST, 'notification_name', FILTER_SANITIZE_STRING));
                if ($this->input->post('email_status')) {
                    $email_status                  = filter_input(INPUT_POST, 'email_status', FILTER_SANITIZE_STRING);
                    if ($email_status == "email_message") {
                        $data_prep['sms_status']   = 0;
                        $data_prep['email_status'] = 1;
                        $data_prep['email_message']     = filter_input(INPUT_POST, 'email_message', FILTER_SANITIZE_STRING);
                        $data_prep['sms_message']       = "";
                    } else if ($email_status == "sms_message") {
                        $data_prep['sms_status']  = 1;
                        $data_prep['email_status'] = 0;
                        $data_prep['sms_message']       = filter_input(INPUT_POST, 'sms_message', FILTER_SANITIZE_STRING);
                        $data_prep['email_message']     = "";
                    }
                }
                $data_prep['action']                = 'add_notification';
                $data_prep['notification_status']   = 'update_notification';
                $data_prep['notification_id']       = filter_input(INPUT_POST, 'notification_id', FILTER_SANITIZE_STRING);;
                $data_prep['controller_function']   = 'Notification_settings/Notification_controller/get_all_notification_list';
                $data_prep['user_id']               = $this->session->userdata('userid');
                $this->form_validation->set_rules('notification_name', 'notification_name', 'trim|required');
                if ($data_prep['sms_status'] == 1) {
                    $this->form_validation->set_rules('sms_message', 'sms_message', 'trim|required');
                }
                if ($data_prep['email_status'] == 1) {
                    $this->form_validation->set_rules('email_message', 'email_message', 'trim|required');
                }


                if ($this->form_validation->run() == TRUE) {
                    // 
                    $documents_data = $this->NModel->add_notification($data_prep);
                    if (is_array($documents_data) && $documents_data['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else if (is_array($documents_data) && $documents_data['data_status'] == 0 &&  $documents_data['error_status'] == 1) {
                        echo json_encode(array('status' => 2, 'message' => $documents_data['message'], 'view' => ''));
                        return;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'Error in saving data.', 'view' => ''));
                        return;
                    }
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Enter required feilds.', 'view' => ''));
                    return;
                }
            }
        }
    }
    public function notification_list_byid()
    {
        $notification_type      = $this->input->post('notification_type');
        $data_prep['inst_id']   = $this->session->userdata('inst_id');
        $data_prep['action']    = 'get_notification_sms_list';
        if ($notification_type == 1) {
            $data_prep['notification_status'] = 'get_notification_sms_list';
        } else {
            $data_prep['notification_status'] = 'get_notification_email_list';
        }
        $data_prep['controller_function'] = 'Notification_settings/Notification_controller/get_all_notification_list';
        $data_prep['user_id'] = $this->session->userdata('userid');
        $message_data = $this->NModel->get_notification_sms_by_id($data_prep);
        $message = $message_data['data']['data'];
        if (isset($message['ErrorStatus'])) {
            echo json_encode(array('status' => 0, 'message' => $message, 'view' => ''));
        } else if ($message) {
            echo json_encode(array('status' => 1, 'message' => $message, 'view' => ''));
        } else {
            echo json_encode(array('status' => 1, 'message' => $message, 'view' => ''));
        }
    }

    public function document_change_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $document_id = filter_input(INPUT_POST, 'document_id', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($document_id);die;
            if (isset($document_id) && !empty($document_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['document_id'] = filter_input(INPUT_POST, 'document_id', FILTER_SANITIZE_STRING);
                $status = $this->NModel->document_change_status($data_prep);
                if (isset($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status['message'], 'data' => ''));
                        return;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                return;
            }
        } else {
            echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
            return;
        }
    }
    public function document_change_isrequired()
    {
        if ($this->input->is_ajax_request() == 1) {
            $document_id = filter_input(INPUT_POST, 'document_id', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($document_id);die;
            if (isset($document_id) && !empty($document_id)) {
                $data_prep['isrequired'] = filter_input(INPUT_POST, 'isrequired', FILTER_SANITIZE_NUMBER_INT);
                if ($data_prep['isrequired'] == -1) {
                    $data_prep['isrequired'] = 0;
                }
                $data_prep['document_id'] = filter_input(INPUT_POST, 'document_id', FILTER_SANITIZE_STRING);
                $status = $this->NModel->update_document_isrequired($data_prep);
                if (isset($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status['message'], 'data' => ''));
                        return;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                return;
            }
        } else {
            echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
            return;
        }
    }
    public function send_arrear_sms()
    {
        $id = 1;
        $message = $this->NModel->get_message_sms($id);

        if ($message != "0") {
            $this->valuearray["admissionno"]  = "";
            $this->valuearray["studentname"]  = "";
            $this->valuearray["currentdate"]  = "";
            $this->valuearray["amount"]       = "";
            $message = $this->formstring($message, $this->valuearray);
        }
    }
    public $valuearray;
    public function notification_sms_send_all()
    {
        if ($this->input->is_ajax_request() == 1) {
            $checked_temp_ids = $this->input->post('checked_temp_ids');
            // unset($checked_temp_ids[0]);
            $checked_temp_ids = implode(',', $checked_temp_ids);
            $not_list_id        = $this->input->post('notification_id');
            $notification_type  = $this->input->post('notification_type');
            $data_prep['inst_id']           = $this->session->userdata('inst_id');
            $data_prep['action']              = 'get_notification_sms_by_id';
            if ($notification_type == 1) {
                $data_prep['notification_status'] = 'get_notification_sms_by_id';
            } else {
                $data_prep['notification_status'] = 'get_notification_email_by_id';
            }
            $data_prep['notification_id'] = $not_list_id;
            $data_prep['controller_function'] = 'Notification_settings/Notification_controller/get_notification_sms_by_id';
            $data_prep['user_id'] = $this->session->userdata('userid');
            $message_data = $this->NModel->get_notification_sms_by_id($data_prep);
            $message = $message_data['data']['data'];
            if ($message != "0") {
                $arrear_data = $this->NModel->get_all_arrear_list_byuser_id($checked_temp_ids);
                $arrear_data = $arrear_data['data'];
                $xml_data = "<student>";
                if ($arrear_data['data']) {
                    foreach ($arrear_data['data'] as $sms_content) {
                        $this->valuearray["admissionno"]  =  $sms_content['Admn_No'];
                        $this->valuearray["studentname"]  =  $sms_content['student_name'];
                        $this->valuearray["currentdate"]  =  date('d-m-Y');
                        $this->valuearray["class"]        =  $sms_content['class_name'];
                        $this->valuearray["amount"]       =  $sms_content['PENDING_PAYMENT'];
                        if ($sms_content['Phone1']) {
                            $user_phone_no                    =  $sms_content['Phone1'];
                        } else if ($sms_content['Phone3']) {
                            $user_phone_no                    =  $sms_content['Phone3'];
                        } else {
                            $user_phone_no                    = 0;
                        }
                        if ($sms_content['EMAIL']) {
                            $user_phone_email                  =  $sms_content['EMAIL'];
                        } else {
                            $user_phone_email                  = "";
                        }

                        if ($notification_type == 1) {
                            $message_details              = $raw_message_details    = $this->formstring($message['sms_message'], $this->valuearray);
                        } else {
                            $data_email['message_details']   = $raw_message_details                = $this->formstring($message['email_message'], $this->valuearray);
                            $data_email['inst_id']   = $this->session->userdata('inst_id');
                            $data_email['inst_name']   = $this->session->userdata('Institution_Name');
                            $data_email['parent_name']   = $sms_content['Parent_Name'];
                            $message_details                      =  $this->load->view('alert/email-alert-template', $data_email, true);
                        }
                        // sms part 
                        $xml_data = $xml_data . "<messageDetails>";
                        $message_status = 2;
                        if (($notification_type == 1) and ($user_phone_no > 0)) {
                            $result_data = $this->send_sms($message_details, $user_phone_no);
                            if ($result_data == 1) {
                                $message_status = 1;
                            } else {
                                $message_status = 2;
                            }
                        } else if (($notification_type == 2) and ($user_phone_email != "")) {
                            $result_data = $this->send_email($message['name'], $message_details, $user_phone_email);
                            if ($result_data) {
                                $message_status = 1;
                            } else {
                                $message_status = 2;
                            }
                        }

                        $xml_data = $xml_data . "<inst_id>" . $this->session->userdata('inst_id') . "</inst_id>";
                        $xml_data = $xml_data . "<student_name>" . $sms_content['student_name'] . "</student_name>";
                        $xml_data = $xml_data . "<student_id>" . $sms_content['STUDENT_ID'] . "</student_id>";
                        $xml_data = $xml_data . "<message_details>" . $raw_message_details  . "</message_details>";
                        $xml_data = $xml_data . "<month_year>" . date('m/Y') . "</month_year>";
                        $xml_data = $xml_data . "<message_status>" . $message_status . "</message_status>";
                        $xml_data = $xml_data . "<message_for>" . $notification_type . "</message_for>";
                        $xml_data = $xml_data . "<created_by>" . $this->session->userdata('userid') . "</created_by>";
                        $xml_data = $xml_data . "</messageDetails>";
                    }

                    $xml_data .= "</student>";
                    $data_prep_sms['inst_id']               =  $this->session->userdata('inst_id');
                    $data_prep_sms['action']                =  'save_user_messages';
                    $data_prep_sms['notification_status']   =  'save_user_messages';
                    $data_prep_sms['notification_id']       =  $not_list_id;
                    $data_prep_sms['controller_function']   =  'Notification_settings/Notification_controller/save_user_messages';
                    $data_prep_sms['user_id']               =  $this->session->userdata('userid');
                    $data_prep_sms['notification_messages'] =  $xml_data;
                    $save_user_message_data                 =  $this->NModel->save_user_messages($data_prep_sms);
                    $msf = ($notification_type == 1) ? "SMS" : "EMAIL";
                    if (($save_user_message_data) && ($message_status == 1)) {
                        echo json_encode(array('status' => 1, 'message' => $msf . ' sent successfully.', 'view' => ''));
                    } else {
                        echo json_encode(array('status' => 1, 'message' => 'Failed to sent ' . $msf . '.', 'view' => ''));
                    }
                } else {
                    $msf = ($notification_type == 1) ? "SMS" : "EMAIL";
                    echo json_encode(array('status' => 0, 'message' => 'Failed to sent ' . $msf . '.', 'view' => ''));
                }
            }
        }
    }
    public function notification_sms_resend()
    {
        if ($this->input->is_ajax_request() == 1) {
            $not_list_id                      = $this->input->post('notification_alert_id');
            $data_prep['inst_id']             = $this->session->userdata('inst_id');
            $data_prep['action']              = 'notification_sms_resend';
            $data_prep['notification_status'] = 'get_user_message_byid';
            $data_prep['notification_id']     = $not_list_id;
            $data_prep['controller_function'] = 'Notification_settings/Notification_controller/save_user_messages';
            $data_prep['user_id']             = $this->session->userdata('userid');
            $message_data                     = $this->NModel->save_user_messages($data_prep);
            $message                          = $message_data['data']['data'][0];
            if ($message) {

                $message_details                  = $message['message_details'];
                if ($message['Phone1']) {
                    $user_phone_no            =  $message['Phone1'];
                } else if ($message['Phone3']) {
                    $user_phone_no                =  $message['Phone3'];
                } else {
                    $user_phone_no                = 0;
                }
                if ($message['EMAIL']) {
                    $user_phone_email                  =  $message['EMAIL'];
                } else {
                    $user_phone_email                  = "";
                }
                $message_status = 2;
                if (($message['message_for'] == 1) and ($user_phone_no > 0)) {
                    $result_data = $this->send_sms($message_details, $user_phone_no);
                    if ($result_data == 1) {
                        $message_status = 1;
                    } else {
                        $message_status = 2;
                    }
                } else if (($message['message_for'] ==  2) and ($user_phone_email != "")) {
                    $result_data = $this->send_email($message['name'], $message_details, $user_phone_email);
                    if ($result_data) {
                        $message_status = 1;
                    } else {
                        $message_status = 2;
                    }
                }
                $xml_data = "<student>";
                $xml_data = $xml_data . "<messageDetails>";
                $xml_data = $xml_data . "<message_status>" . $message_status . "</message_status>";
                $xml_data = $xml_data . "<message_status_details></message_status_details>";
                $xml_data = $xml_data . "<modified_by>" . $this->session->userdata('userid') . "</modified_by>";
                $xml_data = $xml_data . "<id>" . $message['notification_id'] . "</id>";
                $xml_data = $xml_data . "</messageDetails>";
                $xml_data .= "</student>";

                $data_prep_sms['inst_id']               =  $this->session->userdata('inst_id');
                $data_prep_sms['action']                =  'update_user_messages';
                $data_prep_sms['notification_status']   =  'update_user_messages';
                $data_prep_sms['notification_id']       =  $not_list_id;
                $data_prep_sms['controller_function']   =  'Notification_settings/Notification_controller/save_user_messages';
                $data_prep_sms['user_id']               =  $this->session->userdata('userid');
                $data_prep_sms['notification_messages'] =  $xml_data;
                $save_user_message_data                 =  $this->NModel->save_user_messages($data_prep_sms);
                $msf = ($message['message_for'] == 1) ? "SMS" : "EMAIL";
                if (($save_user_message_data) && ($message_status == 1)) {
                    echo json_encode(array('status' => 1, 'message' => $msf . ' resent successfully.', 'view' => ''));
                } else {
                    echo json_encode(array('status' => 1, 'message' => 'Failed to resent ' . $msf, 'view' => ''));
                }
            } else {
                $msf = ($message['message_for'] == 1) ? "SMS" : "EMAIL";
                echo json_encode(array('status' => 0, 'message' => $msf . ' Send Failed', 'view' => ''));
            }
        }
    }

    public function formstring($string, $replacearray)
    {
        $string = str_replace("{admissionno}", $replacearray['admissionno'], $string);
        $string = str_replace("{studentname}", $replacearray['studentname'], $string);
        $string = str_replace("{currentdate}", $replacearray['currentdate'], $string);
        $string = str_replace("{amount}", my_money_format($replacearray['amount']), $string);
        return $string;
    }
    public function send_sms($message_details, $user_phone_no)
    {

        $data_sms = array(
            SMS_USERNAME_PARAM => SMS_USERNAME_VALUE,
            SMS_PASSWORD_PARAM => SMS_PASSWORD_VALUE,
            SMS_SENDER_ID_PARAM => SMS_SENDER_ID_VALUE,
            SMS_MESSAGE_PARAM => $message_details,
            SMS_ROUTE_PARAM => SMS_ROUTE_VALUE
        );
        if (ENVIRONMENT == 'development') {
            //  $data_sms[SMS_TO_PARAM] = SMS_DEFAULT_TO_VALUE;
            $data_sms[SMS_TO_PARAM] = SMS_DEFAULT_TO_VALUE;
            $data_sms['sms'] = $message_details;
            $stat = arrear_sms_data($data_sms);
            if (empty($stat)) {
                return 0;
            } else {
                return 1;
            }
        } else {
            $data_sms[SMS_TO_PARAM] = $user_phone_no;
            $data_sms['sms'] = $message_details;
            $stat = arrear_sms_data($data_sms);
            if (empty($stat)) {
                return 0;
            } else {
                return 1;
            }
        }
    }
    public function send_email($subject_head, $message_details, $user_email)
    {
        //return false;
        $this->load->helper('mailgun');
        $subject = $subject_head . " : " . date('d-m-Y');
        $mailto = $user_email;
        $data["mail_body"] = $message_details;

        $mailcontent =  $this->load->view('alert/email-alert-template', $data, true);
        //$mailcontent =  $message_details;
        $cc = "";
        $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);
        return $email_res;
    }

    public function notification_change_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $notification_id            = filter_input(INPUT_POST, 'notification_id', FILTER_SANITIZE_NUMBER_INT);
            $sms_status                 = filter_input(INPUT_POST, 'sms_status', FILTER_SANITIZE_NUMBER_INT);
            $data['notification_id']    = $notification_id;
            if ($sms_status == -1) {
                $data['sms_status']         =  0;
            } else {
                $data['sms_status']         = $sms_status;
            }

            $data['action'] = 'add_notification';
            $data['notification_status'] = 'update_notification_sms_status';
            $data['controller_function'] = 'Notification_settings/Notification_controller/get_all_notification_list';
            $data['user_id'] = $this->session->userdata('userid');
            $status_data                     = $this->NModel->add_notification($data);
            $status                     = $status_data['data'];

            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                echo json_encode(array('status' => $sms_status, 'message' => 'Status Successfully', 'view' => ''));
                return true;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                return false;
            }
        }
    }
    public function get_document_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id       = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $academic_year  = filter_input(INPUT_POST, 'acd_yr', FILTER_SANITIZE_NUMBER_INT);
            $flag           = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);

            $data['class_id']   = $class_id;
            $data['acd_yr']     = $academic_year;
            $data['flag']       = $flag;
            $status             = $this->ONRegistration->get_all_temp_students_registration_documents($data);

            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                $data['class_fee_data'] = $status['data'];
                echo json_encode(array('status' => 1, 'message' => 'Loaded Successfully', 'view' => $this->load->view('admission/temp_document_status_view', $data, true)));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    $data['class_fee_data'] = [];
                    echo json_encode(array('status' => 1, 'message' => $status['message'], 'view' => $this->load->view('admission/temp_document_status_view', $data, true)));
                    return false;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            }
        }
    }

    public function get_student_filter_for_account()
    {

        //        STREAM DATA
        $stream = $this->NModel->get_all_stream();
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

        //        CLASS DATA
        $class = $this->NModel->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data_for_registration'] = $class['data'];
            } else {
                $data['class_data_for_registration'] = FALSE;
            }
        } else {
            $data['class_data_for_registration'] = FALSE;
        }
        //        ACD YEAR DATA
        $acdyr = $this->NModel->get_all_acadyr();
        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
            if ($acdyr['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        //        BATCH DATA
        $batch = $this->NModel->get_all_batch($this->session->userdata('acd_year'));
        if (isset($batch['error_status']) && $batch['error_status'] == 0) {
            if ($batch['data_status'] == 1) {
                $data['batch_data'] = $batch['data'];
            } else {
                $data['batch_data'] = FALSE;
            }
        } else {
            $data['batch_data'] = FALSE;
        }


        $this->load->view('alert/student_filter', $data);
    }
    public function search_byname_for_account()
    {                                               //display students list on search
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['admn_no'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            $details_data = $this->NModel->student_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['user_name'] = $this->session->userdata('user_name');
            echo json_encode(array('status' => 1, 'view' => $this->load->view('alert/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function advancesearch_byname_for_account()
    {                                               //display students list on search
        $data['sub_title'] = 'Arrear List';
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $data_prep['batch_id'] = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['stream_id'] = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['class_id'] = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['curent_acdyr'] = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $data_prep['searchname'] = strtoupper(filter_input(INPUT_POST, 'searchname', FILTER_SANITIZE_STRING));
            if ($data_prep['stream_id'] == -1) {
                $data_prep['stream_id'] = '';
            }
            if ($data_prep['curent_acdyr'] == -1) {
                $data_prep['curent_acdyr'] = '';
            }
            if ($data_prep['class_id'] == -1) {
                $data_prep['class_id'] = '';
            }
            $details_data = $this->NModel->studentadvance_search($data_prep);
            if ($details_data['error_status'] == 0 && $details_data['data_status'] == 1) {
                $data['details_data'] = $details_data['data'];
                $data['message'] = "";
            } else {
                $data['details_data'] = FALSE;
                $data['message'] = $details_data['message'];
            }
            $data['title'] = 'Student Arrear List';
            $data['sub_title'] = 'Student Arrear List';
            /* $notification_data = $this->NModel->get_all_notification_list();
            $data['notification_data'] = $notification_data['data']; */
            $data['notification_data'] = "";
            /*  $arrear_data = $this->NModel->get_all_arrear_list();
            $data['arrear_data'] = $arrear_data['data']; */
            echo json_encode(array('status' => 1, 'view' => $this->load->view('alert/profile_search_result', $data, TRUE)));
            return TRUE;
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function batchlist_for_account()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $stream_id = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $academic_year = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $session_id = NULL;
            $flag_status = NULL;
            if ($stream_id == -1) {
                $stream_id = NULL;
            }
            if ($academic_year == -1) {
                $academic_year = NULL;
            }
            if ($class_id == -1) {
                $class_id = NULL;
            }
            $details_data = $this->NModel->get_batch_data($stream_id, $academic_year, $session_id, $class_id, $flag_status);
            if (isset($details_data['error_status']) && $details_data['error_status'] == 0) {
                if ($details_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $details_data['data']));
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
            $this->load->view(ERROR_500);
        }
    }
    public function list_class_based_on_stream()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $stream_id = filter_input(INPUT_POST, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
            $academic_year = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_NUMBER_INT);
            $session_id = NULL;
            $flag_status = NULL;
            if ($stream_id == -1) {
                $stream_id = NULL;
            }
            if ($academic_year == -1) {
                $academic_year = NULL;
            }
            $details_data = $this->NModel->get_all_class($stream_id);
            if (isset($details_data['error_status']) && $details_data['error_status'] == 0) {
                if ($details_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'data' => $details_data['data']));
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
            $this->load->view(ERROR_500);
        }
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
}
