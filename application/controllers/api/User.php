<?php defined('BASEPATH') or exit('No direct script access allowed');


class User extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //load database
    $this->load->database();
    $this->load->model(array("api/User_Model"));
  }

  public function validateUser($email = "")
  {
    //$email = $this->input->post('email');
    //echo json_encode(array("Test"=>$email));
    //exit;

    $email = urldecode($email);
    $user = array();

    if ($email != "") {
      $user = $this->User_Model->validateUser($email);
      if (count($user) > 0) {
        $this->send_response(true, 1, "Login Successful", $user[0]);
      } else {
        $this->send_response(false, 0, $email . " is not registered email.", $user);
      }
    } else {
      $this->send_response(false, 0, "Email not received", $user);
    }
  }

  public function getUsers()
  {
    $response = array();
    $users = $this->User_Model->getUsersData();
    // print_r($users);
    if (count($users) > 0) {
      $response = array(
        "success" => 1,
        "records" => count($users),
        "message" => "Students found",
        "data" => $users
      );
    } else {
      $response = array(
        "success" => 0,
        "records" => count($users),
        "message" => "No Students found",
        "data" => $users
      );
    }
    echo json_encode($response);
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
