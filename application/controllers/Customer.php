<?php
class Customer extends CI_Controller
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
		if (!check_role_assigned('customer', 'view')) {
			redirect('forbidden');
		}
		// init params
		$params = array();
		$searchtxt = array();
		$params['Customer'] = $this->Queries->getCustomer($searchtxt);
		
		
		
		$this->load->view('Customer/index', $params);
	}

	public  function add($id = 0)
	{
				
		try {
            $params["id"]=$id;
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('customer', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_CUSTOMER . " where isdelete=0 and id=" . $id;
				$params["Customer"] = $this->Queries->getSingleRecord($query);
			
			}
			if (!check_role_assigned('customer', 'add')) {
				redirect('forbidden');
			}

			$query="select * from ".TBL_COUNTRY_MASTER." where isdelete=0";
			$params['finaldestinationlist']=$this->Queries->get_tab_list($query,'id','country_name');
			$query="select * from ".TBL_CURRENCY_MASTER." where isdelete=0";
			$params['currencylist']=$this->Queries->get_tab_list($query,'id','currency_name');
			$query="select * from ".TBL_COUNTRY_MASTER." where isdelete=0";
			$params['countrylist']=$this->Queries->get_tab_list($query,'id','country_name');
			$query="select * from ".TBL_COMPANY_MASTER." where isdelete=0";
			$params['companylist']=$this->Queries->get_tab_list($query,'id','company_name');
			
			$this->load->view('Customer/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}


	public function save()
	{
			
		$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
		if ($this->form_validation->run()) {
			
			$customer_name = StringRepair($this->input->post('customer_name'));
			$short_name = StringRepair($this->input->post('short_name'));
			$customer_code = StringRepair($this->input->post('customer_code'));
			$countryid = StringRepair($this->input->post('countryid'));
			$currencyid = StringRepair($this->input->post('currencyid'));
			$final_destination = StringRepair($this->input->post('final_destination'));
			$address=StringRepair($this->input->post('address'));
			$companyid=StringRepair($this->input->post('companyid'));
	
		
			
			$id = $this->input->post('id');
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				
				$res=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER.' where isdelete=0 and customer_name="'.$customer_name.'" and id!='.$id);
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Customer Already Exists');
					redirect('Customer/add/'.$id);
				}

				$form_data = array(
					'customer_name' => $customer_name,
					'short_name'=>$short_name,
					'customer_code'=>$customer_code,
					'countryid'=>$countryid,
					'final_destination'=>$final_destination,
					'address'=>$address,
					'companyid'=>$companyid,
					'currencyid'=>$currencyid,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_CUSTOMER, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Customer Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Customer');
				endif;
				

			} else {
				$res=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER.' where isdelete=0 and customer_name="'.$customer_name.'"');
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Customer Already Exists');
					redirect('Customer/add');
				}
				$form_data = array(
					'customer_name' => $customer_name,
					'short_name'=>$short_name,
					'customer_code'=>$customer_code,
					'countryid'=>$countryid,
					'final_destination'=>$final_destination,
					'companyid'=>$companyid,
					'address'=>$address,
					'currencyid'=>$currencyid,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_CUSTOMER, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Customer Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Customer');
				endif;
				
				
			}
			
		}

		return redirect('Customer/');
	}
	public function delete($id)
	{
		if (!check_role_assigned('customer', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_CUSTOMER, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Customer Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Customer');
		endif;

		return redirect('Customer/');
	}

	public function getCotactPerson($id = 0){

		$query = "select id,name from ".TBL_CUSTOMER_PERSON." where isdelete=0 and customer_id = ".$id;
		$contactlist = $this->Queries->get_tab_list($query,'id','name');
		echo dropdownbox('4','Consignee','consignee',$contactlist,'','required');
	}

}

