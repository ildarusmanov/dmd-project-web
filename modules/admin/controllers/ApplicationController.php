<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\User;
use app\components\ClicksManager;

class ApplicationController extends \app\controllers\ApplicationController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function getUser()
    {
        if(Yii::$app->user->isGuest)
        {
            return false;
        }

        return User::findIdentity(Yii::$app->user->id);
    }
}
