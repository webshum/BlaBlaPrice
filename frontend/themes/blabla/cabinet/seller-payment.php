<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="center seller-balance pb100">
	<div class="request request-main">
	    <div class="request-head">
	        <?= $this->render('@appTheme/layouts/header'); ?>
	    </div>
	</div>
	
	<h2 class="heading"><?= Yii::t('app','Ваш баланс'); ?></h2>

	<div class="blabla-comment dark">
		<div class="text">
			<?= Yii::t('app', 'Сервіс отримує комісію за обмін контактами з потенційним покупцем'); ?>
		</div>
	</div>
	
	<div class="blabla-comment dark mt50">
		<div class="text">
			<?= Yii::t('app','Ваш баланс'); ?>
			<strong style="font-weight: bold;"><?= $user->bal ?></strong>
			<?= Yii::t('app', 'балів'); ?><br>
		</div>
	</div>

	<?= $this->render('@appTheme/components/pricing.php'); ?>
</div>

<div class="popup-wrapper">
    <div class="close-layer"></div>
    <?= $this->render('@appTheme/popup/language'); ?>
</div>