<?php
class Jobwork_challan_model extends CI_Model
{

    public function getOutwordlist()
    {
        $this->db->select('t1.*,t2.company_name');
        $this->db->from(TBL_JOBWORK_OUTWORD." as t1");
        $this->db->join(TBL_JOBWORKER_MASTER." as t2","t1.jobworker_id=t2.id",'LEFT');
        $this->db->where('t1.isdelete',0);
        $this->db->order_by('t1.id','desc');
        $query = $this->db->get();
        return $query->result();
    } 
    public function getInwordlist($id)
    {
        $this->db->select('t1.*,(select sum(weight) from '.TBL_JOBWORK_INWORD_SUB.' where isdelete=0 AND inword_id=t1.id) as weight');
        $this->db->from(TBL_JOBWORK_INWORD." as t1");
        $this->db->where('t1.isdelete',0);
        $this->db->where('t1.outword_id',$id);
        $this->db->order_by('t1.id','desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function getSingleOutword($id)
    {
        $this->db->select('t1.*,t2.company_name,t2.address,t2.cgst,t2.sgst,t2.igst,t2.gst_no,t4.state,t2.state as state_code,(select sum(bags) as bags from '.TBL_JOBWORK_OUTWORD_SUB.' where isdelete=0 and outword_id=t1.id) as bagscount,(select sum(weight) as weight from '.TBL_JOBWORK_OUTWORD_SUB.' where isdelete=0 and outword_id=t1.id) as weight,(select sum(weight) as weight from '.TBL_JOBWORK_INWORD_SUB.' where isdelete=0 and outword_id=t1.id ) as recweight');
        $this->db->from(TBL_JOBWORK_OUTWORD." as t1");
        $this->db->join(TBL_JOBWORKER_MASTER." as t2","t1.jobworker_id=t2.id",'LEFT');
        $this->db->join(TBL_STATE." as t4","t2.state=t4.state_code","LEFT");
        $this->db->where('t1.isdelete',0);
        $this->db->where('t1.id',$id);
        $this->db->order_by('t1.id','desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function getsubOutwordList($id)
    {
    $this->db->select("t1.id,t5.item_name,t5.unique_no,t5.hsn_code,t5.jw_itemname,t1.process,t1.weight,t1.bags,t1.rate,t1.amount,(select sum(weight) as weight from ".TBL_JOBWORK_INWORD_SUB." where isdelete=0 and outword_id=t1.outword_id and item_id=t1.item_id) as recweight");
        $this->db->from(TBL_JOBWORK_OUTWORD_SUB." as t1");
        $this->db->join(TBL_CUSTOMER_ITEM." as t5","t1.item_id=t5.id","LEFT");
        $this->db->where('t1.outword_id', $id);
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    public function getsubInwordList($id)
    {
    $this->db->select("t1.id,t5.jw_itemname,t5.unique_no,t5.hsn_code,t1.qty,t1.weight");
        $this->db->from(TBL_JOBWORK_INWORD_SUB." as t1");
        $this->db->join(TBL_CUSTOMER_ITEM." as t5","t1.item_id=t5.id","LEFT");
        $this->db->where('t1.inword_id', $id);
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getSummaryData($id)
    {
        $this->db->select('sum(t1.weight) as weight,t2.item_name');
        $this->db->from(TBL_JOBWORK_INWORD_SUB." as t1");
        $this->db->join(TBL_CUSTOMER_ITEM." as t2","t1.item_id=t2.id","LEFT");
        $this->db->where('t1.outword_id',$id);
        $this->db->where('t1.isdelete',0);
        $this->db->order_by('t1.id',"desc");
        $this->db->group_by('t1.item_id');
        $query = $this->db->get();
        return $query->result();
    }
   

}
