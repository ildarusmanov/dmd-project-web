<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Admin dashboard');
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-header">
  <div class="row">
    <div class="info col-md-8">
      <a href="<?= Url::toRoute(['index']) ?>" class="thumbnail pull-left">
        <i class="fa fa-dashboard"></i>
      </a>
      <div class="pull-left">
        <h1><?= $this->title ?></h1>
        <h4>Панель управления</h4>
      </div>
    </div>
  </div>
</div>


<div class="row">

    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-back">
        <div class="panel-header">
          Сообщения
        </div>
        <div class="panel-body">
          <div class="icon-box ">
            <i class="fa fa-envelope-o"></i>
          </div>
          <div class="text-box">
            <p class="main-text"><?= $stat['messages_count'] ?></p>
            <p class="text-link"><a href="<?= Url::toRoute(['/admin/messages']) ?>" class="btn btn-primary">Просмотреть</a></p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-back">
        <div class="panel-header">
          Пользователи
        </div>
        <div class="panel-body">
          <div class="icon-box">
            <i class="fa fa-users"></i>
          </div>
          <div class="text-box">
            <p class="main-text"><?= $stat['users_count'] ?></p>
            <p class="text-link"><a href="<?= Url::toRoute(['/admin/users']) ?>" class="btn btn-primary">Просмотреть</a></p>
          </div>
        </div>
      </div>
    </div>
<!--
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-back noti-box">
        <span class="icon-box bg-color-blue set-icon">
            <i class="fa fa-bell-o"></i>
        </span>
        <div class="text-box">
            <p class="main-text">240</p>
            <p class="text-muted">Сообщений</p>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-back noti-box">
        <span class="icon-box bg-color-brown set-icon">
            <i class="fa fa-rocket"></i>
        </span>
        <div class="text-box">
            <p class="main-text">3</p>
            <p class="text-muted">Заказов</p>
        </div>
      </div>
    </div>-->

</div>
