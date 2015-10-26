<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Statistic;
use app\models\User;
use app\models\Partner;
use app\components\ReferalManager;

class StatisticsController extends Controller
{
    public $referal = null;


    public function beforeAction($action)
    {
        ReferalManager::load_referal();
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $success = false;

        if(Yii::$app->request->isPost)
        {
            $model = new Statistic();
            $model->partner_id = 0;
            $model->user_id = 0;
            $model->cookie_id = 0;
            $model->created_at = time();
            $model->ip_address = $_SERVER['REMOTE_ADDRESS'];
            $success = ($model->load(Yii::$app->request->post()) && $model->save());
        }

        return $this->renderJson(['status' => $success]);
    }

    public function renderJson($response)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
    }
}
