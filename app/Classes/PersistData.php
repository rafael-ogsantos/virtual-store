<?php

namespace App\Classes;

class PersistData
{
  public function add(string $value)
  {
    if(!isset($_SESSION['persist'][$value])) {
      $_SESSION['persist'][$value] = $_POST[$value];
    }
  }

  public function show(string $field): string
  {
    if(isset($_SESSION['persist'][$field])) {
      $persist = $_SESSION['persist'][$field];
    }
    unset($_SESSION['persist'][$field]);
    return isset($persist) ? $persist : '';
  }

  public static function removeAllDataInputs()
  {
    unset($_SESSION['persist']);
  }
}