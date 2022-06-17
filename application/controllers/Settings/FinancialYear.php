<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class FinancialYear extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setting_model');
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	}

	public function index()
	{
		if (!check_role_assigned('financial_year', 'view')) {
			redirect('forbidden');
		}
		// init params
		$params = array();
		$searchtxt = array();
		$companyid=$this->session->userdata['financial_year']['companyid'];
		$params['FinancialYear'] = $this->setting_model->getFinancialYear($searchtxt,$companyid);
		
		$this->load->view('Settings/FinancialYear/index', $params);
	}

	public  function add($id = 0)
	{
				
		try {
            $params["id"]=$id;
			$query = "select * from ".TBL_COMPANY_MANAGEMENT. " where isdelete=0";
			$params['companylist']=$this->Queries->get_tab_list($query,'id','company_name');
			
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('financial_year', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_FINANCIAL_YEAR . " where isdelete=0 and id=" . $id;
				$params["FinancialYear"] = $this->Queries->getSingleRecord($query);
				
			}
			if (!check_role_assigned('financial_year', 'add')) {
				redirect('forbidden');
			}
			$this->load->view('Settings/FinancialYear/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}


	public function save()
	{
			
		$this->form_validation->set_rules('name', 'FinancialYear Name', 'required');
		if ($this->form_validation->run()) {
			
			$name = StringRepair($this->input->post('name'));
			$companyid= StringRepair($this->input->post('company_id'));
			$ms_value = StringRepair($this->input->post('ms_value'));
			$start_date = StringRepair($this->input->post('start_date'));
			$start_date= date_create_from_format('d/m/Y',$start_date);
			$start_date=date_format($start_date,'Y-m-d');
			$end_date = StringRepair($this->input->post('end_date'));
			$end_date= date_create_from_format('d/m/Y',$end_date);
			$end_date=date_format($end_date,'Y-m-d');
			$companydetail=$this->Queries->getSingleRecord('select * from '.TBL_COMPANY_MANAGEMENT.' where isdelete=0 and id='.$companyid);
			$companyname=$name.'('.$companydetail->company_name.')';
			$id = $this->input->post('id');
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				
				// $res=$this->Queries->getSingleRecord('select * from '.TBL_FINANCIAL_YEAR.' where isdelete=0 and (start_date>="'.$start_date.'"   and end_date<="'.$end_date.'") and id!='.$id);
				// if($res!=null)
				// {
				// 	$this->session->set_flashdata('error_msg', 'Financial Year Date Must Not Conflicts To Any Existing Year');
				// 	redirect('Settings/FinancialYear/add/'.$id);
				// }

				if($this->session->userdata['financial_year']['id']==$id)
				{
						$this->session->userdata['financial_year']['name']=$name;
						$this->session->userdata['financial_year']['ms_value']=$ms_value;
						$this->session->userdata['financial_year']['start_date']=$start_date;
						$this->session->userdata['financial_year']['end_date']=$end_date;
				}

				$form_data = array(
					'name' => $name,
					'company_id' => $companyid,
					'company_name' => $companyname,
					'ms_value'=>$ms_value,
					'start_date' => $start_date,
					'end_date'=>$end_date,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_FINANCIAL_YEAR, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Financial Year Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Financial Year');
				endif;
				

			} else {
				$res=$this->Queries->getSingleRecord('select * from '.TBL_FINANCIAL_YEAR.' where isdelete=0 and start_date>="'.$start_date.'"   and end_date<="'.$end_date.'"');
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Financial Year Date Must Not Conflicts To Any Existing Year');
					redirect('Settings/FinancialYear/add');
				}
				$form_data = array(
					'name' => $name,
					'company_id' => $companyid,
					'company_name' => $companyname,
					'ms_value'=>$ms_value,
					'start_date' => $start_date,
					'end_date'=>$end_date,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_FINANCIAL_YEAR, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Financial Year Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Financial Year');
				endif;
				
				
			}
			
		}

		return redirect('Settings/FinancialYear/index/');
	}
	public function delete($id)
	{
		if (!check_role_assigned('financial_year', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_FINANCIAL_YEAR, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Financial Year Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete FinancialYear');
		endif;

		return redirect('Settings/FinancialYear/');
	}

		public  function ChangeStatus()
		{
			$arr=array();
			$arr['status']=0;
			$id=StringRepair($this->input->post('id'));

					if($id!=0 && $id!="")
					{
						$res=$this->Queries->getSingleRecord('select * from '.TBL_FINANCIAL_YEAR.' where id='.$id);		
						if($res!=null)
						{	$fin_id=$this->session->userdata['financial_year']['id'];
							if($id==$fin_id)
							{
								$arr['status']=1;
								$this->session->unset_userdata('financial_year');
								$arr['html']='<span class="badge badge-warning change-status" data-id="'.$id.'" >Not Active</span> ';
							}else{
									
									$this->session->unset_userdata('financial_year');
									$arr['status']=2;
									$arr['old']=$fin_id;
									$arr['html']='<span class="badge badge-warning change-status" data-id="'.$fin_id.'" >Not Active</span> ';
									$arr['new']=$res->id;
									$arr['html2']='<span class="badge badge-success change-status" data-id="'.$res->id.'" >Active</span> ';

									$this->session->userdata['financial_year']['id']=$res->id;
									$this->session->userdata['financial_year']['companyid']=$res->company_id;
									$this->session->userdata['financial_year']['name']=$res->name;
									$this->session->userdata['financial_year']['ms_value']=$res->ms_value;
									$this->session->userdata['financial_year']['start_date']=$res->start_date;
									$this->session->userdata['financial_year']['end_date']=$res->end_date;

							}

						}
					}
			echo json_encode($arr);
		}

}
