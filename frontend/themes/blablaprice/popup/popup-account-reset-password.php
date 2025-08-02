<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="popup-content" data-rel="account-reset-password">
    <div class="popup-container">
        <a class="button style-10 size-3  close-popup-all"><span><i class="icon-cancel-2 blue-icon"></i></span></a>
        <div class="popup-paddings">
            <?= Html::beginForm(Url::toRoute('site/request-password-reset')); ?>
            <div class="empty-space col-xs-b35"></div>
            <div class="h4-b ">
                <b><?= Yii::t('app', 'Ми відправимо новий пароль на e-mail який ви вказали при реєстрації на BlaBlaPrice'); ?></b>
            </div>
            <div class="empty-space col-xs-b35"></div>
            <?= Html::input('text', 'email', null, [
                'class' => 'simple-input size-2',
                'placeholder' => Yii::t('app', 'Ваш email *')
            ]) ?>
            <div class="empty-space col-xs-b20"></div>
            <div class="button style-1 size-1 shadow block submit-form" href="#">
                <span>
                    <?= Yii::t('app', 'ВІДНОВИТИ ПАРОЛЬ'); ?>
                </span>
                <input type="submit"/>
            </div>
           <div class="empty-space col-xs-b55 col-sm-b55"></div> 
            <?= Html::endForm(); ?>
        </div>
		 
    </div>
	
</div>