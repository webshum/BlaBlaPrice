<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

if (Yii::$app->user->isGuest) {
    $user = new \common\models\User();
} else {
    $user = Yii::$app->user->identity;
}
?>

<div class="popup-content" data-rel="email-address" id="email-address">
    <div class="popup-container">
        <a class="close-popup-all">
            <svg width="12" height="12"><use xlink:href="#close-layer"></use></svg>
        </a>

        <div class="popup-title"><?= Yii::t('app', 'Введіть e-mail') ?></div>

        <?php $form = ActiveForm::begin([
            'id' => 'change-email',
            'action' => '/cabinet/change-email'
        ]) ?>

        <p class="popup-text"><?= Yii::t('app', 'На Ваш e-mail буде надіслано код підтвердження') ?></p>

        <?= $form->field($user, 'email')->textInput([
            'class' => 'input',
            'value' => $user->getEmail(),
            'placeholder' => Yii::t('app', 'Ваш e-mail'),
            'required' => true,
        ]) ?>

        <button type="submit" class="popup-button w-100 blue">
            <span><?= Yii::t('app', 'Вперед'); ?></span>
        </button>

        <a class="popup-button w-100 mt15 close-popup-all">
            <svg width="19" height="12"><use xlink:href="#arr-back"></use></svg>
            <span><?=Yii::t('app', 'Назад')?></span>
        </a>

        <?php $form->end(); ?>
    </div>
</div>