<?php

class ClosedRequests extends Controller {

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
      $this->loadModel('HomeModel');
      $fullName = $this->model->fetchData('full_name');

      $this->loadModel('RequestModel');
      $requests = $this->model->closedRequest();

      $this->view->layout('request/closed', array('fullname' => $fullName, 'requests' => $requests));
    }
  }
  
}
