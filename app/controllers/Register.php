<?php

class Register extends Controller {
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    if(isset($_SESSION['loggedIn']) == true)
    {
       $this->redirect->to('home');
    }
    else
    {
       $this->view->layout('register/index');
    }
  }

  public function create()
  {
     $full_name = $_POST['full_name'];
     $email = $_POST['email'];
     $password = md5($_POST['password']);
     $confirm_password = md5($_POST['confirm_password']);

     if(!empty($full_name && !empty($email) && !empty($password) && !empty($confirm_password)))
     {
       if($password != $confirm_password)
       {
         $this->json->response('error', 'The passwords do not match.');
       }
       else
       {
         $this->loadModel('RegisterModel');
         $this->model->create($full_name,$email,$password);
       }
     }
     else
     {
       $this->json->response('error', 'All fields are required.');
     }
  }

}

?>
