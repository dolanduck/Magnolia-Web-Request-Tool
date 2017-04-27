<?php

class View {

  //Render Full layout for each controller/page
  public function layout($template, array $vars = array()) {
    ob_start();
    extract($vars);

    require_once APP_DIR. 'views/layout/header.php';
    require_once APP_DIR. 'views/layout/navigation.php';
    require_once APP_DIR. 'views/'.$template.'.php';
    require_once APP_DIR. 'views/layout/footer.php';
  }

  //Render single view
  public function render($template, array $vars = array()) {
     ob_start();
     extract($vars);
     require_once APP_DIR. 'views/'.$template.'.php';
  }

}
