<?php

namespace App\Classes;

use App\Models\Site\CartModel;
use App\Classes\Cart;

class ExpiredCartProducts
{
  public function checkProductsExpiredCart()
  {
    $cartModel = new CartModel;
    $cart = new Cart;

    $expiredProducts = $cartModel->expiredProducts();
    foreach ($expiredProducts as $product) {
      $cartModel->remove($product->product);
      $cart->removeProductCart($product->product);
    }
  }
}
