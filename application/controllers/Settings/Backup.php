<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	}

	public function index()
	{
		if (!check_role_assigned('backup', 'view')) {
			redirect('forbidden');
		}
		// init params
		$params = array();
		$searchtxt = array();
		$params['Backup'] = $this->Queries->getBackup($searchtxt);
		
		$this->load->view('Settings/Backup/index', $params);
	}



	public function save()
	{
        if (!check_role_assigned('backup', 'add')) {
			redirect('forbidden');
		}
		$this->load->dbutil();
        $today = date('d-m-y-h-i-s');
        $prefs = array(
            'tables'        => array(
                'tbl_backup',
                'tbl_company_management',
                'tbl_company_person',
                'tbl_country_master',
                'tbl_customer_person',
                'tbl_customer_item_sub',
                'tbl_customer_item',
                'tbl_customer_management',
                'tbl_department',
                'tbl_financial_year',
                'tbl_inventory',
                'tbl_invoice',
                'tbl_invoice_sub',
                'tbl_item_category',
                'tbl_item_subcategory',
                'tbl_item_parameters',
                'tbl_jobwcustomer_person',
                'tbl_jobworker_master',
                'tbl_jobwork_inword',
                'tbl_jobwork_inword_sub',
                'tbl_jobwork_outword',
                'tbl_jobwork_outword_sub',
                'tbl_login_attempts',
                'tbl_order',
                'tbl_order_sub',    
                'tbl_quotation',
                'tbl_quotation_sub',            
                'tbl_userinfo',
                'tbl_user_roles'
            ),   // Array of tables to backup.
            'ignore'        => array(),                     // List of tables to omit from the backup
            'format'        => 'zip',                       // gzip, zip, txt
            'filename'      => 'SUPREME.sql',              // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
            'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
            'newline'       => "\n"                         // Newline character used in backup file
        );
        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup($prefs);

        // Load the file helper and write the file to your server
        $this->load->helper('file');
        $filename = 'backup/SUPREME-' . $today . '.zip';
        write_file($filename, $backup);
        $form_data = array(
            'file_name'=>$filename,
            'created_by' => $this->session->userdata['logged_in']['userid'],
            
        );

        if ($this->Queries->addRecord(TBL_BACKUP, $form_data)) :
        	$this->session->set_flashdata('success_msg', 'Backup Created  Successfully');
        else :
         	$this->session->set_flashdata('error_msg', 'Failed To Create Backup');
        endif;
        redirect('Settings/Backup/');
	}
	

}
