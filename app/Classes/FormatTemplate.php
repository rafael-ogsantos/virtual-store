<?php

namespace App\Classes;

use Exception;

class FormatTemplate
{
  private $allKeys = [];
  private $allValues = [];
  const PATH_TO_EMAIL_FOLDERS = 'Email';
  
  public function replaceVariables($template, $data)
  {
    foreach($data as $key => $value) {
      $this->allKeys[] = '#' . $key;
      $this->allValues[].= $value;
    }
    $data = str_replace($this->allKeys, $this->allValues, $template);
    return $data;
  
  }
}