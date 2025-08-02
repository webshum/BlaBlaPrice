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
        <?php $form = ActiveForm::begin([
            'id' => 'change-email',
            'action' => '/cabinet/change-email'
        ]) ?>
      <a class="button style-10 size-3  close-popup-all"><span><i class="icon-cancel-2 blue-icon"></i></span></a>
        <div class="popup-paddings">
            <div class="empty-space col-xs-b35"></div>
            <div class="h3 ">
                <b><?= Yii::t('app', 'Введіть e-mail') ?></b>
            </div>

        </div>
        <div class="popup-paddings ">
           
            <div class="h5">
                <?= Yii::t('app', 'На Ваш e-mail буде надіслано код підтвердження') ?>
                <div id="email-address-information"></div>
            </div>
            <div class="empty-space col-xs-b20"></div>
            <div class="simple-article">
                <label for="new-phone-number">
                    <?= Yii::t('app', 'E-mail *') ?>
                </label>
            </div>
            <?= $form->field($user, 'email')->textInput([
                'class' => 'simple-input size-2',
                'id' => 'new-email-address',
                'value' => $user->getEmail(),
                'placeholder' => Yii::t('app', 'Ваш e-mail')
            ]) ?>
            <div class="empty-space col-xs-b20"></div>
            <div class="button style-1 size-1 shadow block">
                <span><?= Yii::t('app', 'Надіслати') ?></span>
                <input type="submit" onclick=""/>
            </div>
            <div class="empty-space col-xs-b50"></div>
        </div>

        <?php $form->end(); ?>
    </div>
</div>

<script type="text/javascript">
    $('#change-email').on('beforeSubmit', function () {
        $.ajax({
            url: '/cabinet/change-email',
            type: 'post',
            data: $(this).closest('form').serialize(),
            dataType: 'json'
        }).done(function (data) {
            if (data.result == true && data.emailSent == true) {
                $('#email-address').removeClass('active').hide();
                location.reload();
            } else if (data.result == false && data.message) {
                $('#email-address-information').html('<strong>' + data.message + '</strong>');
                $.each(data.errors, function () {
                    $.each(this, function (key, value) {
                        $('#email-address-information').append('<br><strong>' + value + '</strong>');
                    });
                });
            }
        });
        return false;
    });
</script>