<?php

namespace App\Classes;

class ErrorsValidate
{
  /**
   * @param string $field Message index
   * @param string $field Your message
   */
  public function add(string $field, string $message)
  {
    if (!$_SESSION['error'][$field]) {
      $_SESSION['error'][$field] = $message;
    }
  }

   /**
   * @param string $field Message index
   * @return string
   */
  public function show(string $field): string
  {
    if (isset($_SESSION['error'][$field])) {
      $message = $_SESSION['error'][$field];
    }
    unset($_SESSION['error'][$field]);
    return (isset($message)) ? "<span style='color: red'>* " . $message . "</span>" : '';
  }

  /**
   * @return bool
   */
  public function errorValidation(): bool
  {
    if (isset($_SESSION['error'])) {
      return (empty($_SESSION['error'])) ? false : true;
    }
  }
}
