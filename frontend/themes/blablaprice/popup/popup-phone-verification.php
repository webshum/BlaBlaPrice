<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\models\SignupForm;

// Set current user phone :
if (Yii::$app->user->isGuest) {
    $user = new \common\models\User();
} else {
    $user = Yii::$app->user->identity;
}

?>

<!-- REGISTRATION NUMBER PHONE -->
<div class="popup-content activation-phone" data-rel="registration-user-phone">
    <div class="popup-container">
        <div class="popup-paddings">
            <div class="empty-space col-xs-b35"></div>
            <div class="h3 text-center"><b><?= Yii::t('app', 'Введіть номер телефона'); ?></b></div>
            <div class="empty-space col-xs-b50"></div>
        </div>

        <div class="popup-paddings">
            <div class="empty-space col-xs-b30"></div>

            <?php 
                $signupForm = new SignupForm(); 
                $form = ActiveForm::begin(['id' => 'registration-phone-form']);
            ?>

            <p class="big-text"><?= Yii::t('app', 'На Ваш номер буде відправлено код підтвердження'); ?></p>

            <div class="tabs-block">
                <?= $form->field($signupForm, 'phone')->textInput([
                    'class' => 'simple-input size-2',
                    'placeholder' => Yii::t('app', '+38 (099) 999-99-99'),
                    'label' => Yii::t('app', 'Телефон *'),
                    'oninput' => "setCustomValidity('')",
                    'oninvalid' => "this.setCustomValidity('" . Yii::t('app', 'Будь ласка, заповніть') . "')",
                    'required' => true
                ])->label(false) ?>
            </div>

            <div class="empty-space col-xs-b5"></div>

            <div class="clearfix btn-group-popup">
                <button type="submit" class="new-page-button-label pull-right open-static-popup" data-rel="registration-user-active-phone">
                    <span><?= Yii::t('app', 'ВПЕРЕД'); ?></span>
                </button>

                <a class="new-page-button-label btn-back close-popup-all">
                    <span><?=Yii::t('app', 'НАЗАД')?></span>
                </a>
            </div>

            <div class="empty-space col-xs-b20"></div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- // REGISTRATION NUMBER PHONE -->

<!-- REGISTRATION ACTIVE PHONE -->
<div class="popup-content" data-rel="registration-user-active-phone" data-email="<?= $user->getEmail(); ?>">
    <div class="popup-container">
        отримайте

        <div class="popup-paddings">
            <div class="empty-space col-xs-b35"></div>
            <div class="h3 text-center"><b><?= Yii::t('app', 'Код підтвердження'); ?></b></div>
            <div class="empty-space col-xs-b50"></div>
        </div>

        <div class="popup-paddings">
            <div class="empty-space col-xs-b30"></div>

            <?php 
                $signupForm = new SignupForm(); 
                $form = ActiveForm::begin(['id' => 'registration-active-form']);
            ?>

            <p class="big-text"><?= Yii::t('app', 'На номер <span class="phone-active"></span> відправлено СМС з кодом підтвердження телефона'); ?></p>

            <div class="tabs-block">
                <?= $form->field($signupForm, 'code')->textInput([
                    'class' => 'simple-input size-2',
                    'placeholder' => Yii::t('app', 'Код підтвердження СМС'),
                    'oninput' => "setCustomValidity('')",
                    'oninvalid' => "this.setCustomValidity('" . Yii::t('app', 'Будь ласка, заповніть') . "')",
                    'required' => true
                ])->label(false) ?>
            </div>

            <div class="empty-space col-xs-b5"></div>

            <div class="clearfix btn-group-popup">
                <button type="submit" class="button shadow style-3 size-2 pull-right">
                    <span><?= Yii::t('app', 'ВПЕРЕД'); ?></span>
                </button>

                <a class="button style-4 size-2 btn-back shadow pull-right open-static-popup" data-rel="registration-user-phone">
                    <span><?=Yii::t('app', 'НАЗАД')?></span>
                </a>
            </div>

            <div class="empty-space col-xs-b20"></div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- // REGISTRATION ACTIVE PHONE -->

<!-- ERROR PHONE CODE -->
<div class="popup-content <?php echo ($user->phone_approved  == '0000-00-00 00:00:00' && $user->role == 1) ? 'not-close' : ''; ?> popup-content-error-active-phone" data-rel="registration-user-error-active-phone">
    <div class="popup-container">
        <a class="button style-3 size-3 shadow pull-right close-popup-all" href="#">
            <span>
                <?= Html::img('/img/icon-1.png') ?>
            </span>
        </a>

        <div class="popup-paddings">
            <div class="empty-space col-xs-b35"></div>
            <div class="h3 text-center"><b><?= Yii::t('app', 'Помилка реєстрації'); ?></b></div>
            <div class="empty-space col-xs-b50"></div>
        </div>

        <div class="popup-paddings grey">

            <div class="empty-space col-xs-b30"></div>

            <div class="alert text-center alert-danger"><p><?= Yii::t('app', 'Не вірний код'); ?></p></div>

            <div class="empty-space col-xs-b30"></div>

            <div class="clearfix btn-group-popup">
            <div class="empty-space col-xs-b20"></div>
                <a class="button style-4 size-2 btn-back shadow pull-right open-static-popup" data-rel="registration-user-active-phone">
                    <span><?= Yii::t('app', 'НАЗАД');?></span>
                </a>
            </div>

            <div class="empty-space col-xs-b20"></div>

        </div>
    </div>
</div>
<!-- // ERROR PHONE CODE -->

<!-- ERROR PHONE -->
<div class="popup-content" data-rel="registration-user-error-phone">
    <div class="popup-container">

        <?php if (!($user->phone_approved  == '0000-00-00 00:00:00') && !($user->role == 1)) : ?>
            <a class="button style-3 size-3 shadow pull-right close-popup-all" href="#">
                <span>
                    <?= Html::img('/img/icon-1.png') ?>
                </span>
            </a>
        <?php endif; ?>

        <div class="popup-paddings">
            <div class="empty-space col-xs-b35"></div>
            <div class="h3 text-center"><b><?= Yii::t('app', 'Помилка реєстрації'); ?></b></div>
            <div class="empty-space col-xs-b50"></div>
        </div>

        <div class="popup-paddings ">

            <div class="empty-space col-xs-b30"></div>

            <div class="alert text-center alert-danger"><p><?= Yii::t('app', 'Не вдалося відправити СМС, спробуйте ще раз'); ?></p></div>

            <div class="empty-space col-xs-b5"></div>

            <div class="clearfix btn-group-popup">
                <a class="button style-4 size-2 btn-back shadow open-static-popup pull-right" data-rel="registration-user-phone">
                    <span><?= Yii::t('app', 'НАЗАД');?></span>
                </a>
            </div>

            <div class="empty-space col-xs-b20"></div>

        </div>
    </div>
</div>
<!-- // ERROR PHONE -->

<!-- ERROR PHONE CODE -->
<div class="popup-content" data-rel="registration-user-error-active-phone">
    <div class="popup-container">
        <div class="popup-paddings">
            <div class="empty-space col-xs-b35"></div>
            <div class="h3 text-center"><b><?= Yii::t('app', 'Помилка реєстрації'); ?></b></div>
            <div class="empty-space col-xs-b50"></div>
        </div>

        <div class="popup-paddings ">

            <div class="empty-space col-xs-b30"></div>

            <div class="alert text-center alert-danger"><p><?= Yii::t('app', 'Не вірний код'); ?></p></div>

            <div class="empty-space col-xs-b30"></div>

            <div class="clearfix btn-group-popup">
            <div class="empty-space col-xs-b20"></div>
                <a class="button style-4 size-2 btn-back shadow pull-right open-static-popup" data-rel="registration-user-active-phone">
                    <span><?= Yii::t('app', 'НАЗАД');?></span>
                </a>
            </div>

            <div class="empty-space col-xs-b20"></div>

        </div>
    </div>
</div>
<!-- // ERROR PHONE CODE -->
