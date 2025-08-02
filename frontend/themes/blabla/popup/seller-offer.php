<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\helpers\Url;
use frontend\models\SignupForm;

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
	<div class="request-head">
		<div>
			<h2 class="title"><?= $offer->order->category->name ?></h2>
		</div>

		<a class="close-popup-all">
		    <svg width="12" height="12"><use xlink:href="#close-layer"></use></svg>
		</a>
	</div>
	
	<div class="request-body">
		<div class="request-body_inner">
			<div class="request-info">
				<?php echo Yii::t('app', 'Запит клієнта'); ?>
			</div>
			<!-- USER -->
			<?= $this->render('@appTheme/components/message', [
					'nameReviews' => $offer->order,
				    'avatar' => $offer->order->user->username,
				    'budget' => $offer->order->priceFrom,
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
				    'comment' => $offer->comment,
				    'date' => $offer->getCreatedAt(),
				    'direction' => 'right',
				    'images' => $offer->image
				]);
			?>
			
			<?php if ($offer->order->bestOffer->price <  $offer->price) :?>
				<div class="blabla-comment dark first">
					<div class="text">
						<p>
							<?= Yii::t('app', 'Найкраща ціна яку запропонували інші продавці -'); ?><br>
							<?= $offer->order->bestOffer->price . ' ' . Yii::t('app','грн'); ?><br>
							<?= Yii::t('app', 'Ти можеш змінювати пропозицію поки клієнт не обміняється контактами з одним із продавців'); ?>
						</p>
					</div>
				</div>
			<?php endif; ?>
			
			<?php if (($offer->order->bestOffer->price > $offer->price) or ($offer->order->bestOffer->price ==  $offer->price)):?>
				<div class="blabla-comment dark first">
					<div class="text">
						<p>
							<?= Yii::t('app', 'Твоя ціна одна з найкращих'); ?><br>
						
						</p>
					</div>
				</div>
				<div class="blabla-comment dark not-first middle">
					<div class="text">
						<p>
							<?= Yii::t('app', 'Ти можеш змінювати пропозицію поки клієнт не обміняється контактами з одним із продавців'); ?>
							
							
						</p>
					</div>
				</div>
				<div class="blabla-comment dark not-first last">
					<div class="text">
						<p>
							
							<?= Yii::t('app', 'Твої шанси зростають, якщо маєш високий рейтинг, привабливу ціну та чіткі умови.'); ?>
						</p>
					</div>
				</div>
			<?php endif; ?>

			<div class="drop-menu active">
				<a href="#">
					<span><?= Yii::t('app', 'Твої дії'); ?></span>	 <svg><use xlink:href="#dot"></use></svg>
				</a>

				<ul class="drop active">
					<li>
						<a href="#" data-tab="tab-answer " class="js-answer" >
							<svg><use xlink:href="#offers"></use></svg>
							<?= Yii::t('app', 'Змінити пропозицію'); ?>	
						</a>
					</li>
					<li>
								<a href="#" data-tab="tab-share" class="js-share" >
									<svg><use xlink:href="#soc"></use></svg>
									<?= Yii::t('app', 'Поширити'); ?>	
								</a>
							</li>
					
					<li>
						<a href="#" class="js-close-popup">
							<svg class="close-chat"><use xlink:href="#close-layer"></use></svg>
								<?= Yii::t('app', 'Закрити вікно чату'); ?>
								
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="tabs-block">
		<div class="tab-entry tab-answer" >
				<div class="request-foot">
					<?php 
						$form = ActiveForm::begin([
							'action' => ['cabinet/offer'],
							'fieldConfig' => ['template' => "{input}", 'options' => ['tag' => false]]
						]);
						echo $form->field($offer, 'userID')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
						echo $form->field($offer, 'ID')->hiddenInput(['value' => $offer->ID])->label(false);
						echo $form->field($offer, 'orderID')->hiddenInput(['value' => $offer->order->ID])->label(false);
					?>

					<div class="input-group align-center">
						<div class="list-files-uploaded">
							<label class="button input-file">
								<svg><use xlink:href="#file"></use></svg>

								<?php if(!empty($offer->logo)){
									echo Html::img($offer->logo, $options = ['class' => 'postImg', 'style' => ['width' => '180px']]);
								} ?>

								<input type="hidden" name="MAX_FILE_SIZE" value="1000">

								<?= $form->field($offer, 'offerImage')->fileInput([
									'class' => 'file-upload',
									// 'multiple' => true,
									'accept' => 'image/*'
								])->label(false); ?>
							</label>

							<div class="wrap"></div>

							<?php if (!empty($offer->image)) : ?>
								<?php $images = json_decode($offer->image); if (!empty($images)) : ?>
									<div class="gallery-offer edit-photo-offer">
										<?php foreach($images as $image) : ?>
											<div class="item-file">
												<div class="img">
													<a data-fancybox="gallery" href="<?= $image; ?>">
														<img src="<?= $image; ?>">
													</a>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>

						<?= $form->field($offer, 'price')->textInput([
							'class' => 'input',
							'placeholder' => Yii::t('app', 'Оновити ціну')
						])->label(false) ?>

						<?= $form->field($offer, 'comment')->textarea([
							'class' => 'input mt20',
							'placeholder' => Yii::t('app', 'Ваш коментар')
						])->label(false) ?>

						<button type="submit" class="popup-send">
							<svg><use xlink:href="#send"></use></svg> 
						</button>
					</div>

					<?php ActiveForm::end(); ?>
				</div>
		</div>
		<div class="tab-entry tab-share" >
			<div class="request-foot">
				<?= $this->render('@appTheme/components/social'); ?>
			</div>
		</div>
			
			
	</div>
</div>