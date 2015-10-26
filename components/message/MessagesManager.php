<?php

namespace app\components\message;

use Yii;
use app\models\User;
use app\models\Message;
use app\components\message\MessageMailer;

class MessagesManager {
  static public function create($data, $user_id = null)
  {
      $user_id = $user_id == null ? Yii::$app->user->id : $user_id;

      $model = new Message();
      $model->load($data);
      $model->receiver_status = 'new';
      $model->sender_status = 'new';
      $model->sender_user_id = $user_id;
      $model->created_at = time();

      $success = $model->save();

      if($success)
      {
        $mailer = new MessageMailer($model);
        $mailer->new_message();
      }

      return $model;
  }

  static public function read($message, $user_id = null)
  {
    $user_id = $user_id == null ? Yii::$app->user->id : $user_id;
    if($message->sender_user_id == $user_id)
    {
      return $message;
    }

    if($message->receiver_user_id == $user_id)
    {
      if($message->sender_status == 'new')
      {
        $message->sender_status = 'read';
      }

      if($message->receiver_status == 'new')
      {
        $message->receiver_status = 'read';
      }

      $message->save();
    }

    return $message;
  }


  static public function delete($message, $user_id = null)
  {
    $user_id = $user_id == null ? Yii::$app->user->id : $user_id;

    if($message->sender_user_id == $user_id)
    {
      $message->sender_status = 'deleted';
      $message->save();
      return $message;
    }

    if($message->receiver_user_id == $user_id)
    {
      $message->receiver_status = 'deleted';
      $message->save();
      return $message;
    }

    return $message;
  }
}

?>
