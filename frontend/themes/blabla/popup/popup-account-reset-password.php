<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="popup-content" data-rel="account-reset-password">
    <div class="popup-container">
        <a class="close-popup-all">
            <svg width="12" height="12"><use xlink:href="#close-layer"></use></svg>
        </a>

        <div class="popup-title mb30"><?= Yii::t('app', 'Ми відправимо новий пароль на e-mail який ви вказали при реєстрації на BlaBlaPrice'); ?></div>

        <div class="mt30">
            <?= Html::beginForm(Url::toRoute('site/request-password-reset')); ?>

            <?= Html::input('text', 'email', null, [
                'class' => 'input',
                'placeholder' => Yii::t('app', 'Ваш email *')
            ]) ?>

            <button type="submit" class="popup-button blue w-100 mt30">
                <span><?= Yii::t('app', 'Відновити пароль'); ?></span>
            </button>

            <a class="popup-button w-100 open-static-popup mt15" data-rel="account-login">
                <svg width="19" height="12"><use xlink:href="#arr-back"></use></svg>
                <span><?=Yii::t('app', 'Назад')?></span>
            </a>
            <?= Html::endForm(); ?>
        </div>
    </div>
</div>