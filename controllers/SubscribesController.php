<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Subscribe;
use app\models\User;
use app\models\Partner;
use app\components\ReferalManager;

class SubscribesController extends ApplicationController
{
    public function actionIndex($email_list_id = 0)
    {
      $model = new Subscribe();
      $model->email_list_id = $email_list_id;
      $model->partner_id = 0;
      $model->user_id = 0;
      $model->cookie_id = 0;

      $post_request = Yii::$app->request->isPost;

      if($post_request)
      {
        $success = ($model->load(Yii::$app->request->post()) && $model->save());
      }

      return $this->render('index', [
        'model' => $model.
        'post_request' => $post_request,
        'success' => $success
      ]);
    }
}
