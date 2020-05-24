<?php

namespace App\Controllers;

class BaseController
{
  protected $twig;

  public function setTwig($twig)
  {
    $this->twig = $twig;
  }
}
