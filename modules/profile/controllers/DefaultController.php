<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\User;
use app\models\Message;
use app\modules\profile\controllers\ApplicationController;

class DefaultController extends ApplicationController
{
    public function actionIndex()
    {
        $user = $this->getUser();
        $stat = [];
        $stat['unread_messages'] = Message::find()
          ->where(['receiver_user_id' => $user->id, 'receiver_status' => 'new'])
          ->count();
        $stat['account_balance'] = $user->account_balance();
        return $this->render('index', ['stat' => $stat]);
    }

}
