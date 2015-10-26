<?php

namespace app\components\wajox_software;

use Yii;

class Mailer {
  public $user = null;

  public $from = null;

  public function __construct($from)
  {
    $this->from = $from;
  }

  public function send($to, $subject, $template, $data = [], $options = [])
  {

    $from = isset($optinos['from']) ? $options['from'] : $this->from;

    $message = Yii::$app->swift_mailer->compose([
        'html' => $template . '_html',
        'text' => $template . '_text'
      ], $data)
     ->setFrom($from)
     ->setSubject('registration email');

    $to = !is_array($to) ? [$to] : $to;

    $success = true;
    foreach($to as $email)
    {
      $m = clone $message;
      if(!$m->setTo($email)->send()) $success = false;
    }

    return $success;
  }
}

?>
