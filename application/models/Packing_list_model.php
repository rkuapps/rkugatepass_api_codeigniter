<?php
class Packing_list_model extends CI_Model
{

     public function getPackingList($likeCriteria='')
    {
        
        $this->db->select('t1.*,t2.customer_name,(select id from '.TBL_INVOICE.' where isdelete=0 and packingid=t1.id LIMIT 1) as invoiceid');
        $this->db->from(TBL_PACKINGLIST." as t1");
        $this->db->join(TBL_CUSTOMER." as t2","t1.customerid=t2.id","LEFT");
        
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "desc");
        $this->db->where('t1.fin_id',$this->session->userdata['financial_year']['id']);
        $query = $this->db->get();
        return $query->result();
        
    }
         public function getSinglePacklist($id)
    {
        
        $this->db->select('t1.*');
        $this->db->from(TBL_PACKINGLIST." as t1");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.id',$id);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->row();
        
    }
    
         public function getPackingSubList($id)
    {
        
        $this->db->select('t1.*,t2.orderno,t3.unique_no,t3.item_name');
        $this->db->from(TBL_PACKINGLIST_SUB." as t1");
        $this->db->join(TBL_ORDER." as t2","t1.orderid=t2.id","LEFT");
        $this->db->join(TBL_CUSTOMER_ITEM." as t3","t1.itemid=t3.id","LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.packingid',$id);
        $this->db->order_by("t1.id", "asc");
        $this->db->where('t1.fin_id',$this->session->userdata['financial_year']['id']);
        $query = $this->db->get();
        return $query->result();
        
    }

        public function getSinglePacklistSub($packingid,$id)
    {
        
        $this->db->select('t1.*');
        $this->db->from(TBL_PACKINGLIST_SUB." as t1");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.packingid',$packingid);
        $this->db->where('t1.id',$id);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->row();
        
    }   

    public function getCustomerPort($id)
    {
        
        $this->db->select('t1.*');
        $this->db->from(TBL_PORT_MASTER." as t1");
        $this->db->join(TBL_CUSTOMER." as t2","t1.countryid=t2.countryid","LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t2.id',$id);        
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        $result = $query->result();
        $cat_id = array('0');
        $cat_name = array('- Select -');
        for ($i = 0; $i < count($result); $i++) {
            array_push($cat_id, $result[$i]->id);
            array_push($cat_name, $result[$i]->port_name);
        }
        return array_combine($cat_id, $cat_name);
    }   

    public function getCompanyPort($id)
    {
        
        $this->db->select('t1.*');
        $this->db->from(TBL_PORT_MASTER." as t1");
        $this->db->join(TBL_COMPANY_MASTER." as t2","t1.countryid=t2.countryid","LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t2.id=(select companyid from '.TBL_CUSTOMER.' where id='.$id.'  and isdelete=0)');
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        $result = $query->result();
        $cat_id = array('0');
        $cat_name = array('- Select -');
        for ($i = 0; $i < count($result); $i++) {
            array_push($cat_id, $result[$i]->id);
            array_push($cat_name, $result[$i]->port_name);
        }
        return array_combine($cat_id, $cat_name);
    }   
    public function getItemUsingOrderNo($id)
    {
        
        $this->db->select('t1.*');
        $this->db->from(TBL_CUSTOMER_ITEM." as t1");
        $this->db->join(TBL_ORDER_SUB." as t2","t1.unique_no=t2.item_no","LEFT");
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
        
        $this->db->select('t3.chno,t1.container_type,(select count(id) from '.TBL_PACKINGLIST_SUB.' where isdelete=0 and carton_range_start=t1.carton_range_start and carton_range_end=t1.carton_range_end) as same_carton_count ,t1.carton_range_start,t1.carton_range_end,t1.itemid,(select amount from '.TBL_ORDER_SUB.' where item_no=t3.unique_no and isdelete=0 and orderid=t2.id order by id desc limit 1 ) as order_price,t1.pellet,sum((t1.one_carton_pcs*t1.total_cartons)) as total_qty_in_pcs,sum(t1.total_cartons) as total_cartons,t1.total_carton_weight,t2.orderno,t3.item_name,t3.unique_no,t4.customerid');
        $this->db->from(TBL_PACKINGLIST_SUB." as t1");
        $this->db->join(TBL_PACKINGLIST." as t4","t4.id=t1.packingid","LEFT");
        $this->db->join(TBL_ORDER." as t2","t2.id=t1.orderid","LEFT");
        $this->db->join(TBL_CUSTOMER_ITEM." as t3","t1.itemid=t3.id","LEFT");
        $this->db->where('t1.isdelete', 0);
        if($sql!="")
        {
            $this->db->where('t1.packingid='.$sql);        
        }
        $this->db->order_by("t1.id,t1.itemid");
        $this->db->group_by("t1.id,t1.container_type");
        $query = $this->db->get();
        return $query->result();
    }   

    
    public function getSinglePacklistForPrint($id)
    {
        
        $this->db->select('t1.*,t7.country_name as company_country_name,(select anr_no from '.TBL_COMPANY_ANR.' where isdelete=0 and status=1 and  companyid=t2.companyid order by id desc limit 1) as company_anr_no,t6.gstno as company_gstno,t6.company_name,t6.address as company_address,t6.code as iec_code,t6.iec_date,t2.short_name as customer_short_name,t2.customer_name,t3.country_name,t2.address,t4.port_name,t5.port_name as discharge_name');
        $this->db->from(TBL_PACKINGLIST." as t1");
        $this->db->join(TBL_CUSTOMER." as t2","t1.customerid=t2.id","LEFT");
        $this->db->join(TBL_COUNTRY_MASTER." as t3","t2.countryid=t3.id","LEFT");
        $this->db->join(TBL_PORT_MASTER." as t4","t1.port_of_loading=t4.id","LEFT");
        $this->db->join(TBL_PORT_MASTER." as t5","t1.port_of_discharge=t5.id","LEFT");
        $this->db->join(TBL_COMPANY_MASTER." as t6","t2.companyid=t6.id","LEFT");
        $this->db->join(TBL_COUNTRY_MASTER." as t7","t6.countryid=t7.id","LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.id',$id);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->row();
        
    }
    
    public function viewPackingSubList($id)
    {
        
        $this->db->select('t1.itemid,(select count(id) from '.TBL_PACKINGLIST_SUB.' where isdelete=0 and carton_range_start=t1.carton_range_start and carton_range_end=t1.carton_range_end) as same_carton_count,(select count(pellet) from '.TBL_PACKINGLIST_SUB.' where isdelete=0 and packingid='.$id.' and pellet=t1.pellet group by pellet order by pellet limit 1) as pellet_count,t1.*,t2.orderno,t3.unique_no,t3.item_name');
        $this->db->from(TBL_PACKINGLIST_SUB." as t1");
        $this->db->join(TBL_ORDER." as t2","t1.orderid=t2.id","LEFT");
        $this->db->join(TBL_CUSTOMER_ITEM." as t3","t1.itemid=t3.id","LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.packingid',$id);
        $this->db->order_by("t1.id");
        $this->db->where('t1.fin_id',$this->session->userdata['financial_year']['id']);
        $query = $this->db->get();
        return $query->result();
        
    }
}
