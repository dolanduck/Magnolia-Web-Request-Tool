<?php

class Controller {

   public function __construct() {
     $this->view = new View();
     $this->redirect = new Redirect();
     $this->session = new Session();
     $this->json = new Json();
     Session::init();
   }

   public function loadModel($modelName) {
     require_once APP_DIR. 'models/'.$modelName.'.php';
     $this->model = new $modelName;
     return $this->model;
   }

}
