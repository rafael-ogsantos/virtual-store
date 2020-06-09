<?php

namespace App\Controllers\Site;

use App\Classes\Cart;
use App\Classes\ExpiredCartProducts;
use App\Controllers\BaseController;
use App\Models\Site\ProductModel;
use App\Models\Site\User;
use App\Repositories\Site\ProductRepository;

class HomeController extends BaseController
{
  public function index()
  {
    // $expiredProducts = new ExpiredCartProducts;
    // $expiredProducts->checkProductsExpiredCart();
    
    $productRepository = new ProductRepository;
    $productsFeatured = $productRepository->listProductsOrderedByHighLight(3);

    $productsPromotion = $productRepository->listProductPromotion(5);
   
    $data = [
      'titulo' => 'Sou um dev Top!!',
      'nome' => 'Rafael',
      'products' => $productsFeatured,
      'promotions' => $productsPromotion
    ];

    $template = $this->twig->load('site_home.html');
    $template->display($data);
  }
}