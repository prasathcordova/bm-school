<?php

/**
 * Description of authenticator_controller
 *
 * @author aju.docme
 */
class Authenticator_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Authenticator_model', 'MAuthenticator');
    }

    public function login()
    {
        if ($this->input->is_ajax_request() == 1) {
            if (null !== filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL)) {
                $user_email = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }
            if (null !== filter_input(INPUT_POST, 'passcode', FILTER_SANITIZE_EMAIL)) {
                $user_password = filter_input(INPUT_POST, 'passcode', FILTER_SANITIZE_EMAIL);
            } else {
                echo json_encode(array('status' => 0));
                return true;
            }

            $data_prep = array(
                'user_email' => $user_email,
                'user_passcode' => $user_password
            );

            $status = $this->MAuthenticator->check_login($data_prep);


            if (is_array($status) && $status['data_status'] == 1 && $status['data']['status'] == 1) {

                $this->session->set_userdata('API-Key', $status['data']['apikey']);
                $this->session->set_userdata('isloggedin', '1');
                $this->session->set_userdata('userid', $status['data']['userid']);
                $this->session->set_userdata('emailid', $user_email);
                $profile_image = base_url('assets/img/a0.jpg');
                $user_data = $this->MAuthenticator->get_user_details($user_email);

                $general_inst_details = $this->MAuthenticator->get_user_inst_details();

                if (isset($general_inst_details['data_status']) && !empty($general_inst_details['data_status']) && $general_inst_details['data_status'] == 1 && isset($general_inst_details['data']) && !empty($general_inst_details['data'])) {
                    $currencyid = $general_inst_details['data']['Home_Currency'];
                    $inst_currency_details = $this->MAuthenticator->get_inst_currency_details($currencyid);
                    if (isset($inst_currency_details['data_status']) && !empty($inst_currency_details['data_status']) && $inst_currency_details['data_status'] == 1 && isset($inst_currency_details['data']) && !empty($inst_currency_details['data'])) {
                        $this->session->set_userdata('Currency_name', $inst_currency_details['data']['currency_name']);
                        $this->session->set_userdata('Currency_abbr', $inst_currency_details['data']['currency_abbr']);
                        $this->session->set_userdata('Currency_font', $inst_currency_details['data']['currency_font']);
                    } else {
                        $this->session->set_userdata('Currency_name', 'INDIAN RUPEE');
                        $this->session->set_userdata('Currency_abbr', 'INR');
                        $this->session->set_userdata('Currency_font', 'fa-inr');
                    }
                    $this->session->set_userdata('inst_id', $general_inst_details['data']['inst_id']);
                    $this->session->set_userdata('store_id', $general_inst_details['data']['store_id']);
                    $this->session->set_userdata('Institution_Name', $general_inst_details['data']['Institution_Name']);
                    $this->session->set_userdata('Institution_Place', $general_inst_details['data']['Institution_Place']);
                    $this->session->set_userdata('Institution_Address', $general_inst_details['data']['Institution_Address']);
                    $this->session->set_userdata('Institution_Pobox', $general_inst_details['data']['Institution_Pobox']);
                    $this->session->set_userdata('Institution_Email', $general_inst_details['data']['Institution_Email']);
                    $this->session->set_userdata('Institution_Phone', $general_inst_details['data']['Institution_Phone']);
                    $this->session->set_userdata('Institution_Url', $general_inst_details['data']['Institution_Url']);
                    $this->session->set_userdata('Home_Currency', $general_inst_details['data']['Home_Currency']);
                    $this->session->set_userdata('acd_year', $general_inst_details['data']['Academic_Year']);
                    $this->session->set_userdata('acd_year_start', $general_inst_details['data']['Acd_year_start']);
                    $this->session->set_userdata('acd_year_end', $general_inst_details['data']['Acd_year_end']);
                    $this->session->set_userdata('TRN_Number', $general_inst_details['data']['TRN_Number']);
                    $this->session->set_userdata('TAXNAME', $general_inst_details['data']['TAXNAME']);
                    $this->session->set_userdata('TIMEZONE', $general_inst_details['data']['TIMEZONE']);
                    if (isset($general_inst_details['data']['AGE_LIMIT']) && !empty($general_inst_details['data']['AGE_LIMIT'])) {
                        $this->session->set_userdata('Age_Limit', $general_inst_details['data']['AGE_LIMIT']);
                    } else {
                        $this->session->set_userdata('Age_Limit', '0');
                    }
                    $this->session->set_userdata('Age_count', $general_inst_details['data']['AGE_COUNT_LIMIT']);
                    $this->session->set_userdata('is_store_user', $status['data']['store_user_status']);
                    $this->session->set_userdata('BILLTYPE', $general_inst_details['data']['BILLTYPE']);
                } else {
                    echo json_encode(array('status' => "0"));
                    return TRUE;
                }

                if (is_array($user_data) && $user_data['data_status'] == 1) {
                    $user_name = $user_data['data']['Emp_Name'];
                    $designation = $user_data['data']['Designation'];
                    if (isset($user_data['data']['profile_image']) && !empty($user_data['data']['profile_image'])) {
                        $profile_image = "data:image/jpeg;base64," . $user_data['data']['profile_image'];
                    } else {
                        if (isset($user_data['data']['profile_image_alternate']) && !empty($user_data['data']['profile_image_alternate'])) {
                            $profile_image = $user_data['data']['profile_image_alternate'];
                        } else {
                            $profile_image = base_url('assets/img/a0.jpg');
                        }
                    }
                } else {
                    $user_name = 'USER';
                    $designation = 'USER';
                    $profile_image = base_url('assets/img/a0.jpg');
                }

                $this->session->set_userdata('designation', $designation);
                $this->session->set_userdata('user_name', $user_name);
                $this->session->set_userdata('profile_image', $profile_image);

                $apppage = array();
                $operationid = array();
                $moduleid = array();
                $user_access = $this->MAuthenticator->get_role_access_info($status['data']['apikey']);
                if (isset($user_access['status']) && !empty($user_access['status']) && $user_access['status'] == 1) {
                    $user_role_access = $user_access['data'];
                    if (isset($user_role_access) && !empty($user_role_access)) {
                        foreach ($user_role_access as $access_data) {
                            $apppage[] = $access_data['apppagesuniqueid'];
                            $operationid[] = $access_data['operationuniqueid'];
                            $moduleid[] = $access_data['moduleid'];
                        }
                    }
                }
                $this->session->set_userdata(array(
                    'apppage' => $apppage,
                    'operationid' => $operationid,
                    'moduleid' => $moduleid
                ));

                if (isset($user_access['status']) && ($user_access['status'] == 0)) {
                    echo json_encode(array('status' => "0"));
                } else {
                    if ($this->session->userdata('is_store_user') == 1 && !check_permission(0, 0, 102))
                        echo json_encode(array('status' => 1, 'redirect_url' => base_url('substore/show-dashboard')));
                    else
                        echo json_encode(array('status' => 1, 'redirect_url' => base_url()));
                    return TRUE;
                }
            } else {
                echo json_encode(array('status' => "0"));
            }
        } else {
            //            dev_export(isLoggedin());die;;
            if (!(isLoggedin() == 1)) {
                $data['template'] = 'authenticate/login_view';
                $this->load->view('template/login_template', $data);
            } else {
                $path = base_url();
                redirect($path);
            }
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

    public function logout()
    {
        $this->session->set_userdata('API-Key', '');
        $this->session->set_userdata('isloggedin', '0');
        $this->session->set_userdata('userid', '');
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
