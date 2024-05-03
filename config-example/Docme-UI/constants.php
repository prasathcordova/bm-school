<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|--------------------------------------------------------------------------
| Constant title & messages
|--------------------------------------------------------------------------
 * 
 * 
 */

define('APP_TITLE', 'Docme.Cloud - School Management System');
define('ERROR_404_AJAX', 'template/error-404-ajax');
define('ERROR_500_AJAX', 'template/error-500-ajax');
define('ERROR_500', 'template/error-500');
define('ERROR_500_NEW', 'template/error-500-new');
define('INVALID_REQUEST_MESSAGE', 'Invalid request. Please try again');

define('RIMS_API_URL_TCS', 'http://10.10.4.47/DocmeClientAPI/api/');
define('RIMS_API_URL_NIMSSSJ', 'http://10.10.4.47/DocMeClientAPI/api/');
define('RIMS_API_URL_NIMSALAIN', 'http://10.10.4.47/DocMeClientAPI/api/');
define('RIMS_API_URL_NIMSDXB', 'http://10.10.4.47/DocMeClientAPI/api/');
define('RIMS_API_URL_OXFTVM', 'http://10.10.4.47/DocMeClientAPI/api/');
define('RIMS_API_URL_OXFKLM', 'http://10.10.4.47/DocMeClientAPI/api/');
define('RIMS_API_URL_MODELAUH', 'http://10.10.4.47/DocMeClientAPI/api/');
define('RIMS_API_URL_OXFCLT', 'http://10.10.4.47/DocMeClientAPI/api/');







/*
|--------------------------------------------------------------------------
| URL
|--------------------------------------------------------------------------
 * 
 * 
 */
define('HOME', 'general_settings/home/dashboard');
define('SERVICE_URL', "http://localhost/docme-school/api/Traffic");
define('SERVICE_URL_RIMS', "http://10.10.4.47/docmeclientapi_trans/api/Transport/postRIMSTransportStudents");
define('DEFAULT_PROFILE_IMAGE_PATH', 'uploads/img/user/');
define('IMG_UPLOADS', 'uploads/img/tmp/');
define('FILE_UPLOAD_PATH', $_SERVER['DOCUMENT_ROOT'] .  DIRECTORY_SEPARATOR . 'docme-school' .   DIRECTORY_SEPARATOR . 'Docme-UI' .  DIRECTORY_SEPARATOR . 'assets' .  DIRECTORY_SEPARATOR . 'Uploads' .  DIRECTORY_SEPARATOR . 'documents');
define('LOGIN_API_KEY', '525-777-777');
define('GOOGLE_CLIENT_ID', '1046262373002-9o876k5tj60ekr3mdmcf9a22d8ioaiq0.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'Bq8Id9ZK7raSJ1ebfwiPFhro');
//define('APP_VERSION','v1.0.8');
//define('CURRENT_ACD_YEAR_ID',28);
//define('INST_ID',4);
//define('STORE_ID',4);
//define('STORE_NAME','STORE/SCHOOL');
define('FILE_DOWNLOAD_PATH', 'assets/Uploads/documents/download/');
define('SEARCH_ITEM_COUNT_MAX_LIMIT', 1000000000);
define('M_YEAR', 2019);
define('M_MONTH', 01);
define('M_DATE', 30);
//define('IS_EMAIL_TEST',1);
//define('TEST_EMAIL_DATA','aju@docme.cloud' );
define('REPORTS_FOLDER_PATH', $_SERVER['DOCUMENT_ROOT'] .  DIRECTORY_SEPARATOR . 'docme-school' .  DIRECTORY_SEPARATOR . 'Docme-UI' . DIRECTORY_SEPARATOR . 'reports' . DIRECTORY_SEPARATOR);
define('BILL_FOLDER_PATH', $_SERVER['DOCUMENT_ROOT'] .  DIRECTORY_SEPARATOR . 'docme-school' .  DIRECTORY_SEPARATOR . 'Docme-UI' . DIRECTORY_SEPARATOR . 'bill' . DIRECTORY_SEPARATOR);


define('SUPPORT_EMAIL_OXFTVM', 'dd@mailinator.com');
define('SUPPORT_EMAIL_OXFKLM', 'dd@mailinator.com');
define('SUPPORT_EMAIL_OXFCLT', 'dd@mailinator.com');
define('SUPPORT_DEV_TEAM_EMAIL', 'dd@mailinator.com');

define('ACCOUNTS_EMAIL_OXFTVM', 'dd@mailinator.com');
define('ACCOUNTS_EMAIL_OXFKLM', 'dd@mailinator.com');
define('ACCOUNTS_EMAIL_OXFCLT', 'dd@mailinator.com');

define('INST_NAME_TVM', 'The Oxford School,Trivandrum');
define('INST_NAME_KLM', 'The Oxford School,Kollam');
define('INST_NAME_CLT', 'The Oxford School,Calicut');


define('CURRENCY', '&#8377');
define('MATOMO_SITE_ID', 20);
define('TAXNAME', 'GST');
define('GSTNO', 'GST No : 32AAOFG7745A1ZJ');
define('STORE_ADDRESS', 'Globtech Logistics,<br/>Trivandrum');

define('ACCOUNT_NUMBER', '556301010050287');
define('CLIENT_CODE', '007');
define('REQHASHCODE', '56b57333c3055f6b56');
define('RESPHASHCODE', 'b1ea194cba9599735f');
define('PRODUCT_TYPE', 'NSE');
define('PG_LOGIN', '19366');
define('PG_PASSWORD', 'OXFST@123');
