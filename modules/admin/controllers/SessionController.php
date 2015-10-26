<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\modules\admin\models\LoginForm;


class SessionController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'narrow';
        $user = $this->getUser();
        if ($user && $user->isAdmin()) {
            return $this->goDashboard();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goLoginPage();
    }


    private function goDashboard()
    {
        return $this->redirect(['/admin']);
    }

    private function goLoginPage()
    {
        return $this->redirect(['/admin/session']);
    }

    private function getUser()
    {
        if(Yii::$app->user->isGuest)
        {
            return false;
        }

        return User::findIdentity(Yii::$app->user->id);
    }
}
