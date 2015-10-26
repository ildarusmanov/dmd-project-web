<?php

namespace app\modules\profile;

class Profile extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\profile\controllers';

    public function init()
    {
        parent::init();
        $this->layout = 'main';
        // custom initialization code goes here
    }
}
