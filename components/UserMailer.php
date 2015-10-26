<?php

namespace app\components;

use Yii;
use app\models\User;

class UserMailer {
  public $user = null;

  public function __construct(User $user)
  {
    $this->user = $user;
  }

  public function registration($password)
  {
    $email = $this->user->email;
    $subject = Yii::t('User Mailer Registration Email Subject');
    $template = 'user_mailer/registration';
    $data = ['user' => $this->user, 'password' => $password];
    return Yii::$app->mailer->send($this->user->email, $subject, $template, $data);
  }

  public function confirmation()
  {
    $email = $this->user->email;
    $subject = Yii::t('User Mailer Confirmation Email Subject');
    $template = 'user_mailer/confirmation';
    $data = ['user' => $this->user];
    return Yii::$app->mailer->send($this->user->email, $subject, $template, $data);
  }

  public function reset_password($password)
  {
    $email = $this->user->email;
    $subject = Yii::t('User Mailer Reset Password Email Subject');
    $template = 'user_mailer/reset_password';
    $data = ['user' => $this->user, 'password' => $password];
    return Yii::$app->mailer->send($this->user->email, $subject, $template, $data);
  }
}

?>
