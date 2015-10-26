<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegistrationForm;
use app\components\ReferalManager;

class RegistrationController extends ApplicationController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['registration'],
                'rules' => [
                    [
                        'actions' => ['registration'],
                        'allow' => true,
                        'roles' => ['?'],
                    ]
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'narrow';
        $model = new RegistrationForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {

                Yii::$app->session->setFlash('success', Yii::t('app', 'Registration email was sent'));

                ReferalManager::assign_referal($user);

                if (Yii::$app->user->login($user)) {
                    return $this->goDashboard();
                }else{
                    return $this->goHome();
                }
            }
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    private function goDashboard()
    {
        return $this->redirect(['/profile']);
    }
}
