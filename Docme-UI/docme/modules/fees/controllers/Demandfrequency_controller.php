<?php

/**
 * Description of Demandfrequency_controller
 *
 * @author chandrajith.edsys
 * @modified by Aju S Aravind
 */
class Demandfrequency_controller extends MX_Controller
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

        $this->load->model('Demandfrequency_model', 'MDemandfrequency');
    }

    public function show_fee_demand_frequency()
    {


        $data['sub_title'] = 'DEMAND FREQUENCY';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Fees Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Fees Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $inst_id = $this->session->userdata('inst_id');
        $demand_frequency = $this->MDemandfrequency->get_all_demand_frequency_data($inst_id);

        if (isset($demand_frequency['data']) && !empty($demand_frequency['data'])) {
            $data['demand_frequency'] = $demand_frequency['data'];
        } else {
            $data['demand_frequency'] = NULL;
        }

        $this->load->view('demand_frequency/show_demand_frequency', $data);
    }

    public function add_fee_demand_frequency()
    {


        $data['sub_title'] = 'DEMAND FREQUENCY';
        $data['title'] = 'ADD NEW DEMAND FREQUENCY';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Fees Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Fees Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');


        $this->load->view('demand_frequency/add_demand_frequency', $data);
    }

    public function edit_fee_demand_frequency()
    {

        if ($this->input->is_ajax_request() == 1) {

            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'title' => 'Fees Settings',
                    'link' => base_url()
                ),
                '2' => array(
                    'title' => 'Fees Management'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            $data['user_name'] = $this->session->userdata('user_name');

            $demand_freq_id = filter_input(INPUT_POST, 'demand_freq_id', FILTER_SANITIZE_STRING);
            $type_name = filter_input(INPUT_POST, 'freq_name', FILTER_SANITIZE_STRING);

            $data['sub_title'] = 'Edit - ' . $type_name;

            if (isset($demand_freq_id) && !empty($demand_freq_id)) {
                $demand_frequncy_data = $this->MDemandfrequency->get_demand_frequency_data($demand_freq_id);
                if (isset($demand_frequncy_data['data_status']) && !empty($demand_frequncy_data['data_status']) && $demand_frequncy_data['data_status'] == 1 && isset($demand_frequncy_data['data'][0])) {
                    $data['frequency_name'] = $demand_frequncy_data['data'][0]['frequencyName'];
                    $data['frequency_month_span'] = $demand_frequncy_data['data'][0]['monthSpan'];
                    $data['frequency_type'] = $demand_frequncy_data['data'][0]['is_recurring'];
                    $data['id'] = $demand_frequncy_data['data'][0]['id'];
                    $data['title'] = 'Edit - ' . $type_name;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('demand_frequency/edit_demand_frequency', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such demand frequency. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Demand frquency is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function change_status_of_fee_demand_frequency()
    {
        if ($this->input->is_ajax_request() == 1) {
            $demand_frequency_id = filter_input(INPUT_POST, 'demand_frequency_id', FILTER_SANITIZE_NUMBER_INT);
            $inst_id = $this->session->userdata('inst_id');
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            if (isset($demand_frequency_id) && !empty($demand_frequency_id)) {
                $status_report = $this->MDemandfrequency->update_demand_frequency_type($demand_frequency_id, $inst_id, $status);

                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Fee demand frequency status updated successfully'));
                    return true;
                } else {
                    if (isset($status_report['message']) && !empty($status_report['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status_report['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating status of fee demand frequency. Please try again later'));
                        return TRUE;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Fee demand frequency is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_new_demand_frequency()
    {
        if ($this->input->is_ajax_request() == 1) {
            $name = filter_input(INPUT_POST, 'frequency_name', FILTER_SANITIZE_STRING);
            $type = filter_input(INPUT_POST, 'frequency_type', FILTER_SANITIZE_STRING);
            $month_span = filter_input(INPUT_POST, 'frequency_month_span', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'DEMAND FREQUENCY';
            $data['title'] = 'ADD NEW DEMAND FREQUENCY';
            //            dev_export($_POST);die;
            $this->form_validation->set_rules('frequency_name', 'Demand frequency name', 'trim|required|min_length[2]|max_length[20]');
            $this->form_validation->set_rules('frequency_type', 'Demand frequency type', 'trim|required|callback_frequency_type');
            //$this->form_validation->set_rules('frequency_month_span', 'Demand frequency month span', "trim|required|callback_frequency_month_span[$type]");

            if ($this->form_validation->run($this) == TRUE) {
                $save_fee_demand_freq_data = $this->MDemandfrequency->save_demand_frequency_new($name, $type, $month_span);
                if (isset($save_fee_demand_freq_data['data_status']) && !empty($save_fee_demand_freq_data['data_status']) && $save_fee_demand_freq_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['frequency_name'] = $name;
                    $data['frequency_type'] = $type;
                    $data['frequency_month_span'] = $month_span;
                    if (isset($save_fee_demand_freq_data['message']) && !empty($save_fee_demand_freq_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('demand_frequency/add_demand_frequency', $data, TRUE), 'message' => $save_fee_demand_freq_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('demand_frequency/add_demand_frequency', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['frequency_name'] = $name;
                $data['frequency_type'] = $type;
                $data['frequency_month_span'] = $month_span;
                echo json_encode(array('status' => 3, 'view' => $this->load->view('demand_frequency/add_demand_frequency', $data, TRUE), 'message' => 'Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function frequency_type($selection)
    {
        if ($selection == -1) {
            return false;
        } else {
            return true;
        }
    }

    public function edit_frequency_type($selection)
    {
        if ($selection == -1) {
            return false;
        } else {
            return true;
        }
    }

    public function frequency_month_span($span, $type)
    {
        if ($type == 2) {
            if ($span < 0) {
                $this->form_validation->set_message('frequency_month_span', "Select a valid month span");
                return false;
            } else {
                return true;
            }
        } else if ($type == 1) {
            if ($span != -2) {
                $this->form_validation->set_message('frequency_month_span', "Select a valid type or modify month span accordingly ");
                return false;
            } else {
                return true;
            }
        } else if ($type == -1) {
            $this->form_validation->set_message('frequency_month_span', "Select a valid month span");
            return false;
        }
    }

    public function save_edit_demand_frequency()
    {
        if ($this->input->is_ajax_request() == 1) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $name = filter_input(INPUT_POST, 'frequency_name', FILTER_SANITIZE_STRING);
            $type = filter_input(INPUT_POST, 'frequency_type', FILTER_SANITIZE_STRING);
            $month_span = filter_input(INPUT_POST, 'frequency_month_span', FILTER_SANITIZE_STRING);
            $data['sub_title'] = 'DEMAND FREQUENCY';
            $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');


            $this->form_validation->set_rules('frequency_name', 'Demand frequency name', 'trim|required|min_length[2]|max_length[20]');
            $this->form_validation->set_rules('frequency_type', 'Demand frequency type', 'trim|required|callback_edit_frequency_type');
            //$this->form_validation->set_rules('frequency_month_span', 'Demand frequency month span', "trim|required|callback_frequency_month_span[$type]");

            if ($this->form_validation->run($this) == TRUE) {
                $save_edit_demand_freq = $this->MDemandfrequency->save_demand_frequency_edit($id, $name, $month_span, $type, $inst_id);
                if (isset($save_edit_demand_freq['data_status']) && !empty($save_edit_demand_freq['data_status']) && $save_edit_demand_freq['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['frequency_name'] = $name;
                    $data['frequency_type'] = $type;
                    $data['frequency_month_span'] = $month_span;
                    $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                    $data['sub_title'] = 'DEMAND FREQUENCY';
                    if (isset($save_edit_demand_freq['message']) && !empty($save_edit_demand_freq['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('demand_frequency/edit_demand_frequency', $data, TRUE), 'message' => $save_edit_demand_freq['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('demand_frequency/edit_demand_frequency', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['frequency_name'] = $name;
                $data['frequency_type'] = $type;
                $data['frequency_month_span'] = $month_span;
                $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                $data['sub_title'] = 'DEMAND FREQUENCY';
                echo json_encode(array('status' => 3, 'view' => $this->load->view('demand_frequency/edit_demand_frequency', $data, TRUE), 'message' => 'Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
