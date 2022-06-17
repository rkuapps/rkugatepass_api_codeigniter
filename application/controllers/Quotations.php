<?php
class Quotations extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Quotation_model');
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
	}
	/********************** Display All Orders ***************************************/
	public function index()
	{
		$params = array();
		$searchtxt = array();
		$params['QuotationManagement'] = $this->Quotation_model->getQuotation($searchtxt);
		$this->load->view('Quotations/index', $params);
	}
	/************************ Add/Edit QuotationManagement View ************************/
	public  function add($id = 0)
	{
		try {
			$params["id"] = $id;
			$params["contactlist"] = array();
			$query = "select * from " . TBL_CUSTOMER_MANAGEMENT . " where isdelete=0 AND party_type=1";
			$params["customerlist"] = $this->Queries->get_tab_list($query, 'id', 'customer_name');
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('quotation', 'edit')) {
					redirect('forbidden');
				}
				$query = "select * from " . TBL_QUOTATION . " where id=" . $id;
				$params["quotation"] = $this->Queries->getSingleRecord($query);
				$params["quotationsub"] = $this->Quotation_model->getquotationsubRecord($id);
				$query = "select id,CONCAT(item_name,' (',unique_no,')') as item_name from " . TBL_CUSTOMER_ITEM . " where isdelete=0 and customerid=" . $params['quotation']->cid;
				$params["itemcategorylist"] = $this->Queries->get_tab_list($query, 'id', 'item_name');
				$query = "select id,name from " . TBL_CUSTOMER_PERSON . " where isdelete=0 and customer_id = " . $params["quotation"]->cid;
				$params["contactlist"] = $this->Queries->get_tab_list($query, 'id', 'name');
			}
			if (!check_role_assigned('quotation', 'add')) {
				redirect('forbidden');
			}
			// Generating of Quotation No.
			$finname = $this->session->userdata["financial_year"]["name"];
			$params['quotation_no'] = $finname . '/' . sprintf('%04d', 001) . " - Revision (0)";
			$query = "select * from " . TBL_QUOTATION . " where isdelete=0 ORDER BY qutid DESC LIMIT 1";
			$quotation = $this->Queries->getSingleRecord($query);
			if ($quotation != null) {
				$quot = explode('-', $quotation->quotationno);
				$qut = explode('/', $quot[1]);
				$params['quotation_no'] = $finname . '/' . sprintf('%04d', $qut[1] + 1) . " - Revision (0)";
			}
			$this->load->view('Quotations/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}

	public function addChield($id)
	{
		$params["id"] = $id;
		if ($id != "" and $id != 0) {
			if (!check_role_assigned('quotation', 'edit')) {
				redirect('forbidden');
			}
			$query = "select * from " . TBL_QUOTATION . " where id=" . $id;
			$quotation = $this->Queries->getSingleRecord($query);
			$query = "select * from " . TBL_QUOTATION_SUB . " where cid=" . $id;
			$quotationsub = $this->Queries->getRecord($query);
			$quotationno = substr($quotation->quotationno, 0, 12);
			$cid = $quotation->cid;
			$consignee = $quotation->consignee;
			$quotationm = $quotation->quotationm;
			$freight_terms = $quotation->freight_terms;
			$payment_terms = $quotation->payment_terms;
			$quotation_validity = $quotation->quotation_validity;
			$quotation_date = date('Y-m-d');
			$note = $quotation->note;
			if ($quotation->qid != null) {
				$getid = $quotation->qid;
			} else {
				$getid = $id;
			}
			$query = "select count(*) as count,qid from " . TBL_QUOTATION . " where qid=" . $getid . " ORDER BY id";
			$quotrev = $this->Queries->getSingleRecord($query);
			$today = date('Y-m-d H:i:s');
			if ($quotrev->count == 0) {
				$pid = $id;
				$quotationno .= '  Revision (1)';
			} else {
				$pid = $quotrev->qid;
				if ($quotation->qid == 0) {
					$pid = $id;
				}
				$count = $quotrev->count + 1;
				$quotationno .= "  Revision (" . $count . ")";
			}
			$quot = explode('-', $quotationno);
			$qut = explode('/', $quot[1]);
			$form_data = array(
				'quotationno' => $quotationno,
				'quotation_date' => $quotation_date,
				'cid' => $cid,
				'consignee' => $consignee,
				'qid' => $pid,
				'qutid'=>$qut[1],
				'quotationm' => $quotationm,
				'freight_terms' => $freight_terms,
				'payment_terms' => $payment_terms,
				'quotation_validity' => $quotation_validity,
				'note' => $note,
				'created_by' => $this->session->userdata['logged_in']['userid'],
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);
			if ($this->Queries->addRecord(TBL_QUOTATION, $form_data)) :
				$cid = $this->db->insert_id();
				foreach ($quotationsub as $post) {
					$item_data = array(
						'cid' => $cid,
						'subcat_id' => $post->subcat_id,
						'rate' => $post->rate,
						'moq' => $post->moq,
						'amount' => $post->amount,
					);
					$this->Queries->addRecord(TBL_QUOTATION_SUB, $item_data);
				}
				$this->session->set_flashdata('success_msg', 'Quotation Added Successfully');
			else :
				$this->session->set_flashdata('error_msg', 'Failed To Add Quotation');
			endif;
		}
		return redirect('Quotations/add/' . $cid);
	}
	/******************************************* Save Order *************************************************/

	public function save()
	{
		$quotationno = StringRepair($this->input->post('quotationno'));
		$cid = StringRepair($this->input->post('cid'));
		$consignee = StringRepair($this->input->post('consignee'));
		$quotationm = StringRepair($this->input->post('quotationm'));
		$freight_terms = StringRepair($this->input->post('freight_terms'));
		$revno = StringRepair($this->input->post('revno'));
		$payment_terms = StringRepair($this->input->post('payment_terms'));
		$quotation_validity = StringRepair($this->input->post('quotation_validity'));
		$quotation_date = date_create_from_format('d/m/Y', $this->input->post('quotation_date'));
		$quotation_date = date_format($quotation_date, 'Y-m-d');
		$note = StringRepair($this->input->post('note'));
		$id = $this->input->post('id');
		$today = date('Y-m-d H:i:s');
		$quot = explode('-', $quotationno);
		$qut = explode('/', $quot[1]);

		if ($id != 0 and $id != "") {
			$form_data = array(
				'quotationno' => $quotationno,
				'quotation_date' => $quotation_date,
				'cid' => $cid,
				'qutid'=>$qut[1],
				'consignee' => $consignee,
				'quotationm' => $quotationm,
				'freight_terms' => $freight_terms,
				'payment_terms' => $payment_terms,
				'quotation_validity' => $quotation_validity,
				'note' => $note,
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);
			if ($this->Queries->updateRecord(TBL_QUOTATION, $form_data, $id)) :
				$this->session->set_flashdata('success_msg', 'Quotation Updated Successfully');
			else :
				$this->session->set_flashdata('error_msg', 'Failed To Update Quotation');
			endif;
			$pid = $id;
		} else {
			$form_datas = array(
				'quotationno' => $quotationno,
				'quotation_date' => $quotation_date,
				'cid' => $cid,
				'qutid'=>$qut[1],
				'consignee' => $consignee,
				'quotationm' => $quotationm,
				'freight_terms' => $freight_terms,
				'payment_terms' => $payment_terms,
				'quotation_validity' => $quotation_validity,
				'note' => $note,
				'created_by' => $this->session->userdata['logged_in']['userid'],
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);
			if ($this->Queries->addRecord(TBL_QUOTATION, $form_datas)) :
				$pid = $this->db->insert_id();
				$this->session->set_flashdata('success_msg', 'Quotation Added Successfully');
			else :
				$this->session->set_flashdata('error_msg', 'Failed To Add Quotation');
			endif;
		}

		return redirect('Quotations/add/' . $pid);
	}

	public function SingleItem($orderid, $id)
	{
		$res = 0;
		if ($id != "" && $id != 0) {
			$query = "select id,cid,subcat_id,platting,moq,rate from " . TBL_QUOTATION_SUB . " where isdelete=0 and cid=$orderid and id=" . $id;
			$res = $this->Queries->getSingleRecord($query);
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
		$this->form_validation->set_rules('qid', 'qid', 'required');
		if ($this->form_validation->run()) {
			$subid = StringRepair($this->input->post('subid'));
			$cid = StringRepair($this->input->post('qid'));
			$item_id = StringRepair($this->input->post('item_id'));
			$platting = StringRepair($this->input->post('platting'));
			$rate = StringRepair($this->input->post('rate'));
			$moq = StringRepair($this->input->post('moq'));
			if ($subid != 0 && $subid != "") {
				$form_data = array(
					// 'cid'=>$cid,
					// 'subid'=>$subid,
					'subcat_id' => $item_id,
					'platting' => $platting,
					'rate' => $rate,
					'moq' => $moq
				);
				// print_r($form_data);exit;tbl_quotation_sub
				if ($this->Queries->updateRecord(TBL_QUOTATION_SUB, $form_data, $subid)) :
					$arr['status'] = 2;
				endif;

				$result = $this->Queries->getSingleRecord('select * from ' . TBL_CUSTOMER_ITEM . ' where isdelete=0 and id=' . $item_id);
				//<td>".$discount."</td>
				$html .= "
				<td>" . $result->item_name . " (" . $result->unique_no . ")</td>
				<td>" . $result->hsn_code . "</td>
					<td>" . $platting . "</td>
					<td>" . $moq . "</td>
					<td>" . sprintf("%0.2f", $rate) . "</td>
					<td>
						<div class=btn-group><a href='javascript:void(0)' class='btn btn-warning btn-xs  edittr' data-id='" . $subid . "'><span class='fa fa-edit'></span></a>
						</div>
						<div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='" . $subid . "'><span class='fa fa-minus'></span></a>
						</div>
					</td>	
				";
			} else {
				$form_data = array(
					// 'fin_id'=>$fin_id,
					'cid' => $cid,
					'platting' => $platting,
					'subcat_id' => $item_id,
					'rate' => $rate,
					'moq' => $moq
				);
				if ($this->Queries->addRecord(TBL_QUOTATION_SUB, $form_data)) :
					$arr['status'] = 1;
				endif;
				$id = $this->db->insert_id();
				$result = $this->Queries->getSingleRecord('select * from ' . TBL_CUSTOMER_ITEM . ' where isdelete=0 and id=' . $item_id);
				// echo $cid;
				// echo $this->db->last_query();

				$html .= "
				    <tr id='item_tr_" . $id . "'>
                        <td>" . $result->item_name . " (" . $result->unique_no . ")</td>
						<td>" . $result->hsn_code . "</td>
						<td>" . $platting . "</td>
						<td>" . $moq . "</td>
						<td>" . $rate . "</td>
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
			// 		$form_data = array(
			// 	'total' => $arr['total'],
			// 	'updated_by' => $this->session->userdata['logged_in']['userid'],
			// 	'updated_on' => $today
			// );
			// $this->Queries->updateRecord(TBL_ORDER, $form_data, $orderid);
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
			// $orderid = StringRepair($this->input->post('orderid'));
			// $cgst = StringRepair($this->input->post('cgst'));
			// $sgst = StringRepair($this->input->post('sgst'));
			// $igst = StringRepair($this->input->post('igst'));
			// $freight= StringRepair($this->input->post('freight'));
			$today = date('Y-m-d H:i:s');
			$form_data = array(
				'isdelete' => 1,
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);
			if ($this->Queries->updateRecord(TBL_QUOTATION_SUB, $form_data, $id)) :
				$arr['status'] = 1;
			endif;
		}
		echo json_encode($arr);
	}
	/******************************************** Delete Order ****************************************/
	public function delete($id)
	{
		if (!check_role_assigned('quotation', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_QUOTATION, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Quotation Deleted Successfully');
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Quotation');
		endif;
		return redirect('Quotations/');
	}
	/**************************************Print Quotation ************************************************/
	public function Print($id = 0)
	{
		if (!check_role_assigned('quotation', 'view')) {
			redirect('forbidden');
		}
		$params = array();
		$params["id"] = $id;
		$params['customerorder'] = $this->Quotation_model->getSingleQuotation($id);
		$params['subOrderList'] = $this->Quotation_model->getquotationsubRecord($id);
		$this->load->view('Quotations/Print', $params);
	}
	public function Pdf($id = 0)
	{
		if (!check_role_assigned('quotation', 'view')) {
			redirect('forbidden');
		}
		ini_set('max_execution_time', '0'); 
		$params = array();
		$params['customerorder'] = $this->Quotation_model->getSingleQuotation($id);
		$params['subOrderList'] = $this->Quotation_model->getquotationsubRecord($id);
		//$this->load->view('Quotations/Pdf', $params);
		$filename = "Q_".str_replace("/","_",$params['customerorder']->quotationno);

		// For Using Mpdf

		// $config['composer_autoload'] = 'vendor/autoload.php';

		// $mpdf = new \Mpdf\Mpdf();
        // $html = $this->load->view('Quotations/Pdf', $params,true);
        // $mpdf->WriteHTML($html);
        // $mpdf->Output();

		// For Using Dompdf

		$this->load->library('Pdf');
		$html = $this->load->view('Quotations/Pdf', $params, true);
		$filename = "Q_".str_replace("/","_",$params['customerorder']->quotationno);
		$this->pdf->create($html, $filename);
		$attachment = 'uploads/' . $filename . ".pdf";
	}
}