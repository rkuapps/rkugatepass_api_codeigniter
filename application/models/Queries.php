<?php
class Queries extends CI_Model
{

    
      //Read data from db for role info
      public function read_role_info($id = "")
      {
          $this->db->select('*');
          $this->db->from(TBL_USERROLE);
          $this->db->where('id', $id);
          $query = $this->db->get();
          if ($query->num_rows() == 1 && $query->row()->role_details != '') {
              return $query->row();
          } else {
              return 0;
          }
      }
    /********************************************************** General Query Section **********************************************/


    // Record Counting For Table
    public function record_count($tablename)
    {
        return $this->db->count_all($tablename);
    }

    // Get List of Records
    public function getRecord($query)
    {
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
   
    public function getItem($likeCriteria='')
    {
        
        $orderby="id";
        $sortorder="desc";
                 
        
        if($likeCriteria['orderby']!="")
        {  
            $orderby=$likeCriteria['orderby'];
        }
        if($likeCriteria['sortorder']!="")
        {  
            $sortorder=$likeCriteria['sortorder'];
        }
            $this->db->select('t1.*,t2.subcategory_name,t3.category_name');
            $this->db->from(TBL_CUSTOMER_ITEM." as t1");
            $this->db->join(TBL_ITEM_SUBCATEGORY." as t2",'t1.item_subcategory=t2.id','LEFT');
            $this->db->join(TBL_ITEM_CATEGORY." as t3",'t1.item_category=t3.id','LEFT');
            $this->db->where('t1.isdelete', 0);
            if($likeCriteria['customerid']!="")
            {
                $this->db->where('t1.customerid',$likeCriteria['customerid']);
            }
            if($likeCriteria['search']!="")
            {
                $this->db->where($likeCriteria['search']);
            }
            
            $this->db->order_by($orderby,$sortorder);
            if($likeCriteria['limit']!="")
            {
            $this->db->limit($likeCriteria['start'],$likeCriteria['limit']);
            }
               
            
            $query = $this->db->get();
            return $query->result();

    }


    // Get Single Record Master table List
    public function getSingleRecord($query)
    {
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    // Add Record To Table
    public function addRecord($tablename, $data)
    {
        return $this->db->insert($tablename, $data);
    }
      public function addBatchRecord($tablename, $data)
    {
        return $this->db->insert_batch($tablename, $data);
    }
    public function deleteRecord($tablename, $id)
    {
        return $this->db->where('id', $id)
            ->update($tablename);
    }
    public function updateorderno($tablename,$orderno,$pid)
    {
        return $this->db->where('id',$pid)
            ->update($tablename,$orderno);
    }
    public function deleteQueryRecord($query)
    {
        return $this->db->query($query);
    }
    // Update Record To Table
    public function updateRecord($tablename, $data, $id)
    {
        return $this->db->where('id', $id)
            ->update($tablename, $data);
    }
    // Update Stock In Inventory Table
    public function updateStock($tablename, $data, $id,$stype)
    {
        return $this->db->where('subid', $id)->where('stype',$stype)
            ->update($tablename, $data);
    }
    // update Sub Table Record for Order
    public function updateOrder($tablename,$data,$id)
    {
        return $this->db->where('orderid', $id)
            ->update($tablename,$data);
    }
    // update Sub Table Record for Packing
    public function updatePacking($tablename,$data,$id)
    {
        return $this->db->where('packingid', $id)
            ->update($tablename,$data);
    }
    // update Sub Table Record for Purchase Order
    public function updatePurchaseOrder($tablename,$data,$id)
    {
        return $this->db->where('poid', $id)
            ->update($tablename,$data);
    }
    public function updateVouchse($tablename,$data,$id)
    {
        return $this->db->where('voucher_id',$id)
            ->update($tablename,$data);
    }
    public function updatePerson($tablename, $data, $about)
    {
        return $this->db->where($about)              
            ->update($tablename, $data);
    }

    // Update Record To Table
    public function updateSpecialRecord($tablename, $data, $column, $id)
    {
        return $this->db->where($column, $id)
            ->update($tablename, $data);
    }
    

    // Get Dropdown List from Table
    public function get_tab_list($query, $id, $colname)
    {
        $query = $this->db->query($query);
        $result = $query->result();
        $cat_id = array('0');
        $cat_name = array('- Select -');
        for ($i = 0; $i < count($result); $i++) {
            array_push($cat_id, $result[$i]->$id);
            array_push($cat_name,$result[$i]->$colname);
        }
        return array_combine($cat_id, $cat_name);
    }
    public function get_tab_list2($query, $id, $colname)
    {
        $query = $this->db->query($query);
        $result = $query->result();
        $cat_id = array();
        $cat_name = array();
        for ($i = 0; $i < count($result); $i++) {
            array_push($cat_id, $result[$i]->$id);
            array_push($cat_name, $result[$i]->$colname);
        }
        return array_combine($cat_id, $cat_name);
    }

     // Get Single Record Master table List
     public function getCompany()
     {
         $query = $this->db->query('select * from '.TBL_COMPANY_MANAGEMENT." where id=8");
         if ($query->num_rows() > 0) {
             return $query->row();
         } else {
             return null;
         }
     }
  
    public function getBackup($likeCriteria='')
    {
            $this->db->select('t1.*,t2.user_fullname as backup_by');
            $this->db->from(TBL_BACKUP." as t1");
            $this->db->join(TBL_USERINFO." as t2","t1.created_by=t2.id","LEFT");
            $this->db->order_by("id", "desc");
            $query = $this->db->get();
            return $query->result();

    }
    
}
