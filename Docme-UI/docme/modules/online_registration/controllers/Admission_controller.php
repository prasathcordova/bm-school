<?php

/**
 * Description of Admission_controller
 *
 * @author Nizamudeen
 * On 18.08.2020
 * For Admission Management
 */
require_once APPPATH . "libraries/tcpdf/PDFMerger.php";
require_once APPPATH . "libraries/tcpdf/tcpdf.php";

use PDFMerger\PDFMerger;

class Admission_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Online_registration_model', 'ONRegistration');
        $this->load->model('Admission_model', 'ADModel');
    }
    public function check_login()
    {
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

    public function document_uploads($instid = 0, $tempid = 0)
    {
        $inst_id = decrypt_data_for_url($instid);
        $tempid = decrypt_data_for_url($tempid);
        if ($this->session->userdata('API-Key') == '' || $inst_id != $this->session->userdata('inst_id')) {
            $this->session->set_userdata('inst_id', $inst_id);
            $apiKEYS = $this->ONRegistration->get_all_api_keys($inst_id);
            if (isset($apiKEYS['error_status']) && $apiKEYS['error_status'] == 0) {
                if ($apiKEYS['data_status'] == 1) {
                    $api_key_data = $apiKEYS['data'];
                } else {
                    $api_key_data = FALSE;
                }
            } else {
                $api_key_data = FALSE;
            }
            $api_key = $api_key_data['api_key'];
            $this->session->set_userdata('API-Key', $api_key); //
        }
        $data['inst_id'] = $inst_id;
        $data['temp_id'] = $tempid;
        $user_data = $this->ADModel->get_temp_user_details($data['temp_id'], $data['inst_id']);
        $data['user_data'] = $user_data['data']['data'][0];
        $data['image_data'] = $user_data['data']['data'];
        $documenxt_data = $this->ADModel->get_admission_documents_for_user();
        $data['document_data'] = $documenxt_data['data'];
        $data['template'] = 'admission/show_upload_documents';
        $this->load->view('template/online_admission_template', $data);
    }
    public function verify_staff_uploaded_details($instid = 0, $empid = 0)
    {
        $inst_id = decrypt_data_for_url($instid);
        $empid = decrypt_data_for_url($empid);
        if ($this->session->userdata('API-Key') == '' || $inst_id != $this->session->userdata('inst_id')) {
            $this->session->set_userdata('inst_id', $inst_id);
            $apiKEYS = $this->ONRegistration->get_all_api_keys($inst_id);
            if (isset($apiKEYS['error_status']) && $apiKEYS['error_status'] == 0) {
                if ($apiKEYS['data_status'] == 1) {
                    $api_key_data = $apiKEYS['data'];
                } else {
                    $api_key_data = FALSE;
                }
            } else {
                $api_key_data = FALSE;
            }
            $api_key = $api_key_data['api_key'];
            $this->session->set_userdata('API-Key', $api_key); //
        }
        $data['inst_id'] = $inst_id;
        $data['emp_id']  = $empid;
        $status             = $this->ADModel->get_assigned_documents($empid, $inst_id);
        $staff_personal             = $this->ADModel->get_staff_details($empid, $inst_id);
        $data['staff_personal'] = $staff_personal['data'];
        $staffdetails = $status['data'];
        if ($staffdetails['error_status'] == 0) {
            $data['assigned_data'] = $staffdetails['data'];
            $data['template'] = 'admission/show_assigned_documents';
            $this->load->view('template/online_admission_template', $data);
        }
        /* $user_data = $this->ADModel->get_temp_user_details($data['emp_id'], $data['inst_id']);
        $data['user_data'] = $user_data['data']['data'][0];
        $data['image_data'] = $user_data['data']['data'];
        $documenxt_data = $this->ADModel->get_admission_documents_for_user();
        $data['document_data'] = $documenxt_data['data']; */
        /*    */
    }
    public function email_upload_success($temp_id, $inst_id)
    {
        $enc_temp_id = encrypt_data_for_url($temp_id);
        $enc_inst_id = encrypt_data_for_url($inst_id);
        $data["inst_id"] = $inst_id;
        $data['upload_link_url'] = base_url() . "online-registration/student-progress-status/" . $enc_inst_id . "/" . $enc_temp_id;
        $temp_data = $this->ADModel->get_temp_user_details($temp_id, $inst_id);
        $data['temp_data'] = $temp_data['data']['data'][0];
        $this->load->helper('mailgun');
        $subject = "Document Uploaded Successfully : " . date('d-m-Y');
        $mailto = $data['temp_data']['L_mail'];

        $mailcontent =  $this->load->view('admission/email-template-upload', $data, true);
        $cc = "";
        //  $email_res = sendgrid_mailer($subject, $mailto, $mailcontent, $cc);
        $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);
        return $email_res;
    }
    public function load_needed_documents()
    {
        $this->check_login();
        $data['title'] = 'Admission Management';
        $data['sub_title'] = 'Documents Settings';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Admission Management',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Document Settings'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $documenxt_data = $this->ADModel->get_all_document_list();
        $data['document_data'] = $documenxt_data['data'];

        //   print_r($documents_data);
        $this->load->view('admission/needed_documents_lists', $data);
    }
    public function load_interview_schedule()
    {
        $this->check_login();
        $data['title'] = 'Admission Management';
        $data['sub_title'] = 'Interview Schedule';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Admission Management',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Interview Schedule'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $documenxt_data = $this->ADModel->get_all_scheduled_interview_list();
        $data['document_data'] = $documenxt_data['data'];

        //   print_r($documents_data);
        $this->load->view('admission/interview_shcheduled_list', $data);
    }
    public function add_needed_documents()
    {
        if ($this->input->is_ajax_request() == 1) {
            $this->check_login();
            $onload = $this->input->post('load');
            $data['title'] = 'Admission Management';
            $data['sub_title'] = 'Create Document';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'title' => 'Admission Management',
                    'link' => base_url()
                ),
                '2' => array(
                    'title' => 'Create Document'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            //   print_r($documents_data);


            if ($onload == 1) {
                $this->load->view('admission/add_document', $data);
            } else {
                $data_prep['inst_id'] = $this->session->userdata('inst_id');
                $data_prep['document_name'] = strtoupper(filter_input(INPUT_POST, 'document_name', FILTER_SANITIZE_STRING));
                $data_prep['isrequired']    = strtoupper(filter_input(INPUT_POST, 'isrequired', FILTER_SANITIZE_STRING));
                $data_prep['action'] = 'add_documents';
                $data_prep['controller_function'] = 'Student_settings/Admission_controller/save_documents';
                $data_prep['user_id'] = $this->session->userdata('userid');

                $this->form_validation->set_rules('document_name', 'document_name', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    // 
                    $documents_data = $this->ADModel->add_documents($data_prep);
                    if (is_array($documents_data) && $documents_data['status'] == 1) {
                        if ($documents_data['data']['data'][0]['ErrorStatus'] == 1) {
                            $this->session->set_flashdata('success_message', $documents_data['data']['data'][0]['ErrorMessage']);
                            echo json_encode(array('status' => 2, 'message' => $documents_data['data']['data'][0]['ErrorMessage'], 'view' => ''));
                        } else {
                            $this->session->set_flashdata('success_message', $data_prep['document_name'] . " added successfully.");
                            echo json_encode(array('status' => 1, 'view' => ''));
                        }

                        return;
                    }
                } else {
                }
            }
        }
    }
    public function edit_needed_documents()
    {
        if ($this->input->is_ajax_request() == 1) {
            $this->check_login();
            $onload = $this->input->post('load');
            $data_prep['doc_id']  = $Document_ID   = $this->input->post("document_id");
            $data_prep['doc_name']   = $this->input->post("document_name");
            $data['title'] = 'EDIT DOCUMENT - ' . $data_prep['doc_name'];
            $data['panel_sub_header'] = 'Edit DOCUMENT - ';
            $breadcrump = array(
                '0' => array(
                    'link' => base_url('dashboard'),
                    'title' => 'Home'
                ),
                '1' => array(
                    'title' => 'Admission Management',
                    'link' => base_url()
                ),
                '2' => array(
                    'title' => 'Edit Document'
                )
            );
            $data['bread_crump_data'] = bread_crump_maker($breadcrump);
            if ($onload == 1) {
                $data_pre = $this->ADModel->get_document_byid($data_prep);
                $data['document_data'] = $data_pre['data']['0'];
                $this->load->view('admission/edit_document', $data);
            } else {
                $data_prep['inst_id']               = $this->session->userdata('inst_id');
                $data_prep['document_id']           = strtoupper(filter_input(INPUT_POST, 'doc_id', FILTER_SANITIZE_STRING));
                $data_prep['document_name']         = strtoupper(filter_input(INPUT_POST, 'document_name', FILTER_SANITIZE_STRING));
                $data_prep['isrequired']            = strtoupper(filter_input(INPUT_POST, 'isrequired', FILTER_SANITIZE_STRING));
                $data_prep['action']                = 'edit_documents';
                $data_prep['controller_function']   = 'Student_settings/Admission_controller/update_needed_documents';
                $data_prep['user_id']               =  $this->session->userdata('userid');

                $this->form_validation->set_rules('document_name', 'document_name', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    // 
                    $documents_data = $this->ADModel->add_documents($data_prep);
                    if (is_array($documents_data) && $documents_data['status'] == 1) {
                        if ($documents_data['data']['error_status'] == 1) {
                            $this->session->set_flashdata('error_message', $documents_data['data']['message']);
                            echo json_encode(array('status' => 2, 'message' => $documents_data['data']['message'], 'view' => ''));
                        } else {
                            $this->session->set_flashdata('success_message', $data_prep['document_name'] . " added successfully.");
                            echo json_encode(array('status' => 1, 'view' => ''));
                        }

                        return;
                    }
                } else {
                }
            }
        }
    }
    public function save_temp_documents()
    {
        $config['encrypt_name']         = true;
        $config['upload_path']          = './uploads/documents/temp_registration/';
        $config['allowed_types']        = 'jpg|png|jpeg|pdf';
        $image = '';
        $tried_check = 0;
        $inst_id = $this->input->post('inst_id');
        $temp_id = $this->input->post('temp_id');
        $fileverified = $this->input->post('fileverified'); // this for updated existing file
        // $pdf_files = array();
        if (!is_dir('./uploads/documents/temp_registration/')) {
            mkdir('./uploads/documents/temp_registration/', 0777, TRUE);
        }
        $this->load->library('upload', $config);
        if ($fileverified == 4) {
            $update_data = $this->ADModel->get_uploaded_documents($temp_id, $this->session->userdata('inst_id'));
            $update_data = $update_data['data'];

            $row_count_inputs = $this->input->post('totoal_count_row');

            $xml_data = "<student>";
            $xml_data_rein = "<student>";
            for ($i = 1; $i <= $row_count_inputs; $i++) {
                $field_name = $this->input->post('block_box' . $i . '_name');
                $check_true = 0;
                $current_key = "";
                foreach ($update_data['data'] as $keyd => $userdetails) {
                    $ars = in_array($field_name, $userdetails);
                    if ($ars == true) {
                        $current_key = $keyd;
                        $check_true = 1;
                    }
                }

                if ($update_data['data_status'] == 1) {

                    $inc = 1;
                    if ($check_true == 1) {
                        $userdetails = $update_data['data'][$current_key];

                        if ($userdetails['document_name'] == $field_name) {
                            if ($userdetails['isverified'] == 2) {
                                $file_ext = $userdetails['file_1_type'];
                                $xml_data = $xml_data . "<studentDetails>";
                                $xml_data = $xml_data . "<document_id>" . $userdetails['document_id'] . "</document_id>";
                                $xml_data = $xml_data . "<temp_id>" . $userdetails['temp_id'] . "</temp_id>";
                                $xml_data = $xml_data . "<file_1>" . $userdetails['file_1'] . "</file_1>";
                                $xml_data = $xml_data . "<file_1_type>" . $userdetails['file_1_type'] . "</file_1_type>";
                                $xml_data = $xml_data . "<file_2></file_2>";
                                $xml_data = $xml_data . "<file_2_type></file_2_type>";
                                $xml_data = $xml_data . "<file_3></file_3>";
                                $xml_data = $xml_data . "<file_3_type></file_3_type>";
                                $xml_data = $xml_data . "<modified_by>" . $temp_id . "</modified_by>";
                                $xml_data = $xml_data . "<isverified>" . 2 . "</isverified>";
                                $xml_data = $xml_data . "</studentDetails>";

                                if ($file_ext == ".pdf" || $file_ext == ".PDF") {
                                    $pdf_files[] = $userdetails['file_1'];
                                } else {
                                    $aext       = explode('.', $userdetails['file_1']);
                                    $pdf_files[] = $aext[0] . ".pdf";
                                }
                            } else if ($userdetails['document_name'] == $field_name) {
                                if (!$this->upload->do_upload('block_box' . $i . '_image')) {
                                    // echo "upload error";
                                    $field_image = "";
                                    $file_ext = "";
                                } else {
                                    $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                                    $field_image = $upload_data['file_name'];
                                    $file_ext = $upload_data['file_ext'];
                                    //  $field_name =$this->input->post('block_box'.$inc.'_name');

                                    if ($file_ext == ".pdf" || $file_ext == ".PDF") {
                                        $pdf_files[] = $field_image;
                                        //  $pdf->addPDF(FCPATH.'/assets/Uploads/documents/temp_registration/' . $field_image, 'all');
                                    } else {
                                        //  $imgtopdf->Image(FCPATH.'/assets/Uploads/documents/temp_registration/' . $field_image, 400, 800, 400, 800, $file_ext, '', '', true, 150, '', false, false, 1, false, false, false);
                                        $aext       = explode('.', $field_image);
                                        $pdf_files[] = $this->imagetopdf($aext[0], $aext[1]);
                                    }
                                }
                                $xml_data = $xml_data . "<studentDetails>";
                                $xml_data = $xml_data . "<document_id>" . $userdetails['document_id'] . "</document_id>";
                                $xml_data = $xml_data . "<temp_id>" . $temp_id . "</temp_id>";
                                $xml_data = $xml_data . "<file_1>" . $field_image . "</file_1>";
                                $xml_data = $xml_data . "<file_1_type>" . $file_ext . "</file_1_type>";
                                $xml_data = $xml_data . "<file_2></file_2>";
                                $xml_data = $xml_data . "<file_2_type></file_2_type>";
                                $xml_data = $xml_data . "<file_3></file_3>";
                                $xml_data = $xml_data . "<file_3_type></file_3_type>";
                                $xml_data = $xml_data . "<modified_by>" . $temp_id . "</modified_by>";
                                $xml_data = $xml_data . "<isverified>" . 1 . "</isverified>";
                                $xml_data = $xml_data . "</studentDetails>";
                            }
                        }

                        $inc++;
                    } else {
                        $tried_check = 2;
                        if (!$this->upload->do_upload('block_box' . $i . '_image')) {
                            // echo "upload error";
                            $field_image = "";
                            $file_ext = "";
                        } else {
                            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                            $field_image = $upload_data['file_name'];
                            $file_ext = $upload_data['file_ext'];
                            //  $field_name =$this->input->post('block_box'.$inc.'_name');

                            if ($file_ext == ".pdf" || $file_ext == ".PDF") {
                                $pdf_files[] = $field_image;
                                //  $pdf->addPDF(FCPATH.'/assets/Uploads/documents/temp_registration/' . $field_image, 'all');
                            } else {
                                //  $imgtopdf->Image(FCPATH.'/assets/Uploads/documents/temp_registration/' . $field_image, 400, 800, 400, 800, $file_ext, '', '', true, 150, '', false, false, 1, false, false, false);
                                $aext       = explode('.', $field_image);
                                $pdf_files[] = $this->imagetopdf($aext[0], $aext[1]);
                            }
                        }
                        $xml_data_rein = $xml_data_rein . "<studentDetails>";
                        $xml_data_rein = $xml_data_rein . "<inst_id>" . $inst_id . "</inst_id>";
                        $xml_data_rein = $xml_data_rein . "<temp_id>" . $temp_id . "</temp_id>";
                        $xml_data_rein = $xml_data_rein . "<document_name>" . $field_name . "</document_name>";
                        $xml_data_rein = $xml_data_rein . "<file_1>" . $field_image . "</file_1>";
                        $xml_data_rein = $xml_data_rein . "<file_1_type>" . $file_ext . "</file_1_type>";
                        $xml_data_rein = $xml_data_rein . "<file_2>" . $field_image . "</file_2>";
                        $xml_data_rein = $xml_data_rein . "<file_2_type>" . $file_ext . "</file_2_type>";
                        $xml_data_rein = $xml_data_rein . "<file_3>" . $field_image . "</file_3>";
                        $xml_data_rein = $xml_data_rein . "<file_3_type>" . $file_ext . "</file_3_type>";
                        $xml_data_rein = $xml_data_rein . "<priority>" . $i . "</priority>";
                        $xml_data_rein = $xml_data_rein . "<created_by>" . $temp_id . "</created_by>";
                        $xml_data_rein = $xml_data_rein . "</studentDetails>";
                    }
                }
            }
            $xml_data .= "</student>";
            $xml_data_rein .= "</student>";

            $new_file  = $this->pdf_merger($pdf_files);
            $xml_data2 = "<student>";
            $xml_data2 = $xml_data2 . "<studentDetails>";
            $xml_data2 = $xml_data2 . "<temp_id>" . $temp_id . "</temp_id>";
            $xml_data2 = $xml_data2 . "<file_1>" . $new_file . "</file_1>";
            $xml_data2 = $xml_data2 . "<file_1_type>.pdf</file_1_type>";
            $xml_data2 = $xml_data2 . "<modified_by>" . $temp_id . "</modified_by>";
            $xml_data2 = $xml_data2 . "<isverified>" . 1 . "</isverified>";
            $xml_data2 = $xml_data2 . "</studentDetails>";
            $xml_data2 .= "</student>";
            $documenxt_data  = $this->ADModel->update_user_details($temp_id, $inst_id, $xml_data);
            if ($tried_check == 2) {
                $documenxt_data2 = $this->ADModel->save_user_details($temp_id, $inst_id, $xml_data_rein);
            }
            $documenxt_data1 = $this->ADModel->update_user_details_verified($temp_id, $inst_id, $xml_data2);
        } else {
            $row_count_inputs = $this->input->post('totoal_count_row');
            $xml_data = "<student>";
            // MERGER FILES

            for ($i = 1; $i <= $row_count_inputs; $i++) {
                //  $_FILES['block_box'.$i.'_image']
                $field_name = $this->input->post('block_box' . $i . '_name');

                if (!$this->upload->do_upload('block_box' . $i . '_image')) {
                    $field_image = "";
                    $file_ext = "";
                } else {
                    $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                    $field_image = $upload_data['file_name'];
                    $file_ext = $upload_data['file_ext'];


                    if ($file_ext == ".pdf" || $file_ext == ".PDF") {
                        $pdf_files[] =  $field_image;
                    } else {
                        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
                        $aext       = explode('.', $field_image);
                        $pdf_files[] = $this->imagetopdf($aext[0], $aext[1]);
                    }
                }
                $xml_data = $xml_data . "<studentDetails>";
                $xml_data = $xml_data . "<inst_id>" . $inst_id . "</inst_id>";
                $xml_data = $xml_data . "<temp_id>" . $temp_id . "</temp_id>";
                $xml_data = $xml_data . "<document_name>" . $field_name . "</document_name>";
                $xml_data = $xml_data . "<file_1>" . $field_image . "</file_1>";
                $xml_data = $xml_data . "<file_1_type>" . $file_ext . "</file_1_type>";
                $xml_data = $xml_data . "<file_2>" . $field_image . "</file_2>";
                $xml_data = $xml_data . "<file_2_type>" . $file_ext . "</file_2_type>";
                $xml_data = $xml_data . "<file_3>" . $field_image . "</file_3>";
                $xml_data = $xml_data . "<file_3_type>" . $file_ext . "</file_3_type>";
                $xml_data = $xml_data . "<priority>" . $i . "</priority>";
                $xml_data = $xml_data . "<created_by>" . $temp_id . "</created_by>";
                $xml_data = $xml_data . "</studentDetails>";
            }

            $xml_data = $xml_data . "</student>";

            $new_file  = $this->pdf_merger($pdf_files);

            $xml_data1 = "<student>";
            $xml_data1 = $xml_data1 . "<studentDetails>";
            $xml_data1 = $xml_data1 . "<temp_id>" . $temp_id . "</temp_id>";
            $xml_data1 = $xml_data1 . "<file_1>" . $new_file . "</file_1>";
            $xml_data1 = $xml_data1 . "<file_1_type>.pdf</file_1_type>";
            $xml_data1 = $xml_data1 . "<created_by>" . $temp_id . "</created_by>";
            $xml_data1 = $xml_data1 . "</studentDetails>";
            $xml_data1 = $xml_data1 . "</student>";

            $documenxt_data = $this->ADModel->save_user_details($temp_id, $inst_id, $xml_data);
            $documenxt_data1 = $this->ADModel->save_user_details_verified($temp_id, $inst_id, $xml_data1);
        }
        $ems_sts = $this->email_upload_success($temp_id, $inst_id);
        echo json_encode(array('status' => 1, 'message' => 'Updloaded Successfully'));
        return true;
    }
    public function imagetopdf($image, $image_ext)
    {
        $pdftcd = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $filename = $image . "." . $image_ext;
        $pdftcd->AddPage();
        $pdftcd->setJPEGQuality(90);
        $pdftcd->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdftcd->Image(FCPATH . '/uploads/documents/temp_registration/' . $filename, '', '', 195, 266, $image_ext, '', '', true, 150, '', false, false, 1, false, false, false);
        $pdftcd->Output(FCPATH . '/uploads/documents/temp_registration/' . $image . '.pdf', 'F');
        return $image . '.pdf';
    }
    public function pdf_merger($pdf_files)
    {
        $pdf = new PDFMerger;
        $new_file = md5(time() . rand(1, 10)) . '.pdf';
        if ($pdf_files) {
            foreach ($pdf_files as $file) {
                $pdf->addPDF(FCPATH . '/uploads/documents/temp_registration/' . $file, 'all');
            }

            $new_file = md5(time() . rand(1, 10)) . '.pdf';
            $pdf->merge('file', FCPATH . '/uploads/documents/temp_registration/' . $new_file);
        } else {
            $new_file = '';
        }
        return $new_file;
    }

    public function document_change_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $document_id = filter_input(INPUT_POST, 'document_id', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($document_id);die;
            if (isset($document_id) && !empty($document_id)) {
                $data_prep['status'] = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                if ($data_prep['status'] == -1) {
                    $data_prep['status'] = 0;
                }
                $data_prep['document_id'] = filter_input(INPUT_POST, 'document_id', FILTER_SANITIZE_STRING);
                $status = $this->ADModel->document_change_status($data_prep);
                if (isset($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status['message'], 'data' => ''));
                        return;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                        return;
                    }
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
    public function document_change_isrequired()
    {
        if ($this->input->is_ajax_request() == 1) {
            $document_id = filter_input(INPUT_POST, 'document_id', FILTER_SANITIZE_NUMBER_INT);
            //            dev_export($document_id);die;
            if (isset($document_id) && !empty($document_id)) {
                $data_prep['isrequired'] = filter_input(INPUT_POST, 'isrequired', FILTER_SANITIZE_NUMBER_INT);
                if ($data_prep['isrequired'] == -1) {
                    $data_prep['isrequired'] = 0;
                }
                $data_prep['document_id'] = filter_input(INPUT_POST, 'document_id', FILTER_SANITIZE_STRING);
                $status = $this->ADModel->update_document_isrequired($data_prep);
                if (isset($status['data_status']) && $status['data_status'] == 1) {
                    echo json_encode(array('status' => 1, 'view' => ''));
                    return;
                } else {
                    if (isset($status['message']) && !empty($status['message'])) {
                        echo json_encode(array('status' => 0, 'message' => $status['message'], 'data' => ''));
                        return;
                    } else {
                        echo json_encode(array('status' => 0, 'message' => INVALID_REQUEST_MESSAGE, 'data' => ''));
                        return;
                    }
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

    public function show_load_staff()
    {
        $this->check_login();
        $data['title'] = 'Admission Management';
        $data['sub_title'] = 'Assign Staff';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Admission Management',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Assign Staff'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        $data['documents_data'] = $this->ADModel->get_all_document_list();
        $class = $this->ONRegistration->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data_for_registration'] = $class['data'];
            } else {
                $data['class_data_for_registration'] = FALSE;
            }
        } else {
            $data['class_data_for_registration'] = FALSE;
        }
        //        ACD YEAR DATA
        $acdyr = $this->ONRegistration->get_all_acadyr();
        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
            if ($acdyr['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        //  $this->load->view('settings/show_payment_status', $data);
        $this->load->view('staff/show_staff_documents_list', $data);
    }
    public function show_verify_documents()
    {
        $this->check_login();
        $data['template']  = 'admission/show_verify_documents_list';
        $data['title']     = 'Admission Management';
        $data['sub_title'] = 'Verify Documents';
        $breadcrump = array(
            '0' => array(
                'link' => base_url('dashboard'),
                'title' => 'Home'
            ),
            '1' => array(
                'title' => 'Admission Management',
                'link' => base_url()
            ),
            '2' => array(
                'title' => 'Verify Documents'
            )
        );
        $data['bread_crump_data'] = bread_crump_maker($breadcrump);
        // 
        $class = $this->ONRegistration->get_all_class();
        if (isset($class['error_status']) && $class['error_status'] == 0) {
            if ($class['data_status'] == 1) {
                $data['class_data_for_registration'] = $class['data'];
            } else {
                $data['class_data_for_registration'] = FALSE;
            }
        } else {
            $data['class_data_for_registration'] = FALSE;
        }
        //        ACD YEAR DATA
        $acdyr = $this->ONRegistration->get_all_acadyr();
        if (isset($acdyr['error_status']) && $acdyr['error_status'] == 0) {
            if ($acdyr['data_status'] == 1) {
                $data['acdyr_data'] = $acdyr['data'];
            } else {
                $data['acdyr_data'] = FALSE;
            }
        } else {
            $data['acdyr_data'] = FALSE;
        }

        //  $this->load->view('settings/show_payment_status', $data);
        $this->load->view('template/home_template', $data);
    }
    public function update_user_documents()
    {
        if ($this->input->is_ajax_request() == 1) {
            $verify_table = $this->input->post("verify_table");
            $json_decode   = json_decode($verify_table, true);
            // $xml_data = "<student>";
            $test = 1;
            foreach ($json_decode as $value) {

                // $xml_data = $xml_data . "<studentDetails>";
                if (isset($value["temp_id"])) {
                    $temp_id = $value["temp_id"];
                    $ret['temp_id'] = $value["temp_id"];
                }
                if (isset($value["inst_id"])) {
                    $inst_id = $value["inst_id"];
                    $ret['inst_id'] = $value["inst_id"];
                }
                if (isset($value["document_id"])) {
                    $document_id = $value["document_id"];
                }
                if (isset($value["check_verify"])) {
                    $isverified = $value["check_verify"];
                    if ($isverified == 1) {
                        $isverified = 2;
                    } else if ($isverified == 0) {
                        $isverified = 3;
                    }
                }
                if (isset($value["remarks"])) {
                    $ret['remarks'] = $value["remarks"];
                }
                if (isset($value["data_accept"])) {
                    $ret['data_accept'] = $value["data_accept"];
                }
                if (isset($value["document_id"])) {
                    $documents_data = $this->ADModel->update_documents($temp_id, $inst_id, $document_id, $isverified);
                }
            }

            $documents_dataver = $this->ADModel->update_user_documents_verified($ret['temp_id'], $ret['data_accept'], $ret['remarks']);
            if ($ret['data_accept'] == 2) {
                // accept
                $file_url = "online-registration/student-progress-status/";
                $subject = "Document verified successfully : " . date('d-m-Y');
                $message_success = "Document verified successfully.";
                $bodycontent = "Your document has been verified successfully. If you need more details, click the button below";
                $emal_status = $this->document_status_send_email($ret['temp_id'], $ret['inst_id'], $file_url, $subject, $bodycontent);
            } else if ($ret['data_accept'] == 3) {
                //  reject
                $file_url = "online-registration/student-progress-status/";
                $subject = "Document has been rejected : " . date('d-m-Y');
                $message_success = "Document has been rejected.";
                $bodycontent = "Your document has been rejected. If you need more details, click the button below";
                $emal_status =  $this->document_status_send_email($ret['temp_id'], $ret['inst_id'], $file_url, $subject, $bodycontent);
            } else if ($ret['data_accept'] == 4) {
                // resubmit
                $file_url = "online-registration/document-upload/";
                $subject = "Resubmit the Documents : " . date('d-m-Y');
                $message_success = "Documents have to be resubmitted.";
                $bodycontent = "Your document has been verified and need to resubmit the documents for further processing. Please upload the files again, by clicking the button below";
                $emal_status = $this->document_status_send_email($ret['temp_id'], $ret['inst_id'], $file_url, $subject, $bodycontent);
            }
            echo json_encode(array('status' => 1, 'message' => $message_success, 'view' => ''));
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function update_user_documents_bystaff()
    {
        if ($this->input->is_ajax_request() == 1) {
            $verify_table = $this->input->post("verify_table");
            $json_decode   = json_decode($verify_table, true);
            // $xml_data = "<student>";
            $test = 1;
            foreach ($json_decode as $value) {

                // $xml_data = $xml_data . "<studentDetails>";
                if (isset($value["temp_id"])) {
                    $temp_id = $value["temp_id"];
                    $ret['temp_id'] = $value["temp_id"];
                }
                if (isset($value["emp_id"])) {
                    $emp_id = $value["emp_id"];
                    $ret['emp_id'] = $value["emp_id"];
                }
                if (isset($value["inst_id"])) {
                    $inst_id = $value["inst_id"];
                    $ret['inst_id'] = $value["inst_id"];
                }
                if (isset($value["document_id"])) {
                    $document_id = $value["document_id"];
                }
                if (isset($value["check_verify"])) {
                    $isverified = $value["check_verify"];
                    if ($isverified == 1) {
                        $isverified = 2;
                    } else if ($isverified == 0) {
                        $isverified = 3;
                    }
                }
                if (isset($value["remarks"])) {
                    $ret['remarks'] = $value["remarks"];
                }
                if (isset($value["data_accept"])) {
                    $ret['data_accept'] = $value["data_accept"];
                }
                if (isset($value["document_id"])) {
                    $documents_data = $this->ADModel->update_documents_bystaff($temp_id, $inst_id, $document_id, $isverified, $emp_id);
                }
            }

            $documents_dataver = $this->ADModel->update_user_documents_verified_bystaff($ret['temp_id'], $ret['data_accept'], $ret['remarks'], $ret['emp_id']);
            if ($ret['data_accept'] == 2) {
                // accept
                $file_url = "online-registration/student-progress-status/";
                $subject = "Document verified successfully : " . date('d-m-Y');
                $message_success = "Document verified successfully.";
                $bodycontent = "Your document has been verified successfully. If you need more details, click the button below";
                $emal_status = $this->document_status_send_email($ret['temp_id'], $ret['inst_id'], $file_url, $subject, $bodycontent);
            } else if ($ret['data_accept'] == 3) {
                //  reject
                $file_url = "online-registration/student-progress-status/";
                $subject = "Document has been rejected : " . date('d-m-Y');
                $message_success = "Document has been rejected.";
                $bodycontent = "Your document has been rejected. If you need more details, click the button below";
                $emal_status =  $this->document_status_send_email($ret['temp_id'], $ret['inst_id'], $file_url, $subject, $bodycontent);
            } else if ($ret['data_accept'] == 4) {
                // resubmit
                $file_url = "online-registration/document-upload/";
                $subject = "Resubmit the Documents : " . date('d-m-Y');
                $message_success = "Document has been Resubmitted.";
                $bodycontent = "Your document has been verified and need to resubmit the documents for further processing. Please upload the files again, by clicking the button below";
                $emal_status = $this->document_status_send_email($ret['temp_id'], $ret['inst_id'], $file_url, $subject, $bodycontent);
            }
            echo json_encode(array('status' => 1, 'message' => $message_success, 'view' => ''));
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function document_status_send_email($temp_id, $inst_id, $file_url, $subject, $bodycontent)
    {
        $enc_temp_id = encrypt_data_for_url($temp_id);
        $enc_inst_id = encrypt_data_for_url($inst_id);
        $data["inst_id"] = $inst_id;
        $data["bodycontent"] = $bodycontent;
        // $data['upload_link_url'] = $file_url;
        $data['upload_link_url'] = base_url() . $file_url . $enc_inst_id . "/" . $enc_temp_id;
        $temp_data = $this->ADModel->get_temp_user_details($temp_id, $inst_id);
        $data['temp_data'] = $temp_data['data']['data'][0];
        $this->load->helper('mailgun');
        $mailto = $data['temp_data']['L_mail'];

        $mailcontent =  $this->load->view('admission/email-template', $data, true);
        $cc = "";
        //  $email_res = sendgrid_mailer($subject, $mailto, $mailcontent, $cc);
        $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);
        return $email_res;
    }
    public function student_progress_status($instid = 0, $tempid = 0)
    {
        $inst_id = decrypt_data_for_url($instid);
        $tempid = decrypt_data_for_url($tempid);
        if ($this->session->userdata('API-Key') == '' || $inst_id != $this->session->userdata('inst_id')) {
            //$this->session->set_userdata('API-Key', $api_key); //
            $this->session->set_userdata('inst_id', $inst_id);
            $apiKEYS = $this->ONRegistration->get_all_api_keys($inst_id);
            if (isset($apiKEYS['error_status']) && $apiKEYS['error_status'] == 0) {
                if ($apiKEYS['data_status'] == 1) {
                    $api_key_data = $apiKEYS['data'];
                } else {
                    $api_key_data = FALSE;
                }
            } else {
                $api_key_data = FALSE;
            }
            $api_key = $api_key_data['api_key'];

            $this->session->set_userdata('API-Key', $api_key); //
            //All apikeys
        }
        $data['inst_id'] = $inst_id;
        $data['temp_id'] = $tempid;

        $user_data = $this->ADModel->get_temp_user_details($data['temp_id'], $data['inst_id']);
        $user_timeline_data = $this->ADModel->get_temp_timeline_details($data['temp_id']);
        $data['user_data'] = $user_data['data']['data'][0];
        $data['template'] = 'admission/student_progress_status';
        $data['user_timeline_data'] = $user_timeline_data['data']['data'];
        $this->load->view('template/online_admission_template', $data);
        //  $this->load->view('admission/student_progress_status',$data);
    }
    public function get_document_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id       = filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $academic_year  = filter_input(INPUT_POST, 'acd_yr', FILTER_SANITIZE_NUMBER_INT);
            $flag           = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);

            $data['class_id']   = $class_id;
            $data['acd_yr']     = $academic_year;
            $data['flag']       = $flag;
            $status             = $this->ONRegistration->get_all_temp_students_registration_documents($data);

            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                $data['class_fee_data'] = $status['data'];
                echo json_encode(array('status' => 1, 'message' => 'Loaded Successfully', 'view' => $this->load->view('admission/temp_document_status_view', $data, true)));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    $data['class_fee_data'] = [];
                    echo json_encode(array('status' => 1, 'message' => $status['message'], 'view' => $this->load->view('admission/temp_document_status_view', $data, true)));
                    return false;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            }
        }
    }
    public function get_staff_status()
    {
        if ($this->input->is_ajax_request() == 1) {
            $class_id           =   filter_input(INPUT_POST, 'class_id', FILTER_SANITIZE_NUMBER_INT);
            $academic_year      =   filter_input(INPUT_POST, 'acd_yr', FILTER_SANITIZE_NUMBER_INT);
            $flag               =   filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_NUMBER_INT);
            $inst_id            =   $this->session->userdata('inst_id');
            $data['class_id']   =   $class_id;
            $data['acd_yr']     =   $academic_year;
            $data['flag']       =   $flag;
            $status             =   $this->ONRegistration->get_all_temp_students_registration_documents($data);
            $staff_details      =   $this->ADModel->get_all_staff_details($inst_id);

            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                $data['class_fee_data'] = $status['data'];
                if (isset($staff_details['data_status']) && !empty($staff_details['data_status']) && $staff_details['data_status'] == 1) {
                    $data['staff_details'] = $staff_details['data'];
                }

                echo json_encode(array('status' => 1, 'message' => 'Loaded Successfully', 'view' => $this->load->view('staff/temp_staff_status_view', $data, true)));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    $data['class_fee_data'] = [];
                    echo json_encode(array('status' => 1, 'message' => $status['message'], 'view' => $this->load->view('staff/temp_staff_status_view', $data, true)));
                    return false;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            }
        }
    }
    public function allocate_registration_documents()
    {
        if ($this->input->is_ajax_request() == 1) {
            $checked_temp_ids = filter_input(INPUT_POST, 'checked_temp_ids', FILTER_SANITIZE_STRING);
            $flag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_STRING);
            $isverified = filter_input(INPUT_POST, 'isverified', FILTER_SANITIZE_STRING);

            $this->load->helper('mailgun');
            $data_prep['isverified'] = $isverified;
            $data_prep['checked_temp_ids'] = $checked_temp_ids;
            if ($flag != '') {
                $data_prep['flag'] = $flag; //For getting the failed payment details flag=3
            } else {
                $data_prep['flag'] = 0;
            }
            if ($isverified == 1) {
                $userdata = $this->ADModel->get_temp_user_details($checked_temp_ids, $this->session->userdata('inst_id'));
                $status    = $userdata['data'];
                $documents_data = $this->ADModel->get_uploaded_documents($checked_temp_ids, $this->session->userdata('inst_id'));
                $data['documents_data'] = $documents_data['data']['data'];
            }

            if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
                $data['user_data'] = $status['data'][0];
                echo json_encode(array('status' => 1, 'message' => 'Loaded Successfully', 'view' => $this->load->view('admission/details_temp_registration', $data, true)));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    $data['user_data'] = [];
                    echo json_encode(array('status' => 1, 'message' => $status['message'], 'view' => $this->load->view('admission/details_temp_registration', $data, true)));
                    return false;
                } else {
                    echo json_encode(array('status' => 2, 'message' => 'Data error. Please contact administrator'));
                    return false;
                }
            }
        }
    }
    public function allocate_staff()
    {
        if ($this->input->is_ajax_request() == 1) {
            $checked_temp_ids = $this->input->post('checked_temp_ids');
            $staff_id = $this->input->post('staff_id');

            $this->load->helper('mailgun');
            $data_prep['checked_temp_ids'] = $checked_temp_ids;
            $data_prep['staff_id']         = $staff_id;
            $inst_id         = $this->session->userdata('inst_id');


            $xml_data = "<student>";
            for ($i = 0; $i < count($checked_temp_ids); $i++) {
                $xml_data = $xml_data . "<studentDetails>";
                $xml_data = $xml_data . "<temp_id>" . $checked_temp_ids[$i] . "</temp_id>";
                $xml_data = $xml_data . "<verify_by>" . $staff_id . "</verify_by>";
                $xml_data = $xml_data . "<modified_by>" . $this->session->userdata('userid') . "</modified_by>";
                $xml_data = $xml_data . "</studentDetails>";
            }
            $xml_data = $xml_data . "</student>";
            $documenxt_data = $this->ADModel->assign_staff_for_verification($staff_id, $inst_id, $xml_data);
            echo json_encode(array('status' => 1, 'message' => 'Staff Assigned Successfully', 'view' => ''));
        }
    }

    public function save_interview_schedule()
    {
        if ($this->input->is_ajax_request() == 1) {
            $this->check_login();
            $data_prep['inst_id']       = $this->session->userdata('inst_id');
            $data_prep['interview_date'] = strtoupper(filter_input(INPUT_POST, 'sch_date', FILTER_SANITIZE_STRING));
            $data_prep['interview_time'] = strtoupper(filter_input(INPUT_POST, 'sch_time', FILTER_SANITIZE_STRING));
            $data_prep['temp_id']        = strtoupper(filter_input(INPUT_POST, 'temp_id', FILTER_SANITIZE_STRING));
            $data_prep['stud_name']      = strtoupper(filter_input(INPUT_POST, 'stud_name', FILTER_SANITIZE_STRING));
            $data_prep['action']         = 'save_interview_schedule';
            $data_prep['controller_function'] = 'Student_settings/Admission_controller/save_interview_schedule';
            $data_prep['user_id']        = $this->session->userdata('userid');

            $this->form_validation->set_rules('sch_date', 'sch_date', 'trim|required');
            $this->form_validation->set_rules('sch_time', 'sch_time', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $documents_data = $this->ADModel->save_interview_schedule($data_prep);
                if (is_array($documents_data) && $documents_data['data_status'] == 1) {
                    // $this->session->set_flashdata('success_message', "Interview Scheduled Successfully For". $data_prep['stud_name']);
                    echo json_encode(array('status' => 1, 'message' => " interview scheduled successfully for " . $data_prep['stud_name'] . ".", 'view' => ''));
                    return;
                }
            } else {
            }
        }
    }
    public function update_interview_scheduled()
    {
        if ($this->input->is_ajax_request() == 1) {
            $this->check_login();
            $data_prep['inst_id']       = $this->session->userdata('inst_id');
            $data_prep['schdld_id'] = strtoupper(filter_input(INPUT_POST, 'schid', FILTER_SANITIZE_STRING));
            $data_prep['interview_date'] = strtoupper(filter_input(INPUT_POST, 'sch_date', FILTER_SANITIZE_STRING));
            $data_prep['interview_time'] = strtoupper(filter_input(INPUT_POST, 'sch_time', FILTER_SANITIZE_STRING));
            $data_prep['temp_id']        = strtoupper(filter_input(INPUT_POST, 'temp_id', FILTER_SANITIZE_STRING));
            $data_prep['stud_name']      = strtoupper(filter_input(INPUT_POST, 'stud_name', FILTER_SANITIZE_STRING));
            $data_prep['action']         = 'update_interview_scheduled';
            $data_prep['controller_function'] = 'Student_settings/Admission_controller/update_interview_scheduled';
            $data_prep['user_id']        = $this->session->userdata('userid');

            $this->form_validation->set_rules('sch_date', 'sch_date', 'trim|required');
            $this->form_validation->set_rules('sch_time', 'sch_time', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $documents_data = $this->ADModel->update_interview_scheduled($data_prep);
                if (is_array($documents_data) && $documents_data['data_status'] == 1) {
                    // $this->session->set_flashdata('success_message', "Interview Scheduled Successfully For". $data_prep['stud_name']);
                    echo json_encode(array('status' => 1, 'message' => $data_prep['stud_name'] . " interview scheduled successfully.", 'view' => ''));
                    return;
                }
            } else {
            }
        }
    }
    public function error_handler_500()
    {
        $this->load->view('template/error-500');
    }

    public function error_handler_500_script()
    {
        $this->session->set_userdata('API-Key', '');
        $this->session->set_userdata('isloggedin', '0');
        $this->session->set_userdata('userid', '');
        $this->session->sess_destroy();
        $this->load->view('template/error-500_script');
    }
    public function test_email()
    {
        $temp_id = 175;
        $inst_id = 5;
        $enc_temp_id = encrypt_data_for_url($temp_id);
        $enc_inst_id = encrypt_data_for_url($inst_id);
        $data["inst_id"] = $inst_id;
        echo  $data['upload_link_url'] = base_url() . "online-registration/student-progress-status/" . $enc_inst_id . "/" . $enc_temp_id;
        exit;
        $temp_data = $this->ADModel->get_temp_user_details($temp_id, $inst_id);

        $data['temp_data'] = $temp_data['data']['data'][0];
        print_r($data['temp_data']);
        exit;
        $this->load->helper('mailgun');
        $subject = "Document Uploaded Successfully : " . date('d-m-Y');
        $mailto = $data['temp_data']['L_mail'];

        $mailcontent =  $this->load->view('admission/email-template-upload', $data, true);
        $cc = "";
        //  $email_res = sendgrid_mailer($subject, $mailto, $mailcontent, $cc);
        $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);
        if ($email_res) {
            echo $email_res;
        } else {
            echo "0";
        }

        // $this->load->view('registration/' . $inst_id . '_email-template-reg-data', $data);

        /*  $data['temp_data'] = 157;
                $data['age_calc_date'] = "21=09-2005";
                $data['age_string'] = 15;
                $data['lastsubmissiondate'] = "21-09-2020";
                $inst_id =5;

                $formatted_address = $this->format_address($data['temp_data']);
                $data['formatted_address'] = $formatted_address;

                $return_data = $this->allocate_registration_payments(157, $inst_id);
                 $data['payment_link'] = "";
                  $this->load->view('registration/' . $inst_id . '_email-template-reg-data', $data); */
    }
    public function send_email($temp_id = 0, $accept_data = 0)
    {
        if ($this->input->is_ajax_request() == 1) {
            $commun_mail = filter_input(INPUT_POST, 'commun_mail', FILTER_SANITIZE_STRING);
            $TempregId = filter_input(INPUT_POST, 'TempregId', FILTER_SANITIZE_NUMBER_INT);
            if (isset($commun_mail) && !empty($commun_mail)) {
                $this->load->helper('mailgun');
                $otp = rand(100000, 999999);
                $flag = 1; //for save OTP
                $data['otp'] = $otp;
                $data['inst_id'] = $this->session->userdata('inst_id');
                $otp_details_save = $this->ONRegistration->select_OTP($TempregId, $otp, $flag);
                if (isset($otp_details_save['error_status']) && $otp_details_save['error_status'] == 0) {
                    if ($otp_details_save['data_status'] == 1) {
                        $email_message = $this->load->view('registration/email-template', $data, true);
                        $subject = "Online Registration OTP Verification : " . date('d-m-Y');
                        $mailto = $commun_mail;
                        $mailcontent = $email_message;
                        $cc = "";
                        $email_res = send_smtp_mailer($subject, $mailto, $mailcontent, $cc);
                        if ($email_res) {
                            echo $email_res;
                        } else {
                            echo "failed";
                        }
                    }
                }
            } else {
                echo 0;
            }
        } else {
            $data['temp_id'] = $temp_id;
            $data['accept_data'] = $accept_data;
            $data['inst_id'] = $this->session->userdata('inst_id');
            $this->load->helper('mailgun');
            $user_data = $this->ADModel->get_temp_user_details($data['temp_id'], $data['inst_id']);
            if ($accept_data == 3) {
                // reject
                $email_message = $this->load->view('registration/show_temp_registration', $data, true);
                $subject = "Online Registration  Verification Failed : " . date('d-m-Y');
            } else if ($accept_data == 4) {
                // resubmit
                $email_message = $this->load->view('registration/show_temp_registration', $data, true);
                $subject = "Online Registration Verification Resubmit : " . date('d-m-Y');
            }

            $mailto = "mailalert@docme.cloud";
            $mailcontent = $email_message;
            $cc = "";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .=  'Content-Type: text/html; charset=UTF-8\r\n';
            $email_res = mail("nizamudeen003@gmail.com", $subject, "sdsds", $headers);
            // $email_res = sendgrid_mailer($subject, $mailto, $mailcontent, $cc);
            if ($email_res) {
                echo $email_res;
            } else {
                echo "failed";
            }
        }
    }

    public function select_OTP()
    {
        if ($this->input->is_ajax_request() == 1) {

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $OTP = filter_input(INPUT_POST, 'OTP', FILTER_SANITIZE_NUMBER_INT);
            $flag = 2; //for select OTP
            if (isset($email) && !empty($email) && isset($OTP) && !empty($OTP)) {
                $otp_details = $this->ONRegistration->select_OTP($email, $OTP, $flag);
                if (isset($otp_details['error_status']) && $otp_details['error_status'] == 0) {
                    if ($otp_details['data_status'] == 1) {
                        $datares = $otp_details['data'];
                        echo json_encode(array('status' => 1, 'data' =>  $datares[0]));
                        return TRUE;
                    } else {
                        echo json_encode(array('status' => 0, 'data' =>  'Please Try Again'));
                        return true;
                    }
                } else {
                    echo json_encode(array('status' => 0, 'data' =>  'Please Try Again'));
                    return true;
                }
            } else {
                echo json_encode(array('status' => 0, 'data' => 'OTP Validation Failed'));
                return true;
            }
        }
    }

    public function logout()
    {
        $this->session->set_userdata('API-Key', '');
        $this->session->set_userdata('isloggedin', '0');
        $this->session->set_userdata('userid', '');
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function generatePdf($institution_id, $data)
    {
        ini_set('memory_limit', -1); // boost the memory limit if it's low ;)
        $data['inst_id'] = $institution_id;

        $html = $this->load->view('pdf-templates/temp-registration-form_' . $institution_id, $data, true); // render the view into HTML 
        // echo $html;
        // exit;
        if (!is_dir(FCPATH . 'reports/online-registration')) {
            mkdir(FCPATH . 'reports/online-registration');
        }
        if (!is_dir(FCPATH . 'reports/online-registration/' . $institution_id)) {
            mkdir(FCPATH . 'reports/online-registration/' . $institution_id);
        }
        $filename_report = 'reports/online-registration/' . $institution_id . '/ONLINE-REG-FORM-' . $data['temp_data']['TempReg_ID'] . '.pdf';
        $pdfFilePath = FCPATH . $filename_report;

        $this->load->library('pdf');

        $pdf = $this->pdf->load();
        $pdf->shrink_tables_to_fit = 1;
        $pdf->WriteHTML($html); // write the HTML into the PDF
        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE); // save to file because we can
        if ($filename_report) {
            return ['status' => 1, 'filename' => $filename_report];
        } else {
            return ['status' => 3, 'message' => 'Report file generation failed. Please try again later'];
        }
    }
    public function dropdown_valitdation()
    {
        $dropdown = strtoupper(filter_input(INPUT_POST, 'dropdown', FILTER_SANITIZE_STRING));
        if (($dropdown == -1)) {
            echo json_encode(array('Select any field.'));
            return true;
        } else {
            echo json_encode('true');
            return true;
        }
    }
    public function sentEmailTempData()
    {

        //if ($this->input->is_ajax_request() == 1) {
        $tempregdata = 157;
        $CommuEmail = filter_input(INPUT_POST, 'CommuEmail', FILTER_SANITIZE_STRING);
        // $age_calc_date = filter_input(INPUT_POST, 'agelimit', FILTER_SANITIZE_STRING);
        // $age_string = filter_input(INPUT_POST, 'agestr', FILTER_SANITIZE_STRING);
        //  $lastsubmissiondate = filter_input(INPUT_POST, 'lastsubmissiondate', FILTER_SANITIZE_STRING);
        $inst_id = $this->session->userdata('inst_id');
        //$inst_id = 5;
        if (isset($tempregdata) && !empty($tempregdata)) {
            $this->load->helper('mailgun');
            $data['temp_data'] = $tempregdata;
            $data['age_calc_date'] = "21=09-2005";
            $data['age_string'] = 15;
            $data['lastsubmissiondate'] = "21-09-2020";

            $formatted_address = $this->format_address($data['temp_data']);
            $data['formatted_address'] = $formatted_address;

            $return_data = $this->allocate_registration_payments(157, $inst_id);
            if (isset($return_data['status'])) {
                $subject = "Online Registration Details : " . date('d-m-Y');
                $mailto = "nizamudeen003@gmail.com";
                $cc = $this->get_cc_email($inst_id);
                if ($return_data['status'] == 1)
                    $data['payment_link'] = $return_data['payment_link'];
                else
                    $data['payment_link'] = '';
                $this->load->view('registration/' . $inst_id . '_email-template-reg-data', $data, true);
                /* $mailcontent = "nizamudeen003@gmail.com";
                    $attachment = $this->generatePdf($inst_id, $data);
                    if (isset($attachment['filename'])) {
                        $attachment_data['filename'] = $attachment['filename'];
                        $attachment_data['filepath'] = '';
                    } else {
                        $attachment_data = [];
                    }
                    $email_res = sendgrid_mailer($subject, $mailto, $mailcontent, $cc, $attachment_data);
                    if ($email_res) {
                        if ($return_data['status'] == 1)
                            echo json_encode(array('status' => 1, 'message' => 'Email Sent', 'payment_link' => $return_data['payment_link']));
                        else
                            echo json_encode(array('status' => 1, 'message' => 'Email Sent', 'payment_link' => ''));
                    } else {
                        echo 0;
                    } */
            }
        } else {
            echo json_encode(array('status' => 0));
            return true;
        }
        //}
    }
    public function allocate_registration_payments($temp_reg_id, $inst_id)
    {
        $this->load->helper('mailgun');
        $data_prep['checked_temp_ids'] = $temp_reg_id;
        $data_prep['flag'] = 0;

        $status = $this->ONRegistration->get_all_temp_students_registration_fees($data_prep);

        if (isset($status['data_status']) && !empty($status['data_status']) && $status['data_status'] == 1) {
            $selected_class_fee_data = $status['data'];
            $payment_data = [];
            foreach ($selected_class_fee_data as $data) {
                $payment_data[] = $data;
            }
            if (sizeof($payment_data) > 0) {

                $json_string = json_encode($payment_data);
                $this->ONRegistration->update_payment_allocation($json_string);
                $payment_link = base_url() . 'registration/online-payment?' . base64_encode('temp_reg_id') . '=' . base64_encode($temp_reg_id) . '&' . base64_encode('school_id') . '=' . base64_encode($inst_id);
            }
            return array('status' => 1, 'message' => 'Allocated Successfully', 'payment_link' => $payment_link);
        } else {
            return array('status' => 2, 'message' => 'Registration Fees Not set');
        }
    }
    function format_address($data)
    {
        $office_address[] = $data['Of_Address1'] == '-'   ? FALSE : $data['Of_Address1'];
        $office_address[] = $data['Of_Address2'] == '-'   ? FALSE : $data['Of_Address2'];
        $office_address[] = $data['Of_Address3'] == '-'  ? FALSE : $data['Of_Address3'];

        $permanent_address[] = $data['O_Address1'] == '-' ? FALSE : $data['O_Address1'];
        $permanent_address[] = $data['O_Address2'] == '-'   ? FALSE : $data['O_Address2'];
        $permanent_address[] = $data['O_Address3'] == '-'   ? FALSE : $data['O_Address3'];

        $communication_address[] = $data['L_Address1'] == '-'   ? FALSE : $data['L_Address1'];
        $communication_address[] = $data['L_Address2'] == '-'  ? FALSE : $data['L_Address2'];
        $communication_address[] = $data['L_Address3'] == '-'  ? FALSE : $data['L_Address3'];

        $office_address_string = implode(" , ", array_filter($office_address));
        $permanent_address_string = implode(" , ", array_filter($permanent_address));
        $communication_address_string = implode(" , ", array_filter($communication_address));

        return [
            'office_address_string' => strlen($office_address_string) == 0 ? '-' : $office_address_string,
            'permanent_address_string' => strlen($permanent_address_string) == 0 ? '-' : $permanent_address_string,
            'communication_address_string' => strlen($communication_address_string) == 0 ? '-' : $communication_address_string
        ];
    }

    function get_cc_email($inst_id)
    {
        switch ($inst_id) {
            case 5:
                $cc_email = SUPPORT_EMAIL_OXFTVM;
                break;
            case 8:
                $cc_email = SUPPORT_EMAIL_OXFKLM;
                break;
            case 20:
                $cc_email = SUPPORT_EMAIL_OXFCLT;
                break;
            default:
                $cc_email = SUPPORT_DEV_TEAM_EMAIL;
                break;
        }

        return $cc_email;
    }
}
