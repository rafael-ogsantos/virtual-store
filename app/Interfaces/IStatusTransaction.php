<?php

namespace App\Interfaces;

interface IStatusTransaction
{
  public function waitForPayment();
  public function inAnalysis();
  public function approvedSale();
  public function paymentAvailable();
  public function inDispute();
  public function returnedAmout();
  public function cancelledPurchase();
}
