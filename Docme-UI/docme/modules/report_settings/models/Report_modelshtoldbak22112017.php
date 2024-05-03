<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report_model
 *
 * @author docme2
 */
class Report_model extends CI_Model{
   public function __construct() {
        parent::__construct();
    }
    
    
     public function get_all_acadyr() {
        $apikey = $this->session->userdata('API-Key');
        $acd_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_acdyear',
            'status' => 1,
            'mode' => 'strict',
                ), $apikey);
        if (is_array($acd_data)) {
            return $acd_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acd_data,
                'data' => FALSE
            );
        }
    }
 
    //Student Strength Report
      public function get_studentstrng_rpt($acd_year_id) {
        $apikey = $this->session->userdata('API-Key');
//        dev_export($acd_year_id);die;
        $acdyr_data = transport_data_with_param_with_urlencode(array('action' => 'get_strength_rpt', 'acdyear' => $acd_year_id), $apikey);
//        dev_export($acdyr_data);die;
        if (is_array($acdyr_data)) {
            return $acdyr_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acdyr_data,
                'data' => FALSE
            );
        }
    }
    
    
    //Student Familywise Report 
      public function get_studentfamilywise_rpt($acd_year_id,$frmdt) {
        $apikey = $this->session->userdata('API-Key');
        $acdyr_data = transport_data_with_param_with_urlencode(array('action' => 'get_familywise_rpt', 'acdyear' => $acd_year_id, 'FromDt' =>$frmdt), $apikey);
//        dev_export($acdyr_data);die;
        if (is_array($acdyr_data)) {
            return $acdyr_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acdyr_data,
                'data' => FALSE
            );
        }
    }
    
    
    //Student Nationalitywise Report
    
    public function get_all_country_list() {
        $apikey = $this->session->userdata('API-Key');
        $country_data = transport_data_with_param_with_urlencode(array('action' => 'get_countries'), $apikey);
        if (is_array($country_data)) {
//            dev_export($country_data);die;
            return $country_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $country_data,
                'data' => FALSE
            );
        }
    }
    
    public function get_studentnationwise_rpt($acd_year_id,$nation,$frmdt,$todt) {
        $apikey = $this->session->userdata('API-Key');
        $nation_data = transport_data_with_param_with_urlencode(array('action' => 'get_nationality_rpt', 'nation'=> $nation, 'acdyear' => $acd_year_id, 'FromDt' =>$frmdt), $apikey);
//        dev_export($nation_data);die;
        if (is_array($nation_data)) {
            return $nation_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $nation_data,
                'data' => FALSE
            );
        }
    }
    
    
    //Religionwise Report
    
    public function get_all_relegion() {
        $apikey = $this->session->userdata('API-Key');
        $religion = transport_data_with_param_with_urlencode(array('action' => 'get_religion', 'status' => 1), $apikey);
        if (is_array($religion)) {
            return $religion['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $religion,
                'data' => FALSE
            );
        }
    }
    
    public function get_studentreligionwise_rpt($acd_year_id,$religion,$frmdt,$todt) {
        $apikey = $this->session->userdata('API-Key');
        $religion_data = transport_data_with_param_with_urlencode(array('action' => 'get_religion_rpt', 'religion'=> $religion, 'acdyear' => $acd_year_id, 'FromDt' =>$frmdt), $apikey);
//        dev_export($nation_data);die;
        if (is_array($religion_data)) {
            return $religion_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $religion_data,
                'data' => FALSE
            );
        }
    }
    
    //Class/Divisionwise Details
    
    public function get_all_class() {
        $apikey = $this->session->userdata('API-Key');
        $class_data = transport_data_with_param_with_urlencode(array('action' => 'get_class'), $apikey);       
        if(is_array($class_data)) {
//            dev_export($acd_data);die;
            return $class_data['data'];
            
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $class_data,
                'data' => FALSE
                );
        }
    }
    
    
     public function get_studentclassdivisnwise_rpt($acd_year_id,$class,$frmdt) {
        $apikey = $this->session->userdata('API-Key');
        $classdivin_data = transport_data_with_param_with_urlencode(array('action' => 'get_classdivision_rpt', 'classs'=> $class, 'acdyear' => $acd_year_id, 'Dt' =>$frmdt), $apikey);
//        dev_export($classdivin_data);die;
        if (is_array($classdivin_data)) {
            return $classdivin_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $classdivin_data,
                'data' => FALSE
            );
        }
    }
    
    //Genderwise Report
    
    public function get_genderwise_rpt($acd_year_id,$gender,$frmdt,$todt) {
        $apikey = $this->session->userdata('API-Key');
        $gender_data = transport_data_with_param_with_urlencode(array('action' => 'get_genderwise_rpt', 'gender'=> $gender, 'acdyear' => $acd_year_id, 'FromDt' =>$frmdt, 'ToDt' =>$todt ), $apikey);
//        dev_export($gender_data);die;
        if (is_array($gender_data)) {
            return $gender_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $gender_data,
                'data' => FALSE
            );
        }
    }
    
    //Document Report
    
    public function get_all_stream() {
        $apikey = $this->session->userdata('API-Key');
        $stream_data = transport_data_with_param_with_urlencode(array('action' => 'get_stream'), $apikey);       
        if(is_array($stream_data)) {
//            dev_export($acd_data);die;
            return $stream_data['data'];
            
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $stream_data,
                'data' => FALSE
                );
        }
    }
    
    public function get_all_medium_list() {
        $apikey = $this->session->userdata('API-Key');
        $medium_data = transport_data_with_param_with_urlencode(array('action' => 'get_medium'), $apikey);       
        if(is_array($medium_data)) {
            return $medium_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $medium_data,
                'data' => FALSE
                );
        }
    }
   
    public function get_batch_details($acd_year_id,$class_id,$med_id,$stream_id) {
        $apikey = $this->session->userdata('API-Key');
        $batch_data = transport_data_with_param_with_urlencode(array('action' => 'get_batch','Acd_Year' => $acd_year_id,'Class_Det_ID' =>$class_id,'Stream_ID' => $stream_id,'Medium_ID'=>$med_id), $apikey);   
//        dev_export($batch_data);die;
        if(is_array($batch_data)) {
            return $batch_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch_data,
                'data' => FALSE
                );
        }
    }
    
   
    public function get_document_rpt($acd_year_id,$batch) {
        $apikey = $this->session->userdata('API-Key');
        $document_data = transport_data_with_param_with_urlencode(array('action' => 'get_collecteddoc_rpt', 'batch'=> $batch, 'acdyear' => $acd_year_id), $apikey);
//        dev_export($document_data);die;
        if (is_array($document_data)) {
            return $document_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $document_data,
                'data' => FALSE
            );
        }
    }
    
    //LongAbsentee Report
    
    public function get_lonabsentee_rpt($acd_year_id,$frmdt,$todt) {
        $apikey = $this->session->userdata('API-Key');
        $longabsentee_data = transport_data_with_param_with_urlencode(array('action' => 'get_longabsnt_rpt', 'FromDt'=> $frmdt, 'acdyear' => $acd_year_id , 'ToDt' => $todt), $apikey);
//        dev_export($document_data);die;
        if (is_array($longabsentee_data)) {
            return $longabsentee_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $longabsentee_data,
                'data' => FALSE
            );
        }
    
    }
    
    //Contact Details report
    
    public function get_batch_detailss($acd_year_id,$class_id,$stream_id) {
        $apikey = $this->session->userdata('API-Key');
        $batch_data = transport_data_with_param_with_urlencode(array('action' => 'get_batch','Acd_Year' => $acd_year_id,'Class_Det_ID' =>$class_id,'Stream_ID' => $stream_id), $apikey);   
//        dev_export($batch_data);die;
        if(is_array($batch_data)) {
            return $batch_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch_data,
                'data' => FALSE
                );
        }
    }
    
    public function get_contact_rpt($acd_year_id,$class_id,$stream_id,$batch_id) {
        $apikey = $this->session->userdata('API-Key');
        $contact_data = transport_data_with_param_with_urlencode(array('action' => 'get_studcontact_rpt', 'stream'=> $stream_id, 'acdyear' => $acd_year_id , 'cls' => $class_id , 'batch' => $batch_id), $apikey);
//        dev_export($document_data);die;
        if (is_array($contact_data)) {
            return $contact_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $contact_data,
                'data' => FALSE
            );
        }
    
    }
        
}
