<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
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
		if (!check_role_assigned('user', 'view')) {
			redirect('forbidden');
		}
		// init params
		$params = array();
		$searchtxt = array();
		$params['user'] = $this->HRMS->getUser($searchtxt);
		
		$this->load->view('HRMS/User/index', $params);
	}

	public  function add($id = 0)
	{
		
		$query = "select * from " . TBL_USERROLE . " where isdelete=0 and id > 1";
		$data['userrole'] = $this->Queries->get_tab_list($query, 'id', 'user_role');
		$query = "select * from " . TBL_COMPANY_MANAGEMENT . " where isdelete=0";
		$data['companylist'] = $this->Queries->get_tab_list($query, 'id', 'company_name');
		
		try {
			$user = "";
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('user', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_USERINFO . " where isdelete=0 and id=" . $id;
				$user = $this->Queries->getSingleRecord($query);
			}
			if (!check_role_assigned('user', 'add')) {
				redirect('forbidden');
			}
			$query = "select * from " . TBL_DEPARTMENT . " where isdelete=0";
				$attendance_grouplist= $this->Queries->get_tab_list($query,'id','department_name');
			
			$this->load->view('HRMS/User/add', ['id' => $id, 'user' => $user, 'attendance_grouplist'=>$attendance_grouplist, 'userrole' => $data['userrole'],'companylist'=>$data['companylist']]);
		} catch (Exception $e) {
			echo $e;
		}
	}


	public function save()
	{
		//$this->form_validation->set_rules('user_name', 'User Name', 'required');
		$this->form_validation->set_rules('user_fname', 'First name', 'required');
		$this->form_validation->set_rules('user_lname', 'Last name', 'required');
		
		if ($this->form_validation->run()) {
			$data = $this->input->post();
			
			$user_mob = StringRepair($this->input->post('user_mob'));
			$user_fname = StringRepair($this->input->post('user_fname'));
			$user_lname = StringRepair($this->input->post('user_lname'));
			$user_fullname =$user_fname." ".$user_lname;
			$user_companyid=implode(',',$this->input->post('company_list'));
			$attendance_group = StringRepair($this->input->post('attendance_group'));
			$pay_type = StringRepair($this->input->post('pay_type'));
			$card_id = StringRepair($this->input->post('card_id'));
			$basic_pay = StringRepair($this->input->post('basic_pay'));
				$have_login = 1;
				$user_name = StringRepair($this->input->post('user_name'));
				$user_email = StringRepair($this->input->post('user_email'));
				$user_password = StringRepair($this->input->post('user_password'));
				$user_type = StringRepair($this->input->post('user_type'));
			$id = $this->input->post('id');
			$acti = $this->input->post('activate');
			if ($acti != "") {
				$act = 1;
			} else {
				$act = 0;
			}
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				if($have_login==1)
				{
					$query = "select * from " . TBL_USERINFO . " where user_name='" . $user_name . "' and isdelete=0 and id!=" . $id;
					$res = $this->Queries->getSingleRecord($query);
					if ($res > 0) {
						$this->session->set_flashdata('error_msg', 'User Name Already Exists...');
						return redirect('HRMS/User/add/' . $id);
					}
				}
				if ($user_password != "") {
					$salt       = $this->store_salt ? $this->salt() : FALSE;
					$user_password   = $this->Ion_auth_model->hash_password($user_password, $salt);

					$form_data = array(
						'user_password' => $user_password,
						'updated_by' => $this->session->userdata['logged_in']['userid'],
						'updated_on' => $today
					);
					$this->Queries->updateRecord(TBL_USERINFO, $form_data, $id);
				}
				$form_data = array(
					'user_name' => $user_name,
					'user_email' => $user_email,
					'user_fullname' => $user_fullname,
					'user_fname'=>$user_fname,
					'user_lname'=>$user_lname,
					'user_companyid'=>$user_companyid,
					'user_mob' => $user_mob,
					'user_type' => $user_type,
					'user_blocked' => 1,
					'card_id'=>$card_id,
					'basic_pay'=>$basic_pay,
					'attendance_group'=>$attendance_group,
					'pay_type'=>$pay_type,
					'have_login'=>$have_login,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_USERINFO, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'User Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update User');
				endif;
			} else {
				if($have_login==1)
				{
					$salt       = $this->store_salt ? $this->salt() : FALSE;
					$user_password   = $this->Ion_auth_model->hash_password($user_password, $salt);

					$query = "select * from " . TBL_USERINFO . " where user_name='" . $user_name . "' and isdelete=0";
					$res = $this->Queries->getSingleRecord($query);
					if ($res > 0) {
						$this->session->set_flashdata('error_msg', 'User Name Already Exists...');
						$this->session->set_flashdata($data);
						return redirect('HRMS/User/add');
					}
				}
				$form_data = array(
					'user_name' => $user_name,
					'user_email' => $user_email,
					'user_fullname' => $user_fullname,
					'user_fname'=>$user_fname,
					'user_lname'=>$user_lname,
					'user_companyid'=>$user_companyid,
					'user_mob' => $user_mob,
					'user_type' => $user_type,
					'user_password' => $user_password,
					'user_blocked' => $act,
					'card_id'=>$card_id,
					'basic_pay'=>$basic_pay,
					'attendance_group'=>$attendance_group,
					'pay_type'=>$pay_type,
					'have_login'=>$have_login,
					'user_image' => "assets/default.png",
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_USERINFO, $form_data)) :
					$this->session->set_flashdata('success_msg', 'User Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add User');
				endif;
			}
		}

		return redirect('HRMS/User/index/');
	}
	public function delete($id)
	{
		if (!check_role_assigned('user', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_USERINFO, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'User Deleted Successfully');
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete User');
		endif;

		return redirect('HRMS/User');
	}
}
