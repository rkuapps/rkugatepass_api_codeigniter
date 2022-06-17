<?php
class User_Model extends CI_Model{

  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function validateUser($email){
    $this->db->select("*");
    $this->db->from("rkuh_users");
    $this->db->where("email",$email);
    $this->db->where("deleted_by", 0);
    $query = $this->db->get();
    return $query->result();
  }  

  public function getUsersData(){
    $this->db->select("*");
    $this->db->from("rkuh_users");
    $this->db->where("deleted_by", 0);
    $query = $this->db->get();
	echo $query->num_rows();exit;
    return $query->result();
  }
}
