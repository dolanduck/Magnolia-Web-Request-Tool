<?php


class ChangePassword extends Controller
{
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
       $requests = $this->model->openRequest();

       $this->view->layout('home/changepassword', array('fullname' => $fullName, 'requests' => $requests));
     }
   }

   public function change()
   {
     $current_password = $_POST['current_password'];
     $new_password = $_POST['new_password'];
     $new_password_repeat = $_POST['new_password_repeat'];

     if(!empty($current_password) && !empty($new_password) && !empty($new_password_repeat))
     {
       if($new_password != $new_password_repeat)
       {
         $this->json->response('error', 'The new passwords do not match.');
       }
       else
       {
         $current_password = md5($current_password);
         $updated_password = md5($new_password);
         $this->loadModel('PasswordModel');
         $this->model->updatePassword($current_password, $updated_password);
       }
     }
     else
     {
        $this->json->response('error', 'All fields are required.');
     }
   }


}
