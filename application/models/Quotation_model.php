<?php
class Quotation_model extends CI_Model
{

     public function getQuotation($likeCriteria='')
    {
        
        $this->db->select('id,quotationno,quotation_date,quotation_validity,(select customer_name from '.TBL_CUSTOMER_MANAGEMENT.' where isdelete=0  AND id=t1.cid) as cid');
        $this->db->from(TBL_QUOTATION." as t1");
        $this->db->where('isdelete', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    public function getquotatinsuecord($likeCriteria='')
    {
        $this->db->select('id,quotationno,quotation_validity,(select customer_name from '.TBL_CUSTOMER_ITEM.' where isdelete=0  AND id=t1.cid) as cid');
        $this->db->from(TBL_QUOTATION." as t1");
        $this->db->where('isdelete', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    public function getquotationsubRecord($id)
    {
        $this->db->select('id,platting,rate,moq,(select item_name from '.TBL_CUSTOMER_ITEM.' where isdelete=0  AND id=t1.subcat_id) as item_name,(select unit_measurement from '.TBL_CUSTOMER_ITEM.' where isdelete=0  AND id=t1.subcat_id) as item_unit,(select unique_no from '.TBL_CUSTOMER_ITEM.' where isdelete=0  AND id=t1.subcat_id) as unique_no,(select hsn_code from '.TBL_CUSTOMER_ITEM.' where isdelete=0  AND id=t1.subcat_id) as hsn_code');
            $this->db->from(TBL_QUOTATION_SUB." as t1");
            // $this->db->join(TBL_CUSTOMER_ITEM." as t2","t1.subcat_id=t2.id","LEFT");
            $this->db->where('t1.isdelete',0);
            $this->db->where('t1.cid',$id);
            $this->db->order_by('id');
            $query = $this->db->get();
            return $query->result();
    }

    public function getSingleQuotation($id)
    {
        $this->db->select('t1.*,t2.customer_name,t3.name as consignee,t2.cgst,t2.sgst,t2.igst,t2.address');
        $this->db->from(TBL_QUOTATION." as t1");
        $this->db->join(TBL_CUSTOMER_MANAGEMENT." as t2","t1.cid=t2.id","LEFT");
        $this->db->join(TBL_CUSTOMER_PERSON." as t3","t1.consignee=t3.id","LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.id', $id);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->row();
    }
}   
