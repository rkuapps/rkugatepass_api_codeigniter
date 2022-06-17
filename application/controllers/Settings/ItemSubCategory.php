<?php
class ItemSubCategory extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(setting_model);
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	}

	/************************************* Display All Item Category ***************************************/
	public function index()
	{
		if (!check_role_assigned('item_sub_category', 'view')) {
			redirect('forbidden');
		}
		$params = array();
		$searchtxt = array();
		$params['ItemSubCategory'] = $this->setting_model->getItemSubCategory($searchtxt);
		$this->load->view('Settings/ItemSubCategory/index', $params);
	}
	/************************************* Add/Edit Item SubCategory View *****************************************/
	public  function add($id = 0)
	{
		try {
            $params["id"]=$id;
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('item_sub_category','edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_ITEM_SUBCATEGORY . " where id=" . $id;
				$params["ItemSubCategory"] = $this->Queries->getSingleRecord($query);
			}
			if (!check_role_assigned('item_sub_category', 'add')) {
				redirect('forbidden');
			}
        $query="select * from ".TBL_ITEM_CATEGORY." where isdelete=0";    
        $params['categorylist']=$this->Queries->get_tab_list($query,'id','category_name');
   
		$this->load->view('Settings/ItemSubCategory/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}
	/***************************************** Save ItemCategory  ************************************************/
	public function save()
	{
		$this->form_validation->set_rules('subcategory_name', 'SubCategory Name', 'required');
		if ($this->form_validation->run()) {
			
			$subcategory_name = StringRepair($this->input->post('subcategory_name'));
			$categoryid = StringRepair($this->input->post('categoryid'));
            $hsn_code = StringRepair($this->input->post('hsn_code'));
			$description =StringRepair($this->input->post('description'));
			$id = $this->input->post('id');
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				$res=$this->Queries->getSingleRecord('select * from '.TBL_ITEM_SUBCATEGORY.' where isdelete=0 and 	subcategory_name="'.$subcategory_name.'" and id!='.$id);
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Item Category  Already Exists');
					redirect('Settings/ItemSubCategory/add/'.$id);
				}
				$form_data = array(
					'subcategory_name' => $subcategory_name,
					'cid' => $categoryid,
					'description'=>$description,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_ITEM_SUBCATEGORY, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Item SubCategory  Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Item SubCategory ');
				endif;
			} else {
				$res=$this->Queries->getSingleRecord('select * from '.TBL_ITEM_SUBCATEGORY.' where isdelete=0 and 	subcategory_name="'.$subcategory_name.'"');
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Item SubCategory  Already Exists');
					redirect('Settings/ItemSubCategory/add');
				}
				$form_data = array(
					'subcategory_name' => $subcategory_name,
                    'cid' => $categoryid,
					'description'=>$description,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
               
				if ($this->Queries->addRecord(TBL_ITEM_SUBCATEGORY, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Item SubCategory  Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Item SubCategory ');
				endif;
			}
		}
		return redirect('Settings/ItemSubCategory/');
	}

	/******************************************** Delete Item Category ********************************************/
	public function delete($id)
	{
        
		if (!check_role_assigned('item_sub_category', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_ITEM_SUBCATEGORY, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Item Category  Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete ItemSubCategory');
		endif;

		return redirect('Settings/ItemSubCategory/');
	}


}

