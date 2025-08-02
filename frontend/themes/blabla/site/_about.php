<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Про нас');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t('app', 'Контент сторінки про нас'); ?></p>

    <code><?= __FILE__ ?></code>
</div>
