<?php

namespace app\modules\admin;

use Yii;

class Admin extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();
        $this->layout = 'main';
        Yii::$app->user->loginUrl = ['/admin/session'];
        // custom initialization code goes here
    }
}
