<?php

use yii\helpers\Url;
use common\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\models\UserFilter;
use yii\widgets\LinkPager;
use yii\web\Session;
use frontend\models\SignupForm;

// generate regions
$user = User::findOne(['ID' => Yii::$app->user->id]);
$regionList = [];
$regionList = array_merge($regionList, Yii::$app->params['region'][Yii::$app->language]);

/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 * @var \common\models\Order[] $orders
 * @var \common\models\Order $order_item
 * @var \common\models\Offer $offer
 * @var \yii\data\Pagination $pages
 */
 
$user = User::findOne(['ID' => Yii::$app->user->ID]);

$session = Yii::$app->session;

// Set current user phone :
if (Yii::$app->user->isGuest) {
    $user = new \common\models\User();
} else {
    $user = Yii::$app->user->identity;
}

$userFilters = UserFilter::find()->where(['userID' => Yii::$app->user->id])->one();

$category = [];
$region = [];
$countOrdersFilters = 0;

foreach ($orders as $orderCategory) {
    if (!empty($orderCategory->regionID)) {
        $category[$orderCategory->categoryID] = $orderCategory->category->name;
        $region[$orderCategory->regionID] = Yii::$app->params['region'][$_SESSION['language']][$orderCategory->regionID];
    }
}

?>

<div class="center pb100">
    <div class="request request-main">
        <div class="request-head">
            <?= $this->render('@appTheme/layouts/header', ['countOrders' => $countOrders]); ?>
        </div>
    </div>

	<?php if (empty($countOrders)): ?>
		<div class="blabla-comment dark ">
        	<div class="text shadow-pulse-black">
        		<strong>
        			<?= Yii::t('app', 'Поки немає нових запитів по налаштованих фільтрах'); ?>
        		</strong>
        	</div>
        </div>
	<?php endif; ?>

	<?php if ($this->context->count_orders !== 0): ?>
		<div class="blabla-comment dark ">
        	<div class="text shadow-pulse-black">
        		<strong>
        			<?= Yii::t('app', 'Запити на товари чи послуги, які ти пропонуєш, з урахуванням налаштованих фільтрів.'); ?>
        		</strong>
        	</div>
        </div>
	<?php endif; ?>
	
	<div class="empty-space-40"></div>

	<div class="seller-order load-more">
        <?php foreach ($orders as $order_item) : ?>
            <div class="request open-popup" data-rel="seller-order" data-param="<?= $order_item->getID() ?>">
                <?= $this->render('@appTheme/components/request-head', [
                    'title' => !is_null($order_item->category) ? $order_item->category->getName() : '',
                    'button' => true
                ]); ?>

                <div class="request-body">
                    <?php 
                        $avatar =  mb_substr(strip_tags($order_item->user->username ), 0, 1);
						
                        $title = $order_item->category->getName();
                        $commentOrder = (!empty($order_item->getComment())) ? $order_item->getComment() : false;
                        $date = $order_item->getCreatedAt();

                        echo $this->render('@appTheme/components/message', [
                            'avatar' => $avatar,
							 'nameReviews' => $order_item,
                            'title' => $title,
                            'comment' =>  mb_substr(strip_tags($commentOrder ), 0, 150),
                            'date' => $date
                        ]);     
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
	</div>
    
    <?php echo $this->render('@appTheme/components/pagination', [
        'pages' => $pages,
        'url' => 'cabinet/order'
    ]) ?>
</div>

<div class="popup-wrapper">
    <div class="close-layer d-none"></div>

    <div class="popup-content" data-rel="detail"></div>
    <div class="popup-content request" data-rel="seller-order"></div>
    <div class="popup-content" data-rel="seller-comment"></div>
    <div class="popup-content" data-rel="seller-view-comment"></div>
    <div class="popup-content" data-rel="gallery"></div>

    <?= $this->render('@appTheme/popup/popup-account-registration'); ?>
    <?= $this->render('@appTheme/popup/language'); ?>
</div>