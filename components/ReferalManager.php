<?php
namespace app\components;

use Yii;
use app\models\Partner;

class ReferalManager
{
    static public function load_referal()
    {
      $referal_id = null;
      $user = null;

      $referal_id = isset($_COOKIE['referal_id']) ? intval($_COOKIE['referal_id']) : null;
      $referal_id = ($referal_id == null && isset($_REQUEST['referal_id']) && is_numeric($_REQUEST['referal_id'])) ? intval($_REQUEST['referal_id']) : null;

      if($referal_id == null || $referal_id <= 0) return null;

      $referal = Partner::findOne($referal_id);

      return $referal;
    }

    static public function assign_referal($user)
    {
      $referal = self::load_referal();
      if($referal == null) return false;
      $user->partner_id = $referal->id;
      $user->save();
    }

    static public function getReferalId()
    {
      $referal = self::load_referal();
      if($referal == null)
      {
        return 0;
      }
    }
}

