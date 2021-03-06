<?php

namespace App\Classes;

class Filters
{
  /**
   * @param string $value Input field
   * @param string $type Field type
   */
  public function filter(string $value, string $type)
  {
    switch($type) {
      case 'string':
        return filter_var($_POST[$value], FILTER_SANITIZE_STRING);
      break;
      case 'int':
        return filter_var($_POST[$value], FILTER_SANITIZE_NUMBER_INT);
      break;
      case 'email':
        return filter_var($_POST[$value], FILTER_SANITIZE_EMAIL);
      break;
    }
  }
}
