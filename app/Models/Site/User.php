<?php

namespace App\Models\Site;

use App\Models\Model;

class User extends Model
{
  protected $table = 'users';

  public function create(array $atributes)
  {
    $sql = "INSERT INTO {$this->table} (name, surname, email) VALUES (?,?,?)";
    $this->typeDatabase->prepare($sql);
    $i = 1;
    foreach ($atributes as $atribute) {
      $this->typeDatabase->bindValue($i, $atribute);
      $i++;
    }

    return $this->typeDatabase->execute();
  }
}
