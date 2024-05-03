<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_activity_controller
 *
 * @author chandrajith.edsys
 */
class User_activity_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!(isLoggedin() == 1)) {
            if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
                header("HTTP/1.1 401 UNauthorized");
                die();
            } else {
                $path = base_url('login');
                redirect($path);
            }
        }
        $this->load->model('User_model', 'MUser');
        $this->load->model('Role_model', 'MRole');
        $this->load->model('Rolepermission_model', 'MRolePermission');
    }

    public function show_activities()
    {
        $data['template'] = 'activity/show_activity';
        $data['title'] = 'USER MANAGEMENT';
        $data['sub_title'] = 'User Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '2' => array(
                'title' => 'User Management'
            )
        );

        $data['bread_crump_data'] = bread_crump_maker($breadcrump);

        $role_data = $this->MRole->get_all_role_list();

        if ($role_data['error_status'] == 0 && $role_data['data_status'] == 1) {
            $data['role_data'] = $role_data['data'];
            $data['message'] = "";
        } else {
            $data['role_data'] = FALSE;
            $data['message'] = $role_data['message'];
        }
        $data['role_data'] = $role_data['data'];

        $page = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_STRING);
        $user_data = $this->MUser->get_all_user_list($page);
        if ($user_data['error_status'] == 0 && $user_data['data_status'] == 1) {
            $data['user_data'] = $user_data['data'];
            $data['message'] = "";
        } else {
            $data['user_data'] = FALSE;
            $data['message'] = $user_data['message'];
        }
        $data['user_data'] = $user_data['data'];
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if ($this->input->is_ajax_request() == 1) {
            if ($data['user_data'])
                echo json_encode(array('status' => 1, 'view' => $this->load->view('activity/show_usern_activity', $data, TRUE)));
            else
                echo json_encode(array('status' => 0, 'view' => ""));
        } else {
            $this->load->view('template/home_template', $data);
        }
    }

    public function update_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $role_id = filter_input(INPUT_POST, 'role_id', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($role_id);die;
            if (isset($role_id) && !empty($role_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['$role_id'] = filter_input(INPUT_POST, 'role_id', FILTER_SANITIZE_STRING);
                $status = $this->MRole->edit_status_role($data_prep);
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

    public function show_single_user_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_STRING);
            if (!empty($userid)) {
                $user_data = $this->MUser->get_user_data($userid);
                if (isset($user_data['data_status']) && !empty($user_data['data_status']) && isset($user_data['data'][0])) {
                    $data['user_data'] = $user_data['data'][0];
                } else {
                    $data['user_data'] = NULL;
                }
                $user_role = $this->MUser->get_role_data($userid);
                if (isset($user_role) && !empty($user_role)) {
                    $data['user_role'] = $user_role['data'];
                } else {
                    $data['user_role'] = NULL;
                }

                $role_data = $this->MRole->get_all_role_list_for_employee();
                if ($role_data['error_status'] == 0 && $role_data['data_status'] == 1) {
                    $data['role_data'] = $role_data['data'];
                } else {
                    $data['role_data'] = FALSE;
                }

                $user_activity = $this->MRole->get_all_user_activity($userid);
                if ($user_activity['error_status'] == 0 && $user_activity['data_status'] == 1) {
                    $data['activity_data'] = $user_activity['data'];
                } else {
                    $data['activity_data'] = FALSE;
                }
            }
            echo json_encode(array('status' => 1, 'view' => $this->load->view('activity/show_user', $data, TRUE)));
        } else {
            echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => FALSE, 'view' => FALSE));
        }
    }

    public function show_single_role_data()
    {
        if ($this->input->is_ajax_request() == 1) {
            $roleid = filter_input(INPUT_POST, 'roleid', FILTER_SANITIZE_STRING);
            $roledata = $this->MRole->get_role_data($roleid);
            $permissiondata = $this->MRole->get_rolepermissions_data($roleid);
            //            dev_export($permissiondata);die;
            if (isset($roledata['data_status']) && !empty($roledata['data_status']) && isset($roledata['data'][0])) {
                $data['role'] = $roledata['data'][0];
            } else {
                $data['role'] = NULL;
            }
            if (isset($permissiondata['data_status']) && !empty($permissiondata['data_status']) && isset($permissiondata['data'][0])) {
                $data['permissiondata'] = $permissiondata['data'];
            } else {
                $data['permissiondata'] = NULL;
            }
            if (!empty($roleid)) {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('activity/show_role', $data, TRUE)));
                return TRUE;
            } else {
                echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => FALSE, 'view' => FALSE));
            }
        }
    }

    public function add_new_role_loader()
    {
        if ($this->input->is_ajax_request() == 1) {
            echo json_encode(array('status' => 1, 'view' => $this->load->view('activity/add_role', '', TRUE)));
            return true;;
        }
    }

    public function show_permission_data()
    {

        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '2' => array(
                'title' => 'User fgjhgjhgf'
            )
        );

        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        if ($this->input->is_ajax_request() == 1) {
            $roleid = filter_input(INPUT_POST, 'roleid', FILTER_SANITIZE_NUMBER_INT);
            if ($roleid) {
                //                show_user_permission
                $roledata = $this->MRole->get_role_data($roleid);
                if (isset($roledata['data_status']) && !empty($roledata['data_status']) && isset($roledata['data'][0])) {
                    $data_role['role'] = $roledata['data'][0];
                } else {
                    $data_role['role'] = NULL;
                }
                $app_module = $this->MRolePermission->get_appmodules();
                //                dev_export($app_module);die;
                if (isset($app_module['data_status']) && !empty($app_module['data_status']) && $app_module['data_status'] == 1) {
                    $data_role['module_list'] = $app_module['data'];
                } else {
                    $data_role['module_list'] = NULL;
                }
                //                dev_export($data_role);die;
                $data['role_view'] = $this->load->view('activity/show_role_permission_view', $data_role, TRUE);
                $data['sub_title'] = "ROLE PERMISSION";

                $data_permission['roleid'] = $roleid;
                $app_module = $this->MRolePermission->get_appmodules();
                $apppage_temp = $this->MRolePermission->get_appmenus();

                //                dev_export($apppage_temp);die;
                if (isset($apppage_temp) && !empty($apppage_temp) && isset($apppage_temp['data']) && !empty($apppage_temp['data'])) {
                    $data_permission['apppages'] = json_decode(json_encode($apppage_temp['data']), TRUE);
                } else {
                    $data_permission['apppages'] = NULL;
                }

                $check_permissions_raw = $this->MRolePermission->get_roles_privileges($roleid);
                if (isset($check_permissions_raw['data']) && !empty($check_permissions_raw['data'])) {
                    $check_permissions = $check_permissions_raw['data'];
                } else {
                    $check_permissions = NULL;
                }
                if (isset($check_permissions) && !empty($check_permissions)) {
                    $data_permission['assigned_roles'] = json_decode(json_encode($check_permissions), TRUE);
                    $data['permission_view_data'] = $this->load->view('activity/show_permissions_edit', $data_permission, TRUE);
                } else {
                    $data['permission_view_data'] = $this->load->view('activity/show_permissions', $data_permission, TRUE);
                }





                echo json_encode(array('status' => 1, 'view' => $this->load->view('activity/show_user_permission', $data, TRUE)));
                return true;
            } else {
            }
        }
    }

    public function search_activities()
    {
        $data['template'] = 'activity/show_activity';
        $data['title'] = 'USER MANAGEMENT';
        $data['sub_title'] = 'User Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '2' => array(
                'title' => 'User Management'
            )
        );
        $user_search_flag = 0;
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);

        $query_string1 = filter_input(INPUT_POST, 'search_role', FILTER_SANITIZE_STRING);
        if (strlen($query_string1) > 0) {
            $role_data = $this->MRole->search_role_list(str_replace(' ', '%', $query_string1));
            $user_search_flag = 0;
        } else {
            $role_data = $this->MRole->get_all_role_list();
            $user_search_flag = 0;
        }

        if ($role_data['error_status'] == 0 && $role_data['data_status'] == 1) {
            $data['role_data'] = $role_data['data'];
            $data['message'] = "";
        } else {
            $data['role_data'] = FALSE;
            $data['message'] = $role_data['message'];
        }
        $data['role_data'] = $role_data['data'];

        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if ($this->input->is_ajax_request() == 1) {
            echo json_encode(array('status' => 1, 'view' => $this->load->view('activity/show_role_activity_view', $data, TRUE)));
        } else {
            $this->load->view('template/home_template', $data);
        }
    }

    public function show_activities_user()
    {
        $data['template'] = 'activity/show_activity';
        $data['title'] = 'USER MANAGEMENT';
        $data['sub_title'] = 'User Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '2' => array(
                'title' => 'User Management'
            )
        );
        $user_search_flag = 0;
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $query_string = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
        if (strlen($query_string) > 0) {
            $user_data = $this->MUser->search_user_list(str_replace(' ', '%', $query_string));
            $user_search_flag = 1;
        } else {
            $page = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_STRING);
            $user_data = $this->MUser->get_all_user_list($page);
            $user_search_flag = 1;
        }


        if ($user_data['error_status'] == 0 && $user_data['data_status'] == 1) {
            $data['user_data'] = $user_data['data'];
            $data['message'] = "";
        } else {
            $data['user_data'] = FALSE;
            $data['message'] = $user_data['message'];
        }
        $data['user_data'] = $user_data['data'];
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'city');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if ($this->input->is_ajax_request() == 1) {
            if ($user_search_flag == 1) {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('activity/show_usern_activity', $data, TRUE)));
            }
        } else {
            $this->load->view('template/home_template', $data);
        }
    }


    public function change_user_password()
    {

        $Emp_id = filter_input(INPUT_POST, 'Emp_id', FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (null !== filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)) {
            $user_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        } else {
            echo json_encode(array('status' => 0));
            return true;
        }

        $old_password = filter_input(INPUT_POST, 'old_password', FILTER_SANITIZE_STRING);


        $user_data = $this->MUser->change_userpasscode($Emp_id, $email, $user_password, $old_password);

        if ($user_data['error_status'] == 0 && $user_data['data_status'] == 1) {
            echo json_encode(array('status' => 1, 'data' => $user_data['data']));
            return true;
        } else {
            echo json_encode(array('status' => 2));
            return true;
        }
    }

    public function set_user_roles()
    {

        $facultyid = filter_input(INPUT_POST, 'facultyid', FILTER_SANITIZE_NUMBER_INT);
        $roleid = filter_input(INPUT_POST, 'roleid');


        $user_data = $this->MUser->set_roles($facultyid, $roleid);

        if ($user_data['error_status'] == 0 && $user_data['data_status'] == 1) {
            echo json_encode(array('status' => 1));
            return true;
        } else {
            echo json_encode(array('status' => 2));
            return true;
        }
    }

    public function user_roles_save()
    {

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);



            $this->form_validation->set_rules('role_name', '  role_name', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('description', 'description', 'trim|required|min_length[3]|max_length[50]');

            if ($this->form_validation->run() == TRUE) {
                $data_prep['role_name'] = (filter_input(INPUT_POST, 'role_name', FILTER_SANITIZE_STRING));
                $data_prep['description'] = (filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
                if (filter_input(INPUT_POST, 'isinrole', FILTER_SANITIZE_NUMBER_INT) == 0) {
                    $data_prep['isinrole'] = -1;
                } else {
                    $data_prep['isinrole'] = 1;
                }

                $status = $this->MRole->save_role($data_prep);
                if (is_array($status) && $status['status'] == 1) {
                    $this->session->set_flashdata('success_message', $data_prep['role_name'] . " Added Successfully");
                    echo json_encode(array('status' => 1, 'view' => '', 'id' => $status['id']));
                    return;
                } else {
                    $data['role_name'] = filter_input(INPUT_POST, 'role_name', FILTER_SANITIZE_STRING);
                    $data['description'] = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

                    $this->session->set_flashdata('error_message', $status['message']);
                    echo json_encode(array('status' => 2, 'view' => $this->load->view('activity/add_role', $data, TRUE), 'message' => $status['message']));
                    return;
                }
            } else {
                $data['role_name'] = filter_input(INPUT_POST, 'role_name', FILTER_SANITIZE_STRING);
                $data['description'] = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

                echo json_encode(array('status' => 3, 'view' => $this->load->view('activity/show_usern_activity', $data, TRUE), 'message' => ''));
                return;
            }
        }
    }

    public function user_roles_update()
    {

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);

            $this->form_validation->set_rules('role_name', '  role_name', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('description', 'description', 'trim|required|min_length[3]|max_length[50]');

            if ($this->form_validation->run() == TRUE) {
                $data_prep['role_name'] = (filter_input(INPUT_POST, 'role_name', FILTER_SANITIZE_STRING));
                $data_prep['description'] = (filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
                $data_prep['isinrole'] = (filter_input(INPUT_POST, 'isinrole', FILTER_SANITIZE_NUMBER_INT));
                $data_prep['role_id'] = filter_input(INPUT_POST, 'role_id', FILTER_SANITIZE_NUMBER_INT);

                $status = $this->MRole->update_role($data_prep);
                if (is_array($status) && $status['status'] == 1) {

                    $this->session->set_flashdata('success_message', " Role Updated Successfully");
                    echo json_encode(array('status' => 1, 'view' => '', 'id' => $status['id']));
                    //                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    $data['role_name'] = filter_input(INPUT_POST, 'role_name', FILTER_SANITIZE_STRING);
                    $data['description'] = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

                    $this->session->set_flashdata('error_message', $status['message']);
                    echo json_encode(array('status' => 2, 'view' => $this->load->view('activity/show_usern_activity', $data, TRUE), 'message' => $status['message']));
                    return;
                }
            } else {
                $data['role_name'] = filter_input(INPUT_POST, 'role_name', FILTER_SANITIZE_STRING);
                $data['description'] = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

                echo json_encode(array('status' => 3, 'view' => $this->load->view('activity/show_usern_activity', $data, TRUE), 'message' => ''));
                return;
            }
        }
    }

    public function showpermission()
    {
        if ($this->input->is_ajax_request() == 1) {
            $roleid = filter_input(INPUT_POST, 'roleid', FILTER_SANITIZE_STRING);
            $loadsave = filter_input(INPUT_POST, 'loadsave', FILTER_SANITIZE_STRING);
            $check_permissions_raw = $this->MRolePermission->get_roles_privileges($roleid);
            if (isset($check_permissions_raw['data']) && !empty($check_permissions_raw['data'])) {
                $check_permissions = $check_permissions_raw['data'];
            } else {
                $check_permissions = NULL;
            }
            if (isset($check_permissions) && !empty($check_permissions) && $loadsave != 1) {
                $data['title'] = 'Roles & Permission';
                $data['roleid'] = $roleid;
                $apppage_temp = $this->MRolePermission->get_appmenus();
                if (isset($apppage_temp) && !empty($apppage_temp) && isset($apppage_temp['data']) && !empty($apppage_temp['data'])) {
                    $data['apppages'] = json_decode(json_encode($apppage_temp['data']), TRUE);
                } else {
                    $data['apppages'] = NULL;
                }
                $data['assigned_roles'] = json_decode(json_encode($check_permissions), TRUE);
                $this->load->view('permissions/show_permissions_edit', $data);
            } else if (isset($loadsave) && !empty($loadsave) && $loadsave == 1) {

                $data_to_save = NULL;
                $data['title'] = 'Roles & Permission';
                $data['roleid'] = $roleid;
                $data_to_check_if_there_is_no_permission = 0;
                if (isset($_POST['operationuniqid'])) {
                    $appid = $_POST['operationuniqid'];
                    $data_to_check_if_there_is_no_permission = 1;
                } else {
                    $appid = NULL;
                }
                $i = 0;


                $userid = $this->session->userdata('userid');



                if (isset($appid) && !empty($appid)) {
                    foreach ($appid as $value) {
                        $result = explode(",", $value);
                        $data_to_save[] = array(
                            'apppagesuniqueid' => $result[0],
                            'operationuniqid' => $result[1]
                        );
                    }
                } else {
                    $data_to_save = NULL;
                }
                //                dev_export($data_to_check_if_there_is_no_permission);die;
                $status = $this->MRolePermission->add_rolesprivileges($data_to_save, $roleid);
                if (isset($status) && !empty($status) && isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Role permissions added successfully'));
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error', 'view' => ''));
                }
            } else {
                $data['title'] = 'Roles & Permission';
                $data['roleid'] = $roleid;
                $apppage_temp = $this->MRolePermission->get_appmenus();
                if (isset($apppage_temp) && !empty($apppage_temp) && isset($apppage_temp['data']) && !empty($apppage_temp['data'])) {
                    $data['apppages'] = json_decode(json_encode($apppage_temp['data']), TRUE);
                } else {
                    $data['apppages'] = NULL;
                }
                $this->load->view('user/set-role-permission', $data);
            }
        }
    }

    public function reload_role()
    {

        $role_data = $this->MRole->get_all_role_list();
        //dev_export( $role_data);die;
        if ($role_data['error_status'] == 0 && $role_data['data_status'] == 1) {
            $data['role_data'] = $role_data['data'];
            $data['message'] = "";
        } else {
            $data['role_data'] = FALSE;
            $data['message'] = $role_data['message'];
        }
        $data['role_data'] = $role_data['data'];

        echo json_encode(array('status' => 1, 'view' => $this->load->view('activity/role_reload', $data, TRUE)));
    }
}
