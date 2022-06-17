<?php
class Item extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(Inventory_model);
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	}

	public function index($id = 0)
	{
		if ($id == 0 || $id == "") {
			redirect('Settings/CustomerManagement');
		}
		if (!check_role_assigned('item', 'view')) {
			redirect('forbidden');
		}
		// init params
		$params = array();
		$searchtxt = array();
		$searchtxt['customerid'] = $id;
		$params['customerid'] = $id;
		$query = 'select party_type from ' . TBL_CUSTOMER_MANAGEMENT . ' where isdelete=0 AND id=' . $id;
		$party = $this->Queries->getSingleRecord($query);
		$params['party_type'] = $party->party_type;
		$params['itemlist'] = $this->Queries->getItem($searchtxt);

		$this->load->view('Item/index', $params);
	}

	public  function add($customerid = 0, $id = 0)
	{
		if ($customerid == 0 || $customerid == "") {
			redirect('Customer');
		}

		try {
			$params["id"] = $id;
			$params["customerid"] = $customerid;
			$query = 'select party_type from ' . TBL_CUSTOMER_MANAGEMENT . ' where isdelete=0 AND id=' . $customerid;
			$party = $this->Queries->getSingleRecord($query);
			$params['party_type'] = $party->party_type;
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('item', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_CUSTOMER_ITEM . " where isdelete=0 and id=" . $id;
				$params["Item"] = $this->Queries->getSingleRecord($query);

				// $query = "select id as subid,metal_name,part_type,part_name,weight from " . TBL_CUSTOMER_ITEM_SUB . "  where  isdelete=0 and itemid=" . $id;
				// $params["ItemSub"] = $this->Queries->getRecord($query);

			}
			if (!check_role_assigned('item', 'add')) {
				redirect('forbidden');
			}

			$query = "select t1.id,CONCAT(t2.category_name,'-',t1.subcategory_name) as categories from " . TBL_ITEM_SUBCATEGORY . " as t1 LEFT JOIN " . TBL_ITEM_CATEGORY . " as t2 ON t1.cid=t2.id where t1.isdelete=0";
			$params['categorylist'] = $this->Queries->get_tab_list($query, 'id', 'categories');

			$query = "select * from " . TBL_ITEM_UNIT . " where isdelete=0 AND status=1";
			$params['itemunit'] = $this->Queries->get_tab_list($query, 'id', 'unit_name');
			$params['units'] = array('0' => 'PCS', '1' => 'PCS', '1' => 'KG', '1' => 'Set');

			$this->load->view('Item/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}
	public function save()
	{
		$this->form_validation->set_rules('item_category', 'Item Category', 'required');
		if ($this->form_validation->run()) {
			$item_category = StringRepair($this->input->post('item_category'));
			$unique_no = StringRepair($this->input->post('unique_no'));
			$item_name = StringRepair($this->input->post('item_name'));
			$drawingno = StringRepair($this->input->post('drawingno'));
			$raw_material = StringRepair($this->input->post('raw_material'));
			$rivetweight = StringRepair($this->input->post('rivetweight'));
			$finalweight = StringRepair($this->input->post('finalweight'));
			$units = StringRepair($this->input->post('units'));
			$paramsize = StringRepair($this->input->post('paramsize'));
			$jw_itemname = StringRepair($this->input->post('jw_itemname'));
			$customerid = StringRepair($this->input->post('customerid'));
			$sub_data = json_decode($sub_data);
			$query = "select * from " . TBL_ITEM_SUBCATEGORY . " where isdelete=0 AND id=" . $item_category;
			$subcategory_data = $this->Queries->getSingleRecord($query);
			$item_maincategory = $subcategory_data->cid;
			$hsn_code = StringRepair($this->input->post('hsncode'));
			$id = $this->input->post('id');

			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				/*
				$res = $this->Queries->getSingleRecord('select * from ' . TBL_CUSTOMER_ITEM . ' where isdelete=0 and unique_no="' . $unique_no . '" and id!=' . $id);
				if ($res != null) {
					$this->session->set_flashdata('error_msg', 'Unique No  Already Exists');
					redirect('Item/add/' . $customerid . "/" . $id);
				}
				*/
				$form_data = array(
					'item_category' => $item_maincategory,
					'item_subcategory' => $item_category,
					'unique_no' => $unique_no,
					'item_name' => $item_name,
					'drawing_no' => $drawingno,
					'rawmaterial' => $raw_material,
					'rivetweight' => $rivetweight,
					'finalweight' => $finalweight,
					'unit_measurement' => $units,
					'hsn_code' => $hsn_code,
					'jw_itemname' => $jw_itemname,
					'paramsize' => $paramsize,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->updateRecord(TBL_CUSTOMER_ITEM, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Item Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Item');
				endif;

				$pid = $id;
			} else {
				$item_image = "";
				$item_detail = "";
				$isdelete = 0;
				/*
				$res = $this->Queries->getSingleRecord('select * from ' . TBL_CUSTOMER_ITEM . ' where unique_no="' . $unique_no . '" and isdelete=' . $isdelete);
				if ($res != null) {
					$this->session->set_flashdata('error_msg', 'Unique No  Already Exists');
					redirect('Item/add/' . $customerid . "/");
				}
				*/

				$form_data = array(
					'item_category' => $item_maincategory,
					'item_subcategory' => $item_category,
					'unique_no' => $unique_no,
					'item_name' => $item_name,
					'finalweight' => $finalweight,
					'unit_measurement' => $units,
					'hsn_code' => $hsn_code,
					'paramsize' => $paramsize,
					'jw_itemname' => $jw_itemname,
					'customerid' => $customerid,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_CUSTOMER_ITEM, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Item Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Item');
				endif;
			}
		}
		return redirect('Item/index/' . $customerid);
	}

	public function delete($customerid, $id)
	{
		// echo $id;exit;
		if (!check_role_assigned('item', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_CUSTOMER_ITEM, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Item Deleted Successfully');
		// $this->Queries->updateSpecialRecord(TBL_CUSTOMER_ITEM_SUB,$form_data,'itemid',$id);
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Item');
		endif;
		// echo $customerid;
		// echo $id;exit;
		return redirect('Item/index/' . $customerid);
	}
}
