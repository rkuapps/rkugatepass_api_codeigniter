<?php defined('BASEPATH') or exit('No direct script access allowed');


class SecurityLeave extends CI_Controller
{
  public function __construct(){
    parent::__construct();
    //load database
    $this->load->database();
    $this->load->model(array("api/Leave_Model"));
  } 

  public function securityActionLeave(){
    $leaveid = $this->input->post('leaveid');
    $actionById = $this->input->post('actionById');
    $actionDateTime = $this->input->post('actionDateTime');
    
    if ($leaveid != "" && $actionById != "" && $actionDateTime != "") {
      $actionDetails = array(
        "leaveid" => $leaveid,
        "actionById" => $actionById,
        "actionDateTime" => $actionDateTime
      );

      $responseid = $this->Leave_Model->addSecurityAction($actionDetails);
      if($responseid==0){
        $this->send_response(false, 0, "Leave is not approved.", array());
        return;
      }

      if($responseid==4){
        $this->send_response(false, 0, "User is already in side campus.", array());
        return;
      }
      
      $leavedetail = $this->Leave_Model->getLeaveDetails($leaveid);
      $this->send_response(true, 1, "Leave updated successfully.", $leavedetail);

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
