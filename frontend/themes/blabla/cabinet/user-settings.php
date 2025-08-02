<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;

use frontend\models\SignupForm;


/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 * @var integer $count_order
 */

// generate regions
$regionList = [];
$regionList[0] = Yii::t('app', '--- Не вказано ---');
$regionList = array_merge($regionList, Yii::$app->params['region']);
?>

<div class="center page-settings">
    <div class="request request-main">
        <div class="request-head">
            <?= $this->render('@appTheme/layouts/header'); ?>
        </div>
    </div>
    
    <h2 class="heading">
        <?= Yii::t('app', 'Особисті дані'); ?>
    </h2>

    <div class="blabla-comment dark">
        <div class="text">
            <?= Yii::t('app','Для доступу до всіх функцій сервісу необхідно заповнити профіль користувача та підтвердити контактну інформацію'); ?>
        </div>
    </div>

    <ul class="accordeon accordeon-settings mt40">
	
	
		  <li class="item-accordeon active">
            <div class="btn-accordeon">
                <span><?= Yii::t('app', 'Контактна інформація'); ?></span>
                <svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
            </div>

            <div class="content-accordeon">
                <div class="inner-accordeon">
                    <div class="input-group">
                        <div class="field">
                            <?php $form = ActiveForm::begin([
                                'action' => Url::toRoute('cabinet/settings-update-phone'),
                                'id' => 'settings-update'
                            ]) ?>

                                <?php
                                    $TextInButton = $user->getPhone();
                                    if ($user->getPhoneApproved() == '0000-00-00 00:00:00') {
                                        $tooltip = Yii::t('app', ' Телефон не підтведжений, Ви не зможете надсилати пропозиції');
                                        $confirmation = Yii::t('app', 'Не підтверджено');
                                        $TextInButton = Yii::t('app', 'Додайте ваш номер');
                                        $style = 'text-danger';
                                    } elseif ($user->getPhoneApproved() != '0000-00-00 00:00:00') {
                                        $style = 'text-success';
                                        $confirmation = Yii::t('app', 'Підтверджено');
                                        $tooltip = Yii::t('app', ' Все гаразд. Ви підтвердили свій телефон, і можете надсилати пропозиції');
                                    }
                                ?>

                                <p class="text-small"><?= $tooltip ?></p>

                                <div class="input-label">
                                    <?= Yii::t('app', 'Номер телефону') ?>
                                    <svg width="11" height="11"><use xlink:href="#mark"></use></svg>
                                    <span class="up-label <?= $style ?>"><?= $confirmation ?></span>
                                </div>

                                <a href="#" class="input white open-static-popup js-add-cookie-phone" data-rel="registration-user-phone">
                                    <span><?= $TextInButton ?></span>
                                </a>
                            <?php ActiveForm::end() ?>
                        </div>

                        <div class="field">
                            <?php $form = ActiveForm::begin([
                                'action' => Url::toRoute('cabinet/settings-update-email'),
                                'id' => 'settings-update'
                            ]) ?>
                                <?php
                                    if ( $user->getEmailApproved() == '0000-00-00 00:00:00' ) {
                                        $confirmation = Yii::t('app', 'Не підтверджено');
                                        $tooltip = Yii::t('app', ' На ваш e-mail надісланий лист з посиланням для підтведження реєстрації. У разі відсутності листа - перевірте папку "Спам".');
                                        $style = 'text-danger';
                                    } elseif ($user->getEmailApproved() != '0000-00-00 00:00:00') {
                                        $confirmation = Yii::t('app', 'Підтверджено');
                                        $tooltip = Yii::t('app', ' Все гаразд , ви підтвердили свій e-mail');
                                        $style = 'text-success';
                                    }
                                ?>

                                <p class="text-small"><?= $tooltip ?></p>

                                <div class="input-label">
                                    <?= Yii::t('app', 'Email') ?>
                                    <svg width="11" height="11"><use xlink:href="#mark"></use></svg>
                                    <span class="up-label"><?= $confirmation ?></span>
                                </div>

                                <a href="#" class="input white open-static-popup" data-rel="email-address">
                                    <span><?= $user->getEmail() ?></span>
                                </a>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </li>
	
        <li class="item-accordeon ">
            <div class="btn-accordeon">
                <span><?= Yii::t('app', 'Особисті дані') ?></span>
                <svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
            </div>

            <div class="content-accordeon">
                <div class="inner-accordeon">
                    <?php $form = ActiveForm::begin([
                        'action' => Url::toRoute('cabinet/settings-update'),
                        'id' => 'settings-update'
                    ]) ?>

                        <div class="input-group">
                            <div class="field">
                                <div class="input-label">
                                    <?= Yii::t('app', 'Ваше ім’я'); ?>
                                </div>

                                <?= $form->field($user, 'username')->textInput([
                                    'id' => 'user-name',
                                    'class' => 'input white',
                                    'placeholder' => Yii::t('app', 'Ваше ім’я')
                                ])->label(false) ?>
                            </div>

                            <div class="field">
                                <div class="input-label">
                                    <?= Yii::t('app', 'Ваш регіон'); ?>
                                </div>

                                <?= $form->field($user, 'region_id')->dropDownList($regionList, [
                                    'class' => 'input white',
                                    'id' => 'user-region-id'
                                ])->label(false) ?>
                            </div>

                            <div class="field">
                                <button type="submit" class="popup-button blue">
                                    <span><?= Yii::t('app', 'Зберегти') ?></span>
                                </button>
                            </div>
                        </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </li>

      

        <li class="item-accordeon">
            <div class="btn-accordeon">
                <span><?= Yii::t('app', 'Зміна паролю') ?></span>
                <svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
            </div>
    
            <div class="content-accordeon">
                <div class="inner-accordeon">
                    <p class="text-small"><?= Yii::t('app', 'Зміна паролю для входу в особистий кабінет'); ?></p>

                    <?= Html::beginForm(['cabinet/change-password']); ?>
                        <div class="input-group">
                            <div class="field">
                                <div class="input-label">
                                    <?= Yii::t('app', 'Ваш пароль') ?>
                                </div>

                                <?= Html::input('password', 'old-password', null, [
                                    'class' => 'input white',
                                    'id' => 'old-password',
                                    'placeholder' => Yii::t('app', 'Введіть пароль')
                                ]) ?>
                            </div>

                            <div class="field">
                                <div class="input-label">
                                    <?= Yii::t('app', 'Новий пароль') ?>
                                </div>

                                <?= Html::input('password', 'new-password', null, [
                                    'minlength' => '6',
                                    'class' => 'input white',
                                    'id' => 'new-password',
                                    'placeholder' => Yii::t('app', 'Новий пароль')
                                ]) ?>
                            </div>

                            <div class="field">
                                <div class="input-label">
                                    <?= Yii::t('app', 'Повторіть новий пароль') ?>
                                </div>

                                <?= Html::input('password', 'confirm-password', null, [
                                    'class' => 'input white',
                                    'id' => 'confirm-password',
                                    'placeholder' => Yii::t('app', 'Повторіть новий пароль')
                                ]) ?>
                            </div>
                        </div>

                        <div class="text-right mt30">
                            <button type="submit" class="popup-button blue px90">
                                <span><?= Yii::t('app', 'Зберегти'); ?></span>
                            </button>
                        </div>
                    <?php echo Html::endForm(); ?>
                </div>
            </div>
        </li>
    </ul>
</div>

<div class="popup-wrapper">
    <div class="close-layer"></div>
    <?= $this->render('@appTheme/popup/popup-email-verification') ?>
    <?= $this->render('@appTheme/popup/popup-phone-verification') ?>
    <?= $this->render('@appTheme/popup/language'); ?>
    <?= $this->render('@appTheme/popup/popup-account-reset-password'); ?>
</div>

<div class="page-flash-messages"></div>

<script type="text/javascript">
    $('#settings-update').on('beforeSubmit', function () {
        $.ajax({
            url: '/cabinet/settings-update',
            type: 'post',
            data: $(this).closest('form').serialize(),
            dataType: 'json'
        }).done(function (data) {
            $('.page-flash-messages').html('');
            
            if (data.result == true) {
                var flashSuccess = '<div class="alert alert-info">';
                flashSuccess += '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>';
                flashSuccess += '<strong><?= Yii::t('app', 'Дані користувача успішно змінено!') ?></strong> ';
                flashSuccess += '</div>';
                $('.page-flash-messages').append(flashSuccess);
            } else if (data.result == false) {

                $.each(data.errors, function () {
                    $.each(this, function (key, value) {
                        var flashError = '<div class="alert alert-danger">';
                        flashError += '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>';
                        flashError += '<strong><?= Yii::t('app', 'Помилка!') ?></strong> ' + value;
                        flashError += '</div>';

                        console.log($('.page-flash-messages'));

                        $('.page-flash-messages').append(flashError);
                    });
                });
            }
        });

        return false;
    });
</script>