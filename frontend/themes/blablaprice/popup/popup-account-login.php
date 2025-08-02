<?php

use yii\helpers\Html;
use common\models\LoginForm;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use frontend\controllers\UserController;
use yii\web\Session;

$session = Yii::$app->session;

?>

<!-- Begin of Account login popup  -->
<div class="popup-content" data-rel="account-login">
    <div class="popup-container">
        <a class="button style-10 size-3 close-popup-all"><span><i class="icon-cancel-2 blue-icon"></i></span></a>

        <div class="popup-paddings">
            <div class="empty-space col-xs-b20"></div>
            <div class="h4-b "><b><?= Yii::t('app', 'Вхід у кабінет через '); ?> </b></div>
            <div class="empty-space col-xs-b20"></div>
            <div class="row m5">
               

                <div class="col-sm-12">
                    <a href="/site/auth-google" class="button style-7 size-2 shadow block btn-social">
                        <span>Google+</span>
                    </a>
                </div>
            </div>
            <div class="empty-space col-xs-b20"></div>
        </div>
        <div class="popup-paddings">

            <?php $loginForm = new LoginForm() ?>
                <?php $form = ActiveForm::begin([
                    'action' => Url::toRoute('site/login'),
                    'id' => 'login-form',
                ]) ?>

                <div class="h4-b "><?= Yii::t('app', 'або через ваш e-mail '); ?></div>
                <div class="empty-space col-xs-b15"></div>

                <?= $form->field($loginForm, 'email')->textInput([
                    'class' => 'simple-input size-2',
                    'placeholder' => Yii::t('app', 'Ваш email'),
                    'required' => true
                ])->label(false) ?>

                <?= $form->field($loginForm, 'password')->passwordInput([
                    'class' => 'simple-input size-2',
                    'placeholder' => Yii::t('app', 'Пароль'),
                    'required' => true
                ])->label(false) ?>

                <div class="row">
                    <div class="col-xs-6">
                        <a class="cloud-edit open-static-popup" data-rel="account-reset-password">
                            <?= Yii::t('app', 'Нагадати ваш пароль ?'); ?>
                        </a>
                    </div>

                </div>
                <div class="empty-space col-xs-b15"></div>
                <div class="button style-33 size-1 shadow block login-ajax">
                    <span><?= Yii::t('app', 'ВХІД'); ?></span>
                    <input type="submit"/>
                </div>
            <?php ActiveForm::end(); ?>

            <div class="row">
                <div class="col-xs-12 text-right">
                    <a class="new-page-button-label open-static-popup register-btn-seller-ajax" data-rel="registration">
                        <?= Yii::t('app', 'Реєстрація'); ?>
                    </a>

                    <a class="new-page-button-label open-static-popup register-btn-user-ajax" data-rel="registration-user">
                        <?= Yii::t('app', 'Реєстрація покупця'); ?>
                    </a>
                </div>
            </div>
            <div class="empty-space col-xs-b10"></div>
        </div>
    </div>
</div>
<!-- End of Account login popup -->
