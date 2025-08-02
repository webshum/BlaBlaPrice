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
        <div class="popup-paddings">
		    <a class="button style-10 size-3 btn-close open-static-popup" data-rel="account-login">
                <span><i class="icon-cancel-2 blue-icon"></i></span>
            </a>
            <div class="empty-space col-xs-b30 col-sm-b30"></div>
            <div class="h4-b "><?= Yii::t('app', 'Реєстрація'); ?></div>
            <div class="empty-space col-xs-b30"></div>
        </div>

        <div class="popup-paddings">
			<div class="blabla-comment">
				<div class="user-photo-left icon-logo">
					<img src="/img/icon-logo.png" alt="">
				</div>
				<b><?php echo Yii::t('app', 'Ти хочеш отримувати чи надсилати пропозиції ? '); ?></b>
			</div>

			<div class="empty-space col-xs-b20 col-sm-b20"></div>

            <?php 
                $signupForm = new SignupForm(); 
                $form = ActiveForm::begin(['id' => 'reigster-role-social']);
            ?>

            <div class="tabs-block switch-role">
                <label class="checkbox-entry radio tab-menu">
                    <?= Html::radio('SignupForm[role]', true, ['value' => User::ROLE_USER]) ?>
                    <span><?= Yii::t('app', 'Хочу купляти'); ?></span>
                </label>
                <div class="empty-space col-xs-b5"></div>

                <label class="checkbox-entry radio tab-menu">
                    <?= Html::radio('SignupForm[role]', false, ['value' => User::ROLE_SELLER]) ?>
                    <span><?= Yii::t('app', 'Хочу надсилати пропозиції'); ?></span>
                </label>
            </div>

            <!-- user -->
            <div class="clearfix wrap-submit active">
                <div class="empty-space col-xs-b30 col-sm-b30"></div>

                <div class="blabla-comment register-btn-user">
					<div class="user-photo-left icon-logo">
						<img src="/img/icon-logo.png" alt="">
					</div>
					<b>
						<?php echo Yii::t('app', 'Ти реєструєшся як'); ?>
						<?php echo Yii::t('app', ' ПОКУПЕЦЬ'); ?>.
						<a class="link-termsofuse" href="/site/termsofuse"><?php echo Yii::t('app', 'Ось договір публічної оферти '); ?> </a>
						<?php echo Yii::t('app', 'якщо погоджуєшся натисни галочу і реєструйся '); ?>
					</b>
				</div>

                <div class="empty-space col-xs-b20 col-sm-b20"></div>

                <div class="formname register-btn-user">
                    <input id="checkbox-user-2" type="checkbox" name="checkbox" onchange="document.getElementById('submit-user-2').disabled = !this.checked;" />
                    <label for="checkbox-user-2"><?php echo Yii::t('app', 'Погоджуюсь з публічною овертою'); ?></label>
                    <input class="button size-1" type="submit" disabled="disabled" name="submit" id="submit-user-2" value="<?php echo Yii::t('app', 'Зареєструватись покупцем '); ?>" />
                </div>
            </div>

            <!-- seller -->
            <div class="clearfix wrap-submit">
                <div class="empty-space col-xs-b30 col-sm-b30"></div>

                <div class="blabla-comment register-btn-seller">
					<div class="user-photo-left icon-logo">
						<img src="/img/icon-logo.png" alt="">
					</div>
					<b>
						<?php echo Yii::t('app', 'Ти реєструєшся як'); ?>
						<?php echo Yii::t('app', 'ПРОДАВЕЦЬ'); ?>.
						<a class="link-termsofuse" href="/site/termsofuse"><?php echo Yii::t('app', 'Ось договір публічної оферти '); ?> </a>
						<?php echo Yii::t('app', 'якщо погоджуєшся натисни галочу і реєструйся '); ?>
					</b>
				</div>

                <div class="empty-space col-xs-b20 col-sm-b20"></div>

                <div class="formname register-btn-seller">
                    <input id="checkbox-seller-2" type="checkbox" name="checkbox" onchange="document.getElementById('submit-seller-2').disabled = !this.checked;" />
                    <label for="checkbox-seller-2"><?php echo Yii::t('app', 'Погоджуюсь з публічною овертою'); ?></label>
                    <input class="button size-1" type="submit" disabled="disabled" name="submit" id="submit-seller-2" value="<?php echo Yii::t('app', 'Зареєструватись продавцем'); ?>" />
                </div>
            </div>

           	<div class="empty-space col-xs-b30 col-sm-b30"></div>
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
        <div class="popup-paddings">
		    <a class="button style-10 size-3 open-static-popup btn-absolute" data-rel="account-login">
                <span><i class="icon-cancel-2 blue-icon"></i></span>
            </a>
            <div class="empty-space col-xs-b30 col-sm-b30"></div>
            <div class="h4-b "><?= Yii::t('app', 'Реєстрація'); ?></div>
            <div class="empty-space col-xs-b30"></div>
        </div>

        <div class="popup-paddings">
			<div class="blabla-comment">
				<div class="user-photo-left icon-logo">
					<img src="/img/icon-logo.png" alt="">
				</div>
				<b><?php echo Yii::t('app', 'Ти хочеш отримувати чи надсилати пропозиції ? '); ?></b>
			</div>

			<div class="empty-space col-xs-b20 col-sm-b20"></div>

            <?php 
                $signupForm = new SignupForm(); 
                $form = ActiveForm::begin(['id' => 'reigster-role-social']);
            ?>

            <div class="tabs-block switch-role">
                <label class="checkbox-entry radio tab-menu">
                    <?= Html::radio('SignupForm[role]', true, ['value' => User::ROLE_USER]) ?>
                    <span><?= Yii::t('app', 'Хочу купляти'); ?></span>
                </label>
                <div class="empty-space col-xs-b5"></div>

                <label class="checkbox-entry radio tab-menu">
                    <?= Html::radio('SignupForm[role]', false, ['value' => User::ROLE_SELLER]) ?>
                    <span><?= Yii::t('app', 'Хочу надсилати пропозиції'); ?></span>
                </label>
            </div>

            <!-- user -->
            <div class="clearfix wrap-submit active">
                <div class="empty-space col-xs-b30 col-sm-b30"></div>

                <div class="blabla-comment register-btn-user">
					<div class="user-photo-left icon-logo">
						<img src="/img/icon-logo.png" alt="">
					</div>
					<b>
						<?php echo Yii::t('app', 'Ти реєструєшся як'); ?>
						<?php echo Yii::t('app', ' ПОКУПЕЦЬ'); ?>.
						<a class="link-termsofuse" href="/site/termsofuse"><?php echo Yii::t('app', 'Ось договір публічної оферти '); ?> </a>
						<?php echo Yii::t('app', 'якщо погоджуєшся натисни галочу і реєструйся '); ?>
					</b>
				</div>

                <div class="empty-space col-xs-b20 col-sm-b20"></div>

                <div class="formname register-btn-user">
                    <input id="register-checkbox-user-2" type="checkbox" name="checkbox" onchange="document.getElementById('register-submit-user-2').disabled = !this.checked;" />
                    <label for="register-checkbox-user-2"><?php echo Yii::t('app', 'Погоджуюсь з публічною овертою'); ?></label>
                    <input class="button size-1 open-static-popup" type="submit" disabled="disabled" name="submit" id="register-submit-user-2" data-rel="registration-user" value="<?php echo Yii::t('app', 'Зареєструватись покупцем '); ?>" />
                </div>
            </div>

            <!-- seller -->
            <div class="clearfix wrap-submit">
                <div class="empty-space col-xs-b30 col-sm-b30"></div>

                <div class="blabla-comment register-btn-seller">
					<div class="user-photo-left icon-logo">
						<img src="/img/icon-logo.png" alt="">
					</div>
					<b>
						<?php echo Yii::t('app', 'Ти реєструєшся як'); ?>
						<?php echo Yii::t('app', 'ПРОДАВЕЦЬ'); ?>.
						<a class="link-termsofuse" href="/site/termsofuse"><?php echo Yii::t('app', 'Ось договір публічної оферти '); ?> </a>
						<?php echo Yii::t('app', 'якщо погоджуєшся натисни галочу і реєструйся '); ?>
					</b>
				</div>

                <div class="empty-space col-xs-b20 col-sm-b20"></div>

                <div class="formname register-btn-seller">
                    <input id="register-checkbox-seller-2" type="checkbox" name="checkbox" onchange="document.getElementById('register-submit-seller-2').disabled = !this.checked;" />
                    <label for="register-checkbox-seller-2"><?php echo Yii::t('app', 'Погоджуюсь з публічною овертою'); ?></label>
                    <input class="button size-1 open-static-popup" type="submit" disabled="disabled" name="submit" id="register-submit-seller-2" data-rel="registration-seller" value="<?php echo Yii::t('app', 'Зареєструватись продавцем'); ?>" />
                </div>
            </div>

           	<div class="empty-space col-xs-b30 col-sm-b30"></div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- // REGISTRATION -->

<!-- REGISTRATION USER -->
<div class="popup-content" data-rel="registration-user">
    <div class="popup-container">
        <div class="popup-paddings">
            <div class="empty-space col-xs-b25"></div>
            <div class="h4-b"><b><?= Yii::t('app', 'Реєстрація покупця'); ?></b></div>
            <div class="empty-space col-xs-b25"></div>

            <div class="row m5">
              

                <div class="col-sm-12">
                    <a href="/site/auth-google" class="button style-7 size-2 shadow block btn-social">
                        <span>Google+</span>
                    </a>
                </div>
            </div>

            <div class="empty-space col-xs-b35 col-sm-b30"></div>
        </div>

        <div class="popup-paddings">
            <div class="popup-circle-title">
                <?= Yii::t('app', 'або'); ?>
            </div>

            <?php 
                $signupForm = new SignupForm();
                $form = ActiveForm::begin(['id' => 'registration-user-form']);
            ?>

            <div class="tabs-block">
                <?= $form->field($signupForm, 'username')->textInput([
                    'class' => 'simple-input size-2',
                    'placeholder' => Yii::t('app', 'Ваше ім\'я *'),
                    'oninput' => "setCustomValidity('')",
                    'oninvalid' => "this.setCustomValidity('" . Yii::t('app', 'Будь ласка, заповніть') . "')",
                    'required' => true
                ])->label(false) ?>

                <div class="tab-entry"></div>

                <?= $form->field($signupForm, 'email')->textInput([
                    'class' => 'simple-input size-2',
                    'placeholder' => Yii::t('app', 'Ваш email *'),
                    'oninput' => "setCustomValidity('')",
                    'oninvalid' => "this.setCustomValidity('" . Yii::t('app', 'Будь ласка, заповніть') . "')",
                    'required' => true
                ])->label(false) ?>
            </div>

            <div class="empty-space col-xs-b15"></div>

            <div class="clearfix btn-group-popup">
                <button type="submit" class="new-page-button-label pull-right">
                    <span><?= Yii::t('app', 'ГОТОВО'); ?></span>
                </button>

                <a class="new-page-button-label  open-static-popup" data-rel="registration">
                    <span><?=Yii::t('app', 'НАЗАД')?></span>
                </a>
            </div>

            <div class="empty-space col-xs-b20"></div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- // REGISTRATION USER -->

<!-- REGISTRATION NUMBER PHONE -->
<div class="popup-content" data-rel="registration-user-phone">
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

                <a class="new-page-button-label btn-back open-static-popup" data-rel="registration-user">
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
<div class="popup-content" data-rel="registration-user-active-phone">
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

<!-- REGISTRATION USER SUCCESS -->
<div class="popup-content" data-rel="registration-user-success">
    <div class="popup-container">
        <div class="popup-paddings">
            <div class="empty-space col-xs-b35"></div>
            <div class="h3 text-center"><b><?= Yii::t('app', 'Вітаємо реєстрація пройшла успішно'); ?></b></div>
            <div class="empty-space col-xs-b50"></div>
        </div>

        <div class="popup-paddings ">
            <div class="empty-space col-xs-b30"></div>
            <p><?= Yii::t('app', 'Тепер ви можете купувати товари за найкращими цінами в Україні.'); ?></p>
            <p><?= Yii::t('app', 'Розкажіть що Вам потрібно придбати і отримайте пропозиції від надійних продавців.'); ?></p>
            <p><?= Yii::t('app', 'Ви можете погодитись або відмовитись від пропозицій.'); ?></p>
            <div class="empty-space col-xs-b30"></div>

            <div class="clearfix text-center btn-group-popup">
                <a href="#" class="button shadow redirect-cabinet style-3 size-2">
                    <span><?= Yii::t('app', 'OK'); ?></span>
                </a>
            </div>
            <div class="empty-space col-xs-b20"></div>
        </div>
    </div>
</div>
<!-- // REGISTRATION USER SUCCESS -->

<!-- ********************* SELLECR ********************* -->

<!-- REGISTRATION SELLER -->
<div class="popup-content" data-rel="registration-seller">
    <div class="popup-container">
        <div class="popup-paddings">
            <div class="empty-space col-xs-b25"></div>
            <div class="h4-b"><b><?= Yii::t('app', 'Реєстрація продавця '); ?></b></div>
            <div class="empty-space col-xs-b50"></div>

            <div class="row m5">
              

                <div class="col-sm-12">
                    <a href="/site/auth-google" class="button style-7 size-2 shadow block btn-social">
                        <span>Google+</span>
                    </a>
                </div>
            </div>

            <div class="empty-space col-xs-b50"></div>
        </div>

        <div class="popup-paddings">
            <div class="popup-circle-title">
                <?= Yii::t('app', 'або'); ?>
            </div>

            <?php 
                $signupForm = new SignupForm(); 
                $form = ActiveForm::begin(['id' => 'registration-seller-form']);
            ?>

            <div class="tabs-block">
                <?= $form->field($signupForm, 'username')->textInput([
                    'class' => 'simple-input size-2',
                    'placeholder' => Yii::t('app', 'Назва компанії *'),
                    'oninput' => "setCustomValidity('')",
                    'oninvalid' => "this.setCustomValidity('" . Yii::t('app', 'Будь ласка, заповніть') . "')",
                    'required' => true
                ])->label(false) ?>

                <div class="tab-entry"></div>

                <?= $form->field($signupForm, 'email')->Input('email',[
                    'class' => 'simple-input size-2',
                    'placeholder' => Yii::t('app', 'Ваш email *'),
                    'oninput' => "setCustomValidity('')",
                    'oninvalid' => "this.setCustomValidity('" . Yii::t('app', 'Будь ласка, заповніть') . "')",
                    'required' => true
                ])->label(false) ?>
            </div>

            <div class="empty-space col-xs-b5"></div>

            <div class="clearfix btn-group-popup">
                <button type="submit" class="new-page-button-label pull-right">
                    <span><?= Yii::t('app', 'ГОТОВО'); ?></span>
                </button>

                <a class="new-page-button-label close-popup" data-rel="registration" style="color:#a6a6a6;">
                    <span><?=Yii::t('app', 'НАЗАД')?></span>
                </a>
            </div>

            <div class="empty-space col-xs-b20"></div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- // REGISTRATION SELLER -->

<!-- REGISTRATION SELLER SUCCESS -->
<div class="popup-content" data-rel="registration-seller-success">
    <div class="popup-container">
        <div class="popup-paddings">
            <div class="empty-space col-xs-b35"></div>
            <div class="h3 text-center"><b><?= Yii::t('app', 'Вітаємо ви  успішно пройшли реєстрацію'); ?></b></div>
        </div>

        <div class="popup-paddings">
            <div class="empty-space col-xs-b30"></div>
            <p><?= Yii::t('app', 'Тепер ви можете пропонувати свої ціни в Україні.'); ?></p>
            <div class="empty-space col-xs-b30"></div>

            <div class="clearfix text-center btn-group-popup">
                <a href="#" class="button shadow redirect-cabinet style-3 size-2">
                    <span><?= Yii::t('app', 'Перейти до запитів'); ?></span>
                </a>
            </div>

            <div class="empty-space col-xs-b20"></div>
        </div>
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
                <a class="new-page-button-label btn-back open-static-popup" data-rel="registration-seller">
                    <span><?=Yii::t('app', 'НАЗАД')?></span>
                </a>
            </div>

            <div class="empty-space col-xs-b20"></div>

        </div>
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
