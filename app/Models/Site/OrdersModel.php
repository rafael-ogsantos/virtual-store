<?php

namespace App\Models\Site;

use App\Models\Model;

class OrdersModel extends Model
{
  public $table = 'orders';

  // public function create($attributes)
  // {
  //   $sql = "INSERT INTO {$this->table} (user_request, freight_order, order_status, session, created_at, total)
  //   VALUES (?,?,?,?,?,?)";
  //   $this->typeDatabase->prepare($sql);
  //   $i=1;
  //   foreach($attributes as $attribute){
  //     $this->typeDatabase->bindValue($i, $attribute);
  //     $i++;
  //   }
  //   return $this->typeDatabase->execute();
  // }
}
