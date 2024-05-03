<?php

/**
 * Description of Fee_penalty_controller
 *
 * @author aju.docme
 */
class Fee_penalty_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Fee_penalty_model', 'MPenalty');
    }

    public function show_penalty() //List Penalties
    {
        $data['sub_title'] = 'PENALTY SETTINGS';
        $inst_id = $this->session->userdata('inst_id');
        $data_con = array(
            'action' => 'get_all_penalty_data',
            'controller_function' => 'Fees_settings/Fee_penalty_controller/get_all_penalty_data',
            'inst_id' => $inst_id
        );
        $penalty_data = $this->MPenalty->get_all_penalty_data($data_con);
        if (isset($penalty_data['data']) && !empty($penalty_data['data'])) {
            $penaltyarray = array();
            //
            foreach ($penalty_data['data'] as $pdls) {
                $effectdate = date('d-m-Y', strtotime($pdls['effectdate']));
                $penaltyarray[$pdls['Penalty_ID']]['effectdate'] = $effectdate;
                $penaltyarray[$pdls['Penalty_ID']]['penalty_id'] = $pdls['Penalty_ID'];
                $penaltyarray[$pdls['Penalty_ID']]['fee_id'] = $pdls['Ref_id'];
                $penaltyarray[$pdls['Penalty_ID']]['fee_code'] = $pdls['Ref_code'];
                $penaltyarray[$pdls['Penalty_ID']]['fee_name'] = $pdls['Ref_Description'];
                $penaltyarray[$pdls['Penalty_ID']]['penalty_type'] = $pdls['penalty_type'];
                $penaltyarray[$pdls['Penalty_ID']]['penalty_desc'] = $pdls['penalty_desc'];
                $penaltyarray[$pdls['Penalty_ID']]['status'] = $pdls['status'];
                $penaltyarray[$pdls['Penalty_ID']]['details'][] = array(
                    'FromDays' => $pdls['FromDays'],
                    'Todays' => $pdls['Todays'],
                    'amount' => $pdls['amount']
                );
            }
            // dev_export($penalty_data);
            // die;
            $data['penalty_data'] = $penaltyarray;
        } else {
            $data['penalty_data'] = NULL;
        }

        $this->load->view('fee_penalty/show_penalty', $data);
    }

    public function add_penalty() //Add Penalty Screen
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'ADD PENALTY';
            $inst_id = $this->session->userdata('inst_id');
            //Get All Fee Codes            
            $data_con = array(
                'action'                => 'get_feecodes_for_penalty',
                'controller_function'   => 'Fees_settings/Fee_penalty_controller/get_feecodes_for_penalty',
                'inst_id' => $inst_id
            );
            $fee_codes = $this->MPenalty->get_feecodes_for_penalty($data_con);
            if (isset($fee_codes['data']) && !empty($fee_codes['data'])) {
                $data['fee_codes'] = $fee_codes['data'];
            } else {
                $data['fee_codes'] = NULL;
            }

            $this->load->view('fee_penalty/add_penalty', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_penalty() //Edit Penalty Screen
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $penalty_id = filter_input(INPUT_POST, 'penalty_id');
            $fee_name = filter_input(INPUT_POST, 'fee_name', FILTER_SANITIZE_STRING);
            if (isset($penalty_id) && !empty($penalty_id)) {
                $data['title'] = 'EDIT -' . $fee_name;
                $data_con = array(
                    'action'                => 'get_penalty_data',
                    'controller_function'   => 'Fees_settings/Fee_penalty_controller/get_penalty_data',
                    'inst_id' => $inst_id,
                    'penalty_id' => $penalty_id
                );
                $penalty_data = $this->MPenalty->get_penalty_data($data_con);
                if (isset($penalty_data['data']) && !empty($penalty_data['data'])) {
                    $penaltyarray = array();
                    //
                    foreach ($penalty_data['data'] as $pdls) {
                        $effectdate = date('d/m/Y', strtotime($pdls['effectdate']));
                        $penaltyarray['effectdate'] = $effectdate;
                        $penaltyarray['penalty_id'] = $pdls['Penalty_ID'];
                        $penaltyarray['fee_id'] = $pdls['Ref_id'];
                        $penaltyarray['fee_code'] = $pdls['Ref_code'];
                        $penaltyarray['fee_name'] = $pdls['Ref_Description'];
                        $penaltyarray['penalty_type'] = $pdls['penalty_type'];
                        $penaltyarray['penalty_desc'] = $pdls['penalty_desc'];
                        $penaltyarray['details'][] = array(
                            'FromDays' => $pdls['FromDays'],
                            'Todays' => $pdls['Todays'],
                            'amount' => $pdls['amount']
                        );
                    }
                    // dev_export($penaltyarray);
                    // die;
                    $data['penalty_data'] = $penaltyarray;
                } else {
                    $data['penalty_data'] = NULL;
                }

                echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_penalty/edit_penalty', $data, TRUE)));
                return TRUE;
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Fee code not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function change_penalty_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $fee_penalty_id = filter_input(INPUT_POST, 'fee_penalty_id');
            $status = filter_input(INPUT_POST, 'status');
            if (isset($fee_penalty_id) && !empty($fee_penalty_id)) {

                $data_con = array(
                    'action'                => 'change_penalty_status',
                    'controller_function'   => 'Fees_settings/Fee_penalty_controller/change_penalty_status',
                    'fee_penalty_id' => $fee_penalty_id,
                    'status' => $status,
                    'inst_id' => $inst_id
                );

                $status_report = $this->MPenalty->change_penalty_status($data_con);
                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Status Changed successfully'));
                    return TRUE;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Fee code is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_penalty() //Save Penalty
    {
        if ($this->input->is_ajax_request() == 1) {
            $fee_code = filter_input(INPUT_POST, 'fee_code', FILTER_SANITIZE_NUMBER_INT);
            $penalty_type = filter_input(INPUT_POST, 'penalty_type', FILTER_SANITIZE_STRING);
            $effectdate = filter_input(INPUT_POST, 'effectdate');
            $effect_date = filter_input(INPUT_POST, 'effect_date');

            $from_day = $_POST['from_day']; //filter_input(INPUT_POST, 'from_day');
            $to_day = $_POST['to_day']; //filter_input(INPUT_POST, 'to_day');
            $penalty_amount = $_POST['penalty_amount']; //filter_input(INPUT_POST, 'penalty_amount');
            $inst_id = $this->session->userdata('inst_id');

            $this->form_validation->set_rules('fee_code', 'Fee code ID', 'trim|required');
            $this->form_validation->set_rules('penalty_type', 'Penalty Type', 'trim|required');
            $this->form_validation->set_rules('effectdate', 'Effect Date', 'trim|required');

            $penalty_array = array();
            $i = 0;
            if (!empty($from_day) && !empty($to_day) && !empty($penalty_amount)) {
                foreach ($from_day as $fd) {
                    $penalty_array['fee_id'] = $fee_code;
                    $penalty_array['penalties'][$i]['from_day'] = $fd;
                    $penalty_array['penalties'][$i]['to_day'] = $to_day[$i];
                    $penalty_array['penalties'][$i]['penalty_amount'] = $penalty_amount[$i];
                    $i++;
                }
            }
            // dev_export(json_encode($effect_date));
            // die;

            //if ($this->form_validation->run() == TRUE) {
            $data_con = array(
                'action'                => 'save_penalty',
                'controller_function'   => 'Fees_settings/Fee_penalty_controller/save_penalty',
                'fee_code' => $fee_code,
                'penalty_type' => trim($penalty_type),
                'effectdate' => $effect_date,
                'penalty_array' => json_encode($penalty_array),
                'inst_id' => $inst_id
            );

            $save_fee_code_data = $this->MPenalty->save_penalty($data_con);
            // dev_export($save_fee_code_data);
            // die;
            if (isset($save_fee_code_data['data_status']) && !empty($save_fee_code_data['data_status']) && $save_fee_code_data['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                return TRUE;
            } else {
                echo json_encode(array('status' => 2, 'message' => $save_fee_code_data['message']));
                return true;
            }
            //}
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_penalty() //Update Penalty
    {
        if ($this->input->is_ajax_request() == 1) {
            $penalty_id = filter_input(INPUT_POST, 'penalty_id', FILTER_SANITIZE_STRING);

            $fee_code = filter_input(INPUT_POST, 'fee_code', FILTER_SANITIZE_NUMBER_INT);
            $penalty_type = filter_input(INPUT_POST, 'penalty_type', FILTER_SANITIZE_STRING);
            $effectdate = filter_input(INPUT_POST, 'effectdate');
            $effect_date = filter_input(INPUT_POST, 'effect_date');

            $from_day = $_POST['from_day']; //filter_input(INPUT_POST, 'from_day');
            $to_day = $_POST['to_day']; //filter_input(INPUT_POST, 'to_day');
            $penalty_amount = $_POST['penalty_amount']; //filter_input(INPUT_POST, 'penalty_amount');
            $inst_id = $this->session->userdata('inst_id');

            $this->form_validation->set_rules('fee_code', 'Fee code ID', 'trim|required');
            $this->form_validation->set_rules('penalty_type', 'Penalty Type', 'trim|required');
            $this->form_validation->set_rules('effectdate', 'Effect Date', 'trim|required');

            $penalty_array = array();
            $i = 0;
            if (!empty($from_day) && !empty($to_day) && !empty($penalty_amount)) {
                foreach ($from_day as $fd) {
                    $penalty_array['fee_id'] = $fee_code;
                    $penalty_array['penalties'][$i]['from_day'] = $fd;
                    $penalty_array['penalties'][$i]['to_day'] = $to_day[$i];
                    $penalty_array['penalties'][$i]['penalty_amount'] = $penalty_amount[$i];
                    $i++;
                }
            }
            $data_con = array(
                'action'                => 'update_penalty',
                'controller_function'   => 'Fees_settings/Fee_penalty_controller/update_penalty',
                'fee_code' => $penalty_id, //penalty ID transfered via fee_code when updation
                'penalty_type' => trim($penalty_type),
                'effectdate' => $effect_date,
                'penalty_array' => json_encode($penalty_array),
                'inst_id' => $inst_id
            );
            $save_fee_code_data = $this->MPenalty->update_penalty($data_con);
            if (isset($save_fee_code_data['data_status']) && !empty($save_fee_code_data['data_status']) && $save_fee_code_data['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                return TRUE;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
