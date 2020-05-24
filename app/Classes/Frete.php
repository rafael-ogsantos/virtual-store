<?php

namespace App\Classes;

class Frete
{
  private function freteCalculated()
  {
    if (!isset($_SESSION['frete']) || $_SESSION['frete'] !== true) {
      return false;
    }
    return true;
  }

  public function recordFrete($frete)
  {
    $_SESSION['frete'] = true;
    $_SESSION['valor'] = $frete;
  }

  public function rescueFrete()
  {
    if ($this->freteCalculated()) {
      return $_SESSION['valor'];
    }
    return 0;
  }

  public function cleanFrete()
  {
    unset($_SESSION['frete']);
    unset($_SESSION['valor']);
  }
}
