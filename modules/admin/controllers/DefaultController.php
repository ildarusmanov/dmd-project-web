<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Message;

class DefaultController extends ApplicationController
{
    public function actionIndex()
    {
        $stat = [
            'users_count' => User::find()->count(),
            'messages_count' => Message::find()->where(['receiver_user_id' => 0])->count(),
        ];

        return $this->render('index', ['stat' => $stat]);
    }
}
