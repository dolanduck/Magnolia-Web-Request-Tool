<?php

class RegisterModel extends Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function create($full_name,$email,$password)
  {

    if(strpos($email, '@megdigital.com') == false) {
      $this->json->response('error', 'You must have a @questdiagnostics.com email address to sign up.');
      return false;
    }

    if($this->usersWithEmail($email) == 1)
    {
      $this->json->response('error', 'There is already an account with this email.');
    }
    else
    {
      $sth = $this->db->prepare("INSERT into members (full_name,email,password) VALUES (:full_name,:email,:password)");
      $sth->execute([':full_name' => $full_name, ':email' => $email, ':password' => $password]);

      Session::set('userEmail', $email);
      $userId = $this->fetchData('id');

      Session::set('loggedIn', true);
      Session::set('userID', $userId);
      $this->json->response('success', '');
    }

  }

  public function usersWithEmail($email)
  {
    $sth = $this->db->prepare("SELECT id FROM members WHERE email = :email");
    $sth->execute([':email' => $email]);

    if($sth->rowCount() > 0)
    {
      return 1;
    }
    else
    {
      return 0;
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
