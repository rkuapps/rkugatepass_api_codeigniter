<?php
class GatePass extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('GatePass_Model');
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	}
	/************************* Display All Orders ***************************************/
	public function index()
	{
		$params = array();
		$searchtxt = array();
		$params['Order'] = $this->GatePass_Model->getOrder($searchtxt);
		$this->load->view('GatePass/index', $params);
	}
	/*************************** Add/Edit Order View *******************************************/
	public  function add($id = 0)
	{
		$fin_id = $this->session->userdata['financial_year']['id'];
		$companyid = $this->session->userdata['financial_year']['companyid'];
		$quotations = array('0' => '- Select -');
		// try {
		// 	$params["id"] = $id;

		// 	if ($id != "" and $id != 0) {
		// 		if (!check_role_assigned('order', 'edit')) {
		// 			redirect('forbidden');
		// 		}
		// 		$query = "select * from " . TBL_QUOTATION . " where isdelete=0 AND cid=" . $id;
		// 		$quotations = $this->Queries->get_tab_list($query, 'id', 'quotationno');
		// 		$query = "select * from " . TBL_ORDER . " where isdelete=0 and fin_id=$fin_id and id=" . $id;
		// 		$params["Order"] = $this->Queries->getSingleRecord($query);
		// 		$query = "select id,CONCAT(item_name,' (',unique_no,')') as item_name from " . TBL_CUSTOMER_ITEM . " where isdelete=0 and customerid=" . $params["Order"]->customerid;
		// 		$params["itemlist"] = $this->Queries->get_tab_list($query, 'id', 'item_name');
		// 		$query = "select * from " . TBL_CUSTOMER_MANAGEMENT . " where isdelete=0 and id=" . $params["Order"]->customerid;
		// 		$params['gstdetails'] = $this->Queries->getSingleRecord($query);
		// 		$res = $this->Queries->getSingleRecord('select sum(total) as total from ' . TBL_ORDER_SUB . " where isdelete=0  and orderid=" . $id);
		// 		$params['item_total_amount'] = $res->total;
		// 		$params["ordersublist"] = $this->Order_model->getOrderSublistRecord($id);
		// 	}
		// 	if (!check_role_assigned('order', 'add')) {
		// 		redirect('forbidden');
		// 	}

		// 	$query = "select * from " . TBL_CUSTOMER_MANAGEMENT . " where isdelete=0 AND party_type=1 AND company_id=" . $companyid;
		// 	$params['customerlist'] = $this->Queries->get_tab_list($query, 'id', 'customer_name');
		// 	$params['quotations'] = $quotations;
		// 	$query = "select * from " . TBL_CUSTOMER_ITEM . " where isdelete=0";
		// 	//$params["itemlist"] = $this->Queries->get_tab_list($query,'id','unique_no');
		// 	$this->load->view('Order/add', $params);
		// } catch (Exception $e) {
			// 	echo $e;
			// }
		$this->load->view('HostelUsers/add');
	}
	/******************************************* Save Order *************************************************/
	public function save()
	{
		/* Save For Order Master Value
			Page Order/add/
		 */
		$this->form_validation->set_rules('order_date', 'Order Date', 'required');

		if ($this->form_validation->run()) {

			$fin_id = $this->session->userdata['financial_year']['id'];
			$order_date = date_create_from_format('d/m/Y', $this->input->post('order_date'));
			$order_date = date_format($order_date, 'Y-m-d');
			$note = StringRepair($this->input->post('note'));
			$customerid = StringRepair($this->input->post('customerid'));
			$companyid = 0;
			$ponumber = StringRepair($this->input->post('ponumber'));
			$po_date = date_create_from_format('d/m/Y', $this->input->post('podate'));
			$po_date = date_format($po_date, 'Y-m-d');
			$order_accept_date = date_create_from_format('d/m/Y', $this->input->post('order_accept_date'));
			$order_accept_date = date_format($order_accept_date, 'Y-m-d');
			$order_accept_no = StringRepair($this->input->post('order_accept_no'));
			$quotationid = StringRepair($this->input->post('quotationid'));
			$status = StringRepair($this->input->post('status'));
			$id = $this->input->post('id');
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {
				$form_data = array(
					'fin_id' => $fin_id,
					'order_date' => $order_date,
					'customerid' => $customerid,
					'ponumber' => $ponumber,
					'po_date' => $po_date,
					'status' => $status,
					'order_accept_date'	=> $order_accept_date,
					'order_accept_no' => $order_accept_no,
					'quotationid' => $quotationid,
					'note'	=> $note,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_ORDER, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Order Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Order');
				endif;
				$pid = $id;
			} else {
				$form_data = array(
					'fin_id' => $fin_id,
					'order_date' => $order_date,
					'customerid' => $customerid,
					'ponumber' => $ponumber,
					'po_date' => $po_date,
					'status' => $status,
					'order_accept_date'	=> $order_accept_date,
					'order_accept_no' => $order_accept_no,
					'quotationid' => $quotationid,
					'note'	=> $note,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_ORDER, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Order Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Order');
				endif;
				$pid = $this->db->insert_id();

				$orderno = "ORD" . sprintf('%03d', $pid);
				$orderdata = array('orderno' => $orderno);
				$this->Queries->updateorderno(TBL_ORDER, $orderdata, $pid);
			}
		}
		return redirect('Order/add/' . $pid);
	}
	/************************************** Save Order Item **************************************************/
	public function SingleItem($orderid, $id)
	{
		$res = 0;
		if ($id != "" && $id != 0) {
			$query = "select id,orderid,item_unit,item_id,delivery_date,qty,amount,total from " . TBL_ORDER_SUB . " where isdelete=0 and orderid=$orderid and id=" . $id;
			$res = $this->Queries->getSingleRecord($query);
			$temp = date_create_from_format('Y-m-d', $res->delivery_date);
			$res->delivery_date = date_format($temp, 'd/m/Y');
		}
		echo json_encode($res);
	}
	/************************************** Save Order Item **************************************************/
	public function saveItem()
	{

		$html = "";
		$arr = array();
		$arr['status'] = 0;
		$description = "";
		$this->form_validation->set_rules('unique_no', 'unique_no', 'required');
		if ($this->form_validation->run()) {
			$subid = StringRepair($this->input->post('subid'));
			$fin_id = $this->session->userdata['financial_year']['id'];
			$delivery_date = date_create_from_format('d/m/Y', $this->input->post('delivery_date'));
			$delivery_date = date_format($delivery_date, 'Y-m-d');
			$orderid = StringRepair($this->input->post('orderid'));
			$item_id = StringRepair($this->input->post('unique_no'));
			$qty = StringRepair($this->input->post('qty'));
			$amount = StringRepair($this->input->post('amount'));
			// $cgst = StringRepair($this->input->post('cgst'));
			// $sgst = StringRepair($this->input->post('sgst'));
			// $igst = StringRepair($this->input->post('igst'));
			$total = StringRepair($this->input->post('total'));
			$item_unit = StringRepair($this->input->post('item_unit'));

			$today = date('Y-m-d H:i:s');

			if ($subid != 0 && $subid != "") {
				$form_data = array(
					'delivery_date' => $delivery_date,
					'item_id' => $item_id,
					'item_unit' => $item_unit,
					'qty' => $qty,
					'amount' => $amount,
					'total' => $total
				);
				if ($this->Queries->updateRecord(TBL_ORDER_SUB, $form_data, $subid)) :
					$arr['status'] = 2;
				endif;

				$res = $this->Queries->getSingleRecord('select sum(total) as total from ' . TBL_ORDER_SUB . " where isdelete=0  and orderid=" . $orderid);
				$arr['total'] = $res->total;

				$result = $this->Queries->getSingleRecord('select * from ' . TBL_CUSTOMER_ITEM . ' where isdelete=0 and id=' . $item_id);
				$delivery_date = date_create_from_format('Y-m-d', $delivery_date);
				$delivery_date = date_format($delivery_date, 'd/m/Y');
				//<td>".$discount."</td>
				$html .= "
                        <td>" . $result->item_name ." ( ".$result->unique_no." )". "</td>
						<td>" . $delivery_date . "</td>
						<td class='text-right'>" . $qty . ' ' . $item_unit . "</td>
						<td class='text-right'>" . number_format($amount, 4) . "</td>
						<td class='text-right'>" . number_format($total, 2) . "</td>
						<td>
						<div class=btn-group><a href='javascript:void(0)' class='btn btn-warning btn-xs  edittr' data-id='" . $subid . "'><span class='fa fa-edit'></span></a>
							</div>
							<div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='" . $subid . "'><span class='fa fa-minus'></span></a>
							</div>
						</td>	
				";
			} else {
				$form_data = array(
					'fin_id' => $fin_id,
					'orderid' => $orderid,
					'item_unit' => $item_unit,
					'delivery_date' => $delivery_date,
					'item_id' => $item_id,
					'qty' => $qty,
					'amount' => $amount,
					'total' => $total,
				);
				if ($this->Queries->addRecord(TBL_ORDER_SUB, $form_data)) :
					$arr['status'] = 1;
				endif;
				$id = $this->db->insert_id();
				$num = $this->Queries->getSingleRecord('select * from ' . TBL_CUSTOMER_ITEM . ' where isdelete=0 and id=' . $item_id);
				$res = $this->Queries->getSingleRecord('select sum(total) as total from ' . TBL_ORDER_SUB . " where isdelete=0  and orderid=" . $orderid);
				$arr['total'] = $res->total;

				$delivery_date = date_create_from_format('Y-m-d', $delivery_date);
				$delivery_date = date_format($delivery_date, 'd/m/Y');
				//<td>".$discount."</td>
				$html .= "
				        <tr id='item_tr_" . $id . "'>
                        <td>" . $num->item_name ." ( ".$num->unique_no." )" . "</td>
						<td>" . $delivery_date . "</td>
						<td class='text-right'>" . $qty . ' ' . $item_unit . "</td>
						<td class='text-right'>" . number_format($amount, 4) . "</td>
						<td class='text-right'>" . number_format($total, 2) . "</td>
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
			$this->Queries->updateRecord(TBL_ORDER, $form_data, $orderid);
			$arr['html'] = $html;
		}
		echo json_encode($arr);
	}
	/*********************************** Delete Item from Order *****************************************/
	public function deleteItem()
	{
		$html = "";
		$arr = array();
		$arr['status'] = 0;
		$this->form_validation->set_rules('id', 'id', 'required');
		if ($this->form_validation->run()) {
			$id = StringRepair($this->input->post('id'));
			$orderid = StringRepair($this->input->post('orderid'));
			$cgst = StringRepair($this->input->post('cgst'));
			$sgst = StringRepair($this->input->post('sgst'));
			$igst = StringRepair($this->input->post('igst'));
			$freight = StringRepair($this->input->post('freight'));
			$today = date('Y-m-d H:i:s');

			$form_data = array(
				'isdelete' => 1,
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);
			if ($this->Queries->updateRecord(TBL_ORDER_SUB, $form_data, $id)) :
				$arr['status'] = 1;
			endif;
			$res = $this->Queries->getSingleRecord('select sum(total) as total from ' . TBL_ORDER_SUB . " where isdelete=0  and orderid=" . $orderid);
			$result = $this->Queries->getSingleRecord('select freight from ' . TBL_ORDER . " where isdelete=0  and id=" . $orderid);

			$arr['total'] = 0 + $res->total;
			$arr['cgst'] = ($arr['total'] * $cgst) / 100;
			$arr['sgst'] = ($arr['total'] * $sgst) / 100;
			$arr['igst'] = ($arr['total'] * $igst) / 100;
			$arr['freight'] = $freight;
			$arr['grand_item_total'] = $arr['total'] + $arr['cgst'] + $arr['sgst'] + $arr['igst'] + $arr['freight'];
			$form_data = array(
				'total' => $arr['total'],
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);
			$this->Queries->updateRecord(TBL_ORDER, $form_data, $orderid);
		}
		echo json_encode($arr);
	}
	/*************************************************get Item Unit *************************************/
	public function getItemUnit()
	{
		$arr = array();
		$item_id = StringRepair($this->input->post('unique_no'));
		$query = "select unit_measurement from " . TBL_CUSTOMER_ITEM . " where isdelete=0 AND id=" . $item_id;
		$items = $this->Queries->getSingleRecord($query);
		$arr['item_unit'] = $items->unit_measurement;
		echo json_encode($arr);
	}
	/********************************************Order Planing ****************************************/
	public function plan($id = 0)
	{
		$fin_id = $this->session->userdata['financial_year']['id'];
		try {
			$params["id"] = $id;
			if ($id != "" and $id != 0) {

				$query = "select id,order_date,orderno,customerid,(select customer_name from " . TBL_CUSTOMER_MANAGEMENT . " where isdelete=0 AND id=t1.customerid)as customer_name from " . TBL_ORDER . " as t1 where isdelete=0 and fin_id=$fin_id and id=" . $id;
				$params["Order"] = $this->Queries->getSingleRecord($query);
				$params["Order_list"] = $this->Order_model->getsubOrderList();
				$params["Order_sub"] = $this->Order_model->getsubOrder($id);
			}
			$this->load->view('Order/plan', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}
	/******************************************** Delete Order ****************************************/
	public function delete($id)
	{
		if (!check_role_assigned('order', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_ORDER, $form_data, $id)) :
			$this->Queries->updateOrder(TBL_ORDER_SUB, $form_data, $id);
			$this->session->set_flashdata('success_msg', 'Order Deleted Successfully');
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Order');
		endif;
		return redirect('Order/');
	}
	/**************************************Print Order ************************************************/
	public function Print($id = 0)
	{
		if (!check_role_assigned('order', 'view')) {
			redirect('forbidden');
		}
		$params = array();
		$params['pdf'] = base_url() . "Order/pdf/" . $id;
		$params['customerorder'] = $this->Order_model->getSingleOrder($id);
		$params['subOrderList'] = $this->Order_model->getsubOrdersList($id);
		$this->load->view('Order/Print', $params);
	}

	public function getQuotation($id = 0)
	{
		$quotations = array('0' => '- Select -');
		if ($id != '' && $id != 0) {
			$query = 'select * from ' . TBL_QUOTATION . ' where isdelete=0 AND cid=' . $id;
			$quotations = $this->Queries->get_tab_list($query, 'id', 'quotationno');
		}
		echo dropdownbox('4', 'Quotation No', 'quotationid', $quotations, '');
	}

	public function getPendingqty()
	{
		$pono = $this->input->post('id');
		$itemdata = $this->Order_model->getSalesPenddingQty($pono);
		$html = "";

		if (count($itemdata) == 0) {
			$itemdata = $this->Order_model->getSalesPenddingQty1($pono);
		}
		foreach ($itemdata as $post) {
			if (isset($post->rsqty)) {
				$pendingqty = $post->poqty - $post->rsqty;
				$dispathcqty = $post->rsqty;
			} else {
				$pendingqty = $post->poqty;
				$dispathcqty = 0;
			}

			$html .= "<tr>
						<td class='pt5 pb5'>" . $post->item_name ." ( ".$post->unique_no." )". "</td>
						<td class='pn w100 pt5 pb5 text-right'>" . $post->poqty . ' ' . $post->item_unit . "</td>
						<td class='pn w100 pt5 pb5 text-primary text-right'>" . $dispathcqty . ' ' . $post->item_unit . "</td>
						<td class='pln pr5 w100 pt5 pb5 text-danger text-right'>" . $pendingqty . ' ' . $post->item_unit . "</td>
					</tr>";
		}
		echo $html;
	}
}
