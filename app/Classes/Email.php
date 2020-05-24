<?php

namespace App\Classes;

use App\Interfaces\InterfaceTemplateEmail;

class Email
{

  private $email;
  private $who;
  private $to;
  private $subjectMatter;
  private $message;
  private $template;
  private $copy = [];


  public function __construct()
  {
    $this->email = new \PHPMailer\PHPMailer\PHPMailer();
  }

  /**
   * Set the value of subject
   *
   * @return  self
   */
  public function setSubject($subject)
  {
    $this->subject = $subject;

    return $this;
  }

  /**
   * Set the value of subjectMatter
   *
   * @return  self
   */
  public function setSubjectMatter($subjectMatter)
  {
    $this->subjectMatter = $subjectMatter;

    return $this;
  }

  /**
   * Set the value of message
   *
   * @return  self
   */
  public function setMessage($message)
  {
    $this->message = $message;

    return $this;
  }


  /**
   * Set the value of template
   *
   * @return  self
   */
  public function setTemplate(InterfaceTemplateEmail $template)
  {
    $this->template = $template;

    return $this;
  }

  /**
   * Set the value of copy
   *
   * @return  self
   */
  public function setCopy($copy)
  {
    $this->copy = $copy;

    return $this;
  }

  public function submit()
  {
    $templateEmail = new TemplateEmail($this->template);
    $this->email->CharSet = 'UTF-8';
    $this->email->SMTPSecure = 'tls';
    $this->email->isSMTP();
    $this->email->Host = 'smtp.gmail.com';
    $this->email->Port = 587;
    $this->email->SMTPAuth = true;
    $this->email->Username = 'rafaelogsantos@gmail.com';
    $this->email->Password = 'rafA980305';
    $this->email->isHTML(true);
    $this->email->setFrom('rafaelogsantos@gmail.com');
    $this->email->FromName = $this->who;
    $this->email->addAddress($this->to);
    if (isset($this->copy)) {
      foreach ($this->copy as $copy) {
        $this->email->addAddress($copy);
      }
    }
    $this->email->Subject = $this->subjectMatter;
    $this->email->AltBody = 'Para esse email confira se está em um programa que aceita exibir HTML';
    $this->email->msgHTML($templateEmail->show($this->message));

    if(!$this->email->send()) {
      dd($this->email->ErrorInfo);
      return false;
    }
    return true;
  }

  /**
   * Set the value of to
   *
   * @return  self
   */ 
  public function setTo($to)
  {
    $this->to = $to;

    return $this;
  }

  /**
   * Set the value of who
   *
   * @return  self
   */ 
  public function setWho($who)
  {
    $this->who = $who;

    return $this;
  }
}
