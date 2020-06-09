<?php

namespace App\Models;

use App\Models\Database\TypeDatabase\TypeDatabase;
use App\Models\Database\TypeDatabase\TypeMysqliDatabase;
use App\Models\Database\TypeDatabase\TypePdoDatabase;
use Exception;

abstract class Model
{
  public $typeDatabase;

  public function __construct()
  {
    $database = new TypeDatabase(new TypePdoDatabase);
    $this->typeDatabase = $database->getDatabase();
  }

  public function fetchAll()
  {
    $sql = "SELECT * FROM {$this->table}";
    $this->typeDatabase->prepare($sql);
    $this->typeDatabase->execute();
    return $this->typeDatabase->fetchAll();
  }

  public function find($field, $value, $fetch = null)
  {
    $sql = "SELECT * FROM {$this->table} WHERE $field = ?";
    $this->typeDatabase->prepare($sql);
    $this->typeDatabase->bindValue(1, $value);
    $this->typeDatabase->execute();
    return ($fetch === null) ? $this->typeDatabase->fetch() : $this->typeDatabase->fetchAll();
  }

  public function create(array $attributes)
  {
    $arrKeys = [];
    foreach ($attributes as $key => $value) {
      $arrKeys[] = $key;
    }

    $implodeCommaKeys = implode(',', $arrKeys);
    $arrInterrogation = [];

    for ($i = 0; $i < count($attributes); $i++) {
      array_push($arrInterrogation, '?');
    }

    $implodeCommaInterrogation = implode(',', $arrInterrogation);
    $sql = "INSERT INTO {$this->table} ({$implodeCommaKeys}) VALUES ({$implodeCommaInterrogation})";
    $this->typeDatabase->prepare($sql);

    $i = 1;
    foreach ($attributes as $key => $value) {
      $this->typeDatabase->bindValue($i, $value);
      $i++;
    }
    return $this->typeDatabase->execute();
  }
}
