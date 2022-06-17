<?php
class Inword extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(Jobwork_challan_model);
        
        if (!isset($this->session->userdata['logged_in'])) {
            redirect('');
        }
    }
    public function index($id=0)
    {
        $params['outwordid']=$id;
        $params['Inwordlist']=$this->Jobwork_challan_model->getInwordlist($id);
        $params['outworditemlist']=$this->Jobwork_challan_model->getsubOutwordList($id);
		$params['outworddata']=$this->Jobwork_challan_model->getSingleOutword($id);
       
        $this->load->view('Jobwork_challan/Inword/index',$params);
    }
    public function add($outwordid,$id=0)
    {
        $params['id']=$id;
        $params['outwordid']=$outwordid;
        if($id !='' and $id!=0)
        {
			if (!check_role_assigned('jobwork_challan', 'edit')) {
				redirect('forbidden');
			}
            $query="select * from ".TBL_JOBWORK_INWORD." where isdelete=0 AND id=".$id;
            $params['outword']=$this->Queries->getSingleRecord($query);
            $query='select * from '.TBL_JOBWORK_INWORD_SUB." where isdelete=0 AND inword_id=".$id;
            $params['Inworditems']=$this->Jobwork_challan_model->getsubInwordList($id);
        }
        if (!check_role_assigned('jobwork_challan', 'add')) {
			redirect('forbidden');
		}
        $params['outworddata']=$this->Jobwork_challan_model->getSingleOutword($outwordid);
		$query = "select item_id from ".TBL_JOBWORK_OUTWORD_SUB." where isdelete=0 and outword_id=".$outwordid." group by item_id";
		$res = $this->Queries->getRecord($query);
		$arr = array();
		foreach($res as $post){
			array_push($arr,$post->item_id);
		}
		$outitems = implode(',',$arr);

        $query="select id,jw_itemname from " . TBL_CUSTOMER_ITEM . " where isdelete=0 and id in ($outitems) and jw_itemname is not null";
        $params['itemlist']=$this->Queries->get_tab_list($query,'id','jw_itemname');
        $query="select * from ".TBL_JOBWORKER_MASTER." where isdelete=0";
        $params['jobworkerlist']=$this->Queries->get_tab_list($query,'id','company_name');
        $params['Statuslist']=array('0'=>'open','1'=>'close');
        $this->load->view('Jobwork_challan/Inword/add',$params);
    }
    public function save()
    {
        $this->form_validation->set_rules('inword_date', 'Date', 'required');
        if ($this->form_validation->run()) {
            
            $challan_date = date_create_from_format('d/m/Y',$this->input->post('inword_date'));
			$challan_date = date_format($challan_date,'Y-m-d');
            $jobworker_id= StringRepair($this->input->post('jobworkerid'));
            $challan_no= StringRepair($this->input->post('challan_no'));
            $status= StringRepair($this->input->post('status'));
            $expected_item=implode(',',$this->input->post('expected_item'));
            $note=StringRepair($this->input->post('note'));
            $id = $this->input->post('id');
			$outwordid = $this->input->post('outwordid');
            $today = date('Y-m-d H:i:s');
            if($id!='' && $id!=0)
            {
                $form_data=array(
                    
                    'inword_date'=>$challan_date,
                    'challan_no'=>$challan_no,
                    'outword_id'=>$outwordid,
                    'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
                );
                if ($this->Queries->updateRecord(TBL_JOBWORK_INWORD, $form_data, $id)) :
					$this->session->set_flashdata('success_msg', 'Inword Updated Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Update Inword');
				endif;
				$pid=$id;
            }
            else{
                $form_data=array(
                    'inword_date'=>$challan_date,
                    'challan_no'=>$challan_no,
                    'outword_id'=>$outwordid,
                    'created_by' => $this->session->userdata['logged_in']['userid'],
                    'updated_by' => $this->session->userdata['logged_in']['userid'],
					'updated_on' => $today
                );
                if ($this->Queries->addRecord(TBL_JOBWORK_INWORD, $form_data)) :
					$this->session->set_flashdata('success_msg', 'Inword Added Successfully');
				else :
					$this->session->set_flashdata('error_msg', 'Failed To Add Inword');
				endif;
				$pid=$this->db->insert_id();
            }
            
        }
        return redirect('Jobwork_challan/Inword/add/'.$outwordid.'/'.$pid);
    }

/************************************** Get Single Item  ***********************************************/

public function SingleItem($id)
{
    $res=0;
  
    if($id!="" && $id!=0){
        $query="select id,inword_id,item_id,qty,weight from ".TBL_JOBWORK_INWORD_SUB." where isdelete=0 and id=".$id;
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

		$this->form_validation->set_rules('inwordid', 'inwordid', 'required');
		if ($this->form_validation->run()) {

			$subid=StringRepair($this->input->post('subid'));
			$inwordid=StringRepair($this->input->post('inwordid'));
			$item_id = StringRepair($this->input->post('item_id'));
			$weight = StringRepair($this->input->post('weight'));
            $outwordid=StringRepair($this->input->post('outwordid'));

			if($subid!=0 && $subid!="")
			{
			$form_data=array(
			// 'cid'=>$cid,
			// 'subid'=>$subid,
			'item_id'=>$item_id,
			'weight'=>$weight,
			);
			// print_r($form_data);exit;tbl_quotation_sub
				if ($this->Queries->updateRecord(TBL_JOBWORK_INWORD_SUB, $form_data,$subid)) :
				$arr['status']=2;
				endif;

				
				$result=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER_ITEM.' where isdelete=0 and id='.$item_id);
				
				//<td>".$discount."</td>
				$html.="
					<td>".$result->jw_itemname."</td>
					<td>".$result->hsn_code."</td>
					<td>".$weight."</td>
					<td>
						<div class=btn-group><a href='javascript:void(0)' class='btn btn-warning btn-xs  edittr' data-id='".$subid."'><span class='fa fa-edit'></span></a>
						</div>
						<div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='".$subid."'><span class='fa fa-minus'></span></a>
						</div>
					</td>	
				";

			}else{
			$form_data=array(
			// 'fin_id'=>$fin_id,
			'inword_id'=>$inwordid,
            'outword_id'=>$outwordid,
			'item_id'=>$item_id,
			'weight'=>$weight,
			);
			
				if ($this->Queries->addRecord(TBL_JOBWORK_INWORD_SUB, $form_data)) :
				$arr['status']=1;
				endif;
				$id=$this->db->insert_id();
				$result=$this->Queries->getSingleRecord('select * from '.TBL_CUSTOMER_ITEM.' where isdelete=0 and id='.$item_id);
			
				// echo $cid;
				// echo $this->db->last_query();
			
				
				$html.="
				    <tr id='item_tr_".$id."'>
					<td>".$result->item_name." (".$result->unique_no.")</td>
					<td>".$result->hsn_code."</td>
						<td>".$weight."</td>
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
		// 		$form_data = array(
		// 	'total' => $arr['total'],
		// 	'updated_by' => $this->session->userdata['logged_in']['userid'],
		// 	'updated_on' => $today
		// );

		// $this->Queries->updateRecord(TBL_ORDER, $form_data, $orderid);
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
		if ($this->Queries->updateRecord(TBL_JOBWORK_INWORD_SUB, $form_data, $id)) :
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
		if ($this->Queries->updateRecord(TBL_JOBWORK_INWORD, $form_data, $id)) :
			$this->session->set_flashdata('success_msg', 'Outword Deleted Successfully');
	
		else :
			$this->session->set_flashdata('error_msg', 'Failed To Delete Outword');
		endif;

		return redirect('Jobwork_challan/Inword/');
	}
}   