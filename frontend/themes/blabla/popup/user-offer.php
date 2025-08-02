<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\Offer $offer
 */
?>

<div class="popup-container wide">
    <a href="#" class="request-head close-popup">
        <div class="d-flex">
            <svg width="19" height="12" stroke="#1f3541"><use xlink:href="#arr-back"></use></svg>
            <h2 class="title"><?php echo Yii::t('app', 'Назад'); ?></h2>
        </div>
    </a>

    <div class="request-body">
        <div class="request-body_inner">
            <div class="blabla-comment dark first">
                <div class="text shadow-pulse-black">
                    <strong>
                        <?= Yii::t('app', 'Відгуки про') . ' ' . $offer->user->username ?>
                    </strong>
                    <p>
                        <?= $offer->user->countPositive . ' ' . Yii::t('app', 'позитивних') ?>,
                        <?= $offer->user->countNeutral . ' ' . Yii::t('app', 'нейтральних') ?>,
                        <?= $offer->user->countNegative . ' ' . Yii::t('app', 'негативних') ?>
                    </p>
                </div>
            </div>

            <?php foreach ($offer->user->getUserComments($offer->userID)->all() as $comments) : ?>
                <?php if ($comments['ID'] || $comments['answerID']) : ?>
                    <!-- USER -->
    				 <div class="request-info">
    					<?php echo Yii::t('app', 'Обмін відгуками по запиту'); ?>
    					<?php echo $comments['category']; ?>
    				 </div>

                    <?php 
                        if ($comments['answerID']) {
                            if ($comments['answerComment']) {
                                $text = $comments['answerComment'];
                            } else {
                                $text = \common\models\Comment::Rating($comments['answerRating'])['name'] . ' ' . Yii::t('app', 'продавець');
                            }

                            echo $this->render('@appTheme/components/message', [
                                'nameReviews' => $offer->order,
                                'comment' => $text,
                                'date' => $comments['answerUpdated'],
                               
                            ]); 
                        } 
                    ?>

                    <!-- SELLER -->
                    <?php 
                        if ($comments['ID']) {
                            if ($comments['commentt']) {
                                $text = $comments['commentt'];
                            } else {
                                $text = \common\models\Comment::Rating($comments['commentRating'])['name'] . ' ' . Yii::t('app', 'покупець');
                            }
                        } 

                        echo $this->render('@appTheme/components/message', [
                            'nameReviews' => $offer,
                            'comment' => $text,
                            'date' => $comments['commentUpdated'],
                        ]);
                    ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>