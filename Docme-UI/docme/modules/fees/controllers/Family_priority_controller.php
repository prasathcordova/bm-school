<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Family_priority_controller
 *
 * @author chandrajith.edsys
 */
class Family_priority_controller extends MX_Controller{
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
        $this->load->model('Family_priority_model', 'MFPriority');
    }
     public function show_student_filter() {


        $data['sub_title'] = 'Priority settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Fees Priority',
                'link' => base_url()),
            '2' => array(
                'title' => 'Fees Priority')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');

        $this->load->view('family_priority/student_filter', $data);
    }
     public function show_family_priority() {


        $data['sub_title'] = 'Priority settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Fees Priority',
                'link' => base_url()),
            '2' => array(
                'title' => 'Fees Priority')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');


        $this->load->view('family_priority/show_priority', $data);
        
    }
}
