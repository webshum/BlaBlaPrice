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
				<a href='accepted-without-ans' class="active">
					<?= Yii::t('app','Нові'); ?>
				</a>
			</li>
	
			<li>
	            <a href='accepted-with-ans'>
					<?= Yii::t('app','З відгуками'); ?>
				</a>
			</li>
			<li>
	            <a href='accepted-refuse'>
					<?= Yii::t('app','Відмовився'); ?>
				</a>
			</li>
		</ul>
	</div>


		<div class="empty-space-40"> </div>
	<?php foreach ($offer as $offers_item) : ?>
		<div class="request open-popup" data-param="<?= $offers_item->getID() ?>" data-rel="user-accepted">
		 	<?php
		 		$title = '';

		 		if (!empty($offers_item->order)) {
					if (!empty($offers_item->order->product) && !empty($offers_item->order->product->namel)) {
						$title = $offers_item->order->product->namel;
					} elseif (!empty($offers_item->order->category) && !empty($offers_item->order->category->name)) {
						$title = $offers_item->order->category->name;
					}
				}

			 	echo $this->render('@appTheme/components/request-head', [
			 		'title' => $title,
			 		'button' => true
			 	]); 
		 	?>

		 	<div class="request-body">
					<div class="request-info">
						<?php echo Yii::t('app', 'Контакти ') . ' ' . $offers_item->user->username; ?>
					</div>
		 		<?= $this->render('@appTheme/components/message', [
		 			'avatar' => mb_substr(strip_tags($offers_item->user->username), 0, 1),
		 			'name' => Yii::t('app', 'Контакти') . ' ' . $offers_item->user->username,
		 			'phone' => $offers_item->user->phone,
		 			'email' => $offers_item->user->email
		 		]); ?>

		 		<div class="blabla-comment">
		 			<div class="text shadow-pulse-black"><?= Yii::t('app', 'Оціни продавця'); ?></div>
		 		</div>
		 	</div>
		</div>
	<?php endforeach; ?>	

	<div class="empty-space-60"> </div>
	<div class="empty-space-60"> </div>

	<?php echo $this->render('@appTheme/components/pagination', [
        'pages' => $pages,
        'url' => 'cabinet/accepted-without-ans'
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