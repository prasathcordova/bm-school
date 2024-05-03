<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Feecode_allotment_controller
 *
 * @author chandrajith.edsys
 */
class Feecode_allotment_controller extends MX_Controller{
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
        $this->load->model('Feecode_allotment_model', 'MFee_allotment'); 
    }
    
     
}
