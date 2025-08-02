<?php

use yii\helpers\Html;
use common\models\Comment;
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
 * @var \common\models\Offer $offer
 * @var Comment $comments
 */
?>

<div class="popup-container wide">
	<?= $this->render('@appTheme/components/request-head', [
		'title' => $offer->order->category->name,
		
		'button' => false
	]); ?>

	<div class="request-body">
        <div class="request-body_inner">
            <!-- USER -->
    		<div class="request-info">
    			<?php echo Yii::t('app', 'Твій запит'); ?>
    		</div>
            <?= $this->render('@appTheme/components/message', [
                    'nameReviews' => $offer->order,
                    'avatar' => $offer->order->user->userName,
                    'budget' => $offer->order->priceFrom,
                    'comment' => $offer->order->comment,
                    'deadline' => $offer->order->deadLine,
                    'region' => $offer->order->regionID,
                    'date' => $offer->getUpdatedAt(),
                    'direction' => 'right'
                ]);
            ?>

            <!-- SELLER -->
    		<div class="request-info">
    			<?php echo Yii::t('app', 'Пропозиція продавця'); ?>
    		</div>
            <?= $this->render('@appTheme/components/message', [
                    'nameReviews' => $offer,
                    'avatar' => $offer->user->username,
                    'budget' => $offer->price,
                    'comment' => $offer->comment,
                    'date' => $offer->getUpdatedAt()
                ]);
            ?>  
    		<div class="request-info">
    			<?php echo Yii::t('app', 'Контакти продавця'); ?>
    		</div>
            <?= $this->render('@appTheme/components/message', [
                    'nameReviews' => $offer,
                    'avatar' => $offer->user->username,
                    'phone' => $offer->user->phone,
                    'email' => $offer->user->email
                ]);
            ?>
    		
            <!-- USER -->
    		<div class="request-info">
    			<?php echo Yii::t('app', 'Обмін відгуками'); ?>
    		</div>
            <?php 
                if ($offer->getAnswer($offer->userID)->one()) {
                    $rating_answ = Comment::Rating($offer->getAnswer($offer->userID)->one()->rating);
                    
                    echo $this->render('@appTheme/components/message', [
                        'nameReviews' => $offer->order,
                        'title' => $rating_answ['name'] . ' ' . Yii::t('app', 'продавець'),
                        'name' => $offer->getAnswer($offer->userID)->one()->comment,
                        'class' => $rating_answ['class'],
                        'date' => $offer->getUpdatedAt(),
                        'direction' => 'right'
                    ]);
                } 
            ?>

            <!-- SELLER -->
    		<?php 
                if ($offer->getAnswer($offer->order->userID)->one()) {
                    $comments = $offer->getAnswer($offer->order->userID)->one(); 
                    $rating = Comment::Rating($comments->rating);

                    echo $this->render('@appTheme/components/message', [
                        'nameReviews' => $offer,
                        'avatar' => $comments->userFrom->username,
                        'title' => $rating['name'] . ' ' . Yii::t('app', 'покупець'),
                        'name' => $comments->comment,
                        'date' => $comments->getUpdatedAt(),
                        'class' => $rating['class']
                    ]);
                } 
            ?>
        </div>
	</div>

    <div class="request-foot">
        <?php
            echo Html::beginForm(['cabinet/accepted-with-ans']);
            echo Html::hiddenInput('Comment[userFromID]', $offer->order->userID);
            echo Html::hiddenInput('Comment[userToID]', $offer->userID);
            echo Html::hiddenInput('Comment[offerID]', $offer->ID);
            if ($offer->getAnswer($offer->userID)->one()) {
                echo Html::hiddenInput('Comment[ID]', $offer->getAnswer($offer->userID)->one()->ID);
            } else {
                echo Html::hiddenInput('Comment[ID]', '');
            }
            echo Html::hiddenInput('Comment[rating]', Comment::RATING_GOOD);
        ?>
            <div class="form-wrap">
                <?= $this->render('@appTheme/components/button-reviews'); ?>

                <div class="input-reviews">
                    <div class="text"></div>
                    <?php
                        echo Html::textarea('Comment[comment]', 
                            $offer->getAnswer($offer->userID)->one() ? strip_tags($offer->getAnswer($offer->userID)->one()->comment) : '',
                            [
                                'class' => 'input',
                                'placeholder' => Yii::t('app', 'Залиште відгук (необов\'язково)')
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
    
