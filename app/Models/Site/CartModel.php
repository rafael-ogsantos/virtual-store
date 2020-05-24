<?php

namespace App\Models\Site;

use App\Models\Model;

class CartModel extends Model
{
  public $table = 'cart';

  /**
   * @param array $attributes
   * @return bool
   */
  public function add(array $attributes): bool
  {
    $sql = "INSERT INTO {$this->table} (product, quantity, session, created_at, expire) VALUES (?,?,?,?,?)";
    $this->typeDatabase->prepare($sql);
    foreach ($attributes as $key => $value) {
      $this->typeDatabase->bindValue($key, $value);
    }
    return $this->typeDatabase->execute();
  }

  /**
   * @param int $id 
   * @param int $qtd
   * @return bool
   */
  public function update(int $id, $qtd): int
  {
    $sql = "UPDATE {$this->table} SET quantity = ? WHERE product = ?";
    $this->typeDatabase->prepare($sql);
    $this->typeDatabase->bindValue(1, $qtd);
    $this->typeDatabase->bindValue(2, $id);
    $this->typeDatabase->execute();
    return $this->typeDatabase->rowCount();
  }

  /**
   * @param int $id
   * @return bool
   */
  public function remove(int $id): bool
  {
    $sql = "DELETE FROM {$this->table} WHERE product = ?";
    $this->typeDatabase->prepare($sql);
    $this->typeDatabase->bindValue(1, $id);
    return$this->typeDatabase->execute();
  }
}
