<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\models\User;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Контакти');

?>

<div class="center">
	<div class="request-head">
        <?= $this->render('@appTheme/layouts/header'); ?>
    </div>
    <div class="blabla-comment dark mt20">
            <div class="text">
                <?= Yii::t('app','Чекаємо на твої запитання або пропозиції співпраці'); ?>    
team@blablaprice.com				
            </div>
	</div>

    <div class="request-body request-main page-contact">
        

       

       
        <h5><?= Yii::t('app','Напиши нам :)'); ?></h5>

        <form action="#" class="form-contact-ajax mb50">
            <input type="hidden" name="title" value="<?= Yii::t('app','Пропозиції співпраці'); ?>">
            
            <div class="input-group">
                <div class="field">
                    <input class="input" type="email" name="email" required placeholder=" <?= Yii::t('app','Твій E-mail'); ?>     ">
                </div>

               
            </div>

            <textarea class="input mt20 min-h-100" name="descr" required placeholder="<?= Yii::t('app','Твоє повідомлення'); ?> "></textarea>

            <div class="text-right mt20">
                <button type="submit" class="popup-button blue">
                    <span><?= Yii::t('app','Надіслати'); ?></span>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="popup-wrapper">
    <div class="close-layer"></div>

    <?= $this->render('@appTheme/popup/popup-account-login') ?>
    <?= $this->render('@appTheme/popup/popup-account-registration') ?>
    <?= $this->render('@appTheme/popup/popup-account-reset-password') ?>
	<?= $this->render('@appTheme/popup/language'); ?>
</div>
    
<!-- SCRIPTS BEGIN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="js/global.js"></script>
<script src="js/wow.min.js"></script>
<script>
    var wow = new WOW();
    if(!_ismobile) wow.init();
</script>

<?php
$this->registerJs('
    var wow = new WOW();
    if(!_ismobile) wow.init();
    ', \yii\web\View::POS_END);
?>
<!-- SCRIPTS END -->