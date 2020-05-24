<?php


if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
  return false;    // serve the requested resource as-is.
} else {
  session_start();

  define('DEFAULT_CONTROLLER', 'home');
  define('DEFAULT_METHOD', 'index');

  function host() {
   return $_SERVER["HTTP_HOST"].'/public';
  }

  require '../vendor/autoload.php';
  require '../app/Functions/functions_twig.php';
  require 'bootstrap/bootstrap.php';
}
