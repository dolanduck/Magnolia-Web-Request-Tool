<?php

class Json {

  public function response($type, $message)
  {
      $data = array('type' => $type, 'message' => $message);
      header('Content-Type: application/json');
      echo json_encode($data);
  }

}




?>
