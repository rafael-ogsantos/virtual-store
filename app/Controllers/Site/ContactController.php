<?php

namespace App\Controllers\Site;

use App\Classes\Email;
use App\Classes\ErrorsValidate;
use App\Classes\Filters;
use App\Classes\FlashMessages;
use App\Classes\PersistData;
use App\Classes\TemplateContact;
use App\Classes\Validate;
use App\Controllers\BaseController;

class ContactController extends BaseController
{
  public function index()
  {
    $data = [
      'title' => ''
    ];

    $template = $this->twig->load('site_contact.html');
    $template->display($data);
  }

  public function submit()
  {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $rules = [
        'nome' => 'required',
        'email' => 'required|email',
        'assunto' => 'required',
        'mensagem' => 'required'
      ];
      (new Validate)->validate($rules);

      $errorsValidate = new ErrorsValidate;

      if(!$errorsValidate->errorValidation()) {
        $filter = new Filters;
        $flashMessage = new FlashMessages;
        $name = $filter->filter('nome', 'string');
        $email = $filter->filter('email', 'string');
        $subjectMatter = $filter->filter('assunto', 'string');
        $message = $filter->filter('mensagem', 'string');

        $phpMailer = new Email;
        $phpMailer->setTo('rafaelogsantos@gmail.com');
        $phpMailer->setWho($email);
        $phpMailer->setSubjectMatter($subjectMatter);
        $phpMailer->setMessage(['nome' => $name, 'data' => date('d/m/Y H:i:s'), 'mensagem' => $message]);
        $phpMailer->setTemplate(new TemplateContact);

        if($phpMailer->submit()) {
          $flashMessage->add('submit_success', 'Email enviado com sucesso !!', 'success');
          PersistData::removeAllDataInputs();
          redirect('/contact');
        }
      }     
      redirect('/contact');
    }
  }
}