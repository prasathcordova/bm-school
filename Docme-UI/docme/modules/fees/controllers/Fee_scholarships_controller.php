<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fee_scholarships_controller
 *
 * @author chandrajith.edsys
 */
class Fee_scholarships_controller extends MX_Controller{
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
        $this->load->model('Fees_scholarships_model', 'MFee_scholarships'); 
    }
      public function student_filterscholarships() {

        
        $data['sub_title'] = 'Fees scholarship Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Fees scholarship',
                'link' => base_url()),
            '2' => array(
                'title' => 'Fees scholarship')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
       
      
            $this->load->view('fee_scholarships/student_filter', $data);
        
    }
      public function show_fee_student_scholarships() {

        
        $data['sub_title'] = 'Fees scholarship Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Fees scholarship',
                'link' => base_url()),
            '2' => array(
                'title' => 'Fees scholarship')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
       
      
            $this->load->view('fee_scholarships/student_scholarship', $data);
        
    }
      public function collect_fee_student_scholarships() {

        
        $data['sub_title'] = 'Fees scholarship Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Fees scholarship',
                'link' => base_url()),
            '2' => array(
                'title' => 'Fees scholarship')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
       
      
            $this->load->view('fee_scholarships/collect_scholarship', $data);
        
    }
      public function student_filter_scholarships() {

        
        $data['sub_title'] = 'Fees scholarship Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Fees scholarship',
                'link' => base_url()),
            '2' => array(
                'title' => 'Fees scholarship')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
       
      
            $this->load->view('fee_scholarships/student_filter_collection', $data);
        
    }
      public function student_filter_list_scholarships() {

        
        $data['sub_title'] = 'Fees scholarship Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Fees scholarship',
                'link' => base_url()),
            '2' => array(
                'title' => 'Fees scholarship')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
       
      
            $this->load->view('fee_scholarships/student_filter_list', $data);
        
    }
}
