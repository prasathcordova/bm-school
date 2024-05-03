<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Batch_controller
 *
 * @author chandrajith.edsys
 */
class Batch_controller extends MX_Controller
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
        $this->load->model('Batch_model', 'MBatch');
    }
    public function show_batch()
    {
        //        $data['template'] = 'batch/show_batch';
        //        $data['title'] = 'COURSE SETTINGS';
        $data['sub_title'] = 'Batch Settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Batch Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Batch Settings'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $batch_data = $this->MBatch->get_all_batch_list();
        //dev_export($batch_data);die;
        if ($batch_data['error_status'] == 0 && $batch_data['data_status'] == 1) {
            $data['batch_data'] = $batch_data['data'];
            $data['message'] = "";
        } else {
            $data['batch_data'] = FALSE;
            $data['message'] = $batch_data['message'];
        }
        $data['user_name'] = $this->session->userdata('user_name');

        $this->session->set_userdata('current_page', 'batch');
        $this->session->set_userdata('current_parent', 'course_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['batch_data']) && !empty($data['batch_data'])) {
                foreach ($data['batch_data'] as $batch) {
                    //                    dev_export($batch);die;
                    $batch_status = "";
                    if ($batch['isactive'] == 1) {
                        $batch_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $batch['BatchID'] . '\',\'' . $batch['Batch_Name'] . '\');"/><span></span></label>';
                    } else {
                        $batch_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $batch['BatchID'] . '\',\'' . $batch['Batch_Name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_batch(\'' . $batch['BatchID'] . '\',\'' . $batch['academic_year'] . '\',\'' . $batch['class'] . '\',\'' . $batch['Batch_Name'] . '\',\'' . $batch['strength'] . '\',\'' . $batch['Boys'] . '\',\'' . $batch['Girls'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $batch['Batch_Name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>';
                    $formatted_data[] = array($batch['academic_year'], $batch['class'], $batch['Batch_Name'], $batch['strength'], $batch['Boys'], $batch['Girls'], $batch_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('batch/show_batch', $data);
        }
    }


    public function add_batch()
    {

        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Batch Management', 'status' => 0, 'link' => base_url('batch/show-batch')),
                2 => array('message' => 'Add New Batch', 'status' => 1)
            );
            $acdyr = $this->MBatch->get_all_acadyr();
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
            $class = $this->MBatch->get_all_class();
            if (isset($class['error_status']) && $class['error_status'] == 0) {
                if ($class['data_status'] == 1) {
                    $data['class_data'] = $class['data'];
                } else {
                    $data['class_data'] = FALSE;
                }
            } else {
                $data['class_data'] = FALSE;
            }
            $data['class_data'] = $class['data'];

            $stream = $this->MBatch->get_all_stream();
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

            $session = $this->MBatch->get_all_session();
            if (isset($session['error_status']) && $session['error_status'] == 0) {
                if ($session['data_status'] == 1) {
                    $data['session_data'] = $session['data'];
                } else {
                    $data['session_data'] = FALSE;
                }
            } else {
                $data['session_data'] = FALSE;
            }
            $data['session_data'] = $session['data'];

            $medium = $this->MBatch->get_all_medium_list();
            if (isset($medium['error_status']) && $medium['error_status'] == 0) {
                if ($medium['data_status'] == 1) {
                    $data['medium_data'] = $medium['data'];
                } else {
                    $data['medium_data'] = FALSE;
                }
            } else {
                $data['medium_data'] = FALSE;
            }

            $data['medium_data'] = $medium['data'];

            $data['title'] = 'ADD NEW BATCH';
            $data['panel_sub_header'] = 'Add New Batch';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'batch');
            $this->session->set_userdata('current_parent', 'batch_sett');

            if ($onload == 1) {
                $this->load->view('batch/add_batch', $data);
            } else {

                $this->form_validation->set_rules('acdyr_select', 'Academic Year', 'trim|required');
                $this->form_validation->set_rules('class_select', 'Class', 'trim|required');
                $this->form_validation->set_rules('stream_select', 'Stream', 'trim|required');
                $this->form_validation->set_rules('medium_select', 'Medium', 'trim|required');
                $this->form_validation->set_rules('Boys', 'Strength', 'trim|required');
                $this->form_validation->set_rules('Girls', 'Girls', 'trim|required');
                $this->form_validation->set_rules('strength', 'Sex', 'trim|required');
                $this->form_validation->set_rules('session_select', 'Session', 'trim|required');
                $this->form_validation->set_rules('division', 'Division', 'trim|required');
                $this->form_validation->set_rules('batch_code', 'Batch Code', 'trim|required');
                //                $this->form_validation->set_rules('Batch_Name', 'Batch_Name', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data_prep['Acd_Year'] = filter_input(INPUT_POST, 'acdyr_select', FILTER_SANITIZE_STRING);
                    $data_prep['Class_Det_ID'] = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_STRING);
                    $data_prep['stream_id'] = filter_input(INPUT_POST, 'stream_select', FILTER_SANITIZE_STRING);
                    $data_prep['medium_id'] = filter_input(INPUT_POST, 'medium_select', FILTER_SANITIZE_STRING);
                    $data_prep['Boys'] = filter_input(INPUT_POST, 'Boys', FILTER_SANITIZE_NUMBER_INT);
                    $data_prep['Girls'] = filter_input(INPUT_POST, 'Girls', FILTER_SANITIZE_NUMBER_INT);
                    $data_prep['limit'] = filter_input(INPUT_POST, 'strength', FILTER_SANITIZE_NUMBER_INT);
                    $data_prep['Session_ID'] = filter_input(INPUT_POST, 'session_select', FILTER_SANITIZE_NUMBER_INT);
                    $data_prep['Division'] = trim(strtoupper(filter_input(INPUT_POST, 'division', FILTER_SANITIZE_STRING)));
                    $data_prep['batch_code'] = trim(strtoupper(filter_input(INPUT_POST, 'batch_code', FILTER_SANITIZE_STRING)));
                    //                    $data_prep['Batch_Name'] = filter_input(INPUT_POST, 'Batch_Name', FILTER_SANITIZE_STRING);
                    //                    dev_export($data_prep);die;
                    $status = $this->MBatch->save_batch($data_prep);
                    //                    dev_export($status);die;
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $status['Batch_name'] . " Added Successfully");
                        echo json_encode(array('status' => 1, 'message' => $status['Batch_name']));
                        return;
                    } else {
                        $data['Acd_Year'] = filter_input(INPUT_POST, 'acdyr_select', FILTER_SANITIZE_STRING);
                        $data['Class_Det_ID'] = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_STRING);
                        $data['stream_id'] = filter_input(INPUT_POST, 'stream_select', FILTER_SANITIZE_STRING);
                        $data['medium_id'] = filter_input(INPUT_POST, 'medium_select', FILTER_SANITIZE_STRING);
                        $data['Boys'] = filter_input(INPUT_POST, 'Boys', FILTER_SANITIZE_NUMBER_INT);
                        $data['Girls'] = filter_input(INPUT_POST, 'Girls', FILTER_SANITIZE_NUMBER_INT);
                        $data['limit'] = filter_input(INPUT_POST, 'strength', FILTER_SANITIZE_NUMBER_INT);
                        $data['Session_ID'] = filter_input(INPUT_POST, 'session_select', FILTER_SANITIZE_NUMBER_INT);
                        $data['Division'] = strtoupper(filter_input(INPUT_POST, 'division', FILTER_SANITIZE_STRING));
                        $data['batch_code'] = strtoupper(filter_input(INPUT_POST, 'batch_code', FILTER_SANITIZE_STRING));
                        //                        $data['Batch_Name'] = filter_input(INPUT_POST, 'Batch_Name', FILTER_SANITIZE_STRING);

                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('batch/add_batch', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data['Acd_Year'] = filter_input(INPUT_POST, 'acdyr_select', FILTER_SANITIZE_STRING);
                    $data['Class_Det_ID'] = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_STRING);
                    $data['stream_id'] = filter_input(INPUT_POST, 'stream_select', FILTER_SANITIZE_STRING);
                    $data['medium_id'] = filter_input(INPUT_POST, 'medium_select', FILTER_SANITIZE_STRING);
                    $data['Boys'] = filter_input(INPUT_POST, 'Boys', FILTER_SANITIZE_NUMBER_INT);
                    $data['Girls'] = filter_input(INPUT_POST, 'Girls', FILTER_SANITIZE_NUMBER_INT);
                    $data['limit'] = filter_input(INPUT_POST, 'strength', FILTER_SANITIZE_NUMBER_INT);
                    $data['Session_ID'] = filter_input(INPUT_POST, 'session_select', FILTER_SANITIZE_NUMBER_INT);
                    $data['Division'] = strtoupper(filter_input(INPUT_POST, 'division', FILTER_SANITIZE_STRING));
                    $data['batch_code'] = strtoupper(filter_input(INPUT_POST, 'batch_code', FILTER_SANITIZE_STRING));
                    //                        $data['Batch_Name'] = filter_input(INPUT_POST, 'Batch_Name', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('batch/add_batch', $data, TRUE)));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }


    public function edit_batch()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $BatchID = filter_input(INPUT_POST, 'BatchID', FILTER_SANITIZE_NUMBER_INT);
            $Division = strtoupper(filter_input(INPUT_POST, 'Division', FILTER_SANITIZE_STRING));
            $Batch_Name = strtoupper(filter_input(INPUT_POST, 'Batch_Name', FILTER_SANITIZE_STRING));

            //            dev_export($BatchID);die;

            if (isset($BatchID) && !empty($BatchID)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Batch Management', 'status' => 0, 'link' => base_url('course/show-course')),
                    2 => array('message' => 'Edit Batch', 'status' => 1)
                );
                $acdyr = $this->MBatch->get_all_acadyr();
                //                dev_export($acdyr);die;
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
                $class = $this->MBatch->get_all_class();
                if (isset($class['error_status']) && $class['error_status'] == 0) {
                    if ($class['data_status'] == 1) {
                        $data['class_data'] = $class['data'];
                    } else {
                        $data['class_data'] = FALSE;
                    }
                } else {
                    $data['class_data'] = FALSE;
                }
                $data['class_data'] = $class['data'];

                $stream = $this->MBatch->get_all_stream();
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

                $session = $this->MBatch->get_all_session();
                if (isset($session['error_status']) && $session['error_status'] == 0) {
                    if ($session['data_status'] == 1) {
                        $data['session_data'] = $session['data'];
                    } else {
                        $data['session_data'] = FALSE;
                    }
                } else {
                    $data['session_data'] = FALSE;
                }
                $data['session_data'] = $session['data'];

                $medium = $this->MBatch->get_all_medium_list();
                if (isset($medium['error_status']) && $medium['error_status'] == 0) {
                    if ($medium['data_status'] == 1) {
                        $data['medium_data'] = $medium['data'];
                    } else {
                        $data['medium_data'] = FALSE;
                    }
                } else {
                    $data['medium_data'] = FALSE;
                }

                $data['medium_data'] = $medium['data'];

                $data['title'] = 'EDIT BATCH - ' . $Batch_Name;
                $data['panel_sub_header'] = 'Edit Batch - ' . $Batch_Name;
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'batch');
                $this->session->set_userdata('current_parent', 'gen_sett');

                $batch_data_raw = $this->MBatch->get_batch_details($BatchID);
                // dev_export($batch_data_raw);
                // die;
                if (is_array($batch_data_raw) && isset($batch_data_raw['data_status']) && !empty($batch_data_raw['data_status']) && $batch_data_raw['data_status'] == 1) {
                    $data['batch_data'] = $batch_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Batch - ' . $data['batch_data']['Batch_Name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Batch / No data associated with this batch', 'data' => ''));
                    return;
                }
                if ($onload == 1) {

                    $view = $this->load->view('batch/edit_batch', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('acdyr_select', 'Academic Year', 'trim|required');
                    $this->form_validation->set_rules('class_select', 'Class', 'trim|required');
                    $this->form_validation->set_rules('stream_select', 'Stream', 'trim|required');
                    $this->form_validation->set_rules('session_select', 'Session', 'trim|required');
                    $this->form_validation->set_rules('division', 'Division', 'trim|required');
                    $this->form_validation->set_rules('batch_code', 'batch_code', 'trim|required');
                    $this->form_validation->set_rules('strength', 'Sex', 'trim|required');
                    $this->form_validation->set_rules('Boys', 'Strength', 'trim|required');
                    $this->form_validation->set_rules('Girls', 'Girls', 'trim|required');
                    //                $this->form_validation->set_rules('Batch_Name', 'Batch_Name', 'trim|required');
                    //              
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['BatchID'] = filter_input(INPUT_POST, 'BatchID', FILTER_SANITIZE_STRING);
                        $data_prep['Acd_Year'] = filter_input(INPUT_POST, 'acdyr_select', FILTER_SANITIZE_STRING);
                        $data_prep['Class_Det_ID'] = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_STRING);
                        $data_prep['stream_id'] = filter_input(INPUT_POST, 'stream_select', FILTER_SANITIZE_STRING);
                        $data_prep['medium_id'] = filter_input(INPUT_POST, 'medium_select', FILTER_SANITIZE_STRING);
                        $data_prep['Boys'] = filter_input(INPUT_POST, 'Boys', FILTER_SANITIZE_NUMBER_INT);
                        $data_prep['Girls'] = filter_input(INPUT_POST, 'Girls', FILTER_SANITIZE_NUMBER_INT);
                        $data_prep['limit'] = filter_input(INPUT_POST, 'strength', FILTER_SANITIZE_NUMBER_INT);
                        $data_prep['Session_ID'] = filter_input(INPUT_POST, 'session_select', FILTER_SANITIZE_NUMBER_INT);
                        $data_prep['Division'] = trim(strtoupper(filter_input(INPUT_POST, 'division', FILTER_SANITIZE_STRING)));
                        $data_prep['batch_code'] = trim(strtoupper(filter_input(INPUT_POST, 'batch_code', FILTER_SANITIZE_STRING)));
                        //                    $data_prep['Batch_Name'] = filter_input(INPUT_POST, 'Batch_Name', FILTER_SANITIZE_STRING);
                        //                    dev_export($data_prep);die;
                        $status = $this->MBatch->edit_save_batch($data_prep);
                        //                        dev_export($status);die;
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $status['Batch_name'] . " editted Successfully");
                            echo json_encode(array('status' => 1, 'view' => '', 'message' => $status['Batch_name']));
                            return;
                        } else {
                            $data['BatchID'] = filter_input(INPUT_POST, 'BatchID', FILTER_SANITIZE_STRING);
                            $data['Acd_Year'] = filter_input(INPUT_POST, 'acdyr_select', FILTER_SANITIZE_STRING);
                            $data['Class_Det_ID'] = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_STRING);
                            $data['stream_id'] = filter_input(INPUT_POST, 'stream_select', FILTER_SANITIZE_STRING);
                            $data['medium_id'] = filter_input(INPUT_POST, 'medium_select', FILTER_SANITIZE_STRING);
                            $data['Boys'] = filter_input(INPUT_POST, 'Boys', FILTER_SANITIZE_NUMBER_INT);
                            $data['Girls'] = filter_input(INPUT_POST, 'Girls', FILTER_SANITIZE_NUMBER_INT);
                            $data['limit'] = filter_input(INPUT_POST, 'strength', FILTER_SANITIZE_NUMBER_INT);
                            $data['Session_ID'] = filter_input(INPUT_POST, 'session_select', FILTER_SANITIZE_NUMBER_INT);
                            $data['Division'] = strtoupper(filter_input(INPUT_POST, 'division', FILTER_SANITIZE_STRING));
                            $data['batch_code'] = strtoupper(filter_input(INPUT_POST, 'batch_code', FILTER_SANITIZE_STRING));
                            //$data['Batch_Name'] = filter_input(INPUT_POST, 'Batch_Name', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('batch/edit_batch', $data, TRUE), 'message' => $status['message']));
                            return;
                        }
                    } else {
                        $data['BatchID'] = filter_input(INPUT_POST, 'BatchID', FILTER_SANITIZE_STRING);
                        $data['Acd_Year'] = filter_input(INPUT_POST, 'acdyr_select', FILTER_SANITIZE_STRING);
                        $data['Class_Det_ID'] = filter_input(INPUT_POST, 'class_select', FILTER_SANITIZE_STRING);
                        $data['stream_id'] = filter_input(INPUT_POST, 'stream_select', FILTER_SANITIZE_STRING);
                        $data['medium_id'] = filter_input(INPUT_POST, 'medium_select', FILTER_SANITIZE_STRING);
                        $data['Boys'] = filter_input(INPUT_POST, 'Boys', FILTER_SANITIZE_NUMBER_INT);
                        $data['Girls'] = filter_input(INPUT_POST, 'Girls', FILTER_SANITIZE_NUMBER_INT);
                        $data['limit'] = filter_input(INPUT_POST, 'strength', FILTER_SANITIZE_NUMBER_INT);
                        $data['Session_ID'] = filter_input(INPUT_POST, 'session_select', FILTER_SANITIZE_NUMBER_INT);
                        $data['Division'] = strtoupper(filter_input(INPUT_POST, 'division', FILTER_SANITIZE_STRING));
                        $data['batch_code'] = strtoupper(filter_input(INPUT_POST, 'batch_code', FILTER_SANITIZE_STRING));
                        //                        $data['Batch_Name'] = filter_input(INPUT_POST, 'Batch_Name', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('batch/edit_batch', $data, TRUE)));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Batch ID is provided / Invalid Batch', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $BatchID = filter_input(INPUT_POST, 'BatchID', FILTER_SANITIZE_STRING);
            //            dev_export($BatchID);die;
            if (isset($BatchID) && !empty($BatchID)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                //                dev_export($data_prep);die;
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['BatchID'] = filter_input(INPUT_POST, 'BatchID', FILTER_SANITIZE_STRING);
                //                dev_export($data_prep);die;
                $status = $this->MBatch->edit_status_batch($data_prep);
                //                dev_export($status);die;
                if (is_array($status) && $status['status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    echo json_encode(array('status' => 2, 'message' => $status['message'], 'data' => ''));
                    return;
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
