<?php

/**
 * Description of Fee template_controller
 *
 * @author chandrajith.edsys
 */
class Feetemplate_controller extends MX_Controller
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
        $this->load->model('Feetemplate_model', 'MFee_template');
    }

    public function show_fee_templates()
    {
        $data['sub_title'] = 'Periodic Fees Template';
        $inst_id = $this->session->userdata('inst_id');
        $cur_acd_year = $this->session->userdata('acd_year');
        $template_list = $this->MFee_template->get_all_available_template($inst_id, $cur_acd_year);
        if (isset($template_list['data']) && !empty($template_list['data'])) {
            $data['template_data'] = $template_list['data'];
        } else {
            $data['template_data'] = NULL;
        }
        $this->load->view('fee_templates/show_fee_template', $data);
    }

    public function create_fee_template()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Add New Fee Template';
            $class = $this->MFee_template->get_all_class();
            if (isset($class['error_status']) && $class['error_status'] == 0 && $class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
            $this->load->view('fee_templates/add_fee_template', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_new_template()
    {
        if ($this->input->is_ajax_request() == 1) {
            $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
            $template_desc = filter_input(INPUT_POST, 'template_desc', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');
            $template_classes = $_POST['classes'];
            $data = array(
                'template_name' => $template_name,
                'template_desc' => $template_desc,
                'class_selector' => $template_classes
            );
            $data['title'] = 'Add New Fee Template';
            $class = $this->MFee_template->get_all_class();
            if (isset($class['error_status']) && $class['error_status'] == 0 && $class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
            $this->form_validation->set_rules('template_name', 'Template name', 'trim|required|min_length[2]|max_length[40]'); //
            $this->form_validation->set_rules('template_desc', 'Template description', 'trim|required|min_length[2]'); //|max_length[30]

            if ($this->form_validation->run() == TRUE) {
                $data_to_save = array(
                    'action' => 'save_fee_template',
                    'inst_id' => $inst_id,
                    'template_name' => $template_name,
                    'template_desc' => $template_desc,
                    'acd_year_id' => $this->session->userdata('acd_year'),
                    'class_detail_id' => json_encode($template_classes)
                );
                $template_data = $this->MFee_template->save_fee_template($data_to_save);
                if (isset($template_data['data_status']) && !empty($template_data['data_status']) && $template_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfullly.'));
                    return true;
                } else {
                    $message = '';
                    if (isset($template_data['message']) && !empty($template_data['message'])) {
                        $message = $template_data['message'];
                    } else {
                        $message = 'Please check if the entered values are valid.';
                    }
                    echo json_encode(array(
                        'status' => 2,
                        'view' => $this->load->view('fee_templates/show_fee_template', $data, TRUE),
                        'message' => $message
                    ));
                    return true;
                }
            } else {

                echo json_encode(array(
                    'status' => 3,
                    'view' => $this->load->view('fee_templates/show_fee_template', $data, TRUE),
                    'message' => 'Enter valid values'
                ));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function get_edit_fee_template()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'Add New Fee Template';
            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
            $data['title'] = 'EDIT - ' . $template_name;

            $class = $this->MFee_template->get_all_class();
            if (isset($class['error_status']) && $class['error_status'] == 0 && $class['data_status'] == 1) {
                $data['class_data'] = $class['data'];
            } else {
                $data['class_data'] = FALSE;
            }
            $inst_id = $this->session->userdata('inst_id');
            $cur_acd_year = $this->session->userdata('acd_year');
            $template_data = $this->MFee_template->get_template_for_edit($template_id, $inst_id, $cur_acd_year);

            if (isset($template_data['data']) && !empty($template_data['data'])) {
                $data['id'] = $template_data['data'][0]['id'];
                $data['template_name'] = $template_data['data'][0]['template_name'];
                $data['template_desc'] = $template_data['data'][0]['template_desc'];
                $data['isactive'] = $template_data['data'][0]['isactive'];
                $data['islinked'] = $template_data['data'][0]['islinked'];
                $data['is_student_linked'] = $template_data['data'][0]['is_student_linked'];
                $data['acd_year_id'] = $template_data['data'][0]['acd_year_id'];
                if (isset($template_data['data'][0]['class_details']) && !empty($template_data['data'][0]['class_details'])) {
                    $data['template_class_data'] = json_decode($template_data['data'][0]['class_details'], TRUE);
                    //$data['current_class_data'] = json_decode($template_data['data'][0]['class_details']['linked_class_detail_id'], TRUE);
                } else {
                    $data['template_class_data'] = NULL;
                    //$data['current_class_data'] = NULL;
                }
                //dev_export($template_data);die;
                echo json_encode(array(
                    'status' => 1,
                    'view' => $this->load->view('fee_templates/edit_fee_template', $data, TRUE),
                    'message' => 'Template data is loaded'
                ));
                return true;
            } else {
                echo json_encode(array(
                    'status' => 2,
                    'message' => 'Data is not available'
                ));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_edit_fee_template()
    {
        if ($this->input->is_ajax_request() == 1) {
            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            if ($template_id) {
                $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
                $template_desc = filter_input(INPUT_POST, 'template_desc', FILTER_SANITIZE_STRING);
                $title_data = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                $inst_id = $this->session->userdata('inst_id');
                $template_classes = $_POST['classes'];
                $current_classes = explode(',', $_POST['current_classes']);
                $data['template_name'] = $template_name;
                $data['template_desc'] = $template_desc;
                $data['id'] = $template_id;
                $data['title'] = $title_data;
                $class = $this->MFee_template->get_all_class();
                if (isset($class['error_status']) && $class['error_status'] == 0 && $class['data_status'] == 1) {
                    $data['class_data'] = $class['data'];
                } else {
                    $data['class_data'] = FALSE;
                }
                $template_class_list = array();
                if (!empty($template_classes)) {
                    foreach ($template_classes as $value) {
                        $template_class_list[] = array(
                            'linked_class_detail_id' => $value
                        );
                    }
                }
                $data['class_detail_id'] = json_encode($template_class_list);
                $this->form_validation->set_rules('template_name', 'Template name', 'trim|required|min_length[2]|max_length[40]');
                $this->form_validation->set_rules('template_desc', 'Template description', 'trim|required|min_length[2]'); //|max_length[30]
                if ($this->form_validation->run() == TRUE) {
                    $data_to_save = array(
                        'action' => 'save_edit_fee_template',
                        'template_id' => $template_id,
                        'inst_id' => $inst_id,
                        'template_name' => $template_name,
                        'template_desc' => $template_desc,
                        'acd_year_id' => $this->session->userdata('acd_year'),
                        'class_detail_id' => json_encode($template_classes),
                        'current_classes' => json_encode($current_classes)
                    );
                    $template_data = $this->MFee_template->save_fee_template($data_to_save);
                    //dev_export(json_encode($template_data));
                    //die;
                    if (isset($template_data['data_status']) && !empty($template_data['data_status']) && $template_data['data_status'] == 1) {
                        echo json_encode(array('status' => 1, 'message' => 'Data updated successfullly.'));
                        return true;
                    } else {
                        $message = '';
                        if (isset($template_data['message']) && !empty($template_data['message'])) {
                            $message = $template_data['message'];
                        } else {
                            $message = 'Please check if the entered values are valid.';
                        }
                        echo json_encode(array(
                            'status' => 2,
                            'view' => $this->load->view('fee_templates/edit_fee_template', $data, TRUE),
                            'message' => $message
                        ));
                        return true;
                    }
                } else {

                    echo json_encode(array(
                        'status' => 3,
                        'view' => $this->load->view('fee_templates/edit_fee_template', $data, TRUE),
                        'message' => 'Enter valid values'
                    ));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 4, 'message' => 'Template data is not found.Please try again'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function delete_fee_template()
    {
        if ($this->input->is_ajax_request() == 1) {
            $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_STRING);
            if ($template_id) {
                $template_delete_status = $this->MFee_template->delete_template($template_id);
                if (isset($template_delete_status['data_status']) && !empty($template_delete_status['data_status']) && $template_delete_status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfullly.'));
                    return true;
                } else {
                    if (isset($template_delete_status['message']) && !empty($template_delete_status['message'])) {
                        echo json_encode(array('status' => 2, 'message' => $template_delete_status['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 2, 'message' => 'An error encountered while deleting template. Please try again later'));
                        return true;
                    }
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Template data is required to delete'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
