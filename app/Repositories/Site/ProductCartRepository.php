<?php

namespace App\Repositories\Site;

use App\Classes\Cart;
use App\Models\Site\ProductModel;

class ProductCartRepository
{
  private $products;
  private $cart;

  public function __construct()
  {
    $this->products = new ProductModel;
    $this->cart = new Cart;
  }

  public function allProductsCart()
  {
    $products = [];

    $cart = $this->cart->allProductsCart();
    foreach ($cart as $id => $qtd) {
      $productsCart = $this->products->find('id', $id);
      $valueProduct = ($productsCart->product_promotion == 1)
        ? $productsCart->product_value_promotion
        : $productsCart->product_value;

      $products[] = [
        'products' => $productsCart,
        'subtotal' => $valueProduct * $qtd,
        'qtd' => $qtd,
        'value' => $valueProduct
      ];
    }

    return $products;
  }

  public function totalProductsCart()
  {
    $total = 0;
    $cart = $this->cart->allProductsCart();
    foreach ($cart as $id => $qtd) {
      $productsCart = $this->products->find('id', $id);
      $valueProduct = ($productsCart->product_promotion == 1)
        ? $productsCart->product_value_promotion
        : $productsCart->product_value;
        $total += $valueProduct * $qtd; // += significa que o valor multiplicado dos produtos vai somar com o total anterior
    }

    return $total;
  }
}
