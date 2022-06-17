<?php
class Leave_Model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function addLeave($leaveData){
    $this->db->insert('rkuh_checkinout',$leaveData);
    return $this->db->insert_id();
  }

  public function getMyLeaves($userid){
    
	$this->db->select("*");
    $this->db->from("rkuh_checkinout");
    $this->db->where("userid",$userid);
    $this->db->where("deleted_by", 0);
    $this->db->order_by("id desc");
    $query = $this->db->get();
    return $query->result();
  }

  public function deleteMyLeaves($userid,$leaveid){
    $this->db->set('deleted_by', $userid);
    $this->db->set('deleted_at', date('Y-m-d H:i:s'));
    $this->db->where('id', $leaveid);
    $this->db->update('rkuh_checkinout');
    return $this->db->affected_rows();
  }

  public function getUsersData(){
    $this->db->select("*");
    $this->db->where("deleted_by", 0);
    $this->db->from("rkuh_users");
    $query = $this->db->get();
    return $query->result();
  }



  // Admin Functions
  // filters 1 Pending, 2 Approved, 3 Out, 4 In, 0 Rejected
  public function getAllLeaves($status=-1){
    $this->db->select("l.id as leaveid,u.name,l.out_datetime,l.in_datetime,l.reason,l.status");
    $this->db->from("rkuh_checkinout as l");
    $this->db->join('rkuh_users as u','l.userid = u.id','left');
    if($status != -1){
      $this->db->where('l.status',$status);
    }    
    $this->db->where("l.deleted_by", 0);
    $this->db->where("u.deleted_by", 0);
    $query = $this->db->get();
    return $query->result();
  }

  public function getLeaveDetails($leaveid=0){
    $this->db->select("l.id");
    $this->db->select("concat(u.name,' (Room No:',u.room_no,')') as userdetail");
    $this->db->select("u.mobile");
    $this->db->select("u.whatsapp");
    $this->db->select("u.p_mobile");
    $this->db->select("u.branch");
    $this->db->select("l.created_at");
    $this->db->select("l.out_datetime");
    $this->db->select("l.in_datetime");
    $this->db->select("l.reason");
    $this->db->select("l.action_datetime");
    $this->db->select("u1.name as userAction");
    $this->db->select("l.actual_out_datetime");
    $this->db->select("u2.name as userOut");
    $this->db->select("l.actual_in_datetime");
    $this->db->select("u3.name as userIn");
    $this->db->from("rkuh_checkinout as l");
    $this->db->join('rkuh_users as u','l.userid = u.id','left');
    $this->db->join('rkuh_users as u1','l.action_by = u1.id','left');
    $this->db->join('rkuh_users as u2','l.actual_out_by = u2.id','left');
    $this->db->join('rkuh_users as u3','l.achual_in_by = u3.id','left');
    $this->db->where("l.id", $leaveid);
    $this->db->where("l.deleted_by", 0);
    $this->db->where("u.deleted_by", 0);
    return $this->db->get()->row();
  }
  
  public function addAdminAction($actionDetails){
    $this->db->set('status', $actionDetails['status']);
    $this->db->set('action_by', $actionDetails['actionById']);
    $this->db->set('action_datetime', $actionDetails['actionDateTime']);
    $this->db->where('id', $actionDetails['leaveid']);
    $this->db->update('rkuh_checkinout');
    return $this->db->affected_rows();
  }
  

  //Security Functions
  public function addSecurityAction($actionDetails){
    $id = $actionDetails['leaveid'];
    $this->db->where('id',$id);
    $row = $this->db->get('rkuh_checkinout')->row();
    // echo $row->actual_out_by;
    // echo $row->achual_in_by;
    // echo $row->status;
    // exit;
    if($row->status == 1){
      return 0;
    }
    if($row->status == 4){
      return 4;
    }

    if($row->actual_out_by == 0 && $row->status == 2){
      // Student is suppoes to leave the campus
      $this->db->set('status', 3);
      $this->db->set('actual_out_by', $actionDetails['actionById']);
      $this->db->set('actual_out_datetime', $actionDetails['actionDateTime']);
      $this->db->where('id', $id);
      $this->db->where('deleted_by', 0);
      $this->db->update('rkuh_checkinout');
      return $this->db->affected_rows();
    }
    if($row->achual_in_by == 0 && $row->status == 3){
      // Student is suppoes to come back to the campus
      $this->db->set('status', 4);
      $this->db->set('achual_in_by', $actionDetails['actionById']);
      $this->db->set('actual_in_datetime', $actionDetails['actionDateTime']);
      $this->db->where('id', $id);
      $this->db->where('deleted_by', 0);
      $this->db->update('rkuh_checkinout');
      return $this->db->affected_rows();
    }
  }
}
