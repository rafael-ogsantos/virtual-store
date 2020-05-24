<?php

namespace App\Classes;

use App\Interfaces\InterfaceTemplateEmail;

class TemplateContact extends FormatTemplate implements InterfaceTemplateEmail
{
  public function template($data)
  {
    $template = file_get_contents('Emails/email_contact.php');
    return $this->replaceVariables($template, $data);
  }
}