<?php

use yii\helpers\Html;
use common\models\User;
use frontend\models\SignupForm;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\Session;
use yii\web\Cookie;


if (Yii::$app->user->isGuest) {
    $user = new \common\models\User();
} else {
    $user = Yii::$app->user->identity;
}

$cookies = \Yii::$app->getRequest()->getCookies();

?>

<?php if ($cookies->has('register_social')) : ?>
<!-- REGISTRATION SOCIAL -->
<div class="popup-content popup-register active" data-rel="registration-social" <?= ($cookies->has('email')) ? "data-email={$cookies->getValue('email')}" : ''; ?>>
	<div class="popup-container">
        <a class="close-popup-all">
            <svg width="12" height="12"><use xlink:href="#close-layer"></use></svg>
        </a>

        <div class="popup-title"><?= Yii::t('app', 'Реєстрація'); ?></div>

        <div class="blabla-comment ">
            <div class="text" style="background: #f4f4f5">
                <p><?= Yii::t('app', 'Ти хочеш отримувати чи надсилати пропозиції ?'); ?></p>
            </div>
        </div>

        <div class="popup-paddings">
            <?php 
                $signupForm = new SignupForm(); 
                $form = ActiveForm::begin(['id' => 'reigster-role-social']);
            ?>

            <div class="switch-role">
                <label class="input-checkbox">
                    <?= Html::radio('SignupForm[role]', true, ['value' => User::ROLE_USER]) ?>
                    <div class="checkbox"></div>
                    <span><?= Yii::t('app', 'Хочу купляти'); ?></span>
                </label>

                <label class="input-checkbox">
                    <?= Html::radio('SignupForm[role]', false, ['value' => User::ROLE_SELLER]) ?>
                    <div class="checkbox"></div>
                    <span><?= Yii::t('app', 'Хочу надсилати пропозиції'); ?></span>
                </label>
            </div>

            <!-- user -->
            <div class="wrap-submit active mt30">
                <div class="blabla-comment ">
                    <div class="text" style="background: #f4f4f5">
                        <h4><?= Yii::t('app', 'ТИ РЕЄСТРУЄШСЯ ЯК'); ?> <?= Yii::t('app', 'ПОКУПЕЦЬ'); ?></h4>
                        <p>
                            <a class="decoration" href="/site/termsofuse">
                                <?= Yii::t('app', 'Ось договір публічної оферти'); ?> 
                            </a>,
                            <?= Yii::t('app', 'якщо погоджуєшся натисни галочу і реєструйся'); ?>
                        </p>
                    </div>
                </div>

                <div class="register-btn-user">
                    <label class="input-radio mt30">
                        <input type="checkbox" name="checkbox" onchange="document.getElementById('submit-user-2').disabled = !this.checked;" />
                        <div class="radio"></div>
                        <span><?= Yii::t('app', 'Погоджуюсь з публічною овертою'); ?></span>
                    </label>

                    <button type="submit" disabled="disabled" class="popup-button blue w-100 mt10" id="submit-user-2" name="submit">
                       
						 <span><?= Yii::t('app', 'Зареєструватись покупцем'); ?></span>
                    </button>
                </div>
            </div>

            <!-- seller -->
            <div class="wrap-submit mt30">
                <div class="blabla-comment">
                    <div class="text">
                        <h4><?= Yii::t('app', 'ТИ РЕЄСТРУЄШСЯ ЯК'); ?> <?= Yii::t('app', 'ПРОДАВЕЦЬ'); ?></h4>
                        <p>
                            <a class="decoration" href="/site/termsofuse">
                                <?= Yii::t('app', 'Ось договір публічної оферти'); ?> 
                            </a>,
                            <?= Yii::t('app', 'якщо погоджуєшся натисни галочу і реєструйся'); ?>
                        </p>
                    </div>
                </div>

                <div class="register-btn-seller mt30">
                    <label class="input-radio">
                        <input id="register-checkbox-seller-2" type="checkbox" name="checkbox" onchange="document.getElementById('register-submit-seller-2').disabled = !this.checked;" />
                        <div class="radio"></div>
                        <span><?= Yii::t('app', 'Погоджуюсь з публічною овертою'); ?></span>
                    </label>

                    <button type="submit" disabled="disabled" class="popup-button blue w-100  mt10" id="register-submit-seller-2">
                        <span><?= Yii::t('app', 'Зареєструватись продавцем'); ?></span>
                    </button>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- // REGISTRATION SOCIAL -->
<?php endif; ?>

<!-- ********************* USER ********************* -->

<!-- REGISTRATION -->
<div class="popup-content popup-register" data-rel="registration">
	<div class="popup-container">
        <a class="close-popup-all">
            <svg width="12" height="12"><use xlink:href="#close-layer"></use></svg>
        </a>

        <div class="popup-title"><?= Yii::t('app', 'Реєстрація'); ?></div>

        <div class="blabla-comment">
            <div class="text" style="background: #f4f4f5">
                <p><?= Yii::t('app', 'Ти хочеш отримувати чи надсилати пропозиції ?'); ?></p>
            </div>
        </div>

        <div class="popup-paddings">
            <?php 
                $signupForm = new SignupForm(); 
                $form = ActiveForm::begin(['id' => 'reigster-role-social']);
            ?>

            <div class="switch-role">
                <label class="input-checkbox">
                    <?= Html::radio('SignupForm[role]', true, ['value' => User::ROLE_USER]) ?>
                    <div class="checkbox"></div>
                    <span><?= Yii::t('app', 'Хочу купляти'); ?></span>
                </label>

                <label class="input-checkbox">
                    <?= Html::radio('SignupForm[role]', false, ['value' => User::ROLE_SELLER]) ?>
                    <div class="checkbox"></div>
                    <span><?= Yii::t('app', 'Хочу надсилати пропозиції'); ?></span>
                </label>
            </div>

            <!-- user -->
            <div class="wrap-submit active mt30">
                <div class="blabla-comment">
                    <div class="text" style="background: #f4f4f5">
                        <h4><?= Yii::t('app', 'ТИ РЕЄСТРУЄШСЯ ЯК'); ?> <?= Yii::t('app', 'ПОКУПЕЦЬ'); ?></h4>
                        <p>
                            <a class="decoration" href="/site/termsofuse">
                                <?= Yii::t('app', 'Ось договір публічної оферти '); ?> 
                            </a>,
                            <?= Yii::t('app', 'якщо погоджуєшся натисни галочу і реєструйся'); ?>
                        </p>
                    </div>
                </div>

                <div class="register-btn-user mt30">
                    <label class="input-radio">
                        <input type="checkbox" name="checkbox" onchange="document.getElementById('submit-user-2').disabled = !this.checked;" />
                        <div class="radio"></div>
                        <span><?= Yii::t('app', 'Погоджуюсь з публічною овертою'); ?></span>
                    </label>

                    <button type="submit" disabled="disabled" class="popup-button blue w-100 mt10 open-static-popup" id="submit-user-2" name="submit" data-rel="registration-user">
                        <span><?= Yii::t('app', 'Зареєструватись покупцем'); ?></span>
                    </button>
                </div>
            </div>

            <!-- seller -->
            <div class="wrap-submit mt30">
                <div class="blabla-comment">
                    <div class="text" style="background: #f4f4f5">
                        <h4><?= Yii::t('app', 'ТИ РЕЄСТРУЄШСЯ ЯК'); ?> <?= Yii::t('app', 'ПРОДАВЕЦЬ'); ?></h4>
                        <p>
                            <a class="decoration" href="/site/termsofuse">
                                <?= Yii::t('app', 'Ось договір публічної оферти'); ?> 
                            </a>,
                            <?= Yii::t('app', 'якщо погоджуєшся натисни галочу і реєструйся'); ?>
                        </p>
                    </div>
                </div>

                <div class="register-btn-seller mt30">
                    <label class="input-radio">
                        <input id="register-checkbox-seller-2" type="checkbox" name="checkbox" onchange="document.getElementById('register-submit-seller-2').disabled = !this.checked;" />
                        <div class="radio"></div>
                        <span><?= Yii::t('app', 'Погоджуюсь з публічною овертою'); ?></span>
                    </label>

                    <button type="submit" disabled="disabled" class="popup-button blue w-100 open-static-popup mt10" data-rel="registration-seller" id="register-submit-seller-2">
                        <span><?= Yii::t('app', 'Зареєструватись продавцем'); ?></span>
                    </button>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- // REGISTRATION -->

<!-- REGISTRATION USER -->
<div class="popup-content" data-rel="registration-user">
    <div class="popup-container">
        <a class="close-popup-all">
            <svg width="12" height="12"><use xlink:href="#close-layer"></use></svg>
        </a>

        <div class="popup-title"><?= Yii::t('app', 'Реєстрація покупця'); ?></div>

        <a href="/site/auth-google" class="popup-button w-100 red btn-social">
            <b><span>GOOGLE</span></b>
        </a>

        <div class="popup-paddings">
            <div class="popup-title"><?= Yii::t('app', 'або'); ?></div>

            <?php 
                $signupForm = new SignupForm();
                $form = ActiveForm::begin(['id' => 'registration-user-form']);
            ?>

            <?= $form->field($signupForm, 'username')->textInput([
                'class' => 'textInput',
                'placeholder' => Yii::t('app', 'Ваше ім\'я *'),
                'oninput' => "setCustomValidity('')",
                'oninvalid' => "this.setCustomValidity('" . Yii::t('app', 'Будь ласка, заповніть') . "')",
                'required' => true
            ])->label(false) ?>

            <div class="tab-entry"></div>

            <?= $form->field($signupForm, 'email')->textInput([
                'class' => 'input',
                'placeholder' => Yii::t('app', 'Ваш email *'),
                'oninput' => "setCustomValidity('')",
                'oninvalid' => "this.setCustomValidity('" . Yii::t('app', 'Будь ласка, заповніть') . "')",
                'required' => true
            ])->label(false) ?>

            <button type="submit" class="popup-button blue w-100">
                <span><?= Yii::t('app', 'Готово'); ?></span>
            </button>

            <a href="#" class="popup-button w-100 open-static-popup mt15" data-rel="registration">
                <svg width="19" height="12"><use xlink:href="#arr-back"></use></svg>
                <span><?= Yii::t('app', 'Назад'); ?></span>
            </a>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- // REGISTRATION USER -->

<!-- REGISTRATION NUMBER PHONE -->
<div class="popup-content" data-rel="registration-user-phone">
    <div class="popup-container">
        <div class="popup-title"><?= Yii::t('app', 'Введіть номер телефона'); ?></div>

        <?php 
            $signupForm = new SignupForm(); 
            $form = ActiveForm::begin(['id' => 'registration-phone-form']);
        ?>

        <p class="popup-text"><?= Yii::t('app', 'На Ваш номер буде відправлено код підтвердження'); ?></p>

        <?= $form->field($signupForm, 'phone')->textInput([
            'class' => 'input',
            'placeholder' => Yii::t('app', '+38 (099) 999-99-99'),
            'label' => Yii::t('app', 'Телефон *'),
            'oninput' => "setCustomValidity('')",
            'oninvalid' => "this.setCustomValidity('" . Yii::t('app', 'Будь ласка, заповніть') . "')",
            'required' => true
        ])->label(false) ?>

        <button type="submit" class="popup-button w-100 blue open-static-popup" data-rel="registration-user-active-phone">
            <span><?= Yii::t('app', 'Вперед'); ?></span>
        </button>

        <a class="popup-button w-100 mt15 open-static-popup" data-rel="registration-user">
            <svg width="19" height="12"><use xlink:href="#arr-back"></use></svg>
            <span><?=Yii::t('app', 'Назад')?></span>
        </a>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<!-- // REGISTRATION NUMBER PHONE -->

<!-- REGISTRATION ACTIVE PHONE -->
<div class="popup-content" data-rel="registration-user-active-phone">
    <div class="popup-container">
        <div class="popup-title"><?= Yii::t('app', 'Введіть код підтвердження'); ?></div>

        <p class="mb15"><?= Yii::t('app', 'На номер телефону було відправлено СМС з кодом підтвердження '); ?></p>

        <?php 
            $signupForm = new SignupForm(); 
            $form = ActiveForm::begin(['id' => 'registration-active-form']);
        ?>

        <?= $form->field($signupForm, 'code')->textInput([
            'class' => 'input',
            'placeholder' => Yii::t('app', 'Код підтвердження '),
            'oninput' => "setCustomValidity('')",
            'oninvalid' => "this.setCustomValidity('" . Yii::t('app', 'Будь ласка, заповніть') . "')",
            'required' => true
        ])->label(false) ?>

        <button type="submit" class="popup-button w-100 blue mt15">
            <span><?= Yii::t('app', 'Підтвердити'); ?></span>
        </button>

        <a class="popup-button w-100 open-static-popup mt15" data-rel="registration-user-phone">
            <svg width="19" height="12"><use xlink:href="#arr-back"></use></svg>
            <span><?=Yii::t('app', 'Назад')?></span>
        </a>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<!-- // REGISTRATION ACTIVE PHONE -->

<!-- REGISTRATION USER SUCCESS -->
<div class="popup-content popup-success" data-rel="registration-user-success">
    <div class="popup-container">
        <div class="popup-title"><?= Yii::t('app', 'Вітаємо реєстрація пройшла успішно'); ?></div>

        <ul class="mt30">
            <li>
                <?= Yii::t('app', 'Тепер ви можете купувати товари за найкращими цінами в Україні.'); ?>
            </li>
            <li>
                <?= Yii::t('app', 'Розкажіть що Вам потрібно придбати і отримайте пропозиції від надійних продавців.'); ?>
            </li>
            <li>
                <?= Yii::t('app', 'Ви можете погодитись або відмовитись від пропозицій.'); ?>
            </li>
        </ul>

        <a href="#" class="popup-button w-100 blue mt30 redirect-cabinet">
            <span><?= Yii::t('app', 'Зрозуміло'); ?></span>
        </a>
    </div>
</div>
<!-- // REGISTRATION USER SUCCESS -->

<!-- ********************* SELLECR ********************* -->

<!-- REGISTRATION SELLER -->
<div class="popup-content" data-rel="registration-seller">
    <div class="popup-container">
        <a class="close-popup-all">
            <svg width="12" height="12"><use xlink:href="#close-layer"></use></svg>
        </a>

        <div class="popup-title"><?= Yii::t('app', 'Реєстрація продавця'); ?></div>

        <a href="/site/auth-google" class="popup-button w-100 red btn-social">
            <b><span>GOOGLE</span></b>
        </a>

        <div class="popup-paddings">
            <div class="popup-title"><?= Yii::t('app', 'або'); ?></div>

            <?php 
                $signupForm = new SignupForm(); 
                $form = ActiveForm::begin(['id' => 'registration-seller-form']);
            ?>

            <?= $form->field($signupForm, 'username')->textInput([
                'class' => 'input',
                'placeholder' => Yii::t('app', 'Назва компанії *'),
                'oninput' => "setCustomValidity('')",
                'oninvalid' => "this.setCustomValidity('" . Yii::t('app', 'Будь ласка, заповніть') . "')",
                'required' => true
            ])->label(false) ?>

            <div class="tab-entry"></div>

            <?= $form->field($signupForm, 'email')->Input('email',[
                'class' => 'input',
                'placeholder' => Yii::t('app', 'Ваш email *'),
                'oninput' => "setCustomValidity('')",
                'oninvalid' => "this.setCustomValidity('" . Yii::t('app', 'Будь ласка, заповніть') . "')",
                'required' => true
            ])->label(false) ?>

            <button type="submit" class="popup-button blue w-100">
                <span><?= Yii::t('app', 'Зареєструватися'); ?></span>
            </button>

            <a class="popup-button w-100 open-static-popup mt15" data-rel="registration">
                <svg width="19" height="12"><use xlink:href="#arr-back"></use></svg>
                <span><?=Yii::t('app', 'Назад')?></span>
            </a>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- // REGISTRATION SELLER -->

<!-- REGISTRATION SELLER SUCCESS -->
<div class="popup-content" data-rel="registration-seller-success">
    <div class="popup-container">
        <div class="popup-title"><?= Yii::t('app', 'Вітаємо реєстрація пройшла успішно!'); ?></div>

        <p>
            <?= Yii::t('app', 'Тепер ви можете пропонувати свої ціни'); ?>
        </p>

        <a href="#" class="popup-button blue w-100 mt30 redirect-cabinet">
            <span><?= Yii::t('app', 'Перейти до запитів'); ?></span>
        </a>
    </div>
</div>
<!-- // REGISTRATION SELLER SUCCESS -->

<!-- ********************* ERROR ********************* -->

<!-- ERROR EMAIL -->
<div class="popup-content" data-rel="registration-user-error-email">
    <div class="popup-container">
        <div class="popup-paddings">
            <div class="empty-space col-xs-b35"></div>
            <div class="h3 text-center"><b><?= Yii::t('app', 'Помилка реєстрації'); ?></b></div>
            <div class="empty-space col-xs-b50"></div>
        </div>

        <div class="popup-paddings ">

            <div class="empty-space col-xs-b30"></div>

            <div class="alert text-center alert-danger"><p><?= Yii::t('app', 'Користувач з таким E-mail уже існує'); ?></p></div>

            <div class="empty-space col-xs-b5"></div>

            <div class="clearfix btn-group-popup">
                <a class="new-page-button-label btn-back open-static-popup" data-rel="registration-user">
                    <span><?=Yii::t('app', 'НАЗАД')?></span>
                </a>
            </div>

            <div class="empty-space col-xs-b20"></div>

        </div>
    </div>
</div>
<!-- // ERROR EMAIL -->

<!-- ERROR EMAIL SELLER -->
<div class="popup-content" data-rel="registration-seller-error-email">
    <div class="popup-container">
        <div class="popup-title"><?= Yii::t('app', 'Помилка реєстрації'); ?></div>

        <div class="alert text-center alert-danger">
            <p><?= Yii::t('app', 'Користувач з таким E-mail уже існує'); ?></p>
        </div>

        <a class="popup-button w-100 open-static-popup" data-rel="registration-seller">
            <svg width="19" height="12"><use xlink:href="#arr-back"></use></svg>
            <span><?=Yii::t('app', 'Назад')?></span>
        </a>
    </div>
</div>
<!-- // ERROR EMAIL SELLER -->

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
        <div class="popup-title"><?= Yii::t('app', 'Помилка реєстрації'); ?></div>

        <div class="alert text-center alert-danger">
            <p><?= Yii::t('app', 'Не вірний код'); ?></p>
        </div>

        <a class="popup-button w-100 open-static-popup" data-rel="registration-user-active-phone">
            <svg width="19" height="12"><use xlink:href="#arr-back"></use></svg>
            <span><?= Yii::t('app', 'НАЗАД');?></span>
        </a>
    </div>
</div>
<!-- // ERROR PHONE CODE -->