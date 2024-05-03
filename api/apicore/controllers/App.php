<?php

defined('BASEPATH') or exit('No direct script access allowed');

/* * get_particularpart
 * Description of App
 * Description : Handle APIs of App
 * @author AHB
 */

class App extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index_post()
    {
        if (!$this->post('action')) {
            $this->response(array('status' => FALSE, 'message' => 'Please specify the module name that need to be accessed.'));
        }
        $action = $this->post('action');
        $params = $this->post();
        switch ($action) {
            case ('login'):
                $controller_function = 'Authenticator/Authenticator_controller/app_login';
                $this->get_action($controller_function, $params);
                break;
            case ('get_vehicle'):
                $controller_function = 'Transport_settings/Vehicleregistration_controller/get_vehicleregistrationdetails';
                $params['is_row_array'] = 1;
                $this->get_action($controller_function, $params);
                break;
            case ('get_default_trip'):
                $controller_function = 'Transport_settings/Trip_controller/get_app_trip_default_vehicle';
                $params['default_trip'] = 1;
                $params['mode'] = "strict";
                $params['status'] = 1;
                $this->get_action($controller_function, $params);
                break;
            case ('get_trips'):
                $controller_function = 'Transport_settings/Trip_controller/get_app_trip_default_vehicle';
                $params['default_trip'] = 0;
                $params['mode'] = "strict";
                $params['status'] = 1;
                $this->get_action($controller_function, $params);
                break;
            case ('get_pickuppoints'):
                $controller_function = 'Transport_settings/Trip_controller/get_trip_pickuppoint_relation_data';
                $this->get_action($controller_function, $params);
                break;
            case ('get_trip_students'):
                $controller_function = 'Transport_settings/Trip_controller/get_all_student_transport_app_data';
                $this->get_action($controller_function, $params);
                break;
            case ('get_drop_students'):
                $controller_function = 'Transport_settings/Trip_controller/get_drop_student_transport_app_data';
                $this->get_action($controller_function, $params);
                break;
            case ('update_student_trip_status'):
                $controller_function = 'Transport_settings/Trip_controller/update_student_trip_status';
                $this->get_action($controller_function, $params);
                break;
            case ('change_password'):
                $controller_function = 'Transport_settings/Conductor_controller/update_conductor_password';
                $this->get_action($controller_function, $params);
                break;

            case ('get_pickedup_students'):
                $controller_function = 'Transport_settings/Trip_controller/get_picked_students_list';
                $this->get_action($controller_function, $params);
                break;
            case ('update_student_boarded_status'):
                $controller_function = 'Transport_settings/Trip_controller/update_student_boarded_status';
                $this->get_action($controller_function, $params);
                break;
            case ('update_drop_student_boarded_status'):
                $controller_function = 'Transport_settings/Trip_controller/update_drop_student_boarded_status';
                $this->get_action($controller_function, $params);
                break;
            case ('get_all_students_report'):
                $controller_function = 'Transport_settings/Trip_controller/get_all_students_report';
                $this->get_action($controller_function, $params);
                break;
            case ('get_manager_contact'):
                $controller_function = 'Transport_settings/Trip_controller/get_manager_contact';
                $this->get_action($controller_function, $params);
                break;
            case ('notify_alert'):
                $controller_function = 'Transport_settings/Trip_controller/notify_alert';
                $this->get_action($controller_function, $params);
                break;
            case ('get_student_by_admn_no'):
                $controller_function = 'Transport_settings/Trip_controller/get_student_by_admn_no';
                $this->get_action($controller_function, $params);
                break;
            case ('getFeeData'):
                $controller_function = 'Fees_settings/Onlinepay_controller/getFeeData';
                $this->get_action_Fee($controller_function, $params);
                break;
            case ('Online_response'):
                $controller_function = 'Fees_settings/Onlinepay_controller/Online_response';
                $this->get_action_Fee($controller_function, $params);
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
