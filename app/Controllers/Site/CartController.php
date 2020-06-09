<?php

namespace App\Controllers\Site;

use App\Classes\Cart;
use App\Classes\ExpiredCartProducts;
use App\Classes\Frete;
use App\Controllers\BaseController;
use App\Repositories\Site\ProductCartRepository;

class CartController extends BaseController
{
  private $cart;
  private $productsCartRepository;

  public function __construct()
  {
    $this->cart = new Cart;
    $this->productsCartRepository = new ProductCartRepository;
  }

  public function index()
  {
    // $expiredProducts = new ExpiredCartProducts;
    // $expiredProducts->checkProductsExpiredCart();

    $products = $this->productsCartRepository->allProductsCart();
    $frete = new Frete;
    $data = [
      'title' => 'Carrinho',
      'products' => $products,
      'frete' => $frete->rescueFrete()
    ];

    $template = $this->twig->load('site_cart.html');
    $template->display($data);
  }

  public function add($param)
  {
    $this->cart->add($param[0]);
  }

  public function get()
  {
    echo json_encode([
      'numberProductsCart' => count($this->cart->allProductsCart()),
      'valueProductsCart' => $this->productsCartRepository->totalProductsCart()
    ]);
  }

  public function update()
  {
    $id = (int) $_POST['id'];
    $quantity = (int) $_POST['qtd'];
    if ($quantity === '' || $quantity === 0) {
      
      $this->cart->removeProductCart($id);
      echo 'deleted';
    } else {
      $this->cart->updateCart($id, $quantity);
      echo 'updated';
    }
  }

  public function delete()
  {
    $id = (int) $_POST['id'];
    $this->cart->removeProductCart($id);
    unset($_SESSION['frete']);
    echo 'deleted';
  }
}
