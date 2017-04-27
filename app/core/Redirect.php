<?php

class Redirect {

  public function to($location) {
    header('Location:'.URL. $location);
  }

}


?>
