<?php
include APPPATH.'libraries/merchant/submit.php';

class PaymentGateway {
    public function __construct() {
        
    }
    function pay($params) {
        if(isset($params) && !empty($params)) {
            $processPayment = new ProcessPayment();
            $processPayment->requestMerchant($params);
        } else {
            echo 'Error in loading payment library';
            die;
        }
        
    }
}
