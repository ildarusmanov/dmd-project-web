<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-header">
  <div class="row">
    <div class="info col-md-8">
      <a href="<?= Url::toRoute(['index']) ?>" class="thumbnail pull-left">
        <i class="fa fa-users"></i>
      </a>
      <div class="pull-left">
        <h1><?= $this->title ?></h1>
        <h4>Управление пользователями системы</h4>
      </div>
    </div>

    <div class="controls col-md-4">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-default btn-sm',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
  </div>
</div>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        [
            'attribute' => 'role',
            'value' => $model->role()
        ],
        [
            'attribute' => 'avatar',
            'value' => $model->getImageFileUrl("avatar"),
            'format' => ['image',['width'=>'100','height'=>'100']],
        ],
        'partner_id',
        'name',
        'email:email',
        'phone',
        [
            'attribute' => 'gender',
            'value' => $model->gender()
        ],
        'birthdate',
        'auth_key',
        'network_id',
        'network_identity',
        'network_profile',

        [
            'attribute' => 'created_at',
            'value' => $model->created_at_date()
        ],
        'friends_count',
        'clicks_count',
    ],
]) ?>

