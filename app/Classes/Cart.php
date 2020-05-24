<?php

namespace App\Classes;

use App\Classes\StatusCart;
use App\Classes\Stock;
use App\Models\Site\CartModel;

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
    if($this->stock->currentStock($id) > 1) {
      if ($this->statusCart->productInCart($id)) {
        $_SESSION['cart'][$id] += 1;
        $this->cartModel->update($id, $this->productCart($id));
      } else {
        $_SESSION['cart'][$id] = 1;
        $this->cartModel->add([
          1 => $id,
          2 => 1,
          3 => 123,
          4 => date('Y-m-d H:i:s'),
          5 => date('Y-m-d H:i:s', strtotime('+1minutes'))
        ]);
      }
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
      $_SESSION['cart'][$id] = $qtd;
      $this->cartModel->update($id, $qtd);
    }
  }

  public function removeProductCart(int $id)
  {
    if ($this->statusCart->productInCart($id)) {
      unset($_SESSION['cart'][$id]);
      $this->cartModel->remove($id);
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
