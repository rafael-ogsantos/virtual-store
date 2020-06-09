<?php

use App\Classes\Parameters;
use App\Classes\Template;
use App\Controllers\Controller;
use App\Controllers\Method;
use App\Repositories\Site\ProductRepository;

date_default_timezone_set('America/Sao_Paulo');

$template = new Template;
$twig = $template->init(); 

$twig->addFunction($site_url);
$twig->addFunction($categories);
$twig->addFunction($newsProducts);
$twig->addFunction($breadCrumb);
$twig->addFunction($valueProductsInCart);
$twig->addFunction($numberProductsInCart);
$twig->addFunction($subtotalProducts);
$twig->addFunction($logged);
$twig->addFunction($user);
$twig->addFunction($errorField);
$twig->addFunction($persist);
$twig->addFunction($flash);
$twig->addFunction($stock);
// $twig->addFunction($dataFrete);

/**
 * Chamando o controller digitado na url
 * http://localhost:8000/controller
 */
$callController = new Controller;
$calledController = $callController->controller();
$controller = new $calledController();

$controller->setTwig($twig);
/**
 * Chamando metodo digitado na url
 * http://localhost:8000/method
 */

$callMethod = new Method;
$method = $callMethod->method($controller);

/**
 * Chamando o controller atraves da classe Controller  e da classe method
 */
$parameters = new Parameters;
$parameter = $parameters->getParameterMethod($controller, $method);
$controller->$method($parameter);

