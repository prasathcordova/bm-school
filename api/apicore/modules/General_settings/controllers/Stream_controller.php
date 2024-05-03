<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stream_controller
 *
 * @author docme2
 */
class Stream_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Stream_model', 'MStream');
    }

    public function get_stream($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "st.isactive = " . $params['status'];
        }
        if (isset($params['inst_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "st.Inst_id = " . $params['inst_id'];
            } else {
                $query_string = "st.Inst_id = " . $params['inst_id'];
            }
        }
        if (isset($params['stream_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "st.stream_id LIKE '%" . $params['stream_id'] . "%' ";
            } else {
                $query_string = "st.stream_id LIKE '%" . $params['stream_id'] . "%' ";
            }
        }
        if (isset($params['stream_code'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "st.stream_code LIKE '%" . $params['stream_code'] . "%' ";
            } else {
                $query_string = "st.stream_code LIKE '%" . $params['stream_code'] . "%' ";
            }
        }

        if (isset($params['description'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "st.description LIKE '%" . $params['description'] . "%' ";
            } else {
                $query_string = "st.description LIKE '%" . $params['description'] . "%'";
            }
        }

        $stream_list = $this->MStream->get_stream_details($apikey, $query_string);

        if (!empty($stream_list) && is_array($stream_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stream_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_stream($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['stream_code']) && !empty($params['stream_code'])) {
            $dbparams[1] = $params['stream_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Stream Code is required', 'data' => FALSE);
        }
        if (isset($params['description']) && !empty($params['description'])) {
            $dbparams[2] = $params['description'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }

        $stream_add_status = $this->MStream->add_new_stream($dbparams);
        if (!empty($stream_add_status) && is_array($stream_add_status) && $stream_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('stream_id' => $stream_add_status['stream_id']));
        } else {
            if (is_array($stream_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $stream_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }


    public function update_stream($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['stream_id']) && !empty($params['stream_id'])) {
            $dbparams[1] = $params['stream_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Stream ID is required', 'data' => FALSE);
        }
        if (isset($params['stream_code']) && !empty($params['stream_code'])) {
            $dbparams[2] = $params['stream_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Stream Code is required', 'data' => FALSE);
        }
        if (isset($params['descriptn']) && !empty($params['descriptn'])) {
            $dbparams[3] = $params['descriptn'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }
        $dbparams[4] = 1;
        $dbparams[5] = 0;
        $stream_add_status = $this->MStream->update_stream_data($dbparams);
        if (!empty($stream_add_status) && is_array($stream_add_status) && isset($stream_add_status['ErrorStatus']) && $stream_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $stream_add_status);
        } else {
            if (isset($stream_add_status['ErrorMessage']) && !empty($stream_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $stream_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
}
