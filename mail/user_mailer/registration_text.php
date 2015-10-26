<?php
use yii\helpers\Url;
$link = Url::toRoute(['/confirmation/index', 'token' => $user->confirmation_token], true);
$login_link = Url::toRoute(['/session'], true);
?>
Благодарим Вас за регистрацию

Данные для доступа к Вашему аккаунту

<?= $login_link ?>
e-mail: <?= $user->email ?>
пароль: <?= $password ?>


Для продолжения работы подтвердите свой электронный почтовый адрес перейдя по ссылке ниже:
<?= $link ?>
