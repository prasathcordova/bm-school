<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicle_servicebooking_controller
 *
 * @author chandrajith.edsys
 */
class Vehicle_servicebooking_controller extends MX_Controller
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
        $this->load->model('Vehicle_servicebooking_model', 'MSerbook');
        $this->load->model('Spareparts_model', 'Mspare');
    }

    public function show_all_vehicles()
    {


        $data['sub_title'] = 'Vehicle Service Booking';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_data = $this->MSerbook->get_all_vehicle_data($inst_id);
        // dev_export($vehicle_data);
        // die;
        //        dev_export($vehicle_data[0]['id']);die;
        if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
            $data['vehicle_data'] = $vehicle_data['data'];
        } else {
            $data['vehicle_data'] = NULL;
        }


        $this->load->view('service_booking/vehicles_all', $data);
    }

    public function show_all_vehicles_invoice()
    {


        $data['sub_title'] = 'Invoice History';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_data = $this->MSerbook->get_all_vehicle_data($inst_id);
        //        dev_export($vehicle_data);die;
        //        dev_export($vehicle_data[0]['id']);die;
        if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
            $data['vehicle_data'] = $vehicle_data['data'];
        } else {
            $data['vehicle_data'] = NULL;
        }

        $this->load->view('service_booking/vehicles_all_invoice', $data);
    }

    public function show_all_vehicles_service()
    {


        $data['sub_title'] = 'Vehicle Service Booking History';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_data = $this->MSerbook->get_all_vehicle_data($inst_id);
        //        dev_export($vehicle_data);die;
        //        dev_export($vehicle_data[0]['id']);die;
        if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
            $data['vehicle_data'] = $vehicle_data['data'];
        } else {
            $data['vehicle_data'] = NULL;
        }

        $this->load->view('service_booking/vehicles_all_service', $data);
    }

    public function show_service_vehicle_data()
    {
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $vehicle_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $vehicleNum = filter_input(INPUT_POST, 'vehiclenum', FILTER_SANITIZE_STRING);
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_chk = $this->MSerbook->chk_isvehicle_service($vehicle_id, $inst_id);
        $vehicleunderservice = $vehicle_chk['data'][0]['Isinservice'];
        //        dev_export($vehicle_data[0]['id']);die;
        if (isset($vehicle_chk['data']) && !empty($vehicle_chk['data'])) {
            $data['vehicle_data'] = $vehicle_chk['data'];
        } else {
            $data['vehicle_data'] = NULL;
        }
        //        $data['isunderservice'] = $vehicleunderservice;

        $vehicle_data = $this->MSerbook->get_service_vehicle_list($vehicle_id, $inst_id);
        //        dev_export($vehicleunderservice);die;
        if ($vehicleunderservice > 0) {
            echo json_encode(array('status' => 2, 'message' => 'Data loaded'));
            return true;
        } else {

            if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
                $data['service_data'] = $vehicle_data['data'];
            } else {
                $data['service_data'] = NULL;
            }
            $data['vehicle_id'] = $vehicle_id;
            $data['vehicleNum'] = $vehicleNum;
            $data['sub_title'] = 'Vehicle Service Booking - ' . $vehicleNum;
            echo json_encode(array('status' => 1, 'view' => $this->load->view('service_booking/show_particular_vehilce_service', $data, TRUE)));
            return TRUE;
        }
    }

    public function show_vehicle_invoice_history()
    {

        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $vehicle_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $vehicleNums = filter_input(INPUT_POST, 'vehiclenum', FILTER_SANITIZE_STRING);
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_data = $this->MSerbook->get_vehicle_invoice($vehicle_id, $inst_id);
        //        dev_export($vehicle_data);die;
        $vehicle_id = $vehicle_data['data'][0]['id'];
        $vehicleNum = $vehicle_data['data'][0]['vehicleNum'];
        if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
            $data['service_data'] = $vehicle_data['data'];
        } else {
            $data['service_data'] = NULL;
        }
        $data['vehicle_id'] = $vehicle_id;
        $data['vehicleNum'] = $vehicleNum;
        $data['sub_title'] = 'Vehicle Invoice History - ' . $vehicleNums;
        $this->load->view('service_booking/show_particular_vehilce_invoice', $data);
    }

    public function show_vehicle_service_history()
    {



        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $vehicle_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $vehicleNum = filter_input(INPUT_POST, 'vehiclenum', FILTER_SANITIZE_STRING);
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_data = $this->MSerbook->get_vehicle_service($vehicle_id, $inst_id);
        //        dev_export($vehicle_data);die;
        $vehicle_id = $vehicle_data['data'][0]['id'];
        $vehicleNum = $vehicle_data['data'][0]['vehicleNum'];
        if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
            $data['service_data'] = $vehicle_data['data'];
        } else {
            $data['service_data'] = NULL;
        }
        $data['vehicle_id'] = $vehicle_id;
        $data['vehicleNum'] = $vehicleNum;
        $data['sub_title'] = 'Vehicle Service History - ' . $vehicleNum;
        $this->load->view('service_booking/show_particular_vehilce_service_history', $data);
    }

    public function show_vehicles()
    {
        $data['sub_title'] = 'Service Invoice';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_servicedetails_data = $this->MSerbook->get_all_invoice_data($inst_id);
        // dev_export($vehicle_servicedetails_data);
        // die;
        if (isset($vehicle_servicedetails_data['data']) && !empty($vehicle_servicedetails_data['data'])) {
            $data['invoice_data'] = $vehicle_servicedetails_data['data'];
        } else {
            $data['invoice_data'] = NULL;
        }

        //        $this->load->view('account_code/show_account_code', $data);
        $this->load->view('service_booking/vehicles', $data);
    }

    public function show_invoice()
    {

        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $servicebooking_id = filter_input(INPUT_POST, 'servicebooking_id', FILTER_SANITIZE_NUMBER_INT);
        $vehicle_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $vehicleNum = filter_input(INPUT_POST, 'vehiclenum', FILTER_SANITIZE_STRING);
        $serviceCenterId = filter_input(INPUT_POST, 'serviceCenterId', FILTER_SANITIZE_NUMBER_INT);
        $ServiceCenter = filter_input(INPUT_POST, 'ServiceCenter', FILTER_SANITIZE_STRING);
        $schoolno = filter_input(INPUT_POST, 'schoolnum', FILTER_SANITIZE_STRING);
        $advisorcontno = filter_input(INPUT_POST, 'advisorcontno', FILTER_SANITIZE_NUMBER_INT);
        $servicedate = filter_input(INPUT_POST, 'servicedate', FILTER_SANITIZE_STRING);
        $deliverdate = filter_input(INPUT_POST, 'deliverydate', FILTER_SANITIZE_STRING);
        $odometerread = filter_input(INPUT_POST, 'odometer', FILTER_SANITIZE_STRING);
        $data['sub_title'] = 'Service Invoice - ' . $vehicleNum;
        $inst_id = $this->session->userdata('inst_id');
        // dev_export($deliverdate);
        // die;
        $vehicle_servicedetails_data = $this->MSerbook->get_vehicle_invoice_data($vehicle_id, $inst_id);
        // dev_export($vehicle_servicedetails_data);
        // return;
        $spares_data = $this->Mspare->get_spares_details($inst_id);
        $data['sparedata'] = $spares_data['data'];
        if (isset($vehicle_servicedetails_data['data']) && !empty($vehicle_servicedetails_data['data'])) {
            $data['invoice_data'] = $vehicle_servicedetails_data['data'];
        } else {
            $data['invoice_data'] = NULL;
        }
        $data['servicebooking_id'] = $servicebooking_id;
        $data['vehicle_id'] = $vehicle_id;
        $data['vehicle_num'] = $vehicleNum;
        $data['serviceCenterId'] = $serviceCenterId;
        $data['ServiceCenter'] = $ServiceCenter;
        $data['schoolnum'] = $schoolno;
        $data['advisorcontno'] = $advisorcontno;
        $data['servicedate'] = $servicedate;
        $data['deliverydate'] = $deliverdate;
        $data['odometerread'] = $odometerread;
        //        $this->load->view('account_code/show_account_code', $data);
        $this->load->view('service_booking/add_invoice', $data);
    }

    public function show_vehicle_service_booking()
    {
        $data['sub_title'] = 'Vehicle Service  History';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_servicedetails_data = $this->MSerbook->get_all_servicebook_data($inst_id);
        //        dev_export($vehicle_servicedetails_data);die;
        if (isset($vehicle_servicedetails_data['data']) && !empty($vehicle_servicedetails_data['data'])) {
            $data['service_data'] = $vehicle_servicedetails_data['data'];
        } else {
            $data['service_data'] = NULL;
        }
        //        $this->load->view('account_code/show_account_code', $data);
        $this->load->view('service_booking/show_service_booking', $data);
    }

    public function new_vehicle_service_booking()
    {


        $data['sub_title'] = 'NEW VEHICLE SERVICE BOOKING';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
        $vehicleNum = filter_input(INPUT_POST, 'vehicle_num', FILTER_SANITIZE_STRING);

        $inst_id = $this->session->userdata('inst_id');



        $service_center = $this->MSerbook->get_all_vehicle_servicecenter($inst_id);
        if (isset($service_center['error_status']) && $service_center['error_status'] == 0) {
            if ($service_center['data_status'] == 1) {
                $data['servicecenter_data'] = $service_center['data'];
            } else {
                $data['servicecenter_data'] = NULL;
            }
        } else {
            $data['servicecenter_data'] = NULL;
        }
        $service_types = $this->MSerbook->get_all_vehicle_servicetypes($inst_id);

        $this->load->model('Transport_model', 'MTransport');
        $select_driver_data = $this->MTransport->select_driver($vehicle_id);

        if (isset($select_driver_data['data_status']) && !empty($select_driver_data['data_status']) && $select_driver_data['data_status'] == 1) {
            $data['select_driver_data'] = $select_driver_data['data']['emp_id'];
        } else {
            $data['select_driver_data'] = NULL;
        }

        $emp_data = $this->MTransport->get_all_employee_for_driver();
        // dev_export($emp_data);
        // return;
        if (isset($emp_data['error_status']) && $emp_data['error_status'] == 0) {
            if ($emp_data['data_status'] == 1) {
                $data['emp_data'] = $emp_data['data'];
            } else {
                $data['emp_data'] = NULL;
            }
        } else {
            $data['emp_data'] = NULL;
        }


        if (isset($service_types['error_status']) && $service_types['error_status'] == 0) {
            if ($service_types['data_status'] == 1) {
                $data['servicetypes_data'] = $service_types['data'];
            } else {
                $data['servicetypes_data'] = NULL;
            }
        } else {
            $data['servicetypes_data'] = NULL;
        }
        $data['vehicle_id'] = $vehicle_id;
        $data['vehicleNum'] = $vehicleNum;

        $this->load->view('service_booking/add_service_booking', $data);
    }

    public function savenew_servicebooking()
    {

        if ($this->input->is_ajax_request() == 1) {
            $servicebooking_data_raw = filter_input(INPUT_POST, 'servicebooking_details_data');
            //            dev_export($servicebooking_data_raw);die;
            $data['sub_title'] = 'VECHICLE SERVICE BOOKING';
            $data['title'] = 'NEW VECHICLE SERVICE BOOKING';
            if ($servicebooking_data_raw) {
                $save_servicebooking_data = $this->MSerbook->save_service_booking($servicebooking_data_raw);
                //                dev_export($save_servicebooking_data);die;
                if (isset($save_servicebooking_data['data_status']) && !empty($save_servicebooking_data['data_status']) && $save_servicebooking_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    // $data['vehicletype_data'] = array(
                    //     'vehicle_type' => $vehicle_type,
                    //     'description' => $desc
                    // );
                    if (isset($save_servicebooking_data['message']) && !empty($save_servicebooking_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('service_booking/add_service_booking', $data, TRUE), 'message' => $save_servicebooking_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('service_booking/add_service_booking', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['vehicletype_data'] = array(
                    // 'vehicle_type' => $vehicle_type,
                    // 'description' => $desc
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('service_booking/add_service_booking', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function newinvoice_delivery()
    {
        $data['sub_title'] = 'Invoice/Delivery';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Transport Settings',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Transport Management'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['user_name'] = $this->session->userdata('user_name');
        $servicebooking_id = filter_input(INPUT_POST, 'servicebooking_id', FILTER_SANITIZE_NUMBER_INT);
        $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
        $vehicle_num = filter_input(INPUT_POST, 'vehicle_num', FILTER_SANITIZE_STRING);
        $servicecenterid = filter_input(INPUT_POST, 'servicecenterid', FILTER_SANITIZE_NUMBER_INT);
        $servicecenter_name = filter_input(INPUT_POST, 'servicecenter_name', FILTER_SANITIZE_STRING);
        $inst_id = $this->session->userdata('inst_id');

        $data['servicebooking_id'] = $servicebooking_id;
        $data['vehicle_id'] = $vehicle_id;
        $data['vehicle_num'] = $vehicle_num;
        $data['serviceCenterId'] = $servicecenterid;
        $data['ServiceCenter'] = $servicecenter_name;

        $this->load->view('service_booking/add_invoice', $data);
    }

    public function savevehicle_service_invoice()
    {

        if ($this->input->is_ajax_request() == 1) {
            // $service_invoice_vehicle_data_raw = filter_input(INPUT_POST, 'service_invoice_vehicle_data');
            $json_array_spare = [];
            $json_array_acc = [];
            $json_array_miscellaneous = [];
            $sparepart = $this->input->post('select_sparepart');
            $sparequan = $this->input->post('spare_quantity');
            $spareamt = $this->input->post('spare_amount');
            $acessoriesname = $this->input->post('acessoriesname');
            $acessori_quantity = $this->input->post('acessori_quantity');
            $acessori_amount = $this->input->post('acessori_amount');
            $particularname = $this->input->post('particularname');
            $miscellaneous_quantity = $this->input->post('miscellaneous_quantity');
            $miscellaneous_amount = $this->input->post('miscellaneous_amount');

            if (is_array($sparepart) && count($sparepart) > 0) {
                foreach ($sparepart as $s_key => $spr) {
                    $json_array_spare[$s_key]['sparepart_name'] = $sparepart[$s_key];
                    $json_array_spare[$s_key]['sparepart_quantity'] = $sparequan[$s_key];
                    $json_array_spare[$s_key]['sparepart_amount'] = $spareamt[$s_key];
                }
            }
            if (is_array($acessoriesname) && count($acessoriesname) > 0) {
                foreach ($acessoriesname as $a_key => $acr) {
                    $json_array_acc[$a_key]['acc_name'] = $acessoriesname[$a_key];
                    $json_array_acc[$a_key]['acc_quantity'] = $acessori_quantity[$a_key];
                    $json_array_acc[$a_key]['acc_amount'] = $acessori_amount[$a_key];
                }
            }
            if (is_array($particularname) && count($particularname) > 0) {
                foreach ($particularname as $a_key => $miscel) {
                    $json_array_miscellaneous[$a_key]['particular_name'] = $particularname[$a_key];
                    $json_array_miscellaneous[$a_key]['miscellaneous_quantity'] = $miscellaneous_quantity[$a_key];
                    $json_array_miscellaneous[$a_key]['miscellaneous_amount'] = $miscellaneous_amount[$a_key];
                }
            }

            $service_invoice = [
                'invoice_num' => filter_input(INPUT_POST, 'invoice_num', FILTER_SANITIZE_STRING),
                'invoice_date' => date('Y-m-d', strtotime(filter_input(INPUT_POST, 'invoicedate', FILTER_SANITIZE_STRING))),
                'delivery_date' => date('Y-m-d', strtotime(filter_input(INPUT_POST, 'delivery_date', FILTER_SANITIZE_STRING))),
                'service_date' => date('Y-m-d', strtotime(filter_input(INPUT_POST, 'service_date', FILTER_SANITIZE_STRING))),
                'kmreading' => filter_input(INPUT_POST, 'kmreading', FILTER_SANITIZE_STRING),
                'invoicefile' => filter_input(INPUT_POST, 'invoiceuploadefile', FILTER_SANITIZE_STRING),
                'labour_chrge' => filter_input(INPUT_POST, 'labour_chrge'),
                'other_charge' => filter_input(INPUT_POST, 'other_charge'),
                'amt_total' => filter_input(INPUT_POST, 'amt_total'),
                'servicebookingid' => filter_input(INPUT_POST, 'servicebookingid', FILTER_SANITIZE_STRING),
                'vehicleid' => filter_input(INPUT_POST, 'vehicleid', FILTER_SANITIZE_STRING),
                'vehiclenum' => filter_input(INPUT_POST, 'vehiclenum', FILTER_SANITIZE_STRING),
                'servicecenter_id' => filter_input(INPUT_POST, 'servicecenter_id', FILTER_SANITIZE_STRING),
                'servicecenter' => filter_input(INPUT_POST, 'servicecenter', FILTER_SANITIZE_STRING)
            ];
            $json_spare = json_encode($json_array_spare);
            $json_acc = json_encode($json_array_acc);
            $json_miscellaneous = json_encode($json_array_miscellaneous);
            $service_invoice_vehicle_data_raw = json_encode($service_invoice);
            // dev_export($service_invoice_vehicle_data_raw);
            // return;
            $data['sub_title'] = 'VECHICLE SERVICE BOOKING';
            $data['title'] = 'NEW VECHICLE SERVICE BOOKING';
            if ($service_invoice_vehicle_data_raw) {
                $save_servicebooking_data = $this->MSerbook->save_service_invoice($service_invoice_vehicle_data_raw, $json_spare, $json_acc, $json_miscellaneous);
                // dev_export($save_servicebooking_data);
                // return;
                if (isset($save_servicebooking_data['data_status']) && !empty($save_servicebooking_data['data_status']) && $save_servicebooking_data['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully'));
                    return TRUE;
                } else {
                    // $data['vehicletype_data'] = array(
                    //     'vehicle_type' => $vehicle_type,
                    //     'description' => $desc
                    // );
                    if (isset($save_servicebooking_data['message']) && !empty($save_servicebooking_data['message'])) {
                        echo json_encode(array('status' => 2, 'view' => $this->load->view('service_booking/add_service_booking', $data, TRUE), 'message' => $save_servicebooking_data['message']));
                        return true;
                    } else {
                        echo json_encode(array('status' => 4, 'view' => $this->load->view('service_booking/add_service_booking', $data, TRUE), 'message' => 'Please check if the values are valid'));
                        return true;
                    }
                }
            } else {
                $data['vehicletype_data'] = array(
                    'vehicle_type' =>  $service_invoice['vehiclenum']
                );
                echo json_encode(array('status' => 3, 'view' => $this->load->view('service_booking/add_service_booking', $data, TRUE), 'message' => 'Validation Error. Please check if the values are valid'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    function show_invoice_details()
    {
        $data['sub_title'] = 'INVOICE - DETAILS';
        $invoice_data = filter_input(INPUT_POST, 'id');
        $data['invoice_data'] = json_decode($invoice_data);
        // dev_export($data->id);
        // return;

        $inst_id = $this->session->userdata('inst_id');

        $this->load->view('service_booking/view_invoice_details', $data);
    }
}
