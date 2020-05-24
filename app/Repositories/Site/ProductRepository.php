<?php

namespace App\Repositories\Site;

use App\Models\Site\CategoryModel;
use App\Models\Site\ProductModel;
use Exception;

class ProductRepository
{
  private $product;

  public function __construct()
  {
    $this->product = new ProductModel;
  }

  public function lastProductAdded()
  {
    try {
      $sql = "SELECT 
      product_slug,product_photo,product_name, product_value_promotion, product_value
      FROM {$this->product->table} ORDER BY id DESC";

      $this->product->typeDatabase->prepare($sql);
      $this->product->typeDatabase->execute();
      return $this->product->typeDatabase->fetch();
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function listProductsOrderedByHighLight(int $limit)
  {
    try {
      $sql = "SELECT * FROM {$this->product->table} ORDER BY product_featured = 1 DESC LIMIT {$limit}";
      $this->product->typeDatabase->prepare($sql);
      $this->product->typeDatabase->execute();
      return $this->product->typeDatabase->fetchAll();
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }


  public function listProductPromotion(int $limit)
  {
    $sql = "SELECT * FROM {$this->product->table} where product_promotion = 1 LIMIT {$limit}";
    $this->product->typeDatabase->prepare($sql);
    $this->product->typeDatabase->execute();
    return $this->product->typeDatabase->fetchAll();
  }

  public function searchProduct($search)
  {
    $sql = "SELECT * FROM {$this->product->table} WHERE product_name like ? or product_description like ?";
    $this->product->typeDatabase->prepare($sql);
    $this->product->typeDatabase->bindValue(1, '%' . $search . '%');
    $this->product->typeDatabase->bindValue(2, '%' . $search . '%');
    $this->product->typeDatabase->execute();

    return $this->product->typeDatabase->fetchAll();
  }
}
