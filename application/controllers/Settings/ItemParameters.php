<?php
class ItemParameters extends CI_Controller
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
            if (!check_role_assigned('item_parameters', 'view')) {
                redirect('forbidden');
            }
            $params = array();
            $searchtxt = array();
            $params['ItemParameters'] = $this->setting_model->getItemParameters($searchtxt);
            $this->load->view('Settings/ItemParameters/index', $params);
	}
	/************************************* Add/Edit Item Parameter View *****************************************/
	public  function add($id = 0)
	{
            try {
                $params["id"]=$id;
                if ($id != "" and $id != 0) {
                    if (!check_role_assigned('item_parameters','edit')) {
                        redirect('forbidden');
                    }
                    $query = "select * from " . TBL_ITEM_PARAMETERS . " where id=" . $id;
                    $params["ItemParameters"] = $this->Queries->getSingleRecord($query);
                }
                if (!check_role_assigned('item_parameters', 'add')) {
                    redirect('forbidden');
                }
            $query="select * from ".TBL_ITEM_SUBCATEGORY." where isdelete=0";    
            $params['Parameterslist']=$this->Queries->get_tab_list($query,'id','subcategory_name');
    
            $this->load->view('Settings/ItemParameters/add', $params);
            } catch (Exception $e) {
                echo $e;
            }
	}
	/***************************************** Save ItemCategory  ************************************************/
	public function save()
	{
		$this->form_validation->set_rules('Parameter_name', 'Parameter Name', 'required');
		if ($this->form_validation->run()) {
			
			$Parameter_name = StringRepair($this->input->post('Parameter_name'));
			$categoryid = StringRepair($this->input->post('categoryid'));
            $hsn_code = StringRepair($this->input->post('hsn_code'));
			$description =StringRepair($this->input->post('description'));
			$id = $this->input->post('id');
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				$res=$this->Queries->getSingleRecord('select * from '.TBL_ITEM_PARAMETERS.' where isdelete=0 and 	Parameter_name="'.$Parameter_name.'" and id!='.$id);
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Item Category  Already Exists');
					redirect('Settings/ItemParameters/add/'.$id);
				}
				$form_data = array(
					'parameter_name' => $Parameter_name,
					'subid' => $categoryid,
					'description'=>$description,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_ITEM_PARAMETERS, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Item Parameter  Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Item Parameter ');
				endif;
			} else {
				$res=$this->Queries->getSingleRecord('select * from '.TBL_ITEM_PARAMETERS.' where isdelete=0 and 	Parameter_name="'.$Parameter_name.'"');
				if($res!=null)
				{
					$this->session->set_flashdata('error_msg', 'Item Parameter  Already Exists');
					redirect('Settings/ItemParameters/add');
				}
				$form_data = array(
					'parameter_name' => $Parameter_name,
                    'subid' => $categoryid,
					'description'=>$description,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->addRecord(TBL_ITEM_PARAMETERS, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Item Parameter  Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Item Parameter ');
				endif;
			}
		}
		return redirect('Settings/ItemParameters/');
	}
	/******************************************** Delete Item Category ********************************************/
	public function delete($id)
	{
		if (!check_role_assigned('item_parameters', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_ITEM_PARAMETERS, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Item Category  Deleted Successfully');
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete ItemParameters');
		endif;
		return redirect('Settings/ItemParameters/');
	}


}

