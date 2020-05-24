<?php

namespace App\Controllers\Site;

use App\Classes\ErrorsValidate;
use App\Classes\Filters;
use App\Classes\FlashMessages;
use App\Classes\Validate;
use App\Controllers\BaseController;
use App\Models\Site\User;

class RegisterController extends BaseController
{
  private $errorValidate;
  private $validate;
  private $filters;
  private $user;
  private $flash;

  public function __construct()
  {
    $this->errorValidate = new ErrorsValidate;
    $this->validate = new Validate;
    $this->filters = new Filters;
    $this->user = new User;
    $this->flash = new FlashMessages;
  }

  public function index()
  {
    $data = [
      'titulo' => 'Cadastro',
    ];

    $template = $this->twig->load('site_register.html');
    $template->display($data);
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $rules = [
        'nome' => 'required',
        'sobrenome' => 'required',
        'email' => 'required|email',
      ];

      $this->validate->validate($rules);

      if (!$this->errorValidate->errorValidation()) {
        $name = $this->filters->filter('nome', 'string');
        $firstName = $this->filters->filter('sobrenome', 'string');
        $email = $this->filters->filter('email', 'string');

        $atributes = [$name, $firstName, $email];

        if ($this->user->create($atributes)) {
          $this->flash->add('message_register', 'Cadastrado com sucesso!', 'success');
          unset($_SESSION['persist']);
          return redirect('/register');
        }

        $this->flash->add('message_register', 'Erro ao cadastrar', 'danger');
        return redirect('/register');
      } else {
        redirect('/register');
      }
    }
  }

  public function update()
  {
    # code...
  }
}
