<?php

class Edit extends Controller {
  public function __construct() {
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
      $this->loadModel('HomeModel');
      $fullName = $this->model->fetchData('full_name');
      $request_number = $_POST['request_number'];
      if(!empty($request_number))
      {
        $this->loadModel('RequestModel');
        $singleRequest = $this->model->singleRequest($request_number);

        $this->view->layout('request/edit', array('fullname' => $fullName, 'request' => $singleRequest));
      }
      else
      {
        $this->view->layout('request/error', array('fullname' => $fullName));
      }
    }
  }


  public function update()
  {
    $request_id = $_POST['request_id'];
    $requester_name = $_POST['requester_name'];
    $requester_phone = $_POST['requester_phone'];
    $publish_date = $_POST['publish_date'];
    $priority = $_POST['priority'];
    $description = $_POST['description'];

    if(!empty($request_id) && !empty($requester_name) && !empty($requester_phone) && !empty($publish_date) && !empty($priority) && !empty($description))
    {
      $this->loadModel('RequestModel');
      $this->model->updateRequest($request_id,$requester_name,$requester_phone,$publish_date,$priority,$description);
    }
    else
    {
       $this->view->layout('request/error', array('fullname' => $fullName));
    }
  }


}
