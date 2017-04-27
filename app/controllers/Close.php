<?php


class Close extends Controller {

  public function __construct() {
    parent::__construct();
  }


  public function index()
  {
    if(isset($_SESSION['loggedIn']) == false)
    {
      $this->redirect->to('login');
    }
    else if(!empty($_POST['request_number']))
    {
      $this->loadModel('HomeModel');
      $fullName = $this->model->fetchData('full_name');

      $request_number = $_POST['request_number'];
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
         $this->model->closeRequest($request_number);
         $this->sendEmail($request_number);
      }
    }
    else {
      echo '<h1>Sorry, you have to close the request the right way!</h1>';
    }
  }


  public function sendEmail($request_number) {
    require APP_DIR. 'mail/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = '';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '';                 // SMTP username
    $mail->Password = '';                           // SMTP password
    $mail->SMTPSecure = '';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom('', '');    // Add a recipient
    $mail->addAddress('acastillo@megdigital.com');               // Name is optional
    $mail->Subject = 'Web Request #'. $request_number;
    $mail->Body    = 'Lia,<br><br>Web Request #'.$request_number.' has been completed, please close it.<br><br> Thanks.';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }

  }

}
