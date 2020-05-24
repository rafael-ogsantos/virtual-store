<?php

namespace App\Classes;

class FlashMessages
{
  /**
   * @param string $index Message code (example: data_success)
   * @param string $message Your flash message
   * @param string $type Background color
   */
  public function add(string $index, string $message, string $type = null)
  {
    $typeMessage = ($type === null) ? 'danger' : $type;
    if(!isset($_SESSION['flash'][$index])) {
      $_SESSION['flash'][$index] = "<div class='status alert alert-". $typeMessage ."'>". $message ."</div>";
    }
  }

  /**
   * @param string $index Message code previously defined
   * @return string your message
   */
  public function show(string $index): string
  {
    if(isset($_SESSION['flash'][$index])) {
      $message = $_SESSION['flash'][$index];
    }
    unset($_SESSION['flash'][$index]);
    return isset($message) ? $message : '';
  }
}