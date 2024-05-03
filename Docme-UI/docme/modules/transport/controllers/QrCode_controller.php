<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// use Mpdf\QrCode\QrCode;

/**
 * Description of Servicecenter_controller
 *
 * @author chandrajith.edsys
 */
class QrCode_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('phpqrcode/qrlib');
        // $this->load->library('ciqrcode');
        $this->load->helper('url');
        if (!(isLoggedin() == 1)) {
            if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
                header("HTTP/1.1 401 UNauthorized");
                die();
            } else {
                $path = base_url();
                redirect($path);
            }
        }
        $this->load->model('QrCode_model', 'qrmod');
    }


    public function show_vehicle_qrcodepage()
    {
        if ($this->input->is_ajax_request() == 1) {
            $data['sub_title'] = 'QR Code Generator';
            $inst_id = $this->session->userdata('inst_id');
            // $route_data = $this->Mservice->get_all_vehicle_route_data($inst_id);

            // if (isset($route_data['data']) && !empty($route_data['data'])) {
            //     $data['route_data'] = $route_data['data'];
            // } else {
            //     $data['route_data'] = NULL;
            // }
            $vehicle_data = $this->qrmod->get_all_vehicle_details($inst_id);
            // dev_export($vehicle_data);
            // die;
            if (isset($vehicle_data['data']) && !empty($vehicle_data['data'])) {
                $data['vehicle_data'] = $vehicle_data['data'];
            } else {
                $data['vehicle_data'] = NULL;
            }
            $this->load->view('service_center/show_vehicle', $data);
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function generate_vehicle_qrcode()
    {
        if ($this->input->is_ajax_request() == 1) {

            if (!is_dir(FCPATH . 'reports/qr_code')) {
                mkdir(FCPATH . 'reports/qr_code');
            }

            $this->load->library('ciqrcode');
            $veh_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            // $qr_image = str_replace(' ', '', $reg_name) . '.png';
            // header("Content-Type: image/png");
            $params['data'] = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
            $params['veh_reg_no'] = filter_input(INPUT_POST, 'reg_no', FILTER_SANITIZE_STRING);
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . "reports/qr_code/QR-CODE-" . $veh_id;
            $pdfpath = FCPATH . "reports/qr_code/QR-CODE-" . $veh_id . '.pdf';
            $pdf_url = "reports/qr_code/QR-CODE-" . $veh_id . '.pdf';
            if ($this->ciqrcode->generate($params)) {
                $params['img_url'] = $veh_id;
            }
            $params['qrimage'] = "reports/qr_code/QR-CODE-" .  $veh_id;
            if (file_exists($params['savename']) == TRUE) {
                $html = $this->load->view('QRimage/qrimage', $params, true); // render the view into HTML                        
                $this->load->library('pdf');
                $pdf = $this->pdf->load();

                $pdf->WriteHTML($html); // write the HTML into the PDF
                $pdf->Output($pdfpath, \Mpdf\Output\Destination::FILE); // save to file because we can
                if ($html) {
                    echo json_encode(array('status' => 1, 'link' => base_url($pdf_url)));
                    // echo base_url($filename_report);
                    return true;
                } else {
                    echo json_encode(array('status' => 3, 'message' => 'Report file generation failed. Please try again later'));
                    true;
                }
            }
            // echo '<img src="' . base_url() . 'tes.png" />';
        }
    }
}
