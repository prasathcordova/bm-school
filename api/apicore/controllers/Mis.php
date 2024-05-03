<?php

defined('BASEPATH') or exit('No direct script access allowed');

/* * get_particularpart
 * Description of Mis
 * Description : Handle APIs of App
 * @author Remya
 */

class Mis extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index_post()
    {
        // echo "sfdf";die;
        if (!$this->post('action')) {
            $this->response(array('status' => FALSE, 'message' => 'Please specify the module name that need to be accessed.'));
        }
        $action = $this->post('action');
        $params = $this->post();
        switch ($action) {
            case ('login_user'):
                $controller_function = 'Authenticator/Authenticator_controller/mis_login_user';
                $this->get_action($controller_function, $params);
                break;
            case ('user_data'):
                $controller_function = 'Authenticator/Authenticator_controller/get_user_list';
                $this->get_action($controller_function, $params);
                break;
            case ('get_inst_details'):
                $controller_function = 'Authenticator/Authenticator_controller/mis_get_inst_details';
                $this->get_action($controller_function, $params);
                break;                
            case ('currency_data'):
                $controller_function = 'Authenticator/Authenticator_controller/currency_details';
                $this->get_action($controller_function, $params);
                break;
            case ('get_role_permission_of_user'):
                $controller_function = 'General_settings/Roles_controller/get_role_permission_of_user';
                $this->get_action($controller_function, $params);
                break;
            case ('get_student_strength_rpt'):
                $controller_function = 'Report_settings/Report_controller/get_strength_details';
                $this->get_action($controller_function, $params);
                break;
            case ('long_absentees'):
                $controller_function = 'Report_settings/Report_controller/get_long_absantee_details';
                $this->get_action($controller_function, $params);
                break;
            case ('Long_Absentee_Count'):
                $controller_function = 'Report_settings/Report_controller/get_long_abstee_count';
                $this->get_action($controller_function, $params);
                break;
            case ('TC'):
                $controller_function = 'Report_settings/Report_controller/get_long_abstee_count';
                $this->get_action($controller_function, $params);
                break;
            case ('Long_Absentees_Released'):
                $controller_function = 'Report_settings/Report_controller/get_long_absantee_details';
                $this->get_action($controller_function, $params);
                break;
            case ('TC_Applied'):
                $controller_function = 'Report_settings/Report_controller/get_tc_details';
                $this->get_action($controller_function, $params);
                break;
            case ('TC_Issued'):
                $controller_function = 'Report_settings/Report_controller/get_tc_details';
                $this->get_action($controller_function, $params);
                break;
            case ('FEE_NOT_DEM'):
                $controller_function = 'Report_settings/Report_controller/get_not_demand';
                $this->get_action($controller_function, $params);
                break;
            case ('FEE_CONS'):
                $controller_function = 'Report_settings/Report_controller/get_fee_cons';
                $this->get_action($controller_function, $params);
                break;
            case ('FEE_EX'):
                $controller_function = 'Report_settings/Report_controller/get_fee_exemption';
                $this->get_action($controller_function, $params);
                break;
            case ('CHEQUE'):
                $controller_function = 'Report_settings/Report_controller/get_fee_exemption';
                $this->get_action($controller_function, $params);
                break;
            case ('FEE_EX_DETAIL'):
                $controller_function = 'Report_settings/Report_controller/get_exemption';
                $this->get_action($controller_function, $params);
                break;
            case ('FEE_CONS_DETAIL'):
                $controller_function = 'Report_settings/Report_controller/get_exemption';
                $this->get_action($controller_function, $params);
                break;
            case ('CHEQUE_DETAILS'):
                $controller_function = 'Report_settings/Report_controller/get_exemption';
                $this->get_action($controller_function, $params);
                break;
            case ('CHEQUE_COUNT_DETAILS'):
                $controller_function = 'Report_settings/Report_controller/get_exemption';
                $this->get_action($controller_function, $params);
                break;
            case ('FEE_ARREAR'):
                $controller_function = 'Report_settings/Report_controller/get_exemption';
                $this->get_action($controller_function, $params);
                break;
            case ('FEE_ARREAR_LA'):
                $controller_function = 'Report_settings/Report_controller/get_exemption';
                $this->get_action($controller_function, $params);
                break;
            case ('STUD_CLASS'):
                $controller_function = 'Report_settings/Report_controller/get_exemption';
                $this->get_action($controller_function, $params);
                break;
            case ('NOT_DEMAND_DETAILS'):
                $controller_function = 'Report_settings/Report_controller/get_exemption';
                $this->get_action($controller_function, $params);
                break;
            case ('EXEMPTION'):
                $controller_function = 'Report_settings/Report_controller/get_exemption_list';
                $this->get_action($controller_function, $params);
                break;
            case ('SAVE_EXEMPTION'):
                $controller_function = 'Report_settings/Report_controller/save_exemption';
                $this->get_action($controller_function, $params);
                break;
            case ('GRAPH'):
                $controller_function = 'Report_settings/Report_controller/get_graph_details';
                $this->get_action($controller_function, $params);
                break;
            case ('TOTAL_SUMMARY'):
                $controller_function = 'Report_settings/Report_controller/get_graph_details';
                $this->get_action($controller_function, $params);
                break;
            case ('EXEMPTION_SUGGESTED'):
                $controller_function = 'Report_settings/Report_controller/get_exemption_list';
                $this->get_action($controller_function, $params);
                break;
            case ('EXEMPTION_SUGGESTED_DETAILS'):
                $controller_function = 'Report_settings/Report_controller/get_exemption_list';
                $this->get_action($controller_function, $params);
                break;
            case ('EXEMPTION_SUGGESTED_BY_DATE'):
                $controller_function = 'Report_settings/Report_controller/get_exemption_list';
                $this->get_action($controller_function, $params);
                break;
            case ('EXEMPTION_APPROVED_DETAILS'):
                $controller_function = 'Report_settings/Report_controller/get_exemption_list';
                $this->get_action($controller_function, $params);
                break;
            case ('EXEMPTION_APPROVED_DETAILS_BY_DATE'):
                $controller_function = 'Report_settings/Report_controller/get_exemption_list';
                $this->get_action($controller_function, $params);
                break;
            case ('EXEMPTION_APPROVED_REMARKS'):
                $controller_function = 'Report_settings/Report_controller/get_exemption_list';
                $this->get_action($controller_function, $params);
                break;
            case ('EXEMPTION_REJECTED_DETAILS'):
                $controller_function = 'Report_settings/Report_controller/get_exemption_list';
                $this->get_action($controller_function, $params);
                break;
            case ('EXEMPTION_REJECTED_BY_DATE'):
                $controller_function = 'Report_settings/Report_controller/get_exemption_list';
                $this->get_action($controller_function, $params);
                break;
            case ('EXEMPTION_REJECTED_REMARKS'):
                $controller_function = 'Report_settings/Report_controller/get_exemption_list';
                $this->get_action($controller_function, $params);
                break;
            case ('APPROVE_EXEMPTION_BY_GROUP'):
                $controller_function = 'Report_settings/Report_controller/approve_exemption_group';
                $this->get_action($controller_function, $params);
                break;
            case ('UPDATE_PASSWORD'):
                $controller_function = 'Authenticator/Authenticator_controller/update_password';
                $this->get_action($controller_function, $params);
                break;
            case ('EXEMPTION_SORT'):
                $controller_function = 'Report_settings/Report_controller/exemption_group_sorting';
                $this->get_action($controller_function, $params);
                break;
            case ('EXEMPTION_COUNT'):
                $controller_function = 'Report_settings/Report_controller/exemption_count';
                $this->get_action($controller_function, $params);
                break;
            case ('ACD_YEAR_DETAILS'):
                $controller_function = 'Authenticator/Authenticator_controller/acd_year_details';
                $this->get_action($controller_function, $params);
                break;
            case ('MAIL_DATA'):
                $controller_function = 'Report_settings/Report_controller/get_mail_details';
                $this->get_action($controller_function, $params);
                break;
            case ('ARREAR_COMPARISON'):
                $controller_function = 'Report_settings/Report_controller/get_arrear_details';
                $this->get_action($controller_function, $params);
                break;
            case ('DEMANDABLE_FEES'):
                $controller_function = 'Report_settings/Report_controller/get_statistical_details';
                $this->get_action($controller_function, $params);
                break;
            case ('NON_DEMANDABLE_FEES'):
                $controller_function = 'Report_settings/Report_controller/get_statistical_details';
                $this->get_action($controller_function, $params);
                break;
            case ('MONTHLY_SUMMARY'):
                $controller_function = 'Report_settings/Report_controller/get_statistical_details';
                $this->get_action($controller_function, $params);
                break;

        }
    }

    public function get_action($controller_function, $params)
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            if (isset($params['is_row_array'])) {
                $array_result = Modules::run($controller_function, $params);
                $array_result['data'] = $array_result['data'][0];
                $result_data = $array_result;
            } else {
                $result_data = Modules::run($controller_function, $params);
            }
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => $result_data));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_action_Fee($controller_function, $params)
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            if (isset($params['is_row_array'])) {
                $array_result = Modules::run($controller_function, $params);
                $array_result['data'] = $array_result['data'][0];
                $result_data = $array_result;
            } else {
                $result_data = Modules::run($controller_function, $params);
            }
            $this->response($result_data);
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
}
