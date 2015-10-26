<?php

namespace app\components\message;

use Yii;
use app\models\User;
use app\models\Message;

class MessageMailer {
  public $message = null;

  public function __construct(Message $message)
  {
    $this->message = $message;
  }

  public function new_message()
  {
    if(!$this->message->receiverUser) return false;

    $subject = Yii::t('Message Mailer New Message Subject');
    $template = 'message_mailer/new_message';
    $email = $this->message->receiverUser->email;
    $data = ['user' => $this->message->receiverUser, 'message' => $this->message];

    return Yii::$app->mailer->send($email, $subject, $template, $data);
  }
}

?>
