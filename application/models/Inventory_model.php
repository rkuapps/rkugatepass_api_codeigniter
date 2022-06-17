<?php 
class Inventory_model extends CI_Model
{

     public function getItem($likeCriteria='')
    {
        $this->db->select('id,item_name,item_category,(select category_name from '.TBL_ITEM_CATEGORY.' where isdelete=0 AND id=t1.item_category) as category_name,(select sum(qty) from '.TBL_INVENTORY.' where (stype=0 or stype=1 or stype=3) AND isdelete=0 AND item_id=t1.id) as qty,(select sum(qty) from '.TBL_INVENTORY.' where (stype=2 or stype=4) AND isdelete=0 AND item_id=t1.id) as minusqty');
        $this->db->from(TBL_CUSTOMER_ITEM." as t1");
        $this->db->where('isdelete', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();

    }
    public function insertInventory($item_id,$subid,$stype,$formdata)
	{
		$this->db->select('id');
        $this->db->from(TBL_INVENTORY);
        $this->db->where('isdelete',0);
        $this->db->where('item_id',$item_id);
        $this->db->where('subid',$subid);
        $this->db->where('stype',$stype);
        $query=$this->db->get();
        $inventory_id=$query->result();
        if($inventory_id=='' || count($inventory_id)==0)
        {
            $this->db->insert(TBL_INVENTORY,$formdata);
        }
        else{
            $this->db->where('id',$inventory_id[0]->id)->update(TBL_INVENTORY,$formdata);
        }
	}
}
?>