<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Message */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-header">
  <div class="row">
    <div class="info col-md-8">
      <a href="#" class="thumbnail pull-left">
        <i class="fa fa-inbox"></i>
      </a>
      <div class="pull-left">
        <h1><?= $this->title ?></h1>
        <h4>Просмотр личного сообщения</h4>
      </div>
    </div>

    <div class="controls col-md-4">
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
  </div>
</div>

<div class="row">
    <div class="message-view col-md-12">

        <div class="panel panel-default">
          <div class="panel-body">

            <div class="row">
                <div class="col-md-12">
                    <label><?= Yii::t('app', 'Message CreatedAt') ?>:</label>
                    <?= $model->created_at_date() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label><?= Yii::t('app', 'Message Sender') ?>:</label>
                    <?= $model->sender_data()['name'] ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label><?= Yii::t('app', 'Message Receiver') ?>:</label>
                    <?= $model->receiver_data()['name'] ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label><?= Yii::t('app', 'Message Subject') ?>:</label>
                    <?= $model->subject ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p><?= $model->content ?></p>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
