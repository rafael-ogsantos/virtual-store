<?php

namespace App\Classes;

use App\Models\Site\StockModel;
use App\Repositories\Site\StockRepository;

class Stock 
{
  private $stockRepository;
  private $stockModel;

  public function __construct()
  {
    $this->stockRepository = new StockRepository;
  }

  /**
   * @param int $id
   * @return int
   */
  public function currentStock(int $id): int
  {
    return $this->stockRepository->quantityProductStock($id)->stock_quantity;
  }

  /**
   * @param int $qtdProductStock
   * @param int $qtdProductCart
   * @return bool
   */
  public function hasStock(int $id, int $qtdProductCart): bool
  {
    if($this->currentStock($id) < $qtdProductCart) {
      return false;
    }
    return true;
  }

  public function updateStock(int $id, int $qtd)
  {
    $stockModel = new StockModel;
    $stockModel->update($id, $qtd);
  }
}