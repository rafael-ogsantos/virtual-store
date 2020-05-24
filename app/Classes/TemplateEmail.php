<?php

namespace App\Classes;

use App\Interfaces\InterfaceTemplateEmail;

class TemplateEmail
{
  private $templateInterface;

  public function __construct(InterfaceTemplateEmail $templateInterface)
  {
    $this->templateInterface = $templateInterface;
  }

  public function show($data)
  {
    return $this->templateInterface->template($data);
  }
}