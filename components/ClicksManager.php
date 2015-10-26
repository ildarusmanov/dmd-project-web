<?php
namespace app\components;

use Yii;
use app\models\User;
use app\models\Click;
use app\components\ReferalManager;

class ClicksManager
{
    static public function save()
    {
      $click = new Click();
      $click->ip_address = $_SERVER['REMOTE_ADDR'];
      $click->user_id = Yii::$app->user->id;
      $click->partner_id = ReferalManager::getReferalID();
      $click->cookie_id = 0;
      $click->ref_link = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
      $click->created_at = time();
      $click->save();
    }
}

