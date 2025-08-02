<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Ціни - Blablaprice');
?>

<div class="center">
    <div class="request-head">
        <?= $this->render('@appTheme/layouts/header'); ?>
    </div>
   

    <div class="request-body request-main page-contact">
        <h2>
            <?= Yii::t('app', 'Пакети балів для обміну контактами'); ?>
        </h2>

        <h3><?= Yii::t('app', 'Що таке бал?'); ?></h3>
        <ul>
            <li><?= Yii::t('app', 'Кожен <strong>бал</strong> = одне з’єднання контактів між покупцем і продавцем.'); ?></li>
            <li><?= Yii::t('app', 'Якщо покупець приймає пропозицію продавця — знімається <strong>1 бал</strong>.'); ?></li>
            <li><?= Yii::t('app', 'Бали не мають терміну дії та можуть накопичуватися.'); ?></li>
           
        </ul>

        <?= $this->render('@appTheme/components/pricing.php'); ?>

        <ol>
            <li><?= Yii::t('app', 'Оберіть пакет балів.'); ?></li>
            <li><?= Yii::t('app', 'Сплатіть через безпечну систему оплати.'); ?></li>
            <li><?= Yii::t('app', 'Отримайте бали на свій акаунт.'); ?></li>
        </ol>

        <h3><?= Yii::t('app', 'Залишилися питання?'); ?></h3>
        <p><?= Yii::t('app', 'Зверніться до служби підтримки:'); ?> <a href="mailto:support@blablaprice.com">support@blablaprice.com</a></p>
    </div>
</div>

<div class="popup-wrapper">
    <div class="close-layer"></div>
    <?= $this->render('@appTheme/popup/popup-account-login') ?>
    <?= $this->render('@appTheme/popup/popup-account-registration') ?>
    <?= $this->render('@appTheme/popup/popup-account-reset-password') ?>
    <?= $this->render('@appTheme/popup/language'); ?>
</div>