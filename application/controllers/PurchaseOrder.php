<?php
class PurchaseOrder extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PurchaseOrder_model');
		$this->load->model('Inventory_model');
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	}
	/************************************** Display All Purchase Order **************************************/
	public function index()
	{
		$params = array();
		$searchtxt = array();
		$params['PurchaseOrder'] = $this->PurchaseOrder_model->getPurchaseOrder($searchtxt);
		$this->load->view('PurchaseOrder/index', $params);
	}
	/***************************************** Add/Edit Purchase Order view **************************************/
	public  function add($id = 0)
	{
		$fin_id = $this->session->userdata['financial_year']['id'];
		$companyid = $this->session->userdata['financial_year']['companyid'];
		try {
			$params["id"] = $id;
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('purchase_order', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_PURCHASE_ORDER . " where isdelete=0 and finid=$fin_id and id=" . $id;
				$params["PurchaseOrder"] = $this->Queries->getSingleRecord($query);
				$res = $this->Queries->getSingleRecord('select sum(total) as total from ' . TBL_PURCHASE_ORDER_SUB . " where isdelete=0  and poid=" . $id);
				$params['item_total_amount'] = 0 + $res->total + $params['PurchaseOrder']->freight;
				$query = "select id,CONCAT(item_name,' (',unique_no,')') as item_name from " . TBL_CUSTOMER_ITEM . " where isdelete=0 AND customerid=" . $params["PurchaseOrder"]->customerid;
				$params["itemlist"] = $this->Queries->get_tab_list($query, 'id', 'item_name');
				$query = "select id,delivery_date,item_id,(select unique_no from " . TBL_CUSTOMER_ITEM . " where isdelete=0 AND id=t1.item_id) as unique_no,qty,amount,total from " . TBL_PURCHASE_ORDER_SUB . " as t1 where isdelete=0 and poid=" . $id;
				$params["ordersublist"] = $this->Queries->getRecord($query);
			}
			if (!check_role_assigned('purchase_order', 'add')) {
				redirect('forbidden');
			}
			$query = "select * from " . TBL_CUSTOMER_MANAGEMENT . " where isdelete=0 AND party_type=2";
			$params['customerlist'] = $this->Queries->get_tab_list($query, 'id', 'customer_name');
			// Generating of Purchase Order No.
			$finname = $this->session->userdata["financial_year"]["name"];
			$params['ponumber'] = $finname . '/' . sprintf('%04d', 1);
			$query = "select * from " . TBL_PURCHASE_ORDER . " where isdelete=0 ORDER BY id DESC LIMIT 1";
			$po = $this->Queries->getSingleRecord($query);
			if (count($po) > 0) {
				$pod = explode('/', $po->ponumber);
				$params['ponumber'] = $finname . '/' . sprintf('%04d', $pod[1] + 1);
			}
			$this->load->view('PurchaseOrder/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}
	/******************************************* Save Order *************************************************/
	public function save()
	{
		$fin_id = $this->session->userdata['financial_year']['id'];
		$customerid = StringRepair($this->input->post('customerid'));
		$ponumber = StringRepair($this->input->post('ponumber'));
		$po_date = date_create_from_format('d/m/Y', $this->input->post('podate'));
		$po_date = date_format($po_date, 'Y-m-d');
		$freight = StringRepair($this->input->post('freight'));
		$pay_terms = StringRepair($this->input->post('pay_terms'));
		$id = $this->input->post('id');
		$today = date('Y-m-d H:i:s');
		if ($id != 0 and $id != "") {
			$form_data = array(
				'finid' => $fin_id,
				'po_date' => $po_date,
				'customerid' => $customerid,
				'ponumber' => $ponumber,
				'freight' => $freight,
				'pay_terms' => $pay_terms,
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);
			if ($this->Queries->updateRecord(TBL_PURCHASE_ORDER, $form_data, $id)) :
				$this->session->set_flashdata('success_msg', 'Purchase Order Updated Successfully');
			else :
				$this->session->set_flashdata('error_msg', 'Failed To Update Purchase Order');
			endif;
			$pid = $id;
		} else {
			$form_data = array(
				'finid' => $fin_id,
				'po_date' => $po_date,
				'customerid' => $customerid,
				'ponumber' => $ponumber,
				'freight' => $freight,
				'pay_terms' => $pay_terms,
				'created_by' => $this->session->userdata['logged_in']['userid'],
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);
			if ($this->Queries->addRecord(TBL_PURCHASE_ORDER, $form_data)) :
				$this->session->set_flashdata('success_msg', 'Purchase Order Added Successfully');
			else :
				$this->session->set_flashdata('error_msg', 'Failed To Add Purchase Order');
			endif;
			$pid = $this->db->insert_id();
		}
		return redirect('PurchaseOrder/add/' . $pid);
	}
	/************************************************Edit Item ***************************************/
	public function SingleItem($orderid, $id)
	{
		$res = 0;
		if ($id != "" && $id != 0) {
			$query = "select id,poid,item_id,delivery_date,qty,amount,total from " . TBL_PURCHASE_ORDER_SUB . " where isdelete=0 and poid=$orderid and id=" . $id;
			$res = $this->Queries->getSingleRecord($query);
			$temp = date_create_from_format('Y-m-d', $res->delivery_date);
			$res->delivery_date = date_format($temp, 'd/m/Y');
		}
		echo json_encode($res);
	}
	/****************************************** Save Item Details **********************************************/
	public function saveItem()
	{
		$html = "";
		$arr = array();
		$arr['status'] = 0;
		$description = "";
		$this->form_validation->set_rules('unique_no', 'unique_no', 'required');
		if ($this->form_validation->run()) {
			$result = $this->Queries->getSingleRecord('select id FROM ' . TBL_PURCHASE_ORDER_SUB . ' ORDER BY id DESC LIMIT 1');
			$purchaseid = $result->id + 1;
			$subid = StringRepair($this->input->post('subid'));
			$fin_id = $this->session->userdata['financial_year']['id'];
			$delivery_date = date_create_from_format('d/m/Y', $this->input->post('delivery_date'));
			$delivery_date = date_format($delivery_date, 'Y-m-d');
			$orderid = StringRepair($this->input->post('orderid'));
			$item_id = StringRepair($this->input->post('unique_no'));
			$qty = StringRepair($this->input->post('qty'));
			$amount = StringRepair($this->input->post('amount'));
			$total = StringRepair($this->input->post('total'));
			$today = date('Y-m-d H:i:s');
			if ($subid != 0 && $subid != "") {
				$item_data = array(
					'finid' => $fin_id,
					'item_id' => $item_id,
					'stype' => 1,
					'qty' => $qty,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				$form_data = array(
					'delivery_date' => $delivery_date,
					'item_id' => $item_id,
					'qty' => $qty,
					'amount' => $amount,
					'total' => $total,
				);
				if ($this->Queries->updateRecord(TBL_PURCHASE_ORDER_SUB, $form_data, $subid)) :
					$this->Inventory_model->insertInventory($item_id, $subid, $stype, $item_data);
					$arr['status'] = 2;
				endif;
				$res = $this->Queries->getSingleRecord('select sum(total) as total from ' . TBL_PURCHASE_ORDER_SUB . " where isdelete=0  and poid=" . $orderid);
				$arr['total'] = $res->total;
				$itemno = $this->Queries->getSingleRecord('select unique_no from ' . TBL_CUSTOMER_ITEM . ' where isdelete=0 and id=' . $item_id);
				$delivery_date = date_create_from_format('Y-m-d', $delivery_date);
				$delivery_date = date_format($delivery_date, 'd/m/Y');
				//<td>".$discount."</td>
				$html .= "
                        <td>" . $itemno->unique_no . "</td>
						<td>" . $delivery_date . "</td>
						<td>" . $qty . "</td>
						<td>" . sprintf("%0.2f", $amount) . "</td>
						<td>" . $total . "</td>
						<td>
							<div class=btn-group><a href='javascript:void(0)' class='btn btn-warning btn-xs  edittr' data-id='" . $subid . "'><span class='fa fa-edit'></span></a>
								</div>
								<div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='" . $subid . "'><span class='fa fa-minus'></span></a>
							</div>
						</td>	
				";
			} else {
				$today = date('Y-m-d H:i:s');
				$item_data = array(
					'finid' => $fin_id,
					'item_id' => $item_id,
					'subid' => $purchaseid,
					'stype' => 1,
					'qty' => $qty,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				$form_data = array(
					'fin_id' => $fin_id,
					'poid' => $orderid,
					'delivery_date' => $delivery_date,
					'item_id' => $item_id,
					'qty' => $qty,
					'amount' => $amount,
					'total' => $total,
				);
				if ($this->Queries->addRecord(TBL_PURCHASE_ORDER_SUB, $form_data)) :
					$subid = $this->db->insert_id();
					$stype = 1;
					$this->Inventory_model->insertInventory($item_id, $subid, $stype, $item_data);
					$arr['status'] = 1;
				endif;
				$id = $this->db->insert_id();
				$itemno = $this->Queries->getSingleRecord('select unique_no from ' . TBL_CUSTOMER_ITEM . ' where isdelete=0 and id=' . $item_id);
				$res = $this->Queries->getSingleRecord('select sum(total) as total from ' . TBL_PURCHASE_ORDER_SUB . " where isdelete=0  and poid=" . $orderid);
				$result = $this->Queries->getSingleRecord('select freight from ' . TBL_PURCHASE_ORDER . " where isdelete=0  and id=" . $orderid);
				$arr['total'] = $res->total + $result->freight;
				$delivery_date = date_create_from_format('Y-m-d', $delivery_date);
				$delivery_date = date_format($delivery_date, 'd/m/Y');
				//<td>".$discount."</td>
				$html .= "
				        <tr id='item_tr_" . $id . "'>
                        <td>" . $itemno->unique_no . "</td>
						<td>" . $delivery_date . "</td>
						<td>" . $qty . "</td>
						<td>" . $amount . "</td>
						<td>" . $total . "</td>
                        <td>
						      <div class=btn-group><a href='javascript:void(0)' class='btn btn-warning btn-xs  edittr' data-id='" . $id . "'><span class='fa fa-edit'></span></a>
                                                                    </div>
                                                                    <div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='" . $id . "'><span class='fa fa-minus'></span></a>
                                                                    </div>
						</td>
                        </td>
                    </tr>
				";
			}
			$form_data = array(
				'total' => $arr['total'],
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);
			$this->Queries->updateRecord(TBL_PURCHASE_ORDER, $form_data, $orderid);
			$arr['html'] = $html;
		}
		echo json_encode($arr);
	}
	/*********************************** Delete Item from Order *****************************************/
	public function deleteItem()
	{
		if (!check_role_assigned('purchase_order', 'delete')) {
			redirect('forbidden');
		}
		$html = "";
		$arr = array();
		$arr['status'] = 0;
		$this->form_validation->set_rules('id', 'id', 'required');
		if ($this->form_validation->run()) {
			$id = StringRepair($this->input->post('id'));
			$orderid = StringRepair($this->input->post('orderid'));
			$today = date('Y-m-d H:i:s');
			$stype = 1;
			$form_data = array(
				'isdelete' => 1,
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);
			if ($this->Queries->updateRecord(TBL_PURCHASE_ORDER_SUB, $form_data, $id)) :
				$this->Queries->updateStock(TBL_INVENTORY, $form_data, $id, $stype);
				$arr['status'] = 1;
			endif;
			$res = $this->Queries->getSingleRecord('select sum(total) as total from ' . TBL_PURCHASE_ORDER_SUB . " where isdelete=0  and poid=" . $orderid);
			$result = $this->Queries->getSingleRecord('select freight from ' . TBL_PURCHASE_ORDER . " where isdelete=0  and id=" . $orderid);
			$arr['total'] = 0 + $res->total + $result->freight;
			$form_data = array(
				'total' => $arr['total'],
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);
			$this->Queries->updateRecord(TBL_PURCHASE_ORDER, $form_data, $orderid);
		}
		echo json_encode($arr);
	}
	/******************************************* Delete Purchase Order *****************************************/
	public function delete($id)
	{
		if (!check_role_assigned('purchase_order', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$stype = 1;
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_PURCHASE_ORDER, $form_data, $id)) :
			$this->Queries->updatePurchaseOrder(TBL_PURCHASE_ORDER_SUB, $form_data, $id);
			//$this->Queries->updateStock(TBL_INVENTORY,$form_data,$id,$stype);
			$this->session->set_flashdata('success_msg', 'Purchase Order Deleted Successfully');
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Purchase Order');
		endif;
		return redirect('PurchaseOrder/');
	}
	/**************************************************** Print Purchase Order ****************************************/
	public function Print($id = 0)
	{
		if (!check_role_assigned('purchase_order', 'view')) {
			redirect('forbidden');
		}
		$params = array();
		$params["id"] = $id;
		$params['pdf'] = base_url() . "Order/pdf/" . $id;
		$params['companydetail'] = $this->Queries->getCompany();
		$params['customerorder'] = $this->PurchaseOrder_model->getSingleOrder($id);
		$params['subOrderList'] = $this->PurchaseOrder_model->getsubOrdersList($id);
		$this->load->view('PurchaseOrder/Print', $params);
	}
	public function Pdf($id = 0)
	{
		if (!check_role_assigned('quotation', 'view')) {
			redirect('forbidden');
		}
		ini_set('max_execution_time', '0'); 
		$params = array();
		$params['companydetail'] = $this->Queries->getCompany();
		$params['customerorder'] = $this->PurchaseOrder_model->getSingleOrder($id);
		$params['subOrderList'] = $this->PurchaseOrder_model->getsubOrdersList($id);
		// $this->load->view('Quotations/Pdf', $params);
		$this->load->library('Pdf');
		$html = $this->load->view('PurchaseOrder/Pdf', $params, true);
		$filename = "PO_".str_replace("/","_",$params['customerorder']->ponumber);
		$this->pdf->create($html, $filename);
		$attachment = 'uploads/' . $filename . ".pdf";
	}
}
