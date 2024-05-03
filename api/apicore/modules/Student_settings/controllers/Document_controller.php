<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Document_controller
 *
 * @author rahul.shibukumar
 */
class Document_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Document_model', 'MDocument');
    }

    public function get_doc_count($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[1] = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst ID is required', 'data' => FALSE);
        }
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[1] = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        $doc_list = $this->MDocument->get_document_count($dbparams);
        if (!empty($doc_list) && is_array($doc_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $doc_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_doc_list($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[1] = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        $doc_list = $this->MDocument->get_document_list($dbparams);
        if (!empty($doc_list) && is_array($doc_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $doc_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_document_title_master($params) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $title_list = $this->MDocument->get_title_types($dbparams);
        if (!empty($title_list) && is_array($title_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $title_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_student_document_to_student($params) {
        $api_key = $params['API_KEY'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $student_id = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $inst_id = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['doc_name']) && !empty($params['doc_name'])) {
            $doc_name = $params['doc_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['doc_id']) && !empty($params['doc_id'])) {
            $doc_id = $params['doc_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['issue_date']) && !empty($params['issue_date'])) {
            $issue_date = $params['issue_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }

        if (isset($params['issud_authority']) && !empty($params['issud_authority'])) {
            $issud_authority = $params['issud_authority'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['renew_date']) && !empty($params['renew_date'])) {
            $renew_date = $params['renew_date'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['type']) && !empty($params['type'])) {
            $type = $params['type'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['other_details']) && !empty($params['other_details'])) {
            $other_details = $params['other_details'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['storage_id']) && !empty($params['storage_id'])) {
            $storage_id = $params['storage_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }

        if (isset($params['files_to_be_uploaded']) && !empty($params['student_id'])) {
            $files_to_be_uploaded_raw = $params['files_to_be_uploaded'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'File details is required', 'data' => FALSE);
        }

        $files_to_be_uploaded = json_decode($files_to_be_uploaded_raw, TRUE);

        $file_status_flag = 1;
        $file_update_prepare = array();
//        dev_export($files_to_be_uploaded);die;
        if (isset($files_to_be_uploaded) && !empty($files_to_be_uploaded) && count($files_to_be_uploaded) > 0) {
            foreach ($files_to_be_uploaded as $staging_files) {
                $local_path = FILE_UPLOAD_PATH_TEMP . DIRECTORY_SEPARATOR . $staging_files['filename'];
                $status = $this->download_files($staging_files['filename'], $staging_files['file_for_secondary_upload'], $local_path);
                if ($status) {
                    $file_status_flag = 1;
                    $file_update_prepare[] = array(
                        'orginal_file_name' => $staging_files['local_filename'],
                        'uploaded_file_name' => $staging_files['filename'],
                        'uploaded_file_path' => $local_path
                    );
                } else {
                    $file_status_flag = 2;
                }
            }
//            dev_export($file_update_prepare);die;
            if ($file_status_flag == 2) {
                foreach ($files_to_be_uploaded as $staging_files) {
                    $local_path = FILE_UPLOAD_PATH_TEMP . DIRECTORY_SEPARATOR . $staging_files['filename'];
                    if (file_exists($local_path)) {
                        unlink($local_path);
                    }
                }
            } else {

                $data_prep = array(
                    $api_key,
                    $inst_id,
                    $doc_name,
                    $doc_id,
                    $issue_date,
                    $issud_authority,
                    $renew_date,
                    $type,
                    $other_details,
                    $storage_id,
                    $student_id,
                    count($file_update_prepare),
                    json_encode($file_update_prepare)
                );
                $data_status = $this->MDocument->save_document_details($data_prep);
                if (isset($data_status[0]['data_status']) && !empty($data_status[0]['data_status']) && $data_status[0]['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Documents uploaded successfully. ', 'data' => $data_status);
                } else {
                    $file_status_flag = 2;
                    foreach ($files_to_be_uploaded as $staging_files) {
                        $local_path = FILE_UPLOAD_PATH_TEMP . DIRECTORY_SEPARATOR . $staging_files['filename'];
                        if (file_exists($local_path)) {
                            unlink($local_path);
                        }
                    }
                }
            }

            if ($file_status_flag == 2) {
                if (isset($data_status[0]['ErrorMessage']) && !empty($data_status[0]['ErrorMessage'])) {
                    return array('status' => 0, 'message' => 'Failed to upload files to server with message,' . $data_status[0]['ErrorMessage']);
                } else {
                    return array('status' => 0, 'message' => 'Failed to upload files to server with message. Please try again later');
                }
            } else {
                return array('status' => 0, 'message' => 'Failed to upload files to server with message. Please try again later');
            }
        }
    }

    public function download_files($file_name, $file_path, $local_path) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $file_path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        $file = fopen($local_path, "w+");
        fputs($file, $data);
        fclose($file);

        if (file_exists($local_path)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_file_info_to_download($params) {
        $api_key = $params['API_KEY'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $student_id = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $inst_id = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['file_id']) && !empty($params['file_id'])) {
            $file_id = $params['file_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'File ID is required', 'data' => FALSE);
        }
        if (isset($params['doc_id']) && !empty($params['doc_id'])) {
            $doc_id = $params['doc_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Doc ID is required', 'data' => FALSE);
        }
        if (isset($params['file_name']) && !empty($params['file_name'])) {
            $file_name = $params['file_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'File name is required', 'data' => FALSE);
        }

        $file_info = $this->MDocument->get_file_info($api_key, $student_id, $inst_id, $doc_id, $file_id);
        if (isset($file_info) && !empty($file_info)) {
            if (isset($file_info[0]['uploaded_path']) && !empty($file_info[0]['uploaded_path']) && file_exists($file_info[0]['uploaded_path'])) {
                $file_path_for_intermediate_download = FILE_DOWNLOAD_PATH . $file_info[0]['uploaded_file_name'];
                return array('data_status' => 1, 'message' => 'File download link attached.', 'file_link' => $file_path_for_intermediate_download);
            } else {
                return array('data_status' => 0, 'message' => 'File not found on server. Please contact administrator for further assistance.');
            }
        } else {
            return array('data_status' => 0, 'message' => 'File information not found on server. Please contact administrator for further assistance');
        }
    }

    public function remove_document($params) {
        $api_key = $params['API_KEY'];
        if (isset($params['student_id']) && !empty($params['student_id'])) {
            $student_id = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $inst_id = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student ID is required', 'data' => FALSE);
        }
        if (isset($params['doc_id']) && !empty($params['doc_id'])) {
            $doc_id = $params['doc_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Document ID is required', 'data' => FALSE);
        }

        $get_file_details = $this->MDocument->get_file_detais($api_key, $doc_id, $student_id, $inst_id);
        if (isset($get_file_details) && !empty($get_file_details) && count($get_file_details) > 0) {
            foreach ($get_file_details as $file_details) {
                unlink($file_details['uploaded_path']);
            }
            $doc_release_details = $this->MDocument->remove_document($api_key, $doc_id, $student_id, $inst_id);
            if (isset($doc_release_details[0]['status']) && !empty($doc_release_details[0]['status']) && $doc_release_details[0]['status'] == 1) {
                return array('data_status' => 1, 'message' => 'Document removed');
            } else {
                return array('data_status' => 2, 'message' => 'Document cannot be removed.');
            }
        } else {
            return array('data_status' => 2, 'message' => 'Document unable to modify as files are moved.');
        }
    }

//    function curl_get_contents($url, $file_download_path) {
//        // Initiate the curl session
//        $ch = curl_init();
//        // Set the URL
//        curl_setopt($ch, CURLOPT_URL, $url);
//        // Removes the headers from the output
//        curl_setopt($ch, CURLOPT_HEADER, 0);
//        // Return the output instead of displaying it directly
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        // Execute the curl session
////        $output = curl_exec($ch);
//        // Close the curl session
//        dev_export(curl_exec($ch));
//        die;
//        curl_close($ch);
//
//        dev_export($output);
//        die;
//        // Return the output as a variable
//        $file_download_status = file_put_contents($file_download_path, $output);
//        dev_export($file_download_status);
//        die;
////        if ($file_download_status > 0) {
////            $filename = File_name_generator(8);
////            $enc_path = FILE_UPLOAD_PATH . DIRECTORY_SEPARATOR . $filename . ".aes";
////            $dec_path = FILE_UPLOAD_PATH . DIRECTORY_SEPARATOR . $filename . "_new.jpg";
////            echo $enc_path;
////            echo $dec_path;
////            $pass = $this->encrypt_file_for_document($file_download_path, $enc_path, $dec_path);
////        }
//        return $file_download_status;
//    }
//
////    public function encrypt_file_for_document($file_path_to_encrypt, $destination_path, $dec_path) {
//    public function encrypt_file_for_document() {
//        $cls = new Encryptor();
//        $cls->setData();
//        die;
//    }
//
//    public function decrypt_file($params) {
//        
//    }
}
