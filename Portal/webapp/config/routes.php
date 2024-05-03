<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/



/*Author Chandrajith*/
$route['portal/parent-login'] = 'parent/Parentlogin_controller/login_view';
$route['portal/parent-user-login-send-otp'] = 'parent/Parentlogin_controller/parent_login_otp_request';
$route['portal/parent-user-otp-verification'] = 'parent/Parentlogin_controller/parent_otp_verification_and_login';
$route['fees/parent-user-login'] = 'parent/Parentlogin_controller/parent_login';
$route['fees/fee-register-account'] = 'parent/Parentlogin_controller/login_register';
$route['fees/fee-forgot-password'] = 'parent/Parentlogin_controller/forgot_password';
$route['fees/fee-parent-registration'] = 'parent/Parentlogin_controller/parent_registration';
$route['parent-portal/student-list'] = 'parent/Student_controller/show_student';
$route['parent-portal/show_student'] = 'parent/Student_controller/show_ind_student';
$route['parent-portal/show_student_wallet'] = 'parent/Student_controller/show_student_wallet';
$route['fees/pay-atom'] = 'parent/Student_controller/send_atom_data';
$route['fees/pay_wallet_atom'] = 'parent/Student_controller/pay_wallet_atom';
$route['fees/data-return-from-payment-gateway'] = 'parent/Student_controller/atom_data_rcvd';
$route['fees/data-return-from-payment-gateway-wallet'] = 'parent/Student_controller/atom_data_rcvd_wallet';

// $route['parent-portal/show_bookstore_payment']='parent/Bookstore_controller/show_bookstore_payment';

$route['payment-fees/(:any)/(:any)'] = "parent/Student_controller/show_fee_details/$1/$2";
$route['payment-wallet/(:any)/(:any)'] = "parent/Student_controller/show_wallet_details/$1/$2";

$route['logout'] = "parent/Parentlogin_controller/logout";
$route['payment-bookstore/(:any)/(:any)'] = "parent/Bookstore_controller/show_bookstore_payment/$1/$2";
$route['bookstore/pack-details'] = "parent/Bookstore_controller/pack_details";
$route['bookstore/place-order'] = "parent/Bookstore_controller/place_order";
$route['bookstore/process-return-payment-data'] = "parent/Bookstore_controller/process_payment";
$route['bookstore/payment-success'] = "parent/Bookstore_controller/payment_ack_success";
$route['bookstore/payment-failed'] = "parent/Bookstore_controller/payment_ack_failed";
$route['fee/payment-success'] = "parent/Student_controller/payment_ack_success";
$route['fee/payment-failed'] = "parent/Student_controller/payment_ack_failed";
$route['fee/wallet-payment-success'] = "parent/Student_controller/payment_ack_success_wallet";
$route['fee/wallet-payment-failed'] = "parent/Student_controller/payment_ack_failed_wallet";

$route['payment-uniform/(:any)/(:any)'] = "parent/Uniform_controller/show_uniform_payment/$1/$2";
$route['uniform/pack-details'] = "parent/Uniform_controller/pack_details";
$route['uniform/place-order'] = "parent/Uniform_controller/place_order";
$route['uniform/process-return-payment-data'] = "parent/Uniform_controller/process_payment";
$route['uniform/payment-success'] = "parent/Uniform_controller/payment_ack_success";
$route['uniform/payment-failed'] = "parent/Uniform_controller/payment_ack_failed";




$route['default_controller'] = 'parent/Student_controller/show_student';
$route['home'] = 'parent/Temporaryreg_controller/show_starter';
$route['tempreg-formpage'] = 'parent/Temporaryreg_controller/show_tempregform';
$route['tempreg-formpage-sibiling'] = 'parent/Temporaryreg_controller/show_tempregform_sibilings';
$route['tempreg-formpage-communication'] = 'parent/Temporaryreg_controller/show_tempregform_communication';
$route['tempreg-formpage-identification'] = 'parent/Temporaryreg_controller/show_tempregform_identification';
$route['tempreg-formpage-otherdetails'] = 'parent/Temporaryreg_controller/show_tempregform_otherdetails';
$route['tempreg-formpage-birthdetails'] = 'parent/Temporaryreg_controller/show_tempregform_birthdetails';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
