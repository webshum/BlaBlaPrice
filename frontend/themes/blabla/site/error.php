<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <?= Yii::t('app', 'Підчас опрацювання Вашого запиту веб-сервером виникла помилка'); ?>
    </p>
    <p>
        <?= Yii::t('app', 'Будь ласка, зв`яжіться з нами, якщо ви вважаєте, що це помилка сервера. Дякуємо.'); ?>
    </p>

</div>
