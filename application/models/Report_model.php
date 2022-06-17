<?php
class Report_model extends CI_Model
{



    public function getJobWorkData()
    {
        $this->db->select('sum(t1.weight) as outdata,t2.item_name,t3.company_name,t4.id');
        $this->db->from(TBL_JOBWORK_OUTWORD_SUB.' as t1');
        $this->db->join(TBL_JOBWORK_OUTWORD.' as t4','t1.outword_id=t4.id','LEFT');
        $this->db->join(TBL_CUSTOMER_ITEM.' as t2','t1.item_id=t2.id','LEFT');
        $this->db->join(TBL_JOBWORKER_MASTER.' as t3','t1.jobworker_id=t3.id','LEFT');
        $this->db->join(TBL_JOBWORK_INWORD_SUB.' as t5','t1.item_id=t5.item_id','LEFT');
        $this->db->where('t1.isdelete',0);
        $this->db->where('t4.status',1);
        $this->db->group_by('t1.jobworker_id');
        $this->db->group_by('t2.item_category');
        $this->db->group_by('t1.item_id');
        $query = $this->db->get();
        echo '<pre>';
        print_r($query->result());
        exit;

    }


        //DispatchReport
             //(sum( (t2.total_cartons*t2.one_carton_pcs) * t6.exchange_rate )) as invoice_amount,,,
            // 0 status for any payment not recieved
            // 1 status for payment is pending
            // 2 status for payment is paid

        // $status=",IF( (select count(*) from ".TBL_INVOICE_PAYMENT." where isdelete=0 and invoiceid=t1.id)>0,IF((select sum(amount) from ".TBL_INVOICE_PAYMENT." where isdelete=0 and status=1 and  invoiceid=t1.id)<=t1.invoice_amount,2,1),0) as pay_status";
        //  $this->db->select('t1.invoiceno,t1.invoice_date,t1.dbk_amount,t3.orderno,t4.customer_name,t1.invoice_amount,t6.symbol as invoice_symbol,(t1.invoice_amount * t6.exchange_rate) as amount_in_inr,(select symbol from '.TBL_CURRENCY_MASTER.' where isdelete=0 and short_name="INR" limit 1) as inr_symbol'.$status);
        //  $this->db->from(TBL_INVOICE." as t1");
        //  $this->db->join(TBL_PACKINGLIST_SUB." as t2","t1.packingid=t2.packingid","LEFT");
        //  $this->db->join(TBL_ORDER." as t3","t2.orderid=t3.id","LEFT");
        //  $this->db->join(TBL_CUSTOMER." as t4","t3.customerid=t4.id","LEFT");
        //  $this->db->join(TBL_INVOICE_PAYMENT." as t5","t1.id=t5.invoiceid","LEFT");
        // $this->db->join(TBL_CURRENCY_MASTER." as t6","at4.currencyid=t6.id","LEFT");
        //  if($likeCriteria['customerid']!="" && $likeCriteria['customerid']!=0)
        //  {
        //  $this->db->where('t3.customerid', $likeCriteria['customerid']);    
        //  }
        //  $this->db->where('t1.isdelete', 0);
        //  $this->db->where('t2.isdelete', 0);
        // $this->db->order_by("t1.id", "desc");
        // $this->db->group_by("t1.id");
        //  $query = $this->db->get();
        //  return $query->result();
    
    
    
}
