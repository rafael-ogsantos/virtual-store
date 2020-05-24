<?php

namespace App\Traits;

trait FormatCurrency
{
  public function format_currency($type)
  {
      $currencyReplace = str_replace($type, '.', ',');
      return $currencyReplace;
  }
}
