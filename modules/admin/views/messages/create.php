<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Message */

$this->title = Yii::t('app', 'Write New Message');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-header">
  <div class="row">
    <div class="info col-md-8">
      <a href="<?= Url::toRoute('/admin/messages/create') ?>" class="thumbnail pull-left">
        <i class="fa fa-paper-plane"></i>
      </a>
      <div class="pull-left">
        <h1><?= $this->title ?></h1>
        <h4>Создание нового сообщения</h4>
      </div>
    </div>
  </div>
</div>

<div class="message-create">

    <?= $this->render('_form', [
        'model' => $model,
        'receivers' => $receivers
    ]) ?>

</div>
