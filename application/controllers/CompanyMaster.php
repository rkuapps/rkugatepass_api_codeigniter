<?php
class CompanyMaster extends CI_Controller
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
		if (!check_role_assigned('company_master', 'view')) {
			redirect('forbidden');
		}
		// init params
		$params = array();
		$searchtxt = array();
		$params['CompanyMaster'] = $this->Queries->getCompanyMaster($searchtxt);
		
		
		
		$this->load->view('CompanyMaster/index', $params);
	}

	public  function add($id = 0)
	{
				
		try {
            $params["id"]=$id;
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('company_master', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_COMPANY_MASTER . " where isdelete=0 and id=" . $id;
				$params["CompanyMaster"] = $this->Queries->getSingleRecord($query);
			
			}
			if (!check_role_assigned('company_master', 'add')) {
				redirect('forbidden');
			}

			$query="select * from ".TBL_BANK_MASTER." where isdelete=0";
			$params['banklist']=$this->Queries->get_tab_list($query,'id','bank_name');
			$query="select * from ".TBL_CURRENCY_MASTER." where isdelete=0";
			$params['currencylist']=$this->Queries->get_tab_list($query,'id','currency_name');
			$query="select * from ".TBL_COUNTRY_MASTER." where isdelete=0";
			$params['countrylist']=$this->Queries->get_tab_list($query,'id','country_name');
			$this->load->view('CompanyMaster/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}

	public  function addANR($companyid=0,$id = 0)
	{
				
		try {
			$params["companyid"]=$companyid;
            $params["id"]=$id;
			if($companyid==0 || $companyid=="")
			{
				redirect('CompanyMaster');
			}
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('company_master', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_COMPANY_ANR . " where isdelete=0  and companyid=".$companyid." and id=" . $id;
				$params["companyanr"] = $this->Queries->getSingleRecord($query);
			
			}
			if (!check_role_assigned('company_master', 'add')) {
				redirect('forbidden');
			}

				$query="select * from ".TBL_COMPANY_ANR." where isdelete=0 and companyid=".$companyid." order by id desc";
			$params['anrnolist']=$this->Queries->getRecord($query);
			$this->load->view('CompanyMaster/addANR', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}

	
	public function save()
	{
			
		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		if ($this->form_validation->run()) {
			
			$company_name = StringRepair($this->input->post('company_name'));
			$short_name = StringRepair($this->input->post('short_name'));
			$bankid = StringRepair($this->input->post('bankid'));
			
			$countryid = StringRepair($this->input->post('countryid'));
			$currencyid = StringRepair($this->input->post('currencyid'));
			$place = StringRepair($this->input->post('place'));
			$pincode = StringRepair($this->input->post('pincode'));
			
			$state=StringRepair($this->input->post('state'));
			$gstno= StringRepair($this->input->post('gstno'));
			$code = StringRepair($this->input->post('code'));
			$address = StringRepair($this->input->post('address'));
			$iec_date=date_create_from_format('d/m/Y',$this->input->post('iec_date'));
			$iec_date=date_format($iec_date,'Y-m-d');
			$arn=StringRepair($this->input->post('arn'));
			
			$id = $this->input->post('id');
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				
				$res=$this->Queries->getSingleRecord('select * from '.TBL_COMPANY_MASTER.' where isdelete=0 and company_name="'.$company_name.'" and id!='.$id);
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Company Already Exists');
					redirect('CompanyMaster/add/'.$id);
				}

				$form_data = array(
					'company_name' => $company_name,
					'short_name'=>$short_name,
					'bankid'=>$bankid,
					'place'=>$place,
					'countryid'=>$countryid,
					'pincode'=>$pincode,
					'address'=>$address,
					'state'=>$state,
					'gstno'=>$gstno,
					'code'=>$code,
					'currencyid'=>$currencyid,
					'iec_date'=>$iec_date,
					'arn'=>$arn,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_COMPANY_MASTER, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Company Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Company');
				endif;
				$pid=$id;

			} else {
				$res=$this->Queries->getSingleRecord('select * from '.TBL_COMPANY_MASTER.' where isdelete=0 and company_name="'.$company_name.'"');
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Company Already Exists');
					redirect('CompanyMaster/add');
				}
				$form_data = array(
					'company_name' => $company_name,
					'short_name'=>$short_name,
					'bankid'=>$bankid,
					'place'=>$place,
					'address'=>$address,
					'countryid'=>$countryid,
					'pincode'=>$pincode,
					'state'=>$state,
					'gstno'=>$gstno,
					'code'=>$code,
					'currencyid'=>$currencyid,
					'iec_date'=>$iec_date,
					'arn'=>$arn,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_COMPANY_MASTER, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Company Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Company');
				endif;
				$pid=$this->db->insert_id();
				
				
			}
			
		}

		return redirect('CompanyMaster/addANR/'.$pid);
	}

	public function saveANR()
	{
			
		$this->form_validation->set_rules('anr_no', 'ARN Number', 'required');
		if ($this->form_validation->run()) {
			
			$anr_no = StringRepair($this->input->post('anr_no'));
			$start_date = date_create_from_format('d/m/Y',$this->input->post('start_date'));
			$start_date=date_format($start_date,'Y-m-d');
			
			$end_date = date_create_from_format('d/m/Y',$this->input->post('end_date'));
			$end_date=date_format($end_date,'Y-m-d');

			$id = $this->input->post('id');
			$companyid = $this->input->post('companyid');
			$status=$this->input->post('status');
			if($status!="")
			{
				$act=1;
			}else{
				$act=0;
			}

			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				
				$res=$this->Queries->getSingleRecord('select * from '.TBL_COMPANY_ANR.' where isdelete=0 and anr_no="'.$anr_no.'" and id!='.$id);
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Company ANR No Already Exists');
					redirect('CompanyMaster/addANR/'.$companyid."/".$id);
				}

				$form_data = array(
					'anr_no' => $anr_no,
					'start_date'=>$start_date,
					'end_date'=>$end_date,
					'companyid'=>$companyid,
					'status'=>$act,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if($act==1)
					{
						$this->db->query('update '.TBL_COMPANY_ANR.' set status=0 ');
					}
				if ($this->Queries->updateRecord(TBL_COMPANY_ANR, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Company ANR No Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Company ANR No');
				endif;
				$pid=$id;

			} else {
				$res=$this->Queries->getSingleRecord('select * from '.TBL_COMPANY_ANR.' where isdelete=0 and anr_no="'.$anr_no.'"');
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Company ANR No Already Exists');
					redirect('CompanyMaster/addANR/'.$companyid);
				}
				
				$form_data = array(
					'anr_no' => $anr_no,
					'start_date'=>$start_date,
					'end_date'=>$end_date,
					'companyid'=>$companyid,
					'status'=>$act,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

					if($act==1)
					{
						$this->db->query('update '.TBL_COMPANY_ANR.' set status=0 ');
					}	
				if ($this->Queries->addRecord(TBL_COMPANY_ANR, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Company ANR No Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Company ANR No');
				endif;
				
				
			
			}
			return redirect('CompanyMaster/addANR/'.$companyid);		
		}

		
	}
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
		if ($this->Queries->updateRecord(TBL_COMPANY_MASTER, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Company Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete CompanyMaster');
		endif;

		return redirect('CompanyMaster/');
	}


public function deleteANR($id,$companyid)
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
		if ($this->Queries->updateRecord(TBL_COMPANY_ANR, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Company ANR No Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Company ANR');
		endif;

		return redirect('CompanyMaster/addANR/'.$companyid);
	}

}

