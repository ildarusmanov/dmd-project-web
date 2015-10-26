<?php
namespace app\components\helpers;

use Yii;
use app\models\User;
use yii\helpers\ArrayHelper;

class UsersHelper {
  static public function users_list($user_id = 0)
  {
    $users = User::find()->where('id != :id', ['id' => $user_id])->all();
    return ArrayHelper::map($users, 'id', 'name');
  }
}
