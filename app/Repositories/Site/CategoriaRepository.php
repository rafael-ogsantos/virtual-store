<?php

namespace App\Repositories\Site;

use App\Models\Site\CategoryModel;
use Exception;

class CategoriaRepository
{
  private $category;

  public function __construct()
  {
    $this->category = new CategoryModel;
  }

  public function listProductsCategory()
  {
    try {
      $sql = "SELECT category_slug, category_name FROM {$this->category->table} GROUP BY categorias.id";
      $this->category->typeDatabase->prepare($sql);
      $this->category->typeDatabase->execute();
      return $this->category->typeDatabase->fetchAll();
    }catch(Exception $e){
      echo $e->getMessage();
    }
  }
}
