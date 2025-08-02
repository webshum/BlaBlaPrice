<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Comment;


/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 * @var \common\models\Comment $comment
 */
?>

<div class="center">
	<div class="request request-main">
	    <div class="request-head">
	        <?= $this->render('@appTheme/layouts/header'); ?>
	    </div>
	</div>

	<div class="flex">
		<h2 class="heading"><?= Yii::t('app', 'Контакти компаній') ?></h2>

		<ul class="links-horizontal">
			<li>
				<a href='accepted-without-ans'>
					<?= Yii::t('app','Нові'); ?>
				</a>
			</li>
		
		
			<li>
	            <a href='<?= Url::to(['cabinet/comment']) ?>' class="active">
	            	

					<?= Yii::t('app', 'З відгуками'); ?>
				</a>
			</li>
		</ul>
	</div>

	<div class="empty-space-60"> </div>

	<?php
		$sum = $user->countPositive+$user->countNeutral+$user->countNegative;
			
		if ( $sum < 1) : 
	?>	
		<div class="blabla-comment dark">
			<div class="text">
				<?= Yii::t('app','Тут будуть відгуки ') ?>
			</div>
		</div>
    <?php else : ?>
    	<div class="blabla-comment dark mt50 mb50">
			<div class="text">
				<?= Yii::t('app','Слідкуй за своїм рейтингом щоб в майбутньому отримувати більше відповідей на свої запити.'); ?></br>
			
			</div>
		</div>
		<div class="empty-space-40"> </div>
		<?php foreach ($models as $comment) : ?>
			<?php if ($comment->ID) : ?>
            <div class="request open-popup" data-param="<?= $comment->offerID; ?>" data-rel="user-comment">
            	<?= $this->render('@appTheme/components/request-head', [
            		'title' => $comment->product ? $comment->product : $comment->category,
            	
            		'button' => true
            	]); ?>
							
				<div class="request-body">
					<div class="request-info">
						<?php echo Yii::t('app', 'Обмін відгуками з ') . ' ' . $comment->answerUsername; ?>
					</div>
					
							<div class="text-right">
								<?php 
									$rating = Comment::Rating($comment->commentRating);
									$title = $rating['name'] . ' ' . Yii::t('app', 'продавець');
									$name = $comment->commentt;
									$date = $comment->commentUpdated;

									echo $this->render('@appTheme/components/message', [
										'title' => $title,
										'name' => $name,
										'date' => $date,
										'class' => $rating['class']
									]);
								?>
							</div>	
						

						<?php if ($comment->answerID) : ?>
							<?php 
								$rating = Comment::Rating($comment->answerRating);
								$avatar = mb_substr(strip_tags($comment->answerUsername), 0, 1);
								$title = $rating['name'] . ' ' . Yii::t('app', 'покупець');
								$name = $comment->answerComment;
								$date = $comment->answerUpdated;

								echo $this->render('@appTheme/components/message', [
									'avatar' => $avatar,
									'title' => $title,
									'name' => $name,
									'date' => $date,
									'class' => $rating['class']
								]);
							?>
						<?php endif; ?>
					
				</div>
            </div>   
			<?php endif; ?>   
        <?php endforeach; ?>
		
        <div class="empty-space-60"> </div>
		<div class="empty-space-60"> </div>

		<?php echo $this->render('@appTheme/components/pagination', [
	        'pages' => $pages,
	        'url' => 'cabinet/comment'
	    ]) ?>
    <?php endif; ?>
</div>

<div class="popup-wrapper">
    <div class="close-layer d-none"></div>

    <?= $this->render('@appTheme/popup/language'); ?>
    <div class="popup-content request" data-rel="user-comment"></div>
	<div class="popup-content request" data-rel="seller-view-comment"></div>
	
    <div class="popup-content request" data-rel="detail"></div>
</div>