<?php

namespace App\Classes;

class Logged
{
  public function logged()
  {
    if(isset($_SESSION['logged']) && $_SESSION['logged']){
      return true;
    }
    return false;
  }
}