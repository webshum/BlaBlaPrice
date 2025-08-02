<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\session;

/**
 * @var \common\models\Order[] $models
 * @var \yii\data\Pagination $pages
 */

$session = Yii::$app->session;

if ($session->has('filter')) $session->remove('filter');
if ($session->has('popup_regsiter_social')) $session->remove('popup_regsiter_social');
if ($session->has('email_social')) $session->remove('email_social');

?>

<div class="center pb100">
    <div class="request request-main">
        <div class="request-head">
            <?= $this->render('@appTheme/layouts/header'); ?>
        </div>
    </div>

	<h2 class="heading"><?= Yii::t('app','Запити які ти надіслав продавцям.'); ?></h2>

	<div class="user-order load-more">
        <?php if (empty($models)) : ?>
		 <div class="blabla-comment  dark first  ">
			<div class="text">
				<p> <?= Yii::t('app', 'Створи запит і отримай персональні пропозиції від продавців.') ?> </p>
				
			</div>
		</div>
        <div class="blabla-comment  dark not-first last  ">
			<div class="text">
				<p> <?= Yii::t('app', 'Спробуй знайти ціну на BlaBlaPrice. Це зручно і безкоштовно.') ?> </p>
				<a class="menu-button blue" style="margin-top:20px">
					<?= Yii::t('app', 'Почати пошук ціни'); ?>
					<svg width="16" height="16"><use xlink:href="#search"></use></svg>
				</a>
			</div>
		</div>
        <?php else : ?>
            <?php foreach ($models as $order_item) : ?>
                <div class="request open-popup" data-rel="user-order" data-param="<?= $order_item->getID() ?>">

                    <?= $this->render('@appTheme/components/request-head', [
                        'title' => $order_item->category->name,
                      
                        'button' => true
                    ]); ?>

                	<div class="request-body">
						<div class="request-info">
						<?= Yii::t('app', 'Шукаємо продавців') ?>
						</div>
                		<div class="text-right">
                            <?php 
                                $title = $order_item->category->name;
                                $comment = (!empty($order_item->comment)) ? mb_substr(strip_tags( $order_item->comment ), 0, 100) : false;
                                $date = $order_item->getCreatedAt();

                                echo $this->render('@appTheme/components/message', [
                                    'title' => $title,
                                    'comment' => $comment,
                                    'date' => $date
                                ]);
                            ?>
                		</div>

						<?php if (count($order_item->offers) > 0) : ?>
							<div class="blabla-comment success mt30">
								<div class="text shadow-pulse-black">
									<?= Yii::t('app', 'Ти отримав') . ' ' . count($order_item->offers) . ' ' . Yii::t('app', 'пропозицій'); ?>
								</div>
							</div>
	                    <?php endif; ?>
                	</div>
				</div>
            <?php endforeach;  ?>

            <?php echo $this->render('@appTheme/components/pagination', [
                'pages' => $pages,
                'url' => 'cabinet/order'
            ]) ?>
        <?php endif; ?>
	</div>		
</div>

<div class="popup-wrapper">
    <div class="close-layer d-none"></div>
    <div class="popup-content" data-rel="detail"></div>
    <div class="popup-content request" data-rel="user-order"></div>
    <div class="popup-content" data-rel="user-desibled-order"></div>
    <div class="popup-content request" data-rel="user-offer"></div>
    <div class="popup-content" data-rel="user-view-contact"></div>  
    <div class="popup-content" data-rel="seller-view-comment"></div>
    <div class="popup-content" data-rel="gallery"></div>

    <?= $this->render('@appTheme/popup/popup-phone-verification') ?>
    <?= $this->render('@appTheme/popup/language'); ?>
</div>