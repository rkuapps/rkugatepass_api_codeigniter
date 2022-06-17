<?php defined('BASEPATH') or exit('No direct script access allowed');


class StudentLeave extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //load database
    $this->load->database();
    $this->load->model(array("api/Leave_Model"));
  } 

  public function getMyLeave($userid = "")
  {
    //$userid = $this->input->post('userid');
	
    $leaves = array();
    if ($userid != "") {
      $leaves = $this->Leave_Model->getMyLeaves($userid);
      if (count($leaves) > 0) {
		$this->send_response(true, count($leaves), "Total " . count($leaves) . " leaves are there.", $leaves);
      } else {
        $this->send_response(false, 0, "There is not leaves yet.", $leaves);
      }
    } else {
      $this->send_response(false, 0, "Userid not received", $leaves);
    }
  }

  public function addMyLeave($userid = "", $out_datetime = "", $in_datetime = "", $reason = "")
  {
    $userid = $this->input->post('userid');
    $out_datetime = $this->input->post('out_datetime');
    $in_datetime = $this->input->post('in_datetime');
    $reason = $this->input->post('reason');

    if ($userid != "" && $out_datetime != "" && $in_datetime != "" && $reason != "") {
      $leaveData = array(
        "userid" => $userid,
        "out_datetime" => $out_datetime,
        "in_datetime" => $in_datetime,
        "reason" => $reason,
        "created_by" => $userid
      );
      $leaveid = $this->Leave_Model->addLeave($leaveData);
      $this->send_response(true, 1, "Leave added successfully.", $leaveid);
    } else {
      $this->send_response(false, 0, "Details missing in request.", array());
    }
  }

  public function deleteMyLeave($userid = "", $leaveid = "")
  {
    $userid = $this->input->post('userid');
    $leaveid = $this->input->post('leaveid');
    $deletedLeavesId = "";

    if ($userid != "" && $leaveid != "") {
      $deletedRowCount = $this->Leave_Model->deleteMyLeaves($userid, $leaveid);
      if ($deletedRowCount > 0) {
        $this->send_response(true, 1, "Leave is deleted.", $deletedLeavesId);
      } else {
        $this->send_response(false, 0, "Leave deletion failed", array());
      }
    } else {
      $this->send_response(false, 0, "Userid or Leaveid not received", array());
    }
  }

  public function send_response($success = false, $count = 0, $message = "", $data = array())
  {
    $response = array(
      "success" => $success,
      "records" => $count,
      "message" => $message,
      "data" => $data
    );
    echo json_encode($response);
  }
}
