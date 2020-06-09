<?php

namespace App\Classes;

use App\Interfaces\IManagesStatusTransaction;
use App\Classes\PagSeguroStatusTransaction;

class PagSeguroAdapter implements IManagesStatusTransaction
{
  private $pagSeguroStatusTransacton;

  public function __construct(PagSeguroStatusTransaction $pagSeguroStatusTransacton)
  {
    $this->pagSeguroStatusTransacton = $pagSeguroStatusTransacton;  
  }

  public function managesStatus($status)
  {
    switch ($status) {
      case '1':
        $this->pagSeguroStatusTransacton->waitForPayment();
        break;
      case '2':
        $this->pagSeguroStatusTransacton->inAnalysis();
        break;
      case '3':
        $this->pagSeguroStatusTransacton->approvedSale();
        break;
      case '4':
        $this->pagSeguroStatusTransacton->paymentAvailable();
        break;
      case '5':
        $this->pagSeguroStatusTransacton->inDispute();
        break;
      case '6':
        $this->pagSeguroStatusTransacton->returnedAmout();
        break;
      case '7':
        $this->pagSeguroStatusTransacton->cancelledPurchase();
        break;
    }
  }
  
}
