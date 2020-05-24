<?php

namespace App\Models\Database\ConnectDatabase;

use App\Interfaces\InterfaceConnectDatabase;
use mysqli;

class ConnectMysqliDatabase implements InterfaceConnectDatabase
{
  private $mysqli;

  public function __construct()
  {
    $this->mysqli =  new mysqli('localhost', 'root', '', 'loja_virtual');
  }

  public function connectDatabase()
  {
    return $this->mysqli; 
  }
}