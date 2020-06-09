<?php

namespace App\Models\Site;

use App\Models\Model;

class OrdersProductsModel extends Model
{
  public $table = 'orders_products';

  public function create($attributes)
  {
    $sql = "INSERT INTO {$this->table} (product, quantity, session, user, value, subtotal) VALUES (?,?,?,?,?,?)";
    $this->typeDatabase->prepare($sql);
    $i = 1;
    foreach ($attributes as $attribute) {
      $this->typeDatabase->bindValue($i, $attribute);
      $i++;
    }
    return $this->typeDatabase->execute();
  }
}
