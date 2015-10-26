<?php
use yii\helpers\Url;
?>
<a data-message-id="<?=$model->id ?>" href="<?= Url::toRoute(['view', 'id' => $model->id]) ?>" class="row js-message-item message-item message-status-<?=$model->sender_status ?>">
  <div class="col-sm-4 col-xs-4 name">
    <?=$model->receiver_data()['name'] ?>
  </div>
  <div class="col-sm-6 col-xs-8">
    <div class="subject"><?=$model->subject ?></div>
    <div class="short hidden-xs"><?=$model->short_content() ?></div>
  </div>
  <div class="col-sm-2 col-xs-12 date"><span class="date"><?= $model->created_at_date() ?></span></div>
</a>

