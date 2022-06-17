<?php
class PackingList extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
		$this->load->model('Packing_list_model','PackingList');
	}

	public function index()
	{
		if (!check_role_assigned('packing_list', 'view')) {
			redirect('forbidden');
		}
		// init params
		$params = array();
		
		$params['PackingList'] = $this->PackingList->getPackingList();
		
		
		$this->load->view('PackingList/index', $params);
	}

	public  function add($id = 0)
	{
		$fin_id=$this->session->userdata['financial_year']['id'];
		
				
		try {
            $params["id"]=$id;
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('packing_list', 'edit')) {
					redirect('forbidden');
				}

             $query="select * from ".TBL_PACKINGLIST." where isdelete=0 and id=".$id;
			$params['PackingList']=$this->Queries->getSingleRecord($query);	
				$query="select * from ".TBL_ORDER." where isdelete=0 and customerid=".$params['PackingList']->customerid;
			$params['orderlist']=$this->Queries->get_tab_list2($query,'id','orderno');
			
			$params['portofloadinglist']=$this->PackingList->getCompanyPort($params['PackingList']->customerid);
			$params['portofloadinglist1']=$this->PackingList->getCustomerPort($params['PackingList']->customerid);
			}else{
				$params['orderlist']="";
				$params['portofloadinglist']=array('0'=>'- Select -');
			}
			if (!check_role_assigned('packing_list', 'add')) {
				redirect('forbidden');
			}

			
			$query="select * from ".TBL_CUSTOMER." where isdelete=0";
			$params['customerlist']=$this->Queries->get_tab_list($query,'id','customer_name');
			
			// $query="select * from ".TBL_PORT_MASTER." where isdelete=0";
			// $params['portofloadinglist']=$this->Queries->get_tab_list($query,'id','port_name');
			


			$this->load->view('PackingList/add', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}

  public function GetCustomerFields($id=0)
  { 
	  $arr=array();
	  $orderlist="";
	  $portofloadinglist=array('0'=>'- Select -');
	  $output="";
	if($id!=0 && $id!='')
	{
		$query="select * from ".TBL_ORDER." where isdelete=0 and customerid=".$id;
		 $orderlist=$this->Queries->get_tab_list2($query,'id','orderno');
    	   $portofloadinglist=$this->PackingList->getCompanyPort($id);	 
		   $portofloadinglist1=$this->PackingList->getCustomerPort($id);	 
	}
	ob_start();
	multidropdownbox('12','Customer Orders','customer_order[]',$orderlist,'','required');
	$output = ob_get_clean();
    $arr['order']=$output;
	$output="";
	ob_start();
	dropdownbox('4','Port of Loading','port_of_loading',$portofloadinglist,$val_port_of_loading,'required').dropdownbox('4','Port of Discharge','port_of_discharge',$portofloadinglist1,$val_port_of_discharge,'required');
	$output = ob_get_clean();
	$arr['port']=$output;
	echo json_encode($arr);
  }
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
			$pellet_label = StringRepair($this->input->post('pellet_label'));
			$no_of_pellet=StringRepair($this->input->post('no_of_pellet'));
			$weight_of_total_pellet=StringRepair($this->input->post('weight_of_total_pellet'));
			$total_cartons=StringRepair($this->input->post('total_cartons'));

			$pre_carriage_by=StringRepair($this->input->post('pre_carriage_by'));
			$place_for_pre_carrier=StringRepair($this->input->post('place_for_pre_carrier'));
			$term_of_payment=StringRepair($this->input->post('term_of_payment'));
				$flight_no=StringRepair($this->input->post('flight_no'));
				$port_of_loading=StringRepair($this->input->post('port_of_loading'));
				
				$port_of_discharge=StringRepair($this->input->post('port_of_discharge'));
			$id = $this->input->post('id');
			
			$today = date('Y-m-d H:i:s');
			if ($id != 0 and $id != "") {

				$form_data = array(
					'fin_id'=>$fin_id,
					'packing_date' => $packing_date,
					'packing_no'=>$packing_no,
					'customerid'=>$customerid,
					'customer_order'=>$customer_order,
					'pellet_label'=>$pellet_label,
					'no_of_pellet'=>$no_of_pellet,
					'total_cartons'=>$total_cartons,
					'weight_of_total_pellet'=>$weight_of_total_pellet,
					'pre_carriage_by'=>$pre_carriage_by,
					'place_for_pre_carrier'=>$place_for_pre_carrier,
					'term_of_payment'=>$term_of_payment,
					'flight_no'=>$flight_no,
					
					'port_of_loading'=>$port_of_loading,
					'port_of_discharge'=>$port_of_discharge,
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);
				if ($this->Queries->updateRecord(TBL_PACKINGLIST, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'PackingList Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update PackingList');
				endif;
				$pid=$id;

			} else {
				
				
				$form_data = array(
				'fin_id'=>$fin_id,
					'packing_date' => $packing_date,
					'packing_no'=>$packing_no,
					'customerid'=>$customerid,
					'customer_order'=>$customer_order,
					'pellet_label'=>$pellet_label,
					'no_of_pellet'=>$no_of_pellet,
					'total_cartons'=>$total_cartons,
					'weight_of_total_pellet'=>$weight_of_total_pellet,
					'pre_carriage_by'=>$pre_carriage_by,
					'place_for_pre_carrier'=>$place_for_pre_carrier,
					'term_of_payment'=>$term_of_payment,
					'flight_no'=>$flight_no,
					'port_of_loading'=>$port_of_loading,
					'port_of_discharge'=>$port_of_discharge,
					'created_by' => $this->session->userdata['logged_in']['userid'],
					'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
				);

				if ($this->Queries->addRecord(TBL_PACKINGLIST, $form_data)) :
					$this->session->set_flashdata('success_msg', 'PackingList Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add PackingList');
				endif;
				$pid=$this->db->insert_id();
				
				
			}
			
		}

		return redirect('PackingList/addPackingDraft/'.$pid);
	}
	public  function addPackingDraft($id = 0)
	{
	
		try {
            
			if ($id != "" and $id != 0) {
				if (!check_role_assigned('packing_list', 'edit')) {
					redirect('forbidden');
				}
				$params["id"]=$id;
				
				$temparr=array('0'=>'- Select -');
				$res=$this->PackingList->getSinglePacklist($id);
				$params['singlepackinglist']=$res;
                 $temp="";
				for($i=1;$i<=$res->no_of_pellet;$i++)
				{
					$temp=$res->pellet_label."-".str_pad($i, 3, '0', STR_PAD_LEFT);;
					$temparr[$temp]=$temp;
				}
				$params['pelletlist']=$temparr;

            $query="select * from ".TBL_ORDER." where isdelete=0 and id in (".$res->customer_order.")";
			$params['orderlist']=$this->Queries->get_tab_list($query,'id','orderno');
	

			$params['itemlist']=array('0'=>'- Select -');
			$params['packingsublist']=$this->PackingList->getPackingSubList($id);
			}else{
				redirect('PackingList/add/');
			}
			


			$this->load->view('PackingList/addPackingDraft', $params);
		} catch (Exception $e) {
			echo $e;
		}
	}

  public function SingleItem($packingid,$id)
	{
		$res=0;
		if($id!="" && $id!=0){
				$res=$this->PackingList->getSinglePacklistSub($packingid,$id);
		}
	echo json_encode($res);
	}

	public function getItem($id)
	{
		$itemlist=array('0'=>'- Select -');
		if($id!="" && $id!=0){
				$itemlist=$this->PackingList->getItemUsingOrderNo($id);
		}
	echo dropdownbox('4','Item No.','itemid',$itemlist,'','required');
	}

	public function saveItem()
	{
	
	
		$html="";
		$arr=array();
		$arr['status']=0;
		$description="";
		$this->form_validation->set_rules('orderid', 'order', 'required');
		$this->form_validation->set_rules('pellet', 'pellet', 'required');
		if ($this->form_validation->run()) {
			

			$subid=StringRepair($this->input->post('subid'));
			$fin_id=$this->session->userdata['financial_year']['id'];
			$packingid = StringRepair($this->input->post('packingid'));
			$orderid = StringRepair($this->input->post('orderid'));
			$container_type = StringRepair($this->input->post('container_type'));
			$pellet = StringRepair($this->input->post('pellet'));
			$itemid = StringRepair($this->input->post('itemid'));
			$total_box_weight = StringRepair($this->input->post('total_box_weight'));
			$total_carton_weight = StringRepair($this->input->post('total_carton_weight'));
			$total_plastic_weight = StringRepair($this->input->post('total_plastic_weight'));
			$one_box_pcs = StringRepair($this->input->post('one_box_pcs'));
			$one_carton_pcs = StringRepair($this->input->post('one_carton_pcs'));
			$carton_range_start = StringRepair($this->input->post('carton_range_start'));
			$carton_range_end = StringRepair($this->input->post('carton_range_end'));
			$total_cartons=$carton_range_end-$carton_range_start+1;
           $today=date('Y-m-d H:i:s');
			if($subid!=0 && $subid!="")
			{

				$res=$this->Queries->getSingleRecord("select * from ".TBL_PACKINGLIST_SUB." where isdelete=0 and id!=$subid  and packingid=$packingid and carton_range_start=$carton_range_start and carton_range_end=$carton_range_end and total_cartons>1 order by carton_range_end");
				if($res==null)
				{
						$form_data=array(
							'fin_id'=>$fin_id,
							'orderid'=>$orderid,
							'container_type'=>$container_type,
							'pellet'=>$pellet,
							'packingid'=>$packingid,
							'itemid'=>$itemid,
							'total_box_weight'=>$total_box_weight,
							'total_carton_weight'=>$total_carton_weight,
							'total_plastic_weight'=>$total_plastic_weight,
							'one_box_pcs'=>$one_box_pcs,
							'one_carton_pcs'=>$one_carton_pcs,
							'carton_range_start'=>$carton_range_start,
							'carton_range_end'=>$carton_range_end,
							'total_cartons'=>$total_cartons,
							'updated_by' => $this->session->userdata['logged_in']['userid'],
							'updated_on' => $today
							);
						if ($this->Queries->updateRecord(TBL_PACKINGLIST_SUB, $form_data,$subid)) :
						$arr['status']=2;
						endif;
						$res=$this->Queries->getSingleRecord('select * from '.TBL_ORDER.' where isdelete=0 and id='.$orderid);
						$res1=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER_ITEM.' where isdelete=0 and id='.$itemid);
						$html.="
							<td>".CONTAINERLIST[$container_type]."</td>
							<td>".$pellet."</td>
								<td>".$res->orderno."</td>
								<td>".$res1->unique_no."</td>
								<td>".$total_box_weight."</td>
								<td>".$total_carton_weight."</td>
								<td>".$total_plastic_weight."</td>
								<td>".$one_box_pcs."</td>
								<td>".$one_carton_pcs."</td>
								<td>".$carton_range_start."-".$carton_range_end."</td>
								<td>
									<div class=btn-group><a href='javascript:void(0)' class='btn btn-info btn-xs  edittr' data-id='".$subid."'><span class='fa fa-pencil'></span></a>
									</div>
									<div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='".$subid."'><span class='fa fa-minus'></span></a>
									</div>
								</td>	
						";
				}else{
					$arr['msg']="Enter Valid Carton Range";
				}
			}else{

				$res=$this->Queries->getSingleRecord("select * from ".TBL_PACKINGLIST_SUB." where isdelete=0 and packingid=$packingid and carton_range_end>=$carton_range_start and total_cartons>1 order by carton_range_end");

				// $res2 = $this->Queries->getSingleRecord("select * from ".TBL_PACKINGLIST_SUB." where isdelete=0 and packingid=$packingid and carton_range_end<=$carton_range_start and carton_range_start>=$carton_range_start and carton_range_start<=$carton_range_end and carton_range_end > $carton_range_end and total_cartons>1 order by carton_range_end");

				if($res==null)
				{
				
					$form_data=array(
						'fin_id'=>$fin_id,
						'orderid'=>$orderid,
						'container_type'=>$container_type,
						'pellet'=>$pellet,
						'packingid'=>$packingid,
						'itemid'=>$itemid,
						'total_box_weight'=>$total_box_weight,
						'total_carton_weight'=>$total_carton_weight,
						'total_plastic_weight'=>$total_plastic_weight,
						'one_box_pcs'=>$one_box_pcs,
						'one_carton_pcs'=>$one_carton_pcs,
						'carton_range_start'=>$carton_range_start,
						'carton_range_end'=>$carton_range_end,
						'total_cartons'=>$total_cartons,
						'created_by' => $this->session->userdata['logged_in']['userid'],
						'updated_by' => $this->session->userdata['logged_in']['userid'],
						'updated_on' => $today
					);
					if ($this->Queries->addRecord(TBL_PACKINGLIST_SUB, $form_data)) :
					$arr['status']=1;
					endif;
					$id=$this->db->insert_id();

					$res=$this->Queries->getSingleRecord('select * from '.TBL_ORDER.' where isdelete=0 and id='.$orderid);
					$res1=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER_ITEM.' where isdelete=0 and id='.$itemid);
					$html.="
						<tr id='item_tr_".$id."'>
							<td>".CONTAINERLIST[$container_type]."</td>
							<td>".$pellet."</td>
							<td>".$res->orderno."</td>
							<td>".$res1->unique_no."</td>
							<td>".$total_box_weight."</td>
							<td>".$total_carton_weight."</td>
							<td>".$total_plastic_weight."</td>
							<td>".$one_box_pcs."</td>
							<td>".$one_carton_pcs."</td>
							<td>".$carton_range_start."-".$carton_range_end."</td>
							<td>
								<div class=btn-group><a href='javascript:void(0)' class='btn btn-info btn-xs  edittr' data-id='".$id."'><span class='fa fa-pencil'></span></a>
								</div>
								<div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='".$id."'><span class='fa fa-minus'></span></a>
								</div>
							</td>
							</td>
						</tr>
					";
			}else{
				$arr['msg']="Enter Valid Carton Range";
			}
		
			}
				$arr['html']=$html;
		}

		echo json_encode($arr);
	}
	public function deleteItem()
	{$html="";
		$arr=array();
		$arr['status']=0;

		$this->form_validation->set_rules('id', 'id', 'required');
		if ($this->form_validation->run()) {
			$id = StringRepair($this->input->post('id'));
					$today = date('Y-m-d H:i:s');
			
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_PACKINGLIST_SUB, $form_data, $id)) :
			$arr['status']=1;
		endif;			
		}

		echo json_encode($arr);
	}
	
	
	public function delete($id)
	{
		if (!check_role_assigned('packing_list', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_PACKINGLIST, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'PackingList Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete PackingList');
		endif;

		return redirect('PackingList/');
	}


	public function addInvoice($packingid=0)
	{
		if($packingid!=0 and $packingid!="")
		{
			
			$invoiceno="SE-";
			$invoice_date=date('Y-m-d');
			$fin_id=$this->session->userdata['financial_year']['id'];
			$query="select packing_no from ".TBL_PACKINGLIST." where isdelete=0 and id=$packingid order by id desc"; 
			$res=$this->Queries->getSingleRecord($query);
			if($res!=null)
			{	
				$invoiceno = $res->packing_no;
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
			$this->Queries->updateRecord(TBL_PACKINGLIST,array('status'=>'1'),$packingid);
			
					$this->session->set_flashdata('success_msg', 'Invoice Generated Successfully');

		}else{

					$this->session->set_flashdata('error_msg', 'Failed To Generate Invoice');
		}
		redirect('Invoice/add/'.$invoiceid);

	}

	
	public function Export($id)
	{
		ini_set('max_execution_time', 60000);
        ini_set('memory_limit', '-1');
		$extracolumn=$this->Queries->getRecord('SELECT `metal_name` FROM '.TBL_CUSTOMER_ITEM_SUB.' WHERE isdelete=0  and itemid in (select itemid from '.TBL_PACKINGLIST_SUB.' where isdelete=0 and packingid='.$id.') GROUP BY `metal_name`');
			$itemlist=array();
		
		$max_cell_no=chr(75+count($extracolumn));
		$total_cell=9+2+count($extracolumn);
		$cell_spacing_for_3[0]=ceil($total_cell/3);
		$cell_spacing_for_3[1]=floor(($total_cell-$cell_spacing_for_3[0])/2);
		$cell_spacing_for_3[2]=round(($total_cell-$cell_spacing_for_3[0])/2);
		// print_r($cell_spacing_for_3);
		
		// die();
		

		$PackingList = $this->PackingList->getSinglePacklistForPrint($id);
		$query="select orderno from ".TBL_ORDER." where isdelete=0 and id in(".$PackingList->customer_order.")";
		$res =$this->Queries->getRecord($query);
		$result = join(',', array_map(function($x){return $x->orderno; }, $res));
		
		
					$PackinglistSub=$this->PackingList->viewPackingSubList($id);
				$item_nolist= join(',', array_map(function($x){return $x->itemid; }, $PackinglistSub));
				$item_categorylist="";
				if($item_nolist!="")
			{
				$query="select category_name from ".TBL_ITEM_CATEGORY." where isdelete=0 and id in (select item_category  from ".TBL_CUSTOMER_ITEM." where isdelete=0 and id in(".$item_nolist."))";
			$res=$this->Queries->getRecord($query);
			$item_categorylist= join(',', array_map(function($x){return $x->category_name; }, $res));

			}
				
				$query="SELECT itemid,metal_name,weight FROM ".TBL_CUSTOMER_ITEM_SUB." WHERE isdelete=0 and itemid in (select itemid from ".TBL_PACKINGLIST_SUB." where isdelete=0 and packingid=".$id.") GROUP BY metal_name,itemid ORDER BY itemid,metal_name";
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
                ),
            ),

        );
		$styleArray1 = array(
            'font' => array(
				'bold'=>true,
				'size'=>12,
				'name'  => 'open sans'
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'allborders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),

        );

$styleArray2 = array(
	    'font' => array(
				'size'=>12,
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
				'size'=>12,
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
		$object->setCellValue(chr($cell_temp+1).'3',$PackingList->customer_name."(".$PackingList->customer_short_name.")")->getStyle(chr($cell_temp+1).'3')->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
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
		
		$t=(ceil($cell_spacing_for_3[0]/2));
		$cell_temp=64+$t;
		$cell_temp1=$cell_temp+($cell_spacing_for_3[0]-$t);
		$object->mergeCells('A7:'.$max_cell_no.'7');
        $object->setCellValue("A7", "OTHER DETAILS")->getStyle("A7")->applyFromArray($styleArray);

			/********************** Pre Carrier  DETAILS  *************************/
		$object->mergeCells('A8:'.chr($cell_temp).'8');
		$object->setCellValue("A8", "Place Of Pre Carrier:")->getStyle("A8")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('A9:'.chr($cell_temp).'9');
		$object->setCellValue("A9", $PackingList->place_for_pre_carrier)->getStyle("A9")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		

		$object->mergeCells(chr($cell_temp+1).'8:'.chr($cell_temp1).'8');
		$object->setCellValue(chr($cell_temp+1)."8", "Pre Carriage By:")->getStyle(chr($cell_temp+1)."8")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells(chr($cell_temp+1).'9:'.chr($cell_temp1).'9');
		$object->setCellValue(chr($cell_temp+1)."9", $PackingList->pre_carriage_by)->getStyle(chr($cell_temp+1)."9")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);

		$cell_temp=64+$cell_spacing_for_3[0];
		$object->mergeCells('A10:'.chr($cell_temp).'10');
		$object->setCellValue("A10", "Terms of Payment :")->getStyle("A10")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('A11:'.chr($cell_temp).'11');
		$object->setCellValue("A11", $PackingList->term_of_payment)->getStyle("A11")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		
		
		/********************** Exporter Country  DETAILS  *************************/
		
		$t=(ceil($cell_spacing_for_3[1]/2));
		$t2=$cell_spacing_for_3[1]-$t;
		$object->mergeCells(chr($cell_temp+1).'8:'.chr($cell_temp+$t).'8');
		$object->setCellValue(chr($cell_temp+1)."8", "Country of Origin:")->getStyle(chr($cell_temp+1)."8")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells(chr($cell_temp+1).'9:'.chr($cell_temp+$t).'9');
		$object->setCellValue(chr($cell_temp+1)."9", $PackingList->company_country_name)->getStyle(chr($cell_temp+1)."9")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		

		$object->mergeCells(chr($cell_temp+$t+1).'8:'.chr($cell_temp+$t+$t2).'8');
		$object->setCellValue(chr($cell_temp+$t+1)."8", "Port of Loading:")->getStyle(chr($cell_temp+$t+1)."8")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells(chr($cell_temp+$t+1).'9:'.chr($cell_temp+$t+$t2).'9');
		$object->setCellValue(chr($cell_temp+$t+1)."9", $PackingList->port_name)->getStyle(chr($cell_temp+$t+1)."9")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);

		
		$object->mergeCells(chr($cell_temp+1).'10:'.chr($cell_temp+$cell_spacing_for_3[1]).'10');
		$object->setCellValue(chr($cell_temp+1)."10", "Notify Party / Buyer :")->getStyle(chr($cell_temp+1)."10")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells(chr($cell_temp+1).'11:'.chr($cell_temp+$cell_spacing_for_3[1]).'11');
		$object->setCellValue(chr($cell_temp+1)."11",'')->getStyle(chr($cell_temp+1)."11")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		$cell_temp+=$cell_spacing_for_3[1];

		/********************** Customer Country  DETAILS  *************************/
		
		$t=(ceil($cell_spacing_for_3[2]/2));
		$t2=$cell_spacing_for_3[2]-$t;
		$object->mergeCells(chr($cell_temp+1).'8:'.chr($cell_temp+$t).'8');
		$object->setCellValue(chr($cell_temp+1)."8", "Final Country:")->getStyle(chr($cell_temp+1)."8")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells(chr($cell_temp+1).'9:'.chr($cell_temp+$t).'9');
		$object->setCellValue(chr($cell_temp+1)."9", $PackingList->country_name)->getStyle(chr($cell_temp+1)."9")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		

		$object->mergeCells(chr($cell_temp+$t+1).'8:'.chr($cell_temp+$t+$t2).'8');
		$object->setCellValue(chr($cell_temp+$t+1)."8", "Port of Discharge:")->getStyle(chr($cell_temp+$t+1)."8")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells(chr($cell_temp+$t+1).'9:'.chr($cell_temp+$t+$t2).'9');
		$object->setCellValue(chr($cell_temp+$t+1)."9", $PackingList->discharge_name)->getStyle(chr($cell_temp+$t+1)."9")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);

		
		$object->mergeCells(chr($cell_temp+1).'10:'.chr($cell_temp+$cell_spacing_for_3[2]).'10');
		$object->setCellValue(chr($cell_temp+1)."10", "Final Destination :")->getStyle(chr($cell_temp+1)."10")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells(chr($cell_temp+1).'11:'.chr($cell_temp+$cell_spacing_for_3[2]).'11');
		$object->setCellValue(chr($cell_temp+1)."11",$PackingList->country_name)->getStyle(chr($cell_temp+1)."11")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		

		/********************** Item Category  *************************/
		$t=ceil($total_cell/2);
		$cell_temp=64+$t;
		$t2=$total_cell-$t;
		
		
		
		$object->mergeCells('A12:'.chr($cell_temp).'12');
		$object->setCellValue("A12", "Item Category :")->getStyle("A12")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('A13:'.chr($cell_temp).'14');
		$object->setCellValue("A13",$item_categorylist)->getStyle("A13")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);

		$object->mergeCells(chr($cell_temp+1).'12:'.chr($cell_temp+$t2).'12');
		$object->setCellValue(chr($cell_temp+1)."12", "CET / CTH :")->getStyle(chr($cell_temp+1)."12")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells(chr($cell_temp+1).'13:'.chr($cell_temp+$t2).'14');
		$object->setCellValue(chr($cell_temp+1)."13","")->getStyle(chr($cell_temp+1)."13")->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);

		/********************** Table Header  *************************/	
		$object->mergeCells('A15:A16');
		$object->setCellValue("A15","P NO")->getStyle("A15")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('B15:C16');
		$object->setCellValue("B15","Ctn. Range")->getStyle("B15")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('D15:F16');
		$object->setCellValue("D15","Description of Goods")->getStyle("D15")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('G15:G16');
		$object->setCellValue("G15","Ctn. Nos")->getStyle("G15")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('H15:H16');
		$object->setCellValue("H15","Qty / Ctn.")->getStyle("H15")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$object->mergeCells('I15:I16');
		$object->setCellValue("I15","Total Qty")->getStyle("I15")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);

		
		
		$cell_temp=73;
		foreach($extracolumn as $post): 
			 $cell_temp++;       
			 $object->mergeCells(chr($cell_temp)."15".":".chr($cell_temp)."16");        
		    $object->setCellValue(chr($cell_temp)."15",$post->metal_name." Net( (Kgs)")->getStyle(chr($cell_temp)."15")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		endforeach;
		$cell_temp++; 
		$object->mergeCells(chr($cell_temp)."15".":".chr($cell_temp)."16");        
		 $object->setCellValue(chr($cell_temp)."15","Total Net (Kgs)")->getStyle(chr($cell_temp)."15")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		 
		 $cell_temp++;
		 $object->mergeCells(chr($cell_temp)."15".":".chr($cell_temp)."16");        
		$object->setCellValue(chr($cell_temp)."15","Gross We. (Kgs)")->getStyle(chr($cell_temp)."15")->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
 				$x=16;
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
					$total_cartons=$post->carton_range_end-$post->carton_range_start+1;
				
				
						 if($temp=="" || $temp!=$post->pellet)
						{
							$pellet_count++;
							$temp=$post->pellet;
							
							$object->mergeCells(chr($cell_temp).$x.':'.chr($cell_temp).($x+(($post->pellet_count-1)>0?($post->pellet_count-1):0)));
						$object->setCellValue(chr($cell_temp).$x,$post->pellet)->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
					
						 }
						 
						 $cell_temp++;
					 if($temp_cr_range=="" || $temp_cr_range!=intval($post->carton_range_end).":".intval($post->carton_range_start)){
						
						 	$object->mergeCells(chr($cell_temp).$x.':'.chr($cell_temp+1).($x+(($post->same_caton_count-1)>=1?($post->same_caton_count-1):0)));
					
					$object->setCellValue(chr($cell_temp).$x,"SE-".str_pad(intval($post->carton_range_start), 2, '0', STR_PAD_LEFT)." to SE-".str_pad(intval($post->carton_range_end), 2, '0', STR_PAD_LEFT))->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
					
					 }
					 $cell_temp+=2;
					 $object->mergeCells(chr($cell_temp).$x.':'.chr($cell_temp+2).$x);
					 	$object->setCellValue(chr($cell_temp).$x,$post->unique_no." - ".$post->item_name)->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
					$cell_temp+=3;
					if($temp_cr_range=="" || $temp_cr_range!=intval($post->carton_range_end).":".intval($post->carton_range_start)){
						$gross_total_cartons+=$total_cartons;
					
						$temp_cr_range=intval($post->carton_range_end).":".intval($post->carton_range_start);
						$object->mergeCells(chr($cell_temp).$x.':'.chr($cell_temp).($x+(($post->same_caton_count -1)>0?($post->same_caton_count-1):0)));
					$object->setCellValue(chr($cell_temp).$x,$total_cartons)->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
					 }
					 $cell_temp++;
					 $object->setCellValue(chr($cell_temp).$x,(float)$post->one_carton_pcs)->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
					 $cell_temp++;
					 $object->setCellValue(chr($cell_temp).$x,(float)($total_cartons*$post->one_carton_pcs))->getStyle(chr($cell_temp).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
										$totalqty =($total_cartons*$post->one_carton_pcs);
					$total_metal_Weight=0;
					
					for($i=0;$i<count($extracolumn);$i++):
					echo $extracolumn[$post->itemid][$extracolumn[$i]->metal_name];
						$metal_weight_post=(float)$itemlist[$post->itemid][$extracolumn[$i]->metal_name];
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
					 $total_temp=sprintf("%0.3f",($post->total_carton_weight + $post->total_box_weight + $post->total_plastic_weight + $total_metal_Weight)); 
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

						$x++;
						$object->mergeCells(chr(64+$total_cell-3).$x.":".chr(64+$total_cell-1).$x);
						$object->setCellValue(chr(64+$total_cell-3).$x,'Total Weight Of Pallet:')->getStyle(chr(64+$total_cell-3).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);               
						$object->setCellValue(chr(64+$total_cell).$x,(float)$PackingList->weight_of_total_pellet)->getStyle(chr(64+$total_cell).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);               
						$x++;
						$object->mergeCells(chr(64+$total_cell-3).$x.":".chr(64+$total_cell-1).$x);
						$object->setCellValue(chr(64+$total_cell-3).$x,'Total Gross Weight:')->getStyle(chr(64+$total_cell-3).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);               
						$object->setCellValue(chr(64+$total_cell).$x,(float)($total_gross_weight+$packinglist->weight_of_total_pellet))->getStyle(chr(64+$total_cell).$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);               

		/********************** IEC  Details     *************************/
		$y=$x;
		$x++;
		$iec_date=date_create_from_format('Y-m-d',$PackingList->iec_date);
    	$iec_date=date_format($iec_date,'d-m-Y');
		$cell_temp=64+$cell_spacing_for_3[0];
		$object->mergeCells('A'.$x.':'.chr($cell_temp).$x);
		$object->setCellValue("A".$x, "IEC Code No.:".$PackingList->iec_code.", Dt.".$iec_date)->getStyle("A".$x)->applyFromArray($styleArray1)->getAlignment()->setWrapText(true);
		$x++;
		$object->mergeCells('A'.$x.':'.chr($cell_temp).$x);
		$object->setCellValue("A".$x,"ARN:".$PackingList->company_anr_no)->getStyle('A'.$x)->applyFromArray($styleArray2)->getAlignment()->setWrapText(true);
		
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

	public function View_PackingList($id=0)
	{
		$temp="";
		$temparr=array();
		$params=array();
			if($id==0)
			{
				redirect('PackingList');
			}
			$params['Extracolumn']=$this->Queries->getRecord('SELECT `metal_name` FROM '.TBL_CUSTOMER_ITEM_SUB.' WHERE isdelete=0  and itemid in (select itemid from '.TBL_PACKINGLIST_SUB.' where isdelete=0 and packingid='.$id.') GROUP BY `metal_name`');
			
			$params['packinglist']=$this->PackingList->getSinglePacklist($id);
			$params['PackinglistSub']=$this->PackingList->viewPackingSubList($id);
			//echo $this->db->last_query();
			
			$query="SELECT itemid,metal_name,weight FROM ".TBL_CUSTOMER_ITEM_SUB." WHERE isdelete=0 and itemid in (select itemid from ".TBL_PACKINGLIST_SUB." where isdelete=0 and packingid=".$id.") GROUP BY metal_name,itemid ORDER BY itemid,metal_name";
			$res=$this->Queries->getRecord($query);
			//$params['Itemlist']=
			foreach($res as $post){				 
				$temparr[$post->itemid][$post->metal_name]=$post->weight;
			}

			
			$params['ItemList']=$temparr;
			$params['id']=$id;
			$this->load->view('PackingList/view_packinglist',$params);
	}

	public function PackingListReport($id=0)
	{
		$temp="";
		$temparr=array();
		$params=array();
			if($id==0)
			{
				redirect('PackingList');
			}
			$params['Extracolumn']=$this->Queries->getRecord('SELECT `metal_name` FROM '.TBL_CUSTOMER_ITEM_SUB.' WHERE isdelete=0  and itemid in (select itemid from '.TBL_PACKINGLIST_SUB.' where isdelete=0 and packingid='.$id.') GROUP BY `metal_name`');
			
			$params['packinglist']=$this->PackingList->getSinglePacklistForPrint($id);
			$params['PackinglistSub']=$this->PackingList->viewPackingSubList($id);
			
			$query="select orderno from ".TBL_ORDER." where isdelete=0 and id in(".$params['packinglist']->customer_order.")";
			$res =$this->Queries->getRecord($query);
			$params['ordernolist'] = join(',', array_map(function($x){return $x->orderno; }, $res));


				$item_nolist= join(',', array_map(function($x){return $x->itemid; }, $params['PackinglistSub']));
				
			if($item_nolist!="")
			{$query="select category_name from ".TBL_ITEM_CATEGORY." where isdelete=0 and id in (select item_category  from ".TBL_CUSTOMER_ITEM." where isdelete=0 and id in(".$item_nolist."))";
			$res=$this->Queries->getRecord($query);
			$params['item_categorylist']= join(',', array_map(function($x){return $x->category_name; }, $res));

			}else{
				$params['item_categorylist']="";
			}
			

			$query="SELECT itemid,metal_name,weight FROM ".TBL_CUSTOMER_ITEM_SUB." WHERE isdelete=0 and itemid in (select itemid from ".TBL_PACKINGLIST_SUB." where isdelete=0 and packingid=".$id.") GROUP BY metal_name,itemid ORDER BY itemid,metal_name";
			$res=$this->Queries->getRecord($query);
			
			foreach($res as $post){				 
				$temparr[$post->itemid][$post->metal_name]=$post->weight;
			}

			$params['pdf']=base_url()."PackingList/pdf/".$id;
			$params['ItemList']=$temparr;
			$params['id']=$id;
			$this->load->view('PackingList/packing_list_report',$params);
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
			$params['Extracolumn']=$this->Queries->getRecord('SELECT `metal_name` FROM '.TBL_CUSTOMER_ITEM_SUB.' WHERE isdelete=0  and itemid in (select itemid from '.TBL_PACKINGLIST_SUB.' where isdelete=0 and packingid='.$id.') GROUP BY `metal_name`');
			
			$params['packinglist']=$this->PackingList->getSinglePacklistForPrint($id);
			$params['PackinglistSub']=$this->PackingList->viewPackingSubList($id);
			
			$query="select orderno from ".TBL_ORDER." where isdelete=0 and id in(".$params['packinglist']->customer_order.")";
			$res =$this->Queries->getRecord($query);
			$params['ordernolist'] = join(',', array_map(function($x){return $x->orderno; }, $res));


				$item_nolist= join(',', array_map(function($x){return $x->itemid; }, $params['PackinglistSub']));
				
			if($item_nolist!="")
			{$query="select category_name from ".TBL_ITEM_CATEGORY." where isdelete=0 and id in (select item_category  from ".TBL_CUSTOMER_ITEM." where isdelete=0 and id in(".$item_nolist."))";
			$res=$this->Queries->getRecord($query);
			$params['item_categorylist']= join(',', array_map(function($x){return $x->category_name; }, $res));

			}else{
				$params['item_categorylist']="";
			}
			

			$query="SELECT itemid,metal_name,weight FROM ".TBL_CUSTOMER_ITEM_SUB." WHERE isdelete=0 and itemid in (select itemid from ".TBL_PACKINGLIST_SUB." where isdelete=0 and packingid=".$id.") GROUP BY metal_name,itemid ORDER BY itemid,metal_name";
			$res=$this->Queries->getRecord($query);
			
			foreach($res as $post){				 
				$temparr[$post->itemid][$post->metal_name]=$post->weight;
			}

			
			$params['ItemList']=$temparr;
			$params['id']=$id;
				
			$html=$this->load->view('PackingList/pdf',$params,true);
			$this->load->library('Pdf'); 	 
			$filename="packinglist".date('Ymdhis')."pdf";
			$this->pdf->create($html,$filename);
	}
	
}

