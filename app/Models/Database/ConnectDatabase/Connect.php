<?php

namespace App\Models\Database\ConnectDatabase;

use App\Interfaces\InterfaceConnectDatabase;

class Connect
{
  private $interfaceConnectDatabase;

  public function __construct(InterfaceConnectDatabase $interfaceConnectDatabase)
  {
    $this->interfaceConnectDatabase = $interfaceConnectDatabase;    
  }

  public function connectDatabase()
  {
    return $this->interfaceConnectDatabase->connectDatabase();
  }
}