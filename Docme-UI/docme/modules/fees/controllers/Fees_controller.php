<?php

/**
 * Description of Fees_controller
 *
 * @author chandrajith.edsys
 * To display menu block
 */
class Fees_controller extends MX_Controller
{

    public function __construct()
    {
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
    }

    public function show_fee_menu_block_view()
    {
        $data['sub_title'] = 'FEE MANAGEMENT MODULE';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('school/home'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Fees Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Fees Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $this->load->view('fees_settings/fee_module_list_block_view', $data);
    }

    public function fees_management()
    {
        $data['template'] = 'fees_settings/show_settings';
        $data['title'] = 'FEES MANAGEMENT';
        $data['sub_title'] = 'Fees Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('school/home'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Fees Management',
                'link' => base_url('fees/fee-management')
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $this->load->view('template/fee_template', $data);
    }
}
