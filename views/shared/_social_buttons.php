<?php
use yii\helpers\Url;
?>

<div id="uLogin" data-ulogin="display=panel;fields=first_name,last_name;optional=photo;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;redirect_uri=<?= urlencode(Url::toRoute('/social/index', true)) ?>"></div>
<script src="//ulogin.ru/js/ulogin.js"></script>
