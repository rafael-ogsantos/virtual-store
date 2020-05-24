<?php

namespace App\Models\Database\ConnectDatabase;

use App\Interfaces\InterfaceConnectDatabase;
use PDO;

class ConnectPdoDatabase implements InterfaceConnectDatabase
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = new PDO('mysql:host=localhost;dbname=loja_virtual', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function ConnectDatabase()
  {
    return $this->pdo;
  }
}