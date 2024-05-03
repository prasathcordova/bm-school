<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of City_management_controller
 *
 * @author chandrajith.edsys
 */
class Documents_controller extends MX_Controller
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
        $this->load->model('Documents_model', 'MDocuments');
    }

    public function show_documents()
    {

        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
            $batchid = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_STRING);
            if (isset($student_id) && !empty($student_id)) {
                //                $data['template'] = 'documents/document_list';
                $data['title'] = 'STUDENT DOCUMENTS';
                $data['sub_title'] = 'Student Documents';

                $data['student_id'] = $student_id;
                $data['batch_id'] = $batchid;

                $data['user_name'] = $this->session->userdata('user_name');

                $student_data = $this->MDocuments->get_profiles_student($student_id);
                //                dev_export($student_data);die;
                if ($student_data['error_status'] == 0 && $student_data['data_status'] == 1) {
                    $data['student_data'] = $student_data['data'][0];
                    $data['message'] = "";
                } else {
                    $data['student_data'] = FALSE;
                    $data['message'] = $student_data['message'];
                }
                $inst_id = $this->session->userdata('inst_id');
                $document_list = $this->MDocuments->get_document_list($student_id, $inst_id);
                //                dev_export($document_list);die;
                $document_count = $this->MDocuments->get_document_count($student_id, $inst_id);
                //                dev_export($document_count);die;
                if ($document_list['error_status'] == 0 && $document_list['data_status'] == 1) {
                    $data['document_list'] = $document_list['data'];
                    //                    $data['message'] = "";
                } else {
                    $data['document_count'] = FALSE;
                    //                    $data['message'] = $document_count['message'];
                }
                if ($document_count['error_status'] == 0 && $document_count['data_status'] == 1) {
                    $data['document_count'] = $document_count['data'][0]['DOC_COUNT'];
                    //                    $data['message'] = "";
                } else {
                    $data['document_count'] = FALSE;
                    //                    $data['message'] = $document_count['message'];
                }
                $breadcrump = array(
                    '0' => array(
                        'link' => base_url('dashboard'),
                        'title' => 'Home'
                    ),
                    '1' => array(
                        'link' => base_url('profile/show-class-for-students'),
                        'title' => 'Registration Management'
                    ),
                    '2' => array(
                        'title' => 'Batch',
                        'function' => "load_students_after_filter_on_breadcrumb('" . $batchid . "','" . $this->session->userdata('acd_year') . "')"
                    ),
                    '3' => array(
                        'title' => 'Student Profile',
                        'function' => "profile_detail('" . $student_id . "')"
                    ),
                    '4' => array(
                        'title' => 'Manage Documents'
                    )
                );
                $data['bread_crump_data'] = bread_crump_maker($breadcrump);
                //                $this->load->view('template/home_template', $data);
                $this->load->view('documents/document_list', $data);
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function delete_uploaded_file_from_local_server()
    {
        $uploadHistory_raw = filter_input(INPUT_POST, 'uploadHistory');
        $file_to_delete = filter_input(INPUT_POST, 'file_to_delete');
        if (isset($uploadHistory_raw) && !empty($uploadHistory_raw)) {
            $uploadHistory = json_decode($uploadHistory_raw, TRUE);
            $delete_flag = 0;
            if (!empty($uploadHistory)) {
                $i = 0;
                foreach ($uploadHistory as $value) {
                    if ($value['local_filename'] == $file_to_delete) {
                        $file_to_delete_from_server = $value['filepath'];
                        if (file_exists($file_to_delete_from_server)) {
                            if (unlink($file_to_delete_from_server)) {
                                $delete_flag = 1;
                                break;
                            }
                        }
                    }
                    $i++;
                }
            }

            if ($delete_flag == 1) {
                array_splice($uploadHistory, $i);
                echo json_encode(array('status' => 1, 'message' => 'File removed successfully.', 'upload_history' => json_encode($uploadHistory)));
            } else {
                if (!empty($uploadHistory)) {
                    $i = 0;
                    foreach ($uploadHistory as $value) {
                        if ($value['local_filename'] == $file_to_delete) {
                            array_splice($uploadHistory, $i);
                            break;
                        }
                    }
                }
                echo json_encode(array('status' => 2, 'message' => 'File is not available and will be removed later, Please try again later', 'upload_history' => json_encode($uploadHistory)));
            }
        } else {
            echo json_encode(array('status' => 1, 'message' => 'File removed successfully.', 'upload_history' => ''));
        }
        return true;
    }

    public function upload_file_to_local_server()
    {
        //        dev_export($_SERVER);die;
        $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
        $uploadHistory_raw = filter_input(INPUT_POST, 'uploadHistory');
        if (!$student_id) {
            $student_id = '';
        }
        $file_name = Filenamegenerator() . date("YmdHis") . $student_id;
        $file_path_for_local_upload = FILE_UPLOAD_PATH . DIRECTORY_SEPARATOR . $file_name;
        $file_path_for_secondary_upload = base_url() . 'assets' . DIRECTORY_SEPARATOR . 'Uploads' . DIRECTORY_SEPARATOR . 'documents' . DIRECTORY_SEPARATOR . $file_name;
        if (file_exists($file_path_for_local_upload)) {
            $file_path_for_local_upload = $file_path_for_local_upload . "_new";
            $file_name = $file_name . "_new";
        }
        $uploadHistory = json_decode($uploadHistory_raw, TRUE);
        //        dev_export($uploadHistory);die;
        if (!empty($uploadHistory)) {
            $index = count($uploadHistory);
        } else {
            $index = 0;
        }

        if (!empty($_FILES)) {

            $name = $_FILES["file"]["name"];
            if ($_FILES["file"]["size"] == 0) {
                echo json_encode(array('status' => 12, 'data' => false, 'message' => 'Max uplode file size 2MB.'));
                return;
            }


            if (isset($uploadHistory) && !empty($uploadHistory) && (count($uploadHistory) > 0)) {
                foreach ($uploadHistory as $value) {
                    if ($value['local_filename'] == $name) {
                        echo json_encode(array('status' => 44, 'data' => FALSE, 'message' => 'Duplicate file name, Please change file name and upload again'));
                        return true;
                    }
                }
            }


            $value = explode(".", $name);
            $ext = strtolower(array_pop($value));
            $file_name = $file_name . '.' . $ext;
            $file_path_for_local_upload = $file_path_for_local_upload . "." . $ext;
            $tempFile = $_FILES['file']['tmp_name'];          //3             
            $uploadHistory[$index] = array(
                'filename' => $file_name,
                'filepath' => $file_path_for_local_upload,
                'local_filename' => $name,
                'file_for_secondary_upload' => $file_path_for_secondary_upload . "." . $ext
            );

            $upload_data = json_encode($uploadHistory);

            move_uploaded_file($tempFile, $file_path_for_local_upload); //6
            echo json_encode(array('status' => 1, 'data' => $upload_data));
            return true;
        } else {
            echo json_encode(array('status' => -1));
            return true;
        }
    }

    public function document_add()
    {
        if ($this->input->is_ajax_request() == 1) {
            $onload = filter_input(INPUT_POST, 'load', FILTER_SANITIZE_NUMBER_INT);

            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_NUMBER_INT);
            $batch_id = filter_input(INPUT_POST, 'batch_id', FILTER_SANITIZE_NUMBER_INT);

            $data['title'] = 'STUDENT DOCUMENTS';
            $data['sub_title'] = 'Student Documents';
            $document_master_title = $this->MDocuments->get_document_type_title();
            if (isset($document_master_title['data']) && !empty($document_master_title['data'])) {
                $data['document_title'] = $document_master_title['data'];
            } else {
                $data['document_title'] = NULL;
            }
            $data['student_id'] = $student_id;
            $data['batch_id'] = $batch_id;
            $data['user_name'] = $this->session->userdata('user_name');

            $this->load->view('documents/add_document', $data);
        }
    }

    public function save_uploaded_file()
    {
        if ($this->input->is_ajax_request() == 1) {
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            if (!(isset($student_id) && !empty($student_id))) {
                echo json_encode(array('status' => -1, 'message' => 'Student ID is required.'));
                return true;
            }
            $files_to_be_uploaded_raw = filter_input(INPUT_POST, 'files_to_be_uploaded');
            $doc_name = filter_input(INPUT_POST, 'doc_name', FILTER_SANITIZE_STRING);
            $doc_id = filter_input(INPUT_POST, 'doc_id', FILTER_SANITIZE_STRING);
            $issue_date = filter_input(INPUT_POST, 'issue_date', FILTER_SANITIZE_STRING);
            $issue_autho = filter_input(INPUT_POST, 'issue_autho', FILTER_SANITIZE_STRING);
            $renew_date = filter_input(INPUT_POST, 'renew_date', FILTER_SANITIZE_STRING);
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
            $other_details = filter_input(INPUT_POST, 'other_details', FILTER_SANITIZE_STRING);
            $data_strg_id = filter_input(INPUT_POST, 'data_strg_id', FILTER_SANITIZE_STRING);
            // dev_export($files_to_be_uploaded_raw);
            // return;
            $files_to_be_uploaded_stage = json_decode($files_to_be_uploaded_raw, TRUE);
            // dev_export($files_to_be_uploaded_stage);
            // die;
            $files_to_be_uploaded = array();

            foreach ($files_to_be_uploaded_stage as $value) {
                if (file_exists($value['filepath'])) {
                    $files_to_be_uploaded[] = $value;
                }
            }



            // if (count($files_to_be_uploaded_stage) != count($files_to_be_uploaded)) {
            //     echo json_encode(array('status' => -1, 'message' => 'Some of the uploaded files are corrupted. Do you want to save'));
            //     return true;
            // }

            $data_prep = array(
                'student_id' => $student_id,
                'inst_id' => $this->session->userdata('inst_id'),
                'doc_name' => $doc_name,
                'doc_id' => $doc_id,
                'issue_date' => $issue_date,
                'issud_authority' => $issue_autho,
                'renew_date' => $renew_date,
                'type' => $type,
                'other_details' => $other_details,
                'storage_id' => $data_strg_id,
                'files_to_be_uploaded' => json_encode($files_to_be_uploaded)
            );
            //          
            $status = $this->MDocuments->save_document_student($data_prep);
            if ($status && isset($status['status']) && !empty($status['status']) && $status['status'] == 1) {

                //$this->remove_temp_files_after_save($files_to_be_uploaded);

                echo json_encode(array('status' => 1, 'message' => 'Documents uploaded successfully'));
                return true;
            } else {
                if (isset($status['message']) && !empty($status['message'])) {
                    echo json_encode(array('status' => -1, 'message' => $status['message']));
                } else {
                    echo json_encode(array('status' => -1, 'message' => 'An error encountered while updating document upload. Please try again later.'));
                }
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function remove_temp_files_after_save($uploaded_files)
    {
        if (isset($uploaded_files) && !empty($uploaded_files)) {
            // dev_export($uploaded_files);
            // return;
            foreach ($uploaded_files as $files_up) {
                unlink($files_up['filepath']);
            }
        }
        return true;
    }

    public function view_file()
    {
        if ($this->input->is_ajax_request() == 1) {
            $file_id = filter_input(INPUT_POST, 'file_id', FILTER_SANITIZE_STRING);
            $doc_id = filter_input(INPUT_POST, 'doc_id', FILTER_SANITIZE_STRING);
            $file_name = filter_input(INPUT_POST, 'file_name', FILTER_SANITIZE_STRING);
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');

            if (isset($file_id) && !empty($file_id) && isset($doc_id) && !empty($doc_id) && isset($file_name) && !empty($file_name)) {
                $file_details = $this->MDocuments->get_file_details_for_view($file_id, $doc_id, $file_name, $student_id, $inst_id);
                if (isset($file_details['data_status']) && !empty($file_details['data_status'])) {

                    $server_file_path = $file_details['file_link'];
                    $local_path = FILE_UPLOAD_PATH . DIRECTORY_SEPARATOR .  $file_name;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $server_file_path);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($ch);
                    curl_close($ch);
                    $file = fopen($local_path, "w+");
                    fputs($file, $data);
                    fclose($file);
                    if (file_exists($local_path)) {
                        $file_link = base_url('assets/Uploads/documents/' . $file_name);
                        header("Content-Description: File Transfer");
                        header("Content-Type: application/octet-stream");
                        header("Content-Disposition: attachment; filename=" . $file_name);
                        //                        readfile ($file_link);
                        echo json_encode(array(
                            'status' => 1,
                            'link' => $file_link,
                            'file_name' => $file_name
                        ));
                        return true;
                    } else {
                        echo json_encode(array(
                            'status' => 2,
                            'message' => 'File information is unavailable'
                        ));
                    }
                } else {
                    echo json_encode(array(
                        'status' => 2,
                        'message' => 'File information is unavailable'
                    ));
                }
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Required pre qualifier data is not available. Please check the data and try again'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function view_file_remove()
    {
        $file_name = filter_input(INPUT_POST, 'file_name', FILTER_SANITIZE_STRING);
        $local_path = FILE_UPLOAD_PATH . DIRECTORY_SEPARATOR . 'download' . DIRECTORY_SEPARATOR . $file_name;
        if (isset($local_path) && file_exists($local_path)) {
            unlink($local_path);
        }
    }

    public function remove_document()
    {
        if ($this->input->is_ajax_request() == 1) {
            $doc_id = filter_input(INPUT_POST, 'doc_id', FILTER_SANITIZE_STRING);
            $student_id = filter_input(INPUT_POST, 'student_id', FILTER_SANITIZE_STRING);
            $inst_id = $this->session->userdata('inst_id');

            $get_remove_status = $this->MDocuments->remove_document($doc_id, $student_id, $inst_id);
            if (isset($get_remove_status['data_status']) && !empty($get_remove_status['data_status']) && $get_remove_status['data_status'] == 1) {
                echo json_encode(array('status' => 1, 'message' => 'Document removed successfully'));
                return true;
            } else {
                echo json_encode(array('status' => 2, 'message' => 'Failed to remove document. Please try again later'));
                return true;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
}
