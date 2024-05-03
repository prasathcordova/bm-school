<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Temporaryreg_controller
 *
 * @author ***CHANDRAJITH***
 */
class Temporaryreg_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
    }
        public function show_starter() {
      
        $data['template'] = 'tempreg/temppreload';
        $this->load->view('template/tempreg_parent', $data);
    }
        public function show_tempregform() {      
            $data = NULL;
        $this->load->view('tempreg/tempreg_form', $data);
    }
        public function show_tempregform_sibilings() {      
            $data = NULL;
        $this->load->view('tempreg/tempreg_form1', $data);
    }
        public function show_tempregform_communication() {      
            $data = NULL;
        $this->load->view('tempreg/tempreg_form2', $data);
    }
        public function show_tempregform_identification() {      
            $data = NULL;
        $this->load->view('tempreg/tempreg_form3', $data);
    }
        public function show_tempregform_otherdetails() {      
            $data = NULL;
        $this->load->view('tempreg/tempreg_form4', $data);
    }
        public function show_tempregform_birthdetails() {      
            $data = NULL;
        $this->load->view('tempreg/tempreg_form5', $data);
    }
}
