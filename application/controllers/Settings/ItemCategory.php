<?php
class ItemCategory extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setting_model');
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	}

	/************************************* Display All Item Category ***************************************/
	public function index()
	{
		if (!check_role_assigned('item_category', 'view')) {
			redirect('forbidden');
		}
		// init params
		$params = array();
		$searchtxt = array();
		$params['ItemCategory'] = $this->setting_model->getItemCategory($searchtxt);
		
		
		
		$this->load->view('Settings/ItemCategory/index', $params);
	}

	/************************************* Add/Edit ItemCategory View *********************************************/
	public  function add($id = 0)
	{
				
		try {
            $params["id"]=$id;
			if ($id != "" and $id != 0) {
				//For Editing Functionality
				if (!check_role_assigned('item_category', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_ITEM_CATEGORY . " where id=" . $id;
				$params["ItemCategory"] = $this->Queries->getSingleRecord($query);
			
			}
			if (!check_role_assigned('item_category', 'add')) {
				redirect('forbidden');
			}
			
			
			$this->load->view('Settings/ItemCategory/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}


	/***************************************** Save ItemCategory  ************************************************/
	public function save()
	{
			
		$this->form_validation->set_rules('category_name', 'Category Name', 'required');
		if ($this->form_validation->run()) {
			
			$category_name = StringRepair($this->input->post('category_name'));
            $hsn_code = StringRepair($this->input->post('hsn_code'));
			$description =StringRepair($this->input->post('description'));
			
			$id = $this->input->post('id');
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				//for Update Functionality
				$res=$this->Queries->getSingleRecord('select * from '.TBL_ITEM_CATEGORY.' where isdelete=0 and category_name="'.$category_name.'" and id!='.$id);
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Item Category  Already Exists');
					redirect('Settings/ItemCategory/add/'.$id);
				}

				$form_data = array(
					'category_name' => $category_name,
					'description'=>$description,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_ITEM_CATEGORY, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Item Category  Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Item Category ');
				endif;
				

			} else {
				//For Adding Functionality
				$res=$this->Queries->getSingleRecord('select * from '.TBL_ITEM_CATEGORY.' where isdelete=0 and category_name="'.$category_name.'"');
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Item Category  Already Exists');
					redirect('Settings/ItemCategory/add');
				}
				$form_data = array(
					'category_name' => $category_name,
					'description'=>$description,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_ITEM_CATEGORY, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Item Category  Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Item Category ');
				endif;
				
				
			}
			
		}

		return redirect('Settings/ItemCategory/');
	}

	/********************************************* Delete Item Category ********************************************/
	public function delete($id)
	{
		if (!check_role_assigned('item_category', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_ITEM_CATEGORY, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Item Category  Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete ItemCategory');
		endif;

		return redirect('Settings/ItemCategory/');
	}


}

