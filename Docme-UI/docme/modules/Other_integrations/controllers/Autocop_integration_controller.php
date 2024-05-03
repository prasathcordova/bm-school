<?php

/**
 * Description of Autocop_integration_controller
 *
 * @author Aju
 * Purpose : For Autocop integration
 */
class Autocop_integration_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Autocop_model', 'MAutocop');
    }

    public function push_data_to_docme() {
        $api_key = filter_input(INPUT_GET, 'KEY');
//        dev_export(strlen(trim($api_key)));die;
//        dev_export($_GET);die;
        if (isset($api_key) && !empty($api_key) && strlen($api_key) == 23) {
            if ($api_key == '45DFT-RT56T-QSRT4-Y9X6B') {
                $data = filter_input(INPUT_GET, 'data');
                if (isset($data) && !empty($data)) {
                    if (!isJson($data)) {
                        header('Content-Type: application/json');
                        echo json_encode(array('status' => 0, 'message' => 'Please send valid json string as data'));
                        return;
                    }
                    $data_r = json_decode($data, TRUE);
                    if (count($data_r) > 0) {

                        $new_api_key = '5999-XBT55-8844-0V43';
                        $push_data = $this->MAutocop->push_data_to_api($data, $new_api_key);
//                        dev_export($push_data);die;
                        if (isset($push_data['data_status']) && !empty($push_data['data_status']) && $push_data['data_status'] == 1) {
                            header('Content-Type: application/json');
                            echo json_encode(array('status' => 1, 'message' => 'Data push completed successfully'));
                            return;
                        } else {
                            header('Content-Type: application/json');
                            echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating data push. Please contact administrator'));
                            return;
                        }

                        header('Content-Type: application/json');
                        echo json_encode(array('status' => 1, 'message' => 'Data push completed successfully'));
                        return;
                    } else {
                        header('Content-Type: application/json');
                        echo json_encode(array('status' => 0, 'message' => 'No data available to push'));
                        return;
                    }
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(array('status' => 0, 'message' => 'No data available to push'));
                    return;
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('status' => 0, 'message' => 'Invalid API Key'));
                return;
            }
            $api_check = $this->MAutocop->get_authorization_code($api_key);
            if (isset($api_check['data_status']) && !empty($api_check['data_status']) && $api_check['data_status'] == 1) {
                $new_api_key = $api_check['data'][0]['api_key'];
                $inst_id = $api_check['data'][0]['inst_id'];
                $acd_year_id = $api_check['data'][0]['acd_year_id'];

                $data_raw = filter_input(INPUT_GET, 'data');
                $data = json_decode(trim($data_raw), TRUE);

                $push_data = $this->MAutocop->push_data_to_api($data, $api_key, $inst_id, $acd_year_id);

                if (isset($push_data['data_status']) && !empty($push_data['data_status']) && $push_data['data_status'] == 1) {
                    header('Content-Type: application/json');
                    echo json_encode(array('status' => 1, 'message' => 'Data push completed successfully'));
                    return;
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(array('status' => 0, 'message' => 'An error encountered while updating data push. Please contact administrator'));
                    return;
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('status' => 0, 'message' => 'Invalid API Key'));
                return;
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 0, 'message' => 'API Key required to access this service'));
            return;
        }
    }

}
