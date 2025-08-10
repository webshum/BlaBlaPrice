<?php

use yii\widgets\ActiveForm;
use common\models\Comment;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 * @var \common\models\Comment $comment
 * @var \common\models\Offer $offers_item ;
 */
?>

<div class="center">
	<div class="request request-main">
	    <div class="request-head">
	        <?= $this->render('@appTheme/layouts/header'); ?>
	    </div>
	</div>

	<div class="flex">
		<h2 class="heading"><?= Yii::t('app', 'Контакти компаній') ?></h2>

		<ul class="links-horizontal">
			<li>
				<a href='accepted-without-ans' >
					<?= Yii::t('app','Нові'); ?>
				</a>
			</li>
	
			<li>
	            <a href='accepted-with-ans'>
					<?= Yii::t('app','З відгуками'); ?>
				</a>
			</li>
			<li>
	            <a href='accepted-refuse' class="active">
					<?= Yii::t('app','Відмовився'); ?>
				</a>
			</li>
		</ul>
	</div>

	<div class="blabla-comment dark mt40 mb40">
		<div class="text">
			<?= Yii::t('app', 'Контакти продавців,від пропозицій яких Ви відмовились.'); ?>
		</div>
	</div>

	<?php foreach ($offer as $offers_item) : ?>
        <div class="request open-popup" data-param="<?= $offers_item->getID() ?>" data-rel="user-accepted">
        	<?php
				$title = '';

				if (isset($offers_item->order->product->name)) {
				    $title = $offers_item->order->product->name;
				} elseif (isset($offers_item->order->category->name)) {
				    $title = $offers_item->order->category->name;
				}

				echo $this->render('@appTheme/components/request-head', [
				    'title' => $title,
				    'button' => true
				]);
			?>

		 	<div class="request-body">
		 		<?php 
		 			echo $this->render('@appTheme/components/message', [
		 				'avatar' => mb_substr(strip_tags($offers_item->user->username), 0, 1),
		 				'name' => Yii::t('app', 'Контакти') . ' ' . $offers_item->user->username,
		 				'phone' => $offers_item->user->phone,
		 				'email' => $offers_item->user->email,
		 			]); 
		 		?>
				<div class="request-info">
					<?php echo Yii::t('app', 'Обмін відгуками з ') . ' ' . $offers_item->user->username; ?>
				</div>
		 		<div class="text-right">
		 			<?php 
		 				$refuse = $offers_item->getRefuse($offers_item->order->userID)->one();
		 				$comment = ($refuse->comment) ? $refuse->comment : Yii::$app->params['refuse'][$refuse->refuseID];

		 				echo $this->render('@appTheme/components/message', [
		 					'title' => Yii::t('app', 'Я відмовився'),
		 					'name' => $comment
		 				]); 
		 			?>
		 		</div>
		 	</div>
		</div>
	<?php endforeach; ?>

	<?php echo $this->render('@appTheme/components/pagination', [
        'pages' => $pages,
        'url' => 'cabinet/accepted-refuse'
    ]) ?>
</div>

<div class="popup-wrapper">
    <div class="close-layer d-none"></div>

    <div class="popup-content" data-rel="detail"></div>
    <div class="popup-content request" data-rel="user-accepted"></div>
    <div class="popup-content" data-rel="user-offer"></div>
	<div class="popup-content" data-rel="seller-view-comment"></div>
    <div class="popup-content" data-rel="user-view-contact"></div>

	<?= $this->render('@appTheme/popup/language'); ?>
</div>