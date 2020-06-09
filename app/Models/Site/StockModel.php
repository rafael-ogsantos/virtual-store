<?php

namespace App\Models\Site;

use App\Models\Model;

class StockModel extends Model
{
  public $table = 'stock';

  public function update(int $id, int $qtd)
  {
    $sql = "UPDATE {$this->table} SET stock_quantity = ? WHERE stock_product = ?";
    $this->typeDatabase->prepare($sql);
    $this->typeDatabase->bindValue(1, $qtd);
    $this->typeDatabase->bindValue(2, $id);
    $this->typeDatabase->execute();
    return $this->typeDatabase->rowCount();
  }
}