<?php

class PasswordModel extends Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function updatePassword($current_password,$updated_password)
  {
    $userId = $_SESSION['userID'];

    if($this->verifyCurrentPassword($userId, $current_password) == 1) {
      $sth = $this->db->prepare("UPDATE members SET password = :new_password WHERE id = :user_id");
      $sth->execute([':new_password' => $updated_password, ':user_id' => $userId]);
      $this->json->response('error', 'Your password has been changed.');
    }
    else {
      $this->json->response('error', 'Incorrect Password');
    }
  }

  public function verifyCurrentPassword($userId, $current_password)
  {
     $sth = $this->db->prepare("SELECT * FROM members WHERE id = :user_id AND password = :current_password");
     $sth->execute([':user_id' => $userId, ':current_password' => $current_password]);

     return $sth->rowCount();
  }

}
