<?php
class CountryMaster extends CI_Controller
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
		if (!check_role_assigned('country_master', 'view')) {
			redirect('forbidden');
		}
		// init params
		$params = array();
		$searchtxt = array();
		$params['CountryMaster'] = $this->Queries->getCountryMaster($searchtxt);
    
		$this->load->view('Settings/CountryMaster/index', $params);
	}

	public  function add($id = 0)
	{
				
		try {
            $params["id"]=$id;
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('country_master', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_COUNTRY_MASTER . " where isdelete=0 and id=" . $id;
				$params["CountryMaster"] = $this->Queries->getSingleRecord($query);
			
			}
			if (!check_role_assigned('country_master', 'add')) {
				redirect('forbidden');
			}
			$this->load->view('Settings/CountryMaster/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}


	public function save()
	{
			
		$this->form_validation->set_rules('country_name', 'Country Name', 'required');
		if ($this->form_validation->run()) {
			
			$country_name = StringRepair($this->input->post('country_name'));
            $short_name = StringRepair($this->input->post('short_name'));
			
			$id = $this->input->post('id');
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				
				$res=$this->Queries->getSingleRecord('select * from '.TBL_COUNTRY_MASTER.' where isdelete=0 and country_name="'.$country_name.'" and id!='.$id);
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Country  Already Exists');
					redirect('Settings/CountryMaster/add/'.$id);
				}

				$form_data = array(
					'country_name' => $country_name,
					'short_name' => $short_name,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_COUNTRY_MASTER, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Country  Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Country ');
				endif;
				

			} else {
				$res=$this->Queries->getSingleRecord('select * from '.TBL_COUNTRY_MASTER.' where isdelete=0 and country_name="'.$country_name.'"');
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Country  Already Exists');
					redirect('Settings/CountryMaster/add');
				}
				$form_data = array(
					'country_name' => $country_name,
					'short_name' => $short_name,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_COUNTRY_MASTER, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Country  Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Country ');
				endif;
				
				
			}
			
		}

		return redirect('Settings/CountryMaster/');
	}
	public function delete($id)
	{
		if (!check_role_assigned('country_master', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_COUNTRY_MASTER, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Country  Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete CountryMaster');
		endif;

		return redirect('Settings/CountryMaster/');
	}


}

