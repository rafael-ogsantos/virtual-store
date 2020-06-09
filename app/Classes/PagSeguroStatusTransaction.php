<?php

namespace App\Classes;

use App\Interfaces\IStatusTransaction;
use App\Models\Site\CartModel;
use App\Models\Site\OrdersModel;
use App\Classes\Stock;
use App\Classes\Email;

class PagSeguroStatusTransaction implements IStatusTransaction
{
  private $dataPagSeguro;
  private $orders;
  private $email;
  private $cart;
  private $stock;

  public function __construct($dataPagSeguro)
  {
    $this->dataPagSeguro = $dataPagSeguro;
    $this->orders = new OrdersModel;
    $this->email = new Email;
    $this->cart = new CartModel;
    $this->stock = new Stock;
  }

  public function waitForPayment()
  {
    dd('aguardando pagamento');
  }

  public function inAnalysis()
  {
    dd('em analise');
  }

  public function approvedSale()
  {
    dd('compra aprovada');
  }

  public function paymentAvailable()
  { 
    dd('pagamento disponvel');
  }

  public function inDispute()
  {
    dd($this->dataPagSeguro);
  }

  public function returnedAmout()
  {
    dd('valor de retorno');
  }

  public function cancelledPurchase()
  {
    dd('compra cancelada');
  }
}