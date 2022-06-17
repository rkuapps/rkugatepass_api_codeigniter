<?php
class Setting_model extends CI_Model
{

    /******************************************* Get All Company Management ******************************************/
    public function getCompanyManagement($likeCriteria='')
    {
            $this->db->select('id,company_name,gst_no,(select Name from '.TBL_COMPANY_PERSON.' where isdelete=0 AND status=0 AND '.TBL_COMPANY_PERSON.'.company_id=t1.id) as name,(select contact_no from '.TBL_COMPANY_PERSON.' where isdelete=0 AND status=0 AND '.TBL_COMPANY_PERSON.'.company_id=t1.id) as contact_no');
            $this->db->from(TBL_COMPANY_MANAGEMENT." as t1");
            $this->db->where('isdelete', 0);
            $this->db->order_by("id", "desc");
            $query = $this->db->get();
            return $query->result();

    }

    /**************************************** Get All Customer Management ***********************************************/
    public function getCustomerManagement($companyid,$likeCriteria='')
    {
       
        $this->db->select('id,customer_name,gst_no,(select name from '.TBL_CUSTOMER_PERSON.' where isdelete=0 AND status=0 AND '.TBL_CUSTOMER_PERSON.'.customer_id=t1.id) as name,(select contact_no from '.TBL_CUSTOMER_PERSON.' where isdelete=0 AND status=0 AND '.TBL_CUSTOMER_PERSON.'.customer_id=t1.id) as contact_no,(select state from '.TBL_STATE.' where isdelete=0 AND state_code=t1.state) as state');
            $this->db->from(TBL_CUSTOMER_MANAGEMENT." as t1");
            $this->db->where('isdelete', 0);
            $this->db->where('party_type','1');
            $this->db->order_by("id", "desc");
            $query = $this->db->get();
            return $query->result();

    }
    /***************************************** Get All Supplier Details ***********************************************/
    public function getSupplierManagement($companyid,$likeCriteria='')
    {
        $this->db->select('id,customer_name,gst_no,(select name from '.TBL_CUSTOMER_PERSON.' where isdelete=0 AND status=0 AND '.TBL_CUSTOMER_PERSON.'.customer_id=t1.id) as name,(select contact_no from '.TBL_CUSTOMER_PERSON.' where isdelete=0 AND status=0 AND '.TBL_CUSTOMER_PERSON.'.customer_id=t1.id) as contact_no,(select state from '.TBL_STATE.' where isdelete=0 AND state_code=t1.state) as state');
        $this->db->from(TBL_CUSTOMER_MANAGEMENT." as t1");
        $this->db->where('isdelete', 0);
        $this->db->where('party_type','2');
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();

    }

    /**************************************** Get All ItemCategory **********************************************/
    public function getItemCategory($likeCriteria='')
    {
        $this->db->select('*');
        $this->db->from(TBL_ITEM_CATEGORY);
        $this->db->where('isdelete', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }   
    /****************************************Get All Item Unit ********************************************/
    public function getItemUnit($likeCriteria='')
    {
        $this->db->select('*');
        $this->db->from(TBL_ITEM_UNIT);
        $this->db->where('isdelete', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }   


    /****************************************** Get All Items ********************************************/
    public function getItem($likeCriteria='')
    {
        $this->db->select('id,item_number,item_name,(select category_name from '.TBL_ITEM_CATEGORY.' where id=t1.category_id AND isdelete=0) as item_category,opening_stock,description');
        $this->db->from(TBL_ITEM." as t1");
        $this->db->where('isdelete', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }      
    /********************************************Get All Financial Year *************************************/
    public function getFinancialYear($likeCriteria='',$companyid)
    {
        $this->db->select('*');
        $this->db->from(TBL_FINANCIAL_YEAR);
        $this->db->where('isdelete', 0);
        $this->db->where('company_id',$companyid);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }   
     /**************************************** Get All ItemCategory **********************************************/
     public function getItemSubCategory($likeCriteria='')
     {
        $this->db->select('*,(select category_name from '.TBL_ITEM_CATEGORY.' where isdelete=0 AND id=t1.cid) as category');
        $this->db->from(TBL_ITEM_SUBCATEGORY." as t1");
        $this->db->where('isdelete', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
     }     
     public function getItemParameters($likeCriteria='')
     {
        $this->db->select('*,(select subcategory_name from '.TBL_ITEM_SUBCATEGORY.' where isdelete=0 AND id=t1.subid) as subcategory');
        $this->db->from(TBL_ITEM_PARAMETERS." as t1");
        $this->db->where('isdelete', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
     }    
/**********************************************************************************************************/
     public function getJobWorkerMaster($companyid,$likeCriteria='')
     {
        // echo $companyid;exit;
        $this->db->select('id,company_name,gst_no,(select name from '.TBL_JOBWCUSTOMER_PERSON.' where isdelete=0 AND status=0 AND '.TBL_JOBWCUSTOMER_PERSON.'.customer_id=t1.id) as name,(select contact_no from '.TBL_JOBWCUSTOMER_PERSON.' where isdelete=0 AND status=0 AND '.TBL_JOBWCUSTOMER_PERSON.'.customer_id=t1.id) as contact_no, (select state from '.TBL_STATE.' where isdelete=0 AND state_code=t1.state) as state');
        $this->db->from(TBL_JOBWORKER_MASTER." as t1");
        $this->db->where('isdelete', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
  
        return $query->result();
     }
}
?>
