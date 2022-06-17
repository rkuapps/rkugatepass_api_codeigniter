<?php
class JobWorkerMaster extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(setting_model);
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	}
	/*******************************Display All JobWorker Details *****************************/ 
	public function index()
	{
		if (!check_role_assigned('jobworker', 'view')) {
			redirect('forbidden');
		}
		$params = array();
		$searchtxt = array();
		$companyid=$this->session->userdata['financial_year']['companyid'];
		$params['JobWorkerMaster'] = $this->setting_model->getJobWorkerMaster($companyid,$searchtxt);
        // echo $this->db->last_query();
        // print_r($params['JobWorkerMaster']);exit;
		$query = "select * from " . TBL_COMPANY_PERSON . " where isdelete=0 and status=0 ";
		$params["CompanyPerson"] = $this->Queries->getSingleRecord($query);
		$this->load->view('Settings/JobWorkerMaster/index', $params);
	}
	/*********************************Display Form for Add/Edit JobWorker Details**************************/
	public  function add($id = 0)
	{
		try {
        $params["id"]=$id;
        if ($id != "" and $id != 0) {
            if (!check_role_assigned('jobworker', 'edit')) {
                redirect('forbidden');
            }
            $query = "select * from " . TBL_JOBWORKER_MASTER . " where isdelete=0 and id=" . $id;
            $params["JobWorkerMaster"] = $this->Queries->getSingleRecord($query);
        }
        if (!check_role_assigned('jobworker', 'add')) {
            redirect('forbidden');
        }
            $query="select * from ".TBL_JOBWORKER_MASTER." where isdelete=0";
            $params['companylist']=$this->Queries->get_tab_list($query,'id','company_name');
            $params['about']=array('Customer', 'Supplier', 'Both');
            $query="select * from ".TBL_COUNTRY_MASTER." where isdelete=0";
            $params['countrylist']=$this->Queries->get_tab_list($query,'id','country_name');
            $query="select * from ".TBL_STATE." where isdelete=0";
            $params['statelist']=$this->Queries->get_tab_list($query,'state_code','state');
            $this->load->view('Settings/JobWorkerMaster/add', $params);
        }
        catch (Exception $e) {
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
				redirect('Settings/JobWorkerMaster');
			}
			if ($id != "" and $id != 0) {
                if (!check_role_assigned('jobworker', 'edit')) {
                    redirect('forbidden');
                }
            $query = "select * from " . TBL_JOBWCUSTOMER_PERSON . " where isdelete=0  and customer_id=".$customerid." and id=" . $id;
            $params["customerperson"] = $this->Queries->getSingleRecord($query);
        }
			if (!check_role_assigned('company_master', 'add')) {
				redirect('forbidden');
			}
			$query="select * from ".TBL_JOBWCUSTOMER_PERSON." where isdelete=0 and customer_id=".$customerid." order by id desc";
			$params['personlist']=$this->Queries->getRecord($query);
			$params['status'] = array('Primary', 'Secondary', 'Other');
			$this->load->view('Settings/JobWorkerMaster/addPerson', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}
	/****************************** Save Customer Manageemnt Details*****************************/ 
	public function save()
	{
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
		if ($this->form_validation->run()) {
            
          
            $company_name =StringRepair($this->input->post('company_name'));
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
				$res=$this->Queries->getSingleRecord('select * from '.TBL_JOBWORKER_MASTER.' where isdelete=0 and company_name="'.$company_name.'" and id!='.$id);
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Customer Already Exists');
					redirect('Settings/JobWorkerMaster/add/'.$id);
				}
				$form_data = array(
                'company_name' => $company_name,
                'company_id'=>$companyid,
                'tds_no'=>$tdsno,
                'party_type'=>$about,
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
				if ($this->Queries->updateRecord(TBL_JOBWORKER_MASTER, $form_data, $id)) 
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
            
				$res=$this->Queries->getSingleRecord('select * from '.TBL_JOBWORKER_MASTER.' where isdelete=0 and company_name="'.$company_name.'"');
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Customer Already Exists');
					redirect('Settings/JobWorkerMaster/add');
				}
				$form_data = array(
					'company_name' => $company_name,
					'company_id'=>$companyid,
					'tds_no'=>$tdsno,
					'party_type'=>$about,
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

				if ($this->Queries->addRecord(TBL_JOBWORKER_MASTER, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Customer Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Customer');
				endif;
				$pid=$this->db->insert_id();
			}
		}
		return redirect('Settings/JobWorkerMaster/addPerson/'.$pid);
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
				if ($this->Queries->updateRecord(TBL_JOBWCUSTOMER_PERSON, $form_data, $id)) 
				{
					if($status==0)
					{
						$this->Queries->updatePerson(TBL_JOBWCUSTOMER_PERSON, $about_data, $check_data);
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
					$this->Queries->updatePerson(TBL_JOBWCUSTOMER_PERSON, $about_data, $check_add_data);
				}
				if ($this->Queries->addRecord(TBL_JOBWCUSTOMER_PERSON, $form_data)) 
				{	
					
					$this->session->set_flashdata('success_msg', 'Contact Person Added Successfully');
				}
				else
				{ 
					$this->session->set_flashdata('error_msg', 'Failed To Add Contact Person');
				}
			}
			return redirect('Settings/JobWorkerMaster/addPerson/'.$customerid);		
		}
	}
	/********************************** Delete Customer Management  ************************************/
	public function delete($id)
	{
		if (!check_role_assigned('jobworker', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_JOBWORKER_MASTER, $form_data, $id)) :
			
			$this->session->set_flashdata('success_msg', 'Customer  Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Customer');
		endif;
		return redirect('Settings/JobWorkerMaster/');
	}
	/****************************************** Delete Contact Person *********************************************/
	public function deletePerson($customerid,$id)
	{
        if (!check_role_assigned('jobworker', 'delete')) {
            redirect('forbidden');
        }
        $today = date('Y-m-d H:i:s');
        $form_data = array(
            'isdelete' => 1,
            'updated_by' => $this->session->userdata['logged_in']['userid'],
            'updated_on' => $today
        );
        if ($this->Queries->updateRecord(TBL_JOBWCUSTOMER_PERSON, $form_data, $id)) :
            $this->session->set_flashdata('success_msg', 'Contact Person  Deleted Successfully');
        else :
            $this->session->set_flashdata('error_msg', 'Failed To Delete Contact Person');
        endif;
        return redirect('Settings/JobWorkerMaster/addPerson/'.$customerid);
	}
	
}

