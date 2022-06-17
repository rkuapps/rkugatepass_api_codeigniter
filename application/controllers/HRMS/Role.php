<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
			$this->load->model('Hrms_model','HRMS');
	}

	public function index()
	{
		 if (!check_role_assigned('role', 'view')) {
		 	redirect('forbidden');
		 }

		// init params
		$params = array();
	$params['role'] = $this->HRMS->getRole();

	$this->load->view('HRMS/Role/index', $params); 
	}

	public  function add($id = 0)
	{
		$query = "select * from " . TBL_USERINFO . " where isdelete=0 and id=" . $this->session->userdata['logged_in']['userid'];
		$data['userdata'] = $this->Queries->getSingleRecord($query);
		
		$sidebar_menu = array(
			array("name" => "<span class='fa fa-home'></span> Dashboard", "role" => "dashboard", "role_type" => "view"),
			array("name" => "<span class='fa fa-file'></span> Quotation", "role" => "quotation", "role_type" => "view,add,edit,delete"),
			array("name" => "<span class='fa fa-motorcycle'></span> Sales Order", "role" => "order", "role_type" => "view,add,edit,delete"),
			array("name" => "<span class='fa fa-shopping-cart'></span> Purchase Order", "role" => "purchase_order", "role_type" => "view,add,edit,delete"),
			array("name" => "<span class='fa fa-motorcycle'></span> Jobwork Challan", "role" => "jobwork_challan", "role_type" => "view,add,edit,delete"),
			array("name" => "<span class='fa fa-file'></span> Invoice", "role" => "invoice", "role_type" => "view,add,edit,delete"),
			array("name" => "<span class='fa fa-list-alt'></span> Item", "role" => "item", "role_type" => "view,add,edit,delete"),
			array("name" => "<span class='fa fa-industry'></span> Company", "role" => "company_master", "role_type" => "view,add,edit,delete"),
			array("name" => "<span class='fa fa-gear'></span> Settings", "role" => "settings", "role_type" => "view"),
			array("name" => "&rarr;<span class='fa fa-gear'></span> Financial Year", "role" => "financial_year", "role_type" => "view,add,edit,delete"),
			array("name" => "&rarr;<span class='fa fa-gear'></span> Backup", "role" => "backup", "role_type" => "view,add"),
			array("name" => "&rarr;<span class='fa fa-th-large '></span> Item Category", "role" => "item_category", "role_type" => "view,add,edit,delete"),
			array("name" => "&rarr;<span class='fa fa-th-large '></span> Item Sub Category", "role" => "item_sub_category", "role_type" => "view,add,edit,delete"),
			array("name" => "&rarr;<span class='fa fa-th-large '></span> Item Parameters", "role" => "item_parameters", "role_type" => "view,add,edit,delete"),
			array("name" => "&rarr;<span class='fa fa-user'></span> Customer", "role" => "customer", "role_type" => "view,add,edit,delete"),
			array("name" => "&rarr;<span class='fa fa-user'></span> Supplier", "role" => "supplier", "role_type" => "view,add,edit,delete"),
			array("name" => "&rarr;<span class='fa fa-user'></span> Job Worker", "role" => "jobworker", "role_type" => "view,add,edit,delete"),
			// array("name" => "&rarr;<span class='fa fa-anchor'></span> Port Master", "role" => "port_master", "role_type" => "view,add,edit,delete"),
			// array("name" => "&rarr;<span class='fa fa-truck'></span> Transporter Master", "role" => "transporter_master", "role_type" => "view,add,edit,delete"),
			// array("name" => "&rarr;<span class='fa fa-gear'></span> Bank Master", "role" => "bank_master", "role_type" => "view,add,edit,delete"),
			array("name" => "<span class='fa fa-file'></span> Delivery Challan", "role" => "deliverychallan", "role_type" => "view,add,edit,delete"),
			array("name" => "<span class='fa fa-file'></span> Report", "role" => "report", "role_type" => "view"),
			array("name" => "&rarr;<span class='fa fa-file'></span> JobWork Report", "role" => "jobwork_report", "role_type" => "view"),
			array("name" => "<span class='glyphicon glyphicon-fire'></span> HRMS", "role" => "hrms", "role_type" => "view"),
			array("name" => "&rarr;<span class='fa fa-users'></span> Users", "role" => "user", "role_type" => "view,add,edit,delete"),
			array("name" => "&rarr;<span class='glyphicon glyphicon-modal-window'></span> Role", "role" => "role", "role_type" => "view,add,edit,delete"),
			
			// array("name" => "&rarr;<span class='glyphicon glyphicon-equalizer'></span> Departments", "role" => "department_master", "role_type" => "view,add,edit,delete"),
			// array("name" => "&rarr;<span class='glyphicon glyphicon-equalizer'></span> Attendance", "role" => "attendance_master", "role_type" => "view,add,edit,delete"),
			// array("name" => "&rarr;<span class='glyphicon glyphicon-equalizer'></span> Staff Upaad / Jama", "role" => "staff_account", "role_type" => "view,add,edit,delete"),
			// array("name" => "&rarr;<span class='glyphicon glyphicon-equalizer'></span> Staff Salary Report", "role" => "staff_salary_report", "role_type" => "view,add,edit,delete"),
			
			

			
			
		);

		define("MENU_LIST_JSON", json_encode($sidebar_menu));

		try {
			$role = "";
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('role', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_USERROLE . " where isdelete=0 and id=" . $id;
				$role = $this->Queries->getSingleRecord($query);
			}
			if (!check_role_assigned('role', 'add')) {
				redirect('forbidden');
			}
			$this->load->view('HRMS/Role/add', ['id' => $id, 'role' => $role, 'userdata' => $data['userdata']]);
		} catch (Exception $e) {
			echo $e;
		}
	}


	public function save()
	{
			
		$this->form_validation->set_rules('rolename', 'Role Name', 'required');

		if ($this->form_validation->run()) {
			$data = $this->input->post();
			$role_name = StringRepair($this->input->post('rolename'));
			$role_details = $this->input->post('role');
			$id = $this->input->post('id');

			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {

				$query = "select * from " . TBL_USERROLE . " where user_role='" . $role_name . "' and isdelete=0 and id!=" . $id;
				$res = $this->Queries->getSingleRecord($query);
				if ($res > 0) {
					$this->session->set_flashdata('error_msg', 'Role Name Already Exists...');
					return redirect('HRMS/Role/add/' . $id);
				}
				$form_data = array(
					'user_role' => $role_name,
					'role_details' => json_encode($role_details)
				);
				if ($this->Queries->updateRecord(TBL_USERROLE, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Role Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Role');
				endif;
			} else {

				$query = "select * from " . TBL_USERROLE . " where user_role='" . $role_name . "' and isdelete=0 ";
				$res = $this->Queries->getSingleRecord($query);
				if ($res > 0) {
					$this->session->set_flashdata('error_msg', 'Role Name Already Exists...');
					return redirect('HRMS/Role/add/');
				}
				$form_data = array(
					'user_role' => $role_name,
					'role_details' => json_encode($role_details)
				);
				if ($this->Queries->addRecord(TBL_USERROLE, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Role Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Role');
				endif;
			}
		}
		return redirect('HRMS/Role/');
	}
	public function delete($id)
	{
		if (!check_role_assigned('role', 'delete')) {
			redirect('forbidden');
		}
		$form_data = array(
			'isdelete' => 1
		);
		if ($this->Queries->updateRecord(TBL_USERROLE, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Role Deleted Successfully');
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Role');
		endif;

		return redirect('HRMS/Role');
	}

}
