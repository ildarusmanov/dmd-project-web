<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-header">
  <div class="row">
    <div class="info col-md-8">
      <a href="<?= Yii::$app->user->identity->avatar() ?>" target="_blank" class="thumbnail with-image pull-left">
        <img src="<?= Yii::$app->user->identity->avatar() ?>"></a>
      </a>
      <div class="pull-left">
        <h1><?= Yii::$app->user->identity->name ?></h1>
        <h4>Добро пожаловать в Ваш личный кабинет!</h4>
      </div>
    </div>


    <div class="controls col-md-4">
      <a href="<?= Url::toRoute('/profile/settings') ?>" class="btn btn-primary">
        <i class="fa fa-cog"></i>
        <?= Yii::t('app', 'Profile Settings') ?>
      </a>
    </div>
  </div>
</div>

<div class="default-index">
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-default panel-back">
        <div class="panel-header">
          Личный счет
        </div>
        <div class="panel-body">
          <div class="icon-box ">
            <i class="fa fa-money"></i>
          </div>
          <div class="text-box">
            <p class="main-text"><?= $stat['account_balance'] ?> RUR</p>
            <p class="text-link"><a href="<?= Url::toRoute(['/profile/bills/create']) ?>" class="btn btn-primary">Пополнить счет</a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-default panel-back">
        <div class="panel-header">
          Сообщения
        </div>
        <div class="panel-body">
          <div class="icon-box">
            <i class="fa fa-envelope-o"></i>
          </div>
          <div class="text-box">
            <p class="main-text">
              <? if($stat['unread_messages'] == 0): ?>
               Нет новых
              <? elseif($stat['unread_messages'] % 10 == 1): ?>
                <?= $stat['unread_messages'] ?> новое
              <? else: ?>
                <?= $stat['unread_messages'] ?> новых
              <? endif ?>
            </p>
            <p class="text-link"><a href="<?= Url::toRoute(['/profile/messages']) ?>" class="btn btn-primary">Просмотреть</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


