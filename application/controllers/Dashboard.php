<?php
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_in'])) {
            redirect('');
        }
        
    }

    // Display  Dashboard
    public function index()
    {
        $params=array();
        $invoice='';
        $query='select count(id) as cnt from '.TBL_QUOTATION.' where isdelete=0';
        $data=$this->Queries->getSingleRecord($query);
        $params['quotations']=$data->cnt;
        
        $query='select id,invoice_date from '.TBL_INVOICE.' where isdelete=0 AND MONTH(invoice_date)=MONTH(now()) AND YEAR(invoice_date)=YEAR(now())';
        $data=$this->Queries->getRecord($query);
        foreach($data as $post)
        {
            $invoice.=$post->id.',';
        }
        $invoice.=0;
        $query='select sum(amount) as total from '.TBL_INVOICE_SUB.' where isdelete=0 AND invoiceid IN ('.$invoice.')';
        $data=$this->Queries->getSingleRecord($query);
        $params['orders']=($data->total=="")?"0":$data->total;

        $query='select count(id) as cnt from '.TBL_PURCHASE_ORDER.' where isdelete=0';
        $data=$this->Queries->getSingleRecord($query);
        $params['purchase_orders']=$data->cnt;
        $query='select count(id) as cnt from '.TBL_JOBWORK_OUTWORD.' where isdelete=0';
        $data=$this->Queries->getSingleRecord($query);
        $params['jwchallan']=$data->cnt;
        $query='select count(id) as cnt from '.TBL_DELIVERYCHALLAN.' where isdelete=0';
        $data=$this->Queries->getSingleRecord($query);
        $params['delievrychallan']=$data->cnt;
        $query='select count(id) as cnt from '.TBL_INVOICE.' where isdelete=0';
        $data=$this->Queries->getSingleRecord($query);
        $params['invoice']=$data->cnt;
        $query='select t1.*,t2.company_name from '.TBL_JOBWORK_OUTWORD.' as t1 JOIN '.TBL_JOBWORKER_MASTER.' as t2 ON t1.jobworker_id=t2.id where t1.isdelete=0 AND t1.status=0';
        $params['openchallan']=$this->Queries->getRecord($query);
        $this->load->view('dashboard',$params);
    }

    public function getCustomer(){
        $query = "select t2.sgst,t2.cgst,t2.igst,t1.id from tbl_invoice as t1 left join tbl_customer_management as t2 on t1.customer_id = t2.id ";
        $res  = $this->Queries->getRecord($query);
        foreach($res as $post){
            echo $post->sgst;
            $form_data = array('cgst'=>$post->cgst,'sgst'=>$post->sgst,'igst'=>$post->igst);
            $this->Queries->updateRecord('tbl_invoice',$form_data,$post->id);
        }
    }


/*
    public function add1()
    {
        $json = file_get_contents('https://raw.githubusercontent.com/linssen/country-flag-icons/master/countries.json');
        $obj = json_decode($json);
        foreach($obj as $post)
        {
            $res=$this->Queries->getSingleRecord('select * from '.TBL_COUNTRY_MASTER.' where country_name="'.$post->name.'"');
            if($res!=null)
            {
                    echo "yes";
            }else{
            $today=date('Y-m-d H:i:s');
            $form_data=array(
                'country_name'=>$post->name,
                'short_name'=>$post->alpha3,
                'created_by' => $this->session->userdata['logged_in']['userid'],
                'updated_by' => $this->session->userdata['logged_in']['userid'],
                'updated_on' => $today
            );
            $this->Queries->addRecord(TBL_COUNTRY_MASTER,$form_data);
            }
            
        }
    }

    public function add2()
    {
        $json = file_get_contents('https://gist.githubusercontent.com/stevekinney/8334552/raw/28d6e58f99ba242b7f798a27877e2afce75a5dca/currency-symbols.json');
        $obj = json_decode($json);
        foreach($obj as $post)
        {
            $res=$this->Queries->getSingleRecord('select * from '.TBL_CURRENCY_MASTER.' where currency_name="'.$post->currency.'"');
            if($res!=null)
            {
                    echo "yes";
            }else{

            $today=date('Y-m-d H:i:s');
            if($post->symbol==null || $post->symbol=="")
            {
                $symbol=" ";
            }else{
                $symbol=$post->symbol;
            }
            $form_data=array(
                'countryid'=>'0',
                'currency_name'=>$post->currency,
                'short_name'=>$post->abbreviation,
                'symbol'=>$symbol,
                'exchange_rate'=>0,
                'created_by' => $this->session->userdata['logged_in']['userid'],
                'updated_by' => $this->session->userdata['logged_in']['userid'],
                'updated_on' => $today
            );
            $this->Queries->addRecord(TBL_CURRENCY_MASTER,$form_data);
            }
            
        }
    }
  */  
}
