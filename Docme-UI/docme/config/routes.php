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
//added for I18n support
// example: '/en/about' -> use controller 'about'
$route['^fr/(.+)$'] = "$1";
$route['^en/(.+)$'] = "$1";

// '/en' and '/fr' -> use default controller
//$route['^fr$'] = $route['default_controller'];
//$route['^en$'] = $route['default_controller'];
// for online Document Upload -----------------------------------------------------------------------
$route['online-registration/document-upload/(:any)/(:any)'] = 'online_registration/Admission_controller/document_uploads/$1/$2';
$route['online-registration/student-progress-status/(:any)/(:any)'] = 'online_registration/Admission_controller/student_progress_status/$1/$2';
$route['online-registration/load-needed-documents']         = 'online_registration/Admission_controller/load_needed_documents';
$route['online-registration/add-needed-documents']          = 'online_registration/Admission_controller/add_needed_documents';
$route['online-registration/edit-needed-documents']         = 'online_registration/Admission_controller/edit_needed_documents';
$route['online-registration/uploaded-documents']            = 'online_registration/Admission_controller/save_temp_documents';
$route['online-registration/verify-documents']              = 'online_registration/Admission_controller/show_verify_documents';
$route['online-registration/verified-documents']            = 'online_registration/Admission_controller/update_user_documents';
$route['online-registration/staff-verified-documents']      = 'online_registration/Admission_controller/update_user_documents_bystaff';
$route['online-registration/load-staff-settings']           = 'online_registration/Admission_controller/show_load_staff';
$route['online-registration/document-change-status']        = 'online_registration/Admission_controller/document_change_status';
$route['online-registration/document-change-isrequired']    = 'online_registration/Admission_controller/document_change_isrequired';
$route['online-registration/get-document-status']           = 'online_registration/Admission_controller/get_document_status';
$route['online-registration/get-staff-status']              = 'online_registration/Admission_controller/get_staff_status';
$route['online-registration/allocate-registration-documents'] = 'online_registration/Admission_controller/allocate_registration_documents';
$route['online-registration/allocate-staff']                = 'online_registration/Admission_controller/allocate_staff';
$route['online-registration/load-interview-schedule']       = 'online_registration/Admission_controller/load_interview_schedule';
$route['online-registration/add-interview-schedule']        = 'online_registration/Admission_controller/save_interview_schedule';
$route['online-registration/edit-interview-schedule']       = 'online_registration/Admission_controller/update_interview_scheduled';
$route['online-registration/testemail']                     = 'online_registration/Admission_controller/test_email';
$route['online-registration/show-assigned-staff/(:any)/(:any)'] = 'online_registration/Admission_controller/verify_staff_uploaded_details/$1/$2';



$route['autocop/pushdata'] = 'Other_integrations/Autocop_integration_controller/push_data_to_docme';
// for online registration -----------------------------------------------------------------------
$route['online-registration'] = 'online_registration/Online_registration_controller/online_reg/';

//$route['online-registration/(:any)'] = 'online_registration/Online_registration_controller/online_reg/$1';
$route['online-registration/get-state-details'] = 'online_registration/Online_registration_controller/get_state_details';
$route['online-registration/get-city-details'] = 'online_registration/Online_registration_controller/get_city_details';
$route['online-registration/get-caste-details'] = 'online_registration/Online_registration_controller/get_caste_details';
$route['online_registration/save-student-temporary-reg'] = 'online_registration/Online_registration_controller/save_temp_registration';
$route['online_registration/update-student-temporary-reg'] = 'online_registration/Online_registration_controller/edit_temp_registration';
$route['online_registration/select-student-temporary-reg'] = 'online_registration/Online_registration_controller/select_temp_registration';
$route['online_registration/get-classs-with-age-restriction'] = 'online_registration/Online_registration_controller/get_class_details_with_age_restriction';
$route['online-registration/Send-email'] = 'online_registration/Online_registration_controller/send_email';
$route['online-registration/select-OTP'] = 'online_registration/Online_registration_controller/select_OTP';
$route['online-registration/validate-online-dropdowns'] = 'online_registration/Online_registration_controller/dropdown_valitdation';
$route['online_registration/sent-Email-TempData'] = 'online_registration/Online_registration_controller/sentEmailTempData';
$route['online_registration/get-entrance-date'] = 'online_registration/Online_registration_controller/get_entrance_date';
$route['online_registration/get-mandatory-subjects'] = 'online_registration/Online_registration_controller/get_mandatory_subjects';
$route['online-registration/return-view'] = 'online_registration/Online_registration_controller/return_view';
$route['online-registration/rims-data-api'] = 'online_registration/Online_registration_controller/rims_data_api';
$route['online-registration/selectDetailsAndOTP'] = 'online_registration/Online_registration_controller/select_parent_details_andOTP';
$route['online-registration/sendOTPParent'] = 'online_registration/Online_registration_controller/send_OTP_Parent';
$route['online-registration/checkotpsession'] = 'online_registration/Online_registration_controller/check_otp_session';

//Online Registration Settings
$route['registration/show-settings'] = 'online_registration/Registration_settings_controller/show_settings';
$route['registration/show-amount-settings'] = 'online_registration/Registration_settings_controller/show_amount_settings';
$route['registration/save-registration-fees'] = 'online_registration/Registration_settings_controller/save_registration_fees';
$route['registration/show-payment-allocation'] = 'online_registration/Registration_settings_controller/show_payment_allocation';
$route['registration/get-temporary-regisration-details'] = 'online_registration/Registration_settings_controller/get_temporary_regisration_details';
$route['registration/allocate-registration-payments'] = 'online_registration/Registration_settings_controller/allocate_registration_payments';
$route['registration/show-payment-status'] = 'online_registration/Registration_settings_controller/show_payment_status';
$route['registration/get-payment-status'] = 'online_registration/Registration_settings_controller/get_payment_status';

$route['registration/show-admission-settings'] = 'online_registration/Registration_settings_controller/show_admission_settings';

$route['registration/online-payment'] = 'online_registration/Registration_payment_controller/process_payment';
$route['registration/online-payment-proceed'] = 'online_registration/Registration_payment_controller/proceed_to_payment';
$route['registration/online-payment-response'] = 'online_registration/Registration_payment_controller/process_online_payment';
$route['registration/thank-you'] = 'online_registration/Registration_payment_controller/load_thankyou';
$route['registration/failed'] = 'online_registration/Registration_payment_controller/load_failed';
$route['payment-expired'] = 'online_registration/Registration_payment_controller/payment_expired';


$route['registration/show-registration-dates'] = 'online_registration/Registration_settings_controller/show_registration_dates';
$route['registration/show-entrance-dates'] = 'online_registration/Registration_settings_controller/show_entrance_dates';
$route['registration/show-age-settings'] = 'online_registration/Registration_settings_controller/show_age_settings';
$route['registration/save-registration-date'] = 'online_registration/Registration_settings_controller/save_registration_date';

//Online Registration Settings


// for online registration -----------------------------------------------------------------------
//$route['default_controller'] = 'administration/Home_controller/dashboard';

$route['default_controller'] = 'administration/Home_controller/show_school_dashboard';
//$route['default_controller'] = 'administration/Home_controller/show_dashboard';
$route['home'] = 'administration/Home_controller/dashboard';
$route['school/home'] = 'administration/Home_controller/show_school_dashboard';
$route['school/transport'] = 'administration/Home_controller/show_transport_dashboard';
$route['change-password'] = 'administration/Home_controller/change_password';

//$route['dashboard/show-dashboard'] = 'administration/Home_controller/show_dashboard';
$route['user/show-activity'] = 'administration/User_activity_controller/show_activities';
$route['user/show-search-user'] = 'administration/User_activity_controller/show_activities_user';
$route['user/show-user-data-detail'] = 'administration/User_activity_controller/show_single_user_data';
$route['user/show-role-data-detail'] = 'administration/User_activity_controller/show_single_role_data';
$route['user/add-new-role'] = 'administration/User_activity_controller/add_new_role_loader';
$route['user/set-role-permission'] = 'administration/User_activity_controller/show_permission_data';

//Route for Settings
$route['settings/save-code-value'] = 'general_settings/Settings_controller/save_system_parameters';
$route['settings/show-system-parameters'] = 'general_settings/Settings_controller/show_system_parameters';
$route['settings/show-settings'] = 'general_settings/Settings_controller/show_settings';
$route['settings/show-count'] = 'general_settings/Settings_controller/show_count';

$route['registration/save-student-parent-profile'] = 'student_settings/Registration_controller/save_parent_profile_reg';
$route['registration/edit-student-parent-profile'] = 'student_settings/Registration_controller/edit_parent_profile_reg';


$route['country/show-country'] = 'general_settings/Country_management_controller/show_countries';
//create function show_sponser by vinoth
$route['sponser/show-sponser'] = 'student_settings/Registration_controller/show_sponser';
//$route['sponser/show-sponser'] = 'student_settings/Registration_controller/show_countries_for_sponser';
$route['country/add-country'] = 'general_settings/Country_management_controller/add_country';
$route['sponser/add-sponser'] = 'student_settings/Registration_controller/add_sponser';
$route['country/edit-country'] = 'general_settings/Country_management_controller/edit_country';
$route['country/status-edit-country'] = 'general_settings/Country_management_controller/update_status';
$route['country/change_status'] = 'general_settings/Country_management_controller/update_status';

$route['religion/add-religion'] = 'general_settings/Religion_management_controller/add_religion';
$route['religion/show-religion'] = 'general_settings/Religion_management_controller/show_religion';
$route['religion/edit-religion'] = 'general_settings/Religion_management_controller/edit_religion';
$route['religion/status-edit-religion'] = 'general_settings/Religion_management_controller/update_status';
$route['religion/change_status'] = 'general_settings/Religion_management_controller/update_status';


$route['currency/add-currency'] = 'general_settings/Currency_management_controller/add_currency';
$route['currency/show-currency'] = 'general_settings/Currency_management_controller/show_currency';
$route['currency/edit-currency'] = 'general_settings/Currency_management_controller/edit_currency';
//create function by vinoth for edit sponser @ 30-06-2019
$route['sponsers/edit-sponsers'] = 'student_settings/Registration_controller/edit_sponsers';
$route['currency/status-edit-currency'] = 'general_settings/Currency_management_controller/update_status';
$route['currency/change_status'] = 'general_settings/Currency_management_controller/update_status';

$route['language/show-language'] = 'general_settings/Language_management_controller/show_language';
$route['language/add-language'] = 'general_settings/Language_management_controller/add_language';
$route['language/change_status'] = 'general_settings/Language_management_controller/update_status';
$route['language/edit-language'] = 'general_settings/Language_management_controller/edit_language';
$route['language/status-edit-language'] = 'general_settings/Language_management_controller/update_status';

$route['profession/show-profession'] = 'general_settings/Profession_mangement_controller/show_profession';
$route['profession/add-profession'] = 'general_settings/Profession_mangement_controller/add_profession';
$route['profession/edit-profession'] = 'general_settings/Profession_mangement_controller/edit_profession';
$route['profession/status-edit-profession'] = 'general_settings/Profession_mangement_controller/update_status';
$route['profession/change_status'] = 'general_settings/Profession_mangement_controller/update_status';

$route['community/show-community'] = 'general_settings/Community_management_controller/show_community';
$route['community/add-community'] = 'general_settings/Community_management_controller/add_community';
$route['community/edit-community'] = 'general_settings/Community_management_controller/edit_community';
$route['community/status-edit-community'] = 'general_settings/Community_management_controller/update_status';
$route['community/change_status'] = 'general_settings/Community_management_controller/update_status';

$route['city/show-city'] = 'general_settings/City_management_controller/show_cities';
$route['city/add-city'] = 'general_settings/City_management_controller/add_city';
$route['city/edit-city'] = 'general_settings/City_management_controller/edit_city';
$route['city/status-edit-city'] = 'general_settings/City_management_controller/update_status';

$route['state/show-state'] = 'general_settings/State_management_controller/show_states';
$route['state/add-state'] = 'general_settings/State_management_controller/add_state';
$route['state/edit-state'] = 'general_settings/State_management_controller/edit_state';
$route['state/status-edit-state'] = 'general_settings/State_management_controller/update_status';
$route['state/change_status'] = 'general_settings/State_management_controller/update_status';

$route['caste/show-caste'] = 'general_settings/Caste_management_controller/show_caste';
$route['caste/add-caste'] = 'general_settings/Caste_management_controller/add_caste';
$route['caste/edit-caste'] = 'general_settings/Caste_management_controller/edit_caste';
$route['caste/change_status'] = 'general_settings/Caste_management_controller/update_status';

$route['login'] = 'administration/Authenticator_controller/login';
$route['signin'] = 'administration/Authenticator_controller/login';
$route['signout'] = 'administration/Authenticator_controller/logout';
$route['logout'] = 'administration/Authenticator_controller/logout';

$route['registration/get_employee_list_from_wfm'] = 'student_settings/Registration_controller/get_employee_list_from_wfm';
$route['registration/get-employee-details-from-wfm'] = 'student_settings/Registration_controller/get_employee_details_from_wfm';
$route['registration/get-state-details'] = 'student_settings/Registration_controller/get_state_details';
$route['registration/get-city-details'] = 'student_settings/Registration_controller/get_city_details';
$route['registration/get-caste-details'] = 'student_settings/Registration_controller/get_caste_details';

$route['registration/add-registration'] = 'student_settings/Registration_controller/show_registration';
//Route added by Elavarasan S @ 20-05-2019 11:00
$route['registration/temp-registration'] = 'student_settings/Registration_controller/show_temp_registration';
$route['registration/save-student-temporary-reg'] = 'student_settings/Registration_controller/save_temp_registration';

$route['registration/get-temporary-profile-byadmino'] = 'student_settings/Registration_controller/filter_temp_reg_student';
$route['registration/get-student-temporary-reg'] = 'student_settings/Registration_controller/get_temp_reg_student';
$route['registration/temporary-to-permanent'] = 'student_settings/Registration_controller/temp_to_permanent';

$route['registration/get-classs-with-age-restriction'] = 'student_settings/Registration_controller/get_class_details_with_age_restriction';
$route['registration/save-student-personal-profile'] = 'student_settings/Registration_controller/save_student_personal_profile';
$route['registration/save-student-academic-profile'] = 'student_settings/Registration_controller/save_student_academic_profile';
//author 
$route['registration/search-parent'] = 'student_settings/Registration_controller/search_parent';
$route['registration/search-uuid'] = 'student_settings/Registration_controller/search_uuid_data';
$route['registration/search-f-uuid'] = 'student_settings/Registration_controller/search_f_uuid_data';
$route['registration/search-m-uuid'] = 'student_settings/Registration_controller/search_m_uuid_data';
$route['registration/search-g-uuid'] = 'student_settings/Registration_controller/search_g_uuid_data';
//$route['registration/search-list'] = 'student_settings/Registration_controller/search_list';
$route['registration/pass-stdid'] = 'student_settings/Registration_controller/pass_stdid';

$route['fees/set_min_wallet_amount'] = 'fees/Fees_collection_controller/set_min_wallet_amount';

$route['registration/send-mail'] = 'student_settings/SendEmail/sendEmail';
$route['registration/load-staff-conc-page'] = 'student_settings/Registration_controller/load_staff_conc';
$route['registration/get-sibling-details-for-staff'] = 'student_settings/Registration_controller/load_staff_conc_sibling';
$route['advanced_search/profile_initial_page'] = 'student_settings/Registration_controller/advanced_filter_search';
$route['profile/show-profile'] = 'student_settings/Registration_controller/show_student_profile';
$route['profile/show-profile-for_sponsered_stud'] = 'student_settings/Registration_controller/show_student_profile_for_sponsered_stud';
$route['profilestudent/show-studentprofile'] = 'student_settings/Registration_controller/show_profile';
//create routes for sponsered student by vinoth @ 26-06-2019 @ 15:43
$route['profilestudent/show-profile-for-sponsered-stud'] = 'student_settings/Registration_controller/show_profile_for_sponsered_student';
$route['sponser/add-sponser'] = 'student_settings/Registration_controller/add_sponser';
$route['documents/show-documents'] = 'student_settings/Documents_controller/show_documents';
$route['documents/show-documents-hardcore/(:any)'] = 'student_settings/Documents_controller/show_documents/$1';
$route['document/adddocument'] = 'student_settings/Documents_controller/document_add';
$route['document/view-file'] = 'student_settings/Documents_controller/view_file';
$route['document/view-file-remove'] = 'student_settings/Documents_controller/view_file_remove';
$route['document/remove-document'] = 'student_settings/Documents_controller/remove_document';

$route['advanced_search/admn_no_search'] = 'student_settings/Student_Management_controller/advancesearch_byadmn_no';


$route['student/advancesearch-studentname'] = 'student_settings/Student_Management_controller/advancesearch_byname';
$route['profile/get-batch-by-acdyear'] = 'student_settings/Registration_controller/get_batch_by_academic_year';
$route['profile/show-class-for-students'] = 'student_settings/Registration_controller/show_class_category';
//create root path by vinod @20-05-2019 16:15
$route['profile/show-siblings'] = 'student_settings/Registration_controller/show_siblings';
$route['profile/show-class-for-sponsered-stud'] = 'student_settings/Registration_controller/show_class_category_for_sponserd_stud';
//end
$route['profile/search-siblings-admission-no'] = 'student_settings/Registration_controller/search_siblings_admno';

//$route['course/show-batch'] = 'course_settings/Course_controller/show_batch';
$route['course/add-batch'] = 'course_settings/Course_controller/add_batch';
//$route['course/show-class'] = 'course_settings/Course_controller/show_class';
$route['course/show-course'] = 'course_settings/Course_controller/show_course_settings';
$route['course/batch-allocate'] = 'course_settings/Course_controller/batch_allocate';

$route['profile/student_account_reload'] = 'student_settings/Registration_controller/student_account_reload';
$route['emailstudent/composeemail'] = 'student_settings/Registration_controller/email_compose';
//$route['document/adddocument'] = 'student_settings/Registration_controller/documentadd';
$route['registration/show-promotion'] = 'student_settings/Student_Management_controller/show_promotion';
$route['registration/student-promotion-preloader'] = 'student_settings/Student_Management_controller/student_promotion';
$route['registration/promoted-batch'] = 'student_settings/Student_Management_controller/promoted_batch';
$route['registration/save-promotion'] = 'student_settings/Student_Management_controller/save_promotion';

$route['initial/show-chart'] = 'substore_settings/Storesettings_controller/storechart';

$route['class/add-class'] = 'course_settings/Class_controller/add_class';
//$route['course/show-class'] = 'course_settings/Class_controller/show_class';
$route['class/edit-class'] = 'course_settings/Class_controller/edit_class';
$route['class/change_status'] = 'course_settings/Class_controller/update_status';


$route['course/add-batch'] = 'course_settings/Course_controller/add_batch';
//$route['class/add-class'] = 'course_settings/Class_controller/add_class';
$route['course/show-class'] = 'course_settings/Class_controller/show_class';

$route['batch/show-batch'] = 'course_settings/Batch_controller/show_batch';

$route['batch/add-batch'] = 'course_settings/Batch_controller/add_batch';

//$route['course/show-course'] = 'course_settings/Course_controller/show_course_settings';
$route['course/show-batch'] = 'course_settings/Batch_controller/show_batch';
$route['course/change_status'] = 'course_settings/Course_controller/update_status';

$route['batch/change_status'] = 'course_settings/Batch_controller/update_status';

//$route['course/show-courses'] = 'course_settings/Course_controller/show_course';
$route['course/edit-course'] = 'course_settings/Course_controller/edit_course';
$route['batch/edit-batch'] = 'course_settings/Batch_controller/edit_batch';
$route['course/add-course'] = 'course_settings/Course_controller/add_course';

$route['registration/save-student-other-details'] = 'student_settings/Registration_controller/save_other_details';
$route['registration/save-student-facilities-details'] = 'student_settings/Registration_controller/save_facilities_details';



$route['store/show-bookstore'] = 'store_settings/Storesettings_controller/bookstore';

$route['store/show-stockmgmt'] = 'store_settings/Storesettings_controller/stock';
$route['stock/show_stock'] = 'store_settings/Storesettings_controller/stock';
$route['dashboard/show-dashboard'] = 'administration/Home_controller/show_school_dashboard';
$route['dashboard'] = 'administration/Home_controller/show_school_dashboard'; //show_dashboard';

//$route['report/show-reportdata'] = 'report_settings/Report_controller/show_report_settings';
$route['report/show-report'] = 'report_settings/Report_controller/show_reportdata';
//$route['store/show-purchaselist'] = 'store_settings/Purchase_management_controller/show_purchase';
$route['purchase/show-purchase'] = 'store_settings/Purchase_management_controller/show_purchase';
$route['purchase/direct-purchase'] = 'store_settings/Purchase_management_controller/direct_purchase';
$route['purchase/purchase-order'] = 'store_settings/Purchase_management_controller/purchase_order_creation';
$route['purchase/purchase-orderrecieve'] = 'store_settings/Purchase_management_controller/purchaseorder_recieve';
$route['purchase/purchase-orderrecieve-save'] = 'store_settings/Purchase_management_controller/purchaseorder_recieve_save';
$route['purchase/purchase-returnapproval'] = 'store_settings/Purchase_management_controller/purchase_returnapproval';
$route['purchase/approve-save-return-order'] = 'store_settings/Purchase_management_controller/purchase_returnapproval_save';
$route['purchase/purchase-return-edit'] = 'store_settings/Purchase_management_controller/purchase_return_edit';
$route['purchase/purchase-returnrequest'] = 'store_settings/Purchase_management_controller/purchase_returnrequest';
$route['store/show-count'] = 'store_settings/Storesettings_controller/active_count';
$route['stock/stocktransferintend'] = 'store_settings/Stocktransfer_controller/stocktransfer_intend';
$route['substock/stocktransferintend'] = 'store_settings/Stocktransfer_controller/sub_stocktransfer_intend';
$route['stock/stocktransferissue'] = 'store_settings/Stocktransfer_controller/stocktransfer_issue';
$route['stock/stocktransferrecieve'] = 'store_settings/Stocktransfer_controller/stocktransfer_recieve';

$route['allotment/allotment-search'] = 'store_settings/Allotment_management_controller/search_item_for_allotment';



$route['purchase/approve-save-purchase-order'] = 'store_settings/Purchase_management_controller/save_purchase_status';

$route['sale/sales'] = 'store_settings/Sales_controller/sale';


//suppliers
$route['suppliers/show-suppliers'] = 'store_settings/Suppliers_management_controller/show_suppliers';
$route['suppliers/add-suppliers'] = 'store_settings/Suppliers_management_controller/add_suppliers';
$route['suppliers/edit-suppliers'] = 'store_settings/Suppliers_management_controller/edit_suppliers';
$route['suppliers/status-edit-suppliers'] = 'store_settings/Suppliers_management_controller/update_status';
$route['suppliers/change_status'] = 'store_settings/Suppliers_management_controller/update_status';

//publisher
$route['publisher/show-publisher'] = 'store_settings/Publisher_mangement_controller/show_publisher';
$route['publisher/add-publisher'] = 'store_settings/Publisher_mangement_controller/add_publisher';
$route['publisher/edit-publisher'] = 'store_settings/Publisher_mangement_controller/edit_publisher';
$route['publisher/change_status'] = 'store_settings/Publisher_mangement_controller/update_status';
//catogery
$route['category/show-category'] = 'store_settings/Category_management_controller/show_category';
$route['category/change_status'] = 'store_settings/Category_management_controller/update_status';
$route['category/edit-category'] = 'store_settings/Category_management_controller/edit_category';
$route['category/add-category'] = 'store_settings/Category_management_controller/add_category';

$route['itemtype/show-item'] = 'store_settings/Itemtype_management_controller/show_itemtype';
$route['itemtype/add-item'] = 'store_settings/Itemtype_management_controller/add_itemtype';
$route['itemtype/change_status'] = 'store_settings/Itemtype_management_controller/update_status';
$route['itemtype/edit-itemtype'] = 'store_settings/Itemtype_management_controller/edit_itemtype';

$route['itemmaster/show-details'] = 'store_settings/Itemdetails_management_controller/show_details';
$route['details/add-details'] = 'store_settings/Itemdetails_management_controller/add_new_item';
$route['details/add-item'] = 'store_settings/Itemdetails_management_controller/add_item';
$route['details/edit-details'] = 'store_settings/Itemdetails_management_controller/edit_item';
$route['details/item-edit'] = 'store_settings/Itemdetails_management_controller/item_edit';
$route['details/change_status'] = 'store_settings/Itemdetails_management_controller/update_status';


$route['allotment/show-allotment'] = 'store_settings/Allotment_management_controller/show_allotment';
$route['allotment/add-allotment'] = 'store_settings/Allotment_management_controller/add_allotment';


$route['itemedition/show-itemedition'] = 'store_settings/Itemedition_controller/show_itemedition';
$route['itemedition/add-itemedition'] = 'store_settings/Itemedition_controller/add_itemedition';
$route['itemedition/edit-itemedition'] = 'store_settings/Itemedition_controller/edit_itemedition';
$route['itemedition/change_status'] = 'store_settings/Itemedition_controller/update_status';

$route['substore/show-bookstore'] = 'substore_settings/Storesettings_controller/bookstore';

$route['substore/show-sale'] = 'substore_settings/Salesettings_controller/sale_issue';
$route['substore/specimen-issue'] = 'substore_settings/Salesettings_controller/specimen_issue';
$route['substore/items-list'] = 'substore_settings/Salesettings_controller/show_item';
//$route['substore/show-ohtemplate'] = 'substore_settings/Oh_management_controller/oh_template';
//$route['substore/item-ohpacking'] = 'substore_settings/OH_packing_controller/OH_packing';
$route['substore/item-ohissue'] = 'substore_settings/OH_issue_controller/OH_issue';

$route['substore/item-delivery'] = 'substore_settings/OH_issue_controller/Item_delivery';
$route['substore/item-delivery-return'] = 'substore_settings/Delivery_controller/delivery_return';
$route['substore/item-add'] = 'substore_settings/Salesettings_controller/add_item';

$route['course/batch-allocate'] = 'course_settings/Course_controller/batch_allocate';
$route['course/batch-allocateselect'] = 'course_settings/Course_controller/batch_allocateselect';

//$route['profile/search-student'] = 'substore_settings/Sales_controller/search_byname';


//$route['course/show-course'] = 'course_settings/Course_controller/show_course_settings';
$route['course/change_status'] = 'course_settings/Course_controller/update_status';

$route['course/show-courses'] = 'course_settings/Course_controller/show_course';
$route['course/edit-course'] = 'course_settings/Course_controller/edit_course';
$route['course/add-course'] = 'course_settings/Course_controller/add_course';


//create admission edit route by vinoth @ 24-05-2019 14:32
$route['admno/change-admno'] = 'student_settings/Registration_controller/edit_admission_no';

$route['batch/change-batch'] = 'student_settings/Registration_controller/save_batch_allocation_for_student';
$route['registration/validate-adhar'] = 'student_settings/Registration_controller/adhar_validation';
$route['registration/f_validate-adhar'] = 'student_settings/Registration_controller/f_adhar_validation';
$route['registration/m_validate-adhar'] = 'student_settings/Registration_controller/m_adhar_validation';
$route['registration/g_validate-adhar'] = 'student_settings/Registration_controller/g_adhar_validation';
$route['registration/validate-mobile'] = 'student_settings/Registration_controller/mob_validation';

//TC STARTS
$route['tc/validate-tc'] = 'tc_settings/Tc_management_controller/validate_tc';
$route['tc/apply-tc'] = 'tc_settings/Tc_management_controller/save_tc_application';
$route['tc/tc-cancel'] = 'tc_settings/Tc_management_controller/tc_cancel';
$route['tc/get-class']  = 'course_settings/Course_controller/get_class_priority';

$route['tcprep/show-class-for-students'] = 'tc_settings/Tc_management_controller/show_class_categorytcprep';
$route['tcprep/show-studenttcpreplist'] = 'tc_settings/Tc_management_controller/show_student_preplist';
$route['tc/tc-view'] = 'tc_settings/Tc_management_controller/show_student_list';
$route['tc/show-class-for-students'] = 'tc_settings/Tc_management_controller/show_class_category';
$route['tc/show-studentlist'] = 'tc_settings/Tc_management_controller/show_student_list';
//$route['tc/search-admission-no'] = 'tc_settings/Tc_management_controller/search_byname_for_profile';
$route['tc/search-admission-no'] = 'tc_settings/Tc_management_controller/search_by_admno_for_profile';
//create rout by vinoth @ 30-05-2019 12:41
$route['tc/search-name-for_tc'] = 'tc_settings/Tc_management_controller/search_name_for_profile';
$route['tc/tc-preparation'] = 'tc_settings/Tc_management_controller/tc_preparation';
$route['tc/tc-prepsave'] = 'tc_settings/Tc_management_controller/save_tc_preparation';
$route['tc/tc-preparation'] = 'tc_settings/Tc_management_controller/tc_preparation';
$route['tc/tc-issuing'] = 'tc_settings/Tc_management_controller/tc_issue';

$route['tc/tc-application'] = 'student_settings/Registration_controller/tc_application';
$route['tc/tc-issue'] = 'student_settings/Registration_controller/tc_issue';
$route['tc/search-filter'] = 'student_settings/Registration_controller/search_filter';

//$route['tc/search-admission-no'] = 'tc_settings/Tc_management_controller/search_byname_for_profile';
/***TC ENDS */

//LONG ABSENTEE MODULE
$route['longabsentee/show-class-for-students'] = 'student_settings/Longabsentee_controller/show_class_categorylongabsent';
$route['longabsent/show-studentlist'] = 'student_settings/Longabsentee_controller/show_student_longabsentlist';
$route['long_absentee/search-admission-no'] = 'student_settings/Longabsentee_controller/search_byname_for_profile';

$route['longabsentee/long-fees'] = 'student_settings/Registration_controller/show_fees';
$route['longabsentee/longabsentrelease'] = 'student_settings/Registration_controller/show_fees_release';
$route['longabsentee/long-ab'] = 'student_settings/Longabsentee_controller/show_absentee';
$route['longabsentee/search-filter'] = 'student_settings/Registration_controller/search_filter';

$route['longabsent/longabsent-release'] = 'student_settings/Longabsentee_controller/studentlongabsentrelease';


$route['profile/longabsente-save'] = 'student_settings/Longabsentee_controller/save_longabsentee';
$route['registration/validate-admissiondate'] = 'student_settings/Registration_controller/admindate_valitdation';
$route['registration/validate-dropdowns'] = 'student_settings/Registration_controller/dropdown_valitdation';

$route['registration/search-profilename'] = 'student_settings/Registration_controller/profile/search-admission-no';
$route['profile/search-admission-no'] = 'student_settings/Registration_controller/search_byname_for_profile';
$route['profile/search_with_name_or_admission'] = 'student_settings/Registration_controller/get_student_by_name_or_admission';
//cretae route by vinoth @ 26-06-2019 14:04
$route['profile/search-admission-no-for-sponsered_stud'] = 'student_settings/Registration_controller/search_byadmnno_for_sponsered_stud';
//cretae route by vinoth @ 30-05-2019 11:51
$route['profile/search-name'] = 'student_settings/Registration_controller/search_byname_withoutbatch';
$route['profile/search-name-for-sponsered_stud'] = 'student_settings/Registration_controller/search_byname_for_sponsered_stud';

$route['profile/show-filter'] = 'student_settings/Registration_controller/student_filter';

$route['course/save-batch_allocate'] = 'course_settings/Course_controller/save_batch_allocate';

$route['profile/validate-admissiondate-custom'] = 'student_settings/Registration_controller/admindate_valitdation_custom';
$route['registration/validate-admissiondate-custom'] = 'student_settings/Registration_controller/admindate_valitdation_custom';
$route['registration/edit-profile'] = 'student_settings/Registration_controller/edit_student_profile';
$route['registration/edit-fill-profile'] = 'student_settings/Registration_controller/fill_new_details';
$route['profile/validate-admissiondate'] = 'student_settings/Registration_controller/admindate_valitdation';
$route['profile/validate-dropdowns'] = 'student_settings/Registration_controller/dropdown_valitdation';
$route['profile/validate-adhar'] = 'student_settings/Registration_controller/adhar_validation';
$route['profile/validate-mobile'] = 'student_settings/Registration_controller/mob_validation';
$route['profile/validate-email'] = 'student_settings/Registration_controller/email_validation';
$route['registration/validate-email'] = 'student_settings/Registration_controller/email_validation';


$route['document/upload-file'] = 'student_settings/Documents_controller/upload_file_to_local_server';
$route['document/delete-uploaded-file'] = 'student_settings/Documents_controller/delete_uploaded_file_from_local_server';
$route['document/save_document_uploaded'] = 'student_settings/Documents_controller/save_uploaded_file';

//14-11-2017 starts

$route['purchase/direct-purchase_sup'] = 'store_settings/Purchase_management_controller/direct_purchase_supplier';
$route['purchase/purchase-edit'] = 'store_settings/Purchase_management_controller/edit_purchase_load';
$route['purchase/purchase-edit-save'] = 'store_settings/Purchase_management_controller/edit_purchase_save';
$route['purchase/purchase-delete'] = 'store_settings/Purchase_management_controller/delete_purchase';
$route['purchase/purchase-return_sup'] = 'store_settings/Purchase_management_controller/purchase_return_sup';
$route['purchase/return-purchase'] = 'store_settings/Purchase_management_controller/purchase_returnrequest';
$route['purchase/direct-purchase_approve'] = 'store_settings/Purchase_management_controller/direct_purchase_approve';
$route['purchase/purchase_view'] = 'store_settings/Purchase_management_controller/purchase_view';
$route['purchase/purchase-returnview'] = 'store_settings/Purchase_management_controller/purchase_returnview';
$route['purchase/show-purchase_return'] = 'store_settings/Purchase_management_controller/show_purchase_return';
$route['purchase/purchase-returndelete'] = 'store_settings/Purchase_management_controller/purchase_returndelete';

$route['stock/opening-stock'] = 'store_settings/Openingstock_controller/opening_stock';
$route['stock/stock-list'] = 'store_settings/Openingstock_controller/stock_list';
$route['stock/stock-details'] = 'store_settings/Openingstock_controller/open_stock_details';
$route['rate/show-rate'] = 'store_settings/Rates_controller/show_rates';
$route['rate/show-storeselection'] = 'store_settings/Rates_controller/store_selection';

$route['store/show-store'] = 'store_settings/Store_management_controller/show_store';
$route['store/add-store'] = 'store_settings/Store_management_controller/add_store';
$route['store/edit-store'] = 'store_settings/Store_management_controller/edit_store';
$route['store/change_status'] = 'store_settings/Store_management_controller/update_status';
$route['stock/current_stock_list'] = 'store_settings/Openingstock_controller/current_stock_list';

$route['purchase/direct-purchaseorder_recieved'] = 'store_settings/Purchase_management_controller/purchaseorder_recieved';
$route['allotment/edit-allotment'] = 'store_settings/Allotment_management_controller/edit_allotment';
$route['allotment/view-allotment'] = 'store_settings/Allotment_management_controller/view_allotment';
$route['allotment/approve-allotment'] = 'store_settings/Allotment_management_controller/approve_allotment';
$route['purchase/purchaseorder-purchase_sup'] = 'store_settings/Purchase_management_controller/purchase_order_supplier';
$route['purchase/new-purchaseorder'] = 'store_settings/Purchase_management_controller/new_purchase_order';
$route['allotment/add-allotment_substore'] = 'store_settings/Allotment_management_controller/add_allotment_substore';
$route['allotment/allotment-delete'] = 'store_settings/Allotment_management_controller/allotment_delete';
$route['allotment/approve-save-allotment'] = 'store_settings/Allotment_management_controller/save_allotmet_status';

$route['allotment/save-allotment'] = 'store_settings/Allotment_management_controller/save_allotment';
$route['rate/update-rates'] = 'store_settings/Rates_controller/update_rates';



$route['purchase/direct-purchase-search'] = 'store_settings/Purchase_management_controller/search_item_for_direct_purchase';
$route['purchase/direct-purchase-save'] = 'store_settings/Purchase_management_controller/direct_purchase_save';
$route['purchase/purchase-return-save'] = 'store_settings/Purchase_management_controller/purchase_return_save';
$route['purchase/purchase-order-save'] = 'store_settings/Purchase_management_controller/purchase_order_save';


// Reports

$route['report/show-reportdata'] = 'report_settings/Report_controller/show_report_settings';
$route['report/show-promotion-reportdata'] = 'report_settings/Report_controller/show_report_settings_promotion';
$route['report/show-tc-reportdata'] = 'report_settings/Report_controller/show_report_settings_tc';
$route['report/show-report'] = 'report_settings/Report_controller/show_reportdata';

$route['course/class-report'] = 'report_settings/Report_controller/Course_Classwise_reportPDF';
$route['course/class-reportpdf'] = 'report_settings/Report_controller/course_class_reportdata';

$route['course/batch-report'] = 'report_settings/Report_controller/Course_Batchwise_reportdata';
$route['course/batch-reportpdf'] = 'report_settings/Report_controller/course_batch_reportPDF';

//Student Strength Report
$route['report/stud-strengthrpt'] = 'report_settings/Report_controller/show_report_data';
//familywise Report create by vinoth @ 17-06-2019 11:21
$route['report/stud-familywise_data_rpt'] = 'report_settings/Report_controller/show_familywise_report_data';
$route['report/show-studreportpdf'] = 'report_settings/Report_controller/strngthreportPDF';

//IDwise Report
$route['report/student_id_wise_report'] = 'report_settings/Report_controller/student_id_wise_report';
$route['report/get_student_id_wise_report'] = 'report_settings/Report_controller/get_student_id_wise_report';

//familywise student report
//$route['report/show-familywisepdf'] = 'report_settings/Report_controller/show_familywiserpt_data';
$route['report/stud-familywiserpt'] = 'report_settings/Report_controller/familywiserpt_pdf';

//Nationalitywise Report
$route['report/show-nationwisepdf'] = 'report_settings/Report_controller/show_nationwiserpt_data';
$route['report/stud-nationwisepdf'] = 'report_settings/Report_controller/nationwiserpt_data';

//Religionwise Report
$route['report/show-religionwisepdf'] = 'report_settings/Report_controller/show_religionwiserpt_data';
$route['report/stud-religionwisepdf'] = 'report_settings/Report_controller/religionwiserpt_data';

//Professionwise Report
$route['report/show-professionwiserpt'] = 'report_settings/Report_controller/show_professionwiserpt_data';
$route['report/show-professionwiserptpdf'] = 'report_settings/Report_controller/professsionwiserpt_data';

//Class/Divisionwise Report
$route['report/show-classdivisnwisepdf'] = 'report_settings/Report_controller/show_classdivsnwiserpt_data';
$route['report/stud-classdivisnwisepdf'] = 'report_settings/Report_controller/classdivsnwiserpt_data';
//Class wise Strength Report
$route['report/show-classwisestrngthpdf'] = 'report_settings/Report_controller/show_classwisesrngthrpt_data';
$route['report/show-notbatchallotedstudpdf'] = 'report_settings/Report_controller/show_nobatchallotedstudrpt_data';
$route['report/stud-classwisepdf'] = 'report_settings/Report_controller/classwiserpt_data';
$route['report/stud-nobatchstudpdf'] = 'report_settings/Report_controller/no_batchstud_data';

// create routes for familywise report  by vinoth @ 17-06-2019 11:03
$route['report/show-familywisepdf'] = 'report_settings/Report_controller/show_familywise_data';

//Genderwise Report
$route['report/show-genderwisepdf'] = 'report_settings/Report_controller/show_genderwiserpt_data';
$route['report/stud-genderwisepdf'] = 'report_settings/Report_controller/genderwiserpt_data';

//Collected Document Report
$route['report/show-collectdocmntpdf'] = 'report_settings/Report_controller/show_documentrpt_data';
$route['report/stud-collectdocumntpdf'] = 'report_settings/Report_controller/documentrpt_data';
$route['report/get-batch-details'] = 'report_settings/Report_controller/get_batch_details';
$route['report/get-division-details'] = 'report_settings/Report_controller/get_division_details';

//Long Absentee Report
$route['report/show-longabsenteepdf'] = 'report_settings/Report_controller/show_longabsenteerpt_data';
$route['report/stud-longabsenteepdf'] = 'report_settings/Report_controller/longabsenteerpt_data';

//Contactwise Report
$route['report/show-contactwisepdf'] = 'report_settings/Report_controller/show_contactwiserpt_data';
$route['report/stud-contactwisepdf'] = 'report_settings/Report_controller/contactwiserpt_data';

//Agewise Report
$route['report/show-agewisepdf'] = 'report_settings/Report_controller/show_agewiserpt_data';
$route['report/stud-agewisepdf'] = 'report_settings/Report_controller/agewiserpt_data';

//Castewise Report
$route['report/show-castewisepdf'] = 'report_settings/Report_controller/show_castewiserpt_data';
$route['report/stud-castewisepdf'] = 'report_settings/Report_controller/castewiserpt_data';

//Age/Sexwise Report
$route['report/show-agesexwisepdf'] = 'report_settings/Report_controller/show_agesexwiserpt_data';
$route['report/stud-agesexwisepdf'] = 'report_settings/Report_controller/agesexwiserpt_data';

//Promotion report
$route['report/show-promotion-preloaders'] = 'report_settings/Report_controller/show_preloader_promotion_report';
$route['report/get-promotion-report'] = 'report_settings/Report_controller/get_promotion_report';
$route['report/show-detained-preloaders'] = 'report_settings/Report_controller/show_preloader_detained_report';
$route['report/get-detained-report'] = 'report_settings/Report_controller/get_detained_report';

$route['familyreport/show-class-for-students'] = 'report_settings/Reports_controller/show_class_category';
//$route['familyreport/show-class-for-students'] = 'report_settings/Reports_controller/advanced_filter_search';
$route['familyreport/search-admission-no'] = 'report_settings/Reports_controller/search_byname_for_profile';

$route['familyreport/show-profile'] = 'report_settings/Reports_controller/show_student_profile';
$route['familyreport/search-profilename'] = 'report_settings/Reports_controller/search_byname';
$route['familyreport/show-familyreport'] = 'report_settings/Reports_controller/family_individualreport';

$route['report/show-tc-summary-preloaders'] = 'report_settings/Report_controller/show_preloader_tc_summary_report';
$route['report/get-tc-summary-report'] = 'report_settings/Report_controller/get_tc_summary_report';

$route['report/show-tc-applied-preloaders'] = 'report_settings/Report_controller/show_preloader_tc_applied_report';
$route['report/get-tc-applied-report'] = 'report_settings/Report_controller/get_tc_applied_report';

$route['report/show-tc-issue-preloaders'] = 'report_settings/Report_controller/show_preloader_tc_issue_report';
$route['report/get-tc-prepared-report'] = 'report_settings/Report_controller/get_tc_prepared_report';
//this route add by elavarasan S @ 18-05-2019 2:00
$route['report/get_general_reports'] = 'general_settings/Settings_controller/get_report_general_settings';
//this route add by elavarasan S @ 05-06-2019 11:00
$route['transport/basic-sett'] = 'transport/Transport_controller/show_basic_settings';

$route['transport/show-conductor'] = 'transport/Transport_controller/show_conductor';

$route['transport/show-driver'] = 'transport/Transport_controller/show_driver';
$route['transport/create-new-conductor'] = 'transport/Transport_controller/add_conductor';
$route['transport/create-new-driver'] = 'transport/Transport_controller/add_driver';
$route['transport/add-conductor'] = 'transport/Transport_controller/save_conductor';
$route['transport/add-driver'] = 'transport/Transport_controller/save_driver';
$route['transport/edit-conductor'] = 'transport/Transport_controller/edit_conductor';
$route['transport/edit-driver'] = 'transport/Transport_controller/edit_driver';
$route['transport/update-conductor'] = 'transport/Transport_controller/edit_save_conductor';
$route['transport/update-driver'] = 'transport/Transport_controller/edit_save_driver';
$route['transport/change_conductor_status'] = 'transport/Transport_controller/change_status_conductor';
$route['transport/change_driver_status'] = 'transport/Transport_controller/change_status_driver';
$route['transport/get_select_emp_data'] = 'transport/Transport_controller/get_select_emp_data';
$route['transport/daily-travel-log'] = 'transport/Transport_controller/daily_travel_log_view';
$route['transport/get-travel-log'] = 'transport/Transport_controller/get_daily_travel_log';

$route['stock/opening-stock'] = 'store_settings/Openingstock_controller/opening_stock';
$route['stock/current_stock_list'] = 'store_settings/Openingstock_controller/current_stock_list';
$route['stock/stock-list'] = 'store_settings/Openingstock_controller/stock_list';
$route['stock/stock-details'] = 'store_settings/Openingstock_controller/open_stock_details';
$route['stock/item-stock'] = 'store_settings/Stock_management_controller/get_stock_of_items';
$route['stock/item-stock-store'] = 'store_settings/Stock_management_controller/store_selection';
$route['openingstock/save-openingStock'] = 'store_settings/Openingstock_controller/save_openingStock';

$route['report/stock-detail'] = 'store_settings/Report_management_controller/report_stock_all_pre_load';
$route['report/stock-detail-report'] = 'store_settings/Report_management_controller/report_gen_stock_report_all';

$route['report/stock-summary'] = 'store_settings/Report_management_controller/report_stock_summary_pre_load';
$route['report/stock-summary-report'] = 'store_settings/Report_management_controller/report_gen_stock_report_summary';

$route['report/stock-item-wise'] = 'store_settings/Report_management_controller/report_stock_itemwise_pre_load';
$route['report/stock-item-wise-report'] = 'store_settings/Report_management_controller/report_gen_stock_report_all';

$route['report/stock-transfer-outward'] = 'store_settings/Report_management_controller/report_stock_allotment_outward_pre_load';
$route['report/stock-transfer-outward-report'] = 'store_settings/Report_management_controller/report_gen_stock_allotment_outward_report_summary';

$route['report/stock-transfer-inward'] = 'store_settings/Report_management_controller/report_stock_allotment_inward_pre_load';
$route['report/stock-transfer-inward-report'] = 'store_settings/Report_management_controller/report_gen_stock_report_all';





/*
 * Sub store routes
 */
$route['substore/show-dashboard'] = 'administration/Home_controller/show_book_dashboard';


$route['substore/bill-print/(:any)'] = 'substore_settings/Bill_controller/create_bill_print/$1';
$route['substore/bill-print-download/(:any)'] = 'substore_settings/Bill_controller/create_bill_print_link/$1';
$route['substore/bill-print-other/(:any)'] = 'substore_settings/Bill_controller/create_bill_print_link_other/$1';
$route['substore/bill-print-duplicate/(:any)'] = 'substore_settings/Bill_controller/create_bill_print_link_duplicate/$1';


$route['substore/bill-student'] = 'substore_settings/Bill_controller/student_bill';

$route['substore/bill-employee'] = 'substore_settings/Bill_controller/employee_bill';
$route['sales/student-delivery-return'] = 'substore_settings/Delivery_controller/student_deliveryreturn';
$route['delivery/search-st-advanced'] = 'substore_settings/Delivery_controller/search_st_deliveryrtn';
$route['deliveryrtrn/search-st-advanced'] = 'substore_settings/Delivery_controller/search_st_delivery';
$route['deliveryrtn/search-emp-advanced'] = 'substore_settings/Delivery_controller/search_emp_deliveryrtn';
$route['delivery/search-emp-advanced'] = 'substore_settings/Delivery_controller/search_emp_delivery';
$route['delivery/search-emp-data'] = 'substore_settings/Delivery_controller/search_emp_data';
$route['delivery/search-st-data'] = 'substore_settings/Delivery_controller/search_st_data';
$route['deliveryrtn/search-st-rtndata'] = 'substore_settings/Delivery_controller/voucher_st_rtndata';
$route['delivery/search-emprtns-data'] = 'substore_settings/Delivery_controller/voucher_emp_rtndata';
$route['sales/search-delivery-return'] = 'substore_settings/Delivery_controller/search_return_data';


$route['substore/generate-invoice'] = 'substore_settings/sales_controller/invoice_generation';

$route['substore/item-packing'] = 'substore_settings/Sales_controller/items_packing';
$route['substore/item-individualpacking'] = 'substore_settings/Sales_controller/items_individualpacking';
$route['itempacking/search-st-advanced'] = 'substore_settings/Sales_controller/items_stpacking_search';
$route['sales/student-item-packing'] = 'substore_settings/Sales_controller/items_studpacking';
$route['itempacking/search-emp-advanced'] = 'substore_settings/Sales_controller/items_emppacking_search';
$route['sales/emp-item-packing'] = 'substore_settings/Sales_controller/items_emp_search';



$route['oh/create-ohtemplate'] = 'substore_settings/Oh_management_controller/list_ohtemplate';
//$route['substore/item-templatepack'] = 'substore_settings/Oh_management_controller/oh_packitems';
$route['template/add-ohtemplates'] = 'substore_settings/Oh_management_controller/create_ohtemplate';

$route['substore/bill-history'] = 'substore_settings/Bill_controller/bill_history';
$route['bill/viewbill-history'] = 'substore_settings/Bill_controller/view_bill_history';


$route['stock/stock-status'] = 'substore_settings/Stock_controller/live_stock';




$route['substore/item-batchpacking'] = 'substore_settings/Sales_controller/batch_loosepacking';
$route['substore/class_batch_list'] = 'substore_settings/Sales_controller/batch_list';
$route['substore/class_item_list'] = 'substore_settings/Sales_controller/class_list';
$route['substore/item-classpacking'] = 'substore_settings/Sales_controller/class_loosepacking';
$route['substore/item-specimenpacking'] = 'substore_settings/Sales_controller/specimen_issue';
$route['sale/specimen_packing'] = 'substore_settings/Sales_controller/specimen_packing';
//Billing
$route['substore/bill-test'] = 'substore_settings/Sales_controller/bill_test';
$route['bill/search-studentname'] = 'substore_settings/Sales_controller/search_byname';
$route['bill/advancesearch-studentname'] = 'substore_settings/Sales_controller/advancesearch_byname';
$route['substore/get-bill-batchdetails'] = 'substore_settings/Sales_controller/batchlist';


$route['sale/students_batch'] = 'substore_settings/Sales_controller/show_student_profile_substore';
$route['sale/loose_packing'] = 'substore_settings/Sales_controller/loose_packing_student';
$route['substore/search-name'] = 'substore_settings/Sales_controller/search_student';
$route['substore/search-item'] = 'substore_settings/Salesettings_controller/search_item';
$route['substore/save-specimen_issue'] = 'substore_settings/Salesettings_controller/save_emp_specimen_issue';
$route['substore/save-looseitem_issue'] = 'substore_settings/Salesettings_controller/save_student_item_issue';
$route['substore/search-teachername'] = 'substore_settings/Salesettings_controller/search_teachername';
$route['billstudent/show-studentbill'] = 'substore_settings/Sales_controller/search_studentname';
$route['substore/pack-details'] = 'substore_settings/Sales_controller/search_packdetails';
$route['substore/bill-details'] = 'substore_settings/Sales_controller/search_billdetails';

$route['substore/specimen-delivery'] = 'substore_settings/Delivery_controller/specimen_delivery';
$route['delivery/students_batch'] = 'substore_settings/Delivery_controller/show_student_profile_substore';
$route['delivery/loose_delivery'] = 'substore_settings/Delivery_controller/loose_delivery_student';

$route['substore/online-order-cod-process'] = 'substore_settings/Bill_controller/process_cash_on_delivery';
$route['substore/online-delivery-pack-details'] = 'substore_settings/Delivery_controller/search_packdetails_online_delivery';
$route['substore/delivery-pack-details'] = 'substore_settings/Delivery_controller/search_packdetails';
$route['delivery/delivery-save'] = 'substore_settings/Delivery_controller/save_delivery';
$route['delivery/delivery-note-print'] = 'substore_settings/Delivery_controller/generate_print_delivery_note';
$route['substore/delivery-item-replace'] = 'substore_settings/Delivery_controller/delivery_item_replace'; //4/1/2018
$route['delivery/replace-item'] = 'substore_settings/Delivery_controller/replace_item'; //5/1/2018
$route['sales/search-student-deliveryReturn'] = 'substore_settings/Delivery_controller/search_byname_returnDelivery'; //11/01/2018
$route['delivery/show-deliveryreturn'] = 'substore_settings/Delivery_controller/show_deliveryreturn'; //11/01/2018
$route['substore/deliveryReturn-pack-details'] = 'substore_settings/Delivery_controller/deliveryReturn_pack_details'; //11/01/2018
$route['delivery/deliveryReturn-save'] = 'substore_settings/Delivery_controller/deliveryReturn_save'; //12/01/2018
$route['delivery/deliveryOHReturn-save'] = 'substore_settings/Delivery_controller/deliveryOHReturn_save'; //16/01/2018
$route['sales/search-voucher-delivery'] = 'substore_settings/Delivery_controller/search_byvoucher'; //17/01/2018
$route['sales/search-voucher-deliveryReturn'] = 'substore_settings/Delivery_controller/search_Returnbyvoucher'; //17/01/2018
$route['stock/allot-list'] = 'substore_settings/Stock_controller/stock_allotment_list'; //18/01/2018
$route['stock/view-allotment-substore'] = 'substore_settings/Stock_controller/stock_allotment_view'; //18/01/2018
$route['packing/search-profilename'] = 'substore_settings/Sales_controller/search_byname_packing'; //20/01/2018


/* Author chandrajith 01-01-2017 */
$route['sales/substore-delivery-student'] = 'substore_settings/Delivery_controller/show_filter_student';
$route['sales/substore-online-billing-order'] = 'substore_settings/Delivery_controller/online_billed_list';
$route['sales/show-studentdelivery'] = 'substore_settings/Delivery_controller/search_studentname';
$route['sales/search-student-delivery'] = 'substore_settings/Delivery_controller/search_byname';
//
/*

  /*Author Chandrajith */
$route['substore/show-bookstorebill'] = 'substore_settings/Bill_controller/bill_store';
$route['substore-bill-pay/pay-cash-amount'] = 'substore_settings/Bill_controller/cash_bill_pay';
$route['substore-bill-pay/pay-cheque-amount'] = 'substore_settings/Bill_controller/cheque_bill_pay';

$route['substore-report/sale-return-pre-load'] = 'substore_settings/Report_controller/get_preload_sale_return_data';
$route['substore-report/sale-return-report'] = 'substore_settings/Report_controller/report_gen_sale_return_report_all';

$route['substore-report/sale-pre-load'] = 'substore_settings/Report_controller/get_preload_sale_data';
$route['substore-report/sale-report'] = 'substore_settings/Report_controller/report_gen_sale_report_all';

$route['substore-report/sale-itemwise-pre-load'] = 'substore_settings/Report_controller/get_preload_sale_itemwise_data';
$route['substore-report/sale-itemwise-report'] = 'substore_settings/Report_controller/report_gen_sale_itemwise_report_all';

$route['substore-report/sale-itemwise-summary-pre-load'] = 'substore_settings/Report_controller/get_preload_sale_itemwise_summary_data';
$route['substore-report/sale-itemwise-summary-report'] = 'substore_settings/Report_controller/report_gen_sale_itemwise_summary_report_all';

$route['substore-report/bbnd-pre-load'] = 'substore_settings/Report_controller/get_preload_bbnd_data';
$route['substore-report/bbnd-report'] = 'substore_settings/Report_controller/report_gen_bbnd_report_all';


$route['substore-report/partial-collection-load'] = 'substore_settings/Report_controller/get_preload_partial_collection_data';
$route['substore-report/partial-collection-report'] = 'substore_settings/Report_controller/report_gen_partial_collection_all';

$route['substore-report/collection-load'] = 'substore_settings/Report_controller/get_preload_collection_data';
$route['substore-report/collection-report'] = 'substore_settings/Report_controller/report_gen_collection_report_all';

$route['substore-report/collection-userwise-load'] = 'substore_settings/Report_controller/get_preload_collection_data_user_wise';
$route['substore-report/collection-userwise-report'] = 'substore_settings/Report_controller/report_gen_collection_report_all_user_wise';

$route['substore-report/Summary-collection-userwise-load'] = 'substore_settings/Report_controller/get_preload_summary_collection_data_user_wise';
$route['substore-report/summary-collection-userwise-report'] = 'substore_settings/Report_controller/report_gen_summary_collection_report_all_user_wise';

$route['download/reports/(:any)'] = 'substore_settings/Report_controller/download/$1';
$route['download/bill/(:any)'] = 'substore_settings/Bill_controller/download/$1';
//
/*
 * Sub store routes end
 */

/*  02-01-2017 */
$route['substore/show-ohtemplate'] = 'substore_settings/Oh_management_controller/oh_template';
$route['substore/add-ohtemplate'] = 'substore_settings/Oh_management_controller/add_ohtemplate';
$route['substore/edit-ohtemplate'] = 'substore_settings/Oh_management_controller/edit_ohtemplate';

$route['substore/show-openhouse'] = 'substore_settings/Oh_management_controller/show_openhouse';
$route['substore/save-openhouse'] = 'substore_settings/Oh_management_controller/save_openhouse';
$route['substore/list-openhouse'] = 'substore_settings/Oh_management_controller/list_openhouse';
$route['substore/edit-openhouse'] = 'substore_settings/Oh_management_controller/edit_openhouse';
$route['substore/view-openhouse'] = 'substore_settings/Oh_management_controller/view_openhouse';
$route['substore/delete-openhouse'] = 'substore_settings/Oh_management_controller/delete_openhouse';

$route['substore/item-ohpacking'] = 'substore_settings/OH_packing_controller/oh_item_assign';
$route['substore/items-adding'] = 'substore_settings/OH_packing_controller/oh_item_adding';
$route['substore/search-ohstoredata'] = 'substore_settings/OH_packing_controller/search_ohstoredata';
$route['substore/search-ohstoredata'] = 'substore_settings/OH_packing_controller/search_ohstoredata';

$route['substore/save-oh_item'] = 'substore_settings/OH_packing_controller/save_ohitem_assign';

$route['substore/search-pack'] = 'substore_settings/Bill_controller/search_pack';
$route['substore/item-templatepack'] = 'substore_settings/OH_packing_controller/oh_packitems';
$route['substore/item-stud_attach'] = 'substore_settings/OH_packing_controller/oh_stud_attachment';
$route['substore/batch-stud_item_attach'] = 'substore_settings/OH_packing_controller/load_batch_data';
$route['substore/search-stud_item_attach'] = 'substore_settings/OH_packing_controller/load_search_stud_data';
$route['substore/save-stud_item_attach'] = 'substore_settings/OH_packing_controller/save_stud_data';

// 15-1-2018
$route['sales/substore-delivery-faculty'] = 'substore_settings/Delivery_controller/show_filter_faculty';
$route['sales/substore-faculty-delivery'] = 'substore_settings/Delivery_controller/show_faculty_delivery';
$route['sales/search-teachername'] = 'substore_settings/Delivery_controller/search_teachername';
$route['sales/search-specimen-return'] = 'substore_settings/Delivery_controller/search_specimen_return_data';
// 16-1-2018
$route['delivery/show-faculty_deliveryreturn'] = 'substore_settings/Delivery_controller/show_faculty_deliveryreturn';
$route['substore/faculty-deliveryReturn-pack-details'] = 'substore_settings/Delivery_controller/faculty_deliveryReturn_pack_details';
$route['delivery/faculty_deliveryReturn-save'] = 'substore_settings/Delivery_controller/faculty_deliveryReturn_save';
$route['delivery/search-teachername'] = 'substore_settings/Delivery_controller/search_teachername_delivery_return';
//// 17-1-2018
$route['delivery/advancesearch-studentname'] = 'substore_settings/Delivery_controller/advancesearch_byname';
$route['deliveryrtn/advancesearch-studentname'] = 'substore_settings/Delivery_controller/delivery_rtn_advancesearch_byname';
$route['substore/search_template_byname'] = 'substore_settings/OH_packing_controller/search_template_byname';
$route['substore/item-templatepack_search'] = 'substore_settings/OH_packing_controller/search_openhouse_byname';
//
$route['sales/searchstud-voucher-delivery'] = 'substore_settings/Delivery_controller/search_bystudvoucher';
$route['sales/searchstud-voucher-deliveryretn'] = 'substore_settings/Delivery_controller/search_bystudvoucher_rtn';
$route['sale/search-profilename'] = 'substore_settings/Sales_controller/search_stud_byname';

$route['sales/faculty-voucher-delivery'] = 'substore_settings/Delivery_controller/search_by_emp_voucher';
$route['sales/faculty-voucher-deliveryretn'] = 'substore_settings/Delivery_controller/search_by_emp_voucher_rtn';


$route['report/stock-detail'] = 'substore_settings/Report_controller/report_stock_all_pre_load';
$route['report/stock-detail-report'] = 'substore_settings/Report_controller/report_gen_stock_report_all';

$route['report/stock-summary'] = 'substore_settings/Report_controller/report_stock_summary_pre_load';
$route['report/stock-summary-report'] = 'substore_settings/Report_controller/report_gen_stock_report_summary';

$route['substore/openhouse-change'] = 'substore_settings/OH_packing_controller/openhouse_change';
$route['substore/list-stud_attached'] = 'substore_settings/OH_packing_controller/openhouse_stud_list';
$route['substore/remove-stud_item_attach'] = 'substore_settings/OH_packing_controller/remove_stud_data';
$route['substore/openhouse-change_search'] = 'substore_settings/OH_packing_controller/search_openhouse_change';

$route['stock/allot-list_out'] = 'substore_settings/Stock_controller/show_allotment_out'; //07/02/2018
$route['stock/allot-edit_out'] = 'substore_settings/Stock_controller/edit_allotment_load_out'; //07/02/2018
$route['stock/allot-edit_out_save'] = 'substore_settings/Stock_controller/edit_allotment_out_save'; //07/02/2018
$route['allotment/add-allotment_sub_out'] = 'substore_settings/Stock_controller/add_allotment_sub_out'; //07/02/2018
$route['allotment/save-allotment_sub_out'] = 'substore_settings/Stock_controller/save_allotment_sub_out'; //07/02/2018

$route['allotment/view-allotment_out'] = 'substore_settings/Stock_controller/view_allotment_out'; //08/02/2018

$route['user/show-search'] = 'administration/User_activity_controller/search_activities'; //07/02/2018

$route['substore/add_temp-openhouse'] = 'substore_settings/Oh_management_controller/add_temp_openhouse';

$route['substore/openhouse-view'] = 'substore_settings/OH_packing_controller/openhouse_view';
$route['substore/list-stud_assigned'] = 'substore_settings/OH_packing_controller/openhouse_stud_list_view';

$route['substore/openhouse-search'] = 'substore_settings/OH_packing_controller/search_openhouse_stud_view';

$route['substore-voucher-cancel/voucher-cancel'] = 'substore_settings/Bill_controller/voucher_cancel'; // 20-02-2018
$route['substore-bill-cancel/bill-cancel'] = 'substore_settings/Bill_controller/Bill_cancell'; // 20-02-2018

$route['user/change-userpassword'] = 'administration/User_activity_controller/change_user_password';
$route['user/set-userrole'] = 'administration/User_activity_controller/set_user_roles';
$route['allotment/allotment-search_sub'] = 'substore_settings/Stock_controller/search_item_for_allotment';  //26//02/2018


$route['uniform/allotment/allotment-search_sub'] = 'uniform_sub_store/Stock_controller/search_item_for_allotment';  //26//02/2018

$route['role/add-role'] = 'administration/User_activity_controller/user_roles_save';
$route['role/update-role'] = 'administration/User_activity_controller/user_roles_update';

$route['Rolespermissions/showpermission'] = 'administration/User_activity_controller/showpermission';


$route['user/show-detail-role'] = 'administration/User_activity_controller/reload_role';

$route['404_override'] = 'administration/Authenticator_controller/error_handler_400';
$route['500_override'] = 'administration/Authenticator_controller/error_handler_500';
$route['script_error'] = 'administration/Authenticator_controller/error_handler_500_script';
$route['translate_uri_dashes'] = FALSE;


/*
 * Uniform Store
 */


$route['uniform/substore/show-store'] = 'uniform_sub_store/Storesettings_controller/bookstore';
$route['uniform/substore/show-sale'] = 'uniform_sub_store/Salesettings_controller/sale_issue';
$route['uniform/substore/specimen-issue'] = 'uniform_sub_store/Salesettings_controller/specimen_issue'; //no files found
$route['uniform/substore/items-list'] = 'uniform_sub_store/Salesettings_controller/show_item';

$route['uniform/substore/item-ohissue'] = 'uniform_sub_store/OH_issue_controller/OH_issue';

$route['uniform/substore/item-delivery'] = 'uniform_sub_store/OH_issue_controller/Item_delivery';
$route['uniform/substore/item-delivery-return'] = 'uniform_sub_store/Delivery_controller/delivery_return';
$route['uniform/substore/item-add'] = 'uniform_sub_store/Salesettings_controller/add_item';


$route['uniform/substore/bill-print/(:any)'] = 'uniform_sub_store/Bill_controller/create_bill_print/$1';
$route['uniform/substore/bill-print-download/(:any)'] = 'uniform_sub_store/Bill_controller/create_bill_print_link/$1';
$route['uniform/substore/bill-print-other/(:any)'] = 'uniform_sub_store/Bill_controller/create_bill_print_link_other/$1';
$route['uniform/substore/bill-print-duplicate/(:any)'] = 'uniform_sub_store/Bill_controller/create_bill_print_link_duplicate/$1';


$route['uniform/substore/bill-student'] = 'uniform_sub_store/Bill_controller/student_bill';

$route['uniform/substore/bill-employee'] = 'uniform_sub_store/Bill_controller/employee_bill';
$route['uniform/sales/student-delivery-return'] = 'uniform_sub_store/Delivery_controller/student_deliveryreturn';
$route['uniform/delivery/search-st-advanced'] = 'uniform_sub_store/Delivery_controller/search_st_deliveryrtn';
$route['uniform/deliveryrtrn/search-st-advanced'] = 'uniform_sub_store/Delivery_controller/search_st_delivery';
$route['uniform/deliveryrtn/search-emp-advanced'] = 'uniform_sub_store/Delivery_controller/search_emp_deliveryrtn';
$route['uniform/delivery/search-emp-advanced'] = 'uniform_sub_store/Delivery_controller/search_emp_delivery';
$route['uniform/delivery/search-emp-data'] = 'uniform_sub_store/Delivery_controller/search_emp_data';
$route['uniform/delivery/search-st-data'] = 'uniform_sub_store/Delivery_controller/search_st_data';
$route['uniform/deliveryrtn/search-st-rtndata'] = 'uniform_sub_store/Delivery_controller/voucher_st_rtndata'; //no matching files
$route['uniform/delivery/search-emprtns-data'] = 'uniform_sub_store/Delivery_controller/voucher_emp_rtndata';
$route['uniform/sales/search-delivery-return'] = 'uniform_sub_store/Delivery_controller/search_return_data';


$route['uniform/substore/generate-invoice'] = 'uniform_sub_store/sales_controller/invoice_generation';

$route['uniform/substore/item-packing'] = 'uniform_sub_store/Sales_controller/items_packing';
$route['uniform/substore/item-individualpacking'] = 'uniform_sub_store/Sales_controller/items_individualpacking';
$route['uniform/itempacking/search-st-advanced'] = 'uniform_sub_store/Sales_controller/items_stpacking_search';
$route['uniform/sales/student-item-packing'] = 'uniform_sub_store/Sales_controller/items_studpacking';
$route['uniform/itempacking/search-emp-advanced'] = 'uniform_sub_store/Sales_controller/items_emppacking_search';
$route['uniform/sales/emp-item-packing'] = 'uniform_sub_store/Sales_controller/items_emp_search';



$route['uniform/oh/create-ohtemplate'] = 'uniform_sub_store/Oh_management_controller/list_ohtemplate';

$route['uniform/template/add-ohtemplates'] = 'uniform_sub_store/Oh_management_controller/create_ohtemplate';

$route['uniform/substore/bill-history'] = 'uniform_sub_store/Bill_controller/bill_history';
$route['uniform/bill/viewbill-history'] = 'uniform_sub_store/Bill_controller/view_bill_history';

$route['uniform/stock/stock-status'] = 'uniform_sub_store/Stock_controller/live_stock';

$route['uniform/substore/item-batchpacking'] = 'uniform_sub_store/Sales_controller/batch_loosepacking';
$route['uniform/substore/class_batch_list'] = 'uniform_sub_store/Sales_controller/batch_list';
$route['uniform/substore/class_item_list'] = 'uniform_sub_store/Sales_controller/class_list';
$route['uniform/substore/item-classpacking'] = 'uniform_sub_store/Sales_controller/class_loosepacking';
$route['uniform/substore/item-specimenpacking'] = 'uniform_sub_store/Sales_controller/specimen_issue';
$route['uniform/sale/specimen_packing'] = 'uniform_sub_store/Sales_controller/specimen_packing';

$route['uniform/substore/bill-test'] = 'uniform_sub_store/Sales_controller/bill_test';
$route['uniform/bill/search-studentname'] = 'uniform_sub_store/Sales_controller/search_byname';
$route['uniform/bill/advancesearch-studentname'] = 'uniform_sub_store/Sales_controller/advancesearch_byname';
$route['uniform/substore/get-bill-batchdetails'] = 'uniform_sub_store/Sales_controller/batchlist';


$route['uniform/sale/students_batch'] = 'uniform_sub_store/Sales_controller/show_student_profile_substore';
$route['uniform/sale/loose_packing'] = 'uniform_sub_store/Sales_controller/loose_packing_student';
$route['uniform/substore/search-name'] = 'uniform_sub_store/Sales_controller/search_student';
$route['uniform/substore/search-item'] = 'uniform_sub_store/Salesettings_controller/search_item';
$route['uniform/substore/save-specimen_issue'] = 'uniform_sub_store/Salesettings_controller/save_emp_specimen_issue';
$route['uniform/substore/save-looseitem_issue'] = 'uniform_sub_store/Salesettings_controller/save_student_item_issue';
$route['uniform/substore/search-teachername'] = 'uniform_sub_store/Salesettings_controller/search_teachername';
$route['uniform/billstudent/show-studentbill'] = 'uniform_sub_store/Sales_controller/search_studentname';
$route['uniform/substore/pack-details'] = 'uniform_sub_store/Sales_controller/search_packdetails';
$route['uniform/substore/bill-details'] = 'uniform_sub_store/Sales_controller/search_billdetails';

$route['uniform/substore/specimen-delivery'] = 'uniform_sub_store/Delivery_controller/specimen_delivery';
$route['uniform/delivery/students_batch'] = 'uniform_sub_store/Delivery_controller/show_student_profile_substore';
$route['uniform/delivery/loose_delivery'] = 'uniform_sub_store/Delivery_controller/loose_delivery_student';

$route['uniform/substore/online-order-cod-process'] = 'uniform_sub_store/Bill_controller/process_cash_on_delivery';
$route['uniform/substore/online-delivery-pack-details'] = 'uniform_sub_store/Delivery_controller/search_packdetails_online_delivery';
$route['uniform/substore/delivery-pack-details'] = 'uniform_sub_store/Delivery_controller/search_packdetails';
$route['uniform/delivery/delivery-save'] = 'uniform_sub_store/Delivery_controller/save_delivery';
$route['uniform/delivery/delivery-note-print'] = 'uniform_sub_store/Delivery_controller/generate_print_delivery_note';
$route['uniform/substore/delivery-item-replace'] = 'uniform_sub_store/Delivery_controller/delivery_item_replace'; //4/1/2018
$route['uniform/delivery/replace-item'] = 'uniform_sub_store/Delivery_controller/replace_item'; //5/1/2018
$route['uniform/sales/search-student-deliveryReturn'] = 'uniform_sub_store/Delivery_controller/search_byname_returnDelivery'; //11/01/2018
$route['uniform/delivery/show-deliveryreturn'] = 'uniform_sub_store/Delivery_controller/show_deliveryreturn'; //11/01/2018
$route['uniform/substore/deliveryReturn-pack-details'] = 'uniform_sub_store/Delivery_controller/deliveryReturn_pack_details'; //11/01/2018
$route['uniform/delivery/deliveryReturn-save'] = 'uniform_sub_store/Delivery_controller/deliveryReturn_save'; //12/01/2018
$route['uniform/delivery/deliveryOHReturn-save'] = 'uniform_sub_store/Delivery_controller/deliveryOHReturn_save'; //16/01/2018
$route['uniform/sales/search-voucher-delivery'] = 'uniform_sub_store/Delivery_controller/search_byvoucher'; //17/01/2018
$route['uniform/sales/search-voucher-deliveryReturn'] = 'uniform_sub_store/Delivery_controller/search_Returnbyvoucher'; //17/01/2018
$route['uniform/stock/allot-list'] = 'uniform_sub_store/Stock_controller/stock_allotment_list'; //18/01/2018
$route['uniform/stock/view-allotment-substore'] = 'uniform_sub_store/Stock_controller/stock_allotment_view'; //18/01/2018
$route['uniform/packing/search-profilename'] = 'uniform_sub_store/Sales_controller/search_byname_packing'; //20/01/2018

$route['uniform/sales/substore-delivery-student'] = 'uniform_sub_store/Delivery_controller/show_filter_student';
$route['uniform/sales/substore-online-billing-order'] = 'uniform_sub_store/Delivery_controller/online_billed_list';
$route['uniform/sales/show-studentdelivery'] = 'uniform_sub_store/Delivery_controller/search_studentname';
$route['uniform/sales/search-student-delivery'] = 'uniform_sub_store/Delivery_controller/search_byname';

$route['uniform/substore/show-bookstorebill'] = 'uniform_sub_store/Bill_controller/bill_store'; //no file found
$route['uniform/substore-bill-pay/pay-cash-amount'] = 'uniform_sub_store/Bill_controller/cash_bill_pay';
$route['uniform/substore-bill-pay/pay-cheque-amount'] = 'uniform_sub_store/Bill_controller/cheque_bill_pay';

$route['uniform/substore-report/sale-return-pre-load'] = 'uniform_sub_store/Report_controller/get_preload_sale_return_data';
$route['uniform/substore-report/sale-return-report'] = 'uniform_sub_store/Report_controller/report_gen_sale_return_report_all';

$route['uniform/substore-report/sale-pre-load'] = 'uniform_sub_store/Report_controller/get_preload_sale_data';
$route['uniform/substore-report/sale-report'] = 'uniform_sub_store/Report_controller/report_gen_sale_report_all';

$route['uniform/substore-report/sale-itemwise-pre-load'] = 'uniform_sub_store/Report_controller/get_preload_sale_itemwise_data';
$route['uniform/substore-report/sale-itemwise-report'] = 'uniform_sub_store/Report_controller/report_gen_sale_itemwise_report_all';

$route['uniform/substore-report/sale-itemwise-summary-pre-load'] = 'uniform_sub_store/Report_controller/get_preload_sale_itemwise_summary_data';
$route['uniform/substore-report/sale-itemwise-summary-report'] = 'uniform_sub_store/Report_controller/report_gen_sale_itemwise_summary_report_all';

$route['uniform/substore-report/bbnd-pre-load'] = 'uniform_sub_store/Report_controller/get_preload_bbnd_data';
$route['uniform/substore-report/bbnd-report'] = 'uniform_sub_store/Report_controller/report_gen_bbnd_report_all';

$route['uniform/substore-report/partial-collection-load'] = 'uniform_sub_store/Report_controller/get_preload_partial_collection_data';
$route['uniform/substore-report/partial-collection-report'] = 'uniform_sub_store/Report_controller/report_gen_partial_collection_all';


$route['uniform/substore-report/collection-load'] = 'uniform_sub_store/Report_controller/get_preload_collection_data';
$route['uniform/substore-report/collection-report'] = 'uniform_sub_store/Report_controller/report_gen_collection_report_all';

$route['uniform/substore-report/collection-userwise-load'] = 'uniform_sub_store/Report_controller/get_preload_collection_data_user_wise';
$route['uniform/substore-report/collection-userwise-report'] = 'uniform_sub_store/Report_controller/report_gen_collection_report_all_user_wise';

$route['uniform/substore-report/summary-collection-userwise-load'] = 'uniform_sub_store/Report_controller/get_preload_summary_collection_data_user_wise';
$route['uniform/substore-report/summary-collection-userwise-report'] = 'uniform_sub_store/Report_controller/report_gen_summary_collection_report_all_user_wise';

$route['uniform/download/reports/(:any)'] = 'uniform_sub_store/Report_controller/download/$1'; //not found
$route['uniform/download/bill/(:any)'] = 'uniform_sub_store/Bill_controller/download/$1'; //not found

$route['uniform/substore/show-ohtemplate'] = 'uniform_sub_store/Oh_management_controller/oh_template';
$route['uniform/substore/add-ohtemplate'] = 'uniform_sub_store/Oh_management_controller/add_ohtemplate';
$route['uniform/substore/edit-ohtemplate'] = 'uniform_sub_store/Oh_management_controller/edit_ohtemplate';

$route['uniform/substore/show-openhouse'] = 'uniform_sub_store/Oh_management_controller/show_openhouse';
$route['uniform/substore/save-openhouse'] = 'uniform_sub_store/Oh_management_controller/uniform_save_openhouse';
$route['uniform/substore/list-openhouse'] = 'uniform_sub_store/Oh_management_controller/list_openhouse';
$route['uniform/substore/edit-openhouse'] = 'uniform_sub_store/Oh_management_controller/uniform_edit_openhouse';
$route['uniform/substore/view-openhouse'] = 'uniform_sub_store/Oh_management_controller/view_openhouse';
$route['uniform/substore/delete-openhouse'] = 'uniform_sub_store/Oh_management_controller/uniform_delete_openhouse';

$route['uniform/substore/item-ohpacking'] = 'uniform_sub_store/OH_packing_controller/oh_item_assign';
$route['uniform/substore/items-adding'] = 'uniform_sub_store/OH_packing_controller/oh_item_adding';
$route['uniform/substore/search-ohstoredata'] = 'uniform_sub_store/OH_packing_controller/search_ohstoredata';
$route['uniform/substore/search-ohstoredata'] = 'uniform_sub_store/OH_packing_controller/search_ohstoredata';

$route['uniform/substore/save-oh_item'] = 'uniform_sub_store/OH_packing_controller/save_ohitem_assign';

$route['uniform/substore/search-pack'] = 'uniform_sub_store/Bill_controller/search_pack';
$route['uniform/substore/item-templatepack'] = 'uniform_sub_store/OH_packing_controller/oh_packitems';
$route['uniform/substore/item-stud_attach'] = 'uniform_sub_store/OH_packing_controller/oh_stud_attachment';
$route['uniform/substore/batch-stud_item_attach'] = 'uniform_sub_store/OH_packing_controller/load_batch_data';
$route['uniform/substore/search-stud_item_attach'] = 'uniform_sub_store/OH_packing_controller/load_search_stud_data';
$route['uniform/substore/save-stud_item_attach'] = 'uniform_sub_store/OH_packing_controller/save_stud_data';


$route['uniform/sales/substore-delivery-faculty'] = 'uniform_sub_store/Delivery_controller/show_filter_faculty';
$route['uniform/sales/substore-faculty-delivery'] = 'uniform_sub_store/Delivery_controller/show_faculty_delivery';
$route['uniform/sales/search-teachername'] = 'uniform_sub_store/Delivery_controller/search_teachername';
$route['uniform/sales/search-specimen-return'] = 'uniform_sub_store/Delivery_controller/search_specimen_return_data';

$route['uniform/delivery/show-faculty_deliveryreturn'] = 'uniform_sub_store/Delivery_controller/show_faculty_deliveryreturn';
$route['uniform/substore/faculty-deliveryReturn-pack-details'] = 'uniform_sub_store/Delivery_controller/faculty_deliveryReturn_pack_details';
$route['uniform/delivery/faculty_deliveryReturn-save'] = 'uniform_sub_store/Delivery_controller/faculty_deliveryReturn_save';
$route['uniform/delivery/search-teachername'] = 'uniform_sub_store/Delivery_controller/search_teachername_delivery_return';

$route['uniform/delivery/advancesearch-studentname'] = 'uniform_sub_store/Delivery_controller/advancesearch_byname';
$route['uniform/deliveryrtn/advancesearch-studentname'] = 'uniform_sub_store/Delivery_controller/delivery_rtn_advancesearch_byname';
$route['uniform/substore/search_template_byname'] = 'uniform_sub_store/OH_packing_controller/search_template_byname';
$route['uniform/substore/item-templatepack_search'] = 'uniform_sub_store/OH_packing_controller/search_openhouse_byname';
//
$route['uniform/sales/searchstud-voucher-delivery'] = 'uniform_sub_store/Delivery_controller/search_bystudvoucher';
$route['uniform/sales/searchstud-voucher-deliveryretn'] = 'uniform_sub_store/Delivery_controller/search_bystudvoucher_rtn';
$route['uniform/sale/search-profilename'] = 'uniform_sub_store/Sales_controller/search_stud_byname'; //no match found

$route['uniform/sales/faculty-voucher-delivery'] = 'uniform_sub_store/Delivery_controller/search_by_emp_voucher';
$route['uniform/sales/faculty-voucher-deliveryretn'] = 'uniform_sub_store/Delivery_controller/search_by_emp_voucher_rtn';


$route['uniform/report/stock-detail'] = 'uniform_sub_store/Report_controller/report_stock_all_pre_load';
$route['uniform/report/stock-detail-report'] = 'uniform_sub_store/Report_controller/report_gen_stock_report_all';

$route['uniform/report/stock-summary'] = 'uniform_sub_store/Report_controller/report_stock_summary_pre_load';
$route['uniform/report/stock-summary-report'] = 'uniform_sub_store/Report_controller/report_gen_stock_report_summary';

$route['uniform/substore/openhouse-change'] = 'uniform_sub_store/OH_packing_controller/openhouse_change';
$route['uniform/substore/list-stud_attached'] = 'uniform_sub_store/OH_packing_controller/openhouse_stud_list';
$route['uniform/substore/remove-stud_item_attach'] = 'uniform_sub_store/OH_packing_controller/remove_stud_data';
$route['uniform/substore/openhouse-change_search'] = 'uniform_sub_store/OH_packing_controller/search_openhouse_change';

$route['uniform/stock/allot-list_out'] = 'uniform_sub_store/Stock_controller/show_allotment_out';
$route['uniform/stock/allot-edit_out'] = 'uniform_sub_store/Stock_controller/edit_allotment_load_out';
$route['uniform/stock/allot-edit_out_save'] = 'uniform_sub_store/Stock_controller/edit_allotment_out_save';
$route['uniform/allotment/add-allotment_sub_out'] = 'uniform_sub_store/Stock_controller/add_allotment_sub_out';
$route['uniform/allotment/save-allotment_sub_out'] = 'uniform_sub_store/Stock_controller/save_allotment_sub_out';

$route['uniform/allotment/view-allotment_out'] = 'uniform_sub_store/Stock_controller/view_allotment_out';



$route['uniform/substore/add_temp-openhouse'] = 'uniform_sub_store/Oh_management_controller/add_temp_openhouse';

$route['uniform/substore/openhouse-view'] = 'uniform_sub_store/OH_packing_controller/openhouse_view';
$route['uniform/substore/list-stud_assigned'] = 'uniform_sub_store/OH_packing_controller/openhouse_stud_list_view';

$route['uniform/substore/openhouse-search'] = 'uniform_sub_store/OH_packing_controller/search_openhouse_stud_view';


$route['uniform/substore-bill-cancel/bill-cancel'] = 'uniform_sub_store/Bill_controller/Bill_cancell';
$route['uniform/substore-voucher-cancel/voucher-cancel'] = 'uniform_sub_store/Bill_controller/voucher_cancel'; // 20-02-2018

$route['uniform/initial/show-chart'] = 'uniform_sub_store/Storesettings_controller/storechart';


$route['uniform_dashboard/show-dashboard'] = 'administration/Home_controller/show_uniform_dashboard';

/* * ******************************************************************************************************************
  ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Fees-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞
  /******************************************************************************************************************* */


//Fee Menu Block
$route['fees/block_view'] = 'fees/Fees_controller/show_fee_menu_block_view';
//Main Fee module
$route['fees/fee-management'] = 'fees/Fees_controller/fees_management';
//Account Code
$route['fees/create-accountcode'] = 'fees/Account_code_controller/show_account_code';
$route['fees/statuschange-accountcode'] = 'fees/Account_code_controller/change_status_of_account_code';
$route['fees/edit-accountcode'] = 'fees/Account_code_controller/edit_account_code';
$route['fees/save-edit-accountcode'] = 'fees/Account_code_controller/save_edit_account_code';
$route['fees/add-accountcode'] = 'fees/Account_code_controller/add_account_code';
$route['fees/addsave-accountcode'] = 'fees/Account_code_controller/save_new_account_code';

//Fee type
$route['fees/show-feetype'] = 'fees/Fee_type_controller/show_fee_type';
$route['fees/add-feetype'] = 'fees/Fee_type_controller/add_fee_type';
$route['fees/save-new-feetype'] = 'fees/Fee_type_controller/save_new_fee_type';
$route['fees/edit-feetype'] = 'fees/Fee_type_controller/edit_fee_type';
$route['fees/save-edit-feetype'] = 'fees/Fee_type_controller/save_edit_fee_type';
$route['fees/statuschange-feetype'] = 'fees/Fee_type_controller/change_status_of_fee_type';

//Demand frequency
$route['fees/show-demandfrequency'] = 'fees/Demandfrequency_controller/show_fee_demand_frequency';
$route['fees/add-feedemandfrequency'] = 'fees/Demandfrequency_controller/add_fee_demand_frequency';
$route['fees/save-new-feedemandfrequency'] = 'fees/Demandfrequency_controller/save_new_demand_frequency';
$route['fees/edit-feedemandfrequency'] = 'fees/Demandfrequency_controller/edit_fee_demand_frequency';
$route['fees/save-edit-feedemandfrequency'] = 'fees/Demandfrequency_controller/save_edit_demand_frequency';
$route['fees/statuschange-feedemandfrequency'] = 'fees/Demandfrequency_controller/change_status_of_fee_demand_frequency';

//Fee Codes
$route['fees/show-feescode']          = 'fees/Fee_code_controller/show_fees_code';
$route['fees/add-feescode']           = 'fees/Fee_code_controller/add_fee_code';
$route['fees/edit-feescode']          = 'fees/Fee_code_controller/edit_fee_code';
$route['fees/statuschange-feecode']   = 'fees/Fee_code_controller/change_status_of_fee_code';
$route['fees/save-new-feescode']      = 'fees/Fee_code_controller/save_new_fee_code';
$route['fees/save-edit-feescode']     = 'fees/Fee_code_controller/save_edit_fee_code';
$route['fees/frequency_change']       = 'fees/Fee_code_controller/frequency_change';

//Penalty Settings
$route['fees/show_penalty']           = 'fees/Fee_penalty_controller/show_penalty';
$route['fees/add_penalty']            = 'fees/Fee_penalty_controller/add_penalty';
$route['fees/edit_penalty']            = 'fees/Fee_penalty_controller/edit_penalty';
$route['fees/change_penalty_status']  = 'fees/Fee_penalty_controller/change_penalty_status';
$route['fees/save_penalty']           = 'fees/Fee_penalty_controller/save_penalty';
$route['fees/update_penalty']         = 'fees/Fee_penalty_controller/update_penalty';

//Fee Template
$route['fees/show-fees-template'] = 'fees/Feetemplate_controller/show_fee_templates';
$route['fees/add-fees-template'] = 'fees/Feetemplate_controller/create_fee_template';
$route['fees/save-new-fees-template'] = 'fees/Feetemplate_controller/save_new_template';
$route['fees/edit-fees-template'] = 'fees/Feetemplate_controller/get_edit_fee_template';
$route['fees/save-edit-fees-template'] = 'fees/Feetemplate_controller/save_edit_fee_template';
$route['fees/delete-fees-template'] = 'fees/Feetemplate_controller/delete_fee_template';
$route['fees/show-template-fees-code-list'] = 'fees/Fee_structure_controller/show_templates_to_link_fees_code';
$route['fees/search_template_fee_code'] = 'fees/Fee_structure_controller/search_template_fee_code';
$route['fees/link-fees-code'] = 'fees/Fee_structure_controller/link_fee_code';
$route['fees/save-link-fees-code'] = 'fees/Fee_structure_controller/save_linked_fee_code';
$route['fees/view-linked-fees-code'] = 'fees/Fee_structure_controller/view_linked_fee_code';
$route['fees/show-template-fees-code-list-for-student-link'] = 'fees/Fee_structure_controller/show_templates_to_link_students';
$route['fees/search-show-template-fees-code-list-for-student-link'] = 'fees/Fee_structure_controller/search_show_templates_to_link_students';
$route['fees/show-student-filter-for-fee-allocation'] = 'fees/Fee_structure_controller/show_student_filter_for_fee_allocation';
$route['fees/search-student-for-fee-allocation'] = 'fees/Fee_structure_controller/get_student_for_fee_allocation';
$route['fees/modify-batch-for-filter-data'] = 'fees/Fee_structure_controller/get_batch_data_for_fee_template';
$route['fees/save-template-with-student'] = 'fees/Fee_structure_controller/allocate_fees_for_student_from_template';
$route['fees/fees-student-allotment'] = 'fees/Fee_structure_controller/fee_student_allotment_list';
$route['fees/fees-student-allotment-search'] = 'fees/Fee_structure_controller/search_fee_student_allotment_list';
$route['fees/fees-student-allotment-list'] = 'fees/Fee_structure_controller/student_listing_for_template_allocated';
$route['fees/view-linked-fees-code-student-list'] = 'fees/Fee_structure_controller/view_linked_fee_code_for_student_list';
$route['fees/fees-student-deallocation-load-template'] = 'fees/Fee_structure_controller/fee_student_deallocation_show_template';
$route['fees/fees-student-deallocation-load-template-search'] = 'fees/Fee_structure_controller/search_fee_student_deallocation_show_template';
$route['fees/view-students-to-detach'] = 'fees/Fee_structure_controller/deallocation_student_listing_for_template_allocated';
$route['fees/view-feecode-forstudents-to-detach'] = 'fees/Fee_structure_controller/view_linked_fee_code_for_student_deallocation';
$route['fees/save-students-to-detach'] = 'fees/Fee_structure_controller/de_allocate_students_from_fee_template';

//Non Periodic Fee 
$route['fees/show-nonperiodicfee-student-filter'] = 'fees/Nondemandfee_controller/student_filter';
$route['fees/search-studentname-for-non-demand'] = 'fees/Nondemandfee_controller/search_byname';
$route['fees/advancesearch-studentname-for-non-demand'] = 'fees/Nondemandfee_controller/advancesearch_byname';
$route['fees/get-batchdetails-for-non-demand'] = 'fees/Nondemandfee_controller/batchlist';
$route['fees/show-nonperiodicfee-details'] = 'fees/Nondemandfee_controller/show_nonperiodicfee_details';
$route['fees/save-other-fee-allocation'] = 'fees/Nondemandfee_controller/save_other_fee_allocation';

$route['fees/show-periodicfee-details'] = 'fees/Nondemandfee_controller/show_periodicfee_details';
$route['fees/save-periodic-fee-allocation'] = 'fees/Nondemandfee_controller/save_periodic_fee_allocation';

//Fee Deallocation
$route['fees/load_fee_deallocation'] = 'fees/Fee_deallocation_controller/load_fee_deallocation';
$route['fees/get_fees_demnaded_for_student'] = 'fees/Fee_deallocation_controller/get_fees_demnaded_for_student';
$route['fees/deallocate_fee_of_student'] = 'fees/Fee_deallocation_controller/deallocate_fee_of_student';

//Fee Student Collection
$route['fees/show-fees-student-collection'] = 'fees/Fees_collection_controller/get_student_filter_for_collection';
$route['fees/search-studentname-for-collection'] = 'fees/Fees_collection_controller/search_byname';
$route['fees/advancesearch-studentname-for-collection'] = 'fees/Fees_collection_controller/advancesearch_byname';
$route['fees/get-batchdetails-for-collection'] = 'fees/Fees_collection_controller/batchlist';
$route['fees/show-fee-collection'] = 'fees/Fees_collection_controller/show_fee_student_collection';
$route['fees/pay-fee-by-cash'] = 'fees/Fees_collection_controller/save_cash_payment_for_fee';
$route['fees/pay-fee-by-cheque'] = 'fees/Fees_collection_controller/save_cheque_payment_for_fee';
$route['fees/pay_fee_by_dbt'] = 'fees/Fees_collection_controller/save_dbt_payment_for_fee';
$route['fees/pay-fee-by-card'] = 'fees/Fees_collection_controller/save_card_payment_for_fee';
$route['fees/pay-fee-by-wallet'] = 'fees/Fees_collection_controller/save_wallet_payment_for_fee';
$route['fees/show-cheque-reconciliation'] = 'fees/Fees_collection_controller/show_cheque_reconciliation';
$route['fees/search-cheque-show-reconcile'] = 'fees/Fees_collection_controller/search_cheque_reconciliation';
$route['fees/reconcile-cheque'] = 'fees/Fees_collection_controller/cheque_reconcile';
$route['fees/bounce-cheque'] = 'fees/Fees_collection_controller/cheque_bounce';
$route['fees/cancel-cheque'] = 'fees/Fees_collection_controller/cheque_cancel';
$route['fees/show-blacklisted-students'] = 'fees/Fees_collection_controller/black_listed_students_list';
$route['fees/release-blacklisted-student'] = 'fees/Fees_collection_controller/release_blacklist_students';

$route['fees/onetimecol/show-fees-student-collection'] = 'fees/Fees_collection_controller/get_student_filter_for_collection_one_time';
$route['fees/onetimecol/get-batchdetails-for-collection'] = 'fees/Fees_collection_controller/batchlist_one_time_pay';
$route['fees/onetimecol/advancesearch-studentname-for-collection'] = 'fees/Fees_collection_controller/advancesearch_byname_for_one_time';
$route['fees/onetimecol/save-payment-by-wallet-for-students'] = 'fees/Fees_collection_controller/save_one_time_payment_by_wallet';

//Mock Payment for failed in Online
$route['fees/show_collection_failed_payment'] = 'fees/Fees_collection_controller/show_collection_failed_payment';
$route['fees/make_failed_payment'] = 'fees/Fees_collection_controller/make_failed_payment';

//Prospectus Fee
$route['fees/registration_fee'] = 'fees/Fees_collection_controller/registration_fee';
$route['fees/pay_registration_fee'] = 'fees/Fees_collection_controller/pay_registration_fee';

//Temp Registration Fee
$route['fees/temp_registration_fee'] = 'fees/Fees_collection_controller/temp_registration_fee';
$route['fees/get_temp_payment_status'] = 'fees/Fees_collection_controller/get_temp_payment_status';
$route['fees/temp_reg_fee_payment_methods'] = 'fees/Fees_collection_controller/temp_reg_fee_payment_methods';
$route['fees/pay_temp_registration_fee'] = 'fees/Fees_collection_controller/pay_temp_registration_fee';

//Docme Wallet
$route['fees/show-wallet-student-collection'] = 'fees/Fees_collection_controller/get_student_filter_for_wallet';
$route['fees/search-studentname-for-wallet'] = 'fees/Fees_collection_controller/search_byname_wallet';
$route['fees/advancesearch-studentname-for-wallet'] = 'fees/Fees_collection_controller/advancesearch_byname_wallet';
$route['fees/get-batchdetails-for-wallet'] = 'fees/Fees_collection_controller/batchlist_wallet';
$route['fees/show-wallet-collection'] = 'fees/Fees_collection_controller/show_fee_student_wallet';

$route['fees/pay-wallet-by-cash'] = 'fees/Fees_collection_controller/save_cash_payment_for_wallet';
$route['fees/pay-wallet-by-cheque'] = 'fees/Fees_collection_controller/save_cheque_payment_for_wallet';
$route['fees/pay-wallet-by-card'] = 'fees/Fees_collection_controller/save_card_payment_for_wallet';
$route['fees/pay-wallet-by-dbt'] = 'fees/Fees_collection_controller/save_dbt_payment_for_wallet';

$route['fees/show-wallet-collection-to-withdraw'] = 'fees/Fees_collection_controller/show_fee_student_wallet_to_withdraw_request';
$route['fees/create-new-request-to-withdraw'] = 'fees/Fees_collection_controller/request_to_withdraw_from_wallet';
$route['fees/save-withdraw-request'] = 'fees/Fees_collection_controller/save_wallet_withdraw_request';
$route['fees/show-approve-withdraw-request'] = 'fees/Fees_collection_controller/show_approve_wallet_withdraw';
$route['fees/save-approve-withdraw-request'] = 'fees/Fees_collection_controller/save_approve_withdraw_request';
$route['fees/show-encashment-for-withdraw'] = 'fees/Fees_collection_controller/show_encashment_withdraw_request';
$route['fees/save-encashment-for-withdraw-with-cash'] = 'fees/Fees_collection_controller/save_encashment_withdraw_wallet_by_cash';
$route['fees/save-encashment-for-withdraw-with-cheque'] = 'fees/Fees_collection_controller/save_encashment_withdraw_wallet_by_cheque';
$route['fees/view-withdraw-request'] = 'fees/Fees_collection_controller/view_wallet_withdraw_request';

//Student Account
$route['account/show-filter-student-account'] = 'fees/Student_account_controller/get_student_filter_for_account';
$route['account/search-studentname-for-account'] = 'fees/Student_account_controller/search_byname_for_account';
$route['account/advancesearch-studentname-for-account'] = 'fees/Student_account_controller/advancesearch_byname_for_account';
$route['account/get-batchdetails-for-account'] = 'fees/Student_account_controller/batchlist_for_account';
$route['account/show-account'] = 'fees/Student_account_controller/show_account_details_of_student';


//Payback
$route['payback/show-payback-list'] = 'fees/Payback_controller/show_payback_list';
$route['payback/show-filter-student-payback'] = 'fees/Payback_controller/get_student_filter_for_payback';
$route['payback/search-studentname-for-payback'] = 'fees/Payback_controller/search_byname_for_payback';
$route['payback/advancesearch-studentname-for-payback'] = 'fees/Payback_controller/advancesearch_byname_for_payback';
$route['payback/get-batchdetails-for-payback'] = 'fees/Payback_controller/batchlist_for_payback';
$route['payback/show-add-new-payback-request'] = 'fees/Payback_controller/show_add_new_payback_request';
$route['payback/get-fee-data-for-voucher'] = 'fees/Payback_controller/get_fee_data_for_voucher_for_payback';
$route['payback/save-payback-request'] = 'fees/Payback_controller/save_payback_request';
$route['payback/show-payback-approval'] = 'fees/Payback_controller/show_payback_approval';
$route['payback/save-payback-approval'] = 'fees/Payback_controller/save_payback_approval';
$route['payback/view-payback'] = 'fees/Payback_controller/view_payback_data';


//Counter Collection
$route['fees/show-counter-collection'] = 'fees/Fees_collection_controller/show_counter_collection';

//Priority - Concession
$route['fees/fees-priority'] = 'fees/Priority_controller/show_priority';
$route['fees/manage-priority'] = 'fees/Priority_controller/manage_priority';
$route['fees/save-manage-priority'] = 'fees/Priority_controller/save_manage_priority';
$route['fees/fees-concession-preload'] = 'fees/Priority_controller/show_students_for_fee_concession_application_preload';
$route['fees/student_priority_concession'] = 'fees/Priority_controller/student_priority_concession';
$route['fees/get_priority_students'] = 'fees/Priority_controller/get_priority_students';

$route['fees/apply_student_concession'] = 'fees/Priority_controller/apply_student_concession';

$route['fees/staff-priority-list'] = 'fees/Priority_controller/show_staff_priority';
$route['fees/manage-staff-priority'] = 'fees/Priority_controller/manage_staff_priority';
$route['fees/save-manage-staff-priority'] = 'fees/Priority_controller/save_manage_staff_priority';
//$route['fees/staff-priority'] = 'fees/Staff_priority_controller/staff_priority';

//Arrear marking for students
$route['fees/fees-arrear-preload'] = 'fees/Arrear_controller/get_base_arrear_page_listing';
$route['fees/list_students_with_arrears'] = 'fees/Arrear_controller/get_student_data_for_arrear';
$route['fees/save_todays_arrear_summary'] = 'fees/Arrear_controller/save_todays_arrear_summary'; //save_arrear_for_student';

//ARREAR SAVE VIA URL
$route['arrear-summary/save'] = 'fees/Arrear_cron_controller/save_arrear_for_institutions';
$route['arrear-summary/save/(:any)'] = 'fees/Arrear_cron_controller/save_arrear_for_institution/$1';


//Voucher cancel
$route['fees/show-student-filter-voucher-cancel'] = 'fees/Fees_collection_controller/get_student_filter_for_voucher_cancel';
$route['fees/search-studentname-for-voucher-cancel'] = 'fees/Fees_collection_controller/search_byname_voucher_cancel';
$route['fees/advancesearch-studentname-for-voucher-cancel'] = 'fees/Fees_collection_controller/advancesearch_byname_voucher_cancel';
$route['fees/get-batchdetails-for-voucher-cancel'] = 'fees/Fees_collection_controller/batchlist_voucher_cancel';
$route['fees/show-fee-voucher-cancel'] = 'fees/Fees_collection_controller/show_fee_student_voucher_cancel';
$route['fees/show-fee-voucher-details-for-cancel'] = 'fees/Fees_collection_controller/get_voucher_details';
$route['fees/save-cancel-voucher'] = 'fees/Fees_collection_controller/save_voucher_cancel';




$route['fees/show-nondemand-fees-template'] = 'fees/Nondemandfee_controller/show_fee_templates';
$route['fees/link-nondemandfees-code'] = 'fees/Nondemandfee_controller/link_fee_code';
$route['fees/nondemandfees_structure'] = 'fees/Nondemandfee_controller/create_fee_structure';
$route['fees/show-nondemandfee-structure-template'] = 'fees/Nondemandfee_controller/edit_fee_template';
$route['fees/add-new-template'] = 'fees/Nondemandfee_controller/add_fee_template';

//FEE Exemption
$route['fees/show_fees_student_exemption'] = 'fees/Fees_collection_controller/show_fees_student_exemption';
$route['fees/student_exemption'] = 'fees/Fees_collection_controller/student_exemption';
$route['fees/save_exemption_for_approval'] = 'fees/Fees_collection_controller/save_exemption_for_approval';
$route['fees/show_exemption_approvals'] = 'fees/Fees_collection_controller/show_exemption_approvals';
$route['fees/view_exemption_details'] = 'fees/Fees_collection_controller/view_exemption_details';
$route['fees/approve_exemption'] = 'fees/Fees_collection_controller/approve_exemption';
$route['fees/reject_exemption'] = 'fees/Fees_collection_controller/reject_exemption';

$route['fees/show-fees-staff-collection'] = 'fees/Fees_staff_controller/show_fee_staff';
$route['fees/show-fees-student-concession'] = 'fees/Fee_concession_controller/show_fee_student_concession';
$route['fees/show-fees-student-scholarships'] = 'fees/Fee_scholarships_controller/student_filterscholarships';
$route['fees/view-fees-student-scholarships'] = 'fees/Fee_scholarships_controller/show_fee_student_scholarships';
$route['fees/view-fees-student-list-scholarships'] = 'fees/Fee_scholarships_controller/student_filter_list_scholarships';
$route['fees/student-filter-student-scholarships'] = 'fees/Fee_scholarships_controller/student_filter_scholarships';
$route['fees/collect-fees-student-scholarships'] = 'fees/Fee_scholarships_controller/collect_fee_student_scholarships';

//Voucher Reprint
$route['fees/show_voucher_reprint'] = 'fees/Fees_collection_controller/show_voucher_reprint';
$route['fees/search_studentname_for_voucher_reprint'] = 'fees/Fees_collection_controller/search_studentname_for_voucher_reprint';
$route['fees/show_fee_voucher_for_reprint'] = 'fees/Fees_collection_controller/show_fee_voucher_for_reprint';
$route['fees/advancesearch_studentname_for_voucher_reprint'] = 'fees/Fees_collection_controller/advancesearch_studentname_for_voucher_reprint';
$route['fees/show_fee_voucher_details_for_reprint'] = 'fees/Fees_collection_controller/show_fee_voucher_details_for_reprint';
$route['fees/print_voucher_reprint'] = 'fees/Fees_collection_controller/print_voucher_reprint';
$route['fees/search_voucher_number'] = 'fees/Fees_collection_controller/search_voucher_number';

/*
 *
 * 
 * DOCME FEE MODULE REPORTS
 * 
 * 
 * 
 */


$route['fees/show-reports-data'] = 'fees/Reports_fee_controller/show_fee_report_settings';

//DAILY COLLECTION REPORT
$route['fees/preload/show-daily-collection'] = 'fees/Reports_fee_controller/show_daily_collection_preload';
$route['fees/report/get-daily-collection-voucher-wise'] = 'fees/Reports_fee_controller/get_daily_collection_voucher_wise_report';


//REG.FEE COLLECTION REPORT
$route['fees/preload/show-regfee-collection'] = 'fees/Reports_fee_controller/show_regfee_collection_preload';
$route['fees/report/get_regfee_collection_report'] = 'fees/Reports_fee_controller/get_regfee_collection_report';

$route['fees/preload/show_base_fee_educore_details'] = 'fees/Reports_fee_controller/show_base_fee_educore_preload';
$route['fees/report/get_base_fee_educore_report'] = 'fees/Reports_fee_controller/get_base_fee_educore_report';

//NON DEMANDABLE RECEIVED REPORT
$route['fees/preload/show-non-demandables-received'] = 'fees/Reports_fee_controller/show_non_demandables_received';
$route['fees/report/get-received-non-demandables'] = 'fees/Reports_fee_controller/get_received_non_demandables_report';

//INDIVIDUAL COLLECTION REPORT
$route['fees/preload/show-individual-collection'] = 'fees/Reports_fee_controller/show_individual_collection_report';
$route['fees/report/search-studentname-individual-collection'] = 'fees/Reports_fee_controller/search_byname_individual_collection';
$route['fees/report/advancesearch-studentname-individual-collection'] = 'fees/Reports_fee_controller/advancesearch_byname_individual_collection';
$route['fees/report/get-batchdetails-individual-collection'] = 'fees/Reports_fee_controller/batchlist_individual_collection';
$route['fees/report/get-individual-collection-report'] = 'fees/Reports_fee_controller/get_individual_collection_report';

//CLASS WISE COLLECTION SUMMARY REPORT
$route['fees/preload/show-collection-class-wise-summary'] = 'fees/Reports_fee_controller/show_collection_class_wise_summary';
$route['fees/report/get-collection-class-wise-summary'] = 'fees/Reports_fee_controller/get_collection_class_wise_summary';

//CLASS WISE COLLECTION DETAIL REPORT
$route['fees/preload/show-collection-class-wise-details'] = 'fees/Reports_fee_controller/show_collection_class_wise_details';
$route['fees/report/get-collection-class-wise-details'] = 'fees/Reports_fee_controller/get_collection_class_wise_details';

//USER COLLECTION REPORT
$route['fees/preload/show-user-collection-details'] = 'fees/Reports_fee_controller/show_user_collection_details';
$route['fees/report/get-user-collection-details'] = 'fees/Reports_fee_controller/get_user_collection_details';

//CHEQUE RECEIVED LEDGER REPORT
$route['fees/preload/show-cheque-received-ledger'] = 'fees/Reports_fee_controller/show_cheque_received_ledger';
$route['fees/report/get-cheque-received-ledger'] = 'fees/Reports_fee_controller/get_cheque_received_ledger';

//WALLET - DEPOSIT REPORT
$route['fees/preload/show-wallet-deposit-details'] = 'fees/Reports_fee_controller/show_wallet_deposit_details';
$route['fees/report/get-wallet-deposit-details'] = 'fees/Reports_fee_controller/get_wallet_deposit_details';

//WALLET - WITHDRAW REPORT
$route['fees/preload/show-wallet-withdraw-details'] = 'fees/Reports_fee_controller/show_wallet_withdraw_details';
$route['fees/report/get-wallet-withdraw-details'] = 'fees/Reports_fee_controller/get_wallet_withdraw_details';

//WALLET STATEMENT REPORT
$route['fees/preload/show-wallet-statement-details'] = 'fees/Reports_fee_controller/show_wallet_statement_details';
$route['fees/report/get-wallet-statement-details'] = 'fees/Reports_fee_controller/get_wallet_statement_details';

//ARREAR LIST
$route['fees/preload/show-report-preload-arrears-list'] = 'fees/Reports_fee_controller/show_report_preload_arrear_list_batch_wise';
$route['fees/preload/get-batchdetails-for-arrear-report'] = 'fees/Reports_fee_controller/batchlist_arrear_list_batch_wise';
$route['fees/report/get-report-for-arrear-list-with-batch'] = 'fees/Reports_fee_controller/get_report_for_arrear_with_batch';

//LONG ABSENTEES ARREAR
$route['fees/preload/show-report-preload-arrears-longab-list'] = 'fees/Reports_fee_controller/show_report_preload_arrear_list_long_ab_batch_wise';
$route['fees/preload/get-batchdetails-for-arrear-longab-report'] = 'fees/Reports_fee_controller/batchlist_arrear_list_long_ab_batch_wise';
$route['fees/report/get-report-for-arrear-list-longab-with-batch'] = 'fees/Reports_fee_controller/get_report_for_arrear_longab_with_batch';

//ARREAR SUMMARY
$route['fees/preload/show_arrear_summary'] = 'fees/Reports_fee_controller/show_arrear_summary';
$route['fees/report/get_arrear_summary'] = 'fees/Reports_fee_controller/get_arrear_summary';

//HEAD WISE ARREAR SUMMARY
$route['fees/preload/show_head_wise_arrear'] = 'fees/Reports_fee_controller/show_head_wise_arrear';
$route['fees/report/get_head_wise_arrear'] = 'fees/Reports_fee_controller/get_head_wise_arrear';

//INDIVIDUAL DCB
$route['fees/preload/show-individual-dcb'] = 'fees/Reports_fee_controller/show_individual_dcb_report';
$route['fees/report/search-studentname-individual-dcb'] = 'fees/Reports_fee_controller/search_byname_individual_dcb';
$route['fees/report/advancesearch-studentname-individual-dcb'] = 'fees/Reports_fee_controller/advancesearch_byname_individual_dcb';
$route['fees/report/get-batchdetails-individual-dcb'] = 'fees/Reports_fee_controller/batchlist_individual_dcb';
$route['fees/report/get-individual-dcb-report'] = 'fees/Reports_fee_controller/get_individual_dcb_report';

//HEAD WISE COLLECTION
$route['fees/preload/show-headwise-collection-details'] = 'fees/Reports_fee_controller/show_preload_headwise_collection_report';
$route['fees/report/get-headwise-collection-details'] = 'fees/Reports_fee_controller/get_headwise_collection_details';

//SUMMARY COLLECTION
$route['fees/preload/show-summary-collection-report'] = 'fees/Reports_fee_controller/show_preload_summary_collection_report';
$route['fees/report/get-summary-collection-report'] = 'fees/Reports_fee_controller/get_summary_collection_report_details';

//BATCH - DCB REPORT
$route['fees/preload/show-dcb-classwise-summary-report'] = 'fees/Reports_fee_controller/show_preload_dcb_classwise_summary_report';
$route['fees/report/get-dcb-classwise-summary-report'] = 'fees/Reports_fee_controller/get_dcb_classwise_summary_report_details';

$route['fees/preload/show-online-pay-report'] = 'fees/Reports_fee_controller/show_online_pay_report_preloader';
$route['fees/report/get-online-pay-report'] = 'fees/Reports_fee_controller/get_online_pay_report';

//PAYBACK SUMMARY REPORT
$route['fees/preload/show-payback-summary-report'] = 'fees/Reports_fee_controller/show_payback_summary_preloaders';
$route['fees/report/get-payback-summary-report'] = 'fees/Reports_fee_controller/get_payback_summary_report';

//VAT Collection Report
$route['fees/preload/show_vat_collection_details'] = 'fees/Reports_fee_controller/show_vat_collection_details';
$route['fees/report/get_vat_collection_details'] = 'fees/Reports_fee_controller/get_vat_collection_details';

//Exemption Report
$route['fees/preload/show_exemption_details'] = 'fees/Reports_fee_controller/show_exemption_details';
$route['fees/report/get_exemption_details_report'] = 'fees/Reports_fee_controller/get_exemption_details_report';

//Concession Report
$route['fees/preload/show_concession_students'] = 'fees/Reports_fee_controller/show_concession_students';
$route['fees/report/get_concession_students_report'] = 'fees/Reports_fee_controller/get_concession_students_report';
$route['fees/preload/show_concession_details'] = 'fees/Reports_fee_controller/show_concession_details';
$route['fees/report/get_fee_concession_details'] = 'fees/Reports_fee_controller/get_fee_concession_details';

//Transport Due List
$route['fees/preload/load_transport_due_list'] = 'fees/Reports_fee_controller/show_transport_due_list';
$route['fees/report/get_transport_due_list'] = 'fees/Reports_fee_controller/get_transport_due_list';

//Fee Deallocated List
$route['fees/preload/load_fee_deallocated_list'] = 'fees/Reports_fee_controller/show_fee_deallocated_list';
$route['fees/report/get_fee_deallocated_list'] = 'fees/Reports_fee_controller/get_fee_deallocated_list';

//Voucher Cancellation Report
$route['fees/preload/voucher_cancellation_report'] = 'fees/Reports_fee_controller/show_voucher_cancellation_report';
$route['fees/report/get_voucher_cancellation_report'] = 'fees/Reports_fee_controller/get_voucher_cancellation_report';

/* * ******************************************************************************************************************
  ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞
  /******************************************************************************************************************* */
$route['transport/load-transport'] = 'transport/Transport_controller/transport_loading';
$route['transport/create-vehicletype'] = 'transport/Vehicletype_controller/show_vehicle_type';
$route['transport/add-vehicletype'] = 'transport/Vehicletype_controller/add_vehicle_type';
$route['transport/edit-vehicletype'] = 'transport/Vehicletype_controller/edit_vehicle_type';
$route['transport/addsave-vehicletype'] = 'transport/Vehicletype_controller/save_new_vehicle_type';
$route['transport/editsave-vehicletype'] = 'transport/Vehicletype_controller/save_edit_vehicle_type';
$route['transport/statuschange-vehicletype'] = 'transport/Vehicletype_controller/change_status_of_vehicle_type';
$route['transport/create-vehiclemake'] = 'transport/Vehiclemake_controller/show_vehicle_make';
$route['transport/add-new-make'] = 'transport/Vehiclemake_controller/add_vehicle_make';
$route['transport/add-save-new-make'] = 'transport/Vehiclemake_controller/save_new_vehicle_make';
$route['transport/edit-vehiclemake'] = 'transport/Vehiclemake_controller/edit_vehicle_make';
$route['transport/editsave-vehiclemake'] = 'transport/Vehiclemake_controller/save_edit_vehicle_make';
$route['transport/statuschange-vehiclemake'] = 'transport/Vehiclemake_controller/change_status_of_vehicle_make';
$route['transport/edit-vehicle-make'] = 'transport/Vehiclemake_controller/edit_make';

$route['transport/trip-show'] = 'transport/Trip_controller/show_trip';
$route['transport/create-new-trip'] = 'transport/Trip_controller/add_trip';
$route['transport/trip-edit'] = 'transport/Trip_controller/edit_trip';
$route['transport/save-trip-edit'] = 'transport/Trip_controller/save_edit_trip';
$route['transport/save-trip-details'] = 'transport/Trip_controller/trip_save';
$route['transport/changestatus-trip-details'] = 'transport/Trip_controller/change_status_trip';

$route['transport/load-trip-map-stops'] = 'transport/Trip_route_map_controller/show_trip_mapdetails';
$route['transport/tripsroutemap-show'] = 'transport/Trip_route_map_controller/show_trip';
$route['transport/load-route-map-page'] = 'transport/Trip_route_map_controller/show_routes';
$route['transport/route-points-trip-mapping'] = 'transport/Trip_route_map_controller/show_pickuppoints';
$route['transport/trip-Route-pickpoint-map-save'] = 'transport/Trip_route_map_controller/save_triproute_pickuppoints';

$route['transport/tripsvehiclemap-show'] = 'transport/Trip_vehicle_map_controller/show_trip';
$route['transport/load-vehicle-map-page'] = 'transport/Trip_vehicle_map_controller/show_vehicles';
$route['transport/trip-vehicle-mapping-add'] = 'transport/Trip_vehicle_map_controller/vehicle_linking_trip';
$route['transport/trip-vehicle-mapping-show'] = 'transport/Trip_vehicle_map_controller/vehicle_show_details';
//This route added by Elavarasan S @ 12-06-2019 2:00
$route['transport/load-trip-maplistdetails-page'] = 'transport/Trip_vehicle_map_controller/show_trip_details';
$route['transport/view-invoice-deatils'] = 'transport/Vehicle_servicebooking_controller/show_invoice_details';

$route['transport/show-vehicle-trip'] = 'transport/Vehicletrip_controller/show_vehicle_trip';
$route['transport/add-new-trip'] = 'transport/Vehicletrip_controller/add_trip';
$route['transport/addsave-trip'] = 'transport/Vehicletrip_controller/save_new_trip';
$route['transport/edit-trip'] = 'transport/Vehicletrip_controller/edit_trip';
$route['transport/editsave-trip'] = 'transport/Vehicletrip_controller/save_edit_trip';
$route['transport/statuschange-trip'] = 'transport/Vehicletrip_controller/change_status_of_trip';
$route['transport/show-vehicle-servicecenter'] = 'transport/Servicecenter_controller/show_vehicle_servicecenters';
$route['transport/show-vehicle-qrpage'] = 'transport/QrCode_controller/show_vehicle_qrcodepage';
$route['transport/vehicle-qrcode-generate'] = 'transport/QrCode_controller/generate_vehicle_qrcode';
$route['transport/add-servicecenter'] = 'transport/Servicecenter_controller/add_servicecenter';
$route['transport/addsave-servicecenter'] = 'transport/Servicecenter_controller/save_new_servicecenter';
$route['transport/servicecenter/change_status'] = 'transport/Servicecenter_controller/changestatus_servicecenter';
$route['transport/edit-servicecenter'] = 'transport/Servicecenter_controller/edit_servicecenter';
$route['transport/updatesave-servicecenter'] = 'transport/Servicecenter_controller/updatesave_servicecenter';

$route['transport/show-vehicle-servicetype'] = 'transport/Servicetype_controller/show_vehicle_servicetype';
$route['transport/add-servicetype'] = 'transport/Servicetype_controller/add_servicetype';
$route['transport/addsave-servicetype'] = 'transport/Servicetype_controller/save_new_servicetype';
$route['transport/servicetype/change_status'] = 'transport/Servicetype_controller/changestatus_servicetype';
$route['transport/edit-servicetype'] = 'transport/Servicetype_controller/edit_servicetype';


$route['transport/show-vehicle-route'] = 'transport/Route_controller/show_vehicle_route';
$route['transport/add-route'] = 'transport/Route_controller/add_route';
$route['transport/addsave-route'] = 'transport/Route_controller/save_new_route';
$route['transport/edit-route'] = 'transport/Route_controller/edit_route';
$route['transport/editsave-route'] = 'transport/Route_controller/save_edit_route';
$route['transport/statuschange-route'] = 'transport/Route_controller/change_status_of_route';
$route['transport/show-vehicle-fueltype'] = 'transport/Fueltype_controller/show_fueltype';

$route['transport/show-vehicle-pickuppoint'] = 'transport/Pickuppoint_controller/show_pickuppoints';
$route['transport/add-pickuppoint'] = 'transport/Pickuppoint_controller/add_pickuppoint';
$route['transport/save-new-pickuppoint'] = 'transport/Pickuppoint_controller/save_new_pickuppoint';
$route['transport/edit-pickuppoint'] = 'transport/Pickuppoint_controller/edit_pickuppoint';
$route['transport/save-edit-pickuppoint'] = 'transport/Pickuppoint_controller/save_edit_pickuppoint';
$route['transport/statuschange-pickuppoint'] = 'transport/Pickuppoint_controller/change_status_of_pickuppoint';

/*--------------------------------------AHB Transport FEES START-------------------------------------------------------------------------------*/
$route['transport/show-pickupoint-fees'] = 'transport/Pickuppoint_fees_controller/show_pickupoint_fees';
$route['transport/update-pickuppoint-fees'] = 'transport/Pickuppoint_fees_controller/update_pickupoint_fees';
$route['transport/save-update-pickuppoint-fees'] = 'transport/Pickuppoint_fees_controller/save_update_pickuppoint_fees';
/*--------------------------------------AHB Transport FEES END-------------------------------------------------------------------------------*/


$route['transport/create-vehiclemodel'] = 'transport/Vehiclemodel_controller/show_vehicle_model';
$route['transport/add-new-model'] = 'transport/Vehiclemodel_controller/add_vehicle_model';
$route['transport/addsave-vehiclemodel'] = 'transport/Vehiclemodel_controller/save_new_vehicle_model';
$route['transport/edit-vehiclemodel'] = 'transport/Vehiclemodel_controller/edit_vehicle_model';
$route['transport/editsave-vehiclemodel'] = 'transport/Vehiclemodel_controller/save_edit_vehicle_model';
//$route['transport/edit-vehiclemodel'] = 'transport/Vehiclemodel_controller/edit_vehicle_model';
$route['transport/statuschange-vehiclemodel'] = 'transport/Vehiclemodel_controller/change_status_of_vehicle_model';
$route['transport/statuschange-vehiclemodel_yr'] = 'transport/Modeldate_controller/change_status_of_vehicle_modelyr';
$route['transport/edit-vehiclemodelyear'] = 'transport/Modeldate_controller/edit_vehicle_model_yr';
$route['transport/editsave-model-year'] = 'transport/Modeldate_controller/save_edit_model_year';

$route['transport/show-vehicle-modelyear'] = 'transport/Modeldate_controller/show_modelyr';
$route['transport/add-new-modelyr'] = 'transport/Modeldate_controller/add_vehicle_modelyr';
$route['transport/addsave-vehiclemodelyr'] = 'transport/Modeldate_controller/save_new_vehicle_modelyear';

$route['transport/create-vehicleinsurance'] = 'transport/Vehicleinsurance_controller/show_vehicle_insurance';
$route['transport/add-new-insurance'] = 'transport/Vehicleinsurance_controller/add_vehicle_insurance';
$route['transport/addsaves-insurance'] = 'transport/Vehicleinsurance_controller/save_new_insurance';
//$route['transport/addstransport/mapping-get-all-routeave-insurance'] = 'transport/Vehicleinsurance_controller/savse_new_insurance';
$route['transport/edit-insurance'] = 'transport/Vehicleinsurance_controller/edit_insurance';
$route['transport/editsave-insurance'] = 'transport/Vehicleinsurance_controller/save_edit_insurance';
$route['transport/statuschange-insurance'] = 'transport/Vehicleinsurance_controller/change_status_of_insurance';
$route['transport/create-new-vehicle-registration'] = 'transport/Vehicle_registration_controller/new_vehicleregistration';
$route['transport/show-new-vehicle-registration'] = 'transport/Vehicle_registration_controller/show_vehicleregistration';
$route['transport/vehiclereg/change_status'] = 'transport/Vehicle_registration_controller/update_status';
$route['transport/update-vehicleregistration-details'] = 'transport/Vehicle_registration_controller/save_update_vehicle_registration';
$route['transport/vehicle-reg-edit'] = 'transport/Vehicle_registration_controller/edit_vehicle_registration';
$route['transport/allotment_for_student'] = 'transport/Student_transport_allotment/student_transport_allot';

//$route['transport/create-new-vehicle-registration'] = 'transport/Vehicle_registration_controller/new_vehicleregistration';
$route['transport/save-vehicleregistration-details'] = 'transport/Vehicle_registration_controller/save_vehicleregistration';

$route['transport/create-new-vehicle-incidents'] = 'transport/Vehicle_Incidents_controller/new_vehicleincidents';
$route['transport/save-vehicleincident-details'] = 'transport/Vehicle_Incidents_controller/savenew_vehicleincidents';
$route['transport/show-new-vehicle-incidents'] = 'transport/Vehicle_Incidents_controller/show_vehicleincidents';
$route['transport/get_pickupointlist_list'] = 'transport/Vehicle_Incidents_controller/get_trip_pickuppoints';


$route['transport/show-vehicle-servicebooking'] = 'transport/Vehicle_servicebooking_controller/show_all_vehicles';
$route['transport/show-vehicle-servicebooking-history'] = 'transport/Vehicle_servicebooking_controller/show_vehicle_service_booking';
$route['transport/load-serviceadd-page'] = 'transport/Vehicle_servicebooking_controller/show_service_vehicle_data';
$route['transport/show-new-vehicle-servicebooking'] = 'transport/Vehicle_servicebooking_controller/show_vehicle_service_booking';
$route['transport/create-new-vehicle-servicebooking'] = 'transport/Vehicle_servicebooking_controller/new_vehicle_service_booking';
$route['transport/save-servicebooking-details'] = 'transport/Vehicle_servicebooking_controller/savenew_servicebooking';
$route['transport/show-vehicle-service-invoice'] = 'transport/Vehicle_servicebooking_controller/show_vehicles';
$route['transport/create-new-service-invoice'] = 'transport/Vehicle_servicebooking_controller/newinvoice_delivery';
$route['transport/load-service-invoice-vehicle-particular'] = 'transport/Vehicle_servicebooking_controller/show_invoice';
$route['transport/create-new-vehicle-invoice-delivery'] = 'transport/Vehicle_servicebooking_controller/newinvoice_delivery';
$route['transport/save-vehicle-service-invoice'] = 'transport/Vehicle_servicebooking_controller/savevehicle_service_invoice';
$route['transport/save-serviceinvoice-details'] = 'transport/Vehicle_servicebooking_controller/savevehicle_service_invoice';
$route['transport/show-allvehicle-invoice'] = 'transport/Vehicle_servicebooking_controller/show_all_vehicles_invoice';
$route['transport/load-vehicle-invoice-history'] = 'transport/Vehicle_servicebooking_controller/show_vehicle_invoice_history';
$route['transport/show-allvehicle-service'] = 'transport/Vehicle_servicebooking_controller/show_all_vehicles_service';
$route['transport/load-vehicle-service-history'] = 'transport/Vehicle_servicebooking_controller/show_vehicle_service_history';

$route['transport/mapping-pickuppoint-route'] = 'transport/Pickuppoint_route_mapping_controller/show_route_pickuppoints';
$route['transport/mapping-get-pickuppoint-route'] = 'transport/Pickuppoint_route_mapping_controller/get_all_pickuppoints';
$route['transport/mapping-get-all-route'] = 'transport/Pickuppoint_route_mapping_controller/get_route_map';
$route['transport/pickpoint-route-map-save'] = 'transport/Pickuppoint_route_mapping_controller/save_route_pickuppoint_map';

$route['transport/mapping-route-trip'] = 'transport/Route_trip_map_controller/show_route_trip';
$route['transport/load-trip-map-page'] = 'transport/Route_trip_map_controller/load_particular_route_trip_map';
$route['transport/route-trip-mapping'] = 'transport/Route_trip_map_controller/save_particular_route_trip_map';
$route['rtansport/load-trip-maplistdetails-page'] = 'transport/Route_trip_map_controller/show_trip_map';
$route['transport/load-trip-pickuptimelistdetails-page'] = 'transport/Route_trip_map_controller/show_trip_pickuptime';

$route['transport/mapping-roundtrip'] = 'transport/Roundtrip_mapping/load_allotment';
$route['transport/mapping-trip-round'] = 'transport/Roundtrip_mapping/load_trip';

$route['transport/mapping-bus-trip'] = 'transport/Bus_trip_map_controller/show_bus_trip';
$route['transport/load-bus-trip-map-page'] = 'transport/Bus_trip_map_controller/show_trip';
$route['transport/transport_bus_triplink'] = 'transport/Bus_trip_map_controller/save_bus_trip_mapping';
$route['transport/allotment-student'] = 'transport/Student_transport_allotment_controller/load_allotment';


$route['transport/passenger-student'] = 'transport/Passenger_student_controller/load_starter';
/*--------------------------------------AHB 09-07-2019 START-------------------------------------------------------------------------------*/
$route['transport/show-student-filter'] = 'transport/Passenger_student_controller/show_student_filter';
$route['transport/show-student-allocation-list'] = 'transport/Passenger_student_controller/show_student_allocation_list';
$route['transport/search-student-for-trip-allotment'] = 'transport/Passenger_student_controller/search_student_admission';
$route['transport/advancesearch-student-for-trip-allotment'] = 'transport/Passenger_student_controller/advance_search_student';
$route['transport/show-student-transport-details'] = 'transport/Passenger_student_controller/show_student_transport_details';
$route['transport/get-pickpoint-trips'] = 'transport/Passenger_student_controller/get_pickpoint_trips';
$route['transport/save-trip-allotment'] = 'transport/Passenger_student_controller/save_trip_allotment';
/*--------------------------------------AHB 09-07-2019 END-------------------------------------------------------------------------------*/

$route['transport/route-points-student-allotment'] = 'transport/Passenger_student_controller/show_points';
$route['transport/passenger-allotment-tripdata'] = 'transport/Passenger_student_controller/show_trips';
$route['transport/passenger-student-allotment-filter'] = 'transport/Passenger_student_controller/get_student_filter_for_collection';
$route['transport/passenger-search-studentname-for-allotment'] = 'transport/Passenger_student_controller/search_byname';
$route['transport/passenger-advanced-search-student-for-allotment'] = 'transport/Passenger_student_controller/advancesearch_byname';
$route['transport/passenger-batch-for-student-filter'] = 'transport/Passenger_student_controller/batchlist';
$route['transport/passenger-student-allotment-all-data'] = 'transport/Passenger_student_controller/allotment_all_data';
$route['transport/passenger-student-allotment-savz'] = 'transport/Passenger_student_controller/allotment_data_save';


$route['transport/show-allotment-route-student-picknly'] = 'transport/Passenger_stud_pickonly_controller/show_vehicle_route';
$route['transport/route-points-student-allotment-picknly'] = 'transport/Passenger_stud_pickonly_controller/show_points';
$route['transport/passenger-allotment-tripdata-picknly'] = 'transport/Passenger_stud_pickonly_controller/show_trips';
$route['transport/passenger-student-allotment-filter-picknly'] = 'transport/Passenger_stud_pickonly_controller/get_student_filter_for_collection';
$route['transport/passenger-search-studentname-for-allotment-picknly'] = 'transport/Passenger_stud_pickonly_controller/search_byname';
$route['transport/passenger-advanced-search-student-for-allotment-picknly'] = 'transport/Passenger_stud_pickonly_controller/advancesearch_byname';
$route['transport/passenger-batch-for-student-filter-student-for-allotment-picknly'] = 'transport/Passenger_stud_pickonly_controller/batchlist';
$route['transport/passenger-student-allotment-all-data-picknly'] = 'transport/Passenger_stud_pickonly_controller/allotment_all_data';
$route['transport/passenger-student-allotment-savz-picknly'] = 'transport/Passenger_stud_pickonly_controller/allotment_data_save';

$route['transport/show-alloted-student-pick-change-filter'] = 'transport/Passenger_stud_pickchange_controller/show_starter';
$route['transport/show-alloted-student-pick-change'] = 'transport/Passenger_stud_pickchange_controller/show_students';
$route['transport/showpickuppoints-student-allotment-pickchange'] = 'transport/Passenger_stud_pickchange_controller/show_pickuppoints';
$route['transport/passenger-student-pickchange-allotment'] = 'transport/Passenger_stud_pickchange_controller/allotment_data_save';

$route['transport/show-alloted-student-drop-change-filter'] = 'transport/Passenger_stud_dropchange_controller/show_starter';
$route['transport/show-alloted-student-drop-change'] = 'transport/Passenger_stud_dropchange_controller/show_students';
$route['transport/showdroppoints-student-allotment-dropchange'] = 'transport/Passenger_stud_dropchange_controller/show_droppoints';
$route['transport/passenger-student-dropchange-allotment'] = 'transport/Passenger_stud_dropchange_controller/allotment_data_save';

$route['transport/show-alloted-student-trip-change-filter'] = 'transport/Passenger_student_tripchange_controller/show_starter';
$route['transport/show-alloted-student-trip-change'] = 'transport/Passenger_student_tripchange_controller/show_students';
$route['showtrips-student-allotment-tripchange'] = 'transport/Passenger_student_tripchange_controller/show_trips';
$route['transport/passenger-student-tripchange-allotment'] = 'transport/Passenger_student_tripchange_controller/allotment_data_save';



$route['transport/show-alloted-student-deallocation-change-filter'] = 'transport/Passenger_stud_deallocation_controller/get_student_filter';
$route['transport/show-alloted-student-deallocation-data'] = 'transport/Passenger_stud_deallocation_controller/show_students';
$route['transport/show-alloted-student-deallocation-details'] = 'transport/Passenger_stud_deallocation_controller/show_student_transportdata';
$route['transport/passenger-student-dealloting-save'] = 'transport/Passenger_stud_deallocation_controller/save_deallotment';
$route['transport/passenger-student-dealloting-drop-save'] = 'transport/Passenger_stud_deallocation_controller/save_deallotment_drop';


$route['transport/show-alloted-stud-details'] = 'transport/Passenger_student_view_controller/get_student_filter';
$route['transport/show-alloted-student-view-data'] = 'transport/Passenger_student_view_controller/show_students';
$route['transport/show-alloted-student-view-details'] = 'transport/Passenger_student_view_controller/show_student_transportdata';




$route['transport/show-alloted-student-droptrip-change-filter'] = 'transport/Passenger_student_droptripchange_controller/show_starter';
$route['transport/show-alloted-student-droptrip-change'] = 'transport/Passenger_student_droptripchange_controller/show_students';
$route['showtrips-student-allotment-droptripchange'] = 'transport/Passenger_student_droptripchange_controller/show_trips';
$route['transport/passenger-student-droptripchange-allotment'] = 'transport/Passenger_student_droptripchange_controller/allotment_data_save';

$route['transport/show-alloted-student-sameroute-change-filter'] = 'transport/Passenger_student_sameroutechange_controller/show_starter';
$route['transport/show-alloted-student-tripsameroute-change'] = 'transport/Passenger_student_sameroutechange_controller/show_students';

$route['transport/show-alloted-student-diffroute-change-filter'] = 'transport/Passenger_student_diffroutechange_controller/show_starter';
$route['transport/show-alloted-student-diffsameroute-change'] = 'transport/Passenger_student_diffroutechange_controller/show_students';


$route['transport/show-allotment-route-student-dropnly'] = 'transport/Passenger_stud_droponly_controller/show_vehicle_route';
$route['transport/route-points-student-allotment-dropnly'] = 'transport/Passenger_stud_droponly_controller/show_points';
$route['transport/passenger-allotment-tripdata-dropnly'] = 'transport/Passenger_stud_droponly_controller/show_trips';
$route['transport/passenger-student-allotment-filter-dropnly'] = 'transport/Passenger_stud_droponly_controller/get_student_filter_for_collection';
$route['transport/passenger-search-studentname-for-allotment-dropnly'] = 'transport/Passenger_stud_droponly_controller/search_byname';
$route['transport/passenger-advanced-search-student-for-allotment-dropnly'] = 'transport/Passenger_stud_droponly_controller/advancesearch_byname';
$route['transport/passenger-batch-for-student-filter-student-for-allotment-dropnly'] = 'transport/Passenger_stud_droponly_controller/batchlist';
$route['transport/passenger-student-allotment-all-data-dropnly'] = 'transport/Passenger_stud_droponly_controller/allotment_all_data';
$route['transport/passenger-student-allotment-savz-dropnly'] = 'transport/Passenger_stud_droponly_controller/allotment_data_save';

$route['transport/show-passenger-student-info'] = 'transport/Passenger_students_detail_controller/load_starter';
$route['transport/passenger-search-as-studentz'] = 'transport/Passenger_students_detail_controller/search_byname';
$route['transport/passenger-advanced-search-as-student-for-allotment'] = 'transport/Passenger_students_detail_controller/advancesearch_byname';

//$route['transport/passenger-student-pickdrop'] = 'transport/Passenger_student_controller/load_starter';
$route['transport/show-allotment-route-student-pickdrop'] = 'transport/Passenger_student_pickdrop_controller/show_vehicle_route';
$route['transport/route-points-student-allotment-pick-drop'] = 'transport/Passenger_student_pickdrop_controller/show_points';
$route['transport/passenger-allotment-drop-route-data'] = 'transport/Passenger_student_pickdrop_controller/show_droppoint_routes';
$route['transport/droproute-data-student-allotment-diff-route'] = 'transport/Passenger_student_pickdrop_controller/show_droppoints';
$route['transport/passenger-allotment-diff-route-tripdata'] = 'transport/Passenger_student_pickdrop_controller/show_trips_pick';
$route['transport/passenger-student-allotment-picktripz'] = 'transport/Passenger_student_pickdrop_controller/show_trips_drop';
$route['transport/passenger-student-allotment-droptripz'] = 'transport/Passenger_student_pickdrop_controller/get_student_filter_for_collection';
$route['transport/passenger-search-studentname-for-allotment-diffroute'] = 'transport/Passenger_student_pickdrop_controller/search_byname';
$route['transport/passenger-advanced-search-student-for-allotment-diffroute'] = 'transport/Passenger_student_pickdrop_controller/advancesearch_byname';
$route['transport/passenger-batch-for-student-filter-student-for-allotment-diffroute'] = 'transport/Passenger_student_pickdrop_controller/batchlist';
$route['transport/passenger-student-allotment-all-data-diffroute'] = 'transport/Passenger_student_pickdrop_controller/allotment_all_data';
$route['transport/passenger-student-allotment-save-data-diffroute'] = 'transport/Passenger_student_pickdrop_controller/allotment_data_save';

$route['transport/passenger-employee'] = 'transport/Passenger_employee_controller/load_starter';
$route['transport/show-allotment-route-employee'] = 'transport/Passenger_employee_controller/show_vehicle_route';
$route['transport/route-points-employee-allotment'] = 'transport/Passenger_employee_controller/show_points';
$route['transport/passenger-emp-allotment-tripdata'] = 'transport/Passenger_employee_controller/show_trips';
$route['transport/passenger-employee-allotment-filter'] = 'transport/Passenger_employee_controller/employee_list';
$route['transport/passenger-employeez-allotment-all-data-pick-drop'] = 'transport/Passenger_employee_controller/allotment_all_data';
$route['transport/passenger-employeez-allotment-save'] = 'transport/Passenger_employee_controller/allotment_data_save';


$route['transport/show-allotment-route-employee-picknly'] = 'transport/Passenger_emp_pickonly_controller/show_vehicle_route';
$route['transport/route-points-employee-allotment-picknly'] = 'transport/Passenger_emp_pickonly_controller/show_points';
$route['transport/passenger-emp-allotment-tripdata-picknly'] = 'transport/Passenger_emp_pickonly_controller/show_trips';
$route['transport/passenger-employee-allotment-filter-picknly'] = 'transport/Passenger_emp_pickonly_controller/employee_list';
$route['transport/passenger-employeez-allotment-all-data-picknly'] = 'transport/Passenger_emp_pickonly_controller/allotment_all_data';
$route['transport/passenger-employeez-allotment-save-picknly'] = 'transport/Passenger_emp_pickonly_controller/allotment_data_save';

$route['transport/show-allotment-route-employee-dropnly'] = 'transport/Passenger_emp_droponly_controller/show_vehicle_route';
$route['transport/route-points-employee-allotment-dropnly'] = 'transport/Passenger_emp_droponly_controller/show_points';
$route['transport/passenger-emp-allotment-tripdata-dropnly'] = 'transport/Passenger_emp_droponly_controller/show_trips';
$route['transport/passenger-employee-allotment-filter-dropnly'] = 'transport/Passenger_emp_droponly_controller/employee_list';
$route['transport/passenger-employeez-allotment-all-data-dropnly'] = 'transport/Passenger_emp_droponly_controller/allotment_all_data';
$route['transport/passenger-employeez-allotment-save-dropnly'] = 'transport/Passenger_emp_droponly_controller/allotment_data_save';

$route['transport/show-alloted-employee-pick-change-filter'] = 'transport/Passenger_emp_pickchange_controller/show_employees';
$route['transport/showpickuppoints-employee-allotment-pickchange'] = 'transport/Passenger_emp_pickchange_controller/show_pickuppoints';
$route['transport/passenger-employee-pickchange-allotment'] = 'transport/Passenger_emp_pickchange_controller/allotment_data_save';

$route['transport/show-alloted-employeez-drop-change-filter'] = 'transport/Passenger_emp_dropchange_controller/show_employees';
$route['transport/showpickuppoints-employee-allotment-dropchange'] = 'transport/Passenger_emp_dropchange_controller/show_droppoints';
$route['transport/passenger-employee-dropchange-allotment'] = 'transport/Passenger_emp_dropchange_controller/allotment_data_save';

$route['transport/show-alloted-employeez-picktripchange-filter'] = 'transport/Passenger_emp_picktripchange_controller/show_employees';
$route['transport/showtrips-employee-allotment-picktripchange'] = 'transport/Passenger_emp_picktripchange_controller/show_trips';
$route['transport/passenger-empz-tripchange-allotment'] = 'transport/Passenger_emp_picktripchange_controller/allotment_data_save';

$route['transport/show-alloted-employeez-droptripchange-filter'] = 'transport/Passenger_emp_droptripchange_controller/show_employees';
$route['transport/showtrips-employee-allotment-droptripchange'] = 'transport/Passenger_emp_droptripchange_controller/show_trips';
$route['transport/passenger-empz-droptripchange-allotment'] = 'transport/Passenger_emp_droptripchange_controller/allotment_data_save';

$route['transport/passenger-guest'] = 'transport/Passenger_guest_controller/load_starter';
$route['transport/show-allotment-route-guest'] = 'transport/Passenger_guest_controller/show_vehicle_route';
$route['transport/route-points-guest-allotment'] = 'transport/Passenger_guest_controller/show_points';
$route['transport/passenger-guest-tripdata'] = 'transport/Passenger_guest_controller/show_trips';
$route['transport/passenger-guest-allotment-data'] = 'transport/Passenger_guest_controller/get_guestdata';
$route['transport/passenger-guest-all-data'] = 'transport/Passenger_guest_controller/allotment_guest_data';
$route['transport/passenger-guest-allotment-save'] = 'transport/Passenger_guest_controller/allotment_data_save';


$route['transport/show-allotment-route-guest-pickonly'] = 'transport/Passenger_guest_pickonly_controller/show_vehicle_route';
$route['transport/route-points-guest-allotment-pickonly'] = 'transport/Passenger_guest_pickonly_controller/show_points';
$route['transport/passenger-guest-tripdata-pickonly'] = 'transport/Passenger_guest_pickonly_controller/show_trips';
$route['transport/passenger-guest-allotment-data-pickonly'] = 'transport/Passenger_guest_pickonly_controller/get_guestdata';
$route['transport/passenger-guest-all-data-pickonly'] = 'transport/Passenger_guest_pickonly_controller/allotment_guest_data';
$route['transport/passenger-guest-allotment-save-pickonly'] = 'transport/Passenger_guest_pickonly_controller/allotment_data_save';

$route['transport/show-allotment-route-guest-droponly'] = 'transport/Passenger_guest_droponly_controller/show_vehicle_route';
$route['transport/route-points-guest-allotment-droponly'] = 'transport/Passenger_guest_droponly_controller/show_points';
$route['transport/passenger-guest-tripdata-droponly'] = 'transport/Passenger_guest_droponly_controller/show_trips';
$route['transport/passenger-guest-allotment-data-droponly'] = 'transport/Passenger_guest_droponly_controller/get_guestdata';
$route['transport/passenger-guest-all-data-droponly'] = 'transport/Passenger_guest_droponly_controller/allotment_guest_data';
$route['transport/passenger-guest-allotment-save-droponly'] = 'transport/Passenger_guest_droponly_controller/allotment_data_save';

$route['transport/show-vehicle_list_passngr'] = 'transport/Passenger_vehiclewise_controller/load_vehicle';
$route['transport/show-alloted-student-passengerslist'] = 'transport/Passenger_vehiclewise_controller/load_passengers';

$route['transport/show-trip-list_passngr'] = 'transport/Passenger_tripwise_controller/load_trip';
$route['transport/show-tripz-student-passengerslist'] = 'transport/Passenger_tripwise_controller/load_passengers';

$route['transport/show-routes-list_passngr'] = 'transport/Passenger_routewise_controller/load_routes';
$route['transport/show-routesz-student-passengerslist'] = 'transport/Passenger_routewise_controller/load_passengers';



$route['transport/route-data-wizard'] = 'transport/Student_transport_allotment_controller/load_trip';
$route['transport/student-allotment-filter'] = 'transport/Student_transport_allotment_controller/get_student_filter_for_collection';
$route['transport/search-studentname-for-allotment'] = 'transport/Student_transport_allotment_controller/search_byname';
$route['transport/show-batch-for-student-filter-of-student-allotment'] = 'transport/Student_transport_allotment_controller/batchlist';
$route['transport/show-advanced-search-for-student-allotment'] = 'transport/Student_transport_allotment_controller/advancesearch_byname';
$route['transport/student-allotment-finaldata'] = 'transport/Student_transport_allotment_controller/allotment_data_collection';
$route['transport/student-allotment-finaldata-save'] = 'transport/Student_transport_allotment_controller/allotment_student_save';

$route['transport/allotment-guest'] = 'transport/Guest_transport_allotment_controller/load_allotment';
$route['transport/route-data-wizard-guest'] = 'transport/Guest_transport_allotment_controller/load_trip';
$route['transport/guest-allotment-details'] = 'transport/Guest_transport_allotment_controller/load_guest_data_page';
$route['transport/guest-allotment-finaldata'] = 'transport/Guest_transport_allotment_controller/allotment_data_collection';
$route['transport/guest-allotment-finaldata-save'] = 'transport/Guest_transport_allotment_controller/allotment_guest_save';

$route['transport/allotment-staff'] = 'transport/Staff_allotment_controller/load_allotment';
$route['transport/route-data-wizard-staff'] = 'transport/Staff_allotment_controller/load_trip';
$route['transport/staff-allotment-filter'] = 'transport/Staff_allotment_controller/staff_filter';
$route['transport/search-staff-allotment-filter'] = 'transport/Staff_allotment_controller/search_staffname';
$route['transport/staff-allotment-finaldata'] = 'transport/Staff_allotment_controller/allotment_data_collection';
$route['transport/staff-allotment-finaldata-save'] = 'transport/Staff_allotment_controller/allotment_staff_save';
$route['transport/staffallotment-search-teachername'] = 'transport/Staff_allotment_controller/search_teachername';

$route['transport/deallot-student-route'] = 'transport/Student_dealloacate_transport/show_route_trip';
$route['transport/load-trip-deallot'] = 'transport/Student_dealloacate_transport/load_particular_route_trip';
$route['transport/load-student-deallot'] = 'transport/Student_dealloacate_transport/load_students';
$route['transport/save-student-deallot'] = 'transport/Student_dealloacate_transport/deallocate_students';

$route['transport/deallot-staff-route'] = 'transport/Staff_deallocate_controller/show_route_trip';
$route['transport/load-trip-staffdeallot'] = 'transport/Staff_deallocate_controller/load_particular_route_trip';
$route['transport/load-staff-deallot'] = 'transport/Staff_deallocate_controller/load_employees';
$route['transport/save-staff-deallot'] = 'transport/Staff_deallocate_controller/deallocate_staff';

$route['transport/deallot-guest-route'] = 'transport/Guest_allotment_controller/show_route_trip';
$route['transport/load-trip-guestdeallot'] = 'transport/Guest_allotment_controller/load_particular_route_trip';
$route['transport/load-guest-deallot'] = 'transport/Guest_allotment_controller/load_guest';
$route['transport/save-guest-deallot'] = 'transport/Guest_allotment_controller/deallocate_guest';



$route['transport/load-vehicles-profile'] = 'transport/Vehicle_profile_controller/load_vehicle_profile';
$route['transport/load-vehicle-details'] = 'transport/Vehicle_profile_controller/load_vehicle_profile_details';
/* List Datas */
$route['transport/route-pickuppoint-list'] = 'transport/Pickuppoint_route_mapping_controller/show_route_pickuppoints_map';
$route['transport/show-new-vehicle-staff'] = 'transport/Vehicle_staff_controller/show_vehicles';
$route['transport/load-staff-map-page'] = 'transport/Vehicle_staff_controller/show_staff';
$route['transport/create-new-staff-vehicle'] = 'transport/Vehicle_staff_controller/load_staff_new';
$route['transport/get-staff-vehicle'] = 'transport/Vehicle_staff_controller/get_staff';
$route['transport/save-vehiclestaff-details'] = 'transport/Vehicle_staff_controller/save_staff_new';
$route['transport/update-vehiclestaff-details'] = 'transport/Vehicle_staff_controller/update_staff';
$route['transport/vehiclestaff/change_status'] = 'transport/Vehicle_staff_controller/update_status';

$route['transport/show-vehicle-fuel'] = 'transport/Fuel_log_controller/load_vehicle';
$route['transport/load-fuel-log-page'] = 'transport/Fuel_log_controller/add_fuel_log';
$route['transport/create-new-fuel-log'] = 'transport/Fuel_log_controller/fuel_log_entry';
$route['transport/save-fuellog-details'] = 'transport/Fuel_log_controller/save_fuel_log_entry';

$route['transport/show-vehicle-spares'] = 'transport/Spareparts_controller/show_spareparts';
$route['transport/load-spareparts'] = 'transport/Spareparts_controller/show_spareparts';
$route['transport/add-new-sparepart'] = 'transport/Spareparts_controller/add_spareparts';
$route['transport/save-spareparts-details'] = 'transport/Spareparts_controller/save_spareparts';
$route['transport/show-spareparts'] = 'transport/Spareparts_controller/show_sparepart_list';
$route['transport/new-spareparts'] = 'transport/Spareparts_controller/add_newparts';
$route['transport/save-sparepart'] = 'transport/Spareparts_controller/save_newparts';
$route['sparepart/change_status'] = 'transport/Spareparts_controller/disable_parts';

$route['transport/show-vehicle-acessories'] = 'transport/Acessories_controller/load_vehicle';
$route['transport/load-acessories'] = 'transport/Acessories_controller/show_acessories';
$route['transport/add-new-acessories'] = 'transport/Acessories_controller/add_acessories';
$route['transport/save-acessories-details'] = 'transport/Acessories_controller/save_acessories';

$route['transport/show-vehicle-route-fees'] = 'transport/Transport_fees_controller/show_route';
$route['transport/load-pickuppoint-page'] = 'transport/Transport_fees_controller/show_pickuppoints';
$route['transport/save-pickuppointfees'] = 'transport/Transport_fees_controller/save_fees_pickuppoints';
/* * ******************************************************************************************************************
∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport Reports-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞
/******************************************************************************************************************* */
$route['report/show-transportreportdata'] = 'Transport_report/Transport_report_controller/show_report_settings';
$route['transport/show-fuellog-report'] = 'Transport_report/Transport_report_controller/get_preload_transport_data';
$route['transport/show-vehicleincidents-report'] = 'Transport_report/Transport_report_controller/get_preload_vehicle_incidents_data';
$route['transport/show-costwise-report'] = 'Transport_report/Transport_report_controller/get_preload_vehicle_costwise_data';
$route['transport/show-expenditure-report'] = 'Transport_report/Transport_report_controller/get_preload_vehicle_expenditure_data';
$route['transport/show-expenditure-summary-report'] = 'Transport_report/Transport_report_controller/get_preload_vehicle_expenditure_summary_data';
$route['transport/show-maintenance-report'] = 'Transport_report/Transport_report_controller/get_preload_vehicle_maintanance_data';
$route['transport/show-maintenance-summary-report'] = 'Transport_report/Transport_report_controller/get_preload_vehicle_maintanance_summary_data';
$route['transport/show-fuelconsumption-report'] = 'Transport_report/Transport_report_controller/get_preload_transport_fuelconsumption';
$route['transport/show-vehicle-route-tripwise-reprt'] = 'Transport_report/Transport_report_controller/gen_route_trip_preloads';
$route['transport/show-vehicle-route-pickpointwise-reprt'] = 'Transport_report/Transport_report_controller/gen_route_trip_pick_preloads';
$route['transport/show-pickpoint-fees-reprt'] = 'Transport_report/Transport_report_controller/gen_pick_fees_preloads';
$route['transport/show-studclasswise-rept'] = 'Transport_report/Transport_report_controller/get_preload_studclasswise';
$route['transport/show-tripwise-student-rept'] = 'Transport_report/Transport_report_controller/get_preload_studtripwise';
$route['transport/show-pickupwise-student-rept'] = 'Transport_report/Transport_report_controller/get_preload_studpickupwise';
$route['transport/show-vehicle-trip-rept'] = 'Transport_report/Transport_report_controller/get_preload_vehicle_trip';

$route['transport-report/fuellog-report'] = 'Transport_report/Transport_report_controller/report_gen_fuel_log';
$route['transport-report/get_maintanance_list'] = 'Transport_report/Transport_report_controller/get_maintancelist';
$route['transport-report/maintain-report'] = 'Transport_report/Transport_report_controller/maintains_report';
$route['transport-report/file-upload'] = 'Transport_report/Transport_report_controller/uplode_invoice_file';
$route['transport-report/vehicle-incidents-report'] = 'Transport_report/Transport_report_controller/vehicle_incidents_report';
$route['transport-report/vehicle-costwise-report'] = 'Transport_report/Transport_report_controller/vehicle_cost_report';
$route['transport-report/vehicle-expenditure-report'] = 'Transport_report/Transport_report_controller/vehicle_expenditure_report';
$route['transport-report/expendituresummary-report'] = 'Transport_report/Transport_report_controller/expendituresummary_report';
$route['transport-report/fuelconsumption-report'] = 'Transport_report/Transport_report_controller/report_gen_fuel_consumption';
$route['transport-report/maintenance-report'] = 'Transport_report/Transport_report_controller/report_maintenance_vehicle';
$route['transport-report/maintain-summary-report'] = 'Transport_report/Transport_report_controller/maintains_summary_report';
$route['transport-report/vhicleincident-report'] = 'Transport_report/Transport_report_controller/report_gen_vehicleincident';

$route['transport-report/tripz-stud-rpt'] = 'Transport_report/Transport_report_controller/gen_routestripwise_studrpt';
$route['transport/get-stops-rpt-stuf'] = 'Transport_report/Transport_report_controller/get_stops';
$route['transport-report/pickstopz-stud-rpt'] = 'Transport_report/Transport_report_controller/gen_trip_pickstops_rpt';
$route['transport-report/pickstopz-fee-rpt'] = 'Transport_report/Transport_report_controller/gen_pickpoint_fees_rpt';
$route['transport/stud-classwise-report'] = 'Transport_report/Transport_report_controller/stud_classwise_report';
$route['transport/stud-pickupwise-report'] = 'Transport_report/Transport_report_controller/stud_pickupwise_report';
$route['transport/stud-tripwise-report'] = 'Transport_report/Transport_report_controller/stud_tripwise_report';
$route['transport-report/vehicle-trip-report'] = 'Transport_report/Transport_report_controller/vehicle_trip_report';


/* * ******************************************************************************************************************
  ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport Reports-DocMe END ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞
  /******************************************************************************************************************* */


$route['transport/show-sparepart-report'] = 'Transport_report/Transport_report_controller/get_preload_transport_sparedata';
$route['transport-report/sparepart-report'] = 'Transport_report/Transport_report_controller/report_gen_sparepart';
$route['transport/show-acessories-report'] = 'Transport_report/Transport_report_controller/get_preload_transport_acessoriesdata';
$route['transport/show-incident-report'] = 'Transport_report/Transport_report_controller/get_preload_transport_incidentdata';
$route['transport/show-service-report'] = 'Transport_report/Transport_report_controller/get_preload_transport_servicedata';
$route['transport/show-fuelconsumption-report'] = 'Transport_report/Transport_report_controller/get_preload_transport_fuelconsumption';
$route['transport/show-vehiclecostwise-report'] = 'Transport_report/Transport_report_controller/get_preload_transport_vehicle_costwise';
$route['transport/show-trip-pickuppoint-report'] = 'Transport_report/Transport_report_controller/get_preload_transport_trip_pickuppoint';
$route['transport/show-vehicletriproute-pickuppoint-studreport'] = 'Transport_report/Transport_report_controller/get_preload_transport_vehicletrip_routepickuppoint_stud';
$route['transport/show-vehicletriproute-pickuppoint-empreport'] = 'Transport_report/Transport_report_controller/get_preload_transport_vehicletrip_routepickuppoint_emp';
/* * ******************************************************************************************************************
  ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Ware house-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞
  /******************************************************************************************************************* */
$route['transport/load-warehouse'] = 'transport/Warehouse_controller/warehouse_loading';
$route['transport/show-vendor'] = 'transport/Vendor_controller/show_vendor';
$route['transport/create-new-vendor'] = 'transport/Vendor_controller/add_vendor';
$route['transport/addvendor'] = 'transport/Vendor_controller/save_vendor';
$route['transport/vendor/change_status'] = 'transport/Vendor_controller/change_vendor_status';
$route['transport/edit-vendor'] = 'transport/Vendor_controller/edit_vendor';
$route['transport/show-parts-spare'] = 'transport/Spareparts_controller/show_spareparts';
$route['transport/create-new-parts-spare'] = 'transport/Spareparts_controller/add_parts';
$route['transport/parts/change_status'] = 'transport/Spareparts_controller/change_status_parts';
//this route changed by Elavarasan S @ 12-06-2019 10:08
$route['transport/edit-parts-spare'] = 'transport/Spareparts_controller/edit_spareparts';
$route['transport/edit-service-type'] = 'transport/Servicetype_controller/edit_servicetype';
$route['transport/updatesave-servicetype'] = 'transport/Servicetype_controller/edit_save_servicetype';


$route['transport/addparts-sparevendor'] = 'transport/Spareparts_controller/save_spares_part';
$route['transport/show-parts-direct-purchase'] = 'transport/Directpurchase_controller/show_purchase_sparedata';
$route['transport/create-new-parts-spare-direct-purchase'] = 'transport/Directpurchase_controller/add_direct_purchase';
// This route added by Elavarasan S @ 10-06-2019 11:10
$route['transport/update-spareparts'] = 'transport/Spareparts_controller/edit_save_spareparts';
$route['transport/edit-parts-spare-direct-purchase'] = 'transport/Directpurchase_controller/edit_direct_purchase';
$route['transport/edit-direct-purchase'] = 'transport/Directpurchase_controller/update_spares_direct_part';

$route['transport/addparts-spare-direct-purchase'] = 'transport/Directpurchase_controller/save_spares_direct_part';
$route['transport/directpurchase/change_status'] = 'transport/Directpurchase_controller/disable_spares_direct_part';
$route['transport/show-parts-stock'] = 'transport/Spareparts_stock_controller/show_spareparts_stock';
$route['transport/show-spareparts-vehiclez'] = 'transport/Sparepart_allotment_controller/show_vehicles';
$route['transport/add-spareparts-vehicle'] = 'transport/Sparepart_allotment_controller/add_spare_parts_vehicle';
$route['transport/addparts-spareparts-vehicles-data'] = 'transport/Sparepart_allotment_controller/save_spare_parts_vehicle';
$route['transport/showspares-spareparts-vehicle'] = 'transport/Sparepart_allotment_controller/show_spare_parts_vehicle';

$route['cron/dcb'] = 'administration/Cron_controller/dcb_report';
$route['cron/wallet-balance'] = 'administration/Cron_controller/wallet_balance_report';
$route['cron/dcb-month'] = 'administration/Cron_controller/dcb_monthwise_report';
$route['cron/saved-dcb'] = 'administration/Cron_controller/saved_dcb_report';
$route['cron/saved-dcb-month'] = 'administration/Cron_controller/saved_dcb_monthwise_report';



$route['create-image'] = 'student_settings/Student_Management_controller/create_image_files';

/* *******************************************************************************************************************
  ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Notification-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞
/******************************************************************************************************************* */
$route['notification/show-notification-settings']            =  'notification_settings/Notification_controller/show_notification_settings';
$route['notification/show-notifications-list']               =  'notification_settings/Notification_controller/get_all_notification_list';
$route['notification/add-notification']                      =  'notification_settings/Notification_controller/add_notification';
$route['notification/edit-notification']                     =  'notification_settings/Notification_controller/edit_notification';
$route['notification/notification-change-status']            =  'notification_settings/Notification_controller/notification_change_status';
$route['notification/load-arrear-list']                      =  'notification_settings/Notification_controller/arrear_list_notification';
$route['notification/notification-send-all']                 =  'notification_settings/Notification_controller/notification_sms_send_all';
$route['notification/notification-resend']                   =  'notification_settings/Notification_controller/notification_sms_resend';
$route['notification/show-filter-student-notification']      =  'notification_settings/Notification_controller/get_student_filter_for_account';
$route['notification/search-studentname-for-account']        =  'notification_settings/Notification_controller/search_byname_for_account';
$route['notification/advancesearch-studentname-for-account'] = 'notification_settings/Notification_controller/advancesearch_byname_for_account';
$route['notification/search-studentname-for-account']        = 'notification_settings/Notification_controller/search_byname_for_account';
$route['notification/get-batchdetails-for-account']          = 'notification_settings/Notification_controller/batchlist_for_account';
$route['notification/list_class_based_on_stream']            = 'notification_settings/Notification_controller/list_class_based_on_stream';
$route['notification/notification-list-byid']                = 'notification_settings/Notification_controller/notification_list_byid';
