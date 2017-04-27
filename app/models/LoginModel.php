<?php

class LoginModel extends Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function validate($email,$password) {
    if(!empty($email) && !empty($password))
    {
      $sth = $this->db->prepare("SELECT * FROM members WHERE email = :email AND password = :password");
      $sth->execute([':email' => $email, ':password' => $password]);

      if($sth->rowCount() > 0)
      {
        Session::set('userEmail', $email);
        $userId = $this->fetchData('id');

        Session::set('loggedIn', true);
        Session::set('userID', $userId);

        $this->json->response('success', '');
      }
      else
      {
        $this->json->response('error', 'Invalid login, please try again.');
      }
    }
    else
    {
      $this->json->response('error', 'Both fields are required.');
    }
  }

  public function fetchData($data)
  {
    $email = $_SESSION['userEmail'];

    $sth = $this->db->prepare("SELECT * FROM members WHERE email = :email");
    $sth->execute([':email' => $email]);

    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach($rows as $row)
    {
      return $row[$data];
    }
  }


}
