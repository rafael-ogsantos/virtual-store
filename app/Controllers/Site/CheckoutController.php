<?php

namespace App\Controllers\Site;

use App\Classes\Cart;
use App\Classes\Correios;
use App\Classes\Frete;
use App\Classes\IdRandom;
use App\Classes\Logged;
use App\Classes\PagSeguro;
use App\Controllers\BaseController;
use App\Models\Site\OrdersModel;
use App\Models\Site\OrdersProductsModel;
use App\Models\Site\User;
use App\Repositories\Site\ProductCartRepository;
use Exception;

class CheckoutController extends BaseController
{
  private $productsCart;
  private $correios;
  private $ordersproducts;
  private $orders;

  public function __construct()
  {
    $this->productsCart = new ProductCartRepository;
    $this->correios = new Correios;
    $this->ordersproducts = new OrdersProductsModel;
    $this->orders = new OrdersModel;
  }

  public function index()
  {
    //  Check if exists product in cart
    $productsCart = $this->productsCart->allProductsCart();

    if (empty($productsCart)) {
      echo json_encode('empty');
      die();
    }

    // Check if the user is logged
    $logged = new Logged;
    if (!$logged->logged()) {
      echo json_encode('notLoggedIn');
      die();
    }

    // Check if calculate freight
    $freight = new Frete;
    if ($freight->rescueFrete() == 0) {
      echo json_encode('frete');
      die();
    }

    foreach ($productsCart as $product) {
      $orderProduct = new OrdersProductsModel;
      $registeredOrders = $orderProduct->create([
        'product' => $product['products']->id,
        'quantity' => $product['qtd'],
        'session' => IdRandom::generateId(),
        'user' => $_SESSION['id'],
        'value' => $product['value'],
        'subtotal' => $product['subtotal']
      ]);
    }

    $orders = new OrdersModel;

    $registeredRequest = $orders->create([
      'user_request' => $_SESSION['id'],
      'freight_order' => $freight->rescueFrete(),
      'order_status' => 2,
      'session' => IdRandom::generateId(),
      'created_at' => date('Y-m-d H:i:s'),
      'total' => $this->productsCart->totalProductsCart()
    ]);



    if ($registeredOrders && $registeredRequest) {
      $pagSeguro = new PagSeguro;
      $data = [
        'products' => (object) [
          'id' => 1,
          'product_name' => 'Frete'
        ],
        'qtd' => 1,
        'value' => $freight->rescueFrete()
      ];

      array_push($productsCart, $data);

      $user = new User;
      $dataUser = $user->find('id', $_SESSION['id']);
      $pagSeguro->setItemAdd($productsCart);
      $pagSeguro->setName($dataUser->name);
      $pagSeguro->setSurname($dataUser->surname);
      $pagSeguro->setEmail($dataUser->email);;
      $pagSeguro->setDdd('11');
      $pagSeguro->setTelephone('942308672');
      $pagSeguro->setReferenceId(IdRandom::generateId());

      //c19992223763338148296@sandbox.pagseguro.com.br
      //ss
      $cart = new Cart;
      try {
        $url = $pagSeguro->sendPagSeguro();
        $cart->clearCart();
        $freight->clearFrete();
        echo json_encode([
          'url' => $url,
          'redirect' => true
        ]);
      } catch (Exception $e) {
        echo json_encode($e->getMessage());
      }
    }
  }
}
