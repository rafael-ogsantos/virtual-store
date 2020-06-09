<?php

namespace App\Classes;

class PagSeguro
{
  private $name;
  private $surname;
  private $email;
  private $ddd;
  private $telephone;
  private $referenceId;
  private $credentials;
  private $itemAdd = [];
  private $pagSeguroConfig;

  public function __construct()
  {
    $this->pagSeguroConfig = new \PagSeguroPaymentRequest;
    \PagSeguroLibrary::init();
  }

  private function purchaseData()
  {
    $this->pagSeguroConfig->setSender($this->name.' '. $this->surname, $this->email, $this->ddd, $this->telephone);
    $this->pagSeguroConfig->setReference($this->referenceId);
    $this->pagSeguroConfig->setShippingAddress(null);
    $this->pagSeguroConfig->setCurrency('BRL');
    foreach($this->itemAdd as $item) {
      $this->pagSeguroConfig->addItem(
        $item['products']->id,
        $item['products']->product_name,
        $item['qtd'],
        $item['value'],
      );
    }
  }

  public function sendPagSeguro()
  {
    $this->purchaseData();
    $this->credentials = new \PagSeguroAccountCredentials(
      'rafaeloliveira806@yahoo.com.br',
      'E3BF1CBE7E444492B5B9091CE97FA46F'
    );
    return $this->pagSeguroConfig->register($this->credentials);
  }

  /**
   * Set the value of name
   *
   * @return  self
   */ 
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

    /**
   * Set the value of surname
   *
   * @return  self
   */ 
  public function setSurname($surname)
  {
    $this->surname = $surname;

    return $this;
  }

  /**
   * Set the value of email
   *
   * @return  self
   */ 
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Set the value of ddd
   *
   * @return  self
   */ 
  public function setDdd($ddd)
  {
    $this->ddd = $ddd;

    return $this;
  }

  /**
   * Set the value of telephone
   *
   * @return  self
   */ 
  public function setTelephone($telephone)
  {
    $this->telephone = $telephone;

    return $this;
  }

  /**
   * Set the value of referenceId
   *
   * @return  self
   */ 
  public function setReferenceId($referenceId)
  {
    $this->referenceId = $referenceId;

    return $this;
  }

  /**
   * Set the value of credentials
   *
   * @return  self
   */ 
  public function setCredentials($credentials)
  {
    $this->credentials = $credentials;

    return $this;
  }

  /**
   * Set the value of itemAdd
   *
   * @return  self
   */ 
  public function setItemAdd($itemAdd)
  {
    $this->itemAdd = $itemAdd;

    return $this;
  }


}