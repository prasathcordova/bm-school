<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pdf
 *
 * @author shamna.edsys
 */
class Pdf {

    public function __construct() {
        $CI = & get_instance();
    }

//    function pdf() {
//        $CI = & get_instance();
////        log_message('Debug', 'mPDF class is loaded.');
//    }

    public function load($params = NULL) {
//        include_once APPPATH.'/third_party/mpdf/mpdf.php';
        require_once APPPATH . '/third_party/vendor/autoload.php';

        if ($params == NULL) {
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';
        }
//        
//        return new mPDF($param);

        $mpdf = new \Mpdf\Mpdf();
        return $mpdf;
    }

    public function load_wide($params = NULL) {
//        include_once APPPATH.'/third_party/mpdf/mpdf.php';
        require_once APPPATH . '/third_party/vendor/autoload.php';

        if ($params == NULL) {
            $params = array(
                'mode' => 'utf-8',
                'format' => 'A4-L',                
            );
        }
//        
//        return new mPDF($param);
        if ($params) {
            $mpdf = new \Mpdf\Mpdf($params);
        } else {
            $mpdf = new \Mpdf\Mpdf();
        }

        return $mpdf;
    }

}
