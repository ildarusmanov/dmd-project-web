<?php
namespace app\components\helpers;

use Yii;
use app\models\User;
use yii\helpers\ArrayHelper;

class MessagesHelper {
  static public function receivers_list($user_id = 0)
  {
    $users = User::find()->where('id != :id', ['id' => $user_id])->all();
    $receivers = ['0' => Yii::t('app', 'Message System User')];
    return ArrayHelper::merge($receivers, ArrayHelper::map($users, 'id', 'name'));
  }
}
