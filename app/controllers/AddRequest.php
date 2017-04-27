<?php

class AddRequest extends Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    if(isset($_SESSION['loggedIn']) == false)
    {
      $this->redirect->to('login');
    }
    else
    {
      $fullName = $this->fetch('full_name');
      $this->view->layout('request/add', array('fullname' => $fullName));
    }
  }

  public function process()
  {
    $request_number = $_POST['request_number'];
    $requester_name = $_POST['requester_name'];
    $requester_phone = $_POST['requester_phone'];
    $priority = $_POST['priority'];
    $publish_date = $_POST['publish_date'];
    $description = $_POST['description'];
    $asset = 0;
    if(!empty($request_number) && !empty($requester_name) && !empty($requester_phone) && !empty($publish_date) && !empty($description) && !empty($priority))
    {
        $this->loadModel('RequestModel');
        $this->model->addRequest($request_number,$requester_name,$requester_phone,$publish_date,$description,$priority,$asset);
    }
    else
    {
       $this->json->response('error', 'Please fill in all required fields.');
    }

  }

  public function fetch($data)
  {
    $this->loadModel('HomeModel');
    $row = $this->model->fetchData($data);
    return $row;
  }



}
