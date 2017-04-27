<?php

class Model {

  public function __construct() {
    $this->db = new Database();
    $this->redirect = new Redirect();
    $this->session = new Session();
    $this->json = new Json();
  }

}
