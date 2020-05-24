<?php

namespace App\Classes;

class StatusCart
{

  /**
   *  Verifica se uma sessão carrinho existe
   * @return bool
   */
  public function cartExists(): bool
  {
    return (isset($_SESSION['cart'])) ? true : false;
  }

  // Se o carrinho não existir, cria
  public function createCart()
  {
    if (!$this->cartExists()) {
      $_SESSION['cart'] = [];
    }
   // return $_SESSION['cart'];
  }

  /**
   * Verfica se o produto passado existe no carrinho
   * @param int $id do produto.
   * @return bool Se existir o produto daquele id retorna true, senão falso
  */

  public function productInCart(int $id): bool
  {
    if (isset($_SESSION['cart'][$id])) {
      return true;
    }
    return false;
  }

  public function cart()
  {
    return $_SESSION['cart'];
  }
}
