<?php

namespace App\Classes;

use App\Classes\ErrorsValidate;

class TypeValidate
{
  private $errorsValidate;

  public function __construct()
  {
    $this->errorsValidate = new ErrorsValidate;
  }
  public function required($field)
  {
    if (empty($_POST[$field])) {
      $message = "O campo $field é obrigatório";
      $this->errorsValidate->add($field, $message);
    }
  }

  public function email($field)
  {
    if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
      $message = "O campo $field deve ter um email valido";
      $this->errorsValidate->add($field, $message);
    }
  }

  public function phone()
  {
    # code...
  }

  public function postalCode()
  {
    # code...
  }

  public function ddd()
  {
    # code...
  }
}
