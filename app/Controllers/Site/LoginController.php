<?php

namespace App\Controllers\Site;

use App\Classes\Filters;
use App\Classes\Logged;
use App\Classes\Login;
use App\Controllers\BaseController;
use App\Models\Site\User;

class LoginController extends BaseController
{
  public function index()
  {
    $logged = new Logged;
    if ($logged->logged()) {
      $this->redirect->redirect('/');
    }

    $data = [
      'titulo' => 'Sou um dev Top!!',
    ];

    $template = $this->twig->load('site_login.html');
    $template->display($data);
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $filter = new Filters;

      $email = $filter->filter('email', 'string');
      $passwd = $filter->filter('passwd', 'string');

      $login = new Login;
      $login->setEmail($email);
      $login->setPasswd($passwd);

      if ($login->login(new User)) {
        return redirect('/');
      }
      return redirect('/login');
    }
    return redirect('/');
  }

  public function logout()
  {
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['logged']);
    redirect('/');
  }
}
