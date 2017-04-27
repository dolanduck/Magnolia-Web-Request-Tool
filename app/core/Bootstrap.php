<?php

class Bootstrap {

    private $controller = null;

    private $method = null;

    private $params = [];

    public function init()
    {
        $this->segments();

        //If controller is empty load default controller.
        if(!$this->controller) {
            require APP_DIR . 'controllers/Home.php';
            $page = new Home();
            $page->index();
            return false;
        }

        $control = APP_DIR . 'controllers/'. $this->controller . '.php';

        if(file_exists($control)) {
          require $control;

          $this->controller = new $this->controller;

          if(method_exists($this->controller, $this->method)) {

              if(!empty($this->params)) {
                call_user_func_array([$this->controller, $this->method], $this->params);
              } else {
                $this->controller->{$this->method}();
              }

          } else {

            if(empty($this->method)) {
              $this->controller->index();
            } else {
              //Invalid method
              echo 'Invalid method..';
            }

          }

        }

    }

    public function segments()
    {

      if(isset($_GET['url']))
      {
        $url = $_GET['url'];
        $url = rtrim($url, '/');
        $segment = explode('/', $url);

        $this->controller = isset($segment[0]) ? $segment[0]: null;
        $this->method = isset($segment[1]) ? $segment[1]: null;

        unset($segment[0], $segment[1]);

        $this->params = array_values($segment);
      }

    }



}
