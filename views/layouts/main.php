<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\RegistrationForm;
use app\models\LoginForm;

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
<body data-base-url="<?= Url::home()?>">

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '',
                'brandUrl' => Url::home(),
                'options' => [
                    'class' => 'navbar-inverse',
                ],
            ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    Yii::$app->user->isGuest ?
                        ['label' => 'Войти', 'url' => ['/session'], 'options' => ['class' => 'js-login-button', 'data-form' => 'sign-in']] :
                        ['label' => 'Выйти',
                            'url' => ['/session/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= $this->render('@app/views/shared/_flash') ?>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= date('Y') ?></p>
        </div>
    </footer>

    <?php
        $model_signup = new RegistrationForm();
        $model_signin = new LoginForm();
        echo $this->render('@app/views/shared/_auth_modal', ['model_signin' => $model_signin, 'model_signup' => $model_signup]);
    ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
