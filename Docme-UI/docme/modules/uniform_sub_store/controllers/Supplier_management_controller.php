<?php

/**
 * Description of Supplier_management_controller
 *
 * @author chandrajith.docme
 */
class Supplier_management_controller extends MX_Controller
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
        $this->load->model('Supplier_model', 'MSupplier');
    }
    public function show_suppliers2()
    {
        //        $data['template'] = 'suppliers/show_suppliers';
        //        $data['title'] = 'GENERAL SETTINGS';
        $data['sub_title'] = 'SUPPLIER MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Supplier Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $suppliers_data = $this->MSuppliers->get_all_suppliers_list();
        if ($suppliers_data['error_status'] == 0 && $suppliers_data['data_status'] == 1) {
            $data['suppliers_data'] = $suppliers_data['data'];
            $data['message'] = "";
        } else {
            $data['suppliers_data'] = FALSE;
            $data['message'] = $suppliers_data['message'];
        }


        $this->session->set_userdata('current_page', 'suppliers');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['suppliers_data']) && !empty($data['suppliers_data'])) {
                foreach ($data['suppliers_data'] as $suppliers) {
                    $suppliers_status = "";
                    if ($suppliers['isactive'] == 1) {
                        $suppliers_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $suppliers['id'] . '\',\'' . $suppliers['name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                    } else {
                        $suppliers_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $suppliers['id'] . '\',\'' . $suppliers['name'] . '\', this)" id="" class="js-switch"  /></a>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_suppliers(\'' . $suppliers['id'] . '\',\'' . $suppliers['name'] . '\',\'' . $suppliers['code'] . '\',\'' . $suppliers['address1'] . '\',\'' . $suppliers['address2'] . '\',\'' . $suppliers['address3'] . '\',\'' . $suppliers['contact'] . '\',\'' . $suppliers['emailid'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $suppliers['name'] . '" data-original-title="Edit ' . $suppliers['name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($suppliers['name'], $suppliers['code'], $suppliers['address1'], $suppliers['address2'], $suppliers['address3'], $suppliers['contact'], $suppliers['emailid'], $suppliers_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('suppliers/show_suppliers', $data);
        }
    }
    public function show_suppliers()
    {

        $data['sub_title'] = 'SUPPLIER MANAGEMENT';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'General Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Supplier Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        //                dev_export($data['user_name']);die;
        $supplier_data = $this->MSupplier->get_all_supplier_list();
        if ($supplier_data['error_status'] == 0 && $supplier_data['data_status'] == 1) {
            $data['supplier_data'] = $supplier_data['data'];
            $data['message'] = "";
        } else {
            $data['supplier_data'] = FALSE;
            $data['message'] = $supplier_data['message'];
        }


        $this->session->set_userdata('current_page', 'supplier');
        $this->session->set_userdata('current_parent', 'gen_sett');

        if (null !== (filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT)) && filter_input(INPUT_POST, 'load_reset', FILTER_SANITIZE_NUMBER_INT) == 1) {
            $formatted_data = array();
            if (isset($data['supplier_data']) && !empty($data['supplier_data'])) {
                foreach ($data['supplier_data'] as $supplier) {
                    $supplier_status = "";
                    if ($supplier['isactive'] == 1) {
                        $supplier_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $supplier['supplier_id'] . '\',\'' . $supplier['supplier_name'] . '\', this)" checked id="" class="js-switch"  /></a>';
                        //$supplier_status = '<label class="switch switch-small"><input id="status_check" type="checkbox" checked value="1" onchange="change_status(this,\'' . $supplier['country_id'] . '\',\'' . $supplier['supplier_name'] . '\');"/><span></span></label>';
                    } else {
                        $supplier_status = '<a data-toggle="tooltip" title="Slide for Enable/Disable" ><input type="checkbox" onchange="change_status(\'' . $supplier['country_id'] . '\',\'' . $supplier['supplier_name'] . '\', this)" id="" class="js-switch"  /></a>';
                        //$supplier_status = '<label class="switch switch-small"><input id="status_check" type="checkbox"  value="0" onchange="change_status(this,\'' . $supplier['country_id'] . '\',\'' . $supplier['supplier_name'] . '\');"/><span></span></label>';
                    }
                    $task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $supplier['country_id'] . '\',\'' . $supplier['supplier_name'] . '\',\'' . $supplier['supplier_abbr'] . '\',\'' . $supplier['supplier_name'] . '\');"  data-toggle="tooltip" data-placement="right" title="Edit ' . $supplier['supplier_name'] . '" data-original-title="Edit ' . $supplier['supplier_name'] . '"  ><i class="fa fa-pencil" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    //$task_html = '<a href="javascript:void(0);" onclick="edit_country(\'' . $supplier['country_id'] . '\');"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit ' . $supplier['supplier_name'] . '"  ><i class="fa fa-edit" style="font-size: 24px; color: #1caf9a; margin: 2%; "></i></a>';
                    $formatted_data[] = array($supplier['supplier_name'], $supplier['supplier_abbr'], $supplier['supplier_name'], $supplier_status, $task_html);
                }
            }


            echo json_encode($formatted_data);
            return;
        } else {
            $this->load->view('supplier/show_supplier', $data);
        }
    }
    public function add_suppliers()
    {

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Supplier Management', 'status' => 0, 'link' => base_url('suppliers/show-suppliers')),
                2 => array('message' => 'Add New Supplier', 'status' => 1)
            );
            $data['title'] = 'ADD NEW SUPPLIER';
            $data['panel_sub_header'] = 'Add New Suppliers';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'suppliers');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('supplier/add_suppliers', $data);
            } else {

                $this->form_validation->set_rules('name', 'Supplier Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('code', 'Supplier Code', 'trim|required|min_length[3]|max_length[15]');
                $this->form_validation->set_rules('address1', 'Address1', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('address2', 'Address2', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('address3', 'Address3', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('contact', 'Contact', 'trim|required|min_length[3]|max_length[10]');
                $this->form_validation->set_rules('emailid', 'Email Id', 'trim|required|min_length[3]|max_length[30]');


                if ($this->form_validation->run() == TRUE) {
                    $data_prep['name'] = strtoupper(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
                    $data_prep['code'] = strtoupper(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
                    $data_prep['address1'] = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
                    $data_prep['address2'] = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
                    $data_prep['address3'] = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
                    $data_prep['contact'] = strtoupper(filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING));
                    $data_prep['emailid'] = strtoupper(filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_STRING));
                    //                     dev_export($data_prep);die;                  
                    $status = $this->MSuppliers->save_suppliers($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['name'] . " added successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                        $data['code'] = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
                        $data['address1'] = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
                        $data['address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
                        $data['address3'] = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
                        $data['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                        $data['emailid'] = filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('suppliers/add_suppliers', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                    $data['code'] = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
                    $data['address1'] = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
                    $data['address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
                    $data['address3'] = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
                    $data['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                    $data['emailid'] = filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('suppliers/add_suppliers', $data, TRUE), 'message' => $status['message']));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function add_publishers()
    {

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Publisher Management', 'status' => 0, 'link' => base_url('publisher/show-publisher')),
                2 => array('message' => 'Add New Publisher', 'status' => 1)
            );

            $data['title'] = 'ADD NEW PUBLISHER';
            $data['panel_sub_header'] = 'Add New Publisher';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'publisher');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('publisher/add_publisher', $data);
            } else {

                $this->form_validation->set_rules('name', 'Publisher Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('code', 'Code', 'trim|required|min_length[3]|max_length[15]');
                $this->form_validation->set_rules('address1', 'Address1', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('address2', 'Address', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('address3', 'Address3', 'trim|required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('contact', 'Contact', 'trim|required|min_length[3]|max_length[15]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[100]');

                if ($this->form_validation->run() == TRUE) {
                    $data_prep['name'] = strtoupper(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
                    $data_prep['code'] = strtoupper(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
                    $data_prep['address1'] = strtoupper(filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING));
                    $data_prep['address2'] = strtoupper(filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING));
                    $data_prep['address3'] = strtoupper(filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING));
                    $data_prep['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                    $data_prep['email'] = strtoupper(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
                    $status = $this->MPublisher->save_publisher($data_prep);
                    //                    dev_export($status);die;
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['name'] . " added successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                        $data['code'] = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
                        $data['address1'] = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
                        $data['address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
                        $data['address3'] = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
                        $data['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                        $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('publisher/add_publisher', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                    $data['code'] = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
                    $data['address1'] = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
                    $data['address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
                    $data['address3'] = filter_input(INPUT_POST, 'address3', FILTER_SANITIZE_STRING);
                    $data['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                    $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('publisher/add_publisher', $data, TRUE)));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function add_country()
    {

        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $breadcrumb = array(
                0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                1 => array('message' => 'Country Management', 'status' => 0, 'link' => base_url('country/show-country')),
                2 => array('message' => 'Add New Country', 'status' => 1)
            );
            $currency = $this->MSupplier->get_all_currency();
            if (isset($currency['error_status']) && $currency['error_status'] == 0) {
                if ($currency['data_status'] == 1) {
                    $data['currency_data'] = $currency['data'];
                } else {
                    $data['currency_data'] = FALSE;
                }
            } else {
                $data['currency_data'] = FALSE;
            }
            $data['title'] = 'ADD NEW COUNTRY';
            $data['currency_data'] = $currency['data'];
            $data['panel_sub_header'] = 'Add New Country';
            $data['breadcrumb'] = $breadcrumb;
            $this->session->set_userdata('current_page', 'country');
            $this->session->set_userdata('current_parent', 'gen_sett');

            if ($onload == 1) {
                $this->load->view('country/add_country', $data);
            } else {

                $this->form_validation->set_rules('supplier_name', 'Country Name', 'trim|required|min_length[3]|max_length[30]');
                $this->form_validation->set_rules('country_abbr', 'Country Abbreviation', 'trim|required|min_length[3]|max_length[15]');
                $this->form_validation->set_rules('currency_select', 'Currency', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data_prep['supplier_name'] = strtoupper(filter_input(INPUT_POST, 'supplier_name', FILTER_SANITIZE_STRING));
                    $data_prep['country_abbr'] = strtoupper(filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING));
                    $data_prep['currency_id'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                    //                     dev_export($data_prep);die;                  
                    $status = $this->MSupplier->save_country($data_prep);
                    if (is_array($status) && $status['status'] == 1) {
                        $this->session->set_flashdata('success_message', $data_prep['supplier_name'] . " added successfully");
                        echo json_encode(array('status' => 1, 'view' => ''));
                        return;
                    } else {
                        $data['supplier_name'] = filter_input(INPUT_POST, 'supplier_name', FILTER_SANITIZE_STRING);
                        $data['country_abbr'] = filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING);
                        $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                        $this->session->set_flashdata('error_message', $status['message']);
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('country/add_country', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                } else {
                    $data['supplier_name'] = filter_input(INPUT_POST, 'supplier_name', FILTER_SANITIZE_STRING);
                    $data['country_abbr'] = filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING);
                    $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                    echo json_encode(array('status' => 3, 'view' => $this->load->view('country/add_country', $data, TRUE), 'message' => $status['message']));
                    return;
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }


    public function edit_country()
    {
        $data['user_name'] = $this->session->userdata('user_name');
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);
            $supplier_id = filter_input(INPUT_POST, 'country_id', FILTER_SANITIZE_NUMBER_INT);
            $supplier_name = strtoupper(filter_input(INPUT_POST, 'supplier_name', FILTER_SANITIZE_STRING));
            $supplier_abbr = strtoupper(filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING));

            if (isset($supplier_id) && !empty($supplier_id)) {

                $breadcrumb = array(
                    0 => array('message' => 'Home', 'status' => 0, 'link' => base_url('home/dashboard')),
                    1 => array('message' => 'Country Management', 'status' => 0, 'link' => base_url('country/show-country')),
                    2 => array('message' => 'Edit Country', 'status' => 1)
                );
                $currency = $this->MSupplier->get_all_currency();
                if (isset($currency['error_status']) && $currency['error_status'] == 0) {
                    if ($currency['data_status'] == 1) {
                        $data['currency_data'] = $currency['data'];
                    } else {
                        $data['currency_data'] = FALSE;
                    }
                } else {
                    $data['currency_data'] = FALSE;
                }
                $data['title'] = 'EDIT COUNTRY - ' . $supplier_name;
                $data['currency_data'] = $currency['data'];
                $data['panel_sub_header'] = 'Edit Country - ';
                $data['breadcrumb'] = $breadcrumb;
                $this->session->set_userdata('current_page', 'country');
                $this->session->set_userdata('current_parent', 'gen_sett');

                $supplier_data_raw = $this->MSupplier->get_country_details($supplier_id);
                if (is_array($supplier_data_raw) && isset($supplier_data_raw['data_status']) && !empty($supplier_data_raw['data_status']) && $supplier_data_raw['data_status'] == 1) {
                    $data['country_data'] = $supplier_data_raw['data'][0];
                    $data['panel_sub_header'] = 'Edit Country - ' . $data['country_data']['supplier_name'];
                } else {
                    echo json_encode(array('status' => 0, 'message' => 'Invalid Country / No data associated with this country', 'data' => ''));
                    return;
                }
                if ($onload == 1) {

                    $view = $this->load->view('country/edit_country', $data, TRUE);
                    echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                } else {
                    $this->form_validation->set_rules('supplier_name', 'Country Name', 'trim|required|min_length[3]|max_length[30]');
                    $this->form_validation->set_rules('country_abbr', 'Country Abbreviation', 'trim|required|min_length[3]|max_length[15]');
                    $this->form_validation->set_rules('currency_select', 'Currency', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $data_prep['country_id'] = filter_input(INPUT_POST, 'country_id', FILTER_SANITIZE_STRING);
                        $data_prep['supplier_name'] = strtoupper(filter_input(INPUT_POST, 'supplier_name', FILTER_SANITIZE_STRING));
                        $data_prep['country_abbr'] = strtoupper(filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING));
                        $data_prep['currency_id'] = strtoupper(filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING));
                        $status = $this->MSupplier->edit_save_country($data_prep);
                        if (is_array($status) && $status['status'] == 1) {
                            $this->session->set_flashdata('success_message', $data_prep['supplier_name'] . " editted successfully");
                            echo json_encode(array('status' => 1, 'view' => ''));
                            return;
                        } else {
                            $data['supplier_name'] = filter_input(INPUT_POST, 'supplier_name', FILTER_SANITIZE_STRING);
                            $data['country_abbr'] = filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING);
                            $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                            $this->session->set_flashdata('error_message', $status['message']);
                            echo json_encode(array('status' => 2, 'view' => $this->load->view('country/edit_country', $data, TRUE), 'message' => $status['message']));
                            return;
                        }
                    } else {
                        $data['supplier_name'] = filter_input(INPUT_POST, 'supplier_name', FILTER_SANITIZE_STRING);
                        $data['country_abbr'] = filter_input(INPUT_POST, 'country_abbr', FILTER_SANITIZE_STRING);
                        $data['currency_select'] = filter_input(INPUT_POST, 'currency_select', FILTER_SANITIZE_STRING);
                        echo json_encode(array('status' => 3, 'view' => $this->load->view('country/edit_country', $data, TRUE), 'message' => $status['message']));
                        return;
                    }
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => 'No Country ID is provided / Invalid Country', 'data' => ''));
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function update_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $supplier_id = filter_input(INPUT_POST, 'country_id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($supplier_id) && !empty($supplier_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['country_id'] = filter_input(INPUT_POST, 'country_id', FILTER_SANITIZE_STRING);
                $status = $this->MSupplier->edit_status_country($data_prep);
                if (is_array($status) && $status['status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                    return;
                }
            } else {
                echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                return;
            }
        } else {
            echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
            return;
        }
    }
}
