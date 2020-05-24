<?php

namespace App\Classes;

class BreadCrumb
{
  private $uri;

  public function __construct()
  {
    $this->uri = (new Uri)->getUri();
  }

  public function createBreadCrumb()
  {
    if(substr_count($this->uri, '?') > 0) {
      $explodeEqual = explode('=', $this->uri);
      return "
      <span style='	color: #000;'>
        Você esta buscando:  <span style='font-style: italic; color: rgb(10, 118, 151)'>" .str_replace('+', '-', $explodeEqual[1]) . 
                             '</span>' .
      '</span>';
    }

    if($this->uri == '/'){
      return "<span style='	color: #000; font-weight: 600'>Navegação:</span>  
      <span style='font-style: italic; color: rgb(10, 118, 151)'>Início</span>";
    }

    return "<span style='	color:#000;'>Navegação:</span> <span style='font-style: italic; color: rgb(10, 118, 151)'>
    <a href=''>Início</a> >" . str_replace('/', '>', ltrim($this->uri, '/')) . '</span>';
  }
}
