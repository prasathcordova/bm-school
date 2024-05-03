<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Caste_management_controller
 *
 * @author chandrajith.edsys
 */
class Caste_management_controller extends MX_Controller
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
        $this->load->model('Caste_model', 'MCaste');
    }


    public function show_caste()
    {
        //        $data['template'] = 'caste/show_caste';
        //        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'CASTE MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Caste Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $caste_data = $this->MCaste->get_all_caste_list();

        if ($caste_data['error_status'] == 0 && $caste_data['data_status'] == 1) {
            $data['caste_data'] = $caste_data['data'];
            $data['message'] = "";
        } else {
            $data['caste_data'] = FALSE;
            $data['message'] = $caste_data['message'];
        }

        $this->session->set_userdata('current_page', 'caste');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['caste_data']) && !empty($data['caste_data'])) {
                foreach ($data['caste_data'] as $caste) {
                    $caste_status = "";
                    if ($caste['isactive'] == 1) {
                      //  $caste_status = '<a data-toggle="tooltip" data-placement="right" title="Slide for Enable/Disable" > <input type="checkbox" onchange="change_status(\'' . $caste['caste_id'] . '\', this)" checked id="" class="js-switch"  /></a>';
                      $caste_status='<div class="switch">
                      <div class="onoffswitch">
                      <input type="checkbox" checked class="onoffswitch-checkbox pick_status" 
                          onchange="change_status(\'' . $caste['caste_id'] . '\', this)" id="">
                          <label class="onoffswitch-label" for="\''.$caste['caste_id'].'\'">
                              <span class="onoffswitch-inner"></span>
                              <span class="onoffswitch-switch"></span>
                          </label>
                      </div>
                  </div>';
                    } else {
                      //  $caste_status = '<a data-toggle="tooltip" data-placement="right" title="Slide for Enable/Disable" ><input type="checkbox" data-toggle="tooltip" data-placement="right" title="Slide for Enable/Disable" onchange="change_status(\'' . $caste['caste_id'] . '\', this)" id="" class="js-switch"  /></a>';
                      $caste_status='<div class="switch">
                      <div class="onoffswitch">
                      <input type="checkbox" class="onoffswitch-checkbox pick_status" 
                          onchange="change_status(\'' . $caste['caste_id'] . '\', this)" id="">
                          <label class="onoffswitch-label" for="\''.$caste['caste_id'].'\'">
                              <span class="onoffswitch-inner"></span>
                              <span class="onoffswitch-switch"></span>
                          </label>
                      </div>
                  </div>';
                    }
                    $task_html = '<a href="javascript:void(0);" class="btn btn-xs btn-info" onclick="edit_caste(\'' . $caste['caste_id'] . '\',\'' . $caste['caste_name'] . '\',\'' . $caste['religion_name'] . '\',\'' . $caste['community_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $caste['caste_name'] . '" data-original-title="' . $caste['caste_name'] . '"  ><i class="fa fa-edit" ></i>Update</a>';
                    $formatted_data[] = array($caste['caste_name'], $caste['religion_name'], $caste['community_name'], $caste_status, $task_html);
                }
            }
            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('caste/show_caste', $data);
        }
    }

    public function add_caste()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Caste Management', 'status' => 0, 'link' => base_url('caste/show-caste')),
                2 => array('message' => 'Add New Caste', 'status' => 1)
            );

            $relegion = $this->MCaste->get_all_relegion();
            if (isset($relegion['error_status']) && $relegion['error_status'] == 0) {
                if ($relegion['data_status'] == 1) {
                    $data['relegion_data'] = $relegion['data'];
                } else {
                    $data['relegion_data'] = FALSE;
                }
            } else {
                $data['relegion_data'] = FALSE;
            }
            $data['relegion_data'] = $relegion['data'];

            $community = $this->MCaste->get_all_community();
            //            dev_export($community);die;
            if (isset($community['error_status']) && $community['error_status'] == 0) {
                if ($community['data_status'] == 1) {
                    $data['community_data'] = $community['data'];
                } else {
                    $data['community_data'] = FALSE;
                }
            } else {
                $data['community_data'] = FALSE;
            }

            $data['panel_sub_header'] = 'Add New Caste';
            $data['breadcrumb'] = $breadcrumb;
            $data['title'] = 'ADD NEW CASTE';

            if ($onload == 1) {
                $this->load->view('caste/add_caste', $data);
            } else {
                $this->form_validation->set_rules('caste_name', 'Caste Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('religion_select', 'Religion', 'trim|required');
                $this->form_validation->set_rules('community_select', 'Community', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data_prep['caste_name'] = strtoupper(filter_input(INPUT_POST, 'caste_name', FILTER_SANITIZE_STRING));
                    $data_prep['religion_id'] = filter_input(INPUT_POST, 'religion_select', FILTER_SANITIZE_STRING);
                    $data_prep['community_id'] = filter_input(INPUT_POST, 'community_select', FILTER_SANITIZE_STRING);
                    $status = $this->MCaste->save_caste($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['caste_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['caste_name'] = filter_input(INPUT_POST, 'caste_name', FILTER_SANITIZE_STRING);
                        $data['religion_select'] = filter_input(INPUT_POST, 'religion_select', FILTER_SANITIZE_STRING);
                        $data['community_select'] = filter_input(INPUT_POST, 'community_select', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('caste/add_caste', $data, TRUE)));
                        return;
                    }
                } else {
                    $data['caste_name'] = filter_input(INPUT_POST, 'caste_name', FILTER_SANITIZE_STRING);
                    $data['religion_select'] = filter_input(INPUT_POST, 'religion_select', FILTER_SANITIZE_STRING);
                    $data['community_select'] = filter_input(INPUT_POST, 'community_select', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('caste/add_caste', $data, TRUE)));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_caste()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $caste_id = filter_input(INPUT_POST, 'caste_id', FILTER_SANITIZE_NUMBER_INT);
            $caste_name = strtoupper(filter_input(INPUT_POST, 'caste_name', FILTER_SANITIZE_STRING));

            if (isset($caste_id) && !empty($caste_id)) {
                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Caste Management', 'status' => 0, 'link' => base_url('caste/show-caste')),
                    2 => array('message' => 'Edit Caste', 'status' => 1)
                );
                $relegion = $this->MCaste->get_all_relegion();
                if (isset($relegion['error_status']) && $relegion['error_status'] == 0) {
                    if ($relegion['data_status'] == 1) {
                        $data['relegion_data'] = $relegion['data'];
                    } else {
                        $data['relegion_data'] = FALSE;
                    }
                } else {
                    $data['relegion_data'] = FALSE;
                }
                $data['relegion_data'] = $relegion['data'];

                $community = $this->MCaste->get_all_community();
                if (isset($community['error_status']) && $community['error_status'] == 0) {
                    if ($community['data_status'] == 1) {
                        $data['community_data'] = $relegion['data'];
                    } else {
                        $data['community_data'] = FALSE;
                    }
                } else {
                    $data['community_data'] = FALSE;
                }
                $data['title'] = 'EDIT CASTE - ' . $caste_name;
                $data['community_data'] = $community['data'];
                $data['panel_sub_header'] = 'Edit Caste - ';
                $data['breadcrumb'] = $breadcrumb;

                $this->session->set_userdata('current_page', 'caste');
                $this->session->set_userdata('current_parent', 'gen_sett');

                $caste_data_raw = $this->MCaste->get_caste_details($caste_id);

                if (is_array($caste_data_raw) && isset($caste_data_raw['data_status']) && !empty($caste_data_raw['data_status']) && $caste_data_raw['data_status'] == 1) {
                    $data['caste_data'] = $caste_data_raw['data'][0];

                    $data['panel_sub_header'] = 'Edit Caste - ' . $data['caste_data']['caste_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Caste / No data associated with this caste', 'data' => ''));
                    return;
                }
                if ($onload == 1) {
                    $view = $this->load->view('caste/edit_caste', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('caste_name', 'Caste Name', 'trim|required');
                    $this->form_validation->set_rules('religion_select', 'Religion', 'trim|required');
                    $this->form_validation->set_rules('community_select', 'Community', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['caste_id'] = filter_input(INPUT_POST, 'caste_id', FILTER_SANITIZE_STRING);
                        $data_prep['caste_name'] = strtoupper(filter_input(INPUT_POST, 'caste_name', FILTER_SANITIZE_STRING));
                        $data_prep['relegion_id'] = filter_input(INPUT_POST, 'religion_select', FILTER_SANITIZE_STRING);
                        $data_prep['community_id'] = filter_input(INPUT_POST, 'community_select', FILTER_SANITIZE_STRING);
                        $status = $this->MCaste->edit_save_caste($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['caste_name'] . "  Edited Successfully");
                            echo json_encode(array('status' => 1, 'view' => $this->load->view('caste/show_caste',$data,TRUE)));
                            return;
                        } else {
                            $data['caste_name'] = strtoupper(filter_input(INPUT_POST, 'caste_name', FILTER_SANITIZE_STRING));
                            $data['religion_select'] = filter_input(INPUT_POST, 'religion_select', FILTER_SANITIZE_STRING);
                            $data['community_select'] = filter_input(INPUT_POST, 'community_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('caste/edit_caste', $data, TRUE)));
                            return;
                        }
                    } else {
                        $data['caste_name'] = filter_input(INPUT_POST, 'caste_name', FILTER_SANITIZE_STRING);
                        $data['religion_select'] = filter_input(INPUT_POST, 'religion_select', FILTER_SANITIZE_STRING);
                        $data['community_select'] = filter_input(INPUT_POST, 'community_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('caste/edit_caste', $data, TRUE)));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Caste ID is provided / Invalid Caste', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $caste_id = filter_input(INPUT_POST, 'caste_id', FILTER_SANITIZE_NUMBER_INT);
            $community_id = filter_input(INPUT_POST, 'community_id', FILTER_SANITIZE_NUMBER_INT);
            $data['user_name'] = $this->session->userdata('user_name');
            if (isset($caste_id) && !empty($caste_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['caste_id'] = filter_input(INPUT_POST, 'caste_id', FILTER_SANITIZE_STRING);
                $data_prep['community_id'] = filter_input(INPUT_POST, 'community_id', FILTER_SANITIZE_STRING);
                $status = $this->MCaste->edit_status_caste($data_prep);
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
}
