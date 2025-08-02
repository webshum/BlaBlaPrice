<?php

use yii\helpers\Html;
use common\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use frontend\models\SignupForm;
use frontend\models\Category;

// Set current user phone :
if (Yii::$app->user->isGuest) {
    $user = new \common\models\User();
} else {
    $user = Yii::$app->user->identity;
}

// generate regions
$user = User::findOne(['ID' => Yii::$app->user->id]);
$regionList = [];
$regionList = array_merge($regionList, Yii::$app->params['region'][Yii::$app->language]);

/**
 * @var \yii\web\View $this
 * @var \common\models\Order $order
 * @var \common\models\Offer $offer_item
 */
?>

<div class="popup-container wide">
	<?= $this->render('@appTheme/components/request-head', [
		'title' => $order->category->name,
		
		'button' => false
	]); ?>
	
	<div class="request-body">
		<div class="request-body_inner">
	        <!-- USER -->
			<div class="request-info">
				<?= Yii::t('app', 'Шукаємо продавців') ?>
				
			</div>
			<?= $this->render('@appTheme/components/message', [
				
					'comment' => (!empty($order->comment)) ? $order->comment : false,
					'deadline' => $order->deadLine,
					'region' => $order->regionID,
					'date' => $order->getCreatedAt(),
					'direction' => 'right'
				]);
			?>
			
			<!-- SELLER -->
			<div class="request-info">
				<?php echo Yii::t('app', 'Пропозиції продавців'); ?>
			</div>
	        <?php if ($order->offers) : ?>
				<?php foreach ($order->offers as $offer_item) : ?>
					<div class="blabla-comment dark first">
						<div class="text shadow-pulse-black">
							<strong>
								<?= Yii::t('app', 'Продавці почали відповідати. Переглядай рейтинг продавців перед тим як обмінюватись контактами'); ?>
							</strong>
						</div>
					</div>
					
					<div class="message">
						<div class="box">
							<div class="avatar">
								<?= $string = mb_substr(strip_tags($offer_item->user->username ), 0, 1); ?>
							</div>

							<div class="inner">
								<div class="name-reviews open-popup" data-rel="user-offer" data-param="<?= $offer_item->ID ?>">
									<strong><?= $offer_item->user->username ?></strong>

									<div class="positive-count">
										<?php if ($offer_item->user->countPositive) : ?>
											<svg><use xlink:href="#positive"></use></svg>
										<?php else : ?>
											<svg><use xlink:href="#happy"></use></svg>
										<?php endif; ?>

										<span><?= $offer_item->user->countPositive; ?></span>
									</div>

									<div class="neutral-count">
										<?php if ($offer_item->user->countNeutral) : ?>
											<svg><use xlink:href="#neutral"></use></svg>
										<?php else : ?>
											<svg><use xlink:href="#happy"></use></svg>
										<?php endif; ?>

										<?= $offer_item->user->countNeutral; ?>
									</div>

									<div class="negative-count">
										<?php if ($offer_item->user->countNegative) : ?>
											<svg class="jump"><use xlink:href="#negative"></use></svg>
										<?php else : ?>
											<svg><use xlink:href="#happy"></use></svg>
										<?php endif; ?>

										<?= $offer_item->user->countNegative; ?>
									</div>

									<?php 
										echo $this->render('@appTheme/components/reviews', [
											'reviews' => $offer_item->user,
										]); 
									?>
								</div>

								<div class="budget">
									<strong><?= Yii::t('app', 'Ціна') ;?></strong>
									<?= $offer_item->price . ' ' . Yii::t('app',' грн') ?>

									<?php if ($offer_item->oldPrice != null) : ?>
										<br>
										<strong><?= Yii::t('app', 'стара ціна ') ;?></strong>
										<?= $offer_item->oldPrice . ' ' . Yii::t('app',' грн') ?>
									<?php endif; ?>
								</div>

								<div class="comment">
									<?= $offer_item->comment ?>
								</div>

								<?php if (!empty($offer_item->image) && $offer_item->image != 'null') : ?>
									<?php  $images = json_decode($offer_item->image); ?>
									<div class="list-files-uploaded">
										<div class="wrap">
											<ul class="gallery-offer">
												<?php foreach ($images as $image) : ?>
													<li>
														<a data-fancybox="gallery" href="<?= $image; ?>"><img src="<?= $image; ?>" alt=""></a>
													</li>
						                        <?php endforeach; ?>
						                    </ul>
										</div>
									</div>
								<?php endif; ?>

								<?php 
									$category = Category::findOne(['ID' => $order->categoryID]);            
									echo Html::beginForm(['cabinet/accepted-offer']);
			                        echo Html::hiddenInput('id', $offer_item->ID);
								?>

				                    <input type="hidden" name="price_category" value="<?= $category->price; ?>">
				                    <input type="hidden" name="user_id" value="<?= $offer_item->userID; ?>">

				                    <button class="popup-button blue mt10">
				                        <span><?= Yii::t('app', 'Обмінятись контактами'); ?></span>
				                    </button>
			                    <?= Html::endForm(); ?>

			                    <div class="date"><?= $offer_item->getCreatedAt() ?></div>
							</div>
						</div>
					</div>
	            <?php endforeach; ?>
				
				
	            <div class="blabla-comment dark not-first middle">
	            	<div class="text shadow-pulse-black">
	            		<strong>
	            			<?= Yii::t('app', 'Можеш чекати на пропозиції від інших продавців, або обмінятись контактами щоб поторгуватись.'); ?>
	            		</strong>
	            	</div>
	            </div>
				<div class="blabla-comment dark not-first last">
	            	<div class="text shadow-pulse-black">
	            		<strong>
	            			<?= Yii::t('app', 'Не забудь поширити BlaBlaPrice щоб продавців ставало більше, і тоді будуть кращі ціни'); ?>
	            		</strong>
	            	</div>
	            </div>
				<div class="drop-menu active">
					<a href="#">
						<span><?= Yii::t('app', 'Твої дії'); ?></span>	 <svg><use xlink:href="#dot"></use></svg>
					</a>

					<ul class="drop active">
						<li>
							<a href="#" data-tab="tab-share" class="js-share" >
								<svg><use xlink:href="#soc"></use></svg>
								<?= Yii::t('app', 'Поширити'); ?>	
							</a>
						</li>
						<li>
							<a href="#" data-tab="tab-spam" class="js-spam" >
								<svg><use xlink:href="#delete"></use></svg>
								<?= Yii::t('app', 'Видалити чат'); ?>	
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
	        <?php endif; ?>

	        <?php if (count($order->offers) == 0) : ?>
	        	<div class="blabla-comment dark first">
	        		<div class="text shadow-pulse-black">
	        			<strong>
	        				<?= Yii::t('app', 'Чекай на пропозиції'); ?>
	        			</strong>
	        		</div>
	        	</div>

	        	<div class="blabla-comment dark not-first last">
	        		<div class="text shadow-pulse-black">
	        			<strong>
	        				<?= Yii::t('app', 'Пошир BlaBlaPrice щоб збільшити кількість продавців, і пропозицій з нижчими цінами'); ?>
	        			</strong>
	        		</div>
	        	</div>

				<div class="drop-menu active">
					<a href="#">
						<span><?= Yii::t('app', 'Твої дії'); ?></span>	 <svg><use xlink:href="#dot"></use></svg>
					</a>

					<ul class="drop active">
						<li>
							<a href="#" data-tab="tab-share" class="js-share" >
								<svg><use xlink:href="#soc"></use></svg>
								<?= Yii::t('app', 'Поширити'); ?>	
							</a>
						</li>
						<li>
							<a href="#" data-tab="tab-spam" class="js-spam" >
								<svg><use xlink:href="#delete"></use></svg>
								<?= Yii::t('app', 'Видалити чат'); ?>	
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
	        <?php endif; ?>
	    </div>
	</div>

	<div class="tabs-block">
        <div class="tab-entry tab-answer" <?php if (empty($rating)) : ?> style="display: block;" <?php endif; ?>	>
			<div class="request-foot">
				
			</div>	
		</div>	

		<div class="tab-entry tab-spam">
			<div class="request-foot">
			 <span class="popup-delete-order">
				<?= Html::a( Yii::t('app', 'Видалити чат'), Url::to(['cabinet/order-disable', 'id' => $order->getID()]) ) ?>
			</span>
	       </div>
		</div>	

		<div class="tab-entry tab-share" style="display: block;" >
			<div class="request-foot">
				<?= $this->render('@appTheme/components/social'); ?>
			</div>
		</div>	
	</div>
</div>

<script type="text/javascript">
    setInterval(function () {
        setTimer($('.time-entry[data-rel="17"]'), $('#datepicker').html());
    }, 1000);

    function setTimer(wrapper, finalTime) {
        var today = new Date().getTime();
        var interval = finalTime - today;
        if (interval < 0) interval = 0;
        var days = parseInt(interval / (1000 * 60 * 60 * 24));
        var daysLeft = interval % (1000 * 60 * 60 * 24);
        var hours = parseInt(daysLeft / (1000 * 60 * 60));
        var hoursLeft = daysLeft % (1000 * 60 * 60);
        var minutes = parseInt(hoursLeft / (1000 * 60));
        var minutesLeft = hoursLeft % (1000 * 60);
        var seconds = parseInt(minutesLeft / (1000));
        wrapper.find('.days').text(days + 1);
        wrapper.find('.hours').text(hours);
        wrapper.find('.minutes').text(minutes);
        wrapper.find('.seconds').text((seconds < 10) ? '0' + seconds : seconds);
    }
</script>
