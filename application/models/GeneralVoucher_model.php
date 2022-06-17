<?php
class GeneralVoucher_model extends CI_Model
{

     public function getVoucher($likeCriteria='')
    {
        $this->db->select('id,customer_id,(select customer_name from '.TBL_CUSTOMER_MANAGEMENT.' where isdelete=0  AND id=t1.customer_id) as customer_name,voucher_no,voucher_date,total');
        $this->db->from(TBL_GENERAL_VOUCHER." as t1");
        $this->db->where('isdelete', 0);
        $this->db->where('t1.fin_id',$this->session->userdata['financial_year']['id']);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();

    }
}