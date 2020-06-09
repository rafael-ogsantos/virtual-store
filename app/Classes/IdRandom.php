<?php

namespace App\Classes;

class IdRandom
{
  public static function generateId()
  {
    if(!isset($_SESSION['id_session'])) {
      $_SESSION['id_session'] = md5(uniqid(rand(), true));
    }
    return $_SESSION['id_session'];
  }
}