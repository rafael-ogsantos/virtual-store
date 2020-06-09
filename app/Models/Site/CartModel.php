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
   * @param string $session User session
   * @return bool
   */
  public function update(int $id, $qtd, string $session): int
  {
    $sql = "UPDATE {$this->table} SET quantity = ? WHERE product = ? and session = ?";
    $this->typeDatabase->prepare($sql);
    $this->typeDatabase->bindValue(1, $qtd);
    $this->typeDatabase->bindValue(2, $id);
    $this->typeDatabase->bindValue(3, $session);
    $this->typeDatabase->execute();
    return $this->typeDatabase->rowCount();
  }

  /**
   * @param int $id
   * @param string $session User session
   * @return bool
   */
  public function remove(int $id, string $session): bool
  {
    $sql = "DELETE FROM {$this->table} WHERE product = ? and session = ?";
    $this->typeDatabase->prepare($sql);
    $this->typeDatabase->bindValue(1, $id);
    $this->typeDatabase->bindValue(2, $session);
    return $this->typeDatabase->execute();
  }

  public function expiredProducts()
  {
    $sql = "SELECT * FROM {$this->table} where NOW() > expire";
    $this->typeDatabase->prepare($sql);
    $this->typeDatabase->execute();
    return $this->typeDatabase->fetchAll();
  }
}
