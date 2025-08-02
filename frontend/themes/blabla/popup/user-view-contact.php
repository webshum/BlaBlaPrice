<?php

use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 */
?>
<div class="popup-container">
    <a class="button style-3 size-3 shadow close-popup-all" href="#">
        <span>
            <?= Html::img('/img/icon-1.png') ?>
        </span>
    </a>
    <div class="popup-paddings text-center">
        <div class="empty-space col-xs-b50"></div>
        <div class="h3"><b><?php echo Yii::t('app', 'Контакти'); ?></b></div>
        <div class="empty-space col-xs-b15"></div>
        <div class="simple-article large"><b><?php echo $user->address; ?></b></div>
        <div class="empty-space col-xs-b30"></div>
        <div class="simple-article"><?php echo Yii::t('app', 'Телефон'); ?></div>
        <div class="empty-space col-xs-b10"></div>
        <div class="simple-article extralarge grey"><b><?php echo $user->phone; ?></b></div>
        <div class="empty-space col-xs-b10"></div>
        <div class="simple-article"><?php echo Yii::t('app', 'Email'); ?></div>
        <div class="empty-space col-xs-b10"></div>
        <div class="simple-article extralarge grey"><b><?php echo $user->email; ?></b></div>
        <div class="empty-space col-xs-b50"></div>
    </div>
</div>