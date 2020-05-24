<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\ProductModel;

class DetailsController extends BaseController
{

  private $product;

  public function __construct()
  {
    $this->product = new ProductModel;  
  }

  public function index(array $slug)
  {
    $productFound = $this->product->find('product_slug', $slug[0]);
    
    $data = [
      'title' => 'Detalhes do produto'.$productFound->product_name, //Details of product
      'product' => $productFound
    ];

    $template = $this->twig->load('site_details.html');
    $template->display($data);
  }
}
