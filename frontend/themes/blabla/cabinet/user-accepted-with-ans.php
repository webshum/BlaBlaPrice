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
				<a href='accepted-without-ans'>
					<?= Yii::t('app','Нові'); ?>
				</a>
			</li>
			<li>
	            <a href='accepted-with-ans' class="active">
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

	<div class="empty-space-60"> </div>
	
	<div class="blabla-comment dark ">
		<div class="text">
			<?= Yii::t('app','Контакти продавців з відгуками'); ?>
		</div>
	</div>

	<?php foreach ($offer as $offers_item) : ?>
		<?php if (($offers_item->getComment($user->ID)->one()) and !($offers_item->getRefuse($user->ID)->one())) : ?>	
	        <div class="request open-popup" data-param="<?= $offers_item->getID() ?>" data-rel="user-accepted">
	        	<?= $this->render('@appTheme/components/request-head', [
	        		'title' => $offers_item->order->product->name ? $offers_item->order->product->name : $offers_item->order->category->name,
	        	
	        		'button' => true
	        	]); ?>

	        	<div class="request-body">
	        		<?php
		        		echo $this->render('@appTheme/components/message', [
				 			'avatar' => mb_substr(strip_tags($offers_item->user->username), 0, 1),
				 			'name' => Yii::t('app', 'Контакти від') . ' ' . $offers_item->user->username,
				 			'phone' => $offers_item->user->phone,
				 			'email' => $offers_item->user->email,
				 			'date' => $offers_item->getCreatedAt(),
				 		]); 
			 		?>
					
					<div class="request-info">
						<?php echo Yii::t('app', 'Обмін відгуками з ') . ' ' . $offers_item->user->username; ?>
					</div>

					<div class="text-right">
						<?php 
							$rating = Comment::Rating($offers_item->getAnswer($offers_item->userID)->one()->rating);
							$title = $rating['name'] . ' ' . Yii::t('app', 'продавець');
							$date = $offers_item->user->getUpdatedAt();		

							echo $this->render('@appTheme/components/message', [
									'title' => $title,
									'date' => $date,
									'class' => $rating['class']
							]);		
						?>		
					</div>
	        	</div>
	        </div>
		<?php endif; ?>
	<?php endforeach; ?>

	<div class="empty-space-60"> </div>
	<div class="empty-space-60"> </div>

	<?php echo $this->render('@appTheme/components/pagination', [
        'pages' => $pages,
        'url' => 'cabinet/accepted-with-ans'
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