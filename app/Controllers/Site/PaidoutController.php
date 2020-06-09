<?php

namespace App\Controllers\Site;

use App\Classes\PagSeguroAdapter;
use App\Classes\PagSeguroStatusTransaction;
use App\Controllers\BaseController;

class PaidoutController extends BaseController
{
  public function index()
  {
    //if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notificationType']) === 'transaction') {
      $notificationCode = 'C6968EA2CACBCACBF412243DEF897F84F645';
      $email = 'rafaeloliveira806@yahoo.com.br';
      $tokenPagSguro = 'E3BF1CBE7E444492B5B9091CE97FA46F';

      $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/{$notificationCode}?email={$email}&token={$tokenPagSguro}";

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $transaction_curl = curl_exec($curl);
      curl_close($curl);

      $transaction = simplexml_load_string($transaction_curl);
      $paymentStatus = new PagSeguroAdapter(new PagSeguroStatusTransaction($transaction));
      $paymentStatus->managesStatus($transaction->status);
    //}
  }
}
