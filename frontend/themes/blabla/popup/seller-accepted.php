<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\helpers\Url;
use frontend\models\SignupForm;
use common\models\Comment;

// Set current user phone :
if (Yii::$app->user->isGuest) {
    $user = new \common\models\User();
} else {
    $user = Yii::$app->user->identity;
}

// generate regions
$user = User::findOne(['ID' => Yii::$app->user->id]);

/**
 * @var \yii\web\View $this
 * @var \common\models\Order $order
 * @var \common\models\Offer $offer
 */
?>

<div class="popup-container wide">
	<?= $this->render('@appTheme/components/request-head', [
		'title' => $offer->order->category->name,
		'button' => false
	]) ?>

	<div class="request-body">
		<div class="request-body_inner">
			<!-- USER -->
			<div class="request-info">
				<?php echo Yii::t('app', 'Запит клієнта'); ?>
			</div>
			<?= $this->render('@appTheme/components/message', [
					
					'nameReviews' => $offer->order,
					'avatar' => $offer->order->user->username,
					'title' => $offer->order->category->name,
				
					'comment' => $offer->order->comment,
					'deadline' => $offer->order->deadLine,
					'region' => $offer->order->regionID,
					'date' => $offer->order->getCreatedAt()
				]); 
			?>

			<!-- SELLER -->
			<div class="request-info">
				<?php echo Yii::t('app', 'Твоя пропозиція'); ?>
			</div>

			<?= $this->render('@appTheme/components/message', [
					'nameReviews' => $offer,
					'budget' => $offer->price,
					'comment' => (!empty($offer->comment)) ? $offer->comment : false,
					'date' => $offer->getCreatedAt(),
					'direction' => 'right',
					'images' => $offer->image
				]); 
			?>

			<!-- USER -->
			<div class="request-info">
				<?php echo Yii::t('app', 'Контакти клієнта'); ?>
			</div>
			<?= $this->render('@appTheme/components/message', [
				'nameReviews' => $offer->order,
				'avatar' => $offer->order->user->username,
				'title' => Yii::t('app', 'Контакти:'),
				'phone' => $offer->order->user->phone,
				'email' => $offer->order->user->email,
			]); ?>
			
			<div class="request-info">
				<?php echo Yii::t('app', 'Обмін відгуками'); ?>
			</div>
			
			<!-- USER -->
			<?php 
				if ($offer->getComment($offer->order->userID)->one()) {
				    $commentUser = $offer->getAnswer($offer->userID)->one();
				    $rating = Comment::Rating($commentUser->rating);

				    echo $this->render('@appTheme/components/message', [
				    	'nameReviews' => $offer->order,
			    		'avatar' => $commentUser->userFrom->username,
			    		'title' => $rating['name'] . ' ' . Yii::t('app', 'продавець'),
			    		'name' => (!empty($commentUser->comment)) ? $commentUser->comment : false,
			    		'date' => $commentUser->getUpdatedAt(),
			    		'class' => $rating['class']
			    	]);
				}
			?>

			<?php
	            $comments = $offer->getAnswer($offer->userID)->one();
	            $refuse = $offer->getRefuse($offer->order->userID)->one();
				$commentUser = $offer->getAnswer($offer->userID)->one();
	        ?>
			 
			<?php if ($refuse) : ?>
				<?php if ($refuse->comment ) : ?>
					<?= $this->render('@appTheme/components/message', [
						'avatar' => $offer->order->user->username,
						'title' => Yii::t('app', 'Я відмовився'),
						'name' => $refuse->comment,
						'date' => $refuse->updated_at,
					]); ?>
				<?php else : ?>
					<?= $this->render('@appTheme/components/message', [
						'avatar' => $offer->order->user->username,
						'title' => Yii::t('app', 'Я відмовився'),
						'name' => Yii::$app->params['refuse'][$refuse->refuseID],
						'date' => $refuse->updated_at,
					]); ?>  
				<?php endif;?>
	        <?php endif; ?> 
					
			<?php if (!$refuse) : ?>
				<?php if (empty($offer->getComment($offer->order->userID)->one())) : ?>
					<div class="blabla-comment dark first">
						<div class="text shadow-pulse-black">
							<p><?= Yii::t('app', 'Попроси клієнта залишити відгук про тебе'); ?><br><br>
							<?= Yii::t('app', 'Після того як клієнт залишить відгук про тебе — ти зможеш оцінити його як покупця.'); ?></p>
						</div>
					</div>
				<?php endif; ?>
			
				<!-- SELLER -->
				<?php if (!empty($offer->getComment($offer->order->userID)->one())) : ?>
				<?php if (!empty($offer->getComment($offer->userID)->one())) : ?>
					<?php
						$commentSeller = $offer->getComment($offer->userID)->one();

		            	echo $this->render('@appTheme/components/message', [
		            		'nameReviews' => $offer,
		            		'title' => $commentSeller['name'] . ' ' . Yii::t('app', 'покупець'),
		            		'name' => $commentSeller['comment'],
		            		'date' => $commentSeller->getUpdatedAt(),
		            		'class' => $commentSeller['class'],
		            		'direction' => 'right'
		            	]);
					?>

					<div class="blabla-comment dark first">
	                    <div class="text shadow-pulse-black">
	                        <p><?= Yii::t('app', 'Якщо потрібно можеш змінити свій відгук'); ?><br></p>
	                    </div>
	                </div>

				
				<?php endif; ?>

				<?php if (empty($offer->getComment($offer->userID)->one())) : ?>
					<div class="blabla-comment dark first">
	                    <div class="text shadow-pulse-black">
	                        <p><?= Yii::t('app', 'Залиш свій відгук про клієнта'); ?><br></p>
	                    </div>
	                </div>

				
				<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="tabs-block">
		<div class="tab-entry tab-answer" 
			<?php if (!$refuse) : ?>
				<?php if (!empty($offer->getComment($offer->order->userID)->one())) : ?>
				<?php  ?> style="display: block;" <?php ?>
			<?php endif; ?>
			<?php endif; ?>
		>
			<div class="request-foot">
				<?php
					echo Html::beginForm(['cabinet/accepted']);
					echo Html::hiddenInput('Comment[userFromID]', $offer->userID);
					echo Html::hiddenInput('Comment[userToID]', $offer->order->userID);
					echo Html::hiddenInput('Comment[offerID]', $offer->ID);
					if ($offer->getComment($offer->userID)->one()) {
						echo Html::hiddenInput('Comment[ID]', $offer->getComment($offer->userID)->one()->ID);
					} else {
						echo Html::hiddenInput('Comment[ID]', '');
					}
					echo Html::hiddenInput('Comment[rating]', Comment::RATING_GOOD);
				?>
					<div class="form-wrap">
						<?= $this->render('@appTheme/components/button-reviews'); ?>

						<div class="input-reviews">
							<div class="text"></div>
								<?= Html::textarea('Comment[comment]',
									$offer->getComment($offer->userID)->one() ? strip_tags($offer->getComment($offer->userID)->one()->comment) : '',
									[
										'class' => 'input',
										'placeholder' => Yii::t('app', 'Написати відгук')
									]);
								?>
						</div>

						<button type="submit" class="popup-send blue">
							<svg><use xlink:href="#send"></use></svg> 
						</button>
					</div>
				<?= Html::endForm(); ?>
			</div>
		</div>	

		<div class="tab-entry tab-share" 
			<?php if (($refuse) or empty($offer->getComment($offer->order->userID)->one()) or empty($rating)) : ?>
				 style="display: block;" 
			<?php endif; ?>
		>
			<div class="request-foot">
				<?= $this->render('@appTheme/components/social'); ?>
			</div>
		</div>	
	</div>
</div>