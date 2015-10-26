<?php
use yii\helpers\Url;
?>

<div class="backdrop">
  <div class="modal modal-fixed" id="login_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"></div>
        <div class="modal-body">
          <div class="js-sign-up">
            <div class="row">
              <div class="col-md-12">
                <h3>Регистрация</h3>
                <?= $this->render('@app/views/shared/_sign_up_form', ['model' => $model_signup]) ?>
              </div>
            </div>
          </div>

          <div class="js-sign-in">
            <div class="row">
              <div class="col-md-12">
                <h3>Войти</h3>
                <?= $this->render('@app/views/shared/_sign_in_form', ['model' => $model_signin]) ?>
              </div>
            </div>
          </div>
          <h4 class="text-center or">&mdash; ИЛИ &mdash;</h4>
          <p class="text-center">Войти через одну из социальных сетей</p>
          <?= $this->render('@app/views/shared/_social_buttons') ?>
        </div>

        <div class="modal-footer"></div>
      </div>
    </div>
  </div>
</div>
