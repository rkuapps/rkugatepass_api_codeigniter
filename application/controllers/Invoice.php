<?php
class Invoice extends CI_Controller
{

	public function __construct()
	{
	parent::__construct();
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	$this->load->model('Invoice_model','Invoice');
	$this->load->model('Order_model','Order');
	}
	public function index()
	{
		if (!check_role_assigned('invoice', 'view')) {
			redirect('forbidden');
		}
		$params = array();
		$params['Invoice'] = $this->Invoice->getInvoice();
		$this->load->view('Invoice/index', $params);
	}

	public  function add($id = 0)
	{
	try {
		$params["id"]=$id;
		if ($id != "" and $id != 0) {
			if (!check_role_assigned('invoice', 'edit')) {
				redirect('forbidden');
			}
			$query= "select * from " .TBL_INVOICE. " where isdelete=0 and id=" . $id;	
			$params['details']=$this->Queries->getSingleRecord($query);
			$query = "select id,CONCAT(orderno,' (',ponumber,')') as item_name from " . TBL_ORDER . " where isdelete=0 and customerid=" . $params["details"]->customer_id;
			$params["orderlist"] = $this->Queries->get_tab_list($query,'id','item_name');
			$res=$this->Queries->getSingleRecord('select sum(amount) as total from '.TBL_INVOICE_SUB." where isdelete=0  and invoiceid=".$id);
			$params['item_total_amount']=$res->total;
			$params["invoicesublist"] = $this->Invoice->getInvoiceSublistRecord($id);
		}
		$query = "select * from " . TBL_ORDER . " where isdelete=0";
		$params["Order"] = $this->Queries->get_tab_list($query,'id','orderno');
		$query="select * from ".TBL_CUSTOMER_MANAGEMENT." where isdelete=0 AND party_type=1";
		$params['customerlist']=$this->Queries->get_tab_list($query,'id','customer_name');

		// Generating of Invoice No.
		$finname = $this->session->userdata["financial_year"]["name"];
		$params['invoiceno']=$finname.'/'.sprintf('%04d',1);

		$query="select * from ". TBL_INVOICE. " where isdelete=0 ORDER BY id DESC LIMIT 1";
		$po=$this->Queries->getSingleRecord($query);
		if(count($po)>0)
		{
			$pod=explode('/',$po->invoiceno);
			$params['invoiceno']=$finname.'/'.sprintf('%04d',$pod[1]+1);
		}

		$this->load->view('Invoice/add',$params);
	}	
	catch (Exception $e)
	{
			echo $e;
		}
	}
public function save()
{
	$fin_id=$this->session->userdata['financial_year']['id'];
	$invoice_date = date_create_from_format('d/m/Y',$this->input->post('invoice_date'));
	$invoice_date=date_format($invoice_date,'Y-m-d');
	$invoiceno = StringRepair($this->input->post('invoiceno'));
	$lr_number = StringRepair($this->input->post('lr_number'));
	$tcs=StringRepair($this->input->post('tcs'));
	$po_number=StringRepair($this->input->post('po_number'));
	$dispatched_by = StringRepair($this->input->post('dispatched_by'));
	$description = StringRepair($this->input->post('description'));
	$payment = StringRepair($this->input->post('payment'));
	$freight=StringRepair($this->input->post('freight'));
	$bags=StringRepair($this->input->post('bags'));
	$cgst=StringRepair($this->input->post('cgst'));
	$sgst=StringRepair($this->input->post('sgst'));
	$igst=StringRepair($this->input->post('igst'));
	$place_supply=StringRepair($this->input->post('place_supply'));
	$customer_id=StringRepair($this->input->post('customerid'));
	$oderid=implode(',',$this->input->post('customer_order'));
	if($invoice_date=='')
	{
		$invoice_date=date('Y-m-d');
	}
	$id=$this->input->post('id');
	if ($id != 0 and $id != "") {
		$form_data = array(
			'invoiceno'=>$invoiceno,
			'invoice_date'=>$invoice_date,
			'customer_id'=>$customer_id,
			'oderid'=>$oderid,
			'tcs'=>$tcs,
			'bags'=>$bags,
			'sgst'=>$sgst,
			'cgst'=>$cgst,
			'igst'=>$igst,
			'po_number'=>$po_number,
			'lr_number' => $lr_number,
			'description'=>$description,
			'dispatched_by'=>$dispatched_by,
			'payment'=>$payment,
			'fright_amount'=>$freight,
			'place_supply'=>$place_supply
		);
	if ($this->Queries->updateRecord(TBL_INVOICE, $form_data, $id)) :
		$pid=$id;
		$this->session->set_flashdata('success_msg', 'Invoice Updated Successfully');
	else :
		$this->session->set_flashdata('error_msg', 'Failed To Update Invoice');
	endif;
	}else {
		$form_data = array(
			'invoiceno'=>$invoiceno,
			'invoice_date'=>$invoice_date,
			'customer_id'=>$customer_id,
			'oderid'=>$oderid,
			'fin_id'=>$fin_id,
			'lr_number' => $lr_number,
			'tcs'=>$tcs,
			'bags'=>$bags,
			'sgst'=>$sgst,
			'cgst'=>$cgst,
			'igst'=>$igst,
			'po_number'=>$po_number,
			'description'=>$description,
			'dispatched_by'=>$dispatched_by,
			'payment'=>$payment,
			'fright_amount'=>$freight,
			'place_supply'=>$place_supply
		);
		if ($this->Queries->addRecord(TBL_INVOICE, $form_data)) :
			$pid = $this->db->insert_id();
			$this->session->set_flashdata('success_msg', 'invoice Added Successfully');
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Add invoice');
		endif;
	}
		return redirect('Invoice/add/'.$pid);
	}

	public function savePostInvoice()
	{
		$this->form_validation->set_rules('dbk_amount', 'DBK Amount', 'required');
		if ($this->form_validation->run()) {
			$shipping_bill_date = date_create_from_format('d/m/Y',$this->input->post('shipping_bill_date'));
			$shipping_bill_date=date_format($shipping_bill_date,'Y-m-d');
			$dbk_amount = StringRepair($this->input->post('dbk_amount'));
			$custom_exchange_rate = StringRepair($this->input->post('custom_exchange_rate'));
			$shipping_bill_no = StringRepair($this->input->post('shipping_bill_no'));
			$flight_no = StringRepair($this->input->post('flight_no'));
			$vessel_no = StringRepair($this->input->post('vessel_no'));
			$bl_no = StringRepair($this->input->post('bl_no'));
			$id = $this->input->post('id');
			$today = date('Y-m-d H:i:s');
			$iseditable=0;
			if(trim($shipping_bill_no)!="" && trim($bl_no)!="")
			{
				$iseditable=1;
			}
			if ($id != 0 and $id != "") {
				$form_data = array(
					'shipping_bill_date'=>$shipping_bill_date,
					'dbk_amount'=>$dbk_amount,
					'shipping_bill_no'=>$shipping_bill_no,
					'custom_exchange_rate'=>$custom_exchange_rate,
					'flight_no'=>$flight_no,
					'vessel_no'=>$vessel_no,
					'bl_no'=>$bl_no,
					'iseditable'=>$iseditable,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_INVOICE, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Invoice Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Order');
				endif;
				$query = "select packingid from " . TBL_INVOICE . " where isdelete=0 and id=" . $id;
				$res = $this->Queries->getSingleRecord($query);
				
			} 
		}
		return redirect('Invoice/PostInvoice/'.$id);	
	}
	public function SingleItem($id)
	{
		$res=0;
		if($id!="" && $id!=0){
			$query="select * from ".TBL_INVOICE_SUB." where isdelete=0 and id=".$id;
			$res=$this->Queries->getSingleRecord($query);
			$temp=date_create_from_format('Y-m-d',$res->delivery_date);
			$res->delivery_date=date_format($temp,'d/m/Y');		
		}
	echo json_encode($res);
	}

	public function saveItem()
	{
	
		$html="";
		$arr=array();
		$arr['status']=0;
		$description="";
		$this->form_validation->set_rules('item_id', 'Item Name', 'required');
		if ($this->form_validation->run()) {
			$subid=StringRepair($this->input->post('subid'));
			$fin_id=$this->session->userdata['financial_year']['id'];
			$orderid = StringRepair($this->input->post('orderid'));
			$invoiceid=StringRepair($this->input->post('invoiceid'));
			$item_id = StringRepair($this->input->post('item_id'));
			$qty = StringRepair($this->input->post('qty'));
			$weight = StringRepair($this->input->post('weight'));
			$amount = StringRepair($this->input->post('amount'));
			$rate_type=StringRepair($this->input->post('rate_type'));
			$total = StringRepair($this->input->post('total'));
			$ratype = "/pcs";
			if($rate_type == 1){
				$amount = sprintf("%.2f",$amount);
				$ratype = "/Kg";
			}

			if($subid!=0 && $subid!="")
			{
				$form_data=array(
				'orderid'=>$orderid,
				'item_id'=>$item_id,
				'qty'=>$qty,
				'weight'=>$weight,
				'rate_type'=>$rate_type,
				'rate'=>$amount,
				'amount'=>$total,
			);
				if ($this->Queries->updateRecord(TBL_INVOICE_SUB, $form_data,$subid)) :
				$arr['status']=2;
				endif;

				$res=$this->Queries->getSingleRecord('select sum(amount) as total from '.TBL_INVOICE_SUB." where isdelete=0  and invoiceid=".$invoiceid);
				$arr['total']=$res->total;
				$result=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER_ITEM.' where isdelete=0 and id='.$item_id);

				$html.="
                        <td>".$result->item_name." (".$result->unique_no.")</td>
						<td>".$result->hsn_code."</td>
						<td>".$weight."</td>
						<td>".$qty."</td>
						<td>".$amount.$ratype."</td>
						<td>".$total."</td>
						<td>
						    <div class=btn-group><a href='javascript:void(0)' class='btn btn-warning btn-xs  edittr' data-id='".$subid."'><span class='fa fa-edit'></span></a>
							</div>
							<div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='".$subid."'><span class='fa fa-minus'></span></a>
							</div>
						</td>	
				";

			}else{
			$form_data=array(
			'invoiceid'=>$invoiceid,
			'item_id'=>$item_id,
			'orderid'=>$orderid,
			'rate_type'=>$rate_type,
			'qty'=>$qty,
			'weight'=>$weight,
			'rate'=>$amount,
			'amount'=>$total,
			);
				if ($this->Queries->addRecord(TBL_INVOICE_SUB, $form_data)) :
				$arr['status']=1;
				endif;
				$id=$this->db->insert_id();
				$num=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER_ITEM.' where isdelete=0 and id='.$item_id);
				
				$res=$this->Queries->getSingleRecord('select sum(amount) as total from '.TBL_INVOICE_SUB." where isdelete=0  and invoiceid=".$orderid);
				$arr['total']=$res->total;
		
				$html.="
				        <tr id='item_tr_".$id."'>
                        <td>".$num->item_name." (".$num->unique_no.")</td>
						<td>".$num->hsn_code."</td>
						<td>".$weight."</td>
						<td>".$qty."</td>
						<td>".$amount.$ratype."</td>
						<td>".$total."</td>
						
                        <td>
							<div class=btn-group><a href='javascript:void(0)' class='btn btn-warning btn-xs  edittr' data-id='".$id."'><span class='fa fa-edit'></span></a>
							</div>
							<div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='".$id."'><span class='fa fa-minus'></span></a>
							</div>
						</td>
                        </td>
                    </tr>
				";
		
			}
					$arr['html']=$html;
		}

		echo json_encode($arr);
	}


public function deleteItem()
{
	if (!check_role_assigned('invoice', 'delete')) {
		redirect('forbidden');
	}
		$html="";
		$arr=array();
		$arr['status']=0;
		$this->form_validation->set_rules('id', 'id', 'required');
		if ($this->form_validation->run()) {
			$id = StringRepair($this->input->post('id'));
					$today = date('Y-m-d H:i:s');
			$invoiceid = StringRepair($this->input->post('orderid'));
			$form_data = array(
				'isdelete' => 1,
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);
			if ($this->Queries->updateRecord(TBL_INVOICE_SUB, $form_data, $id)) :
			$res=$this->Queries->getSingleRecord('select sum(amount) as total from '.TBL_INVOICE_SUB." where isdelete=0  and invoiceid=".$invoiceid);
			$arr['total']=$res->total;
			$arr['status']=1;
			endif;			
			
			$arr['total']=0+$res->total; 
			$arr['cgst']=($arr['total']*$cgst)/100;
			$arr['sgst']=($arr['total']*$sgst)/100;
			$arr['igst']=($arr['total']*$igst)/100;
			$arr['freight']=$freight;
			$arr['grand_item_total']=$arr['total']+$arr['cgst']+$arr['sgst']+$arr['igst']+$arr['freight'];
			$form_data = array(
			'total' => $arr['total'],
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		$this->Queries->updateRecord(TBL_ORDER, $form_data, $orderid);

		}

		echo json_encode($arr);
	}

/******************************************** Delete Order ****************************************/	
	public function delete($id)
	{
		if (!check_role_assigned('invoice', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_INVOICE, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Invoice Deleted Successfully');
			$this->Queries->updateSpecialRecord(TBL_INVOICE_SUB,$form_data,'invoiceid',$id);
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Order');
		endif;
		return redirect('Invoice/');
	}


	public function Print($id=0)
	{
	if (!check_role_assigned('invoice', 'view')) {
	redirect('forbidden');
	}
	$params = array();
	$params['invoiceprint'] = $this->Invoice->getInvoicePrint($id);
	$params['itemPrint'] = $this->Invoice->getitemPrint($id);
	
	$this->load->view('Invoice/Print', $params);
	}

	public function getItem($id)
	{
		if($id!='' && $id!=0)
		{
			$item_id=$this->input->post('itemid');
			$itemid='';
			$query='select item_id from '.TBL_ORDER_SUB.' where isdelete=0 AND orderid='.$id;
			$orderdata=$this->Queries->getRecord($query);
			foreach($orderdata as $data)
			{
				$itemid.=$data->item_id.',';
			}
			$itemid.=0;
			$query="select id,CONCAT(item_name,' (',unique_no,')') as item_name from ".TBL_CUSTOMER_ITEM." where isdelete=0 AND id IN (".$itemid.")";
			$itemlist=$this->Queries->get_tab_list($query,'id','item_name');
			echo dropdownbox('4','Item Name','item_id', $itemlist,$item_id, 'required');
		}
	}
}
