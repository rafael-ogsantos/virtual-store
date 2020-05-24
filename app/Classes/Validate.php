<?php

namespace App\Classes;

use App\Classes\TypeValidate;
use App\Classes\PersistData;

class Validate
{
  private $typeValidate;

  public function __construct()
  {
    $this->typeValidate = new TypeValidate;
  }
  public function validate(array $rules)
  {
    foreach ($rules as $field => $method) {
      (new PersistData)->add($field);
      if (substr_count($method, '|') > 0) {
        $explodePipe = explode('|', $method);
        foreach ($explodePipe as $methodPipe) {
          $this->typeValidate->$methodPipe($field);
        }
      } else {
        $this->typeValidate->$method($field);
      }
    }
  }
}
