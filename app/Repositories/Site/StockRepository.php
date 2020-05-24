<?php

namespace App\Repositories\Site;

use App\Models\Site\StockModel;
use Exception;

class StockRepository
{
  private $stock;

  public function __construct()
  {
    $this->stock = new StockModel;
  }

  public function quantityProductStock(int $id)
  {
    $sql = "SELECT * FROM {$this->stock->table} WHERE stock_product = ?";
    $this->stock->typeDatabase->prepare($sql);
    $this->stock->typeDatabase->bindValue(1, $id);
    $this->stock->typeDatabase->execute();
    return $this->stock->typeDatabase->fetch();
  }
}
