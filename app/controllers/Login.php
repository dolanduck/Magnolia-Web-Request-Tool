<?php

class Login extends Controller {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    if(isset($_SESSION['loggedIn']) == true)
    {
       $this->redirect->to('home');
    }
    else
    {
       $this->view->layout('login/index');
    }
  }

  public function validate() {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $this->loadModel('loginModel');
    $this->model->validate($email,$password);

  }
  
}

?>
