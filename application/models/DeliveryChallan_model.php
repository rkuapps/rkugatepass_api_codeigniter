<?php
class DeliveryChallan_model extends CI_Model
{

    public function getDeliveryChallan()
    {
        $this->db->select('t1.*,t3.customer_name,sum(amount) as total');
        $this->db->from(TBL_DELIVERYCHALLAN." as t1");
        $this->db->join(TBL_DELIVERYCHALLAN_SUB." as t2",'t1.id=t2.deliveryid','LEFT');
        $this->db->join(TBL_CUSTOMER_MANAGEMENT." as t3",'t1.customer_id=t3.id','LEFT');
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "desc");
        $this->db->group_by('t1.id');
        $query = $this->db->get();
        return $query->result();

    }

    public function getDeliveryPaymentList($id)
    {
        $this->db->select('*');
        $this->db->from(TBL_DELIVERYCHALLAN_PAYMENT);
        $this->db->where('isdelete','0');
        $this->db->where('invoiceid',$id);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getSingleDelivery($id)
    {
        
        $this->db->select('t1.*,t9.country_name as company_country_name,t8.gst_no as company_gstno,t8.company_name,t8.address as company_address,t3.customer_name as customer_short_name,t4.country_name,t2.customer_order,t3.customer_name,t3.address');
        $this->db->from(TBL_DELIVERYCHALLAN." as t1");
        $this->db->join(TBL_PACKING." as t2","t1.packingid=t2.id","LEFT");
        $this->db->join(TBL_CUSTOMER_MANAGEMENT." as t3","t2.customer_id=t3.id","LEFT");
        $this->db->join(TBL_COUNTRY_MASTER." as t4","t3.country=t4.id","LEFT");
        $this->db->join(TBL_COMPANY_MANAGEMENT." as t8","t3.company_id=t8.id","LEFT");
        $this->db->join(TBL_COUNTRY_MASTER." as t9","t8.country=t9.id","LEFT");
        $this->db->where('t1.isdelete', 0);        
        $this->db->where('t1.id',$id);
        $this->db->order_by("t1.id", "desc");
            $query = $this->db->get();
        return $query->row();

    }
    
    public function getDeliveryPrint($id)
    {
        $this->db->select('t1.id,t1.deliveryno,t1.delivery_date,t1.place_supply,t1.dispatched_by,t1.fright_amount,t1.po_number,t1.tcs,t1.payment,t1.lr_number,t4.state,t3.state as state_code,t3.cgst,t3.sgst,t3.igst,t3.customer_name,t5.name as consignee,t3.gst_no,t3.address,t1.bags');
        $this->db->from(TBL_DELIVERYCHALLAN." as t1");
        $this->db->join(TBL_CUSTOMER_MANAGEMENT." as t3","t1.customer_id=t3.id","LEFT");
        $this->db->join(TBL_CUSTOMER_PERSON." as t5","t1.consignee=t5.id","LEFT");
        $this->db->join(TBL_STATE." as t4","t3.state=t4.state_code","LEFT");
        $this->db->where('t1.isdelete', 0);        
        $this->db->where('t3.isdelete', 0);        
        $this->db->where('t1.id',$id);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->row();
    }
        
    public function getitemPrint($id)
    {
        $this->db->select('t1.*,t2.item_name,t1.rate_type,t2.unique_no,t2.hsn_code,t1.weight');
        $this->db->from(TBL_DELIVERYCHALLAN_SUB." as t1");
        $this->db->join(TBL_CUSTOMER_ITEM." as t2","t1.item_id=t2.id","LEFT");
        $this->db->where('t1.isdelete', 0);        
        $this->db->where('t1.deliveryid',$id);
        $this->db->order_by("id", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getDeliverySublistRecord($id)
    {
       
        $this->db->select('t1.id,t1.item_id,t2.item_name,t2.unique_no,t2.hsn_code,t1.weight,t1.qty,t1.amount,t1.rate,t1.rate_type');
            $this->db->from(TBL_DELIVERYCHALLAN_SUB." as t1");
            $this->db->join(TBL_CUSTOMER_ITEM." as t2","t1.item_id=t2.id","LEFT");
            $this->db->where('t1.isdelete',0);
            $this->db->where('t1.deliveryid',$id);
            $this->db->order_by('t1.id');
            $query = $this->db->get();
            return $query->result();
    }
}   
