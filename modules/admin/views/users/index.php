<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
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
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
            'modelClass' => 'User',
        ]), ['create'], ['class' => 'btn btn-primary btn-sm pull-right']) ?>
    </div>
  </div>
</div>
<?= $this->render('_search', ['model' => $searchModel]) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'email:email',
        'phone',
        'name',
        [
            'attribute' => 'role',
            'value' => function($model){
                return $model->role();
            }
        ],
        'partner_id',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>

