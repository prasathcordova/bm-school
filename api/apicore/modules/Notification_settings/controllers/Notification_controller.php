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
class Notification_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Notification_model', 'NFmodel');
    }

    public function get_all_notification_list($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['notification_status']) && !empty($params['notification_status'])) {
            $dbparams[1] = $params['notification_status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'notification_status is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['notification_id']) && !empty($params['notification_id'])) {
            $dbparams[3] = $params['notification_id'];
        } else {
            $dbparams[3] = 0;
        }
        if (isset($params['notification_name']) && !empty($params['notification_name'])) {
            $dbparams[4] = $params['notification_name'];
        } else {
            $dbparams[4] = '';
        }
        if (isset($params['needed_field']) && !empty($params['needed_field'])) {
            $dbparams[5] = $params['needed_field'];
        } else {
            $dbparams[5] = '';
        }
        if (isset($params['sms_message']) && !empty($params['sms_message'])) {
            $dbparams[6] = $params['sms_message'];
        } else {
            $dbparams[6] = '';
        }
        if (isset($params['email_message']) && !empty($params['email_message'])) {
            $dbparams[7] = $params['email_message'];
        } else {
            $dbparams[7] = '';
        }
        if (isset($params['sms_status'])) {
            $dbparams[8] = $params['sms_status'];
        } else {
            $dbparams[8] = 1;
        }
        if (isset($params['email_status'])) {
            $dbparams[9] = $params['email_status'];
        } else {
            $dbparams[9] = 1;
        }
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $dbparams[10] = $params['user_id'];
        } else {
            $dbparams[10] = 1;
        }
        if (isset($params['notification_list']) && !empty($params['notification_list'])) {
            $dbparams[11] = $params['notification_list'];
        } else {
            $dbparams[11] = '[]';
        }
        $notification_list  = $this->NFmodel->get_all_notification_list($dbparams);
        if (!empty($notification_list) && is_array($notification_list) && $notification_list[0]['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $notification_list);
        } else  if (!empty($notification_list) && is_array($notification_list) && $notification_list[0]['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' =>  $notification_list[0]['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Unknown Error', 'data' => FALSE);
        }
    }
    public function get_notification_sms_by_id($params = NULL)
    {
        $dbparams    = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['notification_status']) && !empty($params['notification_status'])) {
            $dbparams[1] = $params['notification_status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'notification_status is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['notification_id']) && !empty($params['notification_id'])) {
            $dbparams[3] = $params['notification_id'];
        } else {
            $dbparams[3] = 0;
        }
        if (isset($params['notification_name']) && !empty($params['notification_name'])) {
            $dbparams[4] = $params['notification_name'];
        } else {
            $dbparams[4] = '';
        }
        if (isset($params['needed_field']) && !empty($params['needed_field'])) {
            $dbparams[5] = $params['needed_field'];
        } else {
            $dbparams[5] = '';
        }
        if (isset($params['sms_message']) && !empty($params['sms_message'])) {
            $dbparams[6] = $params['sms_message'];
        } else {
            $dbparams[6] = '';
        }
        if (isset($params['email_message']) && !empty($params['email_message'])) {
            $dbparams[7] = $params['email_message'];
        } else {
            $dbparams[7] = '';
        }
        if (isset($params['sms_status'])) {
            $dbparams[8] = $params['sms_status'];
        } else {
            $dbparams[8] = 1;
        }
        if (isset($params['email_status'])) {
            $dbparams[9] = $params['email_status'];
        } else {
            $dbparams[9] = 1;
        }
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $dbparams[10] = $params['user_id'];
        } else {
            $dbparams[10] = 1;
        }
        if (isset($params['notification_list']) && !empty($params['notification_list'])) {
            $dbparams[11] = $params['notification_list'];
        } else {
            $dbparams[11] = '[]';
        }


        $notification_list  = $this->NFmodel->get_all_notification_single($dbparams);
        if (!empty($notification_list) && is_array($notification_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $notification_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_user_messages($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['notification_status']) && !empty($params['notification_status'])) {
            $dbparams[1] = $params['notification_status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'notification_status is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }
        if (isset($params['notification_id']) && !empty($params['notification_id'])) {
            $dbparams[3] = $params['notification_id'];
        } else {
            $dbparams[3] = 0;
        }
        if (isset($params['user_id']) && !empty($params['user_id'])) {
            $dbparams[4] = $params['user_id'];
        } else {
            $dbparams[4] = 1;
        }
        if (isset($params['notification_messages']) && !empty($params['notification_messages'])) {
            $dbparams[5] = $params['notification_messages'];
        } else {
            $dbparams[5] = '[]';
        }

        $notification_messages  = $this->NFmodel->save_user_messages($dbparams);
        if (!empty($notification_messages) && is_array($notification_messages)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $notification_messages);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_billstudent_search($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];



        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $dbparams[1] = $params['admn_no'];
        } else {
            $dbparams[1] = NULL;
        }



        $student_data_list = $this->MStudent->get_billstudentsearch($dbparams);


        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function arrear_list_notification($params = NULL)
    {
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['notification_status']) && !empty($params['notification_status'])) {
            $dbparams[1] = $params['notification_status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'notification_status is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }

        if (isset($params['month_year']) && !empty($params['month_year'])) {
            $dbparams[3] = $params['month_year'];
        } else {
            $dbparams[3] = date('m/Y');
        }
        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $dbparams[4] = $params['admn_no'];
        } else {
            $dbparams[4] = 0;
        }
        if (isset($params['batch_id']) && !empty($params['batch_id'])) {
            $dbparams[5] = $params['batch_id'];
        } else {
            $dbparams[5] = NULL;
        }
        if (isset($params['stream_id']) && !empty($params['stream_id'])) {
            $dbparams[6] = $params['stream_id'];
        } else {
            $dbparams[6] = NULL;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[7] = $params['class_id'];
        } else {
            $dbparams[7] = NULL;
        }
        if (isset($params['curent_acdyr']) && !empty($params['curent_acdyr'])) {
            $dbparams[8] = $params['curent_acdyr'];
        } else {
            $dbparams[8] = NULL;
        }
        if (isset($params['searchname']) && !empty($params['searchname'])) {
            $dbparams[9] = $params['searchname'];
        } else {
            $dbparams[9] = NULL;
        }
        //get_notification_sms_list
        $arrear_list  = $this->NFmodel->arrear_list_notification($dbparams);
        if (!empty($arrear_list) && is_array($arrear_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $arrear_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function arrear_list_notification_filter($params = NULL)
    {
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['notification_status']) && !empty($params['notification_status'])) {
            $dbparams[1] = $params['notification_status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'notification_status is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }

        if (isset($params['month_year']) && !empty($params['month_year'])) {
            $dbparams[3] = $params['month_year'];
        } else {
            $dbparams[3] = date('m/Y');
        }
        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $dbparams[4] = $params['admn_no'];
        } else {
            $dbparams[4] = 0;
        }
        if (isset($params['batch_id']) && !empty($params['batch_id'])) {
            $dbparams[5] = $params['batch_id'];
        } else {
            $dbparams[5] = NULL;
        }
        if (isset($params['stream_id']) && !empty($params['stream_id'])) {
            $dbparams[6] = $params['stream_id'];
        } else {
            $dbparams[6] = NULL;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[7] = $params['class_id'];
        } else {
            $dbparams[7] = NULL;
        }
        if (isset($params['curent_acdyr']) && !empty($params['curent_acdyr'])) {
            $dbparams[8] = $params['curent_acdyr'];
        } else {
            $dbparams[8] = NULL;
        }
        if (isset($params['searchname']) && !empty($params['searchname'])) {
            $dbparams[9] = $params['searchname'];
        } else {
            $dbparams[9] = NULL;
        }
        //get_notification_sms_list
        $arrear_list  = $this->NFmodel->arrear_list_notification($dbparams);
        if (!empty($arrear_list) && is_array($arrear_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $arrear_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function arrear_list_notification_advanced_filter($params = NULL)
    {
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['notification_status']) && !empty($params['notification_status'])) {
            $dbparams[1] = $params['notification_status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'notification_status is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            $dbparams[2] = 0;
        }

        if (isset($params['month_year']) && !empty($params['month_year'])) {
            $dbparams[3] = $params['month_year'];
        } else {
            $dbparams[3] = date('m/Y');
        }
        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $dbparams[4] = $params['admn_no'];
        } else {
            $dbparams[4] = 0;
        }
        if (isset($params['batch_id']) && !empty($params['batch_id'])) {
            $dbparams[5] = $params['batch_id'];
        } else {
            $dbparams[5] = NULL;
        }
        if (isset($params['stream_id']) && !empty($params['stream_id'])) {
            $dbparams[6] = $params['stream_id'];
        } else {
            $dbparams[6] = NULL;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[7] = $params['class_id'];
        } else {
            $dbparams[7] = NULL;
        }
        if (isset($params['curent_acdyr']) && !empty($params['curent_acdyr'])) {
            $dbparams[8] = $params['curent_acdyr'];
        } else {
            $dbparams[8] = NULL;
        }
        if (isset($params['searchname']) && !empty($params['searchname'])) {
            $dbparams[9] = $params['searchname'];
        } else {
            $dbparams[9] = NULL;
        }
        //get_notification_sms_list
        $arrear_list  = $this->NFmodel->arrear_list_notification($dbparams);
        if (!empty($arrear_list) && is_array($arrear_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $arrear_list);
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

        $documents_list  = $this->NFmodel->get_needed_document($dbparams);
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

        $documents_list  = $this->NFmodel->get_needed_document($dbparams);
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
}
