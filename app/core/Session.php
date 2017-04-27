<?php


class Session {

  public function init() {
    session_start();
  }

  public function set($key, $value) {
     $_SESSION[$key] = $value;
  }

  public function get($key) {
     return $_SESSION[$key];
  }

  public function destroy() {
    session_destroy();
  }


}
