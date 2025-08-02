<?php

use yii\helpers\Html;
use common\models\LoginForm;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use frontend\controllers\UserController;
use yii\web\Session;

$session = Yii::$app->session;

?>

<div class="popup-content" data-rel="account-login">
    <div class="popup-container">
        <a class="close-popup-all">
            <svg width="12" height="12"><use xlink:href="#close-layer"></use></svg>
        </a>

        <h6 class="popup-title"><?= Yii::t('app', 'Вхід у кабінет через'); ?></h6>

        <a href="/site/auth-google" class="popup-button w-100 red btn-social">
            <b><span>GOOGLE</span></b>
        </a>

        <div class="popup-paddings">
            <?php $loginForm = new LoginForm() ?>
                <?php $form = ActiveForm::begin([
                    'action' => Url::toRoute('site/login'),
                    'id' => 'login-form',
                ]) ?>

                <div class="popup-title"><?= Yii::t('app', 'або через твій e-mail'); ?></div>

                <?= $form->field($loginForm, 'email')->textInput([
                    'class' => 'input',
                    'placeholder' => Yii::t('app', 'Твій email'),
                    'required' => true
                ])->label(false) ?>

                <?= $form->field($loginForm, 'password')->passwordInput([
                    'class' => 'input',
                    'placeholder' => Yii::t('app', 'Пароль'),
                    'required' => true
                ])->label(false) ?>

                <a class="open-static-popup popup-text mt15" data-rel="account-reset-password">
                    <?= Yii::t('app', 'Нагадати твій пароль?'); ?>
                </a>

                <button type="submit" class="popup-button w-100 blue login-ajax">
                    <span><?= Yii::t('app', 'Вхід'); ?></span>
                </button>
            <?php ActiveForm::end(); ?>
        </div>

        <a class="popup-button w-100 mt15 open-static-popup register-btn-seller-ajax" data-rel="registration">
            <span><?= Yii::t('app', 'Реєстрація'); ?></span>
        </a>

        <!-- <div class="popup-paddings">
            <a class="popup-text mb0 open-static-popup register-btn-user-ajax" data-rel="registration-user">
                <b><span><?= Yii::t('app', 'Реєстрація покупця'); ?></span></b>
            </a>
        </div> -->
    </div>
</div>
