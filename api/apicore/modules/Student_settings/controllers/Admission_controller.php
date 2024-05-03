<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Batch_controller
 *
 * @author Nizamudeen
 */
class Admission_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admission_model', 'ADmodel');
    }

    public function get_needed_document($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'get_admission_documents';
        /* if (isset($params['document_name']) && !empty($params['document_name'])) {
        $dbparams[2] = $params['document_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Document Name is required', 'data' => FALSE);
        } */
        $dbparams[2] = 0;
        $dbparams[3] = '';

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            $dbparams[4] = 0;
        }
        /* if (isset($params['priority']) && !empty($params['priority'])) {
            $dbparams[4] = $params['priority'];
        } else {
            
        } */

        $dbparams[5] = 0;
        $dbparams[6] = 0;
        $dbparams[7] = '';
        $dbparams[8] = 0;
        $dbparams[9] = 0;
        $dbparams[10] = 0;

        $documents_list  = $this->ADmodel->get_needed_document($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_needed_document_byid($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'get_admission_documents_byid';
        if (isset($params['doc_id']) && !empty($params['doc_id'])) {
            $dbparams[2] = $params['doc_id'];
        } else {
            $dbparams[2] = 0;
        }
        $dbparams[3] = '';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            $dbparams[4] = 0;
        }
        $dbparams[5] = 0;
        $dbparams[6] = 0;
        $dbparams[7] = '';
        $dbparams[8] = 0;
        $dbparams[9] = 0;
        $dbparams[10] = 0;
        $documents_list  = $this->ADmodel->get_needed_document($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function update_needed_documents($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'update_document';
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[2] = $params['document_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['document_name']) && !empty($params['document_name'])) {
            $dbparams[3] = $params['document_name'];
        } else {
            $dbparams[3] = 0;
        }
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            $dbparams[4] = 0;
        }
        $dbparams[5] = 0;
        $dbparams[6] = 0;
        $dbparams[7] = '';
        $dbparams[8] = 0;
        if (isset($params['isrequired']) && !empty($params['isrequired'])) {
            $dbparams[9] = $params['isrequired'];
        } else {
            $dbparams[9] = 0;
        }
        $dbparams[10] = 0;
        $documents_list  = $this->ADmodel->get_needed_document($dbparams);
        if (!empty($documents_list) && is_array($documents_list) && $documents_list['ErrorStatus'] ==0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $documents_list);
        } else if($documents_list['ErrorStatus'] ==1){
            return array('data_status' => 0, 'error_status' => 1, 'message' =>  $documents_list['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_admission_documents_for_user($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'get_admission_documents_for_user';
        /* if (isset($params['document_name']) && !empty($params['document_name'])) {
        $dbparams[2] = $params['document_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Document Name is required', 'data' => FALSE);
        } */
        $dbparams[2] = 0;
        $dbparams[3] = '';

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            $dbparams[4] = 0;
        }
        /* if (isset($params['priority']) && !empty($params['priority'])) {
            $dbparams[4] = $params['priority'];
        } else {
            
        } */

        $dbparams[5] = 0;
        $dbparams[6] = 0;
        $dbparams[7] = '';
        $dbparams[8] = 0;
        $dbparams[9] = 0;
        $dbparams[10] = 0;

        $documents_list  = $this->ADmodel->get_needed_document($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_documents($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'save_admission_documents';
        $dbparams[2] = 0;
        if (isset($params['document_name']) && !empty($params['document_name'])) {
            $dbparams[3] = $params['document_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Document Name is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            $dbparams[4] = 0;
        }
        /* if (isset($params['priority']) && !empty($params['priority'])) {
            $dbparams[4] = $params['priority'];
        } else {
            
        } */
        $dbparams[5] = 0;
        $dbparams[6] = 0;
        $dbparams[7] = '';
        $dbparams[8] = 0;
        if (isset($params['isrequired']) && !empty($params['isrequired'])) {
            $dbparams[9] = $params['isrequired'];
        } else {
            $dbparams[9] = 0;
        }
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $dbparams[10] = $params['user_id'];
        } else {
            $dbparams[10] = 0;
        }

        $documents_list  = $this->ADmodel->get_needed_document($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Saved', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data Saving Error', 'data' => FALSE);
        }
    }
    public function update_document_status($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'update_documents_status';
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[2] = $params['document_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Document Name is required', 'data' => FALSE);
        }
        $dbparams[3] = 0;
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            $dbparams[4] = 0;
        }
        /* if (isset($params['priority']) && !empty($params['priority'])) {
            $dbparams[4] = $params['priority'];
        } else {
            
        } */
        $dbparams[5] = 0;
        $dbparams[6] = 0;
        $dbparams[7] = '';
        if (isset($params['status']) && !empty($params['status'])) {
            $dbparams[8] = $params['status'];
        } else {
            $dbparams[8] = 0;
        }
        if (isset($params['isrequired']) && !empty($params['isrequired'])) {
            $dbparams[9] = $params['isrequired'];
        } else {
            $dbparams[9] = 0;
        }
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $dbparams[10] = $params['user_id'];
        } else {
            $dbparams[10] = 0;
        }

        $documents_list  = $this->ADmodel->get_needed_document($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Saved', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data Saving Error', 'data' => FALSE);
        }
    }
    public function update_document_isrequired($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'update_documents_required';
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[2] = $params['document_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Document Name is required', 'data' => FALSE);
        }
        $dbparams[3] = 0;
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            $dbparams[4] = 0;
        }
        /* if (isset($params['priority']) && !empty($params['priority'])) {
            $dbparams[4] = $params['priority'];
        } else {
            
        } */
        $dbparams[5] = 0;
        $dbparams[6] = 0;
        $dbparams[7] = '';
        if (isset($params['status']) && !empty($params['status'])) {
            $dbparams[8] = $params['status'];
        } else {
            $dbparams[8] = 0;
        }
        if (isset($params['isrequired']) && !empty($params['isrequired'])) {
            $dbparams[9] = $params['isrequired'];
        } else {
            $dbparams[9] = 0;
        }
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $dbparams[10] = $params['user_id'];
        } else {
            $dbparams[10] = 0;
        }

        $documents_list  = $this->ADmodel->get_needed_document($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Saved', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data Saving Error', 'data' => FALSE);
        }
    }
    public function get_assigned_documents($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'get_staff_assigned_details_byid';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = 0;
        }
        $dbparams[4] = 0;
        if (isset($params['emp_id']) && !empty($params['emp_id'])) {
            $dbparams[5] = $params['emp_id'];
        } else {
            $dbparams[5] = $params['emp_id'];
        }
        if (isset($params['students_image']) && !empty($params['students_image'])) {
            $dbparams[6] = $params['students_image'];
        } else {
            $dbparams[6] = '[]';
        }
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[7] = $params['document_id'];
        } else {
            $dbparams[7] = 0;
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[8] = $params['remarks'];
        } else {
            $dbparams[8] = 0;
        }
        $documents_list  = $this->ADmodel->get_uploaded_documents($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Updated Successfully', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_uploaded_documents($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'get_user_documents';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = $params['temp_id'];
        }
        $dbparams[4] = 0;
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[5] = $params['temp_id'];
        } else {
            $dbparams[5] = $params['temp_id'];
        }
        if (isset($params['students_image']) && !empty($params['students_image'])) {
            $dbparams[6] = $params['students_image'];
        } else {
            $dbparams[6] = '[]';
        }
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[7] = $params['document_id'];
        } else {
            $dbparams[7] = 0;
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[8] = $params['remarks'];
        } else {
            $dbparams[8] = 0;
        }
        $documents_list  = $this->ADmodel->get_uploaded_documents($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Updated Successfully', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_temp_user_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'save_user_documents';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = 0;
        }
        $dbparams[4] = 0;
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[5] = $params['temp_id'];
        } else {
            $dbparams[5] = $params['temp_id'];
        }
        if (isset($params['students_image']) && !empty($params['students_image'])) {
            $dbparams[6] = $params['students_image'];
        } else {
            $dbparams[6] = $params['students_image'];
        }
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[7] = $params['document_id'];
        } else {
            $dbparams[7] = 0;
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[8] = $params['remarks'];
        } else {
            $dbparams[8] = 0;
        }
        $documents_list  = $this->ADmodel->save_temp_user_details($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Updated Successfully', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function update_temp_user_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'update_xml_user_documents';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = 0;
        }
        $dbparams[4] = 0;
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[5] = $params['temp_id'];
        } else {
            $dbparams[5] = $params['temp_id'];
        }
        if (isset($params['students_image']) && !empty($params['students_image'])) {
            $dbparams[6] = $params['students_image'];
        } else {
            $dbparams[6] = $params['students_image'];
        }
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[7] = $params['document_id'];
        } else {
            $dbparams[7] = 0;
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[8] = $params['remarks'];
        } else {
            $dbparams[8] = 0;
        }
        $documents_list  = $this->ADmodel->save_temp_user_details($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Updated Successfully', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_user_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'save_user_documents_verified';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = 0;
        }
        $dbparams[4] = 0;
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[5] = $params['temp_id'];
        } else {
            $dbparams[5] = $params['temp_id'];
        }
        if (isset($params['students_image']) && !empty($params['students_image'])) {
            $dbparams[6] = $params['students_image'];
        } else {
            $dbparams[6] = $params['students_image'];
        }
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[7] = $params['document_id'];
        } else {
            $dbparams[7] = 0;
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[8] = $params['remarks'];
        } else {
            $dbparams[8] = 0;
        }
        $documents_list  = $this->ADmodel->save_temp_user_details($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Updated Successfully', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function update_user_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'update_user_image_documents_verified';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = 0;
        }
        $dbparams[4] = 0;
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[5] = $params['temp_id'];
        } else {
            $dbparams[5] = $params['temp_id'];
        }
        if (isset($params['students_image']) && !empty($params['students_image'])) {
            $dbparams[6] = $params['students_image'];
        } else {
            $dbparams[6] = $params['students_image'];
        }
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[7] = $params['document_id'];
        } else {
            $dbparams[7] = 0;
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[8] = $params['remarks'];
        } else {
            $dbparams[8] = 0;
        }
        $documents_list  = $this->ADmodel->save_temp_user_details($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Updated Successfully', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function assign_staff_for_verification($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'assign_staff';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = 0;
        }
        $dbparams[4] = 0;
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[5] = $params['temp_id'];
        } else {
            $dbparams[5] = $params['temp_id'];
        }
        if (isset($params['students_image']) && !empty($params['students_image'])) {
            $dbparams[6] = $params['students_image'];
        } else {
            $dbparams[6] = $params['students_image'];
        }
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[7] = $params['document_id'];
        } else {
            $dbparams[7] = 0;
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[8] = $params['remarks'];
        } else {
            $dbparams[8] = 0;
        }
        $documents_list  = $this->ADmodel->save_temp_user_details($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Updated Successfully', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_all_staff_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'get_all_staff_details';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = 0;
        }
        $documents_list  = $this->ADmodel->get_all_staff_details($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Updated Successfully', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_staff_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'get_staff_details_byid';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['emp_id']) && !empty($params['emp_id'])) {
            $dbparams[3] = $params['emp_id'];
        } else {
            $dbparams[3] = 0;
        }
        $documents_list  = $this->ADmodel->get_all_staff_details($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Updated Successfully', 'data' => $documents_list[0]);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_temp_user_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'get_temp_user_details';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = $params['temp_id'];
        }
        $dbparams[4] = 0;
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[5] = $params['temp_id'];
        } else {
            $dbparams[5] = $params['temp_id'];
        }
        if (isset($params['students_image']) && !empty($params['students_image'])) {
            $dbparams[6] = $params['students_image'];
        } else {
            $dbparams[6] = '[]';
        }
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[7] = $params['document_id'];
        } else {
            $dbparams[7] = 0;
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[8] = $params['remarks'];
        } else {
            $dbparams[8] = 0;
        }
        $documents_list  = $this->ADmodel->get_temp_user_details($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Updated Successfully', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_temp_timeline_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'get_temp_timeline_details';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = $params['temp_id'];
        }
        $dbparams[4] = 0;
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[5] = $params['temp_id'];
        } else {
            $dbparams[5] = $params['temp_id'];
        }
        if (isset($params['students_image']) && !empty($params['students_image'])) {
            $dbparams[6] = $params['students_image'];
        } else {
            $dbparams[6] = '[]';
        }
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[7] = $params['document_id'];
        } else {
            $dbparams[7] = 0;
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[8] = $params['remarks'];
        } else {
            $dbparams[8] = 0;
        }
        $documents_list  = $this->ADmodel->get_temp_timeline_details($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Updated Successfully', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function update_documents($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'update_user_documents';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = $params['temp_id'];
        }
        if (isset($params['isverified']) && !empty($params['isverified'])) {
            $dbparams[4] = $params['isverified'];
        } else {
            $dbparams[4] = 0;
        }
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $dbparams[5] = $params['user_id'];
        } else {
            $dbparams[5] = $params['user_id'];
        }
        if (isset($params['students_image']) && !empty($params['students_image'])) {
            $dbparams[6] = $params['students_image'];
        } else {
            $dbparams[6] = '[]';
        }
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[7] = $params['document_id'];
        } else {
            $dbparams[7] = 0;
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[8] = $params['remarks'];
        } else {
            $dbparams[8] = 0;
        }

        $documents_list  = $this->ADmodel->get_uploaded_documents($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function update_user_documents_verified($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'update_user_documents_verified';
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = $params['temp_id'];
        }
        if (isset($params['isverified']) && !empty($params['isverified'])) {
            $dbparams[4] = $params['isverified'];
        } else {
            $dbparams[4] = 0;
        }
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $dbparams[5] = $params['user_id'];
        } else {
            $dbparams[5] = $params['user_id'];
        }
        if (isset($params['students_image']) && !empty($params['students_image'])) {
            $dbparams[6] = $params['students_image'];
        } else {
            $dbparams[6] = '[]';
        }
        if (isset($params['document_id']) && !empty($params['document_id'])) {
            $dbparams[7] = $params['document_id'];
        } else {
            $dbparams[7] = 0;
        }
        if (isset($params['remarks']) && !empty($params['remarks'])) {
            $dbparams[8] = $params['remarks'];
        } else {
            $dbparams[8] = 0;
        }

        $documents_list  = $this->ADmodel->get_uploaded_documents($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_all_scheduled_interview_list($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'get_interview_scheduled';
        if (isset($params['schdld_id']) && !empty($params['schdld_id'])) {
            $dbparams[2] = $params['schdld_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = 0;
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            $dbparams[4] = 0;
        }
        if (isset($params['priority']) && !empty($params['priority'])) {
            $dbparams[5] = $params['priority'];
        } else {
            $dbparams[5] = 0;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[6] = $params['class_id'];
        } else {
            $dbparams[6] = 0;
        }
        if (isset($params['interview_date']) && !empty($params['interview_date'])) {
            $dbparams[7] = $params['interview_date'];
        } else {
            $dbparams[7] = "";
        }
        if (isset($params['interview_time']) && !empty($params['interview_time'])) {
            $dbparams[8] = $params['interview_time'];
        } else {
            $dbparams[8] = "";
        }
        if (isset($params['conduct_by']) && !empty($params['conduct_by'])) {
            $dbparams[9] = $params['conduct_by'];
        } else {
            $dbparams[9] = 0;
        }
        if (isset($params['isactive']) && !empty($params['isactive'])) {
            $dbparams[10] = $params['isactive'];
        } else {
            $dbparams[10] = 0;
        }
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $dbparams[11] = $params['user_id'];
        } else {
            $dbparams[11] = 0;
        }
        $documents_list  = $this->ADmodel->get_all_scheduled_interview_list($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_interview_schedule($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'save_interview_scheduled';
        if (isset($params['schdld_id']) && !empty($params['schdld_id'])) {
            $dbparams[2] = $params['schdld_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = 0;
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            $dbparams[4] = 0;
        }
        if (isset($params['priority']) && !empty($params['priority'])) {
            $dbparams[5] = $params['priority'];
        } else {
            $dbparams[5] = 0;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[6] = $params['class_id'];
        } else {
            $dbparams[6] = 0;
        }
        if (isset($params['interview_date']) && !empty($params['interview_date'])) {
            $dbparams[7] = $params['interview_date'];
        } else {
            $dbparams[7] = "";
        }
        if (isset($params['interview_time']) && !empty($params['interview_time'])) {
            $dbparams[8] = $params['interview_time'];
        } else {
            $dbparams[8] = "";
        }
        if (isset($params['conduct_by']) && !empty($params['conduct_by'])) {
            $dbparams[9] = $params['conduct_by'];
        } else {
            $dbparams[9] = 0;
        }
        if (isset($params['isactive']) && !empty($params['isactive'])) {
            $dbparams[10] = $params['isactive'];
        } else {
            $dbparams[10] = 0;
        }
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $dbparams[11] = $params['user_id'];
        } else {
            $dbparams[11] = 0;
        }
        $documents_list  = $this->ADmodel->save_interview_schedule($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Interview Scheduled Successfully', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function update_interview_scheduled($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 'update_interview_scheduled';
        if (isset($params['schdld_id']) && !empty($params['schdld_id'])) {
            $dbparams[2] = $params['schdld_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['temp_id']) && !empty($params['temp_id'])) {
            $dbparams[3] = $params['temp_id'];
        } else {
            $dbparams[3] = 0;
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            $dbparams[4] = 0;
        }
        if (isset($params['priority']) && !empty($params['priority'])) {
            $dbparams[5] = $params['priority'];
        } else {
            $dbparams[5] = 0;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[6] = $params['class_id'];
        } else {
            $dbparams[6] = 0;
        }
        if (isset($params['interview_date']) && !empty($params['interview_date'])) {
            $dbparams[7] = $params['interview_date'];
        } else {
            $dbparams[7] = "";
        }
        if (isset($params['interview_time']) && !empty($params['interview_time'])) {
            $dbparams[8] = $params['interview_time'];
        } else {
            $dbparams[8] = "";
        }
        if (isset($params['conduct_by']) && !empty($params['conduct_by'])) {
            $dbparams[9] = $params['conduct_by'];
        } else {
            $dbparams[9] = 0;
        }
        if (isset($params['isactive']) && !empty($params['isactive'])) {
            $dbparams[10] = $params['isactive'];
        } else {
            $dbparams[10] = 0;
        }
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $dbparams[11] = $params['user_id'];
        } else {
            $dbparams[11] = 0;
        }
        $documents_list  = $this->ADmodel->save_interview_schedule($dbparams);
        if (!empty($documents_list) && is_array($documents_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Interview Scheduled Successfully', 'data' => $documents_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
