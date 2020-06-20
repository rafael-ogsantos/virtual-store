<?php

namespace App\Classes;

use App\Interfaces\InterfaceLogin;
use App\Classes\Passwd;
use App\Models\Model;

class Login
{
  private $email;
  private $passwd;

  public function setEmail(string $email)
  {
    $this->email = $email;
  }

  public function setPasswd(string $passwd)
  {
    $this->passwd = $passwd;
  }

  public function login(Model $model): bool
  {
    $userFound = $model->find('email', $this->email);
    if (!$userFound) {
      return false;
    }
  
    $passwd = new Passwd;
   
    if($passwd->verifyPasswd($this->passwd, $userFound->passwd)){
      $_SESSION['id'] = $userFound->id;
      $_SESSION['name'] = $userFound->name;
      $_SESSION['logged'] = true;
      return true;
    }
    return false;
  }
}
