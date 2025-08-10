<?php
use yii\widgets\ActiveForm;
use common\models\User;
/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 * @var \common\models\Offer $offer_item
 */
// generate regions
$user = User::findOne(['ID' => Yii::$app->user->id]);
$regionList = [];
$regionList = array_merge($regionList, Yii::$app->params['region'][Yii::$app->language]);
?>

<div class="center">
	<div class="request request-main">
	    <div class="request-head">
	        <?= $this->render('@appTheme/layouts/header'); ?>
	    </div>
	</div>

	<h2 class="heading"><?= Yii::t('app', 'Мої пропозиції') ?></h2>
		<div class="blabla-comment dark ">
        	<div class="text shadow-pulse-black">
        		<strong>
        			<?= Yii::t('app', 'Тут відображаються твої пропозиції покупцям.'); ?></br></br>
        		</strong>
				<?= Yii::t('app', 'Якщо клієнт погодиться — його контакти з’являться в розділі «Контакти клієнтів».'); ?></br></br>
				<?= Yii::t('app', 'А якщо покупець погодиться на пропозицію іншого продавця — запит автоматично видалиться з твого акаунта.'); ?>
        	</div>
        </div>
	
	<div class="empty-space-40"></div>

	<div class="seller-offer">
        <?php foreach ($models as $offer_item) : ?>
            <div class="request open-popup" data-rel="seller-offer" data-param="<?= $offer_item->ID ?>">
            	<div class="request-head">
            		<div>
            			<h1 class="title"><?= $offer_item->order->category->name ?></h2>
            		</div>

            		<div class="controls">
            			<button class="open-popup">
            				<svg width="24" height="24"><use xlink:href="#open"></use></svg>
            			</button>
            		</div>
            	</div>

            	<div class="request-body">
					<div class="request-info">
						<?php echo Yii::t('app', 'Пропозиція для') . ' ' . $offer_item->order->user->userName; ?>
					</div>
            		<div class="text-right">
            			<?php 
            				echo $this->render('@appTheme/components/message', [
								'nameReviews' => !empty($order_item) ? $order_item : null,
	                            'budget' => $offer_item->price,
	                            'comment' =>  $offer_item->comment,
	                            'date' => $offer_item->getCreatedAt()
	                        ]); 
            			?>
            		</div>

					<?php if ($offer_item->order->bestOffer->price < $offer_item->price) :?>
						<div class="blabla-comment dark first">
							<div class="text">
								<p>
									<?= Yii::t('app', 'Найкраща ціна'); ?><br>
									<?= $offer_item->order->bestOffer->price . ' ' . Yii::t('app',' грн'); ?>
								</p>
							</div>
						</div>
					<?php endif; ?>
            	</div>
            </div>
        <?php endforeach; ?>
	</div>

	<?php echo $this->render('@appTheme/components/pagination', [
	    'pages' => $pages,
	    'url' => 'cabinet/offer'
	]) ?>              
</div>

<div class="popup-wrapper">
    <div class="close-layer d-none"></div>

    <div class="popup-content" data-rel="detail"></div>
    <div class="popup-content request" data-rel="seller-offer"></div>
    <div class="popup-content" data-rel="seller-view-comment"></div>
    <div class="popup-content" data-rel="seller-price-down"></div>
    <div class="popup-content" data-rel="gallery"></div>

    <?= $this->render('@appTheme/popup/language'); ?>
</div>