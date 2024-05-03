<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fees_staff_controller
 *
 * @author chandrajith.edsys
 */
class Fees_staff_controller extends MX_Controller {
    public function __construct() {
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
        $this->load->model('Fees_staff_model', 'MFee_staff'); 
    }
     public function show_fee_staff() {

        
        $data['sub_title'] = 'Fees Staff Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Fees Staff',
                'link' => base_url()),
            '2' => array(
                'title' => 'Fees Staff')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
       
      
            $this->load->view('fee_staff/staff_collection', $data);
        
    }
}
