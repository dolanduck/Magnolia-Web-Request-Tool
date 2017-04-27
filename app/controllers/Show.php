<?php

/**
 *
 */
class Show extends Controller
{

  function __construct()
  {
    parent::__construct();
  }


  public function request($request_number)
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
      $singleRequest = $this->model->singleRequest($request_number);
      $existingRequest = $this->model->existingRequest($request_number);

      if($existingRequest == 0)
      {
        $error = true;
        $this->view->layout('request/error', array('fullname' => $fullName, 'error' => $error));
      }
      else
      {
        $this->loadModel('StatusModel');
        $showStatus = $this->model->showStatus($request_number);
        $this->view->layout('request/entry', array('fullname' => $fullName, 'request' => $singleRequest, 'status' => $showStatus));
      }
      
    }
  }


  public function postStatus()
  {
      $status = $_POST['status'];
      $request_number = $_POST['request_number'];
      if(empty($status))
      {
        $this->json->response('error', 'The status cannot be empty.');
      }
      else
      {
        $this->loadModel('StatusModel');
        $this->model->postStatus($status, $request_number);
      }
  }

  public function removeStatus()
  {
    $status_id = $_POST['status_id'];

    if(!empty($status_id))
    {
      $this->loadModel('statusModel');
      $this->model->removeStatus($status_id);
    }
    else
    {
       echo '<h1>Remove this status the right way!</h1>';
    }
  }

}
