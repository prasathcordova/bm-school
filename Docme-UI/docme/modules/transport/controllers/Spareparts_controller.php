<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Spareparts_controller
 *
 * @author chandrajith.edsys
 */
class Spareparts_controller extends MX_Controller
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
        $this->load->model('Spareparts_model', 'Mspare');
    }

    public function show_spareparts()
    {
        $data['sub_title'] = 'Spare Parts';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $inst_id = $this->session->userdata('inst_id');
        $spares_data = $this->Mspare->get_spares_details($inst_id);
        // dev_export($spares_data);
        // die;
        if (isset($spares_data['data']) && !empty($spares_data['data'])) {
            $data['spares_data'] = $spares_data['data'];
        } else {
            $data['spares_data'] = NULL;
        }
        $this->load->view('spareparts/show_spareparts', $data);
    }

    public function add_parts($lang = '')
    {

        //        $this->lang->load('content', $lang == '' ? 'en' : $lang);
        //        $this->lang->load('content', 'ar');
        //        dev_export($this->lang->line('Account Code'));
        //        $data['account_code'] = $this->lang->line('Account Code');
        //        $data['account_code'] =$this->lang->line('Account Code');
        //        $data['message']=$this->lang->line('message');
        //        dev_export($data['account_code']);die;
        //        $data['description'] = $this->lang->line('Description');
        //        $data['name']=$this->lang->line('name');

        $data['sub_title'] = 'ADD NEW SPARE PART';
        $data['title'] = 'NEW SPARE PART';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Warehouse Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Warehouse Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');


        $this->load->view('spareparts/add_parts', $data);
    }

    public function add_newparts($lang = '')
    {

        //        $this->lang->load('content', $lang == '' ? 'en' : $lang);
        //        $data['account_code'] = $this->lang->line('Account Code');
        //        $data['account_code'] =$this->lang->line('Account Code');
        //        $data['message']=$this->lang->line('message');
        //        dev_export($data['account_code']);
        //        $data['description'] = $this->lang->line('Description');
        //        $data['name']=$this->lang->line('name');




        $data['sub_title'] = 'Add New Spare Part';


        $this->load->view('spareparts/add_spareparts', $data);
    }

    public function save_spares_part()
    {
        if ($this->input->is_ajax_request() == 1) {
            $partname = filter_input(INPUT_POST, 'pname', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
            $partnumber = filter_input(INPUT_POST, 'p_num', FILTER_SANITIZE_NUMBER_INT);
            $data['sub_title'] = 'SPARE PART';
            $data['title'] = 'NEW SPARE PART';
            $this->form_validation->set_rules('pname', ' Part', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('desc', ' description', 'trim|required|min_length[3]|max_length[100]');
            if ($this->form_validation->run() == TRUE) {
                $save_sparepart_data = $this->Mspare->save_part_new($partname, $description, $partnumber);
                if (isset($save_sparepart_data['data_status']) && !empty($save_sparepart_data['data_status']) && $save_sparepart_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    $data['spares_data'] = array(
                        'sparepartname' => $partname,
                        'description' => $description,
                        'partnumber' => $partnumber
                    );
                    if (isset($save_sparepart_data['message']) && !empty($save_sparepart_data['message'])) {
                        echo json_encode(array('status' => $save_sparepart_data['error_status'], 'view' => $this->load->view('spareparts/add_parts', $data, TRUE), 'message' => $save_sparepart_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('spareparts/add_parts', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['spares_data'] = array(
                    'sparepartname' => $partname,
                    'description' => $description,
                    'partnumber' => $partnumber
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('spareparts/add_spareparts', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function change_status_parts()
    {
        if ($this->input->is_ajax_request() == 1) {
            $partid = filter_input(INPUT_POST, 'spare_id', FILTER_SANITIZE_NUMBER_INT);
            $status =  filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            if (isset($partid) && !empty($partid)) {
                $data['id'] = $partid;
                $data['status'] = $status;
                $data['inst_id'] = $this->session->userdata('inst_id');
                $data['flag'] = 0;
                $sdata = $this->Mspare->edit_status_parts($data);
                if (isset($sdata['status']) && $sdata['status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Update successfully .'));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Update Failed'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Invalid spart id given'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_save_spareparts()
    {
        if ($this->input->is_ajax_request() == 1) {
            $partid = filter_input(INPUT_POST, 'pid', FILTER_SANITIZE_NUMBER_INT);
            $name = filter_input(INPUT_POST, 'pname', FILTER_SANITIZE_STRING);
            $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
            $num = filter_input(INPUT_POST, 'p_num', FILTER_SANITIZE_STRING);
            if (isset($partid) && !empty($partid)) {
                $sdata = $this->Mspare->save_edit_part_new($name, $desc, $num, $partid);
                if (isset($sdata['data_status']) && $sdata['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Update successfully .'));
                    return TRUE;
                }else if (isset($sdata['message']) && !empty($sdata['message'])) {
                    $data['title'] = 'Edit - ' . $name;
                    echo json_encode(array('status' => 2, 'view' => $this->load->view('spareparts/edit_spare_parts', $data, TRUE), 'message' => $sdata['message']));
                    return true;
                }else {
                    echo json_encode(array('status' => 0, 'message' => 'Update Failed'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Invalid spart id given'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_spareparts()
    {
        if ($this->input->is_ajax_request() == 1) {
            $partid = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $sp_name =  filter_input(INPUT_POST, 'sp_name', FILTER_SANITIZE_STRING);
            if (isset($partid) && !empty($partid)) {
                $select_sparepart_data = $this->Mspare->select_part_spare($partid);
                // dev_export($select_sparepart_data);
                // return;
                if (isset($select_sparepart_data['data_status']) && !empty($select_sparepart_data['data_status']) && $select_sparepart_data['data_status'] == 1) {
                    $data['edit_data'] = $select_sparepart_data['data'];
                    $data['title'] = 'Edit - ' . $sp_name;
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('spareparts/edit_spare_parts', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such spareparts found. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Sparepart is not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }



    public function edit_newparts_save()
    {
        if ($this->input->is_ajax_request() == 1) {
            $partname = filter_input(INPUT_POST, 'pname', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
            $partnumber = filter_input(INPUT_POST, 'p_num', FILTER_SANITIZE_NUMBER_INT);
            $pid = filter_input(INPUT_POST, 'pid', FILTER_SANITIZE_NUMBER_INT);
            $data['sub_title'] = 'SPARE PART';
            $data['title'] = 'NEW SPARE PART';
            $this->form_validation->set_rules('pname', ' Part', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('desc', ' description', 'trim|required|min_length[3]|max_length[100]');
            if ($this->form_validation->run() == TRUE) {
                $save_sparepart_data = $this->Mspare->save_edit_part_new($partname, $description, $partnumber, $pid);
                if (isset($save_sparepart_data['data_status']) && !empty($save_sparepart_data['data_status']) && $save_sparepart_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    $data['spares_data'] = array(
                        'sparepartname' => $partname,
                        'description' => $description,
                        'partnumber' => $partnumber
                    );
                    if (isset($save_sparepart_data['message']) && !empty($save_sparepart_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('spareparts/add_spareparts', $data, TRUE), 'message' => $save_sparepart_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('spareparts/add_spareparts', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['spares_data'] = array(
                    'sparepartname' => $partname,
                    'description' => $description,
                    'partnumber' => $partnumber
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('spareparts/add_spareparts', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
