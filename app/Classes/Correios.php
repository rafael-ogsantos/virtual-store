<?php

namespace App\Classes;

use Cagartner\CorreiosConsulta\CorreiosConsulta;

class Correios
{
  private $type;

   /**
   * @var string Box | Envelope
   */

  private $format;

  /**
   * @var string
   */

  private $cep_destiny;

  /**
   * @var string
   */
  private $cep_source;

  /**
   * @var int
   */

  private $weight;

  /**
   * @var int
   */

  private $length;

  /**
   * @var int
   */

  private $height;

  /**
   * @var int
   */

  private $width;

  /**
   * @var int
   */

  private $diameter;

  /**
   *  @var mixed 
   */

  private $correios;

  public function __construct()
  {
    $this->correios = new CorreiosConsulta();
  }

  public function setType($type)
  {
    $this->type = $type;
  }

  public function setFormat($format)
  {
    $this->format = $format;
  }

  public function setCepDesiny($cep_destiny)
  {
    $this->cep_destiny = $cep_destiny;
  }

  public function setCepSource($cep_source)
  {
    $this->cep_source = $cep_source;
  }

  public function setWeight($weight)
  {
    $this->weight = $weight;
  }

  public function setLenght($length)
  {
    $this->length = $length;
  }

  public function setHeight($height)
  {
    $this->height = $height;
  }

  public function setWidth($width)
  {
    $this->width = $width;
  }

  public function setDiameter($diameter)
  {
    $this->diameter = $diameter;
  }

  private function dataCalculateFrete()
  {
    $data = [
      'tipo'              => $this->type, // Separar opções por vírgula (,) caso queira consultar mais de um (1) serviço. > Opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
      'formato'           => $this->format, // opções: `caixa`, `rolo`, `envelope`
      'cep_destino'       => $this->cep_destiny, // Obrigatório
      'cep_origem'        => $this->cep_source, // Obrigatorio
      //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
      //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
      'peso'              => $this->weight, // Peso em kilos
      'comprimento'       => $this->length, // Em centímetros
      'altura'            => $this->height, // Em centímetros
      'largura'           => $this->width, // Em centímetros
      'diametro'          => $this->diameter, // Em centímetros, no caso de rolo
      // 'mao_propria'       => '1', // Náo obrigatórios
      // 'valor_declarado'   => '1', // Náo obrigatórios
      // 'aviso_recebimento' => '1', // Náo obrigatórios
    ];

    return $data;
  }

  public function calculateFrete()
  {
    return $this->correios->frete($this->dataCalculateFrete());
  }
}
