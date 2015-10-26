<?php
namespace app\components\helpers;

use Yii;
use app\models\User;
use app\models\Partner;
use yii\helpers\ArrayHelper;

class GoodPartnersHelper {
  static public function partners_list()
  {
    $result = ['0' => Yii::t('app', 'Good All Partners')];

    foreach(Partner::find()->all() as $partner)
    {
      $result[$partner->id] = $partner->user->nameWithEmail;
    }

    return $result;
  }
}
