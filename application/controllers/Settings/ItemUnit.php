<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ItemUnit extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(setting_model);
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	}

	public function index()
	{
		if (!check_role_assigned('item_unit', 'view')) {
			redirect('forbidden');
		}
		// init params
		$params = array();
		$searchtxt = array();
		$params['itemunit'] = $this->setting_model->getItemUnit($searchtxt);
		
		$this->load->view('Settings/ItemUnit/index', $params);
	}

	public  function add($id = 0)
	{
				
		try {
            $params["id"]=$id;
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('financial_year', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_ITEM_UNIT . " where isdelete=0 and id=" . $id;
				$params["itemunit"] = $this->Queries->getSingleRecord($query);
			
			}
			if (!check_role_assigned('item_unit', 'add')) {
				redirect('forbidden');
			}
			$this->load->view('Settings/ItemUnit/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}


	public function save()
	{
			
		$this->form_validation->set_rules('name', 'ItemUnit Name', 'required');
		if ($this->form_validation->run()) {
			
			$name = StringRepair($this->input->post('name'));
			$desc = StringRepair($this->input->post('description'));
			$status = StringRepair($this->input->post('status'));
			

			$id = $this->input->post('id');
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				
				$res=$this->Queries->getSingleRecord("select * from ".TBL_ITEM_UNIT." where isdelete=0 and unit_name='".$name."' and id!=".$id);
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Item Allready Exists');
					redirect('Settings/ItemUnit/add/'.$id);
				}


				$form_data = array(
					'unit_name' => $name,
					'description'=>$desc,
					'status'=>$status,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_ITEM_UNIT, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Item Unit Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Item Unit');
				endif;
				

			} else {
				$res=$this->Queries->getSingleRecord("select * from ".TBL_ITEM_UNIT." where isdelete=0 and unit_name='".$name."'");
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Item Allready Exists');
					redirect('Settings/ItemUnit/add');
				}
				$form_data = array(
					'unit_name' => $name,
					'description'=>$desc,
					'status'=>$status,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_ITEM_UNIT, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Item Unit Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Item Unit');
				endif;
				
				
			}
			
		}

		return redirect('Settings/ItemUnit/index/');
	}
	public function delete($id)
	{
		if (!check_role_assigned('item_unit', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_ITEM_UNIT, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Item Unit Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Item Unit');
		endif;

		return redirect('Settings/ItemUnit/');
	}

		
}
