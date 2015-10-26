<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\modules\profile\assets\AppAsset;
use yii\helpers\Url;
use app\models\Order;
use app\models\LoginForm;
use app\models\User;
use app\models\RegistrationForm;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body data-base-url="<?= Url::home()?>" class="dashboard-body">

<?php $this->beginBody() ?>

<div id="wrapper">
    <?= $this->render('@app/modules/profile/views/shared/_sidebar') ?>
    <!-- Page content -->
    <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
          <div class="row-unspaced">
            <div class="col-md-12">
              <div id="topbar">
                <div class="row">
                  <div class="col-md-9 col-sm-8 col-xs-12">
                    <?= Breadcrumbs::widget([
                      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                  </div>
                  <div class="col-md-3 col-sm-4 hidden-xs">
                    <div class="topbar-right">
                      <span>
                        <sup class="fa fa-circle" style="color: #5f5; font-size: 5px;"></sup>
                        <?= Yii::$app->user->identity->name ?>
                        (<?= Yii::$app->user->identity->email ?>)
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row-unspaced">
            <div class="col-md-12">
                <?= $this->render('@app/views/shared/_flash') ?>
                <?= $content ?>
                <!--<div style="height:2000px;width: 10px;"></div>-->
            </div>
          </div>
        </div>
    </div>
</div>


<?php
  if(Yii::$app->user->isGuest)
  {
    $model_signup = new RegistrationForm();
    $model_signin = new LoginForm();
    echo $this->render('@app/views/shared/_auth_modal_fixed', ['model_signin' => $model_signin, 'model_signup' => $model_signup]);
  }
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
