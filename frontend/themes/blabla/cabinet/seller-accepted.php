<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use common\models\Comment;

/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 */
?>

<div class="center">
    <div class="request request-main">
        <div class="request-head">
            <?= $this->render('@appTheme/layouts/header'); ?>
        </div>
    </div>

    <div class="tabs-block">
        <div class="flex">
            <ul class="popup-tabs links-horizontal">
                <li class="tab-menu active">
                    <a href="<?= Url::to(['cabinet/accepted']); ?>">
                       
                        
                        <?= Yii::t('app', 'Нові контакти'); ?>
                    </a>
                </li>

                <li class="tab-menu">
                    <a href="<?= Url::to(['cabinet/comment']) ?>">
                       
                        <?= Yii::t('app','Відгуки'); ?>
                    </a>
                </li>
				<li class="tab-menu">
		    		<a href="<?= Url::to(['cabinet/comment-refuse']) ?>">
		    			<?= $count_refuses; ?>
						<?= Yii::t('app','Відмовились'); ?>
		    		</a>
		    	</li>
            </ul>
        </div>
    </div>

	<h2 class="heading"><?= Yii::t('app', 'Контакти клієнтів') ?></h2>

	<div class="seller-accepted">
		<div class="blabla-comment dark ">
        	<div class="text shadow-pulse-black">
        		<strong>
        			<?= Yii::t('app', 'Контакти клієнтів, які обрали твою пропозицію.'); ?>
        		</strong>
        	</div>
        </div>
        <?php foreach ($offer as $offer_item) : ?>
    			<div class="request open-popup" data-param="<?= $offer_item->ID ?>" data-rel="seller-accepted">
    				<?= $this->render('@appTheme/components/request-head', [
    					'title' => $offer_item->order->category->name,
    					
    					'button' => true
    				]) ?>

                  	<div class="request-body">
    					<div class="request-info">
    						<?php echo Yii::t('app', 'Контакти ') . ' ' . $offer_item->order->user->userName; ?>
    					</div>

                  		<?= $this->render('@appTheme/components/message', [
                  			'avatar' => $offer_item->order->user->username,
							'nameReviews' => $offer_item->order,
                  			'name' => $offer_item->order->user->username,
                  			'phone' => $offer_item->order->user->phone,
                  			'email' => $offer_item->order->user->email
                  		]) ?>
						
                  	</div>
                </div>
        <?php endforeach; ?>
	</div>

    <?php echo $this->render('@appTheme/components/pagination', [
        'pages' => $pages,
        'url' => 'cabinet/accepted'
    ]) ?>	
</div>

<div class="popup-wrapper">
    <div class="close-layer d-none"></div>

    <div class="popup-content" data-rel="detail"></div>
    <div class="popup-content request" data-rel="seller-accepted"></div>
    <div class="popup-content" data-rel="seller-view-comment"></div>
    <div class="popup-content" data-rel="gallery"></div>

    <?= $this->render('@appTheme/popup/language'); ?>
</div>