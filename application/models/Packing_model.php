<?php
class Packing_model extends CI_Model
{
    public function getPackinglist($id)
    {
        $this->db->select('t1.*,t2.customer_name,(select id from '.TBL_INVOICE.' where isdelete=0 and packingid=t1.id LIMIT 1) as invoiceid');
        $this->db->from(TBL_PACKING." as t1");
        $this->db->join(TBL_CUSTOMER_MANAGEMENT." as t2","t1.customer_id=t2.id","LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "desc");
        $this->db->where('t1.fin_id',$this->session->userdata['financial_year']['id']);
        $query = $this->db->get();
        return $query->result();
        
    }
    public function getSinglePacklist($id)
    {
        
        $this->db->select('t1.*');
        $this->db->from(TBL_PACKING." as t1");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.id',$id);
        $this->db->where('t1.fin_id',$this->session->userdata['financial_year']['id']);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->row();
        
    }
    public function getPackingSub()
    {
        
        $this->db->select('t1.*,t3.unique_no,t3.item_name,t3.net_weight');
        $this->db->from(TBL_PACKING_SUB." as t1");      
        $this->db->join(TBL_CUSTOMER_ITEM." as t3","t1.item_id=t3.id","LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "asc");
        $query = $this->db->get();
        return $query->result();
        
    }
    public function getPackingSubList($id)
    {
        
        $this->db->select('t1.*,t2.orderno,t3.unique_no,t3.item_name');
        $this->db->from(TBL_PACKING_SUB." as t1");
        $this->db->join(TBL_ORDER." as t2","t1.orderid=t2.id","LEFT");
        $this->db->join(TBL_CUSTOMER_ITEM." as t3","t1.item_id=t3.id","LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.packingid',$id);
        $this->db->order_by("t1.id", "asc");
       
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getItemUsingOrderNo($id)
    {
        
        $this->db->select('t1.*');
        $this->db->from(TBL_CUSTOMER_ITEM." as t1");
        $this->db->join(TBL_ORDER_SUB." as t2","t1.id=t2.item_id","LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t2.orderid',$id);        
        $this->db->order_by("t1.unique_no");
        $this->db->group_by("t1.unique_no");
        $query = $this->db->get();
        $result = $query->result();
        $cat_id = array('0');
        $cat_name = array('- Select -');
        for ($i = 0; $i < count($result); $i++) {
            array_push($cat_id, $result[$i]->id);
            array_push($cat_name, $result[$i]->unique_no);
        }
        return array_combine($cat_id, $cat_name);
    }   

    public function viewPackingSubList($id)
    {
        
        $this->db->select('id,item_id,(select unique_no from '.TBL_CUSTOMER_ITEM.' where isdelete=0 AND id=t1.item_id) as unique_no,(select item_name from '.TBL_CUSTOMER_ITEM.' where isdelete=0 AND id=t1.item_id) as item_name,case_no_from,case_no_to,box_weight,total_weight,(select net_weight from '.TBL_CUSTOMER_ITEM.' where isdelete=0 AND id=t1.item_id) as gross_weight,pcs');
        $this->db->from(TBL_PACKING_SUB." as t1");
        $this->db->where('isdelete', 0);
        $this->db->where('packingid',$id);
        $this->db->order_by('t1.id','desc');
        $query = $this->db->get();
        return $query->result();
        
    }
    public function getSinglePacklistForPrint($id)
    {
        
        $this->db->select('t1.*,t7.country_name as company_country_name,t6.gst_no as company_gstno,t6.company_name,t6.address as company_address,t2.customer_name,t3.country_name,t2.address');
        $this->db->from(TBL_PACKING." as t1");
        $this->db->join(TBL_CUSTOMER_MANAGEMENT." as t2","t1.customer_id=t2.id","LEFT");
        $this->db->join(TBL_COUNTRY_MASTER." as t3","t2.country=t3.id","LEFT");
        $this->db->join(TBL_COMPANY_MANAGEMENT." as t6","t2.company_id=t6.id","LEFT");
        $this->db->join(TBL_COUNTRY_MASTER." as t7","t6.country=t7.id","LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.id',$id);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->row();
        
    }


    public function getInvoiceDataUsingPackinglist($likeCriteria='')
    {
        $sql="";
        if($likeCriteria['invoiceid']!="" && $likeCriteria['invoiceid']!=0)
        {
            $sql="(select packingid from ".TBL_INVOICE." where id='".$likeCriteria['invoiceid']."')";    
        }
        else if($likeCriteria['packingid']!="" && $likeCriteria['packingid']!=0)
        {
            $sql=$likeCriteria['packingid'];
        }
        
        $this->db->select('t3.chno,(select count(id) from '.TBL_PACKING_SUB.' where isdelete=0 and case_no_from=t1.case_no_from and case_no_to=t1.case_no_to) as same_carton_count ,t1.case_no_from,t1.case_no_to,t1.item_id,(select amount from '.TBL_ORDER_SUB.' where item_id=t3.id and isdelete=0 and orderid=t2.id order by id desc limit 1 ) as order_price,sum((t1.pcs*t1.total_case)) as total_qty_in_pcs,sum(t1.total_case) as total_cartons,t1.box_weight,t2.orderno,t3.item_name,t3.unique_no,t4.customer_id');
        $this->db->from(TBL_PACKING_SUB." as t1");
        $this->db->join(TBL_PACKING." as t4","t4.id=t1.packingid","LEFT");
        $this->db->join(TBL_ORDER." as t2","t2.id=t1.orderid","LEFT");
        $this->db->join(TBL_CUSTOMER_ITEM." as t3","t1.item_id=t3.id","LEFT");
        $this->db->where('t1.isdelete', 0);
        if($sql!="")
        {
            $this->db->where('t1.packingid='.$sql);        
        }
        $this->db->order_by("t1.orderid,t1.item_id,t1.case_no_from",'DESC');
        $this->db->group_by("t1.orderid,t1.item_id");
        $query = $this->db->get();
     
        return $query->result();
    }

}
?>