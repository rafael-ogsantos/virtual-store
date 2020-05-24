<?php

namespace App\Classes;

use App\Repositories\Site\StockRepository;

class Stock 
{
  private $stockRepository;

  public function __construct()
  {
    $this->stockRepository = new StockRepository;
  }

  public function currentStock(int $id)
  {
    return $this->stockRepository->quantityProductStock($id)->stock_quantity;
  }
}