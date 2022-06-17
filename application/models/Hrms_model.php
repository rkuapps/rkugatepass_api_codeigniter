<?php
class Hrms_model extends CI_Model
{

     public function getUser($likeCriteria='')
    {
        $this->db->select('t1.*,t2.user_role');
        $this->db->from(TBL_USERINFO." as t1");
        $this->db->join(TBL_USERROLE." as t2",'t1.user_type=t2.id','LEFT');
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "desc");
        $this->db->where('t1.id > 1');
        $query = $this->db->get();
        return $query->result();
        
    }
        public function getRole($likeCriteria='')
    {
        $this->db->select('*');
        $this->db->from(TBL_USERROLE);
        $this->db->where('isdelete', 0);
        $this->db->where('id > 1');
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
        
    }
    public function getDepartment($likeCriteria='')
    {
        $this->db->select('*');
        $this->db->from(TBL_DEPARTMENT);
        $this->db->where('isdelete', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
        
    }
    public function getStaffAccount($likeCriteria='')
    {
        $this->db->select('t1.*,t2.user_fullname');
        $this->db->from(TBL_STAFF_ACCOUNT." as t1");
        $this->db->join(TBL_USERINFO." as t2",'t1.staffid=t2.id','LEFT');
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->result();
        
    }
    public function getAttendance($likeCriteria='')
    {
        $this->db->select('t1.*,t2.user_fullname');
        $this->db->from(TBL_STAFF_ATTENDANCE." as t1");
        $this->db->join(TBL_USERINFO." as t2",'t1.staffid=t2.id','LEFT');
        $this->db->where('t1.isdelete', 0);
        $this->db->order_by("t1.id", "desc");
        $query = $this->db->get();
        return $query->result();
        
    }

    public function GetLogForProcess($likeCriteria='')
    {
        if($likeCriteria['last_count']!="")
        {
            $start=0+$likeCriteria['last_count'];
        }
        if($likeCriteria['limit']!="")
        {
            $limit=0+$likeCriteria['limit'];
        }
        $this->db->select('t2.id as staffid,t1.card_id,t1.date,t1.time,t2.attendance_group');
        $this->db->from(TBL_ATTENDANCE_LOG." as t1");
        $this->db->join(TBL_USERINFO." as t2",'t1.card_id=t2.card_id','LEFT');
        $this->db->join(TBL_DEPARTMENT." as t3",'t3.id=t2.attendance_group','LEFT');
        $this->db->where('t1.isdelete', 0);
        if($likeCriteria['fileid']!="")
        {
            $this->db->where('t1.fileid',$likeCriteria['fileid']);
        }
        if($limit!="" || $start!="")
        {
            $this->db->limit($limit, $start);
        }
        $this->db->order_by("t1.card_id,t1.date,t1.time");
        $query = $this->db->get();
        return $query->result();

    }

    public function getStaffReport($likeCriteria='')
    {
        

        $this->db->select('(select sum( IF(pay_type=0,(0-amount),IF(pay_type=1,amount,0) ) ) from '.TBL_STAFF_ACCOUNT.' where isdelete=0 and cardid=t1.cardid  group by cardid order by cardid) as other_amount');
        $this->db->select('IF(t2.pay_type="Daily",count(t1.cardid) ,SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(TIMEDIFF(t1.end_time,t1.start_time),TIMEDIFF(t1.break_end,t1.break_start))))) ) as total_attendance,t2.basic_pay,t2.pay_type,t2.card_id,t1.staffid,CONCAT(t2.user_fullname," ( ",t2.card_id," )") as name');
        $this->db->from(TBL_STAFF_ATTENDANCE." as t1");
        $this->db->join(TBL_USERINFO." as t2",'t1.staffid=t2.id','LEFT');
        $this->db->where('t1.isdelete', 0);
        $this->db->where('t2.user_type>1');
        
        if($likeCriteria['start_date']!="" && $likeCriteria['start_date']!="0000-00-00")
        {
            $this->db->where("t1.date>='".$likeCriteria['start_date']."'");
        }
         if($likeCriteria['end_date']!="" && $likeCriteria['end_date']!="0000-00-00")
        {
         $this->db->where("t1.date<='".$likeCriteria['end_date']."'");
        }
        
         if($likeCriteria['staff_name']!="" && $likeCriteria['staff_name']!="0")
        {
         $this->db->where("t1.staffid='".$likeCriteria['staff_name']."'");
        }
        if($likeCriteria['cardid']!="" && $likeCriteria['cardid']!="0")
        {
         $this->db->where("t1.cardid='".$likeCriteria['cardid']."'");
        }
        $this->db->group_by("t1.cardid");
         $this->db->order_by("t1.cardid");
        $query = $this->db->get();
        return $query->result();  
    }

    

    
}
