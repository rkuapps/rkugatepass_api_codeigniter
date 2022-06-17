<?php
class Packing extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
        $this->load->model('Inventory_model');
        $this->load->model('Packing_model');
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
		
    }

    /************************************** Display All Packing List **************************************/
    public function index()
	{
		$params = array();
		$searchtxt = array();
		$params['packinglist'] = $this->Packing_model->getPackinglist($searchtxt);
		$params['packingsublist']=$this->Packing_model->getPackingSub();
		$this->load->view('Packing/index',$params);
    }
    
    /***************************************** Add/Edit Packing Details View ***********************************/
	public  function add($id = 0)
	{
		$fin_id=$this->session->userdata['financial_year']['id'];
		
				
		try {
            $params["id"]=$id;
			$currentdate=date("dmY");
		
			$params['packing_no']=$currentdate;
			//echo $params['packing_no'];
			$query="select * from ".TBL_PACKING." where isdelete=0 ORDER BY id DESC LIMIT 1";
			$checkpacking=$this->Queries->getSingleRecord($query);
			//print_r($checkpacking);
			$packingno_array=explode('-',$checkpacking->packingno);
			if(in_array($currentdate,$packingno_array))
			{
				$i=$packingno_array[1]+1;
				$params['packing_no']=$currentdate.'-'.$i;
			}
			else{
				$i=1;
				$params['packing_no']=$currentdate.'-'.$i;
			}
			//print_r($packingno_array);
			//exit;
			
			
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('packing', 'edit')) {
					redirect('forbidden');
				}

             $query="select * from ".TBL_PACKING." where isdelete=0 and id=".$id;
			$params['PackingList']=$this->Queries->getSingleRecord($query);	
				$query="select * from ".TBL_ORDER." where isdelete=0 and customerid=".$params['PackingList']->customer_id;
			$params['orderlist']=$this->Queries->get_tab_list($query,'id','orderno');
			
			
			}else{
				$params['orderlist']="";
				
			}
			if (!check_role_assigned('packing_list', 'add')) {
				redirect('forbidden');
			}

			
			$query="select * from ".TBL_CUSTOMER_MANAGEMENT." where isdelete=0 AND (party_type=0 or party_type=2)";
			$params['customerlist']=$this->Queries->get_tab_list($query,'id','customer_name');
			
			// $query="select * from ".TBL_PORT_MASTER." where isdelete=0";
			// $params['portofloadinglist']=$this->Queries->get_tab_list($query,'id','port_name');
			


			$this->load->view('Packing/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}
	/****************************************** Multiple Order Select Dropdown ************************************/
public function GetCustomerFields($id=0)
  { 
	  $arr=array();
	  $orderlist="";
	  
	if($id!=0 && $id!='')
	{
		$query="select * from ".TBL_ORDER." where isdelete=0 and customerid=".$id;
		 $orderlist=$this->Queries->get_tab_list($query,'id','orderno');
    	   
	}
	ob_start();
	multidropdownbox('12','Customer Orders','customer_order[]',$orderlist,'','required');
	$output = ob_get_clean();
    $arr['order']=$output;
	$output="";
	echo json_encode($arr);
  }
  /*************************************************** Save Packing Details ***************************************/
  public function save()
	{
		
	
	
		$this->form_validation->set_rules('packing_date', 'PackingList Date', 'required');
		$this->form_validation->set_rules('packing_no', 'Packing List No.', 'required');
		if ($this->form_validation->run()) {
			
			$fin_id=$this->session->userdata['financial_year']['id'];
			$packing_date = date_create_from_format('d/m/Y',$this->input->post('packing_date'));
			$packing_date = date_format($packing_date,'Y-m-d');
			$packing_no = StringRepair($this->input->post('packing_no'));
			$customerid = StringRepair($this->input->post('customerid'));
			
			$customer_order= implode(',',$this->input->post('customer_order'));
			$totalcartoon = StringRepair($this->input->post('totalcartoon'));
			$id = $this->input->post('id');
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {

				$form_data = array(
					'fin_id'=>$fin_id,
                    'customer_id'=>$customerid,
                    'packing_date' => $packing_date,
					'packingno'=>$packing_no,					
                    'total_cartoon'=>$totalcartoon,
                    'customer_order'=>$customer_order,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_PACKING, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'PackingList Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update PackingList');
				endif;
				$pid=$id;

			} else {
				
				
				$form_data = array(
                    'fin_id'=>$fin_id,
                    'customer_id'=>$customerid,
                    'packing_date' => $packing_date,
					'packingno'=>$packing_no,					
                    'total_cartoon'=>$totalcartoon,
                    'customer_order'=>$customer_order,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_PACKING, $form_data)) :
					$this->session->set_flashdata('success_msg', 'PackingList Added Successfully');
					
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add PackingList');
					
				endif;
				$pid=$this->db->insert_id();
				
				
			}
			
		}
		
		return redirect('Packing/addPackinglist/'.$pid);
	}
	/************************************** Add/Edit Packinglist View ***********************************/
    public  function addPackinglist($id = 0)
	{
	
		try {
            
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('packing_list', 'edit')) {
					redirect('forbidden');
				}
				$params["id"]=$id;
				
				$res=$this->Packing_model->getSinglePacklist($id);
				$params['singlepackinglist']=$res;
                

            $query="select * from ".TBL_ORDER." where isdelete=0 and id in (".$res->customer_order.") group by id";
            $params['orderlist']=$this->Queries->get_tab_list($query,'id','orderno');
			$arr=array();
			
			$query="select id,case_no_from,case_no_to,orderid,item_id,(select net_weight from ".TBL_CUSTOMER_ITEM." where isdelete=0 AND id=t1.item_id) as net_weight,(select unique_no from ".TBL_CUSTOMER_ITEM." where isdelete=0 AND id=t1.item_id) as unique_no,pcs,box_weight,total_weight from " . TBL_PACKING_SUB . " as t1 where isdelete=0 and packingid=" .$id;
			$params['packingsublist']=$this->Queries->getRecord($query);
			
			$params['itemlist']=array('0'=>'- Select -');
			//$params['packingsublist']=$this->Packing_model->getPackingSubList($id);
           // $params['packingsublist']=$this->PackingList->getPackingSubList($id);
            
            }
			    $this->load->view('Packing/addPackinglist',$params);
		} catch (Exception $e) {
			echo $e;
		}
	}
	/***************************************** Select Single Item *****************************************/
	public function SingleItem($packingid,$id)
	{
		$res=0;
		if($id!="" && $id!=0){
			$query="select id,packingid,orderid,item_id,case_no_from,case_no_to,pcs,box_weight,total_weight,calculate_weight from ".TBL_PACKING_SUB." where isdelete=0 and id=".$id;
				$res=$this->Queries->getSingleRecord($query);
			
		}
	echo json_encode($res);
	}
	public function getItem($id)
	{
		$itemlist=array('0'=>'- Select -');
		if($id!="" && $id!=0){
				$itemlist=$this->Packing_model->getItemUsingOrderNo($id);
		}
	echo dropdownbox('3','Select Item','item_id',$itemlist,'','required onChange="javascript:getnetweight(this.value)"');
	}

	public function getWeight()
	{
		$id=StringRepair($this->input->post('id'));
		if($id!="" && $id!=0){
				$query="select net_weight from ".TBL_CUSTOMER_ITEM." where isdelete=0 and id=".$id;
				$res=$this->Queries->getSingleRecord($query);
				$itemweight=$res->net_weight;
		}
	echo json_encode($itemweight);
	}

	/******************************************** Save Packing List Details *************************************/
	public function saveItem()
	{
	
		$html="";
		$arr=array();
		$arr['status']=0;
		$description="";
		$this->form_validation->set_rules('casefrom', 'casefrom', 'required');
		if ($this->form_validation->run()) {
			

			$subid=StringRepair($this->input->post('subid'));
			$fin_id=$this->session->userdata['financial_year']['id'];
			$casefrom =StringRepair($this->input->post('casefrom'));
			$caseto =StringRepair($this->input->post('caseto'));
			$orderid=StringRepair($this->input->post('orderid'));
			$packingid = StringRepair($this->input->post('packingid'));
			$item_id = StringRepair($this->input->post('item_id'));
			$pcs = StringRepair($this->input->post('pcs'));
			$weight = StringRepair($this->input->post('weight'));
			$noctn=$caseto-$casefrom+1;
			$totalweight=StringRepair($this->input->post('totalweight'));
			$actualweight=StringRepair($this->input->post('totalweights'));
			
			
			

			if($subid!=0 && $subid!="")
			{
				$res=$this->Queries->getSingleRecord("select * from ".TBL_PACKING_SUB." where isdelete=0 and packingid = $packingid AND id!=$subid  and case_no_from=$casefrom and case_no_to=$caseto and total_case>1 order by case_no_to");
				if($res==null)
				{
				$form_data=array(
				'packingid'=>$packingid,
				'case_no_from'=>$casefrom,
				'case_no_to'=>$caseto,
				'orderid'=>$orderid,
				'item_id'=>$item_id,
				'pcs'=>$pcs,
				'total_case'=>$noctn,
				'box_weight'=>$weight,
				'total_weight'=> $totalweight,
				'calculate_weight'=>$actualweight
			
			
			);
				if ($this->Queries->updateRecord(TBL_PACKING_SUB, $form_data,$subid)) :
				$arr['status']=2;
				endif;

				 
				$result=$this->Queries->getSingleRecord('select unique_no,net_weight from '.TBL_CUSTOMER_ITEM.' where isdelete=0 and id='.$item_id);
				$total_box_weight=$weight*$noctn;
				$gross_weight=sprintf("%0.3f",($result->net_weight * $noctn * $pcs)/1000);
				$total_weight= $gross_weight + $total_box_weight;
				//<td>".$discount."</td>
				$html.="
                        <td>".$casefrom."</td>
						<td>".$caseto."</td>
						<td>".$result->unique_no."</td>
						<td>".$noctn."</td>
						<td>".$total_box_weight."</td>
						<td>".$gross_weight."</td>
						<td>".$totalweight."</td>
						<td>
						      <div class=btn-group><a href='javascript:void(0)' class='btn btn-info btn-xs  edittr' data-id='".$subid."'><span class='fa fa-pencil'></span></a>
                                                                    </div>
                                                                    <div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='".$subid."'><span class='fa fa-minus'></span></a>
                                                                    </div>
						</td>	
				";
			}else
			{
				$arr['msg']="Enter Valid Carton Range";
			}
			}
			else{
				
				$res=$this->Queries->getSingleRecord("select * from ".TBL_PACKING_SUB." where isdelete=0 AND packingid = $packingid and case_no_to >=$casefrom and total_case>1 order by case_no_to");
				if($res==null )
				{
			$form_data=array(
			
				'packingid'=>$packingid,
				'case_no_from'=>$casefrom,
				'case_no_to'=>$caseto,
				'orderid'=>$orderid,
				'item_id'=>$item_id,
				'pcs'=>$pcs,
				'total_case'=>$noctn,
				'box_weight'=>$weight,
				'total_weight'=> $totalweight,
				'calculate_weight'=>$actualweight
			);
				if ($this->Queries->addRecord(TBL_PACKING_SUB, $form_data)) :
				$arr['status']=1;
				endif;
				$id=$this->db->insert_id();
				$num=$this->Queries->getSingleRecord('select unique_no,net_weight from '.TBL_CUSTOMER_ITEM.' where isdelete=0 and id='.$item_id);
				$total_box_weight=$weight*$noctn;
				$gross_weight=sprintf("%0.3f",($num->net_weight * $noctn * $pcs)/1000);
				$total_weight= $total_box_weight + $gross_weight;

				
				//<td>".$discount."</td>
				$html.="
				        <tr id='item_tr_".$id."'>
                        <td>".$casefrom."</td>
						<td>".$caseto."</td>
						<td>".$num->unique_no."</td>
						<td>".$noctn."</td>
						<td>".$total_box_weight."</td>
						<td>".$gross_weight."</td>
						<td>".$totalweight."</td>
                        <td>
						      <div class=btn-group><a href='javascript:void(0)' class='btn btn-info btn-xs  edittr' data-id='".$id."'><span class='fa fa-pencil'></span></a>
                                                                    </div>
                                                                    <div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='".$id."'><span class='fa fa-minus'></span></a>
                                                                    </div>
						</td>
                        </td>
                    </tr>
				";
			}else
			{
				$arr['msg']="Enter Valid Carton Range";
			}
			}
			$arr['html']=$html;			}

		echo json_encode($arr);
	}
	/*********************************************** Delete Item In Packing List ******************************************/
	public function deleteItem()
	{$html="";
		$arr=array();
		$arr['status']=0;

		$this->form_validation->set_rules('id', 'id', 'required');
		if ($this->form_validation->run()) {
			$id = StringRepair($this->input->post('id'));
			$packingid = StringRepair($this->input->post('packingid'));
					$today = date('Y-m-d H:i:s');
			
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_PACKING_SUB, $form_data, $id)) :
			$arr['status']=1;
		endif;			
			
		}

		echo json_encode($arr);
	}
	/**************************************************** View Label List *****************************************/
	public function View_Labellist($id=0)
	{
		$temp="";
		$temparr=array(); 
		$params=array();
			if($id==0)
			{
				redirect('Packing');
			}
			
			$params['Extracolumn']=$this->Queries->getRecord('select metal_name FROM '.TBL_CUSTOMER_ITEM_SUB.' WHERE isdelete=0  and itemid in (select item_id from '.TBL_PACKING_SUB.' where isdelete=0 and packingid='.$id.') GROUP BY `metal_name`');
			
			$params['packinglist']=$this->Packing_model->getSinglePacklist($id);
			$params['PackinglistSub']=$this->Packing_model->viewPackingSubList($id);
			
			$query="select itemid,metal_name,weight FROM ".TBL_CUSTOMER_ITEM_SUB." WHERE isdelete=0 and itemid in (select item_id from ".TBL_PACKING_SUB." where isdelete=0 and packingid=".$id.") GROUP BY metal_name,itemid ORDER BY itemid,metal_name";

			$res=$this->Queries->getRecord($query);

			//$params['Itemlist']=
			foreach($res as $post){				 
				$temparr[$post->itemid][$post->metal_name]=$post->weight;
			}

			
			$params['ItemList']=$temparr;
			
			$params['id']=$id;
			$this->load->view('Packing/view_labellist',$params);
	}
	/***************************************** Generate Invoice ***************************************/
	public function addInvoice($packingid=0)
	{
		if($packingid!=0 and $packingid!="")
		{
			
			$invoiceno="INV-";
			$invoice_date=date('Y-m-d');
			$fin_id=$this->session->userdata['financial_year']['id'];
			$query="select invoiceno from ".TBL_INVOICE." where isdelete=0 order by id desc"; 
			$res=$this->Queries->getSingleRecord($query);
			if($res!=null)
			{
				
				$arr=explode('-',$res->invoiceno);
				$arr[1]=(int)$arr[1]+1;
				$invoiceno.=str_pad($arr[1], 3, '0', STR_PAD_LEFT);
			}else{
				$invoiceno.="001";
			}

				$form_data=array(
				'fin_id'=>$fin_id,
				'packingid'=>$packingid,
				'invoiceno'=>$invoiceno,
				'invoice_date'=>$invoice_date,
				'created_by' => $this->session->userdata['logged_in']['userid'],
				'updated_by' => $this->session->userdata['logged_in']['userid'],
				'updated_on' => $today
			);

			$this->Queries->addRecord(TBL_INVOICE,$form_data);
			$invoiceid=$this->db->insert_id();
			$this->Queries->updateRecord(TBL_PACKING,array('status'=>'1'),$packingid);
			
					$this->session->set_flashdata('success_msg', 'Invoice Generated Successfully');

		}else{

					$this->session->set_flashdata('error_msg', 'Failed To Generate Invoice');
		}
		redirect('Invoice/add/'.$invoiceid);

	}
	/************************************** Delete Packing List *****************************************/
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
		if ($this->Queries->updateRecord(TBL_PACKING, $form_data, $id)) :
			$this->Queries->updatePacking(TBL_PACKING_SUB, $form_data, $id);
			$this->session->set_flashdata('success_msg', 'Order Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Order');
		endif;

		return redirect('Packing/');
	}

	public function PackingListReport($id=0)
	{
		$temp="";
		$temparr=array();
		$params=array();
			if($id==0)
			{
				redirect('Packing');
			}
			$params['Extracolumn']=$this->Queries->getRecord('SELECT `metal_name` FROM '.TBL_CUSTOMER_ITEM_SUB.' WHERE isdelete=0  and itemid in (select item_id from '.TBL_PACKING_SUB.' where isdelete=0 and packingid='.$id.') GROUP BY `metal_name`');
			
			$params['packinglist']=$this->Packing_model->getSinglePacklistForPrint($id);
			$params['PackinglistSub']=$this->Packing_model->viewPackingSubList($id);
			
			$query="select orderno from ".TBL_ORDER." where isdelete=0 and id in(".$params['packinglist']->customer_order.")";
			$res =$this->Queries->getRecord($query);
			$params['ordernolist'] = join(',', array_map(function($x){return $x->orderno; }, $res));


				$item_nolist= join(',', array_map(function($x){return $x->item_id; }, $params['PackinglistSub']));
				
			if($item_nolist!="")
			{$query="select category_name from ".TBL_ITEM_CATEGORY." where isdelete=0 and id in (select item_category  from ".TBL_CUSTOMER_ITEM." where isdelete=0 and id in(".$item_nolist."))";
			$res=$this->Queries->getRecord($query);
			$params['item_categorylist']= join(',', array_map(function($x){return $x->category_name; }, $res));

			}else{
				$params['item_categorylist']="";
			}
			

			$query="SELECT itemid,metal_name,weight FROM ".TBL_CUSTOMER_ITEM_SUB." WHERE isdelete=0 and itemid in (select item_id from ".TBL_PACKING_SUB." where isdelete=0 and packingid=".$id.") GROUP BY metal_name,itemid ORDER BY itemid,metal_name";
			$res=$this->Queries->getRecord($query);
			
			foreach($res as $post){				 
				$temparr[$post->itemid][$post->metal_name]=$post->weight;
			}

			$params['pdf']=base_url()."Packing/pdf/".$id;
			$params['ItemList']=$temparr;
			$params['id']=$id;
			$this->load->view('Packing/packing_list_report',$params);
	}


	public function pdf($id=0)
	{
		$temp="";
		$temparr=array();
		$params=array();
			if($id==0)
			{
				redirect('PackingList');
			}
			$params['Extracolumn']=$this->Queries->getRecord('SELECT `metal_name` FROM '.TBL_CUSTOMER_ITEM_SUB.' WHERE isdelete=0  and itemid in (select item_id from '.TBL_PACKING_SUB.' where isdelete=0 and packingid='.$id.') GROUP BY `metal_name`');
			
			$params['packinglist']=$this->Packing_model->getSinglePacklistForPrint($id);
			$params['PackinglistSub']=$this->Packing_model->viewPackingSubList($id);
			
			$query="select orderno from ".TBL_ORDER." where isdelete=0 and id in(".$params['packinglist']->customer_order.")";
			$res =$this->Queries->getRecord($query);
			$params['ordernolist'] = join(',', array_map(function($x){return $x->orderno; }, $res));


				$item_nolist= join(',', array_map(function($x){return $x->item_id; }, $params['PackinglistSub']));
				
			if($item_nolist!="")
			{$query="select category_name from ".TBL_ITEM_CATEGORY." where isdelete=0 and id in (select item_category  from ".TBL_CUSTOMER_ITEM." where isdelete=0 and id in(".$item_nolist."))";
			$res=$this->Queries->getRecord($query);
			$params['item_categorylist']= join(',', array_map(function($x){return $x->category_name; }, $res));

			}else{
				$params['item_categorylist']="";
			}
			

			$query="SELECT itemid,metal_name,weight FROM ".TBL_CUSTOMER_ITEM_SUB." WHERE isdelete=0 and itemid in (select item_id from ".TBL_PACKING_SUB." where isdelete=0 and packingid=".$id.") GROUP BY metal_name,itemid ORDER BY itemid,metal_name";
			$res=$this->Queries->getRecord($query);
			
			foreach($res as $post){				 
				$temparr[$post->itemid][$post->metal_name]=$post->weight;
			}

			
			$params['ItemList']=$temparr;
			$params['id']=$id;
				
			$html=$this->load->view('Packing/pdf',$params,true);
		
			$this->load->library('Pdf'); 	 
			$filename="packinglist".date('Ymdhis')."pdf";
			$this->pdf->create($html,$filename);
	}

	/*********************************** Export Packing List ******************************************/
	public function Export($id)
	{
		ini_set('max_execution_time', 60000);
        ini_set('memory_limit', '-1');
		$extracolumn=$this->Queries->getRecord('SELECT `metal_name` FROM '.TBL_CUSTOMER_ITEM_SUB.' WHERE isdelete=0  and itemid in (select item_id from '.TBL_PACKING_SUB.' where isdelete=0 and packingid='.$id.') GROUP BY `metal_name`');
			$itemlist=array();
		
		$max_cell_no=chr(75+count($extracolumn));
		$total_cell=9+2+count($extracolumn);
		$cell_spacing_for_3[0]=ceil($total_cell/3);
		$cell_spacing_for_3[1]=floor(($total_cell-$cell_spacing_for_3[0])/2);
		$cell_spacing_for_3[2]=round(($total_cell-$cell_spacing_for_3[0])/2);
		// print_r($cell_spacing_for_3);
		
		// die();
		

		$PackingList = $this->Packing_model->getSinglePacklistForPrint($id);
		$query="select orderno from ".TBL_ORDER." where isdelete=0 and id in(".$PackingList->customer_order.")";
		$res =$this->Queries->getRecord($query);
		$result = join(',', array_map(function($x){return $x->orderno; }, $res));
		
		
					$PackinglistSub=$this->Packing_model->viewPackingSubList($id);
				$item_nolist= join(',', array_map(function($x){return $x->item_id; }, $PackinglistSub));
				$item_categorylist="";
				if($item_nolist!="")
			{
				$query="select category_name from ".TBL_ITEM_CATEGORY." where isdelete=0 and id in (select item_category  from ".TBL_CUSTOMER_ITEM." where isdelete=0 and id in(".$item_nolist."))";
			$res=$this->Queries->getRecord($query);
			$item_categorylist= join(',', array_map(function($x){return $x->category_name; }, $res));

			}
				
				$query="SELECT itemid,metal_name,weight FROM ".TBL_CUSTOMER_ITEM_SUB." WHERE isdelete=0 and itemid in (select item_id from ".TBL_PACKING_SUB." where isdelete=0 and packingid=".$id.") GROUP BY metal_name,itemid ORDER BY itemid,metal_name";
			$res=$this->Queries->getRecord($query);
			
			foreach($res as $post){				 
				$itemlist[$post->itemid][$post->metal_name]=$post->weight;
			}
			
		date_default_timezone_set('Asia/Kolkata');
        $today = date("d_m_Y_g_i_A");
        

        $filename ="Packing_list_". $today . ".xlsx";

		require_once APPPATH . 'third_party/Phpspreadsheet/vendor/autoload.php';

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $spreadsheet->getProperties()->setCreator('Packing List')
            ->setLastModifiedBy('Packing List')
            ->setTitle('Packing List')
            ->setSubject('For the purpose of Packing List');

	$styleArray = array(
            'font' => array(
				'bold'=>true,
                'size' => 15,
				'name'  => 'open sans'
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'allborders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color'	=>array('rgb' => '000000')
                ),
            ),

        );
		$styleArray1 = array(
            'font' => array(
				'bold'=>true,
				'size'=>10,
				'name'  => 'open sans'
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'allborders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color'	=>array('rgb' => '000000')
                ),
            ),

        );

$styleArray2 = array(
	    'font' => array(
				'size'=>10,
				'name'  => 'open sans'
				
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            )
        );
		$styleArray3 = array(
	    'font' => array(
			'color' => array('rgb' => 'FF0000'),
				'size'=>10,
				'name'  => 'open sans'
				        
				
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            )
		);
		
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('sample/sample.xlsx');
    ///Set active sheet index to the first sheet, so Excel opens this as the first sheet
		
        $object=$spreadsheet->setActiveSheetIndex(0);

		
		$object->mergeCells('A1:'.$max_cell_no.'1');
        $object->setCellValue("A1", "Packing List")->getStyle("A1")->applyFromArray($styleArray);
		/********************** Exporter Details     *************************/
		$cell_temp=64+$cell_spacing_for_3[0];
		$object->mergeCells('A2:'.chr($cell_temp).'2');
		$object->setCellValue("A2", "Exporter :")->getStyle("A2")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('A3:'.chr($cell_temp).'3');
		$object->setCellValue("A3",$PackingList->company_name)->getStyle('A3')->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		$object->mergeCells('A4:'.chr($cell_temp).'6');
		$object->setCellValue("A4",$PackingList->company_address)->getStyle("A4")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		
		/********************** Consignee Detail   *************************/
		$object->mergeCells(chr($cell_temp+1).'2:'.chr($cell_temp+$cell_spacing_for_3[1]).'2');
		$object->setCellValue(chr($cell_temp+1).'2','Consignee Detail')->getStyle(chr($cell_temp+1).'2')->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells(chr($cell_temp+1).'3:'.chr($cell_temp+$cell_spacing_for_3[1]).'3');
		$object->setCellValue(chr($cell_temp+1).'3',$PackingList->customer_name)->getStyle(chr($cell_temp+1).'3')->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		$object->mergeCells(chr($cell_temp+1).'4:'.chr($cell_temp+$cell_spacing_for_3[1]).'6');
		$object->setCellValue(chr($cell_temp+1).'4',$PackingList->address)->getStyle(chr($cell_temp+1).'4')->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		$cell_temp+=$cell_spacing_for_3[1];

		/********************** Packing List Detail  *************************/
		$object->mergeCells(chr($cell_temp+1).'2:'.chr($cell_temp+$cell_spacing_for_3[2]).'2');
		$object->setCellValue(chr($cell_temp+1).'2',"Packing List Detail")->getStyle(chr($cell_temp+1).'2')->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells(chr($cell_temp+1).'3:'.chr($cell_temp+$cell_spacing_for_3[2]).'3');
		$object->setCellValue(chr($cell_temp+1).'3',"Packing List No. &  Dt.")->getStyle(chr($cell_temp+1).'3')->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		
		$date=date_create_from_format('Y-m-d',$PackingList->packing_date);
		$date=date_format($date,'M d,Y');
		$object->mergeCells(chr($cell_temp+1).'4:'.chr($cell_temp+$cell_spacing_for_3[2]).'4');
		$object->setCellValue(chr($cell_temp+1).'4',$PackingList->packing_no." ".$date)->getStyle(chr($cell_temp+1).'4')->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		$object->mergeCells(chr($cell_temp+1).'5:'.chr($cell_temp+$cell_spacing_for_3[2]).'6');
		$object->setCellValue(chr($cell_temp+1).'5',"Order No : ".$result)->getStyle(chr($cell_temp+1).'5')->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		
		
		
		
		/********************** OTHER DETAILS  *************************/
		
		// $t=(ceil($cell_spacing_for_3[0]/2));
		// $cell_temp=64+$t;
		// $cell_temp1=$cell_temp+($cell_spacing_for_3[0]-$t);
		// $object->mergeCells('A7:'.$max_cell_no.'7');
        // $object->setCellValue("A7", "OTHER DETAILS")->getStyle("A7")->applyFromArray($styleArray);

			/********************** Pre Carrier  DETAILS  *************************/
		// $object->mergeCells('A8:'.chr($cell_temp).'8');
		// $object->setCellValue("A8", "Place Of Pre Carrier:")->getStyle("A8")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		// $object->mergeCells('A9:'.chr($cell_temp).'9');
		// $object->setCellValue("A9", $PackingList->place_for_pre_carrier)->getStyle("A9")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		

		// $object->mergeCells(chr($cell_temp+1).'8:'.chr($cell_temp1).'8');
		// $object->setCellValue(chr($cell_temp+1)."8", "Pre Carriage By:")->getStyle(chr($cell_temp+1)."8")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		// $object->mergeCells(chr($cell_temp+1).'9:'.chr($cell_temp1).'9');
		// $object->setCellValue(chr($cell_temp+1)."9", $PackingList->pre_carriage_by)->getStyle(chr($cell_temp+1)."9")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);

		// $cell_temp=64+$cell_spacing_for_3[0];
		// $object->mergeCells('A10:'.chr($cell_temp).'10');
		// $object->setCellValue("A10", "Terms of Payment :")->getStyle("A10")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		// $object->mergeCells('A11:'.chr($cell_temp).'11');
		// $object->setCellValue("A11", $PackingList->term_of_payment)->getStyle("A11")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		
		
		/********************** Exporter Country  DETAILS  *************************/
		
		// $t=(ceil($cell_spacing_for_3[1]/2));
		// $t2=$cell_spacing_for_3[1]-$t;
		// $object->mergeCells(chr($cell_temp+1).'8:'.chr($cell_temp+$t).'8');
		// $object->setCellValue(chr($cell_temp+1)."8", "Country of Origin:")->getStyle(chr($cell_temp+1)."8")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		// $object->mergeCells(chr($cell_temp+1).'9:'.chr($cell_temp+$t).'9');
		// $object->setCellValue(chr($cell_temp+1)."9", $PackingList->company_country_name)->getStyle(chr($cell_temp+1)."9")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		

		// $object->mergeCells(chr($cell_temp+$t+1).'8:'.chr($cell_temp+$t+$t2).'8');
		// $object->setCellValue(chr($cell_temp+$t+1)."8", "Port of Loading:")->getStyle(chr($cell_temp+$t+1)."8")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		// $object->mergeCells(chr($cell_temp+$t+1).'9:'.chr($cell_temp+$t+$t2).'9');
		// $object->setCellValue(chr($cell_temp+$t+1)."9", $PackingList->port_name)->getStyle(chr($cell_temp+$t+1)."9")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);

		
		// $object->mergeCells(chr($cell_temp+1).'10:'.chr($cell_temp+$cell_spacing_for_3[1]).'10');
		// $object->setCellValue(chr($cell_temp+1)."10", "Notify Party / Buyer :")->getStyle(chr($cell_temp+1)."10")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		// $object->mergeCells(chr($cell_temp+1).'11:'.chr($cell_temp+$cell_spacing_for_3[1]).'11');
		// $object->setCellValue(chr($cell_temp+1)."11",'')->getStyle(chr($cell_temp+1)."11")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		// $cell_temp+=$cell_spacing_for_3[1];

		/********************** Customer Country  DETAILS  *************************/
		
		// $t=(ceil($cell_spacing_for_3[2]/2));
		// $t2=$cell_spacing_for_3[2]-$t;
		// $object->mergeCells(chr($cell_temp+1).'8:'.chr($cell_temp+$t).'8');
		// $object->setCellValue(chr($cell_temp+1)."8", "Final Country:")->getStyle(chr($cell_temp+1)."8")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		// $object->mergeCells(chr($cell_temp+1).'9:'.chr($cell_temp+$t).'9');
		// $object->setCellValue(chr($cell_temp+1)."9", $PackingList->country_name)->getStyle(chr($cell_temp+1)."9")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		

		// $object->mergeCells(chr($cell_temp+$t+1).'8:'.chr($cell_temp+$t+$t2).'8');
		// $object->setCellValue(chr($cell_temp+$t+1)."8", "Port of Discharge:")->getStyle(chr($cell_temp+$t+1)."8")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		// $object->mergeCells(chr($cell_temp+$t+1).'9:'.chr($cell_temp+$t+$t2).'9');
		// $object->setCellValue(chr($cell_temp+$t+1)."9", $PackingList->discharge_name)->getStyle(chr($cell_temp+$t+1)."9")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);

		
		// $object->mergeCells(chr($cell_temp+1).'10:'.chr($cell_temp+$cell_spacing_for_3[2]).'10');
		// $object->setCellValue(chr($cell_temp+1)."10", "Final Destination :")->getStyle(chr($cell_temp+1)."10")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		// $object->mergeCells(chr($cell_temp+1).'11:'.chr($cell_temp+$cell_spacing_for_3[2]).'11');
		// $object->setCellValue(chr($cell_temp+1)."11",$PackingList->country_name)->getStyle(chr($cell_temp+1)."11")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		

		/********************** Item Category  *************************/
		// $t=ceil($total_cell/2);
		// $cell_temp=64+$t;
		// $t2=$total_cell-$t;
		
		
		
		// $object->mergeCells('A12:'.chr($cell_temp).'12');
		// $object->setCellValue("A12", "Item Category :")->getStyle("A12")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		// $object->mergeCells('A13:'.chr($cell_temp).'14');
		// $object->setCellValue("A13",$item_categorylist)->getStyle("A13")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);

		// $object->mergeCells(chr($cell_temp+1).'12:'.chr($cell_temp+$t2).'12');
		// $object->setCellValue(chr($cell_temp+1)."12", "CET / CTH :")->getStyle(chr($cell_temp+1)."12")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		// $object->mergeCells(chr($cell_temp+1).'13:'.chr($cell_temp+$t2).'14');
		// $object->setCellValue(chr($cell_temp+1)."13","")->getStyle(chr($cell_temp+1)."13")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);

		/********************** Table Header  *************************/	
		$object->mergeCells('A7:A8');
		$object->setCellValue("A7","P NO")->getStyle("A7")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('B7:C8');
		$object->setCellValue("B7","Ctn. Range")->getStyle("B7")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('D7:F8');
		$object->setCellValue("D7","Description of Goods")->getStyle("D7")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('G7:G8');
		$object->setCellValue("G7","Ctn. Nos")->getStyle("G7")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('H7:H8');
		$object->setCellValue("H7","Qty / Ctn.")->getStyle("H7")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('I7:I8');
		$object->setCellValue("I7","Total Qty")->getStyle("I7")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);

		
		
		$cell_temp=73;
		foreach($extracolumn as $post): 
			 $cell_temp++;       
			 $object->mergeCells(chr($cell_temp)."7".":".chr($cell_temp)."8");        
		    $object->setCellValue(chr($cell_temp)."7",$post->metal_name." Net( (Kgs)")->getStyle(chr($cell_temp)."7")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		endforeach;
		$cell_temp++; 
		$object->mergeCells(chr($cell_temp)."7".":".chr($cell_temp)."8");        
		 $object->setCellValue(chr($cell_temp)."7","Total Net (Kgs)")->getStyle(chr($cell_temp)."7")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		 
		 $cell_temp++;
		 $object->mergeCells(chr($cell_temp)."7".":".chr($cell_temp)."8");        
		$object->setCellValue(chr($cell_temp)."7","Gross We. (Kgs)")->getStyle(chr($cell_temp)."7")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
 				$x=8;
				 $total_cartons=0;
				$metal_total_arr=array();
				$pellet_count=0;
				$temp="";
				$total_gross_weight=0;
				$all_total_metal_Weight=0;
				$temp_cr_range="";
				$gross_total_cartons=0;
				foreach($PackinglistSub as $post):
				$cell_temp=65;
				$x++;
					$total_cartons=$post->case_no_to-$post->case_no_from+1;
				
				
						//  if($temp=="" || $temp!=$post->pellet)
						// {
						// 	$pellet_count++;
						// 	$temp=$post->pellet;
							
						// 	$object->mergeCells(chr($cell_temp).$x.':'.chr($cell_temp).($x+(($post->pellet_count-1)>0?($post->pellet_count-1):0)));
						// $object->setCellValue(chr($cell_temp).$x,$post->pellet)->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
					
						//  }
						 
						 $cell_temp++;
					 if($temp_cr_range=="" || $temp_cr_range!=intval($post->case_no_to).":".intval($post->case_no_from)){
						
						 	$object->mergeCells(chr($cell_temp).$x.':'.chr($cell_temp+1).($x+(($post->same_caton_count-1)>=1?($post->same_caton_count-1):0)));
					
					$object->setCellValue(chr($cell_temp).$x,"SE-".str_pad(intval($post->case_no_from), 2, '0', STR_PAD_LEFT)." to SE-".str_pad(intval($post->case_no_to), 2, '0', STR_PAD_LEFT))->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
					
					 }
					 $cell_temp+=2;
					 $object->mergeCells(chr($cell_temp).$x.':'.chr($cell_temp+2).$x);
					 	$object->setCellValue(chr($cell_temp).$x,$post->unique_no." - ".$post->item_name)->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
					$cell_temp+=3;
					if($temp_cr_range=="" || $temp_cr_range!=intval($post->case_no_to).":".intval($post->case_no_from)){
						$gross_total_cartons+=$total_cartons;
					
						$temp_cr_range=intval($post->case_no_to).":".intval($post->case_no_from);
						$object->mergeCells(chr($cell_temp).$x.':'.chr($cell_temp).($x+(($post->same_caton_count -1)>0?($post->same_caton_count-1):0)));
					$object->setCellValue(chr($cell_temp).$x,$total_cartons)->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
					 }
					 $cell_temp++;
					 $object->setCellValue(chr($cell_temp).$x,(float)$post->pcs)->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
					 $cell_temp++;
					 $object->setCellValue(chr($cell_temp).$x,(float)($total_cartons*$post->pcs))->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
										$totalqty =($total_cartons*$post->pcs);
					$total_metal_Weight=0;
					
					for($i=0;$i<count($extracolumn);$i++):
					echo $extracolumn[$post->itemid][$extracolumn[$i]->metal_name];
						$metal_weight_post=(float)$itemlist[$post->item_id][$extracolumn[$i]->metal_name];
					$metal_total_arr[$extracolumn[$i]->metal_name]+=sprintf("%0.3f",($totalqty*$metal_weight_post)/1000);
					$metal_weight=sprintf("%0.3f",($totalqty*$metal_weight_post)/1000);
					$total_metal_Weight+=$metal_weight; 
					 $cell_temp++;
					 $object->setCellValue(chr($cell_temp).$x,$metal_weight)->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
					endfor;
					
						$all_total_metal_Weight+=$total_metal_Weight;
						$cell_temp++;
						$object->setCellValue(chr($cell_temp).$x,sprintf("%0.3f",$total_metal_Weight))->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
					$cell_temp++;
					 $total_temp=sprintf("%0.3f",($post->total_weight)); 
						$object->setCellValue(chr($cell_temp).$x,$total_temp)->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
				$total_gross_weight+=$total_temp;
					endforeach; 

					$x++;
						$cell_temp=65;
						$object->setCellValue(chr($cell_temp).$x,$pellet_count)->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
						$cell_temp+=6;
						$object->setCellValue(chr($cell_temp).$x,$gross_total_cartons)->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
						$cell_temp+=2;
						for($i=0;$i<count($extracolumn);$i++):
						$cell_temp++;
                    	$object->setCellValue(chr($cell_temp).$x,sprintf("%0.3f",$metal_total_arr[$extracolumn[$i]->metal_name]) )->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);               
                    endfor;
				
						$cell_temp++;
				    	$object->setCellValue(chr($cell_temp).$x,$all_total_metal_Weight )->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);               
						$cell_temp++;
				    	$object->setCellValue(chr($cell_temp).$x,$total_gross_weight )->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);               

						// $x++;
						// $object->mergeCells(chr(64+$total_cell-3).$x.":".chr(64+$total_cell-1).$x);
						// $object->setCellValue(chr(64+$total_cell-3).$x,'Total Weight Of Pallet:')->getStyle(chr(64+$total_cell-3).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);               
						// $object->setCellValue(chr(64+$total_cell).$x,(float)$PackingList->weight_of_total_pellet)->getStyle(chr(64+$total_cell).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);               
						// $x++;
						// $object->mergeCells(chr(64+$total_cell-3).$x.":".chr(64+$total_cell-1).$x);
						// $object->setCellValue(chr(64+$total_cell-3).$x,'Total Gross Weight:')->getStyle(chr(64+$total_cell-3).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);               
						// $object->setCellValue(chr(64+$total_cell).$x,(float)($total_gross_weight+$packinglist->weight_of_total_pellet))->getStyle(chr(64+$total_cell).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);               

		/********************** IEC  Details     *************************/
		$y=$x;
		// $x++;
		// $iec_date=date_create_from_format('Y-m-d',$PackingList->iec_date);
    	// $iec_date=date_format($iec_date,'d-m-Y');
		 $cell_temp=64+$cell_spacing_for_3[0];
		// $object->mergeCells('A'.$x.':'.chr($cell_temp).$x);
		// $object->setCellValue("A".$x, "IEC Code No.:".$PackingList->iec_code.", Dt.".$iec_date)->getStyle("A".$x)->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		// $x++;
		// $object->mergeCells('A'.$x.':'.chr($cell_temp).$x);
		// $object->setCellValue("A".$x,"ARN:".$PackingList->company_anr_no)->getStyle('A'.$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		
		$x++;
		$object->mergeCells('A'.$x.':'.chr($cell_temp).$x);
		$object->setCellValue("A".$x,'GST Number :'.$PackingList->company_gstno)->getStyle("A".$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		
		/********************** Metal Details   *************************/
		$x=$y;
		 for($i=0;$i<count($extracolumn);$i++):
		 $x++;
		 $object->mergeCells(chr($cell_temp+1).$x.':'.chr($cell_temp+$cell_spacing_for_3[1]).$x);
		$object->setCellValue(chr($cell_temp+1).$x,$extracolumn[$i]->metal_name ." Net Weight :".sprintf("%0.3f",$metal_total_arr[$extracolumn[$i]->metal_name]))->getStyle(chr($cell_temp+1).$x)->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		  endfor;
		$x++;
		 $object->mergeCells(chr($cell_temp+1).$x.':'.chr($cell_temp+$cell_spacing_for_3[1]).$x);
		$object->setCellValue(chr($cell_temp+1).$x,"Gross Net Weight :".$all_total_metal_Weight)->getStyle(chr($cell_temp+1).$x)->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$x++;
		 $object->mergeCells(chr($cell_temp+1).$x.':'.chr($cell_temp+$cell_spacing_for_3[1]).$x);
		 $object->setCellValue(chr($cell_temp+1).$x,"Total Gross Weight :".$total_gross_weight)->getStyle(chr($cell_temp+1).$x)->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);

		$cell_temp+=$cell_spacing_for_3[1];

		/********************** Company Detail  *************************/
		$x=$y;
		$x++;
		$object->mergeCells(chr($cell_temp+1).$x.':'.chr($cell_temp+$cell_spacing_for_3[1]).$x);
		$object->setCellValue(chr($cell_temp+1).$x,"For ".$PackingList->company_name)->getStyle(chr($cell_temp+1).$x)->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		
		$x++;
		$object->mergeCells(chr($cell_temp+1).$x.':'.chr($cell_temp+$cell_spacing_for_3[1]).$x);
		$object->setCellValue(chr($cell_temp+1).$x,"Partner")->getStyle(chr($cell_temp+1).$x)->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$x+=3;
		$object->mergeCells(chr($cell_temp+1).$x.':'.chr($cell_temp+$cell_spacing_for_3[1]).$x);
		$object->setCellValue(chr($cell_temp+1).$x,"Signature & Date:")->getStyle(chr($cell_temp+1).$x)->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		
		

    foreach($object->getRowDimensions() as $rd) {      $rd->setRowHeight(auto);  }
        $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

		
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        
        $object_writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $object_writer->save("Exportdata/" . $filename);
        $dir = base_url() . "Exportdata/";
        header("Location: " . $dir . $filename . "");
		 
	}


}
?>