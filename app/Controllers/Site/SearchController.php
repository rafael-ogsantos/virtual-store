<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProductRepository;

class SearchController extends BaseController
{
  private $product;

  public function __construct()
  {
    $this->product = new ProductRepository;  
  } 

  public function index()
  {
    $search = filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING);
    $productFounds = $this->product->searchProduct($search);
    
    $data = [
      'title' => 'Busca',
      'products' => $productFounds
    ];

    $template = $this->twig->load('site_search.html');
    $template->display($data);
  }
}
