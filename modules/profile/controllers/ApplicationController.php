<?php

namespace app\modules\profile\controllers;

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
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {

        $user = $this->getUser();

        if($user && !$user->isConfirmed() &&
           $action->controller->className() != 'app\modules\profile\controllers\SettingsController')
        {
            $this->redirect(['/profile/settings']);
        }

        if(!$user)
        {
            $this->redirect(['/session', 'id' => 302]);
        }

        return parent::beforeAction($action);
    }

    public function getUser()
    {
        if(Yii::$app->user->isGuest)
        {
            return false;
        }

        return User::findIdentity(Yii::$app->user->id);
    }

    public function renderJson($response)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
    }
}
