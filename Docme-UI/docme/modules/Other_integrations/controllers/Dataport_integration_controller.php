<?php

/**
 * Description of Data porting from RIMS to Docme
 *
 * @author Fathima Shamna
 * 
 */
class Dataport_integration_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dataport_model', 'MDataport');
    }

    public function push_data_to_docme() {
        
        $data['template'] = 'data_port/show_data_port_data';
        $data['title'] = 'Data Porting RIMS to DOCME';
        $data['sub_title'] = 'Data port Management';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'),
            '1' => array(
                'title' => 'Data port Management',
                'link' => base_url('fees/fee-management'))
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $this->load->view('template/data_port_template', $data);
    }
    public function get_data_equator_data(){
        
        $data['sub_title'] = 'Data Migration RIMS to DOCME';
        $inst_id = $this->session->userdata('inst_id');
        $data_port_data = $this->MDataport->get_all_data_port_data($inst_id);
      if (isset($data_port_data['data']) && !empty($data_port_data['data'])) {
            $data['data_port_data'] = $data_port_data['data'];
        } else {
            $data['data_port_data'] = NULL;
        }
//        dev_export($data);die;
        $this->load->view('data_port/migrate_data_to_docme', $data);
    }

}
