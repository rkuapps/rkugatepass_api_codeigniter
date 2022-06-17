<?php
class PurchaseOrder_model extends CI_Model
{

     public function getPurchaseOrder($likeCriteria='')
    {
        $this->db->select('id,customerid,(select customer_name from '.TBL_CUSTOMER_MANAGEMENT.' where isdelete=0  AND id=t1.customerid) as customer_name,ponumber,po_date,total');
        $this->db->from(TBL_PURCHASE_ORDER." as t1");
        $this->db->where('isdelete', 0);
        $this->db->where('t1.finid',$this->session->userdata['financial_year']['id']);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();

    }

    public function getSingleOrder($id)
    {
        $this->db->select('t1.*,t2.customer_name,t2.cgst,t2.sgst,t2.igst,t2.address,t3.company_name,t3.address as company_address,t2.gst_no,t2.state,t4.state as state_name');
        $this->db->from(TBL_PURCHASE_ORDER." as t1");
        $this->db->join(TBL_CUSTOMER_MANAGEMENT." as t2","t1.customerid=t2.id","LEFT");
        $this->db->join(TBL_COMPANY_MANAGEMENT." as t3","t2.company_id=t3.id","LEFT");
        $this->db->join(TBL_STATE." as t4","t2.state=t4.state_code","LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.id', $id);
        $this->db->order_by("t1.id", "desc");
        $this->db->where('t1.finid',$this->session->userdata['financial_year']['id']);
        $query = $this->db->get();
        return $query->row();
        
    }

    public function getsubOrdersList($id)
    {
    $this->db->select("t5.unique_no,t1.delivery_date,t5.item_name,t5.unit_measurement as item_unit,t5.hsn_code,t1.qty,t1.amount,t1.total");
        $this->db->from(TBL_PURCHASE_ORDER_SUB." as t1");
        $this->db->join(TBL_PURCHASE_ORDER." as t2","t1.poid=t2.id","LEFT");
        $this->db->join(TBL_CUSTOMER_MANAGEMENT." as t3","t2.customerid=t3.id","LEFT");
        $this->db->join(TBL_CUSTOMER_ITEM." as t5","t1.item_id=t5.id","LEFT");
        $this->db->where('t1.poid', $id);
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
}
?>