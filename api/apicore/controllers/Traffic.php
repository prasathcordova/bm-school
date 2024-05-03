<?php

defined('BASEPATH') or exit('No direct script access allowed');

/* * get_particularpart
 * Description of Traffic
 * Description : Handle traffic of this API
 * @author Aju S Aravind
 */

class Traffic extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index_post()
    {
        if (!$this->post('action')) {
            $this->response(array('status' => FALSE, 'message' => 'Please specify the module name that need to be accessed.'));
        }
        $action = $this->post('action');
        $controller_function = $this->post('controller_function');

        switch ($action) {
                //Testing service            
            case ('ping'): // SAMPLE PING
                $this->ping();
                break;
                //Country Service            
            case ('get_countries'):
                $this->get_countries();
                break;
            case ('save_country'):
                $this->save_country();
                break;
            case ('update_country'):
                $this->update_country();
                break;
            case ('modify_country_status'):
                $this->modify_country_status();
                break;
            case ('get_languages'):
                $this->get_languages();
                break;
            case ('save_language'):
                $this->save_language();
                break;
            case ('update_language'):
                $this->update_language();
                break;
            case ('modify_language_status'):
                $this->modify_language_status();
                break;
            case ('get_profession'):
                $this->get_profession();
                break;
            case ('get_institution_list'):
                $this->get_institution_list();
                break;
            case ('save_profession'):
                $this->save_profession();
                break;
            case ('update_profession'):
                $this->update_profession();
                break;
            case ('modify_Profession_status'):
                $this->modify_Profession_status();
                break;
            case ('get_currency'):
                $this->get_currency();
                break;
            case ('get_sponsers'):
                $this->get_sponsers();
                break;
                //            create case by vinoth for get_one_sponsers @ 30-06-2019
            case ('get_one_sponsers'):
                $this->get_one_sponsers();
                break;
            case ('save_currency'):
                $this->save_currency();
                break;
                //            create case by vinoth for save_sponsers @ 30-06-2019
            case ('save_sponser'):
                $this->save_sponser();
                break;
            case ('update_currency'):
                $this->update_currency();
                break;
                //            create function by vinoth for update sponser @ 30-06-2019
            case ('update_sponser'):
                $this->update_sponser();
                break;
            case ('modify_currency_status'):
                $this->modify_currency_status();
                break;
            case ('get_city'):
                $this->get_city();
                break;
            case ('save_city'):
                $this->save_city();
                break;
            case ('update_city'):
                $this->update_city();
                break;
            case ('modify_city_status'):
                $this->modify_city_status();
                break;
            case ('get_caste'):
                $this->get_caste();
                break;
            case ('save_caste'):
                $this->save_caste();
                break;
            case ('update_caste'):
                $this->update_caste();
                break;
            case ('modify_caste_status'):
                $this->modify_caste_status();
                break;
            case ('get_role'):
                $this->get_role();
                break;
            case ('save_role'):
                $this->save_role();
                break;
            case ('update_role'):
                $this->update_role();
                break;
            case ('modify_role_status'):
                $this->modify_role_status();
                break;
            case ('get_institution'):
                $this->get_institution();
                break;
            case ('save_institution'):
                $this->save_institution();
                break;
            case ('update_institution'):
                $this->update_institution();
                break;
            case ('get_community'):
                $this->get_community();
                break;
            case ('save_community'):
                $this->save_community();
                break;
            case ('update_community'):
                $this->update_community();
                break;
            case ('modify_community_status'):
                $this->modify_community_status();
                break;
            case ('get_religion'):
                $this->get_religion();
                break;
            case ('save_religion'):
                $this->save_religion();
                break;
            case ('update_religion'):
                $this->update_religion();
                break;
            case ('modify_religion_status'):
                $this->modify_religion_status();
                break;
            case ('login_user'):
                $this->login_user();
                break;
            case ('verify_user_for_login'):
                $this->verify_user_for_login();
                break;
            case ('parent_verify_and_login_with_otp_and_api'):
                $this->parent_verify_and_login_with_otp_and_api();
                break;
            case ('user_data'):
                $this->user_data();
                break;
            case ('get_state'):
                $this->get_state();
                break;
            case ('save_state'):
                $this->save_state();
                break;
            case ('update_state'):
                $this->update_state();
                break;
            case ('modify_state_status'):
                $this->modify_state_status();
                break;
            case ('get_studentparent_details'):
                $this->get_studentparent_details();
                break;
            case ('get_student_details'):
                $this->get_student_details();
                break;
            case ('get_student_profile_details'):
                $this->get_student_profile_details();
                break;
            case ('get_all_student_profile_details'):
                $this->get_all_student_profile_details();
                break;
            case ('getdetails_student'):
                $this->get_details_student();
                break;

            case ('getstudent_profiledetails'):
                $this->getstudent_profiledetails();
                break;
            case ('getstudent_passportdetails'):
                $this->getstudent_passportdetails();
                break;
            case ('getstudent_sibilingsdetails'):
                $this->getstudent_sibilingsdetails();
                break;
            case ('getstudent_sibilingsdetails_byadmno'):
                $this->getstudent_sibilingsdetails_byadmno();
                break;
            case ('get_longabsentdetails_student'):
                $this->get_longabsentdetails_student();
                break;

                //CELIN
            case ('save_direct_purchase_order'):
                $this->save_direct_purchase_order();
                break;

            case ('save_purchase_order'):
                $this->save_purchase_order();
                break;

            case ('edit_purchase'):
                $this->edit_purchase();
                break;
            case ('update_purchase'):
                $this->update_purchase();
                break;

            case ('approve_purchase'):
                $this->approve_purchase();
                break;
                //===============
                //DOCME
                //            case ('get_publisher') :
                //                $this->get_publisher_details();
                //                break;
                //            case ('save_publisher') :
                //                $this->save_publisher();
                //                break;
                //            case ('update_publisher') :
                //                $this->update_publisher();
                //                break;
                //end DOCME
                //Item type start here
                //Author DOCME
            case ('get_itemtype'):
                $this->get_itemtype_details();
                break;
            case ('save_itemtype'):
                $this->save_itemtype();
                break;
            case ('update_itemtype'):
                $this->update_itemtype();
                break;
            case ('modify_itemtype_status'):
                $this->modify_itemtype_status();
                break;
            case ('item_search_list'):
                $this->item_search();
                break;
                //end itemtpe
                //author Docme
                //Item Edition//
            case ('get_itemedition'):
                $this->get_itemedition();
                break;
            case ('modify_itemedition_status'):
                $this->modify_itemedition_status();
                break;
            case ('save_itemedition'):
                $this->save_itemedition();
                break;
            case ('update_itemedition'):
                $this->update_itemedition();
                break;
                //Item Edition Ends//
                //Academic Year
                // case ('get_academicyr') :
                //     $this->get_academicyr();
                //     break;
                // case ('save_academicyr') :
                //     $this->save_academicyr();
                //     break;
                // case ('update_academicyr') :
                //     $this->update_academicyr();
                //     break;

                //Stream
            case ('get_stream'):
                $this->get_stream();
                break;
            case ('save_stream'):
                $this->save_stream();
                break;
            case ('update_stream'):
                $this->update_stream();
                break;

                //Class
            case ('get_class'):
                $this->get_class();
                break;
                // case ('save_class') :
                //     $this->save_class();
                //     break;
                // case ('update_class') :
                //     $this->update_class();
                //     break;
                // @author DOCME

            case ('get_student_search_list'):
                $this->get_student_search_list();
                break;
            case ('get_student_by_name_or_admission'):
                $this->get_student_by_name_or_admission();
                break;
            case ('parent_search_for_registration'):
                $this->parent_search_for_registration();
                break;
            case ('get_la_student_by_admission_no'):
                $this->get_la_student_by_admission_no();
                break;
            case ('search_student_details'):
                $this->search_student_details();
                break;
            case ('get_staff_sibling_list'):
                $this->get_staff_sibling_list();
                break;

                //end DOCME
                //Author docme
                //course
            case ('get_course'):
                $this->get_course();
                break;
            case ('save_course'):
                $this->save_course();
                break;
            case ('update_course'):
                $this->update_course();
                break;
            case ('modify_course_status'):
                $this->modify_course_status();
                break;

            case ('std_batch_change'):
                $this->std_batch_change();
                break;

            case ('std_admn_no_change'):
                $this->std_admn_no_change();
                break;
                //classes
            case ('get_classes'):
                $this->get_classes();
                break;
            case ('save_classes'):
                $this->save_classes();
                break;
            case ('update_classes'):
                $this->update_classes();
                break;
            case ('modify_class_status'):
                $this->modify_class_status();
                break;
                //batch
            case ('get_batch'):
                $this->get_batch();
                break;
            case ('get_division'):
                $this->get_division();
                break;
            case ('get_batch_with_student_id'):
                $this->get_batch_with_student_id();
                break;
            case ('save_batch'):
                $this->save_batch();
                break;
            case ('update_batch'):
                $this->update_batch();
                break;
            case ('get_acdyear'):
                $this->get_acdyear();
                break;
            case ('get_session'):
                $this->get_session();
                break;
                //ends docme
                //long absent--Author docme
            case ('get_longabsent'):
                $this->get_longabsent();
                break;

            case ('get_country_states'):
                $this->get_country_states();
                break;
            case ('get_employee_list_from_wfm'):
                $this->get_employee_list_from_wfm();
                break;
            case ('get_employee_details_from_wfm');
                $this->get_employee_details_from_wfm();
                break;
                //END Select Country,get states
                //Select States,get City -->author docme
            case ('get_state_city'):
                $this->get_state_city();
                break;
                //END Select States,get City
                //Select Religion,get Caste -->author docme
            case ('get_religion_caste'):
                $this->get_religion_caste();
                break;
                //END Religion,get Caste
                //long Absent end
                /*
             * @Author      :  Elavarasan S 
             * Purpose      :  Temporary Registration saving purpose
             * Created Date :  21-May-2019
             */
            case ('save_student_temp_reg'):
                $this->save_student_temp_reg();
                break;
            case ('update_student_temp_reg'):
                $this->update_student_temp_reg();
                break;
            case ('get_all_temp_students'):
                $this->get_all_temp_students();
                break;
            case ('search_temp_reg_student'):
                $this->search_temp_reg_student();
                break;
            case ('get_temp_reg_student'):
                $this->get_temp_reg_student();
                break;
            case ('get_temp_reg_data'):
                $this->get_temp_reg_data();
                break;
            case ('get_otp_data'):
                $this->get_otp_data();
                break;
            case ('get_select_reg_date_data'):
                $this->get_select_reg_date_data();
                break;
            case ('get_all_api_keys'):
                $this->get_all_api_keys();
                break;
                /*
             * @Author      :  Aju S Aravind 
             * Purpose      :  Registration saving purpose
             * Created Date :  10-Oct-2017
             */
            case ('save_personal_profile_reg'):
                $this->save_personal_profile_reg();
                break;
                /*
             * @Author      :  Aju S Aravind 
             * Purpose      :  Registration saving purpose
             * Created Date :  10-Oct-2017
             */
            case ('get-class-details-with-age-restrict'):
                $this->get_class_details_with_age_restriction();
                break;
                /*
             * @Author      :  Aju S Aravind 
             * Purpose      :  Registration academic details saving purpose
             * Created Date :  10-Oct-2017
             */
            case ('save_academic_profile_reg'):
                $this->save_academic_profile_reg();
                break;
                /*
             * @Author      :  Aju S Aravind 
             * Purpose      :  Registration academic details saving purpose
             * Created Date :  10-Oct-2017
             */
            case ('get_batch_details_for_filter'):
                $this->get_batch_details_for_filter();
                break;

            case ('status_history'):
                $this->status_history();
                break;
            case ('get_active'):
                $this->get_active();
                break;

            case ('get_medium'):
                $this->get_medium();
                break;
            case ('modify_batch_status'):
                $this->modify_batch_status();
                break;
                /*
             * @Author      :  Chandrajith
             * Purpose      :  Registration other details saving purpose
             * Created Date :  10-Oct-2017
             */
            case ('save_otherdetails_reg'):
                $this->save_otherdetails_reg();
                break;
                /*
             * @Author      :  Chandrajith
             * Purpose      :  Get all purchase list 
             * Created Date :  10-Oct-2017
             */
            case ('get_all_purchase_list'):
                $this->get_all_purchase_list();
                break;


            case ('get_class_course'):
                $this->get_class_course();
                break;
                /*
             * @Author      :  Aju S Aravind 
             * Purpose      :  Store Management - search item code / item name based on the key given
             * Created Date :  10-Oct-2017
             */
            case ('get_items_by_code_and_name'):
                $this->get_items_by_code_and_name();
                break;
            case ('save_role_permission'):
                $this->save_role_permission();
                break;

                /*
             * @Author      : docme
             * Created Date :  06-Oct-2017
             * Purpose      :  Registration parent details saving purpose

             */
            case ('save_parent_profile_reg'):
                $this->save_parent_profile_reg();
                break;
                // Purpose      :  Registration parent details editing purpose
            case ('edit_parent_profile_reg'):
                $this->edit_parent_profile_reg();
                break;
                /*
             * @Author      : docme
             * Created Date :  010-Oct-2017
             * Purpose      : Publisher Supplier and Category details for bookstore

             */
            case ('get_publisher'):
                $this->get_publisher();
                break;
            case ('save_publisher'):
                $this->save_publisher();
                break;



            case ('update_publisher'):
                $this->update_publisher();
                break;
            case ('modify_publisher_status'):
                $this->modify_publisher_status();
                break;
            case ('get_suppliers'):
                $this->get_suppliers();
                break;
            case ('save_suppliers'):
                $this->save_suppliers();
                break;
            case ('update_suppliers'):
                $this->update_suppliers();
                break;
            case ('modify_suppliers_status'):
                $this->modify_suppliers_status();
                break;
            case ('get_category'):
                $this->get_category();
                break;
            case ('save_category'):
                $this->save_category();
                break;
            case ('update_category'):
                $this->update_category();
                break;
            case ('modify_category_status'):
                $this->modify_category_status();
                break;
                /*
             * @Author      :  Chandrajith
             * Purpose      :  Registration other details saving purpose
             * Created Date :  06-Oct-2017
             */
            case ('save_facilitydetails_reg'):
                $this->save_facilitydetails_reg();
                break;
                /*
             * @Author      :  Chandrajith
             * Purpose      :  Showing The Details Of Item Master
             * Created Date :  09-Oct-2017
             */
            case ('show_items_master'):
                $this->show_items_master();
                break;
                /*
             * @Author      : docme
             * Created Date :  010-Oct-2017
             * Purpose      : Catogery   details for bookstore

             */
            case ('save_itemmaster'):
                $this->save_itemmaster();
                break;
            case ('update_items'):
                $this->update_items();
                break;
            case ('modify_item_status'):
                $this->modify_item_status();
                break;
            case ('rate_item_show'):
                $this->rate_item_show();
                break;
            case ('store_show'):
                $this->store_show();
                break;
                /*
             * @Author      : docme
             * Created Date :  010-Oct-2017
             * Purpose      : Count  for Students LB and total

             */

            case ('get_student_count'):
                $this->get_student_count();
                break;

                /*
             * @Author      : docme
             * Created Date :  010-Oct-2017
             * Purpose      : Count  for stundent Registration percent <100

             */

            case ('get_stud_reg_count'):
                $this->get_stud_reg_count();
                break;

                /*
             * @Author      : docme
             * Created Date :  010-Oct-2017
             * Purpose      : Count  for student tc applied count

             */

            case ('get_tc_applied_count'):
                $this->get_tc_applied_count();
                break;
                /*
             * @Author      :  docme
             * Purpose      :  PRofile Edit purpose
             * Created Date : 1-NOv-2017
             */
            case ('stud_profile_edit'):
                $this->stud_profile_edit();
                break;
            case ('email_validation'):
                $this->email_validation();
                break;

                /*
             * @Author      : docme
             * Created Date :  010-Oct-2017
             * Purpose      : Count  for student tc issue count

             */

            case ('get_tc_issue_count'):
                $this->get_tc_issue_count();
                break;


                /*
             * @Author      :  Chandrajith
             * Purpose      :  For saving Tc application
             * Created Date :  13-Oct-2017
             */
            case ('save_tc'):
                $this->save_tc();
                break;
                //-------------------------------------------------------------------------------------------------------------
                //
                /*
             * @Author      : docme
             * Created Date :  10-Oct-2017
             * Purpose      : Count  for bookstore

             */
            case ('get_count'):
                $this->get_count();
                break;
                //purpose : count for  General_settings
            case ('get_gs_count'):
                $this->get_gs_count();
                break;
                //------------------------------------------------------------------------------------------------------
                /*
             * @Author      : docme
             * Created Date :  21-Oct-2017
             * Purpose      : Count  for Document

             */
            case ('get_doc_count'):
                $this->get_doc_count();
                break;

                /*
             * @Author      : docme
             * Created Date :  21-Oct-2017
             * Purpose      :FOr adhar validation

             */
            case ('adhar_validation'):
                $this->adhar_validation();
                break;
                break;
                /*
             * @Author      : docme
             * Created Date :  22-Oct-2017
             * Purpose      :FOr mobile validation

             */
            case ('mobile_validation'):
                $this->mobile_validation();
                break;
            case ('get_course_type'):
                $this->get_course_type();
                break;
            case ('save_batch_allocate'):
                $this->save_batch_allocate();
                break;
                /*
             * @Author      :  Chandrajith
             * Purpose      :  For saving Tc application
             * Created Date :  19-Oct-2017
             */
            case ('save_tc_prep'):
                $this->save_tc_prep();
                break;
            case ('get_tc_prepared_list'):
                $this->get_tc_prepared_list();
                break;
                //this case written by Elavarasan S @ 16-05-2019 12:30
            case ('get_tc_prepared_list_by_admno'):
                $this->get_tc_prepared_list_by_admno();
                break;
            case ('cancel_tc'):
                $this->cancel_tc();
                break;
            case ('get_tc_applied_stud'):
                $this->get_tc_applied_stud();
                break;
                //this case written by Elavarasan S @ 16-05-2019 12:30
            case ('get_tc_applied_stud_by_admno'):
                $this->get_tc_applied_stud_by_admno();
                break;
            case ('get_tc_applied_stud_by_id'):
                $this->get_tc_applied_stud_by_id();
                break;
            case ('get_tc_types'):
                $this->get_tc_types();
                break;
            case ('get_tc_issue_data'):
                $this->get_tc_issue_data();
                break;
            case ('save_longabsent'):
                $this->save_longabsent();
                break;
            case ('get_longabsent_students'):
                $this->get_longabsent_students();
                break;
            case ('longabsent_release'):
                $this->longabsent_release();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  priotiry setting for selection of emailID
             * Created Date :  25-Oct-2017
             */
            case ('Email_priority'):
                $this->Email_priority();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  search students for filter students & search inside batch
             * Created Date :  27-Oct-2017
             */
            case ('student_search'):
                $this->student_search();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  count no batch
             * Created Date :  31-Oct-2017
             */
            case ('no_batch_counts'):
                $this->no_batch_counts();
                break;
                /*
             * @Author      :  Rahuk
             * Purpose      :  Registration Edit purpose
             * Created Date :  31-Oct-2017
             */
            case ('edit_personal_profile_reg'):
                $this->edit_personal_profile_reg();
                break;

            case ('edit_academic_profile_reg'):
                $this->edit_academic_profile_reg();
                break;

            case ('edit_parent_profile_reg'):
                $this->edit_parent_profile_reg();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To get document list of a student with current status
             * Created Date :  02-Nov-2017
             */

            case ('get_doc_list'):
                $this->get_doc_list();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To get document list of a student with current status
             * Created Date :  02-Nov-2017
             */
            case ('permission_app_menus'):
                $this->permission_app_menus();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To get document list of a student with current status
             * Created Date :  02-Nov-2017
             */
            case ('permission_app_module'):
                $this->permission_app_modules();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To get direct purchase details for approval
             * Created Date :  22-Nov-2017
             */
            case ('get_purchase_approval_data'):
                $this->get_purchase_approval_data();
                break;

                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To get document title for creating document
             * Created Date :  06-Nov-2017
             */
            case ('get_document_types'):
                $this->get_document_types();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To save purchse receive data
             * Created Date :  06-Nov-2017
             */
            case ('purchase_item_receive'):
                $this->purchase_item_receive();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To save a document to the server.
             * Created Date :  06-Nov-2017
             */
            case ('save_student_document'):
                $this->save_student_document();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To get file to view or download
             * Created Date :  08-Mar-2019
             */
            case ('get_file_info_to_download'):
                $this->get_file_info_to_download();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To remove document
             * Created Date :  08-Mar-2019
             */
            case ('remove_document'):
                $this->remove_document();
                break;
            case ('decrypt_document'):
                $this->decrypt_document();
                break;
            case ('get_role_for_user'):
                $this->get_role_for_user();
                break;
            case ('get_role_privileges'):
                $this->get_role_privileges();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  to get list of users, add new user,update user details,email updates,user role update
             * Created Date :  1-Nov-2017
             */
            case ('get_users'):
                $this->get_users();
                break;

            case ('save_users'):
                $this->save_users();
                break;
            case ('update_users'):
                $this->update_users();
                break;
            case ('modify_users_status'):
                $this->modify_users_status();
                break;
            case ('user_email_update'):
                $this->user_email_update();
                break;
            case ('user_role_update'):
                $this->user_role_update();
                break;
                /*
             * @Author      :  docme
             * Purpose      :  PROMOTION
             * Created Date : 3-NOv-2017
             */
            case ('get_promotion_stud'):
                $this->get_promotion_stud();
                break;
            case ('get_promoted_year'):
                $this->get_promoted_year();
                break;

            case ('get_promoted_class'):
                $this->get_promoted_class();
                break;

            case ('save_promotion'):
                $this->save_promotion();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  to get list of substores 
             * Created Date :  09-Nov-2017
             */
            case ('get_sub_stores'):
                $this->get_sub_stores();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  to get stock allotment list details 
             * Created Date :  10-Nov-2017
             */
            case ('get_stock_allotment'):
                $this->get_stock_allotment();
                break;

                /*
             * @Author      : docme S
             * Purpose      : to get opening stock master list
             * Created Date :  15-Nov-2017
             */
            case ('get_opening_stock_master'):
                $this->get_opening_stock_master();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  to save store details 
             * Created Date :  14-Nov-2017
             */
            case ('save_store'):
                $this->save_store();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  to update store details 
             * Created Date :  14-Nov-2017
             */
            case ('update_store'):
                $this->update_store();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  to update store status
             * Created Date :  14-Nov-2017
             */
            case ('modify_store_status'):
                $this->modify_store_status();
                break;


                /*
             * @Author      :  DOCME
             * Purpose      :  For changing rate of an item in a particular substore
             * Created Date :  17-Nov-2017
             */
            case ('rate_change_item'):
                $this->rate_change_item();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  For changing rate of an item in all substore
             * Created Date :  17-Nov-2017
             */
            case ('rate_change_item_for_allsubstore'):
                $this->rate_change_item_for_allsubstore();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  For displaying rate of an item in all substore
             * Created Date :  17-Nov-2017
             */
            case ('rate_display_item_for_allsubstore'):
                $this->rate_display_item_for_allsubstore();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  stock allotment save
             * Created Date :  18-Nov-2017
             */
            case ('save_Stock_allotment'):
                $this->save_Stock_allotment();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  Approve purchase approval direct
             * Created Date :  21-Nov-2017
             */
            case ('Approve_direct_purchase'):
                $this->Approve_direct_purchase();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  get purchase return list
             * Created Date :  21-Nov-2017
             */
            case ('get_purchase_return'):
                $this->get_purchase_return();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  Approve purchase return 
             * Created Date :  21-Nov-2017
             */
            case ('approve_purchase_return'):
                $this->approve_purchase_return();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  save purchase return 
             * Created Date :  21-Nov-2017
             */
            case ('save_purchase_return'):
                $this->save_purchase_return();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  stock allotment list
             * Created Date :  18-Nov-2017
             */
            case ('get_stock_allotment_list'):
                $this->get_stock_allotment_list();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  stock allotment approval
             * Created Date :  18-Nov-2017
             */
            case ('approve_allotment'):
                $this->approve_allotment();
                break;
                /* 22-11-2017 Author Docme  */
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Strength Report
             * Created Date :  30-Oct-2017
             */
            case ('get_strength_rpt'):
                $this->get_strength_rpt();
                break;

                /* @Author      :  Sari S R
            * Purpose      :  PDF report for Class wise Report in Course Management
            * Created Date :  29-Feb-2020
            */
            case ('get_course_classwise_rpt'):
                $this->get_course_classwise_rpt();
                break;

                /* @Author      :  Sari S R
            * Purpose      :  PDF report for Batch wise Report in Course Management
            * Created Date :  02-March-2020
            */
            case ('get_course_batchwise_rpt'):
                $this->get_course_batchwise_rpt();
                break;
                /*
             * @Author      :  Aju
             * Purpose      :  Promotion report
             * Created Date :  30-Oct-2017
             */
            case ('get_familywise_rpt'):
                $this->get_familywise_rpt();
                break;
                /*
             * @Author      :  Aju
             * Purpose      :  Promotion report
             * Created Date :  30-Oct-2017
             */
            case ('get_promotion_report'):
                $this->get_promotion_report();
                break;
                /*
             * @Author      :  Aju
             * Purpose      :  Detained report
             * Created Date :  30-Oct-2017
             */
            case ('get_detained_report'):
                $this->get_detained_report();
                break;
                /*
             * @Author      :  Aju
             * Purpose      :  TC summary report
             * Created Date :  30-Oct-2017
             */
            case ('get_tc_summary_report'):
                $this->get_tc_summary_report();
                break;
                /*
             * @Author      :  Aju
             * Purpose      :  TC app status report
             * Created Date :  30-Oct-2017
             */
            case ('get_tc_app_status_report'):
                $this->get_tc_app_status_report();
                break;

                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Nationalitywise Report
             * Created Date :  30-Oct-2017
             */

            case ('get_nationality_rpt'):
                $this->get_nationality_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Religionwise Report
             * Created Date :  30-Oct-2017
             */

            case ('get_religion_rpt'):
                $this->get_religion_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Professionwise Report
             * Created Date :  30-Oct-2017
             */

            case ('get_profession_rpt'):
                $this->get_profession_rpt();
                break;

                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Castewise Report
             * Created Date :  30-Oct-2017
             */

            case ('get_caste_rpt'):
                $this->get_caste_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Class Divisionwise Report
             * Created Date :  30-Oct-2017
             */

            case ('get_classdivision_rpt'):
                $this->get_classdivision_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Class wise Report
             * Created Date :  31-March-2019
             */

            case ('get_classwisestrngth_rpt'):
                $this->get_classwisestrngth_rpt();
                break;
                /*
              /*
             * @Author      :  Docme
             * Purpose      :  Display Student Class wise Report
             * Created Date :  31-March-2019
             */

            case ('get_no_batch_rpt'):
                $this->get_no_batch_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Collected Document Report
             * Created Date :  31-Oct-2017
             */

            case ('get_collecteddoc_rpt'):
                $this->get_collecteddoc_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Genderwise Report
             * Created Date :  31-Oct-2017
             */

            case ('get_studgender_rpt'):
                $this->get_studgender_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Agewise Report
             * Created Date :  31-Oct-2017
             */

            case ('get_studagewise_rpt'):
                $this->get_studagewise_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Contactwise Report
             * Created Date :  31-Oct-2017
             */

            case ('get_studcontact_rpt'):
                $this->get_studcontact_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Familywise Report
             * Created Date :  31-Oct-2017
             */

            case ('get_familywise_data_rpt'):
                $this->get_familywise_data_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student LongAbsenteewise Report
             * Created Date :  31-Oct-2017
             */

            case ('get_longabsnt_rpt'):
                $this->get_longabsnt_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Sexagewise Report
             * Created Date :  31-Oct-2017
             */

            case ('get_studsexagewise_rpt'):
                $this->get_studsexagewise_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Custom Report
             * Created Date :  02-Nov-2017
             */

            case ('get_custom_rpt'):
                $this->get_custom_rpt();
                break;
                /*
             * @Author      :  Docme
             * Purpose      :  Display Student Genderwise Report
             * Created Date :  02-Nov-2017
             */

            case ('get_genderwise_rpt'):
                $this->get_genderwise_rpt();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  Get stock list
             * Created Date :  23-Nov-2017
             */
            case ('get_current_stock_list'):
                $this->get_current_stock_list();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      : save opening stock
             * Created Date :  24-Nov-2017
             */
            case ('save_opening_stock_new'):
                $this->save_opening_stock_new();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      : To get purchase received data
             * Created Date :  25-Nov-2017
             */
            case ('get_purchase_details_for_receive'):
                $this->get_purchase_details_for_receive();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To edit purchase order
             * Created Date :  25-Nov-2017
             */
            case ('save_edit_purchase_order'):
                $this->save_edit_purchase_order();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To delete / mark inactive purchase order
             * Created Date :  25-Nov-2017
             */
            case ('purchase_delete'):
                $this->purchase_delete();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To get purchase return data for approval display
             * Created Date :  07-Dec-2017
             */
            case ('get_purchase_return_byid'):
                $this->get_purchase_return_byid();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  To get allotment details for approval
             * Created Date :  08-Dec-2017
             */
            case ('get_allotment_approval_data'):
                $this->get_allotment_approval_data();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To get allotment details for approval
             * Created Date :  08-Dec-2017
             */
            case ('uniform_get_allotment_approval_data'):
                $this->uniform_get_allotment_approval_data();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get stock list for report
             * Created Date :  23-Nov-2017
             */
            case ('get_current_stock_list_report'):
                $this->get_current_stock_list_report();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get report lock date
             * Created Date :  12-Dec-2017
             */
            case ('get_all_stock_report_data'):
                $this->get_all_stock_report_data();
                break;
            case ('report_lock_date'):
                $this->report_lock_date();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  To edit save allotment
             * Created Date :  14-Dec-2017
             */
            case ('save_edit_allotment'):
                $this->save_edit_allotment();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  To edit save purchase return
             * Created Date :  14-Dec-2017
             */
            case ('save_edit_purchase_return'):
                $this->save_edit_purchase_return();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  To delete a purchase return
             * Created Date :  13-Dec-2017
             */
            case ('purchase_return_delete'):
                $this->purchase_return_delete();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  To delete an allotment
             * Created Date :  13-Dec-2017
             */
            case ('allotment_delete'):
                $this->allotment_delete();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get report for allotment, main store
             * Created Date :  12-Dec-2017
             */
            case ('report_for_stock_allotment'):
                $this->report_for_stock_allotment();
                break;
                /*
             * @Author      :  Chandrajith
             * Purpose      :  Getting employee list
             * Created Date :  22-Dec-2017
             */

            case ('get_tusers'):
                $this->get_teachingusers();
                break;
            case ('get_teacher'):
                $this->getteacher_profiledetails();
                break;
            case ('get_stock_for_allotment'):
                $this->get_stock_for_allotment();
                break;
            case ('get_billstudent_search_list'):
                $this->get_billstudent_search_list();
                break;
            case ('get_student_search_list_for_modules'):
                $this->get_billstudent_search_list();
                break;
            case ('get_billadvancestudent_search_list'):
                $this->get_billadvancestudent_search_list();
                break;
            case ('get_advancestudent_search_list_for_modules'):
                $this->get_billadvancestudent_search_list();
                break;

            case ('get_student_search_list_for_reports'):
                $this->get_student_search_list_for_reports();
                break;
            case ('get_advancestudent_search_list_for_reports'):
                $this->get_advancestudent_search_list_for_reports();
                break;

            case ('get_advancestudent_search'):
                $this->get_advancestudent_search();
                break;
            case ('get_bill_batch_list'):
                $this->get_bill_batch_list();
                break;
                //            
                /*
             * @Author      :  docme
             * Purpose      : To search items details according to substore having stock
             * Created Date :  26-Dec-2017
             */

            case ('search_item_stock_for_allotment'):
                $this->search_item_stock_for_allotment();
                break;


                /*
             * @Author      :  DOCME
             * Purpose      :  Getting student search list
             * Created Date :  26-Dec-2017
             */

            case ('getstudent_profiledetails_search'):
                $this->getstudent_profiledetails_search();
                break;

                //Author Chandrajith
            case ('get_student_name_bill'):
                $this->get_student_name_bill();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  Registration 
             * Created Date :  28-dec-2017
             */
            case ('save_registration'):
                $this->save_registration();
                break;








                /*
             * @Author      :  DOCME
             * Purpose      :  Get dashboard details for substore
             * Created Date :  18-Jan-2018
             */
            case ('get_dashboard_details_count_substore'):
                $this->get_dashboard_details_count_substore();
                break;


                /*
             * @Author      :  DOCME
             * Purpose      :  Get dashboard details for substore graph
             * Created Date :  23-Jan-2018
             */
            case ('get_dashboard_details_graph_substore'):
                $this->get_dashboard_details_graph_substore();
                break;




                /*
             * @Author      :  DOCME
             * Purpose      :  Dashboard daily sales report 
             * Created Date :  31-Jan-2018
             */
            case ('dashboard_daily_sales'):
                $this->dashboard_daily_sales();
                break;



                /*
             * @Author      :  DOCME
             * Purpose      :  Dashboard packed but not delivered list 
             * Created Date :  03-Feb-2018
             */
            case ('dashboard_notBilled'):
                $this->dashboard_notBilled();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  Dashboard daily sales report 
             * Created Date :  03-Feb-2018
             */
            case ('dashboard_notdelivered'):
                $this->dashboard_notdelivered();
                break;





                /*
             * @Author      : docme
             * Purpose      :  To change user password
             * Created Date :  15-fev-2017
             */
            case ('change_user_password'):
                $this->change_user_password();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To save role 
             * Created Date :  15-fev-2017
             */
            case ('save_user_role'):
                $this->save_user_role();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  TO GET USER ACITIVITY
             * Created Date :  21-Feb-2018
             */
            case ('get_user_activity'):
                $this->get_user_activity();
                break;


                /*
             * @Author      :  DOCME
             * Purpose      :  TO GET USER ACITIVITY
             * Created Date :  21-Feb-2018
             */
            case ('get_user_activity'):
                $this->get_user_activity();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  TO SAVE NEW REGISTRATION (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('save_registration_RIMS'):
                $this->save_registration_RIMS();
                break;

                /*
             * @Author      :  FATHIMA SHAMNA
             * Purpose      :  TO UPDATE REGISTRATION (RIMS Integration)
             * Created Date :  10-JANUARY-2020
             */
            case ('RIMS_student_update_sync'):
                $this->RIMS_student_update_sync();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  TO CHANGE BATCH (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('std_batch_change_RIMS'):
                $this->std_batch_change_RIMS();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  TO SAVE NEW COUNTRY (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('save_country_RIMS'):
                $this->save_country_RIMS();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  TO SAVE NEW STATE (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('save_state_RIMS'):
                $this->save_state_RIMS();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  TO SAVE NEW RELIGION (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('save_religion_RIMS'):
                $this->save_religion_RIMS();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  TO SAVE NEW CASTE (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('save_caste_RIMS'):
                $this->save_caste_RIMS();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  TO SAVE NEW COMMUNITY (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('save_community_RIMS'):
                $this->save_community_RIMS();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  TO SAVE NEW CURRENCY (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('save_currency_RIMS'):
                $this->save_currency_RIMS();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  TO SAVE NEW PROFESSION (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('save_profession_RIMS'):
                $this->save_profession_RIMS();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  TO SAVE NEW LANGUAGE (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('save_language_RIMS'):
                $this->save_language_RIMS();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  TO SAVE NEW CITY (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('save_city_RIMS'):
                $this->save_city_RIMS();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  TO CHANGE STATUS STUDENT (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('std_status_change_RIMS'):
                $this->std_status_change_RIMS();
                break;
                /*
             * @Author      :  AJU S ARAVIND
             * Purpose      :  FOR AUTCOP INTEGRATION DATA PUSH
             * Created Date :  19-MARCH-2018
             */
            case ('data_push_for_auto_cop_integration'):
                $this->data_push_for_auto_cop_integration();
                break;

                /*
             * @Author      :  Chandrajith
             * Purpose      :  Saving roles
             * Created Date :  13-MARCH-2018
             */
            case ('save_roles'):
                $this->save_roles();
                break;
                /*
             * @Author      :  Chandrajith
             * Purpose      :  Updating roles
             * Created Date :  13-MARCH-2018
             */
            case ('update_roles'):
                $this->update_roles();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Getting Roles
             * Created Date :  13-MARCH-2018
             */
            case ('get_role_permission_of_user'):
                $this->get_role_permission_of_user();
                break;

                /*
             * @Author      :  Chandrajith
             * Purpose      :  Show available permissions
             * Created Date :  16-MARCH-2018
             */
            case ('available_permissions'):
                $this->available_permissions();
                break;


                /*
             * @Author      :  Chandrajith
             * Purpose      :  Getting primarydata for application
             * Created Date :  18-MARCH-2018
             */
            case ('primary_application_data'):
                $this->primary_application_data();
                break;

                /*
             * @Author      :  SALAHUDHEEN
             * Purpose      :  Getting Currency Details
             * Created Date :  03-JUNE-2019
             */
            case ('currency_data'):
                $this->currency_data();
                break;
                /*
             * Book - Sub Store API Start
             */

                /*
             * @Author      :  DOCME
             * Purpose      :  To save packing for student(loose packing)
             * Created Date :  27-Dec-2017
             */

            case ('save_packing_student'):
                $this->save_packing_student();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  To save packing for employee (specimen packing)
             * Created Date :  27-Dec-2017
             */

            case ('save_packing_faculty'):
                $this->save_packing_faculty();
                break;

            case ('get_student_pack'):
                $this->get_student_pack();
                break;

            case ('get_student_packdetailed'):
                $this->get_student_packdetailed();
                break;

                /*
             * @Author      :  Chandrajith
             * Purpose      :  Student Billing for substore 
             * Created Date :  02-jan-2018
             */
            case ('save_storecashbill'):
                $this->save_storecashbill();
                break;


                /*
             * @Author      :  DOCME
             * Purpose      :  To save delivery details 
             * Created Date :  02-Jan-2017
             */
            case ('save_delivery_student'):
                $this->save_delivery_student();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  To get pack details for delivery 
             * Created Date :  03-Jan-2017
             */
            case ('get_student_pack_delivery'):
                $this->get_student_pack_delivery();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  To get pack details for delivery on pack ID
             * Created Date :  03-Jan-2017
             */
            case ('packdetailed_delivery'):
                $this->packdetailed_delivery();
                break;


                /*
             * @Author      :  DOCME
             * Purpose      :  To get pack details for delivery on pack ID
             * Created Date :  04-Jan-2017
             */
            case ('replace_item_delivery'):
                $this->replace_item_delivery();
                break;



                /*
             * @Author      :  DOCME
             * Purpose      :  To save pack details for delivery replacement
             * Created Date :  05-Jan-2017
             */
            case ('save_delivery_item_replace'):
                $this->save_delivery_item_replace();
                break;


                /*
             * @Author      : docme
             * Purpose      :  To get oh template details 
             * Created Date :  03-Jan-2017
             */
            case ('get_ohtemplate'):
                $this->get_ohtemplate();
                break;

                /*
             * @Author      : docme
             * Purpose      :  To save oh template details 
             * Created Date :  03-Jan-2017
             */
            case ('save_oh_template'):
                $this->save_oh_template();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To edit oh template details 
             * Created Date :  03-Jan-2017
             */
            case ('edit_oh_template'):
                $this->edit_oh_template();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To save openhouse details 
             * Created Date :  04-Jan-2017
             */
            case ('save_openhouse'):
                $this->save_openhouse();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To list openhouse master details 
             * Created Date :  04-Jan-2017
             */

            case ('get_openhouse_master'):
                $this->get_openhouse_master();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To list openhouse_detail's details 
             * Created Date :  04-Jan-2017
             */
            case ('get_openhouse_detail'):
                $this->get_openhouse_detail();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To edit openhouse details 
             * Created Date :  04-Jan-2017
             */
            case ('edit_openhouse'):
                $this->edit_openhouse();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To delete openhouse details 
             * Created Date :  04-Jan-2017
             */
            case ('delete_openhouse'):
                $this->delete_openhouse();
                break;

                /*
             * @Author      : DOCME
             * Purpose      :  To search pack for billing  
             * Created Date :  08-Jan-2017
             */
            case ('search_student_pack_billing'):
                $this->search_student_pack_billing();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To save oh item assign
             * Created Date :  06-Jan-2017
             */
            case ('save_oh_item_assign'):
                $this->save_oh_item_assign();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To get open house and template data for oh stud assign
             * Created Date :  06-Jan-2017
             */
            case ('get_oh_stud_assign_data'):
                $this->get_oh_stud_assign_data();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To get item details for oh student assign
             * Created Date :  06-Jan-2017
             */
            case ('select_item_oh_stud_assign'):
                $this->select_item_oh_stud_assign();
                break;
                /*
             * @Author      : docme
             * Purpose      : TO get student details for oh assign
             * Created Date :  10-Jan-2017
             */
            case ('get_stud_for_ohassign'):
                $this->get_stud_for_ohassign();
                break;
                /*
             * @Author      : docme
             * Purpose      : TO save student details wiith oh item assign
             * Created Date :  10-Jan-2017
             */
            case ('save_oh_student_assign'):
                $this->save_oh_student_assign();
                break;
                /*
             * @Author      : DOCME
             * Purpose      :  For Getting pack details for delivery return 
             * Created Date :  11-Jan-2017
             */
            case ('get_student_pack_deliveryReturn'):
                $this->get_student_pack_deliveryReturn();
                break;

                /*
             * @Author      : DOCME
             * Purpose      :  To save Delivery return
             * Created Date :  12-Jan-2017
             */
            case ('save_deliveryReturn_student'):
                $this->save_deliveryReturn_student();
                break;

                /*
             * @Author      : DOCME
             * Purpose      :  To get pack details for delivery  faculty
             * Created Date :  15-Jan-2017
             */
            case ('get_faculty_pack_delivery'):
                $this->get_faculty_pack_delivery();
                break;

                /*
             * @Author      : docme
             * Purpose      :  For Getting pack details for delivery return 
             * Created Date :  16-Jan-2017
             */
            case ('get_faculty_pack_deliveryReturn'):
                $this->get_faculty_pack_deliveryReturn();
                break;

                /*
             * @Author      : docme
             * Purpose      :  To save Delivery return faculty
             * Created Date :  16-Jan-2017
             */
            case ('save_deliveryReturn_faculty'):
                $this->save_deliveryReturn_faculty();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  Sales delivery return save
             * Created Date :  16-Jan-2018
             */
            case ('sales_delivery_return_save_OH'):
                $this->sales_delivery_return_save_OH();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  Sales delivery return save
             * Created Date :  17-Jan-2018
             */
            case ('get_student_voucher_search_delivery'):
                $this->get_student_voucher_search_delivery();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  Get stock allotment list of substore
             * Created Date :  18-Jan-2018
             */
            case ('get_stock_allotment_list_substore'):
                $this->get_stock_allotment_list_substore();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  get allotment from sub store
             * Created Date :  07-Feb-2018
             */
            case ('get_stock_allotment_list_substore_out'):
                $this->get_stock_allotment_list_substore_out();
                break;

                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale report data
             * Created Date :  22-Jan-2018
             */
            case ('substore_sale_return_report'):
                $this->substore_sale_return_report();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale report data
             * Created Date :  22-Jan-2018
             */
            case ('substore_sale_voucher_wise_report'):
                $this->substore_sale_voucher_wise_report();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale report data
             * Created Date :  22-Jan-2018
             */
            case ('substore_sale_item_wise_report'):
                $this->substore_sale_item_wise_report();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale report data
             * Created Date :  22-Jan-2018
             */
            case ('substore_sale_item_wise_summary_report'):
                $this->substore_sale_item_wise_summary_report();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale report data - billed but not delivered
             * Created Date :  22-Jan-2018
             */
            case ('substore_billed_but_not_delivered_item_wise_summary_report'):
                $this->substore_billed_but_not_delivered_item_wise_summary_report();
                break;
                /*
             * @Author      :  docme
             * Purpose      : Voucher search for faculty
             * Created Date :  25-Jan-2018
             */
            case ('voucher_search_faculty'):
                $this->voucher_search_faculty();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale collection data
             * Created Date :  26-Jan-2018
             */
            case ('substore_collection_report'):
                $this->substore_collection_report();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale collection data user wise
             * Created Date :  26-Jan-2018
             */
            case ('substore_collection_report_user_wise'):
                $this->substore_collection_report_user_wise();
                break;
                /*
             * @Author      :  Fathima Shamna
             * Purpose      :  Get substore summary collection data user wise
             * Created Date :  04-Oct-2019
             */
            case ('substore_summary_collection_report_user_wise'):
                $this->substore_summary_collection_report_user_wise();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get print detailsof bill
             * Created Date :  26-Jan-2018
             */
            case ('bill_print_data'):
                $this->bill_print_data();
                break;
                /*
             * @Author      :  Fathima Shamna
             * Purpose      :  Get bill type
             * Created Date :  10-Mar-2020
             */
            case ('get_bill_type'):
                $this->get_bill_type();
                break;

                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get stock report data for report
             * Created Date :  26-Jan-2018
             */
            case ('get_all_stock_report_data_substore'):
                $this->get_all_stock_report_data_substore();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  Get Store settings graph details for substore 
             * Created Date :  31-Jan-2018
             */
            case ('get_graph_substore_settings'):
                $this->get_graph_substore_settings();
                break;

            case ('get_current_stock_list_report_substore'):
                $this->get_current_stock_list_report_substore();
                break;
                /*
             * @Author      :  docme
             * Purpose      : List Openhouse with student id
             * Created Date :  2-2-2018
             */
            case ('get_student_openhouse'):
                $this->get_student_openhouse();
                break;

                /*
             * @Author      : docme
             * Purpose      : TO remove student details from openhouse
             *  Created Date :  2-2-2018
             */
            case ('remove_oh_student_assign'):
                $this->remove_oh_student_assign();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  save allotment from sub store
             * Created Date :  07-Feb-2018
             */
            case ('save_Stock_allotment_sub_out'):
                $this->save_Stock_allotment_sub_out();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  edit allotment from sub store
             * Created Date :  07-Feb-2018
             */
            case ('save_edit_allotment_out'):
                $this->save_edit_allotment_out();
                break;

                /*
             * @Author      : docme
             * Purpose      :  To new template to openhouse details 
             * Created Date :  15-fev-2017
             */
            case ('add_new_temp_openhouse'):
                $this->add_new_temp_openhouse();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To get delivery details for delivery note print out
             * Created Date :  12-Feb-2018
             */
            case ('get_delivery_note_print_data'):
                $this->get_delivery_note_print_data();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  To save details of bill cancel
             * Created Date :  20-Feb-2018
             */
            case ('bill_cancel'):
                $this->bill_cancel();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  TO CHECK OPENHOUSE DISCOUNT
             * Created Date :  26-Feb-2018
             */
            case ('get_openhouse_discount'):
                $this->get_openhouse_discount();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  TO GET STOCK ALL FOR SUBSTORE
             * Created Date :  15-MARCH-2018
             */

            case ('get_stock_for_packing_substore'):

                $this->get_stock_for_packing_substore();
                break;


                /*
             * @Author      :  DOCME
             * Purpose      :  TO SEARCH STOCK ALL FOR SUBSTORE
             * Created Date :  15-MARCH-2018
             */

            case ('search_item_stock_for_substore'):

                $this->search_item_stock_for_substore();
                break;

                /*
             * Book - Sub Store API End
             */


                /*
             * Uniform - Sub Store API Start
             */


                /*
             * @Author      :  DOCME
             * Purpose      :  To save packing for student(loose packing)
             * Created Date :  27-Dec-2017
             */

            case ('uniform_save_packing_student'):
                $this->uniform_save_packing_student();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  To save packing for employee (specimen packing)
             * Created Date :  27-Dec-2017
             */

            case ('uniform_save_packing_faculty'):
                $this->uniform_save_packing_faculty();
                break;

            case ('uniform_get_student_pack'):
                $this->uniform_get_student_pack();
                break;

            case ('uniform_get_student_packdetailed'):
                $this->uniform_get_student_packdetailed();
                break;

                /*
             * @Author      :  Chandrajith
             * Purpose      :  Student Billing for substore 
             * Created Date :  02-jan-2018
             */
            case ('uniform_save_storecashbill'):
                $this->uniform_save_storecashbill();
                break;


                /*
             * @Author      :  DOCME
             * Purpose      :  To save delivery details 
             * Created Date :  02-Jan-2017
             */
            case ('uniform_save_delivery_student'):
                $this->uniform_save_delivery_student();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  To get pack details for delivery 
             * Created Date :  03-Jan-2017
             */
            case ('uniform_get_student_pack_delivery'):
                $this->uniform_get_student_pack_delivery();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  To get pack details for delivery on pack ID
             * Created Date :  03-Jan-2017
             */
            case ('uniform_packdetailed_delivery'):
                $this->uniform_packdetailed_delivery();
                break;


                /*
             * @Author      :  DOCME
             * Purpose      :  To get pack details for delivery on pack ID
             * Created Date :  04-Jan-2017
             */
            case ('uniform_replace_item_delivery'):
                $this->uniform_replace_item_delivery();
                break;



                /*
             * @Author      :  DOCME
             * Purpose      :  To save pack details for delivery replacement
             * Created Date :  05-Jan-2017
             */
            case ('uniform_save_delivery_item_replace'):
                $this->uniform_save_delivery_item_replace();
                break;


                /*
             * @Author      : docme
             * Purpose      :  To get oh template details 
             * Created Date :  03-Jan-2017
             */
            case ('uniform_get_ohtemplate'):
                $this->uniform_get_ohtemplate();
                break;

                /*
             * @Author      : docme
             * Purpose      :  To save oh template details 
             * Created Date :  03-Jan-2017
             */
            case ('uniform_save_oh_template'):
                $this->uniform_save_oh_template();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To edit oh template details 
             * Created Date :  03-Jan-2017
             */
            case ('uniform_edit_oh_template'):
                $this->uniform_edit_oh_template();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To save openhouse details 
             * Created Date :  04-Jan-2017
             */
            case ('uniform_save_openhouse'):
                $this->uniform_save_openhouse();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To list openhouse master details 
             * Created Date :  04-Jan-2017
             */

            case ('uniform_get_openhouse_master'):
                $this->uniform_get_openhouse_master();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To list openhouse_detail's details 
             * Created Date :  04-Jan-2017
             */
            case ('uniform_get_openhouse_detail'):
                $this->uniform_get_openhouse_detail();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To edit openhouse details 
             * Created Date :  04-Jan-2017
             */
            case ('uniform_edit_openhouse'):
                $this->uniform_edit_openhouse();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To delete openhouse details 
             * Created Date :  04-Jan-2017
             */
            case ('uniform_delete_openhouse'):
                $this->uniform_delete_openhouse();
                break;

                /*
             * @Author      : DOCME
             * Purpose      :  To search pack for billing  
             * Created Date :  08-Jan-2017
             */
            case ('uniform_search_student_pack_billing'):
                $this->uniform_search_student_pack_billing();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To save oh item assign
             * Created Date :  06-Jan-2017
             */
            case ('uniform_save_oh_item_assign'):
                $this->uniform_save_oh_item_assign();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To get open house and template data for oh stud assign
             * Created Date :  06-Jan-2017
             */
            case ('uniform_get_oh_stud_assign_data'):
                $this->uniform_get_oh_stud_assign_data();
                break;
                /*
             * @Author      : docme
             * Purpose      :  To get item details for oh student assign
             * Created Date :  06-Jan-2017
             */
            case ('uniform_select_item_oh_stud_assign'):
                $this->uniform_select_item_oh_stud_assign();
                break;
                /*
             * @Author      : docme
             * Purpose      : TO get student details for oh assign
             * Created Date :  10-Jan-2017
             */
            case ('uniform_get_stud_for_ohassign'):
                $this->uniform_get_stud_for_ohassign();
                break;
                /*
             * @Author      : docme
             * Purpose      : TO save student details wiith oh item assign
             * Created Date :  10-Jan-2017
             */
            case ('uniform_save_oh_student_assign'):
                $this->uniform_save_oh_student_assign();
                break;
                /*
             * @Author      : DOCME
             * Purpose      :  For Getting pack details for delivery return 
             * Created Date :  11-Jan-2017
             */
            case ('uniform_get_student_pack_deliveryReturn'):
                $this->uniform_get_student_pack_deliveryReturn();
                break;

                /*
             * @Author      : DOCME
             * Purpose      :  To save Delivery return
             * Created Date :  12-Jan-2017
             */
            case ('uniform_save_deliveryReturn_student'):
                $this->uniform_save_deliveryReturn_student();
                break;

                /*
             * @Author      : DOCME
             * Purpose      :  To get pack details for delivery  faculty
             * Created Date :  15-Jan-2017
             */
            case ('uniform_get_faculty_pack_delivery'):
                $this->uniform_get_faculty_pack_delivery();
                break;

                /*
             * @Author      : docme
             * Purpose      :  For Getting pack details for delivery return 
             * Created Date :  16-Jan-2017
             */
            case ('uniform_get_faculty_pack_deliveryReturn'):
                $this->uniform_get_faculty_pack_deliveryReturn();
                break;

                /*
             * @Author      : docme
             * Purpose      :  To save Delivery return faculty
             * Created Date :  16-Jan-2017
             */
            case ('uniform_save_deliveryReturn_faculty'):
                $this->uniform_save_deliveryReturn_faculty();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  Sales delivery return save
             * Created Date :  16-Jan-2018
             */
            case ('uniform_sales_delivery_return_save_OH'):
                $this->uniform_sales_delivery_return_save_OH();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  Sales delivery return save
             * Created Date :  17-Jan-2018
             */
            case ('uniform_get_student_voucher_search_delivery'):
                $this->uniform_get_student_voucher_search_delivery();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  Get stock allotment list of substore
             * Created Date :  18-Jan-2018
             */
            case ('uniform_get_stock_allotment_list_substore'):
                $this->uniform_get_stock_allotment_list_substore();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  get allotment from sub store
             * Created Date :  07-Feb-2018
             */
            case ('uniform_get_stock_allotment_list_substore_out'):
                $this->uniform_get_stock_allotment_list_substore_out();
                break;

                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale report data
             * Created Date :  22-Jan-2018
             */
            case ('uniform_substore_sale_return_report'):
                $this->uniform_substore_sale_return_report();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale report data
             * Created Date :  22-Jan-2018
             */
            case ('uniform_substore_sale_voucher_wise_report'):
                $this->uniform_substore_sale_voucher_wise_report();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale report data
             * Created Date :  22-Jan-2018
             */
            case ('uniform_substore_sale_item_wise_report'):
                $this->uniform_substore_sale_item_wise_report();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale report data
             * Created Date :  22-Jan-2018
             */
            case ('uniform_substore_sale_item_wise_summary_report'):
                $this->uniform_substore_sale_item_wise_summary_report();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale report data - billed but not delivered
             * Created Date :  22-Jan-2018
             */
            case ('uniform_substore_billed_but_not_delivered_item_wise_summary_report'):
                $this->uniform_substore_billed_but_not_delivered_item_wise_summary_report();
                break;
                /*
             * @Author      :  docme
             * Purpose      : Voucher search for faculty
             * Created Date :  25-Jan-2018
             */
            case ('uniform_voucher_search_faculty'):
                $this->uniform_voucher_search_faculty();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale collection data
             * Created Date :  26-Jan-2018
             */
            case ('uniform_substore_collection_report'):
                $this->uniform_substore_collection_report();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get sale collection data user wise
             * Created Date :  26-Jan-2018
             */
            case ('uniform_substore_collection_report_user_wise'):
                $this->uniform_substore_collection_report_user_wise();
                break;
                /*
             * @Author      :  FATHIMA SHAMNA
             * Purpose      :  Get sale summary collection data user wise
             * Created Date :  07-Oct-2019
             */
            case ('uniform_substore_summary_collection_report_user_wise'):
                $this->uniform_substore_summary_collection_report_user_wise();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get print detailsof bill
             * Created Date :  26-Jan-2018
             */
            case ('uniform_bill_print_data'):
                $this->uniform_bill_print_data();
                break;

                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  Get stock report data for report
             * Created Date :  26-Jan-2018
             */
            case ('uniform_get_all_stock_report_data_substore'):
                $this->uniform_get_all_stock_report_data_substore();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  Get Store settings graph details for substore 
             * Created Date :  31-Jan-2018
             */
            case ('uniform_get_graph_substore_settings'):
                $this->uniform_get_graph_substore_settings();
                break;

            case ('uniform_get_current_stock_list_report_substore'):
                $this->uniform_get_current_stock_list_report_substore();
                break;
                /*
             * @Author      :  docme
             * Purpose      : List Openhouse with student id
             * Created Date :  2-2-2018
             */
            case ('uniform_get_student_openhouse'):
                $this->uniform_get_student_openhouse();
                break;

                /*
             * @Author      : docme
             * Purpose      : TO remove student details from openhouse
             *  Created Date :  2-2-2018
             */
            case ('uniform_remove_oh_student_assign'):
                $this->uniform_remove_oh_student_assign();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  save allotment from sub store
             * Created Date :  07-Feb-2018
             */
            case ('uniform_save_Stock_allotment_sub_out'):
                $this->uniform_save_Stock_allotment_sub_out();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  edit allotment from sub store
             * Created Date :  07-Feb-2018
             */
            case ('uniform_save_edit_allotment_out'):
                $this->uniform_save_edit_allotment_out();
                break;

                /*
             * @Author      : docme
             * Purpose      :  To new template to openhouse details 
             * Created Date :  15-fev-2017
             */
            case ('uniform_add_new_temp_openhouse'):
                $this->uniform_add_new_temp_openhouse();
                break;
                /*
             * @Author      :  Aju S Aravind
             * Purpose      :  To get delivery details for delivery note print out
             * Created Date :  12-Feb-2018
             */
            case ('uniform_get_delivery_note_print_data'):
                $this->uniform_get_delivery_note_print_data();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  To save details of bill cancel
             * Created Date :  20-Feb-2018
             */
            case ('uniform_bill_cancel'):
                $this->uniform_bill_cancel();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  TO CHECK OPENHOUSE DISCOUNT
             * Created Date :  26-Feb-2018
             */
            case ('uniform_get_openhouse_discount'):
                $this->uniform_get_openhouse_discount();
                break;

                /*
             * @Author      :  DOCME
             * Purpose      :  TO GET STOCK ALL FOR SUBSTORE
             * Created Date :  15-MARCH-2018
             */

            case ('uniform_get_stock_for_packing_substore'):

                $this->uniform_get_stock_for_packing_substore();
                break;


                /*
             * @Author      :  DOCME
             * Purpose      :  TO SEARCH STOCK ALL FOR SUBSTORE
             * Created Date :  15-MARCH-2018
             */

            case ('uniform_search_item_stock_for_substore'):

                $this->uniform_search_item_stock_for_substore();
                break;

                /*
             * Dashboard 
             */
            case ('uniform_get_dashboard_details_count_substore'):

                $this->uniform_get_dashboard_details_count_substore();
                break;

            case ('uniform_dashboard_daily_sales'):
                $this->uniform_dashboard_daily_sales();
                break;
            case ('uniform_dashboard_notdelivered'):
                $this->uniform_dashboard_notdelivered();
                break;
            case ('uniform_get_dashboard_details_graph_substore'):
                $this->uniform_get_dashboard_details_graph_substore();
                break;
            case ('uniform_dashboard_notBilled'):
                $this->uniform_dashboard_notBilled();
                break;


                /*
             * Uniform - Sub Store API End
             */



                /*
             * @Author      :  DOCME
             * Purpose      :  TO DOWNLOAD ACT TRANSACTIONS (RIMS Integration)
             * Created Date :  20-MARCH-2018
             */
            case ('act_transaction_download_RIMS'):
                $this->act_transaction_download_RIMS();
                break;
                /*
             * @Author      :  DOCME
             * Purpose      :  UPDATE DOWNLOAD ACT TRANSACTIONS (RIMS Integration)
             * Created Date :  20-MARCH-2018
             */
            case ('act_transaction_download_update_RIMS'):
                $this->act_transaction_download_update_RIMS();
                break;
                /*
             * @Author      :  AJU S ARAVIND
             * Purpose      :  UPDATE DOWNLOAD ACT TRANSACTIONS (RIMS Integration)
             * Created Date :  20-MARCH-2018
             */
            case ('RIMS_update_settings'):
                $this->RIMS_update_settings();
                break;

                /*
             * @Author      :  AJU S ARAVIND
             * Purpose      :  TO SAVE NEW REGISTRATION (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('RIMS_student_registration'):
                $this->RIMS_student_registration();
                break;
                /*
             * @Author      :  FATHIMA SHAMNA
             * Purpose      :  TO SAVE  REGISTRATION OF LONG ABSENTEE (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('RIMS_Longab_student_registration'):
                $this->RIMS_Longab_student_registration();
                break;
                /*
             * @Author      :  FATHIMA SHAMNA
             * Purpose      :  TO SAVE PARENT REGISTRATION (RIMS Integration)
             * Created Date :  30-MAY-2019
             */
            case ('RIMS_parent_registration'):
                $this->RIMS_parent_registration();
                break;

                /*
             * @Author      :  FATHIMA SHAMNA
             * Purpose      :  TO SAVE PARENT ADDRESS REGISTRATION (RIMS Integration)
             * Created Date :  30-MAY-2019
             */
            case ('RIMS_address_registration'):
                $this->RIMS_address_registration();
                break;
                /*
             * @Author      :  AJU S ARAVIND
             * Purpose      :  TO SAVE NEW DESIGNATION (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('RIMS_emp_designation'):
                $this->RIMS_emp_designation();
                break;
                /*
             * @Author      :  AJU S ARAVIND
             * Purpose      :  TO SAVE NEW DEPARTMENT (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('RIMS_emp_department'):
                $this->RIMS_emp_department();
                break;
                /*
             * @Author      :  AJU S ARAVIND
             * Purpose      :  TO SAVE NEW DEPARTMENT (RIMS Integration)
             * Created Date :  09-MARCH-2018
             */
            case ('RIMS_emp_master'):
                $this->RIMS_emp_master();
                break;
                /*
             * @Author      :  FATHIMA SHAMNA
             * Purpose      :  TO SAVE NEW VEHICLE TYPE (RIMS Integration)
             * Created Date :  05-JULY-2019
             */
            case ('RIMS_transport_dataporting'):
                $this->RIMS_transport_dataporting();
                break;
                /*
             * @Author      :  FATHIMA SHAMNA
             * Purpose      :  TO SAVE NEW VEHICLE REGISTRATION (RIMS Integration)
             * Created Date :  06-JULY-2019
             
            case ('RIMS_transport_reg_dataporting') :
                $this->RIMS_transport_reg_dataporting();
                break;  
             /*
             * @Author      :  FATHIMA SHAMNA
             * Purpose      :  TO SAVE FUEL PRICE DATA (RIMS Integration)
             * Created Date :  07-JULY-2019
             
            
            case ('RIMS_fuelprice_dataporting') :
                $this->RIMS_fuelprice_dataporting();
                break;  
            /*
             * @Author      :  FATHIMA SHAMNA
             * Purpose      :  TO SAVE FUEL LOGBOOK (RIMS Integration)
             * Created Date :  09-JULY-2019
             
        
            case ('RIMS_fuellogbook_dataporting') :
                $this->RIMS_fuellogbook_dataporting();
                break; 
            /*
             * @Author      :  FATHIMA SHAMNA
             * Purpose      :  TO SAVE TRIP DATA(RIMS Integration)
             * Created Date :  10-JULY-2019
             
            
            case ('RIMS_trip_dataporting') :
                $this->RIMS_trip_dataporting();
                break;    
                
                /*
             * @Author      :  FATHIMA SHAMNA
             * Purpose      :  TO SAVE PICKUPOINT DATA(RIMS Integration)
             * Created Date :  11-JULY-2019
             
            
            case ('RIMS_pickup_point_dataporting') :
                $this->RIMS_pickup_point_dataporting();
                break;  
/*
             * @Author      :  FATHIMA SHAMNA
             * Purpose      :  TO GET THE PRIORITY OF STUDENTS
             * Created Date :  05-AUG-2019
             */
            case ('RIMS_student_priority_data'):
                $this->RIMS_student_priority_data();
                break;

                /*
             * @Author      :  AJU S ARAVIND
             * Purpose      :  To get student details with the UUID
             * Created Date :  27-JAN-2019
             */


            case ('get_uuid_student_data'):
                $this->get_uuid_student_data();
                break;
            case ('get_f_uuid_parent_data'):
                $this->get_f_uuid_parent_data();
                break;
            case ('get_m_uuid_parent_data'):
                $this->get_m_uuid_parent_data();
                break;
            case ('get_g_uuid_parent_data'):
                $this->get_g_uuid_parent_data();
                break;

                /*
             * @Author      :  Aju S Aravind 
             * Purpose      :  Registration academic details saving purpose
             * Created Date :  10-Oct-2017
             */
            case ('getdetails_student_for_online_pay'):
                $this->getdetails_student_for_online_pay();
                break;
                /*
             * @Author      :  Aju S Aravind 
             * Purpose      :  Registration academic details saving purpose
             * Created Date :  10-Oct-2017
             */
            case ('getdetails_student_by_id_for_online_pay'):
                $this->getdetails_student_by_id_for_online_pay();
                break;

                /*             * ********************************************************************************************************************
              ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ FEES-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞
              /******************************************************************************************************************* */
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get account code
             * Created Date :  11-July-2018
             */
            case ('get_accountcode'):
                $this->get_accountcode();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO Save account code
             * Created Date :  12-July-2018
             */
            case ('save_accountcode'):
                $this->save_accountcode();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update account code
             * Created Date :  12-July-2018
             */
            case ('update_accountcode'):
                $this->update_accountcode();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO change the status of the account code
             * Created Date :  12-July-2018
             */
            case ('status_accountcode'):
                $this->status_accountcode();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the feetypes
             * Created Date :  12-July-2018
             */
            case ('get_feetype'):
                $this->get_feetype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO Save the feetypes
             * Created Date :  12-July-2018
             */
            case ('save_feetype'):
                $this->save_feetype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the feetypes
             * Created Date :  12-July-2018
             */
            case ('update_feetype'):
                $this->update_feetype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the feetypes
             * Created Date :  12-July-2018
             */
            case ('modify_feetype_status'):
                $this->modify_feetype_status();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      :  TO get the demand frequency
             * Created Date :  26-July-2018
             */
            case ('get_demand_frequency'):
                $this->get_demand_frequency();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO save demand frequency
             * Created Date : 26-July-2018
             */
            case ('save_demand_frequency'):
                $this->save_demand_frequency();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO update the demand frequency
             * Created Date : 26-July-2018
             */
            case ('update_demand_frequency'):
                $this->update_demand_frequency();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO update the status of demand frequency
             * Created Date : 26-July-2018
             */
            case ('modify_demand_frequency_status'):
                $this->modify_demand_frequency_status();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO get the fee code
             * Created Date :  31-July-2018
             */
            case ('get_fee_code'):
                $this->get_fee_code();
                break;
            case ('get_linked_fee_code'):
                $this->get_linked_fee_code();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO save fee code
             * Created Date : 31-July-2018
             */
            case ('save_fee_code'):
                $this->save_fee_code();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO update the fee code
             * Created Date : 31-July-2018
             */
            case ('update_fee_code'):
                $this->update_fee_code();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO update the status of fee code
             * Created Date : 31-July-2018
             */
            case ('modify_fee_code_status'):
                $this->modify_fee_code_status();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO update the status of fee code
             * Created Date : 31-July-2018
             */
            case ('approve_fee_code'):
                $this->approve_fee_code();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO get the fee code
             * Created Date :  31-July-2018
             */
            case ('get_demand_type'):
                $this->get_demand_type();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO get the fee template list
             * Created Date : 16-Aug-2018
             */
            case ('get_fee_template'):
                $this->get_fee_template();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO save fee template
             * Created Date : 16-Aug-2018
             */
            case ('save_fee_template'):
                $this->save_fee_template();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO edit fee template
             * Created Date : 16-Aug-2018
             */
            case ('save_edit_fee_template'):
                $this->save_edit_fee_template();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO delete fee template
             * Created Date : 16-Aug-2018
             */
            case ('delete_fee_template'):
                $this->delete_fee_template();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : TO get fee code linked with template
             * Created Date : 25-Aug-2018
             */
            case ('fee_code_linked_with_template'):
                $this->fee_code_linked_with_template();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get fee code not linked with template
             * Created Date : 25-Aug-2018
             */
            case ('fee_code_not_linked_to_template'):
                $this->fee_code_not_linked_to_template();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get fee code not linked with template
             * Created Date : 25-Aug-2018
             */
            case ('save_fee_code_to_template'):
                $this->save_fee_code_to_template();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get class details linked with fees template
             * Created Date : 29-Aug-2018
             */
            case ('get_class_details_with_linked_template'):
                $this->get_class_details_with_linked_template();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get batch details linked with fees template
             * Created Date : 29-Aug-2018
             */
            case ('get_batch_details_with_linked_template'):
                $this->get_batch_details_with_linked_template();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get student details for fees template allocation
             * Created Date : 29-Aug-2018
             */
            case ('get_students_for_fee_template_allocation'):
                $this->get_students_for_fee_template_allocation();
                break;
            case ('check_other_fee_code_demanded'):
                $this->check_other_fee_code_demanded();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get student details for fees template allocation
             * Created Date : 30-Aug-2018
             */
            case ('save_periodic_fee_allocation_with_students'):
                $this->save_periodic_fee_allocation_with_students();
                break;
            case ('get_bus_fee_demanded_details'):
                $this->get_bus_fee_demanded_details();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get student list assigned with templates
             * Created Date : 04-Sep-2018
             */
            case ('get_student_list_with_fee_allocated'):
                $this->get_student_list_with_fee_allocated();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get student list assigned with templates
             * Created Date : 04-Sep-2018
             */
            case ('save_de_allocation_of_students_from_template'):
                $this->save_de_allocation_of_students_from_template();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To allocate students with non demandable fees
             * Created Date : 04-Sep-2018
             */
            case ('save_other_fee_allocation'):
                $this->save_other_fee_allocation();
                break;
            case ('save_other_fee_allocation_classwise'):
                $this->save_other_fee_allocation_classwise();
                break;

                //FEE EXEMPTION
            case ('get_all_feecodes_available'):
                $this->get_all_feecodes_available();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get student data for collection
             * Created Date : 04-Sep-2018
             */
            case ('get_student_fee_data_for_collection'):
                $this->get_student_fee_data_for_collection();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save student data for collection
             * Created Date : 04-Sep-2018
             */
            case ('save_fee_payment_for_student'):
                $this->save_fee_payment_for_student();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save student E WALLET amount to student account by cash
             * Created Date : 04-Sep-2018
             */
            case ('save_wallet_amount_for_student_bycash'):
                $this->save_wallet_amount_for_student_bycash();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get base data for cheque reconcile
             * Created Date : 11-Oct-2018
             */
            case ('get_base_data_for_cheque_reconcile'):
                $this->get_base_data_for_cheque_reconcile();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save recon status of cheque
             * Created Date : 11-Oct-2018
             */
            case ('save_recon_status_of_cheque'):
                $this->save_recon_status_of_cheque();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get blacklisted students data
             * Created Date : 22-Oct-2018
             */
            case ('get_black_listed_students'):
                $this->get_black_listed_students();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get blacklisted students data
             * Created Date : 22-Oct-2018
             */
            case ('save_blacklist_release'):
                $this->save_blacklist_release();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save student E WALLET amount to student account by cheque
             * Created Date : 22-Oct-2018
             */
            case ('save_wallet_amount_for_student_bycheque'):
                $this->save_wallet_amount_for_student_bycheque();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save student E WALLET amount to student account by card
             * Created Date : 22-Oct-2018
             */
            case ('save_wallet_amount_for_student_bycard'):
                $this->save_wallet_amount_for_student_bycard();
                break;
            case ('save_wallet_amount_for_student_bydbt'):
                $this->save_wallet_amount_for_student_bydbt();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get account details for the  student
             * Created Date : 24-Oct-2018
             */
            case ('get_student_account_data'):
                $this->get_student_account_data();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get payback details for the  student
             * Created Date : 24-Oct-2018
             */
            case ('get_payback_data'):
                $this->get_payback_data();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get voucher details for payback details for the  student
             * Created Date : 24-Oct-2018
             */
            case ('get_vouchers_for_payback'):
                $this->get_vouchers_for_payback();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get voucher details with fee code for payback details for the  student
             * Created Date : 24-Oct-2018
             */
            case ('get_vouchers_details_for_payback'):
                $this->get_vouchers_details_for_payback();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get wallet summary data for student
             * Created Date : 24-Oct-2018
             */
            case ('get_student_wallet_data_for_summary'):
                $this->get_student_wallet_data_for_summary();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get withdraw request data summary for a student
             * Created Date : 29-Oct-2018
             */
            case ('get_withdraw_request_list_data_summary'):
                $this->get_withdraw_request_list_data_summary();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save withdraw request data summary for a student
             * Created Date : 30-Oct-2018
             */
            case ('save_withdraw_request'):
                $this->save_withdraw_request();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get approval of withdraw request data summary for a student
             * Created Date : 30-Oct-2018
             */
            case ('get_approve_data_for_wallet_withdraw'):
                $this->get_approve_data_for_wallet_withdraw();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save approval of withdraw request data summary for a student
             * Created Date : 30-Oct-2018
             */
            case ('save_withdraw_approval'):
                $this->save_withdraw_approval();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To encash withdraw request data summary for a student
             * Created Date : 30-Oct-2018
             */
            case ('get_encashment_data_for_wallet_withdraw'):
                $this->get_encashment_data_for_wallet_withdraw();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To encash withdraw for a student by cash
             * Created Date : 30-Oct-2018
             */
            case ('save_withdrawal_encashment_bycash'):
                $this->save_withdrawal_encashment_bycash();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To encash withdraw for a student by cheque
             * Created Date : 30-Oct-2018
             */
            case ('save_withdrawal_encashment_bycheque'):
                $this->save_withdrawal_encashment_bycheque();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To view withdraw for a student 
             * Created Date : 31-Oct-2018
             */
            case ('get_view_data_for_wallet_withdrawal'):
                $this->get_view_data_for_wallet_withdrawal();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save payback request
             * Created Date : 02-Nov-2018
             */
            case ('save_payback_request'):
                $this->save_payback_request();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To show payback approval data
             * Created Date : 02-Nov-2018
             */
            case ('get_payback_data_for_approval'):
                $this->get_payback_data_for_approval();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To show payback view data
             * Created Date : 02-Nov-2018
             */
            case ('get_payback_data_for_view'):
                $this->get_payback_data_for_view();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save payback approval data
             * Created Date : 04-Nov-2018
             */
            case ('save_payback_approval'):
                $this->save_payback_approval();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get priority information
             * Created Date : 04-Nov-2018
             */
            case ('get_priority_information'):
                $this->get_priority_information();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get priority information
             * Created Date : 07-Nov-2018
             */
            case ('get_priority_information_fee_code_manage'):
                $this->get_priority_information_fee_code_manage();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save priority information
             * Created Date : 09-Nov-2018
             */
            case ('save_feecodes_for_student_priority_management'):
                $this->save_feecodes_for_student_priority_management();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get priority information for staff
             * Created Date : 09-Nov-2018
             */
            case ('get_priority_information_for_staff'):
                $this->get_priority_information_for_staff();
                break;

                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get priority information for staff
             * Created Date : 07-Nov-2018
             */
            case ('get_priority_information_fee_code_manage_for_staff'):
                $this->get_priority_information_fee_code_manage_for_staff();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save priority information for staff
             * Created Date : 07-Nov-2018
             */
            case ('save_feecodes_for_staff_priority_management'):
                $this->save_feecodes_for_staff_priority_management();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get voucher cancellation data
             * Created Date : 21-Nov-2018
             */
            case ('get_data_for_voucher_cancellation'):
                $this->get_data_for_voucher_cancellation();
                break;

            case ('get_data_for_voucher_reprint'):
                $this->get_data_for_voucher_reprint();
                break;
            case ('get_voucher_types'):
                $this->get_voucher_types();
                break;
            case ('get_voucher_search'):
                $this->get_voucher_search();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get voucher cancellation data to voucher id
             * Created Date : 21-Nov-2018
             */
            case ('get_data_for_voucher_cancellation_data_by_voucher_id'):
                $this->get_data_for_voucher_cancellation_data_by_voucher_id();
                break;
            case ('get_voucher_data_by_id_for_reprint'):
                $this->get_voucher_data_by_id_for_reprint();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save voucher cancellation data of voucher id
             * Created Date : 21-Nov-2018
             */
            case ('save_voucher_cancel'):
                $this->save_voucher_cancel();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save voucher cancellation data of voucher id
             * Created Date : 21-Nov-2018
             */
            case ('save_demanded_bus_fee'):
                $this->save_demanded_bus_fee();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save voucher cancellation data of voucher id
             * Created Date : 21-Nov-2018
             */
            case ('get_counter_collection_data'):
                $this->get_counter_collection_data();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get student list for arrear data
             * Created Date : 21-Nov-2018
             */
            case ('get_students_for_arrear_listing'):
                $this->get_students_for_arrear_listing();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save student list for arrear data
             * Created Date : 21-Nov-2018
             */
            case ('save_arrear_data'):
                $this->save_arrear_data();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get voucher wise collection report
             * Created Date : 05-Feb-2019
             */
            case ('get-voucher-wise-collection-report'):
                $this->get_voucher_wise_collection_report();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get voucher wise collection report
             * Created Date : 05-Feb-2019
             */
            case ('get-received-non-demandable-report'):
                $this->get_received_non_demandable_report();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get voucher and student wise collection report
             * Created Date : 05-Feb-2019
             */
            case ('get-individual-collectio-voucher-wise-report'):
                $this->get_individual_collection_report();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get collection class wise report
             * Created Date : 05-Feb-2019
             */
            case ('get-collection-class-wise-summary-report-data'):
                $this->get_collection_class_wise_summary_report_data();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get collection class wise report
             * Created Date : 05-Feb-2019
             */
            case ('get-collection-class-wise-details-report-data'):
                $this->get_collection_class_wise_details_report_data();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get collection user wise report
             * Created Date : 05-Feb-2019
             */
            case ('get-collection-user-wise-details-report-data'):
                $this->get_collection_user_wise_details_report_data();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get cheque ledger details
             * Created Date : 05-Feb-2019
             */
            case ('get-cheque-ledger-details'):
                $this->get_cheque_ledger_details();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get wallet deposit details
             * Created Date : 05-Feb-2019
             */
            case ('get-wallet-deposit-details'):
                $this->get_wallet_deposit_details();
                break;

                //SALAHUDHEEN
            case ('get_voucher_cancellation_report'):
                $this->get_voucher_cancellation_report();
                break;

            case ('get_vat_collection_details'):
                $this->get_vat_collection_details();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get wallet withdraw details
             * Created Date : 05-Feb-2019
             */
            case ('get-wallet-withdraw-details'):
                $this->get_wallet_withdraw_details();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get wallet statement details
             * Created Date : 05-Feb-2019
             */
            case ('get-wallet-statement-details'):
                $this->get_wallet_statement_details();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get online pay report
             * Created Date : 05-Feb-2019
             */
            case ('get-online-pay-report'):
                $this->get_online_pay_report();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get payback summary report
             * Created Date : 05-Feb-2019
             */
            case ('get-payback-summary-report'):
                $this->get_payback_summary_report();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get wallet withdraw details
             * Created Date : 05-Feb-2019
             */
            case ('save_demand_fee_allocation_individual'):
                $this->save_demand_fee_allocation_individual();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get wallet withdraw details
             * Created Date : 05-Feb-2019
             */
            case ('get_advancestudent_search_list_for_one_time_pay'):
                $this->get_advancestudent_search_list_for_one_time_pay();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save one time pending pay by wallet
             * Created Date : 21-Feb-2019
             */
            case ('save_one_time_adjustment_with_wallet_to_pending_pay'):
                $this->save_one_time_adjustment_with_wallet_to_pending_pay();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get report for arrear list with batch and as on date
             * Created Date : 22-Feb-2019
             */
            case ('get-arrear-list-report-as-on-date-for-batch'):
                $this->get_arrear_list_report_as_on_date_for_batch();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get report for arrear list with batch and as on date
             * Created Date : 22-Feb-2019
             */
            case ('get-arrear-list-longab-report-as-on-date-for-batch'):
                $this->get_arrear_list_longab_report_as_on_date_for_batch();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get dcb report of a student
             * Created Date : 24-Feb-2019
             */
            case ('get-dcb-report-student-wise'):
                $this->get_dcb_report_student_wise();
                break;
                /*
             * @Author      : sari S R
             * Purpose      : To get report of a student - ID wise
             * Created Date : 06-03-2020
             */
            case ('get_student_id_wise_report'):
                $this->get_student_id_wise_report();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get dcb report of a student
             * Created Date : 24-Feb-2019
             */
            case ('get-batch-wise-dcb-report'):
                $this->get_dcb_report_batch_wise();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get student fee details for online pay
             * Created Date : 24-Feb-2019
             */
            case ('get_fee_details_for_student_online_pay_display'):
                $this->get_fee_details_for_student_online_pay_display();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To save atom pay
             * Created Date : 24-Feb-2019
             */
            case ('save_atompay_details'):
                $this->save_atompay_details();
                break;
            case ('deposit_wallet_atom'):
                $this->deposit_wallet_atom();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get wallet withdraw details
             * Created Date : 28-Mar-2019
             */
            case ('get-head-wise-collection-details'):
                $this->get_headwise_collection_details();
                break;
                /*
             * @Author      : AJU S ARAVIND
             * Purpose      : To get wallet withdraw details
             * Created Date : 28-Mar-2019
             */
            case ('get-summary-collection-details'):
                $this->get_summary_collection_details();
                break;


                /*
             * TRANSPORT MODULE ******************************************************************************
             */

                /*
             * @Author      : CHANDRAJITH
             * Purpose      : TO Select the Feetype
             * Created Date : 26-July-2018
             */
            case ('get_vehicletype'):
                $this->get_vehicletype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Feetype
             * Created Date :  24-July-2018
             */
            case ('save_vehicletype'):
                $this->save_vehicletype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the Feetype
             * Created Date :  24-July-2018
             */
            case ('update_vehicletype'):
                $this->update_vehicletype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO modify the Feetype
             * Created Date :  24-July-2018
             */
            case ('modify_vehicletype'):
                $this->modify_vehicletype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the vehicle make details
             * Created Date :  24-July-2018
             */
            case ('get_vehicle_make'):
                $this->get_vehicle_make();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the vehicle make details
             * Created Date :  24-July-2018
             */
            case ('save_vehicle_make'):
                $this->save_vehicle_make();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the vehicle make details
             * Created Date :  24-July-2018
             */
            case ('update_vehicle_make'):
                $this->update_vehicle_make();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO modify the vehicle make details
             * Created Date :  24-July-2018
             */
            case ('modify_vehicle_make'):
                $this->modify_vehicle_make();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the vehicle make details
             * Created Date :  24-July-2018
             */
            case ('get_vehicle_make'):
                $this->get_vehicle_make();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the vehicle make details
             * Created Date :  24-July-2018
             */
            case ('save_vehicle_make'):
                $this->save_vehicle_make();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the vehicle make details
             * Created Date :  24-July-2018
             */
            case ('update_vehicle_make'):
                $this->update_vehicle_make();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO modify the vehicle make details
             * Created Date :  24-July-2018
             */
            case ('modify_vehicle_make'):
                $this->modify_vehicle_make();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Insurance details
             * Created Date :  25-July-2018
             */
            case ('get_insurance'):
                $this->get_insurance();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Insurance details
             * Created Date :  25-July-2018
             */
            case ('save_insurance'):
                $this->save_insurance();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the Insurance details
             * Created Date :  25-July-2018
             */
            case ('update_insurance'):
                $this->update_insurance();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO modify the Insurance details
             * Created Date :  25-July-2018
             */
            case ('modify_insurance'):
                $this->modify_insurance();
                break;

                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the vehicle model details
             * Created Date :  25-July-2018
             */
            case ('get_model'):
                $this->get_model();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the vehicle model details
             * Created Date :  25-July-2018
             */
            case ('save_model'):
                $this->save_model();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the vehicle model details
             * Created Date :  25-July-2018
             */
            case ('update_model'):
                $this->update_model();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO modify the vehicle model details
             * Created Date :  25-July-2018
             */
            case ('modify_model'):
                $this->modify_model();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Fuel details
             * Created Date :  25-July-2018
             */
            case ('get_fueltype'):
                $this->get_fueltype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Fuel details
             * Created Date :  25-July-2018
             */
            case ('save_fueltype'):
                $this->save_fueltype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the Fuel details
             * Created Date :  25-July-2018
             */
            case ('update_fueltype'):
                $this->update_fueltype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO modify the Fuel details
             * Created Date :  25-July-2018
             */
            case ('modify_fueltype'):
                $this->modify_fueltype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Trip details
             * Created Date :  25-July-2018
             */
            case ('get_trip'):
                $this->get_trip();
                break;
                /*
             * @Author      :  Elavarasan S
             * Purpose      :  TO get the Trip details
             * Created Date :  12-June-2019
             */
            case ('get_trip_details_byId'):
                $this->get_trip_details_byId();
                break;
            case ('get_particulartrip'):
                $this->get_particulartrip();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Trip details for allotments
             * Created Date :  25-July-2018
             */
            case ('get_trip_allotment'):
                $this->get_trip_allotment();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Trip details
             * Created Date :  25-July-2018
             */
            case ('save_trip'):
                $this->save_trip();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Trip vehicle map details
             * Created Date :  25-July-2018
             */
            case ('save_trip_pickpoint_relation'):
                //$this->save_trip_pickpoint_relation();
                $controller_function = 'Transport_settings/Trip_controller/save_trip_pickpoint_relation';
                $this->get_action($controller_function);
                break;
                /*
             * @Author      : AHB
             * Purpose      : TO save the Trip and Pickup Point Relation
             * Created Date : 03-July-2019
             */
            case ('get_student_travel_transport'):
                //$this->save_trip_pickpoint_relation();
                $controller_function = 'Transport_settings/Passenger_student_controller/get_student_travel_transport';
                $this->get_action($controller_function);
                break;
                /*get_student_travel_transport
             * @Author      : AHB
             * Purpose      : TO GET the Trip and Pickup details
             * Created Date : 03-July-2019
             */

            case ('get_student_travel_history'):
                $controller_function = 'Transport_settings/Passenger_student_controller/get_student_travel_history';
                $this->get_action($controller_function);
                break;
                /*get_student_travel_history
            * @Author      : AHB
            * Purpose      : TO GET the history of student travel data
            * Created Date : 30-Sept-2019
            */

            case ('get_all_student_allocation_details'):
                //$this->save_trip_pickpoint_relation();
                $controller_function = 'Transport_settings/Passenger_student_controller/get_all_student_allocation_details';
                $this->get_action($controller_function);
                break;
                /*get_all_student_allocation_details
             * @Author      : AHB
             * Purpose      : TO GET the Trip and Pickup details
             * Created Date : 03-July-2019
             */
            case ('save_trip_edit'):
                //$this->get_pickuppoint_relation_data();
                $controller_function = 'Transport_settings/Trip_controller/save_trip_edit';
                $this->get_action($controller_function);
                break;
                /*
            * @Author      : AHB
            * Purpose      : TO Retrieve the Trip and Pickup Point Relation
            * Created Date : 03-July-2019
            */
            case ('get_trip_pickuppoint_relation_data'):
                //$this->get_pickuppoint_relation_data();
                $controller_function = 'Transport_settings/Trip_controller/get_trip_pickuppoint_relation_data';
                $this->get_action($controller_function);
                break;
                /*get_active_pickpoint_trips
            
             * @Author      : AHB
             * Purpose      : TO Retrieve the Trip and Pickup Point Relation
             * Created Date : 03-July-2019
             */
            case ('get_all_pickuppoint_fees'):
                $controller_function = 'Transport_settings/Pickuppoint_fees_controller/get_all_pickuppoint_fees';
                $this->get_action($controller_function);
                break;
                /*get_all_pickuppoint_fees
            
            * @Author      : AHB
            * Purpose      : TO Retrieve the All Pickup Point fees
            * Created Date : 12-July-2019
            */
            case ('get_pickuppoint_all_fees_details'):
                $controller_function = 'Transport_settings/Pickuppoint_fees_controller/get_pickuppoint_all_fees_details';
                $this->get_action($controller_function);
                break;
                /*get_pickuppoint_all_fees_details
            
            * @Author      : AHB
            * Purpose      : TO Retrieve the Pickup Point all fees
            * Created Date : 12-July-2019
            */
            case ('save_pickuppoint_fees_data'):
                $controller_function = 'Transport_settings/Pickuppoint_fees_controller/save_pickuppoint_fees_data';
                $this->get_action($controller_function);
                break;

                /*save_pickuppoint_fees_data
            
            * @Author      : AHB
            * Purpose      : TO Update the Pickup Point fees
            * Created Date : 15-July-2019
            */

            case ('get_pickuppoint_student_details'):
                $controller_function = 'Transport_settings/Pickuppoint_fees_controller/get_pickuppoint_student_details';
                $this->get_action($controller_function);
                break;

                /*get_pickuppoint_student_details
            
            * @Author      : AHB
            * Purpose      : TO Get the Pickup Point Students Details
            * Created Date : 15-July-2019
            */


            case ('save_rims_response'):
                //$this->save_trip_pickpoint_relation();
                $controller_function = 'Transport_settings/Passenger_student_controller/save_rims_response';
                $this->get_action($controller_function);
                break;
                /*get_student_travel_transport
             * @Author      : AHB
             * Purpose      : TO GET the Trip and Pickup details
             * Created Date : 03-July-2019
             */
            case ('get_unalloted_vehicle'):
                //$this->save_trip_pickpoint_relation();
                $controller_function = 'Transport_settings/Trip_vehicle_mapping_controller/get_unalloted_vehicle';
                $this->get_action($controller_function);
                break;
                /*get_student_travel_transport
             * @Author      : AHB
             * Purpose      : TO GET the Trip and Pickup details
             * Created Date : 03-July-2019
             */
            case ('get_entrance_date'):
                $controller_function = 'Student_settings/Registration_controller/get_entrance_date';
                $this->get_action($controller_function);
                break;
                /*get_student_travel_transport
             * @Author      : AHB
             * Purpose      : TO GET the Entrance Date
             * Created Date : 06-November-2019
             */
            case ('get_mandatory_subjects'):
                $controller_function = 'Student_settings/Registration_controller/get_mandatory_subjects';
                $this->get_action($controller_function);
                break;
                /*get_student_travel_transport
             * @Author      : AHB
             * Purpose      : TO GET the Entrance Date
             * Created Date : 06-November-2019
             */
            case ('get_all_unsync_temp_admn'):
                //$this->save_trip_pickpoint_relation();
                $controller_function = 'Student_settings/Registration_controller/get_all_unsync_temp_admn';
                $this->get_action($controller_function);
                break;
                /*get_all_unsync_temp_admn
         * @Author      : AHB
         * Purpose      : TO GET the Unsynced data in Rims
         * Created Date : 08-November-2019
         */
            case ('save_rims_response_online_registration'):
                //$this->save_trip_pickpoint_relation();
                $controller_function = 'Student_settings/Registration_controller/save_rims_response_online_registration';
                $this->get_action($controller_function);
                break;
                /*get_all_unsync_temp_admn
         * @Author      : AHB
         * Purpose      : TO Save the response and status from Rims
         * Created Date : 08-November-2019
         */
                /*get_all_unsync_temp_admn
         * @Author      : FATHIMA
         * Purpose      : TO get the parent details for online registration
         * Created Date : 08-November-2019
         */
            case ('get_parent_details_online_reg'):
                $controller_function = 'Student_settings/Registration_controller/get_parent_details_online_reg';
                $this->get_action($controller_function);
                break;


            case ('save_tripvehiclemap'):
                $this->save_tripvehiclemap();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Trip vehicle map details
             * Created Date :  25-July-2018
             */
            case ('get_vehicledetails_trip'):
                $this->get_vehicledetails_trip();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the Trip details
             * Created Date :  25-July-2018
             */
            case ('update_trip'):
                $this->update_trip();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO modify the Trip details
             * Created Date :  25-July-2018
             */
            case ('modify_trip'):
                $this->modify_trip();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the trips linked in a particular route
             * Created Date :  25-July-2018
             */
            case ('routewise_trip'):
                $this->routewise_trip();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the stops linked in a particular route and a trip
             * Created Date :  25-July-2018
             */
            case ('routewise_trip_stops'):
                $this->routewise_trip_stops();
                break;
                /*
             * @Author      : vinoth
             * Purpose      :  TO get the vehicle trip name
             * Created Date :  10-June-2018
             */

            case ('vehiclewise_tripname'):
                $this->vehiclewise_tripname();
                break;

                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Service center details
             * Created Date :  26-July-2018
             */
            case ('get_servicecenter'):
                $this->get_servicecenter();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO disable the Service center details
             * Created Date :  26-July-2018
             */
            case ('modify_servicecenter_status'):
                $this->modify_servicecenter_status();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Service type details
             * Created Date :  26-July-2018
             */
            case ('get_servicetype'):
                $this->get_servicetype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Service type details
             * Created Date :  26-July-2018
             */
            case ('get_particularservicetype'):
                $this->get_particularservicetype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO disable the Service type details
             * Created Date :  26-July-2018
             */
            case ('modify_servicetype_status'):
                $this->modify_servicetype_status();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the Service type details
             * Created Date :  26-July-2018
             */
            case ('update_servicetype'):
                $this->update_servicetype();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Service center details
             * Created Date :  26-July-2018
             */
            case ('save_servicecenter'):
                $this->save_servicecenter();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Service type
             * Created Date :  26-July-2018
             */
            case ('save_servicetypes'):
                $this->save_servicetypes();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the Service center details
             * Created Date :  26-July-2018
             */
            case ('update_servicecenter'):
                $this->update_servicecenter();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO modify the Service center details
             * Created Date :  26-July-2018
             */
            case ('modify_servicecenter'):
                $this->modify_servicecenter();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO Particular the Service center details
             * Created Date :  26-July-2018
             */
            case ('get_particularservicecenter'):
                $this->get_particularservicecenter();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the vehicle Registration details
             * Created Date :  26-July-2018
             */
            case ('get_vehiclereg'):
                $this->get_vehiclereg();
                break;

            case ('get_vehiclereg_for_driver'):
                $this->get_vehiclereg_for_driver();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the  vehicle Registration Save details
             * Created Date :  26-July-2018
             */

            case ('save_vehiclereg'):
                $this->save_vehiclereg();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO disable the  vehicle Registration  details
             * Created Date :  26-July-2018
             */

            case ('modify_vehicle_status'):
                $this->modify_vehicle_status();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the vehicle Registration update details
             * Created Date :  26-July-2018
             */
            case ('update_vehiclereg'):
                $this->update_vehiclereg();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO modify the vehicle Registration Modify details
             * Created Date :  26-July-2018
             */
            case ('modify_vehiclereg'):
                $this->modify_vehiclereg();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the vehicle Make details
             * Created Date :  26-July-2018
             */
            case ('get_make'):
                $this->get_make();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the  vehicle Make Save details
             * Created Date :  26-July-2018
             */
            case ('save_make'):
                $this->save_make();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the vehicle Make update details
             * Created Date :  26-July-2018
             */
            case ('update_make'):
                $this->update_make();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO modify the vehicle Make Modify details
             * Created Date :  26-July-2018
             */
            case ('modify_make'):
                $this->modify_make();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Route Details
             * Created Date :  30-July-2018
             */
            case ('get_route'):
                $this->get_route();
                break;

            case ('get_maintanance'):
                $this->get_maintanance();
                break;

            case ('get_trip_pickups'):
                $this->get_trip_pickups();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Route Details
             * Created Date :  30-July-2018
             */
            case ('get_trip_pick_rpt'):
                $this->get_trip_pick_rpt();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Trip Pickpoints Details
             * Created Date :  30-July-2018
             */
            case ('get_trip_stops_rpt'):
                $this->get_trip_stops_rpt();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Route Trip Pickpoints Details
             * Created Date :  13-02-2019
             */
            case ('get_route_trip_stops_rpt'):
                $this->get_route_trip_stops_rpt();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Vehicle Route Trip Pickpoints Details
             * Created Date :  13-02-2019
             */
            case ('getvehicle_route_trip_stops_rpt'):
                $this->getvehicle_route_trip_stops_rpt();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the student data pick stopwise
             * Created Date :  13-02-2019
             */
            case ('get_pickstopswise_student_rpt'):
                $this->get_pickstopswise_student_rpt();
                break;
                /*
              /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the student data Drop stopwise
             * Created Date :  13-02-2019
             */
            case ('get_dropstopswise_student_rpt'):
                $this->get_dropstopswise_student_rpt();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the student data Tripwise
             * Created Date :  13-02-2019
             */
            case ('get_tripwise_student_rpt'):
                $this->get_tripwise_student_rpt();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the student data routewise
             * Created Date :  13-02-2019
             */
            case ('get_routewise_student_rpt'):
                $this->get_routewise_student_rpt();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Route Details
             * Created Date :  09-Aug-2018
             */
            case ('save_route'):
                $this->save_route();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Route Details
             * Created Date :  30-July-2018
             */
            case ('modify_route'):
                $this->modify_route();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the Route Details
             * Created Date :  30-July-2018
             */
            case ('update_route'):
                $this->update_route();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Route Details
             * Created Date :  30-July-2018
             */
            case ('get_pickuppoint'):
                $this->get_pickuppoint();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Pickup Details
             * Created Date :  30-July-2018
             */
            case ('get_trip_routemappickuppoint'):
                $this->get_trip_routemappickuppoint();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Pickup Details-emp-fees
             * Created Date :  30-July-2018
             */
            case ('get_trip_routemappickuppoint_emp'):
                $this->get_trip_routemappickuppoint_emp();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Pickup Details fees selection
             * Created Date :  09-FEB-2019
             */
            case ('get_pickpoint_feez'):
                $this->get_pickpoint_feez();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Trip Details for student-passenger allotment
             * Created Date :  25-January-2019
             */
            case ('get_trip_passengerallotment'):
                $this->get_trip_passengerallotment();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Pick vehicle staff details
             * Created Date :  25-January-2019
             */
            case ('get_vehicle_trip_driver_cleaner_data'):
                $this->get_vehicle_trip_driver_cleaner_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Drop vehicle staff details
             * Created Date :  25-January-2019
             */
            case ('get_dropvehicle_trip_driver_cleaner_data'):
                $this->get_dropvehicle_trip_driver_cleaner_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as student for Transport
             * Created Date :  25-January-2019
             */
            case ('savestudent_passengerallotment'):
                $this->savestudent_passengerallotment();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as student for Transport-different route mode
             * Created Date :  25-January-2019
             */
            case ('savestudent_passengerallotment_diff_route'):
                $this->savestudent_passengerallotment_diff_route();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as student for Transport in pick change
             * Created Date :  03-FEB-2019
             */
            case ('savestudent_passengerallotment_pickchange'):
                $this->savestudent_passengerallotment_pickchange();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the employee passenger details as student for Transport in pick change
             * Created Date :  03-FEB-2019
             */
            case ('saveemployee_passengerallotment_pickchange'):
                $this->saveemployee_passengerallotment_pickchange();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Student passenger details as student for Transport in Rip change
             * Created Date :  03-FEB-2019
             */
            case ('savestudent_passengerallotment_tripchange'):
                $this->savestudent_passengerallotment_tripchange();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Student passenger details as employee for Transport in Rip change
             * Created Date :  03-FEB-2019
             */
            case ('saveemp_passengerallotment_tripchange'):
                $this->saveemp_passengerallotment_tripchange();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Student passenger details as employee for Transport in Rip change
             * Created Date :  03-FEB-2019
             */
            case ('saveemp_passengerallotment_droptripchange'):
                $this->saveemp_passengerallotment_droptripchange();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the route linked tripdata
             * Created Date :  03-FEB-2019
             */
            case ('get_routelinktrips_data'):
                $this->get_routelinktrips_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the route linked tripdata
             * Created Date :  03-FEB-2019
             */
            case ('get_routelinkpickemptrips_data'):
                $this->get_routelinkpickemptrips_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the route linked tripdata for droptripchange
             * Created Date :  03-FEB-2019
             */
            case ('get_routelinkdropemptrips_data'):
                $this->get_routelinkdropemptrips_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the route linked droptripdata
             * Created Date :  03-FEB-2019
             */
            case ('savestudent_passengerallotment_droptripchange'):
                $this->savestudent_passengerallotment_droptripchange();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the route linked droptripdata
             * Created Date :  03-FEB-2019
             */
            case ('get_routelinkdroptrips_data'):
                $this->get_routelinkdroptrips_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the data of vehicle wise passengers as students
             * Created Date :  03-FEB-2019
             */
            case ('get_vehiclewise_student_passengers'):
                $this->get_vehiclewise_student_passengers();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the data of trip wise passengers as students
             * Created Date :  03-FEB-2019
             */
            case ('get_trip_student_passengers'):
                $this->get_trip_student_passengers();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the data of Route wise passengers as students
             * Created Date :  03-FEB-2019
             */
            case ('get_route_student_passengers'):
                $this->get_route_student_passengers();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as student for Transport in Drop change
             * Created Date :  03-FEB-2019
             */
            case ('savestudent_passengerallotment_dropchange'):
                $this->savestudent_passengerallotment_dropchange();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as student for Transport in Drop change
             * Created Date :  03-FEB-2019
             */
            case ('saveemp_passengerallotment_dropchange'):
                $this->saveemp_passengerallotment_dropchange();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as student for Transport for Pick only mode
             * Created Date :  02-FEB-2019
             */
            case ('savestudent_passengerallotment_pick'):
                $this->savestudent_passengerallotment_pick();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the student transport allotted data
             * Created Date :  02-FEB-2019
             */
            case ('get_student_pickchange_data'):
                $this->get_student_pickchange_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as Employee for Transport for Pick only mode
             * Created Date :  02-FEB-2019
             */
            case ('get_emp_pickchange_data'):
                $this->get_emp_pickchange_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as Employee for Transport for dropchange only mode
             * Created Date :  02-FEB-2019
             */
            case ('get_emp_dropchange_data'):
                $this->get_emp_dropchange_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the passenger details as Trip Link pick change
             * Created Date :  02-FEB-2019
             */
            case ('get_triplinkpickchnge_data'):
                $this->get_triplinkpickchnge_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Emp passenger details as Trip Link pick change
             * Created Date :  02-FEB-2019
             */
            case ('get_emptriplinkpickchnge_data'):
                $this->get_emptriplinkpickchnge_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :   TO get the passenger details as Trip Link drop change
             * Created Date :  02-FEB-2019
             */
            case ('get_triplinkdropchnge_data'):
                $this->get_triplinkdropchnge_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :   TO get the EMployee passenger details as Trip Link drop change
             * Created Date :  02-FEB-2019
             */
            case ('get_emptriplinkdropchnge_data'):
                $this->get_emptriplinkdropchnge_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :   TO get the student passenger details as allotment previous
             * Created Date :  02-FEB-2019
             */
            case ('get_allotmnetprevious_data_pickchnge'):
                $this->get_allotmnetprevious_data_pickchnge();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :   TO get the staff passenger details as allotment previous
             * Created Date :  02-FEB-2019
             */
            case ('get_empallotmnetprevious_data_pickchnge'):
                $this->get_empallotmnetprevious_data_pickchnge();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as student for Transport for Drop only mode
             * Created Date :  02-FEB-2019
             */
            case ('savestudent_passengerallotment_drop'):
                $this->savestudent_passengerallotment_drop();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get passenger details as student filtered data
             * Created Date :  02-FEB-2019
             */
            case ('get_student_search_list_for_transport'):
                $this->get_student_search_list_for_transport();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get passenger details as student advanced filtered data
             * Created Date :  02-FEB-2019
             */
            case ('get_advancestudent_search_list_for_transport'):
                $this->get_advancestudent_search_list_for_transport();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as Employee for Transport
             * Created Date :  01-Feb-2019
             */
            case ('save_emp_passengerallotment'):
                $this->save_emp_passengerallotment();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as Employee for Transport for Pick only
             * Created Date :  02-Feb-2019
             */
            case ('save_emp_passengerallotment_pick'):
                $this->save_emp_passengerallotment_pick();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as Employee for Transport for Drop only
             * Created Date :  02-Feb-2019
             */
            case ('save_emp_passengerallotment_drop'):
                $this->save_emp_passengerallotment_drop();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the passenger details as guest for Transport
             * Created Date :  27-January-2019
             */
            case ('saveguest_passengerallotment'):
                $this->saveguest_passengerallotment();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the pickup point
             * Created Date :  19-Aug-2018
             */
            case ('save_pickuppoint'):
                $this->save_pickuppoint();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO update the pickup point
             * Created Date :  19-Aug-2018
             */
            case ('update_pickuppoint'):
                $this->update_pickuppoint();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the vehicele model date
             * Created Date :  19-Aug-2018
             */
            case ('modify_pickuppoint'):
                $this->modify_pickuppoint();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the vehicele model date
             * Created Date :  19-Aug-2018
             */
            case ('get_model_date'):
                $this->get_model_date();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the vehicele model_date
             * Created Date :  20-Aug-2018
             */
            case ('save_model_date'):
                $this->save_model_date();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO modify the vehicele Model Date
             * Created Date :  20-Aug-2018
             */
            case ('update_model_date'):
                $this->update_model_date();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO modify the vehicele Model Date
             * Created Date :  20-Aug-2018
             */
            case ('modify_model_date'):
                $this->modify_model_date();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the incident details of the vehicle
             * Created Date :  20-Aug-2018
             */
            case ('save_incidents'):
                $this->save_incidents();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the incident details of the vehicle
             * Created Date :  22-Oct-2018
             */
            case ('get_incidents'):
                $this->get_incidents();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Service Type Data
             * Created Date :  07-Nov-2018
             */
            case ('get_service_type'):
                $this->get_service_type();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Service Booking details of the vehicle
             * Created Date :  28-Aug-2018
             */
            case ('save_service_booking'):
                $this->save_service_booking();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Service Invoice details of the vehicle
             * Created Date :  28-Aug-2018
             */
            case ('save_service_invoice'):
                $this->save_service_invoice();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO load sevice gone vehicles
             * Created Date :  04-Sep-2018
             */
            case ('get_vehicle_invoice_details'):
                $this->get_vehicle_invoice_details();
                break;
                /*
              /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO load sevice/invoice data
             * Created Date :  04-Sep-2018
             */
            case ('get_particular_vehicle_invoice_details'):
                $this->get_particular_vehicle_invoice_details();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO load sevice/invoice data
             * Created Date :  04-Sep-2018
             */
            case ('get_vehicle_invoice_history'):
                $this->get_vehicle_invoice_history();
                break;
                /*
              /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO load sevice/invoice data
             * Created Date :  04-Sep-2018
             */
            case ('get_vehicle_service_history'):
                $this->get_vehicle_service_history();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Route Pick Map Details
             * Created Date :  04-Sep-2018
             */
            case ('save_route_pick_map'):
                $this->save_route_pick_map();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Route Pick Map Details
             * Created Date :  04-Sep-2018
             */
            case ('get_route_pick_map'):
                $this->get_route_pick_map();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Route Pick Map Details
             * Created Date :  04-Sep-2018
             */
            case ('get_route_pick_maps_details'):
                $this->get_route_pick_maps_details();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Route Pick Map Details
             * Created Date :  04-Sep-2018
             */
            case ('get_route_pick_maps_details_stoptimes'):
                $this->get_route_pick_maps_details_stoptimes();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Route Trip Map Details
             * Created Date :  14-Sep-2018
             */
            case ('save_route_trip_map'):
                $this->save_route_trip_map();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Bus Trip Map Details
             * Created Date :  16-Sep-2018
             */
            case ('save_bus_trip_map'):
                $this->save_bus_trip_map();
                break;

                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Trip Details
             * Created Date :  21-Sep-2018
             */
            case ('get_trip_details'):
                $this->get_trip_details();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Trip link vehicle Details
             * Created Date :  21-Sep-2018
             */
            case ('get_triplinkvehi'):
                $this->get_triplinkvehi();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get the Pickup Point Details
             * Created Date :  21-Sep-2018
             */
            case ('get_pickup_details'):
                $this->get_pickup_details();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the student transport allotment Details
             * Created Date :  21-Sep-2018
             */
            case ('save_allotment_student_transport'):
                $this->save_allotment_student_transport();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Guest transport allotment Details
             * Created Date :  23-Sep-2018
             */
            case ('save_allotment_guest_transport'):
                $this->save_allotment_guest_transport();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO save the Staff transport allotment Details
             * Created Date :  24-Sep-2018
             */
            case ('save_allotment_staff_transport'):
                $this->save_allotment_staff_transport();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO deallocate the Students list
             * Created Date :  24-Sep-2018
             */
            case ('get_allotted_students'):
                $this->get_allotted_students();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO get allocated  Students 
             * Created Date :  24-Sep-2018
             */
            case ('deallocate_student'):
                $this->deallocate_student();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO deallocate the Students for pick route
             * Created Date :  24-Sep-2018
             */
            case ('savestudent_passengerdeallotment'):
                $this->savestudent_passengerdeallotment();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO deallocate the Students for drop route 
             * Created Date :  24-Sep-2018
             */
            case ('savestudent_passengerdeallotment_drop'):
                $this->savestudent_passengerdeallotment_drop();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO load deallocate the staffs 
             * Created Date :  25-Sep-2018
             */
            case ('get_allotted_staffs'):
                $this->get_allotted_staffs();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO deallocate the staffs save 
             * Created Date :  25-Sep-2018
             */
            case ('deallocate_staff'):
                $this->deallocate_staff();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO deallocate the guest
             * Created Date :  25-Sep-2018
             */
            case ('get_allotted_guests'):
                $this->get_allotted_guests();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  TO deallocate the guest save
             * Created Date :  25-Sep-2018
             */
            case ('deallocate_guest'):
                $this->deallocate_guest();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To select the route pickuppoint map data
             * Created Date :  25-Sep-2018
             */
            case ('get_route_pickpoint_map'):
                $this->get_route_pickpoint_map();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To select the drivers of the institution
             * Created Date :  23-OCT-2018
             */
            case ('get_inst_drivers'):
                $this->get_inst_drivers();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To select the Cleaners of the institution
             * Created Date :  23-OCT-2018
             */
            case ('get_inst_cleaners'):
                $this->get_inst_cleaners();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To Save the staff for Institution Bus
             * Created Date :  23-OCT-2018
             */
            case ('save_staff_bus'):
                $this->save_staff_bus();
                break;
                //this case written by Elavarasan S @ 07-06-2019 5.25
            case ('modify_vehicle_staff_status'):
                $this->modify_vehicle_staff_status();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To getFuel Log
             * Created Date :  23-OCT-2018
             */
            case ('get_fuel_log'):
                $this->get_fuel_log();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To Save the Fuel Log
             * Created Date :  23-OCT-2018
             */
            case ('save_fuel_log'):
                $this->save_fuel_log();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To load the spareparts list
             * Created Date :  23-OCT-2018
             */
            case ('get_spareparts'):
                $this->get_spareparts();
                break;

            case ('get_conductors'):
                $this->get_conductors();
                break;

            case ('get_driver'):
                $this->get_driver();
                break;

            case ('save_conductor'):
                $this->save_conductor();
                break;

            case ('save_driver'):
                $this->save_driver();
                break;

            case ('select_conductor_for_edit'):
                $this->select_conductor_for_edit();
                break;

            case ('select_driver_for_edit'):
                $this->select_driver_for_edit();
                break;

            case ('update_conductor'):
                $this->update_conductor();
                break;

            case ('update_driver'):
                $this->update_driver();
                break;

            case ('status_modify_conductor'):
                $this->status_modify_conductor();
                break;

            case ('status_modify_driver'):
                $this->status_modify_driver();
                break;

            case ('get_employee'):
                $this->get_employee();
                break;
            case ('get_employeefor_driver'):
                $this->get_employeefor_driver();
                break;


            case ('get_select_emp_data'):
                $this->get_select_emp_data();
                break;
                /*
             * @Author      :  Elavarasan S
             * Purpose      :  To get a sparepart
             * Created Date :  23-OCT-2018
             */
            case ('select_parts_for_edit'):
                $this->select_parts_for_edit();
                break;

            case ('select_service_type_for_edit'):
                $this->select_service_type_for_edit();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To save the spareparts
             * Created Date :  23-OCT-2018
             */
            case ('save_parts_spare'):
                $this->save_parts_spare();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To save the spareparts
             * Created Date :  23-OCT-2018
             */
            case ('save_spare_part'):
                $this->save_spare_part();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To save the spareparts
             * Created Date :  23-OCT-2018
             */
            case ('disable_spare_part'):
                $this->disable_spare_part();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To save the spareparts
             * Created Date :  23-OCT-2018
             */
            case ('modify_parts_status'):
                $this->modify_parts_status();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To save the spareparts
             * Created Date :  23-OCT-2018
             */
            case ('get_particularpart'):
                $this->get_particularpart();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To save the spareparts
             * Created Date :  23-OCT-2018
             */
            case ('update_spareparts'):
                $this->update_spareparts();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To load the spareparts list
             * Created Date :  23-OCT-2018
             */
            case ('get_acessories'):
                $this->get_acessories();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  To save the spareparts
             * Created Date :  23-OCT-2018
             */
            case ('save_acessories'):
                $this->save_acessories();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Fuel Log Reports
             * Created Date :  23-OCT-2018
             */
            case ('get_fuellog'):
                $this->get_fuellog();
                break;

            case ('get_maintainrpt'):
                $this->get_maintainrpt();
                break;

            case ('get_incidents_rpt'):
                $this->get_incidents_rpt();
                break;
            case ('get_costrpt'):
                $this->get_costrpt();
                break;
            case ('get_maintain_summary_rpt'):
                $this->get_maintain_summary_rpt();
                break;
            case ('get_vehicle_expenditure'):
                $this->get_vehicle_expenditure();
                break;
            case ('get_vehicle_expenditure_summary'):
                $this->get_vehicle_expenditure_summary();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Fuel Log Reports
             * Created Date :  23-OCT-2018
             */
            case ('get_fuelconsumption'):
                $this->get_fuelconsumption();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Incident Reports
             * Created Date :  23-OCT-2018
             */
            case ('get_vhicleincidentrpt'):
                $this->get_vhicleincidentrpt();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Incident Reports
             * Created Date :  23-OCT-2018
             */
            case ('get_maintenance_report'):
                $this->get_maintenance_report();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Fuel Type for Fuel Log
             * Created Date :  23-OCT-2018
             */
            case ('get_fueltype_log'):
                $this->get_fueltype_log();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport Lock dates
             * Created Date :  26-OCT-2018
             */
            case ('get_transportlockdate'):
                $this->get_transportlockdate();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport spare report
             * Created Date :  26-OCT-2018
             */
            case ('get_spares_report'):
                $this->get_spares_report();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport spare report
             * Created Date :  26-OCT-2018
             */
            case ('save_feesdata_pickpoint'):
                $this->save_feesdata_pickpoint();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport staff datas
             * Created Date :  31-OCT-2018
             */
            case ('get_vehicl_staff_data'):
                $this->get_vehicl_staff_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport staff datas
             * Created Date :  31-OCT-2018
             */
            case ('disable_vehstaff_status'):
                $this->disable_vehstaff_status();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport Service Booking data
             * Created Date :  05-NOV-2018
             */
            case ('get_vehicleservicebooking_details'):
                $this->get_vehicleservicebooking_details();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport Service Booking data
             * Created Date :  05-NOV-2018
             */
            case ('get_servicebooked_vehicle'):
                $this->get_servicebooked_vehicle();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport checking is vehicle currently under service
             * Created Date :  09-NOV-2018
             */
            case ('checking_servicebooked_vehicle'):
                $this->checking_servicebooked_vehicle();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport checking is vehicle currently under service
             * Created Date :  09-NOV-2018
             */
            case ('get_triproutemap_details'):
                $this->get_triproutemap_details();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport checking is vehicle currently under service
             * Created Date :  09-NOV-2018
             */
            case ('get_triproutetime_details'):
                $this->get_triproutetime_details();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport for trip-route-pickuppoint mapping
             * Created Date :  22-Jan-2019
             */
            case ('save_trip_route_pickpoint'):
                $this->save_trip_route_pickpoint();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport for trip-route-pickuppoint mapping
             * Created Date :  22-Jan-2019
             */
            case ('get_trip_mapz'):
                $this->get_trip_mapz();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport for staff allotment
             * Created Date :  22-Jan-2019
             */
            case ('get_staff_allotments'):
                $this->get_staff_allotments();
                break;

                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport vendor show
             * Created Date :  18-MARCH-2019
             */
            case ('get_vendor'):
                $this->get_vendor();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport vendor save
             * Created Date :  18-MARCH-2019
             */
            case ('save_vendor'):
                $this->save_vendor();
                break;
                /*
              /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport vendor save
             * Created Date :  18-MARCH-2019
             */
            case ('modify_vendor_status'):
                $this->modify_vendor_status();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport vendor details
             * Created Date :  18-MARCH-2019
             */
            case ('get_particularvendor'):
                $this->get_particularvendor();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport vendor details update
             * Created Date :  18-MARCH-2019
             */
            case ('update_vendor'):
                $this->update_vendor();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport Directpurchase show
             * Created Date :  18-MARCH-2019
             */
            case ('get_directpurchase_spare'):
                $this->get_directpurchase_spare();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport Directpurchase save
             * Created Date :  18-MARCH-2019
             */
            case ('save_spare_directpurchase'):
                $this->save_spare_directpurchase();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport Directpurchase disable
             * Created Date :  18-MARCH-2019
             */
            case ('modify_dp_status'):
                $this->modify_dp_status();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport get spare parts stock
             * Created Date :  18-MARCH-2019
             */
            case ('get_spareparts_stock'):
                $this->get_spareparts_stock();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport get spare parts save for Vehicle
             * Created Date :  18-MARCH-2019
             */
            case ('save_vehicle_parts_spare_data'):
                $this->save_vehicle_parts_spare_data();
                break;
                /*
             * @Author      : CHANDRAJITH
             * Purpose      :  Transport get spare parts save for Vehicle
             * Created Date :  18-MARCH-2019
             */
            case ('get_spareparts_vehicle_alloted'):
                $this->get_spareparts_vehicle_alloted();
                break;

            case ('get-all-student-transport-data'):
                $controller_function = 'Transport_settings/Transport_report_controller/get_all_student_transport_data';
                $this->get_action($controller_function);
                break;


                /*get_student_travel_transport
                * @Author      : AHB
                * Purpose      : TO GET the Trip and Pickup details
                * Created Date : 03-July-2019
                */

            case ('save_trip_pickpoint_relation'):
                //$this->save_trip_pickpoint_relation();
                $controller_function = 'Transport_settings/Trip_controller/save_trip_pickpoint_relation';
                $this->get_action($controller_function);
                break;

            case ('get_travel_log'):
                $controller_function = 'Transport_settings/Trip_controller/get_travel_log';
                $this->get_action($controller_function);
                break;

                /*get_class_registration_fee
                 * @Author      : AHB
                 * Purpose      : To Get Registration Fee
                 * Created Date : 28-March-2020
                 */

            case ('get_class_registration_fee'):
                //$this->save_trip_pickpoint_relation();
                $controller_function = 'Student_settings/Registration_controller/get_class_registration_fee';
                $this->get_action($controller_function);
                break;

                /*get_all_temp_students_registration_fees
                 * @Author      : AHB
                 * Purpose      : To Get Registration Fee
                 * Created Date : 28-March-2020
                 */

            case ('get_all_temp_students_registration_fees'):
                //$this->save_trip_pickpoint_relation();
                $controller_function = 'Student_settings/Registration_controller/get_all_temp_students_registration_fees';
                $this->get_action($controller_function);
                break;

            case ('get_all_temp_students_registration_documents'):
                //$this->save_trip_pickpoint_relation();
                $controller_function = 'Student_settings/Registration_controller/get_all_temp_students_registration_documents';
                $this->get_action($controller_function);
                break;

                /*update_registration_fees
                 * @Author      : AHB
                 * Purpose      : TO Update Registration Fee
                 * Created Date : 28-March-2020
                 */
            case ('update_registration_fees'):
                $controller_function = 'Student_settings/Registration_controller/update_registration_fees';
                $this->get_action($controller_function);
                break;

                /*update_registration_payment_allocation
                 * @Author      : AHB
                 * Purpose      : TO Update Registration Payment Allocation
                 * Created Date : 28-March-2020
                 */
            case ('update_registration_payment_allocation'):
                $controller_function = 'Student_settings/Registration_controller/update_registration_payment_allocation';
                $this->get_action($controller_function);
                break;

                /*get_system_parameters
                 * @Author      : AHB
                 * Purpose      : TO Get System Parameters
                 * Created Date : 28-March-2020
                 */
            case ('get_system_parameters'):
                $controller_function = 'General_settings/Institution_controller/get_system_parameters';
                $this->get_action($controller_function);
                break;

                /*save_system_parameters
                 * @Author      : AHB
                 * Purpose      : TO Save System Parameters
                 * Created Date : 28-March-2020
                 */
            case ('save_system_parameters'):
                $controller_function = 'General_settings/Institution_controller/save_system_parameters';
                $this->get_action($controller_function);
                break;

                /*save_registration_date
                 * @Author      : AHB
                 * Purpose      : TO Save Registration date
                 * Created Date : 28-March-2020
                 */
            case ('save_registration_date'):
                $controller_function = 'Student_settings/Registration_controller/save_registration_date';
                $this->get_action($controller_function);
                break;

                /*save_online_order_delivery_details
                 * @Author      : AHB
                 * Purpose      : TO Save Registration date
                 * Created Date : 28-March-2020
                 */
            case ('save_bookstore_online_order_delivery_details'):
                $controller_function = 'sub_store_settings/Delivery_controller/save_bookstore_online_order_delivery_details';
                $this->get_action($controller_function);
                break;


                /*save_online_order_delivery_details
                 * @Author      : AHB
                 * Purpose      : TO Save Registration date
                 * Created Date : 28-March-2020
                 */
            case ('save_uniform_online_order_delivery_details'):
                $controller_function = 'sub_store_uniform/Delivery_controller/save_uniform_online_order_delivery_details';
                $this->get_action($controller_function);
                break;

                /*get_bookstore_online_order
                 * @Author      : AHB
                 * Purpose      : TO Book store Online Order
                 * Created Date : 28-March-2020
                 */
            case ('get_bookstore_online_order'):
                $controller_function = 'sub_store_settings/Delivery_controller/get_bookstore_online_order';
                $this->get_action($controller_function);
                break;

                /*get_uniform_online_order
                 * @Author      : AHB
                 * Purpose      : TO Book store Online Order
                 * Created Date : 28-March-2020
                 */
            case ('get_uniform_online_order'):
                $controller_function = 'sub_store_uniform/Delivery_controller/get_uniform_online_order';
                $this->get_action($controller_function);
                break;

                /*get_bookstore_online_order
                 * @Author      : AHB
                 * Purpose      : TO Book store Online Order
                 * Created Date : 28-March-2020
                 */
            case ('get_payment_details'):
                $controller_function = 'sub_store_settings/Billing_controller/get_payment_details';
                $this->get_action($controller_function);
                break;

            case ('uniform_get_payment_details'):
                $controller_function = 'sub_store_uniform/Billing_controller/get_payment_details';
                $this->get_action($controller_function);
                break;

                /*For Image Porting
                 * @Author      : AHB
                 * Purpose      : TO Book store Online Order
                 * Created Date : 28-March-2020
                 */
            case ('get_student_images'):
                $controller_function = 'Student_settings/Student_controller/get_student_images';
                $this->get_action($controller_function);
                break;

                /* @Author      :  DOCME
             * Purpose      :  To save details of bill cancel
             * Created Date :  20-Feb-2018
             */
            case ('bookstore_voucher_cancel'):
                $controller_function = 'sub_store_settings/Billing_controller/voucher_cancel';
                $this->get_action($controller_function);
                break;

                /* @Author      :  DOCME
             * Purpose      :  To save details of bill cancel
             * Created Date :  20-Feb-2018
             */
            case ('uniform_voucher_cancel'):
                $controller_function = 'sub_store_uniform/Billing_controller/voucher_cancel';
                $this->get_action($controller_function);
                break;

                /* @Author      :  DOCME
             * Purpose      :  To save details of bill cancel
             * Created Date :  20-Feb-2018
             */
            case ('ACT_transactions_get_data'):
                $controller_function = 'Administration/Rims_integration_controller/ACT_transactions_get_data';
                $this->get_action($controller_function);
                break;

            case ('ACT_transactions_update_data'):
                $controller_function = 'Administration/Rims_integration_controller/ACT_transactions_update_data';
                $this->get_action($controller_function);
                break;


                //SALAHUDHEEN JULY 31, 2019 For Simplifying Traffic.php            
            case ($action):
                $this->get_controller($controller_function);
                break;
                //
                //Default Action                    
            default: // DEFAULT ACTION
                $this->invalidaction();
                break;
        }
    }

    //SALAHUDHEEN JULY 31, 2019 For Simplifying Traffic.php
    public function get_controller($controller_function)
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run($controller_function, $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function index_get()
    {
        if (!$this->get('action'))
            $this->response(array('message' => 'Get module is required.'));
        $action = $this->get('action');
        switch ($action) {
            case ('ping'): // SAMPLE PING                
                $this->ping();
                break;
                // case ('getstudents'):
                //     $this->getstudents();
                //     break;

            default: // DEFAULT ACTION
                $this->invalidaction();
                break;
        }
    }

    function ping()
    {
        $this->response(array('Status' => TRUE, 'message' => 'Working Fine.'));
    }

    // INVALID ACTION
    function invalidaction()
    {
        $this->response(array('status' => FALSE, 'message' => 'Invalid action name.'));
    }

    public function get_action($controller_function)
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run($controller_function, $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_countries()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Country_controller/get_countries', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_country()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Country_controller/save_country', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_country()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Country_controller/update_country', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_country_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Country_controller/modify_country_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_languages()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Language_controller/get_languages', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_language()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Language_controller/save_language', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_language()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Language_controller/update_language', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_language_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Language_controller/modify_language_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_profession()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Profession_controller/get_profession', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_institution_list()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Institution_controller/get_institution_list', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_profession()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Profession_controller/save_profession', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_profession()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Profession_controller/update_profession', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_Profession_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Profession_controller/modify_Profession_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_currency()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Currency_controller/get_currency', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_sponsers()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_sponsers', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    //    create function by vinoth for get_one_sponser deatils @ 30-06-2019
    public function get_one_sponsers()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_one_sponsers', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }


    public function save_currency()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Currency_controller/save_currency', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_sponser()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/save_sponser', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_currency()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Currency_controller/update_currency', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    //            create function by vinoth for update sponser @ 30-06-2019
    public function update_sponser()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/update_sponser', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_currency_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Currency_controller/modify_currency_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_city()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/City_controller/get_city', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_city()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/City_controller/save_city', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_city()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/City_controller/update_city', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_city_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/City_controller/modify_city_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_caste()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Caste_controller/get_caste', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_caste()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Caste_controller/save_caste', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_caste()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Caste_controller/update_caste', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_caste_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Caste_controller/modify_caste_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_role()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/get_role', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_role()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/save_role', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_role()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/update_role', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_role_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/modify_role_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_community()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Community_controller/get_community', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_community()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Community_controller/save_community', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_community()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Community_controller/update_community', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_community_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Community_controller/modify_community_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_institution()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Institution_controller/get_institution', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_institution()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Institution_controller/save_institution', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_institution()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Institution_controller/update_institution', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_religion()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Religion_controller/get_religion', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_religion()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Religion_controller/save_religion', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_religion()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Religion_controller/update_religion', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_religion_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Religion_controller/modify_status_religion', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function login_user()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Authenticator_controller/login_user', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function verify_user_for_login()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Authenticator_controller/verify_user_for_login', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function parent_verify_and_login_with_otp_and_api()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Authenticator_controller/parent_verify_and_login_with_otp_and_api', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function user_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Authenticator_controller/get_user_list', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_state()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/state_controller/get_states', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_state()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/State_controller/save_state', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_state()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/State_controller/update_state', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_state_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/State_controller/modify_state_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_studentparent_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_student_parentaddress', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_student_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_profile_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_profile_student_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_all_student_profile_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_profile_all_student_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_details_student()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_details_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }


    public function getstudent_profiledetails()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/getstudent_profiledetails', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function getstudent_sibilingsdetails()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_student_sibilings', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    // This Function written by Vinoth K @ 20-05-2019 6:10
    public function getstudent_sibilingsdetails_byadmno()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_student_sibilings_byadmno', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function getstudent_passportdetails()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_student_passportvisa', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_longabsentdetails_student()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_longabsentdetails_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //Book store starts here
    //Author DOCME
    //    public function get_publisher_details() {
    //        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //            $params = $this->post();
    //            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
    //            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Publisher_controller/get_publisher', $params)));
    //        } else {
    //            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //        }
    //    }
    //
    //    public function save_publisher() {
    //        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //            $params = $this->post();
    //            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
    //            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Publisher_controller/save_publisher', $params)));
    //        } else {
    //            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //        }
    //    }
    //
    //    public function update_publisher() {
    //        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //            $params = $this->post();
    //            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
    //            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Publisher_controller/update_publisher', $params)));
    //        } else {
    //            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //        }
    //    }
    //end DOCME
    //Item type starts here
    //Author docme

    public function get_itemtype_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemtype_controller/get_itemtype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_itemtype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemtype_controller/save_itemtype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_itemtype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemtype_controller/update_itemtype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_itemtype_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemtype_controller/modify_itemtype_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //end DOCME
    //author Docme
    //Item Edition//

    public function get_itemedition()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemedition_controller/get_itemedition', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_itemedition_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemedition_controller/modify_itemedition_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_itemedition()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemedition_controller/save_itemedition', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_itemedition()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemedition_controller/update_itemedition', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //@author DOCME
    public function get_student_search_list()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_student_search_list', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_student_by_name_or_admission()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_student_by_name_or_admission', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    //@author Aju S Aravind
    public function parent_search_for_registration()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/parent_search_for_registration', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    //@author Aju S Aravind
    public function get_la_student_by_admission_no()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Longabsent_controller/get_la_student_by_admission_no', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function search_student_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/search_student_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    // end DOCME
    //Course starts here
    //Author docme

    public function get_course()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Course_controller/get_course', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_course()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Course_controller/save_course', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_course()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Course_controller/update_course', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_course()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Course_controller/modify_course_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_course_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Course_controller/modify_course_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //end course DOCME
    //classes starts here
    //Author docme

    public function get_class()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Class_controller/get_class', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_classes()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Class_controller/save_classes', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_classes()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Class_controller/update_classes', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_course2()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Class_controller/modify_course_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //end classes DOCME
    //batch starts here
    //Author docme

    public function get_batch()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Batch_controller/get_batch', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_division()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Batch_controller/get_batch', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_batch_with_student_id()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Batch_controller/get_batch_with_student_id', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_batch()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Batch_controller/save_batch', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_batch()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Batch_controller/update_batch', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //    public function modify_batch() {
    //        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //            $params = $this->post();
    //            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
    //            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Class_controller/modify_batch_status', $params)));
    //        } else {
    //            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //        }
    //    }

    public function get_acdyear()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Academic_year_controller/get_acdyear', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_session()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Session_controller/get_session', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //end classes DOCME
    //Author docme Long absent Select
    public function get_longabsent()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Longabsent_controller/get_longabsent', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //end long Absent

    public function get_stream()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Stream_controller/get_stream', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_stream()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Stream_controller/save_stream', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_stream()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Stream_controller/update_stream', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    /*
     * @Author      :  Elavarasan S
     * Purpose      :  Temporary Registration saving purpose
     * Created Date :  21-May-2019
     */
    public function save_student_temp_reg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/save_student_temp_reg', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_student_temp_reg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/update_student_temp_reg', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_all_temp_students()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_all_temp_students', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function search_temp_reg_student()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/search_temp_reg_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_temp_reg_student()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_temp_reg_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_temp_reg_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_temp_reg_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_otp_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_otp_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_select_reg_date_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_select_reg_date_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_all_api_keys()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_all_api_keys', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind 
     * Purpose      :  Registration saving purpose
     * Created Date :  04-Oct-2017
     */

    public function save_personal_profile_reg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/save_personal_profile_reg', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind 
     * Purpose      :  Registration class details
     * Created Date :  17-03-2019
     */

    public function get_class_details_with_age_restriction()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_class_details_with_age_restriction', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind 
     * Purpose      :  Registration academic details saving purpose
     * Created Date :  04-Oct-2017
     */

    public function save_academic_profile_reg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/save_academic_profile_reg', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind 
     * Purpose      :  To get batch details to act as a filter for listing students
     * Created Date :  05-Oct-2017
     */

    public function get_batch_details_for_filter()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_batch_for_filter', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    // Author docme
    //Date :06 Oct 2017
    //  Purpose      :  Registration parent details saving purpose
    public function save_parent_profile_reg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/save_parent_profile_reg', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    ////  Purpose      :  Registration parent details edting purpose
    //    public function edit_parent_profile_reg() {
    //        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //            $params = $this->post();
    //            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
    //            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/edit_academic_profile_reg', $params)));
    //        } else {
    //            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //        }
    //    }
    //Select Country,get states -->author docme
    public function get_country_states()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Countrystate_controller/country_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_employee_list_from_wfm()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Institution_controller/get_employee_list_from_wfm', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_employee_details_from_wfm()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Institution_controller/get_employee_details_from_wfm', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //END Select Country,get states
    //Select States,get city -->author docme
    public function get_state_city()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Statecity_controller/state_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //END Select States,get city
    //Select Religion,get Caste -->author docme
    public function get_religion_caste()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Religioncaste_controller/caste_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //    public function status_history() {
    //        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //            $params = $this->post();
    //            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
    //            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/status_history', $params)));
    //        } else {
    //            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //        }
    //    }

    public function get_medium()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Medium_controller/get_medium', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_batch()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Class_controller/modify_batch_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_batch_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Batch_controller/modify_batch_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Chandrajith 
     * Purpose      :  Registration other details saving purpose
     * Created Date :  10-Oct-2017
     */

    public function save_otherdetails_reg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/save_other_detail', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_classes()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Class_controller/get_classes', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_class_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Class_controller/modify_class_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_class_course()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Class_controller/get_classes', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function status_history()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/status_history', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_active()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Active_controller/get_active', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind 
     * Purpose      :  Store Management - search item code / item name based on the key given
     * Created Date :  09-Oct-2017
     */

    public function get_items_by_code_and_name()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemmaster_controller/get_items_by_code_and_name', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind 
     * Purpose      :  Store Management - To get all store purchase list
     * Created Date :  09-Oct-2017
     */

    public function get_all_purchase_list()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/get_all_purchase_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : docme
     * Created Date :  010-Oct-2017
     * Purpose      : Supplier details for bookstore

     */

    public function get_suppliers()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Suppliers_controller/get_suppliers', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_suppliers()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Suppliers_controller/save_suppliers', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_suppliers()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Suppliers_controller/update_suppliers', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_suppliers_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Suppliers_controller/modify_suppliers_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : docme
     * Created Date :  010-Oct-2017
     * Purpose      : Category details for bookstore

     */

    public function get_category()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Category_controller/get_category', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_category()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Category_controller/save_category', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_category()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Category_controller/update_category', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_category_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Category_controller/modify_category_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : docme
     * Created Date :  010-Oct-2017
     * Purpose      : publisher details for bookstore

     */

    public function get_publisher()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Publisher_controller/get_publisher', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_publisher()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Publisher_controller/save_publisher', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_publisher()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Publisher_controller/update_publisher', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_publisher_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Publisher_controller/modify_publisher_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : docme
     * Created Date :  010-Oct-2017
     * Purpose      : Count  for bookstore

     */

    public function get_count()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Count_controller/get_count', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Chandrajith 
     * Purpose      :  Get all item details accordingly
     * Created Date :  06-Oct-2017
     */

    public function show_items_master()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemmaster_controller/get_items', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_itemmaster()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemmaster_controller/save_items', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : docme
     * Created Date :  010-Oct-2017
     * Purpose      : Category details for bookstore

     */

    //    public function modify_category_status() {
    //        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //            $params = $this->post();
    //            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
    //            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Category_controller/modify_category_status', $params)));
    //        } else {
    //            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //        }
    //    }

    public function update_items()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemmaster_controller/update_items', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_item_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Itemmaster_controller/modify_item_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function rate_item_show()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Ratemanagement_controller/get_item_rate', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function store_show()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Storemanagement_controller/get_stores', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : docme
     * Created Date :  011-Oct-2017
     * Purpose      : Count  for stundets 

     */

    public function get_student_count()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/get_student_count', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : docme
     * Created Date :  011-Oct-2017
     * Purpose      : Count  for Student Reistration <100 

     */

    public function get_stud_reg_count()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/get_stud_reg_count', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : docme
     * Created Date :  011-Oct-2017
     * Purpose      : Count  for Tc applied student count

     */

    public function get_tc_applied_count()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/get_tc_applied_count', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : docme
     * Created Date :  011-Oct-2017
     * Purpose      : Count  for Tc issue student count

     */

    public function get_tc_issue_count()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/get_tc_issue_count', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Chandrajith 
     * Purpose      :  Registration other details saving purpose
     * Created Date :  06-Oct-2017
     */

    public function save_facilitydetails_reg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/save_facility_detail', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Chandrajith 
     * Purpose      : TC application purpose
     * Created Date :  06-Oct-2017
     */

    public function save_tc()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Tc_settings/Tc_controller/save_tc', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //    public function get_tc_applied_stud() {
    //        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //            $params = $this->post();
    //            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
    //
    //            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Tc_settings/Tc_controller/get_tc_applied_stud', $params)));
    //        } else {
    //            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //        }
    //    }

    public function get_tc_applied_stud_by_id()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Tc_settings/Tc_controller/student_tcdetails_id', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_tc_types()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Tc_settings/Tc_controller/get_tc_type', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_tc_issue_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Tc_settings/Tc_controller/tcissue_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function std_batch_change()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/std_batch_change', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //create std_adm_no_change function by vinoth @ 24-05-2019 14:48
    public function std_admn_no_change()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            //            echo json_encode($params);
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/std_admn_no_change', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_gs_count()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Active_controller/get_active', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_direct_purchase_order()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/save_direct_purchase_order', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_purchase_order()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/save_purchase_order', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function edit_purchase()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/edit_purchase', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_purchase()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/update_purchase', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function approve_purchase()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/approve_purchase', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function item_search()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/item_search_list', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : docme
     * Created Date :  21-Oct-2017
     * Purpose      : Count  for Document

     */

    public function get_doc_count()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Document_controller/get_doc_count', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  docme
     * Purpose      :  Adhar validation
     * Created Date :  22-Oct-2017
     */

    public function adhar_validation()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/adhar_validation', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  docme
     * Purpose      :  Adhar validation
     * Created Date :  23-Oct-2017
     */

    public function mobile_validation()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/mobile_validation', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_course_type()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Course_controller/get_course_type', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_batch_allocate()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Course_settings/Batch_controller/save_batch_allocate', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Chandrajith
     * Purpose      :  TC Functionalities
     * Created Date :  23-Oct-2017
     */

    public function get_tc_applied_stud()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Tc_settings/Tc_controller/get_tc_applied_stud', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    //this Function written by Elavarasan S @ 16-05-2019 12:30
    public function get_tc_applied_stud_by_admno()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Tc_settings/Tc_controller/get_tc_applied_stud_by_admno', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_tc_prep()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Tc_settings/Tc_controller/save_tc_preparation', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function cancel_tc()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Tc_settings/Tc_controller/cancel_tc_preparation', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_tc_prepared_list()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Tc_settings/Tc_controller/get_tc_prepared_stud', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    //this Function written by Elavarasan S @ 16-05-2019 12:30
    public function get_tc_prepared_list_by_admno()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Tc_settings/Tc_controller/get_tc_prepared_stud_by_admno', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_longabsent()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Longabsent_controller/save_longabsentee', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_longabsent_students()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Longabsent_controller/show_longabsentee', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function longabsent_release()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Longabsent_controller/release_longabsentee', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  priotiry setting for selection of emailID
     * Created Date :  25-Oct-2017
     */

    public function Email_priority()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/Email_priority', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  search students for filter students & search inside batch
     * Created Date :  27-Oct-2017
     */

    public function student_search()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/student_search', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function no_batch_counts()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/no_batch_counts', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  docme
     * Purpose      :  Registration Edit purpose
     * Created Date :  04-Oct-2017
     */

    public function edit_personal_profile_reg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/edit_personal_profile_reg', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function edit_academic_profile_reg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/edit_academic_profile_reg', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function edit_parent_profile_reg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/edit_parent_profile_reg', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_doc_list()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Document_controller/get_doc_list', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  docme
     * Purpose      :  PRofile Edit purpose
     * Created Date :  1-Nov-2017
     */

    public function stud_profile_edit()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/stud_profile_edit', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function email_validation()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/email_validation', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  to get list of users
     * Created Date :  1-Nov-2017
     */

    public function get_users()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/User_controller/get_users', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  to get roles of users
     * Created Date :  1-Nov-2017
     */

    public function get_role_for_user()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/User_controller/get_role_for_user', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  to save new user details
     * Created Date :  2-Nov-2017
     */

    public function save_users()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/User_controller/save_users', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  to update user details
     * Created Date :  2-Nov-2017
     */

    public function update_users()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/User_controller/update_users', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  to update user status 
     * Created Date :  2-Nov-2017
     */

    public function modify_users_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/User_controller/modify_users_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  to update user email details
     * Created Date :  2-Nov-2017
     */

    public function user_email_update()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/User_controller/user_email_update', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  to update user role details
     * Created Date :  2-Nov-2017
     */

    public function user_role_update()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/User_controller/user_role_update', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  To get document types
     * Created Date :  06-Nov-2017
     */

    public function get_document_types()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Document_controller/get_document_title_master', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  To save document
     * Created Date :  06-Nov-2017
     */

    public function save_student_document()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Document_controller/save_student_document_to_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  To get file to download
     * Created Date :  08-Mar-2019
     */

    public function get_file_info_to_download()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Document_controller/get_file_info_to_download', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function remove_document()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Document_controller/remove_document', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function decrypt_document()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Document_controller/encrypt_file_for_document', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  docme
     * Purpose      :  PROMOTION
     * Created Date : 3-NOv-2017
     */

    public function get_promotion_stud()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_promotion_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_promoted_year()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_promoted_year', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_promoted_class()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_promoted_class', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_promotion()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/save_promotion', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_role_privileges()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/get_role_privileges', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function permission_app_menus()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/permission_app_menus', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function permission_app_modules()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/permission_app_modules', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_role_permission()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/save_role_permission', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  to get substore details
     * Created Date :  09-Nov-2017
     */

    public function get_sub_stores()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Storemanagement_controller/get_sub_stores', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  to get stock allotment details
     * Created Date :  10-Nov-2017
     */

    public function get_stock_allotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Storemanagement_controller/get_stock_allotment', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : docme S
     * Purpose      : to get opening stock master list
     * Created Date :  15-Nov-2017
     */

    public function get_opening_stock_master()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Opening_stock_controller/get_opening_stock_master', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  to save store details
     * Created Date :  14-Nov-2017
     */

    public function save_store()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Storemanagement_controller/save_store', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  to update store details
     * Created Date :  14-Nov-2017
     */

    public function update_store()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Storemanagement_controller/update_store', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  to update store Status
     * Created Date :  14-Nov-2017
     */

    public function modify_store_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Storemanagement_controller/modify_store_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  For changing rate of an item in a particular substore
     * Created Date :  17-Nov-2017
     */

    public function rate_change_item()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Ratemanagement_controller/rate_change_item', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  For changing rate of an item in all substore
     * Created Date :  17-Nov-2017
     */

    public function rate_change_item_for_allsubstore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Ratemanagement_controller/rate_change_item_for_allsubstore', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  For displaying rate of an item in all substore
     * Created Date :  17-Nov-2017
     */

    public function rate_display_item_for_allsubstore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Ratemanagement_controller/rate_display_item_for_allsubstore', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  approve direct purchace
     * Created Date :  21-Nov-2017
     */

    public function Approve_direct_purchase()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/Approve_direct_purchase', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  get purchase return list
     * Created Date :  21-Nov-2017
     */

    public function get_purchase_return()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_return_controller/get_purchase_return', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  Approve purchase return 
     * Created Date :  21-Nov-2017
     */

    public function approve_purchase_return()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_return_controller/approve_purchase_return', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  save purchase return 
     * Created Date :  21-Nov-2017
     */

    public function save_purchase_return()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_return_controller/save_purchase_return', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  For save stock allotment
     * Created Date :  17-Nov-2017
     */

    public function get_stock_allotment_list()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_allotment_controller/get_stock_allotment_list', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  For save stock allotment
     * Created Date :  17-Nov-2017
     */

    public function save_Stock_allotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_allotment_controller/save_Stock_allotment', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  approve stock allotment
     * Created Date :  17-Nov-2017
     */

    public function approve_allotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_allotment_controller/approve_allotment', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  To get direct purchase details for approval display
     * Created Date :  22-Nov-2017
     */

    public function get_purchase_approval_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/get_purchase_approval_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  30-Oct-2017
     * Purpose      : Display Student Strength Report

     */

    public function get_strength_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_strength_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    
    //create api get familywise data by vinoth @17-06-2019 11:40
    public function get_familywise_data_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_familywise_data_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_promotion_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_promotion_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_detained_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_detained_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_tc_summary_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_tc_summary_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_tc_app_status_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_tc_app_status_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  30-Oct-2017
     * Purpose      : Display Nationalitywise Report

     */

    public function get_nationality_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_nationality_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  30-Oct-2017
     * Purpose      : Display Religionwise Report

     */

    public function get_religion_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_religion_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  30-Oct-2017
     * Purpose      : Display Professionwise Report

     */

    public function get_profession_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_profesion_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  30-Oct-2017
     * Purpose      : Display Castewise Report

     */

    public function get_caste_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_caste_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  30-Oct-2017
     * Purpose      : Display Class Divisionwise Report

     */

    public function get_classdivision_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_classdivision_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_classwisestrngth_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_classwisestrgth_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_no_batch_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_no_batchstud_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  31-Oct-2017
     * Purpose      : Display Collected Document Report

     */

    public function get_collecteddoc_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_collecteddoc_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  31-Oct-2017
     * Purpose      : Display Genderwise Report

     */

    public function get_studgender_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_studgender_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  31-Oct-2017
     * Purpose      : Display Agewise Report

     */

    public function get_studagewise_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_studagewise_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  31-Oct-2017
     * Purpose      : Display Contactwise Report

     */

    public function get_studcontact_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_studcontact_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  31-Oct-2017
     * Purpose      : Display Familywise Report

     */

    public function get_familywise_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_familywise_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  31-Oct-2017
     * Purpose      : Display Longabsenteewise Report

     */

    public function get_longabsnt_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_longabsnt_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  31-Oct-2017
     * Purpose      : Display SexAgewise Report

     */

    public function get_studsexagewise_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_studsexagewise_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  02-Nov-2017
     * Purpose      : Display Custom Report

     */

    public function get_custom_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Custom_report_controller/get_custom_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      : Docme
     * Created Date :  02-Nov-2017
     * Purpose      : Display Genderwise Report

     */

    public function get_genderwise_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_genderwise_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  GET CURRENT STOCK
     * Created Date :  23-Nov-2017
     */

    public function get_current_stock_list()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Opening_stock_controller/get_current_stock_list', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  save opening stock
     * Created Date :  24-Nov-2017
     */

    public function save_opening_stock_new()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Opening_stock_controller/save_opening_stock_new', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  Purchaase receve details 
     * Created Date :  24-Nov-2017
     */

    public function get_purchase_details_for_receive()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/get_purchase_details_for_receive', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  Purchaase receve details 
     * Created Date :  24-Nov-2017
     */

    public function purchase_item_receive()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/purchase_item_receive', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  Edit purchase order
     * Created Date :  30-Nov-2017
     */

    public function save_edit_purchase_order()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/save_edit_purchase_order', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  Delete / mark inactive purchase order
     * Created Date :  30-Nov-2017
     */

    public function purchase_delete()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_controller/purchase_delete', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  Delete / mark inactive purchase order
     * Created Date :  30-Nov-2017
     */

    public function get_purchase_return_byid()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_return_controller/get_purchase_return_byid', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_allotment_approval_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_allotment_controller/get_allotment_approval_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  GET CURRENT STOCK FOR REPORT
     * Created Date :  23-Nov-2017
     */

    public function get_current_stock_list_report_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_controller/get_current_stock_list', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  GET CURRENT STOCK FOR REPORT
     * Created Date :  23-Nov-2017
     */

    public function uniform_get_current_stock_list_report_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_controller/uniform_get_current_stock_list', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  Get stock report data
     * Created Date :  23-Nov-2017
     */

    public function get_all_stock_report_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_controller/get_all_stock_report_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  Get report lock date
     * Created Date :  12-Dec-2017
     */

    public function report_lock_date()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_controller/report_lock_date', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  TO EDIT SAVE ALLOTMENT
     * Created Date :  14-Dec-2017
     */

    public function save_edit_allotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_allotment_controller/save_edit_allotment', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  TO EDIT SAVE PURCHASE RETURN
     * Created Date :  14-Dec-2017
     */

    public function save_edit_purchase_return()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_return_controller/save_edit_purchase_return', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  TO DELETE A PURCHASE RETURN
     * Created Date :  13-Dec-2017
     */

    public function purchase_return_delete()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Purchase_return_controller/purchase_return_delete', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  DOCME
     * Purpose      :  TO DELETE AN ALLOTMENT
     * Created Date :  13-Dec-2017
     */

    public function allotment_delete()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_allotment_controller/allotment_delete', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  Get allotment report for main store
     * Created Date :  12-Dec-2017
     */

    public function report_for_stock_allotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_controller/get_report_for_stock_allotment', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_teachingusers()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/User_controller/getteacher_users', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function getteacher_profiledetails()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/User_controller/getteacher_profiledetails', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_stock_for_allotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_controller/get_stock_for_allotment', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_billstudent_search_list()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_billstudent_search', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_student_search_list_for_reports()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_student_search_list_for_reports', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_advancestudent_search_list_for_reports()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_advancestudent_search_list_for_reports', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_billadvancestudent_search_list()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_billadvancestudent_search', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_advancestudent_search()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_advancestudent_search', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_bill_batch_list()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/get_billbatch_search', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function search_item_stock_for_allotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Bookstore_settings/Stock_controller/search_item_stock_for_allotment', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function getstudent_profiledetails_search()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/getstudent_profiledetails_search', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_name_bill()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/getstudent_profilebill_search', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_registration()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/save_registration', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_dashboard_details_count_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/get_dashboard_details_count_substore', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_dashboard_details_graph_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/get_dashboard_details_graph_substore', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function dashboard_daily_sales()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/dashboard_daily_sales', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function dashboard_notBilled()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/dashboard_notBilled', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function dashboard_notdelivered()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/dashboard_notdelivered', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function change_user_password()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/User_controller/change_user_password', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_user_role()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/save_user_role', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_user_activity()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/User_controller/get_user_activity', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_registration_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/save_registration_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function RIMS_student_registration()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_student_registration', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function RIMS_Longab_student_registration()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_Longab_student_registration', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function RIMS_student_update_sync()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_student_update_sync', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function RIMS_parent_registration()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_parent_registration', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function RIMS_address_registration()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_address_registration', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function RIMS_emp_designation()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_emp_designation', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function RIMS_emp_department()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_emp_department', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function RIMS_emp_master()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_emp_master', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function RIMS_transport_dataporting()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_transport_dataporting', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    // public function RIMS_transport_reg_dataporting(){
    //     if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //         $params = $this->post();
    //         $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

    //         $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_transport_reg_dataporting', $params)));
    //     } else {
    //         $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //     }
    // }
    public function RIMS_student_priority_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_get_priority_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    // public function RIMS_fuelprice_dataporting(){
    //     if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //         $params = $this->post();
    //         $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

    //         $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_fuelprice_dataporting', $params)));
    //     } else {
    //         $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //     }
    // }
    // public function RIMS_fuellogbook_dataporting(){
    //     if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //         $params = $this->post();
    //         $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

    //         $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_fuellogbook_dataporting', $params)));
    //     } else {
    //         $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //     }
    // }
    // public function RIMS_trip_dataporting(){
    //     if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //         $params = $this->post();
    //         $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

    //         $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_trip_dataporting', $params)));
    //     } else {
    //         $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //     }
    // }
    // public function RIMS_pickup_point_dataporting(){

    // }
    public function get_uuid_student_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_uuid_student_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_f_uuid_parent_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_f_uuid_parent_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_m_uuid_parent_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_m_uuid_parent_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_g_uuid_parent_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_g_uuid_parent_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    //create by vinoth @30-06-2019
    public function getdetails_student_for_online_pay()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/getdetails_student_for_online_pay', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function getdetails_student_by_id_for_online_pay()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Student_controller/getdetails_student_by_id_for_online_pay', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function std_batch_change_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/std_batch_change_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_country_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/save_country_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_state_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/save_state_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_religion_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/save_religion_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_caste_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/save_caste_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_community_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/save_community_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_currency_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/save_currency_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_profession_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/save_profession_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_language_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/save_language_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_city_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/save_city_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function std_status_change_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/std_status_change_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function data_push_for_auto_cop_integration()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Autocop_integration_controller/data_push_for_auto_cop_integration', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_roles()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/saveroles', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_roles()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/update_roles', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_role_permission_of_user()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/get_role_permission_of_user', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function available_permissions()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('General_settings/Roles_controller/available_permissions', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function primary_application_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Authenticator_controller/application_primary', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //SALAHUDHEEN
    public function currency_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Authenticator_controller/currency_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    /*
     * Uniform - Sub Store API Detail Start
     */

    public function uniform_save_packing_student()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Sales_packing_controller/save_packing_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_save_packing_faculty()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Sales_packing_controller/save_packing_faculty', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_student_pack()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Billing_controller/get_student_pack_billing', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_student_packdetailed()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Billing_controller/packdetailed', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_save_storecashbill()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Billing_controller/save_cashbill', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_save_delivery_student()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/save_delivery_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_student_pack_delivery()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/get_student_pack_delivery', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_packdetailed_delivery()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/packdetailed_delivery', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_replace_item_delivery()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/replace_item_delivery', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_save_delivery_item_replace()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/save_delivery_item_replace', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_ohtemplate()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/get_ohtemplate', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_save_oh_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/save_ohtemplate', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_edit_oh_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/edit_ohtemplate', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_save_openhouse()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/save_openhouse', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_openhouse_master()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/get_openhouse_master', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_openhouse_detail()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/get_openhouse_detail', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_edit_openhouse()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/edit_openhouse', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_delete_openhouse()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/delete_openhouse', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_search_student_pack_billing()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Billing_controller/search_student_pack_billing', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_save_oh_item_assign()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/save_oh_item_assign', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_oh_stud_assign_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/get_oh_stud_assign_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_select_item_oh_stud_assign()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/select_item_oh_stud_assign', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_stud_for_ohassign()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/get_stud_for_ohassign', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_save_oh_student_assign()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/save_oh_student_assign', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_student_pack_deliveryReturn()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/get_student_pack_deliveryReturn', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_save_deliveryReturn_student()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/save_deliveryReturn_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_faculty_pack_delivery()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/get_faculty_pack_delivery', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_faculty_pack_deliveryReturn()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/get_faculty_pack_deliveryReturn', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_save_deliveryReturn_faculty()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/save_deliveryReturn_faculty', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_sales_delivery_return_save_OH()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/sales_delivery_return_save_OH', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_student_voucher_search_delivery()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/get_student_voucher_search_delivery', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_stock_allotment_list_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Stock_allotment_controller/get_stock_allotment_list_substore', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_substore_sale_return_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Report_controller/Sales_Return_Report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_substore_sale_voucher_wise_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Report_controller/Sales_Voucher_wise_Report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_substore_sale_item_wise_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Report_controller/Sales_Item_wise_Report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_substore_sale_item_wise_summary_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Report_controller/Sales_Item_wise_summary_Report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_substore_billed_but_not_delivered_item_wise_summary_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Report_controller/billed_but_not_delivered_Item_wise_summary_Report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_voucher_search_faculty()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/voucher_search_faculty', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_substore_collection_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Report_controller/collection_Report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_substore_collection_report_user_wise()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Report_controller/collection_Report_User_wise', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_substore_summary_collection_report_user_wise()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Report_controller/summary_collection_Report_User_wise', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_bill_print_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Billing_controller/bill_print_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  Get stock report data substore
     * Created Date :  23-Nov-2017
     */

    public function uniform_get_all_stock_report_data_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Report_controller/get_all_stock_report_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_graph_substore_settings()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Store_settings_controller/get_graph_substore_settings', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  GET CURRENT STOCK FOR REPORT
     * Created Date :  23-Nov-2017
     */

    public function uniform_get_current_stock_list_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Store_settings_controller/get_current_stock_list', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_student_openhouse()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/get_student_openhouse', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_remove_oh_student_assign()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/remove_oh_student_assign', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_save_Stock_allotment_sub_out()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Stock_allotment_controller/save_Stock_allotment_sub_out', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_stock_allotment_list_substore_out()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Stock_allotment_controller/get_stock_allotment_list_substore_out', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_save_edit_allotment_out()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Stock_allotment_controller/save_edit_allotment_out', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_add_new_temp_openhouse()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/add_new_temp_openhouse', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_delivery_note_print_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Delivery_controller/get_delivery_note_print_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_bill_cancel()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Billing_controller/bill_cancel', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_openhouse_discount()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Oh_controller/get_openhouse_discount', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_stock_for_packing_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Stock_allotment_controller/get_stock_for_packing_substore', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_search_item_stock_for_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Stock_allotment_controller/search_item_stock_for_substore', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * Uniform - Sub Store API Detail End
     */


    /*
     * Book - Sub Store API Detail Start
     */

    public function save_packing_student()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Sales_packing_controller/save_packing_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_packing_faculty()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Sales_packing_controller/save_packing_faculty', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_pack()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Billing_controller/get_student_pack_billing', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_packdetailed()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Billing_controller/packdetailed', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_storecashbill()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Billing_controller/save_cashbill', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_delivery_student()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/save_delivery_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_pack_delivery()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/get_student_pack_delivery', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function packdetailed_delivery()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/packdetailed_delivery', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function replace_item_delivery()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/replace_item_delivery', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_delivery_item_replace()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/save_delivery_item_replace', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_ohtemplate()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/get_ohtemplate', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_oh_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/save_ohtemplate', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function edit_oh_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/edit_ohtemplate', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_openhouse()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/save_openhouse', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_openhouse_master()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/get_openhouse_master', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_openhouse_detail()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/get_openhouse_detail', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function edit_openhouse()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/edit_openhouse', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function delete_openhouse()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/delete_openhouse', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function search_student_pack_billing()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Billing_controller/search_student_pack_billing', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_oh_item_assign()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/save_oh_item_assign', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_oh_stud_assign_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/get_oh_stud_assign_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function select_item_oh_stud_assign()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/select_item_oh_stud_assign', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_stud_for_ohassign()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/get_stud_for_ohassign', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_oh_student_assign()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/save_oh_student_assign', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_pack_deliveryReturn()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/get_student_pack_deliveryReturn', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_deliveryReturn_student()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/save_deliveryReturn_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_faculty_pack_delivery()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/get_faculty_pack_delivery', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_faculty_pack_deliveryReturn()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/get_faculty_pack_deliveryReturn', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_deliveryReturn_faculty()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/save_deliveryReturn_faculty', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function sales_delivery_return_save_OH()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/sales_delivery_return_save_OH', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_voucher_search_delivery()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/get_student_voucher_search_delivery', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_stock_allotment_list_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Stock_allotment_controller/get_stock_allotment_list_substore', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function substore_sale_return_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Report_controller/Sales_Return_Report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function substore_sale_voucher_wise_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Report_controller/Sales_Voucher_wise_Report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function substore_sale_item_wise_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Report_controller/Sales_Item_wise_Report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function substore_sale_item_wise_summary_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Report_controller/Sales_Item_wise_summary_Report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function substore_billed_but_not_delivered_item_wise_summary_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Report_controller/billed_but_not_delivered_Item_wise_summary_Report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function voucher_search_faculty()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/voucher_search_faculty', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function substore_collection_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Report_controller/collection_Report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function substore_collection_report_user_wise()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Report_controller/collection_Report_User_wise', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function substore_summary_collection_report_user_wise()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Report_controller/summary_collection_Report_User_wise', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function bill_print_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Billing_controller/bill_print_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_bill_type()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Billing_controller/get_bill_type', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  Get stock report data substore
     * Created Date :  23-Nov-2017
     */

    public function get_all_stock_report_data_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Report_controller/get_all_stock_report_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_graph_substore_settings()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Store_settings_controller/get_graph_substore_settings', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * @Author      :  Aju S Aravind
     * Purpose      :  GET CURRENT STOCK FOR REPORT
     * Created Date :  23-Nov-2017
     */

    public function get_current_stock_list_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Store_settings_controller/get_current_stock_list', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_openhouse()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/get_student_openhouse', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function remove_oh_student_assign()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/remove_oh_student_assign', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_Stock_allotment_sub_out()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Stock_allotment_controller/save_Stock_allotment_sub_out', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_stock_allotment_list_substore_out()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Stock_allotment_controller/get_stock_allotment_list_substore_out', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_edit_allotment_out()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Stock_allotment_controller/save_edit_allotment_out', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function add_new_temp_openhouse()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/add_new_temp_openhouse', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_delivery_note_print_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Delivery_controller/get_delivery_note_print_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function bill_cancel()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Billing_controller/bill_cancel', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_openhouse_discount()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Oh_controller/get_openhouse_discount', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_stock_for_packing_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Stock_allotment_controller/get_stock_for_packing_substore', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function search_item_stock_for_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_settings/Stock_allotment_controller/search_item_stock_for_substore', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*
     * Book - Sub Store API Detail END
     */

    public function uniform_get_allotment_approval_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('sub_store_uniform/Stock_allotment_controller/get_allotment_approval_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_dashboard_details_count_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/uniform_get_dashboard_details_count_substore', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_dashboard_daily_sales()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/uniform_dashboard_daily_sales', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_dashboard_notdelivered()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/uniform_dashboard_notdelivered', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_get_dashboard_details_graph_substore()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/uniform_get_dashboard_details_graph_substore', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function uniform_dashboard_notBilled()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Authenticator/Dashboard_controller/uniform_dashboard_notBilled', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function act_transaction_download_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/act_transaction_download_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function act_transaction_download_update_RIMS()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/act_transaction_download_update_RIMS', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function RIMS_update_settings()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Administration/Rims_integration_controller/RIMS_update_settings', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_accountcode()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Accountcode_controller/get_account_code', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_accountcode()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Accountcode_controller/save_accountcode', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_accountcode()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Accountcode_controller/update_accountcode', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function status_accountcode()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Accountcode_controller/modify_accountcode_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_feetype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Feetype_controller/get_fee_type', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_feetype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Feetype_controller/save_feetype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_feetype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Feetype_controller/update_feetype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_feetype_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Feetype_controller/modify_feetype_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //Demand Frequency
    public function get_demand_frequency()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Demand_frequency_controller/get_demand_frequency', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_demand_frequency()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Demand_frequency_controller/save_demand_frequency', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_demand_frequency()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Demand_frequency_controller/update_demand_frequency', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_demand_frequency_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Demand_frequency_controller/modify_demand_frequency_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //Fee code
    public function get_fee_code()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Feecode_controller/get_fee_code', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_linked_fee_code()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Feecode_controller/get_linked_fee_code', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function save_fee_code()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Feecode_controller/save_fee_code', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_fee_code()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Feecode_controller/update_fee_code', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_fee_code_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Feecode_controller/modify_fee_code_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function approve_fee_code()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Feecode_controller/approve_or_reject_fee_code', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_demand_type()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Feedemandabletype_controller/get_demand_type', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_fee_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_template_controller/get_fee_template', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_fee_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_template_controller/save_fee_template', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_edit_fee_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_template_controller/save_edit_fee_template', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function delete_fee_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_template_controller/delete_fee_template', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function fee_code_linked_with_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/fee_code_linked_with_template', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function fee_code_not_linked_to_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/fee_code_not_linked_to_template', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_fee_code_to_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/save_fee_code_to_template', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_class_details_with_linked_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/get_class_details_with_linked_template', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_batch_details_with_linked_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/get_batch_details_with_linked_template', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_students_for_fee_template_allocation()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/get_students_for_fee_template_allocation', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function check_other_fee_code_demanded()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/check_other_fee_code_demanded', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_periodic_fee_allocation_with_students()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/save_periodic_fee_allocation_with_students', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_bus_fee_demanded_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/get_bus_fee_demanded_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_list_with_fee_allocated()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/get_student_list_with_fee_allocated', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_de_allocation_of_students_from_template()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/save_de_allocation_of_students_from_template', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_other_fee_allocation()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/save_other_fee_allocation', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_other_fee_allocation_classwise()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/save_other_fee_allocation_classwise', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_all_feecodes_available()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_all_feecodes_available', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_fee_data_for_collection()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_student_fee_data_for_collection', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_fee_payment_for_student()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_fee_payment_for_student', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_wallet_amount_for_student_bycash()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_wallet_amount_for_student_bycash', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_base_data_for_cheque_reconcile()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_base_data_for_cheque_reconcile', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_recon_status_of_cheque()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_recon_status_of_cheque', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_black_listed_students()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_black_listed_students', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_blacklist_release()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_blacklist_release', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_wallet_amount_for_student_bycheque()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_wallet_amount_for_student_bycheque', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_wallet_amount_for_student_bycard()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_wallet_amount_for_student_bycard', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function save_wallet_amount_for_student_bydbt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_wallet_amount_for_student_bydbt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_account_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/account_controller/get_student_account_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_payback_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Payback_controller/get_payback_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vouchers_for_payback()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Payback_controller/get_vouchers_for_payback', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vouchers_details_for_payback()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Payback_controller/get_vouchers_details_for_payback', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_wallet_data_for_summary()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_student_wallet_data_for_summary', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_withdraw_request_list_data_summary()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_withdraw_request_summary', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_withdraw_request()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];

            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_withdraw_request', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_approve_data_for_wallet_withdraw()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_approve_data_for_wallet_withdraw', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_withdraw_approval()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_withdraw_approval', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_encashment_data_for_wallet_withdraw()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_encashment_data_for_wallet_withdraw', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_withdrawal_encashment_bycash()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_withdrawal_encashment_bycash', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_withdrawal_encashment_bycheque()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_withdrawal_encashment_bycheque', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_view_data_for_wallet_withdrawal()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_view_data_for_wallet_withdrawal', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_payback_request()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Payback_controller/save_payback_request', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_payback_data_for_approval()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Payback_controller/get_payback_data_for_approval', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_payback_data_for_view()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Payback_controller/get_payback_data_for_view', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_payback_approval()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Payback_controller/save_payback_approval', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_priority_information()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Priority_controller/get_priority_information', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_priority_information_fee_code_manage()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Priority_controller/get_priority_information_fee_code_manage', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_feecodes_for_student_priority_management()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Priority_controller/save_feecodes_for_student_priority_management', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_priority_information_for_staff()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Priority_controller/get_priority_information_for_staff', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_priority_information_fee_code_manage_for_staff()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Priority_controller/get_priority_information_fee_code_manage_for_staff', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_feecodes_for_staff_priority_management()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Priority_controller/save_feecodes_for_staff_priority_management', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_data_for_voucher_cancellation()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_data_for_voucher_cancellation', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_data_for_voucher_reprint()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_data_for_voucher_reprint', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_voucher_search()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_voucher_search', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_voucher_types()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_voucher_types', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_data_for_voucher_cancellation_data_by_voucher_id()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_data_for_voucher_cancellation_data_by_voucher_id', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_voucher_data_by_id_for_reprint()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_voucher_data_by_id_for_reprint', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function save_voucher_cancel()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_voucher_cancellation', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_demanded_bus_fee()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/demand_bus_fee', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_counter_collection_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_counter_collection_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_students_for_arrear_listing()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Priority_controller/get_students_for_arrear_listing', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_arrear_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Priority_controller/save_todays_arrear_summary', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_voucher_wise_collection_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_voucher_wise_collection_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_received_non_demandable_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_received_non_demandable_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_individual_collection_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_individual_collection_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_collection_class_wise_summary_report_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_collection_class_wise_summary_report_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_collection_class_wise_details_report_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_collection_class_wise_details_report_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_collection_user_wise_details_report_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_collection_user_wise_details_report_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_cheque_ledger_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_cheque_ledger_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_wallet_deposit_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_wallet_deposit_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vat_collection_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_vat_collection_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_voucher_cancellation_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_voucher_cancellation_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_wallet_withdraw_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_wallet_withdraw_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_wallet_statement_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_wallet_statement_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_online_pay_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_online_pay_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_payback_summary_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_payback_summary_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_headwise_collection_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_headwise_collection_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_summary_collection_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_summary_collection_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_demand_fee_allocation_individual()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_structure_controller/save_demand_fee_allocation_individual', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_advancestudent_search_list_for_one_time_pay()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/get_advancestudent_search_list_for_one_time_pay', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_one_time_adjustment_with_wallet_to_pending_pay()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_collection_controller/save_one_time_adjustment_with_wallet_to_pending_pay', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_arrear_list_report_as_on_date_for_batch()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_arrear_list_report_as_on_date_for_batch', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_arrear_list_longab_report_as_on_date_for_batch()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_arrear_list_longab_report_as_on_date_for_batch', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_dcb_report_student_wise()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_dcb_report_student_wise', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_id_wise_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_student_id_wise_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_dcb_report_batch_wise()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Fee_report_controller/get_dcb_report_batch_wise', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_fee_details_for_student_online_pay_display()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Onlinepay_controller/get_fee_details_for_student_online_pay_display', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_atompay_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Onlinepay_controller/save_atompay_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function deposit_wallet_atom()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Fees_settings/Onlinepay_controller/deposit_wallet_atom', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    /*     * ******************************************************************************************************************
      ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞
      /******************************************************************************************************************* */

    public function get_vehicletype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicletype_controller/get_vehicletype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_vehicletype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicletype_controller/save_vehicletype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_vehicletype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicletype_controller/update_vehicletype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_vehicletype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicletype_controller/modify_vehicletype_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehicle_make()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/vehiclemake_controller/get_vehiclemake', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_vehicle_make()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/vehiclemake_controller/save_vehiclemake', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_vehicle_make()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/vehiclemake_controller/update_vehiclemake', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_vehicle_make()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/vehiclemake_controller/modify_vehiclemake_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_insurance()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Insurance_controller/get_insurance', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_insurance()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Insurance_controller/save_insurance', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_insurance()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Insurance_controller/update_insurance', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_insurance()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Insurance_controller/modify_insurance_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_fueltype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Fueltype_controller/get_fueltype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_fueltype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Fueltype_controller/save_fueltype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_fueltype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Fueltype_controller/update_fueltype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_fueltype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Fueltype_controller/modify_fueltype_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_trip()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_controller/get_trip', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_trip_details_byId()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_controller/get_trip_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_particulartrip()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_controller/get_particulartrip', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_trip_allotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_controller/get_trip_allotment', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_trip()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_controller/save_trip', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_tripvehiclemap()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_vehicle_mapping_controller/save_tripvehiclemap', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehicledetails_trip()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_vehicle_mapping_controller/get_vehicledetails_trip', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_trip()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_controller/update_trip', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_trip()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_controller/modify_trip_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_model()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicle_model_controller/get_vehiclemodel', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_model()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicle_model_controller/save_vehiclemodel', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_model()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicle_model_controller/update_vehiclemodel', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_model()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicle_model_controller/modify_vehiclemodel_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_servicecenter()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/servicecenter_controller/get_service_center', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_servicecenter_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/servicecenter_controller/modify_servicecenter_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_servicetype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/servicetype_controller/get_servicetype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_particularservicetype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Service_type_controller/get_particularservicetype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_servicetype_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/service_type_controller/modify_servicetype_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function update_servicetype()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/service_type_controller/update_servicetype', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_servicecenter()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/servicecenter_controller/save_servicecenter', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_servicetypes()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/servicetype_controller/save_servicetypes', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_servicecenter()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/servicecenter_controller/update_servicecenter', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_servicecenter()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/servicecenter_controller/modify_servicecenter_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_particularservicecenter()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/servicecenter_controller/get_particularservicecenter', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehiclereg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleregistration_controller/get_vehicleregistrationdetails', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehiclereg_for_driver()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Driver_controller/get_vehiclereg_for_driver', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_vehiclereg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleregistration_controller/save_vehicleregistration', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_vehicle_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleregistration_controller/modify_vehreg_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_vehiclereg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleregistration_controller/update_vehicleregistration', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_vehiclereg()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleregistration_controller/modify_vehicleregistration_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_make()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicle_make_controller/get_make', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_make()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicle_make_controller/save_make', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_make()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicle_make_controller/update_make', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_make()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicle_make_controller/modify_make_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_route()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicle_route_controller/get_route', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_maintanance()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_maintanance', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_trip_pickups()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_controller/get_trip_pickuppoints', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_route()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicle_route_controller/save_route', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_route()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicle_route_controller/modify_route', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_route()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicle_route_controller/update_route', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_pickuppoint()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pickup_point_controller/get_pickuppoint', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_pickpoint_feez()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pickup_point_controller/get_pickpoint_feez', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_trip_routemappickuppoint()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_student_controller/get_trippickuppoint_time', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_trip_routemappickuppoint_emp()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_staff_controller/get_trippickuppoint_time_emp', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_trip_passengerallotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_student_controller/get_trips_stops_mapped', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehicle_trip_driver_cleaner_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_student_controller/get_vehicle_trip_driver_cleaner_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_dropvehicle_trip_driver_cleaner_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_student_controller/get_dropvehicle_trip_driver_cleaner_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function savestudent_passengerallotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_student_controller/student_allotment_save', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_search_list_for_transport()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_student_controller/get_student_search', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_advancestudent_search_list_for_transport()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_student_controller/get_student_advancesearch', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function savestudent_passengerallotment_diff_route()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_student_diff_route_controller/student_allotment_save', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function savestudent_passengerallotment_pickchange()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pick_student_pickchange_controller/student_allotment_save', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function saveemployee_passengerallotment_pickchange()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pick_emp_pickchange_controller/employee_allotment_save', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function savestudent_passengerallotment_tripchange()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_stud_tripchange_controller/student_allotment_save', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function saveemp_passengerallotment_tripchange()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_emp_tripchange_controller/emp_allotment_save', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function saveemp_passengerallotment_droptripchange()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pick_emp_dropchange_controller/emp_allotment_save', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_routelinktrips_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_stud_tripchange_controller/get_triplink_pick_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_routelinkpickemptrips_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_emp_tripchange_controller/get_triplink_pick_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_routelinkdropemptrips_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pick_emp_dropchange_controller/get_triplink_pick_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function routewise_trip()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_stuffs_controller/routewise_trip', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function routewise_trip_stops()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_stuffs_controller/routewise_trip_stops', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //get trip name by vinoth @10-06-2019 11:37
    public function vehiclewise_tripname()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_stuffs_controller/vehiclewise_tripname', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehiclewise_student_passengers()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_vehiclewisewisedata_controller/get_vehiclewise_passnger_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_trip_student_passengers()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_tripwisedata_controller/get_tripwise_passnger_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_route_student_passengers()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_routewisedata_controller/get_routewise_passnger_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function savestudent_passengerallotment_droptripchange()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_stud_tripchange_controller/student_allotment_save', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_routelinkdroptrips_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_stud_droptripchange_controller/get_triplink_drop_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function savestudent_passengerallotment_dropchange()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Drop_student_dropchange_controller/student_allotment_save', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function saveemp_passengerallotment_dropchange()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Drop_emp_dropchange_controller/emp_allotment_save', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function savestudent_passengerallotment_pick()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_student_controller/student_allotment_save_pick', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_student_pickchange_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pick_student_pickchange_controller/get_student_alloted_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_emp_pickchange_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pick_emp_pickchange_controller/get_emp_alloted_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_emp_dropchange_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pick_emp_dropchange_controller/get_emp_alloted_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_triplinkpickchnge_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pick_student_pickchange_controller/get_triplink_pick_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_emptriplinkpickchnge_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pick_emp_pickchange_controller/get_triplink_pick_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_triplinkdropchnge_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Drop_student_dropchange_controller/get_triplink_drop_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_emptriplinkdropchnge_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Drop_emp_dropchange_controller/get_triplink_drop_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_allotmnetprevious_data_pickchnge()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pick_student_pickchange_controller/get_allotmnetprevious_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_empallotmnetprevious_data_pickchnge()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Drop_emp_dropchange_controller/get_allotmnetprevious_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    //    public function get_empallotmnetprevious_data_pickchnge() {
    //        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
    //            $params = $this->post();
    //            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
    //            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pick_emp_pickchange_controller/get_allotmnetprevious_data', $params)));
    //        } else {
    //            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
    //        }
    //    }
    public function savestudent_passengerallotment_drop()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_student_controller/student_allotment_save_drop', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function saveguest_passengerallotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_guest_controller/guest_allotment_save', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_pickuppoint()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pickup_point_controller/save_pickuppoint', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_pickuppoint()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pickup_point_controller/update_pickuppoint', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_pickuppoint()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Pickup_point_controller/modify_pickuppoint_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_model_date()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/vehiclemodeldate_controller/get_vehiclemodeldate', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_model_date()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/vehiclemodeldate_controller/save_vehiclemodeldate', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_model_date()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/vehiclemodeldate_controller/update_vehiclemodeldate', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_model_date()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/vehiclemodeldate_controller/modify_vehiclemodeldate_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_incidents()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Incidents_controller/save_vehicle_incidents', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_incidents()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Incidents_controller/get_vehicle_incidents', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_service_type()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Service_type_controller/get_vehicleservicetype_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_service_booking()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleservicebooking_controller/save_vehicleservice_booking', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_service_invoice()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleservicebooking_controller/save_service_invoice', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_route_pick_map()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Route_pickmap_controller/save_routepick_map', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_route_pick_map()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Route_pickmap_controller/get_routepick_map', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_route_pick_maps_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Route_pickmap_controller/get_route_pick_maps_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_route_pick_maps_details_stoptimes()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Route_pickmap_controller/get_route_pick_maps_details_stoptimes', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_route_trip_map()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Route_tripmap_controller/save_routetrip_map', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_triproutemap_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Route_tripmap_controller/get_routetrip_map', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_triproutetime_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Route_tripmap_controller/get_trippickuppoint_time', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_staff_allotments()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_staff_controller/get_staff', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_emp_passengerallotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_staff_controller/emp_allotment_save', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_emp_passengerallotment_pick()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_staff_controller/emp_allotment_save_pick', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_emp_passengerallotment_drop()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_staff_controller/emp_allotment_save_drop', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_trip_route_pickpoint()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_route_pickpointmap_controller/save_trip_route_pickpoint', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_trip_mapz()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_route_pickpointmap_controller/get_tripmapdetails', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_bus_trip_map()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Bus_trip_mapping_controller/save_bustrip_map', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_trip_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Student_allotment_controller/get_trip_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_triplinkvehi()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Trip_vehicle_mapping_controller/get_triplinkvehi', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_pickup_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Student_allotment_controller/get_pickup_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_allotment_student_transport()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Student_allotment_controller/save_student_allotment', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_allotment_guest_transport()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Guest_allotment_controller/save_guest_allotment', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_allotment_staff_transport()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Staff_allotment_transport/save_staff_allotment', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_allotted_students()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Student_deallocate_controller/get_allotted_students', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function deallocate_student()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_deallocate_student_controller/get_stud_transport_detaildata', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function savestudent_passengerdeallotment()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_deallocate_student_controller/savestudent_passengerdeallotment', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function savestudent_passengerdeallotment_drop()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Passenger_deallocate_student_controller/savestudent_passengerdeallotment_drop', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_allotted_staffs()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Staff_deallocate_transport/get_allotted_employees', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function deallocate_staff()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Staff_deallocate_transport/modify_allotted_employees', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_allotted_guests()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Guest_deallocate_controller/get_allotted_guests', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function deallocate_guest()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Guest_deallocate_controller/modify_allotted_guests', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_route_pickpoint_map()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Route_pickmap_controller/get_routepickuppoint', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_inst_drivers()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Staff_vehicle_controller/get_staff_drivers', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehicl_staff_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Staff_vehicle_controller/get_staff_vehicle_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function disable_vehstaff_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Staff_vehicle_controller/disable_vehstaff_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehicleservicebooking_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleservicebooking_controller/get_vehicleservicebooking_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_servicebooked_vehicle()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleservicebooking_controller/get_servicebooked_vehicle', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function checking_servicebooked_vehicle()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleservicebooking_controller/checking_isvehicle_service', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_inst_cleaners()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Staff_vehicle_controller/get_staff_cleaners', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_staff_bus()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Staff_vehicle_controller/save_vehicle_staff', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    // This function written by Elavarasan S @ 07.06.2019 5.30
    public function modify_vehicle_staff_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Staff_vehicle_controller/disable_vehstaff_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_fuel_log()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Fuel_log_controller/get_fuellog', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_fuel_log_transport()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Fuel_log_controller/get_fuellog', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_fuel_log()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Fuel_log_controller/save_fuel_log_entry', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_spareparts()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Spareparts_controller/get_spareparts', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function select_parts_for_edit()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Spareparts_controller/get_particularpart', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function select_service_type_for_edit()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Service_type_controller/get_particularservice_type', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_parts_spare()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Spareparts_controller/save_spareparts', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_spare_part()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Spareparts_controller/save_sparepart', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function disable_spare_part()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Spareparts_controller/disable_spare_part', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_parts_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Spareparts_controller/modify_parts_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_particularpart()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Spareparts_controller/get_particularpart', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_spareparts()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Spareparts_controller/update_spareparts', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_acessories()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Acessories_controller/get_acessories', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_acessories()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Acessories_controller/save_acessories', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_fuellog()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_fuellog', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_maintainrpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_maintainrpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_incidents_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_incidentsrpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_costrpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_costreport', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_maintain_summary_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_maintain_summary_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehicle_expenditure()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_vehicle_expenditurerpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehicle_expenditure_summary()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_vehicle_expenditure_summaryrpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_fuelconsumption()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_fuelconsumption', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vhicleincidentrpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_vhicleincidentrpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_maintenance_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_maintenance_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_trip_pick_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_trip_pick_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_trip_stops_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_trip_stops_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_route_trip_stops_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_route_trip_stops_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function getvehicle_route_trip_stops_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/getvehicle_route_trip_stops_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_pickstopswise_student_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_pickstopswise_student_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_dropstopswise_student_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_dropstopswise_student_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_tripwise_student_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_tripwise_student_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_routewise_student_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_routewise_student_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_fueltype_log()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Fuel_log_controller/get_fueltype_log', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_transportlockdate()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/report_lock_date', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_spares_report()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Transport_report_controller/get_spares_report', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_feesdata_pickpoint()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Fees_transport_controller/save_pickuppoint_fees', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehicle_invoice_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleservicebooking_controller/get_invoice_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_particular_vehicle_invoice_details()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleservicebooking_controller/get_particular_vehicle_invoice_details', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehicle_invoice_history()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleservicebooking_controller/get_vehicle_invoice_history', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vehicle_service_history()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vehicleservicebooking_controller/get_vehicle_service_history', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_vendor()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vendor_controller/get_vendor', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_vendor()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vendor_controller/save_vendor', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_vendor_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vendor_controller/modify_vendor_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function get_particularvendor()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vendor_controller/get_particularvendor', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }
    public function update_vendor()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Vendor_controller/update_vendor', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_directpurchase_spare()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Direct_purchase_controller/get_directpurchase', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_spare_directpurchase()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Direct_purchase_controller/save_spare_directpurchase', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function modify_dp_status()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Direct_purchase_controller/modify_dp_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_spareparts_stock()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Sparestock_controller/get_parts_stockdata', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_vehicle_parts_spare_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Spareparts_controller/saveparts_vehicle_data', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_spareparts_vehicle_alloted()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Spareparts_controller/get_spareparts_vehicle_alloted', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_staff_sibling_list()
    {

        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Student_settings/Registration_controller/get_staff_sibling_list', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_conductors()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Conductor_controller/get_conductors', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_driver()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Driver_controller/get_driver', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_conductor()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Conductor_controller/save_conductor', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function save_driver()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Driver_controller/save_driver', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function select_conductor_for_edit()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Conductor_controller/get_particularconductor', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function select_driver_for_edit()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Driver_controller/get_particulardriver', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_conductor()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Conductor_controller/update_conductor', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function update_driver()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Driver_controller/update_driver', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }


    public function status_modify_conductor()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Conductor_controller/modify_conductor_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function status_modify_driver()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Driver_controller/modify_driver_status', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }




    public function get_select_emp_data()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Conductor_controller/get_select_emp', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_employee()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Conductor_controller/get_employee', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_employeefor_driver()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Transport_settings/Driver_controller/get_employee', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_course_classwise_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_course_classwise_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

    public function get_course_batchwise_rpt()
    {
        if (isset($_SERVER['HTTP_API_KEY']) && !empty($_SERVER['HTTP_API_KEY'])) {
            $params = $this->post();
            $params['API_KEY'] = $_SERVER['HTTP_API_KEY'];
            $this->response(array('status' => TRUE, 'message' => 'Success Call', 'data' => Modules::run('Report_settings/Registration_report_controller/get_course_batchwise_rpt', $params)));
        } else {
            $this->response(array('status' => FALSE, 'message' => 'Invalid KEY', 'data' => FALSE));
        }
    }

}
