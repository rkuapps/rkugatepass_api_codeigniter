<?php
class JobWOrkReport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_in'])) {
            redirect('');
        }
        $this->load->model('Report_model', 'REPORT');
    }

    public function index()
    {
        $params = array();
        $searchtxt = array();

        if (!check_role_assigned('jobwork_report', 'view')) {
            redirect('forbidden');
        }

        $data=$this->input->post();
        if(isset($data['reset']))
        {
            $sdate='';
            $edate='';
            $jw_id=0;
            $itemcategory=0;
            $item=0;
        }
        else{
            $sdate=date_create_from_format('d/m/Y',$this->input->post('start_date'));
            $sdate=date_format($sdate,'Y-m-d');
            $edate=date_create_from_format('d/m/Y',$this->input->post('end_date'));
            $edate=date_format($edate,'Y-m-d');
            $jw_id=$this->input->post('jobworker');
            $itemcategory=$this->input->post('itemcategory');
            $item=$this->input->post('item');
            
        }
        if($sdate=='' && $edate=='')
        {
            $sdate=date("Y-m-01");
            $edate=date('Y-m-d');
        }
        $filter=array(
            'sdate'=>$sdate,
            'edate'=>$edate,
            'jobworker'=>$jw_id,
            'itemcategory'=>$itemcategory,
            'item'=>$item
        );
        
        $this->session->set_userdata('jwreport_filter',$filter);
        $query='select * from '.TBL_JOBWORKER_MASTER.' where isdelete=0';
        $params['jobworkerlist']=$this->Queries->get_tab_list($query,'id','company_name');
        $query='select * from '.TBL_CUSTOMER_ITEM.' where isdelete=0';
        $params['itemlist']=$this->Queries->get_tab_list($query,'id','item_name');
        $query='select * from '.TBL_ITEM_SUBCATEGORY.' where isdelete=0';
        $params['categorylist']=$this->Queries->get_tab_list($query,'id','subcategory_name');
        $jwfilter='';
        $itemcategoryfilter='';
        $itemfilter='';
        if($jw_id!='' && $jw_id!=0)
        {
            $jwfilter='jwout.jobworker_id ='.$jw_id.' AND';
        }
        if($itemcategory!='' && $itemcategory!=0)
        {
            $itemcategoryfilter='item.item_subcategory = '.$itemcategory.' AND';
        }
        if($item!='' && $item!=0)
        {
            $itemfilter=' jwoutsub.item_id ='.$item.' AND';
        }
        // $query = 'select 
        //             jwoutsub.id,
        //             jwm.company_name,
        //             item.item_name,
        //             itemsub.subcategory_name,
        //             sum(jwoutsub.weight) as out_weigh,
        //             sum(jwinsub.weight) as in_weigh,
        //             jwout.challan_close_date,
        //             jwoutsub.outword_id,
        //             jwoutsub.item_id,
        //             item.item_subcategory,
        //             jwout.jobworker_id
        //         FROM 
        //             ' . TBL_JOBWORKER_MASTER . ' AS jwm
        //             left join ' . TBL_JOBWORK_OUTWORD . ' AS jwout on jwm.id=jwout.jobworker_id
        //             left join ' . TBL_JOBWORK_OUTWORD_SUB . ' AS jwoutsub on jwout.id=jwoutsub.outword_id
        //             left join ' . TBL_JOBWORK_INWORD_SUB . ' as jwinsub on jwoutsub.item_id=jwinsub.item_id
        //             left join ' . TBL_CUSTOMER_ITEM . ' as item on jwoutsub.item_id=item.id
        //             left join ' . TBL_ITEM_SUBCATEGORY . ' as itemsub on item.item_subcategory=itemsub.id 
        //         WHERE 
        //             jwoutsub.item_id = item.id AND
        //             jwout.jobworker_id = jwm.id AND
        //             jwoutsub.outword_id = jwout.id AND
        //             item.item_subcategory = itemsub.id AND
        //             jwinsub.outword_id = jwout.id AND
        //             jwinsub.item_id = jwoutsub.item_id AND
        //             jwout.status = 1
        //         group by
        //             jwout.jobworker_id,
        //             item.item_subcategory,
        //             jwoutsub.item_id,jwinsub.item_id';
        $query = "SELECT 
                    jwoutsub.id,
                    jwm.company_name,
                    item.item_name,
                    itemsub.subcategory_name,
                    sum(jwoutsub.weight) as out_weight,
                    sum(jwinsub.weight) as in_weight,
                    jwout.challan_close_date,
                    jwoutsub.outword_id,
                    jwoutsub.item_id,
                    item.item_subcategory,
                    jwout.jobworker_id
                FROM 
                    tbl_jobworker_master AS jwm,
                    tbl_jobwork_outword AS jwout,
                    tbl_jobwork_outword_sub AS jwoutsub,
                    tbl_jobwork_inword_sub AS jwinsub,
                    tbl_customer_item as item,
                    tbl_item_subcategory as itemsub
                WHERE
                    jwoutsub.item_id = item.id AND
                    jwout.jobworker_id = jwm.id AND
                    jwoutsub.outword_id = jwout.id AND
                    item.item_subcategory = itemsub.id AND
                    jwinsub.outword_id = jwout.id AND
                    jwinsub.item_id = jwoutsub.item_id AND
                    ".$jwfilter."
                    ".$itemcategoryfilter."
                    ".$itemfilter."
                    jwout.status = '1' AND
                    jwout.isdelete = 0 AND
                    jwoutsub.isdelete = 0 AND
                    jwinsub.isdelete=0 AND
                    jwout.challan_close_date BETWEEN '".$sdate."' AND '".$edate."'
                group by
                    jwout.jobworker_id,
                    item.item_subcategory,
                    jwoutsub.item_id
                    ";
        $data = $this->Queries->getRecord($query);

        $params['reportdata'] = $data;
        /*
        $searchtxt['start_date'] = date('Y-m-01');
        $searchtxt['end_date'] = date('Y-m-t');
        $search = $this->input->post();

        if ($search['start_date'] != "" && $search['start_date'] != "") {
            $searchtxt['start_date'] = date_create_from_format('d/m/Y', $search['start_date']);
            $searchtxt['start_date'] = date_format($searchtxt['start_date'], 'Y-m-d');
        }
        if ($search['end_date'] != "" && $search['end_date'] != "") {
            $searchtxt['end_date'] = date_create_from_format('d/m/Y', $search['end_date']);
            $searchtxt['end_date'] = date_format($searchtxt['end_date'], 'Y-m-d');
        }
        if ($search['customerid'] != "" && $search['customerid'] != 0) {
            $searchtxt['customerid'] = StringRepair($search['customerid']);
        }
        $params['search'] = $search;

        $query = "select * from " . TBL_CUSTOMER . " where isdelete=0";
        $params['customerlist'] = $this->Queries->get_tab_list($query, 'id', 'customer_name');
        $params['OrderReport'] = $this->REPORT->getOrderReport($searchtxt);
        */
        $this->load->view('Reports/JobWorkReport/index', $params);
    }
}
