<?php

/**
 * Description of Fee_code_controller
 *
 * @author aju.docme
 */
class Fee_code_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Fee_code_model', 'MFeecode');
    }

    public function show_fees_code()
    {
        $data['sub_title'] = 'FEE CODE';
        $inst_id = $this->session->userdata('inst_id');
        $feecodetype = filter_input(INPUT_POST, 'feecodetype', FILTER_SANITIZE_NUMBER_INT);
        $fee_codes = $this->MFeecode->get_all_fee_code_data($inst_id);
        if (isset($fee_codes['data']) && !empty($fee_codes['data'])) {
            $data['fee_codes'] = $fee_codes['data'];
        } else {
            $data['fee_codes'] = NULL;
        }
        $data['feecodetype'] = $feecodetype;
        $this->load->view('fee_codes/show_fees_code', $data);
    }

    public function frequency_change()
    {
        if ($this->input->is_ajax_request() == 1) {
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);
            $inst_id = $this->session->userdata('inst_id');

            //Fee Demand frequency
            $demand_frequency = $this->MFeecode->get_all_demand_frequency_data($inst_id, $flag);
            if (isset($demand_frequency['data']) && !empty($demand_frequency['data'])) {
                $demand_frequency = $demand_frequency['data'];
            } else {
                $demand_frequency = NULL;
            }

            echo '<label>Frequency Type</label><span class="mandatory" > *</span><br/>';
            echo '<select name="demand_frequency" id="demand_frequency"  class="form-control" onchange="view_term(this);" style="width:100%;" >                                
                                <option selected value="-1">Select</option>';
            if (isset($demand_frequency) && !empty($demand_frequency)) {
                foreach ($demand_frequency as $demand_frequency_data) {
                    echo '<option value ="' . $demand_frequency_data["id"] . '" data-monthspan="' . $demand_frequency_data["monthSpan"] . '" data-recurring="' . $demand_frequency_data["is_recurring"] . '">' . $demand_frequency_data["frequencyName"] . '</option>';
                }
            }
            echo '</select>';
            echo form_error('demand_frequency', '<div class="form-error">', '</div>');
            echo '<script type="text/javascript">$("#demand_frequency").select2({"theme": "bootstrap"});</script>';
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function add_fee_code()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['title'] = 'ADD NEW FEE CODE';
            $inst_id = $this->session->userdata('inst_id');
            //Fee Type
            $fee_type = $this->MFeecode->get_all_fee_type_data($inst_id);
            if (isset($fee_type['data']) && !empty($fee_type['data'])) {
                $data['fee_type'] = $fee_type['data'];
            } else {
                $data['fee_type'] = NULL;
            }
            //Fee Demand frequency
            $demand_frequency = $this->MFeecode->get_all_demand_frequency_data($inst_id);
            if (isset($demand_frequency['data']) && !empty($demand_frequency['data'])) {
                $data['demand_frequency'] = $demand_frequency['data'];
            } else {
                $data['demand_frequency'] = NULL;
            }

            $demand_frequencyforNODEMAND = $this->MFeecode->get_all_demand_frequency_data($inst_id, 2);
            if (isset($demand_frequencyforNODEMAND['data']) && !empty($demand_frequencyforNODEMAND['data'])) {
                $data['demand_frequencynd'] = $demand_frequencyforNODEMAND['data'];
            } else {
                $data['demand_frequencynd'] = NULL;
            }
            //Account Code
            $account_code = $this->MFeecode->get_all_account_code_data($inst_id);
            if (isset($account_code['data']) && !empty($account_code['data'])) {
                $data['account_code'] = $account_code['data'];
            } else {
                $data['account_code'] = NULL;
            }
            //Demand Type
            $demand_type = $this->MFeecode->get_all_demand_type_data();
            if (isset($demand_type['data']) && !empty($demand_type['data'])) {
                $data['demand_type'] = $demand_type['data'];
            } else {
                $data['demand_type'] = NULL;
            }

            $this->load->view('fee_codes/add_fee_code', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function edit_fee_code()
    {
        if ($this->input->is_ajax_request() == 1) {
            $inst_id = $this->session->userdata('inst_id');
            $acd_year_id = $this->session->userdata('acd_year');

            $fee_code_id = filter_input(INPUT_POST, 'fee_code_id', FILTER_SANITIZE_STRING);
            $fee_code = filter_input(INPUT_POST, 'fee_code', FILTER_SANITIZE_STRING);
            if (isset($fee_code_id) && !empty($fee_code_id)) {
                $data['title'] = 'EDIT -' . $fee_code;
                $fee_code_data = $this->MFeecode->get_fee_code_data($fee_code_id);

                $data_array = array(
                    'action'                => 'get_term_details_for_feecode',
                    'controller_function'   => 'Fees_settings/Fee_structure_controller/get_term_details_for_feecode',
                    'inst_id'               => $inst_id,
                    'acd_year_id'           => $acd_year_id,
                    'fee_codes_id'          => $fee_code_id
                );

                $fee_term_data = $this->MFeecode->get_term_details_for_feecode($data_array);
                $flagg = 0;

                if (isset($fee_code_data['data_status']) && !empty($fee_code_data['data_status']) && $fee_code_data['data_status'] == 1 && isset($fee_code_data['data'][0])) {
                    $data['id'] = $fee_code_data['data'][0]['id'];
                    $data['fees_code'] = $fee_code_data['data'][0]['feeCode'];
                    $data['description'] = $fee_code_data['data'][0]['description'];
                    $data['fee_shortcode'] = $fee_code_data['data'][0]['fee_shortcode'];
                    $data['is_vat'] = $fee_code_data['data'][0]['is_vat'];
                    $data['vat_percent'] = $fee_code_data['data'][0]['vat'];
                    $data['feetype_select'] = $fee_code_data['data'][0]['feeTypeId'];
                    $data['demand_frequency_select'] = $fee_code_data['data'][0]['demandFrequencyId'];
                    $data['account_code_data_select'] = $fee_code_data['data'][0]['accountCodeId'];
                    $data['demand_type_select'] = $fee_code_data['data'][0]['demandType'];
                    $data['monthSpan'] = $fee_code_data['data'][0]['monthSpan'];
                    $data['is_recurring'] = $fee_code_data['data'][0]['is_recurring'];
                    $data['feetermdata'] = $fee_term_data;

                    $data['title'] = 'EDIT - ' . $fee_code_data['data'][0]['description'] . '( ' . $fee_code_data['data'][0]['feeCode'] . ' )'; //if FeeCode Exists
                    $inst_id = $this->session->userdata('inst_id');
                    //Fee Type
                    $fee_type = $this->MFeecode->get_all_fee_type_data($inst_id);
                    if (isset($fee_type['data']) && !empty($fee_type['data'])) {
                        $data['fee_type'] = $fee_type['data'];
                    } else {
                        $data['fee_type'] = NULL;
                    }
                    //Fee Demand frequency
                    if ($fee_code_data['data'][0]['demandType'] == 1) $flagg = 1;
                    else $flagg = 2;
                    $demand_frequency = $this->MFeecode->get_all_demand_frequency_data($inst_id, $flagg);
                    if (isset($demand_frequency['data']) && !empty($demand_frequency['data'])) {
                        $data['demand_frequency'] = $demand_frequency['data'];
                    } else {
                        $data['demand_frequency'] = NULL;
                    }

                    $demand_frequencyforNODEMAND = $this->MFeecode->get_all_demand_frequency_data($inst_id, 2);
                    if (isset($demand_frequencyforNODEMAND['data']) && !empty($demand_frequencyforNODEMAND['data'])) {
                        $data['demand_frequencynd'] = $demand_frequencyforNODEMAND['data'];
                    } else {
                        $data['demand_frequencynd'] = NULL;
                    }
                    //Account Code
                    $account_code = $this->MFeecode->get_all_account_code_data($inst_id);
                    if (isset($account_code['data']) && !empty($account_code['data'])) {
                        $data['account_code'] = $account_code['data'];
                    } else {
                        $data['account_code'] = NULL;
                    }
                    //Demand Type
                    $demand_type = $this->MFeecode->get_all_demand_type_data();
                    if (isset($demand_type['data']) && !empty($demand_type['data'])) {
                        $data['demand_type'] = $demand_type['data'];
                    } else {
                        $data['demand_type'] = NULL;
                    }
                    echo json_encode(array('status' => 1, 'view' => $this->load->view('fee_codes/edit_fees_code', $data, TRUE)));
                    return TRUE;
                } else {
                    echo json_encode(array('status' => 0, 'view' => '', 'message' => 'There is no such fee code. Please check and try again later'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'view' => '', 'message' => 'Fee code not available. Please check again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function change_status_of_fee_code()
    {
        if ($this->input->is_ajax_request() == 1) {
            $fee_code_id = filter_input(INPUT_POST, 'fee_code_id', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            if (isset($fee_code_id) && !empty($fee_code_id)) {
                $status_report = $this->MFeecode->update_fee_code_type($fee_code_id, $status);
                // dev_export($status_report);
                // die;

                if (isset($status_report['data_status']) && !empty($status_report['data_status']) && $status_report['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Fee code status updated successfully'));
                    return true;
                } else {
                    if (isset($status_report['message']) && !empty($status_report['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status_report['message']));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating status of fee code. Please try again later'));
                        return TRUE;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Fee code is not available. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_new_fee_code()
    {
        if ($this->input->is_ajax_request() == 1) {
            $code = filter_input(INPUT_POST, 'fees_code', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $fee_shortcode = filter_input(INPUT_POST, 'fee_shortcode', FILTER_SANITIZE_STRING);
            $is_vat = filter_input(INPUT_POST, 'is_vat', FILTER_SANITIZE_STRING);
            $vat_percent = filter_input(INPUT_POST, 'vat_percent', FILTER_SANITIZE_STRING);
            $feetype_select = filter_input(INPUT_POST, 'feetype_select', FILTER_SANITIZE_STRING);
            $demand_frequency = filter_input(INPUT_POST, 'demand_frequency', FILTER_SANITIZE_STRING);
            $account_code_data = filter_input(INPUT_POST, 'account_code_data', FILTER_SANITIZE_STRING);
            $demand_type = filter_input(INPUT_POST, 'demand_type', FILTER_SANITIZE_STRING);

            $this->form_validation->set_rules('fees_code', 'Fee code', 'trim|required|min_length[2]|max_length[20]');
            $this->form_validation->set_rules('description', 'Fee code description', 'trim|required|min_length[2]|max_length[20]');
            $this->form_validation->set_rules('is_vat', 'Is Vat required', 'trim|required');
            $this->form_validation->set_rules('feetype_select', 'Fee type', 'trim|required');
            $this->form_validation->set_rules('demand_frequency', 'Fee code demand frequency', 'trim|required');
            $this->form_validation->set_rules('account_code_data', 'Account code', 'trim|required');
            $this->form_validation->set_rules('demand_type', 'Demand type', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $data_con = array(
                    'fees_code' => $code,
                    'description' => $description,
                    'fee_shortcode' => $fee_shortcode,
                    'is_vat' => $is_vat,
                    'vat_percent' => $is_vat == 1 ? $vat_percent : 0,
                    'feetype_select' => $feetype_select,
                    'demand_frequency' => $demand_frequency,
                    'account_code_data' => $account_code_data,
                    'demand_type' => $demand_type
                );



                $save_fee_code_data = $this->MFeecode->save_fee_code_new($data_con);
                if (isset($save_fee_code_data['data_status']) && !empty($save_fee_code_data['data_status']) && $save_fee_code_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data = array();
                    $data['fees_code'] = $code;
                    $data['description'] = $description;
                    $data['fee_shortcode'] = $fee_shortcode;
                    $data['is_vat'] = $is_vat;
                    $data['vat_percent'] = $vat_percent;
                    $data['feetype_select'] = $feetype_select;
                    $data['demand_frequency_select'] = $demand_frequency;
                    $data['account_code_data_select'] = $account_code_data;
                    $data['demand_type_select'] = $demand_type;
                    $inst_id = $this->session->userdata('inst_id');
                    $data['title'] = 'ADD NEW FEE CODE';
                    //Fee Type
                    $fee_type = $this->MFeecode->get_all_fee_type_data($inst_id);
                    if (isset($fee_type['data']) && !empty($fee_type['data'])) {
                        $data['fee_type'] = $fee_type['data'];
                    } else {
                        $data['fee_type'] = NULL;
                    }
                    //Fee Demand frequency
                    $demand_frequency = $this->MFeecode->get_all_demand_frequency_data($inst_id);
                    if (isset($demand_frequency['data']) && !empty($demand_frequency['data'])) {
                        $data['demand_frequency'] = $demand_frequency['data'];
                    } else {
                        $data['demand_frequency'] = NULL;
                    }
                    //Account Code
                    $account_code = $this->MFeecode->get_all_account_code_data($inst_id);
                    if (isset($account_code['data']) && !empty($account_code['data'])) {
                        $data['account_code'] = $account_code['data'];
                    } else {
                        $data['account_code'] = NULL;
                    }
                    //Demand Type
                    $demand_type = $this->MFeecode->get_all_demand_type_data();
                    if (isset($demand_type['data']) && !empty($demand_type['data'])) {
                        $data['demand_type'] = $demand_type['data'];
                    } else {
                        $data['demand_type'] = NULL;
                    }

                    if (isset($save_fee_code_data['message']) && !empty($save_fee_code_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('fee_codes/add_fee_code', $data, TRUE), 'message' => $save_fee_code_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('fee_codes/add_fee_code', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['fees_code'] = $code;
                $data['description'] = $description;
                $data['is_vat'] = $is_vat;
                $data['vat_percent'] = $vat_percent;
                $data['feetype_select'] = $feetype_select;
                $data['demand_frequency_select'] = $demand_frequency;
                $data['account_code_data_select'] = $account_code_data;
                $data['demand_type_select'] = $demand_type;
                $inst_id = $this->session->userdata('inst_id');
                $data['title'] = 'ADD NEW FEE CODE';
                //Fee Type
                $fee_type = $this->MFeecode->get_all_fee_type_data($inst_id);
                if (isset($fee_type['data']) && !empty($fee_type['data'])) {
                    $data['fee_type'] = $fee_type['data'];
                } else {
                    $data['fee_type'] = NULL;
                }
                //Fee Demand frequency
                $demand_frequency = $this->MFeecode->get_all_demand_frequency_data($inst_id);
                if (isset($demand_frequency['data']) && !empty($demand_frequency['data'])) {
                    $data['demand_frequency'] = $demand_frequency['data'];
                } else {
                    $data['demand_frequency'] = NULL;
                }
                //Account Code
                $account_code = $this->MFeecode->get_all_account_code_data($inst_id);
                if (isset($account_code['data']) && !empty($account_code['data'])) {
                    $data['account_code'] = $account_code['data'];
                } else {
                    $data['account_code'] = NULL;
                }
                //Demand Type
                $demand_type = $this->MFeecode->get_all_demand_type_data();
                if (isset($demand_type['data']) && !empty($demand_type['data'])) {
                    $data['demand_type'] = $demand_type['data'];
                } else {
                    $data['demand_type'] = NULL;
                }

                echo json_encode(array('status' => 3, 'view' => $this->load->view('fee_codes/add_fee_code', $data, TRUE), 'message' => 'Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function save_edit_fee_code()
    {
        if ($this->input->is_ajax_request() == 1) {
            $fcid = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $code = filter_input(INPUT_POST, 'fees_code', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $fee_shortcode = filter_input(INPUT_POST, 'fee_shortcode', FILTER_SANITIZE_STRING);
            $is_vat = filter_input(INPUT_POST, 'is_vat', FILTER_SANITIZE_STRING);
            $vat_percent = filter_input(INPUT_POST, 'vat_percent', FILTER_SANITIZE_STRING);
            $feetype_select = filter_input(INPUT_POST, 'feetype_select', FILTER_SANITIZE_STRING);
            $demand_frequency = filter_input(INPUT_POST, 'demand_frequency', FILTER_SANITIZE_STRING);
            $account_code_data = filter_input(INPUT_POST, 'account_code_data', FILTER_SANITIZE_STRING);
            $demand_type = filter_input(INPUT_POST, 'demand_type', FILTER_SANITIZE_STRING);
            $acd_year_id = $this->session->userdata('acd_year');

            $this->form_validation->set_rules('id', 'Fee code ID', 'trim|required');
            $this->form_validation->set_rules('fees_code', 'Fee code', 'trim|required|min_length[2]|max_length[20]');
            $this->form_validation->set_rules('description', 'Fee code description', 'trim|required|min_length[2]|max_length[20]');
            $this->form_validation->set_rules('is_vat', 'Is Vat required', 'trim|required');
            $this->form_validation->set_rules('feetype_select', 'Fee type', 'trim|required');
            $this->form_validation->set_rules('demand_frequency', 'Fee code demand frequency', 'trim|required');
            $this->form_validation->set_rules('account_code_data', 'Account code', 'trim|required');
            $this->form_validation->set_rules('demand_type', 'Demand type', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data_con = array(
                    'id' => $fcid,
                    'fees_code' => $code,
                    'description' => $description,
                    'fee_shortcode' => $fee_shortcode,
                    'is_vat' => $is_vat,
                    'vat_percent' => $is_vat == 1 ? $vat_percent : 0,
                    'feetype_select' => $feetype_select,
                    'demand_frequency' => $demand_frequency,
                    'account_code_data' => $account_code_data,
                    'demand_type' => $demand_type,
                    'acd_year_id' => $acd_year_id
                );
                $save_fee_code_data = $this->MFeecode->save_fee_code_edit($data_con);

                if (isset($save_fee_code_data['data_status']) && !empty($save_fee_code_data['data_status']) && $save_fee_code_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data updated successfully'));
                    return TRUE;
                } else {
                    $data['id'] = $fcid;
                    $data['fees_code'] = $code;
                    $data['description'] = $description;
                    $data['fee_shortcode'] = $fee_shortcode;
                    $data['is_vat'] = $is_vat;
                    $data['vat_percent'] = $vat_percent;
                    $data['feetype_select'] = $feetype_select;
                    $data['demand_frequency_select'] = $demand_frequency;
                    $data['account_code_data_select'] = $account_code_data;
                    $data['demand_type_select'] = $demand_type;
                    $inst_id = $this->session->userdata('inst_id');
                    $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                    //Fee Type
                    $fee_type = $this->MFeecode->get_all_fee_type_data($inst_id);
                    if (isset($fee_type['data']) && !empty($fee_type['data'])) {
                        $data['fee_type'] = $fee_type['data'];
                    } else {
                        $data['fee_type'] = NULL;
                    }
                    //Fee Demand frequency
                    $demand_frequency = $this->MFeecode->get_all_demand_frequency_data($inst_id);
                    if (isset($demand_frequency['data']) && !empty($demand_frequency['data'])) {
                        $data['demand_frequency'] = $demand_frequency['data'];
                    } else {
                        $data['demand_frequency'] = NULL;
                    }
                    //Account Code
                    $account_code = $this->MFeecode->get_all_account_code_data($inst_id);
                    if (isset($account_code['data']) && !empty($account_code['data'])) {
                        $data['account_code'] = $account_code['data'];
                    } else {
                        $data['account_code'] = NULL;
                    }
                    //Demand Type
                    $demand_type = $this->MFeecode->get_all_demand_type_data();
                    if (isset($demand_type['data']) && !empty($demand_type['data'])) {
                        $data['demand_type'] = $demand_type['data'];
                    } else {
                        $data['demand_type'] = NULL;
                    }

                    if (isset($save_fee_code_data['message']) && !empty($save_fee_code_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('fee_codes/edit_fees_code', $data, TRUE), 'message' => $save_fee_code_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('fee_codes/edit_fees_code', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['id'] = $fcid;
                $data['fees_code'] = $code;
                $data['description'] = $description;
                $data['fee_shortcode'] = $fee_shortcode;
                $data['is_vat'] = $is_vat;
                $data['vat_percent'] = $vat_percent;
                $data['feetype_select'] = $feetype_select;
                $data['demand_frequency_select'] = $demand_frequency;
                $data['account_code_data_select'] = $account_code_data;
                $data['demand_type_select'] = $demand_type;
                $inst_id = $this->session->userdata('inst_id');
                $data['title'] = filter_input(INPUT_POST, 'title_data', FILTER_SANITIZE_STRING);
                //Fee Type
                $fee_type = $this->MFeecode->get_all_fee_type_data($inst_id);
                if (isset($fee_type['data']) && !empty($fee_type['data'])) {
                    $data['fee_type'] = $fee_type['data'];
                } else {
                    $data['fee_type'] = NULL;
                }
                //Fee Demand frequency
                $demand_frequency = $this->MFeecode->get_all_demand_frequency_data($inst_id);
                if (isset($demand_frequency['data']) && !empty($demand_frequency['data'])) {
                    $data['demand_frequency'] = $demand_frequency['data'];
                } else {
                    $data['demand_frequency'] = NULL;
                }
                //Account Code
                $account_code = $this->MFeecode->get_all_account_code_data($inst_id);
                if (isset($account_code['data']) && !empty($account_code['data'])) {
                    $data['account_code'] = $account_code['data'];
                } else {
                    $data['account_code'] = NULL;
                }
                //Demand Type
                $demand_type = $this->MFeecode->get_all_demand_type_data();
                if (isset($demand_type['data']) && !empty($demand_type['data'])) {
                    $data['demand_type'] = $demand_type['data'];
                } else {
                    $data['demand_type'] = NULL;
                }

                echo json_encode(array('status' => 3, 'view' => $this->load->view('fee_codes/edit_fees_code', $data, TRUE), 'message' => 'Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
