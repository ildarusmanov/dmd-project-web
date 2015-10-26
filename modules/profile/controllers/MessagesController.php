<?php

namespace app\modules\profile\controllers;

use Yii;
use app\models\User;
use app\models\Message;
use yii\data\ActiveDataProvider;
use app\models\search\Message as MessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\message\MessagesManager;

use app\modules\profile\controllers\ApplicationController;

class MessagesController extends ApplicationController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['post'],
            ],
        ];

        return $behaviors;
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->actionInbox();
    }

    public function actionInbox()
    {
        $user_id = Yii::$app->user->id;
        $query = Message::find()->where(['receiver_user_id' => $user_id, 'receiver_status' => ['new', 'read']]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ],
        ]);

        return $this->render('inbox', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOutbox()
    {
        $user_id = Yii::$app->user->id;
        $query = Message::find()->where(['sender_user_id' => $user_id, 'sender_status' => ['new', 'read']]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ],
        ]);

        return $this->render('outbox', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Message model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model = MessagesManager::read($model);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = $this->getUser();
        $request = Yii::$app->request;

        $model = new Message();

        if (Yii::$app->request->isPost)
        {
            $model = MessagesManager::create($request->post(), $user->id);
        }

        if (!$model->isNewRecord)
        {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'receivers' => \app\components\helpers\MessagesHelper::receivers_list($user->id),
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model = MessagesManager::delete($model);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
