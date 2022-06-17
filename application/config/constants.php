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
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', true);

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
defined('FILE_READ_MODE') or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
 */
defined('FOPEN_READ') or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
defined('EXIT_SUCCESS') or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/************* Applications Constants *********************/

define('SITETITLE', 'Shree Export');

// Database Tables

define('TBL_BACKUP','tbl_backup');
define('TBL_COMPANY_MANAGEMENT','tbl_company_management');
define('TBL_COMPANY_PERSON','tbl_company_person');
define('TBL_COUNTRY_MASTER','tbl_country_master');
define('TBL_CUSTOMER_ITEM','tbl_customer_item');
define('TBL_CUSTOMER_ITEM_SUB','tbl_customer_item_sub');
define('TBL_CUSTOMER_MANAGEMENT','tbl_customer_management');
define('TBL_CUSTOMER_PERSON','tbl_customer_person');
define('TBL_DEPARTMENT','tbl_department');
define('TBL_FINANCIAL_YEAR','tbl_financial_year');
define('TBL_INVENTORY','tbl_inventory');
define('TBL_INVOICE','tbl_invoice');
define('TBL_INVOICE_SUB','tbl_invoice_sub');
define('TBL_INVOICE_PAYMENT','tbl_invoice_payment');
define('TBL_DELIVERYCHALLAN','tbl_deliverychallan');
define('TBL_DELIVERYCHALLAN_SUB','tbl_deliverychallan_sub');
define('TBL_DELIVERYCHALLAN_PAYMENT','tbl_deliverychallan_payment');
define('TBL_ITEM','tbl_item');
define('TBL_ITEM_CATEGORY','tbl_item_category');
define('TBL_LOGIN_ATTEMPTS','tbl_login_attempts');
define('TBL_ORDER','tbl_order');
define('TBL_ORDER_SUB','tbl_order_sub');
define('TBL_PACKING','tbl_packing');
define('TBL_PACKING_SUB','tbl_packing_sub');
define('TBL_PICKLIST','tbl_picklist');
define('TBL_PICKLIST_SUB','tbl_picklist_sub');
define('TBL_PURCHASE_ORDER','tbl_purchase_order');
define('TBL_PURCHASE_ORDER_SUB','tbl_purchase_order_sub');
define('TBL_USERINFO', 'tbl_userinfo');
define('TBL_USERROLE', 'tbl_user_roles');
define('TBL_STATE', 'tbl_state');
define('TBL_ITEM_UNIT','tbl_item_unit');
define('TBL_GENERAL_VOUCHER','tbl_general_voucher');
define('TBL_GENERAL_VOUCHER_SUB','tbl_general_voucher_sub');
define('TBL_ITEM_SUBCATEGORY','tbl_item_subcategory');
define('TBL_ITEM_PARAMETERS','tbl_item_parameters');
define('TBL_JOBWORKER_MASTER','tbl_jobworker_master');
define('TBL_JOBWCUSTOMER_PERSON','tbl_jobwcustomer_person');
define('TBL_QUOTATION','tbl_quotation');
define('TBL_QUOTATION_SUB','tbl_quotation_sub');
define('TBL_JOBWORK_OUTWORD','tbl_jobwork_outword');
define('TBL_JOBWORK_OUTWORD_SUB','tbl_jobwork_outword_sub');
define('TBL_JOBWORK_INWORD','tbl_jobwork_inword');
define('TBL_JOBWORK_INWORD_SUB','tbl_jobwork_inword_sub');
/*-----------------------Other Static Data-------------------*/
define('DAYS',array('0'=>'- Select -','Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday','Saturday'=>'Saturday','Sunday'=>'Sunday'));
define('PAYTYPE',array('Hourly'=>'Hourly','Daily'=>'Daily'));
define('GENERAL_MEASUREMENT',array('0'=>'PC','1'=>'100 PCS','2'=>'SET','3'=>'KG'));
define('RATE_MEASUREMENT',array('0'=>'QTY','1'=>'WEIGHT'));
define('STAFFPAYTYPE',array('0'=>'Upad','1'=>'Jama','2'=>'Salary'));
define('INCOTYPE',array(''=>'- Select -','FOB'=>'FOB', 'CIF'=>'CIF', 'C&F'=>'C&F', 'EX-WORKS'=>'EX-WORKS'));
