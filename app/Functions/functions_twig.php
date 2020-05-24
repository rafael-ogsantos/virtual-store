<?php

use App\Classes\BreadCrumb;
use App\Classes\Cart;
use App\Classes\ErrorsValidate;
use App\Classes\FlashMessages;
use App\Classes\Frete;
use App\Classes\Logged;
use App\Classes\PersistData;
use App\Classes\Stock;
use App\Models\Site\User;
use App\Repositories\Site\CategoriaRepository;
use App\Repositories\Site\ProductCartRepository;
use App\Repositories\Site\ProductRepository;
use App\Repositories\Site\ProdutoRepository;
use App\Traits\FormatCurrency;

$site_url = new \Twig\TwigFunction('site_url', function(){
  return 'http://'.$_SERVER['SERVER_NAME'].':8000';
});

// Listar as categorias

$categories = new \Twig\TwigFunction('categories', function(){
  $categoriesRepositories = new CategoriaRepository; 
  return $categoriesRepositories->listProductsCategory();
});

// Listar as novidades
$newsProducts = new \Twig\TwigFunction('news_products', function(){
  return (new ProductRepository)->lastProductAdded();
});

$breadCrumb = new \Twig\TwigFunction('breadCrumb', function(){
  return (new BreadCrumb)->createBreadCrumb();
}); 

$valueProductsInCart = new \Twig\TwigFunction('valueProductsInCart', function(){
  return (new ProductCartRepository)->totalProductsCart();
}); 

$numberProductsInCart = new \Twig\TwigFunction('numberProductsInCart', function(){
  return (new Cart)->allProductsCart();
});

// $dataFrete = new \Twig\TwigFunction('dataFrete', function(){
//   return new Frete;
// });

$subtotalProducts = new \Twig\TwigFunction('subtotalProducts', function(){
  $frete = new Frete;
  $valueFrete = $frete->rescueFrete();
  $cart = new ProductCartRepository;
  $subtotalProducts = $cart->totalProductsCart();
  return $valueFrete + $subtotalProducts;
});

$logged = new \Twig\TwigFunction('logged', function(){
  return (new Logged)->logged();
});

$user = new \Twig\TwigFunction('user', function(){
  $user = new User;
  $logged = new Logged;
  return $user->find('id', $_SESSION['id']);
});

$errorField = new \Twig\TwigFunction('errorField', function($field){
  return (new ErrorsValidate)->show($field);
});

$persist = new \Twig\TwigFunction('persist', function($field){
  return (new PersistData)->show($field);
});

$flash = new \Twig\TwigFunction('flash', function($index){
  return (new FlashMessages)->show($index);
});

$stock = new \Twig\TwigFunction('stock', function($id){
  return (new Stock)->currentStock($id);
});







