<?php

use App\Classes\Redirect;

function redirect($route) {
  return (new Redirect)->redirect($route);
}