<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Message */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Messages Inbox');
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-header" class="with-tabs">
  <div class="row">
    <div class="info col-md-8">
      <a href="<?= Url::toRoute(['index']) ?>" class="thumbnail pull-left">
        <i class="fa fa-envelope"></i>
      </a>
      <div class="pull-left">
        <h1><?= $this->title ?></h1>
        <h4>Ваши личные сообщения</h4>
      </div>
    </div>


    <div class="controls col-md-4">
      <a href="<?= Url::toRoute(['create']) ?>" class="btn btn-primary">
        <i class="fa fa-plus"></i>
        <?= Yii::t('app', 'Write New Message') ?>
      </a>
    </div>
  </div>

  <div class="tabs row">
    <div class="col-md-12">
      <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#"><?= Yii::t('app', 'Messages Inbox') ?></a></li>
        <li role="presentation"><a href="<?= Url::toRoute(['outbox']) ?>"><?= Yii::t('app', 'Messages Outbox') ?></a></li>
      </ul>
    </div>
  </div>
</div>

<div class="message-index">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_message_inbox',
      ]);
    ?>
</div>
