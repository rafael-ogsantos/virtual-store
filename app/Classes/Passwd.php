<?php

namespace App\Classes;

class Passwd
{
  public function hash($passwd)
  {
    $options = [
      'cost' => 11
    ];

    return password_hash($passwd, PASSWORD_BCRYPT, $options);
  }

  /**
   * @param passwd 123
   * @param hash 123 = sas221$567yhjm212
   */
  public function verifyPasswd($passwd, $hash)
  {
    if(password_verify($passwd, $hash)) {
      return true;
    }
    return false;
  }
}