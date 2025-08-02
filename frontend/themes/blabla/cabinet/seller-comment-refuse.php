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

                <li class="tab-menu ">
                    <a href="<?= Url::to(['cabinet/comment']) ?>">
                       
                        <?= Yii::t('app','Відгуки'); ?>
                    </a>
                </li>
				<li class="tab-menu active">
		    		<a href="<?= Url::to(['cabinet/comment-refuse']) ?>">
		    			<?= $count_refuses; ?>
						<?= Yii::t('app','Відмовились'); ?>
		    		</a>
		    	</li>
            </ul>
		</div>

    

    	
    		<?php		
                $ref = array();
                $refuse = $refuses;

                foreach ($refuse as $key => $value) {
                	if (isset($ref[$value['answerRefuse']])) {
                        $ref[$value['answerRefuse']]++;
                    } else {
                        $ref[$value['answerRefuse']] = 1;
                    }
                }
            ?>

            <?php foreach ($refuse as $refuse_item) : ?>
				<div class="request open-popup" data-param="<?= $refuse_item->offerID; ?>" data-rel="seller-accepted">
					<?= $this->render('@appTheme/components/request-head', [
						'title' => $refuse_item->product ? $refuse_item->product : $refuse_item->category,
						
						'button' => true
					]); ?>

					<div class="request-body">
					<div class="request-info">
							<?php echo Yii::t('app', 'Клієнт ') . ' ' . $refuse_item->answerUsername; ?>
						</div>
						<?php 
							$avatar = mb_substr(strip_tags($refuse_item->answerUsername), 0, 1);
							
							$name = $refuse_item->answerComment ? $refuse_item->answerComment : Yii::$app->params['refuse'][$refuse_item->answerRefuse];
							$date = $refuse_item->answerUpdated;

							echo $this->render('@appTheme/components/message', [
								'avatar' => $avatar,
								'title' => $title,
								'name' => $name,
								'date' => $date,
							]);
						?>
					</div>		                    
                </div>            
            <?php endforeach; ?>

            <?php echo $this->render('@appTheme/components/pagination', [
		        'pages' => $pages,
		        'url' => 'cabinet/comment'
		    ]) ?>    
    	
    </div>
</div>

<div class="popup-wrapper">
    <div class="close-layer d-none"></div>

    <div class="popup-content request" data-rel="seller-accepted"></div>
	<div class="popup-content" data-rel="seller-view-comment"></div>
    <div class="popup-content" data-rel="detail"></div>

    <?= $this->render('@appTheme/popup/language'); ?>
</div>