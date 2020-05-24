<?php

namespace App\Classes;

class Uri {
  
  private $uri;

  public function __construct()
  {
    $this->uri = $_SERVER['REQUEST_URI'];
  }

  public function emptyUri()
  {
    return ($this->uri == '/') ? true : false;
  }

  public function getUri()
  {
    return $this->uri;
  }

}