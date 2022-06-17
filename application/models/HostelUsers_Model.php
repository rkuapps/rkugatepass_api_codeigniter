<?php
class HostelUsers_Model extends CI_Model
{
    public function getOrder($likeCriteria = '')
    {
        $this->db->select('t1.id,t1.orderno,t1.order_date,t1.status,t1.customerid,t2.customer_name,t1.ponumber,t1.po_date,t1.total');
        $this->db->from(TBL_ORDER . " as t1");
        $this->db->join(TBL_CUSTOMER_MANAGEMENT . ' as t2', 't1.customerid=t2.id', 'LEFT');
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.fin_id', $this->session->userdata['financial_year']['id']);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getsubOrderList()
    {
        $this->db->select("id,orderid,item_id,(select unique_no from " . TBL_CUSTOMER_ITEM . " where isdelete=0 AND id=t1.item_id) as unique_no,qty,delivery_date,dispatched,(select orderno from " . TBL_ORDER . " where isdelete=0 AND id=t1.orderid) as orderno");
        $this->db->from(TBL_ORDER_SUB . " as t1");
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getsubOrder($id)
    {
        $this->db->select("id,item_id,qty,delivery_date");
        $this->db->from(TBL_ORDER_SUB . " as t1");
        $this->db->where('t1.orderid', $id);
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getsubOrdersList($id)
    {
        $this->db->select("t5.unique_no,t5.item_name,t1.qty,t1.amount,t1.total");
        $this->db->from(TBL_ORDER_SUB . " as t1");
        $this->db->join(TBL_ORDER . " as t2", "t1.orderid=t2.id", "LEFT");
        $this->db->join(TBL_CUSTOMER_MANAGEMENT . " as t3", "t2.customerid=t3.id", "LEFT");
        $this->db->join(TBL_CUSTOMER_ITEM . " as t5", "t1.item_id=t5.id", "LEFT");
        $this->db->where('t1.orderid', $id);
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getOrderSublistRecord($id)
    {
        $this->db->select('t1.id,t1.delivery_date,t1.item_unit,t1.item_id,t2.item_name,t2.unique_no,t3.unit_name,t1.qty,t1.amount,t1.total');
        $this->db->from(TBL_ORDER_SUB . " as t1");
        $this->db->join(TBL_CUSTOMER_ITEM . " as t2", "t1.item_id=t2.id", "LEFT");
        $this->db->join(TBL_ITEM_UNIT . " as t3", "t2.item_unit=t3.id", "LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.orderid', $id);
        $this->db->order_by('t1.id');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getSingleOrder($id)
    {
        $this->db->select('t1.*,t2.customer_name,t2.cgst,t2.sgst,t2.igst,t2.address,t3.company_name,t3.address as company_address');
        $this->db->from(TBL_ORDER . " as t1");
        $this->db->join(TBL_CUSTOMER_MANAGEMENT . " as t2", "t1.customerid=t2.id", "LEFT");
        $this->db->join(TBL_COMPANY_MANAGEMENT . " as t3", "t2.company_id=t3.id", "LEFT");
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t1.id', $id);
        $this->db->order_by("t1.id", "desc");
        $this->db->where('t1.fin_id', $this->session->userdata['financial_year']['id']);
        $query = $this->db->get();
        return $query->row();
    }

    public function getSalesPenddingQty1($pono)
    {
        $this->db->select('t5.item_name,t5.unique_no,t1.qty as poqty,t1.item_unit');
        $this->db->from(TBL_ORDER_SUB . " as t1");
        $this->db->join(TBL_ORDER . " as t2", 't1.orderid=t2.id', 'LEFT');
        $this->db->join(TBL_CUSTOMER_ITEM . " as t5", 't1.item_id=t5.id', 'LEFT');
        $this->db->where('t2.id', $pono);
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t2.isdelete', 0);
        $query = $this->db->get();
        return $query->result();
    }

    public function getSalesPenddingQty($pono)
    {
        $this->db->select('t5.item_name,t5.unique_no,t1.item_unit,t1.qty as poqty,(select sum(if(rate_type=0,qty,weight)) from ' . TBL_INVOICE_SUB . ' where item_id=t1.item_id AND isdelete=0 AND orderid=t1.orderid) as rsqty');
        $this->db->from(TBL_ORDER_SUB . " as t1");
        $this->db->join(TBL_ORDER . " as t2", 't1.orderid=t2.id', 'LEFT');
        $this->db->join(TBL_CUSTOMER_ITEM . " as t5", 't1.item_id=t5.id', 'LEFT');
        $this->db->where('t2.id', $pono);
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t2.isdelete', 0);
        $query = $this->db->get();
        return $query->result();
    }
}
