<?php
class CompanyManagement extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//load setting model for get Data
		$this->load->model('setting_model');
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	}

	/************************************** Display all company Management *************************************/
	public function index()
	{
		if (!check_role_assigned('company_master', 'view')) {
			redirect('forbidden');
		}
		//init params
		$params = array();
		$searchtxt = array();
		$params['CompanyManagement'] = $this->setting_model->getCompanyManagement($searchtxt);
	
    
		$this->load->view('Settings/CompanyManagement/index', $params);
	}

	/*********************************** Add/Edit Company MAnagement View ****************************************/
	public  function add($id = 0)
	{
		try {
            $params["id"]=$id;
			if ($id != "" and $id != 0) {
				// For Editing Functionality
				if (!check_role_assigned('company_master', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_COMPANY_MANAGEMENT . " where isdelete=0 and id=" . $id;
				$params["CompanyManagement"] = $this->Queries->getSingleRecord($query);
			
			}
			if (!check_role_assigned('company_master', 'add')) {
				redirect('forbidden');
			}

			$query="select * from ".TBL_COUNTRY_MASTER." where isdelete=0";
			$params['countrylist']=$this->Queries->get_tab_list($query,'id','country_name');
			$query="select * from ".TBL_STATE." where isdelete=0";
			$params['statelist']=$this->Queries->get_tab_list($query,'state_code','state');
			$this->load->view('Settings/CompanyManagement/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}

	/************************************* Add/Edit contact Person View ******************************************/
	public  function addPerson($companyid=0,$id = 0)
	{
				
		try {
			$params["companyid"]=$companyid;
            $params["id"]=$id;
			if($companyid==0 || $companyid=="")
			{
				redirect('Settings/CompanyManagement');
			}
			if ($id != "" and $id != 0) {
				//for Editing Functionality
				if (!check_role_assigned('company_master', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_COMPANY_PERSON . " where isdelete=0  and company_id=".$companyid." and id=" . $id;
				$params["companyperson"] = $this->Queries->getSingleRecord($query);
			
			}
			if (!check_role_assigned('company_master', 'add')) {
				redirect('forbidden');
			}

				$query="select * from ".TBL_COMPANY_PERSON." where isdelete=0 and company_id=".$companyid." order by id desc";
			$params['personlist']=$this->Queries->getRecord($query);
			$params['status'] = array('Primary', 'Secondary', 'Other');
			$this->load->view('Settings/CompanyManagement/addPerson', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}

	/*********************************** Save Company Management Details ************************************/
	public function save()
	{
			
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		if ($this->form_validation->run()) {
			
			$company_code = StringRepair($this->input->post('company_code'));
			$company_name =StringRepair($this->input->post('company_name'));
			$countryid = StringRepair($this->input->post('countryid'));
			$city = StringRepair($this->input->post('city'));
			$pincode = StringRepair($this->input->post('pincode'));
			$state=StringRepair($this->input->post('state'));
			$gstno= StringRepair($this->input->post('gstno'));
			$panno = StringRepair($this->input->post('panno'));
			$address = StringRepair($this->input->post('address'));
			$tdsno= StringRepair($this->input->post('tdsno'));
			
			$id = $this->input->post('id');
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				//For Editing Functtionality
				
				$res=$this->Queries->getSingleRecord('select * from '.TBL_COMPANY_MANAGEMENT.' where isdelete=0 and company_name="'.$company_name.'" and id!='.$id);
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Company Already Exists');
					redirect('Settings/CompanyManagement/add/'.$id);
				}

				$form_data = array(
					'company_code' => $company_code,
					'company_name'=>$company_name,
					'gst_no'=>$gstno,
					'pan_no'=>$panno,
					'tds_no'=>$tdsno,
					'address'=>$address,
					'country'=>$countryid,
					'state'=>$state,
					'city' =>$city,
					'pincode'=>$pincode,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_COMPANY_MANAGEMENT, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Company Details Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Company');
				endif;
				$pid=$id;

			} else {
				//For Adding Functionality
				$res=$this->Queries->getSingleRecord('select * from '.TBL_COMPANY_MANAGEMENT.' where isdelete=0 and company_name="'.$company_name.'"');
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Company Already Exists');
					redirect('Settings/CompanyManagement/add');
				}
				$form_data = array(
					'company_code' => $company_code,
					'company_name'=>$company_name,
					'gst_no'=>$gstno,
					'pan_no'=>$panno,
					'tds_no'=>$tdsno,
					'address'=>$address,
					'country'=>$countryid,
					'state'=>$state,
					'city' =>$city,
					'pincode'=>$pincode,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_COMPANY_MANAGEMENT, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Company Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Company');
				endif;
				$pid=$this->db->insert_id();
			}
		}
		return redirect('Settings/CompanyManagement/add/'.$pid);
	}

	/*********************************** Save Contact Person Details **************************************/
	public function savePerson()
	{
			
		$this->form_validation->set_rules('name', 'Person Name', 'required');
		if ($this->form_validation->run()) {
			
			$emails = StringRepair($this->input->post('email'));
			$email	=strtolower($emails);
			$name =StringRepair($this->input->post('name'));
			$designation = StringRepair($this->input->post('designation'));
			$number = StringRepair($this->input->post('number'));
			$status = StringRepair($this->input->post('status'));
			$about=0;
			$id = $this->input->post('id');
			$companyid = $this->input->post('companyid');
			
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				//For Editing Functionality
				// $res=$this->Queries->getSingleRecord('select * from '.TBL_COMPANY_PERSON.' where isdelete=0 and email="'.$email.'" and id!='.$id);
				// if($res!=null)
				// {
				// 	$this->session->set_flashdata('error_msg', 'Contact Person for Company Already Exists');
				// 	redirect('Settings/CompanyManagement/addPerson/'.$companyid."/".$id);
				// }
				$about_data=array(
					'Status'=>1
				);
				$check_data=array(
					'id !='=>$id,
					'company_id'=>$companyid,
					'status'=>$about
				);

				$form_data = array(
					'company_id'=>$companyid,
					'name'=>$name,
					'email' =>$email,
					'designation'=>$designation,
					'contact_no'=>$number,
					'status'=>$status,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				
				if ($this->Queries->updateRecord(TBL_COMPANY_PERSON, $form_data, $id))
				{	if($status==0)
					{
					$this->Queries->updatePerson(TBL_COMPANY_PERSON, $about_data, $check_data);
					}
					$this->session->set_flashdata('success_msg', 'Contact Person for Company Updated Successfully');
				}
				else 
				{
					$this->session->set_flashdata('error_msg', 'Failed To Update Contact Person for Company');
				}
				$pid=$id;
			} else {
				//For Adding Functionality
				// $res=$this->Queries->getSingleRecord('select * from '.TBL_COMPANY_PERSON.' where isdelete=0 and email="'.$email.'"');
				// if($res!=null)
				// {
				// 	$this->session->set_flashdata('error_msg', 'Company Person Already Exists');
				// 	redirect('Settings/CompanyManagement/addPerson/'.$companyid);
				// }
				$about_data=array(
					'Status'=>1
				);
				$check_data=array(
					'company_id'=>$companyid,
					'status'=>$about
				);
				
				$form_data = array(
					'company_id'=>$companyid,
					'name'=>$name,
					'email' =>$email,
					'designation'=>$designation,
					'contact_no'=>$number,
					'status'=>$status,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if($status==0)
					{
					$this->Queries->updatePerson(TBL_COMPANY_PERSON, $about_data, $check_data);
					}
				if ($this->Queries->addRecord(TBL_COMPANY_PERSON, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Contact Person for Company Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Contact Person for Company');
				endif;
			}
			return redirect('Settings/CompanyManagement/addPerson/'.$companyid);		
		}

		
	}

	/******************************************Delete Company Management ************************************/
	public function delete($id)
	{
		if (!check_role_assigned('company_master', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_COMPANY_MANAGEMENT, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Company  Deleted Successfully');
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Company');
		endif;
		return redirect('Settings/CompanyManagement/');
	}

	/*************************************** Delete Contact Person *****************************************/
	public function deletePerson($companyid,$id)
	{
		if (!check_role_assigned('company_master', 'delete')) {
			redirect('forbidden');
		}
	$today = date('Y-m-d H:i:s');
	$form_data = array(
		'isdelete' => 1,
		'updated_by' => $this->session->userdata['logged_in']['userid'],
		'updated_on' => $today
	);
	if ($this->Queries->updateRecord(TBL_COMPANY_PERSON, $form_data, $id)) :
		$this->session->set_flashdata('success_msg', 'Contact Person for Company Deleted Successfully');
	else :
		$this->session->set_flashdata('error_msg', 'Failed To Delete Contact Person for Company');
	endif;
	return redirect('Settings/CompanyManagement/addPerson/'.$companyid);
	}


}

