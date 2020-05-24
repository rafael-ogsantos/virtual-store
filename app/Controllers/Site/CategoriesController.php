<?php

namespace App\Controllers\Site;

use App\Classes\Redirect;
use App\Controllers\BaseController;
use App\Models\Site\CategoryModel;
use App\Models\Site\ProductModel;

class CategoriesController extends BaseController
{
  public function index($params)
  {
    $category = new CategoryModel;
    $categoryFound = $category->find('category_slug', $params[0]);
   
    if(!$categoryFound){
      (new Redirect)->redirect('/');
    }

    $product = new ProductModel;
    $productsFound = $product->find('product_category', $categoryFound->id, 'teste');
    $data = [
      'titulo' => 'Home',
      'products' => $productsFound,
      'category' => $categoryFound
    ];

    $template = $this->twig->load('site_category.html');
    $template->display($data);
  }
}