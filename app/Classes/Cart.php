<?php

namespace App\Classes;

use App\Classes\StatusCart;
use App\Classes\Stock;
use App\Classes\IdRandom;
use App\Models\Site\CartModel;
use App\Models\Site\StockModel;

class Cart
{
  private $statusCart;
  private $stock;
  private $cartModel;

  public function __construct()
  {
    $this->statusCart = new StatusCart;
    $this->statusCart->createCart();
    $this->stock = new Stock;
    $this->cartModel = new CartModel;
  }

  /**
   * Com o id do produto passado, verifica se ja existe o produto
   * no carrinho. Se existir, adiciona mais um, senão entra um
   * @param int $id id do produto
   */

  public function add(int $id)
  {
    if ($this->stock->currentStock($id) > 0) {
      if ($this->statusCart->productInCart($id)) {
        $_SESSION['cart'][$id] += 1;
        $this->cartModel->update($id, $this->productCart($id), IdRandom::generateId());
      } else {
        $_SESSION['cart'][$id] = 1;
        $this->cartModel->add([
          1 => $id,
          2 => 1,
          3 => IdRandom::generateId(),
          4 => date('Y-m-d H:i:s'),
          5 => date('Y-m-d H:i:s', strtotime('+30minutes'))
        ]);
      }
      (new StockModel)->update($id, ($this->stock->currentStock($id) - 1));
    }
  }

  /**
   * Retorna o produto desejado apartir do id
   * @param int $id id do produto
   * @return session Todos produtos de determinado id
   */

  public function productCart(int $id)
  {
    return $_SESSION['cart'][$id];
  }

  /**
   * @param int $id Product id
   * @param int $qtd Product quantity
   */
  public function updateCart(int $id, int $qtd)
  {
    if ($this->statusCart->productInCart($id)) {

      $currentStock = $this->stock->currentStock($id);
      $difference = abs($_SESSION['cart'][$id] - $qtd);




      $stockModel = new StockModel;

      if ($_SESSION['cart'][$id] > $qtd) {
        (!$currentStock > $difference) ?: $stockModel->update($id, ($currentStock + $difference));
      } else {
        if (!$this->stock->hasStock($id, $difference)) {
          echo 'semEstoque';
          die();
        }
        $stockModel->update($id, ($currentStock - $difference));
      }

      $_SESSION['cart'][$id] = $qtd;
      $this->cartModel->update($id, $qtd, IdRandom::generateId());
    }
  }

  public function removeProductCart(int $id)
  {
    if ($this->statusCart->productInCart($id)) {
      $this->cartModel->remove($id, IdRandom::generateId());
      (new StockModel)->update($id, ($this->stock->currentStock($id) + $this->productCart($id)));
      unset($_SESSION['cart'][$id]);
    }
  }

  public function clearCart()
  {
    if ($this->statusCart->cartExists()) {
      unset($_SESSION['cart']);
    }
  }

  public function allProductsCart()
  {
    if ($this->statusCart->cartExists()) {
      return $this->statusCart->cart();
    }
  }
}
