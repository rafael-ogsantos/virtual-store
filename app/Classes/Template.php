<?php

namespace App\Classes;
class Template
{
  public function loader()
  {
    return new \Twig\Loader\FilesystemLoader(['../app/Views/Site/']);
  }

  public function init()
  {
    $twig = new \Twig\Environment($this->loader(), [
      'debug' => true,
      // 'cache' => ''
      'auto_reload' => true
    ]);

    return $twig;
  }
}
