<?php
class SupplierManagement extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(setting_model);
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	}

	/*******************************Display All Customer Details *****************************/ 
	public function index()
	{
		if (!check_role_assigned('supplier', 'view')) {
			redirect('forbidden');
		}
		//init params
		$params = array();
		$searchtxt = array();
		$companyid=$this->session->userdata['financial_year']['companyid'];
		$params['CustomerManagement'] = $this->setting_model->getSupplierManagement($companyid,$searchtxt);
		// echo $this->db->last_query();
		// print_r($params['CustomerManagement']);exit;
		$query = "select * from " . TBL_COMPANY_PERSON . " where isdelete=0 and status=0";
		$params["CompanyPerson"] = $this->Queries->getSingleRecord($query);
		$this->load->view('Settings/SupplierManagement/index', $params);
	}

	/*********************************Display Form for Add/Edit Customer Details**************************/
	public  function add($id = 0)
	{
		try {
            $params["id"]=$id;
			if ($id != "" and $id != 0) {
				// For Edit Customer info
				if (!check_role_assigned('supplier', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_CUSTOMER_MANAGEMENT . " where isdelete=0 and id=" . $id;
				$params["CustomerManagement"] = $this->Queries->getSingleRecord($query);
			
			}
			if (!check_role_assigned('supplier', 'add')) {
				redirect('forbidden');
			}

			$query="select * from ".TBL_COMPANY_MANAGEMENT." where isdelete=0";
			$params['companylist']=$this->Queries->get_tab_list($query,'id','company_name');
			$params['about']=array('Customer', 'Supplier', 'Both');
			$query="select * from ".TBL_COUNTRY_MASTER." where isdelete=0";
			$params['countrylist']=$this->Queries->get_tab_list($query,'id','country_name');
			$query="select * from ".TBL_STATE." where isdelete=0";
			$params['statelist']=$this->Queries->get_tab_list($query,'state_code','state');
			$this->load->view('Settings/SupplierManagement/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}

	/*************************Display Contact Person Add/Edit For Customer Management******************/
	public  function addPerson($customerid=0,$id = 0)
	{
				
		try {
			$params["customerid"]=$customerid;
            $params["id"]=$id;
			if($customerid==0 || $customerid=="")
			{
				redirect('Settings/CustomerManagement');
			}
			if ($id != "" and $id != 0) {
				//For Editing Functionality
				if (!check_role_assigned('supplier', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_CUSTOMER_PERSON . " where isdelete=0  and customer_id=".$customerid." and id=" . $id;
				$params["customerperson"] = $this->Queries->getSingleRecord($query);
			
			}
			if (!check_role_assigned('supplier', 'add')) {
				redirect('forbidden');
			}

			$query="select * from ".TBL_CUSTOMER_PERSON." where isdelete=0 and customer_id=".$customerid." order by id desc";
			$params['personlist']=$this->Queries->getRecord($query);
			$params['status'] = array('Primary', 'Secondary', 'Other');
			$this->load->view('Settings/SupplierManagement/addPerson', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}

	


	/****************************** Save Customer Manageemnt Details*****************************/ 
	public function save()
	{
			
		$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
		if ($this->form_validation->run()) {
			
			$customer_name = StringRepair($this->input->post('customer_name'));
			$companyid = StringRepair($this->session->userdata['financial_year']['companyid']);
			$tdsno= StringRepair($this->input->post('tdsno'));
			$about= StringRepair($this->input->post('about'));
			$panno = StringRepair($this->input->post('panno'));
			$countryid = StringRepair($this->input->post('countryid'));
			$city = StringRepair($this->input->post('city'));
			$pincode = StringRepair($this->input->post('pincode'));
			$state=StringRepair($this->input->post('state'));
			$gstno= StringRepair($this->input->post('gstno'));
			$statecode=substr($gstno,0,2);
			if($statecode=='24')
			{
				$cgst= StringRepair($this->input->post('cgst'));
				$sgst= StringRepair($this->input->post('sgst'));
				$igst= 0;	
			}
			elseif($gstno != '')
			{
				$cgst= 0;
				$sgst= 0;
				$igst= StringRepair($this->input->post('igst'));
			}
			else
			{
				$cgst= StringRepair($this->input->post('cgst'));
				$sgst= StringRepair($this->input->post('sgst'));
				$igst= StringRepair($this->input->post('igst'));
			}
			
			$address = StringRepair($this->input->post('address'));
			$id = $this->input->post('id');
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {

				//for Update Records
				$res=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER_MANAGEMENT.' where isdelete=0 and Customer_Name="'.$customer_name.'" and id!='.$id);
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Customer Already Exists');
					redirect('Settings/CustomerManagement/add/'.$id);
				}
				

				$form_data = array(
					'customer_name' => $customer_name,
					'company_id'=>$companyid,
					'tds_no'=>$tdsno,
					'party_type'=>'2',
					'pan_no'=>$panno,
					'address'=>$address,
					'country'=>$countryid,
					'state'=>$state,
					'city' =>$city,
					'pincode'=>$pincode,
					'gst_no'=>$gstno,
					'cgst'=>$cgst,
					'sgst'=>$sgst,
					'igst'=>$igst,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_CUSTOMER_MANAGEMENT, $form_data, $id)) 
				{
					
					$this->session->set_flashdata('success_msg', 'Customer Details Updated Successfully');
				}
				else 
				{
					$this->session->set_flashdata('error_msg', 'Failed To Update Customer Details');
				}
				$pid=$id;

			} else {
				// for Add Records
				$res=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER_MANAGEMENT.' where isdelete=0 and Customer_Name="'.$customer_name.'"');
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Customer Already Exists');
					redirect('Settings/CustomerManagement/add');
				}
				$form_data = array(
					'customer_name' => $customer_name,
					'company_id'=>$companyid,
					'tds_no'=>$tdsno,
					'party_type'=>'2',
					'pan_no'=>$panno,
					'address'=>$address,
					'country'=>$countryid,
					'state'=>$state,
					'city' =>$city,
					'pincode'=>$pincode,
					'gst_no'=>$gstno,
					'cgst'=>$cgst,
					'sgst'=>$sgst,
					'igst'=>$igst,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_CUSTOMER_MANAGEMENT, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Customer Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Customer');
				endif;
				$pid=$this->db->insert_id();
				
				
			}
			
		}

		return redirect('Settings/SupplierManagement/addPerson/'.$pid);
	}

	/*****************************  save Contact Person Details **************************************/ 
	public function savePerson()
	{
			
		$this->form_validation->set_rules('name', 'Person Name', 'required');
		if ($this->form_validation->run()) {
			
			$emails = StringRepair($this->input->post('email'));
			$email =strtolower($emails);
			$name = StringRepair($this->input->post('name'));
			$designation = StringRepair($this->input->post('designation'));
			$number = StringRepair($this->input->post('phonenumber'));
			$status = StringRepair($this->input->post('status'));
			$check=0;
			$id = $this->input->post('id');
			$customerid = $this->input->post('customerid');
		
			
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				// for Edit functionality				
				// $res=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER_PERSON.' where isdelete=0 and email="'.$email.'" and id!='.$id);
				// if($res!=null)
				// {
				// 	$this->session->set_flashdata('error_msg', 'Contact Person Already Exists');
				// 	redirect('Settings/CustomerManagement/addPerson/'.$customerid."/".$id);
				// }
				$about_data=array(
					'status'=>1
				);
				$check_data=array(
					'id !='=>$id,
					'customer_id'=>$customerid,
					'status'=>$check
				);
				
				$form_data = array(
					'customer_id'=>$customerid,
					'name'=>$name,
					'email' =>$email,
					'designation'=>$designation,
					'contact_no'=>$number,
					'status'=>$status,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
			
				if ($this->Queries->updateRecord(TBL_CUSTOMER_PERSON, $form_data, $id)) 
				{
					if($status==0)
					{
						$this->Queries->updatePerson(TBL_CUSTOMER_PERSON, $about_data, $check_data);
					}
					$this->session->set_flashdata('success_msg', 'Contact Person Updated Successfully');
				}
				else 
				{
					$this->session->set_flashdata('error_msg', 'Failed To Update Contact Person');
				}
				$pid=$id;

			} else {
				//for Add Functionality
				 
				// $res=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER_PERSON.' where isdelete=0 and email="'.$email.'"');
				// if($res!=null)
				// {
				// 	$this->session->set_flashdata('error_msg', 'Contact Person Already Exists');
				// 	redirect('Settings/CustomerManagement/addPerson/'.$customerid);
				// }
				
				$form_data = array(
					'customer_id'=>$customerid,
					'name'=>$name,
					'email' =>$email,
					'designation'=>$designation,
					'contact_no'=>$number,
					'status'=>$status,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				$about_data=array(
					'status'=>1
				);
				$check_add_data=array(
					
					'customer_id'=>$customerid,
					'status'=>$check
				);
				
				if($status==0)
				{
					$this->Queries->updatePerson(TBL_CUSTOMER_PERSON, $about_data, $check_add_data);
				}
				if ($this->Queries->addRecord(TBL_CUSTOMER_PERSON, $form_data)) 
				{	
					
					$this->session->set_flashdata('success_msg', 'Contact Person Added Successfully');
				}
				else
				{ 
					$this->session->set_flashdata('error_msg', 'Failed To Add Contact Person');
				}
				
				
				
			
			}
			return redirect('Settings/SupplierManagement/addPerson/'.$customerid);		
		}

		
	}

	/******************************** Save Item Details ***********************************/
	public function saveItem()
	{
		$fin_id=$this->session->userdata['financial_year']['id'];
		$this->form_validation->set_rules('item_name', 'Item Name', 'required');
		if ($this->form_validation->run()) {
			$result=$this->Queries->getSingleRecord('select id FROM '.TBL_ITEM.' ORDER BY id DESC LIMIT 1');
			$result=$result->id+1;
			$item_code = StringRepair($this->input->post('item_code'));
			$item_name = StringRepair($this->input->post('item_name'));
			$categoryid = StringRepair($this->input->post('categoryid'));
			$open_stock = StringRepair($this->input->post('open_stock'));
			$description = StringRepair($this->input->post('description'));
			$id = $this->input->post('id');
			$customerid = $this->input->post('customerid');
			
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				//for Edit Functionality
				$res=$this->Queries->getSingleRecord('select * from '.TBL_ITEM.' where isdelete=0 and item_number="'.$item_code.'" and id!='.$id);
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Item Already Exists');
					redirect('Settings/CustomerManagement/addItem/'.$customerid."/".$id);
				}
				/*************(stype{0=>opening stock,1=>purchase,2=>packing}) */
				$item_data = array(
					'finid'=>$fin_id,
					'item_id'=>$id,
					'stype'=>0,
					'qty'=>$open_stock,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
								
				$form_data = array(
					'customer_id'=>$customerid,
					'item_number'=>$item_code,
					'item_name' =>$item_name,
					'category_id'=>$categoryid,
					'opening_stock'=>$open_stock,
					'description'=>$description,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				
				if ($this->Queries->updateRecord(TBL_ITEM, $form_data, $id)) 
				{
					$this->Queries->updateStock(TBL_INVENTORY, $item_data, $id);
					$this->session->set_flashdata('success_msg', 'Item Updated Successfully');
				}
				else 
				{
					$this->session->set_flashdata('error_msg', 'Failed To Update Item');
				}
				$pid=$id;

			} else {
				//for Add Functionality
				$res=$this->Queries->getSingleRecord('select * from '.TBL_ITEM.' where isdelete=0 and item_number="'.$item_code.'"');
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Item Already Exists');
					redirect('Settings/CustomerManagement/addItem/'.$customerid);
				}
				$item_data = array(
					'finid'=>$fin_id,
					'item_id'=>$result,
					'subid'=>$result,
					'stype'=>0,
					'qty'=>$open_stock,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				$form_data = array(
					'customer_id'=>$customerid,
					'item_number'=>$item_code,
					'item_name' =>$item_name,
					'category_id'=>$categoryid,
					'opening_stock'=>$open_stock,
					'description'=>$description,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				
				if ($this->Queries->addRecord(TBL_ITEM, $form_data)) 
				{	
					$this->Queries->addRecord(TBL_INVENTORY,$item_data);
					$this->session->set_flashdata('success_msg', 'Item Added Successfully');
				}
				else
				{ 
					$this->session->set_flashdata('error_msg', 'Failed To Add Item');
				}
				
				
				
			
			}
			return redirect('Settings/SupplierManagement/addItem/'.$customerid);		
		}

		
	}


	/********************************** Delete Customer Management  ************************************/
	public function delete($id)
	{
		if (!check_role_assigned('supplier', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_CUSTOMER_MANAGEMENT, $form_data, $id)) :
			
			$this->session->set_flashdata('success_msg', 'Customer  Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Customer');
		endif;

		return redirect('Settings/SupplierManagement/');
	}

	/****************************************** Delete Contact Person *********************************************/
	public function deletePerson($customerid,$id)
	{
		if (!check_role_assigned('supplier', 'delete')) {
			redirect('forbidden');
		}
	$today = date('Y-m-d H:i:s');
	$form_data = array(
		'isdelete' => 1,
		'updated_by' => $this->session->userdata['logged_in']['userid'],
		'updated_on' => $today
	);
	if ($this->Queries->updateRecord(TBL_CUSTOMER_PERSON, $form_data, $id)) :
		$this->session->set_flashdata('success_msg', 'Contact Person  Deleted Successfully');

	else :
		$this->session->set_flashdata('error_msg', 'Failed To Delete Contact Person');
	endif;

	return redirect('Settings/SupplierManagement/addPerson/'.$customerid);
	}

	/********************************************** Delete Item ***************************************************/
	public function deleteItem($customerid,$id)
	{
		if (!check_role_assigned('item', 'delete')) {
			redirect('forbidden');
		}
	$today = date('Y-m-d H:i:s');
	$form_data = array(
		'isdelete' => 1,
		'updated_by' => $this->session->userdata['logged_in']['userid'],
		'updated_on' => $today
	);
	if ($this->Queries->updateRecord(TBL_ITEM, $form_data, $id)) :
		$this->Queries->updateStock(TBL_INVENTORY, $form_data, $id);
		$this->session->set_flashdata('success_msg', 'Item Deleted Successfully');

	else :
		$this->session->set_flashdata('error_msg', 'Failed To Delete Item');
	endif;

	return redirect('Settings/SupplierManagement/addItem/'.$customerid);
	}



}

