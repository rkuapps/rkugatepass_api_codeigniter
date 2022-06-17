<?php
class Outword extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(Jobwork_challan_model);
        
        if (!isset($this->session->userdata['logged_in'])) {
            redirect('');
        }
    }
    public function index()
    {
        $params['outwordlist']=$this->Jobwork_challan_model->getOutwordlist();
        $this->load->view('Jobwork_challan/outword/index',$params);
    }
    public function add($id=0)
    {
        $params['id']=$id;
        if($id !='' and $id!=0)
        {
			if (!check_role_assigned('jobwork_challan', 'edit')) {
				redirect('forbidden');
			}
            $query="select * from ".TBL_JOBWORK_OUTWORD." where isdelete=0 AND id=".$id;
            $params['outword']=$this->Queries->getSingleRecord($query);
            $query='select * from '.TBL_JOBWORK_OUTWORD_SUB." where isdelete=0 AND outword_id=".$id;
            $params['outworditems']=$this->Jobwork_challan_model->getsubOutwordList($id);
        }
		if (!check_role_assigned('jobwork_challan', 'add')) {
			redirect('forbidden');
		}
        $query="select id, jw_itemname from " . TBL_CUSTOMER_ITEM . " where isdelete=0 and jw_itemname is not null";
        $params['itemlist']=$this->Queries->get_tab_list($query,'id','jw_itemname');
        $query="select * from ".TBL_JOBWORKER_MASTER." where isdelete=0";
        $params['jobworkerlist']=$this->Queries->get_tab_list($query,'id','company_name');
        $params['Statuslist']=array('0'=>'Open','1'=>'Close');

		// Generating of Outword Challan No.
		$finname = $this->session->userdata["financial_year"]["name"];
		$params['challan_no']=$finname.'/'.sprintf('%04d',1);

		$query="select * from ". TBL_JOBWORK_OUTWORD. " ORDER BY id DESC LIMIT 1";
		$po=$this->Queries->getSingleRecord($query);
		if(count($po)>0)
		{
			$pod=explode('/',$po->challan_no);
			$params['challan_no']=$finname.'/'.sprintf('%04d',$pod[1]+1);
		}

        $this->load->view('Jobwork_challan/outword/add',$params);
    }
    public function save()
    {
        $this->form_validation->set_rules('outword_date', 'Date', 'required');
        if ($this->form_validation->run()) {
            
            $challan_date = date_create_from_format('d/m/Y',$this->input->post('outword_date'));
			$challan_date = date_format($challan_date,'Y-m-d');
            $jobworker_id= StringRepair($this->input->post('jobworkerid'));
            $challan_no= StringRepair($this->input->post('challan_no'));
			$dispatched_by=StringRepair($this->input->post('dispatched_by'));
			$place_to_supply=StringRepair($this->input->post('place_supply'));
			$freight_terms=StringRepair($this->input->post('freight_term'));
            $status= StringRepair($this->input->post('status'));
			$amount=StringRepair($this->input->post('challan_amount'));
            $expected_item=implode(',',$this->input->post('expected_item'));
            $note=StringRepair($this->input->post('note'));
            $id = $this->input->post('id');
			$today = date('Y-m-d H:i:s');
			$close_date='';
			if($status==1)
			{
				$close_date=date('Y-m-d');
			}
            if($id!='' && $id!=0)
            {
                $form_data=array(
                    'jobworker_id'=>$jobworker_id,
                    'challan_date'=>$challan_date,
					'dispatched_by'=>$dispatched_by,
					'place_to_supply'=>$place_to_supply,
					'freight_terms'=>$freight_terms,
					'amount'=>$amount,
                    'status'=>$status,
					'challan_close_date'=>$close_date,
                    'expected_item'=>$expected_item,
                    'note'=>$note,
                    'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
                );
                if ($this->Queries->updateRecord(TBL_JOBWORK_OUTWORD, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Outword Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Outword');
				endif;
				$pid=$id;
            }
            else{
                $form_data=array(
                    'jobworker_id'=>$jobworker_id,
                    'challan_date'=>$challan_date,
                    'challan_no'=>$challan_no,
					'dispatched_by'=>$dispatched_by,
					'place_to_supply'=>$place_to_supply,
					'freight_terms'=>$freight_terms,
					'amount'=>$amount,
                    'status'=>$status,
                    'expected_item'=>$expected_item,
                    'note'=>$note,
                    'created_by' => $this->session->userdata['logged_in']['userid'],
                    'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
                );
                if ($this->Queries->addRecord(TBL_JOBWORK_OUTWORD, $form_data)) :
					$pid=$this->db->insert_id();
					
					$this->session->set_flashdata('success_msg', 'Outword Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Outword');
				endif;
				
            }
            return redirect('Jobwork_challan/outword/add/'.$pid);
        }
    }

/************************************** Get Single Item  ***********************************************/

public function SingleItem($id)
{
    $res=0;
    if($id!="" && $id!=0){
        $query="select id,outword_id,item_id,process,weight,bags,rate,amount from ".TBL_JOBWORK_OUTWORD_SUB." where isdelete=0 and id=".$id;
            $res=$this->Queries->getSingleRecord($query);
    }
echo json_encode($res);
}

/************************************** Save Order Item **************************************************/
	public function saveItem()
	{
		
		$html="";
		$arr=array();
		$arr['status']=0;
		$description="";

		$this->form_validation->set_rules('outwordid', 'outwordid', 'required');
		if ($this->form_validation->run()) {

			$subid=StringRepair($this->input->post('subid'));
			$outwordid=StringRepair($this->input->post('outwordid'));
			$item_id = StringRepair($this->input->post('item_id'));
			$process=StringRepair($this->input->post('process'));
			$weight = StringRepair($this->input->post('weight'));
			$bags = StringRepair($this->input->post('bags'));
			$rate = StringRepair($this->input->post('rate'));
			$amount = StringRepair($this->input->post('amount'));
		

			if($subid!=0 && $subid!="")
			{
				$form_data=array(
				'item_id'=>$item_id,
				'process'=>$process,
				'weight'=>$weight,
				'bags'=>$bags,
				'rate'=>$rate,
				'amount'=>$amount,
				);
			
				if ($this->Queries->updateRecord(TBL_JOBWORK_OUTWORD_SUB, $form_data,$subid)) :
				$arr['status']=2;
				endif;

				$result=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER_ITEM.' where isdelete=0 and id='.$item_id);
				$itemresult=$this->Queries->getSingleRecord('select * from '.TBL_JOBWORK_OUTWORD_SUB.' where isdelete=0 and id='.$subid);
				
				$html.="
					<td>".$result->jw_itemname."</td>
					<td>".$result->hsn_code."</td>
					<td>".$itemresult->process."</td>
					<td>".$itemresult->bags."</td>
					<td>".$itemresult->weight."</td>
					<td>".$itemresult->rate."</td>
					<td>".$itemresult->amount."</td>
					<td>
						<div class=btn-group><a href='javascript:void(0)' class='btn btn-warning btn-xs  edittr' data-id='".$subid."'><span class='fa fa-edit'></span></a>
						</div>
						<div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='".$subid."'><span class='fa fa-minus'></span></a>
						</div>
					</td>	
				";

			}else{
			$form_data=array(
			'outword_id'=>$outwordid,
			'process'=>$process,
			'item_id'=>$item_id,
			'weight'=>$weight,
			'bags'=>$bags,
			'rate'=>$rate,
			'amount'=>$amount,
			);
			
				if ($this->Queries->addRecord(TBL_JOBWORK_OUTWORD_SUB, $form_data)) :
				$arr['status']=1;
				endif;
				$id=$this->db->insert_id();

				$result=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER_ITEM.' where isdelete=0 and id='.$item_id);
				$itemresult=$this->Queries->getSingleRecord('select * from '.TBL_JOBWORK_OUTWORD_SUB.' where isdelete=0 and id='.$id);
			
		
				$html.="
				    <tr id='item_tr_".$id."'>
                        <td>".$result->jw_itemname."</td>
						<td>".$result->hsn_code."</td>
						<td>".$itemresult->process."</td>
						<td>".$itemresult->bags."</td>
						<td>".$itemresult->weight."</td>
						<td>".$itemresult->rate."</td>
						<td>".$itemresult->amount."</td>
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
    /*********************************** Delete Item from Order *****************************************/
	public function deleteItem()
	{
		if (!check_role_assigned('jobwork_challan', 'delete')) {
			redirect('forbidden');
		}
        $html="";
		$arr=array();
		$arr['status']=0;

		
			$id = StringRepair($this->input->post('id'));
			
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_JOBWORK_OUTWORD_SUB, $form_data, $id)) :
			$arr['status']=1;
		endif;			
			
		

		echo json_encode($arr);
	}
/********************************************* Delete Outword Entry **************************************/
public function delete($id)
	{
		if (!check_role_assigned('jobwork_challan', 'delete')) {
			redirect('forbidden');
		}
		$today = date('Y-m-d H:i:s');
		$form_data = array(
			'isdelete' => 1,
			'updated_by' => $this->session->userdata['logged_in']['userid'],
			'updated_on' => $today
		);
		if ($this->Queries->updateRecord(TBL_JOBWORK_OUTWORD, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Outword Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Outword');
		endif;

		return redirect('Jobwork_challan/outword/');
	}
	/**************************************Print Challan ************************************************/
public function Print($id=0)
{
		if (!check_role_assigned('quotation', 'view')) {
		redirect('forbidden');
	}
	$params = array();
	$params['challandetail']=$this->Jobwork_challan_model->getSingleOutword($id);
	$params['itemList'] = $this->Jobwork_challan_model->getsubOutwordList($id) ;
	$this->load->view('Jobwork_challan/outword/Print', $params);

}

}   