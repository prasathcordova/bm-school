<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Count_controller
 *
 * @author Rahul 
 */
class Count_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
 $this->load->model('Count_model', 'MCount');

    }
    public function get_count($params = NULL) {
        $apikey = $params['API_KEY'];
        $list = $this->MCount->get_active_details($apikey);
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $list);
    }
}
