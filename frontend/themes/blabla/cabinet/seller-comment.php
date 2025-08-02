<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Comment;

/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 * @var \common\models\Comment $comment
 */

$comment_item = array();
?>

<div class="center">
	<div class="request request-main">
	    <div class="request-head">
	        <?= $this->render('@appTheme/layouts/header'); ?>
	    </div>
	</div>
	
	<div class="tabs-block">
		<div class="flex">
			<h2 class="heading"><?= Yii::t('app', 'Відгуки') ?></h2>

		    <ul class="popup-tabs links-horizontal">
                <li class="tab-menu ">
                    <a href="<?= Url::to(['cabinet/accepted']); ?>">
                        
                        
                        <?= Yii::t('app', 'Нові контакти'); ?>
                    </a>
                </li>

                <li class="tab-menu active">
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

    	<div class="tab-entry" style="display: block;">
    		<div class="blabla-comment mb50 mt50 dark">
    			<div class="text">
    				<?= Yii::t('app','Відгуки від клієнтів'); ?></br>
    				<?= $user->countPositive . ' ' . Yii::t('app','позитивних ;'); ?></br>
    				<?= $user->countNeutral . ' ' . Yii::t('app','нейтральних ;'); ?></br>
    				<?= $user->countNegative . ' ' . Yii::t('app','негативних ;'); ?></br>
    			</div>
    		</div>

    		<?php foreach ($models as $comment) : ?>
			 <?php if ($comment->ID) : $rating = Comment::Rating($comment->commentRating); ?>
                <div class="request open-popup" data-param="<?= $comment->offerID; ?>" data-rel="seller-accepted">
                	<?= $this->render('@appTheme/components/request-head', [
                		'title' => $comment->product ? $comment->product : $comment->category,
                		'button' => true
                	]); ?>

                	<div class="request-body">
						<div class="request-info">
							<?php echo Yii::t('app', 'Обмін відгуками з') . ' ' . $comment->answerUsername; ?>
						</div>

                		<?php 
                			if ($comment->answerID) {
                            	$rating = Comment::Rating($comment->answerRating);
                            	
                            	echo $this->render('@appTheme/components/message', [
                            		'avatar' => $comment->answerUsername,
                            		'title' => $rating['name'] . ' ' . Yii::t('app', 'продавець'),
                            		'name' => $comment->answerComment,
                            		'date' => $comment->answerUpdated,
			 						'class' => $rating['class'],
                            	]);
                			}
                        ?>
                    </div>
                </div>
				<?php  endif; ?>
            <?php endforeach; ?>

           	<div class="pagination">
                <?php
	                $active = false;
	                if($pages->pageCount>1)
	                for ($i = 1; $i <= $pages->pageCount; $i++) :
	                    if ($i - 1 == $pages->page) {
	                        $active = true;
	                    }
	                    ?>
	                    <a class="button <?= $active ? 'style-31' : 'style-32' ?> inline-block"
	                       href="<?= Url::to(['cabinet/comment', 'page' => $i]) ?>">
	                        <span><?= $i ?></span>
	                    </a>
	                    <?php
	                    $active = false;
	                endfor;
                ?>
            </div>     
    	</div>

    	
    </div>
</div>

<div class="popup-wrapper">
    <div class="close-layer d-none"></div>

    <div class="popup-content request" data-rel="seller-accepted"></div>
	<div class="popup-content" data-rel="seller-view-comment"></div>
    <div class="popup-content" data-rel="detail"></div>

    <?= $this->render('@appTheme/popup/language'); ?>
</div>