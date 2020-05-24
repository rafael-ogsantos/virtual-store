<?php

namespace App\Controllers\Site;

use App\Classes\Logged;
use App\Classes\Redirect;
use App\Controllers\BaseController;
use App\Models\Site\User;

class AccountController extends BaseController
{
  public function index()
  {
    $logged = new Logged;

    if (!$logged->logged()) {
      redirect('/');
    }

    $user = new User;
    $dataUser = $user->find('id', $_SESSION['id']);
    
    $data = [
      'title' => 'Minha conta',
      'user' => $dataUser
    ];

    $template = $this->twig->load('site_account.html');
    $template->display($data);
  }
}
