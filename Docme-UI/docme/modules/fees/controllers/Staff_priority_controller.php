<?php

/**
 * Description of Staff_priority_controller
 *
 * @author aju.docme
 */
class Staff_priority_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function staff_priority() {

        $data['sub_title'] = 'Staff Priority';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Fees Settings',
                'link' => base_url()),
            '2' => array(
                'title' => 'Fees Management')
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');


        $this->load->view('staff_priority/staff_priority', $data);
    }

   
}
