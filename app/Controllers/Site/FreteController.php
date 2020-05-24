<?php

namespace App\Controllers\Site;

use App\Classes\Correios;
use App\Classes\Frete;
use App\Classes\Logged;
use App\Controllers\BaseController;
use App\Repositories\Site\ProductCartRepository;

class FreteController extends BaseController
{
  private $productCartRepository;
  private $correios;

  public function __construct()
  {
    $this->productCartRepository = new ProductCartRepository;
    $this->correios = new Correios;
  }

  public function calculate()
  {

    $logged = new Logged;
    if (!$logged->logged()) {
      echo json_encode('login');
      die();
    }
    if (empty($this->productCartRepository->allProductsCart())) {
      echo json_encode('products');
      die();
    }

    $cep = filter_input(INPUT_POST, 'frete', FILTER_SANITIZE_STRING);
    $this->correios->setFormat('rolo');
    $this->correios->setType('sedex');
    $this->correios->setCepSource('12343535');
    $this->correios->setCepDesiny(str_replace('-', '', $cep));
    $this->correios->setWeight('15');
    $this->correios->setLenght('19');
    $this->correios->setWidth('20');
    $this->correios->setHeight('20');
    $this->correios->setDiameter('10');
    $dataFrete = $this->correios->calculateFrete();

    if ($dataFrete['erro']['codigo'] !== 0.0) {
      echo json_encode([
        'erro' => true,
        'message' => 'CEP inválido'
      ]);
    } else {
      $frete = new Frete;
      $frete->recordFrete($dataFrete['valor']);
      echo json_encode([
        'erro' => false,
        'frete' => $dataFrete
      ]);
    }
  }
}
