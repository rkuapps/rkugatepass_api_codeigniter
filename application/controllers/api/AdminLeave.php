<?php defined('BASEPATH') or exit('No direct script access allowed');


class AdminLeave extends CI_Controller
{
  public function __construct(){
    parent::__construct();
    //load database
    $this->load->database();
    $this->load->model(array("api/Leave_Model"));
  } 

  public function getAdminAllLeave($status=-1)
  {
      $filter = array();
      $leaves = $this->Leave_Model->getAllLeaves($status);
      if (count($leaves) > 0) {
        $this->send_response(true, count($leaves), "Total " . count($leaves) . " leaves are there.", $leaves);
      } else {
        $this->send_response(false, 0, "There is not leaves yet.", $leaves);
      }
    
  }

  public function getAdminLeaveDetail($leaveid = 0){
    $leaves = array();
    if ($leaveid != 0) {
      $leaves = $this->Leave_Model->getLeaveDetails($leaveid);
		$this->send_response(true, 1, "Total leaves are there.", $leaves);
	  //if (count($leaves) > 0) {
      //} else {
      //  $this->send_response(false, 0, "There is not leaves yet.", $leaves);
      //}
    } else {
      $this->send_response(false, 0, "Userid not received", $leaves);
    }
  }

	
  public function adminActionLeave(){
    $leaveid = $this->input->post('leaveid');
    $status = $this->input->post('status');
    $actionById = $this->input->post('actionById');
    $actionDateTime = $this->input->post('actionDateTime');

    if ($leaveid != "" && $status != "" && $actionById != "" && $actionDateTime != "") {
      $actionDetails = array(
        "leaveid" => $leaveid,
        "status" => $status,
        "actionById" => $actionById,
        "actionDateTime" => $actionDateTime
      );
      $leaveid = $this->Leave_Model->addAdminAction($actionDetails);
      $this->send_response(true, 1, "Leave updated successfully.", $leaveid);
    } else {
      $this->send_response(false, 0, "Details missing in request.", array());
    }
  }

  public function send_response($success = false, $count = 0, $message = "", $data = array()){
    $response = array(
      "success" => $success,
      "records" => $count,
      "message" => $message,
      "data" => $data
    );
    echo json_encode($response);
  }
}
